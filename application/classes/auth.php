<?php defined('SYSPATH') or die('No direct script access.');

class Auth {
    // Auth instances
    protected static $instance;
    
    protected $session;       
    protected $config;
    
    public static function instance()
    {
        if ( ! isset(Auth::$instance))
        {
            $config = Kohana::config('auth');

            Auth::$instance = new Auth($config);
        }

        return Auth::$instance;
    }

    public function __construct($config = array())
    {
        $this->session = Session::instance();
        $this->config = $config;
    }

    public function password($user)
    {
        if ( ! is_object($user))
        {
            // Load the user
            $user = ORM::factory('user', array('username' => $user));
        }

        return $user->password;
    }

    public function force_login($user)
    {
        if ( ! is_object($user))
        {
            // Load the user
            $user = ORM::factory('user', array('username' => $user));
        }

        // Mark the session as forced, to prevent users from changing account information
        $_SESSION['auth_forced'] = TRUE;

        // Run the standard completion
        $this->complete_login($user);
    }

    public function login($user, $password)
    {
        if (empty($password))
            return FALSE;

        if ( ! is_object($user))
        {
            // Load the user
            $user = ORM::factory('user', array('username' => $user));
        }

        if (is_string($password))
        {
            // Get the salt from the stored password
            $salt = $this->find_salt($this->password($user));

            // Create a hashed password using the salt from the stored password
            $password = $this->hash_password($password, $salt);
        }

        // If the passwords match, perform a login
        if ($user->password === $password)
        {
            if ($user->membership->type == 'Banned')
            {
                Notify::set('fail', 'Your account has been banned.<br />To regain access please email ' . HTML::mailto('support@swurve.com', NULL, array('style' => 'color: #fff;')) . '');

                Request::instance()->redirect('user/login');
            }
            
            // Finish the login
            $this->complete_login($user);

            Cookie::set('return_visit', 'yes', strtotime('+1 year'));
            Cookie::set('login_time', time());
            Cookie::set('rc1', rand(1, 4));
            Cookie::set('rc2', rand(8, 15));
            
            return TRUE;
        }

        // Login failed
        return FALSE;
    }

    public function logout($destroy = FALSE, $logout_all = FALSE)
    {
        if ($destroy === TRUE)
        {
            // Destroy the session completely
            Session::instance()->destroy();
        }
        else
        {
            // Remove the user from the session
            $this->session->delete($this->config['session_key']);

            // Regenerate session_id
            $this->session->regenerate();
        }

        // Double check
        return ! $this->logged_in();
    }

    public function get_user()
    {
        if ($this->logged_in())
        {
            return $this->session->get($this->config['session_key']);
        }

        return FALSE;
    }

    public function logged_in()
    {
        return $this->session->get($this->config['session_key'], FALSE);
    }
    
    public function hash_password($password, $salt = FALSE)
    {
        if ($salt === FALSE)
        {
            // Create a salt seed, same length as the number of offsets in the pattern
            $salt = substr($this->hash(uniqid(NULL, TRUE)), 0, count($this->config['salt_pattern']));
        }

        // Password hash that the salt will be inserted into
        $hash = $this->hash($salt.$password);

        // Change salt to an array
        $salt = str_split($salt, 1);

        // Returned password
        $password = '';

        // Used to calculate the length of splits
        $last_offset = 0;

        foreach ($this->config['salt_pattern'] as $offset)
        {                                      
            // Split a new part of the hash off
            $part = substr($hash, 0, $offset - $last_offset);

            // Cut the current part out of the hash
            $hash = substr($hash, $offset - $last_offset);

            // Add the part to the password, appending the salt character
            $password .= $part.array_shift($salt);

            // Set the last offset to the current offset
            $last_offset = $offset;
        }

        // Return the password, with the remaining hash appended
        return $password.$hash;
    }

    public function hash($str)
    {
        return hash($this->config['hash_method'], $str);
    }
    
    public function find_salt($password)
    {
        $salt = '';

        foreach ($this->config['salt_pattern'] as $i => $offset)
        {
            // Find salt characters, take a good long look...
            $salt .= substr($password, $offset + $i, 1);
        }

        return $salt;
    }

    public function complete_login($user)
    {
        $user->last_login = time();
        $user->last_login_ip = $_SERVER['REMOTE_ADDR'];

        // Save the user
        $user->save();
        
        // Regenerate session_id
        $this->session->regenerate();

        // Store username in session
        $_SESSION[$this->config['session_key']] = $user;
        
        return TRUE;
    }
}