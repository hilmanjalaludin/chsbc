<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Language Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/language_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Lang
 *
 * Fetches a language variable and optionally outputs a form label
 *
 * @access	public
 * @param	string	the language line
 * @param	string	the id of the form element
 * @return	string
 */
 
if ( ! function_exists('lang'))
{
	function lang($line, $id = '')
	{
		$EUI =& get_instance();
		
		$line_label = "";
		
		if( !is_array( $line ) ) {
			$line = array( $line => $line );	
		} 
		
	// -------- assumtion array -----	
		
		$num = 0;
		if( is_array($line) )
			foreach( $line as $key => $label )
	  {
			$line_label[$num] = $EUI->Lang->line(trim($label)); 
			$num++;
		}	
		
		$line_label = join(" ", $line_label);
		
		if ($id != '')  {
			$line_label = '<label for="'.$id.'">'.$line_label."</label>";
		}

		return $line_label;
	}
}


// ------------------------------------------------------------------------

/**
 * Lang
 *
 * Fetches a language variable and optionally outputs a form label
 *
 * @access	public
 * @param	string	the language line
 * @param	string	the id of the form element
 * @return	string
 */
 
if ( ! function_exists('langs'))
{
	function langs($line=NULL, $id = '')
	{
		if(!is_array($line) ){
			return $line;
		}
		
		$arr_langs = array();
		if(is_array($line) )
			foreach( $line as $ke => $label )  {
			$arr_langs[]  = lang( $label );
		}
		
		return join("&nbsp;", $arr_langs);
	}
}

// ------------------------------------------------------------------------

/**
 * Lang
 *
 * Fetches a language variable and optionally outputs a form label
 *
 * @access	public
 * @param	string	the language line
 * @param	string	the id of the form element
 * @return	string
 */
 
if ( ! function_exists('word'))
{
	function word( $word  = null ) 
	{
		$EUI =& get_instance();
		
		$arr_lang = $EUI->Lang->Language['wd'];
		if( count($arr_lang)==0 )
		{
			return FALSE;
		}
		return NULL; // lier -----------> 
		
	}
}
/**
 * Lang
 *
 * Fetches a language variable and optionally outputs a form label
 *
 * @access	public
 * @param	string	the language line
 * @param	string	the id of the form element
 * @return	string
 */
 
if( ! function_exists('lang_name') )
{
  function lang_name()
 {
	$EUI =& get_instance();
	$arr_lang = $EUI->Lang->uri_lang();
	return (string)$arr_lang['lang_name'];
 }
} 
/**
 * Lang
 *
 * Fetches a language variable and optionally outputs a form label
 *
 * @access	public
 * @param	string	the language line
 * @param	string	the id of the form element
 * @return	string
 */
 
 
if( ! function_exists('lang_description') )
{
  function lang_description()
 {
	$EUI =& get_instance();
	$arr_lang = $EUI->Lang->uri_lang();
	return (string)ucfirst($arr_lang['lang_description']);
 }
 
} 
/**
 * Lang
 *
 * Fetches a language variable and optionally outputs a form label
 *
 * @access	public
 * @param	string	the language line
 * @param	string	the id of the form element
 * @return	string
 */
 
 
if( ! function_exists('lang_code') )
{
  function lang_code()
 {
	$EUI =& get_instance();
	$arr_lang = $EUI->Lang->uri_lang();
	return (string)$arr_lang['lang_code'];
 }
} 
// ------------------------------------------------------------------------
/* End of file language_helper.php */
/* Location: ./system/helpers/language_helper.php */