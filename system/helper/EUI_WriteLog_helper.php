<?php

/*
 * E.U.I generator EUI_WriteLog on helper 
 
 * author 	 razaki team 
 * lincese	 under concept 
 * link 	 http://www.razakitechnology.com/eui/helper 
 */

class EUI_WriteLog 
{
 
 
/*
 ^ @ def		 private data 	
 *
 * @ package 	 helper
 * @ params 	$_path_write_log
 */
 
private static $_path_write_log;
/*
 ^ @ def		 private data 	
 *
 * @ package 	 helper
 * @ params 	 $_path_write_file;
 */

private static $_path_write_file;
/*
 ^ @ def		 private data 	
 *
 * @ package 	 helper
 * @ params 	 $path_log
 */

private static $path_log;
/*
 ^ @ def		 private data 	
 *
 * @ package 	 helper
 * @ params 	 $instance
 */

private static $instance;
 
/*
 ^ @ def		 &get_instance
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
public static function  &get_instance()
{
  if(is_null(self::$instance)) {
	self::$instance = new self();
 }
  return self::$instance;
}

/*
 ^ @ def		 _set_write_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
function _set_write_filename( $_file )
{
	if( !empty($_file) )
	{
		self::$_path_write_file = $_file;
		self::$_path_write_log  = self::$path_log.'/'.$_file;
	}
} 

/*
 ^ @ def		 _relative_write_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
function _relative_write_filename( $paths, $_file)
{
	if( !empty($_file) )
	{
		self::$_path_write_file = $_file;
		self::$_path_write_log  = $paths.'/'.$_file;
	}
} 

/*
 ^ @ def		  _get_write_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
function _get_write_filename()
{
	$_conds = '';
	if( !file_exists(self::$_path_write_log) )
	{
		$_conds = self::$_path_write_log;
	}
	else{
		$_conds = self::$_path_write_log;
	}
	
	return $_conds;
} 

/*
 ^ @ def		_get_content_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
 function _get_content_filename()
 {
	$_conds = '';
	if( !empty( self::$_path_write_file ) )
	{
		$_conds = self::$_path_write_file;
	}
	
	return $_conds;
 }

/*
 ^ @ def		 _write_content
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
function _write_content( $_content="" )
{
	$_path = self::_get_write_filename();
	
	if(file_exists($_path)) @unlink($_path); // remove if true
	
	if( !file_exists( $_path ) ) // then save to temp
	{
		$fp = fopen( $_path , 'a');
		fwrite( $fp, $_content);
		fclose( $fp );
	}	
}  

/*
 ^ @ def		 _download_content	
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
function _download_content()
{
	$paths = self::_get_write_filename();
	$filename = self::_get_content_filename();
	
	if( file_exists($paths) )
	{
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Length: ". filesize($paths).";");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/octet-stream; "); 
		header("Content-Transfer-Encoding: binary");
		readfile($paths);
	}	
}

}

/*
 ^ @ def		 _download_content	
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
if(!function_exists('WriteLog') )
{
 function WriteLog()
 {
	$WriteLog =& EUI_WriteLog::get_instance();
	if( $WriteLog )
	{
		return $WriteLog;
	}
 }	
}
?>