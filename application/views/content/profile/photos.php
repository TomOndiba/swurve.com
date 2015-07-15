<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div id="panel">
    <ul id="tabs">
        <li id="user">
            <h1><?= $user->username; ?>'s Photos</h1>
            <h3>"<?= $user->headline; ?>"</h3>
        </li>
        <li><h2><?= HTML::anchor('coming-soon', 'Videos'); // TODO: Point to a working link. ?></h2></li>
        <li><h2><?= HTML::anchor('activity/' . strtolower($user->username), 'Recent Activity'); ?></h2></li>
        <li><h2><?= HTML::anchor('profile/' . strtolower($user->username), 'Profile'); ?></h2></li>
    </ul>
    <div class="clear"></div>
    <div id="content">
        <?= $pagination; ?>
        <ul id="userphotos">
            <?php foreach($photos as $photo): ?>
            <li><?= HTML::anchor('photo/' . $user->username . '/' . $photo->uniqueid, HTML::image(Content::factory($user->username)->get_photo($photo->uniqueid, 'l'))); ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="clear"></div>
        <?= $pagination; ?>
    </div>
    <div class="clear"></div>
</div>
