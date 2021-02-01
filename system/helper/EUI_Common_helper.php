<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// ------------------------------------------------------------------------

/**
 * Header Redirect
 *
 * Header redirect in two flavors
 * For very fine grained control over headers, you could use the Output
 * Library's set_header() function.
 *
 * @access	public
 * @param	string	the URL
 * @param	string	the method: location or redirect
 * @return	string
 */
 
if ( ! function_exists('Singgleton')) 
{
	function Singgleton( $StdClass = null, $access = 'Instance')
	{	
		if( is_object($StdClass) ){
			$StdClass = base_class_model($StdClass);
		}
		
		$arr_aksesor = array('Instance', 'get_instance');
		$Singgleton = NULL;
		
		// --- will search ----------------------
		
		if( is_array($arr_aksesor)) 
			foreach( $arr_aksesor as $key => $Instance  )
		{
			if( class_exists( $StdClass ) AND method_exists($StdClass, $Instance) ){
				$Singgleton =& call_user_func(array( $StdClass, $Instance ));
				if( is_null( $Singgleton ) ){
					$Singgleton =& Singgleton($StdClass,  $Instance);
				} 
			}
		}
		
		return $Singgleton;
	}
}

// ------------------------------------------------------------------------

/**
 * Header Redirect
 *
 * Header redirect in two flavors
 * For very fine grained control over headers, you could use the Output
 * Library's set_header() function.
 *
 * @access	public
 * @param	string	the URL
 * @param	string	the method: location or redirect
 * @return	string
 */
 
if ( ! function_exists('Instance')) 
{
	function Instance( $StdClass = null, $access = 'Instance')
	{	
		$arr_aksesor = array('Instance', 'get_instance');
		$Singgleton = NULL;
		
		// --- will search ----------------------
		
		if( is_array($arr_aksesor)) 
			foreach( $arr_aksesor as $key => $Instance  )
		{
			if( class_exists( $StdClass ) AND method_exists($StdClass, $Instance) ){
				$Singgleton =& call_user_func(array( $StdClass, $Instance ));
				if( is_null( $Singgleton ) ){
					$Singgleton =& Singgleton($StdClass,  $Instance);
				} 
			}
		}
		
		return $Singgleton;
	}
}



// ------------------------------------------------------------------------
/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
 

 if(!function_exists('Objective') ) 
 {
   function Objective( $data = null ) 
 {
	$out =& get_instance();
	if( !class_exists('EUI_Object') ){
		$out->load->helper(array('EUI_Object'));	
	}
	
	$Objective = new EUI_Object( $data );
	return $Objective;
	
  }
}


// ------------------------------------------------------------------------

/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
 
if ( ! function_exists('ObjectRequest'))
{
	function ObjectRequest() {
		if(!class_exists('EUI_Object') )
		{
			$CI =& get_instance();
			$CI->load->helper(array('EUI_Object'));
		}	
		return new EUI_Object( _get_all_request() );
	}
}


// ------------------------------------------------------------------------

/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
 
if ( ! function_exists('ObjectSession'))
{
	function ObjectSession() {
		if(!class_exists('EUI_Object') )
		{
			$CI =& get_instance();
			$CI->load->helper(array('EUI_Object'));
		}	
		return new EUI_Object( _get_real_session() );
	}
}

/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
 if ( ! function_exists('Config')) 
 {
   function Config()
  {	 
	$CI =& CI();
	$CI->load->helper(array('EUI_Object'));
	if( is_array( $CI->Config->config ) ){
		return new EUI_Object( $CI->Config->config );	
	}
	return new EUI_Object(array());
  }
}


// ------------------------------------------------------------------------

/**
 * Create URL Title
 *
 * Takes a "title" string as input and creates a
 * human-friendly URL string with either a dash
 * or an underscore as the word separator.
 *
 * @access	public
 * @param	string	the string
 * @param	string	the separator: dash, or underscore
 * @return	string
 */
 
if( ! function_exists('get_class_model') ) 
{
  function get_class_model($this=null)
 {
	$_suffix = 'M_'; $_class = null; 
	if( !is_null($this) ) {
		$_class = $_suffix . get_class($this);
	}
	else{
		show_error("No Model redirect");
	}	
	
	return ( !is_null($_class) ?  $_class : null );
  }
}


// ------------------------------------------------------------------------

/**
 * Header Redirect
 *
 * Header redirect in two flavors
 * For very fine grained control over headers, you could use the Output
 * Library's set_header() function.
 *
 * @access	public
 * @param	string	the URL
 * @param	string	the method: location or redirect
 * @return	string
 */
 
if ( ! function_exists('get_class_instance')) 
{
	function get_class_instance($class_name = null, $access = 'Instance')
	{	
		
		if(!in_array($access, array('Instance', 'get_instance') ) ) {
			return FALSE;
		}
		
		$class_instance = null;
		if( !is_null($class_name) 
			AND class_exists($class_name) )	
		{
			$class_instance =& call_user_func(array( $class_name, $access ));
		}
		
		return $class_instance;
	}
}



// ------------------------------------------------------------------------

/**
 * Header Redirect
 *
 * Header redirect in two flavors
 * For very fine grained control over headers, you could use the Output
 * Library's set_header() function.
 *
 * @access	public
 * @param	string	the URL
 * @param	string	the method: location or redirect
 * @return	string
 */
 
if ( ! function_exists('get_class_method')) 
{
	function is_class_method($class=null, $method = null )
	{	
		if( method_exists($class,$method) ){
			return true;
		} else {
			return FALSE;
		}
		
	}
}


// ------------------------------------------------------------------------

/**
 * Header Redirect
 *
 * Header redirect in two flavors
 * For very fine grained control over headers, you could use the Output
 * Library's set_header() function.
 *
 * @access	public
 * @param	string	the URL
 * @param	string	the method: location or redirect
 * @return	string
 */
 
if( !function_exists('base_temp') )
{
   function base_temp()
 {
	$base_temp = str_replace("system/", "application/temp", BASEPATH);
	if(is_dir($base_temp)  ){
		return $base_temp;
	}else {
		return FALSE;
	}
 }

}


// ------------------------------------------------------------------------

/**
 * Create URL Title
 *
 * Takes a "title" string as input and creates a
 * human-friendly URL string with either a dash
 * or an underscore as the word separator.
 *
 * @access	public
 * @param	string	the string
 * @param	string	the separator: dash, or underscore
 * @return	string
 */
 
if( ! function_exists('base_class_model') ) 
{
  function base_class_model($this=null)
 {
	$_suffix = 'M_'; $_class = null; 
	if( !is_null($this) ) {
		$_class = $_suffix . get_class($this);
	}
	else{
		show_error("No Model redirect");
	}	
	
	return ( !is_null($_class) ?  $_class : null );
  }
}



// ------------------------------------------------------------------------

/**
 * Create EventLoger
 *
 * @ package -- Use this parameters -- :
	
	ADD : 'ACTION_EVENT_ADD',
	DEL : 'ACTION_EVENT_DELETE',
	UPD : 'ACTION_EVENT_UPDATE',
	DIS : 'ACTION_EVENT_DISABLE',
	ENB : 'ACTION_EVENT_ENABLE',
	REG : 'ACTION_EVENT_REGISTER',
	OUT : 'ACTION_EVENT_LOGOUT',
	INC : 'ACTION_EVENT_LOGIN',
	REF : 'ACTION_EVENT_REFRESH',
	CNL : 'ACTION_EVENT_CANCEL'
	
 @ param 	$Eevent (string)
 @ param 	$Desc (string)
 
 */
 
if( ! function_exists('EventLoger') ) 
{
  function EventLoger( $Event =null, $Desc = '')
 {
	$Evt =& get_instance();
	$Evt->load->model(array('M_EventLoger'));
	
	 if( class_exists('M_EventLoger') )
	{
		$EventLoger =& get_class_instance('M_EventLoger');
		$EventLoger->_EventLoger($Event, $Desc);
	}
	
	return (bool)TRUE;	
  }
}
 
// ------------------------------------------------------------------------

/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
 
if ( ! function_exists('UR')){
	function UR() {
		return ObjectRequest();
	}
}

/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
if ( ! function_exists('FL')){
	function FL() {
		return Objective( $_FILES);
	}
}



// ------------------------------------------------------------------------

/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
if ( ! function_exists('CI')){
	function CI() {
		return get_instance();
	}
}


// ------------------------------------------------------------------------

/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
if ( ! function_exists('CK')){
	function CK() {
		return ObjectSession();
	}
}

// ------------------------------------------------------------------------
/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
 
if ( ! function_exists('SL')) {
	function SL(){
		$CI =& CI();
		return $CI->EUI_Session;
	}
}
// ------------------------------ end helper --------------------------------------
 
 ?>