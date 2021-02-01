<?php
/*
 * E.U.I 
 *
 
 * subject	: M_SetBenefit modul 
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Utility/
 */
 
class M_SetBenefit extends EUI_Model
{

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
 private static $Instance   = null; 
 public static function &Instance()
{
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
}
// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
function _get_default()
{
	$this->EUI_Page->_setPage(10); 
	$this->EUI_Page->_setSelect("distinct a.ProductPlanBenefitId");
	$this->EUI_Page->_setFrom("t_gn_productplanbenefit a ");
	$this->EUI_Page->_setJoin("t_gn_product b "," a.ProductId=b.ProductId","LEFT");
	$this->EUI_Page->_setJoin("t_lk_producttype e "," b.ProductTypeId=e.ProductTypeId","LEFT", TRUE);
	
// -------------- filter --------------------------------------------------------
	
	$this->EUI_Page->_setAndCache("a.ProductId","benef_product_id", true);
	$this->EUI_Page->_setLikeCache("a.ProductPlan","benef_plan_id", true);
	$this->EUI_Page->_setLikeCache("b.ProductName","benef_product_name", true);
	$this->EUI_Page->_setAndCache("a.ProductPlanBenefitStatusFlag","benef_status", true);
	
	return $this->EUI_Page;
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_content()
{
	
  $this->EUI_Page->_postPage(_get_post('v_page') );
  $this->EUI_Page->_setPage(10);
  $this->EUI_Page->_setArraySelect(array(
	"a.ProductPlanBenefitId as BenefitId" => array("BenefitId", "BenefitId", "primary"),
	"b.ProductCode as ProductCode" => array("ProductCode","Product Code"),
	"b.ProductName as ProductName" => array("ProductName","Product Name"),
	"a.ProductPlanBenefitDesc as BenefitDesc"=> array("BenefitDesc","Description"),
	"a.ProductPlanBenefit as Benefit"=> array("Benefit","Benefit"),
	"( select pl.ProductPlanName from t_gn_productplan pl where pl.ProductPlan = a.ProductPlan and pl.ProductId=a.ProductId LIMIT 1) as PlanName"=> array("PlanName","Plan Name"),
	"IF(a.ProductPlanBenefitStatusFlag = 1, 'Active', 'Not Active') as StatusFlag"=> array("StatusFlag","Status")
  ));
  
  $this->EUI_Page->_setFrom("t_gn_productplanbenefit a ");
  $this->EUI_Page->_setJoin("t_gn_product b "," a.ProductId=b.ProductId","LEFT");
  $this->EUI_Page->_setJoin("t_lk_producttype e "," b.ProductTypeId=e.ProductTypeId","LEFT", TRUE);
	
// ----------------- filter set data ------------------------------------------------
 
  $this->EUI_Page->_setAndCache("a.ProductId","benef_product_id", true);
  $this->EUI_Page->_setLikeCache("a.ProductPlan","benef_plan_id", true);
  $this->EUI_Page->_setLikeCache("b.ProductName","benef_product_name", true);
  $this->EUI_Page->_setAndCache("a.ProductPlanBenefitStatusFlag","benef_status", true);
	
// ----------- set order ------------------------------
	
  if(_get_have_post('order_by')) {
	$this->EUI_Page->_setOrderBy(_get_post('order_by'),_get_post('type'));
  } else{
	  $this->EUI_Page->_setOrderBy("a.ProductPlanBenefitId","DESC");
  }
  
 //echo $this->EUI_Page->_getCompiler();
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
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getProductPlan($ProductId =0 )
{
	$_conds = array();
	$this -> db -> select('a.ProductPlan, a.ProductPlanName');
	$this -> db -> from('t_gn_productplan a');
	$this -> db -> where('a.ProductId',$ProductId);
	$this -> db -> group_by('a.ProductPlan');
	foreach( $this -> db -> get() -> result_assoc() as $rows )
	{
		$_conds[$rows['ProductPlan']] = $rows['ProductPlanName'];
	}
	
	return $_conds;
}

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getActive()
{
	$_conds = array('1'=>'Active','0'=>'Not Active');
	return $_conds;
}


/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _setSaveBenefit( $out  = null )
{
	if( is_null($out) OR !$out->fetch_ready() ){
		return false;
	}
	
// ------- reset -----------------------------------------------------------

   $this->db->reset_write();
   $this->db->set("ProductId", $out->get_value('ProductId') );
   $this->db->set("ProductPlan", $out->get_value('ProductPlan') );
   $this->db->set("ProductPlanBenefit", $out->get_value('ProductPlanBenefit') );
   $this->db->set("ProductPlanBenefitDesc", $out->get_value('ProductPlanBenefitDesc') );
   $this->db->set("ProductPlanBenefitStatusFlag", $out->get_value('ProductPlanBenefitStatusFlag') );
   $this->db->insert("t_gn_productplanbenefit");
   
   if( $this->db->affected_rows() > 0 )
   {
	   return true;
   } else {
	   return false;
   }
   
}

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
function _setUpdateBenefit( $out  = null )
{
   if( is_null($out) OR !$out->fetch_ready() )
  {
	  return false;
  }
	
   $this->db->reset_write();
   $this->db->where("ProductPlanBenefitId", $out->get_value('ProductPlanBenefitId'));
   $this->db->set("ProductId", $out->get_value('ProductId') );
   $this->db->set("ProductPlan", $out->get_value('ProductPlan') );
   $this->db->set("ProductPlanBenefit", $out->get_value('ProductPlanBenefit') );
   $this->db->set("ProductPlanBenefitDesc", $out->get_value('ProductPlanBenefitDesc') );
   $this->db->set("ProductPlanBenefitStatusFlag", $out->get_value('ProductPlanBenefitStatusFlag') );
   if( $this->db->update("t_gn_productplanbenefit") ){
	   return true;
   } else {
	   return false;
   }
   
}

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
function _setDelete( $_post=null )
{
	$_conds = 0;
	if(isset($_post['BenefitId']) )
	{
		foreach($_post['BenefitId'] as $Keys => $BenfitId )
		{
			if( $this ->db->delete('t_gn_productplanbenefit',array('ProductPlanBenefitId' => $BenfitId )))
			{
				$_conds++;
			}
		}
	}
	return $_conds;
}

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getBenefitData($BenefitId=null)
{
	$_conds = array();
	$sql = " SELECT 
			 distinct a.ProductPlanBenefitId, a.ProductId, b.ProductCode, 
			 b.ProductName, a.ProductPlanBenefitDesc,  d.ProductPlan,
			 a.ProductPlanBenefit, d.ProductPlanName, e.ProductType,
			 a.ProductPlanBenefitStatusFlag as status
			FROM t_gn_productplanbenefit a 
			LEFT JOIN t_gn_product b on a.ProductId=b.ProductId 
			LEFT JOIN t_gn_campaignproduct f on b.ProductId=f.ProductId
			LEFT JOIN t_gn_campaign c on f.CampaignId=c.CampaignId
			LEFT JOIN t_gn_productplan d on a.ProductPlan=d.ProductPlan 
			LEFT JOIN t_lk_producttype e on b.ProductTypeId=e.ProductTypeId
			WHERE a.ProductPlanBenefitId='$BenefitId'";
			
	$qry = $this -> db -> query($sql);
	if( !$qry ->EOF() )
	{
		$_conds = $qry ->result_first_assoc();
	}

	return $_conds;	
			
}


}

?>