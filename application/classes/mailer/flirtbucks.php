<?php defined('SYSPATH') or die('No direct script access.');

class Mailer_Flirtbucks extends Mailer {
    public function activated($args = NULL)
    {
        $to = $args[0];

        $this->to           = array($to->email => $to->first_name . ' ' . $to->last_name);
        $this->from         = array('support@flirtbucks.net' => 'Flirtbucks Support');
        $this->subject      = 'Your Flirtbucks Account Has Been Activated';
        $this->body_data    = array('to' => $to);
        $this->headers      = array('X-xsMailingId' => 'FBActivated');
    }
    
    public function welcome($args = NULL)
    {
        $to = $args[0];

        $this->to           = array($to->email => $to->first_name . ' ' . $to->last_name);
        $this->from         = array('support@flirtbucks.net' => 'Flirtbucks Support');
        $this->subject      = 'Please Complete Your FlirtBucks Application!';
        $this->body_data    = array('to' => $to);
        $this->headers      = array('X-xsMailingId' => 'FBWelcome');
    }
    
    public function resetpassconfirm($args = NULL)
    {
        $to = $args[0];

        if ($to->mailstatus > 0)
        {
            $this->is_bad = TRUE;
            return;
        }

        $this->to             = array($to->email => $to->first_name . ' ' . $to->last_name);
        $this->from         = array('affiliates@swurve.com' => 'Swurve Affiliate Team');
        $this->subject        = 'Your password has been reset';
        $this->body_data     = array('to' => $to);
        $this->headers      = array('X-xsMailingId' => 'AFLResetPassConfirm');
    }
    
    public function resetpass($args = NULL)
    {
        $to = $args[0];

        if ($to->mailstatus > 0)
        {
            $this->is_bad = TRUE;
            return;
        }

        $this->to             = array($to->email => $to->first_name . ' ' . $to->last_name);
        $this->from         = array('affiliates@swurve.com' => 'Swurve Affiliate Team');
        $this->subject        = 'Reset Password Request';
        $this->body_data     = array('to' => $to);
        $this->headers      = array('X-xsMailingId' => 'AFLResetPass');
    }
}
?>