<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Feed extends ORM
{
    protected $_belongs_to = array('user' => array(), 'feed_type' => array());

    protected $_created_column = array('column' => 'added_date', 'format' => TRUE);
    protected $_updated_column = array('column' => 'added_date', 'format' => TRUE);
}