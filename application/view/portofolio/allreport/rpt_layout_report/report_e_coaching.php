<?php  
		/*  "startdate" => $this->startdate , 
			"enddate"   => $this->enddate , 
			"mgrid"		=> $this->MgrId ,
			"spvid"		=> $this->SpvId ,
			"agentid"	=> $this->AgentId */

$attr_header = array(
	"title" => "Report E-Coaching " . $startdate . " - " . $enddate , 
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
	"No" => "No" ,
	"MGR" => "MGR" ,
	"SPV" => "SPV" , 
	"AOC Agent" => "AOCAgent" , 
	"Team" => "Team" , 
	"Period" => "Periode" ,
	"Coaching Date" => "CoachingDate" , 
	"Notes from Previous Coaching" => "NotePrevious" , 
	"Discussion Point" => "DiscussionPoint" , 
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
				echo "<td>".$no++."</td>";
				echo "<td>".$ds->MGR."</td>";
				echo "<td>".$ds->SPV."</td>";
				echo "<td>".$ds->AOCAgent."</td>";
				echo "<td>".$ds->Team."</td>";
				echo "<td>".$ds->Periode."</td>";
				echo "<td>".$ds->CoachingDate."</td>";
				echo "<td>".$ds->NotePrevious."</td>";
				echo "<td>".$ds->DiscussionPoint."</td>";
				echo "<td>".$ds->DevRequired."</td>";
				echo "<td>".$ds->DateSpv."</td>";
				echo "<td>".$ds->DateAgent."</td>";
				echo "<td>".$ds->CoachingType."</td>";
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
