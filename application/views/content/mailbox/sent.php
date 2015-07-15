<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div id="panel">
    <ul id="mail-tabs">
        <li id="current">
            <h1>Sent</h1>
        </li>
        <li><h2><?= HTML::anchor('message/new', 'Compose'); ?></h2></li>
        <li><h2><?= HTML::anchor('mailbox', 'Inbox'); ?></h2></li>
    </ul>
    <div class="clear"></div>
    <div id="content">
    <?php if (count($mail) == 0): ?>
        <p>You have no sent mail.</p>    
    <?php else: ?>
        <?= $pagination; ?>
        <ul id="mails">
        <?php foreach ($mail as $message): ?>
        <li class="FreeUser">
            <div class="column65">
                <?= HTML::anchor('profile/' . $message->to->username, HTML::image(Content::factory($message->to->username)->get_photo($message->to->avatar, 's'), array('class' => 'profile-pic'))); ?>
            </div>

            <div class="column160" style="margin-top: 7px;"><strong><?= HTML::anchor('profile/' . $message->to->username, $message->to->username); ?></strong><br /><?= date('m/d/Y', $message->date_sent); ?></div>
            <div class="column65" style="margin-top: <?= (isset($message->date_sent) ? '4' : '11'); ?>px;"><?= HTML::image('assets/img/' . (isset($message->date_sent) ? 'read' : 'unread') . '.png', array('alt' => '')); ?></div>
            <div class="column335" style="margin-top: 15px;"><?= HTML::anchor('mailbox/read/' . $message, $message->subject); ?></div>
            <div class="clear"></div>
        </li>
        <?php endforeach; ?>
        </ul><br />
        <?= $pagination; ?>
    <?php endif; ?>
    </div>
    <div class="clear"></div>
</div>
