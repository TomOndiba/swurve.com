            <p>
            <?php if ($affiliate = Core::$affiliate): ?>
                Welcome <?= $affiliate->first_name; ?> <?= $affiliate->last_name; ?>! | <?= HTML::anchor('affiliates/account/logout', 'Logout'); ?>
            <?php else: ?>
                Already An Affiliate? <?= HTML::anchor('affiliates/account/login', 'Login'); ?>
            <?php endif; ?>
            </p>

            <div style="position: relative; height: 114px; z-index: -1;">
            <div style="position: absolute; margin-top: -53px; width: 518px; height: 317px; background: URL('/assets/img/headderlogo.png') no-repeat;"></div>
            <?= HTML::image('assets/img/affiliateheadderpeople.png', array('alt' => '', 'style' => 'float: right; margin-right: 150px; margin-top: -15px;')); ?>
            </div>
              <div id="menu" style="clear: both;">
                <ul id="menu-options">
                    <li><?= HTML::anchor('affiliates', 'Home'); ?></li>
                    <?php if (Core::$affiliate): ?>
                    <li><?= HTML::anchor('affiliates/account/edit', 'Account'); ?></li>
                    <li><?= HTML::anchor('affiliates/account/rewards', 'Rewards'); ?></li>
                    <li><?= HTML::anchor('affiliates/stats2', 'Stats'); ?></li>
                    <li><?= HTML::anchor('affiliates/campaigns', 'Campaigns'); ?></li>
                    <li><?= HTML::anchor('affiliates/tools', 'Promo Tools'); ?></li>
                    <?php else: ?>
                    <li><?= HTML::anchor('affiliates/programs', 'Programs'); ?></li>
                    <li><?= HTML::anchor('affiliates/sites', 'Sites'); ?></li>
                    <?php endif; ?>
                    <li><?= HTML::anchor('affiliates/account/support', 'Support'); ?></li>
                    <?php if ( ! Core::$affiliate): ?>
                    <li><?= HTML::anchor('affiliates/account/login', 'Login'); ?></li>
                    <li><?= HTML::anchor('affiliates/account/create', 'Sign Up'); ?></li>
                    <li class="register"><?= HTML::anchor('/', 'Return To Swurve'); ?></li>
                    <?php endif; ?>
                </ul>
            </div>