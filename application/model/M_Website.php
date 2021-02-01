<?php
/**
 * @ model data get website parameter 
 * @ return  : array 
 * @ author  : omens 
**/

class M_Website extends EUI_Model{


private static $Instance = null;
public static function &Instance() 
{
	if( is_null( self::$Instance ) ){
		self::$Instance = new self();
	}	
  return self::$Instance;	
}

// ---------------------------------------------------------------------------
/* Modul 			loader automatic class EUI Core && view 
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */
 
 
 function __construct() 
{
	//$this -> load -> meta('_web_config'); 
}

// ---------------------------------------------------------------------------
/* Modul 			loader automatic class EUI Core && view 
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */
 
 
 public function _web_query( $_modul ='WEBSITE', $_param = 'PARAM_NAME')
{
  $arr_website = array();
  $this->db->reset_select();
  $this->db->select("*", FALSE);
  $this->db->from('tms_application_config');
  $this->db->where("module_name", $_modul);
  $this->db->where("param_name", $_param);
  $rs = $this->db->get();

  if( $rs->num_rows() > 0 ) 
  {
	 // $arr_website = $rs -> result_first_assoc();
	 $arr_website = $rs->row_array();
  }
 
  return (array)$arr_website;
}

// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------

 function _web_address()
 {
	$_result  = self::_web_query( 'COMPANY', 'WEB_ADDRESS' );
	if( $_result ){
		return $_result['param_value'];
	}
	else
		return null;
 }

// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------

 function _web_title()
 {
	$_result  = self::_web_query( 'WEBSITE', 'TITLE' );
	if( $_result ){
		return $_result['param_value'];
	}
	else
		return null;
 }
 

// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------

 function _web_verion()
 {
	$_result  = self::_web_query( 'WEBSITE', 'VERSION' );
	if( $_result ){
		return $_result['param_value'];
	}
	else
		return null;
 }
 

// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------

 function _web_author()
 {
	$_result  = self::_web_query( 'WEBSITE', 'AUTHOR' );
	if( $_result ){
		return $_result['param_value'];
	}
	else
		return null;
 }
 

// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------

 function _web_copyright()
 {
	$_result  = self::_web_query( 'WEBSITE', 'COPYRIGHT' );
	if( $_result ){
		return $_result['param_value'];
	}
	else
		return null;
 }
 

// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------

 function _web_logo_dark()
 {
	$_result  = self::_web_query( 'WEBSITE', 'LOGO_DARK' );
	if( $_result ){
		return $_result['param_value'];
	}
	else
		return null;
 }
 

// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------

 function _web_logo_orange()
 {
	$_result  = self::_web_query( 'WEBSITE', 'LOGO_ORANGE' );
	if( $_result ){
		return $_result['param_value'];
	}
	else
		return null;
 }
 

// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------

 function _web_themes()
 {
	$_result  = self::_web_query( 'CONFIG', 'THEME' );
	if( $_result ){
		return $_result['param_value'];
	}
	else
		return null;
		
 }
 

// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------

 function _web_default()
 {
	$_result  = self::_web_query( 'INSTRUCTION', 'INSTRUCTION' );
	if( $_result ){
		return $_result['content'];
	}
	else
		return null;
		
	
 }

// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------

 function _web_company_name()
 {
	$_result  = self::_web_query( 'COMPANY', 'COMPANY_NAME' );
	if( $_result ){
		return $_result['param_value'];
	}
	else
		return null;
 }
 

// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------

 
 function _web_get_data()
 {
	$_website['website'] = array
	(
		'_web_company_name' => $this->_web_company_name(),
		'_web_default' 		=> $this->_web_default(),
		'_web_themes' 		=> $this->_web_themes(),
		'_web_logo_orange' 	=> $this->_web_logo_orange(),
		'_web_logo_dark' 	=> $this->_web_logo_dark(),
		'_web_copyright' 	=> $this->_web_copyright(),
		'_web_author' 		=> $this->_web_author(),
		'_web_title' 		=> $this->_web_title(),
		'_web_verion' 		=> $this->_web_verion() 
	);
	
	return $_website;
 
 }

} 
?>