<div style="display: inline-block; margin: 0 auto; text-align: left;" id="dragdrop">
	<?php
		$server = ORM::factory('server')->where('srv_status', '=', 'ON')->order_by(new Database_Expression('rand(now())'), 'ASC')->find();
		if ( ! $server->loaded()):
	?>
	<div id="dragdropstyle" style="display: none; border-radius: 5px 5px 5px 5px; border: 1px dashed #666666; background-color: #fff; z-index: 100; position: absolute; width: 500px; height: 50px; font-family: 'Raleway'; font-size: 20px; text-align: center; padding-top: 30px;">Drop files here to add to pending uploads.</div>
		<h3 style="font-size: 20px; text-decoration: underline;">File Upload</h3>

		<p>File uploads temporarily disabled.</p>
	</div>
	<?php else: ?>
	<script>
		var progress_url = '<?= $server->srv_cgi_url; ?>/';
	</script>
	<iframe src="javascript:false;" name="upload_frame" id="upload_frame" style="position:absolute;top:-9999px;"></iframe>
	<!--div id="dragdropstyle" style="display: none; border-radius: 5px 5px 5px 5px; border: 1px dashed #666666; background-color: #fff; z-index: 100; position: absolute; width: 500px; height: 50px; font-family: 'Raleway'; font-size: 20px; text-align: center; padding-top: 30px;">Drop files here to add to pending uploads.</div-->
	<h3 style="font-size: 20px; text-decoration: underline;">File Upload</h3>
	<p style="font-size: 12px;">Up to 512MB, 10 files max <span id="dragdropsupport">- [Drag and drop support for multiple files]</span></p>
	<form method="post" action="<?= $server->srv_cgi_url; ?>/" enctype="multipart/form-data" class="uploads" target="upload_frame">
		<input type="hidden" class="uid" name="UPLOAD_IDENTIFIER" value="<?php echo md5(uniqid(mt_rand())); ?>" />
		<input type="hidden" name="action" value="upload" />
		<input class="upload_file" type="file" name="files[]" multiple="" size="68" style="width: 500px;"/>
	</form>

		<h3 style="display: none; margin-top: 20px; font-size: 20px; text-decoration: underline;">Pending Uploads</h3>
		<div style="display: none; margin-top: 5px; margin-bottom: 10px;" id="upload_list">
			<table width="500" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width: 140px;" class="table-header" style="border-radius: 5px 0 0 0;">Name</td>
					<td class="table-header">Description</td>
					<td style="width: 40px;" align="center" class="table-header" style="border-radius: 0 5px 0 0;">Delete</td>
				</tr>
				<tr class="upload_row" style="display: none;">
					<td style="width: 140px;"><div class="file_name" style="padding: 0 3px 0; text-overflow: ellipsis; overflow:hidden; white-space: nowrap; width: 138px;"></div></td>
					<td><input type="text" class="file_desc" name="file_description[]" style="width: 300px;" /></td>
					<td align="center" style="vertical-align: middle !important;"><a href="#"><img class="delete" style="vertical-align: text-bottom;" src="http://dev-host.org/images/del.gif" /></a></td>
				</tr>
				<tr>
					<td colspan="3" style="border-top: 1px solid #333333; text-align: center;"></td>
				</tr>
			</table>
		</div>

		<h3 style="display: none; margin-top: 20px; font-size: 20px; text-decoration: underline;">Completed Uploads</h3>
		<div style="display: none; margin-top: 5px; margin-bottom: 10px;" id="completed_list">
			<table width="500" cellpadding="0" cellspacing="0">
				<tr>
					<td class="table-header" style="border-radius: 5px 0 0 0;">Name</td>
					<td class="table-header">Status</td>
					<td align="center" class="table-header" style="border-radius: 0 5px 0 0;">Download</td>
				</tr>
				<tr class="completed_row" style="display: none;">
					<td style="width: 220px;"><div class="file_name" style="padding: 0 3px 0; text-overflow: ellipsis; overflow:hidden; white-space: nowrap; width: 200px;"></div></td>
					<td class="file_status"></td>
					<td align="center" class="file_link" width="10" style="color: blue;"></td>
				</tr>
				<tr>
					<td colspan="3" align="center" style="border-top: 1px solid #333333; padding-top: 15px;">
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
					</td>
				</tr>
			</table>
		</div>

		<p style="font-size: 12px; text-align: center; padding-bottom: 3px;">
			<?php if (Core::$user): ?>
			Upload to folder: <select name="uploadfolder" id="uploadfolder" style="height: 18px; width: 100px; font-size: 12px;">
				<option value="0">/</option>
				<?php Functions::display_child(Core::$user->usr_id, 0, 0, '/'); ?>
			</select> - Make Public <input type="checkbox" name="public" id="public" style="width: 10px; vertical-align: middle;" value="1" /><br />
			<?php else: ?>
			<input type="hidden" name="uploadfolder" value="0" id="uploadfolder" />
			<input type="hidden" name="public" value="0" id="public" />
			<?php endif; ?>

			I have read and agree to the <a href="#">Terms of Service</a>: <input name="tos" id="tos" value="1" type="checkbox" style="width: 10px; vertical-align: middle;" /><br />

			<div id="uploadstatus" style="display: none; text-align: center;"><span style="font-weight: bold;">Upload Status</span><div id="uploadprogress"></div></div>
			<center><input type="submit" name="submit" class="button" value="Upload!" id="uploadbutton" style="margin-bottom: 5px;" /></center>
		</p>
	<?php endif; ?>
</div>