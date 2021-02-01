<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class M_ActivityReport extends EUI_Model
{

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
 
public static function & get_instance() 
{
  if( is_null(self::$instance)) {
	self::$instance = new self();
  }
	
	return self::$instance;
 }
 
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function index( $param = null) 
{
	if( !is_null($param) )
	{
		self::$param = $param;
		if( !is_null(self::$param) )
		{	
			switch(self::$param['group_by']) 
			{
				case 'group_spv' 	:  self::ActivityGroupBySpv(); break;
				case 'group_agent'  : self::ActivityGroupByAgent(); break;
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
 
public function ActivityGroupBySpv()
{
	if( !is_null(self::$param) )
	{
		switch(trim(self::$param['mode']))
		{
			// case 'hourly' 	: self::hourlyActivityGroupBySpv(); 	break;
			// case 'daily'  	: self::dailyActivityGroupBySpv(); 		break;
			case 'summary'  : self::summaryActivityGroupBySpv(); 	break;	
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
 
private function ActivityGroupByAgent()
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
 
private function hourlyActivityGroupBySpv()
{

}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
private function dailyActivityGroupBySpv()
{

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

	$this ->db ->select
		(
			"COUNT(a.id) as tot_call, c.UserId, c.full_name,
			 SUM(IF(a.`status` in(3005,3004),1,0)) as tot_connected,
			 SUM(IF(a.`status` NOT IN(3005,3004),1,0)) as tot_abandone,
			 SUM(IF(a.`status` IN(3005,3004),unix_timestamp(a.end_time)-unix_timestamp(a.start_time),0)) as tot_talk ",
		FALSE);
			
		$this ->db ->from("cc_call_session a");
		$this ->db ->join("cc_agent b ","a.agent_id=b.id","LEFT");
		$this ->db ->join("tms_agent c "," b.userid=c.id","LEFT");
		$this ->db ->where("a.direction",self::$param['CallType']);
		$this ->db ->where("DATE(a.start_time)>=",self::$param['start_date']);
		$this ->db ->where("DATE(a.start_time)<=",self::$param['end_date']);
		$this ->db ->where("c.UserId IS NOT NULL ","",FALSE);
		$this ->db ->where_in('c.UserId',self::$param['agent_id']);
		$this ->db ->group_by("c.UserId");
		//echo $this ->db ->_get_var_dump();
		
		
		foreach( $this ->db ->get()->result_assoc() as $rows )
		{
			self::$view_body[$rows['UserId']]['tot_call']= $rows['tot_call'];
			self::$view_body[$rows['UserId']]['full_name']= $rows['full_name'];
			self::$view_body[$rows['UserId']]['tot_connected']= $rows['tot_connected'];
			self::$view_body[$rows['UserId']]['tot_abandone']= $rows['tot_abandone'];
			self::$view_body[$rows['UserId']]['tot_talk']= $rows['tot_talk'];
		}
}


/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
private function summaryActivityGroupBySpv()
{
	$this ->db ->select
	(
		"COUNT(a.id) as tot_call, d.UserId, d.full_name,
		 SUM(IF(a.`status` in(3005,3004),1,0)) as tot_connected,
		 SUM(IF(a.`status` NOT IN(3005,3004),1,0)) as tot_abandone,
		 SUM(IF(a.`status` IN(3005,3004),unix_timestamp(a.end_time)-unix_timestamp(a.start_time),0)) as tot_talk ",
	FALSE);
		
	$this ->db ->from("cc_call_session a");
	$this ->db ->join("cc_agent b ","a.agent_id=b.id","LEFT");
	$this ->db ->join("tms_agent c "," b.userid=c.id","LEFT");
	$this ->db ->join("tms_agent d ","c.spv_id=d.UserId","LEFT");
	$this ->db ->where("a.direction",self::$param['CallType']);
	$this ->db ->where("DATE(a.start_time)>=",self::$param['start_date']);
	$this ->db ->where("DATE(a.start_time)<=",self::$param['end_date']);
	$this ->db ->where("d.UserId IS NOT NULL ","",FALSE);
	$this ->db ->where_in("c.spv_id",self::$param['spv_id']);
	$this ->db ->group_by("c.spv_id");
	
	$i = 0;
	foreach($this ->db ->get() -> result_assoc() as $rows )
	{
		self::$view_body[$rows['UserId']]['tot_call']= $rows['tot_call'];
		self::$view_body[$rows['UserId']]['full_name']= $rows['full_name'];
		self::$view_body[$rows['UserId']]['tot_connected']= $rows['tot_connected'];
		self::$view_body[$rows['UserId']]['tot_abandone']= $rows['tot_abandone'];
		self::$view_body[$rows['UserId']]['tot_talk']= $rows['tot_talk'];
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


 
}