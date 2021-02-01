<?php 
class AgentActivityReport extends EUI_Controller {


function AgentActivityReport() 
 {
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
		'mode_call_type'  => $this -> M_Combo->_getCallDirection()
	);  
	
	$this -> load -> view("rpt_agent_activity/report_call_activity_nav", $UI);
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
			case 'hourly' 	: $this -> Hourly(); 	break;
			case 'daily'	: $this -> Daily();  	break;
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
			case 'hourly' 	: $this -> Hourly(); 	break;
			case 'daily'	: $this -> Daily();  	break;
			case 'summary'	: $this -> Summary(); 	break;
		}
	}
 }
 
 // Hourly
 public function Hourly()
 {
	$UI = array('view' => $this ->{base_class_model($this)}->_getHourly() );
	$this -> load -> view("rpt_agent_activity/report_call_activity_hourly", $UI);
 }
 
 
 // daily
 
 public function Daily()
 {
	$UI = array
	(
		'view'   => $this ->{base_class_model($this)}->_getDaily($this -> _POST()), 
		'Timer'	 => $this -> {base_class_model($this)} -> _getDailyReasonType($this -> _POST()),
		'Reason' => $this -> M_Report->_ReasonType(),
		'param'  => $this -> _POST(),
		'Users'  => $this -> _AGENT()	
	);
	$this -> load -> view("rpt_agent_activity/report_call_activity_daily", $UI);
 }
 
 // monthly 
 
 public function Summary()
 {
	$UI = array
	(
		'view' 	 => $this -> {base_class_model($this)} -> _getSummary($this -> _POST()), 
		'Timer'	 => $this -> {base_class_model($this)} -> _getSummaryReasonType($this -> _POST()),
		'Reason' => $this -> M_Report->_ReasonType(),
		'param'  => $this -> _POST(), 
		'Users'  => $this -> _AGENT()
		
	);
	$this -> load -> view("rpt_agent_activity/report_call_activity_summary", $UI);
 }
 
 // getAgentByGroup
 
 public function getAgentByGroup()
 {
	if( $this -> URI->_get_have_post('GroupId') )
	{
		$_conds = $this -> M_Report -> getAgent($this -> URI->_get_post('GroupId'));
		if( is_array($_conds) AND count($_conds)> 0 ){
			__(form() -> listcombo('AgentId','', $_conds));
		}
		else{
			__(form() -> combo('AgentId','select', array()));
		}
	}
	else{
		__(form() -> combo('AgentId','select', array()));
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