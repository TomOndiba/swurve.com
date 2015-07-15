<div style="display: inline-block; margin: 0 auto; text-align: left;">
	<h3 style="font-size: 20px; text-decoration: underline;">Lost Password</h3>
	<?= Form::open(); ?>
	<?= Form::hidden('action', 'lostpassword'); ?>
	<div><span style="display: inline-block; width: 65px; text-align: right; margin-right: 3px;">Username:</span> <?= Form::input('username', null, array('style' => 'vertical-align: middle;')); ?></div>
	<div><span style="display: inline-block; width: 65px; text-align: right; margin-right: 3px;">Email:</span> <?= Form::input('email', null, array('style' => 'vertical-align: middle;')); ?></div>

	<p style="text-align: center;">
		<input type="submit" name="submit" class="button" value="Reset Password" /><br /><br />
	</p>
	<?= Form::close(); ?>
</div>