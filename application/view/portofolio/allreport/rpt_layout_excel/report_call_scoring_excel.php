<?php  

$this->load->view("allreport/func_allreport");

/**
 * [$workbook description]
 * @var writeexcel_workbook
 *
 * "startdate" => $this->startdate , 
	"enddate"   => $this->enddate , 
	"mgrid"		=> $this->mgr ,
	"spvid"		=> $this->spv ,
	"agentid"	=> $this->agent 
 */
$workbook = new writeexcel_workbook($FileName);

$arr_title = " ".StandartDateDB($start_date) ."to". StandartDateDB($enddate);
$arr_printedby = "Printed By: "._get_session('Username');
$arr_printdate = "Print Date: ".date('m/d/Y H:i:s');
$base_file_tmp = $FileName.".xls";
$base_file_name = "/temp/".$base_file_tmp;

//echo $base_file_tmp;
 
// read excel  ---------------------------------------------------------



		/*  "startdate" => $this->startdate , 
			"enddate"   => $this->enddate , 
			"mgrid"		=> $this->MgrId ,
			"spvid"		=> $this->SpvId ,
			"agentid"	=> $this->AgentId */

$column_array = array(
	"CUST APP ID" => "CustAppId" ,
	"SPV" => "SPV" , 
	"Name of the Agent" => "NameAgent" , 
	"Agent ID" => "AgentId" , 
	"Evaluator Name" => "EvaluatorName" ,
	"Customer Segment" => "CustomerSegment" , 
	"New to Skill?" => "NewToSkill" , 
	"PVC" => "PVC" , 
	"In Academy" => "In Academy" , 
	"Risk Type" => "Risk Type" , 
	"Site" => "Site" , 
	"Change in Score?" => "ChangeScore",
	"Enter new score" => "NewScore" , 

	"Was the agent ready to make/take call?" => "WasAgent" , 
	"Was the business standard greeting used?" => "WasBusiness" , 
	"Did the agent close the call correctly?" => "DidAgent" , 

	"What level of rapport did the agent display to engage the customer?" => "LevelRapport" , 
	"What level of ownership did the agent display?" => "WhatLevel" , 
	"How effective was the agents communication skills?" => "Effective" , 
	
	"Did the agent clearly communicate the reason for the call and further engage the customer?" => "AgentClearly",
	"What was the method of identification of customer's needs?" => "WhatMethod" , 
	"Did the agent accurately explain product/ service features and benefits and channels available?" => "AgentAccurately" , 
	"Did the agent acknowledge concerns raised by the customer&provide clarification so the customer could make an informed decision?" => "AgentKnowledge" , 
	"Did the agent ask the customer to accept the offer/Individual Solution or agree to next steps?" => "AgentAsk" , 
	
	"Did the agent follow proper policies and procedures?" => "AgentFollow" ,
	"Did the agent follow the correct regulation and compliance standards?" => "Kadasldjlasd" ,
	
	"SCORE" => "Score" , 
	"General Call Feedback" => "GeneralCallFeedback" ,
	"ACKNOWLEDGE" => "Acnowledge" ,
	"CALLMON" => "CallMon" , 
	"DATE CREATE CALLMON" => "DateCreateCallmon" , 
	"CREATE DATE SCORING" => "CreateDateScoring" , 
	"EDIT DATE SCORING" => "EditDateScoring" 
);

$EUI =& get_instance();

$startdate = StandartDateDB($startdate);
$enddate   = StandartDateDB($enddate);

//echo $startdate;
//echo $enddate;

$ListCoaching = "
SELECT a.*, 
c.init_name AS SPV , 
d.Assign_Create_Ts as DateAssign
FROM t_gn_score_result a
LEFT JOIN t_gn_quality_assignment d on d.Assign_Data_Id=a.CustomerId
LEFT JOIN tms_agent b ON b.UserId=a.AgentUserId
LEFT JOIN tms_agent c on b.spv_id=c.UserId
LEFT JOIN tms_agent g on c.mgr_id=g.UserId
WHERE 
a.DateCreateTs >= '$startdate 00:00:00' 
AND a.DateCreateTs <= '$enddate 23:59:00'
AND b.mgr_id in($mgrid);
";

//echo $ListCoaching;

$fetchCoaching = $EUI->db->query($ListCoaching);

//echo $ListCoaching;

$workbook =& new writeexcel_workbook($base_file_name);
$worksheet =& $workbook->addworksheet();



$tab = "\t";
$enterline = "\n";

//$tab = " ";
//$enterline = "<br>";

echo $FileName;
echo $enterline;

if ( is_array($column_array) ) {
	foreach ( $column_array as $key => $value ) {
		echo $key  . $tab;
	}
} 

echo $enterline;

$number = 1;
if ( $fetchCoaching->num_rows() > 0 ) {
	$no = 1;
	//print_r($fetchCoaching->result_array());
	foreach ( $fetchCoaching->result() as $ds ) {
		echo $ds->CustomerId . $tab;
		echo $ds->SPV  . $tab;
		echo strtoupper($ds->Name_Of_Agent) . $tab;
		echo strtoupper($ds->Agent_ID) . $tab;
		echo $ds->Evaluator_Name . $tab;
		echo $ds->Customer_Segment . $tab;
		echo $ds->New_Skill . $tab;
		echo $ds->PVC . $tab;
		echo $ds->In_Academy . $tab;
		echo $ds->Risk_Type . $tab;
		echo $ds->Site . $tab;
		echo $ds->In_Score . $tab;
		
		// take if scoring more than 3
		echo '' . $tab;

		$ValueAllSection = $ds->ValueAllSection;
		
		//$vas = (object)array("" => "");
		
		if ( strpos( $ValueAllSection , ","  ) !== false ) {
					//echo $ValueAllSection;
					$ValueAllSection = explode("," , $ValueAllSection);	
					$vas = $ValueAllSection;
					$section1 = $ValueAllSection[0];
					$section1 = explode(":" , $section1);

					$section2 = $ValueAllSection[1];
					$section2 = explode(":" , $section2);

					$section3 = $ValueAllSection[2];
					$section3 = explode(":" , $section3);

					$section4 = $ValueAllSection[3];
					$section4 = explode(":" , $section4);
					//$vas = (object)$vas;
		} 


		echo $section1[0] . $tab;
		echo $section1[1] . $tab;
		echo $section1[2] . $tab;
		
		echo $section2[0] . $tab;
		echo $section2[1] . $tab;
		echo $section2[2] . $tab;

		echo $section3[0] . $tab;
		echo $ds->RemarksSection3 . $tab;

		echo $section3[1] . $tab;
		echo $section3[2] . $tab;
		echo $section3[3] . $tab;
		
		echo $section4[0] . $tab;
		echo $section4[1] . $tab;

		echo $ds->Enter_New_Score . $tab;
		echo trim(preg_replace('/\s\s+/', ' ', $ds->General_Call_Feedback)) . $tab;
		echo $ds->Acknowledge_Agent . $tab;
		
		echo '' . $tab;
		echo $ds->DateAssign . $tab;
		echo $ds->DateCreateTs . $tab;
		echo "" . $tab;
		echo $enterline;
	}
} else {
	echo "Data tidak ada!";
}

//$worksheet->write_string( 1 , 1 , "Recsource", $header_format );


/**
echo "<pre>";
var_dump($workbook);
echo "</pre>";
**/


$workbook->close(); // end book 



//readfile($base_file_tmp); 



?>