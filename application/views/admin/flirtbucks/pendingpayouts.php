<h1>Pending Flirtbucks Payouts</h1>

<?php if (count($camgirls) == 0): ?>
<p>No camgirls found with pending commission.</p>
<?php endif; ?>

<?= Form::open(); ?>
<?php foreach($camgirls as $camgirl): ?>
<strong>Flirtbucks ID <?= $camgirl->id; ?> [Swurve ID <?= $camgirl->swurve_id; ?>] - Pending Commission: <span style="color: green">$<?= $camgirl->pending_commission; ?></span></strong> <?= Form::checkbox('paid[]', $camgirl->id); ?> Paid <br />
<strong>Name</strong>: <?= $camgirl->first_name; ?> <?= $camgirl->last_name; ?><br />
<strong>Address</strong>:<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $camgirl->address; ?><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $camgirl->city; ?>, <?= $camgirl->region->name; ?> (<?= $camgirl->country->name; ?>), <?= $camgirl->zip_code; ?><br />
<strong>Payment Method</strong>: <?= $camgirl->payment_method; ?> <?= ($camgirl->payment_method != 'Check') ? ' - ' . $camgirl->payment_method_account : ''; ?><br />
<br />
<hr>
<?php endforeach; ?>
<?php if (count($camgirls) > 0): ?>
<center><?= Form::submit('submit', 'Submit'); ?></center>
<?php endif; ?>
<?= Form::close(); ?>