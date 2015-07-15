<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Membership extends ORM
{
    protected $_has_many = array('users' => array(), 'transactions' => array());
}