            <p>
            <?php if ($camgirl = Core::$camgirl): ?>
                Welcome <?= $camgirl->first_name; ?> <?= $camgirl->last_name; ?>! | <?= HTML::anchor('/account/logout', 'Logout'); ?>
            <?php else: ?>
                Already A Hostess? <?= HTML::anchor('/account/login', 'Login'); ?>
            <?php endif; ?>
            </p>

            <div style="position: relative; height: 115px; z-index: -1;">
            <div style="position: absolute; margin-top: -14px; width: 239px; height: 115px; background: URL('/assets/img/flirtbucks/logo.png') no-repeat;"></div>
            <?= HTML::image('assets/img/flirtbucks/girl.png', array('alt' => '', 'style' => 'float: right; margin-right: 150px; margin-top: -15px;')); ?>
            </div>

            <div id="menu" style="clear: both;">
                <ul id="menu-options">
                    <li><?= HTML::anchor('/', 'Home'); ?></li>
                    <?php if (Core::$camgirl): ?>
                    <li><?= HTML::anchor('/account/edit', 'Account'); ?></li>
                    <?php else: ?>
                    <li><?= HTML::anchor('/program', 'Program'); ?></li>
                    <li><?= HTML::anchor('/requirements', 'Requirements'); ?></li>
                    <?php endif; ?>
                    <li><?= HTML::anchor('/account/faq', 'FAQ'); ?></li>
                    <li><?= HTML::anchor('/account/support', 'Support'); ?></li>
                    <?php if ( ! Core::$camgirl): ?>
                    <li><?= HTML::anchor('/account/create', 'Sign Up'); ?></li>
                    <li class="register"><?= HTML::anchor('/account/login', 'Login'); ?></li>
                    <?php endif; ?>
                </ul>
            </div>