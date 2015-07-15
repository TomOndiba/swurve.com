<?php $referral = Cookie::get('referral', NULL); ?>
<h1>How the Chat Hostess Program Works</h1>

<p>The FlirtBucks Chat Hostess program offers paid incentives to women who enjoy socially interacting with men in a flirtatious and casual atmosphere. This is not a "paid to date" program or an adult cam performer program. FlirtBucks does not aim to encourage you to do anything outside your comfort zone or to be anyone you're not. We put you in full control of who you choose to chat with, how long, and what you choose to talk about. You can share as much or as little of yourself as you choose at your sole discretion.</p>

<p>FlirtBucks incentives are offered on a per minute basis and rates are decided on a sliding scale based on the length of time a hostess remains active within the Program.</p>

<div style="margin-left: 120px;">
    <div style="float: left; font-size: 16px; font-weight: bold; width: 150px; line-height: 20px;">
        <div style="font-size: 16px; padding: 3px; text-align: center;">&nbsp;</div>
        <div style="font-size: 16px; padding: 3px; text-align: right; margin-right: 5px; margin-top: 1px;">Text Chat</div>
        <div style="font-size: 16px; padding: 3px; text-align: right; margin-right: 5px; margin-top: 1px;">Video Chat</div>
    </div>
    <div style="float: left; width: 150px; font-size: 16px; line-height: 20px;">
        <div style="font-size: 16px; padding: 3px; text-align: center; font-weight: bold;">0-3 Months</div>
        <div style="background-color: #FFFDFB; border-left: 1px solid #95999C; border-top: 1px solid #95999C; color: #000; font-size: 14px; padding: 3px; text-align: center;">10 cents per min</div>
        <div style="width: 150px; background-color: #FEF4EC; border-left: 1px solid #95999C; border-bottom: 1px solid #95999C; border-top: 1px solid #95999C; color: #000; font-size: 14px; padding: 3px; text-align: center;">40 cents per min</div>
    </div>
    <div style="float: left; width: 150px; font-size: 16px; line-height: 20px;">
        <div style="font-size: 16px; padding: 3px; text-align: center; font-weight: bold;"><?php if (empty($referral)): ?>3-6 Months<?php else: ?>3+ Months<?php endif; ?></div>
        <div style="background-color: #FFF3F8; border-top: 1px solid #95999C; border-right: 1px solid #95999C; border-left: 1px solid #95999C;color: #000; font-size: 14px; padding: 3px; text-align: center;">12 cents per min</div>
        <div style="background-color: #FEE8F3; border: 1px solid #95999C; color: #000; font-size: 14px; padding: 3px; text-align: center;">45 cents per min</div>
    </div>
    <?php if (empty($referral)): ?>
    <div style="float: left; width: 150px; font-size: 16px; line-height: 20px;">
        <div style="font-size: 16px; padding: 3px; text-align: center; font-weight: bold;">6+ Months</div>
        <div style="background-color: #FCD8E2; border-right: 1px solid #95999C; border-top: 1px solid #95999C; color: #000; font-size: 14px; padding: 3px; text-align: center;">15 cents per min</div>
        <div style="background-color: #FABED9; border-bottom: 1px solid #95999C; border-right: 1px solid #95999C; border-top: 1px solid #95999C; color: #000; font-size: 14px; padding: 3px; text-align: center;">50 cents per min</div>
    </div>
    <?php endif; ?>
</div>

<div class="clear"></div><br />

<p>Maintaining an active hostess account is simple, all you have to do is consistantly accumulate minutes within consecutive pay periods. Each pay period is roughly 2 weeks in length, so even if you go on vacation, your school schedule picks up or you just need to take some personal time out for yourself, as long as you pop online and log a few minutes every two weeks you can maintain your account's activity.</p>

<?= HTML::image('assets/img/flirtbucks/money.png', array('style' => 'float: right; text-align: right; padding-left: 20px;')); ?>
<p>
    Earning money with FlirtBucks as simple as that! Unlike other programs you don't need to advertise outside the community, engage in any marketing, selling or generate traffic. There are no hardware investments to make or complicated software programs to download. We do all that for you. We provide the community and offer you paid incentives to interract within it. All you need is access to a computer with a working webcam and a high speed internet connection and you've got all the tools you need to start making the BIG bucks with FlirtBucks!
    <br /><center><?= HTML::anchor('/account/create', HTML::image('assets/img/flirtbucks/button-apply.png'), array('style' => 'background-color: #FBF7EE;')); ?></center>
</p>