<h1><?= __('Congratulations! Your activation code is on it\'s way!'); ?></h1>
<small>*Didn't recieve your activation code at <?= Core::$user->email; ?>? <?= HTML::anchor('user/resend/activation', 'Click here'); ?> to correct and resubmit</small><br /><br /><br />

<h3 class="blue">Create your Avatar / Upload Your Photo</h3>
<?php 
echo Form::open(NULL, array('enctype' => 'multipart/form-data'));
echo 'Avatar Photo: ' . Form::file('picture', array('style' => 'width: 400px;')) . '<br />';
echo (empty ($errors['picture'])) ? '<br />' : '<span class="error">' . $errors['picture'] . '</span><br />';
echo Form::hidden('avatar', 'TRUE');
echo "Uploaded photos will not appear on the site until they have been manually approved by staff.  Only PG-13 pictures may be set at an avatar, your main profile photo should contain no nudity or explicit content.<br /><br />";
echo Form::checkbox('confirm', 'YES', TRUE) . ' I affirm that I have the right to distribute and that I am the individual depicted in the attached photo.<br />';
echo (empty ($errors['confirm'])) ? '<br />' : '<span class="error">' . $errors['confirm'] . '</span><br />';
echo '<center>' . Form::submit('submit', 'Upload/Continue') . '<br><br>';
echo 'No photo? ' . HTML::anchor('user/' . Request::instance()->action . '/3', 'Click here') . ' to continue.</center>';
echo Form::close();
?>