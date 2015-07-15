<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_User extends Controller_Master
{
    function before()
    {
        if ($this->request->action == 'iregister')
        {
            $this->template = 'iframe';
        }
        elseif ($this->request->action == 'register' OR $this->request->action == 'resend')
        {
            $this->template = 'registration';

            if (Cookie::get('splash', NULL) == '3')
            {
            		$this->template = 'splash3';
            }
        }
        elseif ($this->request->action == 'profile')
        {
            $this->template = 'template2';
        }
        elseif ($this->request->action == 'upgradesuccess')
        {
        		$this->template = 'upgrade';
       	}
        elseif ($this->request->action == 'upgrade')
        {
            $this->secure = TRUE;

            $this->template = 'upgrade';
        }

        if ($this->request->action == 'login' OR $this->request->action == 'settings' OR $this->request->action == 'iregister' OR $this->request->action == 'register' OR $this->request->action == 'activate' OR $this->request->action == 'resend' OR $this->request->action == 'resetpass')
        {
            $this->secure = TRUE;
        }

        parent::before();

        if ( ! Core::$user AND $this->request->action != 'unsubscribe' AND $this->request->action != 'login' AND $this->request->action != 'iregister' AND $this->request->action != 'register'  AND $this->request->action != 'activate' AND $this->request->action != 'resend' AND $this->request->action != 'resetpass')
        {
            Functions::check_loggedin();
        }
    }

    public function username_unique(Validation $post)
    {
        if (array_key_exists('username', $post->errors()))
            return;

        $user = new User_model();
    }

    public function check_cvv2(Validate $array, $field)
    {
        if ( ! array_key_exists('no_cvv2', $_POST) AND empty($array[$field]))
        {
            $array->error('cvv2_num', 'not_empty');
        }
    }

    public function check_state(Validate $array, $field)
    {
        if ( ! empty($array['country']) AND $array['country'] == 'US' AND empty($array[$field]))
        {
            $array->error('state', 'not_empty');
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

    function action_test3()
    {
        set_time_limit(0);
        echo date('Y-m-d H:i:s');

        exit();

        $users = ORM::factory('user')->where('id', '>', '10515')->where('membership_id', '=', '1')->where('signup_date', 'BETWEEN', new Database_Expression( strtotime('7/7/2015') . ' AND ' . strtotime('7/9/2015 00:00:00') ))->find_all();

        //print_r($users);

        foreach($users as $user)
        {
            Functions::send_activation($user);
            echo 'Activation email sent<br />';
        }

        print_r($users);
        echo 'DONE<br /><br />';

        $users = ORM::factory('message')->join('users')->on('messages.to_id', '=', 'users.id')->where('messages.date_sent', 'BETWEEN', new Database_Expression( strtotime('7/8/2015') . ' AND ' . strtotime('7/9/2015') ))->where('subject', '<>', 'Welcome to Swurve!')->where('date_read', 'IS', NULL)->find_all();

        foreach($users as $user)
        {
            switch($user->message_type_id)
            {
                case '1': //intro/tease
                    Functions::send_flirt($user->from, $user->to);
                    echo 'Intro/Tease email sent<br />';
                    break;

                case '3': //mail
                    Functions::send_email($user->from, $user->to);
                    echo 'mail notifiation sent<br />';
                    break;

                case '4': //photo request
                    Functions::send_request($user->from, $user->to);
                    echo 'photo request email sent<br />';
                    break;

                case '5': //favorite
                    if (strpos($user->subject, 'has Faved you and became a HookUp') === FALSE)
                    {
                        Functions::send_fave($user->from, $user->to);
                        echo $user->id . ' favorite email sent<br />';
                    }
                    else
                    {
                        Functions::send_match($user->from, $user->to);
                        echo $user->id . ' match email sent<br />';
                    }
                    break;

            }
        }

        print_r($users);
        echo 'DONE';

        exit();

/*
        $camgirls = ORM::factory('camgirl')->where('swurve_id', 'IS NOT', null)->find_all();

        foreach ($camgirls as $camgirl)
        {
            $sql = "UPDATE chat_tracker SET tier = " . $camgirl->tier . " WHERE tier = 0 AND user_id = " . $camgirl->swurve_id;

            $data = DB::query(Database::UPDATE, $sql)->execute();
        }
*/

        $from = ORM::factory('user')->where('username', '=', 'mancie')->find();
        $users = ORM::factory('user')->where('username', '=', 'omicron')->find_all();

        foreach($users as $user)
        {
            Functions::send_activation($user);
            //Functions::send_email($user, $from);
            //Functions::send_fave($user, $from);
            //Functions::send_flirt($user, $from);
            //Functions::send_match($user, $from);
            //Functions::send_request($user, $from);

            //Mailer::factory('user')->send_activation($user);
            echo 'Emails Sent<br />';
        }

        echo 'done';
        exit;

        
exit();
        $users = ORM::factory('user')->where('id', '>', 84197)->where('membership_id', '=', '1')->where('signup_date', '>= ', new Database_Expression( strtotime('10/5/2014')))->find_all();

        print_r($users);

        foreach($users as $user)
        {
            Functions::send_activation($user);
            //Mailer::factory('user')->send_activation($user);
            echo 'Activation email sent to ' . $user->email . '<br />';
        }

        echo 'done';
        exit();

        exit();
        set_time_limit(0); //started on 66954

        $users = DB::query(Database::SELECT, "SELECT * FROM users where id >= 66016 and id <= 66954 and  membership_id >= 2 and gender = 'Male' and interested_in = 'Female' and FROM_UNIXTIME(signup_date) between '2013-07-01' and '2014-01-31' ORDER BY ID ASC")->as_object('Model_User')->execute();

        //$users = ORM::factory('user')->where('username', '=', 'masterblaster6')->find_all();
        //$from = ORM::factory('user')->where('username', '=', 'XSweetCarolineX')->find();

        //echo "id,email_address,username,password,signup_date,ip_address\n";
        $admin = ORM::factory('user', array('username' => 'Admin'));

        foreach($users as $user)
        {
            echo $user . ' sent... ' . $user->id  .'<br />';

            $message = ORM::factory('message');

            $message->to_id = $user;
            $message->from_id = $admin;
            $message->message_type_id = ORM::factory('message_type', array('type' => 'Mail'));
            $message->subject = 'Whoops! We made an error- Click now to claim your free credits';
            $message->message = "
                <p>Were you a Swurve member having trouble signing in to Russian Desire?  We've given you on RussianDesire 25 free credits to make up for our boo boo!</p>
                <p>Also we've extended our offer to let you try RussianDesire for half price!</p>
                <p>As a valued member of Swurve.com, we are proud to present you with a special introductory offer to our newest property- RussianDesire.com</p>
                <p>RussianDesire is a boutique online community comprised of the most beautiful single women from Russia and Ukraine seeking Western men. As a member of Swurve you can experience this unique international dating site at a fraction of the normal cost.</p>
                <p><strong><a target='_blank' href='https://www.russiandesire.com/auto/login/user/upgradepromo?" . $user->username . "/" . $user->password . "/'>Click Here to Claim your Special Discount</a></strong></p>
                <p>We've raised the bar hand selecting the most captivating single women from every age group. Every female profile on the site is available and active. Every woman on the site and her pictures have been verified by passport / photo ID. All to provide you with the highest quality intimate one on one contact any online community has ever offered.</p>
                <p>Do you seek a little more love and romance in your online interactions? RussianDesire is ideal for those wishing to connect with highly attractive single women on a deeper level. </p>
                <p>Your user name and log in details remain the same. All you need to do is click to connect.</p>
                <p>The most amazing single women in the world are waiting to connect with someone just like you, right now!</p>
                <p>So what are you waiting for? Don't miss this unique opportunity!</p>
                <p>Much Love,</p>
                <p>the Swurve Support Team</p>
            ";

            $message->save();

            Functions::send_email($user, $admin);
        }

        echo 'done';

        exit();

        $from = ORM::factory('user')->where('username', '=', 'Admin')->find_all();
        $users = ORM::factory('user')->where('username', '=', 'omicron')->find();

        foreach($users as $user)
        {
            Functions::send_activation($user);
            Functions::send_email($user, $from);
            Functions::send_fave($user, $from);
            Functions::send_flirt($user, $from);
            Functions::send_match($user, $from);
            Functions::send_request($user, $from);
            Mailer::factory('user')->send_activation($user);
            echo 'Emails Sent<br />';
        }

        echo 'done';
        exit;
/*
        $digits = preg_match_all("/(dotcom|yahoo|yahu|yhoymail|gmail|aol|hotmail|skype|txt|fbook|facebook)/i", 'penisdotcomyo', $matches);

        echo $digits;

        print_r($matches);

        exit();
*/
        set_time_limit(0);
//echo date('m-d-Y h:i:s A e') . ' - ';
//  echo date('m-d-Y h:i:s A e', strtotime('est today'));
//  echo  ' - ' . strtotime('est today') . ' - ';
//  exit();
        //$this->template->content = View::factory('forms/upgrade-success');
        //print_r(Core::$user);
        //Functions::testlist();

        //return;
        //$users = ORM::factory('user')->where('membership_id', '=', '1')->where('signup_date', 'BETWEEN', new Database_Expression( strtotime('1/13/2011 17:00:00') . ' AND ' . strtotime('1/14/2011 14:16:00') ))->find_all();

        $users = ORM::factory('user')->where('country_id', '=', '233')->where('gender', '=', 'Male')->where('mailstatus', '=', '0')->where('membership_id', '>=', 2)->find_all();
        //$users = ORM::factory('user')->where('username', '=', 'masterblaster6')->find_all();
        //$from = ORM::factory('user')->where('username', '=', 'XSweetCarolineX')->find();

        echo "id|domain|email_address|username|password|signup_date|ip_address|avatar1|user1|subject1|avatar2|user2|subject2|avatar3|user3|subject3|avatar4|user4|subject4\n";

$count = 0;

        foreach($users as $user)
        {
            $sql = 'SELECT `messages`.*
                    FROM `messages`
                    JOIN `users` ON `users`.`id` = `messages`.`from_id`
                    JOIN `memberships` ON `memberships`.`id` = `users`.`membership_id`
                    WHERE `messages`.`to_id` = ' . $user . ' AND date_read IS NULL AND memberships.type <> \'Admin\' AND messages.message_type_id = 3
                    ORDER BY CASE WHEN (`memberships`.`type` = \'Admin\' Or `memberships`.`type` = \'Platinum\') And `messages`.`date_read` IS NULL THEN 0 Else 1 END ASC, `messages`.`date_sent` DESC
                    LIMIT 4';

            $messages = DB::query(Database::SELECT, $sql)->as_object('Model_Message')->execute();

            if (count($messages) < 4) continue;
            //Functions::send_rdpromo($user);

            $count++;
            $domain = substr(strrchr($user->email, "@"), 1);
            $domain = substr($domain, 0, strpos($domain, "."));

            echo $user . '|' . ucwords(strtolower($domain)) . '|' . $user->email . '|' . strtolower($user->username) . '|' . $user->password . '|' . date('m/d/Y', $user->signup_date) . '|' . $user->signup_ip;

            foreach($messages as $message)
            {
                echo '|' . Content::factory($message->from->username)->get_photo($message->from->avatar, 's') . '|' . $message->from->username . '|' . (! empty($message->subject) ? $message->subject : 'No Subject');
            }

            echo "\n";
        }

        exit;

        set_time_limit(0);
//echo date('m-d-Y h:i:s A e') . ' - ';
//  echo date('m-d-Y h:i:s A e', strtotime('est today'));
//  echo  ' - ' . strtotime('est today') . ' - ';
//  exit();
    	//$this->template->content = View::factory('forms/upgrade-success');
        //print_r(Core::$user);
        //Functions::testlist();

        //return;
        //$users = ORM::factory('user')->where('membership_id', '=', '1')->where('signup_date', 'BETWEEN', new Database_Expression( strtotime('1/13/2011 17:00:00') . ' AND ' . strtotime('1/14/2011 14:16:00') ))->find_all();

        $users = DB::query(Database::SELECT, "select u.* from users u inner join promo p on u.username = p.username where u.membership_id > 2 order by u.id asc")->as_object('Model_User')->execute();

        //$users = ORM::factory('user')->where('username', '=', 'masterblaster6')->find_all();
        //$from = ORM::factory('user')->where('username', '=', 'XSweetCarolineX')->find();

        //echo "id,email_address,username,password,signup_date,ip_address\n";

        foreach($users as $user)
        {
            echo $user . ' sent...<br />';

            $message = ORM::factory('message');

            $message->to_id = $user;
            $message->from_id = $admin;
            $message->message_type_id = ORM::factory('message_type', array('type' => 'Mail'));
            $message->subject = 'Exclusive Offer for Premium Members of Swurve.com';
            $message->message = "
                <p>As a valued member of Swurve.com, we are proud to present you with a special introductory offer to our newest property- RussianDesire.com</p>
                <p>RussianDesire is a boutique online community comprised of the most beautiful single women from Russia and Ukraine seeking Western men. As a premium member of Swurve you can experience this unique international dating site at a fraction of the normal cost.</p>
                <p><strong><a target='_blank' href='https://www.russiandesire.com/promo/" . strtolower($user->username) . "/" . strtolower($user->password) . "'>Click Here to Claim your Special Discount</a></strong></p>
                <p>We've raised the bar hand selecting the most captivating single women from every age group. Every female profile on the site is available and active. Every woman on the site and her pictures have been verified by passport / photo ID. All to provide you with the highest quality intimate one on one contact any online community has ever offered.</p>
                <p>Do you seek a little more love and romance in your online interactions? RussianDesire is ideal for those wishing to connect with highly attractive single women on a deeper level. </p>
                <p>Your user name and log in details remain the same. All you need to do is click to connect.</p>
                <p>The most amazing single women in the world are waiting to connect with someone just like you, right now!</p>
                <p>So what are you waiting for? Don't miss this unique opportunity!</p>
                <p>Much Love,</p>
                <p>the Swurve Support Team</p>
            ";

            Functions::send_email($user, $admin);

            $message->save();


            //Functions::send_rdpromo($user);
            //echo $user . ',' . $user->email . ',' . strtolower($user->username) . ',' . $user->password . ',' . date('m/d/Y', $user->signup_date) . ',' . $user->signup_ip . "\n";

            //Functions::send_email($user, $from);
            //Functions::send_fave($user, $from);
            //Functions::send_flirt($user, $from);
            //Functions::send_match($user, $from);
            //Functions::send_request($user, $from);
            //Mailer::factory('user')->send_activation($user);
            //echo 'Activation email sent<br />';
        }

        echo 'done';
        exit;
        //echo 'hi';
/*
        if ( is_null(Cookie::get('rc1')))
        {
            Cookie::set('rc1', rand(1, 5));
            Cookie::set('rc2', rand(8, 15));
        }
*/
        echo Cookie::get('rc1');
        echo '<br />:';
        echo Cookie::get('login_time', time());

        $free_request_display = false;
        $interval1 = Cookie::get('rc1');
        $interval2 = Cookie::get('rc2');


        echo 'int1: ' . $interval1 . '<br />';
        echo 'int2: ' . $interval2 . '<br />';
        echo ' status: ' . Core::$user->membership->status . '<br /><br />';

        echo time() . '<br />';
        echo strtotime('+' . $interval1 . ' minutes', Cookie::get('login_time', time())) . '<br />';
        echo strtotime('+' . $interval2 . ' minutes', Cookie::get('login_time', time()));

        exit();
        if (isset($interval1) AND time() > strtotime('+' . $interval1 . ' minutes', Cookie::get('login_time', time())) AND Core::$user->membership->status == 1)
        {
            Cookie::delete('rc1');

            $free_request_display = true;

            $community = ORM::factory('user')->where('membership_id', 'IN', new Database_Expression('(10, 11, 12)'))->order_by(new Database_Expression('RAND()'))->limit(1);
            $community = $community->where('country_id', '=', Core::$user->country)->where('region_id', '=', Core::$user->region);
            $reciever = $community->find();

            if ( ! $reciever->loaded())
            {
                $community = ORM::factory('user')->where('membership_id', 'IN', new Database_Expression('(10, 11, 12)'))->order_by(new Database_Expression('RAND()'))->limit(1);
                $reciever = $community->find();
            }
        }

        if (isset($interval2) AND time() > strtotime('+' . $interval2 . ' minutes', Cookie::get('login_time', time())) AND Core::$user->membership->status == 1)
        {
            Cookie::delete('rc2');

            $free_request_display = true;

            $community = ORM::factory('user')->where('membership_id', 'IN', new Database_Expression('(10, 11, 12)'))->order_by(new Database_Expression('RAND()'))->limit(1);
            $reciever = $community->find();
        }

        if ($free_request_display)
        {

        }
        //Cookie::set('rc1')
        exit();
        /*
        $users = ORM::factory('user')->where('id', '>', '10515')->where('membership_id', '=', '1')->where('signup_date', 'BETWEEN', new Database_Expression( strtotime('4/4/2010') . ' AND ' . strtotime('4/13/2010') ))->where('email', 'LIKE', '%@yahoo.com')->find_all();

        print_r($users);

        foreach($users as $user)
        {
            Mailer::factory('user')->send_activation($user);
            echo 'Activation email sent<br />';
        }

        echo 'done';

        $users = ORM::factory('message')->join('users')->on('messages.to_id', '=', 'users.id')->where('messages.date_sent', 'BETWEEN', new Database_Expression( strtotime('4/4/2010') . ' AND ' . strtotime('4/14/2010') ))->where('users.email', 'LIKE', '%@yahoo.%')->where('subject', '<>', 'Welcome to Swurve!')->where('date_read', 'IS', NULL)->find_all();

        foreach($users as $user)
        {
            switch($user->message_type_id)
            {
                case '1': //intro/tease
                    Mailer::factory('user')->send_flirt($user->from, $user->to);
                    echo 'Intro/Tease email sent<br />';
                    break;

                case '3': //mail
                    Mailer::factory('user')->send_email($user->from, $user->to);
                    echo 'mail notifiation sent<br />';
                    break;

                case '4': //photo request
                    Mailer::factory('user')->send_request($user->from, $user->to);
                    echo 'photo request email sent<br />';
                    break;

                case '5': //favorite
                    if (strpos($user->subject, 'has Faved you and became a HookUp') === FALSE)
                    {
                        Mailer::factory('user')->send_fave($user->from, $user->to);
                        echo $user->id . ' favorite email sent<br />';
                    }
                    else
                    {
                        Mailer::factory('user')->send_match($user->from, $user->to);
                        echo $user->id . ' match email sent<br />';
                    }
                    break;

            }
        }

        print_r($users);
        echo 'DONE';

        exit();
        */
    }

    function action_test2()
    {
        //Mailer::factory('user')->send_test('jerrbear78@yahoo.com');
        //echo 'Test email sent<br />';

        //Mailer::factory('user')->send_flirt('socketlabs.d8dd270.new@emailtests.com');
        //Mailer::factory('user')->send_flirt('jeff@reanimated.net');
        //echo 'Test email sent<br />';


        $users = ORM::factory('user')->where('membership_id', 'IN', new Database_Expression('(10, 11, 12)'))->find_all();

        foreach($users as $user)
        {
            //$user->password = 'HanS0l077';
            $user->password = 'Bubbl3428';
            //$user->mailstatus = 1;
            $user->save();

            echo '.';
        }

        echo '<br />Done.';
        exit();
    }

    function action_test()
    {
        $this->template->content = View::factory('content/test2');

/*
        Mailer::factory('affiliate')->send_welcome(ORM::factory('affiliate', array('id' => '1')));
        echo 'Affiliate welcome email sent!<br />';

        Mailer::factory('affiliate')->send_resetpass(ORM::factory('affiliate', array('id' => '1')));
        echo 'Affiliate resetpass email sent!<br />';

        Mailer::factory('affiliate')->send_resetpassconfirm(ORM::factory('affiliate', array('id' => '1')));
        echo 'Affiliate resetpassconfirm email sent!<br />';
*/
        //Mailer::factory('user')->send_activation(Core::$user);
        //echo 'Activation email sent<br />';
        //exit();
/*
        //Mailer::factory('user')->send_flirt(ORM::factory('user', array('id' => '10390')), Core::$user);
        //echo 'Flirt email sent!<br />';

        Mailer::factory('user')->send_email(ORM::factory('user', array('id' => '10390')), Core::$user);
        echo 'Email email sent!<br />';
        exit();

        Mailer::factory('user')->send_request(ORM::factory('user', array('id' => '10390')), Core::$user);
        echo 'Request email sent!<br />';

        Mailer::factory('user')->send_fave(ORM::factory('user', array('id' => '10390')), Core::$user);
        echo 'Fave email sent!<br />';

        Mailer::factory('user')->send_match(ORM::factory('user', array('id' => '10390')), Core::$user);
        echo 'Match email sent!<br />';

        Mailer::factory('user')->send_resetpass(Core::$user);
        echo 'Resetpass email sent!<br />';

        Mailer::factory('user')->send_resetpassconfirm(Core::$user);
        echo 'Resetpassconfirm email sent!<br />';
*/
    }

    function action_blocklist()
    {
        $post = $_POST;

        if (isset($post['submit']))
        {
            $user = ORM::factory('user', array('username' => $post['username']));

            if ( ! $user->loaded())
            {
                Notify::set('fail', 'No user found with the name "' . $post['username'] . '"');

                Request::instance()->redirect('user/blocklist');
            }

            if ($user->membership->type == 'Admin')
            {
                Notify::set('fail', 'Admin accounts can not be added to block list.');

                Request::instance()->redirect('user/blocklist');
            }

            if (ORM::factory('block')->where('user_id', '=', Core::$user)->where('block_id', '=', $user)->find()->loaded())
            {
                Notify::set('info', $user->username . ' is already on your block list.');

                Request::instance()->redirect('user/blocklist');
            }

            $block = ORM::factory('block');

            $block->user_id = Core::$user;
            $block->block_id = $user;

            $block->save();

            Notify::set('pass', $user->username . ' has been added to your block list.');

            Request::instance()->redirect('user/blocklist');
        }

        $this->template->content = View::factory('forms/blocklist');
    }

    function action_stealth($toggle)
    {
        if (Core::$user->membership->status == ORM::factory('membership', array('type' => 'Platinum'))->status AND ($toggle == 'On' OR $toggle == 'Off'))
        {
            Core::$user->stealth = $toggle;
            Core::$user->save();

            Notify::set('pass', 'Your stealth status has been turned ' . $toggle);
        }
        else
        {
            Notify::set('info', 'You must ' . HTML::anchor('user/upgrade', 'upgrade') . ' to a Platinum membership to access this feature.');
        }

        Request::instance()->redirect('user/control_panel');

    }

    function action_settings()
    {
        $this->template->head->meta_title = 'Account Settings';
        $this->template->content = View::factory('forms/settings')->bind('post', $post)->bind('errors', $errors);

        $post['email'] = Core::$user->email;
        $post['mailstatus'] = Core::$user->mailstatus;

        if ($_POST)
        {
            $post = $_POST;

            if (empty($post['password']) AND empty($post['password_confirm']))
            {
                unset($post['password']);
                unset($post['password_confirm']);
            }

            $validate = Validate::factory($post)
                ->filter(TRUE, 'trim')
                ->label('email', 'Email')
                ->rules('email', array('not_empty' => NULL, 'email' => array(FALSE)));

            if (array_key_exists('password', $post) OR array_key_exists('password_confirm', $post))
            {
                $validate = $validate
                    ->label('password', 'New Password')
                    ->label('password_confirm', 'Confirm Pass')
                    ->rules('password', array('not_empty' => NULL, 'min_length' => array(6)))
                    ->rules('password_confirm', array('matches' => array('password')));
            }

            if ($validate->check())
            {
                if (Core::$user->mailstatus != 0 AND $post['mailstatus'] == 1)
                {
                    unset($post['mailstatus']);
                }

                Core::$user->values($post);
                Core::$user->save();

                Notify::set('pass', 'Your account settings have been successfully updated');

                Request::instance()->redirect('user/control_panel');
            }
            else
            {
                $errors = $validate->errors('register');
            }
        }
    }

    function action_unsubscribe($email = NULL)
    {
        $this->template->head->meta_title = 'Unsubscribe';
        $this->template->content = View::factory('forms/unsubscribe')->bind('post', $post)->bind('errors', $errors);

        $post['email'] = $email;

        if ($_POST)
        {
            $post = $_POST;

            $validate = Validate::factory($post)
                ->filter(TRUE, 'trim')
                ->label('email', 'Email')
                ->rules('email', array('not_empty' => NULL, 'email' => array(FALSE)));

            if ($validate->check())
            {
                $sql = 'UPDATE users SET mailstatus = 1 WHERE email = \'' . Security::xss_clean($post['email']) . '\'';

                if (DB::query(Database::UPDATE, $sql)->execute() > 0)
                {
                    Notify::set('pass', Security::xss_clean($post['email']) . ' has been unsubscribed from all future mailings');
                }
                else
                {
                    Notify::set('info', Security::xss_clean($post['email']) . ' could not be found in the system or already unsubscribed');
                }

                Request::instance()->redirect('unsubscribe');
            }
            else
            {
                $errors = $validate->errors('register');
            }
        }
    }

    function action_resetpass($params = NULL)
    {
        $params = explode('/', $params);

        if (count($params) <= 1)
        {
            $this->template->head->meta_title = 'Reset Password';
            $this->template->content = View::factory('forms/reset-password')->bind('post', $post)->bind('errors', $errors);

            $post['username'] = $params[0];

            if ($_POST)
            {
                $post = $_POST;

                $validate = Validate::factory($post)
                    ->filter(TRUE, 'trim')
                    ->label('username', 'Username')
                    ->rules('username', array('not_empty' => NULL));

                if ($validate->check())
                {
                    $user = ORM::factory('user', array('username' => $post['username']));

                    if ($user->loaded())
                    {
                        Mailer::factory('user')->send_resetpass($user);

                        Notify::set('pass', 'A reset password request for ' . $user->username . ' was sent to the registered email address on record for that account.');
                    }

                    Request::instance()->redirect('user/resetpass/' . strtolower($user->username));
                }
                else
                {
                    $errors = $validate->errors('register');
                }

            }
        }
        else
        {
            $this->template->head->meta_title = 'Reset Password Confirmed';
            $this->template->content = View::factory('forms/reset-password-confirm')->bind('user', $user);

            $user = ORM::factory('user', array('username' => $params[0]));

            if ($user->loaded() AND $user->password == $params[1])
            {
                $new_password = Text::random();

                $user->password = $new_password;

                Mailer::factory('user')->send_resetpassconfirm($user);

                $user->save();
            }
            else
            {
                Request::instance()->redirect('/');
            }
        }
    }

    function action_resend($type)
    {
        $this->template->head->meta_title = 'Resend Activation';
        $this->template->content = View::factory('forms/resend-activation')->bind('errors', $errors)->bind('post', $post);

        $post['email'] = Core::$user->email;

        if ($_POST)
        {
            $post = $_POST;

            $validate = Validate::factory($post)
                ->filter(TRUE, 'trim')
                ->label('email', 'Email')
                ->rules('email', array('not_empty' => NULL, 'email' => array(TRUE)));

            if ($validate->check())
            {
                Core::$user->values($post);
                Core::$user->save();

                Functions::send_activation(Core::$user);
                //Mailer::factory('user')->send_activation(Core::$user);

                Notify::set('pass', 'Your activation email was resent to ' . Core::$user->email);

                Request::instance()->redirect('user/control_panel');
            }
            else
            {
                $errors = $validate->errors('register');
            }
        }
    }

    function action_edit() {
        $this->add_stylesheet(Functions::src_file('assets/css/jquery-ui.min.css'), 'screen');
        $this->add_javascript(array(Functions::src_file('assets/js/jquery-ui.min.js')));

        $this->template->head->meta_title = 'Upgrade your Swurve account';
        $this->template->content = View::factory('forms/edit-profile')->bind('post', $post)->bind('errors', $errors)->bind('location', $location);

        if ($_POST)
        {
            $post = $_POST;

            $validate = Validate::factory($post)
                ->filter(TRUE, 'trim')
                ->label('gender', 'Gender')
                ->label('interested_in', 'Interest')
                //->label('orientation', 'Orientation')
                //->label('relationship_status', 'Status')
                ->label('country_id', 'Country')
                ->rules('gender', array('not_empty' => NULL))
                ->rules('interested_in', array('not_empty' => NULL))
                //->rules('orientation', array('not_empty' => NULL))
                //->rules('relationship_status', array('not_empty' => NULL))
                ->rules('country_id', array('not_empty' => NULL))
                //->callback('seeking[]', array($this, 'check_array'))
                ->callback('birthdate', array($this, 'valid_date'));

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

            $region_count = 0;

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
                if (! isset($post['country_id']))
                {
                    Core::$user->country_id = NULL;
                }

                if (! isset($post['region_id']))
                {
                    Core::$user->region_id = NULL;
                }

                if (! isset($post['city_id']))
                {
                    Core::$user->city_id = NULL;
                }

                Core::$user->values($post);
                Core::$user->birthdate = strtotime($post['birthyear'] . '-' . $post['birthmonth'] . '-' . $post['birthday']);
                Core::$user->save();

                $seeking = Core::$user->relationship_types->find_all();

                foreach($seeking as $type)
                {
                    Core::$user->remove('relationship_types', $type);
                }

                if (isset($post['seeking']))
                {
                    $seeking = $post['seeking'];

                    foreach($seeking as $type)
                    {
                        Core::$user->add('relationship_types', ORM::factory('relationship_type', $type));
                    }
                }

                Notify::set('info', 'Your profile has been edited.');

                Request::instance()->redirect('user/control_panel');
            }
            else
            {
                $errors = $validate->errors('register');
            }
        }
        else
        {
            $post = ORM::factory('user', Core::$user)->as_array();

            $post['birthmonth'] = date('n', $post['birthdate']);
            $post['birthday'] = date('j', $post['birthdate']);
            $post['birthyear'] = date('Y', $post['birthdate']);

            $post['password'] = '';
            $post['password_confirm'] = '';

            $seeking = Core::$user->relationship_types->select('relationship_type_id')->find_all();

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
            $sql = "SELECT ci.id, ci.full_name
                    FROM cities ci, regions r, countries c
                    WHERE ci.region_code = r.code AND ci.country_code = c.code AND c.id = '" . $post['country_id'] . "' AND r.code = '00'
                    ORDER BY ci.name ASC";

            $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'full_name');
        }

        $location['city'] = array('' => 'Select A City') + $data;
    }

    function action_comingsoon() {
        Notify::set('info', 'The feature/link you selected is in development and coming soon');

        Request::instance()->redirect(( ! empty(Request::$referrer)) ? Request::$referrer : 'home');
    }

    function action_upgrade()
    {
        if (Core::$user->membership->type == 'Trial') Request::instance()->redirect('user/register/welcome');

        if (Core::$user->membership->status == ORM::factory('membership')->where('type', '=', 'Platinum')->find()->status)
        {
            Notify::set('info', 'Your account is already fully upgraded');

            Request::instance()->redirect('user/control_panel');
        }

        $this->add_stylesheet(Functions::src_file('assets/css/upgrade.css'), 'screen');

        $this->template->head->meta_title = 'Upgrade your Swurve account';
        $this->template->content = View::factory('forms/upgrade')->bind('post', $post)->bind('reason', $reason)->bind('errors', $errors)->bind('exp_months', $exp_months)->bind('exp_years', $exp_years)->bind('countries', $countries)->bind('states', $states);

        if (Core::$user->membership->paid == 1)
        {
            if ( ! is_null(Core::$user->membership->rebill_amount))
            {
                $this->template->content = View::factory('forms/upgrade-upgraded')->bind('post', $post)->bind('reason', $reason)->bind('errors', $errors)->bind('exp_months', $exp_months)->bind('exp_years', $exp_years)->bind('countries', $countries)->bind('states', $states);
            }
            else
            {
                $this->template->content = View::factory('forms/upgrade-upgraded-6')->bind('post', $post)->bind('reason', $reason)->bind('errors', $errors)->bind('exp_months', $exp_months)->bind('exp_years', $exp_years)->bind('countries', $countries)->bind('states', $states);
            }
        }

        if ($_POST)
        {
            $post = $_POST;

            $valid = Validate::factory($_POST)
                ->rule('plan', 'not_empty')
                ->rule('first_name', 'not_empty')
                ->rule('last_name', 'not_empty')
                ->rule('cc_num', 'not_empty')
                ->rule('exp_month', 'not_empty')
                ->rule('exp_year', 'not_empty')
                ->rule('email_address', 'not_empty')
                ->rule('address', 'not_empty')
                ->rule('city', 'not_empty')
                ->rule('country', 'not_empty')
                ->rule('zip_code', 'not_empty')
                ->callback('cvv2_num', array($this, 'check_cvv2'))
                ->callback('state', array($this, 'check_state'));

            if($valid->check())
            {
            		$success = false;
                $netbilling = Merchant::factory('netbilling')->create_membership($post);

                $transaction = ORM::factory('transaction');
                $transaction->user_id = Core::$user;
                $transaction->membership_id = $post['plan'];
                $transaction->first_name = $post['first_name'];
                $transaction->last_name = $post['last_name'];
                $transaction->trans_type = ($post['action'] == 'New') ? 'New' : 'Upgrade';

                if ( ! is_array($netbilling))
                {
                    $transaction->auth_msg = $netbilling;
                    $transaction->auth_type = 'Fail';

                    if($netbilling == 'BAD ADDRESS') {
                        $reason = "Invalid Address";
                    } else if($netbilling == 'CVV2 MISMATCH') {
                        $reason = "Invalid CVV2";
                    } else if($netbilling == 'A/DECLINED') {
                        $reason = "You have tried too many times.";
                    } else if($netbilling == 'B/DECLINED') {
                        $reason = "Please contact support.";
                    } else if($netbilling == 'C/DECLINED') {
                        $reason = "Please contact support.";
                    } else if($netbilling == 'E/DECLINED') {
                        $reason = "Your email address is invalid.";
                    } else if($netbilling == 'J/DECLINED') {
                        $reason = "Your information is invalid.";
                    } else if($netbilling == 'L/DECLINED') {
                        $reason = "Invalid Address";
                    } else {
                        $reason = "Your card was declined.";
                    }
                }
                else
                {
                    $transaction->auth_msg = $netbilling['auth_msg'];
                    $transaction->auth_type = 'Sale';
                    $transaction->trans_id = $netbilling['trans_id'];

                    if ($post['action'] == 'New')
                    {
                        $transaction->member_id = $netbilling['member_id'];
                    }

                    $success = true;
                }

                $transaction->ip_address = $_SERVER['REMOTE_ADDR'];
                $transaction->save();

                if ($success)
								{
                	Request::instance()->redirect('user/upgradesuccess');
                }
            }
            else
            {
                $errors = $valid->errors('validate');
            }
        }

        $exp_months = array (
            '' => 'Month',
            '01' => 'January',
            '02' => 'February',
            '03' => 'March',
            '04' => 'April',
            '05' => 'May',
            '06' => 'June',
            '07' => 'July',
            '08' => 'August',
            '09' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December'
        );

        $exp_years = range(date('y'), date('y') + 10);
        $exp_years = array('' => 'Year') + array_combine(array_values($exp_years), array_values($exp_years));

        $sql = "SELECT code, name
                FROM countries
                ORDER BY CASE name WHEN 'United States' THEN 0 WHEN 'Canada' THEN 1 WHEN 'United Kingdom' THEN 2 WHEN 'Australia' THEN 3 ELSE 4 END ASC, name ASC";

        $countries = array('' => 'Select Country') + DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('code', 'name');

        $states = array (
            ''    =>  'Select State - US Residents',
            'AL'  =>  'Alabama',
            'AK'  =>  'Alaska',
            'AZ'  =>  'Arizona',
            'AR'  =>  'Arkansas',
            'CA'  =>  'California',
            'CO'  =>  'Colorado',
            'CT'  =>  'Connecticut',
            'DC'  =>  'D.C.',
            'DE'  =>  'Delaware',
            'FL'  =>  'Florida',
            'GA'  =>  'Georgia',
            'HI'  =>  'Hawaii',
            'ID'  =>  'Idaho',
            'IL'  =>  'Illinois',
            'IN'  =>  'Indiana',
            'IA'  =>  'Iowa',
            'KS'  =>  'Kansas',
            'KY'  =>  'Kentucky',
            'LA'  =>  'Louisiana',
            'ME'  =>  'Maine',
            'MD'  =>  'Maryland',
            'MA'  =>  'Massachusetts',
            'MI'  =>  'Michigan',
            'MN'  =>  'Minnesota',
            'MS'  =>  'Mississippi',
            'MO'  =>  'Missouri',
            'MT'  =>  'Montana',
            'NE'  =>  'Nebraska',
            'NV'  =>  'Nevada',
            'NH'  =>  'New Hampshire',
            'NJ'  =>  'New Jersey',
            'NM'  =>  'New Mexico',
            'NY'  =>  'New York',
            'NC'  =>  'North Carolina',
            'ND'  =>  'North Dakota',
            'OH'  =>  'Ohio',
            'OK'  =>  'Oklahoma',
            'OR'  =>  'Oregon',
            'PA'  =>  'Pennsylvania',
            'RI'  =>  'Rhode Island',
            'SC'  =>  'South Carolina',
            'SD'  =>  'South Dakota',
            'TN'  =>  'Tennessee',
            'TX'  =>  'Texas',
            'UT'  =>  'Utah',
            'VT'  =>  'Vermont',
            'VA'  =>  'Virginia',
            'WA'  =>  'Washington',
            'WV'  =>  'West Virginia',
            'WI'  =>  'Wisconsin',
            'WY'  =>  'Wyoming'
        );
    }

		function action_upgradesuccess()
		{
			$this->template->content = View::factory('forms/upgrade-success');
		}

    function action_login($redirect = 'user/control_panel')
    {
        $this->template->head->meta_title = 'Login to your Swurve account';
        $this->template->content = View::factory('forms/login')->bind('post', $post)->bind('errors', $errors);

        if ($_POST)
        {
            $post = $_POST;

            ORM::factory('user')->login($post, $redirect);

            $errors = $post->errors('register');
        }
    }

    function action_logout()
    {
        Core::$auth->logout();

        Request::instance()->redirect('/');
    }

    function action_register($page = 1)
    {
        $this->template->head->meta_title = 'Create your free Swurve account';

        if (isset($_GET['a']))
        {
            Cookie::set('affiliate', trim($_GET['a']));

            Stats::add_click($_GET['a'], (isset($_GET['s'])) ? $_GET['s'] : '0');
        }

        if ( ! is_numeric($page) and $page != 'welcome')
        {
            $special_users = array('evilashleigh94','sxyjenni212','mollypop','imaslutttt','sexray19','milk_n_honey','heatherforever','annasquirt','sexysinglemammi','thebichim','nicolehottie');

            if (in_array(strtolower($page), $special_users))
            {
                $selecteduser = ORM::factory('user', array('username' => $page));
                $page = 1;

                $this->template->geocontent = View::factory('content/registration/geoprofiles-fullprofile')->bind('geolocation', $geolocation)->bind('selecteduser', $selecteduser);

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
            else
            {
                $selecteduser = ORM::factory('geoad', array('username' => $page));
                $page = 1;

                $this->template->geocontent = View::factory('content/registration/geoprofiles-profile')->bind('users', $users)->bind('geolocation', $geolocation)->bind('selecteduser', $selecteduser);

                $from_afl = Cookie::get('affiliate');

                if (empty($from_afl) AND isset($_GET['a']))
                {
                    $from_afl = $_GET['a'];
                }

                $users = ORM::factory('geoad')->where('type', '=', $selecteduser->gender);

                if(isset($from_afl) AND $from_afl == '21137') //21137
                {
                    $users = $users->where('birthdate', '<=', strtotime('est today -25 years'));
                }

                $users = $users->order_by(new Database_Expression('RAND()'))->limit(4)->find_all();

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

        if (array_key_exists('from', $_POST))
        {
            $this->template->geocontent = View::factory('content/registration/geoprofiles-search')->bind('users', $users)->bind('post', $_POST)->bind('selectedcity', $selectedcity);

            $users = ORM::factory('geoad')->where('type', '=', Core::$session->get('geo', 'Both'))->order_by(new Database_Expression('RAND()'))->limit(4)->find_all();

            //$geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->where('end_ip', '>=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->find();
            $geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->order_by('start_ip', 'DESC')->limit(1)->find();

            $selectedcity[0] = 'Near';

            if ($geoloc->loaded() AND $geoloc->geolocation->loaded())
            {
                if ($geoloc->end_ip >= ip2long($_SERVER['REMOTE_ADDR'])) {
                    $selectedcity[1] = $geoloc->geolocation->city;
                }
                else
                {
                    $selectedcity[1] = 'Your City';
                }
            }
            else
            {
                $selectedcity[1] = 'Your City';
            }

            if (isset($_POST['city']) and ! empty($_POST['city']) AND $_POST['city'] != 'Enter A City')
            {
                $selectedcity[1] = $_POST['city'];
            }
            elseif (isset($_POST['region']) and ! empty($_POST['region']) AND $_POST['region'] != 'Select A Region')
            {
                $selectedcity[0] = 'In';
                $selectedcity[1] = $_POST['region'];
            }
            elseif (isset($_POST['country']) and ! empty($_POST['country']) AND $_POST['country'] != 'Select A Country')
            {
                $selectedcity[0] = 'In';
                $selectedcity[1] = $_POST['country'];
            }
        }

        if ($page == 1)
        {
            $this->add_stylesheet(Functions::src_file('assets/css/jquery-ui.min.css'), 'screen');
            $this->add_javascript(array(Functions::src_file('assets/js/swurve.register.js')));

            $this->template->content = View::factory('forms/register')->bind('post', $post)->bind('errors', $errors)->bind('seeking', $seeking)->bind('location', $location);

            $seeking = ORM::factory('relationship_type')->order_by('type')->find_all();

            $sql = "SELECT id, name
                    FROM countries
                    ORDER BY CASE name WHEN 'United States' THEN 0 WHEN 'Canada' THEN 1 WHEN 'United Kingdom' THEN 2 WHEN 'Australia' THEN 3 ELSE 4 END ASC, name ASC";

            $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

            $location['country'] = $data;
            $location['region'] = array('' => 'Select A Region');
            $location['city'] = array('' => 'Select A City');

            if (isset($_POST['country']))
            {
                if (is_numeric($_POST['country']))
                {
                    $country = ORM::factory('country', array('id' => $_POST['country']));
                }
                else
                {
                    $country = ORM::factory('country', array('name' => $_POST['country']));
                }

                $post['country_id'] = $country->id;
            }
            else
            {
                $post['country_id'] = 233;
            }

            if (isset($_POST['region']))
            {
                if (is_numeric($_POST['region']))
                {
                    $region = ORM::factory('region')->where('country_code', '=', $country->code)->where('id', '=', $_POST['region'])->find();
                }
                else
                {
                    $region = ORM::factory('region')->where('country_code', '=', $country->code)->where('name', '=', $_POST['region'])->find();
                }

                $post['region_id'] = $region->id;
            }

            if (isset($_POST['geo_interested_in']))
            {
                $post['interested_in'] = $_POST['geo_interested_in'];
            }

            if (isset($_POST['city']))
            {
                $sql = "SELECT ci.id, ci.full_name
                        FROM cities ci, regions r, countries c
                        WHERE ci.region_code = r.code AND ci.country_code = c.code AND c.id = '" . $post['country_id'] . "' AND r.id = '" . $post['region_id'] . "'
                        ORDER BY ci.name ASC";

                $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'full_name');

                $city = ORM::factory('city')->where('country_code', '=', $country->code)->where('region_code', '=', $region->code)->where('full_name', '=', $_POST['city'])->find();

                $post['city_id'] = $city->id;
                $post['city'] = $_POST['city'];
            }

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

            if ($_POST AND ! array_key_exists('from', $_POST))
            {
                $post = array_merge($_POST, $post);

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
                $user->membership_id = ORM::factory('membership')->where('status', '=', '0')->find();

                if ($user->check())
                {
                    $user->birthdate = strtotime($post['birthyear'] . '-' . $post['birthmonth'] . '-' . $post['birthday']);
                    $user->signup_ip = $_SERVER['REMOTE_ADDR'];
                    $user->affiliate = Cookie::get('affiliate', NULL);
                    $user->sub_id = Cookie::get('subid', 0);
                    $user->tracking_id = Cookie::get('sub', NULL);

                    $affiliate = ORM::factory('affiliate', array('id' => Cookie::get('affiliate', NULL)));

                    if ($affiliate->loaded())
                    {
                        $user->affiliate_program = $affiliate->program;
                    }

                    $user->save();

                    Functions::send_activation($user);
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

                    Stats::add_registration($user->affiliate, $user->sub_id);

                    $user->login($post, '/user/register/2');
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
            $this->template->content = View::factory('forms/register-upload')->bind('post', $post)->bind('errors', $errors);

            if ($_POST)
            {
                $post = $_POST;

                $_FILES['picture']['name'] = strtolower($_FILES['picture']['name']);

                $files = Validate::factory($_FILES)->rules('picture', array('upload::valid' => NULL, 'upload::not_empty' => NULL, 'upload::type' => array(array('jpg', 'jpeg', 'png', 'gif', 'bmp')), 'upload::size' => array('10M')));

                if ($files->check() AND ! empty($post['confirm']))
                {
                    if ($uniqueid = Content::factory(Core::$user->username)->save_photo($_FILES['picture'], 'photo'))
                    {
                        $avatar_photo = ORM::factory('photo');

                        $avatar_photo->user_id = Core::$user->id;
                        $avatar_photo->uniqueid = $uniqueid;
                        $avatar_photo->save();

                        $watermark = Image::factory('assets/img/watermark.png');

                        $image = Image::factory(Content::factory(Core::$user->username)->get_photo_path($avatar_photo));

                        if ($image->width > 572)
                        {
                            $image = $image->resize(572);
                        }

                        $image->watermark($watermark, $image->width - $watermark->width, TRUE);
                        $image->save(Content::factory(Core::$user->username)->get_path('photo') . $uniqueid . '_f.png');

                        $image = Image::factory(Content::factory(Core::$user->username)->get_photo_path($avatar_photo));

                        if ($image->height > $image->width)
                        {
                            $image = $image->resize(300);
                        }
                        else
                        {
                            $image = $image->resize(NULL, 300);
                        }

                        $image->crop(300, 300);
                        $image->save(Content::factory(Core::$user->username)->get_path('photo') . $uniqueid . '_a.png');

                        $image->resize(150, 150);
                        $image->save(Content::factory(Core::$user->username)->get_path('photo') . $uniqueid . '_l.png');

                        $image->resize(100, 100);
                        $image->save(Content::factory(Core::$user->username)->get_path('photo') . $uniqueid . '_m.png');

                        $image->resize(50);
                        $image->save(Content::factory(Core::$user->username)->get_path('photo') . $uniqueid . '_s.png');

                        $image = Image::factory(Content::factory(Core::$user->username)->get_photo_path($avatar_photo));
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
                            Core::$user->avatar_id = $avatar_photo->id;
                        }

                        Core::$user->save();

                        Notify::set('pass', 'Your photo was successfully uploaded');

                        Request::instance()->redirect('user/register/3');
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

            $this->add_javascript(array(Functions::src_file('assets/js/swurve.register.js')));
            $this->add_javascript(array(Functions::src_file('assets/js/jquery-ui.min.js')));

            $seeking = ORM::factory('relationship_type')->order_by('type')->find_all();

            $this->template->content = View::factory('forms/register-more')->bind('post', $post)->bind('errors', $errors)->bind('seeking', $seeking);

            if ($_POST)
            {
                $post = $_POST;

                Core::$user->values($post);
                Core::$user->save();

                if (isset($post['seeking']))
                {
                    $seeking = $post['seeking'];

                    foreach($seeking as $type)
                    {
                        Core::$user->add('relationship_types', ORM::factory('relationship_type', $type));
                    }
                }

                Request::instance()->redirect('home');
            }
        }
        elseif ($page == 'welcome')
        {
            $this->template->content = View::factory('content/welcome')->bind('post', $post)->bind('errors', $errors)->bind('seeking', $seeking);
        }
    }

    function action_iregister($page = 1)
    {
        $this->template->head->meta_title = 'Create your free Swurve account';

        if ( ! is_numeric($page) and $page != 'welcome')
        {
            $page = 1;

            $from_afl = Cookie::get('affiliate');

            if (empty($from_afl) AND isset($_GET['a']))
            {
                $from_afl = $_GET['a'];
            }
        }

/*            $this->template->head->stylesheets = array(
                'assets/css/registration.css' => 'screen',
                'assets/css/swurve.css' => 'screen'
            );*/

        $this->add_stylesheet(Functions::src_file('assets/css/registration.css'), 'screen');

        if ($page == 1)
        {
            $this->add_stylesheet(Functions::src_file('assets/css/jquery-ui.min.css'), 'screen');
            $this->add_javascript(array(Functions::src_file('assets/js/swurve.register.js')));

            $this->template->content = View::factory('forms/register')->bind('post', $post)->bind('errors', $errors)->bind('seeking', $seeking)->bind('location', $location);

            $seeking = ORM::factory('relationship_type')->order_by('type')->find_all();

            $sql = "SELECT id, name
                    FROM countries
                    ORDER BY CASE name WHEN 'United States' THEN 0 WHEN 'Canada' THEN 1 WHEN 'United Kingdom' THEN 2 WHEN 'Australia' THEN 3 ELSE 4 END ASC, name ASC";

            $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

            $location['country'] = $data;
            $location['region'] = array('' => 'Select A Region');
            $location['city'] = array('' => 'Select A City');

            if (isset($_POST['country']))
            {
                if (is_numeric($_POST['country']))
                {
                    $country = ORM::factory('country', array('id' => $_POST['country']));
                }
                else
                {
                    $country = ORM::factory('country', array('name' => $_POST['country']));
                }

                $post['country_id'] = $country->id;
            }
            else
            {
                $post['country_id'] = 233;
            }

            if (isset($_POST['region']))
            {
                if (is_numeric($_POST['region']))
                {
                    $region = ORM::factory('region')->where('country_code', '=', $country->code)->where('id', '=', $_POST['region'])->find();
                }
                else
                {
                    $region = ORM::factory('region')->where('country_code', '=', $country->code)->where('name', '=', $_POST['region'])->find();
                }

                $post['region_id'] = $region->id;
            }

            if (isset($_POST['geo_interested_in']))
            {
                $post['interested_in'] = $_POST['geo_interested_in'];
            }

            if (isset($_POST['city']))
            {
                $sql = "SELECT ci.id, ci.full_name
                        FROM cities ci, regions r, countries c
                        WHERE ci.region_code = r.code AND ci.country_code = c.code AND c.id = '" . $post['country_id'] . "' AND r.id = '" . $post['region_id'] . "'
                        ORDER BY ci.name ASC";

                $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'full_name');

                $city = ORM::factory('city')->where('country_code', '=', $country->code)->where('region_code', '=', $region->code)->where('full_name', '=', $_POST['city'])->find();

                $post['city_id'] = $city->id;
                $post['city'] = $_POST['city'];
            }

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

            if ($_POST AND ! array_key_exists('from', $_POST))
            {
                $_POST['seeking'] = array('6');
                $post = array_merge($_POST, $post);

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
                $user->membership_id = ORM::factory('membership')->where('status', '=', '0')->find();

                if ($user->check())
                {
                    $user->birthdate = strtotime($post['birthyear'] . '-' . $post['birthmonth'] . '-' . $post['birthday']);
                    $user->signup_ip = $_SERVER['REMOTE_ADDR'];
                    $user->affiliate = Cookie::get('affiliate', NULL);
                    $user->sub_id = Cookie::get('subid', 0);
                    $user->tracking_id = Cookie::get('sub', NULL);

                    $affiliate = ORM::factory('affiliate', array('id' => Cookie::get('affiliate', NULL)));

                    if ($affiliate->loaded())
                    {
                        $user->affiliate_program = $affiliate->program;
                    }

                    $user->save();

                    $seeking = $post['seeking'];

                    foreach($seeking as $type)
                    {
                        $user->add('relationship_types', ORM::factory('relationship_type', $type));
                    }

                    Functions::send_activation($user);
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

                    Stats::add_registration($user->affiliate, $user->sub_id);

                    $user->login($post, '/user/register/2');
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
            $this->template->content = View::factory('forms/register-upload')->bind('post', $post)->bind('errors', $errors);

            if ($_POST)
            {
                $post = $_POST;

                $_FILES['picture']['name'] = strtolower($_FILES['picture']['name']);

                $files = Validate::factory($_FILES)->rules('picture', array('upload::valid' => NULL, 'upload::not_empty' => NULL, 'upload::type' => array(array('jpg', 'jpeg', 'png', 'gif', 'bmp')), 'upload::size' => array('10M')));

                if ($files->check() AND ! empty($post['confirm']))
                {
                    if ($uniqueid = Content::factory(Core::$user->username)->save_photo($_FILES['picture'], 'photo'))
                    {
                        $avatar_photo = ORM::factory('photo');

                        $avatar_photo->user_id = Core::$user->id;
                        $avatar_photo->uniqueid = $uniqueid;
                        $avatar_photo->save();

                        $watermark = Image::factory('assets/img/watermark.png');

                        $image = Image::factory(Content::factory(Core::$user->username)->get_photo_path($avatar_photo));

                        if ($image->width > 572)
                        {
                            $image = $image->resize(572);
                        }

                        $image->watermark($watermark, $image->width - $watermark->width, TRUE);
                        $image->save(Content::factory(Core::$user->username)->get_path('photo') . $uniqueid . '_f.png');

                        $image = Image::factory(Content::factory(Core::$user->username)->get_photo_path($avatar_photo));

                        if ($image->height > $image->width)
                        {
                            $image = $image->resize(300);
                        }
                        else
                        {
                            $image = $image->resize(NULL, 300);
                        }

                        $image->crop(300, 300);
                        $image->save(Content::factory(Core::$user->username)->get_path('photo') . $uniqueid . '_a.png');

                        $image->resize(150, 150);
                        $image->save(Content::factory(Core::$user->username)->get_path('photo') . $uniqueid . '_l.png');

                        $image->resize(100, 100);
                        $image->save(Content::factory(Core::$user->username)->get_path('photo') . $uniqueid . '_m.png');

                        $image->resize(50);
                        $image->save(Content::factory(Core::$user->username)->get_path('photo') . $uniqueid . '_s.png');

                        $image = Image::factory(Content::factory(Core::$user->username)->get_photo_path($avatar_photo));
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
                            Core::$user->avatar_id = $avatar_photo->id;
                        }

                        Core::$user->save();

                        Notify::set('pass', 'Your photo was successfully uploaded');

                        Request::instance()->redirect('user/iregister/3');
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

            $this->add_javascript(array(Functions::src_file('assets/js/swurve.register.js')));
            $this->add_javascript(array(Functions::src_file('assets/js/jquery-ui.min.js')));

            $this->template->content = View::factory('forms/register-more')->bind('post', $post)->bind('errors', $errors)->bind('seeking', $seeking);

            if ($_POST)
            {
                $post = $_POST;

                Core::$user->values($post);
                Core::$user->save();

                Request::instance()->redirect('user/iregister/welcome');
            }
        }
        elseif ($page == 'welcome')
        {
            $this->template->content = View::factory('content/welcome')->bind('post', $post)->bind('errors', $errors)->bind('seeking', $seeking);
        }
    }

    function action_online($action = NULL)
    {
        $this->template->head->meta_title = 'Search';

        $this->template->content = View::factory('content/online')->bind('results', $results)->bind('pagination', $pagination);

        if (isset(Core::$user->flirtbucks_id))
        {
            $total = ORM::factory('online')->with('user')->where('gender', '<>', 'Female')->where('last_seen', '>=', strtotime('-10 minutes'))->count_all();
        }
        else
        {
            $total = ORM::factory('online')->where('last_seen', '>=', strtotime('-10 minutes'))->count_all();
        }


        $pagination = Pagination::factory(
            array
            (
                'total_items' => $total,
                'items_per_page' => 10,
                'view'           => 'pagination/digg',
            )
        );

        if (isset(Core::$user->flirtbucks_id))
        {
            $results = ORM::factory('online')->with('user')->where('gender', '<>', 'Female')->where('last_seen', '>=', strtotime('-10 minutes'))->limit($pagination->items_per_page)->offset(($pagination->current_page - 1) * $pagination->items_per_page)->order_by('last_seen', 'DESC')->find_all();
        }
        else
        {
            $results = ORM::factory('online')->where('last_seen', '>=', strtotime('-10 minutes'))->limit($pagination->items_per_page)->offset(($pagination->current_page - 1) * $pagination->items_per_page)->order_by('last_seen', 'DESC')->find_all();
        }
    }

    function action_search($action = NULL)
    {
        $this->template->head->meta_title = 'Search';

        if ($action == NULL)
        {
            $this->template->content = View::factory('forms/search')->bind('post', $post)->bind('errors', $errors)->bind('locations', $locations);

            $sql = "SELECT r.id, r.name
                    FROM regions r, countries c
                    WHERE r.country_code = c.code AND c.id = '233'
                    ORDER BY r.name ASC";

            $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

            $locations['regions'] = array('' => 'Select A Region') + $data;

            $sql = "SELECT id, name
                    FROM countries
                    ORDER BY CASE name WHEN 'United States' THEN 0 WHEN 'Canada' THEN 1 WHEN 'United Kingdom' THEN 2 WHEN 'Australia' THEN 3 ELSE 4 END ASC, name ASC";

            $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

            $locations['countries'] = $data;
        }
        elseif ($action == 'online')
        {
            $this->template->content = View::factory('content/search/online')->bind('results', $results)->bind('pagination', $pagination);


            if (isset(Core::$user->flirtbucks_id))
            {
                $total = ORM::factory('online')->with('user')->where('gender', '<>', 'Female')->where('last_seen', '>=', strtotime('-12 hours'))->count_all();
            }
            else
            {
                $total = ORM::factory('online')->where('last_seen', '>=', strtotime('-12 hours'))->count_all();
            }

            $pagination = Pagination::factory(
                array
                (
                    'total_items' => $total,
                    'items_per_page' => 10,
                    'view'           => 'pagination/digg',
                )
            );

            if (isset(Core::$user->flirtbucks_id))
            {
                $results = ORM::factory('online')->with('user')->where('gender', '<>', 'Female')->where('last_seen', '>=', strtotime('-12 hours'))->limit($pagination->items_per_page)->offset(($pagination->current_page - 1) * $pagination->items_per_page)->find_all();
            }
            else
            {
                $results = ORM::factory('online')->where('last_seen', '>=', strtotime('-12 hours'))->limit($pagination->items_per_page)->offset(($pagination->current_page - 1) * $pagination->items_per_page)->find_all();
            }
        }
        else
        {
            $this->template->content = View::factory('content/search/results')->bind('results', $results)->bind('pagination', $pagination);

            $total = ORM::factory('user')->join('memberships')->on('memberships.id', '=', 'users.membership_id')->filter_search($_GET)->limit(1000)->find_all();

            $total = count($total);

            $pagination = Pagination::factory(
                array
                (
                    'total_items' => $total,
                    'items_per_page' => 10,
                    'view'           => 'pagination/digg',
                )
            );

            //$results = ORM::factory('user')->join('memberships')->on('memberships.id', '=', 'users.membership_id')->filter_search($_GET)->where('memberships.type', '<>', 'Admin')->order_by(new Database_Expression('CASE WHEN `memberships`.`type` = \'Admin\' OR `memberships`.`type` = \'Platinum\' THEN 0 WHEN `memberships`.`type` = \'Gold\' THEN 1 Else 2 END ASC'))->order_by(new Database_Expression('CASE WHEN `users`.`avatar_id` IS NOT NULL THEN 0 Else 1 END ASC'))->limit($pagination->items_per_page)->offset(($pagination->current_page - 1) * $pagination->items_per_page)->find_all();
            $results = ORM::factory('user')->join('memberships')->on('memberships.id', '=', 'users.membership_id')->filter_search($_GET)->where('memberships.type', '<>', 'Admin')->limit($pagination->items_per_page)->offset(($pagination->current_page - 1) * $pagination->items_per_page)->find_all();
            //print_r($results);
        }
    }

    function action_photos($user = NULL)
    {
        switch($user)
        {
            case NULL:
                $user = Core::$user;
                break;

            case is_numeric($user):
                $user = ORM::factory('user', $user);
                break;

            default:
                $user = ORM::factory('user')->where('username', '=', $user)->find();
                break;
        }

        $this->template->head->stylesheets = array(
	        Functions::src_file('assets/css/layout2.css') => 'screen',
	        Functions::src_file('assets/css/swurve.css') => 'screen'
        );

        $this->template->head->meta_title = $user->username . ' Swurve profile';
        $this->template->content = View::factory('content/profile/photos')->bind('user', $user)->bind('photos', $photos)->bind('pagination', $pagination);

        $total = $user->photos->where('approved', '<>' , 'No')->and_where('hide', '=', 'No')->count_all();

        $pagination = Pagination::factory(
            array
            (
                'total_items'    => $total,
                'items_per_page' => 15,
                'view'           => 'pagination/digg',
            )
        );

        $photos = $user->photos->where('approved', '<>' , 'No')->and_where('hide', '=', 'No')->limit($pagination->items_per_page)->offset(($pagination->current_page - 1) * $pagination->items_per_page)->order_by('added_date', 'DESC')->find_all();
    }

    function action_profile($user = NULL)
    {
        switch($user)
        {
            case NULL:
                $user = Core::$user;
                break;

//            case is_numeric($user):
//                $user = ORM::factory('user', $user);
//                break;

            default:
                $user = ORM::factory('user')->where('username', '=', $user)->find();
                break;
        }

        if ( ! $user->loaded())
        {
        	Request::instance()->redirect('home');
        }

        if ($user->membership->type == 'Admin')
        {
            Notify::set('info', 'Admin accounts cannot be accessed directly, if you need help with anything on the site please contact ' . HTML::mailto('support@swurve.com') . ', thank you.');

            Request::instance()->redirect(Request::$referrer);
        }

        $this->template->head->stylesheets = array(
	        Functions::src_file('assets/css/jquery-ui.min.css')      => 'screen',
	        Functions::src_file('assets/css/jquery.rating.css')  => 'screen',
	        Functions::src_file('assets/css/layout2.css')        => 'screen',
	        Functions::src_file('assets/css/swurve.css')         => 'screen'
        );

        if (Core::$user AND ! empty(Core::$user->flirtbucks_id))
        {
            $this->template->head->stylesheets[Functions::src_file('assets/css/swurve.flirtbucks2.css')] = 'screen';
        }

        $this->add_javascript(array(Functions::src_file('assets/js/jquery.rating.js')));

        $this->template->head->meta_title = $user->username . ' Swurve profile';
        $this->template->content = View::factory('content/profile')->bind('user', $user)->bind('photos', $photos)->bind('favorite', $favorite)->bind('rating', $rating);

        $photos = $user->photos->where('approved', '<>' , 'No')->and_where('hide', '=', 'No')->where('id', '<>' , $user->avatar)->limit(5)->find_all();

        $from = Core::$user;

        if ($from AND $from->id != $user->id)
        {
            ORM::factory('view')->update($user);
        }

        $contact = ORM::factory('contact')
            ->where_open()
            ->where('to_id', '=', $from)
            ->and_where('from_id', '=', $user)
            ->where_close()
            ->or_where_open()
            ->where('to_id', '=', $user)
            ->and_where('from_id', '=', $from)
            ->where_close()
            ->find();

        $favorite = FALSE;

        if ($contact->loaded())
        {
            if ($contact->from->id == $from->id AND $contact->to->id == $user->id AND $contact->contact_type->type == 'Favorite')
            {
                $favorite = TRUE;
            }
            elseif ($contact->from->id == $from->id AND $contact->to->id == $user->id AND $contact->contact_type->type == 'Match')
            {
                $favorite = TRUE;
            }
            elseif ($contact->from->id == $user->id AND $contact->to->id == $from->id AND $contact->contact_type->type == 'Favorite')
            {
                $favorite = FALSE;
            }
            elseif ($contact->from->id == $user->id AND $contact->to->id == $from->id AND $contact->contact_type->type == 'Match')
            {
                $favorite = TRUE;
            }
        }

        $rating = $user->ratings->where('from_id', '=', Core::$user)->find();
    }

    function action_control_panel($action = NULL)
    {
        $this->template->head->meta_title = 'Your Swurve account control panel';

        switch($action)
        {
            case 'manage_photos':
                if ($_POST) {
                    $post = $_POST;

                    if (isset($post['default']))
                    {
                        $photo = ORM::factory('photo', $post['default']);

                        if ($photo->loaded() AND $photo->user_id == Core::$user AND $photo->approved == 'PG-13')
                        {
                            Core::$user->avatar_id = $photo;
                        }
                    }

                    if (isset($post['delete']))
                    {
                        foreach($post['delete'] as $photo) {
                            $photo = ORM::factory('photo', $photo);

                            if ($photo->loaded() AND $photo->user_id == Core::$user)
                            {
                                //@unlink(Content::factory(Core::$user->username)->get_path('photo') . $photo->uniqueid . '_a.png');
                                //@unlink(Content::factory(Core::$user->username)->get_path('photo') . $photo->uniqueid . '_f.png');
                                //@unlink(Content::factory(Core::$user->username)->get_path('photo') . $photo->uniqueid . '_s.png');
                                //@unlink(Content::factory(Core::$user->username)->get_path('photo') . $photo->uniqueid . '_m.png');
                                //@unlink(Content::factory(Core::$user->username)->get_path('photo') . $photo->uniqueid . '_l.png');
                                //@unlink(Content::factory(Core::$user->username)->get_path('photo') . $photo->uniqueid . '.png');

                                //$photo->delete();

                                $photo->hide = 'Yes';

                                $photo->save();

                                if ($photo->id == Core::$user->avatar_id)
                                {
                                    Core::$user->avatar_id = null;

                                    Core::$user->save();
                                }
                            }
                        }
                    }

                    if (!Core::$user->saved()) {
                        Core::$user->save();

                        Notify::set('pass', 'Your photo(s) were successfully updated');

                        Request::instance()->redirect('user/control_panel/manage_photos');
                    }
                }

                $this->template->content = View::factory('content/control_panel/' . $action)->bind('photos', $photos)->bind('user', Core::$user);

                $photos = Core::$user->photos->where('hide', '=', 'No')->find_all();

                break;

            case 'upload_photo':
                if ($_POST)
                {
                    $_FILES['picture']['name'] = strtolower($_FILES['picture']['name']);

                    $files = Validate::factory($_FILES)->rules('picture', array('upload::valid' => NULL, 'upload::type' => array(array('jpg', 'jpeg', 'png', 'gif', 'bmp')), 'upload::size' => array('10M')));

                    if ($files->check())
                    {
                        if ($uniqueid = Content::factory(Core::$user->username)->save_photo($_FILES['picture'], 'photo'))
                        {
                            $avatar_photo = ORM::factory('photo');

                            $avatar_photo->user_id = Core::$user->id;
                            $avatar_photo->uniqueid = $uniqueid;
                            $avatar_photo->save();

                            $watermark = Image::factory('assets/img/watermark.png');

                            $image = Image::factory(Content::factory(Core::$user->username)->get_photo_path($avatar_photo));

                            if ($image->width > 572)
                            {
                                $image = $image->resize(572);
                            }

                            $image->watermark($watermark, $image->width - $watermark->width, TRUE);
                            $image->save(Content::factory(Core::$user->username)->get_path('photo') . $uniqueid . '_f.png');

                            $image = Image::factory(Content::factory(Core::$user->username)->get_photo_path($avatar_photo));

                            if ($image->height > $image->width)
                            {
                                $image = $image->resize(300);
                            }
                            else
                            {
                                $image = $image->resize(NULL, 300);
                            }

                            $image->crop(300, 300);
                            $image->save(Content::factory(Core::$user->username)->get_path('photo') . $uniqueid . '_a.png');

                            $image->resize(150, 150);
                            $image->save(Content::factory(Core::$user->username)->get_path('photo') . $uniqueid . '_l.png');

                            $image->resize(100, 100);
                            $image->save(Content::factory(Core::$user->username)->get_path('photo') . $uniqueid . '_m.png');

                            $image->resize(50);
                            $image->save(Content::factory(Core::$user->username)->get_path('photo') . $uniqueid . '_s.png');

                            $image = Image::factory(Content::factory(Core::$user->username)->get_photo_path($avatar_photo));
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
                            if (isset($_POST['avatar']))
                            {
                                Core::$user->avatar_id = $avatar_photo;

                                $feed = ORM::factory('feed')->where('user_id', '=', Core::$user)
                                    ->where('feed_type_id', '=', ORM::factory('feed_type', array('type' => 'avatar')))
                                    ->where('added_date', '>=', strtotime('est today'))
                                    ->where('added_date', '<=', strtotime('est now'))
                                    ->limit(1)
                                    ->find();

                                if ( ! $feed->loaded())
                                {
                                    $feed->user_id = Core::$user;
                                    $feed->feed_type_id = ORM::factory('feed_type', array('type' => 'avatar'));
                                }

                                if (Core::$user->gender == 'Male')
                                {
                                    $feed->message = 'changed his ' . HTML::anchor('photo/' . strtolower(Core::$user->username) . '/' . $avatar_photo->uniqueid , 'Main Profile Image');
                                }
                                else
                                {
                                    $feed->message = 'changed her ' . HTML::anchor('photo/' . strtolower(Core::$user->username) . '/' . $avatar_photo->uniqueid , 'Main Profile Image');
                                }

                                $feed->save();
                            }
                            else
                            {
                                $feed = ORM::factory('feed')->where('user_id', '=', Core::$user)
                                    ->where('feed_type_id', '=', ORM::factory('feed_type', array('type' => 'photos')))
                                    ->where('added_date', '>=', strtotime('est today'))
                                    ->where('added_date', '<=', strtotime('est now'))
                                    ->limit(1)
                                    ->find();

                                if ( ! $feed->loaded())
                                {
                                    $feed->user_id = Core::$user;
                                    $feed->feed_type_id = ORM::factory('feed_type', array('type' => 'photos'));
                                }

                                $feed->message = 'uploaded the following ' . HTML::anchor('photos/' . strtolower(Core::$user->username), 'New Photo(s)');
                                $feed->added_date = time();

                                $feed->save();
                            }

                            Core::$user->save();

                            Notify::set('pass', 'Your photo was successfully uploaded');

                            Request::instance()->redirect('user/control_panel/manage_photos');
                        }
                    }
                    else
                    {
                        echo 'error';
                        $errors = $files->errors();
                        print_r($errors);
                        echo $errors['picture'][0];

                        if ($errors['picture'][0] == 'upload::type')
                        {
                            Notify::set('fail', 'Invalid file type, only JPG, JPEG, GIF, BMP, and PNG files may be uploaded.');
                        }

                        if ($errors['picture'][0] == 'upload::size')
                        {
                            Notify::set('fail', 'File too big, the max file size that can be uploaded is 10MB.');
                        }

                        Request::instance()->redirect(Request::$referrer);
                    }
                }

                $this->template->content = View::factory('content/control_panel/' . $action);
                break;

            default:
                if ($_POST)
                {
                    $post = $_POST;
                    $status = Security::xss_clean($post['status']);

                    if (empty($status))
                    {
                        Notify::set('fail', 'Please enter some text to share with friends and Faves');

                        Request::instance()->redirect('user/control_panel');
                    }
                    else
                    {
                        $feed = ORM::factory('feed');

                        $feed->user_id = Core::$user;
                        $feed->feed_type_id = ORM::factory('feed_type', array('type' => 'status'));
                        $feed->message = $status;

                        $feed->save();

                        Notify::set('pass', 'You have shared your thoughts with friends and Faves');

                        Request::instance()->redirect('home');
                    }
                }

                $this->template->content = View::factory('content/control_panel');
                $this->add_stylesheet(Functions::src_file('assets/css/jquery.rating.css'), 'screen');
                $this->add_javascript(array(Functions::src_file('assets/js/jquery.rating.js')));
                break;
        }
    }

    function action_views()
    {
        $this->template->head->meta_title = 'Search Results';

        $this->template->content = View::factory('content/profile/views')->bind('results', $results)->bind('pagination', $pagination);

        $total = Core::$user->views->count_all();

        $pagination = Pagination::factory(
            array
            (
                'total_items' => $total,
                'items_per_page' => 10,
                'view'           => 'pagination/digg',
            )
        );

        $results = Core::$user->views->order_by('viewed_date', 'DESC')->limit($pagination->items_per_page)->offset(($pagination->current_page - 1) * $pagination->items_per_page)->find_all();
    }

    function action_activate($params)
    {
        list($username, $password) = explode('/', $params);

        $user = ORM::factory('user')->where('username' , '=', $username)->where('password', '=', $password)->find();

        if ($user->loaded())
        {
            if ($user->membership_id != 1)
            {
                Notify::set('fail', 'Your account has already been activated.');

                Request::instance()->redirect('user/login');

                return;
            }

            $user->membership_id = ORM::factory('membership')->where('status', '=', '1')->find();

            Notify::set('pass', 'Your account has been activated; now go get your Swurve on!');

            Core::$auth->complete_login($user);

            Request::instance()->redirect('user/control_panel');
        }
        else
        {
            Notify::set('fail', 'Invalid activation link detected, please try again.');

            Request::instance()->redirect('user/login');
        }
    }

    function action_activity($user)
    {
        switch($user)
        {
            case NULL:
                $user = Core::$user;
                break;

            case is_numeric($user):
                $user = ORM::factory('user', $user);
                break;

            default:
                $user = ORM::factory('user', array('username' => $user));
                break;
        }

        $this->template->head->stylesheets = array(
	        Functions::src_file('assets/css/layout2.css') => 'screen',
	        Functions::src_file('assets/css/swurve.css') => 'screen'
        );

        if ($user->loaded())
        {
            $this->template->head->meta_title = $user->username . '\'s Activity';

            $this->template->content = View::factory('content/profile/activity')->bind('feeds', $feeds)->bind('pagination', $pagination)->bind('user', $user);

            $total = $user->feeds->count_all();

            $pagination = Pagination::factory(
                array
                (
                    'total_items' => $total,
                    'items_per_page' => 10,
                    'view'           => 'pagination/digg',
                )
            );

            $feeds = $user->feeds->order_by('added_date', 'DESC')->limit($pagination->items_per_page)->offset(($pagination->current_page - 1) * $pagination->items_per_page)->find_all();
        }
        else
        {
            Request::instance()->redirect('home');
        }
    }
}
