<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Transaction extends ORM
{
    protected $_belongs_to = array('user' => array(), 'membership' => array());

    protected $_created_column = array('column' => 'added', 'format' => TRUE);
}