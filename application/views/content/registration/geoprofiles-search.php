<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<h1 style="margin-bottom: 8px;"><span class="pink">Sexy Singles <?= $selectedcity[0]; ?></span> <span class="blue"><?= $selectedcity[1]; ?></span></h1>
<?php foreach($users as $user): ?>
<div class="left" style="min-height: 150px;">
    <?= HTML::image('assets/photos/geo/' . strtolower(Core::$session->get('geo', 'both')) . '/' . strtolower($user->username) . '.png', array('style' => 'float: left; margin-right: 10px;')); ?>
    <h4><?= $user->username; ?></h4><br />
    <?= Functions::get_age($user->birthdate); ?> / <?= $user->gender; ?> / <?= $user->orientation; ?><br /><br />
    "<?= $user->headline; ?>"<br /><br />
    <span style="color: #A66BA6; font-weight: bold;"><?php srand($user->id); echo rand(2, 6); ?> Photos</span> <?= HTML::image('assets/img/icons/photo.png', array('style' => 'margin-bottom: -7px;')); ?> <span style="font-size: 10px; font-weight: bold; padding-bottom: 2px; display: inline-block;">Join NOW and connect for FREE</span>
</div>
<?php endforeach; ?>
<div class="left">
    <br /><center><h2>Join <span class="pink">NOW</span> and connect <span class="blue">FREE</span></h2></center>
</div>