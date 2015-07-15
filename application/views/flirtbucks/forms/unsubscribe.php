<h1>Turn Off Email Notifications</h1>

<p>To unsubscribe from Swurve Affiliate email notification service enter your email address below. This will remove your account from all future Swurve Affiliate communications. <!--To turn communication notifications back on you can re-subscribe your account from the 'Account Settings' link featured on your control panel.--></p>

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