<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Affiliate_Bannerad extends ORM
{
    protected $_has_many = array('affiliate_categories' => array('through' => 'affiliate_bannerads_categories'));
    
    protected $_created_column = array('column' => 'date_added', 'format' => TRUE);
}