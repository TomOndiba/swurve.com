<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Affiliates_Tools extends Controller_Master
{
    public $template = 'affiliates';
    public function action_test()
    {
        $ids = Functions::rand_numbers(233, 490, 5);
        
        // male 1- 80
        // female 81 - 232
        // both 233 - 490
        
        $users = ORM::factory('geoad')->where('type', '=', 'both')->where('id', 'IN', new Database_Expression('(' . $ids . ')'))->limit(5)->find_all();

        print_r($users);
        
        $this->auto_render = FALSE;
    }

    public function action_index()
    {
        $this->template->content = View::factory('affiliates/tools/bannerads')->bind('campaigns', $campaigns)->bind('subs', $subs)->bind('rdbanners', $rdbanners)->bind('banners', $banners)->bind('brokerbanners', $brokerbanners);
        
        $this->add_stylesheet(Functions::src_file('assets/css/jquery-ui.min.css'), 'screen');
	    $this->add_javascript(array(Functions::src_file('assets/js/jquery-ui.min.js')));
        
        $campaigns = Core::$affiliate->affiliate_campaigns->find_all();
        $subs = Core::$affiliate->affiliate_subs->where('campaign_id', '=', 0)->find_all();
        $banners = ORM::factory('affiliate_bannerad')
            ->where('id', 'NOT IN', new Database_Expression('(SELECT affiliate_bannerads_categories.affiliate_bannerad_id FROM affiliate_bannerads_categories JOIN affiliate_categories ON  affiliate_categories.id = affiliate_bannerads_categories.affiliate_category_id AND affiliate_categories.name = \'Broker\')'))
            ->where('active', '=', 'Yes')
            ->where('site', '=', 'Swurve')
            ->find_all();
        $brokerbanners = ORM::factory('affiliate_bannerad')
            ->where('id', 'IN', new Database_Expression('(SELECT affiliate_bannerads_categories.affiliate_bannerad_id FROM affiliate_bannerads_categories JOIN affiliate_categories ON  affiliate_categories.id = affiliate_bannerads_categories.affiliate_category_id AND affiliate_categories.name = \'Broker\')'))
            ->where('active', '=', 'Yes')
            ->where('site', '=', 'Swurve')
            ->find_all();

        $rdbanners = ORM::factory('affiliate_bannerad')
            ->where('id', 'NOT IN', new Database_Expression('(SELECT affiliate_bannerads_categories.affiliate_bannerad_id FROM affiliate_bannerads_categories JOIN affiliate_categories ON  affiliate_categories.id = affiliate_bannerads_categories.affiliate_category_id AND affiliate_categories.name = \'Broker\')'))
            ->where('active', '=', 'Yes')
            ->where('site', '=', 'Russian Desire')
            ->find_all();
    }

    public function action_geoads($file)
    {
        $this->auto_render = FALSE;
        
        ob_start();

        $path = '/home/solarisdev/public_html/public/assets/img/affiliates/bannerads/';
        $record_found = false;

        header('Last-Modified: '.date('r'));

        $geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->order_by('start_ip', 'DESC')->limit(1)->find();
        
        if ($geoloc->loaded() AND $geoloc->geolocation->loaded())
        {
            if ($geoloc->end_ip >= ip2long($_SERVER['REMOTE_ADDR'])) {
                $record_found = true;
            }
            else
            {
                $record_found = false;
            }
        }
        else
        {
            $record_found = false;
        }

        switch($file)
        {
            case '2010/180x600geo.gif':
                header('Content-type: image/gif');
                
                if ($record_found)
                {
                    $location = $geoloc->geolocation->city;
                }
                else
                {
                    $location = 'Your City';
                }

                $command = "convert $path$file -coalesce -gravity Center -font Verdana-Bold -pointsize 11 -fill red -draw 'text 0,151 \"$location\"' -draw 'text 0,-70 \"$location\"' -layers Optimize gif:-";

                break;

            case '2010/768x245geo.gif':
                header('Content-type: image/gif');
                
                if ($record_found)
                {
                    $location = $geoloc->geolocation->city;
                }
                else
                {
                    $location = 'Your City';
                }

                $command = "convert $path$file -coalesce -gravity Center -font Verdana-Bold -pointsize 11 -fill red -draw 'text -282,96 \"$location\"' -draw 'text -95,96 \"$location\"' -draw 'text 97,96 \"$location\"' -draw 'text 284,96 \"$location\"' -layers Optimize gif:-";

                break;
                
            default:
                return;
            
                break;
        }

        $file = popen("($command) 2>&1", "r");

        while ( ! feof($file))
        {
            $data = fgets($file, 1000);
            
            print $data;
        } 

        pclose($file);
        
        ob_end_flush();
    }
    
    public function action_postroll($properties)
    {
        header ("Content-Type: text/xml");
        
        list($afl, $subid, $landing, $type, $size, $header) = explode('&', $properties);

        $landings = Functions::affiliate_landings();
        $url = array_values($landings[$landing]);
        $users = ORM::factory('geoad')->where('type', '=', $type)->order_by(new Database_Expression('RAND()'))->limit(2)->find_all();

        $geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->order_by('start_ip', 'DESC')->limit(1)->find();
        
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
        
        echo '<?xml version="1.0" encoding="utf-8" ?>';
        echo '<ads>';
        echo '  <ad header="' . htmlspecialchars($header) . '" targeturl="' . $url[0] . '?a=' . $afl . (( ! empty($subid)) ? '&amp;s=' . $subid : '') . '">';
        echo '    <image handle="' . $users->current()->username . '" age="' . Functions::get_age($users->current()->birthdate) . '" location="' . $geolocation . '" headline="' . Functions::random_seeking_type() . '" src="' . URL::site('assets/photos/geo/' . strtolower($type) . '/' . strtolower($users->current()->username) . (($size == 100) ? '_100' : '') . '.png', 'http') . '" width="' . $size . '" height="' . $size . '" />';
        $users->next();
        echo '    <image handle="' . $users->current()->username . '" age="' . Functions::get_age($users->current()->birthdate) . '" location="' . $geolocation . '" headline="' . Functions::random_seeking_type() . '" src="' . URL::site('assets/photos/geo/' . strtolower($type) . '/' . strtolower($users->current()->username) . (($size == 100) ? '_100' : '') . '.png', 'http') . '" width="' . $size . '" height="' . $size . '" />';
        echo '  </ad>';
        echo '</ads>';

        exit();

        $this->auto_render = FALSE;
    }

    public function action_imagelist()
    {
        $geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->order_by('start_ip', 'DESC')->limit(1)->find();
        
        // select distinct city, region from iplocationdb_location where metrocode = 539 and areacode = 727 order by abs(28.0145 - latitude) asc, abs(-82.6923 - longitude) asc limit 3;
        
        if ($geoloc->loaded() AND $geoloc->geolocation->loaded())
        {
            if (empty($geoloc->geolocation->metrocode) AND empty($geoloc->geolocation->areacode))
            {
                if (empty($geoloc->geolocation->city) OR empty($geoloc->geolocation->region))
                {
                    $cities[] = '';
                }
                else
                {
                    $cities[] = $geoloc->geolocation->city . ', ' . $geoloc->geolocation->region;
                }
            }
            else
            {
            $sql = 'select distinct city, region from iplocationdb_location where metrocode = \'' . $geoloc->geolocation->metrocode . '\' and areacode = \'' . $geoloc->geolocation->areacode . '\' group by city order by min(abs(' . $geoloc->geolocation->latitude . ' - latitude)) asc, min(abs(' . $geoloc->geolocation->longitude . ' - longitude)) asc limit 3';

            $locations = DB::query(Database::SELECT, $sql)->as_object('Model_GeoLocation')->execute();
            
            foreach($locations as $location)
            {
                $cities[] = $location->city . ', ' . $location->region;
            }
            }
//            print_r($cities);

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
            $cities[] = '';
            $geolocation = 'Your City';
        }
?>
<images>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image01.jpg</image>
	<username>AngelKisses</username>
	<location><?= $cities[array_rand($cities)]; ?></location>
	<status><?= rand(0, 1) ? 'online' : 'offline'; ?></status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image02.jpg</image>
	<username>XoAshleyoX</username>
	<location><?= $cities[array_rand($cities)]; ?></location>
	<status><?= rand(0, 1) ? 'online' : 'offline'; ?></status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image03.jpg</image>
	<username>YummiMami3</username>
	<location><?= $cities[array_rand($cities)]; ?></location>
	<status><?= rand(0, 1) ? 'online' : 'offline'; ?></status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image04.jpg</image>
	<username>KissMeDeadly</username>
	<location><?= $cities[array_rand($cities)]; ?></location>
	<status><?= rand(0, 1) ? 'online' : 'offline'; ?></status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image05.jpg</image>
	<username>AlisaBDD</username>
	<location><?= $cities[array_rand($cities)]; ?></location>
	<status><?= rand(0, 1) ? 'online' : 'offline'; ?></status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image06.jpg</image>
	<username>MarianneXXX</username>
	<location><?= $cities[array_rand($cities)]; ?></location>
	<status><?= rand(0, 1) ? 'online' : 'offline'; ?></status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image07.jpg</image>
	<username>SouthrnSweet</username>
	<location><?= $cities[array_rand($cities)]; ?></location>
	<status><?= rand(0, 1) ? 'online' : 'offline'; ?></status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image08.jpg</image>
	<username>Gina1980</username>
	<location><?= $cities[array_rand($cities)]; ?></location>
	<status><?= rand(0, 1) ? 'online' : 'offline'; ?></status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image09.jpg</image>
	<username>EmilyFine</username>
	<location><?= $cities[array_rand($cities)]; ?></location>
	<status><?= rand(0, 1) ? 'online' : 'offline'; ?></status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image10.jpg</image>
	<username>Morgan1138</username>
	<location><?= $cities[array_rand($cities)]; ?></location>
	<status><?= rand(0, 1) ? 'online' : 'offline'; ?></status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image11.jpg</image>
	<username>LucyLoo69</username>
	<location><?= $cities[array_rand($cities)]; ?></location>
	<status><?= rand(0, 1) ? 'online' : 'offline'; ?></status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image12.jpg</image>
	<username>IwantU2LickMe</username>
	<location><?= $cities[array_rand($cities)]; ?></location>
	<status><?= rand(0, 1) ? 'online' : 'offline'; ?></status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image13.jpg</image>
	<username>TruJayde</username>
	<location><?= $cities[array_rand($cities)]; ?></location>
	<status><?= rand(0, 1) ? 'online' : 'offline'; ?></status>
	<image><?= URL::base(TRUE, 'http'); ?>assets/flash/bannerads/2011/300x250-1/images/image14.jpg</image>
	<username>Rachelle</username>
	<location><?= $cities[array_rand($cities)]; ?></location>
	<status><?= rand(0, 1) ? 'online' : 'offline'; ?></status>
</images>
<?php
        $this->auto_render = FALSE;
    }

    public function action_flashbannerads()
    {
        //list($afl, $subid, $landing, $type) = explode('&', $properties);
        
        //$geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->where('end_ip', '>=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->find();
        $geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->order_by('start_ip', 'DESC')->limit(1)->find();
        
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
        
        echo View::factory('affiliates/tools/flashbannerads')->bind('properties', $properties)->bind('geolocation', $geolocation)->render();

        $this->auto_render = FALSE;
    }
    
    public function action_chatad($properties)
    {
        list($afl, $subid, $landing, $type) = explode('&', $properties);
        
        //$geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->where('end_ip', '>=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->find();
        $geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->order_by('start_ip', 'DESC')->limit(1)->find();
        
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
        
        echo View::factory('affiliates/tools/chatad')->bind('properties', $properties)->bind('geolocation', $geolocation)->render();

        $this->auto_render = FALSE;
    }
    
    public function action_chatadpreview($properties)
    {
        list($afl, $subid, $landing, $type) = explode('&', $properties);
        
        $this->template->content = View::factory('affiliates/tools/chatad')->bind('properties', $properties)->bind('geolocation', $geolocation)->bind('previewtext', $previewtext);

        $previewtext = '<h1>Chat Ad Tool Preview</h1><p>This page is a preview of the affiliate chat ad tool and what it will look like on your site.  Everything functions the same on the page but in the bottom right corner is the chat ad tool overlay to attract viewers, they may close the ad without any interference.</p>';
        
        //$geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->where('end_ip', '>=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->find();
        $geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->order_by('start_ip', 'DESC')->limit(1)->find();
        
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
    }

    public function action_geotext($properties)
    {
        list($afl, $subid, $landing, $text) = explode('&', $properties);
        
        $landings = Functions::affiliate_landings();
        $url = array_values($landings[$landing]);
        $geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->order_by('start_ip', 'DESC')->limit(1)->find();
        
        if ($geoloc->loaded() AND $geoloc->geolocation->loaded())
        {
            if ($geoloc->end_ip >= ip2long($_SERVER['REMOTE_ADDR'])) {
                $geolocation = $geoloc->geolocation->city;
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
                
        echo 'document.write("<a href=\"' . $url[0] . '?a=' . $afl . (( ! empty($subid)) ? '&amp;s=' . $subid : '') . '\">' . str_replace('|city|', $geolocation, str_replace('"', '\"', $text)) . '</a>");';

        $this->auto_render = FALSE;
    }
       
    public function action_geotextpreview($properties)
    {
        list($afl, $subid, $landing, $text) = explode('&', $properties);
        
        $landings = Functions::affiliate_landings();
        $url = array_values($landings[$landing]);
        $geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->order_by('start_ip', 'DESC')->limit(1)->find();
        
        if ($geoloc->loaded() AND $geoloc->geolocation->loaded())
        {
            if ($geoloc->end_ip >= ip2long($_SERVER['REMOTE_ADDR'])) {
                $geolocation = $geoloc->geolocation->city;
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
                
        echo '<a href="' . $url[0] . '?a=' . $afl . (( ! empty($subid)) ? '&amp;s=' . $subid : '') . '">' . str_replace('|city|', $geolocation, str_replace('"', '\"', $text)) . '</a>';

        $this->auto_render = FALSE;
    }
       
    public function action_geoprofiles($properties)
    {
        list($afl, $subid, $landing, $type, $size, $width, $height, $title) = explode('&', $properties);
        
        $size = ($size == 100 OR $size == 150) ? $size : '150';

        if ($width < 1) $width = 1;
        if ($height < 1) $height = 1;

        switch($type)
        {
            case 'Male':
                $ids = Functions::rand_numbers(1, 80, $width * $height);
                break;
                
            case 'Female':
                $ids = Functions::rand_numbers(81, 232, $width * $height);
                break;
                
            case 'Both':
                $ids = Functions::rand_numbers(233, 490, $width * $height);
                break;
        }

        $users = ORM::factory('geoad')->where('id', 'IN', new Database_Expression('(' . $ids . ')'))->find_all();
        //$users = ORM::factory('geoad')->where('type', '=', $type)->order_by(new Database_Expression('RAND()'))->limit($width * $height)->find_all();
        //$geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->where('end_ip', '>=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->find();
        $geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->order_by('start_ip', 'DESC')->limit(1)->find();
        
        if ($geoloc->loaded() AND $geoloc->geolocation->loaded())
        {
            if ($geoloc->end_ip >= ip2long($_SERVER['REMOTE_ADDR'])) {
                $geolocation = $geoloc->geolocation->city;
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
                
        $data =  explode("\r\n", View::factory('affiliates/tools/geoprofiles')->bind('properties', $properties)->bind('users', $users)->bind('geolocation', $geolocation)->render());

        foreach($data as $line)
        {
            echo 'document.write("' . str_replace('"', '\"', $line) . '");';
        }

        $this->auto_render = FALSE;
    }
    
    public function action_geoprofilespreview($properties)
    {
        list($afl, $subid, $landing, $type, $size, $width, $height, $title) = explode('&', $properties);
        
        $size = ($size == 100 OR $size == 150) ? $size : '150';

        if ($width < 1) $width = 1;
        if ($height < 1) $height = 1;

        $users = ORM::factory('geoad')->where('type', '=', $type)->order_by(new Database_Expression('RAND()'))->limit($width * $height)->find_all();
        //$geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->where('end_ip', '>=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->find();
        $geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->order_by('start_ip', 'DESC')->limit(1)->find();
        
        if ($geoloc->loaded() AND $geoloc->geolocation->loaded())
        {
            if ($geoloc->end_ip >= ip2long($_SERVER['REMOTE_ADDR'])) {
                $geolocation = $geoloc->geolocation->city;
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

        echo View::factory('affiliates/tools/geoprofiles')->bind('properties', $properties)->bind('users', $users)->bind('geolocation', $geolocation)->render();
        
        $this->auto_render = FALSE;
    }
}
