<?php 


if ( !function_exists("date_create") ) {
	function date_create ( $date = "" ) {
		return $date;
	}
}

if ( !function_exists("date_format") ) {
	function date_format ( $date = "" ) {
		return $date;
	}
}


function StandartDateDB ( $date = "" , $stat = '' , $number_formats = "" ) {

	if ( $number_formats != false ) {
		if ( $stat == "1" ) {
			$stat = " 00:00:00";
		} else {
			$stat = " 23:00:00";
		}
	} else {
		$stat = '';
	}

	$date  = explode( "-" , $date);
	$tahun = $date[2];
	$bulan = $date[1];
	$tanggal = $date[0];
	return $tahun . "-" . $bulan . "-" . $tanggal . $stat;
}

/**
 * [_getHardcodeReferral description]
 * @param  string $Product [description]
 * @param  string $Stat    [description]
 * @return [type]          [description]
 * {
	"table": "t_gn_campaign",
	"rows":
	[
		{
			"CampaignId": 1,
			"CampaignDesc": "CIP REGULER"
		},
		{
			"CampaignId": 2,
			"CampaignDesc": "CIP NTB"
		},
		{
			"CampaignId": 3,
			"CampaignDesc": "CIP CC"
		},
		{
			"CampaignId": 4,
			"CampaignDesc": "CIP TOP UP"
		},
		{
			"CampaignId": 5,
			"CampaignDesc": "PIL XSELL"
		},
		{
			"CampaignId": 6,
			"CampaignDesc": "PIL TOP UP"
		},
		{
			"CampaignId": 7,
			"CampaignDesc": "HOSPIN"
		},
		{
			"CampaignId": 8,
			"CampaignDesc": "PA"
		},
		{
			"CampaignId": 9,
			"CampaignDesc": "FLEXI"
		}
	]
}
 */
function _getHardcodeReferral ( $Product = "" , $Stat = "" , $td = "" ) {
	$returnData = "";
	$tab = "\t";
	switch ( $Product ) {
		case strtoupper(trim("Balcon")) : 
			if ( $td == "none" ) {
				$returnData = "Inbound Assets" . $tab . "Lifestyle" . $tab;
				return $returnData;
			} 
			if ( $Stat == "Y" ) {
				$returnData .= "<td>Inbound Assets</td> <td>Lifestyle</td>"; 
			} else {
				$returnData .= "<td></td> <td></td>"; 
			} 
		break;
		case strtoupper(trim("Best Bill")) : 
			if ( $td == "none" ) {
				$returnData = "Inbound Assets" . $tab . "Lifestyle" . $tab;
				return $returnData;
			} 

			if ( $Stat == "Y" ) {
				$returnData .= "<td>Inbound Assets</td> <td>Lifestyle</td>";  
			} else {
				$returnData .= "<td></td> <td></td>"; 
			} 
		break;
		case strtoupper(trim("Best Bill Reg")) : 
			if ( $td == "none" ) {
				$returnData = "" . $tab . "" . $tab;
				return $returnData;
			} 
			if ( $Stat == "Y" ) {
				$returnData .= "<td></td> <td></td>"; 
			} else {
				$returnData .= "<td></td> <td></td>"; 
			} 
		break;
		case strtoupper(trim("CIP")) :
			if ( $td == "none" ) {
				$returnData = "Inbound Assets" . $tab . "Lifestyle" . $tab;
				return $returnData;
			}  
			if ( $Stat == "Y" ) {
				$returnData .= "<td>Inbound Assets</td> <td>Lifestyle</td>";  
			} else {
				$returnData .= "<td></td> <td></td>"; 
			}
		break;
		case strtoupper(trim("CIP ACC")) : 
			if ( $td == "none" ) {
				$returnData = "" . $tab . "" . $tab;
				return $returnData;
			} 
			if ( $Stat == "Y" ) {
				$returnData .= "<td></td> <td></td>"; 
			} else {
				$returnData .= "<td></td> <td></td>"; 
			}
		break;
		case strtoupper(trim("CIP REG")) : 
			if ( $td == "none" ) {
				$returnData = "" . $tab . "" . $tab;
				return $returnData;
			} 

			if ( $Stat == "Y" ) {
				$returnData .= "<td></td> <td></td>"; 
			} else {
				$returnData .= "<td></td> <td></td>"; 
			} 
		break;
		case strtoupper(trim("CIP TOP UP")) : 
			if ( $Stat == "Y" ) {
				$returnData .= "<td></td> <td></td>"; 
			} else {
				$returnData .= "<td></td> <td></td>"; 
			}
		break;
		case strtoupper(trim("CROSS SELL")) : 
			if ( $td == "none" ) {
				$returnData = "" . $tab . "" . $tab;
				return $returnData;
			} 
			if ( $Stat == "Y" ) {
				$returnData .= "<td></td> <td></td>"; 
			} else {
				$returnData .= "<td></td> <td></td>"; 
			} 
		break;
		case strtoupper(trim("FACELIFT")) : 
			if ( $td == "none" ) {
				$returnData = "Inbound Assets" . $tab . "Lifestyle" . $tab;
				return $returnData;
			}

			if ( $Stat == "Y" ) {
				$returnData .= "<td>Inbound Assets</td> <td>Lifestyle</td>";  
			} else {
				$returnData .= "<td></td> <td></td>"; 
			}
		break;
		case strtoupper(trim("Hospin")) :
			if ( $td == "none" ) {
				$returnData = "Inbound Assets" . $tab . "PERML Needs" . $tab;
				return $returnData;
			}
			if ( $Stat == "Y" ) {
				$returnData = "<td>Inbound Assets</td> <td>PERML Needs</td>"; 
			} else {
				$returnData = "<td></td> <td></td>"; 
			}
		break;
		case strtoupper(trim("PIL PA")) : 
			if ( $td == "none" ) {
				$returnData = "Apply Now PIL" . $tab . "Basic Banking" . $tab;
				return $returnData;
			}
			if ( $Stat == "Y" ) {
				$returnData .= "<td>Apply Now PIL</td> <td>Basic Banking</td>"; 
			} else {
				$returnData .= "<td></td> <td></td>"; 
			}
		break;
		case strtoupper(trim("PIL Top Up")) : 
			if ( $td == "none" ) {
				$returnData = "Inbound Assets" . $tab . "Basic Banking" . $tab;
				return $returnData;
			}
			if ( $Stat == "Y" ) {
				$returnData .= "<td>Inbound Assets</td> <td>Basic Banking</td>"; 
			} else {
				$returnData .= "<td></td> <td></td>"; 
			} 
		break;
		case strtoupper(trim("PIL TOPUP")) : 
			if ( $td == "none" ) {
				$returnData = "" . $tab . "" . $tab;
				return $returnData;
			}

			if ( $Stat == "Y" ) {
				$returnData .= "<td></td> <td></td>"; 
			} else {
				$returnData .= "<td></td> <td></td>"; 
			} 
		break;
		case strtoupper(trim("Retro IP")) : 
			if ( $td == "none" ) {
				$returnData = "Inbound Assets" . $tab . "Lifestyle" . $tab;
				return $returnData;
			}
			if ( $Stat == "Y" ) {
				$returnData .= "<td>Inbound Assets</td> <td>Lifestyle</td>"; 
			} else {
				$returnData .= "<td></td> <td></td>"; 
			} 
		break;
		default : 
			if ( $Stat == "Y" ) {
				$returnData .= "<td></td> <td></td>"; 
			} else {
				$returnData .= "<td></td> <td></td>"; 
			} 
		break;
	}
	
	return $returnData;
}



function convert_durations (  $startdate = "" , $enddate = "" ) {
	$startdate = strtotime($startdate);
	$enddate   = strtotime($enddate);
	return trim($enddate - $startdate);
}




?>