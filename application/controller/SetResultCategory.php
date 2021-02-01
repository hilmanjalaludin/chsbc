<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SetResultCategory extends EUI_Controller
{
// ---------------------------------------------------------------------------------------------------
/*
 * @ package 		 __construct // constructor class 
 * @ return 	: void(0)
 */
 function SetResultCategory() 
{
	parent::__construct();
	$this->load->model(array( base_class_model($this) ));
	$this->load->helper(array('EUI_Object'));
	
 }
 
// ---------------------------------------------------------------------------------------------------
/*
 * @ package 		 __construct // constructor class 
 * @ return 	: void(0)
 */
 
 function index()
 {
	if( $this ->EUI_Session -> _have_get_session('UserId') ) {
		$_EUI['page'] = $this -> {base_class_model($this)} -> _get_default();
		if( is_array($_EUI) ) 
		{
			$this -> load -> view('set_result_category/view_result_category_nav',$_EUI);
		}	
	}	
 }
 
// ---------------------------------------------------------------------------------------------------
/*
 * @ package 		 __construct // constructor class 
 * @ return 	: void(0)
 */
function Content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> {base_class_model($this)}-> _get_resource();    // load content data by pages 
		$_EUI['num']  = $this -> {base_class_model($this)}-> _get_page_number(); // load content data by pages 
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('set_result_category/view_result_category_list',$_EUI);
		}	
	}	
 }
// ---------------------------------------------------------------------------------------------------
/*
 * @ package 		 __construct // constructor class 
 * @ return 	: void(0)
 */
function SetActive()
{
	$_conds = array('success' => 0 );
	
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this->{base_class_model($this)}->_setActive(
			array( 
				'CategoryId' => $this -> URI -> _get_array_post('CategoryId'),
				'Active' => $this -> URI -> _get_post('Active') 
			)
		)) 
		{	
			$_conds = array('success' =>1);	
		}	
		
	}
	
	echo json_encode($_conds);
}
 
// ---------------------------------------------------------------------------------------------------
/*
 * @ package 		 __construct // constructor class 
 * @ return 	: void(0)
 */
 function Delete()
 {	
	$_conds = array('success' => 0 );
	
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this -> {base_class_model($this)} -> _setDelete(
			$this->URI->_get_array_post('CategoryId')
		))
		{	
			$_conds = array('success' =>1);	
		}	
		
	}
	
	echo json_encode($_conds);
 }
 
// ---------------------------------------------------------------------------------------------------
/*
 * @ package 		 __construct // constructor class 
 * @ return 	: void(0)
 */
 
 function AddView()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		
		$UI = array(
			'CallType'=> $this -> {base_class_model($this)} -> _getOuboundGoals(),
			'OrderId' => $this -> {base_class_model($this)} -> _getOrder(20),
			'Interest' => $this -> {base_class_model($this)} -> _getCategoryInterest()
		);
		
		$this -> load ->view('set_result_category/view_result_category_add',$UI);
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
		$UI = array
		(
			'CallType'	=> $this -> {base_class_model($this)} -> _getOuboundGoals(),
			'OrderId' 	=> $this -> {base_class_model($this)} -> _getOrder(20),
			'Interest' 	=> $this -> {base_class_model($this)} -> _getCategoryInterest(),
			'Data' 		=> $this -> {base_class_model($this)} -> _getDataCategory($this->URI->_get_post('CategoryId'))
		);
		
		$this -> load ->view('set_result_category/view_result_category_edit',$UI);
	}
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function SaveCategory()
 {
	$_conds = array('success' => 0 );
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this->{base_class_model($this)}->_setSaveCategory( $this->URI->_get_all_request() ))
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
 
function UpdateCategory()
 {
	$_conds = array('success' => 0 );
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this->{base_class_model($this)}->_setUpdateCategory( $this->URI->_get_all_request() ))
		{	
			$_conds = array('success' =>1);	
		}	
		
	}
	
	echo json_encode($_conds);
 }
 
 
}
?>