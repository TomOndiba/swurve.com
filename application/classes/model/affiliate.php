<?php defined('SYSPATH') OR die('No direct access allowed.'); 

class Model_Affiliate extends ORM 
{
    protected $_belongs_to = array('country' => array(), 'region' => array(), 'city' => array());
    protected $_has_many = array('affiliate_stats' => array(), 'affiliate_campaigns' => array(), 'affiliate_subs' => array());
    
    protected $_filters = array(TRUE => array('trim' => NULL));
    protected $_rules = array(
        'first_name' => array('not_empty' => NULL),
        'last_name' => array('not_empty' => NULL),
        'password' => array('not_empty' => NULL, 'min_length' => array(6)),
        'password_confirm' => array('matches' => array('password')),
        'email' => array('not_empty' => NULL, 'email' => array(TRUE)),
        'address' => array('not_empty' => NULL),
        'country_id' => array('not_empty' => NULL),
        'tou' => array('not_empty' => NULL),
        'zip_code' => array('not_empty' => NULL),
        'program' => array('not_empty' => NULL),
        'payment_method' => array('not_empty' => NULL),
    );

    protected $_callbacks = array('email' => array('unique_email'));

    protected $_created_column = array('column' => 'signup_date', 'format' => TRUE);

    protected $_ignored_columns = array('password_confirm', 'tou');
                                                                 
    public function __construct($id = NULL)
    {
        $this->_labels = array(
            'first_name' => __('First Name'), 
            'last_name' => __('Last Name'),
            'password' => __('Password'), 
            'password_confirm' => __('Confirm Pass'), 
            'email' => __('Email'),
            'address' => __('Address'),
            'country_id' => __('Country'),
            'tou' => __('Terms of Use'),
            'zip_code' => __('Postal Code'),
            'program' => __('Program'),
            'payment_method' => __('Payment Method'),
        );

        return parent::__construct($id);
    }

    public function unique_email(Validate $array, $name)
    {
        if ($this->where('email', '=', $array[$name])->count_all() > 0)
        {
            $array->error('email', 'not_unique');
        }
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
                $this->_labels += array('city' => 'City');
                $this->_rules += array('city' => array('not_empty' => NULL));
            }
            
            if ($this->country_id == 233)
            {
                $this->_labels += array('ssn_tax_id' => 'SS#/Tax ID');
                $this->_rules += array('ssn_tax_id' => array('not_empty' => NULL));
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
                $this->_labels += array('city' => 'City');
                $this->_rules += array('city' => array('not_empty' => NULL));
            }
        }
        
        if (isset($this->payment_method) AND $this->payment_method == 'ePassporte')
        {
            $this->_labels += array('payment_method_account' => 'ePassporte ID');
            $this->_rules += array('payment_method_account' => array('not_empty' => NULL));
        }

        return parent::check();
    }
    
    public function login(array & $array, $redirect = FALSE)
    {
        $array = Validate::factory($array)
            ->filter(TRUE, 'trim')
            ->rules('email', $this->_rules['email'])
            ->rules('password', array('not_empty' => NULL, 'min_length' => array(4)))
            ->label('email', $this->_labels['email'])
            ->label('password', $this->_labels['password']);

        // Login starts out invalid
        $status = FALSE;

        if ($array->check())
        {
            // Attempt to load the user
            if (is_numeric($array['email']))
            {
                $this->where('id', '=', $array['email'])->find();
            }
            else
            {
                $this->where('email', '=', $array['email'])->find();
            }

            //$this->_updated_column = NULL;

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
                $array->error('email', 'invalid');
            }
        }

        return $status;
    }

    public function save()
    {
        if (array_key_exists('password', $this->_changed))
        {
            $this->_object['password'] = Core::$auth->hash_password($this->_object['password']);
        }

        return parent::save();
    }
}