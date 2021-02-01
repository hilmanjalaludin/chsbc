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
 $base_file_tmp = "Report_Download_PILXSEL_".date('YmdHis').".xls";
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
	$worksheet->write_string($arr_rows, 0, "Sales Force ID", $header_format );
	$worksheet->write_string($arr_rows, 1, "Beneficiary Name", $header_format );
	$worksheet->write_string($arr_rows, 2, "Bank account",  $header_format );
	$worksheet->write_string($arr_rows, 3, "Bank Code", $header_format );
	$worksheet->write_string($arr_rows, 4, "Branch", $header_format );
	$worksheet->write_string($arr_rows, 5, "Loan",  $header_format );
	$worksheet->write_string($arr_rows, 6, "Tenor", $header_format );
	$worksheet->write_string($arr_rows, 7, "Additional Home Phone", $header_format );
	$worksheet->write_string($arr_rows, 8, "Additional Office Phone",  $header_format );
	$worksheet->write_string($arr_rows, 9, "Additional Mobile Phone",  $header_format );
	$worksheet->write_string($arr_rows, 10, "Rate", $header_format );
	$worksheet->write_string($arr_rows, 11, "Marketing Code", $header_format );
	$worksheet->write_string($arr_rows, 12, "NPWP", $header_format );
	$worksheet->write_string($arr_rows, 13, "GHI", $header_format );
	$worksheet->write_string($arr_rows, 14, "Card Number", $header_format );
	$worksheet->write_string($arr_rows, 15, "Customer Number", $header_format );
	$worksheet->write_string($arr_rows, 16, "Pil Protection", $header_format );
	$worksheet->write_string($arr_rows, 17, "Sudah Punya NPWP", $header_format );
	$worksheet->write_string($arr_rows, 18, "Sudah Submit NPWP", $header_format );
	$worksheet->write_string($arr_rows, 19, "Home Phone", $header_format );
	$worksheet->write_string($arr_rows, 20, "Office Phone", $header_format );
	$worksheet->write_string($arr_rows, 21, "Mobile Phone", $header_format );
	$worksheet->write_string($arr_rows, 22, "Incoming Date", $header_format );
	$worksheet->write_string($arr_rows, 23, "PROD_TYPE", $header_format );
	$worksheet->write_string($arr_rows, 24, "Income Doc Collect", $header_format );
	
	$arr_rows+=1;
	if(is_array($view)) foreach ($view as $CampaignId => $rows){
		$worksheet->write_string($arr_rows, 0, $rows['SalesForceID']);
		$worksheet->write_string($arr_rows, 1, $rows['BenefName']);
		$worksheet->write_string($arr_rows, 2, $rows['BenefAccount']);
		$worksheet->write_string($arr_rows, 3, $rows['BenefBank']);
		$worksheet->write_string($arr_rows, 4, $rows['BenefBranch']);
		$worksheet->write_number($arr_rows, 5, $rows['Loan']);
		$worksheet->write_number($arr_rows, 6, $rows['Tenor']);
		$worksheet->write_string($arr_rows, 7, $rows['AdditionalHPhone']);
		$worksheet->write_string($arr_rows, 8, $rows['AdditionalOPhone']);
		$worksheet->write_string($arr_rows, 9, $rows['AdditionalMPhone']);
		$worksheet->write_string($arr_rows, 10, str_replace(".",",",$rows['Rate']*100));
		// str_replace(".",",",(($rows['Rate']*100)<1?NULL:$rows['Rate']*100))
		$worksheet->write_string($arr_rows, 11, $rows['mkt_code']);
		$worksheet->write_string($arr_rows, 12, $rows['NeedNPWP']);
		$worksheet->write_string($arr_rows, 13, $rows['GHI']);
		$worksheet->write_string($arr_rows, 14, $rows['Cardno']);
		$worksheet->write_string($arr_rows, 15, $rows['Custno']);
		$worksheet->write_string($arr_rows, 16, $rows['pilpro']);
		$worksheet->write_string($arr_rows, 17, $rows['PunyaNPWP']);
		$worksheet->write_string($arr_rows, 18, $rows['SubmitNPWP']);
		$worksheet->write_string($arr_rows, 19, $rows['HomePhone']='0'?"":$rows['HomePhone']);
		$worksheet->write_string($arr_rows, 20, $rows['OfficePhone']='0'?"":$rows['OfficePhone']);
		$worksheet->write_string($arr_rows, 21, $rows['MobilePhone']='0'?"":$rows['MobilePhone']);
		$worksheet->write_string($arr_rows, 22, $rows['CreateDate']);
		$worksheet->write_string($arr_rows, 23, $rows['ProdType']);
		$worksheet->write_string($arr_rows, 24, ($rows['IncomeDocCollect']="Sudah Ada Income Doc"?"Y":"N"));
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