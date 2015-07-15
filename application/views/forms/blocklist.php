<script>
  $(document).ready(function() {
    $('#unblockselected').click(function() {
        var data = $('.blocked').serialize();

        if (data != '')
        {
          $.post('/json/unblock', data, function(response) {
              if (response == 'refresh')
              {
                  location.reload(true);
              }
          });
        }
    });
  });
</script>

<h1>Block List</h1>

<?= Form::open(null, array('method' => 'post')); ?>
Username: <?= Form::input('username', null); ?> <?= Form::submit('submit', 'Add User'); ?>
<?= Form::close(); ?>

<hr /><br />

<h2>Manage Block List</h2>

<ul id="mails">
  <?php foreach(Core::$user->blocks->find_all() as $user): ?>
  <li style="display: inline-block; text-align: center;">
    <h4><?= $user->block->username; ?></h4>
    <div style="width: 30px; float: left;"><input type="checkbox" name="blocked[]" class="blocked" value="<?= $user; ?>" style="margin-top: 17px;" /></div>
    <div class="column65">
        <?= HTML::anchor('profile/' . $user->block->username, HTML::image(Content::factory($user->block->username)->get_photo($user->block->avatar, 's'), array('class' => 'profile-pic'))); ?>
    </div>
  </li>
  <?php endforeach; ?>
</ul>

<?php if (count(Core::$user->blocks->find_all()) > 0): ?>
<br /><center><input type="button" name="unblock" id="unblockselected" value="Unblock Selected" style="padding: 4px 10px; font-weight: bold;" /></center>
<?php else: ?>
  <p>You have no one on your block list.</p>
<?php endif; ?>