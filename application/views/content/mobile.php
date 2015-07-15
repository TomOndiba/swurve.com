<html>
    <head>
        <meta name="viewport" content="width=device-width,user-scalable=no" />
    
        <style>
            html, body, div, span, applet, object, iframe,
            h1, h2, h3, h4, h5, h6, p, blockquote, pre,
            a, abbr, acronym, address, big, cite, code,
            del, dfn, em, font, img, ins, kbd, q, s, samp,
            small, strike, strong, sub, sup, tt, var,
            b, u, i, center,
            dl, dt, dd, ol, ul, li,
            fieldset, form, label, legend,
            table, caption, tbody, tfoot, thead, tr, th, td {
                margin: 0;
                padding: 0;
                border: 0;
                outline: 0;
                font-size: 100%;
                vertical-align: baseline;
                background: transparent;
                color: #10476c;
            }

            ol, ul {
                list-style: none;
            }

            #menu {
                background: #E8EFF8;
                padding: 5px;
                border: 2px solid #95999c;
                height: 16px;
            }

            #menu-options {
                margin: 0px;
                padding: 0px;
                list-style-type: none;
                list-style: none;
                width: 100%;
            }

            #menu-options li {
                float: left;
                display: inline;
                padding-left: 17px;
                padding-right: 17px;
                color: #195371;
                font-weight: bold;
                text-transform: uppercase;
                font-size: 16px;
            }

            #menu-options li.register {
                float: right;  
                display: inline;
                padding-left: 10px;
                padding-right: 10px;
                color: #195371;
                font-weight: bold;
                text-transform: uppercase;
                font-size: 16px;
            }
            
            .pink {
                color: #a66ba6;
            }

            .blue {
                color: #10476c;
                text-transform: uppercase;
            }

            #geotext {
                font-size: 16px;
                line-height: 20px;
                font-family: arial;
                font-weight: bold;
                margin-top: 3px;
                margin-bottom: 3px;
            }

            .clear {
                clear: both;
            }

            h4 {
                font-size: 10px;
                font-weight: bold;
            }
        
            #geoprofiles {
                border: 2px solid #95999C;
                background-color: #E8EFF8;
                padding: 13px 13px 0 13px;
                text-align: center;
            }

            #profile li {
                float: left;
                width: 72px;
                height: 70px;
                padding: 0px !important;
                margin: 0px;
            }
            
            #footer {
                clear:both;
                width: 100%; 
                height: 75px;
                overflow: hidden;
                padding:0;
                margin:0 auto;
                text-align:center;
                color: #fff !important;
                font-size: 9px;
            }
            #footer-bg p {
                font-family: verdana;
                padding-top: 47px;
                color: #fff !important;
            }

            #footer-bg p a {
                color: #fff;
            }

            #footer-bg {
                text-align: center;
                position: relative;
                display: block;
                width: 100%;
                height: 100px;
                margin-top: -30px;
                background: URL('/assets/img/mobile/footer.png') no-repeat top;
                margin: 0 auto;
            }

            form {
                display: inline;
            }

            form#register {
                line-height: 33px;
                text-align: center;
            }

            fieldset {
                margin: 0px;
                padding: 0px;
            }

            form#register .hint {
                margin-left: 115px;
                color: #a6a6a6;
                display: block;
                margin-top: -10px;
                padding-top: -10px;
                font-size: 12px;
            }

            form#register .required {
                margin-left: 115px;
                color: red;
                display: block;
                margin-top: -10px;
                padding-top: -10px;
                font-size: 12px;
            }

            form .errors {
                text-align: center;
                width: 100%;
                color: red;
                display: block;
                margin-top: -10px;
                padding-top: -10px;
            }

            form#register label {
                width: 208px;
                text-align: left;
                margin-right: 5px;
                display: inline-block;
                font-size: 20px;
            }       

            form#register input {
                font-size: 16px;
                width: 230px;
            }

            form#register input.gender {
                width: 40px;
            }

            form#register label.genders {
                font-size: 11px;
                text-align: left;
                width: 70px;
            }

            form#register select {
                font-size: 11px;
                width: 236px;
            }

            form#register select.date {
                font-size: 11px;
                width: 75px;
            }

            form#register #register-submit {
                margin-top: 10px;
                font-size: 16px;
                font-weight: bold;
                width: 166px;
            }

        </style>
        <script>
            window.addEventListener('load', function(){
                setTimeout(scrollTo, 0, 0, 1);
            }, false);
        </script>
    </head>
    <body style="padding: 0; margin: 0;">
        <div style="width: 100%; height: 50px; overflow: hidden;">
            <div style="width: 500px;">
                <img src="http://www.swurve.com/assets/img/mobile/header.png" style="display: inline; margin-top: -8px; margin-bottom: -8px;"  />
                <img src="http://www.swurve.com/assets/img/mobile/people.png" style="margin-left: -50px; display: inline;" />
            </div>
        </div>
        <div id="menu" style="clear: both;">
            <ul id="menu-options">
                <li><?= HTML::anchor('mobile/login', 'Sign In'); ?></li>
                <li class="register"><?= HTML::anchor('user/register', 'Sign Up'); ?></li>
            </ul>
        </div>
        <div>
        <?php
            switch($page) {
                case 'login':
        ?>
            <?php
            echo Form::open(NULL, array('id' => 'register'));
            ?>
            <fieldset>
            <?php
            echo Form::label('username', 'Username');
            echo Form::input('username', $post['username'], array('id' => 'username', 'maxlength' => '25'));
            echo (empty ($errors['username'])) ? '<br />' : '<br /><span class="errors">' . $errors['username'] . '</span>';

            echo Form::label('password', 'Password');
            echo Form::password('password', $post['password'], array('id' => 'password', 'maxlength' => '25')) . '';
            echo (empty ($errors['password'])) ? '<br />' : '<br /><span class="errors">' . $errors['password'] . '</span>';
            
            echo Form::submit('register-submit', 'Login', array('id' => 'register-submit'));
            echo '<br />' . HTML::anchor('user/resetpass', 'Forgot Password?');
            echo '<br />';
            ?>
            </fieldset>
            <?php
            echo Form::close();
            ?>
        <?php
                    break;
                    
                default:
        ?>                
            <div id="geotext" style="text-align: center;"><span class="pink">Sexy Singles Seeking to Hook Up in</span><br /><span class="blue"><?= $geolocation ?></span></div>

            <div id="geoprofiles" style="padding-bottom: 13px;">
                <ul id="profile">
                    <?php foreach($users as $user): ?>
                    <li>
                        <?= HTML::anchor((Core::$user) ? 'home' : 'user/register/' . $user->username, HTML::image('assets/photos/geo/both/' . strtolower($user->username) . '.png', array('style' => 'width: 60px; height: 60px;'))); ?><br />
                        <h4><?= $user->username; ?></h4>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div class="clear"></div>
            </div>
        <?php
                break;
            }
        ?>
        </div>
        <div id="footer">
            <div id="footer-bg">
                <p>
                    Switch To <?= HTML::anchor('/?force=full', 'Full Site'); ?> &#8226; <?= HTML::anchor('terms', 'Terms'); ?> &#8226; <?= HTML::anchor('privacy', 'Privacy'); ?> &#8226; <?= HTML::anchor('2257', '2257'); ?><br />
                    Copyright &copy; <?= date('Y'); ?> Swurve Media Corp
                </p>
            </div>
        </div>
    </body>
</html>