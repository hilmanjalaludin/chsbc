<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for user modul 
 * 			  extends under model class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysuser/
 */
 
 class M_escoring extends EUI_Model 
{

 var $page_limit = 10;
// ------------------------------------------------------------

 private static $Instance = null;
 public static function &Instance()
{
  if( is_null(self::$Instance) ){
	self::$Instance = new self();
  }
  return self::$Instance;
}

// -----------------------------------------------------------

 function __construct()
{ 
	$this->load->model(array('M_Configuration','M_User','M_ModOutBoundGoal'));
}

//------------------------------------------------------------------
/*
 *@ get default nav of query data 
 *@ will return to nav data 
 */
 
 function get_default() 
{

 // ------------------------- set filter data -----------------------------------
 $conds1 = " a.AssignId , h.StatusAccurate , if(i.CustomerId is not null , 'Yes' , 'No') as StatusScoring "; 
	$conds2 = " AND e.CallReasonId in(".CUSTOMER_LIST_AGENT.")"; 

	// mode mssql 
	if( QUERY == 'mssql') {
		$conds1 = " DISTINCT b.CustomerId, h.StatusAccurate, CASE WHEN i.CustomerId IS NOT NULL THEN 'Yes' ELSE 'No' END AS StatusScoring ";
		$conds2 = " e.CallReasonId in(".CUSTOMER_LIST_AGENT.")"; 
	}

	$CallDirection =& M_ModOutBoundGoal::get_instance();
	$this->EUI_Page->_setPage($this->page_limit);
	$this->EUI_Page->_setSelect("{$conds1}",FALSE);
  // $this->EUI_Page->_setPage($this->page_limit);
  // $this->EUI_Page->_setSelect("a.CoachingId");

  // $this->EUI_Page->_setFrom("t_gn_coaching a", true);
  $this->EUI_Page->_setFrom("t_gn_assignment a");
 $this->EUI_Page->_setJoin("t_gn_customer b", "a.CustomerId=b.CustomerId", "LEFT");
 $this->EUI_Page->_setJoin("tms_agent c", "b.SellerId=c.UserId", "LEFT");
 $this->EUI_Page->_setJoin("tms_agent d","c.spv_id=d.UserId", "LEFT");

 $this->EUI_Page->_setJoin("t_lk_callreason e"			," b.CallReasonId=e.CallReasonId", "LEFT");
 $this->EUI_Page->_setJoin("t_gn_campaign f" 			," b.CampaignId=f.CampaignId", "LEFT");
 $this->EUI_Page->_setJoin("t_gn_quality_assignment g "	," g.Assign_Data_Id=b.CustomerId", "LEFT");
 $this->EUI_Page->_setJoin("t_gn_score_accurated h "	," h.CustomerId=b.CustomerId", "LEFT");
 $this->EUI_Page->_setJoin("t_gn_score_result i 	"	," b.CustomerId=i.CustomerId", "LEFT");

   $UserIds     = _get_session("UserId");
   $HandlingFor = _get_session("HandlingType");

   if ( $HandlingFor == USER_SUPERVISOR ) {
	  $this->EUI_Page->_setAnd("d.UserId='$UserIds'" , false);
   } 

   if ( $HandlingFor == USER_AGENT_OUTBOUND ) {
	  $this->EUI_Page->_setWhere("c.UserId='$UserIds' AND i.CustomerId IS NOT NULL " , false);
   }


   //echo $this->EUI_Page->_getCompiler();

  
 // ------------------------- set filter data -----------------------------------
  /*
  $this->EUI_Page->_setLikeCache("a.id", "user_id", true);
  $this->EUI_Page->_setLikeCache("a.ip_address", "user_address", true);
  $this->EUI_Page->_setLikeCache("a.full_name", "user_name", true);
  $this->EUI_Page->_setAndCache("a.handling_type", "user_privileges", true);
  $this->EUI_Page->_setAndCache("a.user_state", "user_active", true);
  $this->EUI_Page->_setAndCache("a.logged_state", "user_login", true);
  */
  return $this->EUI_Page;
 }
 
 
//------------------------------------------------------------ 
/*
 *@ get page content return to content list 
 *@ get content data 
 */
 
 public function get_content()
{

 /**
  * ID
  * Spv ID
  * Agent ID
  * Periode
  * Coach Type
  * Coach Date
  * Coach Note
  * Coach Discussed
  * Coach Development
  * Date Create 
  */
	$this->EUI_Page->_postPage(_get_post('v_page') );
    $this->EUI_Page->_setPage($this->page_limit);
	$this->EUI_Page->_setArraySelect(array(
		"b.CustomerId as CustomerId" => array("CustomerId","CustomerId", "primary"),
		"f.CampaignName as CampaignName" => array("CampaignName", "Campaign Name"), 
		"i.Development_Required as Development_Required" => array("Development_Required", "Development_Required"), 
		"i.notes as notes" => array("notes", "Notes"), 
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
 
 $this->EUI_Page->_setFrom("t_gn_assignment a");
 $this->EUI_Page->_setJoin("t_gn_customer b", "a.CustomerId=b.CustomerId", "LEFT");
 $this->EUI_Page->_setJoin("tms_agent c", "b.SellerId=c.UserId", "LEFT");
 $this->EUI_Page->_setJoin("tms_agent d","c.spv_id=d.UserId", "LEFT");

 $this->EUI_Page->_setJoin("t_lk_callreason e"			," b.CallReasonId=e.CallReasonId", "LEFT");
 $this->EUI_Page->_setJoin("t_gn_campaign f" 			," b.CampaignId=f.CampaignId", "LEFT");
 $this->EUI_Page->_setJoin("t_gn_quality_assignment g "	," g.Assign_Data_Id=b.CustomerId", "LEFT");
 $this->EUI_Page->_setJoin("t_gn_score_accurated h "	," h.CustomerId=b.CustomerId", "LEFT");
 $this->EUI_Page->_setJoin("t_gn_score_result i 	"	," b.CustomerId=i.CustomerId", "LEFT");

 $UserIds = _get_session("UserId");
 $HandlingFor = _get_session("HandlingType");

 if ( $HandlingFor == USER_SUPERVISOR ) {
	$this->EUI_Page->_setWhere("d.UserId='$UserIds'");
 } 
 if ( $HandlingFor == USER_AGENT_OUTBOUND ) {
 	$this->EUI_Page->_setWhere("i.CustomerId IS NOT NULL AND c.UserId='$UserIds'");
	//$this->EUI_Page->_setWhere("c.UserId='$UserIds'");
 }
 
// ------------------------- set filter data -----------------------------------

 /*
 $this->EUI_Page->_setLikeCache("a.id", "user_id", true);
 $this->EUI_Page->_setLikeCache("a.ip_address", "user_address", true);
 $this->EUI_Page->_setLikeCache("a.full_name", "user_name", true);
 $this->EUI_Page->_setAndCache("a.handling_type", "user_privileges", true);
 $this->EUI_Page->_setAndCache("a.user_state", "user_active", true);
 $this->EUI_Page->_setAndCache("a.logged_state", "user_login", true);
  */
  
// --------------- set order  ------------------------------------------- 

   if( !_get_have_post('order_by')){
	 $this->EUI_Page->_setOrderBy('a.AssignId','DESC');
  } else {
	 $this->EUI_Page->_setOrderBy(_get_post('order_by'), _get_post('type'));
  }	

// --------------- set limit  ------------------------------------------- 
  
  #echo $this->EUI_Page->_getCompiler();
  $this->EUI_Page->_setLimit();
  
} 


/*
 *@ get buffering query from database
 *@ then return by object type ( resource(link) ); 
 */
 

//@ select get profile id

function _get_teleamarketer($param = null ) 
{
	$_data = array();
	
	if( !in_array($this->EUI_Session ->_get_session('HandlingType'),array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND)) )
	{
		$this->db->reset_select();
		$this->db->select('UserId, init_name');
		$this->db->from('tms_agent');
		$this->db->where_in('handling_type', array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));
		
	// cheked list 
		if(!is_null($param) AND ($param) ) {
			$this->db->where($param); 	
		}
	// level USER_ROOT
	
	if(_get_session('HandlingType')== USER_ROOT ) {
		$this->db->where_not_in('handling_type',array(USER_ROOT));
	}
	
	// level USER_ADMIN
	
	if(_get_session('HandlingType')== USER_ADMIN ) {
		$this->db->where_in('admin_id',_get_session('UserId'));
		$this->db->where_not_in('handling_type',array(USER_ROOT));
	}
	
	// level USER_MANAGER
	
	if(_get_session('HandlingType')== USER_MANAGER ) {
		$this->db->where_in('mgr_id',_get_session('UserId'));
		$this->db->where_not_in('handling_type',array(
			USER_ROOT,
			USER_ADMIN,
			USER_MANAGER
		));
	}
	
	// level USER_ACCOUNT_MANAGER 
	
	if(_get_session('HandlingType')== USER_ACCOUNT_MANAGER ) {
		$this->db->where_in('act_mgr',_get_session('UserId'));
		$this->db->where_not_in('handling_type',array(
			USER_ROOT,
			USER_ADMIN,
			USER_MANAGER,
			USER_ACCOUNT_MANAGER
		));
	}
	
	// level USER_SUPERVISOR
	
	if(_get_session('HandlingType')== USER_SUPERVISOR ) {
		$this->db->where_in('spv_id',_get_session('UserId'));
		$this->db->where_not_in('handling_type',array(
			USER_ROOT,
			USER_ADMIN,
			USER_MANAGER,
			USER_ACCOUNT_MANAGER,
			USER_SUPERVISOR
		));
	}
	
	// level team USER_LEADER 
	
	if(_get_session('HandlingType')== USER_LEADER ) {
		$this->db->where_in('tl_id',_get_session('UserId'));
		$this->db->where_not_in('handling_type',array(
			USER_ROOT,
			USER_ADMIN,
			USER_MANAGER,
			USER_ACCOUNT_MANAGER,
			USER_SUPERVISOR,
			USER_LEADER
		));
	}
	
	$this->db->order_by("init_name");
	//-------- debugs : $this->db->print_out();
	
	$no = 0;
	$rs = $this->db->get();
	if($rs->num_rows() > 0)
		foreach($rs->result_assoc() as $rows ) 
	{
		$_data[$rows['UserId']] = (++$no)." - ".$rows['init_name'];	
	}
	
 }
	
	return $_data;
}


//@ select get profile id

function _get_supervisor() 
{
  $_data = array();
  $this->db ->reset_select();
  $this->db ->select('UserId, full_name');
  $this->db ->from('tms_agent');
  $this->db ->where('handling_type', USER_SUPERVISOR );
	
  $handling_type = _get_session('HandlingType');
  if(in_array($handling_type, array(USER_SUPERVISOR) )){
	$this->db->where_in("UserId", _get_session('UserId'));
  }
	
  if(in_array($handling_type, array(USER_LEADER) )){
	$this->db->where_in("UserId", _get_session('SupervisorId'));
  }
 
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
	foreach( $rs-> result_assoc() as $rows ) 
{
	$_data[$rows['UserId']] = $rows['full_name'];
 }
	
	return $_data;
}

//@ select get profile id

function _get_teamleader() 
{
	$_data = array();
	$this -> db -> select('UserId, full_name');
	$this -> db -> from('tms_agent');
	$this -> db -> where('handling_type', USER_SUPERVISOR );
	
	foreach( $this -> db -> get() -> result_assoc() as $rows ) 
	{
		$_data[$rows['UserId']] = $rows['full_name'];
	}
	
	return $_data;
}



// _getUserCapacity

function _getUserCapacity( $Status=1 )
{
	$_Capacity = 0;
	
	$this -> db -> select("COUNT('a.UserId') as Jumlah",FALSE);
	$this -> db -> from("tms_agent a");
	$this -> db -> where("a.user_state", $Status);
	$this -> db -> where_in("a.profile_id", array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));
	
	$rows = $this -> db -> get()->result_first_assoc();
	if( is_array($rows) )
	{
		$_Capacity = (INT)$rows['Jumlah'];
	}
	
	return $_Capacity;
	
}

function get_resource_query()
 {
	self::get_content();
	
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }

  
function get_page_number()
  {
	if( $this -> EUI_Page -> _get_query()!='' )
	{
		return $this -> EUI_Page -> _getNo();
	}	
  }
  

// get group of the user under privilges 

// =============== END CLASS ==========

}
?>