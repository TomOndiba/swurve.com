<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Affiliates_Campaigns extends Controller_Master
{
    public $template = 'affiliates';
    
    public function action_index()
    {
        $this->template->content = View::factory('affiliates/campaigns')->bind('campaigns', $campaigns)->bind('subs', $subs);
        
        if ($_POST)
        {
            $post = $_POST;
            
            switch($post['action'])
            {
                case 'newcampaign':
                    $campaign = ORM::factory('affiliate_campaign');
                    
                    $campaign->affiliate_id = Core::$affiliate;
                    $campaign->description = Security::xss_clean($post['description']);
                    
                    $campaign->save();
                    
                    Notify::set('pass', 'A new Campaign has been created and assigned the ID #' . $campaign->id);
                    Request::instance()->redirect(Request::$referrer);
                    break;
                    
                case 'newsub':
                    $sub = ORM::factory('affiliate_sub');

                    $sub->affiliate_id = Core::$affiliate;
                    $sub->description = Security::xss_clean($post['description']);
                    $sub->campaign_id = $post['campaign_id'];

                    $sub->save();

                    Notify::set('pass', 'A new Sub ID has been created and assigned the ID #' . $sub->id);
                    Request::instance()->redirect(Request::$referrer);
                    break;
            }
        }
        
        if ($_GET)
        {
            $get = $_GET;
            
            switch($get['action'])
            {
                case 'deletesub':
                    $sub = ORM::factory('affiliate_sub', array('id' => Security::xss_clean($get['id'])));
                    
                    if ($sub->loaded() AND $sub->affiliate_id == Core::$affiliate)
                    {
                        Notify::set('pass', 'Sub ID #' . $sub->id . ' has been deleted.');
                        
                        $sub->delete();
                        
                        Request::instance()->redirect(Request::$referrer);
                    }
                    else
                    {
                        Notify::set('info', 'Please do not attempt to delete others Campaigns or Sub ID\'s you have been warned.');
                        Request::instance()->redirect(Request::$referrer);
                    }
                    
                    break;
                    
                case 'deletecampaign':
                    $campaign = ORM::factory('affiliate_campaign', array('id' => Security::xss_clean($get['id'])));
                    
                    if ($campaign->loaded() AND $campaign->affiliate_id == Core::$affiliate)
                    {
                        Notify::set('pass', 'Campaign ID #' . $campaign->id . ' has been deleted' . ( ($campaign->affiliate_subs->count_all() > 0) ? ' along with ' . $campaign->affiliate_subs->count_all() . ' Sub ID(s)' : '' ) . '.');
                        
                        foreach($campaign->affiliate_subs->find_all() as $sub)
                        {
                            $sub->delete();
                        }
                        
                        $campaign->delete();
                        
                        Request::instance()->redirect(Request::$referrer);
                    }
                    else
                    {
                        Notify::set('info', 'Please do not attempt to delete others Campaigns or Sub ID\'s you have been warned.');
                        Request::instance()->redirect(Request::$referrer);
                    }

                    break;        
            }
        }
        
        $campaigns = Core::$affiliate->affiliate_campaigns->find_all();
        $subs = Core::$affiliate->affiliate_subs->find_all();
    }
}