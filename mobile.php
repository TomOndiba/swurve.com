<html>
    <head>
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
    
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
                padding: 10px;
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
        </style>
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
                <li><?= HTML::anchor('user/login', 'Sign In'); ?></li>
                <li class="register"><?= HTML::anchor('user/register', 'Sign Up'); ?></li>
            </ul>
        </div>
    </body>
</html>