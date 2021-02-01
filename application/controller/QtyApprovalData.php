<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class QtyApprovalData extends EUI_Controller
{

// ---------------------------------------------------------------------------------------------------------------- 
/* 
 * @ package 	: constructor 
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * 
 */
 public function __construct() 
{
 parent::__construct();	
 $this->load->model(array(base_class_model($this)));	
 $this->load->helper(array('EUI_Object'));	
}
 
// ---------------------------------------------------------------------------------------------------------------- 
/* 
 * @ package 	: constructor 
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * 
 */
 
 function _getCallResult()
 {
	$_conds = array();
	
	 foreach
	 ( 
		$this ->M_SetCallResult ->_getCallReasonId()  
			as $k  => $call  )
	{
		$_conds[$k] = $call['name'];
	}
	
	return $_conds;
 }
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getProductId()
 {
	$_conds = array();
	foreach
	( 
		$this ->M_SetProduct ->_getProductId()  
		as $k  => $call )
	{
		$_conds[$k] = $call['name'];
	}
	
	return $_conds;
 }
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getQtyResult()
 {
	$_conds = array();
	if(class_exists('M_SetResultQuality'))
	{
		foreach
		( 
			$this -> M_SetResultQuality ->_getQualityResult()  
			as $k  => $call )
		{
			$_conds[$k] = $call['name'];
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
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

 public function index()
{
	
  if(_have_get_session('UserId'))
 {
	$_EUI  = array ( 
		'page' 			=> $this -> M_QtyApprovalData -> _get_default(),
		'CampaignId' 	=> $this -> M_SetCampaign -> _get_campaign_name(),
		'CardType' 		=> $this -> M_SrcCustomerList ->_getCardType(), 
		'GenderId' 		=> $this -> M_SrcCustomerList ->_getGenderId(),
		'UserId' 		=> $this -> M_SysUser -> _get_teleamarketer(), 
		'CallResult' 	=> $this -> _getCallResult(), 
		'QtyResult'		=> $this -> _getQtyResult(),
		'ProductId' 	=> $this -> _getProductId()
	);	
		
	if( is_array($_EUI)) {
		$this->load->view('qty_approval_data/view_approval_data_nav',$_EUI);
	}	
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
   $objClass =&get_class_instance(base_class_model($this));
   if( _have_get_session('UserId') )
  {
		$this->load->view('qty_approval_data/view_approval_data_list',array(
			'page' => $objClass->_get_resource(),
			'num'  => $objClass->_get_page_number()
		));
   }	
}

// ---------------------------------------------------------------------------------------------------------------- 
/* 
 * @ package 	: instance of class  
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * 
 */
 public function Rejected()
{
 $cond = array('success' => 0 );
 if( _have_get_session('UserId') )
 {
	$objClass =&get_class_instance(base_class_model($this));
	$argument =  $objClass->_set_row_rejected_policy( new EUI_Object(_get_all_request()) );
	if( $argument )
	{
		$cond = array('success' => 1 );	
	}
 }
 echo json_encode( $cond );
 
}

// ==================== END CLASS ======================================== 
}

?>