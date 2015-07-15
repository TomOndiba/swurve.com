<html>
<body>
<table style="font-family: verdana; font-size: 9px; width: 580px; text-align: center;" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            To ensure prompt notification delivery, please add support@flirtbucks.net to your address book / contacts.<br /><br />
            <?= HTML::image(URL::base(FALSE, 'http') . 'assets/img/flirteheader.gif'); ?><br />
        </td>
    </tr>    
    <tr>
        <td style="background-color: #F4EBDF; padding: 10px;">
            <table style="font-family: verdana; font-size: 12px; background-color: #F2F5F8; border: 2px solid #95999C; text-align: left;" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="padding: 20px;">
                        <h1 style="font-size: 24px;">Thank you for applying to Flirt Bucks!</h1>

                        <p>To complete your hostess application please respond to this email with an attached copy of a state issued ID to verify your identity.</p>

                        <p>This information may also be faxed to 1-727-330-7225. To speed up the process please be sure to include your email address with the fax transmission.</p>

                        <p>Once we have received this information your application will be complete and you will hear from our company shortly reguarding your acceptance to the program.</p>

                        <p>We hope you'll enjoy working with us. Your hostess account is active and you now have access to all the tools you need to start making real money right now. If you have any questions feel free to contact support by email at support@flirtbucks.net</p>

                        <p>Thanks Again and Good Luck!</p>

                        <p>FlirtBucks Support</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>            
    <tr>
        <td style="font-size: 11px;">
            <br />&copy;<?= date('Y'); ?> <?= HTML::anchor(URL::base(TRUE, 'http'), 'Flirtbucks- a SMC property'); ?> | <?= HTML::anchor(URL::base(TRUE, 'http') . 'privacy', 'Privacy Policy'); ?> | <?= HTML::anchor(URL::base(TRUE, 'http') . 'terms', 'Terms of Service'); ?><br />
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