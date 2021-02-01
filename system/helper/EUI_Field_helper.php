<?php 
//////////////////////////////////////////////////////////////////////////////////////////////////
/// START HEADER TOOLS METHODE GET ALL REFERENCE DATA //////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

/*
 * Change with simple aksess keys : --
 * 2015-02-26$omen
 */
/*
 * @ def 		:  Class Attribute Properies  
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
class EUI_Field_value
{

private $field_labels = array();
private static $field_combo = null;
private static $instance  = null;	


/*
 * @ def 		:  get by campaign 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function __construct() 
{
	$this->field_labels = array
	( 
		'deb_principal'  => 'getCurrency',
		'deb_amount_wo'  => 'getCurrency',
		'deb_wo_amount'	 => 'getCurrency',
		'deb_last_pay' 	 => 'getLasPayment', 
		'deb_principal'  => 'getCurrency',
		'deb_bal_afterpay'=>'getCurrency',
		'deb_pri_afterpay'=>'getCurrency',
		'deb_fees' 		 => 'getCurrency',
		'deb_premi_utama'=> 'getCurrency',
		'deb_premi_rider'=> 'getCurrency',
		'deb_cmpaign_id' => 'getTotalPayment',
		'deb_limit' 	 => 'getCurrency',
		'deb_interest' 	 => 'getCurrency',
		'deb_afterpay' 	 => 'getCurrency',
		'deb_biaya'		 => 'getCurrency',
		'deb_pay_date' 	 => 'getEnglishIndonesia',
		'deb_dob' 		 => 'getEnglishIndonesia',
		'deb_b_d' 		 => 'getEnglishIndonesia',
		'deb_open_date'  => 'getEnglishIndonesia',
		/* OUTBOUND */
		'TGLLAHIR'  => 'getOutboundDate',
		'TGLLAHIR_TTG'  => 'getOutboundDate',
		'TGLSPAJ'  => 'getOutboundDate',
		'MULAIASURANSI'  => 'getOutboundDate',
		'TGLBP3'  => 'getOutboundDate',
		'EXPIRASI'  => 'getOutboundDate',
		'TGLAKHIRPREMI'  => 'getOutboundDate',
		'TGL_TERIMA_SPAJ'  => 'getOutboundDate',
		'TGL_CLEANCASE'  => 'getOutboundDate',
		'TGLSUBMITBAC'  => 'getOutboundDate',
		'MULAS'  => 'getOutboundDate',
		/* ----------------------------------------- */
		'PREMI1'  => 'getCurrency',
		'PREMI2'  => 'getCurrency',
		'JUAMAINPRODUK'  => 'getCurrency',
		'EXTRAPREMI'  => 'getCurrency',
		'UP_RIDER'  => 'getCurrency',
		'PREMIRIDER'  => 'getCurrency',
		'EXTRAPREMIRIDER'  => 'getCurrency',
	);
}	

/*
 * @ pack : function getCurrency
 */

 public function getCurrency( $argv_vars  = 0 )
{
	$number = (INT)$argv_vars;
	if( $number )
	{
		if( function_exists('_getCurrency') ){
			return (string)_getCurrency($argv_vars);	
		} else {
			return 0;
		}	
	} else {
		return 0;
	}		
}

 public function getOutboundDate( $argv_vars  = null )
{
	return date('d/m/Y',strtotime($argv_vars));
}
/*
 * @ pack : function getCurrency
 */

 public function getEnglishIndonesia( $argv_vars  = null )
{
	if( function_exists('_getOptionDate') ){
		return (string)_getOptionDate($argv_vars, 'in');	
	} else {
		return 0;
	}	
}

/*
 * @ pack : function getCurrency
 */

 public function getEnglishOptional( $argv_vars  = null )
{
	if( function_exists('_getOptionDate') ){
		return (string)_getOptionDate($argv_vars, 'en');	
	} else {
		return 0;
	}	
}

/*
 * @ pack : function getLasPayment
 */
 public function getLasPayment( $argv_vars = 0 ) 
{
  $Amount = 0;
  
// @ pack : instance  
 if( !class_exists('_CreateLayout')) {
	return FALSE;
 }
 
 $Flxible =& _CreateLayout::get_instance();
 
// @ pack : cek class 
 
 if( !class_exists('M_ModContactDetail')) {
	return FALSE;
 }
 
 $Contact =& M_ModContactDetail::Instance();
  
  // @ pack : ---------------------------
  
  $Debitur =& $Flxible->_getCustomerId();  
  if( $Debitur ) {
	$Amount = $Contact->_get_last_payment($Debitur['deb_id']);
  }
   
  if( function_exists('_getCurrency') ){
	return (string)_getCurrency($Amount);	
  } else {
	 return 0;
  }
}

/*
 * @ pack : function getTotalPayment
 */
 
 public function getTotalPayment( $argv_vars = 0 ) 
{
// get parent class  --------------------------------

 $UI=&get_instance();

// set define  -------------------------> 

 $total_payment = 0;
 
// @ pack : instance  

 if( !class_exists('EUI_Object') ){
	$UI->load->helpers('EUI_Object');
 }
 
 if( !class_exists('_CreateLayout')) {
	return FALSE;
 }
 
 $Flxible =& _CreateLayout::get_instance();

// @ pack : cek class 
 
 if( !class_exists('M_ModOutstanding')) {
	$UI->load->model('M_ModOutstanding');
 }
  
 $outstanding=& M_ModOutstanding::Instance();
  
  // @ pack : ---------------------------
  
  $Debitur = new EUI_Object( $Flxible->_getCustomerId() );  
  
  if( $Debitur ) {
	$total_payment = $outstanding->_get_total_outstanding( $Debitur->get_value('deb_id'));
  }
   
  if( function_exists('_getCurrency') )
  {
	return (string)_getCurrency($total_payment);
  } else {
	 return 0;
  }
}

 
/*
 * @ pack : function getCurrency
 */

 public function getDateEnglish( $argv_vars  = null )
{
	if( function_exists('_getDateEnglish') ){
		return (string)_getDateEnglish($argv_vars);	
	} else {
		return 0;
	}	
}
/*
 * @ pack : function getCurrency
 */

 public function getDateIndonesia( $argv_vars  = null )
{
	if( function_exists('_getDateIndonesia') ){
		return (string)_getDateIndonesia($argv_vars);	
	} else {
		return 0;
	}	
}
 
/*
 * @ pack : function hendle group 
 */

public function CardTypeId( $CardTypeId = null  )
{
	if( !is_null($CardTypeId) )
	{
		$iniatilize = $this->_get_initialize();
		return $iniatilize['CardType'][$CardTypeId];
	}
	else
		return $CardTypeId;
}

/*
 * @ pack : function hendle group 
 */

public function Marital_Status( $Marital_Status = null )
{
	if( !is_null($Marital_Status) )
	{
		$iniatilize = $this->_get_initialize();
		return $iniatilize['Maried'][$Marital_Status];
	}
	else
		return $Marital_Status;
}

/*
 * @ pack : function hendle group 
 */

public function _get_initialize()
{
	
	if( is_null(self::$field_combo) )
	{
		self::$field_combo = array();
		
		$UI =& get_instance();
		$UI->load->model("M_Combo");
		$M_Combo =& M_Combo::get_instance();
		
		foreach( $M_Combo->_getSerialize() as $keys => $method )
		{
			if((STRTOLOWER($keys)!='serialize') AND (STRTOLOWER($keys)!='instance') 
				AND (STRTOLOWER($keys)!='nstruct') AND (STRTOLOWER($keys)!='t'))
			{
				self::$field_combo[$keys] = $M_Combo->$method(); 	
			}
		}
	}
	
	return self::$field_combo;
}

/*
 * @ pack : function hendle group 
 */

 public static function & get_instance()
{
	if( is_null(self::$instance) ) {
		self::$instance = new self();
	}
	return self::$instance;
}
/*
 * @ pack : function hendle group 
 */
public function FieldValue( $keys = null, $values=null )
{
	if( !is_null($keys) )
	{
		if( in_array(trim($keys), array_keys($this->field_labels)) ) 
		{
			return $this ->{trim($this->field_labels[$keys])}($values);
		}
		else
			return $values;
	}
	else
		return null;
 }
 
 // END OF CLASS 
 
}


//////////////////////////////////////////////////////////////////////////////////////////////////
/// STOP HEADER TOOLS METHODE GET ALL REFERENCE DATA //////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

