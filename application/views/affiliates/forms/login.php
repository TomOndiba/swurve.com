<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div style="margin-left: 230px; margin-top: 20px;">
<h1><?= __('Login to your Swurve Affiliate Account'); ?></h1>
<h3 class="blue">Account Information</h3>
<?php
echo Form::open(NULL, array('id' => 'register'));
?>
<fieldset>
<?php
echo Form::label('email', 'Email:');
echo Form::input('email', $post['email'], array('id' => 'email', 'maxlength' => '255'));
echo (empty ($errors['email'])) ? '<br />' : '<br /><span class="errors">' . $errors['email'] . '</span>';

echo Form::label('password', 'Password:');
echo Form::password('password', $post['password'], array('id' => 'password', 'maxlength' => '25')) . '<br />';

echo Form::label('', '');
echo Form::submit('register-submit', 'Login', array('id' => 'register-submit', 'style' => 'margin-left: 35px;'));
echo '<br /><span style="padding-left: 165px;">' . HTML::anchor('affiliates/account/resetpass', 'Forgot Password?') . '</span>';
echo '<br /><br /><br /><div class="separator" style="width: 50%"></div><br /><br />';
?>
</fieldset>
<?php
echo Form::close();
?>
<h1><?= __('Create your Swurve Affiliate Account'); ?></h1>
<h3 style="margin-left: 150px;"><?= HTML::anchor('affiliates/account/create', 'Sign Up Now!'); ?></h3><br /><br />
</div>

