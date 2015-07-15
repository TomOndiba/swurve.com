<h1>Chat Logs</h1>

<form method="get">Username: <input type="text" name="username" value="<?= isset($_GET['username']) ? $_GET['username'] : ''; ?>" /><input type="submit" name="submit" value="Search" /></form> OR <form method="get">Keyword(s): <input type="text" name="message" value="<?= isset($_GET['message']) ? $_GET['message'] : ''; ?>" /><input type="submit" name="submit" value="Search" /></form>

<?php if (isset($_GET['message'])): ?>
<?php
  $sql = "SELECT *
          FROM logs
          WHERE MATCH(message) AGAINST ('" . $_GET['message'] . "')
          ORDER BY MATCH(message) AGAINST ('" . $_GET['message'] . "') DESC, date DESC";

  $chats = DB::query(Database::SELECT, $sql)->as_object('Model_Log')->execute();
?>
<br /><br />
<?php foreach ($chats as $chat): ?>
  <div style="display: inline-block; width: 175px; overflow: hidden; vertical-align: top;">[<?= date('Y-m-d H:i:s', $chat->date); ?>]</div>
  <div style="display: inline-block; width: 150px; overflow: hidden; vertical-align: top;"><a href="?username=<?= $chat->from->username; ?>"><?= $chat->from->username; ?></a></div>
  <div style="display: inline-block; width: 500px; overflow: hidden; vertical-align: top; padding-right: 10px;"><?= $chat->message; ?></div>
  <div style="display: inline-block; width: 75px; overflow: hidden; vertical-align: top;"><a href="?view=<?= $chat->identifier; ?>">View Chat</a></div>
  <hr style="border-top: 1px solid #ccc; border-bottom: 1px solid white;" />
<?php endforeach; ?>
<?php endif; ?>


<?php if (isset($_GET['username'])): ?>
<?php
  $user = ORM::factory('user')->where('username', '=', $_GET['username'])->find();

  $sql = "SELECT from_id, to_id, identifier, min(date) AS 'start', max(date) AS 'end', count(*) AS 'lines'
          FROM logs
          WHERE (from_id = " . $user . " OR to_id = " . $user . ")
          GROUP BY identifier
          ORDER BY start DESC";

  $chats = DB::query(Database::SELECT, $sql)->as_object('Model_Log')->execute();
?>
<br /><br />
<?php foreach ($chats as $chat): $split = explode('-', $chat->identifier); $session = ORM::factory('chat', $split[0]); ?>
  <div style="vertical-align: top; display: inline-block; width: 300px; overflow: hidden;"><?php if ($chat->from != $user): ?><a href="?username=<?= $chat->from->username; ?>"><?php endif; ?><?= $chat->from->username; ?><?php if ($chat->from != $user): ?></a><?php endif; ?> <=> <?php if ($chat->to != $user): ?><a href="?username=<?= $chat->to->username; ?>"><?php endif; ?><?= $chat->to->username; ?><?php if ($chat->to != $user): ?></a><?php endif; ?></div>
  <div style="vertical-align: top; display: inline-block; width: 175px; overflow: hidden;"><?= date('Y-m-d H:i:s', $chat->start); ?><br /><?= date('Y-m-d H:i:s', $session->date_sent); ?></div>
  <div style="vertical-align: top; display: inline-block; width: 175px; overflow: hidden;"><?= date('Y-m-d H:i:s', $chat->end); ?><br /><?= date('Y-m-d H:i:s', $session->date_end); ?></div>
  <?php $length = $chat->end - $chat->start; ?>
  <div style="vertical-align: top; display: inline-block; width: 75px; overflow: hidden;"><?= $length < 60 ? $length . ' sec' : round($length / 60) . ' min'; ?></div>
  <div style="vertical-align: top; display: inline-block; width: 85px; overflow: hidden;"><?= $chat->lines; ?> lines</div>
  <div style="vertical-align: top; display: inline-block; width: 75px; overflow: hidden;"><a href="?view=<?= $chat->identifier; ?>">View Chat</a></div>
  <br />
<?php endforeach; ?>
<?php endif; ?>


<?php if (isset($_GET['view'])): ?>
<?php
  $chats = ORM::factory('log')->where('identifier', '=', $_GET['view'])->order_by('date', 'ASC')->find_all();
?>
<br /><br />
<?php $count = 0; foreach ($chats as $chat): ?>
<?php
  if ($count == 0)
  {
    $from = $chat->from;
    $to = $chat->to;
  }
?>
<div style="display: inline-block; color: black;">[<?= date('H:i:s A', $chat->date); ?>] <span style="font-weight: bold; color: <?= $chat->from == $from ? 'blue' : 'red'; ?>"><?= $chat->from->username ?></span>: <?= $chat->message ?></div><br/>
<?php $count++; endforeach; ?>
<?php endif; ?>