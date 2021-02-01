<?php

class M_AgentActivityReport extends EUI_Model {

// view body data 

private static $view_body = null;


// instance 
	
private static $instance = null;

// param

private static $param = null;

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function index( $param = null) 
{
	if( !is_null($param) ) 
	{
		self::$param = $param;
		if( !is_null(self::$param) )
		{	
			switch(self::$param['group_by']) 
			{
				case 'group_spv' 	: $this -> ActivityGroupBySpv(); break;
				case 'group_agent'  : $this -> ActivityGroupByAgent(); break;
			}
		}	
	}
}


/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function ActivityGroupBySpv()
{
	if( !is_null(self::$param) )
	{
		switch(trim(self::$param['mode']))
		{
			// case 'hourly' 	: self::hourlyEfficiencyGroupBySpv(); 	break;
			// case 'daily'  	: self::dailyEfficiencyGroupBySpv(); 		break;
			case 'summary'  : $this -> summaryActivityGroupBySpv(); 	break;	
		}
	}
}



/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function ActivityGroupByAgent()
{
	if( !is_null(self::$param) )
	{
		switch(trim(self::$param['mode']))
		{
			// case 'hourly' 	: self::hourlyActivityGroupBySpv(); 	break;
			// case 'daily'  	: self::dailyActivityGroupBySpv(); 		break;
			case 'summary'  : self::summaryActivityGroupByAgent(); 	break;	
		}
	}
} 

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function summaryActivityGroupByAgent()
{
 
 /* get login history **/
	
	$this->db->select("
		c.UserId, sum(if( a.`status` in(1), (unix_timestamp(a.end_time)-unix_timestamp(a.start_time)),0)) as ready,
		sum(if( a.`status` in(2), (unix_timestamp(a.end_time)-unix_timestamp(a.start_time)),0)) as notready,
		sum(if( a.`status` in(3), (unix_timestamp(a.end_time)-unix_timestamp(a.start_time)),0)) as acw,
		sum(if( a.`status` in(4), (unix_timestamp(a.end_time)-unix_timestamp(a.start_time)),0)) as busy",
	FALSE);
		
	$this->db->from('cc_agent_activity_log a'); 
	$this->db->join('cc_agent b','a.agent=b.id','LEFT');
	$this->db->join('tms_agent c','b.userid=c.id','LEFT');
	$this->db->where("a.start_time >=",self::$param['start_date'] . ' 00:00:00');
	$this->db->where("a.start_time <=",self::$param['end_date'] . ' 23:59:59');
	$this->db->where_in('c.UserId',self::$param['agent_id']);
	$this->db->group_by('c.UserId');

	foreach( $this ->db ->get()->result_assoc() as $rows )
	{
		self::$view_body[$rows['UserId']]['Ready']= $rows['ready'];
		self::$view_body[$rows['UserId']]['NotReady']= $rows['notready'];
		self::$view_body[$rows['UserId']]['ACW']= $rows['acw'];
		self::$view_body[$rows['UserId']]['Busy']= $rows['busy'];
	}
	
  /* sum talk call session **/
  
	$this->db->select(" 
		c.UserId, SUM(IF( a.status IN(3004,3005), (unix_timestamp(a.end_time)-unix_timestamp(a.agent_time)),0)) as sum_talk", 
		FALSE);
	
	$this->db->from("cc_call_session a");
	$this->db->join("cc_agent b", "a.agent_id=b.id",'LEFT');
	$this->db->join("tms_agent c", "b.userid=c.id",'LEFT');
	$this->db->where('a.agent_time IS NOT NULL','',FALSE);
	$this->db->where("date(a.agent_time)!=", "0000-00-00",FALSE);
	$this->db->where('a.start_time >=',self::$param['start_date'] . ' 00:00:00');
	$this->db->where('a.start_time <=',self::$param['end_date'] . ' 23:59:59');
	$this->db->where_in('c.UserId',self::$param['agent_id']);
	$this->db->group_by('c.UserId');
	
	foreach( $this ->db ->get()->result_assoc() as $rows )
	{
		self::$view_body[$rows['UserId']]['TalkTime']= $rows['sum_talk'];
	}
}


/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function summaryActivityGroupBySpv()
{

	/* get login history **/
	
	$this->db->select("
		c.spv_id, sum(if( a.`status` in(1), (unix_timestamp(a.end_time)-unix_timestamp(a.start_time)),0)) as ready,
		sum(if( a.`status` in(2), (unix_timestamp(a.end_time)-unix_timestamp(a.start_time)),0)) as notready,
		sum(if( a.`status` in(3), (unix_timestamp(a.end_time)-unix_timestamp(a.start_time)),0)) as acw,
		sum(if( a.`status` in(4), (unix_timestamp(a.end_time)-unix_timestamp(a.start_time)),0)) as busy",
	FALSE);
		
	$this->db->from('cc_agent_activity_log a'); 
	$this->db->join('cc_agent b','a.agent=b.id','LEFT');
	$this->db->join('tms_agent c','b.userid=c.id','LEFT');
	$this->db->where("a.start_time >=",self::$param['start_date'] . ' 00:00:00');
	$this->db->where("a.start_time <=",self::$param['end_date'] . ' 23:59:59');
	$this->db->where_in("c.spv_id",self::$param['spv_id']);
	$this->db->group_by("c.spv_id");

	foreach( $this ->db ->get()->result_assoc() as $rows )
	{
		self::$view_body[$rows['spv_id']]['Ready']= $rows['ready'];
		self::$view_body[$rows['spv_id']]['NotReady']= $rows['notready'];
		self::$view_body[$rows['spv_id']]['ACW']= $rows['acw'];
		self::$view_body[$rows['spv_id']]['Busy']= $rows['busy'];
	}
	
  /* sum talk call session **/
  
	$this->db->select(" 
		c.spv_id, SUM(IF( a.status IN(3004,3005), (unix_timestamp(a.end_time)-unix_timestamp(a.agent_time)),0)) as sum_talk", 
		FALSE);
	
	$this->db->from("cc_call_session a");
	$this->db->join("cc_agent b", "a.agent_id=b.id",'LEFT');
	$this->db->join("tms_agent c", "b.userid=c.id",'LEFT');
	$this->db->where('a.agent_time IS NOT NULL','',FALSE);
	$this->db->where("date(a.agent_time)!=", "0000-00-00",FALSE);
	$this->db->where('a.start_time >=',self::$param['start_date'] . ' 00:00:00');
	$this->db->where('a.start_time <=',self::$param['end_date'] . ' 23:59:59');
	$this->db->where_in("c.spv_id",self::$param['spv_id']);
	$this->db->group_by("c.spv_id");
	
	foreach( $this ->db ->get()->result_assoc() as $rows )
	{
		self::$view_body[$rows['spv_id']]['TalkTime']= $rows['sum_talk'];
	}
}


/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 

public function _getBodyView()
{
	if( !is_null(self::$view_body) )
	{
		return self::$view_body;
	}
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function _getParam()
{
	if( !is_null(self::$param) )
	{
		return self::$param;
	}
}
 
 
 
// _get Reason Type 

function _getSummaryReasonType( $param = null )
{
	$this ->db ->select(" b.id AS AgentId,  d.reasonid as ReasonId, SUM(IF(a.status IN(2), (UNIX_TIMESTAMP(a.end_time)- UNIX_TIMESTAMP(a.start_time)), 0)) AS Times",  FALSE);
	$this ->db ->from("cc_agent_activity_log a");
	$this ->db ->join("cc_agent b"," a.agent=b.id ", "LEFT");
	$this ->db ->join("tms_agent c "," b.userid=c.id","LEFT");
	$this ->db ->join("cc_reasons d "," a.reason=d.reasonid","LEFT");
	
	$this->db->where("d.reasonid IS NOT NULL ",'', FALSE);
	
	// is param 
	
	if( is_array($param) 
		AND isset($param['GroupCallCenter']) ) {
		$this->db->where("b.agent_group",$param['GroupCallCenter'], FALSE);
	}
	
	// filter next agent_id 
	
	if( is_array($param) 
		AND isset($param['AgentId']) AND !empty($param['AgentId']) ) {
		$this->db->where_in('b.id',$param['AgentId']);
	}
	
	// filter next start date 
	
	if( is_array($param) 
		AND isset($param['start_date']) AND isset($param['end_date']) ) {
		$this->db->where("a.start_time >=", _getDateEnglish($param['start_date']) . ' 00:00:00');
		$this->db->where("a.start_time <=", _getDateEnglish($param['end_date']) . ' 23:59:59');
	}
	
	
	$this -> db -> group_by("a.reason, a.agent");
	
	//echo $this -> db ->_get_var_dump();
	
	foreach( $this -> db ->get()->result_assoc() as $rows ) {
		$results[$rows['AgentId']][$rows['ReasonId']] += $rows['Times'];
	}

	return $results;
} 
 
 // getBySummary
 
 function _getSummary( $param = null )
 {
	$results = array();
	$this->db->select("
		b.id as AgentId, sum(if( a.`status` in(1), (unix_timestamp(a.end_time)-unix_timestamp(a.start_time)),0)) as ready,
		sum(if( a.`status` in(2), (unix_timestamp(a.end_time)-unix_timestamp(a.start_time)),0)) as notready,
		sum(if( a.`status` in(3), (unix_timestamp(a.end_time)-unix_timestamp(a.start_time)),0)) as acw,
		sum(if( a.`status` in(4), (unix_timestamp(a.end_time)-unix_timestamp(a.start_time)),0)) as busy",
	FALSE);
		
	$this->db->from('cc_agent_activity_log a'); 
	$this->db->join('cc_agent b','a.agent=b.id','LEFT');
	$this->db->join('tms_agent c','b.userid=c.id','LEFT');
	
	// is param 
	
	if( is_array($param) 
		AND isset($param['GroupCallCenter']) ) {
		$this->db->where("b.agent_group",$param['GroupCallCenter'], FALSE);
	}
	
	// filter next agent_id 
	
	if( is_array($param) 
		AND isset($param['AgentId']) AND !empty($param['AgentId']) ) {
		$this->db->where_in('b.id',$param['AgentId']);
	}
	
	// filter next start date 
	
	if( is_array($param) 
		AND isset($param['start_date']) AND isset($param['end_date']) ) {
		$this->db->where("a.start_time >=", _getDateEnglish($param['start_date']) . ' 00:00:00');
		$this->db->where("a.start_time <=", _getDateEnglish($param['end_date']) . ' 23:59:59');
	}
	
	$this -> db ->group_by("AgentId");
	
	// echo $this -> db ->_get_var_dump();
	
	foreach( $this -> db ->get()->result_assoc() as $rows ) {
		$results[$rows['AgentId']]['ready'] += $rows['ready'];
		$results[$rows['AgentId']]['notready'] += $rows['notready'];
		$results[$rows['AgentId']]['acw'] += $rows['acw'];
		$results[$rows['AgentId']]['busy'] += $rows['busy'];
		$results[$rows['AgentId']]['TalkTime']+= 0;
	}
	
	
/* sum talk call session **/
  
	$this->db->select("a.agent_id, SUM(IF( a.status IN(3004,3005), (unix_timestamp(a.end_time)-unix_timestamp(a.agent_time)),0)) as sum_talk", FALSE);
	$this->db->from("cc_call_session a");
	$this->db->join("cc_agent b", "a.agent_id=b.id",'LEFT');
	$this->db->join("tms_agent c", "b.userid=c.id",'LEFT');
	$this->db->where('a.agent_time IS NOT NULL','',FALSE);
	$this->db->where("date(a.agent_time)!=", "0000-00-00",FALSE);
	
// param date 	

	if( is_array($param) 
		AND isset($param['start_date']) AND isset($param['end_date']) ) 
		{
		$this->db->where("a.start_time >=", _getDateEnglish($param['start_date']) . ' 00:00:00');
		$this->db->where("a.start_time <=", _getDateEnglish($param['end_date']) . ' 23:59:59');
	}
	
// AgentId date	

	if( is_array($param) 
		AND isset($param['AgentId']) AND !empty($param['AgentId']) ) 
	{
		$this->db->where_in('a.agent_id',$param['AgentId']);
	}
	
// agent && run query 
	
	$this->db->group_by("a.agent_id");
	foreach( $this ->db ->get()->result_assoc() as $rows ) {
		$results[$rows['agent_id']]['TalkTime']+= $rows['sum_talk'];
	}

	return $results;
 } 
 
 

// _get Reason Type 

function _getDailyReasonType( $param = null )
{
	$this ->db ->select(" 
		b.id AS AgentId,  d.reasonid as ReasonId, date(a.start_time) as tgl, 
		SUM(IF(a.status IN(2), (UNIX_TIMESTAMP(a.end_time)- UNIX_TIMESTAMP(a.start_time)), 0)) AS Times",  
	FALSE);
	
	$this ->db ->from("cc_agent_activity_log a");
	$this ->db ->join("cc_agent b"," a.agent=b.id ", "LEFT");
	$this ->db ->join("tms_agent c "," b.userid=c.id","LEFT");
	$this ->db ->join("cc_reasons d "," a.reason=d.reasonid","LEFT");
	
	$this->db->where("d.reasonid IS NOT NULL ",'', FALSE);
	
	// is param 
	
	if( is_array($param) 
		AND isset($param['GroupCallCenter']) ) {
		$this->db->where("b.agent_group",$param['GroupCallCenter'], FALSE);
	}
	
	// filter next agent_id 
	
	if( is_array($param) 
		AND isset($param['AgentId']) AND !empty($param['AgentId']) ) {
		$this->db->where_in('b.id',$param['AgentId']);
	}
	
	// filter next start date 
	
	if( is_array($param) 
		AND isset($param['start_date']) AND isset($param['end_date']) ) {
		$this->db->where("a.start_time >=", _getDateEnglish($param['start_date']) . ' 00:00:00');
		$this->db->where("a.start_time <=", _getDateEnglish($param['end_date']) . ' 23:59:59');
	}
	
	
	$this -> db -> group_by(" a.reason, a.agent, tgl");
	
	//__($this -> db ->_get_var_dump());
	
	foreach( $this -> db ->get()->result_assoc() as $rows ) {
		$results[$rows['AgentId']][$rows['tgl']][$rows['ReasonId']] += $rows['Times'];
	}

	return $results;
} 
  
  
// getByDaily

function _getDaily($param=null)
{
	$results = array();
	$this->db->select("
		b.id as AgentId, date(a.start_time) as tgl, 
		sum(if( a.`status` in(1), (unix_timestamp(a.end_time)-unix_timestamp(a.start_time)),0)) as ready,
		sum(if( a.`status` in(2), (unix_timestamp(a.end_time)-unix_timestamp(a.start_time)),0)) as notready,
		sum(if( a.`status` in(3), (unix_timestamp(a.end_time)-unix_timestamp(a.start_time)),0)) as acw,
		sum(if( a.`status` in(4), (unix_timestamp(a.end_time)-unix_timestamp(a.start_time)),0)) as busy",
	FALSE);
		
	$this->db->from('cc_agent_activity_log a'); 
	$this->db->join('cc_agent b','a.agent=b.id','LEFT');
	$this->db->join('tms_agent c','b.userid=c.id','LEFT');
	
	// is param 
	
	if( is_array($param) 
		AND isset($param['GroupCallCenter']) ) {
		$this->db->where("b.agent_group",$param['GroupCallCenter'], FALSE);
	}
	
	// filter next agent_id 
	
	if( is_array($param) 
		AND isset($param['AgentId']) AND !empty($param['AgentId']) ) {
		$this->db->where_in('b.id',$param['AgentId']);
	}
	
	// filter next start date 
	
	if( is_array($param) 
		AND isset($param['start_date']) AND isset($param['end_date']) ) {
		$this->db->where("a.start_time >=", _getDateEnglish($param['start_date']) . ' 00:00:00');
		$this->db->where("a.start_time <=", _getDateEnglish($param['end_date']) . ' 23:59:59');
	}
	
	$this -> db ->group_by("AgentId,tgl");
	
	//__($this -> db ->_get_var_dump());
	
	foreach( $this -> db ->get()->result_assoc() as $rows ) {
		$results[$rows['AgentId']][$rows['tgl']]['ready'] += $rows['ready'];
		$results[$rows['AgentId']][$rows['tgl']]['notready'] += $rows['notready'];
		$results[$rows['AgentId']][$rows['tgl']]['acw'] += $rows['acw'];
		$results[$rows['AgentId']][$rows['tgl']]['busy'] += $rows['busy'];
		$results[$rows['AgentId']][$rows['tgl']]['TalkTime']+= 0;
	}
	
	
/* sum talk call session **/
  
	$this->db->select("a.agent_id, date(a.start_time) as tgl, SUM(IF( a.status IN(3004,3005), (unix_timestamp(a.end_time)-unix_timestamp(a.agent_time)),0)) as sum_talk", FALSE);
	$this->db->from("cc_call_session a");
	$this->db->join("cc_agent b", "a.agent_id=b.id",'LEFT');
	$this->db->join("tms_agent c", "b.userid=c.id",'LEFT');
	$this->db->where('a.agent_time IS NOT NULL','',FALSE);
	$this->db->where("date(a.agent_time)!=", "0000-00-00",FALSE);
	
// param date 	

	if( is_array($param) 
		AND isset($param['start_date']) AND isset($param['end_date']) ) 
		{
		$this->db->where("a.start_time >=", _getDateEnglish($param['start_date']) . ' 00:00:00');
		$this->db->where("a.start_time <=", _getDateEnglish($param['end_date']) . ' 23:59:59');
	}
	
// AgentId date	

	if( is_array($param) 
		AND isset($param['AgentId']) AND !empty($param['AgentId']) ) 
	{
		$this->db->where_in('a.agent_id',$param['AgentId']);
	}
	

// agent && run query 
	
	$this->db->group_by("a.agent_id, tgl");
	foreach( $this ->db ->get()->result_assoc() as $rows ) {
		$results[$rows['agent_id']][$rows['tgl']]['TalkTime']+=$rows['sum_talk'];
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
