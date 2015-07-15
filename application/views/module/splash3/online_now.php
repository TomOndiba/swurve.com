<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="side-module" id="online-now">
    <h2 style="font-size: 18px;"><?= __('Online Now'); ?></h2>

    <ul>
    <?php foreach($users as $online): ?>
        <li class="profile-details SilverUser">
            <?= HTML::anchor('user/register/' . $online->username, HTML::image('assets/photos/geo/both/' . strtolower($online->username) . '_100.png', array('alt' => $online->headline, 'class' => 'profile-pic'))); ?>
            <?= HTML::anchor('user/register/' . $online->username, $online->username, array('class' => 'username')); ?><br />
            <?= Functions::get_age($online->birthdate); ?> / <?= $online->gender; ?><br />
            <?= $cities[array_rand($cities)]; ?><br />

            <ul class="profile-options">
                <li>
                    <div class="profile-button addfav" link="<?= URL::site('user/register'); ?>">
                        <div>
                            <?=HTML::image('assets/img/icons/fav.png', array('alt' => 'Add to Faves', 'tag' => '/assets/img/icons/fav')); ?>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="profile-button" link="<?= URL::site('user/register'); ?>">
                        <div>
                            <?=HTML::image('assets/img/icons/email.png', array('alt' => 'Send a Message')); ?>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="profile-button" link="<?= URL::site('user/register'); ?>">
                        <div>
                            <?=HTML::image('assets/img/icons/chat' . ($online->id % 2 == 0 ? '-online.gif' : '.png')); ?>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="clear"></div>
        </li>
    <?php endforeach; ?>
    </ul>
    <div class="clear"></div>
    <p style="float: right;"><?= HTML::anchor('user/register', 'View More'); ?></p>
    <div class="clear"></div>
</div>