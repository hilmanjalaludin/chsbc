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

/**
 * Flow Assignment 
1. QA akan bagikan data berdasarkan closing anaknya
	- Parameter
		-> spv_id
		-> Agree
	- _getDataByChecked
	- 
2. List Score 
	- List Score akan muncul di SPV jika datanya sudah dibagikan ke SPV
		-> Berdasarkan QualityAssignment , t_gn_quality_assignment di SPV_id
		-> Berikan Informasi Nama Agent dan Status Closing , Product Apa yang di tawarkan
	- M_QtyScoring Content and Default 
		- Table yang bersangkutan
			-> t_gn_quality_assignment , berdasarkan spv_id
			-> t_gn_customer
			-> t_gn_score_acurate
			-> cc_recording
			-> t_gn_product
			-> t_lk_call_reason
			-> t_gn_campaign
 */
 
class M_QtyScoring extends EUI_Model
{
	
var $set_limit_page  = 10;	

// --------------------------------------------------------------

  private static $Instance   = null; 
  public static function &Instance()
 {
	if( is_null(self::$Instance) ){
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
 
 public function M_QtyScoring()
 {
	$this -> load -> model(array(
		'M_ModOutBoundGoal', 'M_Combo','M_SrcCustomerList', 'M_SetProduct', 'M_SetResultCategory',
		'M_ModSaveActivity', 'M_Payers','M_Benefiecery','M_Insured','M_QtyPoint','M_Pbx','M_SetResultQuality'));
 }
 
 
 
/*
 * @ def 		: _getEventSale
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

function _getAgentReady()
{
	$AgentId = array();
	$this -> db->select("a.Agent_User_Id ");
	$this -> db->from("t_gn_quality_agent a ");
	$this -> db->where("a.Quality_Staff_Id",$this -> EUI_Session->_get_session('UserId'));
	foreach( $this -> db->get() -> result_assoc()  as $rows )
	{
		$AgentId[$rows['Agent_User_Id']] = $rows['Agent_User_Id'];
	}
	
	return $AgentId;
	
} 

function _getTelemarketer()
{
	$AgentId = array();
	$this -> db->select("a.UserId,a.init_name ");
	$this -> db->from("tms_agent a ");
	$this -> db->where("a.profile_id", USER_AGENT_OUTBOUND );
	foreach( $this -> db->get() -> result_assoc()  as $rows )
	{
		$AgentId[$rows['UserId']] = $rows['init_name'];
	}
	
	return $AgentId;
	
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

public function _getAgentByQualityStaff()
{
	$_list_agents = false;
	
	if( $this -> EUI_Session->_have_get_session('UserId') )
	{
		$this -> db -> select("b.UserId");
		$this -> db -> from("t_gn_quality_agent a");
		$this -> db -> join("tms_agent b","a.Agent_User_Id=b.UserId","LEFT");
		$this -> db -> where("a.Quality_Staff_Id", $this -> EUI_Session->_get_session('UserId') );
		foreach( $this -> db ->get() -> result_assoc() as $rows )
		{
			$_list_agents[$rows['UserId']] = $rows['UserId'];
		}	
	}
	
	return $_list_agents;
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
	/* get instance class outbound **/	
	$conds1 = " a.AssignId , h.StatusAccurate , if(i.CustomerId is not null , 'Yes' , 'No') as StatusScoring "; 
	$conds2 = " AND e.CallReasonId in(".CUSTOMER_LIST_AGENT.")"; 

	// mode mssql 
	if( QUERY == 'mssql') {
		$conds1 = " DISTINCT b.CustomerId, h.StatusAccurate, CASE WHEN i.CustomerId IS NOT NULL THEN 'Yes' ELSE 'No' END AS StatusScoring ";
		$conds2 = " e.CallReasonId in(".CUSTOMER_LIST_AGENT.")"; 
	}

	$CallDirection =& M_ModOutBoundGoal::get_instance();
	$this->EUI_Page->_setPage($this->set_limit_page);
	$this->EUI_Page->_setSelect("{$conds1}",FALSE);
	$this->EUI_Page->_setFrom("t_gn_assignment a ");
	$this->EUI_Page->_setJoin("t_gn_customer b ","a.CustomerId=b.CustomerId","INNER");
	$this->EUI_Page->_setJoin("tms_agent c ","b.SellerId=c.UserId","INNER");
	$this->EUI_Page->_setJoin("tms_agent d ","c.spv_id=d.UserId","LEFT");
	$this->EUI_Page->_setJoin("t_lk_callreason e ","b.CallReasonId=e.CallReasonId","LEFT");
	$this->EUI_Page->_setJoin("t_gn_campaign f ","b.CampaignId=f.CampaignId","INNER");
	$this->EUI_Page->_setJoin("t_gn_quality_assignment g ","g.Assign_Data_Id=b.CustomerId","LEFT");
	$this->EUI_Page->_setJoin("t_gn_score_accurated h ","h.CustomerId=b.CustomerId","LEFT");
	$this->EUI_Page->_setJoin("t_gn_score_result i ","b.CustomerId=i.CustomerId","LEFT");


	$this->EUI_Page->_setWhere( $conds2, "");
	$this->EUI_Page->_setWhereNotIn("e.CallReasonId" , array("99") );
	/* 	level login quality staff **/

	if( $this -> EUI_Session->_get_session('HandlingType') == USER_SUPERVISOR ){
		$this -> EUI_Page->_setAnd("g.SPV_Id", $this -> EUI_Session->_get_session('UserId') );
	}

	if( _get_have_post("qty_status_scoring") ){
		if (_get_post("qty_status_scoring") == "Yes") {
			$this->EUI_Page->_setQuery(" AND i.CustomerId IS NOT NULL");
			#$this->EUI_Page->_setAnd("i.CustomerId" , "IS NOT NULL");			
		} else if (_get_post("qty_status_scoring") == "No") {
			$this->EUI_Page->_setQuery(" AND i.CustomerId IS NULL");
			#$this->EUI_Page->_setAnd("i.CustomerId" , "IS NULL");			
		}
		#$this->EUI_Page->_setHaving("StatusScoring" ,_get_post("qty_status_scoring"));
    }
	
	//--update 25112016 filter by campaign & agent----------------
	if( _get_have_post("qty_user_id") ){
		$this->EUI_Page->_setAnd("b.SellerId" ,_get_post("qty_user_id"));
    }
	
	if( _get_have_post("qty_campaign_id") ){
		$this->EUI_Page->_setAnd("f.CampaignId" ,_get_post("qty_campaign_id"));
    }
	
	if ( _get_post("qty_start_date") != '' && _get_post("qty_end_date") != '' ) {
		$qty_start_date = _getDateEnglish(_get_post("qty_start_date")) . " 00:00:00";
		$qty_end_date   = _getDateEnglish(_get_post("qty_end_date")) . " 23:59:00";
		
		
		$this->EUI_Page->_setAndOrCache( "b.CustomerUpdatedTs >= '".$qty_start_date."'" , "qty_start_date" , true   );
		$this->EUI_Page->_setAndOrCache( "b.CustomerUpdatedTs <= '".$qty_end_date."'" , "qty_end_date" , true );
		
		
	} else {
		$qty_start_date = date("Y-m-d") . " 00:00:00";
		$qty_end_date   = date("Y-m-d") . " 23:59:00";
		
		if ( _get_session("qty_start_date") != '' AND _get_session("qty_end_date") != "" ) {
			$qty_start_date = _getDateEnglish(_get_session("qty_start_date")) . " 00:00:00";
			$qty_end_date   = _getDateEnglish(_get_session("qty_end_date")) . " 23:59:00";
		} else {
			$qty_start_date = date("Y-m-d") . " 00:00:00";
			$qty_end_date   = date("Y-m-d") . " 23:59:00";
		}
		
		$this->EUI_Page->_setAnd( "b.CustomerUpdatedTs >= '".$qty_start_date."'"   );
		$this->EUI_Page->_setAnd( "b.CustomerUpdatedTs <= '".$qty_end_date."'" );
		
	}
	// echo _get_post("qty_start_date");
		
	// ------------------- filtring by keep session  ---------------------------------------
	$this->EUI_Page->_setAndCache("b.CustomerFirstName", "qty_cust_name", true);
	$this->EUI_Page->_setAndCache("b.ProductId", "qty_category_id", true);
	if (_get_post("qty_status_scoring") == "Yes") {
		$this->EUI_Page->_setQuery(" AND i.CustomerId IS NOT NULL");
		#$this->EUI_Page->_setAnd("i.CustomerId" , "IS NOT NULL");			
	} else if (_get_post("qty_status_scoring") == "No") {
		$this->EUI_Page->_setQuery(" AND i.CustomerId IS NULL");
		#$this->EUI_Page->_setAnd("i.CustomerId" , "IS NULL");			
	}
	$this->EUI_Page->_setHavingCache("StatusScoring", "qty_status_scoring", true);
	$this->EUI_Page->_setAndCache("e.CallReasonId", "qty_call_result", true);

	//--------------------25112016 update filter by campaign & agent-------------------------
	$this->EUI_Page->_setAndCache("f.CampaignId", "qty_campaign_id", true);
	$this->EUI_Page->_setAndCache("a.AssignSelerId", "qty_user_id", true);
	// ------- set group by ------------------------------------------------------------------
	
	if ( _get_session("HandlingType") == USER_SUPERVISOR ) {	
		$this->EUI_Page->_setHaving("h.StatusAccurate='No Accurated' OR h.StatusAccurate IS NULL");
		
		if( QUERY == 'mysql') {
			$this->EUI_Page->_setGroupBy('b.CustomerId');
		}

	} else {
		if( QUERY == 'mysql') {
			$this->EUI_Page->_setGroupBy('b.CustomerId');
		}
	}
	
	#echo $this -> EUI_Page -> _get_query();
	#var_dump($this->EUI_Page->_get_query());die();
	if($this -> EUI_Page -> _get_query())
	{
		return $this -> EUI_Page;
	}
	
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
 
	$this->EUI_Page->_postPage(_get_post('v_page') );
	$this->EUI_Page->_setPage($this->set_limit_page);
	$this->EUI_Page->_setArraySelect(array(
		"b.CustomerId as CustomerId" => array("CustomerId","CustomerId", "primary"),
		"f.CampaignName as CampaignName" => array("CampaignName", "Campaign Name"), 
		//"c.CustomerNumber as CustomerNumber" => array("CustomerNumber", "CIF"),
		"b.CustomerFirstName as CustomerFirstName" => array("CustomerFirstName", "Customer Name"), 
		//"c.CustomerDOB as CustomerDOB" => array("CustomerDOB","DOB"),
		"b.CustomerDOB as CustomerAge" => array("CustomerAge","Age"),
		"c.code_user as AgentId" =>  array("AgentId","Agent ID"),
		"d.code_user as SPVId" =>  array("SPVId","SPV ID"),
		"CASE WHEN i.CustomerId is not null THEN 'Yes' ELSE 'No' END as StatusScoring" =>  array("StatusScoring","Status Scoring"),
		"h.StatusAccurate as StatusAccurate" =>  array("StatusAccurate","Status Accurate"),	
		"e.CallReasonDesc as CallReasonDesc" =>  array("CallReasonDesc","Call Status"),	
		//"i.DateCreateTs as DateCreateTs" =>  array("DateCreateTs","Created Date"),	
		"CASE WHEN i.DateCreateTs is null THEN '00:00:00' ELSE i.DateCreateTs END as DateCreateTs" =>  array("DateCreateTs","Created Date") , 
		"b.CustomerUpdatedTs as SalesDate" =>  array("SalesDate","Sales Date")
		//"'00:00:00' as Duration" => array( "Duration" => "Duration" )
		//"(SELECT SUM(a.duration) as Duration FROM cc_recording a 
			//WHERE a.assignment_data = b.CustomerId
			//GROUP BY a.assignment_data ) As Duration"=> array("Duration","Duration")
	));
	
	$this->EUI_Page->_setFrom("t_gn_assignment a ");
	$this->EUI_Page->_setJoin("t_gn_customer b ","a.CustomerId=b.CustomerId","INNER");
	$this->EUI_Page->_setJoin("tms_agent c ","b.SellerId=c.UserId","INNER");
	$this->EUI_Page->_setJoin("tms_agent d ","c.spv_id=d.UserId","LEFT");
	$this->EUI_Page->_setJoin("t_lk_callreason e ","b.CallReasonId=e.CallReasonId","LEFT");
	$this->EUI_Page->_setJoin("t_gn_campaign f ","b.CampaignId=f.CampaignId","INNER");
	$this->EUI_Page->_setJoin("t_gn_quality_assignment g ","g.Assign_Data_Id=b.CustomerId","LEFT");
	$this->EUI_Page->_setJoin("t_gn_score_accurated h ","h.CustomerId=b.CustomerId","LEFT");
	$this->EUI_Page->_setJoin("t_gn_score_result i ","b.CustomerId=i.CustomerId","LEFT");
	$this->EUI_Page->_setWhere("e.CallReasonId in(".CUSTOMER_LIST_AGENT.")" , "");

	// print_r($this->EUI);

    if( _get_have_post("qty_status_scoring") ){
		//start edit irul
		if (_get_post("qty_status_scoring") == "Yes") {
			$this->EUI_Page->_setQuery(" AND i.CustomerId IS NOT NULL");
			#$this->EUI_Page->_setAnd("i.CustomerId" , "IS NOT NULL");			
		} else if (_get_post("qty_status_scoring") == "No") {
			$this->EUI_Page->_setQuery(" AND i.CustomerId IS NULL");
			#$this->EUI_Page->_setAnd("i.CustomerId" , "IS NULL");			
		}
		//end edit irul
    }
	//--update 25112016 filter by campaign & agent----------------
	if( _get_have_post("qty_user_id") ){
		$this->EUI_Page->_setAnd("b.SellerId" ,_get_post("qty_user_id"));
    }
	
	if( _get_have_post("qty_campaign_id") ){
		$this->EUI_Page->_setAnd("f.CampaignId" ,_get_post("qty_campaign_id"));
    }
	
	// if ( _get_have_post("qty_start_date") && _get_have_post("qty_end_date") ) {
		// $qty_start_date = _getDateEnglish(_get_post("qty_start_date")) . " 00:00:00";
		// $qty_end_date   = _getDateEnglish(_get_post("qty_end_date")) . " 23:59:00";
		// $this->EUI_Page->_setAnd( "b.CustomerUpdatedTs >= '".$qty_start_date."'" );
		// $this->EUI_Page->_setAnd( "b.CustomerUpdatedTs <= '".$qty_end_date."'" );
	// } else {
		// $qty_start_date = date("Y-m-d") . " 00:00:00";
		// $qty_end_date   = date("Y-m-d") . " 23:59:00";
		// $this->EUI_Page->_setAnd( "b.CustomerUpdatedTs >= '".$qty_start_date."'"  );
		// $this->EUI_Page->_setAnd( "b.CustomerUpdatedTs <= '".$qty_end_date."'"  );
	// }
	
	
	
	
	//print_r($_SESSION);
	//------------------------------------------------------------
	$this->EUI_Page->_setWhereNotIn("e.CallReasonId" , array("99") );

	/* 	level login quality staff **/
	if( $this -> EUI_Session->_get_session('HandlingType') == USER_SUPERVISOR ){
		$this -> EUI_Page->_setAnd("g.SPV_Id", $this -> EUI_Session->_get_session('UserId') );
	}
	
	/* filter next data if not empty filter **/
	#$QualityId = array_keys($this->M_SetResultQuality->_getQualityResult());
	
	// --- filtring by keep session 
	$this->EUI_Page->_setAndCache("b.CustomerFirstName", "qty_cust_name", true);
	$this->EUI_Page->_setAndCache("b.CustomerNumber", "qty_cust_number", true);
	$this->EUI_Page->_setAndCache("b.ProductId", "qty_category_id", true);
	$this->EUI_Page->_setAndCache("e.CallReasonId", "qty_call_result", true);
	//start edit irul
	if (_get_post("qty_status_scoring") == "Yes") {
		$this->EUI_Page->_setQuery(" AND i.CustomerId IS NOT NULL");
		#$this->EUI_Page->_setAnd("i.CustomerId" , "IS NOT NULL");			
	} else if (_get_post("qty_status_scoring") == "No") {
		$this->EUI_Page->_setQuery(" AND i.CustomerId IS NULL");
		#$this->EUI_Page->_setAnd("i.CustomerId" , "IS NULL");			
	}
	#$this->EUI_Page->_setAndCache("StatusScoring", "qty_status_scoring", true);
	//end edit irul
	
	if ( _get_post("qty_start_date") != '' && _get_post("qty_end_date") != '' ) {
		$qty_start_date = _getDateEnglish(_get_post("qty_start_date")) . " 00:00:00";
		$qty_end_date   = _getDateEnglish(_get_post("qty_end_date")) . " 23:59:00";
		
		$this->EUI_Page->_setAndOrCache( "b.CustomerUpdatedTs >= '".$qty_start_date."'" , "qty_start_date" , true   );
		$this->EUI_Page->_setAndOrCache( "b.CustomerUpdatedTs <= '".$qty_end_date."'" , "qty_end_date" , true );
	} else {
		$qty_start_date = date("Y-m-d") . " 00:00:00";
		$qty_end_date   = date("Y-m-d") . " 23:59:00";
		
		$this->EUI_Page->_setAnd( "b.CustomerUpdatedTs >= '".$qty_start_date."'"   );
		$this->EUI_Page->_setAnd( "b.CustomerUpdatedTs <= '".$qty_end_date."'" );
	}
	
	// --- update 25112016 filter by campaign & agent-------------------------
	$this->EUI_Page->_setAndCache("f.CampaignId", "qty_campaign_id", true);
	$this->EUI_Page->_setAndCache("a.AssignSelerId", "qty_user_id", true);
	// start edit irul
	// if ( _get_session("HandlingType") == USER_SUPERVISOR ) {	
	// 	$this->EUI_Page->_setHaving("h.StatusAccurate='No Accurated' OR h.StatusAccurate IS NULL");
	// 	$this->EUI_Page->_setGroupBy('b.CustomerId');
	// } else {
	// 	$this->EUI_Page->_setGroupBy('b.CustomerId');
	// } 
	// end edit irul
	// -----------if have order sorted ---------------------------------

    if( _get_have_post("order_by") ){
    	$this->EUI_Page->_setOrderBy(_get_post("order_by"), _get_post("type"));
   	} else {
		$this->EUI_Page->_setOrderBy("a.AssignId", "DESC");
  	}
	 #var_dump(_get_post("qty_status_scoring"));die();
  	#$this -> EUI_Page -> _get_query();
	  #echo $this->EUI_Page->_getCompiler();die();
	  #var_dump($this -> EUI_Page -> _get_query());die();
	   $this->EUI_Page ->_setLimit();
	   

	
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
 
 function _getLastCallHistory($CustomerId)
 {
	$_conds = array();
	
	$this -> db -> select('*');
	$this -> db -> from('t_gn_callhistory');
	$this -> db -> where('CustomerId',$CustomerId);
	
	if( $avail = $this -> db -> get()->result_first_assoc() )
	{
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
	
	$this -> db -> select("*");
	$this -> db -> from("cc_recording a");
	$this -> db -> limit($perpages,$start);
	
	// get query result
	
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
	$this -> db -> select("*");
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
 

 
public function _getQtyCount( $CustomerId = 0 )
{
	$count = 0;
	
	$this->db->select("COUNT(a.Id) as jumlah",FALSE);
	$this->db->from("t_gn_scoring_point a ");
	$this->db->where("a.CustomerId",$CustomerId); 
	
	if( $rows = $this->db->get()->result_first_assoc() ) 
	{
		$count = (INT)$rows['jumlah'];
	}
	
	return $count;
} 



 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
 

 public function _saveQualityValues( $param = null  )
 {
   $InsertId = 0;
   if( is_array($param) ) 
   {
		$this->db->set('CustomerId',$param['CustomerId']);
		$this->db->set('ScoringRemark',strtoupper($param['remarks']));
		$this->db->set('ScroingQualityId',$this -> EUI_Session->_get_session('UserId'));
		$this->db->set('ScoringCreateTs',date('Y-m-d H:i:s'));
		$this->db->insert('t_gn_qa_scoring');
		if( $this->db->affected_rows() > 0 )
			$InsertId = $this -> db->insert_id();
	}	
		
	return $InsertId;
 }
 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)

 "CQ_Rating_Rapport" => $CQ_Rating_Rapport , 
			    "CQ_Rating_Ownership" => $CQ_Rating_Ownership , 
			    "CQ_Rating_Communication" => $CQ_Rating_Communication  
 */ 
 
 public function _setSaveScoreQuality( $param = NULL )
 {
	$_conds = 0;
	 if( !is_null($param) AND is_array( $param ) ) {

		$header_score  = isset($param["header_score"]) ? $param["header_score"] : null;
		$section1	   = isset($param["section1"])  ? $param["section1"] : null;
		$section2 	   = isset($param["section2"])  ? $param["section2"] : null;
		$section3 	   = isset($param["section3"])  ? $param["section3"] : null;
		$section4 	   = isset($param["section4"])  ? $param["section4"] : null;
		$section5 	   = isset($param["section5"])  ? $param["section5"] : null;
		$Rapport       = isset($param["Rapport"])   ? $param["Rapport"] : null;
		$Ownership     = isset($param["Ownership"]) ? $param["Ownership"] : null;
		$Communication = isset($param["Communication"]) ? $param["Communication"] : null;
		$CQ = isset($param["CQ"]) ? $param["CQ"] : null;

		if ( !is_null($header_score) AND is_array($header_score) ) {
			$this->db->set("Name_Of_Agent" , $header_score["Name_Of_Agent"]);
			$this->db->set("Agent_ID" 	, $header_score["Agent_ID"]);
			$this->db->set("Evaluator_Name" , $header_score["Evaluator_Name"]);
			$this->db->set("Customer_Segment" , $header_score["Customer_Segment"]);
			$this->db->set("New_Skill" , $header_score["New_Skill"]);
			$this->db->set("Acknowledge" , $header_score["Acknowledge"]);
			$this->db->set("PVC" , $header_score["PVC"]);
			$this->db->set("In_Academy" , $header_score["In_Academy"]);
			$this->db->set("Language" , $header_score["Language"]);
			$this->db->set("Date_Of_Call" , $header_score["Date_Of_Call"]);
			$this->db->set("Time_Of_Call" , $header_score["Time_Of_Call"]);
			$this->db->set("Date_Of_Evaluation" , $header_score["Date_Of_Evaluation"]);
			$this->db->set("Time_Of_Evaluation" , $header_score["Time_Of_Evaluation"]);
			$this->db->set("Site" , $header_score["Site"]);
			$this->db->set("Call_Type" , $header_score["Call_Type"]);
			$this->db->set("Risk_Type" , $header_score["Risk_Type"]);
			$this->db->set("In_Score" , $header_score["In_Score"]);
			$this->db->set("TotalScore" , $header_score["TotalScore"]);
			$this->db->set("Enter_New_Score" , $header_score["Enter_New_Score"]);
			$this->db->set("General_Call_Feedback" , $header_score["General_Call_Feedback"]);
			$this->db->set("TotalScoreSec1" , $header_score["TotalScoreSec1"]);
			$this->db->set("TotalScoreSec2" , $header_score["TotalScoreSec2"]);
			$this->db->set("TotalScoreSec3" , $header_score["TotalScoreSec3"]);
			$this->db->set("TotalScoreSec4" , $header_score["TotalScoreSec4"]);
		}

		if ( !is_null($section1) AND is_array($section1) ) {
				$this->db->set("Score_Section1" , json_encode($section1) );
		} else {
			echo 1;
		}

		if ( !is_null($section2) AND is_array($section2) ) {
				$this->db->set("Score_Section2" , json_encode($section2) );
		}

		if ( !is_null($section3) AND is_array($section3) ) {
				$this->db->set("Score_Section3" , json_encode($section3) );
		}

		if ( !is_null($section4) AND is_array($section4) ) {
				$this->db->set("Score_Section4" , json_encode($section4) );
		}

		if ( !is_null($section5) AND is_array($section5) ) {
				$this->db->set("Score_Section5" , json_encode($section5) );
		}

		if ( !is_null($Rapport) AND is_array($Rapport) ) {
				$this->db->set("Rapport_Attr1" , $Rapport["Rapport_Attr1"] );
				$this->db->set("Rapport_Attr2" , $Rapport["Rapport_Attr2"] );
				$this->db->set("Rapport_Attr3" , $Rapport["Rapport_Attr3"] );
				$this->db->set("Rapport_Attr4" , $Rapport["Rapport_Attr4"] );
				$this->db->set("Rapport_Attr5" , $Rapport["Rapport_Attr5"] );
		}
		if ( !is_null($Ownership) AND is_array($Ownership) ) {
				$this->db->set("Ownership_Attr1" , $Ownership["Ownership_Attr1"]);
				$this->db->set("Ownership_Attr2" , $Ownership["Ownership_Attr2"]);
				$this->db->set("Ownership_Attr3" , $Ownership["Ownership_Attr3"]);
				$this->db->set("Ownership_Attr4" , $Ownership["Ownership_Attr4"]);
				$this->db->set("Ownership_Attr5" , $Ownership["Ownership_Attr5"]);
		}
		if ( !is_null($Communication) AND is_array($Communication) ) {
				$this->db->set("Communication_Attr1" , $Communication["Communication_Attr1"] );
				$this->db->set("Communication_Attr2" , $Communication["Communication_Attr2"]);
				$this->db->set("Communication_Attr3" , $Communication["Communication_Attr3"]);
				$this->db->set("Communication_Attr4" , $Communication["Communication_Attr4"]);
				$this->db->set("Communication_Attr5" , $Communication["Communication_Attr5"]);
		}

		if ( !is_null($CQ) AND is_array($CQ) ) {
				$this->db->set("CQ_Rating_Rapport" , $CQ["CQ_Rating_Rapport"] );
				$this->db->set("CQ_Rating_Ownership" , $CQ["CQ_Rating_Ownership"]);
				$this->db->set("CQ_Rating_Communication" , $CQ["CQ_Rating_Communication"]);
		}

		$this->db->set("CustomerId" , $param["CustomerId"]);
		$this->db->set("CreateById" , _get_session("UserId"));
		$this->db->set("Status_Callmon" , $param["Status_Callmon"] );
		$this->db->set("RemarksSection3" , $param["Remarks_Section3"] );
		$this->db->set("AgentUserId" , $param["AgentSeller"] );
		$this->db->set("DateCreateTs" , date('Y-m-d H:i:s') );
		
		$ValueAllSection = isset($param["ValueAllSection"]) ? $param["ValueAllSection"] : null;
		$this->db->set("ValueAllSection" , $ValueAllSection );
		#print_r($this->db);
		#$this->db->insert_on_duplicate("t_gn_score_result");
		$this->db->insert("t_gn_score_result");
		#var_dump($this->db->last_query());

		#echo $this->db->last_query();
		#var_dump($this->db->last_query());
		
		if( $this->db->affected_rows() > 0 )
			$CheckItInsert = $this->db->affected_rows();
		echo $CheckItInsert;

	}
	
	
	return $_conds;
 }
 
 
}
?>