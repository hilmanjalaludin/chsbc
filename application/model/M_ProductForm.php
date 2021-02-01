<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 define('MAIN',2);
 define('SPOUSE',3);
 define('DEPENDENT',1);
 define('PARENTS',4);
 
class M_ProductForm extends EUI_Model 
{
	
// ---------------------------------------------

private static $Instance = null;

public static function & Instance()
{
	if( is_null(self::$Instance))
	{
		self::$Instance = new self();
	}
	return self::$Instance;
}
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */

 
 function __construct()
{
	$this->load->model(array( 'M_FormLayout', 'M_SetProduct', 'M_Generator', 'M_Payers', 'M_Insured', 'M_Benefiecery' ));
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
 
function _getCampaignId( $CustomerId=0 )
{
	$_conds = null;
	
	$this->db->select('b.CampaignId');
	$this->db->from('t_gn_customer a ');
	$this->db->join('t_gn_campaign b', 'a.CampaignId=b.CampaignId', 'LEFT');
	$this->db->where('a.CustomerId', $CustomerId);
	
	if( $rows = $this -> db->get()-> result_first_assoc())
	{
		$_conds =(INT)$rows['CampaignId'];
	}
	
	return $_conds;
 }
  
 /*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
 function _getHeader($cust_id)
 {
	$datas = array();
	
	$sql = "select 
				b.PaymentTypeDesc, 
				c.BankName,
				a.PayerFirstName,
				a.PayerCreditCardNum, 
				a.PayerCreditCardExpDate,
				a.PayerValidation,
				e.ProductName,
				a.PayerValidDate
			from t_gn_payer a
			left join t_lk_paymenttype b on a.CreditCardTypeId = b.PaymentTypeId
			left join t_lk_bank c on a.PayersBankId = c.BankId
			left join t_gn_policyautogen d on a.CustomerId = d.CustomerId
			left join t_gn_product e on d.ProductId = e.ProductId
			where a.CustomerId = '".$cust_id."'";
	// echo $sql;
	$qry = $this->db->query($sql);
	
	if($qry->num_rows() > 0)
	{
		foreach($qry->result_assoc() as $rows)
		{
			$datas['PaymentTypeDesc'] = $rows['PaymentTypeDesc'];
			$datas['BankName'] = $rows['BankName'];
			$datas['PayerFirstName'] = $rows['PayerFirstName'];
			$datas['PayerCreditCardNum'] = $rows['PayerCreditCardNum'];
			$datas['PayerValidation'] = $rows['PayerValidation'];
			$datas['PayerCreditCardExpDate'] = $rows['PayerCreditCardExpDate'];
			$datas['ProductName'] = $rows['ProductName'];
			$datas['PayerValidDate'] = $rows['PayerValidDate'];
		}
	}
	
	return $datas;
 }
 
 function _getProductId($CampaignId=0)
 {
	$_conds = null;
	$ProductId = $this -> M_SetProduct -> _getProductCampaignId($CampaignId);
	if( $ProductId )
	{
		$setId = array_keys($ProductId);
		if( count($setId) )
		{
			$_conds = $setId[0];
		}	
	}
	
	return $_conds;
 }
 
 
 
 /*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
 
 function _getLayout($ProductId=0)
 {
	$_conds = null;
	
	$_avail = $this -> M_FormLayout -> _getProductLayout($ProductId);
	if( is_array($_avail)) {
		$_conds = $_avail;
	}
	
	return $_conds;
	
 }
 /*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
 
 function _getAddFormLayout($ProductId=0)
 {
	$_conds = null;
	$_avail = $this -> M_FormLayout -> _getProductLayout($ProductId);
	if( is_array($_avail))
	{
		$_conds = $_avail['AddView'];
	} 
	return $_conds;
 }
 
 
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
 
 function _getAddJavascriptName( $ProductId=0 )
 {
	$BASE_JS_SCRIPT = "form/Product_.js";
	$this -> db -> select('a.ProductCode');
 	$this -> db -> from('t_gn_product a');
	$this -> db -> where('a.ProductId',$ProductId);
	if( $rows = $this -> db -> get() -> result_first_assoc() )
	{
		$BASE_JS_SCRIPT = "form/Product_" . strtolower($rows['ProductCode']) .".js";
	}
	
	return $BASE_JS_SCRIPT;
 }
 
 /*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
 
 function _getEditJavascriptName( $ProductId=0 )
 {
	$BASE_JS_SCRIPT = "form/EditProduct_.js";
	$this -> db -> select('a.ProductCode');
 	$this -> db -> from('t_gn_product a');
	$this -> db -> where('a.ProductId',$ProductId);
	if( $rows = $this -> db -> get() -> result_first_assoc() )
	{
		$BASE_JS_SCRIPT = "form/EditProduct_" . strtolower($rows['ProductCode']) .".js";
	}
	
	return $BASE_JS_SCRIPT;
 }
  
 /*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
 
 function _getEditFormLayout($ProductId=0)
 {
	$_conds = null;
	$_avail = $this -> M_FormLayout -> _getProductLayout($ProductId);
	if( is_array($_avail))
	{
		$_conds = $_avail['EditView'];
	} 
	
	return $_conds;
 }
 
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
 
 
 public function _getAgeRange($ProductId = 0, $Age = 0 )
 {
	$_conds = 0;
	$sql = " SELECT 
					COUNT(a.ProductPlanId) AS Qty, 
					MIN(a.ProductPlanAgeStart) AS start_of_age, 
					MAX(a.ProductPlanAgeEnd) AS end_of_age 
			 FROM t_gn_productplan a where a.ProductId='{$ProductId}'
			 HAVING {$Age}>=start_of_age AND {$Age}<=end_of_age ";
	$qry = $this ->db->query($sql);
	if( $rows = $qry -> result_first_assoc() ) {
		$_conds = (INT)$rows['Qty'];
	}
	
	return $_conds;
 }
 
 
  
 /*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
 
 function _getProduct()
 {
	$_conds = array();
	
	$avail = $this -> M_SetProduct -> _getOutboundProductId();
	foreach($avail as $key => $rows )
	{
		$_conds[$key] = $rows['name'];	
	}
	
	return $_conds;
 }
 
 
 
 /*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
 
 public function _getPremiSubmited( $CustomerId = 0, $ProductId = 0 )
{
	$arr_premi_submit = array();
	
	$cond1 = "IF(SUM(e.PolicyCredits) IS NULL, 0, e.PolicyCredits ) as PolicyPermiDiscount, ";
	$cond2 = "IF(SUM(c.PolicyPremi+e.PolicyCredits) IS NULL, 0, SUM(c.PolicyPremi+e.PolicyCredits)) as PolicyTotalPermi ";

	// mode mssql
	if( QUERY == 'mssql') {
		$cond1 = "CASE WHEN (SUM(e.PolicyCredits) IS NULL) THEN 0 ELSE e.PolicyCredits END AS PolicyPermiDiscount, ";
		$cond2 = "CASE WHEN (SUM(c.PolicyPremi+e.PolicyCredits) IS NULL) THEN 0 ELSE SUM(c.PolicyPremi + e.PolicyCredits) END AS PolicyTotalPermi ";
	}

	$this->db->reset_select();
	$this->db->select("
		b.InsuredPayMode,
		d.ProductPlan,
		d.PremiTypeId,
		SUM(c.PolicyPremi) AS PolicyPremi,
		{$cond1}
		{$cond2}
		", 
	FALSE);
	
	$this->db->from("t_gn_policyautogen a");
	$this->db->join("t_gn_insured b", "a.CustomerId=b.CustomerId AND a.PolicyPrefix=b.PolicyPrefix AND a.PolicyNumber=b.PolicyNumber", "LEFT");
	$this->db->join("t_gn_policy c", "a.PolicyNumber=c.PolicyNumber AND a.PolicyNumber=c.PolicyNumber", "LEFT");
	$this->db->join("t_gn_productplan d", "c.ProductPlanId=d.ProductPlanId", "LEFT");
	$this->db->join("t_gn_policydiscount e", "a.PolicyNumber=e.PolicyNumber", "LEFT");
	$this->db->where("a.CustomerId", $CustomerId, false);
	$this->db->where("a.ProductId", $ProductId, false);
	
	//-- echo $this->db->print_out();--->
	
	$rs = $this->db->get();
	if( $rs->num_rows() >  0 )  {
		$arr_premi_submit  = (array)$rs->result_first_assoc();
	}
	
	return (array)$arr_premi_submit;
	
}

// -------------------------------------------------------------------------
 /*
 * @ pakage 	get exist data submited by agent before 
 * @ pram		< $CustomerId <Int>, $ProductId <int> >
 */
 
 public function _getBeneficiarySubmited( $CustomerId = 0, $ProductId = 0 )
{
 $arr_beneficiary_submit = array();
 $this->db->reset_select();
 $this->db->select("
		b.BenefieceryPrefix,
		b.RelationshipTypeId,
		b.SalutationId,
		b.GenderId,
		b.BeneficiaryFirstName,
		b.BeneficiaryLastName,
		date_format(b.BeneficiaryDOB,'%d-%m-%Y') as BeneficiaryDOB,
		b.BeneficieryPercentage,
		b.BeneficiaryAge", 
 FALSE);
		
 $this->db->from("t_gn_policyautogen a");
 $this->db->join("t_gn_beneficiary b", "a.PolicyNumber=b.PolicyNumber", "LEFT");
 $this->db->where("a.CustomerId", $CustomerId, false);
 $this->db->where("a.ProductId", $ProductId, false);
// ------------$this->db->print_out(); -------------------
//  echo $this->db->print_out();

 $rs = $this->db->get();
 if( $rs->num_rows() >  0 ) 
	foreach( $rs->result_assoc() as $rows )
 {
	$arr_beneficiary_submit[$rows['BenefieceryPrefix']] = $rows;
 }
return (array)$arr_beneficiary_submit;
 
} 

// -------------------------------------------------------------------------
 /*
 * @ pakage 	get exist data submited by agent before 
 * @ pram		< $CustomerId <Int>, $ProductId <int> >
 */
 
 function _getInsuredSubmited( $CustomerId = 0, $ProductId = 0 )
{
	$arr_insured_submit = array();
	
	$this->db->reset_select();
	$this->db->select("
		b.PolicyPrefix,  
		b.SalutationId,
		b.InsuredFirstName,
		b.InsuredLastName,
		b.RelationshipTypeId,
		b.GenderId,
		b.InsuredAge,
		date_format(b.InsuredDOB, '%d-%m-%Y') as InsuredDOB,
		(select pc.PolicyPremi from t_gn_policy pc where pc.PolicyId = b.PolicyId  ) as PolicyPremi ", FALSE);
		
	$this->db->from("t_gn_policyautogen a");
	$this->db->join("t_gn_insured b", "a.CustomerId=b.CustomerId  AND a.PolicyNumber=b.PolicyNumber", "LEFT");
	$this->db->where("a.CustomerId", $CustomerId, false);
	$this->db->where("a.ProductId", $ProductId, false);
// ------------$this->db->print_out(); -------------------
	$rs = $this->db->get();
	if( $rs->num_rows() >  0 ) 
		foreach( $rs->result_assoc() as $rows )
	{
		$arr_insured_submit[$rows['PolicyPrefix']] = $rows;
	}
	
	return (array)$arr_insured_submit;
} 


// -------------------------------------------------------------------------
 /*
 * @ pakage 	get exist data submited by agent before 
 * @ pram		<$ProductId <int> >
 */
 
 function _getPlanProduct($ProductId=0 )
 {
	$_conds = array();
	if( $ProductId )
	{
		$_conds = $this -> M_SetProduct->_getProductPlan($ProductId); 
	}
	return $_conds;
 }
 
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
  
function _getPremi( $d = array() )
{	
	$totals = array( 'ProductPlanId' => 0, 'ProductPlanPremium' => 0);
	
	if( is_array($totals) )
	{
		$this->db->reset_select();
		$this->db->select('a.ProductPlanId, a.ProductPlanPremium');
		$this->db->from('t_gn_productplan a');
		
		if( isset($d['Age']) ){
			$this->db->where("{$d['Age']} BETWEEN a.ProductPlanAgeStart AND a.ProductPlanAgeEnd", NULL , FALSE);	
		}
		
		if( isset($d['PremiumGroupId']) AND !empty($d['PremiumGroupId'])) {
			$this->db->where('a.PremiumGroupId', $d['PremiumGroupId'], FALSE);
		}
		
		if( isset($d['PayModeId']) AND !empty($d['PayModeId'])) {
			$this->db->where('a.PayModeId', $d['PayModeId'], FALSE);
		}
		
		if( isset($d['ProductPlan']) AND !empty($d['ProductPlan'])) {
			$this-> db->where('a.ProductPlan', $d['ProductPlan'], FALSE);
		}
		
		if( isset($d['ProductId']) AND !empty($d['ProductId'])) {
			$this->db->where('a.ProductId', $d['ProductId'], FALSE);
		}
		
		if( isset($d['GenderId']) AND !empty($d['GenderId'])) {
			$this->db->where('a.GenderId', $d['GenderId'], FALSE);	
		}
	
		// ------------- tambahan query jika ada ------------------------------
		if( isset($d['PremiTypeId']) AND !empty($d['PremiTypeId'])) {
			$this->db->where('a.PremiTypeId', $d['PremiTypeId'], FALSE);	
		}
		
	}
	//echo $this->db->print_out();
	
	if( $rows = $this -> db -> get()->result_first_assoc() ){
		$totals = array(
			'ProductPlanId' => $rows['ProductPlanId'],
			'ProductPlanPremium' => $rows['ProductPlanPremium']);
	}
	
	return $totals;	
} 

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
 function _getSingglePolicyNumber( $CustomerId = 0 , $ProductId  = 0 ) 
{
	$policy_number = "";
	$arr_data = (array)$this->_getPolicyNumber( $CustomerId, $ProductId );
	if( is_array($arr_data) and count($arr_data) > 0  ){
		$policy_number = reset(array_values($arr_data));
	}
	return (string)$policy_number;
} 
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */

function _getPolicyNumber( $CustomerId=0, $ProductId=0)
{
	$_avail = array();
	
	$this -> db -> select('a.PolicyAutoGenId, a.PolicyNumber');
	$this -> db -> from('t_gn_policyautogen a');
	$this -> db -> where('a.CustomerId', $CustomerId);
	$this -> db -> where('a.ProductId', $ProductId);
	$this -> db -> group_by('a.PolicyNumber');
	// __($this->db->_get_var_dump());
	foreach( $this -> db ->get() -> result_assoc() as $rows ){
		$_avail[$rows['PolicyAutoGenId']] = $rows['PolicyNumber'];
	}
	
	return $_avail;
}

function _getDefault($CustId = null,$ProductId=0)
{
	$_count = 0;
	
	if( !is_null($CustId) )
	{
		$this -> db -> select('a.PolicyAutoGenId');
		$this -> db -> from('t_gn_policyautogen a');
		$this -> db -> where('a.CustomerId',$CustId);
		$this -> db -> where('a.ProductId',$ProductId);
		
		if( $_avail = $this -> db ->get() -> result_first_assoc() )
		{
			$_count = $_avail['PolicyAutoGenId'];
		}	
	}
	
	return $_count;
}
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
  
function _getPolicyautogen( $PolicyAutoGenId =null )
{
	$_count = array();
	
	if( !is_null($PolicyAutoGenId) )
	{
		$this -> db -> select('*');
		$this -> db -> from('t_gn_policyautogen a');
		$this -> db -> where('a.PolicyAutoGenId',$PolicyAutoGenId);
		
		if( $_avail = $this -> db ->get() -> result_first_assoc() )
		{
			$_count = $_avail;
		}	
	}
	
	return $_count;
}


/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
  
function _getExistSales( $data =null )
{
	$_count = 0;
	
	if( !is_null($data) )
	{
		$this -> db -> select('COUNT(a.PolicyAutoGenId) AS rows_count', FALSE);
		$this -> db -> from('t_gn_policyautogen a');
		$this -> db -> where('a.ProductId',$data['ProductId']);
		$this -> db -> where('a.CustomerId',$data['CustomerId']);
		$this -> db -> where('a.MemberGroup',$data['InsuredGroupPremi']);
		
		if( $_avail = $this -> db ->get() -> result_first_assoc() )
		{
			$_count = (INT)$_avail['rows_count'];
		}	
	}
	
	return $_count;
}


/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
 
private function _SaveUnderwriting( $param = null )
{
	$_array_select = null;
	if( is_array($param) 
		AND isset($param['Benefeciery']) 
		AND $param['Benefeciery']!='' )
	{
		$Qty = (INT)$param['Benefeciery'];
		for( $b = 1; $b <=$Qty; $b++ ) 
		{
			$_array_select['BeneficiaryDOB'] = $param["BenefDOB_$b"];
			$_array_select['BeneficiaryFirstName'] = $param["BenefFirstName_$b"];
			$_array_select['BeneficiaryLastName'] = $param["BenefLastName_$b"];
			$_array_select['GenderId'] = $param["BenefGenderId_$b"];
			$_array_select['RelationshipTypeId'] = $param["BenefRelationshipTypeId_$b"];
			$_array_select['SalutationId'] = $param["BenefSalutationId_$b"];
			$_array_select['InsuredId'] = $param["InsuredId"];
			$_array_select['CustomerId']=$param["CustomerId"];
			$_array_select['CreatedById'] = $this -> EUI_Session ->_get_session('UserId');
			$_array_select['BeneficiaryCreatedTs'] = date('Y-m-d H:i:s');
			
			if(is_array($_array_select) ) 
			{
				$this -> M_Benefiecery -> _SaveDataBeneficiary($_array_select);
			}	
		}
	}
} 

function _getPaymentModeByProduct($ProductId = 0)
{
	$_conds = array();
	
	
	$sql = "select distinct(a.PayModeId) as PayModeId, b.PayMode from t_gn_productplan a
			left join t_lk_paymode b on a.PayModeId = b.PayModeId
			where a.ProductId = '$ProductId'";
		
	$qry = $this->db->query($sql);
	
	if($qry->num_rows() > 0)
	{
		foreach($qry->result_assoc() as $rows)
		{
			$_conds[$rows['PayModeId']] = $rows['PayMode'];
		}
	}
	
	return $_conds;
}	

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
 
private function _SaveBenefiecery( $param = null )
{
	$_array_select = null;
	if( is_array($param) 
		AND isset($param['Benefeciery']) 
		AND $param['Benefeciery']!='' )
	{
		$Qty = (INT)$param['Benefeciery'];
		for( $b = 1; $b <=$Qty; $b++ ) 
		{
			$_array_select['BeneficiaryDOB'] = $param["BenefDOB_$b"];
			$_array_select['BeneficiaryAge'] = $param["BenefAge_$b"];
			$_array_select['BeneficiaryFirstName'] = $param["BenefFirstName_$b"];
			$_array_select['BeneficiaryLastName'] = $param["BenefLastName_$b"];
			$_array_select['GenderId'] = $param["BenefGenderId_$b"];
			$_array_select['RelationshipTypeId'] = $param["BenefRelationshipTypeId_$b"];
			$_array_select['SalutationId'] = $param["BenefSalutationId_$b"];
			$_array_select['InsuredId'] = $param["InsuredId"];
			$_array_select['CustomerId']=$param["CustomerId"];
			$_array_select['CreatedById'] = $this -> EUI_Session ->_get_session('UserId');
			$_array_select['BeneficiaryCreatedTs'] = date('Y-m-d H:i:s');
			
			if(is_array($_array_select) ) 
			{
				$this -> M_Benefiecery -> _SaveDataBeneficiary($_array_select);
			}	
		}
	}
} 

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
  
function _setNoPecah($p=NULL)
{
	// echo "1";
 // set data 
 $InsuredDOB = $this -> EUI_Tools ->_date_english($p['InsuredDOB']);
 $SellerId = $this -> EUI_Session ->_get_session('UserId');
 $ProductId = (isset($p['ProductId'])?$p['ProductId'] : null );
 $CustomerId = (isset($p['CustomerId'])?$p['CustomerId'] : null ); 
 $PremiumGroupId  = (isset($p['InsuredGroupPremi'])?$p['InsuredGroupPremi'] : null ); 
 $InsuredAge = (isset($p['InsuredAge'])?$p['InsuredAge'] : null );
 $InsuredGenderId = (isset($p['InsuredGenderId'])?$p['InsuredGenderId'] : null ); 
 $InsuredPayMode  = (isset($p['InsuredPayMode'])?$p['InsuredPayMode'] : null );
 $InsuredPlanType  = (isset($p['InsuredPlanType'])?$p['InsuredPlanType'] : null );
 $InsuredPolicyNumber = (isset($p['InsuredPolicyNumber'])?$p['InsuredPolicyNumber'] : null );
	
  $_conds = array('PolicyNumber' => '', 'PolicyId' => '', 'msg'=>'Product Id is Empty');
  if(!is_null($ProductId))
  {
		// echo "2";
		$this -> M_Generator -> _set_polis_number($ProductId,'N' ); 
		if( class_exists('M_Generator') )
		{
			// echo "3";
			if (!is_null($PremiumGroupId) AND !is_null($ProductId) AND !is_null($CustomerId) 
				AND !is_null($InsuredAge) AND !is_null($InsuredPayMode) AND !is_null($InsuredPlanType) )
			{
				// echo "4";
				$PolicyNumber  = $this -> M_Generator -> _get_polis_number();
				$PolicyLastId  = $this -> M_Generator -> _get_last_number();
				
			// save main insured with code : 2 
			
				if( (int)$PremiumGroupId == MAIN )
				{
					// cek polis existing 
					
					if( self::_getExistSales($p) ==0 )
					{
						$PolicyAutogen = array(
							'ProductId' => $ProductId, 'CustomerId' => $CustomerId,
							'MemberGroup' => $PremiumGroupId, 'PolicyNumber' => $PolicyNumber, 	
							'PolicyLastNumber' => $PolicyLastId);				
						
						if( $this -> db -> insert('t_gn_policyautogen',$PolicyAutogen))
						{
							// attribut premi 
					
							$Product = self::_getPremi(array(
								'Age' => $InsuredAge,
								'PremiumGroupId' => $PremiumGroupId,
								'PayModeId' => $InsuredPayMode,
								'ProductPlan' => $InsuredPlanType,
								'GenderId' => $InsuredGenderId,
								'ProductId'=>$ProductId
							));
							
							// save t_gn_payers 
							if(is_array($p))
							{
								$p['PayerCreatedTs'] = date('Y-m-d H:i:s');
								$p['CreatedById'] = $SellerId;
								$p['PremiumGroupId'] = $PremiumGroupId;
								$this -> M_Payers -> _SaveDataPayers($p);
								//$this -> M_Underwriting ->_setSaveUnderwriting($p);
								
							}
							// save t_gn_policy 
							
							if( $this -> db -> insert('t_gn_policy',array
							(
								'ProductPlanId' => $Product['ProductPlanId'], 
								'PolicyPremi' => $Product['ProductPlanPremium'],
								'PolicyEffectiveDate' => date('Y-m-d H:i:s'), 
								'PolicySalesDate' => date('Y-m-d H:i:s'), 
								'PolicyNumber' => $PolicyNumber
							)))
							{
								$PolicyId = $this -> db -> insert_id();
								if( $PolicyId ) 
								{	
									$p['PolicyId'] = $PolicyId;
									$p['InsuredCreatedTs']=date('Y-m-d H:i:s');
									$p['CreatedById'] = $SellerId;
									if(is_array($p))
									{
										if( $InsertId = $this -> M_Insured -> _SaveDataInsured($p) )
										{
											$p['InsuredId'] = $InsertId;
											if(is_array($p) )
											{
												$this ->_SaveBenefiecery($p);
											}
										}
									}
								}	
							}	
							
						// call back data 	
							
							$_conds = array
							(
								'PolicyNumber' => $PolicyNumber, 
								'PolicyId' => $PolicyLastId
							 );
						}
						else
						{
							$_conds['msg'] = 'Can\'t insert into policy';
						}
					}
					else
					{
						$_conds['msg'] = 'This Customer Have Main Insured';
					}
				}
				else if( ((INT)$PremiumGroupId == SPOUSE) AND (!is_null($InsuredPolicyNumber)) )
				{
					// cek polis existing 
					
					if( self::_getExistSales($p)==0 )
					{
					   $Policyautogen = self::_getPolicyautogen($InsuredPolicyNumber);
					 //  print_r($Policyautogen);
					   if( is_array($Policyautogen))
					   {
						//attribut premi 
					
							$Product = self::_getPremi(array(
								'Age' => $InsuredAge,
								'PremiumGroupId' => $PremiumGroupId,
								'PayModeId' => $InsuredPayMode,
								'ProductPlan' => $InsuredPlanType,
								'GenderId' => $InsuredGenderId,
								'ProductId'=>$ProductId
							));
							
							
						// tgn policy 
						
							if( $this -> db -> insert('t_gn_policy',array
							(
								'ProductPlanId' => $Product['ProductPlanId'], 
								'PolicyPremi' => $Product['ProductPlanPremium'],
								'PolicyEffectiveDate' => date('Y-m-d H:i:s'), 
								'PolicySalesDate' => date('Y-m-d H:i:s'), 
								'PolicyNumber' => $Policyautogen['PolicyNumber']
							)))
							{
								$PolicyId = $this -> db -> insert_id();
								if( $PolicyId )
								{
									$p['PolicyId'] = $PolicyId;
									$p['InsuredCreatedTs']=date('Y-m-d H:i:s');
									$p['CreatedById'] = $SellerId;
									if(is_array($p))
									{
										if( $InsertId = $this -> M_Insured -> _SaveDataInsured($p) )
										{
											$p['InsuredId'] = $InsertId;
											if(is_array($p) )
											{
												$this -> _SaveBenefiecery($p);
											}
										}
									}
								}	
							}	
							
						//call back data 	
							
							$_conds = array
							(
								'PolicyNumber' => $Policyautogen['PolicyNumber'], 
								'PolicyId' => $PolicyLastId
							 );
						}
						else
						{
							$_conds['msg'] = 'Can\'t insert into policy';
						}
					}
					else
					{
						$_conds['msg'] = 'This Customer Have Spouse';
					}
				}
				else if( ((INT)$PremiumGroupId == DEPENDENT) AND (!is_null($InsuredPolicyNumber)) )
				{
					// cek polis existing 
					$Policyautogen = self::_getPolicyautogen($InsuredPolicyNumber);
					if( is_array($Policyautogen))
					{
						//attribut premi 
						$Product = self::_getPremi(array(
								'Age' => $InsuredAge,
								'PremiumGroupId' => $PremiumGroupId,
								'PayModeId' => $InsuredPayMode,
								'ProductPlan' => $InsuredPlanType,
								'GenderId' => $InsuredGenderId,
								'ProductId'=>$ProductId
							));
							
							
						// tgn policy 
						
						if( $this -> db -> insert('t_gn_policy',array
						(
								'ProductPlanId' => $Product['ProductPlanId'], 
								'PolicyPremi' => $Product['ProductPlanPremium'],
								'PolicyEffectiveDate' => date('Y-m-d H:i:s'), 
								'PolicySalesDate' => date('Y-m-d H:i:s'), 
								'PolicyNumber' => $Policyautogen['PolicyNumber']
						)))
						{
							$PolicyId = $this -> db -> insert_id();
							if( $PolicyId )
							{
								$p['PolicyId'] = $PolicyId;
								$p['InsuredCreatedTs']=date('Y-m-d H:i:s');
								$p['CreatedById'] = $SellerId;
								if(is_array($p))
								{
									if( $InsertId = $this -> M_Insured -> _SaveDataInsured($p) )
										{
											$p['InsuredId'] = $InsertId;
											if(is_array($p) )
											{
												$this -> _SaveBenefiecery($p);
											}
										}
								}
							}	
						}	
							
						//call back data 	
						$_conds = array
						(
							'PolicyNumber' => $Policyautogen['PolicyNumber'], 
							'PolicyId' => $PolicyLastId
						 );
					}
				}
				else if( ((INT)$PremiumGroupId == PARENTS ) AND (!is_null($InsuredPolicyNumber)) )
				{
					// cek polis existing 
					$Policyautogen = self::_getPolicyautogen($InsuredPolicyNumber);
					if( is_array($Policyautogen))
					{
						//attribut premi 
						$Product = self::_getPremi(array(
								'Age' => $InsuredAge,
								'PremiumGroupId' => $PremiumGroupId,
								'PayModeId' => $InsuredPayMode,
								'ProductPlan' => $InsuredPlanType,
								'GenderId' => $InsuredGenderId,
								'ProductId'=>$ProductId
							));
							
							
						// tgn policy 
						
						if( $this -> db -> insert('t_gn_policy',array
						(
								'ProductPlanId' => $Product['ProductPlanId'], 
								'PolicyPremi' => $Product['ProductPlanPremium'],
								'PolicyEffectiveDate' => date('Y-m-d H:i:s'), 
								'PolicySalesDate' => date('Y-m-d H:i:s'), 
								'PolicyNumber' => $Policyautogen['PolicyNumber']
						)))
						{
							$PolicyId = $this -> db -> insert_id();
							if( $PolicyId )
							{
								$p['PolicyId'] = $PolicyId;
								$p['InsuredCreatedTs']=date('Y-m-d H:i:s');
								$p['CreatedById'] = $SellerId;
								if(is_array($p))
								{
									if( $InsertId = $this -> M_Insured -> _SaveDataInsured($p) )
										{
											$p['InsuredId'] = $InsertId;
											if(is_array($p) )
											{
												$this -> _SaveBenefiecery($p);
											}
										}
								}
							}	
						}	
							
						//call back data 	
						$_conds = array
						(
							'PolicyNumber' => $Policyautogen['PolicyNumber'], 
							'PolicyId' => $PolicyLastId
						 );
					}
				}
				else{
					$_conds['msg'] = 'Please, select other Group Premi';
				}
			}
			else{
				$_conds['msg'] = 'Check Data Input';
			}
		}
		else{
			$_conds['msg'] = 'Process Saving';
		}
	}

	return $_conds;	
}  

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
  
  
function _setYesPecah($p=NULL)
{
	$ProductId = (isset($p['ProductId']) ? $p['ProductId'] : null );
	$CustomerId = (isset($p['CustomerId']) ? $p['CustomerId'] : null ); 
	$MemberGroup = (isset($p['InsuredGroupPremi']) ? $p['InsuredGroupPremi'] : null ); 
	
	$_conds = array();
	
	if(!is_null($ProductId))
	{
		$this -> M_Generator -> _set_polis_number($ProductId,'N' ); 
		if( class_exists('M_Generator') )
		{
			
			$PolicyNumber  = $this -> M_Generator -> _get_polis_number();
			$PolicyLastId  = $this -> M_Generator -> _get_last_number();
			
			if( $this -> db -> insert('t_gn_policyautogen', array(
				'ProductId' => $ProductId, 'CustomerId' => $CustomerId,
				'MemberGroup' => $MemberGroup, 'PolicyNumber' => $PolicyNumber, 	
				'PolicyLastNumber' => $PolicyLastId				
			)))
			{
				$this -> M_payers -> _SaveDataPayers($p);
				
				$_conds = array(
					'PolicyNumber' => $PolicyNumber, 
					'PolicyId' => $PolicyLastId
				);
			}
		}	
	}

	return $_conds;	
}
  
// -------------------------------------------------------------

/* 
 * Method 		_select_count_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 
 function _checkValidPrefix($input)
  {
	$count = 0;
	
	$sql = "select a.ValidCCPrefixId from t_lk_validccprefix a where a.ValidCCPrefix = '".$input."'";
	$qry = $this->db->query($sql);
	
	if($qry->num_rows() > 0)
	{
		$count = 1;
	}
	
	return $count;
  }
// -------------------------------------------------------------

/* 
 * Method 		_select_count_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
   
  function _GetZip($id)
  {
		$zip = array();
		
		$qry = $this -> db -> query("select concat( a.ZipKotaKab,', ',a.ZipKecamatan,', ',a.ZipKelurahan,', ',a.ZipCode) as ZipFull from t_lk_zip a where a.ZipProvinceId = '".$id."'");
		foreach( $qry -> result_assoc() as $rows ){
				$zip[trim($rows['ZipFull'])] = $rows['ZipFull'];
		}
		
		return $zip;
  }
 // -------------------------------------------------------------

/* 
 * Method 		_select_count_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
  
  function _getGenderByTitle($id)
  {
	$gen_id = 0;
	
	$sql = "select a.GenderId from t_lk_salutation a where a.SalutationId = '".$id."'";
	$qry = $this->db->query($sql);
	
	if($qry->num_rows() > 0)
	{
		$gen_id = $qry->result_singgle_value();
	}
	
	return $gen_id;
  }
  
// -------------------------------------------------------------

/* 
 * Method 		_select_count_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 public function SelectIsBenefiecery( $ProductId = 0 )
{
 $this->result_value = 0;
 $this->db->reset_select();
 $this->db->select("a.ProductBeneficieryFlag", FALSE);
 $this->db->from("t_gn_product a ");
 $this->db->where ("a.ProductId", $ProductId);
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ) {
	$this->result_value = $rs->result_singgle_value();
 }
	
 return (int)$this->result_value;
 
} 
 
// -------------------------------------------------------------

/* 
 * Method 		_select_count_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 
 public function _SearchAddressNew( $out )
{
  $arr_address = array(); // default data 
  if( !$out->fetch_ready() ){ 
	return (array)$arr_address; 
  }
   
 // ---------- kep data on parameter -----------------------
 
    $ProvinceId = (int)$out->get_value('ProvinceId');
    $Keyword = $out->get_value('keyword');
 
// ------------------ default spelect ---------------------- 
    $this->db->reset_select();
    $this->db->select(" a.ZipId, a.ZipCode, a.ZipProvinceId, b.Province,
					   a.ZipKelurahan, a.ZipKecamatan, a.ZipDT, a.ZipKotaKab", FALSE);
					   
	$this->db->from("t_lk_zip a ");
	$this->db->join("t_lk_province b "," a.ZipProvinceId = b.ProvinceId", "LEFT");
	$this->db->where("a.ZipProvinceId", $ProvinceId);
	$this->db->where("( 
			a.ZipCode REGEXP ('^$Keyword') 
			OR a.ZipKelurahan REGEXP ('^$Keyword') 
			OR a.ZipKecamatan REGEXP ('^$Keyword')
			OR a.ZipKotaKab REGEXP ('^$Keyword') )", "", FALSE);
	$this->db->order_by('a.ZipKelurahan','ASC');
	$this->db->limit(10);
	
	$rs  = $this->db->get();
	if( $rs->num_rows() > 0 ) {
		$arr_address = $rs->result_assoc();
	}
	
	return (array)$arr_address;
 }
  


  // ==================== END CLASS ===========================
}
?>