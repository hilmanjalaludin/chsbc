<?php
/*
 *
 */
class ModUploadDetail Extends EUI_Controller
{

/*
 *
 */
 
public function ModUploadDetail()
 {
	parent::__construct();	
	$this -> load -> model(array(base_class_model($this)));
 }
 
 
/*
 *
 */
 
public function index()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( class_exists(base_class_model($this)) ) 
		{
			$EUI = array( 'page' => $this -> {base_class_model($this)} -> _get_default());
			$this -> load -> view('mod_upload_detail/view_upload_nav', $EUI);
		} 
		else
		{
			echo "Class ".base_class_model($this)." does no exist ";
			exit(0);
		}
	}
 }
 
/*
 *
 */
 
public function Content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId'))
	{
		$EUI['page'] = $this ->{base_class_model($this)}-> _get_resource(); // load content data by pages 
		$EUI['num']  = $this ->{base_class_model($this)}-> _get_page_number(); 	// load content data by pages 
		
		$this -> load -> view('mod_upload_detail/view_upload_list', $EUI );
	}	
 }
 
// hidden

function hidden()
{
	$_conds = array('success' => 0 );
	
	if( $this -> EUI_Session -> _have_get_session('UserId') 
		AND  $this -> URI -> _get_have_post('FTP_UploadId') )
	{
		$DataId = $this -> URI->_get_array_post('FTP_UploadId');
		if( is_array($DataId) )
		{
			$results = $this -> {base_class_model($this)}->_setHidden($DataId, $this ->URI->_get_post('Active'));
			if( $results )
			{
				$_conds = array('success' => 1);
			}
		}
	}
	
	echo json_encode($_conds);
} 

// Delete

function Delete()
{
	$_conds = array('success' => 0 );
	
	if( $this -> EUI_Session -> _have_get_session('UserId') 
		AND  $this -> URI -> _get_have_post('FTP_UploadId') )
	{
		$DataId = $this -> URI->_get_array_post('FTP_UploadId');
		if( is_array($DataId) )
		{
			$results = $this -> {base_class_model($this)}->_setDeleted($DataId);
			if( $results )
			{
				$_conds = array('success' => 1);
			}
		}
	}
	
	echo json_encode($_conds);
}
 
 // SaveExcel
 
 function SaveExcel()
 {
	$Buffer 	= 2048;
	$Upload		= null; 
	$pos_data 	= $this -> URI->_get_array_post('Ftp_upload_id');
	$Upload 	= $this -> {base_class_model($this)}->_getDataUpload($pos_data);
	if( is_array($Upload) )
	{
		foreach( $pos_data as $k => $Counter )
		{
			$_full_name = basename($Upload[$Counter]['FTP_UploadFilename']);
			$_full_path = str_replace('system/', APPPATH,BASEPATH).'temp/'. $_full_name;
			
			if( !file_exists($_full_path) ) show_error(" File $_full_name not found on directory !");
			else
			{
				if ($fd = fopen ($_full_path, "r")) 
				{
					header("Pragma: public");
					header("Expires: 0");
					header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
					header("Content-Type: application/force-download");
					header("Content-Type: application/octet-stream");
					header("Content-Type: application/download");;
					header("Content-Disposition: attachment;filename=".$_full_name);
					header("Content-length:".filesize($_full_path));
					header("Content-Transfer-Encoding: binary ");
					while(!feof($fd)) 
					{
						$read= fread($fd, $Buffer);
						echo $read;
					}
				}
				
				fclose($fd);
			}	
		}	
	} 
 }
 
 function ExportBlacklist()
 {
	 $U_ID = $this->URI->_get_post('Ftp_upload_id');
	 
	 $this->load->view('mod_upload_detail/view_export_blacklist',array(
		'U_ID' => $U_ID,
		'datas' => $this->{base_class_model($this)}->_get_trx_blacklist($U_ID),
		'file' => $this -> {base_class_model($this)}->_getDataUpload(array($U_ID))
	 ));
 }
 
 
}

?>