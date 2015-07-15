<?php
    list($afl, $subid, $landing, $type) = explode('&', $properties);

    $landings = Functions::affiliate_landings();
    
    if ( ! empty($previewtext))
    {
        echo $previewtext . '<script language="javascript" type="text/javascript">';
    }
?>
    var ca_messages = [];
    var ca_closing = false;
    var ca_i = 0;
    var ca_girls_static = ['Danica1987', 'greeneyedgurl', 'HannaBeth00', 'HeySailorXO', 'NaughtyNatalie98', 'NessaNeedsIt', 'sexxxijenni69', 'SxyMelinda4U', 'TouchKrista98', 'xXStacie24Xx'];
    var ca_girls_flash = ['Jessica96', 'SxxxyGinger', 'oXMandyXo', 'XXXTina4u'];

    var ca_flow_control;
    var ca_username;
    var ca_message;

    var sa_afl = '<?= $afl; ?>';
    var sa_subid = '<?= $subid; ?>';
    var sa_landing_id = '<?= $landing; ?>';
    var sa_landings = [];

    <?php
        foreach ($landings as $landingid => $landinginfo)
        {
            foreach ($landinginfo as $name => $url)
            //echo 'sa_landings.push({0:"' . $name . '", 1:"' . $url . '?a=' . $afl . (( ! empty($subid)) ? '&s=' . $subid : '') .'"});' . "\n";
            echo 'sa_landings[' . $landingid . '] = {0:"' . $name . '", 1:"' . $url . '?a=' . $afl . (( ! empty($subid)) ? '&s=' . $subid : '') .'"};' . "\n";
        }
    ?>

    ca_messages = [
        [
            "Hey, What's up?",
            "Anything good going on tonight?",
            "I'm so bored, need to get out and do something fun. What are you up to?",
            "Hello? Are you there??"
        ],
        [
            "Hi there :)",
            "A/S/L?",
            "I'm looking to hook up with someone laid back. Hoping to find a \"friend with benefits\" if you know what I mean ;)",
            "So, are you interested?",
            "R U there?"
        ],
        [
            "Hey U! What cha doin'?",
            "I'm just sitting here all by my lonesome looking for someone sexy to chat with. Maybe more... Maybe U?",
            "I want to hook up but nothing serious. I'm a no strings attached kind of girl.",
            "Is that something you can be down with?",
            "Um.... Hello?"
        ],
        [
            "Hey sexy!",
            "Local boy, huh?",
            "Tell me whats good. What are you doing right now?",
            "What would you like to be doing? Maybe something with me? ;)",
            "Cat got your tongue?",
            ":("
        ],
        [
            "Heyo! What's shakin bacon!?",
            "Looking for someone to get into some naughty trouble with tonght.",
            "You game?",
            "Don't worry, I don't bite.. often ;)",
            "Well, don't keep me hangin babe... U there?"
        ]
    ];

    ca_message = Math.floor(Math.random() * ca_messages.length);
    ca_username =  <?= ($type == 'Static') ? 'ca_girls_static[' : 'ca_girls_flash['; ?>  Math.floor(Math.random() * <?= ($type == 'Static') ? 'ca_girls_static' : 'ca_girls_flash'; ?>.length)];
    
    addDOMLoadEvent=(function(){var e=[],t,s,n,i,o,d=document,w=window,r='readyState',c='onreadystatechange',x=function(){n=1;clearInterval(t);while(i=e.shift())i();if(s)s[c]=''};return function(f){if(n)return f();if(!e[0]){d.addEventListener&&d.addEventListener("DOMContentLoaded",x,false);/*@cc_on@*//*@if(@_win32)d.write("<script id=__ie_onload defer src=//0><\/scr"+"ipt>");s=d.getElementById("__ie_onload");s[c]=function(){s[r]=="complete"&&x()};/*@end@*/if(/WebKit/i.test(navigator.userAgent))t=setInterval(function(){/loaded|complete/.test(d[r])&&x()},10);o=w.onload;w.onload=function(){x();o&&o()}}e.push(f)}})();

    addDOMLoadEvent(function() {
        var ca_ContainerMain = document.createElement('div');
        
        ca_ContainerMain.id = 'swurve_chatad';
        
        var css = 'position:fixed;';

        if (document.all && window.XMLHttpRequest && !window.opera) {
            if ( ( window.document.childNodes[0].text == undefined ) || ( window.document.childNodes[0].text.search(/DOCTYPE\s+HTML\s+PUBLIC.+\.dtd/i) == -1) ) {
                css = 'position:absolute; top:expression( eval( document.compatMode && document.compatMode == \'CSS1Compat\' ) ? documentElement.scrollTop + (documentElement.clientHeight-this.clientHeight) : document.body.scrollTop + ( document.body.clientHeight-this.clientHeight ) ); ';
            }
        }

        if(document.all && !window.XMLHttpRequest){
            css = 'position:absolute; top:expression( eval( document.compatMode && document.compatMode == \'CSS1Compat\' ) ? documentElement.scrollTop + (documentElement.clientHeight-this.clientHeight) : document.body.scrollTop + ( document.body.clientHeight-this.clientHeight ) ); ';
        }

        ca_ContainerMain.style.cssText = css;
        
        //ca_ContainerMain.style.position = 'fixed';
        ca_ContainerMain.style.bottom = '0';
        ca_ContainerMain.style.right = '0';
        ca_ContainerMain.style.border = '1px solid #000';
        ca_ContainerMain.style.zIndex = '5000';
        //ca_ContainerMain.style.width = '350px';
        //ca_ContainerMain.style.height = '175px';        
        
        //addNewStyle('#swurve_chatad { position: fixed !important; botton: 0 !important; right: 0 !important; border: 1px solid #000 !important; z-index: 5000 !important; }');
        
        var ca_Container = document.createElement('div');
        
        ca_Container.style.width = '350px';
        ca_Container.style.height = '175px';        
        ca_Container.style.fontSize = '14px';
        ca_Container.style.color = '#104786';
        ca_Container.style.lineHeight = '17px';
        ca_Container.style.fontFamily = 'Verdana';        
        ca_Container.style.backgroundColor = '#fff';
        
        //ca_Container.style.cssText = 'width: 350px !important; height: 175px !important; font-size: 14px !important; color: #104786 !important; line-height: 17px !important; font-family: verdana !important; background-color: #fff !important;';
        
        var ca_Titlebar = document.createElement('div');
        
        ca_Titlebar.innerHTML = 'Chat Request From ' + ca_username;
        ca_Titlebar.style.backgroundColor = '#000099';
        ca_Titlebar.style.padding = '3px';
        ca_Titlebar.style.color = '#fff';
        ca_Titlebar.style.fontWeight = 'bold';
        ca_Titlebar.style.cursor = 'pointer';
        ca_Titlebar.style.textAlign = 'left';
        
        //ca_Titlebar.style.cssText = 'background-color: #000099 !important; padding 3px !important; color: #fff !important; font-weight: bold !important; cursor: pointer !important;';

        var ca_CloseButton = document.createElement('div');
        
        ca_CloseButton.style.right = '0';
        ca_CloseButton.style.top = '0';
        ca_CloseButton.style.position = 'absolute';
        ca_CloseButton.style.width = '19px';
        ca_CloseButton.style.height = '20px';
        ca_CloseButton.style.margin = '1px';
        ca_CloseButton.style.backgroundColor = '#ff0000';
        
        var ca_CloseButtonIcon = document.createElement('div');

        ca_CloseButtonIcon.innerHTML = 'x';
        ca_CloseButtonIcon.style.fontSize = '20px';
        ca_CloseButtonIcon.style.color = '#fff';
        ca_CloseButtonIcon.style.marginLeft = '3px';
        ca_CloseButtonIcon.style.marginTop = '-1px';
        
        ca_CloseButton.appendChild(ca_CloseButtonIcon);        
        ca_Titlebar.appendChild(ca_CloseButton);
        ca_Container.appendChild(ca_Titlebar);
        
        var ca_ProfileInfo = document.createElement('div');
        
        ca_ProfileInfo.style.border = '1px solid black';
        ca_ProfileInfo.style.width = '100px';
        ca_ProfileInfo.style.height = '100px';
        
        <?php if ($type == 'Static'): ?>
        var ca_ProfileImage = document.createElement('img');
        
        ca_ProfileImage.src = '<?= URL::site('/', 'http'); ?>assets/img/affiliates/chatad/girls/' + ca_username + '.png';

        ca_ProfileInfo.appendChild(ca_ProfileImage);
        <?php else: ?>
        var ca_Flash = document.createElement('div');
        
        ca_Flash.id = 'swurvecamflash';

        ca_Flash.innerHTML = '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="100" height="100" id="camz" align="middle"><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="false" /><param name="movie" value="<?= URL::site('/', 'http'); ?>assets/img/affiliates/chatad/cam.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="flashvars" value="landing=' + escape(sa_landings[sa_landing_id][1]) + '&girl=' + ca_username + '" />    <embed src="<?= URL::site('/', 'http'); ?>assets/img/affiliates/chatad/cam.swf" quality="high" bgcolor="#ffffff" width="100" height="100" name="camz" align="middle" allowScriptAccess="always" allowFullScreen="false" flashvars="landing=' + escape(sa_landings[sa_landing_id][1]) + '&girl=' + ca_username + '" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>';
        
        ca_ProfileInfo.appendChild(ca_Flash);
        <?php endif; ?>
        
        var ca_ProfileInfoContainer = document.createElement('div');
        
        ca_ProfileInfoContainer.cssFloat = 'left';
        ca_ProfileInfoContainer.styleFloat = 'left';
        ca_ProfileInfoContainer.style.left = '0';
        ca_ProfileInfoContainer.style.width = '100px';
        ca_ProfileInfoContainer.style.position = 'absolute';
        //ca_ProfileInfoContainer.style.border = '1px solid red';
        ca_ProfileInfoContainer.style.margin = '10px';
        ca_ProfileInfoContainer.style.textAlign = 'center';
        
        var ca_ProfileDetails = document.createElement('div');
        
        ca_ProfileDetails.style.marginTop = '2px';
        ca_ProfileDetails.style.fontSize = '10px';
        ca_ProfileDetails.style.lineHeight = '15px';
        ca_ProfileDetails.style.cursor = 'pointer';

        ca_ProfileDetails.innerHTML = '<strong>' + ca_username + '</strong><br /><span style="font-size: 9px;"><?= $geolocation; ?></span>'

        ca_ProfileInfoContainer.appendChild(ca_ProfileInfo);
        ca_ProfileInfoContainer.appendChild(ca_ProfileDetails);
        
        ca_Container.appendChild(ca_ProfileInfoContainer);

        var ca_ChatConvoContainer = document.createElement('div');
        
        ca_ChatConvoContainer.style.border = '1px solid black';
        ca_ChatConvoContainer.style.marginTop = '33px';
        ca_ChatConvoContainer.style.marginRight = '10px';
        ca_ChatConvoContainer.style.position = 'absolute';
        ca_ChatConvoContainer.style.right = '0';
        ca_ChatConvoContainer.style.top = '0';
        
        var ca_ChatConvo = document.createElement('div');
        
        ca_ChatConvo.style.width = '220px';
        ca_ChatConvo.style.height = '100px';
        ca_ChatConvo.style.textAlign = 'left';

        ca_ChatConvo.style.overflow = 'auto';

        ca_ChatConvoContainer.appendChild(ca_ChatConvo);
        ca_Container.appendChild(ca_ChatConvoContainer);

        var ca_TextInputContainer = document.createElement('div');
        
        ca_TextInputContainer.style.border = '1px solid black';
        //ca_TextInputContainer.style.width = '220px';
        //ca_TextInputContainer.style.height = '21px';
        ca_TextInputContainer.style.marginBottom = '10px';
        ca_TextInputContainer.style.marginRight = '10px';
        ca_TextInputContainer.style.position = 'absolute';
        ca_TextInputContainer.style.right = '0';
        ca_TextInputContainer.style.bottom = '0';

        var ca_TextInputSizer = document.createElement('div');
        
        ca_TextInputSizer.style.width = '220px';
        ca_TextInputSizer.style.height = '21px';

        var ca_TextInput = document.createElement('input');

        ca_TextInput.type = 'text';
        ca_TextInput.style.width = '220px';
        ca_TextInput.style.height = '20px';
        ca_TextInput.style.lineHeight = '20px';
        ca_TextInput.style.fontSize = '10px';
        ca_TextInput.style.border = '0';
        ca_TextInput.style.margin = '0';
        ca_TextInput.style.padding = '0';
        
        ca_TextInputSizer.appendChild(ca_TextInput);
        
        ca_TextInputContainer.appendChild(ca_TextInputSizer);
        
        ca_Container.appendChild(ca_TextInputContainer);
        
        ca_Container.onclick = function() {
            if ( ! ca_closing)
                window.open(sa_landings[sa_landing_id][1]);
        };
        
        ca_CloseButton.onclick = function() {
            document.getElementById('swurve_chatad').style.display = 'none';
            ca_closing = true;
        };
        
        ca_ContainerMain.appendChild(ca_Container);
        
        document.body.appendChild(ca_ContainerMain);

        sleep((Math.floor(Math.random() * 3) + 2) * 1000, ca_ChatConvo);
    });

    function addNewStyle(newStyle) {
        var styleElement = document.getElementById('styles_js_swurve');

        if (!styleElement) {
            styleElement = document.createElement('style');
            styleElement.type = 'text/css';
            styleElement.id = 'styles_js_swurve';
            document.getElementsByTagName('head')[0].appendChild(styleElement);
        }

        styleElement.appendChild(document.createTextNode(newStyle));
    }

    function run(segment, ca_chat) {
        var ca_ChatText = document.createElement('div');

        ca_ChatText.innerHTML = ((ca_i > 0) ? '<br />' : '') + '<span style="font-size: 10px; display: block; margin-left: 2px; padding-bottom: 4px; margin-top: 2px;"><strong>' + ca_username + '</strong>: ' + ca_messages[ca_message][ca_i] + '</span>';
        ca_ChatText.style.lineHeight = '10px';

        ca_chat.appendChild(ca_ChatText);
        
        ca_chat.scrollTop = ca_chat.scrollHeight;
    }

    function sleep(dur, ca_chat)
    {
        ca_flow_control = setTimeout(function() {
            flow(ca_chat)
        }, dur);
    }

    function flow(ca_chat) {
        run(ca_i, ca_chat);

        ca_i = ca_i + 1;

        //sleep((Math.floor(Math.random() * 7) + 8) * 1000, ca_chat);
        sleep(5000, ca_chat);
        
        //alert(ca_i + ':' + ca_messages.length);
        if (ca_i >= ca_messages[ca_message].length)
        {
            <?php if ($type == 'Flash'): ?>
            setTimeout(function() {
                ca_Flash = document.getElementById('swurvecamflash');
                
                ca_Flash.style.width = '100px';
                ca_Flash.style.height = '100px';
                ca_Flash.style.backgroundColor = 'black';            
                ca_Flash.innerHTML = '';

            }, 6000);
            <?php endif; ?>

            //ca_ProfileInfo.removeChild(ca_Flash);
            clearTimeout(ca_flow_control);
        }
    }
<?php
    if ( ! empty($previewtext))
    {
        echo '</script>';
    }
?>