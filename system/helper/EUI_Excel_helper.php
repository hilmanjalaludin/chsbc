<?php
/**
 ** Model Configuration and library
 ** EUI < Enigma User interface 0.1 >
 ** Licensed under the MIT ( http://razakitechnology.com/siteraztech/product/web-application ) license.
 ** Copyright © 2014-2012 razaki Labs ( http://razakitechnology.com )        
 **/

class EUI_Excel
 {	
	
private static $instance;

 /*
 * E.U.I test data 
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('select'=>'selected', 'length'=> '', 'disabled' => true, 'style => ''); 
 */
 
 
public static function &get_instance()
{ 
	if( is_null(self::$instance) )
	{
		self::$instance= new self();
	}
	
	return self::$instance;
}
 /*
 * E.U.I test data 
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('select'=>'selected', 'length'=> '', 'disabled' => true, 'style => ''); 
 */
 	
 function EUI_Excel(){}
 
 /*
 * E.U.I test data 
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('select'=>'selected', 'length'=> '', 'disabled' => true, 'style => ''); 
 */
 	
 function xlsBOF() {
	echo pack("s6", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);  
	return;
 }
 /*
 * E.U.I test data 
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('select'=>'selected', 'length'=> '', 'disabled' => true, 'style => ''); 
 */
 
 function xlsEOF()
 {
		echo pack("ss", 0x0A, 0x00);
		return;
	}
 /*
 * E.U.I test data 
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('select'=>'selected', 'length'=> '', 'disabled' => true, 'style => ''); 
 */
 
 function xlsWriteNumber($Row, $Col, $Value)
	{
		echo pack("s5d", 0x203, 14, $Row, $Col, 0x0,$Value);
		//echo pack("s5d", $Value);
		return;
	}
	
 /*
 * E.U.I test data 
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('select'=>'selected', 'length'=> '', 'disabled' => true, 'style => ''); 
 */
 	

 function xlsWriteLabel($Row, $Col, $Value )
	{
		$L = strlen($Value);
		echo pack("s6A*", 0x204, 8 + $L, $Row, $Col, 0x0, $L, $Value);
		//echo $Value;
	return;
	} 
	
 /*
 * E.U.I test data 
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('select'=>'selected', 'length'=> '', 'disabled' => true, 'style => ''); 
 */
 	
	function xlsWriteHeader($xlsFilename)
	{
		if(!empty($xlsFilename))
		{
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Content-Type: application/force-download");
			header("Content-Type: application/octet-stream");
			header("Content-Type: application/download");
			header("Content-type: application/vnd.ms-excel; charset=utf-16");
			header("Content-Disposition: attachment;filename=".$xlsFilename.".xls"); 
			header("Content-Transfer-Encoding: binary ");
		}
		else
		{
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Content-Type: application/force-download");
			header("Content-Type: application/octet-stream");
			header("Content-Type: application/download");
			header("Content-type: application/vnd.ms-excel; charset=utf-8");
			header("Content-Disposition: attachment;filename=PhpExporttoExcel.xls"); 
			//header("Content-Transfer-Encoding: binary ");
		}
		
		$this->xlsBOF();
	}
	
 /*
 * E.U.I test data 
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('select'=>'selected', 'length'=> '', 'disabled' => true, 'style => ''); 
 */
 
 public function CSV_WriteHeader( $FileName=null )
 {
	$_CSV_file = ( is_null($FileName)?"file.csv":$FileName.".csv");
	if( $_CSV_file )
	{
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header('Content-Description: File Transfer');
		header("Content-type: text/csv");
		header("Content-Disposition: attachment; filename={$_CSV_file}");
		header("Expires: 0");
		header("Pragma: public");
	}	
 }  

/*
 * E.U.I test data 
 
 * @ name 	: just only html to excel spredshett 
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('select'=>'selected', 'length'=> '', 'disabled' => true, 'style => ''); 
 */	
  
	
public function HTML_Excel($filename = 'download')
{
	header('Content-type: application/ms-excel;charset=UTF-8');
	header('Content-Disposition: attachment; filename=' . $filename .'_'.date('Ymd').'_' . date('Hi'). '.xls'); 
	header("Pragma: no-cache"); 
}	
	
/*
 * E.U.I test data 
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('select'=>'selected', 'length'=> '', 'disabled' => true, 'style => ''); 
 */	
 
public function CSV_Export($CSV_Data = null , $display = false )
{
	if( !is_null($CSV_Data) )
	{
		$fh = @fopen('php://output', 'w');
		
		$headerDisplayed = $display;
		
		foreach ( $CSV_Data as $data ) 
		{
			if ( !$headerDisplayed ) 
			{
				fputcsv($fh, array_keys($data));
				$headerDisplayed = true;
			}
			
			fputcsv($fh,$data);
		}

		fclose($fh);
	}	
}	
	
/*
 * E.U.I test data 
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('select'=>'selected', 'length'=> '', 'disabled' => true, 'style => ''); 
 */	
 	
public function CSV_Close() {
	exit;	
}

	
 /*
 * E.U.I test data 
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('select'=>'selected', 'length'=> '', 'disabled' => true, 'style => ''); 
 */
 	
	function xlsClose()
	{
		$this->xlsEOF();
	}
 /*
 * E.U.I test data 
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('select'=>'selected', 'length'=> '', 'disabled' => true, 'style => ''); 
 */
 	
}

/*
 * E.U.I test data 
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('select'=>'selected', 'length'=> '', 'disabled' => true, 'style => ''); 
 */
 
if(!function_exists('Excel') )
{
  function Excel()
  {
	$Excel =& EUI_Excel::get_instance();
	if( $Excel ) {
		return $Excel;
	}
  }
}

?>