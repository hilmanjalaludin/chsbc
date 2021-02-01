<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class ModFormInbound extends EUI_Controller
{


 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function ModFormInbound()
 {
	parent::__construct();
	$this -> load -> model
	( 
		array
		(
			base_class_model($this), 'M_SetCallResult',
			'M_SetProduct','M_SetCampaign'
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
 
 function getCallResult()
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
  * @ def : _getInboundReasonId
  *
  */
  
 function _getInboundReasonId()
 {
	$_conds = array();
	
	 foreach
	 ( 
		$this ->M_SetCallResult ->_getInboundReasonId()  
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
 
 function _getInboundProductId()
 {
	$_conds = array();
	$_datas = $this ->M_SetProduct ->_getInboundProductId();
	
	if( is_array($_datas) ) 
	{
		foreach( $_datas as $k  => $call )
		{
			$_conds[$k] = $call['name'];
		}
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
 
 function _getInboundCampaignId($ProductId=null)
 {
 
	$_conds = null;
	$_datas = $this ->M_SetProduct ->_getInboundProductId();
	
	if(!is_null($ProductId) AND is_array($_datas) )
	{
		$_conds = $_datas[$ProductId]['CampaignId'];
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
 
 function _getOutboundProductId()
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
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function index()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$EUI = array
		(
			"CallReasonId" => self::_getInboundReasonId(),
			"ProductId" => self::_getInboundProductId(),
			"Caller" => self::CallAttribute(),
			"GenderId" => $this ->{base_class_model($this)} ->_getGenderId()
		);
		
		$this -> load -> view('mod_form_inbound/view_form_inbound',$EUI);
	}	
	
 }
 
/*
 * @ def 		: content / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function _explode_ivr_data()
{
	$IvrData = $this->URI->_get_post('IvrData');
	if( !is_null($IvrData) ){
		$_arrs_ivr = explode(';', $IvrData);
	}
	
	if(!is_array($_arrs_ivr))
		return FALSE;
	else
	{
		$_array_current = current($_arrs_ivr); 
		$_array_current = next($_arrs_ivr);
		if(!$_array_current) 
			return FALSE;
		else
			return $_array_current; 
	}	
}
  
/*
 * @ def 		: content / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function CallAttribute()
{
	$_avail = array(); $_options = null;
	$_sendData = $this -> URI -> _get_all_request();
	
	$_sendData = array(
		'IvrData' => $this->_explode_ivr_data(),
		'CallerId' => $this->URI->_get_post('CallerId'),
		'CallSessionId' => $this->URI->_get_post('CallSessionId')
	);
	
	if( is_array($_sendData) )
	{
		foreach($_sendData as $keys => $values) {
			$_options[$keys] = preg_replace("/[^0-9]/", "",$values);
		}
		$_options['Campaign'] = $this ->{base_class_model($this)} ->_getDIDNumber($_options['IvrData']);	
		
	}
	
	return $_options;
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
		$_EUI['page'] = $this ->{base_class_model($this)} ->_get_resource();    // load content data by pages 
		$_EUI['num']  = $this ->{base_class_model($this)} ->_get_page_number(); // load content data by pages 
		
		// sent to view data 
		
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('mod_form_inbound/view_inbound_list',$_EUI);
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

 public function Inbound()
 {
	
	if( $this ->EUI_Session ->_have_get_session('UserId') )
	{
		$_EUI  = array
		(
			'page' 			=> $this->{base_class_model($this)}->_get_default(), 
			'GenderId' 		=> $this->{base_class_model($this)}->_getGenderId(),
			'CardType' 		=> $this->{base_class_model($this)}->_getCardType(), 
			'CampaignId' 	=> $this->M_SetCampaign->_get_campaign_name(),
			'CallResult' 	=> self::getCallResult(), 
			'ProductId' 	=> self::_getInboundProductId()
		);
		
		if( is_array($_EUI))
		{
			$this -> load ->view('mod_form_inbound/view_inbound_nav',$_EUI);
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
 
 
 function getProductScript()
 {
	if( $this->EUI_Session->_have_get_session('UserId') ) {
		echo json_encode( $this->_getInboundProductId() );
	}
 }
 
  
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 function SaveInbound()
 {
	$ProductId = NULL;
	$CallInbound  = NULL;
	
	$array = array("success"=>0);
	if( $this ->EUI_Session ->_have_get_session('UserId') ) 
	{
	
		$CallInbound['CustomerNumber'] = $this->URI->_get_post('CallSessionId');
		$CallInbound['CustomerFirstName'] = $this->URI->_get_post('CustomerFirstName');
		$CallInbound['CustomerHomePhoneNum'] = $this->URI->_get_post('CustomerHomePhoneNum');
		$CallInbound['CustomerWorkPhoneNum'] = $this->URI->_get_post('CustomerWorkPhoneNum');
		$CallInbound['CustomerMobilePhoneNum'] = $this->URI->_get_post('CustomerMobilePhoneNum');
		$CallInbound['CallReasonId'] = $this->URI->_get_post('CallReasonId');
		$CallInbound['SellerId'] = $this->EUI_Session->_get_session('UserId');
		$CallInbound['GenderId'] = $this->URI->_get_post('GenderId');
		$CallInbound['CustomerUpdatedTs'] = date('Y-m-d H:i:s');
		$CallInbound['CampaignId'] = $this->URI->_get_post('CampaignId');
			
		// data must array set 
		
		if( is_array($CallInbound) 
			AND  $this ->{base_class_model($this)}-> _setSaveInbound($CallInbound)) 
		{
			$array = array("success"=>1);
		}
	}
	
	echo json_encode($array);
 }
 
}
?>