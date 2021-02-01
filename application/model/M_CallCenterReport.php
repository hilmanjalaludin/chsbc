<?php

class M_CallCenterReport extends EUI_Model
{
  function M_CallCenterReport() {
  
  }
  
 // getBySummary
 
 function _getSummary( $param = null )
 {
	$results = array();
	
	$this -> db ->select( " count(a.id) as tots, 
			b.name as Username, b.userid, b.id as AgentId,
			SUM(IF(a.`status` in(3005,3004),1,0)) as tot_connected,
			SUM(IF(a.`status` NOT IN(3005,3004),1,0)) as tot_abandone,
			SUM(IF(a.`status` IN(3005,3004),UNIX_TIMESTAMP(a.end_time)-UNIX_TIMESTAMP(a.start_time),0)) as tot_talk", 
	FALSE);
	
	$this -> db ->from("cc_call_session a");
	$this -> db ->join("cc_agent b "," a.agent_id=b.id ","LEFT");
	$this -> db ->where("b.userid IS NOT NULL","",FALSE);
	
	// CallDirection
	
	if( is_array($param) 
		AND isset($param['CallDirection']) AND !empty($param['CallDirection'])) {
		$this->db->where("a.direction",$param['CallDirection'], FALSE);
	}
	
	// is param 
	
	if( is_array($param) 
		AND isset($param['GroupCallCenter']) 
		AND !empty($param['GroupCallCenter']) ) {
		$this->db->where("a.agent_group",$param['GroupCallCenter'], TRUE);
	}
	
	// filter next agent_id 
	
	if( is_array($param) 
		AND isset($param['AgentId']) AND !empty($param['AgentId']) ) {
		$this->db->where_in('a.agent_id',$param['AgentId']);
	}
	
	// filter next start date 
	
	if( is_array($param) 
		AND isset($param['start_date']) AND isset($param['end_date']) ) {
		$this->db->where("a.start_time >=", _getDateEnglish($param['start_date']) . ' 00:00:00');
		$this->db->where("a.start_time <=", _getDateEnglish($param['end_date']) . ' 23:59:59');
	}
	
	$this -> db ->group_by("Username");
	
	// echo $this->db->_get_var_dump();
	
	foreach( $this -> db ->get()->result_assoc() as $rows ) {
		$results[$rows['AgentId']]['tots'] = $rows['tots'];
		$results[$rows['AgentId']]['tot_connected'] = $rows['tot_connected'];
		$results[$rows['AgentId']]['tot_abandone'] = $rows['tot_abandone'];
		$results[$rows['AgentId']]['tot_talk'] = $rows['tot_talk'];
	}

	return $results;
 } 
 
 
  
  
// getByDaily

function _getDaily($param=null)
{
	$results = array();
	$this ->db->select("count(a.id) as tots_call, date(a.start_time) as tgl, 
			 a.agent_id as agent_id,
			 SUM(IF(a.`status` in(3005,3004),1,0)) as tot_connected,
			 SUM(IF(a.`status` NOT IN(3005,3004),1,0)) as tot_abandone,
			 SUM(IF(a.`status` IN(3005,3004),unix_timestamp(a.end_time)-unix_timestamp(a.start_time),0)) as tot_talk",FALSE);
			 
	$this -> db->from("cc_call_session a");
	$this -> db->join("cc_agent b ","a.agent_id=b.id", FALSE);
	$this -> db->where("b.userid IS NOT NULL",'',FALSE);
	
	// CallDirection
	
	if( is_array($param) 
		AND isset($param['CallDirection']) AND !empty($param['CallDirection']) ) {
		$this->db->where("a.direction",$param['CallDirection'], FALSE);
	}
	
	
	// is param 
	
	if( is_array($param) 
		AND isset($param['GroupCallCenter']) 
		AND !empty($param['GroupCallCenter'])) 
	{
		$this->db->where("a.agent_group",$param['GroupCallCenter'], FALSE);
	}
	
	// filter next agent_id 
	
	if( is_array($param) 
		AND isset($param['AgentId']) AND !empty($param['AgentId'])) {
		$this->db->where_in('a.agent_id',$param['AgentId']);
	}
	
	// filter next start date 
	
	if( is_array($param) 
		AND isset($param['start_date']) AND isset($param['end_date']) ) {
		$this->db->where("a.start_time >=", _getDateEnglish($param['start_date']) . ' 00:00:00');
		$this->db->where("a.start_time <=", _getDateEnglish($param['end_date']) . ' 23:59:59');
	}
	
	$this -> db ->group_by("agent_id, tgl");
	foreach( $this -> db ->get()->result_assoc() as $rows )
	{
		$results[$rows['agent_id']][$rows['tgl']]['tots_call'] += $rows['tots_call'];
		$results[$rows['agent_id']][$rows['tgl']]['tots_connected'] += $rows['tot_connected'];
		$results[$rows['agent_id']][$rows['tgl']]['tots_abandone'] += $rows['tot_abandone'];
		$results[$rows['agent_id']][$rows['tgl']]['tots_talk'] += $rows['tot_talk'];
	}
	
	return $results;
 } 
 
 
 // getBySummary

function _getHourly()
{
	$results = array();
	$sql = " select count(a.id) as tots, 
			b.name as Username, b.userid,
			SUM(IF(a.`status` in(3005,3004),1,0)) as tot_connected,
			SUM(IF(a.`status` NOT IN(3005,3004),1,0)) as tot_abandone,
			SUM(IF(a.`status` IN(3005,3004),unix_timestamp(a.end_time)-unix_timestamp(a.start_time),0)) as tot_talk
			from cc_call_session a left join cc_agent b on a.agent_id=b.id
			where b.userid is not null
			group by Username ";
			
	$qry = $this -> db -> query($sql);
	
	if( !$qry -> EOF() ){
		$results = $qry -> result_assoc();
	}
	return $results;
 } 
  
  
 
  
}

?>