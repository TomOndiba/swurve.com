<h1>Reset Password</h1>

<p>Enter the email of your account to reset your password.  A notification email will first be sent to the registered email address for that account to confirm the request before the password is reset to prevent unauthorized use and abuse.</p>

<div style="margin-left: 75px;">
<?= Form::open(NULL, array('id' => 'register')); ?>
<fieldset>
<div id="tooltip"></div>
<div style="margin-left: 28px;">
<?php
echo Form::label('email', 'Email:');
echo Form::input('email', $post['email'], array('id' => 'email'));
echo (empty ($errors['email'])) ? '<br />' : '<br /><span class="errors">' . $errors['email'] . '</span>';

echo Form::input('register-submit', 'Register', array('id' => 'register-submit', 'type' => 'image', 'src' => '/assets/img/registration/button-form-submit.png'));
echo '<br />';
?>
</div>
</fieldset>
<?= Form::close(); ?>
</div><br />