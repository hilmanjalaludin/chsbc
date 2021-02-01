<?php
class M_ModCtiLogin extends EUI_Model
{

private static $Instance = null;

// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */
 
public static function &Instance()  
{
  if( is_null( self::$Instance ) ){
	self::$Instance = new self();
  }
  return self::$Instance;	
}
	
	
// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */
function __construct() { }


/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
function _getUserAvail( $UserName=NULL )
{
	$_conds = false;
	$_cti_datas = self::_setUserLogin($UserName);
	if( count( $_cti_datas)> 0 AND !is_null( $_cti_datas ) ) 
	{
		$_conds  = $_cti_datas;
	}
	
	return $_conds;
}

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

function _setUserLogin( $UserName = NULL ) 
{
	$_conds = null;
	$sql = " select * from cc_agent a where a.userid ='$UserName'";
	$qry = $this -> db->query($sql);
	
	foreach( $qry->result_assoc() as $rows )
	{
		foreach( $rows as $keys => $values )
		{
			$_conds[$keys] = $values;
		}
	}
	
	return $_conds;
}

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

function _getAgentIP(){
	$ip = $_SERVER['REMOTE_ADDR'];
  	if(array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)){
		$ip = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
	}
	return $ip;
}

function _setCtiPBX($UserName)
{
	$UserAvail = self ::_getUserAvail($UserName);
	
	$agentId = (_have_get_session('agentId') ? _get_session('agentId') : $UserAvail['id'] );
	$agentExt = (_have_get_session('agentExt') ? _get_session('agentExt') : 0 );
	/*
	 $agentIpAddress  = $_SERVER['REMOTE_ADDR'];
	 self::_getAgentIP(); :: function_exists on EUI_Tool_helper
	 */
	$agentIpAddress =_getIP(); 
	$pbxid	= 0;
	
	if( ($UserAvail!=TRUE ) AND !is_array($UserAvail) ) { die("Invalid agent id"); }
	else
	{
		if($agentExt)
		{
			$dynamicIp = true;
			$this ->EUI_Session->_set_session('agentExt',$agentExt); 
			
			// select again 
			
			$sql = " select a.pbx from cc_extension_agent a where a.ext_number = '$agentExt'";
			$qry = $this -> db -> query($sql);
			foreach( $qry ->result_assoc() as $rows ) {
				$pbxid = $rows['pbx'];
			}	
		}
		else
		{
			$sql = " select a.ext_number, a.pbx from cc_extension_agent a where a.ext_location = '$agentIpAddress'";
			$qry  = $this -> db -> query($sql);
			if( $rows = $qry -> result_first_assoc() ) 
			{
				$this ->EUI_Session->_set_session('agentExt',$rows['ext_number']);
				$pbxid= $rows['pbx'];
						
			}
			else{
				print "
					<script> 
						$(document).ready(function(){
							Ext.Cmp(\"AgentStatus\").setText(\"Ip-Address not registered [$agentIpAddress]\");
						});
				</script>";
				
				//die("Ip-Address not registered [$agentIpAddress]");
			}
		}
		
		// get instance id
		$instanceId = $this -> _get_instance_id($pbxid);
		$appssetting = $this -> _get_app_setting($instanceId);
		
		// setting _get_pbx_setting
		self::_get_pbx_setting($pbxid);
		
		// _get_manager_setting
		$manager = $this -> _get_manager_setting($instanceId);
		if($manager)
		{
			$conds1 = " now() as 'login_time' ";
			if( QUERY == 'mssql') {
				$conds1 = " CONVERT(VARCHAR, GETDATE(),20) AS 'login_time' ";
			}

			$sql = " SELECT a.id, a.userid , a.name, a.occupancy, {$conds1}, a.agent_group  
					 FROM cc_agent a, cc_agent_group b  
					 WHERE a.id = '$agentId' and a.agent_group = b.id";
			$qry = $this -> db -> query($sql);
			$rows = $qry -> result_first_assoc();
			if( count($rows) > 0 )
			{
				$this ->EUI_Session ->_set_session('agentId',$rows['id']);
				$this ->EUI_Session ->_set_session('agentLogin',$rows['userid']);
				$this ->EUI_Session ->_set_session('agentName',$rows['name']);
				$this ->EUI_Session ->_set_session('agentLevel',$rows['occupancy']);
				$this ->EUI_Session ->_set_session('agentLoginTime',$rows['login_time']);
				$this ->EUI_Session ->_set_session('agentGroup',$rows['agent_group']);
			 } else {
				print "
					<script> 
						$(document).ready(function(){
							Ext.Cmp(\"AgentStatus\").setText(\"Agent not found\");
						});
				</script>"; 
			 }
		}
	}
}

/*
 * @ def 		: GET Instance ID  
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
function _get_instance_id($pbxId)
{	
	$instanceId = 0;

	$sql = "SELECT instance_id FROM cc_settings  WHERE set_modul='cti' AND set_name='pbx.id' AND set_value='$pbxId'";
	$qry = $this -> db -> query($sql);
	// if(!$qry -> EOF() ) {
	if( $qry->num_rows() > 0 ) {
		$instanceId = $qry -> result_singgle_value();
		
	}
	
	return $instanceId;
}

/*
 * @ def 		: GET Instance ID  
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
function _get_app_setting($instanceId='')
{	
 /* read app settings */
 
	$sql = "SELECT set_name, set_value FROM cc_settings WHERE set_modul = 'agent' AND instance_id='$instanceId' ";
	$qry = $this -> db -> query($sql);
	foreach( $qry ->result_assoc() as $rows )
	{
		if( $rows['set_name']=='server.host') {
			$this->EUI_Session -> _set_session('ctiIp',$rows['set_value']);
		}	
		else if( $rows['set_name']=='server.port') {
			$this->EUI_Session -> _set_session('ctiUdpPort',$rows['set_value']);
		}
	}
}


/*
 * @ def 		: GET Instance ID  
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
function _get_pbx_setting( $pbxId )
{			
	$sql = "SELECT set_name, set_value FROM cc_pbx_settings WHERE pbx = '$pbxId'";
	$qry = $this -> db -> query($sql);
	foreach( $qry ->result_assoc() as $rows )
	{
		if($rows['set_name'] == 'tac') {
			$this->EUI_Session -> _set_session('pbxTAC',$rows['set_value']);
		}
	}
}

/*
 * @ def 		: GET Instance ID  
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_manager_setting($instanceId='')
{
	/* manager settings */

	$_array = array();
	$sql = "SELECT set_name, set_value FROM cc_settings WHERE set_modul = 'manager' AND instance_id='$instanceId' ";
	$qry = $this -> db -> query($sql);
	
	foreach( $qry ->result_assoc() as $rows )
	{
		if($rows['set_name'] == "server.host")
		{
			$_array['managerHost'] = $rows['set_value'];
		}
		else if ($rows['set_name'] == "server.port"){
			$_array['managerPort'] = $rows['set_value'];
		}
			  
	}
	
	return $_array;
}

	

}

?>
