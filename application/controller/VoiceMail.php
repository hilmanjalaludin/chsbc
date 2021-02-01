<?php

class VoiceMail extends EUI_Controller
{


/*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
public function VoiceMail()
{
	parent::__construct();
	$this->load->model(array('M_VoiceMail','M_SetCampaign','M_Combo','M_Configuration'));
}	

/*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
public function index()
{ 
	if( $this -> EUI_Session->_get_session('UserId')) 
	{
		$UI = array(
			'page' => $this -> {base_class_model($this)}->_get_default() 
		);
		$this -> load -> view( 'mod_voice_mail/view_voice_mail_nav', $UI);
	}
}
	

	

	
/*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$UI = array( 
			'page' => $this -> {base_class_model($this)} -> _get_resource(),
			'num'  => $this -> {base_class_model($this)} -> _get_page_number()
		);
		
		$this -> load -> view('mod_voice_mail/view_voice_mail_list', $UI);
	}	
 }
 
/*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
 
 public function VoiceDetail() 
 {
	$VoiceId = $this->URI->_get_post('VoiceMailId');
	
	if($this->EUI_Session->_have_get_session('UserId') ) 
	{
		$this->load->view('mod_voice_mail/view_voice_detail', 
			array 
			(
				'frmVoiceContent' 	=> $this->{base_class_model($this)}->VoiceData($VoiceId),
				'frmVoiceData' 		=> $this->{base_class_model($this)}->FieldFormVoice(),
				'frmCustomer' 		=> $this->{base_class_model($this)}->FieldFormCustomer(),
				'frmCampaignId'		=> $this->{base_class_model($this)}->getCampaignGoals(),
				'frmCombo'			=> $this->{base_class_model($this)}->Serialize()
			) 
		);
	}	
 }
 
 
 /*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
 public function VoiceMailPlay()
 {

	$_success  = array('success'=>0);
	$_voice_id = $this->URI->_get_post('RecordId');
	
	$CONFIG_VOICE_MAIL=& $this->M_Configuration->_getVoiceMailServer();
	$_arrs_voice=& $this->{base_class_model($this)}->VoiceData($_voice_id);
	if(($_arrs_voice != FALSE) AND (is_array($CONFIG_VOICE_MAIL)!=FALSE )  )  
	{
		$this->load->library('Ftp');
		
		$this->Ftp->connect(array( 
			'hostname' 	=> $CONFIG_VOICE_MAIL['voice.mail.server'], 
			'port' 		=> $CONFIG_VOICE_MAIL['voice.mail.port'], 
			'username' 	=> $CONFIG_VOICE_MAIL['voice.mail.username'], 
			'password' 	=> $CONFIG_VOICE_MAIL['voice.mail.password']
		) );
		
		if( ($this -> Ftp->_is_conn()!=FALSE) AND (isset($_arrs_voice['file_voc_loc'])) )
		{
			$_found   = null;
			
			$this->Ftp->changedir($_arrs_voice['file_voc_loc']); 
			
			$fp = $this -> Ftp -> list_files('.');
			
			if(is_array($fp))foreach( $fp as $k => $rows ) 
			{
				if( ($rows == $_arrs_voice['file_voc_name'])) {
					$_found = $rows;
				}
			}
			
			if(!defined('RECPATH') ) 
				define('RECPATH',str_replace('system','application', BASEPATH)."temp");
				
			if( !is_null($_found) )
			{
				$_original_path = RECPATH;
					if($this -> Ftp -> download(RECPATH . '/' . $_found, $_found ) )  {
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
 * @ def 		: remove of file wav on TMP  
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
 
 public function RemoveWav()
 {
	define('RECPATH',str_replace('system','application', BASEPATH)."temp");
	if( $filename = $this->URI->_get_post('filename') ) {
		$cmd_path = ' cd '.RECPATH .'/ && rm -rf '. $filename;
		system($cmd_path);
	}
	
	__(json_encode(array('success'=>1)));
 }
 
 
/*
 * @ def 		: SaveVoiceMail 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
 
 
public function SaveVoiceMail()
{
  $success = array('success' => 0);
  $param =& $this->URI->_get_all_request();
  
  if( ($param!=FALSE) )
  {	
		$conds = $this->{base_class_model($this)}->_setSaveVoiceMail( $param );
		if($conds) 
		{
			  $success = array('success' => 1);
		}
   }
   
   // return to object js ***
   
   __(json_encode($success));
   
}
 
 
}
?>