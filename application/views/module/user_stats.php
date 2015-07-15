<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="side-module" id="user-stats">
    <h2><?= __('User Stats'); ?></h2>
    <p>
    <?php if ($user = Core::$user): ?>
        Logged in as: <strong><?= HTML::anchor('profile/' . $user->username, $user->username); ?></strong> (<?= HTML::anchor('user/logout', 'logout'); ?>)<br />
        <?php 
            $contacts = $user->contacts->or_where('to_id', '=', $user)->find_all();
            $favorites = 0;
            $matches = 0;
            $admirers = 0;

            foreach($contacts as $contact)
            {
                if ($contact->contact_type->type == 'Favorite')
                {
                    if ($contact->from->id == $user->id)
                    {
                        $favorites += 1;
                    }
                    elseif ($contact->to->id == $user->id)
                    {
                        $admirers += 1;
                    }
                }
                else
                {
                    $matches += 1;
                }
            }

            $total = count($contacts);
        ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#pb_favorites").progressBar(<?= $favorites; ?>, { max: <?= $total; ?>, textFormat: 'fraction', barImage: '/assets/img/progressbg_green.gif'});
                $("#pb_matches").progressBar(<?= $matches; ?>, { max: <?= $total; ?>, textFormat: 'fraction', barImage: '/assets/img/progressbg_yellow.gif'});
                $("#pb_admirers").progressBar(<?= $admirers; ?>, { max: <?= $total; ?>, textFormat: 'fraction', barImage: '/assets/img/progressbg_orange.gif'});
            });
        </script>    
        <span class="label"><strong>Faves</strong>: </span> <span class="progressBar" id="pb_favorites"></span><br />
        <span class="label"><strong>HookUps</strong>: </span> <span class="progressBar" id="pb_matches"></span><br />
        <span class="label"><strong>Crushes</strong>: </span> <span class="progressBar" id="pb_admirers"></span><br />
        <strong>Member Status</strong>: [<?= $user->membership->type; ?>] <?= ($user->membership->status < ORM::factory('membership')->where('type', '=', 'Platinum')->find()->status) ? HTML::anchor('user/upgrade', 'Upgrade') : ''; ?><br />
        <strong>Credit Balance</strong>: <span id="credit-balance"><?= (Core::$user AND ! empty(Core::$user->flirtbucks_id)) ? 'Unlimited' : $user->credits; ?></span> <?php if (Core::$user AND empty(Core::$user->flirtbucks_id)): ?><?= HTML::anchor('credits/buy', 'Buy'); ?><?php endif; ?><br />
    <?php else: ?>
        <?= HTML::anchor('user/login', 'Login'); ?> to your account to view stats.
    <?php endif; ?>
    </p>
</div>