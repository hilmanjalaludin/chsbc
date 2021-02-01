<?php
class M_NewDashboard extends EUI_Model
{
	var $_start_date;
	var $_end_date;
	
	function M_NewDashboard()
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
		$datas = array();
		
		$sql = "select 
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
				group by c.AssignSelerId";
		
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				$datas[$rows['SellerId']] = $rows;
			}
		}
		
		return $datas;
	}
	
	function _query_detail_spv($param)
	{
		$datas = array();
		
		$sql = "select 
					c.AssignLeader as SellerId,
					d.id,
					count(distinct b.PolicyNumber) as PIF,
					count(b.PolicyNumber) as NOS,
					sum( if(e.PayModeId=2, b.PolicyPremi*12,b.PolicyPremi) ) as ANP
				from t_gn_policyautogen a FORCE INDEX(PRIMARY)
				left join t_gn_policy b on a.PolicyNumber = b.PolicyNumber
				left join t_gn_assignment c on a.CustomerId = c.CustomerId
				left join tms_agent d on c.AssignLeader = d.UserId
				left join t_gn_productplan e on b.ProductPlanId = e.ProductPlanId
				where 1=1
				and date(b.PolicySalesDate) >= '{$this->_start_date}'
				and date(b.PolicySalesDate) <= '{$this->_end_date}'
				group by c.AssignLeader";
		
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				$datas[$rows['SellerId']] = $rows;
			}
		}
		
		return $datas;
	}
	
	function _query_detail_atm($param)
	{
		$datas = array();
		
		$sql = "select 
					c.AssignSpv as SellerId,
					d.id,
					count(distinct b.PolicyNumber) as PIF,
					count(b.PolicyNumber) as NOS,
					sum( if(e.PayModeId=2, b.PolicyPremi*12,b.PolicyPremi) ) as ANP
				from t_gn_policyautogen a FORCE INDEX(PRIMARY)
				left join t_gn_policy b on a.PolicyNumber = b.PolicyNumber
				left join t_gn_assignment c on a.CustomerId = c.CustomerId
				left join tms_agent d on c.AssignSpv = d.UserId
				left join t_gn_productplan e on b.ProductPlanId = e.ProductPlanId
				where 1=1
				and date(b.PolicySalesDate) >= '{$this->_start_date}'
				and date(b.PolicySalesDate) <= '{$this->_end_date}'
				group by c.AssignSpv";
		
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				$datas[$rows['SellerId']] = $rows;
			}
		}
		
		return $datas;
	}
	
	function _query_detail_mgr($param)
	{
		$datas = array();
		
		$sql = "select 
					c.AssignAmgr as SellerId,
					d.id,
					count(distinct b.PolicyNumber) as PIF,
					count(b.PolicyNumber) as NOS,
					sum( if(e.PayModeId=2, b.PolicyPremi*12,b.PolicyPremi) ) as ANP
				from t_gn_policyautogen a FORCE INDEX(PRIMARY)
				left join t_gn_policy b on a.PolicyNumber = b.PolicyNumber
				left join t_gn_assignment c on a.CustomerId = c.CustomerId
				left join tms_agent d on c.AssignAmgr = d.UserId
				left join t_gn_productplan e on b.ProductPlanId = e.ProductPlanId
				where 1=1
				and date(b.PolicySalesDate) >= '{$this->_start_date}'
				and date(b.PolicySalesDate) <= '{$this->_end_date}'
				group by c.AssignAmgr";
		
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				$datas[$rows['SellerId']] = $rows;
			}
		}
		
		return $datas;
	}
	
	/* breakdown */
	
	function _query_solicited_tso($param)
	{
		$datas = array();
		
		$sql = "select b.UserId, b.id, b.tl_id, count(a.CustomerId) as solicited 
				from (select ax.AgentCode, ax.CustomerId from t_gn_callhistory ax FORCE INDEX(PRIMARY)
							where 1=1
							and date(ax.CallHistoryCallDate) >= '{$this->_start_date}'
							and date(ax.CallHistoryCallDate) <= '{$this->_end_date}'
							and ax.HistoryType = 0
							group by ax.AgentCode, ax.CustomerId) a
				left join tms_agent b on a.AgentCode = b.id
				group by b.UserId";
		
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				$datas[$rows['UserId']] = $rows['solicited'];
			}
		}
		
		return $datas;
	}
	
	function _query_solicited_spv($param)
	{
		$datas = array();
		
		$sql = "select b.UserId, b.id, b.tl_id, count(a.CustomerId) as solicited 
				from (select ax.SPVCode, ax.CustomerId from t_gn_callhistory ax FORCE INDEX(PRIMARY)
							where 1=1
							and date(ax.CallHistoryCallDate) >= '{$this->_start_date}'
							and date(ax.CallHistoryCallDate) <= '{$this->_end_date}'
							and ax.HistoryType = 0
							group by ax.SPVCode, ax.CustomerId) a
				left join tms_agent b on a.SPVCode = b.id
				group by b.UserId";
		
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				$datas[$rows['UserId']] = $rows['solicited'];
			}
		}
		
		return $datas;
	}
	
	function _query_solicited_atm($param)
	{
		$datas = array();
		
		$sql = "select b.UserId, b.id, b.tl_id, count(a.CustomerId) as solicited 
				from (select ax.ATMCode, ax.CustomerId from t_gn_callhistory ax FORCE INDEX(PRIMARY)
							where 1=1
							and date(ax.CallHistoryCallDate) >= '{$this->_start_date}'
							and date(ax.CallHistoryCallDate) <= '{$this->_end_date}'
							and ax.HistoryType = 0
							group by ax.ATMCode, ax.CustomerId) a
				left join tms_agent b on a.ATMCode = b.id
				group by b.UserId";
		
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				$datas[$rows['UserId']] = $rows['solicited'];
			}
		}
		
		return $datas;
	}
	
	function _query_solicited_mgr($param)
	{
		$datas = array();
		
		$sql = "select b.UserId, b.id, b.tl_id, count(a.CustomerId) as solicited 
				from (select ax.AMGRCode, ax.CustomerId from t_gn_callhistory ax FORCE INDEX(PRIMARY)
							where 1=1
							and date(ax.CallHistoryCallDate) >= '{$this->_start_date}'
							and date(ax.CallHistoryCallDate) <= '{$this->_end_date}'
							and ax.HistoryType = 0
							group by ax.AMGRCode, ax.CustomerId) a
				left join tms_agent b on a.AMGRCode = b.id
				group by b.UserId";
		
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				$datas[$rows['UserId']] = $rows['solicited'];
			}
		}
		
		return $datas;
	}
}
?>