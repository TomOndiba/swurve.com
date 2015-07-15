<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Affiliates_Reports extends Controller_Master
{
    public $template = 'affiliates';

    public function action_index()
    {
        $this->add_javascript(array(Functions::src_file('assets/js/jquery-ui.min.js')));
        $this->template->content = View::factory('affiliates/reports')->bind('data', $data)->bind('range', $range)->bind('post', $post)->bind('graphOptions', $graphOptions);

        $range = ORM::factory('affiliate_payout')->where(new Database_Expression(strtotime('est today')), 'BETWEEN', new Database_Expression('start AND end'))->find();
        
        $graphOptions = array(
            'Registrants' => 'Registrants', 
            'Members' => 'Members'
        );
        
        if ($_POST)
        {
            $post = $_POST;

            if ($post['graph1'] == 'Registrants')
            {
                $data = ORM::factory('user')->where('affiliate', '=', Core::$affiliate->id)->and_where('membership_id', '<', 3);
            }
            else
            {
                $data = ORM::factory('user')->where('affiliate', '=', Core::$affiliate->id)->and_where('membership_id', '>=', 3);
            }
            
            if (! empty($post['date_from']))
            {
                $data = $data->and_where('signup_date', '>=', strtotime($post['date_from']));
            }

            if (! empty($post['date_to']))
            {
                $data = $data->and_where('signup_date', '<', strtotime($post['date_to'] . ' +1 day'));
            }
            
            $data = $data->and_where('tracking_id', 'IS NOT', NULL)->order_by('tracking_id')->find_all();
        }
    }
}
