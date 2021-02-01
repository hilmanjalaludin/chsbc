<?php

class M_ModApprovePhone extends EUI_Model 
{

 var $arr_status = array( 0=> 'Reject', 1=> 'Approve', 2=> 'Request');
 var $set_limit_page = 10;
 
 // ---------------------------------------------------------------------------------------------------

  private static $Instance = null; 
  public static function &Instance()
 {
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
 }

// ---------------------------------------------------------------------------------------------------
 
  function __construct() 
  {
	$this->load->model(array(
		'M_Combo','M_SrcCustomerList', 'M_SetCallResult','M_SetProduct', 
		'M_SetCampaign','M_SetResultCategory','M_ModSaveActivity', 
		'M_SetResultQuality','M_PhoneType'
	));		
  }
 
/*
 * @ def 		: _get_content
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _get_default()
{
	
// ------------ call object data ---------------------	
 $out =& Objective( _get_all_request() );
 $this->EUI_Page->_setPage($this->set_limit_page);
 
 // --------- set proces select --------------------------------
 
 $this->EUI_Page->_setSelect("a.ApprovalHistoryId", false);
 $this->EUI_Page->_setFrom("t_gn_approvalhistory a");
 $this->EUI_Page->_setJoin("t_gn_customer b "," a.CustomerId=b.CustomerId", "LEFT");
 $this->EUI_Page->_setJoin("t_lk_approvalitem c "," a.ApprovalItemId=c.ApprovalItemId", "LEFT");
 $this->EUI_Page->_setJoin("tms_agent d "," a.CreatedById=d.UserId", "LEFT");
 $this->EUI_Page->_setJoin("t_gn_assignment e "," a.CustomerId=e.CustomerId", "LEFT", true);
 
// ------------------ set filte default ----------------------------------------------------------------------
 
  $this->EUI_Page->_setAnd("a.ApprovalApprovedFlag", 2);
  
  if(in_array( _get_session('HandlingType'), array(USER_ROOT))){
	$this->EUI_Page->_setAnd("e.AssignAdmin IS NOT NULL");
  }	
  
  if(_get_session('HandlingType')==USER_ADMIN){
	$this->EUI_Page->_setAnd("e.AssignAdmin IS NOT NULL");
  }	
  
  if(_get_session('HandlingType')==USER_MANAGER){
	$this->EUI_Page->_setAnd("e.AssignMgr",_get_session('UserId'));
  }	
  
  if(_get_session('HandlingType')==USER_ACCOUNT_MANAGER){
	$this->EUI_Page->_setAnd("e.act_mgr",_get_session('UserId'));
  }	
  
  
  if(_get_session('HandlingType')==USER_SUPERVISOR ){			 
	$this->EUI_Page->_setAnd("e.AssignSpv",_get_session('UserId'));
  }	
  
  
  if(_get_session('HandlingType')==USER_AGENT_OUTBOUND){
	$this->EUI_Page->_setAnd("e.AssignSelerId",_get_session('UserId'));
  }	
  
  if(_get_session('HandlingType')==USER_AGENT_INBOUND){
	$this->EUI_Page->_setAnd("e.AssignSelerId",_get_session('UserId'));
  }	
 // ------------------ set filte post vars  --------------------------
 
   $this->EUI_Page->_setLikeCache("b.CustomerFirstName","aprv_cust_name", true);
   $this->EUI_Page->_setAndCache("b.CustomerNumber","aprv_customer_number", true);
   $this->EUI_Page->_setAndCache("d.UserId","aprv_user_agent", true);
   $this->EUI_Page->_setAndOrCache("a.ApprovalCreatedTs>='{$out->get_value('aprv_start_date','StartDate')}'","aprv_start_date", true);
   $this->EUI_Page->_setAndOrCache("a.ApprovalCreatedTs<='{$out->get_value('aprv_end_date','StartDate')}'","aprv_end_date", true);
   
   // echo _get_session('HandlingType'); echo USER_SUPERVISOR; echo _get_session('UserId');
 // echo $this->EUI_Page->_getCompiler();
 //------------------------------------------------------------------------------
 return $this->EUI_Page;
 
	
 }

/*
 * @ def 		: _get_content
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _get_content()
 {
	 
// ------------------------ call object --------------------------
	$out =& Objective( _get_all_request() );
	
// --------------- set post page -----------------------------------------	
	$this->EUI_Page->_postPage(_get_post('v_page') );
	$this->EUI_Page->_setPage($this->set_limit_page);
	
	$this->EUI_Page->_setArraySelect(array(
		"a.ApprovalHistoryId as ApprovalHistoryId" => array("ApprovalHistoryId", "ApprovalHistoryId", "primary"),
		"b.CustomerNumber as CustomerNumber" => array("CustomerNumber","CIF"),
		"b.CustomerFirstName as CustomerFirstName" => array("CustomerFirstName","Customer Name"),
		"a.ApprovalOldValue as ApprovalOldValue" => array("ApprovalOldValue","From Value Number"),
		"a.ApprovalNewValue as ApprovalNewValue" => array("ApprovalNewValue","To Value Number"),
		"d.full_name as RequestBy" => array("RequestBy","Request By"),
		"a.ApprovalCreatedTs as ApprovalCreatedTs" => array("ApprovalCreatedTs","ApprovalCreatedTs"),
		"CASE WHEN (f.PhoneDesc IS NULL) THEN NULL ELSE f.PhoneDesc END as PhoneDesc" => array("PhoneDesc","PhoneDesc")
	));
	
  $this->EUI_Page->_setFrom("t_gn_approvalhistory a");
  $this->EUI_Page->_setJoin("t_gn_customer b "," a.CustomerId=b.CustomerId", "LEFT");
  $this->EUI_Page->_setJoin("t_lk_approvalitem c "," a.ApprovalItemId=c.ApprovalItemId", "LEFT");
  $this->EUI_Page->_setJoin("tms_agent d "," a.CreatedById=d.UserId", "LEFT");
  $this->EUI_Page->_setJoin("t_gn_assignment e ","a.CustomerId=e.CustomerId", "LEFT");
  $this->EUI_Page->_setJoin("t_lk_phonetype f "," a.ApprovePhoneType=f.PhoneType", "LEFT", true);
 
 
 // ------------------ set filte default --------------------------
  $this->EUI_Page->_setAnd("a.ApprovalApprovedFlag", 2);
  
  if(in_array( _get_session('HandlingType'), array(USER_ROOT))){
	$this->EUI_Page->_setAnd("e.AssignAdmin IS NOT NULL");
  }	
  
  if(_get_session('HandlingType')==USER_ADMIN){
	$this->EUI_Page->_setAnd("e.AssignAdmin IS NOT NULL");
  }	
  
  if(_get_session('HandlingType')==USER_MANAGER){
	$this->EUI_Page->_setAnd("e.AssignMgr",_get_session('UserId'));
  }	
  
  if(_get_session('HandlingType')==USER_ACCOUNT_MANAGER){
	$this->EUI_Page->_setAnd("e.act_mgr",_get_session('UserId'));
  }	
  
  
  if(_get_session('HandlingType')==USER_SUPERVISOR ){			 
	$this->EUI_Page->_setAnd("e.AssignSpv",_get_session('UserId'));
  }	
  
  
  if(_get_session('HandlingType')==USER_AGENT_OUTBOUND){
	$this->EUI_Page->_setAnd("e.AssignSelerId",_get_session('UserId'));
  }	
  
  if(_get_session('HandlingType')==USER_AGENT_INBOUND){
	$this->EUI_Page->_setAnd("e.AssignSelerId",_get_session('UserId'));
  }	
 // ------------------ set filte post vars  --------------------------
 
   $this->EUI_Page->_setLikeCache("b.CustomerFirstName","aprv_cust_name", true);
   $this->EUI_Page->_setAndCache("b.CustomerNumber","aprv_customer_number", true);
   $this->EUI_Page->_setAndCache("d.UserId","aprv_user_agent", true);
   $this->EUI_Page->_setAndOrCache("a.ApprovalCreatedTs>='{$out->get_value('aprv_start_date','StartDate')}'","aprv_start_date", true);
   $this->EUI_Page->_setAndOrCache("a.ApprovalCreatedTs<='{$out->get_value('aprv_end_date','StartDate')}'","aprv_end_date", true);
   
	
// ------------- set order data field ---------------------------------------------------
	
	if( !_get_have_post('order_by')){
		$this->EUI_Page->_setOrderBy('a.ApprovalHistoryId','DESC');
	} else {
		$this->EUI_Page->_setOrderBy(_get_post('order_by'), _get_post('type'));
	}
// ------------- set limit page ------------------------
	
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
 

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getApproveItem()
 {
	$_conds = array();
	
	$this -> db->select('*');
	$this -> db->from('t_lk_approvalitem');
	
	foreach( $this -> db->get()->result_assoc() as $rows )
	{
		$_conds[$rows['ApprovalItemId']] = $rows['ApprovalItem'];
	}
	
	return $_conds;
	
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function _setApproveItem( $out =null )
{
 
 if( !$out->fetch_ready() ) {
	return FALSE;	
}	

 // --- reset cache  --- 	
 
 $this->db->reset_write();
 $this->db->where("ApprovalHistoryId",$out->get_value('ApproveItemId') );
 $this->db->set("ApprovalApprovedFlag",$out->get_value('ApprovalStatus'));
 
 if( $this->db->update('t_gn_approvalhistory') )
 { 
  
	$obDts =& $this->_select_row_call_history( $out->get_value('CustomerId') );
	$obItm =& $this->_select_row_item_detail( $out->get_value('ApproveItemId') );
	
// -------- Jika status Approve maka data Di masukan ke " t_gn_addphone " ------------------------------

	$this->db->reset_write();
	$this->db->set("CustomerId", $obItm->get_value('CustomerId'));
	$this->db->set("AddPhoneType",$obItm->get_value('ApprovePhoneType')); 
	$this->db->set("AddPhoneNumber", $obItm->get_value('ApprovalNewValue'));
	$this->db->set("AddPhoneApproveId",$obItm->get_value('ApprovalHistoryId'));
	$this->db->insert("t_gn_addphone");
	
// ---------------------------------------------------------------------------------------	
	if( $obItm->fetch_ready() )
	{
		// ----------------------------------------------------------------------------	
		$obOut = & get_class_instance('M_SysUser');
		$obUsr = & Objective( $obOut->_getUserDetail(_get_session('UserId')));
	// ------- atm & TL ------------------------------------------------------------	
		
		$obTls = & Objective( $obOut->_getUserDetail($obUsr->get_value('tl_id')));
		$obAtm = & Objective( $obOut->_getUserDetail($obUsr->get_value('spv_id')));
		
		$this->db->reset_write();	
		$this->db->set("CustomerId",$out->get_value('CustomerId')); 
		$this->db->set("CallReasonId",(int)$out->get_value('ApprovalStatus'));
		$this->db->set("CallHistoryCreatedTs",date('Y-m-d H:i:s'));
		$this->db->set("CallNumber", $obItm->get_value('ApprovalNewValue','_setMasking'));
		$this->db->set("CreatedById",$obUsr->get_value('UserId','strtoupper'));
		$this->db->set("AgentCode",$obUsr->get_value('Username','strtoupper')); 
		$this->db->set("SPVCode",$obTls->get_value('Username','strtoupper')); 
		$this->db->set("ATMCode",$obAtm->get_value('Username','strtoupper')); 
		$this->db->set("CallHistoryNotes", join(" ", array( $this->_select_row_status_item($out->get_value('ApprovalStatus')), "Additional Phone,", "Phone Type : ", $obItm->get_value('PhoneDesc','strtoupper'))));
		$this->db->set("CallHistoryUpdatedTs", date('Y-m-d H:i:s'));
		$this->db->set("HistoryType", (int)CHANGE_ACTIVITY);
		$this->db->insert("t_gn_callhistory");
	}
	
	return TRUE;
	
 }	else {
	 return FALSE;
 } 
 
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function _select_row_status_item( $sts = 0 )
{
	$sts = (int)$sts;
	return (string)$this->arr_status[$sts];
}
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 protected function _select_row_call_history( $CustomerId = 0 ) 
{
 $this->db->reset_select();
 $this->db->select("*", false);
 $this->db->from("t_gn_callhistory a ");
 $this->db->where("a.CustomerId", $CustomerId);
 $this->db->where_not_in("a.CreatedById",array(_get_session('UserId')));
 $this->db->order_by("a.CallHistoryId","DESC");
 $this->db->limit(1);
 
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ){
	return Objective( $rs->result_first_assoc() );
} else{
	return Objective( array() );
 }
 
} 

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 protected function _select_row_item_detail( $ApprovalHistoryId = 0 ) 
{
 $this->db->reset_select();
 $this->db->select("*", false);
 $this->db->from("t_gn_approvalhistory a ");
 $this->db->join("t_lk_phonetype b", "a.ApprovePhoneType=b.PhoneType", "LEFT");
 $this->db->where("a.ApprovalHistoryId", $ApprovalHistoryId);

 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ){
	return Objective( $rs->result_first_assoc() );
} else{
	return Objective( array() );
 }
 
} 
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 public function & _getCustomerId( $ApprovalHistoryId  = 0 )
{
	if( !$ApprovalHistoryId ){
		return false;
	}
	
// --- next process  ------------------------------------
	
	$arr_result  = 0;
	$this->db->reset_select();
	$this->db->select('a.CustomerId', false);
	$this->db->from('t_gn_approvalhistory a');
	$this->db->where('a.ApprovalHistoryId',$ApprovalHistoryId);
	
	$rs  = $this->db->get();
	if( $rs->num_rows() > 0 )
	{
		$arr_result =(int)$rs->result_singgle_value();
	}
	
	return (int)$arr_result;
 }
  
 /*
 * @ def 		: _SaveSubmitPhone // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

 function _getPhoneTypeIdByName( $Name = null ) 
 {
	$this ->db ->select('a.PhoneTypeId');
	$this ->db ->from('t_lk_phonetype a ');
	$this ->db ->where('a.PhoneField', $Name);
	
	if( $rows = $this ->db ->get() -> result_first_assoc() )
	{
		return $rows['PhoneTypeId'];
	}
	else
		return null;
 }
 
 /*
 * @ def 		: _SaveSubmitPhone // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function _SaveSubmitPhone( $out = null )
{

 $_conds = 0;
	if( !is_null($out) ) 
{
	$this->db->reset_write();
	$this->db->set('CustomerId',$out->get_value('CustomerId') );
	$this->db->set('ApprovalOldValue',$out->get_value('PhoneAddTypeValue'));
	$this->db->set('ApprovalNewValue',$out->get_value('PhoneAddTypeValue'));
	$this->db->set('ApprovePhoneType',$out->get_value('PhoneAddType'));
	$this->db->set('CreatedById',_get_session('UserId')); 
	$this->db->set('ApprovalItemId', (int)ADDITIONAL_PHONE);
	$this->db->set('ApprovalApprovedFlag', (int)CHANGE_REQUEST);
	$this->db->set('ApprovalCreatedTs',date('Y-m-d H:i:s'));
	
	$this->db->insert('t_gn_approvalhistory');
	#var_dump($this->db->last_query());die();
	if( $this -> db ->affected_rows() > 0 )  
	{
		
	// ----------------------------------------------------------------------------	
		$obOut = & get_class_instance('M_SysUser');
		$obUsr = & Objective( $obOut->_getUserDetail(_get_session('UserId')));
		
		
	// ------- atm & TL ------------------------------------------------------------	
		
		$obTls = & Objective( $obOut->_getUserDetail($obUsr->get_value('tl_id')));
		$obAtm = & Objective( $obOut->_getUserDetail($obUsr->get_value('spv_id')));
	
	// ----------------------------------------------------------------------------	
		
		$this->db->reset_write();
		$this->db->set("CustomerId",$out->get_value('CustomerId')); 
		$this->db->set("CallReasonId",(int)CHANGE_REQUEST);
		
		$this->db->set("CreatedById",$obUsr->get_value('UserId','strtoupper'));
		$this->db->set("AgentCode",$obUsr->get_value('Username','strtoupper')); 
		$this->db->set("SPVCode",$obTls->get_value('Username','strtoupper')); 
		$this->db->set("ATMCode",$obAtm->get_value('Username','strtoupper')); 
		$this->db->set("CallNumber", $out->get_value('PhoneAddTypeValue','_setMasking'));
		$this->db->set("CallHistoryNotes", join(" ", array( "Request Additional Phone,", "Phone Type : ", $out->get_value('PhoneAddDesc','strtoupper') )));
		$this->db->set("CallHistoryUpdatedTs", date('Y-m-d H:i:s'));
		$this->db->set("CallHistoryCreatedTs",date('Y-m-d H:i:s'));
		$this->db->set("HistoryType", (int)CHANGE_ACTIVITY);
		
		$this->db->insert("t_gn_callhistory");
		
		$_conds++;
	}
}
	
	return $_conds;
 }
 
 /*
 * @ def 		: _SaveSubmitPhone // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 function _getAllApprovalItems()
 {
	$sql = " SELECT a.*, d.*
			FROM t_gn_approvalhistory a
			LEFT JOIN t_gn_customer b ON a.CustomerId=b.CustomerId
			LEFT JOIN t_lk_approvalitem c ON a.ApprovalItemId=c.ApprovalItemId
			LEFT JOIN tms_agent d ON a.CreatedById=d.UserId
			LEFT JOIN t_gn_assignment e ON b.CustomerId=e.CustomerId
			WHERE a.ApprovalHistoryId ='{$this -> URI->_get_post('ApproveId')}'";
	$qry = $this -> db -> query($sql);
	if( $rows  = $qry ->result_first_assoc() )
		return $rows;
	else
		return false;
 }
 
 


}

?>