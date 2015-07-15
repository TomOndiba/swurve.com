<?php defined('SYSPATH') or die('No direct script access.');

class I18n extends Kohana_I18n {
    public static $lang = 'en-us';

    public static $changed = NULL;

    public static $allowed_locales = array(
        'en' => 'en-us',
        'es' => 'es-es',
    );
    
    /**
     * Returns the translation table for a given language.
     *
     * @param   string   language to load
     * @return  array
     */
    public static function load($lang)
    {
        if ( ! isset(I18n::$_cache[$lang]))
        {
            // Separate the language and locale
            list ($language, $locale) = explode('-', strtolower($lang), 2);

            // Start a new translation table
            $table = array();

            // Add the non-specific language strings
            if ($files = Kohana::find_file('i18n', $language))
            {
                foreach ($files as $file)
                {
                    // Merge the language strings into the translation table
                    $table = array_merge($table, require $file);
                }
            }

            // Add the locale-specific language strings
            if ($files = Kohana::find_file('i18n', $language.'/'.$locale))
            {
                foreach ($files as $file)
                {
                    // Merge the locale strings into the translation table
                    $table = array_merge($table, require $file);
                }
            }

            // Cache the translation table locally
            I18n::$_cache[$lang] = $table;// Text::utf8_encode_mix($table);
        }

        return I18n::$_cache[$lang];
    }
}
