<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<style>
    textarea {
        display: block;
        width: 440px;
        height: 100px;
    }

    #heightslider {
        width: 182px;
    }

    #heightdisplay {
        border:0; 
        color:#000; 
        font-size: 14px !important; 
        background-color: #FAF5F9; 
        font-weight: bold !important;
        width: 35px !important;
    }

    #slidercontainer {
        position: absolute;
        display: inline;
        margin-top: 8px;
    }
</style>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
    $("#heightslider").slider({
        value:0,
        min: 36,
        max: 96,
        step: 1,
        slide: function(event, ui) {
            $("#height").val(ui.value);
            $("#heightdisplay").val(Math.floor(ui.value / 12) + '"' + ui.value % 12 + '\'');
        }
    });
});
</script>
<h1 style="text-align: center;"><?= __('Complete your profile to get better results!'); ?></h1>
<div style="margin-left: 230px;">
<?php
echo Form::open(NULL, array('id' => 'register'));
?>
<fieldset>
<div style="margin-left: 28px;">
<?php
$users_table = ORM::factory('user');

echo Form::label('height', 'Height:');
echo Form::hidden('height', NULL, array('id' => 'height'));
echo '<input type="text" id="heightdisplay" /> <div id="slidercontainer"><div id="heightslider"></div></div>';
echo (empty ($errors['height'])) ? '<br />' : '<br /><span class="errors">' . $errors['height'] . '</span>';

echo Form::label('body_type', 'Body Type:');
echo Form::select('body_type', $users_table->enum_field_values('body_type', 'Select A Body Type'), $post['body_type'], array('id' => 'body_type'));
echo (empty ($errors['body_type'])) ? '<br />' : '<br /><span class="errors">' . $errors['body_type'] . '</span>';

echo Form::label('eye_color', 'Eye Color:');
echo Form::select('eye_color', $users_table->enum_field_values('eye_color', 'Select A Eye Color'), $post['eye_color'], array('id' => 'eye_color'));
echo (empty ($errors['eye_color'])) ? '<br />' : '<br /><span class="errors">' . $errors['eye_color'] . '</span>';

echo Form::label('hair_color', 'Hair Color:');
echo Form::select('hair_color', $users_table->enum_field_values('hair_color', 'Select A Hair Color'), $post['hair_color'], array('id' => 'hair_color'));
echo (empty ($errors['hair_color'])) ? '<br />' : '<br /><span class="errors">' . $errors['hair_color'] . '</span>';

echo Form::label('ethnicity', 'Ethnicity:');
echo Form::select('ethnicity', $users_table->enum_field_values('ethnicity', 'Select A Ethnicity'), $post['ethnicity'], array('id' => 'ethnicity'));
echo (empty ($errors['ethnicity'])) ? '<br />' : '<br /><span class="errors">' . $errors['ethnicity'] . '</span>';

echo Form::label('first_date_sex', 'First Date Sex:');
echo Form::select('first_date_sex', $users_table->enum_field_values('first_date_sex', 'Select A Option'), $post['first_date_sex'], array('id' => 'first_date_sex'));
echo (empty ($errors['first_date_sex'])) ? '<br />' : '<br /><span class="errors">' . $errors['first_date_sex'] . '</span>';

echo Form::label('smoke', 'Smoke:');
echo Form::radio('smoke', 'No', (isset($post['smoke']) AND $post['smoke'] == 'No') ? TRUE : FALSE, array('id' => 'smoke_no', 'class' => 'gender')) . Form::label('smoke_no', 'No', array('class' => 'genders')) .  ' ' . Form::radio('smoke', 'Yes', (isset($post['smoke']) AND $post['smoke'] == 'Yes') ? TRUE : FALSE, array('id' => 'smoke_yes', 'class' => 'gender')) . Form::label('smoke_yes', 'Yes', array('class' => 'genders'));
echo (empty ($errors['smoke'])) ? '<br />' : '<br /><span class="errors">' . $errors['smoke'] . '</span>';

echo Form::label('drink', 'Drink:');
echo Form::radio('drink', 'No', (isset($post['drink']) AND $post['drink'] == 'No') ? TRUE : FALSE, array('id' => 'drink_no', 'class' => 'gender')) . Form::label('drink_no', 'No', array('class' => 'genders')) .  ' ' . Form::radio('drink', 'Yes', (isset($post['drink']) AND $post['drink'] == 'Yes') ? TRUE : FALSE, array('id' => 'drink_yes', 'class' => 'gender')) . Form::label('drink_yes', 'Yes', array('class' => 'genders'));
echo (empty ($errors['drink'])) ? '<br />' : '<br /><span class="errors">' . $errors['drink'] . '</span>';

echo Form::label('headline', 'Headline:');
echo Form::input('headline', $post['headline'], array('id' => 'headline'));
echo (empty ($errors['headline'])) ? '<br />' : '<br /><span class="errors">' . $errors['headline'] . '</span>';

echo Form::label('description', 'Description:');
echo Form::textarea('description', $post['description'], array('id' => 'description'));
echo (empty ($errors['description'])) ? '<br />' : '<br /><span class="errors">' . $errors['description'] . '</span>';

echo Form::input('register-submit', 'Register', array('id' => 'register-submit', 'type' => 'image', 'src' => '/assets/img/registration/button-form-submit.png'));
echo '<br />';
?>
</div>
</fieldset>
<?php
echo Form::close();
?>
</div>