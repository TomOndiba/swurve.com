<div style="display: inline-block; margin: 0 auto; text-align: left;">
	<h3 style="font-size: 20px; text-decoration: underline; margin-left: 10px;">Files of "<?= $user->usr_login; ?>"</h3>
	<div style="margin-top: 5px;">
		<?php
			if (isset($_GET['fld_id']))
			{
				$files = $user->files->where('file_fld_id', '=', $_GET['fld_id'])->and_where('file_public', '=', '1')->order_by('file_name', 'ASC')->find_all();
				$folders = $user->folders->where('fld_parent_id', '=', $_GET['fld_id'])->order_by('fld_name', 'ASC')->find_all();
				$curr_folder = $user->folders->where('fld_id', '=', $_GET['fld_id'])->find();

				$filecount = $user->files->where('file_fld_id', '=', $curr_folder->fld_parent_id)->and_where('file_public', '=', '1')->count_all();
			}
			else
			{
				$files = $user->files->where('file_fld_id', '=', 0)->and_where('file_public', '=', '1')->order_by('file_name', 'ASC')->find_all();
				$folders = $user->folders->where('fld_parent_id', '=', 0)->order_by('fld_name', 'ASC')->find_all();
			}

			$count = 0;
			$size = 0;

			foreach ($files as $file)
			{
				$count += 1;
				$size += $file->file_size;
			}
		?>
		<div style="float: left; margin-top: 7px;" id="file-stats"><strong style="font-weight: bold;"><?= $count; ?></strong> files totalling <strong style="font-weight: bold;"><?= Functions::byteSize($size); ?></strong></div>
		<div style="clear: both;"></div>
		<table width="600" cellpadding="0" cellspacing="0" id="my-file-list">
			<tr>
				<td class="table-header" style="border-radius: 5px 0 0 0;">Name</td>
				<td align="center" class="table-header">Size</td>
				<td align="center" class="table-header">DLs</td>
				<td align="center" class="table-header">Cmts</td>
				<td class="table-header" width="130" style="border-radius: 0 5px 0 0;">Upload Date</td>
			</tr>

			<?php if (isset($_GET['fld_id']) AND $_GET['fld_id'] != 0): ?>
			<tr style="background-color: #<?= Text::alternate('FFFFFF', 'F3F3F3'); ?>;">
				<td style="padding-left: 5px;"><img style="vertical-align: text-bottom;" src="http://dev-host.org/images/folder.gif" /> <?= HTML::anchor('/users/' . $user->usr_login . '/?fld_id=' . $curr_folder->fld_parent_id . '#files', '..'); ?></td>
				<td colspan="4" align="center"><?= $filecount; ?> Files</td>
			</tr>
			<?php endif; ?>

			<?php foreach($folders as $folder): ?>
			<tr style="background-color: #<?= Text::alternate('FFFFFF', 'F3F3F3'); ?>;" data-fld_id="<?= $folder->fld_id; ?>">
				<td style="padding-left: 5px;"><img style="vertical-align: text-bottom;" src="http://dev-host.org/images/folder.gif" /> <?= HTML::anchor('/users/' . $user->usr_login . '/?fld_id=' . $folder->fld_id . '#files', $folder->fld_name); ?></td>
				<td colspan="4" align="center"><?= $folder->files->where('file_public', '=', '1')->count_all(); ?> Files</td>
			</tr>
			<?php endforeach; ?>
			<?php if (count($files) == 0): ?>
			<tr style="background-color: #<?= Text::alternate('FFFFFF', 'F3F3F3'); ?>;">
				<td align="center" colspan="5">No files found in this folder.</td>
			</tr>
			<?php endif; ?>
			<?php foreach($files as $file): ?>
			<tr style="background-color: #<?= Text::alternate('FFFFFF', 'F3F3F3'); ?>;">
				<td><div title="<?= $file->file_name; ?>" style="padding: 2px 3px 2px; text-overflow: ellipsis; overflow:hidden; white-space: nowrap; width: 280px;"><?= HTML::anchor('/' . $file->file_code, $file->file_name); ?></div></td>
				<td align="center"><?= Functions::byteSize($file->file_size); ?></td>
				<td align="center"><?= $file->file_downloads; ?></td>
				<td align="center"><?= HTML::anchor('/' . $file->file_code . '#comments', $file->comments->count_all()); ?></td>
				<td><?= $file->file_created; ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>
