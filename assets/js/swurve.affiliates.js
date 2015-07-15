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

$(document).ready(function() {
    var cache = {};
   
    $('#country').live('change', function()
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

    $('#region').live('change', function()
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
    /*
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
                    response(data);
                }
            });
        },
        minLength: 2,
        select: function(event, ui) {
            $('#city_id').val(ui.item.id);
        }
    });
    */
    $('#city').focus(function() {
        if ($(this).val() == 'Enter A City')
        {
            $(this).val('');
        }
    });
    /*
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

        if (found == false)
        {
            $(city).val('');
        }
    });

    $("#city").keypress(function (e) {   
        if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {   
            return false;   
        }
    });
    */
});