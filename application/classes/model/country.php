<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Country extends ORM
{
    protected $has_many = array('users');
}