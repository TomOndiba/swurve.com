<?php if ($file->loaded()): ?>
<div class="unselectable" style="position: absolute; left: 100px; top: 50px; z-index: 1;">
	<h3 style="font-size: 30px; cursor: pointer;" id="prev-area">&lt; <u id="prev-area-label">FILE LINKS</u></h3>
</div>

<div class="unselectable" style="position: absolute; right: 100px; top: 50px; z-index: 1;">
	<h3 style="font-size: 30px; cursor: pointer;" id="next-area"><u id="next-area-label">COMMENTS</u> &gt;</h3>
</div>
<?php endif; ?>

<div id="contents" style="overflow: hidden; text-align: left;">
	<?php if ($file->loaded()): ?>
	<div id="links-content" style="position: fixed; left: -3000px; display: none; width: 100%; text-align: center;" next="main" name="File Links">
		<div style="display: inline-block; margin: 0 auto; text-align: left;">
			<h3 style="font-size: 20px; text-decoration: underline; margin-left: 20px;">File Links</h3>

			<div><span style="display: inline-block; width: 95px; text-align: left; margin-left: 3px; margin-top: 5px;">Download Link:</span><br /> <?= Form::textarea('dl_link', URL::site('/' . $file->file_code, 'http'), array('style' => 'vertical-align: middle; width: 400px; height: 50px;')); ?></div>
			<div><span style="display: inline-block; width: 95px; text-align: left; margin-left: 3px; margin-top: 5px;">Forum Link:</span><br /> <?= Form::textarea('forum_link', '[URL=' . URL::site('/' . $file->file_code . '[/URL] ' . Functions::byteSize($file->file_size), 'http'), array('style' => 'vertical-align: middle; width: 400px; height: 50px;')); ?></div>
			<div><span style="display: inline-block; width: 95px; text-align: left; margin-left: 3px; margin-top: 5px;">HTML Code:</span><br /> <?= Form::textarea('html_code', '<a href="' . URL::site('/' . $file->file_code, 'http') . '">' . $file->file_name . ' - ' . Functions::byteSize($file->file_size) . '</a>', array('style' => 'vertical-align: middle; width: 400px; height: 50px;')); ?></div>
		</div>
	</div>
	<?php endif; ?>

	<div id="main-content" style="position: static; left: 0px; display: inline-block; width: 100%; text-align: center;" prev="links" next="comments" name="File Upload">
		<div style="display: inline-block; margin: 0 auto; text-align: left;">
			<?php if ($file->loaded()): ?>
			<div style="display: inline-block; vertical-align: top;">
				<h3 style="font-size: 20px; text-decoration: underline; margin-left: 10px;">Download File</h3>

				<div style="background-color: #F1F5FB; border: 1px solid #CCD9EA; border-radius: 5px 5px 5px 5px; width: 350px; margin-top: 5px; padding: 5px;">
					<div><span style="display: inline-block; width: 95px; text-align: right; margin-right: 3px; font-weight: bold;">Filename:</span> <div title="<?= $file->file_name; ?>" style="text-overflow: ellipsis; overflow:hidden; white-space: nowrap; width: 240px; display: inline-block; vertical-align: text-top;"><?= $file->file_name; ?></div></div>
					<div><span style="display: inline-block; width: 95px; text-align: right; margin-right: 3px; font-weight: bold;">Size:</span> <?= Functions::byteSize($file->file_size); ?> <?php if ($file->file_size >= 1024): ?>(<?= $file->file_size; ?> bytes)<?php endif; ?></div>
					<div><span style="display: inline-block; width: 95px; text-align: right; margin-right: 3px; font-weight: bold;">Uploaded By:</span> <?= $file->user->loaded() ? HTML::anchor('users/' . $file->user->usr_login, $file->user->usr_login) : 'Anonymous' ?></div>
					<div><span style="display: inline-block; width: 95px; text-align: right; margin-right: 3px; font-weight: bold;">Uploaded On:</span> <?= $file->file_created; ?></div>
					<div><span style="display: inline-block; width: 95px; text-align: right; margin-right: 3px; font-weight: bold;">Downloaded:</span> <?= $file->file_downloads; ?></div>
					<div><span style="display: inline-block; width: 95px; text-align: right; margin-right: 3px; font-weight: bold;">MD5 Sum:</span> <?= $file->md5sum; ?></div>
					<?php if (! empty($file->file_descr)): ?><div><span style="display: inline-block; width: 95px; text-align: right; margin-right: 3px; font-weight: bold;">File Desc:</span> <?= $file->file_descr; ?></div><?php endif; ?>
				</div>
			</div>

			<?php $ext = strtolower(pathinfo($file->file_name, PATHINFO_EXTENSION)); ?>
			<?php if (in_array($ext, array('jpg', 'bmp', 'png'))): ?>
			<div style="display:  inline-block; vertical-align: top; margin-left: 5px;">
				<h3 style="font-size: 20px; text-decoration: underline; margin-left: 4px;">Image Preview</h3>
					<div style="background-color: #F1F5FB; border: 1px solid #CCD9EA; border-radius: 5px 5px 5px 5px; text-align: center; margin-top: 5px; padding: 5px;">
						<?= HTML::anchor('view/'. $file->file_code, HTML::image('thumbnail/' . $file->file_code), array('target' => '_blank')); ?>
					</div>
			</div>
			<?php endif; ?>

			<div style="display: inline-block; vertical-align: top; width: 90px; margin-left: 5px;">
				<h3 style="font-size: 20px; text-decoration: underline; margin-left: 4px;">Share File</h3>
					<div style="margin-top: 9px;">
						<!-- AddThis Button BEGIN -->
						<div class="addthis_toolbox addthis_default_style ">
						<a style="" class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
						<a style="margin-top: 3px;" class="addthis_button_tweet"></a>
						<a style="margin-top: 10px;" class="addthis_button_google_plusone" g:plusone:size="medium"></a>
						<a style="margin-top: 10px;" class="addthis_counter addthis_pill_style"></a>
						</div>
						<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f1a3d52578669bc"></script>
						<!-- AddThis Button END -->
					</div>
			</div>

			<div style="clear: both; margin-bottom: 5px;"><br /></div>

			<div style="text-align: center; margin-top: 5px; padding-bottom: 5px;">
				<script type="text/javascript"><!--
				google_ad_client = "ca-pub-2554078832478360";
				/* site top small banner */
				google_ad_slot = "4635564768";
				google_ad_width = 468;
				google_ad_height = 60;
				//-->
				</script>
				<script type="text/javascript"
				src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
				</script>

			<form action="<?= $file->server->srv_cgi_url; ?>" method="post">
				<input type="hidden" name="action" value="download" />
				<input accept="<?php if ($file->server->srv_status == 'OFF') echo 'disabled="disabled"'; ?> " type="submit" name="submit" class="button" value="Download" id="downloadfile" style="margin-bottom: 8px;" />
			</form>

				<script type="text/javascript"><!--
				google_ad_client = "ca-pub-2554078832478360";
				/* download bottom small */
				google_ad_slot = "0689681897";
				google_ad_width = 234;
				google_ad_height = 60;
				//-->
				</script>
				<script type="text/javascript"
				src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
				</script>
			</div>
			<?php else: ?>
			<div style="display: inline-block; vertical-align: top;">
			<h3 style="font-size: 20px; text-decoration: underline; margin-left: 10px;">File Not Found</h3>
			<p>The file you were looking for could not be found, sorry for any inconvenience.</p><br />

			<p>Possible causes of this error could be:</p>
			<p>
				<ol>
					<li style="list-style-type: circle; margin-left: 25px;">The file expired</li>
					<li style="list-style-type: circle; margin-left: 25px;">The file was deleted by its owner</li>
					<li style="list-style-type: circle; margin-left: 25px;">The file was deleted, didn't comply with Terms of Service</li>
				</ol>
			</p>
			</div>
			<?php endif; ?>
		</div>
	</div>

	<?php if ($file->loaded()): ?>
	<div id="comments-content" style="position: fixed; left: 0px; display: none; width: 100%; text-align: center;" prev="main" name="Comments">
		<div style="display: inline-block; margin: 0 auto; text-align: left; clear: both;">
			<h3 style="font-size: 20px; text-decoration: underline; margin-left: 20px; margin-bottom: 10px;">Comments</h3>


			<?php $comments = $file->comments->order_by('created', 'desc')->find_all(); ?>
			<?php if (count($comments) == 0): ?>
			<div style="text-align: center;">No comments for this file.</div>
			<?php endif; ?>

			<?php foreach($comments as $comment): ?>
			<div style="width: 550px; margin-bottom: 10px;">
				<div>
					<p><span style="font-weight: bold;"><?= $comment->cmt_name; ?></span>:  <?= trim($comment->cmt_text); ?></p>
					<span style="font-size: 12px; color: #aaaaaa;"><?= Functions::RelativeTime(strtotime($comment->created)); ?></span>
				</div>
			</div>
			<hr style="background-color: #ccc; border: 1px solid #ccc;" />
			<?php endforeach; ?>
			<div style="clear: both;"><br /></div><br />

			<form method="POST">
			<input type="hidden" name="action" value="comment" />
				<h3 style="font-size: 20px; text-decoration: underline; margin-left: 20px; margin-bottom: 10px; margin-top: 10px;">Leave a Comment</h3>
				<?php if (Core::$user): ?>
				<input name="cmt_name" type="hidden" value="<?= Core::$user->usr_login; ?>" />
				<?php else: ?>
				<div><span style="display: inline-block; width: 90px; text-align: right; margin-right: 3px;">Name:</span> <input name="cmt_name" type="text" style="vertical-align: middle;" /> <span style="font-size: 12px; color: #aaaaaa;">(Required)</span></div>
				<?php endif; ?>

				<div><span style="display: inline-block; width: 90px; text-align: right; margin-right: 3px;">Comment:</span> <textarea name="cmt_text" style="vertical-align: text-top; width: 400px; height: 60px;"></textarea></div>

				<p style="text-align: center;">
					<input type="submit" name="submit" class="button" value="Post Comment" />
				</p>
			</form>

			<br /><br /><br /><br />
		</div>
	</div>
	<?php endif; ?>
</div>

<div style='display:none'>
	<div id='inline_content' style='padding:10px; background:#fff; text-align: center'>
		<h3 style="margin-bottom: 5px; font-size: 20px; text-decoration: underline;">Thank You</h3>
		<p>While your file is downloading, please take a moment to<br />
		support DEV-HOST by clicking the ad below, thank you.</p><br />
		<script type="text/javascript"><!--
		google_ad_client = "ca-pub-2554078832478360";
		/* site top small banner */
		google_ad_slot = "4635564768";
		google_ad_width = 468;
		google_ad_height = 60;
		//-->
		</script>
		<script type="text/javascript"
		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script>
		<!--br /><span style="font-size: 12px; color: #aaaaaa;">(To open ads in a new window, right click on it and select open in a tab/window)</span-->
	</div>
</div>