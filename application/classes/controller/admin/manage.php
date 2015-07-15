<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Admin_Manage extends Controller_Master
{
    function before()
    {
        parent::before();

        Functions::check_loggedin(TRUE, TRUE);
    }

    public function unique_user(Validate $array, $field)
    {
        if (ORM::factory('user')->where('username', '=', $_POST[$field])->count_all() > 0)
        {
            $array->error('username', 'not_unique');
        }
    }

    function check_array(Validate $array, $field)
    {
        $field = str_replace('[]', '', $field);

        if ( ! isset($_POST[$field]))
        {
            $array->error('seeking[]', 'none_selected');
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
            $array->error('birthdate', 'not_of_age_edit');
        }
    }

    function action_active()
    {
        $this->template->head->meta_title = 'Active Users';
        $this->template->content = View::factory('admin/active')->bind('results', $results);

        $results = array();

        $sql = 'SELECT *
                FROM users u
                JOIN online o ON u.id = o.user_id
                WHERE o.last_seen >= ' . strtotime('-10 minutes') . '
                ORDER BY o.last_seen DESC';

        $results = DB::query(Database::SELECT, $sql)->as_object('Model_User')->execute();
    }

    function action_emails()
    {
        $this->template->head->meta_title = 'Manage Emails';
        $this->template->content = View::factory('admin/manage/emails')->bind('post', $post)->bind('pagination', $pagination)->bind('results', $results)->bind('messagetypes', $messagetypes);

        if (isset($_POST['submit']))
        {
            $post = $_POST;

            if (isset($post['mark']))
            {
                foreach($post['mark'] as $msg_id)
                {
                    $message = ORM::factory('message', $msg_id);

                    $message->subject = $post[$msg_id . '_subject'];
                    $message->message = $post[$msg_id . '_message'];
                    $message->flag = 'No';
                    $message->checked = time();

                    $message->save();
                }
            }

            if (isset($post['delete']))
            {
                foreach($post['delete'] as $msg_id)
                {
                    $message = ORM::factory('message', $msg_id);

                    $message->delete();
                }
            }

            Notify::set('pass', 'Checked emails have been delivered.');

            Request::instance()->redirect('/admin/manage/emails');
        }


        $results = ORM::factory('message')->where('flag', '=', 'Yes')->find_all();

        $sql = "SELECT DISTINCT `message_types`.* FROM `message_types`";

        $messagetypes = array('0' => 'All Messages') + DB::query(Database::SELECT, $sql)->execute()->as_array('id', 'type');
    }

    function action_users()
    {
        $this->template->head->meta_title = 'Admin Area';
        $this->template->content = View::factory('admin/manage/users')->bind('post', $post)->bind('pagination', $pagination)->bind('results', $results);
        $results = array();

        if ($_GET)
        {
            Core::$session->set('manage_users', $_SERVER['QUERY_STRING']);
            $post = $_GET;

            $total = ORM::factory('user')->filter_search($post, TRUE);

            if ( ! empty($post['order']))
            {
                $total = $total->join('transactions')->on('users.id', '=', 'transactions.user_id')->where('transactions.trans_id', '=', $post['order']);
            }

            if ( ! empty($post['filter']))
            {
                $filters = split(',', $post['filter']);

                $total = $total->where_open();

                foreach($filters as $filter)
                {
                    $total = $total->or_where('headline', 'LIKE', '%' . $filter . '%');
                    $total = $total->or_where('description', 'LIKE', '%' . $filter . '%');
                }

                $total = $total->where_close();
            }

            $pagination = Pagination::factory(
                array
                (
                    'total_items' => $total->count_all(),
                    'items_per_page' => 10,
                    'view'           => 'pagination/digg',
                )
            );

            $results = ORM::factory('user')->filter_search($post, TRUE);

            if ( ! empty($post['order']))
            {
                $results = $results->join('transactions')->on('users.id', '=', 'transactions.user_id')->where('transactions.trans_id', '=', $post['order']);
            }

            if ( ! empty($post['filter']))
            {
                $filters = split(',', $post['filter']);

                $results = $results->where_open();

                foreach($filters as $filter)
                {
                    $results = $results->or_where('headline', 'LIKE', '%' . trim($filter) . '%');
                    $results = $results->or_where('description', 'LIKE', '%' . trim($filter) . '%');
                }

                $results = $results->where_close();
            }

            $results = $results->limit($pagination->items_per_page)->offset(($pagination->current_page - 1) * $pagination->items_per_page)->find_all();
        }
    }

    function action_user($user)
    {
        $this->add_stylesheet(Functions::src_file('assets/css/jquery-ui.min.css'), 'screen');
        $this->add_javascript(array(Functions::src_file('assets/js/jquery-ui.min.js')));

        $this->template->head->meta_title = 'Manage ' . $user . '\'s Profile';
        $this->template->content = View::factory('admin/manage/user')->bind('post', $post)->bind('errors', $errors)->bind('location', $location);

        $region_count = 0;

        if ($_POST)
        {
            $post = $_POST;

            if ($post['username'] == $user)
            {
                unset($post['username']);
            }

            if (empty($post['password']))
            {
                unset($post['password']);
            }

            if (empty($post['password_confirm']))
            {
                unset($post['password_confirm']);
            }

            if (empty($post['country_id']))
            {
                unset($post['country_id']);
            }

            if (empty($post['region_id']))
            {
                unset($post['region_id']);
            }

            if (empty($post['city_id']))
            {
                unset($post['city_id']);
            }

            $validate = Validate::factory($post)
                ->filter(TRUE, 'trim')
                ->label('gender', 'Gender')
                ->label('interested_in', 'Interest')
                ->label('orientation', 'Orientation')
                ->label('relationship_status', 'Status')
                ->label('country_id', 'Country')
                ->label('email', 'Email')
                ->rules('gender', array('not_empty' => NULL))
                ->rules('interested_in', array('not_empty' => NULL))
                ->rules('orientation', array('not_empty' => NULL))
                ->rules('relationship_status', array('not_empty' => NULL))
                ->rules('country_id', array('not_empty' => NULL))
                ->rules('orientation', array('not_empty' => NULL))
                ->rules('email', array('not_empty' => NULL, 'email' => array(FALSE)))
                ->callback('seeking[]', array($this, 'check_array'))
                ->callback('birthdate', array($this, 'valid_date'));

            if (array_key_exists('username', $post))
            {
                $validate = $validate
                    ->label('username', 'Username')
                    ->rules('username', array('not_empty' => NULL, 'min_length' => array(3), 'max_length' => array(25), 'alpha_dash' => NULL))
                    ->callback('username', array($this, 'unique_user'));
            }

            if (array_key_exists('password', $post))
            {
                $validate = $validate
                    ->label('password', 'Password')
                    ->label('password_confirm', 'Confirm Pass')
                    ->rules('password', array('not_empty' => NULL, 'min_length' => array(6)))
                    ->rules('password_confirm', array('matches' => array('password')));
            }

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
                    $validate = $validate->label('city_id', 'City')->rules('city_id', array('not_empty' => NULL));
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
                    $validate = $validate->label('city_id', 'City')->rules('city_id', array('not_empty' => NULL));
                }
            }

            if ($validate->check())
            {
                $user = ORM::factory('user', array('username' => $user));
                $user->values($post);
                $user->birthdate = strtotime($post['birthyear'] . '-' . $post['birthmonth'] . '-' . $post['birthday']);
                $user->save();

                $seeking = $user->relationship_types->find_all();

                foreach($seeking as $type)
                {
                    $user->remove('relationship_types', $type);
                }

                $seeking = $post['seeking'];

                foreach($seeking as $type)
                {
                    $user->add('relationship_types', ORM::factory('relationship_type', $type));
                }

                Notify::set('info', $user->username . '\'s profile has been edited.');

                Request::instance()->redirect('admin/manage/users?' . Core::$session->get('manage_users'));
            }
            else
            {
                $post['username'] = $user;
                $post['id'] = ORM::factory('user', array('username' => $user));

                $errors = $validate->errors('register');
            }
        }
        else
        {
            $user = ORM::factory('user', array('username' => $user));
            $post = $user->as_array();

            $post['birthmonth'] = date('n', $post['birthdate']);
            $post['birthday'] = date('j', $post['birthdate']);
            $post['birthyear'] = date('Y', $post['birthdate']);

            $post['password'] = '';
            $post['password_confirm'] = '';

            $seeking = $user->relationship_types->select('relationship_type_id')->find_all();

            $post['seeking'] = array();

            foreach($seeking as $seeking_type)
            {
                array_push($post['seeking'], $seeking_type->relationship_type_id);
            }
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
            echo 'populating with no region found';
            $sql = "SELECT ci.id, ci.full_name
                    FROM cities ci, regions r, countries c
                    WHERE ci.region_code = r.code AND ci.country_code = c.code AND c.id = '" . $post['country_id'] . "' AND r.code = '00'
                    ORDER BY ci.name ASC";

            $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'full_name');
        }

        $location['city'] = array('' => 'Select A City') + $data;
    }

    function action_photos($user)
    {
        $user = ORM::factory('user', array('username' => $user));

        if ($_POST) {
            $post = $_POST;
            $avatar_updated = FALSE;

            if (isset($post['default']))
            {
                $photo = ORM::factory('photo', $post['default']);

                if ($photo->loaded() AND $photo->user_id == $user AND $photo->approved == 'PG-13' AND $photo != $user->avatar_id)
                {
                    $avatar_updated = TRUE;
                    $user->avatar_id = $photo;
                }
            }

            if (isset($post['delete']))
            {
                foreach($post['delete'] as $photo) {
                    $photo = ORM::factory('photo', $photo);

                    if ($photo->loaded() AND $photo->user_id == $user)
                    {
                        @unlink(Content::factory($user->username)->get_path('photo') . $photo->uniqueid . '_a.png');
                        @unlink(Content::factory($user->username)->get_path('photo') . $photo->uniqueid . '_f.png');
                        @unlink(Content::factory($user->username)->get_path('photo') . $photo->uniqueid . '_s.png');
                        @unlink(Content::factory($user->username)->get_path('photo') . $photo->uniqueid . '_m.png');
                        @unlink(Content::factory($user->username)->get_path('photo') . $photo->uniqueid . '_l.png');
                        @unlink(Content::factory($user->username)->get_path('photo') . $photo->uniqueid . '.png');

                        $photo->delete();
                    }
                }
            }

            if ($avatar_updated == TRUE) {
                $user->save();

                Notify::set('pass', $user->username . '\'s photos were updated.');

            }
        }

        Request::instance()->redirect('admin/manage/user/' . $user->username);
    }
}
