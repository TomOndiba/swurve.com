<?php

  // core config parameters
  $sDefaultLanguage      = "en-gb";
  $sConfigDefaultView    = "thismonth.all";
  $bConfigChangeSites    = true;
  $bConfigUpdateSites    = true;
  $sUpdateSiteFilename   = "xml_update.php";
  $sDefaultTimeZone	 = "UTC";   // see : http://php.net/manual/en/timezones.php
  $bUTF8LogFiles         = false;   // use '.utf8' extension at end of filename, for utf8 version of awstats log file.
  $bUseHttpHost          = false;   // use HTTP_HOST enviourment variable as config name.
  $bForceHttpHost        = false;   // don't allow other config than HTTP_HOST

  // individual site configuration
  $aConfig["www.swurve.com"] = array(
    "statspath"   => "/var/www/awstats/",
    "statsname"   => "awstats[MM][YYYY].www.swurve.com.txt", 
    "updatepath"  => "/var/www/awstats/",
    "preupdate"  => "/path/to/custom/cmd",
    "postupdate"  => "/path/to/custom/cmd",
    "siteurl"     => "http://www.swurve.com",
    "sitename"    => "Swurve",
    "theme"       => "default",
    "fadespeed"   => 250,
    "password"    => "!my-1st-password",
    "includes"    => "",
    "language"    => "en-gb",
    "type"        => "web",
    "urlaliasfile"=> "", // optional, read url alias file, display page titles instead of urls under 'Pages' tab
    "parts"       => "outside,inside" // Optional (only if you want to combine/stack multiple awstats logs)
  );

  $aConfig["mail"] = array(
    "statspath"   => "/var/www/awstats/",
    "statsname" => "awstats[MM][YYYY].mail.txt", 
    "updatepath"  => "/var/www/awstats/",
    "siteurl"     => "http://www.swurve.com/mail",
    "sitename"    => "Swurve Mail",
    "theme"       => "default",
    "fadespeed"   => 250,
    "password"    => "!my-2nd-password",
    "includes"    => "",
    "language"    => "en-gb",
    "type"        => "mail"
  );

 // Custom Descriptions
 $aDesc["VISITOR"]  = array(
      "194.8.75.251" => "Known Host"
  );
?>
