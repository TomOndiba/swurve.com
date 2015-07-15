<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script>
  $(document).ready(function() {
    $('.blockuser').click(function() {
      if (confirm("Are you sure you want to block '" + $(this).attr('username') + "'"))
      {
        $.post('/json/block', { 'username': $(this).attr('username') }, function(response) {
          if (response == 'refresh')
          {
            location.reload(true);
          }
        });
      }
    });
  });
</script>

<?php if (Core::$user->gender == 'Female'): ?>
<center><a style="cursor: pointer; text-decoration: underline;" class="blockuser" username="<?= $message->from->username; ?>">Block future emails from <?= $message->from->username; ?></a></center>
<?php endif; ?>

<hr /><br />
<?= Form::open('mailbox/reply/' . $message, array('id' => 'reply-form')); ?>
<h3 class="blue">Reply Message</h3>
<div class="column380 column-header">Subject</div><br />
<?php if (substr_compare(! empty($message->subject) ? $message->subject : 'No Subject', 'RE: ', 0, (strlen(! empty($message->subject) ? $message->subject : 'No Subject') >= 3) ? 3 : strlen(! empty($message->subject) ? $message->subject : 'No Subject'), TRUE) == FALSE): ?>
<?= Form::input('subject', ! empty($message->subject) ? $message->subject : 'No Subject', array('style' => 'width: 620px;')); ?><br /><br />
<?php else: ?>
<?= Form::input('subject', 'RE: ' . ( ! empty($message->subject) ? $message->subject : 'No Subject'), array('style' => 'width: 620px;')); ?><br /><br />
<?php endif; ?>
<div class="column120 column-header">Message</div><br />
<?= Form::textarea('message', '', array('style' => 'width: 620px;', 'rows' => '5')); ?><br />
<center><?= Form::submit('submit', 'Send Reply'); ?><br /><br /></center>
<?= Form::close(); ?>