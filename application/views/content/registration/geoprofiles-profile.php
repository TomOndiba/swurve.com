<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="left" style="min-height: 150px;">
    <?= HTML::image('assets/photos/geo/' . strtolower(Core::$session->get('geo', 'both')) . '/' . strtolower($selecteduser->username) . '.png', array('style' => 'float: left; margin-right: 10px;')); ?>
    <h4><?= $selecteduser->username; ?></h4><br />
    <?= Functions::get_age($selecteduser->birthdate); ?> / <?= $selecteduser->gender; ?> / <?= $selecteduser->orientation; ?><br /><br />
    "<?= $selecteduser->headline; ?>"<br /><br />
    <span style="color: #A66BA6; font-weight: bold;"><?php srand($selecteduser->id); echo rand(2, 6); ?> Photos</span> <?= HTML::image('assets/img/icons/photo.png', array('style' => 'margin-bottom: -7px;')); ?> <span style="font-size: 10px; font-weight: bold; padding-bottom: 2px; display: inline-block;">Join NOW and connect for FREE</span>
</div>
<h1 style="margin-bottom: 8px;"><span class="pink">More Hotties Near</span> <span class="blue"><?= $geolocation; ?></span></h1>
<div class="left"><br /><br />
    <ul id="geoprofiles">
        <?php foreach($users as $user): ?>
        <li>
            <?= HTML::image('assets/photos/geo/' . strtolower(Core::$session->get('geo', 'both')) . '/' . strtolower($user->username) . '.png'); ?><br />
            <h4><?= $user->username; ?></h4>
            <small><?= Functions::get_age($user->birthdate); ?> / <?= $user->gender; ?> / <?= $user->orientation; ?></small>
        </li>
        <?php endforeach; ?>
    </ul>
    <div class="clear"></div>
</div>
<div class="left">
    <br /><center><h2>Join <span class="pink">NOW</span> and connect <span class="blue">FREE</span></h2></center>
</div>