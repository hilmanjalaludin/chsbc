<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SrcDonotcallList extends EUI_Controller
{
 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
 function __construct() 
{
	parent::__construct();
	$this->load->model(array('M_SrcDonotcallList', 'M_SetCallResult','M_SetProduct', 'M_SetCampaign','M_SetResultCategory', 'M_Combo', 'M_SysUser' ));
	$this->load->helper('EUI_Object');
 }
 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
public function CekPolicyForm()
{
	$_conds = array('success' => 0 );
	if( $this -> URI->_get_have_post('CustomerId') )
	{
		if( $rows = $this -> {base_class_model($this)} ->_getCekPolicyForm( $this -> URI->_get_post('CustomerId')) )
		{
			$_conds = array('success' => 1 );	
		}
	}
	
	__(json_encode($_conds));
} 
 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 function getCallResult( $CategoryId = null )
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
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
function setCallResult() 
{
	$_result = array( "setCallResult" => $this -> getCallResult( _get_post('CategoryId') ) );
	 if( is_array($_result)) 
	{
		$this -> load ->view('mod_donotcall_detail/view_call_result',$_result);
	}
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
	foreach( $this ->M_SetProduct ->_getProductId()  as $k  => $call ) {
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
		$param = array();
		
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
		
		$this->load ->view('src_donotcall_list/view_customer_nav',array(
			'page' => $this->M_SrcDonotcallList->_get_default()
		));
	}	
 }
 
 function _getCombo()
 {
	$_serialize = array();
	$_combo = $this ->M_Combo->_getSerialize();
	foreach( $_combo as $keys => $method )
	{
		if((STRTOLOWER($keys)!='serialize') AND (STRTOLOWER($keys)!='instance') 
			AND (STRTOLOWER($keys)!='nstruct') AND (STRTOLOWER($keys)!='t'))
		{
			if(STRTOLOWER($keys)=='user')
			{
				$_serialize[$keys] = $this->_getAgentAssign();
			}
			else{
				$_serialize[$keys] = $this ->M_Combo->$method();
			}
		}
	}
	
	return $_serialize;
 } 
 
 function _getAgentAssign()
{
	$_conds = array();
	$Agent = $this -> M_SysUser->_get_user_by_login();
	
	$no=0;
	foreach( $Agent as $k => $rows ) 
	{
		$_conds[$k] = (++$no).' -'. $rows['full_name'];
	}
	
	return $_conds;
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
		$_EUI['page'] = $this ->M_SrcDonotcallList ->_get_resource();    // load content data by pages 
		$_EUI['num']  = $this ->M_SrcDonotcallList ->_get_page_number(); // load content data by pages 
		
		// sent to view data 
		
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('src_donotcall_list/view_customer_list',$_EUI);
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
		$out =& get_class_instance(base_class_model($this));
		
		if( $arr_ouput = $out->_getDetailCustomer( $var->get_value('CustomerId') ) )
		{
			$this->load->view('mod_donotcall_detail/view_contact_main_detail', array(
				'Detail' => new EUI_Object( $arr_ouput )
			));
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
 
 
 public function PolicyStatus()
{
	$_conds = array('PolicyReady' => 0 );
	
	if(_get_post('CustomerId'))
	{
		$this->db->select("COUNT(a.PolicyAutoGenId) AS jumlah", FALSE);
		$this->db->from("t_gn_policyautogen a ");
		$this->db->where("a.CustomerId", $this->URI->_get_post('CustomerId'));
		
		if( $rows = $this->db->get()->result_first_assoc() )
		{
			$_conds = array('PolicyReady' => $rows['jumlah'] );	
		}
	}
	
	echo json_encode($_conds);	
 }
 
// --------------------------------------------------------------------
/*
 * Aksess 			public 
 */ 
 
 public function SetFollowup()
{
 $arr_response = array('success' => 0 );
 if( !_get_have_post('CustomerId') OR !_have_get_session('UserId') )
 {
	echo json_encode( $arr_response );
	return false;
 }
 
 // -------- set follow up ---------------------------------
 $cond = $this->{base_class_model($this)}->_set_row_update_followup(new EUI_Object( _get_all_request() ));
 if( $cond ){
	$arr_response = array('success' => 1 );	
  }	 
  
  echo json_encode( $arr_response );
	
} 

// --------------------------------------------------------------------
/*
 * Aksess 			public 
 */ 
 
 public function UnsetFollowup()
{
 $arr_response = array('success' => 0 );
 if( !_get_have_post('CustomerId') OR !_have_get_session('UserId') )
 {
	echo json_encode( $arr_response );
	return false;
 }
 
 // -------- set follow up ---------------------------------
 $cond = $this->{base_class_model($this)}->_unset_row_update_followup(new EUI_Object( _get_all_request() ));
 if( $cond ){
	$arr_response = array('success' => 1 );	
  }	 
  
  echo json_encode( $arr_response );
	
} 
 
 // ============================= END CLASS ===================================
 
}
?>