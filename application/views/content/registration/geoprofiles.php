<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="left">
    <h2><span class="pink">Sexy Singles Near</span> <span class="blue"><?= $geolocation; ?></span></h2>
    <ul id="geoprofiles">
        <?php foreach($users as $user): ?>
        <li>
            <?php if (Request::instance()->action == 'articles' OR Request::instance()->action == 'articles2' OR Request::instance()->action == 'articles3'): ?>
            <?= HTML::anchor('user/register/' . $user->username, HTML::image('assets/photos/geo/' . strtolower(Core::$session->get('geo', 'both')) . '/' . strtolower($user->username) . '.png')); ?><br />
            <?php else: ?>
            <?= HTML::image('assets/photos/geo/' . strtolower(Core::$session->get('geo', 'both')) . '/' . strtolower($user->username) . '.png'); ?><br />
            <?php endif; ?>

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