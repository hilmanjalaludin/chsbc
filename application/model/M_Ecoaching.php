<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for user modul 
 * 			  extends under model class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysuser/
 */
 
 class M_Ecoaching extends EUI_Model 
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
	$this->load->model(array('M_Configuration','M_User'));
}

//------------------------------------------------------------------
/*
 *@ get default nav of query data 
 *@ will return to nav data 
 */
 
 function get_default() 
{

 // ------------------------- set filter data -----------------------------------
 
  $this->EUI_Page->_setPage($this->page_limit);
  $this->EUI_Page->_setSelect("a.CoachingId");

  $this->EUI_Page->_setFrom("t_gn_coaching a", true);

   $UserIds     = _get_session("UserId");
   $HandlingFor = _get_session("HandlingType");

   if ( $HandlingFor == USER_SUPERVISOR ) {
	  $this->EUI_Page->_setAnd("a.SpvId='$UserIds'" , false);
   } 

   if ( $HandlingFor == USER_AGENT_OUTBOUND ) {
	  $this->EUI_Page->_setAnd("a.AgentId='$UserIds'" , false);
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
	"a.CoachingId as ID" => array("ID", "ID", "primary"),
	//"a.CoachingId as UserId" => array("UserId","User ID"),
	"b.init_name as AgentId" => array("AgentId", "Agent ID"),
	"c.init_name as SpvId" => array("SpvId", "SPV ID"),
	"a.Periode as Periode" => array("Periode", "Periode"),
	"a.CoachingType as CoachingType" => array("CoachingType", "Coaching Type"),
	"a.NotePrevCoach as NotePrevCoach" => array("NotePrevCoach","Note Previous Coach"),
	"a.DiscussionPoint as DiscussionPoint" => array("DiscussionPoint","Discussion Point"),
	"a.DevRequired as DevRequired" => array("DevRequired","Development Required"),
	"a.CoachingDate as CoachingDate" => array("CoachingDate","Aknowledge SPV Date"),
	"a.DevRequiredDate as DevRequiredDate" => array("DevRequiredDate","Aknowledge Agent Date"),
	"a.DateCreated as DateCreated" => array("DateCreated","Date Created")
 ));
 
 $this->EUI_Page->_setFrom("t_gn_coaching a");
 $this->EUI_Page->_setJoin("tms_agent b", "a.AgentId=b.UserId", "LEFT");
 $this->EUI_Page->_setJoin("tms_agent c","a.SpvId=c.UserId", "LEFT");

 $UserIds = _get_session("UserId");
 $HandlingFor = _get_session("HandlingType");

 if ( $HandlingFor == USER_SUPERVISOR ) {
	$this->EUI_Page->_setWhere("a.SpvId='$UserIds'");
 } 
 if ( $HandlingFor == USER_AGENT_OUTBOUND ) {
	$this->EUI_Page->_setWhere("a.AgentId='$UserIds'");
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
	 $this->EUI_Page->_setOrderBy('a.CoachingId','DESC');
  } else {
	 $this->EUI_Page->_setOrderBy(_get_post('order_by'), _get_post('type'));
  }	

// --------------- set limit  ------------------------------------------- 
  
  //echo $this->EUI_Page->_getCompiler();
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