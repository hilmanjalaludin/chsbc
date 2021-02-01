<?php
class M_DailyNewDashboard extends EUI_Model
{
	var $_start_date;
	var $_end_date;
	
	function M_DailyNewDashboard()
	{
		$this->_start_date 	= (_get_have_post('dsb_start')?date('Y-m-d',strtotime(_get_post('dsb_start'))):date('Y-m-d'));
		$this->_end_date 	= (_get_have_post('dsb_end')?date('Y-m-d',strtotime(_get_post('dsb_end'))):date('Y-m-d'));
	}
	
	function _get_dashboard_type()
	{
		$datas = array();
		
		switch( _get_session('HandlingType') )
		{
			case USER_ROOT : // root
				$datas = array(
					'detail-per-tso' => 'Detail Per TSO',
					'detail-per-spv' => 'Detail Per SPV',
					'detail-per-atm' => 'Detail Per ATM',
					'detail-per-mgr' => 'Detail Per MGR',
					'summary-per-mgr' => 'Summary Per MGR',
					'summary-per-atm' => 'Summary Per ATM',
					'summary-per-spv' => 'Summary Per SPV',
					'summary-per-tso' => 'Summary Per TSO',
				);
			break;
			
			case USER_ADMIN : // admin
				$datas = array(
					'detail-per-tso' => 'Detail Per TSO',
					'detail-per-spv' => 'Detail Per SPV',
					'detail-per-atm' => 'Detail Per ATM',
					'detail-per-mgr' => 'Detail Per MGR',
					'summary-per-mgr' => 'Summary Per MGR',
					'summary-per-atm' => 'Summary Per ATM',
					'summary-per-spv' => 'Summary Per SPV',
					'summary-per-tso' => 'Summary Per TSO',
				);
			break;
			
			case USER_ACCOUNT_MANAGER : // mgr
				$datas = array(
					'detail-per-tso'  => 'Detail Per TSO',
					'detail-per-spv'  => 'Detail Per SPV',
					'detail-per-atm'  => 'Detail Per ATM',
					'summary-per-mgr' => 'Summary Per MGR',
					'summary-per-atm' => 'Summary Per ATM',
					'summary-per-spv' => 'Summary Per SPV',
					'summary-per-tso' => 'Summary Per TSO',
				);
			break;
			
			case USER_SUPERVISOR : // atm
				$datas = array(
					'detail-per-tso'  => 'Detail Per TSO',
					'detail-per-spv'  => 'Detail Per SPV',
					'summary-per-mgr' => 'Summary Per MGR',
					'summary-per-atm' => 'Summary Per ATM',
					'summary-per-spv' => 'Summary Per SPV',
					'summary-per-tso' => 'Summary Per TSO',
				);
			break;
			
			case USER_LEADER : // spv
				$datas = array(
					'detail-per-tso'  => 'Detail Per TSO',
					'summary-per-mgr' => 'Summary Per MGR',
					'summary-per-atm' => 'Summary Per ATM',
					'summary-per-spv' => 'Summary Per SPV',
					'summary-per-tso' => 'Summary Per TSO',
				);
			break;
		}
		
		return $datas;
	}
	
	function _get_combo_user_query( $where=array() )
	{
		$_datas = array();
		
		$sql = "select UserId, id from tms_agent FORCE INDEX(PRIMARY)
				where 1=1
				AND user_state = 1 ";
				
		foreach($where as $field => $value)
		{
			$sql .= " AND $field = '$value' ";
		}
		// echo $sql;
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				$_datas[$rows['UserId']] = $rows['id'];
			}
		}
		
		return $_datas;
	}
	
	/* QUERY - QUERY VIEW DASHBOARD */
	
	function _get_jam_current()
	{
		$_jam = 0;

		$_now = date('Y-m-d H:i:s');
		$_masuk = date('Y-m-d 08:00:00');
		$_kelar = (date('N',strtotime($_now))!=6?date('Y-m-d 17:00:00'):date('Y-m-d 14:00:00'));

		if( date('N',strtotime($_now))!=6 )
		{
			if( strtotime($_now) > strtotime(date('Y-m-d 12:00:00')) && strtotime($_now) <= strtotime(date('Y-m-d 13:00:00'))  )
			{
				$_jam = 12 - (int)date('H',strtotime($_masuk));
			}
			else if( strtotime($_now) > strtotime(date('Y-m-d 13:00:00')) && strtotime($_now) <= strtotime($_kelar) )
			{
				$_jam = ((int)date('H',strtotime($_now)) - (int)date('H',strtotime($_masuk))) - 1;
			}
			else if( strtotime($_now) > strtotime($_masuk) && strtotime($_now) <= strtotime(date('Y-m-d 12:00:00')) )
			{
				$_jam = (int)date('H',strtotime($_now)) - (int)date('H',strtotime($_masuk));
			}
			else if( strtotime($_now) > strtotime($_kelar) )
			{
				$_jam = ((int)date('H',strtotime($_kelar)) - (int)date('H',strtotime($_masuk))) - 1;
			}
		}
		else{
			if( strtotime($_now) > strtotime($_masuk) && strtotime($_now) <= strtotime($_kelar) )
			{
				$_jam = (int)date('H',strtotime($_now)) - (int)date('H',strtotime($_masuk));
			}
			else if( strtotime($_now) > strtotime($_kelar) )
			{
				$_jam = (int)date('H',strtotime($_kelar)) - (int)date('H',strtotime($_masuk));
			}
		}

		//echo $_jam;

		return $_jam;
	}

	function _query_jam_all($param)
	{
		$datas = array();
		
		$sql = "select a.UserId, sec_to_time( IF( DATE_FORMAT(date(now()),'%w')<>6, IF( UNIX_TIMESTAMP(now())>UNIX_TIMESTAMP('2016-03-24 12:00:00') and UNIX_TIMESTAMP(now())<UNIX_TIMESTAMP('2016-03-24 13:00:00'),sec_to_time(UNIX_TIMESTAMP('2016-03-24 12:00:00')-UNIX_TIMESTAMP('2016-03-24 08:00:00')),IF( UNIX_TIMESTAMP(now())<=UNIX_TIMESTAMP('2016-03-24 12:00:00'),UNIX_TIMESTAMP(now())-UNIX_TIMESTAMP('2016-03-24 08:00:00'), IF( UNIX_TIMESTAMP(now())>UNIX_TIMESTAMP('2016-03-24 17:00:00'), (UNIX_TIMESTAMP('2016-03-24 17:00:00')-UNIX_TIMESTAMP('2016-03-24 08:00:00'))-3600 , (UNIX_TIMESTAMP(now())-UNIX_TIMESTAMP('2016-03-24 08:00:00'))-3600 ) ) ) , IF( UNIX_TIMESTAMP(now())>UNIX_TIMESTAMP('2016-03-24 12:00:00') and UNIX_TIMESTAMP(now())<UNIX_TIMESTAMP('2016-03-24 13:00:00'),sec_to_time(UNIX_TIMESTAMP('2016-03-24 12:00:00')-UNIX_TIMESTAMP('2016-03-24 08:00:00')),IF( UNIX_TIMESTAMP(now())<=UNIX_TIMESTAMP('2016-03-24 12:00:00'),UNIX_TIMESTAMP(now())-UNIX_TIMESTAMP('2016-03-24 08:00:00'), IF( UNIX_TIMESTAMP(now())>UNIX_TIMESTAMP('2016-03-24 14:00:00'), (UNIX_TIMESTAMP('2016-03-24 14:00:00')-UNIX_TIMESTAMP('2016-03-24 08:00:00')) , (UNIX_TIMESTAMP(now())-UNIX_TIMESTAMP('2016-03-24 08:00:00')) ) ) ) ) ) as total_kerja from tms_agent a";
		
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				$datas[$rows['UserId']] = $rows['total_kerja'];
			}
		}
		
		return $datas;
	}
	
	/* breakdown */
	
	function _query_detail_tso($param)
	{
		// mode mssql
		if( QUERY == 'mssql') {
			return $this->_query_detail_tso_mssql($param);
		}

		$datas = array();
		$sql = "select tma.userid,concat('[',tma.id,'] - ',tma.full_name) as seller,count(distinct a.CallHistoryId) as TOTCALL, count(distinct a.CustomerId) as TOTCUST,
					sum(if(ses.`status` = 3005 OR ses.`status` = 3004,1,0)) as `3005`, sum(if(ses.`status` = 3003,1,0)) as `3003`,
					count(distinct if(a.CallReasonId = 13,a.CustomerId,NULL)) as INC,
					TIME_FORMAT(sum(TIMESTAMPDIFF(SECOND,ses.agent_time,ses.end_time)),'%H:%i:%s') as DUR,
					TIME_FORMAT((sum(TIMESTAMPDIFF(SECOND,ses.agent_time,ses.end_time))/count(distinct a.CallHistoryId)),'%H:%i:%s') as AVGDUR,
					round((sum(if(ses.`status` = 3003,1,0))/count(distinct a.CallHistoryId))*100,2) as ANS, 0 as Amount
				from t_gn_callhistory a
				left join cc_call_session ses ON a.CallSessionId = ses.session_id
				left join tms_agent tma ON a.CreatedById = tma.UserId
				where a.CreatedById = "._get_session('UserId')." and
				a.CallHistoryCallDate >= Curdate() and
				a.CallHistoryCallDate <= '".date("Y-m-d H:i:s")."'";
				
				// where a.CreatedById = "._get_session('UserId')." and
				// a.CallHistoryCallDate >= Curdate() and
				// a.CallHistoryCallDate <= '".date("Y-m-d H:i:s")."'";
		// echo $sql;
		
		/*$sql = "select 
					c.AssignSelerId as SellerId,
					d.id,
					count(distinct b.PolicyNumber) as PIF,
					count(b.PolicyNumber) as NOS,
					sum( if(e.PayModeId=2, b.PolicyPremi*12,b.PolicyPremi) ) as ANP
				from t_gn_policyautogen a FORCE INDEX(PRIMARY)
				left join t_gn_policy b on a.PolicyNumber = b.PolicyNumber
				left join t_gn_assignment c on a.CustomerId = c.CustomerId
				left join tms_agent d on c.AssignSelerId = d.UserId
				left join t_gn_productplan e on b.ProductPlanId = e.ProductPlanId
				where 1=1
				and date(b.PolicySalesDate) >= '{$this->_start_date}'
				and date(b.PolicySalesDate) <= '{$this->_end_date}'
				group by c.AssignSelerId";*/
		$sql2 = "SELECT b.SellerId AS SellerId, b.Recsource,
			e.monthly_premium, SUM(e.monthly_premium) amount,
			sum(if(b.CallReasonId in (13) and xsel.vartiering = 100 and b.CallReasonQue = 99 ,xsel.loan,0)) as INC1,
			sum(if(b.CallReasonId in (13) and flex.vartiering = 100 and b.CallReasonQue = 99 ,flex.loan,0)) as INC2,
			sum(if(b.CampaignId = 7 and b.CallReasonId in (13) and b.CallReasonQue = 1,e.monthly_premium,0)) as HOSINC,
			sum(if(b.CampaignId = 5 and xsel.vartiering < 100 and b.CallReasonId in (13) and b.CallReasonQue = 1,xsel.Loan,0)) as XSINC,
			sum(if(b.CampaignId = 6 and b.CallReasonId in (13),topu.Loan,0)) as TPINC,
			sum(if(b.CampaignId = 9 and flex.vartiering < 100 and b.CallReasonId in (13) and b.CallReasonQue = 1,flex.Loan,0)) as FLINC,
			f.UserId
			FROM t_gn_customer b
			left join t_gn_assignment assi On b.CustomerId = assi.CustomerId
			left JOIN t_gn_frm_hospin e ON b.CustomerId = e.CustomerId
			left JOIN t_gn_frm_flexi flex ON b.CustomerId = flex.CustomerId
			left JOIN t_gn_frm_pil_topup topu ON b.CustomerId = topu.CustomerId
			left JOIN t_gn_frm_pil_xsel xsel ON b.CustomerId = xsel.CustomerId
			INNER JOIN tms_agent c ON b.SellerId = c.UserId
			INNER JOIN tms_agent f ON c.spv_id = f.UserId
			INNER JOIN t_lk_callreason d ON b.CallReasonId = d.CallReasonId
			where assi.AssignSelerId = "._get_session('UserId')."
			and b.CustomerUpdatedTs >= '".date("Y-m-d")."'
			and b.CustomerUpdatedTs <= '".date("Y-m-d H:i:s")."'";
				
			// WHERE c.handling_type = 4 AND
			// b.CampaignId IN (".$this -> campaign.") AND
			// b.CustomerUpdatedTs >= '".$this->start_date." 00:00:00' AND b.CustomerUpdatedTs <= '".$this->end_date." 23:00:00'";
		
		$qry = $this->db->query($sql);	
		#var_dump($this->db->last_query($sql));die();	
		if($qry->num_rows()>0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				// $datas[$rows['userid']] = $rows;
				$datas = $rows;
			}
		}
		
		$qry2 = $this->db->query($sql2);
			// echo $sql2;
			foreach($qry2->result_assoc() as $row){
				$datas['Amount'] += $row['INC1'];
				$datas['Amount'] += $row['INC2'];
				$datas['Amount'] += $row['HOSINC'];
				$datas['Amount'] += $row['XSINC'];
				$datas['Amount'] += $row['TPINC'];
				$datas['Amount'] += $row['FLINC'];
			}
		return $datas;
	}
	

	/**
	 * (F) _query_detail_tso_mssql [query mode mssql]
	 * @param  [type] $param [description]
	 * @return [type]        [description]
	 */
	function _query_detail_tso_mssql($param)
	{
		if (_get_session('HandlingType') == USER_SUPERVISOR) {
			$where = 'tma.spv_id='._get_session('UserId').' AND tma.UserId != '._get_session('UserId');
		} else if (_get_session('HandlingType') == 2) {
			$where = 'tma.mgr_id='._get_session('UserId').' AND tma.UserId != '._get_session('UserId');
		} else {
			$where = 'tma.UserId='._get_session('UserId');
		}
		$datas = array();
		$sql = "";
		$sql = "select count(DISTINCT a.CallHistoryId) as TOTCALL, count(distinct a.CustomerId) as TOTCUST,
				SUM( CASE WHEN (ses.status=3005 OR ses.status=3004) THEN 1 ELSE 0 END ) as '3005',
				SUM( CASE WHEN (ses.status=3003) THEN 1 ELSE 0 END ) as '3003',
				count(distinct CASE WHEN (a.CallReasonId=13) THEN a.CustomerId ELSE NULL END ) as INC,
				CONVERT(varchar, DATEADD(S, SUM(DATEDIFF(S,ses.agent_time,ses.end_time)),0), 8) as DUR,
				CONVERT(varchar, DATEADD(S, (SUM(DATEDIFF(S,ses.agent_time,ses.end_time))/count(distinct a.CallHistoryId)),0), 8) as AVGDUR,
				ROUND( (sum(CASE WHEN ses.status=3003 THEN 1 ELSE 0 END) / count(distinct a.CallHistoryId)) *100,2 ) as ANS,
				
				(SELECT SUM(flexi.Loan)FROM t_gn_frm_flexi_single flexi WHERE flexi.CreateBy=tma.UserId AND flexi.CreateDate >= '".date('Y-m-d')."') AS Flek_s,
				(SELECT SUM(fx.Loan) FROM t_gn_frm_flexi fx WHERE fx.CreateBy=tma.UserId AND fx.CreateDate >= '".date('Y-m-d')."') AS FX,
				(SELECT SUM(cip.AmountLogged) FROM t_gn_frm_cip cip WHERE cip.CreateBy=tma.UserId AND cip.CreateDate >= '".date('Y-m-d')."') AS CIP,
				(SELECT SUM(tu.Loan) FROM t_gn_frm_pil_topup tu WHERE tu.CreateBy=tma.UserId AND tu.CreateDate >= '".date('Y-m-d')."') AS TU,
				(SELECT SUM(xs.Loan) FROM t_gn_frm_pil_xsel xs WHERE xs.CreateBy=tma.UserId AND xs.CreateDate >= '".date('Y-m-d')."') AS XS,
				tma.userid,
				concat('[',tma.id,'] - ',tma.full_name) as seller
				from t_gn_callhistory a
				left join cc_call_session ses ON a.CallSessionId = ses.session_id
				left join tms_agent tma ON a.CreatedById = tma.UserId
				where {$where} 
				and a.CallHistoryCallDate >= convert(varchar, getdate(), 23) 
				and a.CallHistoryCallDate <= '".date('Y-m-d H:i:s')."'
				GROUP BY tma.userid, tma.id, tma.full_name";
		// var_dump( $sql2 );die();
		$qry = $this->db->query($sql);
		#echo "<pre>";
		#var_dump($this->db->last_query());die();
		if($qry->num_rows()>0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				$datas[$rows['userid']] = $rows;
				// $datas  = $rows;
			}
		}
		// echo "<pre>";
		// var_dump($sql);
		// echo "</pre>";die();

		// $sql2 = "SELECT SUM(e.monthly_premium) amount, 
		// 		sum(CASE WHEN (b.CallReasonId in (13) and xsel.vartiering = 100 and b.CallReasonQue = 99) THEN xsel.loan ELSE 0 END ) as INC1,
		// 		sum(case when (b.CallReasonId in (13) and flex.vartiering = 100 and b.CallReasonQue = 99) THEN flex.loan ELSE 0 END ) as INC2, 
		// 		sum(CASE WHEN (b.CampaignId = 7 and b.CallReasonId in (13) and b.CallReasonQue = 1) THEN e.monthly_premium ELSE 0 END ) as HOSINC,
		// 			sum(CASE WHEN (b.CampaignId = 5 and xsel.vartiering < 100 and b.CallReasonId in (13) and b.CallReasonQue = 1) THEN xsel.Loan ELSE 0 end ) as XSINC, 
		// 		sum(CASE WHEN(b.CampaignId = 6 and b.CallReasonId in (13)) THEN topu.Loan ELSE 0 END ) as TPINC, 
		// 		sum(CASE WHEN (b.CampaignId = 9 and flex.vartiering < 100 and b.CallReasonId in (13) and b.CallReasonQue = 1) THEN flex.Loan ELSE 0 END ) as FLINC,
		// 		f.UserId, b.SellerId AS SellerId, b.Recsource, e.monthly_premium

		// 		FROM t_gn_customer b 
		// 		left join t_gn_assignment assi On b.CustomerId = assi.CustomerId 
		// 		left JOIN t_gn_frm_hospin e ON b.CustomerId = e.CustomerId 
		// 		left JOIN t_gn_frm_flexi flex ON b.CustomerId = flex.CustomerId 
		// 		left JOIN t_gn_frm_pil_topup topu ON b.CustomerId = topu.CustomerId 
		// 		left JOIN t_gn_frm_pil_xsel xsel ON b.CustomerId = xsel.CustomerId 
		// 		INNER JOIN tms_agent c ON b.SellerId = c.UserId 
		// 		INNER JOIN tms_agent f ON c.spv_id = f.UserId 
		// 		INNER JOIN t_lk_callreason d ON b.CallReasonId = d.CallReasonId 
		// 		where assi.AssignSelerId = "._get_session('UserId')." 
		// 		-- and b.CustomerUpdatedTs >= '".date("Y-m-d")."' 
		// 		-- and b.CustomerUpdatedTs <= '".date("Y-m-d H:i:s")."'
		// 	  	group by f.UserId, b.SellerId, b.Recsource, e.monthly_premium";
		// // echo "<pre>";
		// // var_dump( $sql );
		// // echo "</pre>";die();
		// $qry2 = $this->db->query($sql2);
		// foreach($qry2->result_assoc() as $row){
		// 	$datas['Amount'] += $row['INC1'];
		// 	$datas['Amount'] += $row['INC2'];
		// 	$datas['Amount'] += $row['HOSINC'];
		// 	$datas['Amount'] += $row['XSINC'];
		// 	$datas['Amount'] += $row['TPINC'];
		// 	$datas['Amount'] += $row['FLINC'];
		// }
		
		return $datas;
	}


	//tambahan irul
	function _getChart($param) {

		// $date = date('Y-m-d');
		$date = '2019-11';
		$datas = array();
		$sql = "SELECT
		DISTINCT(a.SellerId),
		(SELECT COUNT(*) FROM t_gn_customer v1 INNER JOIN t_gn_assignment vb ON v1.CustomerId=vb.CustomerId WHERE v1.CallReasonId=1 AND vb.AssignSelerId=1218) AS NEW,
		(SELECT COUNT(*) FROM t_gn_callhistory v2 WHERE v2.CallReasonId=2 AND v2.CreatedById=a.SellerId AND CONVERT(VARCHAR(7), v2.CallHistoryCallDate)='$date') AS NA,
		(SELECT COUNT(*) FROM t_gn_callhistory v3 WHERE v3.CallReasonId=3 AND v3.CreatedById=a.SellerId AND CONVERT(VARCHAR(7), v3.CallHistoryCallDate)='$date') AS MV,
		(SELECT COUNT(*) FROM t_gn_callhistory v4 WHERE v4.CallReasonId=4 AND v4.CreatedById=a.SellerId AND CONVERT(VARCHAR(7), v4.CallHistoryCallDate)='$date') AS ID,
		(SELECT COUNT(*) FROM t_gn_callhistory v5 WHERE v5.CallReasonId=5 AND v5.CreatedById=a.SellerId AND CONVERT(VARCHAR(7), v5.CallHistoryCallDate)='$date') AS BT,
		(SELECT COUNT(*) FROM t_gn_callhistory v6 WHERE v6.CallReasonId=6 AND v6.CreatedById=a.SellerId AND CONVERT(VARCHAR(7), v6.CallHistoryCallDate)='$date') AS NP,
		(SELECT COUNT(*) FROM t_gn_callhistory v7 WHERE v7.CallReasonId=7 AND v7.CreatedById=a.SellerId AND CONVERT(VARCHAR(7), v7.CallHistoryCallDate)='$date') AS WN,
		(SELECT COUNT(*) FROM t_gn_callhistory v8 WHERE v8.CallReasonId=8 AND v8.CreatedById=a.SellerId AND CONVERT(VARCHAR(7), v8.CallHistoryCallDate)='$date') AS D,
		(SELECT COUNT(*) FROM t_gn_callhistory v9 WHERE v9.CallReasonId=9 AND v9.CreatedById=a.SellerId AND CONVERT(VARCHAR(7), v9.CallHistoryCallDate)='$date') AS R,
		(SELECT COUNT(*) FROM t_gn_callhistory v10 WHERE v10.CallReasonId=10 AND v10.CreatedById=a.SellerId AND CONVERT(VARCHAR(7), v10.CallHistoryCallDate)='$date') AS ST,
		(SELECT COUNT(*) FROM t_gn_callhistory v11 WHERE v11.CallReasonId=11 AND v11.CreatedById=a.SellerId AND CONVERT(VARCHAR(7), v11.CallHistoryCallDate)='$date') AS CB,
		(SELECT COUNT(*) FROM t_gn_callhistory v12 WHERE v12.CallReasonId=12 AND v12.CreatedById=a.SellerId AND CONVERT(VARCHAR(7), v12.CallHistoryCallDate)='$date') AS TBO,
		(SELECT COUNT(*) FROM t_gn_callhistory v13 WHERE v13.CallReasonId=13 AND v13.CreatedById=a.SellerId AND CONVERT(VARCHAR(7), v13.CallHistoryCallDate)='$date') AS INC,
		(SELECT COUNT(*) FROM t_gn_callhistory v14 WHERE v14.CallReasonId=14 AND v14.CreatedById=a.SellerId AND CONVERT(VARCHAR(7), v14.CallHistoryCallDate)='$date') AS DAP,
		(SELECT COUNT(*) FROM t_gn_callhistory v15 WHERE v15.CallReasonId=15 AND v15.CreatedById=a.SellerId AND CONVERT(VARCHAR(7), v15.CallHistoryCallDate)='$date') AS PA
		
		FROM t_gn_customer a
		WHERE a.SellerId = $param";

		$qry = $this->db->query($sql);
		// echo "<pre>";
		// var_dump($this->db->last_query());
		// echo "</pre>";die();
		if($qry->num_rows()>0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				// $datas[$rows['userid']] = $rows;
				$datas = $rows;
			}
		}

		return $datas;

	}
	//tutup tambahan irul
	
}
?>