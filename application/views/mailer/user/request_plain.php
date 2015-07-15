To ensure you never miss a comunication notification, please add support@swurve.com to your address book / contacts.

Someone Wants To View <?= $to->username; ?> 

<?= $from->username; ?> wants to see some pics of you on Swurve! Remember, the more pics you have the more interest and attention you will receive. Log in now to view <?= ($from->gender == 'Male') ? 'his' : 'her'; ?> profile, add photos to your account, and most importantly- make a new connection!

Visit the following to access your control panel now - <?= URL::base(TRUE, 'https') . 'auto/login/user/control_panel?' . strtolower($to->username) . '/' . $to->password; ?> 

So what are you waiting for, <?= $to->username; ?>? Don't miss this chance to hook-up, Get your Swurve on!

Much Love,

the Swurve Support Team

For account assistance please email support@swurve.com

As the hottest hook-up site for singles seeking casual relationships, Swurve provides users a unique connection building platform through which members can embrace their sexuality and explore their desires in a judgment free environment.

©2010 Swurve Media Corp | 1497 Main St | Suite #331 | Dunedin, FL 34698

To unsubscribe from these mailings visit <?= URL::base(TRUE, 'http') . 'unsubscribe/' . strtolower($to->email); ?> 
You were sent this email because an account was registered on <?= date('m/d/Y', $to->signup_date); ?> from <?= (empty($to->signup_ip)) ? $to->last_login_ip : $to->signup_ip; ?>.