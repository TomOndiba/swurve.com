<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_City extends ORM 
{
    protected $has_many = array('users');
}