<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_File extends ORM
{
	protected $_table_name = 'Files';
	protected $_primary_key  = 'file_id';
	protected $_belongs_to = array('user' => array('foreign_key' => 'usr_id'), 'folder' => array('foreign_key' => 'fld_id'), 'server' => array('foreign_key' => 'srv_id'));
	protected $_has_many = array('comments' => array('foreign_key' => 'cmt_ext_id'));
}