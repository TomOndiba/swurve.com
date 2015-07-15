<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Template extends ORM
{
    protected $_belongs_to = array('message_type' => array());
}