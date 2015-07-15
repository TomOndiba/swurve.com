<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Home extends Controller_Master
{
    function before()
    {
        parent::before();
        if ( ! Core::$user AND $this->request->action != 'news' AND $this->request->action != 'terms' AND $this->request->action != 'privacy' AND $this->request->action != '2257')
        {
            Functions::check_loggedin();
        }
    }

    public function action_index()
    {
        if (Core::$user AND ! empty(Core::$user->flirtbucks_id))
        {
            $this->request->redirect('user/online');
        }

        $this->template->head->meta_title = 'Home';
        $this->template->content = View::factory('content/index')->bind('news', $news)->bind('feeds', $feeds)->bind('results', $results);

        $news = ORM::factory('news')->where('site', '=', 'Swurve')->order_by(new Database_Expression('RAND()'))->limit(1)->find_all();

        //$feeds = ORM::factory('feed')->where('user_id', '=', Core::$user)->order_by('added_date', 'DESC')->find_all();
        //$feeds = ORM::factory('feed')->join('contacts')->on('feeds.user_id', '=', 'contacts.from_id')->on('feeds.user_id', '=', 'contacts.to_id')->join('contact_type')->on('contact_type_id', '=', 'contact_type.id')->where_open('from_id', '=', Core::$user)->and_where_close('type', '=', 'Favorite')->or_where_open()->where_open('to_id', '=', Core::$user)->or_where_close('from_id', '=', Core::$user)->and_where_close('type', '=', 'Match')->or_where('user_id', '=', Core::$user)->order_by('added_date', 'DESC')->find_all();

        $results = ORM::factory('user')->with('membership')->with('avatar')->where('avatar.approved', '=', 'PG-13')->where('membership.type', '<>', 'Admin');

        if (Core::$user->interested_in != 'Both')
        {
            $results->where('gender', '=', Core::$user->interested_in);
        }

        $results = $results->order_by('signup_date', 'DESC')->limit(4)->find_all();

        $sql = "SELECT *
                FROM feeds f
                WHERE f.user_id IN (
                   SELECT CASE WHEN c.to_id = " . Core::$user . " THEN c.from_id ELSE c.to_id END
                   FROM contacts c , contact_types ct
                   WHERE c.contact_type_id = ct.id AND
                      (
                         (c.from_id = " . Core::$user . " AND ct.type = 'Favorite') OR
                         ((c.from_id = " . Core::$user . " OR c.to_id = " . Core::$user . ") AND ct.type = 'Match')
                      )
                   ) OR user_id = " . Core::$user . "
                ORDER BY f.added_date DESC
                LIMIT 10";

        $feeds = DB::query(Database::SELECT, $sql)->as_object('Model_Feed')->execute();
    }

    public function action_feed($offset = "0")
    {
        $sql = "SELECT *
                FROM feeds f
                WHERE f.user_id IN (
                   SELECT CASE WHEN c.to_id = " . Core::$user . " THEN c.from_id ELSE c.to_id END
                   FROM contacts c , contact_types ct
                   WHERE c.contact_type_id = ct.id AND
                      (
                         (c.from_id = " . Core::$user . " AND ct.type = 'Favorite') OR
                         ((c.from_id = " . Core::$user . " OR c.to_id = " . Core::$user . ") AND ct.type = 'Match')
                      )
                   ) OR user_id = " . Core::$user . "
                ORDER BY f.added_date DESC
                LIMIT $offset, 10";

        $feeds = DB::query(Database::SELECT, $sql)->as_object('Model_Feed')->execute();

        if (count($feeds) == 0) exit();

        $feed = View::factory('content/feed')->bind('feeds', $feeds);

        echo $feed->render();
        exit();
    }

    public function action_news($article)
    {
        $article = ORM::factory('news', $article);

        if ($article->loaded()){
            $this->template->head->meta_title = 'New Article';
            $this->template->content = View::factory('content/news')->bind('article', $article);
        }
        else
        {
            Request::instance()->redirect('home');
        }
    }

    public function action_terms()
    {
        $this->template->head->meta_title = 'Terms of Service';
        $this->template->content = View::factory('content/terms');
    }

    public function action_support()
    {
        $this->template->head->meta_title = 'Customer Support';
        $this->template->content = View::factory('content/support');
    }

    public function action_privacy()
    {
        $this->template->head->meta_title = 'Privacy Policy';
        $this->template->content = View::factory('content/privacy');
    }

    public function action_2257()
    {
        $this->template->head->meta_title = '2257 Compliance';
        $this->template->content = View::factory('content/2257');
    }
}