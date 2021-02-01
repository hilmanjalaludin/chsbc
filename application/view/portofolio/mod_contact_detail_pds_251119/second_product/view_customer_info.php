<?php 

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 * 
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * @ example    : get by fields ID / Campaign ID
 */
	// $Flexibles =& _cmpFlexibleLayout("");
	// echo "<pre>". $SecondDetail->get_value('CustomerId');
	// var_dump( $Flexibles ); echo "</pre>"; die();
	
	// $Flexibles -> _setTables(""); // rcsorce data 
	// $Flexibles -> _setCustomerId(""); // set conditional array();
	// var_dump($Flexibles);
	// $Flexibles -> _Compile("");

if( $Flexibless =& _cmpFlexibleLayout($SecondDetail->get_value('CampaignId'))) 
{
	// echo "<pre>". $SecondDetail->get_value('CustomerId');
	// var_dump( $Flexibles ); echo "</pre>"; die();
	// $Flexibless -> LayouLabels = null;
	$Flexibless -> _setTables($SecondDetail->get_value('TableDetail')); // rcsorce data 
	$Flexibless -> _setCustomerId(array('CustomerId' => $SecondDetail->get_value('CustomerId') ) ); // set conditional array();
	// var_dump($Flexibles);
	$Flexibless -> _Compile(array('CustomerId' =>$SecondDetail->get_value('CustomerId')));
}
// END OFF
