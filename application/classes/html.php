<?php defined('SYSPATH') or die('No direct script access.');

class HTML extends Kohana_HTML {
    public static function anchor($uri, $title = NULL, array $attributes = NULL, $protocol = NULL) {
        if (strpos($uri, '://') === FALSE && $uri[0] !== '#' && I18n::$lang != 'en-us') 
        {
            $uri = substr(I18n::$lang, 0, 2) . '/' . $uri;
        }

        return parent::anchor($uri, __($title), $attributes, $protocol);
    }
}