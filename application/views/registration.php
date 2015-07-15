<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?= $head; ?>
    </head>
    <body>
        <div id="header">
            <p>
            <?php if ($user = Core::$user): ?>
                Welcome <?= $user->username; ?>! | <?= HTML::anchor('user/logout', 'Logout'); ?>
            <?php else: ?>
                Already Registered? <?= HTML::anchor('user/login', 'Login'); ?>
            <?php endif; ?>
            </p>
            <!--p>Choose language:
            <a href="?= URL::site('/' . $current_uri); ?>">English</a> -
            <a href="?= URL::site('/es/' . $current_uri); ?>">Español</a></p-->

            <div style="position: relative; height: 95px; z-index: -1;">
            <div style="position: absolute; margin-top: -53px; width: 518px; height: 317px; background: URL('/assets/img/headderlogo.png');"></div>
            <?= HTML::image('assets/img/headderpeople.png', array('alt' => '', 'style' => 'float: right; margin-right: 150px; margin-top: -15px;')); ?>
            </div>
            <div id="menu" style="clear: both;">
                <ul id="menu-options">
                    <?php if (Request::instance()->action == 'articles' OR Request::instance()->action == 'articles2' OR Request::instance()->action == 'articles3'): ?>
                    <li style="color: #000066; text-transform: none;"><?= HTML::anchor('http://www.swurve.com', 'HookUp Site'); ?></li>
                    <?php else: ?>
                    <li style="color: #000066; text-transform: none;">Join Swurve FREE and Start Interacting with REAL Users Right Now</li>
                    <?php endif; ?>
                    <li class="register" style="color: #000066; text-transform: none; font-size: 20px;">Get Your SWURVE On!</li>
                </ul>
            </div>
        </div>
        <div id="colmask">
            <div id="colmid">
                <div id="colright">
                    <div id="col1wrap">
                        <div id="col1pad">
                            <div id="col1">
                        <?php if ( ! is_null(Core::$flash_data)): ?>
                            <?php foreach(Core::$flash_data as $status => $msg): ?>
                                <div class="<?= $status; ?>"><?= $msg; ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                                <?= $content; ?>
                            </div>
                        </div>
                    </div>
                    <div id="col2">
                        <?= $geocontent; ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer-bg"></div>
        <div id="footer">
            <?= $footer; ?>
        </div>
    </body>
</html>