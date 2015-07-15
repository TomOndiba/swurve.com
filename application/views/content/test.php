<script type="text/javaScript">
$(document).ready(function() {
       $('#im').click(function() {
        $('#log').append('sending chat requestion<br />');
        //var channel = APE.getChannelByName($('#channel').val());

        //IM.core.join('OmicroN');
        IM.core.request.send('SEND_CHAT', {name: $('#channel').val(), from: myPipe});

        //IM.core.setSession({'userpipe':'wtf'});
        $('#log').append('sending chat requestion to ' + $('#channel').val() + '<br />');
    });

    $('#leave').click(function() {
        $('#log').append('leaving chat<br />');
        //var channel = APE.getChannelByName($('#channel').val());

        //IM.core.join('OmicroN');
        IM.core.left($('#channel').val());

        //IM.core.setSession({'userpipe':'wtf'});
        $('#log').append('Left Channel ' + $('#channel').val() + '<br />');
    });
    
    $('#send').click(function() {
        userPipe.send($('#msg').val());
        $('#chat').append(nickname + ': ' + $('#msg').val() + '<br />')

        CB_Cookie.set(userInfo.properties.name, CB_Cookie.get(userInfo.properties.name) + nickname + ': ' + $('#msg').val() + '<br />');
        
        $('#msg').val('');

        //console.log('message sent');
        $('#log').append('sent message<br />');
    });

    $('#quit').click(function() {
        $('#log').append('quiting<br />');
        //test.core.left($('#msg').val());
        IM.core.clearSession();
        //test.core.quit();
        $('#log').append('quit<br />');
    });

    $('#test').click(function() {
        
        $('.im-dialog[user=OmicroN]').find('.messages').append('another test!@#');
        
        return;
        //alert('hi');
        /*$('.im-dialog').dialog({
            autoOpen: false,
            height: 278,
            width: 303,
            resizable: false,
        });
        
        $('.im-dialog[from=OmicroN]').dialog('open')
        */
        //var newIM = $('.im-dialog').clone(true);
        
        var newIM = $('<div class="im-dialog"><div class="messages"></div><input type="text" name="message" class="msg-im"> <input type="button" name="send" class="send-im" value="SEND"></div>').attr('from', 'test').attr('title', 'Instant Message - Test1');

        newIM.find(':button').bind("click", function(e){
            alert('asdf');
        });

        newIM.appendTo('body');

        $(newIM).dialog({
            height: 278,
            width: 303,
            resizable: false,
            dialogClass: 'IM',
        });
/*        
        $('<div title="Instant Message - Test" from="test">' + $('.im-dialog').html() + '</div>').dialog({
            height: 278,
            width: 303,
            resizable: false,
        });
*/        
        //$('.im-dialog[from=OmicroN]').find('.messages').append('testing');
        $('.im-dialog[from=test]').find('.messages').append('another test!@#');
    });
    
    $(window).bind("beforeunload", function(){
        //alert("Leaving so soon1?.");
//test.core.left('IM_OmicroN');
        //test.clearSession();
        //test.core.request.send('myquit');
        //test.core.quit();
    });

    //window.onbeforeunload = function() {
    //        return "Leaving so soon2?."; 
    //}
});
</script>

<input type="text" name="channel" id="channel" /> <input type="button" id="im" value="Chat Request" > <input type="button" id="leave" value="Leave Chat" >
<input type="button" id="quit" value="Quit" >

<div id="chat"></div><br />
<input type="text" name="msg" id="msg" /> <input type="button" id="send" value="Send Message" > <input type="button" id="test" value="Test" >
<br /><br />
<div id="log"></div>
    <ul>
        <li><a href="#" onclick="alert(CB_Cookie.get('kookie')); return false">alert(CB_Cookie.get('kookie'))</a></li>
        <li><a href="#" onclick="CB_Cookie.del('kookie'); return false">CB_Cookie.del('kookie');</a></li>
        <li><a href="#" onclick="CB_Cookie.set('kookie','daniel'); return false">CB_Cookie.set('kookie','daniel')</a></li>
        <li><a href="#" onclick="CB_Cookie.set('kookie','bulli'); return false">CB_Cookie.set('kookie','bulli')</a></li>
    </ul>
    

<style>
#im-container {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 30px;
    z-index: 1000;
    background-color: #70A3D6;
    border-top: 1px solid #000;
}
</style>
    
<div id="im-container">

</div>