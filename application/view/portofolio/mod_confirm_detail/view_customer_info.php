<?php 

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 * 
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * @ example    : get by fields ID / Campaign ID
 */

if( $Flexible =& _cmpFlexibleLayout($Detail->get_value('CampaignId'))) 
{
	$Flexible -> _setTables('t_gn_customer'); // rcsorce data 
	$Flexible -> _setCustomerId(array('CustomerId' => $Detail->get_value('CustomerId') ) ); // set conditional array();
	$Flexible -> _Compile();
}
// END OFF
