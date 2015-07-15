<?php
    $geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->order_by('start_ip', 'DESC')->limit(1)->find();

print_r($geoloc);

    if ($geoloc->loaded() AND $geoloc->geolocation->loaded())
    {
        if ($geoloc->end_ip >= ip2long($_SERVER['REMOTE_ADDR'])) {
            $geolocation = $geoloc->geolocation->city . ', ' . $geoloc->geolocation->region;
        }
        else
        {
            $geolocation = 'Your City';
        }
    }
    else
    {
        $geolocation = 'Your City';
    }
?>
<images>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image01.jpg</image>
	<username>username01</username>
	<location><?= $geolocation; ?></location>
	<status><?= rand(0, 1) ? 'online' : 'offline'; ?></status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image02.jpg</image>
	<username>username02</username>
	<location><?= $geolocation; ?></location>
	<status><?= rand(0, 1) ? 'online' : 'offline'; ?></status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image03.jpg</image>
	<username>username03</username>
	<location><?= $geolocation; ?></location>
	<status><?= rand(0, 1) ? 'online' : 'offline'; ?></status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image04.jpg</image>
	<username>username04</username>
	<location><?= $geolocation; ?></location>
	<status><?= rand(0, 1) ? 'online' : 'offline'; ?></status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image05.jpg</image>
	<username>username05</username>
	<location><?= $geolocation; ?></location>
	<status><?= rand(0, 1) ? 'online' : 'offline'; ?></status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image06.jpg</image>
	<username>username06</username>
	<location><?= $geolocation; ?></location>
	<status>offline</status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image07.jpg</image>
	<username>username07</username>
	<location><?= $geolocation; ?></location>
	<status>online</status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image08.jpg</image>
	<username>username08</username>
	<location><?= $geolocation; ?></location>
	<status>online</status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image09.jpg</image>
	<username>username09</username>
	<location><?= $geolocation; ?></location>
	<status>online</status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image10.jpg</image>
	<username>username10</username>
	<location><?= $geolocation; ?></location>
	<status>offline</status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image11.jpg</image>
	<username>username11</username>
	<location><?= $geolocation; ?></location>
	<status>online</status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image12.jpg</image>
	<username>username12</username>
	<location><?= $geolocation; ?></location>
	<status>offline</status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image13.jpg</image>
	<username>username13</username>
	<location><?= $geolocation; ?></location>
	<status>online</status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image14.jpg</image>
	<username>username14</username>
	<location><?= $geolocation; ?></location>
	<status>offline</status>
</images>