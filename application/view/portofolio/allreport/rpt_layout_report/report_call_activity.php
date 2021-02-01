<?php  
/**
 *
 	============================ LOGIC CUSTOMER FACING TIME ==========================================

 * Flow Facing Time : 
		1. Duration activity agent (excl Not Ready & Log off) , inc(Ready , Acw , busy) / duration agent schedule (excl Maternity Leave,Leave,Off,New Hire,Resigned, Training) in (Sick , Permit , No News,'Default Masuk'')
			- Ambil dari cc_activity_log berdasarkan Ready , ACW dan Busy , dijadikan durasi
			- Ambil dari t_gn_setschedule_agent berdasarkan status Sick , Permit , No News dan Default Masuk , di 
				cek berdasarkan SPV set Schedule Agent per tanggal , jika ada bandingkan datanya dengan durasi
				satu bulan , dijadikan durasi
			- Jika sudah mendapatkan value dari 2 data tersebut dibagi 
			- Dan Jadikan Variable FacingTime 
 * Flow Adherence 
 		1. duration agent schedule (incl. 'Default Masuk','No News','No Info') – duration login sd logout (telat/pulang cepat) / duration agent schedule (incl. 'Default Masuk','No News','No Info') 
	
		============================ LOGIC ADHERENCE ========================================================
 		
 		$var_totalschedule_1 = Total Agent Schedule t_gn_setschedule_agent(No News , No Info , Default Masuk) 
 		(Operator Arithmatic (DIKURANG)) -
 		$var_total_telat_pulangcepat = (
 			Ambil Dari t_gn_activity_log MIN(time_login) di bandingkan dengan Set Schedule Agent(Telat Masuk)+Ambil Dari t_gn_Activity_log MAX(time_logout) di bandingkan dengan Set Schedule Agent Berdasarkan Tanggal dan Agent Selama Periode Penarikan Report (Pulang Cepat)
 		)
 		(Operator Arithmatic (DIVIDE)) -   
		$var_total_pembagian_scheduleagent (
			Ambil Dari t_gn_setschedule_agent berdasarkan periode yang di ambil di report
		)
	

 */
	
?>
<?php $this->load->view("allreport/func_call_activity"); ?>

<?php  
		/*  "startdate" => $this->startdate , 
			"enddate"   => $this->enddate , 
			"mgrid"		=> $this->MgrId ,
			"spvid"		=> $this->SpvId ,
			"agentid"	=> $this->AgentId */
$attr_header = array(
	"title" => "Report Call Activity " . $startdate . " / " . $enddate, 
	"title_little" => "" ,
	"startdate" => $startdate , 
	"enddate" => $enddate
);

$this->load->view("allreport/rpt_layout_report/rpt_header/view_header_report"  , $attr_header );
?>


<?php 
/**
 * Column Name
 */

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

$startdate = StandartDateDB($startdate,1);
$enddate   = StandartDateDB($enddate);

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

//echo $ListScoring;

?> 



<table class="table">
<?php  _column($column_array); // set column ?> 

<tbody>
 	<?php  
 	$getAgent = new GetAgent();
 	//echo $agentid;
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

 		?>
	<tr>
		<td><?= $no++; ?></td> 
		<td><?= $ga->full_name; ?></td>
		<td><?= $ga->id; ?></td>
		<td><?= $ga->full_name; ?></td>
		<td><?= "Outbound"; ?></td>
		<td><?= "Telesales Portofolio" ?></td>
		<td>
			<?= isset($getCallHistory->getInitiatedContact()->tot_connect) ? $getCallHistory->getInitiatedContact()->tot_connect : '0'; ?>	
		</td>

		<td>
			<?php if($getCallHistory->getInitiatedContact()->tot_connect_unique == '-1') echo 0  ;
				  else echo $getCallHistory->getInitiatedContact()->tot_connect_unique; 
			?>
		</td>
		<td>
			<?php if($getCallHistory->getInitiatedContact()->tot_connect_unique_2 == '-1') echo 0  ; 
				  else echo $getCallHistory->getInitiatedContact()->tot_connect_unique_2;
			?>		
		</td>
		<td>
			<?php if($getCallHistory->getInitiatedContact()->tot_incoming == '-1') echo 0  ; 
				  else echo $getCallHistory->getInitiatedContact()->tot_incoming;
			?>				
		</td>
		<td>
			<?php 
				//$totalActivity . "/" . $totalSchedule . "= " . $facingTime
				echo $facingTime;
			?>
		</td>
		<td>
			<?php 
				echo $Adherence;
			?>
		</td>
		<td>
			N/A
		</td>
		<td>
			<?=
				round(isset($getScoring->getAverageQuality("SPV")->AvgScoring) ? $getScoring->getAverageQuality("SPV")->AvgScoring : 0); 
			?>
		</td>
		<td>
			<?=
				round(isset($getScoring->getAverageQuality("QA")->AvgScoring) ? $getScoring->getAverageQuality("QA")->AvgScoring : 0); 
			?>
		</td>
		<td><?= $getAgent->getSpv($ga->UserId)->id; ?></td>
	</tr>
 		<?php }
 	}
 	?>
</tbody>


</table>


<?php $this->load->view("allreport/rpt_layout_report/rpt_header/view_footer_report"); ?>
