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
                        <?=HTML::image('assets/img/icons/flirt.png', array('alt' => 'Flirt with SexyKatey24')); ?>
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

		<span style="font-size: 22px; font-weight: bold;">SexyKatey24</span><br />
		<span style="font-style: italic; font-size: 12px; display: inline-block;">"smart, sexy, and sarcastic"</span><br />
		<span style="font-size: 14px; font-weight: bold; display: inline-block;">24/F <?= $geolocation; ?></span>
</div>

<br />

<h2>Recent Activity</h2>

<div style="background-color: #fff; border: 1px solid #95999C; padding: 10px;">
		<div class="activity-feed">
    		<a href="/user/register"><img src="/assets/img/splash3/SexyKatey24/SexyKatey24tm.png" class="profile-pic" /></a>    <p><strong><a href="/user/register">SexyKatey24</a></strong> uploaded the following <a href="/user/register">New Photo(s)</a><br /><span class="date">8 min ago</span></p>

				<div class="additional-photos">
						<a href="/user/register"><img src="/assets/img/splash3/SexyKatey24/SexyKatey241.png" class="profile-pic" /></a>
						<a href="/user/register"><img src="/assets/img/splash3/SexyKatey24/SexyKatey242.png" class="profile-pic" /></a>
						<a href="/user/register"><img src="/assets/img/splash3/SexyKatey24/SexyKatey243.png" class="profile-pic" /></a>
						<div class="clear"></div>
						<span class="date" style="display: block; margin-top: 5px;">* Thumbnails will not appear until photos have been approved.</span>
        </div>
    </div>

		<div class="activity-feed" style="margin-left: 50px;">
				<a href="/user/register"><img src="/assets/img/splash3/guys/Crash88.png" class="profile-pic" /></a>    <p><strong><a href="/user/register">Crash88</a></strong> ...hell yes.<br /><span class="date">5 min ago</span></p>
		</div>

		<div class="activity-feed" style="margin-left: 50px;">
				<a href="/user/register"><img src="/assets/img/splash3/guys/Drew90.png" class="profile-pic" /></a>    <p><strong><a href="/user/register">Drew90</a></strong> I have new pictures up. Let me know what you think.<br /><span class="date">2 min ago</span></p>
		</div>

		<div class="activity-feed">
			<a href="/user/register"><img src="/assets/img/splash3/SexyKatey24/SexyKatey24tm.png" class="profile-pic" /></a>    <p><strong><a href="/user/register">SexyKatey24</a></strong> uploaded the following <a href="/user/register">New Photo(s)</a><br /><span class="date"><?= date('M j', strtotime('now - 3 days')); ?> @ 11:49 PM</span></p>

			<div class="additional-photos">
					<a href="/user/register"><img src="/assets/img/splash3/SexyKatey24/SexyKatey244.png" class="profile-pic" /></a>
					<a href="/user/register"><img src="/assets/img/splash3/SexyKatey24/SexyKatey245.png" class="profile-pic" /></a>
					<div class="clear"></div>
					<span class="date" style="display: block; margin-top: 5px;">* Thumbnails will not appear until photos have been approved.</span>
        </div>
    </div>

		<div class="activity-feed" style="margin-left: 50px;">
				<a href="/user/register"><img src="/assets/img/splash3/guys/FineYngMan69.png" class="profile-pic" /></a>    <p><strong><a href="/user/register">FineYngMan69</a></strong> wanna trade pics?<br /><span class="date"><?= date('M j', strtotime('now - 3 days')); ?> @ 11:56 PM</span></p>
		</div>
</div>

<a href="/user/register"><h2 style="text-align: center; text-decoration: underline; font-weight: normal; margin-top: 10px; font-size: 14px;">Load More Recent Activity</h2></a>
