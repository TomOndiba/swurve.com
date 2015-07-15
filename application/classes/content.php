<?php defined('SYSPATH') or die('No direct script access.');

class Content
{
    public static $avatar_path;
    protected static $instance;
    protected static $user;

    protected $config;

    public static function factory($user)
    {
        if ( ! isset(Content::$instance))
        {
            $config = Kohana::config('content');

            self::$instance = new Content($config);
        }

        self::$user = strtolower($user);

        return Content::$instance;
    }

    public function __construct($config = array())
    {
        $this->config = $config;
    }

    public function save_photo($file, $type)
    {
        $uniqueid = uniqid();

        switch($type)
        {
            case 'photo':
                if (Upload::save($file, $uniqueid . '.png', $this->get_path($type), 0777))
                    return $uniqueid;
                else
                    return FALSE;
                break;
        }

        return FALSE;
    }

    public function get_photo($photo, $size = NULL, $allow = FALSE, $admin_check = FALSE)
    {
        if ($size)
        {
            $size = '_' . $size;
        }

        if (is_object($photo))
        {
            //if ($photo->loaded() AND $photo->approved == 'PG-13')
            if ($photo->loaded() AND $photo->approved != 'No' AND $photo->hide == 'No' OR ($photo->user_id == Core::$user AND $allow) OR $admin_check)
            {
                if ($photo->approved == 'Adult')
                {
                    if (Core::$user->membership->paid == 1 OR $admin_check OR ($photo->user_id == Core::$user AND $allow))
                    {
                        return $this->get_url('photo') . $photo->uniqueid . $size . '.png';
                    }
                    else
                    {
                        return $this->config['photo_url'] . 'xxx' . strtolower(ORM::factory('user', array('username' => self::$user))->gender) . $size . '.png';
                    }
                }
                else
                {
                    return $this->get_url('photo') . $photo->uniqueid . $size . '.png';
                }
            }
            else
            {
                return $this->config['photo_url'] . 'nophoto' . $size . '.png';
            }
        }
        elseif (is_null($photo))
        {
            return $this->config['photo_url'] . 'nophoto' . $size . '.png';
        }
        else
        {
            $photo = ORM::factory('photo')->with('user')->where('photos.uniqueid', '=', $photo)->where('user.username', '=', self::$user)->find();

            if ($photo->loaded() AND $photo->approved != 'No' AND $photo->hide == 'No' OR ($photo->user_id == Core::$user AND $allow) OR $admin_check)
            {
                if ($photo->approved == 'Adult')
                {
                    if (Core::$user->membership->paid == 1 OR $admin_check OR ($photo->user_id == Core::$user AND $allow))
                    {
                        return $this->get_url('photo') . $photo->uniqueid . $size . '.png';
                    }
                    else
                    {
                        return $this->config['photo_url'] . '/xxx' . strtolower(ORM::factory('user', array('username' => self::$user))->gender) . $size . '.png';
                        //return URL::site('assets/photos/restricted' . $size . '.png');
                    }
                }
                else
                {
                    return $this->get_url('photo') . $photo->uniqueid . $size . '.png';
                }
            }
            else
            {
                if ($size == '_l') $size = '_m';

                return $this->config['photo_url'] . 'nophoto' . $size . '.png';
            }
        }
    }

    public function get_photo_path($photo)
    {
        if ($photo->loaded())
        {
            return $this->get_path('photo', FALSE) . $photo->uniqueid . '.png';
        }
        else
        {
            return NULL;
        }
    }


    public function get_path($type, $create = TRUE)
    {
        $path = $this->config[$type . '_path'] . self::$user[0] . '/' . self::$user . '/';

        if ( ! file_exists($path) AND $create)
        {
            mkdir($path, 0777, TRUE);
        }

        return $path;
    }

    public function get_url($type)
    {
        return $this->config[$type . '_url'] . self::$user[0] . '/' . self::$user . '/';
    }
}
