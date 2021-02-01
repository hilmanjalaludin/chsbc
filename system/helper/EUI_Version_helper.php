<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Enigma User Interface 
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		Enigma User Interface 
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://razakitechnology.com/user_guide/license.html
 * @link		http://razakitechnology.com
 * @since		Version 1.2.0
 * @filesource
 */

 


// -------------------------------------------------------------------------------------------------
/* is valid key */

if( ! function_exists('eui_webapplication') )
{
   function eui_webapplication()  {
  }
}
 

// -------------------------------------------------------------------------------------------------
/* is valid key */

if( ! function_exists('eui_version') )
{
   function eui_version() 
  {
	 $UI=& get_instance();
	 return EUI_Version::Instance(); 
  }
}

// -------------------------------------------------------------------------------------------------
/* is valid key */

if( ! function_exists('isvalid') )
{
   function isvalid() 
  {
	 $Ver=& eui_version();
	 return $Ver->isvalid(); 
	 
  }
}


// -------------------------------------------------------------------------------------------------
/* is valid key */

if( ! function_exists('title') )
{
   function title() 
  {
	$arr_conf =& Keyconfig();
	if( isset($arr_conf['install.title']) ){
		return (string)$arr_conf['install.title'];
	} else {	
		$Ver=& eui_version();
		return $Ver->title(); 
	}
  }
}

// -------------------------------------------------------------------------------------------------
/* is  Keyconfig */

if( !function_exists('Keyconfig') )
{ 
	function Keyconfig() 
 {
	$path_config = (string)join("", array(BASEPATH , 'keys'));  
	$config =& KeyInstall()->get_keys_install($path_config);
	return (array)$config;
 }
 
}	

// -------------------------------------------------------------------------------------------------
/* is  version */

if( ! function_exists('version') )
{
   function version() 
  {
	 $arr_key =& Keyconfig();
	 if( isset($arr_key['install.version']) ){
		 return (string) $arr_key['install.version'];
	 } else{	 
		$Ver=&eui_version();
		return $Ver->version(); 
	 }
  }
}

// -------------------------------------------------------------------------------------------------
/* is author */

if( ! function_exists('author') )
{
   function author() 
  {
	 $arr_conf =& Keyconfig();
	 if( isset($arr_conf['install.author']) )
	{
		return (string)$arr_conf['install.author'];
		
	} else {	
		 $Ver=&eui_version();
		return $Ver->author();
	}
	 
  }
}

// -------------------------------------------------------------------------------------------------
/* is dsinstall */

if( ! function_exists('dsinstall') )
{
   function dsinstall() 
  {
	$Ver=&eui_version();
	return $Ver->dsinstall(); 
	 
  }
}


// -------------------------------------------------------------------------------------------------
/* is description */
if( ! function_exists('description') )
{
   function description() 
  {
	 $arr = array( title(), version() );
	  if( function_exists('join') )
	 {
		return join(' ', $arr);
	 } else{
		 return null;
	 }
	 
  }
}

// -------------------------------------------------------------------------------------------------
/* is copyright on model */

if( ! function_exists('copyright') )
{
   function copyright() 
  {
	 $Ver=& eui_version();
	 return $Ver->copyright(); 
	 
  }
}


// -------------------------------------------------------------------------------------------------
/* is copyright on model */

if( ! function_exists('company') )
{
   function company() 
  {
	 $Ver=&eui_version();
	 return $Ver->company(); 
	 
  }
}


// -------------------------------------------------------------------------------------------------
/* is copyright on model */

if( ! function_exists('website') )
{
   function website() 
  {
	 $Ver=& eui_version();
	 return $Ver->website();
	 
  }
}


// -------------------------------------------------------------------------------------------------
/* is copyright on model */

if( ! function_exists('email') )
{
   function email() 
  {
	 $Ver=&eui_version();
	 return $Ver->email(); 
	 
  }
}


// -------------------------------------------------------------------------------------------------
/* is copyright on model */

if( ! function_exists('themes') )
{
   function themes() 
  {
	 $Ver=&eui_version();
	 return $Ver->themes(); 
	 
  }
}


// -------------------------------------------------------------------------------------------------
/* is copyright on model */

if( ! function_exists('title_header') )
{
   function title_header( $title = '' ) 
  {
	 $arr_header = array( description(), $title);
	 return join(" :: ", $arr_header);
  }
}

// =================== END HELPER ==================================================================
?>