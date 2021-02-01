<?php
$filename = 'blacklist_'.basename($file[$U_ID]['FTP_UploadFilename']);
$filepath = FCPATH."application/temp/".$filename;

$this->load->helper('EUI_ExcelWorksheet');

$workbook =& new writeexcel_workbook($filepath);
$worksheet =& $workbook->addworksheet();

$header_format =& $workbook->addformat();
$header_format ->set_bold();
$header_format->set_size(10);
$header_format->set_color('white');
$header_format->set_align('left');
$header_format->set_align('vcenter');
$header_format->set_pattern();
$header_format->set_fg_color('blue');

$c_row=0;
$c_col=0;

/* HEADERNYA CIIIN */
$worksheet->write_string($c_row, $c_col, 'CUST_NO', $header_format);$c_col++;
$worksheet->write_string($c_row, $c_col, 'CUST_NAME', $header_format);$c_col++;
$worksheet->write_string($c_row, $c_col, 'CAMPAIGN_NAME', $header_format);$c_col++;
$worksheet->write_string($c_row, $c_col, 'UPLOAD_DATE', $header_format);$c_col++;
$worksheet->write_string($c_row, $c_col, 'STATUS_DUPCHECK', $header_format);$c_col++;
/* END OF HEADERNYA CIIIN */

$c_row++;
$c_col=0;

$style_1 =& $workbook->addformat();
$style_1->set_fg_color(0x09);

$style_2 =& $workbook->addformat();
$style_2->set_fg_color(0x1A);

foreach($datas as $rows)
{
	$color = ($c_row%2?$style_1:$style_2);
	
	$worksheet->write_string($c_row, $c_col, $rows['Custno'], $style_1);$c_col++;
	$worksheet->write_string($c_row, $c_col, $rows['CustomerFirstName'], $style_1);$c_col++;
	$worksheet->write_string($c_row, $c_col, $rows['FTP_Recsource'], $style_1);$c_col++;
	$worksheet->write_string($c_row, $c_col, $rows['CustomerUploadedTs'], $style_1);$c_col++;
	$worksheet->write_string($c_row, $c_col, $rows['Upload_Notes'], $style_1);$c_col++;
	
	$c_row++;
	$c_col=0;
}

$workbook->close(); // end book 

if( file_exists($filepath))
{
  header("Pragma: public");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Content-Type: application/force-download");
  header("Content-Type: application/octet-stream");
  header("Content-Type: application/download");
  header("Content-type: application/vnd.ms-excel; charset=utf-16");
  header("Content-Disposition: attachment; filename=". basename($filepath));
  header("Content-Transfer-Encoding: binary");
  header("Content-Length: " . filesize($filepath));
  readfile($filepath); 
  @unlink($filepath);
}
else{
	echo $filepath;
}
?>