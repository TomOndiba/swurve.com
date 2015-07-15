<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Online extends ORM
{
    protected $_belongs_to = array('user' => array());
    protected $_table_names_plural = FALSE;

    public function update($user = NULL, $offset = null) {
        if (is_null($user))
        {
            $user = Core::$user;
        }

        if ( ! $this->loaded())
        {
            $this->user_id = $user;
            $this->last_seen = isset($offset) ? strtotime('now + ' . $offset) : strtotime('now');
            $this->save();
        }
        else
        {
            $this->last_seen = isset($offset) ? strtotime('now + ' . $offset) : strtotime('now');
            $this->save();
        }
    }
}