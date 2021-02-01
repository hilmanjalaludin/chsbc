<?php

class M_CallTrackingReport extends EUI_Model
{

// -----------------------------------------------------------------------------
/*
 *
 * @ package		function get detail content list page 
 * @ param			not assign parameter
 */
 
 private static $Instance   = null; 
 public static function &Instance()
{
	if( is_null(self::$Instance) ){
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
 
function __construct() {
	$this->load->model(array('M_Report','M_SetCampaign','M_SysUser','')); 
}


// ------------- notes ----------------------
function _select_report_notes()
{
	$this->notes = array();
	$sql = "select b.CallReasonCategoryName,  a.CallReasonCode, a.CallReasonDesc from t_lk_callreason a 
		left join t_lk_callreasoncategory b on a.CallReasonCategoryId  = b.CallReasonCategoryId
		where a.CallReasonStatusFlag = 1 and a.CallReasonCategoryId <> 9
		order by a.CallReasonCode ASC ";
	
	$rs = $this->db->query($sql);
	  if( $rs->num_rows() ) 
		  foreach( $rs->result_assoc() as $row ) 
	{
		$this->notes[] = $row;
	 }
	  
	 return $this->notes;
}
// ------------- notofication ----------------------

function _select_report_notification()
{
	$this->notification = array(
		array("note" => "New Assigned", "desc" => "New Database upload"),
		array("note" => "Re Assigned", "desc" => "Database Recycle bucket"),
		array("note" => "Solicited New Assigned", "desc" => "Solicited New Database"),
		array("note" => "Solicited Reutilized", "desc" => "Solicited Recycle Database"),
		array("note" => "Total Solicited / Utilized", "desc" => "Solicited New Database + Recycle Database"),
		array("note" => "NOS", "desc" => "Number Of Sales (Number Of Insured)")
	);
	
	return $this->notification;
}


// ----------------------------------------

 public function _select_report_manager( $Manger = 0 ) 
{
 
 $this->manager = array();
 
 $gHandle = _get_session('HandlingType');
 $gUserId = _get_session('UserId');
 
 if( in_array($gHandle, 
   array(USER_ROOT, USER_ADMIN, USER_ADMIN, USER_UPLOADER) ) )
 {
	$sql = "select a.UserId, a.id from tms_agent a 
			where a.handling_type = 9 
			and a.user_state=1"; 
 }
 
 if( in_array($gHandle, 
   array(USER_MANAGER, USER_ACCOUNT_MANAGER) ) )
 {
	$sql = "select a.UserId, a.id  from tms_agent a 
			where a.handling_type = 9 and a.UserId='$gUserId' 
			and a.user_state=1"; 
 }
 
 if( in_array($gHandle, 
   array(USER_SUPERVISOR) ) )
 {
	$sql = "select a.UserId, a.id  from tms_agent a  where a.handling_type = 9 and a.UserId IN (
				select cs.act_mgr  from tms_agent cs 
				where cs.UserId = $gUserId
			) and a.user_state=1"; 
 }
 
  if( in_array($gHandle,
	array(USER_LEADER) ))
 {
	$sql = "select a.UserId, a.id  from tms_agent a  where a.handling_type = 9 and a.UserId IN (
				select cs.act_mgr from tms_agent cs 
				where cs.UserId = $gUserId
			) and a.user_state=1"; 
 }
 
  $rs = $this->db->query($sql);
  if( $rs->num_rows() ) 
	  foreach( $rs->result_assoc() as $row ) 
{
	$this->manager[$row['UserId']] = $row['id'];
 }
  
 return $this->manager;
 
}

// ----------------------------------------

 public function _select_report_atm( $Atm = 0 ) 
{
 
 $this->atm = array();
 
 $gHandle = _get_session('HandlingType');
 $gUserId = _get_session('UserId');
 
 if( in_array($gHandle, 
   array(USER_ROOT, USER_ADMIN, USER_ADMIN, USER_UPLOADER) ) )
 {
	$sql = "select a.UserId, a.id from tms_agent a where a.handling_type =". USER_SUPERVISOR ."
			and a.user_state=1 "; 
 }
 
 
 if( in_array($gHandle, 
   array(USER_MANAGER, USER_ACCOUNT_MANAGER) ) )
 {
	$sql = "select a.UserId, a.id  from tms_agent a 
			where a.handling_type =". USER_SUPERVISOR ." 
			and a.act_mgr IN (
			select cs.act_mgr  from tms_agent cs  
			where cs.UserId='$gUserId' ) and a.user_state=1"; 
 }
 
 if( in_array($gHandle, 
   array(USER_SUPERVISOR) ) )
 {
	$sql = "select a.UserId, a.id  from tms_agent a  
			where a.handling_type =". USER_SUPERVISOR ." 
			and a.UserId ='$gUserId' and a.user_state=1";
 }
 
 if( in_array($gHandle,
	array(USER_LEADER) ))
 {
	$sql = "select a.UserId, a.id  from tms_agent a  
			where a.handling_type =". USER_SUPERVISOR ."
			and a.UserId IN (
				select cs.spv_id from tms_agent cs 
				where cs.UserId =$gUserId
			) and a.user_state=1 "; 
 }
 
 $rs = $this->db->query($sql);
 if( $rs->num_rows() ) 
	foreach( $rs->result_assoc() as $row ) 
 {
	$this->atm[$row['UserId']] = $row['id'];
 }
  
 return $this->atm;
 
}



// ----------------------------------------
// spv Or leader 
 public function _select_report_spv( $atm = 0 ) 
{
 
 $this->spv = array();
 
 $gHandle = _get_session('HandlingType');
 $gUserId = _get_session('UserId');
 
 if( in_array($gHandle, 
   array(USER_ROOT, USER_ADMIN, USER_ADMIN, USER_UPLOADER) ) )
 {
	$sql = "select a.UserId, a.id 
			 from tms_agent a where a.handling_type = ". USER_LEADER ." 
			 and a.user_state=1 "; 
 }
 
 
 if( in_array($gHandle, 
   array(USER_MANAGER, USER_ACCOUNT_MANAGER) ) )
 {
	$sql = "select a.UserId, a.id  from tms_agent a 
			where a.handling_type=". USER_LEADER ." and a.act_mgr IN (
			select cs.act_mgr  from tms_agent cs  
			where cs.UserId='$gUserId' ) and a.user_state=1"; 
 }
 
 if( in_array($gHandle, 
   array(USER_SUPERVISOR) ) )
 {
	$sql = "select a.UserId, a.id  from tms_agent a  
			where a.handling_type =". USER_LEADER ." 
			and a.spv_id='$gUserId' and a.user_state=1";
 }
 
 
 if( in_array($gHandle,
	array(USER_LEADER) ))
 {
	$sql = " select a.UserId, a.id  from tms_agent a  
			 where a.handling_type = ". USER_LEADER ." 
			 and a.UserId='$gUserId' and a.user_state=1";
 }
 
 //echo $sql;
 $rs = $this->db->query($sql);
 if( $rs->num_rows() ) 
	foreach( $rs->result_assoc() as $row ) 
 {
	$this->spv[$row['UserId']] = $row['id'];
 }
  
 return $this->spv;
 
}


// ----------------------------------------
// spv Or leader 


 function _select_report_atm_by_manager( $ManagerId = 0 )
{
  $gHandle = _get_session('HandlingType');
  
  if( !is_array($ManagerId)  ){
	 $ManagerId = array($ManagerId); 
  }  
  
 $this->Atm = array();
 
 $this->db->reset_select();
 $this->db->select("a.UserId, a.id", FALSE);
 $this->db->from("tms_agent a");
 $this->db->where_in("a.handling_type", array(USER_SUPERVISOR));
 $this->db->where_in("a.act_mgr",  $ManagerId);
 $this->db->where("a.user_state", 1);
 
 
// --------- handle by login  ------------- 
  if( in_array($gHandle, 
   array(USER_SUPERVISOR) ) ) {
	 $this->db->where("a.UserId", _get_session('UserId'));
 }


// --------- handle by login  -------------
 
 if( in_array($gHandle, 
   array(USER_LEADER) ) ) {
	 $this->db->where("a.spv_id", _get_session('SupervisorId'));
 }
 
 
 $this->db->order_by("a.id", "ASC");
 $rs = $this->db->get();
 
 if( $rs->num_rows() ) 
	foreach( $rs->result_assoc() as $row ) 
  {
	 $this->Atm[$row['UserId']] = $row['id'];
  }
  
 return  $this->Atm;
}

// ----------------------------------------
// spv Or leader 

 function _select_report_spv_by_mgr( $Mgr = 0 )
{
 $gHandle = _get_session('HandlingType');	
  if( !is_array($Mgr)  ){
	 $Mgr = array($Mgr); 
  }  
  
 $this->tl = array();
 
 $this->db->reset_select();
 $this->db->select("a.UserId, a.id", FALSE);
 $this->db->from("tms_agent a");
 $this->db->where_in("a.handling_type", array(USER_LEADER));
 $this->db->where_in("a.act_mgr",  $Mgr);
 $this->db->where("a.user_state", 1);
 
 // --------- handle by login  -------------
 if( in_array($gHandle, 
   array(USER_LEADER) ) ) {
	 $this->db->where("a.UserId", _get_session('UserId'));
 }
 
 $this->db->order_by("a.id", "ASC");
 $rs = $this->db->get();
 
 if( $rs->num_rows() ) 
	foreach( $rs->result_assoc() as $row ) 
  {
	 $this->tl[$row['UserId']] = $row['id'];
  }
  
 return  $this->tl;
}
// ----------------------------------------
// spv Or leader 

 function _select_report_spv_by_atm( $AtmId = 0 )
{
 $gHandle = _get_session('HandlingType');	
  if( !is_array($AtmId)  ){
	 $AtmId = array($AtmId); 
  }  
  
 $this->tl = array();
 
 $this->db->reset_select();
 $this->db->select("a.UserId, a.id", FALSE);
 $this->db->from("tms_agent a");
 $this->db->where_in("a.handling_type", array(USER_LEADER));
 $this->db->where_in("a.spv_id",  $AtmId);
 $this->db->where("a.user_state", 1);
 
 // --------- handle by login  -------------
 if( in_array($gHandle, 
   array(USER_LEADER) ) ) {
	 $this->db->where("a.UserId", _get_session('UserId'));
 }
 
 $this->db->order_by("a.id", "ASC");
 $rs = $this->db->get();
 
 if( $rs->num_rows() ) 
	foreach( $rs->result_assoc() as $row ) 
  {
	 $this->tl[$row['UserId']] = $row['id'];
  }
  
 return  $this->tl;
}	

// ----------------------------------------
// spv Or leader 

 public function _select_report_tmr_by_spv( $gTL = 0 ) 
{
  
  if( is_bool($gTL) AND $gTL == FALSE  ){
	$gTL = array("9999");
  }
  
  if( !is_array($gTL)  ){
	$gTL = array($gTL); 
  }
 
  $this->tmr = array();
  
  $this->db->reset_select();
  $this->db->select("a.UserId, a.id", FALSE);
  $this->db->from("tms_agent a");
  $this->db->where_in("a.handling_type", array(USER_AGENT_INBOUND, USER_AGENT_OUTBOUND));
  $this->db->where_in("a.tl_id",  $gTL);
  $this->db->where("a.user_state", 1);
  $this->db->order_by("a.id", "ASC");
  //$this->db->print_out();
   
  $rs = $this->db->get();
  if( $rs->num_rows() ) 
	foreach( $rs->result_assoc() as $row ) 
  {
	 $this->tmr[$row['UserId']] = $row['id'];
  }
 return  $this->tmr;
 
}	


// ----------------------------------------
// spv Or leader 

 public function _select_report_tmr_by_atm( $Atm = 0 ) 
{
  
  if( is_bool($Atm) AND $Atm == FALSE  ){
	$Atm = array("9999");
  }
  
  if( !is_array($Atm)  ){
	$Atm = array($Atm); 
  }
 
  $this->tmr = array();
  
  $this->db->reset_select();
  $this->db->select("a.UserId, a.id", FALSE);
  $this->db->from("tms_agent a");
  $this->db->where_in("a.handling_type", array(USER_AGENT_INBOUND, USER_AGENT_OUTBOUND));
  $this->db->where_in("a.spv_id",  $Atm);
  $this->db->where("a.user_state", 1);
  $this->db->order_by("a.id", "ASC");
  //$this->db->print_out();
   
  $rs = $this->db->get();
  if( $rs->num_rows() ) 
	foreach( $rs->result_assoc() as $row ) 
  {
	 $this->tmr[$row['UserId']] = $row['id'];
  }
 return  $this->tmr;
 
}	


// ----------------------------------------
// spv Or leader 

 public function _select_report_tmr_by_date( $Mgr= 0 ) 
{
  $this->tmr = array();
  
  $this->db->reset_select();
  $this->db->select("a.UserId, a.id", FALSE);
  $this->db->from("tms_agent a");
  $this->db->where_in("a.handling_type", array(USER_AGENT_INBOUND, USER_AGENT_OUTBOUND));
  $this->db->where("a.user_state", 1);
  $this->db->order_by("a.id", "ASC");
  //$this->db->print_out();
   
  $rs = $this->db->get();
  if( $rs->num_rows() ) 
	foreach( $rs->result_assoc() as $row ) 
  {
	 $this->tmr[$row['UserId']] = $row['id'];
  }
 return  $this->tmr;
 
}	

// ----------------------------------------
// spv Or leader 

 public function _select_report_tmr_by_mgr( $Mgr= 0 ) 
{
  
  if( is_bool($Mgr) AND $Mgr == FALSE  ){
	$Mgr = array("9999");
  }
  
  if( !is_array($Mgr)  ){
	$Mgr = array($Mgr); 
  }
 
  $this->tmr = array();
  
  $this->db->reset_select();
  $this->db->select("a.UserId, a.id", FALSE);
  $this->db->from("tms_agent a");
  $this->db->where_in("a.handling_type", array(USER_AGENT_INBOUND, USER_AGENT_OUTBOUND));
  $this->db->where_in("a.act_mgr",  $Mgr);
  $this->db->where("a.user_state", 1);
  $this->db->order_by("a.id", "ASC");
  //$this->db->print_out();
   
  $rs = $this->db->get();
  if( $rs->num_rows() ) 
	foreach( $rs->result_assoc() as $row ) 
  {
	 $this->tmr[$row['UserId']] = $row['id'];
  }
 return  $this->tmr;
 
}	

// ----------------------------------------
// spv Or leader 

 public function _select_report_tmr( $atm = 0 ) 
{
 
 $this->tmr = array();
 $gHandle = _get_session('HandlingType');
 $gUserId = _get_session('UserId');
 
 if( in_array($gHandle, 
   array(USER_ROOT, USER_ADMIN, USER_ADMIN, USER_UPLOADER) ) )
 {
	$sql = "select a.UserId, a.id 
			 from tms_agent a where a.handling_type IN( ". USER_AGENT_INBOUND .", ". USER_AGENT_OUTBOUND .")
			 order by a.id ASC "; 

 }
 
 
 if( in_array($gHandle, 
   array(USER_MANAGER, USER_ACCOUNT_MANAGER) ) )
 {
	$sql = "select a.UserId, a.id  from tms_agent a 
			where a.handling_type IN( ". USER_AGENT_INBOUND .", ". USER_AGENT_OUTBOUND .") and a.act_mgr IN (
			select cs.act_mgr  from tms_agent cs  
			where cs.act_mgr='$gUserId' ) 
			order by a.id ASC "; 
 }
 
 if( in_array($gHandle, 
   array(USER_SUPERVISOR) ) )
 {
	$sql = "select a.UserId, a.id  from tms_agent a  
			where a.handling_type IN( ". USER_AGENT_INBOUND .", ". USER_AGENT_OUTBOUND .")
			and a.spv_id ='$gUserId' 
			order by a.id ASC  ";
 }
 
 
 if( in_array($gHandle,
	array(USER_LEADER) ))
 {
	$sql = " select a.UserId, a.id  from tms_agent a  
			 where a.handling_type IN( ". USER_AGENT_INBOUND .", ". USER_AGENT_OUTBOUND .")
			 and a.tl_id='$gUserId'
			 order by a.id ASC ";
 }
 
 
 $rs = $this->db->query($sql);
 if( $rs->num_rows() ) 
	foreach( $rs->result_assoc() as $row ) 
 {
	 $this->tmr[$row['UserId']] = $row['id'];
 }
  
 return  $this->tmr;
 
}

// ---------------------------------------------------
 public function _select_report_campaign()
{
	
 $this->report_campaign = array();
 
 $this->db->reset_select();
 $this->db->select("CampaignId, CampaignDesc", FALSE);
 $this->db->from("t_gn_campaign");
 $this->db->where("CampaignStatusFlag",1);
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $row )
{
	$this->report_campaign[$row['CampaignId']] = $row['CampaignDesc'];
 }
 
 return $this->report_campaign;
 
}

// ----------------------------------------------------
// --------------------------------------------------------------

 public function _select_report_type()
{

 $this->report_type = array(
	'filter_campaign_group_mgr' => 'Campaign Group By MGR',
	'filter_campaign_group_atm' => 'Campaign Group By ATM',
	'filter_campaign_group_spv' => 'Campaign Group By SPV',
	'filter_campaign_group_agent' => 'Campaign Group By TMR',
	'filter_campaign_group_date' => 'Campaign Group By Date'	
 );
 
 
// ---------- level admin etc. 
 $gHandle  = _get_session('HandlingType');
  if( in_array($gHandle, 
	array(USER_ROOT, USER_ADMIN, USER_ADMIN, USER_UPLOADER) ) )
 {
	$this->report_type = array(
		'filter_campaign_group_mgr' => 'Campaign Group By MGR',
		'filter_campaign_group_atm' => 'Campaign Group By ATM',
		'filter_campaign_group_spv' => 'Campaign Group By SPV',
		'filter_campaign_group_agent' => 'Campaign Group By TMR',
		'filter_campaign_group_date' => 'Campaign Group By Date'	
	 );
 }
 
// -------- level manager  
  if( in_array($gHandle,
	array(USER_MANAGER, USER_ACCOUNT_MANAGER) ))
 {
	$this->report_type = array(
		'filter_campaign_group_mgr' => 'Campaign Group By MGR',
		'filter_campaign_group_atm' => 'Campaign Group By ATM',
		'filter_campaign_group_spv' => 'Campaign Group By SPV',
		'filter_campaign_group_agent' => 'Campaign Group By TMR',
		'filter_campaign_group_date' => 'Campaign Group By Date'	
	 );
 }
 
 
 // -------- level ATM  -----------------------
 
  if( in_array($gHandle,
	array(USER_SUPERVISOR) ))
 {
	$this->report_type = array(
		'filter_campaign_group_atm' => 'Campaign Group By ATM',
		'filter_campaign_group_spv' => 'Campaign Group By SPV',
		'filter_campaign_group_agent' => 'Campaign Group By TMR',
		'filter_campaign_group_date' => 'Campaign Group By Date'
	);
 }
 
 
 // -------- level SPV  --------------------
  if( in_array($gHandle,
	array(USER_LEADER) ))
 {
	 $this->report_type = array(
		'filter_campaign_group_spv' => 'Campaign Group By SPV',
		'filter_campaign_group_agent' => 'Campaign Group By TMR',
		'filter_campaign_group_date' => 'Campaign Group By Date'	
	 );
 }
 
 return $this->report_type;
 
} 


// ----------------------------------------------------
// --------------------------------------------------------------

 public function _select_report_mode()
{
	$this->report_mode = array ( 'summary' => 'Summary', 'detail' => 'Detail' );
	return $this->report_mode;
}

// ----------------------------------------------------
// --------------------------------------------------------------

  public function _select_attr_user()
 {
	$this->user_attr  = array();
    $gUserId = _get_session('UserId');
    
	$sql = " select * from  tms_agent a where a.UserId = ". $gUserId ." ";
	$qry = $this->db->query($sql);
	if( $qry->num_rows() >  0 ){
		$this->user_attr = (array)$qry->result_first_assoc();
	}
	return new EUI_Object($this->user_attr);
}

//--
// ======================================= END CLASS ====================================

}
?>