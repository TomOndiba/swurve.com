<div style="display: inline-block; margin: 0 auto; text-align: left;">
	<h3 style="font-size: 20px; text-decoration: underline; margin-left: 20px;">My Files</h3>

	<div style="margin-top: 5px;">
		<?php
			if (isset($_GET['fld_id']))
			{
				$files = Core::$user->files->where('file_fld_id', '=', $_GET['fld_id'])->order_by('file_name', 'ASC')->find_all();
				$folders = Core::$user->folders->where('fld_parent_id', '=', $_GET['fld_id'])->order_by('fld_name', 'ASC')->find_all();
				$curr_folder = Core::$user->folders->where('fld_id', '=', $_GET['fld_id'])->find();
			}
			else
			{
				$files = Core::$user->files->where('file_fld_id', '=', 0)->order_by('file_name', 'ASC')->find_all();
				$folders = Core::$user->folders->where('fld_parent_id', '=', 0)->order_by('fld_name', 'ASC')->find_all();
			}

			$count = 0;
			$size = 0;

			foreach ($files as $file)
			{
				$count += 1;
				$size += $file->file_size;
			}
		?>
		<div style="float: left; margin-top: 7px;" id="file-stats"><strong style="font-weight: bold;"><?= $count; ?></strong> files totalling <strong style="font-weight: bold;"><?= Functions::byteSize($size); ?></strong> of <strong style="font-weight: bold;">20.00 GB</strong></div>
		<div style="float: right; margin-bottom: 5px;"><input id="folder_name" name="folder_name" /> <input data-fld_parent_id="<?= isset($_GET['fld_id']) ? $_GET['fld_id'] : 0; ?>" type="button" name="createfolder" id="create_folder" class="button" value="Create Folder" /></div>
		<div style="clear: both;"></div>
		<table width="600" cellpadding="0" cellspacing="0" id="my-file-list">
			<tr>
				<td align="center" class="table-header" style="border-radius: 5px 0 0 0;" ><input id="check_all_files" type="checkbox" style="width: 10px; vertical-align: middle;" /></td>
				<td class="table-header">Name</td>
				<td align="center" class="table-header">Size</td>
				<td align="center" class="table-header">DLs</td>
				<td align="center" class="table-header">Cmts</td>
				<td align="center" class="table-header">Pub</td>
				<td class="table-header" width="130">Upload Date</td>
				<td align="center" class="table-header" style="border-radius: 0 5px 0 0;">Delete</td>
			</tr>

			<?php if (isset($_GET['fld_id']) AND $_GET['fld_id'] != 0): ?>
			<tr style="background-color: #<?= Text::alternate('FFFFFF', 'F3F3F3'); ?>;">
				<td align="center"><img style="vertical-align: text-bottom;" src="http://dev-host.org/images/folder.gif" /></td>
				<td><?= HTML::anchor('/?fld_id=' . $curr_folder->fld_parent_id . '#files', '..'); ?></td>
				<td colspan="5" align="center"><?= $curr_folder->files->count_all(); ?> Files</td>
				<td align="center"></td>
			</tr>
			<?php endif; ?>

			<?php foreach($folders as $folder): ?>
			<tr style="background-color: #<?= Text::alternate('FFFFFF', 'F3F3F3'); ?>;" data-fld_id="<?= $folder->fld_id; ?>">
				<td align="center"><img style="vertical-align: text-bottom;" src="http://dev-host.org/images/folder.gif" /></td>
				<td><?= HTML::anchor('/?fld_id=' . $folder->fld_id . '#files', $folder->fld_name); ?></td>
				<td colspan="5" align="center"><?= $folder->files->count_all(); ?> Files</td>
				<td align="center"><a href="#"><img class="delete_this_folder" style="vertical-align: text-bottom;" src="http://dev-host.org/images/del.gif" /></a></td>
			</tr>
			<?php endforeach; ?>
			<?php if (count($files) == 0): ?>
			<tr style="background-color: #<?= Text::alternate('FFFFFF', 'F3F3F3'); ?>;">
				<td align="center" colspan="8">No files found in this folder.<br /><span style="color: blue; cursor: pointer; text-decoration: underline;" onclick="$('#prev-area').click();">Upload some now?</span></td>
			</tr>
			<?php endif; ?>
			<?php foreach($files as $file): ?>
			<tr style="background-color: #<?= Text::alternate('FFFFFF', 'F3F3F3'); ?>;" data-file_code="<?= $file->file_code; ?>" data-file_del_id="<?= $file->file_del_id; ?>">
				<td align="center"><input class="delete_file" type="checkbox" style="width: 10px; vertical-align: middle;" /></td>
				<td><div title="<?= $file->file_name; ?>" style="padding: 2px 3px 2px; text-overflow: ellipsis; overflow:hidden; white-space: nowrap; width: 180px;"><?= HTML::anchor('/' . $file->file_code, $file->file_name); ?></div></td>
				<td align="center"><?= Functions::byteSize($file->file_size); ?></td>
				<td align="center"><?= $file->file_downloads; ?></td>
				<td align="center">0</td>
				<td align="center"><input <?php if ($file->file_public): ?>checked="checked"<?php endif; ?> class="publish_file" type="checkbox" style="width: 10px; vertical-align: middle;" /></td>
				<td><?= $file->file_created; ?></td>
				<td align="center"><a href="#"><img class="delete_this_file" style="vertical-align: text-bottom;" src="http://dev-host.org/images/del.gif" /></a></td>
			</tr>
			<?php endforeach; ?>
			<tr style="border-top: 1px solid #333333;">
				<td colspan="8" align="center" style="padding-top: 3px; padding-bottom: 5px;" valign="middle">
					<div style="float: left;"><input id="delete-selected" type="button" name="delete" class="button" value="Delete Selected" /></div>
					<div style="display: inline-block; margin-top: 5px;">
						<select id="move-file-folder" style="display: none; height: 25px; width: 200px; font-size: 16px;">
							<option value="">- Move files to folder -</option>
							<option value="0">/</option>
							<?php Functions::display_child(Core::$user->usr_id, 0, 0, '/'); ?>
						</select>
					</div>
					<div style="float: right;"><input id="publish-selected" type="button" name="publish" class="button" value="Publish Selected" /></div>
				</td>
			</tr>
		</table>
	</div>
</div>
