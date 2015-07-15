<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?= $head; ?>

        <script type="text/javascript" src="/assets/js/swfobject.js"></script>
        <script type="text/javascript">
            swfobject.registerObject("swurve-flash", "7.0.0", "/assets/img/splash/expressInstall.swf");
        </script>
        <script type="text/javascript" language="javascript">
            $(document).ready(function() {
                $('#splash-search').submit(function() {
                    $('#country_name').val($('#country option:selected').text());
                    $('#region_name').val($('#region option:selected').text());
                });
            });
        </script>
    </head>            
    <body>
        <div id="header">
            <?= $header; ?>
        </div>
        <div id="colmask">
            <div id="cam-cell">
                <div id="cam">
                    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="400" height="200" id="swurve-flash">
                        <param name="movie" value="/assets/img/splash/swurve-video.swf" />
                        <!--[if !IE]>-->
                        <object type="application/x-shockwave-flash" data="/assets/img/splash/swurve-video.swf" width="400" height="200">
                        <!--<![endif]-->
                            <a href="http://www.adobe.com/go/getflashplayer">
                                <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
                            </a>
                        <!--[if !IE]>-->
                        </object>
                        <!--<![endif]-->
                    </object>
                </div>
                
                <div id="cam-text">
                    <p><strong>SWURVE</strong> is the Hottest Hook-up site for singles seeking casual relationships.</p>
                    <p>Browse thousands of provocative profiles &amp; connect with <strong>REAL</strong> members Right Now.</p>
                    <p><?= HTML::anchor((Core::$user) ? 'home' : 'user/register', HTML::image('assets/img/button-join-free.png', array('alt' => 'Join For Free!')), array('style' => 'background-color: transparent;')); ?></p>
                </div>
            </div>
            <div id="quick-search-cell">
                <div id="title">Quick Search</div>
                <div id="quick-search">
                    <?= Form::open((Core::$user) ? 'user/search/results' : URL::site('user/register', 'https'), array('id' => 'splash-search')); ?>
                    <?= Form::hidden('from', 'splash'); ?>
                    <?= Form::hidden('country', NULL, array('id' => 'country_name')); ?>
                    <?= Form::hidden('region', NULL, array('id' => 'region_name')); ?>

                    Find sexy
                    <?php
                        $users_table = ORM::factory('user'); 
                    
                        echo Form::select((Core::$user) ? 'interested_in' : 'geo_interested_in', array('' => 'Select', 'Male' => 'Men', 'Female' => 'Women', 'Both' => 'Both'), NULL, array('id' => 'interested_in'));

                    ?> within <?= Form::select('miles', array('' => 'Select', '10' => '10', '25' => '25', '50' => '50', '75' => '75', '100' => '100'), NULL, array('id' => 'miles')); ?><br />
                    <span class="spacing">miles of</span><?= Form::select((Core::$user) ? 'country_id' : 'geo_country_id', $post['countries'], NULL, array('id' => 'country')); ?><br />
                    <span class="spacing">&nbsp;</span><?= Form::select((Core::$user) ? 'region_id' : 'geo_region_id', $post['regions'], (isset($post['region_id'])) ? $post['region_id'] : NULL, array('id' => 'region')); ?><br />
                    <span class="spacing">&nbsp;</span><?= Form::input('city', 'Enter A City', array('id' => 'city', 'disabled' => 'disabled')); ?><br />
                    <span class="spacing">&nbsp;</span><?= Form::input('search', 'search', array('type' => 'image', 'src' => '/assets/img/button-search.png')); ?>
                    <?= Form::close(); ?>
                </div>
            </div>
            <div class="clear"></div>
            <div id="geotext"><span class="pink">Sexy Singles Seeking to Hook Up in</span> <span class="blue"><?= $geolocation ?></span></div>
            <div id="geoprofiles">
                <ul id="profile">
                    <?php foreach($users as $user): ?>
                    <li>
                        <?= HTML::anchor((Core::$user) ? 'home' : 'user/register/' . $user->username, HTML::image('assets/photos/geo/both/' . strtolower($user->username) . '.png')); ?><br />
                        <h4><?= $user->username; ?></h4>
                        <small><?= Functions::get_age($user->birthdate); ?> / <?= $user->gender; ?> / <?= $user->orientation; ?></small>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
        <div id="footer-bg"></div>
        <div id="footer">
            <?= $footer; ?>
        </div>
    </body>
</html>