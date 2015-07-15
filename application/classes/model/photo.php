<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Photo extends ORM
{
    protected $_belongs_to = array('user' => array());

    protected $_created_column = array('column' => 'added_date', 'format' => TRUE);
}