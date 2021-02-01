<?php
class ActivityReport extends EUI_Controller
{

/* 
 * @ def : public index 
 * -----------------------------------
 * @ akses : public 
 */

 public function ActivityReport()
 {
	parent::__construct();
	$this -> load->model(array('M_Report','M_SysUser'));
 }
  
 /* 
 * @ def : public index 
 * -----------------------------------
 * @ akses : public 
 */

 function _getMode()
 {
	return array(
		'hourly' => 'Hourly',
		'daily' => 'Daily',
		'summary' => 'Summary'
	);
	
 } 
 
/* 
 * @ def : public index 
 * -----------------------------------
 * @ akses : public 
 */

 
function _getByLogin()
{
	$_combo = array();
	$datas = $this -> M_SysUser->_get_user_by_login();
	foreach($datas as $k => $values)
	{
		$_combo[$values['UserId']] = $values['full_name'];
	}
	
	return $_combo;
}

 
/* 
 * @ def : public index 
 * -----------------------------------
 * @ akses : public 
 */

 
function ListAgent()
{
	$param = $this -> URI->_get_all_request();
	if( is_array( $param) )
	{
		$AgentId = $this -> M_SysUser->_get_teleamarketer( array('spv_id'=> $param['spv_id']));
		if( $param['type']=='check' 
			AND count($AgentId)>0 )
		{
			echo form() -> listcombo('agent_id',null,$AgentId);
		}
		else {
			echo form() -> combo('agent_id','select long', array(),null);
		}
	}
}
 
/* 
 * @ def : public index 
 * -----------------------------------
 * @ akses : public 
 */

 function _getGroupBy()
 {
	return array(
		'group_spv' => 'Group By Supervisor',
		'group_agent' => 'Group By Agent'
	);
	
 } 
 
/* 
 * @ def : public index 
 * -----------------------------------
 * @ akses : public 
 */
 
function ListSpv()
{
	if( $this -> URI->_get_post('type')=='check')
	{
		echo form() -> listcombo('spv_id',null,$this -> M_SysUser->_get_supervisor());
	}
	else if( $this -> URI->_get_post('type')=='combo')
	{
		echo form() -> combo('spv_id','select long',$this -> M_SysUser->_get_supervisor(),null,array("change"=>"Ext.DOM.getAgentId();"));
	}
	else{
		echo form() -> combo('spv_id','select long',array(),null,array("change"=>"Ext.DOM.getAgentId();"));
	}
} 
  
/* 
 * @ def : public index 
 * -----------------------------------
 * @ akses : public 
 */
 
 public function index()
  {
	if( $this -> EUI_Session->_have_get_session('UserId')) 
	{
		$UI = array
		(
			'report_type' 	=> $this -> M_Report ->_getReportType('ACTIVITY'),
			'spv_id' 		=> $this -> M_SysUser->_get_supervisor(),
			'agent_id' 		=> $this -> _getByLogin(),
			'group_by' 		=> $this -> _getGroupBy(),
			'mode' 			=> $this -> _getMode()
		);
		
		$this -> load->report('agent_activity_report/view_activity_report',$UI);	
	}
 }
 
 
/* 
 * @ def : public index  under global data HTML
 * -----------------------------------
 * @ akses : public 
 */
 
 public function viewHTML()
 {
	$param = array();
	foreach( $this -> URI ->_get_all_request() 
		as $keys => $values ) 
	{
		$object = $this -> URI ->_get_array_post($keys);

		if( count($object)> 1){
			foreach($object as $num => $post ) {
				$param[$keys][] = base64_decode($post);
			}
		}
		else
		{
			if( $keys =='spv_id'){
				foreach($this -> URI ->_get_array_post($keys) as $n => $p ) {
					$param[$keys][] = base64_decode($p);
				}
			}
			
			else if( $keys =='start_date') 
				$param[$keys] = ( $this -> URI ->_get_have_post($keys) ? _getDateEnglish(base64_decode($values)): '');
				
			else if( $keys =='end_date') 
				$param[$keys] = ( $this -> URI ->_get_have_post($keys) ? _getDateEnglish(base64_decode($values)): '');
				
			else
			{
				$param[$keys] = ( $this -> URI ->_get_have_post($keys) ? base64_decode($values) : '');
			}
		}
	}
	
 	

// cek avability 

	if( !is_null($param) AND count($param) > 0 ) 
	{
		foreach($this ->M_Report -> _getCallType($param['report_type'])  AS $result_keys => $result_value ) {
			$param[$result_keys] = $result_value; 
		}
		
		$this -> ReportModel($param, $PlainText ='html');
	}
 }
 
 
 
/* 
 * @ def : public index  under global data HTML
 * -----------------------------------
 * @ akses : public 
 */
 
 
function viewExcel()
{
	$param = array();
	foreach( $this -> URI ->_get_all_request() 
		as $keys => $values ) 
	{
		$object = $this -> URI ->_get_array_post($keys);

		if( count($object)> 1){
			foreach($object as $num => $post ) {
				$param[$keys][] = base64_decode($post);
			}
		}
		else
		{
			if( $keys =='spv_id'){
				foreach($this -> URI ->_get_array_post($keys) as $n => $p ) {
					$param[$keys][] = base64_decode($p);
				}
			}
			
			else if( $keys =='start_date') 
				$param[$keys] = ( $this -> URI ->_get_have_post($keys) ? _getDateEnglish(base64_decode($values)): '');
				
			else if( $keys =='end_date') 
				$param[$keys] = ( $this -> URI ->_get_have_post($keys) ? _getDateEnglish(base64_decode($values)): '');
				
			else
			{
				$param[$keys] = ( $this -> URI ->_get_have_post($keys) ? base64_decode($values) : '');
			}
		}
	}
	
 	

// cek avability 

	if( !is_null($param) AND count($param) > 0 ) 
	{
		foreach($this ->M_Report -> _getCallType($param['report_type'])  AS $result_keys => $result_value ) {
			$param[$result_keys] = $result_value; 
		}
		Excel() -> HTML_Excel($param['report_type']);
		$this -> ReportModel($param, $PlainText ='xls');
	}	
}
 
/* 
 * @ def : public index  under global data HTML
 * -----------------------------------
 * @ akses : public 
 */
 
 public function ReportModel( $param = null, $PlainText = null ) 
 {
	if( isset($param['Model']) && !is_null($param) ) 
	{
		$M_Instance = $param['Model']; // cek if exist model 
		$this -> load -> model($M_Instance); // load model 
		
		if(class_exists($M_Instance) ) // if true load off class 
		{ 
			$this->{$M_Instance}->index($param);
			$this->load->report
			( 
				"agent_activity_report/{$param['report_type']}_{$param['group_by']}_{$param['mode']}_{$PlainText}", 
				 array( 
					'rows' 		=> $this->{$M_Instance}-> _getBodyView(), 
					'param' 	=> $this->{$M_Instance}-> _getParam(), 
					'SysUser' 	=> new M_SysUser(), 
					'groupby'   => $this ->_getGroupBy() 
				)
			);
		}
	}
 }
 
 
} 

?>