<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Mailbox extends Controller_Master
{
    function before()
    {
        parent::before();

        Functions::check_loggedin();
    }

    public function action_index()
    {
        $this->template->head->meta_title = 'Your Swurve Mailbox';
        $this->template->content = View::factory('content/mailbox')->bind('mail', $mail)->bind('pagination', $pagination);

        $total = ORM::factory('message')
            ->where('to_id', '=', Core::$user)
            ->where('deleted', '=', 'No')
            ->where('flag', '=', 'No');

        if (isset($_GET['filter']))
        {
            if ($_GET['filter'] == 'read')
            {
                $total->where('date_read', 'IS NOT', null);
            }
            else
            {
                $total->where('date_read', 'IS', null);
            }
        }

        $total = $total->find_all()->count();

        $pagination = Pagination::factory(
            array
            (
                'total_items' => $total,
                'items_per_page' => 10,
            )
        );

        $sql = 'SELECT `messages`.*
            FROM `messages`
            JOIN `users` ON `users`.`id` = `messages`.`from_id`
            JOIN `memberships` ON `memberships`.`id` = `users`.`membership_id`
            WHERE `messages`.`to_id` = ' . Core::$user . ' and `messages`.`deleted` = \'No\' and `messages`.`flag` = \'No\'';

        if (isset($_GET['filter']))
        {
            if ($_GET['filter'] == 'read')
            {
                $sql .= 'AND date_read IS NOT NULL';
            }
            else
            {
                $sql .= 'AND date_read IS NULL';
            }
        }


        $sql .= '
            ORDER BY CASE WHEN (`memberships`.`type` = \'Admin\' Or `memberships`.`type` = \'Platinum\') And `messages`.`date_read` IS NULL THEN 0 Else 1 END ASC, `messages`.`date_sent` DESC
            LIMIT ' . $pagination->items_per_page . '
            OFFSET ' . ($pagination->current_page - 1) * $pagination->items_per_page;

        $mail = DB::query(Database::SELECT, $sql)->as_object('Model_Message')->execute();
    }

    public function action_sent()
    {
        $this->template->head->meta_title = 'Your Swurve Mailbox';
        $this->template->content = View::factory('content/mailbox/sent')->bind('mail', $mail)->bind('pagination', $pagination);

        $total = ORM::factory('message', Core::$user)
            ->where('from_id', '=', Core::$user)
            ->find_all()
            ->count();

        $pagination = Pagination::factory(
            array
            (
                'total_items' => $total,
                'items_per_page' => 10,
            )
        );

        $mail = ORM::factory('message', Core::$user)->where('from_id', '=', Core::$user)->order_by('date_sent', 'DESC')->limit($pagination->items_per_page)->offset(($pagination->current_page - 1) * $pagination->items_per_page)->find_all();
    }

    public function action_read($message_id)
    {
        $this->template->head->meta_title = 'Your Swurve Mailbox';
        $this->template->content = View::factory('content/mailbox/read')->bind('message', $message);

        $message = ORM::factory('message', $message_id);

        if (!$message->loaded() OR ($message->to->id != Core::$user->id AND $message->from->id != Core::$user->id))
        {
            Notify::set('info', 'Please do not attempt to read others mail, this is a warning');

            Request::instance()->redirect('mailbox');
        }

        if ($message->message_type->type == 'Mail' AND $message->from->membership->type != 'Admin')
        {
            Functions::check_paidmember();
        }

        if ( ! isset($message->date_read))
        {
            $message->date_read = time();

            $message->save();
        }

        if ($message->from->id != Core::$user->id AND Functions::check_paidmember(FALSE))
        {
            $this->template->content .= View::factory('forms/message/reply')->bind('message', $message);
        }
    }


    public function action_reply($message_id)
    {
        Functions::check_paidmember();

        $message = ORM::factory('message', $message_id);

        if (!$message->loaded() OR $message->to->id != Core::$user->id)
        {
            Notify::set('info', 'Please do not attempt to reply to others mail, this is a warning');

            Request::instance()->redirect('mailbox');
        }

        if ($_POST)
        {
            Functions::check_maildailylimit();

            $post = $_POST;

            $reply = ORM::factory('message');

            $reply->to_id = $message->from;
            $reply->from_id = $message->to;
            $reply->message_type_id = ORM::factory('message_type', array('type' => 'Mail'));
            $reply->subject = $post['subject'];
            $reply->message = $post['message'];

            $filters = ORM::factory('filter')->find_all();

            if (Core::$user->gender == 'Female' AND Core::$user->username != 'Admin')
            {
                foreach($filters as $filter)
                {
                    $filter = str_replace('*', '.*?', $filter->filter);

                    if (preg_match('/' . $filter . '/i', $post['subject']))
                    {
                        $reply->flag = 'Yes';
                    }

                    if (preg_match('/' . $filter . '/i', $post['message']))
                    {
                        $reply->flag = 'Yes';
                    }
                }
            }

            if (ORM::factory('block')->where('user_id', '=', $reply->to_id)->where('block_id', '=', $reply->from_id)->find()->loaded())
            {
                $reply->deleted = 'Yes';
                $reply->date_deleted = time();
            }
            else
            {
                Functions::send_email($message->from, Core::$user);
            }

            $reply->save();

            Notify::set('pass', 'Your message was successfully sent to ' . $message->from->username);

            Request::instance()->redirect('mailbox');
        }
        else
        {
            Request::instance()->redirect('mailbox/read/' . $message);
        }
    }
}