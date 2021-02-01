<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SrcCustomerClosing extends EUI_Controller
{
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function SrcCustomerClosing()
 {
	parent::__construct();
	$this->load->model(array(base_class_model($this)));
	$this->load->helper('EUI_Object');
 }
 
 

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
function setCallResult() 
{
	$_result = array( "setCallResult" => $this -> getCallResult( $this -> URI ->_get_post('CategoryId')) );
	if( is_array($_result)) {
		$this -> load ->view('src_closing_list/view_call_result',$_result);
	}
}
  
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getCallResult($CategoryId = null )
 {
	$_conds = array();
	
	 foreach
	 ( 
		$this ->M_SetCallResult ->_getCallReasonId($CategoryId)  
			as $k  => $call  )
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
 
 function _getCombo()
 {
	$_serialize = array();
	$_combo = $this ->M_Combo->_getSerialize();
	foreach( $_combo as $keys => $method )
	{
		if((STRTOLOWER($keys)!='serialize') AND (STRTOLOWER($keys)!='instance') 
			AND (STRTOLOWER($keys)!='nstruct') AND (STRTOLOWER($keys)!='t'))
		{
			$_serialize[$keys] = $this ->M_Combo->$method(); 	
		}
	}
	
	return $_serialize;
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
		switch($this->EUI_Session ->_get_session('HandlingType'))
		{
			case USER_MANAGER :
				$param['mgr_id'] = $this ->EUI_Session ->_get_session('UserId');
			break;
			
			case USER_SUPERVISOR :
				$param['spv_id'] = $this ->EUI_Session ->_get_session('UserId');
			break;
			
			case USER_LEADER :
				$param['tl_id'] = $this ->EUI_Session ->_get_session('UserId');
			break;
		}
		
		$_EUI  = array
		(
			'page' 			=> $this->M_SrcCustomerClosing->_get_default(), 
			'CampaignId' 	=> $this->M_SetCampaign->_get_campaign_name(),
			'CardType' 		=> $this->M_SrcCustomerList->_getCardType(), 
			'GenderId' 		=> $this->M_SrcCustomerList->_getGenderId(),
			'ProductId' 	=> self::_getProductId(), 
			'CallResult' 	=> self::_getCallResult(), 
			'ResultQuality' => self::_getResultQuality(),
			'combo'			=> $this ->M_SysUser->_get_teleamarketer($param)
		);
		if( is_array($_EUI))
		{
			$this -> load ->view('src_closing_list/view_closing_nav',$_EUI);
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
		$_EUI['page'] = $this ->M_SrcCustomerClosing ->_get_resource();    // load content data by pages 
		$_EUI['num']  = $this ->M_SrcCustomerClosing ->_get_page_number(); // load content data by pages 
		$_EUI['BackLevel'] = $this->M_SetResultQuality ->_getQualityBackLevel(); //
		
		
		// sent to view data 
		
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('src_closing_list/view_closing_list',$_EUI);
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

 
 public function SuspendType()
{
  $var =new EUI_Object( _get_all_request() );	
  $out =& get_class_instance('M_SrcCustomerList');
  $output = $out->_getDetailCustomer( $var->get_value('CustomerId'));
  
} 

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

  public function ContactDetail()
 {
	if( !_have_get_session('UserId') ) { return FALSE; }
	 if(  _get_have_post('CustomerId') )
	{
		$var =new EUI_Object( _get_all_request() );
		$out =& get_class_instance('M_SrcCustomerList');
		$bes =& get_class_instance(base_class_model($this));
		 
		if( $arr_ouput = $out->_getDetailCustomer( $var->get_value('CustomerId')))
		{	
			$arr_attr = $bes->_select_attr_confirm_detail( $var->get_value('CustomerId') );
			$arr_style = $bes->_select_attr_quality_status($arr_ouput);
			
			$this->load->view('mod_confirm_detail/view_contact_main_detail', array(
				'Detail' => new EUI_Object( $arr_ouput ),
				'Attrs' => new EUI_Object( $arr_attr ),
				'Class' => new EUI_Object( $arr_style )
			));
		}
	}
	
  }	
 
 
}
?>