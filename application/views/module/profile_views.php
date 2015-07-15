<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="side-module" id="profile-views">
    <h2><?= __('Profile Views'); ?></h2>
<?php if (( ! Functions::check_paidmember(FALSE) OR Core::$user->membership->status < ORM::factory('membership', array('type' => 'Gold'))->status ) AND empty(Core::$user->flirtbucks_id)): ?>
    <?php if (Core::$user): ?>
    <ul>
    <?php foreach($users as $online): ?>
        <li class="profile-details">
            <?= HTML::anchor('user/upgrade/', HTML::image('assets/photos/who' . strtolower($online->user->gender) . '_m.png', array('class' => 'profile-pic'))); ?>
            <?= HTML::anchor('user/upgrade/', '????????????', array('class' => 'username')); ?><br />
            <?= Functions::get_age($online->user->birthdate); ?> / <?= $online->user->gender; ?><br />
            <?= '??????, ' . $online->user->region->name . ', ' . $online->user->country->name; ?><br />

            <ul class="profile-options">
                <li>
                    <div class="profile-button addfav" link="<?= URL::site('user/upgrade/'); ?>">
                        <div>
                            <?=HTML::image('assets/img/icons/fav.png', array('alt' => 'Add to Faves', 'tag' => '/assets/img/icons/fav')); ?>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="profile-button" link="<?= URL::site('user/upgrade/'); ?>">
                        <div>
                            <?=HTML::image('assets/img/icons/email.png', array('alt' => 'Send a Message')); ?>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="profile-button" link="<?= URL::site('user/upgrade'); ?>">
                        <div>
                            <?=HTML::image('assets/img/icons/chat.png', array('alt' => 'Send an Instant Message')); ?>
                        </div>
                    </div>
                </li>
                <?php if ($online->user->webcam == 'Yes'): ?>
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

    <p>Want to see who viewed you?  <?= HTML::anchor('user/upgrade', 'Upgrade'); ?> to <strong>Gold</strong> or better.</p>
    <?php else: ?>
    <p><?= HTML::anchor('user/login', 'Login'); ?> to your account to see them.</p>
    <?php endif; ?>
<?php else: ?>
    <ul>
    <?php foreach($users as $online): ?>
    <?php
        $contact = ORM::factory('contact')
            ->where_open()
            ->where('to_id', '=', Core::$user)
            ->and_where('from_id', '=', $online->user)
            ->where_close()
            ->or_where_open()
            ->where('to_id', '=', $online->user)
            ->and_where('from_id', '=', Core::$user)
            ->where_close()
            ->find();

        $favorite = FALSE;

        if ($contact->loaded())
        {
            if ($contact->from->id == Core::$user->id AND $contact->to->id == $online->user->id AND $contact->contact_type->type == 'Favorite')
            {
                $favorite = TRUE;
            }
            elseif ($contact->from->id == Core::$user->id AND $contact->to->id == $online->user->id AND $contact->contact_type->type == 'Match')
            {
                $favorite = TRUE;
            }
            elseif ($contact->from->id == $online->user->id AND $contact->to->id == Core::$user->id AND $contact->contact_type->type == 'Favorite')
            {
                $favorite = FALSE;
            }
            elseif ($contact->from->id == $online->user->id AND $contact->to->id == Core::$user->id AND $contact->contact_type->type == 'Match')
            {
                $favorite = TRUE;
            }
        }
    ?>
        <li class="profile-details">
            <?= HTML::anchor('profile/' . $online->user->username, HTML::image(Content::factory($online->user->username)->get_photo($online->user->avatar->uniqueid, 'm'), array('class' => 'profile-pic'))); ?>
            <?= HTML::anchor('profile/' . $online->user->username, $online->user->username, array('class' => 'username')); ?><br />
            <?= Functions::get_age($online->user->birthdate); ?> / <?= $online->user->gender; ?><br />
            <?= $online->user->city->full_name . ', ' . $online->user->region->name . ', ' . $online->user->country->name; ?><br />

            <ul class="profile-options">
                <li>
                    <div class="profile-button addfav" link="<?= URL::site('playbook/favorite/' . strtolower($online->user->username)); ?>">
                        <div>
                            <?php if ($favorite == TRUE): ?>
                            <?=HTML::image('assets/img/icons/favadded.png', array('alt' => 'Remove from Faves', 'tag' => '/assets/img/icons/favadded')); ?>
                            <?php else: ?>
                            <?=HTML::image('assets/img/icons/fav.png', array('alt' => 'Add to Faves', 'tag' => '/assets/img/icons/fav')); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="profile-button" link="<?= URL::site('message/new/' . strtolower($online->user->username)); ?>">
                        <div>
                            <?=HTML::image('assets/img/icons/email.png', array('alt' => 'Send a Message')); ?>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="profile-button" link="<?= (Functions::is_online($online->user->online->last_seen) AND Functions::can_chat($online->user)) ? 'chat' : 'not online'; ?>" reci="<?= $online->user; ?>" recimage="<?= Content::factory($online->user->username)->get_photo($online->user->avatar, 'a'); ?>" recu="<?= $online->user->username; ?>" myu="<?= Core::$user->username; ?>" myi="<?= Core::$user; ?>" myp="<?= Core::$user->password; ?>" mys="<?= Core::$user->membership->status; ?>" credits="<?= ( ! empty(Core::$user->flirtbucks_id) OR (Core::$user->membership->id >= 9 AND Core::$user->membership->id <= 15)) ? '999' : Core::$user->credits; ?>" ignore="<?= ( ! empty(Core::$user->flirtbucks_id)) ? 'true' : 'false'; ?>">
                        <div>
                            <?=HTML::image('assets/img/icons/chat' . ((Functions::is_online($online->user->online->last_seen) AND Functions::can_chat($online->user)) ? '-online.gif' : '.png'), array('alt' => 'Send an Instant Message')); ?>
                        </div>
                    </div>
                </li>
                <?php if ($online->user->webcam == 'Yes'): ?>
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
    <?php if (count($users) == 5): ?>
        <p style="float: right;"><?= HTML::anchor('user/views', 'View More'); ?></p>
    <?php endif; ?>
    <?php if (count($users) == 0): ?>
        <p>You currently have no profile views.</p>
    <?php endif; ?>
<?php endif; ?>
</div>