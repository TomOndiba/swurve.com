<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_GeoLocation extends ORM
{
    protected $_has_one = array('geoip' => array());
    
    protected $_table_name = 'iplocationdb_location';
    protected $_table_names_plural = FALSE;
}