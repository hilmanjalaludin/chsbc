<?php
class M_MonAgentActivity extends EUI_Model 
{

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

 function _getAgentStatus($pos=0)
{	
	$_conds = array(0=> "Logout", 1=> "Ready", "Not Ready", "ACW", "Busy");	
	return $_conds[$pos];
}

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getExtStatus($pos=0)
{	
	$_conds = array(4=>"Offhook", "Ringing", "Dialing", "Talking", "Held", 17=>"Reserved", 25 => "Idle");
	return $_conds[$pos];
}


function UserActivity( $UserId=null )
{
	$Time = 0;
	$conds1 = " unix_timestamp(now()) - unix_timestamp(b.ext_status_time) as ext_duration, ";
	$conds2 = " unix_timestamp(now()) - unix_timestamp(b.status_time) as stat_duration ";
	if( QUERY == 'mssql') {
		$conds1 = " DATEDIFF(ss, b.ext_status_time, GETDATE()) as ext_duration ";
		$conds2 = " DATEDIFF(ss, b.status_time, GETDATE()) as stat_duration "; 
	}
	$this ->db->select($conds1.$conds2,FALSE);
	$this ->db->from('cc_agent a');
	$this ->db->join("cc_agent_activity b","a.id= b.agent","LEFT");
	$this ->db->join("tms_agent c ", "a.userid = c.id","LEFT");
	$this ->db->where("c.UserId",$UserId);
	$rows = $this ->db->get() -> result_first_assoc();
	if( $rows ) {
		$Time = $rows['stat_duration'];
	}
	
	return _getDuration($Time);
	
}


/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

 function _getStore()
{
	$out = new EUI_Object(_get_all_request());
	$AgentActivityCode = $out->get_array_value('AgentActivityCode');
	
	// -------------- filter status this ------------------------------
	$conds1 = " unix_timestamp(now()) - unix_timestamp(b.ext_status_time) as ext_duration ";
	$conds2 = " unix_timestamp(now()) - unix_timestamp(b.status_time) as stat_duration ";
 
	if( QUERY == 'mssql') {
		$conds1 = " DATEDIFF(ss, DATEADD(second, -0,b.ext_status_time), GETDATE() ) as ext_duration ";
		$conds2 = " DATEDIFF(ss, DATEADD(second, -0,b.status_time), GETDATE() ) as stat_duration ";
	}
	
	$CallActivity = array();
	if($this->EUI_Session->_get_session('HandlingType')== USER_QUALITY_STAFF )
	{ 
		$this-> db ->select(
				'a.userid, b.ext_number, b.status, b.ext_status, 
				 d.reason_desc as ReasonStatus, b.ext_status_time, b.status_time, b.login_time, 
				 '.$conds1.',
				 '.$conds2.',
				 remote_number, data as datas',FALSE);
				 
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->where('c.user_state',1);
		$this-> db ->where_not_in('c.handling_type',array(USER_ROOT));
	}
	
	if($this->EUI_Session->_get_session('HandlingType')== USER_QUALITY_HEAD )
	{ 
		$this-> db ->select(
				'a.userid, b.ext_number, b.status, b.ext_status, 
				 d.reason_desc as ReasonStatus, b.ext_status_time, b.status_time, b.login_time, 
				 '.$conds1.',
				 '.$conds2.',remote_number, data as datas',FALSE);
				 
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->where('c.user_state',1);
		$this-> db ->where_not_in('c.handling_type',array(USER_ROOT));
	}
	
	if($this->EUI_Session->_get_session('HandlingType')== USER_ROOT )
	{ 
		$this-> db ->select(
				'a.userid,  b.ext_number, b.status, b.ext_status, 
				 d.reason_desc as ReasonStatus, b.ext_status_time, b.status_time, b.login_time, 
				 '.$conds1.',
				 '.$conds2.',
				 remote_number, concat(e.Recsource,"-",e.CustomerFirstName) as datas',FALSE);
				 
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->join('t_gn_customer e','b.data=e.CustomerId','LEFT');
		$this-> db ->where('c.user_state',1);
	}
	else if($this->EUI_Session->_get_session('HandlingType')==USER_ADMIN)
	{
		$this-> db ->select(
				'a.userid, b.ext_number, b.status, b.ext_status, 
				 d.reason_desc as ReasonStatus, b.ext_status_time, b.status_time, b.login_time, 
				 '.$conds1.',
				 '.$conds2.',
				 remote_number, data as datas',FALSE);
				 
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->where('c.user_state',1);
		$this-> db ->where_not_in('c.handling_type',array(USER_ROOT));
	}
	else if($this->EUI_Session->_get_session('HandlingType')==USER_QUALITY)
	{
		$this-> db ->select(
				'a.userid, b.ext_number, b.status, b.ext_status, 
				 d.reason_desc as ReasonStatus, b.ext_status_time, b.status_time, b.login_time, 
				 '.$conds1.',
				 '.$conds2.',
				 remote_number, data as datas',FALSE);
				 
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->where('c.user_state',1);
		$this-> db ->where_not_in('c.handling_type',array(USER_ROOT));
	}
	
	else if($this->EUI_Session->_get_session('HandlingType')==USER_ACCOUNT_MANAGER)
	{
		$this-> db ->select(
				'a.userid, b.ext_number, b.status, b.ext_status, 
				 d.reason_desc as ReasonStatus, b.ext_status_time, b.status_time, b.login_time, 
				 '.$conds1.',
				 '.$conds2.',
				 remote_number, data as datas',FALSE);
				 
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->where('c.user_state',1);
		$this-> db ->where('c.act_mgr', $this -> EUI_Session->_get_session('UserId')); 
		$this-> db ->where_in('c.handling_type',array(USER_MANAGER,USER_SUPERVISOR,USER_LEADER,USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)); 
		$this-> db ->where_not_in('c.handling_type',array(USER_ROOT));
		
	}
	else if($this->EUI_Session->_get_session('HandlingType')==USER_MANAGER)
	{
		$this-> db ->select(
				'a.userid, b.ext_number, b.status, b.ext_status, 
				 d.reason_desc as ReasonStatus, b.ext_status_time, b.status_time, b.login_time, 
				 '.$conds1.',
				 '.$conds2.',
				 remote_number, concat(e.Recsource,"-",e.CustomerFirstName) as datas',FALSE);
				 
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->join('t_gn_customer e','b.data=e.CustomerId','LEFT');
		$this-> db ->where('c.user_state',1);
		$this-> db ->where('c.mgr_id', $this -> EUI_Session->_get_session('UserId')); 
		$this-> db ->where_in('c.handling_type',array(USER_SUPERVISOR,USER_LEADER,USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)); 
		$this-> db ->where_not_in('c.handling_type',array(USER_ROOT));
	}
	else if($this->EUI_Session->_get_session('HandlingType')==USER_SUPERVISOR)
	{
		$this-> db ->select(
				'a.userid, b.ext_number, b.status, b.ext_status, 
				 d.reason_desc as ReasonStatus, b.ext_status_time, b.status_time, b.login_time, 
				 '.$conds1.',
				 '.$conds2.',remote_number, concat(e.Recsource,"-",e.CustomerFirstName) as datas',FALSE);
				 
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->join('t_gn_customer e','b.data=e.CustomerId','LEFT');
		$this-> db ->where('c.spv_id', $this -> EUI_Session->_get_session('UserId')); 
		$this-> db ->where_in('c.handling_type',array(USER_LEADER,USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)); 
		$this-> db ->where_not_in('c.handling_type',array(USER_ROOT));
	}
	
	else if($this->EUI_Session->_get_session('HandlingType')==USER_LEADER)
	{
		$this-> db ->select(
				'a.userid, b.ext_number, b.status, b.ext_status, 
				 d.reason_desc as ReasonStatus, b.ext_status_time, b.status_time, b.login_time, 
				 '.$conds1.',
				 '.$conds2.',
				 remote_number, data as datas',FALSE);
				 
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->where('c.user_state',1);
		$this-> db ->where('c.tl_id', $this -> EUI_Session->_get_session('UserId')); 
		$this-> db ->where_in('c.handling_type',array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)); 
		$this-> db ->where_not_in('c.handling_type',array(USER_ROOT));
	}
	else if($this->EUI_Session->_get_session('HandlingType')==USER_AGENT_OUTBOUND)
	{
		$this-> db ->select(
				'a.userid, b.ext_number, b.status, b.ext_status, 
				 d.reason_desc as ReasonStatus, b.ext_status_time, b.status_time, b.login_time, 
				 '.$conds1.',
				 '.$conds2.',remote_number, data as datas',FALSE);
				 
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->where('c.user_state',1);
		$this-> db ->where_not_in('c.handling_type',array(USER_ROOT));
	}
	else if($this->EUI_Session->_get_session('HandlingType')==USER_AGENT_INBOUND)
	{
		$this-> db ->select(
				'a.userid, b.ext_number, b.status, b.ext_status, 
				 d.reason_desc as ReasonStatus, b.ext_status_time, b.status_time, b.login_time, 
				 '.$conds1.',
				 '.$conds2.',
				 remote_number, data as datas',FALSE);
				 
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->where('c.user_state',1);
		$this-> db ->where_not_in('c.handling_type',array(USER_ROOT));
	}
	
	
// --------------------- handle filter status on here --------------------	
	if(is_array($AgentActivityCode) 
		AND count($AgentActivityCode) > 0 ) 
	{
		$this->db->where_in("b.status", $AgentActivityCode);
	}
	
// --------------- on proces check here ----------------------
	// echo $this->db->print_out();
	
	$rs = $this->db->get();
	#var_dump( $this->db->last_query() );die();
	$i = 0;
	if( $rs->num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $ActivityAgent )
	{	
		$UserId			= $ActivityAgent['userid'];
		$UserName		= $ActivityAgent['name'];
		$remote	   	   	= $ActivityAgent['remote_number'];
		$ExtNumber	   	= $ActivityAgent['ext_number'];
		
		$AgentStatus	= (INT)$ActivityAgent['status'];
		$StatDuration 	= (INT)$ActivityAgent['stat_duration'];
		$ExtDuration  	= (INT)$ActivityAgent['ext_duration'];
		$ExtStatus     	= (INT)$ActivityAgent['ext_status'];
		$StatusTime   	= (INT)$ActivityAgent['status_time'];
		$ReasonStatus  	= $ActivityAgent['ReasonStatus'];
		
		
		if($StatDuration<=0){
			$StatDuration = _getDuration(0);
		}
		
		if($ExtDuration<0) {
			$ExtDuration = _getDuration(0); 
		}
		
		if($ExtStatus==7) {
			$ExtensionStatus = $this -> _getExtStatus($ExtStatus);
			$CallerData 	 = $ActivityAgent['datas'];
			$CallerAction	 = '<span onclick="Ext.DOM.SpyAgent(\''.$this -> EUI_Session->_get_session('agentExt').'\', \''.$ExtNumber.'\')" style="cursor:pointer;color:red;font-weight:bold;"> [ Spy ]</span> <span onclick="Ext.DOM.CoachAgent(\''.$this -> EUI_Session->_get_session('agentExt').'\', \''.$ExtNumber.'\')" style="cursor:pointer;color:red;font-weight:bold;"> [ Coach ]</span>';
		}
		else{
			$ExtensionStatus  = $this -> _getExtStatus($ExtStatus);
			$CallerData 	  = '';
			$CallerAction  	  = '';
		}
		
		if($ExtStatus==6 || $ExtStatus==5) {
			// $ExtensionStatus = $this -> _getExtStatus($ExtStatus);
			$CallerData 	 = $ActivityAgent['datas'];
			// $CallerAction	 = '<span onclick="Ext.DOM.SpyAgent(\''.$this -> EUI_Session->_get_session('agentExt').'\', \''.$ExtNumber.'\')" style="cursor:pointer;color:red;font-weight:bold;"> [ Spy ]</span> <span onclick="Ext.DOM.CoachAgent(\''.$this -> EUI_Session->_get_session('agentExt').'\', \''.$ExtNumber.'\')" style="cursor:pointer;color:red;font-weight:bold;"> [ Coach ]</span>';
		}
			
		$AgentStatusStr  = null;
		
		

		
		$AgentStatusStr.= $this -> _getAgentStatus($AgentStatus);
		
		// ready  
		if($AgentStatus==1)
			$StatDuration = _getDuration($StatDuration);
		
		// not ready 
		if($AgentStatus==2)
			$StatDuration = _getDuration($StatDuration);
			
		if($AgentStatus==3)
			$StatDuration = _getDuration($StatDuration);	
			
			
		if($AgentStatus==4){
			if($ExtStatus==7){
				$StatDuration = _getDuration($ExtDuration);	
			} else {
				$StatDuration = _getDuration($StatDuration);	
			}
		}
		
		// reason 
		
		if(!is_null($ReasonStatus))
			$AgentStatusStr.= " ( $ReasonStatus )";
			
		
		if($AgentStatus == 0)
		{
			$style='color: red;';
			$ExtensionStatus = '';
			$CallerData = '';
			$StatusTime = '';
		}
		else{ 
			$style = 'color:blue;'; 
		}
		
		
		$CallActivity[$i]['UserId']		= (!is_null($UserId) ? $UserId : '-'); 
		$CallActivity[$i]['Name'] 		= (!is_null($UserName) ? $UserName : '-');
		$CallActivity[$i]['Extension']	= (!is_null($ExtNumber) ? $ExtNumber :'-');
		$CallActivity[$i]['Status'] 	= (!is_null($AgentStatusStr) ? $AgentStatusStr : '-' );
		$CallActivity[$i]['Duration'] 	= (!is_null($StatDuration) ? $StatDuration : '-' );
		$CallActivity[$i]['ExtStatus'] 	= (!is_null($ExtensionStatus) ? $ExtensionStatus : '-' );
		$CallActivity[$i]['Data'] 		= (!is_null($CallerData) ? $CallerData : '-' );
		$CallActivity[$i]['Action'] 	= (!is_null($CallerAction)? $CallerAction: '-');
		$CallActivity[$i]['Styles'] 	= (!is_null($style) ? $style: '-');
		
		
		
		$i++;
	}
	
	return $CallActivity;
	
}
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

 function _getIndex()
{
	$out = new EUI_Object(_get_all_request());
	$AgentActivityCode = $out->get_array_value('AgentActivityCode');
	
	
	$CallActivity = array();
	if($this->EUI_Session->_get_session('HandlingType')== USER_ROOT )
	{ 
		$this-> db ->select('a.userid as UserId, a.name as UserName',FALSE);
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->where('c.user_state',1);
	}
	else if($this->EUI_Session->_get_session('HandlingType')==USER_QUALITY_HEAD)
	{
		$this-> db ->select('a.userid as UserId, a.name as UserName',FALSE);
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->where('c.user_state',1);
		$this-> db ->where_in('c.profile_id',array(11,5));
		$this-> db ->where_not_in('c.handling_type',array(USER_ROOT));
	}
	else if($this->EUI_Session->_get_session('HandlingType')==USER_QUALITY_STAFF)
	{
		$this-> db ->select('a.userid as UserId, a.name as UserName',FALSE);
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->where('c.user_state',1);
		$this-> db ->where_not_in('c.handling_type',array(USER_ROOT));
	}
	else if($this->EUI_Session->_get_session('HandlingType')==USER_ADMIN)
	{
		$this-> db ->select('a.userid as UserId, a.name as UserName',FALSE);
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->where('c.user_state',1);
		$this-> db ->where_not_in('c.handling_type',array(USER_ROOT));
	}
	else if($this->EUI_Session->_get_session('HandlingType')==USER_QUALITY)
	{
		$this-> db ->select('a.userid as UserId, a.name as UserName',FALSE);
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->where('c.user_state',1);
		$this-> db ->where_not_in('c.handling_type',array(USER_ROOT));
	}
	else if($this->EUI_Session->_get_session('HandlingType')==USER_ACCOUNT_MANAGER)
	{
		$this-> db ->select('a.userid as UserId, a.name as UserName',FALSE);
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->where('c.user_state',1);
		$this-> db ->where('c.act_mgr', $this -> EUI_Session->_get_session('UserId')); 
		$this-> db ->where_in('c.handling_type',array(USER_MANAGER,USER_SUPERVISOR,USER_LEADER,USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)); 
		$this-> db ->where_not_in('c.handling_type',array(USER_ROOT));
	}
	else if($this->EUI_Session->_get_session('HandlingType')==USER_MANAGER)
	{
		$this-> db ->select('a.userid as UserId, a.name as UserName',FALSE);
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->where('c.user_state',1);
		$this-> db ->where('c.mgr_id', $this -> EUI_Session->_get_session('UserId')); 
		$this-> db ->where_in('c.handling_type',array(USER_SUPERVISOR,USER_LEADER,USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)); 
		$this-> db ->where_not_in('c.handling_type',array(USER_ROOT));
	}
	else if($this->EUI_Session->_get_session('HandlingType')==USER_SUPERVISOR)
	{
		$this-> db ->select('a.userid as UserId, a.name as UserName, e.Recsource',FALSE);
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->join('t_gn_customer e','b.data=e.CustomerId','LEFT');
		$this-> db ->where('c.user_state',1);
		$this-> db ->where('c.spv_id', $this -> EUI_Session->_get_session('UserId')); 
		$this-> db ->where_in('c.handling_type',array(USER_LEADER,USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)); 
		$this-> db ->where_not_in('c.handling_type',array(USER_ROOT));
	}
	
	else if($this->EUI_Session->_get_session('HandlingType')==USER_LEADER)
	{
		$this-> db ->select('a.userid as UserId, a.name as UserName',FALSE);
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->where('c.user_state',1);
		$this-> db ->where('c.tl_id', $this -> EUI_Session->_get_session('UserId')); 
		$this-> db ->where_in('c.handling_type',array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)); 
		$this-> db ->where_not_in('c.handling_type',array(USER_ROOT));
	}
	else if($this->EUI_Session->_get_session('HandlingType')==USER_AGENT_OUTBOUND)
	{
		$this-> db ->select('a.userid as UserId, a.name as UserName',FALSE);
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->where('c.user_state',1);
		$this-> db ->where_not_in('c.handling_type',array(USER_ROOT));
	}
	else if($this->EUI_Session->_get_session('HandlingType')==USER_AGENT_INBOUND)
	{
		$this-> db ->select('a.userid as UserId, a.name as UserName',FALSE);
		$this-> db ->from('cc_agent a');
		$this-> db ->join('cc_agent_activity b','a.id = b.agent','LEFT OUTER');
		$this-> db ->join('tms_agent c','a.userid = c.id','LEFT OUTER');
		$this-> db ->join('cc_reasons d','b.status_reason=d.reasonid','LEFT');
		$this-> db ->where('c.user_state',1);
		$this-> db ->where_not_in('c.handling_type',array(USER_ROOT));
	}

	// --------------------- handle filter status on here --------------------	
	if(is_array($AgentActivityCode) 
		AND count($AgentActivityCode) > 0 ) 
	{
		$this->db->where_in("b.status", $AgentActivityCode);
	}
	
	
	//$this->db->print_out();
	
// --------------- on proces check here ----------------------
	
	$rs = $this->db->get();
	
	
	
	$i = 0;
	if($rs->num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $ActivityAgent )
	{
		$CallActivity[$i] = $ActivityAgent; 
		$i++;
	}
	
	return $CallActivity;
	
}


}

?>