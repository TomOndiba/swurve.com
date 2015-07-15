<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
    $('#register').submit(function() {
        $('#country_id').val($('#country').val());
        $('#region_id').val($('#region').val());
        //$('#city_id').val($('#city').val());
    });
});
</script>
<h1><?= __('Search for your Swurve match'); ?></h1>
<div style="margin-left: 120px;">
<h3 class="blue">Search Criteria</h3>
<?php
echo Form::open('user/search/results', array('id' => 'register', 'method' => 'get'));
echo Form::hidden('country_id', NULL, array('id' => 'country_id'));
echo Form::hidden('region_id', NULL, array('id' => 'region_id'));
echo Form::hidden('city_id', NULL, array('id' => 'city_id'));
?>
<fieldset>
<?php
$users_table = ORM::factory('user');

echo Form::label('country', 'Country:');
echo Form::select('country', $locations['countries'], NULL, array('id' => 'country'));
echo (empty ($errors['country'])) ? '<br />' : '<br /><span class="errors">' . $errors['country'] . '</span>';

echo Form::label('region', 'Region:');
echo Form::select('region', $locations['regions'], NULL, array('id' => 'region'));
echo (empty ($errors['region'])) ? '<br />' : '<br /><span class="errors">' . $errors['region'] . '</span>';

echo Form::label('city', 'City:');
echo Form::input('city', 'Enter A City', array('id' => 'city', 'disabled' => 'disabled'));
//echo Form::select('city', array('Select A City'), NULL, array('id' => 'city', 'disabled' => 'disabled'));
echo (empty ($errors['city'])) ? '<br />' : '<br /><span class="errors">' . $errors['city'] . '</span>';

//echo Form::label('birthdate', 'Birthdate:');
//echo Form::input('birthdate', $post['birthdate']);
//echo (empty ($errors['birthdate'])) ? '<br />' : '<br /><span class="errors">' . $errors['birthdate'] . '</span>';

echo Form::label('gender', 'Gender:');
echo Form::radio('gender', 'Male', FALSE, array('id' => 'gender_male', 'class' => 'gender')) . Form::label('gender_male', 'Male', array('class' => 'genders')) .  ' ' . Form::radio('gender', 'Female', FALSE, array('id' => 'gender_female', 'class' => 'gender')) . Form::label('gender_female', 'Female', array('class' => 'genders'));
echo (empty ($errors['gender'])) ? '<br />' : '<br /><span class="errors">' . $errors['gender'] . '</span>';

echo Form::label('interested_in', 'Interest In:');
echo Form::select('interested_in', $users_table->enum_field_values('interested_in', 'Select A Interest'), NULL, array('id' => 'interested_in'));
echo (empty ($errors['interested_in'])) ? '<br />' : '<br /><span class="errors">' . $errors['interested_in'] . '</span>';

//echo Form::label('height', 'Height:');
//echo Form::input('height', $post['height']);
//echo (empty ($errors['height'])) ? '<br />' : '<br /><span class="errors">' . $errors['height'] . '</span>';

echo Form::label('body_type', 'Body Type:');
echo Form::select('body_type', $users_table->enum_field_values('body_type', 'Select A Body Type'), NULL, array('id' => 'body_type'));
echo (empty ($errors['body_type'])) ? '<br />' : '<br /><span class="errors">' . $errors['body_type'] . '</span>';

echo Form::label('hair_color', 'Hair Color:');
echo Form::select('hair_color', $users_table->enum_field_values('hair_color', 'Select A Hair Color'), NULL, array('id' => 'hair_color'));
echo (empty ($errors['hair_color'])) ? '<br />' : '<br /><span class="errors">' . $errors['hair_color'] . '</span>';

echo Form::label('eye_color', 'Eye Color:');
echo Form::select('eye_color', $users_table->enum_field_values('eye_color', 'Select A Eye Color'), NULL, array('id' => 'eye_color'));
echo (empty ($errors['eye_color'])) ? '<br />' : '<br /><span class="errors">' . $errors['eye_color'] . '</span>';

echo Form::label('ethnicity', 'Ethnicity:');
echo Form::select('ethnicity', $users_table->enum_field_values('ethnicity', 'Select A Ethnicity'), NULL, array('id' => 'ethnicity'));
echo (empty ($errors['ethnicity'])) ? '<br />' : '<br /><span class="errors">' . $errors['ethnicity'] . '</span>';

echo Form::label('relationship_status', 'Relationship:');
echo Form::select('relationship_status', $users_table->enum_field_values('relationship_status', 'Select A Relationship'), NULL, array('id' => 'relationship_status'));
echo (empty ($errors['relationship_status'])) ? '<br />' : '<br /><span class="errors">' . $errors['relationship_status'] . '</span>';

echo Form::label('smoke', 'Smoke:');
echo Form::radio('smoke', 'No', FALSE, array('id' => 'smoke_no', 'class' => 'gender')) . Form::label('smoke_no', 'No', array('class' => 'genders')) .  ' ' . Form::radio('gender', 'Yes', FALSE, array('id' => 'smoke_yes', 'class' => 'gender')) . Form::label('smoke_yes', 'Yes', array('class' => 'genders'));
echo (empty ($errors['smoke'])) ? '<br />' : '<br /><span class="errors">' . $errors['smoke'] . '</span>';

echo Form::label('drink', 'Drink:');
echo Form::radio('drink', 'No', FALSE, array('id' => 'drink_no', 'class' => 'gender')) . Form::label('drink_no', 'No', array('class' => 'genders')) .  ' ' . Form::radio('drink', 'Yes', FALSE, array('id' => 'drink_yes', 'class' => 'gender')) . Form::label('drink_yes', 'Yes', array('class' => 'genders'));
echo (empty ($errors['drink'])) ? '<br />' : '<br /><span class="errors">' . $errors['drink'] . '</span>';

echo Form::label('first_date_sex', 'First Date Sex:');
echo Form::select('first_date_sex', $users_table->enum_field_values('first_date_sex', 'Select A Option'), NULL, array('id' => 'first_date_sex'));
echo (empty ($errors['first_date_sex'])) ? '<br />' : '<br /><span class="errors">' . $errors['first_date_sex'] . '</span>';

echo '<center>';
echo Form::submit('register-submit', 'Search', array('id' => 'search-submit'));
echo '</center><br />';
?>
</fieldset>
<?php
echo Form::close();
?>
</div>