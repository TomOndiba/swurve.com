<h1><?= __('Welcome ' . Core::$user->username . ', get your Swurve on!'); ?></h1>

<p>Before you do so, you must activate your account.  An email was sent to <?= Core::$user->email; ?> containing the steps to activate your account.</p>
<p>Didn't recieve your activation code at <?= Core::$user->email; ?>? <?= HTML::anchor('user/resend/activation', 'Click here'); ?> to correct and resubmit.</p>