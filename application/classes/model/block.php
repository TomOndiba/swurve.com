<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Block extends ORM
{
    protected $_belongs_to = array('user' => array(), 'block' => array('model'  => 'user'));

    protected $_created_column = array('column' => 'date', 'format' => TRUE);
}