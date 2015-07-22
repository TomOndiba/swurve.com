<?php defined('SYSPATH') or die('No direct script access.');
$GLOBALS['tiers'][1]['Text'] = .10;
$GLOBALS['tiers'][1]['Video'] = .40;
$GLOBALS['tiers'][2]['Text'] = .12;
$GLOBALS['tiers'][2]['Video'] = .45;
$GLOBALS['tiers'][3]['Text'] = .15;
$GLOBALS['tiers'][3]['Video'] = .50;

//-- Environment setup --------------------------------------------------------

/**
 * Set the default time zone.
 *
 * @see  http://docs.kohanaphp.com/features/localization#time
 * @see  http://php.net/timezones
 */
date_default_timezone_set('EST5EDT');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://docs.kohanaphp.com/features/autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));


/**
  * Set if the application is in development (FALSE)
  * or if the application is in production (TRUE).
  */
define('IN_PRODUCTION', false);

/*
$host = $_SERVER['HTTP_HOST'];

if ($host == 'swurve.local' OR $host == 'dev.swurve.com')
{
	define('IN_PRODUCTION', false);
} else {
	define('IN_PRODUCTION', true);
}
*/


//-- Configuration and initialization -----------------------------------------

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
Kohana::init(array(
    'base_url'      => '/',
    'index_file'    => '',
    'profile'       => !IN_PRODUCTION,
    'caching'       => IN_PRODUCTION,
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Kohana_Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Kohana_Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	   //'auth'       => MODPATH.'auth',       // Basic authentication
	   'codebench'  => MODPATH.'codebench',  // Benchmarking tool
	   'database'   => MODPATH.'database',   // Database access
	   'image'      => MODPATH.'image',      // Image manipulation
       'orm'        => MODPATH.'orm',        // Object Relationship Mapping
	   'pagination' => MODPATH.'pagination', // Paging of results
	   //'userguide'  => MODPATH.'userguide',  // User guide and API documentation
	));

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */

/*Route::set('multi', '(<lang>)(/<controller>(/<action>(/<param>)))', array('lang' => '[a-z]{2}', 'param' => '.+'))
	->defaults(array(
		'controller' => 'home',
		'action'     => 'index',
        'lang' => 'en'
	));
*/
if ( ! Route::cache())
{
    Route::set('articles', 'hook-up-site-articles(/<param>(/))', array('param' => '.+'))
        ->defaults(array(
            'controller' => 'index',
            'action'     => 'articles'
        ));

    Route::set('articles2', 'Casual-Dating-New-York-City(/<param>(/))', array('param' => '.+'))
        ->defaults(array(
            'controller' => 'index',
            'action'     => 'articles2'
        ));

    Route::set('articles3', 'Casual-Dating-Chicago-Hook-Up(/<param>(/))', array('param' => '.+'))
        ->defaults(array(
            'controller' => 'index',
            'action'     => 'articles3'
        ));

    Route::set('rnd', 'rnd')
        ->defaults(array(
            'controller' => 'index',
            'action'     => 'random'
        ));

    Route::set('landing3', '3(/<param>(/))', array('param' => '.+'))
        ->defaults(array(
            'controller' => 'index',
            'action'     => 'index3'
        ));

    Route::set('landing2', '2')
        ->defaults(array(
            'controller' => 'index',
            'action'     => 'index2'
        ));

    Route::set('edit_profile', 'edit/profile')
        ->defaults(array(
            'controller' => 'user',
            'action'     => 'edit'
        ));

    Route::set('coming-soon', 'coming-soon')
        ->defaults(array(
            'controller' => 'user',
            'action'     => 'comingsoon'
        ));


    Route::set('2257', '2257')
        ->defaults(array(
            'controller' => 'home',
            'action'     => '2257'
        ));

    Route::set('feed', 'feed(/<param>)', array('param' => '.+'))
        ->defaults(array(
            'controller' => 'home',
            'action'     => 'feed'
        ));

    Route::set('terms', 'terms')
        ->defaults(array(
            'controller' => 'home',
            'action'     => 'terms'
        ));

    Route::set('support', 'support')
        ->defaults(array(
            'controller' => 'home',
            'action'     => 'support'
        ));

    Route::set('privacy', 'privacy')
        ->defaults(array(
            'controller' => 'home',
            'action'     => 'privacy'
        ));

    Route::set('unsubscribe', 'unsubscribe(/<param>)', array('param' => '.+'))
        ->defaults(array(
            'controller' => 'user',
            'action'     => 'unsubscribe'
        ));

    Route::set('request_photos', 'request(/<param>)', array('param' => '.+'))
        ->defaults(array(
            'controller' => 'photo',
            'action'     => 'request'
        ));

    Route::set('photo', 'photo(/<param>)', array('param' => '.+'))
        ->defaults(array(
            'controller' => 'photo',
            'action'     => 'view'
        ));

    Route::set('photon', 'nphoto(/<param>)', array('param' => '.+'))
        ->defaults(array(
            'controller' => 'photo',
            'action'     => 'view2'
        ));

    Route::set('activity', 'activity(/<param>)', array('param' => '.+'))
        ->defaults(array(
            'controller' => 'user',
            'action'     => 'activity'
        ));

    Route::set('photos', 'photos(/<param>)', array('param' => '.+'))
        ->defaults(array(
            'controller' => 'user',
            'action'     => 'photos'
        ));

    Route::set('profile', 'profile(/<param>)', array('param' => '.+'))
        ->defaults(array(
            'controller' => 'user',
            'action'     => 'profile'
        ));

    Route::set('activate', 'activate(/<param>)', array('param' => '.+'))
        ->defaults(array(
            'controller' => 'user',
            'action'     => 'activate'
        ));

    Route::set('news', 'news(/<param>)', array('param' => '.+'))
        ->defaults(array(
            'controller' => 'home',
            'action'     => 'news'
        ));

    Route::set('affiliatenews', 'affiliates/news(/<param>)', array('param' => '.+'))
        ->defaults(array(
            'directory'  => 'affiliates',
            'controller' => 'index',
            'action'     => 'news'
        ));

    Route::set('admin', 'admin(/<controller>(/<action>(/<param>)))', array('param' => '.+'))
        ->defaults(array(
            'directory'  => 'admin',
            'controller' => 'index',
            'action'     => 'index'
        ));

    Route::set('affiliates', 'affiliates(/<controller>(/<action>(/<param>)))', array('param' => '.+'))
        ->defaults(array(
            'directory'  => 'affiliates',
            'controller' => 'index',
            'action'     => 'index'
        ));

    Route::set('flirtbucks', 'flirtbucks(/<controller>(/<action>(/<param>)))', array('param' => '.+'))
        ->defaults(array(
            'directory'  => 'flirtbucks',
            'controller' => 'index',
            'action'     => 'index'
        ));

    Route::set('default', '(<controller>(/<action>(/<param>)))', array('param' => '.+'))
        ->defaults(array(
            'controller' => 'index',
            'action'     => 'index'
        ));
}
/**
 * Execute the main request. A source of the URI can be passed, eg: $_SERVER['PATH_INFO'].
 * If no source is specified, the URI will be automatically detected.
 */

$request = Request::instance();

if (IN_PRODUCTION === TRUE)
{
    // If we're in production, we want to handle erros nicely
    try
    {
        // Attempt to execute the response
        $request->execute()
            ->send_headers();
    }
    catch (Exception $e)
    {
        // Was the page found?
        /* if ($request->status == 404 || $e instanceof Kohana_Request_Exception)
        {
            $title = 'Kohana Examples - Page Not Found';
            $view = View::factory('pages/errors/404');
        }
        // The error was an internal server error or something else, we should record it for analysis
        else
        {
            $title = 'Kohana Examples - Page Error';
            $view = View::factory('pages/errors/500');

            // Write a log as an internal server error
            Kohana::$log->add('500', $e);

            // Email administrators, if necessary
        }

        $request->response = View::factory('template')
            ->set('title', $title)
            ->set('meta_keywords', '')
            ->set('meta_description', '')
            ->set('stylesheets', html::style('media/css/errors.css', array('media' => 'screen')))
            ->set('javascripts', '')
            ->set('content', $view);
        */
    }
}
else
{
    // We want to display errors if we are not in production
    $request->execute()
        ->send_headers();
}

// Echo the response
echo $request->response;


// Remove for deployment
if ((!empty($_GET['ks_enable']) && $_SERVER['REMOTE_ADDR'] == '127.0.0.1') || !empty($_GET['ks_secret_key']) && $_GET['ks_secret_key'] == 'swurve')
{
    $req = Request::instance();
    die('KS;1;'.$req->directory.';'.$req->controller .';'.$req->action);
}

