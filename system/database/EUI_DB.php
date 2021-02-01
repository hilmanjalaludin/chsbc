<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function &EUI_DB($params = '', $active_record_override = NULL)
{
	
	if (is_string($params) AND strpos($params, '://') === FALSE)
	{
		$_keys =& KeyInstall(); 
		
		// var_dump( $_keys -> get_keys_install( BASEPATH.'keys' ) );	
		
		if ( ! defined('ENVIRONMENT') OR ! file_exists($file_path = BASEPATH.'keys/'.ENVIRONMENT.'/'.$_keys -> _get_eui_keys().'.ini')) {
			if ( ! file_exists($file_path = BASEPATH.'keys/'. $_keys -> _get_eui_keys().'.ini')) {
				show_error('The configuration file '.$file_path.' does not exist.');
			}
		}
		
		$db = $_keys -> get_keys_install( BASEPATH.'keys' );
		
		
		if ( ! isset($db) OR count($db) == 0) {
			show_error('No database connection settings were found in the database config file.');
		}
		
		if ($params != '') {
			$active_group = $params;
		}
		
		if ( ! isset($db)) {
			show_error('You have specified an invalid database connection group.');
		}

		$params = $db;
	}
	
	
	// No DB specified yet?  Beat them senseless...
	if ( ! isset($params['EUI_DB_driver']) OR $params['EUI_DB_driver'] == '') {
		show_error('You have not selected a database type to connect to.');
	}

	// Load the DB classes.  Note: Since the active record class is optional
	// we need to dynamically create a class that extends proper parent class
	// based on whether we're using the active record class or not.
	// Kudos to Paul for discovering this clever use of eval()

	if ($active_record_override !== NULL){
		$active_record = $active_record_override;
	}
	
	require_once(BASEPATH.'database/EUI_DB_driver.php');

	if ( ! isset($active_record) OR $active_record == TRUE) {
		require_once(BASEPATH.'database/EUI_DB_active_rec.php');

		if ( ! class_exists('EUI_DB')) {
			eval('class EUI_DB extends EUI_DB_active_record { }');
		}
	}
	else 
	{
		if ( ! class_exists('EUI_DB')){
			eval('class EUI_DB extends EUI_DB_driver { }');
		}
	}
	
	require_once(BASEPATH.'database/adapter/EUI_'.$params['EUI_DB_driver'].'_driver.php');
	
	// Instantiate the DB adapter || EUI_DB_mssql_driver | EUI_DB_mysql_driver
	$driver = 'EUI_DB_'.$params['EUI_DB_driver'].'_driver';
	$DB = new $driver($params);
	
	if ($DB->autoinit == TRUE)
	{
		$DB->initialize();
	}
	if (isset($params['stricton']) && $params['stricton'] == TRUE)
	{
		$DB->query('SET SESSION sql_mode="STRICT_ALL_TABLES"');
	}
	
	return $DB;
}



/* End of file DB.php */
/* Location: ./system/database/DB.php */