<?php
    $is_mobile = false;

    if (isset($_GET['force']))
    {
        if ($_GET['force'] == 'mobile')
        {
            $is_mobile = true;
        }
    }
    elseif (Functions::is_mobile())
    {
        $is_mobile = true;
    }

    if (Core::$user AND Core::$user->username == 'Admin')
    {
?>
<style>
    #admin-alert {
        position: fixed;
        top: 0px;
        background-color: red;
        color: white;
        font-size: 20px;
        font-weight: bold;
        margin: 0 auto;
        text-align: center;
        width: 400px;
        margin-left: 400px;
        padding: 20px;
        border: 2px solid black;
        border-top: none;
        border-radius: 0 0 15px 15px;
    }
</style>
<div id="admin-alert">
    You are logged in as ADMIN
</div>
<?php
    }
?>
            <p>
                <!--a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a><br /--><br />
                <?php if ($is_mobile): ?>Switch To <?= HTML::anchor('/?force=mobile', 'Mobile View'); ?> &#8226; 
				<?php endif; ?><?= HTML::anchor('affiliates', 'Affiliates'); ?> &#8226; 
				<?= HTML::anchor('support', 'Support'); ?> &#8226; 
				<?= HTML::anchor('terms', 'Terms'); ?> &#8226; 
				<?= HTML::anchor('privacy', 'Privacy'); ?> &#8226;		
				<?= HTML::anchor('2257', '2257'); ?><br />
     
                Copyright &copy; <?= date('Y'); ?> Swurve Media Corp<span id="newchatrequest"></span>
            </p>
            <?php if (Core::$user AND 1 == 2): ?>
            <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="1" height="1" id="CBCookie"><param name="allowScriptAccess" value="always" /><param name="movie" value="/assets/img/CB_Cookie.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffcc00" /><embed src="/assets/img/CB_Cookie.swf" quality="high" bgcolor="#ffcc00" width="1" height="1" name="CBCookie" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>
            <?php endif; ?>