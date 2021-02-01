<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Enigma User Interface
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		Enigma User Interface
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, razaki, Inc.
 * @license		http://razakitechnology.com/user_guide/license.html
 * @link		http://razakitechnology.com
 * @since		Version 1.0
 * @filesource
 */
class M_SrcCustomerList extends EUI_Model
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

private $Row_Lock = null;
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
	$this->load->model(array('M_SetCallResult','M_MaskingNumber','M_Request','M_MgtLockCustomer'));
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
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 *
 * $this->EUI_Page  [/opt/enigma/webapps/hsbc-portof-sql/system/libraries]
 */
 
 function _get_default()
{
	$out = UR(); $cok = CK(); $cfg = Config(); 
	
	$condition = "IF(f.CallReasonDesc is null,'New',f.CallReasonDesc) as CallResult"; // mysql
	$condExpired = " DATE(NOW()) ";

	if ( QUERY == 'mssql') {
		$condition = "CASE WHEN f.CallReasonDesc IS NULL THEN 'New' ELSE f.CallReasonDesc END AS CallResult";
		$condExpired = date('Y-m-d');
	}
	
	// define ,array  akumulatif data baddled dari data yang ada .
	// dan push jadi array 
    $out->add('default_cookies_status', array_keys(CallResultNotInterestBadlead()));
	
	// im not understod !
	$this->getWhereLock();

	// customize off filter loalizatio  page 
	$this->EUI_Page->_setPage(10); 
	
	
	// tambahan set count untuk percepatan 
	// process query agar irit memeory 
	$this->EUI_Page->_setCount(true);
	$this->EUI_Page->_setSelect("count(a.CustomerId) as tot");
	$this->EUI_Page->_setFrom("t_gn_customer a");
	$this->EUI_Page->_setJoin("t_gn_assignment b ","a.CustomerId=b.CustomerId", "INNER");
	$this->EUI_Page->_setJoin("t_lk_gender e ","a.GenderId=e.GenderId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_campaign d "," a.CampaignId=d.CampaignId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_ver_result g "," a.CustomerId=g.cust_id", "LEFT");
	#$this->EUI_Page->_setJoin("t_lk_callreason f "," a.CallReasonId = f.CallReasonId", "LEFT", TRUE);
	$this->EUI_Page->_setJoin("t_lk_callreason f "," a.CallReasonId = f.CallReasonId", "LEFT");
	
	// defualt filter where pager on decicision 
	// longer data 

	$this->EUI_Page->_setWhere(sprintf("a.flag_abandon=%d", 0),false);
	$this->EUI_Page->_setAnd("d.OutboundGoalsId", 2, TRUE);
	// $this->EUI_Page->_setAnd("b.AssignBlock", 0, TRUE);
	$this->EUI_Page->_setAnd("d.CampaignStatusFlag", 1, TRUE);
	$this->EUI_Page->_setAnd("(g.ver_result <> 2 or g.ver_result is null)", FALSE);
	$this->EUI_Page->_setAnd("a.expired_date >= '{$condExpired}'" , FALSE);
	$this->EUI_Page->_setAnd( sprintf("( a.CallReasonId IN(%s) OR a.CallReasonId IS NULL )", $out->intvalue('default_cookies_status')));
	
	// $this->EUI_Page->_setAnd("f.CallReasonEvent<>1", False);
	// $this->EUI_Page->_setAnd("a.CampaignId !=13", False);
	
	if(!is_null($this->Row_Lock)) {
		$this->setWhereLock();
 	}

	// filter data object dengan attribute yang 
	// baru lebih mudah di gunakan dan simple 
	
	// USER_ADMIN   OR ROOT 
	if( in_array( $cok->field('HandlingType'),  array(USER_ROOT, USER_ADMIN) )) {
		$this->EUI_Page->_setWhereIn("b.AssignAdmin", $cfg->field('default_admin'), true );	
	}
	
	// USER_AGENT_OUTBOUND 	
	if( in_array($cok->field('HandlingType'),  array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND) )) {
		$this->EUI_Page->_setAnd("b.AssignSelerId", _get_session('UserId'));	
	}
	
	// USER_SUPERVISOR	
	if( in_array($cok->field('HandlingType'),  array(USER_SUPERVISOR))) {
		$this->EUI_Page->_setAnd("b.AssignSpv", _get_session('UserId'));
	}
	
	// USER_LEADER	
	if( in_array($cok->field('HandlingType'),  array(USER_LEADER))) {
		$this->EUI_Page->_setAnd("b.AssignLeader", _get_session('UserId'));
	}
	
	// USER_MANAGER 

	if( in_array($cok->field('HandlingType'),  array(USER_MANAGER))) {
		$this->EUI_Page->_setAnd("b.AssignMgr", _get_session('UserId'));
	}
	
	// USER_ACCOUNT_MANAGER
	
	if( in_array($cok->field('HandlingType'),  array(USER_ACCOUNT_MANAGER))) {
		$this->EUI_Page->_setAnd("b.AssignAmgr", _get_session('UserId'));
	}
	
	
	// cache post filter by user browser 
	// set on client js AND PHP 

	$this->EUI_Page->_setWhereinCache("a.CallReasonId", "src_call_reason", true);
	$this->EUI_Page->_setAndCache("a.CampaignId", "src_campaign_name", true);
	$this->EUI_Page->_setAndCache("a.GenderId", "src_gender", true);
	$this->EUI_Page->_setAndCache("b.AssignSelerId", "src_user_agent", true);
	$this->EUI_Page->_setLikeCache("a.CustomerFirstName", "src_cust_name", true);
	$this->EUI_Page->_setLikeCache("a.CustomerNumber", "src_customer_cif", true);
	$this->EUI_Page->_setWhereinCache("a.Recsource", "src_customer_recsource", true);
	$this->EUI_Page->_setAndCache("a.CustomerNumber", "src_customer_number", true);
	$this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs>='". StartDate(_get_post('src_start_date')) ."'", 'src_start_date', true);
	$this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs<='". EndDate(_get_post('src_end_date')) ."'", 'src_end_date', true);
	
	// -------- add filter -----------------
	$this->EUI_Page->_setAndOrCache($this->set_like_group("a.CustomerCity", "LIKE",$out->get_array_value('src_customer_city')), 'src_customer_city', true);
	$this->EUI_Page->_setLikeCache("a.{$out->get_value('src_filter_phone_by')}", 'src_value_phone_by', false);
	#echo $this->EUI_Page->_getCompiler(); die();
	
	
	// -------- return page data -------------------------------------
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
	$out = UR(); $cfg = Config(); $cok = CK();
	
	// -------- call not interest & Thinking & BadLead	
	$out->add('default_cookies_status', array_keys(CallResultNotInterestBadlead()));
	
	$this->getWhereLock();
	// ---------- customize filter ------------------------
	
	//$arr_user_level =& self::UserLevelId();
	//debug(Config());

	$this->EUI_Page->_postPage(_get_post('v_page') );
	$this->EUI_Page->_setPage(10);

	$condition = "IF(f.CallReasonDesc is null,'New',f.CallReasonDesc) as CallResult"; // mysql
	$condExpired = " DATE(NOW()) ";

	if ( QUERY == 'mssql') {
		$condition = "CASE WHEN f.CallReasonDesc IS NULL THEN 'New' ELSE f.CallReasonDesc END AS CallResult";
		$condExpired = date('Y-m-d');
	}

	if (in_array(_get_session('HandlingType'), array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND) )) {
		$this->EUI_Page->_setArraySelect(array(
			"a.CustomerId as CustomerId" => array("CustomerId","CustomerId","primary"),
			"d.CampaignName as CampaignName" => array("CampaignName","Campaign Name"),
			//"a.Recsource as Recsource" => array("Recsource", "Recsource"),
			"a.CustomerFirstName as CustomerName" => array("CustomerName","Customer Name"),
			// "a.CustomerCity as CustomerCity" => array("CustomerCity", "City"),
			// "a.CustomerDOB as CustomerDOB" => array("CustomerDOB", "DOB"),
			"a.CustomerDOB as CustomerAge" => array("CustomerAge", "Age"),
			"( select gd.GenderIndo from t_lk_gender gd where gd.GenderId=a.GenderId) as Gender" => array("Gender", "Gender"),
			"( select ag.init_name from tms_agent ag where ag.UserId = b.AssignSelerId ) as UserId" => array("UserId", "Agent ID"),
			"(select ag.init_name from tms_agent ag where ag.UserId = b.AssignSpv) as Supervisor" => array("Supervisor", "Supervisor"),
			"(select ag.init_name from tms_agent ag where ag.UserId = a.UpdatedById) as UpdatedById" => array("UpdatedById", "Updated By Agent"),
			
			"{$condition}" => array("CallResult", "Call Result"),
			"(select TOP 1 frm.CallHistoryNotes from t_gn_callhistory frm where frm.CustomerId=a.CustomerId ORDER BY frm.CallHistoryId DESC) as Remarks" => array("Remarks", "Remarks"),
			
			"b.AssignDate as AssignDate" => array("AssignDate","Assign Date"),
			"a.expired_date as ExpireDate" => array("ExpireDate","Expired Date"),
			"a.CustomerUpdatedTs as CustomerUpdatedTs" => array("CustomerUpdatedTs", "Call Date"),
			"(SELECT TOP 1 ApoinmentDate FROM t_gn_appoinment cu WHERE cu.CustomerId=a.CustomerId ORDER BY AppoinmentId DESC) as ApoinmentDate" => array("ApoinmentDate", "ApoinmentDate")
		));
	} else {
		$this->EUI_Page->_setArraySelect(array(
			"a.CustomerId as CustomerId" => array("CustomerId","CustomerId","primary"),
			"d.CampaignName as CampaignName" => array("CampaignName","Campaign Name"),
			"a.Recsource as Recsource" => array("Recsource", "Recsource"),
			"a.CustomerFirstName as CustomerName" => array("CustomerName","Customer Name"),
			// "a.CustomerCity as CustomerCity" => array("CustomerCity", "City"),
			// "a.CustomerDOB as CustomerDOB" => array("CustomerDOB", "DOB"),
			"a.CustomerDOB as CustomerAge" => array("CustomerAge", "Age"),
			"( select gd.GenderIndo from t_lk_gender gd where gd.GenderId=a.GenderId) as Gender" => array("Gender", "Gender"),
			"( select ag.init_name from tms_agent ag where ag.UserId = b.AssignSelerId ) as UserId" => array("UserId", "Agent ID"),
			"(select ag.init_name from tms_agent ag where ag.UserId = b.AssignSpv) as Supervisor" => array("Supervisor", "Supervisor"),
			"(select ag.init_name from tms_agent ag where ag.UserId = a.UpdatedById) as UpdatedById" => array("UpdatedById", "Updated By Agent"),
			
			"{$condition}" => array("CallResult", "Call Result"),
			"(select TOP 1 frm.CallHistoryNotes from t_gn_callhistory frm where frm.CustomerId=a.CustomerId ORDER BY frm.CallHistoryId DESC) as Remarks" => array("Remarks", "Remarks"),
			
			"b.AssignDate as AssignDate" => array("AssignDate","Assign Date"),
			"a.expired_date as ExpireDate" => array("ExpireDate","Expired Date"),
			"a.CustomerUpdatedTs as CustomerUpdatedTs" => array("CustomerUpdatedTs", "Call Date"),
			"(SELECT TOP 1 ApoinmentDate FROM t_gn_appoinment cu WHERE cu.CustomerId=a.CustomerId ORDER BY AppoinmentId DESC) as ApoinmentDate" => array("ApoinmentDate", "ApoinmentDate")
		));
	}
	
	

	
	$this->EUI_Page->_setFrom("t_gn_customer a");
	$this->EUI_Page->_setJoin("t_gn_assignment b ","a.CustomerId=b.CustomerId", "INNER");
	$this->EUI_Page->_setJoin("t_gn_campaign d "," a.CampaignId=d.CampaignId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_ver_result g "," a.CustomerId=g.cust_id", "LEFT");
	$this->EUI_Page->_setJoin("t_lk_callreason f "," a.CallReasonId = f.CallReasonId", "LEFT");
	
	// default pager filter dataoption
	// tested by uknown.

	$this->EUI_Page->_setWhere(sprintf("a.flag_abandon=%d", 0),false);
	$this->EUI_Page->_setAnd("d.OutboundGoalsId", 2, TRUE);
	// $this->EUI_Page->_setAnd("b.AssignBlock", 0, TRUE);
	$this->EUI_Page->_setAnd("d.CampaignStatusFlag", 1, TRUE);
	$this->EUI_Page->_setAnd("(g.ver_result <> 2 or g.ver_result is null)", FALSE);
	$this->EUI_Page->_setAnd("a.expired_date >= '{$condExpired}'" , FALSE);
	$this->EUI_Page->_setAnd( sprintf("( a.CallReasonId IN(%s) OR a.CallReasonId IS NULL )", $out->intvalue('default_cookies_status')));
	
	// $this->EUI_Page->_setAnd("f.CallReasonEvent<>1", False);
	// $this->EUI_Page->_setAnd("a.CampaignId !=13", False);
	
	if(!is_null($this->Row_Lock)) {
		$this->setWhereLock();
	}
	
	// ------------------- session filter  --------------------------------------------------------------
	if( in_array(_get_session('HandlingType'), 
		array(USER_ROOT, USER_ADMIN) )) {
		$this->EUI_Page->_setWhereIn("b.AssignAdmin", $cfg->field( 'default_admin' ), true );	
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
	
	/* if( in_array(_get_session('HandlingType'), 
		array(USER_ADMIN))) {
		$this->EUI_Page->_setAnd("b.AssignMgr", _get_session('UserId'));
	} */
	
	// ------------------- post filter  --------------------------------------------------------------	
	$this->EUI_Page->_setWhereinCache("a.CallReasonId", "src_call_reason", true);
	$this->EUI_Page->_setAndCache("a.CampaignId", "src_campaign_name", true);
	$this->EUI_Page->_setAndCache("a.GenderId", "src_gender", true);
	$this->EUI_Page->_setAndCache("b.AssignSelerId", "src_user_agent", true);
	$this->EUI_Page->_setLikeCache("a.CustomerNumber", "src_customer_cif", true);
	$this->EUI_Page->_setAndCache("a.CustomerNumber", "src_customer_number", true);
	$this->EUI_Page->_setLikeCache("a.CustomerFirstName", "src_cust_name", true);
	//$this->EUI_Page->_setWhereinCache("a.Recsource", "src_customer_recsource", true);
	$this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs>='". StartDate(_get_post('src_start_date')) ."'", 'src_start_date', true);
	$this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs<='". EndDate(_get_post('src_end_date')) ."'", 'src_end_date', true);
	
	// ------------- add filter ------------------------------------------------------------
	$this->EUI_Page->_setAndOrCache($this->set_like_group( "a.CustomerCity", "LIKE",$out->get_array_value('src_customer_city')), 'src_customer_city', true);
	$this->EUI_Page->_setAndOrCache($this->set_like_group( "a.Recsource", "LIKE",$out->get_array_value('src_customer_recsource')), 'src_customer_recsource', true);
	// $this->EUI_Page->_setAndOrCache($this->set_like_group( "a.".$out->get_array_value('dis_field_value1'), $out->get_array_value('dis_field_filter1'),$out->get_array_value('dis_field_text1')), 'dis_field_text1', true);
	$this->EUI_Page->_setLikeCache("a.{$out->get_value('src_filter_phone_by')}", 'src_value_phone_by', false);
	
	// -----------if have order sorted ---------------------------------
 	// $this->EUI_Page->_setOrderCache($out, true); // this will keep order by
 	// $this->EUI_Page->_setOrderBy("a.CustomerId", "ASC");
 	if(_get_have_post('order_by')) {
	    $this->EUI_Page->_setOrderBy(_get_post('order_by'),_get_post('type'));
  	} else {
	  #$this->EUI_Page->_setOrderBy("a.CustomerId", "ASC");
	  #$this->EUI_Page->_setOrderBy("a.CallReasonId", "ASC");
		$this->EUI_Page->_setOrderBy("a.CallReasonId, a.CustomerUpdatedTs", "ASC");
  	}

 	// echo $this->EUI_Page->_getCompiler(); 
 	
 	// -----------then limit on here ---------------------------------
	$this->EUI_Page->_setLimit();
	if( in_array(_get_session('HandlingType'), array(USER_ROOT, USER_ADMIN) )) {
	}

	 
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function _get_resource()
 {
	self::_get_content();
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
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
 
function _select_result_data(){
	return $this->EUI_Page->_get_query();
} 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function _get_auto_caller_data() 
{
	$out = UR(); $cfg = Config(); $cok = CK();
	// maping untuk order yang menggunakan 
	// alias field join .
	$result_data = array();	
	
	// get where locked i dont know what it is ? 
   $this->getWhereLock();
   
	// on interest data process like this, 
	$out->add('default_cookies_status', array_keys(CallResultNotInterestBadlead()));
	#$out->add('default_cookies_status', array_keys( callStatusAutoDial() ));
	
	// this resource of query new data Process 	
	// "( select gd.GenderIndo from t_lk_gender gd where gd.GenderId=a.GenderId) as Gender" => array("Gender", "Gender"),
		// "( select ag.init_name from tms_agent ag where ag.UserId = b.AssignSelerId ) as UserId" => array("UserId", "Agent ID"),
		// "(select ag.init_name from tms_agent ag where ag.UserId = b.AssignSpv) as Supervisor" => array("Supervisor", "Supervisor"),
		// "(select ag.init_name from tms_agent ag where ag.UserId = a.UpdatedById) as UpdatedById" => array("UpdatedById", "Updated By Agent"),
		
	$this->EUI_Page->_setSelect("
		a.CustomerId as CustomerId, 
		a.CallReasonId as CallReasonId, 
		a.CustomerHomePhoneNum as CustomerHomePhoneNum,  
		a.CustomerMobilePhoneNum as CustomerMobilePhoneNum, 
		a.CustomerWorkPhoneNum as CustomerWorkPhoneNum,
		a.Recsource as Recsource,
		a.CustomerFirstName as CustomerName,
		a.CustomerDOB as CustomerAge,
		(select gd.GenderIndo from t_lk_gender gd where gd.GenderId=a.GenderId) as Gender,
		(select ag.init_name from tms_agent ag where ag.UserId = b.AssignSelerId ) as UserId,
		(select ag.init_name from tms_agent ag where ag.UserId = b.AssignSpv) as Supervisor,
		(select ag.init_name from tms_agent ag where ag.UserId = a.UpdatedById) as UpdatedById,
		CASE WHEN (f.CallReasonDesc IS NULL) THEN 'New' ELSE f.CallReasonDesc END AS CallResult, 
		/*IF(f.CallReasonDesc IS NULL,'New',f.CallReasonDesc) as CallResult,*/
		b.AssignDate as AssignDate,
		a.expired_date as ExpireDate,
		a.CustomerUpdatedTs as CustomerUpdatedTs", 
	false );
		
	$this->EUI_Page->_setFrom("t_gn_customer a");
	$this->EUI_Page->_setJoin("t_gn_assignment b ","a.CustomerId=b.CustomerId", "INNER");
	$this->EUI_Page->_setJoin("t_gn_campaign d "," a.CampaignId=d.CampaignId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_ver_result g "," a.CustomerId=g.cust_id", "LEFT");
	$this->EUI_Page->_setJoin("t_lk_callreason f "," a.CallReasonId = f.CallReasonId", "LEFT", TRUE);

 	//  defualt filter ------------------------	
    $this->EUI_Page->_setAnd(sprintf("a.flag_abandon=%d", 0),false);
	$this->EUI_Page->_setAnd("d.OutboundGoalsId", 2, TRUE);
	// $this->EUI_Page->_setAnd("a.CallReasonId", 1, TRUE);
	// $this->EUI_Page->_setAnd("b.AssignBlock", 0, TRUE);
	$this->EUI_Page->_setAnd("d.CampaignStatusFlag", 1, TRUE);
	$this->EUI_Page->_setAnd("(g.ver_result <> 2 or g.ver_result is null)", FALSE);
	$this->EUI_Page->_setAnd("a.expired_date >= '".date('Y-m-d')."'");
	$this->EUI_Page->_setAnd( sprintf("( a.CallReasonId IN(%s) OR a.CallReasonId IS NULL )", $out->intvalue('default_cookies_status')));
	
 	// setWhereLock 	
	if(!is_null($this->Row_Lock)) {
		 $this->setWhereLock();	
	}
	
 	// USER_ROOT && USER_ADMIN
	if( in_array($cok->field('HandlingType'),  array(USER_ROOT, USER_ADMIN) )) {
		$this->EUI_Page->_setWhereIn("b.AssignAdmin", $cfg->field( 'default_admin' ), true );	
	}
	
	// USER_AGENT_OUTBOUND && USER_AGENT_INBOUND	
	if( in_array($cok->field('HandlingType'),  array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND) )) {
		$this->EUI_Page->_setAnd("b.AssignSelerId", $cok->field('UserId'));	
	}
	
 	// USER_SUPERVISOR 
	if( in_array($cok->field('HandlingType'),  array(USER_SUPERVISOR))) {
		$this->EUI_Page->_setAnd("b.AssignSpv", $cok->field('UserId'));
	}
	
 	// USER_LEADER 	
	if( in_array($cok->field('HandlingType'), 
		array(USER_LEADER))) {
		$this->EUI_Page->_setAnd("b.AssignLeader", $cok->field('UserId'));
	}
		
	// USER_MANAGER 
	if( in_array($cok->field('HandlingType'), array(USER_MANAGER))) {
		$this->EUI_Page->_setAnd("b.AssignMgr", $cok->field('UserId'));
	}
	
	// USER_ACCOUNT_MANAGER 
	if( in_array($cok->field('HandlingType'), array(USER_ACCOUNT_MANAGER))) {
		$this->EUI_Page->_setAnd("b.AssignAmgr", $cok->field('UserId'));
	}
	
	// ------------------- post filter  --------------------------------------------------------------	
	$this->EUI_Page->_setWhereinCache("a.CallReasonId", "src_call_reason", true);
	$this->EUI_Page->_setAndCache("a.CampaignId", "src_campaign_name", true);
	$this->EUI_Page->_setAndCache("a.GenderId", "src_gender", true);
	$this->EUI_Page->_setAndCache("b.AssignSelerId", "src_user_agent", true);
	$this->EUI_Page->_setLikeCache("a.CustomerNumber", "src_customer_cif", true);
	$this->EUI_Page->_setAndCache("a.CustomerNumber", "src_customer_number", true);
	$this->EUI_Page->_setLikeCache("a.CustomerFirstName", "src_cust_name", true);
	$this->EUI_Page->_setWhereinCache("a.Recsource", "src_customer_recsource", true);
	$this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs>='". StartDate(_get_post('src_start_date')) ."'", 'src_start_date', true);
	$this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs<='". EndDate(_get_post('src_end_date')) ."'", 'src_end_date', true);
	
 	//  add filter  customize by user .
	$this->EUI_Page->_setAndOrCache($this->set_like_group( "a.CustomerCity", "LIKE",$out->get_array_value('src_customer_city')), 'src_customer_city', true);
	$this->EUI_Page->_setLikeCache("a.{$out->field('src_filter_phone_by')}", 'src_value_phone_by', false);
	
	
 	// get order from session data user customize . 
 	// ini adalah order dengan methode ambil dari session 
 	// tanpa menggunakan "Database ".
	$this->ord = $this->EUI_Page->_select_cache_field_order();
	if( $this->ord->find_value('order_field') ) {
		$this->EUI_Page->_setOrderBy( $this->ord->field('order_field'), 
									  $this->ord->field('order_type'));
	} else {
		#$this->EUI_Page->_setOrderBy("a.CallReasonId","ASC");
		$this->EUI_Page->_setOrderBy("a.CallReasonId, a.CustomerUpdatedTs", "ASC");
	}
	
 	// ini yang aslinya order by  -nya di tanam untuk menghindari pengulangan 
 	// automatic dial data .
 	//$this->EUI_Page->_setOrderBy("a.CustomerUpdatedTs", "ASC");
 	// on cache data query Process on here like this ,
	$sql = $this->_select_result_data(); 
 	$qry = $this->db->query($sql);
 	#var_dump( $this->db->last_query() ); die();
	
 	// get on recsource data query process 
	$rs = 0; 
	if(  $qry && $qry->num_rows() > 0 ) 
		foreach( $qry->result_record() as $row )  {
		$result_data[$rs]['CustomerId'] = $row->field('CustomerId');
		$result_data[$rs]['CallReasonId'] = $row->field('CallReasonId'); 
		
		// merger data telpon 
		$result_merger = array();
		$result_merger[$row->field('CustomerMobilePhoneNum')] = $row->field('CustomerMobilePhoneNum');
		$result_merger[$row->field('CustomerWorkPhoneNum')]   = $row->field('CustomerWorkPhoneNum');
		$result_merger[$row->field('CustomerHomePhoneNum')]   = $row->field('CustomerHomePhoneNum');
		
		foreach( $result_merger as $key => $CallerId ){	
			if( !is_null($CallerId) ){
				$result_data[$rs]['CallPersentation'][] = $CallerId;
			}
		}
		$rs++;		
	}	 
	return (array)$result_data;
	
}
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  
function _get_data_dial()
{
	$_phone = array(
		1 => 'CustomerMobilePhoneNum',
		2 => 'CustomerHomePhoneNum',
		3 => 'CustomerWorkPhoneNum',
	);
	
	$autokey = md5(_get_session('UserId').date('YmdHis'));
	$conds = array('total'=>0,'key'=>$autokey);
	
	$this->getWhereLock();
	
	$out = new EUI_Object(_get_all_request()); 
	// $arr_call_not_interest = array_keys(CallResultAuto());
	$arr_call_not_interest = array_keys(CallResultNotInterestBadlead());
	
	$arr_user_level =& self::UserLevelId();
	
	$this->EUI_Page->_setSelect("
		a.CustomerId, 
		a.CallReasonId, 
		a.CustomerHomePhoneNum, 
		a.CustomerMobilePhoneNum, 
		a.CustomerWorkPhoneNum
	");
	
	$this->EUI_Page->_setFrom("t_gn_customer a");
	$this->EUI_Page->_setJoin("t_gn_assignment b ","a.CustomerId=b.CustomerId", "INNER");
	$this->EUI_Page->_setJoin("t_gn_campaign d "," a.CampaignId=d.CampaignId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_ver_result g "," a.CustomerId=g.cust_id", "LEFT");
	$this->EUI_Page->_setJoin("t_lk_callreason f "," a.CallReasonId = f.CallReasonId", "LEFT", TRUE);
// ------------------------- defualt filter ------------------------	

	$this->EUI_Page->_setAnd("d.OutboundGoalsId", 2, TRUE);
	$this->EUI_Page->_setAnd("b.AssignBlock", 0, TRUE);
	$this->EUI_Page->_setAnd("d.CampaignStatusFlag", 1, TRUE);
	$this->EUI_Page->_setAnd("(g.ver_result <> 2 or g.ver_result is null)", FALSE);
	$this->EUI_Page->_setAnd("a.expired_date >= date(now())" , FALSE);
	$this->EUI_Page->_setAnd("( a.CallReasonId IN('". implode( "','", $arr_call_not_interest ) ."') OR a.CallReasonId IS NULL )");
	// $this->EUI_Page->_setAnd("( a.CallReasonId IN('". implode( "','", $arr_call_not_interest ) ."') OR a.CallReasonId IS NULL )");
	if(!is_null($this->Row_Lock))
	{
		 $this->setWhereLock();	
	}
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
	
// ------------------- post filter  --------------------------------------------------------------	
	$this->EUI_Page->_setWhereinCache("a.CallReasonId", "src_call_reason", true);
	$this->EUI_Page->_setAndCache("a.CampaignId", "src_campaign_name", true);
	$this->EUI_Page->_setAndCache("a.GenderId", "src_gender", true);
	$this->EUI_Page->_setAndCache("b.AssignSelerId", "src_user_agent", true);
	$this->EUI_Page->_setLikeCache("a.CustomerNumber", "src_customer_cif", true);
	$this->EUI_Page->_setAndCache("a.CustomerNumber", "src_customer_number", true);
	$this->EUI_Page->_setLikeCache("a.CustomerFirstName", "src_cust_name", true);
	$this->EUI_Page->_setWhereinCache("a.Recsource", "src_customer_recsource", true);
	$this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs>='". StartDate(_get_post('src_start_date')) ."'", 'src_start_date', true);
	$this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs<='". EndDate(_get_post('src_end_date')) ."'", 'src_end_date', true);
	
// ------------- add filter ------------------------------------------------------------
	
	$this->EUI_Page->_setAndOrCache($this->set_like_group( "a.CustomerCity", "LIKE",$out->get_array_value('src_customer_city')), 'src_customer_city', true);
	$this->EUI_Page->_setLikeCache("a.{$out->get_value('src_filter_phone_by')}", 'src_value_phone_by', false);
	$this->EUI_Page->_setOrderBy("a.CustomerUpdatedTs", "DESC");

// -----------then limit on here ---------------------------------
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		$qry = $this -> EUI_Page -> _result();
		
		if($qry->num_rows()>0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				foreach($_phone as $key=>$val)
				{
					if($rows[$val]!='')
					{
						$this->db->insert('t_gn_autodial',array(
							'AutoDialKey' => $autokey,
							'CustomerId'  => $rows['CustomerId'],
							'AutoDialNum' => $rows[$val],
							'CreateBy' 	  => _get_session('UserId'),
						));
						
						if($this->db->affected_rows()>0)
						{
							$conds['total']++;
						}
					}
				}
			}
		}
	}
	
	return $conds;
}
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
function _getGenderId()
{
	$_conds = array();
  	$sql = " SELECT a.GenderId, a.Gender FROM  t_lk_gender a";
  	$qry = $this -> db -> query($sql);
  	#var_dump( $this->db->last_query() );die();
  	// if( !$qry -> EOF() )
  	if( $qry->num_rows() > 0 )
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
  	#var_dump( $this->db->last_query() );die();

  	// if( !$qry -> EOF() )
  	if( $qry->num_rows() > 0 )
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


 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  public function _getDetailCustomer($CustomerId=null)
{
 // default query by sprintf function on perl.
  $this->row = array();
  $this->sql = sprintf("SELECT a.*, b.Gender, c.Salutation, d.CampaignName, d.CampaignNumber, e.CallReasonDesc, e.CallReasonCategoryId,
							f.TableDetail, f.ViewVerification, f.ViewProductInfo, f.ViewCdd
					FROM t_gn_customer a
					LEFT JOIN t_lk_gender b ON a.GenderId=b.GenderId
					LEFT JOIN t_lk_salutation c ON a.SalutationId=c.SalutationId
					LEFT JOIN t_gn_campaign d ON a.CampaignId=d.CampaignId
					LEFT JOIN t_gn_campaign_ref f ON a.CampaignId=f.CampaignId
					LEFT JOIN t_lk_callreason e ON a.CallReasonId=e.CallReasonId
					WHERE a.CustomerId = '%s'", $CustomerId );
	// echo $this->sql;
	$qry = $this->db->query( $this->sql );
	#var_dump( $this->db->last_query() ); die();

	if( $qry && $qry->num_rows() > 0 ) {
		$this->row = $qry->result_first_assoc();
		
	}
	return (array)$this->row;
	
 }

 public function _getDetailAttr($table, $CustomerId=null)
{
 // default query by sprintf function on perl.
  $this->row = array();
  $this->sql = sprintf("SELECT *
					FROM ".$table." a
					WHERE a.CustomerId = '%s'", $CustomerId );
	// echo $this->sql;
	$qry = $this->db->query( $this->sql );
	if( $qry && $qry->num_rows() > 0 ) {
		$this->row = $qry->result_first_assoc();
		
	}
	return (array)$this->row;
	
 }


 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public function _getDetailCustomerJson( $CustomerId=null)
 {
	$_conds = array();
	$this -> db -> reset_select();
	$this -> db -> select('
		a.CustomerNumber , 
		a.CustomerId, 
		a.CustomerFirstName , 
		a.CardTypeId , 
		a.CustomerAddressLine1, 
		a.CustomerDOB , 
		a.CustomerAddressLine2 , 
		a.CustomerAddressLine3 , 
		a.CustomerCity , 
		a.CustomerZipCode , 

		b.Gender, 
		c.Salutation, 
		d.CampaignName, 
		d.CampaignNumber, 
		e.CallReasonDesc, 
		e.CallReasonCategoryId, 
		f.TableDetail, 
		f.ViewVerification, 
		f.ViewProductInfo ', FALSE);
	$this -> db -> from('t_gn_customer a');
	$this -> db -> join('t_lk_gender b','a.GenderId=b.GenderId','LEFT');
	$this -> db -> join('t_lk_salutation c','a.SalutationId=c.SalutationId','LEFT');
	$this -> db -> join('t_gn_campaign d','a.CampaignId=d.CampaignId','LEFT');
	$this -> db -> join('t_gn_campaign_ref f','a.CampaignId=f.CampaignId','LEFT');
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
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
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
		'CustomerHomePhoneNum' => array('HomePhone', $this->Event), 
		'CustomerMobilePhoneNum' => array('MobilePhone',$this->Event), 
		'CustomerWorkPhoneNum' => array('OfficePhone', $this->Event),
		'CustomerWorkFaxNum' => array('Off. Fax', $this->Event),
		'CustomerWorkExtPhoneNum' => array('Ext', $this->Event),
		'CustomerFaxNum' => array('Fax',$this->Event)
	);	
	
	
	$this->db->reset_select();
	$this->db->select(array_keys($arr_map_phone), FALSE);
	$this->db->from('t_gn_customer');
	$this->db->where('CustomerId',$CustomerId);
	
	$rs = $this->db->get();
	#var_dump($this->db->last_query());die();
	if( $rs->num_rows() > 0 ) 
		foreach($rs-> result_assoc() as $rows )
	{
		#var_dump($rows);die();
	   	if( is_array($rows) ) 
			foreach( $rows as $field => $val )  {
				#var_dump('as',$field);
				if( !is_null($val) AND strlen($val) > 0)  {
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
	#var_dump($arr_select_contact);die();
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

 	// var_dump( $this->db->last_query() );die();
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
 
 $this->db->where("CustomerId", $out->get_value('CustomerId'));
 $this->db->where("Flag_Followup",1);
 
 $this->db->set("UpdatedById",_get_session('UserId'));
 $this->db->set("Flag_Followup",0);
 $this->db->update("t_gn_customer");
 
// --------------- ok -------------------------------- 

 if( $this->db->affected_rows() > 0 ){
	return TRUE;	
 }	else {
	return FALSE;
 } 
 
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
private function getWhereLock()
{
    $this->Row_Lock = $this->M_MgtLockCustomer->getLockWhere();
}
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
private function setWhereLock()
{
    foreach ($this->Row_Lock as $row => $cols) 
    {
        if(in_array($cols['param_to_format'], array('array')))
        {
            $this->EUI_Page->$cols['query_method']("a.".$cols['lock_column'],explode(",",$cols['lock_parameter']));
        }
        else if( in_array( $cols['param_to_format'], array('string') ) )
        {
            $this->EUI_Page->$cols['query_method']("a.".$cols['lock_column'],$cols['lock_parameter']);
        }
    }
}

 public function _getDetailSecondProduct($CustomerId=null){
	// default query by sprintf function on perl.
	$this->row = array();
	$date_now = date('Y-m-d');

	$this->sql = sprintf("SELECT ctm.*, b.Gender, c.Salutation, d.CampaignName, d.CampaignNumber, e.CallReasonDesc, e.CallReasonCategoryId,
							f.TableDetail, f.ViewVerification, f.ViewProductInfo, f.ViewCdd
					FROM t_gn_customer a
					
					INNER JOIN t_gn_attr_pil_xsell xsel ON a.CustomerId = xsel.CustomerId
					INNER JOIN t_gn_attr_flexi flex ON (xsel.Custno1 = flex.Custno AND xsel.prog_code = flex.prog_code AND xsel.Data_Month = flex.Data_Month)
					INNER JOIN t_gn_customer ctm ON ctm.CustomerId = flex.CustomerId
					
					LEFT JOIN t_lk_gender b ON ctm.GenderId=b.GenderId
					LEFT JOIN t_lk_salutation c ON ctm.SalutationId=c.SalutationId
					LEFT JOIN t_gn_campaign d ON ctm.CampaignId=d.CampaignId
					LEFT JOIN t_gn_campaign_ref f ON ctm.CampaignId=f.CampaignId
					LEFT JOIN t_lk_callreason e ON ctm.CallReasonId=e.CallReasonId
				
					WHERE a.CustomerId = '%s'
					
					/*AND a.expired_date >= CONVERT(VARCHAR(10), GETDATE(), 23) 
					AND ctm.expired_date >= CONVERT(VARCHAR(10), GETDATE(), 23)
					AND concat(LEFT(xsel.Data_Month, 4),'-',RIGHT(xsel.Data_Month, 2)) = CONVERT(VARCHAR(7), getdate(), 23)*/
					AND CONVERT(VARCHAR(10), a.expired_date, 23)   >= '{$date_now}'
					AND CONVERT(VARCHAR(10), ctm.expired_date, 23) >= '{$date_now}'
					AND xsel.prog_code = 'C01'", $CustomerId);

	// echo $this->sql;
				// "SELECT a.CustomerFirstName,a.CustomerId, a.CustomerNumber, a.expired_date, b.Custno1, d.CustomerNumber, d.CustomerId, d.expired_date,
				// b.Data_Month, c.Data_Month
				// FROM t_gn_customer a 
				// INNER JOIN t_gn_attr_pil_xsell b ON a.CustomerId = b.CustomerId
				// INNER JOIN t_gn_attr_flexi c ON (b.Custno1 = c.Custno AND b.prog_code = c.prog_code AND b.Data_Month = c.Data_Month)
				// INNER JOIN t_gn_customer d ON c.CustomerId = d.CustomerId
				// WHERE a.CampaignId = 5
				// AND a.expired_date >= GETDATE() AND d.expired_date >= GETDATE()
				// AND concat(LEFT(b.Data_Month, 4),'-',RIGHT(b.Data_Month, 2)) = CONVERT(VARCHAR(7), getdate(), 23)
				// AND b.prog_code = 'C01';"
	$qry = $this->db->query( $this->sql );
	#var_dump( $this->db->last_query() ); die();

	if( $qry && $qry->num_rows() > 0 ) {
		$this->row = $qry->result_first_assoc();
		
	}
	return (array)$this->row;
 }
 
// ======================================= END CLASS ======================================== 

//edit rangga
public function _getVerifStat($CustomerId)
{
	$sql=$this->db->get_where('t_gn_ver_status',array('cust_id'=>$CustomerId,'ver_result'=>1));
	
	#var_dump( $this->db->last_query() ); die();
	$num=$sql->num_rows();
	if($num>0){
		return 1;
	}
	else{
		return 0;
	}
 }

public function _getCddStat($CustomerId)
{
	$sql=$this->db->get_where('t_gn_cdd',array('CustId'=>$CustomerId));
	
	#var_dump( $this->db->last_query() ); die();
	$num=$sql->num_rows();
	if($num>0){
		return 1;
	}
	else{
		return 0;
	}
}

/**
* @BAP
* (F) _cekStatusNoAutoDial
* 
* @param  Object 	$out
* @return Boolean	$result
*/
public function _cekStatusNoAutoDial( $out  = null )
{
	$status_preview = array(1,7,10);
	$result = FALSE;
	if( !$out->fetch_ready() ) {
		return $result;
 	}
 
 	$this->db->reset_select();
 	$this->db->select("a.CustomerId");
 	$this->db->from("t_gn_customer a");
 	$this->db->join("t_lk_callreason b", "a.CallReasonId = b.CallReasonId", "INNER");
 	$this->db->join("t_lk_callreasoncategory c"," b.CallReasonCategoryId = c.CallReasonCategoryId", "INNER");
 	$this->db->where("a.CustomerId", $out->get_value('CustomerId'));
 	$this->db->where_in("c.CallReasonCategoryId", $status_preview);
 	$rs = $this->db->get();

 	#return ( $this->db->last_query() );
  	if( $rs->num_rows() > 0 )
 	{
		$result = TRUE;
 	}	 
 	return $result;
 
}

	
}
// ======================================= END CLASS ======================================== 

?>
