<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Affiliate_Category extends ORM
{
    protected $_has_many = array('affiliate_bannerads' => array('through' => 'affiliate_bannerads_categories'));
}