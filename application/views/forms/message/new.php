<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?= Form::open(NULL, array('id' => 'newmessage-form')); ?>
<?php if ($to->loaded()): ?>
<?= Form::hidden('from', 'profile'); ?>
<?php endif; ?>
<h3 class="blue">Send New Message</h3>
<div class="column380 column-header">To</div><br />
<?= Form::input('to', $to->username, array('style' => 'width: 200px;')); ?><br /><br />
<div class="column380 column-header">Subject</div><br />
<?= Form::input('subject', NULL, array('style' => 'width: 620px;')); ?><br /><br />
<div class="column120 column-header">Message</div><br />
<?= Form::textarea('message', '', array('style' => 'width: 620px;', 'rows' => '5')); ?><br /><br />
<center><?= Form::submit('submit', 'Send Message'); ?><br /><br /></center>
<?= Form::close(); ?>