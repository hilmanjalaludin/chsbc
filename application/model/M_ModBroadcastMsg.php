<?php
/*
 * E.U.I 
 *
 
 * subject	: M_ModBroadcastMsg modul 
 * 			  extends under EUI_Model class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysuser/
 */
 
class M_ModBroadcastMsg extends EUI_Model {

/*
 * EUI :: M_ModBroadcastMsg // construtor() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
 

 function M_ModBroadcastMsg(){
	parent::__construct();
 }
 
/*
 * @ def 		: _getAllUser() 
 * -----------------------------------------
 *
 * @ return		: array() 
 * @ param		: none;
 */	
 
 function _getAllUser()
 {
	$sql = null; $_conds = array();
	
	// level : root 
	
	if( $this -> EUI_Session -> _get_session('HandlingType')== USER_ROOT)
	{
		$this -> db -> select("*");
		$this -> db -> from("tms_agent");
		$this -> db -> where(array("user_state"=> 1));
	}
	
	// level : admin
	
	if( $this -> EUI_Session -> _get_session('HandlingType')== USER_ADMIN)
	{
		$this -> db -> select("*");
		$this -> db -> from("tms_agent");
		$this -> db -> where(array("user_state"=> 1));
		$this -> db -> where_not_in('handling_type', array(USER_ROOT));
	}

	// quality HEAD
	
	if( $this -> EUI_Session -> _get_session('HandlingType')== USER_QUALITY_HEAD)
	{
		$this -> db -> select("*");
		$this -> db -> from("tms_agent");
		$this -> db -> where(array("user_state"=> 1));
		$this -> db -> where_not_in('handling_type', array(USER_ROOT));
	}		
	
	// quality STAFF
	
	if( $this -> EUI_Session -> _get_session('HandlingType')== USER_QUALITY_STAFF)
	{
		$this -> db -> select("*");
		$this -> db -> from("tms_agent");
		$this -> db -> where(array("user_state"=> 1));
		$this -> db -> where_not_in('handling_type', array(USER_ROOT));
	}	

	// level : manager 
	
	if( $this -> EUI_Session -> _get_session('HandlingType')== USER_MANAGER)
	{
		$this -> db -> select("*");
		$this -> db -> from("tms_agent");
		$this -> db -> where('user_state',1);
		$this -> db -> where('mgr_id',$this -> EUI_Session ->_get_session('UserId'));
	}	

		// level : manager 
	
	if( $this -> EUI_Session -> _get_session('HandlingType')== USER_ACCOUNT_MANAGER)
	{
		$this -> db -> select("*");
		$this -> db -> from("tms_agent");
		$this -> db -> where('user_state',1);
		$this -> db -> where('act_mgr',$this -> EUI_Session ->_get_session('UserId'));
		$this -> db -> where_not_in('UserId',$this -> EUI_Session ->_get_session('UserId'));
		
	}			
			
				
	// level : supervisor
	
	if( $this -> EUI_Session -> _get_session('HandlingType')== USER_SUPERVISOR)
	{
		$this -> db -> select("*");
		$this -> db -> from("tms_agent");
		$this -> db -> where('user_state',1);
		$this -> db -> where('spv_id',$this -> EUI_Session ->_get_session('UserId'));
		$this -> db -> where_not_in('UserId',$this -> EUI_Session ->_get_session('UserId'));
	}	
		// level : leader
	
	if( $this -> EUI_Session -> _get_session('HandlingType')== USER_LEADER)
	{
		$this -> db -> select("*");
		$this -> db -> from("tms_agent");
		$this -> db -> where('user_state',1);
		$this -> db -> where('tl_id',$this -> EUI_Session ->_get_session('UserId'));
		$this -> db -> where_not_in('UserId',$this -> EUI_Session ->_get_session('UserId'));
	}	
	// level : Telemarketing 
	
	if( $this -> EUI_Session -> _get_session('HandlingType')== USER_AGENT_INBOUND ){
		$this -> db -> select("*");
		$this -> db -> from("tms_agent");
		$this -> db -> where('user_state',1);
		$this -> db -> where_in('UserId',$this -> EUI_Session ->_get_session('UserId'));
	}			
	
	// level : Quality Insurance ( QA ) 
	
	if( $this -> EUI_Session -> _get_session('HandlingType')== USER_QUALITY)
	{
		$this -> db -> select("*");
		$this -> db -> from("tms_agent");
		$this -> db -> where(array("user_state"=> 1) );
		$this -> db -> where_not_in('handling_type', array(USER_ROOT));
	}	
		
	// execute 
	
	$qry = $this -> db -> get();
	if( !is_null($qry))
	{
		foreach( $qry -> result_assoc()  as $rows ) {
			$_conds[$rows['UserId']] = array
			(
				'name' => $rows['full_name'],
				'code' => $rows['id'] 
			);
		}
	}	
	
	return $_conds;
	
 }
 
  function _getAllby($handling=null)
 {
	$sql = null; $_conds = array();
	// var_dump($this -> EUI_Session -> _get_session('HandlingType'),USER_ADMIN);die;
	
	// level : root 
	
	if( $this -> EUI_Session -> _get_session('HandlingType')== USER_ROOT)
	{
		$this -> db -> select("*");
		$this -> db -> from("tms_agent");
		$this -> db -> where(array("user_state"=> 1));
		if ($handling!=0) {
			$this -> db -> where('handling_type', $handling);
		}
	}
	
	// level : admin
	
	if( $this -> EUI_Session -> _get_session('HandlingType')== USER_ADMIN)
	{
		$this -> db -> select("*");
		$this -> db -> from("tms_agent");
		$this -> db -> where(array("user_state"=> 1));
		if ($handling!=0) {
			$this -> db -> where('handling_type', $handling);
		} else {
			$this -> db -> where_not_in('handling_type', array(USER_ROOT));
		}
		
		
	}

	// quality HEAD
	
	if( $this -> EUI_Session -> _get_session('HandlingType')== USER_QUALITY_HEAD)
	{
		$this -> db -> select("*");
		$this -> db -> from("tms_agent");
		$this -> db -> where(array("user_state"=> 1));
		$this -> db -> where_not_in('handling_type', array(USER_ROOT));
	}		
	
	// quality STAFF
	
	if( $this -> EUI_Session -> _get_session('HandlingType')== USER_QUALITY_STAFF)
	{
		$this -> db -> select("*");
		$this -> db -> from("tms_agent");
		$this -> db -> where(array("user_state"=> 1));
		$this -> db -> where_not_in('handling_type', array(USER_ROOT));
	}	

	// level : manager 
	
	if( $this -> EUI_Session -> _get_session('HandlingType')== USER_MANAGER)
	{
		$this -> db -> select("*");
		$this -> db -> from("tms_agent");
		$this -> db -> where('user_state',1);
		if ($handling!=null) {
			$this -> db -> where('handling_type', $handling);
			$this -> db -> where('mgr_id',$this -> EUI_Session ->_get_session('UserId'));
		} else {
			$this -> db -> where('mgr_id',$this -> EUI_Session ->_get_session('UserId'));
		}
		
		
		
	}	

		// level : manager 
	
	// if( $this -> EUI_Session -> _get_session('HandlingType')== USER_ACCOUNT_MANAGER)
	// {
	// 	$this -> db -> select("*");
	// 	$this -> db -> from("tms_agent");
	// 	$this -> db -> where('user_state',1);
	// 	$this -> db -> where('act_mgr',$this -> EUI_Session ->_get_session('UserId'));
	// 	$this -> db -> where_not_in('UserId',$this -> EUI_Session ->_get_session('UserId'));
		
	// }			
			
				
	// level : supervisor
	
	if( $this -> EUI_Session -> _get_session('HandlingType')== USER_SUPERVISOR)
	{
		$this -> db -> select("*");
		$this -> db -> from("tms_agent");
		$this -> db -> where('user_state',1);
		$this -> db -> where('spv_id',$this -> EUI_Session ->_get_session('UserId'));
		$this -> db -> where_not_in('UserId',$this -> EUI_Session ->_get_session('UserId'));
	}	
		// level : leader
	
	if( $this -> EUI_Session -> _get_session('HandlingType')== USER_LEADER)
	{
		$this -> db -> select("*");
		$this -> db -> from("tms_agent");
		$this -> db -> where('user_state',1);
		$this -> db -> where('tl_id',$this -> EUI_Session ->_get_session('UserId'));
		$this -> db -> where_not_in('UserId',$this -> EUI_Session ->_get_session('UserId'));
	}	
	// level : Telemarketing 
	
	if( $this -> EUI_Session -> _get_session('HandlingType')== USER_AGENT_INBOUND ){
		$this -> db -> select("*");
		$this -> db -> from("tms_agent");
		$this -> db -> where('user_state',1);
		$this -> db -> where_in('UserId',$this -> EUI_Session ->_get_session('UserId'));
	}			
	
	// level : Quality Insurance ( QA ) 
	
	if( $this -> EUI_Session -> _get_session('HandlingType')== USER_QUALITY)
	{
		$this -> db -> select("*");
		$this -> db -> from("tms_agent");
		$this -> db -> where(array("user_state"=> 1) );
		$this -> db -> where_not_in('handling_type', array(USER_ROOT));
	}	
		
	// execute 
	
	$qry = $this -> db -> get();
	// var_dump($this->db->last_query());die;
	if( !is_null($qry))
	{
		foreach( $qry -> result_assoc()  as $rows ) {
			$_conds[$rows['UserId']] = array
			(
				'name' => $rows['full_name'],
				'code' => $rows['id'] 
			);
		}
	}	
	
	return $_conds;
	
 }

/*
 * @ def 		: _getUserOnline() 
 * -----------------------------------------
 *
 * @ return		: array() 
 * @ param		: none;
 */	
 
 
 function _getUserOnline()
 {
	$sql = null; $_conds = array();
	
	// level : root 
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_ROOT)
		$sql = "SELECT * FROM tms_agent a where a.user_state=1 AND logged_state = 1";
	
	// level : admin
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_ADMIN)
		$sql = "SELECT * FROM tms_agent a where a.user_state=1 AND logged_state = 1
				a.handling_type NOT IN('" . USER_ROOT ."') ";
	
	// level : manager 
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_MANAGER)
		$sql = "SELECT * FROM tms_agent a WHERE a.user_state=1  
				AND a.mgr_id ='". $this -> EUI_Session ->_get_session('UserId') ."' 
				AND a.handling_type='".USER_TELESALES."' AND logged_state = 1";
				
	// level : supervisor
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_SUPERVISOR)
		$sql = "SELECT * FROM tms_agent a WHERE a.user_state=1  
				AND a.spv_id ='". $this -> EUI_Session ->_get_session('UserId') ."' 
				AND a.handling_type='".USER_TELESALES."' AND logged_state = 1";
	
	// level : leader 
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_LEADER)
		$sql = "SELECT * FROM tms_agent a WHERE a.user_state=1  
				AND a.tl_id='".$this->EUI_Session->_get_session('UserId') ."' 
				AND a.handling_type='".USER_TELESALES."' AND logged_state = 1";
				
	
	// level : Telemarketing 
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_TELESALES )
		$sql = "SELECT * FROM tms_agent a WHERE a.user_state=1 
				AND a.handling_type='".USER_TELESALES."' AND logged_state = 1";
	
	// level : Quality Insurance ( QA ) 
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_QUALITY)
		$sql = "SELECT * FROM tms_agent a WHERE a.user_state=1 AND logged_state = 1";
		
	// execute 
	
	if( !is_null( $sql) )
	{
		$qry = $this -> db -> query($sql);
		foreach( $qry -> result_assoc() as $rows )
		{
			$_conds[$rows['UserId']] = array
			(
				'name' => $rows['full_name'],
				'code' => $rows['id'] 
			);
		}
	}	
	
	return $_conds;
 }
 
 
/*
 * @ def 		: _getUserOffline() 
 * -----------------------------------------
 *
 * @ return		: array() 
 * @ param		: none;
 */	
 
 function _getUserOffline()
 {
	$sql = null; $_conds = array();
	
	// level : root 
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_ROOT)
		$sql = "SELECT * FROM tms_agent a where a.user_state=1 AND logged_state=0";
	
	// level : admin
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_ADMIN)
		$sql = "SELECT * FROM tms_agent a where a.user_state=1 AND logged_state=0
				a.handling_type NOT IN('" . USER_ROOT ."') ";
		
	
	// level : manager 
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_MANAGER)
		$sql = "SELECT * FROM tms_agent a WHERE a.user_state=1  
				AND a.mgr_id ='". $this -> EUI_Session ->_get_session('UserId') ."' 
				AND a.handling_type='".USER_TELESALES."' AND logged_state=0";
				
	// level : supervisor
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_SUPERVISOR)
		$sql = "SELECT * FROM tms_agent a WHERE a.user_state=1  
				AND a.spv_id ='". $this -> EUI_Session ->_get_session('UserId') ."' 
				AND a.handling_type='".USER_TELESALES."' AND logged_state =0";
	
	// level : Telemarketing 
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_TELESALES )
		$sql = "SELECT * FROM tms_agent a WHERE a.user_state=1 
				AND a.handling_type='".USER_TELESALES."' AND logged_state =0";
	
	// level : Quality Insurance ( QA ) 
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_QUALITY)
		$sql = "SELECT * FROM tms_agent a WHERE a.user_state=1 AND logged_state =0";
		
	// execute 
	
	if( !is_null( $sql) )
	{
		$qry = $this -> db -> query($sql);
		foreach( $qry -> result_assoc() as $rows )
		{
			$_conds[$rows['UserId']] = array
			(
				'name' => $rows['full_name'],
				'code' => $rows['id'] 
			);
		}
	}	
	
	return $_conds;
 }
 
/*
 * @ def 		: _setSendUserOnline() 
 * -----------------------------------------
 *
 * @ return		: array() 
 * @ param		: none;
 */	
 
 function _setSendUserOnline( $data=null )
 {
	$totals = 0;
	if(!is_null($data) && isset($data['Users']) )
	{
		foreach( $data['Users'] as $keys => $UserId )
		{
			$_Insert['[from]'] = $this -> EUI_Session -> _get_session('UserId'); 
			$_Insert['message'] = $data['Message']; 
			$_Insert['sent'] = date('Y-m-d H:i:s');
			$_Insert['[to]'] = $UserId; 
			$_Insert['recd'] = 0;
			$this -> db -> insert( 'tms_agent_msgbox', $_Insert );
			#var_dump( $this->db->last_query()); die();
			if( $this->db->affected_rows()>0)
			{
				$totals++;
			}		
		}			
	}
	
	return $totals;
	
 }
  
/*
 * @ def 		: _setSendUserOffline() 
 * -----------------------------------------
 *
 * @ return		: array() 
 * @ param		: none;
 */	
 
 function _setSendUserOffline( $data=null )
 {
	$totals = 0;
	if(!is_null($data) && isset($data['Users']) )
	{
		foreach( $data['Users'] as $keys => $UserId )
		{
			$_Insert['[from]'] = $this -> EUI_Session -> _get_session('UserId'); 
			$_Insert['message'] = $data['Message']; 
			$_Insert['sent'] = date('Y-m-d H:i:s');
			$_Insert['[to]'] = $UserId; 
			$_Insert['recd'] = 0;
			
			if( $this -> db -> insert( 'tms_agent_msgbox', $_Insert ))
			{
				$totals++;
			}		
		}			
	}
	
	return $totals;
	
 }
 
/*
 * @ def 		: _setSendUserAll() 
 * -----------------------------------------
 *
 * @ return		: array() 
 * @ param		: none;
 */	
 function _setSendUserAll( $data=null )
 {
	$totals = 0;
	if(!is_null($data) && isset($data['Users']) )
	{
		foreach( $data['Users'] as $keys => $UserId )
		{
			$_Insert['[from]'] = $this -> EUI_Session -> _get_session('UserId'); 
			$_Insert['message'] = $data['Message']; 
			$_Insert['sent'] = date('Y-m-d H:i:s');
			$_Insert['[to]'] = $UserId; 
			$_Insert['recd'] = 0;
			
			if( $this -> db -> insert( 'tms_agent_msgbox', $_Insert ))
			{
				$totals++;
			}		
		}			
	}
	
	return $totals;
	
 }
 
 
  
 /*
 * @ def	: function get detail content list page
 * ---------------------------------------------------
 * 
 * @ return : array()
 * @ param	: not assign parameter
 */	
 
 function _setUpdateAll($UserId=null)
 {
	$conds = array('success'=>0);
	
	$this -> db -> set('recd',1);
	$this -> db ->where('to', $UserId);
	if( $this -> db -> update('tms_agent_msgbox')){
		$conds = array('success'=>1);
	}
	
	return $conds;
 }
 
 /*
 * @ def	: function get detail content list page
 * ---------------------------------------------------
 * 
 * @ return : array()
 * @ param	: not assign parameter
 */	
 
function _setUpdateMessage($messageid=null)
{
	$conds = array('success'=>0);
	
	$this -> db -> set('recd',1);
	$this -> db ->where('id',$messageid);
	if( $this -> db -> update('tms_agent_msgbox')){
		$conds = array('success'=>1);
	}
	
	return $conds;
} 
 

 
}
?>