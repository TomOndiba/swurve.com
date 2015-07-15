<script type="text/javascript">
    $(document).ready(function() {
        $('#ppsgraph').mouseover(function(e) {
            var x = e.pageX - 250;
            var y = e.pageY - 310;
            
            $('#ppsgraphlayer').css('left', x);
            $('#ppsgraphlayer').css('top', y);
            $('#ppsgraphlayer').show();
        });
        
        $('#ppsgraphlayer').mouseout(function() {
           $(this).hide(); 
        });
        
        $('#revsharegraph').mouseover(function(e) {
            var x = e.pageX - 250;
            var y = e.pageY - 310;
            
            $('#revsharegraphlayer').css('left', x);
            $('#revsharegraphlayer').css('top', y);
            $('#revsharegraphlayer').show();
        });
        
        $('#revsharegraphlayer').mouseout(function() {
           $(this).hide(); 
        });
    });
</script>
<div id="ppsgraphlayer" style="border: 1px solid #95999C; position: absolute; display: none;"><?= HTML::image('assets/img/affiliates/PPSgraph.png'); ?></div>
<div id="revsharegraphlayer" style="border: 1px solid #95999C; position: absolute; display: none;"><?= HTML::image('assets/img/affiliates/RevSharegraph.png'); ?></div>

<h1>High Performance Payout Programs Available Exclusively from Swurve</h1><br />

<div style="clear: both; margin-bottom: 20px;">
    <?= HTML::image('assets/img/affiliates/paypersale.png', array('align' => 'left', 'style' => 'float: left; margin-right: 15px; margin-bottom: 15px;')); ?>
    <h2>Pay Per Sale</h2>
    <p style="font-size: 12px; line-height: 14px;">Affiliates of Swurve.com can earn as much as $55 per paid join. Our Pay Per Sale payment option is ideal for webmasters seeking a short term return on their traffic. The Pay Per Sale program works on a 3 tier sliding scale based on the average number of new paid joins sent per day during the stretch of the pay period. Payouts start at the base rate of $35 per paid join for webmasters submitting 0 to 9 sales per day on average. We understand your traffic is money and there's no better way to make big money fast than with our big pay per sale payouts.</p>
    <div align="center" style="margin-top: -14px;"><?= HTML::anchor('#', 'View Scale', array('id' => 'ppsgraph')); ?></div>
</div>

<div style="clear: both; margin-bottom: 20px;">
    <?= HTML::image('assets/img/affiliates/revshare.png', array('align' => 'left', 'style' => 'float: left; margin-right: 15px; margin-bottom: 15px;')); ?>
    <h2>Rev-Share</h2>
    <p style="font-size: 12px; line-height: 14px;">Rev-Share is our most lucrative payout program, ideal for affiliates who enjoy the benefits of having a recurring source of revenue. Our Rev-Share program also operates on a 3 tier sliding scale based on volume. Payouts are calculated based on the average number of new paid joins sent per day sent within the confines of the pay period. Payouts start at the base rate of 50% for webmasters submitting 0 to 9 new membership upgrades average per day. Swurve's Rev-Share Program is a true lifetime revshare, that means you earn commission on recurring transactions, not just first time sign ups and renewals. Through our Rev-Share option you earn a percentage of all membership subscription fees your traffic generates for the lifetime of your account.</p>
    <div align="center" style="margin-top: -14px;"><?= HTML::anchor('#', 'View Scale', array('id' => 'revsharegraph')); ?></div>
</div>

<div style="clear: both; margin-bottom: 20px;">
    <?= HTML::image('assets/img/affiliates/female.png', array('align' => 'left', 'style' => 'float: left; margin-right: 15px; margin-bottom: 15px;')); ?>
    <h2>Girl Power Cash Bonuses</h2>
    <p style="font-size: 12px; line-height: 14px;">Do you have female traffic? Swurve performs great with women and is a great way to monetize female surfers. We made Swurve sticky for women as well by tailoring our user interface to present female audiences with content they find relevant and intriguing. Currently affiliates are awarded a cash bonus of $45 for each active female user you refer. Affiliates running on either payment option are automatically are eligible to recieve cash bonuses for referring active women. An active female user is defined as a woman who creates a full profile and begins interracting with male users of our community. Harness the energy of Girl Power and start making money with women today.</p>
</div>

<div style="clear: both; margin-bottom: 20px;">
    <?= HTML::image('assets/img/affiliates/rewards.png', array('align' => 'left', 'style' => 'float: left; margin-right: 15px; margin-bottom: 15px;')); ?>
    <h2>Webmaster Rewards</h2>
    <p style="font-size: 12px; line-height: 14px;">Swurve gives you even more through our Webmaster Rewards program. All webmasters, regardless of chosen commission structure, can participate and start earning rewards right away. Currently, Swurve reward points are generated on a 1:1 ratio based on referred successful membership upgrades. Once the minimum number of reward points have been accrued affiliates can "cash in" their reward points for a prize currently listed on the rewards program page. The points required for the item(s) selected will be deducted from the affiliate's Reward Points balance a the prize order will be fulfilled.</p>
</div>

<div style="clear: both; margin-bottom: 20px;">
    <?= HTML::image('assets/img/affiliates/broker.png', array('align' => 'left', 'style' => 'float: left; margin-right: 15px; margin-bottom: 15px;')); ?>
    <h2>Broker Program</h2>
    <p style="font-size: 12px; line-height: 14px;">Being a brand evangelist pays and with Swurve you can earn big bucks on broker traffic. With our Broker Traffic Program affiliates earn 10% on all program earnings of all referred webmasters for the lifetime of their respective accounts. Our payouts on broker traffic are a simple, hassle free way to earn big bucks just for telling others about Swurve.</p>
</div>

<div style="clear: both; margin-bottom: 20px;">
    <h2>Swurve's Superior Sale Tracking</h2>
    <p style="font-size: 12px; line-height: 14px;">The problem with cookies is over time they can go stale. We've engineered our proprietary affiliate software to ensure you get credit for every sale sent. As internet usage has evolved surfers dump their cache and clear their cookies with higher frequency. We've evolved our tracking to match current internet usage trends. When you refer a surfer to Swurve we write your affiliate ID into their user record on the first step of registration, insuring that no matter how much time has passed or how many times they've wiped their browser- or even if they access the service from a different computer- you still get credit for the sale you've earned. Affiliates count, and our sale tracking is our way of showing our commitment to ensuring you get all the credit you deserve for your marketing efforts.</p>
</div>

<center><?= HTML::anchor('affiliates/account/create', HTML::image('assets/img/affiliates/button-join-now.png')); ?></center>