To ensure you never miss a match notification, please add support@swurve.com to your address book / contacts.

You've Made a Connection, <?= $to->username; ?> 

Congratulations! <?= $from->username; ?> has confirmed you as a match on Swurve! Remember, matches have special access priviledges to one another on the service.

Don't let <?= $from->username; ?> get away- Log in now to see what's happening with <?= $from->username; ?>, send <?= ($from->gender == 'Male') ? 'him' : 'her'; ?> an email, and most importantly- build off this connection!

Visit the following link to access your playbook now - <?= URL::base(TRUE, 'https') . 'auto/login/playbook?' . strtolower($to->username) . '/' . $to->password; ?> 

So what are you waiting for, <?= $to->username; ?>? Don't miss this chance to hook-up, Get your Swurve on!

Much Love,

the Swurve Support Team

For account assistance please email support@swurve.com

As the hottest hook-up site for singles seeking casual relationships, Swurve provides users a unique connection building platform through which members can embrace their sexuality and explore their desires in a judgment free environment.

©2010 Swurve Media Corp | 1497 Main St | Suite #331 | Dunedin, FL 34698

To unsubscribe from these mailings visit <?= URL::base(TRUE, 'http') . 'unsubscribe/' . strtolower($to->email); ?> 
You were sent this email because an account was registered on <?= date('m/d/Y', $to->signup_date); ?> from <?= (empty($to->signup_ip)) ? $to->last_login_ip : $to->signup_ip; ?>.