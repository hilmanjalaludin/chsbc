<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 ** _Core & library
 ** EUI < Enigma User interface 0.1 >
 ** Licensed under the MIT ( http://razakitechnology.com/siteraztech/product/web-application ) license.
 ** Copyright © 2014-2012 razaki Labs ( http://razakitechnology.com )     
 ** author < omens >
 **/
 
class EUI_Keys {
 
/**
 @ set primitive object variable 
 **/
 
private static $EUI_Keys;

/**
 @ get instancoe of self class
 **/
 
public static function &get_instance()
 {
	if(is_null( self::$EUI_Keys) )
	{
		self::$EUI_Keys = new self();
	}
	return self::$EUI_Keys;
 } 
 
/**
 @ open keys installation data will generare from here 
 @ please done remove cased will chek again if you load data
 **/
  
 public function get_keys_install( $_file_paths ='' )
 {
	$_SORT = $_file_paths.'/'.self::_get_eui_keys().'.ini';
	
	if( file_exists( $_SORT ) )
	{
		$_keys_install = parse_ini_file( $_SORT );
		if( is_array( $_keys_install ) ) {
			return $_keys_install;
		}
		else
			return false;
	}	
	else{
		show_error('No Keys Install <B>'.$_SORT.'</B> does not exist.');
	}	
 }
 
/**
 @ open keys installation data will generare from here 
 @ please done remove cased will chek again if you load data
 **/
  
public function select_version() {
	
}
 
/**
 @ open keys installation data will generare from here 
 @ please done remove cased will chek again if you load data
 **/
 
 public function _get_eui_keys() 
 {
	$_md5 = md5('1234');
	return $_md5; 
 }
 
}

?>