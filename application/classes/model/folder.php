<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Folder extends ORM
{
	protected $_table_name = 'Folders';
	protected $_primary_key = 'fld_id';
	protected $_belongs_to = array('user' => array());
	protected $_has_many = array('files' => array('foreign_key' => 'file_fld_id'));
}