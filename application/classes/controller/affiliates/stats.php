<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Affiliates_Stats extends Controller_Master
{
    public $template = 'affiliates';

    public function action_index()
    {
        $this->add_javascript(array(Functions::src_file('assets/js/jquery-ui.min.js')));
        $this->template->content = View::factory('affiliates/stats')->bind('data', $data)->bind('post', $post)->bind('graphOptions', $graphOptions)->bind('campaigns', $campaigns)->bind('subs', $subs);

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

            $data = Core::$affiliate->affiliate_stats->get_stats_daterange($post['date_from'], $post['date_to'], $post['subcampaign']);

            $this->template->content .= $this->get_graph($post['graph1'], $data);

            if (isset($post['graph1']) AND isset($post['graph2']) AND $post['graph1'] != $post['graph2'])
                $this->template->content .= $this->get_graph($post['graph2'], $data);

            if (isset($post['graph1']) AND isset($post['graph2']) AND isset($post['graph3']) AND $post['graph1'] != $post['graph3'] AND $post['graph2'] != $post['graph3'])
                $this->template->content .= $this->get_graph($post['graph3'], $data);
        }
        else
        {
            $data = Core::$affiliate->affiliate_stats->get_stats(14);

            $this->template->content .= View::factory('affiliates/graphs/default')->bind('data', $data);
        }
    }

    public function action_exportcsv()
    {
	    $this->add_javascript(array(Functions::src_file('assets/js/jquery-ui.min.js')));
        $this->template->content = View::factory('affiliates/exportcsv')->bind('range', $range);

        if (isset($_POST['submit']))
        {
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private",false);
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"export.csv\";" );
            header("Content-Transfer-Encoding: binary"); 
            //date_to
            //date_from

            $affiliate = Core::$affiliate;
            $from = $_POST['date_from'];
            $to = $_POST['date_to'];

            $swurve_data = $affiliate->affiliate_stats->get_stats_daterange('Swurve', $from, $to, 0);
            $kruze_data = $affiliate->affiliate_stats->get_stats_daterange('Kruze', $from, $to, 0);
            $rd_data = $affiliate->affiliate_stats->get_stats_daterange('Russian Desire', $from, $to, 0);

            echo "Date,Swurve Clicks,Swurve Registrants,Swurve Members,Swurve Earnings ,Kruze Clicks,Kruze Registrants,Kruze Members,Kruze Earnings ,Russian Desire Clicks,Russian Desire Registrants,Russian Desire Members,Russian Desire Earnings,Total Earnings\r\n";

            $swurve_data['Clicks'] = array_reverse($swurve_data['Clicks'], true);

            foreach($swurve_data['Clicks'] as $date => $value)
            {
                $daily_total = 0;

                echo "$date" . "," . $swurve_data['Clicks'][$date] . "," . $swurve_data['Registrations'][$date] . "," . $swurve_data['Memberships'][$date] . ",";

                $commission  = 0;

                if ($affiliate->program == 'PPS')
                {
                    $commission = Functions::calc_pps_commission(array($swurve_data['Memberships'][$date]), false);
                }
                elseif ($affiliate->program == 'Revshare')
                {
                    $commission = Functions::calc_revshare_commission(array($swurve_data['Memberships'][$date]), array($swurve_data['RebillingAmount'][$date]), array($swurve_data['MembershipAmount'][$date]), false);
                }
                elseif (strpos($affiliate->program, 'PPS') !== FALSE )
                {
                    $commission = Functions::calc_pps_flatrate_commission(array($swurve_data['Memberships'][$date]), $affiliate->program, false);
                }
                elseif (strpos($affiliate->program, 'Revshare') !== FALSE )
                {
                    $commission = Functions::calc_revshare_flatrate_commission(array($swurve_data['Memberships'][$date]), array($swurve_data['RebillingAmount'][$date]), array($swurve_data['MembershipAmount'][$date]), $affiliate->program, false);
                }

                $daily_total += $commission;

                echo '$' . number_format($commission, 2) . ",";

                echo $kruze_data['Clicks'][$date] . "," . $kruze_data['Registrations'][$date] . "," . $kruze_data['Memberships'][$date] . ",";

                $commission  = 0;

                if ($affiliate->program == 'PPS')
                {
                    $commission = Functions::calc_pps_commission(array($kruze_data['Memberships'][$date]), false);
                }
                elseif ($affiliate->program == 'Revshare')
                {
                    $commission = Functions::calc_revshare_commission(array($kruze_data['Memberships'][$date]), array($kruze_data['RebillingAmount'][$date]), array($kruze_data['MembershipAmount'][$date]), false);
                }
                elseif (strpos($affiliate->program, 'PPS') !== FALSE )
                {
                    $commission = Functions::calc_pps_flatrate_commission(array($kruze_data['Memberships'][$date]), $affiliate->program, false);
                }
                elseif (strpos($affiliate->program, 'Revshare') !== FALSE )
                {
                    $commission = Functions::calc_revshare_flatrate_commission(array($kruze_data['Memberships'][$date]), array($kruze_data['RebillingAmount'][$date]), array($kruze_data['MembershipAmount'][$date]), $affiliate->program, false);
                }

                $daily_total += $commission;

                echo '$' . number_format($commission, 2) . ",";

                echo $rd_data['Clicks'][$date] . "," . $rd_data['Registrations'][$date] . "," . $rd_data['Memberships'][$date] . ",";

                $commission  = 0;

                if ($affiliate->program == 'PPS')
                {
                    $commission = Functions::calc_pps_commission(array($rd_data['Memberships'][$date]), false);
                }
                elseif ($affiliate->program == 'Revshare')
                {
                    $commission = Functions::calc_revshare_commission(array($rd_data['Memberships'][$date]), array($rd_data['RebillingAmount'][$date]), array($rd_data['MembershipAmount'][$date]), false);
                }
                elseif (strpos($affiliate->program, 'PPS') !== FALSE )
                {
                    $commission = Functions::calc_pps_flatrate_commission(array($rd_data['Memberships'][$date]), $affiliate->program, false);
                }
                elseif (strpos($affiliate->program, 'Revshare') !== FALSE )
                {
                    $commission = Functions::calc_revshare_flatrate_commission(array($rd_data['Memberships'][$date]), array($rd_data['RebillingAmount'][$date]), array($rd_data['MembershipAmount'][$date]), $affiliate->program, false);
                }

                $daily_total += $commission;

                echo '$' . number_format($commission, 2) . ",";
                echo '$' . number_format($daily_total, 2) . "\r\n";
            }

            exit();
        }

        $range = ORM::factory('affiliate_payout')->where(new Database_Expression(strtotime('est today')), 'BETWEEN', new Database_Expression('start AND end'))->find();
    }

    public function action_csv($params = NULL)
    {
        try {
            list($email, $pass, $from, $to) = explode('/', $params);

            $affiliate = ORM::factory('affiliate', array('email' => $email));

            if ( ! $affiliate->loaded() OR $affiliate->password != Core::$auth->hash_password($pass, Core::$auth->find_salt($affiliate->password)))
            {
                echo 'Invalid Login Credentials';
                exit();
            }

            $swurve_data = $affiliate->affiliate_stats->get_stats_daterange('Swurve', $from, $to, 0);
            $kruze_data = $affiliate->affiliate_stats->get_stats_daterange('Kruze', $from, $to, 0);
            $rd_data = $affiliate->affiliate_stats->get_stats_daterange('Russian Desire', $from, $to, 0);

            echo "Date,Swurve Clicks,Swurve Registrants,Swurve Members,Swurve Earnings ,Kruze Clicks,Kruze Registrants,Kruze Members,Kruze Earnings ,Russian Desire Clicks,Russian Desire Registrants,Russian Desire Members,Russian Desire Earnings,Total Earnings\n";

            $swurve_data['Clicks'] = array_reverse($swurve_data['Clicks'], true);

            foreach($swurve_data['Clicks'] as $date => $value)
            {
                $daily_total = 0;

                echo "$date" . "," . $swurve_data['Clicks'][$date] . "," . $swurve_data['Registrations'][$date] . "," . $swurve_data['Memberships'][$date] . ",";

                $commission  = 0;

                if ($affiliate->program == 'PPS')
                {
                    $commission = Functions::calc_pps_commission(array($swurve_data['Memberships'][$date]), false);
                }
                elseif ($affiliate->program == 'Revshare')
                {
                    $commission = Functions::calc_revshare_commission(array($swurve_data['Memberships'][$date]), array($swurve_data['RebillingAmount'][$date]), array($swurve_data['MembershipAmount'][$date]), false);
                }
                elseif (strpos($affiliate->program, 'PPS') !== FALSE )
                {
                    $commission = Functions::calc_pps_flatrate_commission(array($swurve_data['Memberships'][$date]), $affiliate->program, false);
                }
                elseif (strpos($affiliate->program, 'Revshare') !== FALSE )
                {
                    $commission = Functions::calc_revshare_flatrate_commission(array($swurve_data['Memberships'][$date]), array($swurve_data['RebillingAmount'][$date]), array($swurve_data['MembershipAmount'][$date]), $affiliate->program, false);
                }

                $daily_total += $commission;

                echo '$' . number_format($commission, 2) . ",";

                echo $kruze_data['Clicks'][$date] . "," . $kruze_data['Registrations'][$date] . "," . $kruze_data['Memberships'][$date] . ",";

                $commission  = 0;

                if ($affiliate->program == 'PPS')
                {
                    $commission = Functions::calc_pps_commission(array($kruze_data['Memberships'][$date]), false);
                }
                elseif ($affiliate->program == 'Revshare')
                {
                    $commission = Functions::calc_revshare_commission(array($kruze_data['Memberships'][$date]), array($kruze_data['RebillingAmount'][$date]), array($kruze_data['MembershipAmount'][$date]), false);
                }
                elseif (strpos($affiliate->program, 'PPS') !== FALSE )
                {
                    $commission = Functions::calc_pps_flatrate_commission(array($kruze_data['Memberships'][$date]), $affiliate->program, false);
                }
                elseif (strpos($affiliate->program, 'Revshare') !== FALSE )
                {
                    $commission = Functions::calc_revshare_flatrate_commission(array($kruze_data['Memberships'][$date]), array($kruze_data['RebillingAmount'][$date]), array($kruze_data['MembershipAmount'][$date]), $affiliate->program, false);
                }

                $daily_total += $commission;

                echo '$' . number_format($commission, 2) . ",";

                echo $rd_data['Clicks'][$date] . "," . $rd_data['Registrations'][$date] . "," . $rd_data['Memberships'][$date] . ",";

                $commission  = 0;

                if ($affiliate->program == 'PPS')
                {
                    $commission = Functions::calc_pps_commission(array($rd_data['Memberships'][$date]), false);
                }
                elseif ($affiliate->program == 'Revshare')
                {
                    $commission = Functions::calc_revshare_commission(array($rd_data['Memberships'][$date]), array($rd_data['RebillingAmount'][$date]), array($rd_data['MembershipAmount'][$date]), false);
                }
                elseif (strpos($affiliate->program, 'PPS') !== FALSE )
                {
                    $commission = Functions::calc_pps_flatrate_commission(array($rd_data['Memberships'][$date]), $affiliate->program, false);
                }
                elseif (strpos($affiliate->program, 'Revshare') !== FALSE )
                {
                    $commission = Functions::calc_revshare_flatrate_commission(array($rd_data['Memberships'][$date]), array($rd_data['RebillingAmount'][$date]), array($rd_data['MembershipAmount'][$date]), $affiliate->program, false);
                }

                $daily_total += $commission;

                echo '$' . number_format($commission, 2) . ",";
                echo '$' . number_format($daily_total, 2) . "\n";
            }
        } catch (Exception $e) {
            echo "There was an error; most likely because you didn't pass all appropriate parameters (email/password/date_from/date_to) or pass date in correct format YYYY-MM-DD.";
        }

        exit();
    }

    public function get_graph($type, $data)
    {
        switch((isset($type)) ? $type : null)
        {
            case 'Total Clicks':
                return View::factory('affiliates/graphs/total-clicks')->bind('data', $data);
                break;

            case 'Total Registrants':
                return View::factory('affiliates/graphs/total-registrants')->bind('data', $data);
                break;

            case 'Total Members':
                return View::factory('affiliates/graphs/total-members')->bind('data', $data);
                break;

            case 'Clicks to Registrants Conversion %':
                return View::factory('affiliates/graphs/clicks-to-registrants-conversion')->bind('data', $data);
                break;

            case 'Clicks to Members Conversion %':
                return View::factory('affiliates/graphs/clicks-to-members-conversion')->bind('data', $data);
                break;

            case 'Registrants to Members Conversion %':
                return View::factory('affiliates/graphs/registrants-to-members-conversion')->bind('data', $data);
                break;

            default:
                return null;
                break;
        }
    }
}
