<h1>Flirtbucks Support</h1>

<p>We believe support come first here at Flirtbucks, so if you have any questions or comments about the Flirtbucks program or your account. Please email us @ <?= HTML::mailto('support@flirtbucks.net'); ?> and we will get back to you.</p>

<?php if ($page == 'w9'): ?>
<div class="alert" style="font-weight: normal; padding-bottom: 0px;">
    <p>To comply with regulations we require a completed W-9 form for all affiliates based within the United States.</p>
    <p>You can download the W-9 form at the following: <?= HTML::anchor('http://www.irs.gov/pub/irs-pdf/fw9.pdf', NULL, array('target' => '_blank')); ?></p>
    <p>You can submit your completed form by fax to 727-330-7225, by attaching a scanned completed document to <?= HTML::mailto('support@flirtbucks.net'); ?> or by mailing to our physical address at:<br /> <span style="display: block; margin-left: 500px;">Swurve Media Corp<br />1497 Main St, Suite 331<br />Dunedin, FL 34698</span></p>
    
    <p>We reserve the right to withhold all pending payments to you until a completed W-9 form has been received.</p>
</div>
<?php endif; ?>