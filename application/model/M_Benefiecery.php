<?php
/*
 * @ def 		: M_Benefiecery
 * -----------------------------------------
 *
 * @ params  	: -
 * @ params 	: -
 */	
 
class M_Benefiecery extends EUI_Model
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
	
 
public function _getFilterDate() 
{
	$filters = array('BeneficiaryDOB' => 'BeneficiaryDOB' );
	return $filters;
}

/*
 * @ def 		: fn : getBeneficiaryInsuredId
 * -----------------------------------------
 *
 * @ params  	: InsuredId ( INT )
 * @ params 	: -
 */	
 
public function _getFilterField() 
{
	$filters = array(
		'InsuredRelationshipTypeId' => 'RelationshipTypeId',
		'InsuredGenderId' => 'GenderId',
		'InsuredGroupPremi' => 'PremiumGroupId',
		'InsuredSalutationId' => 'SalutationId'
	);
	
	return $filters;
}

/*
 * @ def 		: fn : getBeneficiaryInsuredId
 * -----------------------------------------
 *
 * @ params  	: InsuredId ( INT )
 * @ params 	: -
 */	
 
 public function _getBeneficiaryField() 
 {
	return $this->db->list_fields('t_gn_beneficiary');
 }
 

/*
 * @ def 		: fn : getBeneficiaryInsuredId
 * -----------------------------------------
 *
 * @ params  	: InsuredId ( INT )
 * @ params 	: -
 */	
 

 public function _SaveDataBeneficiary($Beneficiary = array() )
 {
	$_conds = 0;
	$clear_leaves = array();
  
  // filter map with parameter 
  
	$filters = $this->_getFilterField();
	if(is_array($Beneficiary))foreach( $Beneficiary as $ky => $fs ) 
	{
		if( in_array($ky, array_keys($filters)) )
			$clear_leaves[$filters[$ky]] = $fs; 
		else 
		{
			$filter_dates = $this -> _getFilterDate();
			if( in_array($ky,array_keys($filter_dates)))
				$clear_leaves[$ky] = $this -> EUI_Tools -> _date_english($fs);
			else {
				$clear_leaves[$ky] = $fs;
			}	
		}
	}
	
	// filter map with columns 
	
	$fields = $this->_getBeneficiaryField();
	
	if(is_array($clear_leaves) ) foreach( $fields as $key => $values ) 
	{
		if( in_array( $values, array_keys($clear_leaves))) 
		{
			if( !empty($clear_leaves[$values]) ){
				$this -> db -> set($values, $clear_leaves[$values]);		
				$this -> db -> where($values,$clear_leaves[$values]);
			}
		}
	}
	
	$this -> db -> insert('t_gn_beneficiary');
	$this -> db -> last_query();
	
	if($this -> db ->affected_rows() > 0 ){
		$_conds++;
	}	
	
	return $_conds;
 }
 

 
 
/*
 * @ def 		: fn : _UpdateDataBeneficiary
 * -----------------------------------------
 *
 * @ params  	: Beneficiary ( INT )
 * @ params 	: -
 */	
 

 public function _UpdateDataBeneficiary($Beneficiary = array() )
 {
	$_conds = 0;
	$clear_leaves = array();
  
  // filter map with parameter 
  
	$filters = $this->_getFilterField();
	if(is_array($Beneficiary))foreach( $Beneficiary as $ky => $fs ) 
	{
		if( in_array($ky, array_keys($filters)) )
			$clear_leaves[$filters[$ky]] = $fs; 
		else 
		{
			$filter_dates = $this -> _getFilterDate();
			if( in_array($ky,array_keys($filter_dates)))
				$clear_leaves[$ky] = $this -> EUI_Tools -> _date_english($fs);
			else {
				$clear_leaves[$ky] = $fs;
			}	
		}
	}
	
	// filter map with columns 
	
	$fields = $this->_getBeneficiaryField();
	
	if(is_array($clear_leaves) ) foreach( $fields as $key => $values ) 
	{
		if( in_array( $values, array_keys($clear_leaves))) 
		{
			if( !empty($clear_leaves[$values]) ){
				$this -> db -> set($values, $clear_leaves[$values]);		
			}
		}
	}
	
	$this -> db -> where('BeneficiaryId',$clear_leaves['BeneficiaryId']);
	$this -> db -> update('t_gn_beneficiary');
	if($this -> db ->affected_rows() > 0 ){
		$_conds++;
	}	
	
	return $_conds;
 }
 
/*
 * @ def 		: fn : getBeneficiaryInsuredId
 * -----------------------------------------
 *
 * @ params  	: InsuredId ( INT )
 * @ params 	: -
 */	
 
 public function _getBeneficiaryInsuredId( $InsuredId = '' ) 
 {
		$Beneficiary = array();
		$this -> db ->select
		("
			a.BeneficiaryId, a.BeneficiaryFirstName, 
			a.SalutationId, a.GenderId, 
			a.BeneficiaryDOB, a.BeneficieryPercentage,
			a.RelationshipTypeId, b.GenderId as InsuredGender, 
			b.SalutationId as InsuredSalutationId,  b.InsuredFirstName,  
			a.BeneficiaryAge,
			b.InsuredLastName, b.InsuredDOB
		");
			
		$this -> db ->from("t_gn_beneficiary a");
		$this -> db ->join("t_gn_insured b "," a.insuredid=b.insuredid","LEFT");
		$this -> db ->where("a.InsuredId",  $InsuredId);
		
		foreach( $this -> db ->get() ->result_assoc() as $rows ) {
			$Beneficiary[$rows['BeneficiaryId']] = $rows;
		}
		
		return $Beneficiary;
	}
	
/*
 * @ def 		: fn : getBeneficiaryCustomerId
 * -----------------------------------------
 *
 * @ params  	: CustomerId ( INT )
 * @ params 	: -
 */	
 
  public function _getBeneficiaryCustomerId( $CustomerId = '' ) 
 {
		$Beneficiary = array();
		$this->db->reset_select();
		$this->db->select("
			a.BeneficiaryId, 
			a.BeneficiaryFirstName, 
			a.SalutationId, 
			a.GenderId, 
			a.BeneficiaryDOB, 
			a.BeneficieryPercentage,
			a.RelationshipTypeId, 
			a.BeneficiaryAge,
			a.GenderId", 
		FALSE);
			
		$this->db->from("t_gn_beneficiary a");
		$this->db->where("a.customerid",  $CustomerId);
		foreach( $this -> db ->get() ->result_assoc() as $rows ) {
			$Beneficiary[$rows['BeneficiaryId']] = $rows;
		}
		
		return (array)$Beneficiary;
		

	}

	
}
?>