<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Export extends Controller
{
    function action_index()
    {
        echo '<b>Started: ' . date("F j, Y, g:i a") . '</b><br><br>';
/*
        $country = ORM::factory('country')->where('name', '=', ORM::factory('geo_country')->where('country_id', '=', '1')->find()->country_title)->find();
        
        $region = ORM::factory('region')->where('country_code', '=', $country->code)->where('name', '=', ORM::factory('geo_state')->where('state_id', '=', '14')->find()->state_title)->find();
        
        $city = ORM::factory('city')->where('country_code', '=', $country->code)->where('region_code', '=', $region->code)->where('name', '=', ORM::factory('geo_city')->where('city_id', '=', '4867')->find()->city_title)->find();
        
        print_r($country);
        echo '<br><br>';
        print_r($region);
        echo '<br><br>';
        print_r($city);
        
        exit();
*/
        $users = ORM::factory('member')->find_all();
        
        foreach($users as $user)
        {
            echo '<b>Parsing ' . $user->name . '</b>';
            $new_user = ORM::factory('user', array('username' => $user->name));
            
            if ( ! $new_user->loaded())
            {
                echo '<br>';
                continue;
                $new_user = ORM::factory('user');
            }

            $new_user->headline = ( ! empty($user->headline)) ? $user->headline : NULL;
            $new_user->description = ( ! empty($user->essay)) ? $user->essay : NULL;

            if (empty($new_user->country_id))
            {
                $new_user->country_id = 233;
            }

            if (empty($new_user->region_id))
            {
                $new_user->region_id = @DB::query(Database::SELECT, "SELECT id FROM regions WHERE country_code = '" . $new_user->country->code . "' ORDER BY RAND() LIMIT 1")->as_object('Model_Region')->execute()->current()->id;
            }

            if (empty($new_user->city_id))
            {
                //try {
                    $new_user->city_id = @DB::query(Database::SELECT, "SELECT id FROM cities WHERE country_code = '" . $new_user->country->code . "' AND region_code = '" . $new_user->region->code . "' ORDER BY RAND() LIMIT 1")->as_object('Model_City')->execute()->current()->id;
                //} catch(Database_Exception $e) {}
            }

            $new_user->save();

            echo '<br>';
            continue;

            $new_user->username = $user->name;
            $new_user->password = 'm0n3y';
            $new_user->email = $user->mail;
            $new_user->membership_id = 1;
            
            $country = ORM::factory('country')->where('name', '=', ORM::factory('geo_country')->where('country_id', '=', $user->country_id)->find()->country_title)->find();
            $region = ORM::factory('region')->where('country_code', '=', $country->code)->where('name', '=', ORM::factory('geo_state')->where('state_id', '=', $user->state_id)->find()->state_title)->find();
            $city = ORM::factory('city')->where('country_code', '=', $country->code)->where('region_code', '=', $region->code)->where('name', '=', ORM::factory('geo_city')->where('city_id', '=', $user->city_id)->find()->city_title)->find();

            $new_user->country_id = ($country->loaded()) ? $country->id : NULL;
            $new_user->region_id = ($region->loaded()) ? $region->id : NULL;
            $new_user->city_id = ($city->loaded()) ? $city->id : NULL;
            
            $new_user->birthdate = strtotime($user->birth);
            
            $skip = FALSE;
            
            switch($user->orientation)
            {
                case 1:
                    $new_user->gender = 'Male';
                    $new_user->interested_in = 'Female';
                    $new_user->orientation = 'Straight';
                    break;

                case 2:
                    $new_user->gender = 'Female';
                    $new_user->interested_in = 'Male';
                    $new_user->orientation = 'Straight';
                    break;

                case 3:
                    $new_user->gender = 'Male';
                    $new_user->interested_in = 'Male';
                    $new_user->orientation = 'Gay';
                    break;

                case 4:
                    $new_user->gender = 'Female';
                    $new_user->interested_in = 'Female';
                    $new_user->orientation = 'Gay';
                    break;

                case 5:
                    $skip = TRUE;
                    break;

                case 6:
                    $skip = TRUE;
                    break;

                case 7:
                    $skip = TRUE;
                    break;

                case 8:
                    $new_user->gender = 'Male';
                    $new_user->interested_in = 'Both';
                    $new_user->orientation = (rand(1, 2) == 1) ? 'Bisexual' : 'Bi-Curious';
                    break;

                case 9:
                    $new_user->gender = 'Female';
                    $new_user->interested_in = 'Both';
                    $new_user->orientation = (rand(1, 2) == 1) ? 'Bisexual' : 'Bi-Curious';
                    break;
                    
                default:
                    $skip = TRUE;
                    break;
            }
            
            if ($skip)
            {
                echo ' - couple account.. skipping<br>';
                continue;
            }
            
            switch($user->sexual_orientation)
            {
                case 1:
                    $new_user->orientation = 'Straight';
                    break;

                case 2:
                    $new_user->orientation = 'Bisexual';
                    break;

                case 3:
                    $new_user->orientation = 'Bi-Curious';
                    break;

                case 4:
                    $new_user->orientation = 'Gay';
                    break;
            }
            
            if ($user->height > 0)
            {
                $new_user->height = 47 + $user->height;
            }
            else
            {
                if ($new_user->gender == 'Male')
                {
                    $new_user->height = rand(64,76);
                }
                else
                {
                    $new_user->height = rand(64,71);
                }
            }
            
            switch($user->body) //ENUM('Slim', 'Athletic', 'Muscular', 'Average', 'A little Extra', 'Full Figured', 'Curvy')
            {
                case 1:
                    $new_user->body_type = 'Slim';
                    break;

                case 2:
                    $new_user->body_type = 'Average';
                    break;

                case 3:
                    $new_user->body_type = 'Athletic';
                    break;

                case 4:
                    $new_user->body_type = 'A little Extra';
                    break;

                case 5:
                    $new_user->body_type = 'Full Figured';
                    break;

                case 6:
                    $new_user->body_type = 'Slim';
                    break;

                case 7:
                    $new_user->body_type = 'Full Figured';
                    break;

                case 8:
                    $new_user->body_type = 'Average';
                    break;

                default:
                    $new_user->body_type = 'Average';
                    break;
            }
            
            switch(rand(1,9)) //ENUM('Auburn', 'Black', 'Blonde', 'Brown', 'Red', 'Gray', 'White', 'Bald', 'Other')
            {
                case 1:
                    $new_user->hair_color = 'Auburn';
                    break;

                case 2:
                    $new_user->hair_color = 'Black';
                    break;

                case 3:
                    $new_user->hair_color = 'Blonde';
                    break;

                case 4:
                    $new_user->hair_color = 'Brown';
                    break;

                case 5:
                    $new_user->hair_color = 'Red';
                    break;

                case 6:
                    $new_user->hair_color = 'Gray';
                    break;

                case 7:
                    $new_user->hair_color = 'White';
                    break;

                case 8:
                    $new_user->hair_color = 'Bald';
                    break;

                default:
                    $new_user->body_type = 'Other';
                    break;
            }

            switch(rand(1,7)) //ENUM('Black', 'Blue', 'Brown', 'Gray', 'Green', 'Hazel', 'Other')
            {
                case 1:
                    $new_user->eye_color = 'Black';
                    break;

                case 2:
                    $new_user->eye_color = 'Blue';
                    break;

                case 3:
                    $new_user->eye_color = 'Brown';
                    break;

                case 4:
                    $new_user->eye_color = 'Gray';
                    break;

                case 5:
                    $new_user->eye_color = 'Green';
                    break;

                case 6:
                    $new_user->eye_color = 'Hazel';
                    break;

                case 7:
                    $new_user->eye_color = 'Other';
                    break;
            }

            
            switch($user->ethnicity) //ENUM('Asian', 'White', 'Black', 'Hispanic', 'Indian', 'Middle Eastern', 'Native American', 'Pacific Islander', 'Mixed Race', 'Other')
            {
                case 1:
                    $new_user->ethnicity = 'Black';
                    break;

                case 2:
                    $new_user->ethnicity = 'Asian';
                    break;

                case 3:
                    $new_user->ethnicity = 'White';
                    break;

                case 4:
                    $new_user->ethnicity = 'Hispanic';
                    break;

                case 5:
                    $new_user->ethnicity = 'Middle Eastern';
                    break;

                case 6:
                    $new_user->ethnicity = 'Mixed Race';
                    break;

                case 7:
                    $new_user->ethnicity = 'Native American';
                    break;

                case 8:
                    $new_user->ethnicity = 'Pacific Islander';
                    break;

                case 9:
                    $new_user->ethnicity = 'Indian';
                    break;

                case 10:
                    $new_user->ethnicity = 'Other';
                    break;

                default:
                    $new_user->ethnicity = 'Other';
                    break;
            }
            
            
            switch($user->status) //ENUM('Single', 'Open Relationship', 'Involed Seeking Discreet')
            {
                case 1:
                    $new_user->relationship_status = 'Involed Seeking Discreet';
                    break;

                case 2:
                    $new_user->relationship_status = 'Involed Seeking Discreet';
                    break;

                case 3:
                    $new_user->relationship_status = 'Open Relationship';
                    break;

                case 4:
                    $new_user->relationship_status = 'Single';
                    break;

                case 5:
                    $new_user->relationship_status = 'Nothing Serious';
                    break;

                case 6:
                    $new_user->relationship_status = 'Single';
                    break;

                default:
                    $new_user->relationship_status = 'Single';
                    break;
            }
            
            switch($user->smoking) //ENUM('Single', 'Open Relationship', 'Involed Seeking Discreet')
            {
                case 1:
                    $new_user->smoke = 'Yes';
                    break;

                case 2:
                    $new_user->smoke = 'Yes';
                    break;

                case 3:
                    $new_user->smoke = 'No';
                    break;

                case 4:
                    $new_user->smoke = 'Yes';
                    break;

                default:
                    $new_user->smoke = 'No';
                    break;
            }
            
            
            switch($user->drinking) //ENUM('Single', 'Open Relationship', 'Involed Seeking Discreet')
            {
                case 1:
                    $new_user->drink = 'No';
                    break;

                case 2:
                    $new_user->drink = 'Yes';
                    break;

                case 3:
                    $new_user->drink = 'Yes';
                    break;

                case 4:
                    $new_user->drink = 'No';
                    break;

                default:
                    $new_user->drink = 'No';
                    break;
            }
            
            
            switch($user->first_date) //ENUM('No', 'Yes', 'Possibly', 'Meet Me and Find Out')
            {
                case 1:
                    $new_user->first_date_sex = 'Meet Me and Find Out';
                    break;

                case 2:
                    $new_user->first_date_sex = 'No';
                    break;

                case 3:
                    $new_user->first_date_sex = 'Meet Me and Find Out';
                    break;

                case 4:
                    $new_user->first_date_sex = 'Yes';
                    break;

                case 5:
                    $new_user->first_date_sex = 'Yes';
                    break;

                case 6:
                    $new_user->first_date_sex = 'No';
                    break;

                case 7:
                    $new_user->first_date_sex = 'Meet Me and Find Out';
                    break;

                default:
                    $new_user->first_date_sex = 'No';
                    break;
            }
            
            $new_user->save();
            
            $relationship_type1 = ORM::factory('relationship_type', 1);
            $relationship_type2 = ORM::factory('relationship_type', 2);
            $relationship_type3 = ORM::factory('relationship_type', 3);
            $relationship_type4 = ORM::factory('relationship_type', 4);
            $relationship_type5 = ORM::factory('relationship_type', 5);
            $relationship_type6 = ORM::factory('relationship_type', 6);
            $relationship_type7 = ORM::factory('relationship_type', 7);
            $relationship_type8 = ORM::factory('relationship_type', 8);
            
            $relationship_set = FALSE;
            
            if ($user->w_erofantasy != 0)
            {
                if ( ! $new_user->has('relationship_types', $relationship_type3))
                {
                    $new_user->add('relationship_types', $relationship_type3);
                    $relationship_set = TRUE;
                }
            }

            if ($user->w_one2one != 0)
            {
                if ( ! $new_user->has('relationship_types', $relationship_type1))
                {
                    $new_user->add('relationship_types', $relationship_type1);
                    $relationship_set = TRUE;
                }
            }

            if ($user->w_group != 0)
            {
                if ( ! $new_user->has('relationship_types', $relationship_type7))
                {
                    $new_user->add('relationship_types', $relationship_type7);
                    $relationship_set = TRUE;
                }
            }

            if ($user->w_discreet != 0)
            {
                if ( ! $new_user->has('relationship_types', $relationship_type8))
                {
                    $new_user->add('relationship_types', $relationship_type8);
                    $relationship_set = TRUE;
                }
            }

            if ($user->w_bondage != 0)
            {
                if ( ! $new_user->has('relationship_types', $relationship_type5))
                {
                    $new_user->add('relationship_types', $relationship_type5);
                    $relationship_set = TRUE;
                }
            }

            if ($user->w_crossdress != 0)
            {
                if ( ! $new_user->has('relationship_types', $relationship_type6))
                {
                    $new_user->add('relationship_types', $relationship_type6);
                    $relationship_set = TRUE;
                }
            }

            if ($user->w_fetishes != 0)
            {
                if ( ! $new_user->has('relationship_types', $relationship_type5))
                {
                    $new_user->add('relationship_types', $relationship_type5);
                    $relationship_set = TRUE;
                }
            }

            if ($user->w_exhibition != 0)
            {
                if ( ! $new_user->has('relationship_types', $relationship_type2))
                {
                    $new_user->add('relationship_types', $relationship_type2);
                    $relationship_set = TRUE;
                }
            }

            if ($user->w_sadomaso != 0)
            {
                if ( ! $new_user->has('relationship_types', $relationship_type5))
                {
                    $new_user->add('relationship_types', $relationship_type5);
                    $relationship_set = TRUE;
                }
            }
            
            if ($user->w_alternative != 0)
            {
                if ( ! $new_user->has('relationship_types', $relationship_type4))
                {
                    $new_user->add('relationship_types', $relationship_type4);
                    $relationship_set = TRUE;
                }
            }

            if ( ! $relationship_set)
            {
                if (rand(1,2) == 1 AND ! $new_user->has('relationship_types', $relationship_type1))
                {
                    $new_user->add('relationship_types', $relationship_type1);
                    $relationship_set = TRUE;
                }

                if (rand(1,2) == 1 AND ! $new_user->has('relationship_types', $relationship_type2))
                {
                    $new_user->add('relationship_types', $relationship_type2);
                    $relationship_set = TRUE;
                }

                if (rand(1,2) == 1 AND ! $new_user->has('relationship_types', $relationship_type3))
                {
                    $new_user->add('relationship_types', $relationship_type3);
                    $relationship_set = TRUE;
                }

                if (rand(1,2) == 1 AND ! $new_user->has('relationship_types', $relationship_type4))
                {
                    $new_user->add('relationship_types', $relationship_type4);
                    $relationship_set = TRUE;
                }

                if (rand(1,2) == 1 AND ! $new_user->has('relationship_types', $relationship_type5))
                {
                    $new_user->add('relationship_types', $relationship_type5);
                    $relationship_set = TRUE;
                }

                if (rand(1,2) == 1 AND ! $new_user->has('relationship_types', $relationship_type6))
                {
                    $new_user->add('relationship_types', $relationship_type6);
                    $relationship_set = TRUE;
                }

                if (rand(1,2) == 1 AND ! $new_user->has('relationship_types', $relationship_type7))
                {
                    $new_user->add('relationship_types', $relationship_type7);
                    $relationship_set = TRUE;
                }

                if (rand(1,2) == 1 AND ! $new_user->has('relationship_types', $relationship_type8))
                {
                    $new_user->add('relationship_types', $relationship_type8);
                    $relationship_set = TRUE;
                }
            }
/*INSERT INTO `relationship_types` (`id`, `type`) VALUES (1, 'Friends Only');
INSERT INTO `relationship_types` (`id`, `type`) VALUES (2, 'Friends with Benefits');
INSERT INTO `relationship_types` (`id`, `type`) VALUES (3, 'Casual Relationship');
INSERT INTO `relationship_types` (`id`, `type`) VALUES (4, 'Sex on the Side');
INSERT INTO `relationship_types` (`id`, `type`) VALUES (5, 'Fantasy Fullfillment');
INSERT INTO `relationship_types` (`id`, `type`) VALUES (6, 'Anyone for Anything');*/

            
            $new_user->signup_date = strtotime($user->register);
            $new_user->signup_ip = $user->last_ip;
            $new_user->last_login = strtotime($user->last_visit);
            $new_user->last_login_ip = $user->last_ip;
            $new_user->last_updated = NULL;

            $new_user->save();
            
            if (is_null($new_user->avatar_id))
            {
                $mydir = "photo/";
                $mysearch = '^' . $user . '_[0-9]+_b.jpg';
                 
                $dir = opendir($mydir);
                
                $set_avatar = FALSE;
                
                if ($dir ) {
                    while (($file = readdir($dir)) !== false)

                    if ($file != "." && $file != "..") {
                        if (preg_match('/'.$mysearch. '$/', $file)) {
                            echo " - found photo: " . $file . "... ";
                            
                            $uniqueid = uniqid();
                            
                            $path = 'c:/wamp/www/assets/photos/' . strtolower($new_user->username[0]) . '/' . strtolower($new_user->username) . '/';

                            if ( ! file_exists($path))
                            {
                                mkdir($path, 0777, TRUE);
                            }
                            
                            $image = Image::factory('c:/wamp/www/photo/' . $file);
                            
                            $image->crop($image->width, $image->height - 16, 0, 0);
                            $image->save($path . $uniqueid . '.png');
                            
                            if ($image->width > 572)
                            {
                                $image = $image->resize(572);
                            }

                            $image->save($path . $uniqueid . '_f.png');
                            
                            if ($image->height > $image->width)
                            {
                                $image->resize(300);
                            }
                            else
                            {
                                $image->resize(NULL, 300);
                            }
                            
                            $image->crop(300, 300);
                            $image->save($path . $uniqueid . '_a.png');

                            $image->resize(150, 150);
                            $image->save($path . $uniqueid . '_l.png');

                            $image->resize(100, 100);
                            $image->save($path . $uniqueid . '_m.png');
                            
                            $image->resize(50);
                            $image->save($path . $uniqueid . '_s.png');
                            
                            echo 'moved/cropped/resized photo... ';
                            
                            $avatar_photo = ORM::factory('photo');

                            $avatar_photo->user_id = $new_user->id;
                            $avatar_photo->uniqueid = $uniqueid;
                            $avatar_photo->save();

                            echo 'saved to photos tables... ';
                            
                            if ( ! $set_avatar)
                            {
                                $new_user->avatar_id = $avatar_photo->id;
                                $new_user->save();
                                
                                echo 'set photo as user avatar... ';
                                
                                $set_avatar = TRUE;
                            }
                        }
                    }

                    closedir($dir);
                } else { echo "opendir() returned FALSE!";
                    exit;
                }
            }
            
            echo '<br>';
        }
        
        echo '<br><b>Finished: ' . date("F j, Y, g:i a") . '</b>';
    }
}