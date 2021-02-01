<?php 
// -------------------------------------------------------------------
/*
 * @ this event loger to write user activity from 
 *   system required .
 *	 
 */
 
class M_EventLoger extends EUI_Model
{


//--------------------------------------------------------------------------------------
/*
 *
 * @ package		instance of class  
 * @ param			not assign parameter
 */
 
 private static $Instance   = null; 
 public static function &Instance()
{
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
}

//--------------------------------------------------------------------------------------
/*
 *
 * @ package		instance of class  
 * @ param			not assign parameter
 */
 
 protected function & _EventOption( $event = null )
{
  $event = strtoupper( $event );
  $arr_option = array
  (
	'ADD' => 'ACTION_EVENT_ADD',
	'DEL' => 'ACTION_EVENT_DELETE',
	'UPD' => 'ACTION_EVENT_UPDATE',
	'DIS' => 'ACTION_EVENT_DISABLE',
	'ENB' => 'ACTION_EVENT_ENABLE',
	'REG' => 'ACTION_EVENT_REGISTER',
	'OUT' => 'ACTION_EVENT_LOGOUT',
	'INC' => 'ACTION_EVENT_LOGIN',
	'REF' => 'ACTION_EVENT_REFRESH',
	'CNL' => 'ACTION_EVENT_CANCEL',
	'RET' => 'ACTION_EVENT_RESET',
	'RJT' => 'ACTION_EVENT_REJECT'
 );
	
// --- not null ----------------------->
 if( is_null($event) ){
	return FALSE;
 }
	
 if( isset($arr_option[$event]) ) {
	return (string)$arr_option[$event];
 } else {
	 return (string)$event;
 }
 return FALSE;
 
}

//--------------------------------------------------------------------------------------
/*
 *
 * @ package		instance of class  
 * @ param			not assign parameter
 */
 public function _EventLoger($Event = '', $Description = '' ) 
{
	if(!is_array($Description) )
  {
	$Description = array($Description);	
  }	
	
  $Description = join(" ", $Description);
  $ActivityLocation = _getIP();
	
// -------------------------------------------------------
	
  $Event = & $this->_EventOption( $Event );
  if( $Event )
  {
	$this->db->reset_write();
	$this->db->set("ActivityUserId",strtoupper(_get_session('UserId')));
	$this->db->set("ActivityUserName",strtoupper(_get_session('Username')));
	$this->db->set("ActivityDate", date('Y-m-d H:i:s'));
	$this->db->set("ActivityEvent", $Event);
	$this->db->set("ActivityDesc", ucwords($Description));
	$this->db->set("ActivityLocation", $ActivityLocation );
		
	// ---------------- update its -------------------------------------
	
		$this->db->insert("t_gn_activitylog");
		if( $this->db->affected_rows() > 0 ){
			return true;
		}
		return FALSE;
	}	 
 }

 // ======================== END CLASS ================================
 

}

?>