To ensure prompt notification delivery, please add support@swurve.com to your address book / contacts.

Reset Password Request!

A request to reset the password of the account <?= $to->username; ?> was issued online from the IP <?= $_SERVER['REMOTE_ADDR']; ?> 

Visit the following to confirm this request - <?= URL::base(TRUE, 'https') . 'user/resetpass/' . strtolower($to->username) . '/' . $to->password; ?> 

If you did not make this request simply ignore this email and your password will be left unchanged.

Much Love,

the Swurve Support Team

For account assistance please email support@swurve.com

As the hottest hook-up site for singles seeking casual relationships, Swurve provides users a unique connection building platform through which members can embrace their sexuality and explore their desires in a judgment free environment.

©2010 Swurve Media Corp | 1497 Main St | Suite #331 | Dunedin, FL 34698

To unsubscribe from these mailings visit <?= URL::base(TRUE, 'http') . 'unsubscribe/' . strtolower($to->email); ?> 
You were sent this email because an account was registered on <?= date('m/d/Y', $to->signup_date); ?> from <?= (empty($to->signup_ip)) ? $to->last_login_ip : $to->signup_ip; ?>.