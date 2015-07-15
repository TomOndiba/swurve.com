<h1>Resend Activation</h1>

<p>Use this form to resend your activation email if you haven't recieved it yet.  Type a new email address below to change the email address associated with your account or simply click submit to send to the email address on your account.</p>

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