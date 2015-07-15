<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Relationship_Type_User extends ORM
{
    protected $_belongs_to = array('user' => array(), 'relationship_type' => array());
}