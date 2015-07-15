<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<h1><?= __('Your Swurve Mailbox'); ?></h1>
<h3 class="blue">Read Message</h3>
<div class="column120 column-header">Username</div>
<div class="column120 column-header">Date Sent</div>
<div class="column380 column-header">Subject</div>
<br>
<div class="column120"><strong><?= HTML::anchor('profile/' . $message->from->username, $message->from->username); ?></strong></div>
<div class="column120"><?= date('m/d/Y', $message->date_sent); ?></div>
<div class="column380"><?= $message->subject; ?></div><br /><br />
<div class="column120 column-header">Message</div><br />
<?= $message->message; ?>
<br /><br />