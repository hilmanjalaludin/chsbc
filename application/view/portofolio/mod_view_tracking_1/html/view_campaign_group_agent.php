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


if( !function_exists('const_hours') )  {
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
 
 function _select_campaign_group_agent_summary()
{
	$CI  =& get_instance();
	$out  = _find_all_object_request();
	
	$arr_rec_value = _select_report_recsource_value();
	$arr_var_agent = _select_report_agent_value();
	$arr_var_spvid = _select_report_spv_value();
	$arr_var_mgrid = _select_report_mgr_value();
	
	$arr_var_agents = $out->get_array_value('TmrId');
	$str_start_date  = $out->get_value('start_date','_getDateEnglish');
	$str_end_date = $out->get_value('end_date','_getDateEnglish');
	
	
// --- get data init freq_call per lead 
	$arr_val_data  = array();
	
	$sql = sprintf("SELECT
			COUNT(a.id) as tot_init_call,
			SUM( IF(( b.CallReasonCode IN('ST', 'CB', 'SA','PU', 'GPU','INC', 'CPGP', 'CPGP','R','B') OR b.CallCategoryCode IN('600') ), 1,0)) as tot_freq_call_contacted,
			SUM(IF( b.CallReasonCode IN('NP', 'BT','NA', 'MV', 'WN', 'ID'), 1,0)) as tot_freq_call_uncontacted,
			c.AssignSelerId as agent_id,
			b.Recsource as Recsource			
		FROM cc_call_session a, t_gn_customer b , t_gn_assignment c 
		WHERE a.assign_data=b.CustomerNumber
		AND b.Recsource IN('%s')
		AND a.start_time>='%s 00:00:00'
		AND a.start_time<='%s 23:59:59'
		AND c.AssignSelerId IN('%s')
		AND c.AssignLeader IN('%s')
		and c.AssignAmgr IN('%s')
		AND b.CustomerId=c.CustomerId
		GROUP BY agent_id, Recsource", 
		$arr_rec_value,
		$str_start_date,
		$str_end_date,
		$arr_var_agent,
		$arr_var_spvid,
		$arr_var_mgrid
		);

	//printf(" init call : <pre>%s</pre><hr>", $sql);	
	
	$qry  = $CI->db->query( $sql );
	if( $qry->num_rows() > 0) 
	 foreach( $qry->result_assoc() as $row ) 
	{
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_freq_init_call'] += $row['tot_init_call'];	
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_freq_call_contacted'] += $row['tot_freq_call_contacted'];	
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_freq_call_uncontacted'] += $row['tot_freq_call_uncontacted'];	
	}
	
// --------- get all POD ---------------------------------

	$sql = sprintf("select 
				count(a.pod_code) as tot_pod, 
				c.AssignSelerId as agent_id,
				b.Recsource as Recsource 
				from t_gn_pod a , t_gn_customer b , t_gn_assignment c
				where a.customer_id=b.CustomerId
				and b.CustomerId=c.CustomerId 	
				and b.Recsource IN('%s')
				and b.CustomerCallDateTs>='%s 00:00:00'
				and b.CustomerCallDateTs<='%s 23:59:59'
				and c.AssignSelerId IN('%s')
				and c.AssignLeader IN('%s')
				and c.AssignAmgr IN('%s')
				group by agent_id, Recsource", 
		$arr_rec_value,
		$str_start_date,
		$str_end_date,
		$arr_var_agent,
		$arr_var_spvid,
		$arr_var_mgrid
		);
	
	//printf("POD : <pre>%s</pre><hr>", $sql);	
				
	$qry  = $CI->db->query( $sql );			
	if( $qry->num_rows() > 0) 
	 foreach( $qry->result_assoc() as $row )  {
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_pod'] += $row['tot_pod'];
	}
	
	
	
// --------- get all ADDON ---------------------------------

	$sql = sprintf("SELECT 
				COUNT(a.App_ID) as tot_addon, 
				c.AssignSelerId as agent_id,
				b.Recsource as Recsource 
				FROM t_gn_app_addon a , t_gn_customer b , t_gn_assignment c
				WHERE a.Customer_ID = b.CustomerId
				AND b.CustomerId=c.CustomerId
				AND b.Recsource IN('%s')	
				AND b.CustomerCallDateTs>='%s 00:00:00'
				AND b.CustomerCallDateTs<='%s 23:59:59'
				AND c.AssignSelerId IN('%s')
				AND c.AssignLeader IN('%s')
				and c.AssignAmgr IN('%s')
				GROUP BY agent_id, Recsource", 
		$arr_rec_value,
		$str_start_date,
		$str_end_date,
		$arr_var_agent,
		$arr_var_spvid,
		$arr_var_mgrid
	);
				
//	printf("ADDON : <pre>%s</pre><hr>", $sql);		
	
	
	$qry  = $CI->db->query( $sql );			
	if( $qry->num_rows() > 0) 
	 foreach( $qry->result_assoc() as $row )  {
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_addon'] += $row['tot_addon'];
	}
	
// -------- get data size per agent  -------------------------------------

	$sql = sprintf("SELECT 
			COUNT(a.CustomerId) tot_data_size,
			a.AssignSelerId as agent_id,
			b.Recsource as Recsource
		FROM t_gn_assignment a 
		INNER JOIN t_gn_customer b on a.CustomerId=b.CustomerId
		LEFT JOIN t_lk_recsource c on b.Recsource=c.RecSourceName
		WHERE b.Recsource IN('%s')
		AND a.AssignSelerId IN('%s')
		and a.AssignLeader IN('%s')
		and a.AssignAmgr IN('%s')
		GROUP BY agent_id, Recsource", 
		$arr_rec_value,
		$arr_var_agent,
		$arr_var_spvid,
		$arr_var_mgrid
	);
			
//printf("Data Size : <pre>%s</pre><hr>", $sql);
	
	
 	 $qry  = $CI->db->query( $sql );
	 if( $qry->num_rows() > 0 )
		 foreach( $qry->result_assoc() as $row )
	{
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_data_size'];
	}
	
	
// --- get data utilize per status 	
	
	$sql = sprintf("SELECT 
			SUM(IF(b.CallReasonId <> 99, 1, 0)) as tot_utilize,
			SUM(IF( b.CallCategoryCode IN('600'), 1, 0)) tot_dl,
			SUM(IF( b.CallReasonCode IN('ST'), 1, 0)) tot_st,
			SUM(IF( b.CallReasonCode IN('CB'), 1, 0)) tot_cb,
			SUM(IF( b.CallReasonCode IN('SA'), 1, 0)) tot_sa,
			SUM(IF( b.CallReasonCode IN('PU'), 1, 0)) tot_pu,
			SUM(IF( b.CallReasonCode IN('GPU'), 1, 0)) tot_gpu,
			SUM(IF( b.CallReasonCode IN('CPGP'), 1, 0)) tot_cpgp,
			SUM(IF( b.CallReasonCode IN('INC'), 1, 0)) tot_inc,
			SUM(IF( b.CallReasonCode IN('R'), 1, 0)) tot_rjct,		
			SUM(IF( b.CallReasonCode IN('B'), 1, 0)) tot_blck,	
			
			SUM(IF( b.CallReasonCode IN('NP'), 1, 0)) tot_np,
			SUM(IF( b.CallReasonCode IN('BT'), 1, 0)) tot_bt,
			SUM(IF( b.CallReasonCode IN('NA'), 1, 0)) tot_na,		
			SUM(IF( b.CallReasonCode IN('MV'), 1, 0)) tot_mv,		
			SUM(IF( b.CallReasonCode IN('WN'), 1, 0)) tot_wn,	
			SUM(IF( b.CallReasonCode IN('ID'), 1, 0)) tot_id,	
			SUM(IF( b.CallReasonCode IN('DL0'), 1, 0)) tot_dl0,
			SUM(IF( b.CallReasonCode IN('DL1'), 1, 0)) tot_dl1,
			SUM(IF( b.CallReasonCode IN('DL2'), 1, 0)) tot_dl2,		
			SUM(IF( b.CallReasonCode IN('DL3'), 1, 0)) tot_dl3,		
			SUM(IF( b.CallReasonCode IN('DL4'), 1, 0)) tot_dl4,	
			SUM(IF( b.CallReasonCode IN('DL5'), 1, 0)) tot_dl5,	
			SUM(IF( b.CallReasonCode IN('DL6'), 1, 0)) tot_dl6,
			SUM(IF( b.CallReasonCode IN('DL7'), 1, 0)) tot_dl7,
			SUM(IF( b.CallReasonCode IN('DL8'), 1, 0)) tot_dl8,		
			SUM(IF( b.CallReasonCode IN('DL9'), 1, 0)) tot_dl9,		
			SUM(IF( b.CallReasonCode IN('DL10'), 1, 0)) tot_dl10,	
			SUM(IF( b.CallReasonCode IN('DL11'), 1, 0)) tot_dl11,	
			SUM(IF( b.CallReasonCode IN('DL12'), 1, 0)) tot_dl12,
			SUM(IF( b.CallReasonCode IN('DL13'), 1, 0)) tot_dl13,
			SUM(IF( b.CallReasonCode IN('DL14'), 1, 0)) tot_dl14,		
			SUM(IF( b.CallReasonCode IN('DL15'), 1, 0)) tot_dl15,		
			SUM(IF( b.CallReasonCode IN('DL16'), 1, 0)) tot_dl16,	
			SUM(IF( b.CallReasonCode IN('DL17'), 1, 0)) tot_dl17,	
			SUM(IF( b.CallReasonCode IN('DL18'), 1, 0)) tot_dl18,	
			SUM(IF( b.CallReasonCode IN('DL19'), 1, 0)) tot_dl19,	
			SUM(IF( b.CallReasonCode IN('DL20'), 1, 0)) tot_dl20,	
			SUM(IF( b.CallReasonCode IN('DL21'), 1, 0)) tot_dl21,
			a.AssignSelerId as agent_id,
			b.Recsource as Recsource
		FROM t_gn_assignment a 
		INNER JOIN t_gn_customer b on a.CustomerId=b.CustomerId
		LEFT JOIN t_lk_recsource c on b.Recsource=c.RecSourceName
		WHERE b.Recsource IN('%s')
		AND b.CustomerCallDateTs>='%s 00:00:00'
		AND b.CustomerCallDateTs<='%s 23:59:59'
		AND a.AssignSelerId IN('%s')
		and a.AssignLeader IN('%s')
		and a.AssignAmgr IN('%s')
		GROUP BY agent_id, Recsource", 
		
	 $arr_rec_value,
	 $str_start_date,
	 $str_end_date,
	 $arr_var_agent,
	 $arr_var_spvid,
	 $arr_var_mgrid
   );

			
//printf(" Data Util : <pre>%s</pre><hr>", $sql);

 	 $qry  = $CI->db->query( $sql );
	 if( $qry->num_rows() > 0 )
		 foreach( $qry->result_assoc() as $row )
	{
		
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_util'] += $row['tot_utilize'];
		
	// ------------ contacted call -------------------------------------
	
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_contacted'] += $row['tot_dl'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_contacted'] += $row['tot_st'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_contacted'] += $row['tot_cb'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_contacted'] += $row['tot_sa'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_contacted'] += $row['tot_pu'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_contacted'] += $row['tot_gpu'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_contacted'] += $row['tot_cpgp'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_contacted'] += $row['tot_inc'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_contacted'] += $row['tot_rjct'];
		
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_dl'] += $row['tot_dl'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_st'] += $row['tot_st'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_cb'] += $row['tot_cb'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_sa'] += $row['tot_sa'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_pu'] += $row['tot_pu'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_gpu'] += $row['tot_gpu'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_cpgp']+= $row['tot_cpgp'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_inc'] += $row['tot_inc'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_rjct']+= $row['tot_rjct'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_blck']+= $row['tot_blck'];
		
		
	// ----------- un contact -------------------------------------------------------------
	
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_uncontacted'] += $row['tot_np'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_uncontacted'] += $row['tot_bt'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_uncontacted'] += $row['tot_na'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_uncontacted'] += $row['tot_mv'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_uncontacted'] += $row['tot_wn'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_uncontacted'] += $row['tot_id'];
		
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_np'] += $row['tot_np'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_bt'] += $row['tot_bt'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_na'] += $row['tot_na'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_mv'] += $row['tot_mv'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_wn'] += $row['tot_wn'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['tot_id'] += $row['tot_id'];
		
		
	// ---------- total call init --- 	
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl0'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl1'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl2'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl3'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl4'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl5'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl6'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl7'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl8'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl9'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl10'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl11'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl12'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl13'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl14'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl15'];
		
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl16'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl17'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl18'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl19'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl20'];
		$arr_val_data[$row['agent_id']][$row['Recsource']]['data_size'] += $row['tot_dl21'];
		
	}
	
 
// --- get agent data ------------------------------------
	
  if( is_array($arr_var_agents)  ) 
	foreach( $arr_var_agents as $key=> $AgentId)
  {
 	
	$row_val = _select_row_user( $AgentId ) ;
	
	
// -------- default data ------------------
	
	$totBootDataSize = 0;
	$totBootDataUtil = 0;
	$totBootDataContacted = 0;
	$totBootDataUnContacted = 0; 
	$totBootDataFreqInitCall = 0; 
	$totBootDataFreqContactedInitCall = 0; 
	$totBootDataFreqUnContactedInitCall = 0; 
	
	$totBootDataADDON = 0; //$agent_value['tot_addon'];
	$totBootDataPOD = 0; // $agent_value['tot_pod'];
		
		
	
// --------- data default  ---- 
	
	$totDataDL	 	= 0;//$agent_value['tot_dl'];
	$totDataSTH 	= 0;//$agent_value['tot_st'];
	$totDataCB  	= 0;//$agent_value['tot_cb'];
	$totDataSA  	= 0;//$agent_value['tot_sa'];
	$totDataPU  	= 0;//$agent_value['tot_pu'];
	$totDataGPU  	= 0;//$agent_value['tot_gpu'];
	$totDataCPGP    = 0;//$agent_value['tot_cpgp'];
	$totDataINC  	= 0;//$agent_value['tot_inc'];
	$totDataRJCT  	= 0;//$agent_value['tot_rjct'];
	$totDataBLC  	= 0;//$agent_value['tot_blck'];
	$totDataNP 		= 0; //$DataNP; //$agent_value['tot_np'];
	$totDataBT 		= 0; //$DataBT; //$agent_value['tot_bt'];
	$totDataNA 		= 0; //$DataNA; //$agent_value['tot_na'];
	$totDataMV 		= 0; //$DataMV; //$agent_value['tot_mv'];
	$totDataWN 		= 0; //$DataWN; //$agent_value['tot_wn'];
	$totDataID 		= 0; //$DataID; //$agent_value['tot_id'];
		
	$totDataDL0 	= 0;
	$totDataDL1 	= 0;
	$totDataDL2 	= 0;
	$totDataDL3 	= 0;
	$totDataDL4 	= 0;
	$totDataDL5 	= 0;
	$totDataDL6 	= 0;
	$totDataDL7 	= 0;
	$totDataDL8 	= 0;
	$totDataDL9 	= 0;
	$totDataDL10 	= 0;
	$totDataDL11 	= 0;
	$totDataDL12 	= 0;
	$totDataDL13 	= 0;
	$totDataDL14 	= 0;
	$totDataDL15 	= 0;
	$totDataDL16 	= 0;
	$totDataDL17 	= 0;
	$totDataDL18 	= 0;
	$totDataDL19 	= 0;
	$totDataDL20 	= 0;
	$totDataDL21 	= 0;
	
// -- content -header --- 	
	printf("<div class=\"ui-wdget-title\">%s - %s</div>", $row_val->get_value('id'), $row_val->get_value('full_name'));
	print("<table class=\"data\" border=1 style=\"border-collapse: collapse\">
		<tr>
			<td rowspan=\"2\"  class=\"head\">Recsource</td> 
			<td rowspan=\"2\"  class=\"head\">Data Size</td> 
			<td rowspan=\"2\"  class=\"head\">Utilize</td> 
			<td colspan=\"6\"  class=\"head\" align=\"center\">Call Iniated</td> 
			<td rowspan=\"2\"  class=\"head\" nowrap>(%) Utilize</td> 
			<td colspan=\"12\" class=\"head\" align=\"center\">Contacted</td> 
			<td colspan=\"8\"  class=\"head\" align=\"center\">Not Contacted</td> 
			<td rowspan=\"2\"  class=\"head\">ADDON</td> 
			<td rowspan=\"2\"  class=\"head\">DL0</td>
			<td rowspan=\"2\"  class=\"head\">DL1</td>
			<td rowspan=\"2\"  class=\"head\">DL2</td>
			<td rowspan=\"2\"  class=\"head\">DL3</td>
			<td rowspan=\"2\"  class=\"head\">DL4</td>
			<td rowspan=\"2\"  class=\"head\">DL5</td>
			<td rowspan=\"2\"  class=\"head\">DL6</td>
			<td rowspan=\"2\"  class=\"head\">DL7</td>
			<td rowspan=\"2\"  class=\"head\">DL8</td>
			<td rowspan=\"2\"  class=\"head\">DL9</td>
			<td rowspan=\"2\"  class=\"head\">DL10</td>
			<td rowspan=\"2\"  class=\"head\">DL11</td>
			<td rowspan=\"2\"  class=\"head\">DL12</td>
			<td rowspan=\"2\"  class=\"head\">DL13</td>
			<td rowspan=\"2\"  class=\"head\">DL14</td>
			<td rowspan=\"2\"  class=\"head\">DL15</td>
			<td rowspan=\"2\"  class=\"head\">DL16</td>
			<td rowspan=\"2\"  class=\"head\">DL17</td>
			<td rowspan=\"2\"  class=\"head\">DL18</td>
			<td rowspan=\"2\"  class=\"head\">DL19</td>
			<td rowspan=\"2\"  class=\"head\">DL20</td>
			<td rowspan=\"2\"  class=\"head\">DL21</td>
			<td rowspan=\"2\"  class=\"head\">Lain-lain</td>
			<td rowspan=\"2\"  class=\"head\">Loan Amount</td>
			<td rowspan=\"2\"  class=\"head\">POD</td>
		</tr> 
		
		<tr>
			<td class=\"head\">Contacted</td> 
			<td class=\"head\">Freq call/lead</td> 
			<td class=\"head\">Un Contacted</td> 
			<td class=\"head\">Freq call/lead</td> 
			<td class=\"head\">Total</td> 
			<td class=\"head\">Freq call/lead</td>
			<td class=\"head\">D</td>
			<td class=\"head\">ST</td>
			<td class=\"head\">CB</td>
			<td class=\"head\">SA</td>
			<td class=\"head\">PU</td>
			<td class=\"head\">GPU</td>
			<td class=\"head\">CPGP</td>
			<td class=\"head\">INC</td>
			<td class=\"head\">R</td>
			<td class=\"head\">B</td>
			<td class=\"head\">Total</td>
			<td class=\"head\">%</td>
			<td class=\"head\">NP</td>
			<td class=\"head\">BT</td>
			<td class=\"head\">NA</td>
			<td class=\"head\">MV</td>
			<td class=\"head\">WN</td>
			<td class=\"head\">ID</td>
			<td class=\"head\">Total</td>
			<td class=\"head\">%</td>
		</tr>");
		
	
	$agent_val_data = ( $arr_val_data[$AgentId] ? $arr_val_data[$AgentId] : null );

	if( is_array( $agent_val_data ) )
		foreach( $agent_val_data as $Recsource => $agent_value )
	{	
		$totDataSize = $agent_value['data_size'];
		$totDataUtil = $agent_value['data_util'];
		$totDataContacted = $agent_value['tot_contacted'];
		$totDataUnContacted = $agent_value['tot_uncontacted'];
		$totDataFreqInitCall = $agent_value['tot_freq_init_call'];
		$totDataFreqContactedInitCall = $agent_value['tot_freq_call_contacted'];
		$totDataFreqUnContactedInitCall = $agent_value['tot_freq_call_uncontacted'];
		$totDataADDON = $agent_value['tot_addon'];
		$totDataPOD = $agent_value['tot_pod'];
		
		
		// ----- data contacted -----------------------
	
		$DataDL	 	= $agent_value['tot_dl'];
		$DataSTH 	= $agent_value['tot_st'];
		$DataCB  	= $agent_value['tot_cb'];
		$DataSA  	= $agent_value['tot_sa'];
		$DataPU  	= $agent_value['tot_pu'];
		$DataGPU  	= $agent_value['tot_gpu'];
		$DataCPGP   = $agent_value['tot_cpgp'];
		$DataINC  	= $agent_value['tot_inc'];
		$DataRJCT  	= $agent_value['tot_rjct'];
		$DataBLC  	= $agent_value['tot_blck'];
		
		// --- data uncontacted ----------------------- 
			
		$DataNP	 	= $agent_value['tot_np'];
		$DataBT 	= $agent_value['tot_bt'];
		$DataNA  	= $agent_value['tot_na'];
		$DataMV  	= $agent_value['tot_mv'];
		$DataWN  	= $agent_value['tot_wn'];
		$DataID  	= $agent_value['tot_id'];
		
		$DataDL0	= $agent_value['tot_dl0'];
		$DataDL1	= $agent_value['tot_dl1'];
		$DataDL2	= $agent_value['tot_dl2'];
		$DataDL3	= $agent_value['tot_dl3'];
		$DataDL4	= $agent_value['tot_dl4'];
		$DataDL5	= $agent_value['tot_dl5'];
		$DataDL6	= $agent_value['tot_dl6'];
		$DataDL7	= $agent_value['tot_dl7'];
		$DataDL8	= $agent_value['tot_dl8'];
		$DataDL9	= $agent_value['tot_dl9'];
		$DataDL10	= $agent_value['tot_dl10'];
		$DataDL11	= $agent_value['tot_dl11'];
		$DataDL12	= $agent_value['tot_dl12'];
		$DataDL13	= $agent_value['tot_dl13'];
		$DataDL14	= $agent_value['tot_dl14'];
		$DataDL15	= $agent_value['tot_dl15'];
		$DataDL16	= $agent_value['tot_dl16'];
		$DataDL17	= $agent_value['tot_dl17'];
		$DataDL18	= $agent_value['tot_dl18'];
		$DataDL19	= $agent_value['tot_dl19'];
		$DataDL20	= $agent_value['tot_dl20'];
		$DataDL21	= $agent_value['tot_dl21'];

		
		// --- data uncontacted ----------------------- 
		
		
	   // --------------- break ------------------------------------------------------
		
		
		$tot_percent_data_util 			= ( $totDataSize ?(($totDataUtil/$totDataSize) *100) : 0 );
		$tot_percent_contact_util 		= ( $totDataUtil ?(($totDataContacted/$totDataUtil) *100) : 0 );
		$tot_percent_uncontact_util 	= ( $totDataUtil?(($totDataUnContacted/$totDataUtil) *100) : 0 );							
		
		$tot_avg_freq_init_call 		= ( $totDataUtil ? number_format(($totDataFreqInitCall / $totDataUtil) , 1 ): 0 );	
		$tot_avg_freq_call_contacted 	= ( $totDataUtil ? number_format(($totDataFreqContactedInitCall / $totDataUtil), 1 ): 0 );	
		$tot_avg_freq_call_uncontacted 	= ( $totDataUtil ? number_format(($totDataFreqUnContactedInitCall / $totDataUtil), 1 ): 0 );									
		
		printf("%s", "<tr class=\"content\">");
			printf("<td class=\"content\" nowrap>%s</td>", ( $Recsource ? $Recsource  : ""));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($totDataSize) );
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($totDataUtil));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($totDataFreqContactedInitCall));
			printf("<td class=\"content\" align=\"right\">%s</td>", $tot_avg_freq_call_contacted );
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($totDataFreqUnContactedInitCall));
			printf("<td class=\"content\" align=\"right\">%s</td>", $tot_avg_freq_call_uncontacted);
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($totDataFreqInitCall));
			printf("<td class=\"content\" align=\"right\">%s</td>", $tot_avg_freq_init_call );
			printf("<td class=\"content\" align=\"right\">%s %s</td>", number_format($tot_percent_data_util, 0), "%");
			
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($DataDL));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($DataSTH));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($DataCB));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($DataSA));
			
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($DataPU));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($DataGPU));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($DataCPGP));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($DataINC));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($DataRJCT));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($DataBLC));
			printf("<td class=\"content\" align=\"right\" nowrap>%s</td>", eval_number($totDataContacted));
			printf("<td class=\"content\" align=\"right\" nowrap>%s %s</td>", number_format($tot_percent_contact_util, 0), "%");
			
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_np']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_bt']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_na']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_mv']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_wn']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_id']));
			
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($totDataUnContacted));
			printf("<td class=\"content\" align=\"right\" nowrap>%s %s</td>", number_format($tot_percent_uncontact_util,0), "%");
			printf("<td class=\"content\" align=\"right\" nowrap>%s</td>", eval_number($agent_value['tot_addon']));
			
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl0']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl1']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl2']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl3']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl4']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl5']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl6']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl7']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl8']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl9']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl10']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl11']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl12']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl13']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl14']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl15']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl16']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl17']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl18']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl19']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl20']));
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_dl21']));
			printf("<td class=\"content\" align=\"right\">%s</td>", "");
			printf("<td class=\"content\" align=\"right\">%s</td>","");
			printf("<td class=\"content\" align=\"right\">%s</td>", eval_number($agent_value['tot_pod']));
		printf("%s", "</tr>");
		
		
	// ------ summary bootom ---------------- 
	
		$totBootDataSize += $totDataSize;
		$totBootDataUtil += $totDataUtil;
		$totBootDataContacted += $totDataContacted;
		$totBootDataUnContacted += $totDataUnContacted; 
		$totBootDataFreqInitCall += $totDataFreqInitCall; 
		$totBootDataFreqContactedInitCall += $totDataFreqContactedInitCall; 
		$totBootDataFreqUnContactedInitCall += $totDataFreqUnContactedInitCall; 
		$totBootDataADDON += $totDataADDON;
		$totBootDataPOD += $totDataPOD;
		
	// --- contacted status ------------------------------------------
	
		$totDataDL += $DataDL; 
		$totDataSTH += $DataSTH; 
		$totDataCB += $DataCB; 
		$totDataSA += $DataSA; 
		$totDataPU += $DataPU; 
		$totDataGPU += $DataGPU; 
		$totDataCPGP += $DataCPGP; 
		$totDataINC += $DataINC; 
		$totDataRJCT += $DataRJCT; 
		$totDataBLC += $DataBLC; 
		$totDataNP += $DataNP;  
		$totDataBT += $DataBT;  
		$totDataNA += $DataNA;  
		$totDataMV += $DataMV;  
		$totDataWN += $DataWN;  
		$totDataID += $DataID;  
		$totDataDL0 += $DataDL0;
		$totDataDL1 += $DataDL1;
		$totDataDL2 += $DataDL2;
		$totDataDL3 += $DataDL3;
		$totDataDL4 += $DataDL4;
		$totDataDL5 += $DataDL5;
		$totDataDL6 += $DataDL6;
		$totDataDL7 += $DataDL7;
		$totDataDL8 += $DataDL8;
		$totDataDL9 += $DataDL9;
		$totDataDL10 += $DataDL10;
		$totDataDL11 += $DataDL11;
		$totDataDL12 += $DataDL12;
		$totDataDL13 += $DataDL13;
		$totDataDL14 += $DataDL14;
		$totDataDL15 += $DataDL15;
		$totDataDL16 += $DataDL16;
		$totDataDL17 += $DataDL17;
		$totDataDL18 += $DataDL18;
		$totDataDL19 += $DataDL19;
		$totDataDL20 += $DataDL20;
		$totDataDL21 += $DataDL21;
	}
	
	 
	 $totBootAvgFreqInitCall = ($totBootDataSize ? number_format(($totBootDataFreqInitCall / $totBootDataSize) , 1 ): 0 ); 
	 $totBootAvgFreqCallContacted = ($totBootDataUtil ? number_format(($totBootDataFreqContactedInitCall / $totBootDataUtil), 1 ): 0 );	
	 $totBootAvgFreqCallUncontacted = ($totBootDataUtil ? number_format(($totBootDataFreqUnContactedInitCall / $totBootDataUtil), 1 ): 0 );									
	 $totBootPercentDataUtilize = ( $totBootDataSize ?(($totBootDataUtil/$totBootDataSize) *100) : 0 );
	 
	 $totBootAvgDataContacted	= ( $totBootDataUtil ?(($totBootDataContacted/$totBootDataUtil) *100) : 0 );
	 $totBootAvgDataUnContacted	= ( $totBootDataUtil ?(($totBootDataUnContacted/$totBootDataUtil) *100) : 0 );
	 
	// ------- bootom test ------------------------------
	
		printf("%s", "<tr>");
			printf("<td class=\"head\">%s</td>", "Summary");
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totBootDataSize);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totBootDataUtil);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totBootDataFreqContactedInitCall);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totBootAvgFreqCallContacted);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totBootDataFreqUnContactedInitCall);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totBootAvgFreqCallUncontacted);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totBootDataFreqInitCall);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totBootAvgFreqInitCall);
			printf("<td class=\"head\" align=\"right\" >%s %s</td>", number_format($totBootPercentDataUtilize), "%" );
			
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataSTH);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataCB);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataSA);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataPU);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataGPU);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataCPGP);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataINC);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataRJCT);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataBLC);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totBootDataContacted);
			printf("<td class=\"head\" align=\"right\" nowrap>%s %s</td>", number_format($totBootAvgDataContacted), "%");
			
			
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataNP);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataBT);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataNA);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataMV);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataWN);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataID);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totBootDataUnContacted);
			printf("<td class=\"head\" align=\"right\" nowrap>%s %s</td>", number_format($totBootAvgDataUnContacted), "%");
			
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totBootDataADDON);
			
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL0);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL1);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL2);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL3);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL4);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL5);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL6);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL7);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL8);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL9);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL10);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL11);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL12);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL13);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL14);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL15);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL16);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL17);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL18);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL19);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL20);
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totDataDL21);
			
			printf("<td class=\"head\" align=\"right\" >%s</td>", "");
			printf("<td class=\"head\" align=\"right\" >%s</td>", "");
			printf("<td class=\"head\" align=\"right\" >%s</td>", $totBootDataPOD);
		printf("</tr> </table>%s", "<br>");
			
	
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
		_select_campaign_group_agent_summary();		
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
	
	echo "<div class=\"center\">".
		 "<p class=\"normal font-size22\">Report Call Tracking - Summary By Recsource Per Agent</p>".
		 "<p class=\"normal font-size20\">Report Recsource : ". _select_campaign_attr_header() ."</p>".
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
div.ui-wdget-title { font-weight:bold; margin:5px 5px 5px 0px;}
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
	<?php _PrepareCallData();?>
	<?php _showheaders(); ?>
	<?php _showReport(); ?>
	<?php _CleanCallData(); ?>
</body>
</html>
