<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SysUser extends EUI_Controller{

/*
 * load __construct
 */
 
function __construct()
{
	parent::__construct();
	$this->load->model(array('M_SysUser')); // load model user
	$this->load->helper(array('EUI_Object'));
}
/*
 * load first page load of the nav data 
 */
 
function index() 
{
	if( $this -> EUI_Session -> _have_get_session('UserId')) 
	{
		$page['page'] = $this -> M_SysUser -> get_default();
		$this -> load -> view("sys_user/view_user_nav", $page);
	}
}


/*
 * load first page load of the nav data 
 * @ content of page 
 */
 
function content()
{
	$page['page'] = $this -> M_SysUser -> get_resource_query(); // load content data by pages 
	$page['num']  = $this -> M_SysUser -> get_page_number(); 	// load content data by pages 
	if( is_array($page) && is_object($page['page']) ) 
	{
		$this -> load -> view("sys_user/view_user_list", $page );
	}	
}

/*
 * reset password user 
 * @ return procedure 
 */
 
function reset_password()
{
	$_success = array('success'=> 0);
	$UserId = $this -> URI -> _get_array_post('UserId');
	if( is_array( $UserId ) )
	{
		if( $this -> M_SysUser -> _reset_user_password( $UserId ) ) {
			$_success = array('success'=> 1);	
		}
	}
	
	echo json_encode($_success);
} 
/*
 * reset IP user 
 */
 
function reset_ip()
{
	$_success = array('success'=> 0);
	$UserId = $this -> URI -> _get_array_post('UserId');
	if( is_array( $UserId ) )
	{
		if( $this -> M_SysUser -> _reset_user_location( $UserId ) ) {
			$_success = array('success'=> 1);	
		}
	}
	echo json_encode($_success);
}

// disable_user 

function disable_user()
{
	$_success = array('success'=> 0);
	$UserId = $this -> URI -> _get_array_post('UserId');
	if( is_array( $UserId ) )
	{
		if( $this -> M_SysUser -> _disable_user( $UserId ) ) {
			$_success = array('success'=> 1);	
		}
	}
	echo json_encode($_success);
}

// enable_user 

function enable_user()
{
	$_success = array('success'=> 0);
	$UserId = $this -> URI -> _get_array_post('UserId');
	if( is_array( $UserId ) )
	{
		if( $this -> M_SysUser -> _enable_user( $UserId ) ) {
			$_success = array('success'=> 1);	
		}
	}
	echo json_encode($_success);
}

// remove_user

function remove_user()
{
	$_success = array('success'=> 0,'error'=> '' );
	$UserId = $this -> URI -> _get_array_post('UserId');
	if( is_array( $UserId ) )
	{
		if( $this -> M_SysUser -> _remove_user( $UserId ) ) {
			$_success = array('success'=> 1);	
		}
		else{
			$_success = array('success'=> 0, 'error'=> mysql_error() );	
		}
	}
	
	echo json_encode($_success);
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 public function tpl_add_user()
{
	if(_get_session('UserId'))
 {	
	$Obj =& get_class_instance('M_SysUser');
	$this->load->view('sys_user/view_add_user', array(
		'User' => $Obj,
		'row' 	=> new EUI_Object(array()),
		'action' => form()->button('btnUpdate','button update', lang(array('Save')), array("click" => 'Ext.DOM.SaveUser();'))
	));
 }
 
}


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 

 public function tpl_edit_user()
{
	if(_get_session('UserId'))
 {
	$out =new EUI_Object(_get_all_request() );
	$Obj =& get_class_instance('M_SysUser');
	
// -------- sent to view -----------------------------------------
	$arr =$Obj->_get_detail_user( $out->get_value('UserId'));
	$this->load->view('sys_user/view_edit_user', array(
		'User' => $Obj,
		'row' 	=> new EUI_Object( $arr ),
		'action' => form()->button('btnUpdate','button update', lang(array('Update')), array("click" => 'Ext.DOM.Update();'))
	));
 }
 
}


// add set new user 

function add_user()
{
  $_success = array('success'=> 0,'error'=> '' );
	if(_have_get_session('UserId')) 
	{
		if( $this->M_SysUser->_set_add_user() )
		{
			$_success = array( 'success' => 1, 'error' => mysql_error() );
		}
	}
	
	echo json_encode($_success);
}

// update_user

function update_user()
{
	$_success = array('success'=> 0,'error'=> '' );
	
	#var_dump($this->M_SysUser->_set_update_user());die();
	if(_have_get_session('UserId')) 
	{
		#echo json_encode(array('a'=>$this->M_SysUser->_set_update_user())); die();
		if($this->M_SysUser->_set_update_user() )
		{
			$_success = array( 'success' => 1, 'error' => mysql_error() );
		}
	}
	echo json_encode($_success);
}

// register_pbx

function register_pbx()
{
	$_success = array('success'=> 0,'error'=> '' );	
	$_array_list = $this -> URI -> _get_array_post('UserId'); //	1,2,5,6,9,10,23,24,25,26,27,28,29,30,31,32,33,34,35 
	
	if( $this -> EUI_Session -> _have_get_session('UserId')) 
	{
		$_error = $this -> M_SysUser -> _set_register_user_pbx( $_array_list );
		if($_error)
		{
			$_success = array( 'success' => 1, 'error' => $_error );
		}
		else{
			$_success = array( 'success' => 0, 'error' => $_error );
		}
	}
	
	echo json_encode($_success);
}

// User UserCapacity

function UserCapacity()
{
	$_result = array('success'=>0);
	
	$Configuration =& M_Configuration::get_instance();
	$Capacity = $this -> M_SysUser -> _getUserCapacity(1);
	$UserLimit = $Configuration -> _getUserLimit();
	
	
	 
	if( is_array($UserLimit))
	{
		$CapacityCount = (((INT)$UserLimit['USER_LIMIT'])+1);
		
		if( $this -> EUI_Session->_get_session('HandlingType')!=USER_ROOT )
		{
			if( $Capacity < $CapacityCount )
			{
				$_result = array('success'=>1);
			}
		}
		else{
			$_result = array('success'=>1);
		}	
	}
	
	echo json_encode($_result);
}


// ----------------------------------------------------------------------
/* 
 * @ pack 		User Registration Detail ----------- 
 */
 function UserDetail() 
{
	if(_get_session('UserId'))
  {
	$out =new EUI_Object(_get_all_request() );
	$Obj =& get_class_instance('M_SysUser');
	
// -------- sent to view -----------------------------------------
	$arr =& $Obj->_get_detail_user( $out->get_value('UserId'));
	$this->load->view('sys_user/view_edit_detail', array(
		'User' => $Obj,
		'row' 	=> new EUI_Object( $arr ),
		'action' => null
	));
  }
}

// ----------------------------------------------------------------------
/* 
 * @ pack 		User Registration Detail ----------- 
 */
 function UserPassword() 
{
	if(_get_session('UserId'))
  {
	$out =new EUI_Object(_get_all_request() );
	$Obj =& get_class_instance('M_SysUser');
	
// -------- sent to view -----------------------------------------
	$arr =& $Obj->_get_detail_user( $out->get_value('UserId'));
	$this->load->view('sys_user/view_edit_password', array(
		'User' => $Obj,
		'row' 	=> new EUI_Object( $arr ),
		'action' => form()->button('btnUpdatePwd','button lock', lang(array('Update')), array("click" => 'Ext.DOM.UpdatePassword();'))
	));
  }
}

// ----------------------------------------------------------------------
/* 
 * @ pack 		User Registration Detail ----------- 
 */
 
 public function ChangePassword()
{
	$cond = array('success' => 0);
	
   if(_get_session('UserId')) 
  {
		$objClass =& get_class_instance('M_User');
		$conds = $objClass->_set_user_change_password( new EUI_Object( _get_all_request() ) );
		if(  $conds ) {
			$cond = array('success' => 1);
		}	
   }	
   echo json_encode($cond);
}

// ================================== END  CLASS ================================

}

// END OF FILE 
// location : ./application/controller/SysUser.php
?>