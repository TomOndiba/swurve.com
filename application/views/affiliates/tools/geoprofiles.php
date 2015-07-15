<?php
    list($afl, $subid, $landing, $type, $size, $width, $height, $title) = explode('&', $properties);
    
    $landing = 1;
    $landings = Functions::affiliate_landings();

    $url = array_values($landings[$landing]);
    
    $size = ($size == 100 OR $size == 150) ? $size : '150';
    
    if ($width < 1) $width = 1;
    if ($height < 1) $height = 1;
?>
<table class="swurve-geoprofiles" style="background-color: #fff; font-family: verdana;">
    <tr>
        <td>
            <?php if ( ! empty($title)): ?>
            <div class="swurve-geotext" style="text-align: center; font-size: 18px; margin-bottom: 5px; color: #000;"><?= urldecode(str_replace('|city|', '<span class="swurve-geocity" style="font-weight: bold; color: #000;">' . $geolocation . '</span>', $title)); ?></div>
            <?php endif; ?>
            <table class class="swurve-profiles" style="list-style: none; list-style-type: none; margin: 0; padding: 0;">
                <tr>
                    <?php $count = 1; foreach($users as $user): ?>
                    <td class="swurve-profile" style="text-align: center; padding: 5px; ">
                        <?= HTML::anchor($url[0] . (($landing == 1) ? '/' . $user->username : '') . '?a=' . $afl . (( ! empty($subid)) ? '&s=' . $subid : ''), HTML::image(URL::site('assets/photos/geo/' . strtolower($type) . '/' . strtolower($user->username) . (($size == 100) ? '_100' : '') . '.png', 'http'), array('style' => 'border: 0;', 'border' => '0')), array('target' => '_blank'), 'http'); ?>
                        <div class="swurve-profile-name" style="margin: 0px; font-size: 14px; font-weight: bold; color: #000;"><?= $user->username; ?></div>
                        <div class="swurve-profile-details" style="font-size: 12px; color: #000;"><?= Functions::get_age($user->birthdate); ?> / <?= $user->gender; ?><?= ($size == 150) ? ' / ' . $user->orientation : ''; ?></div>
                    </td>
                    <?= ($count % $width == 0 AND $count != $width * $height) ? '</tr><tr>' : ''; ?>
                    <?php $count++; endforeach; ?>
                <tr>
            </table>
        </td>
    </tr>
</table>
