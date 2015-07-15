<script type="text/javascript" language="javascript">
$(document).ready(function() {
    $('#get_count').click(function() {
        $('#blast_action').val('count');
        $('#send_blast').click();
    });

    $('#send_blast').click(function() {
        $(this).hide();
        $('#country_id').val($('#country').val());
        $('#region_id').val($('#region').val());
        $('#city_id').val($('#city').val());
    });
});
</script>

<h1>Email Blast</h1>

<?= Form::open(NULL); ?>
<?= Form::hidden('action', 'send', array('id' => 'blast_action')); ?>
<?= Form::hidden('country_id', NULL, array('id' => 'country_id')); ?>
<?= Form::hidden('region_id', NULL, array('id' => 'region_id')); ?>
<?= Form::hidden('city_id', NULL, array('id' => 'city_id')); ?>
<?= Form::label('membership_id', 'Member Status'); ?> <?= Form::select('membership_id', array(1 => 'Not Activated/Trial', 2 => 'Activated/Free', 3 => 'Silver (Monthly)', 4 => 'Gold (Monthly)', 5 => 'Platinum (Monthly)', 6 => 'Silver (6 Month)', 7 => 'Gold (6 Month)', 8 => 'Platinum (6 Month)', 10 => 'Silver (Community)', 11 => 'Gold (Community)', 12 => 'Platinum (Community)', 9 => 'Admin'), $post['membership_id'], array('id' => 'membership_id')); ?><br />
<?= Form::label('gender', 'Gender'); ?> <?= Form::select('gender', array('' => 'Select', 'Male' => 'Men', 'Female' => 'Women'), $post['gender'], array('id' => 'gender')); ?><br />
<?= Form::label('interested_in', 'Interested In'); ?> <?= Form::select('interested_in', array('' => 'Select', 'Male' => 'Men', 'Female' => 'Women', 'Both' => 'Both'), $post['interested_in'], array('id' => 'interested_in')); ?><br />

<?= Form::label('signup_date_after', 'On or After Signup Date:'); ?> <?= Form::input('signup_date_after', $post['signup_date_after']); ?> 
<?= Form::label('signup_date_before', 'And Before:'); ?> <?= Form::input('signup_date_before', $post['signup_date_before']); ?><br />

<?
echo Form::label('country', 'Country: ');
echo Form::select('country', $locations['countries'], (isset($post['country'])) ? $post['country'] : NULL, array('id' => 'country'));
echo (empty ($errors['country'])) ? '<br />' : '<br /><span class="errors">' . $errors['country'] . '</span>';

echo Form::label('region', 'Region: ');
echo Form::select('region', $locations['regions'], (isset($post['region'])) ? $post['region'] : NULL, array('id' => 'region'));
echo (empty ($errors['region'])) ? '<br />' : '<br /><span class="errors">' . $errors['region'] . '</span>';
/*
echo Form::label('city', 'City: ');
echo Form::input('city', 'Enter A City', array('id' => 'city', 'disabled' => 'disabled'));
//echo Form::select('city', array('Select A City'), (isset($post['city'])) ? $post['city'] : NULL, array('id' => 'city', 'disabled' => 'disabled'));
echo (empty ($errors['city'])) ? '<br />' : '<br /><span class="errors">' . $errors['city'] . '</span>';    
*/
echo Form::label('subject', 'Subject: ');
echo Form::input('subject', $post['subject'], array('style' => 'width: 500px;'));
echo (empty ($errors['subject'])) ? '<br />' : '<br /><span class="errors">' . $errors['subject'] . '</span>';

echo Form::label('message', 'Message: ');
echo Form::textarea('message', $post['message'], array('style' => 'width: 500px; height: 100px;'));
echo (empty ($errors['message'])) ? '<br />' : '<br /><span class="errors">' . $errors['message'] . '</span>';
?>
<?= Form::label('resume_id', 'Resume from User ID (Use if blast stops midway):'); ?> <?= Form::input('resume_id', $post['resume_id']); ?><br />
<?php if (isset($count)): ?><br />
<h3>Found <?= $count; ?> profiles matching the criteria above.</h3>
<?php endif; ?>
<br /><center><?= Form::button('count', 'Get Count', array('id' => 'get_count')); ?>  <?= Form::submit('submit', 'Send Blast', array('id' => 'send_blast')); ?></center>
<?= Form::close(); ?>