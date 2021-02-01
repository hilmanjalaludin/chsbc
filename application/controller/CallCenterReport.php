<?php

class CallCenterReport extends EUI_Controller 
{

 function CallCenterReport() {
	parent::__construct();
	$this -> load -> model(array(base_class_model($this),'M_Report'));
	
 }
 
 function index()
 {
 
	$UI = array
	(
		'group_call_center' => $this -> M_Report -> getAgentGroup(),
		'agent_call_center' => $this -> M_Report -> getAgent(),
		'mode_call_center' => $this -> M_Report -> Mode(),
		'mode_call_type'  => $this -> M_Combo->_getCallDirection(),
		'filter_by'  => $this -> M_Report->Filter()
	);  
	
	$this -> load -> view("rpt_call_center/report_call_center_nav", $UI);
 }
 
 // ShowExcel
 
 function ShowExcel()
 {
	Excel() -> HTML_Excel(get_class($this).''.time());
	if( $this -> URI-> _get_have_post('mode') )
	{
		$UI_Mode = STRTOLOWER($this -> URI->_get_post('mode'));
		switch( $UI_Mode )
		{
			// case 'hourly' 	: $this -> Hourly(); 	break;
			// case 'daily'	: $this -> Daily();  	break;
			case 'summary'	: $this -> Summary(); 	break;
		}
	}
 
 }
 
 // ShowReport
 
 function ShowReport()
 {
	if( $this -> URI-> _get_have_post('mode') )
	{
		$UI_Mode = STRTOLOWER($this -> URI->_get_post('mode'));
		switch( $UI_Mode )
		{
			// case 'hourly' 	: $this -> Hourly(); 	break;
			// case 'daily'	: $this -> Daily();  	break;
			case 'summary'	: $this -> Summary(); 	break;
		}
	}
 }
 
 
 // monthly 
 
 public function Summary()
 {
	$UI = array
	(
		'view' 	=> $this -> {base_class_model($this)} -> _getSummary($this -> _POST()), 
		'param' => $this -> _POST(), 
		'Users' => $this ->_AGENT()
	);
	$this -> load -> view("rpt_call_center/report_call_center_ctr", $UI);
 }
 
 // getAgentByGroup
 
 public function getAgentByGroup()
 {
	if( $this -> URI->_get_have_post('GroupId') )
	{
		if($this -> URI->_get_post('GroupId')== 'tsr'){
			$_conds = $this -> M_Report -> getAgent($this -> URI->_get_post('GroupId'));
			if( is_array($_conds) AND count($_conds)> 0 ){
				__(form() -> listcombo('Content_Filter','', $_conds));
			}
			else{
				__(form() -> combo('Content_Filter','select', array()));
			}
		}
		else if($this -> URI->_get_post('GroupId')== 'cmp'){
			$_conds = $this -> M_Report -> getCmp($this -> URI->_get_post('GroupId'));
			if( is_array($_conds) AND count($_conds)> 0 ){
				__(form() -> listcombo('Content_Filter','', $_conds));
			}
			else{
				__(form() -> combo('Content_Filter','select', array()));
			}
		}
		else{
			__(form() -> combo('Content_Filter','select', array()));
		}
		
		
	}
	else{
		__(form() -> combo('Content_Filter','select', array()));
	}	
 }
 
 // getCmpByGroup
 
 public function getCmpByGroup()
 {
	if( $this -> URI->_get_have_post('GroupId') )
	{
		if($this -> URI->_get_post('GroupId')== 'cmp'){
			$_conds = $this -> M_Report -> getCmp($this -> URI->_get_post('GroupId'));
			if( is_array($_conds) AND count($_conds)> 0 ){
				__(form() -> listcombo('Content_Filter','', $_conds));
			}
			else{
				__(form() -> combo('Content_Filter','select', array()));
			}
		}
	}
 }
 
 // public 
 
 public function _POST()
 {
	$_reqs = array(); $filter = array('AgentId');
	
	$param =  $this -> URI -> _get_all_request();
	foreach( $param as $keys => $values ) 
	{ 
		if( in_array($keys, $filter) ){
			$_reqs[$keys] = $this -> URI->_get_array_post($keys);
		}
		else{
			$_reqs[$keys] = $values;
		}
	}

	return $_reqs; 	
 }
 
  // public 
 
 public function _AGENT()
 {
	$_reqs = array(); 
	$filter = array('AgentId');
	
	$UserAgents = $this -> URI->_get_array_post('AgentId');
	foreach($UserAgents as $k => $v )
	{
		$_reqs[$v] = $this ->M_Report->_getAgentName($v); 	
	}
return $_reqs; 	
 }
 
 
}