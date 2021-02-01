<html>
<head>
<title>QA Sales Audit Report</title>
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
		<u>QA Sales Audit Report (QA-A)</u><p></p>
	</font>
</div>
<font class="middle">
	User Insert Date : <?php __(_get_post('start_date')); ?> s/d <?php __(_get_post('end_date')); ?>
</font><p></p>
<table class="grid" cellpadding="0" cellspacing="0" width="100%" bgcolor="red">
	<tr>
		<td colspan=19 class="sub">Actual</td>
	</tr>
	<?php
		if(is_array($view_atm)) foreach ($view_atm as $AtmId => $atm) :
	?>
	<tr>
		<td colspan=19 class="atm">Supervisor: <?php echo $atm['ATM']; ?></td>
	</tr>
		<?php
			if(is_array($view_spv)) foreach ($view_spv as $SpvId => $rows) :
		?>
	<tr>
		<td colspan=19 class="agent">Team Leader: <?php echo $rows['SPV']; ?></td>
	</tr>
	<tr>
		<td rowspan=2 colspan=2 class="header" align="center">TSR Name</td>
		<td rowspan=2 class="header" align="center">Call Monitored</td>
		<td rowspan=2 class="header" align="center">Total Passed</td>
		<td rowspan=2 class="header" align="center">Total Follow Up</td>
		<td rowspan=2 class="header" align="center">Total Rejected</td>
		<td rowspan=2 class="header" align="center">Passing Rate</td>
		<td colspan=11 class="header" align="center">Approval Questions</td>
	</tr>
	<tr>
		<td class="header" align="center">Customer Name</td>
		<td class="header" align="center">Day Of Birth</td>
		<td class="header" align="center">Product</td>
		<td class="header" align="center">Benefit</td>
		<td class="header" align="center">Sum Assured</td>
		<td class="header" align="center">Payment Mode</td>
		<td class="header" align="center">Plan Type</td>
		<td class="header" align="center">Card Number</td>
		<td class="header" align="center">Confirm To Buy</td>
		<td class="header" align="center">Documentation Mistake</td>
		<td class="header" align="center">Closing Statement</td>
	</tr>
			<?php
				$PassRate = 0;
				
				if(is_array($view_agent)) foreach ($view_agent as $AgentId => $agent) :
				
				$AgentName		= ($agent['Agent']?$agent['Agent']:'&nbsp;');
				$CallMonitor	= $view_monitor[$AgentId]['Monitor'];
				$Approval		= ($view_monitor[$AgentId]['Approve']?$view_monitor[$AgentId]['Approve']:0);
				$FollowUp		= ($view_monitor[$AgentId]['Followup']?$view_monitor[$AgentId]['Followup']:0);
				$Rejected		= ($view_monitor[$AgentId]['Reject']?$view_monitor[$AgentId]['Reject']:0);
				$Question		= $view_question[$AgentId]['Question'];
				
				$CustomerName	= 0;
				$DOB			= 0;
				$Product		= 0;
				$Benefit		= 0;
				$SumAssured		= 0;
				$Payment		= 0;
				$PlanType		= 0;
				$CardNumber		= 0;
				$ConfirmToBuy	= 0;
				$Document		= 0;
				$Closing		= 0;
				
				foreach($view_bandot[$AgentId] as $cust_id => $ExQuestion )
				{
					$CustomerName	+= ($ExQuestion[1]?$ExQuestion[1]:0);
					$DOB			+= ($ExQuestion[2]?$ExQuestion[2]:0);
					$Product		+= ($ExQuestion[3]?$ExQuestion[3]:0);
					$Benefit		+= ($ExQuestion[4]?$ExQuestion[4]:0);
					$SumAssured		+= ($ExQuestion[5]?$ExQuestion[5]:0);
					$Payment		+= ($ExQuestion[6]?$ExQuestion[6]:0);
					$PlanType		+= ($ExQuestion[7]?$ExQuestion[7]:0);
					$CardNumber		+= ($ExQuestion[8]?$ExQuestion[8]:0);
					$ConfirmToBuy	+= ($ExQuestion[9]?$ExQuestion[9]:0);
					$Document		+= ($ExQuestion[10]?$ExQuestion[10]:0);
					$Closing		+= ($ExQuestion[12]?$ExQuestion[12]:0);
				}
				
				$Score = 0;
				
				$PassRate = ($Approval / $CallMonitor);
			?>
	<tr>
		<td colspan=2 class="header"><?php echo strtoupper($AgentName); ?></td>
		<td class="content" align="right"><?php echo number_format($CallMonitor); ?></td>
		<td class="content" align="right"><?php echo number_format($Approval); ?></td>
		<td class="content" align="right"><?php echo number_format($FollowUp); ?></td>
		<td class="content" align="right"><?php echo number_format($Rejected); ?></td>
		<td class="content" align="right"><?php echo round($PassRate,2) ?> %</td>
		<td class="content" align="right"><?php echo $CustomerName; ?></td>
		<td class="content" align="right"><?php echo $DOB; ?></td>
		<td class="content" align="right"><?php echo $Product; ?></td>
		<td class="content" align="right"><?php echo $Benefit; ?></td>
		<td class="content" align="right"><?php echo $SumAssured; ?></td>
		<td class="content" align="right"><?php echo $Payment; ?></td>
		<td class="content" align="right"><?php echo $PlanType; ?></td>
		<td class="content" align="right"><?php echo $CardNumber; ?></td>
		<td class="content" align="right"><?php echo $ConfirmToBuy; ?></td>
		<td class="content" align="right"><?php echo $Document; ?></td>
		<td class="content" align="right"><?php echo $Closing; ?></td>
	</tr>
			<?php
			
				$sPassRate = 0;
				
				$sCallMonitor += $CallMonitor;
				$sApproval += $Approval;
				$sFollowUp += $FollowUp;
				$sRejected += $Rejected;
				$sPassRate = ($sApproval / $sCallMonitor);
				$sCustomerName += $CustomerName;
				$sDOB += $DOB;
				$sProduct += $Product;
				$sBenefit += $Benefit;
				$sSumAssured += $SumAssured;
				$sPayment += $Payment;
				$sPlanType += $PlanType;
				$sCardNumber += $CardNumber;
				$sConfirmToBuy += $ConfirmToBuy;
				$sDocument += $Document;
				$sClosing += $Closing;
				
				endforeach;
			?>
	<tr>
		<td colspan=2 class="total">Total</td>
		<td class="total" align="right"><?php echo number_format($sCallMonitor); ?></td>
		<td class="total" align="right"><?php echo number_format($sApproval); ?></td>
		<td class="total" align="right"><?php echo number_format($sFollowUp); ?></td>
		<td class="total" align="right"><?php echo number_format($sRejected); ?></td>
		<td class="total" align="right"><?php echo round($sPassRate,2); ?> %</td>
		<td class="total" align="right"><?php echo number_format($sCustomerName); ?></td>
		<td class="total" align="right"><?php echo number_format($sDOB); ?></td>
		<td class="total" align="right"><?php echo number_format($sProduct); ?></td>
		<td class="total" align="right"><?php echo number_format($sBenefit); ?></td>
		<td class="total" align="right"><?php echo number_format($sSumAssured); ?></td>
		<td class="total" align="right"><?php echo number_format($sPayment); ?></td>
		<td class="total" align="right"><?php echo number_format($sPlanType); ?></td>
		<td class="total" align="right"><?php echo number_format($sCardNumber); ?></td>
		<td class="total" align="right"><?php echo number_format($sConfirmToBuy); ?></td>
		<td class="total" align="right"><?php echo number_format($sDocument); ?></td>
		<td class="total" align="right"><?php echo number_format($sClosing); ?></td>
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