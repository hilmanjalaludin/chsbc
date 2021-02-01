<?php 
ini_set("memory_limit","1024M");
set_time_limit(3600);

/*
	php -q /opt/enigma/webapps/hsbc-portof/index.php fixed openfile
*/
define('APP_TEMP', '/opt/enigma/webapps/hsbc-portof/application/temp' );
define('REC_TEMP', '/opt/enigma/webapps/hsbc-portof/application/recover' );


class fixed extends EUI_Controller{

var $temp_upload_file = array();


function __construct(){
	parent::__construct();
	$this->load->helper(array('EUI_ExcelWorksheet','EUI_ExcelWorkbookBig'));
	
}	

// realfile
function realfile( $file = null  ){
   $file = explode('_', $file);
   return $file[1];
}

// fixedfile 
function fixedfile(){
	$list_xls = scandir(APP_TEMP);
	
	$total = 0;
	foreach( $list_xls as $key => $file ){
		if( !is_dir( $file ) )
		{
			// keep data on here 
			$this->temp_upload_file[$file] = $file;
			
			// then will proces like this;
			$source = sprintf("%s/%s",APP_TEMP, $file);
			$destination = sprintf("%s/%s",APP_TEMP, $this->realfile($file));
			$detected  = $this->realfile($file);
			
			if( !file_exists($destination) and strstr($detected, '.xls')){
				$cmdline = sprintf("cp %s %s", $source, $destination);
				system( $cmdline );
			}
			
			printf("%s", ".");
			$total++;
		}
		
	}
	printf("%s\n\r", ".");
	return $total;
}

// function read ftp 
function readftp(){
	$readftp = array();
	$sql = "select * from t_gn_upload_report_ftp a where date(a.FTP_UploadDateTs)='2017-08-02'";
	$qry = $this->db->query( $sql );
	if(  $qry && $qry->num_rows() > 0 ) foreach( $qry->result_assoc() as $row ){
		$readftp[$row['FTP_Recsource']] = $row;
	}
	return $readftp;
}

// function main 
function capsule()
{
	$capsule = array();
	$ftp = $this->readftp();
	if( is_array($ftp))foreach( $ftp as $key => $row ){
		  
		$filename = basename($row['FTP_UploadFilename']);
		$checkfile  = sprintf("%s/%s", APP_TEMP, $filename);
		
		if( file_exists( $checkfile) ){
			$capsule[$filename] = array(	
				'id' => $row['FTP_UploadId'],
				'date' => $row['FTP_UploadDateTs'],
				'recsource' =>  $row['FTP_Recsource'],
				'realfile' => $row['FTP_UploadFilename'],
				'path' => $checkfile );
		}
	} 
	return $capsule;
}

// bandingakan 
function bandingakan( $custno = null ){
	$total = 0;
	$sql = sprintf("select count(a.CustomerId) as total from t_gn_customer a 
					 where a.CustomerNumber = '%s'
					 and a.expired_date ='0000-00-00'", $custno);
	//echo $sql;				 
	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows() > 0 ){
		$total = $qry->result_singgle_value();
	}	
	return (int)$total;
}


// pushalldataexcel 
function pushalldataexcel( $filename=null, $xls_header = null, $xls_body = null )
{
	// this new dir if not exist 
	if( !is_dir( REC_TEMP ) )	{
		mkdir( REC_TEMP, 0777, true);
	}
	
	$filecapsule = sprintf("%s_%s", $filename, date('YmdH'));
	
	// then will run oh here .
	
	
	$filecompile = sprintf("%s/RECOVER_%s.xls", REC_TEMP, $filecapsule);
	$filetitles  = "RECOVER_ALL_DATA_PROCESS";
	
	// call my lib excel export like here .
	if( file_exists( $filecompile ) ){
		@unlink($filecompile);
	}
	
	 $workbook =& new writeexcel_workbook($filecompile);
	 $worksheet =& $workbook->addworksheet();
	
	
	// title format 
	 $title_format =& $workbook->addformat();
	 $title_format ->set_bold();
	 $title_format->set_size(14);
	 $title_format->set_color('black');
	 $title_format->set_align('left');
	 $title_format->set_align('vcenter');
	 
	
	// header format 
	 $header_format =& $workbook->addformat();
	 $header_format ->set_bold();
	 $header_format->set_size(10);
	 $header_format->set_color('white');
	 $header_format->set_align('left');
	 $header_format->set_align('vcenter');
	 $header_format->set_pattern();
	 $header_format->set_fg_color('blue');
	 
	
	$row_start = 0;
	$worksheet->write_string($row_start, 0, $filetitles, $title_format);
	$row_start = $row_start+1;
	
	// create my header 
	$col_header = 0;
	if( is_array($xls_header)) foreach( $xls_header as $key => $header ){
		$worksheet->write_string($row_start, $col_header, $header, $header_format);
		$col_header++;
	}
	
	
	// creat my body excel like this;
	$row_start = $row_start+1;
	$tot_body   = count($xls_header);
	
	$row_data = $xls_body;
	
	// push data to body of excel 
	if( is_array($row_data) )  foreach( $row_data as $key => $row_value ){
		$row_col = 0;
		foreach( $xls_header as $key => $field ){
			$worksheet->write_string( $row_start, $row_col, $row_value[$field]);
			$row_col++;
		}
		$row_start += 1;
	}
	@unlink($filename);
	$workbook->close(); // end book 
}

// push data excel 

function pushdataexcel( $filename=null, $xls_recsource =null, $xls_header = null, $xls_body = null ){
	
	// this new dir if not exist 
	if( !is_dir( REC_TEMP ) )	{
		mkdir( REC_TEMP, 0777, true);
	}
	
	$filecapsule = rtrim(basename($filename), '.xls');
	$filesource = null;
	foreach(  $this->temp_upload_file as $key => $filereal){
		
		
		if( strstr($filereal, $filecapsule) ){
			$filesource = $filereal;
		}
	}
	// then will run oh here .
	
	
	$filecompile = sprintf("%s/RECOVER_%s_%s_%s.xls", REC_TEMP, $filesource, $filecapsule, $xls_recsource);
	$filetitles  = "RECOVER_UPLOAD_FILE";
	
	// call my lib excel export like here .
	if( file_exists( $filecompile ) ){
		@unlink($filecompile);
	}
	
	 $workbook =& new writeexcel_workbook($filecompile);
	 $worksheet =& $workbook->addworksheet();
	
	
	// title format 
	 $title_format =& $workbook->addformat();
	 $title_format ->set_bold();
	 $title_format->set_size(14);
	 $title_format->set_color('black');
	 $title_format->set_align('left');
	 $title_format->set_align('vcenter');
	 
	
	// header format 
	 $header_format =& $workbook->addformat();
	 $header_format ->set_bold();
	 $header_format->set_size(10);
	 $header_format->set_color('white');
	 $header_format->set_align('left');
	 $header_format->set_align('vcenter');
	 $header_format->set_pattern();
	 $header_format->set_fg_color('blue');
	 
	
	$row_start = 0;
	$worksheet->write_string($row_start, 0, $filetitles, $title_format);
	$row_start = $row_start+1;
	$worksheet->write_string($row_start, 0, sprintf("FILESOURCE < %s >",  $filesource ), $title_format);
	$row_start = $row_start+1;
	$worksheet->write_string($row_start, 0, sprintf("RECSOURCE < %s >", $xls_recsource), $title_format);
	$row_start = $row_start+1;
	
	// create my header 
	$col_header = 0;
	if( is_array($xls_header)) foreach( $xls_header as $key => $header ){
		$worksheet->write_string($row_start, $col_header, $header, $header_format);
		$col_header++;
	}
	
	
	// creat my body excel like this;
	$row_start = $row_start+1;
	$tot_body   = count($xls_header);
	
	$row_data = $xls_body[$xls_recsource];
	
	// push data to body of excel 
	if( is_array($row_data) )  foreach( $row_data as $key => $row_value ){
		$row_col = 0;
		foreach( $xls_header as $key => $field ){
			$worksheet->write_string( $row_start, $row_col, $row_value[$field]);
			$row_col++;
		}
		$row_start += 1;
	}
	@unlink($filename);
	$workbook->close(); // end book 
 
}

// function open file 
function openfile()
{
	
	$fixed = $this->fixedfile();
	$capsule = $this->capsule(); 
	
	
	$total_row_scan = 0;
	$total_row_failed = 0;
	$total_row_success = 0;
	
	$data_all_row = array();
	$data_all_idx = 0;
	foreach( $capsule as $filename => $row )
	{
		
		$xls_recsource = $row['recsource'];
		$xls_read = $row['path'];
		$xls_realfile = $row['realfile'];
		
		
		if( file_exists( $xls_read ) )
		{
			
			printf("start scan data xls : %s, Recsouce: %s\n\r", basename($xls_read), $xls_recsource);
			
			// test read on file 
			$xls_reader = new EUI_ExcelImport();
			$row_source = $xls_reader->_ReadData( $xls_read );
			$row_total  = $xls_reader->rowcount(0);
			
			// my header an array 
			
			$row_header = array();
			$row_data   = array();
			
			$row_start  = 1;
			while( $row_start <= 1 ){
				$cols_total = $xls_reader->colcount(0);
				
				for( $xls_col = 1; $xls_col<=$cols_total; $xls_col++) {
					$row_header[$xls_col] =  $xls_reader->val($row_start, $xls_col);
				}
				$row_start++;
			}
			
			// my body 
			
			$row_start  = $row_start+1;
			while( $row_start <= $row_total ){
				$cols_total = $xls_reader->colcount(0);
				foreach( $row_header as $col => $val ){
					$row_data[$row_start][$val] =  $xls_reader->val($row_start, $col);	
				}
				$row_start++;
			}
			
			// cetak data body 
			
			$row_banding = array();
			$row_success = 0;
			$row_failed = 0;
			$row_scaned = 0; 
			if( is_array($row_data) ) 
				foreach( $row_data as $key => $row )
			{
				$custno  = trim($row['Custno1']);
				if( $custno ){
					
				// jika ada data yang dibandingkan ada 
					
					$banding = $this->bandingakan($custno);
					if( $banding ){ 
						$data_all_row[$data_all_idx] = $row;
						$row_banding[$xls_recsource][$row_success] = $row; 
						$row_success++; 
						$data_all_idx++;
					}else{
						$row_failed++;
					}	
					
					$row_scaned++;
				}
			}
			 
			// push data balik ke excel.
			$this->pushdataexcel($xls_read, $xls_recsource, $row_header,  $row_banding);
			
			
			printf("end scan data xls : %s, total:<%s> scaned: <%s>, not match: <%s>\n\r", 
				basename($xls_read), 
				$row_scaned, 
				$row_success, 
				$row_failed); 
			
			printf("%s\n\r", "======================================================");
			printf("%s\n\r", "======================================================");
			
		}
		
		// akumulatif	
			$total_row_scan +=$row_scaned;
			$total_row_failed+=$row_failed;
			$total_row_success+=$row_success;
			
	}
	
	
	$this->pushalldataexcel("ALL_DATA_PROCESS", $row_header,  $data_all_row);
	
	printf("%s\n\r", "======================================================");
	printf("End Process Recover Data Upload %s\n\r", ":");
	printf("Total Data Row : %s\n\r", $total_row_scan);
	printf("Total Data Scan : %s\n\r", $total_row_success);
	printf("Total Data Not Macth : %s\n\r", $total_row_failed);
	printf("%s\n\r", "======================================================");
	printf("%s\n\r", ".");
	exit;
}

// end class 
}


?>