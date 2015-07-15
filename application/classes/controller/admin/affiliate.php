<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Admin_Affiliate extends Controller_Master
{
    function before() 
    {
        if ($this->request->action == 'getstats')
        {
            $this->template = 'template2';
        }
        
        parent::before();

        Functions::check_loggedin(TRUE, TRUE);
    }

    function action_getstats()
    {
        $this->template->head->stylesheets = array(
	        Functions::src_file('assets/css/layout2.css') => 'screen',
	        Functions::src_file('assets/css/swurve.affiliates.css') => 'screen',
	        Functions::src_file('assets/css/swurve.css') => 'screen'
        );

        $this->template->content = View::factory('admin/affiliate/stats')->bind('data', $data)->bind('totals', $totals)->bind('commission', $commission)->bind('affiliates', $affiliates)->bind('affiliate', $affiliate);

        $affiliates = ORM::factory('affiliate')->select(new Database_Expression('CONCAT(first_name, \' \', last_name) AS name'))->find_all()->as_array('id', 'name');
        
        if ($_POST)
        {
            $post = $_POST;
            
            $site = (isset($post['site']) AND ! empty($post['site'])) ? $post['site'] : null;
            $affiliate = ORM::factory('affiliate', array('id' => $post['id']));

            $range = ORM::factory('affiliate_payout')->where(new Database_Expression(strtotime('est today')), 'BETWEEN', new Database_Expression('start AND end'))->find();
            
            $totals = $affiliate->affiliate_stats->get_totals($site, $affiliate->program);
            $data = $affiliate->affiliate_stats->get_stats_daterange($site, $range);

            $commission = $affiliate->pending_commission;

            if ($affiliate->program == 'PPS')
            {
                $commission += Functions::calc_pps_commission($data['Memberships']);
            }
            elseif ($affiliate->program == 'Revshare')
            {
                $commission += Functions::calc_revshare_commission($data['Memberships'], $data['RebillingAmount'], $data['MembershipAmount']);
            }
            elseif (strpos($affiliate->program, 'PPS') !== FALSE )
            {
                $commission += Functions::calc_pps_flatrate_commission($data['Memberships'], $affiliate->program);
            }
            elseif (strpos($affiliate->program, 'Revshare') !== FALSE )
            {
                $commission += Functions::calc_revshare_flatrate_commission($data['Memberships'], $data['RebillingAmount'], $data['MembershipAmount'], $affiliate->program);
            }

            $brokers = ORM::factory('affiliate')->where('referral_id', '=', $affiliate)->find_all();

            foreach($brokers as $broker)
            {
                $broker_commission = 0.00;
                $data2 = $broker->affiliate_stats->get_stats_daterange($site, $range);

                if ($broker->program == 'PPS')
                {
                    $broker_commission += Functions::calc_pps_commission($data2['Memberships']);
                }
                elseif ($broker->program == 'Revshare')
                {
                    $broker_commission += Functions::calc_revshare_commission($data2['Memberships'], $data2['RebillingAmount'], $data2['MembershipAmount']);
                }
                elseif (strpos($broker->program, 'PPS') !== FALSE )
                {
                    $broker_commission += Functions::calc_pps_flatrate_commission($data2['Memberships'], $broker->program);
                }
                elseif (strpos($broker->program, 'Revshare') !== FALSE )
                {
                    $broker_commission += Functions::calc_revshare_flatrate_commission($data2['Memberships'], $data2['RebillingAmount'], $data2['MembershipAmount'], $broker->program);
                }

                $commission += number_format($broker_commission * .10, 2);
            }
        }
    }
    
    function action_pendingpayouts()
    {
        $this->template->content = View::factory('admin/affiliate/pendingpayouts')->bind('affiliates', $affiliates);
        
        if ($_POST)
        {
            $post = $_POST;
            
            foreach($post['paid'] as $paidaffiliate)
            {
                $affiliate = ORM::factory('affiliate', array('id' => $paidaffiliate));
                
                if ($affiliate->loaded())
                {
                    $payment = ORM::factory('affiliate_payment');
                    $payment->affiliate_id = $affiliate;
                    $payment->date = time();
                    $payment->amount = $affiliate->pending_commission;
                    $payment->method = $affiliate->payment_method;
                    $payment->save();
                    
                    $affiliate->total_commission += $affiliate->pending_commission;
                    $affiliate->pending_commission = 0.00;
                    $affiliate->save();

                    Notify::set('pass', 'Affiliates total commissions have been updated with pending commissions and pending comissions reset to 0.00');
                    Request::instance()->redirect(Request::$referrer);
                }
            }
        }
        
        $affiliates = ORM::factory('affiliate')->where('pending_commission', '>=' , 50.00)->find_all();
    }
    
    function action_newcategory()
    {
        $this->template->content = View::factory('admin/affiliate/newcategory')->bind('active', $active)->bind('disabled', $disabled);

        if ($_POST)
        {
            $post = $_POST;

            if ( ! empty($post['name']))
            {
                $category = ORM::factory('affiliate_category')->values($post);

                $category->save();
                
                Notify::set('pass', 'Added new category "' . $post['name'] . '".');

                Request::instance()->redirect('admin/affiliate/newcategory');
            }
        }
        
        $active = ORM::factory('affiliate_category')->where('active', '=', 'Yes')->find_all()->as_array('id', 'name');
        $disabled = ORM::factory('affiliate_category')->where('active', '=', 'No')->find_all()->as_array('id', 'name');
    }
    
    function action_newbanners() 
    {
        $this->template->content = View::factory('admin/affiliate/newbanners')->bind('categories', $categories);

        if ($_POST)
        {
            $post = $_POST;
            $uploaded = 0;
            
            for($i = 1; $i <= $post['total']; $i++)
            {
                if ($_FILES['file' . $i]['error'] == '0')
                {
                    $uploaded += 1;
                    $unique_file = time() . '_' . $_FILES['file' . $i]['name'];
                    $path = Upload::save($_FILES['file' . $i], $unique_file, '/home/solarisdev/public_html/public/assets/img/affiliates/bannerads/' . date('Y'), 0777);
                    
                    $banner = ORM::factory('affiliate_bannerad');
                    $banner->image_path = 'assets/img/affiliates/bannerads/' . date('Y') . '/' . $unique_file;
                    $banner->code = $post['code' . $i];
                    $banner->active = $post['active' . $i];
                    
                    $banner->save();
                    
                    foreach($post['categories' . $i] as $category)
                    {
                        $banner->add('affiliate_categories', ORM::factory('affiliate_category', $category));
                    }
                }
            }
            
            Notify::set('pass', 'Added ' . $uploaded . ' new banner(s).');

            Request::instance()->redirect('admin/affiliate/newbanners');
        }
        
        //$categories = ORM::factory('affiliate_category')->where('active', '=', 'Yes')->find_all()->as_array('id', 'name');
        $categories = array('Type of Banner' => array(1 => 'Static', 2 => 'Animated', 3 => 'Geo Targeted', 18 => 'Flash', 22 => 'Broker'), 'Orientation of Banner' => array(4 => 'Horizontal', 5 => 'Vertical'), 'Targeted To' => array(19 => 'Men', 20 => 'Women', 21 => 'Both'), 'Nudity' => array(6 => 'Nudity', 7 => 'No Nudity'), 'Size of Banner' => array(8 => '468x60', 9 => '728x90', 10 => '120x600', 11 => '160x600', 12 => '300x250', 14 => '150x150', 15 => '125x125', 16 => '120x60', 17 => 'Other'));
    }
}