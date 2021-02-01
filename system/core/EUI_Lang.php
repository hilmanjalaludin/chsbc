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
 * Language Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Language
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/language.html
 */
 
 class EUI_Lang 
{

	var $language	= array();
	var $is_loaded	= array();
	
	/*
	 * static method patern 
	 * 
	 * @auth    omens
	 * @pack    properties static 
	 * @access  private static 
	 */
	 
	private $lang_config = null;
	
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function __construct()
	{
		log_message('debug', "Language Class Initialized");
	}

	// --------------------------------------------------------------------

	/**
	 * Load a language file
	 *
	 * @access	public
	 * @param	mixed	the name of the language file to be loaded. Can be an array
	 * @param	string	the language (english, etc.)
	 * @return	mixed
	 */
	 
	function load($langfile = '', $idiom = '', $return = FALSE, $add_suffix = TRUE, $alt_path = '')
	{
		$arr_config =&$this->_lang_config_active();
		
		$langfile = str_replace('.php', '', $langfile);
		
		if ($add_suffix == TRUE)
		{
			$langfile = str_replace('_lang.', '', $langfile).'_lang';
		}

		$langfile .= '.php';

		if (in_array($langfile, $this->is_loaded, TRUE))
		{
			return;
		}

		$config =& get_config();

		if ($idiom == '')
		{
			$deft_lang = ( ! isset($config['language'])) ? 'english' : $config['language'];
			$idiom = ($deft_lang == '') ? 'english' : $deft_lang;
		}
		
	// ---------------- get config on lang -------------------	
		if( isset($arr_config['lang_name']) )
		{
			if( strlen(trim($arr_config['lang_name']))> 2 )
			{
				$idiom = (string)$arr_config['lang_name'];	
			}
		}
		// Determine where the language file is and load it
		if ($alt_path != '' && file_exists($alt_path.'language/'.$idiom.'/'.$langfile))
		{
			$arr_path = $alt_path.'language/'.$idiom.'/'.$langfile;
			if( file_exists($arr_path) )
			{
				include($alt_path.'language/'.$idiom.'/'.$langfile);
			}	
		}
		else
		{
			$found = FALSE;

			foreach (get_instance()->load->get_package_paths(TRUE) as $package_path)
			{
				if (file_exists($package_path.'language/'.$idiom.'/'.$langfile))
				{
					include($package_path.'language/'.$idiom.'/'.$langfile);
					$found = TRUE;
					break;
				}
			}

			if ($found !== TRUE)
			{
				show_error('Unable to load the requested language file: language/'.$idiom.'/'.$langfile);
			}
		}


		if ( ! isset($lang))
		{
			log_message('error', 'Language file contains no data: language/'.$idiom.'/'.$langfile);
			return;
		}

		if ($return == TRUE)
		{
			return $lang;
		}

		$this->is_loaded[] = $langfile;
		$this->language = array_merge($this->language, $lang);
		unset($lang);

		log_message('debug', 'Language file loaded: language/'.$idiom.'/'.$langfile);
		return TRUE;
	}
	
	// --------------------------------------------------------------------

	/*
	 * static method patern 
	 * 
	 * @auth    omens
	 * @pack    properties static 
	 * @access  private static 
	 */
	 
	 public function & _lang_config_active()
	{
		$lang_config = self::config_lang();
		if( FALSE == $lang_config )
		{
			return FALSE;
		}
		
		$arr_lang_config = parse_ini_file($lang_config, true);
		if( !isset($arr_lang_config['lang_config']) )
		{
		   return FALSE;
		}
		if( isset( $arr_lang_config['lang_config']) ){
			$arr_lang = array_map('strtolower', $arr_lang_config['lang_config']);
			//print_r( $arr_lang);
			return $arr_lang;
		} else {
			return null;
		}
		
	} 
	

	// --------------------------------------------------------------------

	/**
	 * Fetch a single line of text from the language array
	 *
	 * @access	public
	 * @param	string	$line	the language line
	 * @return	string
	 */
	 
	function line( $line = '')
	{
		$value = ($line == '' OR ! isset($this->language[$line])) ? $line : $this->language[$line];

		// Because killer robots like unicorns!
		if ($value === FALSE)
		{
			log_message('error', 'Could not find the language line "'.$line.'"');
		}
		
		$this->dblang($value);
		return $value;
	}
	
	// -----------------------------------------------------------------------
	
	function dblang( $lang = null )
	{
		if( LOOK_LANG_ACTIVE == 1 ) 
		{
			$ln = & get_instance();
			if( !is_null( $lang) )
			{
				$ln->db->reset_write();
				$ln->db->duplicate("lang_index", $lang);
				$ln->db->duplicate("lang_label", $lang);
				$ln->db->duplicate("lang_type", "eng");
				$ln->db->insert_on_duplicate("t_gn_language");
			}	
		}
	}
	
	// --------------------------------------------------------------------

	/**
	 * Fetch a single line of text from the language array
	 *
	 * @access	public
	 * @param	string	$line	the language line
	 * @return	string
	 */
	 
	
	 public function update_lang( $arr_lang = null )
	{
	   if(!is_null($arr_lang) )
	   {
		  $lang_config = self::config_lang();
		  if( $lang_config!=FALSE)
		  {
			$arr_str_lang  ="[lang_config]\r\n";
			$arr_str_lang .="lang_code=$arr_lang[code]\r\n";
			$arr_str_lang .="lang_name=$arr_lang[name]\r\n";
			$arr_str_lang .="lang_description=$arr_lang[description]\r\n";
			
			if( file_put_contents($lang_config,$arr_str_lang)) 
			{
				return TRUE;
				
			 } else {
			 
				return FALSE;
			 }
	
		  }
		  
	   }
	   
	   return FALSE;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Fetch a single line of text from the language array
	 *
	 * @access	public
	 * @param	string	$line	the language line
	 * @return	string
	 */
	 
	  public function config_lang()
	 {
		$BASE_CONF_PATH = str_replace("system", preg_replace('/\//', '',APPPATH),BASEPATH);
		$BASE_CONF_PATH = substr( $BASE_CONF_PATH, 0, (strlen($BASE_CONF_PATH)-1));
		
		if( is_null($this->lang_config) )
		{
			$this->lang_config = $BASE_CONF_PATH;
		}
		
	//--------- cek exist file ------------------------
	
		if( is_null($this->lang_config) ){
			return FALSE;
		}	
		
		$lang_config = $this->lang_config ."/config/EUI_Lang.conf";
		
		if( !file_exists($lang_config) )
		{
			return FALSE;
		} else{
			return $lang_config;
		}
		
	 }
	
	// --------------------------------------------------------------------

	/**
	 * Fetch a single line of text from the language array
	 *
	 * @access	public
	 * @param	string	$line	the language line
	 * @return	string
	 */
	 
	  public function uri_lang()
	 {
		$lang_active =& $this->_lang_config_active();
		if(!is_array($lang_active) )
		{
			return FALSE;
		} else {
			return (array)$lang_active;
		}
	 }

}

// END Language Class
/* End of file Lang.php */
/* Location: ./system/core/Lang.php */
