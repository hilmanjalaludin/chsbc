<?php
class CronJob extends EUI_Controller
{
	function CronJob()
	{
		parent::__construct();
	}
	
	function testing()
	{
		$date = '2016-03-27';
		$dayofweek = date('w', strtotime($date));
		echo $dayofweek;
	}
	
	function testing2()
	{
		$date = date('Y-m-d');
		$dayofweek = date('W', strtotime($date));
		$week_number = $dayofweek;
		$year = date('Y');
		
		for($day=1; $day<=6; $day++)
		{
			$_date = date('Y-m-d', strtotime($year."W".$week_number.$day));
			
			$this->db->insert('t_gn_lastcall',array(
				'LastCallStartDate' => $_date,
				'LastCallEndDate' 	=> $_date,
				'LastCallStartTime' => '08:00',
				'LastCallEndTime' 	=> (date('w', strtotime($_date))>5?'14:00':'18:00'),
				'LastCallReason' 	=> 'CRONJOB '.date('Y-m-d H:i:s'),
				'LastCallStatus' 	=> 1,
				'LasCallCreateBy' 	=> 1,
				'LastCallCreateDate' => date('Y-m-d H:i:s'),
			));
		}
		
		$this->db->query('delete from t_gn_lastcall where LastCallStartDate < date(now())'); 
	}
	
	function testing3()
	{
		$date = '2016-03-27';
		$dayofweek = date('W', strtotime($date));
		$week = $dayofweek+1;
        $year = date('Y');

        $timestamp = mktime( 0, 0, 0, 1, 1,  $year ) + ( $week * 7 * 24 * 60 * 60 );
        $timestamp_for_monday = $timestamp - 86400 * ( date( 'N', $timestamp ) - 1 );
        $date_for_monday = date( 'Y-m-d', $timestamp_for_monday );
		
		echo $date_for_monday;
	}
	
	function delete_chat_history(){
		$this->db->query('delete from tms_agent_chat where recd = 1 where sent < Curdate()');
	}
	
	function delete_broadcast_history(){
		$this->db->query('delete from tms_agent_msgbox where recd = 1 where sent < Curdate()');
	}
}
?>