<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Contact_Type extends ORM
{
    protected $_has_many = array('contacts' => array());
}