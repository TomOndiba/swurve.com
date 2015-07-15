<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Stat_Type extends ORM
{
    protected $_belongs_to = array('affiliate_stats' => array());
}