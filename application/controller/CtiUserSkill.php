<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class CtiUserSkill extends EUI_Controller
{


 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function CtiUserSkill()
 {
	parent::__construct();
	$this -> load -> model(array(base_class_model($this), 'M_SysUser'));
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
			$this -> load -> view('cti_skill/view_cti_skill_nav',$_EUI);
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
		
		// sent to view data 
		
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('cti_skill/view_cti_skill_list',$_EUI);
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
 
 function ViewAgentSkill()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$UI = array
		(
			'UserSkill' => $this ->{base_class_model($this)}->_getUserSkill(),
			'UserJoin' => $this -> M_SysUser -> _getJoinUser()
		);
		
		$this -> load -> view('cti_skill/view_cti_agent_skill', $UI );
	}
 }
 
 /*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function SaveUserSkill()
 {
	$_conds = array('success'=>0);
	
	if( $this -> EUI_Session -> _have_get_session('UserId') ) {
		if( $this -> {base_class_model($this)}->_setSaveUserSkill( $this ->URI-> _get_all_request() ))
		{
			$_conds = array('success'=>1);
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
  
 function EditAgentSkill()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$UI = array
		(
			'UserSkill' => $this ->{base_class_model($this)}->_getUserSkill(),
			'Data' => $this ->{base_class_model($this)}->_getUserSkillData( $this -> URI->_get_post('SkillId') ),
			'UserJoin' => $this -> M_SysUser -> _getJoinUser()
		);
		
		$this -> load -> view('cti_skill/view_cti_agent_edit', $UI );
	}
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
 function UpdateUserSkill()
 {
	$_conds = array('success'=>0);
	if( $this -> EUI_Session -> _have_get_session('UserId') ) {
		if( $this -> {base_class_model($this)}->_setUpdateUserSkill( $this ->URI-> _get_all_request() ))
		{
			$_conds = array('success'=>1);
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
  
 function DeleteUserSkill()
 {
	$_conds = array('success'=>0);
	if( $this -> EUI_Session -> _have_get_session('UserId') ) {
		if( $this -> {base_class_model($this)}->_setDeleteUserSkill( $this ->URI-> _get_array_post('id')))
		{
			$_conds = array('success'=>1);
		}
	}
	echo json_encode($_conds);	
 }
 
 
}
?>