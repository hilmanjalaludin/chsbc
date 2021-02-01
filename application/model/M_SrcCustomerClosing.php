<?php
/*
 * E.U.I 
 *
 * ---------------------------------------------------------------------------- 
 * subject	: M_SetBenefit modul 
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Utility/
 * 
 */
 
class M_SrcCustomerClosing extends EUI_Model
{
// 504,505,501,503,515,512,511,514,510,509,516,517,506,513,508,507
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
private static $Instance = null;

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public static function &Instance() 
{
  if( is_null(self::$Instance) ) {
	self::$Instance = new self();
  }
  return self::$Instance;
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function __construct() 
{
	$this->load->model(array ( 
		'M_SetCallResult', 'M_SetProduct','M_SetCampaign','M_SrcCustomerList', 
		'M_SetResultQuality','M_SetResultCategory', 'M_Combo','M_MaskingNumber'
	));
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function Sale()
{
	$_a = array(); $_b = array();
	if( class_exists('M_SetCallResult'))
	{
		$_a = $this -> M_SetCallResult->_getInterestSale(); 
		foreach( $_a as $_k => $_v )
		{
			$_b[$_k] = $_k;  
		}	
	}
	
	return $_b;
} 

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_default()
{
	$out = new EUI_Object( _get_all_request() );
	
	$obClass =& Spliter(INTEREST_IN_SUBMITED);
	
	$this->EUI_Page->_setPage(10);
	$this->EUI_Page->_setSelect("a.CustomerId,  (SELECT pl.PolicySalesDate FROM t_gn_policyautogen pc 
		  INNER JOIN t_gn_policy pl on pc.PolicyNumber=pl.PolicyNumber 
		  WHERE pc.CustomerId=a.CustomerId LIMIT 1) As PolicySalesDate
	", FALSE);
	
	
	$this->EUI_Page->_setFrom("t_gn_customer a");
	$this->EUI_Page->_setJoin("t_gn_assignment b "," a.CustomerId=b.CustomerId", "INNER");
	$this->EUI_Page->_setJoin("t_lk_gender e "," a.GenderId=e.GenderId", "LEFT");
	$this->EUI_Page->_setJoin("t_lk_cardtype c "," a.CardTypeId=c.CardTypeId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_campaign d "," a.CampaignId=d.CampaignId", "LEFT");
	$this->EUI_Page->_setJoin("t_lk_callreason f "," a.CallReasonId = f.CallReasonId", "LEFT");
	$this->EUI_Page->_setJoin("t_lk_aprove_status g "," a.CallReasonQue=g.ApproveId", "LEFT");
	$this->EUI_Page->_setJoin("tms_agent h "," a.SellerId = h.UserId", "LEFT", true);
	
// ---------------- set filter constant ----------------------------
	
	$this->EUI_Page->_setAnd("b.AssignAdmin IS NOT NULL");
	$this->EUI_Page->_setAnd("b.AssignSpv IS NOT NULL");
	$this->EUI_Page->_setAnd("b.AssignBlock", 0);
	$this->EUI_Page->_setAnd("d.CampaignStatusFlag", 1);
	$this->EUI_Page->_setWhereIn("f.CallReasonEvent", 1);
	// $this->EUI_Page->_setWhereIn("g.AproveCode", $obClass->get_array());
	
// ---------------- set filter session  ----------------------------

	if(_get_session('HandlingType')==USER_SUPERVISOR){			 
		$this->EUI_Page->_setAnd("b.AssignSpv", _get_session('UserId'));
	}
	
	if(_get_session('HandlingType')==USER_LEADER){			
		$this->EUI_Page->_setAnd("b.AssignLeader", _get_session('UserId'));
	}
	
	if(_get_session('HandlingType')==USER_AGENT_OUTBOUND){
		$this->EUI_Page->_setAnd("b.AssignSelerId", _get_session('UserId'));
	}
	
	if(_get_session('HandlingType')==USER_AGENT_INBOUND){
		$this->EUI_Page->_setAnd("b.AssignSelerId", _get_session('UserId'));
	}	
// ---------------- set filter posted ----------------------------
	
	$this->EUI_Page->_setLikeCache("a.CustomerFirstName", 'cust_name', true); 
	$this->EUI_Page->_setLikeCache("a.CustomerNumber", 'customer_number', true); 
	$this->EUI_Page->_setAndCache("a.CallReasonQue", 'verify_status', true);
	$this->EUI_Page->_setAndCache("b.AssignSelerId", 'user_agent', true);
	$this->EUI_Page->_setAndCache("a.CampaignId", 'campaign_id', true);	
	
	$this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs>='".StartDate(_get_post('start_call_date'))."' ", 'start_call_date', true);
	$this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs<='".EndDate(_get_post('end_call_date'))."' ", 'end_call_date', true);
	
// ----------------- group by ------------------------
	
	$this->EUI_Page->_setHavingOrCache("PolicySalesDate>='". StartDate(_get_post('start_sales_date'))."'", 'start_sales_date', true);
	$this->EUI_Page->_setHavingOrCache("PolicySalesDate<='". EndDate(_get_post('end_sales_date'))."'", 'end_sales_date', true);
	$this->EUI_Page->_setGroupBy('CustomerId');
	//echo $this->EUI_Page->_getCompiler();
	
	return $this->EUI_Page;	
}


/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _get_content()
{
	$obClass =& Spliter(INTEREST_IN_SUBMITED); 
	$this -> EUI_Page->_postPage(_get_post('v_page') );
	$this -> EUI_Page->_setPage(10);
	
	if(_get_session('HandlingType')==USER_SUPERVISOR){			 
		$getSelectBy = array(
			"a.CustomerId as CustomerId" => array("CustomerId", "CustomerId", "primary"),	
			"d.CampaignName as CampaignName" => array("CampaignName", "Campaign Name"),
			"a.CustomerFirstName as CustomerFirstName" => array("CustomerFirstName"," Customer Name"),
			"a.CustomerDOB as CustomerAge" => array("CustomerAge","Age"),
			"(select tm.id from tms_agent tm where tm.UserId =b.AssignSelerId) as UserId" => array("UserId", "Agent ID"),
			"(select tm.id from tms_agent tm where tm.UserId =b.AssignLeader) as Supervisor" => array("Supervisor", "Supervisor"),
			"i.full_name as QAstaff" => array("QAstaff", "QA Staff"),
			"f.CallReasonDesc as CallReasonDesc" => array("CallReasonDesc", "Call Result"),
			"g.AproveName as AproveName" => array("AproveName", "Quality Status"),
			"m.CallHistoryNotes as CallHistoryNotes" => array("CallHistoryNotes", "Quality Remarks"),
			"(SELECT SUM(a.duration) as Duration FROM cc_recording a 
				WHERE a.assignment_data = a.CustomerId
				GROUP BY a.assignment_data ) As Duration"=> array("Duration","Duration"),
				
			"(SELECT pc.PolicyNumber FROM t_gn_policyautogen pc 
			  INNER JOIN t_gn_policy pl on pc.PolicyNumber=pl.PolicyNumber 
			  WHERE pc.CustomerId=a.CustomerId LIMIT 1) as PolicyNumber" => array("PolicyNumber","Policy Number"),
			"a.CustomerUpdatedTs as CustomerUpdatedTs " => array("CustomerUpdatedTs", "Last Call Date"),
			"(SELECT pl.PolicySalesDate FROM t_gn_policyautogen pc 
			  INNER JOIN t_gn_policy pl on pc.PolicyNumber=pl.PolicyNumber 
			  WHERE pc.CustomerId=a.CustomerId LIMIT 1) As PolicySalesDate"=> array("PolicySalesDate","Sales Date"),
			"a.QA_UpdateTs as CustomerRejectedDate" => array("CustomerRejectedDate", "Verify Date")
		);
	}
	
	if(_get_session('HandlingType')==USER_LEADER){			
		$getSelectBy = array(
			"a.CustomerId as CustomerId" => array("CustomerId", "CustomerId", "primary"),	
			"d.CampaignName as CampaignName" => array("CampaignName", "Campaign Name"),
			"a.CustomerFirstName as CustomerFirstName" => array("CustomerFirstName"," Customer Name"),
			"a.CustomerDOB as CustomerAge" => array("CustomerAge","Age"),
			"(select tm.id from tms_agent tm where tm.UserId =b.AssignSelerId) as UserId" => array("UserId", "Agent ID"),
			"(select tm.id from tms_agent tm where tm.UserId =b.AssignLeader) as Supervisor" => array("Supervisor", "Supervisor"),
			"i.full_name as QAstaff" => array("QAstaff", "QA Staff"),
			"f.CallReasonDesc as CallReasonDesc" => array("CallReasonDesc", "Call Result"),
			"g.AproveName as AproveName" => array("AproveName", "Quality Status"),
			"m.CallHistoryNotes as CallHistoryNotes" => array("CallHistoryNotes", "Quality Remarks"),
			"(SELECT SUM(a.duration) as Duration FROM cc_recording a 
				WHERE a.assignment_data = a.CustomerId
				GROUP BY a.assignment_data ) As Duration"=> array("Duration","Duration"),
				
			"(SELECT pc.PolicyNumber FROM t_gn_policyautogen pc 
			  INNER JOIN t_gn_policy pl on pc.PolicyNumber=pl.PolicyNumber 
			  WHERE pc.CustomerId=a.CustomerId LIMIT 1) as PolicyNumber" => array("PolicyNumber","Policy Number"),
			"a.CustomerUpdatedTs as CustomerUpdatedTs " => array("CustomerUpdatedTs", "Last Call Date"),
			"(SELECT pl.PolicySalesDate FROM t_gn_policyautogen pc 
			  INNER JOIN t_gn_policy pl on pc.PolicyNumber=pl.PolicyNumber 
			  WHERE pc.CustomerId=a.CustomerId LIMIT 1) As PolicySalesDate"=> array("PolicySalesDate","Sales Date"),
			"a.QA_UpdateTs as CustomerRejectedDate" => array("CustomerRejectedDate", "Verify Date")
		);
	}
	
	else if(_get_session('HandlingType')==USER_AGENT_OUTBOUND){
		$getSelectBy = array(
			"a.CustomerId as CustomerId" => array("CustomerId", "CustomerId", "primary"),	
			"d.CampaignName as CampaignName" => array("CampaignName", "Campaign Name"),
			"a.CustomerFirstName as CustomerFirstName" => array("CustomerFirstName"," Customer Name"),
			"a.CustomerDOB as CustomerAge" => array("CustomerAge","Age"),
			"(select tm.id from tms_agent tm where tm.UserId =b.AssignSelerId) as UserId" => array("UserId", "Agent ID"),
			"(select tm.id from tms_agent tm where tm.UserId =b.AssignLeader) as Supervisor" => array("Supervisor", "Supervisor"),
			"i.full_name as QAstaff" => array("QAstaff", "QA Staff"),
			"f.CallReasonDesc as CallReasonDesc" => array("CallReasonDesc", "Call Result"),
			"(SELECT SUM(a.duration) as Duration FROM cc_recording a 
				WHERE a.assignment_data = a.CustomerId
				GROUP BY a.assignment_data ) As Duration"=> array("Duration","Duration"),
				
			"(SELECT pc.PolicyNumber FROM t_gn_policyautogen pc 
			  INNER JOIN t_gn_policy pl on pc.PolicyNumber=pl.PolicyNumber 
			  WHERE pc.CustomerId=a.CustomerId LIMIT 1) as PolicyNumber" => array("PolicyNumber","Policy Number"),
			"a.CustomerUpdatedTs as CustomerUpdatedTs " => array("CustomerUpdatedTs", "Last Call Date"),
			"(SELECT pl.PolicySalesDate FROM t_gn_policyautogen pc 
			  INNER JOIN t_gn_policy pl on pc.PolicyNumber=pl.PolicyNumber 
			  WHERE pc.CustomerId=a.CustomerId LIMIT 1) As PolicySalesDate"=> array("PolicySalesDate","Sales Date"),
			"a.QA_UpdateTs as CustomerRejectedDate" => array("CustomerRejectedDate", "Verify Date")
		);
	}
	
	else if(_get_session('HandlingType')==USER_AGENT_INBOUND){
		$getSelectBy = array(
			"a.CustomerId as CustomerId" => array("CustomerId", "CustomerId", "primary"),	
			"d.CampaignName as CampaignName" => array("CampaignName", "Campaign Name"),
			"a.CustomerFirstName as CustomerFirstName" => array("CustomerFirstName"," Customer Name"),
			"a.CustomerDOB as CustomerAge" => array("CustomerAge","Age"),
			"(select tm.id from tms_agent tm where tm.UserId =b.AssignSelerId) as UserId" => array("UserId", "Agent ID"),
			"(select tm.id from tms_agent tm where tm.UserId =b.AssignLeader) as Supervisor" => array("Supervisor", "Supervisor"),
			"i.full_name as QAstaff" => array("QAstaff", "QA Staff"),
			"f.CallReasonDesc as CallReasonDesc" => array("CallReasonDesc", "Call Result"),
			"(SELECT SUM(a.duration) as Duration FROM cc_recording a 
				WHERE a.assignment_data = a.CustomerId
				GROUP BY a.assignment_data ) As Duration"=> array("Duration","Duration"),
				
			"(SELECT pc.PolicyNumber FROM t_gn_policyautogen pc 
			  INNER JOIN t_gn_policy pl on pc.PolicyNumber=pl.PolicyNumber 
			  WHERE pc.CustomerId=a.CustomerId LIMIT 1) as PolicyNumber" => array("PolicyNumber","Policy Number"),
			"a.CustomerUpdatedTs as CustomerUpdatedTs " => array("CustomerUpdatedTs", "Last Call Date"),
			"(SELECT pl.PolicySalesDate FROM t_gn_policyautogen pc 
			  INNER JOIN t_gn_policy pl on pc.PolicyNumber=pl.PolicyNumber 
			  WHERE pc.CustomerId=a.CustomerId LIMIT 1) As PolicySalesDate"=> array("PolicySalesDate","Sales Date"),
			"a.QA_UpdateTs as CustomerRejectedDate" => array("CustomerRejectedDate", "Verify Date")
		);
	} else {
		$getSelectBy = array(
			"a.CustomerId as CustomerId" => array("CustomerId", "CustomerId", "primary"),	
			"d.CampaignName as CampaignName" => array("CampaignName", "Campaign Name"),
			"a.CustomerFirstName as CustomerFirstName" => array("CustomerFirstName"," Customer Name"),
			"a.CustomerDOB as CustomerAge" => array("CustomerAge","Age"),
			"(select tm.id from tms_agent tm where tm.UserId =b.AssignSelerId) as UserId" => array("UserId", "Agent ID"),
			"(select tm.id from tms_agent tm where tm.UserId =b.AssignLeader) as Supervisor" => array("Supervisor", "Supervisor"),
			"i.full_name as QAstaff" => array("QAstaff", "QA Staff"),
			"f.CallReasonDesc as CallReasonDesc" => array("CallReasonDesc", "Call Result"),
			"g.AproveName as AproveName" => array("AproveName", "Quality Status"),
			"m.CallHistoryNotes as CallHistoryNotes" => array("CallHistoryNotes", "Quality Remarks"),
			"(SELECT SUM(a.duration) as Duration FROM cc_recording a 
				WHERE a.assignment_data = a.CustomerId
				GROUP BY a.assignment_data ) As Duration"=> array("Duration","Duration"),
				
			"(SELECT pc.PolicyNumber FROM t_gn_policyautogen pc 
			  INNER JOIN t_gn_policy pl on pc.PolicyNumber=pl.PolicyNumber 
			  WHERE pc.CustomerId=a.CustomerId LIMIT 1) as PolicyNumber" => array("PolicyNumber","Policy Number"),
			"a.CustomerUpdatedTs as CustomerUpdatedTs " => array("CustomerUpdatedTs", "Last Call Date"),
			"(SELECT pl.PolicySalesDate FROM t_gn_policyautogen pc 
			  INNER JOIN t_gn_policy pl on pc.PolicyNumber=pl.PolicyNumber 
			  WHERE pc.CustomerId=a.CustomerId LIMIT 1) As PolicySalesDate"=> array("PolicySalesDate","Sales Date"),
			"a.QA_UpdateTs as CustomerRejectedDate" => array("CustomerRejectedDate", "Verify Date")
		);
	}
	
	
	
	
	$this -> EUI_Page->_setArraySelect( $getSelectBy );
	
	$this->EUI_Page->_setFrom("t_gn_customer a");
	$this->EUI_Page->_setJoin("t_gn_assignment b "," a.CustomerId=b.CustomerId", "LEFT");
	$this->EUI_Page->_setJoin("t_lk_gender e "," a.GenderId=e.GenderId", "LEFT");
	$this->EUI_Page->_setJoin("t_lk_cardtype c "," a.CardTypeId=c.CardTypeId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_campaign d "," a.CampaignId=d.CampaignId", "LEFT");
	$this->EUI_Page->_setJoin("t_lk_callreason f "," a.CallReasonId = f.CallReasonId", "LEFT");
	$this->EUI_Page->_setJoin("t_lk_aprove_status g "," a.CallReasonQue=g.ApproveId", "LEFT");
	$this->EUI_Page->_setJoin("tms_agent h "," a.SellerId = h.UserId", "LEFT");
	if(_get_session('HandlingType')==USER_SUPERVISOR){			 
		$this->EUI_Page->_setJoin( "t_gn_callhistory m "," b.CustomerId=m.CustomerId and a.CallReasonQue = m.ApprovalStatusId", "LEFT" );
	} else if(_get_session('HandlingType')==USER_LEADER){			
		$this->EUI_Page->_setJoin( "t_gn_callhistory m "," b.CustomerId=m.CustomerId and a.CallReasonQue = m.ApprovalStatusId", "LEFT" );
	} else {
		$this->EUI_Page->_setJoin( "t_gn_callhistory m "," b.CustomerId=m.CustomerId and a.CallReasonQue = m.ApprovalStatusId", "LEFT" );
	}
	$this->EUI_Page->_setJoin("tms_agent i "," i.UserId	= a.QueueId ", "LEFT", true);
	
	

	
	
	
	
// ---------------- set filter constant ----------------------------
	
	$this->EUI_Page->_setAnd("b.AssignAdmin IS NOT NULL");
	$this->EUI_Page->_setAnd("b.AssignSpv IS NOT NULL");
	$this->EUI_Page->_setAnd("b.AssignBlock", 0);
	$this->EUI_Page->_setAnd("d.CampaignStatusFlag", 1);
	$this->EUI_Page->_setWhereIn("f.CallReasonEvent", 1);
	// $this->EUI_Page->_setWhereIn("g.AproveCode", $obClass->get_array());
		
// ---------------- set filter session  ----------------------------

	if(_get_session('HandlingType')==USER_SUPERVISOR){			 
		$this->EUI_Page->_setAnd("b.AssignSpv", _get_session('UserId'));
	}
	
	if(_get_session('HandlingType')==USER_LEADER){			
		$this->EUI_Page->_setAnd("b.AssignLeader", _get_session('UserId'));
	}
	
	if(_get_session('HandlingType')==USER_AGENT_OUTBOUND){
		$this->EUI_Page->_setAnd("b.AssignSelerId", _get_session('UserId'));
	}
	
	if(_get_session('HandlingType')==USER_AGENT_INBOUND){
		$this->EUI_Page->_setAnd("b.AssignSelerId", _get_session('UserId'));
	}	
	
// ---------------- set filter posted ----------------------------
	
	$this->EUI_Page->_setLikeCache("a.CustomerFirstName", 'cust_name', true); 
	$this->EUI_Page->_setLikeCache("a.CustomerNumber", 'customer_number', true); 
	$this->EUI_Page->_setAndCache("a.CallReasonQue", 'verify_status', true);
	$this->EUI_Page->_setAndCache("b.AssignSelerId", 'user_agent', true);
	$this->EUI_Page->_setAndCache("a.CampaignId", 'campaign_id', true);	
	$this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs>='".StartDate(_get_post('start_call_date'))."' ", 'start_call_date', true);
	$this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs<='".EndDate(_get_post('end_call_date'))."' ", 'end_call_date', true);
	
// --------- group fiter by having data -------------------------
	
	$this->EUI_Page->_setHavingOrCache("PolicySalesDate>='". StartDate(_get_post('start_sales_date'))."'", 'start_sales_date', true);
	$this->EUI_Page->_setHavingOrCache("PolicySalesDate<='". EndDate(_get_post('end_sales_date'))."'", 'end_sales_date', true);
	$this->EUI_Page->_setGroupBy('a.CustomerId');
		
// -------------- set order ---------------------------
	
	if( _get_have_post('order_by') ){
		$this->EUI_Page->_setOrderBy(_get_post('order_by'),_get_post('type') ); 
	} else {
		$this->EUI_Page->_setOrderBy("a.CustomerRejectedDate","ASC");
	}
	$this->EUI_Page->_setLimit();
    //echo $this->EUI_Page->_getCompiler();
	
	
	/*
SELECT
a.CustomerId as CustomerId,d.CampaignName as CampaignName,a.CustomerFirstName as CustomerFirstName,a.CustomerDOB as CustomerAge,(select tm.id from tms_agent tm where tm.UserId =b.AssignSelerId) as UserId,(select tm.id from tms_agent tm where tm.UserId =b.AssignLeader) as Supervisor,i.full_name as QAstaff,f.CallReasonDesc as CallReasonDesc,g.AproveName as AproveName,m.CallHistoryNotes as CallHistoryNotes,(SELECT
SUM(a.duration) as Duration
FROM cc_recording a
WHERE a.assignment_data = a.CustomerId
GROUP BY a.assignment_data ) As Duration,(SELECT
pc.PolicyNumber
FROM t_gn_policyautogen pc INNER JOIN t_gn_policy pl on pc.PolicyNumber=pl.PolicyNumber
WHERE pc.CustomerId=a.CustomerId
LIMIT 1) as PolicyNumber,a.CustomerUpdatedTs as CustomerUpdatedTs ,(SELECT
pl.PolicySalesDate
FROM t_gn_policyautogen pc INNER JOIN t_gn_policy pl on pc.PolicyNumber=pl.PolicyNumber
WHERE pc.CustomerId=a.CustomerId
LIMIT 1) As PolicySalesDate,a.QA_UpdateTs as CustomerRejectedDate
FROM ( t_gn_customer a FORCE INDEX (PRIMARY) )
LEFT JOIN t_gn_assignment b ON a.CustomerId=b.CustomerId
LEFT JOIN t_lk_gender e ON a.GenderId=e.GenderId
LEFT JOIN t_lk_cardtype c ON a.CardTypeId=c.CardTypeId
LEFT JOIN t_gn_campaign d ON a.CampaignId=d.CampaignId
LEFT JOIN t_lk_callreason f ON a.CallReasonId = f.CallReasonId
LEFT JOIN t_lk_aprove_status g ON a.CallReasonQue=g.ApproveId
LEFT JOIN tms_agent h ON a.SellerId = h.UserId
LEFT JOIN tms_agent i ON i.UserId = a.QueueId
WHERE (TRUE)
LEFT JOIN t_gn_callhistory m ON b.CustomerId=m.CustomerId and a.CallReasonQue = m.ApprovalStatusId
AND b.AssignAdmin IS NOT NULL
AND b.AssignSpv IS NOT NULL
AND b.AssignBlock='0'
AND d.CampaignStatusFlag='1'
AND f.CallReasonId IN('35','36','37')
AND g.AproveCode IN('501','503','504','505','506','507','508','509','510','511','512','513','514','515','516','517')
GROUP BY a.CustomerId
ORDER BY a.CustomerRejectedDate ASC
LIMIT 100, 10 
	*/
	
}



/*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_resource()
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
 
function _get_page_number() 
 {
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
 
  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  
 public function _select_attr_quality_status( $arr_out = null ) 
{
	$out= new EUI_Object( $arr_out );
	
	$arr_class = array(
		'arr_class_data' => "ui-widget-form-disabled",
		'arr_class_image' => "ui-widget-image-disabled",
		'arr_class_input' => "ui-widget-input-disabled"
	);
	
	if( in_array($out->get_value('CallReasonQue'), 
		array(SUSPEND_DATA, SUSPEND_STILL,SUSPEND_SELLING) ) )
	{
		$arr_class = array(
			'arr_class_data' => "ui-widget-form-enabled",
			'arr_class_image' => "ui-widget-image-enabled",
			'arr_class_input' => "ui-widget-input-enabled"
		);
		
	}	
	return (array)$arr_class;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 public function _select_attr_confirm_detail( $CustomerId = 0  )
{
  $arr_attr_closing = array();
  
 // ----------- select last phone followup -----------------
  
  $this->db->reset_select();
  $this->db->select("a.CallNumber", FALSE);
  $this->db->from("t_gn_callhistory a ");
  $this->db->where("a.HistoryType", 0);
  $this->db->where("a.CustomerId", $CustomerId);
  $this->db->order_by("a.CallHistoryId", "DESC");
  $this->db->limit(1);
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 
	AND $row = $rs->result_first_assoc() )
{
	$arr_attr_closing['CallNumber'] = $row['CallNumber'];
  }	  
  
// ----------- select last product Policy ------------
  $this->db->reset_select();
  $this->db->select("a.ProductId", FALSE);
  $this->db->from("t_gn_policyautogen a ");
  $this->db->where("a.CustomerId", $CustomerId);
  
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 
	 AND $row = $rs->result_first_assoc() )
  {
	  $arr_attr_closing['ProductId'] = $row['ProductId'];
  }
  
	return (array)$arr_attr_closing;
 }

 
 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function _getPhoneCustomer($CustomerId=null)
 {
	// $_conds = array();
	
	// $this ->db ->select('CustomerHomePhoneNum, CustomerMobilePhoneNum, CustomerWorkPhoneNum, CustomerWorkFaxNum, CustomerWorkExtPhoneNum, CustomerFaxNum');
	// $this ->db ->from('t_gn_customer');
	// $this ->db ->where('CustomerId',$CustomerId);
	
	// foreach($this -> db ->get() -> result_assoc() as $rows )
	// {
		// if( !is_null($rows['CustomerHomePhoneNum']) 
			// AND $rows['CustomerHomePhoneNum']!='' )
		// {
			// $_conds[$rows['CustomerHomePhoneNum']] = " Home ". $this->M_MaskingNumber->MaskingBelakang($rows['CustomerHomePhoneNum']); 
		// }
		
		// if( !is_null($rows['CustomerMobilePhoneNum']) 
			// AND $rows['CustomerMobilePhoneNum']!='' )
		// {
			// $_conds[$rows['CustomerMobilePhoneNum']] = " Mobile ". $this->M_MaskingNumber->MaskingBelakang($rows['CustomerMobilePhoneNum']); 
		// }
		
		// if( !is_null($rows['CustomerWorkPhoneNum']) 
			// AND $rows['CustomerWorkPhoneNum']!='' )
		// {
			// $_conds[$rows['CustomerWorkPhoneNum']] = " Office ". $this->M_MaskingNumber->MaskingBelakang($rows['CustomerWorkPhoneNum']); 
		// }
		
		// if( !is_null($rows['CustomerWorkFaxNum']) 
			// AND $rows['CustomerWorkFaxNum']!='' )
		// {
			// $_conds[$rows['CustomerWorkFaxNum']]= " Work Fax ". $this->M_MaskingNumber->MaskingBelakang($rows['CustomerWorkFaxNum']); 
		// }
		
		
		// if( !is_null($rows['CustomerWorkExtPhoneNum']) 
			// AND $rows['CustomerWorkExtPhoneNum']!='' )
		// {
			// $_conds[$rows['CustomerWorkExtPhoneNum']] = " Work Ext ". $this->M_MaskingNumber->MaskingBelakang($rows['CustomerWorkExtPhoneNum']); 
		// }
		
		
		// if( !is_null($rows['CustomerFaxNum']) 
			// AND $rows['CustomerFaxNum']!='' )
		// {
			// $_conds[$rows['CustomerFaxNum']]= " Fax ". $this->M_MaskingNumber->MaskingBelakang($rows['CustomerFaxNum']); 
		// }
	// }
	
	// return $_conds;
 }
 
 

 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getApprovalPhoneItems($CustomerId = 0 )
 {
	// $_conds = array();
	
	// $this ->db ->select('a.ApprovalNewValue, b.ApprovalItem');
	// $this ->db ->from('t_gn_approvalhistory a');
	// $this ->db ->join('t_lk_approvalitem b','a.ApprovalItemId=b.ApprovalItemId','LEFT');
	// $this ->db ->where('a.CustomerId',$CustomerId);
	
	// foreach($this ->db -> get()->result_assoc() as $rows )
	// {
		// $_avail = explode(' ', $rows['ApprovalItem']);
		// if( count($_avail) > 0 ){
			// $_conds[$rows['ApprovalNewValue']] = $_avail[0] .' '. $this->M_MaskingNumber->MaskingBelakang($rows['ApprovalNewValue']); 	
		// }
	// }
	
	// return $_conds;
 } 

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function _getPolicyAutogen( $CustomerId =null  )
{
	// $Product = array();
	
	// $this->db->select('a.ProductId');
	// $this->db->from('t_gn_policyautogen a');
	// $this->db->where('a.CustomerId',$CustomerId);
	// foreach( $this->db->get() -> result_assoc()  as $rows ) {
		// $Product[$rows['ProductId']] = $rows['ProductId'];
	// }
	
	// return $Product;
	
} 
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function _getAvailProduct( $CustomerId = 0 )
 {
	// $_product = array(); 
	// $ProductList = $this -> _getPolicyAutogen($CustomerId);
	
	
	// $this ->db->select('d.ProductId, d.ProductName');
	// $this ->db->from('t_gn_customer a ');
	// $this ->db->join('t_gn_campaign b ',' a.CampaignId=b.CampaignId');
	// $this ->db->join('t_gn_campaignproduct c ',' b.CampaignId=c.CampaignId');
	// $this ->db->join('t_gn_product d ',' c.ProductId=d.ProductId');
	// $this ->db->where('a.CustomerId',$CustomerId);
	
	// foreach( $this ->db-> get() -> result_assoc() as $rows )
	// {
		// if( in_array($rows['ProductId'], $ProductList) ){
			// $_product[$rows['ProductId']] = $rows['ProductName'];
		// }	
	// }
	
	// return $_product;
 }
 
 
 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function _getLastCallPhone($CustomerId = 0 )
 {
	// $CallPhone = null;
	
	// $this -> db -> select('a.CallNumber');
	// $this -> db -> from("t_gn_callhistory a");
	// $this -> db -> where("a.CustomerId", $CustomerId);
	// $this -> db -> where("a.ApprovalStatusId IS NULL");
	// $this -> db -> where("a.CreatedById", $this -> EUI_Session->_get_session('UserId'));
	// $this -> db -> order_by('a.CallHistoryId', 'DESC');
	// $this -> db -> limit(1);

	// if( $rows  = $this -> db->get()->result_first_assoc() )
	// {
		// $CallPhone = $rows['CallNumber'];
	// }
	
	// return $CallPhone;
	
 } 

}

?>