<h1><?= __('Upload New Photo To Account'); ?></h1>
You've used <?=Core::$user->photos->where('hide', '=', 'No')->find_all()->count(); ?> of your 100 total photo slots.<br /><br />
<?php if (Core::$user->photos->where('hide', '=', 'No')->find_all()->count() >= 100): ?>
You have used up all your available upload space, go to <?= HTML::anchor('user/control_panel/manage_photos', 'Manage Photos'); ?> to delete your old photos and make room for newer ones.
<?php else: ?>
<?php
echo Form::open(NULL, array('enctype' => 'multipart/form-data'));
echo Form::file('picture') . '<br />';
echo Form::checkbox('avatar', 'TRUE', TRUE) . ' Set this photo as avatar picture<br /><br />';
echo "All uploaded photos will not appear on the site until manually approved by staff.  Only PG-13 pictures may be set at an avatar, if a photo is set to be an avatar photo and is approved but adult and not PG-13 it will still show in your uploaded photos but not as your avatar.<br /><br />";
echo Form::submit('submit', 'Upload Photo');
echo Form::close();
?>
<?php endif; ?>