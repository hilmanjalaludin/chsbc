<?php

/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
 
class ModApprovePhone extends EUI_Controller 
{

/*
 * @ def 		: ModApprovePhone // constructor class 
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
 * @ def 		: index
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 	
function index()
{
	/* session_start();
	print_r($_SESSION); */
	if( $this ->EUI_Session ->_have_get_session('UserId') && class_exists('M_ModApprovePhone') )
	{
		$_EUI  = array('page'=> $this -> {base_class_model($this)} -> _get_default() );	
		if( is_array($_EUI))
		{
			$this -> load ->view('mod_approval_phone/view_approve_phone_nav',$_EUI);
		}	
	}
}

/*
 * @ def 		: Content
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 	
function Content()
{
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this->{base_class_model($this)}->_get_resource();    // load content data by pages 
		$_EUI['num']  = $this->{base_class_model($this)}->_get_page_number(); // load content data by pages 
		
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('mod_approval_phone/view_approve_phone_list',$_EUI);
		}	
	}	
}

// ---------------------------------------------------------------------------------------------------
/*
 * @ package 	ApproveItem
 -----------------------------------------------------------------------------------------------------
 * @ return 	: void(0)
 */
 
 public function ApproveItem()
{
 $cond = array('success'=>0);	
 
// -- call object class -------------------------------------	
 
 $obj=& get_class_instance(base_class_model($this));
  $out=& Objective( _get_all_request() );
  
 if(!$out->fetch_ready() ){
	echo json_encode( $cond ); 
	return FALSE;
 } 
 
 if( $obj->_setApproveItem( $out ) ){
	echo json_encode( array('success' => 1));  
 } else {
	echo json_encode( array('success' => 0)); 
 }	 
 
}

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function M_getSerilaizeCombo()
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
 * @ def 		: Content
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function Detail()
{
	
 if( !_have_get_session('UserId') ){
	return FALSE;
 }
// --- call object -------------------------------------------------------------------------------
 $cst=& get_class_instance('M_SrcCustomerList');
 $obj=& get_class_instance(base_class_model($this));
 $out=& Objective( _get_all_request() );
 
// ---  next proces ,------------------------------------------------------------------------------

 if(!$out->fetch_ready() ){
	 return FALSE;
 }
 
// ----- next process ---------------------
 
 $CustomerId = & $obj->_getCustomerId( $out->get_value('ApproveId'));
 if( !$CustomerId ){
	 return FALSE;
 }
 
// --- next sent to view ---------------------
 
 $this->load->view('mod_approval_phone/approve_content_phone',array
 (
	'Customers' 		=> $cst->_getDetailCustomer( $CustomerId ),
	'Phones' 			=> $cst->_getPhoneCustomer( $CustomerId ),
	'AddPhone' 			=> $cst->_getApprovalPhoneItems( $CustomerId ),
	'ItemApprove'		=> $obj->_getAllApprovalItems()
	//'PostData'			=> Objective(_get_all_request())
 ));
 
}


public function GetDetailJson()
{
	
 if( !_have_get_session('UserId') ){
	return FALSE;
 }
// --- call object -------------------------------------------------------------------------------
 $cst=& get_class_instance('M_SrcCustomerList');
 $obj=& get_class_instance(base_class_model($this));
 $out=& Objective( _get_all_request() );
 
// ---  next proces ,------------------------------------------------------------------------------

 if(!$out->fetch_ready() ){
	 return FALSE;
 }
 
// ----- next process ---------------------
 
 $CustomerId = & $obj->_getCustomerId( $out->get_value('ApproveId'));
 if( !$CustomerId ){
	 return FALSE;
 }
 
// --- next sent to view ---------------------
 
 $CustomerDetail = $cst->_getDetailCustomerJson( $CustomerId );
 //print_r($cst->_getPhoneCustomer( $CustomerId ));
 echo json_encode(array(
	'Customers' 		=> $CustomerDetail,
	//'Phones' 			=> $cst->_getPhoneCustomer( $CustomerId ),
	//'AddPhone' 		=> $cst->_getApprovalPhoneItems( $CustomerId ),
	'ItemApprove'		=> $obj->_getAllApprovalItems()
	//'PostData'			=> Objective(_get_all_request())
 ));
 
}


// ViewAddPhone 

function ViewAddPhone()
{
	$Data = array( 
		'Customer' => $this -> URI->_get_all_request() , 
		'PhoneType' =>  $this -> M_PhoneType -> _getPhoneTypeList() 
	);
	
	if( is_array($Data) ) {
		$this->load->view('mod_approval_phone/approve_view_addphone',$Data);
	}
}



// PhoneNumber 

function PhoneNumber()
{
	$_conds = array('phoneNumber' => '' );
	$fieldname = $this -> URI-> _get_post('FieldName');
	$this -> db -> select($fieldname); 
	$this -> db -> from('t_gn_customer');
	$this -> db -> where('CustomerId',$this -> URI-> _get_post('CustomerId'));
	
	if( $rows =  $this -> db -> get() -> result_first_assoc() ){
		$_conds = array('phoneNumber' => $rows[$fieldname]);
	}

	echo json_encode($_conds);
}

// ----------------------------------------------------------------------------------------------
// save phone submit by user 

 public function SavePhone() 
{
  $obj=& get_class_instance(base_class_model($this));
  $out=& Objective( _get_all_request() );

  // start commit bdcdf872 
  $PhoneAddTypeValue=$out->get_value("PhoneAddTypeValue");
  // $q= "SELECT * FROM t_gn_approvalhistory WHERE ApprovalOldValue='".$PhoneAddTypeValue."' OR ApprovalNewValue='".$PhoneAddTypeValue."'";
	 //   $data= $this->db->query($q)->num_rows();
  // end commit bdcdf872 

	   // start commit 3c09d8c5
	   $CustomerId = $out->get_value("CustomerId");
		$q = "SELECT * FROM t_gn_approvalhistory WHERE CustomerID='" . $CustomerId . "' AND (ApprovalOldValue='" . $PhoneAddTypeValue . "' OR ApprovalNewValue='" . $PhoneAddTypeValue . "')";
		$data= $this->db->query($q)->num_rows();
		// end commit 3c09d8c5

		//start commit 4a104092
		$q2 = "SELECT * FROM t_gn_customer a WHERE a.CustomerId='".$CustomerId."' AND (a.CustomerHomePhoneNum='".$PhoneAddTypeValue."' OR a.CustomerMobilePhoneNum='".$PhoneAddTypeValue."' OR a.CustomerWorkPhoneNum='".$PhoneAddTypeValue."')";
		
		$data2 = $this->db->query($q2)->num_rows();
		//end commit 4a104092

   // start commit 4a104092 
   	if($data>0 OR $data2>0) {
		echo "Phone Number Sudah Adaaa";
		echo json_encode( array( 'success'=>0));
		return false;
	}
   	// end commit bdcdf872 
	
   if( !_have_get_session('UserId') ){
   	
	return FALSE;
 }
 
  if(!$out->fetch_ready() ){
	return FALSE;
  }
  
  $_arr = array('success' => 0 );
	if( $this -> EUI_Session->_have_get_session('UserId') )
  {
	if( $obj->_SaveSubmitPhone( $out ) )  {
		echo json_encode( array( 'success'=>1));
		return false;
	}
 }
	echo json_encode( array( 'success'=>0));
 }
 
 // --------------------- END CLASS ============================

}

?>