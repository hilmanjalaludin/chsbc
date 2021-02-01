<?php
	class M_CampaignEffectiveness extends EUI_Model
	{
		private static $instance = null;	

		function M_CampaignEffectiveness()
		{
			$this -> load ->model(array('M_Combo','M_SysUser'));
			$this -> start_date = _getDateEnglish( $this -> URI->_get_post('start_date'));
			$this -> end_date 	= _getDateEnglish( $this -> URI->_get_post('end_date'));
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
			
			foreach($this -> db -> get() -> result_assoc() as $rows)
			{
				$Filter[$rows['CampaignId']] = $rows['CampaignName'];
			}
			return $Filter;
		}
		
		/* Fungsi Index */
		function _getCampaign( $param = null )
		{
			$Campaign = array();
			$sql = "SELECT
						b.CampaignId,
						c.CampaignNumber AS CampaignNo,
						c.CampaignName AS CampaignName,
						c.CampaignNumber AS BatchId,
						c.CampaignName AS BatchName,
						COUNT(DISTINCT a.CustomerId) AS UploadData
					FROM t_gn_assignment a
						LEFT JOIN t_gn_customer b ON a.CustomerId = b.CustomerId
						LEFT JOIN t_gn_campaign c ON b.CampaignId = c.CampaignId
					GROUP BY b.CampaignId";
			
			$qry = $this->db->query($sql);
			// echo "<pre>$sql</pre>";
			foreach( $qry->result_assoc() as $rows )
			{
				$Campaign[$rows['CampaignId']]['CampaignNo'] = $rows['CampaignNo'];
				$Campaign[$rows['CampaignId']]['CampaignName'] = $rows['CampaignName'];
				$Campaign[$rows['CampaignId']]['BatchId'] = $rows['BatchId'];
				$Campaign[$rows['CampaignId']]['BatchName'] = $rows['BatchName'];
				$Campaign[$rows['CampaignId']]['UploadData'] = $rows['UploadData'];
			}
			return $Campaign;
		}
		
		/*Fungsi Data New Today */
		function _getDataNew( $param = null )
		{
			$DataNew = array();
			$sql = "SELECT
						a.CampaignId,
						COUNT(DISTINCT a.CustomerId) AS Today,
						COUNT(IF(a.CallReasonId IS NOT NULL,a.CustomerId,0)) AS Utilized,
						SUM(IF(a.CallReasonId IS NULL,a.CustomerId,0)) AS Remaining
					FROM t_gn_customer a
					WHERE DATE(a.CustomerUpdatedTs) = '{$this ->end_date}'
					GROUP BY a.CampaignId";
			$qry = $this->db->query($sql);
			// echo "<pre>$sql</pre>";
			foreach( $qry->result_assoc() as $rows )
			{
				$DataNew[$rows['CampaignId']]['Today'] = $rows['Today'];
				$DataNew[$rows['CampaignId']]['Utilized'] = $rows['Utilized'];
				$DataNew[$rows['CampaignId']]['Remaining'] = $rows['Remaining'];
			}
			return $DataNew;
		}
		
		/* Fungsi Data Old */
		function _getDataOld( $param = null )
		{
			$DataOld = array();
			$sql = "SELECT
						a.CampaignId,
						COUNT(IF(a.CallReasonId IS NOT NULL,a.CustomerId,0)) AS OldUtilized,
						SUM(IF(a.CallReasonId IS NULL,a.CustomerId,0)) AS OldRemaining
					FROM t_gn_customer a
					WHERE DATE(a.CustomerUpdatedTs) >= '{$this ->start_date}'
					AND a.CustomerUpdatedTs <= ADDTIME('{$this ->end_date} 23:59:59', '-1 1:1:1')
					GROUP BY a.CampaignId";
			$qry = $this->db->query($sql);
			foreach( $qry->result_assoc() as $rows )
			{
				$DataOld[$rows['CampaignId']]['OldUtilized'] = $rows['OldUtilized'];
				$DataOld[$rows['CampaignId']]['OldRemaining'] = $rows['OldRemaining'];
			}
			
			return $DataOld;
		}
		
		/* Fungsi New Database */
		function _getIndex( $param = null )
		{
			$Index = array();
			$sql = "SELECT
						a.CampaignId,
						COUNT(DISTINCT a.CustomerId) AS TotUtilized,
						COUNT(b.CustomerId) AS CallAttempt,
						COUNT(DISTINCT IF(a.CallReasonId=1,a.CustomerId,0)) AS Invalid,
						COUNT(DISTINCT IF(a.CallReasonId=2,a.CustomerId, 0)) BusyLine,
						COUNT(DISTINCT IF(a.CallReasonId=3,a.CustomerId, 0)) FaxNum,
						COUNT(DISTINCT IF(a.CallReasonId=4,a.CustomerId, 0)) NoAnswer,
						COUNT(DISTINCT IF(a.CallReasonId=5,a.CustomerId, 0)) AS WrongNum,
						COUNT(DISTINCT IF(a.CallReasonId=6,a.CustomerId, 0)) AlreadyMove,
						COUNT(DISTINCT IF(a.CallReasonId=7,a.CustomerId, 0)) Resign,
						COUNT(DISTINCT IF(a.CallReasonId=8,a.CustomerId, 0)) Mailbox,
						COUNT(DISTINCT IF(a.CallReasonId=9,a.CustomerId, 0)) Meeting,
						COUNT(DISTINCT IF(a.CallReasonId=10,a.CustomerId, 0)) CantBeReached,
						COUNT(DISTINCT IF(a.CallReasonId=11,a.CustomerId, 0)) Thinking,
						COUNT(DISTINCT IF(a.CallReasonId=12,a.CustomerId, 0)) CallBack,
						COUNT(DISTINCT IF(a.CallReasonId=28,a.CustomerId, 0)) TrustBank,
						COUNT(DISTINCT IF(a.CallReasonId=27,a.CustomerId, 0)) TrustInsurance,
						COUNT(DISTINCT IF(a.CallReasonId=29,a.CustomerId, 0)) AS Cheap,
						COUNT(DISTINCT IF(a.CallReasonId=13,a.CustomerId, 0)) AS RejectUpFront,
						COUNT(DISTINCT IF(a.CallReasonId=14,a.CustomerId, 0)) AS SpouseDoesnt,
						COUNT(DISTINCT IF(a.CallReasonId=15,a.CustomerId, 0)) AS NotBuy,
						COUNT(DISTINCT IF(a.CallReasonId=16,a.CustomerId, 0)) AS AlreadyInsured,
						COUNT(DISTINCT IF(a.CallReasonId=33,a.CustomerId, 0)) AS NoMoney,
						COUNT(DISTINCT IF(a.CallReasonId=18,a.CustomerId, 0)) AS NeedHighBenefit,
						COUNT(DISTINCT IF(a.CallReasonId=19,a.CustomerId, 0)) AS Expensive,
						COUNT(DISTINCT IF(a.CallReasonId=20,a.CustomerId, 0)) AS Reluctant,
						COUNT(DISTINCT IF(a.CallReasonId=40,a.CustomerId, 0)) AS PendingInfo,
						0 AS RejectBMI,
						0 AS MedQuestion,
						COUNT(DISTINCT IF(a.CallReasonId=23,a.CustomerId, 0)) AS Overage,
						COUNT(DISTINCT IF(a.CallReasonId=22,a.CustomerId, 0)) AS Unqualified,
						COUNT(DISTINCT IF(a.CallReasonId=26,a.CustomerId, 0)) AS Other,
						0 AS OutOfCourier,
						0 AS RequestCase
					FROM t_gn_customer a
						LEFT JOIN t_gn_callhistory b ON a.CustomerId = b.CustomerId
					WHERE 1=1
						AND DATE(a.CustomerUpdatedTs) >= '{$this ->start_date}'
						AND DATE(a.CustomerUpdatedTs) <= '{$this ->end_date}'
					GROUP BY a.CampaignId";
			$qry = $this->db->query($sql);
			foreach( $qry->result_assoc() as $rows )
			{
				$Index[$rows['CampaignId']]['TotUtilized'] = $rows['TotUtilized'];
				$Index[$rows['CampaignId']]['CallAttempt'] = $rows['CallAttempt'];
				$Index[$rows['CampaignId']]['Invalid'] = $rows['Invalid'];
				$Index[$rows['CampaignId']]['BusyLine'] = $rows['BusyLine'];
				$Index[$rows['CampaignId']]['FaxNum'] = $rows['FaxNum'];
				$Index[$rows['CampaignId']]['NoAnswer'] = $rows['NoAnswer'];
				$Index[$rows['CampaignId']]['WrongNum'] = $rows['WrongNum'];
				$Index[$rows['CampaignId']]['AlreadyMove'] = $rows['AlreadyMove'];
				$Index[$rows['CampaignId']]['Resign'] = $rows['Resign'];
				$Index[$rows['CampaignId']]['Mailbox'] = $rows['Mailbox'];
				$Index[$rows['CampaignId']]['Meeting'] = $rows['Meeting'];
				$Index[$rows['CampaignId']]['CantBeReached'] = $rows['CantBeReached'];
				$Index[$rows['CampaignId']]['Thinking'] = $rows['Thinking'];
				$Index[$rows['CampaignId']]['CallBack'] = $rows['CallBack'];
				$Index[$rows['CampaignId']]['TrustBank'] = $rows['TrustBank'];
				$Index[$rows['CampaignId']]['TrustInsurance'] = $rows['TrustInsurance'];
				$Index[$rows['CampaignId']]['Cheap'] = $rows['Cheap'];
				$Index[$rows['CampaignId']]['PendingInfo'] = $rows['PendingInfo'];
				$Index[$rows['CampaignId']]['RejectUpFront'] = $rows['RejectUpFront'];
				$Index[$rows['CampaignId']]['SpouseDoesnt'] = $rows['SpouseDoesnt'];
				$Index[$rows['CampaignId']]['NotBuy'] = $rows['NotBuy'];
				$Index[$rows['CampaignId']]['AlreadyInsured'] = $rows['AlreadyInsured'];
				$Index[$rows['CampaignId']]['NoMoney'] = $rows['NoMoney'];
				$Index[$rows['CampaignId']]['NeedHighBenefit'] = $rows['NeedHighBenefit'];
				$Index[$rows['CampaignId']]['Expensive'] = $rows['Expensive'];
				$Index[$rows['CampaignId']]['Reluctant'] = $rows['Reluctant'];
				$Index[$rows['CampaignId']]['PendingInfo'] = $rows['PendingInfo'];
				$Index[$rows['CampaignId']]['RejectBMI'] = $rows['RejectBMI'];
				$Index[$rows['CampaignId']]['MedQuestion'] = $rows['MedQuestion'];
				$Index[$rows['CampaignId']]['Overage'] = $rows['Overage'];
				$Index[$rows['CampaignId']]['Unqualified'] = $rows['Unqualified'];
				$Index[$rows['CampaignId']]['Other'] = $rows['Other'];
				$Index[$rows['CampaignId']]['OutOfCourier'] = $rows['OutOfCourier'];
				$Index[$rows['CampaignId']]['RequestCase'] = $rows['RequestCase'];
			}
			return $Index;
		}
		
		/* Fungsi New Database */
		function _getNewDatabase( $param = null )
		{
			$NewDatabase = array();
			$sql = "SELECT
						a.CampaignId,
						COUNT(b.CustomerId) AS NewCases,
						SUM(IF(d.PayModeId=2,d.ProductPlanPremium*12,0)) AS NewANP
					FROM t_gn_customer AS a
						LEFT JOIN t_gn_insured b ON a.CustomerId = b.CustomerId
						LEFT JOIN t_gn_policy c ON b.PolicyId = c.PolicyId
						LEFT JOIN t_gn_productplan d ON c.ProductPlanId = d.ProductPlanId
					WHERE 1=1
						AND DATE(a.CustomerUpdatedTs) = '{$this ->end_date}'
					GROUP BY a.CampaignId";
			$qry = $this->db->query($sql);
			foreach( $qry->result_assoc() as $rows )
			{
				$NewDatabase[$rows['CampaignId']]['NewCases'] = $rows['NewCases'];
				$NewDatabase[$rows['CampaignId']]['NewANP'] = $rows['NewANP'];
			}
			return $NewDatabase;
		}
		
		/* Fungsi Old Database */
		function _getOldDatabase( $param = null )
		{
			$OldDatabase = array();
			$sql = "SELECT
						a.CampaignId,
						COUNT(b.CustomerId) AS OldCases,
						SUM(IF(d.PayModeId=2,d.ProductPlanPremium*12,0)) AS OldANP
					FROM t_gn_customer AS a
						LEFT JOIN t_gn_insured b ON a.CustomerId = b.CustomerId
						LEFT JOIN t_gn_policy c ON b.PolicyId = c.PolicyId
						LEFT JOIN t_gn_productplan d ON c.ProductPlanId = d.ProductPlanId
					WHERE 1=1
						AND DATE(a.CustomerUpdatedTs) >= '{$this ->start_date}'
						AND a.CustomerUpdatedTs <= ADDTIME('{$this ->end_date} 23:59:59', '-1 1:1:1')
					GROUP BY a.CampaignId";
			$qry = $this->db->query($sql);
			foreach( $qry->result_assoc() as $rows )
			{
				$OldDatabase[$rows['CampaignId']]['OldCases'] = $rows['OldCases'];
				$OldDatabase[$rows['CampaignId']]['OldANP'] = $rows['OldANP'];
			}
			return $OldDatabase;
		}
		
		/* Fungsi Coverage */
		function _getCoverage( $param = null )
		{
			$Coverage = array();
			$sql = "SELECT
						b.CampaignId,
						SUM(IF(a.PremiumGroupId=2,1,0)) AS BuySelf,
						SUM(IF(a.PremiumGroupId NOT IN (2),1,0)) AS BuyOthers
					FROM t_gn_insured a
						LEFT JOIN t_gn_customer b ON a.CustomerId = b.CustomerId
					WHERE 1=1
						AND DATE(b.CustomerUpdatedTs) >= '{$this ->start_date}'
						AND DATE(b.CustomerUpdatedTs) <= '{$this ->end_date}'
					GROUP BY b.CampaignId";
			$qry = $this->db->query($sql);
			foreach( $qry->result_assoc() as $rows )
			{
				$Coverage[$rows['CampaignId']]['BuySelf'] = $rows['BuySelf'];
				$Coverage[$rows['CampaignId']]['BuyOthers'] = $rows['BuyOthers'];
			}
			return $Coverage;
		}
		
		/* Fungsi Range Age */
		function _getRangeAge( $param = null )
		{
			$Range = array();
			$sql = "SELECT
						b.CampaignId,
						SUM(IF(a.InsuredAge <= 10,1,0)) AS U10,
						SUM(IF(a.InsuredAge >= 11 AND a.InsuredAge <= 20,1,0)) AS U20,
						SUM(IF(a.InsuredAge >= 21 AND a.InsuredAge <= 30,1,0)) AS U30,
						SUM(IF(a.InsuredAge >= 31 AND a.InsuredAge <= 40,1,0)) AS U40,
						SUM(IF(a.InsuredAge >= 41 AND a.InsuredAge <= 49,1,0)) AS U49,
						SUM(IF(a.InsuredAge >= 50 AND a.InsuredAge <= 55,1,0)) AS U55,
						SUM(IF(a.InsuredAge >= 56 AND a.InsuredAge <= 60,1,0)) AS U60,
						SUM(IF(a.InsuredAge >= 61 AND a.InsuredAge <= 65,1,0)) AS U65,
						SUM(IF(a.InsuredAge >= 66 AND a.InsuredAge <= 70,1,0)) AS U70
					FROM t_gn_insured a
						LEFT JOIN t_gn_customer b ON a.CustomerId = b.CustomerId
					WHERE 1=1
						AND DATE(b.CustomerUpdatedTs) >= '{$this ->start_date}'
						AND DATE(b.CustomerUpdatedTs) <= '{$this ->end_date}'
					GROUP BY b.CampaignId";
			$qry = $this->db->query($sql);
			foreach( $qry->result_assoc() as $rows )
			{
				$Range[$rows['CampaignId']]['U10'] = $rows['U10'];
				$Range[$rows['CampaignId']]['U20'] = $rows['U20'];
				$Range[$rows['CampaignId']]['U30'] = $rows['U30'];
				$Range[$rows['CampaignId']]['U40'] = $rows['U40'];
				$Range[$rows['CampaignId']]['U49'] = $rows['U49'];
				$Range[$rows['CampaignId']]['U55'] = $rows['U55'];
				$Range[$rows['CampaignId']]['U60'] = $rows['U60'];
				$Range[$rows['CampaignId']]['U65'] = $rows['U65'];
				$Range[$rows['CampaignId']]['U70'] = $rows['U70'];
			}
			return $Range;
		}
		
		/* Fungsi Gender */
		function _getGender( $param = null )
		{
			$Gender = array();
			$sql = "SELECT
						b.CampaignId,
						SUM(IF(a.GenderId=1,1,0)) AS Male,
						SUM(IF(a.GenderId=2,1,0)) AS Female
					FROM t_gn_insured a
						LEFT JOIN t_gn_customer b ON a.CustomerId = b.CustomerId
					WHERE 1=1
						AND DATE(b.CustomerUpdatedTs) >= '{$this ->start_date}'
						AND DATE(b.CustomerUpdatedTs) <= '{$this ->end_date}'
					GROUP BY b.CampaignId";
			$qry = $this->db->query($sql);
			foreach( $qry->result_assoc() as $rows )
			{
				$Gender[$rows['CampaignId']]['Male'] = $rows['Male'];
				$Gender[$rows['CampaignId']]['Female'] = $rows['Female'];
			}
			return $Gender;
		}
		
		/* Fungsi Payment Media */
		function _getPayment( $param = null )
		{
			$Payment = array();
			$sql = "SELECT
						a.CampaignId,
						SUM(IF(c.PaymentCategory IN (1,2),1,0)) AS Kredit,
						SUM(IF(c.PaymentCategory IN (1,2),f.ProductPlanPremium*12,0)) AnpKredit,
						SUM(IF(c.PaymentCategory IN (3),1,0)) AS Debit,
						SUM(IF(c.PaymentCategory IN (3),f.ProductPlanPremium*12,0)) AnpDebit,
						0 AS Transfer,
						0 AS AnpTransfer
					FROM t_gn_customer a
						LEFT JOIN t_gn_payer b ON a.CustomerId = b.CustomerId
						LEFT JOIN t_lk_paymenttype c ON b.PaymentTypeId = c.PaymentTypeId
						LEFT JOIN t_gn_policyautogen d ON b.CustomerId = d.CustomerId
						LEFT JOIN t_gn_policy e ON d.PolicyNumber = e.PolicyNumber
						LEFT JOIN t_gn_productplan f ON e.ProductPlanId = f.ProductPlanId
					WHERE 1=1
					AND DATE(a.CustomerUpdatedTs) >= '{$this ->start_date}'
					AND DATE(a.CustomerUpdatedTs) <= '{$this ->end_date}'
					GROUP BY a.CampaignId";
			$qry = $this->db->query($sql);
			foreach( $qry->result_assoc() as $rows )
			{
				$Payment[$rows['CampaignId']]['Kredit'] = $rows['Kredit'];
				$Payment[$rows['CampaignId']]['AnpKredit'] = $rows['AnpKredit'];
				$Payment[$rows['CampaignId']]['Debit'] = $rows['Debit'];
				$Payment[$rows['CampaignId']]['AnpDebit'] = $rows['AnpDebit'];
				$Payment[$rows['CampaignId']]['Transfer'] = $rows['Transfer'];
				$Payment[$rows['CampaignId']]['AnpTransfer'] = $rows['AnpTransfer'];
			}
			return $Range;
		}
		
		/* Fungsi Paymode */
		function _getPaymode( $param = null )
		{
			$Paymode = array();
			$sql = "SELECT
						b.CampaignId,
						SUM(IF(a.InsuredPayMode=2,1,0)) AS Monthly,
						SUM(IF(a.InsuredPayMode=3,1,0)) AS Quarterly,
						SUM(IF(a.InsuredPayMode=4,1,0)) AS SemiAnnual,
						SUM(IF(a.InsuredPayMode=1,1,0)) AS Annual
					FROM t_gn_insured a
						LEFT JOIN t_gn_customer b ON a.CustomerId = b.CustomerId
					WHERE 1=1
						AND DATE(b.CustomerUpdatedTs) >= '{$this ->start_date}'
						AND DATE(b.CustomerUpdatedTs) <= '{$this ->end_date}'
					GROUP BY b.CampaignId";
			$qry = $this->db->query($sql);
			foreach( $qry->result_assoc() as $rows )
			{
				$Paymode[$rows['CampaignId']]['Monthly'] = $rows['Monthly'];
				$Paymode[$rows['CampaignId']]['Quarterly'] = $rows['Quarterly'];
				$Paymode[$rows['CampaignId']]['SemiAnnual'] = $rows['SemiAnnual'];
				$Paymode[$rows['CampaignId']]['Annual'] = $rows['Annual'];
			}
			return $Paymode;
		}
		
		/* Fungsi QA Monitor */
		function _getQAMonitor( $param = null )
		{
			$QAMonitor = array();
			$sql = "SELECT
						a.CampaignId,
						SUM(IF(a.QaProsess=1,b.CustomerId,0)) Monitored,
						SUM(IF(a.CallReasonQue=1,1,0)) Verified,
						SUM(IF(a.CallReasonQue=2,1,0)) CasesFollowup,
						SUM(IF(a.CallReasonQue=2,d.ProductPlanPremium*12,0)) AS TarpFollowup,
						SUM(IF(a.CallReasonQue=3,1,0)) CasesReject,
						SUM(IF(a.CallReasonQue=3,d.ProductPlanPremium*12,0)) AS TarpReject
					FROM t_gn_customer a
						LEFT JOIN t_gn_insured b ON a.CustomerId = b.CustomerId
						LEFT JOIN t_gn_policy c ON b.PolicyId = c.PolicyId
						LEFT JOIN t_gn_productplan d ON c.ProductPlanId = d.ProductPlanId
					WHERE 1=1
						AND DATE(a.CustomerUpdatedTs) >= '{$this ->start_date}'
						AND DATE(a.CustomerUpdatedTs) <= '{$this ->end_date}'
					GROUP BY a.CampaignId";
			$qry = $this->db->query($sql);
			foreach( $qry->result_assoc() as $rows )
			{
				$QAMonitor[$rows['CampaignId']]['Monitored'] = $rows['Monitored'];
				$QAMonitor[$rows['CampaignId']]['Verified'] = $rows['Verified'];
				$QAMonitor[$rows['CampaignId']]['CasesFollowup'] = $rows['CasesFollowup'];
				$QAMonitor[$rows['CampaignId']]['TarpFollowup'] = $rows['TarpFollowup'];
				$QAMonitor[$rows['CampaignId']]['CasesReject'] = $rows['CasesReject'];
				$QAMonitor[$rows['CampaignId']]['TarpReject'] = $rows['TarpReject'];
			}
			return $QAMonitor;
		}
		
		/* Fungsi QA Monitor */
		function _getCancel( $param = null )
		{
			$Cancel = array();
			$sql = "SELECT
						a.CampaignId,
						SUM(IF(a.CallReasonId IN (37,38,39),1,0)) AS CasesCancel,
						SUM(IF(a.CallReasonId IN (37,38,39),d.ProductPlanPremium*12,0)) AS TarpCancel
					FROM t_gn_customer a
						LEFT JOIN t_gn_insured b ON a.CustomerId = b.CustomerId
						LEFT JOIN t_gn_policy c ON b.PolicyId = c.PolicyId
						LEFT JOIN t_gn_productplan d ON c.ProductPlanId = d.ProductPlanId
					WHERE 1=1
						AND DATE(a.CustomerUpdatedTs) >= '{$this ->start_date}'
						AND DATE(a.CustomerUpdatedTs) <= '{$this ->end_date}'
					GROUP BY a.CampaignId";
			$qry = $this->db->query($sql);
			foreach( $qry->result_assoc() as $rows )
			{
				$Cancel[$rows['CampaignId']]['CasesCancel'] = $rows['CasesCancel'];
				$Cancel[$rows['CampaignId']]['TarpCancel'] = $rows['TarpCancel'];
			}
			return $Cancel;
		}
	}
?>