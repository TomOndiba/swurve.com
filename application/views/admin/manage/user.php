<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<style>
#male, #female {
    cursor: pointer;
}

#seeking {
    position: relative;
    margin-top: -25px;
    left: 120px;
    width: 400px;
    display: block;
}

#seeking li {
    float: left;
    width: 150px;
    font-size: 11px;
    line-height: 12px;
}

#seeking input {
    width: 15px !important;
}

#tos {
    width: 25px !important;
}

.clear2 {
    clear: both;
    padding-top: 10px;
}

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
    background-color: #F4EBDF;
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

    $("#heightslider").slider({
        value: <?= (isset($post['height'])) ? $post['height'] : 0; ?>,
        min: 36,
        max: 96,
        step: 1,
        slide: function(event, ui) {
            $("#height").val(ui.value);
            $("#heightdisplay").val(Math.floor(ui.value / 12) + '"' + ui.value % 12 + '\'');
        }
    });

    <?php if (isset($post['height'])): ?>
    var value = $('#heightslider').slider('option', 'value');

    $("#height").val(value);
    $("#heightdisplay").val(Math.floor(value / 12) + '"' + value % 12 + '\'');
    <?php endif; ?>

    $('#<?= strtolower($post['gender']); ?>').click();
    //$('#country').val('?= ORM::factory('country', $post['country_id'])->code; ?>');

    <?php if (isset($post['city_id']) AND ! empty($post['city_id'])): ?>
    $.getJSON('/json/getname/<?= $post['city_id']; ?>', null, function(data)
    {
        $('#city').val(data.result[0]['name']);
        $('#city_id').val(<?= $post['city_id']; ?>);
    });
    <?php endif; ?>

    $('#register').submit(function() {
        $('#country_id').val($('#country').val());
        $('#region_id').val($('#region').val());
        //$('#city_id').val($('#city').val());
    });
});
</script>

<h1>Edit <?= $post['username']; ?>'s Swurve Profile</h1>

<div style="margin-left: 75px;">
<?= Form::open(NULL, array('id' => 'register')); ?>
<fieldset>
<div id="tooltip"></div>
<div style="margin-left: 28px;">
<h3>Account Information</h3>
<?php
$users_table = ORM::factory('user');
$seeking = ORM::factory('relationship_type')->order_by('type')->find_all();

echo Form::hidden('country_id', (isset($post['country_id'])) ? $post['country_id'] : NULL, array('id' => 'country_id'));
echo Form::hidden('region_id', (isset($post['region_id'])) ? $post['region_id'] : NULL, array('id' => 'region_id'));
echo Form::hidden('city_id', (isset($post['city_id'])) ? $post['city_id'] : NULL, array('id' => 'city_id'));

echo Form::label('userid', 'User ID:');
echo $post['id'] . '<br />';

echo Form::label('username', 'Username:');
echo Form::input('username', $post['username'], array('id' => 'username', 'maxlength' => '25'));
echo (empty ($errors['username'])) ? '<br />' : '<br /><span class="errors">' . $errors['username'] . '</span>';

echo Form::label('password', 'Password:');
echo Form::password('password', NULL, array('id' => 'password', 'maxlength' => '25'));
echo '<br /><span class="hint">6-character minimum; case sensitive</span>';
echo (empty ($errors['password'])) ? '' : '<span class="errors">' . $errors['password'] . '</span>';

echo Form::label('password_confirm', 'Confirm Pass:');
echo Form::password('password_confirm', NULL, array('id' => 'password_confirm', 'maxlength' => '25'));
echo (empty ($errors['password_confirm'])) ? '<br />' : '<span class="errors">' . $errors['password_confirm'] . '</span>';

echo Form::label('email', 'Email:');
echo Form::input('email', $post['email'], array('id' => 'email'));
echo (empty ($errors['email'])) ? '<br />' : '<span class="errors">' . $errors['email'] . '</span>';

echo Form::label('membership_id', 'Mem Status:');
echo Form::select('membership_id', array(1 => 'Not Activated/Trial', 2 => 'Activated/Free', 3 => 'Silver (Monthly)', 4 => 'Gold (Monthly)', 5 => 'Platinum (Monthly)', 6 => 'Silver (6 Month)', 7 => 'Gold (6 Month)', 8 => 'Platinum (6 Month)', 10 => 'Silver (Community)', 11 => 'Gold (Community)', 12 => 'Platinum (Community)', 13 => 'Silver (Free)', 14 => 'Gold (Free)', 15 => 'Platinum (Free)', 16 => 'Banned', 17 => 'Flirtbucks Girl', 9 => 'Admin'), $post['membership_id'], array('id' => 'membership_id'));
echo (empty ($errors['membership_id'])) ? '<br />' : '<br /><span class="errors">' . $errors['membership_id'] . '</span>';

echo Form::label('mailstatus', 'Mail Status:');
echo Form::select('mailstatus', array(0 => 'Subscribed (0)', 1 => 'Unsubscribed (1)', 99 => 'Bad Email (99)'), $post['mailstatus'], array('id' => 'mailstatus'));
echo (empty ($errors['mailstatus'])) ? '<br />' : '<br /><span class="errors">' . $errors['mailstatus'] . '</span>';
?>
<br /><h3>Profile Information</h3>
<?php
echo Form::label('gender', 'Gender:');
echo Form::hidden('gender', '', array('id' => 'gender'));
echo HTML::image('assets/img/registration/button-male.png', array('style' => 'margin-left: 15px;', 'id' => 'male'));
echo HTML::image('assets/img/registration/button-female.png', array('style' => 'margin-left: 50px;', 'id' => 'female'));
echo (empty ($errors['gender'])) ? '<br />' : '<br /><span class="errors">' . $errors['gender'] . '</span>';

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
<div class="clear2"></div>
<?php
echo (empty ($errors['seeking[]'])) ? '' : '<span class="errors">' . $errors['seeking[]'] . '</span>';

echo Form::label('birthdate', 'Birthdate:');
echo Form::select('birthmonth', Functions::get_months(), $post['birthmonth'], array('class' => 'date'));
echo Form::select('birthday', Functions::get_days(), $post['birthday'], array('class' => 'date'));
echo Form::select('birthyear', Functions::get_years(), $post['birthyear'], array('class' => 'date'));
echo '<br /><span class="hint">Usage by individuals under 18 is strictly prohibited</span>';
echo (empty ($errors['birthdate'])) ? '' : '<span class="errors">' . $errors['birthdate'] . '</span>';

echo Form::label('country', 'Country:');
echo Form::select('country', $location['country'], $post['country_id'], array('id' => 'country'));
echo (empty ($errors['country_id'])) ? '<br />' : '<br /><span class="errors">' . $errors['country_id'] . '</span>';

echo Form::label('region', 'Region:');
echo Form::select('region', $location['region'], (isset($post['region_id'])) ? $post['region_id'] : NULL, array('id' => 'region'));
echo (empty ($errors['region_id'])) ? '<br />' : '<br /><span class="errors">' . $errors['region_id'] . '</span>';

echo Form::label('city', 'City:');
echo Form::input('city', 'Enter A City', array('id' => 'city'));
//echo Form::select('city_id', $location['city'], (isset($post['city_id'])) ? $post['city_id'] : NULL, array('id' => 'city'));
echo (empty ($errors['city_id'])) ? '<br />' : '<br /><span class="errors">' . $errors['city_id'] . '</span>';


echo Form::label('height', 'Height:');
echo Form::hidden('height', NULL, array('id' => 'height'));
echo '<input type="text" id="heightdisplay" readonly="readonly" /> <div id="slidercontainer"><div id="heightslider"></div></div>';
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

echo Form::label('webcam', 'Have Webcam:');
echo Form::radio('webcam', 'No', (isset($post['webcam']) AND $post['webcam'] == 'No') ? TRUE : FALSE, array('id' => 'webcam_no', 'class' => 'gender')) . Form::label('webcam_no', 'No', array('class' => 'genders')) .  ' ' . Form::radio('webcam', 'Yes', (isset($post['webcam']) AND $post['webcam'] == 'Yes') ? TRUE : FALSE, array('id' => 'webcam_yes', 'class' => 'gender')) . Form::label('webcam_yes', 'Yes', array('class' => 'genders'));
echo (empty ($errors['webcam'])) ? '<br />' : '<br /><span class="errors">' . $errors['webcam'] . '</span>';

echo Form::label('headline', 'Headline:');
echo Form::input('headline', $post['headline'], array('id' => 'headline'));
echo (empty ($errors['headline'])) ? '<br />' : '<br /><span class="errors">' . $errors['headline'] . '</span>';

echo Form::label('description', 'Description:');
echo Form::textarea('description', $post['description'], array('id' => 'description'));
echo (empty ($errors['description'])) ? '<br />' : '<br /><span class="errors">' . $errors['description'] . '</span>';
?>
<h3>Misc Information</h3>
<?php
echo Form::label('rating', 'Profile Rating:');
echo Form::input('rating', $post['rating'], array('id' => 'rating'));
echo (empty ($errors['rating'])) ? '<br />' : '<span class="errors">' . $errors['rating'] . '</span>';

echo Form::label('votes', 'Profile Votes:');
echo Form::input('votes', $post['votes'], array('id' => 'votes'));
echo (empty ($errors['votes'])) ? '<br />' : '<span class="errors">' . $errors['votes'] . '</span>';

echo Form::label('credits', 'Profile Credits:');
echo Form::input('credits', $post['credits'], array('id' => 'credits'));
echo (empty ($errors['credits'])) ? '<br />' : '<span class="errors">' . $errors['credits'] . '</span>';

echo Form::label('notes', 'Admin Notes:');
echo Form::textarea('notes', $post['notes'], array('id' => 'notes'));
echo (empty ($errors['notes'])) ? '<br />' : '<br /><span class="errors">' . $errors['notes'] . '</span>';

echo Form::input('register-submit', 'Register', array('id' => 'register-submit', 'type' => 'image', 'src' => '/assets/img/registration/button-form-submit.png'));
echo '<br />';
?>
</div>
</fieldset>
<?= Form::close(); ?>
</div><br /><br /><br />
<?php
    $user = ORM::factory('user', array('username' => $post['username']));
    $photos = $user->photos->find_all();
?>
<?php if (count($photos) > 0): ?>
<h2>Manage <?= $post['username']; ?>'s Profile Photos</h2>
<?= Form::open('admin/manage/photos/' . $user->username); ?>
<?php foreach($photos as $photo): ?>
<div style="margin: 2px; width: 119px; float: left; border-top: 1px solid white; border-left: 1px solid white; border-right: 1px solid grey; border-bottom: 1px solid grey; ">
    <?= HTML::anchor('photo/' . $user->username . '/' . $photo->uniqueid, HTML::image(Content::factory($user->username)->get_photo($photo->uniqueid, 's', TRUE, TRUE))); ?>
    <div style="font-size: 10px; ">
        User Deleted: <?= $photo->hide; ?><br />
        Approved: <?=$photo->approved; ?><br />
        Delete photo: <?= form::checkbox('delete[]', $photo); ?><br />
        Set as default: <?= Form::radio('default', $photo, ($user->avatar == $photo) ? TRUE : FALSE, ($photo->approved != 'PG-13') ? array('disabled' => 'disabled') : NULL); ?>

    </div>
</div>
<?php endforeach; ?>
<?php if ($photos->count()): ?>
<br /><br /><div style="text-align: center; width: 100%; padding-top: 10px; clear: both;"><?= Form::submit('update', 'Update'); ?></div>
<?php endif; ?>
<?= Form::close(); ?><br />
<?php endif; ?>