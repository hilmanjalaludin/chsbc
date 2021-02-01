<?php
class M_ModViewUpload extends EUI_Model
{
/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function M_ModViewUpload()
 {	
	//& __constructor();
 }
 
/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
function _getModFilename( )
 {
	$_conds = array();
	$this -> db -> select("FTP_UploadId, FTP_UploadFilename, FTP_UploadDateTs ");
	$this -> db -> from('t_gn_upload_report_ftp');
	$this -> db -> where('FTP_Flags',1);
	foreach( $this -> db -> get() -> result_assoc() as $rows ) {
		$_conds[$rows['FTP_UploadId']] = self::_get_name($rows['FTP_UploadFilename']) .'_'. date('YHs',strtotime($rows['FTP_UploadDateTs']));
	}
	
	return $_conds;
}

/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
private function _get_name( $url )
{
	$_conds = null;
	if( $url )
	{
		$_data = explode('/',$url);
		if( is_array($_data) )
		{
			$_conds = $_data[count($_data)-1];
		}
	}
	
	return $_conds;
}

/**
 * (F) _getModFilenameUpload [get upload invalid]
 */
function _getModFilenameUpload( )
{
	$_conds = array();
	$this -> db -> select("FTP_UploadId, FTP_UploadFilename, FTP_UploadDateTs ");
	$this -> db -> from('t_gn_upload_report_ftp');
	$this -> db -> where('FTP_Flags',1);
	$this -> db ->order_by('FTP_UploadId', 'desc');
	foreach( $this -> db -> get() -> result_assoc() as $rows ) {
		// $_conds[$rows['FTP_UploadId']] = self::_get_name($rows['FTP_UploadFilename']) .'_'. date('YHs',strtotime($rows['FTP_UploadDateTs']));
		$_conds[$rows['FTP_UploadId']] = self::_get_name($rows['FTP_UploadFilename']);
	}
	
	return $_conds;
}

}

?>