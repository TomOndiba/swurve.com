<h1>Pending Affiliate Payouts</h1>

<?php if (count($affiliates) == 0): ?>
<p>No affiliates found with pending commission.</p>
<?php endif; ?>

<?= Form::open(); ?>
<?php foreach($affiliates as $affiliate): ?>
<strong>Affiliate ID <?= $affiliate->id; ?> - Pending Commission: <span style="color: green">$<?= $affiliate->pending_commission; ?></span></strong> <?= Form::checkbox('paid[]', $affiliate->id); ?> Paid <br />
<strong>Company</strong>: <?= $affiliate->company; ?> (<?= ( ! empty($affiliate->site_url)) ? HTML::anchor($affiliate->site_url, $affiliate->site_url, array('target' => '_blank')) : ''; ?>)<br />
<strong>Name</strong>: <?= $affiliate->first_name; ?> <?= $affiliate->last_name; ?><br />
<strong>Address</strong>:<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $affiliate->address; ?><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $affiliate->city; ?>, <?= $affiliate->region->name; ?> (<?= $affiliate->country->name; ?>), <?= $affiliate->zip_code; ?><br />
<strong>Payment Method</strong>: <?= $affiliate->payment_method; ?> <?= ($affiliate->payment_method != 'Check') ? ' - ' . $affiliate->payment_method_account : ''; ?><br />
<br />
<hr>
<?php endforeach; ?>
<?php if (count($affiliates) > 0): ?>
<center><?= Form::submit('submit', 'Submit'); ?></center>
<?php endif; ?>
<?= Form::close(); ?>