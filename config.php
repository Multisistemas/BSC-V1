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
	
	$CFG->wwwroot   = 'http://bsc.dev';
	
	// Force a debugging mode regardless the settings in the site administration
	@error_reporting(E_ALL | E_STRICT); // NOT FOR PRODUCTION SERVERS!
	@ini_set('display_errors', '1');    // NOT FOR PRODUCTION SERVERS!
	$CFG->debug = (E_ALL | E_STRICT);   // === DEBUG_DEVELOPER - NOT FOR PRODUCTION SERVERS!
	$CFG->debugdisplay = 1;             // NOT FOR PRODUCTION SERVERS!
	
	require_once(dirname(__FILE__) . '/registros/conexion.php'); // Do not edit