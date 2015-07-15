<?php
    $landings = Functions::affiliate_landings();
?>
<script language="language" type="text/javascript">
    Array.prototype.find = function(searchStr) {  var returnArray = false;  for (i=0; i<this.length; i++) {    if (typeof(searchStr) == 'function') {      if (searchStr.test(this[i])) {        if (!returnArray) { returnArray = [] }        returnArray.push(i);      }    } else {      if (this[i]===searchStr) {        if (!returnArray) { returnArray = [] }        returnArray.push(i);      }    }  }  return returnArray;}

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

    $(document).ready(function() {
        var afl = <?= Core::$affiliate; ?>;
        var sub_id = 0;
        var banner_id = [];
        var landing_id = 0;
        var landings = [];
        var creative = 0;
        var site = '<?= URL::site('/', 'http'); ?>';

        <?php
            foreach ($landings as $landingid => $landinginfo)
            {
                foreach ($landinginfo as $name => $url)
                //echo 'landings.push({0:"' . $name . '", 1:"' . $url . '"});' . "\n";
                echo 'landings[' . $landingid . '] = {0:"' . $name . '", 1:"' . $url . '"};' . "\n";
            }
        ?>

        function update_code()
        {
            $('.banner').each(function() {
                $(this).find('textarea').val('<a href="' + landings[landing_id][1] + '?a=' + afl + ((sub_id != 0) ? '&s=' + sub_id : '') + '" target="_blank"><img src="' + $(this).find('img').attr('src') + '" border="0" /></a>');
            });

            //********
            $('textarea[name=geoprofiles-code]').val('<script language="javascript" type="text/javascript" src="' + site + 'affiliates/tools/geoprofiles/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#geoprofiles-filter select[name=geoprofiles-gender]').val() + '&' + $('#geoprofiles-filter select[name=geoprofiles-size]').val() + '&' + $('#geoprofiles-filter select[name=geoprofiles-width]').val() + '&' + $('#geoprofiles-filter select[name=geoprofiles-height]').val() + '&' + escape($('#geoprofiles-filter input[name=geoprofiles-title]').val()) + '"><' + '/script>');
            $('#geoprofiles-previewlink').attr('href', '/affiliates/tools/geoprofilespreview/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#geoprofiles-filter select[name=geoprofiles-gender]').val() + '&' + $('#geoprofiles-filter select[name=geoprofiles-size]').val() + '&' + $('#geoprofiles-filter select[name=geoprofiles-width]').val() + '&' + $('#geoprofiles-filter select[name=geoprofiles-height]').val() + '&' + escape($('#geoprofiles-filter input[name=geoprofiles-title]').val()));

            $('textarea[name=kruzegeoprofiles-code]').val('<script language="javascript" type="text/javascript" src="http://www.kruze.com/affiliates/tools/geoprofiles/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-gender]').val() + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-size]').val() + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-width]').val() + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-height]').val() + '&' + escape($('#kruzegeoprofiles-filter input[name=kruzegeoprofiles-title]').val()) + '"><' + '/script>');
            $('#kruzegeoprofiles-previewlink').attr('href', 'http://www.kruze.com/affiliates/tools/geoprofilespreview/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-gender]').val() + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-size]').val() + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-width]').val() + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-height]').val() + '&' + escape($('#kruzegeoprofiles-filter input[name=kruzegeoprofiles-title]').val()));
            //********

            //alert( $('#geoprofiles-preview').html() );
            //$('#geoprofiles-preview').load('/affiliates/tools/geoprofilespreview/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#geoprofiles-filter select[name=geoprofiles-gender]').val() + '&' + $('#geoprofiles-filter select[name=geoprofiles-size]').val() + '&' + $('#geoprofiles-filter select[name=geoprofiles-width]').val() + '&' + $('#geoprofiles-filter select[name=geoprofiles-height]').val() + '&' + escape($('#geoprofiles-filter input[name=geoprofiles-title]').val())).wrapInner('<center></center>');

            //$('#geoprofiles-preview').load('/affiliates/tools/geoprofilespreview/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#geoprofiles-filter select[name=geoprofiles-gender]').val() + '&' + $('#geoprofiles-filter select[name=geoprofiles-size]').val() + '&' + $('#geoprofiles-filter select[name=geoprofiles-width]').val() + '&' + $('#geoprofiles-filter select[name=geoprofiles-height]').val() + '&' + escape($('#geoprofiles-filter input[name=geoprofiles-title]').val())).wrapInner('<center></center>');
            //$('#geoprofiles-preview').html('test');
            //alert( $('textarea[name=textlink-code]').val() );
            //alert( $('textarea[name=chatad-code]').val() );
            //alert( $('#chatad-filter select[name=chatad-type]').val() );
            $('textarea[name=chatad-code]').val('<script language="javascript" type="text/javascript" src="' + site + 'affiliates/tools/chatad/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#chatad-filter select[name=chatad-type]').val() + '"><' + '/script>');
            $('#chatad-previewlink').attr('href', '/affiliates/tools/chatadpreview/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#chatad-filter select[name=chatad-type]').val());

            //********
            $('textarea[name=geotextlink-code]').val('<script language="javascript" type="text/javascript" src="http://www.swurve.com/affiliates/tools/geotext/' + afl + '&' + sub_id + '&' + landing_id + '&' + escape($('#geotextlink-filter input[name=geotextlink-title]').val()) + '"><' + '/script>');
            $('#geotextlink-preview').load('/affiliates/tools/geotextpreview/' + afl + '&' + sub_id + '&' + landing_id + '&' + escape($('#geotextlink-filter input[name=geotextlink-title]').val()));

            $('textarea[name=kruzegeotextlink-code]').val('<script language="javascript" type="text/javascript" src="http://www.swurve.com/affiliates/tools/geotext/' + afl + '&' + sub_id + '&' + landing_id + '&' + escape($('#kruzegeotextlink-filter input[name=kruzegeotextlink-title]').val()) + '"><' + '/script>');
            $('#kruzegeotextlink-preview').load('/affiliates/tools/geotextpreview/' + afl + '&' + sub_id + '&' + landing_id + '&' + escape($('#kruzegeotextlink-filter input[name=kruzegeotextlink-title]').val()));
            //********

            //********
            $('textarea[name=textlink-code]').val('<a href="' + landings[landing_id][1] + '?a=' + afl + ((sub_id != 0) ? '&s=' + sub_id : '') + '" target="_blank">' + $('#textlink-filter input[name=textlink-title]').val() + '</a>');
            $('#textlink-preview').html($('textarea[name=textlink-code]').val());

            $('textarea[name=kruzetextlink-code]').val('<a href="' + landings[landing_id][1] + '?a=' + afl + ((sub_id != 0) ? '&s=' + sub_id : '') + '" target="_blank">' + $('#kruzetextlink-filter input[name=kruzetextlink-title]').val() + '</a>');
            $('#kruzetextlink-preview').html($('textarea[name=kruzetextlink-code]').val());

            $('textarea[name=russiandesiretextlink-code]').val('<a href="' + landings[landing_id][1] + '?a=' + afl + ((sub_id != 0) ? '&s=' + sub_id : '') + '" target="_blank">' + $('#russiandesiretextlink-filter input[name=russiandesiretextlink-title]').val() + '</a>');
            $('#russiandesiretextlink-preview').html($('textarea[name=russiandesiretextlink-code]').val());
            //********

            $('textarea[name=xmlpostroll-code]').val('http://www.swurve.com/affiliates/tools/postroll/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#xmlpostroll-filter select[name=xmlpostroll-gender]').val() + '&' + $('#xmlpostroll-filter select[name=xmlpostroll-size]').val() + '&' + escape($('#xmlpostroll-filter input[name=xmlpostroll-title]').val()));
            $('textarea[name=kruzexmlpostroll-code]').val('http://www.kruze.com/affiliates/tools/postroll/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#kruzexmlpostroll-filter select[name=kruzexmlpostroll-gender]').val() + '&' + $('#kruzexmlpostroll-filter select[name=kruzexmlpostroll-size]').val() + '&' + escape($('#kruzexmlpostroll-filter input[name=kruzexmlpostroll-title]').val()));
        }

        $('.ui-tabs-panel:gt(0)').hide();

        $('#broker-filter input').click(function() {
            if ($(this).attr('checked') == true)
            {
                $('.broker-banner[categories*=" ' + $(this).val() + ' "]').show();
            }
            else
            {
                $('.broker-banner[categories*=" ' + $(this).val() + ' "]').hide();
            }
        });

        $('#filter input').click(function() {
            if ($(this).attr('checked') == true)
            {
                $('.banner[categories*=" ' + $(this).val() + ' "]').show();
            }
            else
            {
                $('.banner[categories*=" ' + $(this).val() + ' "]').hide();
            }
        });

        $('#russiandesirefilter input').click(function() {
            if ($(this).attr('checked') == true)
            {
                $('.banner[categories*=" ' + $(this).val() + ' "]').show();
            }
            else
            {
                $('.banner[categories*=" ' + $(this).val() + ' "]').hide();
            }
        });

        $('.ui-tabs-nav li').click(function() {
            $(this).parent().find('li').removeClass('ui-tabs-selected');
            $(this).addClass('ui-tabs-selected');

            $('.ui-tabs-panel').hide();
            $('.tabs-' + $(this).find('a').attr('tab')).show();
        });

        $('.subid').hover(function() {
            $(this).addClass('hover');
        }, function () {
            $(this).removeClass('hover');
        });

        $('.subid').click(function() {
            $('.subid').removeClass('selected');
            $(this).addClass('selected');

            sub_id = $(this).attr('subid');

            $('.ui-tabs-nav li').removeClass('ui-tabs-selected');
            $('.ui-tabs-nav li:eq(1)').addClass('ui-tabs-selected');

            $('.ui-tabs-panel').hide();
            $('.tabs-2').show();

            update_code();

            return false;
        });

        /*
        $('.banner').hover(function() {
            $(this).addClass('hover');
        }, function () {
            $(this).removeClass('hover');
        });

        $('.banner').click(function() {
            if ($(this).hasClass('selected'))
            {
                $(this).removeClass('selected');
                banner_id.splice(banner_id.find($(this).attr('bannerid')), 1);
            }
            else
            {
                $(this).addClass('selected');
                banner_id[banner_id.length] = $(this).attr('bannerid');
            }

            return false;
        });
        */

        $('.siteid').hover(function() {
            $(this).addClass('hover');
        }, function () {
            $(this).removeClass('hover');
        });

        $('.siteid').click(function() {
            $('.siteid').removeClass('selected');
            $(this).addClass('selected');

            site = $(this).attr('siteid');

            if ($(this).attr('site') == 'Russian Desire')
            {
                landing_id = 60;
            }
            else if ($(this).attr('site') == 'kruze')
            {
                landing_id = 50;
            }
            else
            {
                landing_id = 0;
            }

            $('.tabs-3 > div').hide();
            $('.tabs-4 > div').hide();
            $('.' + $(this).attr('site')).show();

            $('.ui-tabs-nav li').removeClass('ui-tabs-selected');
            $('.ui-tabs-nav li:eq(2)').addClass('ui-tabs-selected');

            $('.ui-tabs-panel').hide();
            $('.tabs-3').show();

            update_code();

            return false;
        });

        $('.landingid').hover(function() {
            $(this).addClass('hover');
        }, function () {
            $(this).removeClass('hover');
        });

        $('.landingid').click(function() {
            $('.landingid').removeClass('selected');
            $(this).addClass('selected');

            landing_id = $(this).attr('landingid');

            $('.ui-tabs-nav li').removeClass('ui-tabs-selected');
            $('.ui-tabs-nav li:eq(3)').addClass('ui-tabs-selected');

            $('.ui-tabs-panel').hide();
            $('.tabs-4').show();

            update_code();

            return false;
        });

        $('.creative').change(function() {
            $('.creatives').hide();
            $('#creative-' + $(this).val()).show();
        })

        //**********
        $('#xmlpostroll-filter select').change(function() {
            $('textarea[name=xmlpostroll-code]').val('http://www.swurve.com/affiliates/tools/postroll/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#xmlpostroll-filter select[name=xmlpostroll-gender]').val() + '&' + $('#xmlpostroll-filter select[name=xmlpostroll-size]').val() + '&' + escape($('#xmlpostroll-filter input[name=xmlpostroll-title]').val()));
        });

        $('#xmlpostroll-filter input').keyup(function() {
            $('textarea[name=xmlpostroll-code]').val('http://www.swurve.com/affiliates/tools/postroll/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#xmlpostroll-filter select[name=xmlpostroll-gender]').val() + '&' + $('#xmlpostroll-filter select[name=xmlpostroll-size]').val() + '&' + escape($('#xmlpostroll-filter input[name=xmlpostroll-title]').val()));
        });

        $('#kruzexmlpostroll-filter select').change(function() {
            $('textarea[name=kruzexmlpostroll-code]').val('http://www.kruze.com/affiliates/tools/postroll/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#kruzexmlpostroll-filter select[name=kruzexmlpostroll-gender]').val() + '&' + $('#kruzexmlpostroll-filter select[name=kruzexmlpostroll-size]').val() + '&' + escape($('#kruzexmlpostroll-filter input[name=kruzexmlpostroll-title]').val()));
        });

        $('#kruzexmlpostroll-filter input').keyup(function() {
            $('textarea[name=kruzexmlpostroll-code]').val('http://www.kruze.com/affiliates/tools/postroll/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#kruzexmlpostroll-filter select[name=kruzexmlpostroll-gender]').val() + '&' + $('#kruzexmlpostroll-filter select[name=kruzexmlpostroll-size]').val() + '&' + escape($('#kruzexmlpostroll-filter input[name=kruzexmlpostroll-title]').val()));
        });
        //**********

        //**********
        $('#geoprofiles-filter select, #geoprofiles-filter input').change(function() {
            $('#geoprofiles-preview').html('Generating Preview...');
            $('textarea[name=geoprofiles-code]').val('<script language="javascript" type="text/javascript" src="' + site + 'affiliates/tools/geoprofiles/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#geoprofiles-filter select[name=geoprofiles-gender]').val() + '&' + $('#geoprofiles-filter select[name=geoprofiles-size]').val() + '&' + $('#geoprofiles-filter select[name=geoprofiles-width]').val() + '&' + $('#geoprofiles-filter select[name=geoprofiles-height]').val() + '&' + escape($('#geoprofiles-filter input[name=geoprofiles-title]').val()) + '"><' + '/script>');
            $('#geoprofiles-preview').load('/affiliates/tools/geoprofilespreview/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#geoprofiles-filter select[name=geoprofiles-gender]').val() + '&' + $('#geoprofiles-filter select[name=geoprofiles-size]').val() + '&' + $('#geoprofiles-filter select[name=geoprofiles-width]').val() + '&' + $('#geoprofiles-filter select[name=geoprofiles-height]').val() + '&' + escape($('#geoprofiles-filter input[name=geoprofiles-title]').val())).wrapInner('<center></center>');
            $('#geoprofiles-previewlink').attr('href', '/affiliates/tools/geoprofilespreview/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#geoprofiles-filter select[name=geoprofiles-gender]').val() + '&' + $('#geoprofiles-filter select[name=geoprofiles-size]').val() + '&' + $('#geoprofiles-filter select[name=geoprofiles-width]').val() + '&' + $('#geoprofiles-filter select[name=geoprofiles-height]').val() + '&' + escape($('#geoprofiles-filter input[name=geoprofiles-title]').val()));
        });

        $('#kruzegeoprofiles-filter select, #kruzegeoprofiles-filter input').change(function() {
            //$('#kruzegeoprofiles-preview').html('Generating Preview...');
            $('textarea[name=kruzegeoprofiles-code]').val('<script language="javascript" type="text/javascript" src="http://www.kruze.com/affiliates/tools/geoprofiles/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-gender]').val() + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-size]').val() + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-width]').val() + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-height]').val() + '&' + escape($('#kruzegeoprofiles-filter input[name=kruzegeoprofiles-title]').val()) + '"><' + '/script>');
            //$('#kruzegeoprofiles-preview').html('<center><script language="javascript" type="text/javascript" src="http://www.kruze.com/affiliates/tools/geoprofiles/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-gender]').val() + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-size]').val() + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-width]').val() + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-height]').val() + '&' + escape($('#kruzegeoprofiles-filter input[name=kruzegeoprofiles-title]').val()) + '"><' + '/script></center>');


            $('#kruzegeoprofiles-preview iframe').attr('height', $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-height]').val() * 250);
            $('#kruzegeoprofiles-preview iframe').attr('src', 'http://www.kruze.com/affiliates/tools/geoprofilespreview/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-gender]').val() + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-size]').val() + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-width]').val() + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-height]').val() + '&' + escape($('#kruzegeoprofiles-filter input[name=kruzegeoprofiles-title]').val())).wrapInner('<center></center>');
            $('#kruzegeoprofiles-previewlink').attr('href', 'http://www.kruze.com/affiliates/tools/geoprofilespreview/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-gender]').val() + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-size]').val() + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-width]').val() + '&' + $('#kruzegeoprofiles-filter select[name=kruzegeoprofiles-height]').val() + '&' + escape($('#kruzegeoprofiles-filter input[name=kruzegeoprofiles-title]').val()));
        });
        //**********

        $('#chatad-filter select').change(function() {
            $('textarea[name=chatad-code]').val('<script language="javascript" type="text/javascript" src="' + site + 'affiliates/tools/chatad/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#chatad-filter select[name=chatad-type]').val() + '"><' + '/script>');
            $('#chatad-previewlink').attr('href', '/affiliates/tools/chatadpreview/' + afl + '&' + sub_id + '&' + landing_id + '&' + $('#chatad-filter select[name=chatad-type]').val());
        });

        //**********
        $('#geotextlink-filter input').keyup(function() {
            $('textarea[name=geotextlink-code]').val('<script language="javascript" type="text/javascript" src="http://www.swurve.com/affiliates/tools/geotext/' + afl + '&' + sub_id + '&' + landing_id + '&' + escape($('#geotextlink-filter input[name=geotextlink-title]').val()) + '"><' + '/script>');
            $('#geotextlink-preview').load('/affiliates/tools/geotextpreview/' + afl + '&' + sub_id + '&' + landing_id + '&' + escape($('#geotextlink-filter input[name=geotextlink-title]').val()));
        });

        $('#kruzegeotextlink-filter input').keyup(function() {
            $('textarea[name=kruzegeotextlink-code]').val('<script language="javascript" type="text/javascript" src="http://www.swurve.com/affiliates/tools/geotext/' + afl + '&' + sub_id + '&' + landing_id + '&' + escape($('#kruzegeotextlink-filter input[name=kruzegeotextlink-title]').val()) + '"><' + '/script>');
            $('#kruzegeotextlink-preview').load('/affiliates/tools/geotextpreview/' + afl + '&' + sub_id + '&' + landing_id + '&' + escape($('#kruzegeotextlink-filter input[name=kruzegeotextlink-title]').val()));
        });
        //**********

        //**********
        $('#textlink-filter input').keyup(function() {
            $('textarea[name=textlink-code]').val('<a href="' + landings[landing_id][1] + '?a=' + afl + ((sub_id != 0) ? '&s=' + sub_id : '') + '" target="_blank">' + $('#textlink-filter input[name=textlink-title]').val() + '</a>');
            $('#textlink-preview').html($('textarea[name=textlink-code]').val());
        });

        $('#kruzetextlink-filter input').keyup(function() {
            $('textarea[name=kruzetextlink-code]').val('<a href="' + landings[landing_id][1] + '?a=' + afl + ((sub_id != 0) ? '&s=' + sub_id : '') + '" target="_blank">' + $('#kruzetextlink-filter input[name=kruzetextlink-title]').val() + '</a>');
            $('#kruzetextlink-preview').html($('textarea[name=kruzetextlink-code]').val());
        });

        $('#russiandesiretextlink-filter input').keyup(function() {
            $('textarea[name=russiandesiretextlink-code]').val('<a href="' + landings[landing_id][1] + '?a=' + afl + ((sub_id != 0) ? '&s=' + sub_id : '') + '" target="_blank">' + $('#russiandesiretextlink-filter input[name=russiandesiretextlink-title]').val() + '</a>');
            $('#russiandesiretextlink-preview').html($('textarea[name=russiandesiretextlink-code]').val());
        });
        //**********
    });
</script>

<h1>Promo Tools</h1>

<div class="ui-tabs">
    <ul class="ui-tabs-nav">
        <li class="ui-tabs-selected"><?= HTML::anchor('#', '1. Campaigns/Sub ID', array('tab' => '1')); ?></li>
        <li><?= HTML::anchor('#', '2. Site', array('tab' => '2')); ?></li>
        <li><?= HTML::anchor('#', '3. Landing Page', array('tab' => '3')); ?></li>
        <li><?= HTML::anchor('#', '4. Creatives', array('tab' => '4')); ?></li>
    </ul>

    <div class="tabs-1 ui-tabs-panel">
        <h3>Select a Campaign/Sub ID</h3>
        <p>Custom Ad Campaign groups and Sub ID tracking allow you to manage multiple sources of traffic more effectively and efficiently. By taking advantage of these advanced options you can optimise your marketing efforts to ensure peak performance.</p>
        <p>Campaigns are ideal for breaking out and identifying individual traffic sources and paid advertising initiatives. Campaign Groups allow you to manage marketing performance of incoming traffic from individual web properties, PPC campaigns, network ad buys or other broad marketing initiatives.</p>
        <p>Sub IDs are ideal for micro managing your marketing materials. For each Campaign you can create single or multiple Sub IDs to track different tools or banner ads to see what converts better with traffic originating from a particular source. With Sub ID tracking you can conduct your own a/b testing to optimise text, link and banner placement, as well as monitor individual creative, keyword, and landing page performance.</p>
        <p>A Custom Campaign isn't necessary to create and monitor Sub IDs. You can track individual marketing efforts by Sub IDs alone if you choose. Campaigns add an additional level of convenience by allowing you to view stats for a range of Sub IDs, but grouping Sub IDs into Campaigns is not necessary.</p>

        <?php $count = 0; $arrCampaigns[''] = 'Select An Optional Campaign To Assign This Sub ID'; foreach($campaigns as $campaign): ?>
        <div style="margin-top: 10px; background-color: #ECECEC; padding: 4px; height: 19px; font-size: 10px; border-top: 1px solid #95999C; border-bottom: 1px solid #95999C;"><div style="float: left;"><strong>Campaign ID #<?= $campaign->id; ?></strong> | <?= $campaign->description; ?></div></div>
        <?php $subcount = 0; foreach($campaign->affiliate_subs->find_all() as $sub): ?>
        <div class="subid" subid="<?= $sub->id; ?>" style="background-color: #fafafa; padding: 4px; height: 19px; font-size: 10px; padding-left: 50px; border-bottom: 1px solid #95999C;"><div style="float: left;"><strong>Sub ID #<?= $sub->id; ?></strong> | <?= $sub->description; ?> </div><div style="float: right; margin-right: 5px; font-weight: bold;"><?= HTML::anchor('#', 'select'); ?></div></div>
        <?php endforeach; ?>
        <?php $arrCampaigns[$campaign->id] = '#' . $campaign->id . ' | ' . $campaign->description; endforeach; ?>
        <?php $count = 0; foreach($subs as $sub): ?>
        <div class="subid" subid="<?= $sub->id; ?>" style="margin-top: 10px; background-color: #fafafa; padding: 4px; height: 19px; font-size: 10px; <?php $count++; if ($count == 1): ?> border-top: 1px solid #95999C; <?php endif; ?>border-bottom: 1px solid #95999C;"><div style="float: left;"><strong>Sub ID #<?= $sub->id; ?></strong> | <?= $sub->description; ?> </div><div style="float: right; margin-right: 5px; font-weight: bold;"><?= HTML::anchor('#', 'select'); ?></div></div>
        <?php endforeach; ?>

        <div class="subid" subid="0" style="margin-top: 10px; background-color: #fafafa; padding: 4px; height: 19px; font-size: 10px; border-top: 1px solid #95999C; border-bottom: 1px solid #95999C;"><div style="float: left;"><strong>Continue With No Sub ID</strong></div><div style="float: right; margin-right: 5px; font-weight: bold;"><?= HTML::anchor('#', 'select'); ?></div></div><br /><br />

        <h4>Create New Campaign</h4><br />
        <div style="background-color: #F2F5F8; border: 1px dashed #95999C; padding: 2px;">
            <?= Form::open('affiliates/campaigns'); ?><?= Form::hidden('action', 'newcampaign'); ?><span><?= Form::label('description', 'Campaign Description:') ?> <?= Form::input('description', NULL, array('maxlength' => '100', 'style' => 'width: 540px; vertical-align: middle;')); ?> <?= Form::submit('submit', 'Create New Campaign', array('style' => 'vertical-align: middle; width: 154px;')) ?></span><?= Form::close(); ?>
        </div><br />

        <br />

        <h4>Create New Sub ID's</h4><br />
        <div style="background-color: #F2F5F8; border: 1px dashed #95999C; padding: 2px;">
            <?= Form::open('affiliates/campaigns'); ?><?= Form::hidden('action', 'newsub'); ?><span><?= Form::label('description', 'Sub ID Description:') ?> <?= Form::input('description', NULL, array('maxlength' => '100', 'style' => 'width: 579px; vertical-align: middle;')); ?> <?= Form::submit('submit', 'Create New Sub ID', array('style' => 'vertical-align: middle; width: 135px;')) ?><br />
            Assign to Campaign: <?= Form::select('campaign_id', $arrCampaigns, NULL, array('style' => 'width: 577px;')); ?>
            </span><?= Form::close(); ?>
        </div>
    </div>


    <div class="tabs-2 ui-tabs-panel">
        <h3>Select a Site</h3>

        <div class="siteid selected" site="swurve" siteid="http://www.swurve.com/" style="margin: 1px; margin-top: 10px; background-color: #fafafa; padding: 3px; font-size: 10px; border-top: 1px solid #95999C; border-bottom: 1px solid #95999C; width: 430px; float: left; text-align: center; background: URL('http://www.swurve.com/assets/img/headderlogo.png');"><div style="height: 120px;"></div><br /><br /><strong>Site ID: http://www.swurve.com/</strong> | Swurve - <?= HTML::anchor('#', 'select'); ?></div>
        <div class="siteid" site="kruze" siteid="http://www.kruze.com/" style="margin: 1px; margin-top: 10px; background-color: #fafafa; padding: 3px; font-size: 10px; border-top: 1px solid #95999C; border-bottom: 1px solid #95999C; width: 430px; float: left; text-align: center;"><img src="http://www.kruze.com/assets/img/headderlogo.png" /><br /><br /><strong>Site ID: http://www.kruze.com/</strong> | Kruze - <?= HTML::anchor('#', 'select'); ?></div>
        <div class="siteid" site="russiandesire" siteid="http://www.russiandesire.com/" style="margin: 1px; margin-top: 10px; background-color: #fafafa; padding: 3px; font-size: 10px; border-top: 1px solid #95999C; border-bottom: 1px solid #95999C; width: 430px; float: left; text-align: center;"><img src="http://www.russiandesire.com/assets/img/logo.png" width="400" /><br /><br /><strong>Site ID: http://www.russiandesire.com/</strong> | Russian Desire - <?= HTML::anchor('#', 'select'); ?></div>

        <br />
        <div class="clear"></div>
    </div>

    <div class="tabs-3 ui-tabs-panel swurve">
        <div class="swurve">
            <h3>Select a Landing Page</h3>

            <?php
                foreach ($landings as $landingid => $landinginfo)
                {
                    if ($landingid == 50) continue;

                    foreach ($landinginfo as $name => $url)
                    {
            ?>
            <div class="landingid <?= ($landingid == 0) ? 'selected' : ''; ?>" landingid="<?= $landingid; ?>" style="margin: 1px; margin-top: 10px; background-color: #fafafa; padding: 3px; font-size: 10px; border-top: 1px solid #95999C; border-bottom: 1px solid #95999C; width: 430px; float: left; text-align: center;"><?= HTML::image('assets/img/landing' . $landingid . '.png'); ?><br /><br /><strong>Landing ID #<?= $landingid + 1; ?></strong> | <?= $name; ?> - <?= HTML::anchor('#', 'select'); ?></div>
            <?php
                    }
                }
            ?>
            <br />
            <div class="clear"></div>
        </div>

        <div class="kruze" style="display: none;">
            <h3>Select a Landing Page</h3>

            <?php
                foreach ($landings as $landingid => $landinginfo)
                {
                    if ($landingid != 50) continue;

                    foreach ($landinginfo as $name => $url)
                    {
            ?>
            <div class="landingid <?= ($landingid == 0) ? 'selected' : ''; ?>" landingid="<?= $landingid; ?>" style="margin: 1px; margin-top: 10px; background-color: #fafafa; padding: 3px; font-size: 10px; border-top: 1px solid #95999C; border-bottom: 1px solid #95999C; width: 430px; float: left; text-align: center;"><?= HTML::image('assets/img/landing' . $landingid . '.png'); ?><br /><br /><strong>Landing ID #<?= $landingid + 1; ?></strong> | <?= $name; ?> - <?= HTML::anchor('#', 'select'); ?></div>
            <?php
                    }
                }
            ?>
            <br />
            <div class="clear"></div>
        </div>


        <div class="russiandesire" style="display: none;">
            <h3>Select a Landing Page</h3>

            <?php
                foreach ($landings as $landingid => $landinginfo)
                {
                    if ($landingid != 60) continue;

                    foreach ($landinginfo as $name => $url)
                    {
            ?>
            <div class="landingid <?= ($landingid == 0) ? 'selected' : ''; ?>" landingid="<?= $landingid; ?>" style="margin: 1px; margin-top: 10px; background-color: #fafafa; padding: 3px; font-size: 10px; border-top: 1px solid #95999C; border-bottom: 1px solid #95999C; width: 430px; float: left; text-align: center;"><?= HTML::image('assets/img/landing' . $landingid . '.png'); ?><br /><br /><strong>Landing ID #<?= $landingid + 1; ?></strong> | <?= $name; ?> - <?= HTML::anchor('#', 'select'); ?></div>
            <?php
                    }
                }
            ?>
            <br />
            <div class="clear"></div>
        </div>
    </div>

    <div class="tabs-4 ui-tabs-panel">
        <div class="swurve">
            <h3>Select Creatives</h3>
            <p><strong>Type of Creative:</strong> <?= Form::select('creative', array('' => 'Select', 'broker' => 'Broker Banners', 'banners' => 'Banners', 'geoprofiles' => 'Geo Profiles', 'chatad' => 'Chat Ad', 'geotextlink' => 'Geo Text Link', 'textlink' => 'Text Link', 'xmlpostroll' => 'Media Player Postroll'), NULL, array('style' => 'vertical-align: middle;', 'class' => 'creative')); ?></p>

            <div id="creative-xmlpostroll" class="creatives hide">
                <div id="xmlpostroll-filter">
                    <div style="float: left; width: 110px; text-align: center;">
                        <strong>Gender</strong><br />
                        <?= Form::select('xmlpostroll-gender', array('Male' => 'Men', 'Female' => 'Women', 'Both' => 'Both'), 'Female') ; ?><br />
                    </div>

                    <div style="float: left; width: 110px; text-align: center;">
                        <strong>Photo Size</strong><br />
                        <?= Form::select('xmlpostroll-size', array('100' => '100x100', '150' => '150x150'), '150') ; ?><br />
                    </div>

                    <div style="float: left; width: 440px; padding-left: 20px;">
                        <strong>Header</strong><br />
                        <?= Form::input('xmlpostroll-title', 'HookUp with Hot Local Girls', array('style' => 'width: 100%;')); ?>
                    </div>
                </div>
                <div class="clear"></div><br />

                <strong>Media Player Postroll URL</strong><br />
                <div id="xmlpostroll-code">
                <?= Form::textarea('xmlpostroll-code', URL::base(TRUE, 'http') . 'affiliates/tools/postroll/' . Core::$affiliate . '&0&0&Female&150&HookUp%20with%20Hot%20Local%20Girls', array('style' => 'width: 870px; height: 50px;', 'class' => 'code')); ?>
                </div><br /><br />
            </div>

            <div id="creative-textlink" class="creatives hide">
                <div id="textlink-filter">
                    <strong>Title</strong><br />
                    <?= Form::input('textlink-title', 'Come get your Swurve on!', array('style' => 'width: 100%;')); ?>
                </div>
                <div class="clear"></div><br />

                <strong>Code</strong><br />
                <div id="textlink-code">
                <?= Form::textarea('textlink-code', HTML::anchor('/?a=' . Core::$affiliate, 'Come get your Swurve on!', array('target' => '_blank'), 'http'), array('style' => 'width: 870px; height: 50px;', 'class' => 'code')); ?>
                </div><br />

                <strong>Preview</strong><br />
                <div id="textlink-preview">
                    <?= HTML::anchor('/?a=' . Core::$affiliate, 'Come get your Swurve on!', array('target' => '_blank'), 'http'); ?>
                </div><br />
                <div class="clear"></div>
            </div>

            <div id="creative-geotextlink" class="creatives hide">
                <div id="geotextlink-filter">
                    <strong>Title</strong> <i style="font-size: 10px; vertical-align: middle; margin-left: 30px;">(Note: |city| will be replaced with the users approximate city)</i><br />
                    <?= Form::input('geotextlink-title', 'Come get your Swurve on in |city|!', array('style' => 'width: 100%;')); ?>
                </div>
                <div class="clear"></div><br />

                <strong>Code</strong><br />
                <div id="geotextlink-code">
                <?= Form::textarea('geotextlink-code', '<script language="javascript" type="text/javascript" src="' . URL::base(TRUE, 'http') . 'affiliates/tools/geotext/' . Core::$affiliate . '&0&0&Come%20get%20your%20Swurve%20on%20in%20%7Ccity%7C%21"></script>', array('style' => 'width: 870px; height: 50px;', 'class' => 'code')); ?>
                </div><br />

                <strong>Preview</strong><br />
                <div id="geotextlink-preview">
                    <script language="javascript" type="text/javascript" src="/affiliates/tools/geotext/<?= Core::$affiliate; ?>&0&0&Come%20get%20your%20Swurve%20on%20in%20%7Ccity%7C%21"></script>
                </div><br />
                <div class="clear"></div>
            </div>

            <div id="creative-chatad" class="creatives hide">
                <div id="chatad-filter">
                    <strong>Type</strong><br />
                    <?= Form::select('chatad-type', array('Static' => 'Static', 'Flash' => 'Flash'), 'Static') ; ?><br />
                </div>
                <div class="clear"></div><br />

                <strong>Code</strong><br />
                <div id="chatad-code">
                <?= Form::textarea('chatad-code', '<script language="javascript" type="text/javascript" src="' . URL::base(TRUE, 'http') . 'affiliates/tools/chatad/' . Core::$affiliate . '&0&0&Static"></script>', array('style' => 'width: 870px; height: 50px;', 'class' => 'code')); ?>
                </div><br />

                <strong>Preview</strong><br />
                <div id="chatad-preview">
                    <?= HTML::image('assets/img/affiliates/chatad/chatad.png', array('align' => 'right', 'style' => ' float: right; margin-left: 15px; margin-bottom: 5px;')); ?>
                    To see a preview of the chat ad tool in action, <?= HTML::anchor('affiliates/tools/chatadpreview/1&0&0&Static', 'click here', array('target' => '_blank', 'id' => 'chatad-previewlink')); ?>.  In the bottom right corner of that page you will see the chat ad overlay in action with your selected settings above.
                </div><br />
                <div class="clear"></div>
            </div>

            <div id="creative-geoprofiles" class="creatives hide">
                <div id="geoprofiles-filter">
                    <div style="float: left; width: 110px; text-align: center;">
                        <strong>Gender</strong><br />
                        <?= Form::select('geoprofiles-gender', array('Male' => 'Men', 'Female' => 'Women', 'Both' => 'Both'), 'Both') ; ?><br />
                    </div>

                    <div style="float: left; width: 110px; text-align: center;">
                        <strong>Photo Size</strong><br />
                        <?= Form::select('geoprofiles-size', array('100' => '100x100', '150' => '150x150'), '150') ; ?><br />
                    </div>

                    <div style="float: left; width: 100px; text-align: center;">
                        <strong>Columns</strong><br />
                        <?= Form::select('geoprofiles-width', array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8'), '5') ; ?><br />
                    </div>

                    <div style="float: left; width: 70px; text-align: center;">
                        <strong>Rows</strong><br />
                        <?= Form::select('geoprofiles-height', array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8'), '1') ; ?><br />
                    </div>

                    <div style="float: left; width: 440px; padding-left: 20px;">
                        <strong>Title</strong> <i style="font-size: 10px; vertical-align: middle; margin-left: 30px;">(Note: |city| will be replaced with the users approximate city)</i><br />
                        <?= Form::input('geoprofiles-title', 'Sexy Singles Near |city|', array('style' => 'width: 100%;')); ?>
                    </div>
                </div>
                <div class="clear"></div><br />

                <strong>Code</strong><br />
                <div id="geoprofiles-code">
                <?= Form::textarea('geoprofiles-code', '<script language="javascript" type="text/javascript" src="' . URL::base(TRUE, 'http') . 'affiliates/tools/geoprofiles/' . Core::$affiliate . '&0&0&Both&150&5&1&Sexy%20Singles%20Near%20%7Ccity%7C"></script>', array('style' => 'width: 870px; height: 50px;', 'class' => 'code')); ?>
                </div><br /><br />

                <strong>Preview</strong> <i style="font-size: 10px; vertical-align: middle; margin-left: 30px;">(Note: The preview below is styled, <?= HTML::anchor('affiliates/tools/geoprofilespreview/1&0&0&Both&150&5&1&Sexy%20Singles%20Near%20%7Ccity%7C', 'click here', array('target' => '_blank', 'id' => 'geoprofiles-previewlink')); ?> to see the non-styled version, see the documention below on the class markups to stylize your own)</i><br /><br />
                <div id="geoprofiles-preview" style="text-align: center;">
                    <center><script language="javascript" type="text/javascript" src="/affiliates/tools/geoprofiles/<?= Core::$affiliate; ?>&0&0&Both&150&5&1&Sexy%20Singles%20Near%20%7Ccity%7C"></script></center>
                </div><br />

                <strong>Style Documentation</strong><br />
                <p>This is example markup generated by the geoprofile tool, use the class names below to format the particular sections using CSS.  Do not use the code below to use the geoprofiles tool, use the code above the preview.</p>
                <code>
                <pre style="font-size: 12px;">
            &lt;table class="swurve-geoprofiles">
                &lt;tr>
                    &lt;td>
                        &lt;div class="swurve-geotext">Sexy Singles Near &lt;span class="swurve-geocity">|city|&lt;/span>&lt;/div>
                        &lt;table class class="swurve-profiles">
                            &lt;tr>
                                &lt;td class="swurve-profile>
                                    &lt;img src="[profile image]">
                                    &lt;div class="swurve-profile-name>[profile username]&lt;/div>
                                    &lt;div class="swurve-profile-details">[profile birthdate / gender / orientation]&lt;/div>
                                &lt;/td>
                                &lt;td class="swurve-profile>
                                    &lt;img src="[profile image]">
                                    &lt;div class="swurve-profile-name>[profile username]&lt;/div>
                                    &lt;div class="swurve-profile-details">[profile birthdate / gender / orientation]&lt;/div>
                                &lt;/td>
                                &lt;td class="swurve-profile>
                                    &lt;img src="[profile image]">
                                    &lt;div class="swurve-profile-name>[profile username]&lt;/div>
                                    &lt;div class="swurve-profile-details">[profile birthdate / gender / orientation]&lt;/div>
                                &lt;/td>
                            &lt;tr>
                        &lt;/table>
                    &lt;/td>
                &lt;/tr>
            &lt;/table>
                </pre>
                </code>
            </div>

            <div id="creative-banners" class="creatives hide">
                <div id="filter">
                    <div style="float: left; width: 140px;">
                        <strong>Type of Banner</strong><br />
                        <?= Form::checkbox('type[]', 1, TRUE); ?> Static<br />
                        <?= Form::checkbox('type[]', 2, TRUE); ?> Animated<br />
                        <?= Form::checkbox('type[]', 3, TRUE); ?> Geo Targeted<br />
                    </div>

                    <div style="float: left; width: 130px;">
                        <strong>Orientation of Banner</strong><br />
                        <?= Form::checkbox('orientation[]', 4, TRUE); ?> Horizontal<br />
                        <?= Form::checkbox('orientation[]', 5, TRUE); ?> Vertical<br />
                    </div>

                    <!--div style="float: left; width: 120px;">
                        <strong>Nudity</strong><br />
                        ?= Form::checkbox('nudity[]', 6, TRUE); ?> Nudity<br />
                        ?= Form::checkbox('nudity[]', 7, TRUE); ?> No Nudity<br />
                    </div-->

                    <div style="float: left; width: 120px;">
                        <strong>Targeted To</strong><br />
                        <?= Form::checkbox('target[]', 19, TRUE); ?> Men<br />
                        <?= Form::checkbox('target[]', 20, TRUE); ?> Women<br />
                        <?= Form::checkbox('target[]', 21, TRUE); ?> Both<br />
                    </div>

                    <div style="float: left; width: 455px;">
                        <strong>Size of Banner</strong><br />
                        <div style="float: left; width: 100px;"><?= Form::checkbox('size[]', 8, TRUE); ?> 468x60</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('size[]', 9, TRUE); ?> 728x90</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('size[]', 10, TRUE); ?> 120x600</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('size[]', 11, TRUE); ?> 160x600</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('size[]', 12, TRUE); ?> 300x250</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('size[]', 13, TRUE); ?> 140x250</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('size[]', 14, TRUE); ?> 150x150</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('size[]', 15, TRUE); ?> 125x125</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('size[]', 16, TRUE); ?> 120x60</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('size[]', 17, TRUE); ?> Other</div>
                    </div>
                </div>
                <div class="clear"></div><br />
                <div id="banner-container">
                    <?php foreach($banners as $banner): ?>
                    <div class="banner" bannerid="<?= $banner->id; ?>" categories=" <?= implode(' ', array_keys($banner->affiliate_categories->find_all()->as_array('id', 'name'))); ?> ">
                    <?= HTML::image(URL::site($banner->image_path, 'http')); ?> <br />
                    Banner ID #<?= $banner->id; ?>: <?= implode(' - ', array_values($banner->affiliate_categories->find_all()->as_array('id', 'name'))); ?><br />
                    <?= Form::textarea('code', HTML::anchor('/?a=' . Core::$affiliate, HTML::image(URL::site($banner->image_path, 'http'), array('border' => '0')), array('target' => '_blank'), 'http'), array('style' => 'width: 600px; height: 65px;', 'class' => 'code')); ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div id="creative-broker" class="creatives hide">
                <div id="broker-filter">
                    <div style="float: left; width: 140px;">
                        <strong>Type of Banner</strong><br />
                        <?= Form::checkbox('brokertype[]', 1, TRUE); ?> Static<br />
                        <?= Form::checkbox('brokertype[]', 2, TRUE); ?> Animated<br />
                        <?= Form::checkbox('brokertype[]', 3, TRUE); ?> Geo Targeted<br />
                    </div>

                    <div style="float: left; width: 130px;">
                        <strong>Orientation of Banner</strong><br />
                        <?= Form::checkbox('brokerorientation[]', 4, TRUE); ?> Horizontal<br />
                        <?= Form::checkbox('brokerorientation[]', 5, TRUE); ?> Vertical<br />
                    </div>

                    <!--div style="float: left; width: 120px;">
                        <strong>Nudity</strong><br />
                        ?= Form::checkbox('brokernudity[]', 6, TRUE); ?> Nudity<br />
                        ?= Form::checkbox('brokernudity[]', 7, TRUE); ?> No Nudity<br />
                    </div-->

                    <div style="float: left; width: 120px;">
                        <strong>Targeted To</strong><br />
                        <?= Form::checkbox('brokertarget[]', 19, TRUE); ?> Men<br />
                        <?= Form::checkbox('brokertarget[]', 20, TRUE); ?> Women<br />
                        <?= Form::checkbox('brokertarget[]', 21, TRUE); ?> Both<br />
                    </div>

                    <div style="float: left; width: 455px;">
                        <strong>Size of Banner</strong><br />
                        <div style="float: left; width: 100px;"><?= Form::checkbox('brokersize[]', 8, TRUE); ?> 468x60</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('brokersize[]', 9, TRUE); ?> 728x90</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('brokersize[]', 10, TRUE); ?> 120x600</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('brokersize[]', 11, TRUE); ?> 160x600</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('brokersize[]', 12, TRUE); ?> 300x250</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('brokersize[]', 13, TRUE); ?> 140x250</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('brokersize[]', 14, TRUE); ?> 150x150</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('brokersize[]', 15, TRUE); ?> 125x125</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('brokersize[]', 16, TRUE); ?> 120x60</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('brokersize[]', 17, TRUE); ?> Other</div>
                    </div>
                </div>
                <div class="clear"></div><br />
                <div id="broker-banner-container">
                    <?php foreach($brokerbanners as $banner): ?>
                    <div class="broker-banner" bannerid="<?= $banner->id; ?>" categories=" <?= implode(' ', array_keys($banner->affiliate_categories->find_all()->as_array('id', 'name'))); ?> ">
                    <?= HTML::image(URL::site($banner->image_path, 'http')); ?> <br />
                    Banner ID #<?= $banner->id; ?>: <?= implode(' - ', array_values($banner->affiliate_categories->find_all()->as_array('id', 'name'))); ?><br />
                    <?= Form::textarea('brokercode', HTML::anchor('affiliates/?r=' . Core::$affiliate, HTML::image(URL::site($banner->image_path, 'http'), array('border' => '0')), array('target' => '_blank'), 'http'), array('style' => 'width: 600px; height: 65px;', 'class' => 'code')); ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="kruze" style="display: none;">
            <h3>Select Creatives</h3>
            <p><strong>Type of Creative:</strong> <?= Form::select('creative', array('' => 'Select', 'kruzegeoprofiles' => 'Geo Profiles', 'kruzegeotextlink' => 'Geo Text Link', 'kruzetextlink' => 'Text Link', 'kruzexmlpostroll' => 'Media Player Postroll'), NULL, array('style' => 'vertical-align: middle;', 'class' => 'creative')); ?></p>

            <div id="creative-kruzexmlpostroll" class="creatives hide">
                <div id="kruzexmlpostroll-filter">
                    <div style="float: left; width: 110px; text-align: center;">
                        <strong>Gender</strong><br />
                        <?= Form::select('kruzexmlpostroll-gender', array('Male' => 'Men'), 'Male') ; ?><br />
                    </div>

                    <div style="float: left; width: 110px; text-align: center;">
                        <strong>Photo Size</strong><br />
                        <?= Form::select('kruzexmlpostroll-size', array('100' => '100x100', '150' => '150x150'), '150') ; ?><br />
                    </div>

                    <div style="float: left; width: 440px; padding-left: 20px;">
                        <strong>Header</strong><br />
                        <?= Form::input('kruzexmlpostroll-title', 'HookUp with Sexy Local Men', array('style' => 'width: 100%;')); ?>
                    </div>
                </div>
                <div class="clear"></div><br />

                <strong>Media Player Postroll URL</strong><br />
                <div id="kruzexmlpostroll-code">
                <?= Form::textarea('kruzexmlpostroll-code', 'http://www.kruze.com/affiliates/tools/postroll/' . Core::$affiliate . '&0&0&Male&150&HookUp%20with%20Hot%20Local%20Girls', array('style' => 'width: 870px; height: 50px;', 'class' => 'code')); ?>
                </div><br /><br />
            </div>

            <div id="creative-kruzetextlink" class="creatives hide">
                <div id="kruzetextlink-filter">
                    <strong>Title</strong><br />
                    <?= Form::input('kruzetextlink-title', 'Come get your Kruze on!', array('style' => 'width: 100%;')); ?>
                </div>
                <div class="clear"></div><br />

                <strong>Code</strong><br />
                <div id="kruzetextlink-code">
                <?= Form::textarea('kruzetextlink-code', HTML::anchor('http://www.kruze.com/?a=' . Core::$affiliate, 'Come get your Kruze on!', array('target' => '_blank'), 'http'), array('style' => 'width: 870px; height: 50px;', 'class' => 'code')); ?>
                </div><br />

                <strong>Preview</strong><br />
                <div id="kruzetextlink-preview">
                    <?= HTML::anchor('http://www.kruze.com/?a=' . Core::$affiliate, 'Come get your Kruze on!', array('target' => '_blank'), 'http'); ?>
                </div><br />
                <div class="clear"></div>
            </div>

            <div id="creative-kruzegeotextlink" class="creatives hide">
                <div id="kruzegeotextlink-filter">
                    <strong>Title</strong> <i style="font-size: 10px; vertical-align: middle; margin-left: 30px;">(Note: |city| will be replaced with the users approximate city)</i><br />
                    <?= Form::input('kruzegeotextlink-title', 'Come get your Kruze on in |city|!', array('style' => 'width: 100%;')); ?>
                </div>
                <div class="clear"></div><br />

                <strong>Code</strong><br />
                <div id="kruzegeotextlink-code">
                <?= Form::textarea('kruzegeotextlink-code', '<script language="javascript" type="text/javascript" src="' . URL::base(TRUE, 'http') . 'affiliates/tools/geotext/' . Core::$affiliate . '&0&0&Come%20get%20your%20Kruze%20on%20in%20%7Ccity%7C%21"></script>', array('style' => 'width: 870px; height: 50px;', 'class' => 'code')); ?>
                </div><br />

                <strong>Preview</strong><br />
                <div id="kruzegeotextlink-preview">
                    <script language="javascript" type="text/javascript" src="/affiliates/tools/geotext/<?= Core::$affiliate; ?>&0&0&Come%20get%20your%20Kruze%20on%20in%20%7Ccity%7C%21"></script>
                </div><br />
                <div class="clear"></div>
            </div>

            <div id="creative-kruzegeoprofiles" class="creatives hide">
                <div id="kruzegeoprofiles-filter">
                    <div style="float: left; width: 110px; text-align: center;">
                        <strong>Gender</strong><br />
                        <?= Form::select('kruzegeoprofiles-gender', array('Male' => 'Men'), 'Male') ; ?><br />
                    </div>

                    <div style="float: left; width: 110px; text-align: center;">
                        <strong>Photo Size</strong><br />
                        <?= Form::select('kruzegeoprofiles-size', array('100' => '100x100', '150' => '150x150'), '150') ; ?><br />
                    </div>

                    <div style="float: left; width: 100px; text-align: center;">
                        <strong>Columns</strong><br />
                        <?= Form::select('kruzegeoprofiles-width', array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8'), '5') ; ?><br />
                    </div>

                    <div style="float: left; width: 70px; text-align: center;">
                        <strong>Rows</strong><br />
                        <?= Form::select('kruzegeoprofiles-height', array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8'), '1') ; ?><br />
                    </div>

                    <div style="float: left; width: 440px; padding-left: 20px;">
                        <strong>Title</strong> <i style="font-size: 10px; vertical-align: middle; margin-left: 30px;">(Note: |city| will be replaced with the users approximate city)</i><br />
                        <?= Form::input('kruzegeoprofiles-title', 'Sexy Men Near |city|', array('style' => 'width: 100%;')); ?>
                    </div>
                </div>
                <div class="clear"></div><br />

                <strong>Code</strong><br />
                <div id="kruzegeoprofiles-code">
                <?= Form::textarea('kruzegeoprofiles-code', '<script language="javascript" type="text/javascript" src="http://www.kruze.com/affiliates/tools/geoprofiles/' . Core::$affiliate . '&0&0&Male&150&5&1&Sexy%20Men%20Near%20%7Ccity%7C"></script>', array('style' => 'width: 870px; height: 50px;', 'class' => 'code')); ?>
                </div><br /><br />

                <strong>Preview</strong> <i style="font-size: 10px; vertical-align: middle; margin-left: 30px;">(Note: The preview below is styled, <?= HTML::anchor('http://www.kruze.com/affiliates/tools/geoprofilespreview/1&0&0&Male&150&5&1&Sexy%20Men%20Near%20%7Ccity%7C', 'click here', array('target' => '_blank', 'id' => 'geoprofiles-previewlink')); ?> to see the non-styled version, see the documention below on the class markups to stylize your own)</i><br /><br />
                <div id="kruzegeoprofiles-preview" style="text-align: center;">
                    <center><iframe border="0" width="100%" height="250" src="http://www.kruze.com/affiliates/tools/geoprofilespreview/<?= Core::$affiliate; ?>&0&0&Male&150&5&1&Sexy%20Men%20Near%20%7Ccity%7C"></iframe></center>
                </div><br />

                <strong>Style Documentation</strong><br />
                <p>This is example markup generated by the geoprofile tool, use the class names below to format the particular sections using CSS.  Do not use the code below to use the geoprofiles tool, use the code above the preview.</p>
                <code>
                <pre style="font-size: 12px;">
            &lt;table class="swurve-geoprofiles">
                &lt;tr>
                    &lt;td>
                        &lt;div class="swurve-geotext">Sexy Men Near &lt;span class="swurve-geocity">|city|&lt;/span>&lt;/div>
                        &lt;table class class="swurve-profiles">
                            &lt;tr>
                                &lt;td class="swurve-profile>
                                    &lt;img src="[profile image]">
                                    &lt;div class="swurve-profile-name>[profile username]&lt;/div>
                                    &lt;div class="swurve-profile-details">[profile birthdate / gender / orientation]&lt;/div>
                                &lt;/td>
                                &lt;td class="swurve-profile>
                                    &lt;img src="[profile image]">
                                    &lt;div class="swurve-profile-name>[profile username]&lt;/div>
                                    &lt;div class="swurve-profile-details">[profile birthdate / gender / orientation]&lt;/div>
                                &lt;/td>
                                &lt;td class="swurve-profile>
                                    &lt;img src="[profile image]">
                                    &lt;div class="swurve-profile-name>[profile username]&lt;/div>
                                    &lt;div class="swurve-profile-details">[profile birthdate / gender / orientation]&lt;/div>
                                &lt;/td>
                            &lt;tr>
                        &lt;/table>
                    &lt;/td>
                &lt;/tr>
            &lt;/table>
                </pre>
                </code>
            </div>
        </div>

        <div class="russiandesire" style="display: none;">
            <h3>Select Creatives</h3>
            <p><strong>Type of Creative:</strong> <?= Form::select('creative', array('' => 'Select', 'russiandesirebanners' => 'Banners', 'russiandesiretextlink' => 'Text Link'), NULL, array('style' => 'vertical-align: middle;', 'class' => 'creative')); ?></p>

            <div id="creative-russiandesirebanners" class="creatives hide">
                <div id="russiandesirefilter">
                    <div style="float: left; width: 140px;">
                        <strong>Type of Banner</strong><br />
                        <?= Form::checkbox('type[]', 1, TRUE); ?> Static<br />
                        <?= Form::checkbox('type[]', 2, TRUE); ?> Animated<br />
                        <?= Form::checkbox('type[]', 3, TRUE); ?> Geo Targeted<br />
                    </div>

                    <div style="float: left; width: 130px;">
                        <strong>Orientation of Banner</strong><br />
                        <?= Form::checkbox('orientation[]', 4, TRUE); ?> Horizontal<br />
                        <?= Form::checkbox('orientation[]', 5, TRUE); ?> Vertical<br />
                    </div>

                    <!--div style="float: left; width: 120px;">
                        <strong>Nudity</strong><br />
                        ?= Form::checkbox('nudity[]', 6, TRUE); ?> Nudity<br />
                        ?= Form::checkbox('nudity[]', 7, TRUE); ?> No Nudity<br />
                    </div-->

                    <div style="float: left; width: 120px;">
                        <strong>Targeted To</strong><br />
                        <?= Form::checkbox('target[]', 19, TRUE); ?> Men<br />
                        <?= Form::checkbox('target[]', 20, TRUE); ?> Women<br />
                        <?= Form::checkbox('target[]', 21, TRUE); ?> Both<br />
                    </div>

                    <div style="float: left; width: 455px;">
                        <strong>Size of Banner</strong><br />
                        <div style="float: left; width: 100px;"><?= Form::checkbox('size[]', 8, TRUE); ?> 468x60</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('size[]', 9, TRUE); ?> 728x90</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('size[]', 10, TRUE); ?> 120x600</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('size[]', 11, TRUE); ?> 160x600</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('size[]', 12, TRUE); ?> 300x250</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('size[]', 13, TRUE); ?> 140x250</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('size[]', 14, TRUE); ?> 150x150</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('size[]', 15, TRUE); ?> 125x125</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('size[]', 16, TRUE); ?> 120x60</div>
                        <div style="float: left; width: 100px;"><?= Form::checkbox('size[]', 17, TRUE); ?> Other</div>
                    </div>
                </div>
                <div class="clear"></div><br />
                <div id="banner-russiandesirecontainer">
                    <?php foreach($rdbanners as $banner): ?>
                    <div class="banner" bannerid="<?= $banner->id; ?>" categories=" <?= implode(' ', array_keys($banner->affiliate_categories->find_all()->as_array('id', 'name'))); ?> ">
                    <?= HTML::image(URL::site($banner->image_path, 'http')); ?> <br />
                    Banner ID #<?= $banner->id; ?>: <?= implode(' - ', array_values($banner->affiliate_categories->find_all()->as_array('id', 'name'))); ?><br />
                    <?= Form::textarea('code', HTML::anchor('/?a=' . Core::$affiliate, HTML::image(URL::site($banner->image_path, 'http'), array('border' => '0')), array('target' => '_blank'), 'http'), array('style' => 'width: 600px; height: 65px;', 'class' => 'code')); ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div id="creative-russiandesiretextlink" class="creatives hide">
                <div id="russiandesiretextlink-filter">
                    <strong>Title</strong><br />
                    <?= Form::input('russiandesiretextlink-title', 'Sexy Russian Women are Waiting for You!', array('style' => 'width: 100%;')); ?>
                </div>
                <div class="clear"></div><br />

                <strong>Code</strong><br />
                <div id="russiandesiretextlink-code">
                <?= Form::textarea('russiandesiretextlink-code', HTML::anchor('http://www.russiandesire.com/?a=' . Core::$affiliate, 'Sexy Russian Women are Waiting for You!', array('target' => '_blank'), 'http'), array('style' => 'width: 870px; height: 50px;', 'class' => 'code')); ?>
                </div><br />

                <strong>Preview</strong><br />
                <div id="russiandesiretextlink-preview">
                    <?= HTML::anchor('http://www.russiandesire.com/?a=' . Core::$affiliate, 'Sexy Russian Women are Waiting for You!', array('target' => '_blank'), 'http'); ?>
                </div><br />
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>