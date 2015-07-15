        <title><?php echo $meta_title; ?> | FlirtBucks Chat Hostess Program</title>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta name="description" content="<?php echo $meta_description; ?>" />
        <meta name="keywords" content="<?php echo $meta_keywords; ?>" />
        <meta name="revisit-after" content="5 Days" />
        <meta name="robots" content="<?php echo $meta_robots; ?>" />

        <?php
        foreach ($stylesheets as $stylesheet => $media):
            echo HTML::style($stylesheet, array('media' => $media)), "\n";
        endforeach;
        ?>

        <?php
        foreach ($javascripts as $javascript):
            echo HTML::script($javascript), "\n";
        endforeach;
        ?>

        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-15420105-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>