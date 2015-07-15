<h1>Reset Password</h1>

<p>Enter the username of your account to reset your password.  A notification email will first be sent to the registered email address for that account to confirm the request before the password is reset to prevent unauthorized use and abuse.</p>

<div style="margin-left: 75px;">
<?= Form::open(NULL, array('id' => 'register')); ?>
<fieldset>
<div id="tooltip"></div>
<div style="margin-left: 28px;">
<?php
echo Form::label('username', 'Username:');
echo Form::input('username', $post['username'], array('id' => 'username'));
echo (empty ($errors['username'])) ? '<br />' : '<br /><span class="errors">' . $errors['username'] . '</span>';

echo Form::input('register-submit', 'Register', array('id' => 'register-submit', 'type' => 'image', 'src' => '/assets/img/registration/button-form-submit.png'));
echo '<br />';
?>
</div>
</fieldset>
<?= Form::close(); ?>
</div><br />