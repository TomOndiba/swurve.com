<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Message extends Controller_Master {
    function before()
    {
        parent::before();

        Functions::check_loggedin();
    }

    public function action_new($user = '')
    {
        $this->template->head->meta_title = 'Send New Message';
        $this->template->content = View::factory('forms/message/new')->bind('to', $to)->bind('from', $from);

        if ($_POST)
        {
            $user = $_POST['to'];
        }

        $to = ORM::factory('user', array('username' => $user));
        $from = Core::$user;

        if ( ! Functions::check_paidmember(FALSE))
        {
            Request::instance()->redirect('user/upgrade');
        }

        if ($to->membership->type == 'Admin')
        {
            Notify::set('info', 'Admin accounts cannot be contacted directly, if you need help with anything on the site please contact ' . HTML::mailto('support@swurve.com') . ', thank you.');

            Request::instance()->redirect(Request::$referrer);
        }

        if ($_POST)
        {
            Functions::check_maildailylimit();

            $post = $_POST;

            $message = ORM::factory('message');

            $message->to_id = $to;
            $message->from_id = $from;
            $message->message_type_id = ORM::factory('message_type', array('type' => 'Mail'));
            $message->subject = $post['subject'];
            $message->message = Text::auto_p($post['message']);

            $filters = ORM::factory('filter')->find_all();

            if (Core::$user->gender == 'Female' AND Core::$user->username != 'Admin')
            {
                foreach($filters as $filter)
                {
                    $filter = str_replace('*', '.*?', $filter->filter);

                    if (preg_match('/' . $filter . '/i', $post['message']))
                    {
                        $message->flag = 'Yes';
                    }

                    if (preg_match('/' . $filter . '/i', $post['subject']))
                    {
                        $message->flag = 'Yes';
                    }
                }
            }

            if (ORM::factory('block')->where('user_id', '=', $to)->where('block_id', '=', $from)->find()->loaded())
            {
                $message->deleted = 'Yes';
                $message->date_deleted = time();
            }
            else
            {
                Functions::send_email($to, Core::$user);
            }

            $message->save();

            //Mailer::factory('user')->send_email($to);

            Notify::set('pass', 'Your message was successfully sent to ' . $to->username);

            if (isset($post['from']))
            {
                Request::instance()->redirect('profile/' . $to->username);
            }
            else
            {
                Request::instance()->redirect('mailbox');
            }
        }
    }

    public function action_flirt($user)
    {
        if (strpos($user, '/') !== FALSE)
        {
            list($user, $template_id) = explode('/', $user);
        }

        $to = ORM::factory('user', array('username' => $user));
        $from = Core::$user;

        if (isset($template_id))
        {
            $template = ORM::factory('template', $template_id);
            $message = ORM::factory('message');

            $sent_today = $message->where('to_id', '=', $to)
                ->where('from_id', '=', $from)
                ->where('message_type_id', '=', $template->message_type)
                ->where('date_sent', '>=', strtotime('now -1 month'))
                ->where('date_sent', '<=', strtotime('now'))
                ->find_all()->count();

            if ($sent_today === 1)
            {
                Notify::set('info', 'Flirts may only be sent once a month per person');

                Request::instance()->redirect('profile/' . $to->username);
            }

            $message->to_id = $to;
            $message->from_id = $from;
            $message->message_type_id = $template->message_type;
            $message->subject = Functions::template_replace($template->subject, $from, $to);
            $message->message = Text::auto_p(Functions::template_replace($template->message, $from, $to));

            if (ORM::factory('block')->where('user_id', '=', $to)->where('block_id', '=', $from)->find()->loaded())
            {
                $message->deleted = 'Yes';
                $message->date_deleted = time();
            }
            else
            {
                Functions::send_flirt($to, $from);
            }

            $message->save();

            //Mailer::factory('user')->send_flirt($to);

            Notify::set('pass', 'Your flirt was successfully sent');

            Request::instance()->redirect('profile/' . $to->username);
        }

        $this->template->head->meta_title = 'Send Flirt';
        $this->template->content = View::factory('forms/message/flirt')->bind('to', $to)->bind('from', $from)->bind('messages', $messages);

        $messages = ORM::factory('template')->where('message_type_id', '=', ORM::factory('message_type', array('type' => 'Flirt')))->find_all();

        if ($_POST)
        {
            $post = $_POST;

            ORM::factory('user')->login($post, $redirect);

            $errors = $post->errors('register');
        }
    }
}