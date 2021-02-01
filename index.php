<?php
//date_default_timezone_set('Asia/Jakarta');

//echo date("Y-m-d H:i:s");
/*
 * @ def 	    : core && application folder 
 *
 * @ param 		: array 	
 * @ return 	: object
 * @ aksess		: public 
 */
 
$system_path = 'system';
$application_folder = 'application';

/*//
 * @ def 	    : define of product to deplovment process 
 *
 * @ param 		: array 	
 * @ return 	: object
 * @ aksess		: public 
 */

if(!defined('PRODUCT')) define('PRODUCT','portofolio');

/*
 * @ def 	    : define of product to deplovment process 
 *
 * @ param 		: array 	
 * @ return 	: object
 * @ aksess		: public 
 */
if(!defined('ENVIRONMENT')) define('ENVIRONMENT','DEPLOVMENT');
//if(!defined('ENVIRONMENT')) define('ENVIRONMENT','PRODUCTION');




/*
 * @ def 	    : define of product to deplovment process 
 *
 * @ param 		: array 	
 * @ return 	: object
 * @ aksess		: public 
 */
if(!defined('LAYOUT')) define('LAYOUT','hsbctele');

/*
 * @ def 	    : Set the current directory correctly for CLI requests
 *
 * @ param 		: array 	
 * @ return 	: object
 * @ aksess		: public 
 */

if (defined('STDIN')) {
	chdir(dirname(__FILE__));
}

/*
 * @ def 	    : Set the current directory correctly for CLI requests
 *
 * @ param 		: array 	
 * @ return 	: object
 * @ aksess		: public 
 */

if (realpath($system_path) !== FALSE) {
	$system_path = realpath($system_path).'/';
}

/*
 * @ def 	    : ensure there's a trailing slash
 *
 * @ param 		: array 	
 * @ return 	: object
 * @ aksess		: public 
 */

$system_path = rtrim($system_path, '/').'/';

/*
 * @ def 	    : Is the system path correct?
 *
 * @ param 		: array 	
 * @ return 	: object
 * @ aksess		: public 
 */

if ( ! is_dir($system_path))
{
	exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
}

/*
 * @ def 	    : The name of THIS file
 *
 * @ param 		: array 	
 * @ return 	: object
 * @ aksess		: public 
 */

define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
	
/*
 * @ def 	    : The PHP file extension 
 *
 * @ param 		: array 	
 * @ return 	: object
 * @ aksess		: public 
 */


define('EXT', '.php');

/*
 * @ def 	    : Path to the system folder 
 *
 * @ param 		: array 	
 * @ return 	: object
 * @ aksess		: public 
 */


define('BASEPATH', str_replace("\\", "/", $system_path));

/*
 * @ def 	    : Path to the front controller (this file) 
 *
 * @ param 		: array 	
 * @ return 	: object
 * @ aksess		: public 
 */


define('FCPATH', str_replace(SELF, '', __FILE__));

/*
 * @ def 	    : Name of the "system folder"
 *
 * @ param 		: array 	
 * @ return 	: object
 * @ aksess		: public 
 */
define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));

/*
 * @ def 	    : The path to the "application" folder
 *
 * @ param 		: array 	
 * @ return 	: object
 * @ aksess		: public 
 */

 if (is_dir($application_folder)) { define('APPPATH', $application_folder.'/'); }
 else 
 {
	if ( ! is_dir(BASEPATH.$application_folder.'/')) 
	{
		exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: ".SELF);
	}
	define('APPPATH', BASEPATH.$application_folder.'/');
 }

/*
 * --------------------------------------------------------------------
 * @ LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 * @ And away we go...
 *
 */
 
require_once BASEPATH.'core/EnigmaUI.php';


/* End of file index.php */
/* Location: ./index.php */