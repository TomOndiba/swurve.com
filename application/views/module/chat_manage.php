<?php
    $open_chats = ORM::factory('chat')->where_open()->where('from_id', '=', Core::$user)->or_where('to_id', '=', Core::$user)->where_close()->where('date_end', 'IS', NULL)->find_all();

    $xoffset = 100;

    foreach($open_chats as $chat)
    {
        $reciever = ($chat->from_id == Core::$user) ? $chat->to : $chat->from;

        if ($chat->response == 'Accept' OR ($chat->from_id == Core::$user AND empty($chat->response)))
        {
?>
<script type="text/javascript">
    $(document).ready(function() {
        if ( ! $("#chatwindow-<?= $reciever->username; ?>").length )
        {
            $('body').prepend('<div style="position: absolute; top: <?= ( ! empty($_COOKIE['chat' . $chat . 'y'])) ? $_COOKIE['chat' . $chat . 'y'] : '50' ; ?>px; left: <?= ( ! empty($_COOKIE['chat' . $chat . 'x'])) ? $_COOKIE['chat' . $chat . 'x'] : $xoffset ; ?>px; border: 2px solid #95999C; z-index: 10;" chatid="<?= $chat; ?>" class="chat-window" id="chatwindow-<?= $reciever->username; ?>" url="identifier=<?= $chat . '-'. $chat->unique; ?>&sender=<?= Core::$user->username; ?>&senderi=<?= Core::$user; ?>&senderp=<?= Core::$user->password; ?>&reciever=<?= $reciever->username; ?>&recieveri=<?= $reciever; ?>"></div>');

            $('#chatwindow-<?= $reciever->username; ?>').initiateChat({ 
                from: '<?= Core::$user->username ?>', 
                to: '<?= $reciever->username; ?>', 
                fromid: '<?= Core::$user ?>', 
                toid: '<?= $reciever; ?>',
	            gender: '<?= Core::$user->gender; ?>',
                toImage: '/<?= Content::factory($reciever->username)->get_photo($reciever->avatar, 'a'); ?>', 
                identifier: '<?= $chat . '-' . $chat->unique ?>'
            });
        }
    });
</script>
<?php
            $xoffset += 100;
        }

        if (empty($chat->response) AND $chat->to_id == Core::$user)
        {
?>
<script language="javascript" type="text/javascript">
    $(document).ready(function() {
        if ( ! $("#dialog-confirm-<?= $chat; ?>").length )
        {
            $('body').prepend('' +
                '<div id="dialog-confirm-<?= $chat; ?>" title="Chat Request" style="display; none; overflow: hidden;">' +
                '    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>' +
                '    <?= $reciever->username; ?> would like to chat with you.' +
                <?php if (Core::$user->membership->status > 1): ?>
                '    <span style="font-family: verdana; font-size: 10px; color: #999; margin-bottom: -15px; display: block;">Text chat is 1 credit per minute</span>' +
                <?php endif; ?>
                '' +
                '    <ul>' +
                '        <li class="profile-details <?= $reciever->membership->type; ?>User" style="padding-top: 3px; padding-left: 3px;">' +
                '            <?= HTML::anchor('profile/' . $reciever->username, HTML::image(Content::factory($reciever->username)->get_photo($reciever->avatar, 'm'), array('class' => 'profile-pic'))); ?>' +
                '            <?= HTML::anchor('profile/' . $reciever->username, $reciever->username, array('class' => 'username', 'style' => 'font-size: 16px;')); ?><br />' +
                '            <span style="font-size: 12px; font-family: verdana; color: #666;"><?= Functions::get_age($reciever->birthdate); ?> / <?= $reciever->gender; ?><br />' +
                '            <?= $reciever->city->full_name . ', ' . $reciever->region->name . ', ' . $reciever->country->name; ?><br /></span>' +
                '            ' +
                '            <ul class="profile-options" style="padding-top: 5px;">' +
                '                <li style="float: left; padding-right: 10px; cursor: pointer;">' +
                '                    <div class="profile-button addfav activate-prompt" link="<?php if (Core::$user->membership->status == 0): ?>#<?php else: ?><?= URL::site('playbook/favorite/' . strtolower($reciever->username)); ?><?php endif; ?>">' +
                '                        <div>' +
                                            <?php
                                                $contact = ORM::factory('contact')
                                                    ->where_open()
                                                    ->where('to_id', '=', Core::$user)
                                                    ->and_where('from_id', '=', $reciever)
                                                    ->where_close()
                                                    ->or_where_open()
                                                    ->where('to_id', '=', $reciever)
                                                    ->and_where('from_id', '=', Core::$user)
                                                    ->where_close()
                                                    ->find();

                                                $favorite = FALSE;

                                                if ($contact->loaded())
                                                {
                                                    if ($contact->from->id == Core::$user->id AND $contact->to->id == $reciever->id AND $contact->contact_type->type == 'Favorite')
                                                    {
                                                        $favorite = TRUE;
                                                    }
                                                    elseif ($contact->from->id == Core::$user->id AND $contact->to->id == $reciever->id AND $contact->contact_type->type == 'Match')
                                                    {
                                                        $favorite = TRUE;
                                                    }
                                                    elseif ($contact->from->id == $reciever->id AND $contact->to->id == Core::$user->id AND $contact->contact_type->type == 'Favorite')
                                                    {
                                                        $favorite = FALSE;
                                                    }
                                                    elseif ($contact->from->id == $reciever->id AND $contact->to->id == Core::$user->id AND $contact->contact_type->type == 'Match')
                                                    {
                                                        $favorite = TRUE;
                                                    }
                                                }
                                            ?>
                                            <?php if ($favorite == TRUE): ?>
                '                            <?=HTML::image('assets/img/icons/favadded.png', array('alt' => 'Remove from Faves', 'tag' => '/assets/img/icons/favadded')); ?>' +
                                            <?php else: ?>
                '                            <?=HTML::image('assets/img/icons/fav.png', array('alt' => 'Add to Faves', 'tag' => '/assets/img/icons/fav')); ?>' +
                                            <?php endif; ?>
                '                        </div>' +
                '                    </div>' +
                '                </li>' +
                '                <li style="float: left; padding-right: 10px; cursor: pointer;">' +
                '                    <div class="profile-button activate-prompt" link="<?php if (Core::$user->membership->status == 0): ?>#<?php else: ?><?= URL::site('message/new/' . strtolower($reciever->username)); ?><?php endif; ?>">' +
                '                        <div>' +
                '                            <?=HTML::image('assets/img/icons/email.png', array('alt' => 'Send a Message')); ?>' +
                '                        </div>' +
                '                    </div>' +
                '                </li>' +
                                <?php if ($reciever->webcam == 'Yes'): ?>
                '                <li>' +
                '                    <div class="profile-button activate-prompt" link="" style="cursor: default;">' +
                '                        <div>' +
                '                            <?=HTML::image('assets/img/icons/webcam.png', array('alt' => 'User has a Webcam')); ?>' +
                '                        </div>' +
                '                    </div>' +
                '                </li>' +
                                <?php endif; ?>
                '            </ul>' +
                '            <div class="clear"></div>' +
                '        </li>' +
                '    </ul>' +
                '    </p>' +
                '    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="1" height="1" id="pop_sound" align="middle">' +
                '        <param name="movie" value="/assets/pop.swf?<?= time(); ?>"/>' +
                '        <!--[if !IE]>-->' +
                '        <object type="application/x-shockwave-flash" data="/assets/pop.swf?<?= time(); ?>" width="1" height="1">' +
                '            <param name="movie" value="/assets/pop.swf?<?= time(); ?>"/>' +
                '        <!--<![endif]-->' +
                '            <a href="http://www.adobe.com/go/getflash">' +
                '                <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player"/>' +
                '            </a>' +
                '        <!--[if !IE]>-->' +
                '        </object>' +
                '        <!--<![endif]-->' +
                '    </object>' +
                '</div>');

            //playPOP();

            var origFocus = document.activeElement;

            $("#dialog-confirm-<?= $chat; ?>").dialog({
                resizable: false,
                height: 240,
                width: 350,
                modal: true,
                buttons: {
                    Decline: function() {
                        $.get('/auto/chat_decline?identifier=<?= $chat . '-'. $chat->unique; ?>&sender=<?= Core::$user->username; ?>&senderi=<?= Core::$user; ?>&senderp=<?= Core::$user->password; ?>&reciever=<?= $reciever->username; ?>&recieveri=<?= $reciever; ?>');

                        $(this).dialog('close');
                        origFocus.focus();
                    },
                    Accept: function() {
                        <?php if ((Core::$user->credits >= 1 AND Core::$user->membership->status > 1) OR ! empty(Core::$user->flirtbucks_id) OR (Core::$user->membership->id >= 9 AND Core::$user->membership->id <= 15)): ?>
                        $.get('/auto/chat_accept?identifier=<?= $chat . '-'. $chat->unique; ?>&sender=<?= Core::$user->username; ?>&senderi=<?= Core::$user; ?>&senderp=<?= Core::$user->password; ?>&reciever=<?= $reciever->username; ?>&recieveri=<?= $reciever; ?>');

                        $('body').prepend('<div style="position: absolute; top: <?= ( ! empty($_COOKIE['chat' . $chat . 'y'])) ? $_COOKIE['chat' . $chat . 'y'] : '50' ; ?>px; left: <?= ( ! empty($_COOKIE['chat' . $chat . 'x'])) ? $_COOKIE['chat' . $chat . 'x'] : $xoffset ; ?>px; border: 2px solid #95999C; z-index: 10;" chatid="<?= $chat; ?>" class="chat-window" id="chatwindow-<?= $reciever->username; ?>" url="identifier=<?= $chat . '-'. $chat->unique; ?>&sender=<?= Core::$user->username; ?>&senderi=<?= Core::$user; ?>&senderp=<?= Core::$user->password; ?>&reciever=<?= $reciever->username; ?>&recieveri=<?= $reciever; ?>"></div>');

                        $('#chatwindow-<?= $reciever->username; ?>').initiateChat({ 
                            from: '<?= Core::$user->username ?>', 
                            to: '<?= $reciever->username; ?>', 
                            fromid: '<?= Core::$user ?>', 
                            toid: '<?= $reciever; ?>',
	                        gender: '<?= Core::$user->gender; ?>',
                            toImage: '/<?= Content::factory($reciever->username)->get_photo($reciever->avatar, 'a'); ?>', 
                            identifier: '<?= $chat . '-' . $chat->unique ?>'
                        });

                        // ignoreprompt: '<?= (Core::$user AND ! empty(Core::$user->flirtbucks_id)) ? 'true' : 'false'; ?>',

                        $('#chatwindow-<?= $reciever->username; ?>').focus();

                        $('html,body').animate({scrollTop: $('#chatwindow-<?= $reciever->username; ?>').offset().top-400},500);

                        $(this).dialog('close');
                        <?php else: ?>
                                $.get('/auto/chat_decline?identifier=<?= $chat . '-'. $chat->unique; ?>&sender=<?= Core::$user->username; ?>&senderi=<?= Core::$user; ?>&senderp=<?= Core::$user->password; ?>&reciever=<?= $reciever->username; ?>&recieveri=<?= $reciever; ?>');

                            $(this).dialog('close');

                            <?php if (Core::$user->membership->status == 0): ?>
                                $.colorbox({inline:true, width:'560px', height:'200px', href:'#inline_activate'})

                            <?php elseif (Core::$user->membership->status <= 1): ?>
                                alert('You must be a paying member to use feature.');

                                location.href = '/user/upgrade';
                            <?php else: ?>
                                alert('You do not have enough credits to initiate a chat session.');

                                location.href = '/credits/buy';
                            <?php endif; ?>
                        <?php endif; ?>

                        origFocus.focus();
                    }
                }
            });

            setTimeout('$(\'#dialog-confirm-<?= $chat; ?>\').dialog(\'close\')', 150000);
        }
    });
</script>
<?php
        }
    }

    $free_request_display = null;
    $interval1 = Cookie::get('rc1');
    $interval2 = Cookie::get('rc2');

    if (isset($interval1) AND time() > strtotime('+' . $interval1 . ' minutes', Cookie::get('login_time', time())) AND Core::$user->membership->status == 1)
    {
        $free_request_display = 'rc1';
        $reciever = Cookie::get('rc1id');

        if ( ! isset($reciever))
        {
            $community = ORM::factory('user')->where('membership_id', 'IN', new Database_Expression('(10, 11, 12)'))->order_by(new Database_Expression('RAND()'))->limit(1);
            $ommunity = $community->where('country_id', '=', Core::$user->country)->where('region_id', '=', Core::$user->region);
            $reciever = $community->find();

            if ( ! $reciever->loaded())
            {
                $community = ORM::factory('user')->where('membership_id', 'IN', new Database_Expression('(10, 11, 12)'))->order_by(new Database_Expression('RAND()'))->limit(1);
                $reciever = $community->find();
            }

            Cookie::set('rc1id', $reciever);
        }
        else
        {
            $reciever = ORM::factory('user', $reciever);
        }
     }

    if (isset($interval2) AND time() > strtotime('+' . $interval2 . ' minutes', Cookie::get('login_time', time())) AND Core::$user->membership->status == 1)
    {
        $free_request_display = 'rc2';
        $reciever = Cookie::get('rc2id');

        if ( ! isset($reciever))
        {
            $community = ORM::factory('user')->where('membership_id', 'IN', new Database_Expression('(10, 11, 12)'))->order_by(new Database_Expression('RAND()'))->limit(1);
            $reciever = $community->find();

            Cookie::set('rc2id', $reciever);
        }
        else
        {
            $reciever = ORM::factory('user', $reciever);
        }
    }

    if (isset($free_request_display))
    {
?>
<script language="javascript" type="text/javascript">
    $(document).ready(function() {
        if ( ! $("#dialog-confirm-<?= $free_request_display; ?>").length )
        {
            $('body').prepend('' +
                '<div id="dialog-confirm-<?= $free_request_display; ?>" title="Chat Request" style="display; none; overflow: hidden;">' +
                '    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>' +
                '    <?= $reciever->username; ?> would like to chat with you.' +
                <?php if (Core::$user->membership->status > 1): ?>
                '    <span style="font-family: verdana; font-size: 10px; color: #999; margin-bottom: -15px; display: block;">Text chat is 1 credit per minute</span>' +
                <?php endif; ?>
                '' +
                '    <ul>' +
                '        <li class="profile-details <?= $reciever->membership->type; ?>User" style="padding-top: 3px; padding-left: 3px;">' +
                '            <?= HTML::anchor('profile/' . $reciever->username, HTML::image(Content::factory($reciever->username)->get_photo($reciever->avatar, 'm'), array('class' => 'profile-pic'))); ?>' +
                '            <?= HTML::anchor('profile/' . $reciever->username, $reciever->username, array('class' => 'username', 'style' => 'font-size: 16px;')); ?><br />' +
                '            <span style="font-size: 12px; font-family: verdana; color: #666;"><?= Functions::get_age($reciever->birthdate); ?> / <?= $reciever->gender; ?><br />' +
                '            <?= $reciever->city->full_name . ', ' . $reciever->region->name . ', ' . $reciever->country->name; ?><br /></span>' +
                '            ' +
                '            <ul class="profile-options" style="padding-top: 5px;">' +
                '                <li style="float: left; padding-right: 10px; cursor: pointer;">' +
                '                    <div class="profile-button addfav" link="<?= URL::site('playbook/favorite/' . strtolower($reciever->username)); ?>">' +
                '                        <div>' +
                                            <?php
                                                $contact = ORM::factory('contact')
                                                    ->where_open()
                                                    ->where('to_id', '=', Core::$user)
                                                    ->and_where('from_id', '=', $reciever)
                                                    ->where_close()
                                                    ->or_where_open()
                                                    ->where('to_id', '=', $reciever)
                                                    ->and_where('from_id', '=', Core::$user)
                                                    ->where_close()
                                                    ->find();

                                                $favorite = FALSE;

                                                if ($contact->loaded())
                                                {
                                                    if ($contact->from->id == Core::$user->id AND $contact->to->id == $reciever->id AND $contact->contact_type->type == 'Favorite')
                                                    {
                                                        $favorite = TRUE;
                                                    }
                                                    elseif ($contact->from->id == Core::$user->id AND $contact->to->id == $reciever->id AND $contact->contact_type->type == 'Match')
                                                    {
                                                        $favorite = TRUE;
                                                    }
                                                    elseif ($contact->from->id == $reciever->id AND $contact->to->id == Core::$user->id AND $contact->contact_type->type == 'Favorite')
                                                    {
                                                        $favorite = FALSE;
                                                    }
                                                    elseif ($contact->from->id == $reciever->id AND $contact->to->id == Core::$user->id AND $contact->contact_type->type == 'Match')
                                                    {
                                                        $favorite = TRUE;
                                                    }
                                                }
                                            ?>
                                            <?php if ($favorite == TRUE): ?>
                '                            <?=HTML::image('assets/img/icons/favadded.png', array('alt' => 'Remove from Faves', 'tag' => '/assets/img/icons/favadded')); ?>' +
                                            <?php else: ?>
                '                            <?=HTML::image('assets/img/icons/fav.png', array('alt' => 'Add to Faves', 'tag' => '/assets/img/icons/fav')); ?>' +
                                            <?php endif; ?>
                '                        </div>' +
                '                    </div>' +
                '                </li>' +
                '                <li style="float: left; padding-right: 10px; cursor: pointer;">' +
                '                    <div class="profile-button" link="<?= URL::site('message/new/' . strtolower($reciever->username)); ?>">' +
                '                        <div>' +
                '                            <?=HTML::image('assets/img/icons/email.png', array('alt' => 'Send a Message')); ?>' +
                '                        </div>' +
                '                    </div>' +
                '                </li>' +
                                <?php if ($reciever->webcam == 'Yes'): ?>
                '                <li>' +
                '                    <div class="profile-button" link="" style="cursor: default;">' +
                '                        <div>' +
                '                            <?=HTML::image('assets/img/icons/webcam.png', array('alt' => 'User has a Webcam')); ?>' +
                '                        </div>' +
                '                    </div>' +
                '                </li>' +
                                <?php endif; ?>
                '            </ul>' +
                '            <div class="clear"></div>' +
                '        </li>' +
                '    </ul>' +
                '    </p>' +
                '    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="1" height="1" id="pop_sound" align="middle">' +
                '        <param name="movie" value="/assets/pop.swf?<?= time(); ?>"/>' +
                '        <!--[if !IE]>-->' +
                '        <object type="application/x-shockwave-flash" data="/assets/pop.swf?<?= time(); ?>" width="1" height="1">' +
                '            <param name="movie" value="/assets/pop.swf?<?= time(); ?>"/>' +
                '        <!--<![endif]-->' +
                '            <a href="http://www.adobe.com/go/getflash">' +
                '                <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player"/>' +
                '            </a>' +
                '        <!--[if !IE]>-->' +
                '        </object>' +
                '        <!--<![endif]-->' +
                '    </object>' +
                '</div>');

            //playPOP();

            $("#dialog-confirm-<?= $free_request_display; ?>").dialog({
                resizable: false,
                height: 255,
                width: 350,
                modal: true,
                buttons: {
                    Decline: function() {
                        $.cookie('<?= $free_request_display; ?>', null, { path: '/' });
                        $.cookie('<?= $free_request_display; ?>id', null, { path: '/' });

                        $(this).dialog('close');
                    },
                    Accept: function() {
                        $.cookie('<?= $free_request_display; ?>', null, { path: '/' });
                        $.cookie('<?= $free_request_display; ?>id', null, { path: '/' });

                        alert('You must be a paying member to use feature.');

                        location.href = '/user/upgrade';

                        $(this).dialog('close');
                    }
                }
            });
        }

        if ( $('.ui-dialog-content') ) {
            $('.ui-dialog-content').css("height", "136px");
        }
    });
</script>
<?php
    }
?>