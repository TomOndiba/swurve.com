<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_View extends ORM
{
    protected $_belongs_to = array('user' => array(), 'viewed' => array('model'  => 'user'));
    
    public function update($viewed, $viewer = NULL) {
        if (is_null($viewer))
        {
            $viewer = Core::$user;
        }
        
        if ($viewer->stealth == 'On')
        {
            return;
        }
        
        if ($this->where('user_id', '=', $viewer)->where('viewed_id', '=', $viewed)->find()->loaded())
        {
            $this->viewed_date = time();
            $this->save();
        }
        else
        {
            $this->user_id = $viewer;
            $this->viewed_id = $viewed;
            $this->viewed_date = time();
            $this->save();
        }
    }
}