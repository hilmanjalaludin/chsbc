<?php

class M_Tools extends EUI_Model
{

	var $__key= null ;
	var $__nkey= null ;

	private static $Instance = null;
	
	/*
	 * @ def 		: approval save point 
	 * -----------------------------------------
	 *
	 * @ params  	: post & definition paymode 
	 * @ return 	: void(0)
	 */
	public function M_Tools()
	{
		if( is_null( $this ->__key ) ){
			$this ->__key = array(
				"CustomerDOB",
				"GenderId",
				"CustomerHomePhoneNum",
				"CustomerMobilePhoneNum",
				"CustomerWorkPhoneNum",
				"Tel_1",
				"Tel_2",
				"Tel_3",
				"Tel_4",
				"DOB",
				"dob",
				"GENERATION_DT",
				"Generation_dt",
				"generation_dt",
				"Dbase_Expire_dt",
				"Start_Tele",
				"End_Tele",
				"phone1",
				"phone2",
				"MOBILE",
				"map_phone1",
				"map_phone2",
				"map_MOBILE",
				"OPEN_DATE",
				"open_date",
				"Max_Maturity_date",
				"max_maturity_date",
				"ORI_FNL_LOAN_DUEDATE",
				"ori_fnl_loan_duedate",
				"Maturity_date06",
				"maturity_date06",
				"Maturity_date12",
				"maturity_date12",
				"Maturity_date18",
				"maturity_date18",
				"Maturity_date24",
				"maturity_date24",
				"Maturity_date30",
				"maturity_date30",
				"EXPIRE_DT",
				"expire_dt",
				"Duedate",
				"duedate",
				"Expire_dt",
				"end_tele",
				"Phone1",
				"sex",
			);
		}
		
		if( is_null( $this ->__nkey ) ){
			$this ->__nkey = array(
				"due_date" 		=> "CustomerDOB",
				"expired_date" 	=> "CustomerDOB",
				"CustomerDOB" 	=> "CustomerDOB",
				"GenderId" 		=> "GenderId",
				"CustomerHomePhoneNum" 	=> "CustomerHomePhoneNum",
				"CustomerMobilePhoneNum"=> "CustomerHomePhoneNum",
				"CustomerWorkPhoneNum" 	=> "CustomerHomePhoneNum",
				"Tel_1" => "CustomerHomePhoneNum",
				"Tel_2" => "CustomerHomePhoneNum",
				"Tel_3" => "CustomerHomePhoneNum",
				"Tel_4" => "CustomerHomePhoneNum",
				"DOB"	=> "CustomerDOB",
				"dob"	=> "CustomerDOB",
				"GENERATION_DT" 	=> "CustomerDOB",
				"Generation_dt" 	=> "CustomerDOB",
				"generation_dt" 	=> "CustomerDOB",
				"Dbase_Expire_dt"	=> "CustomerDOB",
				"Start_Tele"		=> "CustomerDOB",
				"End_Tele"			=> "CustomerDOB",
				"phone1"			=> "CustomerHomePhoneNum",
				"phone1"			=> "CustomerHomePhoneNum",
				"Phone1"			=> "CustomerHomePhoneNum",
				"MOBILE"			=> "CustomerHomePhoneNum",
				"map_phone1"		=> "CustomerHomePhoneNum",
				"map_phone2"		=> "CustomerHomePhoneNum",
				"map_MOBILE"		=> "CustomerHomePhoneNum",
				"OPEN_DATE"			=> "CustomerDOB",
				"open_date"			=> "CustomerDOB",
				"Max_Maturity_date" => "CustomerDOB",
				"max_maturity_date"	=> "CustomerDOB",
				"ORI_FNL_LOAN_DUEDATE" => "CustomerDOB",
				"ori_fnl_loan_duedate" => "CustomerDOB",
				"Maturity_date06"	   => "CustomerDOB",
				"maturity_date06"	   => "CustomerDOB",
				"Maturity_date12"	   => "CustomerDOB",
				"maturity_date12"	   => "CustomerDOB",
				"Maturity_date18"	   => "CustomerDOB",
				"maturity_date18"	   => "CustomerDOB",
				"Maturity_date24"	   => "CustomerDOB",
				"maturity_date24"	   => "CustomerDOB",
				"Maturity_date30"	   => "CustomerDOB",
				"maturity_date30"	   => "CustomerDOB",
				"EXPIRE_DT"			   => "CustomerDOB",
				"expire_dt"			   => "CustomerDOB",
				"Duedate"			   => "CustomerDOB",
				"duedate"			   => "CustomerDOB",
				"Expire_dt"			   => "CustomerDOB",
			);
		}
	}

	public static function &Instance()
	{

	 	if( is_null(self::$Instance) ) {
			self::$Instance = new self();
	 	}
	 
	 	return self::$Instance;
	} 

	/*
	 * @ def 		: approval save point 
	 * -----------------------------------------
	 *
	 * @ params  	: post & definition paymode 
	 * @ return 	: void(0)
	 */
 	public function __tools_format( $keys = null, $values=null )
	{
		if( !is_null($keys) )
		{
			if( in_array($keys, $this ->__key) ) {
				return call_user_func_array(array( get_class($this), $keys ), array( $values ) );
			} else {
				return $values;
			}
		} else {
			return null;
		}
	
 	} 
 
	public function setCallEvent( $keys = null, $values = null )
	{
		if( !is_null($keys) )
		{
			if( in_array($keys, array_keys($this ->__nkey) ) ) 
			{
				return call_user_func_array( array(get_class($this), $this->__nkey[$keys]), array($values) );
			} else {
				return $values;
			}
		} else {
			return null;
		}
	} 
 
	/*
	 * @ def 		: approval save point 
	 * -----------------------------------------
	 *
	 * @ params  	: post & definition paymode 
	 * @ return 	: void(0)
	 */
	public function CustomerDOB( $date = null ) // m/d/y 
 	{
		$dates = NULL;
		if( !is_null($date) ) {
			$dates = date('Y-m-d', strtotime($date));
		}
		return $dates;
 	}
 
	/*
	 * @ def 		: approval save point 
	 * -----------------------------------------
	 *
	 * @ params  	: post & definition paymode 
	 * @ return 	: void(0)
	 */
	public function GenderId( $gender = null ) // m/d/y 
	{
		$GenderID = NULL;
		if( !is_null($gender) ) 
		{
			if(strtoupper($gender)=='F' )
				$GenderID = 2;
			
			if(strtoupper($gender)=='M' )
				$GenderID = 1;
		}
		return $GenderID;
	} 
 
	/*
	 * @ def 		: approval save point 
	 * -----------------------------------------
	 *
	 * @ params  	: post & definition paymode 
	 * @ return 	: void(0)
	 */
	public function CustomerHomePhoneNum($phone=null){
		return _getPhoneNumber($phone);
	}
 
	/*
	 * @ def 		: approval save point 
	 * -----------------------------------------
	 *
	 * @ params  	: post & definition paymode 
	 * @ return 	: void(0)
	 */
	public function CustomerMobilePhoneNum($phone=null){
		return _getPhoneNumber($phone);
	}

	/*
	 * @ def 		: approval save point 
	 * -----------------------------------------
	 *
	 * @ params  	: post & definition paymode 
	 * @ return 	: void(0)
	 */
	public function CustomerWorkPhoneNum($phone=null){
		return _getPhoneNumber($phone);
	}

	/*
	 * @ def 		: approval save point 
	 * -----------------------------------------
	 *
	 * @ params  	: post & definition paymode 
	 * @ return 	: void(0)
	 */
	public function Tel_1($phone=null){
		return _getPhoneNumber($phone);
	}

	/*
	 * @ def 		: approval save point 
	 * -----------------------------------------
	 *
	 * @ params  	: post & definition paymode 
	 * @ return 	: void(0)
	 */
	 
	public function Tel_2($phone=null){
		return _getPhoneNumber($phone);
	}

	/*
	 * @ def 		: approval save point 
	 * -----------------------------------------
	 *
	 * @ params  	: post & definition paymode 
	 * @ return 	: void(0)
	 */
	public function Tel_3($phone=null){
		return _getPhoneNumber($phone);
	}

	/*
	 * @ def 		: approval save point 
	 * -----------------------------------------
	 *
	 * @ params  	: post & definition paymode 
	 * @ return 	: void(0)
	 */ 
	public function Tel_4($phone=null){
		return _getPhoneNumber($phone);
	}
}
?>