<?php

/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class ModVoiceData Extends EUI_Controller
{

// ---------------------------------------------------------------------
/*
 * @ package 	: instance object 
 
 *
 */ 
 public function __construct ()
{
	parent::__construct();
	$this->load->model(array(base_class_model($this),'M_Pbx','M_Configuration', 'M_SetCampaign','M_SrcCustomerList','M_SysUser'));
	$this->load->helpers(array('EUI_Object'));
 }
 
// ---------------------------------------------------------------------
/*
 * @ package 	: - 
 
 * @ notes 		: 
 * @ param      :  
 */ 
 
 
public function _getCallInterest()
{
	$interest = array();
	
	if( $res = $this->M_SetCallResult->_getRealInterest() )
	{
		foreach( $res as $id  => $rows ) {
			$interest[$id] = $rows['name'];
		}
	}
	
	return $interest;
}
// ---------------------------------------------------------------------
/*
 * @ package 	: - 
 
 * @ notes 		: 
 * @ param      :  
 */ 
 
public function getAllResult()
{
	$interest = array();
	
	if( $res = $this->M_SetCallResult->_getAllResult() )
	{
		foreach( $res as $id  => $rows ) {
			$interest[$id] = $rows;
		}
	}
	
	return $interest;
}

// ---------------------------------------------------------------------
/*
 * @ package 	: - 
 
 * @ notes 		: 
 * @ param      :  
 */ 
 

public function index()
{
 if( $this ->EUI_Session ->_have_get_session('UserId') && class_exists('M_ModVoiceData') )
 {
	$_EUI  = array ( 
		'page' 		 => $this->M_ModVoiceData->_get_default(),
		'CampaignId' => $this->M_SetCampaign->_get_campaign_name(),
		'CardType' 	 => $this->M_SrcCustomerList->_getCardType(), 
		'GenderId' 	 => $this->M_SrcCustomerList->_getGenderId(),
		// 'UserId' 	 => $this->M_SysUser->_get_teleamarketer(),
		'UserId' 	 => $this->M_SysUser->_get_user_by_query(array('handling_type'=>USER_AGENT_OUTBOUND,'user_state'=>1)),
		// 'CallResult' => $this->_getCallInterest()
		'CallResult' => $this->getAllResult()
	);
		
		
	if( is_array($_EUI))
	{
		$this -> load ->view('mod_voice_data/view_mod_voice_nav',$_EUI);
	}	
 }
 
}
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function Content()
{

  if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this ->M_ModVoiceData ->_get_resource();    // load content data by pages 
		$_EUI['num']  = $this ->M_ModVoiceData ->_get_page_number(); // load content data by pages 
		
		// sent to view data 
		// echo "<pre>";
		// var_dump($_EUI['page']);
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('mod_voice_data/view_mod_voice_list',$_EUI);
		}	
	}	
}
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function SetVoicePlay()
{
	$_success = array('success'=>0);
	
	// M_Configuration
	
	
	
	$FTP = $this -> M_Configuration -> _getFTP();	
	$voice  = $this -> {base_class_model($this)}->_getVoiceData($this->URI->_get_post('RecordId') );
	
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
			
		// change directory on server remote ...
		
			$this->Ftp->changedir($voice['file_voc_loc']); 
			
		// show file on spesific location ..
		
			$_ftplist = $this -> Ftp -> list_files('.');
			foreach($_ftplist as $k => $src )
			{
				if( ($src == $voice['file_voc_name'])) {
					$_found = $src;
				}
			}
			
		// def location to local download 
		
			if(!defined('RECPATH') ) 
				define('RECPATH',str_replace('system','application', BASEPATH)."temp");
				
		// if match fil then download 
		
			if( !is_null($_found) ) 
			{
				$_original_path = RECPATH;
				// var_dump($_original_path)
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


/*
 * @ def 		: --
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function DownloadVoice()
 {
	$_success = array('success'=>0);
	
	// M_Configuration
	$FTP = $this -> M_Configuration -> _getFTP();	
	
	// voice data by click user ...
	$voice  = $this -> {base_class_model($this)}->_getVoiceData($this->URI->_get_post('RecordId') );
	
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
	if( ($this -> Ftp->_is_conn()!=FALSE) AND (isset($voice['file_voc_loc'])) )
	{
		$_found   = null;
		// change directory on server remote ...
		$this->Ftp->changedir($voice['file_voc_loc']); 
		// show file on spesific location ..
	
		$_ftplist = $this -> Ftp -> list_files('.');
		foreach($_ftplist as $k => $src )
		{
			if( ($src == $voice['file_voc_name'])) {
				$_found = $src; 
			}
		}
			
		// def location to local download 
			if(!defined('RECPATH') ) 
				define('RECPATH',str_replace('system','application', BASEPATH)."temp");
				
		// if match fil then download 
			if( !is_null($_found) ) 
			{	
				// $_wavvoice  = "test3.wav";
				$_wavvoice  = preg_replace('/gsm/i','wav',$_found);
				$_wavvoice  = preg_replace('(_[0-9]+_)','_xxxxxxxx_',$_wavvoice);
				
				$_original_path = RECPATH;
				// var_dump($_wavvoice);
				if($this -> Ftp -> download(RECPATH . '/' . $_found, $_found ) ) 
				{
					exec("sox {$_original_path}/{$_found} {$_original_path}/{$_wavvoice}");
					if(@unlink( $_original_path .'/'. $_found ))
					{
						$voice['file_voc_name'] = $_wavvoice;
						$_success = array('success'=>1, 'data' => $voice );
					}	
				}
			}
		}
	}
	
	echo json_encode($_success);
	
 }
 
 // DeletedVoice
 
function DeletedVoice()
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
 
 // wgetDownload
public function WgetDownload()
{
	if( $this -> URI->_get_have_post('VoiceName'))
	{
		$VoiceName = base64_decode($this -> URI->_get_post('VoiceName'));
		if( !is_null($VoiceName) )
		{
			if(!defined('RECPATH') )  define('RECPATH',str_replace('system','application', BASEPATH)."temp/". $VoiceName );
			
			if( !file_exists(RECPATH))  exit('Voice not found.');
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

public function DownloadVoiceGsm()
{
	$_success = array('success'=>0);
	
	// M_Configuration
	$FTP = $this -> M_Configuration -> _getFTP();	
	
	// voice data by click user ...
	$voice  = $this -> {base_class_model($this)}->_getVoiceData($this->URI->_get_post('RecordId') );
	
	// if exist data then cek in PBX Server ...
	if( is_array($voice) ) 
	{
	
		// include library FTP 
		$this->load->library('Ftp');
		
		// set parameter attribute 
		$PBX = $this->M_Pbx ->InstancePBX($voice['agent_ext']);
		$this->Ftp->connect(array(
			'hostname'  => $FTP["FTP_SERVER{$PBX}"],
			'port' 		=> $FTP["FTP_PORT{$PBX}"],
			'username'  => $FTP["FTP_USER{$PBX}"],
			'password'  => $FTP["FTP_PASSWORD{$PBX}"])
		);
		
		
		// cek connection ID 
		if( ($this -> Ftp->_is_conn()!=FALSE) AND (isset($voice['file_voc_loc'])) )
		{
			$_found   = null;
			// change directory on server remote ...
			$this->Ftp->changedir($voice['file_voc_loc']); 
			
			// show file on spesific location ..
			$_ftplist = $this -> Ftp -> list_files('.');
			foreach($_ftplist as $k => $src )
			{
				if( ($src == $voice['file_voc_name'])) {
					$_found = $src; 
				}
			}
			
			// def location to local download 
			if(!defined('RECPATH') ) 
				define('RECPATH',str_replace('system','application', BASEPATH)."temp/gsm");
				
			// if match fil then download 
			if( !is_null($_found) ) 
			{	
				// $_wavvoice  = $_found;
				$_wavvoice  = preg_replace('(_[0-9]+_)','_xxxxxxxx_',$_found);
				// var_dump('test' );
				$_original_path = RECPATH;
				if( $this->Ftp->download(RECPATH . '/' . $_wavvoice, $_found) ){
					$voice['file_voc_name'] = $_wavvoice;
					$_success 				= array('success'=>1, 'data' => $voice );
				}
			}
		}
	}
	echo json_encode($_success);
}

public function WgetDownloadGsm()
{
	if( $this -> URI->_get_have_post('VoiceName'))
	{
		$VoiceName = base64_decode($this -> URI->_get_post('VoiceName'));
		if( !is_null($VoiceName) )
		{
			if(!defined('RECPATH') )  define('RECPATH',str_replace('system','application', BASEPATH)."temp/gsm/". $VoiceName );
			
			if( !file_exists(RECPATH))  exit('Voice not found.');
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