<?php
/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : test unit
 */
 
 
class M_XDays extends EUI_Model
{

private static $self_xdays_fields = null;
private static $self_xdays_tables = null;

/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : test unit
 */
 
 private static $intance = null;
 
/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : test unit
 */
 
 public function __construct()
 {
	self::$self_xdays_fields = array('CustomerNumber' => 'CustomerNumber');
	self::$self_xdays_tables = 't_gn_bucket_customers';
 }
 
/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : test unit
 */
 
 public static function & get_instance() 
 {
	if( is_null(self::$intance)){
		self::$intance = new self();
	}
	return self::$intance;
 }

/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : test unit
 */
 
 
 public function X_Unit()
 {
	print _getNextCurrDate( date('Y-m-d'), 30);
	print_r( _getDateDiff(date('Y-m-d'), '2014-09-05')); 
 }

/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : date in format en.
 * @ param : intval in  (INT).
 */
 
public function X_EndOffDays($date=NULL, $intval=0 ) 
{
	return _getNextCurrDate($date, (INT)$intval); 
}
 
 
 
/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : end_date in format en.
 * @ param : start_date in format en.
 
 */
 
public function X_IntervalDays( $end_date = null, $start_date = null ) 
{
	$X_days = _getDateDiff($end_date, $start_date ); 
	return (INT)$X_days['days_total'];
 }
 
 /* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : end_date in format en.
 * @ param : start_date in format en.
 
 */
 
public function X_IntervalMonth( $end_date = null, $start_date = null ) 
{
	$X_days = _getDateDiff($end_date, $start_date ); 
	return (INT)$X_days['months_total'];
 }
  
/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : $param in array 2 dimensional 
 */
 
 public function X_Existing( $param = null ) 
{
	$this->db->reset_select();
	$this->db->select('CustomerId, CustomerNumber');
	$this->db->from( self::$self_xdays_tables );
	
	$stack = FALSE; $conds = 0;
	if( is_array($param) ) 
		foreach( $param as $field => $values ) 
	{
		 if( in_array($field, array_keys(self::$self_xdays_fields)) )
		{
			$stack = TRUE;
			$this->db->where(self::$self_xdays_fields[$field], $values);
		}
	}
	
	// --------- stack in OK -------------------------
	if( $stack )
	{
		$rs = $this->db->get();
		if( ($rs->num_rows() > 0 ) 
			AND $rows = $rs->result_first_assoc() )
		{
			return (string)$rows['CustomerNumber'];
		}		
	}
	
	return $conds;
	
 }
  

/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : $param in array 2 dimensional 
 */
 
 public function X_ExistListingDays( $param = null, $Template=null) 
{
	$this -> db -> select('CustomerId, date(CustomerUploadedTs) as CustomerUploadedTs, date(Expire_DateTs) as Expire_DateTs, x_days');
	$this -> db -> from( self::$self_xdays_tables );
	$this -> db -> order_by('CustomerId','DESC');
	$stack = false; $conds = 0;
	
	if( is_array($param) )
	{
		foreach( $param as $field => $values ) 
		{
			if( in_array($field, array_keys(self::$self_xdays_fields)) ){
				$stack = true;
				$this -> db -> where(self::$self_xdays_fields[$field], $values);
			}
		}
	}
	
	// stack in OK 
	
	if( $stack )
	{
		if( $rows = $this -> db -> get() -> result_first_assoc() ) 
		{
			$conds = array( 
				'interval_days' => $this -> X_IntervalDays($rows['Expire_DateTs'], date('Y-m-d')),
				'expired_days' => strtotime($rows['Expire_DateTs']),
				'indicated_days' => strtotime(date('Y-m-d')),
				'diffrent_days' => ((INT)strtotime($rows['Expire_DateTs']) - (INT)strtotime(date('Y-m-d')))
			);
		}
	}
	
	return $conds;
	
 }
 
 
 
/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : $param in array 2 dimensional 
 */
 
 public function X_ListingDays($Template) 
{
	$expired_days = $this -> X_EndOffDays(date('Y-m-d'), (INT)$Template['TemplateLimitDays']);
	$_list_days = array(
		'interval_days' => $this -> X_IntervalDays($expired_days, date('Y-m-d')),
		'expired_days'  => $expired_days
	);
	
	//print_r($_list_days);
	return $_list_days;
	
 }
 
 
/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : test unit
 */
  
}

?>