<?php
	class M_ReportDownload extends EUI_Model
	{
		private static $instance = null;	

		function M_ReportDownload()
		{
			$this -> load ->model(array('M_Combo','M_SysUser'));
			$this -> start_date = _getDateEnglish( $this -> URI->_get_post('start_date')).' 00:00:00';
			$this -> end_date 	= _getDateEnglish( $this -> URI->_get_post('end_date')).' 23:59:59';
			$date_old_end		= $this -> end_date - 1;
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
				'download' => 'Download'
				// 'redownload' => 'Redownload'
			);
		}
		
		function filter_by($Filter__ = null)
		{
			$Filter = array();
			$this -> db -> select("a.CampaignId, a.CampaignDesc");
			$this -> db -> from("t_gn_campaign a");
			$this -> db -> where("a.CampaignStatusFlag",1);
			
			foreach($this -> db -> get() -> result_assoc() as $rows)
			{
				$Filter[$rows['CampaignId']] = $rows['CampaignDesc'];
			}
			return $Filter;
		}
		
		/* Fungsi Index */
		function _getCampaign( $param = null )
		{
			$Campaign = array();
			$sql = "SELECT a.CampaignId, a.CampaignCode, a.CampaignDesc
					FROM t_gn_campaign a
					WHERE a.CampaignId = $param";
			$qry = $this->db->query($sql);
			// echo "<pre>$sql</pre>";
			foreach( $qry->result_assoc() as $rows )
			{
				$Campaign[$rows['CampaignId']]['CampaignCode'] = $rows['CampaignCode'];
				$Campaign[$rows['CampaignId']]['CampaignDesc'] = $rows['CampaignDesc'];
			}
			return $Campaign;
		}
		
		function _getCampaignName($campaignid=null){
			$Campaign = array();
			$sql = "SELECT a.CampaignId, a.CampaignName
					FROM t_gn_campaign a
					WHERE a.CampaignId = $campaignid";
			$qry = $this->db->query($sql);
			// echo "<pre>$sql</pre>";
			foreach( $qry->result_assoc() as $rows )
			{
				$Campaign[$rows['CampaignId']]['CampaignCode'] = $rows['CampaignCode'];
				$Campaign[$rows['CampaignId']]['CampaignName'] = $rows['CampaignName'];
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
		
		function _setStatusDownload($customerID = NULL)
		{
			if(is_array($customerID)){
				// print_r($customerID);
				foreach($customerID as $key => $custID){
					// echo $custID;
					// echo "<br\>";
					$_set['flag_export']= 1;
					$_set['export_date']= date("Y-m-d h:i:s");
					$_where['CustomerId']= $custID;

					$this -> db -> where($_where);
					$this -> db -> update('t_gn_customer', $_set);
					$_ret = $this-> db -> affected_rows();
					// return $_ret;
				}
			}
		}
		
		/* Fungsi New Flexi */
		function flexi( $param = null )
		{
			$Index = array();
			$sql = "select a.CustomerId, date_format(a.CreateDate,'%m/%d/%Y') as CreateDate,
					d.CustomerFirstName, a.Custno, a.Acct, a.Cardno,
					concat('UA',c.id,'CAFLC') as SFID,
					a.STPID, a.NameOnCard, a.FlexiMktCode, a.FlexiLimit, b.PROD as ProdType, a.NeedNPWP,
					a.BenefAccount, a.BenefName, e.BankName, a.BenefBranch, a.TaxIdNumber,
					a.Loan, a.Tenor, a.Rate, a.AdditionalHPhone, a.AdditionalOPhone, a.AdditionalMPhone,
					concat(d.Recsource,b.ref_accno) as GHI, d.mkt_code,
					a.PunyaNPWP, a.SubmitNPWP, a.HomePhone, a.OfficePhone, d.CustomerMobilePhoneNum as MobilePhone
					FROM t_gn_frm_flexi a
					left join t_gn_attr_flexi b ON a.CustomerId = b.CustomerId
					left join t_gn_customer d ON b.CustomerId = d.CustomerId
					left join tms_agent c ON a.CreateBy = c.UserId
					left join t_lk_bank e ON a.BenefBank = e.BankId
					WHERE 1=1 AND DLFlage = 0 AND d.CallReasonId = 13
					AND
						case
							when a.vartiering < 100 then d.CallReasonQue = 1
							else 1=1
						end
					AND d.CustomerUpdatedTs >= '{$this ->start_date}'
					AND d.CustomerUpdatedTs <= '{$this ->end_date}'";
			// echo $sql;
			$qry = $this->db->query($sql);
			$i=0;
			foreach( $qry->result_assoc() as $rows )
			{
				$exportCID[$rows['CustomerId']] = $rows['CustomerId'];
				$Index[$i]['CreateDate']	= $rows['CreateDate'];
				$Index[$i]['Name']	= $rows['CustomerFirstName'];
				$Index[$i]['Custno']		= $rows['Custno'];
				$Index[$i]['Acct']			= $rows['Acct'];
				$Index[$i]['Cardno']		= $rows['Cardno'];
				$Index[$i]['SFID']			= $rows['SFID'];
				$Index[$i]['STPID']			= $rows['STPID'];
				$Index[$i]['NameOnCard']	= $rows['NameOnCard'];
				$Index[$i]['FlexiMktCode']	= $rows['mkt_code'];
				$Index[$i]['FlexiLimit']	= $rows['FlexiLimit'];
				$Index[$i]['ProdType']		= $rows['ProdType'];
				$Index[$i]['NeedNPWP']		= $rows['NeedNPWP'];
				$Index[$i]['BenefAccount']	= $rows['BenefAccount'];
				$Index[$i]['BenefName']		= $rows['BenefName'];
				$Index[$i]['BenefBank']		= $rows['BankName'];
				$Index[$i]['BenefBranch']	= $rows['BenefBranch'];
				$Index[$i]['TaxIdNumber']	= $rows['TaxIdNumber'];
				$Index[$i]['Loan']			= $rows['Loan'];
				$Index[$i]['Tenor']			= $rows['Tenor'];
				$Index[$i]['Rate']			= $rows['Rate'];
				$Index[$i]['AdditionalHPhone'] = $rows['AdditionalHPhone'];
				$Index[$i]['AdditionalOPhone'] = $rows['AdditionalOPhone'];
				$Index[$i]['AdditionalMPhone'] = $rows['AdditionalMPhone'];
				$Index[$i]['GHI']			= $rows['GHI'];
				$Index[$i]['PunyaNPWP']		= $rows['PunyaNPWP'];
				$Index[$i]['SubmitNPWP']	= $rows['SubmitNPWP'];
				$Index[$i]['HomePhone']		= $rows['HomePhone'];
				$Index[$i]['OfficePhone']	= $rows['OfficePhone'];
				$Index[$i]['MobilePhone']	= $rows['MobilePhone'];
				$i++;
			}
			$this->_setStatusDownload($exportCID);
			return $Index;
		}
		
		/* Fungsi New PIL XSEL */
		function pilxsell( $param = null )
		{
			$Index = array();
			$sql = "SELECT Concat('UT',d.id,'PA999') as 'SalesForceID', a.PilProtection,
						a.CustomerId, a.BenefName, a.BenefAccount, e.BankName, a.BenefBranch, a.Loan,
						a.Tenor, a.AdditionalHPhone, a.AdditionalOPhone, a.AdditionalMPhone, a.Rate,
						b.mkt_code, a.NeedNPWP, 
						concat(c.Recsource,b.ref_accno) as GHI,
						a.Cardno, a.Custno, 'N' as pilpro, a.PunyaNPWP, a.SubmitNPWP,
						c.CustomerHomePhoneNum, c.CustomerWorkPhoneNum, c.CustomerMobilePhoneNum, DATE_FORMAT(a.CreateDate,'%m/%d/%Y') as CreateDate, b.Prod_Type as ProdType, 'IncomeDocCollect'
					FROM t_gn_frm_pil_xsel a
					left join t_gn_attr_pil_xsell b ON a.CustomerId = b.CustomerId
					left join t_gn_customer c ON b.CustomerId = c.CustomerId
					left join tms_agent d ON a.CreateBy = d.UserId
					left join t_lk_bank e ON a.BenefBank = e.BankId
					WHERE 1=1 AND DLFlage = 0  AND c.CallReasonId = 13
					AND
						case
							when a.vartiering < 100 then c.CallReasonQue = 1
							else 1=1
						end
					AND c.CustomerUpdatedTs >= '{$this ->start_date}'
					AND c.CustomerUpdatedTs <= '{$this ->end_date}'";
			// echo $sql;
			$qry = $this->db->query($sql);
			$i=0;
			foreach( $qry->result_assoc() as $rows )
			{
				$exportCID[$rows['CustomerId']] = $rows['CustomerId'];
				$Index[$i]['SalesForceID']	= $rows['SalesForceID'];
				$Index[$i]['BenefName']		= $rows['BenefName'];
				$Index[$i]['BenefAccount']	= $rows['BenefAccount'];
				$Index[$i]['BenefBank']		= $rows['BankName'];
				$Index[$i]['BenefBranch']	= $rows['BenefBranch'];
				$Index[$i]['Loan']			= $rows['Loan'];
				$Index[$i]['Tenor']			= $rows['Tenor'];
				$Index[$i]['AdditionalHPhone']	= $rows['AdditionalHPhone'];
				$Index[$i]['AdditionalOPhone']	= $rows['AdditionalOPhone'];
				$Index[$i]['AdditionalMPhone']	= $rows['AdditionalMPhone'];
				$Index[$i]['Rate']		= $rows['Rate'];
				$Index[$i]['mkt_code']		= $rows['mkt_code'];
				$Index[$i]['NeedNPWP']	= $rows['NeedNPWP'];
				$Index[$i]['GHI']		= $rows['GHI'];
				$Index[$i]['Cardno']		= $rows['Cardno'];
				$Index[$i]['Custno']	= $rows['Custno'];
				$Index[$i]['pilpro']	= $rows['PilProtection'];
				$Index[$i]['PunyaNPWP']			= $rows['PunyaNPWP'];
				$Index[$i]['SubmitNPWP']			= $rows['SubmitNPWP'];
				$Index[$i]['HomePhone']			= $rows['CustomerHomePhoneNum'];
				$Index[$i]['OfficePhone'] = $rows['CustomerWorkPhoneNum'];
				$Index[$i]['MobilePhone'] = $rows['CustomerMobilePhoneNum'];
				$Index[$i]['CreateDate'] = $rows['CreateDate'];
				$Index[$i]['ProdType']			= $rows['ProdType'];
				$Index[$i]['IncomeDocCollect']		= $rows['IncomeDocCollect'];
				$i++;
			}
			$this->_setStatusDownload($exportCID);
			return $Index;
		}
		
		/* Fungsi New PIL TOPUP */
		function piltopup( $param = null )
		{
			$Index = array();
			$sql = "SELECT concat(b.Recsource,a.Custno) as vCustID,
					a.CustomerId,
					b.SSVNO,
					b.NAME as FirstName,
					a.LastName,
					a.Tenor,
					a.Loan,
					a.Rate,
					c.RateCode,
					a.BenefName,
					a.BenefBank,
					a.BenefAccount,
					a.BenefBranch,
					a.NewBenefName,
					f.BankName as NewBenefBank,
					a.NewBenefAccount,
					a.NewBenefBranch,
					a.FGroup,
					date_format(a.CreateDate,'%m/%d/%Y') as CreateDate,
					a.vTenorID,
					a.DLFlage,
					date_format(curdate(),'%d/%m/%Y') as DownlDate,
					'' as CHGADDHOME,
					'' as CHGHOMENO,
					'' as CHGADDOFFICE,
					'' as CHGOFFICENO,
					'' as CHGMOBILENO,
					d.id as CreateBy,
					a.SubmitNPWP,
					a.PilProtection
					FROM t_gn_frm_pil_topup a
					left join t_gn_attr_pil_topup b ON a.CustomerId = b.CustomerId
					left join t_gn_loan_tiering c ON a.CustomerId = c.CustomerId and a.Rate = c.Rate and a.Tenor = c.Tenor
					left join tms_agent d ON a.CreateBy = d.UserId
					left join t_gn_customer e ON a.CustomerId = e.CustomerId
					left join t_lk_bank f ON a.NewBenefBank = f.BankId
					WHERE 1=1 AND DLFlage = 0 AND e.CallReasonId = 13
					AND e.CustomerUpdatedTs >= '{$this ->start_date}'
					AND e.CustomerUpdatedTs <= '{$this ->end_date}'";
			$qry = $this->db->query($sql);
			$i=0;
			foreach( $qry->result_assoc() as $rows )
			{
				$exportCID[$rows['CustomerId']] = $rows['CustomerId'];
				$Index[$i]['vCustID']	= $rows['vCustID'];
				$Index[$i]['SSVNO']		= $rows['SSVNO'];
				$Index[$i]['FirstName']	= $rows['FirstName'];
				$Index[$i]['LastName']	= $rows['LastName'];
				$Index[$i]['Tenor']		= $rows['Tenor'];
				$Index[$i]['Loan']		= $rows['Loan'];
				$Index[$i]['Rate']		= $rows['Rate'];
				$Index[$i]['RateCode']	= $rows['RateCode'];
				$Index[$i]['BenefName']	= $rows['BenefName'];
				$Index[$i]['BenefBank']	= $rows['BenefBank'];
				$Index[$i]['BenefAccount']	= $rows['BenefAccount'];
				$Index[$i]['BenefBranch']	= $rows['BenefBranch'];
				$Index[$i]['NewBenefName']	= $rows['NewBenefName'];
				$Index[$i]['NewBenefBank']	= $rows['NewBenefBank'];
				$Index[$i]['NewBenefAccount']	= $rows['NewBenefAccount'];
				$Index[$i]['NewBenefBranch']	= $rows['NewBenefBranch'];
				$Index[$i]['FGroup']		= $rows['FGroup'];
				$Index[$i]['CreateDate']	= $rows['CreateDate'];
				$Index[$i]['DLFlage']		= $rows['DLFlage'];
				$Index[$i]['DownlDate']		= $rows['DownlDate'];
				$Index[$i]['CHGADDHOME']	= $rows['CHGADDHOME'];
				$Index[$i]['CHGHOMENO']		= $rows['CHGHOMENO'];
				$Index[$i]['CHGADDOFFICE']	= $rows['CHGADDOFFICE'];
				$Index[$i]['CHGOFFICENO']	= $rows['CHGOFFICENO'];
				$Index[$i]['CHGMOBILENO']	= $rows['CHGMOBILENO'];
				$Index[$i]['CreateBy']		= $rows['CreateBy'];
				$Index[$i]['SubmitNPWP']	= $rows['SubmitNPWP'];
				$Index[$i]['PilProtection']	= $rows['PilProtection'];
				$i++;
			}
			$this->_setStatusDownload($exportCID);
			return $Index;
		}
		
		function _reDownload( $param = null )
		{
			$Index = array();
			$sql = "select a.CustomerId,a.CampaignId,b.PROD,
					concat(a.Recsource,b.REFNO) as URN,
					'CREDIT_CARD_EXPIRY_DATE',
					g.CampaignPlanName as PLAN,
					sum(if(c.name_main='',0,1)+if(c.name_spouse='',0,1)+if(c.name_c1='',0,1)+if(c.name_c2='',0,1)+if(c.name_c3='',0,1)) as COVERAGE,
					c.monthly_premium as PREMIUM,
					e.id as SELLERID,
					a.CustomerFirstName as NAME_1,
					a.CustomerDOB as DOB_1,
					a.CustomerAddressLine1 as ADDR1,
					a.CustomerAddressLine2 as ADDR2,
					a.CustomerAddressLine3 as ADDR3,
					b.AREA2 as CITY,
					a.CustomerZipCode as ZIP,
					'BENEF_1',
					'RELATIONSHIP_INFORMATION_1',
					'BENEF_2',
					'RELATIONSHIP_INFORMATION_2',
					'BENEF_3',
					'RELATIONSHIP_INFORMATION_3',
					c.create_date as SALESDATE,
					c.name_spouse as NAME_2,
					c.sex_spouse as SEX_2,
					c.dob_spouse as DOB_2,
					c.name_c1 as NAME_3,
					c.sex_c1 as SEX_3,
					c.dob_c1 as DOB_3,
					c.name_c2 as NAME_4,
					c.sex_c2 as SEX_4,
					c.dob_c2 as DOB_4,
					c.name_c3 as NAME_5,
					c.sex_c3 as SEX_5,
					c.dob_c3 as DOB_5,
					'REF',
					a.CustomerMobilePhoneNum as MOBILE_PHONE,
					a.CustomerWorkPhoneNum as OFFICE_PHONE,
					a.CustomerHomePhoneNum as HOME_PHONE
					FROM t_gn_customer a
					left join t_gn_attr_hospin b ON a.CustomerId = b.CustomerId
					left join t_gn_frm_hospin c ON a.CustomerId = c.CustomerId
					left join t_gn_assignment d ON a.CustomerId = d.CustomerId
					left join tms_agent e ON d.AssignSelerId = e.UserId
					left join t_gn_campaign f ON a.CampaignId = f.CampaignId
					left join t_gn_plan_campaign g ON c.plan = g.Id and a.CampaignId = g.CampaignId
					WHERE 1=1
						AND a.CallReasonQue = 1
						AND a.CustomerRejectedDate >= '{$this ->start_date}'
						AND a.CustomerRejectedDate <= '{$this ->end_date}'
						group by a.CustomerId;
					";
			// echo $sql;
			$qry = $this->db->query($sql);
			$i=0;
			foreach( $qry->result_assoc() as $rows )
			{
				$Index[$i]['PROD'] = $rows['PROD'];
				$Index[$i]['URN'] = $rows['URN'];
				$Index[$i]['CREDIT_CARD_EXPIRY_DATE'] = "";
				$Index[$i]['PLAN'] = $rows['PLAN'];
				$Index[$i]['COVERAGE'] = $rows['COVERAGE'];
				$Index[$i]['PREMIUM'] = $rows['PREMIUM'];
				$Index[$i]['SELLERID'] = $rows['SELLERID'];
				$Index[$i]['NAME_1'] = $rows['NAME_1'];
				$Index[$i]['DOB_1'] = $rows['DOB_1'];
				$Index[$i]['ADDR1'] = $rows['ADDR1'];
				$Index[$i]['ADDR2'] = $rows['ADDR2'];
				$Index[$i]['ADDR3'] = $rows['ADDR3'];
				$Index[$i]['CITY'] = $rows['CITY'];
				$Index[$i]['ZIP'] = $rows['ZIP'];
				$Index[$i]['BENEF_1'] = "";
				$Index[$i]['RELATIONSHIP_INFORMATION_1'] = "";
				$Index[$i]['BENEF_2'] = "";
				$Index[$i]['RELATIONSHIP_INFORMATION_2'] = "";
				$Index[$i]['BENEF_3'] = "";
				$Index[$i]['RELATIONSHIP_INFORMATION_3'] = "";
				$Index[$i]['SALESDATE'] = $rows['SALESDATE'];
				$Index[$i]['NAME_2'] = $rows['NAME_2'];
				$Index[$i]['SEX_2'] = $rows['SEX_2'];
				$Index[$i]['DOB_2'] = $rows['DOB_2'];
				$Index[$i]['NAME_3'] = $rows['NAME_3'];
				$Index[$i]['SEX_3'] = $rows['SEX_3'];
				$Index[$i]['DOB_3'] = $rows['DOB_3'];
				$Index[$i]['NAME_4'] = $rows['NAME_4'];
				$Index[$i]['SEX_4'] = $rows['SEX_4'];
				$Index[$i]['DOB_4'] = $rows['DOB_4'];
				$Index[$i]['NAME_5'] = $rows['NAME_5'];
				$Index[$i]['SEX_5'] = $rows['SEX_5'];
				$Index[$i]['DOB_5'] = $rows['DOB_5'];
				$Index[$i]['REF'] = "";
				$Index[$i]['MOBILE_PHONE'] = $rows['MOBILE_PHONE'];
				$Index[$i]['OFFICE_PHONE'] = $rows['OFFICE_PHONE'];
				$Index[$i]['HOME_PHONE'] = $rows['HOME_PHONE'];
				$i++;
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
						AND a.CustomerUpdatedTs = '{$this ->end_date}'
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
						AND a.CustomerUpdatedTs >= '{$this ->start_date}'
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
			// $sql = "SELECT
						// a.CampaignId,
						// SUM(IF(c.PaymentCategory IN (1,2),1,0)) AS Kredit,
						// SUM(IF(c.PaymentCategory IN (1,2),f.ProductPlanPremium*12,0)) AnpKredit,
						// SUM(IF(c.PaymentCategory IN (3),1,0)) AS Debit,
						// SUM(IF(c.PaymentCategory IN (3),f.ProductPlanPremium*12,0)) AnpDebit,
						// 0 AS Transfer,
						// 0 AS AnpTransfer
					// FROM t_gn_customer a
						// LEFT JOIN t_gn_payer b ON a.CustomerId = b.CustomerId
						// LEFT JOIN t_lk_paymenttype c ON b.PaymentTypeId = c.PaymentTypeId
						// LEFT JOIN t_gn_policyautogen d ON b.CustomerId = d.CustomerId
						// LEFT JOIN t_gn_policy e ON d.PolicyNumber = e.PolicyNumber
						// LEFT JOIN t_gn_productplan f ON e.ProductPlanId = f.ProductPlanId
					// WHERE 1=1
					// AND DATE(a.CustomerUpdatedTs) >= '{$this ->start_date}'
					// AND DATE(a.CustomerUpdatedTs) <= '{$this ->end_date}'
					// GROUP BY a.CampaignId";
			// $qry = $this->db->query($sql);
			// foreach( $qry->result_assoc() as $rows )
			// {
				// $Payment[$rows['CampaignId']]['Kredit'] = $rows['Kredit'];
				// $Payment[$rows['CampaignId']]['AnpKredit'] = $rows['AnpKredit'];
				// $Payment[$rows['CampaignId']]['Debit'] = $rows['Debit'];
				// $Payment[$rows['CampaignId']]['AnpDebit'] = $rows['AnpDebit'];
				// $Payment[$rows['CampaignId']]['Transfer'] = $rows['Transfer'];
				// $Payment[$rows['CampaignId']]['AnpTransfer'] = $rows['AnpTransfer'];
			// }
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