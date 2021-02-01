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
	"title" => "Report Absensi Period of " . $startdate . " to " . $enddate , 
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
	"No" => "Staff" ,
	"TSO ID" => "Staffs" ,
	"TSO NAME" => "SPV" , 
	"JAM MASUK KANTOR" => "AOCAgent" , 
	"LOGIN" => "Team" , 
	"LOGOUT" => "Team" ,  
	"LATE" => "Team", 
	"LEADER" => "Team"  
);

$EUI =& get_instance();

$startdate = StandartDateDB($startdate ,1 , false) ;
$enddate   = StandartDateDB($enddate , 0 , false);

//echo $startdate;
//echo $enddate;


function get_perday_absensi ( $date = '' , $AgentId = '' ) {
	global $EUI;
	$ListCoaching = "
		select 
		a.id as IDAgent , 
		a.full_name as AgentName , 	
		if ( c.StartTime is null , date_format(b.ActivityDate , '%Y-%m-%d') , c.StartTime ) as DateAbsen , 
		date_format(min(b.ActivityDate) , '%H:%i:%s') as Login ,
		date_format(max(b.ActivityDate) , '%H:%i:%s') as Logout , 
		d.id as Leader
		from tms_agent a 
		left join t_gn_activitylog b on a.UserId=b.ActivityUserId
		and date_format(b.ActivityDate , '%Y-%m-%d') = '$date'
		left join t_gn_setschedule_agent c on c.AgentId=a.UserId   
		and c.DateSchedule= '$date' 
		left join tms_agent d on a.spv_id=d.UserId
		where 
		a.UserId in($AgentId)
		and a.user_state=1
		group by a.UserId , date_format(b.ActivityDate , '%Y-%m-%d')
		order by a.UserId
	";
	//echo $ListCoaching;
	$fetchCoaching = $EUI->db->query($ListCoaching);
	return $fetchCoaching;
}

//echo $ListCoaching;

function _column ( $column_array = "" ) { 
	//global $column_array;
	//print_r($column_array);
	if ( is_array( $column_array ) ) {
		echo "<thead>";
		foreach ( $column_array as $key => $value ) {
			echo "<td align='center'>".$key."</td>";
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
				$MasukKerja = setScheduleTime(days_name_bydate($ds->DateAbsen) , 'start' , ':00');
				$TotalPengurangan = strtotime($ds->Login) - strtotime($MasukKerja);
				if ( strtotime($ds->Login) < strtotime($MasukKerja) ) {
					$TotalPengurangan = '<span style="color:red;">null</span>';
				} else {
					$TotalPengurangan = '<span style="color:red;">'. gmdate("H:i:s", $TotalPengurangan).'</span>';
				}
				echo "<tr>";
					echo "<td>".$no++."</td>";
					echo "<td>".$ds->IDAgent."</td>";
					echo "<td>".$ds->AgentName."</td>";
					echo "<td>".$MasukKerja."</td>";
					echo "<td>".$ds->Login."</td>";
					echo "<td>".$ds->Logout."</td>";
					echo "<td>".$TotalPengurangan."</td>";
					//echo "<td>".date( "H:i:s" , strtotime( "+1 hours" , $TotalPengurangan))."</td>";
					echo "<td>".$ds->Leader."</td>";
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


<?php 
// looping date

while ( strtotime($startdate) <= strtotime($enddate) ) {
	$fetchCoaching = get_perday_absensi( $startdate , $agentid );
	$cek_hari = days_name_bydate($startdate);
	if ( $cek_hari != 'Minggu' ) {
	?>
		<h3 class="title"><?php echo "Date Absensi :" . $startdate . "(".days_name_bydate($startdate).")"; ?></h3>
		<table class="table">
		<?php  _column($column_array); // set column ?> 
		<?php  _content($fetchCoaching); // set column ?> 
		</table>
	<?php	
	
	}
	
	$startdate =  date('Y-m-d' , strtotime("+1 day" , strtotime($startdate)));
}





 
?>



<?php $this->load->view("allreport/rpt_layout_report/rpt_header/view_footer_report"); ?>
