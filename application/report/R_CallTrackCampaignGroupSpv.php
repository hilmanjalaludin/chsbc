<?php 

// -------------------------------------------------------------------------------------------------------
/*
 * @ class model report  		R_CallTrackCampaignGroupTsr 
 */
 
define('STATUS_NOT_CONNECTION',7);
define('STATUS_INTERESTED',5);
define('STATUS_NOT_INTERESTED',4);
define('STATUS_NO_CONTACT',2);
define('STATUS_FOLLOW_UP',9);
define('STATUS_NOT_QUALIFIED',10);
 
class R_CallTrackCampaignGroupSpv extends EUI_Report 
{

 protected $CampaignId 	= null;
 protected $AgentId 	= null;
 protected $SpvId 		= null;
 protected $AtmId 		= null;
 protected $StartDate 	= null;
 protected $EndDate 	= null;
 protected $Interval 	= null;

/* @ param : aksesor **/

 public function __construct() 
{

/* set Interval filter  **/
	if( $this->URI->_get_post('interval') 
		AND !is_null($this->URI->_get_post('interval')) )
	{
		$this->Interval = $this->URI->_get_post('interval');
	}
}


// -------------------------------------------------------------------------------------------------------
/*
 * @ properties data filter on report process 
 * @ param on posted data 
 */
 
 
 protected function _select_row_title_header_report()
{
 
 $out = new EUI_Object(_get_all_request() );
 $this->arr_label = array();
 
// ----------------- set data -------------------------------------
 
 $arr_exist_campaign = $this->_select_row_all_data_campaign();
 $arr_send_campaign = $this->_select_row_data_campaign();	
 
 if( count($arr_exist_campaign) == count($arr_send_campaign) ){
	$this->arr_label['CampaignName'] = "ALL Campaign";
	
 } else {
	$arr_vals = array_values($arr_send_campaign);
	$this->arr_label['CampaignName'] = join(" / ", $arr_vals);
}

// ----------- set title ---> 
 $this->arr_label["ReportName"] = "CALLTRACKING & SUMMARY PRODUCTION REPORT GROUP BY SPV";
 $this->arr_label["HeaderName"] = "SPV";
 $this->arr_label["StartDate"]  = $out->get_value('start_date','_setDateString');
 $this->arr_label["EndDate"] 	= $out->get_value('end_date','_setDateString');
 $this->arr_label["PrintDate"]  = date('d M Y H:i:s');
 
 return (array)$this->arr_label;
 
}

// -------------------------------------------------------------------------------------------------------
/*
 * @ properties data filter on report process 
 * @ param on posted data 
 */
 

 protected function _select_row_all_data_campaign()
{
 $select_campaign = array();
 $this->db->reset_select();
 $this->db->select("a.CampaignId, a.CampaignName", FALSE);
 $this->db->from("t_gn_campaign  a");
 $this->db->where("a.OutboundGoalsId",'2');
 $this->db->where("a.CampaignStatusFlag",1);
 
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 )
	 foreach($rs->result_assoc() as $rows )
 {
	$select_campaign[$rows['CampaignId']] = $rows['CampaignName'];
 }

 return $select_campaign;	
 
}
// -------------------------------------------------------------------------------------------------------
/*
 * @ properties data filter on report process 
 * @ param on posted data 
 */
 

 protected function _select_row_data_campaign()
{
 $select_campaign = array();
 
 
 $out = new EUI_Object(_get_all_request() );
 
// ---------------------------------------------------
 
 $this->db->reset_select();
 $this->db->select("a.CampaignId, a.CampaignName", FALSE);
 $this->db->from("t_gn_campaign  a");
 $this->db->where("a.OutboundGoalsId",'2');
 $this->db->where_in("a.CampaignId",  $out->get_array_value('CampaignId') );
 
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 )
	 foreach($rs->result_assoc() as $rows )
 {
	$select_campaign[$rows['CampaignId']] = $rows['CampaignName'];
 }

 return $select_campaign;	
 
}


// -------------------------------------------------------------------------------------------------------
/*
 * @ properties data filter on report process 
 * @ param on posted data 
 */
 

public function _select_row_user_report() 
{
	$out = new EUI_Object(_get_all_request() );
	
	$User = array();
	$this->db->reset_select();
	$this->db->select('a.UserId, a.full_name ');
	$this->db->from('tms_agent a');
	$this->db->where_in('a.UserId', $out->get_array_value('SpvId'));
	$result = $this -> db -> get();
	
	foreach( $result-> result_assoc() as $rows )
	{
		$User[$rows['UserId']] = $rows;
    }

	return $User;
}	


// -------------------------------------------------------------------------------------------------------
/*
 * @ properties data filter on report process 
 * @ param on posted data 
 */
 
 
public function _select_row_call_result_code_report() 
{
	
	$arr_call_result = array();
	$this->db->reset_select();
	$this->db->select('
		b.CallReasonCategoryName as Category, 
		a.CallReasonCode as Kode, 
		a.CallReasonDesc as Detail', 
	FALSE);
	
	$this->db->from("t_lk_callreason a ");
	$this->db->join("t_lk_callreasoncategory b "," a.CallReasonCategoryId=b.CallReasonCategoryId", FALSE);
	$this->db->order_by("a.CallReasonCode", "ASC");
	$rs = $this->db->get();
	
	if($rs->num_rows() > 0)  
		foreach( $rs-> result_assoc() as $rows )
	{
		$arr_call_result[$rows['Kode']] = array(
			'Kategory' => $rows['Category'],
			'Kode' => $rows['Kode'],
			'Detail' => $rows['Detail']
		);
    }
	
	return (array)$arr_call_result;
}	



// -------------------------------------------------------------------------------------------------------
/*
 * @ properties data filter on report process 
 * @ param on posted data 
 */
 
 public function _select_row_data_report() 
{
	$out = new EUI_Object(_get_all_request() );
	if( !$out->fetch_ready() ){
		exit('exit');
	}
	
	
// ---------------- next process ------------------------------
	
	$this->arr_result = array();
	 if( $out->get_value('interval','strtolower') =='summary' )
	{
		$this->arr_result = array  ( 
			'call_viewer'	=> 'view_calltrack_campaign_group_spv_summary_html',
			'call_content' 	=> $this->_select_row_data_utilize(), 
			'call_users' 	=> $this->_select_row_user_report(),
			'call_notes'	=> $this->_select_row_call_result_code_report(),
			'call_title'	=> $this->_select_row_title_header_report()
		); 	
	}
	return (array)$this->arr_result;
}

// -------------------------------------------------------------------------------------------------------
/*
 * @ properties data filter on report process 
 * @ param on posted data 
 */
 
 public function _select_row_data_utilize()
{
	$out = new EUI_Object(_get_all_request());
	$arr_result = array();
	
	
// --- ambil data secara keseluruhan ---------------------------------
	
	$this->db->reset_select();
	$this->db->select("
		COUNT(a.CustomerId) AS tot_size, b.AssignLeader as AssignLeader, 
		SUM(IF(a.CallReasonId IN(99),1,0)) AS tot_unutilize, 
		SUM(IF(a.CallReasonId NOT IN(99),1,0)) AS tot_utilize,
		( select SUM(cr.duration) as tot_talk_time from cc_recording cr 
		  where cr.assignment_data=a.CustomerId ) as tot_talk_time,
		
		SUM(IF(a.CallReasonId IN(1),1,0)) AS tot_status_101,
		SUM(IF(a.CallReasonId IN(2),1,0)) AS tot_status_102,
		SUM(IF(a.CallReasonId IN(3),1,0)) AS tot_status_103,
		SUM(IF(a.CallReasonId IN(4),1,0)) AS tot_status_201,
		SUM(IF(a.CallReasonId IN(5),1,0)) AS tot_status_202,
		SUM(IF(a.CallReasonId IN(6),1,0)) AS tot_status_203,
		SUM(IF(a.CallReasonId IN(7),1,0)) AS tot_status_204,
		SUM(IF(a.CallReasonId IN(8),1,0)) AS tot_status_205,
		SUM(IF(a.CallReasonId IN(9),1,0)) AS tot_status_206,
		SUM(IF(a.CallReasonId IN(10),1,0)) AS tot_status_207,
		SUM(IF(a.CallReasonId IN(11),1,0)) AS tot_status_208,
		SUM(IF(a.CallReasonId IN(12),1,0)) AS tot_status_209,
		SUM(IF(a.CallReasonId IN(13),1,0)) AS tot_status_210,
		SUM(IF(a.CallReasonId IN(14),1,0)) AS tot_status_211,
		SUM(IF(a.CallReasonId IN(15),1,0)) AS tot_status_301,
		SUM(IF(a.CallReasonId IN(16),1,0)) AS tot_status_302,
		SUM(IF(a.CallReasonId IN(17),1,0)) AS tot_status_303,
		SUM(IF(a.CallReasonId IN(18),1,0)) AS tot_status_304,
		SUM(IF(a.CallReasonId IN(19),1,0)) AS tot_status_305,
		SUM(IF(a.CallReasonId IN(20),1,0)) AS tot_status_306,
		SUM(IF(a.CallReasonId IN(21),1,0)) AS tot_status_307,
		SUM(IF(a.CallReasonId IN(22),1,0)) AS tot_status_308,
		SUM(IF(a.CallReasonId IN(23),1,0)) AS tot_status_309,
		SUM(IF(a.CallReasonId IN(24),1,0)) AS tot_status_310,
		SUM(IF(a.CallReasonId IN(25),1,0)) AS tot_status_311,
		SUM(IF(a.CallReasonId IN(26),1,0)) AS tot_status_312,
		SUM(IF(a.CallReasonId IN(27),1,0)) AS tot_status_313,
		SUM(IF(a.CallReasonId IN(28),1,0)) AS tot_status_314,
		SUM(IF(a.CallReasonId IN(29),1,0)) AS tot_status_315,
		SUM(IF(a.CallReasonId IN(30),1,0)) AS tot_status_316,
		SUM(IF(a.CallReasonId IN(31),1,0)) AS tot_status_317,
		SUM(IF(a.CallReasonId IN(32),1,0)) AS tot_status_318,
		SUM(IF(a.CallReasonId IN(33),1,0)) AS tot_status_401,
		SUM(IF(a.CallReasonId IN(34),1,0)) AS tot_status_402,
		SUM(IF(a.CallReasonId IN(35),1,0)) AS tot_status_601,
		SUM(IF(a.CallReasonId IN(36),1,0)) AS tot_status_602,
		SUM(IF(a.CallReasonId IN(37),1,0)) AS tot_status_603", 
	FALSE);
		
	$this->db->from("t_gn_customer a ");
	$this->db->join("t_gn_campaign f ","f.CampaignId=a.CampaignId","LEFT");
	$this->db->join("t_gn_assignment b","a.CustomerId=b.CustomerId","LEFT");

	// ---- filter data ---------------------------
	
	$this->db->where_in("f.CampaignId", $out->get_array_value('CampaignId')); 
	$this->db->where_in("b.AssignLeader", $out->get_array_value('SpvId'));
	$this->db->where("a.CustomerUpdatedTs>='{$out->get_value('start_date','StartDate')}'", "", false);
	$this->db->where("a.CustomerUpdatedTs<='{$out->get_value('end_date','EndDate')}'", "", false);
	$this->db->group_by(array("AssignLeader"));
	
	$rs = $this->db->get();
	if( $rs->num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $rows ) 
	{
		$result[$rows['AssignLeader']]['data_size'] +=$rows['tot'];
		$result[$rows['AssignLeader']]['data_not_utilize'] +=$rows['tot_unutilize'];
		$result[$rows['AssignLeader']]['data_utilize']	+=$rows['tot_utilize'];
		$result[$rows['AssignLeader']]['tot_data_status_101'] +=$rows['tot_status_101'];
		$result[$rows['AssignLeader']]['tot_data_status_102'] +=$rows['tot_status_102'];
		$result[$rows['AssignLeader']]['tot_data_status_103'] +=$rows['tot_status_103'];
		$result[$rows['AssignLeader']]['tot_data_status_201'] +=$rows['tot_status_201'];
		$result[$rows['AssignLeader']]['tot_data_status_202'] +=$rows['tot_status_202'];
		$result[$rows['AssignLeader']]['tot_data_status_203'] +=$rows['tot_status_203'];
		$result[$rows['AssignLeader']]['tot_data_status_204'] +=$rows['tot_status_204'];
		$result[$rows['AssignLeader']]['tot_data_status_205'] +=$rows['tot_status_205'];
		$result[$rows['AssignLeader']]['tot_data_status_206'] +=$rows['tot_status_206'];
		$result[$rows['AssignLeader']]['tot_data_status_207'] +=$rows['tot_status_207'];
		$result[$rows['AssignLeader']]['tot_data_status_208'] +=$rows['tot_status_208'];
		$result[$rows['AssignLeader']]['tot_data_status_209'] +=$rows['tot_status_209'];
		$result[$rows['AssignLeader']]['tot_data_status_210'] +=$rows['tot_status_210'];
		$result[$rows['AssignLeader']]['tot_data_status_211'] +=$rows['tot_status_211'];
		$result[$rows['AssignLeader']]['tot_data_status_301'] +=$rows['tot_status_301'];
		$result[$rows['AssignLeader']]['tot_data_status_302'] +=$rows['tot_status_302'];
		$result[$rows['AssignLeader']]['tot_data_status_303'] +=$rows['tot_status_303'];
		$result[$rows['AssignLeader']]['tot_data_status_304'] +=$rows['tot_status_304'];
		$result[$rows['AssignLeader']]['tot_data_status_305'] +=$rows['tot_status_305'];
		$result[$rows['AssignLeader']]['tot_data_status_306'] +=$rows['tot_status_306'];
		$result[$rows['AssignLeader']]['tot_data_status_307'] +=$rows['tot_status_307'];
		$result[$rows['AssignLeader']]['tot_data_status_308'] +=$rows['tot_status_308'];
		$result[$rows['AssignLeader']]['tot_data_status_309'] +=$rows['tot_status_309'];
		$result[$rows['AssignLeader']]['tot_data_status_310'] +=$rows['tot_status_310'];
		$result[$rows['AssignLeader']]['tot_data_status_311'] +=$rows['tot_status_311'];
		$result[$rows['AssignLeader']]['tot_data_status_312'] +=$rows['tot_status_312'];
		$result[$rows['AssignLeader']]['tot_data_status_313'] +=$rows['tot_status_313'];
		$result[$rows['AssignLeader']]['tot_data_status_314'] +=$rows['tot_status_314'];
		$result[$rows['AssignLeader']]['tot_data_status_315'] +=$rows['tot_status_315'];
		$result[$rows['AssignLeader']]['tot_data_status_316'] +=$rows['tot_status_316'];
		$result[$rows['AssignLeader']]['tot_data_status_317'] +=$rows['tot_status_317'];
		$result[$rows['AssignLeader']]['tot_data_status_318'] +=$rows['tot_status_318'];
		$result[$rows['AssignLeader']]['tot_data_status_401'] +=$rows['tot_status_401'];
		$result[$rows['AssignLeader']]['tot_data_status_402'] +=$rows['tot_status_402'];
		$result[$rows['AssignLeader']]['tot_data_status_601'] +=$rows['tot_status_601'];
		$result[$rows['AssignLeader']]['tot_data_status_602'] +=$rows['tot_status_602'];
		$result[$rows['AssignLeader']]['tot_data_status_603'] +=$rows['tot_status_603'];

	}
// ---------- get data talktime --------------
	
	$this->db->reset_select();
	$this->db->select("c.AssignLeader as AssignLeader, SUM(a.duration) as tot_talk_time ", FALSE);
	$this->db->from("cc_recording a");
	$this->db->join("t_gn_customer b "," a.assignment_data=b.CustomerId", "LEFT");
	$this->db->join("t_gn_assignment c "," b.CustomerId=c.CustomerId","LEFT");
	
	$this->db->where_in("b.CampaignId", $out->get_array_value('CampaignId')); 
	$this->db->where_in("c.AssignLeader", $out->get_array_value('SpvId'));
	$this->db->where("b.CustomerUpdatedTs>='{$out->get_value('start_date','StartDate')}'", "", false);
	$this->db->where("b.CustomerUpdatedTs<='{$out->get_value('end_date','EndDate')}'", "", false);
	$this->db->group_by(array("AssignLeader"));
	//$this->db->print_out();
	
	$rs = $this->db->get();
	if( $rs->num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $rows ) 
	{
		$result[$rows['AssignLeader']]['data_tot_talk_time'] +=$rows['tot_talk_time'];
	}
	
// ---------- ambil data follow yang benar2 fress ---
	
	$this->db->reset_select();
	$this->db->select("
		count( distinct a.CustomerId)  as tot, 
		a.AssignLeader as AssignLeader", 
	FALSE);
	
	$this->db->from("t_gn_assignment_log a ");
	$this->db->join("t_gn_customer b ","a.CustomerId=b.CustomerId", "LEFT");
	$this->db->where_in("a.AssignMode", array('DIS'));
	$this->db->where_in("b.CampaignId", $out->get_array_value('CampaignId')); 
	$this->db->where_in("a.AssignLeader", $out->get_array_value('SpvId'));
	$this->db->where("a.AssignDate>='{$out->get_value('start_date','StartDate')}'", "", false);
	$this->db->where("a.AssignDate<='{$out->get_value('end_date','EndDate')}'", "", false);
	$this->db->group_by(array('AssignLeader'));
	
	$rs = $this->db->get();
	if( $rs->num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $rows ) 
	{
		$result[$rows['AssignLeader']]['tot_new_assigned']+=$rows['tot'];
	}
	
// ---------- ambil data follow yang tidak fress dan di followup kembali ---
	
	$this->db->reset_select();
	$this->db->select("
		COUNT( distinct a.CustomerId)  as tot, 
		a.AssignLeader as AssignLeader", 
	FALSE);
	$this->db->from("t_gn_assignment_log a ");
	$this->db->join("t_gn_customer b ","a.CustomerId=b.CustomerId", "LEFT");
	$this->db->where_not_in("a.AssignMode", array('DIS'));
	
	$this->db->where_in("b.CampaignId", $out->get_array_value('CampaignId')); 
	$this->db->where_in("a.AssignLeader", $out->get_array_value('SpvId'));
	$this->db->where("a.AssignDate>='{$out->get_value('start_date','StartDate')}'", "", false);
	$this->db->where("a.AssignDate<='{$out->get_value('end_date','EndDate')}'", "", false);
	$this->db->group_by(array('AssignLeader'));
	
	$rs = $this->db->get();
	if( $rs->num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $rows ) 
	{
		$result[$rows['AssignLeader']]['tot_re_assigned']+=$rows['tot'];
	}
	
// ----- ambil data atempt di call history calltype = 0 --

    $this->db->reset_select();
    $this->db->select("
		count(a.CustomerId) as tot, 
		c.UserId as AssignLeader", FALSE);
    $this->db->from("t_gn_callhistory a ");
	$this->db->join("t_gn_customer b","a.CustomerId=b.CustomerId", "LEFT");
	$this->db->join("tms_agent c ","a.SPVCode=c.id", "LEFT");
	
	$this->db->where_in("b.CampaignId", $out->get_array_value('CampaignId')); 
	$this->db->where_in("c.UserId", $out->get_array_value('SpvId'));
	$this->db->where("a.CallHistoryCreatedTs>='{$out->get_value('start_date','StartDate')}'", "", false);
	$this->db->where("a.CallHistoryCreatedTs<='{$out->get_value('end_date','EndDate')}'", "", false);
	$this->db->where("a.HistoryType", 0);
	$this->db->group_by(array('AssignLeader'));
//	$this->db->print_out();
	
	$rs = $this->db->get();
	if( $rs->num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $rows ) 
	{
		$result[$rows['AssignLeader']]['tot_data_atempt']+=$rows['tot'];
	}
	
// ------------ data policy sales ----------------------------------------------
    
	$this->db->reset_select();
	$this->db->select("
		count(distinct b.PolicyNumber) as tot,
		a.PolicyNumber as PolicyNumber,
		e.AssignLeader as AssignLeader,
		count(a.PolicyId) as tot_data_insured,
		SUM(IF(d.PayModeId IN(2), a.PolicyPremi, a.PolicyPremi)) as tot_data_premi", FALSE);
	
	$this->db->from("t_gn_policy a ");
	$this->db->join("t_gn_policyautogen b ","a.PolicyNumber=b.PolicyNumber", "LEFT");
	$this->db->join("t_gn_customer c ","b.CustomerId=c.CustomerId", "LEFT");
	$this->db->join("t_gn_productplan d ","a.ProductPlanId=d.ProductPlanId", "LEFT");
	$this->db->join("t_gn_assignment e ","b.CustomerId=e.CustomerId", "LEFT");
	
	$this->db->where_in("c.CampaignId", $out->get_array_value('CampaignId')); 
	$this->db->where_in("e.AssignLeader", $out->get_array_value('SpvId'));
	$this->db->where("a.PolicySalesDate>='{$out->get_value('start_date','StartDate')}'", "", false);
	$this->db->where("a.PolicySalesDate<='{$out->get_value('end_date','EndDate')}'", "", false);
	$this->db->group_by(array("PolicyNumber","AssignLeader"));
	
	//$this->db->print_out();
	$rs = $this->db->get();
	if($rs->num_rows() > 0)  
		foreach( $rs-> result_assoc() as $rows )
	{
		$result[$rows['AssignLeader']]['total_data_policy'] += $rows['tot'];
		$result[$rows['AssignLeader']]['tot_data_insured'] += $rows['tot_data_insured'];
		$result[$rows['AssignLeader']]['tot_data_premi'] += $rows['tot_data_premi'];
	}	
	
// ------------ select count user login on interval ---------------------------------

	$this->db->reset_select();
	$this->db->select("count(distinct a.ActivityUserId) as tot_user_tmr", FALSE);
	$this->db->from("t_gn_activitylog a ");
	$this->db->join("tms_agent b ","a.ActivityUserId=b.UserId", "LEFT");
	$this->db->where("a.ActivityDate>='{$out->get_value('start_date','StartDate')}'", "", FALSE);
	$this->db->where("a.ActivityDate<='{$out->get_value('end_date','EndDate')}'", "", FALSE);
	$this->db->where_in("b.handling_type",array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));
	
	$rs = $this->db->get();
	if($rs->num_rows() > 0)  
		foreach( $rs-> result_assoc() as $rows )
	{
		$result['data_tot_user_login'] += $rows['tot_user_tmr'];
	}
	
// ---- select day work data agent data -----------------------------------
	
	$this->db->reset_select();
	$this->db->select(" 1 As tot_day_work, 
				date_format(a.ActivityDate,'%Y-%m-%d') as tgl ", FALSE);
	$this->db->from("t_gn_activitylog a ");
	$this->db->where("a.ActivityDate>='{$out->get_value('start_date','StartDate')}'", "", FALSE);
	$this->db->where("a.ActivityDate<='{$out->get_value('end_date','EndDate')}'", "", FALSE);
	$this->db->group_by("tgl");
	
	$rs = $this->db->get();
	if($rs->num_rows() > 0)  
		foreach( $rs-> result_assoc() as $rows )
	{
		$result['data_tot_day_work'] += $rows['tot_day_work'];
	}
	
// ---------- get total work of hour in list ---

	$this->db->reset_select();
	$this->db->select("
		a.ActivityUserId as UserId, date(a.ActivityDate) as tgl,
		UNIX_TIMESTAMP(( select tvc.ActivityDate from t_gn_activitylog tvc where tvc.ActivityEvent='ACTION_EVENT_LOGIN' 
		and tvc.ActivityUserId=a.ActivityUserId and date(tvc.ActivityDate) = tgl ORDER BY tvc.ActivityId ASC LIMIT 1 )) as start_login,
		UNIX_TIMESTAMP(( select tvc.ActivityDate from t_gn_activitylog tvc where tvc.ActivityEvent='ACTION_EVENT_LOGOUT' 
		and date(tvc.ActivityDate) = tgl and tvc.ActivityUserId=a.ActivityUserId ORDER BY tvc.ActivityId DESC LIMIT 1 )) as end_login", 
		FALSE);
	$this->db->from("t_gn_activitylog a ");	
	$this->db->join("tms_agent b","a.ActivityUserId = b.UserId", "LEFT");
	$this->db->where("a.ActivityDate>='{$out->get_value('start_date','StartDate')}'", "", FALSE);
	$this->db->where("a.ActivityDate<='{$out->get_value('end_date','EndDate')}'", "", FALSE);
	$this->db->where_in("b.handling_type",array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));
	$this->db->group_by(array("UserId", "tgl"));
	
	$rs = $this->db->get();
	if($rs->num_rows() > 0)  
		foreach( $rs-> result_assoc() as $rows )
	{
		if( (int)$rows['end_login'] > 0 ) {
			$hour_maximum = ( (int)$rows['end_login'] - (int)$rows['start_login'] );
			$result['data_tot_hour_work'] += $hour_maximum;
		}
	}
	
	return (array)$result;
	
	// END FUNCTION ON HERE 
}
   	
	


}

?>