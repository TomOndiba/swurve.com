<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Mobile extends Controller_Master
{
    
    public function action_login($redirect = 'user/control_panel')
    {
        $view = View::factory('content/mobile')->bind('page', $page)->bind('post', $post)->bind('errors', $errors);;

        $page = 'login';
        
        if ($_POST)
        {
            $post = $_POST; 

            ORM::factory('user')->login($post, $redirect);
            
            $errors = $post->errors('register');
        }

        echo $view->render();
        
        exit();
    }
    
    public function action_index()
    {
        $view = View::factory('content/mobile')->bind('page', $page)->bind('geolocation', $geolocation)->bind('users', $users);
        
        $page = 'home';
        $users = ORM::factory('geoad')->where('type', '=', 'Female')->order_by(new Database_Expression('RAND()'))->limit(12)->find_all();
        $geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->order_by('start_ip', 'DESC')->limit(1)->find();
        
        if ($geoloc->loaded() AND $geoloc->geolocation->loaded())
        {
            if ($geoloc->end_ip >= ip2long($_SERVER['REMOTE_ADDR'])) {
                $geolocation = $geoloc->geolocation->city;
                
                if (empty($geolocation))
                {
                    $geolocation = $geoloc->geolocation->region;
                }

                if (empty($geolocation))
                {
                    $geolocation = $geoloc->geolocation->region;
                }

                if (empty($geolocation))
                {
                    $geolocation = $geoloc->geolocation->country;
                }

                if (empty($geolocation))
                {
                    $geolocation = 'Your City';
                }
                
                if ($geolocation == 'US')
                {
                    $geolocation = 'United States';
                }
            }
            else
            {
                $geolocation = 'Your City';
            }
        }
        else
        {
            $geolocation = 'Your City';
        }
        
        echo $view->render();
        
        exit();
    }
}