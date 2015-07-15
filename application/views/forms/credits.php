<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?= Form::open(NULL, array('id' => 'credits')); ?>
<?= Form::hidden('action', 'New'); ?>
<?php if ( ! empty($reason)): ?>
<div class="fail" align="center">Your transaction has failed with the reason: <?= $reason; ?><br />Please correct the problem and resubmit or contact support for more help.</div>
<?php endif; ?>

<?php if ( is_array($errors)): ?>
<div class="info" align="center"><span class="error">*</span>You have not filled out all the required information below, please correct the highlighted area(s).</div>
<?php endif; ?>

<div class="step">
    <?= HTML::image('assets/img/upgrade/1.png', array('alt' => 'Choose Your Plan', 'style' => 'vertical-align: middle;')); ?> Choose Your Package<?= ( ! empty($errors['package'])) ? '<span class="error">*</span>' : ''; ?>
    <div class="data">
        <table cellspacing="1" cellpadding="0" id="feature-list">
            <tr>
                <td class="table-header2" style="text-align: center; font-weight: bold; font-size: 17px; vertical-align: middle; padding-top: 0px; padding-bottom: 0;">50 <!--span style="font-size: 19px;">60</span--> Credits</td>
                <td class="table-header2" style="text-align: center; font-weight: bold; font-size: 17px; vertical-align: middle; padding-top: 0px; padding-bottom: 0;">150 <!--span style="font-size: 19px;">175</span--> Credits</td>
                <td class="table-header2" style="text-align: center; font-weight: bold; font-size: 17px; vertical-align: middle; padding-top: 0px; padding-bottom: 0;">350 <!--span style="font-size: 19px;">400</span--> Credits</td>
                <td class="table-header2" style="text-align: center; font-weight: bold; font-size: 17px; vertical-align: middle; padding-top: 0px; padding-bottom: 0;">500 <!--span style="font-size: 19px;">600</span--> Credits</td>
            </tr>
            <tr>
                <td class="table-header2" style="text-align: center; font-weight: bold; background-color: #F9F8E4; font-size: 14px; vertical-align: middle; padding-top: 0px; padding-bottom: 0;">50¢ <!--span style="font-size: 16px;">42¢</span--> <span style="font-size: 12px;">Per Credit</span></td>
                <td class="table-header2" style="text-align: center; font-weight: bold; background-color: #F9F8E4; font-size: 14px; vertical-align: middle; padding-top: 0px; padding-bottom: 0;">40¢ <!--span style="font-size: 16px;">35¢</span--> <span style="font-size: 12px;">Per Credit</span></td>
                <td class="table-header2" style="text-align: center; font-weight: bold; background-color: #F9F8E4; font-size: 14px; vertical-align: middle; padding-top: 0px; padding-bottom: 0;">35¢ <!--span style="font-size: 16px;">30¢</span--> <span style="font-size: 12px;">Per Credit</span></td>
                <td class="table-header2" style="text-align: center; font-weight: bold; background-color: #F9F8E4; font-size: 14px; vertical-align: middle; padding-top: 0px; padding-bottom: 0;">30¢ <!--span style="font-size: 16px;">25¢</span--> <span style="font-size: 12px;">Per Credit</span></td>
            </tr>
            <tr>
                <td class="table-data" style="width: 200px; text-align: center; background-color: #FBF3E9; font-size: 20px; vertical-align: middle; padding-top: 0px; padding-bottom: 0; padding: 3px;"><?= Form::radio('package', '18', ( ! empty($post['package']) AND $post['package'] == '18') ? TRUE : FALSE, array('class' => ( ! empty($errors['package'])) ? 'err' : '')) ?> $25.00</td>
                <td class="table-data" style="width: 200px; text-align: center; background-color: #FBF3E9; font-size: 20px; vertical-align: middle; padding-top: 0px; padding-bottom: 0; padding: 3px;"><?= Form::radio('package', '19', ( ! empty($post['package']) AND $post['package'] == '19') ? TRUE : FALSE, array('class' => ( ! empty($errors['package'])) ? 'err' : '')) ?> $60.00</td>
                <td class="table-data" style="width: 200px; text-align: center; background-color: #FBF3E9; font-size: 20px; vertical-align: middle; padding-top: 0px; padding-bottom: 0; padding: 3px;"><?= Form::radio('package', '20', ( ! empty($post['package']) AND $post['package'] == '20') ? TRUE : FALSE, array('class' => ( ! empty($errors['package'])) ? 'err' : '')) ?> $120.00</td>
                <td class="table-data" style="width: 200px; text-align: center; background-color: #FBF3E9; font-size: 20px; vertical-align: middle; padding-top: 0px; padding-bottom: 0; padding: 3px;"><?= Form::radio('package', '21', ( ! empty($post['package']) AND $post['package'] == '21') ? TRUE : FALSE, array('class' => ( ! empty($errors['package'])) ? 'err' : '')) ?> $150.00</td>
            </tr>
        </table>
    </div>
</div>
<br /><br />
<div style="margin-left: 42px;">
    <div class="step2">
        <?= HTML::image('assets/img/upgrade/2.png', array('alt' => 'Payment Information', 'style' => 'vertical-align: middle;')); ?> Payment Information
        <div class="data shift">
            <table align="center" cellspacing="1" cellpadding="0" id="payment-info" style="margin-bottom: 5px;">
                <tr>
                    <td class="table-header"><?= ( ! empty($errors['first_name'])) ? '<span class="error">*</span>' : ''; ?>First Name:</td>
                    <td class="table-data"><?= Form::input('first_name', $post['first_name'], array('class' => 'stretch' . (( ! empty($errors['first_name'])) ? ' err' : ''))); ?></td>
                </tr>
                <tr>
                    <td class="table-header"><?= ( ! empty($errors['last_name'])) ? '<span class="error">*</span>' : ''; ?>Last Name:</td>
                    <td class="table-data"><?= Form::input('last_name', $post['last_name'], array('class' => 'stretch' . (( ! empty($errors['last_name'])) ? ' err' : ''))); ?></td>
                </tr>
                <tr>
                    <td class="table-header"><?= ( ! empty($errors['cc_num'])) ? '<span class="error">*</span>' : ''; ?>Credit Card #:</td>
                    <td class="table-data"><?= Form::input('cc_num', $post['cc_num'], array('class' => 'stretch' . (( ! empty($errors['cc_num'])) ? ' err' : ''))); ?></td>
                </tr>
                <tr>
                    <td class="table-header"><?= ( ! empty($errors['exp_month']) OR ! empty($errors['exp_year'])) ? '<span class="error">*</span>' : ''; ?>Expiration:</td>
                    <td class="table-data"><?= Form::select('exp_month', $exp_months, $post['exp_month'], array('class' => ( ! empty($errors['exp_month'])) ? 'err' : '')); ?> / <?= Form::select('exp_year', $exp_years, $post['exp_year'], array('class' => ( ! empty($errors['exp_year'])) ? 'err' : '')); ?></td>
                </tr>
                <tr>
                    <td class="table-header"><?= ( ! empty($errors['cvv2_num'])) ? '<span class="error">*</span>' : ''; ?>CVV2 Number:<br /><small><a href="javascript:alert('The CVV2 number is the 3-4 digit number on the back of the card.');">What is a CVV2 number?</a></small></td>
                    <td class="table-data"><?= Form::input('cvv2_num', $post['cvv2_num'], array('class' => 'stretch' . (( ! empty($errors['cvv2_num'])) ? ' err' : ''))); ?><br />
                        <?= Form::checkbox('no_cvv2', 'true', (empty($post['no_cvv2'])) ? FALSE : TRUE); ?> I do not have a CVV2 number.</td>
                </tr>
                <tr>
                    <td class="table-header"><?= ( ! empty($errors['email_address'])) ? '<span class="error">*</span>' : ''; ?>Email Address:</td>
                    <td class="table-data"><?= Form::input('email_address', $post['email_address'], array('class' => 'stretch' . (( ! empty($errors['email_address'])) ? ' err' : ''))); ?></td>
                </tr>
            </table>
            <?= HTML::image('assets/img/icons/visa.png', array('alt' => 'Visa')); ?><?= HTML::image('assets/img/icons/mastercard.png', array('alt' => 'Mastercard')); ?><?= HTML::image('assets/img/icons/discover.png', array('alt' => 'Discover')); ?><?= HTML::image('assets/img/icons/amex.png', array('alt' => 'Amex')); ?><span style="float: right; margin-right: -10px; margin-top: 20px;"><script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=XL2szzLFTDNxbYghbGcTwGkycOOXEiKe4O6YNn1qSluCcdPYTJTJQRdq90fz"></script></span>
        </div>
    </div>

    <div class="step2">
        <?= HTML::image('assets/img/upgrade/3.png', array('alt' => 'Confirm Your Identity', 'style' => 'vertical-align: middle;')); ?> Confirm Your Identity
        <div class="data shift">
            <table align="center" cellspacing="1" cellpadding="0" id='payment-info'>
                <tr>
                    <td class="table-header"><?= ( ! empty($errors['address'])) ? '<span class="error">*</span>' : ''; ?>Address:</td>
                    <td class="table-data"><?= Form::input('address', $post['address'], array('class' => 'stretch' . (( ! empty($errors['address'])) ? ' err' : ''))); ?></td>
                </tr>
                <tr>
                    <td class="table-header">Address Line 2:</td>
                    <td class="table-data"><?= Form::input('address2', $post['address2'], array('class' => 'stretch')); ?></td>
                </tr>
                <tr>
                    <td class="table-header"><?= ( ! empty($errors['city'])) ? '<span class="error">*</span>' : ''; ?>City:</td>
                    <td class="table-data"><?= Form::input('city', $post['city'], array('class' => 'stretch' . (( ! empty($errors['city'])) ? ' err' : ''))); ?></td>
                </tr>
                <tr>
                    <td class="table-header"><?= ( ! empty($errors['country'])) ? '<span class="error">*</span>' : ''; ?>Country:</td>
                    <td class="table-data"><?= Form::select('country', $countries, $post['country'], array('class' => 'stretch' . (( ! empty($errors['country'])) ? ' err' : ''))); ?></td>
                </tr>
                <tr>
                    <td class="table-header"><?= ( ! empty($errors['state'])) ? '<span class="error">*</span>' : ''; ?>State:</td>
                    <td class="table-data"><?= Form::select('state', $states, $post['state'], array('class' => 'stretch' . (( ! empty($errors['state'])) ? ' err' : ''))); ?></td>
                </tr>
                <tr>
                    <td class="table-header"><?= ( ! empty($errors['zip_code'])) ? '<span class="error">*</span>' : ''; ?>Zip/Postal Code:</td>
                    <td class="table-data"><?= Form::input('zip_code', $post['zip_code'], array('class' => 'stretch' . (( ! empty($errors['zip_code'])) ? ' err' : ''))); ?></td>
                </tr>
            </table><br />
            <small>This information must correspond to the billing address on file for the credit card you are using. This information is used for cardholder account verification only and is not stored by Swurve.com. Your IP Address <?=$_SERVER['REMOTE_ADDR']; ?> has been logged for security and fraud prevention.</small>
        </div>
    </div>
</div>
<div class="clear"></div><br />
<div class="submit-area">
    <center><?= Form::input('upgrade-submit', 'Upgrade', array('id' => 'upgrade-submit', 'type' => 'image', 'src' => '/assets/img/upgrade/submit.png')); ?><br /><br /></center>

By clicking 'Submit' you agree to the Swurve Terms of Service and Privacy Policy. This membership will appear on your statement as Swurve Media Corporation.  For billing and service purposes a month is defined as a 30 day period.
Memberships are billed to your credit card on a recurring basis for your convenience.  You may cancel your membership at any time by calling 1-888-4-SWURVE or emailing customer service at support@swurve.com. Cancellation requests must be received at least 3 business days prior to your next scheduled billing date.
All membership fees are non-refundable.
</div>
<?= Form::close(); ?>
<div class="clear"></div>

<script>
  $(document).ready(function() {
    $('#credits').submit(function() {
      $('#upgrade-submit').replaceWith('<strong>Processing Request...</strong>');
    });
  });
</script>