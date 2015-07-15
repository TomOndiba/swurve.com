<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Server extends ORM
{
	protected $_table_name = 'Servers';
	protected $_primary_key = 'srv_id';
	protected $_has_many = array('files' => array('foreign_key' => 'srv_id'));
}