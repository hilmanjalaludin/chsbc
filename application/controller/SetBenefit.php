<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SetBenefit extends EUI_Controller
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
	$this->load->model(array(base_class_model($this),'M_SetProduct'));
	$this->load->helper(array('EUI_Object'));
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
	if(_have_get_session('UserId') ) 
	{
		$this->load->view('set_product_benefit/view_benefit_nav',array(
			'page' => $this->{base_class_model($this)}->_get_default()
		));
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
		$_EUI['page'] = $this -> M_SetBenefit -> _get_resource();    // load content data by pages 
		$_EUI['num']  = $this -> M_SetBenefit -> _get_page_number(); // load content data by pages 
		
		// sent to view data 
		
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('set_product_benefit/view_benefit_list',$_EUI);
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

private function _getProductName()
{
	$Data = $this ->M_SetProduct->_getProductId();
	if( is_array($Data) )
	{
		foreach( $Data as $k => $p )
		{
			$_conds[$k] = $p['name']; 
		}
	}
	
	return $_conds;
}
 
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

function AddBenefit()
{
	if( $this -> EUI_Session->_get_session('UserId') )
	{
		$data = array(
			'ProductId' => $this -> _getProductName(),
			'active' => $this -> {base_class_model($this)}->_getActive()
		);
		$this -> load -> view("set_product_benefit/view_benefit_add",$data);
	}
}
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function ViewAddBenefit()
 {
	if( $this -> EUI_Session->_get_session('UserId') )
	{
		$data = array(
			'ProductPlan' => $this ->{base_class_model($this)}->_getProductPlan($this->URI->_get_post('ProductId')) 
		);
		$this -> load -> view("set_product_benefit/view_benefit_plan",$data);
	}	
 }

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 function EditBenefit()
 {
	if( $this -> EUI_Session->_get_session('UserId') )
	{
		$Data = $this ->{base_class_model($this)} ->_getBenefitData( $this->URI->_get_post('BenefitId') );
		
		$UI = array
		(
			'Data' => $Data, 
			'ProductId' => $this -> _getProductName(),
			'ProductPlan' => $this ->{base_class_model($this)}->_getProductPlan($Data['ProductId']),
			'active' => $this ->{base_class_model($this)} ->_getActive()
		);
		
		$this -> load -> view( 'set_product_benefit/view_benefit_edit', $UI );
	}
 }
 
 
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function SaveBenefit()
 {
	$_conds = array('success'=>0);
	if( $this -> EUI_Session->_get_session('UserId') )
	{
		$cond = $this ->{base_class_model($this)}->_setSaveBenefit( new EUI_Object(_get_all_request()));
		if( $cond ) {
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
 
 function UpdateBenefit()
 {
  $_conds = array('success'=>0);
	if( _get_session('UserId') )
	{
		$cond = $this ->{base_class_model($this)}->_setUpdateBenefit( new EUI_Object(_get_all_request()));
		if( $cond ) {
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
 
 function Delete()
 {
	$_conds = array('success'=>0);
	if( $this -> EUI_Session->_get_session('UserId') )
	{
		$_post = array(
			'BenefitId' => $this -> URI->_get_array_post('BenefitId')
		);
		
		if( $this ->{base_class_model($this)}->_setDelete($_post))
		{
			$_conds = array('success'=>1);
		}
	}
	
	echo json_encode($_conds);
 }
 
}
?>