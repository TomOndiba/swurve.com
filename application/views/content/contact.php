<div style="display: inline-block; margin: 0 auto; text-align: left;">
	<h3 style="font-size: 20px; text-decoration: underline;">Contact Us</h3>

	<div style="width: 400px;">
		<form method="POST">
			<input type="hidden" name="action" value="contact" />
			<p>To contact us simply fill the form below. Please take a minute reading both our <?= HTML::anchor('faq', 'FAQ'); ?> and our <?= HTML::anchor('tos', 'Terms of Service'); ?> before sending any messages regarding our services.</p><br />

			<div><span style="display: inline-block; width: 90px; text-align: right; margin-right: 3px;">Name:</span> <input name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : ''; ?>" type="text" style="vertical-align: middle;" /> <span style="font-size: 12px; color: #aaaaaa;">(Required)</span></div>
			<div><span style="display: inline-block; width: 90px; text-align: right; margin-right: 3px;">Email:</span> <input name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>" type="text" style="vertical-align: middle;" /> <span style="font-size: 12px; color: #aaaaaa;">(Required)</span></div>

			<div><span style="display: inline-block; width: 90px; text-align: right; margin-right: 3px;">Message:</span> <textarea name="message" style="vertical-align: text-top; width: 400px; height: 60px;"><?= isset($_POST['message']) ? $_POST['message'] : ''; ?></textarea></div><br />

			<div style="margin-top: 10px; width: 250px; margin: 0 auto;">
				<img style="margin-bottom: 5px;" align="left" alt="CAPTCHA Image" src="/dev-host/securimage/securimage_show_example.php?sid=<?= round(rand(1, 999999)); ?>" id="captchaImage" /><br />
				<div style="display: inline-block; height: 32px; width: 32px; vertical-align: top;"><a onclick="$('#captchaImage').attr('src', '/dev-host/securimage/securimage_show_example.php?sid=' + Math.random()); this.blur(); return false" title="Refresh Image" href="#" style="border-style: none;" tabindex="-1"><img border="0" onclick="this.blur()" alt="Reload Image" src="/dev-host/securimage/images/refresh.png" /></a></div> <div style="display: inline-block; padding: 4px;"><span style="width: 55px; text-align: right; margin-right: 3px;">Captcha:</span> <input name="sec_captcha" type="text" autocomplete="off" /></div>
			</div>

			<div style="clear: both;"><br /></div>

			<p style="text-align: center;">
				<input type="submit" name="submit" class="button" value="Send Message" />
			</p>
		</form>
	</div>
</div>