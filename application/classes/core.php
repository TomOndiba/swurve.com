<?php defined('SYSPATH') or die('No direct script access.'); 

class Core
{
    public static $auth;
    public static $session;
    public static $user = FALSE;
    public static $affiliate = FALSE;
    public static $camgirl = FALSE;
    public static $flash_data = NULL;

    public static function init()
    {
        self::$auth = Auth::instance();
        self::$user = self::$auth->get_user();
        self::$session = Session::instance();
        self::$flash_data = Notify::get();
        
        if (self::$user AND self::$user->membership->type != 'Admin')
        {
            self::$user->online->update();
            
            if (self::$user->membership->type == 'Banned')
            {
                Notify::set('fail', 'Your account has been banned.<br />To regain access please email ' . HTML::mailto('support@swurve.com', NULL, array('style' => 'color: #fff;')) . '');

                self::$auth->logout();
                
                Request::instance()->redirect('user/login');
            }
        }
    }

    public static function init_affiliate()
    {
        self::$auth = AuthAffiliate::instance();
        self::$affiliate = self::$auth->get_affiliate();
        self::$session = Session::instance();
        self::$flash_data = Notify::get();
    }

    public static function init_flirtbucks()
    {
        self::$auth = AuthFlirtbucks::instance();
        self::$camgirl = self::$auth->get_camgirl();
        self::$session = Session::instance();
        self::$flash_data = Notify::get();
    }
}