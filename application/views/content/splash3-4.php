<div style="background-color:  #f2f5f8; border: 2px solid #babec1; color: #10476c; padding: 20px;">
		<div id="rightcontent" style=" width: 325px; display: inline-block; float: right; margin-right: -10px; margin-top: 2px;">
        <ul>
            <li>
                <div class="profile-button addfav" link="<?= URL::site('user/register'); ?>">
                    <div>
                        <?=HTML::image('assets/img/icons/fav.png', array('alt' => 'Add to Faves', 'tag' => '/assets/img/icons/fav')); ?>
                        Add
                    </div>
                </div>
            </li>
            <li>
                <div class="profile-button" link="<?= URL::site('user/register'); ?>">
                    <div>
                        <?=HTML::image('assets/img/icons/flirt.png', array('alt' => 'Flirt with StacePlayzToo')); ?>
                        Flirt
                    </div>
                </div>
            </li>
            <li>
                <div class="profile-button" link="<?= URL::site('user/register'); ?>">
                    <div>
                        <?=HTML::image('assets/img/icons/email.png', array('alt' => 'Send a Message')); ?>
                        Email
                    </div>
                </div>
            </li>
            <li>
                <div class="profile-button" link="<?= URL::site('user/register'); ?>">
                    <div>
                        <?=HTML::image('assets/img/icons/chat-online.gif', array('alt' => 'Send an Instant Message')); ?>
                        Chat
                    </div>
                </div>
            </li>
            <li>
                <div class="profile-button" link="<?= URL::site('user/register'); ?>">
                    <div>
                        <?=HTML::image('assets/img/icons/webcam.png', array('alt' => 'User has a Webcam')); ?>
                        Webcam
                    </div>
                </div>
            </li>
        </ul>
    </div>

		<span style="font-size: 22px; font-weight: bold;">StacePlayzToo</span><br />
		<span style="font-style: italic; font-size: 12px; display: inline-block;">"smart, sexy, and sarcastic"</span><br />
		<span style="font-size: 14px; font-weight: bold; display: inline-block;">24/F <?= $geolocation; ?></span>
</div>

<br />

<h2>Recent Activity</h2>

<div style="background-color: #fff; border: 1px solid #95999C; padding: 10px;">
		<div class="activity-feed">
    		<a href="/user/register"><img src="/assets/img/splash3/StacePlayzToo/StacePlayzTootm.png" class="profile-pic" /></a>    <p><strong><a href="/user/register">StacePlayzToo</a></strong> uploaded the following <a href="/user/register">New Photo(s)</a><br /><span class="date">8 min ago</span></p>

				<div class="additional-photos">
						<a href="/user/register"><img src="/assets/img/splash3/StacePlayzToo/StacePlayzToo1.png" class="profile-pic" /></a>
						<a href="/user/register"><img src="/assets/img/splash3/StacePlayzToo/StacePlayzToo2.png" class="profile-pic" /></a>
						<a href="/user/register"><img src="/assets/img/splash3/StacePlayzToo/StacePlayzToo3.png" class="profile-pic" /></a>
						<div class="clear"></div>
						<span class="date" style="display: block; margin-top: 5px;">* Thumbnails will not appear until photos have been approved.</span>
        </div>
    </div>

		<div class="activity-feed" style="margin-left: 50px;">
				<a href="/user/register"><img src="/assets/img/splash3/guys/FineYngMan69.png" class="profile-pic" /></a>    <p><strong><a href="/user/register">FineYngMan69</a></strong> So gorgeous! Nice talking to you! Stay sweet XOXO<br /><span class="date">5 min ago</span></p>
		</div>

		<div class="activity-feed" style="margin-left: 50px;">
				<a href="/user/register"><img src="/assets/img/splash3/guys/Glassjaw.png" class="profile-pic" /></a>    <p><strong><a href="/user/register">Glassjaw</a></strong> Deep throat!!!!<br /><span class="date">2 min ago</span></p>
		</div>

		<div class="activity-feed">
			<a href="/user/register"><img src="/assets/img/splash3/StacePlayzToo/StacePlayzTootm.png" class="profile-pic" /></a>    <p><strong><a href="/user/register">StacePlayzToo</a></strong> uploaded the following <a href="/user/register">New Photo(s)</a><br /><span class="date"><?= date('M j', strtotime('now - 3 days')); ?> @ 11:49 PM</span></p>

			<div class="additional-photos">
					<a href="/user/register"><img src="/assets/img/splash3/StacePlayzToo/StacePlayzToo4.png" class="profile-pic" /></a>
					<a href="/user/register"><img src="/assets/img/splash3/StacePlayzToo/StacePlayzToo5.png" class="profile-pic" /></a>
					<a href="/user/register"><img src="/assets/img/splash3/StacePlayzToo/StacePlayzToo6.png" class="profile-pic" /></a>
					<div class="clear"></div>
					<span class="date" style="display: block; margin-top: 5px;">* Thumbnails will not appear until photos have been approved.</span>
        </div>
    </div>

		<div class="activity-feed" style="margin-left: 50px;">
				<a href="/user/register"><img src="/assets/img/splash3/guys/Crash88.png" class="profile-pic" /></a>    <p><strong><a href="/user/register">Crash88</a></strong> Next time you guys are going to be there holla at your boy<br /><span class="date"><?= date('M j', strtotime('now - 3 days')); ?> @ 11:56 PM</span></p>
		</div>

		<div class="activity-feed" style="margin-left: 50px;">
				<a href="/user/register"><img src="/assets/img/splash3/guys/Eric92734.png" class="profile-pic" /></a>    <p><strong><a href="/user/register">Eric92734</a></strong> You're even prettier on cam babe<br /><span class="date"><?= date('M j', strtotime('now - 3 days')); ?> @ 11:59 PM</span></p>
		</div>
</div>

<a href="/user/register"><h2 style="text-align: center; text-decoration: underline; font-weight: normal; margin-top: 10px; font-size: 14px;">Load More Recent Activity</h2></a>
