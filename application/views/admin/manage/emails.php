<?php
    $filters = ORM::factory('filter')->find_all();
?>
<script type="text/javascript">
    $.extend($.expr[":"], {
        "containsNC": function(elem, i, match, array) {
            return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || '').toLowerCase()) >= 0;
        }
    });

    $(document).ready(function() {
        $('#apply').click(function() {
            var count = 0;

            if ($('#messagetype').val() == 0)
            {
                $('.usermessage:containsNC("' + $('#filter').val() + '")').each(function() {
                    count++;

                    $(this).parent().find('.reply').val($('#replymessage').val());
                    $(this).parent().find('.markmessage').attr('checked', 'checked');
                });
            }
            else
            {
                $('.usermessage[type=' + $('#messagetype').val() + ']:containsNC("' + $('#filter').val() + '")').each(function() {
                    count++;

                    $(this).parent().find('.reply').val($('#replymessage').val());
                    $(this).parent().find('.markmessage').attr('checked', 'checked');
                });
            }

            alert('Filtered message applied to ' + count + ' messages.');
        });
    });
</script>
<h1>Manage Email Tool</h1>

<?php if (count($results) == 0): ?>
<p>No emails to manage/check.</p>
<?php else: ?>
<?= Form::open(); ?>
<hr />
<?php foreach($results as $message): ?>
<div>
    <div style="float: right; position: relative; display: inline-block; margin-bottom: -20px; margin-top: -5px;">Delete Checked: <?= Form::checkbox('delete[]', $message->id, NULL, array('class' => 'deletemessage')); ?> &nbsp;&nbsp; Mark Checked: <?= Form::checkbox('mark[]', $message->id, NULL, array('class' => 'markmessage')); ?></div>
    <div class="column120 column-header">Username</div>
    <div class="column120 column-header">Date Sent</div>
    <div class="column380 column-header">Subject</div>
    <br>
    <div class="column120"><strong><?= HTML::anchor('profile/' . $message->from->username, $message->from->username); ?></strong></div>
    <div class="column120"><?= date('m/d/Y', $message->date_sent); ?></div>
    <div class="column380"><?= Form::input($message->id . '_subject', $message->subject, array('style' => 'width: 380px;')); ?></div><br /><br />
    <div class="column120 column-header">Message</div>
    <br />
    <?= Form::textarea($message->id . '_message', $message->message, array('style' => 'width: 620px; height: 90px;', 'class' => 'reply')); ?>
<?php

    foreach($filters as $filter)
    {
        $orig_filter = $filter->filter;
        $filter = str_replace('*', '.*?', $filter->filter);

        if (preg_match('/' . $filter . '/i', $message->message, $matches))
        {
            foreach($matches as $match)
            {
?>
    <div><span style="display: inline-block; width: 150px;"><strong>Filter</strong>: <?= $orig_filter; ?></span> <strong>Match</strong>: [MESSAGE] <?= $match; ?></div>
<?php
            }
        }

        if (preg_match('/' . $filter . '/i', $message->subject, $matches))
        {
            foreach($matches as $match)
            {
?>
    <div><span style="display: inline-block; width: 150px;"><strong>Filter</strong>: <?= $orig_filter; ?></span> <strong>Match</strong>: [SUBJECT] <?= $match; ?></div>
<?php
            }
        }
    }
?>

    <hr />
</div>
<?php endforeach; ?>

<br /><center>
    <?= Form::submit('submit', 'Send Messages'); ?>
</center>

<?= Form::close(); ?>
<?php endif; ?>
