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
                        <?=HTML::image('assets/img/icons/flirt.png', array('alt' => 'Flirt with XXXtina69')); ?>
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

		<span style="font-size: 22px; font-weight: bold;">XXXtina69</span><br />
		<span style="font-style: italic; font-size: 12px; display: inline-block;">"smart, sexy, and sarcastic"</span><br />
		<span style="font-size: 14px; font-weight: bold; display: inline-block;">24/F <?= $geolocation; ?></span>
</div>

<br />

<h2>Recent Activity</h2>

<div style="background-color: #fff; border: 1px solid #95999C; padding: 10px;">
		<div class="activity-feed">
    		<a href="/user/register"><img src="/assets/img/splash3/XXXtina69/XXXtina69tm.png" class="profile-pic" /></a>    <p><strong><a href="/user/register">XXXtina69</a></strong> uploaded the following <a href="/user/register">New Photo(s)</a><br /><span class="date">8 min ago</span></p>

				<div class="additional-photos">
						<a href="/user/register"><img src="/assets/img/splash3/XXXtina69/XXXtina691.png" class="profile-pic" /></a>
						<a href="/user/register"><img src="/assets/img/splash3/XXXtina69/XXXtina692.png" class="profile-pic" /></a>
						<a href="/user/register"><img src="/assets/img/splash3/XXXtina69/XXXtina693.png" class="profile-pic" /></a>
						<a href="/user/register"><img src="/assets/img/splash3/XXXtina69/XXXtina694.png" class="profile-pic" /></a>
						<div class="clear"></div>
						<span class="date" style="display: block; margin-top: 5px;">* Thumbnails will not appear until photos have been approved.</span>
        </div>
    </div>

		<div class="activity-feed" style="margin-left: 50px;">
				<a href="/user/register"><img src="/assets/img/splash3/guys/SirLicksALot.png" class="profile-pic" /></a>    <p><strong><a href="/user/register">SirLicksALot</a></strong> Oh my god that's amazingly hot!<br /><span class="date">5 min ago</span></p>
		</div>

		<div class="activity-feed" style="margin-left: 50px;">
				<a href="/user/register"><img src="/assets/img/splash3/guys/Lookn4UBabe.png" class="profile-pic" /></a>    <p><strong><a href="/user/register">Lookn4UBabe</a></strong> I can't believe you girls did that<br /><span class="date">2 min ago</span></p>
		</div>

		<div class="activity-feed">
			<a href="/user/register"><img src="/assets/img/splash3/XXXtina69/XXXtina69tm.png" class="profile-pic" /></a>    <p><strong><a href="/user/register">XXXtina69</a></strong> uploaded the following <a href="/user/register">New Photo(s)</a><br /><span class="date"><?= date('M j', strtotime('now - 3 days')); ?> @ 11:49 PM</span></p>

			<div class="additional-photos">
					<a href="/user/register"><img src="/assets/img/splash3/XXXtina69/XXXtina695.png" class="profile-pic" /></a>
					<a href="/user/register"><img src="/assets/img/splash3/XXXtina69/XXXtina696.png" class="profile-pic" /></a>
					<div class="clear"></div>
					<span class="date" style="display: block; margin-top: 5px;">* Thumbnails will not appear until photos have been approved.</span>
        </div>
    </div>

		<div class="activity-feed" style="margin-left: 50px;">
				<a href="/user/register"><img src="/assets/img/splash3/guys/ShyGuy987.png" class="profile-pic" /></a>    <p><strong><a href="/user/register">ShyGuy987</a></strong> Don't forget to call me later<br /><span class="date"><?= date('M j', strtotime('now - 3 days')); ?> @ 11:56 PM</span></p>
		</div>

		<div class="activity-feed" style="margin-left: 50px;">
				<a href="/user/register"><img src="/assets/img/splash3/guys/Sean77.png" class="profile-pic" /></a>    <p><strong><a href="/user/register">Sean77</a></strong> You're so crazy<br /><span class="date"><?= date('M j', strtotime('now - 3 days')); ?> @ 11:59 PM</span></p>
		</div>
</div>

<a href="/user/register"><h2 style="text-align: center; text-decoration: underline; font-weight: normal; margin-top: 10px; font-size: 14px;">Load More Recent Activity</h2></a>
