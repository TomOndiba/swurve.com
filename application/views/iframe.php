<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?= $head; ?>
    </head>            
    <body>
        <?php if ( ! is_null(Core::$flash_data)): ?>
            <?php foreach(Core::$flash_data as $status => $msg): ?>
                <div class="<?= $status; ?>"><?= $msg; ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?= $content; ?>
    </body>
</html>