<?php 

 class ProductBniLifeActivePlus extends EUI_Controller
{
 
// ------------------------------------------------------------
/*
 * @ package get age my insured selected row .
 */
 
 function __construct() 
 {
	parent::__construct();
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object'));	
 }
 
// ------------------------------------------------------------
/*
 * @ package get age my insured selected row .
 */
 
function index(){ }


// ------------------------------------------------------------
/*
 * @ package get age my insured selected row .
 */
  function SelectCalculateAge() 
{
 
 $cond = array('Age' => 0);
 $out =new EUI_Object( _get_all_request() );
 if( !$out->fetch_ready() )	{
	 echo json_encode();
	 return FALSE;
 }
 
 $Years = $this->SelectPurpouseAge( $out );
 if( !$Years ) {
	echo json_encode( $cond );
	return false;
 } else{
	$cond = array('Age' => $Years );
 }
 
 echo json_encode($cond);
 
}  

// ------------------------------------------------------------
/*
 * @ package get age my insured selected row .
 */
 
 function SelectInsuredAge()
{
	$cond = array('success' => 0, 'InsuredAge' => 0 );
	$out =new EUI_Object( _get_all_request() );
	
	if( !$out->fetch_ready() ) 
	{
		echo json_encode( $cond );
		return false;
	}
	
		
// -- next -------------------------------------------------------------

	$Years = $this->SelectPurpouseAge( $out );
	if( !$Years ) {
		echo json_encode( $cond );
		return false;
	} 
	
// --- cek range of age interval list of by product 

	$obClass=& get_class_instance(base_class_model($this));
	$bool_insured_age =(bool)$obClass->_select_row_range_age( $Years,
		$out->get_value('ProductId', 'intval'),
		$out->get_value('GroupPremi', 'intval')
	);
	
	if( $bool_insured_age == FALSE ){
		echo json_encode( $cond );
		return false;
	}
	
	$cond = array( 'success' => 1, 'InsuredAge' => $Years );
	echo json_encode( $cond );
	return true;
} 



// ------------------------------------------------------------
/*
 * @ package get age my insured selected row .
 */
 public function SelectPremiPersonal() 
{
	
  $arr_cond = array('GroupPremi' => 0,'PremiPerson' => 0 );
  
  $out =new EUI_Object(_get_all_request() );	
  if( !$out->fetch_ready() )	
 {
	echo json_encode($arr_cond);
	return FALSE;
  }
  
// ---convert  json to array  ---------------------

  $arr_personal =(array)$out->get_value('personal_data','json_decode');
  $obClass =& get_class_instance(base_class_model($this));
  
 // --- total premi calculation ------------------
  $arr_total_premi_group = array();
  
  if( is_array( $arr_personal ) ) 
	  foreach( $arr_personal as $key => $row )
  {
	if( is_object($row) ){
		$row = (array)$row;
	}
	
	$row =new EUI_Object( $row );
	$spl =Spliter($row->get_value('GroupPremi'), "_", array('GroupPremi', 'enum'));
	
	if( in_array( $spl->get_value('GroupPremi'), 
		array(INS_CODE_MAIN, INS_CODE_SPOUSE, INS_CODE_DEPEND)) )
	 {
		
		$obPremi = $obClass->_select_personal_premi(array (
			'PersonalAge'=> $row->get_value('PersonalAge','intval'),	
			'GroupPremi' => $spl->get_value('GroupPremi','intval'),
			'ProductId' => $row->get_value('ProductId','intval'),
			'GenderId' => $row->get_value('GenderId','intval'),
			'PayMode' => $row->get_value('PayMode','intval'),
			'PlanId' => $row->get_value('PlanId','intval')
		));
	//	print_r($obPremi);
		
// ------------------- object premi -----------------------
		if( is_object($obPremi ) ) {  
			$arr_cond[$key] = array( 'GroupPremi' => $key, 'PremiPerson' => $obPremi->get_value('ProductPlanPremium','intval') );
		} 
		else{
			$arr_cond[$key]= array( 'GroupPremi' => $key, 'PremiPerson' => 0 );
		}
	}	
  }
  
  
  echo json_encode($arr_cond);
  
}


// ------------------------------------------------------------------------------------
/*
 * @ package :  umur data data yang bisa di followup berdasrkan Product Setup .
 */

 protected function SelectPurpouseAge( $out = null )
{	
   $years = 0;
 
 // ---- next ------------------------------------------
	$arr_selector = _getDateDiff( date('Y-m-d'), $out->get_value('Date', '_getDateEnglish'));
   
	if( is_array( $arr_selector )  
		AND isset($arr_selector['months_total']) 
		AND isset($arr_selector['months_total']))
	{
		$Month = (int)$arr_selector['months_total'];
		$Day = (int)$arr_selector['days_total'];
		$years = $arr_selector['years'];
	}
	
	return (int)$years;
	
} 


// ------------------------------------------------------------------------------------
/*
 * @ package :  umur data data yang bisa di followup berdasrkan Product Setup .
 */
 
 public function SaveDataEntry() 
{
 $cond = array('success' => 0 , 'PolicyNumber'=> 0 );	
 $out  =new EUI_Object(_get_all_request() );	

 if( !$out->fetch_ready() )		
{
	echo json_encode( $cond );
   return FALSE;
 }
 
// --------- call object class ---------------------------------------------

 $obClass =& get_class_instance(base_class_model($this));
 $PolicyNumber = $obClass->_set_row_save_policy_data( $out );
 
// --------- result data  ----------------------------------------------
 
  if( is_string( $PolicyNumber ) 
	 AND strlen( $PolicyNumber ) > 0  )
 {
	$obClass->_set_row_deleted_policy_data( $out ); 
	echo json_encode( array('success' => 1, 'PolicyNumber' => $PolicyNumber ) );
    return FALSE;
 }	 
 
 echo json_encode( $cond );
   
}

 // ===================== END CLASS =============================================
}
?>