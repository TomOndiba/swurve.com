        <title><?php echo $meta_title; ?> | Swurve - Online Dating</title>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="<?php echo $meta_description; ?>" />
        <meta name="keywords" content="<?php echo $meta_keywords; ?>" />
        <meta name="revisit-after" content="5 Days" />
        <meta name="robots" content="<?php echo $meta_robots; ?>" />
        <meta name="viewport" content="width=device-width">

        <?php
        if (isset($_GET['a']))
        {
            $protocol = $_SERVER['SERVER_PORT'] == 80 ? 'http' : 'https';
            echo '<link rel="canonical" href="' . $protocol . '://' . $_SERVER['SERVER_NAME'] . (isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/') . '" />';
        }
        ?>


        <style>
            .vjs-poster { 
                display: block !important;
                cursor: default;
            }

            .chat-window {
                width: 354px;
                height: 502px;
                background-color: #fff;
                border: 1px solid black;
                position: relative;
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }

            .chat-window .chatpublish { 
                position: absolute;
                top: 76px;
                right: 5px;
                width: 215px;
                height: 140px;
                z-index: 10;
            }

            .chat-window .requestprompt {
                position: absolute;
                width: 350px;
                height: 475px;
                background-color: #000;
                opacity: .8;
                z-index: 100;
                display: none;
            }

            .chat-window .requestprompttext {
                position: absolute;
                opacity: 1;
                color: #fff;
                font-size: 12px;
                font-family: verdana;
                font-weight: bold;
                width: 250px;
                text-align: center;
                top: 100px;
                left: 50px;
            }

            .chat-window .requestaccept {
                position: absolute;
                top: 220px;
                left: 80px;
            }

            .chat-window .requestdecline {
                position: absolute;
                top: 220px;
                left: 200px;
            }


            .chat-window .mobilestart {
                position: absolute;
                width: 350px;
                height: 197px;
                background-color: #000;
                opacity: .8;
                z-index: 100;
                display: none;
            }

            .chat-window .mobilestarttext {
                position: absolute;
                opacity: 1;
                color: #fff;
                font-size: 12px;
                font-family: verdana;
                font-weight: bold;
                width: 310px;
                text-align: center;
                top: 50px;
                left: 20px;
            }

            .chat-window .startvideo {
                position: absolute;
                top: 120px;
                left: 115px;
            }
            .chat-window *, .chat-window *:before, .chat-window *:after {
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }

            .chat-window .messages {
                width: 100%;
                height: 233px;
                overflow-y: scroll;
                font-family: verdana;
                font-size: 10px;
                border-bottom: 1px solid #CCCCCC;

            }

            .chat-window .messages div {
                margin: 1px 5px 1px 5px;
            }

            .chat-window .messages div, .chat-window .messages font {
                color: #000 !important;
            }

            .chat-window .chatmessage {
                width: 243px;;
                position: absolute;
                left: 4px;
                bottom: 4px;
                min-height: 35px;
                height: 35px;
                border: 1px solid #999;
                font-family: verdana;
                font-size: 12px;
            }

            .chat-window .emotes {
                padding: 5px;
                width: 215px;
                position: absolute;
                right: 25px;
                bottom: 42px;
                height: 78px;
                border: 1px solid #999;
                font-family: verdana;
                font-size: 12px;
                background-color: #C3282F;
                border: 2px solid #92181D;
                text-align: center;
                display: none;
            }

            .chat-window .emotes img {
                vertical-align: middle;
                width: 30px;
                cursor: pointer;
                margin-bottom: 3px;
                padding: 0;
            }

            .chat-window .emotebutton {
                min-height: 35px;
                height: 35px;
                min-width: 35px;
                width: 35px;
                font-weight: bold;
                font-family: verdana;
                font-size: 12px;
                position: absolute;
                right: 60px;
                bottom: 4px;
                border: 1px;
                padding: 1px;
                color: #fff;
                cursor: pointer;
            }

            .chat-window .sendbutton {
                min-height: 35px; 
                height: 35px; 
                min-width: 50px;
                width: 50px;
                font-weight: bold;
                font-family: verdana;
                font-size: 12px;
                position: absolute;
                right: 4px;
                bottom: 4px;
                border: 1px;
                padding: 1px;
                color: #fff;
                background-color: #999;
                cursor: pointer;
            }

            .ui-dialog {
                position: static;
                right: 100; 
                bottom: 100;
                width: 400px;
                height: 250px;

            }
        </style>

        <?php
        $ui_included = false;

        foreach ($stylesheets as $stylesheet => $media):
            echo HTML::style($stylesheet, array('media' => $media)), "\n";

            if (preg_match('/-ui.min./i', $stylesheet)) $ui_included = true;
        endforeach;

        if ( ! $ui_included)
        {
            echo HTML::style(Functions::src_file('assets/css/jquery-ui.min.css'), array('media' => 'screen')), "\n";
        }

        echo HTML::style(Functions::src_file('assets/css/colorbox.css'), array('media' => $media)), "\n";
        echo HTML::style(Functions::src_file('assets/css/video-js.css'), array('media' => 'screen')), "\n";
        ?>

        <?php
        foreach ($javascripts as $javascript):
            echo HTML::script($javascript), "\n";
        endforeach;

        echo HTML::script(Functions::src_file('assets/js/video.js')), "\n";
        echo HTML::script(Functions::src_file('assets/js/jquery.emoji.js')), "\n";
        ?>
        <script src="https://cdn.socket.io/socket.io-1.0.6.js"></script>

        <script>
            document.createElement('video');document.createElement('audio');
            videojs.options.flash.swf = "/assets/js/video-js.swf";
	        videojs.options.flash.params = {
		        'wmode' : 'transparent',
		        'bgcolor' : '#000000'
	        };
        </script>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

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



        <script>
            function playAlert()
            {
                if ($.browser.msie)
                {
                    $("body").append("<embed id='chatAlert' src='/assets/pop.wav' hidden='true' autostart='true' loop='false' />");
                }
                else
                {
                    $("body").append("<audio id='chatAlert' src='/assets/pop.wav' autoplay='autoplay'><source src='/assets/pop.wav' type='audio/wav' /></audio>");
                }
            }

            var socket = null;
            var socketName = null;
            //var chatFrom = 'Eduardo80';
            //var chatTo = 'SweetBabyMasha';
            //var chatIdentier = '12345-6789012345';

            function promptCam(identifier) {
                $('#camRequest' + identifier).trigger('click');
            }

            function streamStarted(identifier) {
                $('#streamStarted' + identifier).trigger('click');
            }

            function streamNotStarted(identifier) {
                $('#streamNotStarted' + identifier).trigger('click');
            }

            (function($) {
                $.fn.initiateChat = function( options ) {
                    // Establish our default settings
                    var settings = $.extend({
                        from        : null,
                        fromid      : null,
                        to          : null,
                        toid        : null,
                        gender      : null,
                        toImage     : null,
                        identifier  : null,
                        timeout     : null
                    }, options);

                    return this.each( function() {
                        $(this).html('' +
                            '<div class="chat-title" style="cursor: move; background-color: #27619C; width: 100%; height: 25px; border-bottom: 2px solid #95999C;">' +
                            '   <span style="color: #ffffff; font-weight: bold; display: block; padding-top: 3px; padding-left: 5px;">Swurve Chat - ' + settings.to +  '</span>' +
                            '   <div class="chat-close" id="closeChat' + settings.identifier + '" style="position: absolute; cursor: pointer; right: 0px; top: 0px; background-color: #24254F; height: 25px; width: 25px; border-left: 2px solid #95999C; border-bottom: 2px solid #95999C;">' +
                            '      <div style="color: #ffffff; font-weight: bold; margin-top: 3px; margin-left: 7px;">X</div>' +
                            '   </div>' +
                            '</div>' +

                            '<div class="requestprompt" id="requestPrompt' + settings.identifier + '"><div class="requestprompttext" id="requestPromptText' + settings.identifier + '">The connected user would like to start a webcam chat with you, do you accept or decline?<br /><br />Note: Video chat is 2 additional credits per minute.</div>' +
                            '<input type="button" name="requestAccept' + settings.identifier + '" class="requestaccept" id="requestAccept' + settings.identifier + '" value="Accept" /> <input type="button" name="requestDecline' + settings.identifier + '" class="requestdecline" id="requestDecline' + settings.identifier + '"value="Decline" /> </div>' +

                            '<div class="mobilestart" id="mobileStart' + settings.identifier + '"><div class="mobilestarttext" id="mobileStartText' + settings.identifier + '">There is a 25-30 second delay when watching webcams through a mobile/tablet device.</div>' +
                            '<input type="button" name="startVideo' + settings.identifier + '" class="startvideo" id="startVideo' + settings.identifier + '" value="Watch Webcam" /></div>' +

                            '<div id="chatPublish' + settings.identifier + '"></div>' +

                            //'<video id="chatVideo' + settings.identifier + '" class="video-js vjs-default-skin" preload="auto" poster="/' + settings.toImage + '" width="350" height="197" data-setup=\'{ "techOrder": ["flash"] }\'>' +
                            //'   <source src="rtmp://166.78.42.216/livepkgr/' + settings.to + settings.identifier + '" type="rtmp/mp4" />' +
                            ////'   <source src="http://166.78.42.216/hls-live/livepkgr/_definst_/liveevent/' + settings.to + settings.identifier + '.m3u8" type="application/vnd.apple.mpegurl" />' +
                            //'</video>' +

	                        <?php
							$user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
							$browser_nfo = Functions::detect();
							$name = $browser_nfo['name'];
							$version = $browser_nfo['version'];
							$platform = $browser_nfo['platform'];
							$usr_agent = $browser_nfo['userAgent'];

							$browser = new Browser();

							?>

	                        <?php if ($browser->isMobile() == true || $browser->isTablet() == true): ?>

		                        <?php if ($browser->getPlatform() == Browser::PLATFORM_IPAD || $browser->getPlatform() == Browser::PLATFORM_IPOD || $browser->getPlatform() == Browser::PLATFORM_IPHONE): ?>
		                            '<!-- iOS //-->' +

			                        <?php if (IN_PRODUCTION == false): ?>
				                        '<video id="chatVideo' + settings.identifier + '" class="video-js vjs-default-skin" preload="auto" autoplay poster="' + settings.toImage + '" width="350" height="197" data-setup=\'{ "techOrder": ["html5"] }\'>' +
                                    <?php else: ?>
				                        '<video id="chatVideo' + settings.identifier + '" class="video-js vjs-default-skin" preload="auto" autoplay poster="/' + settings.toImage + '" width="350" height="197" data-setup=\'{ "techOrder": ["html5"] }\'>' +
			                        <?php endif; ?>

		                        '   <source src="http://166.78.42.216/hls-live/livepkgr/_definst_/liveevent/' + settings.to + settings.identifier + '.m3u8" />' +
			                        //'   <source src="rtmp://166.78.42.216/livepkgr/' + settings.to + settings.identifier + '" type="rtmp/mp4"/>' +
		                        <?php else: ?>
			                        '<!-- Other Mobile/Tablet //-->' +

			                        <?php if (IN_PRODUCTION == false): ?>
				                        '<video id="chatVideo' + settings.identifier + '" class="video-js vjs-default-skin" preload="auto" autoplay poster="' + settings.toImage + '" width="350" height="197" data-setup=\'{ "techOrder": ["html5", "flash"] }\'>' +
                                    <?php else: ?>
				                        '<video id="chatVideo' + settings.identifier + '" class="video-js vjs-default-skin" preload="auto" autoplay poster="/' + settings.toImage + '" width="350" height="197" data-setup=\'{ "techOrder": ["html5", "flash"] }\'>' +
			                        <?php endif; ?>

			                        '   <source src="http://166.78.42.216/hls-live/livepkgr/_definst_/liveevent/' + settings.to + settings.identifier + '.m3u8" type="application/x-mpegURL" />' +
			                        '   <source src="rtmp://166.78.42.216/livepkgr/' + settings.to + settings.identifier + '" type="rtmp/mp4" />' +
	                            <?php endif; ?>

	                        <?php elseif ($browser->getBrowser() == Browser::BROWSER_SAFARI): ?>
								'<!-- Safari //-->' +
                                <?php if (IN_PRODUCTION == false): ?>
                                    '<video id="chatVideo' + settings.identifier + '" class="video-js vjs-default-skin" preload="auto" autoplay poster="' + settings.toImage + '" width="350" height="197" data-setup=\'{ "techOrder": ["flash", "html5"] }\'>' +
                                <?php else: ?>
                                    '<video id="chatVideo' + settings.identifier + '" class="video-js vjs-default-skin" preload="auto" autoplay poster="/' + settings.toImage + '" width="350" height="197" data-setup=\'{ "techOrder": ["flash", "html5"] }\'>' +
                                <?php endif; ?>

	                            '   <source src="rtmp://166.78.42.216/livepkgr/' + settings.to + settings.identifier + '" type="rtmp/mp4" />' +
		                        //'   <source src="http://166.78.42.216/hls-live/livepkgr/_definst_/liveevent/' + settings.to + settings.identifier + '.m3u8" type="application/x-mpegURL" />' +
		                        //'   <source src="http://166.78.42.216/hls-live/livepkgr/_definst_/liveevent/' + settings.to + settings.identifier + '.m3u8" type="application/vnd.apple.mpegURL" />' +
		                        //'   <source src="http://166.78.42.216/hls-live/livepkgr/_definst_/liveevent/' + settings.to + settings.identifier + '.m3u8" />' +

	                        <?php elseif ($browser->getBrowser() == Browser::BROWSER_IE): ?>
	                            '<!-- <?php echo $browser->getVersion(); ?> //-->' +

	                            <?php if ($browser->getVersion() <= "8"): ?>
	                                '<!-- IE8 or Less //-->' +

	                                <?php if (IN_PRODUCTION == false): ?>
	                                    '<video id="chatVideo' + settings.identifier + '" class="video-js vjs-default-skin" preload="auto" autoplay poster="' + settings.toImage + '" width="350" height="197" data-setup=\'{ "techOrder": ["flash"] }\'>' +
	                                <?php else: ?>
	                                    '<video id="chatVideo' + settings.identifier + '" class="video-js vjs-default-skin" preload="auto" autoplay poster="/' + settings.toImage + '" width="350" height="197" data-setup=\'{ "techOrder": ["flash"] }\'>' +
	                                <?php endif; ?>

	                                '   <source src="rtmp://166.78.42.216/livepkgr/' + settings.to + settings.identifier + '" type="rtmp/mp4" />' +
	                            <?php else: ?>
	                                '<!-- IE 9 Plus //-->' +

	                                <?php if (IN_PRODUCTION == false): ?>
	                                    '<video id="chatVideo' + settings.identifier + '" class="video-js vjs-default-skin" preload="auto" autoplay poster="' + settings.toImage + '" width="350" height="197" data-setup=\'{ "techOrder": ["html5", "flash"] }\'>' +
	                                <?php else: ?>
	                                    '<video id="chatVideo' + settings.identifier + '" class="video-js vjs-default-skin" preload="auto" autoplay poster="/' + settings.toImage + '" width="350" height="197" data-setup=\'{ "techOrder": ["html5", "flash"] }\'>' +
	                                <?php endif; ?>

	                                '   <source src="http://166.78.42.216/hls-live/livepkgr/_definst_/liveevent/' + settings.to + settings.identifier + '.m3u8" type="application/x-mpegURL" />' +
	                                '   <source src="rtmp://166.78.42.216/livepkgr/' + settings.to + settings.identifier + '" type="rtmp/mp4" />' +
	                            <?php endif; ?>

	                        <?php else: ?>

	                            <?php if (IN_PRODUCTION == false): ?>
	                                '<video id="chatVideo' + settings.identifier + '" class="video-js vjs-default-skin" preload="auto" autoplay poster="' + settings.toImage + '" width="350" height="197" data-setup=\'{ "techOrder": ["html5", "flash"] }\'>' +
	                            <?php else: ?>
	                                '<video id="chatVideo' + settings.identifier + '" class="video-js vjs-default-skin" preload="auto" autoplay poster="/' + settings.toImage + '" width="350" height="197" data-setup=\'{ "techOrder": ["html5", "flash"] }\'>' +
	                            <?php endif; ?>

                            '   <source src="http://166.78.42.216/hls-live/livepkgr/_definst_/liveevent/' + settings.to + settings.identifier + '.m3u8" type="application/x-mpegURL" />' +
                            '   <source src="rtmp://166.78.42.216/livepkgr/' + settings.to + settings.identifier + '" type="rtmp/mp4" />' +
	                        <?php endif; ?>

                            '</video>' +

	                        // File extension MIME types:
	                        // .M3U8 application/x-mpegURL or application/vnd.apple.mpegURL <-iOS / doesnt work on android use previous type
	                        // .ts video/MP2T
	                        // .webm video/webm
	                        // .mp4 video/mp4
	                        // .ogg video/ogg
	                        // rtmp video/flash or rtmp/mp4 or video/rtmp

                            //'<div class="chatpublishcontainer" id="chatPublishContainer' + settings.identifier + '">' +
                            
                            //'</div>' +

                            '<div id="messages' + settings.identifier + '" class="messages"><?php if (Request::$protocol == "https"): ?><div style="color: #27619C !important; font-weight: bold; text-align: center; padding: 10px 5px;">You are currently on a secure HTTPS page, chat has been disabled until you navigate back to the main site.</div><?php endif; ?></div>' +
                            '<textarea placeholder="Type your message here" name="message' + settings.identifier + '" id="message' + settings.identifier + '" class="chatmessage" disabled="disabled"></textarea> <input type="image" name="emote' + settings.identifier + '" id="emote' + settings.identifier + '" class="emotebutton" src="/assets/img/icons/emoticons/' + settings.gender + '-smile.png" disabled="disabled" /> <input type="button" name="send' + settings.identifier + '" id="send' + settings.identifier + '" class="sendbutton" value="Send" disabled="disabled" />' +
                            '<div id="emotes' + settings.identifier + '" class="emotes">' +
                            '   <img src="/assets/img/icons/emoticons/' + settings.gender + '-smile.png" title=":)" />' +
                            '   <img src="/assets/img/icons/emoticons/' + settings.gender + '-laugh.png" title=":D" />' +
                            '   <img src="/assets/img/icons/emoticons/' + settings.gender + '-bigsmile.png" title=":))" />' +
                            '   <img src="/assets/img/icons/emoticons/' + settings.gender + '-sad.png" title=":(" />' +
                            '   <img src="/assets/img/icons/emoticons/' + settings.gender + '-angry.png" title=">:(" />' +
                            '   <img src="/assets/img/icons/emoticons/' + settings.gender + '-cry.png" title=":\'(" />' +
                            '   <img src="/assets/img/icons/emoticons/' + settings.gender + '-kiss.png" title=":*" />' +
                            '   <img src="/assets/img/icons/emoticons/' + settings.gender + '-wink.png" title=";)" />' +
                            '   <img src="/assets/img/icons/emoticons/' + settings.gender + '-horror.png" title="D:" />' +
                            '   <img src="/assets/img/icons/emoticons/' + settings.gender + '-tongue.png" title=":p" />' +
                            '   <img src="/assets/img/icons/emoticons/' + settings.gender + '-love.png" title="<3" />' +
                            '   <img src="/assets/img/icons/emoticons/' + settings.gender + '-gift.png" title="@}-;-" />' +
                            '</div>' +
                            '<input type="button" name="camRequest' + settings.identifier + '" id="camRequest' + settings.identifier + '" style="display: none;" />' +
                            '<input type="button" name="streamStarted' + settings.identifier + '" id="streamStarted' + settings.identifier + '" style="display: none;" />' +
                            '<input type="button" name="streamNotStarted' + settings.identifier + '" id="streamNotStarted' + settings.identifier + '" style="display: none;" />' +
                            //'<input type="button" class="startvideo" name="startVideo' + settings.identifier + '" id="startVideo' + settings.identifier + '" value="Click Here to Start Stream" style="" />' +
                            //'<center><br /><input type="button" name="test1" id="chatAccept' + settings.identifier + '" value="Simulate Cam Accept Stream Publishing" /> <br />' +
                            //'<input type="button" name="test2" id="chatInit' + settings.identifier + '" value="Simulate Cam Request Accepted" /></center>' +
                        '');

                        var emotehide;

	                    // $(window).load(function() {
	                    $(document).ready(function() {
		                    setTimeout(function() {
			                    <?php if (IN_PRODUCTION == false): ?>
			                    var posterSrc = settings.toImage;
			                    <?php else: ?>
			                    var posterSrc = "/" + settings.toImage;
			                    <?php endif; ?>


			                    videojs("chatVideo" + settings.identifier, {
				                    "controls" : false,
				                    "autoplay" : true,
				                    "preload" : "auto",
				                    "width" : 350,
				                    "height" : 197,
				                    "poster" : posterSrc
			                    });
		                    }, 3000);
	                    });

	                    $('#emote' + settings.identifier + ', #emotes' + settings.identifier).mouseover(function () {
                            clearTimeout(emotehide);
                        });

                        $('#emote' + settings.identifier + ', #emotes' + settings.identifier).mouseleave(function () {
                            emotehide = setTimeout(function() {
                                $('#emotes' + settings.identifier).hide();
                            }, 100);
                        });

                        $('#emote' + settings.identifier).click(function () {
                            $('#emotes' + settings.identifier).show();
                        });

                        $('#emotes' + settings.identifier + ' img').click(function () {
                            var smiley = $(this).attr('title');
                            ins2pos(smiley, 'message' + settings.identifier);
                        });

                        function ins2pos(str, id) {
                            var TextArea = document.getElementById(id);
                            var val = TextArea.value;
                            var before = val.substring(0, TextArea.selectionStart);
                            var after = val.substring(TextArea.selectionEnd, val.length);

                            TextArea.value = before + " " + str + " " + after;
                            setCursor(TextArea, before.length + str.length + 2);

                        }

                        function setCursor(elem, pos) {
                            if (elem.setSelectionRange) {
                                elem.focus();
                                elem.setSelectionRange(pos, pos);
                            } else if (elem.createTextRange) {
                                var range = elem.createTextRange();
                                range.collapse(true);
                                range.moveEnd('character', pos);
                                range.moveStart('character', pos);
                                range.select();
                            }
                        }
                        var flashvars = {
                            user: settings.from,
                            identifier: settings.identifier
                        };
                        var params = {
                            'wmode': 'transparent',
                            'allowscriptaccess': 'always'
                        };
                        var attributes = {
                            'id': "chatPublish" + settings.identifier,
                            'class': 'chatpublish',
                            'name': "chatPublish" + settings.identifier
                        };

                        swfobject.embedSWF("/assets/publishStream.swf?" + Math.random() * 9999999, "chatPublish" + settings.identifier, "215", "140", "11.0.0", "", flashvars, params, attributes, function(status) {
                            if (status.success) {
                                //$('#chatPublishContainer' + settings.identifier).appendTo('#chatVideo' + settings.identifier);
                            }
                        });

                        //_V_("chatVideo" + settings.identifier).ready(function() {
                            //$('#chatPublishContainer' + settings.identifier).appendTo('#chatVideo' + settings.identifier);
                        //});

                        $('#closeChat' + settings.identifier).click(function() {
                            socket.emit("leave", {name: settings.from, identifier: settings.identifier});
                            swfobject.removeSWF('chatPublish' + settings.identifier);
                            $('#chatwindow-' + settings.to).hide('slow');
                            //alert('ajax to server to prompt other user to approve webcam chat = ')
                        });

                        $('#camRequest' + settings.identifier).click(function() {
                            socket.emit("camrequest", {name: settings.from, to: settings.to, identifier: settings.identifier});
                            //alert('ajax to server to prompt other user to approve webcam chat = ')
                        });

                        $('#streamStarted' + settings.identifier).click(function() {
                            socket.emit("streamstarted", {name: settings.from, to: settings.to, identifier: settings.identifier});
                        });

                        $('#streamNotStarted' + settings.identifier).click(function() {
                            socket.emit("streamNotStarted", {name: settings.from, to: settings.to, identifier: settings.identifier});
                        });

                        $('#chatInit' + settings.identifier).click(function() {
                            $('#chatPublish' + settings.identifier)[0].initCamera();
                        });

                        $('#startVideo' + settings.identifier).click(function() {
                            $('#mobileStart' + settings.identifier).hide();

                            videojs("chatVideo" + settings.identifier).ready(function() {

                                videojs('chatVideo' + settings.identifier).play();

                                $('#chatVideo' + settings.identifier + ' .vjs-poster').hide('slow', function() {
                                    $(this).remove();
                                });
                            });
                        });

                        $('#requestAccept' + settings.identifier).click(function() { 
                            $('#requestPrompt' + settings.identifier).hide();

                            socket.emit("camrequestresponse", {name: settings.from, to: settings.to, identifier: settings.identifier, response: true});
                        });

                        $('#requestDecline' + settings.identifier).click(function() { 
                            $('#requestPrompt' + settings.identifier).hide();

                            socket.emit("camrequestresponse", {name: settings.from, to: settings.to, identifier: settings.identifier, response: false});
                        });

                        $('#send' + settings.identifier).click(function() {
                            if ($('#message' + settings.identifier).val() == '') return; 

                            socket.emit("message", {name: settings.from, fromid: settings.fromid, toid: settings.toid, identifier: settings.identifier, msg: $('#message' + settings.identifier).val()});
                            $('#message' + settings.identifier).val('').focus();
                        });

                        $('#message' + settings.identifier).keypress(function(e) {
                            if (e.which == 13) {
                                if ($.trim($('#message' + settings.identifier).val()) == '') {
                                    $('#message' + settings.identifier).val('').focus();
                                    return false;
                                } 

                                socket.emit("message", {name: settings.from, fromid: settings.fromid, toid: settings.toid, identifier: settings.identifier, msg: $('#message' + settings.identifier).val()});
                                $('#message' + settings.identifier).val('').focus();

                                return false;
                            }
                        });

                        if (socket == null) {
                            socket = io.connect("166.78.42.218:81");
                            socketName = settings.from;

                            socket.on("message", function(data) {
                                data = data.constructor === Array ? data : [ data ];

                                var i;

                                for(i = 0; i < data.length; i++) {   $(".posted").emoticons();
                                    if (data[i].name) {
                                        $('#messages' + data[i].identifier).append( $('<div><u style="font-weight: bold; color: ' + (data[i].name == socketName ? 'blue' : 'red') + '">' + data[i].name + '</u>: ' + data[i].msg + '</div>').emoticons( data[i].name == socketName ? settings.gender : (settings.gender == 'Male' ? 'Female' : 'Male') ) );
                                    } else {
                                        $('#messages' + data[i].identifier).append( $('<div>' + data[i].msg + '</div>').emoji() );
                                    }

                                    if (typeof $('#messages' + data[i].identifier)[0] != 'undefined') $('#messages' + data[i].identifier).stop().animate({scrollTop: $('#messages' + data[i].identifier)[0].scrollHeight}, 1000);
                                }

                                <?php if (Core::$user AND Core::$user->flirtbucks_id != null): ?>
                                if (i == 1 && data[--i].name != socketName) playAlert();
                                <?php endif; ?>
                            });

                            socket.on("startchat", function(data) {
                                //alert('timeout before variable = ' + settings.timeout);
                                //clearTimeout(settings.timeout);
                                //alert('timeout after variable = ' + settings.timeout);

                                $('#message' + data.identifier).removeAttr('disabled');
                                $('#send' + data.identifier).removeAttr('disabled');
                                $('#emote' + data.identifier).removeAttr('disabled');
                            });

                            socket.on("close", function(data) {
                                videojs('chatVideo' + data.identifier).pause();
                                videojs('chatVideo' + data.identifier).currentTime(0);

                                swfobject.removeSWF('chatPublish' + data.identifier);

                                $('#message' + data.identifier).attr('disabled', 'disabled');
                                $('#send' + data.identifier).attr('disabled', 'disabled');
                                $('#emote' + data.identifier).attr('disabled', 'disabled');
                            });

                            socket.on("camrequest", function(data) {
                                $('#requestPrompt' + data.identifier).show();
                            });

                            socket.on("startstream", function(data) {
                                if (data.name == socketName) $('#chatPublish' + data.identifier)[0].initCamera();
                            });

                            socket.on("streamstarted", function(data) {
                                if (data.to == socketName) {
                                    videojs("chatVideo" + settings.identifier).ready(function() {

                                    videojs('chatVideo' + data.identifier).play();

                                    $('#chatVideo' + data.identifier + ' .vjs-poster').hide('slow', function() { 
                                        $(this).remove();
                                    });

                                    if (videojs('chatVideo' + data.identifier).paused())
                                    {
                                        setTimeout(function() {
                                            if (videojs('chatVideo' + data.identifier).paused()) $('#mobileStart' + data.identifier).show();
                                        }, 10000);
                                    }
                                    });
                                }
                            });
                        }

/*
                        settings.timeout = setTimeout(function() {
                            alert('timeout for closing chat called...');
                            socket.emit("leave", {name: settings.from, identifier: settings.identifier});
                            swfobject.removeSWF('chatPublish' + settings.identifier);
                            $('#chatwindow-' + settings.to).hide('slow');
                        }, 180000);
*/
                        socket.emit("join",
                            {
                                name: settings.from,
                                fromid: settings.fromid,
                                toid: settings.toid,
                                identifier: settings.identifier
                            }
                        );
                    });
                }
            }(jQuery));


            jQuery.fn.emoticons = function(gender) {
                var gender = gender || "Male";
                //var settings = jQuery.extend({emoticons: "emoticons"}, options);
                /* keys are the emoticons
                 * values are the ways of writing the emoticon
                 *
                 * for each emoticons should be an image with filename
                 * '<gender>-emoticon.png'
                 * so for example, if we want to add a cow emoticon
                 * we add "cow" : Array("(C)") to emotes
                 * and an image called 'male-cow.png' and 'female-cow.png' under the emoticons folder
                 */
                var emotes = {"bigsmile": Array(":-))", ":))", ":o))", ":]]", ":33", ":c))", ":&gt;&gt;", "=]]", "8))", "=))", ":}}", ":^))", ":っ))"),
                    "angry": Array(":-||", ":@", "&gt;:("),
                    "smile": Array(":-)", ":)", ":o)", ":]", ":3", ":c)", ":&gt;", "=]", "8)", "=)", ":}", ":^)", ":っ)"),
                    "laugh": Array(":-D", ":D", "8-D", "8D", "x-D", "xD", "X-D", "XD", "=-D", "=D", "=-3", "=3", "B^D"),
                    "horror": Array("D:&lt;", "D:", "D8", "D;", "D=", "DX", "v.v", "D-':"),
                    "sad": Array("&gt;:[", ":-(", ":(",  ":-c", ":c", ":-&lt;", ":っC", ":&lt;", ":-[", ":[", ":{", ";("),
                    "cry": Array(":'-(", ":'("),
                    "kiss": Array(":*", ":^*"),
                    "wink": Array(";-)", ";)", "*-)", "*)", ";-]", ";]", ";D", ";^)", ":-,"),
                    "tongue": Array("&gt;:P", ":-P", ":P", "X-P", "x-p", "xp", "XP", ":-p", ":p", "=p", ":-Þ", ":Þ", ":þ", ":-þ", ":-b", ":b", "d:"),
                    "love": Array("&lt;3"),
                    "gift": Array("@}-;-'---", "@&gt;--&gt;--", "@&gt;--", "@}-;-")};

                /* Replaces all ocurrences of emoticons in the given html with images
                 */
                function emoticons(html){
                    for(var emoticon in emotes){
                        for(var i = 0; i < emotes[emoticon].length; i++){
                            /* css class of images is emoticonimg for styling them*/
                            html = html.replace(emotes[emoticon][i],"<span class=\"emoticonimg\"><img src=\"/assets/img/icons/emoticons/" + gender + "-" + emoticon + ".png\" alt=\"" + emoticon + "\"/></span>","g");
                        }
                    }
                    return html;
                }
                return this.each(function(){
                    $(this).html(emoticons($(this).html()));
                });
            };


        </script>



        <?php //if (Core::$user AND (Core::$user->username == 'OmicroN' OR Core::$user->username == 'test'  OR Core::$user->username == 'MichelleAdmin')): ?>
        <script type="text/javascript">
            var lastchat;

            function closediv(elem)
            {
                $('#' + elem).hide();
                $.get('/auto/close_chat?id=' + elem);
            }

            function closechat(elem)
            {
                setTimeout("closediv('" + elem + "')", 1000);
            }

            $(document).ready(function() {
                $('div.chat-title').live('mouseover', function() {
//                    $('.chat-title').disableSelection();
                    if ( !$(this).data("init") ) {
                        $(this).data("init", true);
                        $(".chat-window").draggable({
                            handle: 'div.chat-title',
                            stack: '.chat-window',
                            cursor: 'move',
                            stop: function(event, ui) {
                                $.cookie('chat' + $(this).attr('chatid') + 'x', $(this).position().left, { path: '/' });
                                $.cookie('chat' + $(this).attr('chatid') + 'y', $(this).position().top, { path: '/' });
                            }
                        });
                    }
                });

/*
                $('.chat-close').live('mousedown', function() {
                    if (confirm('Are you sure you want to end this chat session?'))
                    {
                        //var obj = swfobject.getObjectById('chatcontainer-' + $(this).parent().parent().attr('chatid'));

                        //alert(obj);

                        if (navigator.appName.indexOf("Microsoft") != -1) {
                            document['chat' + $(this).parent().parent().attr('chatid')].closeChat($(this).parent().parent().attr('id'));
                        }
                        else {
                            if (document['chat' + $(this).parent().parent().attr('chatid')].length != undefined){
                                document['chat' + $(this).parent().parent().attr('chatid')][1].closeChat($(this).parent().parent().attr('id'));
                            }

                            document['chat' + $(this).parent().parent().attr('chatid')].closeChat($(this).parent().parent().attr('id'));
                        }

                        //window['chat' + $(this).parent().parent().attr('chatid')].closeChat($(this).parent().parent().attr('id'));

                        //$.get('/auto/close_chat?' + $(this).parent().parent().attr('url'));
                    }
                });
*/
            });
        </script>
        <?php if (Core::$user): //AND Request::$protocol != 'https'): ?>
        <script type="text/javascript">
            $(document).ready(function() {
                checkChatRequests();

                setInterval(checkChatRequests, 15000);

                function checkChatRequests()
                {
                    $.get("/json/chats", function(data) {
                        $('body').prepend(data);
                    });
                }

                <?php if (Core::$user->membership->type == 'Trial'): ?>
                $(".activate-prompt").click(function(e) { e.stopPropagation(); e.preventDefault(); $.colorbox({inline:true, width:'590px', height:'200px', href:'#inline_activate'}); return false; });
                $('.activate-prompt').live('click', function(e) { e.stopPropagation(); e.preventDefault(); $.colorbox({inline:true, width:'590px', height:'200px', href:'#inline_activate'}); return false; });
                <?php endif; ?>
            });
        </script>
        <?php endif; ?>

        <style>
            @media (max-width: 767px) {
                .ui-dialog {
                    left: 50% !important;
                    top: 50% !important;
                    margin-left: -200px !important;
                    margin-top: -124px !important;
                }
            }

            .emoticonimg {
                width: 20px;
            /*margin-right: 24px;*/
                }

            .emoticonimg img {
                /*position: absolute;*/
                vertical-align: middle;
                width: 30px;
            }
        </style>
