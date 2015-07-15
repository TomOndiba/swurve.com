<?php
abstract class Controller_Master extends Controller_Template
{
    public $template = 'template';
    public $secure = FALSE;

    public function add_stylesheet($stylesheet, $media)
    {
        $this->template->head->stylesheets[$stylesheet] = $media;
    }

    public function add_javascript($javascript)
    {
        if (is_array($javascript))
        {
            foreach($javascript as $script)
            {
                $this->template->head->javascripts[] = $script;
            }
        }
        else
        {
            $this->template->head->javascripts[] = $javascript;
        }
    }

    public function before()
    {
        $template = $this->template;

        if (isset($_GET['x']))
        {
            Cookie::set('affiliate', trim($_GET['x']));
        }

        if (isset($_GET['r']))
        {
            Cookie::set('referral', trim($_GET['r']));
        }

        if (isset($_GET['sub']))
        {
            Cookie::set('sub', trim($_GET['sub']));
        }

        if (isset($_GET['a']))
        {
            if ($_GET['a'] == '21211' OR $_GET['a'] ==  '21273' OR $_GET['a'] ==  '21296')
            {
                header("HTTP/1.0 404 Not Found");
                exit();
            }

            Cookie::set('affiliate', trim($_GET['a']));

            if (isset($_GET['s']))
            {
                Cookie::set('subid', trim($_GET['s']));
            }

            Stats::add_click($_GET['a'], (isset($_GET['s'])) ? $_GET['s'] : '0');
        }

        if ($_SERVER['REMOTE_ADDR'] == '67.171.226.43')
        {
            header("HTTP/1.0 404 Not Found");
            exit();
        }

        parent::before();

        if ($this->request->action == 'mobile')
        {
            return;
        }

        if ($template == 'affiliates')
        {
            $this->template->head = View::factory('template/affiliates/head');
            $this->template->head->meta_title = __('HookUp with Hot Payouts');
            $this->template->head->meta_description = 'Swurve.com - Where sexy singles hook up online. Search fun and flirty hot photo personal ads. Get casual, be naughty, and find a fling. Join free and hookup tonight!';
            $this->template->head->meta_keywords = 'hookup online, casual dating, casual relationships, sexy singles, friends with benefits, fwb, no strings attached, nsa, fling, dating site, hot personals, hook up site, sexy photos, flirting chat, booty call, bootycalls, sexypersonals, erotic singles, dirty ads, flirty girl, dateing, sexting, cyber dates, sex texting, flirting girl, naughty chat, dirty chat, swurve';
            $this->template->head->meta_robots = 'All'; //Index, Follow
            $this->template->head->stylesheets = array(
	            Functions::src_file('assets/css/layout2.css') => 'screen',
	            Functions::src_file('assets/css/swurve.css') => 'screen',
	            Functions::src_file('assets/css/swurve.affiliates.css') => 'screen',
	            Functions::src_file('assets/css/jquery-ui.min.css') => 'screen'
            );

            $this->template->head->javascripts = array(
	            Functions::src_file('assets/js/jquery.js'),
	            Functions::src_file('assets/js/jquery-migrate.min.js'),
	            Functions::src_file('assets/js/jquery-ui.min.js')
            );

            $this->template->header = View::factory('template/affiliates/header');
            $this->template->news = View::factory('affiliates/module/news')->bind('news', $news);
            $this->template->content = View::factory('affiliates/index');
            $this->template->footer = View::factory('template/affiliates/footer');

            $news = ORM::factory('news')->where('site', '=', 'Affiliate')->limit(3)->order_by('added_date', 'DESC')->find_all();

            Core::init_affiliate();

            return;
        }

        if ($template == 'flirtbucks')
        {
            $this->template->head = View::factory('template/flirtbucks/head');
            $this->template->head->meta_title = __('Get Paid to Chat');
            $this->template->head->meta_description = 'Swurve.com - Where sexy singles hook up online. Search fun and flirty hot photo personal ads. Get casual, be naughty, and find a fling. Join free and hookup tonight!';
            $this->template->head->meta_keywords = 'hookup online, casual dating, casual relationships, sexy singles, friends with benefits, fwb, no strings attached, nsa, fling, dating site, hot personals, hook up site, sexy photos, flirting chat, booty call, bootycalls, sexypersonals, erotic singles, dirty ads, flirty girl, dateing, sexting, cyber dates, sex texting, flirting girl, naughty chat, dirty chat, swurve';
            $this->template->head->meta_robots = 'All'; //Index, Follow
            $this->template->head->stylesheets = array(
	            Functions::src_file('assets/css/layout2.css') => 'screen',
	            Functions::src_file('assets/css/swurve.css') => 'screen',
	            Functions::src_file('assets/css/swurve.flirtbucks.css') => 'screen',
	            Functions::src_file('assets/css/jquery-ui.min.css') => 'screen'
            );

            $this->template->head->javascripts = array(
	            Functions::src_file('assets/js/jquery.js'),
	            Functions::src_file('assets/js/jquery-migrate.min.js'),
	            Functions::src_file('assets/js/jquery-ui.min.js')
            );

            $this->template->header = View::factory('template/flirtbucks/header');
            $this->template->news = View::factory('affiliates/module/news')->bind('news', $news);
            $this->template->content = View::factory('flirtbucks/index');
            $this->template->footer = View::factory('template/flirtbucks/footer');

            $news = ORM::factory('news')->where('site', '=', 'Affiliate')->limit(3)->order_by('added_date', 'DESC')->find_all();

            Core::init_flirtbucks();

            if (Core::$camgirl AND Core::$camgirl->status == 'Pending' AND $this->request->uri != 'flirtbucks' AND $this->request->action != 'faq' AND $this->request->action != 'support' AND $this->request->action != 'logout')
            {
                $this->request->redirect('/');
            }

            if (Core::$camgirl AND Core::$camgirl->status == 'Approved' AND Core::$camgirl->disclosure_agreement == 'No' AND $this->request->action != 'faq' AND $this->request->action != 'support' AND $this->request->action != 'logout' AND $this->request->action != 'agreement')
            {
                $this->request->redirect('/confidentiality/agreement');
            }

            if (Core::$camgirl AND Core::$camgirl->status == 'Approved' AND Core::$camgirl->disclosure_agreement == 'Yes' AND empty(Core::$camgirl->swurve_id) AND $this->request->action != 'faq' AND $this->request->action != 'support' AND $this->request->action != 'logout' AND $this->request->action != 'agreement' AND $this->request->controller != 'profile')
            {
                $this->request->redirect('/profile/create');
            }

            //

            return;
        }

        if ( ! is_null($this->secure) AND $_SERVER["SERVER_NAME"] != 'localhost')
        {
            if ($this->secure AND Request::$protocol == 'http')
            {
                $this->request->redirect(URL::site($this->request->uri, 'https'));
            }
            elseif (! $this->secure AND Request::$protocol == 'https')
            {
                $this->request->redirect(URL::site($this->request->uri, 'http'));
            }
        }

        if ($template == 'splash' AND Cookie::get('landing', NULL) == '2')
        {
            $this->request->redirect('2');
        }
        elseif ($template == 'splash2' AND Cookie::get('landing', NULL) == '1')
        {
            $this->request->redirect('');
        }

        if (($template == 'splash' OR $template == 'splash2') AND ! isset($_GET['a']) AND is_null(Cookie::get('landing', NULL)))
        {
            switch(rand(2, 2))
            {
                case 1:
                    Cookie::set('landing', '1');
                    break;

                case 2:
                    Cookie::set('landing', '2');
                    $this->request->redirect('2');
                    break;
            }
        }

        Core::init();

        //if (Core::$user AND Core::$user->membership->type == 'Trial' AND $this->request->action != 'login' AND $this->request->action != 'logout' AND $this->request->action != 'iregister' AND $this->request->action != 'register'  AND $this->request->action != 'activate' AND $this->request->action != 'resend' AND $this->request->action != 'resetpass' AND $this->request->controller != 'json' AND $this->request->controller != 'auto')
        //{
        //    $this->request->redirect('/user/register/welcome');
        //}

        $this->request->action = ($this->request->action == 'index') ? NULL : $this->request->action;

        //$this->template = View::factory($this->template);

        $this->template->head = View::factory('template/head');
        $this->template->head->meta_title = __('Hook Up for Casual Relationships');
        $this->template->head->meta_description = 'Swurve.com - Where sexy singles hook up online. Search fun and flirty hot photo personal ads. Get casual, be naughty, and find a fling. Join free and hookup tonight!';
        $this->template->head->meta_keywords = 'hookup online, casual dating, casual relationships, sexy singles, friends with benefits, fwb, no strings attached, nsa, fling, dating site, hot personals, hook up site, sexy photos, flirting chat, booty call, bootycalls, sexypersonals, erotic singles, dirty ads, flirty girl, dateing, sexting, cyber dates, sex texting, flirting girl, naughty chat, dirty chat, swurve';
        $this->template->head->meta_robots = 'All'; //Index, Follow
        $this->template->head->stylesheets = array(
	        Functions::src_file('assets/css/jquery-ui.min.css') => 'screen',
	        Functions::src_file('assets/css/layout.css') => 'screen',
	        Functions::src_file('assets/css/swurve.css') => 'screen'

        );

        if (Core::$user AND ! empty(Core::$user->flirtbucks_id))
        {
            $this->template->head->stylesheets[Functions::src_file('assets/css/swurve.flirtbucks2.css')] = 'screen';
        }

        $this->template->head->javascripts = array(
	        Functions::src_file('assets/js/swfobject.js'),
	        Functions::src_file('assets/js/jquery.js'),
	        Functions::src_file('assets/js/jquery-migrate.min.js'),
	        Functions::src_file('assets/js/jquery.cookie.js'),
	        Functions::src_file('assets/js/jquery-ui.min.js'),
	        Functions::src_file('assets/js/jquery.progressbar.js'),
	        Functions::src_file('assets/js/CB_Cookie_Compressed.js'),
	        Functions::src_file('assets/js/jquery.colorbox.js'),
	        Functions::src_file('assets/js/swurve.js')/*,
	        Functions::src_file('APE_JSF/Clients/JavaScript.js'),
	        Functions::src_file('APE_JSF/Demos/config.js') */
        );

        $this->template->header = View::factory('template/header');
        $this->template->header->current_uri = $this->request->uri();

        $this->template->footer = View::factory('template/footer');

        $this->template->content = View::factory('content/index');

        // Left Column Modules
        $this->template->quick_search = View::factory('module/quick_search');

        $this->template->online_now = View::factory('module/online_now');

        if (Core::$user)
        {
            $online = ORM::factory('online')->with('user')->where('last_seen', '>=', strtotime('-1 hours'));

            if (Core::$user->interested_in != 'Both')
            {
                $online->where('user.gender', '=', Core::$user->interested_in);
            }

            $this->template->online_now->users = $online->order_by('last_seen', 'DESC')->limit(5)->find_all();
        }

        // Right Colum Modules (hide if not showing on page so no extra processing is done for nothing)
        if ($template == 'template')
        {
            $this->template->user_stats = View::factory('module/user_stats');

            $this->template->profile_views = View::factory('module/profile_views');

            if (Core::$user)
            {
                $profile_views = Core::$user->views->with('user');

                if (Core::$user->interested_in != 'Both')
                {
                    $profile_views->where('user.gender', '=', Core::$user->interested_in);
                }

                $this->template->profile_views->users = $profile_views->order_by('viewed_date', 'DESC')->limit(5)->find_all();
            }
        }

        if ($template == 'registration')
        {
            $this->template->head->stylesheets = array(
	            Functions::src_file('assets/css/registration.css') => 'screen',
	            Functions::src_file('assets/css/swurve.css') => 'screen'
            );

            $this->template->geocontent = View::factory('content/registration/geoprofiles')->bind('users', $users)->bind('geolocation', $geolocation);

            if (array_key_exists('from', $_POST))
            {
                Core::$session->set('geo', ($_POST['geo_interested_in']) ? $_POST['geo_interested_in'] : 'Both');
            }

            $users = ORM::factory('geoad')->where('type', '=', Core::$session->get('geo', 'Both'))->order_by(new Database_Expression('RAND()'))->limit(6)->find_all();

            //$geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->where('end_ip', '>=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->find();
            $geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->order_by('start_ip', 'DESC')->limit(1)->find();

            if ($geoloc->loaded() AND $geoloc->geolocation->loaded())
            {
                if ($geoloc->end_ip >= ip2long($_SERVER['REMOTE_ADDR'])) {
                    $geolocation = $geoloc->geolocation->city;
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
        }
    }

        //array_search(Request::instance()->route, Route::all())
}
?>
