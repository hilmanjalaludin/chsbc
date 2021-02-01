<?php 


 global $skip_status, $gReportSession, $gField, $gValue;
 $skip_status  = array('319');
 $gReportSession = "";
 $gField = null;
 $gValue = null;

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

if( !function_exists('_export_call_tmp') ) 
{
  function _export_call_tmp() 
 {
	$CI =& get_instance();  
	$out = _find_all_object_request();
	
	
// --------- start var date time 	--------------------------

	$start_date = $out->get_value('start_date', '_getDateEnglish');
	$end_date = $out->get_value('end_date', '_getDateEnglish');
	
	$sql = "SELECT 
			date_format(a.start_time, '%Y-%m-%d') as start_date,
			a.agent as agent_id,
			b.name as agent_name,
			SUM(IF(a.`status` IN(0), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_logout,
			SUM(IF(a.`status` IN(1), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_ready,
			SUM(IF(a.`status` IN(2), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_not_ready,
			SUM(IF(a.`status` IN(4), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_busy,
			SUM(IF(a.`status` IN(3), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_acw,
			
			SUM(IF((a.`status` IN(3) and a.reason IN(1)), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_reason_tipe_1,
			SUM(IF((a.`status` IN(3) and a.reason IN(2)), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_reason_tipe_2,
			SUM(IF((a.`status` IN(3) and a.reason IN(3)), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_reason_tipe_3,
			SUM(IF((a.`status` IN(3) and a.reason IN(4)), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_reason_tipe_4,
			SUM(IF((a.`status` IN(3) and a.reason IN(5)), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_reason_tipe_5,
			SUM(IF((a.`status` IN(3) and a.reason IN(6)), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_reason_tipe_6
		from cc_agent_activity_log a, cc_agent b 
		where a.agent=b.id
		and a.start_time>='$start_date 00:00:00'
		and a.start_time<='$end_date 23:59:59'
		group by start_date, agent_id ";
		
	//echo $sql;	
	$qry = $CI->db->query($sql);
	if( $qry->num_rows() > 0 ) 
		foreach( $qry->result_assoc() as $rows )
	{
		$row = Objective( $rows );
		
		$CI->db->set('start_date', $row->get_value('start_date') );
		$CI->db->set('agent_id', $row->get_value('agent_id') );
		$CI->db->set('agent_name', $row->get_value('agent_name') );
		$CI->db->set('agent_logout', $row->get_value('agent_logout') );
		$CI->db->set('agent_ready', $row->get_value('agent_ready') );
		$CI->db->set('agent_not_ready', $row->get_value('agent_not_ready') );
		$CI->db->set('agent_busy', $row->get_value('agent_busy') );
		$CI->db->set('agent_acw', $row->get_value('agent_acw') );
		$CI->db->set('agent_reason_tipe_1', $row->get_value('agent_reason_tipe_1') );
		$CI->db->set('agent_reason_tipe_2', $row->get_value('agent_reason_tipe_2') );
		$CI->db->set('agent_reason_tipe_3', $row->get_value('agent_reason_tipe_3') );
		$CI->db->set('agent_reason_tipe_4', $row->get_value('agent_reason_tipe_4') );
		$CI->db->set('agent_reason_tipe_5', $row->get_value('agent_reason_tipe_5') );
		$CI->db->set('agent_reason_tipe_6', $row->get_value('agent_reason_tipe_6') );
		
		
		$CI->db->duplicate('agent_id', $row->get_value('agent_id') );
		$CI->db->duplicate('agent_name', $row->get_value('agent_name') );
		$CI->db->duplicate('agent_logout', $row->get_value('agent_logout') );
		$CI->db->duplicate('agent_ready', $row->get_value('agent_ready') );
		$CI->db->duplicate('agent_not_ready', $row->get_value('agent_not_ready') );
		$CI->db->duplicate('agent_busy', $row->get_value('agent_busy') );
		$CI->db->duplicate('agent_acw', $row->get_value('agent_acw') );
		$CI->db->duplicate('agent_reason_tipe_1', $row->get_value('agent_reason_tipe_1') );
		$CI->db->duplicate('agent_reason_tipe_2', $row->get_value('agent_reason_tipe_2') );
		$CI->db->duplicate('agent_reason_tipe_3', $row->get_value('agent_reason_tipe_3') );
		$CI->db->duplicate('agent_reason_tipe_4', $row->get_value('agent_reason_tipe_4') );
		$CI->db->duplicate('agent_reason_tipe_5', $row->get_value('agent_reason_tipe_5') );
		$CI->db->duplicate('agent_reason_tipe_6', $row->get_value('agent_reason_tipe_6') );
		$CI->db->insert_on_duplicate("t_gn_agent_activity_report");
	}
	// ------------- end test ---------------------------
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
		return "08:30:00";
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
 
 function _select_report_agent_time()
{
	$CI  =& get_instance();
	$Usr = _object_sys_user_value();
	$out  = _find_all_object_request();
	
	
	$arr_var_agentid = _select_report_agent_value();
	$arr_var_agents = $out->get_array_value('TmrId');
	
	
	$arr_val_data = array();
	// ---------- work time && login & logout agent ---------------
	
	$sql = sprintf("select 
			a.start_date,
			b.UserId as agent_id,
			a.agent_name,
			a.agent_logout,
			a.agent_ready,
			a.agent_not_ready,
			a.agent_busy,
			a.agent_acw
			from t_gn_agent_activity_report  a ,  tms_agent b 
			where a.start_date >='%s 00:00:00'
			and a.start_date <='%s 23:59:59'
			and a.agent_id=b.UserId 
			group by a.agent_id, a.start_date ", 
			$out->get_value('start_date', '_getDateEnglish'), 
			$out->get_value('end_date', '_getDateEnglish'));
	
	$qry = $CI->db->query( $sql );
	if( $qry->num_rows() > 0 ) 
		foreach( $qry->result_assoc() as $row ) 
	{
		$arr_val_data[$row['agent_id']][$row['start_date']]['agent_name']	   = $row['agent_name'];
		$arr_val_data[$row['agent_id']][$row['start_date']]['agent_logout']	   = $row['agent_logout'];
		$arr_val_data[$row['agent_id']][$row['start_date']]['agent_ready']	   = $row['agent_ready'];
		$arr_val_data[$row['agent_id']][$row['start_date']]['agent_not_ready'] = $row['agent_not_ready'];
		$arr_val_data[$row['agent_id']][$row['start_date']]['agent_busy']	   = $row['agent_busy'];
		$arr_val_data[$row['agent_id']][$row['start_date']]['agent_acw']	   = $row['agent_acw'];
	}
	
	print("<table class=\"data\" border=1 style=\"border-collapse: collapse\" width=\"80%\" align=\"center\" >
				<tr>
				<td class=\"head\" align=\"center\">Date Time</td> 
				<td class=\"head\" nowrap>Agent Username</td> 
				<td class=\"head\" nowrap>Ready</td> 
				<td class=\"head\" align=\"center\">Not Ready</td> 
				<td class=\"head\" nowrap>Busy</td> 
				<td class=\"head\" align=\"center\">After Call Work</td> 
				<td class=\"head\" align=\"center\">Log Off</td>
				</tr>");
			
// ------------ test data loger --------------
	
	$no = 0;
	
	if( is_array( $arr_var_agents) ) 
		foreach( $arr_var_agents as $key => $AgentId )
	{
		$no++;
		
		$start_date =  $out->get_value('start_date', '_getDateEnglish');
		$end_date = $out->get_value('end_date', '_getDateEnglish');
	
	
		$row_val = _select_row_user( $AgentId ) ;
		if( $no > 1 )
		{
			printf("%s", "<tr>");
				printf("<td class=\"content\" height=\"2\" align=\"center\" colspan=\"7\">%s</td>", ""); 
			printf("%s", "</tr>");
		}
		
		$row_val_date = $arr_val_data[$AgentId]; 	
// --- load data will loop -------------------
	
		while(true)
		{
			$sdates = explode("-", $start_date);
			$estart_date = $sdates[2]."-".$sdates[1]."-".$sdates[0];
			$row_val_data 	 = ( $row_val_date[$start_date] ? $row_val_date[$start_date] : 0);	
			
			
			$agent_name 	 = ( $row_val->get_value('id') ? $row_val->get_value('id') : "");
			$agent_ready	 = ( $row_val_data['agent_ready'] ? $row_val_data['agent_ready']: 0);
			$agent_not_ready = ( $row_val_data['agent_not_ready'] ? $row_val_data['agent_not_ready'] : 0);
			$agent_busy		 = ( $row_val_data['agent_busy'] ? $row_val_data['agent_busy'] : 0 );
			$agent_acw  	 = ( $row_val_data['agent_acw'] ? $row_val_data['agent_acw']: 0);
			$agent_logoff 	 = ( $row_val_data['agent_logout'] ? $row_val_data['agent_logout'] : 0 );
			
			printf("%s", "<tr>");
					printf("<td class=\"content\" align=\"center\">%s</td>", $estart_date); 
					printf("<td class=\"content\" align=\"left\">%s</td>", $row_val->get_value('id') ); 
					printf("<td class=\"content\" align=\"right\">%s</td> ", ( $agent_ready ? _getDuration($agent_ready) : 0));
					printf("<td class=\"content\" align=\"right\">%s</td> ", ( $agent_not_ready ? _getDuration($agent_not_ready) : 0) );
					printf("<td class=\"content\" align=\"right\" nowrap>%s</td> ", ( $agent_busy ? _getDuration($agent_busy) : 0 ));
					printf("<td class=\"content\" align=\"right\">%s</td>", ( $agent_acw ? _getDuration($agent_acw) : 0) ); 
					printf("<td class=\"content\" align=\"right\">%s</td>", ( $agent_logoff ? _getDuration($agent_logoff) : 0) );
					
			printf("%s", "</tr>");
			
			if ($start_date == $end_date) break;
				$start_date = _getNextDate($start_date);
				
		}	
		
		
    }	

	
	printf("%s", "</table><br>");	
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
		_select_report_agent_time();		
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
		"<p class=\"normal font-size22\">Report User Tracking - Summary Time Agent</p>".
		"<p class=\"normal font-size18\">Report Mode : ". _select_interval_report_mode() ."</p>".
		 "<p class=\"normal font-size16\">Periode : ". _get_post("start_date") ." to ". _get_post("end_date") ."</p>".
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
 
 function _select_report_notification() { }	


//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function showInformation() { } 

// =============================================================================

?>


<html>
	<head>
		<title>
			User Tracking - Summary Time Agent
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
div.ui-wdget-title { font-size:14x;margin:5px 100px 5px 10%; }
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
	<?php _export_call_tmp(); ?>
	<?php _showheaders(); ?>
	<?php _showReport(); ?>
	
	
	
	
	
</body>
</html>
