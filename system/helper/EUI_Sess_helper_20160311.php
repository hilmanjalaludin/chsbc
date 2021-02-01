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
		return $EUI -> EUI_Session -> _get_session($param);
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
		return (_have_get_session($param)?_get_session($param):$EUI -> URI -> _get_post($param));
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

 
 