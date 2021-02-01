<?php  
		/*  "startdate" => $this->startdate , 
			"enddate"   => $this->enddate , 
			"mgrid"		=> $this->MgrId ,
			"spvid"		=> $this->SpvId ,
			"agentid"	=> $this->AgentId */

$attr_header = array(
	"title" => "Report Call Scoring " . $startdate . " - " . $enddate , 
	"startdate" => $startdate , 
	"enddate" => $enddate , 
	"title_little" => "" 
);

$this->load->view("allreport/rpt_layout_report/rpt_header/view_header_report"  , $attr_header );
?>


<?php 
/**
 * Column Name
 */

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
	"CALLMON" => "CallMon" , // date callmon in one month
	"DATE CREATE CALLMON" => "DateCreateCallmon" , 
	"CREATE DATE SCORING" => "CreateDateScoring" , 
	"EDIT DATE SCORING" => "EditDateScoring" 
);

$EUI =& get_instance();

$startdate = StandartDateDB($startdate,1);
$enddate   = StandartDateDB($enddate);

//echo $startdate;
//echo $enddate;

$ListScoring = "SELECT a.*, 
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
//echo $ListScoring;

$fetchScoring = $EUI->db->query($ListScoring);

//echo $ListCoaching;

function _column ( $column_array = "" ) { 
	//global $column_array;
	//print_r($column_array);
	if ( is_array( $column_array ) ) {
		echo "<thead>";
		foreach ( $column_array as $key => $value ) {
			echo "<td>".$key."</td>";
		}
		echo "</thead>";
	} else {

	}
} 

function _content ( $datas = "" ) { 
	echo "<tbody>";
	$no = 1;
	if ( $datas == true AND $datas->num_rows() > 0 ) {
		
		foreach ( $datas->result() as $ds ) {
				
			//return false;
			echo "<tr>";
				echo "<td>".$ds->CustomerId."</td>";
				echo "<td>".$ds->SPV."</td>";
				echo "<td>".strtoupper($ds->Name_Of_Agent)."</td>";
				echo "<td>".strtoupper($ds->Agent_ID)."</td>";
				echo "<td>".$ds->Evaluator_Name."</td>";
				echo "<td>".$ds->Customer_Segment."</td>";
				echo "<td>".$ds->New_Skill."</td>";
				echo "<td>".$ds->PVC."</td>";
				echo "<td>".$ds->In_Academy."</td>";
				echo "<td>".$ds->Risk_Type."</td>";
				echo "<td>".$ds->Site."</td>";
				echo "<td>".$ds->In_Score."</td>";

				// take if scoring more than 3
				echo "<td>".''."</td>";

				$ValueAllSection = $ds->ValueAllSection;
				//echo $ValueAllSection;
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

				echo "<td>".$section1[0]."</td>";
				echo "<td>".$section1[1]."</td>";
				echo "<td>".$section1[2]."</td>";

				echo "<td>".$section2[0]."</td>";
				echo "<td>".$section2[1]."</td>";
				echo "<td>".$section2[2]."</td>";

				
				echo "<td>".$section3[0]."</td>";
				echo "<td>".$ds->RemarksSection3."</td>";

				echo "<td>".$section3[1]."</td>";
				echo "<td>".$section3[2]."</td>";
				echo "<td>".$section3[3]."</td>";
				
				echo "<td>".$section4[0]."</td>";
				echo "<td>".$section4[1]."</td>";
				
				echo "<td>".$ds->Enter_New_Score."</td>";

				echo "<td>".$ds->General_Call_Feedback."</td>";
				echo "<td>".$ds->Acknowledge_Agent."</td>";	

	//"DATE CREATE CALLMON" => "DateCreateCallmon" , 
	//"CREATE DATE SCORING" => "CreateDateScoring" , 
	//"EDIT DATE SCORING" => "EditDateScoring"		

	
				echo "<td></td>";				
				echo "<td>".$ds->DateAssign."</td>";
				echo "<td>".$ds->DateCreateTs."</td>";
				echo "<td></td>";
			echo "</tr>";
		} 	
	} else {
		echo "<tr>";
			echo "<td colspan='33'>tidak ada</td>";
		echo "</tr>";
	
	}
	echo "</tbody>";
}

//echo $ListScoring;

?> 



<table class="table">
<?php  _column($column_array); // set column ?> 
<?php  _content($fetchScoring); // set column ?> 
</table>


<?php $this->load->view("allreport/rpt_layout_report/rpt_header/view_footer_report"); ?>
