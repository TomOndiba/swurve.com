<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Feed_Type extends ORM
{
    protected $_has_many = array('feeds' => array());
}