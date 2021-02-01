<?php
class CallReminder extends EUI_Controller
{

/*  
 * @ param  : aksesor of *super class 
 * @ param  : - 
 * ------------------------------------------------------------------------------
 */ 
public function CallReminder()
{
	parent::__construct();
	$this -> load->model(array(base_class_model($this)));
}
	
/*  
 * @ param  : default of index main content class controller   
 * @ param  : - 
 * ------------------------------------------------------------------------------
 */ 
public function index(){ }
	

/*  
 * @ param  : PrimaryID ( INT ) / CustomerId / AppoinmentId / CallVerified ID  
 * @ param  : - 
 * ------------------------------------------------------------------------------
 */ 
public function UpdateAppoinment() 
{
	$_conds = array('success' => 0 );
	if( $this -> EUI_Session->_have_get_session('UserId') 
		AND  $this -> URI->_get_have_post('PrimaryID') )
	{
		if( $res = $this -> {base_class_model($this)} -> _setUpdateAppoinment($this ->URI->_get_post('PrimaryID')))
		{
			$_conds = array('success' => 1 );
		}
	}
	
	/* callback server response to client */
	__(json_encode($_conds));
	
}	
	

/*  
 * @ param  : $_SESSION_USER_ID ( INT )
 * @ param  : $_RETURN JSON OBJECT
 * ------------------------------------------------------------------------------
 * @ notes  :  - get all appoinment by session user login identified by User ID 
 */ 
 public function Appoinment()
 {
	$result = array('counter' => 0 );
	if( $rs_vols_rows = $this ->{base_class_model($this)} ->_getSelectAppoinment() )
	{
		$result  = ( !is_null($rs_vols_rows) ? $rs_vols_rows : array('counter' => 0 ) );
	}
	
	__(json_encode($result));	
 }
	
	
}

?>