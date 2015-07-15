<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_JSON extends Controller_Master
{ 
    function before()
    {
        $this->secure = NULL;

        parent::before();

        $this->auto_render = FALSE;
    }

    function action_unreademails()
    {
        if (Core::$user)
        {
            $results['count'] = Core::$user->messages->where('date_read', 'IS', NULL)->where('deleted', '=', 'No')->where('flag', '=', 'No')->count_all();
        }
        else
        {
            $results['count'] = 0;
        }
        
        echo json_encode($results);
        exit();
    }

    function action_creditbalance()
    {
        if (Core::$user)
        {
            $results['count'] = (Core::$user AND ! empty(Core::$user->flirtbucks_id)) ? 'Unlimited' : Core::$user->credits;
        }
        else
        {
            $results['count'] = 0;
        }

        echo json_encode($results);
        exit();
    }

    function action_block()
    {
        $post = $_POST;

        if (isset($post['username']))
        {
            $user = ORM::factory('user', array('username' => $post['username']));

            if ( ! $user->loaded())
            {
                Notify::set('fail', 'No user found with the name "' . $post['username'] . '"');
                echo 'refresh';
                return;
            }

            if ($user->membership->type == 'Admin')
            {
                Notify::set('fail', 'Admin accounts can not be added to block list.');
                echo 'refresh';
                return;
            }

            if (ORM::factory('block')->where('user_id', '=', Core::$user)->where('block_id', '=', $user)->find()->loaded())
            {
                Notify::set('info', $user->username . ' is already on your block list.');
                echo 'refresh';
                return;
            }

            $block = ORM::factory('block');

            $block->user_id = Core::$user;
            $block->block_id = $user;

            $block->save();

            Notify::set('pass', $user->username . ' has been added to your block list.');
        }

        echo 'refresh';
    }

    function action_unblock()
    {
        $post = $_POST;

        foreach($post['blocked'] as $bid)
        {
            $block = ORM::factory('block', $bid);

            if ( ! $block->loaded() OR $block->user_id != Core::$user->id) continue;

            $block->delete();
        }

        Notify::set('pass', 'Selected users have been unblocked.');

        echo 'refresh';
    }

    function action_delete()
    {
        $post = $_POST;

        switch($post['action'])
        {
            case 'selected':
                foreach($post['delete'] as $mid)
                {
                    $message = ORM::factory('message', $mid);

                    if (!$message->loaded() OR ($message->to->id != Core::$user->id AND $message->from->id != Core::$user->id)) continue;

                    $message->deleted = 'Yes';
                    $message->date_deleted = time();
                    $message->save();
                }

                echo 'refresh';

                break;

            case 'all':
                if (empty($post['filter']))
                {
                    $messages = Core::$user->messages->where('deleted', '=', 'No')->find_all();
                }
                else
                {
                    if ($post['filter'] == 'read')
                    {
                        $messages = Core::$user->messages->where('deleted', '=', 'No')->where('date_read', 'IS NOT', null)->find_all();
                    }
                    else
                    {
                        $messages = Core::$user->messages->where('deleted', '=', 'No')->where('date_read', 'IS', null)->find_all();
                    }
                }

                foreach($messages as $message)
                {
                    $message->deleted = 'Yes';
                    $message->date_deleted = time();
                    $message->save();
                }

                echo 'refresh';

                break;
        }
    }

    function action_chats()
    {
        echo View::factory('module/chat_manage')->render();
    }

    function action_blast()
    {
        $count = file_get_contents('./blast.txt', true);
        //SELECT * FROM `users` WHERE mailstatus = 0 AND country_id IN (233,41,80,18) AND membership_id IN (2,3,4,5,6,7,8,9,13,14,15)
        //$users = ORM::factory('user')->where('id', '<', '10511')->where('membership_id', '=', '1')->where('country_id', 'IN', new Database_Expression('(41,80,233)'))->where('mailstatus', '=', '0')->limit(100)->offset($count)->order_by('id', 'DESC')->find_all();
        //$users = ORM::factory('user')->where('username', '=', 'omicron')->find_all();
        $users = ORM::factory('user')->where('membership_id', 'IN', new Database_Expression('(2,3,4,5,6,7,8,9,13,14,15)'))->where('country_id', 'IN', new Database_Expression('(233,41,80,18)'))->where('mailstatus', '=', '0')->limit(1030)->offset($count)->order_by('id', 'ASC')->find_all();

        foreach($users as $user)
        {
            /*
            $message = ORM::factory('message');

            $message->to_id = $user;
            $message->from_id = ORM::factory('user', array('username' => 'Admin'));
            $message->message_type_id = ORM::factory('message_type', array('type' => 'Mail'));
            $message->subject = 'Now Offering Live Chat!';
            $message->message = "
                <p>" . $user->username . ",</p>
                <p>We are proud to announce we have upgraded to our communication platform to now include live chat functionality. Now you can instantly connect with other users on Swurve, one on one, at the click of a mouse.</p>
                <p>Our new chat interface features both text as well as live streaming video. With our new features you can not only type but also see one another in real time if you choose to connect.</p>
                <p>Active users available for chat will display a flashing or highlighted chat icon near their user name or on their profile. As users that may be logged in and shown as online may not be actively using the site, only users who are presently engaging and interacting with the community will display an active chat icon.</p>
                <p>Have a webcam? Want to go cam 2 cam? Let other users know now by accessing the " . HTML::anchor('edit/profile', 'Edit Profile') . " page and turning on your webcam icon. The webcam icon lets other users know that you have a cam connected and are interested in streaming live video with other users.</p>
                <p>Our state of the art one on one video chat brings a new level of intimacy never before available in the casual personals space. We hope you will enjoy this new premium feature and look forward to hearing your feedback.</p>
                <p>Much Love,</p>
                <p>Your Website Admin & the Swurve Support Team</p>
            ";

            $message->save();
            */
            Mailer::factory('user')->send_webcam($user);
            echo '.';
            //echo $user->username . ' - ' . $newpass . '<br />';
        }

        file_put_contents('./blast.txt', $count + 1030);
        echo 'done';
    }

    function action_rate($params)
    {
        list($user_id, $rating) = split('/', $params);;

        $ratings = ORM::factory('rating')->where('from_id', '=', Core::$user)->where('user_id', '=', $user_id)->find();

        if ($rating == 0 AND $ratings->loaded())
        {
            $ratings->delete();
        }
        else
        {
            if ( ! $ratings->loaded())
            {
                $ratings->from_id = Core::$user;
                $ratings->user_id = $user_id;
            }

            $ratings->rating = $rating;
            $ratings->save();
        }

        $sql = "SELECT COUNT(id) AS votes, AVG(rating) as rating FROM ratings WHERE user_id = " . $user_id;

        $stats = DB::query(Database::SELECT, $sql)->execute()->as_array();
        $stats = $stats[0];

        $user = ORM::factory('user', $user_id);

        if ($user->loaded())
        {
            $user->rating = ( ! empty($stats['rating'])) ? $stats['rating'] : 0;
            $user->votes = ( ! empty($stats['votes'])) ? $stats['votes'] : 0;
            $user->save();
        }

        echo json_encode(array('result' => $stats));
    }

    function action_countries()
    {
        $sql = "SELECT CONCAT('<OPTION value=', id, '>', name, '</OPTION>') AS html
                FROM countries
                ORDER BY CASE name WHEN 'United States' THEN 0 WHEN 'Canada' THEN 1 WHEN 'United Kingdom' THEN 2 WHEN 'Australia' THEN 3 ELSE 4 END ASC, name ASC";

        $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array();

        echo json_encode(array('result' => Functions::array_implode('', 'html', $data)));
    }

    function action_regions($country)
    {

        $sql = "SELECT CONCAT('<OPTION value=', r.id, '>', r.name, '</OPTION>') AS html
                FROM regions r, countries c
                WHERE r.country_code = c.code AND c.id = '" . $country . "'
                ORDER BY r.name ASC";

        $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array();

        echo json_encode(array('result' => Functions::array_implode('', 'html', $data)));
    }

    /*function action_cities($params)
    {
        list($country, $region) = split('/', $params);

        if ($region == '00')
        {
            $sql = "SELECT CONCAT('<OPTION value=', ci.id, '>', ci.full_name, '</OPTION>') AS html
                    FROM cities ci, regions r, countries c
                    WHERE ci.region_code = r.code AND ci.country_code = c.code AND c.id = '" . $country . "' AND r.code = '" . $region . "'
                    ORDER BY ci.name ASC";
        }
        else
        {
            $sql = "SELECT CONCAT('<OPTION value=', ci.id, '>', ci.full_name, '</OPTION>') AS html
                    FROM cities ci, regions r, countries c
                    WHERE ci.region_code = r.code AND ci.country_code = c.code AND c.id = '" . $country . "' AND r.id = '" . $region . "'
                    ORDER BY ci.name ASC";
        }

        $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array();

        echo json_encode(array('result' => Functions::array_implode('', 'html', $data)));
    }*/
    function action_count($params)
    {
        list($country, $region) = split('/', $params);

        if ($region == '00')
        {
            $sql = "SELECT COUNT(ci.id) AS count
                    FROM cities ci, regions r, countries c
                    WHERE ci.region_code = r.code AND ci.country_code = c.code AND c.id = '" . $country . "' AND r.code = '" . $region . "'
                    ORDER BY ci.name ASC";
        }
        else
        {
            $sql = "SELECT COUNT(ci.id) AS count
                    FROM cities ci, regions r, countries c
                    WHERE ci.region_code = r.code AND ci.country_code = c.code AND c.id = '" . $country . "' AND r.id = '" . $region . "'
                    ORDER BY ci.name ASC";
        }

        $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array();

        echo json_encode(array('result' => $data));
    }

    function action_getname($city)
    {
        $sql = "SELECT full_name AS name
                FROM cities
                WHERE id = '" . $city . "'";

        $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array();

        echo json_encode(array('result' => $data));
    }

    function action_cities($params)
    {
        //ini_set("memory_limit","80M");
        list($country, $region) = split('/', $params);

        if ($region == '00')
        {
            $sql = "SELECT ci.id, ci.name, ci.full_name
                    FROM cities ci, regions r, countries c
                    WHERE ci.region_code = r.code AND ci.country_code = c.code AND c.id = '" . $country . "' AND r.code = '" . $region . "'
                    ORDER BY ci.name ASC";
        }
        else
        {
            $sql = "SELECT ci.id, ci.name, ci.full_name
                    FROM cities ci, regions r, countries c
                    WHERE ci.region_code = r.code AND ci.country_code = c.code AND c.id = '" . $country . "' AND r.id = '" . $region . "'
                    ORDER BY ci.name ASC";
        }

        $cities = DB::query(Database::SELECT, $sql)->as_object('Model_City')->execute();

        $q = strtolower($_GET["term"]);

        $result = array();
        foreach ($cities as $city) {
            if (strpos(strtolower($city->name), $q) === 0) {
                array_push($result, array("id"=>$city->id, "label"=> $city->full_name, "value" => strip_tags($city->name)));
            }
            if (count($result) > 11)
                break;
        }

        echo $this->array_to_json($result);
    }

    function array_to_json( $array ){

        if( !is_array( $array ) ){
            return false;
        }

        $associative = count( array_diff( array_keys($array), array_keys( array_keys( $array )) ));
        if( $associative ){

            $construct = array();
            foreach( $array as $key => $value ){

                // We first copy each key/value pair into a staging array,
                // formatting each key and value properly as we go.

                // Format the key:
                if( is_numeric($key) ){
                    $key = "key_$key";
                }
                $key = "\"".$key."\"";

                // Format the value:
                if( is_array( $value )){
                    $value = $this->array_to_json( $value );
                } else if( !is_numeric( $value ) || is_string( $value ) ){
                    $value = "\"".$value."\"";
                }

                // Add to staging array:
                $construct[] = "$key: $value";
            }

            // Then we collapse the staging array into the JSON form:
            $result = "{ " . implode( ", ", $construct ) . " }";

        } else { // If the array is a vector (not associative):

            $construct = array();
            foreach( $array as $value ){

                // Format the value:
                if( is_array( $value )){
                    $value = $this->array_to_json( $value );
                } else if( !is_numeric( $value ) || is_string( $value ) ){
                    $value = "'".$value."'";
                }

                // Add to staging array:
                $construct[] = $value;
            }

            // Then we collapse the staging array into the JSON form:
            $result = "[ " . implode( ", ", $construct ) . " ]";
        }

        return $result;
    }

    /*
    function action_countries()
    {
        $sql = "SELECT code, name
                FROM countries
                ORDER BY CASE name WHEN 'United States' THEN 0 WHEN 'Canada' THEN 1 WHEN 'United Kingdom' THEN 2 WHEN 'Australia' THEN 3 ELSE 4 END ASC, name ASC";

        $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('code', 'name');

        echo json_encode(array('result' => $data));
    }

    function action_regions($country)
    {
        $sql = "SELECT code, name
                FROM regions
                WHERE country_code = '" . $country . "'
                ORDER BY name ASC";

        $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('code', 'name');

        echo json_encode(array('result' => $data));
    }

    function action_cities($params)
    {
        list($country, $region) = split('/', $params);

        $sql = "SELECT id, full_name
                FROM cities
                WHERE country_code = '" . $country . "' AND region_code = '" . $region . "'
                ORDER BY name ASC";

        $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'full_name');

        echo json_encode(array('result' => $data));
    }
    */
    function action_watermark()
    {
        echo str_repeat(" ", 256);

        set_time_limit(0);

        $path = realpath('assets/photos');

        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
        $watermark = Image::factory('assets/img/watermark.png');
        echo date("F j, Y, g:i:s a") . '<br /><br />';
        $count = 0;

        foreach($objects as $name => $object){
            if ((substr($name, -6) != '_a.png' AND substr($name, -6) != '_f.png' AND substr($name, -6) != '_l.png' AND substr($name, -6) != '_m.png' AND substr($name, -6) != '_s.png') OR substr($name, -6) == '_f.png')
            {
                $image = Image::factory($name);
                $image->watermark($watermark, $image->width - $watermark->width, TRUE);
                $image->save();

                echo ".";
                $count += 1;
                $this->flush_now();
            }

            if ($count % 1000 == 0) echo ' ' . date("F j, Y, g:i:s a") . '<br />';
        }
        echo '<br />' . date("F j, Y, g:i:s a") . '<br />';
    }
    function flush_now() {

  @apache_setenv('no-gzip', 1);
  @ini_set('output_buffering', 0);
  @ini_set('zlib.output_compression', 0);
  @ini_set('implicit_flush', 1);
  for ($i = 0; $i < ob_get_level(); $i++) { ob_end_flush(); }
  ob_implicit_flush(1);
  return true;

}
    function action_api()
    {
        $wsdl_location = 'http://mk2.netatlantic.com:82/?wsdl';
        $username = 'michelle@swurve.com';
        $password = 'j4dkuj5c';

        try
        {
            $client = new SoapClient($wsdl_location, array('login'          => $username,
                                                           'password'       => $password,
                                                           'soap_version'   => SOAP_1_2));
        } catch(SoapFault $fault) {
            echo 'Error connecting: ' . $e->faultstring;
        }

        try {
            //$segmentID = $client->SelectSegments(array("SegmentName = administrators", "ListName = swurve"));
            //$segmentID = $segmentID['SegmentID'];
            // The code above works to select an existing segment, also note below I've tried different syntax's of passing the arguments but they all result in the same error
            $segmentID = $client->CreateSegment(array("SegmentName = test Segment", "ListName = swurve", 'Description = api created segment'));
            echo 'Segment created: ' . $segmentID . '<br>';
        } catch (SoapFault $e) {
            echo 'Error creating segment: ' . $e->faultstring;
            exit();
        }

        $Mailing['ListName'] = 'swurve';
        $Mailing['From'] = 'support@swurve.com';
        $Mailing['HtmlMessage'] = '<strong>this is a test of html</strong>';
        $Mailing['TextMessage'] = 'this is a test of text';
        $Mailing['Subject'] = 'test email';

        try {
            $inMailID = $client->SendMailing($segmentID, $Mailing);
            echo 'Message sent: ' . $inMailID . '<br>';
        } catch (SoapFault $e) {
            echo 'Error creating mailing: ' . $e->faultstring;
            exit();
        }


                /*
        try {
            $client->CreateSingleMember('jeff@reanimated.net', 'OmicroN', 'swurve');
        } catch (SoapFault $e) {
            print ("Oops!  We got an error: ".$e->faultstring );
        }
        */

        //$Segment['ListName'] = 'swurve';
        //$Segment['SegmentName'] = 'Email to member';
        //$Segment['Description'] = 'Email to member 3586813';
        //$Segment['ClauseWhere'] = 'MemberID_ = 3586813';

        //$Segment['SegmentName'] = 'administrators';
        //$Segment['ListName'] = 'swurve';
        //$segmentID = $client->SelectSegments(array("SegmentName = administrators", "ListName = swurve"));



        //$lmapi = $client->getProxy();

        //set basic authentication
        //$lmapi->setCredentials($userName,$password, 'basic');
        //$this->lmapi->ApiVersion();

        echo "<h3> Current version of API at " . $wsdl_location . " is: " . $client->ApiVersion() . "</h3>\n";
    }
}