<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_User extends ORM
{
    protected $_has_one = array('online' => array());
    protected $_belongs_to = array('camgirl' => array('foreign_key' => 'flirtbucks_id'), 'membership' => array(), 'country' => array(), 'region' => array(), 'city' => array(), 'avatar' => array('model' => 'photo'));
    protected $_has_many = array('blocks' => array(), 'transactions' => array(), 'ratings' => array(), 'feeds' => array(), 'photos' => array(), 'videos' => array(), 'views' => array('foreign_key' => 'viewed_id'), 'messages' => array('foreign_key' => 'to_id'), 'contacts' => array('foreign_key' => 'from_id'), 'relationship_types' => array('through' => 'relationship_types_users'));

    protected $_filters = array(TRUE => array('trim' => NULL));
    protected $_rules = array(
        'username' => array('not_empty' => NULL, 'min_length' => array(3), 'max_length' => array(25), 'alpha_dash' => NULL),
        'password' => array('not_empty' => NULL, 'min_length' => array(6)),
        'password_confirm' => array('matches' => array('password')),
        'email' => array('not_empty' => NULL, 'email' => array(TRUE)),
        'gender' => array('not_empty' => NULL),
        //'orientation' => array('not_empty' => NULL),
        //'relationship_status' => array('not_empty' => NULL),
        'country_id' => array('not_empty' => NULL),
        'tos' => array('not_empty' => NULL),
        'interested_in' => array('not_empty' => NULL),
        // 'region_id' => array('not_empty' => NULL),
        //'height' => array('not_empty' => NULL),
        //'body_type' => array('not_empty' => NULL),
        //'hair_color' => array('not_empty' => NULL),
        //'eye_color' => array('not_empty' => NULL),
        //'ethnicity' => array('not_empty' => NULL),
        //'smoke' => array('not_empty' => NULL),
        //'drink' => array('not_empty' => NULL),
        //'first_date_sex' => array('not_empty' => NULL),
    );

    //protected $_callbacks = array('username' => array('unique_user'), 'seeking' => array('check_array'), 'birthdate' => array('valid_date'));
    protected $_callbacks = array('username' => array('unique_user'), 'birthdate' => array('valid_date'));

    protected $_updated_column = array('column' => 'last_updated', 'format' => TRUE);
    protected $_created_column = array('column' => 'signup_date', 'format' => TRUE);

    protected $_ignored_columns = array('password_confirm', 'seeking[]', 'tos');

    public function __construct($id = NULL)
    {
        $this->_labels = array(
            'username' => __('Username'),
            'password' => __('Password'),
            'email' => __('Email'),
            'country_id' => __('Country'),
            'gender' => __('Gender'),
            'birthdate' => __('Birthdate'),
            'interested_in' => __('Interest'),
            'height' => __('Height'),
            'body_type' => __('Body Type'),
            'hair_color' => __('Hair Color'),
            'eye_color' => __('Eye Color'),
            'ethnicity' => __('Ethnicity'),
            'orientation' => __('Orientation'),
            'relationship_status' => __('Status'),
            'smoke' => __('option'),
            'drink' => __('option'),
            'webcam' => __('option'),
            'first_date_sex' => __('option'),
        );

        //$this->_callbacks = array('username' => array($this, 'unique_user'));

        return parent::__construct($id);
    }

    public function check()
    {
        if (isset($this->country_id))
        {
            $sql = "SELECT r.id, r.name
                    FROM regions r, countries c
                    WHERE r.country_code = c.code AND c.id = '" . $this->country_id . "'
                    ORDER BY r.name ASC";

            if (DB::query(Database::SELECT, $sql)->cached(3600)->execute()->count() > 0)
            {
                $this->_labels += array('region_id' => 'Region');
                $this->_rules += array('region_id' => array('not_empty' => NULL));
            }
            else
            {
                $this->_labels += array('city_id' => 'City');
                $this->_rules += array('city_id' => array('not_empty' => NULL));
            }
        }

        if (isset($this->country_id) AND isset($this->region_id))
        {
            $sql = "SELECT ci.id, ci.full_name
                    FROM cities ci, regions r, countries c
                    WHERE ci.region_code = r.code AND ci.country_code = c.code AND c.id = '" . $this->country_id . "' AND r.id = '" . $this->region_id . "'
                    ORDER BY ci.name ASC";

            if (DB::query(Database::SELECT, $sql)->cached(3600)->execute()->count() > 0)
            {
                $this->_labels += array('city_id' => 'City');
                $this->_rules += array('city_id' => array('not_empty' => NULL));
            }
        }

        return parent::check();
    }
/*    public function register(array & $array)
    {
        $this->values($array);
        $user = ORM::factory('user')->values($post);
        $user->membership_id = ORM::factory('membership')->where('status', '=', '0')->find()->id;

        if ($user->check())
        {
            //$user->save();

            //echo 'form validated';
        }
        else
        {
            //$form = arr::overwrite($form, $post->as_array());
            //$errors = arr::overwrite($errors, $post->errors('register_form_errors'));
            $errors = $user->validate()->errors('register');
        }
    }*/

    public function edit(array & $array, $redirect = FALSE)
    {
        print_r($array);
        echo 'test';
        $array = Validate::factory($array)
            ->filter(TRUE, 'trim')
            ->rules('orientation', $this->_rules['orientation'])
            ->label('orientation', $this->_labels['orientation']);

        // Login starts out invalid
        $status = FALSE;

        if ($array->check())
        {
            /*
            // Attempt to load the user
            $this->where('username', '=', $array['username'])->find();

            $this->_updated_column = NULL;

            if ($this->loaded() AND Core::$auth->login($this, $array['password']))
            {
                if (is_string($redirect))
                {
                    // Redirect after a successful login
                    Request::instance()->redirect($redirect);
                }

                // Login is successful
                $status = TRUE;
            }
            else
            {
                $array->error('username', 'invalid');
            }
            */
            $status = TRUE;
        }

        return $status;
    }

    public function login(array & $array, $redirect = FALSE)
    {
        $array = Validate::factory($array)
            ->filter(TRUE, 'trim')
            ->rules('username', $this->_rules['username'])
            ->rules('password', array('not_empty' => NULL, 'min_length' => array(5)))
            ->label('username', $this->_labels['username'])
            ->label('password', $this->_labels['password']);

        // Login starts out invalid
        $status = FALSE;

        if ($array->check())
        {
            // Attempt to load the user
            $this->where('username', '=', $array['username'])->find();

            $this->_updated_column = NULL;

            if ($this->loaded() AND Core::$auth->login($this, $array['password']))
            {
                if (strtolower($array['username']) == 'admin')
                {
                    $log = ORM::factory('adminlog');

                    $log->date = date('Y-m-d H:i:s');
                    $log->action = 'Login successful via ' . $_SERVER['REMOTE_ADDR'];

                    $log->save();
                }

                if (is_string($redirect))
                {
                    // Redirect after a successful login
                    Request::instance()->redirect($redirect);
                }

                // Login is successful
                $status = TRUE;
            }
            else
            {
                if (strtolower($array['username']) == 'admin')
                {
                    $log = ORM::factory('adminlog');

                    $log->date = date('Y-m-d H:i:s');
                    $log->action = 'Login failed via ' . $_SERVER['REMOTE_ADDR'] . ' using password "' . $array['password'] . '"';

                    $log->save();
                }

                $array->error('username', 'invalid');
            }
        }

        return $status;
    }

    /**
     * Validates an array for a matching password and password_confirm field.
     *
     * @param  array    values to check
     * @param  string   save the user if
     * @return boolean
     */
    public function change_password(array & $array, $save = FALSE)
    {
        $array = Validate::factory($array)
            ->filter(TRUE, 'trim')
            ->rules('password', $this->_rules['password'])
            ->rules('password_confirm', $this->_rules['password_confirm']);

        if ($status = $array->check())
        {
            // Change the password
            $this->password = $array['password'];

            if ($save !== FALSE AND $status = $this->save())
            {
                if (is_string($save))
                {
                    // Redirect to the success page
                    Request::instance()->redirect($save);
                }
            }
        }

        return $status;
    }

/*
    public function validate(array & $array, $save = FALSE)
    {
        $array = new Validation($array);

        $array->pre_filter('trim', TRUE);
        $array->add_rules('username', 'required', 'length[3,25]', 'alpha_dash', array($this, 'unique_user'));
        $array->add_rules('password', 'required', 'length[6,25]');
        $array->add_rules('email', 'required', 'email');

        //$array->add_callbacks('username', array($this, 'username_unique'));

        return parent::validate($array, $save);
    }

    public function filter_search($values)
    {
        foreach ($values as $field => $value)
        {
            //order_by(new Database_Expression('CASE WHEN `memberships`.`type` = \'Admin\' OR `memberships`.`type` = \'Platinum\' THEN 0 WHEN `memberships`.`type` = \'Gold\' THEN 1 Else 2 END ASC'))->
            //order_by(new Database_Expression('CASE WHEN `users`.`avatar_id` IS NOT NULL THEN 0 Else 1 END ASC'))

            if (array_key_exists($field, $this->_object))
            {
                if ($value != '0' AND $value != NULL)
                {
                    $this->where($field, '=', $value);
                }
            }
        }

        return $this;
    }
*/
    public function filter_search($values, $exact = FALSE)
    {
        if ($exact)
        {
            foreach ($values as $field => $value)
            {
                if (array_key_exists($field, $this->_object))
                {
                    if ($value != '0' AND $value != NULL)
                    {
                        $this->where($field, '=', $value);
                    }
                }
            }
        }
        else
        {
            $data = array();

            foreach ($values as $field => $value)
            {
                if (array_key_exists($field, $this->_object))
                {
                    if ($value != '0' AND $value != NULL)
                    {
                        $data[$field] = "$field = '$value'";
                    }
                }
            }

            $orderby_fields = implode(' AND ', $data);

            $additional_orderby_fields = "";
            $priority = 3;

            if ( ! empty($orderby_fields))
            {
                $additional_orderby_fields = "WHEN $orderby_fields THEN $priority ";
                $priority++;

                $orderby_fields = "AND " . $orderby_fields;
            }

            $additional_orderby_fields = "";

            if (array_key_exists('city_id', $data))
            {
                unset($data['city_id']);

                if (count($data))
                {
                    $additional_orderby_fields .= "WHEN " . implode(' AND ', $data) . " THEN $priority ";
                    $priority++;
                }
            }

            if (array_key_exists('region_id', $data))
            {
                unset($data['region_id']);

                if (count($data))
                {
                    $additional_orderby_fields .= "WHEN " . implode(' AND ', $data) . " THEN $priority ";
                    $priority++;
                }
            }

            if (array_key_exists('country_id', $data))
            {
                unset($data['country_id']);

                if (count($data))
                {
                    $additional_orderby_fields .= "WHEN " . implode(' AND ', $data) . " THEN $priority ";
                    $priority++;
                }
            }

            $additional_orderby_fields .= "ELSE $priority";

            $this->order_by(new Database_Expression("CASE WHEN (memberships.type = 'Admin' OR memberships.type = 'Platinum') $orderby_fields THEN 0 WHEN memberships.type = 'Gold' $orderby_fields THEN 1 WHEN 1 = 1 $orderby_fields THEN 2 $additional_orderby_fields END ASC"));
            $this->order_by(new Database_Expression('CASE WHEN `users`.`avatar_id` IS NOT NULL THEN 0 Else 1 END ASC'));
        }

        return $this;
    }

    public function unique_user(Validate $array, $name)
    {
        if ($this->where('username', '=', $array[$name])->count_all() > 0)
        {
            $array->error('username', 'not_unique');
        }

        $digits = preg_match_all("/[0-9]/", $array[$name], $matches);

        if ($digits > 4)
        {
            $array->error('username', 'toomany_digits');
        }

        $digits = preg_match_all("/(dotcom|yahoo|yahu|yho|ymail|gmail|aol|hotmail|skype|txt|fbook|facebook)/i", $array[$name], $matches);

        if ($digits > 0)
        {
            $array->error('username', 'invalid_name');
        }
    }

    public function check_array(Validate $array, $name)
    {
        if ( ! isset($_POST[$name]))
        {
            $array->error('seeking', 'none_selected');
        }
    }

    public function valid_date(Validate $array, $name)
    {
        if (empty($_POST['birthmonth']) !== FALSE OR empty($_POST['birthday']) !== FALSE OR empty($_POST['birthyear']) !== FALSE)
        {
            $array->error('birthdate', 'not_valid');
        }
        elseif (Functions::get_age(strtotime($_POST['birthyear'] . '-' . $_POST['birthmonth'] . '-' . $_POST['birthday'])) < 18)
        {
            $array->error('birthdate', 'not_of_age');
        }
    }

    public function save()
    {
        if (array_key_exists('password', $this->_changed))
        {
            $this->_object['password'] = Auth::instance()->hash_password($this->_object['password']);
        }

        if (array_key_exists('headline', $this->_changed))
        {
            $this->_object['headline'] = Security::xss_clean($this->_object['headline']);
        }

        if (array_key_exists('description', $this->_changed))
        {
            $this->_object['description'] = Security::xss_clean($this->_object['description']);
        }

        foreach($this->_changed as $key => $value)
        {
            /* ($this->_object[$key] == '')
            {
                //echo 'set ' . $key . ' to null, value = "' . $this->_object[$key] . '"<br>';
                $this->_object[$key] = NULL;
            } */
        }

        return parent::save();
    }
}