<table style="font-family: verdana; font-size: 9px; width: 580px; text-align: center;" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            To ensure prompt notification delivery, please add support@swurve.com to your address book / contacts.<br /><br />
            <?= HTML::image(URL::base(FALSE, 'http') . 'assets/img/hpemailheader.jpg'); ?><br />
        </td>
    </tr>    
    <tr>
        <td style="background-color: #F4EBDF; padding: 10px;">
            <table style="font-family: verdana; font-size: 12px; background-color: #F2F5F8; border: 2px solid #95999C; text-align: left;" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="padding: 20px;">
                        <h1 style="font-size: 24px;"><?= $to->username; ?>,</h1>

                        <p>As a member of Hot-Personals we are pleased to provide you with this exciting new offer:<br />A complimentary standard membership to Swurve.com!</p>
                        
                        <p>View Photo Ads of Local Sexy Singles Now.</p>
                        
                        <p><h2 style="font-size: 16px;"><?= HTML::anchor(URL::base(TRUE, 'https') . 'activate/' . strtolower($to->username) . '/' . $to->password, 'Click Here to Claim Your Free Account'); ?></h2></p>

                        <p>No Credit Card Required. Flirt 100% free!</p>

                        <p><span style="display: inline-block; margin-bottom: 4px; font-weight: bold; text-decoration: underline;">Your Login Details</span><br />
                        User Name: <strong><?= $to->username; ?></strong><br />
                        Password: <strong><?= $password; ?></strong></span></p>

                        <p>Swurve.com is a Revolutionary new Casual Dating community where you can Hookup with the Hottest Singles on the web.  Get casual, be Naughty and find a Fling searching our fun and flirty hot photo personal ads.</p>

                        <p>What are you waiting for? Get your Swurve on!</p>

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