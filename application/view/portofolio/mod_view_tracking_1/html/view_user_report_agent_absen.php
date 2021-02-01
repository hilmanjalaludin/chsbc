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
 
if( !function_exists('_select_row_user') )
{
	function _select_row_user( $UserId = 0 )
	{
		$arr_row_user = array();
		$CI =& get_instance();
		
		$sql = sprintf("select * from tms_agent a where a.UserId='%s'", $UserId);
		$qry = $CI->db->query( $sql );
		if( $qry->num_rows() > 0 ) {
			$arr_row_user = $qry->result_first_assoc();
		}
		
		return Objective( $arr_row_user ); 
	}
}  
//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 if( !function_exists('eval_number') )
{
	function eval_number( $val  ){
		return ( $val  ? $val : 0 );
	} 
}
//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 if( !function_exists('eval_value') )
 {
	function eval_value( $val  ){
		return ( $val  ? $val : "" );
	}
 } 

//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */

if( !function_exists('_PrepareCallData') ) 
{
  function _PrepareCallData() 
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
		//$CI->db->query($sql);	
	}
}


//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */

if( !function_exists('_CleanCallData') ) 
{
 function _CleanCallData() {
	global $gReportSession;
	$CI=& get_instance();
   // $CI->db->query("DELETE FROM t_gn_callhistory_newutil WHERE SessionReport='$gReportSession'");
  }
}	


//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */

if( !function_exists('_default_jam_kerja') )  
{
	function _default_jam_kerja()  {
		return "08:00:00";
	}
}


 //---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 
 if( !function_exists('_select_report_recsource_id') )
{ 
	function _select_report_recsource_id()
 {
	$CI  =& get_instance();
	$obj =& get_class_instance("M_CallTrackingReport");
	$out = _find_all_object_request();
	
	$rec_id = $out->get_array_value('RecsourceId');
	$arr_rec = array_map("strtolower", $rec_id);
	if( in_array("all", $arr_rec) ) {
		return array_values($obj->_select_report_recsource());
	} else{
		return array_values($obj->_select_report_recsource( $rec_id ));
	}
  }
}


/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 
 if( !function_exists('_select_report_recsource_value') )
{ 
	function _select_report_recsource_value()
 {
	$ar_rec = _select_report_recsource_id();
	return join("','", $ar_rec);
  }
}


/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 
 if( !function_exists('_select_report_agent_value') )
{ 
	function _select_report_agent_value()
 {
	$out  = _find_all_object_request();
	return join("','", $out->get_array_value('TmrId'));
  }
}

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 
 if( !function_exists('_select_report_spv_value') )
{ 
	function _select_report_spv_value()
 {
	$out  = _find_all_object_request();
	return join("','", $out->get_array_value('spvId'));
  }
}

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 
 if( !function_exists('_select_report_mgr_value') )
{ 
	function _select_report_mgr_value()
 {
	$out  = _find_all_object_request();
	return join("','", $out->get_array_value('ManagerId'));
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
 
 function _object_sys_user_value() 
{
	$CI  =& get_instance();
	$CI->load->model(array('M_SysUser'));
	return get_class_instance('M_SysUser');
} 

//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 function _select_report_agent_absensi()
{
	$CI  =& get_instance();
	$Usr = _object_sys_user_value();
	$out  = _find_all_object_request();
	
	
	$arr_var_agentid = _select_report_agent_value();
	$arr_var_agents = $out->get_array_value('TmrId');
	$start_date =  $out->get_value('start_date', '_getDateEnglish');
	$end_date = $out->get_value('end_date', '_getDateEnglish');
	
	
	$arr_val_data = array();
	// ---------- work time && login & logout agent ---------------
	$sql = "SELECT 
				DATE_FORMAT(a.ActivityDate, '%Y-%m-%d') AS tgl, 
				CONCAT( DATE_FORMAT(a.ActivityDate, '%Y-%m-%d'),' ',  '"._default_jam_kerja()."') as work_log,
				( select tlog.ActivityDate from t_gn_activitylog tlog 
				  where date(tlog.ActivityDate) =  date(a.ActivityDate)
				  and tlog.ActivityUserId= a.ActivityUserId 
				  and tlog.ActivityEvent= 'ACTION_EVENT_LOGIN'
				  order by tlog.ActivityId ASC LIMIT 1 ) as start_log,
	   
				( select tlog2.ActivityDate from t_gn_activitylog tlog2 
				  where date(tlog2.ActivityDate) =  date(a.ActivityDate)
				  and tlog2.ActivityUserId= a.ActivityUserId 
				  and tlog2.ActivityEvent= 'ACTION_EVENT_LOGOUT'
				  order by tlog2.ActivityId DESC LIMIT 1
				) as end_log,
			
			a.ActivityUserId AS agent_id
			FROM t_gn_activitylog a
			WHERE a.ActivityEvent IN('ACTION_EVENT_LOGIN',  'ACTION_EVENT_LOGOUT')
			AND a.ActivityUserId IN('$arr_var_agentid') 
			AND a.ActivityDate >='$start_date 00:00:00' 
			AND a.ActivityDate <='$end_date 23:59:59'
			GROUP BY tgl, agent_id ";

	
	$qry = $CI->db->query( $sql );
	if( $qry->num_rows() > 0 ) 
		foreach( $qry->result_assoc() as $row ) 
	{
		$arr_val_data[$row['tgl']][$row['agent_id']]['work_log']	= $row['work_log'];
		$arr_val_data[$row['tgl']][$row['agent_id']]['start_log']	= $row['start_log'];
		$arr_val_data[$row['tgl']][$row['agent_id']]['end_log']		= $row['end_log'];
		
	}

	
// --- load data will loop -------------------
	
	while(true)
	{
		$sdates = explode("-", $start_date);
		$estart_date = $sdates[2]."-".$sdates[1]."-".$sdates[0];
			
		
		printf("<div class=\"ui-wdget-title\" > Date Absensi : %s</div>", $estart_date );
		print("<table class=\"data\" border=1 style=\"border-collapse: collapse\" width=\"80%\" align=\"center\" >
			<tr>
				<td class=\"head\" align=\"center\">No</td> 
				<td class=\"head\">TSO Id</td> 
				<td class=\"head\">TSO Name</td> 
				<td class=\"head\" align=\"center\">Jam Masuk Kantor</td> 
				<td class=\"head\" nowrap>Log In</td> 
				<td class=\"head\" align=\"center\">Log Out</td> 
				<td class=\"head\" align=\"center\">Late</td> 
				<td class=\"head\">Leader</td> 
			</tr>");
		
		
	// -------- select row ---------------- */
	
		$arr_val_date = $arr_val_data[$start_date];
		
		$no = 0;
		if( is_array( $arr_var_agents) ) 
			foreach( $arr_var_agents as $key => $AgentId )
		{
			$row_val = _select_row_user( $AgentId ) ;
			$row_spv = Objective( $Usr->_get_detail_user( $row_val->get_value('tl_id')));
			
		// --- this will default  ---------------
		
			$agent_work_log = ( $arr_val_date[$AgentId]['work_log'] ? strtotime( $arr_val_date[$AgentId]['work_log'] ): 0 );
			$agent_login = ( $arr_val_date[$AgentId]['start_log'] ? strtotime( $arr_val_date[$AgentId]['start_log'] ): 0 );
			$agent_logout = ($arr_val_date[$AgentId]['end_log'] ? strtotime( $arr_val_date[$AgentId]['end_log'] ): 0 );
			$agent_late   = ( ( $agent_work_log && $agent_login ) ?  ($agent_login  - $agent_work_log) : 0 );
			
			
			// --- get leader --------
			$LeaderUsername = $row_spv->get_value('Username');
			$LeaderFullname = $row_spv->get_value('full_name');
			
			$no++;
			printf("%s", "<tr>");
				printf("<td class=\"content\" align=\"center\">%s</td>", $no); 
				printf("<td class=\"content\">%s</td>", $row_val->get_value('id')); 
				printf("<td class=\"content\">%s</td> ", $row_val->get_value('full_name'));
				printf("<td class=\"content\" align=\"center\">%s</td> ", ( $agent_work_log ? date('H:i:s', $agent_work_log): "-"));
				printf("<td class=\"content\" align=\"center\" nowrap>%s</td> ", ( $agent_login ? date('H:i:s', $agent_login) : "-") );
				printf("<td class=\"content\" align=\"center\">%s</td>", ( $agent_logout ? date('H:i:s',$agent_logout): "-") ); 
				printf("<td class=\"content\" align=\"center\">%s</td>", ( $agent_late ? _getDuration($agent_late) : "-") );
				printf("<td class=\"content\">%s - %s</td> ", $LeaderUsername, $LeaderFullname);
			printf("%s", "</tr>");
			
		}
		
		printf("%s",  "</table><br>");
		
		if ($start_date == $end_date) break;
			$start_date = _getNextDate($start_date);
			
	}			
	
}

//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 function _select_campaign_group_agent_detail()
{
	exit('<center><h3>Sorry, Report Not Available!</h3></center>');
 }
 
//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 function _showReport()
{
	
	if( _get_post('interval') =='summary' ){
		_select_report_agent_absensi();		
	}
	
	if( _get_post('interval') =='detail' ){
		_select_campaign_group_agent_detail();		
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
	$out = new EUI_Object(_get_all_request() );
	
	$arr_rec = array_map("strtolower", $out->get_array_value('RecsourceId') );
	if( in_array("all", $arr_rec) ) {
		return "All Recsource";
	} 
	else{
		$arr_context = array();
		$arr_campaign = $obj->_select_report_recsource( $arr_rec);
		$arr_vars = $out->get_array_value('RecsourceId');
		
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
 function _showheaders()
{
	print("<div class=\"center\">".
		"<p class=\"normal font-size22\">Report User Tracking - Summary Agent Absensi</p>".
		"<p class=\"normal font-size18\">Report Mode :". _select_interval_report_mode() ."</p>".
		 "<p class=\"normal font-size16\">Periode :". _get_post("start_date") ." to ". _get_post("end_date") ."</p>".
		"<p class=\"normal font-size14\">Print date : ". date('d-m-Y H:i') ."</p>".
	"</div>");
	
	
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
	echo "<table style=\"margin-top:10px;\">
			<tr>
				<td valign=\"top\"> ". _select_report_notes() ."</td>
				<td valign=\"top\"></td>
				<td valign=\"top\"> ". _select_report_notification() ."</td>
			</tr>	
		</table>	";
} 

// =============================================================================

?>


<html>
	<head>
		<title>
			User Tracking - Summary Agent Absensi
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
div.ui-wdget-title { font-size:14px; font-weight:normal; margin:5px 100px 5px 10%; }
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
	vertical-align: middle;
}
table.data th {
	background-color: 3565AF;
	color: white;
	font-weight: normal;
	vertical-align: middle;
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
	
	<?php _showheaders(); ?> 
	<?php _showReport(); ?>
	
	
</body>
</html>
