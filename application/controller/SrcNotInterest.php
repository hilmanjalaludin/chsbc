<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SrcNotInterest extends EUI_Controller
{
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function SrcNotInterest()
 {
	parent::__construct();
	$this -> load -> model
	( 
		array
		(
			base_class_model($this), 'M_SetCallResult',
			'M_SetProduct','M_SetCampaign','M_SrcCustomerList',
			'M_SetResultQuality'
		)
	);
 }
 
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
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
 
 function _getResultQuality()
 {
	$_conds = array();
	foreach
	( 
		$this ->M_SetResultQuality ->_getQualityResult()  
		as $k  => $call )
	{
		$_conds[$k] = $call['name'];
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
 
 function index()
 {
	if( $this ->EUI_Session ->_have_get_session('UserId') )
	{
		$_EUI  = array
		(
			'page' 			=> $this->{base_class_model($this)}->_get_default(), 
			'CampaignId' 	=> $this->M_SetCampaign ->_get_campaign_name(),
			'CardType' 		=> $this->M_SrcCustomerList ->_getCardType(), 
			'GenderId' 		=> $this->M_SrcCustomerList ->_getGenderId(),
			'ProductId' 	=> self::_getProductId(), 
			'CallResult' 	=> self::_getCallResult(), 
			'ResultQuality' => self::_getResultQuality()
		);
		
		if( is_array($_EUI))
		{
			$this -> load ->view('src_notinterest_list/view_notinterest_nav',$_EUI);
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
		$_EUI['page'] = $this ->{base_class_model($this)}->_get_resource();    // load content data by pages 
		$_EUI['num']  = $this ->{base_class_model($this)}->_get_page_number(); // load content data by pages 
		
		// sent to view data 
		
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('src_notinterest_list/view_notinterest_list',$_EUI);
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
 
}
?>