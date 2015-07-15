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
<h1>Answer Email Tool</h1>

<?php if (count($results) == 0): ?>
<p>No messages to answer for this user.</p>
<?php else: ?>
<?= Form::open(); ?>
<div class="column120 column-header">Message Type</div><br />
<?= Form::select('messagetype', $messagetypes, NULL, array('id' => 'messagetype')); ?><br /><br />
<div class="column120 column-header">Filter</div><br />
<?= Form::textarea('filter', NULL, array('style' => 'width: 620px; height: 70px;', 'id' => 'filter')); ?><br /><br />
<div class="column120 column-header">Reply Message</div><br />
<?= Form::textarea('replymessage', NULL, array('style' => 'width: 620px; height: 70px;', 'id' => 'replymessage')); ?>
<br /><br />
<center>
    <?= Form::checkbox('markmultiple', '1'); ?> Mark duplicates as read<br />
    <?= Form::input('apply', 'Apply Filter', array('id' => 'apply', 'type' => 'button')); ?> &nbsp; <?= Form::submit('submit', 'Send Messages'); ?>
</center>
<br />
<hr />
<?php foreach($results as $message): ?>
<div>
    <div style="float: right; position: relative; display: inline-block; margin-bottom: -20px;">Mark Read: <?= Form::checkbox('mark[]', $message->id, NULL, array('class' => 'markmessage')); ?></div>
    <div class="column120 column-header">Username</div>
    <div class="column120 column-header">Date Sent</div>
    <div class="column380 column-header">Subject</div>
    <br>
    <div class="column120"><strong><?= HTML::anchor('profile/' . $message->from->username, $message->from->username); ?></strong></div>
    <div class="column120"><?= date('m/d/Y', $message->date_sent); ?></div>
    <div class="column380"><?= $message->subject; ?></div><br /><br />
    <div class="column120 column-header">Message</div><br />
    <div class="usermessage" type="<?php echo $message->message_type_id; ?>"><?= $message->message; ?></div>
    <br />
    <?= Form::textarea($message->id . '_message', NULL, array('style' => 'width: 620px; height: 70px;', 'class' => 'reply')); ?>
    <hr />
</div>
<?php endforeach; ?>
<?= Form::close(); ?>
<?php endif; ?>
