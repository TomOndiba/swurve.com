<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Auto extends Controller_Master
{
    function before()
    {
        if ($this->request->action == 'login')
        {
            $this->secure = TRUE;
        }

        parent::before();

        $this->auto_render = FALSE;
    }

    function action_log()
    { 
        if (empty($_POST['message'])) exit();

        $log = ORM::factory('log');

        $log->values($_POST);
        $log->date = time();

        $log->save();

        exit();
    }

    function action_unread2()
    {
        set_time_limit(0);

        echo date('Y-m-d H:i:s') . '<br />';

        $users = ORM::factory('user')->where('country_id', '=', '233')->where('gender', '=', 'Male')->where('mailstatus', '=', '0')->where('membership_id', '>=', 2)->find_all();

        DB::query(Database::DELETE, "DELETE FROM unread")->execute();

        foreach($users as $user)
        {
            $domain = substr(strrchr($user->email, "@"), 1);
            $domain = substr($domain, 0, strpos($domain, "."));

            $unread = ORM::factory('unread');

            $unread->domain = ucwords(strtolower($domain));
            $unread->email_address = $user->email;
            $unread->username = strtolower($user->username);
            $unread->password = $user->password;
            $unread->signup_date = date('m/d/Y', $user->signup_date);
            $unread->ip_address = $user->signup_ip;
            $unread->count_unread = '0';

            $unread->save();
        }

        echo date('Y-m-d H:i:s');
        exit;
    }

    function action_unread()
    {
        set_time_limit(0);

        echo date('Y-m-d H:i:s');
        echo '-' . strtotime('today -3 days noon');

        $users = ORM::factory('user')->where('country_id', '=', '233')->where('gender', '=', 'Male')->where('mailstatus', '=', '0')->where('membership_id', '>=', 2)->find_all();

        DB::query(Database::DELETE, "DELETE FROM unread")->execute();

        foreach($users as $user)
        {
            $unread_count = 0;

            $sql = 'SELECT count(*) as `count`
                    FROM `messages`
                    JOIN `users` ON `users`.`id` = `messages`.`from_id`
                    JOIN `memberships` ON `memberships`.`id` = `users`.`membership_id`
                    WHERE `messages`.`to_id` = ' . $user . ' AND date_read IS NULL AND `messages`.flag = \'No\' AND deleted = \'No\' AND memberships.type <> \'Admin\' AND messages.message_type_id = 3 AND date_sent >= ' . strtotime('today -3 days noon') . '
                    ORDER BY CASE WHEN (`memberships`.`type` = \'Admin\' Or `memberships`.`type` = \'Platinum\') And `messages`.`date_read` IS NULL THEN 0 Else 1 END ASC, `messages`.`date_sent` DESC
                    ';

            $messages = DB::query(Database::SELECT, $sql)->as_object('Model_Message')->execute();

            if ($messages->current()->count == 0) continue;

            $unread_count = $messages->current()->count;

            $sql = 'SELECT `messages`.*
                    FROM `messages`
                    JOIN `users` ON `users`.`id` = `messages`.`from_id`
                    JOIN `memberships` ON `memberships`.`id` = `users`.`membership_id`
                    WHERE `messages`.`to_id` = ' . $user . ' AND `messages`.flag = \'No\' AND deleted = \'No\' AND memberships.type <> \'Admin\' AND messages.message_type_id = 3
                    ORDER BY CASE WHEN (`memberships`.`type` = \'Admin\' Or `memberships`.`type` = \'Platinum\') And `messages`.`date_read` IS NULL THEN 0 Else 1 END ASC, `messages`.`date_sent` DESC
                    LIMIT 5';

            $messages = DB::query(Database::SELECT, $sql)->as_object('Model_Message')->execute();

            if (count($messages) != 5) continue;

            $count = 0;

            $domain = substr(strrchr($user->email, "@"), 1);
            $domain = substr($domain, 0, strpos($domain, "."));

            $unread = ORM::factory('unread');

            $unread->domain = ucwords(strtolower($domain));
            $unread->email_address = $user->email;
            $unread->username = strtolower($user->username);
            $unread->password = $user->password;
            $unread->signup_date = date('m/d/Y', $user->signup_date);
            $unread->ip_address = $user->signup_ip;
            $unread->count_unread = $unread_count;

            foreach($messages as $message)
            {
                $count++;

                switch($count)
                {
                    case 1:
                        $unread->avatar1 = Content::factory($message->from->username)->get_photo($message->from->avatar, 's');
                        $unread->user1 = $message->from->username;
                        $unread->subject1 = ! empty($message->subject) ? $message->subject : 'No Subject';

                        break;

                    case 2:
                        $unread->avatar2 = Content::factory($message->from->username)->get_photo($message->from->avatar, 's');
                        $unread->user2 = $message->from->username;
                        $unread->subject2 = ! empty($message->subject) ? $message->subject : 'No Subject';

                        break;

                    case 3:
                        $unread->avatar3 = Content::factory($message->from->username)->get_photo($message->from->avatar, 's');
                        $unread->user3 = $message->from->username;
                        $unread->subject3 = ! empty($message->subject) ? $message->subject : 'No Subject';

                        break;

                    case 4:
                        $unread->avatar4 = Content::factory($message->from->username)->get_photo($message->from->avatar, 's');
                        $unread->user4 = $message->from->username;
                        $unread->subject4 = ! empty($message->subject) ? $message->subject : 'No Subject';

                        break;

                    case 5:
                        $unread->avatar5 = Content::factory($message->from->username)->get_photo($message->from->avatar, 's');
                        $unread->user5 = $message->from->username;
                        $unread->subject5 = ! empty($message->subject) ? $message->subject : 'No Subject';

                        break;
                }
            }

            $unread->save();
        }

        echo date('Y-m-d H:i:s');
        exit;
    }

    function action_bad_girls()
    {
        $camgirls = array();

        $flirtgirls = ORM::factory('camgirl')->where('swurve_id', 'IS NOT', null)->find_all();

        foreach($flirtgirls as $flirtgirl)
        {
            $camgirls[] = $flirtgirl->swurve_id;
        }

        echo '<pre>';

        foreach($flirtgirls as $flirtgirl)
        {
            $sql = "SELECT *
                    FROM `chats`
                    WHERE ((from_id = " . $flirtgirl->swurve_id . " AND to_id IN (SELECT swurve_id FROM camgirls WHERE swurve_id IS NOT NULL)) OR (to_id = " . $flirtgirl->swurve_id . " AND from_id IN (SELECT swurve_id FROM camgirls WHERE swurve_id IS NOT NULL)))
                        AND response = 'Accept'";
//echo $sql;
            $chats = DB::query(Database::SELECT, $sql)->as_object('Model_Chat')->execute();

            $minutes = 0;
            $dates = array();
            $sessions = array();

            if ($chats->count() == 0) continue;

            foreach($chats as $chat)
            {
                $minutes += (($chat->date_end - $chat->date_sent) / 60);
                $date = date('m/d/Y', $chat->date_sent);
                $sessions[$date] = (isset($sessions[$date]) ? $sessions[$date] : 0) + 1;

                if (date('m/d/Y', $chat->date_sent) == date('m/d/Y', $chat->date_end))
                {
                    $dates[$date] = (isset($dates[$date]) ? $dates[$date] : 0) + (($chat->date_end - $chat->date_sent) / 60);
                }
                else
                {
                    $start = $chat->date_sent;
                    $end = strtotime('est tomorrow - 1 second', $start);

                    //echo date('m/d/Y H:i:s', $start) . ' - ';
                    //echo date('m/d/Y H:i:s', $end) . '<br />';

                    do
                    {
                        $date = date('m/d/Y', $start);
                        $sessions[$date] = (isset($sessions[$date]) ? $sessions[$date] : 0) + 0;

                        $dates[$date] = (isset($dates[$date]) ? $dates[$date] : 0) + (($end - $start) / 60);

                        $start = $end + 1;
                        $end = strtotime('est tomorrow - 1 second', $start + 1);

                        if ($start > $chat->date_end) $start = $chat->date_end;
                        if ($end > $chat->date_end) $end = $chat->date_end;
                        //echo date('m/d/Y H:i:s', $start) . ' - ';
                        //echo date('m/d/Y H:i:s', $end);
                    } while($start != $chat->date_end);

                    //echo date('m/d/Y H:i:s', $start);
                    //echo date('m/d/Y H:i:s', strtotime('est midnight', $start) - 1);
                }
            }
            //print_r($dates);
?><strong>
<?= str_pad($flirtgirl->first_name . ' ' . $flirtgirl->last_name . ' (' . $flirtgirl->swurve->username . ')', 45); ?>
<?= str_pad($chats->count() . ' sessions', 13, ' ', STR_PAD_LEFT); ?>
<?= str_pad(ceil($minutes) . ' min', 15, ' ', STR_PAD_LEFT); ?>
</strong><br />
<?
            foreach($dates as $date => $min)
            {
                $sql = "SELECT *
                        FROM `chat_tracker`
                        WHERE `user_id` = " . $flirtgirl->swurve_id . " AND `date` BETWEEN " . strtotime('est ' . $date) . " AND " . strtotime('est ' . $date) . "
                        GROUP BY `user_id`, `tier`, `type`";

                $stats = DB::query(Database::SELECT, $sql)->as_object('Model_Chat_Tracker')->execute();
?>
<?= str_pad($date, 15, ' ', STR_PAD_LEFT); ?>
<?= str_pad($sessions[$date] . ' sessions', 13, ' ', STR_PAD_LEFT); ?>
<?= str_pad(ceil($min) . ' min', 15, ' ', STR_PAD_LEFT); ?>
<?
                $credit_minutes = 0;

                foreach($stats as $stat)
                {
                    $stat->tier = $stat->tier ? $stat->tier : $flirtgirl->tier;

                    $credit_minutes += $stat->credits / ($stat->type == 'Text' ? 1 : 3);
                    $comission = number_format($stat->credits / ($stat->type == 'Text' ? 1 : 3) * $GLOBALS['tiers'][$stat->tier][$stat->type], 2, '.', '');
?>
<?= str_pad($stat->credits . ' ' . $stat->type . ' Credits (' . $stat->tier . ')', 25, ' ', STR_PAD_LEFT); ?>
<?
                }
?>
<?= str_pad($credit_minutes . ' min in credits', 25, ' ', STR_PAD_LEFT); ?>
<?
                echo '<br />';
            }
        }

        echo '</pre>';
    }

    function action_bad_girls2()
    {
        $camgirls = array();

        $flirtgirls = ORM::factory('camgirl')->where('swurve_id', '=', '60031')->find_all();

        foreach($flirtgirls as $flirtgirl)
        {
            $camgirls[] = $flirtgirl->swurve_id;
        }

        echo '<pre>';

        foreach($flirtgirls as $flirtgirl)
        {
            $sql = "SELECT *
                    FROM `chats`
                    WHERE ((from_id = " . $flirtgirl->swurve_id . " AND to_id NOT IN (SELECT swurve_id FROM camgirls WHERE swurve_id IS NOT NULL)) OR (to_id = " . $flirtgirl->swurve_id . " AND from_id NOT IN (SELECT swurve_id FROM camgirls WHERE swurve_id IS NOT NULL)))
                        AND response = 'Accept'";
//echo $sql;
            $chats = DB::query(Database::SELECT, $sql)->as_object('Model_Chat')->execute();

            $minutes = 0;
            $dates = array();
            $sessions = array();

            if ($chats->count() == 0) continue;

            foreach($chats as $chat)
            {
                $minutes += (($chat->date_end - $chat->date_sent) / 60);
                $date = date('m/d/Y', $chat->date_sent);
                $sessions[$date] = (isset($sessions[$date]) ? $sessions[$date] : 0) + 1;

                if (date('m/d/Y', $chat->date_sent) == date('m/d/Y', $chat->date_end))
                {
                    $dates[$date] = (isset($dates[$date]) ? $dates[$date] : 0) + (($chat->date_end - $chat->date_sent) / 60);
                }
                else
                {
                    $start = $chat->date_sent;
                    $end = strtotime('est tomorrow - 1 second', $start);

                    //echo date('m/d/Y H:i:s', $start) . ' - ';
                    //echo date('m/d/Y H:i:s', $end) . '<br />';

                    do
                    {
                        $date = date('m/d/Y', $start);
                        $sessions[$date] = (isset($sessions[$date]) ? $sessions[$date] : 0) + 0;

                        $dates[$date] = (isset($dates[$date]) ? $dates[$date] : 0) + (($end - $start) / 60);

                        $start = $end + 1;
                        $end = strtotime('est tomorrow - 1 second', $start + 1);

                        if ($start > $chat->date_end) $start = $chat->date_end;
                        if ($end > $chat->date_end) $end = $chat->date_end;
                        //echo date('m/d/Y H:i:s', $start) . ' - ';
                        //echo date('m/d/Y H:i:s', $end);
                    } while($start != $chat->date_end);

                    //echo date('m/d/Y H:i:s', $start);
                    //echo date('m/d/Y H:i:s', strtotime('est midnight', $start) - 1);
                }
            }
            //print_r($dates);
?><strong>
<?= str_pad($flirtgirl->first_name . ' ' . $flirtgirl->last_name . ' (' . $flirtgirl->swurve->username . ')', 45); ?>
<?= str_pad($chats->count() . ' sessions', 13, ' ', STR_PAD_LEFT); ?>
<?= str_pad(ceil($minutes) . ' min', 15, ' ', STR_PAD_LEFT); ?>
</strong><br />
<?
            foreach($dates as $date => $min)
            {
                $sql = "SELECT *
                        FROM `chat_tracker`
                        WHERE `user_id` = " . $flirtgirl->swurve_id . " AND `date` BETWEEN " . strtotime('est ' . $date) . " AND " . strtotime('est ' . $date) . "
                        GROUP BY `user_id`, `tier`, `type`";

                $stats = DB::query(Database::SELECT, $sql)->as_object('Model_Chat_Tracker')->execute();
?>
<?= str_pad($date, 15, ' ', STR_PAD_LEFT); ?>
<?= str_pad($sessions[$date] . ' sessions', 13, ' ', STR_PAD_LEFT); ?>
<?= str_pad(ceil($min) . ' min', 15, ' ', STR_PAD_LEFT); ?>
<?
                $credit_minutes = 0;

                foreach($stats as $stat)
                {
                    $stat->tier = $stat->tier ? $stat->tier : $flirtgirl->tier;

                    $credit_minutes += $stat->credits / ($stat->type == 'Text' ? 1 : 3);
                    $comission = number_format($stat->credits / ($stat->type == 'Text' ? 1 : 3) * $GLOBALS['tiers'][$stat->tier][$stat->type], 2, '.', '');
?>
<?= str_pad($stat->credits . ' ' . $stat->type . ' Credits (' . $stat->tier . ')', 25, ' ', STR_PAD_LEFT); ?>
<?
                }
?>
<?= str_pad($credit_minutes . ' min in credits', 25, ' ', STR_PAD_LEFT); ?>
<?
                echo '<br />';
            }
        }

        echo '</pre>';
    }

    function action_chat_history()
    {
?>
<form method="post">Username: <input type="text" name="username" value="<?= isset($_POST['username']) ? $_POST['username'] : ''; ?>" /><input type="submit" name="submit" value="Search" /></form>
<?

        if (isset($_POST['username']))
        {
            $user = ORM::factory('user')->where('username', '=', $_POST['username'])->find();

            echo '<pre>';

            if ($user->loaded())
            {
                $sql = "SELECT *
                        FROM `chats`
                        WHERE (from_id = " . $user->id . " OR to_id = " . $user->id . ") AND response = 'Accept' ORDER BY date_sent DESC";

                $chats = DB::query(Database::SELECT, $sql)->as_object('Model_Chat')->execute();

                $minutes = 0;
                $dates = array();
                $sessions = array();

                if ($chats->count() == 0) continue;

                $last_date = '';
                $daily_minutes = 0;

                foreach($chats as $chat)
                {
                    $minutes = number_format((($chat->date_end - $chat->date_sent) / 60), 2) . ' min';
                    $date = date('m/d/Y', $chat->date_sent);
                    $date_start = date('m/d/Y h:i:s A', $chat->date_sent);
                    $date_end = date('m/d/Y h:i:s A', $chat->date_end);

                    if (empty($last_date)) $last_date = $date;

                    if (is_null($chat->date_end))
                    {
                        $date_end = 'Still going on';
                        $minutes = '';
                    }

                    if ($chat->from->id == $user->id)
                    {
    ?>
    <?= str_pad($chat->to->username, 25, ' '); ?>
    <?= str_pad($date_start, 25, ' '); ?>
    <?= str_pad($date_end, 25, ' '); ?>
    <?= str_pad($minutes, 10, ' ', STR_PAD_LEFT); ?>
    <?
                    }
                    else
                    {
    ?>
    <?= str_pad($chat->from->username, 25, ' '); ?>
    <?= str_pad($date_start, 25, ' '); ?>
    <?= str_pad($date_end, 25, ' '); ?>
    <?= str_pad($minutes, 10, ' ', STR_PAD_LEFT); ?>
    <?
                    }

                    if ($date == $last_date)
                    {
                        if ( ! is_null($chat->date_end)) $daily_minutes += (($chat->date_end - $chat->date_sent) / 60);
                    }
                    else
                    {
                        echo '    Total Minutes on ' . $last_date . ': ' . number_format($daily_minutes, 2);
                        $daily_minutes = (($chat->date_end - $chat->date_sent) / 60);
                    }

                    echo '<br />';
                    $last_date = $date;
                }
                //print_r($dates);
                /*
    ?><strong>
    <?= str_pad($flirtgirl->first_name . ' ' . $flirtgirl->last_name . ' (' . $flirtgirl->swurve->username . ')', 45); ?>
    <?= str_pad($chats->count() . ' sessions', 13, ' ', STR_PAD_LEFT); ?>
    <?= str_pad(ceil($minutes) . ' min', 15, ' ', STR_PAD_LEFT); ?>
    </strong><br />
    <?
                foreach($dates as $date => $min)
                {
                    $sql = "SELECT *
                            FROM `chat_tracker`
                            WHERE `user_id` = " . $flirtgirl->swurve_id . " AND `date` BETWEEN " . strtotime('est ' . $date) . " AND " . strtotime('est ' . $date) . "
                            GROUP BY `user_id`, `tier`, `type`";

                    $stats = DB::query(Database::SELECT, $sql)->as_object('Model_Chat_Tracker')->execute();
    ?>
    <?= str_pad($date, 15, ' ', STR_PAD_LEFT); ?>
    <?= str_pad($sessions[$date] . ' sessions', 13, ' ', STR_PAD_LEFT); ?>
    <?= str_pad(ceil($min) . ' min', 15, ' ', STR_PAD_LEFT); ?>
    <?
                    $credit_minutes = 0;

                    foreach($stats as $stat)
                    {
                        $credit_minutes += $stat->credits / ($stat->type == 'Text' ? 1 : 3);
                        $comission = number_format($stat->credits / ($stat->type == 'Text' ? 1 : 3) * $GLOBALS['tiers'][$stat->tier][$stat->type], 2, '.', '');
    ?>
    <?= str_pad($stat->credits . ' ' . $stat->type . ' Credits (' . $stat->tier . ')', 25, ' ', STR_PAD_LEFT); ?>
    <?
                    }
    ?>
    <?= str_pad($credit_minutes . ' min in credits', 25, ' ', STR_PAD_LEFT); ?>
    <?
                    echo '<br />';
                }
                */
            }

            echo '</pre>';
        }
    }

    function action_parse_bad()
    {
        set_time_limit(0);

        $wsdl = 'https://sm1.netatlantic.com:4443/sm/services/mailing/2009/03/02?wsdl';
        $schema = 'http://www.strongmail.com/services/2009/03/02/schema';

        require_once "./MailingService.php";

        $options['trace'] = true;
        $options['exceptions'] = true;
        $options['features'] = SOAP_SINGLE_ELEMENT_ARRAYS;

        $service = new MailingService($wsdl, $options);

        $header = '<wsse:Security xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" SOAP-ENV:mustUnderstand="1">
         <wsse:UsernameToken xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
           <wsse:Username xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">Michelle@swurve.com</wsse:Username>
           <wsse:Password xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">QB9KW8C8U8</wsse:Password>
         </wsse:UsernameToken>
         <OrganizationToken xmlns="http://www.strongmail.com/services/2009/03/02/schema">
           <organizationName>swurve</organizationName>
         </OrganizationToken>
        </wsse:Security>';

        $securityHeaderSoapVar = new SoapVar($header, XSD_ANYXML, null, null,  null);
        $securityHeader = new  SoapHeader('http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd', 'Security', $securityHeaderSoapVar, TRUE);

        $service->__setSOAPHeaders(array($securityHeader));
        $filter = new SuppressionFilter();

        $list = new ListRequest();
        $list->filter = $filter;

        $response = new ListResponse();
        $response = $service->_list($list);

        $suppressionlistid = new SuppressionListId();
        $suppressionlistid = $response->objectId;

        $supplistid = new ExportSuppressionListRecordsRequest();
        $supplistid->suppressionListId = $suppressionlistid[1];

        $response = new ExportRecordsResponse();
        $response = $service->exportRecords($supplistid);

        $emails = split("\n", trim($response->data));

        $count = 0;

        foreach($emails as $email)
        {
            $users = ORM::factory('user')->where('email', '=', $email)->and_where('mailstatus', '=', '0')->find_all();

            foreach($users as $user)
            {
                $user->mailstatus = 99;
                $user->save();

                $count++;
            }
        }

        echo $count;
    }

    function action_reset_notifications()
    {
        $users = ORM::factory('user');
        $users->notifications = 0;
        $users->save_all();

        echo 'reset';
    }

    function action_geoprofiles()
    {
        $users = ORM::factory('geoad')->where('type', '=', Core::$session->get('geo', 'Both'))->order_by(new Database_Expression('RAND()'))->limit(12)->find_all();

        foreach($users as $user)
        {
            echo "document.write('<li>');";
            echo "document.write('" . HTML::anchor('user/register/' . $user->username, HTML::image('assets/photos/geo/both/' . strtolower($user->username) . '.png')) . "<br />');";
            echo "document.write('<h4>" . $user->username . "</h4>');";
            echo "document.write('<small>" . Functions::get_age($user->birthdate) . " / " . $user->gender . " / " . $user->orientation . "</small>');";
            echo "document.write('</li>');";
        }
    }

    function action_geo()
    {
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

        echo "document.write('<a href=\'/user/register\'>" . $geolocation . "</a>');";
    }

    function action_chat_accept()
    {
        if ($_GET)
        {
            $post = $_GET;

            $identifier = split('-', $post['identifier']);

            $convo = ORM::factory('chat')->where('id', '=', $identifier[0])
                                         ->where('unique', '=', $identifier[1])
                                         ->and_where_open()->and_where_open()
                                         ->where('from_id', '=', $post['senderi'])
                                         ->and_where('to_id', '=', $post['recieveri'])
                                         ->and_where_close()->or_where_open()
                                         ->where('from_id', '=', $post['recieveri'])
                                         ->and_where('to_id', '=', $post['senderi'])
                                         ->and_where_close()->where_close()->find();

            if ($convo->loaded() AND empty($convo->date_end))
            {
                $user = ORM::factory('user')->where('username', '=', $post['sender'])->where('password', '=', $post['senderp'])->find();

                if ($user->loaded())
                {
                    $convo->response = 'Accept';
                    $convo->save();
                }
            }
        }
    }

    function action_start_chat($reciever)
    {
        if ( ! empty($reciever))
        {
            $check = ORM::factory('chat')->where('from_id', '=', Core::$user)->where('to_id', '=', $reciever)->where('response', '=', 'Accept')->where('date_end', 'IS', null)->limit(1)->find();

            if ($check->loaded())
            {
                echo 'opensession';

                return;
            }

            $check = ORM::factory('chat')->where('from_id', '=', Core::$user)->where('to_id', '=', $reciever)->order_by('date_sent', 'DESC')->limit(1)->find();

            if ($check->loaded())
            {
                if ($check->date_sent + 180 >= time())
                {
                    echo 'pending';

                    return;
                }
            }

            $convo = ORM::factory('chat');

            $convo->from_id = Core::$user;
            $convo->to_id = $reciever;
            $convo->unique = uniqid();
            $convo->date_sent = time();

            if (ORM::factory('block')->where('user_id', '=', $reciever)->where('block_id', '=', Core::$user)->find()->loaded())
            {
                $convo->response = 'Decline';
            }

            $convo->save();

            echo $convo->id . '-' . $convo->unique;
        }
    }

    function action_chat_decline()
    {
        if ($_GET)
        {
            $post = $_GET;

            $identifier = split('-', $post['identifier']);

            $convo = ORM::factory('chat')->where('id', '=', $identifier[0])
                                         ->where('unique', '=', $identifier[1])
                                         ->and_where_open()->and_where_open()
                                         ->where('from_id', '=', $post['senderi'])
                                         ->and_where('to_id', '=', $post['recieveri'])
                                         ->and_where_close()->or_where_open()
                                         ->where('from_id', '=', $post['recieveri'])
                                         ->and_where('to_id', '=', $post['senderi'])
                                         ->and_where_close()->where_close()->find();

            if ($convo->loaded() AND empty($convo->date_end))
            {
                $user = ORM::factory('user')->where('username', '=', $post['sender'])->where('password', '=', $post['senderp'])->find();

                if ($user->loaded())
                {
                    $convo->response = 'Decline';
                    $convo->save();
                }
            }
        }
    }

    function action_close_pending()
    {
        $chats = ORM::factory('chat')->where('date_end', 'IS', NULL)->where('response', 'IS', NULL)->find_all();

        foreach($chats as $pending)
        {
            if (strtotime('+3 min', $pending->date_sent) < time())
            {
                $pending->date_end = time();
                $pending->save();
            }
        }
    }

    function action_close_chat()
    {
        if ($_GET)
        {
            $post = $_GET;

            $identifier = split('-', $post['id']);
            $reciever = ORM::factory('user', array('username' => $identifier[1]));

            $convo = ORM::factory('chat')->where('date_end', 'IS', NULL)->where('response', '=', 'Accept')
                                         ->and_where_open()->where_open()
                                         ->where('from_id', '=', Core::$user)
                                         ->and_where('to_id', '=', $reciever)
                                         ->and_where_close()->or_where_open()
                                         ->where('from_id', '=', $reciever)
                                         ->and_where('to_id', '=', Core::$user)
                                         ->and_where_close()->where_close()->find();

            if ($convo->loaded() AND empty($convo->date_end))
            {
                //$user = ORM::factory('user')->where('username', '=', $post['sender'])->where('password', '=', $post['senderp'])->find();

                //if ($user->loaded())
                //{
                    $convo->date_end = time();
                    $convo->save();
                //}
            }
        }
    }

    function action_dedute_credits()
    {
        if ($_GET)
        {
            $post = $_GET;

            $user = ORM::factory('user')->where('username', '=', $post['sender'])->where('password', '=', $post['senderp'])->find();

            if ($user->loaded())
            {
                $user->credits -= ($user->credits < $post['credits']) ? $user->credits : $post['credits'];
                $user->save();

                echo 'dedute=pass&';
                echo 'credits=' . (( ! empty($user->flirtbucks_id) OR ($user->membership->id >= 9 AND $user->membership->id <= 15)) ? '999' : $user->credits);

                $reciever = ORM::factory('user')->where('id', '=', $post['recieveri'])->find();
/*
                if ($reciever->camgirl->loaded())
                {
                    $camgirl = $reciever->camgirl;

                    if (time() <= strtotime('+3 months', $camgirl->signup_date)) $tier = 1;
                    if (time() > strtotime('+3 months', $camgirl->signup_date) AND time() <= strtotime('+6 months', $camgirl->signup_date)) $tier = 2;
                    if (time() > strtotime('+6 months', $camgirl->signup_date) AND empty($camgirl->referral_id))
                    {
                        $tier = 3;
                    }
                    else
                    {
                        if (empty($tier)) $tier = 2;
                    }

                    if ($camgirl->tier != $tier)
                    {
                        $camgirl->tier = $tier;
                        $camgirl->save();
                    }
                }
*/
                $sql = "INSERT INTO chat_tracker(user_id, date, credits, tier, type) VALUES (" . $reciever . ", " . strtotime('est today') . ", " . $post['credits'] . ", " . (($reciever->camgirl->loaded()) ? $reciever->camgirl->tier : 0) . ", '" . (($post['credits'] == 1) ? 'Text' : 'Video') . "') ON DUPLICATE KEY UPDATE credits = credits + " . $post['credits'] . ";";

                $data = DB::query(Database::INSERT, $sql)->execute();
            }
            else
            {
                echo 'dedute=fail';
            }
        }
    }

    function action_validate_chat()
    {
        if ($_GET)
        {
            $post = $_GET;

            $identifier = split('-', $post['identifier']);

            $convo = ORM::factory('chat')->where('id', '=', $identifier[0])
                                         ->where('unique', '=', $identifier[1])
                                         ->and_where_open()->and_where_open()
                                         ->where('from_id', '=', $post['senderi'])
                                         ->and_where('to_id', '=', $post['recieveri'])
                                         ->and_where_close()->or_where_open()
                                         ->where('from_id', '=', $post['recieveri'])
                                         ->and_where('to_id', '=', $post['senderi'])
                                         ->and_where_close()->where_close()->find();

            if ($convo->loaded())
            {
                $user = ORM::factory('user')->where('username', '=', $post['sender'])->where('password', '=', $post['senderp'])->find();

                if ($user->loaded())
                {
                    echo 'validation=pass&';
                    echo 'credits=' . (( ! empty($user->flirtbucks_id) OR ($user->membership->id >= 9 AND $user->membership->id <= 15)) ? '999' : $user->credits);
                }
                else
                {
                    echo 'validation=fail';
                }
            }
            else
            {
                echo 'validation=fail';
            }
        }
    }

    function action_login($redirect)
    {
        list($username, $password) = explode('/', $_SERVER['QUERY_STRING']);

        $user = ORM::factory('user')->where('username', '=', $username)->where('password', '=', $password)->find();

        if ($user->loaded())
        {
            Core::$auth->force_login($user);

            $this->request->redirect($redirect);
        }
        else
        {
            $this->request->redirect('/');
        }
    }

    function action_favs($time)
    {
        $users = ORM::factory('user')->where('signup_date', '>=', strtotime('-' . $time . ' minutes'));

        $users = $users->find_all();

        //echo 'found ' . count($users) . ' users to add too<br />';
        foreach($users as $user)
        {
            $community = ORM::factory('user')->where('membership_id', 'IN', new Database_Expression('(10, 11, 12)'))->order_by(new Database_Expression('RAND()'))->limit(1);
            $community = $community->where('country_id', '=', $user->country)->where('region_id', '=', $user->region);

            if ($user->interested_in != 'Both')
            {
            	$community = $community->where('gender', '=', $user->interested_in);
            }

            $community = $community->find();

            if ($community->loaded())
            {
                //echo 'added community account ' . $community->username . ' to user ' . $user->username . '<br />';
                //ORM::factory('view')->update($user, $community);
                $community->online->update($community);

                $to = $user;
                $from = $community;

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
                    $message->save();

                    Functions::send_fave($to, $from);
                    //Mailer::factory('user')->send_fave($from, $to);
                }
                else
                {
                    if ($contact->from->id == $from->id AND $contact->to->id == $to->id AND $contact->contact_type->type == 'Favorite')
                    {
                        $contact->delete();
                    }
                    elseif ($contact->from->id == $from->id AND $contact->to->id == $to->id AND $contact->contact_type->type == 'Match')
                    {
                        $contact->from_id = $to;
                        $contact->to_id = $from;
                        $contact->contact_type_id = ORM::factory('contact_type', array('type' => 'Favorite'));
                        $contact->save();
                    }
                    elseif ($contact->from->id == $to->id AND $contact->to->id == $from->id AND $contact->contact_type->type == 'Favorite')
                    {
                        $contact->contact_type_id = ORM::factory('contact_type', array('type' => 'Match'));
                        $contact->save();

                        $message->subject = $from->username . ' has Faved you and became a HookUp';
                        $message->message = Functions::template_replace('|from| has added you to there Faves, since you also have them added as a Fave you are now a HookUp.', $from, $to);
                        $message->save();

                        Functions::send_match($from, $to);
                        //Mailer::factory('user')->send_match($from, $to);
                    }
                    elseif ($contact->from->id == $to->id AND $contact->to->id == $from->id AND $contact->contact_type->type == 'Match')
                    {
                        $contact->contact_type_id = ORM::factory('contact_type', array('type' => 'Favorite'));
                        $contact->save();
                    }
                }
            }
            else
            {
                //echo 'no community accounts found to use for this user ' . $user->username;
            }
        }
    }

    function action_online()
    {
        $community = ORM::factory('user')
            ->where('membership_id', 'IN', new Database_Expression('(10, 11, 12)'))
            ->and_where('users.username', 'NOT IN', new Database_Expression("('Dirtylilsecret','Hottie_Cristine','LittleMissFiona','NaughtyJayme','MsGreen','KnoxvilleKisses','SexiLexi','Lustykisses2','JessieSexy','BlondeBadGrrrl','Bootylicious669','AllBoutDatBass','SchoolGrlCrush','SunkissedBlond','sxybooty','AshevilleMade','MissMuggle','LaineyinEC','RedhedCntryGrl','GoodGollyMissHolly','HornyTXHousewife','LilyVanilli','beercitybrunette','pinkiepie69','cutekitty061','Sylviexo','BabySoTiCNG','TabbiKitten','angela31','MissPurrfect','alisabdd','hardbodygrl','goodloving1','Lasia','SweetMelissa','kinkykatie','SoSoSweet69','SavannahLynn','BBGotDSLs4Dayz','CookiePuss','OhMyChai','StrawbryShortcake','sactownbaby','Kayleigh9569','HoosierGirl317','x_LonelyInAz_x','SxyBiGal4Play','HunnyBunz669','sxyjenni212','MollyPop','shybutbad85','staceyk','sexyjenni','hotluving08','havalove', 'mrsbrowntaste', 'daylynn00', 'gail_loves_pvc', 'angelina2', 'chicaloco71', 'GastownGirl', 'SexyHornyMom', 'hotwhornyfor', 'snowbunny4u', 'candihotready', 'XBabyxBreeX', 'hottie4u2eat', 'CrystalVixen', 'quickyqueen', 'angel2123', 'livelongnparty', 'wendythompsone', 'Twixxj', 'HornyEmmy', 'cutiewithboobys', '2hot2beture', 'MissReaganRae', 'badtink', 'spartygirl89', '2cute4u2miss', 'sexysadie', 'stillgotit78', 'BamaBaby205','QTnessa','HottieDeLuXXX13','Emilyxoxanna','bettycocker','heartslove19','nicolehottie','sxyshygrrrl','rachelle','mgdbabe','txtruelove','GoldieLoxxx','DurtyGurl69','hottnbubbly','loveallofit','hellokittygirlie','burien85','chezza444','louday','Amber5434','SweetSabine','KissMeDeadly','Aristar','janisj','bebenathy','LegsThatGoForever','lizdown_onit','snakedgirl003','bissy4','LAGinger','sweetlilanna','justlookin426','lavinia9907','creola479','NikkiFreaksYou','KendraAllKendra','dmysha','sexydana','wethotgirl821','DaniLicious','KennWaKitty','me3334','Alaskanchic','jessysexy','SxyJanice82','missginger','YahYahGumbo','brngnsexibck','luvzh2o','imoist4u','Rough77','surpriseme','Tristan77','hotforit','grneyesnsexy','BigRed1977','hotguyseekingme','juicyjudey','AngelaHotForSex','sweetkywoman','Playingnow1598','715sexy','FreeRini','hornynshaperr','missuzy','rita','SarahRavensFan','Apple101','lucyloo6969','CoventryGal','Josslyn','randygilr','makeitwet908','xxxtina','sexylatin000','sweetsara18','PrincessCherry','Rayna11138','lenox61','KissyFur','Carolyn777','DaytonaLinda','thighhighs','TruJayde','Lia1976','krissylee','SexInLittleRock','dailydose','desirable','JessicaBurr','scblueeyes13','Stace23','Raychel611','sexysinglemammi','JaiMonet','discreetsex270','sexray19','onlreloves','Futureness','wild_cookie73','justalways456','CLL98745','tcbb27','AintGotAClue','KikiDynamite','Honeynnc','marymovesit','playbaby','CR700','frydfairy','ImKasey','wetwild69bi','callyhotslut','belivsexy','SxyJanice82','holly2169','Mitchaser23','mellee1','TattsnTits','fleurduprintemp','tastymaggie','28flower','EmilyFine','diamondeye','KissmeTess','shadowgrl','kinkygirl','southernsweet','TamChick','MzNewBooty','lonelwoman','kiyyana','lovetogvhead','lovabigdick','theblonde','stefoney','hann2k','mariegirl','naughtynurse','Pussygalore09','remolove1','BentOver4UXXX','Freckles','whereareyou','wise','sexUal1_043','hornygirl','Loraxxx87','goldengal006')"))
            ->and_where('users.username', 'NOT IN', new Database_Expression("('SexyJessie','KasandraRed','EvilAshleigh94','shawneebabee','WillyNilly3', 'candyadria', 'diksukr6006', 'SocaRchika', 'ASHTONxxx', 'foreverwithyou', 'honeydipped', 'TaylorMade', 'tinapop', 'HartfordBabe', 'longtimenosex', 'sexxxy', 'Lillybet', 'helenaluv', 'KandyKisses', 'TootsieMelt', 'Mystique', 'jsexy4cum3', 'NewBorn5965', 'hothaze', 'richfun', 'badgirl3000', 'SweetSteph', 'natureisunfair','trustme','EntirelyUnique3','sexiimamii','gadget','more2sex','lachiara','kisstalon','alltaffy','HornyBlondGrl50','snowbunnie','Reden9','sweetlibra','PossibleLesi','ashley','4fun_nscvic','tooplease152','GracieLynnLawless','shellyyellow','boomshell69','AKAHotmama','speaksdot','1bitoplay','kendre515','gracefulhart30','aphroditexxx','ohhlalabb','briwantscock','ineedyouforme','nobodysperfect','mzmoneyflower','Marta615','partigurl7','sparkles737','laineyluvzxxx','MzNevaenuff','cutiegrlnmi4u','dubsd1','deedee81','yogie','aunry1975','imera30q_u','juicybabe22','nitebedrmeye','hardbodygrl','goodloving1','bling655bling','greeneyediamond','nyshugababy','youngnympho','broken4ever','AfterPartyGal45','cherry999','BellaDonna33','truejayde','Justwantfun7','SexxxySally','jenijeni','pixelfaerie','justsex4dawn','sweetjayne','babygirl_401','huntedlady','naughty_hottie7','angieprettybaby','greeneyes','paulajones909','kitkat1980','SP0EPaso','golden','alisabdd','lindsey1250','hothanah','NaughtyJuJu','slaphappyjacki','hotjenni26','Shawmee','liltigress','goldengal066','powerofthepussy','ely712','Tracy_laa','sexxxykj','Missyxoxo','purrrrrXX','dirty22female','arista80','Lila_Sydney','ircords')"))
            ->and_where('users.username', 'NOT IN', new Database_Expression("('KadyBug69','BoricuaBaby','Kiahxxx','AGirl2DoInDenver','BabyInBeaumont','chloebaboe','pussywillow','StickySweet420','SxyBlonde','X_rileycyrus_X','Dax87','SxyNaghtyLilThang','SweetPea93','JerseyGurley','GoodGrlGoneBad','CarrieBear6969','MaryAlice','foxxyroxxy','TastyCakes','slewis68','SWEETMANGO12','DaddysGurl','CarlaHrovatuezjj','singlemercy009','niczevans','acyoyo','lcharlie92','KaylaBabi','gorgeous_blonde','tucsonbrat','sexymamanh','Milkymary','foxxyflirt','ouija','queenoral','snapdragonlily','feverana','FullBody1235','becky','foryou_2002Cum','sexixithang20','daddysbratslut','kinkyme111','sexykatie4u','habanitaXo','alagbo009','sexyfriend099','nottyBear04','GorgeousKiddo','drews22','lilcowgirl','NDSexyChic18','flirtashley','sexdeprived87','JUICEY88','CaSuRfGiRl87','havingfun08','xxfreshflowerzz','rolandsweet','sexysonia30','sweetbuttercups','GingerLee999','sexyshassy','sephora','Briley08','kimberly5666','faith4real19','takesalicking','certifiedfreak','shortnsexy888','sweetsandra88','kinkykitten2004','slutty_ambie','annasquirt','iwantyou2lickme','Pootietang','bam2308','NightyNightBaby','jesfrench1','tight_lover5','kara1991','PartiGurlPaula','partyhottie80','amylee','monicawod','MissJuicy','JamiRoxxx','sexycat23','evelvsnikki','LisaLov988','kyli','Yajaira','angela','thismissto69U','imaslutttt')"))
            ->and_where('users.username', 'NOT IN', new Database_Expression("('Nathalie93','Sera4Anything','bjsandtacos','NaughtyJules','CurvyCutie4u','SnootchieBootchie','Suzzyy','GingerSnaps','YourGoddess','purrrrrXX','speaksdot','imera30q_u','kinkyPLAY','Ox_Missy_xO','zmikejghjgh','ctutelitt','0xCandyCrushx0','Irresistible','turnherbad','SugarNips','sweetiepie','BustyBrunette4Fun','CandyKissesXO','Gemini69','XxxMadisonxxX','TXSpursSpitfire','XSweetCarolineX','Tinkerbelle94','CrzyInAlabama','cutieinmillcity','SweetAria','SugarSweet69','HeatherForever','GemmaWantsIt','cutiepatootiexx','cataleya','xO_Hanna_Ox','goodcatholicgrl','littlekitten','BillingsBaby69','RoseHasThorns','Lick2Taste','BlackBetty88','haveyouseenher','xLafreniereBabyx','sammyjo','charisa','iamsamantha','HabsHoney','LilMissKiKi','JustJessi','Whitney4fwb','lilcutiiesmiles','sexymisty','thebichim','WantItHotNruf6','BoobChick','sexandthecity69','ParkCityPrincess','XxhoneyxX','pussypie','sexyashley1','darlingnikki','OzarkAngel69','BesameMucho','Milk_N_Honey','MzJuicyFruitz','SweetBabyShy','TNBuxomBadGirl','ashlieXskank','SweetLilliana','SugarBabie','NoelaniXoXo','Sapphire','kandyqueen','hazelnot','srchn4peyton','lilmissmonster','SpanishPosh','pair_o_dice','SxyBBW4Luv','GettinMyFreakOn','KellyLittleFox','WetHotNReady87','Bellissima718','DFWSundancer')"))
            ->and_where('users.username', 'NOT IN', new Database_Expression("('MemphisBelle')"))
            ->order_by(new Database_Expression('RAND()'))->limit(2)->find_all();

        foreach($community as $user)
        {
            //echo $user->username . '-' . rand(5, 20) . '<br />';
            $user->online->update($user, rand(5, 20) . ' minutes');
        }
    }

    function action_parse_camgirls()
    {
        set_time_limit(0);

        $range = ORM::factory('affiliate_payout')->where(new Database_Expression(strtotime('est today -1 second')), 'BETWEEN', new Database_Expression('start AND end'))->find();

        $managers = ORM::factory('camgirl')->where('account', '=', 'manager')->find_all();

        foreach($managers as $manager)
        {
            //print_r($manager);
        }

        if ($range->end != strtotime('est today -1 second'))
        {
            echo 'Pay Period Still Running (' . date('Y-m-d', $range->start) . ' - ' . date('Y-m-d', $range->end) . ')' . "\n";
            exit();
        }

        echo 'Pay Period Ended (' . date('Y-m-d', $range->start) . ' - ' . date('Y-m-d', $range->end) . ')' . "\n";

        $sql = "SELECT DISTINCT user_id
                FROM `chat_tracker`
                WHERE date BETWEEN " . $range->start . " AND " . $range->end . " AND user_id IN (SELECT swurve_id FROM camgirls)";

        $camgirls = DB::query(Database::SELECT, $sql)->as_object('Model_Chat_Tracker')->execute();

        foreach($camgirls as $camgirl)
        {
            $sql = "SELECT `user_id`, `tier`, `type`, SUM(credits) AS 'credits'
                    FROM `chat_tracker`
                    WHERE `user_id` = " . $camgirl->user_id . " AND `date` BETWEEN " . $range->start . " AND " . $range->end . "
                    GROUP BY `user_id`, `tier`, `type`";

            $stats = DB::query(Database::SELECT, $sql)->as_object('Model_Chat_Tracker')->execute();

            $earned_comission = 0;

            foreach($stats as $stat)
            {
                $stat->tier = $stat->tier ? $stat->tier : $camgirl->tier;

                $earned_comission += number_format($stat->credits / ($stat->type == 'Text' ? 1 : 3) * $GLOBALS['tiers'][$stat->tier][$stat->type], 2, '.', '');
            }

            $girl = ORM::factory('camgirl', array('swurve_id' => $camgirl));

            echo 'Camgirl #' . $girl . ' earned $' . number_format($earned_comission, 2) . ' this pay period.' . "\n";

            $girl->pending_commission = number_format($earned_comission + $girl->pending_commission, 2, '.', '');

            echo 'Camgirl #' . $girl . ' has a total earned income of $' . number_format($girl->pending_commission, 2) . '' . "\n\n";

            if (empty($girl->active_date)) $girl->active_date = $range->start;

            //if (time() <= strtotime('+3 months', $girl->signup_date)) $tier = 1;
            if (time() > strtotime('+3 months', $girl->active_date) AND time() <= strtotime('+6 months', $girl->active_date)) $girl->tier = 2;
            if (time() > strtotime('+6 months', $girl->active_date) AND empty($girl->referral_id))
            {
                $girl->tier = 3;
            }
            else
            {
                $girl->tier = 2;
            }

            $girl->save();
        }
    }

    function action_parse_affiliates()
    {
        // -8
        // -23
        // -38
        // -54

        $range = ORM::factory('affiliate_payout')->where(new Database_Expression(strtotime('est today -1 second')), 'BETWEEN', new Database_Expression('start AND end'))->find();

        if ($range->end != strtotime('est today -1 second'))
        {
            echo 'Pay Period Still Running (' . date('Y-m-d', $range->start) . ' - ' . date('Y-m-d', $range->end) . ')' . "\n";
            exit();
        }

        echo 'Pay Period Ended (' . date('Y-m-d', $range->start) . ' - ' . date('Y-m-d', $range->end) . ')' . "\n";

        $sql = "SELECT `affiliates`.*
                FROM `affiliates`
                LEFT JOIN `affiliate_stats` ON `affiliate_stats`.`affiliate_id` = `affiliates`.`id`
                LEFT JOIN `stat_types` ON `affiliate_stats`.`stat_type_id` = `stat_types`.`id`
                WHERE
                    (
                        (
                            `stat_types`.`type` = 'Rebillings' OR
                            `stat_types`.`type` = 'Memberships'
                        ) AND
                        `affiliate_stats`.`date` BETWEEN " . $range->start . " AND " . $range->end . "
                    ) OR (
                        `affiliates`.id IN (
                            SELECT `affiliates`.`referral_id`
                            FROM `affiliates`
                            JOIN `affiliate_stats` ON `affiliate_stats`.`affiliate_id` = `affiliates`.`id`
                            JOIN `stat_types` ON `affiliate_stats`.`stat_type_id` = `stat_types`.`id`
                            WHERE
                                (
                                    `stat_types`.`type` = 'Rebillings' OR
                                    `stat_types`.`type` = 'Memberships'
                                ) AND
                                `affiliate_stats`.`date` BETWEEN " . $range->start . " AND " . $range->end . " AND
                                `affiliates`.`referral_id` IS NOT NULL
                            GROUP BY `affiliates`.`id` ORDER BY `affiliates`.`id` ASC
                        )
                    )
                GROUP BY `affiliates`.`id`
                ORDER BY `affiliates`.`id` ASC";

        $affiliates = DB::query(Database::SELECT, $sql)->as_object('Model_Affiliate')->execute();

        /*$affiliates = ORM::factory('affiliate')
            ->join('affiliate_stats')->on('affiliate_stats.affiliate_id', '=', 'affiliates.id')
            ->join('stat_types')->on('affiliate_stats.stat_type_id', '=', 'stat_types.id')
            ->where_open()->where('stat_types.type', '=', 'Rebillings')->or_where('stat_types.type', '=', 'Memberships')->where_close()
            ->where('affiliate_stats.date', 'BETWEEN', new Database_Expression($range->start . ' AND ' . $range->end))
            ->group_by('affiliates.id')
            ->find_all();*/

        foreach($affiliates as $affiliate)
        {
            $commission = 0.00;
            $earned_commission = 0.00;

            $data = $affiliate->affiliate_stats->get_stats_daterange(null, $range);

            if ($affiliate->program == 'PPS')
            {
                $earned_commission += Functions::calc_pps_commission($data['Memberships'], FALSE);
            }
            elseif ($affiliate->program == 'Revshare')
            {
                $earned_commission += Functions::calc_revshare_commission($data['Memberships'], $data['RebillingAmount'], $data['MembershipAmount'], FALSE);
            }
            elseif (strpos($affiliate->program, 'PPS') !== FALSE )
            {
                $earned_commission += Functions::calc_pps_flatrate_commission($data['Memberships'], $affiliate->program, FALSE);
            }
            elseif (strpos($affiliate->program, 'Revshare') !== FALSE )
            {
                $earned_commission += Functions::calc_revshare_flatrate_commission($data['Memberships'], $data['RebillingAmount'], $data['MembershipAmount'], $affiliate->program, FALSE);
            }

            echo 'Affiliate #' . $affiliate . ' earned $' . number_format($earned_commission, 2) . ' this pay period.' . "\n";

            $commission += number_format($earned_commission, 2, '.', '');

            $brokers = ORM::factory('affiliate')->where('referral_id', '=', $affiliate)->find_all();

            echo 'Affiliate #' . $affiliate . ' has ' . count($brokers) . ' broker(s).' . "\n";

            foreach($brokers as $broker)
            {
                $broker_commission = 0.00;

                $data2 = $broker->affiliate_stats->get_stats_daterange(null, $range);

                if ($broker->program == 'PPS')
                {
                    $broker_commission += Functions::calc_pps_commission($data2['Memberships'], FALSE);
                }
                elseif ($broker->program == 'Revshare')
                {
                    $broker_commission += Functions::calc_revshare_commission($data2['Memberships'], $data2['RebillingAmount'], $data2['MembershipAmount'], FALSE);
                }
                elseif (strpos($broker->program, 'PPS') !== FALSE )
                {
                    $broker_commission += Functions::calc_pps_flatrate_commission($data2['Memberships'], $broker->program, FALSE);
                }
                elseif (strpos($broker->program, 'Revshare') !== FALSE )
                {
                    $broker_commission += Functions::calc_revshare_flatrate_commission($data2['Memberships'], $data2['RebillingAmount'], $data2['MembershipAmount'], $broker->program, FALSE);
                }

                echo 'Broker Affiliate #' . $broker . ' earned $' . number_format($broker_commission, 2) . ' this pay period (10% = ' . number_format($broker_commission * .10, 2) . ').' . "\n";

                $commission += number_format($broker_commission * .10, 2, '.', '');
            }

            echo 'Affiliate #' . $affiliate . ' earned a total of $' . number_format($commission, 2) . ' this pay period.' . "\n";

            $commission += $affiliate->pending_commission;

            echo 'Affiliate #' . $affiliate . ' has a total earned income of $' . number_format($commission, 2) . '' . "\n\n";

            $affiliate->pending_commission = number_format($commission, 2, '.', '');
            $affiliate->save();
        }
    }

    public function action_test(){
			for($i = 1; $i <= 12; $i++)
			{
				$from = strtotime('2021-' . $i . '-01 est today') . '<br />';
				$to = strtotime('2021-' . $i . '-16 est today -1 second') . '<br />';

				$payout = ORM::factory('affiliate_payout');

				$payout->start = $from;
				$payout->end = $to;

				$payout->save();

				$from = strtotime('2021-' . $i . '-16 est today') . '<br />';
				$to = strtotime('2021-' . $i . '-1 est +1 month today -1 second') . '<br />';

				$payout = ORM::factory('affiliate_payout');

				$payout->start = $from;
				$payout->end = $to;

				$payout->save();
				echo 'added 2021-';
			}
    }

    public function action_parse_dri($period)
    {
        if ($period == 1)
        {
            $before = date('Y-m-d H:i:s', strtotime('est today -12 hours'));
            $after = date('Y-m-d H:i:s', strtotime('est today'));
        }
        else
        {
            $before = date('Y-m-d H:i:s', strtotime('est today'));
            $after = date('Y-m-d H:i:s', strtotime('est today +12 hours'));
        }

        $return = Merchant::factory('netbilling')->prase_dri($before, $after);

        echo "\n" . $return . "\n\n";

/*        $return = '"TRANS_ID","TRANS_STATUS_MSG","TRANS_STATUS_CODE","SITE_TAG","ORIGIN","ISSUE_DATE","CAPTURE_DATE","MEMBER_ID","AMOUNT","CURRENCY","AUTH_MSG","CARD_TYPE","CARD_NUMBER","CARD_EXPIRE","DESCRIPTION","BILL_NAME1","BILL_NAME2","BILL_STREET","BILL_CITY","BILL_STATE","BILL_ZIP","BILL_COUNTRY","SHIP_NAME1","SHIP_NAME2","SHIP_STREET","SHIP_CITY","SHIP_STATE","SHIP_ZIP","SHIP_COUNTRY","CUSTOMER_IP","CUSTOMER_HOST","CUSTOMER_EMAIL","CUSTOMER_PHONE","MISC_INFO","USER_DATA","MASTER_ID","PROCESSOR","PROCESSOR_REC_ID","AFFILIATE_TAG"
"111103648382","SALE/FAILED","0","SWURVE","V-TERM","2010-04-28 00:04:01","","110849107816","24.95","USD","DECLINED","MC","511165xxxxxx2950","0911","Membership Plan 3 - Silver Membership $24.95 - Free Credits: 50 ","Heath","Weber","365 West 35th Street","Ashtabula Ohio","OH","44004","US","","","","","","","","","","hrweber1984@yahoo.com","","","","","FDR-NASH","MPGUZESUF      0427A 81",""
"111116493354","SALE/OPEN","1","SWURVE","ND3.SIGNUP","2010-04-28 00:06:20","","111116493355","32.95","USD","TEST APPROVED","VISA","468125xxxxxx3257","0416","Membership Plan 4 - Gold Membership $32.95 - Free Credits: 100","Michelle","Testing","1800 union st ","Clearwater","FL","33763","US","","","","","","","","173.169.111.62","","steveneven7@hotmail.com","","","","","TEST","",""
"110785013652","SALE/FAILED","0","SWURVE","RECURRING","2010-04-28 15:54:16","","110822384373","24.95","USD","DECLINED","MC","518919xxxxxx0295","0214","Membership Plan 3 - Silver Membership $24.95 - Free Credits: 50","Vince","King","700 Dardanelles dr ","Lexington","KY","40503","US","","","","","","","","","","vincevinnik@aol.com","","","","110822384372","FDR-NASH","MPGID5BUD      0428A 81",""
"111032165248","SALE/OK","1","SWURVE","RECURRING","2010-04-28 16:40:53","","111079204577","24.95","USD","APPROVED 137111","VISA","435544xxxxxx1724","0112","Membership Plan 3 - Silver Membership $24.95 - Free Credits: 50","Michelle","Pendenza","4746 Meadowsweet Ct ","New Port Richey","FL","34653","US","","","","","","","","","","jj4swurve@yahoo.com","","","","111079204576","FDR-NASH","08011860052474995C5WB01",""';
*/
        $arr_data = explode("\n", trim($return));

        $keys = array_shift($arr_data);
        $arr_keys = explode(',', $keys);
        array_walk($arr_keys, create_function('&$value, $key', '$value = str_replace(\'"\', \'\', $value);'));

        foreach($arr_data as $data)
        {
            $arr_values = explode(',', $data);
            array_walk($arr_values, create_function('&$value, $key', '$value = str_replace(\'"\', \'\', $value);'));

            $transaction = array_combine($arr_keys, $arr_values);

            if ($transaction['TRANS_STATUS_CODE'] == '1' AND $transaction['ORIGIN'] == 'RECURRING')
            {
                $user = ORM::factory('user', array('member_id' => $transaction['MEMBER_ID']));

                if ($user->loaded() AND ! empty($user->affiliate) AND $user->affiliate_program == 'Revshare')
                {
                    $affiliate = ORM::factory('affiliate', array('id' => $user->affiliate));

                    if ($affiliate->loaded())
                    {
                        echo $affiliate->id . ' (' . $user->sub_id . '): ' . $transaction['AMOUNT'] . "\n";
                        Stats::add_rebilling($affiliate->id, $user->sub_id, $transaction['AMOUNT']);
                    }
                }
            }
        }
    }
}
