<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 ** EUI Framework 
 **/
class EUI_Exceptions {

 var $action;
 var $severity;
 var $message;
 var $filename;
 var $line;
 var $ob_level;
 var $levels = array();
	
/*
 * @ def   	 : Constructor
 * ---------------------------------------
 * 
 * @ param   : php_error()
 * @ aksess  : public
 */
 
	public function __construct()
	{
		$this -> _level();
		$this -> ob_level = ob_get_level();
		// Note:  Do not log messages from this constructor.
	}
	
/*
 * @ def   	 : Constructor
 * ---------------------------------------
 * 
 * @ param   : php_error()
 * @ aksess  : public
 */
 	
	private function _level()
	{
		$this -> levels[E_ERROR] 		 	= 'Error';
		$this -> levels[E_WARNING] 		 	= 'Warning';
		$this -> levels[E_PARSE] 		 	= 'Parsing Error';
		$this -> levels[E_NOTICE] 		 	= 'Notice';
		$this -> levels[E_CORE_ERROR] 	 	= 'Core Error';
		$this -> levels[E_CORE_WARNING]  	= 'Core Warning';
		$this -> levels[E_COMPILE_ERROR]  	= 'Compile Error';
		$this -> levels[E_COMPILE_WARNING] 	= 'Compile Warning';
		$this -> levels[E_USER_ERROR] 		= 'User Error';
		$this -> levels[E_USER_WARNING] 	= 'User Warning';
		$this -> levels[E_USER_NOTICE] 		= 'User Notice';
		$this -> levels[E_STRICT] 			= 'Runtime Notice';
	
	}
	
	
/*
 * @ def   	 : Constructor
 * ---------------------------------------
 * 
 * @ param   : php_error()
 * @ aksess  : public
 */
 	
function log_exception($severity, $message, $filepath, $line)
{
	$severity = ( ! isset($this->levels[$severity])) ? $severity : $this->levels[$severity];
	log_message('error', 'Severity: '.$severity.'  --> '.$message. ' '.$filepath.' '.$line, TRUE);
}

/*
 * @ def   	 : show_402 error Definition locale files 
 * ---------------------------------------
 * 
 * @ param   : php_error()
 * @ aksess  : public
 */
 	
public function show_402( $heading, $message, $template = 'error_general', $status_code = 500 )
{
	set_status_header($status_code);
	$version =  FRAMEWORK .'&nbsp;'; 
	
	$message = '<p>'.implode('</p><p>', (!is_array($message)) ? array($message) : $message).'</p>';
	
	if (ob_get_level() > $this->ob_level + 1){
		ob_end_flush();
	}
	
	ob_start();
	include(APPPATH . "errors/{$template}.php");
	$buffer = ob_get_contents();
	ob_end_clean();
}	
		
		
/*
 * @ def   	 : Constructor
 * ---------------------------------------
 * 
 * @ param   : php_error()
 * @ aksess  : public
 */
 
 function show_404($page = '', $log_error = TRUE)
 {
	$version =  FRAMEWORK .'&nbsp;'; 
	$heading = "404 Page Not Found";
	$message = "The page you requested was not found.";
	
	// By default we log this, but allow a dev to skip it
	if ($log_error)
	{
		log_message('error', '404 Page Not Found --> '.$page);
	}

	echo $this->show_error($heading, $message, 'error_404', 404);
	exit;
}
	
/*
 * @ def   	 : Constructor
 * ---------------------------------------
 * 
 * @ param   : php_error()
 * @ aksess  : public
 */
 	
 function show_error($heading, $message, $template = 'error_general', $status_code = 500)
 {
	set_status_header($status_code);
	$version =  FRAMEWORK .'&nbsp;'; 
	$message = '<p>'.implode('</p><p>', ( ! is_array($message)) ? array($message) : $message).'</p>';
	
	if (ob_get_level() > $this->ob_level + 1)
	{
		ob_end_flush();
	}
	
	ob_start();
		
	
	if( ENVIRONMENT=='DEPLOVMENT') 
			include(APPPATH.'errors/'.$template.'.php');
		
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
}

//-------------------------------------------------------------------------------------------------

/*
 * @ def   	 : Constructor
 * ---------------------------------------
 * 
 * @ param   : php_error()
 * @ aksess  : public
 */
 
  public function show_version_page( $derror_page = null , $template="error_dbpg")
 {
	if( $derror_page ) {
		$error_page = $derror_page;
	}
	
	$error_file_version = join("", array("", APPPATH, join("/", array("errors","${template}.php"))));
	if( file_exists( $error_file_version ) ) {
		include($error_file_version);
	}
	return FALSE;
}

//-------------------------------------------------------------------------------------------------

/*
 * @ def   	 : Constructor
 * ---------------------------------------
 * 
 * @ param   : php_error()
 * @ aksess  : public
 */
 
 public  function show_error_page( $derror_page = null , $template="error_dbpg")
{
	$error_page = array();
	
    if( $derror_page )
	{
		$error_page = $derror_page;
	}
	
	if( file_exists( APPPATH . "errors/${template}.php" ) 
		AND ENVIRONMENT=='DEPLOVMENT' )
	{
		include(APPPATH . "errors/${template}.php");
	}
	
	return FALSE;
}
	
/*
 * @ def   	 : Constructor
 * ---------------------------------------
 * 
 * @ param   : php_error()
 * @ aksess  : public
 */
 
	function show_php_error($severity, $message, $filepath, $line)
	{
		$version =  FRAMEWORK .'&nbsp;'; 
		$severity = (!isset($this->levels[$severity])) ? $severity : $this->levels[$severity];
		$filepath = str_replace("\\", "/", $filepath);

		// For safety reasons we do not show the full file path
		if (FALSE !== strpos($filepath, '/'))
		{
			$x = explode('/', $filepath);
			$filepath = $x[count($x)-2].'/'.end($x);
		}
		
		
		if (ob_get_level() > $this->ob_level + 1) {
			ob_end_flush();
		}
		
		ob_start();
		
		if( ENVIRONMENT=='DEPLOVMENT') 
			include(APPPATH.'errors/error_php.php');
		
		$buffer = ob_get_contents();
		ob_end_clean();
		echo $buffer;
	}
}
?>