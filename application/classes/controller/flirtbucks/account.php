<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Flirtbucks_Account extends Controller_Master
{
    public $template = 'flirtbucks';
    
    public function action_test()
    {
        Mailer::factory('flirtbucks')->send_welcome(Core::$camgirl);
        echo 'Welcome email sent<br />';
        exit();

        Mailer::factory('flirtbucks')->send_activated(Core::$camgirl);
        echo 'Activation email sent<br />';
        exit();
    }

    public function action_edit()
    {
        $this->add_javascript(Functions::src_file('assets/js/swurve.affiliates.js'));
        $this->add_stylesheet(Functions::src_file('assets/css/jquery-ui.min.css'), 'screen');
        
        $this->template->content = View::factory('flirtbucks/forms/edit_account')->bind('post', $post)->bind('errors', $errors)->bind('location', $location);

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
                ->label('payment_method', 'Payment Method')
                ->rules('first_name', array('not_empty' => NULL))
                ->rules('last_name', array('not_empty' => NULL))
                ->rules('email', array('not_empty' => NULL, 'email' => array(TRUE)))
                ->rules('address', array('not_empty' => NULL))
                ->rules('country_id', array('not_empty' => NULL))
                ->rules('zip_code', array('not_empty' => NULL))
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
            
            if (isset($post['payment_method']) AND $post['payment_method'] == 'Paypal')
            {
                $validate = $validate->label('payment_method_account', 'Paypal Email')->rules('payment_method_account', array('not_empty' => NULL));
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
                    Core::$camgirl->country_id = NULL;
                }

                if (! isset($post['region_id']))
                {
                    Core::$camgirl->region_id = NULL;
                }

                Core::$camgirl->values($post);

                Core::$camgirl->save();

                Notify::set('pass', 'Your account information has been changed.');

                Request::instance()->redirect('/');
            }
            else
            {
                $errors = $validate->errors('flirtbucks');
            }
        }
        else
        {
            $post = ORM::factory('camgirl', Core::$camgirl)->as_array();
            $post['password'] = '';
            $post['password_confirm'] = '';
            
            $post['birthmonth'] = date('m', $post['birthdate']);
            $post['birthday'] = date('d', $post['birthdate']);
            $post['birthyear'] = date('Y', $post['birthdate']);
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
        elseif (isset($post['country_id']) AND $region_count == 0)
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
        
        $this->template->content = View::factory('flirtbucks/forms/register')->bind('post', $post)->bind('errors', $errors)->bind('location', $location);

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
            
            $camgirl = ORM::factory('camgirl')->values($post);

            if ($camgirl->check())
            {
                if ($post['account'] == 'manager')
                {
                    $camgirl->disclosure_agreement = 'Yes';
                    $camgirl->status = 'Approved';
                }

                $camgirl->birthdate = strtotime($post['birthyear'] . '-' . $post['birthmonth'] . '-' . $post['birthday']);
                $camgirl->signup_ip = $_SERVER['REMOTE_ADDR'];
                $camgirl->referral_id = Cookie::get('referral', NULL);

                $camgirl->save();

                Mailer::factory('flirtbucks')->send_welcome($camgirl);

                //Mailer::factory('camgirl')->send_welcome($affiliate);

                $camgirl->login($post, '/');
            }
            else
            {
                $errors = $camgirl->validate()->errors('flirtbucks');

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
    
    public function action_login($redirect = '/')
    {
        $this->template->head->meta_title = 'Flirtbucks Login';
        $this->template->content = View::factory('flirtbucks/forms/login')->bind('post', $post)->bind('errors', $errors);

        $redirect = str_replace('/account/login', '', $_SERVER['REQUEST_URI']);
        $redirect = empty($redirect) ? '/' : $redirect;

        if ($_GET)
        {
            list($email, $password) = explode('/', $_SERVER['QUERY_STRING']);
            
            $camgirl = ORM::factory('camgirl')->where('email', '=', $email)->where('password', '=', $password)->find();
            
            if ($camgirl->loaded())
            {
                Core::$auth->force_login($camgirl);

                $this->request->redirect($redirect);
            }
            else
            {
                $this->request->redirect('/');
            }            
        }
        
        if ($_POST)
        {
            $post = $_POST; 

            ORM::factory('camgirl')->login($post, $redirect);
            
            $errors = $post->errors('register');
        }
    }
    
    function action_logout()
    {
        Core::$auth->logout();
        
        Request::instance()->redirect('/');
    }
    
    function action_support($page = '')
    {
        $this->template->head->meta_title = 'Flirtbucks Support';
        $this->template->content = View::factory('flirtbucks/support')->bind('page', $page);
    }

    function action_faq($page = '')
    {
        $this->template->head->meta_title = 'Flirtbucks FAQ';
        $this->template->content = View::factory('flirtbucks/faq')->bind('page', $page);
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
