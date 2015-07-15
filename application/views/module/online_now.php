<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="side-module" id="online-now">
    <h2><?= (Core::$user AND ! empty(Core::$user->flirtbucks_id)) ? __('Recently Active') : __('Online Now'); ?></h2>
<?php if ( ! Core::$user): ?>
    <p><?= HTML::anchor('user/login', 'Login'); ?> to see who's online right now.</p>
<?php else: ?>
    <ul>
    <?php foreach($users as $online): ?>
        <li class="profile-details <?= $online->user->membership->type; ?>User">
            <?= HTML::anchor('profile/' . $online->user->username, HTML::image(Content::factory($online->user->username)->get_photo($online->user->avatar, 'm'), array('class' => 'profile-pic'))); ?>
            <?= HTML::anchor('profile/' . $online->user->username, $online->user->username, array('class' => 'username')); ?><br />
            <?= Functions::get_age($online->user->birthdate); ?> / <?= $online->user->gender; ?><br />
            <?= $online->user->city->full_name . ', ' . $online->user->region->name . ', ' . $online->user->country->name; ?><br />

            <ul class="profile-options">
                <li>
                    <div class="profile-button addfav activate-prompt" link="<?= URL::site('playbook/favorite/' . strtolower($online->user->username)); ?>">
                        <div>
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
                            <?php if ($favorite == TRUE): ?>
                            <?=HTML::image('assets/img/icons/favadded.png', array('alt' => 'Remove from Faves', 'tag' => '/assets/img/icons/favadded')); ?>
                            <?php else: ?>
                            <?=HTML::image('assets/img/icons/fav.png', array('alt' => 'Add to Faves', 'tag' => '/assets/img/icons/fav')); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="profile-button activate-prompt" link="<?= URL::site('message/new/' . strtolower($online->user->username)); ?>">
                        <div>
                            <?=HTML::image('assets/img/icons/email.png', array('alt' => 'Send a Message')); ?>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="profile-button activate-prompt" link="<?= (Functions::is_online($online->user->online->last_seen) AND Functions::can_chat($online->user)) ? 'chat' : 'not online'; ?>" reci="<?= $online->user; ?>" recimage="<?= Content::factory($online->user->username)->get_photo($online->user->avatar, 'a'); ?>" recu="<?= $online->user->username; ?>" myu="<?= Core::$user->username; ?>" myi="<?= Core::$user; ?>" myp="<?= Core::$user->password; ?>" mys="<?= Core::$user->membership->status; ?>" credits="<?= ( ! empty(Core::$user->flirtbucks_id) OR (Core::$user->membership->id >= 9 AND Core::$user->membership->id <= 15)) ? '999' : Core::$user->credits; ?>" ignore="<?= ( ! empty(Core::$user->flirtbucks_id)) ? 'true' : 'false'; ?>">
                        <div>
                            <?=HTML::image('assets/img/icons/chat' . ((Functions::is_online($online->user->online->last_seen) AND Functions::can_chat($online->user)) ? '-online.gif' : '.png'), array('alt' => 'Send an Instant Message')); ?>
                        </div>
                    </div>
                </li>
                <?php if ($online->user->webcam == 'Yes'): ?>
                <li>
                    <div class="profile-button activate-prompt" link="" style="cursor: default;">
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
    <div class="clear"></div>
    <?php if (count($users) > 1): ?>
        <?php if (Core::$user->membership_id == '10' OR Core::$user->membership_id == '11' OR Core::$user->membership_id == '12' OR Core::$user->membership_id == '9'): ?>
            <p style="float: left"><?= HTML::anchor('user/online', 'Recently Active'); ?></p>
        <?php endif; ?>

        <p style="float: right;"><?= HTML::anchor('user/search/online', 'View More', array('class' => 'activate-prompt')); ?></p>
        <div class="clear"></div>
    <?php endif; ?>
<?php endif; ?>
</div>