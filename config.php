<?php
	unset($CFG);
	global $CFG;
	$CFG = new stdClass();

	$CFG->dbtype    = 'mysqli';     // 'pgsql', 'mariadb', 'mysqli', 'mssql', 'sqlsrv' or 'oci'
	$CFG->dblibrary = 'native';    // 'native' only at the moment
	$CFG->dbhost    = 'localhost'; // eg 'localhost' or 'db.isp.com' or IP
	$CFG->dbname    = 'bsc';       // database name, eg moodle
	$CFG->dbuser    = 'root';      // your database username
	$CFG->dbpass    = 'toor';      // your database password
	$CFG->prefix    = 'bsc_';      // prefix to use for all table names

	$CFG->wwwroot   = 'http://bsc.localhost';
	$CFG->dirroot   = dirname(__FILE__);

	// Force a debugging mode regardless the settings in the site administration

	@error_reporting(E_ALL | E_STRICT); // NOT FOR PRODUCTION SERVERS!
	@ini_set('display_errors', '1');    // NOT FOR PRODUCTION SERVERS!
	$CFG->debug = (E_ALL | E_STRICT);   // === DEBUG_DEVELOPER - NOT FOR PRODUCTION SERVERS!
	$CFG->debugdisplay = 1;             // NOT FOR PRODUCTION SERVERS!
	
	$CFG->googlesso = false;
	$CFG->googleid = '1072044933752-uon5ggg95c89e7l2q0uv8jqmgena397n.apps.googleusercontent.com';
	$CFG->googlesecret = 'ZfgLDRlFY3hSBR0xw54-cSY0';


	require_once(dirname(__FILE__) . '/lib/setup.php'); // Do not edit and always last line.
