<?php
/*
 * @ package  : Voice Loger 
 * @ def 	  : dependent Modul not interface Bisnis
 * @ author   : razaki team    
 */
 
 
class VoiceLoger extends EUI_Controller
{

 private static $_view_folder = null;
 
/*
 @ df : constructor 
 */	
function VoiceLoger()
{
	parent::__construct();
	$this -> load -> model(array(base_class_model($this),'M_Pbx','M_Configuration','M_Combo'));
	
	if( is_null(self::$_view_folder)) {
		self::$_view_folder = 'mod_voice_loger';
	}
}

 /*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getCombo()
 {
	$_serialize = array();
	$_combo = $this ->M_Combo->_getSerialize();
	foreach( $_combo as $keys => $method )
	{
		if((STRTOLOWER($keys)!='serialize') AND (STRTOLOWER($keys)!='instance') 
			AND (STRTOLOWER($keys)!='nstruct') AND (STRTOLOWER($keys)!='t'))
		{
			$_serialize[$keys] = $this ->M_Combo->$method(); 	
		}
	}
	
	return $_serialize;
 }
 

// @ def : index 	
 
 function index()
 {
	if( $this -> EUI_Session->_get_session('UserId')) 
	{
		$UI = array('page' => $this -> {base_class_model($this)}->_get_default(), 'combo' => $this -> _getCombo() );
		$this -> load -> view( self::$_view_folder .'/view_voice_loger_nav', $UI);
	}
 }
 
 // @ def : index 	
 
 function content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$UI = array( 
			'page' => $this -> {base_class_model($this)} -> _get_resource(),
			'num'  => $this -> {base_class_model($this)} -> _get_page_number()
		);
		
		$this -> load -> view( self::$_view_folder .'/view_voice_loger_list', $UI);
	}	
 }
 

 // DeletedVoice
 
 function Deleted()
 {
	$_success = array('success'=>0);
	
	if(!defined('RECPATH')) {
		define('RECPATH',str_replace('system','application', BASEPATH)."temp");	
	}
	
	if( $this -> URI ->_get_have_post('filename') )
	{
		$file_voice = RECPATH . '/' . $this -> URI->_get_post("filename");
		if(file_exists($file_voice) )
		{
			if( @unlink($file_voice) )
			{
				$_success = array('success'=>1);
			}
		}
	}

	echo json_encode($_success);	
				
 }
 

 public function DownloadVoice()
 {
	$_success = array('success'=>0);
	
	// M_Configuration
	  $FTP = $this -> M_Configuration -> _getFTP();	
	
	// voice data by click user ...
	$voice  = $this -> {base_class_model($this)}->_getVoiceLogerById($this->URI->_get_post('RecordId') );
	
	// if exist data then cek in PBX Server ...
	if( is_array($voice) ) 
	{
	
	// include library FTP 
		$this->load->library('Ftp');
		
		
	// set parameter attribute 
	 $PBX = $this->M_Pbx ->InstancePBX($voice['agent_ext']);
	 
	 
	 $this->Ftp->connect(array(
			'hostname' => $FTP["FTP_SERVER{$PBX}"],
			'port' => $FTP["FTP_PORT{$PBX}"],
			'username' => $FTP["FTP_USER{$PBX}"],
			'password' => $FTP["FTP_PASSWORD{$PBX}"])
		);
		
	// cek connection ID 
		if( ($this -> Ftp->_is_conn()!=FALSE) 
			AND (isset($voice['file_voc_loc'])) )
		{
			$_found   = null;
			$this->Ftp->changedir($voice['file_voc_loc']); 
			
			$_ftplist = $this -> Ftp -> list_files('.');
			foreach($_ftplist as $k => $src )
			{
				if( ($src == $voice['file_voc_name'])) {
					$_found = $src;
				}
			}
			
			if(!defined('RECPATH') ) 
				define('RECPATH',str_replace('system','application', BASEPATH)."temp");
				
			if( !is_null($_found) ) 
			{
				if($this -> Ftp -> download(RECPATH . '/' . $_found, $_found ) ) {
					$_success = array('success'=>1, 'data' => $voice );
				}
			}
		}
	}
	
	echo json_encode($_success);
	
 } 
 
 
// VoicePlay

public function VoicePlay()
{
	$_success = array('success'=>0);
	
	$FTP = $this -> M_Configuration -> _getFTP();	
	$voice  = $this -> {base_class_model($this)}->_getVoiceLogerById($this->URI->_get_post('RecordId') );
	if( is_array($voice) )  
	{
		$this->load->library('Ftp');
		
		$PBX = $this->M_Pbx ->InstancePBX($voice['agent_ext']);
		$this->Ftp->connect(array(
			'hostname' => $FTP["FTP_SERVER{$PBX}"],
			'port' => $FTP["FTP_PORT{$PBX}"],
			'username' => $FTP["FTP_USER{$PBX}"],
			'password' => $FTP["FTP_PASSWORD{$PBX}"])
		);
		
		if( ($this -> Ftp->_is_conn()!=FALSE) 
			AND (isset($voice['file_voc_loc'])) )
		{
			$_found   = null;
			
		$this->Ftp->changedir($voice['file_voc_loc']); 
		$_ftplist = $this -> Ftp -> list_files('.');
		
		foreach($_ftplist as $k => $src ) {
			if( ($src == $voice['file_voc_name'])) {
				$_found = $src;
			}
		}
		
		if(!defined('RECPATH') ) 
			define('RECPATH',str_replace('system','application', BASEPATH)."temp");
			
		if( !is_null($_found) )
		{
			$_original_path = RECPATH;
				if($this -> Ftp -> download(RECPATH . '/' . $_found, $_found ) ) 
				{
					exec("sox {$_original_path}/{$_found} {$_original_path}/{$_found}.wav");
					$voice['file_voc_name'] = "{$_found}.wav";
					@unlink( $_original_path ."/". $_found );
					$_success = array('success'=>1, 'data' => $voice );
				}
			}
		}
  }
	
	echo json_encode($_success);
}


// wgetDownload
 
 public function WgetDownload()
 {
	if( $this -> URI->_get_have_post('VoiceName'))
	{
		$VoiceName = base64_decode($this -> URI->_get_post('VoiceName'));
		if( !is_null($VoiceName) )
		{
			if(!defined('RECPATH') )  
				define('RECPATH',str_replace('system','application', BASEPATH)."temp/". $VoiceName );
			
			if( !file_exists(RECPATH))  
				exit('Voice not found.');
			else
			{
				header("Pragma: public");
				header("Expires: 0");
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Cache-Control: public");
				header("Content-Description: File Transfer");
				header("Content-Type: audio/x-gsm");
				header("Content-Disposition: attachment; filename=". basename(RECPATH));
				header("Content-Transfer-Encoding: binary");
				header("Content-Length: " . filesize(RECPATH));
				readfile(RECPATH); 
				@unlink(RECPATH);
			}
		}
	}
 }

 
 
 
} 
?>