<?php
/**
 ** Model Configuration and library
 ** EUI < Enigma User interface 0.1 >
 ** Licensed under the MIT ( http://razakitechnology.com/siteraztech/product/web-application ) license.
 ** Copyright © 2014-2012 razaki Labs ( http://razakitechnology.com )        
 **/

/** 
 ** include all plugin here 
 **/
 
require(_EUI_DIR.'/../../system/plugin/EUI_Socket.php');
require(_EUI_DIR.'/../../system/plugin/EUI_IExcel.php');
require(_EUI_DIR.'/../../system/plugin/EUI_EExcel.php');
require(_EUI_DIR.'/../../system/plugin/EUI_WriteLog.php');
require(_EUI_DIR.'/../../system/plugin/EUI_Curl.php');
require(_EUI_DIR.'/../../system/plugin/EUI_Fixed.php');
require(_EUI_DIR.'/../../system/plugin/EUI_Ftp.php');
/**
 ** start && run 
 **/

class Plugin extends mysql
{

/**
 ** constructor
 ** public aksess
 **/
 
var $_ver; 
 
function Plugin()
{
	$this -> _ver ='0.1';
}

/**
 ** please palce here if you have model data 
 ** will render if call with name new Model();
 **/

 function _version()
 {
	if( !empty( $this -> _ver ) )
		return $this -> _ver;
 }
 	
/**
 **
 **
 **/
 	
function _Plugin()
{
	$_plugin['Socket'] = 'Socket';
	$_plugin['eExcel'] = 'Excel';
	$_plugin['iExcel'] = 'iExcel';
	$_plugin['Wlog']   = 'WriteLog';
	$_plugin['Curl']   = 'Curl';
	$_plugin['FTP']    = 'FTP';
	$_plugin['Fixed']  = 'Fixed';
	
	foreach($_plugin as $_plugin_class => $plugin_names )
	{
		$this -> $_plugin_class = new $plugin_names();
	}
}
 
}
?>