<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Log extends ORM
{
  protected $_belongs_to = array('to' => array('model'  => 'user'), 'from' => array('model'  => 'user'));
}