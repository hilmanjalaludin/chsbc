<?php
/*
 * E.U.I 
 *
 
 * subject	: M_SetBenefit modul 
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Utility/
 */
 
class M_SrcDonotcallList extends EUI_Model
{

private static $arr_usr_level = null;

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

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public static function &UserLevelId() 
 {
   if(is_null(self::$arr_usr_level)) {	
		self::$arr_usr_level =& AllUserIdByLevel(array(USER_ROOT,USER_ADMIN));
   }
   return self::$arr_usr_level;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */ 
function __construct() {
	$this->load->meta('_cc_extension_agent');
	$this->load->model(array('M_SetCallResult','M_MaskingNumber','M_Request'));
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function _getCekPolicyForm( $CustomerId = 0 )
{
	$_conds = 0;
	
	$this -> db -> select('COUNT(a.PolicyAutoGenId) as jumlah');
	$this -> db -> from("t_gn_policyautogen a ");
	$this -> db -> where("a.CustomerId", $CustomerId);
	
	if(  $rows = $this -> db -> get() -> result_first_assoc()  )
	{
		$_conds = (INT)$rows['jumlah'];
	}
	
	return $_conds;
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  
function NotInterest()
{
	$_a = array(); $_b = array();
	if( class_exists('M_SetCallResult'))
	{
		$_a = $this -> M_SetCallResult -> _getNotInterest(); 
		foreach( $_a as $_k => $_v )
		{
			$_b[$_k] = $_k;  
		}	
	}
	
	return $_b;
} 
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function Sale()
{
	$_a = array(); $_b = array();
	if( class_exists('M_SetCallResult'))
	{
		$_b = $this -> M_SetCallResult -> _getPendingInfo();
		$_a = $this -> M_SetCallResult -> _getInterestSale(); 
		foreach( $_a as $_k => $_v )
		{
			if( !in_array($_k, array_keys($_b))){
				$_b[$_k] = $_k;  
			}
		}	
	}
	
	return $_b;
} 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function _get_default()
{
	$arr_user_level =& self::UserLevelId();
	$this->EUI_Page->_setPage(10); 
	$this->EUI_Page->_setSelect("a.CustomerId");
	$this->EUI_Page->_setFrom("t_gn_customer a");
	
	$this->EUI_Page->_setJoin("t_gn_assignment b ","a.CustomerId=b.CustomerId", "INNER");
	$this->EUI_Page->_setJoin("t_lk_gender e ","a.GenderId=e.GenderId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_campaign d "," a.CampaignId=d.CampaignId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_ver_result g "," a.CustomerId=g.cust_id", "LEFT");
	$this->EUI_Page->_setJoin("t_lk_callreason f "," a.CallReasonId = f.CallReasonId", "LEFT", TRUE);
	
// ------------------------- defualt filter ------------------------	

	$this->EUI_Page->_setAnd("d.OutboundGoalsId", 2, TRUE);
	$this->EUI_Page->_setAnd("b.AssignBlock", 0, TRUE);
	$this->EUI_Page->_setAnd("d.CampaignStatusFlag", 1, TRUE);
	// $this->EUI_Page->_setAnd("g.ver_result", 2,TRUE);
	$this->EUI_Page->_setAnd("f.CallReasonNoMoreFU", 1, TRUE);
	// $this->EUI_Page->_setAnd("( a.CallReasonId NOT IN('". implode( "','", self::Sale()) ."') OR a.CallReasonId IS NULL )");
	// $this->EUI_Page->_setAnd("( a.CallReasonId NOT IN('". implode( "','", self::NotInterest()) ."') OR a.CallReasonId IS NULL)");
 	
// ------------------- session filter  --------------------------------------------------------------
	if( in_array(_get_session('HandlingType'), 
		array(USER_ROOT, USER_ADMIN) )) {
		$this->EUI_Page->_setWhereIn("b.AssignAdmin", $arr_user_level);	
	}
	
	if( in_array(_get_session('HandlingType'), 
		array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND) )) {
		$this->EUI_Page->_setAnd("b.AssignSelerId", _get_session('UserId'));	
	}
	
	if( in_array(_get_session('HandlingType'), 
		array(USER_SUPERVISOR))) {
		$this->EUI_Page->_setAnd("b.AssignSpv", _get_session('UserId'));
	}
	
	if( in_array(_get_session('HandlingType'), 
		array(USER_MANAGER))) {
		$this->EUI_Page->_setAnd("b.AssignMgr", _get_session('UserId'));
	}
	
	if( in_array(_get_session('HandlingType'), 
		array(USER_ACCOUNT_MANAGER))) {
		$this->EUI_Page->_setAnd("b.AssignAmgr", _get_session('UserId'));
	}
	
	if( in_array(_get_session('HandlingType'), 
		array(USER_ADMIN))) {
		$this->EUI_Page->_setAnd("b.AssignMgr", _get_session('UserId'));
	}
	
	
	// ------------------- post filter  --------------------------------------------------------------	
	$this->EUI_Page->_setAndCache("a.CallReasonId", "src_call_reason", true);
	$this->EUI_Page->_setAndCache("a.CampaignId", "src_campaign_name", true);
	$this->EUI_Page->_setAndCache("a.GenderId", "src_gender", true);
	$this->EUI_Page->_setAndCache("b.AssignSelerId", "src_user_agent", true);
	$this->EUI_Page->_setLikeCache("a.CustomerFirstName", "src_cust_name", true);
	$this->EUI_Page->_setAndCache("a.CustomerNumber", "src_customer_number", true);
	$this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs>='". StartDate(_get_post('src_start_date')) ."'", 'src_start_date', true);
	$this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs<='". EndDate(_get_post('src_end_date')) ."'", 'src_end_date', true);
	
	#echo $this->EUI_Page->_getCompiler();
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
	$arr_user_level =& self::UserLevelId();
	$conds1 = "IF(f.CallReasonDesc is null,'New',f.CallReasonDesc) as CallResult ";
	// mode mssql
	if( QUERY == 'mssql') {
		$conds1 = " CASE WHEN f.CallReasonDesc IS NULL THEN 'New' ELSE f.CallReasonDesc END AS CallResult ";
	}

	$this->EUI_Page->_postPage(_get_post('v_page') );
	$this->EUI_Page->_setPage(10);
	
	$this->EUI_Page->_setArraySelect(array(
		"a.CustomerId as CustomerId" => array("CustomerId","CustomerId","primary"),
		"d.CampaignName as CampaignName" => array("CampaignName","Campaign Name"),
		//"a.CustomerNumber as CustomerNumber" => array("CustomerNumber", "CIF"),
		"a.CustomerFirstName as CustomerName" => array("CustomerName","Customer Name"),
		"a.CustomerCity as CustomerCity" => array("CustomerCity", "City"),
		//"a.CustomerDOB as CustomerDOB" => array("CustomerDOB", "DOB"),
		"a.CustomerDOB as CustomerAge" => array("CustomerAge", "Age"),
		"( select gd.Gender from t_lk_gender gd where gd.GenderId=a.GenderId) as Gender" => array("Gender", "Gender"),
		"( select ag.full_name from tms_agent ag where ag.UserId = b.AssignSelerId ) as UserId" => array("UserId", "Agent ID"),
		"(select ag.full_name from tms_agent ag where ag.UserId = a.UpdatedById) as UpdatedById" => array("UpdatedById", "Updated By Agent"),
		"{$conds1}" => array("CallResult", "Call Result"),
		"a.CustomerUpdatedTs as CustomerUpdatedTs" => array("CustomerUpdatedTs", "Call Date")
	));
	
	$this->EUI_Page->_setFrom("t_gn_customer a");
	$this->EUI_Page->_setJoin("t_gn_assignment b ","a.CustomerId=b.CustomerId", "INNER");
	$this->EUI_Page->_setJoin("t_gn_campaign d "," a.CampaignId=d.CampaignId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_ver_result g "," a.CustomerId=g.cust_id", "LEFT");
	$this->EUI_Page->_setJoin("t_lk_callreason f "," a.CallReasonId = f.CallReasonId", "LEFT", TRUE);
	// ------------------------- defualt filter ------------------------	

	$this->EUI_Page->_setAnd("d.OutboundGoalsId", 2, TRUE);
	$this->EUI_Page->_setAnd("b.AssignBlock", 0, TRUE);
	$this->EUI_Page->_setAnd("d.CampaignStatusFlag", 1, TRUE);
	// $this->EUI_Page->_setAnd("g.ver_result", 2,TRUE);
	$this->EUI_Page->_setAnd("f.CallReasonNoMoreFU", 1, TRUE);
	// $this->EUI_Page->_setAnd("( a.CallReasonId NOT IN('". implode( "','", self::Sale()) ."') OR a.CallReasonId IS NULL )");
	// $this->EUI_Page->_setAnd("( a.CallReasonId NOT IN('". implode( "','", self::NotInterest()) ."') OR a.CallReasonId IS NULL)");
 	
	// ------------------- session filter  --------------------------------------------------------------
	if( in_array(_get_session('HandlingType'), 
		array(USER_ROOT, USER_ADMIN) )) {
		$this->EUI_Page->_setWhereIn("b.AssignAdmin", $arr_user_level);	
	}
	
	
	if( in_array(_get_session('HandlingType'), 
		array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND) )) {
		$this->EUI_Page->_setAnd("b.AssignSelerId", _get_session('UserId'));	
	}
	
	if( in_array(_get_session('HandlingType'), 
		array(USER_SUPERVISOR))) {
		$this->EUI_Page->_setAnd("b.AssignSpv", _get_session('UserId'));
	}
	
	if( in_array(_get_session('HandlingType'), 
		array(USER_LEADER))) {
		$this->EUI_Page->_setAnd("b.AssignLeader", _get_session('UserId'));
	}
	
	
	if( in_array(_get_session('HandlingType'), 
		array(USER_MANAGER))) {
		$this->EUI_Page->_setAnd("b.AssignMgr", _get_session('UserId'));
	}
	
	if( in_array(_get_session('HandlingType'), 
		array(USER_ACCOUNT_MANAGER))) {
		$this->EUI_Page->_setAnd("b.AssignAmgr", _get_session('UserId'));
	}
	
	if( in_array(_get_session('HandlingType'), 
		array(USER_ADMIN))) {
		$this->EUI_Page->_setAnd("b.AssignMgr", _get_session('UserId'));
	}
	
	// ------------------- post filter  --------------------------------------------------------------	
	$this->EUI_Page->_setAndCache("a.CallReasonId", "src_call_reason", true);
	$this->EUI_Page->_setAndCache("a.CampaignId", "src_campaign_name", true);
	$this->EUI_Page->_setAndCache("a.GenderId", "src_gender", true);
	$this->EUI_Page->_setAndCache("b.AssignSelerId", "src_user_agent", true);
	$this->EUI_Page->_setAndCache("a.CustomerNumber", "src_customer_number", true);
	$this->EUI_Page->_setLikeCache("a.CustomerFirstName", "src_cust_name", true);
	$this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs>='". StartDate(_get_post('src_start_date')) ."'", 'src_start_date', true);
	$this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs<='". EndDate(_get_post('src_end_date')) ."'", 'src_end_date', true);
	
	
	
	// -----------if have order sorted ---------------------------------
  	if( _get_have_post("order_by") ){
		$this->EUI_Page->_setOrderBy(_get_post("order_by"), _get_post("type"));
   	} else {
		$this->EUI_Page->_setOrderBy("a.CustomerId", "DESC");
  	}
   
	// -----------then limit on here ---------------------------------
	$this->EUI_Page->_setLimit();
	#echo $this->EUI_Page->_getCompiler();
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
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getGenderId()
{
  $_conds = array();
  $sql = " SELECT a.GenderId, a.Gender FROM  t_lk_gender a";
  $qry = $this -> db -> query($sql);
  if( !$qry -> EOF() )
  {
	foreach( $qry -> result_assoc() as $rows ) 
	{
		$_conds[$rows['GenderId']] = $rows['Gender'];
	}
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
 
function _getCardType()
{
  $_conds = array();
  $sql = " SELECT a.CardTypeId, a.CardTypeDesc FROM t_lk_cardtype  a WHERE a.CardTypeFlag=1";
  $qry = $this -> db -> query($sql);
  if( !$qry -> EOF() )
  {
	foreach( $qry -> result_assoc() as $rows ) 
	{
		$_conds[$rows['CardTypeId']] = $rows['CardTypeDesc'];
	}
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
 
function _get_data_template()
{
	$data_template = $this -> _cc_extension_agent -> _get_meta_colums();
 	if( $data_template )
	{
		return $data_template;
	}
} 


/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
 
 public function _getDetailCustomer($CustomerId=null)
 {
	$_conds = array();
	$this -> db -> reset_select();
	$this -> db -> select('a.*, b.Gender, c.Salutation, d.CampaignName, d.CampaignNumber, e.CallReasonDesc, e.CallReasonCategoryId ', FALSE);
	$this -> db -> from('t_gn_customer a');
	$this -> db -> join('t_lk_gender b','a.GenderId=b.GenderId','LEFT');
	$this -> db -> join('t_lk_salutation c','a.SalutationId=c.SalutationId','LEFT');
	$this -> db -> join('t_gn_campaign d','a.CampaignId=d.CampaignId','LEFT');
	$this -> db -> join('t_lk_callreason e','a.CallReasonId=e.CallReasonId','LEFT');
	$this -> db -> where('a.CustomerId',$CustomerId);
	$rs = $this -> db ->get();
	
	if($rs->num_rows() > 0) 
		foreach( $rs-> result_assoc() as $rows ) 
	{
		foreach($rows as $k => $v ){
			$_conds[$k] = $v;
		}
	}
	
	return $_conds;
 }
 
 /*
 * @ def 		: _getOriginalData
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
public function _getOriginalData( $CustomerId = 0 )
{
	$data = array();
	
	$this ->db ->select('*');
	$this ->db ->from('t_gn_customer');
	$this ->db ->where('CustomerId',$CustomerId);
	
	if( $CustomerData = $this -> db->get()-> result_first_assoc() ) {
		$data = $CustomerData;
	}
	
	return $data;
} 
 



 /*
 * @ def 		: _getPhoneCustomer // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function _getPhoneCustomer( $CustomerId=0, $flags = 0  )
{
	$arr_select_contact = array();
	
	
// -------- map array phone ---------------
 
 $this->Event = "strval";
 if( $flags==0 ){
	$this->Event= "_setMasking";	
 }
	
 $arr_map_phone = array(
		'CustomerHomePhoneNum' => array('Home', $this->Event), 
		'CustomerMobilePhoneNum' => array('Mobile',$this->Event), 
		'CustomerWorkPhoneNum' => array('Office', $this->Event),
		'CustomerWorkFaxNum' => array('Off. Fax', $this->Event),
		'CustomerWorkExtPhoneNum' => array('Ext', $this->Event),
		'CustomerFaxNum' => array('Fax',$this->Event)
	);	
	
	
	$this->db->reset_select();
	$this->db->select(array_keys($arr_map_phone), FALSE);
	$this->db->from('t_gn_customer');
	$this->db->where('CustomerId',$CustomerId);
	
	$rs = $this->db->get();
	if( $rs->num_rows() > 0 ) 
		foreach($rs-> result_assoc() as $rows )
	{
	   if( is_array($rows) ) 
		   foreach( $rows as $field => $val ) 
	   {
		   if( !is_null($val) AND strlen($val) > 0) 
		   {
			   $call_select_masking = call_user_func_array($arr_map_phone[$field][1], array($val));
			   $arr_select_contact[$val] = join(" ",  array($arr_map_phone[$field][0], $call_select_masking));
		   }
       }	   
	   
		// if( !is_null($rows['CustomerHomePhoneNum']) 
			// AND $rows['CustomerHomePhoneNum']!='' )
		// {
			// $_conds[$rows['CustomerHomePhoneNum']] = " Home - "._setMasking($rows['CustomerHomePhoneNum']); 
		// }
		
		// if( !is_null($rows['CustomerMobilePhoneNum']) 
			// AND $rows['CustomerMobilePhoneNum']!='' )
		// {
			// $_conds[$rows['CustomerMobilePhoneNum']] = " Mobile - ". _setMasking($rows['CustomerMobilePhoneNum']); 
		// }
		
		// if( !is_null($rows['CustomerWorkPhoneNum']) 
			// AND $rows['CustomerWorkPhoneNum']!='' )
		// {
			// $_conds[$rows['CustomerWorkPhoneNum']] = " Office - ". _setMasking($rows['CustomerWorkPhoneNum']); 
		// }
		
		// if( !is_null($rows['CustomerWorkFaxNum']) 
			// AND $rows['CustomerWorkFaxNum']!='' )
		// {
			// $_conds[$rows['CustomerWorkFaxNum']]= " Work Fax - ". _setMasking($rows['CustomerWorkFaxNum']); 
		// }
		
		
		// if( !is_null($rows['CustomerWorkExtPhoneNum']) 
			// AND $rows['CustomerWorkExtPhoneNum']!='' )
		// {
			// $_conds[$rows['CustomerWorkExtPhoneNum']] = " Work Ext - ". $rows['CustomerWorkExtPhoneNum']; 
		// }
		
		
		// if( !is_null($rows['CustomerFaxNum']) 
			// AND $rows['CustomerFaxNum']!='' )
		// {
			// $_conds[$rows['CustomerFaxNum']]= " Fax - ". $rows['CustomerFaxNum']; 
		// }
	}
	
	return (array)$arr_select_contact;
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
	$_conds = array();
	
	$this ->db ->select('a.ApprovalNewValue, b.ApprovalItem');
	$this ->db ->from('t_gn_approvalhistory a');
	$this ->db ->join('t_lk_approvalitem b','a.ApprovalItemId=b.ApprovalItemId','LEFT');
	$this ->db ->where('a.CustomerId',$CustomerId);
	
	foreach($this ->db -> get()->result_assoc() as $rows )
	{
		$_avail = explode(' ', $rows['ApprovalItem']);
		if( count($_avail) > 0 ){
			$_conds[$rows['ApprovalNewValue']] = $_avail[0] .' '. $this->M_MaskingNumber->MaskingBelakang($rows['ApprovalNewValue']); 	
		}
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
 function _cti_extension_upload( $data = null )
 {
	$_totals = 0;
	$_conds = false;
	if( !is_null( $data) )
	{
		if($this -> URI -> _get_post('mode') =='truncate') //empty table if truncate mode  
			$this -> db -> truncate( $this -> _cc_extension_agent-> _get_meta_index() );
			
		// then request 
		
		foreach( $data as $rows ) 
		{
			if( $this -> db -> insert( 
				$this -> _cc_extension_agent-> _get_meta_index(),
				$rows
			)){
				$_totals+=1;
			}
		}
		
		if( $_totals > 1)
			$_conds = true;
		
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
 
 public function _getAvailProduct( $CustomerId = 0 )
 {
	$_product = array();
	
	$this ->db->select('d.ProductId, d.ProductName');
	$this ->db->from('t_gn_customer a ');
	$this ->db->join('t_gn_campaign b ',' a.CampaignId=b.CampaignId');
	$this ->db->join('t_gn_campaignproduct c ',' b.CampaignId=c.CampaignId');
	$this ->db->join('t_gn_product d ',' c.ProductId=d.ProductId');
	if($CustomerId > 0)
	{
		$this ->db->where('a.CustomerId',$CustomerId);
	}
	foreach( $this ->db-> get() -> result_assoc() as $rows ) {
		$_product[$rows['ProductId']] = $rows['ProductName'];
	}
	
	return $_product;
 }
 
// --------------------------------------------------------------------------------------------------------- 
/*
 * @ package 		set follow flag if user click detail data 
 *
 */
 
 public function _set_row_update_followup( $out  = null )
{
	if( !$out->fetch_ready() )
 {
	return FALSE;
 }
 
// --------- clear cache ----------------------------------------
 
 $this->db->reset_write();
 $this->db->where("CustomerId", $out->get_value('CustomerId'), false);
 $this->db->set("UpdatedById",_get_session('UserId'),false);
 $this->db->set("Flag_Followup",1,true);
 $this->db->update("t_gn_customer");
 
 
// --------------- ok -------------------------------- 
 if( $this->db->affected_rows() > 0 ){
	return TRUE;	
 }	 

// --------- second argument -----------. 
 $this->db->reset_select();
 $this->db->select("CustomerId", FALSE);
 $this->db->from("t_gn_customer");
 $this->db->where("CustomerId", $out->get_value('CustomerId'));
 $this->db->where("UpdatedById",_get_session('UserId'));
 $this->db->where("Flag_Followup",1);
 $rs = $this->db->get();
  if( $rs->num_rows() > 0 )
 {
	$cond = (int)$rs->result_singgle_value();	
 }	 
 
 if( $cond ) {
	return TRUE;
 } 
 
 return FALSE;
 
}

// --------------------------------------------------------------------------------------------------------- 
/*
 * @ package 		set follow flag if user click detail data 
 *
 */
 
 public function _unset_row_update_followup( $out  = null )
{
	if( !$out->fetch_ready() )
 {
	return FALSE;
 }
 
// --------- clear cache ----------------------------------------
 $this->db->reset_write();
 
 $this->db->where("CustomerId", $out->get_value('CustomerId'), false);
 $this->db->where("Flag_Followup",1,true);
 
 $this->db->set("UpdatedById",_get_session('UserId'),false);
 $this->db->set("Flag_Followup",0,true);
 $this->db->update("t_gn_customer");
 
// --------------- ok -------------------------------- 

 if( $this->db->affected_rows() > 0 ){
	return TRUE;	
 }	else {
	 return FALSE;
 } 
 
}
 
// ======================================= END CLASS ======================================== 

}

?>