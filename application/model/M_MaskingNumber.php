<?php

// -----------------------------------------------------------

/* 
 * pack 		Class SMSInbox  
 *
 * @auth 		uknown 
 * @param		testing all 
 */
 
 
class M_MaskingNumber extends EUI_Model
{
	
private static $Instance = null;
	
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 public static function &Instance()
{
	if( is_null(self::$Instance) )
 {
	self::$Instance = new self();
 }
  return  self::$Instance;
 
}

// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

 function M_MaskingNumber() { }
 
 // -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
	
public function MaskingBelakang( $word='', $length=3, $char='*' )
{
	$mengkudu = substr($word,0,strlen($word)-$length);
	for($x=1;$x<=$length;$x++) {
	  $mengkudu .= $char;
	}
	return $mengkudu;
}

// ======================= end class ===============================
}
?>