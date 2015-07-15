<script type="text/javascript">
    $(document).ready(function() {
        $('.confirmdelete').click(function() {
            if (confirm("Are you sure you want to delete this sub id?") != 0)
            {
                return true;
            }
            
            return false;
        });

        $('.confirmdeleteall').click(function() {
            if (confirm("Deleting a campaign will delete all associated sub id's tied with it.  Are you sure you want to delete this campaign?") != 0)
            {
                return true;
            }
            
            return false;
        });
    });
</script>

<h1>Campaigns & Sub ID's</h1>
<p>Custom Ad Campaign groups and Sub ID tracking allow you to manage multiple sources of traffic more effectively and efficiently. By taking advantage of these advanced options you can optimise your marketing efforts to ensure peak performance.</p>
<p>Campaigns are ideal for breaking out and identifying individual traffic sources and paid advertising initiatives. Campaign Groups allow you to manage marketing performance of incoming traffic from individual web properties, PPC campaigns, network ad buys or other broad marketing initiatives.</p>
<p>Sub IDs are ideal for micro managing your marketing materials. For each Campaign you can create single or multiple Sub IDs to track different tools or banner ads to see what converts better with traffic originating from a particular source. With Sub ID tracking you can conduct your own a/b testing to optimise text, link and banner placement, as well as monitor individual creative, keyword, and landing page performance.</p>
<p>A Custom Campaign isn't necessary to create and monitor Sub IDs. You can track individual marketing efforts by Sub IDs alone if you choose. Campaigns add an additional level of convenience by allowing you to view stats for a range of Sub IDs, but grouping Sub IDs into Campaigns is not necessary.</p><br />

<h2>Campaigns</h2>
<div style="background-color: #fff; border: 1px dashed #95999C; padding: 2px;">
    <?= Form::open(); ?><?= Form::hidden('action', 'newcampaign'); ?><span><?= Form::label('description', 'Campaign Description:') ?> <?= Form::input('description', NULL, array('maxlength' => '100', 'style' => 'width: 590px; vertical-align: middle;')); ?> <?= Form::submit('submit', 'Create New Campaign', array('style' => 'vertical-align: middle; width: 154px;')) ?></span><?= Form::close(); ?>
</div><br />
<?php if (count($campaigns) == 0): ?>
<p align="center">You currently have no campaigns.</p>
<?php endif; ?>
<?php $count = 0; $arrCampaigns[''] = 'Select An Optional Campaign To Assign This Sub ID'; foreach($campaigns as $campaign): ?>
<div style="background-color: #fafafa; padding: 4px; height: 19px; font-size: 10px; <?php $count++; if ($count == 1): ?> border-top: 1px solid #95999C; <?php endif; ?>border-bottom: 1px solid #95999C;"><div style="float: left;"><strong>#<?= $campaign->id; ?></strong> | <?= $campaign->description; ?> <?= ($campaign->affiliate_subs->count_all() > 0) ? '<i>(Contains Sub ID #' . Functions::ImplodeToEnglish($campaign->affiliate_subs->find_all()->as_array('id')) . ')</i>' : ''; ?></div><div style="float: right; margin-right: 5px; font-weight: bold;"><?= HTML::anchor('affiliates/campaigns?action=deletecampaign&id=' . $campaign->id, 'delete', array('class' => 'confirmdeleteall')); ?></div></div>
<?php $arrCampaigns[$campaign->id] = '#' . $campaign->id . ' | ' . $campaign->description; endforeach; ?>

<br />

<h2>Sub ID's</h2>
<div style="background-color: #fff; border: 1px dashed #95999C; padding: 2px;">
    <?= Form::open(); ?><?= Form::hidden('action', 'newsub'); ?><span><?= Form::label('description', 'Sub ID Description:') ?> <?= Form::input('description', NULL, array('maxlength' => '100', 'style' => 'width: 629px; vertical-align: middle;')); ?> <?= Form::submit('submit', 'Create New Sub ID', array('style' => 'vertical-align: middle; width: 135px;')) ?><br />
    Assign to Campaign: <?= Form::select('campaign_id', $arrCampaigns, NULL, array('style' => 'width: 627px;')); ?>
    </span><?= Form::close(); ?>
</div><br />
<?php if (count($subs) == 0): ?>
<p align="center">You currently have no sub id's.</p>
<?php endif; ?>
<?php $count = 0; foreach($subs as $sub): ?>
<div style="background-color: #fafafa; padding: 4px; height: 19px; font-size: 10px; <?php $count++; if ($count == 1): ?> border-top: 1px solid #95999C; <?php endif; ?>border-bottom: 1px solid #95999C;"><div style="float: left;"><strong>#<?= $sub->id; ?></strong> | <?= $sub->description; ?> <?= ( ! empty($sub->campaign_id)) ? '<i>(Belongs to Campaign #' . $sub->campaign_id . ')</i>' : ''; ?></div><div style="float: right; margin-right: 5px; font-weight: bold;"><?= HTML::anchor('affiliates/campaigns?action=deletesub&id=' . $sub->id, 'delete', array('class' => 'confirmdelete')); ?></div></div>
<?php endforeach; ?>