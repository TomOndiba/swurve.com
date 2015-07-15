<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
    $('#register').submit(function() {
        $('#country_id').val($('#country').val());
        $('#region_id').val($('#region').val());
        //$('#city_id').val($('#city').val());
    });

    <?php if (isset($post['city_id']) AND ! empty($post['city_id'])): ?>
    $.getJSON('/json/getname/<?= $post['city_id']; ?>', null, function(data)
    {
        $('#city').val(data.result[0]['name']);
    });
    <?php endif; ?>
});
</script>
<h1 style="text-align: center;">Your just one step away from getting paid to chat!</h1>
<p style="width: 800px; margin: 0 auto;">Please create your Chat Hostess profile. This is the profile that will represent you to other users on the service. You may disclose as little or as much about yourself as you like. You can use your own details or a fictional information, such as listing yourself at your own location or one that you are familiar with instead. Keep in mind that your physical characteristics should match the photos you plan to upload and photos added to your Chat Hostess profile must be of yourself.</p><br />

<div style="margin-left: 230px;">
<?= Form::open(NULL, array('id' => 'register')); ?>
<?= Form::hidden('country_id', NULL, array('id' => 'country_id')); ?>
<?= Form::hidden('region_id', NULL, array('id' => 'region_id')); ?>
<?= Form::hidden('city_id', (isset($post['city_id'])) ? $post['city_id'] : NULL, array('id' => 'city_id')); ?>
<fieldset>

<div style="margin-left: 28px;">
<?php
$users_table = ORM::factory('user');

echo Form::hidden('gender', 'Female');
echo Form::hidden('email', Core::$camgirl->email);
echo Form::hidden('tos', 'yes');

echo Form::label('interested_in', 'Interested In:');
echo Form::select('interested_in', $users_table->enum_field_values('interested_in', 'Select A Interest'), $post['interested_in'], array('id' => 'interested_in'));
echo (empty ($errors['interested_in'])) ? '<br />' : '<br /><span class="errors">' . $errors['interested_in'] . '</span>';

echo Form::label('orientation', 'Orientation:');
echo Form::select('orientation', $users_table->enum_field_values('orientation', 'Select A Orientation'), $post['orientation'], array('id' => 'orientation'));
echo (empty ($errors['orientation'])) ? '<br />' : '<br /><span class="errors">' . $errors['orientation'] . '</span>';

echo Form::label('relationship_status', 'Status:');
echo Form::select('relationship_status', $users_table->enum_field_values('relationship_status', 'Select A Status'), $post['relationship_status'], array('id' => 'relationship_status'));
echo (empty ($errors['relationship_status'])) ? '<br />' : '<br /><span class="errors">' . $errors['relationship_status'] . '</span>';

echo Form::label('seeking', 'seeking:');
?>
<ul id="seeking">
<?php foreach($seeking as $type): ?>
    <li><?=Form::checkbox('seeking[]', $type, (isset($post['seeking'])) ? in_array($type, $post['seeking']) : FALSE); ?> <?=$type->type; ?></li>
<?php endforeach; ?>
</ul>
<div class="clear"></div>
<?php
echo (empty ($errors['seeking'])) ? '' : '<span class="errors">' . $errors['seeking'] . '</span>';

echo Form::label('birthdate', 'Birthdate:');
echo Form::select('birthmonth', Functions::get_months(), $post['birthmonth'], array('class' => 'date'));
echo Form::select('birthday', Functions::get_days(), $post['birthday'], array('class' => 'date'));
echo Form::select('birthyear', Functions::get_years(), $post['birthyear'], array('class' => 'date'));
echo (empty ($errors['birthdate'])) ? '<br />' : '<span class="errors">' . $errors['birthdate'] . '</span>';

echo Form::label('country', 'Country:');
echo Form::select('country', $location['country'], (isset($post['country_id'])) ? $post['country_id'] : NULL, array('id' => 'country'));
echo (empty ($errors['country_id'])) ? '<br />' : '<br /><span class="errors">' . $errors['country_id'] . '</span>';

echo Form::label('region', 'Region:');
echo Form::select('region', $location['region'], (isset($post['region_id'])) ? $post['region_id'] : NULL, array('id' => 'region') + ((count($location['region']) == 1) ? array('disabled' => 'disabled') : array()));
echo (empty ($errors['region_id'])) ? '<br />' : '<br /><span class="errors">' . $errors['region_id'] . '</span>';

echo Form::label('city', 'City:');
echo Form::input('city', 'Enter A City', array('id' => 'city') + ((count($location['city']) == 1) ? array('disabled' => 'disabled') : array()));
//echo Form::select('city', $location['city'], (isset($post['city_id'])) ? $post['city_id'] : NULL, array('id' => 'city') + ((count($location['city']) == 1) ? array('disabled' => 'disabled') : array()));
echo (empty ($errors['city_id'])) ? '<br />' : '<br /><span class="errors">' . $errors['city_id'] . '</span>';
/*
echo Form::label('height', 'Height:');
echo Form::input('height', $post['height']);
echo (empty ($errors['height'])) ? '<br />' : '<br /><span class="errors">' . $errors['height'] . '</span>';

echo Form::label('body_type', 'Body Type:');
echo Form::select('body_type', $users_table->enum_field_values('body_type', 'Select A Body Type'), $post['body_type'], array('id' => 'body_type'));
echo (empty ($errors['body_type'])) ? '<br />' : '<br /><span class="errors">' . $errors['body_type'] . '</span>';

echo Form::label('hair_color', 'Hair Color:');
echo Form::select('hair_color', $users_table->enum_field_values('hair_color', 'Select A Hair Color'), $post['hair_color'], array('id' => 'hair_color'));
echo (empty ($errors['hair_color'])) ? '<br />' : '<br /><span class="errors">' . $errors['hair_color'] . '</span>';

echo Form::label('eye_color', 'Eye Color:');
echo Form::select('eye_color', $users_table->enum_field_values('eye_color', 'Select A Eye Color'), $post['eye_color'], array('id' => 'eye_color'));
echo (empty ($errors['eye_color'])) ? '<br />' : '<br /><span class="errors">' . $errors['eye_color'] . '</span>';

echo Form::label('ethnicity', 'Ethnicity:');
echo Form::select('ethnicity', $users_table->enum_field_values('ethnicity', 'Select A Ethnicity'), $post['ethnicity'], array('id' => 'ethnicity'));
echo (empty ($errors['ethnicity'])) ? '<br />' : '<br /><span class="errors">' . $errors['ethnicity'] . '</span>';

echo Form::label('smoke', 'Smoke:');
echo Form::radio('smoke', 'No', ($post['smoke'] == 'No') ? TRUE : FALSE, array('id' => 'smoke_no', 'class' => 'gender')) . Form::label('smoke_no', 'No', array('class' => 'genders')) .  ' ' . Form::radio('smoke', 'Yes', ($post['smoke'] == 'Yes') ? TRUE : FALSE, array('id' => 'smoke_yes', 'class' => 'gender')) . Form::label('smoke_yes', 'Yes', array('class' => 'genders'));
echo (empty ($errors['smoke'])) ? '<br />' : '<br /><span class="errors">' . $errors['smoke'] . '</span>';

echo Form::label('drink', 'Drink:');
echo Form::radio('drink', 'No', ($post['drink'] == 'No') ? TRUE : FALSE, array('id' => 'drink_no', 'class' => 'gender')) . Form::label('drink_no', 'No', array('class' => 'genders')) .  ' ' . Form::radio('drink', 'Yes', ($post['drink'] == 'Yes') ? TRUE : FALSE, array('id' => 'drink_yes', 'class' => 'gender')) . Form::label('drink_yes', 'Yes', array('class' => 'genders'));
echo (empty ($errors['drink'])) ? '<br />' : '<br /><span class="errors">' . $errors['drink'] . '</span>';

echo Form::label('first_date_sex', 'First Date Sex:');
echo Form::select('first_date_sex', $users_table->enum_field_values('first_date_sex', 'Select A Option'), $post['first_date_sex'], array('id' => 'first_date_sex'));
echo (empty ($errors['first_date_sex'])) ? '<br />' : '<br /><span class="errors">' . $errors['first_date_sex'] . '</span>';
*/
echo Form::label('username', 'Username:');
echo Form::input('username', $post['username'], array('id' => 'username', 'maxlength' => '25'));
echo (empty ($errors['username'])) ? '<br />' : '<br /><span class="errors">' . $errors['username'] . '</span>';

echo Form::label('password', 'Password:');
echo Form::password('password', $post['password'], array('id' => 'password', 'maxlength' => '25'));
echo '<br /><span class="hint">6-character minimum; case sensitive</span>';
echo (empty ($errors['password'])) ? '' : '<span class="errors">' . $errors['password'] . '</span>';

echo Form::label('password_confirm', 'Confirm Pass:');
echo Form::password('password_confirm', $post['password_confirm'], array('id' => 'password_confirm', 'maxlength' => '25'));
echo (empty ($errors['password_confirm'])) ? '<br />' : '<span class="errors">' . $errors['password_confirm'] . '</span>';

echo Form::input('register-submit', 'Register', array('id' => 'register-submit', 'type' => 'image', 'src' => '/assets/img/registration/button-form-submit.png'));
echo '<br />';
?>
</div>
</fieldset>
<?= Form::close(); ?>
</div>