<?php

/*
 * E.U.I 
 *
 
 * subject	: get model data for SysMenu  
 * 			  extends under model class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysmenu/
 */
 
class SetPrefix extends EUI_COntroller
{

/*
 * EUI :: __constructor() 
 * -----------------------------------------
 *
 * @ def	constructor class // aksesor 	 
 */
 
function __construct() 
{
	parent::__construct();
	$this->load->model('M_SetPrefix');
	$this->load->helper(array('EUI_Object'));
}

 /*
 * EUI :: index() 
 * -----------------------------------------
 *
 * @ def		function get default nav content 
 * @ param		not assign parameter
 */
 
 function index()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId'))
	{
		$EUI['page'] = $this -> {base_class_model($this)} -> _get_default();
		$this -> load -> view('set_product_prefix/view_product_prefix_nav', $EUI );
	}
 }
 
 
/*
 * EUI :: Content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function Content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId'))
	{
		$EUI['page'] = $this -> {base_class_model($this)} -> _get_resource_query(); // load content data by pages 
		$EUI['num']  = $this -> {base_class_model($this)} -> _get_page_number(); 	// load content data by pages 
		
		$this -> load -> view('set_product_prefix/view_product_prefix_list', $EUI );
	}	
 }

 
/*
 * EUI :: AddPrefix() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 
 function SavePrefix()
 {
	$_success = array('success'=> 0, 'error'=> ''); 
	if( $this -> EUI_Session -> _have_get_session('UserId'))
	{
		if( is_array($_REQUEST) && $this -> URI -> _get_have_post('result_head_level') ) 
		{
			if( $this -> {base_class_model($this)} -> _set_save_prefix_number( $_REQUEST ) ) 
			{
				$_success = array('success'=> 1, 'error'=> 'OK'); 
			}
		}
	}	
	
	echo json_encode($_success);
 }
 
 
/*
 * EUI :: AddPrefix() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function AddPrefix()
 {
	if(_have_get_session('UserId'))
	{
		$this->load->view('set_product_prefix/view_product_prefix_add', array
		(	
			'AddForm'  => $this->{base_class_model($this)}->_get_avail_form( PRODUCT .'/add_form' ),
			'EditForm' => $this->{base_class_model($this)}->_get_avail_form( PRODUCT .'/edit_form' ),
			'Method'   => $this->{base_class_model($this)}->_get_method_prefix()	
		));
	}
 }
 
/*
 * EUI :: AddPrefix() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function EditPrefix()
 {
	 if(_have_get_session('UserId')) 
	{	
		$this->load->view('set_product_prefix/view_product_prefix_edit', array(
			'Form' 		=> $this->{base_class_model($this)}->_get_avail_form(),
			'AddForm'  	=> $this->{base_class_model($this)}->_get_avail_form( PRODUCT .'/add_form' ),
			'EditForm' 	=> $this->{base_class_model($this)}->_get_avail_form( PRODUCT .'/edit_form' ),
			'data' 		=> $this->{base_class_model($this)}->_getPrefix()
		));
	}
 }
 
 
/*
 * EUI :: Update() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function Update()
 {
	$_array = array("success"=>0);
	if( $this ->{base_class_model($this)} ->_setUpdate( $this -> URI -> _get_all_request()))
	{
		$_array = array("success"=>1);
	}
	
	echo json_encode($_array);
 }
 
/*
 * EUI :: Update() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
public function Delete()
{

 $_conds =array('success' => 0);
 if( $this -> EUI_Session->_have_get_session('UserId') )
 {
	if( $this->{base_class_model($this)}->_seDelete() )
	{
		$_conds =array('success' => 1);
	}	
 }
 
	__(json_encode($_conds));
}
 
 
/*
 * EUI :: Update() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 
 function SetActive()
 {
	$_array = array("success" => 0); 
	if( $this -> EUI_Session->_have_get_session('UserId'))
	{
		if( $this -> URI -> _get_have_post('PrefixId'))
		{
			$_post_data = array
			(
				'PrefixId' => $this -> URI -> _get_array_post('PrefixId'),
				'Active' => $this -> URI -> _get_post('active')
			);
			
			if( $this->{base_class_model($this)}->_setActive($_post_data) )
			{		
				$_array = array("success" => 1);	
			}
		}
	}	
	
	echo json_encode($_array);
 }
 
 
}


?>