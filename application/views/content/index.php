<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php if (Core::$user->photos->where('hide', '=', 'No')->find_all()->count() == 0): ?>
<div class="alert"><?=HTML::image('assets/img/icons/alert.png', array('style' => 'vertical-align: middle;')); ?> Your Account Is Missing Photos! Be Seen- <?= HTML::anchor('user/control_panel/upload_photo', 'Upload Photos', array('class' => 'activate-prompt')); ?> Now!</div><br />
<?php endif; ?>

<h1><?= __('News'); ?></h1>
<div style="background-color: #fff; border: 1px solid #95999C; padding: 7px;">
<?php $count = 0; foreach($news as $article): ?>
<?= ($count > 0) ? '<hr />' : ''; ?>
<div class="news-article">
    <?= HTML::image('assets/img/news/' . $article . '.png', array('style' => 'float: left; margin-right: 7px;')); ?>
    <strong><?= Text::auto_p($article->title); ?></strong>

    <?= Text::auto_p($article->short); ?>
    <div align="right"><?= HTML::anchor('news/' . $article, '›› Full Article'); ?></div>
</div>
<?php $count++; endforeach; ?>
</div><br /><br />


<h2 class="blue">New Users</h2>
<div id="search-results-horizontal">
    <ul id="profile">
        <?php foreach($results as $user): ?>
        <li>
            <?= HTML::anchor('profile/' . $user->username, HTML::image(Content::factory($user->username)->get_photo($user->avatar->uniqueid, 'l'), array('class' => 'profile-pic'))); ?><br />
            <h4><?= HTML::anchor('profile/' . $user->username, $user->username, array('class' => 'username')); ?></h4>
            <small><?= Functions::get_age($user->birthdate); ?> / <?= $user->gender; ?> / <?= $user->orientation; ?></small>
        </li>
        <?php endforeach; ?>
    </ul>
    <div class="clear"></div>
</div>

<br /><br />
<h2><?= __('Recent Activity'); ?></h2>
<div style="background-color: #fff; border: 1px solid #95999C; padding: 10px;">
<?php if (count($feeds) == 0): ?>
    Add members as Faves to use this feature.
<?php endif; ?>
<div id="activity">
    <?php foreach($feeds as $feed): ?>
    <div class="activity-feed">
        <?= HTML::anchor('profile/' . $feed->user->username, HTML::image(Content::factory($feed->user->username)->get_photo($feed->user->avatar, 's'), array('class' => 'profile-pic'))); ?>
        <p><strong><?= HTML::anchor('profile/' . strtolower($feed->user->username), $feed->user->username); ?></strong> <?= $feed->message; ?><br /><span class="date"><?= Functions::RelativeTime($feed->added_date); ?></span></p>
        <?php if ($feed->feed_type->type == 'photos'): ?>
            <?php $photos = ORM::factory('photo')->where('user_id', '=', $feed->user)->where('added_date', '>=', strtotime('00:00:00', $feed->added_date))->where('added_date', '<', $feed->added_date)->where('hide', '=', 'No')->order_by('added_date', 'DESC')->limit(5)->find_all(); ?>
            <div class="additional-photos">
            <?php foreach($photos as $photo): ?>
                <?= HTML::anchor('photo/' . $feed->user->username . '/' . $photo->uniqueid, HTML::image(Content::factory($feed->user->username)->get_photo($photo->uniqueid, 'm'), array('class' => 'profile-pic'))); ?>
            <?php endforeach; ?>
            <div class="clear"></div>
            <span class="date"><br />* Thumbnails will not appear until photos have been approved.</span>
            </div>
        <? endif; ?>
    </div>
    <?php endforeach; ?>
</div>

<?php if (count($feeds) == 10): ?>
<div style="text-align: center;">
    <div id="more-feed" style="border: 1px solid #ccc; font-size: 16px; padding: 10px; cursor: pointer; font-weight: bold; background-color: #F2F5F8;">
        Load More...
    </div>
</div>
<?php endif; ?>
</div><br /><br />