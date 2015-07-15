<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Message extends ORM
{
    protected $_belongs_to = array('to' => array('model'  => 'user'), 'from' => array('model'  => 'user'), 'message_type' => array());
    protected $_created_column = array('column' => 'date_sent', 'format' => TRUE);
    /*
    public function __set($key, $value)
    {
        if ($key == 'date_sent' || $key == 'date_read')
        {
            $value = date("Y-m-d H:i:s", $value);
        }
        
        return parent::__set($key, $value);
    }
    
    public function __get($key)
    {
        if ($key == 'date_sent' || $key == 'date_read')
        {
            return strtotime($this->object->$key);
        }
        
        return parent::__get($key);
    }
    */
}