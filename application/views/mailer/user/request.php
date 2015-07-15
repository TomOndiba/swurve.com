<html>
<body>
<table style="font-family: verdana; font-size: 9px; width: 580px; text-align: center;" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            To ensure you never miss a comunication notification, please add support@swurve.com to your address book / contacts.<br /><br />
            <?= HTML::image(URL::base(FALSE, 'http') . 'assets/img/emailheader.jpg'); ?><br />
        </td>
    </tr>
    <tr>
        <td style="background-color: #F4EBDF; padding: 10px;">
            <table style="font-family: verdana; font-size: 12px; background-color: #F2F5F8; border: 2px solid #95999C; text-align: left;" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="padding: 17px;">
                        <h1 style="font-size: 16px;">Someone Wants To View <?= $to->username; ?></h1>

                        <p>
                            <table style="font-family: verdana; font-size: 12px;">
                                <tr>
                                    <td valign="middle"><?= HTML::image(URL::base(FALSE, 'http') . Content::factory($from->username)->get_photo($from->avatar, 'm'), array('alt' => 'Profile Avatar')); ?></td>
                                    <td style="padding-left: 15;" valign="middle"><?= $from->username; ?> wants to see some pics of you on Swurve! Remember, the more pics you have the more interest and attention you will receive. Log in now to view <?= ($from->gender == 'Male') ? 'his' : 'her'; ?> profile, add photos to your account, and most importantly- make a new connection!<br /><br />
                                    <center><h2 style="font-size: 16px;"><?= HTML::anchor(URL::base(TRUE, 'https') . 'auto/login/user/control_panel?' . strtolower($to->username) . '/' . $to->password, 'Click here to access your control panel now'); ?></h2></center></td>
                                </tr>
                            </table>
                        </p>

                        <p>So what are you waiting for, <?= $to->username; ?>? Don't miss this chance to hook-up, Get your Swurve on!</p>

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