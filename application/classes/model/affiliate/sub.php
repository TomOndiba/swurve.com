<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Affiliate_Sub extends ORM
{
    protected $_belongs_to = array('affiliate' => array(), 'affiliate_campaigns' => array('foreign_key' => 'campaign_id'));
}