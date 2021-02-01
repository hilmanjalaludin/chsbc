<?php 

// -------------------------------------------------------
/*
 * Name 	: Libraries of class Version 
 * Aksess	: Helper Version 
 * Project  : Tele Insurace System 
 */
 
 
class EUI_Version {
// ------------------------------------------------------
/*
 * private static 
 */


protected $UI = null;

// ------------------------------------------------------
/*
 * private static 
 */
 
private static $Instance = null;
 

// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */
 public function Instance()
{ 
   if( is_null(self::$Instance) )
  {
	self::$Instance = new self();
  }	
  
  return self::$Instance;
}


// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */
 
 public function __construct() { }

// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */
 
  public function UI() 
 {
	$UI =& get_instance();
	$UI->load->model(array('M_Website'));
	if( class_exists('M_Website') )	{
		return get_class_instance('M_Website');
	} else {
		return false;
	}
 }	

// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */
 
 public function copyright()
{ 
	$Version = $this->UI();
	return $Version->_web_copyright();
}

// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */
 
public  function version(){ 
	$Version = $this->UI();
	return $Version->_web_verion();
}

// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */
public  function title(){ 
	$Version = $this->UI();
	return $Version->_web_title();
}

// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */

public  function orange(){ 
	$Version = $this->UI();
	return $Version->_web_logo_orange();
}

// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */
public  function dark(){ 
	$Version = $this->UI();
	return $Version->_web_logo_dark();
}


// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */
public  function description(){ 
	$Version = $this->UI();
	return $Version->_web_title();
}

// -------------------------------------------------------
/*
 *
 *
 */

public  function standar(){ 
	$Version = $this->UI();
	return $Version->_web_default();
}

// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */
 public  function author()
{  
	$Version = $this->UI();
	return $Version->_web_author();
}

// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */
public  function themes(){  
	$Version = $this->UI();
	return $Version->_web_themes();
}

// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */
public  function company(){  
	$Version = $this->UI();
	return $Version->_web_company_name();
}

// -------------------------------------------------------
/*
 * @ package 	: instruction
 * 
 */

public  function instruction(){  
	$Version = $this->UI();
	return $Version->_web_default();
}

// -------------------------------------------------------
/*
 * @ package 	: instruction
 * 
 */

public  function website(){  
	$Version = $this->UI();
	return $Version->_web_address();
}




	

// ====================== END CLASS 
	
}

?>