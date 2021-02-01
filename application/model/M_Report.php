<?php
class M_Report extends EUI_Model
{

private static $instance = null;	

/// aksesor 

function M_Report()
{
  $this -> load ->model(array('M_Combo','M_SysUser'));
}

/*
 * @ def : get_instance 
 * -------------------------------------
 * @ params : public 
 * @ akess  : private  
 */
 
public static function & get_instance() 
{
  if( is_null(self::$instance)) {
	self::$instance = new self();
  }
	
	return self::$instance;
 }
 
 
public function Mode(){
	return array(
		//'hourly' => 'Hourly',
		//'daily' => 'Daily',
		'summary' => 'Summary'
	);
	
} 

public function Filter(){
	return array(
		//'hourly' => 'Hourly',
		//'daily' => 'Daily',
		'tsr' => 'TSR',
		'cmp' => 'Campaign'
	);
	
} 
 
 
public function _getReportType( $CodeName='' )
{

   $Type = array();
  
	$this ->db ->select('*',FALSE);
	$this ->db ->from('t_lk_shoping_report',FALSE);
	$this ->db ->where('ReportFlags',1,FALSE);
	$this ->db ->where('CodeName',$CodeName);
	
	
	foreach( $this->db->get() ->result_assoc() as $rows )
	{
		$Type[$rows['ReportView']] = $rows['ReportName'];
	}	
	return $Type;	
}


 // _getCallType
 
public function _getCallType( $ReportView='' )
{
   $Type = array();
	
	$this ->db ->select('*',FALSE);
	$this ->db ->from('t_lk_shoping_report',FALSE);
	$this ->db ->where('ReportFlags',1,FALSE);
	$this ->db ->where('ReportView',$ReportView);
	
	return $this ->db ->get()->result_first_assoc();
}


// _getSerialize 

 function _getSerialize()
 {
	$_serialize = array();
	$_combo = $this ->M_Combo->_getSerialize();
	foreach( $_combo as $keys => $method )
	{
		if((STRTOLOWER($keys)!='serialize') AND (STRTOLOWER($keys)!='instance') 
			AND (STRTOLOWER($keys)!='nstruct') AND (STRTOLOWER($keys)!='t'))
		{
			$_serialize[$keys] = $this ->M_Combo->$method(); 	
		}
	}
	
	return $_serialize;
 }

 
 // _getSerialize 

 function _getSupervisor()
 {
	return $this -> M_SysUser -> _get_supervisor();
 }

 
 // function get cc and tms 
 
 
 function _getAgentName( $UserId=0 )
 {
	$this ->db ->select("a.userid, a.name");
	$this ->db ->from("cc_agent a ");
	$this ->db ->where("a.id", $UserId);
	
	return $this ->db ->get()->result_first_assoc();
	
 }
 
 // agent by login 
 
 function _getUserAgent()
 {
	$User = array();
	foreach( $this -> M_SysUser ->_get_user_by_login() as $UserId => $rows )
	{
		$User[$UserId] = $rows['full_name']; 
	}
	
	return $User;
 }
 
 // get cc_agent group 
 
 function getAgentGroup()
 {
	$Group = array();
	$this -> db->select("a.id, a.description");
	$this -> db->from("cc_agent_group a ");
	$this -> db->where("a.status_active",1); 
	
	foreach( $this -> db->get()->result_assoc() as $rows ) {
		$Group[$rows['id']] = $rows['description'];
	}
	
	return $Group;
	
 
  }  
  
  
   // get cc_agent group 
 
 function getAgent( $GroupId = null )
 {
	$Group = array();
	
	$this -> db -> select("a.id, a.name");
	$this -> db -> from("cc_agent a ");
	$this -> db -> join("cc_agent_group b", " a.agent_group = b.id", "LEFT");
	$this -> db -> join("tms_agent c", " c.id = a.userid", "LEFT");
	$this -> db -> where('c.handling_type', 4);
	// if((!is_null($GroupId)) AND ($GroupId!=FALSE)) {
		// $this -> db -> where('a.agent_group', $GroupId);
	// }
	
	if(($this -> EUI_Session->_get_session('HandlingType')!=USER_ROOT) ){
		$this -> db -> where_not_in('c.handling_type',array(USER_ROOT));
	}
	
	foreach( $this -> db->get()->result_assoc() as $rows ) {
		$Group[$rows['id']] = $rows['name'];
	}
	
	return $Group;	
  } 
  
  
  // get Campaign Group
  
  function getCmp( $GroupId = null )
 {
	$Group = array();
	
	$this -> db -> select("a.CampaignName");
	$this -> db -> from("t_gn_campaign a ");
	// $this -> db -> join("cc_agent_group b", " a.agent_group = b.id", "LEFT");
	// $this -> db -> join("tms_agent c", " c.id = a.userid", "LEFT");
	// $this -> db -> where('a.CampaignStatusFlag', 1);
	// if((!is_null($GroupId)) AND ($GroupId!=FALSE)) {
		// $this -> db -> where('a.agent_group', $GroupId);
	// }
	
	if(($this -> EUI_Session->_get_session('HandlingType')!=USER_ROOT) )
	{
		$this -> db -> where_not_in('c.handling_type',array(USER_ROOT));
	}
	
	foreach( $this -> db->get()->result_assoc() as $rows ) {
		$Group[$rows['CampaignId']] = $rows['CampaignName'];
	}
	
	return $Group;	
  } 
  
  // end function
 
 
 
 // function Reason Type
 
 function _ReasonType()
 {
	$sql = " select a.reasonid, a.reason_code from cc_reasons a ";
	$qry = $this -> db -> query($sql);
	return $qry -> result_assoc();
	
 }
 
}
?>