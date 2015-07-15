<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Affiliate_Campaign extends ORM
{
    protected $_belongs_to = array('affiliate' => array());
    protected $_has_many = array('affiliate_subs' => array('foreign_key' => 'campaign_id'));
}