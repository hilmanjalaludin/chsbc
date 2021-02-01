<html>
<head>
<title>Campaign Tracking Report</title>
</head>
<body>
	<style>
	table.grid{}
	td.header { background-color:#2182bf;font-family:Arial;font-weight:bold;color:#f1f5f8;font-size:12px;padding:5px;} 
	td.sub { background-color:#FF9900;font-family:Arial;font-weight:bold;color:#000000;font-size:12px;padding:5px;} 
	td.content { padding:2px;height:24px;font-family:Arial;font-weight:normal;color:#456376;font-size:12px;background-color:#f9fbfd;} 
	td.first {border-left:1px solid #dddddd;border-top:1px solid #dddddd;border-bottom:0px solid #dddddd;}
	td.middle {border-left:1px solid #dddddd;border-bottom:0px solid #dddddd;border-top:1px solid #dddddd;}
	td.lasted {border-left:1px solid #dddddd; border-bottom:0px solid #dddddd; border-right:1px solid #dddddd; border-top:1px solid #dddddd;}
	td.agent{font-family:Arial;font-weight:normal;font-size:12px;padding-top:5px;padding-bottom:5px;border-left:0px solid #dddddd; 
			border-bottom:0px solid #dddddd; border-right:0px solid #dddddd; border-top:0px solid #dddddd;
			background-color:#fcfeff;padding-left:2px;color:#06456d;font-weight:bold;}
	h1.agent{font-style:inherit; font-family:Trebuchet MS;color:blue;font-size:14px;color:#2182bf;}
	
	td.total{
				padding:2px;font-family:Arial;font-weight:normal;font-size:12px;padding-top:5px;padding-bottom:5px;border-left:0px solid #dddddd; 
			border-bottom:1px solid #dddddd; border-top:1px solid #dddddd;  
			border-right:1px solid #dddddd; border-top:1px solid #dddddd;
			background-color:#2182bf;padding-left:2px;color:#f1f5f8;font-weight:bold;}
	
	.middle{color:#306407;font-family:Trebuchet MS;font-size:14px;line-height:18px;}
	.judul{color:#306407;font-family:Trebuchet MS;font-size:18px;line-height:18px;}
	
	td.subtotal{ font-family:Arial;font-weight:bold;color:#3c8a08;height:30px;background-color:#FFFCCC;}
	td.tanggal{ font-weight:bold;color:#FF4321;height:22px;background-color:#FFFFFF;height:30px;}
	h3{color:#306407;font-family:Trebuchet MS;font-size:14px;}
	h4{color:#FF4321;font-family:Trebuchet MS;font-size:14px;}
</style>
<?php
	$Today = date("d-m-Y");
 ?>
<div align="center">
	<font class="judul">
		<u>Campaign Tracking Report</u><p></p>
	</font>
</div>
<font class="middle">
	User Insert Date : <?php __(_get_post('start_date')); ?> s/d <?php __(_get_post('end_date')); ?>
</font><p></p>
<table class="grid" cellpadding="0" cellspacing="0" width="100%" bgcolor="red">
	<tr>
		<td colspan=14 class="sub first">Actual</td>
	</tr>
	<tr>
		<td rowspan=2 colspan=2 class="header first" align="center">Campaign Name</td>
		<td rowspan=2 class="header middle" align="center">Leadsize (Given)</td>
		<td colspan=2 class="header middle" align="center">Leads Utilized</td>
		<td rowspan=2 class="header middle" align="center">Leads Contacted</td>
		<td rowspan=2 class="header middle" align="center">Sales submit</td>
		<td rowspan=2 class="header middle" align="center">List Usage Rate</td>
		<td rowspan=2 class="header middle" align="center">Contact Rate</td>
		<td rowspan=2 class="header middle" align="center">Conver'n Rate 1</td>
		<td rowspan=2 class="header middle" align="center">Conver'n Rate 2</td>
		<td rowspan=2 class="header middle" align="center">Total Cases</td>
		<td rowspan=2 class="header middle" align="center">ANP<br>(in Rp)</td>
		<td rowspan=2 class="header lasted" align="center">AARP<br>(in Rp)</td>
	</tr>
	<tr>
		<td class="header middle" align="center">New</td>
		<td class="header middle" align="center">Old</td>
		<!-- <td class="header middle" align="center">Remaining</td> -->
	</tr>
	<?php
		$ListUsage 	 = 0;
		$ContactRate = 0;
		$Conver1	 = 0;
		$Conver2	 = 0;
		$AARP	 	 = 0;
		
		if(is_array($view)) foreach ($view as $CampaignId => $rows) :
		
		$ListUsage	 = ((($view6[$CampaignId]['UtilizedNew'] + $view7[$CampaignId]['UtilizedOld']) / $rows['LeadGiven']) * 100);
		$ContactRate = (($view3[$CampaignId]['LeadContacted'] / $rows['LeadGiven']) * 100);
		$Conver1	 = (($view4[$CampaignId]['SalesSubmit'] / $rows['LeadGiven']) * 100);
		$Conver2	 = (($view4[$CampaignId]['SalesSubmit'] / $view3[$CampaignId]['LeadContacted']) * 100);
		$AARP	 	 = ($view4[$CampaignId]['ANP'] / $view5[$CampaignId]['TotalCases']);
	?>
	<tr>
		<td colspan=2 class="header first"><?php __($rows['BatchName']); ?></td>
		<td class="content first" align="right"><?php echo number_format($rows['LeadGiven']); ?></td>
		<td class="content middle" align="right"><?php echo ($view6[$CampaignId]['UtilizedNew']?number_format($view6[$CampaignId]['UtilizedNew']):0); ?></td>
		<td class="content middle" align="right"><?php echo ($view7[$CampaignId]['UtilizedOld']?number_format($view7[$CampaignId]['UtilizedOld']):0); ?></td>
		<!-- <td class="content middle" align="right"><#?php echo ($view8[$CampaignId]['UtilizedRemaining']?number_format($view8[$CampaignId]['UtilizedRemaining']):0); ?></td> -->
		<td class="content middle" align="right"><?php echo ($view3[$CampaignId]['LeadContacted']?number_format($view3[$CampaignId]['LeadContacted']):0); ?></td>
		<td class="content middle" align="right"><?php echo ($view4[$CampaignId]['SalesSubmit']?number_format($view4[$CampaignId]['SalesSubmit']):0); ?></td>
		<td class="content middle" align="right"><?php echo number_format($ListUsage,2); ?> %</td>
		<td class="content middle" align="right"><?php echo number_format($ContactRate,2); ?> %</td>
		<td class="content middle" align="right"><?php echo number_format($Conver1,2); ?> %</td>
		<td class="content middle" align="right"><?php echo number_format($Conver2,2); ?> %</td>
		<td class="content middle" align="right"><?php echo ($view5[$CampaignId]['TotalCases']?number_format($view5[$CampaignId]['TotalCases']):0); ?></td>
		<td class="content middle" align="right">Rp. <?php echo ($view4[$CampaignId]['ANP']?number_format($view4[$CampaignId]['ANP']):0); ?></td>
		<td class="content lasted" align="right">Rp. <?php echo number_format($AARP); ?></td>
	</tr>
	<?php
		$sListUsage = 0;
		$sContactRate = 0;
		$sConver1 = 0;
		$sConver2 = 0;
		$sAARP = 0;

		$sLeadsGiven += $rows['LeadGiven'];
		$sUtilizedNew += $view6[$CampaignId]['UtilizedNew'];
		$sUtilizedOld += $view7[$CampaignId]['UtilizedOld'];
		$sUtilizedRemaining += $view8[$CampaignId]['UtilizedRemaining'];
		$sLeadContacted += $view3[$CampaignId]['LeadContacted'];
		$sSalesSubmit += $view4[$CampaignId]['SalesSubmit'];
		$sListUsage = ((($sUtilizedNew + $sUtilizedOld) / $sLeadsGiven) * 100);
		$sContactRate += (($sLeadContacted / $sLeadsGiven) * 100);
		$sConver1 += (($sSalesSubmit / $sLeadsGiven) * 100);
		$sConver2 += (($sSalesSubmit / $sLeadContacted) * 100);
		$sTotalCases += $view5[$CampaignId]['TotalCases'];
		$sAnp += $view4[$CampaignId]['ANP'];
		$sAarp = ($sAnp / $sTotalCases);
		
		endforeach;
	?>
	<tr>
		<td colspan=2 class="total first" align="center">Total</td>
		<td class="total middle" align="right"><?php echo number_format($sLeadsGiven); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sUtilizedNew); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sUtilizedOld); ?></td>
		<!-- <td class="total middle" align="right"><#?php echo number_format($sUtilizedRemaining); ?></td> -->
		<td class="total middle" align="right"><?php echo number_format($sLeadContacted); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sSalesSubmit); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sListUsage,2); ?> %</td>
		<td class="total middle" align="right"><?php echo number_format($sContactRate,2); ?> %</td>
		<td class="total middle" align="right"><?php echo number_format($sConver1,2); ?> %</td>
		<td class="total middle" align="right"><?php echo number_format($sConver2,2); ?> %</td>
		<td class="total middle" align="right"><?php echo number_format($sTotalCases); ?></td>
		<td class="total middle" align="right">Rp. <?php echo number_format($sAnp); ?></td>
		<td class="total lasted" align="right">Rp. <?php echo number_format($sAarp); ?></td>
	</tr>
	<tr>
		<td colspan=14 class="sub first">Target</td>
	</tr>
	<tr>
		<td rowspan=2 colspan=2 class="header first" align="center">Campaign Name</td>
		<td rowspan=2 colspan=2 class="header middle" align="center">Contact Rate</td>
		<td rowspan=2 colspan=2 class="header middle" align="center">Convertion Rate 1</td>
		<td rowspan=2 colspan=2 class="header middle" align="center">Convertion Rate 2</td>
		<td rowspan=2 class="header middle" align="center">Total Cases</td>
		<td rowspan=2 colspan=2 class="header middle" align="center">ANP Submit</td>
		<td rowspan=2 colspan=3 class="header lasted" align="center">AARP</td>
	</tr>
	<tr>
		<?php
			if(is_array($view_target)) foreach ($view_target as $Target => $rows) :
			
			$tCampaignName = $view_target[$Target]['CampaignName'];
			$tContactRate = ($view_target[$Target]['tContactRate']?$view_target[$Target]['tContactRate']:0);
			$tConver1 = ($view_target[$Target]['tConver1']?$view_target[$Target]['tConver1']:0);
			$tConver2 = ($view_target[$Target]['tConver2']?$view_target[$Target]['tConver2']:0);
			$tCases = ($view_target[$Target]['tCases']?$view_target[$Target]['tCases']:0);
			$tANP = ($view_target[$Target]['tANP']?$view_target[$Target]['tANP']:0);
			$tAARP = ($view_target[$Target]['tAARP']?$view_target[$Target]['tAARP']:0);
			
		 ?>
	</tr>	 
	<tr>
		<td colspan=2 class="total first"><?php echo $tCampaignName; ?></td>
		<td colspan=2 class="content middle" align="right"><?php echo $tContactRate; ?> %</td>
		<td colspan=2 class="content middle" align="right"><?php echo $tConver1; ?> %</td>
		<td colspan=2 class="content middle" align="right"><?php echo $tConver2; ?> %</td>
		<td class="content middle" align="right"><?php echo $tCases; ?></td>
		<td colspan=2 class="content middle" align="right">Rp. <?php echo number_format($tANP); ?></td>
		<td colspan=3 class="content lasted" align="right">Rp. <?php echo number_format($tAARP); ?></td>
	</tr>
		<?php
			endforeach;
		 ?>
	<tr>
		<td colspan=14 class="total first" align="center">&nbsp;</td>
	</tr>
	<tr>
		<td colspan=14 class="sub first">Achievement %</td>
	</tr>
	<tr>
		<td rowspan=2 colspan=2 class="header first" align="center">Campaign Name</td>
		<td rowspan=2 class="header middle" align="center">#Database</td>
		<td rowspan=2 colspan=2 class="header middle" align="center">Contact Rate</td>
		<td rowspan=2 colspan=2 class="header middle" align="center">Convertion Rate 1</td>
		<td rowspan=2 colspan=2 class="header middle" align="center">Convertion Rate 2</td>
		<td rowspan=2 class="header middle" align="center">Total Cases</td>
		<td rowspan=2 colspan=2 class="header middle" align="center">ANP Submit</td>
		<td rowspan=2 colspan=2 class="header lasted" align="center">AARP</td>
	</tr>
	<tr>
			<?php
				// $achLead = 0;
				
				if(is_array($view)) foreach ($view as $Achievement => $rows) :
				
				// $achLead = ($tDatabase);
				$achLead = $rows['LeadGiven'] / $tDatabase;
				$achContactRate = $ContactRate / $tContactRate;
			?>
	</tr>
	<tr>
		<td colspan=2 class="total first"><?php echo $rows['BatchName']; ?></td>
		<td class="content first" align="right"><?php echo $achLead; ?></td>
		<td colspan=2 class="content middle" align="right"><?php echo $achContactRate; ?> %</td>
		<td colspan=2 class="content middle" align="right">&nbsp; %</td>
		<td colspan=2 class="content middle" align="right">&nbsp; %</td>
		<td class="content middle" align="right">&nbsp;</td>
		<td colspan=2 class="content middle" align="right">Rp. &nbsp;</td>
		<td colspan=2 class="content lasted" align="right">Rp. &nbsp;</td>
	</tr>
			<?php
				endforeach;
			?>
	<tr>
		<td colspan=2 class="total first" align="center">Total</td>
		<td class="total middle" align="right">&nbsp;</td>
		<td colspan=2 class="total middle" align="right">&nbsp; %</td>
		<td colspan=2 class="total middle" align="right">&nbsp; %</td>
		<td colspan=2 class="total middle" align="right">&nbsp; %</td>
		<td class="total middle" align="right">&nbsp;</td>
		<td colspan=2 class="total middle" align="right">Rp. &nbsp;</td>
		<td colspan=2 class="total lasted" align="right">Rp. &nbsp;</td>
	</tr>
</table>
</body>
</html>