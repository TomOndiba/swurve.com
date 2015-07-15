<?php defined('SYSPATH') or die('No direct script access.'); ?>
<script language="javascript" type="text/javascript">
    $(document).ready(function () {
        $('.myrating').rating({
            split: 4
        });
    });
</script>

<?php if (Core::$user->photos->where('hide', '=', 'No')->find_all()->count() == 0): ?>
<div class="alert"><?=HTML::image('assets/img/icons/alert.png', array('style' => 'vertical-align: middle;')); ?> Your Account Is Missing Photos! Be Seen- <?= HTML::anchor('user/control_panel/upload_photo', 'Upload Photos'); ?> Now!</div><br />
<?php endif; ?>

<h2>Shout</h2>
<div id="shout">
    <?= HTML::image('assets/img/icons/megaphone.png', array('style' => 'float: left; margin-right: 10px;')); ?>
    <?= Form::open(NULL); ?>
    <?= Form::input('status', NULL, array('style' => 'width: 300px; vertical-align: middle;', 'class' => 'text')); ?>
    <?= Form::submit('submit', 'Send', array('style' => 'vertical-align: middle;')); ?><br />
    <small>Shouts go out over your activity stream and are viewable by your matches only.<br />
    Wanna reach more members? Send a broadcast</small>
    <?= Form::close(); ?>
</div>
<br />

<h2>Manage</h2>
<div id="manage">
    <h3><?= Core::$user->username; ?></h3>
    <hr style="margin-top: -15px;" />
    <div class="left">
    <?php if (Core::$user->avatar->loaded()): ?>
        <?= HTML::anchor('photo/' . Core::$user->username . '/' . Core::$user->avatar->uniqueid, HTML::image(Content::factory(Core::$user->username)->get_photo(Core::$user->avatar, 'l'), array('style' => 'border: 1px solid #dedede;'))); ?>
    <?php else: ?>
        <?= HTML::image(Content::factory(Core::$user->username)->get_photo(Core::$user->avatar, 'l'), array('style' => 'border: 1px solid #dedede;')); ?>
    <?php endif; ?>
        <?= HTML::anchor('user/control_panel/upload_photo', 'Edit Your Profile Pic'); ?><br />

        <span style="font-size: 11px;">Stealth Mode: <?= Core::$user->stealth; ?> [<?= HTML::anchor('user/stealth/' . ((Core::$user->stealth == 'Off') ? 'On' : 'Off'), 'Turn ' . ((Core::$user->stealth == 'Off') ? 'On' : 'Off')); ?>]<br /><br /></span>

        <div id="rate">
            Your Rating:<br />

            <div style="width: 100px; margin-top: 5px; margin-left: 19px;">
                <input class="myrating" type="radio" name="profile" value="0.25" disabled="disabled" <?= ((float)((int)(Core::$user->rating * 4) / 4) == 0.25) ? 'checked="checked"' : ''; ?> />
                <input class="myrating" type="radio" name="profile" value="0.5" disabled="disabled" <?= ((float)((int)(Core::$user->rating * 4) / 4) == 0.5) ? 'checked="checked"' : ''; ?> />
                <input class="myrating" type="radio" name="profile" value="0.75" disabled="disabled" <?= ((float)((int)(Core::$user->rating * 4) / 4) == 0.75) ? 'checked="checked"' : ''; ?> />
                <input class="myrating" type="radio" name="profile" value="1" disabled="disabled" <?= ((float)((int)(Core::$user->rating * 4) / 4) == 1) ? 'checked="checked"' : ''; ?> />

                <input class="myrating" type="radio" name="profile" value="1.25" disabled="disabled" <?= ((float)((int)(Core::$user->rating * 4) / 4) == 1.25) ? 'checked="checked"' : ''; ?> />
                <input class="myrating" type="radio" name="profile" value="1.5" disabled="disabled" <?= ((float)((int)(Core::$user->rating * 4) / 4) == 1.5) ? 'checked="checked"' : ''; ?> />
                <input class="myrating" type="radio" name="profile" value="1.75" disabled="disabled" <?= ((float)((int)(Core::$user->rating * 4) / 4) == 1.75) ? 'checked="checked"' : ''; ?> />
                <input class="myrating" type="radio" name="profile" value="2" disabled="disabled" <?= ((float)((int)(Core::$user->rating * 4) / 4) == 2) ? 'checked="checked"' : ''; ?> />

                <input class="myrating" type="radio" name="profile" value="2.25" disabled="disabled" <?= ((float)((int)(Core::$user->rating * 4) / 4) == 2.25) ? 'checked="checked"' : ''; ?> />
                <input class="myrating" type="radio" name="profile" value="2.5" disabled="disabled" <?= ((float)((int)(Core::$user->rating * 4) / 4) == 2.5) ? 'checked="checked"' : ''; ?> />
                <input class="myrating" type="radio" name="profile" value="2.75" disabled="disabled" <?= ((float)((int)(Core::$user->rating * 4) / 4) == 2.75) ? 'checked="checked"' : ''; ?> />
                <input class="myrating" type="radio" name="profile" value="3" disabled="disabled" <?= ((float)((int)(Core::$user->rating * 4) / 4) == 3) ? 'checked="checked"' : ''; ?> />

                <input class="myrating" type="radio" name="profile" value="3.25" disabled="disabled" <?= ((float)((int)(Core::$user->rating * 4) / 4) == 3.25) ? 'checked="checked"' : ''; ?> />
                <input class="myrating" type="radio" name="profile" value="3.5" disabled="disabled" <?= ((float)((int)(Core::$user->rating * 4) / 4) == 3.5) ? 'checked="checked"' : ''; ?> />
                <input class="myrating" type="radio" name="profile" value="3.75" disabled="disabled" <?= ((float)((int)(Core::$user->rating * 4) / 4) == 3.75) ? 'checked="checked"' : ''; ?> />
                <input class="myrating" type="radio" name="profile" value="4" disabled="disabled" <?= ((float)((int)(Core::$user->rating * 4) / 4) == 4) ? 'checked="checked"' : ''; ?> />

                <input class="myrating" type="radio" name="profile" value="4.25" disabled="disabled" <?= ((float)((int)(Core::$user->rating * 4) / 4) == 4.25) ? 'checked="checked"' : ''; ?> />
                <input class="myrating" type="radio" name="profile" value="4.5" disabled="disabled" <?= ((float)((int)(Core::$user->rating * 4) / 4) == 4.5) ? 'checked="checked"' : ''; ?> />
                <input class="myrating" type="radio" name="profile" value="4.75" disabled="disabled" <?= ((float)((int)(Core::$user->rating * 4) / 4) == 4.75) ? 'checked="checked"' : ''; ?> />
                <input class="myrating" type="radio" name="profile" value="5" disabled="disabled" <?= ((float)((int)(Core::$user->rating * 4) / 4) == 5) ? 'checked="checked"' : ''; ?> />
            </div>
            <span class="score"><?=Core::$user->rating; ?></span>
            <span class="votes"><?=Core::$user->votes; ?> <?=(Core::$user->votes == 1) ? ' Vote' : ' Votes'; ?></span>
        </div>
    </div>
    <div class="right">
        <ul id="buttons"> <?php // TODO: Update links below to actual working pages. ?>
            <li><span class="icon"><?=HTML::image('assets/img/icons/profile.png'); ?></span> <?= HTML::anchor('profile/' . Core::$user->username, 'View My Profile'); ?></li>
            <li><span class="icon"><?=HTML::image('assets/img/icons/editprofile.png'); ?></span> <?= HTML::anchor('edit/profile', 'Edit My Profile'); ?></li>
            <li><span class="icon"><?=HTML::image('assets/img/icons/photo.png'); ?></span> <?= HTML::anchor('user/control_panel/manage_photos', 'Edit My Photos'); ?></li>
            <li><span class="icon"><?=HTML::image('assets/img/icons/video.png'); ?></span> <?= HTML::anchor('coming-soon', 'Edit My Videos'); ?></li>
            <li><span class="icon"><?=HTML::image('assets/img/icons/setting.png'); ?></span> <?= HTML::anchor('user/settings', 'Account Settings'); ?></li>
            <li><span class="icon"><?=HTML::image('assets/img/icons/block.png'); ?></span> <?= HTML::anchor(Core::$user->gender == 'Female' ? 'user/blocklist' : 'coming-soon', 'Edit Block List'); ?></li>
            <li><span class="icon"><?=HTML::image('assets/img/icons/status.png'); ?></span> <?= HTML::anchor('user/upgrade', 'Edit My Status'); ?></li>
        </ul><br />
    </div>
    <div class="clear"></div>
</div>
<br />