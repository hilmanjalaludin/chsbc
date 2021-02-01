<?php
class Configuration extends EUI_Controller
{

// aksesor 

function Configuration()
{
	parent::__construct();
	$this -> load-> model(array(base_class_model($this)));
}



/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function index()
 {
	if( $this ->EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> {base_class_model($this)} -> _get_default();
		if( is_array($_EUI) ) 
		{
			$this -> load -> view('mod_configuration/view_configuration_nav',$_EUI);
		}	
	}	
 }
 
/*
 * @ def 		: content / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function Content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> {base_class_model($this)} -> _get_resource();    // load content data by pages 
		$_EUI['num']  = $this -> {base_class_model($this)} -> _get_page_number(); // load content data by pages 
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('mod_configuration/view_configuration_list',$_EUI);
		}	
	}	
 }
 
// Delete
function Delete()
{
	$_conds = array('success'=>0);
	
	if( $this -> EUI_Session -> _have_get_session('UserId') ) {
		$result = $this -> {base_class_model($this)} ->_setDeleteConfig( $this -> URI->_get_array_post('ConfigID') );
		if( $result )
		{
			$_conds = array('success'=>1);	
		}
	}
	
	echo json_encode($_conds);
}

// UpdateConfig 

 function UpdateConfig()
 {
	$_conds = array('success'=>0);
	
	if( $this -> EUI_Session -> _have_get_session('UserId') ) {
		$result = $this -> {base_class_model($this)} ->_setUpdateConfig( $this -> URI->_get_all_request() );
		if( $result )
		{
			$_conds = array('success'=>1);	
		}
	}
	
	echo json_encode($_conds);
 }
 
// SaveConfig 
 function SaveConfig()
 {
	$_conds = array('success'=>0);
	
	if( $this -> EUI_Session -> _have_get_session('UserId') ) {
		$result = $this -> {base_class_model($this)} ->_setSaveConfig( $this -> URI->_get_all_request() );
		if( $result )
		{
			$_conds = array('success'=>1);	
		}
	}
	
	echo json_encode($_conds);
 }
 
// EditView

function EditView()
{
	if( $this -> EUI_Session -> _have_get_session('UserId') ) {
		$UI = array(
			'rows' => $this -> {base_class_model($this)} ->_getConfiguration($this -> URI->_get_post('ConfigID')),
			'space' => $this -> {base_class_model($this)} ->_getNameSpace()
		);
		$this -> load -> view('mod_configuration/view_configuration_edit',$UI);
	}
} 
 
// AddView
 
 function AddView()
 {	
	if( $this -> EUI_Session -> _have_get_session('UserId') ) {
		$UI = array('space' => $this -> {base_class_model($this)} ->_getNameSpace());
		
		$this -> load -> view('mod_configuration/view_configuration_add',$UI);
	}
 }

 
}


?>