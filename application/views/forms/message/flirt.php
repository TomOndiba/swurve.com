<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
    $('.message').click(function() {
       location.href = <?= '\'' . URL::site(Request::instance()->uri . '/\' + $(this).val()'); ?>;
    });
});
</script>
<h1><?= __('Send Flirt'); ?></h1>
<h3 class="blue">Select message to send</h3>
<?php
echo Form::open(NULL);
?>
<fieldset>
<?php foreach($messages as $message): ?>
<div style="margin-bottom: -13px;">
    <div style="float: left; width: 30px; margin-top: 4px;"><?= Form::radio('message', $message->id, FALSE, array('class' => 'message')); ?></div>
    <div style="float: left; width: 580px; font-size: 10px; line-height: 15px;">
        <?= Text::auto_p(Functions::template_replace($message->message, $from, $to)); ?>
    </div>
    <div style="clear: both;"></div>
</div>
<hr />
<?php endforeach; ?>
</fieldset>
<?php
echo Form::close();
?>