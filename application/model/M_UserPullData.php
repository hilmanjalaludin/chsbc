<?php 
class M_UserPullData extends EUI_Model
{
	

// --------------------------------------------------------------------------------------
/*
 * @ aksess : public 
 */ 
 
 private static $Instance   = null; 
 public static function &Instance()
{
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
}


// --------------------------------------------------------------------------------------
/*
 * @ aksess : public 
 */ 
 
 public function __construct()
{ 
	$this->load->model(array('M_MgtAssignment','M_SysUser'));
 }
 
// --------------------------------------------------------------------------------------
/*
 * @ aksess : protected 
 */ 
 
 
 protected function _event_loger_distribute( $AssignId = 0 , $AssignMode = 'DIS')
{
 $arr_event_loger = array();
 $this->db->reset_select();
 $this->db->select("a.*, b.CustomerId, b.CallReasonId ",FALSE);
 $this->db->from("t_gn_assignment a");
 $this->db->join("t_gn_customer b "," a.CustomerId= b.CustomerId", FALSE);
 $this->db->where("a.AssignId",$AssignId );
 $rs = $this->db->get();
 if( $rs-> num_rows() > 0 ) {
	$arr_event_loger = (array)$rs->result_first_assoc();
 }

// ----- is valid ------------------------------
 $RemoteIp = _getIP();
 
 if( count($arr_event_loger) > 0 )
 {
	$out = new EUI_object( $arr_event_loger );
	
	if( $out->fetch_ready() )
	{

			//edit Rangga cdd dan verif
			$ver_stats=$this->db->get_where('t_gn_ver_status',array('cust_id'=>$out->get_value('CustomerId')))->num_rows();

			if($ver_stats==0){
				$this->db->delete('t_gn_ver_activity',array('cust_id'=>$out->get_value('CustomerId')));
			}
			$this->db->delete('t_gn_cdd',array('CustId'=>$out->get_value('CustomerId')));	
			
			//End Edir Rangga

		$this->db->reset_write();
		$this->db->set("AssignId",$out->get_value('AssignId'));
		$this->db->set("CustomerId",$out->get_value('CustomerId'));
		$this->db->set("CallReasonId",(int)$out->get_value('CallReasonId')); 
		$this->db->set("AssignAdmin",(int)$out->get_value('AssignAdmin')); 
		$this->db->set("AssignAmgr",(int)$out->get_value('AssignAmgr')); 
		$this->db->set("AssignMgr", (int)$out->get_value('AssignMgr'));
		$this->db->set("AssignSpv", (int)$out->get_value('AssignSpv'));
		$this->db->set("AssignLeader", (int)$out->get_value('AssignLeader'));
		$this->db->set("AssignSelerId", (int)$out->get_value('AssignSelerId'));
		$this->db->set("AssignBlock", (int)$out->get_value('AssignBlock'));
		$this->db->set("AssignMode",  $AssignMode);
		$this->db->set("AssignLocation", $RemoteIp);
		$this->db->set("AssignById", _get_session('UserId'));
		$this->db->set("AssignDate", date('Y-m-d H:i:s'));
		$this->db->insert("t_gn_assignment_log");
	}	
 }
 
  return TRUE;
  
 }
 
// --------------------------------------------------------------------------------------
/*
 * @ aksess : protected 
 */ 
 
 protected function _set_row_update_assign( $arr_assign = null, $UserId = 0, $Level = 0 )
{
  $tot_assign = 0; 
 //-------- manager -------------------------------------
 
 $objUser =& get_class_instance('M_SysUser');
 $outUser = new EUI_object( $objUser->_getUserDetail( $UserId ) );
 
 
 if( in_array( $Level, array(USER_ROOT)) 
	AND $outUser->fetch_ready() ) 
	foreach( $arr_assign as $k => $rows ) 
 {
	$row = new EUI_object( $rows );
	
	$cond = $this->_event_loger_distribute($row->get_value('AssignId'), 'PULL');
	if( $cond )
	{
		$this->db->reset_write();
		$this->db->where('AssignId', (int)$row->get_value('AssignId'));
		$this->db->set("AssignAdmin", $outUser->get_value('UserId'));
		$this->db->set("AssignAmgr", "NULL",FALSE);
		$this->db->set("AssignMgr", "NULL", false);
		$this->db->set("AssignSpv", "NULL", FALSE);
		$this->db->set("AssignLeader", "NULL", FALSE);
		$this->db->set("AssignSelerId", "NULL", FALSE);
		$this->db->set("AssignDate", date('Y-m-d H:i:s'));
		if( $this->db->update('t_gn_assignment') )
		{
			$this->_event_loger_distribute($row->get_value('AssignId'), 'DIS');
			$tot_assign++;
		}	
	}	
 }
 
 if( in_array( $Level, array(USER_ADMIN)) 
	AND $outUser->fetch_ready() ) 
	foreach( $arr_assign as $k => $rows ) 
 {
	$row = new EUI_object( $rows );
	
	$cond = $this->_event_loger_distribute($row->get_value('AssignId'), 'PULL');
	if( $cond )
	{
		$this->db->reset_write();
		$this->db->where('AssignId', (int)$row->get_value('AssignId'));
		$this->db->set("AssignAdmin", $outUser->get_value('UserId'));
		$this->db->set("AssignAmgr", "NULL",FALSE);
		$this->db->set("AssignMgr", "NULL", false);
		$this->db->set("AssignSpv", "NULL", FALSE);
		$this->db->set("AssignLeader", "NULL", FALSE);
		$this->db->set("AssignSelerId", "NULL", FALSE);
		$this->db->set("AssignDate", date('Y-m-d H:i:s'));
		if( $this->db->update('t_gn_assignment') )
		{
			$this->_event_loger_distribute($row->get_value('AssignId'), 'DIS');
			$tot_assign++;
		}	
	}	
 }
 
 if( in_array( $Level, array(USER_MANAGER)) 
	AND $outUser->fetch_ready() ) 
	foreach( $arr_assign as $k => $rows ) 
 {
	$row = new EUI_object( $rows );
	
	$cond = $this->_event_loger_distribute($row->get_value('AssignId'), 'PULL');
	if( $cond )
	{
		$this->db->reset_write();
		$this->db->where('AssignId', (int)$row->get_value('AssignId'));
		$this->db->set("AssignMgr", (int)$outUser->get_value('UserId'));
		$this->db->set("AssignAmgr", "NULL", FALSE);
		$this->db->set("AssignSpv", "NULL", FALSE);
		$this->db->set("AssignLeader", "NULL", FALSE);
		$this->db->set("AssignSelerId", "NULL", FALSE);
		$this->db->set("AssignDate", date('Y-m-d H:i:s'));
		if( $this->db->update('t_gn_assignment') )
		{
			$this->_event_loger_distribute($row->get_value('AssignId'), 'DIS');
			$tot_assign++;
		}	
	}	
 }
 
 if( in_array( $Level, array(USER_ACCOUNT_MANAGER)) 
	AND $outUser->fetch_ready() ) 
	foreach( $arr_assign as $k => $rows ) 
 {
	$row = new EUI_object( $rows );
	
	$cond = $this->_event_loger_distribute($row->get_value('AssignId'), 'PULL');
	if( $cond )
	{
		$this->db->reset_write();
		$this->db->where('AssignId', (int)$row->get_value('AssignId'));
		$this->db->set("AssignAmgr", (int)$outUser->get_value('UserId'));
		$this->db->set("AssignMgr", (int)$outUser->get_value('mgr_id'));
		$this->db->set("AssignSpv", "NULL", FALSE);
		$this->db->set("AssignLeader", "NULL", FALSE);
		$this->db->set("AssignSelerId", "NULL", FALSE);
		$this->db->set("AssignDate", date('Y-m-d H:i:s'));
		if( $this->db->update('t_gn_assignment') )
		{
			$this->_event_loger_distribute($row->get_value('AssignId'), 'DIS');
			$tot_assign++;
		}	
	}	
 }

 //-------- manager -------------------------------------
 if(in_array( $Level, array(USER_SUPERVISOR)) 
	AND $outUser->fetch_ready() )
	foreach( $arr_assign as $k => $rows  ) 
 { 
	
	$row = new EUI_object( $rows );
	$cond = $this->_event_loger_distribute($row->get_value('AssignId'), 'PULL');
	if( $cond )
	{
		$this->db->reset_write();
		$this->db->where('AssignId',(int)$row->get_value('AssignId'));
		$this->db->set("AssignAmgr",(int)$outUser->get_value('act_mgr'));
		$this->db->set("AssignMgr", (int)$outUser->get_value('mgr_id'));
		$this->db->set("AssignSpv", (int)$outUser->get_value('UserId'));
		$this->db->set("AssignLeader", "NULL", FALSE);
		$this->db->set("AssignSelerId", "NULL", FALSE);
		$this->db->set("AssignDate", date('Y-m-d H:i:s'));
		if( $this->db->update('t_gn_assignment') ){
			$this->_event_loger_distribute($row->get_value('AssignId'), 'DIS');
			$tot_assign++;
		}
	}	
 }
 
//----------- leader --------------------------------------------
	
 if(in_array( $Level, array(USER_LEADER)) 
	AND $outUser->fetch_ready() )
	foreach( $arr_assign as $k => $rows  ) 
 { 
	$row = new EUI_object( $rows );
	
	$cond = $this->_event_loger_distribute($row->get_value('AssignId'), 'PULL');
	if( $cond )
	{
		$this->db->reset_write();
		$this->db->where('AssignId', (int)$row->get_value('AssignId'));
		$this->db->set("AssignAmgr", (int)$outUser->get_value('act_mgr'));
		$this->db->set("AssignMgr", (int)$outUser->get_value('mgr_id'));
		$this->db->set("AssignSpv", (int)$outUser->get_value('spv_id'));
		$this->db->set("AssignLeader", (int)$outUser->get_value('tl_id'));
		$this->db->set("AssignSelerId", "NULL", FALSE);
		$this->db->set("AssignDate", date('Y-m-d H:i:s'));
		if( $this->db->update('t_gn_assignment') ){
			$this->_event_loger_distribute($row->get_value('AssignId'), 'DIS');
			$tot_assign++;
		}
	}	
 }
	
//----------- leader --------------------------------------------
	
 if(in_array( $Level,  array(USER_AGENT_OUTBOUND)) 
	AND $outUser->fetch_ready() )
   	foreach(  $arr_assign as $k => $rows  ) 
 { 
	$row = new EUI_object( $rows );
	$cond = $this->_event_loger_distribute($row->get_value('AssignId'), 'PULL');
	if( $cond )
	{
		$this->db->reset_write();
		$this->db->where('AssignId', (int)$row->get_value('AssignId'));
		$this->db->set("AssignAmgr", (int)$outUser->get_value('act_mgr'));
		$this->db->set("AssignMgr", (int)$outUser->get_value('mgr_id'));
		$this->db->set("AssignSpv", (int)$outUser->get_value('spv_id'));
		$this->db->set("AssignLeader", (int)$outUser->get_value('tl_id'));
		$this->db->set("AssignSelerId", (int)$outUser->get_value('UserId'));
		$this->db->set("AssignDate", date('Y-m-d H:i:s'));
		
		if( $this->db->update('t_gn_assignment') ) {
			$this->_event_loger_distribute($row->get_value('AssignId'), 'DIS');
			$tot_assign++;
		}
	}	
 }
 
//----------- leader --------------------------------------------
 
 if(in_array( $Level, array(USER_AGENT_INBOUND)) AND $outUser->fetch_ready() )
	foreach(  $arr_assign as $k => $rows  ) 
{ 
	$row = new EUI_object( $rows );
	$cond = $this->_event_loger_distribute($row->get_value('AssignId'), 'PULL');
	if( $cond )
	{
		$this->db->reset_write();
		$this->db->where('AssignId', (int)$row->get_value('AssignId'));
		$this->db->set("AssignAmgr", (int)$outUser->get_value('act_mgr'));
		$this->db->set("AssignMgr", (int)$outUser->get_value('mgr_id'));
		$this->db->set("AssignSpv", (int)$outUser->get_value('spv_id'));
		$this->db->set("AssignLeader", (int)$outUser->get_value('tl_id'));
		$this->db->set("AssignSelerId", (int)$outUser->get_value('UserId'));
		$this->db->set("AssignDate", date('Y-m-d H:i:s'));
		if( $this->db->update('t_gn_assignment') ) {
			$this->_event_loger_distribute($row->get_value('AssignId'), 'DIS');
			$tot_assign++;
		}
	}	
 }
 
 return (int)$tot_assign;
	
} 

// --------------------------------------------------------------------------------------
/*
 * @ aksess : public 
 */ 
 
 public function _set_row_pulldata_rata( $out = null )
{
// call object --
/*print_r( $out );
  exit;
  [pull_call_start_date] => 
  [pull_end_start_date] => 
  [pull_from_campaign_id] => 18
  [pull_call_result_id] => 
  [pull_from_user_group] => 
  [pull_form_user_list] => 
  [pull_user_total] => 5
  [pull_user_quantity] => 1
  [pull_user_type] => 1
  [pull_to_user_group] => 4
  [pull_user_mode] => 1
  [pull_user_action] => 1
  [pull_to_user_list] => 53,55
  [AssignId] => 
  */
  
 $objAsg =& get_class_instance('M_MgtAssignment');
 $rowAsg = array();
 
// ------ get on DB  // quantity 
 if( $out->get_value('pull_user_action') == 1 ){
	$rowAsg = $objAsg->_select_page_pulldata( $out, array(
		"a.AssignId",
		"( SELECT count(ts.CallHistoryId) as atempt FROM t_gn_callhistory ts WHERE ts.CustomerId = a.CustomerId AND ts.HistoryType = 0 ) as Atempt"));	
 } 

 
 // Get on selected grid ------------- // checklist data 
 if( $out->get_value('pull_user_action') == 2 ){
	$arr_Asg = $out->get_array_value('AssignId');
	if(is_array($arr_Asg))foreach( $arr_Asg as $k => $AssignId ){
		$rowAsg[] = array('AssignId' => $AssignId);
	}	
 }
 
// --------- next process ---------------------------------------
 
  if( is_array($rowAsg) AND count($rowAsg) == 0 )
 {
	return FALSE;
 }	
  
 // --------- on random ---------------------------
 $Level = $out->get_value('pull_to_user_group');
 $total_dist = & $out->get_value('pull_user_quantity');
 if( $out->get_value('pull_user_mode')== 2) {
	shuffle($rowAsg);
 }
 
 // def data posted by user ---------------------------
    
  $arr_user_avail =& $out->get_array_value('pull_to_user_list');
  $total_user = count( $arr_user_avail );
  $arr_data_avail = array_slice( $rowAsg, 0, $total_dist);
  $total_data_avail = count($arr_data_avail);
  
// -------------- complaintmnet ------------
  
  if( $total_user  > $total_data_avail ){
	return FALSE;
  }
  
// ------- next step ------------------------------------

  $arr_assign_avail = array();
  $total_data_per_user = (int)( $total_user ? ($total_data_avail/$total_user) : 0 );
  if( $total_data_per_user == 0 ){
	return FALSE;
  }	  
  
  
// ---------  next step -------------------------------
  $total = 0;
  $start = 0;
  if( is_array($arr_user_avail) )
	foreach( $arr_user_avail as $key => $UserId )
{
	if( $start == 0  ){
		$offset = 0;
	} else {	
		$offset = ($start * $total_data_per_user );
	}
	
	$row_asg_avail = array_slice($arr_data_avail, $offset, $total_data_per_user);
	if( $this->_set_row_update_assign($row_asg_avail, $UserId, $Level) ){
		$total++;
	}
	
	$start++;
 }
 
 return (int)$total;

 
} 
 
// --------------------------------------------------------------------------------------
/*
 * @ aksess : public 
 */ 
 
 public function _set_row_pulldata_agent( $out = null  ) 
{
// call object --
 /*print_r( $out );
  exit;
  [pull_call_start_date] => 
  [pull_end_start_date] => 
  [pull_from_campaign_id] => 18
  [pull_call_result_id] => 
  [pull_from_user_group] => 
  [pull_form_user_list] => 
  [pull_user_total] => 5
  [pull_user_quantity] => 1
  [pull_user_type] => 1
  [pull_to_user_group] => 4
  [pull_user_mode] => 1
  [pull_user_action] => 1
  [pull_to_user_list] => 53,55
  [AssignId] => 
  */
  	
 $objAsg =& get_class_instance('M_MgtAssignment');
 $rowAsg = array();
 
// ------ get on DB  
 if( $out->get_value('pull_user_action') == 1 ){
	$rowAsg = $objAsg->_select_page_pulldata( $out, array(
		"a.AssignId",
		"( SELECT count(ts.CallHistoryId) as atempt FROM t_gn_callhistory ts WHERE ts.CustomerId = a.CustomerId AND ts.HistoryType = 0 ) as Atempt"));	
 } 

 // Get on selected grid ------------- 
 if( $out->get_value('pull_user_action') == 2 ){
	$arr_Asg = $out->get_array_value('AssignId');
	if(is_array($arr_Asg))foreach( $arr_Asg as $k => $AssignId ){
		$rowAsg[] = array('AssignId' => $AssignId);
	}	
 }
 		
 if( is_array($rowAsg) AND count($rowAsg) == 0 )
 {
	return FALSE;
 }	
  
 // --------- on random ---------------------------
 $Level = $out->get_value('pull_to_user_group');
 $total_dist = & $out->get_value('pull_user_quantity');
 
 
 if( $out->get_value('pull_user_mode')== 2) {
	shuffle($rowAsg);
 }
 
//------------ if data not valid ---------------
 
 $arr_user_avail = array();
 $arr_tots_input = 0;
 $outAgent = $out->get_array_value('pull_to_user_list');
 
 if(is_array($outAgent) )
	foreach( $outAgent as $k => $UsrId )
 {
	$avail_data = (int)$out->get_value("pull_to_user_list_{$UsrId}");
	if( $avail_data )
	{
		$arr_user_avail[$UsrId] = $avail_data;	
		$arr_tots_input +=$avail_data;
	}
 }

// sort array ASC 
 
 asort($arr_user_avail, SORT_ASC);
 if( $arr_tots_input > $total_dist  ){
	return FALSE;	
 }	 
 
// def data posted by user ---------------------------
    
  $total_user = count( $arr_user_avail );
  $arr_data_avail = array_slice( $rowAsg, 0, $total_dist);
  $total_data_avail = count($arr_data_avail);
  
// -------------- complaintmnet ------------
  
  if( $total_user  > $total_data_avail ){
	return FALSE;
  }
  
  
// ---------  next step -------------------------------
  $total = 0;
  $start = 0;
  if( is_array($arr_user_avail) )
	foreach( $arr_user_avail as $UserId => $perpage )
{
	$arr_process = array();
	for( $i = 0; $i<$perpage; $i++){
		$arr_process[$i] = $arr_data_avail[$start];
		$start++;
	}	
	
	if( $this->_set_row_update_assign( $arr_process, $UserId, $Level) ) {
		$total++;
	}
 }
 
 return (int)$total;

}  
 
// ============================== END CLASS ==================================================
}
