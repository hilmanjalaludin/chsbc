<?php
/*
 * EUI Model  
 *
 
 *@Section  : M_CallReason
 *@author 	: Omens  
 *@link		: http://www.razakitechnology.com/eui/controller 
 */
 
class M_CallReason extends EUI_Model
{
	
	
 private static $Instance = null;	
 
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
 public static function &Instance()
{
 if( is_null(self::$Instance) ){
	self::$Instance = new self();
 }
 return self::$Instance;
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
function __construct() { }

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 function _select_call_reason()
{
 $_conds = array();
 $sql = " SELECT a.reasonid, a.reason_desc from cc_reasons a ";
 $qry = $this -> db -> query($sql);
  foreach( $qry -> result_assoc() as $rows ) 
 {
	$_conds[$rows['reasonid']] = $rows['reason_desc'];
 }
	return $_conds;
}


// ============== END CLASS ==================================
 
 
}

// END OF FILE 
// location : /application/model/M_CallReason.php
?>