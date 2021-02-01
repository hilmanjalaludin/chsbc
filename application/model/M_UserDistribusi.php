<?php 
class M_UserDistribusi extends EUI_Model
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
		$this->db->set("AssignById", _get_session('UserId'));
		$this->db->set("AssignMode",  $AssignMode);
		$this->db->set("AssignLocation", $RemoteIp);
		$this->db->set("AssignDate", date('Y-m-d H:i:s'));
		$this->db->insert("t_gn_assignment_log");
		//echo $this->db->last_query();
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
 
	// ---------  
 	if( in_array( $Level, array(USER_MANAGER)) AND $outUser->fetch_ready() ) {
		foreach( $arr_assign as $k => $rows ) 
	 	{
			$row = new EUI_object( $rows );
			$this->db->reset_write();
			$this->db->where('AssignId', $row->get_value('AssignId'));
			$this->db->set("AssignAmgr", $outUser->get_value('act_mgr'));
			$this->db->set("AssignMgr", $outUser->get_value('mgr_id'));
			$this->db->set("AssignDate", date('Y-m-d H:i:s'));
			$this->db->set("AssignMode", 'DIS');
			if( $this->db->update('t_gn_assignment') )
			{
				$this->_event_loger_distribute($row->get_value('AssignId'), 'DIS');
				$tot_assign++;
			}	
	 	}
	}
 
  	if( in_array( $Level, array(USER_ACCOUNT_MANAGER)) AND $outUser->fetch_ready() ) {
		foreach( $arr_assign as $k => $rows ) 
	 	{
			$row = new EUI_object( $rows );
			$this->db->reset_write();
			$this->db->where('AssignId', $row->get_value('AssignId'));
			$this->db->set("AssignAmgr", $outUser->get_value('act_mgr'));
			$this->db->set("AssignDate", date('Y-m-d H:i:s'));
			$this->db->set("AssignMode", 'DIS');
			if( $this->db->update('t_gn_assignment') )
			{
				$this->_event_loger_distribute($row->get_value('AssignId'), 'DIS');
				$tot_assign++;
			}	
	 	}
	}
 
 	//-------- manager -------------------------------------
 	if(in_array( $Level, array(USER_SUPERVISOR)) AND $outUser->fetch_ready() ) {
		foreach( $arr_assign as $k => $rows  ) 
		{ 
			$row = new EUI_object( $rows );
			$this->db->reset_write();
			$this->db->where('AssignId',$row->get_value('AssignId'));
			$this->db->set("AssignAmgr",$outUser->get_value('act_mgr'));
			$this->db->set("AssignMgr", $outUser->get_value('mgr_id'));
			$this->db->set("AssignSpv", $outUser->get_value('spv_id'));
			$this->db->set("AssignDate", date('Y-m-d H:i:s'));
			$this->db->set("AssignMode", 'DIS');
			if( $this->db->update('t_gn_assignment') )
			{
				$this->_event_loger_distribute($row->get_value('AssignId'), 'DIS');
				$tot_assign++;
			}
		}
	}
 
	//----------- leader --------------------------------------------
 	if(in_array( $Level, array(USER_LEADER)) AND $outUser->fetch_ready() ) {
		foreach( $arr_assign as $k => $rows  ) 
	 	{ 
			$row = new EUI_object( $rows );
			$this->db->reset_write();
			$this->db->where('AssignId', $row->get_value('AssignId'));
			$this->db->set("AssignAmgr", $outUser->get_value('act_mgr'));
			$this->db->set("AssignMgr", $outUser->get_value('mgr_id'));
			$this->db->set("AssignSpv", $outUser->get_value('spv_id'));
			$this->db->set("AssignLeader", $outUser->get_value('tl_id'));
			$this->db->set("AssignDate", date('Y-m-d H:i:s'));
			$this->db->set("AssignMode", 'DIS');
			if( $this->db->update('t_gn_assignment') )
			{
				$this->_event_loger_distribute($row->get_value('AssignId'), 'DIS');
				$tot_assign++;
			}
	 	}
	}
	
	//----------- leader --------------------------------------------
 	if(in_array( $Level,  array(USER_AGENT_OUTBOUND)) AND $outUser->fetch_ready() ) {
   		foreach(  $arr_assign as $k => $rows  ) 
 		{ 
			$row = new EUI_object( $rows );
			$this->db->reset_write();
			$this->db->where('AssignId', $row->get_value('AssignId'));
			$this->db->set("AssignAmgr", $outUser->get_value('act_mgr'));
			$this->db->set("AssignMgr", $outUser->get_value('mgr_id'));
			$this->db->set("AssignSpv", $outUser->get_value('spv_id'));
			$this->db->set("AssignLeader", $outUser->get_value('tl_id'));
			$this->db->set("AssignSelerId", $outUser->get_value('UserId'));
			$this->db->set("AssignDate", date('Y-m-d H:i:s'));
			$this->db->set("AssignMode", 'DIS');
			if( $this->db->update('t_gn_assignment') )
			{
				$this->_event_loger_distribute($row->get_value('AssignId'), 'DIS');
				$tot_assign++;
			}
 		}
 	}
 
	//----------- leader --------------------------------------------
 	if(in_array( $Level, array(USER_AGENT_INBOUND)) AND $outUser->fetch_ready() ) {
		foreach(  $arr_assign as $k => $rows  ) 
		{ 
			$row = new EUI_object( $rows );
			$this->db->reset_write();
			$this->db->where('AssignId', $row->get_value('AssignId'));
			$this->db->set("AssignAmgr", $outUser->get_value('act_mgr'));
			$this->db->set("AssignMgr", $outUser->get_value('mgr_id'));
			$this->db->set("AssignSpv", $outUser->get_value('spv_id'));
			$this->db->set("AssignLeader", $outUser->get_value('tl_id'));
			$this->db->set("AssignSelerId", $outUser->get_value('UserId'));
			$this->db->set("AssignDate", date('Y-m-d H:i:s'));
			$this->db->set("AssignMode", 'DIS');
			if( $this->db->update('t_gn_assignment') )
			{
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
public function _set_row_distribusi_rata( $out = null )
{
	// var_dump( $out ); die();

	// call object --
 	$objAsg =& get_class_instance('M_MgtAssignment');
 	$rowAsg = array();
 
	// ------ get on DB  
 	if( $out->get_value('dis_user_action') == 1 ){
 		$conds1 = " YEAR(NOW()) ";
 		if( QUERY == 'mssql') {
 			$conds1 = " YEAR(getdate()) ";
 		}

		$rowAsg = $objAsg->_select_page_distribute( $out, array("a.AssignId", 
		"(SELECT count(ts.CallHistoryId) as atempt FROM t_gn_callhistory ts WHERE ts.CustomerId = a.CustomerId AND ts.HistoryType = 0 ) as Atempt", 
		"({$conds1}-YEAR(b.CustomerDOB)) as Age"));	
 	} 

 	// Get on selected grid ------------- 
 	if( $out->get_value('dis_user_action') == 2 ){
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
	$Level = $out->get_value('dis_user_group');
	$total_dist = & $out->get_value('dis_user_quantity');
	if( $out->get_value('dis_user_mode')== 2) {
		shuffle($rowAsg);
	}
 
 	// def data posted by user ---------------------------
 	$arr_user_avail =& $out->get_array_value('dis_user_list');
  	$total_user = count( $arr_user_avail );
  	$arr_data_avail = array_slice( $rowAsg, 0, $total_dist);
  	$total_data_avail = count($arr_data_avail);
  
	// -------------- complaintmnet ------------
  	if( $total_user  > $total_data_avail ){
		return FALSE;
  	}
  
	// ------- next step ------------------------------------
  	$arr_assign_avail = array();
  	$total_data_per_user = (int)( $total_data_avail/$total_user );
  	if( $total_data_per_user == 0 ){
		return FALSE;
  	}	  
  
	// ---------  next step -------------------------------
  	$total = 0;
  	$start = 0;
	if( is_array($arr_user_avail) ) {

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
	}
 	return (int)$total; 
} 
 
// --------------------------------------------------------------------------------------
/*
 * @ aksess : public 
 */ 
public function _set_row_distribusi_agent( $out = null  ) 
{
	// call object --
 	$objAsg =& get_class_instance('M_MgtAssignment');
 	$rowAsg = array();
	// ------ get on DB  
	if( $out->get_value('dis_user_action') == 1 ) {
		$conds1 = " YEAR(NOW()) ";
 		if( QUERY == 'mssql') {
 			$conds1 = " YEAR(getdate()) ";
 		}
		$rowAsg = $objAsg->_select_page_distribute( $out, array(
			"a.AssignId", 
			"(SELECT count(ts.CallHistoryId) as atempt FROM t_gn_callhistory ts WHERE ts.CustomerId = a.CustomerId AND ts.HistoryType = 0 ) as Atempt", 
			"({$conds1}-year(b.CustomerDOB)) as Age"));	
	} 

 	// Get on selected grid ------------- 
	if( $out->get_value('dis_user_action') == 2 ){
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
 	$Level = $out->get_value('dis_user_group');
 	$total_dist = & $out->get_value('dis_user_quantity');
 
	if( $out->get_value('dis_user_mode')== 2) {
		shuffle($rowAsg);
	}
 
	//------------ if data not valid ---------------
 	$arr_user_avail = array();
 	$arr_tots_input = 0;
 	$outAgent = $out->get_array_value('dis_user_list');
 	if(is_array($outAgent) )
	{
		foreach( $outAgent as $k => $UsrId )
	 	{
			$avail_data = (int)$out->get_value("dis_user_list_{$UsrId}");
			if( $avail_data )
			{
				$arr_user_avail[$UsrId] = $avail_data;	
				$arr_tots_input +=$avail_data;
			}
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
	{	foreach( $arr_user_avail as $UserId => $perpage )
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
	}
 	return (int)$total;

}

/*** SECTION PDS *****?
/**
 * (F)_setRowDistribusiRataPds
 * @param Object $out
 */
public function _setRowDistribusiRataPds( $out = null )
{
    // call object --
    $objAsg =& get_class_instance('M_MgtAssignment');
    $rowAsg = array();

    $conds1 = " YEAR(NOW()) ";
    if( QUERY == 'mssql') {
        $conds1 = " YEAR(getdate()) ";
    }

    if( $out->get_value('dis_user_action') == 1 ){
        #var_dump( $out ); die();
        $rowAsg = $objAsg->_select_page_distributePDS( $out, array("a.AssignId", "b.CallReasonId", "a.AssignSelerId",
        /**"(SELECT count(ts.CallHistoryId) as atempt FROM t_gn_callhistory ts WHERE ts.CustomerId = a.CustomerId AND ts.HistoryType = 0 ) as Atempt",**/ 
        "({$conds1}-YEAR(b.CustomerDOB)) as Age", "a.CustomerId", "b.CustomerMobilePhoneNum", "b.CustomerHomePhoneNum", "b.CustomerWorkPhoneNum", "b.CampaignId")); 
    } 

    // ------------- get on DB  BY CHECKED
    if( $out->get_value('dis_user_action') == 2 ){
       /* $arr_Asg = $out->get_array_value('AssignId');
        if(is_array($arr_Asg))foreach( $arr_Asg as $k => $AssignId ){
            $rowAsg[] = array('AssignId' => $AssignId);
        }*/   
        $rowAsg = $objAsg->_select_page_distributePDS( $out, array("a.AssignId", "b.CallReasonId", "a.AssignSelerId",
        /**"(SELECT count(ts.CallHistoryId) as atempt FROM t_gn_callhistory ts WHERE ts.CustomerId = a.CustomerId AND ts.HistoryType = 0 ) as Atempt",**/ 
        "({$conds1}-YEAR(b.CustomerDOB)) as Age", "a.CustomerId", "b.CustomerMobilePhoneNum", "b.CustomerHomePhoneNum", "b.CustomerWorkPhoneNum", "b.CampaignId")); 
    }

	// var_dump($rowAsg); die();
    // --------- next process ---------------------------------------
    if( is_array($rowAsg) AND count($rowAsg) == 0 )
    {
        return FALSE;
    }   
  
    $Level = $out->get_value('dis_user_group');
    $total_dist = & $out->get_value('dis_user_quantity'); 

    // --------- on random ---------------------------
    if( $out->get_value('dis_user_mode')== 2) {
        shuffle($rowAsg);
    }
 
    // def data posted by user ---------------------------
    $arr_user_avail =& $out->get_array_value('dis_user_list');
    $total_user       = count( $arr_user_avail );
    $arr_data_avail   = array_slice( $rowAsg, 0, $total_dist); 
                     // array_slice(array, index, jml_yg_d_ambil)
    $total_data_avail = count($arr_data_avail);
  	#var_dump( $out->get_value('dis_user_action') );die();
    
    // -------------- complaintmnet ------------
    #if( $total_user  > $total_data_avail ){
    #   return FALSE;
    #}
  
    // ------- next step ------------------------------------
    #$arr_assign_avail = array();
    #total_data_per_user = (int)( $total_data_avail/$total_user );
    #if( $total_data_per_user == 0 ){
    #   return FALSE;
    #}    
  
    // add validation
    if( $total_data_avail <= 0 ) {
        return FALSE;
    }
    $objUser =& get_class_instance('M_SysUser');
    $outUser = new EUI_object( $objUser->_get_user( _get_session('UserId') ));
    $Level   = $outUser->get_value('handling_type');
    #var_dump( $outUser );die();

    // ---------  next step -------------------------------
    $total = 0;
    $start = 0;
    if( is_array($arr_data_avail) ) {
        for ($i=0; $i < $total_data_avail; $i++) { 
            if( $start == 0  ) {
                $offset = 0;
            } else {    
                $offset = $start;
            }
            $row_asg_avail = array_slice($arr_data_avail, $offset, 1);
                          // array_slice(array, index, jml_yg_d_ambil)
            #var_dump( $row_asg_avail );die();
            if( $this->_set_row_update_assign_PDS($row_asg_avail, _get_session('UserId'), $Level, $out) ){
                $total++;
            }
            $start++;
        }
    }

    /*if( is_array($arr_user_avail) ) {

        foreach( $arr_user_avail as $key => $UserId )
        {
            if( $start == 0  ){
                $offset = 0;
            } else {    
                $offset = ($start * $total_data_per_user );
            }
            $row_asg_avail = array_slice($arr_data_avail, $offset, $total_data_per_user);
                          // array_slice(array, index, jml_yg_d_ambil)
                            
            if( $this->_set_row_update_assign_PDS($row_asg_avail, $UserId, $Level) ){
                $total++;
            }
            $start++;
        }
    }*/

    return (int)$total; 
}

/**
 * (F) _set_row_update_assign_PDS
 * @param Array     $arr_assign [Data]
 * @param Int       $UserId
 * @param Array     $Level
 */
protected function _set_row_update_assign_PDS( $arr_assign = null, $UserId = 0, $Level = 0, $out )
{
    $tot_assign = 0; 
    $objUser =& get_class_instance('M_SysUser');
	$objAsg =& get_class_instance('M_MgtAssignment');
    // $outUser = new EUI_object( $objUser->_getUserDetail( $UserId ) );
    $outUser = new EUI_object( $objUser->_get_user( $UserId ) );
 
    // ---------
    if( in_array( $Level, array(USER_MANAGER)) AND $outUser->fetch_ready() ) {
    	var_dump( "USER_MANAGER" );die();
        return FALSE;  // TESTING
        foreach( $arr_assign as $k => $rows ) 
        {
            $row = new EUI_object( $rows );
            $this->db->reset_write();
            $this->db->where('AssignId', $row->get_value('AssignId'));
            $this->db->set("AssignAmgr", $outUser->get_value('act_mgr'));
            $this->db->set("AssignMgr", $outUser->get_value('mgr_id'));
            $this->db->set("AssignDate", date('Y-m-d H:i:s'));
            $this->db->set("AssignMode", 'DIS');
            if( $this->db->update('t_gn_assignment') )
            {
                $this->_event_loger_distribute($row->get_value('AssignId'), 'DIS');
                $tot_assign++;
            }   
        }
    }
 
    if( in_array( $Level, array(USER_ACCOUNT_MANAGER)) AND $outUser->fetch_ready() ) {
    	var_dump( "USER_ACCOUNT_MANAGER" );die();
        return FALSE;  // TESTING
        foreach( $arr_assign as $k => $rows ) 
        {
            $row = new EUI_object( $rows );
            $this->db->reset_write();
            $this->db->where('AssignId', $row->get_value('AssignId'));
            $this->db->set("AssignAmgr", $outUser->get_value('act_mgr'));
            $this->db->set("AssignDate", date('Y-m-d H:i:s'));
            $this->db->set("AssignMode", 'DIS');
            if( $this->db->update('t_gn_assignment') )
            {
                $this->_event_loger_distribute($row->get_value('AssignId'), 'DIS');
                $tot_assign++;
            }   
        }
    }
 
 	/*SPV*/
    if(in_array( $Level, array(USER_SUPERVISOR)) AND $outUser->fetch_ready() ) {
        foreach( $arr_assign as $k => $rows  ) 
        {
			$rows["AssignSession"] = date('YmdHi');
            $row = new EUI_object( $rows );
            #var_dump( $arr_assign ); die();
            $this->db->reset_write();
            $this->db->set("CustomerId",$row->get_value('CustomerId'));
            $this->db->set("FlagPds",0);
            // $this->db->set("CampaignId",$row->get_value('CampaignId'));
            $this->db->set("CampaignId",$out->get_value('dis_campaign_name_pds'));
            $this->db->set("CustomerMobilePhoneNum",$row->get_value('CustomerMobilePhoneNum'));
            $this->db->set("CustomerHomePhoneNum",$row->get_value('CustomerHomePhoneNum'));
            $this->db->set("CustomerWorkPhoneNum",$row->get_value('CustomerWorkPhoneNum'));
			$this->db->set("AssignDatePDS",date('Y-m-d H:i:s'));
			$this->db->set("AssignSession",$row->get_value('AssignSession'));
            $this->db->set("LastCallStatusId",0);
            // $this->db->set("GroupHeadId",$outUser->get_value('cc_agent_id'));
            $res = $this->db->insert('t_gn_customer_pds');

            if ( $res ) {
            	// update flag PDS in Customer
            	$this->db->reset_write();
            	$this->db->where('CustomerId', $row->get_value('CustomerId'));
            	$this->db->set('Flag_Followup', 1);
            	$this->db->set('Flag_Pds', 1);
            	$this->db->update('t_gn_customer');
            	$tot_assign++;
            }

			if($tot_assign){
				$objAsg->_AssignPdsLog($row,$out);
			}
            #var_dump( $this->db->last_query() ); die();

            /*$this->db->where('AssignId',$row->get_value('AssignId'));
            $this->db->set("AssignAmgr",$outUser->get_value('act_mgr'));
            $this->db->set("AssignMgr", $outUser->get_value('mgr_id'));
            $this->db->set("AssignSpv", $outUser->get_value('spv_id'));
            $this->db->set("AssignDate", date('Y-m-d H:i:s'));
            $this->db->set("AssignMode", 'DIS');
            if( $this->db->update('t_gn_assignment') )
            {
                $this->_event_loger_distribute($row->get_value('AssignId'), 'DIS');
                $tot_assign++;
            }*/
        }
    }
 
    if(in_array( $Level, array(USER_LEADER)) AND $outUser->fetch_ready() ) {
        foreach( $arr_assign as $k => $rows  ) 
        { 
            $row = new EUI_object( $rows );
            $this->db->reset_write();
            $this->db->set("CustomerId",$row->get_value('CustomerId'));
            $this->db->set("FlagPds",0);
            // $this->db->set("CampaignId",$row->get_value('CampaignId'));
            $this->db->set("CampaignId",$out->get_value('dis_campaign_name_pds'));
            $this->db->set("CustomerMobilePhoneNum",$row->get_value('CustomerMobilePhoneNum'));
            $this->db->set("CustomerHomePhoneNum",$row->get_value('CustomerHomePhoneNum'));
            $this->db->set("CustomerWorkPhoneNum",$row->get_value('CustomerWorkPhoneNum'));
            $this->db->set("LastCallStatusId",0);
            // $this->db->set("GroupHeadId",$outUser->get_value('cc_agent_id'));
            $res = $this->db->insert('t_gn_customer_pds');
            #var_dump( $this->db->last_query() ); die();

            if ( $res ) {
            	// update flag PDS in Customer
            	$this->db->reset_write();
            	$this->db->where('CustomerId', $row->get_value('CustomerId'));
            	$this->db->set('Flag_Followup', 1);
            	$this->db->set('Flag_Pds', 1);
            	$this->db->update('t_gn_customer');
            	$tot_assign++;
            }

            #var_dump( $this->db->last_query() ); die();

            /*$this->db->where('AssignId',$row->get_value('AssignId'));
            $this->db->set("AssignAmgr",$outUser->get_value('act_mgr'));
            $this->db->set("AssignMgr", $outUser->get_value('mgr_id'));
            $this->db->set("AssignSpv", $outUser->get_value('spv_id'));
            $this->db->set("AssignDate", date('Y-m-d H:i:s'));
            $this->db->set("AssignMode", 'DIS');
            if( $this->db->update('t_gn_assignment') )
            {
                $this->_event_loger_distribute($row->get_value('AssignId'), 'DIS');
                $tot_assign++;
            }*/
        }
    }

    /*ADMIN*/
    if(in_array( $Level, array(USER_ADMIN)) AND $outUser->fetch_ready() ) {
        foreach( $arr_assign as $k => $rows  ) 
        {
			$rows["AssignSession"] = date('YmdHi');
            $row = new EUI_object( $rows );
            $this->db->reset_write();
            $this->db->set("CustomerId",$row->get_value('CustomerId'));
            $this->db->set("FlagPds",0);
            // $this->db->set("CampaignId",$row->get_value('CampaignId'));
            $this->db->set("CampaignId",$out->get_value('dis_campaign_name_pds'));
            $this->db->set("CustomerMobilePhoneNum",$row->get_value('CustomerMobilePhoneNum'));
            $this->db->set("CustomerHomePhoneNum",$row->get_value('CustomerHomePhoneNum'));
            $this->db->set("CustomerWorkPhoneNum",$row->get_value('CustomerWorkPhoneNum'));
            $this->db->set("AssignDatePDS",date('Y-m-d H:i:s'));
			$this->db->set("AssignSession",$row->get_value('AssignSession'));
            $this->db->set("LastCallStatusId",0);
            // $this->db->set("GroupHeadId",$outUser->get_value('cc_agent_id'));
            $res = $this->db->insert('t_gn_customer_pds');
            #var_dump( $this->db->last_query() ); die();

            if ( $res ) {
            	// update flag PDS in Customer
            	$this->db->reset_write();
            	$this->db->where('CustomerId', $row->get_value('CustomerId'));
            	$this->db->set('Flag_Followup', 1);
            	$this->db->set('Flag_Pds', 1);
            	$this->db->update('t_gn_customer');
            	$tot_assign++;
            }
			
			if($tot_assign){
				$objAsg->_AssignPdsLog($row,$out);
			}
        }
    }
    
    //----------- leader --------------------------------------------
    if(in_array( $Level,  array(USER_AGENT_OUTBOUND)) AND $outUser->fetch_ready() ) {
    	var_dump( "USER_AGENT_OUTBOUND" );die();
        return FALSE;  // TESTING
        foreach(  $arr_assign as $k => $rows  ) 
        { 
            $row = new EUI_object( $rows );
            $this->db->reset_write();
            $this->db->where('AssignId', $row->get_value('AssignId'));
            $this->db->set("AssignAmgr", $outUser->get_value('act_mgr'));
            $this->db->set("AssignMgr", $outUser->get_value('mgr_id'));
            $this->db->set("AssignSpv", $outUser->get_value('spv_id'));
            $this->db->set("AssignLeader", $outUser->get_value('tl_id'));
            $this->db->set("AssignSelerId", $outUser->get_value('UserId'));
            $this->db->set("AssignDate", date('Y-m-d H:i:s'));
            $this->db->set("AssignMode", 'DIS');
            if( $this->db->update('t_gn_assignment') )
            {
                $this->_event_loger_distribute($row->get_value('AssignId'), 'DIS');
                $tot_assign++;
            }
        }
    }
 
    //----------- leader --------------------------------------------
    if(in_array( $Level, array(USER_AGENT_INBOUND)) AND $outUser->fetch_ready() ) {
    	var_dump( "USER_AGENT_INBOUND" );die();
        return FALSE;  // TESTING
        foreach(  $arr_assign as $k => $rows  ) 
        { 
            $row = new EUI_object( $rows );
            $this->db->reset_write();
            $this->db->where('AssignId', $row->get_value('AssignId'));
            $this->db->set("AssignAmgr", $outUser->get_value('act_mgr'));
            $this->db->set("AssignMgr", $outUser->get_value('mgr_id'));
            $this->db->set("AssignSpv", $outUser->get_value('spv_id'));
            $this->db->set("AssignLeader", $outUser->get_value('tl_id'));
            $this->db->set("AssignSelerId", $outUser->get_value('UserId'));
            $this->db->set("AssignDate", date('Y-m-d H:i:s'));
            $this->db->set("AssignMode", 'DIS');
            if( $this->db->update('t_gn_assignment') )
            {
                $this->_event_loger_distribute($row->get_value('AssignId'), 'DIS');
                $tot_assign++;
            }
        }
    }

    #var_dump( "ERROR" );die();
    return (int)$tot_assign;
    
}
/*** END SECTION PDS ***/





 
// ============================== END CLASS ==================================================
}
