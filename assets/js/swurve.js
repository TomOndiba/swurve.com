/* Copyright 2014 SMC Media Group */

function isArray(testObject)
{
    return testObject && !(testObject.propertyIsEnumerable('length')) && typeof testObject === 'object' && typeof testObject.length === 'number';
}

function dump(arr, level)
{
    var dumped_text = '';
    var level_padding = '';

    if (!level) level = 0;

    for (var j = 0; j < level + 1; j++) level_padding += '    ';

    if (typeof(arr) == 'object')
    {
        for (var item in arr)
        {
            var value = arr[item];

            if (typeof(value) == 'object')
            {
                dumped_text += level_padding + "'" + item + "' ...\n";
                dumped_text += dump(value, level + 1);
            }
            else
            {
                dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
            }
        }
    }
    else
    {
        dumped_text = '===>' + arr + '<===(' + typeof(arr) + ')';
    }

    return dumped_text;
}

function playPOP()
{
		if ($.browser.msie)
		{
    		$("#newchatrequest").html("<embed src='/assets/pop.wav' hidden='true' autostart='true' loop='false' />");
		}
		else
		{
    		$("#newchatrequest").html("<audio src='/assets/pop.wav' autoplay='autoplay'><source src='/assets/pop.wav' type='audio/wav' /></audio>");
		}
}

$.fn.QSpopulate = function(page, text)
{
    this.each(function() {
        var elem = $(this);

        elem.attr('disabled', 'disabled').html('<option selected="selected" value="">Populating... Please Wait...</option>');

        $.getJSON(page, null, function(data)
        {
            if (elem.attr('id') == 'QSregion' && data.result == '')
            {
                elem.html('<option selected="selected" value="">No Regions... Select A City</option>');
                $('#QScity').removeAttr('disabled').css('color', '#000');
            }
            else
            {
                if($.browser.msie){
                    elem.get(0).outerHTML = '<select id="' + elem.attr('id') + '" class="' + elem.attr('class') + '"><option value="">' + text + '</option>' + data.result + '</select>';
                }
                else
                {
                    elem.html('<option value="">' + text + '</option>' + data.result);
                }

                elem.removeAttr('disabled');
            }
        });
    });

    return this;
};

$.fn.populate = function(page, text)
{
    this.each(function() {
        var elem = $(this);

        elem.attr('disabled', 'disabled').html('<option selected="selected" value="">Populating... Please Wait...</option>');

        $.getJSON(page, null, function(data)
        {
            if (elem.attr('id') == 'region' && data.result == '')
            {
                elem.html('<option selected="selected" value="">No Regions... Enter A City</option>');
                $('#city').removeAttr('disabled').css('color', '#000');
            }
            else
            {
                if($.browser.msie){
                    elem.get(0).outerHTML = '<select id="' + elem.attr('id') + '" class="' + elem.attr('class') + '"><option value="">' + text + '</option>' + data.result + '</select>';
                }
                else
                {
                    elem.html('<option value="">' + text + '</option>' + data.result);
                }

                elem.removeAttr('disabled');
            }
        });
    });

    return this;
};

$.ajaxSetup({
    cache: false
});

$(document).ready(function() {
    var cache = {};
    var lastclick = new Date().getTime();

    jQuery.expr[':'].focus = function( elem ) {
    	return elem === document.activeElement && ( elem.type || elem.href );
    };


    // Favs mouseover
    $('.addfav').live('mouseover', function() {
        $(this).find('img').attr('src', $(this).find('img').attr('tag') + '-mouseover.png');
    }).live('mouseout', function() {
        $(this).find('img').attr('src', $(this).find('img').attr('tag') + '.png');
    });

    $('.profile-button').live('click', function(event) {
        var elem = $(this);

        if ($(this).attr('link') == 'chat')
        {
            if (new Date().getTime() - lastclick < 1000) return

            lastclick = new Date().getTime();

            if ($(this).attr('credits') >= 1 && $(this).attr('mys') > 1)
            {
                $.get("/auto/start_chat/" + $(this).attr('reci'), function(data) {

                    if (data == 'opensession')
                    {
                        alert('You have an open chat session with this person, if you cannot see the chat, please try one of the following:  \n\nRefreshing the page\nLogging out and back in\nContacting support@swurve.com for help');
                    }
                    else if (data == 'pending')
                    {
                        alert('You have a recent pending chat request for this person, please wait 180 seconds before making another request.');
                    }
                    else
                    {
                        $('body').prepend('<div style="position: absolute; top: 50px; left: 100px; border: 2px solid #95999C; z-index: 10;" chatid="' + data.split('-')[0] + '" class="chat-window" id="chatwindow-' + elem.attr('recu') + '" url="identifier=' + data + '&sender=' + elem.attr('myu') + '&senderi=' + elem.attr('myi') + '&senderp=' + elem.attr('myp') + '&reciever=' + elem.attr('recu') + '&recieveri=' + elem.attr('reci') + '"></div>');

                        $('#chatwindow-' + elem.attr('recu')).initiateChat({ 
                            from: elem.attr('myu'), 
                            to: elem.attr('recu'), 
                            fromid: elem.attr('myi'), 
                            toid: elem.attr('reci'), 
                            gender: elem.attr('myg'),
                            toImage: elem.attr('recimage'),
                            identifier: data
                        });

                        $('#chatwindow-' + elem.attr('recu')).focus();

                        $('html,body').animate({scrollTop: $('#chatwindow-' + elem.attr('recu')).offset().top-400},500);
                    }
                });
            }
            else
            {
                if ($(this).attr('mys') <= 1)
                {
                    alert('You must be a paying member to use feature.');

                    location.href = '/user/upgrade';
                }
                else
                {
                    alert('You do not have enough credits to initiate a chat session.');

                    location.href = '/credits/buy';
                }
            }
        }
        else if ($(this).attr('link') == 'not online')
        {
            alert('This user is not available to chat.  Please try again later.');
        }
        else if ($(this).attr('link') == '')
        {
            return false;
        }
        else
        {
            location.href = $(this).attr('link');
        }
    });

    //$('#QScountry').QSpopulate('/json/countries', 'Select A Country');

    $('#QScountry').change(function()
    {
        if ($(this).val() != '')
        {
            $('#QScity').attr('disabled', 'disabled').val('Enter A City').css('color', '#808080');
            $('#QSregion').populate('/json/regions/' + $(this).val().toLowerCase(), 'Select A Region');
        }
        else
        {
            $('#QSregion').attr('disabled', 'disabled').html('<option selected="selected" value="">Select A Region</option>');
            $('#QScity').attr('disabled', 'disabled').val('Enter A City').css('color', '#808080');
        }
    });

    $('#QSregion').change(function()
    {
        $('#city_id').val('');

        if ($(this).val() != '')
        {
            if ($(this).find('option').size() > 1)
            {
                $.getJSON('/json/count/' + $('#QScountry').val().toLowerCase() + '/' + $(this).val().toLowerCase(), null, function(data)
                {
                    if (data.result[0]['count'] == 0)
                    {
                        $('#QScity').attr('disabled', 'disabled').val('No Cities For This Region').css('color', '#808080');
                    }
                    else
                    {
                        $('#QScity').removeAttr('disabled').css('color', '#000').val('Enter A City');
                    }
                });
            }
        }
        else
        {
            $('#QScity').attr('disabled', 'disabled').val('Enter A City').css('color', '#808080');
        }
    });

    $("#QScity").autocomplete({
        source: function(request, response) {
            if (cache.term == request.term && cache.content) {
                response(cache.content);
            }
            if (new RegExp(cache.term).test(request.term) && cache.content && cache.content.length < 13) {
                var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
                response($.grep(cache.content, function(value) {
                    return matcher.test(value.value)
                }));
            }

            $.ajax({
                url: '/json/cities/' + $('#QScountry').val().toLowerCase() + '/' + (($('#QSregion').val() == '') ? '00' : $('#QSregion').val()),
                dataType: "json",
                data: request,
                success: function(data) {
                    cache.term = request.term;
                    cache.content = data;
                    response(data);
                }
            });
        },
        minLength: 2,
        select: function(event, ui) {
            $('#city_id').val(ui.item.id);
        }
    });

    $('#QScity').focus(function() {
        if ($(this).val() == 'Enter A City')
        {
            $(this).val('');
        }
    });

    $("#QScity").blur( function() {
        var city = this;
        var found = false;

        $.each(cache.content, function(i, val) {
            if ($(city).val().toLowerCase() == val.value.toLowerCase())
            {
                found = true;
                $(city).val(val.value);
                $('#city_id').val(val.id);
            }
        });

        if (found == false)
        {
            $(city).val('');
        }
    });

    $("#QScity").keypress(function (e) {
        if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
            return false;
        }
    });

    // Country / Region / City search code
    if (location.pathname != '/user/register' && location.pathname != '/edit/profile' && location.pathname.indexOf('/admin/manage/user/') < 0) {
        //$('#country').populate('/json/countries', 'Select A Country');
    }

    $('#country').change(function()
    {
        if ($(this).val() != '')
        {
            $('#city').attr('disabled', 'disabled').val('Enter A City').css('color', '#808080');
            $('#region').populate('/json/regions/' + $(this).val().toLowerCase(), 'Select A Region');
        }
        else
        {
            $('#region').attr('disabled', 'disabled').html('<option selected="selected" value="">Select A Region</option>');
            $('#city').attr('disabled', 'disabled').val('Enter A City').css('color', '#808080');
        }
    });

    $('#region').change(function()
    {
        $('#city_id').val('');

        if ($(this).val() != '')
        {
            if ($(this).find('option').size() > 1)
            {
                $.getJSON('/json/count/' + $('#country').val().toLowerCase() + '/' + $(this).val().toLowerCase(), null, function(data)
                {
                    if (data.result[0]['count'] == 0)
                    {
                        $('#city').attr('disabled', 'disabled').val('No Cities For This Region').css('color', '#808080');
                    }
                    else
                    {
                        $('#city').removeAttr('disabled').css('color', '#000').val('Enter A City');
                    }
                });
            }
        }
        else
        {
            $('#city').attr('disabled', 'disabled').val('Enter A City').css('color', '#808080');
        }
    });

    $("#city").autocomplete({
        source: function(request, response) {
            if (cache.term == request.term && cache.content) {
                response(cache.content);
            }
            if (new RegExp(cache.term).test(request.term) && cache.content && cache.content.length < 13) {
                var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
                response($.grep(cache.content, function(value) {
                    return matcher.test(value.value)
                }));
            }

            $.ajax({
                url: '/json/cities/' + $('#country').val().toLowerCase() + '/' + (($('#region').val() == '') ? '00' : $('#region').val()),
                dataType: "json",
                data: request,
                success: function(data) {
                    cache.term = request.term;
                    cache.content = data;

                    if ($("#city").is(':focus'))
                    {
                    	response(data);
                    }
                    else
                    {
                    	var found = false;

                        $.each(cache.content, function(i, val) {
                            if ($("#city").val().toLowerCase() == val.value.toLowerCase())
                            {
                                found = true;
                                $("#city").val(val.value);
                                $('#city_id').val(val.id);
                            }
                        });

                        if (found == false)
                        {
                        	response(data);
                        }
                    }
                }
            });
        },
        minLength: 3,
        delay: 200,
        select: function(event, ui) {
            $('#city_id').val(ui.item.id);
        }
    });

    $('#city').focus(function() {
        if ($(this).val() == 'Enter A City')
        {
            $(this).val('');
        }
    });

    $("#city").blur( function() {
        var city = this;
        var found = false;

        $.each(cache.content, function(i, val) {
            if ($(city).val().toLowerCase() == val.value.toLowerCase())
            {
                found = true;
                $(city).val(val.value);
                $('#city_id').val(val.id);
            }
        });

        //if (found == false)
        //{
        //    $(city).val('');
        //}
    });

    $("#city").keypress(function (e) {
        if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
            return false;
        }
    });

    var feedOffset = 0;

    $('#more-feed').click(function() {
        feedOffset += 10;

        $.get('/feed/' + feedOffset, function(data) {
            $('#activity').append(data);
        });
    });

    (window.ajaxEmailCheck = function() {
        $.ajax({
            type: 'GET',
            cache: false,
            dataType: 'json',
            url: '/json/unreademails',
            success: function(results) {
                if (results.count > 0)
                {
                    if ($('#emailnotify').length)
                    {
                        $('#emailnotify').html( results.count );
                    } else {
                        $('#menu-mailbox').addClass('newmail').prepend('<div id="emailnotify">' + results.count + '</div>');
                    }
                } else {
                    $('#emailnotify').remove();
                    $('#menu-mailbox').removeClass('newmail');
                }

                setTimeout(ajaxEmailCheck, 60000);
            }
        });
    })();

    (window.ajaxCreditBalanceCheck = function() {
        $.ajax({
            type: 'GET',
            cache: false,
            dataType: 'json',
            url: '/json/creditbalance',
            success: function(results) {
                $('#credit-balance').html( results.count );

                setTimeout(ajaxCreditBalanceCheck, 60000);
            }
        });
    })();
});
