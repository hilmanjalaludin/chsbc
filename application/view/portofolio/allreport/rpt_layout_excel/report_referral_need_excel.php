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
	"No" => "No" ,
	"Staff Name" => "Staff" ,
	"Staff" => "Staffs" ,
	"AOC/Login Name" => "SPV" , 
	"Role" => "AOCAgent" , 
	"Position" => "Team" , 
	"Contact Date" => "Periode" ,
	"Customer Number" => "CoachingDate" , 
	"Customer Name" => "CoachingDate" , 
	"Referral (Y/N)" => "NotePrevious" , 
	"Refer To" => "DiscussionPoint" , 
	"Customer Needs" => "DevRequired" , 
	"Remarks" => "DateSpv" , 
	"Result" => "DateAgent" 
);

$EUI =& get_instance();

$startdate = StandartDateDB($startdate);
$enddate   = StandartDateDB($enddate);

//echo $startdate;
//echo $enddate;

$ListCoaching = "select 
				b.full_name as StaffName ,
				b.id as Staff ,
				b.full_name as AgentId , 
				if(b.telphone=1,'Outbound','') as Role , 
				'Telesales Portofolio' as Positions , 
				a.CustomerUpdatedTs as ContactDate , 
				a.CustomerNumber as CustomerNumber ,
				a.CustomerFirstName as CustomerName ,
				if(c.CustomerId is not null , 'Y' , 'N') as StatRef , 
				'Inbound Assets' as ReferTo , 
				'Basic Banking' as CustomerNeeds ,
				if(f.CampaignDesc is not null , f.CampaignDesc , e.CampaignDesc ) as Remarks , 
				d.CallReasonDesc as Result ,
				d.CallReasonId as CallReasonId 
				from t_gn_customer a 
				inner join tms_agent b on a.SellerId=b.UserId
				left join t_gn_referral c on a.CustomerId=c.CustomerId
				left join t_lk_callreason d on a.CallReasonId=d.CallReasonId
				left join t_gn_campaign e on a.CampaignId=e.CampaignId
				left join t_gn_campaign f on c.ProductId=f.CampaignId
				where  
				date_format(a.CustomerUpdatedTs, '%Y-%m-%d') >= date('$startdate')
				AND date_format(a.CustomerUpdatedTs, '%Y-%m-%d') <= date('$enddate')
				AND b.UserId in($agentid)
				AND a.CallReasonId in(13,8)
				order by a.CustomerUpdatedTs";

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
	foreach ( $fetchCoaching->result() as $ds ) {
		if ( $ds->CallReasonId == 8 AND $ds->StatRef == 'Y' 
				OR $ds->CallReasonId == 13 ) {
			echo $number++ . $tab;
			echo $ds->StaffName . $tab;
			echo $ds->Staff . $tab;
			echo $ds->AgentId . $tab;
			echo $ds->Role . $tab;
			echo $ds->Positions . $tab;
			echo $ds->ContactDate . $tab;
			echo $ds->CustomerNumber . $tab;
			echo $ds->CustomerName . $tab;
			echo $ds->StatRef . $tab;			
			echo _getHardcodeReferral($ds->Remarks,$ds->StatRef , 'none') ;
			echo $ds->Remarks . $tab;
			echo $ds->Result . $tab;
			echo $enterline;
		}
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