<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Affiliate_stat extends ORM
{
    protected $_primary_key  = 'affiliate_id';
    protected $_belongs_to = array('affiliate' => array());

    public function get_totals($site, $program = NULL)
    {
        $defaults = array('Clicks' => 0, 'Registrations' => 0, 'Memberships' => 0, 'Rebillings' => 0);

        $this->select('stat_types.type', new Database_Expression("SUM(count) AS 'totals'"));
        $this->where('program', '=', (is_null($program)) ? Core::$affiliate->program : $program);

        if (isset($site))
        {
            $this->where('site', '=', $site);
        }

        $this->join('stat_types')->on('affiliate_stats.stat_type_id', '=', 'stat_types.id');
        $this->group_by('affiliate_stats.stat_type_id');

        $results = $this->find_all()->as_array('type', 'totals');

        return array_merge($defaults, $results);
    }

    public function get_stats($site, $days)
    {
        $defaults = Functions::createDateRangeArray('est today', 'est today -' . ($days - 1) . ' days');

        if (isset($site))
        {
            $this->where('affiliate_stats.site', '=', $site);
        }

        $clone = clone $this;
        //--

        $query = clone $clone;

        $query->select(new Database_Expression("FROM_UNIXTIME(date, '%Y-%m-%d') AS 'pdate'"));
        $query->select(new Database_Expression("SUM(count) AS 'pcount'"));
        $query->join('stat_types')->on('affiliate_stats.stat_type_id', '=', 'stat_types.id');
        $query->where('stat_types.type', '=', 'Clicks');
        $query->where('program', '=', Core::$affiliate->program);
        $query->where(new Database_Expression('FROM_UNIXTIME(date)'), '>=', new Database_Expression('DATE_SUB(NOW(), INTERVAL ' . $days .' DAY)'));
        $query->group_by('date');

        $results = $query->find_all()->as_array('pdate', 'pcount');

        $data['Clicks'] = array_merge($defaults, $results);

        //--

        $query = clone $clone;

        $query->select(new Database_Expression("FROM_UNIXTIME(date, '%Y-%m-%d') AS 'pdate'"));
        $query->select(new Database_Expression("SUM(count) AS 'pcount'"));
        $query->join('stat_types')->on('affiliate_stats.stat_type_id', '=', 'stat_types.id');
        $query->where('stat_types.type', '=', 'Registrations');
        $query->where('program', '=', Core::$affiliate->program);
        $query->where(new Database_Expression('FROM_UNIXTIME(date)'), '>=', new Database_Expression('DATE_SUB(NOW(), INTERVAL ' . $days .' DAY)'));
        $query->group_by('date');

        $results = $query->find_all()->as_array('pdate', 'pcount');

        $data['Registrations'] = array_merge($defaults, $results);

        //--

        $query = clone $clone;

        $query->select(new Database_Expression("FROM_UNIXTIME(date, '%Y-%m-%d') AS 'pdate'"));
        $query->select(new Database_Expression("SUM(count) AS 'pcount'"));
        $query->join('stat_types')->on('affiliate_stats.stat_type_id', '=', 'stat_types.id');
        $query->where('stat_types.type', '=', 'Memberships');
        $query->where('program', '=', Core::$affiliate->program);
        $query->where(new Database_Expression('FROM_UNIXTIME(date)'), '>=', new Database_Expression('DATE_SUB(NOW(), INTERVAL ' . $days .' DAY)'));
        $query->group_by('date');

        $results = $query->find_all()->as_array('pdate', 'pcount');

        $data['Memberships'] = array_merge($defaults, $results);

        //--

        $query = clone $clone;

        $query->select(new Database_Expression("FROM_UNIXTIME(date, '%Y-%m-%d') AS 'pdate'"));
        $query->select(new Database_Expression("SUM(count) AS 'pcount'"));
        $query->join('stat_types')->on('affiliate_stats.stat_type_id', '=', 'stat_types.id');
        $query->where('stat_types.type', '=', 'Rebillings');
        $query->where('program', '=', Core::$affiliate->program);
        $query->where(new Database_Expression('FROM_UNIXTIME(date)'), '>=', new Database_Expression('DATE_SUB(NOW(), INTERVAL ' . $days .' DAY)'));
        $query->group_by('date');

        $results = $query->find_all()->as_array('pdate', 'pcount');

        $data['Rebillings'] = array_merge($defaults, $results);

        return $data;
     }

    public function get_stats_daterange()
    {
        if (func_num_args() == 2)
        {
            $site = func_get_arg(0);
            $range = func_get_arg(1);

            $from = $range->start;
            $to = $range->end;
        }
        elseif (func_num_args() == 3)
        {
            $site = func_get_arg(0);
            $from = strtotime(func_get_arg(1));
            $to = strtotime(func_get_arg(2));
        }
        else
        {
            $site = func_get_arg(0);
            $from = strtotime(func_get_arg(1));
            $to = strtotime(func_get_arg(2));
            $subcampaign = func_get_arg(3);

            $type = substr($subcampaign, 0, strpos($subcampaign, '-'));
            $id = substr($subcampaign, strpos($subcampaign, '-') + 1);

            if ($type == 'sub')
            {
                $this->where('affiliate_stats.sub_id', '=', $id);
            }
            elseif ($type == 'campaign')
            {
                $campaign = ORM::factory('affiliate_campaign', array('id' => $id));
                $subs = $campaign->affiliate_subs->find_all()->as_array('id', 'id');

                if (count($subs) > 0)
                {
                    $this->where('affiliate_stats.sub_id', 'IN', new Database_Expression('(' . implode(',', $subs) . ')'));
                }
            }
        }

        if (isset($site))
        {
            $this->where('affiliate_stats.site', '=', $site);
        }

        $defaults = Functions::createDateRangeArray($from, $to);

        $clone = clone $this;

        $query = clone $clone;

        $query->select(new Database_Expression("FROM_UNIXTIME(date, '%Y-%m-%d') AS 'pdate'"));
        $query->select(new Database_Expression("SUM(count) AS 'pcount'"));
        $query->join('affiliates')->on('affiliate_stats.affiliate_id', '=', 'affiliates.id');
        $query->join('stat_types')->on('affiliate_stats.stat_type_id', '=', 'stat_types.id');
        $query->where('stat_types.type', '=', 'Clicks');
        $query->where('affiliate_stats.program', '=', new Database_Expression('affiliates.program'));
        $query->where('date', 'between', new Database_Expression($from . ' AND ' . $to));
        $query->group_by('date', 'stat_type_id');

        $results = $query->find_all()->as_array('pdate', 'pcount');

        $data['Clicks'] = array_merge($defaults, $results);

        //--
        $query = clone $clone;

        $query->select(new Database_Expression("FROM_UNIXTIME(date, '%Y-%m-%d') AS 'pdate'"));
        $query->select(new Database_Expression("SUM(count) AS 'pcount'"));
        $query->join('affiliates')->on('affiliate_stats.affiliate_id', '=', 'affiliates.id');
        $query->join('stat_types')->on('affiliate_stats.stat_type_id', '=', 'stat_types.id');
        $query->where('stat_types.type', '=', 'Memberships');
        $query->where('affiliate_stats.program', '=', new Database_Expression('affiliates.program'));
        $query->where('date', 'between', new Database_Expression($from . ' AND ' . $to));
        $query->group_by('date', 'stat_type_id');

        $results = $query->find_all()->as_array('pdate', 'pcount');

        $data['Memberships'] = array_merge($defaults, $results);

        //--
        //if (Core::$affiliate->program == 'PPS')
        //{
            $query = clone $clone;

            $query->select(new Database_Expression("FROM_UNIXTIME(date, '%Y-%m-%d') AS 'pdate'"));
            $query->select(new Database_Expression("SUM(count) AS 'pcount'"));
            $query->join('affiliates')->on('affiliate_stats.affiliate_id', '=', 'affiliates.id');
            $query->join('stat_types')->on('affiliate_stats.stat_type_id', '=', 'stat_types.id');
            $query->where('stat_types.type', '=', 'Registrations');
            $query->where('affiliate_stats.program', '=', new Database_Expression('affiliates.program'));
            $query->where('date', 'between', new Database_Expression($from . ' AND ' . $to));
            $query->group_by('date', 'stat_type_id');

            $results = $query->find_all()->as_array('pdate', 'pcount');

            $data['Registrations'] = array_merge($defaults, $results);
        //}
        //elseif (Core::$affiliate->program == 'Revshare')
        //{
            //--
            $query = clone $clone;

            $query->select(new Database_Expression("FROM_UNIXTIME(date, '%Y-%m-%d') AS 'pdate'"));
            $query->select(new Database_Expression("SUM(count) AS 'pcount'"));
            $query->join('affiliates')->on('affiliate_stats.affiliate_id', '=', 'affiliates.id');
            $query->join('stat_types')->on('affiliate_stats.stat_type_id', '=', 'stat_types.id');
            $query->where('stat_types.type', '=', 'Rebillings');
            $query->where('affiliate_stats.program', '=', new Database_Expression('affiliates.program'));
            $query->where('date', 'between', new Database_Expression($from . ' AND ' . $to));
            $query->group_by('date', 'stat_type_id');

            $results = $query->find_all()->as_array('pdate', 'pcount');

            $data['Rebillings'] = array_merge($defaults, $results);

            //--
            $query = clone $clone;

            $query->select(new Database_Expression("FROM_UNIXTIME(date, '%Y-%m-%d') AS 'pdate'"));
            $query->select(new Database_Expression("SUM(amount) AS 'pcount'"));
            $query->join('affiliates')->on('affiliate_stats.affiliate_id', '=', 'affiliates.id');
            $query->join('stat_types')->on('affiliate_stats.stat_type_id', '=', 'stat_types.id');
            $query->where('stat_types.type', '=', 'Rebillings');
            $query->where('affiliate_stats.program', '=', new Database_Expression('affiliates.program'));
            $query->where('date', 'between', new Database_Expression($from . ' AND ' . $to));
            $query->group_by('date', 'stat_type_id');

            $results = $query->find_all()->as_array('pdate', 'pcount');

            $data['RebillingAmount'] = array_merge($defaults, $results);

            //--
            $query = clone $clone;

            $query->select(new Database_Expression("FROM_UNIXTIME(date, '%Y-%m-%d') AS 'pdate'"));
            $query->select(new Database_Expression("SUM(amount) AS 'pcount'"));
            $query->join('affiliates')->on('affiliate_stats.affiliate_id', '=', 'affiliates.id');
            $query->join('stat_types')->on('affiliate_stats.stat_type_id', '=', 'stat_types.id');
            $query->where('stat_types.type', '=', 'Memberships');
            $query->where('affiliate_stats.program', '=', new Database_Expression('affiliates.program'));
            $query->where('date', 'between', new Database_Expression($from . ' AND ' . $to));
            $query->group_by('date', 'stat_type_id');

            $results = $query->find_all()->as_array('pdate', 'pcount');

            $data['MembershipAmount'] = array_merge($defaults, $results);
        //}

        return $data;
     }
}