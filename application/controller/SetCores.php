<?php
class SetCores extends EUI_Controller
{

function __construct()
{
	parent::__construct();
	$this -> load -> model('M_SetCores');
	
}	

// @ index
function index()
{
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> M_SetCores -> _get_default();    // load content data by pages 
		$this -> load -> view('set_cores/view_cores_nav',$_EUI);
	}
}

// @ content of page by query 
 
 function Content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> M_SetCores -> _get_resource();    // load content data by pages 
		$_EUI['num']  = $this -> M_SetCores -> _get_page_number(); // load content data by pages 
		
		// sent to view data 
		
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('set_cores/view_cores_list',$_EUI);
		}	
	}	
 }
 
 // @ AddTpl
 function AddTpl()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$this -> load -> view('set_cores/view_add_cores');
	}	
 }
 
 // @ SaveAdd
 
 function SaveAdd()
 {
	$_success = array('success'=> 0, 'error'=> ''); 
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this -> M_SetCores -> _set_save_add_cores(
			array(
				'CampaignGroupCode' => $this -> URI -> _get_post('text_cmp_id'),
				'CampaignGroupName' => $this -> URI -> _get_post('text_cmp_name'),
				'CampaignGroupStatusFlag' => $this -> URI -> _get_post('select_cmp_status')
			)
		))
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
		$EUI['cores'] = $this -> M_SetCores -> _get_detail_cores( $this -> URI -> _get_post('CoreId') );
		$this -> load -> view('set_cores/view_edit_cores', $EUI);
	}
 }
 
 // @ Delete 
 
 function Delete()
 {
	$_success = array('success'=> 0, 'error'=> ''); 
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this -> M_SetCores -> _set_delete_cores($this -> URI-> _get_array_post('text_cmp_id') )) {
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
		if( $this -> M_SetCores -> _set_update_cores(
			array(
			  'CampaignGroupCode' => $this -> URI -> _get_post('CampaignGroupCode'),
			  'CampaignGroupName' => $this -> URI -> _get_post('CampaignGroupName'),
			  'CampaignGroupStatusFlag' => $this -> URI -> _get_post('CampaignGroupStatusFlag')
			), 
			$this -> URI -> _get_post('CampaignGroupId')  
		)){
			
			$_success = array('success'=> 1, 'error'=> 'OK');	
		}
	}
	
	echo json_encode($_success);
 }

}