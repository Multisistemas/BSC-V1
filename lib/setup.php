<?php
session_start();
global $CFG; // this should be done much earlier in config.php before creating new $CFG instance

if (!isset($CFG)) {
    if (defined('PHPUNIT_TEST') and PHPUNIT_TEST) {
        echo('There is a missing "global $CFG;" at the beginning of the config.php file.'."\n");
        exit(1);
    } else {
        // this should never happen, maybe somebody is accessing this file directly...
        exit(1);
    }
}

// We can detect real dirroot path reliably since PHP 4.0.2,
// it can not be anything else, there is no point in having this in config.php
$CFG->dirroot = dirname(__DIR__);

// File permissions on created directories in the $CFG->dataroot
if (!isset($CFG->directorypermissions)) {
    $CFG->directorypermissions = 02777;      // Must be octal (that's why it's here)
}
if (!isset($CFG->filepermissions)) {
    $CFG->filepermissions = ($CFG->directorypermissions & 0666); // strip execute flags
}
// Better also set default umask because developers often forget to include directory
// permissions in mkdir() and chmod() after creating new files.
if (!isset($CFG->umaskpermissions)) {
    $CFG->umaskpermissions = (($CFG->directorypermissions & 0777) ^ 0777);
}
umask($CFG->umaskpermissions);

// Make sure there is some database table prefix.
if (!isset($CFG->prefix)) {
    $CFG->prefix = '';
}

// Define admin directory
if (!isset($CFG->admin)) {   // Just in case it isn't defined in config.php
    $CFG->admin = 'admin';   // This is relative to the wwwroot and dirroot
}

// Set up some paths.
$CFG->libdir = $CFG->dirroot .'/lib';

// The current directory in PHP version 4.3.0 and above isn't necessarily the
// directory of the script when run from the command line. The require_once()
// would fail, so we'll have to chdir()
if (!isset($_SERVER['REMOTE_ADDR']) && isset($_SERVER['argv'][0])) {
    // do it only once - skip the second time when continuing after prevous abort
    if (!defined('ABORT_AFTER_CONFIG') and !defined('ABORT_AFTER_CONFIG_CANCEL')) {
        chdir(dirname($_SERVER['argv'][0]));
    }
}

// sometimes default PHP settings are borked on shared hosting servers, I wonder why they have to do that??
ini_set('precision', 14); // needed for upgrades and gradebook
ini_set('serialize_precision', 17); // Make float serialization consistent on all systems.

// Scripts may request no debug and error messages in output
// please note it must be defined before including the config.php script
// and in some cases you also need to set custom default exception handler
if (!defined('NO_DEBUG_DISPLAY')) {
    if (defined('AJAX_SCRIPT') and AJAX_SCRIPT) {
        // BSC AJAX scripts are expected to return json data, any PHP notices or errors break it badly,
        // developers simply must learn to watch error log.
        define('NO_DEBUG_DISPLAY', true);
    } else {
        define('NO_DEBUG_DISPLAY', false);
    }
}

// Some scripts such as upgrade may want to prevent output buffering
if (!defined('NO_OUTPUT_BUFFERING')) {
    define('NO_OUTPUT_BUFFERING', false);
}

// PHPUnit tests need custom init
if (!defined('PHPUNIT_TEST')) {
    define('PHPUNIT_TEST', false);
}

// When set to true MUC (BSC caching) will be disabled as much as possible.
// A special cache factory will be used to handle this situation and will use special "disabled" equivalents objects.
// This ensure we don't attempt to read or create the config file, don't use stores, don't provide persistence or
// storage of any kind.
if (!defined('CACHE_DISABLE_ALL')) {
    define('CACHE_DISABLE_ALL', false);
}

// When set to true MUC (BSC caching) will not use any of the defined or default stores.
// The Cache API will continue to function however this will force the use of the cachestore_dummy so all requests
// will be interacting with a static property and will never go to the proper cache stores.
// Useful if you need to avoid the stores for one reason or another.
if (!defined('CACHE_DISABLE_STORES')) {
    define('CACHE_DISABLE_STORES', false);
}

// Servers should define a default timezone in php.ini, but if they don't then make sure no errors are shown.
date_default_timezone_set(@date_default_timezone_get());

// Detect CLI scripts - CLI scripts are executed from command line, do not have session and we do not want HTML in output
// In your new CLI scripts just add "define('CLI_SCRIPT', true);" before requiring config.php.
// Please note that one script can not be accessed from both CLI and web interface.
if (!defined('CLI_SCRIPT')) {
    define('CLI_SCRIPT', false);
}

// All web service requests have WS_SERVER == true.
if (!defined('WS_SERVER')) {
    define('WS_SERVER', false);
}

if(!defined('DEBUG_DEVELOPER')) {
    define('DEBUG_DEVELOPER', false);
}

/**
 * Database connection. Used for all access to the database.
 * @global bsc_database $DB
 * @name $DB
 */
global $DB;
global $DB2; // Uses Medoo PHP DB Framework.

/**
 * BSC's wrapper round PHP's $_SESSION.
 *
 * @global object $SESSION
 * @name $SESSION
 */
global $SESSION;

/**
 * Holds the user table record for the current user. Will be the 'guest'
 * user record for people who are not logged in.
 *
 * $USER is stored in the session.
 *
 * Items found in the user record:
 *  - $USER->email - The user's email address.
 *  - $USER->id - The unique integer identified of this user in the 'user' table.
 *  - $USER->email - The user's email address.
 *  - $USER->firstname - The user's first name.
 *  - $USER->lastname - The user's last name.
 *  - $USER->username - The user's login username.
 *  - $USER->secret - The user's ?.
 *  - $USER->lang - The user's language choice.
 *
 * @global object $USER
 * @name $USER
 */
global $USER;

/**
 * Frontpage course record
 */
global $SITE;

/**
 * A central store of information about the current page we are
 * generating in response to the user's request.
 *
 * @global bsc_page $PAGE
 * @name $PAGE
 */
global $PAGE;

/**
 * The current course. An alias for $PAGE->course.
 * @global object $COURSE
 * @name $COURSE
 */
global $COURSE;

/**
 * $OUTPUT is an instance of core_renderer or one of its subclasses. Use
 * it to generate HTML for output.
 *
 * $OUTPUT is initialised the first time it is used. See {@link bootstrap_renderer}
 * for the magic that does that. After $OUTPUT has been initialised, any attempt
 * to change something that affects the current theme ($PAGE->course, logged in use,
 * httpsrequried ... will result in an exception.)
 *
 * Please note the $OUTPUT is replacing the old global $THEME object.
 *
 * @global object $OUTPUT
 * @name $OUTPUT
 */
global $OUTPUT;

/**
 * Full script path including all params, slash arguments, scheme and host.
 *
 * Note: Do NOT use for getting of current page URL or detection of https,
 * instead use $PAGE->url or is_https().
 *
 * @global string $FULLME
 * @name $FULLME
 */
global $FULLME;

/**
 * Script path including query string and slash arguments without host.
 * @global string $ME
 * @name $ME
 */
global $ME;

/**
 * $FULLME without slasharguments and query string.
 * @global string $FULLSCRIPT
 * @name $FULLSCRIPT
 */
global $FULLSCRIPT;

/**
 * Relative BSC script path '/course/view.php'
 * @global string $SCRIPT
 * @name $SCRIPT
 */
global $SCRIPT;

// Set httpswwwroot default value (this variable will replace $CFG->wwwroot
// inside some URLs used in HTTPSPAGEREQUIRED pages.
$CFG->httpswwwroot = $CFG->wwwroot;

// If there are any errors in the standard libraries we want to know!
error_reporting(E_ALL | E_STRICT);

// Load up standard libraries
// require_once($CFG->libdir .'/filterlib.php');       // Functions for filtering test as it is output
// require_once($CFG->libdir .'/ajax/ajaxlib.php');    // Functions for managing our use of JavaScript and YUI
// require_once($CFG->libdir .'/weblib.php');          // Functions relating to HTTP and content
// require_once($CFG->libdir .'/outputlib.php');       // Functions for generating output
// require_once($CFG->libdir .'/navigationlib.php');   // Class for generating Navigation structure
// require_once($CFG->libdir .'/dmllib.php');          // Database access
// require_once($CFG->libdir .'/datalib.php');         // Legacy lib with a big-mix of functions.
// require_once($CFG->libdir .'/accesslib.php');       // Access control functions
// require_once($CFG->libdir .'/deprecatedlib.php');   // Deprecated functions included for backward compatibility
// require_once($CFG->libdir .'/moodlelib.php');       // Other general-purpose functions
// require_once($CFG->libdir .'/enrollib.php');        // Enrolment related functions
// require_once($CFG->libdir .'/pagelib.php');         // Library that defines the moodle_page class, used for $PAGE
// require_once($CFG->libdir .'/blocklib.php');        // Library for controlling blocks
// require_once($CFG->libdir .'/eventslib.php');       // Events functions
// require_once($CFG->libdir .'/grouplib.php');        // Groups functions
// require_once($CFG->libdir .'/sessionlib.php');      // All session and cookie related stuff
// require_once($CFG->libdir .'/editorlib.php');       // All text editor related functions and classes
// require_once($CFG->libdir .'/messagelib.php');      // Messagelib functions
// require_once($CFG->libdir .'/modinfolib.php');      // Cached information on course-module instances
//require_once($CFG->dirroot.'/cache/lib.php');       // Cache API

require_once($CFG->dirroot.'/lib/db.php');       // DB connection
require_once($CFG->dirroot.'/vendor/autoload.php');

setup_DB();

if (isset($CFG->debug)) {
    $CFG->debug = (int)$CFG->debug;
    error_reporting($CFG->debug);
}  else {
    $CFG->debug = 0;
}

$CFG->debugdeveloper = (($CFG->debug & DEBUG_DEVELOPER) === DEBUG_DEVELOPER);

if (!defined('BSC_INTERNAL')) { // Necessary because cli installer has to define it earlier.
    /** Used by library scripts to check they are being called by BSC. */
    define('BSC_INTERNAL', true);
}

// Find out if PHP configured to display warnings,
// this is a security problem because some bsc scripts may
// disclose sensitive information.
// if (ini_get_bool('display_errors')) {
//     define('WARN_DISPLAY_ERRORS_ENABLED', true);
// }
// If we want to display BSC errors, then try and set PHP errors to match.
if (!isset($CFG->debugdisplay)) {
    // Keep it "as is" during installation.
} else if (NO_DEBUG_DISPLAY) {
    // Some parts of BSC cannot display errors and debug at all.
    ini_set('display_errors', '0');
    ini_set('log_errors', '1');
} else if (empty($CFG->debugdisplay)) {
    ini_set('display_errors', '0');
    ini_set('log_errors', '1');
} else {
    // This is very problematic in XHTML strict mode!
    ini_set('display_errors', '1');
}
