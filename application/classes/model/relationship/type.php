<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Relationship_Type extends ORM
{
    protected $_has_many = array('users' => array('through' => 'relationship_types_users'));
}