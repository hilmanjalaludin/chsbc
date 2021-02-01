<html>
<head>
<title>TSR Sales Tracking Report</title>
</head>
<body>
	<style>
	table.grid{}
	td.header { background-color:#2182bf;font-family:Arial;font-weight:bold;color:#f1f5f8;font-size:12px;padding:5px;}
	td.atm { background-color:#FFCC66;font-family:Arial;font-weight:bold;color:#FFFFFF;font-size:12px;padding:5px;} 
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
		<u>TSR Sales Tracking Report</u><p></p>
	</font>
</div>
<font class="middle">
	User Insert Date : <?php __(_get_post('start_date')); ?> s/d <?php __(_get_post('end_date')); ?>
</font><p></p>
<table class="grid" cellpadding="0" cellspacing="0" width="100%" bgcolor="red">
	<tr>
		<td colspan=17 class="sub first">Actual</td>
	</tr>
	<?php
		if(is_array($view_atm)) foreach ($view_atm as $AtmId => $atm) :
	?>
	<tr>
		<td colspan=17 class="atm first">Supervisor: <?php echo $atm['ATM']; ?></td>
	</tr>
		<?php
			if(is_array($view_spv)) foreach ($view_spv as $SpvId => $rows) :
		?>
	<tr>
		<td colspan=17 class="agent first">Team Leader: <?php echo $rows['SPV']; ?></td>
	</tr>
	<tr>
		<td rowspan=2 colspan=2 class="header first">&nbsp;</td>
		<td rowspan=2 class="header middle" align="center">Leadsize (Given)</td>
		<td colspan=3 class="header middle" align="center">Leads Utilized</td>
		<td rowspan=2 class="header middle" align="center">Leads Contacted</td>
		<td rowspan=2 class="header middle" align="center">Call Attempt</td>
		<td rowspan=2 class="header middle" align="center">Sales submit</td>
		<td rowspan=2 class="header middle" align="center">List Usage Rate</td>
		<td rowspan=2 class="header middle" align="center">Contact Rate</td>
		<td rowspan=2 class="header middle" align="center">Conver'n Rate 1</td>
		<td rowspan=2 class="header middle" align="center">Conver'n Rate 2</td>
		<td rowspan=2 class="header middle" align="center">Total Cases</td>
		<td rowspan=2 class="header middle" align="center">ANP<br>(Submit)</td>
		<td rowspan=2 class="header middle" align="center">ANP<br>(Issued)</td>
		<td rowspan=2 class="header lasted" align="center">AARP<br>(in Rp)</td>
	</tr>
	<tr>
		<td class="header middle" align="center">New</td>
		<td class="header middle" align="center">Old</td>
		<td class="header middle" align="center">Remaining</td>
	</tr>
			<?php
				$ListUsage = 0;
				$ContactRate = 0;
				$Conver1 = 0;
				$Conver2 = 0;
				$AARP = 0;
				
				if(is_array($view_agent)) foreach ($view_agent as $AgentId => $agent) :
				
				$AgentName		= ($agent['Agent']?$agent['Agent']:'&nbsp;');
				$LeadSize		= ($size[$AgentId]['LeadSize']?$size[$AgentId]['LeadSize']:0);
				$NewUtilized	= ($data_new[$AgentId]['LeadNew']?$data_new[$AgentId]['LeadNew']:0);
				$OldUtilized	= ($data_old[$AgentId]['LeadOld']?$data_old[$AgentId]['LeadOld']:0);
				$Remaining		= ($data_remain[$AgentId]['Remaining']?$data_remain[$AgentId]['Remaining']:0);
				$Contact		= ($attempt[$AgentId]['Jumlah']?$attempt[$AgentId]['Jumlah']:0);
				$CallAttempt	= ($attempt[$AgentId]['Attempt']?$attempt[$AgentId]['Attempt']:0);
				$SalesSubmit	= ($sales[$AgentId]['Sales']?$sales[$AgentId]['Sales']:0);
				$TotalCases		= ($cases[$AgentId]['TotalCases']?$cases[$AgentId]['TotalCases']:0);
				$ANP			= ($sales[$AgentId]['ANP']?$sales[$AgentId]['ANP']:0);
				
				$ListUsage = (($NewUtilized + $OldUtilized) / $LeadSize);
				$ContactRate = ($Contact / $LeadSize);
				$Conver1 = ($SalesSubmit / $LeadSize);
				$Conver2 = ($SalesSubmit / $Contact);
				$AARP = ($ANP / $TotalCases);
			?>
			
			
			
			<?php
			$AARP='sadf';
			// var_dump($AARP);
				$Target['ConRate']			= $Tar['ConRate'];
				$Target['CasesSubmited']	= $Tar['CasesSubmited'];
				$Target['ConvertRate1']		= $Tar['ConvertRate1'];
				$Target['ANPSubmit']		= $Tar['ANPSubmit'];
				$Target['ConvertRate2']		= $Tar['ConvertRate2'];
				$Target['AARP']				= $Tar['AARP'];
			?>
			
			
			
	<tr>
		<td colspan=2 class="header first"><?php echo $AgentName; ?></td>
		<td class="content first" align="right"><?php echo number_format($LeadSize); ?></td>
		<td class="content middle" align="right"><?php echo number_format($NewUtilized); ?></td>
		<td class="content middle" align="right"><?php echo number_format($OldUtilized); ?></td>
		<td class="content middle" align="right"><?php echo number_format($Remaining); ?></td>
		<td class="content middle" align="right"><?php echo number_format($Contact); ?></td>
		<td class="content middle" align="right"><?php echo number_format($CallAttempt); ?></td>
		<td class="content middle" align="right"><?php echo round($SalesSubmit); ?></td>
		<td class="content middle" align="right"><?php echo round($ListUsage,2) ?> %</td>
		<td class="content middle" align="right"><?php echo round($ContactRate,2) ?> %</td>
		<td class="content middle" align="right"><?php echo round($Conver1,2) ?> %</td>
		<td class="content middle" align="right"><?php echo round($Conver2,2) ?> %</td>
		<td class="content middle" align="right"><?php echo number_format($TotalCases); ?></td>
		<td class="content middle" align="right">Rp. <?php echo number_format($ANP); ?></td>
		<td class="content middle" align="right">Rp. &nbsp;</td>
		<td class="content lasted" align="right">Rp. <?php echo number_format($AARP); ?></td>
	</tr>
			<?php
				$sListUsage = 0;
				$sContactRate = 0;
				$sConver1 = 0;
				$sConver2 = 0;
				$sAarp = 0;
			
				$sLeadGiven += $LeadSize;
				$sUtilizedNew += $NewUtilized;
				$sUtilizedOld += $OldUtilized;
				$sUtilizedRemaining += $Remaining;
				$sContacted += $Contact;
				$sAttempt += $CallAttempt;
				$sSalesSubmit += $SalesSubmit;
				$sListUsage = (($sUtilizedNew + $sUtilizedOld) / $sLeadGiven);
				$sContactRate = ($sContacted / $sLeadGiven);
				$sConver1 = ($sSalesSubmit / $sLeadGiven);
				$sConver2 = ($sSalesSubmit / $sContacted);
				$sTotalCases += $TotalCases;
				$sAnp += $ANP;
				$sAarp = ($sAnp / $sTotalCases);
				
				endforeach;
			?>
	<tr>
		<td colspan=2 class="total first">Total</td>
		<td class="total middle" align="right"><?php echo number_format($sLeadGiven); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sUtilizedNew); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sUtilizedOld); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sUtilizedRemaining); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sContacted); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sAttempt); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sSalesSubmit); ?></td>
		<td class="total middle" align="right"><?php echo round($sListUsage,2); ?> %</td>
		<td class="total middle" align="right"><?php echo round($sContactRate,2); ?> %</td>
		<td class="total middle" align="right"><?php echo round($sConver1,2); ?> %</td>
		<td class="total middle" align="right"><?php echo round($sConver2,2); ?> %</td>
		<td class="total middle" align="right"><?php echo number_format($sTotalCases); ?></td>
		<td class="total middle" align="right">Rp. <?php echo number_format($sAnp); ?></td>
		<td class="total middle" align="right">Rp. &nbsp;</td>
		<td class="total lasted" align="right">Rp. <?php echo number_format($sAarp); ?></td>
	</tr>
		<?php
			endforeach;
		?>
	<tr>
		<td colspan=17 class="sub first">Target</td>
	</tr>
	<tr>
		<td colspan=17 class="agent first">Team Leader: <?php echo $rows['SPV']; ?></td>
	</tr>
	<tr>
		<td rowspan=2 colspan=2 class="header first" align="center">Campaign Name</td>
		<td rowspan=2 colspan=2 class="header middle" align="center">Contact Rate</td>
		<td rowspan=2 colspan=2 class="header middle" align="center">Convertion Rate 1</td>
		<td rowspan=2 colspan=2 class="header middle" align="center">Convertion Rate 2</td>
		<td rowspan=2 colspan=2 class="header middle" align="center">Total Cases</td>
		<td rowspan=2 colspan=3 class="header middle" align="center">ANP Submit</td>
		<td rowspan=2 colspan=4 class="header lasted" align="center">AARP</td>
	</tr>
	<tr>
	</tr>
	<tr>
		<td colspan=2 class="header first">Batch 1</td>
		<td colspan=2 class="content middle" align="right"><?php echo number_format ($Tar['ConRate']);?>%</td>
		<td colspan=2 class="content middle" align="right"><?php echo number_format ($Tar['ConvertRate1']);?>%</td>
		<td colspan=2 class="content middle" align="right"><?php echo number_format ($Tar['ConvertRate2']);?>%</td>
		<td colspan=2 class="content middle" align="right"><?php echo number_format ($Tar['CasesSubmited']);?></td>
		<td colspan=3 class="content middle" align="right">Rp. <?php echo number_format ($Tar['ANPSubmit']);?></td>
		<td colspan=4 class="content middle" align="right">Rp. <?php echo number_format ($Tar['AARP']);?></td>
	</tr>
	<tr>
		<td colspan=2 class="total first">Total</td>
		<td colspan=2 class="total middle" align="right">&nbsp;</td>
		<td colspan=2 class="total middle" align="right">&nbsp;</td>
		<td colspan=2 class="total middle" align="right">&nbsp;</td>
		<td colspan=2 class="total middle" align="right">&nbsp;</td>
		<td colspan=3 class="total middle" align="right">&nbsp;</td>
		<td colspan=4 class="total lasted" align="right">&nbsp;</td>
	</tr>
	<?php
		endforeach;
	?>
</table>
</body>
</html>