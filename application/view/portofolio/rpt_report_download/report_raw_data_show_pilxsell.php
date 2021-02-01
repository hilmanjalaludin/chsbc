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
		<td class="header middle" align="center">SalesForceID</td>
		<td class="header middle" align="center">BenefName</td>
		<td class="header middle" align="center">BenefAccount</td>
		<td class="header middle" align="center">BenefBank</td>
		<td class="header middle" align="center">BenefBranch</td>
		<td class="header middle" align="center">Loan</td>
		<td class="header middle" align="center">Tenor</td>
		<td class="header middle" align="center">AdditionalHPhone</td>
		<td class="header middle" align="center">AdditionalOPhone</td>
		<td class="header middle" align="center">AdditionalMPhone</td>
		<td class="header middle" align="center">Rate</td>
		<td class="header middle" align="center">mkt_code</td>
		<td class="header middle" align="center">NeedNPWP</td>
		<td class="header middle" align="center">GHI</td>
		<td class="header middle" align="center">Cardno</td>
		<td class="header middle" align="center">Custno</td>
		<td class="header middle" align="center">Pil Protection</td>
		<td class="header middle" align="center">PunyaNPWP</td>
		<td class="header middle" align="center">SubmitNPWP</td>
		<td class="header middle" align="center">HomePhone</td>
		<td class="header middle" align="center">OfficePhone</td>
		<td class="header middle" align="center">MobilePhone</td>
		<td class="header middle" align="center">CreateDate</td>
		<td class="header middle" align="center">ProdType</td>
		<td class="header middle" align="center">IncomeDocCollect</td>
	</tr>
	
	<?php
		$no=1;
		$sToday = 0;
		if(is_array($view)) foreach ($view as $CampaignId => $rows) :
	?>
	<tr>
		<td class="content middle" align="center">&nbsp;<?php __(strtoupper($rows['SalesForceID'])); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['BenefName']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['BenefAccount']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['BenefBank']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['BenefBranch']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['Loan']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['Tenor']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['AdditionalHPhone']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['AdditionalOPhone']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['AdditionalMPhone']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['Rate']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['mkt_code']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['NeedNPWP']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['GHI']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['Cardno']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['Custno']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['pilpro']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['PunyaNPWP']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['SubmitNPWP']='0000-00-00'?"":$rows['SubmitNPWP']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['HomePhone']='0'?"":$rows['HomePhone']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['OfficePhone']='0'?"":$rows['OfficePhone']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['MobilePhone']='0'?"":$rows['MobilePhone']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['CreateDate']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['ProdType']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['IncomeDocCollect']); ?></td>
		
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
	</tr>
</table>
