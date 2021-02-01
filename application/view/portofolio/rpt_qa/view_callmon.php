
<?php  
if ( $status == "Export" ) {
	$filename = "ReportCallmon".$startdate."-". $enddate;
	header("Content-type: application/vnd.ms-excel");
	// header('Content-type: application/csv'); //*** CSV ***//
	header("Content-Disposition: attachment; filename=$filename.xls");
} else {
}

?>

<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 15">
<link rel=File-List href="sad/filelist.xml">
<style id="Copy of Copy of Template summary Callmonitoring_3954_Styles">
.xl153954
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl653954
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl663954
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:none;
	border-right:.5pt hairline black;
	border-bottom:.5pt hairline black;
	border-left:.5pt hairline black;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl673954
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:none;
	border-right:.5pt hairline black;
	border-bottom:.5pt hairline black;
	border-left:.5pt hairline black;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl683954
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:none;
	border-right:.5pt hairline black;
	border-bottom:.5pt hairline black;
	border-left:.5pt hairline black;
	background:white;
	mso-pattern:#FFFFCC none;
	white-space:nowrap;}
.xl693954
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:top;
	border-top:none;
	border-right:.5pt hairline black;
	border-bottom:.5pt hairline black;
	border-left:.5pt hairline black;
	background:white;
	mso-pattern:#FFFFCC none;
	white-space:normal;}
.xl703954
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border:.5pt solid windowtext;
	background:white;
	mso-pattern:#FFFFCC none;
	white-space:nowrap;}
.xl713954
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl723954
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl733954
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:"d\0022\. \0022mmm\0022\. \0022yyyy";
	text-align:center;
	vertical-align:bottom;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl743954
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl753954
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl763954
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:top;
	border:.5pt solid windowtext;
	background:white;
	mso-pattern:#FFFFCC none;
	white-space:normal;}
.xl773954
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:white;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	background:#FF6633;
	mso-pattern:#FF8080 none;
	white-space:nowrap;}
.xl783954
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:white;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:"Medium Date";
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	background:#FF6633;
	mso-pattern:#FF8080 none;
	white-space:normal;}
.xl793954
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:white;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	background:#FF6633;
	mso-pattern:#FF8080 none;
	white-space:normal;}
.xl803954
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:white;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	background:#FF6633;
	mso-pattern:#FF8080 none;
	white-space:nowrap;}
.xl813954
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:white;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	background:#FF6633;
	mso-pattern:#FF8080 none;
	white-space:normal;}
.xl823954
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:white;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:"\@";
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	background:#FF6633;
	mso-pattern:#FF8080 none;
	white-space:normal;}
.xl833954
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:white;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:"\@";
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	background:#FF6633;
	mso-pattern:#FF8080 none;
	white-space:nowrap;}
.xl843954
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:white;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
</style>
</head>
<title>Report Call Mon</title>
<body>
<div id="Copy of Copy of Template summary Callmonitoring_3954" align=center
x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 style='border-collapse:
 collapse;table-layout:fixed;width:1983pt'>
 <tr class=xl843954 height=17 style='mso-height-source:userset;height:12.95pt'>
  <td rowspan=2 height=34 class=xl773954 style='height:25.9pt;
  width:61pt'>Nomor</td>
  <td rowspan=2 class=xl773954 style='width:200'>QA</td>
  <td rowspan=2 class=xl773954 style='width:200'>TMR</td>
  <td rowspan=2 class=xl773954 style='width:200'>SPV</td>
  <td rowspan=2 class=xl773954 style='width:200'>Nama Customer</td>
  <td rowspan=2 class=xl773954 style='width:200'>Product</td>
  <td rowspan=2 class=xl783954 style='width:200'>Tanggal Closing</td>
  <td rowspan=2 class=xl783954 style='width:200'>Tanggal Callmon</td>
  <td class=xl793954 style='border-left:none;width:200'>69</td>
  <td rowspan=2 class=xl803954 style='width:200'>QA Score</td>
  <td class=xl793954 style='border-left:none;width:200'>14</td>
  <td class=xl793954 style='border-left:none;width:200'>11</td>
  <td class=xl793954 style='border-left:none;width:200'>16</td>
  <td class=xl793954 style='border-left:none;width:200'>20</td>
  <td class=xl793954 style='border-left:none;width:200'>8</td>
  <td rowspan=2 class=xl773954 style='width:200'>Comment Accuracy</td>
  <td rowspan=2 class=xl813954 style='width:200'>TALKTIME</td>
  <td rowspan=2 class=xl813954 style='width:200'>PREMI</td>
  <td rowspan=2 class=xl773954 style='width:200'>Verified</td>
  <td rowspan=2 class=xl773954 style='width:200'>Suspend Data</td>
  <td rowspan=2 class=xl773954 style='width:200'>Suspend Data
  selling</td>
  <td rowspan=2 class=xl773954 style='width:200'>Suspend selling</td>
  <td rowspan=2 class=xl813954 style='width:200'>Remaks Suspend</td>
  <td rowspan=2 class=xl823954 style='width:200'>Kota</td>
  <td rowspan=2 class=xl823954 style='width:200'>Provinsi</td>
  <td rowspan=2 class=xl833954 style='width:200'>ADDITIONAL</td>
 </tr>


 <tr class=xl843954 height=17 style='mso-height-source:userset;height:12.95pt'>
  <td height=17 class=xl803954 style='height:12.95pt;border-top:none;
  border-left:none'>Total Score</td>
  <td class=xl803954 style='border-top:none;border-left:none'>Score Courtesy</td>
  <td class=xl803954 style='border-top:none;border-left:none'>Score Presentation</td>
  <td class=xl803954 style='border-top:none;border-left:none'>Score Call Accuracy</td>
  <td class=xl803954 style='border-top:none;border-left:none'>Score Fraud Indication</td>
  <td class=xl803954 style='border-top:none;border-left:none'>Tricky Indications</td>
 </tr>

 <?php  
 $getCallmon = $this->M_ReportQa->getCallMon( $startdate , $enddate );
 if ( $getCallmon != "error" ) {
 	$no = 1;
 	foreach ($getCallmon->result() as $gcm) { 
		$QuestionValue = json_decode($gcm->QuestionValue);
 		?>
 <!-- start row -->
 		

 <tr height=17 style='mso-height-source:userset;height:12.95pt'>
  <td height=17 class=xl703954 style='height:12.95pt;border-top:none'><?= $no++; ?></td>
  <td class=xl713954 style='border-top:none;border-left:none'><?= $gcm->NamaQa ;?></td>
  <td class=xl713954 style='border-top:none;border-left:none'><?= $gcm->NamaTmr ;?></td>
  <td class=xl713954 style='border-top:none;border-left:none'><?= $gcm->NamaSpv ;?></td>
  <td class=xl713954 style='border-top:none;border-left:none'><?= $gcm->NamaCustomer ;?></td>
  <td class=xl723954 style='border-top:none;border-left:none'><?= $gcm->NamaProduct ;?></td>
  <td class=xl733954 style='border-top:none;border-left:none'><?= $gcm->DateSelling ;?></td>
  <td class=xl733954 style='border-top:none;border-left:none'><?= $gcm->DateCallMon ;?></td>


  <td class=xl713954 style='border-top:none;border-left:none'>

  <?= 
	$this->M_ReportQa->getScore( $QuestionValue , "0-9" ) + 
	$this->M_ReportQa->getScore( $QuestionValue , "32-38" ) + 
	$this->M_ReportQa->getScore( $QuestionValue , "10-17" )*2 + 
	$this->M_ReportQa->getScore( $QuestionValue , "18-21" )*2 +
	$this->M_ReportQa->getScore( $QuestionValue , "22-31" )*2
  ; ?>

  </td>

  <?php  
  	$totalScoreQa = round(
  		(	$this->M_ReportQa->getScore( $QuestionValue , "0-9" ) + 
			$this->M_ReportQa->getScore( $QuestionValue , "32-38" ) + 
			$this->M_ReportQa->getScore( $QuestionValue , "10-17" )*2 + 
			$this->M_ReportQa->getScore( $QuestionValue , "18-21" )*2 +
			$this->M_ReportQa->getScore( $QuestionValue , "22-31" )*2) / 69 * 100 );

	if ( $totalScoreQa == 0 || $totalScoreQa == "" ) {
		$background = "#000000";
	} else if ( ($totalScoreQa >= 1) && ($totalScoreQa <= 69) ) {
		$background = "red";
	} else if ( ($totalScoreQa >= 70) && ($totalScoreQa <= 84) ) {
		$background = "#C4C114";
	}  else if ( ($totalScoreQa >= 85) && ($totalScoreQa <= 100) ) {
		$background = "green";
	}
  ?>
  <td class=xl703954 style='border-top:none;border-left:none;font-size:11.0pt;
  color:white;font-weight:400;text-decoration:none;text-underline-style:none;
  text-line-through:none;font-family:Calibri;border:.5pt solid windowtext;
  background:<?= $background; ?>;mso-pattern:teal none'>
  <?php echo $totalScoreQa; ?>
  </td>


  <?php // Score Courtesy ?>
  <td class=xl713954 style='border-top:none;border-left:none'><?= $this->M_ReportQa->getScore( $QuestionValue , "0-9" ); ?></td>
  <?php // Score Presentation ?>
  <td class=xl713954 style='border-top:none;border-left:none'><?= $this->M_ReportQa->getScore( $QuestionValue , "32-38" ); ?></td>
  <?php // Score Call Accuracy ?>
  <td class=xl713954 style='border-top:none;border-left:none'><?= $this->M_ReportQa->getScore( $QuestionValue , "10-17" )*2; ?></td>
  <?php // Score Fraud Indications ?>
  <td class=xl713954 style='border-top:none;border-left:none'><?= $this->M_ReportQa->getScore( $QuestionValue , "22-31" )*2; ?></td>
  <?php // Tricky ?>
  <td class=xl713954 style='border-top:none;border-left:none'><?= $this->M_ReportQa->getScore( $QuestionValue , "18-21" )*2; ?></td>


  <td class=xl713954 style='border-top:none;border-left:none'><?= $this->M_ReportQa->getScore( $QuestionValue , "39-43" ); ?></td>
  <td class=xl713954 style='border-top:none;border-left:none'>TALKTIME</td>

  <td class=xl713954 style='border-top:none;border-left:none'><?= $gcm->TotalPremi ;?></td>
  <td class=xl713954 style='border-top:none;border-left:none'><?= $gcm->Verified ;?></td>
  <td class=xl743954 style='border-top:none;border-left:none'><?= $gcm->SuspendDataEdit ;?></td>
  <td class=xl713954 style='border-top:none;border-left:none'><?= $gcm->SuspendDataSelling ;?></td>
  <td class=xl713954 style='border-top:none;border-left:none'><?= $gcm->SuspendSelling ;?></td>
  <td class=xl753954 width=60 style='border-top:none;border-left:none;
  width:45pt'>NULL</td>
  <td class=xl713954 style='border-top:none;border-left:none'><?= $gcm->Kota ;?></td>
  <td class=xl703954 style='border-top:none;border-left:none'><?= $gcm->Provinsi ;?></td>
  <td class=xl763954 width=143 style='border-top:none;border-left:none;
  width:107pt'><?= $gcm->AdditionalPhone ;?></td>
 </tr>

 <!-- end row -->



 	<?php }
 } else {

 }

 ?>






 <tr height=17 style='mso-height-source:userset;height:12.95pt'>
  <td height=17 class=xl153954 style='height:12.95pt'></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl653954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl663954>&nbsp;</td>
  <td class=xl663954 style='border-left:none'>&nbsp;</td>
  <td class=xl663954 style='border-left:none'>&nbsp;</td>
  <td class=xl663954 style='border-left:none'>&nbsp;</td>
  <td class=xl663954 style='border-left:none'>&nbsp;</td>
  <td class=xl673954 width=60 style='border-left:none;width:45pt'>&nbsp;</td>
  <td class=xl683954 style='border-left:none'>&nbsp;</td>
  <td class=xl683954 style='border-left:none'>&nbsp;</td>
  <td class=xl693954 width=143 style='border-left:none;width:107pt'>&nbsp;</td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.95pt'>
  <td height=17 class=xl153954 style='height:12.95pt'></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl653954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.95pt'>
  <td height=17 class=xl153954 style='height:12.95pt'></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl653954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.95pt'>
  <td height=17 class=xl153954 style='height:12.95pt'></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl653954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.95pt'>
  <td height=17 class=xl153954 style='height:12.95pt'></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl653954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.95pt'>
  <td height=17 class=xl153954 style='height:12.95pt'></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl653954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.95pt'>
  <td height=17 class=xl153954 style='height:12.95pt'></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl653954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.95pt'>
  <td height=17 class=xl153954 style='height:12.95pt'></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl653954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.95pt'>
  <td height=17 class=xl153954 style='height:12.95pt'></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl653954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
  <td class=xl153954></td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=81 style='width:61pt'></td>
  <td width=81 style='width:61pt'></td>
  <td width=81 style='width:61pt'></td>
  <td width=151 style='width:113pt'></td>
  <td width=183 style='width:137pt'></td>
  <td width=94 style='width:71pt'></td>
  <td width=95 style='width:71pt'></td>
  <td width=83 style='width:62pt'></td>
  <td width=81 style='width:61pt'></td>
  <td width=81 style='width:61pt'></td>
  <td width=106 style='width:80pt'></td>
  <td width=123 style='width:92pt'></td>
  <td width=123 style='width:92pt'></td>
  <td width=143 style='width:107pt'></td>
  <td width=172 style='width:129pt'></td>
  <td width=81 style='width:61pt'></td>
  <td width=81 style='width:61pt'></td>
  <td width=81 style='width:61pt'></td>
  <td width=92 style='width:69pt'></td>
  <td width=137 style='width:103pt'></td>
  <td width=105 style='width:79pt'></td>
  <td width=60 style='width:45pt'></td>
  <td width=102 style='width:77pt'></td>
  <td width=81 style='width:61pt'></td>
  <td width=143 style='width:107pt'></td>
 </tr>
</table>

</div>

</body>

</html>

