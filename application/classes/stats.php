<?php defined('SYSPATH') or die('No direct script access.'); 

class Stats
{
    public static function add_click($affiliate_id, $sub_id, $offset = '')
    {
        $affiliate_id = Security::xss_clean(trim($affiliate_id));
        $sub_id = Security::xss_clean(trim($sub_id));
        
        if (empty($sub_id)) 
        {
            $sub_id = 0;
        }
        
        if (! empty($affiliate_id) AND is_numeric($affiliate_id) AND ORM::factory('affiliate', array('id' => $affiliate_id))->loaded())
        {
            $sql = "INSERT INTO affiliate_stats(affiliate_id, sub_id, program, stat_type_id, date, count) VALUES (" . $affiliate_id . ", " . $sub_id . ", '" . ORM::factory('affiliate', array('id' => $affiliate_id))->program . "', " . ORM::factory('stat_type', array('type' => 'Clicks')) . ", " . strtotime('est today' . $offset) . ", 1) ON DUPLICATE KEY UPDATE count = count + 1;";
            
            $data = DB::query(Database::INSERT, $sql)->execute();
        }
    }

    public static function add_registration($affiliate_id, $sub_id, $offset = '')
    {
        $affiliate_id = Security::xss_clean(trim($affiliate_id));
        $sub_id = Security::xss_clean(trim($sub_id));

        if (empty($sub_id)) 
        {
            $sub_id = 0;
        }
        
        if (! empty($affiliate_id) AND is_numeric($affiliate_id) AND ORM::factory('affiliate', array('id' => $affiliate_id))->loaded())
        {
            $sql = "INSERT INTO affiliate_stats(affiliate_id, sub_id, program, stat_type_id, date, count) VALUES (" . $affiliate_id . ", " . $sub_id . ", '" . ORM::factory('affiliate', array('id' => $affiliate_id))->program . "', " . ORM::factory('stat_type', array('type' => 'Registrations')) . ", " . strtotime('est today' . $offset) . ", 1) ON DUPLICATE KEY UPDATE count = count + 1;";
            
            $data = DB::query(Database::INSERT, $sql)->execute();
        }
    }

    public static function add_member($affiliate_id, $sub_id, $amount, $offset = '')
    {
        $affiliate_id = Security::xss_clean(trim($affiliate_id));
        $sub_id = Security::xss_clean(trim($sub_id));

        if (empty($sub_id)) 
        {
            $sub_id = 0;
        }
        
        if (! empty($affiliate_id) AND is_numeric($affiliate_id) AND ORM::factory('affiliate', array('id' => $affiliate_id))->loaded())
        {
            $sql = "INSERT INTO affiliate_stats(affiliate_id, sub_id, amount, program, stat_type_id, date, count) VALUES (" . $affiliate_id . ", " . $sub_id . ", " . $amount . ", '" . ORM::factory('affiliate', array('id' => $affiliate_id))->program . "', " . ORM::factory('stat_type', array('type' => 'Memberships')) . ", " . strtotime('est today' . $offset) . ", 1) ON DUPLICATE KEY UPDATE count = count + 1;";
            
            $data = DB::query(Database::INSERT, $sql)->execute();
            
            $affiliate = ORM::factory('affiliate', array('id' => $affiliate_id));
            
            $affiliate->reward_points += 1;
            $affiliate->save();
        }
    }

    public static function add_rebilling($affiliate_id, $sub_id, $amount, $offset = '')
    {
        $affiliate_id = Security::xss_clean(trim($affiliate_id));
        $sub_id = Security::xss_clean(trim($sub_id));

        if (empty($sub_id)) 
        {
            $sub_id = 0;
        }

        if (! empty($affiliate_id) AND is_numeric($affiliate_id) AND ORM::factory('affiliate', array('id' => $affiliate_id))->loaded())
        {
            $sql = "INSERT INTO affiliate_stats(affiliate_id, sub_id, amount, program, stat_type_id, date, count) VALUES (" . $affiliate_id . ", " . $sub_id . ", " . $amount . ", '" . ORM::factory('affiliate', array('id' => $affiliate_id))->program . "', " . ORM::factory('stat_type', array('type' => 'Rebillings')) . ", " . strtotime('est today' . $offset) . ", 1) ON DUPLICATE KEY UPDATE count = count + 1;";
            
            $data = DB::query(Database::INSERT, $sql)->execute();
        }
    }
}