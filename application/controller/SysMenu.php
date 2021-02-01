<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SysMenu extends EUI_Controller
{

// @ constructor 

 function __construct()
 {
	parent::__construct();
	if( ( !class_exists('M_SysMenu') ) && ( !class_exists('M_SysUser') ) ) {
		$this -> load -> model('M_SysMenu');
		$this -> load -> model('M_SysUser');
	}
 }
 
// @ default of controller sysmenu 
 
 function index()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> M_SysMenu -> _get_default();
		$_EUI['User'] = $this -> M_SysUser -> _get_handling_type();
		if( is_array($_EUI) ) 
		{
			$this -> load -> view('sys_menu/view_menu_nav',$_EUI);
		}	
	}
 }
 
// @ content of page by query 
 
 function Content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> M_SysMenu -> _get_resource();    // load content data by pages 
		$_EUI['num']  = $this -> M_SysMenu -> _get_page_number(); // load content data by pages 
		
		// sent to view data 
		
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('sys_menu/view_menu_list',$_EUI);
		}	
	}	
 }
 
// @ show_menu
 function showMenu()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['menu'] = $this -> M_SysMenu -> _get_show_menu( $this -> URI -> _get_post('GroupId') );
		if( is_array( $_EUI['menu'] )) 
		{
			$this -> load -> view('sys_menu/view_show_menu',$_EUI);
		}	
	}	
 } 
  
  
/* 
 * @ def : get Menu Json this like by jquery  OR ext.js
 * -------------------------------------------------------------
 * @ param via url akses 
 */

public function _getMenuJSON()
{
	$ApplicationMenu = base_menu_model();
	if(is_array($ApplicationMenu))
	{
		echo json_encode($ApplicationMenu); 
	}	
}

  
//@ addMenuTpl
function addMenuTpl()
{
   if( $this -> EUI_Session -> _have_get_session('UserId') )
   {
		$_EUI['group'] = $this -> M_SysMenu -> _get_group_menu();
		$_EUI['drive'] = $this -> EUI_Tools -> _ls_get_dir(array('controller'), false);	
	   if( $_EUI )
	  {
		$this -> load -> view('sys_menu/view_add_menu', $_EUI);
	  }	
   }	
}  

// @ setGroupMenu 

function setGroupMenu()
{
  
  if( $this -> EUI_Session -> _have_get_session('UserId') )
  {
	$_EUI['group'] = $this -> M_SysMenu -> _get_group_menu();	
	$_EUI['menuid'] =& $this -> URI -> _get_post('menuid');
	
	if( $_EUI )
	{
		$this -> load -> view('sys_menu/view_selgroup_menu', $_EUI);
	}	
  }	
}

// @ UpdateSelGroup 

function UpdateSelGroup()
{
  if( $this -> EUI_Session -> _have_get_session('UserId') )
  {
	if( class_exists('M_SysMenu')!=FALSE )
	{
		echo $this->M_SysMenu->_set_update_group( $this->URI->_get_post('menu'), $this->URI->_get_post('group') );	
	}	
  }
}

// @ menu_edit_tpl

function EditMenuTpl()
{
  if( $this -> EUI_Session -> _have_get_session('UserId') )
  {
	$EUI['menu']= $this -> M_SysMenu -> _get_menu_detail($this -> URI -> _get_post('menu_id'));
	$EUI['group'] = $this -> M_SysMenu -> _get_group_menu();
	$EUI['drive'] = $this -> EUI_Tools -> _ls_get_dir(array('controller'), false);
	$this -> load -> view('sys_menu/view_edit_menu', $EUI);
  }
}

// @ AssignMenu

function AssignMenu()
{
	$success = array('success'=> 0, 'error'=> 'NO');
	$_conds = $this -> M_SysMenu -> _set_assign_menu
				( 
					$this -> URI -> _get_array_post('menuid'), 
					$this -> URI -> _get_array_post('assignto')
				);
	
	if( $_conds ) 
	{
		$success = array('success'=> 1, 'error'=> 'OK');
	}		

	echo json_encode( $success );	

}

//@ remove menu 

function RemoveMenu()
{
	$success = array('success'=> 0, 'error'=> 'NO');
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this -> M_SysMenu -> _set_remove_menu() )
		{
			$success = array('success'=> 1, 'error'=> 'OK');	
		}
	}
	
	echo json_encode($success);
}

// @ DisabledMenu 
function DisabledMenu()
{
	$success = array('success'=> 0, 'error'=> 'NO');
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
	  // @ sent parameters 	
		if( $this -> M_SysMenu -> _set_disable_menu(0, $this -> URI->_get_array_post('menuid'))) 
		{
			$success = array('success'=> 1, 'error'=> 'OK');	
		}
	}
	
	echo json_encode($success);
}

// @ EnabledMenu
function EnabledMenu()
{
	$success = array('success'=> 0, 'error'=> 'NO');
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
	  // @ sent parameters 	
		if( $this -> M_SysMenu -> _set_disable_menu(1, $this -> URI->_get_array_post('menuid'))) 
		{
			$success = array('success'=> 1, 'error'=> 'OK');	
		}
	}
	
	echo json_encode($success);
 }
 
// add menu

function add_menu()
{
	$_conds = array('success' => 0);
	if( $this -> URI->_get_have_post('file_name'))
	{
		$_data = $this -> URI->_get_all_request();
		if( is_array($_data) )
		{
			if( $this -> M_SysMenu -> _setSaveNewMenu($_data) ){
				$_conds = array('success' => 1);
			}
		}
	}
	
	echo json_encode($_conds);
	
}

// update_menu

function update_menu()
{
	$_conds  = array('success'=>0);
	
	if( $this ->URI->_get_have_post('id')) 
	{
		$post = $this -> URI->_get_all_request();
		if( is_array($post))
		{
			if( $this -> M_SysMenu ->_setUpdateMenu($post))
			{
				$_conds  = array('success'=>1);	
			}
		}
	}
	
	echo json_encode($_conds);
}
 
// @ DeleteMenu 

 function DeleteMenu()
 {
	$success = array('success'=> 0, 'error'=> 'NO');
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		// @ sent parameters 	
		if( $this -> M_SysMenu -> _set_deleted_menu($this -> URI->_get_array_post('menuid'))) 
		{
			$success = array('success'=> 1, 'error'=> 'OK');	
		}
	}
	
	echo json_encode($success);
  }
}

// END OF FILE 
// LOCATION : ./application/controller/sysmenu.php

?>