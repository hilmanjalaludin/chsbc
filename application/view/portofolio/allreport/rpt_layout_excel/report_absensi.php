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

$startdate = StandartDateDB($startdate);
$enddate   = StandartDateDB($enddate);

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

function _column ($column_array = "") {
	global $tab;
	
}

echo $enterline;



function _content ( $datas = "" ) { 
	$tab = "\t";
	$enterline = "\n";
	$no = 1;
	if ( $datas == true AND $datas->num_rows() > 0 ) {
		foreach ( $datas->result() as $ds ) {
				$MasukKerja = setScheduleTime(days_name_bydate($ds->DateAbsen) , 'start' , ':00');
				$TotalPengurangan = strtotime($ds->Login) - strtotime($MasukKerja);
				if ( strtotime($ds->Login) < strtotime($MasukKerja) ) {
					$TotalPengurangan = 'null';
				} else {
					$TotalPengurangan = gmdate("H:i:s", $TotalPengurangan);
				}
					echo $no++. $tab ;
					echo $ds->IDAgent. $tab ;
					echo $ds->AgentName. $tab ;
					echo $MasukKerja. $tab ;
					echo $ds->Login. $tab ;
					echo $ds->Logout. $tab ;
					echo $TotalPengurangan. $tab ;
					//echo date( "H:i:s" , strtotime( "+1 hours" , $TotalPengurangan)). $tab ;
					echo $ds->Leader. $tab ;	
					echo $enterline;		
		} 	
	} else {
		echo "Data tidak ada";	
	}
}



while ( strtotime($startdate) <= strtotime($enddate) ) {
	$fetchCoaching = get_perday_absensi( $startdate , $agentid );
	$cek_hari = days_name_bydate($startdate);
	if ( $cek_hari != 'Minggu' ) {
		echo $enterline; 
		echo "Date Absensi :" . $startdate . "(".days_name_bydate($startdate).")"; 
		echo $enterline; 
		if ( is_array($column_array) ) {
			foreach ( $column_array as $key => $value ) {
				echo $key . $tab;
			}
		} 
		_column($column_array); // set column  
		echo $enterline; 
		_content($fetchCoaching); // set column 
	}

	$startdate =  date('Y-m-d' , strtotime("+1 day" , strtotime($startdate)));
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