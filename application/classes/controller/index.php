<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Index extends Controller_Master
{
    function before()
    {
        if ($this->request->action == 'articles' OR $this->request->action == 'articles2' OR $this->request->action == 'articles3')
        {
            $this->template = 'registration';
            parent::before();
            return;
        }

    	if (Request::instance()->action == 'index3')
        {
        		Cookie::set('splash', '3');
            $this->template = 'splash3';
        }
        else if (Request::instance()->action == 'index2')
        {
        		Cookie::set('splash', '2');
            $this->template = 'splash2';
        }
        else
        {
        		Cookie::set('splash', '1');
            $this->template = 'splash';
        }

        if (isset($_GET['force']))
        {
            Cookie::set('force', $_GET['force']);
            $is_mobile = $_GET['force'];
        }
        else
        {
            $is_mobile = Cookie::get('force');
        }

        if (isset($is_mobile))
        {
            if ($is_mobile == 'mobile')
            {
                $this->request->redirect('/mobile');
            }
        }
        elseif (Functions::is_mobile())
        {
            $this->request->redirect('/mobile');
        }

        parent::before();

        if (Core::$user)
        {
            Request::instance()->redirect('home');
        }
        elseif (Cookie::get('return_visit', 'no') == 'yes')
        {
            Request::instance()->redirect('user/login');
        }

    }

    public function action_random()
    {
        $landings = Functions::affiliate_landings();
        array_pop($landings);

        $rand = array_rand($landings);
        $urls = array_values($landings[$rand]);

        $this->request->redirect($urls[0] . '?' . $_SERVER['QUERY_STRING']);
        exit();
    }

    public function action_articles($article_name = null)
    {
        try
        {
            switch($article_name)
            {
                case 'hook-up-online-or-credit-score-dating':
                    $this->template->head->meta_title = 'Hook Up Online or Date Based On Credit Score?';

                    break;

                case 'free-interracial-dating':
                    $this->template->head->meta_title = 'Free Interracial Dating - Are Free Interracial Dating Sites Accepting Of All Types Of Members?';
                    $this->template->head->meta_description = 'Free Interracial Dating - Are Free Interracial Dating Sites Accepting Of All Types Of Members Or Are They Like Sites For Farmers Looking To Date?';
                    break;

                case '5-ways-to-be-a-better-boyfriend-casual-dating':
                    $this->template->head->meta_title = 'Casual Dating: 5 Ways To Be A Better Boyfriend';
                    $this->template->head->meta_description = 'Casual Dating: 5 Ways To Be A Better Boyfriend - An Article On How To Be The Best Single Guy Your Girlfriend Could Ever Marry From A Dating Site.';
                    break;

                case 'free-dating-site-stereotypes':
                    $this->template->head->meta_title = 'Relationships And Comedy - Gender Stereotypes In Comedy And The Humor Of Free Dating Sites';
                    $this->template->head->meta_description = 'Learn more about how free dating sites, gender stereotypes, and comedy influence casual online relations!';
                    break;
            }

            $this->template->content = View::factory('content/articles/' . $article_name);
        }
        catch(Exception $e) {
            $this->template->content = View::factory('content/articles');
        }


//if
        //echo $article;

    }

    public function action_articles2($article_name = null)
    {
        try
        {
            switch($article_name)
            {
                case 'free-interracial-dating':
                    $this->template->head->meta_title = 'Free Interracial Dating - Are Free Interracial Dating Sites Accepting Of All Types Of Members?';
                    $this->template->head->meta_description = 'Free Interracial Dating - Are Free Interracial Dating Sites Accepting Of All Types Of Members Or Are They Like Sites For Farmers Looking To Date?';
                    break;
            }

            $this->template->content = View::factory('content/articles/' . $article_name);
        }
        catch(Exception $e) {
            $this->template->content = View::factory('content/articles-more');
        }
    }

    public function action_articles3($article_name = null)
    {
        try
        {
            switch($article_name)
            {
                case 'free-interracial-dating':
                    $this->template->head->meta_title = 'Free Interracial Dating - Are Free Interracial Dating Sites Accepting Of All Types Of Members?';
                    $this->template->head->meta_description = 'Free Interracial Dating - Are Free Interracial Dating Sites Accepting Of All Types Of Members Or Are They Like Sites For Farmers Looking To Date?';
                    break;
            }

            $this->template->content = View::factory('content/articles/' . $article_name);
        }
        catch(Exception $e) {
            $this->template->content = View::factory('content/articles-more');
        }
    }

    public function action_index()
    {
        $this->add_stylesheet(Functions::src_file('assets/css/splash.css'), 'screen');
        $this->add_javascript(array(Functions::src_file('assets/js/swurve.register.js')));
        //$this->add_javascript(array('assets/js/jquery.ui.autocomplete.js'));
        //$this->add_javascript(array('assets/js/jquery.ui.position.js'));

        //$this->template->users = ORM::factory('user')->where('avatar_id', 'IS NOT', NULL)->order_by(new Database_Expression('RAND()'))->limit(24)->find_all();
        $from_afl = Cookie::get('affiliate');

        if (empty($from_afl) AND isset($_GET['a']))
        {
            $from_afl = $_GET['a'];
        }

        $users = ORM::factory('geoad');

        if (isset($_GET['d']))
        {
            $users = $users->where('type', '=', ($_GET['d'] == 'f') ? 'Female' : (($_GET['d'] == 'm') ? 'Male' : 'Both') );
        }
        else
        {
            $users = $users->where('type', '=', 'Both');
        }

        if(isset($from_afl) AND $from_afl == '21137') //21137
        {
            $users = $users->where('birthdate', '<=', strtotime('est today -25 years'));
        }

        $this->template->users = $users->order_by(new Database_Expression('RAND()'))->limit(24)->find_all();

        //$geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->where('end_ip', '>=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->find();
        $geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->order_by('start_ip', 'DESC')->limit(1)->find();

        if ($geoloc->loaded() AND $geoloc->geolocation->loaded())
        {
            if ($geoloc->end_ip >= ip2long($_SERVER['REMOTE_ADDR'])) {
                $this->template->geolocation = $geoloc->geolocation->city;
            }
            else
            {
                $this->template->geolocation = 'Your City';
            }
        }
        else
        {
            $this->template->geolocation = 'Your City';
        }

        $this->template->bind('post', $post);

        $sql = "SELECT r.id, r.name
                FROM regions r, countries c
                WHERE r.country_code = c.code AND c.id = '233'
                ORDER BY r.name ASC";

        $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

        $post['regions'] = array('' => 'Select A Region') + $data;

        $sql = "SELECT id, name
                FROM countries
                ORDER BY CASE name WHEN 'United States' THEN 0 WHEN 'Canada' THEN 1 WHEN 'United Kingdom' THEN 2 WHEN 'Australia' THEN 3 ELSE 4 END ASC, name ASC";

        $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

        $post['countries'] = $data;
    }

    public function action_index2()
    {
        $this->add_stylesheet(Functions::src_file('assets/css/splash.css'), 'screen');
        $this->add_javascript(array(Functions::src_file('assets/js/swurve.register.js')));
        //$this->add_javascript(array('assets/js/jquery.ui.autocomplete.js'));
        //$this->add_javascript(array('assets/js/jquery.ui.position.js'));

        //$this->template->users = ORM::factory('user')->where('avatar_id', 'IS NOT', NULL)->order_by(new Database_Expression('RAND()'))->limit(24)->find_all();
        $from_afl = Cookie::get('affiliate');

        if (empty($from_afl) AND isset($_GET['a']))
        {
            $from_afl = $_GET['a'];
        }

        $users = ORM::factory('geoad');

        if (isset($_GET['d']))
        {
            $users = $users->where('type', '=', ($_GET['d'] == 'f') ? 'Female' : (($_GET['d'] == 'm') ? 'Male' : 'Both') );
        }
        else
        {
            $users = $users->where('type', '=', 'Both');
        }

        if(isset($from_afl) AND $from_afl == '21137') //21137
        {
            $users = $users->where('birthdate', '<=', strtotime('est today -25 years'));
        }

        $this->template->users = $users->order_by(new Database_Expression('RAND()'))->limit(12)->find_all();

        //$geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->where('end_ip', '>=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->find();
        $geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->order_by('start_ip', 'DESC')->limit(1)->find();

        if ($geoloc->loaded() AND $geoloc->geolocation->loaded())
        {
            if ($geoloc->end_ip >= ip2long($_SERVER['REMOTE_ADDR'])) {
                $this->template->geolocation = $geoloc->geolocation->city;
            }
            else
            {
                $this->template->geolocation = 'Your City';
            }
        }
        else
        {
            $this->template->geolocation = 'Your City';
        }

        $this->template->bind('post', $post);

        $sql = "SELECT r.id, r.name
                FROM regions r, countries c
                WHERE r.country_code = c.code AND c.id = '233'
                ORDER BY r.name ASC";

        $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

        $post['regions'] = array('' => 'Select A Region') + $data;

        $sql = "SELECT id, name
                FROM countries
                ORDER BY CASE name WHEN 'United States' THEN 0 WHEN 'Canada' THEN 1 WHEN 'United Kingdom' THEN 2 WHEN 'Australia' THEN 3 ELSE 4 END ASC, name ASC";

        $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

        $post['countries'] = $data;
    }

    public function action_index3($rand = null)
    {
    		//$_SERVER['REMOTE_ADDR'] = '75.72.11.124';
    		if (! isset($rand)) $rand = rand(1, 5);

    		$this->template->rand = $rand;
				$this->template->content = View::factory('content/splash3-' . $rand);

        $this->add_stylesheet(Functions::src_file('assets/css/splash.css'), 'screen');
        $this->add_javascript(array(Functions::src_file('assets/js/swurve.register.js')));
        //$this->add_javascript(array('assets/js/jquery.ui.autocomplete.js'));
        //$this->add_javascript(array('assets/js/jquery.ui.position.js'));

        //$this->template->users = ORM::factory('user')->where('avatar_id', 'IS NOT', NULL)->order_by(new Database_Expression('RAND()'))->limit(24)->find_all();
        $from_afl = Cookie::get('affiliate');

        if (empty($from_afl) AND isset($_GET['a']))
        {
            $from_afl = $_GET['a'];
        }
    }
}