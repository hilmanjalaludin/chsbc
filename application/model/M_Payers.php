<?php
class M_Payers extends EUI_Model
{
 
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */ 

 
private static $Instance  = null;	
	
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */ 
 function __construct() { }

	
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 public static function &Instance()
{
	if( is_null(self::$Instance) )
 {
	self::$Instance = new self();
 }
  return  self::$Instance;
 
}
	
 
/*
 * @ def    : get payer data from customer table not in transaction
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 */
 	
 private function _getPayerField() 
 {
	return $this->db->list_fields('t_gn_payer');
 }
 
 
/*
 * @ def    : get payer data from customer table not in transaction
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 */
 
private function _getFilterDate() 
{
	$filters = array('PayerDOB' => 'PayerDOB' );
	return $filters;
}

/*
 * @ def    : get payer data from customer table not in transaction
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 */

private function _getFilterField() 
{
	$filters = array(
		'PayerIdentificationTypeId' => 'IdentificationTypeId',
		'PayerGenderId' => 'GenderId',
		'PremiumGroupId' => 'PremiumGroupId',
		'PayerSalutationId' => 'SalutationId',
		'PayerProvinceId' =>'ProvinceId',
		'PayerOfficePhoneNum' => array('PayerOfficePhoneNum','PayerWorkPhoneNum'),
		'CreditCardTypeId' => array('PaymentTypeId','CreditCardTypeId'),
		'OptOut' => 'PayerOptOut'
	);
	
	return $filters;
}

/*
 * @ def    : get payer data from customer table not in transaction
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 */
 
public function _getCountPayer($CustomerId=0)
{
	$_conds = 0;
	
	$sql = " select count(a.PayerId) as Qty from t_gn_payer a where a.CustomerId= '{$CustomerId}' ";
	$qry = $this -> db->query($sql);
	if( $rows = $qry -> result_first_assoc() ) {
		$_conds =(INT)$rows['Qty']; 
	}
	
	return $_conds;
}




/*
 * @ def    : get payer data from customer table not in transaction
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 */
 
private function _getPayerExist($CustomerId=0)
{
	$_payers = array();
	
	$sql = " select a.* from t_gn_payer a where a.CustomerId= '{$CustomerId}' ";
	$qry = $this -> db->query($sql);
	foreach( $qry -> result_first_assoc() as $key => $values ){
		$_payers[$key] = $values; 
	}
	
	return $_payers;
}


/*
 * @ def    : get payer data from customer table not in transaction
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 */
 
public function _getPayerNotExist($CustomerId=0)
{
	$_payers = array();
	
	$this->db->reset_select();
	$this->db->select('*', false);
	$this->db->from('t_gn_customer a');
	$this->db->where('a.CustomerId',$CustomerId);
	
	if( $rows = $this -> db->get()->result_first_assoc() )
	{
		$_payers['PayerMobilePhoneNum']= NULL;
		$_payers['PayerMobilePhoneNum2']= NULL;
		$_payers['PayerHomePhoneNum'] = NULL;
		$_payers['PayerHomePhoneNum2'] = NULL;
		$_payers['PayerOfficePhoneNum']= NULL;
		$_payers['PayerOfficePhoneNum2']= NULL;
		
		$_payers['SalutationId'] = $rows['SalutationId'];
		$_payers['PayerFirstName'] = $rows['CustomerFirstName'];
		$_payers['PayerLastName'] = $rows['CustomerLastName'];
		$_payers['GenderId'] = $rows['GenderId'];
		$_payers['PayerDOB'] = $rows['CustomerDOB'];
		$_payers['PayerCityRead'] = $rows['CustomerAddressLine1'].' '.
									$rows['CustomerAddressLine2'].' '.
									$rows['CustomerAddressLine3'].' '.
									$rows['CustomerAddressLine4'].' '.
									$rows['CustomerCity'];

		$_payers['PayerAddressLine1'] = NULL;
		$_payers['PayerAddressLine2'] = NULL;
		$_payers['PayerAddressLine3'] = NULL;
		$_payers['PayerAddressLine4'] = NULL;
		$_payers['PayerCity'] = NULL;
		
		// $_payers['PayerAddressLine1'] = $rows['CustomerAddressLine1'];
		// $_payers['PayerAddressLine2'] = $rows['CustomerAddressLine2'];
		// $_payers['PayerAddressLine3'] = $rows['CustomerAddressLine3'];
		// $_payers['PayerAddressLine4'] = $rows['CustomerAddressLine4'];
		$_payers['IdentificationTypeId'] = $rows['IdentificationTypeId'];
		$_payers['PayerIdentificationNum'] = $rows['CustomerIdentificationNum'];
		// $_payers['PayerCity'] = $rows['CustomerCity'];
		$_payers['PayerZipCode'] = $rows['CustomerZipCode'];
		$_payers['PayerProvinceId'] = $rows['ProvinceId'];
		$_payers['CreditCardTypeId'] = $rows['CardTypeId'];
		$_payers['PayerEmail'] = $rows['CustomerEmail'];
		$_payers['PayerCreditCardNum'] = ($rows['CustomerCreditCardNum'] ? $rows['CustomerCreditCardNum'] : '');
		$_payers['PayerFaxNum'] = '';
		$_payers['PayerAddrType'] = '1';
		$_payers['PayerAge'] = 0;
		$_payers['PayerCreditCardExpDate'] = $rows['CustomerCreditCardExpDate'];
		$_payers['PayersBankId'] = '0';
	}	
	
	return $_payers;
}




/*
 * @ def    : get payer data from customer table not in transaction
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 */
 
 function _getAddPayers($CustomerId=0)
 {
	$Qty = $this ->_getCountPayer($CustomerId);
	$_payers = array();
	if( $Qty !=FALSE )
		$_payers = $this -> _getPayerExist($CustomerId);
	else
		$_payers = $this -> _getPayerNotExist($CustomerId);
		
	return $_payers;
 }
 
/*
 * @ def    : save data payers in sale
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 */
 
 function _UpdateDataPayers( $out  = null )
{
  if( !is_object($out) ){ 
	return FALSE; 
  }
  
  $PayerId = $out->get_value('PayerId', 'intval');
  if( !$PayerId ){
	return FALSE;
  }	  
  
 // -------------------- update data payer ------------------------------------------
 
  $this->db->reset_write();
  $this->db->where("PayerId",$PayerId);
  $this->db->set("PayerFirstName",$out->get_value('PayerFirstName','strtoupper'));
  $this->db->set("PayerAddrType",$out->get_value('PayerAddrType','strtoupper'));
  $this->db->set("ProvinceId",$out->get_value('PayerProvinceId','strtoupper'));
  $this->db->set("PayerAddressLine1",$out->get_value('PayerAddressLine1','strtoupper'));
  $this->db->set("PayerAddressLine2",$out->get_value('PayerAddressLine2','strtoupper'));
  $this->db->set("PayerAddressLine3",$out->get_value('PayerAddressLine3','strtoupper'));
  $this->db->set("PayerCity",$out->get_value('PayerCity','strtoupper'));
  $this->db->set("PayerZipCode",$out->get_value('PayerZipCode','strtoupper'));
  $this->db->set("PayerAge",$out->get_value('PayerAge','strval'));
  $this->db->set("PayerDOB",$out->get_value('PayerDOB','_getDateEnglish'));
  $this->db->set("PayerIdentificationNum",$out->get_value('PayerIdentificationNum','strval'));
  $this->db->set("PayerMobilePhoneNum",$out->get_value('PayerMobilePhoneNum','strval'));
  $this->db->set("PayerMobilePhoneNum2",$out->get_value('PayerMobilePhoneNum2','strval'));
  $this->db->set("PayerHomePhoneNum2",$out->get_value('PayerHomePhoneNum2','strval'));
  $this->db->set("PayerOfficePhoneNum",$out->get_value('PayerOfficePhoneNum','strval'));
  $this->db->set("PayerOfficePhoneNum2",$out->get_value('PayerOfficePhoneNum2','strval'));
  $this->db->set("PayerFaxNum",$out->get_value('PayerFaxNum','strval'));
  $this->db->set("PayerEmail",$out->get_value('PayerEmail','strval'));
  $this->db->set("PayerZipCode",$out->get_value('PayerZipCode','strval'));
  $this->db->set("SalutationId",$out->get_value('PayerSalutationId','strval'));
  $this->db->set("GenderId",$out->get_value('PayerGenderId','strval'));
  $this->db->set("IdentificationTypeId",$out->get_value('PayerIdentificationTypeId','strval'));
  $this->db->set("PayerPreferedComunication",$out->get_value('PayerPreferedComunication','strval'));
  $this->db->set("PayerUpdatedTs",date('Y-m-d H:i:s'));
  $this->db->set("UpdatedById",_get_session('UserId'));
  
   if( $this->db->update("t_gn_payer") ) 
  {
	  
	  return true;
  }
  
 // echo $this->db->last_query();
  
  return false;
  
} 
// ----------------------------------------------------------------------- 
/*
 * @ def    : save data payers in sale
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 */
 
 function _SaveDataPayers( $_payers = null )
 {
	$_conds = 0;
	$clear_leaves = array();
  
  // filter map with parameter 
  
	$filters = $this->_getFilterField();
	if(is_array($_payers))foreach( $_payers as $ky => $fs ) 
	{
		if( in_array($ky, array_keys($filters)) )
		{
			if( is_array($filters[$ky]) )
			{
				foreach( $filters[$ky] as $fld => $fld_values )
				{
					$clear_leaves[$fld_values] = $fs; 
				}
			}
			else{
				$clear_leaves[$filters[$ky]] = $fs; 
			}
		}	
		else {
			$filter_dates = $this -> _getFilterDate();
			if( in_array($ky,array_keys($filter_dates)))
				$clear_leaves[$ky] = $this -> EUI_Tools -> _date_english($fs);
			else {
				$clear_leaves[$ky] = $fs;
			}	
		}
	}
	
	// filter map with columns 
	
	$fields = $this->_getPayerField();
	
	if(is_array($clear_leaves) ) foreach( $fields as $key => $values ) 
	{
		if( in_array( $values, array_keys($clear_leaves))) 
		{
			if( !empty($clear_leaves[$values]) ){
				$this -> db -> set($values, $clear_leaves[$values]);		
			}
		}
	}
	
	$this -> db -> insert('t_gn_payer');
	if( $this -> db ->affected_rows() > 0 ){
		$_conds++;
	}
	else 
	{
		// update if dulicate 
		if(is_array($clear_leaves) ) foreach( $fields as $key => $values ) 
		{
			if( in_array( $values, array_keys($clear_leaves))) 
			{
				if( !empty($clear_leaves[$values]) ){
					$this -> db -> set($values, $clear_leaves[$values]);		
				}
			}
		}
		
		$this->db->where('CustomerId',$clear_leaves['CustomerId']);
		$this->db->update('t_gn_payer');
		$_conds++;
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
 public function _getPayerReady($where = array() )
 {
	$_payers = array();
	
    if( is_array($where)) $this -> db -> where($where);
	else {
		$this -> db -> where('CustomerId', $where);
	}
	
	$this -> db -> select('*');
	$this -> db -> from('t_gn_payer a');
	if( $rows_result_value = $this -> db -> get()-> result_first_assoc() )
	{
		$_payers = $rows_result_value;
	}
	
	return $_payers;

 }
 
 /*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 public function _getPayersInformation($where = array() )
 {
	$_payers = array();
	
	$this->db->reset_select();
	$this->db->select(" 
			b.PolicyNumber, a.PolicySalesDate, 
			b.ProductId as ProductId, 
			a.PolicyEffectiveDate, c.ProductName, 
			e.CampaignName,f.full_name ,f.UserId" );
				
	$this->db->from('t_gn_policy a');
	$this->db->join("t_gn_policyautogen b ", "a.PolicyNumber=b.PolicyNumber","LEFT");
	$this->db->join("t_gn_product c "," b.ProductId=c.ProductId","LEFT");
	$this->db->join("t_gn_customer d "," b.CustomerId=d.CustomerId","LEFT");
	$this->db->join("t_gn_campaign e "," d.CampaignId=e.CampaignId","LEFT");
	$this->db->join("tms_agent f "," d.SellerId=f.UserId","LEFT");

    if( is_array($where)) {
		$this->db->where($where);
	}		
	else {
		$this->db->where('b.CustomerId', $where);
	}
	
	//echo $this->db->_get_var_dump();
	
	if( $rows_result_value = $this -> db -> get()-> result_first_assoc() ) {
		$_payers = $rows_result_value;
	}
	
	return (array)$_payers;

 }
 
 
}
?>