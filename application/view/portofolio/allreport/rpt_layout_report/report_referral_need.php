<?php  
		/*  "startdate" => $this->startdate , 
			"enddate"   => $this->enddate , 
			"mgrid"		=> $this->MgrId ,
			"spvid"		=> $this->SpvId ,
			"agentid"	=> $this->AgentId */

$attr_header = array(
	"title" => "Report Referral Need Fulfilled " . $startdate . " - " . $enddate , 
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

$startdate = StandartDateDB($startdate,1 , false);
$enddate   = StandartDateDB($enddate,1 , false);

// echo $agentid;
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
				AND date_format(a.CustomerUpdatedTs, '%Y-%m-%d') <= date('$enddate')"
				.($agentid=='null'||$agentid==""?" ":" AND b.UserId in($agentid)").
				" AND a.CallReasonId in(13,8)
				order by a.CustomerUpdatedTs
				";
// echo $ListCoaching;
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
			if ( $ds->CallReasonId == 8 AND $ds->StatRef == 'Y' 
				OR $ds->CallReasonId == 13 ) {
				echo "<tr>";
					echo "<td>".$no++."</td>";
					echo "<td>".$ds->StaffName."</td>";
					echo "<td>".$ds->Staff."</td>";
					echo "<td>".$ds->AgentId."</td>";
					echo "<td>".$ds->Role."</td>";
					echo "<td>".$ds->Positions."</td>";
					echo "<td>".$ds->ContactDate."</td>";
					echo "<td>".$ds->CustomerNumber."</td>";
					echo "<td>".$ds->CustomerName."</td>";
					echo "<td>".$ds->StatRef."</td>";
					
					echo _getHardcodeReferral($ds->Remarks,$ds->StatRef);

					echo "<td>".$ds->Remarks."</td>";
					echo "<td>".$ds->Result."</td>";
				echo "</tr>";
			} 
		} 	
	} else {
		echo "<tr>";
			echo "<td colspan='13'>Data tidak ada</td>";
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
