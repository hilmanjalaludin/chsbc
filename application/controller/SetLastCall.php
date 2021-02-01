<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SetLastCall extends EUI_Controller
{


 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function SetLastCall()
 {
	parent::__construct();
	$this -> load -> model( array(base_class_model($this)) );
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
		$_EUI['page'] = $this -> M_SetLastCall -> _get_default();
		if( is_array($_EUI) ) 
		{
			$this -> load -> view('set_last_call/view_last_call_nav',$_EUI);
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
		$_EUI['page'] = $this -> M_SetLastCall -> _get_resource();    // load content data by pages 
		$_EUI['num']  = $this -> M_SetLastCall -> _get_page_number(); // load content data by pages 
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('set_last_call/view_last_call_list',$_EUI);
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
			array
			( 
				'LastCallId' => $this -> URI -> _get_array_post('LastCallId'),
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
		$this -> load -> view('set_last_call/view_last_call_add',$_EUI);
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
		$UI = array('Data' => $this->{base_class_model($this)}->_getDataWorkTime( $this->URI->_get_post('LastCallId')));
		$this -> load -> view('set_last_call/view_last_call_edit',$UI);
	}
 }
 
 
 
  
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function UpdateWorkTime()
 {
	$_conds = array('success' => 0 );
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this->{base_class_model($this)}->_setUpdateWorkTime( $this->URI->_get_all_request())) 
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
 
 function SaveWorkTime()
 {
	$_conds = array('success' => 0 );
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this->{base_class_model($this)}->_setSaveWorkTime( $this->URI->_get_all_request())) 
		{	
			$_conds = array('success' =>1);	
		}	
		
	}
	
	echo json_encode($_conds);
 }
 
}
?>