<html>
<head>
<title>QA Quality Assurance Report</title>
</head>
<body>
	<style>
	table.grid{}
	.header {
				background-color:#2182bf;font-family:Arial;font-weight:bold;color:#f1f5f8;font-size:12px;padding:5px;
				border-left:1px solid #dddddd;border-top:1px solid #dddddd;border-bottom:0px solid #dddddd;border-right:1px;
			}
	.content 
			{
				padding:2px;height:24px;font-family:Arial;font-weight:normal;color:#456376;font-size:12px;background-color:#f9fbfd;
				border-left:1px solid #dddddd;border-top:1px solid #dddddd;border-bottom:0px solid #dddddd;border-right:1px;
			}
	.sub
			{
				background-color:#FF9900;font-family:Arial;font-weight:bold;color:#000000;font-size:12px;padding:5px;
				border-left:1px solid #dddddd;border-top:1px solid #dddddd;border-bottom:0px solid #dddddd;border-right:1px;
			}
	.subtotal
			{
				font-family:Arial;font-weight:bold;color:#3c8a08;height:30px;background-color:#FFFCCC;
				border-left:1px solid #dddddd;border-top:1px solid #dddddd;border-bottom:0px solid #dddddd;border-right:1px;
			}
	.total
			{
				padding:2px;font-family:Arial;font-weight:normal;font-size:12px;padding-top:5px;padding-bottom:5px;border-left:0px solid #dddddd; 
				border-bottom:1px solid #dddddd; border-top:1px solid #dddddd;  
				border-right:1px solid #dddddd; border-top:1px solid #dddddd;
				background-color:#2182bf;padding-left:2px;color:#f1f5f8;font-weight:bold;
			}
	.agent
			{
				font-family:Arial;font-weight:normal;font-size:12px;padding-top:5px;padding-bottom:5px;border-left:0px solid #dddddd; 
				border-bottom:0px solid #dddddd; border-right:0px solid #dddddd; border-top:0px solid #dddddd;
				background-color:#fcfeff;padding-left:2px;color:#06456d;font-weight:bold;
			}
	.atm	
			{
				background-color:#FFCC66;font-family:Arial;font-weight:bold;color:#FFFFFF;font-size:12px;padding:5px;
				border-left:1px solid #dddddd;border-top:1px solid #dddddd;border-bottom:0px solid #dddddd;border-right:1px solid #dddddd;
			} 
			
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
		<u>QA Quality Assurance Report</u><p></p>
	</font>
</div>
<font class="middle">
	User Insert Date : <?php __(_get_post('start_date')); ?> s/d <?php __(_get_post('end_date')); ?>
</font><p></p>
<table class="grid" cellpadding="0" cellspacing="0" width="100%" bgcolor="red">
	<tr>
		<td colspan=13 class="sub">Actual</td>
	</tr>
	<?php
		if(is_array($view_atm)) foreach ($view_atm as $AtmId => $atm) :
	?>
	<tr>
		<td colspan=13 class="atm">ATM: <?php echo $atm['ATM']; ?></td>
	</tr>
		<?php
			if(is_array($view_spv)) foreach ($view_spv as $SpvId => $rows) :
		?>
	<tr>
		<td colspan=13 class="agent">Supervisor: <?php echo $rows['SPV']; ?></td>
	</tr>
	<tr>
		<td rowspan=2 colspan=2 class="header">&nbsp;</td>
		<td rowspan=2 class="header" align="center">Call Monitored</td>
		<td rowspan=2 class="header" align="center">Total Passed</td>
		<td rowspan=2 class="header" align="center">Passing Rate</td>
		<td rowspan=2 class="header" align="center">Total Fatal</td>
		<td rowspan=2 class="header" align="center">Fatal Error Rate</td>
		<td rowspan=2 class="header" align="center">Average QA Score</td>
		<td colspan=5 class="header" align="center">Questions Category</td>
	</tr>
	<tr>
		<td class="header" align="center">Basic Telephone Manner</td>
		<td class="header" align="center">Sales Presentation</td>
		<td class="header" align="center">Knowledge on Product & Procedure</td>
		<td class="header" align="center">Objection Handling</td>
		<td class="header" align="center">Sales confirmation</td>
	</tr>
			<?php
				$PassingRate = 0;
				$FatalRate = 0;
				$AvgQA = 0;
				
				if(is_array($view_agent)) foreach ($view_agent as $AgentId => $agent) :
				
				$Monitor = ($view_monitor[$AgentId]['Monitor']?$view_monitor[$AgentId]['Monitor']:0);
				$Pass = ($view_monitor[$AgentId]['Approve']?$view_monitor[$AgentId]['Approve']:0);
				$TotalFatal = ($view_monitor[$AgentId]['Reject']?$view_monitor[$AgentId]['Reject']:0);
				$DiffDate = ($view_monitor[$AgentId]['DiffDate']?$view_monitor[$AgentId]['DiffDate']:0);
				$ScoringFinal = ($view_score[$AgentId]['ScoreFinal']?$view_score[$AgentId]['ScoreFinal']:0);
				
				$PassingRate = (($view_monitor[$AgentId]['Approve'] / $view_monitor[$AgentId]['Monitor']) * 100);
				$FatalRate = (($view_monitor[$AgentId]['Reject'] / $view_monitor[$AgentId]['Monitor']) * 100);
				$AvgQA = (($view_monitor[$AgentId]['DiffDate'] / $view_score[$AgentId]['ScoreFinal']) * 100);
				$Question		= $view_question[$AgentId]['Question'];
				
				$Basic			= 0;
				$Presentation	= 0;
				$Knowledge		= 0;
				$Handling		= 0;
				$Confirmation	= 0;
				
				foreach($view_bandot[$AgentId] as $cust_id => $ExQuestion )
				{
					$Basic			+= ($ExQuestion[33]?$ExQuestion[33]:0);
					$Presentation	+= ($ExQuestion[34]?$ExQuestion[34]:0);
					$Knowledge		+= ($ExQuestion[35]?$ExQuestion[35]:0);
					$Handling		+= ($ExQuestion[36]?$ExQuestion[36]:0);
					$Confirmation	+= ($ExQuestion[37]?$ExQuestion[37]:0);
				}
				
				$Score = 0;
			?>
	<tr>
		<td colspan=2 class="header"><?php echo $agent['Agent']; ?></td>
		<td class="content" align="right"><?php echo $Monitor; ?></td>
		<td class="content" align="right"><?php echo $Pass; ?></td>
		<td class="content" align="right"><?php echo round($PassingRate,2); ?> %</td>
		<td class="content" align="right"><?php echo $TotalFatal; ?></td>
		<td class="content" align="right"><?php echo round($FatalRate,2); ?> %</td>
		<td class="content" align="right"><?php echo round($AvgQA,2); ?> %</td>
		<td class="content" align="right"><?php echo $Basic; ?></td>
		<td class="content" align="right"><?php echo $Presentation; ?></td>
		<td class="content" align="right"><?php echo $Knowledge; ?></td>
		<td class="content" align="right"><?php echo $Handling; ?></td>
		<td class="content" align="right"><?php echo $Confirmation; ?></td>
	</tr>
			<?php
				
				$sPassingRate = 0;
				$sFatalRate = 0;
				$sAvgQA = 0;
				
				$sMonitor += $Monitor;
				$sPass += $Pass;
				$sPassingRate = ($sPass / $sMonitor);
				$sTotalFatal += $TotalFatal;
				$sFatalRate = ($sTotalFatal / $sMonitor);
				$sDiffDate += $DiffDate;
				$sScoringFinal += $ScoringFinal;
				$sAvgQA = ($sDiffDate / $sScoringFinal);
				$sBasic += $Basic;
				$sPresentation += $Presentation;
				$sKnowledge += $Knowledge;
				$sHandling += $Handling;
				$sConfirmation += $Confirmation;
				
				endforeach;
			?>
	<tr>
		<td colspan=2 class="total">Total</td>
		<td class="total" align="right"><?php echo number_format($sMonitor); ?></td>
		<td class="total" align="right"><?php echo number_format($sPass); ?></td>
		<td class="total" align="right"><?php echo round($sPassingRate,2); ?> %</td>
		<td class="total" align="right"><?php echo number_format($sTotalFatal); ?></td>
		<td class="total" align="right"><?php echo round($sFatalRate,2); ?> %</td>
		<td class="total" align="right"><?php echo round($sAvgQA,2); ?> %</td>
		<td class="total" align="right"><?php echo number_format($sBasic); ?></td>
		<td class="total" align="right"><?php echo number_format($sPresentation); ?></td>
		<td class="total" align="right"><?php echo number_format($sKnowledge); ?></td>
		<td class="total" align="right"><?php echo number_format($sHandling); ?></td>
		<td class="total" align="right"><?php echo number_format($sConfirmation); ?></td>
	</tr>
		<?php
			endforeach;
		?>
	<?php
		endforeach;
	?>
</table>
</body>
</html>