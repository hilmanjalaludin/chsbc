<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SysMenuGroup extends EUI_Controller
{

/*
 * @ constructor 
 */
 
 function __construct()
 {
	parent::__construct();
	
	if( !class_exists('M_SysMenuGroup') && !class_exists('M_SysUser') )
	{
		$this -> load -> model('M_SysMenuGroup');
		$this -> load -> model('M_SysUser');
	}	
 }
 
 //* @ index 
 function index()
 {
	if( $this -> EUI_Session->_have_get_session('UserId') )
	{
		$_EUI['privileges'] = $this->M_SysUser->_get_handling_type();
		$_EUI['menugroup']  = $this->M_SysMenuGroup->_get_menu_group();
		$_EUI['page'] 		= $this->M_SysMenuGroup->_get_default();
		
		if( count($_EUI) > 0 )
		{
			$this -> load -> view('sys_group/view_gmenu_nav', $_EUI);
		}	
	}
 }
 
 // @ content
 
 function content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> M_SysMenuGroup -> _get_resource();    // load content data by pages 
		$_EUI['num']  = $this -> M_SysMenuGroup -> _get_page_number(); // load content data by pages 
		
		// sent to view data 
		
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('sys_group/view_gmenu_list',$_EUI);
		}	
	}	
 }
 
 //@ ShowMenuGroup
 
 function ShowMenuGroup()
 {
	if( $this -> EUI_Session->_have_get_session('UserId') )
	{
		$EUI['ListGroupMenu'] = $this -> M_SysMenuGroup -> _get_list_group_menu( $this -> URI -> _get_post('privileges') ); 
		$this -> load -> view('sys_group/view_gmenu_show.php', $EUI );
	}
 }
 
 // @ RemoveMenuGroup 
 
 function RemoveMenuGroup()
 {
	$success = array('success'=> 0, 'error'=> 'NO');
	if( $this -> EUI_Session->_have_get_session('UserId') )
	{
		if( $this -> M_SysMenuGroup -> _set_remove_group_menu(
			$this ->URI-> _get_post('Privileges'),
			$this ->URI-> _get_array_post('GroupMenu')
		) ){
			$success = array('success'=> 1, 'error'=> 'NO');
		}
	}
	
	echo json_encode($success);
 }
 
 // @ AssignMenuGroup
 
 function AssignMenuGroup()
 {
	$success = array('success'=> 0, 'error'=> 'NO');
	if( $this -> EUI_Session->_have_get_session('UserId') )
	{
		if( $this -> M_SysMenuGroup -> _set_assign_group_menu(
			$this ->URI-> _get_post('Privileges'),
			$this ->URI-> _get_array_post('GroupMenu')
		) ){
			$success = array('success'=> 1, 'error'=> 'NO');
		}
	}
	
	echo json_encode($success);
 }
 
 // @ ShowForm
 
 function ShowForm()
 {
	if( $this -> EUI_Session->_have_get_session('UserId') ) 
	{
		$this -> load -> view('sys_group/view_gmenu_add.php');
	}
 }
 
 // EditForm
 
 function EditForm()
 {
	if( $this -> EUI_Session->_have_get_session('UserId') ) 
	{
		$datas = array('GroupMenu' => $this ->M_SysMenuGroup->_getGroupMenu($this -> URI->_get_post('GroupId')) );
		$this -> load -> view('sys_group/view_gmenu_edit',$datas);
	}
 }
 
 // SaveNewGroup
 
 function SaveNewGroup()
 {
	$_conds = array('success'=>0);
	if( $this -> EUI_Session->_have_get_session('UserId') ) 
	{
		$post_data = $this -> URI -> _get_all_request();
		if( is_array($post_data))
		{
			$post_data['GroupShow'] = 1;
			$post_data['CreateDate'] = date('Y-m-d H:i:s');
			$post_data['UserCreate'] = $this -> EUI_Session->_get_session('Username');
			
			if( $this ->M_SysMenuGroup->_setSaveNewGroup($post_data) )
			{
				$_conds = array('success'=>1);
			}	
		}
	}
	
	echo json_encode($_conds);
	
	
 }
 
 // SaveNewGroup
 
 function UpdateGroup()
 {
	$_conds = array('success'=>0);
	if( $this -> EUI_Session->_have_get_session('UserId') ) 
	{
		$post_data = $this -> URI -> _get_all_request();
		if( is_array($post_data))
		{
			$post_data['GroupShow'] = 1;
			$post_data['CreateDate'] = date('Y-m-d H:i:s');
			$post_data['UserCreate'] = $this -> EUI_Session->_get_session('Username');
			
			if( $this ->M_SysMenuGroup->_setUpdateNewGroup($post_data) )
			{
				$_conds = array('success'=>1);
			}	
		}
	}
	
	echo json_encode($_conds);
	
 }
 // @ save menu group 
 
 function SaveMenuGroup()
 {
	$success = array('success'=> 0, 'error'=> 'NO');
	if( $this -> EUI_Session->_have_get_session('UserId') ) 
	{
		if( $this -> M_SysMenuGroup -> _set_save_group_menu(
			$this -> URI -> _get_post('groupname'),
			$this -> URI -> _get_post('groupdesc')
		)){
			$success = array('success'=> 1, 'error'=> 'YES');
		}
	}
	
	echo json_encode($success);
 }
 
// @ DeleteMenuGroup
function DeleteMenuGroup()
{
	$success = array('success'=> 0, 'error'=> 'NO');
	if( $this -> EUI_Session->_have_get_session('UserId') ) 
	{
		if( $this -> M_SysMenuGroup -> _set_delete_group_menu( $this ->URI->_get_array_post('MenuGroupId') ))
		{
			$success = array('success'=> 1, 'error'=> 'YES');
		}
	}
	
	echo json_encode($success);
}

// @ EnableGroup
function EnableGroup()
{
	$success = array('success'=> 0, 'error'=> 'NO');
	if( $this -> EUI_Session->_have_get_session('UserId') ) 
	{
		if( $this -> M_SysMenuGroup -> _set_active_group_menu( $this ->URI->_get_array_post('MenuGroupId'),1) )
		{
			$success = array('success'=> 1, 'error'=> 'YES');
		}
	}
	
	echo json_encode($success);
}

// @ DisableGroup 
function DisableGroup()
{
	$success = array('success'=> 0, 'error'=> 'NO');
	if( $this -> EUI_Session->_have_get_session('UserId') ) 
	{
		if( $this -> M_SysMenuGroup -> _set_active_group_menu( $this ->URI->_get_array_post('MenuGroupId'),0) )
		{
			$success = array('success'=> 1, 'error'=> 'YES');
		}
	}
	
	echo json_encode($success);
}


}
 
?>