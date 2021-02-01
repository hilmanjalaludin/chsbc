<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*
 * @ def 		:  get by campaign 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

__(form() -> combo('CallResult','select long',$setCallResult,NULL, array('change'=>'getEventSale(this);')));
 
?>