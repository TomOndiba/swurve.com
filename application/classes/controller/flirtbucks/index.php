<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Flirtbucks_Index extends Controller_Master
{
    public $template = 'flirtbucks';

    function trim_array(&$value, $key) {
        $value = str_replace('"', '', $value);
    }

    public function action_index()
    {
        if (isset($_POST['action']) AND $_POST['action'] == 'confirmed')
        {
            Core::$camgirl->show_notice = '0';

            Core::$camgirl->save();
        }

        $this->template->content = View::factory('flirtbucks/index')->bind('range', $range)->bind('tier', $tier)->bind('stats', $stats);

        $range = ORM::factory('affiliate_payout')->where(new Database_Expression(strtotime('est today')), 'BETWEEN', new Database_Expression('start AND end'))->find();

        if (Core::$camgirl)
        {
            /*
            if (time() <= strtotime('+3 months', Core::$camgirl->signup_date)) $tier = 1;
            if (time() > strtotime('+3 months', Core::$camgirl->signup_date) AND time() <= strtotime('+6 months', Core::$camgirl->signup_date)) $tier = 2;
            if (time() > strtotime('+6 months', Core::$camgirl->signup_date) AND empty(Core::$camgirl->referral_id))
            {
                $tier = 3;
            }
            else
            {
                if (empty($tier)) $tier = 2;
            }
            */

            $tier = Core::$camgirl->tier;

            $stats = ORM::factory('chat_tracker')->get_stats_daterange(Core::$camgirl, $range);
        }
    }
}