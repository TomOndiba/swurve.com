<?php defined('SYSPATH') or die('No direct script access.');

class Mailer_User extends Mailer {
    public $daily_limit = 4;
        
    public function test($args = NULL)
    {
        $to = $args[0];

        $this->to             = array($to => 'TestUser');
        $this->from         = array('support@swurve.com' => 'Swurve Support Team');
        $this->subject        = 'Test';
        $this->headers      = array('X-xsMailingId' => 'Test');
    }
    
    public function webcam($args = NULL)
    {
        $to = $args[0];

        if ($to->mailstatus > 0 OR $to->membership_id == 1)
        {
            $this->is_bad = TRUE;
            return;
        }

        $this->to             = array($to->email => $to->username);
        $this->from         = array('support@swurve.com' => 'Swurve Support Team');
        $this->subject        = 'Now Offering Live Chat!';
        $this->body_data     = array('to' => $to);
        $this->headers      = array('X-xsMailingId' => 'FeatWebcam');
    }

    public function resetpassconfirm($args = NULL)
    {
        $to = $args[0];

        if ($to->mailstatus > 0)
        {
            $this->is_bad = TRUE;
            return;
        }

        $this->to             = array($to->email => $to->username);
        $this->from         = array('support@swurve.com' => 'Swurve Support Team');
        $this->subject        = 'Your password has been reset';
        $this->body_data     = array('to' => $to);
        $this->headers      = array('X-xsMailingId' => 'ResetPassConfirm');
    }
    
    public function resetpass($args = NULL)
    {
        $to = $args[0];

        if ($to->mailstatus > 0)
        {
            $this->is_bad = TRUE;
            return;
        }

        $this->to             = array($to->email => $to->username);
        $this->from         = array('support@swurve.com' => 'Swurve Support Team');
        $this->subject        = 'Reset Password Request';
        $this->body_data     = array('to' => $to);
        $this->headers      = array('X-xsMailingId' => 'ResetPass');
    }
    
    public function hpoffer($args = NULL)
    {
        $to = $args[0];
        $password = $args[1];

        if ($to->mailstatus > 0 OR $to->membership_id == 1)
        {
            $this->is_bad = TRUE;
            return;
        }

        $this->to             = array($to->email => $to->username);
        $this->from         = array('support@swurve.com' => 'Swurve Support Team');
        $this->subject        = 'Claim your Free Swurve Account from Hot-Personals';
        $this->body_data     = array('to' => $to, 'password' => $password);
        $this->headers      = array('X-xsMailingId' => 'HPOffer');
    }
    
	public function activation($args = NULL)
	{
        if (count($args) == 0)
        {
            $to = Core::$user;
        }
        else
        {
            $to = $args[0];
        }

        if ($to->mailstatus > 0)
        {
            $this->is_bad = TRUE;
            return;
        }

		$this->to 			= array($to->email => $to->username);
		$this->from 		= array('support@swurve.com' => 'Swurve Support Team');
		$this->subject		= 'Welcome to Swurve';
		$this->body_data 	= array('to' => $to);
        $this->headers      = array('X-xsMailingId' => 'Activation');
	}

    public function flirt($args = NULL)
    {
        if (count($args) == 1)
        {
            $from = Core::$user;
            $to = $args[0];
        }
        else
        {
            $from = $args[0];
            $to = $args[1];
        }

        $to->notifications += 1;
        $to->save();

        if ($to->mailstatus > 0 OR $to->notifications > $this->daily_limit OR $to->membership_id == 1)
        {
            $this->is_bad = TRUE;
            return;
        }

        $this->to           = array($to->email => $to->username);
        $this->from         = array('support@swurve.com' => 'Swurve Support Team');
        $this->subject      = $from->username . ' is flirting with you';
        $this->body_data    = array('to' => $to, 'from' => $from);
        $this->headers      = array('X-xsMailingId' => 'Flirt');
    }

    public function email($args = NULL)
    {
        if (count($args) == 1)
        {
            $from = Core::$user;
            $to = $args[0];
        }
        else
        {
            $from = $args[0];
            $to = $args[1];
        }

        $to->notifications += 1;
        $to->save();

        if ($to->mailstatus > 0 OR $to->notifications > $this->daily_limit OR $to->membership_id == 1)
        {
            $this->is_bad = TRUE;
            return;
        }

        $this->to           = array($to->email => $to->username);
        $this->from         = array('support@swurve.com' => 'Swurve Support Team');
        $this->subject      = $from->username . ' has sent you a personal message';
        $this->body_data    = array('to' => $to, 'from' => $from);
        $this->headers      = array('X-xsMailingId' => 'Email');
    }
    
    public function request($args = NULL)
    {
        if (count($args) == 1)
        {
            $from = Core::$user;
            $to = $args[0];
        }
        else
        {
            $from = $args[0];
            $to = $args[1];
        }

        $to->notifications += 1;
        $to->save();

        if ($to->mailstatus > 0 OR $to->notifications > $this->daily_limit OR $to->membership_id == 1)
        {
            $this->is_bad = TRUE;
            return;
        }

        $this->to           = array($to->email => $to->username);
        $this->from         = array('support@swurve.com' => 'Swurve Support Team');
        $this->subject      = $from->username . ' wants to see more of you';
        $this->body_data    = array('to' => $to, 'from' => $from);
        $this->headers      = array('X-xsMailingId' => 'Request');
    }
    
    public function fave($args = NULL)
    {
        if (count($args) == 1)
        {
            $from = Core::$user;
            $to = $args[0];
        }
        else
        {
            $from = $args[0];
            $to = $args[1];
        }

        $to->notifications += 1;
        $to->save();

        if ($to->mailstatus > 0 OR $to->notifications > $this->daily_limit OR $to->membership_id == 1)
        {
            $this->is_bad = TRUE;
            return;
        }

        $this->to           = array($to->email => $to->username);
        $this->from         = array('support@swurve.com' => 'Swurve Support Team');
        $this->subject      = $from->username . ' has added you as a favorite';
        $this->body_data    = array('to' => $to, 'from' => $from);
        $this->headers      = array('X-xsMailingId' => 'Fave');
    }
    
    public function match($args = NULL)
    {
        if (count($args) == 1)
        {
            $from = Core::$user;
            $to = $args[0];
        }
        else
        {
            $from = $args[0];
            $to = $args[1];
        }

        $to->notifications += 1;
        $to->save();

        if ($to->mailstatus > 0 OR $to->notifications > $this->daily_limit OR $to->membership_id == 1)
        {
            $this->is_bad = TRUE;
            return;
        }

        $this->to           = array($to->email => $to->username);
        $this->from         = array('support@swurve.com' => 'Swurve Support Team');
        $this->subject      = $from->username . ' has confirmed you as a match';
        $this->body_data    = array('to' => $to, 'from' => $from);
        $this->headers      = array('X-xsMailingId' => 'Match');
    }
}
?>
