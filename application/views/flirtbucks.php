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
                        <?php if ( ! Core::$camgirl): ?>
                        <div class="side-module" id="user-stats">
                            <h2><?= __('Program Features'); ?></h2>
                            <div style="background-color: #fff; width:100%; height: 100%; border-top: 2px solid #95999C;">
                                <div style="padding: 10px;">
                                    &bull; Set Your Own Hours<br />
                                    &bull; Work From The Comfort of Your Own Home<br />
                                    &bull; Get Paid by Check or Paypal<br />
                                    &bull; No Upfront Fees or Investment Required<br />
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if (Request::instance()->controller == 'account' AND Request::instance()->action == 'create'): ?>
                        <div class="side-module" id="user-stats">
                            <h2><?= __('Requirements'); ?></h2>
                            <div style="background-color: #fff; width:100%; height: 100%; border-top: 2px solid #95999C;">
                                <div style="padding: 10px;">
                                    <div style="margin: 0 auto; border: 1px solid #95999C; width: 200px; height: 200px;">
                                        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="200" height="200" id="swurve-flash">
                                            <param name="movie" value="/assets/img/flirtbucks/preview.swf" />
                                            <!--[if !IE]>-->
                                            <object type="application/x-shockwave-flash" data="/assets/img/flirtbucks/preview.swf" width="200" height="200">
                                            <!--<![endif]-->
                                                <a href="http://www.adobe.com/go/getflashplayer">
                                                    <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
                                                </a>
                                            <!--[if !IE]>-->
                                            </object>
                                            <!--<![endif]-->
                                        </object>
                                    </div>

                                    <p style="color: #D4106A; text-align: center; font-size: 12px;">Real FlirtBucks Chat Hostesses</p><br />

                                    <p>You MUST be over 18 years old and have a valid photo ID</p><br />
                                    <p>You will need access to a computer equipped with a webcam</p><br />
                                    <p>You must have a high speed (broadband / cable / dsl / fiber) internet connection</p>
                                </div>
                            </div>
                        </div>
                        <?php elseif (Core::$camgirl AND Core::$camgirl->status == 'Approved'): ?>
                        <div class="side-module" id="user-stats">
                            <h2><?= __('Pro Tips'); ?></h2>
                            <div style="background-color: #fff; width:100%; height: 100%; border-top: 2px solid #95999C;">
                                <div style="padding: 10px;">
                                    <p>
                                        <span style="font-size: 14px; font-weight: bold;">Turn Offline Connections into Online Connections</span><br />
                                        If you know when you will be online in the future dropping offline users an email is a great way of letting users know when you will be available to chat. By exchanging emails you can peek the interest of other members and essentially turn current offline connections into future online connections when you let them know when you plan to be online in the future.
                                    </p><br />
                                    <p>
                                        <span style="font-size: 14px; font-weight: bold;">Generate More Interest by Increasing Your Connections</span><br />
                                        Adding users as faves is a great way to increase your exposure within the community and let members know you're interested in communicaton. You can easily manage your connections from your playbook to keep in touch with your hookups, faves and see who has formed a crush and is expressing interest in you! 
                                    </p><br />
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="side-module" id="user-stats">
                            <h2><?= __('Program Details'); ?></h2>
                            <div style="background-color: #fff; width:100%; height: 100%; border-top: 2px solid #95999C;">
                                <div style="padding: 10px;">
                                    <p>Make Money While You Mingle- Become a Chat Hostess!</p><br />
                                    <p>As a FlirtBucks Chat Hostess YOU are in control. You choose who you talk to and you can control the conversation.</p><br />
                                    <p>FlirtBucks is a completely internal system. You don’t have to market yourself on outside websites or upsell conversation, just participate in our already active online community.</p><br />
                                    <p>With FlirtBucks you can be your own boss. No minimum hours. Work as little or as much as you want. Write your own checks!</p>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    
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