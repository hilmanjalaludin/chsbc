<style>
	table.grid{}
	td.header { background-color:#2182bf;font-family:Arial;font-weight:bold;color:#f1f5f8;font-size:12px;padding:5px;} 
	td.sub { background-color:#82B4FF;font-family:Arial;font-weight:bold;color:#000000;font-size:12px;padding:5px;} 
	td.content { padding:2px;height:24px;font-family:Arial;font-weight:normal;color:#456376;font-size:12px;background-color:#f9fbfd;-mso-format-text:'number' ;

	} 
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
	Report Type	: Raw Data Report
	Campaign		: <?php echo $Users[$param['CampaignId']]['CampaignDesc']; ?>
	
	Mode		: <?php __(_get_post('mode')); ?>
	User Insert Date : <?php __(_get_post('start_date')); ?> s/d <?php __(_get_post('end_date')); ?>
	
	Show Date	: <?php echo $Today; ?>
	</font>
</pre>
<table border="1px" class="grid" cellpadding="0" cellspacing="0" width="90%">
	<tr>
		<td class="header middle" align="center">PRODUCT_CODE</td>
		<td class="header middle" align="center">URN</td>
		<td class="header middle" align="center">CREDIT_CARD_EXPIRY_DATE</td>
		<td class="header middle" align="center">PLAN</td>
		<td class="header middle" align="center">COVERAGE</td>
		<td class="header middle" align="center">PREMIUM</td>
		<td class="header middle" align="center">SELLERID</td>
		<td class="header middle" align="center">NAME_1</td>
		<td class="header middle" align="center">DOB_1 (dd/mm/yyyy)</td>
		<td class="header middle" align="center">ADDR1</td>
		<td class="header middle" align="center">ADDR2</td>
		<td class="header middle" align="center">ADDR3</td>
		<td class="header middle" align="center">CITY</td>
		<td class="header middle" align="center">ZIP</td>
		<td class="header middle" align="center">BENEF_1</td>
		<td class="header middle" align="center">RELATIONSHIP INFORMATION</td>
		<td class="header middle" align="center">BENEF_2</td>
		<td class="header middle" align="center">RELATIONSHIP INFORMATION</td>
		<td class="header middle" align="center">BENEF_3</td>
		<td class="header middle" align="center">RELATIONSHIP INFORMATION</td>
		<td class="header middle" align="center">SALESDATE</td>
		<td class="header middle" align="center">NAME_2</td>
		<td class="header middle" align="center">SEX_2</td>
		<td class="header middle" align="center">DOB_2</td>
		<td class="header middle" align="center">NAME_3</td>
		<td class="header middle" align="center">SEX_3</td>
		<td class="header middle" align="center">DOB_3</td>
		<td class="header middle" align="center">NAME_4</td>
		<td class="header middle" align="center">SEX_4</td>
		<td class="header middle" align="center">DOB_4</td>
		<td class="header middle" align="center">NAME_5</td>
		<td class="header middle" align="center">SEX_5</td>
		<td class="header middle" align="center">DOB_5</td>
		<td class="header middle" align="center">REF</td>
		<td class="header middle" align="center">MOBILE_PHONE</td>
		<td class="header middle" align="center">OFFICE_PHONE</td>
		<td class="header middle" align="center">HOME_PHONE</td>
	</tr>
	
	<?php
		$no=1;
		$sToday = 0;
		if(is_array($view)) foreach ($view as $CampaignId => $rows) :
	?>
	<tr>
		<td class="content middle" align="center">&nbsp;<?php __($rows['PROD']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['URN']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['CREDIT_CARD_EXPIRY_DATE']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['PLAN']); ?></td>
		<td class="content middle" align="center"><?php __(str_replace( ' ' , '' , $rows['COVERAGE'])); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['PREMIUM']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['SELLERID']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['NAME_1']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __(_getDateIndonesia2($rows['DOB_1'])); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['ADDR1']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['ADDR2']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['ADDR3']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['CITY']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['ZIP']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['BENEF_1']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['RELATIONSHIP_INFORMATION_1']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['BENEF_2']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['RELATIONSHIP_INFORMATION_2']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['BENEF_3']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['RELATIONSHIP_INFORMATION_3']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __(_getDateIndonesia2($rows['SALESDATE'])); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['NAME_2']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __(($rows['SEX_2']==0?"":($rows['SEX_2']==1?"M":"F"))); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __((_getDateIndonesia2($rows['DOB_2'])==0?"":_getDateIndonesia2($rows['DOB_2']))); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['NAME_3']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __(($rows['SEX_3']==0?"":($rows['SEX_3']==1?"M":"F"))); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __((_getDateIndonesia2($rows['DOB_3'])==0?"":_getDateIndonesia2($rows['DOB_3']))); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['NAME_4']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __(($rows['SEX_4']==0?"":($rows['SEX_4']==1?"M":"F"))); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __((_getDateIndonesia2($rows['DOB_4'])==0?"":_getDateIndonesia2($rows['DOB_4']))); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['NAME_5']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __(($rows['SEX_5']==0?"":($rows['SEX_5']==1?"M":"F"))); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __((_getDateIndonesia2($rows['DOB_5'])==0?"":_getDateIndonesia2($rows['DOB_5']))); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['REF']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['MOBILE_PHONE']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['OFFICE_PHONE']); ?></td>
		<td class="content middle" align="center">&nbsp;<?php __($rows['HOME_PHONE']); ?></td>
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
