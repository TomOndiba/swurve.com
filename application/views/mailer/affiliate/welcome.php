<table style="font-family: verdana; font-size: 9px; width: 580px; text-align: center;" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            To ensure prompt notification delivery, please add affiliates@swurve.com to your address book / contacts.<br /><br />
            <?= HTML::image(URL::base(FALSE, 'http') . 'assets/img/emailheader.jpg'); ?><br />
        </td>
    </tr>    
    <tr>
        <td style="background-color: #F4EBDF; padding: 10px;">
            <table style="font-family: verdana; font-size: 12px; background-color: #F2F5F8; border: 2px solid #95999C; text-align: left;" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="padding: 20px;">
                        <h1 style="font-size: 24px;">Welcome to Swurve!</h1>

                        <p><h2 style="font-size: 16px;"><?= $to->first_name . ' ' . $to->last_name; ?></h2></p>

                        <p>Your affiliate account has been activated. You can now gain access to the Hottest new marketing tools and start making money with the Freshest new Casual Personals Brand!</p>

                        <p><span style="display: inline-block; margin-bottom: 4px; font-weight: bold; text-decoration: underline;">Your Login Details</span><br />
                        Login: <strong><?= $to->email; ?></strong><br />
                        Password:  <span style="font-size: 11px; font-style: italic;">(Your password has been encrypted for your protection, if you forgot it at any time you may <?= HTML::anchor(URL::base(TRUE, 'https') . 'affiliates/account/resetpass/' . strtolower($to->email), 'reset'); ?> it and have another one sent to your registered email address)</span></p>

                        <p>We appreciate your support and are firmly committed to providing you with the highest quality traffic management tools, choice incentives and superior account assistance.</p>

                        <p>What are you waiting for? The future is yours. Invite the world to get their Swurve on!</p>

                        <p>Much Love,</p>

                        <p>the Swurve Affiliate Support Team</p>

                        <p>For account assistance please email affiliates@swurve.com</p>
                        
                        <p>As the hottest hook-up site for singles seeking casual relationships, Swurve provides users a unique connection building platform through which members can embrace their sexuality and explore their desires in a judgment free environment.</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>            
    <tr>
        <td style="font-size: 11px;">
            <br />&copy;<?= date('Y'); ?> <?= HTML::anchor(URL::base(TRUE, 'http'), 'Swurve'); ?> | <?= HTML::anchor(URL::base(TRUE, 'http') . 'affiliates', 'Affiliates'); ?> | <?= HTML::anchor(URL::base(TRUE, 'http') . 'privacy', 'Privacy Policy'); ?> | <?= HTML::anchor(URL::base(TRUE, 'http') . 'affiliates/account/unsubscribe/' . strtolower($to->email), 'Unsubscribe'); ?> | <?= HTML::anchor(URL::base(TRUE, 'http') . 'terms', 'Terms of Service'); ?><br />
            Swurve Media Corp | 1497 Main St | Suite #331 | Dunedin, FL 34698
        </td>
    </tr>            
    <tr>
        <td>
            <br />You were sent this email because an account was registered on <?= date('m/d/Y', $to->signup_date); ?> from <?= $to->signup_ip; ?>.
        </td>
    </tr>
</table>        