<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 @ function get keys instal for require database
 @ if null cannot load database on application 
 **/

define('FRAMEWORK', 'E.U.I');
 
define('EUI_VERSION', '1.0.0');
define('COMPANY',' RAZAKI TECHNOLOGY, Inc.');
 
/**
 @ function get keys instal for require database
 @ if null cannot load database on application 
 **/
 
require( BASEPATH.'core/EUI_Namespace.php' );

/**
 @ load namespace & register
 @
 **/
 
$ob_ui_class =& EUI_Namespace::Register();

/**
 @ load common file 
 $ important  
 **/

//require( BASEPATH.'core/EUI_Common.php' ); 
$ob_ui_class->core('EUI_Common');


/**
 @ function get keys instal for require database
 @ if null cannot load database on application 
 **/
 
$ob_ui_class->config('EUI_Constant');
/**
 *@ load class on common & 
 *@ return by object  
 */
/*
 * ------------------------------------------------------
 *  Define a custom error handler so we can log PHP errors
 * ------------------------------------------------------
 */
	set_error_handler('_exception_handler');

	if ( ! is_php('5.3'))
	{
		@set_magic_quotes_runtime(0); // Kill magic quotes
	}

	
   
   if (isset($assign_to_config['subclass_prefix']) AND $assign_to_config['subclass_prefix'] != '')
	{
		get_config(array('subclass_prefix' => $assign_to_config['subclass_prefix']));
	}

/*
 | ------------------------------------------------------
 |  Set a liberal script execution time limit
 | ------------------------------------------------------
 */
 
if (function_exists("set_time_limit") == TRUE AND @ini_get("safe_mode") == 0)
{
	@set_time_limit(300);
}

/*
 | ------------------------------------------------------
 |  iniated Benchmark
 | ------------------------------------------------------
 */

 $BM =& load_class('Benchmark', 'core');
 $BM -> mark('total_execution_time_start');
 $BM -> mark('loading_time:_base_classes_start');


/*
 | ------------------------------------------------------
 |  iniated Hooks
 | ------------------------------------------------------
 */
 
 $EXT =& load_class('Hooks', 'core');

/*
 * ------------------------------------------------------
 *  Is there a "pre_system" hook?
 * ------------------------------------------------------
 */
 
 $EXT->_call_hook('pre_system');
	
/*
 | ------------------------------------------------------
 |  iniated Config load all configuration
 | ------------------------------------------------------
 */
 
 $CFG =& load_class('Config', 'core');

/*  Do we have any manually set config items in the index.php file? **/

 if (isset($assign_to_config))
 {
	$CFG->_assign_to_config($assign_to_config);
 }
 
 
/*
 | ------------------------------------------------------
 |  iniated Config load all configuration
 | ------------------------------------------------------
 */
 
 $UNI =& load_class('Utf8', 'core');
 $URI =& load_class('URI', 'core');	
 $RTR =& load_class('Router', 'core');
 
 $RTR->_set_routing();

// Set any routing overrides that may exist in the main index file

if (isset($routing))
	{
		$RTR->_set_overrides($routing);
	}


/*
 | ------------------------------------------------------
 |  iniated Output class
 | ------------------------------------------------------
 */

 $OUT =& load_class('Output', 'core');

 
/*
 | ------------------------------------------------------
 |  Is there a valid cache file?  If so, we're done...
 | ------------------------------------------------------
 */
 
 if ($EXT->_call_hook('cache_override') === FALSE)
	{
		if ($OUT->_display_cache($CFG, $URI) == TRUE)
		{
			exit;
		}
	}

/*
 | ------------------------------------------------------
 | Load the security class for xss and csrf support
 | ------------------------------------------------------
 */
 
 $SEC =& load_class('Security', 'core');

/*
 | ------------------------------------------------------
 | Load the Input class and sanitize globals
 | ------------------------------------------------------
 */
 
 $IN	=& load_class('Input', 'core');

/*
 | ------------------------------------------------------
 | Load the Language class
 | ------------------------------------------------------
 */
 
 $LANG =& load_class('Lang', 'core');

 /*
 | ------------------------------------------------------
 | function get keys instal for require database
 | if null cannot load database on application 
 | ------------------------------------------------------
 */
 
 EUI_Namespace::core('EUI_Keys');
 EUI_Namespace::core('EUI_Controller');
 
/*
 |-----------------------------------------------------
 | function get keys instal for require database
 | if null cannot load database on application 
 | -----------------------------------------------------
 */
 
function &KeyInstall() {
	return EUI_Keys::get_instance();
}

/*
 | ------------------------------------------------------
 |  Load the app controller and local controller
 | ------------------------------------------------------
 */	

function &get_instance()
{
	return EUI_Controller::get_instance();
}
/*
 | ------------------------------------------------------
 |  iniated layout thems from configuration
 | ------------------------------------------------------
 */
 
 $LYT =& load_class('Layout', 'core');  


/*
 | ------------------------------------------------------
 |  Load the app controller and local controller
 | ------------------------------------------------------
 */	
 
if(file_exists(APPPATH.'core/'.$CFG->config['subclass_prefix'].'Controller.php')) {
	require APPPATH.'core/'.$CFG->config['subclass_prefix'].'Controller.php';
}

/*
 | ------------------------------------------------------
 |  Load the app controller and local controller
 | ------------------------------------------------------
 | Load the local application controller
 | Note: The Router class automatically validates the controller path using the router->_validate_request().
 | If this include fails it means that the default controller in the Routes.php file is not resolving to something valid.
 */	
 
if ( ! file_exists(APPPATH.'controller/'.$RTR->fetch_directory().$RTR->fetch_class().'.php'))
{
	show_error('Unable to load your default controller. Please make sure the controller specified in your Routes.php file is valid.//'. __FILE__ .':'. __LINE__);
}
	
/*
 | ------------------------------------------------------
 |  load default first controller
 | ------------------------------------------------------
 */	
 
 include(APPPATH.'controller/'.$RTR->fetch_directory().$RTR->fetch_class().'.php');

/*
 | ------------------------------------------------------
 | Load Class Rout && set to default controller 
 | then load fisrt method( default : index every controller ) 
 | " katanya kata yang buat ..."
 | ------------------------------------------------------
 */	
 
 $class  = $RTR -> fetch_class();
 $method = $RTR -> fetch_method();
 
 if (!class_exists($class) OR strncmp($method, '_', 1) == 0 
	 OR in_array(strtolower($method), array_map('strtolower', get_class_methods('EUI_Controller'))) )
 {
	show_404("{$class}/{$method}");
 }
 
/*
 |-----------------------------------------------------------------
 | create New object name EUI Modul this will be parent for all class 
 | yups is class "DEWA"
 |-----------------------------------------------------------------
 */ 

 $EUI = new $class();
 
 /*
 |-----------------------------------------------------------------
 | create User Definition Label 
 | yups is class "DEWA"
 |-----------------------------------------------------------------
 */ 

 $LYT -> UserDefinition();
 $LYT -> QulitySkill();
 
/*
 | ------------------------------------------------------
 |  Call the requested method
 | ------------------------------------------------------
 | Is there a "remap" function? If so, we call it instead
 */
 
 if (method_exists($EUI, '_remap')) {
	$EUI -> _remap($method, array_slice( $URI -> rsegments, 2));
 }
 else
 {
	// is_callable() returns TRUE on some versions of PHP 5 for private and protected
	// methods, so we'll use this workaround for consistent behavior
	if ( ! in_array(strtolower($method), array_map('strtolower', get_class_methods($EUI))))
	{
		// Check and see if we are using a 404 override and use it.
		if ( ! empty( $RTR->routes['404_override']))
		{
			$x = explode('/', $RTR->routes['404_override']);
			$class = $x[0];
			$method = (isset($x[1]) ? $x[1] : 'index');
			
			if ( ! class_exists($class))
			{
				if ( ! file_exists(APPPATH.'controller/'.$class.'.php'))
				{
					show_404("{$class}/{$method}");
				}
				include_once(APPPATH.'controller/'.$class.'.php');
				unset($EUI);
				$EUI = new $class();
			}
		}
		else
		{
			show_404("{$class}/{$method}");
		}
	}
	
	/* 
	 | Call the requested method.
	 | Any URI segments present (besides the class/function) will be passed to the method for convenience
	 |
	 */
	 
	call_user_func_array(array(&$EUI, $method), array_slice($URI->rsegments, 2));
}
	
/*
 * ------------------------------------------------------
 *  Is there a "post_controller" hook?
 * ------------------------------------------------------
 */
	$EXT->_call_hook('post_controller');

/*
 * ------------------------------------------------------
 *  Send the final rendered output to the browser
 * ------------------------------------------------------
 */
	if ($EXT->_call_hook('display_override') === FALSE)
	{
		$OUT->_display();
	}

/*
 * ------------------------------------------------------
 *  Is there a "post_system" hook?
 * ------------------------------------------------------
 */
	$EXT->_call_hook('post_system');
	
/*
 * ------------------------------------------------------
 *  Close the DB connection if one exists
 * ------------------------------------------------------
 */
	if (class_exists('EUI_DB') AND isset($EUI->db))
	{
		$EUI->db->close();
	}

	
// END OF FILE 
?>
