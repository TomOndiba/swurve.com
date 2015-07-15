<div style="display: inline-block; margin: 0 auto; text-align: left;">
	<h3 style="font-size: 20px; text-decoration: underline; margin-left: 20px;">Register</h3>
	<?= Form::open('#register'); ?>
		<?= Form::hidden('action', 'register'); ?>

	<div><span style="display: inline-block; width: 90px; text-align: right; margin-right: 3px;">Username:</span> <input name="usr_login" autocomplete="off" type="text" value="<?= isset($_POST['usr_login']) ? $_POST['usr_login'] : ''; ?>" style="vertical-align: middle;" /></div>
	<div><span style="display: inline-block; width: 90px; text-align: right; margin-right: 3px;">Email:</span> <input name="usr_email" autocomplete="off" type="text" value="<?= isset($_POST['usr_email']) ? $_POST['usr_email'] : ''; ?>" style="vertical-align: middle;" /></div>
	<div><span style="display: inline-block; width: 90px; text-align: right; margin-right: 3px;">Password:</span> <input name="usr_password" autocomplete="off" type="password" style="vertical-align: middle;" /></div>
	<div><span style="display: inline-block; width: 90px; text-align: right; margin-right: 3px;">Confirm Pass:</span> <input name="usr_password_confirm" autocomplete="off" type="password" style="vertical-align: middle;" /></div>

	<div style="margin-top: 10px;">
		<img style="margin-bottom: 5px;" align="left" alt="CAPTCHA Image" src="/dev-host/securimage/securimage_show_example.php?sid=<?= round(rand(1, 999999)); ?>" id="captchaImage" /><br />
		<div style="display: inline-block; height: 32px; width: 32px; vertical-align: top;"><a onclick="$('#captchaImage').attr('src', '/dev-host/securimage/securimage_show_example.php?sid=' + Math.random()); this.blur(); return false" title="Refresh Image" href="#" style="border-style: none;" tabindex="-1"><img border="0" onclick="this.blur()" alt="Reload Image" src="/dev-host/securimage/images/refresh.png" /></a></div> <div style="display: inline-block; padding: 4px;"><span style="width: 55px; text-align: right; margin-right: 3px;">Captcha:</span> <input name="sec_captcha" type="text" autocomplete="off" /></div>
	</div>

	<p style="text-align: center;">
		<input type="submit" name="submit" class="button" value="Register" style="padding-bottom: 5px;" />
	</p>
	<?= Form::close(); ?>
	<br /><br /><br />
</div>