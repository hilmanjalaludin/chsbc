<?php 

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 * 
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * @ example    : get by fields ID / Campaign ID
 */
#print_r($Detail->get_value('CampaignId')); die();
if( $Flexible =& _cmpFlexibleLayout($Detail->get_value('CampaignId'))) 
{
	//var_dump($Detail);
	$Flexible -> _setTables($Detail->get_value('TableDetail')); // rcsorce data 
	$Flexible -> _setCustomerId(array('CustomerId' => $Detail->get_value('CustomerId') ) ); // set conditional array();
	
	$Flexible -> _Compile(array('CustomerId' =>$Detail->get_value('CustomerId')));
	//var_dump($Flexible);
}
// END OFF
