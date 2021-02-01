<?php 

if( !defined('TYPE_PREMI_INDIVIDU') ) define('TYPE_PREMI_INDIVIDU',1);
if( !defined('TYPE_PREMI_GROUP') ) define('TYPE_PREMI_GROUP',2);



class ProductBniLifeSaveMedicalPlus extends EUI_Controller
{
 
// ------------------------------------------------------------
/*
 * @ package get age my insured selected row .
 */
 
 function __construct() 
 {
	parent::__construct();
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object','EUI_Spliter'));	
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
 

 public function _select_discount_personal_data( $personal_data = null )
{
	
 $arr_list_discount_per_group = array (
	INS_CODE_SPOUSE => array('dis' => 25, 'quota' => 1 ),
	INS_CODE_DEPEND => array('dis' => 15, 'quota' => 3)
 );

 if( !is_array($personal_data) ){
	return FALSE;
 }
 
 $total_discount = 0;
 
//-----------------------------------------------------------------
 
 $dis_dep_policy_yang_ikut = 0;
 $dis_sps_policy_yang_ikut = 0;
 
 $dis_dep_max_boleh_ikut = 3;
 $dis_sps_max_boleh_ikut = 1;
 
 $dis_dep_per_tidak_ikut = 15;
 $dis_sps_per_tidak_ikut = 25;
 
 //$var_arr = $out->get_array_value('GroupPremi');
 
 if( $personal_data) 
	 foreach( $personal_data as $key => $row )
 {
	if( in_array($row->GroupPremi, array(INS_CODE_DEPEND) )  ) {
	  $dis_dep_policy_yang_ikut+=1;
	} 
		
	if( in_array($row->GroupPremi, array(INS_CODE_SPOUSE) )  ) {
		$dis_sps_policy_yang_ikut+=1;
	}	
 }
 
  $total_discount+= (($dis_dep_max_boleh_ikut-$dis_dep_policy_yang_ikut) * $dis_dep_per_tidak_ikut);
  $total_discount+= (($dis_sps_max_boleh_ikut-$dis_sps_policy_yang_ikut) * $dis_sps_per_tidak_ikut);
 
  return $total_discount;
	
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

 protected function _select_max_age_group( $arr_personal)
{
  $arr_group = array(INS_CODE_MAIN, INS_CODE_SPOUSE);	
  $arr_age = array();
  $arr_max_age_group = array();
  
  if( is_array( $arr_personal ) ) 
	foreach( $arr_personal as $key => $row ) 
 {
	if( is_object($row) ){
		$row = (array)$row;
	}
	if( in_array($row['GroupPremi'], $arr_group )){  
		$arr_age[$row['GroupPremi']] = $row['PersonalAge'];
	}
 }
 
// ---------------------- 
 $arr_max_age_group = array_keys($arr_age, max($arr_age));
 $arr_max_age_group = current($arr_max_age_group); 
 return (array)$arr_max_age_group;
 
}

// ------------------------------------------------------------
/*
 * @ package get age my insured selected row .
 */
 
 public function SelectPremiPersonal() 
{
  $arr_group = array(INS_CODE_MAIN, INS_CODE_SPOUSE, INS_CODE_DEPEND);
  $arr_cond = array('GroupPremi' => 0,'PremiPerson' => 0 );
  $arr_total_premi_group = array();
  
  $out = new EUI_Object(_get_all_request() );	
  
  if( !$out->fetch_ready() ) {
	echo json_encode($arr_cond);
	return FALSE;
  }
  
// ---convert  json to array  ---------------------

  $arr_personal =(array)$out->get_value('personal_data','json_decode');
  $obClass =& get_class_instance(base_class_model($this));
  
  
// ===================== START :: INDIVIDU ==================================================
 if( $out->get_value('personal_premi','intval') ==  TYPE_PREMI_INDIVIDU )
 {
	 foreach( $arr_personal as $key => $row ) 
	{
		if( is_object($row) ){
			$row = (array)$row;
		}
		
		$row = new EUI_Object( $row );
		$spl = Spliter($row->get_value('GroupPremi'), "_", array('GroupPremi', 'enum'));
		
		 if( in_array( $spl->get_value('GroupPremi'), $arr_group ))
		{
			$obPremi = $obClass->_select_personal_premi(array (
				'GroupPremi' => $spl->get_value('GroupPremi'),
				'PersonalAge'=> $row->get_value('PersonalAge'),	
				'ProductId' => $row->get_value('ProductId'),
				'GenderId' => $row->get_value('GenderId'),
				'PayMode' => $row->get_value('PayMode'),
				'PlanId' => $row->get_value('PlanId'),
				'PremiTypeId' => $out->get_value('personal_premi')
			));
			
			if( is_object($obPremi) )
			{	
				$PolicyTotalDiscount = 0;
				$PolicyPremiPolicy  = 0;
				$PolicyPremiDiscount = 0;
				$PolicyPremiAfterDiscount = 0;
				
				$PolicyTotalDiscount = $arr_total_discount;
				$PolicyPremiPolicy = $obPremi->get_value('ProductPlanPremium','intval');
				$PolicyPremiDiscount = (($PolicyPremiPolicy * $PolicyTotalDiscount)/100);
				$PolicyPremiAfterDiscount = ($PolicyPremiPolicy - $PolicyPremiDiscount);
			
				$arr_cond[$key] = array( 
					'GroupPremi' => $key, 
					'PremiPerson' => $PolicyPremiPolicy, 
					'PremiDiscount' => $PolicyPremiDiscount,
					'PremiAfterDiscount'=> $PolicyPremiAfterDiscount,
					'PremiTotalDiscount' => $PolicyTotalDiscount
				);
			
			} else {
				$arr_cond[$key]= array( 
					'GroupPremi' => $key, 
					'PremiPerson' => 0 , 
					'PremiDiscount' => 0,
					'PremiAfterDiscount'=> 0,
					'PremiTotalDiscount' => 0,
				);
			}
		}
	}
	
 }
 
 // ===================== END :: INDIVIDU PREMI ==================================================

 
 
 // ===================== START :: GROUP PREMI ==================================================
  
   if( $out->get_value('personal_premi') == TYPE_PREMI_GROUP )
 {
	$arr_total_discount = $this->_select_discount_personal_data( $arr_personal );
	
	$arr_max_age_group = $this->_select_max_age_group( $arr_personal );
	
	if(is_array($arr_max_age_group) )
		foreach( $arr_personal as $key => $row ) 
	{
		if( is_object($row) ){
			$row = (array)$row;
		}
	
		$row = new EUI_Object( $row );
		$spl = Spliter($row->get_value('GroupPremi'), "_", array('GroupPremi', 'enum'));
		
		if( is_array( $arr_max_age_group ) 
			AND in_array($spl->get_value('GroupPremi'), $arr_group)	
			AND in_array($spl->get_value('GroupPremi'),$arr_max_age_group) ) 
		{
			$obPremi = $obClass->_select_personal_premi(array (
				'PersonalAge'=> $row->get_value('PersonalAge','strval'),	
				'GroupPremi' => $spl->get_value('GroupPremi','strval'),
				'ProductId' => $row->get_value('ProductId','strval'),
				'GenderId' => $row->get_value('GenderId','strval'),
				'PayMode' => $row->get_value('PayMode','strval'),
				'PlanId' => $row->get_value('PlanId','strval'),
				'PremiTypeId' => $out->get_value('personal_premi')
			));
			
			$PolicyTotalDiscount = 0;
				$PolicyPremiPolicy  = 0;
				$PolicyPremiDiscount = 0;
				$PolicyPremiAfterDiscount = 0;
				
				
			$PolicyTotalDiscount = $arr_total_discount;
			$PolicyPremiPolicy = $obPremi->get_value('ProductPlanPremium','intval');
			
			$PolicyPremiDiscount = (($PolicyPremiPolicy * $PolicyTotalDiscount)/100);
			$PolicyPremiAfterDiscount = ($PolicyPremiPolicy - $PolicyPremiDiscount);
			
			$arr_cond[$key] = array( 
				'GroupPremi' => $key, 
				'PremiPerson' => $PolicyPremiPolicy, 
				'PremiDiscount' => $PolicyPremiDiscount,
				'PremiAfterDiscount'=> $PolicyPremiAfterDiscount,
				'PremiTotalDiscount' => $PolicyTotalDiscount
			);
		
		} else{ 
			$arr_cond[$key]= array( 
				'GroupPremi' => $key, 
				'PremiPerson' => 0 , 
				'PremiDiscount' => 0,
				'PremiAfterDiscount'=> 0,
				'PremiTotalDiscount' => 0,
			);
		}
	} 
 }
 
 // ===================== END :: GROUP PREMI ==================================================
 
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
		if( $out->get_value('GroupPremi') == 1 )
		{
			$Month = (int)$arr_selector['months_total'];
			$Day = (int)$arr_selector['days_total'];
			$years = $arr_selector['years'];
			if( $years == 0 )
			{
				if( $Month >=6 ){
					$float_value = ($Month/12);
					$years = number_format($float_value, 1);	
				} else{
					$years = 0;
				}	
			}
			 else {
				if( $years > 22 )
				{
					$years = 0;
				}
			
			}
			
			return $years;
			
		} else {
			$Month = (int)$arr_selector['months_total'];
			$Day = (int)$arr_selector['days_total'];
			$years = $arr_selector['years'];
			
			return (int)$years;
		}	
	}
	
	return $years;
	
	
	
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
	$obClass->_set_row_deleted_policy_discount( $out ); 
	echo json_encode( array('success' => 1, 'PolicyNumber' => $PolicyNumber ) );
    return FALSE;
 }	 
 
 echo json_encode( $cond );
   
}

 // ===================== END CLASS =============================================
}
?>