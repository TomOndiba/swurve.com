<?php if ( ! empty($results)): $chat_total = 0; ?>
<h3 class="blue">Community Accounts</h3><br />

<h4>Order By</h4>
<a href="?order=lastmsg" <?php if (Arr::get($_GET, 'order', 'lastmsg') == 'lastmsg'): ?>style="text-decoration: none; background: none; color: #10476c;"<?php endif; ?>>Recently Emailed</a> - 
<a href="?order=msgcount" <?php if (Arr::get($_GET, 'order', 'lastmsg') == 'msgcount'): ?>style="text-decoration: none; background: none; color: #10476c;"<?php endif; ?>># of Unread Emails</a> - 
<a href="?order=crushcount" <?php if (Arr::get($_GET, 'order', 'lastmsg') == 'crushcount'): ?>style="text-decoration: none; background: none; color: #10476c;"<?php endif; ?>>Pending Refavorite</a> - 
<a href="?order=chatted" <?php if (Arr::get($_GET, 'order', 'lastmsg') == 'chatted'): ?>style="text-decoration: none; background: none; color: #10476c;"<?php endif; ?>>Total Chat Time</a>
<br /><br />

<h4>Chatted Stat Range</h4><br />
<form method="post">
Start Date <input type="text" name="chat_start" value="<?= isset($_POST['chat_start']) ? $_POST['chat_start'] : date('Y-m-d', strtotime('est today -7 days')); ?>" /> and
End Date <input type="text" name="chat_end" value="<?= isset($_POST['chat_end']) ? $_POST['chat_end'] : date('Y-m-d', strtotime('est today')); ?>" />
<input type="submit" name="submit_chat" value="Submit" />
</form>
<br /><br />
<ul id="search-results">
<?php foreach($results as $user):
/*
    if (isset($_POST['submit_chat']))
    {
        $results2 = ORM::factory('chat_tracker')
            ->select(new Database_Expression('SUM(credits) as minutes'))
            ->where('user_id', '=', $user)
            ->and_where('type', '=', 'Text')
            ->and_where('date', 'between', new Database_Expression(strtotime('est ' . $_POST['chat_start']) . ' AND ' . strtotime('est ' . $_POST['chat_end'] . ' 23:59:59')))
            ->find();

            //echo strtotime('est ' . $_POST['chat_start']) . ' - ';
            //echo strtotime('est ' . $_POST['chat_end'] . ' 23:59:59');
    }
    else
    {
        $results2 = ORM::factory('chat_tracker')
            ->select(new Database_Expression('SUM(credits) as minutes'))
            ->where('user_id', '=', $user)
            ->and_where('type', '=', 'Text')
            ->and_where('date', 'between', new Database_Expression(strtotime('est today -7 days') . ' AND ' . strtotime('est today 23:59:59')))
            ->find();
    }

    //echo strtotime('est today -7 days') . '<br>';
    //echo strtotime('est today') . '<br>';
*/
    $chat_total += isset($user->chatted) ? $user->chatted : 0;
?>
    <li class="profile-details">
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
                        <?php if ($favorite = FALSE): ?>
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
                <div class="profile-button" link="<?= (Functions::is_online($user->online->last_seen)) ? 'chat' : 'not online'; ?>" reci="<?= $user; ?>" recu="<?= $user->username; ?>" myu="<?= Core::$user->username; ?>" myi="<?= Core::$user; ?>" myp="<?= Core::$user->password; ?>" mys="<?= Core::$user->membership->status; ?>" credits="<?= ( ! empty(Core::$user->flirtbucks_id) OR (Core::$user->membership->id >= 9 AND Core::$user->membership->id <= 15)) ? '999' : Core::$user->credits; ?>" ignore="<?= ( ! empty(Core::$user->flirtbucks_id)) ? 'true' : 'false'; ?>">
                    <div>
                        <?=HTML::image('assets/img/icons/chat' . ((Functions::is_online($user->online->last_seen)) ? '-online.gif' : '.png'), array('alt' => 'Send an Instant Message')); ?>
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
        <div style="clear: left; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;" align="center">
        	<strong>Profile Status</strong>: <?= $user->membership->type; ?> - <?= Functions::calc_hours(isset($user->chatted) ? $user->chatted : 0); ?> chatted
        </div>

        <div style="float: left;">
	        <?= HTML::anchor('admin/blast/email/' . $user->username, 'Email Blast'); ?>, <?= HTML::anchor('admin/blast/flirt/' . $user->username, 'Flirt Blast'); ?>, <?= HTML::anchor('admin/blast/request/' . $user->username, 'Pic Request Blast'); ?>
        </div>
        <div style="float: right;">
        	<?= HTML::anchor('admin/answer/refav/' . $user->username, 'ReFav Crushes'); ?> (<strong><?= $user->crushcount; ?></strong>), <?= HTML::anchor('admin/answer/all/' . $user->username, 'Answer Emails'); ?> (<strong><?= $user->msgcount; ?></strong>)
        </div>
        <div class="clear"></div>
    </li>
<?php endforeach; ?>
</ul>
<h3><?= Functions::calc_hours($chat_total); ?> Total Min Chatted</h3>
<?php endif; ?>
