<div class="unselectable" style="position: absolute; left: 100px; top: 50px; z-index: 1;">
	<h3 style="font-size: 30px; cursor: pointer;" id="prev-area">&lt; <u id="prev-area-label">MY ACCOUNT</u></h3>
</div>

<div class="unselectable" style="position: absolute; right: 100px; top: 50px; z-index: 1;">
	<h3 style="font-size: 30px; cursor: pointer;" id="next-area"><u id="next-area-label">MY FILES</u> &gt;</h3>
</div>

<div id="contents" style="overflow: hidden; text-align: left;">
	<div id="account-content" style="position: fixed; left: -3000px; display: none; width: 100%; text-align: center;" next="main" name="My Account">
		<?= $my_account; ?>
	</div>

	<div id="main-content" style="position: static; left: 0px; display: inline-block; width: 100%; text-align: center;" prev="account" next="files" name="File Upload">
		<?= $file_upload; ?>
	</div>

	<div id="files-content" style="position: fixed; left: 0px; display: none; width: 100%; text-align: center;" prev="main" name="My Files">
		<?= $my_files; ?>
	</div>
</div>