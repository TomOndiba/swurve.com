<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Flirtbucks_Profile extends Controller_Master
{
    public $template = 'flirtbucks';

    public function action_create($page = 1)
    {
        $page = str_replace('/profile/create', '', $_SERVER['REQUEST_URI']);
        $page = empty($redirect) ? 1 : $redirect;


        if ($page == 1)
        {
            $this->add_stylesheet(Functions::src_file('assets/css/jquery-ui.min.css'), 'screen');
            $this->add_javascript(array(Functions::src_file('assets/js/swurve.js')));
            $this->add_javascript(array(Functions::src_file('assets/js/swurve.register.js')));

            $this->template->content = View::factory('flirtbucks/swurve/register')->bind('post', $post)->bind('errors', $errors)->bind('seeking', $seeking)->bind('location', $location);

            $seeking = ORM::factory('relationship_type')->order_by('type')->find_all();

            $sql = "SELECT id, name
                    FROM countries
                    ORDER BY CASE name WHEN 'United States' THEN 0 WHEN 'Canada' THEN 1 WHEN 'United Kingdom' THEN 2 WHEN 'Australia' THEN 3 ELSE 4 END ASC, name ASC";

            $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

            $location['country'] = array('' => 'Select A Country') + $data;
            $location['region'] = array('' => 'Select A Region');
            $location['city'] = array('' => 'Select A City');

            if ($_POST AND ! array_key_exists('from', $_POST))
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

                if (empty($post['city_id']))
                {
                    unset($post['city_id']);
                }

                $user = ORM::factory('user')->values($post);
                $user->membership_id = 17;

                if ($user->check())
                {
                    $user->birthdate = strtotime($post['birthyear'] . '-' . $post['birthmonth'] . '-' . $post['birthday']);
                    $user->signup_ip = $_SERVER['REMOTE_ADDR'];
                    $user->affiliate = Cookie::get('affiliate', NULL);
                    $user->sub_id = Cookie::get('subid', 0);
                    $user->mailstatus = 1;
                    $user->flirtbucks_id = Core::$camgirl;

                    $affiliate = ORM::factory('affiliate', array('id' => Cookie::get('affiliate', NULL)));

                    if ($affiliate->loaded())
                    {
                        $user->affiliate_program = $affiliate->program;
                    }

                    $user->save();

                    Core::$camgirl->swurve_id = $user;
                    Core::$camgirl->save();

                    $seeking = $post['seeking'];

                    foreach($seeking as $type)
                    {
                        $user->add('relationship_types', ORM::factory('relationship_type', $type));
                    }

                    //Mailer::factory('user')->send_activation($user);

                    $message = ORM::factory('message');

                    $message->to_id = $user;
                    $message->from_id = ORM::factory('user', array('username' => 'Admin'));
                    $message->message_type_id = ORM::factory('message_type', array('type' => 'Mail'));
                    $message->subject = 'Welcome to Swurve!';
                    $message->message = "
                        <p>Congratulations on becoming a part of the Hottest Hook-Up Site for individuals seeking Casual Relationships.</p>
                        <p>Here are some helpful tips to help you get your Swurve on:</p>
                        <p>Uploading photos is highly recommended. Photo profiles don't just get more views and response from other members, uploading an approved PG user photo gives you face time on the home page, announcing your availability to all members seeking to hook up with someone like you.</p>
                        <p>Sending a Flirt is a fast, easy and fun way to hook up. Flirts are pre-written introductions that share your profile criteria with members of the community you are interested in initiating contact with. There are several flirts to choose from so you can find the introduction that matches your style. Say hello the fast no hassle way with a Flirt- and best of all, Flirts are free to send and receive for ALL members of the service.</p>
                        <p>See someone you like? Add them as a Fave! Adding someone as a fave is another fun and hassle free way to express interest in another member as well as keep track of the members you are interested in. Marking someone as a Fave adds them to your Playbook so you can keep in contact as well as displays activity updates viewable from the Home page to alert you to changes in their profile, status, and new photo uploads.</p>
                        <p>Keep track of your connections from your Playbook. Your Playbook allows you to view your Faves as well as see who's Crushing on you. Your Crushes are members who have expressed interest by marking you as one of their Faves. Find one of your Crushes to be hot and tempting? By adding a Crush as one of your Faves the two of you have Hooked Up. HookUps are provided with additional user activity access and can share Shouts and other personal information other users can't see.</p>
                        <p>We hope you enjoy using our service. If you need any assistance you can contact us directly by emailing " . HTML::mailto('support@swurve.com') . ". One of our talented agents will be happy to assist you.</p>
                        <p>Enjoy the site,</p>
                        <p>Your Swurve Administrator</p>
                    ";

                    $message->save();

                    //Stats::add_registration($user->affiliate, $user->sub_id);

                    //$user->login($post, '/user/register/2');
                    Request::instance()->redirect('/profile/create/2');
                    //
                    //Auth::instance()->login($user, $user->password);

                    //Request::instance()->redirect('/home');
                    //$user->save();

                    //echo 'form validated';
                }
                else
                {
                    //$form = arr::overwrite($form, $post->as_array());
                    //$errors = arr::overwrite($errors, $post->errors('register_form_errors'));
                    $errors = $user->validate()->errors('register');

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
        elseif ($page == 2)
        {
            $this->template->content = View::factory('flirtbucks/swurve/register-upload')->bind('post', $post)->bind('errors', $errors);

            if ($_POST)
            {
                $post = $_POST;

                $_FILES['picture']['name'] = strtolower($_FILES['picture']['name']);

                $files = Validate::factory($_FILES)->rules('picture', array('upload::valid' => NULL, 'upload::not_empty' => NULL, 'upload::type' => array(array('jpg', 'png', 'gif')), 'upload::size' => array('1M')));

                if ($files->check() AND ! empty($post['confirm']))
                {
                    if ($uniqueid = Content::factory(Core::$camgirl->swurve->username)->save_photo($_FILES['picture'], 'photo'))
                    {
                        $avatar_photo = ORM::factory('photo');

                        $avatar_photo->user_id = Core::$camgirl->swurve_id;
                        $avatar_photo->uniqueid = $uniqueid;
                        $avatar_photo->save();

                        $watermark = Image::factory('assets/img/watermark.png');

                        $image = Image::factory(Content::factory(Core::$camgirl->swurve->username)->get_photo_path($avatar_photo));

                        if ($image->width > 572)
                        {
                            $image = $image->resize(572);
                        }

                        $image->watermark($watermark, $image->width - $watermark->width, TRUE);
                        $image->save(Content::factory(Core::$camgirl->swurve->username)->get_path('photo') . $uniqueid . '_f.png');

                        $image = Image::factory(Content::factory(Core::$camgirl->swurve->username)->get_photo_path($avatar_photo));

                        if ($image->height > $image->width)
                        {
                            $image = $image->resize(300);
                        }
                        else
                        {
                            $image = $image->resize(NULL, 300);
                        }

                        $image->crop(300, 300);
                        $image->save(Content::factory(Core::$camgirl->swurve->username)->get_path('photo') . $uniqueid . '_a.png');

                        $image->resize(150, 150);
                        $image->save(Content::factory(Core::$camgirl->swurve->username)->get_path('photo') . $uniqueid . '_l.png');

                        $image->resize(100, 100);
                        $image->save(Content::factory(Core::$camgirl->swurve->username)->get_path('photo') . $uniqueid . '_m.png');

                        $image->resize(50);
                        $image->save(Content::factory(Core::$camgirl->swurve->username)->get_path('photo') . $uniqueid . '_s.png');

                        $image = Image::factory(Content::factory(Core::$camgirl->swurve->username)->get_photo_path($avatar_photo));
                        $image->watermark($watermark, $image->width - $watermark->width, TRUE);
                        $image->save();
                        /*
                        if (Core::$user->avatar->loaded())
                        {
                            @unlink(Content::factory(Core::$user->username)->get_path('photo') . Core::$user->avatar->uniqueid . '_s.png');
                            @unlink(Content::factory(Core::$user->username)->get_path('photo') . Core::$user->avatar->uniqueid . '_m.png');
                            @unlink(Content::factory(Core::$user->username)->get_path('photo') . Core::$user->avatar->uniqueid . '_l.png');
                            @unlink(Content::factory(Core::$user->username)->get_path('photo') . Core::$user->avatar->uniqueid . '.png');

                            Core::$user->avatar->delete();
                        }
                        */
                        if (isset($post['avatar']))
                        {
                            Core::$camgirl->swurve->avatar_id = $avatar_photo->id;
                        }

                        Core::$camgirl->swurve->save();

                        Notify::set('pass', 'Your photo was successfully uploaded');

                        Request::instance()->redirect('/profile/create/3');
                    }
                }
                else
                {
                    if (empty($post['confirm']))
                    {
                        $files->label('confirm', 'Confirm')->error('confirm', 'not_empty');
                    }

                    $errors = $files->errors('photo');
                }
            }
        }
        elseif ($page == 3)
        {
            $this->add_stylesheet(Functions::src_file('assets/css/jquery-ui.min.css'), 'screen');

            $this->add_javascript(array(Functions::src_file('assets/js/jquery-ui.min.js')));
            $this->add_javascript(array(Functions::src_file('assets/js/swurve.register.js')));

            $this->template->content = View::factory('flirtbucks/swurve/register-more')->bind('post', $post)->bind('errors', $errors)->bind('seeking', $seeking);

            if ($_POST)
            {
                $post = $_POST;

                Core::$camgirl->swurve->values($post);
                Core::$camgirl->swurve->save();

                Request::instance()->redirect('/profile/create/welcome');
            }
        }
        elseif ($page == 'welcome')
        {
            $this->template->content = View::factory('flirtbucks/swurve/welcome')->bind('post', $post)->bind('errors', $errors)->bind('seeking', $seeking);
        }
    }
}
