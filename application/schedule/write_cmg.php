<?php

require 'extract_cmg.php';

$filename="extract_cmg";
$file_name = __DIR__."/extract/". preg_replace('/\s+/', '_', $filename) . "_".date("Y-m-d-his").".txt";
$handle = fopen($file_name , "w");

function GetLine($param=array())
{
	$baris="";
	$baris=
 	$param['CustomerId']."|".
	$param['record_type']."|".
	$param['name']."|".
	$param['gender']."|".
	$param['dob']."|".
	$param['addr1']."|".
	$param['addr2']."|".
	$param['addr3']."|".
	$param['addr4']."|".
	$param['hometel']."|".
	$param['officetel']."|".
	$param['postcode']."|".
	$param['idnum']."|".
	$param['cc']."|".
	$param['ccexp']."|".
	$param['acc_type']."|".
	$param['sales_date']."|".
	$param['eff_date']."|".
	$param['ProductCode']."|".
	$param['ProductPlanName']."|".
	$param['cover_code']."|".
	$param['PayMode']."|".
	$param['CampaignCode']."|".
	$param['tm_code']."|".
	$param['x_ref']."|".
	$param['mobilenum']."|".
	$param['fax']."|".
	$param['email']."|".
	$param['opt']."|".
	$param['policy_num']."|".
	$param['trans_eff']."|".
	$param['rapid_id']."|".
	$param['marital_status']."|".
	$param['CommChannelDesc']."|".
	$param['benef_prosentase']."|".
	$param['benef_age']."|".
	$param['benef_relation']."|".
	$param['spouse_ind']."|".
	$param['anual_income']."|".
	$param['dep_spouse']."|".
	$param['dep_no_children']."|".
	$param['dep_other_dep']."|".
	$param['employment_status']."|".
	$param['education']."|".
	$param['OccEnglish']."|".
	$param['cust_val_indicator']."|".
	$param['payer_name']."|".
	$param['payer_id_num']."|".
	$param['BankName']."|".
	$param['branch_code']."|".
	$param['office_code']."|".
	$param['contact_ref_code1']."|".
	$param['contact_ref_code2']."|".
	$param['contact_ref_code3']."|".
	$param['policy_ref_code1']."|".
	$param['policy_ref_code2']."|".
	$param['policy_ref_code3']."|".
	$param['race_type']."|".
	$param['contact_alternatif']."|".
	$param['BilingDescription']."|".
	$param['Province']."|".
	$param['add_country']."|".
	$param['contact_title']."|".
	$param['PolicyPremi']."|".
	$param['PolicyNumber']."|".
	$param['ApplicationDate']."|".
	$param['assign_policy_num']."|".
	$param['nationality']."|".
	$param['contact_integrated_type']."|".
	$param['contact_alternatife_type']."|".
	$param['contact_surname']."|".
	$param['contact_rirst_name']."|".
	$param['contact_middle_name']."|".
	$param['Contact_Height']."|".
	$param['Contact_Height_Unit']."|".
	$param['Contact_Weight']."|".
	$param['Contact_Weight_Unit']."|".
	$param['Dec_Q01_Answer']."|".
	$param['Dec_Q01_Comments']."|".
	$param['Dec_Q02_Answer']."|".
	$param['Dec_Q02_Comments']."|".
	$param['Dec_Q03_Answer']."|".
	$param['Dec_Q03_Comments']."|".
	$param['Dec_Q04_Answer']."|".
	$param['Dec_Q04_Comments']."|".
	$param['Dec_Q05_Answer']."|".
	$param['Dec_Q05_Comments']."|".
	$param['Dec_Q06_Answer']."|".
	$param['Dec_Q06_Comments']."|".
	$param['Dec_Q07_Answer']."|".
	$param['Dec_Q07_Comments']."|".
	$param['Dec_Q08_Answer']."|".
	$param['Dec_Q08_Comments']."|".
	$param['Dec_Q09_Answer']."|".
	$param['Dec_Q09_Comments']."|".
	$param['Dec_Q10_Answer']."|".
	$param['Dec_Q10_Comments']."|".
	$param['UNW_Action_Code']."|".
	$param['UNW_Action_Reason']."|".
	$param['UNW_Completed_Date']."|".
	$param['UNW_Reject_Reason']."|".
	$param['UNW_Reject_Occupation']."|".
	$param['UNW_Reject_Age']."|".
	$param['UNW_Reject_MIB']."|".
	$param['UNW_Reject_Medical']."|".
	$param['Business_Market_Code']."|".
	$param['primary_add_tag']."|".
	$param['primary_add_tag2']."|".
	$param['Address_Type_2']."|".
	$param['Address_1_Type2']."|".
	$param['Address_2_Type_2']."|".
	$param['Address_3_Type_2']."|".
	$param['Address_4_Type_2']."|".
	$param['Postcode_Type_2']."|".
	$param['Address_State_Type_2']."|".
	$param['Address_Country_Type_2']."|".
	$param['basic_face_amount']."|".
	$param['NameTypeIndicator']."|".
	$param['pob']."|".
	$param['tsr_name']."|".
	$param['spv_code']."|".
	$param['spv_name']."|".
	$param['e_full_indicator']."|".
	$param['dmc_contact']."|".
	$param['PayerAdditionalPhone1']."|".
	$param['PayerAdditionalPhone2']."|".
	$param['occ_class']."|".
	$param['smoking_status']."|".
	$param['Religion']."|".
	$param['ClientNumber']."|".
	$param['CIF']."|".
	$param['sob_code']."|".
	$param['SOBBranchCode']."|".
	$param['CampaignPrefix'];

	return $baris;
}

 // Create a new object
$obj = new MyClass;
 
$list = $obj->__getSalesList();
 
foreach( $list as $k => $cust)
{
foreach ($cust as $key => $value1) {
	foreach ($value1 as $key => $value2) {
		$line = GetLine($value2);
		fwrite($handle, $line."\r\n");
	}
}

}

fclose($handle);

if(!file_exists($file_name)) die("I'm sorry, the file doesn't seem to exist.");

echo "Done extracting data.\n";
