<script type="text/javascript">
    $(document).ready(function() {
        var prev_color = '';
        var pic_current = 0;
        var pic_total = $('li[ratepic=true]').length;
        var pic_collection = $('li[ratepic=true]');

        $(pic_collection[pic_current]).css('background-color', '#EDDECB');

        $(document).bind('keydown', 'left', function() {
            if (pic_current <= 0)
                return;

            $(pic_collection[pic_current]).css('background-color', prev_color);
            
            pic_current -= 1;

            prev_color = $(pic_collection[pic_current]).css('background-color');
            
            $(pic_collection[pic_current]).css('background-color', '#EDDECB');
            pic_collection[pic_current].scrollIntoView(false);
            return false;
        });

        $(document).bind('keydown', 'right', function() {
            if (pic_current >= pic_total - 1)
                return;

            $(pic_collection[pic_current]).css('background-color', prev_color);
            
            pic_current += 1;

            prev_color = $(pic_collection[pic_current]).css('background-color');
            
            $(pic_collection[pic_current]).css('background-color', '#EDDECB');
            pic_collection[pic_current].scrollIntoView(false);
            return false;
        });

        $(document).bind('keydown', 'a', function() {
            if (pic_current == pic_total)
                return;

            $(pic_collection[pic_current]).find('input[name=adult[]]').attr('checked', 'checked');
            $(pic_collection[pic_current]).find('input[name=pg[]]').attr('checked', '');
            $(pic_collection[pic_current]).find('input[name=default[]]').attr('checked', '');
            $(pic_collection[pic_current]).find('input[name=delete[]]').attr('checked', '');
            
            $(pic_collection[pic_current]).css('background-color', '#DFDFDF');

            pic_current += 1;

            if (pic_current == pic_total)
                return;

            $(pic_collection[pic_current]).css('background-color', '#EDDECB');
            pic_collection[pic_current].scrollIntoView(false);
        });

        $(document).bind('keydown', 'p', function() {
            if (pic_current == pic_total)
                return;

            $(pic_collection[pic_current]).find('input[name=pg[]]').attr('checked', 'checked');
            $(pic_collection[pic_current]).find('input[name=adult[]]').attr('checked', '');
            $(pic_collection[pic_current]).find('input[name=default[]]').attr('checked', '');
            $(pic_collection[pic_current]).find('input[name=delete[]]').attr('checked', '');

            $(pic_collection[pic_current]).css('background-color', '#DFDFDF');

            pic_current += 1;

            if (pic_current == pic_total)
                return;

            $(pic_collection[pic_current]).css('background-color', '#EDDECB');
            pic_collection[pic_current].scrollIntoView(false);
        });

        $(document).bind('keydown', 'd', function() {
            if (pic_current == pic_total)
                return;

            $(pic_collection[pic_current]).parent().find('input[name=default[]]').attr('checked', '');

            $(pic_collection[pic_current]).find('input[name=pg[]]').attr('checked', 'checked');
            $(pic_collection[pic_current]).find('input[name=default[]]').attr('checked', 'checked');
            $(pic_collection[pic_current]).find('input[name=adult[]]').attr('checked', '');
            $(pic_collection[pic_current]).find('input[name=delete[]]').attr('checked', '');

            $(pic_collection[pic_current]).css('background-color', '#DFDFDF');

            pic_current += 1;

            if (pic_current == pic_total)
                return;

            $(pic_collection[pic_current]).css('background-color', '#EDDECB');
            pic_collection[pic_current].scrollIntoView(false);
        });

        $(document).bind('keydown', 'del', function() {
            if (pic_current == pic_total)
                return;

            $(pic_collection[pic_current]).find('input[name=delete[]]').attr('checked', 'checked');
            $(pic_collection[pic_current]).find('input[name=pg[]]').attr('checked', '');
            $(pic_collection[pic_current]).find('input[name=default[]]').attr('checked', '');
            $(pic_collection[pic_current]).find('input[name=adult[]]').attr('checked', '');

            $(pic_collection[pic_current]).css('background-color', '#DFDFDF');

            pic_current += 1;

            if (pic_current == pic_total)
                return;

            $(pic_collection[pic_current]).css('background-color', '#EDDECB');
            pic_collection[pic_current].scrollIntoView(false);
            return false;
        });
        
        $(document).bind('keydown', 'return', function() {
            $('#check_photos').click();
        });

        $(document).bind('keydown', 'space', function() {
            window.open($(pic_collection[pic_current]).find('a').attr('href'), 'fullsize')
            return false;
        });
    });
</script>
<?php 
    echo Form::open(NULL, array('id' => 'check'));
    
    $current_user = '';

    foreach($photos as $photo):
        if ($current_user != $photo->user->username)
        {
            if ($current_user != '')
                echo '</ul><div class="clear"></div></div><br />';
?>
<div style="background-color: #eee; border-top: 1px solid white; border-left: 1px solid white; border-right: 1px solid black; border-bottom: 1px solid black; padding: 5px;"><h3><?= HTML::anchor('profile/' . $photo->user->username, $photo->user->username, array('target' => '_blank')); ?></h3>
<font color="#336699"><strong>Current Avatar</strong></font><br />
<ul style="width: 100%; margin: 0; padding: 0;">
    <li style="float: left; width: 123px; text-align: center;">
        <a target="_blank" href="/<?= Content::factory($photo->user->username)->get_photo($photo->user->avatar, NULL, TRUE, TRUE); ?> "><?= HTML::image(Content::factory($photo->user->username)->get_photo($photo->user->avatar->uniqueid, 'm', TRUE, TRUE), array('align' => 'center', 'style' => 'border: 3px solid #336699; margin-right: 10px; margin-top: 3px; margin-left: 3px;')); ?></a>
    </li>
<?php
        }
        $current_user = $photo->user->username;
?>
    <li style="float: left; width: 123px; text-align: center;" ratepic="true">
        <a target="_blank" href="/<?= Content::factory($photo->user->username)->get_photo($photo, NULL, TRUE, TRUE); ?> "><?= HTML::image(Content::factory($photo->user->username)->get_photo($photo->uniqueid, 'm', TRUE, TRUE), array('align' => 'center', 'style' => 'margin-right: 10px; margin-top: 3px; margin-left: 3px;')); ?></a><br />
        <span style="font-size: 10px;">
        PG: <?= form::checkbox('pg[]', $photo); ?>  Adult: <?= form::checkbox('adult[]', $photo); ?><br />
        Delete: <?= form::checkbox('delete[]', $photo); ?><br />
        Default: <?= Form::checkbox('default[]', $photo); ?>
        </span>
    </li>
<?php 
    endforeach;
   
    if ($current_user != '')
    {
        echo '</ul><div class="clear"></div></div><br />';
        echo '<center>' . Form::submit('submit', 'Submit', array('id' => 'check_photos')) . '</center><br />';
        echo Form::close();
    }
?>