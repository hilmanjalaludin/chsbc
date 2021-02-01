<?php
class ChatWith extends EUI_Controller
{


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 function __construct()
 {
	parent::__construct();
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object'));
 }
	

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
	
 function UserReady()
{
	// if(in_array(_get_session('HandlingType'), array( USER_AGENT_OUTBOUND ))){
	// 	echo "Access Bloked";
	// }else{
		if(_get_session('UserId'))
		{
			$raw = array('row' => $this -> {base_class_model($this)}->_getUserReady());
			$this -> load -> view('mod_chat_with/view_user_chat_index',$raw );
		}	
	// }
	
}
 
 
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 function UserStore() 
 {
	if(_get_session('UserId'))
	{
		$json = array('users' => $this ->{base_class_model($this)}->_getUserReady());
		echo json_encode($json);
	}
 } 
	
}
?>