<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Photo extends Controller_Master
{
    function before()
    {
        parent::before();

        Functions::check_loggedin();
    }

    public function action_request($params)
    {
        if (strpos($params, '/') !== FALSE)
        {
            list($request, $user) = explode('/', $params);
        }

        $to = ORM::factory('user', array('username' => $user));
        $from = Core::$user;

        $message_type = ORM::factory('message_type', array('type' => 'Photo Request'));
        $message = ORM::factory('message');

        $sent_today = $message->where('to_id', '=', $to)
            ->where('from_id', '=', $from)
            ->where('message_type_id', '=', $message_type)
            ->where('date_sent', '>=', strtotime('now -1 month'))
            ->where('date_sent', '<=', strtotime('now'))
            ->find_all()->count();

        if ($sent_today === 1)
        {
            Notify::set('info', 'You have already requested more photos from ' . $to->username . ' within a month');

            Request::instance()->redirect('profile/' . $to->username);
        }

        $message->to_id = $to;
        $message->from_id = $from;
        $message->message_type_id = $message_type;
        $message->subject = $from->username . ' has a request';

        if ($request == 'photos')
        {
            $message->message = Functions::template_replace('|from| has expressed interest in seeing additional photos added to your account.', $from, $to);
        }
        else
        {
            $message->message = Functions::template_replace('|from| has expressed interest in seeing photos added to your account.', $from, $to);
        }

        $message->save();

        Functions::send_request($to, $from);
        //Mailer::factory('user')->send_request($to);

        Notify::set('pass', 'Your request for more photos was successfully sent');

        Request::instance()->redirect('profile/' . $to->username);
    }

    public function action_view2($params)
    {
        list($username, $photo) = split('/', $params);

        $allow_fullsize = FALSE;
        $fullsize = FALSE;

        if (stripos($photo, '-') !== FALSE)
        {
            list($photo, $fullsize) = split('-', $photo);
        }

        $photo_info = ORM::factory('photo')->where('uniqueid', '=', $photo)->find();

        if ( ! $photo_info->loaded())
        {
            Request::instance()->redirect('profile/' . $username);
        }

        if ($username != Core::$user->username AND $photo_info->approved == 'Adult' AND ! Functions::check_paidmember(FALSE))
        {
            //Notify::set('info', 'You must ' . HTML::anchor('user/upgrade', 'Upgrade') . ' your account to access members adult photos');

            Request::instance()->redirect('user/upgrade');
        }

        if ($username != Core::$user->username AND $photo_info->approved == 'No')
        {
            Notify::set('info', 'The photo you have selected cannot be access until it has been approved.');

            Request::instance()->redirect('profile/' . $username);
        }

        if ($username == Core::$user->username OR Core::$user->membership->status >= ORM::factory('membership')->where('paid', '=', '1')->where('type' , '=', 'Gold')->order_by('status', 'ASC')->find()->status)
        {
            $allow_fullsize = TRUE;
        }
        else
        {
            $fullsize = FALSE;
        }

        if ($fullsize)
        {
            echo HTML::image(Content::factory($username)->get_photo($photo, null, null, (Core::$user->membership->type == 'Admin') ? TRUE : FALSE));
            $this->auto_render = FALSE;
        }
        else
        {
            $this->template->head->stylesheets = array(
	            Functions::src_file('assets/css/layout2.css') => 'screen',
	            Functions::src_file('assets/css/swurve.css') => 'screen',
	            Functions::src_file('assets/css/jquery.thumbnailScroller.css') => 'screen'
            );

            $this->add_javascript(array(Functions::src_file('assets/js/jquery-ui.min.js')));
            //$this->add_javascript(array('assets/js/jquery.thumbnailScroller.js'));

            $this->template->head->meta_title = $username . ' Photo';
            $this->template->content = View::factory('content/viewphoto2')->bind('username', $username)->bind('photo', $photo)->bind('allow_fullsize', $allow_fullsize);
        }
    }

    public function action_view($params)
    {
        list($username, $photo) = split('/', $params);

        $allow_fullsize = FALSE;
        $fullsize = FALSE;

        if (stripos($photo, '-') !== FALSE)
        {
            list($photo, $fullsize) = split('-', $photo);
        }

        $photo_info = ORM::factory('photo')->where('uniqueid', '=', $photo)->find();

        if ( ! $photo_info->loaded())
        {
            Request::instance()->redirect('profile/' . $username);
        }

        if ($username != Core::$user->username AND $photo_info->approved == 'Adult' AND ! Functions::check_paidmember(FALSE))
        {
            //Notify::set('info', 'You must ' . HTML::anchor('user/upgrade', 'Upgrade') . ' your account to access members adult photos');

            Request::instance()->redirect('user/upgrade');
        }

        if ($username != Core::$user->username AND $photo_info->approved == 'No')
        {
            Notify::set('info', 'The photo you have selected cannot be access until it has been approved.');

            Request::instance()->redirect('profile/' . $username);
        }

        if ($username == Core::$user->username OR Core::$user->membership->status >= ORM::factory('membership')->where('paid', '=', '1')->where('type' , '=', 'Gold')->order_by('status', 'ASC')->find()->status)
        {
            $allow_fullsize = TRUE;
        }
        else
        {
            $fullsize = FALSE;
        }

        if ($fullsize)
        {
            echo HTML::image(Content::factory($username)->get_photo($photo, null, null, (Core::$user->membership->type == 'Admin') ? TRUE : FALSE));
            $this->auto_render = FALSE;
        }
        else
        {
            $this->template->head->stylesheets = array(
	            Functions::src_file('assets/css/layout2.css') => 'screen',
	            Functions::src_file('assets/css/swurve.css') => 'screen',
	            Functions::src_file('assets/css/jquery.thumbnailScroller.css') => 'screen'
            );

            $this->add_javascript(array(Functions::src_file('assets/js/jquery-ui.min.js')));

            $this->template->head->meta_title = $username . ' Photo';
            $this->template->content = View::factory('content/viewphoto')->bind('username', $username)->bind('photo', $photo)->bind('allow_fullsize', $allow_fullsize);
        }
    }
}
