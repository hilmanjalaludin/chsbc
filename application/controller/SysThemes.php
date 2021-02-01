<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SysThemes extends EUI_Controller
{

// @ constructor

 function __construct()
 {
	parent::__construct();
	$this ->load->model('M_SysThemes');
	$this ->load->model('M_Website');
	
 }

// @ index pages 
 
 function index()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		
		$EUI['active'] = $this-> M_Website->_web_themes();
		$EUI['layout'] = $this->{base_class_model($this)}->_getLayout();
		$EUI['themes'] = $this->{base_class_model($this)}->_get_default();
		
		if( is_array($EUI))
		{
			$this -> load -> view('sys_themes/view_themes_nav', $EUI);
		}	
	}
 }
 
 // @ SaveThemes
 
 function SaveThemes()
 {
	$success = array('success'=> 0, 'error'=> '' );
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this -> M_SysThemes -> _set_save_webthemes( $this -> uri -> _get_post('themes_value')) )
		{
			$success = array('success'=>1, 'error'=> base_url() );
		}
	}
	
	echo json_encode($success);
 }
 
 // SaveActive
 
 function SaveActive()
 {
	$_conds = array('success'=>0);
	if( $this -> EUI_Session->_get_session('UserId'))
	{
		$LayoutId = $this -> URI-> _get_array_post('LayoutId');
		$Active = $this -> URI-> _get_post('Active');
		if( $this ->{base_class_model($this)}->_setActive($LayoutId, $Active))
		{
			$_conds = array('success'=>1);
		}	
	}
	
	echo json_encode($_conds);
 }
 
 // Delete
 
 function Delete(){
	$_conds = array('success'=>0);
	if( $this -> EUI_Session->_get_session('UserId'))
	{
		$LayoutId = $this -> URI-> _get_array_post('LayoutId');
		if( $this ->{base_class_model($this)}->_setDelete($LayoutId))
		{
			$_conds = array('success'=>1);
		}	
	}
	
	echo json_encode($_conds);
 }
 
 // function AddLayout
 
 function AddLayout(){
	if( $this -> EUI_Session->_get_session('UserId'))
	{
		$this -> load -> view("sys_themes/view_add_layout");
	}
 }
 
 
// EditLayout
 
  function EditLayout(){
	if( $this -> EUI_Session->_get_session('UserId'))
	{	
		$LayoutId = $this->URI->_get_post('LayoutId');
		$LayoutData = $this ->{base_class_model($this)}->_getLayout();
		
		$UI = array('Layout' => $LayoutData[$LayoutId],'LayoutId'=> $LayoutId );
		
		$this -> load -> view("sys_themes/view_edit_layout",$UI);
	}
 }
 
 // SaveLayout
 
 function SaveLayout()
 {
	$_conds = array('success'=>0);
	
	$SaveLayout = $this -> URI -> _get_all_request();
	if( is_array($SaveLayout))
	{
		$SaveLayout['Images'] = $SaveLayout['Name'].'.png';
		
		if( $this ->{base_class_model($this)}->_setSaveLayout($SaveLayout))
		{
			$_conds = array('success'=>1);
		}	
	}
	
	echo json_encode($_conds);
 }
 
 
 // UpdateLayout 
 function UpdateLayout()
 {
	$_conds = array('success'=>0);
	
	$UpdateLayout = $this -> URI -> _get_all_request();
	if( is_array($UpdateLayout))
	{
		if( $this ->{base_class_model($this)}->_setUpdateLayout($UpdateLayout)) 
		{
			$_conds = array('success'=>1);
		}	
	}
	
	echo json_encode($_conds);
 }
 
	
}