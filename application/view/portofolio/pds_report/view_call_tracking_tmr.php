<?php
	$this->load->view('call_tracking/view_call_tracking_style');
	
	function dateAsal($dates){
		$newdate = $dates;
		if(strpos($dates,"/")!==false){
			$olddate = explode("/",$dates);
			$newdate = $olddate[2]."-".$olddate[0]."-".$olddate[1];
		}
		return $newdate;
	}
	
	// echo "<pre>";
	// print_r($amount);
	// echo "</pre>";
	// exit();
	
	$RowData1 = (is_array($RowData1)?$RowData1:array())+(is_array($RowDataNull1)?$RowDataNull1:array());
	$RowData2 = (is_array($RowData2)?$RowData2:array())+(is_array($RowDataNull2)?$RowDataNull2:array());
	$RowData3 = (is_array($RowData3)?$RowData3:array())+(is_array($RowDataNull3)?$RowDataNull3:array());
	$RowData4 = (is_array($RowData4)?$RowData4:array())+(is_array($RowDataNull4)?$RowDataNull4:array());
	// echo "<pre>";
	// print_r($LoopUser);
	// echo "</pre>"; exit();
	// echo $param['start_date']."<br>";
	// echo dateAsal($param['start_date']);
?>
<title>Call Tracking Summary per TMR</title>
Call Tracking Summary by Recsource per agent Periode of <?php echo dateAsal($param['start_date']); ?> to <?php echo dateAsal($param['end_date']); ?> <br>
Printed By: <?=_get_session('Username')?> <br>
Print Date: <?=date('m/d/Y H:i:s')?><p></p>

<?php
	$Datasize		= 0;
	$Utilize		= 0;
	
	// Call Initiated
	$Contacted		= 0;
	$Freq_1			= 0;
	$Uncontacted	= 0;
	$Freq_2			= 0;
	$Total			= 0;
	$Freq_3			= 0;
	$PercentageUtil	= 0;
	
	// Contacted
	$D				= 0;
	$ST				= 0;
	$CB				= 0;
	$SA				= 0;
	$PU				= 0;
	$GPU			= 0;	
	$CPGP			= 0;
	$INC			= 0;
	$R				= 0;
	$B				= 0;
	$TotalContact	= 0;
	$PercentageCont	= 0;
	
	// Uncontacted
	$NP				= 0;
	$BT				= 0;
	$NA				= 0;
	$MV				= 0;
	$WN				= 0;
	$IDR				= 0;
	$TotalUncontact	= 0;
	$PercentageUn	= 0;
	
	// ETC
	$AddOn			= 0;
	$DL0			= 0;
	$DL1			= 0;
	$DL2			= 0;
	$DL3			= 0;
	$DL4			= 0;
	$DL5			= 0;
	$DL6			= 0;
	$DL7			= 0;
	$DL8			= 0;
	$DL9			= 0;
	$DL10			= 0;
	$DL11			= 0;
	$DL12			= 0;
	$DL13			= 0;
	$DL14			= 0;
	$DL15			= 0;
	$DL16			= 0;
	$DL17			= 0;
	$DL18			= 0;
	$DL19			= 0;
	$DL20			= 0;
	$DL21			= 0;
	$Etc			= 0;
	$LoanAmount		= 0;
	$Amount			= 0;
	$POD			= 0;
	
	foreach($LoopUser as $ID => $rows){
		echo "agen : ".$rows['id'];
?>

<table border=0 cellpadding=0 cellspacing=0 style='border-collapse:collapse;'>
	<tr>
		<td rowspan=2 class=xl66>Recsource</td>
		<td rowspan=2 class=xl66>Data Size</td>
		<td rowspan=2 class=xl66>Utilized</td>
		<td colspan=6 class=xl66>Call Initiated</td>
		<td rowspan=2 class=xl67>% Utilized</td>
		<td colspan=9 class=xl66>Contacted</td>
		<td colspan=8 class=xl66>Not Contacted</td>
	<?php foreach($LoopDL as $Disagree => $row)
			{
	?>
		<td rowspan=2 class=xl67><?php echo $row; ?></td>
	<?php
			}
	?>
		<td rowspan=2 class=xl67>Lain-lain</td>
		<td rowspan=2 class=xl67>Amount</td>
		<td rowspan=2 class=xl67>Total Registration</td>
		<td rowspan=2 class=xl67>Product</td>
		<td rowspan=2 class=xl67>Total BestBill Registration</td>
	</tr>
	<tr>
		<td class=xl66>Contacted</td>
		<td class=xl66>Freq call/lead</td>
		<td class=xl66>Un Contacted</td>
		<td class=xl66>Freq call/lead</td>
		<td class=xl66>Total</td>
		<td class=xl66>Freq call/lead</td>
		<td class=xl66>D</td>
		<td class=xl66>ST</td>
		<td class=xl66>B</td>
		<td class=xl66>TBO</td>
		<td class=xl66>INC</td>
		<td class=xl66>INC_UNVER</td>
		<td class=xl66>INC_NOTPASS_VER</td>
		<td class=xl66>Total</td>
		<td class=xl66>%</td>
		<td class=xl66>NP</td>
		<td class=xl66>BT</td>
		<td class=xl66>NA</td>
		<td class=xl66>MV</td>
		<td class=xl66>WN</td>
		<td class=xl66>ID</td>
		<td class=xl66>Total</td>
		<td class=xl66>%</td>
	</tr>
	<?php

			foreach($RowData1[$ID] as $Data => $rows1) :
			
			$Recsource		= ($rows1['Recsource'] ? $rows1['Recsource'] : 0);
			$Datasize		= ($rows1['datasize'] ? $rows1['datasize'] : 0);
			$Utilize		= ($RowData3[$ID][$Data]['new_util'] ? $RowData3[$ID][$Data]['new_util'] : 0);
			// $Utilize		= ($RowData2[$ID][$Data]['utilize'] ? $RowData2[$ID][$Data]['utilize'] : 0);
			
			// Contacted
			$D				= ($RowData3[$ID][$Data]['D'] ? $RowData3[$ID][$Data]['D'] : 0);
			$ST				= ($RowData3[$ID][$Data]['ST'] ? $RowData3[$ID][$Data]['ST'] : 0);
			$CB				= ($RowData3[$ID][$Data]['CB'] ? $RowData3[$ID][$Data]['CB'] : 0);
			$INC			= ($RowData3[$ID][$Data]['INC'] ? $RowData3[$ID][$Data]['INC'] : 0);		
			$INC_UNVER		= ($RowData3[$ID][$Data]['INC_UNVER'] ? $RowData3[$ID][$Data]['INC_UNVER'] : 0);		
			$INC_NOTPASS	= ($RowData3[$ID][$Data]['INC_NOTPASS'] ? $RowData3[$ID][$Data]['INC_NOTPASS'] : 0);		
			$B				= ($RowData3[$ID][$Data]['B'] ? $RowData3[$ID][$Data]['B'] : 0);
			$TBO			= ($RowData3[$ID][$Data]['TBO'] ? $RowData3[$ID][$Data]['TBO'] : 0);
			$TotalContact	= ($D + $ST + $CB + $INC + $B + $TBO);
			$TotalContactInit	= ($RowData4[$ID][$Data]['tot_connect'] ? $RowData4[$ID][$Data]['tot_connect'] : 0);
			$PercentageCont	= round(($TotalContact / $Utilize) * 100,2);
			
			// Uncontacted
			$NP				= ($RowData3[$ID][$Data]['NP'] ? $RowData3[$ID][$Data]['NP'] : 0);
			$BT				= ($RowData3[$ID][$Data]['BT'] ? $RowData3[$ID][$Data]['BT'] : 0);
			$NA				= ($RowData3[$ID][$Data]['NA'] ? $RowData3[$ID][$Data]['NA'] : 0);
			$MV				= ($RowData3[$ID][$Data]['MV'] ? $RowData3[$ID][$Data]['MV'] : 0);
			$WN				= ($RowData3[$ID][$Data]['WN'] ? $RowData3[$ID][$Data]['WN'] : 0);
			$IDR			= ($RowData3[$ID][$Data]['ID'] ? $RowData3[$ID][$Data]['ID'] : 0);
			$TotalUncontact	= ($NP + $BT + $NA + $MV + $WN + $IDR);
			$TotalUncontactInit	= ($RowData4[$ID][$Data]['tot_notconnect'] ? $RowData4[$ID][$Data]['tot_notconnect'] : 0);
			$PercentageUn	= round(($TotalUncontact / $Utilize) * 100,2);
			
			$DL0			= ($RowData3[$ID][$Data]['DL0'] ? $RowData3[$ID][$Data]['DL0'] : 0);
			$DL1			= ($RowData3[$ID][$Data]['DL1'] ? $RowData3[$ID][$Data]['DL1'] : 0);
			$DL2			= ($RowData3[$ID][$Data]['DL2'] ? $RowData3[$ID][$Data]['DL2'] : 0);
			$DL3			= ($RowData3[$ID][$Data]['DL3'] ? $RowData3[$ID][$Data]['DL3'] : 0);
			$DL4			= ($RowData3[$ID][$Data]['DL4'] ? $RowData3[$ID][$Data]['DL4'] : 0);
			$DL5			= ($RowData3[$ID][$Data]['DL5'] ? $RowData3[$ID][$Data]['DL5'] : 0);
			$DL6			= ($RowData3[$ID][$Data]['DL6'] ? $RowData3[$ID][$Data]['DL6'] : 0);
			$DL7			= ($RowData3[$ID][$Data]['DL7'] ? $RowData3[$ID][$Data]['DL7'] : 0);
			$DL8			= ($RowData3[$ID][$Data]['DL8'] ? $RowData3[$ID][$Data]['DL8'] : 0);
			$DL9			= ($RowData3[$ID][$Data]['DL9'] ? $RowData3[$ID][$Data]['DL9'] : 0);
			$DL10			= ($RowData3[$ID][$Data]['DL10'] ? $RowData3[$ID][$Data]['DL10'] : 0);
			$DL11			= ($RowData3[$ID][$Data]['DL11'] ? $RowData3[$ID][$Data]['DL11'] : 0);
			$DL12			= ($RowData3[$ID][$Data]['DL12'] ? $RowData3[$ID][$Data]['DL12'] : 0);
			$DL13			= ($RowData3[$ID][$Data]['DL13'] ? $RowData3[$ID][$Data]['DL13'] : 0);
			$DL14			= ($RowData3[$ID][$Data]['DL14'] ? $RowData3[$ID][$Data]['DL14'] : 0);
			$Amount			= ($amount[$ID][$Data]['Amount'] ? $amount[$ID][$Data]['Amount'] : 0);
			$LoanAmount		= ($RowData3[$ID][$Data]['LoadAmount'] ? $RowData3[$ID][$Data]['LoadAmount'] : 0);
			$Total			= $TotalContactInit + $TotalUncontactInit;
			// $Freq_1			= (($Utilize/$TotalContactInit) * 100);
			$Freq_1			= $TotalContactInit/$Utilize; //$TotalContact;
			// $Freq_2			= (($Utilize/$TotalUncontactInit) * 100);
			$Freq_2			= $TotalUncontactInit/$Utilize; //$TotalUncontact;
			// $Freq_3			= (( $Utilize/$Total ) * 100);
			$Freq_3			= ($Total/($TotalContact+$TotalUncontact));
			$PercentageUtil	= (($Utilize / $Datasize) * 100);
	?>
	<tr class=xl74>
		<td class=xl71><?php echo $Recsource; ?></td>
		<td class=xl71><?php echo $Datasize; ?></td>
		<td class=xl71><?php echo $Utilize; ?></td>
		<td class=xl71><?php echo $TotalContactInit; ?></td>
		<td class=xl72><?php echo round($Freq_1,1); ?></td>
		<td class=xl71><?php echo $TotalUncontactInit; ?></td>
		<td class=xl72><?php echo round($Freq_2,1); ?></td>
		<td class=xl71><?php echo $Total; ?></td>
		<td class=xl72><?php echo round($Freq_3,1); ?></td>
		<td class=xl73><?php echo round($PercentageUtil,2); ?>%</td>
		<td class=xl71><?php echo $D; ?></td>
		<td class=xl71><?php echo $ST+$CB; ?></td>
		<td class=xl71><?php echo $B; ?></td>
		<td class=xl71><?php echo $TBO; ?></td>
		<td class=xl71><?php echo $INC; ?></td>
		<td class=xl71><?php echo $INC_UNVER; ?></td>
		<td class=xl71><?php echo $INC_NOTPASS; ?></td>
		<td class=xl71><?php echo $TotalContact; ?></td>
		<td class=xl73 align = "right"><?php echo $PercentageCont; ?>%</td>
		<td class=xl71><?php echo $NP; ?></td>
		<td class=xl71><?php echo $BT; ?></td>
		<td class=xl71><?php echo $NA; ?></td>
		<td class=xl71><?php echo $MV; ?></td>
		<td class=xl71><?php echo $WN; ?></td>
		<td class=xl71><?php echo $IDR; ?></td>
		<td class=xl71><?php echo $TotalUncontact; ?></td>
		<td class=xl73><?php echo $PercentageUn; ?>%</td>
		<?php
			foreach($LoopDL as $Dis => $baris) 
			{
				$sDL[$ID][$baris]	+= $RowData3[$ID][$Data][$baris];
				$DL				= ($RowData3[$ID][$Data][$baris] ? $RowData3[$ID][$Data][$baris] : 0);
		?>
		<td class=xl71><?php echo $DL; ?></td>
		<?php
			}
			$sDataSize[$ID]['sDataSize']	+= $Datasize;
			$sUtilize[$ID]['sUtilize']		+= $Utilize;
			$sAmount[$ID]['sAmount']		+= $Amount;
			
			$sContacted[$ID]['sContacted']	+= $TotalContact;
			$sContactedInit[$ID]['sContacted']	+= $TotalContactInit;
			
			$sUncontact[$ID]['sUncontact']	+= $TotalUncontact;
			$sUncontactInit[$ID]['sUncontact']	+= $TotalUncontactInit;
			
			$sD[$ID]['sD']					+= $D;
			$sST[$ID]['sST']				+= $ST;
			$sCB[$ID]['sCB']				+= $CB;
			$sB[$ID]['sB']					+= $B;
			$sTBO[$ID]['sTBO']				+= $TBO;
			$sINC[$ID]['sINC']				+= $INC;
			$sINC_UNVER[$ID]['sINC_UNVER']	+= $RowData3[$ID][$Data]['INC_UNVER'];
			$sINC_NOTPASS[$ID]['sINC_NOTPASS']	+= $RowData3[$ID][$Data]['INC_NOTPASS'];
			
			$sNP[$ID]['sNP']			+= $NP;
			$sBT[$ID]['sBT']			+= $BT;
			$sNA[$ID]['sNA']			+= $NA;
			$sMV[$ID]['sMV']			+= $MV;
			$sWN[$ID]['sWN']			+= $WN;
			$sID[$ID]['sID']			+= $IDR;
			$sAddOn[$ID]['sAddOn']		+= $AddOn;
			// $sEtc[$ID]['sEtc']			+= $Etc;
			$sPOD						+= $POD;
		?>
		<td class=xl71><?php echo $Etc; ?></td>
		<td class=xl71><?php echo $Amount; ?></td>
		<td class=xl71><?php echo $INC ?></td>
		<td class=xl71><?php echo $product[_get_post('Campaign')]; ?></td>
		<td class=xl71><?php echo $POD; ?></td>
	</tr>
	<?php
		
			endforeach;
			
			// $sFreq_1[$ID]['sFreq_1']		= (( $sUtilize[$ID]['sUtilize'] / $sContactedInit[$ID]['sContacted'] ) * 100);
			$sFreq_1[$ID]['sFreq_1']		= $sContactedInit[$ID]['sContacted']/$sUtilize[$ID]['sUtilize']; //$sContacted[$ID]['sContacted'];
			// $sFreq_2[$ID]['sFreq_2']		= (($sUtilize[$ID]['sUtilize'] / $sUncontactInit[$ID]['sUncontact'] ) * 100);
			$sFreq_2[$ID]['sFreq_2']		= $sUncontactInit[$ID]['sUncontact']/$sUtilize[$ID]['sUtilize']; //$sUncontact[$ID]['sUncontact'];
			$sTotal[$ID]['sTotal']			= ($sContactedInit[$ID]['sContacted'] + $sUncontactInit[$ID]['sUncontact']);
			// $sFreq_3[$ID]['sFreq_3']		= (($sUtilize[$ID]['sUtilize'] / $sTotal[$ID]['sTotal'] ) * 100);
			$sFreq_3[$ID]['sFreq_3']		= ($sTotal[$ID]['sTotal']/($sContacted[$ID]['sContacted']+$sUncontact[$ID]['sUncontact']));

			$sPerUtil[$ID]['sPerUtil']		= (($sUtilize[$ID]['sUtilize'] /$sDataSize[$ID]['sDataSize'] ) * 100);
			$sPerContact[$ID]['sPerContact']	= (($sContacted[$ID]['sContacted'] / $sUtilize[$ID]['sUtilize']) * 100);
			$sPerUncontact[$ID]['sPerUncontact']	= (($sUncontact[$ID]['sUncontact'] / $sUtilize[$ID]['sUtilize']) * 100);
			
	?>
	<tr>
		<td class=xl66>Total</td>
		<td class=xl66><?php echo $sDataSize[$ID]['sDataSize']; ?></td>
		<td class=xl66><?php echo $sUtilize[$ID]['sUtilize']; ?></td>
		<td class=xl66><?php echo $sContactedInit[$ID]['sContacted']; ?></td>
		<td class=xl66><?php echo round($sFreq_1[$ID]['sFreq_1'],1); ?></td>
		<td class=xl66><?php echo $sUncontactInit[$ID]['sUncontact']; ?></td>
		<td class=xl66><?php echo round($sFreq_2[$ID]['sFreq_2'],1); ?></td>
		<td class=xl66><?php echo $sTotal[$ID]['sTotal']; ?></td>
		<td class=xl66><?php echo round($sFreq_3[$ID]['sFreq_3'],1); ?></td>
		<td class=xl86><?php echo round($sPerUtil[$ID]['sPerUtil'],2); ?> %</td>
		<td class=xl66><?php echo $sD[$ID]['sD']; ?></td>
		<td class=xl66><?php echo $sST[$ID]['sST']+$sCB[$ID]['sCB']; ?></td>
		<td class=xl66><?php echo $sB[$ID]['sB']; ?></td>
		<td class=xl66><?php echo $sTBO[$ID]['sTBO']; ?></td>
		<td class=xl66><?php echo $sINC[$ID]['sINC']; ?></td>
		<td class=xl66><?php echo $sINC_UNVER[$ID]['sINC_UNVER']; ?></td>
		<td class=xl66><?php echo $sINC_NOTPASS[$ID]['sINC_NOTPASS']; ?></td>
		<td class=xl66><?php echo $sContacted[$ID]['sContacted']; ?></td>
		<td class=xl86><?php echo round($sPerContact[$ID]['sPerContact'],2); ?> %</td>
		<td class=xl66><?php echo $sNP[$ID]['sNP']; ?></td>
		<td class=xl66><?php echo $sBT[$ID]['sBT']; ?></td>
		<td class=xl66><?php echo $sNA[$ID]['sNA']; ?></td>
		<td class=xl66><?php echo $sMV[$ID]['sMV']; ?></td>
		<td class=xl66><?php echo $sWN[$ID]['sWN']; ?></td>
		<td class=xl66><?php echo $sID[$ID]['sID']; ?></td>
		<td class=xl66><?php echo $sUncontact[$ID]['sUncontact']; ?></td>
		<td class=xl86><?php echo round($sPerUncontact[$ID]['sPerUncontact'],2); ?> %</td>
		<?php
			foreach($LoopDL as $keys => $DLx) {
		?>
		<td class=xl66><?php echo $sDL[$ID][$DLx]; //$sDL[$DLx]; ?></td>
		<?php
			}
		?>
		<td class=xl66><?php echo $sEtc; ?></td>
		<td class=xl66><?php echo $sAmount[$ID]['sAmount']; ?></td>
		<td class=xl66><?php echo $sINC[$ID]['sINC'] ?></td>
		<td class=xl66><?php echo "-"; ?></td>
		<td class=xl66><?php echo $sPOD; ?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<?php
	}
?>