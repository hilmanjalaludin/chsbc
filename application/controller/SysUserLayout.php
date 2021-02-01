<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SysUserLayout extends EUI_Controller
{

 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function __construct()
 {
	parent::__construct();
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object'));
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
			$this -> load -> view('sys_user_layout/view_userlayout_nav',$_EUI);
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
		$_EUI['page'] = $this->{base_class_model($this)}->_get_resource();    // load content data by pages 
		$_EUI['num']  = $this->{base_class_model($this)}->_get_page_number(); // load content data by pages 
		
		// sent to view data 
		
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('sys_user_layout/view_userlayout_list',$_EUI);
		}	
	}	
 }


/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function AddUserLayout()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$this -> load -> view('sys_user_layout/view_userlayout_add',
			array
			(
				'UserThemes' => $this -> M_SysThemes ->_getUserThemes(),
				'UserLayout' => $this -> M_SysThemes ->_getUserLayout(),
				'UserGroup'	 => $this -> M_SysUser ->_get_handling_type()
			)
		);
	}
 }
 
 /*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function SaveLayout(){
	
	$_conds = array('success' => 0);
	
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this->{base_class_model($this)}->_setSaveLayout(array(
			'GroupId' 		 => $this->URI->_get_post('UserGroup'),
			'LayoutId' 		 => $this->URI->_get_post('UserLayout'),
			'Themes' 		 => $this->URI->_get_post('UserThemes'),
			'CreateByUserId' => $this->EUI_Session->_get_session('UserId'),
			'CreatedDateTs'  => date('Y-m-d H:i:s'),
			'Flags' 		 => 1
		 )))
		{
			$_conds = array('success' => 1);
		}
	}
	
	echo json_encode($_conds);
	
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 function EditUserLayout()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$data = array
		(
			'LayoutData' => $this->{base_class_model($this)}->_getLayout( $this -> URI -> _get_post('LayoutId') ),
			'UserThemes' => $this->M_SysThemes->_getUserThemes(),
			'UserLayout' => $this->M_SysThemes->_getUserLayout(),
			'UserGroup'	 => $this->M_SysUser->_get_handling_type()	
		);
		
		$this -> load -> view('sys_user_layout/view_userlayout_edit',$data);
	}	
 } 
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function UpdateLayout()
{
	
	$_conds = array('success' => 0);
	
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this->{base_class_model($this)}->_setUpdateLayout(array(
			'GroupId' => $this->URI->_get_post('UserGroup'),
			'LayoutId' => $this->URI->_get_post('UserLayout'),
			'Themes' => $this->URI->_get_post('UserThemes'),
			'Id' => $this->URI->_get_post('LayoutId')
		 )))
		{
			$_conds = array('success' => 1);
		}
	}
	
	echo json_encode($_conds);

}
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 function SetLayout()
 {
	$_conds = array('success' => 0);
	
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this->{base_class_model($this)}->_setLayout(array(
			'SetLayout' => $this->URI->_get_post('SetLayout'),
			'LayoutId' => $this->URI->_get_array_post('LayoutId'),
		))){
			$_conds = array('success' => 1);
		}	
	}		
	
	echo json_encode($_conds);
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 function DeleteLayout()
 {
	$_conds = array('success' => 0);
	if(_have_get_session('UserId') )
	{
		if( $this->{base_class_model($this)}->_setDeleteLayout( _get_array_post('LayoutId')) ) 
		{
			$_conds = array('success' => 1);
		}	
	}		
	
	
	echo json_encode($_conds);
 }
   

 
 // ================ END CLASS ======================
 
 
}
?>
