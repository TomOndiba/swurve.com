<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Comment extends ORM
{
	protected $_table_name = 'Comments';
	protected $_primary_key  = 'cmt_id';
	protected $_belongs_to = array('file' => array('foreign_key' => 'fld_id'));
}