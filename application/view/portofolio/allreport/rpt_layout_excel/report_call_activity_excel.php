<?php  

$this->load->view("allreport/func_allreport");
$this->load->view("allreport/func_call_activity"); 


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

$arr_title = " ".StandartDateDB($startdate) ."to". StandartDateDB($enddate);
$arr_printedby = "Printed By: "._get_session('Username');
$arr_printdate = "Print Date: ".date('m/d/Y H:i:s');
$base_file_tmp = $FileName.".xls";
$base_file_name = "/temp/".$base_file_tmp;


$column_array = array(
	"No" => 1 , 
	"Staff Name" => "StaffName" , 
	"Staff Id" => "StaffId" , 
	"AOC/Login Name" => "AOC" , 
	"Role" => "Role" , 
	"Position" => "Privileges" ,
	"No of call/month" => "NoOfCallMon" , 
	"No of call/month ( Unique Cust )" => "NoOfCallUnique" , 
	"No of call/month ( Unique Cust ) 2" => "NoOfCallUnique2" ,
	"No of Sales Offered Call/month" => "NoOfSalesOffered" , 
	"Customer Facing Time (%)" => "CustomerFacing" , 
	"Adherence (%)" => "Adherence" ,
	"No of Successful Retention/month" => "NoOfSuccessFul" , 
	"Average Quality Monitoring Score/month (SPV)" => "AverageQuality" , 
	"Average Quality Monitoring Score/month (QA)" => "AverageQualityMon" , 
	"SPV" => "SPV"
);


$EUI =& get_instance();

$startdate = StandartDateDB($startdate);
$enddate   = StandartDateDB($enddate);

//echo $startdate;
//echo $enddate;

//echo $ListCoaching;

//$fetchCoaching = $EUI->db->query($ListCoaching);

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
		echo $key . $tab;
	}
} 

echo $enterline;


$getAgent = new GetAgent();

$number = 1;
$getAgents = $getAgent->getAgentLoop( $agentid );

if ( $getAgents != 0 ) {
 		$no = 1;
 		foreach ( $getAgents as $ga ) { 
 			$getCallHistory = new GetCallHistory( $ga->UserId , $startdate , $enddate );
 			// get percent facing time
 				
 			$getFacingTime = new GetDuration( $ga->id , $startdate , $enddate );
 			$getAdherence  = new GetDuration( $ga->UserId , $startdate , $enddate );

 			$ActivityFacingTime = isset($getFacingTime->getFC_Activity()->TotalActivity) ? $getFacingTime->getFC_Activity()->TotalActivity : 0;
 			$ScheduleFacingTime = $getFacingTime->getFC_Schedule(array( 1 , 2 , 5 ));


 			// get total adherence 
 			$ScheduleAdherence = $getFacingTime->getFC_Schedule(array( 5 ));
 			$First_Adherence   = $getAdherence->_getMinDuration( "first" );
 			$Last_Adherence    = $getAdherence->_getMinDuration( "last" );
 			$NoPresent_Adherence    = $getAdherence->_getMinDuration( "nopresent" );

 			$TotalNotEfisient   	= $First_Adherence+$Last_Adherence+$NoPresent_Adherence;
 			
 			$TotalLastAndFirst   	= $First_Adherence+$Last_Adherence;

 			$TotalAdherence     	= number_format( (($ScheduleAdherence-$TotalNotEfisient)/$ScheduleAdherence) * 100 , 2);
 			$TotalAdherencePercent  = $TotalAdherence; 

 			//echo "Format -> Schedule Agent - (TotalTelat #JikaPlusMakaTelat +Cepat Pulang #JikaMinusPulangCepat +TotalTidakMasuk) / ScheduleAgent " . "<br>";

 			//echo $ga->id . " => " . $ScheduleAdherence . " - " . $Last_Adherence . " + " . $First_Adherence . "=$TotalLastAndFirst + $NoPresent_Adherence = $TotalNotEfisient / " . $ScheduleAdherence . "=" . $TotalAdherencePercent . "<br>";

 			$DivideActivity_Schedule = number_format(($ActivityFacingTime / $ScheduleFacingTime) * 100 , 2);
 			if ( $DivideActivity_Schedule >= 100 ) $DivideActivity_Schedule = 100; 

 			//echo $ActivityFacingTime . "/" . $ScheduleFacingTime . "=" . $DivideActivity_Schedule;
 			$facingTime = $DivideActivity_Schedule;

 			$Adherence = $TotalAdherencePercent;

 			// scoring
 			$getScoring = new GetScoring($ga->UserId , $startdate , $enddate);
	
			echo $no++. $tab ; 
			echo $ga->full_name. $tab ; 
			echo $ga->id. $tab ; 
			echo $ga->full_name. $tab ; 
			echo "Outbound". $tab ;
			echo "Telesales Portofolio" . $tab;
			
			echo isset($getCallHistory->getInitiatedContact()->tot_connect) ? $getCallHistory->getInitiatedContact()->tot_connect : '0'; 
			echo $tab;

		    if($getCallHistory->getInitiatedContact()->tot_connect_unique == '-1') echo 0  ;
			else echo $getCallHistory->getInitiatedContact()->tot_connect_unique; 
			echo $tab;
		
		
			if($getCallHistory->getInitiatedContact()->tot_connect_unique_2 == '-1') echo 0  ; 
			else echo $getCallHistory->getInitiatedContact()->tot_connect_unique_2;
			echo $tab;
		
		
			if($getCallHistory->getInitiatedContact()->tot_incoming == '-1') echo 0  ; 
			else echo $getCallHistory->getInitiatedContact()->tot_incoming;
			echo $tab;
		
		
				//$totalActivity . "/" . $totalSchedule . "= " . $facingTime
			echo $facingTime . $tab ;
			echo $Adherence . $tab;
			echo "N/A" . $tab;
		
			echo round(isset($getScoring->getAverageQuality("SPV")->AvgScoring) ? $getScoring->getAverageQuality("SPV")->AvgScoring : 0) ;
			echo $tab; 
		
			echo round(isset($getScoring->getAverageQuality("QA")->AvgScoring) ? $getScoring->getAverageQuality("QA")->AvgScoring : 0) . $tab; 

			echo $getAgent->getSpv($ga->UserId)->id. $tab ; 
	
		echo $enterline;

 	}
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