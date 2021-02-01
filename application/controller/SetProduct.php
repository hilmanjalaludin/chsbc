<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysMenu  
 * 			  extends under model class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysmenu/
 */
 
class SetProduct extends EUI_Controller 
{
	
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */

	
  public function __construct()  
 {
	parent::__construct();
	$this->load->model(array(base_class_model($this),'M_Combo'));
	$this->load->helper(array('EUI_Object'));
	
 }

	
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 
 public function index()
{
  if( _have_get_session('UserId') ) 
 {
	 $this->load->view('set_product_cores/view_product_index',array
	(
		'data'=> $this->{base_class_model($this)},
		'gender' => $this->M_Combo->_getGender()
	)); 
  }
}


// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 
function ShowGrid()
{
	$EUI['ProductPlan'] = (INT)$this -> URI ->_get_post('ProductPlan'); //load content data by pages 
	$EUI['ProductAge'] = (INT)$this -> URI ->_get_post('ProductAge'); // load content data by pages 
	
	$this -> load -> view('set_product_cores/view_age_band',$EUI); // load content data by pages 
}

// @ GridContent

function GridContent()
{
	$EUI['ProductPlan'] = (INT)$this -> URI -> _get_post('ProductPlan'); //load content data by pages 
	$EUI['ProductAge']  = (INT)$this -> URI -> _get_post('ProductAge'); // load content data by pages 
	$EUI['PayMode']  	= ($this -> URI-> _get_have_post('PayMode')?$this -> URI ->_get_array_post('PayMode'):null);
	$EUI['GroupPremi']  = ($this -> URI-> _get_have_post('GroupPremi')?$this -> URI ->_get_array_post('GroupPremi'):null);
	$EUI['Gender']		= ($this -> URI-> _get_have_post('Gender')?$this -> URI ->_get_array_post('Gender'):null);
	$EUI['GenderId']	= $this -> M_Combo -> _getGender();
	$EUI['data'] 		= $this -> M_SetProduct; // load content data by pages 		
	$this->load->view('set_product_cores/view_content_grid',$EUI); // load content data by pages
 }
 
/*
 * EUI .@ SaveProduct
 * -----------------------------------------
 *
 * @ func 	 set_level_one insert to database 
 * @ params  post & definition paymode 
 */
 
  public function SaveProduct()
{
	$success = array('success'=> 0, 'error'=> ''); 
	
// --- handle object data -------------------------
	
	$out  =new EUI_Object(_get_all_request() );	
	$obj =& get_class_instance('M_SetProduct');
	
// ------------- this set data to array variable ---------------------	
	$arr_data = array 
	(
		'GroupPremi' 	 => $out->get_array_value('GroupPremi'),
		'PayMode' 		 => $out->get_array_value('PayMode'),
		'Gender'		 => $out->get_array_value('Gender'),
		'ProductPlan' 	 => $out->get_value('ProductPlan'),
		'RangeAge' 		 => $out->get_value('RangeAge'),
		'CreditShield'   => $out->get_value('CreditShield'),
		'ProductId' 	 => $out->get_value('ProductId'),
		'ProductName' 	 => $out->get_value('ProductName'),
		'ProductCores'	 => $out->get_value('ProductCores'),
		'ProductType'	 => $out->get_value('ProductType'),
		'Beneficiary'	 => $out->get_value('Beneficiary'),
		'ExpiredPeriode' => $out->get_value('ExpiredPeriode'),
		'Sponsor'		 => $out->get_value('Sponsor'),
		'Currency'		 => $out->get_value('Currency'),
		'Underwriting'	 => $out->get_value('Underwriting')
		
	);
	
// --------- this handle of credit shield insurance  -----------------
	
	$CreditShield = $out->get_value('CreditShield');
	if( ($CreditShield!=1) AND ($CreditShield!='') ){
		$cond = $obj->_set_not_credit_shield( $arr_data, $_REQUEST);
	}
	else{
		$cond = $obj->_set_credit_shield( $arr_data, $_REQUEST);
	}
	
/** json parse **/
	
	if( $cond ) {
		$success = array('success'=> 1, 'error'=> 'OK'); 
	}
	
	echo json_encode($success);
 }
 
 
/*
 * EUI .@ SaveProduct
 * -----------------------------------------
 *
 * @ func 	 set_level_one insert to database 
 * @ params  post & definition paymode 
 */
 
}

?>