            <?php if (Core::$user AND Core::$user->membership->type == 'Trial'): ?>
            <style> #cboxLoadedContent { overflow: hidden !important; }</style>

            <div style="display:none">
                <div id="inline_activate" style="padding:10px; background:#fff;">
                    <h1>Activation Required</h1>

                    <p>An email was sent to <strong><?= Core::$user->email; ?></strong> containing the steps to activate your account. Please complete activation to continue.</p>
                    <p>Didn't recieve your activation code at <strong><?= Core::$user->email; ?></strong>?<br />Please check your bulk / spam folder or <?= HTML::anchor('user/resend/activation', 'Click here'); ?> to correct and resubmit.</p>
                </div>
            </div>
            <?php endif; ?>

            <p>
            <?php if ($user = Core::$user): ?>
                Welcome <?= $user->username; ?>! | <?= HTML::anchor('user/logout', 'Logout'); ?>
            <?php else: ?>
                Already Registered? <?= HTML::anchor('user/login', 'Login'); ?>
            <?php endif; ?>
            </p>
            <!--p>Choose language:
            <a href="<?= URL::site('/' . $current_uri); ?>">English</a> -
            <a href="<?= URL::site('/es/' . $current_uri); ?>">Español</a></p-->

            <?php if (Core::$user AND ! empty(Core::$user->flirtbucks_id)): ?>
                <div style="position: relative; height: 115px; z-index: -1;">
                <div style="position: absolute; margin-top: -14px; width: 239px; height: 115px; background: URL('/assets/img/flirtbucks/logo.png') no-repeat;"></div>
                <?= HTML::image('assets/img/flirtbucks/girl.png', array('alt' => '', 'style' => 'float: right; margin-right: 150px; margin-top: -15px;')); ?>
                </div>
            <?php else: ?>
                <div style="position: relative; height: 95px; z-index: -1;">
                <div style="position: absolute; margin-top: -53px; width: 518px; height: 317px; background: URL('/assets/img/headderlogo.png') no-repeat;"></div>
                <?= HTML::image('assets/img/headderpeople.png', array('alt' => '', 'style' => 'float: right; margin-right: 150px; margin-top: -15px;')); ?>
                </div>
            <?php endif; ?>

            <?php
                if (Core::$user)
                {
                    $unread = Core::$user->messages->where('date_read', 'IS', NULL)->where('date_deleted', 'IS', NULL)->where('flag', '=', 'No')->count_all();
                }
            ?>
            <div id="menu" style="clear: both;">
                <ul id="menu-options">
                    <li><?= HTML::anchor(( ! Core::$user) ? 'user/register' : 'home', 'Home'); ?></li>
                    <li id="menu-mailbox" <?= (isset($unread) AND $unread > 0) ? 'class="newmail"' : '' ?>><?php if (isset($unread) AND $unread > 0): ?><div id="emailnotify"><?= $unread; ?></div><?php endif; ?><?= HTML::anchor(( ! Core::$user) ? 'user/register' : 'mailbox', 'Mailbox', array('class' => 'activate-prompt')); ?></li>
                    <li><?= HTML::anchor(( ! Core::$user) ? 'user/register' : 'user/control_panel', 'Control Panel', array('class' => 'activate-prompt')); ?></li>
                    <li><?= HTML::anchor(( ! Core::$user) ? 'user/register' : 'playbook', 'Play Book', array('class' => 'activate-prompt')); ?></li>
                    <li><?= HTML::anchor(( ! Core::$user) ? 'user/register' : 'user/search', 'Search', array('class' => 'activate-prompt')); ?></li>

                    <?php if ( ! Core::$user): ?>
                    <li class="register"><?= HTML::anchor('user/register', 'Register'); ?></li>
                    <?php endif; ?>

                    <?php if (Core::$user AND ! empty(Core::$user->flirtbucks_id)): ?>
                    <li class="register"><?= HTML::anchor('http://flirtbucks.net/account/login?' . Core::$user->camgirl->email . '/' . Core::$user->camgirl->password, 'Program Home'); ?></li>
                    <?php endif; ?>

                    <?php if (Core::$user AND Core::$user->membership->type == 'Admin'): ?>
                    <li class="register"><?= HTML::anchor('admin', 'Admin'); ?></li>
                    <?php endif; ?>
                </ul>
            </div>