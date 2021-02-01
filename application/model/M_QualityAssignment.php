<?php
/*
 * E.U.I 
 * --------------------------------------------------------------------------
 *
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/QualityAssignment/index/?
 * ----------------------------------------------------------------------------
 */
 
 
class M_QualityAssignment extends EUI_Model
{

 var $perpage = 10;

 
// --------------------------------------------------
 
private static $Instance   = null; 
  public static function &Instance()
 {
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
 }

 
/*
 * @ def : get layput panel left content 
 * --------------------------------------
 *
 * @ param : - 
 * @ param : -
 */
 
  public function __construct()
 { 
	$this->load->model(array('M_QtyScoring','M_SetCampaign','M_SetResultQuality'));
 }
 
 
/*
 * @ def : get layput panel left content 
 * --------------------------------------
 *
 * @ param : - 
 * @ param : -
 */
 
 public function _getQualityGroup( $quality_id = "" )
 {
	$_group = array();
	
	$this->db->reset_select();
	$this->db->select("c.*");
	$this->db->from("t_gn_quality_group a ");
	$this->db->join("t_lk_quality_skill b"," a.Quality_Skill_Id=b.Quality_Skill_Id","LEFT");
	$this->db->join("tms_agent c ","a.Quality_Staff_id=c.UserId","LEFT");
	$this->db->where("a.Quality_Skill_Id", QUALITY_APPROVE );
	$this->db->where("c.profile_id", '11' );

	if ( $quality_id != "" ) {
		$this->db->where("c.quality_id", $quality_id );
	} else {

	}

	
	// login identified not root 
	
	if( $this -> EUI_Session->_get_session('HandlingType')!=USER_ROOT){
		$this -> db -> where("c.quality_id", $this -> EUI_Session -> _get_session('UserId') );
	}
	
	$this->db->order_by("c.full_name", "ASC");
	
	foreach( $this -> db ->get() -> result_assoc() as $rows )
	{
		$_group[$rows['UserId']] = $rows['full_name']; 
	}
	
	return $_group;

 }

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
  $this->db->where_in("a.spv_id",  $gTL);
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
 /*
 * @ def : get layput panel left content 
 * --------------------------------------
 *
 * @ param : - 
 * @ param : -
 */
 
 public function _getQualitySpv()
 {
	$_group = array();
	
	$this->db->reset_select();
	$this->db->select("a.*");
	$this->db->from("tms_agent a ");
	$this->db->where("a.profile_id", 13 );
	
	// login identified not root 
	
	$this->db->order_by("a.UserId", "ASC");
	
	foreach( $this -> db ->get() -> result_assoc() as $rows )
	{
		$_group[$rows['UserId']] = $rows['full_name']; 
	}
	
	return $_group;

 }



 
/*
 * @ def : get layput panel left content 
 * --------------------------------------
 *
 * @ param : - 
 * @ param : -
 */
  
  
public function _getRecord()
{
	$count = 0; 
	
	// get campaign outbound 
	
	$CampaignOutbound = $this -> M_SetCampaign -> _getCampaignGoals(2);
	
	$this -> db -> select("COUNT(a.CustomerId) as jumlah", FALSE);
	$this -> db -> from("t_gn_assignment a ");
	$this -> db -> join("t_gn_customer b ","a.CustomerId=b.CustomerId","LEFT");
	$this -> db -> join("t_gn_campaign c", "b.CampaignId=c.CampaignId","LEFT");
	$this -> db -> join("tms_agent d", "a.AssignSelerId=d.UserId","LEFT");
	$this -> db -> join("t_gn_quality_assignment e ", "a.CustomerId = e.Assign_Data_Id","LEFT");
	$this -> db -> where("e.Assign_Data_Id IS NULL");
	
	// get all data closing 
	
	
	$arr_sale = $this -> M_QtyScoring -> Sale();
	
	if( count($arr_sale) ){
		$this->db->where_in("b.CallReasonId", $arr_sale);
	} else {
		$this->db->where_in("b.CallReasonId", array("NULL"));
	}
	
	// if campaign ok is Outbound Only 
	
	$this -> db -> where_in("b.CampaignId", array_keys($CampaignOutbound ));
	if( $this -> URI->_get_have_post('CampaignId'))
	{
		$this -> db -> where_in("b.CampaignId", $this -> URI->_get_array_post('CampaignId'));	
	}

	if ( _get_have_post("atmid") != "" ) {	
		$this->db-> where_in("a.AssignSpv", array(_get_have_post("atmid")));
	}
	
	
	/* if start_date */
	
	if( _get_have_post('start_date') 
		AND _get_have_post('end_date') )
	{
		$this->db->having("PolicySalesDate>='{$out->get_value('start_date','StartDate')}'","", FALSE);
		$this->db->having("PolicySalesDate<='{$out->get_value('end_date','EndDate')}'","", FALSE);
	}
	
		
	/* if start_date */
	
	if( _get_have_post('start_duration') 
		AND _get_have_post('end_duration') )
	{
		$this->db->having("TalkTime>='{$out->get_value('start_duration','intval')}'","", FALSE);
		$this->db->having("TalkTime<='{$out->get_value('end_duration','intval')}'","", FALSE);
	}
	
	
	if( $rows = $this -> db -> get() -> result_first_assoc() ){
		$count = $rows['jumlah'];
	}
	
	return $count;
}


 
/*
 * @ def : get layput panel left content 
 * --------------------------------------
 *
 * @ param : - 
 * @ param : -
 */
  
  
public function _getPage()
{
	$Records = $this -> _getRecord();
	$Pages   = ceil($Records /$this -> perpage);
	$ul_array = array();
	
	for( $i = 1;  $i<=$Pages; $i++){	
		$_counter = $i;
		$ul_array[$i]= $_counter;	
	}
	return array(
		'records' => $Records,
		'pages' =>	$ul_array
	);
}
 

 
 
/*
 * @ def : get layput panel left content 
 * --------------------------------------
 *
 * @ param : - 
 * @ param : -
 */
  
  public function _getDataByChecked( $out = null )
{
	if( !$out->fetch_ready() ){
		return array();
	}

// ------------------------------------------------------------------	
	$array_result_assign = array();
	
// ---------------------------------------------------------------	
	$obClass  =& get_class_instance('M_SetCampaign');
	$objScore =& get_class_instance('M_QtyScoring');
	
	$arr_outbound = $obClass->_getCampaignGoals( OUTBOUND_CALL );

/**
 * /*
select 
f.CampaignName as CampaignName ,
b.Recsource as Recsource , 
b.CustomerFirstName as CustomerName , 
c.code_user as AgentId , 
d.code_user as SPVId , 
e.CallReasonDesc as CallReason 
from t_gn_assignment a
inner join t_gn_customer b on a.CustomerId=b.CustomerId
inner join tms_agent c on b.SellerId=c.UserId
left join tms_agent d on c.spv_id=d.UserId
left join t_lk_callreason e on b.CallReasonId=e.CallReasonId
inner join t_gn_campaign f on b.CampaignId=f.CampaignId
where a.AssignLeader in(31,32)
and e.CallReasonId between 44 and 107
and e.CallReasonId not in(99)
group by a.CustomerId;
*/

// ----------- outbound only ---------------------------------
	$this->db-> reset_select();	
	$this->db-> select("
			a.CustomerId, 
			b.CustomerNumber, 
			b.CustomerFirstName, 
			e.CallReasonDesc as CallStatus , 
			f.CampaignName, 
			c.init_name as AgentName, 
			d.init_name as Supervisor,	
			g.Assign_Data_Id,
			(select TOP 1 max(a.start_time) from cc_recording a where a.assignment_data=b.CustomerId) as CallDate,
			(SELECT CASE WHEN sum(a.duration) IS NULL THEN 0 ELSE sum(a.duration) END FROM cc_recording a WHERE a.assignment_data=b.CustomerId ) as TalkTime ", 
	FALSE);
	
	$this->db-> from("t_gn_assignment a ");
	$this->db-> join("t_gn_customer b ","a.CustomerId=b.CustomerId","INNER");
	$this->db-> join("tms_agent c", "b.SellerId=c.UserId","INNER");
	$this->db-> join("tms_agent d", "c.spv_id=d.UserId","LEFT");
	$this->db-> join("t_lk_callreason e", "b.CallReasonId=e.CallReasonId","INNER");
	$this->db-> join("t_gn_campaign f", "b.CampaignId=f.CampaignId","INNER");
	$this->db-> join("t_gn_quality_assignment g ", "a.CustomerId = g.Assign_Data_Id","LEFT");

	$this->db->where("g.Assign_Data_Id IS NULL");
	//$this->db-> where("e.CallReasonId", '13' );
	
	if ( _get_have_post("CustomerName") != "" ) {
		$this->db->like("b.CustomerFirstName", _get_post('CustomerName'), 'both');
	}	

	if ( _get_have_post("SPVId") != "" ) {	
		$SPVId = $out->get_array_value('SPVId');
		$SPVId = $SPVId[0];
		// $this->db-> where("a.AssignSpv", $SPVId);
		// edit irul
		$this->db-> where("c.spv_id", $SPVId);
		// tutup edit irul
	}	
	
	if ( _get_have_post("AgentId") != '' ) {
		$AgentId = $out->get_array_value("AgentId");
		$AgentId = $AgentId[0];
		$this->db-> where("c.UserId", $AgentId);
	}
	
	if ( _get_have_post("CallReasonId") != '' ) {
		$CallReasonId_Data = $out->get_value("CallReasonId");
		$this->db-> where("e.CallReasonId", $CallReasonId_Data);
	}
	
	

	/* get all data closing **/
	
	
	
	$this ->db->where_in("b.CampaignId", array_keys($arr_outbound));
	
	if( _get_have_post('CampaignId') ){
		$this->db->where_in("f.CampaignId", $out->get_array_value('CampaignId'));	
	}
	
	/* if start_date */
	
	if( _get_have_post('start_date') 
		AND _get_have_post('end_date') )
	{
		// $this->db->having("PolicySalesDate>='{$out->get_value('start_date','StartDate')}'","", FALSE);
		// $this->db->having("PolicySalesDate<='{$out->get_value('end_date','EndDate')}'","", FALSE);
		
		$this->db->where("b.CustomerUpdatedTs>='{$out->get_value('start_date','StartDate')}'","", FALSE);
		$this->db->where("b.CustomerUpdatedTs<='{$out->get_value('end_date',  'EndDate')}'","", FALSE);
	}
	
	/* if start_date */
	
	if( _get_have_post('start_duration') 
		AND _get_have_post('end_duration') )
	{
		$this->db->having("TalkTime>={$out->get_value('start_duration','intval')}","", FALSE);
		$this->db->having("TalkTime<={$out->get_value('end_duration','intval')}","", FALSE);
	}
	
	
	// ---------- set order by 
	
  if( _get_have_post("orderby") ){
	 $this->db->order_by( $out->get_value("orderby"), $out->get_value("type"));
  } else {
	 $this->db->order_by("a.CustomerId", "ASC");
  }
  
  //-- debug to show list quary : $this->db->print_out();  ----------------
 	//echo $this->db->print_out();
   //print_r($out->get_array_value('atmId')) ;
	
	
   $rs = $this->db->get();
//    echo "<pre>";
//    var_dump($this->db->last_query());die();
   if( $rs->num_rows() > 0 ){
		$array_result_assign= (array)$rs->result_assoc();
   }
 

  return  (array)$array_result_assign;

	

	
 }
 
  
/*
 * @ def : get layput panel left content 
 * --------------------------------------
 *
 * @ param : - 
 * @ param : -
 */
  
 public function _getDataByAmount()
 {
	return $this -> _getRecord();
 }

 
/*
 * @ def : get layput panel left content 
 * --------------------------------------
 *
 * @ param : AssignId (ARRAY);
 * @ param : QualityStaffId ( ARRAY)
 */
 // $AssignId = null , $QualityStaffId = null 
 
 public function _setAssignByChecked( $out= null  )
{
 
 
 if( !$out->fetch_ready() ){
	return FALSE;
 }
	
// ----------------------------------------------------------------------------------------------
	$CustomerId = (array)$out->get_array_value('CustomerId');
	$QualityStaffId = $out->get_value('SPVId');
// -----------------------------------------------------------------------------
	
 if( count($CustomerId) == 0  OR  count($QualityStaffId) == 0 ){
	 return FALSE;
 }	
 
 // -- next 
 $total_data = 0;
 
 $jumlah_data = count($CustomerId);
 $jumlah_user = count($QualityStaffId);
 
// -------- jika jumlah user lebih besar dari jumlah data yang dibagi  
 if( $jumlah_user > $jumlah_data ){
	return false; 
 }
 
// ----------------------- next process -----------------------------------
 
 $jumlah_per_staff_quality = (INT)(($jumlah_data)/($jumlah_user));

	if( $jumlah_per_staff_quality ) 
 {
	$start = 1; $arr_list_assign = array();
	for( $user = 0;  $user < $jumlah_user; $user++)
	{
		$offset = ( (($start)-1) * $jumlah_per_staff_quality);
		$arr_list_assign[$QualityStaffId] = array_slice($CustomerId, $offset, $jumlah_per_staff_quality);
		$start++;
	}
	
	// ------------------	then set its ----------------------------------------------
	
	 if( is_array($arr_list_assign) AND count($arr_list_assign) > 0 )
		 foreach( $arr_list_assign as $Quality_Staff_Id => $values ) 
	{
		$total_data += $this->_setAssignment($Quality_Staff_Id, $values );	
	}	
 }
	

 /// --- expose ---
 
  return (int)$total_data;
  
  
}

/*
 * @ def : get layput panel left content 
 * --------------------------------------
 *
 * @ param : AssignId (ARRAY);
 * @ param : QualityStaffId ( ARRAY)
 */
 
 private function _setAssignment( $Quality_Staff_Id = null, $Assign_Data_Id = null )
{
	if( is_null($Quality_Staff_Id) OR is_null($Assign_Data_Id))  {
		return 0; 
	}
	 
// --- next process  ---------------------
	 
	$total_data = 0;
	foreach( $Assign_Data_Id AS $key => $CustomerId )
	{
		$this->db->reset_select();




		if ( _get_session("HandlingType") == USER_QUALITY || 
			 _get_session("HandlingType") == USER_ROOT || 
			 _get_session("HandlingType") == USER_ADMIN ) {
			$this->db->set('SPV_Id',$Quality_Staff_Id);
			$this->db->set('Assign_Data_Id' , $CustomerId);
			$this->db->set('Assign_Create_By', _get_session('UserId'));
			$this->db->set('Assign_Create_Ts',date('Y-m-d H:i:s'));
			$this->db->insert('t_gn_quality_assignment');
		} 

			
		
		if( $this->db->affected_rows() > 0 ) {
			// ------------ loger statement --------------------------------------
			// -------- update data customer if process data assignment ----
			$this->_setQualityStatusCustomer($CustomerId, $Quality_Staff_Id);
			$total_data++;
		}
	}
	
	return (int)$total_data;
 }
 
// ------------- properties  
/* private function set Data Reason ID On T_gn _customer with QA Status COde 505 .*/
	
 private function _setQualityStatusCustomer( $CustomerId  = 0, $QualityStaffId = 0 )
{

 $obQty =& get_class_instance('M_SetResultQuality');
 $CallReasonQue = $obQty->_getQualityStatusByCode(505); // pending status 
 if( !$CallReasonQue){
	 return FALSE;
 }
 
// ---- data yang di bagikan bisa juga sudah ada status nya --------------- 
// -----------------------------------------------------------------
 
 $cond = 0;
 $this->db->reset_select();
 $this->db->select("a.CustomerId, b.CallReasonQue", FALSE);
 $this->db->from("t_gn_assignment a");
 $this->db->join("t_gn_customer b", "a.CustomerId=b.CustomerId", "LEFT");
 $this->db->where("a.CustomerId", $CustomerId);
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ) 
	 foreach( $rs->result_assoc() as $rows ) 
{
	
// --------- jika status sudah isi <> 99 ----------------- 
  $row = new EUI_Object( $rows );
  if( !is_null($CallReasonQue) 
	AND !in_array($CallReasonQue, array(99) ) ) 
 {
	$CallReasonQue = $row->get_value('CallReasonQue', 'intval'); 	
 }
 
  if( $row->fetch_ready() )
 {
	 $this->db->reset_write();
	 $this->db->set("CallReasonQue",$CallReasonQue);
	 $this->db->set("QueueId", $QualityStaffId);
	 $this->db->set("QA_UpdateTs", date('Y-m-d H:i:s'));
	 $this->db->where("CustomerId", $row->get_value('CustomerId','intval'));
	 if( $this->db->update("t_gn_customer") ) {
		$cond++;
	 }
	 
  }
 }
 
 return $cond;
} 

 
/*
 * @ def : get layput panel left content 
 * --------------------------------------
 *
 * @ param : $AssignSizeData (INT);
 * @ param : QualityStaffId ( ARRAY)
 */
 
 public function _setAssignByAmount( $out = null )
{
 if( !$out->fetch_ready() ){
	return FALSE;
 }

// -------- next ------------------------------------------------------ 
 $AssignSizeData = (int)$out->get_value('AssignSizeData');
 $AssignTotalData = (int)$out->get_value('AssignTotalData');
 $QualityStaffId = (array)$out->get_array_value('QualityStaffId');
 
 
 if( $AssignSizeData == 0 OR count($QualityStaffId) == 0 ){
	 return FALSE;
 }
 
// --------- jika data yang di distribute lebih besar daripada data yang tersedia 
if( $AssignSizeData > $AssignTotalData ){
	return FALSE;
} 

// -------- next ------------------------------------------------------ 
 
$assign_array = array(); 
$List_data = (array)$this->_getDataByChecked( $out );

if( count($List_data) == 0  ){
  return FALSE;	
}	
	
// -------- next ------------------------------------------------------ 
 $i = 0;
 foreach( $List_data as $key => $rows ) {
	$row = new EUI_Object( $rows );
	$assign_array[$i] = $row->get_value('CustomerId');
	$i++;
 }

 if( count($assign_array) == 0  ){
	return false;	
 }	 
 
  
// -------- next ------------------------------------------------------ 
 $total_data = 0;
 $CustomerId = array_slice($assign_array, 0, $AssignSizeData);
 $jumlah_data = count($CustomerId);
 $jumlah_user = count($QualityStaffId);
 $jumlah_per_staff_quality = ( $jumlah_user ?  (INT)(($jumlah_data)/($jumlah_user)) : 0 );
 
// -------------- invalid distribute -----------------
if( $jumlah_user > $jumlah_data  ){
	return FALSE;
} 

 if( $jumlah_per_staff_quality == 0 ){
	return false;	
 }	 
 
 // -------- next ------------------------------------------------------
  $start = 1; $list_assign = array();
 for( $user = 0;  $user < $jumlah_user; $user++) {
	$offset = ((($start)-1) * $jumlah_per_staff_quality);
	$list_assign[$QualityStaffId[$user]] = array_slice($CustomerId, $offset, $jumlah_per_staff_quality);
	$start++;
 }


 // ------------ next set assignment ------------- 
 
 foreach( $list_assign as $Quality_Staff_Id => $rows ) {
	$total_data += $this->_setAssignment( $Quality_Staff_Id, $rows);	
 }

 
	return (int)$total_data;
}




// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
 
function _select_page_quality_unassign_data( $out, $cond = false)
{

 if( !$out->fetch_ready() ){
	return array();
 }

// ------------------------------------------------------------------	
 
 $array_result_assign = array();
 
 $this->db->reset_select();
 
// ------------------------------------------------------------------
if( $cond == true) { 
  $this->db->select("a.Id as QualityAssignId", FALSE);
} 
else {
  $this->db->select("	
	a.Id as QualityAssignId,
	e.CampaignDesc as CampaignName,
	c.CustomerFirstName as CustomerFirstName,
	c.CustomerDOB as CustomerDOB,
	d.full_name as QualityStaff,
	c.QA_UpdateTs as QualityUpdateTs,
	(select ps.AproveName from t_lk_aprove_status ps where ps.ApproveId = c.CallReasonQue) as  QualityStatus,
	(select tr.CallReasonDesc from t_lk_callreason tr where tr.CallReasonId=c.CallReasonId ) as CallResultId,
	(select ts.init_name from tms_agent ts where ts.UserId = b.AssignSelerId ) as AgentId,
	(select ts.init_name from tms_agent ts where ts.UserId = b.AssignLeader ) as Supervisor,
	(select SUM(cr.duration) from cc_recording cr where cr.assignment_data=c.CustomerId) as Duration,
	(select pc.PolicySalesDate from t_gn_policyautogen pt  
	inner join t_gn_policy pc on pt.PolicyNumber=pc.PolicyNumber 
	where pt.CustomerId = c.CustomerId limit 1 ) as SalesDate", FALSE);
}

 $this->db->from("t_gn_quality_assignment a ");
 $this->db->join("t_gn_assignment b ","a.Assign_Data_Id=b.CustomerId", "LEFT");
 $this->db->join("t_gn_customer c ","b.CustomerId=c.CustomerId", "LEFT");
 $this->db->join("tms_agent d ","a.Quality_Staff_Id=d.UserId", "LEFT");
 $this->db->join("t_gn_campaign e ","c.CampaignId=e.CampaignId", "LEFT");
 
 
 $CampaignId = 0;
 
// ---------- filter --------------------

 if( _get_have_post('qty_from_campaign_id') 
	AND $out->get_array_value('qty_from_campaign_id') > 0  )
 {
	$CampaignId = $out->get_array_value('qty_from_campaign_id');	
 }
 
 $this->db->where_in("c.CampaignId", $CampaignId);

 if ( _get_session("HandlingType") == USER_QUALITY_HEAD ) {
	 $this->db->where_in("d.quality_id", _get_session("UserId") );
 } else {

 }

 
// --------------------------------------------------------------------------
 
 if( _get_have_post('qty_form_user_list') 
	AND $out->get_array_value('qty_form_user_list') > 0  )
 {
	$this->db->where_in("a.Quality_Staff_Id", $out->get_array_value('qty_form_user_list'));	
 }
 
//----------------------------------------------------------------------
 
 if( _get_have_post('qty_status_id') 
	AND $out->get_array_value('qty_status_id') > 0  )
 {
	$this->db->where_in("c.CallReasonQue", $out->get_array_value('qty_status_id'));		
 }
 
 
 //----------------------------------------------------------------------
 
 if( _get_have_post('qty_call_start_date') 
	AND _get_have_post('qty_end_start_date') )
 {
	 
	$this->db->having("SalesDate>='". $out->get_value('qty_call_start_date','StartDate') ."'", "", false);
	$this->db->having("SalesDate<='". $out->get_value('qty_end_start_date','EndDate') ."'", "", false);
 }
 
 // ----------- set order -------------------------
	
 if( _get_have_post("orderby") ){
	$this->db->order_by($out->get_value("orderby"), $out->get_value("type") );
 } else {
	$this->db->order_by("QualityAssignId", "DESC");
 }
 
// echo $this->db->print_out();
 // ----------------------------------------------
 
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ){
	$array_result_assign = (array)$rs->result_assoc(); 
 }	 
  return  (array)$array_result_assign;
  
}


// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
 

 function _set_row_quality_unassignment_data( $out )
{ 
  
  $arr_list_data = array();
  
  if( !is_object($out) OR !$out->fetch_ready() ){
	  return false;
  }
  
 $tot_qty = $out->get_value('qty_user_quantity', 'intval');
 if( !$tot_qty ){
	 return false;
 }
 
// ---------------------------------------------------------------------------------
 
  if( $out->get_value('qty_user_action') == 1 )
  {
	$arr_row_data = $this->_select_page_quality_unassign_data( $out , true); $num = 0 ;
	if( is_array($arr_row_data) ) 
		foreach( $arr_row_data as $k => $row )
	{
		$arr_list_data[$num] = $row['QualityAssignId'];
		$num++;
	}
	
  } else {
	$arr_list_data=(array)$out->get_array_value('QualityAssignId');  
  }	
 
// ------------- jumlah data yang di ambil ----------------------------
  $arr_unsset_quality = array_slice($arr_list_data,0, $tot_qty);
  
  $total_reset = 0 ;
  
  if( is_array($arr_unsset_quality)  ) 
	  foreach( $arr_unsset_quality as $k => $QualityAssignId )
  {
	  $this->_set_row_quality_unassign_loger( $QualityAssignId ); // loger UnAsign Data 
	 // ---------------------------------------------------------------------------------------- 
	  $this->db->reset_write();
	  $this->db->where("Id",$QualityAssignId );
	  if( $this->db->delete("t_gn_quality_assignment") ){
		$total_reset++;	
	  }	  
  }
  
  // ----------- set to loger -------------------------------------
   EventLoger("DEL", array(
		"Un Assignment Data on table [t_gn_quality_assignment].Id :{", json_encode( $arr_unsset_quality),"}")
	);
	
  if( $total_reset > 0 ){
	return true;
  }	 

  return false;
}


// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
 
 protected function _set_row_quality_unassign_loger( $QualityAssignId  = 0  )
{
	
 if( $QualityAssignId == 0 ) { 
	return false;
 }
 
$Output = null;
 
// ------------------ get data refeferen old ---------------------------------------- 

$this->db->reset_select();
$this->db->select("
 ( select pc.PolicyNumber from t_gn_policyautogen pc where pc.CustomerId=b.CustomerId ) as ASG_PolicyNumber,
 ( select cs.CallReasonQue from t_gn_customer cs where cs.CustomerId=b.CustomerId ) as ASG_PrevStatus,
 ( select tms.UserId from tms_agent tms where tms.UserId=a.Quality_Staff_Id) as ASG_QualityStaffId,
 ( select tms.id from tms_agent tms where tms.UserId=a.Quality_Staff_Id) as ASG_QualityStaffCode,
 a.Assign_Data_Id as ASG_QualityDataId,
 a.Assign_Create_Ts as ASG_QualityDateTs,
 'PUL' as ASG_QualityActivityType", FALSE);
 
 $this->db->from("t_gn_quality_assignment  a ");
 $this->db->join("t_gn_assignment b "," a.Assign_Data_Id=b.CustomerId", "INNER");
 $this->db->where("a.Id", $QualityAssignId);
 
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ){
	$Output = new EUI_Object( $rs->result_first_assoc()  );	
 }
 

// -------------- reset data ---------------------------------
 
 if( !is_object($Output) OR !$Output->fetch_ready() ){
	return false; 
 }
 
 
 
// ------------ next processs  
 $this->db->reset_write();
 $this->db->set("ASG_PolicyNumber",$Output->get_value('ASG_PolicyNumber') ); 
 $this->db->set("ASG_PrevStatus", $Output->get_value('ASG_PrevStatus') ); 
 $this->db->set("ASG_QualityStaffId",$Output->get_value('ASG_QualityStaffId') );
 $this->db->set("ASG_QualityStaffCode",$Output->get_value('ASG_QualityStaffCode') );
 $this->db->set("ASG_QualityDataId",$Output->get_value('ASG_QualityDataId') );
 $this->db->set("ASG_QualityDateTs",$Output->get_value('ASG_QualityDateTs') );
 $this->db->set("ASG_QualityActivityType", $Output->get_value('ASG_QualityActivityType') );
 
 $this->db->set("ASG_QualityCreateTs",date('Y-m-d H:i:s'));
 $this->db->set("ASG_QualityUserId",strtoupper(_get_session('UserId')));
 $this->db->set("ASG_QualityUserCode",strtoupper(_get_session('Username')));
 $this->db->set("ASG_QulityUserLocation",_getIP());

 $this->db->insert("t_gn_quality_loger");
  if( $this->db->affected_rows() >  0 )
 {
	return TRUE;
 } 
 
 return FALSE;
 
}

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
 protected function _set_row_quality_assign_loger( $QualityAssignId = null  )
{
	
 	
 if( $QualityAssignId == 0 ) { 
	return false;
 }
 
$Output = null;
 
// ------------------ get data refeferen old ---------------------------------------- 

$this->db->reset_select();
$this->db->select("
 ( select pc.PolicyNumber from t_gn_policyautogen pc where pc.CustomerId=b.CustomerId ) as ASG_PolicyNumber,
 ( select cs.CallReasonQue from t_gn_customer cs where cs.CustomerId=b.CustomerId ) as ASG_PrevStatus,
 ( select tms.UserId from tms_agent tms where tms.UserId=a.Quality_Staff_Id) as ASG_QualityStaffId,
 ( select tms.id from tms_agent tms where tms.UserId=a.Quality_Staff_Id) as ASG_QualityStaffCode,
 a.Assign_Data_Id as ASG_QualityDataId,
 a.Assign_Create_Ts as ASG_QualityDateTs,
 'DIS' as ASG_QualityActivityType", FALSE);
 
 $this->db->from("t_gn_quality_assignment  a ");
 $this->db->join("t_gn_assignment b "," a.Assign_Data_Id=b.CustomerId", "INNER");
 $this->db->where("a.Id", $QualityAssignId);
 
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ){
	$Output = new EUI_Object( $rs->result_first_assoc()  );	
 }
 

// -------------- reset data ---------------------------------
 
 if( !is_object($Output) OR !$Output->fetch_ready() ){
	return false; 
 }
 
 
 
// ------------ next processs  
 $this->db->reset_write();
 $this->db->set("ASG_PolicyNumber",$Output->get_value('ASG_PolicyNumber') ); 
 $this->db->set("ASG_PrevStatus", $Output->get_value('ASG_PrevStatus') ); 
 $this->db->set("ASG_QualityStaffId",$Output->get_value('ASG_QualityStaffId') );
 $this->db->set("ASG_QualityStaffCode",$Output->get_value('ASG_QualityStaffCode') );
 $this->db->set("ASG_QualityDataId",$Output->get_value('ASG_QualityDataId') );
 $this->db->set("ASG_QualityDateTs",$Output->get_value('ASG_QualityDateTs') );
 $this->db->set("ASG_QualityActivityType", $Output->get_value('ASG_QualityActivityType') );
 
 $this->db->set("ASG_QualityCreateTs",date('Y-m-d H:i:s'));
 $this->db->set("ASG_QualityUserId",strtoupper(_get_session('UserId')));
 $this->db->set("ASG_QualityUserCode",strtoupper(_get_session('Username')));
 $this->db->set("ASG_QulityUserLocation",_getIP());

 $this->db->insert("t_gn_quality_loger");
  if( $this->db->affected_rows() >  0 )
 {
	return TRUE;
 } 
 
 return FALSE;
 
}
// ================================ END CLASS  ========================================================
}

?>