<?php
class M_ModDashboard extends EUI_Model
{

function _getSummaryDataResult()
{
	$_conds = array();
	
	$this -> db ->select("
			COUNT(a.CustomerId) as Jumlah, a.CallReasonId, e.Name as CallType,
			IF( c.CallReasonDesc is null, 'New',c.CallReasonDesc) as CallReasonDesc",FALSE
			);
				
	$this -> db ->from("t_gn_customer a"); 
	$this -> db ->join("t_gn_assignment b ","a.CustomerId=b.CustomerId","INNER");
	$this -> db ->join("t_lk_callreason c ","a.CallReasonId=c.CallReasonId","LEFT");
	$this -> db ->join("t_lk_callreasoncategory d ","c.CallReasonCategoryId=d.CallReasonCategoryId","LEFT");
	$this -> db ->join("t_lk_outbound_goals e ", "d.CallOutboundGoalsId=e.OutboundGoalsId","LEFT");
	$this -> db ->join("tms_agent f ", "b.AssignSelerId=f.UserId","LEFT");
	
// user admin
 
	if( $this -> EUI_Session->_get_session('HandlingType')==USER_ADMIN ){
		$this ->db ->where('f.admin_id',$this -> EUI_Session -> _get_session('UserId'));
	}
	
// manager
 	
	if( $this -> EUI_Session->_get_session('HandlingType')==USER_ACCOUNT_MANAGER ){
		$this ->db ->where('f.act_mgr',$this -> EUI_Session -> _get_session('UserId'));
	}
	
// manager
 	
	if( $this -> EUI_Session->_get_session('HandlingType')==USER_MANAGER ){
		$this ->db ->where('f.mgr_id',$this -> EUI_Session -> _get_session('UserId'));
	}
	
// supervisor 
	
	if( $this -> EUI_Session->_get_session('HandlingType')==USER_SUPERVISOR ){
		$this ->db ->where('f.spv_id',$this -> EUI_Session -> _get_session('UserId'));
	}
	
//	Leader

	if( $this -> EUI_Session->_get_session('HandlingType')==USER_LEADER ){
		$this ->db ->where('f.tl_id',$this -> EUI_Session -> _get_session('UserId'));
	}
	
// inbound 
	
	if( $this -> EUI_Session->_get_session('HandlingType')==USER_AGENT_INBOUND ){
		$this ->db ->where('f.UserId',$this -> EUI_Session -> _get_session('UserId'));
	}
	
// outbound 
	
	if( $this -> EUI_Session->_get_session('HandlingType')==USER_AGENT_OUTBOUND ){
		$this ->db ->where('f.UserId',$this -> EUI_Session -> _get_session('UserId'));
	}
	
// CampaignId 
	
	if( $this -> URI -> _get_have_post('CampaignId')){
		$this ->db ->where('a.CampaignId', $this -> URI->_get_post('CampaignId'));
	}	
			
	$this ->db ->group_by("a.CallReasonId");

	$i = 0;
	foreach( $this ->db -> get() ->result_assoc() as $rows ){
		$_conds[$i] = $rows;
		$i++;
	}	
	
	return $_conds;
}

// appointment day

function _getSummaryAppoinmentData()
{
	$_conds = array();
	
	$this -> db -> select("COUNT(a.AppoinmentId) as jumlah,   
				DATE_FORMAT(a.ApoinmentDate,'%d-%M-%Y') as tanggal, 
				DATE(a.ApoinmentDate) as AppoinmentDate", FALSE);
				
	$this -> db -> from("t_gn_appoinment a");
	$this -> db -> join("t_gn_customer b "," a.CustomerId=b.CustomerId","LEFT");
	$this -> db -> join("t_gn_assignment c ", " a.CustomerId=c.CustomerId","LEFT");
	$this -> db -> join("tms_agent f ", "c.AssignSelerId=f.UserId","LEFT");
	
	$this -> db -> where("a.ApoinmentFlag",0);
	$this -> db -> where("DATE(a.ApoinmentDate)>=", date('Y-m-d'));
	$this -> db -> where("DATE(a.ApoinmentDate)<=", date('Y-m-d'));
	$this -> db -> where("DATE(a.ApoinmentDate)!=", '0000-00-00');
	
// user admin
 
	if( $this -> EUI_Session->_get_session('HandlingType')==USER_ADMIN ){
		$this ->db ->where('f.admin_id',$this -> EUI_Session -> _get_session('UserId'));
	}
	
// account manager
 	
	if( $this -> EUI_Session->_get_session('HandlingType')==USER_ACCOUNT_MANAGER ){
		$this ->db ->where('f.mgr_id',$this -> EUI_Session -> _get_session('UserId'));
	}
	
// manager
 	
	if( $this -> EUI_Session->_get_session('HandlingType')==USER_MANAGER ){
		$this ->db ->where('f.mgr_id',$this -> EUI_Session -> _get_session('UserId'));
	}
	
// supervisor 
	
	if( $this -> EUI_Session->_get_session('HandlingType')==USER_SUPERVISOR ){
		$this ->db ->where('f.spv_id',$this -> EUI_Session -> _get_session('UserId'));
	}
	
//	Leader

	if( $this -> EUI_Session->_get_session('HandlingType')==USER_LEADER ){
		$this ->db ->where('f.tl_id',$this -> EUI_Session -> _get_session('UserId'));
	}
	
// inbound 
	
	if( $this -> EUI_Session->_get_session('HandlingType')==USER_AGENT_INBOUND ){
		$this ->db ->where('f.UserId',$this -> EUI_Session -> _get_session('UserId'));
	}
	
// outbound 
	
	if( $this -> EUI_Session->_get_session('HandlingType')==USER_AGENT_OUTBOUND ){
		$this ->db ->where('f.UserId',$this -> EUI_Session -> _get_session('UserId'));
	}

	
// group by 
	
	$this -> db -> group_by("tanggal");
	
	$i = 0;
	foreach($this -> db->get()->result_assoc() as $rows ){
		$_conds[$i] = $rows; $i++;
	}	
	
	return $_conds;
}





}


?>