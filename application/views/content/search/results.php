<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<h1><?= __('Search results for your Swurve match'); ?></h1>

<div class="key">
    <div class="legend">
        <span>Key:</span>
        <span class="PlatinumUser legendkey">Platinum</span>
        <span class="GoldUser legendkey">Gold</span>
    </div>
</div>
<h3 class="blue">Search Results</h3>
<?= $pagination; ?>
<ul id="search-results">
<?php foreach($results as $user): ?>
    <li class="profile-details <?= $user->membership->type; ?>User">
        <div class="profile-info">
            <span class="label">Orientation:</span><span class="data"><?= Functions::isnull($user->orientation); ?></span>
            <span class="label">Interested In:</span><span class="data"><?= Functions::isnull($user->interested_in); ?></span>
            <span class="label">Status:</span><span class="data"><?= Functions::isnull($user->relationship_status); ?></span>
            <span class="label">Height:</span><span class="data"><?= Functions::isnull(Functions::get_height($user->height)); ?></span>
            <span class="label">Body Type:</span><span class="data"><?= Functions::isnull($user->body_type); ?></span>
            <span class="label">Hair Color:</span><span class="data"><?= Functions::isnull($user->hair_color); ?></span>
            <span class="label">Eye Color:</span><span class="data"><?= Functions::isnull($user->eye_color); ?></span>
            <span class="label">Ethnicity:</span><span class="data"><?= Functions::isnull($user->ethnicity); ?></span>
            <span class="label">Smoke:</span><span class="data"><?= Functions::isnull($user->smoke); ?></span>
            <span class="label">Drink:</span><span class="data"><?= Functions::isnull($user->drink); ?></span>

        </div>

        <?= HTML::anchor('profile/' . $user->username, HTML::image(Content::factory($user->username)->get_photo($user->avatar->uniqueid, 'm'), array('class' => 'profile-pic'))); ?>
        <?= HTML::anchor('profile/' . $user->username, $user->username, array('class' => 'username')); ?><br />
        <?= Functions::get_age($user->birthdate); ?> / <?= $user->gender; ?><br />
        <?= $user->city->full_name . ', ' . $user->region->name . ', ' . $user->country->name; ?><br />

        <ul class="profile-options">
            <li>
                <div class="profile-button addfav" link="<?= URL::site('playbook/favorite/' . strtolower($user->username)); ?>">
                    <div>
                            <?php
                                $contact = ORM::factory('contact')
                                    ->where_open()
                                    ->where('to_id', '=', Core::$user)
                                    ->and_where('from_id', '=', $user)
                                    ->where_close()
                                    ->or_where_open()
                                    ->where('to_id', '=', $user)
                                    ->and_where('from_id', '=', Core::$user)
                                    ->where_close()
                                    ->find();

                                $favorite = FALSE;

                                if ($contact->loaded())
                                {
                                    if ($contact->from->id == Core::$user->id AND $contact->to->id == $user->id AND $contact->contact_type->type == 'Favorite')
                                    {
                                        $favorite = TRUE;
                                    }
                                    elseif ($contact->from->id == Core::$user->id AND $contact->to->id == $user->id AND $contact->contact_type->type == 'Match')
                                    {
                                        $favorite = TRUE;
                                    }
                                    elseif ($contact->from->id == $user->id AND $contact->to->id == Core::$user->id AND $contact->contact_type->type == 'Favorite')
                                    {
                                        $favorite = FALSE;
                                    }
                                    elseif ($contact->from->id == $user->id AND $contact->to->id == Core::$user->id AND $contact->contact_type->type == 'Match')
                                    {
                                        $favorite = TRUE;
                                    }
                                }
                            ?>
                        <?php if ($favorite == TRUE): ?>
                        <?=HTML::image('assets/img/icons/favadded.png', array('alt' => 'Remove from Faves', 'tag' => '/assets/img/icons/favadded')); ?>
                        <?php else: ?>
                        <?=HTML::image('assets/img/icons/fav.png', array('alt' => 'Add to Faves', 'tag' => '/assets/img/icons/fav')); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </li>
            <li>
                <div class="profile-button" link="<?= URL::site('message/new/' . strtolower($user->username)); ?>">
                    <div>
                        <?=HTML::image('assets/img/icons/email.png', array('alt' => 'Send a Message')); ?>
                    </div>
                </div>
            </li>
            <li>
                <div class="profile-button" link="<?= (Functions::is_online($user->online->last_seen) AND Functions::can_chat($user)) ? 'chat' : 'not online'; ?>" reci="<?= $user; ?>" recimage="<?= Content::factory($user->username)->get_photo($user->avatar, 'a'); ?>" recu="<?= $user->username; ?>" myu="<?= Core::$user->username; ?>" myi="<?= Core::$user; ?>" myp="<?= Core::$user->password; ?>" mys="<?= Core::$user->membership->status; ?>" credits="<?= ( ! empty(Core::$user->flirtbucks_id) OR (Core::$user->membership->id >= 9 AND Core::$user->membership->id <= 15)) ? '999' : Core::$user->credits; ?>" ignore="<?= ( ! empty(Core::$user->flirtbucks_id)) ? 'true' : 'false'; ?>">
                    <div>
                        <?=HTML::image('assets/img/icons/chat' . ((Functions::is_online($user->online->last_seen) AND Functions::can_chat($user)) ? '-online.gif' : '.png'), array('alt' => 'Send an Instant Message')); ?>
                    </div>
                </div>
            </li>
            <?php if ($user->webcam == 'Yes'): ?>
            <li>
                <div class="profile-button" link="" style="cursor: default;">
                    <div>
                        <?=HTML::image('assets/img/icons/webcam.png', array('alt' => 'User has a Webcam')); ?>
                    </div>
                </div>
            </li>
            <?php endif; ?>
        </ul>
        <div class="clear"></div>

    </li>
<?php endforeach; ?>
</ul>
<?= $pagination; ?>