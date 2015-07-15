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
                                <?= $content ?>
                            </div>
                        </div>
                    </div>
                    <div id="col2">
                        <?php if ( ! Core::$affiliate): ?>
                        <div class="side-module" id="user-stats">
                            <h2><?= __('Program Features'); ?></h2>
                            <div style="background-color: #f2f5f8; width:100%; height: 100%; border-top: 2px solid #95999C;">
                                <div style="padding: 10px;">
                                    &bull; Webmaster Rewards Program<br />
                                    &bull; Geotargeted Ad Tools<br />
                                    &bull; Safe for Mainstream &amp; Adult<br />
                                    &bull; Fresh, Cutting Edge Creatives<br />
                                    &bull; Real Time Stats Reporting<br />
                                    &bull; Campaign and Sub ID tracking<br />
                                    &bull; Quick and Easy Copy Paste Code<br />
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="side-module" id="user-stats">
                            <h2><?= __('Swurve News'); ?></h2>
                            <div style="background-color: #f2f5f8; width:100%; height: 100%; border-top: 2px solid #95999C;">
                                <?= $news ?>
                            </div>
                        </div>
                    
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