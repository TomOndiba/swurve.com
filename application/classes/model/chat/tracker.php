<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Chat_Tracker extends ORM
{
    protected $_primary_key  = 'user_id';
    protected $_table_names_plural = FALSE;
    
    static public function get_stats_daterange($camgirl, $range) 
    {
        $from = $range->start;
        $to = $range->end;
        
        $stats = ORM::factory('chat_tracker');
        
        $stats->select(new Database_Expression("CASE WHEN tier = 0 THEN 1 ELSE tier END AS 'tier'"));
        $stats->select(new Database_Expression("SUM(credits) AS 'pcount'"));
        $stats->where('user_id', '=', $camgirl->swurve_id);
        $stats->where('date', 'between', new Database_Expression($from . ' AND ' . $to));
        $stats->group_by('user_id');
        $stats->group_by('tier');
        $stats->group_by('type');
        
        return $stats->find_all();
    }
}
?>