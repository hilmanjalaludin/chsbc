<?php

class ModViewPlan extends EUI_Controller
{

/*  @ def 	: ModViewPlan 
 * -------------------------------------
 *
 */
function __construct() 
{
	parent::__construct();
	$this->load->model(base_class_model($this));	
	$this->load->helper(array('EUI_Object','EUI_Product'));
}	

/*  @ def 	: index 
 * -------------------------------------
 *
 */
  
function index()
{
	if( $this -> EUI_Session ->_have_get_session('UserId') )
	{
		if( class_exists(base_class_model($this)) ) 
		{
			$EUI = array( 'page' => $this -> {base_class_model($this)} -> _get_default());
			$this -> load -> view('mod_view_plan/view_mod_plan_nav', $EUI);
		} 
		else
		{
			echo "Class ".base_class_model($this)." does no exist ";
			exit(0);
		}
	}
}
  
/*  @ def 	: Content 
 * -------------------------------------
 *
 */
  
function Content()
{
  if( $this -> EUI_Session -> _have_get_session('UserId'))
	{
		$EUI['page'] = $this ->{base_class_model($this)}-> _get_resource(); // load content data by pages 
		$EUI['num']  = $this ->{base_class_model($this)}-> _get_page_number(); 	// load content data by pages 
		
		$this -> load -> view('mod_view_plan/view_mod_plan_list', $EUI );
	}	
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  public function showPlan() 
 {
	$class =& get_class_instance(base_class_model($this));
	$this->load->view('mod_view_plan/view_mod_show_plan');
}
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

  public function SetActive() 
{
 $cond = array('success' => 0 );
 $out =new EUI_Object(_get_all_request() );
 $class =& get_class_instance(base_class_model($this));
	
 // @productId 
 // @status 
 
  $response = (bool)$class->_set_row_product_active($out->get_value('ProductId','strval'), $out->get_value('Active','strval') );
   if($response) 
  {
	 $cond = array('success' => 1);
   }
   echo json_encode($cond);
 }

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 
public function UpdatePremi()
{
  $out = new EUI_Object(_get_all_request() );
  $obClass = $this->{base_class_model($this)}->_update_row_product_premi( $out );	
  if( $obClass ){
	  echo json_encode( array("success" => 1));
  } else {
	  echo json_encode( array("success" => 0));
  }
  
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 
public function UpdateLabel()
{
  $out = new EUI_Object(_get_all_request() );
  $obClass = $this->{base_class_model($this)}->_update_row_product_label( $out );	
  if( $obClass ){
	  echo json_encode( array("success" => 1));
  } else {
	  echo json_encode( array("success" => 0));
  }
  
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

function editPlan()
{

}

function cancelPlan()
{

}

 

/*  @ def 	: Content 
 * -------------------------------------
 *
 */
 
}
?>