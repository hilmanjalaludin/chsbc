<?php
 class M_ModViewPlan extends EUI_Model 
{
	
 private $set_limit_page = 10;
 
// ------------------------------------------------------------------------------- 
  private static $Instance   = null; 
  public static function &Instance()
 {
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
 }
 
// ------------------------------------------------------------------------------- 
 
function __construct() 
{
	
	//$this -> load -> model(base_class_model($this));	
}	

/* @ def 	: index 
 * -------------------------------------
 *
 */

  public function _get_default()
{
  $this->EUI_Page->_setPage( $this->set_limit_page ); 
  $this->EUI_Page->_setSelect("a.ProductId", FALSE);
  $this->EUI_Page->_setFrom("t_gn_product a", TRUE);
  return $this->EUI_Page;
  
}
  
/* @ def 	: Content 
 * -------------------------------------
 *
 */
  
 public function _get_content()
{
	$this->EUI_Page->_postPage(_get_post('v_page'));
	$this->EUI_Page->_setPage($this->set_limit_page);
	
  // --------------- set query  --------------------------
	
	$this->EUI_Page->_setArraySelect(array(
		"a.ProductId As ProductId "=> array("ProductId","ProductId", "primary"), 
		"a.ProductCode As ProductCode" => array("ProductCode","Product Code"), 
		"a.ProductName As ProductName" => array("ProductName", "Product Name"),
		"b.PrefixMethod As PrefixMethod" => array("ProductName", "Method"), 
		"b.PrefixLength As PrefixLength" => array("PrefixLength", "Length"), 
		"b.PrefixChar As PrefixChar" => array("PrefixChar", "Char"),
		"CASE WHEN (a.ProductStatusFlag=1) THEN 'Active' ELSE 'Not Active' END As StatusFlags" => array("StatusFlags", "Status")
		
	));
	
	$this->EUI_Page->_setFrom("t_gn_product a"); 
	$this->EUI_Page->_setJoin("t_gn_productprefixnumber b", "a.ProductId=b.ProductId", "LEFT", true);
	 if( _get_have_post('order_by'))
	{
		$this->EUI_Page->_setOrderBy(_get_post('order_by'),_get_post('type'));
	}
	else{
		$this->EUI_Page->_setOrderBy('a.ProductId','DESC');
	}
	
	$this->EUI_Page->_setLimit();
}

/*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_resource()
 {
	self::_get_content();
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_page_number() 
 {
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
  
 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
public function _select_row_product_name( $ProductId = 0 ) {
	$out = new EUI_Object(Product());
	return ucwords(strtolower($out->get_value( $ProductId)));
} 

 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public function _set_row_product_active( $ProductId= 0 , $Status = 0 )
{
 
 $this->db->reset_write();
 $this->db->where("ProductId", $ProductId);
 $this->db->set("ProductStatusFlag", $Status);
 if( $this->db->update("t_gn_product") )
 {
	return true;
 } 
return false;
}	
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 public function _select_row_ref_product( $ProductId=0 )
{


// ------------------ reset select ---------------------------
 $arr_ref_product = array();
 $arr_ref_object  = array();
  
 // ------------------ reset select ---------------------------
 $this->db->reset_select();
 $this->db->select("*", FALSE);
 $this->db->from("t_gn_product a ");
 $this->db->join("t_gn_productprefixnumber b", "a.ProductId=b.ProductId", "LEFT");
 $this->db->where("a.ProductId", $ProductId);
 $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
 {
	 foreach( $rs->result_first_assoc() as $sf => $sv ){
		$arr_ref_object[$sf] = $sv; 
	 }
  }
 
 
 // ------------------ reset select ---------------------------
 $this->db->reset_select();
 $this->db->select(" 
		MIN(a.ProductPlanAgeStart) as start, 
		MAX(a.ProductPlanAgeEnd) as end ", FALSE);
 $this->db->from("t_gn_productplan a ");		
 $this->db->where("a.ProductId", $ProductId);

 $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
 {
	 foreach( $rs->result_first_assoc() as $sf => $sv ){
		$arr_ref_object[$sf] = $sv; 
	 } 
	
 }
 
 // ----- to object -------------------
 $arr_ref_product['Product'] = new EUI_Object($arr_ref_object);
 
 $this->db->reset_select();
 $this->db->select("b.ProductTypeId, b.ProductFormJs", false);
 $this->db->from("t_gn_product a ");
 $this->db->join("t_lk_producttype b ","a.ProductTypeId=b.ProductTypeId", "LEFT");
 $this->db->where("a.ProductId", $ProductId);
 $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
	  foreach( $rs->result_assoc() as $rows )
 {
	$arr_ref_product['ProductType'][$rows['ProductTypeId']] = $rows['ProductFormJs'];
 }

 //print_r($arr_ref_product);
// --------------------------------------------------------------- 
 
 $this->db->reset_select();
 $this->db->select("b.PayModeId, b.PayMode", false);
 $this->db->from("t_gn_productplan a ");
 $this->db->join("t_lk_paymode b "," a.PayModeId=b.PayModeId", "LEFT");
 $this->db->where("a.ProductId", $ProductId);

 $this->db->group_by("b.PayModeId");
 $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
	  foreach( $rs->result_assoc() as $rows )
 {
	$arr_ref_product['PaymentType'][$rows['PayModeId']] = $rows['PayMode'];
 }
 
 // ------------------ reset select ---------------------------
 $this->db->reset_select();
 $this->db->select("b.PremiumGroupId, b.PremiumGroupDesc ");
 $this->db->from("t_gn_productplan a ");
 $this->db->join("t_lk_premiumgroup b ","a.PremiumGroupId = b.PremiumGroupId", "LEFT");
 $this->db->where("a.ProductId", $ProductId);
 $this->db->group_by("b.PremiumGroupId");
 $this->db->order_by("b.PremiumGroupOrder", "ASC");
 
 $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
	  foreach( $rs->result_assoc() as $rows )
 {
	$arr_ref_product['GroupPremi'][$rows['PremiumGroupId']] = $rows['PremiumGroupDesc'];
 }
 
 
// ------------------ reset select ---------------------------
 $this->db->reset_select();
 $this->db->select("b.GenderId, b.Gender");
 $this->db->from("t_gn_productplan a ");
 $this->db->join("t_lk_gender b ","a.GenderId= b.GenderId", "LEFT");
 $this->db->where("a.ProductId", $ProductId);
 $this->db->group_by("b.GenderId");
 $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
	  foreach( $rs->result_assoc() as $rows )
 {
	$arr_ref_product['Gender'][$rows['GenderId']] = $rows['Gender'];
 }

 // ------------------ reset select ---------------------------
 $this->db->reset_select();
 $this->db->select("a.ProductPlan, a.ProductPlanName");
 $this->db->from("t_gn_productplan a ");
 $this->db->where("a.ProductId", $ProductId);
 $this->db->group_by("a.ProductPlan");
 $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
	  foreach( $rs->result_assoc() as $rows )
 {
	$arr_ref_product['PlanName'][$rows['ProductPlan']] = $rows['ProductPlanName'];
 }
  
// ------------------ reset select ---------------------------
 $this->db->reset_select();
 $this->db->select("a.ProductPlanAgeStart, a.ProductPlanAgeEnd, a.ProductPlanPremium, a.ProductId", FALSE);
 $this->db->from("t_gn_productplan a ");
 $this->db->where("a.ProductId", $ProductId);
 
 
 
 $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
	  foreach( $rs->result_assoc() as $rows )
 {
	$arr_ref_product['ProductAge'][$rows['ProductPlanAgeStart']] = array(
		'start' => $rows['ProductPlanAgeStart'],
		'end' => $rows['ProductPlanAgeEnd'],
		'ProductId' => $rows['ProductId']
	);
 }
 return new EUI_Object($arr_ref_product);
 
} 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 
 public function _update_row_product_label( $out = null )
{
 $cond  = 0 ;	
 if( !is_object($out) or !$out->fetch_ready() )	{
	 return false;
 }
 
 $ProductName = $this->_select_row_product_name($out->get_value('ProductId'));
  if( strlen($ProductName) )
 {
	EventLoger("UPD", array("Update Label Plan On Product", $ProductName ));	
 }
 
 // ----------- nthen update --------------
  $arr_lbl = $out->fetch_label();
   if(is_array( $arr_lbl )) 
	   foreach( $arr_lbl as $key => $svf )
  {
	$val =& Spliter($svf, "_", array('index', 'ProductPlan'));
	 if( in_array( $val->get_value('index'), array('label') ))
	{
	
		// ----------- update premi on here  -----------------
		$this->db->reset_write();
		$this->db->set("ProductPlanName", $out->get_value($svf,'strval') );
		$this->db->where("ProductPlan",$val->get_value('ProductPlan', 'intval'));
		$this->db->where("ProductId", $out->get_value('ProductId', 'intval'));
		if( $this->db->update("t_gn_productplan") ){
			$cond++;
		}
	}	
  }
  
  return $cond;
  
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 
 public function _update_row_product_premi( $out = null )
{
  if( is_object($out) AND !$out->fetch_ready() ) {
	  return FALSE;
  }
  
  
  $cond = 0 ;
  $arr_sfl = $out->fetch_label();
  if( is_array($arr_sfl) ) 
	  foreach( $arr_sfl as $sf => $sv )
  {
	  $val =& Spliter($sv, "_", array('index', 'ProductPlanId'));
	   if( in_array($val->get_value('index'), array('row')) )
	  {
	// ----------- update premi on here  -----------------
		$this->db->reset_write();
		$this->db->set("ProductPlanPremium", $out->get_value($sv,'_setDecimal'));
		$this->db->where("ProductPlanId",$val->get_value('ProductPlanId', 'intval'));
		$this->db->where("ProductId", $out->get_value('ProductId', 'intval'));
		if( $this->db->update("t_gn_productplan") ){
			$cond++;
		}
	  }	  
  } 
  
  return $cond;
  
  //$out->debug_label();
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 public function _select_row_product_premi( $out = null )
{
 $out = new EUI_Object($out);	
 $arr_row_data = array();
 if( !$out->fetch_ready() ){
	return false;
}

// ---------------- set select -----------------------------
	
 $this->db->reset_select();   
 $this->db->select("a.ProductPlanId, a.ProductPlanPremium", FALSE);
 $this->db->from("t_gn_productplan a ");
 $this->db->where("a.ProductId", $out->get_value('ProductId','intval'));
 $this->db->where("a.PremiumGroupId", $out->get_value('PremiumGroupId','intval'));
 $this->db->where("a.PayModeId", $out->get_value('PayModeId','intval'));
 $this->db->where("a.ProductPlan", $out->get_value('ProductPlan','intval'));
 $this->db->where("a.GenderId", $out->get_value('GenderId','intval'));
 $this->db->where("a.ProductPlanAgeStart", $out->get_value('ProductPlanAgeStart','strval'));
 $this->db->where("a.ProductPlanAgeEnd", $out->get_value('ProductPlanAgeEnd','strval'));
 ///$this->db->print_out();
 
 $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
 {
	 $row = new EUI_Object( $rs->result_first_assoc() );
	 $arr_row_select = array
	(
		'ProductPlanId' => $row->get_value('ProductPlanId','strval'),
		'ProductPlanPremium' => $row->get_value('ProductPlanPremium','strval')
	);
 }
 return new EUI_Object( $arr_row_select );
 
} 
/* @ def 	: Content 
 * -------------------------------------
 *
 */
 
 ////////////////// ============= END CLASS ====================================
}
?>