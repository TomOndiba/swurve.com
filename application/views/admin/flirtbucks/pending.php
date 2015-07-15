<?php foreach($camgirls as $camgirl): ?>
    [<?= HTML::anchor('admin/flirtbucks/pending?approve=' . $camgirl, 'approve'); ?>] [<?= HTML::anchor('admin/flirtbucks/pending?decline=' . $camgirl, 'decline'); ?>] <?= $camgirl->first_name . ' ' . $camgirl->last_name; ?> - <?= $camgirl->email; ?><br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Signed up on <?= date("F j, Y, g:i a", $camgirl->signup_date); ?><br /><br />
<?php endforeach; ?>