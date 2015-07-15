<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Playbook extends Controller_Master
{
    function before()
    {
        parent::before();

        Functions::check_loggedin();
    }

    public function action_index()
    {
        $this->template->content = View::factory('content/playbook')->bind('favorites', $favorites)->bind('matches', $matches)->bind('admirers', $admirers)
            ->bind('favorites_pagination', $favorites_pagination)->bind('matches_pagination', $matches_pagination)->bind('admirers_pagination', $admirers_pagination);

        $total = ORM::factory('contact')->with('contact_type')->where('from_id', '=', Core::$user)->where('type', '=', 'Favorite')->find_all()->count();

        $favorites_pagination = Pagination::factory(
            array
            (
                'current_page'   => array('source' => 'query_string', 'key' => 'fpage'),
                'total_items' => $total,
                'items_per_page' => 10,
                'view'           => 'pagination/digg',
            )
        );

        $favorites = ORM::factory('contact')->with('contact_type')->where('from_id', '=', Core::$user)->where('type', '=', 'Favorite')->limit($favorites_pagination->items_per_page)->offset(($favorites_pagination->current_page - 1) * $favorites_pagination->items_per_page)->find_all();


        $total = ORM::factory('contact')->with('contact_type')->where_open()->where('to_id', '=', Core::$user)->or_where('from_id', '=', Core::$user)->where_close()->and_where('type', '=', 'Match')->find_all()->count();

        $matches_pagination = Pagination::factory(
            array
            (
                'current_page'   => array('source' => 'query_string', 'key' => 'mpage'),
                'total_items' => $total,
                'items_per_page' => 10,
                'view'           => 'pagination/digg',
            )
        );

        $matches = ORM::factory('contact')->with('contact_type')->where_open()->where('to_id', '=', Core::$user)->or_where('from_id', '=', Core::$user)->where_close()->and_where('type', '=', 'Match')->limit($matches_pagination->items_per_page)->offset(($matches_pagination->current_page - 1) * $matches_pagination->items_per_page)->find_all();


        $total = ORM::factory('contact')->with('contact_type')->where('to_id', '=', Core::$user)->where('type', '=', 'Favorite')->find_all()->count();

        $admirers_pagination = Pagination::factory(
            array
            (
                'current_page'   => array('source' => 'query_string', 'key' => 'apage'),
                'total_items' => $total,
                'items_per_page' => 10,
                'view'           => 'pagination/digg',
            )
        );

        $admirers = ORM::factory('contact')->with('contact_type')->where('to_id', '=', Core::$user)->where('type', '=', 'Favorite')->limit($admirers_pagination->items_per_page)->offset(($admirers_pagination->current_page - 1) * $admirers_pagination->items_per_page)->find_all();
    }

    public function action_favorite($user)
    {
        $to = ORM::factory('user', array('username' => $user));
        $from = Core::$user;

        $contact = ORM::factory('contact')
            ->where_open()
            ->where('to_id', '=', $from)
            ->and_where('from_id', '=', $to)
            ->where_close()
            ->or_where_open()
            ->where('to_id', '=', $to)
            ->and_where('from_id', '=', $from)
            ->where_close()
            ->find();

        $message_type = ORM::factory('message_type', array('type' => 'Favorite'));
        $message = ORM::factory('message');

        $message->to_id = $to;
        $message->from_id = $from;
        $message->message_type_id = $message_type;

        if ( ! $contact->loaded())
        {
            $contact->from_id = $from;
            $contact->to_id = $to;
            $contact->contact_type_id = ORM::factory('contact_type', array('type' => 'Favorite'));
            $contact->save();

            $message->subject = $from->username . ' has Faved you';
            $message->message = Functions::template_replace('|from| has added you to there Faves, if you share the same feelings, you should add them to your Faves and become a HookUp.', $from, $to);

            if (ORM::factory('block')->where('user_id', '=', $to)->where('block_id', '=', $from)->find()->loaded())
            {
                $message->deleted = 'Yes';
                $message->date_deleted = time();
            }
            else
            {
                Functions::send_fave($to, $from);
            }

            $message->save();

            //Mailer::factory('user')->send_fave($to);

            Notify::set('pass', $to->username . ' has been added to your Faves');
        }
        else
        {
            if ($contact->from->id == $from->id AND $contact->to->id == $to->id AND $contact->contact_type->type == 'Favorite')
            {
                $contact->delete();

                Notify::set('pass', $to->username . ' has been removed from your Faves');
            }
            elseif ($contact->from->id == $from->id AND $contact->to->id == $to->id AND $contact->contact_type->type == 'Match')
            {
                $contact->from_id = $to;
                $contact->to_id = $from;
                $contact->contact_type_id = ORM::factory('contact_type', array('type' => 'Favorite'));
                $contact->save();

                Notify::set('pass', $to->username . ' has been removed from your Faves');
            }
            elseif ($contact->from->id == $to->id AND $contact->to->id == $from->id AND $contact->contact_type->type == 'Favorite')
            {
                $contact->contact_type_id = ORM::factory('contact_type', array('type' => 'Match'));
                $contact->save();

                $message->subject = $from->username . ' has Faved you and became a HookUp';
                $message->message = Functions::template_replace('|from| has added you to there Faves, since you also have them added as a Fave you are now a HookUp.', $from, $to);

                if (ORM::factory('block')->where('user_id', '=', $to)->where('block_id', '=', $from)->find()->loaded())
                {
                    $message->deleted = 'Yes';
                    $message->date_deleted = time();
                }
                else
                {
                    Functions::send_match($to, $from);
                }

                $message->save();

                //Mailer::factory('user')->send_match($to);

                Notify::set('pass', $to->username . ' has been added to your Faves and became a HookUp since they also have you Faved');
            }
            elseif ($contact->from->id == $to->id AND $contact->to->id == $from->id AND $contact->contact_type->type == 'Match')
            {
                $contact->contact_type_id = ORM::factory('contact_type', array('type' => 'Favorite'));
                $contact->save();

                Notify::set('pass', $to->username . ' has been removed from your Faves');
            }
        }

        Request::instance()->redirect('profile/' . $to->username);
    }
}