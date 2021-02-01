<?php
class CtiSkill extends EUI_Controller
{


function CtiSkill() {
	parent::__construct();
	$this -> load -> model(array(base_class_model($this)));
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
		if( is_array($_EUI))
		{
			$this -> load -> view('cti_view_skill/view_skill_nav',$_EUI);
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
 
function content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> {base_class_model($this)}-> _get_resource();    // load content data by pages 
		$_EUI['num']  = $this -> {base_class_model($this)}-> _get_page_number(); // load content data by pages 
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('cti_view_skill/view_skill_list',$_EUI);
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
 function Add()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$this -> load -> view('cti_view_skill/view_skill_add',array('FieldName' =>  $this -> {base_class_model($this)}-> _getFieldName()));
	}
 }
 
 
/*
 * @ def 		: content / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function Delete()
 {
	$conds = array('success' => 0);
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this -> {base_class_model($this)}->_setDelete( $this -> URI->_get_array_post('Id') ))
		{
			$conds = array('success' => 1);
		}
	}
	
	echo json_encode($conds);
 }
 
 /*
 * @ def 		: content / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function Edit()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') ) 
	{
		$UI = array(
				'Reason' => $this -> {base_class_model($this)}->_getData($this -> URI->_get_post('Id')), 
				'FieldName' =>  $this -> {base_class_model($this)}-> _getFieldName()
			);
		
		$this -> load -> view('cti_view_skill/view_skill_edit',$UI);
	}
	
 }
 
  
/*
 * @ def 		: content / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function Save()
 {
	$conds = array('success' => 0);
	
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this -> {base_class_model($this)}->_setSave( $this -> URI->_get_all_request() ))
		{
			$conds = array('success' => 1);
		}
	}
	
	echo json_encode($conds);
 }
  
/*
 * @ def 		: content / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function Update()
 {
	$conds = array('success' => 0);
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this -> {base_class_model($this)}->_setUpdate( $this -> URI->_get_all_request() ))
		{
			$conds = array('success' => 1);
		}
	}
	
	echo json_encode($conds);
 }
 
}

?>