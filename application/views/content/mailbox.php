<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div id="panel">
    <ul id="mail-tabs">
        <li id="current">
            <h1>Inbox</h1>
        </li>
        <li><h2><?= HTML::anchor('mailbox/sent', 'Sent'); ?></h2></li>
        <li><h2><?= HTML::anchor('message/new', 'Compose'); ?></h2></li>
    </ul>
    <div class="clear"></div>
    <div id="content">
    <?php if (count($mail) == 0): ?>
        <div class="legend" style="float: right;">
            <span>Filter:</span>
            <span class="showall" style=" <?php if ( ! isset($_GET['filter'])): ?>text-decoration: none;<?php else: ?>text-decoration: underline;<?php endif; ?> cursor: pointer;" onclick="location.href='?'">Show All</span>
            <span class="showread" style=" <?php if (isset($_GET['filter']) AND $_GET['filter'] == 'read'): ?>text-decoration: none;<?php else: ?>text-decoration: underline;<?php endif; ?> cursor: pointer;" onclick="location.href='?filter=read'">Show Read</span>
            <span class="showunread" style=" <?php if (isset($_GET['filter']) AND $_GET['filter'] == 'unread'): ?>text-decoration: none;<?php else: ?>text-decoration: underline;<?php endif; ?> cursor: pointer;" onclick="location.href='?filter=unread'">Show Unread</span>
        </div>

        <div class="clear"></div><br />

        <p>You have no<?= isset($_GET['filter']) ? ' ' . $_GET['filter'] : ''; ?> mail in your inbox.</p>
    <?php else: ?>
        <script>
            $(document).ready(function() {
                $('#deleteselected').click(function() {
                    var data = $('.delete').serialize();

                    if (data != '')
                    {
                        if (confirm('Are you sure you want to delete the selected emails?'))
                        {
                            $.post('/json/delete', 'action=selected&' + data, function(response) {
                                if (response == 'refresh')
                                {
                                    location.reload(true);
                                }
                            });
                        }
                    }
                });

                $('#deleteall').click(function() {
                    if (confirm('Are you sure you want to delete all<?= isset($_GET['filter']) ? ' ' . $_GET['filter'] : ''; ?> emails?'))
                    {
                        $.post('/json/delete', 'action=all&filter=<?= isset($_GET['filter']) ? $_GET['filter'] : ''; ?>', function(response) {
                            if (response == 'refresh')
                            {
                                location.reload(true);
                            }
                        });
                    }
                });
            });
        </script>
        <div class="legend" style="float: right;">
            <span>Filter:</span>
            <span class="showall" style=" <?php if ( ! isset($_GET['filter'])): ?>text-decoration: none;<?php else: ?>text-decoration: underline;<?php endif; ?> cursor: pointer;" onclick="location.href='?'">Show All</span>
            <span class="showread" style=" <?php if (isset($_GET['filter']) AND $_GET['filter'] == 'read'): ?>text-decoration: none;<?php else: ?>text-decoration: underline;<?php endif; ?> cursor: pointer;" onclick="location.href='?filter=read'">Show Read</span>
            <span class="showunread" style=" <?php if (isset($_GET['filter']) AND $_GET['filter'] == 'unread'): ?>text-decoration: none;<?php else: ?>text-decoration: underline;<?php endif; ?> cursor: pointer;" onclick="location.href='?filter=unread'">Show Unread</span>
        </div>

        <div class="legend">
            <span>Key:</span>
            <span class="PlatinumUser legendkey">Platinum</span>
            <span class="GoldUser legendkey">Gold</span>
        </div><br />

        <?= $pagination; ?>
        <ul id="mails">
        <?php foreach ($mail as $message): ?>
        <li class="<?= $message->from->membership->type ?>User">
            <div style="width: 30px; float: left;"><input type="checkbox" name="delete[]" class="delete" value="<?= $message; ?>" style="margin-top: 17px;" /></div>
            <div class="column65">
                <?= HTML::anchor('profile/' . $message->from->username, HTML::image(Content::factory($message->from->username)->get_photo($message->from->avatar, 's'), array('class' => 'profile-pic'))); ?>
            </div>

            <div class="column160" style="margin-top: 7px;"><strong><?= HTML::anchor('profile/' . $message->from->username, $message->from->username); ?></strong><br /><?= date('m/d/Y', $message->date_sent); ?></div>
            <div class="column65" style="margin-top: <?= (isset($message->date_read) ? '4' : '11'); ?>px;"><?= HTML::image('assets/img/' . (isset($message->date_read) ? 'read' : 'unread') . '.png', array('alt' => '')); ?></div>
            <div class="column335" style="width: 270px; margin-top: 15px;"><?= HTML::anchor('mailbox/read/' . $message, ! empty($message->subject) ? $message->subject : 'No Subject'); ?></div>
        </li>
        <?php endforeach; ?>
        </ul><br />

        <div style="margin-bottom: 10px;">
            <input type="button" id="deleteselected" name="deleteselected" value="Delete Selected" style="padding: 5px 10px; font-weight: bold; font-family: verdana; font-size: 12px;" /> &nbsp;
            <input type="button" id="deleteall" name="deleteall" value="Delete All<?= isset($_GET['filter']) ? ' ' . ucfirst($_GET['filter']) : ''; ?> from Inbox" style="float: right; padding: 5px 10px; font-family: verdana; font-size: 12px;" />
        </div>

        <?= $pagination; ?>
    <?php endif; ?>
    </div>
    <div class="clear"></div>
</div>
