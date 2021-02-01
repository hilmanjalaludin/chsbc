<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

$ListUser = array();
foreach( $LEVEL as $num => $Users ){
	$ListUser[$Users['UserId']] = $Users['full_name'];
}

__(form()->listcombo('UserId', 'select long',$ListUser));	
__(form()->button('AssignId', 'assign button',' Swap',array("click"=>"Ext.DOM.SwapData();")));
__(form()->button('AssignId', 'close button',' Cancel',array("click"=>"Ext.DOM.ClerSwapData();") ));