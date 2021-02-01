<?php 

class M_GroupCallCenterReport extends EUI_Model
{
	 
  
 function M_GroupCallCenterReport(){
	/* run query */
	
 } 
 
 /** getBySummary **/
 
 function _getSummary( $param = null )
 {
	$results = array();
	
	$this -> db ->select( " SUM(IF(a.`status` IN(0002,1002,1004,2002,3003,3004,3005), 1, 0)) as tots,
			SUM(IF(a.`status` in(3005,3004),1,0)) as tot_connected,
			SUM(IF(a.`status` IN(0002,1002,1004,2002,3003),1,0)) as tot_abandone,
			SUM(IF(a.`status` IN(3005,3004),unix_timestamp(a.end_time)-unix_timestamp(a.start_time),0)) as tot_talk", 
	FALSE);
	
	$this -> db ->from("cc_call_session a");
	$this -> db ->join("cc_agent b "," a.agent_id=b.id ","LEFT");
	// CallDirection
	
	if( is_array($param) 
		AND isset($param['CallDirection']) AND !empty($param['CallDirection'])) {
		$this->db->where("a.direction",$param['CallDirection'], FALSE);
	}
	
	// is param 
	
	if( is_array($param) 
		AND isset($param['GroupCallCenter']) AND !empty($param['GroupCallCenter']) ) {
		$this->db->where("a.agent_group",$param['GroupCallCenter'], FALSE);
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
	
	$i = 0;
	foreach( $this -> db ->get()->result_assoc() as $rows ) {
		$results[$i]['tots'] = $rows['tots'];
		$results[$i]['tot_connected'] = $rows['tot_connected'];
		$results[$i]['tot_abandone'] = $rows['tot_abandone'];
		$results[$i]['tot_talk'] = $rows['tot_talk'];
		$i++;
	}

	return $results;
 } 
 
 
  
  
// getByDaily

function _getDaily($param=null)
{
	$results = array();
	$this ->db->select("SUM(IF(a.`status` IN(0002,1002,1004,2002,3003,3004,3005), 1, 0)) as tots_call, date(a.start_time) as tgl,
			 SUM(IF(a.`status` in(3005,3004),1,0)) as tot_connected,
			 SUM(IF(a.status IN(0002, 1002, 1004, 2002, 3003), 1, 0)) AS tot_abandone,
			 SUM(IF(a.`status` IN(3005,3004),unix_timestamp(a.end_time)-unix_timestamp(a.start_time),0)) as tot_talk",FALSE);
			 
	$this -> db->from("cc_call_session a");
	$this -> db->join("cc_agent b ","a.agent_id=b.id", FALSE);
	//$this -> db->where("b.userid IS NOT NULL",'',FALSE);
	//$this-> db ->where("a.d_number IN (200)");
	// CallDirection
	
	if( is_array($param) 
		AND isset($param['CallDirection']) AND !empty($param['CallDirection']) ) {
		$this->db->where("a.direction",$param['CallDirection'], FALSE);
	}
	
	
	// is param 
	
	if( is_array($param) 
		AND isset($param['GroupCallCenter']) AND !empty($param['GroupCallCenter'])) {
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
	
	$this -> db ->group_by("tgl");
	//echo $this -> db ->_get_var_dump();
	
	// if($this -> db ->get()->num_rows() > 0)
	// {
		foreach( $this -> db ->get()->result_assoc() as $rows ) {
			$results[$rows['tgl']]['tots_call'] += $rows['tots_call'];
			$results[$rows['tgl']]['tots_connected'] += $rows['tot_connected'];
			$results[$rows['tgl']]['tots_abandone'] += $rows['tot_abandone'];
			$results[$rows['tgl']]['tots_talk'] += $rows['tot_talk'];
		}
	//}
	
	return $results;
 } 
 
 
 // getBySummary

function _getHourly($param)
{
	$results = array();
	
	$this ->db ->select("SUM(IF(a.`status` IN(0002,1002,1004,2002,3003,3004,3005), 1, 0)) as tots, date(a.start_time) as tgl, date_format(a.start_time,'%H') as hours,
			SUM(IF(a.`status` in(3005,3004),1,0)) as tot_connected,
			SUM(IF(a.`status` IN(0002,1002,1004,2002,3003),1,0)) as tot_abandone,
			SUM(IF(a.`status` IN(3005,3004),unix_timestamp(a.end_time)-unix_timestamp(a.start_time),0)) as tot_talk ",FALSE);
			
	$this ->db -> from("cc_call_session a");
	$this ->db -> join("cc_agent b "," a.agent_id=b.id","LEFT");
	$this ->db -> where("b.userid is not null");
	$this-> db ->where("a.d_number IN (200)");
	// CallDirection
	
	if( is_array($param) 
		AND isset($param['CallDirection']) AND !empty($param['CallDirection']) ) {
		$this->db->where("a.direction",$param['CallDirection'], FALSE);
	}
	
	
	// is param 
	
	if( is_array($param) 
		AND isset($param['GroupCallCenter']) AND !empty($param['GroupCallCenter'])) {
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
	
	$this ->db -> group_by("tgl, hours");
	
	foreach($this -> db ->get() -> result_assoc() as $rows )
	{
		$results[$rows['tgl']][$rows['hours']]['tots_call']= $rows['tots'];
		$results[$rows['tgl']][$rows['hours']]['tots_connected']= $rows['tot_connected'];
		$results[$rows['tgl']][$rows['hours']]['tots_abandone']= $rows['tot_abandone'];
		$results[$rows['tgl']][$rows['hours']]['tots_talk']= $rows['tot_talk'];
	}
	
	return $results;
 } 
  
  
 
}

?>