<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>   
<h1><?= __('Account Settings'); ?></h1>
<p>Use this page to change your password and/or email address to recieve notifications about matches and other events on the site.</p>
<div style="margin-left: 110px;">
<?= Form::open(NULL, array('id' => 'register')); ?>
<?php
echo Form::label('password', 'New Password:');
echo Form::password('password', NULL, array('id' => 'password', 'maxlength' => '25'));
echo '<br /><span class="hint">6-character minimum; case sensitive</span>';
echo (empty ($errors['password'])) ? '' : '<span class="errors">' . $errors['password'] . '</span>';

echo Form::label('password_confirm', 'Confirm Pass:');
echo Form::password('password_confirm', NULL, array('id' => 'password_confirm', 'maxlength' => '25'));
echo (empty ($errors['password_confirm'])) ? '<br />' : '<span class="errors">' . $errors['password_confirm'] . '</span>';

echo Form::label('email', 'Email:');
echo Form::input('email', $post['email'], array('id' => 'email'));
echo (empty ($errors['email'])) ? '<br />' : '<span class="errors">' . $errors['email'] . '</span>';

echo Form::label('mailstatus', 'Mail Status:');
?>
<ul id="email-notification">
    <li><?=Form::radio('mailstatus', '0', ($post['mailstatus'] == 0) ? TRUE : FALSE); ?> Subscribe</li>
    <li><?=Form::radio('mailstatus', '1', ($post['mailstatus'] != 0) ? TRUE : FALSE); ?> Unsubscribe</li>
</ul>
<div class="clear"></div><br />

<?php
echo Form::input('register-submit', 'Register', array('id' => 'register-submit', 'type' => 'image', 'src' => '/assets/img/registration/button-form-submit.png'));
echo '<br />';
?>

<?= Form::close(); ?>
</div>



