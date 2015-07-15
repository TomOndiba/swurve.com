<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Chat extends ORM
{
    protected $_belongs_to = array('to' => array('model'  => 'user'), 'from' => array('model'  => 'user'), 'contact_type' => array());
}