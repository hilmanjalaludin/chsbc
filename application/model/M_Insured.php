<?php
class M_Insured extends EUI_Model
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
	

/** set filtering data date **/

public function _getFilterDate() 
{
	$filters = array('InsuredDOB' => 'InsuredDOB' );
	return $filters;
}


/** set filtering data insured **/

public function _getFilterField() 
{
	$filters = array
	(
		'InsuredRelationshipTypeId' => 'RelationshipTypeId',
		'InsuredGenderId' => 'GenderId',
		'InsuredGroupPremi' => 'PremiumGroupId',
		'InsuredSalutationId' => 'SalutationId'
	);
	
	return $filters;
}

/** _getInsuredField **/
	
 public function _getInsuredField() 
 {
	return $this->db->list_fields('t_gn_insured');
 }
 
/** _getInsuredField **/

 public function _SaveDataInsured($Insured = array() )
 {
	$_conds = 0;
	$clear_leaves = array();
  
  // filter map with parameter 
  
	$filters = $this->_getFilterField();
	if(is_array($Insured))foreach( $Insured as $ky => $fs ) 
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
	
	$fields = $this->_getInsuredField();
	
	if(is_array($clear_leaves) ) foreach( $fields as $key => $values ) 
	{
		if( in_array( $values, array_keys($clear_leaves))) 
		{
			if( !empty($clear_leaves[$values]) ){
				$this -> db -> set($values, $clear_leaves[$values]);		
			}
		}
	}
	
	$this -> db -> insert('t_gn_insured');
	if($this -> db ->affected_rows() > 0 ){
		$_conds = $this ->db->insert_id();
	}	
	
	return $_conds;
 }
 
 

  
/** update insured **/

 public function _UpdateDataInsured( $out = null )
{
 if( !is_object($out) ){ return FALSE; }

 $InsuredId = $out->get_value('InsuredId', 'intval');
 if( !$InsuredId){
	 return false;
 }
 
// ----------- select ---------------
 
 $this->db->reset_write();
 $this->db->where("InsuredId",$InsuredId);
 $this->db->set("InsuredFirstName", $out->get_value('InsuredFirstName','strtoupper'));
 $this->db->set("InsuredUpdatedTs", date('Y-m-d H:i:s'));
 $this->db->set("UpdatedById",_get_session('UserId'));
  if( $this->db->update("t_gn_insured") )
 {
	return true;
 }
 return false;
 
}

 
 
/** get Insured **/
 function _getInsuredById($CustomerId)
 {
	$_conds = array();
	
	$this->db->reset_select();
	$this->db->select('a.InsuredId, 
			a.InsuredFirstName, a.InsuredDOB, 
			a.InsuredAge ,b.PolicyPremi, c.ProductPlanName,
			b.PolicyNumber,d.PremiumGroupDesc,
			e.PayMode, f.ProductName' );
			
	$this -> db ->from("t_gn_insured a"); 
	$this -> db ->join("t_gn_policy b ", "a.PolicyId=b.PolicyId","LEFT");
	$this -> db ->join("t_gn_productplan c", "b.ProductPlanId=c.ProductPlanId","LEFT");
	$this -> db ->join("t_lk_premiumgroup d", "c.PremiumGroupId=d.PremiumGroupId","LEFT");
	$this -> db ->join("t_lk_paymode e", "c.PayModeId=e.PayModeId","LEFT");
	$this -> db ->join("t_gn_product f", "c.ProductId=f.ProductId","LEFT");
	$this -> db ->where("a.CustomerId", $CustomerId);
	$this -> db ->order_by("d.PremiumGroupOrder","ASC");
	
	$rs = $this->db->get();
	$i = 0;
	if( $rs -> num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $rows )
	{
		$_conds[$i] = $rows; 
		$i++;
	}	
	
	return (array)$_conds;

 }	
 
 
/** set filtering data insured **/
 
 public function _getInsureId($InsuredId) 
 {
	$_conds = array();
	
	$this -> db ->select('*' );
			
	$this -> db ->from("t_gn_insured a"); 
	$this -> db ->join("t_gn_policy b ", "a.PolicyId=b.PolicyId","LEFT");
	$this -> db ->join("t_gn_productplan c", "b.ProductPlanId=c.ProductPlanId","LEFT");
	$this -> db ->join("t_lk_premiumgroup d", "c.PremiumGroupId=d.PremiumGroupId","LEFT");
	$this -> db ->join("t_lk_paymode e", "c.PayModeId=e.PayModeId","LEFT");
	$this -> db ->join("t_gn_product f", "c.ProductId=f.ProductId","LEFT");
	$this -> db ->where("a.InsuredId", $InsuredId);
	$this -> db ->order_by("d.PremiumGroupOrder","ASC");
	
	//echo $this -> db -> _get_var_dump();
	
	$i = 0;
	foreach($this -> db ->get() ->result_assoc() as $rows ){
		$_conds = $rows; 
		$i++;
	}
	
	return $_conds;

 }	 
 
 
}
?>