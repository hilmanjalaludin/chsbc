<?php
class Wallboard extends EUI_Controller
{

function __construct()
{
	parent::__construct();
	$this -> load -> model('M_Wallboard');
	
}	

// @ index
function index()
{
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> M_Wallboard -> _get_default();    // load content data by pages 
		$this -> load -> view('wallboard/view_nav',$_EUI);
	}
}

// @ content of page by query 
 
 function Content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> M_Wallboard -> _get_resource();    // load content data by pages 
		$_EUI['num']  = $this -> M_Wallboard -> _get_page_number(); // load content data by pages 
		
		// sent to view data 
		
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('wallboard/view_list',$_EUI);
		}	
	}	
 }
 
 // @ AddTpl
 function AddTpl()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$this -> load -> view('wallboard/view_add');
	}	
 }
 
 // @ SaveAdd
 
 function SaveAdd()
 {
	// var_dump($this->URI->_get_all_request());die();
	$_success = array('success'=> 0, 'error'=> ''); 
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this -> M_Wallboard -> _set_save_add_cores($this->URI->_get_all_request())==true)
		{
			$_success = array('success'=> 1, 'error'=> 'OK');	
		}
	}
	
	echo json_encode($_success);
 }
 
 // @ EditTpl
 
 function EditTpl()
 {
	$_success = array('success'=> 0, 'error'=> ''); 
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$data['qry'] = $this -> M_Wallboard -> _get_detail_cores( $this -> URI -> _get_post('id') );
		// var_dump($data['data']);die();
		$this -> load -> view('wallboard/view_edit', $data);
	}
 }
 
 // @ Delete 
 
 function Delete()
 {
	$_success = array('success'=> 0, 'error'=> ''); 
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this -> M_Wallboard -> _set_delete_cores($this -> URI-> _get_array_post('text_cmp_id') )) {
			$_success = array('success'=> 1, 'error'=> 'OK');	
		}
	}
	
	echo json_encode($_success);
 }
 
 // Update
 
 function Update()
 {
	$_success = array('success'=> 0, 'error'=> ''); 
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this -> M_Wallboard -> _set_update_cores(
			$this->URI->_get_all_request()
		)){
			
			$_success = array('success'=> 1, 'error'=> 'OK');	
		}
	}
	
	echo json_encode($_success);
 }

}