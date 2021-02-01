<?php

class ModUserWindow extends EUI_Controller
{
	
public function  ModUserWindow()
{
	parent::__construct();
	$this -> load-> model(array(base_class_model($this),'M_ModApprovePhone'));
}


/*
 * @ def : window add phone  
 * ------------------------------------
 *
 * @ params	: CustomerId
 */ 
 
public function ViewAddPhone()
{
	if( $this -> EUI_Session ->_have_get_session('UserId')
		AND $this -> URI-> _get_have_post('CustomerId') )
	{
		$UI = array(
			'ApproveItem' => $this->M_ModApprovePhone->_getApproveItem(),
			'CustomerId'=> $this->URI->_get_post('CustomerId')
		);
		
		if( is_array($UI) )
		{
			$this->load->view('mod_user_window/user_window_phone', $UI);
		}	
	}
}


 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function SaveAddPhone()
 {
	$success = array('success'=>0);
	$ApproveItems = $this ->URI->_get_all_request();
	if( is_array($ApproveItems) )
	{
		if( $this -> {base_class_model($this)}->_setSaveApproveItem($ApproveItems) )
		{
			$success = array('success'=>1);
		}
	}
	
	echo json_encode($success);
 }


}