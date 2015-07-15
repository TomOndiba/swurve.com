/* Copyright 2014 SMC Media Group */
/*
 * Random helper functions for use with customer JQuery functions below.
 */

function check_strength(password)
{
    var level = 0;

    if ($(password).val().search(/[A-Z a-z]/) >= 0) level += 1;
    if ($(password).val().search(/[0-9]/) >= 0) level += 1;
    if ($(password).val().search(/[^0-9A-Z a-z]/) >= 0) level += 1;

    if ($(password).val().length < 7) level = 1;
    if ($(password).val().length < 6) level = 0;

    if (level == 0)
    {
        $('#password-strength').html('');
    }
    else if (level == 1)
    {
        $('#password-strength').html('<div id="password-strength-1">weak</div>');
    }
    else if (level == 2)
    {
        $('#password-strength').html('<div id="password-strength-2">medium</div>');
    }
    else if (level == 3)
    {
        $('#password-strength').html('<div id="password-strength-3">strong</div>');
    }
}

$(document).ready(function()
{
    $('form#register input').focus(function()
    {
        var tooltip = {
            'arrow': '<span>&#9668;</span> ',
            'username': 'Use this login to access the Swurve.com site and services.',
            'password': '<div id="password-strength"></div>Strong passwords contain 7-16 characters, do not include common words or names, and combine uppercase letters, lowercase letters, numbers, and symbols.',
            'email': 'If you forget your password we\'ll send password reset information to this address.  This is used to communicate with you about other members.'
        };
            
        if (!tooltip[$(this).attr('name')]) return;

        if($.browser.msie){
            $('#tooltip').css({ 'line-height': '17px', 'position': 'absolute', 'display': '', 'top': $(this).offset().top - $(this).parent().offset().top + 124, 'margin-left': $(this).width() + $(this).prev().width() + 30 }).html(tooltip['arrow'] + tooltip[$(this).attr('name')]).show();
        } else {
            $('#tooltip').css({ 'line-height': '17px', 'position': 'absolute', 'display': '', 'top': $(this).offset().top - $(this).parent().offset().top + 135, 'margin-left': $(this).width() + $(this).prev().width() + 58 }).html(tooltip['arrow'] + tooltip[$(this).attr('name')]).show();
        }
    }).blur(function() 
    {
        $('#tooltip').hide();
    });
    
    $('form#register input[type=password]').keyup(function(e)
    {
        check_strength(this);
    }).focus(function()
    {
        check_strength(this);
    });
});