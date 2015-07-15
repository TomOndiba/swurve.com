<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
    $('#male').click(function() {
        $(this).attr('src', '/assets/img/registration/button-male-active.png')
        $('#female').attr('src', '/assets/img/registration/button-female.png')
        $('#gender').val('Male');
    });

    $('#female').click(function() {
        $(this).attr('src', '/assets/img/registration/button-female-active.png')
        $('#male').attr('src', '/assets/img/registration/button-male.png')
        $('#gender').val('Female');
    });

    $('#register').submit(function() {
        $('#country_id').val($('#country').val());
        $('#region_id').val($('#region').val());
        //$('#city_id').val($('#city').val());
    });

    <?php if (isset($post['gender']) AND ! empty($post['gender'])): ?>
    $('#<?= strtolower($post['gender']); ?>').click();
    <?php endif; ?>

    <?php if (isset($post['city_id']) AND ! empty($post['city_id'])): ?>
    $.getJSON('/json/getname/<?= $post['city_id']; ?>', null, function(data)
    {
        $('#city').val(data.result[0]['name']);
    });
    <?php endif; ?>
});
</script>
<div style="margin: 0 auto; width: <?= Request::instance()->action == 'register' ? '533' : '480'; ?>px;">
<?php if (Request::instance()->action == 'register'): ?><?=HTML::image('assets/img/registration/fast-simple-no-hassle-registration.png', array('alt' => 'Fast Simple No-Hassle Free Registration', 'style' => 'margin-bottom: 15px;')); ?><?php endif; ?>
<?= Form::open("/user/register" . (Request::instance()->action == 'iregister' ? '?a=' . $_GET['a'] : ''), array('id' => 'register', 'target' => '_parent')); ?>
<?= Form::hidden('country_id', NULL, array('id' => 'country_id')); ?>
<?= Form::hidden('region_id', NULL, array('id' => 'region_id')); ?>
<?= Form::hidden('city_id', (isset($post['city_id'])) ? $post['city_id'] : NULL, array('id' => 'city_id')); ?>
<fieldset>
<?php if (Request::instance()->action == 'register'): ?><div id="tooltip"></div><?php endif; ?>
<div<?php if (Request::instance()->action == 'register'): ?> style="margin-left: 58px;"<?php endif; ?>>
<?php
$users_table = ORM::factory('user');

echo Form::label('gender', 'Gender:');
echo Form::hidden('gender', '', array('id' => 'gender'));
echo HTML::image('assets/img/registration/button-male.png', array('style' => 'margin-left: 15px;', 'id' => 'male'));
echo HTML::image('assets/img/registration/button-female.png', array('style' => 'margin-left: 50px;', 'id' => 'female'));
echo (empty ($errors['gender'])) ? '<br />' : '<br /><span class="errors">' . $errors['gender'] . '</span>';

echo Form::label('interested_in', 'Interested In:');
echo Form::select('interested_in', $users_table->enum_field_values('interested_in', 'Select A Interest'), isset($post['interested_in']) ? $post['interested_in'] : NULL, array('id' => 'interested_in'));
echo (empty ($errors['interested_in'])) ? '<br />' : '<br /><span class="errors">' . $errors['interested_in'] . '</span>';

if (Request::instance()->action == 'register')
{
?>
<?php
}
else
{
    echo Form::hidden('seeking[]', '6');
}

echo Form::label('birthdate', 'Birthdate:');
echo Form::select('birthmonth', Functions::get_months(), isset($post['birthmonth']) ? $post['birthmonth'] : NULL, array('class' => 'date'));
echo Form::select('birthday', Functions::get_days(), isset($post['birthday']) ? $post['birthday'] : NULL, array('class' => 'date'));
echo Form::select('birthyear', Functions::get_years(), isset($post['birthyear']) ? $post['birthyear'] : NULL, array('class' => 'date'));
echo '<br /><span class="hint">Usage by individuals under 18 is strictly prohibited</span>';
echo (empty ($errors['birthdate'])) ? '' : '<span class="errors">' . $errors['birthdate'] . '</span>';

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
echo Form::input('username', isset($post['username']) ? $post['username'] : NULL, array('id' => 'username', 'maxlength' => '25'));
echo (empty ($errors['username'])) ? '<br />' : '<br /><span class="errors">' . $errors['username'] . '</span>';

echo Form::label('password', 'Password:');
echo Form::password('password', isset($post['password']) ? $post['password'] : NULL, array('id' => 'password', 'maxlength' => '25'));
echo '<br /><span class="hint">6-character minimum; case sensitive</span>';
echo (empty ($errors['password'])) ? '' : '<span class="errors">' . $errors['password'] . '</span>';

echo Form::label('password_confirm', 'Confirm Pass:');
echo Form::password('password_confirm', isset($post['password_confirm']) ? $post['password_confirm'] : NULL, array('id' => 'password_confirm', 'maxlength' => '25'));
echo (empty ($errors['password_confirm'])) ? '<br />' : '<span class="errors">' . $errors['password_confirm'] . '</span>';

echo Form::label('email', '<font color="red">*</font>Email:');
echo Form::input('email', isset($post['email']) ? $post['email'] : NULL, array('id' => 'email'));
echo '<br /><span class="required">*A valid email address is required for activation</span>';
echo (empty ($errors['email'])) ? '' : '<span class="errors">' . $errors['email'] . '</span>';

echo Form::checkbox('tos', 'yes', (isset($post['tos'])) ? TRUE : FALSE, array('id' => 'tos')) . 'I have read and agree to the ' . HTML::anchor('terms', 'Terms of Service', array('target' => '_blank')) . ' for this website';
echo (empty ($errors['tos'])) ? '<br>' : '<br><span class="errors">' . $errors['tos'] . '</span><br>';

echo Form::input('register-submit', 'Register', array('id' => 'register-submit', 'type' => 'image', 'src' => '/assets/img/registration/button-form-submit.png'));
echo '<br />';
?>
</div>
</fieldset>
<?= Form::close(); ?>
</div>