<?php 

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
	$CI->db->select("a.ProductId, a.ProductCode, REPLACE(a.ProductName, 'BNI Life ', '') as ProductName", FALSE);
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

 
 function _select_campaign_group_mgr_summary()
{
	
 $UI=& get_instance();
 $Out=& new EUI_Object(_get_all_request() );
 $CampaignId = _select_report_campaign_id();
 $ManagerId = $Out->get_array_value("ManagerId");
 
// --------------------------------------------- 
 $arr_product = _select_report_active_product();
 $colspan = (4*count( $arr_product));
 
echo "<table class=\"data\" border=1 style=\"border-collapse: collapse\">
	 <tr>
	  <td class=\"head\" rowspan=3 align=\"center\" style=\"vertical-align:middle;\">MGR</td>
	  <td class=\"head\" colspan=6>DB</td>
	  <td class=\"head\" rowspan=3>Attempted</td>
	  <td class=\"head\" rowspan=3>Attempt Ratio</td>
	  <td class=\"head\" colspan=5>Connected</td>
	  <td class=\"head\" colspan=13>Contacted</td>
	  <td class=\"head\" ></td>
	  <td class=\"head\" align=\"center\" colspan=22>Presentation</td>
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
	  <td class=\"head\" colspan=18>Not Interested</td>
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
	  <td class=\"head\">317</td>
	  <td class=\"head\">318</td>
	   <td class=\"head\">701</td>
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
 
// ------------- dis new DB  -------------------------

 $UI->db->reset_select();
 $UI->db->select("count( distinct a.CustomerId) as tot_new_data,a.AssignAmgr as AssignAmgr", FALSE);
 $UI->db->from("t_gn_assignment_log a force index(primary)");
 $UI->db->join("t_gn_customer b","a.CustomerId=b.CustomerId", "LEFT OUTER");
 $UI->db->where("a.CallReasonId=99", "", FALSE);
 $UI->db->where_in("b.CampaignId", $CampaignId); 
 
 $UI->db->where_in("a.AssignAmgr", array_map('intval', $Out->get_array_value('ManagerId')));
 $UI->db->where("a.AssignDate>='{$Out->get_value('start_date','StartDate')}'", "", false);
 $UI->db->where("a.AssignDate<='{$Out->get_value('end_date','EndDate')}'", "", false);
 $UI->db->group_by(array("AssignAmgr"));
 
 //$UI->db->print_out();
 
 $rs = $UI->db->get();
 if( $rs->num_rows() > 0 ) 
	 foreach( $rs->result_assoc() as $rows ) 
{
	$data[$rows['AssignAmgr']]['tot_new_assigned'] += $rows['tot_new_data'];
} 


// ------------- dist Old  DB  -------------------------

 $UI->db->reset_select();
 $UI->db->select("count( distinct a.CustomerId) as tot_re_assigned,a.AssignAmgr as AssignAmgr", FALSE);
 $UI->db->from("t_gn_assignment_log a force index(primary)");
 $UI->db->join("t_gn_customer b","a.CustomerId=b.CustomerId", "LEFT OUTER");
 $UI->db->where("a.CallReasonId<>99", "", FALSE);
 $UI->db->where_in("b.CampaignId", $CampaignId); 
 $UI->db->where_in("a.AssignAmgr", array_map('intval', $Out->get_array_value('ManagerId')));
 $UI->db->where("a.AssignDate>='{$Out->get_value('start_date','StartDate')}'", "", false);
 $UI->db->where("a.AssignDate<='{$Out->get_value('end_date','EndDate')}'", "", false);
 $UI->db->group_by(array("AssignAmgr"));
 
 $rs = $UI->db->get();
 if( $rs->num_rows() > 0 ) 
	 foreach( $rs->result_assoc() as $rows ) 
{
	$data[$rows['AssignAmgr']]['tot_re_assigned'] += $rows['tot_re_assigned'];
} 
 
// ---------- ambil data atemp pertiap Agent Under & spv & atm & MGR --------------
 
 $UI->db->reset_select();
 $UI->db->select("count(a.CallHistoryId) as data_size_atempt,
	e.UserId as AssignAmgr", 
FALSE);

 $UI->db->from("t_gn_callhistory a FORCE INDEX(PRIMARY)");
 $UI->db->join("t_gn_customer b","a.CustomerId=b.CustomerId", "LEFT");
 $UI->db->join("tms_agent c ","a.SPVCode = c.id", "LFET");
 $UI->db->join("tms_agent d ","a.ATMCode = d.id", "LFET");
 $UI->db->join("tms_agent e  ","a.AMGRCode = e.id", "LFET");
 
 $UI->db->where_in("b.CampaignId", $CampaignId );
 $UI->db->where("a.HistoryType", 0);
 $UI->db->where("a.CallHistoryCallDate>='{$Out->get_value('start_date','StartDate')}'", "", false);
 $UI->db->where("a.CallHistoryCallDate<='{$Out->get_value('end_date','EndDate')}'", "", false);
 $UI->db->where_in("e.UserId", array_map('intval', $Out->get_array_value('ManagerId')));
 $UI->db->group_by(array('AssignAmgr'));
 
 // echo $UI->db->print_out();
 
 $rs = $UI->db->get();
  if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows ) 
 {
	$data[$rows['AssignAmgr']]['tot_data_atempt'] +=$rows['data_size_atempt'];
 }
 
// --- load status in history Hight db -----------------------------


 $UI->db->reset_select();
 $UI->db->select(" 
	1 as total_size,
	e.UserId as AssignAmgr,
	
	(SELECT 
		IF(tcs.CallBeforeReasonId IN(99),1,0) as NewUtilize
	 FROM t_gn_callhistory tcs 
	 WHERE tcs.HistoryType = 0
	 AND tcs.CallHistoryId= MAX(a.CallHistoryId)
	 AND tcs.CallHistoryCallDate>='{$Out->get_value('start_date','StartDate')}'
	 AND tcs.CallHistoryCallDate<='{$Out->get_value('end_date','EndDate')}'
     AND tcs.AMGRCode = e.id 	
	) as tot_new_utilize,
	
	(SELECT 
		IF(tcs.CallBeforeReasonId NOT IN(99),1,0) as OldUtilize
	FROM t_gn_callhistory tcs where tcs.HistoryType = 0
	AND tcs.CallHistoryId= MAX(a.CallHistoryId)
	AND tcs.CallHistoryCallDate>='{$Out->get_value('start_date','StartDate')}'
	AND tcs.CallHistoryCallDate<='{$Out->get_value('end_date','EndDate')}'
	AND tcs.AMGRCode = e.id 	
	) as tot_old_utilize,	
	
	(  select cgs.CallReasonCode
	   from t_gn_callhistory tgs 
	   inner join t_lk_callreason cgs on tgs.CallReasonId = cgs.CallReasonId
	   where tgs.CallHistoryId= MAX(a.CallHistoryId)
	   and tgs.HistoryType = 0
	   and tgs.AMGRCode=e.id 
	) as CallreasonIdCode", FALSE);
	
	
 $UI->db->from("t_gn_callhistory a FORCE INDEX(PRIMARY)");
 $UI->db->join("t_gn_customer b","a.CustomerId=b.CustomerId","INNER JOIN");
 $UI->db->join("tms_agent e  ","a.AMGRCode = e.id", "LFET");
 
//---- filter data ---------------------------
 
 $UI->db->where_in("b.CampaignId", $CampaignId );
 $UI->db->where("a.HistoryType", 0);
 $UI->db->where_in("e.UserId", array_map('intval', $Out->get_array_value('ManagerId')));
 $UI->db->where("a.CallHistoryCallDate>='{$Out->get_value('start_date','StartDate')}'", "", false);
 $UI->db->where("a.CallHistoryCallDate<='{$Out->get_value('end_date','EndDate')}'", "", false);
 $UI->db->group_by(array("AssignAmgr","a.CustomerId"));
 
 $rs = $UI->db->get();
 if( $rs->num_rows() > 0 ) 
	 foreach( $rs->result_assoc() as $rows ) 
{
	$data[$rows['AssignAmgr']]['data_all_solicited'] += $rows['total_size'];
	$data[$rows['AssignAmgr']]['data_old_utilize'] += $rows['tot_old_utilize'];
	$data[$rows['AssignAmgr']]['data_new_utilize'] += $rows['tot_new_utilize'];
	$data[$rows['AssignAmgr']]['tot_data_status_101'] += ( in_array($rows['CallreasonIdCode'],array('101')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_102'] += ( in_array($rows['CallreasonIdCode'],array('102')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_103'] += ( in_array($rows['CallreasonIdCode'],array('103')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_201'] += ( in_array($rows['CallreasonIdCode'],array('201')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_202'] += ( in_array($rows['CallreasonIdCode'],array('202')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_203'] += ( in_array($rows['CallreasonIdCode'],array('203')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_204'] += ( in_array($rows['CallreasonIdCode'],array('204')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_205'] += ( in_array($rows['CallreasonIdCode'],array('205')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_206'] += ( in_array($rows['CallreasonIdCode'],array('206')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_207'] += ( in_array($rows['CallreasonIdCode'],array('207')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_208'] += ( in_array($rows['CallreasonIdCode'],array('208')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_209'] += ( in_array($rows['CallreasonIdCode'],array('209')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_210'] += ( in_array($rows['CallreasonIdCode'],array('210')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_211'] += ( in_array($rows['CallreasonIdCode'],array('211')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_301'] += ( in_array($rows['CallreasonIdCode'],array('301')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_302'] += ( in_array($rows['CallreasonIdCode'],array('302')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_303'] += ( in_array($rows['CallreasonIdCode'],array('303')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_304'] += ( in_array($rows['CallreasonIdCode'],array('304')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_305'] += ( in_array($rows['CallreasonIdCode'],array('305')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_306'] += ( in_array($rows['CallreasonIdCode'],array('306')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_307'] += ( in_array($rows['CallreasonIdCode'],array('307')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_308'] += ( in_array($rows['CallreasonIdCode'],array('308')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_309'] += ( in_array($rows['CallreasonIdCode'],array('309')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_310'] += ( in_array($rows['CallreasonIdCode'],array('310')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_311'] += ( in_array($rows['CallreasonIdCode'],array('311')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_312'] += ( in_array($rows['CallreasonIdCode'],array('312')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_313'] += ( in_array($rows['CallreasonIdCode'],array('313')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_314'] += ( in_array($rows['CallreasonIdCode'],array('314')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_315'] += ( in_array($rows['CallreasonIdCode'],array('315')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_316'] += ( in_array($rows['CallreasonIdCode'],array('316')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_317'] += ( in_array($rows['CallreasonIdCode'],array('317')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_318'] += ( in_array($rows['CallreasonIdCode'],array('318')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_401'] += ( in_array($rows['CallreasonIdCode'],array('401')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_402'] += ( in_array($rows['CallreasonIdCode'],array('402')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_601'] += ( in_array($rows['CallreasonIdCode'],array('601')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_602'] += ( in_array($rows['CallreasonIdCode'],array('602')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_603'] += ( in_array($rows['CallreasonIdCode'],array('603')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignAmgr']]['tot_data_status_701'] += ( in_array($rows['CallreasonIdCode'],array('701')) ? $rows['total_size'] : 0 );
	
}
	
 // ---------- get data talktime --------------
  
  $UI->db->reset_select();
  $UI->db->select("c.AssignAmgr as AssignAmgr, SUM(a.duration) as tot_talk_time ", FALSE);
  $UI->db->from("cc_recording a");
  $UI->db->join("t_gn_customer b "," a.assignment_data=b.CustomerId", "LEFT");
  $UI->db->join("t_gn_assignment c "," b.CustomerId=c.CustomerId","LEFT");
	
  $UI->db->where_in("b.CampaignId", $CampaignId); 
  $UI->db->where_in("c.AssignAmgr", array_map('intval', $Out->get_array_value('ManagerId')));
  $UI->db->where("a.start_time>='{$Out->get_value('start_date','StartDate')}'", "", false);
  $UI->db->where("a.start_time<='{$Out->get_value('end_date','EndDate')}'", "", false);
  $UI->db->group_by(array("AssignAmgr"));
   
  $rs = $UI->db->get();
  if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows ) 
 {
	$data[$rows['AssignAmgr']]['data_tot_talk_time'] +=$rows['tot_talk_time'];
 }
 
 // ---------------- get data policy achivement per product ----------------------
 $UI->db->reset_select();
 $UI->db->select("
	b.ProductId as ProductId,
	e.AssignAmgr as AssignAmgr,
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
 $UI->db->where_in("e.AssignAmgr", array_map('intval', $Out->get_array_value('ManagerId') ));
 $UI->db->where("a.PolicySalesDate>='{$Out->get_value('start_date','StartDate')}'", "", false);
 $UI->db->where("a.PolicySalesDate<='{$Out->get_value('end_date','EndDate')}'", "", false);
 $UI->db->group_by(array("AssignAmgr","ProductId"));
 
 
 
 $rs = $UI->db->get();
 if($rs->num_rows() > 0)  
	foreach( $rs->result_assoc() as $rows )
 {
	$data[$rows['AssignAmgr']][$rows['ProductId']]['tot_nos_per_product']+= $rows['tot_nos_per_product'];
	$data[$rows['AssignAmgr']][$rows['ProductId']]['tot_policy_per_product']+= $rows['tot_policy_per_product'];
	$data[$rows['AssignAmgr']][$rows['ProductId']]['tot_premi_per_product']+= $rows['tot_premi_per_product'];
	$data[$rows['AssignAmgr']][$rows['ProductId']]['tot_premi_anp_per_product']+= $rows['tot_premi_anp_per_product'];
 }
 
 
// ------------ data Coloseint policy sales ----------------------------------------------
  $UI->db->reset_select();
  $UI->db->select("
		COUNT(distinct b.PolicyNumber) as tot,
		a.PolicyNumber as PolicyNumber,
		e.AssignAmgr as AssignAmgr,
		COUNT(a.PolicyId) as tot_data_insured,
		SUM(IF(d.PayModeId IN(2), a.PolicyPremi, a.PolicyPremi)) as tot_data_premi,
		SUM(IF(d.PayModeId IN(2), (a.PolicyPremi * 12), a.PolicyPremi)) as tot_data_premi_anp", FALSE);
	
  $UI->db->from("t_gn_policy a FORCE INDEX(PRIMARY)");
  $UI->db->join("t_gn_policyautogen b ","a.PolicyNumber=b.PolicyNumber", "LEFT");
  $UI->db->join("t_gn_customer c ","b.CustomerId=c.CustomerId", "LEFT");
  $UI->db->join("t_gn_productplan d ","a.ProductPlanId=d.ProductPlanId", "LEFT");
  $UI->db->join("t_gn_assignment e ","b.CustomerId=e.CustomerId", "LEFT");
  $UI->db->where_in("c.CampaignId", $CampaignId); 
  $UI->db->where_in("e.AssignAmgr", $Out->get_array_value('ManagerId'));
  $UI->db->where("a.PolicySalesDate>='{$Out->get_value('start_date','StartDate')}'", "", false);
  $UI->db->where("a.PolicySalesDate<='{$Out->get_value('end_date','EndDate')}'", "", false);
  $UI->db->group_by(array("PolicyNumber","AssignAmgr"));
 //echo $UI->db->print_out();
 
  $rs = $UI->db->get();
  if($rs->num_rows() > 0)  
		foreach( $rs-> result_assoc() as $rows )
{
	$data[$rows['AssignAmgr']]['total_data_policy'] += $rows['tot'];
	$data[$rows['AssignAmgr']]['tot_data_insured'] += $rows['tot_data_insured'];
	$data[$rows['AssignAmgr']]['tot_data_premi'] += $rows['tot_data_premi'];
	$data[$rows['AssignAmgr']]['tot_data_premi_anp'] += $rows['tot_data_premi_anp'];
}	

// ------------ select count user login on interval ---------------------------------
 $UI->db->reset_select();
 $UI->db->select("count(distinct a.ActivityUserId) as tot_user_tmr, a.ActivityUserId, b.act_mgr as AssignAmgr", FALSE);
 $UI->db->from("t_gn_activitylog a force index(primary) ");
 $UI->db->join("tms_agent b ","a.ActivityUserId=b.UserId", "LEFT");
 $UI->db->where("a.ActivityDate>='{$Out->get_value('start_date','StartDate')}'", "", FALSE);
 $UI->db->where("a.ActivityDate<='{$Out->get_value('end_date','EndDate')}'", "", FALSE);
 $UI->db->where_in("b.handling_type",array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));
 $UI->db->where_in("b.act_mgr",array_map('intval', $Out->get_array_value('ManagerId')) );
 
 $UI->db->group_by("a.ActivityUserId");
 //echo $UI->db->print_out();
 
 $rs = $UI->db->get();
 if($rs->num_rows() > 0)  
	foreach( $rs-> result_assoc() as $rows )
{
	$data[$rows['AssignAmgr']]['data_tot_user_login'] += $rows['tot_user_tmr'];
}
	
// ---- select day work data agent data -----------------------------------
	
 $UI->db->reset_select();
 $UI->db->select(" 1 As tot_day_work, 
				date_format(a.ActivityDate,'%Y-%m-%d') as tgl ", FALSE);
 $UI->db->from("t_gn_activitylog a force index(primary) ");
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
 $UI->db->select(" a.ActivityUserId as UserId, date(a.ActivityDate) as tgl, b.act_mgr as AssignAmgr",FALSE);
 $UI->db->from("t_gn_activitylog a force index(primary) ");	
 $UI->db->join("tms_agent b","a.ActivityUserId = b.UserId", "LEFT");
 $UI->db->where("a.ActivityDate>='{$Out->get_value('start_date','StartDate')}'", "", FALSE);
 $UI->db->where("a.ActivityDate<='{$Out->get_value('end_date','EndDate')}'", "", FALSE);
 $UI->db->where_in("b.handling_type",array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));
 $UI->db->where_in("b.act_mgr",array_map('intval', $Out->get_array_value('ManagerId')) );
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
			$data[$rows['AssignAmgr']]['data_tot_hour_work'] += $hour_maximum;
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
 
 if(is_array($ManagerId ) ) 
	 foreach( $ManagerId  as $key => $ManagerId )
{
	
// --------- index ----------------------- 
 $AgentName  = $rows['full_name'];
 $AgentId = $rows['UserId'];
 $row = $data[$ManagerId];
 
 
 $status_101 = ( $row['tot_data_status_101'] ? $row['tot_data_status_101'] : 0 );
 $status_102 = ( $row['tot_data_status_102'] ? $row['tot_data_status_102'] : 0 );
 $status_103 = ( $row['tot_data_status_103'] ? $row['tot_data_status_103'] : 0 );
 $status_201 = ( $row['tot_data_status_201'] ? $row['tot_data_status_201'] : 0);
 $status_202 = ( $row['tot_data_status_202'] ? $row['tot_data_status_202'] : 0);
 $status_203 = ( $row['tot_data_status_203'] ? $row['tot_data_status_203'] : 0);
 $status_204 = ( $row['tot_data_status_204'] ? $row['tot_data_status_204'] : 0);
 $status_205 = ( $row['tot_data_status_205'] ? $row['tot_data_status_205'] : 0);
 $status_206 = ( $row['tot_data_status_206'] ? $row['tot_data_status_206'] : 0);
 $status_207 = ( $row['tot_data_status_207'] ? $row['tot_data_status_207'] : 0);
 $status_208 = ( $row['tot_data_status_208'] ? $row['tot_data_status_208'] : 0);
 $status_209 = ( $row['tot_data_status_209'] ? $row['tot_data_status_209'] : 0);
 $status_210 = ( $row['tot_data_status_210'] ? $row['tot_data_status_210'] : 0);
 $status_211 = ( $row['tot_data_status_211'] ? $row['tot_data_status_211'] : 0);
 $status_601 = ( $row['tot_data_status_601'] ? $row['tot_data_status_601'] : 0);
 $status_602 = ( $row['tot_data_status_602'] ? $row['tot_data_status_602'] : 0);
 $status_603 = ( $row['tot_data_status_603'] ? $row['tot_data_status_603'] : 0);
 
 $status_301 = ( $row['tot_data_status_301'] ? $row['tot_data_status_301'] : 0);
 $status_302 = ( $row['tot_data_status_302'] ? $row['tot_data_status_302'] : 0);
 $status_303 = ( $row['tot_data_status_303'] ? $row['tot_data_status_303'] : 0);
 $status_304 = ( $row['tot_data_status_304'] ? $row['tot_data_status_304'] : 0);
 $status_305 = ( $row['tot_data_status_305'] ? $row['tot_data_status_305'] : 0);
 $status_306 = ( $row['tot_data_status_306'] ? $row['tot_data_status_306'] : 0);
 $status_307 = ( $row['tot_data_status_307'] ? $row['tot_data_status_307'] : 0);
 $status_308 = ( $row['tot_data_status_308'] ? $row['tot_data_status_308'] : 0);
 $status_309 = ( $row['tot_data_status_309'] ? $row['tot_data_status_309'] : 0);
 $status_310 = ( $row['tot_data_status_310'] ? $row['tot_data_status_310'] : 0);
 $status_311 = ( $row['tot_data_status_311'] ? $row['tot_data_status_311'] : 0);
 $status_312 = ( $row['tot_data_status_312'] ? $row['tot_data_status_312'] : 0);
 $status_313 = ( $row['tot_data_status_313'] ? $row['tot_data_status_313'] : 0);
 $status_314 = ( $row['tot_data_status_314'] ? $row['tot_data_status_314'] : 0);
 $status_315 = ( $row['tot_data_status_315'] ? $row['tot_data_status_315'] : 0);
 $status_316 = ( $row['tot_data_status_316'] ? $row['tot_data_status_316'] : 0);
 $status_317 = ( $row['tot_data_status_317'] ? $row['tot_data_status_317'] : 0);
 $status_318 = ( $row['tot_data_status_318'] ? $row['tot_data_status_318'] : 0);
 $status_701 = ( $row['tot_data_status_701'] ? $row['tot_data_status_701'] : 0);
 $status_401 = ( $row['tot_data_status_401'] ? $row['tot_data_status_401'] : 0);
 $status_402 = ( $row['tot_data_status_402'] ? $row['tot_data_status_402'] : 0);  
  
  

// -- avg coneected rate ----------

 $tot_data_persentation = ( 
							$status_601+
							$status_602+
							$status_603+
							$status_301+ 
							$status_302+
							$status_303+
							$status_304+
							$status_305+
							$status_306+
							$status_307+
							$status_308+
							$status_309+
							$status_310+
							$status_311+
							$status_312+
							$status_313+
							$status_314+
							$status_315+
							$status_316+
							$status_317+
							$status_318+
							$status_401+
							$status_402);
							
 $tot_contacted_y = ( $tot_data_persentation + $status_701); 
 
 $tot_data_connected_y = ( $status_201+
					       $status_202+
						   $status_203+
						   $status_204+
						   $status_205+
						   $status_206+
						   $status_207+
						   $status_208+
						   $status_209+
						   $status_210+
						   $status_211+
						   $tot_data_persentation); 
						   
 $tot_connected_call = 	($tot_data_connected_y+$status_101+$status_102+$status_103);
 $tot_data_bad_list  = ($status_101+$status_102+ $status_103+$status_204+$status_209+$status_211);
						 
						 
// ------------- total data talk time -----
 $tot_data_talk_time =($row['data_tot_talk_time']? $row['data_tot_talk_time'] : 0 ); 
 $tot_data_work_hours = ( $row['data_tot_hour_work'] ? $row['data_tot_hour_work'] : 0);
 $tot_data_user_login = ( $row['data_tot_user_login'] ? $row['data_tot_user_login'] : 0);
 $tot_data_format_hours = _getDuration($tot_data_work_hours);
 
// --------- total Policy Insured -----------
 
 $tot_data_policy = ( $row['total_data_policy'] ? $row['total_data_policy'] : 0 );
 $tot_data_insured = ( $row['tot_data_insured'] ? $row['tot_data_insured'] : 0 );
 $tot_data_premi  = ( $row['tot_data_premi'] ? $row['tot_data_premi'] : 0 );
 $tot_data_premi_anp = ( $row['tot_data_premi_anp'] ? $row['tot_data_premi_anp'] : 0 );
 
 $tot_format_data_premi = _getCurrency($tot_data_premi);
 $tot_format_data_premi_anp  = _getCurrency($tot_data_premi_anp);
 
 
 $tot_new_assigned_data = ( $row['tot_new_assigned'] ? $row['tot_new_assigned']: 0);
 $tot_re_assigned_data = ( $row['tot_re_assigned'] ? $row['tot_re_assigned'] : 0 );
 $tot_solicited_new_assign = ( $row['data_new_utilize'] ? $row['data_new_utilize'] : 0 );
 $tot_solicited_re_utilized = ( $row['data_old_utilize'] ? $row['data_old_utilize'] : 0 );
 $tot_data_utilize = ( $row['data_all_solicited'] ? $row['data_all_solicited'] : 0 );
 $tot_data_sort_new_db = (  $tot_new_assigned_data ? ( $tot_new_assigned_data-$tot_solicited_new_assign) : 0 );
 
 
// --------- atempt  ----------------------
 $tot_data_format_talk_time = _getDuration($tot_data_talk_time);
 $tot_data_followup  = ($status_401+$status_402);
 $tot_data_atempt = ( $row['tot_data_atempt'] ? $row['tot_data_atempt'] : 0 );
 
 $avg_data_atempt = ( $tot_data_atempt ? number_format(($tot_data_atempt/ $tot_data_utilize),1) : 0 );
 $avg_response_rate = ( $tot_data_utilize ? _setPercent(($tot_data_policy/$tot_data_utilize)): 0 );
 $avg_sales_closing = ( $tot_contacted_y ? _setPercent(($tot_data_policy/$tot_contacted_y)) : 0 );
 $avg_data_followup  = _setPercent(( $tot_contacted_y ? ($tot_data_followup/$tot_contacted_y) : 0));
 
 $avg_data_persentation  = ( ($tot_contacted_y) ? _setPercent(($tot_data_persentation/$tot_contacted_y)): 0);
 $avg_data_nos_rate = ( $tot_data_policy ? _setPercent( (($tot_data_insured-$tot_data_policy)/$tot_data_policy)) : 0);
 $avg_data_contacted_rate  = ( $tot_data_utilize ? ( $tot_contacted_y/$tot_data_utilize) : "" );
 $avg_data_format_contacted_rate  = _setPercent( $avg_data_contacted_rate);
 $avg_data_bad_list = ( $tot_data_utilize ? _setPercent(($tot_data_bad_list/$tot_data_utilize)): 0);
 $avg_data_connect_rate  = ( $tot_data_utilize ? _setPercent( $tot_data_connected_y/$tot_data_utilize): 0 );
 
// --- avg talktime / hour 
 
 $avg_data_talk_time_hours = ( $tot_data_work_hours ? ($tot_data_talk_time/($tot_data_work_hours/const_hours() ) ): 0 );
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
 
 
 // ----------------- productivity --------------------------
 $avg_data_productivity_atempt_per_tmr = ( ($tot_data_user_login) ? ($tot_data_atempt/$tot_data_user_login/$tot_data_work_days) : 0); 
 $avg_data_format_productivity_atempt_per_tmr = _setRound( $avg_data_productivity_atempt_per_tmr, 2);
 
 // ----------------- productivity --------------------------
 $avg_data_productivity_premi_per_policy_per_year = ( $tot_data_policy ? (($tot_data_premi/$tot_data_policy)) : 0);
 $avg_data_format_productivity_premi_per_policy_per_year = _getCurrency($avg_data_productivity_premi_per_policy_per_year);
 $avg_data_persentation_rate  = ( $tot_data_policy ? _setPercent($tot_data_policy/ $tot_data_persentation) : 0);
 $avg_data_reject_upfront_rate = _setPercent( ( $tot_contacted_y ? ( $status_701 /$tot_contacted_y ) : 0 ));
 
 
// ====================================== 
 $obInst = new EUI_Object( $obUsers->_getUserDetail( $ManagerId ));
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
		  <td align='right'>{$status_101}</td>
		  <td align='right'>{$status_102}</td>
		  <td align='right'>{$status_103}</td>
		  <td align='right'>{$avg_data_connect_rate}</td>
		  <td align='right'>{$tot_contacted_y}</td>
		  <td align='right'>{$status_201}</td>
		  <td align='right'>{$status_202}</td>
		  <td align='right'>{$status_203}</td>
		  <td align='right'>{$status_204}</td>
		  <td align='right'>{$status_205}</td>
		  <td align='right'>{$status_206}</td>
		  <td align='right'>{$status_207}</td>
		  <td align='right'>{$status_208}</td>
		  <td align='right'>{$status_209}</td>
		  <td align='right'>{$status_210}</td>
		  <td align='right'>{$status_211}</td>
		  <td align='right'>{$avg_data_format_contacted_rate}</td>
		  <td align='right'>{$tot_data_persentation}</td>
		  <td align='right'>{$avg_data_persentation}</td>
		  <td align='right'>{$status_601}</td>
		  <td align='right'>{$status_602}</td>
		  <td align='right'>{$status_603}</td>
		  <td align='right'>{$status_301}</td>
		  <td align='right'>{$status_302}</td>
		  <td align='right'>{$status_303}</td>
		  <td align='right'>{$status_304}</td>
		  <td align='right'>{$status_305}</td>
		  <td align='right'>{$status_306}</td>
		  <td align='right'>{$status_307}</td>
		  <td align='right'>{$status_308}</td>
		  <td align='right'>{$status_309}</td>
		  <td align='right'>{$status_310}</td>
		  <td align='right'>{$status_311}</td>
		  <td align='right'>{$status_312}</td>
		  <td align='right'>{$status_313}</td>
		  <td align='right'>{$status_314}</td>
		  <td align='right'>{$status_315}</td>
		  <td align='right'>{$status_316}</td>
		  <td align='right'>{$status_317}</td>
		  <td align='right'>{$status_318}</td>
		  <td align='right'>{$status_701}</td>
		  <td align='right'>{$avg_data_reject_upfront_rate}</td>
		  <td align='right'>{$status_401}</td>
		  <td align='right'>{$status_402}</td>
		  <td align='right'>{$avg_data_followup}</td>
		  <td align='right'>{$tot_data_policy}</td>
		  <td align='right'>{$tot_data_insured}</td>
		  <td align='right'>{$tot_format_data_premi}</td>
		  <td align='right'>{$tot_format_data_premi_anp}</td>";
		  
		    if( is_array($arr_product) ) 
			foreach( $arr_product as $ProductId => $ProductName ) 
		 {
			$tot_pif_per_product 	= ( $row[$ProductId]['tot_policy_per_product'] ? $row[$ProductId]['tot_policy_per_product'] : 0);
			$tot_nos_per_product 	= ( $row[$ProductId]['tot_nos_per_product'] ? $row[$ProductId]['tot_nos_per_product'] : 0);
			$tot_premi_per_product 	= ( $row[$ProductId]['tot_premi_per_product'] ? $row[$ProductId]['tot_premi_per_product'] : 0 );
			$tot_anp_per_product 	= ( $row[$ProductId]['tot_premi_anp_per_product']?$row[$ProductId]['tot_premi_anp_per_product'] : 0 );
			
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
	 
	 $sum_tot_status_201+= $status_201;
	 $sum_tot_status_202+= $status_202;
	 $sum_tot_status_203+= $status_203;
	 $sum_tot_status_204+= $status_204;
	 $sum_tot_status_205+= $status_205;
	 $sum_tot_status_206+= $status_206;
	 $sum_tot_status_207+= $status_207;
	 $sum_tot_status_208+= $status_208;
	 $sum_tot_status_209+= $status_209;
	 $sum_tot_status_210+= $status_210;
	 $sum_tot_status_211+= $status_211;
	 $sum_tot_status_601+= $status_601;
	 $sum_tot_status_602+= $status_602;
	 $sum_tot_status_603+= $status_603;
	 $sum_tot_status_101+= $status_101;
	 $sum_tot_status_102+= $status_102;
	 $sum_tot_status_103+= $status_103;
	 $sum_tot_status_301+= $status_301;
	 $sum_tot_status_302+= $status_302;
	 $sum_tot_status_303+= $status_303;
	 $sum_tot_status_304+= $status_304;
	 $sum_tot_status_305+= $status_305;
	 $sum_tot_status_306+= $status_306;
	 $sum_tot_status_307+= $status_307;
	 $sum_tot_status_308+= $status_308;
	 $sum_tot_status_309+= $status_309;
	 $sum_tot_status_310+= $status_310;
	 $sum_tot_status_311+= $status_311;
	 $sum_tot_status_312+= $status_312;
	 $sum_tot_status_313+= $status_313;
	 $sum_tot_status_314+= $status_314;
	 $sum_tot_status_315+= $status_315;
	 $sum_tot_status_316+= $status_316;
	 $sum_tot_status_317+= $status_317;
	 $sum_tot_status_318+= $status_318;
	 $sum_tot_status_401+= $status_401; 
	 $sum_tot_status_402+= $status_402;
	 $sum_tot_status_701+= $status_701;
	 
	// --------------- summary of Unpersent ---------------------------------------
	 $sum_tot_persentation+=$tot_data_persentation;
	 
	 
	 // --------------- summary of followup & ---------------------------------------

	
	 $sum_tot_acv_pif	+= $tot_data_policy;
	 $sum_tot_acv_nos	+= $tot_data_insured;
	 $sum_tot_acv_premi	+= $tot_data_premi;
	
	 $sum_tot_talk_time	+= $tot_data_talk_time;
	 $sum_tot_bad_list 	+= $tot_data_bad_list;
	 $sum_data_followup += $tot_data_followup; 
	 
	 $sum_tot_data_persentation += $tot_data_persentation;
	 $sum_tot_data_user_login += $tot_data_user_login;
	 $sum_tot_acv_premi_anp	+= $tot_data_premi_anp;
	  
}
 
 
 $sum_tot_tmr_login = $sum_tot_data_user_login;
 $sum_tot_work_days = $tot_data_work_days;
 $sum_tot_work_hours = $tot_data_work_hours;
 
 $sum_tot_contacted = ($sum_tot_persentation+$sum_tot_status_701);
 $sum_tot_attempt_ratio = ($sum_tot_solicited_per_utilize  ? ($sum_tot_attempt_call/ $sum_tot_solicited_per_utilize) : 0 );
 $sum_tot_connect_rate  = ($sum_tot_solicited_per_utilize ? ($sum_tot_connected_yes/ $sum_tot_solicited_per_utilize) : 0 );
 $sum_tot_contacted_rate = ($sum_tot_solicited_per_utilize ? ($sum_tot_contacted/ $sum_tot_solicited_per_utilize) : 0 );
 $sum_tot_sale_closing_rate = ($sum_tot_contacted ? ($sum_tot_acv_pif/$sum_tot_contacted) : 0 );
 $sum_tot_response_rate = ($sum_tot_solicited_per_utilize ? ( $sum_tot_acv_pif/$sum_tot_solicited_per_utilize): 0);
 $sum_tot_persentation_rate = ($sum_tot_contacted ? ( $sum_tot_persentation /$sum_tot_contacted ) : 0);
 $sum_tot_nos_rate = (($sum_tot_acv_nos - $sum_tot_acv_pif ) ? ( ( $sum_tot_acv_nos - $sum_tot_acv_pif )/$sum_tot_acv_pif) : 0); 
 $sum_tot_avg_talk_time_per_hour= ( $sum_tot_work_hours ? ($sum_tot_talk_time/($sum_tot_work_hours/const_hours() )): 0 );
 $sum_tot_avg_talk_time_per_tmr= ( $sum_tot_talk_time ? ($sum_tot_talk_time/ $sum_tot_tmr_login) : 0);
 $sum_tot_productivity_per_tmr_pif = (($sum_tot_tmr_login) ? ($sum_tot_acv_pif/$sum_tot_tmr_login/$tot_data_work_days) : 0);
 $sum_tot_productivity_per_tmr_premi = (($sum_tot_tmr_login) ? ($sum_tot_acv_premi/$sum_tot_tmr_login/$tot_data_work_days) : 0);
 
 $sum_tot_avg_atempt_per_tmr = (($sum_tot_tmr_login) ? ($sum_tot_attempt_call/$sum_tot_tmr_login/$tot_data_work_days) : 0); 
 $sum_tot_avg_premi = ( $sum_tot_acv_pif ? ($sum_tot_acv_premi/ $sum_tot_acv_pif) : 0);
 $sum_tot_avg_followup = ( $sum_tot_contacted ? ($sum_data_followup/$sum_tot_contacted) : 0);
 $sum_tot_avg_bad_list = ( $sum_tot_solicited_per_utilize ? ($sum_tot_bad_list/$sum_tot_solicited_per_utilize) : 0);
  
  // --- slaes persentation rate 
 $sum_avg_data_persentation_rate  = ( $sum_tot_acv_pif ? ($sum_tot_acv_pif/ $sum_tot_data_persentation) : 0);
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
 $sum_avg_reject_upfront 				= _setPercent(($sum_tot_contacted ? ($sum_tot_status_701/$sum_tot_contacted): 0));

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
		<td class=\"head\" align=\"right\">{$sum_tot_status_317}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_318}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_701}</td>
		<td class=\"head\" align=\"right\">{$sum_avg_reject_upfront}</td>
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
 
 function _select_campaign_group_per_mgr_detail( $ManagerId =0 )
{
 $UI=& get_instance(); // load db ;
 $cls=& get_class_instance("M_CallTrackingReport");
 $obj=& new EUI_Object( _get_all_request() );
    
 $AtmId = array_keys($cls->_select_report_atm_by_manager($ManagerId));
 $AtmId = ( count($AtmId) == 0 ? array(0) : $AtmId);
 $CampaignId = _select_report_campaign_id();
 
 $arr_product = _select_report_active_product();
 $colspan = (4*count( $arr_product));
 
echo "<table class=\"data\" border=1 style=\"border-collapse: collapse\">
	 <tr>
	  <td class=\"head\" rowspan=3 align=\"center\" style=\"vertical-align:middle;\">MGR</td>
	  <td class=\"head\" colspan=6>DB</td>
	  <td class=\"head\" rowspan=3>Attempted</td>
	  <td class=\"head\" rowspan=3>Attempt Ratio</td>
	  <td class=\"head\" colspan=5>Connected</td>
	  <td class=\"head\" colspan=13>Contacted</td>
	  <td class=\"head\" ></td>
	  <td class=\"head\" align=\"center\" colspan=22>Presentation</td>
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
	  <td class=\"head\" colspan=18>Not Interested</td>
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
	  <td class=\"head\">317</td>
	  <td class=\"head\">318</td>
	  <td class=\"head\">701</td>
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
 
// ------------- dis new DB  -------------------------

 $UI->db->reset_select();
 $UI->db->select("count( distinct a.CustomerId) as tot_new_data,a.AssignSpv as AssignSpv", FALSE);
 $UI->db->from("t_gn_assignment_log a force index(primary)");
 $UI->db->join("t_gn_customer b","a.CustomerId=b.CustomerId", "LEFT OUTER");
 $UI->db->where("a.CallReasonId=99", "", FALSE);
 $UI->db->where_in("b.CampaignId", $CampaignId); 
 $UI->db->where_in("a.AssignAmgr", array_map('intval',  array($ManagerId) ));
 $UI->db->where_in("a.AssignSpv", array_map('intval',  $AtmId ));
 
 $UI->db->where("a.AssignDate>='{$obj->get_value('start_date','StartDate')}'", "", false);
 $UI->db->where("a.AssignDate<='{$obj->get_value('end_date','EndDate')}'", "", false);
 $UI->db->group_by(array("AssignSpv"));
 
 //$UI->db->print_out();
 
 $rs = $UI->db->get();
 if( $rs->num_rows() > 0 ) 
	 foreach( $rs->result_assoc() as $rows ) 
{
	$data[$rows['AssignSpv']]['tot_new_assigned'] += $rows['tot_new_data'];
} 


// ------------- Old  DB  -------------------------

 $UI->db->reset_select();
 $UI->db->select("count( distinct a.CustomerId) as tot_re_assigned,a.AssignSpv as AssignSpv", FALSE);
 $UI->db->from("t_gn_assignment_log a force index(primary)");
 $UI->db->join("t_gn_customer b","a.CustomerId=b.CustomerId", "LEFT OUTER");
 $UI->db->where("a.CallReasonId<>99", "", FALSE);
 $UI->db->where_in("b.CampaignId", $CampaignId); 
 
 $UI->db->where_in("a.AssignAmgr", array_map('intval', array($ManagerId) ));
 $UI->db->where_in("a.AssignSpv", array_map('intval',  $AtmId ));
 
 $UI->db->where("a.AssignDate>='{$obj->get_value('start_date','StartDate')}'", "", false);
 $UI->db->where("a.AssignDate<='{$obj->get_value('end_date','EndDate')}'", "", false);
 $UI->db->group_by(array("AssignSpv"));
 
 //$UI->db->print_out();
  
 $rs = $UI->db->get();
 if( $rs->num_rows() > 0 ) 
	 foreach( $rs->result_assoc() as $rows ) 
{
	$data[$rows['AssignSpv']]['tot_re_assigned'] += $rows['tot_re_assigned'];
} 

 
// ---------- ambil data atemp pertiap Agent Under & spv & atm & MGR --------------
 
 $UI->db->reset_select();
 $UI->db->select("count(a.CallHistoryId) as data_size_atempt,
	d.UserId as AssignSpv", 
FALSE);

 $UI->db->from("t_gn_callhistory a FORCE INDEX(PRIMARY)");
 $UI->db->join("t_gn_customer b","a.CustomerId=b.CustomerId", "LEFT");
 $UI->db->join("tms_agent c ","a.SPVCode = c.id", "LFET");
 $UI->db->join("tms_agent d ","a.ATMCode = d.id", "LFET");
 $UI->db->join("tms_agent e  ","a.AMGRCode = e.id", "LFET");
 
 $UI->db->where_in("b.CampaignId", $CampaignId );
 $UI->db->where("a.HistoryType", 0);
 $UI->db->where("a.CallHistoryCallDate>='{$obj->get_value('start_date','StartDate')}'", "", false);
 $UI->db->where("a.CallHistoryCallDate<='{$obj->get_value('end_date','EndDate')}'", "", false);
 $UI->db->where_in("e.UserId", array_map('intval', array($ManagerId) ));
 $UI->db->where_in("d.UserId", array_map('intval', $AtmId ));
 $UI->db->group_by(array("AssignSpv"));
 
 // echo $UI->db->print_out();
 
 $rs = $UI->db->get();
  if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows ) 
 {
	$data[$rows['AssignSpv']]['tot_data_atempt'] +=$rows['data_size_atempt'];
 }
 
// --- load status in history Hight db -----------------------------
 $UI->db->reset_select();
 $UI->db->select(" 
	1 as total_size,
	d.UserId as AssignSpv,
	
	(SELECT 
		IF(tcs.CallBeforeReasonId IN(99),1,0) as NewUtilize
	 FROM t_gn_callhistory tcs 
	 WHERE tcs.HistoryType = 0
	 AND tcs.CallHistoryId= MAX(a.CallHistoryId)
	 AND tcs.CallHistoryCallDate>='{$obj->get_value('start_date','StartDate')}'
	 AND tcs.CallHistoryCallDate<='{$obj->get_value('end_date','EndDate')}'
     AND tcs.AMGRCode=e.id 	
	 AND tcs.ATMCode=d.id 
	) as tot_new_utilize,
	
	(SELECT 
		IF(tcs.CallBeforeReasonId NOT IN(99),1,0) as OldUtilize
		FROM t_gn_callhistory tcs where tcs.HistoryType = 0
		AND tcs.CallHistoryId= MAX(a.CallHistoryId)
		AND tcs.CallHistoryCallDate>='{$obj->get_value('start_date','StartDate')}'
		AND tcs.CallHistoryCallDate<='{$obj->get_value('end_date','EndDate')}'
		AND tcs.AMGRCode=e.id 	
		AND tcs.ATMCode=d.id 
	) as tot_old_utilize,	
	
	(  select cgs.CallReasonCode
	   from t_gn_callhistory tgs 
	   inner join t_lk_callreason cgs on tgs.CallReasonId = cgs.CallReasonId
	   where tgs.CallHistoryId= MAX(a.CallHistoryId)
	   and tgs.HistoryType = 0
	   and tgs.ATMCode=d.id
	   and tgs.AMGRCode=e.id ) as CallreasonIdCode", FALSE);
	
	
 $UI->db->from("t_gn_callhistory a FORCE INDEX(PRIMARY)");
 $UI->db->join("t_gn_customer b","a.CustomerId=b.CustomerId","INNER JOIN");
 $UI->db->join("tms_agent c ","a.SPVCode = c.id", "LFET");
 $UI->db->join("tms_agent d ","a.ATMCode = d.id", "LFET");
 $UI->db->join("tms_agent e  ","a.AMGRCode = e.id", "LFET");
 
 $UI->db->where_in("b.CampaignId", $CampaignId );
 $UI->db->where("a.HistoryType", 0);
 $UI->db->where("a.CallHistoryCallDate>='{$obj->get_value('start_date','StartDate')}'", "", false);
 $UI->db->where("a.CallHistoryCallDate<='{$obj->get_value('end_date','EndDate')}'", "", false);
 $UI->db->where_in("e.UserId", array_map('intval', array($ManagerId)));
 $UI->db->where_in("d.UserId", array_map('intval', $AtmId ));
 
 $UI->db->group_by(array("AssignSpv","a.CustomerId"));
 //echo $UI->db->print_out();

 
 $rs = $UI->db->get();
 if( $rs->num_rows() > 0 ) 
	 foreach( $rs->result_assoc() as $rows ) 
{
	$data[$rows['AssignSpv']]['data_all_solicited'] += $rows['total_size'];
	$data[$rows['AssignSpv']]['data_old_utilize'] += $rows['tot_old_utilize'];
	$data[$rows['AssignSpv']]['data_new_utilize'] += $rows['tot_new_utilize'];
	$data[$rows['AssignSpv']]['tot_data_status_101'] += ( in_array($rows['CallreasonIdCode'],array('101')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_102'] += ( in_array($rows['CallreasonIdCode'],array('102')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_103'] += ( in_array($rows['CallreasonIdCode'],array('103')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_201'] += ( in_array($rows['CallreasonIdCode'],array('201')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_202'] += ( in_array($rows['CallreasonIdCode'],array('202')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_203'] += ( in_array($rows['CallreasonIdCode'],array('203')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_204'] += ( in_array($rows['CallreasonIdCode'],array('204')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_205'] += ( in_array($rows['CallreasonIdCode'],array('205')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_206'] += ( in_array($rows['CallreasonIdCode'],array('206')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_207'] += ( in_array($rows['CallreasonIdCode'],array('207')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_208'] += ( in_array($rows['CallreasonIdCode'],array('208')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_209'] += ( in_array($rows['CallreasonIdCode'],array('209')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_210'] += ( in_array($rows['CallreasonIdCode'],array('210')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_211'] += ( in_array($rows['CallreasonIdCode'],array('211')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_301'] += ( in_array($rows['CallreasonIdCode'],array('301')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_302'] += ( in_array($rows['CallreasonIdCode'],array('302')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_303'] += ( in_array($rows['CallreasonIdCode'],array('303')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_304'] += ( in_array($rows['CallreasonIdCode'],array('304')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_305'] += ( in_array($rows['CallreasonIdCode'],array('305')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_306'] += ( in_array($rows['CallreasonIdCode'],array('306')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_307'] += ( in_array($rows['CallreasonIdCode'],array('307')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_308'] += ( in_array($rows['CallreasonIdCode'],array('308')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_309'] += ( in_array($rows['CallreasonIdCode'],array('309')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_310'] += ( in_array($rows['CallreasonIdCode'],array('310')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_311'] += ( in_array($rows['CallreasonIdCode'],array('311')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_312'] += ( in_array($rows['CallreasonIdCode'],array('312')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_313'] += ( in_array($rows['CallreasonIdCode'],array('313')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_314'] += ( in_array($rows['CallreasonIdCode'],array('314')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_315'] += ( in_array($rows['CallreasonIdCode'],array('315')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_316'] += ( in_array($rows['CallreasonIdCode'],array('316')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_317'] += ( in_array($rows['CallreasonIdCode'],array('317')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_318'] += ( in_array($rows['CallreasonIdCode'],array('318')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_401'] += ( in_array($rows['CallreasonIdCode'],array('401')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_402'] += ( in_array($rows['CallreasonIdCode'],array('402')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_601'] += ( in_array($rows['CallreasonIdCode'],array('601')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_602'] += ( in_array($rows['CallreasonIdCode'],array('602')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_603'] += ( in_array($rows['CallreasonIdCode'],array('603')) ? $rows['total_size'] : 0 );
	$data[$rows['AssignSpv']]['tot_data_status_701'] += ( in_array($rows['CallreasonIdCode'],array('701')) ? $rows['total_size'] : 0 );
	
}
	
 // ---------- get data talktime --------------
  
  $UI->db->reset_select();
  $UI->db->select("c.AssignSpv as AssignSpv, SUM(a.duration) as tot_talk_time ", FALSE);
  $UI->db->from("cc_recording a");
  $UI->db->join("t_gn_customer b "," a.assignment_data=b.CustomerId", "LEFT");
  $UI->db->join("t_gn_assignment c "," b.CustomerId=c.CustomerId","LEFT");
	
  $UI->db->where_in("b.CampaignId", $CampaignId); 
  $UI->db->where("a.start_time>='{$obj->get_value('start_date','StartDate')}'", "", false);
  $UI->db->where("a.start_time<='{$obj->get_value('end_date','EndDate')}'", "", false);
  
  $UI->db->where_in("c.AssignAmgr", array_map('intval', array($ManagerId) ));
  $UI->db->where_in("c.AssignSpv", $AtmId );
  $UI->db->group_by(array("AssignSpv"));
  
 // $UI->db->print_out();
 
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
 
 $UI->db->where_in("d.CampaignId", $CampaignId); 
 $UI->db->where_in("e.AssignSpv", array_map("intval", $AtmId));
 $UI->db->where_in("e.AssignAmgr", array_map('intval', array($ManagerId)));
 
 $UI->db->where("a.PolicySalesDate>='{$obj->get_value('start_date','StartDate')}'", "", false);
 $UI->db->where("a.PolicySalesDate<='{$obj->get_value('end_date','EndDate')}'", "", false);
 $UI->db->group_by(array("AssignSpv","ProductId"));
//echo  $UI->db->print_out();

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
	
  $UI->db->from("t_gn_policy a FORCE INDEX(PRIMARY)");
  $UI->db->join("t_gn_policyautogen b ","a.PolicyNumber=b.PolicyNumber", "LEFT");
  $UI->db->join("t_gn_customer c ","b.CustomerId=c.CustomerId", "LEFT");
  $UI->db->join("t_gn_productplan d ","a.ProductPlanId=d.ProductPlanId", "LEFT");
  $UI->db->join("t_gn_assignment e ","b.CustomerId=e.CustomerId", "LEFT");
  $UI->db->where_in("c.CampaignId", $CampaignId); 
  $UI->db->where_in("e.AssignSpv", array_map("intval", $AtmId));
  $UI->db->where_in("e.AssignAmgr", array_map('intval', array($ManagerId)));
  
  $UI->db->where("a.PolicySalesDate>='{$obj->get_value('start_date','StartDate')}'", "", false);
  $UI->db->where("a.PolicySalesDate<='{$obj->get_value('end_date','EndDate')}'", "", false);
  $UI->db->group_by(array("PolicyNumber","AssignSpv"));
 // $UI->db->print_out();
  
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
 $UI->db->select("count(distinct a.ActivityUserId) as tot_user_tmr, a.ActivityUserId,b.spv_id as AssignSpv", FALSE);
 $UI->db->from("t_gn_activitylog a force index(primary) ");
 $UI->db->join("tms_agent b ","a.ActivityUserId=b.UserId", "LEFT");
 $UI->db->where("a.ActivityDate>='{$obj->get_value('start_date','StartDate')}'", "", FALSE);
 $UI->db->where("a.ActivityDate<='{$obj->get_value('end_date','EndDate')}'", "", FALSE);
 $UI->db->where_in("b.handling_type",array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));
 $UI->db->where_in("b.spv_id",array_map('intval', $AtmId));
 $UI->db->group_by("a.ActivityUserId");
 
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
 $UI->db->from("t_gn_activitylog a force index(primary) ");
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
 $UI->db->select(" a.ActivityUserId as UserId, date(a.ActivityDate) as tgl, b.spv_id as AssignSpv",FALSE);
 $UI->db->from("t_gn_activitylog a force index(primary) ");	
 $UI->db->join("tms_agent b","a.ActivityUserId = b.UserId", "LEFT");
 $UI->db->where("a.ActivityDate>='{$obj->get_value('start_date','StartDate')}'", "", FALSE);
 $UI->db->where("a.ActivityDate<='{$obj->get_value('end_date','EndDate')}'", "", FALSE);
 $UI->db->where_in("b.handling_type",array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));
 $UI->db->where_in("b.spv_id",array_map('intval', $AtmId));
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
 
// ------ get attribute data user tmr  ----------------------------------
 
 $tot_data_work_days  = ( $data['data_tot_day_work'] ? $data['data_tot_day_work'] : 0);
 $tot_data_talk_hour = 0;
 
 
// --------------- loop --------------------------------
 
 if(is_array($AtmId ) ) 
	 foreach($AtmId  as $key => $AssignSpvId )
{
	
// --------- index ----------------------- 
 $AgentName  = $rows['full_name'];
 $AgentId = $rows['UserId'];
 
// --------- get datat DB ---

 $call_data_content = $data[$AssignSpvId];

// ------------- total data talk time -----

 $tot_data_talk_time =($call_data_content['data_tot_talk_time']? $call_data_content['data_tot_talk_time'] : 0 ); 
 $tot_data_work_hours = ( $call_data_content['data_tot_hour_work'] ? $call_data_content['data_tot_hour_work'] : 0);
 $tot_data_user_login = ( $call_data_content['data_tot_user_login'] ? $call_data_content['data_tot_user_login'] : 0);
 $tot_data_format_hours = _getDuration($tot_data_work_hours);
 
 
 
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
 
 // --- total perensttion ----
 
 $tot_data_persentation = ( $tot_data_interest_601+
							$tot_data_interest_602+
							$tot_data_interest_603+	
							$tot_data_not_interest_301+ 
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
							$tot_data_call_status_402);
 
 $tot_contacted_y = ( $tot_data_persentation + $tot_data_call_status_701);
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
						   $tot_data_persentation); 
 
  
 $tot_connected_call = 	$tot_data_connected_y+$tot_data_connected_n101+$tot_data_connected_n102+$tot_data_connected_n103;
 
	
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
 $tot_solicited_re_utilized  = ( $call_data_content['data_old_utilize'] ? $call_data_content['data_old_utilize'] : 0 );
 $tot_data_utilize = ( $call_data_content['data_all_solicited'] ? $call_data_content['data_all_solicited'] : 0 );
// ------------------ solicited ----------------------------------------------------	

 
 $tot_data_sort_new_db = (  $tot_new_assigned_data ? ( $tot_new_assigned_data-$tot_solicited_new_assign) : 0 );
 $tot_data_atempt = ( $call_data_content['tot_data_atempt'] ? $call_data_content['tot_data_atempt'] : 0 );
 
  $tot_data_followup  = ($tot_data_call_status_401+$tot_data_call_status_402);
  $tot_data_bad_list  = ( $tot_data_connected_n101+ 
						 $tot_data_connected_n102+ 
						 $tot_data_connected_n103+
						 $tot_data_connected_y204+
						 $tot_data_connected_y209+
						 $tot_data_connected_y211);
						 
 // -- avg coneected rate ----------
 $avg_data_connect_rate  = ( $tot_data_connected_y ? _setPercent( $tot_data_connected_y/$tot_data_utilize): 0 );
 $avg_data_atempt = ( $tot_data_atempt ? number_format(($tot_data_atempt/ $tot_data_utilize),1) : 0 );
 
							
// --------------- response rate --------------------------
 $avg_response_rate = ( $tot_data_utilize ? _setPercent(($tot_data_policy/$tot_data_utilize)): 0 );
 $avg_sales_closing = ( $tot_contacted_y ? _setPercent(($tot_data_policy/$tot_contacted_y)) : 0 );
 
// total followup 

 
  $avg_data_followup  = ( $tot_contacted_y ? _setPercent(($tot_data_followup/$tot_contacted_y)) : 0);
  
// --- Persentation Rate 
 $avg_data_persentation  = ( ($tot_contacted_y) ? _setPercent(($tot_data_persentation/$tot_contacted_y)): 0);
 $avg_data_nos_rate = ( $tot_data_policy ? _setPercent( (($tot_data_insured-$tot_data_policy)/$tot_data_policy)) : 0);
 $avg_data_contacted_rate  = ( $tot_data_utilize ? ( $tot_contacted_y/$tot_data_utilize) : "" );
 $avg_data_format_contacted_rate  = _setPercent( $avg_data_contacted_rate);
 
// --- total data badlist ----------------------

						 
 $avg_data_bad_list = ( $tot_data_utilize ? _setPercent(($tot_data_bad_list/$tot_data_utilize)): 0);
 
// --- avg talktime / hour 
 $tot_data_format_talk_time = _getDuration($tot_data_talk_time);
 $avg_data_talk_time_hours = ( $tot_data_work_hours ? ($tot_data_talk_time/ ($tot_data_work_hours/const_hours()) ): 0 );

 // var_dump($avg_data_talk_time_hours);

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
 
 
 // ----------------- productivity --------------------------
 
 $avg_data_productivity_atempt_per_tmr = ( ($tot_data_user_login) ? ($tot_data_atempt/$tot_data_user_login/$tot_data_work_days) : 0); 
 $avg_data_format_productivity_atempt_per_tmr = _setRound( $avg_data_productivity_atempt_per_tmr, 2);
 
 // ----------------- productivity --------------------------
 
 $avg_data_productivity_premi_per_policy_per_year = ( $tot_data_policy ? (($tot_data_premi/$tot_data_policy)) : 0);
 $avg_data_format_productivity_premi_per_policy_per_year = _getCurrency($avg_data_productivity_premi_per_policy_per_year);
 
 // --- slaes persentation rate 
 $avg_data_persentation_rate  = ( $tot_data_policy ? _setPercent($tot_data_policy/ $tot_data_persentation) : 0);
 $avg_data_reject_upfront_rate  = _setPercent( ( $tot_contacted_y ? ($tot_data_call_status_701/$tot_contacted_y) : 0));
 
 
 
// ====================================== 
 $obInst = new EUI_Object( $obUsers->_getUserDetail( $AssignSpvId ));
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
		  <td align='right'>{$tot_data_not_interest_317}</td>
		  <td align='right'>{$tot_data_call_status_318}</td>
		  <td align='right'>{$tot_data_call_status_701}</td>
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
	 
	
	 
}
 
 
 $sum_tot_tmr_login = $sum_tot_data_user_login;
 $sum_tot_work_days = $tot_data_work_days;
 $sum_tot_work_hours = $sum_tot_data_work_hours;
 
 $sum_tot_contacted = ($sum_tot_persentation+$sum_tot_status_701);
 $sum_tot_attempt_ratio = ($sum_tot_solicited_per_utilize  ? ($sum_tot_attempt_call/ $sum_tot_solicited_per_utilize) : 0 );
 $sum_tot_connect_rate  = ($sum_tot_solicited_per_utilize ? ($sum_tot_connected_yes/ $sum_tot_solicited_per_utilize) : 0 );
 $sum_tot_contacted_rate = ($sum_tot_solicited_per_utilize ? ($sum_tot_contacted/ $sum_tot_solicited_per_utilize) : 0 );
 $sum_tot_sale_closing_rate = ($sum_tot_contacted ? ($sum_tot_acv_pif/$sum_tot_contacted) : 0 );
 $sum_tot_response_rate = ($sum_tot_solicited_per_utilize ? ( $sum_tot_acv_pif/$sum_tot_solicited_per_utilize): 0);
 $sum_tot_persentation_rate = ($sum_tot_contacted ? ( $sum_tot_persentation /$sum_tot_contacted ) : 0);
 $sum_tot_nos_rate = (($sum_tot_acv_nos - $sum_tot_acv_pif ) ? ( ( $sum_tot_acv_nos - $sum_tot_acv_pif )/$sum_tot_acv_pif) : 0); 
 $sum_tot_avg_talk_time_per_hour= ( $sum_tot_work_hours ? ($sum_tot_talk_time/ ( $sum_tot_work_hours/ const_hours() ) ): 0 );
 $sum_tot_avg_talk_time_per_tmr= ( $sum_tot_tmr_login ? ($sum_tot_talk_time/ $sum_tot_tmr_login) : 0);
 $sum_tot_productivity_per_tmr_pif = (($sum_tot_tmr_login) ? ($sum_tot_acv_pif/$sum_tot_tmr_login/$tot_data_work_days) : 0);
 $sum_tot_productivity_per_tmr_premi = (($sum_tot_tmr_login) ? ($sum_tot_acv_premi/$sum_tot_tmr_login/$tot_data_work_days) : 0);
 
 $sum_tot_avg_atempt_per_tmr = (($sum_tot_tmr_login) ? ($sum_tot_attempt_call/$sum_tot_tmr_login/$tot_data_work_days) : 0); 
 $sum_tot_avg_premi = ( $sum_tot_acv_pif ? ($sum_tot_acv_premi/ $sum_tot_acv_pif) : 0);
 $sum_tot_avg_followup = ( $sum_tot_contacted ? ($sum_data_followup/$sum_tot_contacted) : 0);
 $sum_tot_avg_bad_list = ( $sum_tot_solicited_per_utilize ? ($sum_tot_bad_list/$sum_tot_solicited_per_utilize) : 0);
  
  // --- slaes persentation rate 
 $sum_avg_data_persentation_rate  = ( $sum_tot_acv_pif ? ($sum_tot_acv_pif/ $sum_tot_data_persentation) : 0);
 $sum_avg_data_productivity_anp_per_tmr = ( ($sum_tot_tmr_login) ? ( $sum_tot_acv_premi_anp/$sum_tot_tmr_login/$tot_data_work_days ) : 0);
 $sum_avg_data_reject_upfront_rate  = _setPercent( ( $sum_tot_status_701 ? ($sum_tot_status_701/$sum_tot_contacted) : 0));
 

 
 
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
		<td class=\"head\" align=\"right\">{$sum_tot_status_317}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_318}</td>
		<td class=\"head\" align=\"right\">{$sum_tot_status_701}</td>
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
 

 function _select_campaign_group_mgr_detail()
{
 $vars = new EUI_Object(_get_all_request() );
 $class =& get_class_instance('M_SysUser');
 
 if( count($vars) ) 
	foreach( $vars->get_array_value('ManagerId') as $k => $gManagerId )
 {
	$Instance = new EUI_Object( $class->_getUserDetail( $gManagerId ));
	echo "<h4>{$Instance->get_value('Username')}</h4><hr size=1>"; 
	_select_campaign_group_per_mgr_detail( $gManagerId );
	
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
		_select_campaign_group_mgr_summary();		
	}
	
	
	if( _get_post('interval') =='detail' ){
		_select_campaign_group_mgr_detail();		
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
		 "<p class=\"normal font-size22\">Report Call Tracking - Campaign Group By MGR</p>".
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
	<?php showheaders(); ?>
	<?php showReport(); ?>
	<?php showInformation(); ?>
</body>
</html>
