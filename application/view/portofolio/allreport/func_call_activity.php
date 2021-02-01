<?php  

// pengambilan agent 
class GetAgent {
	static $AgentId;
	public function __construct ( $AgentId = "" ) {
		self::$AgentId = $AgentId;
		$this->EUI =& get_instance(); 

	}

	public function getAgentLoop ( $AgentId = "" ) {
		$loadDb = $this->EUI->db->query("SELECT * 
			FROM tms_agent a 
			WHERE 
			a.profile_id=4 
			AND a.user_state=1
			AND a.UserId in($AgentId)
			");
		if ( $loadDb == true AND $loadDb->num_rows() > 0 ) {
			return $loadDb->result();
		} else {
			return 0;
		}
	}

	public function getAgentById () {
		// select agent by id
		$SelectAgent = $this->EUI->db->query("SELECT * FROM tms_agent a WHERE a.UserId='".self::$AgentId."'");
		if ( $SelectAgent == true AND $SelectAgent->num_rows() > 0 ) {
			return $SelectAgent->row();
		} else {
			return 0;
		}
	}

	public function getSpv ( $idAgents = "" ) {
		$selectSpv = $this->EUI->db->query("SELECT b.* 
			FROM tms_agent a 
			INNER JOIN tms_agent b on a.spv_id=b.UserId
			WHERE a.UserId='".$idAgents."'");
		if ( $selectSpv == true AND $selectSpv->num_rows() > 0 ) {
			return $selectSpv->row();
		} else {
			return 0;
		}
	}


}

// pengambilan call history
class GetCallHistory {

	public function __construct ( $AgentId = '' , $startdate = '' , $enddate = '' ) {
		$this->EUI =& get_instance();
		$this->AgentId = $AgentId;
		$this->startdate = $startdate;
		$this->enddate = $enddate;
	}

	public function getInitiatedContact () {
		$getInitiatedContact = "
		SELECT 
		SUM(IF(a.CallReasonId IN (8,10,3,7,9,11,13,14),1,0)) AS tot_connect, 
		--SUM(IF(a.CallReasonId IN (2,4,5,6),1,0)) AS tot_notconnect,
		COUNT(DISTINCT IF(a.CallReasonId IN (8,10,3,7,9,11,13,14), b.CustomerId ,0))-1 AS tot_connect_unique, 
		-- COUNT(DISTINCT IF(a.CallReasonId IN (2,4,5,6), b.CustomerId ,0)) AS tot_notconnect_unique ,
		COUNT(DISTINCT IF(a.CallReasonId IN (8,10,13), b.CustomerId ,0))-1 AS tot_connect_unique_2,
		COUNT(DISTINCT IF(a.CallReasonId IN (13), b.CustomerId ,0))-1 AS tot_incoming    
		-- COUNT(DISTINCT IF(a.CallReasonId IN (8,10,13), b.CustomerId ,0)) AS tot_notconnect_unique_2  
			FROM t_gn_callhistory a
			LEFT JOIN t_gn_customer b ON a.CustomerId = b.CustomerId
			LEFT JOIN t_gn_assignment c ON b.CustomerId = c.CustomerId
			WHERE a.HistoryType = 0
			AND a.CallHistoryCreatedTs >= '".$this->startdate." 00:00:00'
			AND a.CallHistoryCreatedTs <= '".$this->enddate." 23:59:59'
			AND a.CreatedById='".$this->AgentId."'";
		$getInitiatedContact = $this->EUI->db->query($getInitiatedContact);
		if ( $getInitiatedContact == true AND $getInitiatedContact->num_rows() > 0 ) {
			return $getInitiatedContact->row();
		} else {
			return 0;
		}
	}

	/**
	 * [getSolicitedByStatus description]
	 * @return [type] [description]
	 * Example , yang di ambil adalah CallReasonId
	 */
	public function getInitiatedByStatus () {

	}

	public function getIncoming () {

	}
}

/**
 * Get Durations For Customer Facing Time dan Adherence didalam Percent
 */
class GetDuration {

	public function __construct ( $AgentId = '' , $startdate = '' , $enddate = '' ) {
		$this->agentid   = $AgentId;
		$this->startdate = $startdate;
		$this->enddate   = $enddate;
		$this->EUI =& get_instance();
	}

	/**
	 * [getFC_Activity description]
	 * @param  string $In [description]
	 * @return [type]     [description]
	 */
	public function getFC_Activity ( $In = '1,3,4' ) {
		$selectActivity = "
			select 
			TIMESTAMPDIFF( SECOND , min(c.start_time) , max(c.end_time) )  as TotalActivity
			from tms_agent a 
			inner join cc_agent b on a.id=b.userid
			inner join cc_agent_activity_log c on b.id=c.agent
			where 
			c.`status` in($In)
			and c.start_time >= '$this->startdate 08:00:00'
			and c.start_time <= '$this->enddate 17:00:00'
			and a.id='".$this->agentid."' 
		";

		//echo $selectActivity;

		$selectActivity = $this->EUI->db->query( $selectActivity );
		
		if ( $selectActivity == true AND $selectActivity->num_rows() > 0 ) {
			return $selectActivity->row();
		} else {
			return 0;
		}
	}

	public function getFC_Schedule ( $In = "" ) {
		$date = $this->startdate;
		$end_date = $this->enddate;
		$getDuration = 0;
		while (strtotime($date) <= strtotime($end_date)) {
			// select schedule agent data
			$selectScheduleAgent = "
				SELECT * FROM t_gn_setschedule_agent a 
				WHERE a.DateSchedule='$date'
				AND a.AgentId='".$this->agentid."'
			";

			$selectScheduleAgent = $this->EUI->db->query(
				$selectScheduleAgent
			);

			if ( $selectScheduleAgent == true AND $selectScheduleAgent->num_rows() > 0 ) {
				$ssa = $selectScheduleAgent->row();
				// take call reason and counting duration for that
				if ( in_array( $ssa->ReasonId , $In ) ) {
					$date_schedule_start_time = $ssa->DateSchedule . " " . $ssa->StartTime;
					$date_schedule_end_time = $ssa->DateSchedule . " " . $ssa->EndTime;
				} else {
					// if duration is not found!
					$date_schedule_start_time = $date." ".setScheduleTime(days_name_bydate($date) , "start" , ":00") ;
					$date_schedule_end_time = $date." ".setScheduleTime(days_name_bydate($date) , "end" , ":00");
				}
			} else {
				$date_schedule_start_time = $date." ".setScheduleTime(days_name_bydate($date) , "start" , ":00") ;
				$date_schedule_end_time = $date." ".setScheduleTime(days_name_bydate($date) , "end" , ":00");
			}

			//echo convert_durations( $date_schedule_start_time , $date_schedule_end_time ) . "<br>";

			$convert_durations = convert_durations( $date_schedule_start_time , $date_schedule_end_time );

			$getDuration += $convert_durations;
			//echo $date . "<br>";			
		    
		    $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
		}

		return $getDuration;
	}


	// Get Duration Late and Cepat Pulang
	public function _getMinDuration ( $stat = "" ) {
		$date = $this->startdate;
		$end_date = $this->enddate;
		$getDurationFirst = 0;
		$getDurationLast  = 0;
		$getDuration_NoPresent = 0;

		while (strtotime($date) <= strtotime($end_date)) {
			// get schedule 
			$selectSchedule = "
				SELECT * FROM t_gn_setschedule_agent a 
				WHERE a.DateSchedule='$date' 
				AND a.AgentId='".$this->agentid."'
			";
			$selectSchedule = $this->EUI->db->query(
				$selectSchedule
			);

			// ActivityUserId , ActivityDate
			$selectActivityLog = "
				SELECT 
				TIMESTAMPDIFF( SECOND , MIN(a.ActivityDate) , MAX(a.ActivityDate)) as TotalActivity ,
				MIN(a.ActivityDate) as StartActivity , 
				MAX(a.ActivityDate) as EndActivity
				FROM t_gn_activitylog a 
				WHERE date_format(a.ActivityDate , '%Y-%m-%d')='$date'
				AND a.ActivityUserId='$this->agentid'
			";

			//echo $selectActivityLog . "<br>";

			if ( $selectSchedule == true AND $selectSchedule->num_rows() > 0 ) {

				$ss = $selectSchedule->row();
				// get startime
				$minschedule_start_time = $ss->DateSchedule . " " . $ss->StartTime ;
				$maxschedule_end_time   = $ss->DateSchedule . " " . $ss->EndTime ;	

			} else {
				// Jika tidak ada maka akan setting default schedule agent 
				$minschedule_start_time = $date . " " . setScheduleTime(days_name_bydate($date) , 'start' , ':00');
				$maxschedule_end_time   = $date . " " . setScheduleTime(days_name_bydate($date) , 'end' , ':00');
			}

			$selectActivityLog = $this->EUI->db->query($selectActivityLog);
			if ( $selectActivityLog == true AND $selectActivityLog->num_rows() > 0 ) {
				//echo $this->agentid . " $date -> " . $selectActivityLog->num_rows() . "<br>";

				$sal = $selectActivityLog->row();
				// get row activity log
				if ( $sal->StartActivity != NULL ) {
					$minactivity_start_time = $sal->StartActivity;
					$maxactivity_end_time   = $sal->EndActivity;
				} else {
					//echo $date . "<br>";
					
				if ( $selectSchedule == true AND $selectSchedule->num_rows() > 0 ) {
					$ssnopresent = $selectSchedule->row();
					// get startime
					$minactivity_start_time = $ssnopresent->DateSchedule . " " . $ssnopresent->StartTime ;
					$maxactivity_end_time   = $ssnopresent->DateSchedule . " " . $ssnopresent->EndTime ;	
				} else {
					// Jika tidak ada maka akan setting default schedule agent 
					$minactivity_start_time = $date . " " . setScheduleTime(days_name_bydate($date) , 'start' , ':00');
					$maxactivity_end_time   = $date . " " . setScheduleTime(days_name_bydate($date) , 'end' , ':00');
				}
						
					$get_duration_nopresent_first = strtotime($minactivity_start_time);
					$get_duration_nopresent_last  = strtotime($maxactivity_end_time);

					$get_duration_nopresent_total = $get_duration_nopresent_last - $get_duration_nopresent_first;
					$getDuration_NoPresent += $get_duration_nopresent_total;

				}

			} 

			// set Date format Schedule
			$format_minschedule_start_time = date_create($minschedule_start_time);
			$format_minschedule_start_time = date_format($format_minschedule_start_time , 'Y-m-d');
			$format_maxschedule_end_time   = date_create($maxschedule_end_time);
			$format_maxschedule_end_time   = date_format($format_maxschedule_end_time , 'Y-m-d');

			// set Date Format Activity
			$format_minactivity_start_time = date_create($minactivity_start_time);
			$format_minactivity_start_time = date_format($format_minactivity_start_time , 'Y-m-d');
			$format_maxactivity_end_time   = date_create($maxactivity_end_time);
			$format_maxactivity_end_time   = date_format($format_maxactivity_end_time , 'Y-m-d');

			// if data schedule == activity
			if ( $format_minschedule_start_time == $format_minactivity_start_time ) {
				$conv_minschedule_start_time = strtotime($minschedule_start_time);
				$conv_minactivity_start_time = strtotime($minactivity_start_time);
				if ( $conv_minactivity_start_time != '' OR $conv_minactivity_start_time != 0 ) {
					if ( days_name_bydate($date) != 'Minggu' ) $total_start_time_all = $conv_minactivity_start_time - $conv_minschedule_start_time;
					/**
					echo "start " . $format_minschedule_start_time . " = " . $format_minactivity_start_time . " => " . 
					$conv_minschedule_start_time . " = " . $conv_minactivity_start_time . " = " . $total_start_time_all
					. "<br>";
					**/
				}

	
			} 

			if ( $format_maxschedule_end_time == $format_maxactivity_end_time ) {
				$conv_maxschedule_end_time = strtotime($maxschedule_end_time);
				$conv_maxactivity_end_time = strtotime($maxactivity_end_time);
				if ( $conv_maxactivity_end_time != '' OR $conv_maxactivity_end_time != 0 ) {
					// Jika hasilnya minus maka Pulang Cepat
					if ( days_name_bydate($date) != 'Minggu' ) $total_end_time_all = $conv_maxactivity_end_time - $conv_maxschedule_end_time;
					
					/**if ( $this->agentid == "26" AND days_name_bydate($date) != 'Minggu' ) {
						echo $this->agentid . " -> " . $maxactivity_end_time . " - " . $maxschedule_end_time . "<br>" ;
					}**/

					/**
					echo "end " . $format_maxschedule_end_time . " = " . $format_maxactivity_end_time . " => " . 
					$conv_maxschedule_end_time . " = " . $conv_maxactivity_end_time . " = " . $total_end_time_all
					. "<br>";

					**/
				}

				
			}
			//echo "start " . $total_start_time_all . "<br>";
			//echo "end " . $total_end_time_all . "<br>";
			
			$getDurationFirst += $total_start_time_all;
			$getDurationLast  += $total_end_time_all;
			// get schedule 
			
		    $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
		}

		if ( $stat == "first" ) {
			return $getDurationFirst;
		} else if ( $stat == "last" ) {
			return $getDurationLast;
		} else if ( $stat == "nopresent" ) {
			return $getDuration_NoPresent;
		} else {
			return 0;
		}

	}

}

class GetScoring {

	/**
	 * [__construct description]
	 * @param string $AgentId   [description]
	 * @param string $startdate [description]
	 * @param string $enddate   [description]
	 */
	public function __construct ( $AgentId = '' , $startdate = '' , $enddate = '' ) {
		$this->agentid = $AgentId;
		$this->startdate = $startdate;
		$this->enddate = $enddate;
		$this->EUI =& get_instance();
	}

	// By Spv dan Qa
	// QA First Callmon,QA Second Callmon,SPV First Callmon,SPV Second Callmon
	public function getAverageQuality ( $stat = "" ) {
		$status_callmons = array(
			"QA1"  => "QA First Callmon" ,
			"QA2"  => "QA Second Callmon" , 
			"SPV1" => "SPV First Callmon" ,
			"SPV2" => "SPV Second Callmon" , 
			"QA"   => "'QA First Callmon','QA Second Callmon'" , 
			"SPV"  => "'SPV First Callmon','SPV Second Callmon'"
		);
		
		$selectScoring = "
			SELECT 
			a.CustomerId as CustomerId , 
			b.SellerId as AgentId , 
			AVG(a.Enter_New_Score) as AvgScoring 
			FROM t_gn_score_result a 
			INNER JOIN t_gn_customer b on a.CustomerId=b.CustomerId
			WHERE a.Status_Callmon in(".$status_callmons[$stat].")
			AND b.SellerId='".$this->agentid."'
			AND date_format(a.DateCreateTs , '%Y-%m-%d') >= '".$this->startdate."' 
			AND date_format(a.DateCreateTs , '%Y-%m-%d') <= '".$this->enddate."' 
		";

		//echo $selectScoring;

		$selectScoring = $this->EUI->db->query( $selectScoring );
		if ( $selectScoring == true AND $selectScoring->num_rows() > 0 ) {
			return $selectScoring->row();
		} else {
			return 0;
		}

	}
}

?>