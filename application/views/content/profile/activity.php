<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div id="panel">
    <ul id="tabs">
        <li id="user">
            <h1><?= $user->username; ?>'s Activity</h1>
            <h3>"<?= $user->headline; ?>"</h3>
        </li>
        <li><h2><?= HTML::anchor('profile/' . strtolower($user->username), 'Profile'); ?></h2></li>
        <li><h2><?= HTML::anchor('photos/' . strtolower($user->username), 'Photos'); ?></h2></li>
        <li><h2><?= HTML::anchor('coming-soon', 'Videos'); // TODO: Point to a working link. ?></h2></li>
    </ul>
    <div class="clear"></div>
    <div id="content">
        <?php if (count($feeds) == 0): ?>
        This user has no recent activity.
        <?php endif ?>
        <?= $pagination; ?>

        <?php foreach($feeds as $feed): ?>
        <div class="activity-feed">
        <?php if ($feed->user->avatar->loaded()): ?>
            <?= HTML::anchor('photo/' . $feed->user->username . '/' . $feed->user->avatar->uniqueid, HTML::image(Content::factory($feed->user->username)->get_photo($feed->user->avatar, 's'), array('class' => 'profile-pic'))); ?>
        <?php else: ?>
            <?= HTML::image(Content::factory($feed->user->username)->get_photo($feed->user->avatar, 's'), array('class' => 'profile-pic')); ?>
        <?php endif; ?>

            <p><strong><?= HTML::anchor('profile/' . strtolower($feed->user->username), $feed->user->username); ?></strong> <?= $feed->message; ?><br /><span class="date"><?= Functions::RelativeTime($feed->added_date); ?></span></p>
            <?php if ($feed->feed_type->type == 'photos'): ?>
                <?php $photos = ORM::factory('photo')->where('user_id', '=', $feed->user)->where('added_date', '>=', strtotime('00:00:00', $feed->added_date))->where('added_date', '<', $feed->added_date)->where('hide', '=', 'No')->order_by('added_date', 'DESC')->limit(5)->find_all(); ?>
                <div class="additional-photos">
                <?php foreach($photos as $photo): ?>
                    <?= HTML::anchor('photo/' . $feed->user->username . '/' . $photo->uniqueid, HTML::image(Content::factory($feed->user->username)->get_photo($photo->uniqueid, 'm'), array('class' => 'profile-pic'))); ?>
                <?php endforeach; ?>
                <div class="clear"></div>
                <span class="date"><br />* Thumbnails will not appear until photos have been approved.</span>
                </div>
            <? endif; ?>
        </div>
        <?php endforeach; ?>

        <div class="clear"></div>
        <?= $pagination; ?>
    </div>
    <div class="clear"></div>
</div>
