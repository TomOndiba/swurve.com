<h1>Reset Password Confirmed</h1>

<p>Your password request for the account <?= $affiliate->email; ?> has been confirmed.  A new password has been randomly generated and emailed to <?= $affiliate->email; ?>.</p>

<p><?= HTML::anchor('affiliates/account/login', 'Click here to login'); ?></p>