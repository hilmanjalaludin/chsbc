<?php
/*
 * E.U.I 
 * -----------------------------------------------
 *
 * subject	: M_QtyApprovalInterest
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class M_QtyApprovalConfirm Extends EUI_Model
{
	
var $arr_quality_confirm = '504';
 
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */ 

 
private static $Instance  = null;	

// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 public static function &Instance()
{
	if( is_null(self::$Instance) )
 {
	self::$Instance = new self();
 }
  return  self::$Instance;
 
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function __construct()
{
	$this->load->model(array(
		'M_SetCallResult','M_SetResultQuality','M_ModOutBoundGoal',
		'M_Combo', 'M_SrcCustomerList', 'M_SetProduct', 'M_SetCampaign', 
		'M_SetResultCategory', 'M_ModSaveActivity', 'M_Payers', 'M_Benefiecery',
		'M_Insured', 'M_QtyPoint', 'M_Configuration', 'M_Underwriting', 'M_Pbx', 'M_Scoring'
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
		$_a = $this -> M_SetCallResult -> _getInterestSale(); 
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
		foreach( $this -> M_SetResultQuality -> _getQualityConfirm() as $k => $rows )
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
	$obClass =& Spliter($this->arr_quality_confirm);
	$Vars =& M_ModOutBoundGoal::get_instance();
	
// ------------- start page from here ---> 
	$this->EUI_Page->_setPage(10);
	$this->EUI_Page->_setSelect("a.id");
	$this->EUI_Page->_setFrom("t_gn_quality_assignment a ");
	$this->EUI_Page->_setJoin("t_gn_assignment b","a.Assign_Data_Id=b.AssignId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_customer c", " b.CustomerId=c.CustomerId", "LEFT");
	$this->EUI_Page->_setJoin("tms_agent d", " b.AssignSelerId=d.UserId", "LEFT");
	$this->EUI_Page->_setJoin("t_lk_callreason e","c.CallReasonId=e.CallReasonId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_campaign f"," c.CampaignId=f.CampaignId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_quality_group g","a.Quality_Staff_Id=g.Quality_Staff_id", "LEFT");
	$this->EUI_Page->_setJoin("tms_agent h ","a.Quality_Staff_Id=h.UserId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_policyautogen j ","c.CustomerId=j.CustomerId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_policy k ","j.PolicyNumber=k.PolicyNumber", "LEFT");
	$this->EUI_Page->_setJoin("t_lk_aprove_status m"," c.CallReasonQue=m.ApproveId", "LEFT", TRUE);
	
// ---------------- set filter on here ----------------
	
   $this->EUI_Page->_setAnd("f.OutboundGoalsId", $Vars->_getOutboundId());
   $this->EUI_Page->_setWhereIn("e.CallReasonId", self::Sale());
   $this->EUI_Page->_setWhereIn("c.CallReasonId", self::_getApprovalInterest());
   
// ---------- dipelak ku aing meh gampang -------------------------------
   
   $this->EUI_Page->_setWhereIn("m.AproveCode", $obClass->get_array());
   
// -------------- on user privilege --------------------------------
	if( in_array( _get_session('HandlingType'), array( USER_QUALITY_HEAD, USER_QUALITY_STAFF) ) )
  {
		$this->EUI_Page->_setAnd("g.Quality_Skill_Id", QUALITY_APPROVE);
	}
	
	if( in_array( _get_session('HandlingType'), array( USER_QUALITY_HEAD)))
  {
		$this->EUI_Page->_setAnd("h.quality_id", _get_session('UserId'));
	}
	
  if( in_array( _get_session('HandlingType'), array(USER_QUALITY_STAFF))) {
		$this ->EUI_Page->_setAnd("g.Quality_Staff_Id", _get_session('UserId'));
	}
	
   if( in_array( _get_session('HandlingType'), array(USER_SUPERVISOR))) {
		$this ->EUI_Page->_setAnd("b.AssignSpv", _get_session('UserId'));
	}

   if( in_array( _get_session('HandlingType'), array(USER_AGENT_INBOUND, USER_AGENT_OUTBOUND))) {
		$this ->EUI_Page->_setAnd("b.AssignSelerId", _get_session('UserId'));
	}	
	
// --------- customize filter -------------------------------------------------
	
	$this->EUI_Page->_setLikeCache("c.CustomerFirstName", "cfm_cust_name", TRUE);
	$this->EUI_Page->_setLikeCache("c.CustomerNumber", "cfm_cust_number", TRUE);
	$this->EUI_Page->_setAndCache("c.CallReasonQue", "cfm_quality_int_status", TRUE);
	$this->EUI_Page->_setAndCache("b.AssignSelerId", "cfm_user_id", TRUE);
	$this->EUI_Page->_setAndCache("c.CampaignId", "cfm_campaign_id", TRUE);
	$this->EUI_Page->_setAndCache("j.ProductId", "cfm_category_id", TRUE);
	$this->EUI_Page->_setAndOrCache("DATE(k.PolicySalesDate)>='". _getDateEnglish(_get_post('cfm_start_date')) ."'", 'cfm_start_date', TRUE);
	$this->EUI_Page->_setAndOrCache("DATE(k.PolicySalesDate)<='". _getDateEnglish(_get_post('cfm_end_date')) ."'", 'cfm_end_date', TRUE);
	$this->EUI_Page->_setGroupBy('c.CustomerId');
	
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
	$obClass =& Spliter($this->arr_quality_confirm); 
	$Vars =& M_ModOutBoundGoal::get_instance();
	
// ------------- start page from here ---> 
	
	$this->EUI_Page->_postPage(_get_post('v_page') );
	$this->EUI_Page->_setPage(10);
	$this->EUI_Page->_setArraySelect(array(
		"c.CustomerId as CustomerId" => array("CustomerId","CustomerId","primary"),
		"f.CampaignName as CampaignName" => array("CampaignName","Campaign Name"),
		"c.CustomerFirstName as CustomerName" => array("CustomerName","Customer Name"),
		"c.CustomerDOB as CustomerAge" => array("CustomerAge","Age"),
		"d.full_name as AgentId" => array("AgentId","Agent ID"),
		"IF(e.CallReasonDesc IS NULL, 'New', e.CallReasonDesc) As CallReasonDesc"=> array("CallReasonDesc","Call Result"),
		"(SELECT SUM(a.duration) as Duration FROM cc_recording a 
			WHERE a.assignment_data = c.CustomerId
			GROUP BY a.assignment_data ) As Duration"=> array("Duration","Duration"),
		
		"(SELECT pc.PolicyNumber FROM t_gn_policyautogen pc 
		  INNER JOIN t_gn_policy pl on pc.PolicyNumber=pl.PolicyNumber 
		  WHERE pc.CustomerId=c.CustomerId LIMIT 1) as PolicyNumber" => array("PolicyNumber","Policy Number"),
		"IF( m.AproveName IS NULL, 'NEW',m.AproveName) As AproveName"=> array("AproveName","Quality Status"),
		"k.PolicySalesDate As PolicySalesDate"=> array("PolicySalesDate","Sales Date")
		
	));
	$this->EUI_Page->_setFrom("t_gn_quality_assignment a ");
	$this->EUI_Page->_setJoin("t_gn_assignment b","a.Assign_Data_Id=b.AssignId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_customer c", " b.CustomerId=c.CustomerId", "LEFT");
	$this->EUI_Page->_setJoin("tms_agent d", " b.AssignSelerId=d.UserId", "LEFT");
	$this->EUI_Page->_setJoin("t_lk_callreason e","c.CallReasonId=e.CallReasonId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_campaign f"," c.CampaignId=f.CampaignId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_quality_group g","a.Quality_Staff_Id=g.Quality_Staff_id", "LEFT");
	$this->EUI_Page->_setJoin("tms_agent h ","a.Quality_Staff_Id=h.UserId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_policyautogen j ","c.CustomerId=j.CustomerId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_policy k ","j.PolicyNumber=k.PolicyNumber", "LEFT");
	$this->EUI_Page->_setJoin("t_lk_aprove_status m"," c.CallReasonQue=m.ApproveId", "LEFT", TRUE);
	
// ---------------- set filter on here ----------------
	
   $this->EUI_Page->_setAnd("f.OutboundGoalsId", $Vars->_getOutboundId());
   $this->EUI_Page->_setWhereIn("e.CallReasonId", self::Sale());
   $this->EUI_Page->_setWhereIn("c.CallReasonId", self::_getApprovalInterest());
   $this->EUI_Page->_setWhereIn("m.AproveCode",$obClass->get_array());
   

// -------------- on user privilege --------------------------------
	if( in_array( _get_session('HandlingType'), array( USER_QUALITY_HEAD, USER_QUALITY_STAFF) ) )
  {
		$this->EUI_Page->_setAnd("g.Quality_Skill_Id", QUALITY_APPROVE);
	}
	
	if( in_array( _get_session('HandlingType'), array( USER_QUALITY_HEAD)))
  {
		$this->EUI_Page->_setAnd("h.quality_id", _get_session('UserId'));
	}
	
  if( in_array( _get_session('HandlingType'), array(USER_QUALITY_STAFF))) {
		$this ->EUI_Page->_setAnd("g.Quality_Staff_Id", _get_session('UserId'));
	}
	
   if( in_array( _get_session('HandlingType'), array(USER_SUPERVISOR))) {
		$this ->EUI_Page->_setAnd("b.AssignSpv", _get_session('UserId'));
	}

   if( in_array( _get_session('HandlingType'), array(USER_AGENT_INBOUND, USER_AGENT_OUTBOUND))) {
		$this ->EUI_Page->_setAnd("b.AssignSelerId", _get_session('UserId'));
	}	
	
// --------- customize filter -------------------------------------------------
	$this->EUI_Page->_setLikeCache("c.CustomerFirstName", "cfm_cust_name", TRUE);
	$this->EUI_Page->_setLikeCache("c.CustomerNumber", "cfm_cust_number", TRUE);
	$this->EUI_Page->_setAndCache("c.CallReasonQue", "cfm_quality_int_status", TRUE);
	$this->EUI_Page->_setAndCache("b.AssignSelerId", "cfm_user_id", TRUE);
	$this->EUI_Page->_setAndCache("c.CampaignId", "cfm_campaign_id", TRUE);
	$this->EUI_Page->_setAndCache("j.ProductId", "cfm_category_id", TRUE);
	$this->EUI_Page->_setAndOrCache("DATE(k.PolicySalesDate)>='". _getDateEnglish(_get_post('cfm_start_date')) ."'", 'start_date', TRUE);
	$this->EUI_Page->_setAndOrCache("DATE(k.PolicySalesDate)<='". _getDateEnglish(_get_post('cfm_end_date')) ."'", 'end_date', TRUE);
	$this->EUI_Page->_setGroupBy('c.CustomerId');
	
  // -----------if have order sorted ---------------------------------
	if( _get_have_post("order_by") ){
		$this->EUI_Page->_setOrderBy(_get_post("order_by"), _get_post("type"));
   } else {
		$this->EUI_Page->_setOrderBy("k.PolicySalesDate", "DESC");
   }
   
// -----------then limit on here ---------------------------------
	$this->EUI_Page->_setLimit();
	//echo $this->EUI_Page ->_getCompiler();
	
	
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
 
 function _getCountVoice($CustomerId=0)
 {
	$_count = 0;
	$this -> db -> select("count(a.id) as jumlah",FALSE);
	$this -> db -> from("cc_recording a");
	$this -> db -> join("cc_call_session b","a.session_key = b.session_id ","INNER");
	
	if( $this -> URI->_get_have_post('CustomerId')) 
	{
		$this ->db->where("a.assignment_data",$this -> URI->_get_post('CustomerId'));
	}
	
	if( $rows = $this -> db -> get() -> result_first_assoc() ){
		$_count = (INT)$rows['jumlah']; 
	}
	
	return $_count;
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getPages($CustomerId=0)
 {
	$PagesList = array();
	
	$record = $this -> _getCountVoice();
	$counts = ceil($record/5);
	
	for($p = 1; $p <= (INT)$counts; $p++) {
		$PagesList[$p] = $p;
	}
	
	return $PagesList;
	
 }
 

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getLastCallHistory( $CustomerId )
 {
	$_conds = array();
	$this -> db -> reset_select();
	$this -> db -> select('*');
	$this -> db -> from('t_gn_callhistory');
	$this -> db -> where('CustomerId',$CustomerId);
	$this -> db -> order_by('CallHistoryId','DESC');
	$this -> db -> limit(1);
	$rs = $this -> db -> get();
	
	if( $avail = $rs->result_first_assoc() ) {
		$_conds = $avail;
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
 
  function _getListVoice($param = array() )
 {
	$_voice = array();
	
 // $start
	$start = 0; $perpages = 5; 
	
 // total page 
	
	$record = $this -> _getCountVoice();
	$pages = ceil($record/$perpages);
	
	//  get start pages 
	
	if( isset($param['pages']) ){
		if( (INT)$param['pages'] > 0 )
			$start = ( (($param['pages'])-1) * $perpages); 
		else
			$start = 0;
	}
	
	// run data 
	
	$this -> db -> select("a.*");
	$this -> db -> from("cc_recording a");
	$this -> db -> join("cc_call_session b","a.session_key = b.session_id ","INNER");
	
	if( $this -> URI->_get_have_post('CustomerId') ) 
	{
		$this ->db->where("a.assignment_data", $this -> URI->_get_post('CustomerId'));
	}
	
	$this -> db -> limit($perpages,$start);
	
	$qry = $this->db->get();
	$num = $start+1;
	foreach($qry -> result_assoc() as $rows )
	{
		$_voice[$num] = $rows;	
		$num++;
	}	
	return $_voice;
 }
 

 
 
 
 /* get rows data **/
 
 function _getVoiceResult($VoiceId=0 )
 {
	$this -> db -> select("a.*");
	$this -> db -> from("cc_recording a");
	$this -> db -> where('id',$VoiceId);

	
	$_result =  array();
	
	if( $_conds = $this -> db->get() -> result_first_assoc() )
	{
		foreach($_conds as $fld => $values )
		{
			if( $fld=='file_voc_size' ) 
				$_result[$fld] = $this->EUI_Tools->_get_format_size($values);
				
			else if( $fld=='duration' ) 
				$_result[$fld] = $this->EUI_Tools->_set_duration($values);
				
			else if( $fld=='anumber' ) 
				$_result[$fld] = $this->EUI_Tools->_getPhoneNumber($values);	
				
			else if( $fld=='start_time' ) 
				$_result[$fld] = $this->EUI_Tools->_datetime_indonesia($values);	
				
			else 
				$_result[$fld] = $values;
		}
		
		return $_result;
	}
	else
		return null;
 }

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

private function _setSaveApprovalLog( $param = null )
{
 
 $_conds = 0;
 if( !is_null($param) )
 {
	$this -> db ->set('ApprovalId', $param['ApprovalId']);
	$this -> db ->set('ApprovalPoints', $param['ApprovalPoints']);
	$this -> db ->set('ApprovalById', $param['ApprovalById']);
	$this -> db ->set('ApprovalStatus', $param['ApprovalStatus']);
	$this -> db ->set('ApprovalRemark',$param['ApprovalRemark']);
	$this -> db ->set('ApprovalTs', date('Y-m-d H:i:s'));
	$this -> db ->insert('t_gn_log_approval');
	
	if( $this -> db -> affected_rows() > 0 )
	{
		$_conds++;
	}
 }
 
 return $_conds;
 
}
 

// --------------------------------------------------------------------------------- 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function _select_row_data_quality_status( $CustomerId = '' )
{
	$this->arr_status  = "";
	
	$this->db->reset_select();
	$this->db->select("IF( b.AproveCode IS NULL, 0, b.AproveCode) as QualityStatus", FALSE);
	$this->db->from("t_gn_customer a ");
	$this->db->join("t_lk_aprove_status b ", "a.CallReasonQue=b.ApproveId", "LEFT");
	$this->db->where("a.CustomerId", $CustomerId);
	$rs = $this->db->get();
	
	if( $rs->num_rows() ) {
		$this->arr_status = (int)$rs->result_singgle_value();
	}
	
	$arr_button = "";
	$arr_outs =& Spliter(APPROVAL_IN_QUALITY);
	if( in_array( $this->arr_status, $arr_outs->get_array())){
		$arr_button = "button_disabled";
	}
	return $arr_button;
}
 
// --------------------------------------------------------------------------------- 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 protected function _select_row_quality_attribute( $ApproveId = 0 )
{
  $arr_attributes = array();
  
  $this->db->reset_select();
  $this->db->select("*", FALSE);
  $this->db->from("t_lk_aprove_status a");
  $this->db->where("a.ApproveId", $ApproveId);
  
  $rs = $this->db->get();
   if( $rs->num_rows() >  0 ) 
  {
	$arr_attributes = (array)$rs->result_first_assoc();  
  }
  return new EUI_Object( $arr_attributes );
   
 }
 

// --------------------------------------------------------------------------------- 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 protected function _save_row_activity_history( $out = null, $QualityStatus = 0 )
{
 
  if( $QualityStatus == 0 
	 OR !is_object($out) 
	 OR  !$out->fetch_ready() )
 {
	return false;
  }	 

// ----------- select before call status --------------------------------------------------------  
 
 $sfv =& get_class_instance('M_ModSaveActivity');
 $CallBeforeReasonId = $sfv->_select_call_before_status( $out->get_value('CustomerId','intval') );
 
 // ------------------- get last history data ---------------------------------------------------
 
 $arr = new EUI_Object( $this->_getLastCallHistory( $out->get_value('CustomerId','intval') )); 

 if( !$arr->fetch_ready() ){
	 return FALSE;
 }
 
// ------------------------  
 $this->db->reset_write();
 $this->db->set('CallBeforeReasonId',$CallBeforeReasonId);
 $this->db->set('CallHistoryNotes',$out->get_value('QualityRemarks','strtoupper'));
 $this->db->set('CustomerId',$out->get_value('CustomerId', 'intval'));
 $this->db->set('CallReasonId',$arr->get_value('CallReasonId','intval'));
 $this->db->set('CallHistoryCallDate',$arr->get_value('CallHistoryCallDate','strval'));
 $this->db->set('CallNumber',$arr->get_value('CallNumber'));
 $this->db->set('ApprovalStatusId',$QualityStatus);
 $this->db->set('CallHistoryCreatedTs',date('Y-m-d H:i:s'));
 $this->db->set('CallHistoryUpdatedTs',date('Y-m-d H:i:s'));
 $this->db->set('CreatedById',_get_session('UserId'));
 $this->db->set('UpdatedById',_get_session('UserId'));
 $this->db->set('CallSessionId',0);
 $this->db->set('HistoryType',QUALITY_ACTIVITY);

  if( $this->db->insert("t_gn_callhistory") )
 {
	return TRUE;	
 }
 
 //echo $this->db->last_query();

 return FALSE;
 
}


// --------------------------------------------------------------------------------- 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 protected function _update_row_activity_customer( $out  = null, $QualityStatus = 0)
{
   if( $QualityStatus == 0 
	 OR !is_object($out) 
	 OR  !$out->fetch_ready() )
 {
	return false;
  }	  
  
// ------------ reset write date -------------------------
  $this->db->reset_write();
  $this->db->where("CustomerId", $out->get_value('CustomerId', 'intval'));
  $this->db->set("CallReasonQue", $QualityStatus);
  $this->db->set("QueueId", _get_session('UserId'));
  $this->db->set("CustomerUpdatedTs", date('Y-m-d H:i:s'));
  $this->db->set("QA_UpdateTs", date('Y-m-d H:i:s'));
  
  if( $this->db->update("t_gn_customer") ) {
	return true;
  }
  
  return false;
  
 }
	

// --------------------------------------------------------------------------------- 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
// ------------- select last reason QA -------------------------

 public function _select_quality_status( $CustomerId = 0 )
{
 $QualityStatus = 0;
 $this->db->reset_select();
 $this->db->select("CallReasonQue as QualityStatus", FALSE);
 $this->db->from("t_gn_customer");
 $this->db->where("CustomerId", $CustomerId);
 
 $rs = $this->db->get();
 if( $rs -> num_rows() >  0 ){
	$QualityStatus = $rs->result_singgle_value();
 }
 
 return $QualityStatus;
}	
	
	
// --------------------------------------------------------------------------------- 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 // Check Scoring Result!
 public function _checkScoreResult ( $idCustomer = "" ) {
 	 $checkScoring = $this->db->query(
 	 	"SELECT id_customer FROM score_result WHERE id_customer='$idCustomer'"
 	 );
 	 if ( $checkScoring == true AND $checkScoring->num_rows() > 0 ) {
 	 	 return true;
 	 } else {
 	 	 return false;
 	 }
 }
	
// --------------------------------------------------------------------------------- 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 protected function _select_count_quality_parent( $QualityStatus = 0)
{
 $arr_count_status = 0;
 
 $this->db->reset_select();
 $this->db->select("count(a.ApproveId) as tot", FALSE); 
 $this->db->from("t_lk_aprove_status a ");
 $this->db->where("a.ApproveParent", $QualityStatus);
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ){
	$arr_count_status = (int)$rs->result_singgle_value();	
 }
 
 return $arr_count_status;
} 
// --------------------------------------------------------------------------------- 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function _save_row_quality_data( $out = null )
{
  	
  $cond = FALSE;
  $attr = $this->_select_row_quality_attribute( $out->get_value('QualityStatus') );
  if( !$attr->fetch_ready() ){
	  return $cond;
  }
 
 // ------------ then set status on child only .
	if( $attr->get_value('ApproveEskalasi', 'intval') == 1 )
  {
	$cond = $this->_save_row_activity_history( $out, $out->get_value('QualityReasonStatus','intval') );
	if( !$cond ) { 
		return FALSE; 
	}
	$cond = $this->_update_row_activity_customer( $out, $out->get_value('QualityReasonStatus','intval') );
  } 
  else
  {
	$this->status = $out->get_value('QualityStatus','intval');
	$this->jumlah = $this->_select_count_quality_parent($this->status);
	
	if( ($this->status) AND ($this->jumlah > 0) ){
		$this->status = $out->get_value('QualityReasonStatus','intval');
	}	
	
	$cond = $this->_save_row_activity_history( $out, $this->status);
	if( !$cond ) { 
		return FALSE; 
	}
	
	$cond = $this->_update_row_activity_customer( $out, $this->status);
  }
  
 return $cond;
}
 
 
}
?>