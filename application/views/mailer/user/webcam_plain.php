To ensure prompt notification delivery, please add support@swurve.com to your address book / contacts.

Now Offering Live Chat!

<?= $to->username; ?>,
 
We are proud to announce we have upgraded to our communication platform to now include live chat functionality. Now you can instantly connect with other users on Swurve, one on one, at the click of a mouse. 
 
Our new chat interface features both text as well as live streaming video. With our new features you can not only type but also see one another in real time if you choose to connect. 
 
Active users available for chat will display a flashing or highlighted chat icon near their user name or on their profile. As users that may be logged in and shown as online may not be actively using the site, only users who are presently engaging and interacting with the community will display an active chat icon. 
 
Have a webcam? Want to go cam 2 cam? Let other users know now by accessing the Edit Profile page ( <?= URL::base(TRUE, 'https') . 'auto/login/edit/profile?' . strtolower($to->username) . '/' . $to->password; ?> ) and turning on your webcam icon. The webcam icon lets other users know that you have a cam connected and are interested in streaming live video with other users.
 
Our state of the art one on one video chat brings a new level of intimacy never before available in the casual personals space. We hope you will enjoy this new premium feature and look forward to hearing your feedback.
 
Much Love,

the Swurve Support Team

For account assistance please email support@swurve.com

As the hottest hook-up site for singles seeking casual relationships, Swurve provides users a unique connection building platform through which members can embrace their sexuality and explore their desires in a judgment free environment.

©2010 Swurve Media Corp | 1497 Main St | Suite #331 | Dunedin, FL 34698

To unsubscribe from these mailings visit <?= URL::base(TRUE, 'http') . 'unsubscribe/' . strtolower($to->email); ?> 
You were sent this email because an account was registered on <?= date('m/d/Y', $to->signup_date); ?> from <?= (empty($to->signup_ip)) ? $to->last_login_ip : $to->signup_ip; ?>.