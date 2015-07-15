<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Playground extends Controller_Master
{
    function before() 
    {
        $this->secure = NULL;
        
        parent::before();

        $this->auto_render = FALSE;
    }
    
    public function action_index()
    {
        $file = '/home/solarisdev/public_html/public/assets/img/affiliates/bannerads/2010/180x600geo.gif';
        
        $command = "convert $file -coalesce -gravity Center -font Verdana-Bold -pointsize 11 -draw 'text 0,151 \"Clearwater\"' -draw 'text 0,-70 \"Clearwater\"' -layers Optimize gif:-";
/*        $command = 'convert -background ‘rgb($bgcolor)’ -fill
        ‘rgb($fillcolor)’ -font “.$font.”-pointsize “.$pointsize.”
        -size “.$size.” label:’”.$text.”‘ png:-';
     */
        header('Content-type: image/gif');

        $p = popen("($command) 2>&1", "r");

        while (!feof($p)) {
            $l=fgets($p,1000);
            print $l;
        } 
        return pclose($p);
        
    }
}