<?php
class M_ByCustomerNewBussines extends EUI_Model
{
	//var $start_date = '2016-03-07';

	public function getCountByDate ( $startdates = '' ) {

		$this->startdate = $startdates ; 
		$this->enddate = $enddate;

		$this->getcountdata = $this->db->query("
			select count(*) as totalClosing from t_gn_customer a
			inner join t_gn_policyautogen b on a.CustomerId=b.CustomerId
			where a.CallReasonQue='15' and
			date_format(a.QA_UpdateTs , '%Y-%m-%d')='$startdates'
		");
		$fetchCount = $this->getcountdata->row();
		$totalClosing = $fetchCount->totalClosing;

		if ( $fetchCount > 0 ) {
			return $totalClosing;
		} else {
			return 0;
		}


	}

	function getPolicy( $extractData = '' )
	{
		$sql = "select
					a.PolicyNumber as policy_id ,
					'' as policy_ref, 
					a.CustomerId as prospect_id, 
					e.ProductCode as product_id, 
					e.ProductCode as campaign_id, 
					c.CampaignCode as campaign_TBSS, 
					a2.PolicySalesDate as input, 
					a2.PolicyEffectiveDate as effdt, 
					b.CustomerNumber as payer_cifno, 
					f.Salutation as payer_title, 
					REPLACE(a3.PayerFirstName,'\t',' ') as payer_fname, 
					a3.PayerLastName as payer_lname, 
					g.GenderShortCode as payer_sex, 
					date_format(a3.PayerDOB,'%Y-%m-%d %T') as payer_dob, 
					h.AddrCode as addrtype, 
					REPLACE(a3.PayerAddressLine1,'\t',' ') as addr1, 
					#a3.PayerAddressLine1 as addr1, 
					REPLACE(a3.PayerAddressLine2,'\t',' ') as addr2, 
					REPLACE(a3.PayerAddressLine3,'\t',' ') as addr3, 
					REPLACE(a3.PayerAddressLine4,'\t',' ') as addr4, 
					a3.PayerCity as city, 
					a3.PayerZipCode as post, 
					i.ProvinceCode as province, 
					if(a3.PayerHomePhoneNum is not null,a3.PayerHomePhoneNum,b.CustomerHomePhoneNum) as phone, 
					a3.PayerFaxNum as faxphone, 
					a3.PayerEmail as email, 
					'DBB' as pay_type, 
					'' as card_type, 
					'' as bank, 
					'' as branch, 
					b.CustomerNumber as acctnum, 
					'' as ccexpdate, 
					k.PayModeCode as bill_freq, 
					'' as question1, 
					'' as question2, 
					'' as question3, 
					'' as question4, 
					'' as question5, 
					m.ProductPlanLevel as benefit_level, 
					SUM(FLOOR(a2.PolicyPremi)) as premium, 
					'' as nbi, 
					'N' as export, 
					now() as exportdate, 
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
					'' as payer_idtype, 
					a3.PayerIdentificationNum as payer_personalid, 
					if(a3.PayerMobilePhoneNum is not null,a3.PayerMobilePhoneNum,b.CustomerMobilePhoneNum) as payer_mobilephone, 
					if(a3.PayerOfficePhoneNum is not null,a3.PayerOfficePhoneNum,b.CustomerWorkPhoneNum) as payer_officephone, 
					'' as deliverydate, 
					'' as seperate_policy, 
					'1' as 'status', 
					'' as payer_occupationid, 
					a3.PayerPlaceOfBirth as payer_birthplace, 
					'' as payer_religionid, 
					'' as payer_income, 
					'' as payer_position, 
					'' as payer_company, 
					o.init_name as operid, 
					o.id as sellerid, 
					p.code_user as spv_id, 
					q.code_user as atm_id, 
					r.init_name as tsm_id, 
					b.CustomerNumber as pcifnumber, 
					'' as pcardtype, 
					'' as prefnumber, 
					a3.PayerCreditCardNum as paccnumber, 
					'' as paccname, 
					'' as pcardnumber, 
					(select ac.file_voc_name from cc_recording ac
						where 1=1 and ac.assignment_data = b.CustomerId
						group by ac.assignment_data having max(ac.duration)) as record_id, 
					b.CustomerUpdatedTs as calldate, 
					'' as phone2, 
					'' as payer_mobilephone2, 
					'' as payer_officephone2, 
					'' as policy_delivery, 
					'' as notification_delivery, 
					'' as is_allow_datasharing, 
					'' as is_allow_productoffering, 
					'' as customer_segment, 
					IF(l.PremiTypeId=1,'I','G') as ratetype_id, 
					'' as remark
				from t_gn_policyautogen a
				inner join t_gn_policy a2 on a.PolicyNumber = a2.PolicyNumber
				inner join t_gn_payer a3 on (a.PolicyNumber = a3.PolicyNumber and a.CustomerId = a3.CustomerId)
				inner join t_gn_insured a4 on (a3.PolicyNumber = a4.PolicyNumber and a3.PolicyPrefix = a4.PolicyPrefix)
				inner join t_gn_customer b on a.CustomerId = b.CustomerId
				inner join t_gn_assignment b2 on b.CustomerId=b2.CustomerId
				inner join t_gn_campaign c on b.CampaignId = c.CampaignId
				inner join t_gn_campaignproduct d on c.CampaignId = d.CampaignId
				inner join t_gn_product e on d.ProductId = e.ProductId
				#LOOKUP - LOOKUP
				left join t_lk_salutation f on a3.SalutationId = f.SalutationId
				left join t_lk_gender g on a3.GenderId = g.GenderId
				left join t_lk_addr_type h on h.AddrId = a3.PayerAddrType
				left join t_lk_province i on i.ProvinceId = a3.ProvinceId
				left join t_lk_paymenttype j on j.PaymentTypeId = a3.CreditCardTypeId
				left join t_lk_paymode k on k.PayModeId = a4.InsuredPayMode
				left join t_gn_productplan l on a2.ProductPlanId = l.ProductPlanId
				left join t_gn_plan_name m on l.ProductId = m.ProductId and l.ProductPlan = m.ProductPlanId
				left join tms_agent o on b2.AssignSelerId = o.UserId
				left join tms_agent p on b2.AssignLeader = p.UserId
				left join tms_agent q on b2.AssignSpv = q.UserId
				left join tms_agent r on b2.AssignAmgr = r.UserId
				#RECORDING
				#inner join t_gn_callhistory ch on (b.CustomerId = ch.CustomerId and b.CallReasonId = ch.CallReasonId and o.id = ch.AgentCode)
				#left join cc_recording rec on ch.CallSessionId = rec.session_key
				#where ch.CallBeforeReasonId not in(35, 36, 37)
				where 1=1
				AND b.CallReasonQue in (15,16)
				AND c.CampaignId not in (19,20,21)
				#AND date(b.QA_UpdateTs) = date(now())
				AND a2.PolicyNumber in(".$extractData.")
				group by a2.PolicyNumber
				order by a2.PolicySalesDate asc";
		
		return $this->db->query($sql);
	}
	
	function getInsured( $extractData = ''  )
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
					IF(e.Salutation='MR','M',IF(e.Salutation='MRS','F','')) as holder_sex, 
					CONCAT(a.InsuredDOB , ' ' , '00:00:00' ) as holder_dob, 
					'' as holder_ssn, 
					g.RelationshipTypeCode as relation, 
					j.ProductPlanLevel as benefit_level, 
					IF(i.PremiTypeId=2,0,FLOOR(sum(h.PolicyPremi))) as premium, 
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
				#where b.CallReasonId in (35, 36, 37)
				where 1=1
				AND b.CallReasonQue in (15,16)
				AND b.CampaignId not in (19,20,21)
				#AND date(b.QA_UpdateTs) = date(now())
				#AND date(b.QA_UpdateTs) = ''
				AND bv.PolicyNumber in(".$extractData.")
				GROUP BY a.InsuredId
				order by bv.PolicyNumber,a.InsuredId"; 
		
		return $this->db->query($sql);
	}
	
	function getBeneficiery( $extractData = '' )
	{
		/*$sql = "select
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
					'0' as bnf_percent, 
					'ALL' as bnf_coverage, 
					c.RelationshipTypeCode as bnf_relation, 
					CONCAT(a.BeneficiaryDOB  , ' ' , '00:00:00') as bnf_dob
				from t_gn_beneficiary a
				inner join t_gn_customer d on d.CustomerId=a.CustomerId
				left join t_gn_insured a1 on a1.InsuredId=a.InsuredId
				left join t_lk_gender b on a.GenderId=a.GenderId
				left join t_lk_relationshiptype c on c.RelationshipTypeId=a.RelationshipTypeId
				where d.CallReasonId in (35, 36, 37)
				GROUP BY d.CustomerId
				order by a.PolicyNumber

				";*/

		$sql = "select
					a.PolicyNumber as policy_id, 
					'1' as holder_id, 
					a.BenefieceryPrefix as bnf_id, 
					a.BeneficiaryFirstName as bnf_fname, 
					a.BeneficiaryLastName as bnf_lname, 
					b.GenderCode as bnf_sex, 
					'' as bnf_ssn, 
					'' as bnf_bene_ind, 
					'' as bnf_client_type, 
					'0' as bnf_percent, 
					'ALL' as bnf_coverage, 
					c.RelationshipTypeCode as bnf_relation, 
					CONCAT(a.BeneficiaryDOB  , ' ' , '00:00:00') as bnf_dob
				from t_gn_beneficiary a
				inner join t_gn_customer d on d.CustomerId=a.CustomerId
				inner join t_gn_policyautogen gp on d.CustomerId=gp.CustomerId
				left join t_gn_insured a1 on a1.InsuredId=a.InsuredId
				left join t_lk_gender b on a.GenderId=b.GenderId
				left join t_lk_relationshiptype c on c.RelationshipTypeId=a.RelationshipTypeId
				#where d.CallReasonId in (35, 36, 37)
				where 1=1
				AND d.CampaignId not in (19,20,21)
				AND d.CallReasonQue in (15,16)
				#AND date(d.QA_UpdateTs) = date(now())
				#AND date(d.QA_UpdateTs) = ''
				AND gp.PolicyNumber in(".$extractData.")
				order by a.PolicyNumber
				";
		
		return $this->db->query($sql);
	}
	
	function getQuestion( $extractData = ''  )
	{
		$sql = "select 
					e.PolicyNumber as policy_id, 
					IF(a.PremiumGroupId=2,1,
						IF(a.PremiumGroupId=4,2,
							(2+right(a.PolicyPrefix,1)))) as holder_id, 
					uw.UWCode as questionid,
					
					(CASE 
						WHEN uw.UWAnswer = 'N' THEN 'T'
						WHEN uw.UWAnswer = 'Y' THEN 'Y'
						ELSE ''
					END) as answer ,

					(CASE 
						WHEN uw.UWAnswer = 'N' THEN ''
						WHEN uw.UWAnswer = 'Y' THEN ''
						ELSE uw.UWAnswer
					END) as remark
				
				from t_gn_insured a
				left join t_gn_customer b on b.CustomerId=a.CustomerId
				left join t_gn_policyautogen e ON a.CustomerId=e.CustomerId
				left join t_gn_underwriting_answer uw on uw.UWInsuredId=a.InsuredId
				left join t_gn_payer c on c.CustomerId=a.CustomerId
				#where b.CallReasonId in (35, 36, 37)
				where 1=1
				AND b.CallReasonQue in (15,16)
				AND b.CampaignId not in (19,20,21)
				#AND date(b.QA_UpdateTs) = date(now())
				#AND date(b.QA_UpdateTs) = ''
				AND e.PolicyNumber in(".$extractData.")
				and uw.UWCode is not null 
				order by e.PolicyNumber, uw.UWCode ASC ";
		
		return $this->db->query($sql);
	}
}

/*
select
a.PolicyNumber as policy_id ,
'' as policy_ref,
a.CustomerId as prospect_id,
e.ProductCode as product_id,
e.ProductCode as campaign_id,
c.CampaignCode as campaign_TBSS,
a2.PolicySalesDate as input,
a2.PolicyEffectiveDate as effdt,
b.CustomerNumber as payer_cifno,
f.Salutation as payer_title,
REPLACE(a3.PayerFirstName,' ',' ') as payer_fname,
a3.PayerLastName as payer_lname,
g.GenderShortCode as payer_sex,
date_format(a3.PayerDOB,'%Y-%m-%d %T') as payer_dob,
h.AddrCode as addrtype,
REPLACE(a3.PayerAddressLine1,' ',' ') as addr1,
#a3.PayerAddressLine1 as addr1,
REPLACE(a3.PayerAddressLine2,' ',' ') as addr2,
REPLACE(a3.PayerAddressLine3,' ',' ') as addr3,
REPLACE(a3.PayerAddressLine4,' ',' ') as addr4,
a3.PayerCity as city,
a3.PayerZipCode as post,
i.ProvinceCode as province,
if(a3.PayerHomePhoneNum is not null,a3.PayerHomePhoneNum,b.CustomerHomePhoneNum) as phone,
a3.PayerFaxNum as faxphone,
a3.PayerEmail as email,
'DBB' as pay_type,
'' as card_type,
'' as bank,
'' as branch,
b.CustomerNumber as acctnum,
'' as ccexpdate,
k.PayModeCode as bill_freq,
'' as question1,
'' as question2,
'' as question3,
'' as question4,
'' as question5,
m.ProductPlanLevel as benefit_level,
FLOOR(a2.PolicyPremi) as premium,
'' as nbi,
'N' as export,
now() as exportdate,
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
'' as payer_idtype,
a3.PayerIdentificationNum as payer_personalid,
if(a3.PayerMobilePhoneNum is not null,a3.PayerMobilePhoneNum,b.CustomerMobilePhoneNum) as payer_mobilephone,
if(a3.PayerOfficePhoneNum is not null,a3.PayerOfficePhoneNum,b.CustomerWorkPhoneNum) as payer_officephone,
'' as deliverydate,
'' as seperate_policy,
'1' as 'status',
'' as payer_occupationid,
a3.PayerPlaceOfBirth as payer_birthplace,
'' as payer_religionid,
'' as payer_income,
'' as payer_position,
'' as payer_company,
o.init_name as operid,
o.id as sellerid,
p.init_name as spv_id,
q.init_name as atm_id,
r.init_name as tsm_id,
b.CustomerNumber as pcifnumber,
'' as pcardtype,
'' as prefnumber,
a3.PayerCreditCardNum as paccnumber,
'' as paccname,
'' as pcardnumber,
(select ac.file_voc_name from cc_recording ac
where 1=1 and ac.assignment_data = b.CustomerId
group by ac.assignment_data having max(ac.duration)) as record_id,
b.CustomerUpdatedTs as calldate,
'' as phone2,
'' as payer_mobilephone2,
'' as payer_officephone2,
'' as policy_delivery,
'' as notification_delivery,
'' as is_allow_datasharing,
'' as is_allow_productoffering,
'' as customer_segment,
e.ProductRateTypeId as ratetype_id,
'' as remark
from t_gn_policyautogen a
inner join t_gn_policy a2 on a.PolicyNumber = a2.PolicyNumber
inner join t_gn_payer a3 on (a.PolicyNumber = a3.PolicyNumber and a.CustomerId = a3.CustomerId)
inner join t_gn_insured a4 on (a3.PolicyNumber = a4.PolicyNumber and a3.PolicyPrefix = a4.PolicyPrefix)
inner join t_gn_customer b on a.CustomerId = b.CustomerId
inner join t_gn_assignment b2 on b.CustomerId=b2.CustomerId
inner join t_gn_campaign c on b.CampaignId = c.CampaignId
inner join t_gn_campaignproduct d on c.CampaignId = d.CampaignId
inner join t_gn_product e on d.ProductId = e.ProductId
#LOOKUP - LOOKUP
left join t_lk_salutation f on a3.SalutationId = f.SalutationId
left join t_lk_gender g on a3.GenderId = g.GenderId
left join t_lk_addr_type h on h.AddrId = a3.PayerAddrType
left join t_lk_province i on i.ProvinceId = a3.ProvinceId
left join t_lk_paymenttype j on j.PaymentTypeId = a3.CreditCardTypeId
left join t_lk_paymode k on k.PayModeId = a4.InsuredPayMode
left join t_gn_productplan l on a2.ProductPlanId = l.ProductPlanId
left join t_gn_plan_name m on l.ProductId = m.ProductId and l.ProductPlan = m.ProductPlanId
left join tms_agent o on b2.AssignSelerId = o.UserId
left join tms_agent p on b2.AssignLeader = p.UserId
left join tms_agent q on b2.AssignSpv = q.UserId
left join tms_agent r on b2.AssignAmgr = r.UserId
#RECORDING
#inner join t_gn_callhistory ch on (b.CustomerId = ch.CustomerId and b.CallReasonId = ch.CallReasonId and o.id = ch.AgentCode)
#left join cc_recording rec on ch.CallSessionId = rec.session_key
#where ch.CallBeforeReasonId not in(35, 36, 37)
where 1=1
AND b.CallReasonQue in (15,16)
#AND date(b.QA_UpdateTs) = date(now())
AND a2.PolicyNumber in('MCBM0000000039N', 'MCBM0000000040N', 'MCBM0000000044N', 'MCBM0000000061N', 'MCBM0000000067N', 'MCBM0000000072N', 'MCBM0000000087N', 'MCBM0000000102N', 'MCBM0000000143N', 'MCBM0000000149N', 'MCBM0000000153N', 'MCBM0000000157N', 'MCBM0000000202N', 'MCBM0000000228N', 'MCBM0000000240N')
order by a2.PolicySalesDate asc


 */

?>