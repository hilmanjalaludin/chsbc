<?php
/*
 * EUI Model  
 *
 
 * Section  : < M_User > get information user on table 
 * author 	: razaki team  
 * link		: http://www.razakitechnology.com/eui/controller 
 */
 
class M_User extends EUI_Model{

// ------------------------------------------------------------
/*
 * @ package 		instance class 
 */
 
 private static $Instance = null;
 public static function &Instance()
{
   if( is_null(self::$Instance) )
  {
	self::$Instance = new self();
  }
  return self::$Instance;
}

// ------------------------------------------------------------
/*
 * @ package 		constructor  
 */
 
 public function __construct()  {
	$this->load->model(array('M_Loger'));
 }
 
/*
 * get login detail every user on tms agent 
 * return < array >
 */

function _getATM()
{
	$datas = array();
	
	$this->db->select('UserId, full_name');
	$this->db->from('tms_agent');
	$this->db->where('handling_type',3);
	
	foreach ($this->db->get()->result_assoc() as $rows) {
		$datas[$rows['UserId']]=$rows['full_name'];
	}

	return $datas;
}
 
 
function _set_update_activity( $event = 'LOGIN', $UserId )
{
	$_conds = false;
	
	if( (!is_null( $UserId)) AND ($UserId!=FALSE) )
	{
		$SQL_insert['UserId'] = $UserId;
		$SQL_insert['ActivityAction']  =  $event;
        $SQL_insert['ActivityDateTs'] = $this -> EUI_Tools -> _date_time();
		$SQL_insert['ActivitySessionId'] = $this -> EUI_Session -> _get_session_id();
		$SQL_insert['ActivityLocation'] =  $this -> EUI_Tools -> _get_real_ip();
		
		if( $this -> db -> insert('tms_agent_activity', $SQL_insert) ){
			$_conds = true;
		}
		else
			$_conds = false;
	}
	
	return $_conds;
}

/*
 * get login detail every user on tms agent 
 * return < array >
 */

 function _get_last_login()
 {
	$_conds = null;
	
	$UserId = $this -> EUI_Session -> _get_session('UserId');
	
	/*$sql = " SELECT a.ActivityDateTs 
				FROM tms_agent_activity a  
				WHERE a.UserId='$UserId' AND a.ActivityAction='LOGIN' 
				ORDER BY a.ActivityId DESC LIMIT 1 ";*/

	$this->db->where('UserId', $UserId);
	$this->db->order_by('ActivityId', 'desc');
	$this->db->limit(1);
	$qry = $this->db->get('tms_agent_activity');

	#if( !$qry -> EOF() )
	if( $qry->num_rows() > 0 )
	{
		#$rows = $qry -> result_first_assoc();
		$rows = $qry->row_array();

		if( ($rows['ActivityDateTs']!='') )
		{
			$_conds = $rows['ActivityDateTs'];
		}
	}
	
	return $_conds;
		
 }
 
/*
 * get login detail every user on tms agent 
 * return < array >
 */
 
function getLoginUser( $_User )
{
	$_conds  = false;
	if( is_array( $_User ) ) 
	{
		$sql = "SELECT a.*, b.menu_group, b.menu, b.name as GroupName  FROM tms_agent a LEFT JOIN tms_agent_profile b on a.handling_type=b.id 
				WHERE a.id ='".$_User['username']."' 
				AND a.password='".md5($_User['password'])."' AND a.user_state='1'";
				
		$qry = $this->db->query($sql);
		
		if( $qry->num_rows() > 0 )
		{
			// $_conds = $qry -> result_first_assoc();
			$_conds = $qry->row_array();
		}	
	}
	// var_dump($_conds);
	
	return $_conds;
 }

//---------------------------------------------------------------------------------------
/*
 * @ package 		_set_row_update_user_logout
 */
protected function _set_row_update_user_logout($Login=0)
{
 
 $this->db->reset_write();			
 $this->db->set('ip_address','NULL',FALSE);	
 $this->db->set('last_update',$this->EUI_Tools->_date_time());
 $this->db->set('logged_state',$Login);
 $this->db->where('UserId',_get_session('UserId'));
 $this->db->update('tms_agent');
 #var_dump( $this->db->last_query());die();

 if( $this->db->affected_rows() > 0 )
 {
 	EventLoger("OUT", array("sesion logout from device"));
	return true;
 }
 return FALSE;

}
 
//---------------------------------------------------------------------------------------
/*
 * @ package 		_set_row_update_user_login
 */
 protected function _set_row_update_user_login()
{
 $this->db->reset_write(); 
 $this->db->where('UserId',_get_session('UserId'));
 $this->db->set('ip_address', $this->EUI_Tools->_get_real_ip() );
 $this->db->set('last_update',$this->EUI_Tools->_date_time() );
 $this->db->set('logged_state',1);
 
  $this->db->update('tms_agent');
  if( $this->db->affected_rows() > 0 )
  {
	EventLoger("INC", array( "sesion Login from device")); 
	return TRUE;
 } 
  return FALSE;	
}
 
//---------------------------------------------------------------------------------------
/*
 * @ package 		get all user data 
 */
 
  public function _setUpdateLastLogin( $Login=1 )
 {
	$cond= 0;
	if( $Login ==1 ) 
	{
		$this->db->reset_write();	
		$this->db->set('login_count','COALESCE((login_count+1), 1)', FALSE );
		$this->db->where('UserId', $this->EUI_Session->_get_session('UserId'));
		$this->db->update('tms_agent');
	}
	
   	//--- check sesion vailable user  ----------------------
	if( _have_get_session('UserId') AND _get_session('UserId')) 
	{
		if( $Login ){
			$cond = $this->_set_row_update_user_login();	
		} else {
			//$cond = $this->_set_row_update_user_logout($Login);	
			$outtest =  _get_session('UserId');
			$sess=_get_session('UserId');
			   $cond = "UPDATE tms_agent
			   SET ip_address = NULL, logged_state= '0'
			   WHERE UserId = $outtest";
			   $this->db->query("update t_gn_customer set Flag_Followup=0  where SellerId=$sess");
		}
		$this->db->query($cond);
	}					
		
	return $cond;
 }
 
 
// _setUpdatePassword :: change of the parameter on here test again 
 
 public function _setUpdatePassword( $param=null )
 {
	$_conds = 0;
	$out = new EUI_Object( $param );
	if( $out->fetch_ready() )
	{
		$this->db->reset_write();	
		$this->db->where('UserId', _get_session('UserId') );
		$this->db->where('password', (string)$out->get_value('curr_password', 'md5'));
		$this->db->set('password',(string)$out->get_value('new_password', 'md5'));
		$this->db->update('tms_agent'); 
		if( $this->db->affected_rows() >0 ) 
		{
			EventLoger('UPD', array(
				"Change password", 
				"from", $out->get_value('curr_password', 'md5'),
				"to", $out->get_value('new_password', 'md5')
			));
			$_conds++;
		}
	}
	
	return $_conds;
 }
 

//---------------------------------------------------------------------------------------
/*
 * @ package 		get all user data 
 */
 
 public function  _set_user_change_password( $out  = null )
{
 if( !$out->fetch_ready() ){
	return FALSE;
 }	

//------ compare string is match ---------------------	
 if( strcmp( $out->get_value('new_password', 'md5'),  
	$out->get_value('renew_password', 'md5') ) == 0 )
 {
	$this->db->reset_write();
	$this->db->where("id", (string)$out->get_value('userid', 'trim'));
	$this->db->set("password", (string)$out->get_value('renew_password', 'md5'));
	$this->db->set("update_password", date('Y-m-d H:i:s'));
	$this->db->update("tms_agent");
	if( $this->db->affected_rows() > 0 )
	{
	  // set to loger 
		EventLoger('UPD', array(
			"Change password", 
			"from", $out->get_value('password'),
			"to", $out->get_value('renew_password', 'md5')
		));
			
		return TRUE;	
	}	
 } 
   return FALSE;
   
 }

 
 
 
}

// END OF FILE
// location : ./application/controller/Auth.php

?>