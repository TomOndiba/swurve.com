To ensure prompt notification delivery, please add support@swurve.com to your address book / contacts.

Welcome to Swurve!

Visit the following to activate your account - <?= URL::base(TRUE, 'https') . 'activate/' . strtolower($to->username) . '/' . $to->password; ?> 

Activate NOW and gain access to the HOTTEST hook-up site for singles seeking casual relationships.

Your Login Details
User Name: <?= $to->username; ?> 
Password: (Your password has been encrypted for your protection, if you forgot it at any time you may reset it and have another one sent to your registered email address)

Your account activation is your key to connecting with new and exciting members in your area. Get online and start viewing thousands of steamy photo profiles from active members seeking someone like you, right now!

What are you waiting for? Get your Swurve on!

Much Love,

the Swurve Support Team

For account assistance please email support@swurve.com

As the hottest hook-up site for singles seeking casual relationships, Swurve provides users a unique connection building platform through which members can embrace their sexuality and explore their desires in a judgment free environment.

©2010 Swurve Media Corp | 1497 Main St | Suite #331 | Dunedin, FL 34698

To unsubscribe from these mailings visit <?= URL::base(TRUE, 'http') . 'unsubscribe/' . strtolower($to->email); ?> 
You were sent this email because an account was registered on <?= date('m/d/Y', $to->signup_date); ?> from <?= (empty($to->signup_ip)) ? $to->last_login_ip : $to->signup_ip; ?>.