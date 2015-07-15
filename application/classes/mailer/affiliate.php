<?php defined('SYSPATH') or die('No direct script access.');

class Mailer_Affiliate extends Mailer {
    public function welcome($args = NULL)
    {
        $to = $args[0];

        $this->to           = array($to->email => $to->first_name . ' ' . $to->last_name);
        $this->from         = array('affiliates@swurve.com' => 'Swurve Affiliate Team');
        $this->subject      = 'Welcome to Swurve!';
        $this->body_data    = array('to' => $to);
        $this->headers      = array('X-xsMailingId' => 'AFLWelcome');
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