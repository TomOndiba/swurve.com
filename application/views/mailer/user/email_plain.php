To ensure you never miss an email notification, please add support@swurve.com to your address book / contacts.

You Have a Personal Message, <?= $to->username; ?> 

<?= $from->username; ?> has sent you an email on Swurve! Log in now to view <?= ($from->gender == 'Male') ? 'his' : 'her'; ?> profile, read what <?= ($from->gender == 'Male') ? 'he' : 'she'; ?> has to say, and most importantly- communicate back!

Visit the following to access your inbox now - <?= URL::base(TRUE, 'https') . 'auto/login/mailbox?' . strtolower($to->username) . '/' . $to->password; ?> 

So what are you waiting for, OmicroN? Don't miss this chance to hook-up, Get your Swurve on!

Much Love,

the Swurve Support Team

For account assistance please email support@swurve.com

As the hottest hook-up site for singles seeking casual relationships, Swurve provides users a unique connection building platform through which members can embrace their sexuality and explore their desires in a judgment free environment.

©2010 Swurve Media Corp | 1497 Main St | Suite #331 | Dunedin, FL 34698

To unsubscribe from these mailings visit <?= URL::base(TRUE, 'http') . 'unsubscribe/' . strtolower($to->email); ?> 
You were sent this email because an account was registered on <?= date('m/d/Y', $to->signup_date); ?> from <?= (empty($to->signup_ip)) ? $to->last_login_ip : $to->signup_ip; ?>.