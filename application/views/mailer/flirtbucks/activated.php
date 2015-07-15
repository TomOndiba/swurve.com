<html>
<body>
<table style="font-family: verdana; font-size: 9px; width: 580px; text-align: center;" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            To ensure prompt notification delivery, please add support@flirtbucks.net to your address book / contacts.<br /><br />
            <?= HTML::image('http://www.flirtbucks.net/assets/img/flirteheader.gif'); ?><br />
        </td>
    </tr>    
    <tr>
        <td style="background-color: #F4EBDF; padding: 10px;">
            <table style="font-family: verdana; font-size: 12px; background-color: #F2F5F8; border: 2px solid #95999C; text-align: left;" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="padding: 20px;">
                        <h1 style="font-size: 24px;">Hello <?= $to->first_name; ?>,</h1>

                        <p>Thanks for signing up to FlirtBucks! Your chat hostess account has been approved.</p>

                        <p>To begin making money, login at the following URL:  http://www.flirtbucks.net</p>

                        <p><span style="display: inline-block; margin-bottom: 4px; font-weight: bold; text-decoration: underline;">Here are your login credentials for your records:</span><br />
                        User Name: <strong><?= $to->email; ?></strong><br />
                        Password:  <span style="font-size: 11px; font-style: italic;">(Your password has been encrypted for your protection)</span></p>

                        <p>Once you have signed in you will be able to view your stats, craft your chat hostess profile and begin generating revenue through the program.</p>

                        <p>We hope you'll enjoy working with us. Your hostess account is active and you now have access to all the tools you need to start making real money right now. If you have any questions feel free to contact support by email at support@flirtbucks.net</p>

                        <p>Thanks,</p>

                        <p>FlirtBucks Support</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>            
    <tr>
        <td style="font-size: 11px;">
            <br />&copy;<?= date('Y'); ?> <?= HTML::anchor('http://www.flirtbucks.net/', 'Flirtbucks- a SMC property'); ?> | <?= HTML::anchor('http://www.flirtbucks.net/privacy', 'Privacy Policy'); ?> | <?= HTML::anchor('http://www.flirtbucks.net/terms', 'Terms of Service'); ?><br />
            Flirtbucks | 1497 Main St | Suite #331 | Dunedin, FL 34698
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