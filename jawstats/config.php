<?php
  error_reporting(1);
  ini_set("memory_limit", "256M");

  // core config parameters
  $sDefaultLanguage      = "en-gb";
  $sConfigDefaultView    = "thismonth.all";
  $bConfigChangeSites    = true;
  $bConfigUpdateSites    = false;
  $sUpdateSiteFilename   = "xml_update.php";

  // individual site configuration
  $aConfig["www.swurve.com"] = array(
    "statspath"   => "/var/www/awstats/",
    "updatepath"  => "/var/www/awstats/",
    "siteurl"     => "http://www.swurve.com",
    "sitename"    => "Swurve",
    "theme"       => "default",
    "fadespeed"   => 250,
    "password"    => "!!my-1st-password",
    "includes"    => "",
    "language"    => "en-gb"
  );
?>
