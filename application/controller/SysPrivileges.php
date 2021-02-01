<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SysPrivileges extends EUI_Controller{

/*
 * load __construct
 */
 
function __construct()
{
	parent::__construct();
	$this -> load -> model(array(base_class_model($this))); // load model user
}
/*
 * load first page load of the nav data 
 */
 
function index() 
{
	if( $this -> EUI_Session -> _have_get_session('UserId')) 
	{
		$page['page'] = $this -> {base_class_model($this)} -> get_default();
		$this -> load -> view("sys_user_privileges/view_privileges_nav", $page);
	}
}


/*
 * load first page load of the nav data 
 * @ content of page 
 */
 
function content()
{
	$page['page'] = $this -> {base_class_model($this)} -> get_resource_query(); // load content data by pages 
	$page['num']  = $this -> {base_class_model($this)} -> get_page_number(); 	// load content data by pages 
	if( is_array($page) && is_object($page['page']) ) 
	{
		$this -> load -> view("sys_user_privileges/view_privileges_list", $page );
	}	
}

/* 
 * @ def DeletePrivileges
 * -----------------------------------
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */

function DeletePrivileges()
{
	$_success = array('success'=> 0);
	$PrivilegeId = $this -> URI -> _get_array_post('PrivilegeId');
	if( is_array( $PrivilegeId ) )
	{
		if( $this -> {base_class_model($this)} -> _setDeletePrivileges( $PrivilegeId ) ) {
			$_success = array('success'=> 1);	
		}
		else{
			$_success = array('success'=> 0);	
		}
	}
	
	echo json_encode($_success);
}

/* 
 * @ def AddPrivileges
 * -----------------------------------
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */


function AddPrivileges()
{
	if( $this -> EUI_Session -> _get_session('UserId'))
	{
		$this -> load -> view('sys_user_privileges/view_add_privileges');
	}
}

/* 
 * @ def EditPrivileges
 * -----------------------------------
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */
function EditPrivileges()
{
	$UI = array();
	
	if( $this -> EUI_Session -> _get_session('UserId')) {
		$UI['Data'] = $this -> {base_class_model($this)} -> _getPrivilegesData($this -> URI -> _get_post('PrivilegeId'));
		$this -> load -> view('sys_user_privileges/view_edit_privileges', $UI);
	}
}


/* 
 * @ def SavePrivileges
 * -----------------------------------
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */
function SavePrivileges()
{
	$_success = array('success'=> 0 );
	if( $this -> EUI_Session -> _have_get_session('UserId')) 
	{
		$_data = $this -> URI -> _get_all_request();
		
		if(  $this -> {base_class_model($this)} -> _setSavePrivileges($_data) )
		{
			$_success = array( 'success' => 1);
		}
	}
	
	echo json_encode($_success);
}

// update_user

function UpdatePrivileges()
{
	$_success = array('success'=> 0,'error'=> '' );
	if( $this -> EUI_Session -> _have_get_session('UserId')) 
	{
		$_data = $this -> URI -> _get_all_request();
		if(  $this -> {base_class_model($this)} -> _setUpdatePrivileges($_data) )
		{
			$_success = array( 'success' => 1, 'error' => mysql_error() );
		}
	}
	
	echo json_encode($_success);
}

}

// END OF FILE 
// location : ./application/controller/SysUser.php
?>