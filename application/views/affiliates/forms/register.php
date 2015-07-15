<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('input[name=payment_method]').click(function() {
            if ($(this).val() == 'CashX')
            {
                $('#cashx-account').show();
            }
            else
            {
                $('#cashx-account').hide();
            }
        });
        
        $('#signup').submit(function() {
            $('#country_id').val($('#country').val());
            $('#region_id').val($('#region').val());
            //$('#city_id').val($('#city').val());
        });
        
        $('#country').change(function() {
            if ($(this).val() == 233)
            {
                $('#ssn_tax_id-info').show();
            }
            else
            {
                $('#ssn_tax_id-info').hide();
            }
        });

        <?php if (isset($post['city']) AND ! empty($post['city'])): ?>
        //$.getJSON('/json/getname/<?= $post['city']; ?>', null, function(data)
        //{
            $('#city').val('<?= $post['city']; ?>');
        //});
        <?php endif; ?>
    });
</script>

<?= Form::open(NULL, array('id' => 'signup')); ?>
<?= Form::hidden('country_id', NULL, array('id' => 'country_id')); ?>
<?= Form::hidden('region_id', NULL, array('id' => 'region_id')); ?>

<h1 style="font-size: 26px;">Signup To Swurve &amp; Start Making More Money Today!</h1>

<div class="step">
    <?= HTML::image('assets/img/upgrade/1.png', array('alt' => 'Payment Information', 'style' => 'vertical-align: middle;')); ?> Account Information
    <div class="data shift">
        <table align="left" cellspacing="1" cellpadding="0" id="account-info" style="margin-bottom: 5px; display: inline; vertical-align: top; margin-top: 1px;">
            <tr>
                <td class="table-header"><?= ( ! empty($errors['first_name'])) ? '<span class="error">*</span>' : ''; ?>First Name:<?= ( ! empty($errors['first_name'])) ? '<br /><br />' : ''; ?></td>
                <td class="table-data">
                    <?= Form::input('first_name', $post['first_name'], array('class' => 'stretch', 'maxlength' => '50')); ?>
                    <?= (empty ($errors['first_name'])) ? '' : '<span class="errors">' . $errors['first_name'] . '</span>'; ?>
                </td>
            </tr>
            <tr>
                <td class="table-header"><?= ( ! empty($errors['last_name'])) ? '<span class="error">*</span>' : ''; ?>Last Name:<?= ( ! empty($errors['last_name'])) ? '<br /><br />' : ''; ?></td>
                <td class="table-data">
                    <?= Form::input('last_name', $post['last_name'], array('class' => 'stretch', 'maxlength' => '50')); ?>
                    <?= (empty ($errors['last_name'])) ? '' : '<span class="errors">' . $errors['last_name'] . '</span>'; ?>
                </td>
            </tr>
            <tr>
                <td class="table-header"><?= ( ! empty($errors['email'])) ? '<span class="error">*</span>' : ''; ?>Email:<?= ( ! empty($errors['email'])) ? '<br /><br />' : ''; ?></td>
                <td class="table-data">
                    <?= Form::input('email', $post['email'], array('class' => 'stretch', 'maxlength' => '255')); ?>
                    <?= (empty ($errors['email'])) ? '' : '<span class="errors">' . $errors['email'] . '</span>'; ?>
                </td>
            </tr>
            <tr>
                <td class="table-header"><?= ( ! empty($errors['password'])) ? '<span class="error">*</span>' : ''; ?>Password:<?= ( ! empty($errors['password'])) ? '<br /><br />' : ''; ?></td>
                <td class="table-data">
                    <?= Form::input('password', $post['password'], array('class' => 'stretch', 'maxlength' => '25', 'type' => 'password')); ?>
                    <?= (empty ($errors['password'])) ? '' : '<span class="errors">' . $errors['password'] . '</span>'; ?>
                </td>
            </tr>
        </table>

        <table align="left" cellspacing="1" cellpadding="0" id="account-info2" style="margin-bottom: 5px; display: inline; vertical-align: top; margin-top: 1px;">
            <tr>
                <td class="table-header2"><?= ( ! empty($errors['company'])) ? '<span class="error">*</span>' : ''; ?>Company:<?= ( ! empty($errors['company'])) ? '<br /><br />' : ''; ?></td>
                <td class="table-data">
                    <?= Form::input('company', $post['company'], array('class' => 'stretch', 'maxlength' => '255')); ?>
                    <?= (empty ($errors['company'])) ? '' : '<span class="errors">' . $errors['company'] . '</span>'; ?>
                </td>
            </tr>
            <tr>
                <td class="table-header2"><?= ( ! empty($errors['site_url'])) ? '<span class="error">*</span>' : ''; ?>URL:<?= ( ! empty($errors['site_url'])) ? '<br /><br />' : ''; ?></td>
                <td class="table-data">
                    <?= Form::input('site_url', $post['site_url'], array('class' => 'stretch', 'maxlength' => '255')); ?>
                    <?= (empty ($errors['site_url'])) ? '' : '<span class="errors">' . $errors['site_url'] . '</span>'; ?>
                </td>
            </tr>
            <tr>
                <td class="table-header2"><?= ( ! empty($errors['other_contact'])) ? '<span class="error">*</span>' : ''; ?>AIM/ICQ:<?= ( ! empty($errors['other_contact'])) ? '<br /><br />' : ''; ?></td>
                <td class="table-data">
                    <?= Form::input('other_contact', $post['other_contact'], array('class' => 'stretch', 'maxlength' => '50')); ?>
                    <?= (empty ($errors['other_contact'])) ? '' : '<span class="errors">' . $errors['other_contact'] . '</span>'; ?>
                </td>
            </tr>
            <tr>
                <td class="table-header2"><?= ( ! empty($errors['password_confirm'])) ? '<span class="error">*</span>' : ''; ?>Confirm Password:<?= ( ! empty($errors['password_confirm'])) ? '<br /><br />' : ''; ?></td>
                <td class="table-data">
                    <?= Form::input('password_confirm', $post['password_confirm'], array('class' => 'stretch', 'maxlength' => '25', 'type' => 'password')); ?>
                    <?= (empty ($errors['password_confirm'])) ? '' : '<span class="errors">' . $errors['password_confirm'] . '</span>'; ?>
                </td>
            </tr>
        </table>
        
        <div class="clear"></div>
    </div>
</div>
<br />
<div class="step">
    <?= HTML::image('assets/img/upgrade/2.png', array('alt' => 'Payment Information', 'style' => 'vertical-align: middle;')); ?> Payment Information
    <div class="data shift">
        <table align="left" cellspacing="1" cellpadding="0" id="account-info" style="margin-bottom: 5px; display: inline; vertical-align: top; margin-top: 1px;">
            <tr>
                <td class="table-header"><?= ( ! empty($errors['address'])) ? '<span class="error">*</span>' : ''; ?>Address:<?= ( ! empty($errors['address'])) ? '<br /><br />' : ''; ?></td>
                <td class="table-data">
                    <?= Form::input('address', $post['address'], array('class' => 'stretch', 'maxlength' => '255')); ?>
                    <?= (empty ($errors['address'])) ? '' : '<span class="errors">' . $errors['address'] . '</span>'; ?>
                </td>
            </tr>
            <tr>
                <td class="table-header"><?= ( ! empty($errors['country_id'])) ? '<span class="error">*</span>' : ''; ?>Country:<?= ( ! empty($errors['country_id'])) ? '<br /><br />' : ''; ?></td>
                <td class="table-data">
                    <?= Form::select('country', $location['country'], (isset($post['country_id'])) ? $post['country_id'] : NULL, array('id' => 'country', 'class' => 'stretch')) ?>
                    <?= (empty ($errors['country_id'])) ? '' : '<span class="errors">' . $errors['country_id'] . '</span>'; ?>
                </td>
            </tr>
            <tr>
                <td class="table-header"><?= ( ! empty($errors['region_id'])) ? '<span class="error">*</span>' : ''; ?>Region:<?= ( ! empty($errors['region_id'])) ? '<br /><br />' : ''; ?></td>
                <td class="table-data">
                    <?= Form::select('region', $location['region'], (isset($post['region_id'])) ? $post['region_id'] : NULL, array('id' => 'region', 'class' => 'stretch') + ((count($location['region']) == 1) ? array('disabled' => 'disabled') : array())); ?>
                    <?= (empty ($errors['region_id'])) ? '' : '<span class="errors">' . $errors['region_id'] . '</span>'; ?>
                </td>
            </tr>
            <tr>
                <td class="table-header"><?= ( ! empty($errors['city'])) ? '<span class="error">*</span>' : ''; ?>City:<?= ( ! empty($errors['city'])) ? '<br /><br />' : ''; ?></td>
                <td class="table-data">
                    <?= Form::input('city', 'Enter A City', array('id' => 'city') + ((count($location['city']) == 1) ? array('disabled' => 'disabled', 'class' => 'stretch') : array('class' => 'stretch'))); ?>
                    <?= (empty ($errors['city'])) ? '' : '<span class="errors">' . $errors['city'] . '</span>'; ?>
                </td>
            </tr>
            <tr>
                <td class="table-header"><?= ( ! empty($errors['zip_code'])) ? '<span class="error">*</span>' : ''; ?>Postal Code:<?= ( ! empty($errors['zip_code'])) ? '<br /><br />' : ''; ?></td>
                <td class="table-data">
                    <?= Form::input('zip_code', $post['zip_code'], array('class' => 'stretch', 'maxlength' => '10')); ?>
                    <?= (empty ($errors['zip_code'])) ? '' : '<span class="errors">' . $errors['zip_code'] . '</span>'; ?>
                </td>
            </tr>
            <tr id="ssn_tax_id-info" style="<?= (isset($post['country_id']) AND $post['country_id'] == '233') ? '' : 'display: none;'; ?>">
                <td class="table-header"><?= ( ! empty($errors['ssn_tax_id'])) ? '<span class="error">*</span>' : ''; ?>SS#/Tax ID:<?= ( ! empty($errors['ssn_tax_id'])) ? '<br /><br />' : ''; ?></td>
                <td class="table-data">
                    <?= Form::input('ssn_tax_id', $post['ssn_tax_id'], array('class' => 'stretch', 'maxlength' => '25')); ?>
                    <?= (empty ($errors['ssn_tax_id'])) ? '' : '<span class="errors">' . $errors['ssn_tax_id'] . '</span>'; ?>
                </td>
            </tr>
        </table>

        <table align="left" cellspacing="1" cellpadding="0" id="account-info2" style="margin-bottom: 5px; display: inline; vertical-align: top; margin-top: 1px;">
            <tr>
                <td class="table-header2" style="float: left" colspan="2"><?= ( ! empty($errors['program'])) ? '<span class="error">*</span>' : ''; ?>Payment Program:</td>
            </tr>
            <tr>    
                <td class="table-data" colspan="2" style="padding-left: 100px;">
                    <?= Form::radio('program', 'PPS', (isset($post['program']) AND $post['program'] == 'PPS') ? TRUE : FALSE, array()); ?> Pay Per Sale <?= Form::radio('program', 'Revshare', (isset($post['program']) AND $post['program'] == 'Revshare') ? TRUE : FALSE, array('style' => 'margin-left: 30px;')); ?> Rev-Share
                    <?= (empty ($errors['program'])) ? '' : '<span class="errors">' . $errors['program'] . '</span>'; ?>
                </td>
            </tr>
            <tr>
                <td class="table-header2" style="float: left" colspan="2"><?= ( ! empty($errors['payment_method'])) ? '<span class="error">*</span>' : ''; ?>Payment Method:</td>
            </tr>
            <tr>    
                <td class="table-data" colspan="2" style="padding-left: 100px;">
                    <?= Form::radio('payment_method', 'Check', (isset($post['payment_method']) AND $post['payment_method'] == 'Check') ? TRUE : FALSE, array()); ?> Check <?= Form::radio('payment_method', 'CashX', (isset($post['payment_method']) AND $post['payment_method'] == 'CashX') ? TRUE : FALSE, array('style' => 'margin-left: 30px;')); ?> CashX
                    <?= (empty ($errors['payment_method'])) ? '' : '<span class="errors">' . $errors['payment_method'] . '</span>'; ?>
                </td>
            </tr>
            <tr id="cashx-account" style="<?= (isset($post['payment_method']) AND $post['payment_method'] == 'CashX') ? '' : 'display: none;'; ?>">
                <td class="table-header2"><?= ( ! empty($errors['payment_method_account'])) ? '<span class="error">*</span>' : ''; ?>CashX Email:<?= ( ! empty($errors['payment_method_account'])) ? '<br /><br />' : ''; ?></td>
                <td class="table-data">
                    <?= Form::input('payment_method_account', $post['payment_method_account'], array('class' => 'stretch', 'maxlength' => '255')); ?>
                    <?= (empty ($errors['payment_method_account'])) ? '' : '<span class="errors">' . $errors['payment_method_account'] . '</span>'; ?>
                </td>
            </tr>
        </table>
        <div class="clear"></div>
    </div>
</div>
<br />

<center>
<?= Form::checkbox('tou', 'yes', (isset($post['tou'])) ? TRUE : FALSE, array('id' => 'tou')) . 'I have read and agree to the ' . HTML::anchor('affiliates/terms', 'Terms of Use', array('target' => '_blank')) . ' for this website'; ?>
<?= (empty ($errors['tou'])) ? '<br /><br />' : '<span class="errors">' . $errors['tou'] . '</span><br />'; ?>

    <?= Form::input('register-submit', 'Register', array('id' => 'register-submit', 'type' => 'image', 'src' => '/assets/img/registration/button-form-submit.png')); ?>
</center>
<?= Form::close(); ?>