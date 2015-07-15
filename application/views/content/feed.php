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

<?php if (count($feeds) != 10): ?>
<script>
    $('#more-feed').hide();
</script>
<?php endif; ?>