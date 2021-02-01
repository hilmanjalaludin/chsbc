<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SetResultQuality extends EUI_Controller
{


 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function SetResultQuality()
 {
	parent::__construct();
	$this -> load -> model(array(base_class_model($this),'M_SetCallResult','M_SysUser') );
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
			$this -> load -> view('set_result_quality/view_result_quality_nav',$_EUI);
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
			$this -> load -> view('set_result_quality/view_result_quality_list',$_EUI);
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

 function SetActive()
 {
	$_conds = array('success' => 0 );
	
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this->{base_class_model($this)}->_setActive(
			array( 
				'QualityResultId' => $this -> URI -> _get_array_post('QualityResultId'),
				'Active' => $this -> URI -> _get_post('Active') 
			)
		)) 
		{	
			$_conds = array('success' =>1);	
		}	
		
	}
	
	echo json_encode($_conds);
 }
 
/*
 * @ def 		: index / Delete
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function Delete()
{
	$_conds = array('success' => 0 );
	
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this->{base_class_model($this)}->_setDeleteQualityResult( $this->URI->_get_array_post('QualityResultId'))) 
		{	
			$_conds = array('success' =>1);	
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
 
 function AddView()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$UI = array(
			'Event' => $this->M_SetCallResult->_getBoolean(),
			'UserLevel' => $this->M_SysUser->_get_handling_type()
		);
		$this -> load -> view('set_result_quality/view_result_quality_add',$UI);
	}	
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function EditView()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') ) 
	{
		$UI = array(
			'Data' => $this->{base_class_model($this)}->_getQualityData($this->URI->_get_post('QualityId')),
			'Event' => $this->M_SetCallResult->_getBoolean(),
			'UserLevel' => $this->M_SysUser->_get_handling_type()
		);
		
		$this -> load -> view('set_result_quality/view_result_quality_edit',$UI);
	}	
 } 
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
 function SaveQualityResult()
 {
	$_conds = array('success' => 0 );
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this->{base_class_model($this)}->_setSaveQualityResult( $this->URI->_get_all_request())) 
		{	
			$_conds = array('success' =>1);	
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
  
 
 function UpdateQualityResult()
 {
	$_conds = array('success' => 0 );
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this->{base_class_model($this)}->_setUpdateQualityResult( $this->URI->_get_all_request())) 
		{	
			$_conds = array('success' =>1);	
		}	
		
	}
	
	echo json_encode($_conds);
 }


}
?>