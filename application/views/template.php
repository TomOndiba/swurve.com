<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?= $head; ?>
    </head>            
    <body>
        <div id="header">
            <?= $header; ?>
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
                        <?php if (array_search(Request::instance()->route, Route::all()) == 'admin'): ?>
                        <p style="float: right"><?= HTML::anchor('admin', 'Back to Admin Home'); ?></p>
                        <?php endif; ?>
                                <?= $content ?>
                            </div>
                        </div>
                    </div>
                    <div id="col2">
                        <!-- Column 2 start -->
                        <?= $quick_search; ?>
                        <?= $online_now; ?>
                        <!-- Column 2 end -->
                    </div>
                    <div id="col3">
                        <!-- Column 3 start -->
                        <?= $user_stats; ?>
                        <?= $profile_views; ?>
                           <!-- Column 3 end -->
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