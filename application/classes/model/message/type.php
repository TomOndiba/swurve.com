<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Message_Type extends ORM
{
    protected $_has_many = array('messages' => array(), 'templates' => array());
}