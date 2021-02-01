<?php
/*
 * E.U.I 
 *
 
 * subject	: ProductForm
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/ProductForm/
 */
 
class ProductForm extends EUI_Controller
{

private static $ProductId = null;
private static $CustomerId = null;
private static $ViewLayout = null;

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : null
 * @ author : razaki team
 * 
 */
 
 public function __construct()
{
	parent::__construct();
	
// ------------ load attribute ----------------------
	
	$this->load->model(array('M_ProductForm','M_Payers', 'M_Combo','M_Insured', 'M_Benefiecery','M_PaymentType', 'M_Underwriting','M_ValidPayment', 'M_EditPolicy') );
	$this->load->helper(array('EUI_Object'));
	
// ------------ load attribute ----------------------

	$objProd =& get_class_instance('M_ProductForm');
	if( is_null(self::$CustomerId)){
		self::$CustomerId =& _get_64post('CustomerId');
	}
	
	self::$ProductId =_get_post('ProductId'); 
	 if(!is_null(self::$ProductId)) 
	{
		self::$ViewLayout = $objProd->_getAddFormLayout(self::$ProductId);
	}	
} 

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
function Premi()
{

 $_post = array();
 
 // date text 
 if( $this -> URI->_get_have_post('date') ) {
	$d = self::getUmurSize();
	if( $d ) { 
		$_post['Age'] = $d['age']; 
	}	
 }
 
 // date text 
 if( $this -> URI->_get_have_post('GroupPremi') )
	 $_post['PremiumGroupId'] = $this -> URI->_get_post('GroupPremi');

 // date text  
 if( $this -> URI->_get_have_post('PaymentMode') )
	 $_post['PayModeId'] = $this -> URI->_get_post('PaymentMode');
	 
 // date text 
 if( $this -> URI->_get_have_post('PlanType') )
	 $_post['ProductPlan']= $this -> URI->_get_post('PlanType');
 
 // date text 
 if( $this -> URI->_get_have_post('ProductId') )
	$_post['ProductId'] = $this -> URI->_get_post('ProductId');
	

// if have date gender  
 if( $this -> URI->_get_have_post('GenderId') )
	$_post['GenderId'] = $this -> URI->_get_post('GenderId');
		
	$diff = array('premi'=>0);
	if( is_array($diff))
	{
		$premi =  $this->{base_class_model($this)}->_getPremi($_post);
		if( is_array($premi) )
		{
			$diff['premi'] = $premi['ProductPlanPremium'];
		}	
	}
	
 __(json_encode($diff));
 
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
function getUmurSize()
{	
	$_conds = null;
	
	$d = $this -> EUI_Tools -> _DateDiff(
		$this -> EUI_Tools ->_date_english( $this -> URI -> _get_post('date')),
		date('Y-m-d')
	);
	
	// get data diffrent 
	
	if( is_array($d)  
		AND isset($d['months_total']) 
		AND isset($d['months_total']))
	{
		$Month = (INT)$d['months_total'];
		$Day = (INT)$d['days_total'];
		
		if($d['months'] >= 6)
		{
			$years = ($d['years']+1);
		}
		else{
			$years = $d['years'];
		}
		
		$_conds = array('age' => $years);
		/* if($Month > 0 ){ // hitung by month
			// $years = round(($Month/12),2);
			$years = round(($Month/12),0);
			
			/* bwt handle yang 6 bulan 
			
			
			
			$_conds = array('age' => $years);
		}
		else{ // hitung hari
			// $years = round(($Day/365),2);
			$years = round(($Day/365),2);
			$_conds = array('age' => $years);
		} */
	}
	
	// cek range of age interval list of by product 
	
	if( ($rows = $this ->{base_class_model($this)}->_getAgeRange( self::$ProductId, $years ))!=true ) 
	{
		$_conds = array('age' => '');	
	}
	
	return $_conds;	
} 

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
function DOB()
{
	$_conds = array('age' => 0);
	if(self::getUmurSize()){
		$_conds = self::getUmurSize();
	}
	
	echo json_encode($_conds);
}

function LoadBlank()
{

}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
function getAddPayers()
{	
	$Payers = null;
	if(is_null($Payers) )
	{
		$Payers = $this->M_Payers->_getAddPayers(self::$CustomerId); 
		if(is_array($Payers) ) {
			return $Payers;
		}
		else
			return null;
	}		
}

function getCustomers()
{	
	$Payers = null;
	if(is_null($Payers) )
	{
		$Payers = $this->M_Payers->_getPayerNotExist(self::$CustomerId); 
		if(is_array($Payers) ) {
			return $Payers;
		}
		else
			return null;
	}		
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */

 
public function getAddJavascriptName()
{
	$ProductJavaScript = null;
	if( $rs = $this -> {base_class_model($this)}->_getAddJavascriptName(self::$ProductId) ) {
		$ProductJavaScript = $rs;
	}
	
	return $ProductJavaScript;
	
}


/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */

 
public function getEditJavascriptName()
{
	$ProductJavaScript = null;
	if( $rs = $this -> {base_class_model($this)}->_getEditJavascriptName(self::$ProductId) ) {
		$ProductJavaScript = $rs;
	}
	
	return $ProductJavaScript;
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
public function index()
{
	if( $this -> URI->_get_have_post('CustomerId') 
		AND $this -> EUI_Session->_have_get_session('UserId')) 
	{
		$ViewLayout = $this -> URI->_get_post('ViewLayout');
		switch($ViewLayout)
		{
			case 'ADD_FORM' 	: 
				$this -> FormAddLayout();  
			break;
			
			case 'EDIT_FORM' 	: 
				$this -> FormEditLayout(); 
			break;
		}
	}
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
function _getCampaignId()
{
	$_conds = null;
	if( is_null($_conds))
	{
		if( self::$CustomerId )
		{
			$_conds = $this->{base_class_model($this)}-> _getCampaignId(self::$CustomerId);
		}	
	}
	
	return $_conds;
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */

function getPlan()
{
	$_plan_array = array();
	if( $rows_product_plan = $this->{base_class_model($this)}-> _getPlanProduct(self::$ProductId) ) {
		$_plan_array = $rows_product_plan; 
	}	
	
	return $_plan_array;
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
function getProductForm()
{
	$array = array 
	(
		'ProductId' => $this->{base_class_model($this)}->_getProduct(),
		'PolicyNumber' => $this->{base_class_model($this)}->_getSingglePolicyNumber( self::$CustomerId, self::$ProductId),
		'SalesDate' => date('d-m-Y'),
		'EfectiveDate' => date('d-m-Y'),
		'PecahPolicy' => array( '0'=>'No','1'=>'Yes')
	);
	
	return $array;
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
public function ProductTransaction()
{
	self::$CustomerId = $this -> URI->_get_post('CustomerId');
	
	if( self::$CustomerId !='' )
	{
		$form = array( 
			'Transaction' 	=> $this->getTransaction(),
			'form' 	  		=> self::$ViewLayout,
			'header'		=> $this->{base_class_model($this)}->_getHeader(self::$CustomerId),
			'Payers'		=> $this->getAddPayers()
		);
		
		$this -> load -> form('add_form/'. self::$ViewLayout .'/form_transaction_table',$form);	
	}
}

public function ProductTransactionEdit()
{
	self::$CustomerId = $this -> URI->_get_post('CustomerId');
	
	if( self::$CustomerId !='' )
	{
		$form = array( 
			'Transaction' 	=> $this->getTransaction(),
			'form' 	  		=> self::$ViewLayout,
			'header'		=> $this->{base_class_model($this)}->_getHeader(self::$CustomerId),
			'Payers'		=> $this->getAddPayers()
		);
		
		$this -> load -> form('edit_form/'. self::$ViewLayout .'/form_transaction_table',$form);	
	}
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
function getTransaction()
{
	$_conds = $this ->M_Insured->_getInsuredById(self::$CustomerId);
	return ( is_array($_conds) ? $_conds : array() ); 
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
function getCombo()
{	
	$_serialize = array();
	$_combo = $this -> M_Combo -> _getSerialize();
	foreach( $_combo as $keys => $method )
	{
		if((STRTOLOWER($keys)!='serialize') AND (STRTOLOWER($keys)!='instance') 
			AND (STRTOLOWER($keys)!='nstruct') AND (STRTOLOWER($keys)!='t'))
		{
			$_serialize[$keys] = $this -> M_Combo -> $method(); 	
		}
	}
	
	return $_serialize;
}



// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		-----------------< comment on here >
 */
 
 
  public function getUnderwriting() 
 {
	$obClass =& get_class_instance("M_Underwriting");
	return $obClass->_getUnderwriting(self::$ProductId, self::$CustomerId);
 }
 

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */ 
 public function getIsBenefiecery()
{
	$obClass =& get_class_instance(base_class_model($this));
	return $obClass->SelectIsBenefiecery( self::$ProductId );
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */

 private function getComparePaymentType()
 {
    $_compare_select = array();
	$ChanellType = $this->M_PaymentType->_getCampaignPaymentType( self::$CustomerId );	
	// print_r($ChanellType);
	
	if( $_select_array = $this -> getCombo() 
		AND is_array($ChanellType) )
	{
		// print_r($_select_array['PaymentType']);
		foreach($_select_array['PaymentType'] as $keys => $labels ) 
		{	
			if(in_array($keys, $ChanellType))
			{
				$_compare_select[$keys] = $labels;
			}
		}
	}
	
	return $_compare_select;	
 }

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
 public function FormAddLayout()
{
	$obClass =& get_class_instance(base_class_model($this));
	
	if( !is_null(self::$ViewLayout) 
		AND !empty(self::$ViewLayout) ) 
	{
		$form = array
		(
			'form' 				=> self::$ViewLayout,
			'ProductId' 		=> self::$ProductId,
			'PaymentType' 		=> $this->getComparePaymentType(),
			'Product' 			=> $this->getProductForm(),
			'Transaction' 		=> $this->getTransaction(),  
			'Payers' 			=> $this->getAddPayers(),
			'Plan' 				=> $this->getPlan(),
			'JavaScript' 		=> $this->getAddJavascriptName(),
			// 'Combo' 			=> $this->getCombo(),
			'IsBenefiecery'		=> $this->getIsBenefiecery(),
			'Question' 			=> $this->getUnderwriting(),
			'PayModeByPrd' 		=> $obClass->_getPaymentModeByProduct(self::$ProductId),
			'header' 			=> $obClass->_getHeader(self::$CustomerId),
			'Insured'			=> $obClass->_getInsuredSubmited(self::$CustomerId, self::$ProductId),
			// 'SelectPremi' 		=> $obClass->_getPremiSubmited(self::$CustomerId, self::$ProductId),
			'SelectBeneficiary'	=> $obClass->_getBeneficiarySubmited(self::$CustomerId, self::$ProductId) , 
			'Upload'			=> $this->getCustomers()
		);
		
		$this -> load -> form('add_form/'. self::$ViewLayout .'/form_content',$form);
	}	
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
 // Funtion Form Edit
 public function FormEditLayout()
{
	
	$obClass =& get_class_instance(base_class_model($this));
	
	if( !is_null(self::$ViewLayout) 
		AND !empty(self::$ViewLayout) ) 
	{
		$form = array
		(
			'form' 				=> self::$ViewLayout,
			'ProductId' 		=> self::$ProductId,
			'PaymentType' 		=> $this->getComparePaymentType(),
			'Product' 			=> $this->getProductForm(),
			'Transaction' 		=> $this->getTransaction(),  
			'Payers' 			=> $this->getAddPayers(),
			'Plan' 				=> $this->getPlan(),
			'JavaScript' 		=> $this->getAddJavascriptName(),
			'Combo' 			=> $this->getCombo(),
			'Question' 			=> $this->getUnderwriting(),
			'IsBenefiecery'		=> $this->getIsBenefiecery(),
			'PayModeByPrd' 		=> $obClass->_getPaymentModeByProduct(self::$ProductId),
			'header' 			=> $obClass->_getHeader(self::$CustomerId),
			'Insured'			=> $obClass->_getInsuredSubmited(self::$CustomerId, self::$ProductId),
			'SelectPremi' 		=> $obClass->_getPremiSubmited(self::$CustomerId, self::$ProductId),
			'SelectBeneficiary'	=> $obClass->_getBeneficiarySubmited(self::$CustomerId, self::$ProductId), 
			'Upload'			=> $this->getCustomers()
		);
		//echo 'edit_form/'. self::$ViewLayout .'/form_content';
		$this -> load -> form('add_form/'. self::$ViewLayout .'/form_content',$form);
	}
	
 }

  
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
function PolicyNumber()
{
	
	$form = array(
		'Policy' => $this ->{base_class_model($this)} ->_getPolicyNumber($this -> URI->_get_post('CustomerId'),self::$ProductId),
		'Default' => $this ->{base_class_model($this)} ->_getDefault($this -> URI->_get_post('CustomerId'),self::$ProductId)
	);
	$this -> load -> form('add_form/'. self::$ViewLayout .'/form_policynumber',$form);
}

function PolicyNumberEdit()
{
	
	$form = array(
		'Policy' => $this ->{base_class_model($this)} ->_getPolicyNumber($this -> URI->_get_post('CustomerId'),self::$ProductId),
		'Default' => $this ->{base_class_model($this)} ->_getDefault($this -> URI->_get_post('CustomerId'),self::$ProductId)
	);
	$this -> load -> form('edit_form/'. self::$ViewLayout .'/form_policynumber',$form);
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
 function Save()
 {
	if( $this -> URI -> _get_have_post('PecahPolicy') )
	{
		if($this -> URI -> _get_post('PecahPolicy')==0 ){
			$conds = $this->{base_class_model($this)}->_setNoPecah( $this ->URI->_get_all_request() );
		}
		
		if($this -> URI -> _get_post('PecahPolicy')==1 ){
			$conds = $this->{base_class_model($this)}->_setYesPecah( $this ->URI->_get_all_request() );
		}
	}
	
	echo json_encode($conds);
 }
 
// InsuredId

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
public function DetailBenefiacery()
{
	$form = array('ViewBenefiacery' => array() );
	
	$InsuredId = $this -> URI->_get_post('InsuredId');
	$CustomerId = $this -> URI->_get_post('CustomerId');
	
	if( !empty($InsuredId) && !is_null($InsuredId) 
		&& $InsuredId!=FALSE ) 
	{
		$form = array(
			'ViewBenefiacery' =>  $this -> M_Benefiecery ->_getBeneficiaryInsuredId($InsuredId),
			'Combo' => $this->getCombo() );	
	}
	else{
		$form = array(
			'ViewBenefiacery' =>  $this -> M_Benefiecery ->_getBeneficiaryCustomerId($CustomerId), 
			'Combo' => $this->getCombo());
	}
	
	$this -> load -> form('edit_form/'. self::$ViewLayout .'/form_showbenefiacery',$form);
	
} 

function checkValidPrefix()
 {
	$conds = array('bool'=>0);
	
	if($this->{base_class_model($this)}->_checkValidPrefix($this->URI->_get_post('input')))
	{
		$conds['bool'] = 1;
	}
	
	echo json_encode($conds);
 }
 
 function checkValidExpired()
 {
	$conds = array('bool'=>0);
	
	$arr = explode('/',$this->URI->_get_post('input'));
	
	if($arr[1] >= substr(date('Y'),2,2) )
	{
		if($arr[1] == substr(date('Y'),2,2))
		{
			if($arr[0]-1 > date('m') )
			{
				$conds = array('bool'=>1,'date'=>$arr[1]);
			}
		}
		else{
			$conds = array('bool'=>1,'date'=>$arr[1]);
		}
	}
	
	echo json_encode($conds);
 }
 
 function GetZip()
 {
	$_results = array();
	
	$_address = $this -> {base_class_model($this)} -> _GetZip($this->URI->_get_post('province'));
	
	if( is_array($_address) )
	{
		foreach( array_keys($_address) as $index => $zip ) {
			$_results[] = trim($zip);	
		}
	}
	
	
	echo json_encode($_results);
 }
 
 function getGenderByTitle()
 {
	$result = array(
		'gender_id' => $this->{base_class_model($this)}->_getGenderByTitle($this->URI->_get_post('id'))
	);
	
	__(json_encode($result));
 }
 
 function CheckValidationPayment()
 {
	$conds = array(
		'status'=>$this->M_ValidPayment->_CheckTypePayment($this->URI->_get_post('type'))
	);
	
	__(json_encode($conds));
 }
 
 function getTypeValidation()
 {
	$conds = array('digit_check'=>0,'luhn'=>0);
	$type = $this->URI->_get_post('type');
	
	$datas = $this->M_ValidPayment->_getTypeValidation($this->URI->_get_post('type'));
	
	if(count($datas) > 0)
	{
		$conds['digit_check'] = $datas['PaymentDigitCheck'];
		$conds['luhn'] = $datas['PaymentCheckLuhn'];
	}
	
	__(json_encode($conds));
 }
 
 function LuhnStartHere()
 {
	$conds = array('result' => 0);
	
	$ganjil = 0;
	$genap = 0;
	
	$num = $this->URI->_get_post('number');
	$kopi = str_split($num);
	
	foreach($kopi as $key => $value)
	{
		if($key%2 == 1)
		{
			$ganjil += (int)$value;
		}
		else{
			$genap += (int)(strlen($value*2)>1?(($value*2)-9):($value*2));
		}
	}
	
	if( (($genap+$ganjil)%10) == 0 )
	{
		$conds['result'] = 1;
	}
	
	__(json_encode($conds));
 }
 
 function LoadInsured()
 {
	$xxx = array(
		'form' 	  		=> self::$ViewLayout,
		'ProductId'		=> self::$ProductId,
		'PayModeByPrd'  => $this->{base_class_model($this)}->_getPaymentModeByProduct(),
		'Combo'   		=> $this->getCombo(),
		'Plan'			=> $this->getPlan(),
		'Question'		=> $this ->getUnderwriting(),
		'Payers'  		=> $this->M_EditPolicy->_getDataPayers(self::$CustomerId),
		'Insured'		=> $this->M_EditPolicy->_getDataInsured( $this->URI->_get_post('InsuredId') ),
		'Benef'			=> $this->M_EditPolicy->_getBenef( $this->URI->_get_post('InsuredId') )
	);
	
	$this -> load -> form('edit_form/'. self::$ViewLayout .'/form_insured',$xxx);
 }
 
 function ConvertAge2Date()
 {
	$hasil = array('dob'=>'00-00-0000');
	
	$age = $this->URI->_get_post('id');
	$year = date('Y');
	
	$dob = (int)$year-(int)$age;
	
	$hasil['dob'] = date('d-m-').$dob;
	
	__(json_encode($hasil));
 }
 
//--------------------------------------------------------------------

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
  
 public function SearchAddressNew() 
{
  // ---------- process its ------------------------------- 
   $objClass =& get_class_instance(base_class_model($this));
   $this->load->form('add_form/'. self::$ViewLayout .'/form_payers_search_detail', array(
		'datas' => $objClass->_SearchAddressNew(new EUI_Object(_get_all_request()))
	));
 }


// -------------- end class 
 
}
?>