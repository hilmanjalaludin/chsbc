<html>
<head>
<title>Productivity Report On QA</title>
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
		<u>Productivity Report On QA</u><p></p>
	</font>
</div>
<font class="middle">
	User Insert Date : <?php __(_get_post('start_date')); ?> s/d <?php __(_get_post('end_date')); ?>
</font><p></p>
<table class="grid" cellpadding="0" cellspacing="0" width="100%" bgcolor="red">
	<tr>
		<td colspan=2 class="header first">&nbsp;</td>
		<td class="header middle" align="center">Leadsize (Given)</td>
		<td class="header middle" align="center">Leads Utilized</td>
		<td class="header middle" align="center">Leads Contacted</td>
		<td class="header middle" align="center">Sales submit</td>
		<td class="header middle" align="center">List Usage Rate</td>
		<td class="header middle" align="center">Contact Rate</td>
		<td class="header middle" align="center">Conver'n Rate 1</td>
		<td class="header middle" align="center">Conver'n Rate 2</td>
		<td class="header middle" align="center">ANP<br>(in Rp)</td>
		<td class="header lasted" align="center">AARP<br>(in Rp)</td>
	</tr>
	<tr>
		<td colspan=12 class="sub first">Actual</td>
	</tr>
	<tr>
		<td colspan=2 class="header first">Campaign Name</td>
		<td class="content first">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">999999999</td>
		<td class="content lasted">9999999</td>
	</tr>
	<tr>
		<td colspan=2 class="header first">Batch 1</td>
		<td class="content first">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">999999999</td>
		<td class="content lasted">9999999</td>
	</tr>
	<tr>
		<td colspan=2 class="header first">Batch 2</td>
		<td class="content first">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">999999999</td>
		<td class="content lasted">9999999</td>
	</tr>
	<tr>
		<td colspan=2 class="total first">Total</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total lasted">&nbsp;</td>
	</tr>
	<tr>
		<td colspan=12 class="sub first">Target</td>
	</tr>
	<tr>
		<td colspan=2 class="header first">Campaign Name</td>
		<td class="content first">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">999999999</td>
		<td class="content lasted">9999999</td>
	</tr>
	<tr>
		<td colspan=2 class="header first">Batch 1</td>
		<td class="content first">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">999999999</td>
		<td class="content lasted">9999999</td>
	</tr>
	<tr>
		<td colspan=2 class="header first">Batch 2</td>
		<td class="content first">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">999999999</td>
		<td class="content lasted">9999999</td>
	</tr>
	<tr>
		<td colspan=2 class="total first">Total</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total lasted">&nbsp;</td>
	</tr>
	<tr>
		<td colspan=12 class="sub first">Achievement %</td>
	</tr>
	<tr>
		<td colspan=2 class="header first">Campaign Name</td>
		<td class="content first">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">999999999</td>
		<td class="content lasted">9999999</td>
	</tr>
	<tr>
		<td colspan=2 class="header first">Batch 1</td>
		<td class="content first">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">999999999</td>
		<td class="content lasted">9999999</td>
	</tr>
	<tr>
		<td colspan=2 class="header first">Batch 2</td>
		<td class="content first">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">999999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">0.9999</td>
		<td class="content middle">999999999</td>
		<td class="content lasted">9999999</td>
	</tr>
	<tr>
		<td colspan=2 class="total first">Total</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total middle">&nbsp;</td>
		<td class="total lasted">&nbsp;</td>
	</tr>
</table>
</body>
</html>