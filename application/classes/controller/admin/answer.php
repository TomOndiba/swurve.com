<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Admin_Answer extends Controller_Master
{
    function before() 
    {
        parent::before();

        Functions::check_loggedin(TRUE, TRUE);
    }
    
    function action_refav($user)
    {
        set_time_limit(0);
        
        $community = ORM::factory('user', array('username' => $user));
        //$community->online->update($community);
        
        $crushes = ORM::factory('contact')->with('contact_type')->where('to_id', '=', $community)->where('type', '=', 'Favorite')->find_all();

        $count = 0;
        
        foreach ($crushes as $crush)
        {
            $message_type = ORM::factory('message_type', array('type' => 'Favorite'));
            $message = ORM::factory('message');

            $message->to_id = $crush->from_id;          
            $message->from_id = $crush->to_id;
            $message->message_type_id = $message_type;

            $crush->contact_type_id = ORM::factory('contact_type', array('type' => 'Match'));

            $crush->save();

            $message->subject = $community->username . ' has Faved you and became a HookUp';
            $message->message = Functions::template_replace('|from| has added you to there Faves, since you also have them added as a Fave you are now a HookUp.', $crush->to, $crush->from);

            $message->save();

            Functions::send_match($crush->from, $crush->to);
            //Mailer::factory('user')->send_match($from, $to);

            $count++;
        }
        
        Notify::set('pass', $count . ' account(s) faved and became a hookup for ' . $user);
        
        Request::instance()->redirect(Request::$referrer);
    }
    
    function action_all($user)
    {
        set_time_limit(0);
        
        $this->template->head->meta_title = 'Admin Area';
        $this->template->content = View::factory('admin/answer/emails')->bind('post', $post)->bind('pagination', $pagination)->bind('results', $results)->bind('messagetypes', $messagetypes);
        
        $from = ORM::factory('user', array('username' => $user));
        
        if ($_POST)
        {
            $post = $_POST;
            
            if (isset($post['markmultiple']) AND $post['markmultiple'] == '1')
            {
                $sql = "UPDATE messages m1
                        INNER JOIN (SELECT id
                            FROM messages m
                            WHERE to_id = " . $from . " AND date_read IS NULL AND m.id NOT IN (
                                SELECT MAX(id) AS id
                                FROM messages 
                                WHERE to_id = " . $from . " AND date_read IS NULL
                                GROUP BY message_type_id, from_id
                        )) m2 ON m1.id = m2.id
                        SET m1.date_read = UNIX_TIMESTAMP()";
                        
                DB::query(Database::UPDATE, $sql)->execute();
            }

            if (isset($post['mark']))
            {
                foreach($post['mark'] as $message_id) {
                    $message = ORM::factory('message', $message_id);
                    $message->date_read = time();
                    $message->save();

                    if ( ! empty($post[$message_id . '_message']))
                    {
                        $reply = ORM::factory('message');
                        $reply->to_id = $message->from_id;
                        $reply->from_id = $message->to_id;
                        $reply->date_sent = time();
                        $reply->message_type_id = ORM::factory('message_type', array('type' => 'Mail'));
                        $reply->subject = (substr($message->subject, 0, 3) != 'RE:') ? 'RE: ' . $message->subject : $message->subject;
                        $reply->message = $post[$message_id . '_message'];
                        $reply->save();

                        Functions::send_email($message->from, $message->to);
                        //Mailer::factory('user')->send_email($message->to, $message->from);
                    }
                }
            }
        }
        
        $sql = "SELECT * 
                FROM messages m
                INNER JOIN (
                    SELECT MAX(id) AS id
                    FROM messages 
                    WHERE to_id = " . $from . " AND date_read IS NULL
                    GROUP BY message_type_id, from_id
                ) d ON m.id = d.id";
        
        $results = DB::query(Database::SELECT, $sql)->as_object('Model_Message')->execute();
        //$results = $from->messages->where('date_read', 'IS', new Database_Expression('NULL'))->find_all();
        
        $sql = "SELECT DISTINCT `message_types`.* FROM `message_types`
                INNER JOIN `messages` ON `messages`.`message_type_id` = `message_types`.`id`
                WHERE `messages`.`to_id` = '" . $from . "' AND `date_read` IS NULL";

        $messagetypes = array('0' => 'All Messages') + DB::query(Database::SELECT, $sql)->execute()->as_array('id', 'type');
    }
}