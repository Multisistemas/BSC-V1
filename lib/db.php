<?php
//	global $CFG;

	function fechaNormal($fecha){
		$nfecha = date('d/m/Y',strtotime($fecha));
		return $nfecha;
	}

	/**
	 * Sets up global $DB bsc_database instance
	 *
	 * @global stdClass $CFG The global configuration instance.
	 * @see config.php
	 * @see config-dist.php
	 * @global stdClass $DB The global moodle_database instance.
	 * @return void|bool Returns true when finished setting up $DB. Returns void when $DB has already been set.
	 */
	function setup_DB() {
	    global $CFG, $DB;

	    if (isset($DB)) {
	        return;
	    }

	    if (!isset($CFG->dbuser)) {
	        $CFG->dbuser = '';
	    }

	    if (!isset($CFG->dbpass)) {
	        $CFG->dbpass = '';
	    }

	    if (!isset($CFG->dbname)) {
	        $CFG->dbname = '';
	    }

	    if (!isset($CFG->dblibrary)) {
	        $CFG->dblibrary = 'native';
	        // use new drivers instead of the old adodb driver names
	        switch ($CFG->dbtype) {
	            case 'postgres7' :
	                $CFG->dbtype = 'pgsql';
	                break;

	            case 'mssql_n':
	                $CFG->dbtype = 'mssql';
	                break;

	            case 'oci8po':
	                $CFG->dbtype = 'oci';
	                break;

	            case 'mysql' :
	                $CFG->dbtype = 'mysqli';
	                break;
	        }
	    }

	    if (!isset($CFG->dboptions)) {
	        $CFG->dboptions = array();
	    }

	    if (isset($CFG->dbpersist)) {
	        $CFG->dboptions['dbpersist'] = $CFG->dbpersist;
	    }

	    // if (!$DB = moodle_database::get_driver_instance($CFG->dbtype, $CFG->dblibrary)) {
	    //     throw new dml_exception('dbdriverproblem', "Unknown driver $CFG->dblibrary/$CFG->dbtype");
	    // }

	    try {
					$DB = $DB = $DB = mysqli_connect($CFG->dbhost, $CFG->dbuser, $CFG->dbpass);
					mysqli_select_db($DB, $CFG->dbname);

//	        $DB->connect($CFG->dbhost, $CFG->dbuser, $CFG->dbpass, $CFG->dbname, $CFG->prefix, $CFG->dboptions);
			} catch (Exception $e) {
	        if (empty($CFG->noemailever) and !empty($CFG->emailconnectionerrorsto)) {
	            $body = "Connection error: ".$CFG->wwwroot.
	                "\n\nInfo:".
	                "\n\tError code: ".$e->errorcode.
	                "\n\tDebug info: ".$e->debuginfo.
	                "\n\tServer: ".$_SERVER['SERVER_NAME']." (".$_SERVER['SERVER_ADDR'].")";
	            if (file_exists($CFG->dataroot.'/emailcount')){
	                $fp = @fopen($CFG->dataroot.'/emailcount', 'r');
	                $content = @fread($fp, 24);
	                @fclose($fp);
	                if((time() - (int)$content) > 600){
	                    //email directly rather than using messaging
	                    @mail($CFG->emailconnectionerrorsto,
	                        'WARNING: Database connection error: '.$CFG->wwwroot,
	                        $body);
	                    // $fp = @fopen($CFG->dataroot.'/emailcount', 'w');
	                    // @fwrite($fp, time());
	                }
	            } else {
	               //email directly rather than using messaging
	               @mail($CFG->emailconnectionerrorsto,
	                    'WARNING: Database connection error: '.$CFG->wwwroot,
	                    $body);
	               // $fp = @fopen($CFG->dataroot.'/emailcount', 'w');
	               // @fwrite($fp, time());
	            }
	        }
	        // rethrow the exception
	        throw $e;
	    }

//	    $CFG->dbfamily = $DB->get_dbfamily(); // TODO: BC only for now

	    return true;
	}

?>
