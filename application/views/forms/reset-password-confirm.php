<h1>Reset Password Confirmed</h1>

<p>Your password request for the account <?= $user->username; ?> has been confirmed.  A new password has been randomly generated and emailed to <?= $user->email; ?>.</p>

<p><?= HTML::anchor('user/login', 'Click here to login'); ?></p>