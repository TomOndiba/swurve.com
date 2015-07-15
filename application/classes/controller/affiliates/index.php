<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Affiliates_Index extends Controller_Master
{
    public $template = 'affiliates';

    function trim_array(&$value, $key) {
        $value = str_replace('"', '', $value);
    }

    public function action_test()
    {
        //Mailer::factory('affiliate')->send_welcome(Core::$affiliate);
        echo 'test1';
        Stats::add_click('1yasd', 0);
        echo 'test2';
    }

    public function action_index()
    {
        $this->template->content = View::factory('affiliates/index');

        if (Core::$affiliate)
        {
            $site = (isset($_POST['site']) AND ! empty($_POST['site'])) ? $_POST['site'] : null;

            $this->template->content = View::factory('affiliates/home')->bind('data', $data)->bind('totals', $totals)->bind('commission', $commission);

            $range = ORM::factory('affiliate_payout')->where(new Database_Expression(strtotime('est today')), 'BETWEEN', new Database_Expression('start AND end'))->find();

            //print_r($range);
            //sexit();
            $totals = Core::$affiliate->affiliate_stats->get_totals($site);
            $data = Core::$affiliate->affiliate_stats->get_stats_daterange($site, $range);

            $commission = Core::$affiliate->pending_commission;

            if (Core::$affiliate->program == 'PPS')
            {
                $commission += Functions::calc_pps_commission($data['Memberships']);
            }
            elseif (Core::$affiliate->program == 'Revshare')
            {
                $commission += Functions::calc_revshare_commission($data['Memberships'], $data['RebillingAmount'], $data['MembershipAmount']);
            }
            elseif (strpos(Core::$affiliate->program, 'PPS') !== FALSE )
            {
                $commission += Functions::calc_pps_flatrate_commission($data['Memberships'], Core::$affiliate->program);
            }
            elseif (strpos(Core::$affiliate->program, 'Revshare') !== FALSE )
            {
                $commission += Functions::calc_revshare_flatrate_commission($data['Memberships'], $data['RebillingAmount'], $data['MembershipAmount'], Core::$affiliate->program);
            }

            $brokers = ORM::factory('affiliate')->where('referral_id', '=', Core::$affiliate)->find_all();

            foreach($brokers as $broker)
            {
                $broker_commission = 0.00;
                $data2 = $broker->affiliate_stats->get_stats_daterange($site, $range);


                if ($broker->program == 'PPS')
                {
                    $broker_commission += Functions::calc_pps_commission($data2['Memberships']);
                }
                elseif ($broker->program == 'Revshare')
                {
                    $broker_commission += Functions::calc_revshare_commission($data2['Memberships'], $data2['RebillingAmount'], $data2['MembershipAmount']);
                }
                elseif (strpos($broker->program, 'PPS') !== FALSE )
                {
                    $broker_commission += Functions::calc_pps_flatrate_commission($data2['Memberships'], $broker->program);
                }
                elseif (strpos($broker->program, 'Revshare') !== FALSE )
                {
                    $broker_commission += Functions::calc_revshare_flatrate_commission($data2['Memberships'], $data2['RebillingAmount'], $data2['MembershipAmount'], $broker->program);
                }

                $commission += number_format($broker_commission * .10, 2);
            }
        }
    }

    public function action_register()
    {
        $this->template->content = View::factory('affiliates/forms/register');
    }

    public function action_news($article)
    {
        $article = ORM::factory('news', $article);

        if ($article->loaded()){
            $this->template->head->meta_title = 'News Article';
            $this->template->content = View::factory('affiliates/news')->bind('article', $article);
        }
        else
        {
            Request::instance()->redirect('home');
        }
    }
}