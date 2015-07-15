<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script language="javascript" type="text/javascript">
    $(document).ready(function () {
        $('.rating').rating({
            half: true,
            callback: function(value, link){
                var input = this;

                if (value == '')
                {
                    value = 0;
                    input = $(this).find('input');
                }

                $.ajax({
                    type: 'GET',
                    cache: false,
                    dataType: 'json',
                    url: <?= '\'' . URL::site('json/rate/\' + $(input).attr(\'user\') + \'/\' + value'); ?>,
                    success: function(results) {
                        $('#rate .score').html((results['result']['rating']) ? results['result']['rating'] : '0');
                        //$('#rate .votes').html((results['result']['votes'] == 1) ? results['result']['votes'] + ' Vote' : results['result']['votes'] + ' Votes');
                    }
                });
            }
        });
    });
</script>
<div id="panel">
    <ul id="tabs">
        <li id="user">
            <h1><?= $user->username; ?></h1>
            <h3>"<?= $user->headline; ?>"</h3>
        </li>
        <li><h2><?= HTML::anchor('photos/' . strtolower($user->username), 'Photos', array('class' => 'activate-prompt')); ?></h2></li>
        <li><h2><?= HTML::anchor('coming-soon', 'Videos', array('class' => 'activate-prompt')); // TODO: Point to a working link. ?></h2></li>
        <li><h2><?= HTML::anchor('activity/' . strtolower($user->username), 'Recent Activity', array('class' => 'activate-prompt')); ?></h2></li>
    </ul>
    <div class="clear"></div>
    <div id="content">
        <div id="leftcontent">
            <div id="photos">
        <?php if ($user->avatar->loaded()): ?>
            <?= HTML::anchor('photo/' . $user->username . '/' . $user->avatar->uniqueid, HTML::image(Content::factory($user->username)->get_photo($user->avatar, 'a')), array('class' => 'activate-prompt')); ?><br />
        <?php else: ?>
            <?= HTML::image(Content::factory($user->username)->get_photo($user->avatar, 'a')); ?><br />
        <?php endif; ?>

                <ul id="thumbs" <?= (count($photos) == 0) ? 'style="display: none;"' : NULL; ?>>
                    <?php foreach($photos as $photo): ?>
                    <li><?= HTML::anchor('photo/' . $user->username . '/' . $photo->uniqueid, HTML::image(Content::factory($user->username)->get_photo($photo->uniqueid, 's')), array('class' => 'activate-prompt')); ?></li>
                    <?php endforeach; ?>
                </ul>
                <div class="clear"></div>
            </div>

            <div id="rate">
                <ul id="buttons"> <?php // TODO: Update links below to actual working pages. ?>
                    <li style="padding-left: 0; margin: 3; padding-top: 5px; padding-bottom: 3px;"><span class="icon" style="padding-left: 0; margin-left: -8px;"><?=HTML::image('assets/img/icons/photo.png'); ?></span> <?= HTML::anchor('request/photos/' . $user->username, (count($photos) == 1) ? 'Request More Photos' : 'Request To See Photos', array('class' => 'activate-prompt')); ?></li>
                </ul><br />

                Rate <?=$user->username; ?>!<br />

                <?php if (Core::$user->membership->type != 'Trial'): ?>
                <div style="width: 100px; margin: 0 auto; margin-top: 5px;">
                    <input class="rating" type="radio" name="profile" value="0.5" user="<?=$user; ?>" <?= ($rating->rating == 0.5) ? 'checked="checked"' : ''; ?> />
                    <input class="rating" type="radio" name="profile" value="1.0" user="<?=$user; ?>" <?= ($rating->rating == 1) ? 'checked="checked"' : ''; ?> />
                    <input class="rating" type="radio" name="profile" value="1.5" user="<?=$user; ?>" <?= ($rating->rating == 1.5) ? 'checked="checked"' : ''; ?> />
                    <input class="rating" type="radio" name="profile" value="2.0" user="<?=$user; ?>" <?= ($rating->rating == 2) ? 'checked="checked"' : ''; ?> />
                    <input class="rating" type="radio" name="profile" value="2.5" user="<?=$user; ?>" <?= ($rating->rating == 2.5) ? 'checked="checked"' : ''; ?> />
                    <input class="rating" type="radio" name="profile" value="3.0" user="<?=$user; ?>" <?= ($rating->rating == 3) ? 'checked="checked"' : ''; ?> />
                    <input class="rating" type="radio" name="profile" value="3.5" user="<?=$user; ?>" <?= ($rating->rating == 3.5) ? 'checked="checked"' : ''; ?> />
                    <input class="rating" type="radio" name="profile" value="4.0" user="<?=$user; ?>" <?= ($rating->rating == 4) ? 'checked="checked"' : ''; ?> />
                    <input class="rating" type="radio" name="profile" value="4.5" user="<?=$user; ?>" <?= ($rating->rating == 4.5) ? 'checked="checked"' : ''; ?> />
                    <input class="rating" type="radio" name="profile" value="5.0" user="<?=$user; ?>" <?= ($rating->rating == 5) ? 'checked="checked"' : ''; ?> />
                </div><br />
                <?php endif; ?>

                <span class="score"><?= number_format($user->rating, 2); ?></span>
                <!--span class="votes"><?=$user->votes; ?> <?=($user->votes == 1) ? ' Vote' : ' Votes'; ?></span-->
            </div>
            <div class="clear"></div>
        </div>
        <div id="rightcontent">
            <ul>
                <li>
                    <div class="profile-button addfav activate-prompt" link="<?= URL::site('playbook/favorite/' . strtolower($user->username)); ?>">
                        <div>
                            <?php if ($favorite): ?>
                            <?=HTML::image('assets/img/icons/favadded.png', array('alt' => 'Remove from Faves', 'tag' => '/assets/img/icons/favadded')); ?>
                            Remove
                            <?php else: ?>
                            <?=HTML::image('assets/img/icons/fav.png', array('alt' => 'Add to Faves', 'tag' => '/assets/img/icons/fav')); ?>
                            Add
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="profile-button activate-prompt" link="<?= URL::site('message/flirt/' . strtolower($user->username)); ?>">
                        <div>
                            <?=HTML::image('assets/img/icons/flirt.png', array('alt' => 'Flirt with ' . $user->username)); ?>
                            Flirt
                        </div>
                    </div>
                </li>
                <li>
                    <div class="profile-button activate-prompt" link="<?= URL::site('message/new/' . strtolower($user->username)); ?>">
                        <div>
                            <?=HTML::image('assets/img/icons/email.png', array('alt' => 'Send a Message')); ?>
                            Email
                        </div>
                    </div>
                </li>
                <li>
                    <div class="profile-button activate-prompt" link="<?= (Functions::is_online($user->online->last_seen) AND Functions::can_chat($user)) ? 'chat' : 'not online'; ?>" reci="<?= $user; ?>" recimage="<?= Content::factory($user->username)->get_photo($user->avatar, 'a'); ?>" recu="<?= $user->username; ?>" myu="<?= Core::$user->username; ?>" myi="<?= Core::$user; ?>" myp="<?= Core::$user->password; ?>" mys="<?= Core::$user->membership->status; ?>" credits="<?= ( ! empty(Core::$user->flirtbucks_id) OR (Core::$user->membership->id >= 9 AND Core::$user->membership->id <= 15)) ? '999' : Core::$user->credits; ?>" ignore="<?= ( ! empty(Core::$user->flirtbucks_id)) ? 'true' : 'false'; ?>">
                        <div>
                            <?=HTML::image('assets/img/icons/chat' . ((Functions::is_online($user->online->last_seen) AND Functions::can_chat($user)) ? '-online.gif' : '.png'), array('alt' => 'Send an Instant Message')); ?>
                            Chat
                        </div>
                    </div>
                </li>
                <?php if ($user->webcam == 'Yes'): ?>
                <li>
                    <div class="profile-button" link="" style="cursor: default;">
                        <div>
                            <?=HTML::image('assets/img/icons/webcam.png', array('alt' => 'User has a Webcam')); ?>
                            Webcam
                        </div>
                    </div>
                </li>
                <?php endif; ?>
            </ul>
            <div class="clear"></div>
            <div class="section">
                <h3>Vitals</h3>
                <span class="label">Gender:</span><span class="data"><?= $user->gender; ?>&nbsp;</span>
                <span class="label">Orientation:</span><span class="data"><?= $user->orientation; ?>&nbsp;</span>
                <span class="label">Interested In:</span><span class="data"><?= $user->interested_in; ?>&nbsp;</span>
                <span class="label">Status:</span><span class="data"><?= $user->relationship_status; ?>&nbsp;</span>
                <span class="label">Location:</span><span class="data"><?= $user->city->full_name . ', ' . $user->region->name . ', ' . $user->country->name; ?>&nbsp;</span>
                <div class="clear"><br /></div>
                <span class="label">Age:</span><span class="data"><?= Functions::get_age($user->birthdate); ?>&nbsp;</span>
                <span class="label">Height:</span><span class="data"><?= Functions::get_height($user->height); ?>&nbsp;</span>
                <span class="label">Body Type:</span><span class="data"><?= $user->body_type; ?>&nbsp;</span>
                <span class="label">Hair Color:</span><span class="data"><?= $user->hair_color; ?>&nbsp;</span>
                <span class="label">Eye Color:</span><span class="data"><?= $user->eye_color; ?>&nbsp;</span>
                <span class="label">Ethnicity:</span><span class="data"><?= $user->ethnicity; ?>&nbsp;</span>
                <span class="label">Smoke:</span><span class="data"><?= $user->smoke; ?>&nbsp;</span>
                <span class="label">Drink:</span><span class="data"><?= $user->drink; ?>&nbsp;</span>
                <span class="label">First Date Sex:</span><span class="data"><?= $user->first_date_sex; ?>&nbsp;</span>
                <div class="clear"><br /></div>
                <span class="label">Seeking:</span><span class="data"><?= Functions::ImplodeToEnglish($user->relationship_types->find_all()->as_array('type', 'type')); ?>&nbsp;</span>
            </div>
            <div class="clear"></div>
            <div class="section">
                <h3>Description</h3>
                <span><?= $user->description; ?></span>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
