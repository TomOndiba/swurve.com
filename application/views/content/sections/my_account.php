<div style="display: inline-block; margin: 0 auto; text-align: left;">
	<h3 style="font-size: 20px; text-decoration: underline; margin-left: 20px;">My Account</h3>
	<?= Form::open('#myaccount'); ?>
		<?= Form::hidden('action', 'update'); ?>

	<div style="margin-top: 2px;"><span style="display: inline-block; width: 90px; text-align: right; margin-right: 3px;">Username:</span> <?= Core::$user->usr_login; ?></div>
	<div style="margin-top: 2px;"><span style="display: inline-block; width: 90px; text-align: right; margin-right: 3px;">Used Space:</span> <?= number_format(Core::$user->usr_disk_space, 2); ?> of 20GB</div>
	<div style="margin-top: 2px;"><span style="display: inline-block; width: 90px; text-align: right; margin-right: 3px;">My Files Link:</span> <?=  HTML::anchor('/users/' . Core::$user->usr_login, URL::site('/users/' . Core::$user->usr_login, 'http')); ?></div><br />

	<h3 style="font-size: 20px; text-decoration: underline; margin-left: 20px;">My Account Settings</h3>

	<div style="margin-top: 5px;"><span style="display: inline-block; width: 90px; text-align: right; margin-right: 3px;">Email:</span> <?= Form::input('usr_email', Core::$user->usr_email, array('size' => '50', 'style' => 'width: 230px; vertical-align: middle;')); ?></div>
	<div style="margin-top: 5px;"><span style="display: inline-block; width: 90px; text-align: right; margin-right: 3px;">Password:</span> <?= Form::password('usr_password', null, array('size' => '50', 'style' => 'width: 230px; vertical-align: middle;')); ?></div>
	<div style="margin-top: 5px;"><span style="display: inline-block; width: 90px; text-align: right; margin-right: 3px;">Confirm Pass:</span> <?= Form::password('usr_password_confirm', null, array('size' => '50', 'style' => 'width: 230px; vertical-align: middle;')); ?></div>

	<p style="text-align: center; margin-top: 5px;">
		<input type="submit" name="submit" class="button" value="Save Settings" />
	</p>
	<?= Form::close(); ?>
</div>