<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Credits extends Controller_Master
{
    function before()
    {
        $this->secure = TRUE;

        $this->template = 'upgrade';

        parent::before();

        Functions::check_loggedin();
    }

    public function check_cvv2(Validate $array, $field)
    {
        if ( ! array_key_exists('no_cvv2', $_POST) AND empty($array[$field]))
        {
            $array->error('cvv2_num', 'not_empty');
        }
    }

    public function check_state(Validate $array, $field)
    {
        if ( ! empty($array['country']) AND $array['country'] == 'US' AND empty($array[$field]))
        {
            $array->error('state', 'not_empty');
        }
    }

    function action_buy()
    {
        if (Core::$user->membership->type == 'Trial') Request::instance()->redirect('user/register/welcome');
        if (Core::$user->membership->type == 'Free') Request::instance()->redirect('user/upgrade');

        $this->add_stylesheet(Functions::src_file('assets/css/upgrade.css'), 'screen');

        $this->template->head->meta_title = 'Buy Credits';
        $this->template->content = View::factory('forms/credits')->bind('post', $post)->bind('reason', $reason)->bind('errors', $errors)->bind('exp_months', $exp_months)->bind('exp_years', $exp_years)->bind('countries', $countries)->bind('states', $states);

        if ($_POST)
        {
            $post = $_POST;

            $valid = Validate::factory($_POST)
                ->rule('package', 'not_empty')
                ->rule('first_name', 'not_empty')
                ->rule('last_name', 'not_empty')
                ->rule('cc_num', 'not_empty')
                ->rule('exp_month', 'not_empty')
                ->rule('exp_year', 'not_empty')
                ->rule('email_address', 'not_empty')
                ->rule('address', 'not_empty')
                ->rule('city', 'not_empty')
                ->rule('country', 'not_empty')
                ->rule('zip_code', 'not_empty')
                ->callback('cvv2_num', array($this, 'check_cvv2'))
                ->callback('state', array($this, 'check_state'));

            if($valid->check())
            {
                $netbilling = Merchant::factory('netbilling')->buy_credits($post);

                $transaction = ORM::factory('transaction');
                $transaction->user_id = Core::$user;
                $transaction->membership_id = $post['package'];
                $transaction->first_name = $post['first_name'];
                $transaction->last_name = $post['last_name'];
                $transaction->trans_type = 'Credits';

                if ( ! is_array($netbilling))
                {
                    $transaction->auth_msg = $netbilling;
                    $transaction->auth_type = 'Fail';

                    if($netbilling == 'BAD ADDRESS') {
                        $reason = "Invalid Address";
                    } else if($netbilling == 'CVV2 MISMATCH') {
                        $reason = "Invalid CVV2";
                    } else if($netbilling == 'A/DECLINED') {
                        $reason = "You have tried too many times.";
                    } else if($netbilling == 'B/DECLINED') {
                        $reason = "Please contact support.";
                    } else if($netbilling == 'C/DECLINED') {
                        $reason = "Please contact support.";
                    } else if($netbilling == 'E/DECLINED') {
                        $reason = "Your email address is invalid.";
                    } else if($netbilling == 'J/DECLINED') {
                        $reason = "Your information is invalid.";
                    } else if($netbilling == 'L/DECLINED') {
                        $reason = "Invalid Address";
                    } else {
                        $reason = "Your card was declined.";
                    }
                }
                else
                {
                    $transaction->auth_msg = $netbilling['auth_msg'];
                    $transaction->auth_type = 'Sale';
                    $transaction->trans_id = $netbilling['trans_id'];

                    $this->template->content = View::factory('forms/credit-success')->bind('membership', $membership);

                    $membership = ORM::factory('membership', $post['package']);
                }

                $transaction->ip_address = $_SERVER['REMOTE_ADDR'];
                $transaction->save();
            }
            else
            {
                $errors = $valid->errors('validate');
            }
        }

        $exp_months = array (
            '' => 'Month',
            '01' => 'January',
            '02' => 'February',
            '03' => 'March',
            '04' => 'April',
            '05' => 'May',
            '06' => 'June',
            '07' => 'July',
            '08' => 'August',
            '09' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December'
        );

        $exp_years = range(date('y'), date('y') + 10);
        $exp_years = array('' => 'Year') + array_combine(array_values($exp_years), array_values($exp_years));

        $sql = "SELECT code, name
                FROM countries
                ORDER BY CASE name WHEN 'United States' THEN 0 WHEN 'Canada' THEN 1 WHEN 'United Kingdom' THEN 2 WHEN 'Australia' THEN 3 ELSE 4 END ASC, name ASC";

        $countries = array('' => 'Select Country') + DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('code', 'name');

        $states = array (
            ''    =>  'Select State - US Residents',
            'AL'  =>  'Alabama',
            'AK'  =>  'Alaska',
            'AZ'  =>  'Arizona',
            'AR'  =>  'Arkansas',
            'CA'  =>  'California',
            'CO'  =>  'Colorado',
            'CT'  =>  'Connecticut',
            'DC'  =>  'D.C.',
            'DE'  =>  'Delaware',
            'FL'  =>  'Florida',
            'GA'  =>  'Georgia',
            'HI'  =>  'Hawaii',
            'ID'  =>  'Idaho',
            'IL'  =>  'Illinois',
            'IN'  =>  'Indiana',
            'IA'  =>  'Iowa',
            'KS'  =>  'Kansas',
            'KY'  =>  'Kentucky',
            'LA'  =>  'Louisiana',
            'ME'  =>  'Maine',
            'MD'  =>  'Maryland',
            'MA'  =>  'Massachusetts',
            'MI'  =>  'Michigan',
            'MN'  =>  'Minnesota',
            'MS'  =>  'Mississippi',
            'MO'  =>  'Missouri',
            'MT'  =>  'Montana',
            'NE'  =>  'Nebraska',
            'NV'  =>  'Nevada',
            'NH'  =>  'New Hampshire',
            'NJ'  =>  'New Jersey',
            'NM'  =>  'New Mexico',
            'NY'  =>  'New York',
            'NC'  =>  'North Carolina',
            'ND'  =>  'North Dakota',
            'OH'  =>  'Ohio',
            'OK'  =>  'Oklahoma',
            'OR'  =>  'Oregon',
            'PA'  =>  'Pennsylvania',
            'RI'  =>  'Rhode Island',
            'SC'  =>  'South Carolina',
            'SD'  =>  'South Dakota',
            'TN'  =>  'Tennessee',
            'TX'  =>  'Texas',
            'UT'  =>  'Utah',
            'VT'  =>  'Vermont',
            'VA'  =>  'Virginia',
            'WA'  =>  'Washington',
            'WV'  =>  'West Virginia',
            'WI'  =>  'Wisconsin',
            'WY'  =>  'Wyoming'
        );
    }
}