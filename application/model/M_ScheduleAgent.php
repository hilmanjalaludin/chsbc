<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for user modul 
 * 			  extends under model class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysuser/
 */
 
 class M_ScheduleAgent extends EUI_Model 
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
 
 /*
select 
a.id as IdUser , 
a.full_name as FullName ,
b.name as Privilege , 
c.full_name as SpvName , 
d.full_name as MgrName
from tms_agent a
inner join tms_agent_profile b on a.profile_id=b.id
inner join tms_agent c on a.spv_id=c.UserId
inner join tms_agent d on c.mgr_id=d.UserId
  */

 function get_default() 
{

 // ------------------------- set filter data -----------------------------------
 
  $this->EUI_Page->_setPage($this->page_limit);
  $this->EUI_Page->_setSelect("a.UserId");

 $this->EUI_Page->_setFrom("tms_agent a");
 $this->EUI_Page->_setJoin("tms_agent_profile b", "a.profile_id=b.id", "INNER");
 $this->EUI_Page->_setJoin("tms_agent c","a.spv_id=c.UserId", "INNER");
 $this->EUI_Page->_setJoin("tms_agent d","c.mgr_id=d.UserId", "INNER");
 $this->EUI_Page->_setWhere( "AND a.profile_id=".USER_AGENT_OUTBOUND );

 
// ------------------------- set filter data -----------------------------------

	if ( _get_session("HandlingType") == USER_SUPERVISOR ) {
		$this->EUI_Page->_setAnd( "a.spv_id" , _get_session("UserId") );
	}
  
// --------------- set order  ------------------------------------------- 

  $this->EUI_Page->_setAndCache("a.UserId", "agentid" , true);
	

   if( !_get_have_post('order_by')){
	 $this->EUI_Page->_setOrderBy('a.UserId','DESC');
  } else {
	 $this->EUI_Page->_setOrderBy(_get_post('order_by'), _get_post('type'));
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
 /*
select 
a.UserId as UserId ,
a.id as IdUser , 
a.full_name as FullName ,
b.name as Privilege , 
c.full_name as SpvName , 
d.full_name as MgrName
from tms_agent a
inner join tms_agent_profile b on a.profile_id=b.id
inner join tms_agent c on a.spv_id=c.UserId
inner join tms_agent d on c.mgr_id=d.UserId
  */


 $this->EUI_Page->_postPage(_get_post('v_page') );
 $this->EUI_Page->_setPage($this->page_limit);
 $this->EUI_Page->_setArraySelect(array(
	"a.UserId as UserId" => array("UserId", "UserId", "primary"),
	"a.id as IdUser" => array("IdUser", "Username"),
	"a.full_name as FullName" => array("FullName", "Full Name"),
	"b.name as SpvName" => array("SpvName","Supervisor"),
	"d.full_name as MgrName" => array("MgrName","Manager")
 ));
 
 $this->EUI_Page->_setFrom("tms_agent a");
 $this->EUI_Page->_setJoin("tms_agent_profile b", "a.profile_id=b.id", "INNER");
 $this->EUI_Page->_setJoin("tms_agent c","a.spv_id=c.UserId", "INNER");
 $this->EUI_Page->_setJoin("tms_agent d","c.mgr_id=d.UserId", "INNER");
 $this->EUI_Page->_setWhere( "1=1 AND a.profile_id=".USER_AGENT_OUTBOUND );
 
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




	if ( _get_session("HandlingType") == USER_SUPERVISOR ) {
		$this->EUI_Page->_setAnd( "a.spv_id" , _get_session("UserId") );
	}


  //echo _getDateEnglish(_get_exist_session('startdate')) . "<br>";
  //echo _getDateEnglish(_get_exist_session('enddate'));

  $this->EUI_Page->_setAndCache("a.UserId", "agentid" , true);

  //$this->EUI_Page->_setAndOrCache("date_format(b.ActivityDate, '%Y-%m-%d') >= '". StartDate(_get_post('startdate')) ."'", 'startdate', true); 
  //$this->EUI_Page->_setAndOrCache("date_format(b.ActivityDate, '%Y-%m-%d') <= '". EndDate(_get_post('enddate')) ."'", 'enddate', true);
  
	 

   if(_get_have_post('order_by')){
	 $this->EUI_Page->_setOrderBy(_get_post('order_by'), _get_post('type'));
  }	
else $this->EUI_Page->_setOrderBy('a.UserId','ASC');


// --------------- set limit  ------------------------------------------- 
  
  $this->EUI_Page->_setLimit();
  //echo $this->EUI_Page->_getCompiler();
  //echo _get_post("date_absen");
  
  
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