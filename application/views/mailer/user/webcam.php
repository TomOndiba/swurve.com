<html>
<body>
<table style="font-family: verdana; font-size: 9px; width: 580px; text-align: center;" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            To ensure prompt notification delivery, please add support@swurve.com to your address book / contacts.<br /><br />
            <?= HTML::image(URL::base(FALSE, 'http') . 'assets/img/emailheader.jpg'); ?><br />
        </td>
    </tr>    
    <tr>
        <td style="background-color: #F4EBDF; padding: 10px;">
            <table style="font-family: verdana; font-size: 12px; background-color: #F2F5F8; border: 2px solid #95999C; text-align: left;" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="padding: 20px;">
                        <h1 style="font-size: 24px;">Now Offering Live Chat!</h1>

                        <p><?= $to->username; ?>,</p>
                         
                        <p>We are proud to announce we have upgraded to our communication platform to now include live chat functionality. Now you can instantly connect with other users on Swurve, one on one, at the click of a mouse.</p> 
                         
                        <p>Our new chat interface features both text as well as live streaming video. With our new features you can not only type but also see one another in real time if you choose to connect.</p>
                         
                        <p>Active users available for chat will display a flashing or highlighted chat icon near their user name or on their profile. As users that may be logged in and shown as online may not be actively using the site, only users who are presently engaging and interacting with the community will display an active chat icon.</p> 
                         
                        <p>Have a webcam? Want to go cam 2 cam? Let other users know now by accessing the <?= HTML::anchor(URL::base(TRUE, 'https') . 'auto/login/edit/profile?' . strtolower($to->username) . '/' . $to->password, 'Edit Profile'); ?> page and turning on your webcam icon. The webcam icon lets other users know that you have a cam connected and are interested in streaming live video with other users.</p>
                         
                        <p>Our state of the art one on one video chat brings a new level of intimacy never before available in the casual personals space. We hope you will enjoy this new premium feature and look forward to hearing your feedback.</p>
                         
                        <p>Much Love,</p>

                        <p>the Swurve Support Team</p>

                        <p>For account assistance please email support@swurve.com</p>
                        
                        <p>As the hottest hook-up site for singles seeking casual relationships, Swurve provides users a unique connection building platform through which members can embrace their sexuality and explore their desires in a judgment free environment.</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>            
    <tr>
        <td style="font-size: 11px;">
            <br />&copy;<?= date('Y'); ?> <?= HTML::anchor(URL::base(TRUE, 'http'), 'Swurve'); ?> | <?= HTML::anchor(URL::base(TRUE, 'http') . 'privacy', 'Privacy Policy'); ?> | <?= HTML::anchor(URL::base(TRUE, 'http') . 'unsubscribe/' . strtolower($to->email), 'Unsubscribe'); ?> | <?= HTML::anchor(URL::base(TRUE, 'http') . 'terms', 'Terms of Service'); ?><br />
            Swurve Media Corp | 1497 Main St | Suite #331 | Dunedin, FL 34698
        </td>
    </tr>            
    <tr>
        <td>
            <br />You were sent this email because an account was registered on <?= date('m/d/Y', $to->signup_date); ?> from <?= (empty($to->signup_ip)) ? $to->last_login_ip : $to->signup_ip; ?>.
        </td>
    </tr>
</table>
</body>
</html>