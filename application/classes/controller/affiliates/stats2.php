<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Affiliates_Stats2 extends Controller_Master
{
    public $template = 'affiliates';

    public function action_index()
    {
	    $this->add_javascript(array(Functions::src_file('assets/js/jquery-ui.min.js')));
        $this->template->content = View::factory('affiliates/stats2')->bind('data', $data)->bind('post', $post)->bind('graphOptions', $graphOptions)->bind('campaigns', $campaigns)->bind('subs', $subs);

        $obj_campaigns = Core::$affiliate->affiliate_campaigns->find_all();
        $obj_subs = Core::$affiliate->affiliate_subs->where('campaign_id', '=', 0)->find_all();

        $campaigns = array();
        
        foreach($obj_campaigns as $campaign)
        {
            $campaigns['campaign-' . $campaign->id] = 'Campaign #' . $campaign . ' - ' . $campaign->description;
            
            foreach($campaign->affiliate_subs->find_all() as $sub)
            {
                $campaigns['sub-' . $sub->id] = '&nbsp;&nbsp;&nbsp;Sub ID #' . $sub . ' - ' . $sub->description;
            }
        }

        $subs = array();

        foreach($obj_subs as $sub)
        {
            $subs['sub-' . $sub->id] = 'ID #' . $sub . ' - ' . $sub->description;
        }

        $graphOptions = array(
            '' => 'Select Graph',
            'Total Clicks' => 'Total Clicks', 
            'Total Registrants' => 'Total Registrants', 
            'Total Members' => 'Total Members',
            'Clicks to Registrants Conversion %' => 'Clicks to Registrants Conversion %',
            'Clicks to Members Conversion %' => 'Clicks to Members Conversion %',
            'Registrants to Members Conversion %' => 'Registrants to Members Conversion %'
        );

        if ($_POST)
        {
            $post = $_POST;

            $site = (isset($post['site']) AND ! empty($post['site'])) ? $post['site'] : null;

            $data = Core::$affiliate->affiliate_stats->get_stats_daterange($site, $post['date_from'], $post['date_to'], $post['subcampaign']);

            $this->template->content .= $this->get_graph($post['graph1'], $data);

            if (isset($post['graph1']) AND isset($post['graph2']) AND $post['graph1'] != $post['graph2'])
                $this->template->content .= $this->get_graph($post['graph2'], $data);
            
            if (isset($post['graph1']) AND isset($post['graph2']) AND isset($post['graph3']) AND $post['graph1'] != $post['graph3'] AND $post['graph2'] != $post['graph3'])
                $this->template->content .= $this->get_graph($post['graph3'], $data);
        }
        else
        {
            $data = Core::$affiliate->affiliate_stats->get_stats(null, 21);

            $this->template->content .= View::factory('affiliates/graphs/default')->bind('data', $data);
        }

        $this->template->content .= '<br /><center><a href="/affiliates/stats/exportcsv">Export CSV</a></center>';
    }

    public function action_exportcsv()
    {

    }
    
    public function get_graph($type, $data)
    {
        switch((isset($type)) ? $type : null)
        {
            case 'Total Clicks':
                return View::factory('affiliates/graphs2/total-clicks')->bind('data', $data);
                break;

            case 'Total Registrants':
                return View::factory('affiliates/graphs2/total-registrants')->bind('data', $data);
                break;

            case 'Total Members':
                return View::factory('affiliates/graphs2/total-members')->bind('data', $data);
                break;

            case 'Clicks to Registrants Conversion %':
                return View::factory('affiliates/graphs2/clicks-to-registrants-conversion')->bind('data', $data);
                break;

            case 'Clicks to Members Conversion %':
                return View::factory('affiliates/graphs2/clicks-to-members-conversion')->bind('data', $data);
                break;

            case 'Registrants to Members Conversion %':
                return View::factory('affiliates/graphs2/registrants-to-members-conversion')->bind('data', $data);
                break;

            default:
                return null;
                break;
        }
    }
}
