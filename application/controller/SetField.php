<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
 
 class SetField extends EUI_Controller 
 {

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function __construct()  
 { 
	parent::__construct();
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object'));	
 }	
 
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function index()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )  
	{
		$UI = array('page' => $this ->{base_class_model($this)} ->_get_default());
		$this -> load -> view("mod_view_field/view_setfield_nav.php", $UI);
	}
 }
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

 public function Content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$UI = array(
			'page' => $this ->{base_class_model($this)} ->_get_resource(),
			'num' => $this ->{base_class_model($this)} ->_get_page_number()
		);
		
		// sent to view data 
		$this -> load -> view('mod_view_field/view_setfield_list',$UI);	
	}
	
 }
 
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function Create() 
{	
	if(!_have_get_session('UserId') )
{
	return FALSE;
}

	$obClass =& get_class_instance(base_class_model($this));
	$obCmpgn =& get_class_instance('M_SetCampaign');
	
	 $this->load->view('mod_view_field/view_setfield_index', array
	( 
		'view_field_size' => $obClass->_select_field_size(),  
		'CampaignId' => $obCmpgn->_getCampaignGoals(2),
		'Status' => Flags()
	));
			
		
} 
 
 
  
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function Copy() 
{	
	if(!_have_get_session('UserId') )
{
	return FALSE;
}

	$obClass =& get_class_instance(base_class_model($this));
	$obCmpgn =& get_class_instance('M_SetCampaign');
	$this->load->view('mod_view_field/view_setfield_copy', array(
		'output' => new EUI_Object( $obClass->_select_row_field_campaign( _get_post('Field_Id'))),
		'view_field_size' => $obClass->_select_field_size(),  
		'CampaignId' => $obCmpgn->_getCampaignGoals(2),
		'Status' => Flags()
	));
			
		
} 
 
 
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function ViewLayoutGenerate() 
{	
 if(!_have_get_session('UserId') )
 {
	return FALSE;
 }
	$obClass =& get_class_instance(base_class_model($this));
	$this->load-> view('mod_view_field/view_setfield_generator',array( 
		'view_field_size' =>_get_post('view_field_size'),
		'view_select_field' => $obClass->_select_row_field_data(),
		'view_select_number' => $obClass->_select_row_field_num(),
		'view_select_function' => $obClass->_select_row_call_function()
	));	
} 

//http://192.168.10.236/bnilifeinsurance/index.php/SetField/CopyField
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function CopyField()
{
  $cond = array('success' => 0);
  if(!_have_get_session('UserId') )  
  {
	 echo json_encode($cond);
	 return FALSE;
  }
   
  $obClass =& get_class_instance(base_class_model($this));
   if( $obClass->_set_row_copy_field( new EUI_Object( _get_all_request() )))  
  {
	$cond = array('success' => 1);	
   }
   
    echo json_encode($cond);
} 

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function SaveGenerate()
{

  $cond = array('success' => 0);
  if(!_have_get_session('UserId') )  
  {
	 echo json_encode($cond);
	 return FALSE;
  }
   
  $obClass =& get_class_instance(base_class_model($this));
   if( $obClass->_setSaveGenerate( new EUI_Object( _get_all_request() )))  
  {
	$cond = array('success' => 1);	
   }
   
    echo json_encode($cond);
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function Delete()
{
	$_conds = array('success' => 0);
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $result =  $this ->{base_class_model($this)} -> _setDeleted( $this -> URI->_get_array_post('Field_Id') ) )
		{
			$_conds = array('success' => 1);	
		}
	}
	
	__(json_encode($_conds));

}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function ViewLayout()
{
	if(_have_get_session('UserId') ) {
		$LayoutData = array(1); //$this ->{base_class_model($this)} ->_getFieldByCampaignId(10);
		$this->load->view('mod_view_field/view_layout_content');		
	}
}


// ====================== END CLASS ===================================

		
 }
 
 ?>