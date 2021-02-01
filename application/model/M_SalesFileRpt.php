<?php

class M_SalesFileRpt extends EUI_Model
{
	private $_payer_insured;
	private $_benef_insured;
	private $_other_insured;
	private $_sales_report;
	private $_payer_idx;
	private $_cover_code;

	public function __construct() {

	}

	public function __getDebugList() {
	}

	public function __getSalesList()
	{
		$this->_sales_report=array();
		
		$this->_load_payer();
		$this->_load_beneficiary();
		$this->CoverCode();

		$payer =  $this->_payer_insured;
		$ben = $this->_benef_insured;

		$_payer_idx=array();
		$_payer_only=array();
		foreach ($payer as $key => $pay) {
			$pay['cover_code'] = $this->_cover_code[$pay['CustomerId']];
			if($pay['InsuredId']) {
				$this->_sales_report[$pay['CustomerId']][$pay['InsuredId']][$pay['InsuredId']] = $pay;
				$_payer_idx[]=$pay['InsuredId'];
			}
			else {
				$pay['opt']='Y';
				$this->_sales_report[$pay['CustomerId']][0][0] = $pay;
			}
			$_payer_only[$pay['CustomerId']]= &$pay;

			// foreach ($ben as $key => $bnf) {
			// 	$this->_sales_report[$bnf['CustomerId']]['Payer'][$bnf['InsuredId']][$bnf['beneficiaryId']]=$bnf;
			// }
		}

		$this->_load_insured_other(implode(", ", $_payer_idx));
		
		$other = $this->_other_insured;
		foreach ($other as $key => $oth) {
			$oth['cover_code'] = $this->_cover_code[$oth['CustomerId']];

			$p = $_payer_only[$oth['CustomerId']];
			$oth['sob_code']=$p['sob_code'];
			$oth['SOBBranchCode']=$p['SOBBranchCode'];
			$oth['CampaignPrefix']=$p['CampaignPrefix'];
			$oth['spv_name']=$p['spv_name'];
			$oth['spv_code']=$p['spv_code'];
			$oth['tsr_name']=$p['tsr_name'];			
			$this->_sales_report[$oth['CustomerId']][$oth['InsuredId']][$oth['InsuredId']] = $oth;
			// foreach ($ben as $key => $bnf) {
			// 	$this->_sales_report[$bnf['CustomerId']]['Insured'][$bnf['InsuredId']][$bnf['InsuredId']]=$bnf;
			// }
		}

		// echo "<pre>";
		// print_r($other);
		// echo "</pre>";
		foreach ($ben as $key => $bnf) {
			$bnf['cover_code'] = $this->_cover_code[$bnf['CustomerId']];

			$p = $_payer_only[$bnf['CustomerId']];
			$i = $this->_sales_report[$bnf['CustomerId']][$bnf['InsuredId']][$bnf['InsuredId']];
			// echo "PolicyNumber ".$i['PolicyNumber'];
			$bnf['sob_code']=$p['sob_code'];
			$bnf['SOBBranchCode']=$p['SOBBranchCode'];
			$bnf['CampaignPrefix']=$p['CampaignPrefix'];
			$bnf['spv_name']=$p['spv_name'];
			$bnf['spv_code']=$p['spv_code'];
			$bnf['tsr_name']=$p['tsr_name'];
			$bnf['PolicyNumber']=$i['PolicyNumber'];
				
			$this->_sales_report[$bnf['CustomerId']][$bnf['InsuredId']][$bnf['beneficiaryId']]=$bnf;
		}



		return $this->_sales_report;
		
		// return $this->_benef_insured;
		// $this->_load_beneficiary();
		// $this->_load_insured_other();
		// return $this->_other_insured;
	}

	public function _load_payer()
	{
		$this->_payer_insured = array();
		$q="SELECT distinct
				p.PayerId,
				i.InsuredId,
				p.CustomerId,
				'1' record_type,
				p.PayerFirstName name,
				if(p.GenderId=1,'MALE', 'FEMALE') gender,
				DATE_FORMAT(p.PayerDOB,'%d/%m/%Y') dob, 
				p.PayerAddressLine1 addr1,
				p.PayerAddressLine2 addr2,
				p.PayerAddressLine3 addr3,
				p.PayerCity addr4,
				-- p.PayerHomePhoneNum hometel,
				CONCAT(IF(left(p.PayerHomePhoneNum,1)='0','+62',left(p.PayerHomePhoneNum,1)),
 					SUBSTR(p.PayerHomePhoneNum,2))  hometel,
				-- p.PayerOfficePhoneNum officetel,
				CONCAT(IF(left(p.PayerOfficePhoneNum,1)='0','+62',left(p.PayerOfficePhoneNum,1)),
 					SUBSTR(p.PayerOfficePhoneNum,2))  officetel,
				p.PayerZipCode postcode,
				p.PayerIdentificationNum idnum,
				p.PayerCreditCardNum cc,
				p.PayerCreditCardExpDate ccexp,
				t.PaymentTypeDesc acc_type,
				DATE_FORMAT(p.PayerCreatedTs,'%d/%m/%Y') sales_date,
				DATE_FORMAT(p.PayerCreatedTs,'%d/%m/%Y') eff_date,
				pr.ProductCode,
				pp.ProductPlanName,
				'' cover_code,
				m.PayMode,
				cam.CampaignCode,
				mc.MarketingCode TMCode,
				-- ag.full_name,
				-- left(c.Campaign_Master_Code,3) camp_code,
				mc.MarketingCode tm_code,
				'' x_ref,
				-- p.PayerMobilePhoneNum mobilenum,
				CONCAT(IF(left(p.PayerMobilePhoneNum,1)='0','+62',left(p.PayerMobilePhoneNum,1)),
 					SUBSTR(p.PayerMobilePhoneNum,2))  mobilenum,
				p.PayerFaxNum fax,
				p.PayerEmail email,
				'' opt,
				'' policy_num,
				DATE_FORMAT(p.PayerCreatedTs,'%d/%m/%Y') trans_eff,
				'' rapid_id,
				p.PayerMaritalStatus marital_status,
				cc.CommChannelDesc,
				'' benef_prosentase,
				'' benef_age,
				'' benef_relation,
				'' spouse_ind,
				'' anual_income,
				'' dep_spouse,
				'' dep_no_children,
				'' dep_other_dep,
				'' employment_status,
				'' education,
				oc.OccEnglish,
				'' cust_val_indicator,

				p.PayerFirstName payer_name,
				p.PayerIdentificationNum payer_id_num,
				bn.BankName,
				'' branch_code,
				'' office_code,
				'' contact_ref_code1,
				'' contact_ref_code2,
				'' contact_ref_code3,
				'' policy_ref_code1,
				'' policy_ref_code2,
				'' policy_ref_code3,
				'' race_type,
				'' contact_alternatif,

				addr.BilingDescription,
				prv.Province,
				'Indonesia' add_country,
				sal.Salutation contact_title,
				round(IF(po.PolicyPremi is null,po2.PolicyPremi,po.PolicyPremi)) PolicyPremi,
				IF(po.PolicyNumber is null,CONCAT(pa.PolicyNumber,'1'),po.PolicyNumber) PolicyNumber,
				DATE_FORMAT(p.PayerCreatedTs,'%d/%m/%Y') ApplicationDate,
				'' assign_policy_num,
				'Indonesian' nationality,
				'' contact_integrated_type,
				'' contact_alternatife_type,
				'' contact_surname,
				'' contact_middle_name,
				'' contact_rirst_name,
				i.Contact_Height,
				'' Contact_Height_Unit,
				i.Contact_Weight,
				'' Contact_Weight_Unit,
				IF(i.Dec_Q01_Answer='N','NO',IF(i.Dec_Q01_Answer='Y','YES',''))  Dec_Q01_Answer,
				IF(i.Dec_Q02_Answer='N','NO',IF(i.Dec_Q02_Answer='Y','YES',''))  Dec_Q02_Answer,
				IF(i.Dec_Q03_Answer='N','NO',IF(i.Dec_Q03_Answer='Y','YES',''))  Dec_Q03_Answer,
				IF(i.Dec_Q04_Answer='N','NO',IF(i.Dec_Q04_Answer='Y','YES',''))  Dec_Q04_Answer,
				IF(i.Dec_Q05_Answer='N','NO',IF(i.Dec_Q05_Answer='Y','YES',''))  Dec_Q05_Answer,

				i.Dec_Q01_Comments,
				i.Dec_Q02_Comments,
				i.Dec_Q03_Comments,
				i.Dec_Q04_Comments,
				i.Dec_Q05_Comments,
				'' Dec_Q06_Answer,
				'' Dec_Q06_Comments,
				'' Dec_Q07_Answer,
				'' Dec_Q07_Comments,
				'' Dec_Q08_Answer,
				'' Dec_Q08_Comments,
				'' Dec_Q09_Answer,
				'' Dec_Q09_Comments,
				'' Dec_Q10_Answer,
				'' Dec_Q10_Comments,
				'' UNW_Action_Code,
				'' UNW_Action_Reason,
				'' UNW_Completed_Date,
				'' UNW_Reject_Reason,
				'' UNW_Reject_Occupation,
				'' UNW_Reject_Age,
				'' UNW_Reject_MIB,
				'' UNW_Reject_Medical,
				'' Business_Market_Code,
				'TRUE' primary_add_tag,
				'' primary_add_tag2,
				'' Address_Type_2,
				'' Address_1_–_Type2,
				'' Address_2_–_Type_2,
				'' Address_3_–_Type_2,
				'' Address_4_–_Type_2,
				'' Postcode_–_Type_2,
				'' Address_State_–_Type_2,
				'' Address_Country_–_Type_2,

				pb.ProductPlanBenefit basic_face_amount,
				'' NameTypeIndicator,
				i.Place_of_Birth pob,
				tsr.full_name tsr_name,
				spv.id spv_code,
				spv.full_name spv_name,
				'' e_full_indicator,
				'' dmc_contact,
				p.PayerAdditionalPhone1,
				p.PayerAdditionalPhone2,
				right(oc.OccCode,1) occ_class,
				'' smoking_status,
				'' Religion,
				'' ClientNumber,
				'' CIF,
				right(pr.ProductCode,3) sob_code,
				sob.SOBBranchCode,
				sob.CampaignPrefix
				from t_gn_payer p
				left join t_lk_paymenttype t on t.PaymentTypeId=p.PaymentTypeId
				left join t_gn_policyautogen pa on pa.CustomerId=p.CustomerId and pa.MemberGroup=2
				left join t_gn_product pr on pr.ProductId=pa.ProductId
				left join t_gn_insured i 
					on i.CustomerId=p.CustomerId  and i.InsuredDOB=p.PayerDOB
				left join t_gn_policy po on po.PolicyId=i.PolicyId
				left join t_gn_productplan pp on pp.ProductPlanId=po.ProductPlanId
				left join t_gn_insured i2 on i2.CustomerId=p.CustomerId and i2.PremiumGroupId=2
				left join t_gn_policy po2 on po2.PolicyId=i2.PolicyId
				left join t_lk_paymode m on m.PayModeId=i2.InsuredPayMode
				left join t_gn_customer c on c.CustomerId=p.CustomerId
				left join t_gn_assignment ass on ass.CustomerId=c.CustomerId
				left join tms_agent tsr on tsr.UserId=ass.AssignSelerId
				left join tms_agent spv on spv.UserId=ass.AssignLeader
				left join t_gn_campaign cam on cam.CampaignId=c.CampaignId
				left join t_lk_marketing_code mc on mc.AgentId=tsr.id and mc.CampaignCode=left(cam.CampaignCode,3)
				left join t_lk_communications_channel cc on cc.CommChannelId=p.PayerPreferedComunication
				left join t_lk_occupation_code oc on oc.OccId=i.Occupational_Category
				left join t_lk_bank bn on bn.BankId=p.PayersBankId
				left join t_lk_addr_type addr on addr.BilingId=p.PayerAddrType
				left join t_lk_province prv on prv.ProvinceId= p.ProvinceId
				left join t_lk_salutation sal on sal.SalutationId=p.SalutationId
				left join t_gn_productplanbenefit pb on pb.ProductId=pp.ProductId and pb.ProductPlan=pp.ProductPlan
				-- left join t_lk_smoking sm on sm.SmokingId=i.Smoking_Status
				left join t_lk_sob_branch sob on sob.CampaignPrefix=left(cam.CampaignCode,3)
				where c.CallReasonQue=1 
				and c.CallReasonId in (27, 28, 29, 30, 31)
				and c.CampaignId>=4 
				and date(c.CustomerUpdatedTs) = '2014-09-18'
				-- date(now()-interval 1 day) 
				";

		$result=mysql_query($q);

		while ($row = mysql_fetch_array($result)) {
		   $this->_payer_insured[$row['PayerId']]=$row;
		}

	}



	public function _load_beneficiary()
	{
		$this->_benef_insured = array();
		$q="SELECT 
			ben.beneficiaryId,
			ben.CustomerId,
			ben.InsuredId,
			'4' record_type,
			ben.BeneficiaryFirstName name,
			gen.Gender gender,
			DATE_FORMAT(ben.BeneficiaryDOB,'%d/%m/%Y') dob, 
			ben.BeneficiaryAddressLine1 addr1,
			ben.BeneficiaryAddressLine2 addr2,
			ben.BeneficiaryAddressLine3 addr3,
			ben.BeneficiaryCity addr4,
			ben.BeneficiaryHomePhoneNum hometel,
			ben.BeneficiaryWorkPhoneNum officetel,
			ben.BeneficiaryZipCode postcode,
			ben.BeneficiaryIdentificationNum idnum,
			'' cc,
			'' ccexp,
			'' acc_type,
			'' sales_date,
			'' eff_date,
			'' ProductCode,
			'' ProductPlanName,
			'' cover_code,
			'' PayMode,
			'' CampaignCode,
			'' tm_code,
			'' x_ref,
			'' mobilenum,
			'' fax,
			'' email,
			'' opt,
			'' policy_num,
			'' trans_eff,
			'' rapid_id,
			'' marital_status,
			'' CommChannelDesc,
			'' benef_prosentase,
			BeneficiaryAge benef_age,
			rel.RelationshipTypeDesc benef_relation,
			'' spouse_ind,
			'' anual_income,
			'' dep_spouse,
			'' dep_no_children,
			'' dep_other_dep,
			'' employment_status,
			'' education,
			'' OccEnglish,
			'' cust_val_indicator,
			'' payer_name,
			'' payer_id_num,
			'' BankName,
			'' branch_code,
			'' office_code,
			'' contact_ref_code1,
			'' contact_ref_code2,
			'' contact_ref_code3,
			'' policy_ref_code1,
			'' policy_ref_code2,
			'' policy_ref_code3,
			'' race_type,
			'' contact_alternatif,
			'' BilingDescription,
			'' Province,
			'' add_country,
			'' contact_title,
			'' PolicyPremi,
			'' PolicyNumber,
			'' ApplicationDate,
			'' assign_policy_num,
			'' nationality,
			'' contact_integrated_type,
			'' contact_alternatife_type,
			'' contact_surname,
			'' contact_middle_name,
			'' contact_rirst_name,
			'' Contact_Height,
			'' Contact_Height_Unit,
			'' Contact_Weight,
			'' Contact_Weight_Unit,
			'' Dec_Q01_Answer,
			'' Dec_Q01_Comments,
			'' Dec_Q02_Answer,
			'' Dec_Q02_Comments,
			'' Dec_Q03_Answer,
			'' Dec_Q03_Comments,
			'' Dec_Q04_Answer,
			'' Dec_Q04_Comments,
			'' Dec_Q05_Answer,
			'' Dec_Q05_Comments,
			'' Dec_Q06_Answer,
			'' Dec_Q06_Comments,
			'' Dec_Q07_Answer,
			'' Dec_Q07_Comments,
			'' Dec_Q08_Answer,
			'' Dec_Q08_Comments,
			'' Dec_Q09_Answer,
			'' Dec_Q09_Comments,
			'' Dec_Q10_Answer,
			'' Dec_Q10_Comments,
			'' UNW_Action_Code,
			'' UNW_Action_Reason,
			'' UNW_Completed_Date,
			'' UNW_Reject_Reason,
			'' UNW_Reject_Occupation,
			'' UNW_Reject_Age,
			'' UNW_Reject_MIB,
			'' UNW_Reject_Medical,
			'' Business_Market_Code,
			'' primary_add_tag,
			'' primary_add_tag2,
			'' Address_Type_2,
			'' Address_1_–_Type2,
			'' Address_2_–_Type_2,
			'' Address_3_–_Type_2,
			'' Address_4_–_Type_2,
			'' Postcode_–_Type_2,
			'' Address_State_–_Type_2,
			'' Address_Country_–_Type_2,
			'' basic_face_amount,
			'' NameTypeIndicator,
			'' pob,
			'' tsr_name,
			'' spv_code,
			'' spv_name,
			'' e_full_indicator,
			'' dmc_contact,
			'' PayerAdditionalPhone1,
			'' PayerAdditionalPhone2,
			'' occ_class,
			'' smoking_status,
			'' Religion,
			'' ClientNumber,
			'' CIF,
			'' sob_code,
			'' SOBBranchCode,
			'' CampaignPrefix

			from t_gn_beneficiary ben
			left join t_lk_gender gen on gen.GenderId=ben.GenderId
			left join t_lk_relationshiptype rel on rel.RelationshipTypeId=ben.RelationshipTypeId
			left join t_gn_customer cus on cus.CustomerId=ben.CustomerId
			where cus.CallReasonQue=1 
			and cus.CallReasonId in (27, 28, 29, 30, 31)
			and cus.CampaignId>=4 
			and date(cus.CustomerUpdatedTs)='2014-09-18' 
			";

		$result=mysql_query($q);

		while ($row = mysql_fetch_array($result)) {
		   $this->_benef_insured[$row['beneficiaryId']]=$row;
		}
	}

	public function _load_insured_other($idx)
	{
		$this->_other_insured = array();
		$q="SELECT distinct
			p.CustomerId,
			p.InsuredId,
			'2' record_type,
			p.InsuredFirstName name,
			if(p.GenderId=1,'MALE', 'FEMALE') gender,
			DATE_FORMAT(p.InsuredDOB,'%d/%m/%Y') dob,
			'' addr1,
			'' addr2,
			'' addr3,
			'' addr4,
			'' hometel,
			'' officetel,
			'' postcode,
			'' idnum,
			'' cc,
			'' ccexp,
			'' acc_type,
			DATE_FORMAT(p.InsuredCreatedTs,'%d/%m/%Y') sales_date,
			DATE_FORMAT(p.InsuredCreatedTs,'%d/%m/%Y') eff_date,

			'' ProductCode,

			pp.ProductPlanName ProductPlanName,
			'' cover_code,
			m.PayMode PayMode,
			'' CampaignCode,
			'' tm_code,
			'' x_ref,
			'' mobilenum,
			'' fax,
			'' email,
			'' opt,
			'' policy_num,
			'' trans_eff,
			'' rapid_id,
			ms.MaritalStatusDesc marital_status,
			'' CommChannelDesc,
			'' benef_prosentase,
			'' benef_age,
			'' benef_relation,
			'' spouse_ind,
			'' anual_income,
			'' dep_spouse,
			'' dep_no_children,
			'' dep_other_dep,
			'' employment_status,
			'' education,

			oc.OccEnglish OccEnglish,
			'' cust_val_indicator,
			'' payer_name,
			'' payer_id_num,
			'' BankName,
			'' branch_code,
			'' office_code,
			'' contact_ref_code1,
			'' contact_ref_code2,
			'' contact_ref_code3,
			'' policy_ref_code1,
			'' policy_ref_code2,
			'' policy_ref_code3,
			'' race_type,
			'' contact_alternatif,
			'' BilingDescription,
			'' Province,

			'INDONESIA' add_country,
			sal.Salutation contact_title,
			ROUND(po.PolicyPremi) PolicyPremi,
			pa.PolicyNumber,
			DATE_FORMAT(p.InsuredCreatedTs,'%d/%m/%Y') ApplicationDate,
			'' assign_policy_num,
			'Indonesian' nationality,
			'' contact_integrated_type,
			'' contact_alternatife_type,
			'' contact_surname,
			'' contact_middle_name,
			'' contact_rirst_name,
			p.Contact_Height Contact_Height,
			'' Contact_Height_Unit,
			p.Contact_Weight Contact_Weight,
			'' Contact_Weight_Unit,

			IF(p.Dec_Q01_Answer='N','NO',IF(p.Dec_Q01_Answer='Y','YES',''))  Dec_Q01_Answer,
			IF(p.Dec_Q02_Answer='N','NO',IF(p.Dec_Q02_Answer='Y','YES',''))  Dec_Q02_Answer,
			IF(p.Dec_Q03_Answer='N','NO',IF(p.Dec_Q03_Answer='Y','YES',''))  Dec_Q03_Answer,
			IF(p.Dec_Q04_Answer='N','NO',IF(p.Dec_Q04_Answer='Y','YES',''))  Dec_Q04_Answer,
			IF(p.Dec_Q05_Answer='N','NO',IF(p.Dec_Q05_Answer='Y','YES',''))  Dec_Q05_Answer,

			p.Dec_Q01_Comments,
			p.Dec_Q02_Comments,
			p.Dec_Q03_Comments,
			p.Dec_Q04_Comments,
			p.Dec_Q05_Comments,
			'' Dec_Q06_Answer,
			'' Dec_Q06_Comments,
			'' Dec_Q07_Answer,
			'' Dec_Q07_Comments,
			'' Dec_Q08_Answer,
			'' Dec_Q08_Comments,
			'' Dec_Q09_Answer,
			'' Dec_Q09_Comments,
			'' Dec_Q10_Answer,
			'' Dec_Q10_Comments,
			'' UNW_Action_Code,
			'' UNW_Action_Reason,
			'' UNW_Completed_Date,
			'' UNW_Reject_Reason,
			'' UNW_Reject_Occupation,
			'' UNW_Reject_Age,
			'' UNW_Reject_MIB,
			'' UNW_Reject_Medical,
			'' Business_Market_Code,
			'' primary_add_tag,
			'' primary_add_tag2,
			'' Address_Type_2,
			'' Address_1_–_Type2,
			'' Address_2_–_Type_2,
			'' Address_3_–_Type_2,
			'' Address_4_–_Type_2,
			'' Postcode_–_Type_2,
			'' Address_State_–_Type_2,
			'' Address_Country_–_Type_2,

			pb.ProductPlanBenefit basic_face_amount,
			'' NameTypeIndicator,
			p.Place_of_Birth pob,
			'' tsr_name,
			'' spv_code,
			'' spv_name,
			'' e_full_indicator,
			'' dmc_contact,
			'' PayerAdditionalPhone1,
			'' PayerAdditionalPhone2,

			right(oc.OccCode,1) occ_class,
			'' smoking_status,
			'' Religion,
			'' ClientNumber,
			'' CIF,
			'' sob_code,
			'' SOBBranchCode,
			'' CampaignPrefix

			from t_gn_insured p
			left join t_gn_policy po on po.PolicyId=p.PolicyId
			left join t_gn_policyautogen pa on pa.PolicyNumber  =po.PolicyNumber 
			left join t_lk_maritalstatus ms on ms.MaritalStatusId=p.Marital_Status
			left join t_lk_salutation sal on sal.SalutationId=p.SalutationId
			left join t_lk_occupation_code oc on oc.OccId=p.Occupational_Category
			left join t_gn_productplan pp on pp.ProductPlanId=po.ProductPlanId
			left join t_lk_paymode m on m.PayModeId=p.InsuredPayMode 
			left join t_gn_productplanbenefit pb on pb.ProductId=pp.ProductId and pb.ProductPlan=pp.ProductPlan
			-- left join t_lk_smoking sm on sm.SmokingId=p.Smoking_Status
			left join t_gn_customer cus on cus.CustomerId=p.CustomerId
			where cus.CallReasonQue=1 
			and cus.CampaignId>=4
			and cus.CallReasonId in (27, 28, 29, 30, 31)
			and date(cus.CustomerUpdatedTs) = '2014-09-18'
			and p.InsuredId not in (".$idx.")
			";

		$result=mysql_query($q);

		while ($row = mysql_fetch_array($result)) {
		   $this->_other_insured[$row['InsuredId']]=$row;
		}
	}

	public function _loadIndex()
	{
		//execute the SQL query and return records
		$result = mysql_query(" SELECT distinct f.MarketingCode spv_code, e.full_name spv_name, c.full_name, a.CustomerId, a.Campaign_Master_Code, d.MarketingCode 
								from t_gn_customer a
								-- inner join t_gn_policyautogen b on b.CustomerId=a.CustomerId
								left join tms_agent c on c.UserId=a.SellerId
								left join t_lk_marketing_code d on d.AgentId=c.id and d.CampaignCode=left(a.Campaign_Master_Code,3)
								left join tms_agent e on e.UserId=c.tl_id
								left join t_lk_marketing_code f on f.AgentId=e.id and f.CampaignCode=left(a.Campaign_Master_Code,3)
								where a.CallReasonId in (27, 28, 29, 30, 31)
								and a.CampaignId in (4) " );
		//fetch tha data from the database
		$this->_index=array();
		while ($row = mysql_fetch_array($result)) {
		   $this->_index[]=$row;
		}
	}



	public function _loadPolicyNumber()
	{
		//execute the SQL query and return records
		$result_policy = mysql_query("SELECT * from t_gn_policyautogen a " );
		//fetch tha data from the database
		$this->PolicyNumber=array();
		while ($row = mysql_fetch_array($result_policy)) {
		   $this->PolicyNumber[$row['CustomerId']]=$row;
		}
	}

	public function CoverCode()
	{
		$this->_cover_code=array();

		$q="SELECT a.CustomerId, count(b.InsuredId) cn, sum(b.PremiumGroupId) sm, 
			IF(count(b.InsuredId)=1 and sum(b.PremiumGroupId)=2,'Main Insured',
				IF(count(b.InsuredId)=2 and sum(b.PremiumGroupId)=5,'Main Insured & Spouse',
				IF(count(b.InsuredId)=2 and sum(b.PremiumGroupId)=3,'Main Insured & Child',
				'Family'))) cover_code
			from t_gn_customer a
			left join t_gn_insured b on b.CustomerId=a.CustomerId
			where a.CallReasonQue=1
			and a.CallReasonId in (27, 28, 29, 30, 31)
			and a.CampaignId>=4
			group by a.CustomerId
			";

		$result=mysql_query($q);

		while ($row = mysql_fetch_array($result)) {
		   $this->_cover_code[$row['CustomerId']]=$row['cover_code'];
		}
	}

	
 
}
