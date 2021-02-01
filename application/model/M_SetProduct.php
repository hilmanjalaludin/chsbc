<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysMenu  
 * 			  extends under model class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysmenu/
 */
 
class M_SetProduct extends EUI_Model
{
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 private static $Instance   = null; 
 public static function &Instance()
{
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
}

// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 function __construct() 
 {
	//run & way 
 }
 
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 
 function _get_default(){
	//run & default 
 }

 function _getProductType()
 {
 	$this->db ->reset_select();
	$this->db->select("p.ProductTypeId, p.ProductType");
 	$this->db->from("t_lk_producttype p");

 	$_conds = array();
	foreach( $this ->db -> get() -> result_assoc() as $rows )
	{
		$_conds[$rows['ProductTypeId']] = $rows['ProductType'];
	}
	
	return $_conds;
 }
 
 
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 function _getProductCampaignId($CampaignId=null)
 {
	$sql = "SELECT b.ProductId, b.ProductName from t_gn_campaignproduct a 
			LEFT JOIN t_gn_product b on a.ProductId=b.ProductId ";
			
	$this -> db -> select("b.ProductId, b.ProductName");
	$this -> db -> from("t_gn_campaignproduct a");
	$this -> db -> join("t_gn_product b ", "a.ProductId=b.ProductId","LEFT");
	$this -> db -> where("a.CampaignId", $CampaignId);
	
	$_conds = array();
	foreach( $this ->db -> get() -> result_assoc() as $rows )
	{
		$_conds[$rows['ProductId']] = $rows['ProductName'];
	}
	
	return $_conds;

 }
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 function _getCampaignChannel($CampaignId=null)
 {
	$this -> db ->reset_select();			
	$this -> db -> select("pt.PaymentTypeId, pt.PaymentTypeDesc ");
	$this -> db -> from("t_gn_campaignpaychannel c ");
	$this -> db -> join("t_lk_paymenttype pt ", "c.PaymentChannelId=pt.PaymentTypeId","LEFT");
	$this -> db -> where("c.CampaignId", $CampaignId);
	

	$_conds = array();
	foreach( $this ->db -> get() -> result_assoc() as $rows )
	{
		$_conds[$rows['PaymentTypeId']] = $rows['PaymentTypeDesc'];
	}
	
	return $_conds;

 }
 
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
function _getProductId()
{
 $_conds = array();
 $sql = " SELECT a.ProductId, a.ProductName, a.ProductCode FROM t_gn_product a WHERE a.ProductStatusFlag=1 ";
 $qry = $this -> db -> query($sql);

  if( !$qry -> EOF() )
  {
	foreach( $qry -> result_assoc() as $rows )
	{
		$_conds[$rows['ProductId']] = array
			(
				'name' => $rows['ProductName'], 
				'code' => $rows['ProductCode'] 
			);
	 }
 }
	
	return $_conds;
}
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
function _getOutboundProductId()
{
	$_conds = array();
	$this -> db ->reset_select();
	$this -> db ->select("b.ProductId, b.ProductName, b.ProductCode, c.CampaignId");
	$this -> db ->from("t_gn_campaignproduct a");
	$this -> db ->join("t_gn_product b", "a.ProductId=b.ProductId","INNER");
	$this -> db ->join("t_gn_campaign c", "a.CampaignId=c.CampaignId","LEFT");
	$this -> db ->join("t_lk_outbound_goals d", "c.OutboundGoalsId=d.OutboundGoalsId","LEFT");
	$this -> db ->where("d.Name","outbound");
	
	foreach( $this -> db -> get() ->result_assoc() as $rows )
	{
		$_conds[$rows['ProductId']] = array
		(
			'name' => $rows['ProductName'], 
			'code' => $rows['ProductCode'],
			'CampaignId' => $rows['CampaignId']	
		);
	}
	
	return $_conds;
} 
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
function _getInboundProductId()
{
	$_conds = array();
	$this -> db ->reset_select();
	$this -> db ->select("b.ProductId, b.ProductName, b.ProductCode, c.CampaignId");
	$this -> db ->from("t_gn_campaignproduct a");
	$this -> db ->join("t_gn_product b", "a.ProductId=b.ProductId","INNER");
	$this -> db ->join("t_gn_campaign c", "a.CampaignId=c.CampaignId","LEFT");
	$this -> db ->join("t_lk_outbound_goals d", "c.OutboundGoalsId=d.OutboundGoalsId","LEFT");
	$this -> db ->where("d.Name","inbound");
	
	foreach( $this -> db -> get() ->result_assoc() as $rows )
	{
		$_conds[$rows['ProductId']] = array
		(
			'name' => $rows['ProductName'], 
			'code' => $rows['ProductCode'],
			'CampaignId' => $rows['CampaignId']	
		);
	}
	
	return $_conds;
} 
 
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 function _get_content(){
	//run & default 
 }
 
 
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 function _get_select_paymode()
 {
	$sql = " SELECT PayModeId, PayMode  FROM t_lk_paymode ";
	$qry = $this -> db -> query($sql);
	foreach( $qry -> result_assoc() as $rows ){
		$data[$rows['PayModeId']] = $rows['PayMode'];
	}
	
	return $data;
 }
 
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 function _get_select_premi_group()
 {
	$sql = " SELECT a.PremiumGroupId, a.PremiumGroupDesc from t_lk_premiumgroup a ORDER BY a.PremiumGroupOrder ASC";
	$qry = $this -> db -> query($sql);
	foreach( $qry -> result_assoc() as $rows ){
		$data[$rows['PremiumGroupId']] = $rows['PremiumGroupDesc'];
	}
	
	return $data;
 }
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 function _get_exist_plan( $Where = array() )
 {
	$_callback = FALSE;
	
	if( !is_null($Where) )
	{	
		$this -> db -> select("COUNT(ProductPlanId) as jumlah");
		$this -> db -> from("t_gn_productplan");
		
		// wherers 
		
		if( count($Where) > 0 ) foreach( $Where as $keys => $value ){
			$this -> db -> where($keys, $value);
		}
		// run query 
		
		if( $rows = $this ->db ->get()->result_first_assoc() ) 
		{
			$_callback = ( (INT)$rows['jumlah'] > 0 ? TRUE : FALSE);
		}
	}
	
	return $_callback;
 }
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
function _set_insert_product( $post_data, $Credit)
{
	$_conds = 0;
	
	if( is_array($post_data))
	{
		$SQL_insert['ProductCode'] = $post_data['ProductId']; 
		$SQL_insert['ProductTypeId'] = $post_data['ProductType']; 
		$SQL_insert['ProductName']  = $post_data['ProductName'];
		$SQL_insert['CampaignGroupId'] = $post_data['ProductCores']; 
		$SQL_insert['ProductUWFlag'] = $post_data['Underwriting']; 
		$SQL_insert['ProductBeneficieryFlag'] = $post_data['Beneficiary']; 
		$SQL_insert['ProductExpirePeriode'] = $post_data['ExpiredPeriode']; 
		$SQL_insert['ProductSponsor'] = $post_data['Sponsor']; 
		$SQL_insert['ProductCurrency'] = $post_data['Currency']; 
		$SQL_insert['ProductPolicyNumPrefix'] = $Credit;
		if(( $SQL_insert['ProductCode']!='' ))
		{
			if( $this -> db -> insert('t_gn_product', $SQL_insert ) ) { 
				$_conds = $this -> db -> insert_id();
			}	
			else
			{
				if(strchr(mysql_error(), 'Duplicate')) 
				{
					$sql = "SELECT ProductId 
							FROM t_gn_product a 
							WHERE a.ProductCode='". $post_data['ProductId'] ."'";
							
					$qry = $this -> db -> query($sql);
					if( !$qry -> EOF() ) {
						$_conds = $qry -> result_singgle_value();
					}
				}
			}
		}
	}
	
	return $_conds;
} 
 
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 function _get_select_cores()
 {
	$data = array();
	
	$sql = " SELECT a.CampaignGroupId, a.CampaignGroupName 
			 FROM t_gn_campaigngroup a where a.CampaignGroupStatusFlag=1 ";
			 
	$qry = $this -> db -> query($sql);
	foreach( $qry -> result_assoc() as $rows )
	{
		$data[$rows['CampaignGroupId']] = $rows['CampaignGroupName'];
	}
	return $data;
 }
 
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 function _set_credit_shield($_post, $_datas, $credit=0 )
 {
	$_conds = false;
	if( is_array( $_post ) && is_array( $_datas ) ) 
	{
		$_conds = self::_set_insert_product( $_post, $credit);
	}	
	
	return $_conds;
 }
 
 
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 function _set_not_credit_shield( $_post, $_datas, $credit=1 )
 {
	
	$_conds = false;
	if( is_array( $_post ) && is_array( $_datas ) ) {
		$get_insertId  = self::_set_insert_product( $_post, $credit);
		if( (count($_post['GroupPremi'])> 0) &&  ($_post['GroupPremi']!='')) {
			if( ($get_insertId !=FALSE) ) {
				$_conds = self::_set_level_one( $_post, $_datas, $get_insertId);
			}
		}
		else{
			$_conds = self::set_level_seconds( $_post, $_datas, $get_insertId);	
		}
	}
	
	return $_conds;
 }
 

// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 function _set_level_one( $_post=NULL, $data=NULL , $insert_id =0 )
 {
	$totals = 0;
	if(is_array($_post) ) 
	{
		$_datas_array = array();	
		foreach( $_post['PayMode'] as $_KeyPayId => $VPayMode ) 
		{
			if(is_array($_post['GroupPremi']))
				foreach( $_post['GroupPremi'] as $_KeyGroupId => $VGroupId)
			{
				/* IF have gender on setup product data **/ 
				 
				if(is_array($_post['Gender']))
					foreach( $_post['Gender'] as $KGender => $VGender )
				{
					$_count = (INT)$_post['RangeAge'];
					$_sizes = (INT)$_post['ProductPlan'];
					
					$_postz = 1;
					for( $start=0; $start<$_count; $start++)
					{
						for( $ProductPlan =1; $ProductPlan <= $_sizes; $ProductPlan++ ) 
						{
							$PayModeId = $VPayMode;
							$PremiumGroupId = $VGroupId;
							$ProductPlan = $ProductPlan;
							$GenderId = $VGender; 
							$ProductPlanName = 'PLAN'.$ProductPlan;
							$ProductPlanStatusFlag = $this->URI->_get_post('ProductStatus');
							$ProductPlanAgeStart = $this->URI->_get_post("start_age_{$VPayMode}_{$VGroupId}_{$VGender}_{$_postz}");
							$ProductPlanAgeEnd = $this->URI->_get_post("end_age_{$VPayMode}_{$VGroupId}_{$VGender}_{$_postz}");
							$ProductPlanPremium = $this-> URI->_get_post("plan_premi_{$VPayMode}_{$VGroupId}_{$VGender}_{$_postz}_{$ProductPlan}");
							
						/** paymode can't empty ***/
							
							if( ($PayModeId!='') && ($PayModeId!=0) ) 
							{
								$_SQL['GenderId'] = $GenderId;
								$_SQL['ProductId'] = $insert_id;
								$_SQL['PayModeId'] = $PayModeId; 
								$_SQL['PremiumGroupId'] = $PremiumGroupId;
								$_SQL['ProductPlan'] = $ProductPlan;
								$_SQL['ProductPlanName'] = $ProductPlanName;
								$_SQL['ProductPlanAgeStart'] = $ProductPlanAgeStart;
								$_SQL['ProductPlanAgeEnd'] = $ProductPlanAgeEnd;
								$_SQL['ProductPlanPremium'] = $ProductPlanPremium; 
								$_SQL['ProductPlanStatusFlag'] = $ProductPlanStatusFlag;
								
								if( ( self::_get_exist_plan($_SQL) !=true ) ){
									if( $this->db->insert('t_gn_productplan',$_SQL)) 
										$totals++;
								}
								else{
									$totals++;
								}	
							}	
						}
						
						$_postz++;
					}
				}
			 
			 /* Not Have Gender on setup product data **/
			   
				else  
				{  
					$_count = (INT)$_post['RangeAge'];
					$_sizes = (INT)$_post['ProductPlan'];
					
					$_postz = 1;
					for( $start=0; $start<$_count; $start++)
					{
						for( $ProductPlan =1; $ProductPlan <= $_sizes; $ProductPlan++ ) 
						{
							$PayModeId = $VPayMode;
							$PremiumGroupId = $VGroupId;
							$ProductPlan = $ProductPlan;
							$ProductPlanName = 'PLAN'.$ProductPlan;
							$ProductPlanStatusFlag = $this->URI->_get_post("ProductStatus");
							$ProductPlanAgeStart = $this->URI->_get_post("start_age_{$VPayMode}_{$VGroupId}_{$_postz}");
							$ProductPlanAgeEnd = $this->URI->_get_post("end_age_{$VPayMode}_{$VGroupId}_{$_postz}");
							$ProductPlanPremium = $this->URI->_get_post("plan_premi_{$VPayMode}_{$VGroupId}_{$_postz}_{$ProductPlan}");
							
						/** paymode can't empty ***/
							
							if( ($PayModeId!='') && ($PayModeId!=0) ) 
							{
								$_SQL['ProductId']= $insert_id;
								$_SQL['PayModeId'] = $PayModeId; 
								$_SQL['PremiumGroupId'] = $PremiumGroupId;
								$_SQL['ProductPlan'] = $ProductPlan;
								$_SQL['ProductPlanName'] = $ProductPlanName;
								$_SQL['ProductPlanAgeStart'] = $ProductPlanAgeStart;
								$_SQL['ProductPlanAgeEnd'] = $ProductPlanAgeEnd;
								$_SQL['ProductPlanPremium'] = $ProductPlanPremium; 
								$_SQL['ProductPlanStatusFlag'] = $ProductPlanStatusFlag;
								
								if( ( self::_get_exist_plan($_SQL)!=TRUE) ){
									if( $this -> db -> insert('t_gn_productplan',$_SQL)) 
										$totals++;
								}
								else{
									$totals++;
								}	
							}	
						}
						
						$_postz++;
					}
				}
			}
		}
	}
	
	return $totals;
 }
 
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 function set_level_seconds(  $_post=NULL, $data=NULL , $insert_id =0 )
 {
	$totals = 0;
	if(is_array($_post) ) 
	{
		$_datas_array = array();	
		if( ( is_array($_post['PayMode'])!=FALSE ) && (isset($_post['PayMode'])) )
		{
			foreach( $_post['PayMode'] as $_KeyPayId => $VPayMode )
			{
			  
			  // if have gender 
			  
			  if(is_array($_post['Gender']))foreach( $_post['Gender'] as $KGender => $VGender ) 
			  {
				$_count = (INT)$_post['RangeAge'];
				$_sizes = (INT)$_post['ProductPlan'];
				$_postz = 1;
				for( $start=0; $start<$_count; $start++)
				{
					for( $ProductPlan =1; $ProductPlan<=$_sizes; $ProductPlan++ ) 
					{
						$PayModeId = $VPayMode;
						$ProductPlan = $ProductPlan;
						$GenderId = $VGender;
						$ProductPlanName = 'PLAN'.$ProductPlan;
						$ProductPlanStatusFlag = $this -> URI -> _get_post('ProductStatus');
						$ProductPlanAgeStart = $this -> URI -> _get_post("start_age_{$VPayMode}_{$VGender}_{$_postz}");
						$ProductPlanAgeEnd = $this -> URI -> _get_post("end_age_{$VPayMode}_{$VGender}_{$_postz}");
						$ProductPlanPremium = $this -> URI -> _get_post("plan_premi_{$VPayMode}_{$VGender}_{$_postz}_{$ProductPlan}");
							
						/** paymode can't empty ***/
							
						if( ($PayModeId!='') && ($PayModeId!=0) ) 
						{
							$_SQL['GenderId'] = $GenderId;
							$_SQL['ProductId']= $insert_id;
							$_SQL['PayModeId'] = $PayModeId; 
							$_SQL['ProductPlan'] = $ProductPlan;
							$_SQL['ProductPlanName'] = $ProductPlanName;
							$_SQL['ProductPlanAgeStart'] = $ProductPlanAgeStart;
							$_SQL['ProductPlanAgeEnd'] = $ProductPlanAgeEnd;
							$_SQL['ProductPlanPremium'] = $ProductPlanPremium; 
							$_SQL['ProductPlanStatusFlag'] = $ProductPlanStatusFlag;
							
							if( ( self::_get_exist_plan($_SQL)!=TRUE) ){
								if( $this -> db -> insert('t_gn_productplan',$_SQL)) 
								$totals++;
							}
							else{
								$totals++;
							}	
						}	
					}
					
					$_postz++;
				}
			}
			// if Not have gender 
			else 
			{
				$_count = (INT)$_post['RangeAge'];
				$_sizes = (INT)$_post['ProductPlan'];
				$_postz = 1;
				for( $start=0; $start<$_count; $start++)
				{
					for( $ProductPlan =1; $ProductPlan<=$_sizes; $ProductPlan++ ) 
					{
						$PayModeId = $VPayMode;
						$ProductPlan = $ProductPlan;
						$GenderId = $VGender;
						$ProductPlanName = 'PLAN'.$ProductPlan;
						$ProductPlanStatusFlag = $this -> URI -> _get_post('ProductStatus');
						$ProductPlanAgeStart = $this -> URI -> _get_post("start_age_{$VPayMode}_{$VGender}_{$_postz}");
						$ProductPlanAgeEnd = $this -> URI -> _get_post("end_age_{$VPayMode}_{$VGender}_{$_postz}");
						$ProductPlanPremium = $this -> URI -> _get_post("plan_premi_{$VPayMode}_{$VGender}_{$_postz}_{$ProductPlan}");
							
						/** paymode can't empty ***/
							
						if( ($PayModeId!='') && ($PayModeId!=0) ) 
						{
							$_SQL['GenderId'] = $GenderId;
							$_SQL['ProductId']= $insert_id;
							$_SQL['PayModeId'] = $PayModeId; 
							$_SQL['ProductPlan'] = $ProductPlan;
							$_SQL['ProductPlanName'] = $ProductPlanName;
							$_SQL['ProductPlanAgeStart'] = $ProductPlanAgeStart;
							$_SQL['ProductPlanAgeEnd'] = $ProductPlanAgeEnd;
							$_SQL['ProductPlanPremium'] = $ProductPlanPremium; 
							$_SQL['ProductPlanStatusFlag'] = $ProductPlanStatusFlag;
							
							if( ( self::_get_exist_plan($_SQL)!=TRUE) ){
								if( $this -> db -> insert('t_gn_productplan',$_SQL)) 
								$totals++;
							}
							else{
								$totals++;
							}	
						}	
					}
					
					$_postz++;
				}
			
			   }
				
			}
		}	
	}
	
	return $totals;
 }
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 function _getProductPlan($ProductId=0)
 {
	$_conds = array();
	$this->db->reset_select();
	$this->db->select('a.ProductPlan, a.ProductPlanName');
	$this->db->from('t_gn_productplan a');
	$this->db->where('a.ProductId',$ProductId);
	$this->db->group_by('a.ProductPlan');
	$rs  = $this->db->get();
	 foreach( $rs-> result_assoc() as $rows )
	{
		$_conds[$rows['ProductPlan']] = $rows['ProductPlanName'];
	}
	
	return $_conds;
 }
 
 //=============================== END CLASS ==================
 
}
?>