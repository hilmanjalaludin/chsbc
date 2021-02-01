<?php
	class M_TsrSalesTrackingReport extends EUI_Model
	{
		private static $instance = null;	

		function M_TsrSalesTrackingReport()
		{
			$this -> load ->model(array('M_Combo','M_SysUser'));
			$this -> start_date = _getDateEnglish( $this -> URI->_get_post('start_date'));
			$this -> end_date 	= _getDateEnglish( $this -> URI->_get_post('end_date'));
			$this -> spv		= _get_post('spv_id');
			$this -> tl			= _get_post('tl_id');
			$this -> cmp		= _get_post('cmp_id');
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
				'Tsr' => 'TSR'
			);
		}
		
		public function ModeBy()
		{
			return array
			(
				'Summary' => 'Summary'
			);
		}
		
		/* Fungsi Get SPV */
		function _getSPVBaru($spvId)
		{
			// $spv = array();
			$sql = "SELECT
						a.UserId,
						a.full_name AS SPV
					FROM tms_agent a
					WHERE 1=1
						AND a.spv_id = ".$spvId."
						AND a.handling_type = 13
						AND a.UserId NOT IN (310,311,321)
					GROUP BY a.UserId";
			
			$qry = $this->db->query($sql);
			foreach( $qry->result_assoc() as $rows )
			{
				$spv[$rows['UserId']] = $rows['SPV'];
			}
			return $spv;
		}
		
		function _getAtmBaru( $param = null )
		{
			$Atm = array();
			$sql = "SELECT
						a.UserId,
						a.full_name AS ATM
					FROM tms_agent a
					WHERE 1=1
						AND a.handling_type = 3
					GROUP BY a.UserId";
			$qry = $this->db->query($sql);
			foreach( $qry->result_assoc() as $rows )
			{
				$Atm[$rows['UserId']] = $rows['ATM'];
			}
			return $Atm;
		}
		
		function _getCMP( $param = null )
		{
			$cmp = array();
			$sql = "SELECT
						a.CampaignId,
						a.CampaignName
					FROM t_gn_campaign a
					WHERE a.CampaignStatusFlag = 1
					GROUP BY a.CampaignId";
			$qry = $this->db->query($sql);
			// echo "<pre>$sql</pre>";
			foreach( $qry->result_assoc() as $rows )
			{
				$cmp[$rows['CampaignId']] = $rows['CampaignName'];
			}
			return $cmp;
		}
		
		/** 
		 **	Batas
		 **/
		
		/* Fungsi Get ATM */
		function _getAtm( $param = null )
		{
			$Atm = array();
			$sql = "SELECT
						a.UserId,
						a.full_name AS ATM
					FROM tms_agent a
					WHERE 1=1
						AND a.handling_type = 3
						AND a.spv_id = ".$this -> spv."
					GROUP BY a.UserId";
			$qry = $this->db->query($sql);
			
			foreach( $qry->result_assoc() as $rows )
			{
				$Atm[$rows['UserId']]['ATM'] = $rows['ATM'];
			}
			return $Atm;
		}
		
		/* Fungsi Get SPV */
		function _getSPV( $param = null )
		{
			$spv = array();
			$sql = "SELECT
						a.UserId,
						a.full_name AS SPV
					FROM tms_agent a
					WHERE 1=1
						AND a.handling_type = 13
						AND a.tl_id = ".$this -> tl."
						AND a.UserId NOT IN (310,311,321)
					GROUP BY a.UserId";
			
			$qry = $this->db->query($sql);
			
			foreach( $qry->result_assoc() as $rows )
			{
				$spv[$rows['UserId']]['SPV'] = $rows['SPV'];
			}
			return $spv;
		}
		
		/*Fungsi Get Agent */
		function _getAgent( $param = null )
		{
			$agent = array();
			$sql = "SELECT
						a.UserId,
						a.full_name AS Agent
					FROM tms_agent a
						LEFT JOIN t_gn_customer b ON a.UserId = b.SellerId
					WHERE 1=1
						AND a.handling_type = 4
						AND a.spv_id = ".$this -> spv."
						AND a.tl_id = ".$this -> tl."
						AND b.CampaignId IN (".$this-> cmp.")
						AND a.user_state = 1
						AND a.UserId NOT IN (312,313,314,315,322)
					GROUP BY a.UserId";
			$qry = $this->db->query($sql);
			
			foreach( $qry->result_assoc() as $rows )
			{
				$agent[$rows['UserId']]['Agent'] = $rows['Agent'];
			}
			return $agent;
		}
		
		/* Fungsi Lead Size */
		function _Leadsize()
		{
			$Size = array();
			$sql = "SELECT
						a.AssignSelerId,
						COUNT(a.CustomerId) LeadSize
					FROM t_gn_assignment a
						LEFT JOIN tms_agent b ON a.AssignSelerId = b.UserId
						LEFT JOIN t_gn_customer c ON a.CustomerId = c.CustomerId
					WHERE 1=1
						AND b.handling_type = 4
						AND b.spv_id = ".$this -> spv."
						AND b.tl_id = ".$this -> tl."
						AND c.CampaignId IN (".$this-> cmp.")
					GROUP BY a.AssignSelerId";
			$qry = $this->db->query($sql);
			// echo "<pre>$sql</pre>";
			foreach($qry->result_assoc() as $rows)
			{
				$Size[$rows['AssignSelerId']]['LeadSize'] = $rows['LeadSize'];
			}
			return $Size;
		}
		
		/* Fungsi New Utilized */
		function _NewUtilized()
		{
			$New = array();
			$sql = "SELECT
						a.SellerId,
						b.full_name,
						COUNT(DISTINCT a.CustomerId) AS LeadNew
					FROM t_gn_customer a
						LEFT JOIN tms_agent b ON a.SellerId = b.UserId
					WHERE 1=1
						AND b.spv_id = ".$this -> spv."
						AND b.tl_id = ".$this -> tl."
						AND a.CampaignId IN (".$this-> cmp.")
						AND DATE(a.CustomerUpdatedTs) >= '".$this->end_date."'
						AND DATE(a.CustomerUpdatedTs) <= '".$this->end_date."'
					GROUP BY a.SellerId";
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				$New[$rows['SellerId']]['LeadNew'] = $rows['LeadNew'];
			}
			return $New;
		}
		
		/* Fungsi Old Utilized */
		function _OldUtilized()
		{
			$Old = array();
			$sql = "SELECT
						a.SellerId,
						b.full_name,
						COUNT(DISTINCT a.CustomerId) AS LeadOld
					FROM t_gn_customer a
						LEFT JOIN tms_agent b ON a.SellerId = b.UserId
					WHERE 1=1
						AND b.spv_id = ".$this -> spv."
						AND b.tl_id = ".$this -> tl."
						AND a.CampaignId IN (".$this-> cmp.")
						AND DATE(a.CustomerUpdatedTs) >= '".$this->start_date."'
						AND a.CustomerUpdatedTs <= DATE_SUB('".$this->end_date." 23:59:59', Interval 1 Day)
					GROUP BY a.SellerId";
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				$Old[$rows['SellerId']]['LeadOld'] = $rows['LeadOld'];
			}
			return $Old;
		}
		
		/* Fungsi Remaining */
		function _Remaining()
		{
			$Remaining = array();
			$sql = "SELECT
						a.SellerId,
						b.full_name,
						COUNT(DISTINCT a.CustomerId) AS Remaining
					FROM t_gn_customer a
						LEFT JOIN tms_agent b ON a.SellerId = b.UserId
					WHERE 1=1
						AND b.spv_id = ".$this -> spv."
						AND b.tl_id = ".$this -> tl."
						AND a.CampaignId IN (".$this-> cmp.")
						AND a.CallReasonId IS NULL
					GROUP BY a.SellerId";
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				$Remaining[$rows['SellerId']]['Remaining'] = $rows['Remaining'];
			}
			return $Remaining;
		}
		
		/* Fungsi Contacted */
		function _Contact()
		{
			$Contact = array();
			$sql = "SELECT
						a.SellerId,
						COUNT(DISTINCT a.CustomerId) AS Contacted
					FROM t_gn_customer a
						LEFT JOIN t_lk_callreason b ON a.CallReasonId = b.CallReasonId
						LEFT JOIN tms_agent c ON a.SellerId = c.UserId
					WHERE 1=1
						AND c.spv_id = ".$this -> spv."
						AND c.tl_id = ".$this -> tl."
						AND a.CampaignId IN (".$this-> cmp.")
						AND b.CallReasonCategoryId NOT IN (2,7)
						AND DATE(a.CustomerUpdatedTs) >= '".$this-> start_date."'
						AND DATE(a.CustomerUpdatedTs) <= '".$this-> end_date."'
					GROUP BY a.SellerId";
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				$Contact[$rows['SellerId']]['Contacted'] = $rows['Contacted'];
			}
			return $Contact;
		}
		
		/* Call Attempt */
		function _Attempt()
		{
			$Attempt = array();
			$sql = " SELECT
						a.CreatedById,
						COUNT(DISTINCT a.CustomerId) AS Jumlah,
						COUNT(a.CallReasonId) AS Attempt
					FROM t_gn_callhistory a
						LEFT JOIN t_gn_customer b ON a.CustomerId = b.CustomerId
						LEFT JOIN tms_agent c ON a.CreatedById = c.UserId
					WHERE 1=1
					AND b.CampaignId IN (".$this-> cmp.")
					AND c.handling_type = 4
					AND c.spv_id = ".$this -> spv."
					AND c.tl_id = ".$this -> tl."
					AND a.CallHistoryCreatedTs >= '".$this-> start_date." 00:00:00'
					AND a.CallHistoryCreatedTs <= '".$this-> end_date." 23:59:59'
					GROUP BY a.CreatedById";
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				$Attempt[$rows['CreatedById']]['Attempt'] += $rows['Attempt'];
				$Attempt[$rows['CreatedById']]['Jumlah'] += $rows['Jumlah'];
			}
			return $Attempt;
		}
		
		/* Fungsi Sales Submit */
		function _SalesSubmit()
		{
			$Sale = array();
			$sql = "SELECT
						a.SellerId,
						COUNT(DISTINCT a.CustomerId) AS Sales,
						SUM(e.PolicyPremi * 12) AS ANP
					FROM t_gn_customer a
						LEFT JOIN t_lk_callreason b ON a.CallReasonId = b.CallReasonId
						LEFT JOIN tms_agent c ON a.SellerId = c.UserId
						LEFT JOIN t_gn_policyautogen d ON a.CustomerId = d.CustomerId
						LEFT JOIN t_gn_policy e ON d.PolicyNumber = e.PolicyNumber
					WHERE 1=1
						AND c.spv_id = ".$this -> spv."
						AND c.tl_id = ".$this -> tl."
						AND a.CampaignId IN (".$this-> cmp.")
						AND a.CallReasonId IN (27,28,29,30)
						AND DATE(a.CustomerUpdatedTs) >= '".$this-> start_date."'
						AND DATE(a.CustomerUpdatedTs) <= '".$this-> end_date."'
					GROUP BY a.SellerId";
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				$Sale[$rows['SellerId']]['Sales'] = $rows['Sales'];
				$Sale[$rows['SellerId']]['ANP'] = $rows['ANP'];
			}
			return $Sale;
		}
		
		/* Fungsi Total Cases */
		function _TotalCases()
		{
			$Cases = array();
			$sql = "SELECT
						b.SellerId,
						COUNT(a.InsuredId) AS TotalCases
					FROM t_gn_insured a
						LEFT JOIN t_gn_customer b ON a.CustomerId = b.CustomerId
						LEFT JOIN tms_agent c ON b.SellerId = c.UserId
					WHERE 1=1
						AND c.spv_id = 295
						AND c.tl_id = 281
						AND b.CampaignId IN (4)
						AND DATE(a.InsuredCreatedTs) >= '2014-10-01'
						AND DATE(a.InsuredCreatedTs) <= '2014-10-08'
					GROUP BY b.SellerId";
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				$Cases[$rows['SellerId']]['TotalCases'] = $rows['TotalCases'];
			}
			return $Cases;
		}
		
		/* Fungsi Target */
		function _Target($CampaignId)
		{
			$Target = array();
			$sql	= "SELECT 
							a.CampaignId AS CmpId,
							a.Target1 AS ConRate,
							a.Target2 AS CasesSubmited,
							a.Target4 AS ConvertRate1,
							a.Target5 AS ANPSubmit,
							a.Target7 AS ConvertRate2,
							a.Target8 AS AARP
					   FROM t_gn_campaign_target a
					   where a.CampaignId in (".$CampaignId.")
					  ";
			// ECHO $sql;
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				$Target['ConRate'] = $rows['ConRate'];
				$Target['CasesSubmited'] = $rows['CasesSubmited'];
				$Target['ConvertRate1'] = $rows['ConvertRate1'];
				$Target['ANPSubmit'] = $rows['ANPSubmit'];
				$Target['ConvertRate2'] = $rows['ConvertRate2'];
				$Target['AARP'] = $rows['AARP'];
			}
			return $Target;		
		}
	}
?>