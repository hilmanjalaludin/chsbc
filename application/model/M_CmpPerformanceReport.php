<?php
	class M_CmpPerformanceReport extends EUI_Model
	{
		private static $instance = null;	

		function M_CmpPerformanceReport()
		{
			$this -> load ->model(array('M_Combo','M_SysUser'));
			$this -> start_date = _getDateEnglish( $this -> URI->_get_post('start_date'));
			$this -> end_date 	= _getDateEnglish( $this -> URI->_get_post('end_date'));
			$this -> campaign	= _get_post('cmp');
		}
		
		public static function & get_instance() 
		{
			if( is_null(self::$instance)) 
			{
				self::$instance = new self();
			}
			return self::$instance;
		}
		
		public function FilterBy()
		{
			return array
			(
				'Campaign' => 'Campaign'
			);
		}
		
		public function ModeBy()
		{
			return array
			(
				'Summary' => 'Summary'
			);
		}
		
		function filter_by($Filter__ = null)
		{
			$Filter = array();
			$this -> db -> select("a.CampaignId, a.CampaignName");
			$this -> db -> from("t_gn_campaign a");
			$this -> db -> where("a.CampaignStatusFlag",1);
			// $this -> db -> where("a.CampaignId",$Filter__);
			
			foreach($this -> db -> get() -> result_assoc() as $rows)
			{
				$Filter[$rows['CampaignId']] = $rows['CampaignName'];
			}
			return $Filter;
		}
		
		/* Fungsi Get Batch & Lead Given */
		function _getCampaign( $param = null )
		{
			$Campaign = array();
			$sql = "SELECT
						a.CampaignId,
						b.CampaignName AS BatchName,
						COUNT(DISTINCT a.CustomerId) AS LeadGiven
					FROM t_gn_customer a
						LEFT JOIN t_gn_campaign b ON a.CampaignId = b.CampaignId
					WHERE 1=1
						AND a.CampaignId IN (".$this->campaign.")
					GROUP BY a.CampaignId";
			
			$qry = $this->db->query($sql);
			// echo "<pre>$sql</pre>";
			foreach( $qry->result_assoc() as $rows )
			{
				$Campaign[$rows['CampaignId']]['BatchName'] = $rows['BatchName'];
				$Campaign[$rows['CampaignId']]['LeadGiven'] = $rows['LeadGiven'];
			}
			return $Campaign;
		}
		
		/* Fungsi Lead Contacted */
		function _getLeadContacted( $param = null )
		{
			$Contacted = array();
			$sql = "SELECT
						a.CampaignId,
						COUNT(DISTINCT a.CustomerId) AS LeadContacted
					FROM t_gn_customer a
						LEFT JOIN t_lk_callreason b ON a.CallReasonId = b.CallReasonId
					WHERE 1=1
						AND b.CallReasonCategoryId NOT IN (2,7)
						AND DATE(a.CustomerUpdatedTs) >= '{$this ->start_date}'
						AND DATE(a.CustomerUpdatedTs) <= '{$this ->end_date}'
					GROUP BY a.CampaignId";
			$qry = $this->db->query($sql);
			foreach( $qry->result_assoc() as $rows )
			{
				$Contacted[$rows['CampaignId']]['LeadContacted'] = $rows['LeadContacted'];
			}
			
			return $Contacted;
		}
		
		/* Fungsi Sales Submit */
		function _getSalesSubmit( $param = null )
		{
			$Sales = array();
			$sql = "SELECT
						a.CampaignId,
						COUNT(DISTINCT a.CustomerId) AS SalesSubmit,
						SUM(d.PolicyPremi*12) AS ANP
					FROM t_gn_customer a
						LEFT JOIN t_lk_callreason b ON a.CallReasonId = b.CallReasonId
						LEFT JOIN t_gn_policyautogen c ON a.CustomerId = c.CustomerId
						LEFT JOIN t_gn_policy d ON c.PolicyNumber = d.PolicyNumber
					WHERE 1=1
						AND a.CallReasonId IN (27,28,29,30)
						AND DATE(a.CustomerUpdatedTs) >= '{$this ->start_date}'
						AND DATE(a.CustomerUpdatedTs) <= '{$this ->end_date}'
					GROUP BY a.CampaignId";
			$qry = $this->db->query($sql);
			
			foreach( $qry->result_assoc() as $rows )
			{
				$Sales[$rows['CampaignId']]['SalesSubmit'] = $rows['SalesSubmit'];
				$Sales[$rows['CampaignId']]['ANP'] = $rows['ANP'];
			}
			return $Sales;
		}
		
		/* Fungsi Total Cases */
		function _getTotalCases( $param = null )
		{
			$Cases = array();
			$sql = "SELECT
						a.CampaignId,
						COUNT(b.CustomerId) AS TotalCases
					FROM t_gn_customer a
						LEFT JOIN t_gn_insured b ON a.CustomerId = b.CustomerId
					WHERE 1=1
						AND DATE(a.CustomerUpdatedTs) >= '{$this ->start_date}'
						AND DATE(a.CustomerUpdatedTs) <= '{$this ->end_date}'
					GROUP BY a.CampaignId";
			$qry = $this->db->query($sql);
			// echo "<pre>$sql</pre>";
			foreach( $qry->result_assoc() as $rows )
			{
				$Cases[$rows['CampaignId']]['TotalCases'] = $rows['TotalCases'];
			}
			return $Cases;
		}
		
		/* Fungsi New Utilized */
		function _getUtilizedNew( $param = null )
		{
			$NewUtilized = array();
			$sql = "SELECT
						a.CampaignId,
						COUNT(DISTINCT a.CustomerId) AS UtilizedNew
					FROM t_gn_customer a
					WHERE 1=1
						AND a.CallReasonId IS NOT NULL
						AND DATE(a.CustomerUpdatedTs) = '{$this ->end_date}'
					GROUP BY a.CampaignId";
			$qry = $this->db->query($sql);
			// echo "<pre>$sql</pre>";
			foreach( $qry->result_assoc() as $rows )
			{
				$NewUtilized[$rows['CampaignId']]['UtilizedNew'] = $rows['UtilizedNew'];
			}
			return $NewUtilized;
		}
		
		/* Fungsi Old Utilized */
		function _getUtilizedOld( $param = null )
		{
			$OldUtilized = array();
			$sql = "SELECT
						a.CampaignId,
						COUNT(DISTINCT a.CustomerId) AS UtilizedOld
					FROM t_gn_customer a
						LEFT JOIN t_gn_campaign b ON a.CampaignId = b.CampaignId
					WHERE 1=1
						AND a.CallReasonId IS NOT NULL
						AND a.CustomerUpdatedTs >= '{$this ->start_date} 00:00:00'
						AND a.CustomerUpdatedTs <= DATE_SUB('{$this ->end_date} 23:59:59', Interval 1 Day)
					GROUP BY a.CampaignId";
			$qry = $this->db->query($sql);
			// echo "<pre>$sql</pre>";
			foreach( $qry->result_assoc() as $rows )
			{
				$OldUtilized[$rows['CampaignId']]['UtilizedOld'] = $rows['UtilizedOld'];
			}
			return $OldUtilized;
		}
		
		/* Fungsi Remaining Utilized */
		function _getUtilizedRemaining( $param = null )
		{
			$RemainUtilized = array();
			$sql = "SELECT
						a.CampaignId,
						COUNT(DISTINCT a.CustomerId) AS UtilizedRemaining
					FROM t_gn_customer a
					WHERE 1=1
						AND a.CallReasonId IS NULL
					GROUP BY a.CampaignId";
			$qry = $this->db->query($sql);
			// echo "<pre>$sql</pre>";
			foreach( $qry->result_assoc() as $rows )
			{
				$RemainUtilized[$rows['CampaignId']]['UtilizedRemaining'] = $rows['UtilizedRemaining'];
			}
			return $RemainUtilized;
		}
		
		/* Fungsi Target */
		function _getTarget( $param = null )
		{
			$Target = array();
			$sql = "SELECT
						a.CampaignId,
						b.CampaignName,
						a.Target1 AS tContactRate,
						a.Target4 AS tConver1,
						a.Target7 AS tConver2,
						a.Target2 AS tCases,
						a.Target5 AS tANP,
						a.Target8 AS tAARP
					FROM t_gn_campaign_target a
						LEFT JOIN t_gn_campaign b ON a.CampaignId = b.CampaignId
					WHERE a.CampaignId IN (".$this->campaign.")
					GROUP BY a.CampaignId";
			$qry = $this->db->query($sql);
			// echo "<pre>$sql</pre>";
			foreach( $qry->result_assoc() as $rows )
			{
				$Target[$rows['CampaignId']]['CampaignName'] = $rows['CampaignName'];
				$Target[$rows['CampaignId']]['tContactRate'] = $rows['tContactRate'];
				$Target[$rows['CampaignId']]['tConver1'] = $rows['tConver1'];
				$Target[$rows['CampaignId']]['tConver2'] = $rows['tConver2'];
				$Target[$rows['CampaignId']]['tCases'] = $rows['tCases'];
				$Target[$rows['CampaignId']]['tANP'] += $rows['tANP'];
				$Target[$rows['CampaignId']]['tAARP'] = $rows['tAARP'];
			}
			return $Target;
		}
	}
?>