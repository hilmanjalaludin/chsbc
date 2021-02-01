<?php

/*
 * E.U.I 
 *
 
 * subject	: M_SetBenefit modul 
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Utility/
 */
 
class M_AbandonReview extends EUI_Model
{

var $set_limit_page = 10;
// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
 private static $Instance   = null; 
 public static function &Instance()
{
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
}

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
function __construct()
{
	$this->load->model('M_SetCallResult');
}


// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
function CallBackLater()
{
	$_conds = array(); $_a = array(); 
	if(class_exists('M_SetCallResult') )
	{
		$_data = $this -> M_SetCallResult -> _getCallback();
		foreach( $_data as $_k => $_v )
		{
			$_conds[$_k] = $_k;  
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
 
function _get_default()
{
 // --------------- get post parameter --------------------------	
 $out  = new EUI_Object( _get_all_request());
 $conds1 = " date(now()) ";
 if( QUERY == 'mssql') {
 	$conds1 = " convert(varchar, getdate(), 23) ";
 }
 // $out->debug_label();
 $arr_call_thinking = array_keys(CallResultThinking());
 
 // --------------- get post parameter --------------------------	
 $this->EUI_Page->_setPage($this->set_limit_page); 
 $this->EUI_Page->_setSelect("b.CustomerId", false);
 $this->EUI_Page->_setFrom("t_gn_customer b");
 $this->EUI_Page->_setJoin("t_gn_assignment c "," b.CustomerId=c.CustomerId","LEFT", true);
 
 // ------------ set filter ---------------------------------------------------------

 if( in_array( _get_session('HandlingType'), array( USER_SUPERVISOR )) )
 {
	$this->EUI_Page->_setAnd("c.AssignSpv", _get_session('UserId'));
 }		
 
 if( in_array( _get_session('HandlingType'), array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)))
 // ---------- filter post -----------------
 {
	$this->EUI_Page->_setAnd("c.AssignSelerId", _get_session('UserId'));
 }	

 $this->EUI_Page->_setAnd("b.flag_abandon", '1');
 
 $this->EUI_Page->_setAndCache("b.CallReasonId", "clbk_call_reason", true);
 $this->EUI_Page->_setAndCache("b.CampaignId", "clbk_campaign_name", true);
 $this->EUI_Page->_setAndCache("b.GenderId", "clbk_gender", true);
 $this->EUI_Page->_setAndCache("c.AssignSelerId", "clbk_user_agent", true);
 $this->EUI_Page->_setLikeCache("b.CustomerFirstName", "clbk_cust_name", true);
 $this->EUI_Page->_setLikeCache("b.CustomerNumber", "clbk_customer_number", true);
 // ----------- cek appointment todays -----
 $this->EUI_Page->_setWhereinCache("b.Recsource", "src_customerabd_recsource", true);
 $this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs>='{$out->get_value('clbk_start_date', 'StartDate')}'", 'clbk_start_date', TRUE);
 $this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs<='{$out->get_value('clbk_end_date', 'EndDate')}'", 'clbk_end_date', TRUE);
 
// -------- add filter -----------------
 $this->EUI_Page->_setAndOrCache($this->set_like_group("b.CustomerCity", "LIKE",$out->get_array_value('clbk_call_city')), 'clbk_call_city', true);
 $this->EUI_Page->_setLikeCache("b.{$out->get_value('src_filter_phone_by')}", 'clbk_value_phone_by', false);
 $this->EUI_Page->_setAnd("b.expired_date >= {$conds1}" , FALSE);
	
 //echo $this->EUI_Page->_getCompiler();
 return $this->EUI_Page;
 
}

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
 
 function set_like_group( $field="", $operator = "", $arr_val = null )
{
  $this->arr_ptr = array('LIKE' => 'LIKE','NOT_LIKE' => 'NOT LIKE');
  $this->arr_sec = array();
 if( is_array($arr_val) ) 
	 foreach($arr_val as $k => $value )
 {
	if( in_array($operator, array_keys($this->arr_ptr) )){
		$this->arr_sec[] = $field ." ". $this->arr_ptr[$operator] . " '%". mysql_real_escape_string(trim($value))."%' "; 
	}		
 }
	
 if( count($this->arr_sec) == 0  ){
	return FALSE;
 }	
	
 $this->arr_sec = " ( ". join(" OR ", $this->arr_sec) ." ) ";
 return (string)$this->arr_sec;
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
 	// --------------- get post parameter --------------------------	
	$out  = new EUI_Object( _get_all_request());
	$arr_call_thinking = array_keys(CallResultThinking());
   // --------------- get post parameter --------------------------	

  $conds1 = " date(now()) ";
  if( QUERY == 'mssql') {
  	$conds1 = " convert(varchar, getdate(), 23) ";
  }
 
  $this->EUI_Page->_postPage(_get_post('v_page') );
  $this->EUI_Page->_setPage($this->set_limit_page);
  $this->EUI_Page->_setArraySelect(array(
		"b.CustomerId as CustomerId" => array("CustomerId", "CustomerId", "primary"),
		"( SELECT cmp.CampaignDesc 
			FROM t_gn_campaign cmp 
			WHERE cmp.CampaignId=b.CampaignId ) as CampaignName" => array("CampaignName", "Campaign Name"),
		"b.CustomerFirstName as CustomerFirstName" => array("CustomerFirstName","Customer Name"),
		"b.CustomerCity as CustomerCity" => array("CustomerCity","City"),
		
		"( SELECT gd.Gender 
			FROM t_lk_gender gd 
			WHERE gd.GenderId=b.GenderId ) as Gender" => array("Gender", "Gender"),
			
		"( SELECT cs.CallReasonDesc 
			FROM t_lk_callreason cs 
			WHERE cs.CallReasonId=b.CallReasonId ) as CallResultId" => array("CallResultId","Call Reason"),
		"(select tms.id as AgentId from tms_agent tms where tms.UserId=c.AssignSelerId) as AgentId" => array("AgentId", "Agent ID"),
		"(select tms.id as Supervisor from tms_agent tms where tms.UserId=c.AssignSpv) as Supervisor" => array("Supervisor", "Supervisor"),
		
		"b.CustomerUpdatedTs as CustomerUpdatedTs" => array("CustomerUpdatedTs", "Last Update")
  ));
  
  $this->EUI_Page->_setFrom("t_gn_customer b ");
  $this->EUI_Page->_setJoin("t_gn_assignment c "," b.CustomerId=c.CustomerId","LEFT", true);
 
 
// ------------ set filter ---------------------------------------------------------
 if( in_array( _get_session('HandlingType'), 
	array( USER_SUPERVISOR )) )
 {
	$this->EUI_Page->_setAnd("c.AssignSpv", _get_session('UserId'));
 }		
 
 if( in_array( _get_session('HandlingType'), 
	array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)))
 {
	$this->EUI_Page->_setAnd("c.AssignSelerId", _get_session('UserId'));
 }	

 $this->EUI_Page->_setAnd("b.flag_abandon", '1');	
 // ---------- filter post -----------------
 $this->EUI_Page->_setAndCache("b.CallReasonId", "clbk_call_reason", true);
 $this->EUI_Page->_setAndCache("b.CampaignId", "clbk_campaign_name", true);
 $this->EUI_Page->_setAndCache("b.GenderId", "clbk_gender", true);
 $this->EUI_Page->_setAndCache("c.AssignSelerId", "clbk_user_agent", true);
 $this->EUI_Page->_setLikeCache("b.CustomerNumber", "clbk_customer_number", true);
 $this->EUI_Page->_setLikeCache("b.CustomerFirstName", "clbk_cust_name", true);
 $this->EUI_Page->_setWhereinCache("b.Recsource", "src_customerabd_recsource", true);

 
 
 $this->EUI_Page->_setAndOrCache("b.CustomerUpdatedTs>='{$out->get_value('clbk_start_date', 'StartDate')}'", 'clbk_start_date', TRUE);
 $this->EUI_Page->_setAndOrCache("b.CustomerUpdatedTs<='{$out->get_value('clbk_end_date', 'EndDate')}'", 'clbk_end_date', TRUE);
 // -------- add filter -----------------
 $this->EUI_Page->_setAndOrCache($this->set_like_group("b.CustomerCity", "LIKE",$out->get_array_value('clbk_call_city')), 'clbk_call_city', true);
 $this->EUI_Page->_setLikeCache("b.{$out->get_value('src_filter_phone_by')}", 'clbk_value_phone_by', false);
 $this->EUI_Page->_setAnd("b.expired_date >= {$conds1}" , FALSE);
	
// ----------- set order ------------------------------
	
  if(_get_have_post('order_by')) {
	$this->EUI_Page->_setOrderBy(_get_post('order_by'),_get_post('type'));
  } else{
	  $this->EUI_Page->_setOrderBy("b.CustomerId","DESC");
  }
  
 $this->EUI_Page->_setLimit();
 //echo $this->EUI_Page->_getCompiler();
   
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



 function _update_customer_reset ($CustomerId=0) {

 	$call_back = false;
 	if ( !empty($CustomerId) ) {
 		$this->db->reset_select();
	 	$this->db->set("cnt_abandon" , 0);
	 	$this->db->set("flag_abandon" , 0);
	 	$this->db->where("CustomerId" , $CustomerId);
	 	$this->db->update("t_gn_customer");
	 	if ( $this->db->affected_rows() > 0 ) {
	 		$call_back = true;
	 	}
 	}

 	return $call_back;
 }


 function _update_assignment_reset ( $CustomerId = 0 ) {

 	$call_back = false;
 	if ( !empty($CustomerId) ) {
 		$this->db->reset_select();
	 	$this->db->set("AssignSelerId" , 0);
	 	$this->db->where("CustomerId" , $CustomerId);
	 	$this->db->update("t_gn_assignment");
	 	if ( $this->db->affected_rows() > 0 ) {
	 		$call_back = true;
	 	}
 	}


 	return $call_back;
 }
 
 function _insert_history( $CustomerId=0 ) {
 	
 	// start define 
 	$callback = false;
 	$dateNow = date("Y-m-d H:i:s");
 	$noteHistory = "AUTOMATIC RESET FROM ABANDON REVIEW (".$dateNow.") ";
 	
 	if( !empty($CustomerId) || $CustomerId !=0 ) {
 		$selectLastStatus = $this->db->query("
 			select 
			max(a.CallHistoryId) as LastCallHistoryId
			from t_gn_callhistory a where a.CustomerId='$CustomerId';
 		");


 		// if more than 1 row
 		if ( $selectLastStatus == true AND $selectLastStatus->num_rows() > 0 ) {

 			// get vlue select from query
 			$sls = $selectLastStatus->row_array();
 			$sls = new EUI_Object($sls);
 			$LastCallHistoryId = $sls->get_value("LastCallHistoryId");

			if ( $LastCallHistoryId == NULL ) {
				$LastCallHistoryId = 0;
			} 				
 				// statement insert to callhistory
 			
 			$insertPasteCallhistory = (
 				"INSERT INTO 
 				t_gn_callhistory
 				( 
 					CallSessionId,
 					CustomerId,
 					CallReasonCategoryId,
 					CallBeforeReasonId,
 					CallReasonId,
 					DisagreeId,
 					ApprovalStatusId,
 					CreatedById,
 					UpdatedById,
 					AgentCode,
 					SPVCode,
 					ATMCode,
 					AMGRCode,
 					MGRCode,
 					ADMINCode,
 					CallHistoryCallDate,
 					CallNumber,
 					CallHistoryNotes,
 					CallHistoryCreatedTs,
 					CallBeforeReasonQue,
 					HistoryType,
 					CallHirarcyHigh,
 					EmailTemp
 				) 
 				select 
 					CallSessionId,
 					CustomerId,
 					CallReasonCategoryId,
 					CallBeforeReasonId,
 					CallReasonId,
 					DisagreeId,
 					ApprovalStatusId,
 					CreatedById,
 					UpdatedById,
 					'"._get_session("Username")."' as AgentCode,
 					SPVCode,
 					ATMCode,
 					AMGRCode,
 					MGRCode,
 					ADMINCode,
 					CallHistoryCallDate,
 					CallNumber,
 					'$noteHistory' as CallHistoryNotes,
 					CallHistoryCreatedTs,
 					CallBeforeReasonQue,
 					'2' as HistoryType,
 					CallHirarcyHigh,
 					EmailTemp FROM t_gn_callhistory WHERE CallHistoryId='$LastCallHistoryId';"
 			);

 			$execCopyPaste = $this->db->query($insertPasteCallhistory);
 			if ( $execCopyPaste == true ) {
 				$callback = true;
 			}

 		}
 	}


 	return $callback;

 }
 
 
}

?>