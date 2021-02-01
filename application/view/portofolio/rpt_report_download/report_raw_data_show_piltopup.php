<style>
	table.grid{}
	td.header { background-color:#2182bf;font-family:Arial;font-weight:bold;color:#f1f5f8;font-size:12px;padding:5px;} 
	td.sub { background-color:#82B4FF;font-family:Arial;font-weight:bold;color:#000000;font-size:12px;padding:5px;} 
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
	
	td.subtotal{ font-family:Arial;font-weight:bold;color:#3c8a08;height:30px;background-color:#FFFCCC;}
	td.tanggal{ font-weight:bold;color:#FF4321;height:22px;background-color:#FFFFFF;height:30px;}
	h3{color:#306407;font-family:Trebuchet MS;font-size:14px;}
	h4{color:#FF4321;font-family:Trebuchet MS;font-size:14px;}
</style>
<?php
	$Today = date("d-m-Y");

 ?>
<pre><font class="middle">
	Report Type	: Report Download
	Campaign		: <?php echo $Users[$param['CampaignId']]['CampaignDesc']; ?>
	
	Mode		: <?php __(_get_post('mode')); ?>
	User Insert Date : <?php __(_get_post('start_date')); ?> s/d <?php __(_get_post('end_date')); ?>
	
	Show Date	: <?php echo $Today; ?>
	</font>
</pre>
<table border="1px" class="grid" cellpadding="0" cellspacing="0" width="90%">
	<tr>
		<td class="header middle" align="center">vCustID</td>
		<td class="header middle" align="center">SSV</td>
		<td class="header middle" align="center">FirstName</td>
		<td class="header middle" align="center">LastName</td>
		<td class="header middle" align="center">ChosenTopUpTenor</td>
		<td class="header middle" align="center">ChosenTopUpLimit</td>
		<td class="header middle" align="center">ChosenIntersetRate</td>
		<td class="header middle" align="center">ChosenInterestCode</td>
		<td class="header middle" align="center">TransferName</td>
		<td class="header middle" align="center">TransferBank</td>
		<td class="header middle" align="center">TransferAccNo</td>
		<td class="header middle" align="center">TransferBranch</td>
		<td class="header middle" align="center">NewTransferName</td>
		<td class="header middle" align="center">NewTransferBank</td>
		<td class="header middle" align="center">NewTransferAccNo</td>
		<td class="header middle" align="center">NewTransferBranch</td>
		<td class="header middle" align="center">FGroup</td>
		<td class="header middle" align="center">TGLENTRY</td>
		<td class="header middle" align="center">vTenorID</td>
		<td class="header middle" align="center">fDownload</td>
		<td class="header middle" align="center">DTGLDOWNLOAD</td>
		<td class="header middle" align="center">CHGADDHOME</td>
		<td class="header middle" align="center">CHGHOMENO</td>
		<td class="header middle" align="center">CHGADDOFFICE</td>
		<td class="header middle" align="center">CHGOFFICENO</td>
		<td class="header middle" align="center">CHGMOBILENO</td>
		<td class="header middle" align="center">AGENT</td>
		<td class="header middle" align="center">NPWP</td>
		<td class="header middle" align="center">PIL_PROTECTION</td>
	</tr>
	
	<?php
		$no=1;
		$sToday = 0;
		if(is_array($view)) foreach ($view as $CampaignId => $rows) :
	?>
	<tr>
		<td class="content middle" align="center">&nbsp;<?php __($rows['vCustID']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['SSVNO']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['FirstName']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['LastName']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['Tenor']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['Loan']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['Rate']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['RateCode']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['BenefName']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['BenefBank']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['BenefAccount']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['BenefBranch']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['NewBenefName']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['NewBenefBank']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['NewBenefAccount']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['NewBenefBranch']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['FGroup']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['CreateDate']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['vTenorID']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['fDownload']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['DownlDate']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['CHGADDHOME']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['CHGHOMENO']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['CHGADDOFFICE']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['CHGOFFICENO']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['CHGMOBILENO']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['CreateBy']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['SubmitNPWP']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['PilProtection']); ?></td>
		
		<!-- t d class="content middle" align="center">&nbsp;<?#php __((_getDateIndonesia2($rows['DOB_2'])==0?"":_getDateIndonesia2($rows['DOB_2']))); ?></t d --->
	</tr>
	<?php $no++; endforeach; ?>
	<tr>
		<td class="total middle" align="center"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
		<td class="total middle" align="right"></td>
	</tr>
</table>
