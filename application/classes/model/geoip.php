<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_GeoIp extends ORM
{
    protected $_belongs_to = array('geolocation' => array('foreign_key' => 'location_id'));    

    protected $_table_name = 'iplocationdb_ip';
    protected $_table_names_plural = FALSE;
    protected $_primary_key  = 'start_ip';
}