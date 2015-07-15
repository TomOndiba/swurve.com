<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<style>
    .jTscroller a {
        height: 150px;
        border-width: 1px !important;
    }

    .jTscroller a:hover {
        border-color: #95999C !important;
        border-width: 1px;
    }
</style>
<div id="panel">
    <ul id="tabs">
        <li id="user">
            <h1><?= $username; ?>'s Photo</h1>
            <h3>Return to <a href="<?= Request::$referrer; ?>">previous page</a>...</h3>
        </li>
        <li><h2><?= HTML::anchor('profile/' . strtolower($username), 'Profile'); ?></h2></li>
        <li><h2>Recent Activity</h2></li>
        <li id="filler"></li>
    </ul>
    <div class="clear"></div>
    <div id="content">
        <center>
        <?php if ($allow_fullsize): ?>
        <?= HTML::anchor(Request::instance()->uri() . '-1', HTML::image(Content::factory($username)->get_photo($photo, 'f', (Core::$user->username == $username) ? TRUE : FALSE, (Core::$user->membership->type == 'Admin') ? TRUE : FALSE)), array('target' => '_blank')); ?>
        <?php else: ?>
        <?= HTML::image(Content::factory($username)->get_photo($photo, 'f', (Core::$user->username == $username) ? TRUE : FALSE, (Core::$user->membership->type == 'Admin') ? TRUE : FALSE)); ?>
        <?php endif; ?>
        </center>
    </div>
    <div class="clear"></div><br />

    <div id="allphotos" style="width: 810px; height: 170px; margin-top: -15px; border: 0;" class="jThumbnailScroller">
        <div class="jTscrollerContainer" style="height: 170px;">
            <div class="jTscroller">
        <?php $current_photo = 0; $count = 0; foreach(ORM::factory('user', array('username' => $username))->photos->where('approved', '<>' , 'No')->and_where('hide', '=', 'No')->find_all() as $pho): $count++; ?>
            <?= HTML::anchor('photo/' . $username . '/' . $pho->uniqueid, HTML::image(Content::factory($username)->get_photo($pho->uniqueid, 'l'), $photo == $pho->uniqueid ?  array('style' => 'border: 3px solid #28619C !important;') : null )); ?>
            <?php if ($photo == $pho->uniqueid) $current_photo = $count; ?>
        <?php endforeach; ?>
            </div>
        </div>
    </div>
    <br />
</div>
<script>
    <?php if ($current_photo > 3): ?>
    $('.jTscroller').css('left', '-<?= 163 * ($current_photo - 3); ?>px');
    <?php endif; ?>

    $(document).ready(function() {
        window.onload = function(){
            $("#allphotos").thumbnailScroller({
                scrollerType:"hoverAccelerate",
                scrollerOrientation:"horizontal",
                scrollSpeed:1,
                scrollEasing:"easeOutCirc",
                scrollEasingAmount:600,
                acceleration:1,
                scrollSpeed:800,
                noScrollCenterSpace:90,
                autoScrolling:0,
                autoScrollingSpeed:2000,
                autoScrollingEasing:"easeInOutQuad",
                autoScrollingDelay:500
            });
        };
    });
</script>
<script type="text/javascript" src="/assets/js/jquery.thumbnailScroller.js"></script>