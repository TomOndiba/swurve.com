<div style="display: inline-block; margin: 0 auto; text-align: left;">
	<h3 style="font-size: 20px; text-decoration: underline;">Login</h3>
	<?= Form::open(); ?>
	<?= Form::hidden('action', 'login'); ?>
	<div><span style="display: inline-block; width: 65px; text-align: right; margin-right: 3px;">Username:</span> <?= Form::input('username', null, array('style' => 'vertical-align: middle;')); ?></div>
	<div><span style="display: inline-block; width: 65px; text-align: right; margin-right: 3px;">Password:</span> <?= Form::password('password', null, array('style' => 'vertical-align: middle;')); ?></div>

	<p style="text-align: center;">
		<input type="submit" name="submit" class="button" value="Login" /><br /><br />

		<?= '';//HTML::anchor('lostpassword', 'Forgot Your Password?'); ?>
	</p>
	<?= Form::close(); ?>
</div>