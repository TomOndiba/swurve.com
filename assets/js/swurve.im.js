/* Copyright 2014 SMC Media Group */
    APE.Config.scripts = [APE.Config.baseUrl + '/Build/uncompressed/apeCoreSession.js'];

    var nickname;
    var myPipe;

    var IM_Client = function(name)
    {
        nickname = name;
        
        this.initEvents();
        this.load({'channel': nickname});
        
        this.onRaw('DATA', function(raw, pipe) {
            $('.im-dialog[user=' + raw.data.from.properties.name + ']').find('.messages').append(raw.data.from.properties.name + ': ' + unescape(raw.data.msg) + '<br />');

            CB_Cookie.set(raw.data.from.properties.name, CB_Cookie.get(raw.data.from.properties.name) + raw.data.from.properties.name + ': ' + unescape(raw.data.msg) + '<br />');
        });
        
        this.onRaw('CHAT_REQUEST', function(raw, pipe) {
            //$('#log').append('Chat request recieved from ' + raw.data.from.properties.name + ' (' + raw.data.from.pubid + ')<br />');

            if (confirm(raw.data.from.properties.name + ' has sent an Instant Message, do you Accept?')) {
                this.core.join(raw.data.from.properties.name);
            }
        });
        
        this.onRaw('IDENT', function(raw) {
            $('#chat').append(raw.data.user.properties.name + ' (' + raw.data.user.pubid + ') has logged entered<br />')
            
            myPipe = raw.data.user;
        });
    }
    
    IM_Client.prototype = new APE.Client();
    
    IM_Client.prototype.initEvents = function()
    {
        this.addEvent('load', this.clientLoad);
        this.addEvent('ready', this.clientReady);
        this.addEvent('userJoin', this.userJoin);
    }
    
    IM_Client.prototype.clientLoad = function()
    {
        if (this.core.options.restore) {
            this.core.start();
            
            /*this.core.getSession('userpipe', function(resp) {
                if (resp.data.sessions.userpipe != 'null')
                {
                    $('#log').append('Receiving sessions data. userpipe value is : ' + resp.data.sessions.userpipe + '<br />');
                }
            });*/
        } else {
            this.core.start({'name':nickname});
        }
    }
   
    IM_Client.prototype.clientReady = function()
    {

    }
    
    IM_Client.prototype.userJoin = function(user, pipe)
    {
        if (myPipe.pubid != user.pubid)
        {
            var newIM = $('<div class="im-dialog"><div class="messages"></div><input type="text" name="message" class="msg-im"> <input type="button" name="send" class="send-im" value="SEND"></div>').attr('user', user.properties.name).attr('pubid', user.pubid).attr('title', 'Instant Message - ' + user.properties.name);

            newIM.find('.messages').append( CB_Cookie.get(user.properties.name) );
            newIM.find(':button').bind("click", function(e){
                var imPipe = IM.core.getPipe(user.pubid); //$(this).parent().attr('pubid')

                imPipe.send( $(this).parent().find(':text').val() );

                $(this).parent().find('.messages').append( myPipe.properties.name + ': ' + $(this).parent().find(':text').val() + '<br />' );
                
                CB_Cookie.set(user.properties.name, CB_Cookie.get(user.properties.name) + myPipe.properties.name + ': ' + $(this).parent().find(':text').val() + '<br />');

                $(this).parent().find(':text').val('');
            });

            newIM.appendTo('body');

            $(newIM).dialog({
                height: 278,
                width: 303,
                resizable: false,
                dialogClass: 'IM',
                beforeclose: function(event, ui) {
                    //alert(dump(pipe));
                    if (confirm('Closing this window will terminate the IM with this user, do you want to continue?')) {
                        IM.core.left(user.pubid);
                        return true;
                    }

                    return false;
                }
            });
            
            $('#chat').append(CB_Cookie.get(user.properties.name))
        }
    }