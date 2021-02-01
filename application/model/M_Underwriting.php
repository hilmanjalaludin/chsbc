<?php

class M_Underwriting extends EUI_Model
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


// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		-----------------< comment on here >
 */
 
 protected function _select_underwriting_chosed( $ProductId = 0, $CustomerId = 0, $UnderwritingCode ='', $InsuredId = 0)
{
  $arr_under_writing = null;
  
  $this->db->reset_select();
  $this->db->select("a.UWAnswer");
  $this->db->from("t_gn_underwriting_answer a ");
  $this->db->where("a.UWProductId",$ProductId);
  $this->db->where("a.UWCustomerId",$CustomerId); 
  $this->db->where("a.UWCode", $UnderwritingCode); 
   if( $InsuredId > 0 )
  {
	$this->db->where("a.UWInsuredId", $InsuredId );   
  }
  
  $rs = $this->db->get();
 if( $rs->num_rows() >  0 ) 
{
	$arr_under_writing = (string)$rs->result_singgle_value();
 }	
 return $arr_under_writing;
 
 
}
 
// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		-----------------< comment on here >
 */

 protected function  _select_chose_type( $code = '' )
{
	$array_select = array
	(
		'01' => array(
			'type' => 'checkbox',
			'value' => array('Y' => 'YES','N' => 'NO')
		),
		
		'02' => array(
			'type' => 'BMI',
			'value' => array()
			
		),

		'03' => array(
			'type' => 'textarea',
			'value' => null
		),
		
		'04' => array(
			'type' => 'listcombo',
			'value' => array()
		)
	);
	
	if( isset( $array_select[$code] ) ){
		return (array)$array_select[$code];
	} else {
		return null;
	}
}
 
// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		-----------------< comment on here >
 */
 public function _getUnderwriting( $ProductId=0, $CustomerId  = 0, $InsuredId = 0  ) 
{
	
 $arr_under_writing = array();
 $this->db->reset_select();
 $this->db->select("a.UnderwritingCode, a.SeqNo, a.NodeId, b.QuestionText, b.QuestionProductType, d.*", FALSE);
 $this->db->from("t_gn_underwriting_product  a");
 $this->db->join("t_lk_underwriting b ","a.UnderwritingCode=b.QuestionCode", "LEFT");
 $this->db->join("t_gn_product c "," a.ProductCode=c.ProductCode", "INNER");
 $this->db->join("t_lk_underwriting_type d "," b.QuestionProductType=d.TypeId", "LEFT");
 $this->db->where("c.ProductUWFlag",1);
 $this->db->where("c.ProductId", $ProductId);
 $rs = $this->db->get();
 if( $rs->num_rows() >  0 ) 
	foreach( $rs->result_assoc() as $rows )
 {
	$arr_under_writing[$rows['UnderwritingCode']]  = array (
		'description' => $rows['QuestionText'],
		'type' 	 => $rows['QuestionProductType'],
		'NodeSeqNo' => "{$rows['SeqNo']}",
		'NodeClass' => "node-{$rows['NodeId']}",
		'form'   => self::_select_chose_type( $rows['QuestionProductType'] ),
		'value'  => self::_select_underwriting_chosed( $ProductId, $CustomerId, $rows['UnderwritingCode'], $InsuredId)
	);
 }
 
 return (array)$arr_under_writing;
 
}


// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		-----------------< comment on here >
 */
 public function _getExitsUnderwriting( $ProductId=0, $CustomerId  = 0, $InsuredId = 0  ) 
{
  $arr_under_writing = 0;
  $this->db->reset_select();
  $this->db->select("count(a.UWAnswerId) as jumlah", FALSE);
  $this->db->from("t_gn_underwriting_answer a ");
  $this->db->where("a.UWInsuredId", $InsuredId);
  $this->db->where("a.UWCustomerId", $CustomerId);
  $this->db->where("a.UWProductId", $ProductId);
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 )
 {
	$arr_under_writing =(int)$rs->result_singgle_value(); 
  }
  
 return $arr_under_writing;
  
}

// not user for this _setSaveUnderwriting/

public function _setSaveUnderwriting( $p ) { 

}


}
?>