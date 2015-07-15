<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<h1><?= __('Login to your Swurve account'); ?></h1>
<div style="width: 240px; height: 100px; border-left: 1px solid #95999C; float: right; display: inline; padding-left: 18px;">
    <h3 class="blue">Create Your FREE Profile</h3><br />
    <h4 align="center"><?= HTML::anchor('user/register', 'REGISTER<br />NOW!'); ?></h4>
</div>
<h3 class="blue">Account Information</h3>

<?php
echo Form::open(NULL, array('id' => 'register'));
?>
<fieldset>
<?php
echo Form::label('username', 'Username:');
echo Form::input('username', $post['username'], array('id' => 'username', 'maxlength' => '25'));
echo (empty ($errors['username'])) ? '<br />' : '<br /><span class="errors">' . $errors['username'] . '</span>';

echo Form::label('password', 'Password:');
echo Form::password('password', $post['password'], array('id' => 'password', 'maxlength' => '25')) . '<br />';

echo Form::submit('register-submit', 'Login', array('id' => 'register-submit'));
echo '<br /><span style="padding-left: 165px;">' . HTML::anchor('user/resetpass', 'Forgot Password?') . '</span>';
echo '<br />';
?>
</fieldset>
<?php
echo Form::close();
?>
