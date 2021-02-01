<?php
/* @ def 	: E.U.I Session Helper base on EUI_Session libraries 
 * ---------------------------------------------------------------
 * @ param 	: modified
 * @ author : omens
 */
 
// ------------------------------------------------------------
 
/* @ def 	: _have_get_session base on views type 
 * ---------------------------------------------------------------
 * @ param 	: modified
 * @ author : omens
 */
 
if( !function_exists('_have_get_session') )
{
	function _have_get_session($param)
	{
		$EUI =& get_instance();
		return $EUI -> EUI_Session -> _have_get_session($param);
	}
} 


// ------------------------------------------------------------
 
/* @ def 	: _get_session base on views type 
 * ---------------------------------------------------------------
 * @ param 	: modified
 * @ author : omens
 */
 
if( !function_exists('_get_session') )
{
	function _get_session($param)
	{
		$EUI =& get_instance();
		return mysql_real_escape_string($EUI->EUI_Session->_get_session($param));
	}
} 

// ------------------------------------------------------------
 
/* @ def 	: _get_session base on views type 
 * ---------------------------------------------------------------
 * @ param 	: modified
 * @ author : omens
 */
 if( !function_exists('_deleted_session') )
{
	function _deleted_session($param)
	{
		$EUI =& get_instance();
		return $EUI -> EUI_Session -> _unset_session($param);
	}
} 
// ------------------------------------------------------------
 
/* @ def 	: _get_session base on views type 
 * ---------------------------------------------------------------
 * @ param 	: modified
 * @ author : omens
 */
 if( !function_exists('_get_exist_session') )
{
	
	function _get_exist_session($param)
	{
		$EUI =& get_instance();
		return (_have_get_session($param)? _get_session($param): mysql_real_escape_string($EUI->URI-> _get_post($param)) );
	}
}


// ------------------------------------------------------------
 
/* @ def 	: _get_session base on views type 
 * ---------------------------------------------------------------
 * @ param 	: modified
 * @ author : omens
 */
 
if( !function_exists('_set_key_session') ){
	
	function _set_key_session( $session = null  )
	{
		$EUI =& get_instance();
		return $EUI->EUI_Session->_set_key_session( $session );
	}
}
// ------------------------------------------------------------
 
/* @ def 	: _get_session base on views type 
 * ---------------------------------------------------------------
 * @ param 	: modified
 * @ author : omens
 */
 
if( !function_exists('_destroy_session') ){
	
	function _destroy_session( $session = null  )
	{
		$EUI =& get_instance();
		return $EUI->EUI_Session->_destroy_session();
	}
}


// ------------------------------------------------------------
 
/* @ def 	: _get_session base on views type 
 * ---------------------------------------------------------------
 * @ param 	: modified
 * @ author : omens
 */
 
 if( ! function_exists('_get_real_session') )
{
	
	function _get_real_session()
	{
		$EUI =& get_instance();
		return $EUI->EUI_Session->get_real_session();
	}
}
// ------------------------------------------------------------
 
/* @ def 	: _have_get_session base on views type 
 * ---------------------------------------------------------------
 * @ param 	: modified
 * @ author : omens
 */
 
if( !function_exists('_get_is_login') )
{
	function _get_is_login()
	{
		$EUI =& get_instance();
		return $EUI->EUI_Session->_have_get_session("UserId");
	}
} 

// ------------------------------------------------------------
 
/* @ def 	: _have_get_session base on views type 
 * ---------------------------------------------------------------
 * @ param 	: modified
 * @ author : omens
 */
 
if( !function_exists('_set_session') )
{
	function _set_session($name, $value)
	{
		$EUI =& get_instance();
		return $EUI->EUI_Session->_set_session($name, $value);
	}
} 

// ------------------------------------------------------------
 
/* @ def 	: _have_get_session base on views type 
 * ---------------------------------------------------------------
 * @ param 	: modified
 * @ author : omens
 */
 
if( !function_exists('get_cokie_cond') )
{
	function get_cokie_cond( $key='' ) {
		return _have_get_session( $key );
	}
} 

// ------------------------------------------------------------
 
/* @ def 	: _have_get_session base on views type 
 * ---------------------------------------------------------------
 * @ param 	: modified
 * @ author : omens
 */
 
if( !function_exists('get_cokie_value') )
{
	function get_cokie_value( $key='', $call= null ) {
		return _get_session( $key, $call);
	}
} 


// ------------------------------------------------------------
 
/* @ def 	: _have_get_session base on views type 
 * ---------------------------------------------------------------
 * @ param 	: modified
 * @ author : omens
 */
 
if( !function_exists('get_cokie_array') )
{
	function get_cokie_array( $key='', $call= null ) 
	{
		$lst = _get_session( $key, $call); $value = array();
		foreach( explode(",", $lst) as $k => $val ){
			$value[$val] = $val;	
		}
		return (array)$value;
	}
} 


// ------------------------------------------------------------
 
/* @ def 	: _have_get_session base on views type 
 * ---------------------------------------------------------------
 * @ param 	: modified
 * @ author : omens
 */
 
if( !function_exists('set_cokie_begin') )
{
	function set_cokie_begin() {
		session_start();
		return true;
	}
} 

// ------------------------------------------------------------
 
/* @ def 	: _have_get_session base on views type 
 * ---------------------------------------------------------------
 * @ param 	: modified
 * @ author : omens
 */
 
if( !function_exists('set_cokie_destroy') )
{
	function set_cokie_destroy()
	{
		$EUI =& get_instance();
		return $EUI->EUI_Session->_destroy_session();
	}
} 


// ------------------------------------------------------------
 
/* @ def 	: _have_get_session base on views type 
 * ---------------------------------------------------------------
 * @ param 	: modified
 * @ author : omens
 */
 
if( !function_exists('set_cokie_replace') )
{
	function set_cokie_replace( $key = null, $value = '' ) {
		$EUI =& get_instance();
		return $EUI->EUI_Session->replace_session($key, $value);
	}
} 
// ------------------------------------------------------------
 
/* @ def 	: _have_get_session base on views type 
 * ---------------------------------------------------------------
 * @ param 	: modified
 * @ author : omens
 */
 
if( !function_exists('set_cokie_delete') )
{
	function set_cokie_delete( $value)
	{
		$EUI =& get_instance();
		return $EUI -> EUI_Session -> _unset_session($value);
	}
} 

// ------------------------------------------------------------
 
/* @ def 	: _have_get_session base on views type 
 * ---------------------------------------------------------------
 * @ param 	: modified
 * @ author : omens
 */
 
if( !function_exists('set_cokie_keys') )
{
	function set_cokie_keys( $key = '' ) {
		return _set_key_session( $key );
	}
} 
// ------------------------------------------------------------
 
/* @ def 	: _have_get_session base on views type 
 * ---------------------------------------------------------------
 * @ param 	: modified
 * @ author : omens
 */
 
if( !function_exists('get_cokie_exist') )
{
	function get_cokie_exist( $key, $val = null ) {
		
		if( !is_null($val) and function_exists( $val ) ){
			return Call(_get_exist_session( $key ), $val);
		}		
		return _get_exist_session( $key );
	}
} 
// ------------------------------------------------------------
 
/* @ def 	: _have_get_session base on views type 
 * ---------------------------------------------------------------
 * @ param 	: modified
 * @ author : omens
 */
 
if( !function_exists('set_cokie_value') )
{
	function set_cokie_value( $name, $value)
	{
		$EUI =& get_instance();
		return $EUI->EUI_Session->_set_session($name, $value);
	}
} 
// ------------------------------------------------------------
 
/* @ def 	: _have_get_session base on views type 
 * ---------------------------------------------------------------
 * @ param 	: modified
 * @ author : omens
 */
 
if( !function_exists('get_cokie_object') )
{
	function get_cokie_object() {
		if( function_exists('ObjectSession') ){
			return 	ObjectSession();
		}
		return null;
	}
} 

 
 
 