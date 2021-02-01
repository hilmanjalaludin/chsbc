<?php
/*
 * E.U.I 
 
 * @ packege  : Core system
 * @ sub 	  : EUI_Namespcae | Require spl_autoload register
 * @ author   : omens
 * @ lincense : http://razakitechnology.com/license
 * @ link	  : http://razakitechnology.com/eui/core 
**/

class EUI_Namespace 
{
	
//@	params
 private static $_path_view = array();  
 
//@	params
 private static $_path_core = array();
 
//@	params
 private static $_path_model = array();
 
//@	params
 private static $_path_plugin = array(); 
 
//@	params
 private static $_path_database = array();
 
//@	params
 private static $_path_controller = array();	
 
//@	params
 private static $_path_config = array();
 
//@	params
 private static $_path_adapter = array();
 
/**
 *@ variable get_instance
 */ 
 
 private static $_instance;

/**
 *@ variable get_instance
 *@ on load register this function  
 */ 
 
 public function __construct() 
 {
	self::$_path_controller = array( '_path' => APPPATH, '_view' => 'controller/');
	self::$_path_view 		= array( '_path' => APPPATH, '_view' => 'view/'); 
	self::$_path_model 		= array( '_path' => APPPATH, '_view' => 'model/');
	self::$_path_config   	= array( '_path' => APPPATH, '_view' => 'config/');
	self::$_path_core 		= array( '_path' => BASEPATH, '_view' => 'core/');
	self::$_path_database 	= array( '_path' => BASEPATH, '_view' => 'database/');
	self::$_path_plugin   	= array( '_path' => BASEPATH, '_view' => 'plugin/');
	self::$_path_adapter   	= array( '_path' => BASEPATH, '_view' => 'database/adapter/');
	
 }

 /** 
 *@ create & register core function 
 *@ return < void >
 **/
 
 public function controller( $class='' ) 
 {
	$eui_path_extension = self::$_path_controller['_path'].self::$_path_controller['_view'];
	$pClassFilePath = $eui_path_extension . str_replace('',DIRECTORY_SEPARATOR, $class ).'.php';	
	if ((class_exists( $pClassFilePath, FALSE)) || (strpos( $pClassFilePath, 'EUI_Core') == true )) {
		return false;
	}

	if ((file_exists($pClassFilePath) === FALSE) || (is_readable($pClassFilePath) === FALSE)) {
		show_error('No Core file loaded '.$eui_path_extension.$class.' .');
		return FALSE;	
	}
			
	if( file_exists($pClassFilePath) ){ 
		include_once( $pClassFilePath );
	}
 }
 
 /** 
 *@ create & register core function 
 *@ return < void >
 **/
 
 public function helper()
 {
	
 }
 
 /** 
 *@ create & register core function 
 *@ return < void >
 **/
 
 public function config( $class='' ) 
 {
	$eui_path_extension = self::$_path_config['_path'].self::$_path_config['_view'];
	
	$pClassFilePath = $eui_path_extension . str_replace('',DIRECTORY_SEPARATOR, $class ).'.php';	
	if ((class_exists( $pClassFilePath, FALSE)) || (strpos( $pClassFilePath, 'EUI_Core') == true )) {
		return false;
	}

	if ((file_exists($pClassFilePath) === FALSE) || (is_readable($pClassFilePath) === FALSE)) {
		show_error('No Core file loaded '.$eui_path_extension.$class.' .');
		return FALSE;	
	}
			
	if( file_exists($pClassFilePath) ){ 
		require( $pClassFilePath );
	}
 }
 
 
/** 
 *@ create & register core function 
 *@ return < void >
 **/
 
 public function adapter( $class='')
 {
	$eui_path_extension = self::$_path_adapter['_path'].self::$_path_adapter['_view'];
	$pClassFilePath = $eui_path_extension . str_replace('',DIRECTORY_SEPARATOR, $class ).'.php';	
	
	if ((class_exists($pClassFilePath,FALSE)) || (strpos($pClassFilePath, 'EUI_Core') == true )) {
		return false;
	}

	if ((file_exists($pClassFilePath) === FALSE) || (is_readable($pClassFilePath) === FALSE)) {
		show_error('No Core file loaded '.$pClassFilePath.' .');
		return FALSE;	
	}
			
	if( file_exists($pClassFilePath) ){ 
		require($pClassFilePath);
	}
 }
 
/** 
 *@ create & register core function 
 *@ return < void >
 **/
 
 public function database($class = '')
 {
	$eui_path_extension = self::$_path_database['_path'].self::$_path_database['_view'];
	$pClassFilePath = $eui_path_extension . str_replace('',DIRECTORY_SEPARATOR, $class ).'.php';	
	
	if ((class_exists($pClassFilePath,FALSE)) || (strpos($pClassFilePath, 'EUI_Core') == true )) {
		return false;
	}

	if ((file_exists($pClassFilePath) === FALSE) || (is_readable($pClassFilePath) === FALSE)) {
		show_error('No Core file loaded '.$pClassFilePath.' .');
		return FALSE;	
	}
			
	if( file_exists($pClassFilePath) ){ 
		require($pClassFilePath);
	}
 }
 
/** 
 *@ create & register core function 
 *@ return < void >
 **/
 
 public function core( $class = '' ) 
 {
	
	$eui_path_extension = self::$_path_core['_path'].self::$_path_core['_view'];
	$pClassFilePath = $eui_path_extension . str_replace('',DIRECTORY_SEPARATOR, $class ).'.php';	
	
	if ((class_exists($pClassFilePath,FALSE)) || (strpos($pClassFilePath, 'EUI_Core') == true )) {
		return false;
	}

	if ((file_exists($pClassFilePath) === FALSE) || (is_readable($pClassFilePath) === FALSE)) {
		show_error('No Core file loaded '.$pClassFilePath );
		return FALSE;	
	}
			
	if( file_exists($pClassFilePath) ){ 
		require( $pClassFilePath );
	}
 }
 
 
/**
 *@ variable get_instance
 *@ return of instance of class
 */ 
 
 public static function & Register() {
	if( is_null( self::$_instance )) {
		self::$_instance = new self();
	}
	return self::$_instance;
 }
 	
}
?>