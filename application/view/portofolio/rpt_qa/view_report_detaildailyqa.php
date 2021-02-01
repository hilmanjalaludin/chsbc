<?php  
/**
 * ====================================
 * Start Report UI
 * ====================================
 */
?>

<?php if ( $status == "ui" ) : ?>

<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 15">
<link rel=File-List href="crot_files/filelist.xml">
<style id="Report Summary Daily Per Month Date_20135_Styles">
.xl6620135
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Segoe UI", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid black;
	border-right:none;
	border-bottom:.5pt solid black;
	border-left:.5pt solid black;
	background:aqua;
	mso-pattern:aqua none;
	white-space:normal;}
.xl6720135
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Segoe UI", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid black;
	background:aqua;
	mso-pattern:aqua none;
	white-space:normal;}
.xl6820135
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Segoe UI", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6920135
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Segoe UI", sans-serif;
	mso-font-charset:0;
	mso-number-format:"General Date";
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid black;
	border-left:.5pt solid black;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7020135
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Segoe UI", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid black;
	border-left:.5pt solid black;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7120135
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Segoe UI", sans-serif;
	mso-font-charset:0;
	mso-number-format:"\#\,\#\#0";
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid black;
	border-left:.5pt solid black;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7220135
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Segoe UI", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid black;
	border-bottom:.5pt solid black;
	border-left:.5pt solid black;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
</style>
<title>Detail Summary Tanggal <?php echo $startdate; ?></title>
</head>

<body>
<div id="Report Summary Daily Per Month Date_20135" align=centerx:publishsource="Excel">




<h2 class="xl6920135">Detail Summary Tanggal <?php echo $startdate; ?></h2>

<table border=0 cellpadding=0 cellspacing=0 width=1328 class=xl6820135
 style='border-collapse:collapse;table-layout:fixed;width:997pt'>
 <tr class=xl6820135 height=33 style='mso-height-source:userset;height:25.15pt'>
   <td height=33 class=xl6620135 width=120 style='height:25.15pt;width:90pt'>No</td>
  <td height=33 class=xl6620135 width=120 style='height:25.15pt;width:90pt'>Date
  Selling</td>
  <td class=xl6620135 width=120 style='width:90pt'>Date Call Mon</td>
  <td class=xl6620135 width=120 style='width:90pt'>QA Staff</td>
  <td class=xl6620135 width=96 style='width:72pt'>Customer ID</td>
  <td class=xl6620135 width=147 style='width:110pt'>Customer Name</td>
  <td class=xl6620135 width=147 style='width:110pt'>Duration</td>
  <td class=xl6620135 width=90 style='width:68pt'>Plan</td>
  <td class=xl6620135 width=96 style='width:72pt'>Premi</td>
  <td class=xl6620135 width=120 style='width:90pt'>Plan Description</td>
  <td class=xl6620135 width=154 style='width:116pt'>Leader Name</td>
  <td class=xl6620135 width=144 style='width:108pt'>Agent Name</td>
  <td class=xl6720135 width=121 style='width:91pt'>Status</td>
 </tr>

 
 <?php 
 	if ( $userid != "" ) {
		$detailPerDateSummary = $this->M_ReportQa->getDetailSummaryQa($startdate , $userid);
 	} else {
		$detailPerDateSummary = $this->M_ReportQa->getDetailSummaryQa($startdate);
 	}

	if ( $detailPerDateSummary != false	) {
		$no = 1;
		foreach ( $detailPerDateSummary as $dp ) : 
		?>
		<tr class=xl6820135 height=33 style='mso-height-source:userset;height:25.15pt'>
		  <td height=33 class=xl6920135 width=120 style='height:25.15pt;width:90pt'><?php echo $no++; ?></td>
		  <td class=xl6920135 width=120 style='width:90pt'><?php echo $dp->DateSelling; ?></td>
		  <td class=xl6920135 width=120 style='width:90pt'><?php echo $dp->DateCallMon; ?></td>
		  <td class=xl7020135 width=96 style='width:72pt'><?php echo $dp->QaStaff; ?></td>
		  <td class=xl7020135 width=147 style='width:110pt'><?php echo $dp->CustomerId; ?></td>
		  <td class=xl7020135 width=90 style='width:168pt'><?php echo $dp->CustomerName; ?></td>
		  <td class=xl7020135 width=90 style='width:68pt'><?php echo $this->M_ReportQa->getDuration($dp->CustomerId); ?></td>
		  <td class=xl7120135 width=96 style='width:72pt'><?php echo $dp->ProductPlan; ?></td>
		  <td class=xl7020135 width=120 style='width:90pt'><?php echo _getCurrency($dp->TotalPremi); ?></td>
		  <td class=xl7020135 width=154 style='width:116pt'><?php echo $dp->ProductDesc; ?></td>
		  <td class=xl7020135 width=144 style='width:108pt'><?php echo $dp->LeaderName; ?></td>
		  <td class=xl7220135 width=121 style='width:91pt'><?php echo $dp->AgentName; ?></td>
		  <td class=xl7220135 width=121 style='width:91pt'><?php echo $dp->StatusApprove; ?></td>
		 </tr>

	  <?php endforeach;
		
	} else {
		
	}
	
 ?>

</table>

<br><br>
<?php $dprs = $this->M_ReportQa->getDetailSummaryQa($startdate,'totalall'); 
if ( $dprs != false	) { ?>
Verified Selling : <?= $dprs->TotVerifiedSelling ?> <br>
Verified Reconfirm : <?= $dprs->TotVerifiedReconfirm ?> <br>
Suspend Data Edit :<?= $dprs->TotSuspendDataEdit ?> <br>
Suspend Selling :<?= $dprs->TotSuspendSelling ?> <br>
Declined Confirm : <?= $dprs->TotDeclineConfirm ?> <br>
Declined Cancel : <?= $dprs->TotDeclineCancel ?> <br>
Suspend Data Selling Confirm : <?= $dprs->TotSuspendDataSellingConfirm ?> <br>
Suspend Data Selling Pending : <?= $dprs->SuspendDataSellingPending ?> <br>
Suspend Still : <?= $dprs->TotSuspendStill ?> <br>
<?php } else { echo 1; } ?>

</div>

</body>

</html>


<?php 
/**
 * ====================================
 * End Report CSS
 * ====================================
 */
?>

<?php elseif ( $status == "Export" ) :  ?>
<?php 
/**
 * ====================================
 * Start Report Export Excel
 * ====================================
 */
?>




















<?php 
/**
 * ====================================
 * End Report Export Excel
 * ====================================
 */
?>
<?php endif; ?>
