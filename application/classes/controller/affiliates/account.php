<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Affiliates_Account extends Controller_Master
{
    public $template = 'affiliates';

    public function action_edit()
    {
        $this->add_javascript(Functions::src_file('assets/js/swurve.affiliates.js'));
        $this->add_stylesheet(Functions::src_file('assets/css/jquery-ui.min.css'), 'screen');

        $this->template->content = View::factory('affiliates/forms/edit_account')->bind('post', $post)->bind('errors', $errors)->bind('location', $location);

        if ($_POST)
        {
            $post = $_POST;

            if (! isset($post['mailstatus']))
            {
                $post['mailstatus'] = 1;
            }

            if (empty($post['country_id']))
            {
                unset($post['country_id']);
            }

            if (empty($post['region_id']))
            {
                unset($post['region_id']);
            }

            if (empty($post['city']) || $post['city'] == 'Enter A City')
            {
                unset($post['city']);
            }

            if (empty($post['password']) AND empty($post['password_confirm']))
            {
                unset($post['password']);
                unset($post['password_confirm']);
            }

            $validate = Validate::factory($post)
                ->filter(TRUE, 'trim')
                ->label('first_name', 'First Name')
                ->label('last_name', 'Last Name')
                ->label('email', 'Email')
                ->label('address', 'Address')
                ->label('country_id', 'Country')
                ->label('zip_code', 'Postal Code')
                ->label('program', 'Program')
                ->label('payment_method', 'Payment Method')
                ->rules('first_name', array('not_empty' => NULL))
                ->rules('last_name', array('not_empty' => NULL))
                ->rules('email', array('not_empty' => NULL, 'email' => array(TRUE)))
                ->rules('address', array('not_empty' => NULL))
                ->rules('country_id', array('not_empty' => NULL))
                ->rules('zip_code', array('not_empty' => NULL))
                ->rules('program', array('not_empty' => NULL))
                ->rules('payment_method', array('not_empty' => NULL));

            $region_count = 0;

            if (isset($post['country_id']))
            {
                $sql = "SELECT r.id, r.name
                        FROM regions r, countries c
                        WHERE r.country_code = c.code AND c.id = '" . $post['country_id'] . "'
                        ORDER BY r.name ASC";

                if ($region_count = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->count() > 0)
                {
                    $validate = $validate->label('region_id', 'Region')->rules('region_id', array('not_empty' => NULL));
                }
                else
                {
                    $validate = $validate->label('city', 'City')->rules('city', array('not_empty' => NULL));
                }

                if ($post['country_id'] == 233)
                {
                    $validate = $validate->label('ssn_tax_id', 'SS#/Tax ID')->rules('ssn_tax_id', array('not_empty' => NULL));
                }
            }

            if (isset($post['country_id']) AND isset($post['region_id']))
            {
                $sql = "SELECT ci.id, ci.full_name
                        FROM cities ci, regions r, countries c
                        WHERE ci.region_code = r.code AND ci.country_code = c.code AND c.id = '" . $post['country_id'] . "' AND r.id = '" . $post['region_id'] . "'
                        ORDER BY ci.name ASC";

                if (DB::query(Database::SELECT, $sql)->cached(3600)->execute()->count() > 0)
                {
                    $validate = $validate->label('city', 'City')->rules('city', array('not_empty' => NULL));
                }
            }

            if (isset($post['payment_method']) AND $post['payment_method'] == 'ePassporte')
            {
                $validate = $validate->label('payment_method_account', 'ePassporte ID')->rules('payment_method_account', array('not_empty' => NULL));
            }

            if (array_key_exists('password', $post) OR array_key_exists('password_confirm', $post))
            {
                $validate = $validate
                    ->label('password', 'New Password')
                    ->label('password_confirm', 'Confirm Pass')
                    ->rules('password', array('not_empty' => NULL, 'min_length' => array(6)))
                    ->rules('password_confirm', array('matches' => array('password')));
            }

            if ($validate->check())
            {
                if (! isset($post['country_id']))
                {
                    Core::$affiliate->country_id = NULL;
                }

                if (! isset($post['region_id']))
                {
                    Core::$affiliate->region_id = NULL;
                }

                Core::$affiliate->values($post);

                Core::$affiliate->save();

                Notify::set('pass', 'Your account information has been changed.');

                Request::instance()->redirect('affiliates');
            }
            else
            {
                $errors = $validate->errors('affiliate');
            }
        }
        else
        {
            $post = ORM::factory('affiliate', Core::$affiliate)->as_array();
            $post['password'] = '';
            $post['password_confirm'] = '';
        }

        $sql = "SELECT id, name
                FROM countries
                ORDER BY CASE name WHEN 'United States' THEN 0 WHEN 'Canada' THEN 1 WHEN 'United Kingdom' THEN 2 WHEN 'Australia' THEN 3 ELSE 4 END ASC, name ASC";

        $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

        $location['country'] = array('' => 'Select A Country') + $data;

        $data = array();

        if (isset($post['country_id']))
        {
            $sql = "SELECT r.id, r.name
                    FROM regions r, countries c
                    WHERE r.country_code = c.code AND c.id = '" . $post['country_id'] . "'
                    ORDER BY r.name ASC";

            $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');
        }

        $location['region'] = array('' => 'Select A Region') + $data;

        $data = array();

        if (isset($post['country_id']) AND isset($post['region_id']))
        {
            $sql = "SELECT ci.id, ci.full_name
                    FROM cities ci, regions r, countries c
                    WHERE ci.region_code = r.code AND ci.country_code = c.code AND c.id = '" . $post['country_id'] . "' AND r.id = '" . $post['region_id'] . "'
                    ORDER BY ci.name ASC";

            $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'full_name');
        }
        elseif (isset($post['country_id']) AND count($data) == 0)
        {
            $sql = "SELECT ci.id, ci.full_name
                    FROM cities ci, regions r, countries c
                    WHERE ci.region_code = r.code AND ci.country_code = c.code AND c.id = '" . $post['country_id'] . "' AND r.code = '00'
                    ORDER BY ci.name ASC";

            $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'full_name');
        }

        $location['city'] = array('' => 'Select A City') + $data;
    }


    public function action_create()
    {
        $this->add_javascript(Functions::src_file('assets/js/swurve.affiliates.js'));
        $this->add_stylesheet(Functions::src_file('assets/css/jquery-ui.min.css'), 'screen');

        $this->template->content = View::factory('affiliates/forms/register')->bind('post', $post)->bind('errors', $errors)->bind('location', $location);

        $sql = "SELECT id, name
                FROM countries
                ORDER BY CASE name WHEN 'United States' THEN 0 WHEN 'Canada' THEN 1 WHEN 'United Kingdom' THEN 2 WHEN 'Australia' THEN 3 ELSE 4 END ASC, name ASC";

        $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

        $location['country'] = array('' => 'Select A Country') + $data;
        $location['region'] = array('' => 'Select A Region');
        $location['city'] = array('' => 'Select A City');

        if ($_POST)
        {
            $post = $_POST;

            if (empty($post['country_id']))
            {
                unset($post['country_id']);
            }

            if (empty($post['region_id']))
            {
                unset($post['region_id']);
            }

            if (empty($post['city']) || $post['city'] == 'Enter A City')
            {
                unset($post['city']);
            }

            $affiliate = ORM::factory('affiliate')->values($post);

            if ($affiliate->check())
            {
                $affiliate->signup_ip = $_SERVER['REMOTE_ADDR'];
                $affiliate->referral_id = Cookie::get('referral', NULL);

                $affiliate->save();

                Mailer::factory('affiliate')->send_welcome($affiliate);

                $affiliate->login($post, '/affiliates');
            }
            else
            {
                $errors = $affiliate->validate()->errors('affiliate');

                if (isset($post['country_id']))
                {
                    $sql = "SELECT r.id, r.name
                            FROM regions r, countries c
                            WHERE r.country_code = c.code AND c.id = '" . $post['country_id'] . "'
                            ORDER BY r.name ASC";

                    $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

                    $location['region'] += $data;
                }

                if (isset($post['country_id']) AND isset($post['region_id']))
                {
                    $sql = "SELECT ci.id, ci.full_name
                            FROM cities ci, regions r, countries c
                            WHERE ci.region_code = r.code AND ci.country_code = c.code AND c.id = '" . $post['country_id'] . "' AND r.id = '" . $post['region_id'] . "'
                            ORDER BY ci.name ASC";

                    $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'full_name');

                    $location['city'] = array('' => 'Select A City') + $data;
                }
                elseif(isset($post['country_id']))
                {
                    $sql = "SELECT r.id, r.name
                        FROM regions r, countries c
                        WHERE r.country_code = c.code AND c.id = '" . $post['country_id'] . "'
                        ORDER BY r.name ASC";

                    if (DB::query(Database::SELECT, $sql)->cached(3600)->execute()->count() == 0)
                    {
                        $sql = "SELECT ci.id, ci.full_name
                                FROM cities ci, regions r, countries c
                                WHERE ci.region_code = r.code AND ci.country_code = c.code AND c.id = '" . $post['country_id'] . "' AND r.code = '00'
                                ORDER BY ci.name ASC";

                        $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'full_name');

                        $location['city'] = array('' => 'Select A City') + $data;
                    }
                }
            }
        }
    }

    public function action_login($redirect = 'affiliates')
    {
        $this->template->head->meta_title = 'Affiliate Login';
        $this->template->content = View::factory('affiliates/forms/login')->bind('post', $post)->bind('errors', $errors);

        if ($_POST)
        {
            $post = $_POST;

            ORM::factory('affiliate')->login($post, $redirect);

            $errors = $post->errors('register');
        }
    }

    function action_logout()
    {
        Core::$auth->logout();

        Request::instance()->redirect('affiliates');
    }

    function action_support($page = '')
    {
        $this->template->head->meta_title = 'Affiliate Support';
        $this->template->content = View::factory('affiliates/support')->bind('page', $page);
    }

    function action_rewards($page = '')
    {
        $this->template->head->meta_title = 'Affiliate Rewards';
        $this->template->content = View::factory('affiliates/rewards');
    }

    function action_resetpass($params = NULL)
    {
        $params = explode('/', $params);

        if (count($params) <= 1)
        {
            $this->template->head->meta_title = 'Reset Password';
            $this->template->content = View::factory('affiliates/forms/reset-password')->bind('post', $post)->bind('errors', $errors);

            $post['email'] = $params[0];

            if ($_POST)
            {
                $post = $_POST;

                $validate = Validate::factory($post)
                    ->filter(TRUE, 'trim')
                    ->label('email', 'Email')
                    ->rules('email', array('not_empty' => NULL, 'email' => array(TRUE)));

                if ($validate->check())
                {
                    $affiliate = ORM::factory('affiliate', array('email' => $post['email']));

                    if ($affiliate->loaded())
                    {
                        Mailer::factory('affiliate')->send_resetpass($affiliate);

                        Notify::set('pass', 'A reset password request for ' . $affiliate->email . ' was sent to the registered email address on record for that account.');
                    }

                    Request::instance()->redirect('affiliates/account/resetpass/' . strtolower($affiliate->email));
                }
                else
                {
                    $errors = $validate->errors('register');
                }

            }
        }
        else
        {
            $this->template->head->meta_title = 'Reset Password Confirmed';
            $this->template->content = View::factory('affiliates/forms/reset-password-confirm')->bind('affiliate', $affiliate);

            $affiliate = ORM::factory('affiliate', array('email' => $params[0]));

            if ($affiliate->loaded() AND $affiliate->password == $params[1])
            {
                $new_password = Text::random();

                $affiliate->password = $new_password;

                Mailer::factory('affiliate')->send_resetpassconfirm($affiliate);

                $affiliate->save();
            }
            else
            {
                Request::instance()->redirect('/');
            }
        }
    }

    function action_unsubscribe($email = NULL)
    {
        $this->template->head->meta_title = 'Unsubscribe';
        $this->template->content = View::factory('affiliates/forms/unsubscribe')->bind('post', $post)->bind('errors', $errors);

        $post['email'] = $email;

        if ($_POST)
        {
            $post = $_POST;

            $validate = Validate::factory($post)
                ->filter(TRUE, 'trim')
                ->label('email', 'Email')
                ->rules('email', array('not_empty' => NULL, 'email' => array(FALSE)));

            if ($validate->check())
            {
                $sql = 'UPDATE affiliates SET mailstatus = 1 WHERE email = \'' . Security::xss_clean($post['email']) . '\'';

                if (DB::query(Database::UPDATE, $sql)->execute() > 0)
                {
                    Notify::set('pass', Security::xss_clean($post['email']) . ' has been unsubscribed from all future mailings');
                }
                else
                {
                    Notify::set('info', Security::xss_clean($post['email']) . ' could not be found in the system or already unsubscribed');
                }

                Request::instance()->redirect('affiliates/account/unsubscribe');
            }
            else
            {
                $errors = $validate->errors('register');
            }
        }
    }
}
