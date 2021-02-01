<?php
/*
 * E.U.I 
 * -----------------------------------------------
 *
 * subject	: M_QtyApprovalData
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class M_QtyApprovalData Extends EUI_Model
{

var $set_limit_page = 10;
// ---------------------------------------------------------------------------------------------------------------- 
/* 
 * @ package 	: instance of class  
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * 
 */
 
  private static $Instance   = null; 
  public static function &Instance()
 {
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
 }

 
// ---------------------------------------------------------------------------------------------------------------- 
/* 
 * @ package 	: constructor 
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * 
 */
 
 public function __construct()
 {
	$this->load->model(array( 
		'M_SetResultQuality','M_SysUser','M_SrcCustomerList','M_SetCallResult',
		'M_SetProduct','M_SetCampaign','M_SetCallResult','M_SetResultQuality'
	));
	
 }
 
 /*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 private function _getApprovalInterest()
 {
	$_conds = array();
	if(class_exists('M_SetCallResult'))
	{
		$i = 0;
		foreach( $this -> M_SetCallResult -> _getEventSale() as $k => $rows )
		{
			$_conds[$i] = $k;
			$i++;
		}
	}
	return $_conds;
 }
 
  public function getDurationAll ( $query = "" ) {
	$totalDuration = 0;
	$query = $this->db->query( $query );
	if ( $query->num_rows > 0 ) {
		foreach ( $query->result() as $gtd ) {
			$totalDuration += $gtd->Duration;
		}
	} else {
		$totalDuration += 0;
	}
	
	return $totalDuration;
	
 }
 
 /*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 private function _getQualityConfirm()
 {
	$_conds = array();
	if(class_exists('M_SetResultQuality'))
	{
		$i = 0;
		foreach( $this -> M_SetResultQuality -> _getQualityVeryfied() as $k => $rows )
		{
			$_conds[$i] = $k;
			$i++;
		}
	}
	return $_conds;
 }
 
 /*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function _get_default()
{

// -------------------------------------------------------------------------------------
 $sts =& get_class_instance('M_SetCallResult');
 $out = new EUI_Object(_get_all_request());
 $obClass =& Spliter(LIST_QUALITY_APPROVAL);	
	
 
// -------------------------------------------------------------------------------------

 $this->EUI_Page->_setPage($this->set_limit_page);
 
 $this->EUI_Page->_setSelect("a.CustomerId, (SELECT pl.PolicySalesDate FROM t_gn_policyautogen pc 
	  INNER JOIN t_gn_policy pl on pc.PolicyNumber=pl.PolicyNumber 
	  WHERE pc.CustomerId=a.CustomerId LIMIT 1) as PolicySalesDate ,
	  (SELECT SUM(duration) as Duration FROM cc_recording a 
			WHERE assignment_data = a.CustomerId
			GROUP BY assignment_data) as Duration", FALSE);
 
 $this->EUI_Page->_setFrom("t_gn_customer a");
 $this->EUI_Page->_setJoin("t_gn_assignment b "," a.CustomerId=b.CustomerId","INNER");
 $this->EUI_Page->_setJoin("t_gn_campaign c "," a.CampaignId=c.CampaignId ","LEFT");
 $this->EUI_Page->_setJoin("t_gn_policyautogen j ","b.CustomerId=j.CustomerId", "LEFT");
 $this->EUI_Page->_setJoin("t_lk_aprove_status d "," a.CallReasonQue=d.ApproveId ","LEFT",TRUE);
 
 
//------- set filter default ---------------------------------------------------------------------
 
 $this->EUI_Page->_setAnd("b.AssignBlock", 0);
 $this->EUI_Page->_setAnd("c.CampaignStatusFlag", 1);
 $this->EUI_Page->_setAnd("b.AssignAdmin IS NOT NULL");
//-------- filter -----------------------------------------------------------------

 $this->EUI_Page->_setWhereIn("a.CallReasonId",array_keys($sts->_getEventSale()) ); 
 $this->EUI_Page->_setWhereIn("d.AproveCode",$obClass->get_array() );
  
//------- filter by session -------------------------------------------------------
   
 if(in_array(_get_session('HandlingType'), array(USER_SUPERVISOR))) {
	$this->EUI_Page->_setAnd("b.AssignSpv", _get_session('UserId'));
 }
 
 if(in_array(_get_session('HandlingType'), array(USER_LEADER))) {
	$this->EUI_Page->_setAnd("b.AssignLeader", _get_session('UserId'));
 }
 
 
 if(in_array(_get_session('HandlingType'), array(USER_AGENT_INBOUND, USER_AGENT_OUTBOUND))) {
	$this->EUI_Page->_setAnd("b.AssignSelerId", _get_session('UserId'));	
 }
 
// -------------- filter by Post -------------------------------------------------------
	
 $this->EUI_Page->_setLikeCache("a.CustomerFirstName", "cust_first_name", true);
 $this->EUI_Page->_setAndCache("a.CallReasonId", "cust_call_result", true);
 $this->EUI_Page->_setAndCache("a.CustomerNumber", "cust_number_id", true);
 $this->EUI_Page->_setAndCache("b.AssignSelerId", "cust_user_id", true);
 $this->EUI_Page->_setAndCache("a.CallReasonQue", "cust_approve_status", true);	
 $this->EUI_Page->_setAndCache("a.CampaignId", "cust_campaign_id", true);
 $this->EUI_Page->_setAndCache("a.QueueId", "quality_id", TRUE);
 $this->EUI_Page->_setAndCache("j.PolicyNumber", "policy_number", TRUE);
 $this->EUI_Page->_setAndCache("b.AssignLeader", "spv_id", TRUE);
 
// ---------------- set group on here ----------------
if(_get_have_post('cust_start_date') 
	 AND  _get_have_post('cust_end_date')  )
 {
	$this->EUI_Page->_setHaving("PolicySalesDate>", $out->get_value('cust_start_date','StartDate'));
	$this->EUI_Page->_setHaving("PolicySalesDate<", $out->get_value('cust_end_date','EndDate'));
	$this->EUI_Page->_setGroupBy();
 }
 
 //echo $this->EUI_Page->_getCompiler();
 return $this->EUI_Page;
 
 
 }
 
 /*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
  public function _get_content()
{
 // -------------------------------------------------------------------------------------
 
 $sts =& get_class_instance('M_SetCallResult');
 $out = new EUI_Object(_get_all_request());
 $obClass =& Spliter(LIST_QUALITY_APPROVAL);	
// --------------------------------------------------------------------------------------
 
 $this->EUI_Page->_postPage($out->get_value('v_page'));
 $this->EUI_Page->_setPage($this->set_limit_page);

// ------------------------------- select -------------------------------------------------------------------------
//  No\/Campaign Name\/Customer Name\/Approve Status\/Agent Name\/Sales Date\/Days
// ----------------------------------------------------------------------------------------------------------------

 $this->EUI_Page->_setArraySelect(array(
	"a.CustomerId as CustomerId" => array("CustomerId","CustomerId", "primary"),
	"( select cp.CampaignDesc from t_gn_campaign cp where cp.CampaignId = a.CampaignId ) as CampaignName" => array("CampaignName","Campaign Name"),
	//"a.CustomerNumber as CustomerNumber" => array("CustomerNumber","CIF"),
	"a.CustomerFirstName as CustomerFirstName" => array("CustomerFirstName","Customer Name"),
	//"a.CustomerDOB as CustomerDOB" => array("CustomerDOB","DOB"),
	"a.CustomerDOB as CustomerAge" => array("CustomerAge","Age"),
	"(SELECT ts.init_name FROM tms_agent ts WHERE ts.UserId=b.AssignSelerId ) as AgentName" => array("AgentName","Agent ID"),
	"(SELECT ts.full_name FROM tms_agent ts WHERE ts.UserId=a.QueueId ) as QualityAgent" => array("QualityAgent","Quality Staff"),
	"(select ts.init_name from tms_agent ts where ts.UserId=b.AssignLeader) as Supervisor" => array("Supervisor", "Supervisor"),
	"IF(c.CallReasonDesc IS NULL, 'New', c.CallReasonDesc) As CallReasonDesc"=> array("CallReasonDesc","Call Result"),
	"(SELECT SUM(a.duration) as Duration FROM cc_recording a 
			WHERE a.assignment_data = a.CustomerId
			GROUP BY a.assignment_data ) As Duration"=> array("Duration","Duration"),
	"(SELECT pc.PolicyNumber FROM t_gn_policyautogen pc 
	  INNER JOIN t_gn_policy pl on pc.PolicyNumber=pl.PolicyNumber 
	  WHERE pc.CustomerId=a.CustomerId LIMIT 1) as PolicyNumber" => array("PolicyNumber","Policy Number"),
	  
	"(SELECT qs.AproveName FROM t_lk_aprove_status qs 
	WHERE qs.ApproveId=a.CallReasonQue) as ApproveStatus" => array("ApproveStatus","Quality Status"),
	  
	"(SELECT pl.PolicySalesDate FROM t_gn_policyautogen pc 
	  INNER JOIN t_gn_policy pl on pc.PolicyNumber=pl.PolicyNumber 
	  WHERE pc.CustomerId=a.CustomerId LIMIT 1) as PolicySalesDate" => array("PolicySalesDate", "Sales Date")
	 
	));
 
 $this->EUI_Page->_setFrom("t_gn_customer a");
 $this->EUI_Page->_setJoin("t_gn_assignment b "," a.CustomerId=b.CustomerId","INNER");
 $this->EUI_Page->_setJoin("t_lk_callreason c", "c.CallReasonId=a.CallReasonId", "LEFT");
 $this->EUI_Page->_setJoin("t_gn_policyautogen j ","b.CustomerId=j.CustomerId", "LEFT");
 $this->EUI_Page->_setJoin("t_lk_aprove_status d "," a.CallReasonQue=d.ApproveId ","LEFT",TRUE);

 
 
//------- set filter default ---------------------------------------------------------------------
 
 $this->EUI_Page->_setAnd("b.AssignBlock", 0);
 $this->EUI_Page->_setAnd("b.AssignAdmin IS NOT NULL");
 $this->EUI_Page->_setWhereIn("a.CallReasonId",array_keys($sts->_getEventSale()));
 $this->EUI_Page->_setWhereIn("d.AproveCode",$obClass->get_array());
 
//------- filter by session -------------------------------------------------------
   
 if(in_array(_get_session('HandlingType'), array(USER_SUPERVISOR))) {
	$this->EUI_Page->_setAnd("b.AssignSpv", _get_session('UserId'));
 }
 
 if(in_array(_get_session('HandlingType'), array(USER_LEADER))) {
	$this->EUI_Page->_setAnd("b.AssignLeader", _get_session('UserId'));
 }
 
 
 if(in_array(_get_session('HandlingType'), array(USER_AGENT_INBOUND, USER_AGENT_OUTBOUND))) {
	$this->EUI_Page->_setAnd("b.AssignSelerId", _get_session('UserId'));	
 }
 
// -------------- filter by Post -------------------------------------------------------
	
 $this->EUI_Page->_setLikeCache("a.CustomerFirstName", "cust_first_name", true);
 $this->EUI_Page->_setAndCache("a.CallReasonId", "cust_call_result", true);
 $this->EUI_Page->_setAndCache("a.CustomerNumber", "cust_number_id", true);
 $this->EUI_Page->_setAndCache("a.CampaignId", "cust_campaign_id", true);
 $this->EUI_Page->_setAndCache("b.AssignSelerId", "cust_user_id", true);
 $this->EUI_Page->_setAndCache("a.CallReasonQue", "cust_approve_status", true);	
 $this->EUI_Page->_setAndCache("a.QueueId", "quality_id", TRUE);
 $this->EUI_Page->_setAndCache("j.PolicyNumber", "policy_number", TRUE);
 $this->EUI_Page->_setAndCache("b.AssignLeader", "spv_id", TRUE);
 //----------- having && Group by  -----------------------------------------------------------------------
 
 if(_get_have_post('cust_start_date') 
	 AND  _get_have_post('cust_end_date')  )
 {
	$this->EUI_Page->_setHaving("PolicySalesDate>", $out->get_value('cust_start_date','StartDate'));
	$this->EUI_Page->_setHaving("PolicySalesDate<", $out->get_value('cust_end_date','EndDate'));
	$this->EUI_Page->_setGroupBy();
 }
 
 // -------- set order by  ----------------------------------------------
  if( !_get_have_post('order_by')) {
	$this->EUI_Page->_setOrderBy('b.AssignId','DESC');
  } else {
	$this->EUI_Page->_setOrderBy(_get_post('order_by'), _get_post('type'));
  }	
  
 // --------- set limit ---------------------------------------------------
 //echo $this->EUI_Page->_getCompiler();
  $this->EUI_Page->_setLimit();
}
 
 
/*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function _get_resource()
 {
	self::_get_content();
	
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function _get_page_number() 
 {
	
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
 
// ---------------------------------------------------------------------------------------------------------------- 
/* 
 * @ package 	: instance of class  
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * 
 */
 
 public function _set_row_rejected_policy( $out = null )
{
 if( !$out->fetch_ready() ) { return FALSE; }
 
 $arr_data = $out->get_array_value('CustomerId');
 if( is_array($arr_data) AND count($arr_data) > 0 ) 
	foreach( $arr_data as $k => $CustomerId )
 {
	$this->db->reset_write();
	$this->db->where("CustomerId", $CustomerId);
	$this->db->set("CustomerRejectedDate", date('Y-m-d H:i:s'));
	$this->db->set("QueueId", _get_session('UserId'));
	$this->db->set("CallReasonQue", REJECT_STATUS);
	$this->db->update('t_gn_customer');
	if( $this->db->affected_rows() > 0 )
	{
		return TRUE;
	}
 }
 
 return FALSE;
 
} 

/// ========================= END CLASS =================================
 
}
?>