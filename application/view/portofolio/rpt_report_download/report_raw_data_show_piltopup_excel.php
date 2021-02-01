<?php 

 function _convertDate($date){
	$exDate = explode("/",$date);
	$imDate = $exDate[2]."-".$exDate[0]."-".$exDate[1];
	$date = " ".$imDate." ";
	return $date;
 }
 
 // $RowData1 = (is_array($RowData1)?$RowData1:array())+(is_array($RowDataNull1)?$RowDataNull1:array());
	// $RowData2 = (is_array($RowData2)?$RowData2:array())+(is_array($RowDataNull2)?$RowDataNull2:array());
	// $RowData3 = (is_array($RowData3)?$RowData3:array())+(is_array($RowDataNull3)?$RowDataNull3:array());
	// $RowData4 = (is_array($RowData4)?$RowData4:array())+(is_array($RowDataNull4)?$RowDataNull4:array());
	
 // $arr_title = "Call Tracking Summary by Recsource per Agent Periode of "._convertDate($param['start_date']) ."to". _convertDate($param['end_date']);
 // $arr_printedby = "Printed By: "._get_session('Username');
 // $arr_printdate = "Print Date: ".date('m/d/Y H:i:s');
 $base_file_tmp = "Report_Download_PILTOPUP_".date('YmdHis').".xls";
 $base_file_name = "/opt/enigma/webapps/hsbc-portof/application/temp/".$base_file_tmp;
 
 
// read excel  ---------------------------------------------------------

 $workbook =& new writeexcel_workbook($base_file_name);
 $worksheet =& $workbook->addworksheet();
 
/** pack header format every file **/

 $header_format =& $workbook->addformat();
 $header_format ->set_bold();
 $header_format->set_size(10);
 $header_format->set_color('white');
 $header_format->set_align('left');
 $header_format->set_align('vcenter');
 $header_format->set_pattern();
 $header_format->set_fg_color('blue');
 
 $header1_format =& $workbook->addformat();
 $header1_format ->set_bold();
 $header1_format->set_size(10);
 $header1_format->set_color('white');
 $header1_format->set_align('center');
 $header1_format->set_align('vcenter');
 $header1_format->set_pattern();
 $header1_format->set_fg_color('blue');
 // $header1_format->set_border(1,1,1,1);
 
 $title_format =& $workbook->addformat();
 $title_format ->set_bold();
 $title_format->set_size(14);
 $title_format->set_color('black');
 $title_format->set_align('left');
 $title_format->set_align('vcenter');
 
 $bootom_format =& $workbook->addformat();
 $bootom_format ->set_bold();
 $bootom_format->set_size(10);
 $bootom_format->set_color('white');
 $bootom_format->set_align('right');
 $bootom_format->set_align('vcenter');
 $bootom_format->set_pattern();
 $bootom_format->set_fg_color('blue');
 
 $agent_format =& $workbook->addformat();
 $agent_format ->set_bold();
 $agent_format->set_size(12);
 $agent_format->set_color('black');
 $agent_format->set_align('left');
 $agent_format->set_align('vcenter');
/* pack header format every file --------------------------------------- */
//-------------------------------------------------------------------------

$arr_rows = 0;
// $worksheet->write_string($arr_rows, 0, $arr_title, $title_format);
// $worksheet->write_string($arr_rows+=1, 0, $arr_printedby, $title_format);
// $worksheet->write_string($arr_rows+=1, 0, $arr_printdate, $title_format);

/* ------------------------------------------------------------------------------------ */
// $arr_rows+=2;
	// $arr_rows+=1;
	$worksheet->write_string($arr_rows, 0, "vCustID", $header_format );
	$worksheet->write_string($arr_rows, 1, "SSV", $header_format );
	$worksheet->write_string($arr_rows, 2, "FirstName",  $header_format );
	$worksheet->write_string($arr_rows, 3, "LastName", $header_format );
	$worksheet->write_string($arr_rows, 4, "ChosenTopUpTenor", $header_format );
	$worksheet->write_string($arr_rows, 5, "ChosenTopUpLimit",  $header_format );
	$worksheet->write_string($arr_rows, 6, "ChosenIntersetRate", $header_format );
	$worksheet->write_string($arr_rows, 7, "ChosenInterestCode", $header_format );
	$worksheet->write_string($arr_rows, 8, "TransferName",  $header_format );
	$worksheet->write_string($arr_rows, 9, "TransferBank",  $header_format );
	$worksheet->write_string($arr_rows, 10, "TransferAccNo", $header_format );
	$worksheet->write_string($arr_rows, 11, "TransferBranch", $header_format );
	$worksheet->write_string($arr_rows, 12, "NewTransferName", $header_format );
	$worksheet->write_string($arr_rows, 13, "NewTransferBank", $header_format );
	$worksheet->write_string($arr_rows, 14, "NewTransferAccNo", $header_format );
	$worksheet->write_string($arr_rows, 15, "NewTransferBranch", $header_format );
	$worksheet->write_string($arr_rows, 16, "FGroup", $header_format );
	$worksheet->write_string($arr_rows, 17, "TGLENTRY", $header_format );
	$worksheet->write_string($arr_rows, 18, "vTenorID", $header_format );
	$worksheet->write_string($arr_rows, 19, "fDownload", $header_format );
	$worksheet->write_string($arr_rows, 20, "DTGLDOWNLOAD", $header_format );
	$worksheet->write_string($arr_rows, 21, "CHGADDHOME", $header_format );
	$worksheet->write_string($arr_rows, 22, "CHGHOMENO", $header_format );
	$worksheet->write_string($arr_rows, 23, "CHGADDOFFICE", $header_format );
	$worksheet->write_string($arr_rows, 24, "CHGOFFICENO", $header_format );
	$worksheet->write_string($arr_rows, 25, "CHGMOBILENO", $header_format );
	$worksheet->write_string($arr_rows, 26, "AGENT", $header_format );
	$worksheet->write_string($arr_rows, 27, "NPWP", $header_format );
	$worksheet->write_string($arr_rows, 28, "PIL_PROTECTION", $header_format );
	
	$arr_rows+=1;
	if(is_array($view)) foreach ($view as $CampaignId => $rows){
		$worksheet->write_string($arr_rows, 0, $rows['vCustID']);
		$worksheet->write_string($arr_rows, 1, substr($rows['SSVNO'], 0, -3) . '837');
		$worksheet->write_string($arr_rows, 2, $rows['FirstName']);
		$worksheet->write_string($arr_rows, 3, $rows['LastName']);
		$worksheet->write_number($arr_rows, 4, $rows['Tenor']);
		$worksheet->write_number($arr_rows, 5, $rows['Loan']);
		$worksheet->write_string($arr_rows, 6, str_replace(".",",",$rows['Rate']));
		$worksheet->write_string($arr_rows, 7, $rows['RateCode']);
		$worksheet->write_string($arr_rows, 8, $rows['BenefName']);
		$worksheet->write_string($arr_rows, 9, $rows['BenefBank']);
		$worksheet->write_string($arr_rows, 10, $rows['BenefAccount']);
		$worksheet->write_string($arr_rows, 11, $rows['BenefBranch']);
		$worksheet->write_string($arr_rows, 12, $rows['NewBenefName']);
		$worksheet->write_string($arr_rows, 13, $rows['NewBenefBank']);
		$worksheet->write_string($arr_rows, 14, $rows['NewBenefAccount']);
		$worksheet->write_string($arr_rows, 15, $rows['NewBenefBranch']);
		$worksheet->write_string($arr_rows, 16, 'Y2');
		$worksheet->write_string($arr_rows, 17, $rows['CreateDate']);
		$worksheet->write_string($arr_rows, 18, '0');
		$worksheet->write_string($arr_rows, 19, 'TRUE');
		$worksheet->write_string($arr_rows, 20, $rows['DownlDate']);
		$worksheet->write_string($arr_rows, 21, $rows['CHGADDHOME']);
		$worksheet->write_string($arr_rows, 22, $rows['CHGHOMENO']);
		$worksheet->write_string($arr_rows, 23, $rows['CHGADDOFFICE']);
		$worksheet->write_string($arr_rows, 24, $rows['CHGOFFICENO']);
		$worksheet->write_string($arr_rows, 25, $rows['CHGMOBILENO']);
		$worksheet->write_string($arr_rows, 26, $rows['CreateBy']);
		$worksheet->write_string($arr_rows, 27, $rows['SubmitNPWP']);
		$worksheet->write_string($arr_rows, 28, $rows['PilProtection']);
		$arr_rows+=1;
	}

 $workbook->close(); // end book 
 
 if( file_exists($base_file_name))
{
  header("Pragma: public");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Content-Type: application/force-download");
  header("Content-Type: application/octet-stream");
  header("Content-Type: application/download");
  header("Content-type: application/vnd.ms-excel; charset=utf-16");
  header("Content-Disposition: attachment; filename=". basename($base_file_name));
  header("Content-Transfer-Encoding: binary");
  header("Content-Length: " . filesize($base_file_name));
  readfile($base_file_name); 
  @unlink($base_file_name);
}
?>