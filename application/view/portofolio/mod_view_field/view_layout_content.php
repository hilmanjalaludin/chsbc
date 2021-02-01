<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 * 
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * @ example    : get by fields ID / Campaign ID
 */
$Flexible =& _fldFlexibleLayout(_get_64post('LayoutId') );

if(  $Flexible ) 
{
	$Flexible->_setTables('t_gn_customer'); // rcsorce data 
	$Flexible->_setCustomerId(array('CustomerId' => 1)); // set conditional array();
	$Flexible->_Compile();
} else {
	exit("Layout not found");
}
?>
