<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Rating extends ORM
{
    protected $_belongs_to = array('user' => array());    
}