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
	"RowNum" => "No" ,
	"MGR" => "MGR" ,
	"SPV" => "SPV" , 
	"AOC Agent" => "AOCAgent" , 
	"Team" => "Team" , 
	"Period" => "Periode" ,
	"Coaching Date" => "CoachingDate" , 
	"Notes from Previous Coaching" => "NotePrevious" , 
	"Discussion Point(s)" => "DiscussionPoint" , 
	"Development Required / Agreed" => "DevRequired" , 
	"Date SPV Aknowledge" => "DateSpv" , 
	"Date Agent Aknowledge" => "DateAgent" , 
	"Coaching Type" => "CoachingType" 
);

$EUI =& get_instance();

$startdate = StandartDateDB($startdate);
$enddate   = StandartDateDB($enddate);

//echo $startdate;
//echo $enddate;

$ListCoaching = "SELECT  
	d.init_name as MGR , 
	c.init_name as SPV , 
	b.init_name as AOCAgent , 
	'Outbound Portofolio' as Team , 
	a.Periode as Periode ,
	a.CoachingDate as CoachingDate ,
	a.NotePrevCoach as NotePrevious , 
	a.DiscussionPoint as DiscussionPoint , 
	a.DevRequired as DevRequired , 
	a.CoachingDate as DateSpv , 
	a.DevRequiredDate as DateAgent , 
	a.CoachingType as CoachingType
	FROM t_gn_coaching a 
	LEFT JOIN tms_agent b on b.UserId=a.AgentId
	LEFT JOIN tms_agent c on c.UserId=b.spv_id
	LEFT JOIN tms_agent d on d.UserId=c.mgr_id
	WHERE 
	date_format(a.DateCreated,'%Y-%m-%d') BETWEEN date('$startdate') AND date('$enddate') 
	AND b.UserId in($agentid)";

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
		echo $key . $tab;
	}
} 

echo $enterline;

$number = 1;
if ( $fetchCoaching->num_rows() > 0 ) {
	$rowNum = 0;
	foreach ( $fetchCoaching->result_array() as $val ) {
		echo $number++ . $tab;
		echo $val["MGR"] . $tab;
		echo $val["SPV"] . $tab;
		echo $val["AOCAgent"] . $tab;
		echo $val["Team"] . $tab;
		echo $val["Periode"] . $tab;
		echo $val["CoachingDate"] . $tab;
		echo $val["NotePrevious"] . $tab;
		echo $val["DiscussionPoint"] . $tab;
		echo $val["DevRequired"] . $tab;
		echo $val["DateSpv"] . $tab;
		echo $val["DateAgent"] . $tab;
		echo $val["CoachingType"] . $tab;
		echo $enterline;
	}
} else {
	echo "Data tidak ada!";
}

$worksheet->write_string( 1 , 1 , "Recsource", $header_format );


/**
echo "<pre>";
var_dump($workbook);
echo "</pre>";
**/


$workbook->close(); // end book 



//readfile($base_file_tmp); 



?>