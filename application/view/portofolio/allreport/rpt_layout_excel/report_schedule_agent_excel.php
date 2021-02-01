<?php  

$this->load->view("allreport/func_allreport");
$this->load->helper("EUI_ExcelWorkbook");

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

//echo $base_file_tmp;
 
// read excel  ---------------------------------------------------------



		/*  "startdate" => $this->startdate , 
			"enddate"   => $this->enddate , 
			"mgrid"		=> $this->MgrId ,
			"spvid"		=> $this->SpvId ,
			"agentid"	=> $this->AgentId */

$column_array = array(	"DATE_SCHEDULE" => "Staff" ,
	"DATETIMEFROM" => "Staffs" ,
	"DATETIMETO" => "SPV" , 
	"AGENT_USERNAME" => "AOCAgent" , 
	"REASON" => "Team" 
);

$EUI =& get_instance();

$startdate = StandartDateDB($startdate);
$enddate   = StandartDateDB($enddate);

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
		echo $ds->DateSchedule . $tab;

		if ( strlen($ds->DateFrom) == 10 ) {
			echo $ds->DateSchedule." ".setScheduleTime(days_name_bydate($ds->DateFrom) , 'start' , ':00') . $tab;
			echo $ds->DateSchedule." ".setScheduleTime(days_name_bydate($ds->DateTo) , 'end',':00') . $tab;
		} else {
			echo $ds->DateFrom . $tab;
			echo $ds->DateTo . $tab;		
		}

		echo $ds->AgentId . $tab;
		echo $ds->Reason . $tab;
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