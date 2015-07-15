<h1><?= __('Upload New Photo'); ?></h1>
You've used <?=Core::$user->photos->where('hide', '=', 'No')->find_all()->count(); ?> of your 100 total photo slots.<br /><br />
<?php if (Core::$user->photos->where('hide', '=', 'No')->find_all()->count() >= 100): ?>
You have used up all your available upload space, go to <?= HTML::anchor('user/control_panel/manage_photos', 'Manage Photos'); ?> to delete your old photos and make room for newer ones.
<?php else: ?>
<?php
echo Form::open('user/control_panel/upload_photo', array('enctype' => 'multipart/form-data'));
echo Form::file('picture') . '<br />';
echo Form::checkbox('avatar', 'TRUE') . ' Set this photo as avatar picture<br /><br />';
echo "All uploaded photos will not appear on the site until manually approved by staff.  Only PG-13 pictures may be set at an avatar, if a photo is set to be an avatar photo and is approved but adult and not PG-13 it will still show in your uploaded photos but not as your avatar.<br /><br />";
echo Form::submit('submit', 'Upload Photo');
echo Form::close();
?>
<?php endif; ?>
<br /><br /><br /><br />
<h1><?= __('Manage Your Uploaded Photos'); ?></h1>
<small>Reminder: Only PG-13 Photos may be set as default.</small><br /><br />
<?= Form::open(NULL); ?>
<?php foreach($photos as $photo): ?>
<div style="margin: 2px; width: 119px; float: left; border-top: 1px solid white; border-left: 1px solid white; border-right: 1px solid grey; border-bottom: 1px solid grey; ">
    <?= HTML::anchor('photo/' . $user->username . '/' . $photo->uniqueid, HTML::image(Content::factory($user->username)->get_photo($photo->uniqueid, 's', TRUE))); ?>
    <div style="font-size: 10px; ">
        Approved: <?=$photo->approved; ?><br />
        Delete photo: <?= form::checkbox('delete[]', $photo); ?><br />
        Set as default: <?= Form::radio('default', $photo, ($user->avatar == $photo) ? TRUE : FALSE, ($photo->approved != 'PG-13') ? array('disabled' => 'disabled') : NULL); ?>
    </div>
</div>
<?php endforeach; ?>
<?php if ($photos->count()): ?>
<br /><br /><div style="text-align: center; width: 100%; padding-top: 10px; clear: both"><?= Form::submit('update', 'Update'); ?></div>
<?php endif; ?>
<?= Form::close(); ?>