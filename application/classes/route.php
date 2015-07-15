<?php defined('SYSPATH') or die('No direct script access.');

class Route extends Kohana_Route 
{
    public function matches($uri)
    {
        if (is_null(I18n::$changed))
        {
            I18n::$changed = FALSE;

            if (preg_match('#^([a-z]{2})/|(^[a-z]{2}$)|$#', $uri, $matches) && (isset($matches[1]) || isset($matches[2])))
            {
                $lang = (empty($matches[1])) ? $matches[2] : $matches[1];

                if (array_key_exists($lang , I18n::$allowed_locales))
                {
                    I18n::$changed = TRUE;

                    $uri = substr($uri, 3);

                    I18n::$lang = I18n::$allowed_locales[$lang];
                }
            }
        }
        elseif (I18n::$changed) 
        {
            $uri = substr($uri, 3);
        }

        return parent::matches($uri);
    }
}
