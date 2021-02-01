<?php  
		/*  
						"starttime_sat" => $this->get_obj->get_value("starttime_sat") , 
						"endtime_sat" => $this->get_obj->get_value("endtime_sat") , 
						"starttime_monfri" => $this->get_obj->get_value("starttime_monfri") , 
						"endtime_monfri" => $this->get_obj->get_value("endtime_monfri") , 
						"get_report" => $this->get_obj->get_value("get_report") , 
						"mode" => $this->get_obj->get_value("mode") ,
						"month" => $this->get_obj->get_value("month")
	 */

$attr_header = array(
	"title" => "Report Schedule Agent Period of " . $month , 
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
	"DATE_SCHEDULE" => "Staff" ,
	"DATETIMEFROM" => "Staffs" ,
	"DATETIMETO" => "SPV" , 
	"AGENT_USERNAME" => "AOCAgent" , 
	"REASON" => "Team" 
);

$EUI =& get_instance();

$startdate = StandartDateDB($startdate ,1 , false) . "<br>";
$enddate   = StandartDateDB($enddate , 0 , false);

//echo $startdate;
//echo $enddate;

$ListCoaching = "
SELECT a.init_name AS AgentId, 
d.init_name AS SpvId, e.ReasonName AS ParamAbsen, 
IF (DATE_FORMAT(b.ActivityDate, '%d-%m-%Y') IS NULL, '00-00-0000', 
DATE_FORMAT(b.ActivityDate, '%d-%m-%Y')) AS DateSchedule, 
IF (c.DateSchedule is not null , concat(c.DateSchedule , ' ' , c.StartTime ) , DATE_FORMAT(b.ActivityDate, '%Y-%m-%d') ) AS DateFrom,
IF (c.DateSchedule is not null , concat(c.DateSchedule , ' ' , c.EndTime ) , DATE_FORMAT(b.ActivityDate, '%Y-%m-%d') ) AS DateTo, 
e.ReasonName AS Reason, 
c.DateCreated AS CreatedDate
FROM (tms_agent a)
LEFT JOIN tms_agent d ON a.spv_id=d.UserId
LEFT JOIN t_gn_activitylog b ON a.UserId=b.ActivityUserId
LEFT JOIN t_gn_setschedule_agent c ON a.UserId=c.AgentId 
AND DATE_FORMAT(b.ActivityDate, '%Y-%m-%d')=c.DateSchedule
LEFT JOIN t_lk_reason_schedule e ON c.ReasonId=e.IdReason 
WHERE (TRUE) AND a.profile_id=4 AND DATE_FORMAT(b.ActivityDate, '%m-%Y')='$month'
GROUP BY a.UserId, DATE_FORMAT(b.ActivityDate, '%Y-%d-%m')
ORDER BY a.UserId ASC
";

//echo $ListCoaching;

$fetchCoaching = $EUI->db->query($ListCoaching);

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
			echo "<tr>";
				echo "<td>".$ds->DateSchedule."</td>";

				if ( strlen($ds->DateFrom) == 10 ) {
					echo "<td>".$ds->DateSchedule." ".setScheduleTime(days_name_bydate($ds->DateFrom) , 'start' , ':00')."</td>";
					echo "<td>".$ds->DateSchedule." ".setScheduleTime(days_name_bydate($ds->DateTo) , 'end',':00')."</td>";
				} else {
					echo "<td>".$ds->DateFrom."</td>";
					echo "<td>".$ds->DateTo."</td>";		
				}

				
				echo "<td>".$ds->AgentId."</td>";
				echo "<td>".$ds->Reason."</td>";
			echo "</tr>";
		} 	
	} else {
		echo "<tr>";
			echo "<td colspan='12'>Data tidak ada</td>";
		echo "</tr>";
	
	}
	echo "</tbody>";
}
?> 

<table class="table">
<?php  _column($column_array); // set column ?> 
<?php  _content($fetchCoaching); // set column ?> 
</table>


<?php $this->load->view("allreport/rpt_layout_report/rpt_header/view_footer_report"); ?>
