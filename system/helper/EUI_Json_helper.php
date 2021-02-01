<?php
/*
 * @ def 	:  json_encode
 * --------------------------------------------------------------
 *
 * @ notes  : get local json functionality if nout found on PHP
 * @ param 	: array data 
 * @ akses 	: public function 
 */
 
if(!function_exists('json_encode'))
{
	function json_encode( $values = array() )
	{
		$_JSON_encode = null;
		$JSON = Services_JSON::get_instance();
		if( is_object($JSON) )
		{
			$_JSON_encode = $JSON -> encode( $values );
		}	
		return $_JSON_encode;
	}
}

/*
 * @ def 	:  json_decode
 * --------------------------------------------------------------
 *
 * @ notes  : get local json functionality if nout found on PHP
 * @ param 	: array data 
 * @ akses 	: public function 
 */
 
if(!function_exists('json_decode'))
{
	function json_decode( $values = null )
	{
		$_JSON_decode = null;
		$JSON = Services_JSON::get_instance();
		if( is_object($JSON) )
		{
			$_JSON_decode = $JSON -> decode($values );
		}	
		return $_JSON_decode;
	}
}

// location : /system/helper/EUI_Json_helper
?>