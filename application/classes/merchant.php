<?php defined('SYSPATH') or die('No direct script access.'); 

class Merchant
{
    protected static $instance;
    protected static $gateway;
    protected $config;

    public static function factory($gateway)
    {
        if ( ! isset(Content::$instance))
        {
            $config = Kohana::config($gateway);

            self::$instance = new Merchant($config);
        }
        
        self::$gateway = $gateway;

        return self::$instance;
    }
    
    public function __construct($config = array())
    {
        $this->config = $config;
    }
    
    public function create_membership($data)
    {
        $do_rebill = FALSE;
        
        $payment['account_id'] = $this->config['account']['account_id'];
        $payment['site_tag'] = $this->config['account']['site_tag'];
        $payment['tran_type'] = 'S';
        $payment['pay_type'] = 'C';
        
        $membership = ORM::factory('membership', $data['plan']);
        
        if (! $membership->loaded() OR $membership->active == 'No')
        {
            return 'Invalid plan selected, please select another or contact support.';
        }
        else
        {
            if ($data['action'] == 'New')
            {
                $payment['amount'] = $membership->initial_amount;
                $payment['description'] = 'Membership Plan ' . $membership . ' - ' . $membership->type . ' Membership $' . $membership->initial_amount . ' - Free Credits: ' . $membership->credits;

                $payment['member_username'] = Core::$user->username;
                $payment['member_duration'] = $membership->initial_period;

                if ( ! is_null($membership->rebill_period))
                {
                    $payment['recurring_amount'] = $membership->rebill_amount;
                    $payment['recurring_period'] = $membership->rebill_period;
                }
            }
            else
            {
                if ( ! is_null($membership->rebill_amount))
                {
                    $payment['amount'] = number_format($membership->initial_amount - Core::$user->membership->initial_amount, 2);
                    $payment['description'] = 'Membership Plan ' . $membership . ' - ' . $membership->type . ' Upgrade Membership $' . number_format($membership->initial_amount - Core::$user->membership->initial_amount, 2) . ' - Free Credits: ' . ($membership->credits - Core::$user->membership->credits);
                }
                else 
                {
                    $payment['amount'] = (Core::$user->membership->type == 'Silver' AND $membership->type == 'Gold') ? '40.00' : (Core::$user->membership->type == 'Gold') ? '40.00' : '75.00';
                    $payment['description'] = 'Membership Plan ' . $membership . ' - ' . $membership->type . ' Upgrade Membership $' . ((Core::$user->membership->type == 'Silver' AND $membership->type == 'Gold') ? '40.00' : (Core::$user->membership->type == 'Gold') ? '40.00' : '75.00') . ' - Free Credits: ' . ((Core::$user->membership->type == 'Silver' AND $membership->type == 'Gold') ? '50' : (Core::$user->membership->type == 'Gold') ? '100' : '150');
                }
            }
        }

        $payment['card_number'] = str_replace(array('-', '.', ' '), '', $data['cc_num']);
        $payment['card_expire'] = $data['exp_month'] . '' . $data['exp_year'];
        $payment['card_cvv2'] = $data['cvv2_num'];

        $payment['bill_name1'] = $data['first_name'];
        $payment['bill_name2'] = $data['last_name'];
        $payment['bill_street'] = $data['address'] . ' ' . $data['address2'];
        $payment['bill_zip'] = $data['zip_code'];
        $payment['bill_city'] = $data['city'];
        $payment['bill_state'] = $data['state'];
        $payment['bill_country'] = $data['country'];
        
        $payment['cust_email'] = Core::$user->email;
        $payment['cust_ip'] = $_SERVER["REMOTE_ADDR"];
        $payment['cust_browser'] = $_SERVER["HTTP_USER_AGENT"]; 

        $post_str ='';
        foreach($payment as $k => $v) {
            if(!empty($post_str))
                $post_str .= '&';
            $post_str .= $k.'='.urlencode($v);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->config['gateway_url']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 90);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_str);
        curl_setopt($ch, CURLOPT_NOBODY, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSLVERSION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_ENCODING, "x-www-form-urlencoded");

        $res = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $resp = explode("\n\r\n", $res);
        $header = explode("\n", $resp[0]);
        parse_str($resp[1], $result);
        
        if($http_code == '200')
        {
            $status_code = $result['status_code'];
            $auth_msg = $result['auth_msg'];

            if($status_code == '0' || $status_code == 'F') {
                $result = $auth_msg;
            } else if($status_code == 'D') {
                $result = "Duplicate Transaction";
            } else {
                if ($data['action'] == 'Update' AND ! is_null($membership->rebill_amount))
                {
                    $this->update_membership(number_format(Core::$user->membership->initial_amount + ($membership->initial_amount - Core::$user->membership->initial_amount), 2));
                }
                
                Core::$user->membership_id = $membership;

                if ($data['action'] == 'New')
                {
                    $prev_member = Core::$user->transactions->where('auth_type', '=', 'Sale')->where('trans_type', '=', 'New')->order_by('added', 'DESC')->limit(1)->find();
                    
                    if ( ! $prev_member->loaded())
                    {
                        Stats::add_member(Core::$user->affiliate, Core::$user->sub_id, $payment['amount']);
                    }

                    Core::$user->member_id = $result['member_id'];

                    $prev_transaction = Core::$user->transactions->where('auth_type', '=', 'Sale')->where('added', '>=', strtotime('-2 months'))->order_by('added', 'DESC')->limit(1)->find();

                    if ( ! $prev_transaction->loaded() OR $prev_transaction->membership->status < $membership->status)
                    {
                        Core::$user->credits += $membership->credits;
                    }
                }
                else
                {
                    if (! is_null($membership->rebill_amount))
                    {
                        Core::$user->credits += ($membership->credits - Core::$user->membership->credits);
                    }
                    else
                    {
                        Core::$user->credits += ((Core::$user->membership->type == 'Silver' AND $membership->type == 'Gold') ? '50' : (Core::$user->membership->type == 'Gold') ? '100' : '150');
                    }
                }

                Core::$user->save();
            }
        } else {
            $result = substr($header[0], 13);
        }    

        return $result;
    }
    
    public function update_membership($price)
    {
        $payment['C_ACCOUNT'] = $this->config['account']['account_id'] . ':' . $this->config['account']['site_tag'];
        $payment['C_MEMBER_LOGIN'] = Core::$user->username;
        $payment['C_CONTROL_KEYWORD'] = $this->config['account']['access_keyword'];
        $payment['C_COMMAND'] = 'SET';
        $payment['C_WRITABLE_FIELDS'] = 'R_NEXT_AMOUNT R_RECURRING_AMOUNT';
        $payment['R_NEXT_AMOUNT'] = $price;
        $payment['R_RECURRING_AMOUNT'] = $price;

        $post_str ='';
        foreach($payment as $k => $v) {
            if(!empty($post_str))
                $post_str .= '&';
            $post_str .= $k.'='.urlencode($v);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->config['update_url']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 90);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_str);
        curl_setopt($ch, CURLOPT_NOBODY, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSLVERSION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_ENCODING, "x-www-form-urlencoded");

        $res = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    }

    public function buy_credits($data)
    {
        $do_rebill = FALSE;
        
        $payment['account_id'] = $this->config['account']['account_id'];
        $payment['site_tag'] = $this->config['account']['site_tag'];
        $payment['tran_type'] = 'S';
        $payment['pay_type'] = 'C';
        
        $membership = ORM::factory('membership', $data['package']);
        
        if (! $membership->loaded())
        {
            return 'Invalid package selected, please select another or contact support.';
        }
        else
        {
            $payment['amount'] = $membership->initial_amount;
            $payment['description'] = 'Credit Package ' . $membership . ' - ' . $membership->type . ' $' . $membership->initial_amount;
        }

        $payment['card_number'] = str_replace(array('-', '.', ' '), '', $data['cc_num']);
        $payment['card_expire'] = $data['exp_month'] . '' . $data['exp_year'];
        $payment['card_cvv2'] = $data['cvv2_num'];

        $payment['bill_name1'] = $data['first_name'];
        $payment['bill_name2'] = $data['last_name'];
        $payment['bill_street'] = $data['address'] . ' ' . $data['address2'];
        $payment['bill_zip'] = $data['zip_code'];
        $payment['bill_city'] = $data['city'];
        $payment['bill_state'] = $data['state'];
        $payment['bill_country'] = $data['country'];
        
        $payment['cust_email'] = Core::$user->email;
        $payment['cust_ip'] = $_SERVER["REMOTE_ADDR"];
        $payment['cust_browser'] = $_SERVER["HTTP_USER_AGENT"]; 

        $post_str ='';
        foreach($payment as $k => $v) {
            if(!empty($post_str))
                $post_str .= '&';
            $post_str .= $k.'='.urlencode($v);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->config['gateway_url']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 90);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_str);
        curl_setopt($ch, CURLOPT_NOBODY, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSLVERSION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_ENCODING, "x-www-form-urlencoded");

        $res = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $resp = explode("\n\r\n", $res);
        $header = explode("\n", $resp[0]);
        parse_str($resp[1], $result);
        
        if($http_code == '200')
        {
            $status_code = $result['status_code'];
            $auth_msg = $result['auth_msg'];

            if($status_code == '0' || $status_code == 'F') {
                $result = $auth_msg;
            } else if($status_code == 'D') {
                $result = "Duplicate Transaction";
            } else {
                Core::$user->credits += $membership->credits;
                Core::$user->save();
            }
        } else {
            $result = substr($header[0], 13);
        }    

        return $result;
    }

    
    public function prase_dri($before, $after)
    {
        $payment['account_id'] = $this->config['account']['account_id'];
        $payment['site_tag'] = $this->config['account']['site_tag'];
        $payment['authorization'] = $this->config['account']['dri_authorization'];
        $payment['transactions_after'] = $before;
        $payment['transactions_before'] = $after;

        $post_str ='';
        foreach($payment as $k => $v) {
            if(!empty($post_str))
                $post_str .= '&';
            $post_str .= $k.'='.urlencode($v);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->config['dri_url']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'DRIClient/Version:2010.05');
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 90);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_str);
        curl_setopt($ch, CURLOPT_NOBODY, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSLVERSION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_ENCODING, "x-www-form-urlencoded");

        $res = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $resp = explode("\n\r\n", $res);
        //$header = explode("\n", $resp[0]);
        //parse_str($resp[1], $result);
        
        echo $resp[0] . "\n";
        
        return $resp[1];
    }
}
?>