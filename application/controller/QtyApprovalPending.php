<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class QtyApprovalPending extends EUI_Controller
{

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function QtyApprovalPending() 
 {
	parent::__construct();
	$this -> load ->model(array(base_class_model($this)));	
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
  
 if( $this ->EUI_Session ->_have_get_session('UserId') 
	AND class_exists('M_QtyApprovalPending') )
 {
	$_EUI  = array( 'page' => $this ->{base_class_model($this)}->_get_default()
		//'CampaignId' => $this ->M_SetCampaign ->_get_campaign_name() )
		// 'CallResult' => self::getCallResult(), 'CardType' => $this ->M_SrcCustomerList ->_getCardType(), 
		// 'ProductId' => self::_getProductId(), 'GenderId' => $this ->M_SrcCustomerList ->_getGenderId()
	);
		
	if( is_array($_EUI))
	{
		$this -> load ->view('qty_approval_pending/view_approval_pending_nav',$_EUI);
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

  if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this->{base_class_model($this)}->_get_resource();    // load content data by pages 
		$_EUI['num']  = $this->{base_class_model($this)}->_get_page_number(); // load content data by pages 
		
		// sent to view data 
		
		if( is_array($_EUI) 
			AND is_object($_EUI['page']) )  
		{
			$this -> load -> view('qty_approval_pending/view_approval_pending_list',$_EUI);
		}	
	}	
}
 
}