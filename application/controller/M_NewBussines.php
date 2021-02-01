<?php
class M_NewBussines extends EUI_Model
{
	function M_NewBussines()
	{
		
	}
	
	function getPolicy()
	{
		$sql = "select
				tp.PolicyNumber as policy_id ,
				'' as policy_ref, 
					a.CustomerId as prospect_id, 
					c.ProductCode as product_id, 
					c.ProductCode as campaign_id, 
					d.CampaignCode as campaign_TBSS, 
					left(b.PayerCreatedTs,10) as input, 
					left(b.PayerCreatedTs,10) as effdt, 
					a.CustomerNumber as payer_cifno, 
					e.Salutation as payer_title, 
					b.PayerFirstName as payer_fname, 
					b.PayerLastName as payer_lname, 
					f.GenderCode as payer_sex, 
					b.PayerDOB as payer_dob, 
					g.AddrCode as addrtype, 
					b.PayerAddressLine1 as addr1, 
					b.PayerAddressLine2 as addr2, 
					b.PayerAddressLine3 as addr3, 
					b.PayerAddressLine4 as addr4, 
					b.PayerCity as city, 
					b.PayerZipCode as post, 
					h.ProvinceCode as province, 
					b.PayerHomePhoneNum as phone, 
					b.PayerFaxNum as faxphone, 
					b.PayerEmail as email, 
					i.PaymentTypeCode as pay_type, 
					'' as card_type, 
					'' as bank, 
					'' as branch, 
					'' as acctnum, 
					'' as ccexpdate, 
					k.PayModeCode as bill_freq, 
					'' as question1, 
					'' as question2, 
					'' as question3, 
					'' as question4, 
					'' as question5, 
					'' as benefit_level, 
					-- sum(l.PolicyPremi) as premium, 
					'' as nbi, 
					'N' as export, 
					left(now(),10) as exportdate, 
					'' as canceldate, 
					'' as callDate2, 
					'' as paystatus, 
					'' as paynotes, 
					'' as payauthcode, 
					'' as paytransdate, 
					'' as payorderno, 
					'' as payccnum, 
					'' as paycvv, 
					'' as payexpdate, 
					'' as paycurency, 
					'' as paycardtype, 
					m.IdentificationType as payer_idtype, 
					b.PayerIdentificationNum as payer_personalid, 
					b.PayerMobilePhoneNum as payer_mobilephone, 
					b.PayerOfficePhoneNum as payer_officephone, 
					'' as deliverydate, 
					'' as seperate_policy, 
					'' as 'status', 
					'' as payer_occupationid, 
					b.PayerPlaceOfBirth as payer_birthplace, 
					'' as payer_religionid, 
					'' as payer_income, 
					'' as payer_position, 
					'' as payer_company, 
					o.init_name as operid, 
					o.id as sellerid, 
					p.init_name as spv_id, 
					q.init_name as atm_id, 
					r.init_name as tsm_id, 
					a.CustomerNumber as pcifnumber, 
					'' as pcardtype, 
					'' as prefnumber, 
					b.PayerCreditCardNum as paccnumber, 
					'' as paccname, 
					'' as pcardnumber, 
					'' as record_id, 
					left(b.PayerCreatedTs,10) as calldate, 
					'' as phone2, 
					'' as payer_mobilephone2, 
					'' as payer_officephone2, 
					'' as policy_delivery, 
					'' as notification_delivery, 
					'' as is_allow_datasharing, 
					'' as is_allow_productoffering, 
					'' as customer_segment, 
					'' as isPEUW, 
					'' as ratetype_id
				from t_gn_customer a
				left join t_gn_policyautogen tp on tp.CustomerId=a.CustomerId
				left join t_gn_campaign d on d.CampaignId=a.CampaignId
				left join t_gn_payer b on a.CustomerId=b.CustomerId
				left join t_gn_product c on locate(c.ProductCode, b.PolicyNumber) > 0
				left join t_lk_salutation e on e.SalutationId=b.SalutationId
				left join t_lk_gender f on f.GenderId=b.GenderId
				left join t_lk_addr_type g on g.AddrId=b.PayerAddrType
				left join t_lk_province h on h.ProvinceId=b.ProvinceId
				left join t_lk_paymenttype i on i.PaymentTypeId=b.PaymentTypeId
				left join t_gn_insured j on j.CustomerId=b.CustomerId
				left join t_lk_paymode k on k.PayModeId=j.InsuredPayMode
				left join t_gn_policy l on l.PolicyNumber=b.PolicyNumber
				left join t_lk_identificationtype m on m.IdentificationTypeId=b.IdentificationTypeId
				left join t_gn_assignment n on n.CustomerId=a.CustomerId
				left join tms_agent o on o.UserId=n.AssignSelerId
				left join tms_agent p on p.UserId=n.AssignLeader
				left join tms_agent q on q.UserId=n.AssignSpv
				left join tms_agent r on r.UserId=n.AssignAmgr
				where a.CallReasonId in(35, 36, 37)";
		
		return $this->db->query($sql);
	}
	
	function getInsured()
	{
		$sql = "select 
					bv.PolicyNumber as policy_id, 
					IF(a.PremiumGroupId=2,1,
						IF(a.PremiumGroupId=4,2,
							(2+right(a.PolicyPrefix,1)))) as holder_id, 
					d.PremiumGroupCode as holder_type, 
					e.Salutation as holder_title, 
					a.InsuredFirstName as holder_fname, 
					a.InsuredLastName as holder_lname, 
					f.GenderCode as holder_sex, 
					a.InsuredDOB as holder_dob, 
					'' as holder_ssn, 
					g.RelationshipTypeCode as relation, 
					j.ProductPlanLevel as benefit_level, 
					h.PolicyPremi as premium, 
					'' as holder_race, 
					k.IdentificationTypeCode as holder_idtype, 
					'' as holder_issmoker, 
					'' as holder_nationality, 
					'' as holder_maritalstatus, 
					'' as holder_occupation, 
					'' as holder_jobtype, 
					'' as holder_position, 
					'' as holder_height, 
					'' as holder_weight, 
					'' as uwstatus, 
					'' as uwlastupdate, 
					'' as uwapprovedate, 
					'' as uwprintdate, 
					c1.ProductCode as product_id, 
					'' as rating_factor1, 
					'' as rating_factor2, 
					a.Place_of_Birth as holder_birthplace, 
					'' as remark
				from t_gn_insured a
				left join t_gn_customer b on b.CustomerId=a.CustomerId
				left join t_gn_policyautogen bv on b.CustomerId=bv.CustomerId
				left join t_gn_payer c on c.CustomerId=a.CustomerId
				left join t_gn_product c1 on locate(c1.ProductCode, c.PolicyNumber) > 0
				left join t_lk_premiumgroup d on d.PremiumGroupId=a.PremiumGroupId
				left join t_lk_salutation e on e.SalutationId=a.SalutationId
				left join t_lk_gender f on f.GenderId=a.GenderId
				left join t_lk_relationshiptype g on g.RelationshipTypeId=a.RelationshipTypeId
				left join t_gn_policy h on h.PolicyNumber=a.PolicyNumber and h.PolicyPrefix=a.PolicyPrefix
				left join t_gn_productplan i on i.ProductPlanId=h.ProductPlanId
				left join t_gn_plan_name j on j.ProductId=i.ProductId and j.ProductPlanId=i.ProductPlan
				left join t_lk_identificationtype k on k.IdentificationTypeId=a.IdentificationTypeId
				where b.CallReasonId in (35, 36, 37)
				GROUP BY b.CustomerId";
		
		return $this->db->query($sql);
	}
	
	function getBeneficiery()
	{
		$sql = "select
					a.PolicyNumber as policy_id, 
					IF(a1.PremiumGroupId=2,1,
						IF(a1.PremiumGroupId=4,2,
							(2+right(a1.PolicyPrefix,1)))) as holder_id, 
					a.BenefieceryPrefix as bnf_id, 
					a.BeneficiaryFirstName as bnf_fname, 
					a.BeneficiaryLastName as bnf_lname, 
					b.GenderCode as bnf_sex, 
					'' as bnf_ssn, 
					'' as bnf_bene_ind, 
					'' as bnf_client_type, 
					a.BeneficieryPercentage as bnf_percent, 
					'ALL' as bnf_coverage, 
					c.RelationshipTypeCode as bnf_relation, 
					a.BeneficiaryDOB as bnf_dob
				from t_gn_beneficiary a
				inner join t_gn_customer d on d.CustomerId=a.CustomerId
				left join t_gn_insured a1 on a1.InsuredId=a.InsuredId
				left join t_lk_gender b on a.GenderId=a.GenderId
				left join t_lk_relationshiptype c on c.RelationshipTypeId=a.RelationshipTypeId
				where d.CallReasonId in (35, 36, 37)
				GROUP BY d.CustomerId
				";
		
		return $this->db->query($sql);
	}
	
	function getQuestion()
	{
		$sql = "select 
					e.PolicyNumber as policy_id, 
					IF(a.PremiumGroupId=2,1,
						IF(a.PremiumGroupId=4,2,
							(2+right(a.PolicyPrefix,1)))) as holder_id, 
					uw.UWCode as questionid,
					uw.UWAnswer
				from t_gn_insured a
				left join t_gn_customer b on b.CustomerId=a.CustomerId
				left join t_gn_policyautogen e ON a.CustomerId=e.CustomerId
				left join t_gn_underwriting_answer uw on uw.UWInsuredId=a.InsuredId
				left join t_gn_payer c on c.CustomerId=a.CustomerId
				where b.CallReasonId in (35, 36, 37)";
		
		return $this->db->query($sql);
	}
}
?>