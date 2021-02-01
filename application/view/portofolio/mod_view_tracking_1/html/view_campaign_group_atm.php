<?php 


 global $skip_status, $gReportSession;
 $skip_status  = array('319');
 $gReportSession = "";
 

//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */

if( !function_exists('PrepareCallData') ) 
{
  function PrepareCallData() 
 {
	global $gReportSession;
	
	$out = new EUI_Object(_get_all_request() );
	$gReportSession = time() + hexdec($_SERVER['REMOTE_ADDR']);		
	$CI =& get_instance();
	$sql = " INSERT INTO t_gn_callhistory_newutil 
				SELECT 
					a.CallHistoryId as CallHistoryId,
					a.CustomerId as CustomerId,
					(select tgs.CampaignId from t_gn_customer tgs 
						where tgs.CustomerId=a.CustomerId) as CampaignId,
					a.CallReasonId as CallReasonId,
					a.CreatedById as CreatedById,
					a.AgentCode as AgentCode,
					a.SPVCode as SPVCode,
					(select ts.UserId from tms_agent ts 
						where ts.id=a.SPVCode ) as SPVID,
					a.ATMCode as ATMCode,
					(select ts.UserId from tms_agent ts 
						where ts.id=a.ATMCode ) as ATMID,
					a.AMGRCode as AMGRCode,
					(select ts.UserId from tms_agent ts 
						where ts.id=a.AMGRCode ) as AMGRID,
					a.MGRCode as MGRCode,
					(select ts.UserId from tms_agent ts 
						where ts.id=a.MGRCode ) as MGRID,
					a.ADMINCode as ADMINCode,
					(select ts.UserId from tms_agent ts 
						where ts.id=a.ADMINCode ) as ADMINID,
					a.CallHistoryCallDate as CallHistoryCallDate,
					a.CallBeforeReasonId as CallBeforeReasonId,
					a.HistoryType as HistoryType,
					a.CallHirarcyHigh as CallHirarcyHigh,
					'$gReportSession' as Session 
				FROM t_gn_callhistory a 
				WHERE a.HistoryType = 0
				AND a.CallBeforeReasonId = 99
				AND a.CallHistoryCallDate>='{$out->get_value('start_date','StartDate')}'
				AND a.CallHistoryCallDate<='{$out->get_value('end_date','EndDate')}'
				
				ON DUPLICATE KEY UPDATE SessionReport ='$gReportSession' ";
		$CI->db->query($sql);	
	}
}


//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */

if( !function_exists('CleanCallData') ) 
{
  function CleanCallData() 
 {
    global $gReportSession;
    $CI=& get_instance();
    $CI->db->query("DELETE FROM t_gn_callhistory_newutil WHERE SessionReport='$gReportSession'");
  }
  
}	


//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
if( !function_exists('const_hours') ) {
	 function const_hours()  {
		$tot_constans_hours  = 360;
		return $tot_constans_hours;
	}
}

 //---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 
 if( !function_exists('_select_report_campaign_id') )
{ 
	function _select_report_campaign_id()
 {
	$CI  =& get_instance();
	$obj =& get_class_instance("M_CallTrackingReport");
	$out =new EUI_Object(_get_all_request() );
	
	$arr_campaign = array_map("strtolower", $out->get_array_value('CampaignId') );
	if( in_array("all", $arr_campaign) ) {
		return array_keys($obj->_select_report_campaign());
	} else{
		return $out->get_array_value('CampaignId');
	}
  }
}
 
//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

 if( !function_exists('_select_report_active_product') )
{
   function _select_report_active_product() 
 {	
	$arr_list_product = array();
	$CI  =& get_instance();
	$CI->db->reset_select();
	$CI->db->select("a.ProductId, a.ProductCode, a.ProductName", FALSE);
	$CI->db->from("t_gn_product a ");
	$CI->db->where("a.ProductStatusFlag", 1);
	$rs = $CI->db->get();
	if( $rs->num_rows() > 0 ) 
	   foreach( $rs->result_assoc() as $row )
	 {
		$arr_list_product[$row['ProductId']] = $row['ProductName'];
	 }
	 return $arr_list_product;
  }	 
}
//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 
 function _select_campaign_group_atm_summary()
{
	
 global $gReportSession, $skip_status;	
 
 $UI=& get_instance();
 $Out=& new EUI_Object(_get_all_request() );
 $cls=& get_class_instance("M_CallTrackingReport");
 
 $CampaignId = _select_report_campaign_id();
 $AtmId = $Out->get_array_value("AtmId");
 
 $TmrId = array_keys($cls->_select_report_tmr_by_atm($Out->get_value("AtmId")));
 $TmrId = ( count($TmrId) == 0 ? array(0) :  $TmrId); 

  
 
 // --------------------------------------------- 
 $arr_product = _select_report_active_product();
 $colspan = (4*count( $arr_product));
 
 
echo "<table class=\"data\" border=1 style=\"border-collapse: collapse\">
	 <tr>
	  <td class=\"head\" rowspan=3 align=\"center\" style=\"vertical-align:middle;\">ATM</td>
	  <td class=\"head\" colspan=6>DB</td>
	  <td class=\"head\" rowspan=3>Attempted</td>
	  <td class=\"head\" rowspan=3>Attempt Ratio</td>
	  <td class=\"head\" colspan=5>Connected</td>
	  <td class=\"head\" colspan=13>Contacted</td>
	  <td class=\"head\" ></td>
	  <td class=\"head\" align=\"center\" colspan=21>Presentation</td>
	  <td class=\"head\" colspan=2>UnPresent</td>
	  <td class=\"head\" colspan=3>Follow Up</td>
	  <td class=\"head\" colspan=4>Achievement</td>
	  <td class=\"head\" colspan=\"$colspan\" align=\"center\">Product Achievement</td>
	  <td class=\"head\" rowspan=3>Sales Closing Rate</td>
	  <td class=\"head\" rowspan=3>Sales Presentation Rate</td>
	  <td class=\"head\" rowspan=3>Response Rate</td>
	  <td class=\"head\" rowspan=3>NOS Rate</td>
	  <td class=\"head\" rowspan=3>Talk Time</td>
	  <td class=\"head\" rowspan=3>Ave Talktime/<br>hours</td>
	  <td class=\"head\" rowspan=3>Ave Talk time/tmr</td>
	  <td class=\"head\" rowspan=3>Working Hour</td>
	  <td class=\"head\" rowspan=3>#TMR</td>
	  <td class=\"head\" rowspan=3>Working Days</td>
	  <td class=\"head\" colspan=3>Productivity/tmr</td>
	  <td class=\"head\" rowspan=3>Attempted/tmr</td>
	  <td class=\"head\" rowspan=3>Ave Premium</td>
	  <td class=\"head\" colspan=2 colspan=2>Bad List</td>
	 </tr>
	 
	 <tr>
	  <td class=\"head\" rowspan=2>New Assigned</td>
	  <td class=\"head\" rowspan=2>Re Assigned</td>
	  <td class=\"head\" colspan=3>Solicited</td>
	  <td class=\"head\" rowspan=2>Short DB new</td>
	  <td class=\"head\" rowspan=2>Y</td>
	  <td class=\"head\" colspan=3>N</td>
	  <td class=\"head\" rowspan=2>Connected Rate</td>
	  <td class=\"head\" rowspan=2>Y</td>
	  <td class=\"head\" colspan=11>N</td>
	  <td class=\"head\" rowspan=2>Rate</td>
	  <td class=\"head\" rowspan=2>#Presentation</td>
	  <td class=\"head\" rowspan=2>Presentation Rate</td>
	  <td class=\"head\" colspan=3>Interested</td>
	  <td class=\"head\" colspan=17>Not Interested</td>
	  <td class=\"head\" >RU</td>
	  <td class=\"head\" rowspan=2>Rate</td>
	  <td class=\"head\" colspan=2>&nbsp;</td>
	  <td class=\"head\" rowspan=2>Rate</td>
	  <td class=\"head\" rowspan=2>PIF</td>
	  <td class=\"head\" rowspan=2>NOS</td>
	  <td class=\"head\" rowspan=2>PREMIUM</td>
	  <td class=\"head\" rowspan=2>ANP</td>";
	  
	  if( is_array($arr_product) ) 
		foreach( $arr_product as $id => $ProductName ) 
	 {
		echo "<td class=\"head\" align=\"center\" colspan=4>$ProductName</td>";
	 }
	 
echo "<td class=\"head\" rowspan=2>PIF</td>
	  <td class=\"head\" rowspan=2>PREMIUM</td>
	  <td class=\"head\" rowspan=2>ANP</td>
	  <td class=\"head\" rowspan=2>#</td>
	  <td class=\"head\" rowspan=2>Ratio</td>
	</tr>
 
	<tr>
	  <td class=\"head\">solicited new Assigned</td>
	  <td class=\"head\">solicited ReUtilized</td>
	  <td class=\"head\">Total Solicited / Utilized</td>
	  <td class=\"head\">101</td>
	  <td class=\"head\">102</td>
	  <td class=\"head\">103</td>
	  <td class=\"head\">201</td>
	  <td class=\"head\">202</td>
	  <td class=\"head\">203</td>
	  <td class=\"head\">204</td>
	  <td class=\"head\">205</td>
	  <td class=\"head\">206</td>
	  <td class=\"head\">207</td>
	  <td class=\"head\">208</td>
	  <td class=\"head\">209</td>
	  <td class=\"head\">210</td>
	  <td class=\"head\">211</td>
	  <td class=\"head\">601</td>
	  <td class=\"head\">602</td>
	  <td class=\"head\">603</td>
	  <td class=\"head\">301</td>
	  <td class=\"head\">302</td>
	  <td class=\"head\">303</td>
	  <td class=\"head\">304</td>
	  <td class=\"head\">305</td>
	  <td class=\"head\">306</td>
	  <td class=\"head\">307</td>
	  <td class=\"head\">308</td>
	  <td class=\"head\">309</td>
	  <td class=\"head\">310</td>
	  <td class=\"head\">311</td>
	  <td class=\"head\">312</td>
	  <td class=\"head\">313</td>
	  <td class=\"head\">314</td>
	  <td class=\"head\">315</td>
	  <td class=\"head\">316</td>
	  <td class=\"head\">317</td>".
	  
	  //<td class=\"head\">318</td>
	  
	  "<td class=\"head\">701</td>
	  <td class=\"head\">401</td>
	  <td class=\"head\">402</td>";
	  
	  if( is_array($arr_product) ) 
		foreach( $arr_product as $id => $ProductName ) 
	 {
		echo "<td class=\"head\">PIF</td>
			  <td class=\"head\">NOS</td>
			  <td class=\"head\">PREMIUM</td>
			  <td class=\"head\">ANP</td>";
	 }
	 
	echo "</tr>";
	
	
	
 $data = array();
 
// ===================== DIS NEW  DB  =====================

 $ar_dis_new_db = array();
 $UI->db->reset_select();
 $UI->db->select("
		count( distinct a.CustomerId) as tot_new_data,a.AssignSpv as AssignSpv,
		a.AssignSelerId as AssignSelerId,
		group_concat(distinct a.CustomerId) as ar_dis_new_db", 
 FALSE);
 
 $UI->db->from("t_gn_assignment_log a ");
 $UI->db->join("t_gn_customer b","a.CustomerId=b.CustomerId", "LEFT OUTER");
 $UI->db->where("a.CallReasonId=99", "", FALSE);
 $UI->db->where_in("b.CampaignId", $CampaignId); 
 $UI->db->where_in("a.AssignMode", array('DIS'));
 $UI->db->where_not_in("a.AssignSelerId", array_map('intval',array('0')));
 $UI->db->where_in("a.AssignAmgr", array_map('intval', $Out->get_array_value('ManagerId')));
 $UI->db->where_in("a.AssignSpv", array_map('intval', $Out->get_array_value('AtmId')));
 $UI->db->where("a.AssignDate>='{$Out->get_value('start_date','StartDate')}'", "", false);
 $UI->db->where("a.AssignDate<='{$Out->get_value('end_date','EndDate')}'", "", false);
 $UI->db->group_by(array("AssignSpv","AssignSelerId"));
 // $UI->db->print_out();
 
 $rs = $UI->db->get();
 if( $rs->num_rows() > 0 ) 
	 foreach( $rs->result_assoc() as $rows ) 
{
	$ar_dis_new_db = explode(",", $rows['ar_dis_new_db']);
	$data[$rows['AssignSpv']]['tot_new_assigned'] += $rows['tot_new_data'];
} 


// ===================== DIS OLD DB  =====================

 $UI->db->reset_select();
 $UI->db->select("count( distinct a.CustomerId) as tot_re_assigned, a.AssignSpv as AssignSpv,
	a.AssignSelerId as AssignSelerId", FALSE);
 $UI->db->from("t_gn_assignment_log a ");
 $UI->db->join("t_gn_customer b","a.CustomerId=b.CustomerId", "LEFT OUTER");
 $UI->db->where("a.CallReasonId<>99", "", FALSE);
 $UI->db->where("a.AssignSelerId<>0", "", FALSE);
 $UI->db->where_in("b.CampaignId", $CampaignId); 
 $UI->db->where_in("a.AssignAmgr", array_map('intval', $Out->get_array_value('ManagerId')));
 $UI->db->where_in("a.AssignSpv", array_map('intval', $Out->get_array_value('AtmId')));
 $UI->db->where("a.AssignDate>='{$Out->get_value('start_date','StartDate')}'", "", false);
 $UI->db->where("a.AssignDate<='{$Out->get_value('end_date','EndDate')}'", "", false);
 $UI->db->group_by(array('AssignSpv','AssignSelerId'));
 
 //$UI->db->print_out();
 
 $UI->db->group_by(array("AssignSpv"));
 $rs = $UI->db->get();
 if( $rs->num_rows() > 0 ) 
	 foreach( $rs->result_assoc() as $rows ) 
{
	$data[$rows['AssignSpv']]['tot_re_assigned'] += $rows['tot_re_assigned'];
} 

// ==================== SOLICITED NEW / ATM  ===================================

  $arr_utilize_new = null;
  $UI->db->reset_select();
  $UI->db->select("
		date(a.CallHistoryCallDate) as tgl,
		a.ATMID as AssignSpv,
		a.SPVID as AssignLeader, 
		a.AgentId as AssignSellerId,			
		COUNT(a.CustomerId) as tot_utilize_new,
		GROUP_CONCAT( DISTINCT a.CustomerId) as arr_utilize_new_id", 
  FALSE);
  
  $UI->db->from("t_gn_callhistory_newutil a ");
  $UI->db->where_in("a.CampaignId", $CampaignId);
  $UI->db->where("a.CallHistoryCallDate>='{$Out->get_value('start_date','StartDate')}'", "", false);
  $UI->db->where("a.CallHistoryCallDate<='{$Out->get_value('end_date','EndDate')}'", "", false);
  $UI->db->where_in("a.ATMID", array_map('intval', $Out->get_array_value('AtmId')));
  $UI->db->where_in("a.AMGRID", array_map('intval', $Out->get_array_value('ManagerId')));
  $UI->db->where_in("a.AgentId", array_map('intval', $TmrId));
  $UI->db->where("a.SessionReport", $gReportSession);
  $UI->db->group_by(array('tgl','AssignSpv','AssignSellerId'));
  
  // $UI->db->print_out();
  
  $rs = $UI->db->get();
  if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows ) 
 {
	$arr_utilize_new[$rows['tgl']][$rows['AssignSellerId']] = explode(',', $rows['arr_utilize_new_id']);
	$data[$rows['AssignSpv']]['data_new_utilize'] += $rows['tot_utilize_new'];
	$data[$rows['AssignSpv']]['data_all_solicited'] += $rows['tot_utilize_new'];
 }
 
 
 // ================== SOLICITED OLD / ATM/SPV  ============================
	$UI->db->reset_select();
    $UI->db->select("
		date(a.CallHistoryCallDate) as tgl,
		count(distinct a.CustomerId) as tot_old_utilize, 
		d.UserId as AssignSpv,
		a.CreatedById as AgentId, 
		a.CustomerId as CustomerId", FALSE);
	$UI->db->from("t_gn_callhistory a ");
	$UI->db->join("t_gn_customer b","a.CustomerId=b.CustomerId","INNER JOIN");
	$UI->db->join("tms_agent c ","a.SPVCode = c.id", "LFET");
	$UI->db->join("tms_agent d ","a.ATMCode = d.id", "LFET");
	$UI->db->join("tms_agent e  ","a.AMGRCode = e.id", "LFET");
	$UI->db->where_in("b.CampaignId", $CampaignId );
	$UI->db->where("a.HistoryType", 0);
	$UI->db->where("a.CallBeforeReasonId<>99", "", FALSE);
	$UI->db->where("a.CallHistoryCallDate>='{$Out->get_value('start_date','StartDate')}'", "", false);
	$UI->db->where("a.CallHistoryCallDate<='{$Out->get_value('end_date','EndDate')}'", "", false);
	$UI->db->where_in("a.CreatedById", array_map('intval', $TmrId));
	$UI->db->where_in("d.UserId", array_map('intval', $Out->get_array_value('AtmId')));
	$UI->db->where_in("e.UserId", array_map('intval', $Out->get_array_value('ManagerId')));
 	$UI->db->group_by(array("tgl","AgentId","CustomerId"));
	// $UI->db->print_out();
	$rs = $UI->db->get();
	if( $rs->num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $rows ) 
	{
		$arr_skip_data = $arr_utilize_new[$rows['tgl']][$rows['AgentId']];
		if( !in_array($rows['CustomerId'], $arr_skip_data)) {
			$data[$rows['AssignSpv']]['data_old_utilize'] += $rows['tot_old_utilize'];
			$data[$rows['AssignSpv']]['data_all_solicited'] += $rows['tot_old_utilize'];
		}
	}


// ================ GET DATA ATEMPT PER ATM SUMMARY =======================================
 
 
 $UI->db->reset_select();
 $UI->db->select("
		d.UserId as AssignSpv,
		COUNT(a.CallHistoryId) as data_size_atempt, 
		SUM(IF(f.CallReasonCode IN ('000'),1,0)) as status_000,
		SUM(IF(f.CallReasonCode IN ('101'),1,0)) as status_101,
		SUM(IF(f.CallReasonCode IN ('102'),1,0)) as status_102,
		SUM(IF(f.CallReasonCode IN ('103'),1,0)) as status_103,
		SUM(IF(f.CallReasonCode IN ('201'),1,0)) as status_201,
		SUM(IF(f.CallReasonCode IN ('202'),1,0)) as status_202,
		SUM(IF(f.CallReasonCode IN ('203'),1,0)) as status_203,
		SUM(IF(f.CallReasonCode IN ('204'),1,0)) as status_204,
		SUM(IF(f.CallReasonCode IN ('205'),1,0)) as status_205,
		SUM(IF(f.CallReasonCode IN ('206'),1,0)) as status_206,
		SUM(IF(f.CallReasonCode IN ('207'),1,0)) as status_207,
		SUM(IF(f.CallReasonCode IN ('208'),1,0)) as status_208,
		SUM(IF(f.CallReasonCode IN ('209'),1,0)) as status_209,
		SUM(IF(f.CallReasonCode IN ('210'),1,0)) as status_210,
		SUM(IF(f.CallReasonCode IN ('211'),1,0)) as status_211,
		SUM(IF(f.CallReasonCode IN ('301'),1,0)) as status_301,
		SUM(IF(f.CallReasonCode IN ('302'),1,0)) as status_302,
		SUM(IF(f.CallReasonCode IN ('303'),1,0)) as status_303,
		SUM(IF(f.CallReasonCode IN ('304'),1,0)) as status_304,
		SUM(IF(f.CallReasonCode IN ('305'),1,0)) as status_305,
		SUM(IF(f.CallReasonCode IN ('306'),1,0)) as status_306,
		SUM(IF(f.CallReasonCode IN ('307'),1,0)) as status_307,
		SUM(IF(f.CallReasonCode IN ('308'),1,0)) as status_308,
		SUM(IF(f.CallReasonCode IN ('309'),1,0)) as status_309,
		SUM(IF(f.CallReasonCode IN ('310'),1,0)) as status_310,
		SUM(IF(f.CallReasonCode IN ('311'),1,0)) as status_311,
		SUM(IF(f.CallReasonCode IN ('312'),1,0)) as status_312,
		SUM(IF(f.CallReasonCode IN ('313'),1,0)) as status_313,
		SUM(IF(f.CallReasonCode IN ('314'),1,0)) as status_314,
		SUM(IF(f.CallReasonCode IN ('315'),1,0)) as status_315,
		SUM(IF(f.CallReasonCode IN ('316'),1,0)) as status_316,
		SUM(IF(f.CallReasonCode IN ('317'),1,0)) as status_317,
		SUM(IF(f.CallReasonCode IN ('319'),1,0)) as status_319,
		SUM(IF(f.CallReasonCode IN ('401'),1,0)) as status_401,
		SUM(IF(f.CallReasonCode IN ('402'),1,0)) as status_402,
		SUM(IF(f.CallReasonCode IN ('601'),1,0)) as status_601,
		SUM(IF(f.CallReasonCode IN ('602'),1,0)) as status_602,
		SUM(IF(f.CallReasonCode IN ('603'),1,0)) as status_603,
		SUM(IF(f.CallReasonCode IN ('701'),1,0)) as status_701", 
FALSE);

 $UI->db->from("t_gn_callhistory a ");
 $UI->db->join("t_gn_customer b","a.CustomerId=b.CustomerId", "LEFT");
 //$UI->db->join("tms_agent c ","a.SPVCode = c.id", "LFET");
 $UI->db->join("tms_agent d ","a.ATMCode = d.id", "LFET");
 $UI->db->join("tms_agent e  ","a.AMGRCode = e.id", "LFET");
 $UI->db->join("t_lk_callreason f  ","a.CallReasonId = f.CallReasonId", "LEFT");
 
 $UI->db->where_not_in("f.CallReasonCode", $skip_status);
 $UI->db->where_in("b.CampaignId", $CampaignId );
 $UI->db->where("a.HistoryType", 0);
 $UI->db->where("a.CallHistoryCallDate>='{$Out->get_value('start_date','StartDate')}'", "", false);
 $UI->db->where("a.CallHistoryCallDate<='{$Out->get_value('end_date','EndDate')}'", "", false);
 $UI->db->where_in("d.UserId", array_map('intval', $Out->get_array_value('AtmId')));
 $UI->db->where_in("e.UserId", array_map('intval', $Out->get_array_value('ManagerId')));
 $UI->db->group_by(array('AssignSpv'));
 
//echo $UI->db->print_out();
 
 $rs = $UI->db->get();
  if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows ) 
 {
	$data[$rows['AssignSpv']]['tot_data_atempt'] +=$rows['data_size_atempt'];
	$data[$rows['AssignSpv']]['tot_data_status_000']+=$rows['status_000'];
	$data[$rows['AssignSpv']]['tot_data_status_101']+=$rows['status_101'];
	$data[$rows['AssignSpv']]['tot_data_status_102']+=$rows['status_102'];
	$data[$rows['AssignSpv']]['tot_data_status_103']+=$rows['status_103'];
	$data[$rows['AssignSpv']]['tot_data_status_201']+=$rows['status_201'];
	$data[$rows['AssignSpv']]['tot_data_status_202']+=$rows['status_202'];
	$data[$rows['AssignSpv']]['tot_data_status_203']+=$rows['status_203'];
	$data[$rows['AssignSpv']]['tot_data_status_204']+=$rows['status_204'];
	$data[$rows['AssignSpv']]['tot_data_status_205']+=$rows['status_205'];
	$data[$rows['AssignSpv']]['tot_data_status_206']+=$rows['status_206'];
	$data[$rows['AssignSpv']]['tot_data_status_207']+=$rows['status_207'];
	$data[$rows['AssignSpv']]['tot_data_status_208']+=$rows['status_208'];
	$data[$rows['AssignSpv']]['tot_data_status_209']+=$rows['status_209'];
	$data[$rows['AssignSpv']]['tot_data_status_210']+=$rows['status_210'];
	$data[$rows['AssignSpv']]['tot_data_status_211']+=$rows['status_211'];
	$data[$rows['AssignSpv']]['tot_data_status_301']+=$rows['status_301'];
	$data[$rows['AssignSpv']]['tot_data_status_302']+=$rows['status_302'];
	$data[$rows['AssignSpv']]['tot_data_status_303']+=$rows['status_303'];
	$data[$rows['AssignSpv']]['tot_data_status_304']+=$rows['status_304'];
	$data[$rows['AssignSpv']]['tot_data_status_305']+=$rows['status_305'];
	$data[$rows['AssignSpv']]['tot_data_status_306']+=$rows['status_306'];
	$data[$rows['AssignSpv']]['tot_data_status_307']+=$rows['status_307'];
	$data[$rows['AssignSpv']]['tot_data_status_308']+=$rows['status_308'];
	$data[$rows['AssignSpv']]['tot_data_status_309']+=$rows['status_309'];
	$data[$rows['AssignSpv']]['tot_data_status_310']+=$rows['status_310'];
	$data[$rows['AssignSpv']]['tot_data_status_311']+=$rows['status_311'];
	$data[$rows['AssignSpv']]['tot_data_status_312']+=$rows['status_312'];
	$data[$rows['AssignSpv']]['tot_data_status_313']+=$rows['status_313'];
	$data[$rows['AssignSpv']]['tot_data_status_314']+=$rows['status_314'];
	$data[$rows['AssignSpv']]['tot_data_status_315']+=$rows['status_315'];
	$data[$rows['AssignSpv']]['tot_data_status_316']+=$rows['status_316'];
	$data[$rows['AssignSpv']]['tot_data_status_317']+=$rows['status_317'];
	$data[$rows['AssignSpv']]['tot_data_status_701']+=$rows['status_701'];
	$data[$rows['AssignSpv']]['tot_data_status_401']+=$rows['status_401'];
	$data[$rows['AssignSpv']]['tot_data_status_402']+=$rows['status_402'];
	$data[$rows['AssignSpv']]['tot_data_status_601']+=$rows['status_601'];
	$data[$rows['AssignSpv']]['tot_data_status_602']+=$rows['status_602'];
	$data[$rows['AssignSpv']]['tot_data_status_603']+=$rows['status_603'];
	$data[$rows['AssignSpv']]['tot_data_status_319']+=$rows['status_319'];
 }
 
// ========================= get data talktime =========================
  
  $UI->db->reset_select();
  $UI->db->select("c.AssignSpv as AssignSpv, SUM(a.duration) as tot_talk_time ", FALSE);
  $UI->db->from("cc_recording a");
  $UI->db->join("t_gn_customer b "," a.assignment_data=b.CustomerId", "LEFT");
  $UI->db->join("t_gn_assignment c "," b.CustomerId=c.CustomerId","LEFT");
	
  $UI->db->where_in("b.CampaignId", $CampaignId); 
  $UI->db->where_in("c.AssignAmgr", array_map('intval', $Out->get_array_value('ManagerId')));
  $UI->db->where_in("c.AssignSpv", array_map('intval', $Out->get_array_value('AtmId')));
  $UI->db->where("a.start_time>='{$Out->get_value('start_date','StartDate')}'", "", false);
  $UI->db->where("a.start_time<='{$Out->get_value('end_date','EndDate')}'", "", false);
  $UI->db->group_by(array("AssignSpv"));
   
  $rs = $UI->db->get();
  if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows ) 
 {
	$data[$rows['AssignSpv']]['data_tot_talk_time'] +=$rows['tot_talk_time'];
 }
 

 // ---------------- get data policy achivement per product ----------------------
 $UI->db->reset_select();
 $UI->db->select("
	b.ProductId as ProductId,
	e.AssignSpv as AssignSpv,
	COUNT(a.PolicyId) as tot_nos_per_product,
	COUNT( distinct a.PolicyNumber) as tot_policy_per_product,
	SUM(a.PolicyPremi) as tot_premi_per_product,
	SUM(IF(c.PayModeId IN(2), (a.PolicyPremi * 12), a.PolicyPremi)) as tot_premi_anp_per_product", FALSE);
 $UI->db->from("t_gn_policy a ");
 
 $UI->db->join("t_gn_policyautogen b ","a.PolicyNumber=b.PolicyNumber", "LEFT");
 $UI->db->join("t_gn_productplan c ","a.ProductPlanId=c.ProductPlanId", "LEFT");
 $UI->db->join("t_gn_customer d ","b.CustomerId=d.CustomerId", "LEFT");
 $UI->db->join("t_gn_assignment e ","b.CustomerId=e.CustomerId", "LEFT");
 
 $UI->db->where_in("d.CampaignId", array_map('intval', $CampaignId)); 
 $UI->db->where_in("e.AssignSpv", array_map('intval', $Out->get_array_value('AtmId')));
 $UI->db->where_in("e.AssignAmgr", array_map('intval', $Out->get_array_value('ManagerId') ));
 
 $UI->db->where("a.PolicySalesDate>='{$Out->get_value('start_date','StartDate')}'", "", false);
 $UI->db->where("a.PolicySalesDate<='{$Out->get_value('end_date','EndDate')}'", "", false);
 $UI->db->group_by(array("AssignSpv","ProductId"));
 //echo $UI->db->print_out();
 
 
 $rs = $UI->db->get();
 if($rs->num_rows() > 0)  
	foreach( $rs->result_assoc() as $rows )
 {
	$data[$rows['AssignSpv']][$rows['ProductId']]['tot_nos_per_product']+= $rows['tot_nos_per_product'];
	$data[$rows['AssignSpv']][$rows['ProductId']]['tot_policy_per_product']+= $rows['tot_policy_per_product'];
	$data[$rows['AssignSpv']][$rows['ProductId']]['tot_premi_per_product']+= $rows['tot_premi_per_product'];
	$data[$rows['AssignSpv']][$rows['ProductId']]['tot_premi_anp_per_product']+= $rows['tot_premi_anp_per_product'];
 }
 
 
 
// ------------ data Coloseint policy sales ----------------------------------------------
  $UI->db->reset_select();
  $UI->db->select("
		COUNT(distinct b.PolicyNumber) as tot,
		a.PolicyNumber as PolicyNumber,
		e.AssignSpv as AssignSpv,
		COUNT(a.PolicyId) as tot_data_insured,
		SUM(IF(d.PayModeId IN(2), a.PolicyPremi, a.PolicyPremi)) as tot_data_premi,
		SUM(IF(d.PayModeId IN(2), (a.PolicyPremi * 12), a.PolicyPremi)) as tot_data_premi_anp", FALSE);
	
  $UI->db->from("t_gn_policy a ");
  $UI->db->join("t_gn_policyautogen b ","a.PolicyNumber=b.PolicyNumber", "LEFT");
  $UI->db->join("t_gn_customer c ","b.CustomerId=c.CustomerId", "LEFT");
  $UI->db->join("t_gn_productplan d ","a.ProductPlanId=d.ProductPlanId", "LEFT");
  $UI->db->join("t_gn_assignment e ","b.CustomerId=e.CustomerId", "LEFT");
  $UI->db->where_in("c.CampaignId", $CampaignId); 
  $UI->db->where_in("e.AssignSpv", $Out->get_array_value('AtmId'));
  $UI->db->where("a.PolicySalesDate>='{$Out->get_value('start_date','StartDate')}'", "", false);
  $UI->db->where("a.PolicySalesDate<='{$Out->get_value('end_date','EndDate')}'", "", false);
  
  $UI->db->group_by(array("PolicyNumber","AssignSpv"));
 
  $rs = $UI->db->get();
  if($rs->num_rows() > 0)  
		foreach( $rs-> result_assoc() as $rows )
{
	$data[$rows['AssignSpv']]['total_data_policy'] += $rows['tot'];
	$data[$rows['AssignSpv']]['tot_data_insured'] += $rows['tot_data_insured'];
	$data[$rows['AssignSpv']]['tot_data_premi'] += $rows['tot_data_premi'];
	$data[$rows['AssignSpv']]['tot_data_premi_anp'] += $rows['tot_data_premi_anp'];
}	

// ------------ select count user login on interval ---------------------------------
 $UI->db->reset_select();
 $UI->db->select("count(distinct a.ActivityUserId) as tot_user_tmr, a.ActivityUserId, b.spv_id as AssignSpv", FALSE);
 $UI->db->from("t_gn_activitylog a  ");
 $UI->db->join("tms_agent b ","a.ActivityUserId=b.UserId", "LEFT");
 $UI->db->where("a.ActivityDate>='{$Out->get_value('start_date','StartDate')}'", "", FALSE);
 $UI->db->where("a.ActivityDate<='{$Out->get_value('end_date','EndDate')}'", "", FALSE);
 $UI->db->where_in("b.handling_type",array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));
 $UI->db->where_in("b.spv_id",array_map('intval', $Out->get_array_value('AtmId')) );
 
 $UI->db->group_by("a.ActivityUserId");
 //echo $UI->db->print_out();
 
 $rs = $UI->db->get();
 if($rs->num_rows() > 0)  
	foreach( $rs-> result_assoc() as $rows )
{
	$data[$rows['AssignSpv']]['data_tot_user_login'] += $rows['tot_user_tmr'];
}
	
// ---- select day work data agent data -----------------------------------
	
 $UI->db->reset_select();
 $UI->db->select(" 1 As tot_day_work, 
				date_format(a.ActivityDate,'%Y-%m-%d') as tgl ", FALSE);
 $UI->db->from("t_gn_activitylog a  ");
 $UI->db->where("a.ActivityDate>='{$Out->get_value('start_date','StartDate')}'", "", FALSE);
 $UI->db->where("a.ActivityDate<='{$Out->get_value('end_date','EndDate')}'", "", FALSE);
 $UI->db->group_by("tgl");
	
 $rs = $UI->db->get();
 if($rs->num_rows() > 0)  
	foreach( $rs-> result_assoc() as $rows )
 {
	$data['data_tot_day_work'] += $rows['tot_day_work'];
 }
	
// ---------- get total work of hour in list ---

 $UI->db->reset_select();
 $UI->db->select(" a.ActivityUserId as UserId, date(a.ActivityDate) as tgl, b.spv_id as AssignSpv",FALSE);
 $UI->db->from("t_gn_activitylog a  ");	
 $UI->db->join("tms_agent b","a.ActivityUserId = b.UserId", "LEFT");
 $UI->db->where("a.ActivityDate>='{$Out->get_value('start_date','StartDate')}'", "", FALSE);
 $UI->db->where("a.ActivityDate<='{$Out->get_value('end_date','EndDate')}'", "", FALSE);
 $UI->db->where_in("b.handling_type",array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));
 $UI->db->where_in("b.spv_id",array_map('intval', $Out->get_array_value('AtmId')) );
 $UI->db->group_by(array("UserId", "tgl"));
 //echo $UI->db->print_out();
 
 $rs = $UI->db->get();
 if($rs->num_rows() > 0)  
	foreach( $rs-> result_assoc() as $rows )
 {
	$sql = " select UNIX_TIMESTAMP(MIN(a.ActivityDate)) as login, UNIX_TIMESTAMP(MAX(a.ActivityDate)) as logout from t_gn_activitylog a 
			  where a.ActivityUserId = {$rows['UserId']} 
			  and a.ActivityDate >= '{$rows['tgl']} 00:00:00'
			  and a.ActivityDate <= '{$rows['tgl']} 23:59:59'
			  and a.ActivityEvent IN('ACTION_EVENT_LOGIN', 'ACTION_EVENT_LOGOUT') ";
	$qry = $UI->db->query($sql);
	if($qry->num_rows() > 0 
		AND $row = $qry->result_first_assoc() )
	{
		if( count($row) > 0 ) { 
			$hour_maximum = ( (int)$row['logout'] - (int)$row['login']);
			$data[$rows['AssignSpv']]['data_tot_hour_work'] += $hour_maximum;
		}
	}	
 }
	 

// -----------------------------------------
$obUsers  = & get_class_instance('M_SysUser');

 
//------- define attribute summary ----------------------------------------------
 $sum_tot_data_user_login = 0;
 $sum_tot_data_persentation = 0;
 $sum_tot_acv_premi_anp = 0;
 $sum_tot_new_assign=0;
 $sum_tot_de_assign=0;
 $sum_tot_re_assign=0;
 $sum_tot_solicited_new_assign=0;
 $sum_tot_solicited_re_assign=0;
 $sum_tot_solicited_per_utilize=0;
 $sum_tot_sort_db_new=0;
 $sum_tot_attempt_call=0;
 $sum_tot_attempt_ratio=0;
 $sum_tot_connected_yes=0;
 $sum_tot_status_101=0;
 $sum_tot_status_102=0;
 $sum_tot_status_103=0;
 $sum_tot_connect_rate=0;
 $sum_tot_contacted_yes=0;
 $sum_tot_status_201=0;
 $sum_tot_status_202=0;
 $sum_tot_status_203=0;
 $sum_tot_status_204=0;
 $sum_tot_status_205=0;
 $sum_tot_status_206=0;
 $sum_tot_status_207=0;
 $sum_tot_status_208=0;
 $sum_tot_status_209=0;
 $sum_tot_status_210=0;
 $sum_tot_status_211=0;
 $sum_tot_contacted_rate=0;
 $sum_tot_sale_closing_rate=0;
 $sum_tot_response_rate=0;
 $sum_tot_persentation=0;
 $sum_tot_persentation_rate=0;
 $sum_tot_status_601=0;
 $sum_tot_status_602=0;
 $sum_tot_status_603=0;
 $sum_tot_status_301=0;
 $sum_tot_status_302=0;
 $sum_tot_status_303=0;
 $sum_tot_status_304=0;
 $sum_tot_status_305=0;
 $sum_tot_status_306=0;
 $sum_tot_status_307=0;
 $sum_tot_status_308=0;
 $sum_tot_status_309=0;
 $sum_tot_status_310=0;
 $sum_tot_status_311=0;
 $sum_tot_status_312=0;
 $sum_tot_status_313=0;
 $sum_tot_status_314=0;
 $sum_tot_status_315=0;
 $sum_tot_status_316=0;
 $sum_tot_status_317=0;
 $sum_tot_status_318=0;
 $sum_tot_status_401=0;
 $sum_tot_status_402=0;
 $sum_tot_status_701=0;
 
 $sum_tot_nos_rate=0;
 $sum_tot_acv_pif=0;
 $sum_tot_acv_nos=0;
 $sum_tot_acv_anp=0;
 $sum_tot_talk_time=0;
 $sum_tot_avg_talk_time_per_hour=0;
 $sum_tot_avg_talk_time_per_tmr=0;
 $sum_tot_work_hours=0;
 $sum_tot_tmr_login=0;
 $sum_tot_work_days=0;
 $sum_tot_productivity_per_tmr_pif=0;
 $sum_tot_productivity_per_tmr_anp=0;
 $sum_tot_avg_atempt_per_tmr=0;
 $sum_tot_avg_premi=0;
 $sum_tot_bad_list=0;
 $sum_data_followup = 0;
 $sum_tot_avg_bad_list = 0;
 $sum_tot_data_work_hours =0;
  

// ------ get attribute data user tmr  ----------------------------------
 
 $tot_data_work_days  = ( $data['data_tot_day_work'] ? $data['data_tot_day_work'] : 0);
 $tot_data_talk_hour = 0;
 
 
// --------------- loop --------------------------------
 
 if(is_array($AtmId ) ) 
	 foreach( $AtmId  as $key => $AssignSelerId )
{
	
// --------- index ----------------------- 
 $AgentName  = $rows['full_name'];
 $AgentId = $rows['UserId'];
 
// --------- get datat DB ---

 $call_data_content = $data[$AssignSelerId];

// ------------- total data talk time -----
 $tot_data_talk_time =($call_data_content['data_tot_talk_time']? $call_data_content['data_tot_talk_time'] : 0 ); 
 $tot_data_work_hours = ( $call_data_content['data_tot_hour_work'] ? $call_data_content['data_tot_hour_work'] : 0);
 $tot_data_user_login = ( $call_data_content['data_tot_user_login'] ? $call_data_content['data_tot_user_login'] : 0);
 $tot_data_format_hours = _getDuration($tot_data_work_hours);
 
 
// --------- total Policy Insured -----------

 $tot_data_policy = ( $call_data_content['total_data_policy'] ? $call_data_content['total_data_policy'] : 0 );
 $tot_data_insured = ( $call_data_content['tot_data_insured'] ? $call_data_content['tot_data_insured'] : 0 );
 $tot_data_premi  = ( $call_data_content['tot_data_premi'] ? $call_data_content['tot_data_premi'] : 0 );
 $tot_data_premi_anp = ( $call_data_content['tot_data_premi_anp'] ? $call_data_content['tot_data_premi_anp'] : 0 );
 
 $tot_format_data_premi = _getCurrency($tot_data_premi);
 $tot_format_data_premi_anp  = _getCurrency($tot_data_premi_anp);
 
 // ------------------------ all call Status -----------------------
 
 $tot_data_connected_y201 = ( $call_data_content['tot_data_status_201'] ? $call_data_content['tot_data_status_201'] : 0);
 $tot_data_connected_y202 = ( $call_data_content['tot_data_status_202'] ? $call_data_content['tot_data_status_202'] : 0);
 $tot_data_connected_y203 = ( $call_data_content['tot_data_status_203'] ? $call_data_content['tot_data_status_203'] : 0);
 $tot_data_connected_y204 = ( $call_data_content['tot_data_status_204'] ? $call_data_content['tot_data_status_204'] : 0);
 $tot_data_connected_y205 = ( $call_data_content['tot_data_status_205'] ? $call_data_content['tot_data_status_205'] : 0);
 $tot_data_connected_y206 = ( $call_data_content['tot_data_status_206'] ? $call_data_content['tot_data_status_206'] : 0);
 $tot_data_connected_y207 = ( $call_data_content['tot_data_status_207'] ? $call_data_content['tot_data_status_207'] : 0);
 $tot_data_connected_y208 = ( $call_data_content['tot_data_status_208'] ? $call_data_content['tot_data_status_208'] : 0);
 $tot_data_connected_y209 = ( $call_data_content['tot_data_status_209'] ? $call_data_content['tot_data_status_209'] : 0);
 $tot_data_connected_y210 = ( $call_data_content['tot_data_status_210'] ? $call_data_content['tot_data_status_210'] : 0);
 $tot_data_connected_y211 = ( $call_data_content['tot_data_status_211'] ? $call_data_content['tot_data_status_211'] : 0);
 $tot_data_connected_n101 = ( $call_data_content['tot_data_status_101'] ? $call_data_content['tot_data_status_101'] : 0 );
 $tot_data_connected_n102 = ( $call_data_content['tot_data_status_102'] ? $call_data_content['tot_data_status_102'] : 0 );
 $tot_data_connected_n103 = ( $call_data_content['tot_data_status_103'] ? $call_data_content['tot_data_status_103'] : 0 );
 
 $tot_data_not_interest_301 = ( $call_data_content['tot_data_status_301'] ? $call_data_content['tot_data_status_301'] : 0);
 $tot_data_not_interest_302 = ( $call_data_content['tot_data_status_302'] ? $call_data_content['tot_data_status_302'] : 0);
 $tot_data_not_interest_303 = ( $call_data_content['tot_data_status_303'] ? $call_data_content['tot_data_status_303'] : 0);
 $tot_data_not_interest_304 = ( $call_data_content['tot_data_status_304'] ? $call_data_content['tot_data_status_304'] : 0);
 $tot_data_not_interest_305 = ( $call_data_content['tot_data_status_305'] ? $call_data_content['tot_data_status_305'] : 0);
 $tot_data_not_interest_306 = ( $call_data_content['tot_data_status_306'] ? $call_data_content['tot_data_status_306'] : 0);
 $tot_data_not_interest_307 = ( $call_data_content['tot_data_status_307'] ? $call_data_content['tot_data_status_307'] : 0);
 $tot_data_not_interest_308 = ( $call_data_content['tot_data_status_308'] ? $call_data_content['tot_data_status_308'] : 0);
 $tot_data_not_interest_309 = ( $call_data_content['tot_data_status_309'] ? $call_data_content['tot_data_status_309'] : 0);
 $tot_data_not_interest_310 = ( $call_data_content['tot_data_status_310'] ? $call_data_content['tot_data_status_310'] : 0);
 $tot_data_not_interest_311 = ( $call_data_content['tot_data_status_311'] ? $call_data_content['tot_data_status_311'] : 0);
 $tot_data_not_interest_312 = ( $call_data_content['tot_data_status_312'] ? $call_data_content['tot_data_status_312'] : 0);
 $tot_data_not_interest_313 = ( $call_data_content['tot_data_status_313'] ? $call_data_content['tot_data_status_313'] : 0);
 $tot_data_not_interest_314 = ( $call_data_content['tot_data_status_314'] ? $call_data_content['tot_data_status_314'] : 0);
 $tot_data_not_interest_315 = ( $call_data_content['tot_data_status_315'] ? $call_data_content['tot_data_status_315'] : 0);
 $tot_data_not_interest_316 = ( $call_data_content['tot_data_status_316'] ? $call_data_content['tot_data_status_316'] : 0);
 $tot_data_not_interest_317 = ( $call_data_content['tot_data_status_317'] ? $call_data_content['tot_data_status_317'] : 0);

 $tot_data_interest_601 = ( $call_data_content['tot_data_status_601'] ? $call_data_content['tot_data_status_601'] : 0);
 $tot_data_interest_602 = ( $call_data_content['tot_data_status_602'] ? $call_data_content['tot_data_status_602'] : 0);
 $tot_data_interest_603 = ( $call_data_content['tot_data_status_603'] ? $call_data_content['tot_data_status_603'] : 0);
 
 $tot_data_call_status_318 = ( $call_data_content['tot_data_status_318'] ? $call_data_content['tot_data_status_318'] : 0);
 $tot_data_call_status_401 = ( $call_data_content['tot_data_status_401'] ? $call_data_content['tot_data_status_401'] : 0);
 $tot_data_call_status_402 = ( $call_data_content['tot_data_status_402'] ? $call_data_content['tot_data_status_402'] : 0);  
 $tot_data_call_status_701 = ( $call_data_content['tot_data_status_701'] ? $call_data_content['tot_data_status_701'] : 0);  
 
// ----------------- persentation ----------------- 
 $tot_data_persentation = ( $tot_data_not_interest_301+ 
							$tot_data_not_interest_302+
							$tot_data_not_interest_303+
							$tot_data_not_interest_304+
							$tot_data_not_interest_305+
							$tot_data_not_interest_306+
							$tot_data_not_interest_307+
							$tot_data_not_interest_308+
							$tot_data_not_interest_309+
							$tot_data_not_interest_310+
							$tot_data_not_interest_311+
							$tot_data_not_interest_312+
							$tot_data_not_interest_313+
							$tot_data_not_interest_314+
							$tot_data_not_interest_315+
							$tot_data_not_interest_316+
							$tot_data_not_interest_317+
							$tot_data_call_status_318+
							$tot_data_call_status_401+
							$tot_data_call_status_402+
							$tot_data_interest_601+
							$tot_data_interest_602+
							$tot_data_interest_603);
							
 $tot_contacted_y = ($tot_data_persentation + $tot_data_call_status_701);
 
 $tot_data_followup = ($tot_data_call_status_401+$tot_data_call_status_402);
 
 $tot_data_bad_list = ($tot_data_connected_n101+ $tot_data_connected_n102+ $tot_data_connected_n103+$tot_data_connected_y204+$tot_data_connected_y209+ $tot_data_connected_y211);
 
 $tot_data_connected_y = ( $tot_data_connected_y201+
					       $tot_data_connected_y202+
						   $tot_data_connected_y203+
						   $tot_data_connected_y204+
						   $tot_data_connected_y205+
						   $tot_data_connected_y206+
						   $tot_data_connected_y207+
						   $tot_data_connected_y208+
						   $tot_data_connected_y209+
						   $tot_data_connected_y210+
						   $tot_data_connected_y211+ 
						   $tot_data_call_status_701+
						   $tot_data_persentation);
						   
$tot_connected_call =($tot_data_connected_y+$tot_data_connected_n101+$tot_data_connected_n102+$tot_data_connected_n103);
						   
// ------------ data iniated -----------------------------------------------
 
 $tot_new_assigned_data = ( $call_data_content['tot_new_assigned'] ? $call_data_content['tot_new_assigned']: 0);
 $tot_re_assigned_data = ( $call_data_content['tot_re_assigned'] ? $call_data_content['tot_re_assigned'] : 0 );
 $tot_solicited_new_assign = ( $call_data_content['data_new_utilize'] ? $call_data_content['data_new_utilize'] : 0 );
 $tot_solicited_re_utilized = ( $call_data_content['data_old_utilize'] ? $call_data_content['data_old_utilize'] : 0 );
 
 // $tot_solicited_re_utilized = 0;
 // $tot_solicited_re_utilized = ( $tot_solicited_new_assign - $tot_connected_call);
 
// ------------------ solicited ----------------------------------------------------	
 
 $tot_data_utilize = ($call_data_content['data_all_solicited']?$call_data_content['data_all_solicited']:0); //( $tot_solicited_new_assign + $tot_solicited_re_utilized);
 
 $tot_data_sort_new_db = ($tot_new_assigned_data-$tot_solicited_new_assign );
 $tot_data_atempt = ( $call_data_content['tot_data_atempt'] ? $call_data_content['tot_data_atempt'] : 0 );
 $tot_data_format_talk_time = _getDuration($tot_data_talk_time);
 
// --------------- response rate --------------------------
 $avg_response_rate = ( $tot_data_utilize ? _setPercent(($tot_data_policy/$tot_data_utilize)): 0 );
 $avg_sales_closing = ( $tot_contacted_y ? _setPercent(($tot_data_policy/$tot_contacted_y)) : 0 );
 $avg_data_followup  = ( $tot_contacted_y ? _setPercent(($tot_data_followup/$tot_contacted_y)) : 0);
 $avg_data_persentation  = ( ($tot_contacted_y) ? _setPercent(($tot_data_persentation/$tot_contacted_y)): 0);
 $avg_data_nos_rate = ( $tot_data_policy ? _setPercent( (($tot_data_insured-$tot_data_policy)/$tot_data_policy)) : 0);
 $avg_data_contacted_rate  = ( $tot_data_utilize ? ( $tot_contacted_y/$tot_data_utilize) : "" );
 $avg_data_format_contacted_rate  = _setPercent( $avg_data_contacted_rate);
 $avg_data_atempt = ( $tot_data_utilize ? number_format(($tot_data_atempt/ $tot_data_utilize),1) : 0 );
 $avg_data_connect_rate  = ( $tot_data_atempt ? _setPercent( $tot_data_connected_y/$tot_data_atempt): 0 );
// --- total data badlist ----------------------

						 
 $avg_data_bad_list = ( $tot_data_utilize ? _setPercent(($tot_data_bad_list/$tot_data_utilize)): 0);

 // changes Average Tlktime Per Hour
 // changes to : 
 //$avg_data_talk_time_hours = ( $tot_data_work_hours ? ($tot_data_talk_time/($tot_data_work_hours/const_hours() ) ): 0 );
 $avg_data_talk_time_hours = ( $tot_data_work_hours ? ($tot_data_talk_time/ $tot_data_work_hours/const_hours() ): 0 );


 $avg_data_format_talk_time_hour = _getDuration($avg_data_talk_time_hours);
 $avg_data_talk_time_per_tmr = ( $tot_data_talk_time ? ($tot_data_talk_time/$tot_data_user_login) : 0);   
 $avg_data_format_talk_time_per_tmr = _getDuration($avg_data_talk_time_per_tmr);
 
// ----------------- productivity -------------------------- 
 
 $avg_data_productivity_pif_per_tmr = ( ($tot_data_user_login) ? ( $tot_data_policy/$tot_data_user_login/$tot_data_work_days ) : 0);
 $avg_data_format_productivity_pif_per_tmr = _setRound($avg_data_productivity_pif_per_tmr,1);
 $avg_data_productivity_premi_per_tmr = ( ($tot_data_user_login) ? ( $tot_data_premi/$tot_data_user_login/$tot_data_work_days ) : 0);
 $avg_data_format_productivity_premi_per_tmr = _getCurrency($avg_data_productivity_premi_per_tmr);
 $avg_data_productivity_anp_per_tmr = ( ($tot_data_user_login) ? ( $tot_data_premi_anp/$tot_data_user_login/$tot_data_work_days ) : 0);
 $avg_data_format_productivity_anp_per_tmr = _getCurrency( $avg_data_productivity_anp_per_tmr );
 $avg_data_productivity_atempt_per_tmr = ( ($tot_data_user_login) ? ($tot_data_atempt/$tot_data_user_login/$tot_data_work_days) : 0); 
 $avg_data_format_productivity_atempt_per_tmr = _setRound( $avg_data_productivity_atempt_per_tmr, 2);
 $avg_data_productivity_premi_per_policy_per_year = ( $tot_data_policy ? (($tot_data_premi/$tot_data_policy)) : 0);
 $avg_data_format_productivity_premi_per_policy_per_year = _getCurrency($avg_data_productivity_premi_per_policy_per_year);
 $avg_data_persentation_rate  = ( $tot_data_persentation ? _setPercent($tot_data_policy/ $tot_data_persentation) : 0);
 $avg_data_reject_upfront_rate = _setPercent( ( $tot_contacted_y ? ( $tot_data_call_status_701 /$tot_contacted_y ) : 0 ));
 
 
// ====================================== 
 $obInst = new EUI_Object( $obUsers->_getUserDetail( $AssignSelerId ));
  echo "<tr>
		  <td>". $obInst->get_value('Username') ."</td>
		  <td align='right'>{$tot_new_assigned_data}</td>
		  <td align='right'>{$tot_re_assigned_data}</td>
		  <td align='right'>{$tot_solicited_new_assign}</td>
		  <td align='right'>{$tot_solicited_re_utilized}</td>
		  <td align='right'>{$tot_data_utilize}</td>
		  <td align='right'>{$tot_data_sort_new_db}</td>
		  <td align='right'>{$tot_data_atempt}</td>
		  <td align='right'>{$avg_data_atempt}</td>
		  <td align='right'>{$tot_data_connected_y}</td>
		  <td align='right'>{$tot_data_connected_n101}</td>
		  <td align='right'>{$tot_data_connected_n102}</td>
		  <td align='right'>{$tot_data_connected_n103}</td>
		  <td align='right'>{$avg_data_connect_rate}</td>
		  <td align='right'>{$tot_contacted_y}</td>
		  <td align='right'>{$tot_data_connected_y201}</td>
		  <td align='right'>{$tot_data_connected_y202}</td>
		  <td align='right'>{$tot_data_connected_y203}</td>
		  <td align='right'>{$tot_data_connected_y204}</td>
		  <td align='right'>{$tot_data_connected_y205}</td>
		  <td align='right'>{$tot_data_connected_y206}</td>
		  <td align='right'>{$tot_data_connected_y207}</td>
		  <td align='right'>{$tot_data_connected_y208}</td>
		  <td align='right'>{$tot_data_connected_y209}</td>
		  <td align='right'>{$tot_data_connected_y210}</td>
		  <td align='right'>{$tot_data_connected_y211}</td>
		  <td align='right'>{$avg_data_format_contacted_rate}</td>
		  <td align='right'>{$tot_data_persentation}</td>
		  <td align='right'>{$avg_data_persentation}</td>
		  <td align='right'>{$tot_data_interest_601}</td>
		  <td align='right'>{$tot_data_interest_602}</td>
		  <td align='right'>{$tot_data_interest_603}</td>
		  <td align='right'>{$tot_data_not_interest_301}</td>
		  <td align='right'>{$tot_data_not_interest_302}</td>
		  <td align='right'>{$tot_data_not_interest_303}</td>
		  <td align='right'>{$tot_data_not_interest_304}</td>
		  <td align='right'>{$tot_data_not_interest_305}</td>
		  <td align='right'>{$tot_data_not_interest_306}</td>
		  <td align='right'>{$tot_data_not_interest_307}</td>
		  <td align='right'>{$tot_data_not_interest_308}</td>
		  <td align='right'>{$tot_data_not_interest_309}</td>
		  <td align='right'>{$tot_data_not_interest_310}</td>
		  <td align='right'>{$tot_data_not_interest_311}</td>
		  <td align='right'>{$tot_data_not_interest_312}</td>
		  <td align='right'>{$tot_data_not_interest_313}</td>
		  <td align='right'>{$tot_data_not_interest_314}</td>
		  <td align='right'>{$tot_data_not_interest_315}</td>
		  <td align='right'>{$tot_data_not_interest_316}</td>
		  <td align='right'>{$tot_data_not_interest_317}</td>".
		  
		  //<td align='right'>{$tot_data_call_status_318}</td>
		  
		  "<td align='right'>{$tot_data_call_status_701}</td>
		  <td align='right'>{$avg_data_reject_upfront_rate}</td>
		  <td align='right'>{$tot_data_call_status_401}</td>
		  <td align='right'>{$tot_data_call_status_402}</td>
		  <td align='right'>{$avg_data_followup}</td>
		  <td align='right'>{$tot_data_policy}</td>
		  <td align='right'>{$tot_data_insured}</td>
		  <td align='right'>{$tot_format_data_premi}</td>
		  <td align='right'>{$tot_format_data_premi_anp}</td>";
		  
		  
		    if( is_array($arr_product) ) 
			foreach( $arr_product as $ProductId => $ProductName ) 
		 {
			$tot_pif_per_product 	= ( $call_data_content[$ProductId]['tot_policy_per_product'] ? $call_data_content[$ProductId]['tot_policy_per_product'] : 0);
			$tot_nos_per_product 	= ( $call_data_content[$ProductId]['tot_nos_per_product'] ? $call_data_content[$ProductId]['tot_nos_per_product'] : 0);
			$tot_premi_per_product 	= ( $call_data_content[$ProductId]['tot_premi_per_product'] ? $call_data_content[$ProductId]['tot_premi_per_product'] : 0 );
			$tot_anp_per_product 	= ( $call_data_content[$ProductId]['tot_premi_anp_per_product']?$call_data_content[$ProductId]['tot_premi_anp_per_product'] : 0 );
			
			// --------- fomater -------------------
			
			$tot_format_premi_per_product = _getCurrency($tot_premi_per_product);
			$tot_format_anp_per_product = _getCurrency($tot_anp_per_product);
			
			echo "<td align='right'>{$tot_pif_per_product}</td>
				  <td align='right'>{$tot_nos_per_product}</td>
				  <td align='right'>{$tot_format_premi_per_product}</td>
				  <td align='right'>{$tot_format_anp_per_product}</td>";
				  
			// ----------- sum of bottom data ---------------------------------
			
			$sum_tot_pif_per_product[$ProductId]	+= $tot_pif_per_product; 
			$sum_tot_nos_per_product[$ProductId]	+= $tot_nos_per_product; 
			$sum_tot_premi_per_product[$ProductId]	+= $tot_premi_per_product; 
			$sum_tot_anp_per_product[$ProductId]	+= $tot_anp_per_product;
			
			  
		 }
		 
		 echo "<td align='right'>{$avg_sales_closing}</td>
		  <td align='right'>{$avg_data_persentation_rate}</td>
		  <td align='right'>{$avg_response_rate}</td>
		  <td align='right'>{$avg_data_nos_rate}</td>
		  <td align='right'>{$tot_data_format_talk_time}</td>
		  <td align='right'>{$avg_data_format_talk_time_hour}</td>
		  <td align='right'>{$avg_data_format_talk_time_per_tmr}</td>
		  <td align='right'>{$tot_data_format_hours}</td>
		  <td align='right'>{$tot_data_user_login}</td>
		  <td align='right'>{$tot_data_work_days}</td>
		  <td align='right'>{$avg_data_format_productivity_pif_per_tmr}</td>
		  <td align='right'>{$avg_data_format_productivity_premi_per_tmr}</td>
		  <td align='right'>{$avg_data_format_productivity_anp_per_tmr}</td>
		  <td align='right'>{$avg_data_format_productivity_atempt_per_tmr}</td>
		  <td align='right'>{$avg_data_format_productivity_premi_per_policy_per_year}</td>
		  <td align='right'>{$tot_data_bad_list}</td>
		  <td align='right'>{$avg_data_bad_list}</td>
	 </tr>";
	 
	 
	
	// ------------------- summary attribute data ---------------------------------------
	 
	 $sum_tot_new_assign+= $tot_new_assigned_data;
	 $sum_tot_de_assign+= $tot_de_assigned_data;
	 $sum_tot_re_assign+= $tot_re_assigned_data;
	 $sum_tot_solicited_new_assign+= $tot_solicited_new_assign;
	 $sum_tot_solicited_re_assign+= $tot_solicited_re_utilized;
	 $sum_tot_solicited_per_utilize+= $tot_data_utilize;
	 $sum_tot_sort_db_new+=$tot_data_sort_new_db;
	 $sum_tot_attempt_call+=$tot_data_atempt;
	 $sum_tot_connected_yes+=$tot_data_connected_y;
	 
	 // ------------------ summary  of contacted [  Y ]total bottom -------------------------
	 
	 $sum_tot_status_201+= $tot_data_connected_y201;
	 $sum_tot_status_202+= $tot_data_connected_y202;
	 $sum_tot_status_203+= $tot_data_connected_y203;
	 $sum_tot_status_204+= $tot_data_connected_y204;
	 $sum_tot_status_205+= $tot_data_connected_y205;
	 $sum_tot_status_206+= $tot_data_connected_y206;
	 $sum_tot_status_207+= $tot_data_connected_y207;
	 $sum_tot_status_208+= $tot_data_connected_y208;
	 $sum_tot_status_209+= $tot_data_connected_y209;
	 $sum_tot_status_210+= $tot_data_connected_y210;
	 $sum_tot_status_211+= $tot_data_connected_y211;
	 
	// ------------------ summary  of contacted [ N ]total bottom ------------------------- 

	 $sum_tot_status_101+= $tot_data_connected_n101;
	 $sum_tot_status_102+= $tot_data_connected_n102;
	 $sum_tot_status_103+= $tot_data_connected_n103;
	 
	// ------------------ summary  of  Interest total bottom -------------------------'

	 $sum_tot_status_601+= $tot_data_interest_601;
	 $sum_tot_status_602+= $tot_data_interest_602;
	 $sum_tot_status_603+= $tot_data_interest_603;

	// ------------------ summary  of  Not Interest total bottom -------------------------
	 $sum_tot_status_301+= $tot_data_not_interest_301;
	 $sum_tot_status_302+= $tot_data_not_interest_302;
	 $sum_tot_status_303+= $tot_data_not_interest_303;
	 $sum_tot_status_304+= $tot_data_not_interest_304;
	 $sum_tot_status_305+= $tot_data_not_interest_305;
	 $sum_tot_status_306+= $tot_data_not_interest_306;
	 $sum_tot_status_307+= $tot_data_not_interest_307;
	 $sum_tot_status_308+= $tot_data_not_interest_308;
	 $sum_tot_status_309+= $tot_data_not_interest_309;
	 $sum_tot_status_310+= $tot_data_not_interest_310;
	 $sum_tot_status_311+= $tot_data_not_interest_311;
	 $sum_tot_status_312+= $tot_data_not_interest_312;
	 $sum_tot_status_313+= $tot_data_not_interest_313;
	 $sum_tot_status_314+= $tot_data_not_interest_314;
	 $sum_tot_status_315+= $tot_data_not_interest_315;
	 $sum_tot_status_316+= $tot_data_not_interest_316;
	 $sum_tot_status_317+= $tot_data_not_interest_317;
	 $sum_tot_status_701+= $tot_data_call_status_701;
	 
	// --------------- summary of Unpersent ---------------------------------------
	 $sum_tot_persentation+=$tot_data_persentation;
	 $sum_tot_status_318+= $tot_data_call_status_318;
	 
	 // --------------- summary of followup & ---------------------------------------

	 $sum_tot_status_401+= $tot_data_call_status_401; 
	 $sum_tot_status_402+= $tot_data_call_status_402;
	 $sum_tot_acv_pif+= $tot_data_policy;
	 $sum_tot_acv_nos+= $tot_data_insured;
	 $sum_tot_acv_premi+= $tot_data_premi;
	 $sum_tot_acv_premi_anp+= $tot_data_premi_anp;
	 $sum_tot_talk_time+= $tot_data_talk_time;
	 $sum_tot_bad_list +=$tot_data_bad_list;
	 $sum_data_followup +=$tot_data_followup; 
	 $sum_tot_data_persentation +=$tot_data_persentation;
	 $sum_tot_data_user_login += $tot_data_user_login;
	 
	
	 
}
 
 
 $sum_tot_tmr_login = $sum_tot_data_user_login;
 $sum_tot_work_days = $tot_data_work_days;
 $sum_tot_work_hours = $tot_data_work_hours;
 
 $sum_tot_contacted = ($sum_tot_persentation+$sum_tot_status_701);
 $sum_tot_attempt_ratio = ($sum_tot_solicited_per_utilize  ? ($sum_tot_attempt_call/ $sum_tot_solicited_per_utilize) : 0 );
 $sum_tot_connect_rate  = ($sum_tot_attempt_call ? ($sum_tot_connected_yes/ $sum_tot_attempt_call) : 0 );
 $sum_tot_contacted_rate = ($sum_tot_solicited_per_utilize ? ($sum_tot_contacted/ $sum_tot_solicited_per_utilize) : 0 );
 $sum_tot_sale_closing_rate = ($sum_tot_contacted ? ($sum_tot_acv_pif/$sum_tot_contacted) : 0 );
 $sum_tot_response_rate = ($sum_tot_solicited_per_utilize ? ( $sum_tot_acv_pif/$sum_tot_solicited_per_utilize): 0);
 $sum_tot_persentation_rate = ($sum_tot_contacted ? ( $sum_tot_persentation /$sum_tot_contacted ) : 0);
 $sum_tot_nos_rate = (($sum_tot_acv_nos - $sum_tot_acv_pif ) ? ( ( $sum_tot_acv_nos - $sum_tot_acv_pif )/$sum_tot_acv_pif) : 0); 
 $sum_tot_avg_talk_time_per_hour= ( $sum_tot_work_hours ? ($sum_tot_talk_time/($sum_tot_work_hours/const_hours() ) ): 0 );
 $sum_tot_avg_talk_time_per_tmr= ( $sum_tot_talk_time ? ($sum_tot_talk_time/ $sum_tot_tmr_login) : 0);
 $sum_tot_productivity_per_tmr_pif = (($sum_tot_tmr_login) ? ($sum_tot_acv_pif/$sum_tot_tmr_login/$tot_data_work_days) : 0);
 $sum_tot_productivity_per_tmr_premi = (($sum_tot_tmr_login) ? ($sum_tot_acv_premi/$sum_tot_tmr_login/$tot_data_work_days) : 0);
 
 $sum_tot_avg_atempt_per_tmr = (($sum_tot_tmr_login) ? ($sum_tot_attempt_call/$sum_tot_tmr_login/$tot_data_work_days) : 0); 
 $sum_tot_avg_premi = ( $sum_tot_acv_pif ? ($sum_tot_acv_premi/ $sum_tot_acv_pif) : 0);
 $sum_tot_avg_followup = ( $sum_tot_contacted ? ($sum_data_followup/$sum_tot_contacted) : 0);
 $sum_tot_avg_bad_list = ( $sum_tot_solicited_per_utilize ? ($sum_tot_bad_list/$sum_tot_solicited_per_utilize) : 0);
  
  // --- slaes persentation rate 
 $sum_avg_data_persentation_rate  = ( $sum_tot_data_persentation ? ($sum_tot_acv_pif/ $sum_tot_data_persentation) : 0);
 $sum_avg_data_productivity_anp_per_tmr = ( ($sum_tot_tmr_login) ? ( $sum_tot_acv_premi_anp/$sum_tot_tmr_login/$tot_data_work_days ) : 0);
  

 
 
// --------------------------------------------------------------------------------------------------------
 
 $sum_tot_format_attempt_ratio 	 	= _setRound($sum_tot_attempt_ratio);
 $sum_tot_format_connect_rate 	 	= _setPercent($sum_tot_connect_rate);
 $sum_tot_format_contacted_rate  	= _setPercent($sum_tot_contacted_rate);
 $sum_tot_format_nos_rate 		    = _setPercent($sum_tot_nos_rate);
 $sum_tot_format_response_rate 	    = _setPercent($sum_tot_response_rate);
 $sum_tot_format_persentation_rate  = _setPercent($sum_tot_persentation_rate);
 $sum_tot_format_sale_closing_rate  = _setPercent($sum_tot_sale_closing_rate);
 $sum_tot_productivity_per_tmr_pif  = _setRound($sum_tot_productivity_per_tmr_pif);
 $sum_tot_avg_atempt_per_tmr 	    = _setRound($sum_tot_avg_atempt_per_tmr);
 $sum_tot_format_avg_followup	    = _setPercent($sum_tot_avg_followup);
 $sum_tot_format_avg_bad_list		= _setPercent($sum_tot_avg_bad_list);
 $sum_tot_format_acv_anp 			= _getCurrency($sum_tot_acv_premi);
 $sum_tot_format_acv_premi_anp  	= _getCurrency($sum_tot_acv_premi_anp);
 $sum_avg_format_persentation_rate  = _setPercent($sum_avg_data_persentation_rate);
 $sum_avg_format_data_productivity_anp_per_tmr = _getCurrency($sum_avg_data_productivity_anp_per_tmr);
 
 // ----------- other format  ----------------------------------------------------------------
 $sum_tot_format_talk_time 				= _getDuration($sum_tot_talk_time);
 $sum_tot_format_work_hours 			= _getDuration($sum_tot_work_hours);
 $sum_tot_format_avg_talk_time_per_hour = _getDuration($sum_tot_avg_talk_time_per_hour);  
 $sum_tot_format_avg_talk_time_per_tmr 	= _getDuration($sum_tot_avg_talk_time_per_tmr); 
 $sum_tot_productivity_per_tmr_premi 	= _getCurrency($sum_tot_productivity_per_tmr_premi); 
 $sum_tot_avg_premi 					= _getCurrency($sum_tot_avg_premi);
 $sum_totdata_avg_reject_upfront_rate = _setPercent(( $sum_tot_contacted ? ($sum_tot_status_701/$sum_tot_contacted) : 0 ));
   
 
echo "<tr>
		<td class=\"head\">Summary</td>
		<td class=\"head\" align=\"right\">{$sum_tot_new_assign}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_re_assign}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_solicited_new_assign}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_solicited_re_assign}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_solicited_per_utilize}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_sort_db_new}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_attempt_call}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_attempt_ratio}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_connected_yes}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_101}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_102}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_103}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_connect_rate}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_contacted}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_201}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_202}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_203}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_204}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_205}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_206}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_207}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_208}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_209}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_210}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_211}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_contacted_rate}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_persentation}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_persentation_rate}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_601}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_602}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_603}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_301}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_302}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_303}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_304}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_305}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_306}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_307}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_308}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_309}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_310}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_311}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_312}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_313}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_314}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_315}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_316}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_317}</td>".
		
		//<td class=\"head\" align=\"right\">{$sum_tot_status_318}</td>
		
		"<td class=\"head\" align=\"right\">{$sum_tot_status_701}</td>
		<td class=\"head\" align=\"right\">{$sum_totdata_avg_reject_upfront_rate}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_401}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_402}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_avg_followup}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_acv_pif}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_acv_nos}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_acv_anp}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_acv_premi_anp}</td>";
		
		 if( is_array($arr_product) ) 
			foreach( $arr_product as $ProductId => $ProductName ) 
		 {
			$sum_format_tot_pif_per_product	  = ($sum_tot_pif_per_product[$ProductId]?$sum_tot_pif_per_product[$ProductId]:0);
			$sum_format_tot_nos_per_product	  = ($sum_tot_nos_per_product[$ProductId]?$sum_tot_nos_per_product[$ProductId]:0);
			$sum_format_tot_premi_per_product = ($sum_tot_premi_per_product[$ProductId]? _getCurrency($sum_tot_premi_per_product[$ProductId]):0);
			$sum_format_tot_anp_per_product   = ($sum_tot_anp_per_product[$ProductId]? _getCurrency($sum_tot_anp_per_product[$ProductId]):0);

 
			echo "<td class=\"head\" align=\"right\">{$sum_format_tot_pif_per_product}</td>
				  <td class=\"head\" align=\"right\">{$sum_format_tot_nos_per_product}</td>
				  <td class=\"head\" align=\"right\">{$sum_format_tot_premi_per_product}</td>
				  <td class=\"head\" align=\"right\">{$sum_format_tot_anp_per_product}</td>";
		 }
		
		
		echo "<td class=\"head\" align=\"right\">{$sum_tot_format_sale_closing_rate}</td>
		<td class=\"head\" align=\"right\">{$sum_avg_format_persentation_rate}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_response_rate}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_nos_rate}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_talk_time}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_avg_talk_time_per_hour}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_avg_talk_time_per_tmr}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_work_hours}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_tmr_login}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_work_days}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_productivity_per_tmr_pif}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_productivity_per_tmr_premi}</td>
		<td class=\"head\" align=\"right\">{$sum_avg_format_data_productivity_anp_per_tmr}</td>
		
		<td class=\"head\" align=\"right\">{$sum_tot_avg_atempt_per_tmr}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_avg_premi}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_bad_list}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_avg_bad_list}</td>
 </tr> </table> ";
 	
}


//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 function _select_campaign_group_per_atm_detail( $AtmId =0 )
{
   global $gReportSession, $skip_status;
  $UI=& get_instance(); // load db ;
	
/* ------------------------------------------------------------- */
	$cls=& get_class_instance("M_CallTrackingReport");
	$obj=& new EUI_Object( _get_all_request() );
    
	$SpvId = array_keys($cls->_select_report_spv_by_atm($AtmId));
	$TmrId = array_keys($cls->_select_report_tmr_by_atm($AtmId));
	
	$SpvId = ( count($SpvId) == 0 ? array(0) : $SpvId);
	$TmrId = ( count($TmrId) == 0 ? array(0) :  $TmrId); 
 
	$CampaignId = _select_report_campaign_id();

// --------------------------------------------- 
 $arr_product = _select_report_active_product();
 $colspan = (4*count( $arr_product));
 
echo "<table class=\"data\" border=1 style=\"border-collapse: collapse\">
	 <tr>
	  <td class=\"head\" rowspan=3 align=\"center\" style=\"vertical-align:middle;\">SPV</td>
	 <td class=\"head\" colspan=6>DB</td>
	  <td class=\"head\" rowspan=3>Attempted</td>
	  <td class=\"head\" rowspan=3>Attempt Ratio</td>
	  <td class=\"head\" colspan=5>Connected</td>
	  <td class=\"head\" colspan=13>Contacted</td>
	  <td class=\"head\" ></td>
	  <td class=\"head\" align=\"center\" colspan=21>Presentation</td>
	  <td class=\"head\" colspan=2>UnPresent</td>
	  <td class=\"head\" colspan=3>Follow Up</td>
	  <td class=\"head\" colspan=4>Achievement</td>
	  <td class=\"head\" colspan=\"$colspan\" align=\"center\">Product Achievement</td>
	  <td class=\"head\" rowspan=3>Sales Closing Rate</td>
	  <td class=\"head\" rowspan=3>Sales Presentation Rate</td>
	  <td class=\"head\" rowspan=3>Response Rate</td>
	  <td class=\"head\" rowspan=3>NOS Rate</td>
	  <td class=\"head\" rowspan=3>Talk Time</td>
	  <td class=\"head\" rowspan=3>Ave Talktime/<br>hours</td>
	  <td class=\"head\" rowspan=3>Ave Talk time/tmr</td>
	  <td class=\"head\" rowspan=3>Working Hour</td>
	  <td class=\"head\" rowspan=3>#TMR</td>
	  <td class=\"head\" rowspan=3>Working Days</td>
	  <td class=\"head\" colspan=3>Productivity/tmr</td>
	  <td class=\"head\" rowspan=3>Attempted/tmr</td>
	  <td class=\"head\" rowspan=3>Ave Premium</td>
	  <td class=\"head\" colspan=2 colspan=2>Bad List</td>
	 </tr>
	 
	 <tr>
	  <td class=\"head\" rowspan=2>New Assigned</td>
	  <td class=\"head\" rowspan=2>Re Assigned</td>
	  <td class=\"head\" colspan=3>Solicited</td>
	  <td class=\"head\" rowspan=2>Short DB new</td>
	  <td class=\"head\" rowspan=2>Y</td>
	  <td class=\"head\" colspan=3>N</td>
	  <td class=\"head\" rowspan=2>Connected Rate</td>
	  <td class=\"head\" rowspan=2>Y</td>
	  <td class=\"head\" colspan=11>N</td>
	  <td class=\"head\" rowspan=2>Rate</td>
	  <td class=\"head\" rowspan=2>#Presentation</td>
	  <td class=\"head\" rowspan=2>Presentation Rate</td>
	  <td class=\"head\" colspan=3>Interested</td>
	  <td class=\"head\" colspan=17>Not Interested</td>
	  <td class=\"head\" >RU</td>
	  <td class=\"head\" rowspan=2>Rate</td>
	  <td class=\"head\" colspan=2>&nbsp;</td>
	  <td class=\"head\" rowspan=2>Rate</td>
	  <td class=\"head\" rowspan=2>PIF</td>
	  <td class=\"head\" rowspan=2>NOS</td>
	  <td class=\"head\" rowspan=2>PREMIUM</td>
	  <td class=\"head\" rowspan=2>ANP</td>";
	  
	  if( is_array($arr_product) ) 
		foreach( $arr_product as $id => $ProductName ) 
	 {
		echo "<td class=\"head\" align=\"center\" colspan=4>$ProductName</td>";
	 }
	 
echo "<td class=\"head\" rowspan=2>PIF</td>
	  <td class=\"head\" rowspan=2>PREMIUM</td>
	  <td class=\"head\" rowspan=2>ANP</td>
	  <td class=\"head\" rowspan=2>#</td>
	  <td class=\"head\" rowspan=2>Ratio</td>
	</tr>
 
	<tr>
	  <td class=\"head\">solicited new Assigned</td>
	  <td class=\"head\">solicited ReUtilized</td>
	  <td class=\"head\">Total Solicited / Utilized</td>
	  <td class=\"head\">101</td>
	  <td class=\"head\">102</td>
	  <td class=\"head\">103</td>
	  <td class=\"head\">201</td>
	  <td class=\"head\">202</td>
	  <td class=\"head\">203</td>
	  <td class=\"head\">204</td>
	  <td class=\"head\">205</td>
	  <td class=\"head\">206</td>
	  <td class=\"head\">207</td>
	  <td class=\"head\">208</td>
	  <td class=\"head\">209</td>
	  <td class=\"head\">210</td>
	  <td class=\"head\">211</td>
	  <td class=\"head\">601</td>
	  <td class=\"head\">602</td>
	  <td class=\"head\">603</td>
	  <td class=\"head\">301</td>
	  <td class=\"head\">302</td>
	  <td class=\"head\">303</td>
	  <td class=\"head\">304</td>
	  <td class=\"head\">305</td>
	  <td class=\"head\">306</td>
	  <td class=\"head\">307</td>
	  <td class=\"head\">308</td>
	  <td class=\"head\">309</td>
	  <td class=\"head\">310</td>
	  <td class=\"head\">311</td>
	  <td class=\"head\">312</td>
	  <td class=\"head\">313</td>
	  <td class=\"head\">314</td>
	  <td class=\"head\">315</td>
	  <td class=\"head\">316</td>
	  <td class=\"head\">317</td>".
	  
	  //<td class=\"head\">318</td>
	  
	  "<td class=\"head\">701</td>
	  <td class=\"head\">401</td>
	  <td class=\"head\">402</td>";
	  
	  if( is_array($arr_product) ) 
		foreach( $arr_product as $id => $ProductName ) 
	 {
		echo "<td class=\"head\">PIF</td>
			  <td class=\"head\">NOS</td>
			  <td class=\"head\">PREMIUM</td>
			  <td class=\"head\">ANP</td>";
	 }
	 
	echo "</tr>";
	
	
	
 $data = array();
 
// ===================== SIZE DIS NEW DATA ============================

 $arr_dis_new_data = array();
 
 $UI->db->reset_select();
 $UI->db->select("
	a.AssignLeader as AssignLeader,
	a.AssignSelerId as AssignSelerId,
	COUNT( distinct a.CustomerId) as tot_new_data,
	GROUP_CONCAT(distinct a.CustomerId) as arr_dis_new_data", FALSE);
 $UI->db->from("t_gn_assignment_log a ");
 $UI->db->join("t_gn_customer b","a.CustomerId=b.CustomerId", "LEFT OUTER");
 $UI->db->where("a.CallReasonId=99", "", FALSE);
 $UI->db->where_in("b.CampaignId", $CampaignId); 
 $UI->db->where_in("a.AssignMode", array('DIS'));
 $UI->db->where_not_in("a.AssignSelerId",array_map('intval', array('0')));
 
 $UI->db->where_in("a.AssignAmgr", array_map('intval',  $obj->get_array_value('ManagerId')));
 $UI->db->where_in("a.AssignSpv", array_map('intval',  array($AtmId) ));
 $UI->db->where_in("a.AssignLeader",array_map('intval', $SpvId ));
 $UI->db->where_in("a.AssignSelerId", array_map('intval', $TmrId ));
 
 $UI->db->where("a.AssignDate>='{$obj->get_value('start_date','StartDate')}'", "", false);
 $UI->db->where("a.AssignDate<='{$obj->get_value('end_date','EndDate')}'", "", false);
 $UI->db->group_by(array("AssignSelerId"));

 
 $rs = $UI->db->get();
 if( $rs->num_rows() > 0 ) 
	 foreach( $rs->result_assoc() as $rows ) 
{
	$arr_dis_new_data[$rows['AssignSelerId']]= explode(',', $rows['arr_dis_new_data']);
	$data[$rows['AssignLeader']]['tot_new_assigned'] += $rows['tot_new_data'];
} 


// ===================== SIZE DIS OLD DATA / LEADER ============================

	$UI->db->reset_select();
	$UI->db->select("
		count( distinct a.CustomerId) as tot_re_assigned,
		a.AssignLeader as AssignLeader,a.AssignSelerId as AssignSelerId", FALSE);
	$UI->db->from("t_gn_assignment_log a ");
	$UI->db->join("t_gn_customer b","a.CustomerId=b.CustomerId", "LEFT OUTER");
	$UI->db->where("a.CallReasonId<>99", "", FALSE);
	$UI->db->where_in("b.CampaignId", $CampaignId); 
	$UI->db->where_in("a.AssignAmgr", array_map('intval', $obj->get_array_value('ManagerId')));
	$UI->db->where_in("a.AssignSpv", array_map('intval',  array($AtmId) ));
	$UI->db->where_not_in("a.AssignSelerId",array_map('intval', array('0')));
	$UI->db->where_in("a.AssignSelerId", array_map('intval', $TmrId ));
	
	$UI->db->where_in("a.AssignLeader", array_map('intval', $SpvId ));
	$UI->db->where("a.AssignDate>='{$obj->get_value('start_date','StartDate')}'", "", false);
	$UI->db->where("a.AssignDate<='{$obj->get_value('end_date','EndDate')}'", "", false);
	$UI->db->group_by(array("AssignSelerId"));
	
	$rs = $UI->db->get();
	if( $rs->num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $rows ) 
	{
		$data[$rows['AssignLeader']]['tot_re_assigned']+= $rows['tot_re_assigned'];
	} 
	
// ==================== SOLICITED NEW / LEADER  ===================================

  $arr_utilize_new = null;
  
  $UI->db->reset_select();
  $UI->db->select("
			date(a.CallHistoryCallDate) as tgl,
			a.SPVID as AssignLeader,
			count(a.CustomerId) as tot_utilize_new,
			GROUP_CONCAT( distinct a.CustomerId) as arr_utilize_new_id,
			a.AgentId as AgentId", FALSE);
  $UI->db->from("t_gn_callhistory_newutil a ");
  $UI->db->where_in("a.CampaignId", $CampaignId);
  $UI->db->where("a.CallHistoryCallDate>='{$obj->get_value('start_date','StartDate')}'", "", false);
  $UI->db->where("a.CallHistoryCallDate<='{$obj->get_value('end_date','EndDate')}'", "", false);
  $UI->db->where_in("a.ATMID", array_map('intval', $obj->get_array_value('AtmId')));
  $UI->db->where_in("a.AMGRID", array_map('intval', $obj->get_array_value('ManagerId')));
  $UI->db->where_in("a.SPVID", array_map('intval',  $SpvId ));
  $UI->db->where_in("a.AgentId", array_map('intval', $TmrId ));
  $UI->db->where("a.SessionReport", $gReportSession);
  $UI->db->group_by(array('tgl','AssignLeader','AgentId'));
  // $UI->db->print_out();
  $rs = $UI->db->get();
  if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows ) 
 {
	$arr_utilize_new[$rows['tgl']][$rows['AssignLeader']][$rows['AgentId']] = explode(',', $rows['arr_utilize_new_id']);
	$data[$rows['AssignLeader']]['data_new_utilize'] += $rows['tot_utilize_new'];
	$data[$rows['AssignLeader']]['data_all_solicited'] += $rows['tot_utilize_new'];
 }
 
 // ================== SOLICITED OLD / LEADER  ============================
 
    $UI->db->reset_select();
    $UI->db->select("
		date(a.CallHistoryCallDate) as tgl,
		count(distinct a.CustomerId) as tot_old_utilize, 
		c.UserId as AssignLeader, 
		a.CreatedById as AgentId, 
		a.CustomerId as CustomerId", FALSE);
	$UI->db->from("t_gn_callhistory a ");
	$UI->db->join("t_gn_customer b","a.CustomerId=b.CustomerId","INNER JOIN");
	$UI->db->join("tms_agent c ","a.SPVCode = c.id", "LFET");
	$UI->db->join("tms_agent d ","a.ATMCode = d.id", "LFET");
	$UI->db->join("tms_agent e  ","a.AMGRCode = e.id", "LFET");
	$UI->db->where_in("b.CampaignId", $CampaignId );
	$UI->db->where("a.HistoryType", 0);
	$UI->db->where("a.CallBeforeReasonId<>99", "", FALSE);
	$UI->db->where("a.CallHistoryCallDate>='{$obj->get_value('start_date','StartDate')}'", "", false);
	$UI->db->where("a.CallHistoryCallDate<='{$obj->get_value('end_date','EndDate')}'", "", false);
	$UI->db->where_in("a.CreatedById", array_map('intval', $TmrId ));
	$UI->db->where_in("c.UserId", array_map('intval',  $SpvId ));
	$UI->db->where_in("d.UserId", array_map('intval', $obj->get_array_value('AtmId')));
	$UI->db->where_in("e.UserId", array_map('intval', $obj->get_array_value('ManagerId')));
 	$UI->db->group_by(array("tgl","AssignLeader", "AgentId","CustomerId"));
	
	// $UI->db->print_out();
	$rs = $UI->db->get();
	if( $rs->num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $rows ) 
	{
		$arr_skip_data = $arr_utilize_new[$rows['tgl']][$rows['AssignLeader']][$rows['AgentId']];
		if( !in_array($rows['CustomerId'], $arr_skip_data)) {
			$data[$rows['AssignLeader']]['data_old_utilize'] += $rows['tot_old_utilize'];
			$data[$rows['AssignLeader']]['data_all_solicited'] += $rows['tot_old_utilize'];
		}
	}
	
// ================ GET DATA ATEMPT PER ATM SUMMARY =======================================
 
 $UI->db->reset_select();
 $UI->db->select("
		c.UserId as AssignLeader,
		COUNT(a.CallHistoryId) as data_size_atempt, 
		SUM(IF(f.CallReasonCode IN ('000'),1,0)) as status_000,
		SUM(IF(f.CallReasonCode IN ('101'),1,0)) as status_101,
		SUM(IF(f.CallReasonCode IN ('102'),1,0)) as status_102,
		SUM(IF(f.CallReasonCode IN ('103'),1,0)) as status_103,
		SUM(IF(f.CallReasonCode IN ('201'),1,0)) as status_201,
		SUM(IF(f.CallReasonCode IN ('202'),1,0)) as status_202,
		SUM(IF(f.CallReasonCode IN ('203'),1,0)) as status_203,
		SUM(IF(f.CallReasonCode IN ('204'),1,0)) as status_204,
		SUM(IF(f.CallReasonCode IN ('205'),1,0)) as status_205,
		SUM(IF(f.CallReasonCode IN ('206'),1,0)) as status_206,
		SUM(IF(f.CallReasonCode IN ('207'),1,0)) as status_207,
		SUM(IF(f.CallReasonCode IN ('208'),1,0)) as status_208,
		SUM(IF(f.CallReasonCode IN ('209'),1,0)) as status_209,
		SUM(IF(f.CallReasonCode IN ('210'),1,0)) as status_210,
		SUM(IF(f.CallReasonCode IN ('211'),1,0)) as status_211,
		SUM(IF(f.CallReasonCode IN ('301'),1,0)) as status_301,
		SUM(IF(f.CallReasonCode IN ('302'),1,0)) as status_302,
		SUM(IF(f.CallReasonCode IN ('303'),1,0)) as status_303,
		SUM(IF(f.CallReasonCode IN ('304'),1,0)) as status_304,
		SUM(IF(f.CallReasonCode IN ('305'),1,0)) as status_305,
		SUM(IF(f.CallReasonCode IN ('306'),1,0)) as status_306,
		SUM(IF(f.CallReasonCode IN ('307'),1,0)) as status_307,
		SUM(IF(f.CallReasonCode IN ('308'),1,0)) as status_308,
		SUM(IF(f.CallReasonCode IN ('309'),1,0)) as status_309,
		SUM(IF(f.CallReasonCode IN ('310'),1,0)) as status_310,
		SUM(IF(f.CallReasonCode IN ('311'),1,0)) as status_311,
		SUM(IF(f.CallReasonCode IN ('312'),1,0)) as status_312,
		SUM(IF(f.CallReasonCode IN ('313'),1,0)) as status_313,
		SUM(IF(f.CallReasonCode IN ('314'),1,0)) as status_314,
		SUM(IF(f.CallReasonCode IN ('315'),1,0)) as status_315,
		SUM(IF(f.CallReasonCode IN ('316'),1,0)) as status_316,
		SUM(IF(f.CallReasonCode IN ('317'),1,0)) as status_317,
		SUM(IF(f.CallReasonCode IN ('319'),1,0)) as status_319,
		SUM(IF(f.CallReasonCode IN ('401'),1,0)) as status_401,
		SUM(IF(f.CallReasonCode IN ('402'),1,0)) as status_402,
		SUM(IF(f.CallReasonCode IN ('601'),1,0)) as status_601,
		SUM(IF(f.CallReasonCode IN ('602'),1,0)) as status_602,
		SUM(IF(f.CallReasonCode IN ('603'),1,0)) as status_603,
		SUM(IF(f.CallReasonCode IN ('701'),1,0)) as status_701", 
FALSE);

 $UI->db->from("t_gn_callhistory a ");
 $UI->db->join("t_gn_customer b","a.CustomerId=b.CustomerId", "LEFT");
 $UI->db->join("tms_agent c ","a.SPVCode = c.id", "LFET");
 $UI->db->join("tms_agent d ","a.ATMCode = d.id", "LFET");
 $UI->db->join("tms_agent e  ","a.AMGRCode = e.id", "LFET");
 $UI->db->join("t_lk_callreason f  ","a.CallReasonId = f.CallReasonId", "LEFT");
 
 $UI->db->where_not_in("f.CallReasonCode", $skip_status);
 $UI->db->where_in("b.CampaignId", $CampaignId );
 $UI->db->where("a.HistoryType", 0);
 $UI->db->where("a.CallHistoryCallDate>='{$obj->get_value('start_date','StartDate')}'", "", false);
 $UI->db->where("a.CallHistoryCallDate<='{$obj->get_value('end_date','EndDate')}'", "", false);
 $UI->db->where_in("d.UserId", array_map('intval', $obj->get_array_value('AtmId')));
 $UI->db->where_in("e.UserId", array_map('intval', $obj->get_array_value('ManagerId')));
 $UI->db->where_in("c.UserId", array_map('intval', $SpvId));
 $UI->db->group_by(array('AssignLeader'));
 
//echo $UI->db->print_out();
 
 $rs = $UI->db->get();
  if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows ) 
 {
	$data[$rows['AssignLeader']]['tot_data_atempt'] +=$rows['data_size_atempt'];
	$data[$rows['AssignLeader']]['tot_data_status_000']+=$rows['status_000'];
	$data[$rows['AssignLeader']]['tot_data_status_101']+=$rows['status_101'];
	$data[$rows['AssignLeader']]['tot_data_status_102']+=$rows['status_102'];
	$data[$rows['AssignLeader']]['tot_data_status_103']+=$rows['status_103'];
	$data[$rows['AssignLeader']]['tot_data_status_201']+=$rows['status_201'];
	$data[$rows['AssignLeader']]['tot_data_status_202']+=$rows['status_202'];
	$data[$rows['AssignLeader']]['tot_data_status_203']+=$rows['status_203'];
	$data[$rows['AssignLeader']]['tot_data_status_204']+=$rows['status_204'];
	$data[$rows['AssignLeader']]['tot_data_status_205']+=$rows['status_205'];
	$data[$rows['AssignLeader']]['tot_data_status_206']+=$rows['status_206'];
	$data[$rows['AssignLeader']]['tot_data_status_207']+=$rows['status_207'];
	$data[$rows['AssignLeader']]['tot_data_status_208']+=$rows['status_208'];
	$data[$rows['AssignLeader']]['tot_data_status_209']+=$rows['status_209'];
	$data[$rows['AssignLeader']]['tot_data_status_210']+=$rows['status_210'];
	$data[$rows['AssignLeader']]['tot_data_status_211']+=$rows['status_211'];
	$data[$rows['AssignLeader']]['tot_data_status_301']+=$rows['status_301'];
	$data[$rows['AssignLeader']]['tot_data_status_302']+=$rows['status_302'];
	$data[$rows['AssignLeader']]['tot_data_status_303']+=$rows['status_303'];
	$data[$rows['AssignLeader']]['tot_data_status_304']+=$rows['status_304'];
	$data[$rows['AssignLeader']]['tot_data_status_305']+=$rows['status_305'];
	$data[$rows['AssignLeader']]['tot_data_status_306']+=$rows['status_306'];
	$data[$rows['AssignLeader']]['tot_data_status_307']+=$rows['status_307'];
	$data[$rows['AssignLeader']]['tot_data_status_308']+=$rows['status_308'];
	$data[$rows['AssignLeader']]['tot_data_status_309']+=$rows['status_309'];
	$data[$rows['AssignLeader']]['tot_data_status_310']+=$rows['status_310'];
	$data[$rows['AssignLeader']]['tot_data_status_311']+=$rows['status_311'];
	$data[$rows['AssignLeader']]['tot_data_status_312']+=$rows['status_312'];
	$data[$rows['AssignLeader']]['tot_data_status_313']+=$rows['status_313'];
	$data[$rows['AssignLeader']]['tot_data_status_314']+=$rows['status_314'];
	$data[$rows['AssignLeader']]['tot_data_status_315']+=$rows['status_315'];
	$data[$rows['AssignLeader']]['tot_data_status_316']+=$rows['status_316'];
	$data[$rows['AssignLeader']]['tot_data_status_317']+=$rows['status_317'];
	$data[$rows['AssignLeader']]['tot_data_status_701']+=$rows['status_701'];
	$data[$rows['AssignLeader']]['tot_data_status_401']+=$rows['status_401'];
	$data[$rows['AssignLeader']]['tot_data_status_402']+=$rows['status_402'];
	$data[$rows['AssignLeader']]['tot_data_status_601']+=$rows['status_601'];
	$data[$rows['AssignLeader']]['tot_data_status_602']+=$rows['status_602'];
	$data[$rows['AssignLeader']]['tot_data_status_603']+=$rows['status_603'];
	$data[$rows['AssignLeader']]['tot_data_status_319']+=$rows['status_319'];
 }
 
// ---------- get data talktime --------------
  $UI->db->reset_select();
  $UI->db->select("c.AssignLeader as AssignLeader, SUM(a.duration) as tot_talk_time ", FALSE);
  $UI->db->from("cc_recording a");
  $UI->db->join("t_gn_customer b "," a.assignment_data=b.CustomerId", "LEFT");
  $UI->db->join("t_gn_assignment c "," b.CustomerId=c.CustomerId","LEFT");
	
  $UI->db->where_in("b.CampaignId", $CampaignId); 
  $UI->db->where("a.start_time>='{$obj->get_value('start_date','StartDate')}'", "", false);
  $UI->db->where("a.start_time<='{$obj->get_value('end_date','EndDate')}'", "", false);
  
  $UI->db->where_in("c.AssignAmgr", array_map('intval', $obj->get_array_value('ManagerId')));
  $UI->db->where_in("c.AssignSpv", array($AtmId));
  $UI->db->where_in("c.AssignLeader",$SpvId);
  
  $UI->db->group_by(array("AssignLeader"));
  
 // $UI->db->print_out();
 
  $rs = $UI->db->get();
  if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows ) 
 {
	$data[$rows['AssignLeader']]['data_tot_talk_time'] +=$rows['tot_talk_time'];
  }

 
 // ---------------- get data policy achivement per product ----------------------
 $UI->db->reset_select();
 $UI->db->select("
	b.ProductId as ProductId,
	e.AssignLeader as AssignLeader,
	COUNT(a.PolicyId) as tot_nos_per_product,
	COUNT( distinct a.PolicyNumber) as tot_policy_per_product,
	SUM(a.PolicyPremi) as tot_premi_per_product,
	SUM(IF(c.PayModeId IN(2), (a.PolicyPremi * 12), a.PolicyPremi)) as tot_premi_anp_per_product", FALSE);
 $UI->db->from("t_gn_policy a ");
 
 $UI->db->join("t_gn_policyautogen b ","a.PolicyNumber=b.PolicyNumber", "LEFT");
 $UI->db->join("t_gn_productplan c ","a.ProductPlanId=c.ProductPlanId", "LEFT");
 $UI->db->join("t_gn_customer d ","b.CustomerId=d.CustomerId", "LEFT");
 $UI->db->join("t_gn_assignment e ","b.CustomerId=e.CustomerId", "LEFT");

 $UI->db->where_in("d.CampaignId", array_map('intval', $CampaignId)); 
 $UI->db->where_in("e.AssignAmgr", array_map('intval', $obj->get_array_value('ManagerId')));
 $UI->db->where_in("e.AssignSpv", array_map("intval", array($AtmId)));
 $UI->db->where_in("e.AssignLeader", array_map("intval", $SpvId));
  
 $UI->db->where("a.PolicySalesDate>='{$obj->get_value('start_date','StartDate')}'", "", false);
 $UI->db->where("a.PolicySalesDate<='{$obj->get_value('end_date','EndDate')}'", "", false);
 $UI->db->group_by(array("AssignLeader","ProductId"));
 
 //echo $UI->db->print_out();
 
 
 $rs = $UI->db->get();
 if($rs->num_rows() > 0)  
	foreach( $rs->result_assoc() as $rows )
 {
	$data[$rows['AssignLeader']][$rows['ProductId']]['tot_nos_per_product']+= $rows['tot_nos_per_product'];
	$data[$rows['AssignLeader']][$rows['ProductId']]['tot_policy_per_product']+= $rows['tot_policy_per_product'];
	$data[$rows['AssignLeader']][$rows['ProductId']]['tot_premi_per_product']+= $rows['tot_premi_per_product'];
	$data[$rows['AssignLeader']][$rows['ProductId']]['tot_premi_anp_per_product']+= $rows['tot_premi_anp_per_product'];
 }
 
// ------------ data Coloseint policy sales ----------------------------------------------
  $UI->db->reset_select();
  $UI->db->select("
		COUNT(distinct b.PolicyNumber) as tot,
		a.PolicyNumber as PolicyNumber,
		e.AssignLeader as AssignLeader,
		COUNT(a.PolicyId) as tot_data_insured,
		SUM(IF(d.PayModeId IN(2), a.PolicyPremi, a.PolicyPremi)) as tot_data_premi,
		SUM(IF(d.PayModeId IN(2), (a.PolicyPremi * 12), a.PolicyPremi)) as tot_data_premi_anp", FALSE);
	
  $UI->db->from("t_gn_policy a ");
  $UI->db->join("t_gn_policyautogen b ","a.PolicyNumber=b.PolicyNumber", "LEFT");
  $UI->db->join("t_gn_customer c ","b.CustomerId=c.CustomerId", "LEFT");
  $UI->db->join("t_gn_productplan d ","a.ProductPlanId=d.ProductPlanId", "LEFT");
  $UI->db->join("t_gn_assignment e ","b.CustomerId=e.CustomerId", "LEFT");
 
 
  $UI->db->where_in("c.CampaignId", array_map('intval', $CampaignId)); 
  $UI->db->where_in("e.AssignAmgr", array_map('intval', $obj->get_array_value('ManagerId')));
  $UI->db->where_in("e.AssignSpv", array_map("intval", array($AtmId)));
  $UI->db->where_in("e.AssignLeader", array_map("intval", $SpvId));
 
  $UI->db->where("a.PolicySalesDate>='{$obj->get_value('start_date','StartDate')}'", "", false);
  $UI->db->where("a.PolicySalesDate<='{$obj->get_value('end_date','EndDate')}'", "", false);
  
  $UI->db->group_by(array("PolicyNumber","AssignLeader"));
 // $UI->db->print_out();
  
  $rs = $UI->db->get();
  if($rs->num_rows() > 0)  
		foreach( $rs-> result_assoc() as $rows )
{
	$data[$rows['AssignLeader']]['total_data_policy'] += $rows['tot'];
	$data[$rows['AssignLeader']]['tot_data_insured'] += $rows['tot_data_insured'];
	$data[$rows['AssignLeader']]['tot_data_premi'] += $rows['tot_data_premi'];
	$data[$rows['AssignLeader']]['tot_data_premi_anp'] += $rows['tot_data_premi_anp'];
	
}	

// ------------ select count user login on interval ---------------------------------
 $UI->db->reset_select();
 $UI->db->select("count(distinct a.ActivityUserId) as tot_user_tmr, a.ActivityUserId,b.tl_id as AsignLeader", FALSE);
 $UI->db->from("t_gn_activitylog a  ");
 $UI->db->join("tms_agent b ","a.ActivityUserId=b.UserId", "LEFT");
 $UI->db->where("a.ActivityDate>='{$obj->get_value('start_date','StartDate')}'", "", FALSE);
 $UI->db->where("a.ActivityDate<='{$obj->get_value('end_date','EndDate')}'", "", FALSE);
 $UI->db->where_in("b.handling_type",array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));
 $UI->db->where_in("b.tl_id",array_map('intval', $SpvId));
 $UI->db->group_by("a.ActivityUserId");
 
 $rs = $UI->db->get();
 if($rs->num_rows() > 0)  
	foreach( $rs-> result_assoc() as $rows )
{
	$data[$rows['AsignLeader']]['data_tot_user_login'] += $rows['tot_user_tmr'];
}
	
// ---- select day work data agent data -----------------------------------
	
 $UI->db->reset_select();
 $UI->db->select(" 1 As tot_day_work, 
				date_format(a.ActivityDate,'%Y-%m-%d') as tgl ", FALSE);
 $UI->db->from("t_gn_activitylog a  ");
 $UI->db->where("a.ActivityDate>='{$obj->get_value('start_date','StartDate')}'", "", FALSE);
 $UI->db->where("a.ActivityDate<='{$obj->get_value('end_date','EndDate')}'", "", FALSE);
 $UI->db->group_by("tgl");
	
 $rs = $UI->db->get();
 if($rs->num_rows() > 0)  
	foreach( $rs-> result_assoc() as $rows )
 {
	$data['data_tot_day_work'] += $rows['tot_day_work'];
 }
	
// ---------- get total work of hour in list ---


 $UI->db->reset_select();
 $UI->db->select(" a.ActivityUserId as UserId, date(a.ActivityDate) as tgl, b.tl_id as AsignLeader",FALSE);
 $UI->db->from("t_gn_activitylog a  ");	
 $UI->db->join("tms_agent b","a.ActivityUserId = b.UserId", "LEFT");
 $UI->db->where("a.ActivityDate>='{$obj->get_value('start_date','StartDate')}'", "", FALSE);
 $UI->db->where("a.ActivityDate<='{$obj->get_value('end_date','EndDate')}'", "", FALSE);
 $UI->db->where_in("b.handling_type",array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));
 $UI->db->where_in("b.tl_id",array_map('intval', $SpvId));
 $UI->db->group_by(array("UserId", "tgl"));
 
 
 $rs = $UI->db->get();
 if($rs->num_rows() > 0)  
	foreach( $rs-> result_assoc() as $rows )
 {
	$sql = " select UNIX_TIMESTAMP(MIN(a.ActivityDate)) as login, UNIX_TIMESTAMP(MAX(a.ActivityDate)) as logout from t_gn_activitylog a 
			  where a.ActivityUserId = {$rows['UserId']} 
			  and a.ActivityDate >= '{$rows['tgl']} 00:00:00'
			  and a.ActivityDate <= '{$rows['tgl']} 23:59:59'
			  and a.ActivityEvent IN('ACTION_EVENT_LOGIN', 'ACTION_EVENT_LOGOUT') ";
	//echo "<pre>". $sql ."</pre>";		
	
	$qry = $UI->db->query($sql);
	if($qry->num_rows() > 0 
		AND $row = $qry->result_first_assoc() )
	{
		if( count($row) > 0 ) { 
			$hour_maximum = ( (int)$row['logout'] - (int)$row['login']);
			$data[$rows['AsignLeader']]['data_tot_hour_work'] += $hour_maximum;
		}
	}	
 }
 

// -----------------------------------------
$obUsers  = & get_class_instance('M_SysUser');

 
//------- define attribute summary ----------------------------------------------
 $sum_tot_data_user_login = 0;
 $sum_tot_data_persentation = 0;
 $sum_tot_acv_premi_anp = 0;
 $sum_tot_new_assign=0;
 $sum_tot_de_assign=0;
 $sum_tot_re_assign=0;
 $sum_tot_solicited_new_assign=0;
 $sum_tot_solicited_re_assign=0;
 $sum_tot_solicited_per_utilize=0;
 $sum_tot_sort_db_new=0;
 $sum_tot_attempt_call=0;
 $sum_tot_attempt_ratio=0;
 $sum_tot_connected_yes=0;
 $sum_tot_status_101=0;
 $sum_tot_status_102=0;
 $sum_tot_status_103=0;
 $sum_tot_connect_rate=0;
 $sum_tot_contacted_yes=0;
 $sum_tot_contacted = 0;
 $sum_tot_status_201=0;
 $sum_tot_status_202=0;
 $sum_tot_status_203=0;
 $sum_tot_status_204=0;
 $sum_tot_status_205=0;
 $sum_tot_status_206=0;
 $sum_tot_status_207=0;
 $sum_tot_status_208=0;
 $sum_tot_status_209=0;
 $sum_tot_status_210=0;
 $sum_tot_status_211=0;
 $sum_tot_contacted_rate=0;
 $sum_tot_sale_closing_rate=0;
 $sum_tot_response_rate=0;
 $sum_tot_persentation=0;
 $sum_tot_persentation_rate=0;
 $sum_tot_status_601=0;
 $sum_tot_status_602=0;
 $sum_tot_status_603=0;
 $sum_tot_status_301=0;
 $sum_tot_status_302=0;
 $sum_tot_status_303=0;
 $sum_tot_status_304=0;
 $sum_tot_status_305=0;
 $sum_tot_status_306=0;
 $sum_tot_status_307=0;
 $sum_tot_status_308=0;
 $sum_tot_status_309=0;
 $sum_tot_status_310=0;
 $sum_tot_status_311=0;
 $sum_tot_status_312=0;
 $sum_tot_status_313=0;
 $sum_tot_status_314=0;
 $sum_tot_status_315=0;
 $sum_tot_status_316=0;
 $sum_tot_status_317=0;
 $sum_tot_status_318=0;
 $sum_tot_status_401=0;
 $sum_tot_status_402=0;
 $sum_tot_nos_rate=0;
 $sum_tot_acv_pif=0;
 $sum_tot_acv_nos=0;
 $sum_tot_acv_anp=0;
 $sum_tot_talk_time=0;
 $sum_tot_avg_talk_time_per_hour=0;
 $sum_tot_avg_talk_time_per_tmr=0;
 $sum_tot_work_hours=0;
 $sum_tot_tmr_login=0;
 $sum_tot_work_days=0;
 $sum_tot_productivity_per_tmr_pif=0;
 $sum_tot_productivity_per_tmr_anp=0;
 $sum_tot_avg_atempt_per_tmr=0;
 $sum_tot_avg_premi=0;
 $sum_tot_bad_list=0;
 $sum_data_followup = 0;
 $sum_tot_avg_bad_list = 0;
 $sum_tot_data_work_hours =0;
 $sum_tot_contacted_y = 0;
// ------ get attribute data user tmr  ----------------------------------
 
 $tot_data_work_days  = ( $data['data_tot_day_work'] ? $data['data_tot_day_work'] : 0);
 $tot_data_talk_hour = 0;
 
// --------------- loop --------------------------------
 
 if(is_array($SpvId) ) 
	 foreach( $SpvId as $key => $AssignLeader )
{
	
// --------- index ----------------------- 
 $AgentName  = $rows['full_name'];
 $AgentId = $rows['UserId'];
 
// --------- get datat DB ---

 $call_data_content = $data[$AssignLeader];

// ------------- total data talk time -----
 $tot_data_talk_time =($call_data_content['data_tot_talk_time']? $call_data_content['data_tot_talk_time'] : 0 ); 
 $tot_data_work_hours = ( $call_data_content['data_tot_hour_work'] ? $call_data_content['data_tot_hour_work'] : 0);
 $tot_data_user_login = ( $call_data_content['data_tot_user_login'] ? $call_data_content['data_tot_user_login'] : 0);
 $tot_data_format_hours = _getDuration($tot_data_work_hours);
 
 
// --------- total Policy Insured -----------

 $tot_data_policy = ( $call_data_content['total_data_policy'] ? $call_data_content['total_data_policy'] : 0 );
 $tot_data_insured = ( $call_data_content['tot_data_insured'] ? $call_data_content['tot_data_insured'] : 0 );
 $tot_data_premi  = ( $call_data_content['tot_data_premi'] ? $call_data_content['tot_data_premi'] : 0 );
 $tot_data_premi_anp = ( $call_data_content['tot_data_premi_anp'] ? $call_data_content['tot_data_premi_anp'] : 0 );
 
 $tot_format_data_premi = _getCurrency($tot_data_premi);
 $tot_format_data_premi_anp  = _getCurrency($tot_data_premi_anp);
 
//---------------------------------------------------------------------------------------------------
 $tot_new_assigned_data = ( $call_data_content['tot_new_assigned'] ? $call_data_content['tot_new_assigned']: 0);
 $tot_re_assigned_data = ( $call_data_content['tot_re_assigned'] ? $call_data_content['tot_re_assigned'] : 0 );
 $tot_solicited_new_assign = ( $call_data_content['data_new_utilize'] ? $call_data_content['data_new_utilize'] : 0 );
 $tot_solicited_re_utilized = ( $call_data_content['data_old_utilize'] ? $call_data_content['data_old_utilize'] : 0 );
 $tot_data_utilize = ( $call_data_content['data_all_solicited'] ? $call_data_content['data_all_solicited'] : 0 ); 
 $tot_data_sort_new_db = (  $tot_new_assigned_data-$tot_solicited_new_assign );

// --------- atempt  ----------------------
 $tot_data_atempt = ( $call_data_content['tot_data_atempt'] ? $call_data_content['tot_data_atempt'] : 0 );
 $avg_data_atempt = ( $tot_data_atempt ? number_format(($tot_data_atempt/ $tot_data_utilize),1) : 0 );
 
// ----total Y ( 201,202,203,204,205,206,207,208,209,210,211) ----------------

 $tot_data_connected_y201 = ( $call_data_content['tot_data_status_201'] ? $call_data_content['tot_data_status_201'] : 0);
 $tot_data_connected_y202 = ( $call_data_content['tot_data_status_202'] ? $call_data_content['tot_data_status_202'] : 0);
 $tot_data_connected_y203 = ( $call_data_content['tot_data_status_203'] ? $call_data_content['tot_data_status_203'] : 0);
 $tot_data_connected_y204 = ( $call_data_content['tot_data_status_204'] ? $call_data_content['tot_data_status_204'] : 0);
 $tot_data_connected_y205 = ( $call_data_content['tot_data_status_205'] ? $call_data_content['tot_data_status_205'] : 0);
 $tot_data_connected_y206 = ( $call_data_content['tot_data_status_206'] ? $call_data_content['tot_data_status_206'] : 0);
 $tot_data_connected_y207 = ( $call_data_content['tot_data_status_207'] ? $call_data_content['tot_data_status_207'] : 0);
 $tot_data_connected_y208 = ( $call_data_content['tot_data_status_208'] ? $call_data_content['tot_data_status_208'] : 0);
 $tot_data_connected_y209 = ( $call_data_content['tot_data_status_209'] ? $call_data_content['tot_data_status_209'] : 0);
 $tot_data_connected_y210 = ( $call_data_content['tot_data_status_210'] ? $call_data_content['tot_data_status_210'] : 0);
 $tot_data_connected_y211 = ( $call_data_content['tot_data_status_211'] ? $call_data_content['tot_data_status_211'] : 0);
 

						
 
// --------- tot data N (101, 102, 103 )--- 
 
 $tot_data_connected_n101 = ( $call_data_content['tot_data_status_101'] ? $call_data_content['tot_data_status_101'] : 0 );
 $tot_data_connected_n102 = ( $call_data_content['tot_data_status_102'] ? $call_data_content['tot_data_status_102'] : 0 );
 $tot_data_connected_n103 = ( $call_data_content['tot_data_status_103'] ? $call_data_content['tot_data_status_103'] : 0 );
 
// -- avg coneected rate ----------


 
// ---------- data interes --------------------------
 $tot_data_interest_601 = ( $call_data_content['tot_data_status_601'] ? $call_data_content['tot_data_status_601'] : 0);
 $tot_data_interest_602 = ( $call_data_content['tot_data_status_602'] ? $call_data_content['tot_data_status_602'] : 0);
 $tot_data_interest_603 = ( $call_data_content['tot_data_status_603'] ? $call_data_content['tot_data_status_603'] : 0);

// -------- data not interest (301,302,303,304,305,306,307,308,309,310,311,312,313,314,315,316,317)	

 $tot_data_not_interest_301 = ( $call_data_content['tot_data_status_301'] ? $call_data_content['tot_data_status_301'] : 0);
 $tot_data_not_interest_302 = ( $call_data_content['tot_data_status_302'] ? $call_data_content['tot_data_status_302'] : 0);
 $tot_data_not_interest_303 = ( $call_data_content['tot_data_status_303'] ? $call_data_content['tot_data_status_303'] : 0);
 $tot_data_not_interest_304 = ( $call_data_content['tot_data_status_304'] ? $call_data_content['tot_data_status_304'] : 0);
 $tot_data_not_interest_305 = ( $call_data_content['tot_data_status_305'] ? $call_data_content['tot_data_status_305'] : 0);
 $tot_data_not_interest_306 = ( $call_data_content['tot_data_status_306'] ? $call_data_content['tot_data_status_306'] : 0);
 $tot_data_not_interest_307 = ( $call_data_content['tot_data_status_307'] ? $call_data_content['tot_data_status_307'] : 0);
 $tot_data_not_interest_308 = ( $call_data_content['tot_data_status_308'] ? $call_data_content['tot_data_status_308'] : 0);
 $tot_data_not_interest_309 = ( $call_data_content['tot_data_status_309'] ? $call_data_content['tot_data_status_309'] : 0);
 $tot_data_not_interest_310 = ( $call_data_content['tot_data_status_310'] ? $call_data_content['tot_data_status_310'] : 0);
 $tot_data_not_interest_311 = ( $call_data_content['tot_data_status_311'] ? $call_data_content['tot_data_status_311'] : 0);
 $tot_data_not_interest_312 = ( $call_data_content['tot_data_status_312'] ? $call_data_content['tot_data_status_312'] : 0);
 $tot_data_not_interest_313 = ( $call_data_content['tot_data_status_313'] ? $call_data_content['tot_data_status_313'] : 0);
 $tot_data_not_interest_314 = ( $call_data_content['tot_data_status_314'] ? $call_data_content['tot_data_status_314'] : 0);
 $tot_data_not_interest_315 = ( $call_data_content['tot_data_status_315'] ? $call_data_content['tot_data_status_315'] : 0);
 $tot_data_not_interest_316 = ( $call_data_content['tot_data_status_316'] ? $call_data_content['tot_data_status_316'] : 0);
 $tot_data_not_interest_317 = ( $call_data_content['tot_data_status_317'] ? $call_data_content['tot_data_status_317'] : 0);

 
 // -------- data not interest (301,302,303,304,305,306,307,308,309,310,311,312,313,314,315,316,317)	
 $tot_data_call_status_318 = ( $call_data_content['tot_data_status_318'] ? $call_data_content['tot_data_status_318'] : 0);
 $tot_data_call_status_401 = ( $call_data_content['tot_data_status_401'] ? $call_data_content['tot_data_status_401'] : 0);
 $tot_data_call_status_402 = ( $call_data_content['tot_data_status_402'] ? $call_data_content['tot_data_status_402'] : 0);  
 $tot_data_call_status_701 = ( $call_data_content['tot_data_status_701'] ? $call_data_content['tot_data_status_701'] : 0);  
  
 $tot_data_bad_list  = ( $tot_data_connected_n101+ 
						 $tot_data_connected_n102+ 
						 $tot_data_connected_n103+
						 $tot_data_connected_y204+
						 $tot_data_connected_y209+
						 $tot_data_connected_y211);
						 
 // --- total perensttion ----
 $tot_data_persentation = ( $tot_data_not_interest_301+ 
							$tot_data_not_interest_302+
							$tot_data_not_interest_303+
							$tot_data_not_interest_304+
							$tot_data_not_interest_305+
							$tot_data_not_interest_306+
							$tot_data_not_interest_307+
							$tot_data_not_interest_308+
							$tot_data_not_interest_309+
							$tot_data_not_interest_310+
							$tot_data_not_interest_311+
							$tot_data_not_interest_312+
							$tot_data_not_interest_313+
							$tot_data_not_interest_314+
							$tot_data_not_interest_315+
							$tot_data_not_interest_316+
							$tot_data_not_interest_317+
							$tot_data_call_status_318+
							$tot_data_call_status_401+
							$tot_data_call_status_402+
							$tot_data_interest_601+
							$tot_data_interest_602+
							$tot_data_interest_603);
							
							
$tot_data_connected_y =  ( $tot_data_connected_y201+
					       $tot_data_connected_y202+
						   $tot_data_connected_y203+
						   $tot_data_connected_y204+
						   $tot_data_connected_y205+
						   $tot_data_connected_y206+
						   $tot_data_connected_y207+
						   $tot_data_connected_y208+
						   $tot_data_connected_y209+
						   $tot_data_connected_y210+
						   $tot_data_connected_y211+
						   $tot_data_call_status_701+
						   $tot_data_persentation); 

$tot_contacted_y = ( $tot_data_persentation+$tot_data_call_status_701);
$tot_data_followup  = ($tot_data_call_status_401+$tot_data_call_status_402);
$tot_data_format_talk_time = _getDuration($tot_data_talk_time);
 
// --------------- response rate --------------------------
 $avg_response_rate = ( $tot_data_utilize ? _setPercent(($tot_data_policy/$tot_data_utilize)): 0 );
 $avg_sales_closing = ( $tot_contacted_y ? _setPercent(($tot_data_policy/$tot_contacted_y)) : 0 );
 $avg_data_followup  = ( $tot_contacted_y ? _setPercent(($tot_data_followup/$tot_contacted_y)) : 0);
 $avg_data_persentation  = ( ($tot_contacted_y) ? _setPercent(($tot_data_persentation/$tot_contacted_y)): 0);
 $avg_data_nos_rate = ( $tot_data_policy ? _setPercent( (($tot_data_insured-$tot_data_policy)/$tot_data_policy)) : 0);
 $avg_data_contacted_rate  = ( $tot_data_atempt ? ( $tot_contacted_y/$tot_data_utilize) : "" );
 $avg_data_format_contacted_rate  = _setPercent( $avg_data_contacted_rate);
 $avg_data_connect_rate  = ( $tot_data_atempt ? _setPercent( $tot_data_connected_y/$tot_data_atempt): 0 );
// --- total data badlist ----------------------
 
 $avg_data_bad_list = ( $tot_data_utilize ? _setPercent(($tot_data_bad_list/$tot_data_utilize)): 0);
 $avg_data_talk_time_hours = ( $tot_data_work_hours ? ($tot_data_talk_time/ ($tot_data_work_hours/const_hours() ) ): 0 );
 $avg_data_format_talk_time_hour = _getDuration($avg_data_talk_time_hours);
 $avg_data_talk_time_per_tmr = ( $tot_data_user_login ? ($tot_data_talk_time/$tot_data_user_login) : 0);   
 $avg_data_format_talk_time_per_tmr = _getDuration($avg_data_talk_time_per_tmr);
 
// ----------------- productivity -------------------------- 
 $avg_data_productivity_pif_per_tmr = ( ($tot_data_user_login) ? ( $tot_data_policy/$tot_data_user_login/$tot_data_work_days ) : 0);
 $avg_data_format_productivity_pif_per_tmr = _setRound($avg_data_productivity_pif_per_tmr,1);
 $avg_data_productivity_premi_per_tmr = ( ($tot_data_user_login) ? ( $tot_data_premi/$tot_data_user_login/$tot_data_work_days ) : 0);
 $avg_data_format_productivity_premi_per_tmr = _getCurrency($avg_data_productivity_premi_per_tmr);
 $avg_data_productivity_anp_per_tmr = ( ($tot_data_user_login) ? ( $tot_data_premi_anp/$tot_data_user_login/$tot_data_work_days ) : 0);
 $avg_data_format_productivity_anp_per_tmr = _getCurrency( $avg_data_productivity_anp_per_tmr );
 $avg_data_productivity_atempt_per_tmr = ( ($tot_data_user_login) ? ($tot_data_atempt/$tot_data_user_login/$tot_data_work_days) : 0); 
 $avg_data_format_productivity_atempt_per_tmr = _setRound( $avg_data_productivity_atempt_per_tmr, 2);
 $avg_data_productivity_premi_per_policy_per_year = ( $tot_data_policy ? (($tot_data_premi/$tot_data_policy)) : 0);
 $avg_data_format_productivity_premi_per_policy_per_year = _getCurrency($avg_data_productivity_premi_per_policy_per_year);
 $avg_data_persentation_rate  = ( $tot_data_persentation ? _setPercent($tot_data_policy/ $tot_data_persentation) : 0);
 $avg_data_reject_upfront_rate = _setPercent( ( $tot_contacted_y ? ( $tot_data_call_status_701 /$tot_contacted_y ) : 0 ));
 
 
// ====================================== 
 $obInst = new EUI_Object( $obUsers->_getUserDetail( $AssignLeader ));
 //print_r( $obInst );
 
  echo "<tr>
		  <td>". $obInst->get_value('Username') ."</td>
		  <td align='right'>{$tot_new_assigned_data}</td>
		  <td align='right'>{$tot_re_assigned_data}</td>
		  <td align='right'>{$tot_solicited_new_assign}</td>
		  <td align='right'>{$tot_solicited_re_utilized}</td>
		  <td align='right'>{$tot_data_utilize}</td>
		  <td align='right'>{$tot_data_sort_new_db}</td>
		  <td align='right'>{$tot_data_atempt}</td>
		  <td align='right'>{$avg_data_atempt}</td>
		  <td align='right'>{$tot_data_connected_y}</td>
		  <td align='right'>{$tot_data_connected_n101}</td>
		  <td align='right'>{$tot_data_connected_n102}</td>
		  <td align='right'>{$tot_data_connected_n103}</td>
		  <td align='right'>{$avg_data_connect_rate}</td>
		  <td align='right'>{$tot_contacted_y}</td>
		  <td align='right'>{$tot_data_connected_y201}</td>
		  <td align='right'>{$tot_data_connected_y202}</td>
		  <td align='right'>{$tot_data_connected_y203}</td>
		  <td align='right'>{$tot_data_connected_y204}</td>
		  <td align='right'>{$tot_data_connected_y205}</td>
		  <td align='right'>{$tot_data_connected_y206}</td>
		  <td align='right'>{$tot_data_connected_y207}</td>
		  <td align='right'>{$tot_data_connected_y208}</td>
		  <td align='right'>{$tot_data_connected_y209}</td>
		  <td align='right'>{$tot_data_connected_y210}</td>
		  <td align='right'>{$tot_data_connected_y211}</td>
		  <td align='right'>{$avg_data_format_contacted_rate}</td>
		  <td align='right'>{$tot_data_persentation}</td>
		  <td align='right'>{$avg_data_persentation}</td>
		  <td align='right'>{$tot_data_interest_601}</td>
		  <td align='right'>{$tot_data_interest_602}</td>
		  <td align='right'>{$tot_data_interest_603}</td>
		  <td align='right'>{$tot_data_not_interest_301}</td>
		  <td align='right'>{$tot_data_not_interest_302}</td>
		  <td align='right'>{$tot_data_not_interest_303}</td>
		  <td align='right'>{$tot_data_not_interest_304}</td>
		  <td align='right'>{$tot_data_not_interest_305}</td>
		  <td align='right'>{$tot_data_not_interest_306}</td>
		  <td align='right'>{$tot_data_not_interest_307}</td>
		  <td align='right'>{$tot_data_not_interest_308}</td>
		  <td align='right'>{$tot_data_not_interest_309}</td>
		  <td align='right'>{$tot_data_not_interest_310}</td>
		  <td align='right'>{$tot_data_not_interest_311}</td>
		  <td align='right'>{$tot_data_not_interest_312}</td>
		  <td align='right'>{$tot_data_not_interest_313}</td>
		  <td align='right'>{$tot_data_not_interest_314}</td>
		  <td align='right'>{$tot_data_not_interest_315}</td>
		  <td align='right'>{$tot_data_not_interest_316}</td>
		  <td align='right'>{$tot_data_not_interest_317}</td>".
		  
		 // <td align='right'>{$tot_data_call_status_318}</td>
		  
		  "<td align='right'>{$tot_data_call_status_701}</td>
		  <td align='right'>{$avg_data_reject_upfront_rate}</td>
		  <td align='right'>{$tot_data_call_status_401}</td>
		  <td align='right'>{$tot_data_call_status_402}</td>
		  <td align='right'>{$avg_data_followup}</td>
		  <td align='right'>{$tot_data_policy}</td>
		  <td align='right'>{$tot_data_insured}</td>
		  <td align='right'>{$tot_format_data_premi}</td>
		  <td align='right'>{$tot_format_data_premi_anp}</td>";
		  
		   if( is_array($arr_product) ) 
			foreach( $arr_product as $ProductId => $ProductName ) 
		 {
			$tot_pif_per_product 	= ( $call_data_content[$ProductId]['tot_policy_per_product'] ? $call_data_content[$ProductId]['tot_policy_per_product'] : 0);
			$tot_nos_per_product 	= ( $call_data_content[$ProductId]['tot_nos_per_product'] ? $call_data_content[$ProductId]['tot_nos_per_product'] : 0);
			$tot_premi_per_product 	= ( $call_data_content[$ProductId]['tot_premi_per_product'] ? $call_data_content[$ProductId]['tot_premi_per_product'] : 0 );
			$tot_anp_per_product 	= ( $call_data_content[$ProductId]['tot_premi_anp_per_product']?$call_data_content[$ProductId]['tot_premi_anp_per_product'] : 0 );
			
			// --------- fomater -------------------
			
			$tot_format_premi_per_product = _getCurrency($tot_premi_per_product);
			$tot_format_anp_per_product = _getCurrency($tot_anp_per_product);
			
			echo "<td align='right'>{$tot_pif_per_product}</td>
				  <td align='right'>{$tot_nos_per_product}</td>
				  <td align='right'>{$tot_format_premi_per_product}</td>
				  <td align='right'>{$tot_format_anp_per_product}</td>";
				  
			// ----------- sum of bottom data ---------------------------------
			
			$sum_tot_pif_per_product[$ProductId]	+= $tot_pif_per_product; 
			$sum_tot_nos_per_product[$ProductId]	+= $tot_nos_per_product; 
			$sum_tot_premi_per_product[$ProductId]	+= $tot_premi_per_product; 
			$sum_tot_anp_per_product[$ProductId]	+= $tot_anp_per_product;
			
			  
		 }
		 
		echo "<td align='right'>{$avg_sales_closing}</td>
		  <td align='right'>{$avg_data_persentation_rate}</td>
		  <td align='right'>{$avg_response_rate}</td>
		  <td align='right'>{$avg_data_nos_rate}</td>
		  <td align='right'>{$tot_data_format_talk_time}</td>
		  <td align='right'>{$avg_data_format_talk_time_hour}</td>
		  <td align='right'>{$avg_data_format_talk_time_per_tmr}</td>
		  <td align='right'>{$tot_data_format_hours}</td>
		  <td align='right'>{$tot_data_user_login}</td>
		  <td align='right'>{$tot_data_work_days}</td>
		  <td align='right'>{$avg_data_format_productivity_pif_per_tmr}</td>
		  <td align='right'>{$avg_data_format_productivity_premi_per_tmr}</td>
		  <td align='right'>{$avg_data_format_productivity_anp_per_tmr}</td>
		  <td align='right'>{$avg_data_format_productivity_atempt_per_tmr}</td>
		  <td align='right'>{$avg_data_format_productivity_premi_per_policy_per_year}</td>
		  <td align='right'>{$tot_data_bad_list}</td>
		  <td align='right'>{$avg_data_bad_list}</td>
	 </tr>";
	 
	 
	
	// ------------------- summary attribute data ---------------------------------------
	 
	 $sum_tot_new_assign+= $tot_new_assigned_data;
	 $sum_tot_de_assign+= $tot_de_assigned_data;
	 $sum_tot_re_assign+= $tot_re_assigned_data;
	 $sum_tot_solicited_new_assign+= $tot_solicited_new_assign;
	 $sum_tot_solicited_re_assign+= $tot_solicited_re_utilized;
	 $sum_tot_solicited_per_utilize+= $tot_data_utilize;
	 $sum_tot_sort_db_new+=$tot_data_sort_new_db;
	 $sum_tot_attempt_call+=$tot_data_atempt;
	 $sum_tot_connected_yes+=$tot_data_connected_y;
	 
	 // ------------------ summary  of contacted [  Y ]total bottom -------------------------
	 
	 $sum_tot_status_201+= $tot_data_connected_y201;
	 $sum_tot_status_202+= $tot_data_connected_y202;
	 $sum_tot_status_203+= $tot_data_connected_y203;
	 $sum_tot_status_204+= $tot_data_connected_y204;
	 $sum_tot_status_205+= $tot_data_connected_y205;
	 $sum_tot_status_206+= $tot_data_connected_y206;
	 $sum_tot_status_207+= $tot_data_connected_y207;
	 $sum_tot_status_208+= $tot_data_connected_y208;
	 $sum_tot_status_209+= $tot_data_connected_y209;
	 $sum_tot_status_210+= $tot_data_connected_y210;
	 $sum_tot_status_211+= $tot_data_connected_y211;
	 
	// ------------------ summary  of contacted [ N ]total bottom ------------------------- 

	 $sum_tot_status_101+= $tot_data_connected_n101;
	 $sum_tot_status_102+= $tot_data_connected_n102;
	 $sum_tot_status_103+= $tot_data_connected_n103;
	 
	// ------------------ summary  of  Interest total bottom -------------------------'

	 $sum_tot_status_601+= $tot_data_interest_601;
	 $sum_tot_status_602+= $tot_data_interest_602;
	 $sum_tot_status_603+= $tot_data_interest_603;

	// ------------------ summary  of  Not Interest total bottom -------------------------
	 $sum_tot_status_301+= $tot_data_not_interest_301;
	 $sum_tot_status_302+= $tot_data_not_interest_302;
	 $sum_tot_status_303+= $tot_data_not_interest_303;
	 $sum_tot_status_304+= $tot_data_not_interest_304;
	 $sum_tot_status_305+= $tot_data_not_interest_305;
	 $sum_tot_status_306+= $tot_data_not_interest_306;
	 $sum_tot_status_307+= $tot_data_not_interest_307;
	 $sum_tot_status_308+= $tot_data_not_interest_308;
	 $sum_tot_status_309+= $tot_data_not_interest_309;
	 $sum_tot_status_310+= $tot_data_not_interest_310;
	 $sum_tot_status_311+= $tot_data_not_interest_311;
	 $sum_tot_status_312+= $tot_data_not_interest_312;
	 $sum_tot_status_313+= $tot_data_not_interest_313;
	 $sum_tot_status_314+= $tot_data_not_interest_314;
	 $sum_tot_status_315+= $tot_data_not_interest_315;
	 $sum_tot_status_316+= $tot_data_not_interest_316;
	 $sum_tot_status_317+= $tot_data_not_interest_317;
	 $sum_tot_status_701+= $tot_data_call_status_701;
	 
	// --------------- summary of Unpersent ---------------------------------------
	 $sum_tot_persentation+=$tot_data_persentation;
	 $sum_tot_status_318+= $tot_data_call_status_318;
	 
	// --------------- summary of followup & ---------------------------------------

	 $sum_tot_status_401+= $tot_data_call_status_401; 
	 $sum_tot_status_402+= $tot_data_call_status_402;
	 $sum_tot_acv_pif+= $tot_data_policy;
	 $sum_tot_acv_nos+= $tot_data_insured;
	 $sum_tot_acv_premi+= $tot_data_premi;
	 $sum_tot_acv_premi_anp+= $tot_data_premi_anp;
	 $sum_tot_talk_time+= $tot_data_talk_time;
	 $sum_tot_bad_list +=$tot_data_bad_list;
	 $sum_data_followup +=$tot_data_followup; 
	 $sum_tot_data_persentation +=$tot_data_persentation;
	 $sum_tot_data_user_login += $tot_data_user_login;
	 $sum_tot_data_work_hours +=$tot_data_work_hours;
	 $sum_tot_contacted_y+=$tot_contacted_y;
	
	 
}
 
 
 $sum_tot_tmr_login = $sum_tot_data_user_login;
 $sum_tot_work_days = $tot_data_work_days;
 $sum_tot_work_hours = $sum_tot_data_work_hours;
 
 $sum_tot_attempt_ratio = ($sum_tot_solicited_per_utilize  ? ($sum_tot_attempt_call/ $sum_tot_solicited_per_utilize) : 0 );
 $sum_tot_connect_rate  = ($sum_tot_attempt_call ? ($sum_tot_connected_yes/ $sum_tot_attempt_call) : 0 );
 $sum_tot_contacted_rate = ($sum_tot_solicited_per_utilize ? ($sum_tot_contacted_y/ $sum_tot_solicited_per_utilize) : 0 );
 $sum_tot_sale_closing_rate = ($sum_tot_contacted_y ? ($sum_tot_acv_pif/$sum_tot_contacted_y) : 0 );
 $sum_tot_response_rate = ($sum_tot_solicited_per_utilize ? ( $sum_tot_acv_pif/$sum_tot_solicited_per_utilize): 0);
 $sum_tot_persentation_rate = ($sum_tot_contacted_y ? ( $sum_tot_persentation /$sum_tot_contacted_y ) : 0);
 $sum_tot_nos_rate = (($sum_tot_acv_nos - $sum_tot_acv_pif ) ? ( ( $sum_tot_acv_nos - $sum_tot_acv_pif )/$sum_tot_acv_pif) : 0); 
 $sum_tot_avg_talk_time_per_hour= ( $sum_tot_work_hours ? ($sum_tot_talk_time/ ($sum_tot_work_hours/const_hours() ) ): 0 );
 $sum_tot_avg_talk_time_per_tmr= ( $sum_tot_tmr_login ? ($sum_tot_talk_time/ $sum_tot_tmr_login) : 0);
 $sum_tot_productivity_per_tmr_pif = (($sum_tot_tmr_login) ? ($sum_tot_acv_pif/$sum_tot_tmr_login/$tot_data_work_days) : 0);
 $sum_tot_productivity_per_tmr_premi = (($sum_tot_tmr_login) ? ($sum_tot_acv_premi/$sum_tot_tmr_login/$tot_data_work_days) : 0);
 
 $sum_tot_avg_atempt_per_tmr = (($sum_tot_tmr_login) ? ($sum_tot_attempt_call/$sum_tot_tmr_login/$tot_data_work_days) : 0); 
 $sum_tot_avg_premi = ( $sum_tot_acv_pif ? ($sum_tot_acv_premi/ $sum_tot_acv_pif) : 0);
 $sum_tot_avg_followup = ( $sum_tot_contacted_y ? ($sum_data_followup/$sum_tot_contacted_y) : 0);
 $sum_tot_avg_bad_list = ( $sum_tot_solicited_per_utilize ? ($sum_tot_bad_list/$sum_tot_solicited_per_utilize) : 0);
  
  // --- slaes persentation rate 
 $sum_avg_data_persentation_rate  = ( $sum_tot_data_persentation ? ($sum_tot_acv_pif/ $sum_tot_data_persentation) : 0);
 $sum_avg_data_productivity_anp_per_tmr = ( ($sum_tot_tmr_login) ? ( $sum_tot_acv_premi_anp/$sum_tot_tmr_login/$tot_data_work_days ) : 0);
  

 
 
// --------------------------------------------------------------------------------------------------------
 
 $sum_tot_format_attempt_ratio 	 	= _setRound($sum_tot_attempt_ratio);
 $sum_tot_format_connect_rate 	 	= _setPercent($sum_tot_connect_rate);
 $sum_tot_format_contacted_rate  	= _setPercent($sum_tot_contacted_rate);
 $sum_tot_format_nos_rate 		    = _setPercent($sum_tot_nos_rate);
 $sum_tot_format_response_rate 	    = _setPercent($sum_tot_response_rate);
 $sum_tot_format_persentation_rate  = _setPercent($sum_tot_persentation_rate);
 $sum_tot_format_sale_closing_rate  = _setPercent($sum_tot_sale_closing_rate);
 $sum_tot_productivity_per_tmr_pif  = _setRound($sum_tot_productivity_per_tmr_pif);
 $sum_tot_avg_atempt_per_tmr 	    = _setRound($sum_tot_avg_atempt_per_tmr);
 $sum_tot_format_avg_followup	    = _setPercent($sum_tot_avg_followup);
 $sum_tot_format_avg_bad_list		= _setPercent($sum_tot_avg_bad_list);
 $sum_tot_format_acv_anp 			= _getCurrency($sum_tot_acv_premi);
 $sum_tot_format_acv_premi_anp  	= _getCurrency($sum_tot_acv_premi_anp);
 $sum_avg_format_persentation_rate  = _setPercent($sum_avg_data_persentation_rate);
 $sum_avg_format_data_productivity_anp_per_tmr = _getCurrency($sum_avg_data_productivity_anp_per_tmr);
 
 // ----------- other format  ----------------------------------------------------------------
 $sum_tot_format_talk_time 				= _getDuration($sum_tot_talk_time);
 $sum_tot_format_work_hours 			= _getDuration($sum_tot_work_hours);
 $sum_tot_format_avg_talk_time_per_hour = _getDuration($sum_tot_avg_talk_time_per_hour);  
 $sum_tot_format_avg_talk_time_per_tmr 	= _getDuration($sum_tot_avg_talk_time_per_tmr); 
 $sum_tot_productivity_per_tmr_premi 	= _getCurrency($sum_tot_productivity_per_tmr_premi); 
 $sum_tot_avg_premi 					= _getCurrency($sum_tot_avg_premi);
 $sum_avg_data_reject_upfront_rate 		= _setPercent( ( $sum_tot_contacted_y ? ( $sum_tot_status_701 /$sum_tot_contacted_y ) : 0 ));
 
 
 
 
echo "<tr>
		<td class=\"head\">Summary</td>
		<td class=\"head\" align=\"right\">{$sum_tot_new_assign}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_re_assign}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_solicited_new_assign}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_solicited_re_assign}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_solicited_per_utilize}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_sort_db_new}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_attempt_call}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_attempt_ratio}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_connected_yes}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_101}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_102}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_103}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_connect_rate}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_contacted_y}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_201}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_202}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_203}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_204}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_205}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_206}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_207}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_208}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_209}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_210}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_211}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_contacted_rate}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_persentation}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_persentation_rate}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_601}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_602}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_603}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_301}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_302}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_303}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_304}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_305}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_306}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_307}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_308}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_309}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_310}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_311}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_312}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_313}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_314}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_315}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_316}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_317}</td>".
		
		//<td class=\"head\" align=\"right\">{$sum_tot_status_318}</td>
		
		"<td class=\"head\" align=\"right\">{$sum_tot_status_701}</td>
		<td class=\"head\" align=\"right\">{$sum_avg_data_reject_upfront_rate}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_401}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_402}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_avg_followup}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_acv_pif}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_acv_nos}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_acv_anp}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_acv_premi_anp}</td>";
		 if( is_array($arr_product) ) 
			foreach( $arr_product as $ProductId => $ProductName ) 
		 {
			$sum_format_tot_pif_per_product	  = ($sum_tot_pif_per_product[$ProductId]?$sum_tot_pif_per_product[$ProductId]:0);
			$sum_format_tot_nos_per_product	  = ($sum_tot_nos_per_product[$ProductId]?$sum_tot_nos_per_product[$ProductId]:0);
			$sum_format_tot_premi_per_product = ($sum_tot_premi_per_product[$ProductId]? _getCurrency($sum_tot_premi_per_product[$ProductId]):0);
			$sum_format_tot_anp_per_product   = ($sum_tot_anp_per_product[$ProductId]? _getCurrency($sum_tot_anp_per_product[$ProductId]):0);

 
			echo "<td class=\"head\" align=\"right\">{$sum_format_tot_pif_per_product}</td>
				  <td class=\"head\" align=\"right\">{$sum_format_tot_nos_per_product}</td>
				  <td class=\"head\" align=\"right\">{$sum_format_tot_premi_per_product}</td>
				  <td class=\"head\" align=\"right\">{$sum_format_tot_anp_per_product}</td>";
		 }
		 
		
		echo "<td class=\"head\" align=\"right\">{$sum_tot_format_sale_closing_rate}</td>
		<td class=\"head\" align=\"right\">{$sum_avg_format_persentation_rate}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_response_rate}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_nos_rate}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_talk_time}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_avg_talk_time_per_hour}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_avg_talk_time_per_tmr}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_work_hours}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_tmr_login}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_work_days}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_productivity_per_tmr_pif}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_productivity_per_tmr_premi}</td>
		<td class=\"head\" align=\"right\">{$sum_avg_format_data_productivity_anp_per_tmr}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_avg_atempt_per_tmr}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_avg_premi}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_bad_list}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_format_avg_bad_list}</td>
 </tr> </table> ";
 		
}

//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

 function _select_campaign_group_atm_detail()
{
 $vars = new EUI_Object(_get_all_request() );
 $class =& get_class_instance('M_SysUser');
 
 if( count($vars) ) 
	foreach( $vars->get_array_value('AtmId') as $k => $gAtmId )
 {
	$Instance = new EUI_Object( $class->_getUserDetail( $gAtmId ));
	echo "<h4>{$Instance->get_value('Username')}</h4><hr size=1>"; 
	_select_campaign_group_per_atm_detail( $gAtmId );
	
  } 
}
 
//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 function showReport()
{
	if( _get_post('interval') =='summary' ){
		_select_campaign_group_atm_summary();		
	}
	
	
	if( _get_post('interval') =='detail' ){
		_select_campaign_group_atm_detail();		
	}
} 	

//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function _select_interval_report_mode()
{
	if( _get_post('interval') =='summary' ){
		return "Summary";
	}
	
	if( _get_post('interval') =='detail' ){
		return "Detail";
	}
}

//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 function _select_campaign_attr_header()
 {
	$CI  =& get_instance();
	$obj =& get_class_instance("M_CallTrackingReport");
	$out =new EUI_Object(_get_all_request() );
	
	$arr_campaign = array_map("strtolower", $out->get_array_value('CampaignId') );
	if( in_array("all", $arr_campaign) ) {
		return "All Campaign";
	} 
	else{
		$arr_context = array();
		$arr_campaign = $obj->_select_report_campaign();
		$arr_vars = $out->get_array_value('CampaignId');
		
		if( is_array($arr_vars) )
			foreach( $arr_vars as $key => $val)
		{
			$arr_context[]  = $arr_campaign[$val];
		}	
		return join("/&nbsp;", $arr_context);
	}
 }
 

//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 function showheaders()
{
	echo "<div class=\"center\">".
		 "<p class=\"normal font-size22\">Report Call Tracking - Campaign Group By ATM</p>".
		 "<p class=\"normal font-size20\">Report Campaign : ". _select_campaign_attr_header() ."</p>".
		 "<p class=\"normal font-size18\">Report Mode :". _select_interval_report_mode() ."</p>".
		 "<p class=\"normal font-size16\">Periode :". _get_post("start_date") ." to ". _get_post("end_date") ."</p>".
		 "<p class=\"normal font-size14\">Print date : ". date('d-m-Y H:i') ."</p>".
	"</div>";
}	


//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 function _select_report_notes()
{
	$class =& get_class_instance("M_CallTrackingReport");
	$Note = $class->_select_report_notes();
	$notes = "<br><table class=\"data\" border=1 style=\"border-collapse: collapse\">".
			"<tr height=\"22\">
				<td class='head'><b>Category</b></td>
				<td class='head'><b>Code</b></td>
				<td class='head'><b>Code Detail</b></td>
			</tr>";	
			
	if(is_array($Note) )
		foreach( $Note as $k => $row )
	{
		$notes .= "<tr>
						<td>{$row['CallReasonCategoryName']}</td>
						<td>{$row['CallReasonCode']}</td>
					<td>{$row['CallReasonDesc']}</td>
					</tr>";	
	}
	
	$notes.="</table>";
	return $notes;
}	


//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 function _select_report_notification()
{
	$class =& get_class_instance("M_CallTrackingReport");
	$Note = $class->_select_report_notification();
	$notes .="<br><table class=\"data\" border=1 style=\"border-collapse: collapse\" cellpadding=\"8\">
	
			<tr height=\"22\">
				<td class='head' colspan='3'><b>Notification</b>:</td>
			</tr>";	
			
	if(is_array($Note) )
		foreach( $Note as $k => $row )
	{
		$notes .= "<tr>
				<td>{$row['note']}</td>
				<td>:</td>
				<td>{$row['desc']}</td>
			</tr>";	
	}
	
	$notes.="</table>";
	return $notes;
	
}	


//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function showInformation()
{
	echo "<br><table style=\"margin-top:10px;\">
			<tr>
				<td valign=\"top\"> ". _select_report_notes() ."</td>
				<td valign=\"top\"></td>
				<td valign=\"top\"> ". _select_report_notification() ."</td>
			</tr>	
		</table>";
} 


// =============================================================================

?>


<html>
	<head>
		<title>
			Call Tracking
		</title>
		<style>
<!--
	body, td, input, select, textarea {
	font: normal 12 "trebuchet MS",Tahoma,verdana,sans-serif;
}

a img {
	border: 0;
}
a.hover {
	text-decoration: none;
}
a.hover:hover {
	text-decoration: underline;
}
form {
	margin: 0;
	padding: 0;
}
table.data {
	border-style: solid;
	border-width: 1;
	border-color: silver;
	background-color: #ECF1FB;
	background-image: url(bgtablebox.jpg);
	background-position: bottom;
	background-repeat: repeat-x;
}
table.data th {
	padding: 3;
}
table.data td {
	padding: 0 6 0 6;
}
table.data td, table.data th {
	font: normal 12 "trebuchet ms",tahoma,verdana,sans-serif;
	vertical-align: top;
}
table.data th {
	background-color: 3565AF;
	color: white;
	font-weight: normal;
	vertical-align: top;
	text-align: left;
}
table.data th a, table.data th a:visited {
	font-weight: normal;
	color: #CCFFFF;
}
table.data td.head {
	background-color: AABBFF;
}
input, textarea {
}
input.button, button.button, span.button, div.button {
	border-style: solid;
	border-width: 1;
	border-color: 6666AA;
	background-image: url(bgbutt.jpg);
	background-repeat: repeat-x;
	background-position: center;
	font: normal 12 "trebuchet ms",tahoma,verdana,sans-serif;
	font-weight: normal;
}
span.button a, div.button a {
	color: #0F31BB;
}
table.subdata th {
	font: normal 12 "trebuchet ms",tahoma,verdana,sans-serif;
	color: #637dde;
	padding: 0 5 0 0;
	text-align: left;
}

.left { text-align:left;}
.right{ text-align:right;}
.center{ text-align:center;}
.font-size22 { font-size:22px; color:#000;}
.font-size20 { font-size:20px; color:#000;}
.font-size18 { font-size:18px; color:#000;}
.font-size16 { font-size:16px; color:#000;} 
.font-size14 { font-size:16px; color:#000;} 

p.normal  { line-height:6px;}
			-->
			</style>
</head>
<body>
	<?php PrepareCallData();?>
	<?php showheaders(); ?>
	<?php showReport(); ?>
	<?php showInformation(); ?>
	<?php CleanCallData(); ?>
</body>
</html>
