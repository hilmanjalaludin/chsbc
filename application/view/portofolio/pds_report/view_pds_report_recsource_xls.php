<?php 

 function _convertDate($date){
	$exDate = explode("/",$date);
	$imDate = $exDate[2]."-".$exDate[0]."-".$exDate[1];
	$date = " ".$imDate." ";
	return $date;
 }
 // echo "<pre>";
 // print_r($RowData2);
 // echo "</pre>";
 
 $arr_title = "PDS Report Periode of "._convertDate($param['start_date']) ."to". _convertDate($param['end_date']);
 $arr_printedby = "Printed By: "._get_session('Username');
 $arr_printdate = "Print Date: ".date('m/d/Y H:i:s');
 $base_file_tmp = "PDSReport_".date('YmdHis').".xls";
 $base_file_name = "/opt/enigma/webapps/hsbc-portof-sql/application/temp/".$base_file_tmp;
 // $base_file_name = "/opt/enigma/webapps/reporting/application/temp/".$base_file_tmp;
 
 
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

$arr_rows = 0;
$worksheet->write_string($arr_rows, 0, $arr_title, $title_format);
$worksheet->write_string($arr_rows+=1, 0, $arr_printedby, $title_format);
$worksheet->write_string($arr_rows+=1, 0, $arr_printdate, $title_format);

$arr_rows+=2;
	// agent title
	$arr_rows+=1;
	// table
	$arr_rows+=1;
	
	$SumTot	 = 0; 
	$SumCall = 0;
	$SumLig  = 0;
	$SumCan  = 0;
	$SumNot  = 0;
	$SumUnc  = 0;
	$SumSuc  = 0;
	$SumAbd  = 0;
	
	$worksheet->write_string($arr_rows, 0, "Recsource", $header_format );
	$worksheet->write_string($arr_rows, 1, "Total Data", $header_format );
	$worksheet->write_string($arr_rows, 2, "Total Number PDS Call",  $header_format );
	$worksheet->write_string($arr_rows, 3, "Total Data (No Have Phone Number)", $header_format );
	$worksheet->write_string($arr_rows, 4, "Cancel PDS", $header_format );
	$worksheet->write_string($arr_rows, 5, "Un Contacted",  $header_format );
	$worksheet->write_string($arr_rows, 6, "Receive Agent", $header_format );
	$worksheet->write_string($arr_rows, 7, "Not Yet Call", $header_format );
	$worksheet->write_string($arr_rows, 8, "Abandon",  $header_format );
	
	$arr_rows +=1;
	
	foreach($PDSData as $Recs => $Rows){
		$worksheet->write_string($arr_rows, 0, $Rows['Recsource']);
		$worksheet->write_number($arr_rows, 1, $Rows['Total']);
		$worksheet->write_number($arr_rows, 2, $Rows['TotalCall']);
		$worksheet->write_number($arr_rows, 3, $Rows['lightening']);
		$worksheet->write_number($arr_rows, 4, $Rows['Cancel']);
		$worksheet->write_number($arr_rows, 5, $Rows['Notyet']);
		$worksheet->write_number($arr_rows, 6, $Rows['Uncontacted']);
		$worksheet->write_number($arr_rows, 7, $Rows['Success']);
		$worksheet->write_number($arr_rows, 8, $Rows['Abandon']);
		
		$SumTot	 +=$Rows['Total'];
		$SumCall +=$Rows['TotalCall'];
		$SumLig  +=$Rows['lightening'];
		$SumCan  +=$Rows['Cancel'];
		$SumNot  +=$Rows['Notyet'];
		$SumUnc  +=$Rows['Uncontacted'];
		$SumSuc  +=$Rows['Success'];
		$SumAbd  +=$Rows['Abandon'];
		
		$arr_rows+=1;
	}
	
	$worksheet->write_string($arr_rows, 0, 'Summary', $bootom_format);
	$worksheet->write_number($arr_rows, 1, $SumTot, $bootom_format);
	$worksheet->write_number($arr_rows, 2, $SumCall, $bootom_format);
	$worksheet->write_number($arr_rows, 3, $SumLig, $bootom_format);
	$worksheet->write_number($arr_rows, 4, $SumCan, $bootom_format);
	$worksheet->write_number($arr_rows, 5, $SumNot, $bootom_format);
	$worksheet->write_number($arr_rows, 6, $SumUnc, $bootom_format);
	$worksheet->write_number($arr_rows, 7, $SumSuc, $bootom_format);
	$worksheet->write_number($arr_rows, 8, $SumAbd, $bootom_format);

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