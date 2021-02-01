<?php
class M_Loger extends EUI_Model
{


 function __construct(){
		// look on table t_gn_activitylog;
	}
	
 function set_activity_log( $_comment = '' )
 {
	$activity = array(
		'ActivityUserId' => $this -> EUI_Session -> _get_session('UserId'), 
		'ActivityDate' => $this -> EUI_Tools -> _date_time(), 
		'ActivityEvent' => $_comment
	);
	
	if( $_comment !='' )
	{
		//$this -> db -> insert('t_gn_activitylog',$activity );
		$this -> db -> insert('t_gn_activitylog',$activity );
	}	
 }

 
}

?>