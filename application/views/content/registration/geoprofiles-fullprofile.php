<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<style>
	.label {
		width: 85px;
		text-align: right;
		padding-right: 5px;
		font-weight: bold;
		vertical-align: top;
		clear: left;
		display: inline-block;
	}

	.data {
		display: inline-block;
		width: 130px;
	}

	#col1 {
		padding-top: 50px;
	}
</style>
<div class="left" style="min-height: 150px;">
	<center><h1><span class="pink"><?= $selecteduser->username; ?></span> wants to <br />connect with you!</h1></center>

 	<center>
 		"<?= $selecteduser->headline; ?>"<br />
 		<div style="margin: 0 auto; display: inline-block; margin-top: 5px; margin-bottom: 5px; padding: 5px; padding-bottom: 3px; border: 1px solid #999; background-color: #fff;"><?= HTML::image(Content::factory($selecteduser->username)->get_photo($selecteduser->avatar, 'a'), array('style' => 'border: 1px solid #666;')); ?></div><br />
 		<span style="color: #A66BA6; font-weight: bold;"><?php srand($selecteduser->id); echo rand(7, 25); ?> Photos</span> <?= HTML::image('assets/img/icons/photo.png', array('style' => 'margin-bottom: -7px;')); ?> <span style="font-size: 10px; font-weight: bold; padding-bottom: 2px; display: inline-block;"></span> <span style="color: green; font-weight: bold; margin-left: 10px;">Online Now</span> <?= HTML::image('assets/img/icons/online-now.gif', array('style' => 'vertical-align: middle; margin-top: -2px;')); ?><br /><br />
 	</center>

 	<div style="font-size: 10px;">
	    <span class="label">Gender:</span><span class="data"><?= $selecteduser->gender; ?>&nbsp;</span>
	    <span class="label">Orientation:</span><span class="data"><?= $selecteduser->orientation; ?>&nbsp;</span>
	    <span class="label">Interested In:</span><span class="data"><?= $selecteduser->interested_in; ?>&nbsp;</span>
		<span class="label">Status:</span><span class="data"><?= $selecteduser->relationship_status; ?>&nbsp;</span>
        <?php if ($geolocation != "Your City"): ?><span class="label">Location:</span><span class="data"><?= $geolocation; ?>&nbsp;</span><?php endif; ?>

        <div class="clear"><br /></div>
        <span class="label">Age:</span><span class="data"><?= Functions::get_age($selecteduser->birthdate); ?>&nbsp;</span>
        <span class="label">Height:</span><span class="data"><?= Functions::get_height($selecteduser->height); ?>&nbsp;</span>
        <span class="label">Body Type:</span><span class="data"><?= $selecteduser->body_type; ?>&nbsp;</span>
        <span class="label">Hair Color:</span><span class="data"><?= $selecteduser->hair_color; ?>&nbsp;</span>
        <span class="label">Eye Color:</span><span class="data"><?= $selecteduser->eye_color; ?>&nbsp;</span>
        <span class="label">Ethnicity:</span><span class="data"><?= $selecteduser->ethnicity; ?>&nbsp;</span>
        <span class="label">Smoke:</span><span class="data"><?= $selecteduser->smoke; ?>&nbsp;</span>
        <span class="label">Drink:</span><span class="data"><?= $selecteduser->drink; ?>&nbsp;</span>
        <span class="label">First Date Sex:</span><span class="data"><?= $selecteduser->first_date_sex; ?>&nbsp;</span>

        <div class="clear"><br /></div>
        <span class="label">Seeking:</span><span class="data" style="width: 364px;"><?= Functions::ImplodeToEnglish($selecteduser->relationship_types->find_all()->as_array('type', 'type')); ?>&nbsp;</span>

        <div class="clear"><br /></div>
        <span class="label">Description:</span><span class="data" style="width: 362px;"><?= $selecteduser->description; ?>&nbsp;</span>
 	</div>
</div>

<div class="left" style="padding-top: 5px; padding-bottom: 5px;">
    <br /><center>
    <h3>Create your <span class="pink">free</span> profile <span class="blue">now</span> to connect</h3>
    <h3 style="font-weight: normal;">Verified members can: View Private Photos, <br />Instant Message, Video Chat, Email and more</h3>
    <!--h2>Join <span class="pink">NOW</span> and connect <span class="blue">FREE</span></h2-->
	</center>
</div>