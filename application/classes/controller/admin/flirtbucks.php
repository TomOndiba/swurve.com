<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Admin_Flirtbucks extends Controller_Master
{
    function before() 
    {
        parent::before();

        Functions::check_loggedin(TRUE, TRUE);
    }
    
    function action_pending()
    {
        $this->template->content = View::factory('admin/flirtbucks/pending')->bind('camgirls', $camgirls);
        
        if ($_GET)
        {
            $get = $_GET;
            
            if (isset($get['approve']))
            {
                $camgirl = ORM::factory('camgirl', $get['approve']);
                $camgirl->status = 'Approved';
                $camgirl->save();
                
                Mailer::factory('flirtbucks')->send_activated($camgirl);
                
                Notify::set('pass', 'Camgirl Approved');
                Request::instance()->redirect(Request::$referrer);
            }
            
            if (isset($get['decline']))
            {
                $camgirl = ORM::factory('camgirl', $get['decline']);
                $camgirl->status = 'Declined';
                $camgirl->save();
                
                Notify::set('pass', 'Camgirl Declined');
                Request::instance()->redirect(Request::$referrer);
            }
        }
        
        $camgirls = ORM::factory('camgirl')->where('status', '=' , 'Pending')->find_all();
    }
    
    
    function action_pendingpayouts()
    {
        $this->template->content = View::factory('admin/flirtbucks/pendingpayouts')->bind('camgirls', $camgirls);

        if ($_POST)
        {
            $post = $_POST;
            
            foreach($post['paid'] as $paidcamgirl)
            {
                $camgirl = ORM::factory('camgirl', array('id' => $paidcamgirl));
                
                if ($camgirl->loaded())
                {
                    $payment = ORM::factory('camgirl_payment');
                    $payment->camgirl_id = $camgirl;
                    $payment->date = time();
                    $payment->amount = $camgirl->pending_commission;
                    $payment->method = $camgirl->payment_method;
                    $payment->save();
                    
                    $camgirl->total_commission += $camgirl->pending_commission;
                    $camgirl->pending_commission = 0.00;
                    $camgirl->save();

                    Notify::set('pass', 'Camgirls total commissions have been updated with pending commissions and pending comissions reset to 0.00');
                    Request::instance()->redirect(Request::$referrer);
                }
            }
        }
        
        $camgirls = ORM::factory('camgirl')->where('pending_commission', '>=' , 50.00)->find_all();
    }
}