<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ReportQa extends EUI_Model {

	
	public function __construct () {
		$this->status = array(
			"verified" => "15,16" , 
			"suspend" => "10,11,12,17,20,21,19"
		);
	}
	
	public function getMonth ( $date = "" ) {
		$date = explode("-" , $date);
		$tanggal = $date[0];
		$bulan = $date[1];
		$tahun = $date[2];
		
		switch ( $bulan ) {
			case '01' : 
				return $tanggal."-Januari-".$tahun;

			break; case '02' : 
				return $tanggal."-Februari-".$tahun;

			break; case '03' : 
				return $tanggal."-Maret-".$tahun;

			break; case '04' : 
				return $tanggal."-April-".$tahun;

			break; case '05' : 
				return $tanggal."-Mei-".$tahun;

			break; case '06' : 
				return $tanggal."-Juni-".$tahun;

			break; case '07' : 
				return $tanggal."-Juli-".$tahun;

			break; case '08' : 
				return $tanggal."-Agustus-".$tahun;

			break; case '09' : 
				return $tanggal."-September-".$tahun;

			break; case '10' : 
				return $tanggal."-Oktober-".$tahun;

			break; case '11' : 
				return $tanggal."-November-".$tahun;

			break; case '12' : 
				return $tanggal."-Desember-".$tahun;

			break;
		}
	}

	/**
	 * [getAllQa get Nama dan Id Qa]
	 * @return [query] [result]
	 */
	
	public function getAllQa () {
		
		$this->getAllqa = $this->db->query("
			SELECT tms_agent.UserId,tms_agent.full_name
			FROM tms_agent 
			LEFT JOIN tms_agent_profile ON tms_agent.handling_type=tms_agent_profile.id
			WHERE tms_agent_profile.id='11' and tms_agent.UserId not in(5,6)
		");

		if ( $this->getAllqa == true AND $this->getAllqa->num_rows() > 0 ) {
			return $this->getAllqa;
		} else {
			return false;
		}
	}

	


	/**
	 * [viewDailySummary description]
	 * @return Start Daily Summary Model
	 */
	public function DailySummary ( $date = "" , $time = "" ,  $status = "" ) {
		if ( is_array( $date )  ) { 
			$startdate = isset( $date['startdate'] ) ? $date['startdate'] : null;
			$enddate = isset( $date['enddate'] ) ?  $date['enddate'] : null;
		} if (  is_array( $time )  ) {
			$starttime = isset( $time['starttime'] ) ? $time['starttime'] : null;
			$endtime = isset( $time['endtime'] ) ?  $time['endtime'] : null;
		}
		
		if ( $status == "ALL" ) {
			$groupby = "";
		} else {
			$groupby = "group by DATE_FORMAT(b.Assign_Create_Ts , '%d-%m-%Y' )";
		}
		
		if ( $startdate == $enddate ) {
			$durationsdate = "date_format(b.Assign_Create_Ts,'%d-%m-%Y')='$startdate'";
		} else {
			$durationsdate = "b.Assign_Create_Ts between STR_TO_DATE('$startdate','%d-%m-%Y') AND STR_TO_DATE('$enddate','%d-%m-%Y')";
		}
		
		$getDailySummary = "select 
			m.date_ofcallmon as TanggalJualan , 
			count(b.PolicyId) as ProductionTm ,
			( select sum(gos.duration) 
					from cc_recording gos
					where gos.assignment_data=a.CustomerId
				) as TotalDuration 
			sum( if(e.CallReasonQue != 9 , 1, 0) ) as AchPolicy 
			from t_gn_policyautogen a
			inner join score_result m on a.CustomerId=m.id_customer
			inner join t_gn_policy b on a.PolicyNumber=b.PolicyNumber
			inner join t_gn_customer e on a.CustomerId=e.CustomerId and e.CallReasonId in(35,36,37)
			WHERE 
			$durationsdate
			AND DATE_FORMAT(m.date_ofcallmon , '%T' ) BETWEEN '$starttime' AND '$endtime'
			and e.CampaignId not in(19,20,21)
			$groupby)";
			
		$getDailySummary = "select 
			a.UserId , 
			b.Assign_Create_Ts as TanggalJualan ,
			count(b.Id) as ProductionTm,
			sum( if( c.CallReasonQue not in (9,99) , 1 , 0 ) ) as AchPolicy ,
			sum( 
				(select max(duration) from cc_recording where assignment_data=c.CustomerId) 
			) as TotalDuration 
			from tms_agent a
			inner join t_gn_quality_assignment b on a.UserId=b.Quality_Staff_Id
			inner join t_gn_assignment d on b.Assign_Data_Id=d.AssignId
			inner join t_gn_customer c on d.CustomerId=c.CustomerId
			where $durationsdate
			AND date_format(b.Assign_Create_Ts , '%T' ) BETWEEN '$starttime' AND '$endtime'
			and a.profile_id in(11,5)
			and c.CampaignId not in(19,20,21)
			$groupby";
		
		//echo $getDailySummary;

		$gds = $this->db->query( $getDailySummary );
		if ( $gds == true AND $gds->num_rows() > 0 ) {
			return $gds;
		} else {
			return false;
		}
	}

	// end for daily summary

	/**
	 * [ReportperQa description]
	 * @return Start ReportperQa Model
	 */
	public function ReportperQa ( $status = "" , $idQa = "" , $startdate = "" , $enddate = "" , $statperformance = '' ) {
		if ( $statperformance == 'ALL' ) {
			$statperformances = "";
		} else {
			$statperformances = "group by date_format(m.date_ofcallmon , '%d-%m-%Y')";
		}

		if ( $status == "getqa" ) {
			if ( $idQa == "ALL" ) {
				$queryReportPerQa = "select * from tms_agent a where a.profile_id=11 and a.UserId not in(5,6)";
				$checkQueryQa = $this->db->query($queryReportPerQa);
				if ( $checkQueryQa->num_rows() > 0 ) {
					return $checkQueryQa;
				} else {
					return "error";
				}
			} else {
				$queryReportPerQa = "select * from tms_agent a where a.UserId=$idQa";
				$checkQueryQa = $this->db->query($queryReportPerQa);
				if ( $checkQueryQa->num_rows() > 0 ) {
					$cqq = $checkQueryQa->row();
					return $cqq->full_name;
				} else {
					return "";
				}
			}
		} else if (  $status == "getperformance" ) {
			$performanceperqa = "select  
				COUNT(CASE WHEN a.CallReasonId = 35 THEN 1 END) AS totalProduction , 
				COUNT(CASE WHEN a.CallReasonQue not in(9,99) THEN 1 END) AS totalAchievementPif , 
				a.CallReasonQue as AproveStatus ,
				a.CustomerUpdatedTs as Updates ,
				c.full_name as NamaQa , 
				sum((
					select 
					sum(cr.duration) from cc_recording cr 
					where cr.assignment_data=a.CustomerId )) as totalDuration
				from t_gn_customer a
				left join tms_agent c on a.QueueId=c.UserId 			
				inner join score_result m on a.CustomerId=m.id_customer				
				where m.date_ofcallmon between STR_TO_DATE('$startdate','%d-%m-%Y') AND STR_TO_DATE('$enddate','%d-%m-%Y')
				and a.CallReasonId=35 and c.UserId=$idQa
				and a.CampaignId not in(19,20,21)
				$statperformances
				";
			//echo $performanceperqa;
			$performanceqa = $this->db->query($performanceperqa);
			if ( $performanceqa->num_rows() > 0 ) {
				return $performanceqa;
			} else {
				return "error";
			}

		}


	}
	// end for Report Qa Model


	/**
	 * [ReportperQa description]
	 * @return Start SuspendDuration Model
	 */
	public function SuspendDuration ( $starttime = "" , $endtime = "" , $startdate = "" , $enddate = "" , $status = "" , $statperformance = '' ) {
		
		if ( $statperformance == 'getperformance' ) {
			if ( $status == "ALL" ) {
				$getApproveDataplus = "";
			} else if ( $status == '' ) {
				if ( $starttime == "" and $endtime == "" ) {
					$getApproveDataplus = "";
				} else {
					$getApproveDataplus = "AND DATE_FORMAT(m.date_ofcallmon , '%T') BETWEEN '$starttime' AND '$endtime' group by a.UserId";
				}
			}
			
			if ( $startdate == $enddate ) {
				$durationdate = "date_format(m.date_ofcallmon,'%d-%m-%Y')='$startdate'";
			} else {
				$durationdate = "m.date_ofcallmon BETWEEN STR_TO_DATE('$startdate','%d-%m-%Y') AND STR_TO_DATE('$enddate','%d-%m-%Y')";
			}

			$approveQuery = "select 
				a.full_name as NamaQa ,
				m.date_ofcallmon as Updates , 
				count(b.CustomerId) as totalFollow ,
				sum( if( b.CallReasonQue in(10,11,19,20,21,12,17) , 1, 0 ) ) as totalSuspend,
				max(ccr.duration) as TotalDuration 
				from tms_agent a 
				inner join t_gn_customer b on a.UserId=b.QueueId
				inner join cc_recording ccr on b.CustomerId=ccr.assignment_data
				left join score_result m on b.CustomerId=m.id_customer	
				left join t_lk_aprove_status c on b.CallReasonQue=c.ApproveId
				where a.profile_id=11 and b.CallReasonQue not in(9,99)
				and $durationdate
				and b.CampaignId not in(19,20,21)
				$getApproveDataplus
			";

			//echo $approveQuery;
			
			$getApproveData = $this->db->query( $approveQuery );
			if ( $getApproveData == true ) {
				return $getApproveData;
			} else {
				return false;
			}


		} else if ( $statperformance == 'gettotal' ) {
			if ( $status == "ALL" ) {
				$getApproveDataplus = "";
			} else if ( $status == '' ) {
				if ( $starttime == "" and $endtime == "" ) {
					$getApproveDataplus = "";
				} else {
					$getApproveDataplus = "AND DATE_FORMAT(m.date_ofcallmon , '%T') BETWEEN '$starttime' AND '$endtime'";
				}
			}
			
			if ( $startdate == $enddate ) {
				$durationdate = "date_format(m.date_ofcallmon,'%d-%m-%Y')='$startdate'";
			} else {
				$durationdate = "m.date_ofcallmon BETWEEN STR_TO_DATE('$startdate','%d-%m-%Y') AND STR_TO_DATE('$enddate','%d-%m-%Y')";
			}

			$approveQuery = "select 
				a.full_name as NamaQa ,
				m.date_ofcallmon as Updates , 
				count(b.CustomerId) as totalFollow ,
				sum( if( b.CallReasonQue in(10,11,19,20,21,12,17) , 1, 0 ) ) as totalSuspend,
				sum(
					(select max(duration) from cc_recording where assignment_data=b.CustomerId group by assignment_data) 
				) as TotalDuration 
				from tms_agent a 
				inner join t_gn_customer b on a.UserId=b.QueueId
				inner join cc_recording ccr on b.CustomerId=ccr.assignment_data
				left join t_lk_aprove_status c on b.CallReasonQue=c.ApproveId
				inner join score_result m on b.CustomerId=m.id_customer	
				where a.profile_id=11 and b.CallReasonQue not in(9,99)
				and $durationdate
				and b.CampaignId not in(19,20,21)
				$getApproveDataplus
			";

			//echo $approveQuery;
			
			$getApproveData = $this->db->query( $approveQuery );
			if ( $getApproveData == true ) {
				return $getApproveData;
			} else {
				return false;
			}
		}



	}
	// end for SuspendDuration
	
	/**
	 * [CallMonPerformance description]
	 * @return Start CallMonPerformance Model
	 */
	public function CallMonPerformance ( $startdate = '' , $enddate = '' , $status = '' , $statperform = '' ) {

		if ( $statperform == 'ALL' ) {
			$statperformanceall = "";
			$groupbyqa = "";
		} else {
			$statperformanceall = "group by date_format(m.date_ofcallmon , '%d-%m-%Y')";
			$groupbyqa = "group by a.QueueId";
		}

		if ( $status == 'getperformance' ) {
			$callmon = "select 
				m.date_ofcallmon as Dates ,
				sum( if( a.CallReasonId = 35 , 1, 0 ) ) as TotalProductionSales ,
				sum( if( a.CallReasonQue not in(9,99) , 1, 0 ) ) as TotalProductionQa ,
				sum((
					select 
					sum(cr.duration) from cc_recording cr 
					where cr.assignment_data=a.CustomerId )) as totalDuration , 
				sum( if( a.CallReasonQue in(10,11,19,20,21,12,17) , 1, 0 ) ) as TotalSuspend ,
				sum( if( a.CallReasonQue in(1,15,16) , 1, 0 ) ) as TotalVerified ,
				sum( if( a.CallReasonQue in(3,18,14,13) , 1, 0 ) ) as TotalDeclined ,
				sum( if( a.CallReasonQue = 9  , 1, 0 ) ) as TotalNew 
				from t_gn_customer a
				left join tms_agent b on a.QueueId=b.UserId
				inner join score_result m on a.CustomerId=m.id_customer	
				where b.profile_id=11
				and m.date_ofcallmon between STR_TO_DATE('$startdate','%d-%m-%Y') AND STR_TO_DATE('$enddate','%d-%m-%Y')
				and a.CampaignId not in(19,20,21)

				$statperformanceall
				";
			$this->callmon = $this->db->query($callmon);
			if ( $this->callmon->num_rows() > 0 ) {
				return $this->callmon;
			} else {
				return "error";
			}
		} elseif ( $status == 'gettotal' ) {
			$callmon = "select 
				m.date_ofcallmon as Dates ,
				sum( if( a.CallReasonId = 35 , 1, 0 ) ) as TotalProductionSales ,
				sum( if( a.CallReasonQue not in(9,99) , 1, 0 ) ) as TotalProductionQa ,
				sum((
					select 
					sum(cr.duration) from cc_recording cr 
					where cr.assignment_data=a.CustomerId )) as totalDuration , 
				sum( if( a.CallReasonQue in(10,11,19,20,21,12,17) , 1, 0 ) ) as TotalSuspend ,
				sum( if( a.CallReasonQue in(1,15,16) , 1, 0 ) ) as TotalVerified ,
				sum( if( a.CallReasonQue in(3,18,14,13) , 1, 0 ) ) as TotalDeclined ,
				sum( if( a.CallReasonQue = 9  , 1, 0 ) ) as TotalNew 
				from t_gn_customer a
				left join tms_agent b on a.QueueId=b.UserId
				inner join score_result m on a.CustomerId=m.id_customer
				where b.profile_id=11
				and m.date_ofcallmon between STR_TO_DATE('$startdate','%d-%m-%Y') AND STR_TO_DATE('$enddate','%d-%m-%Y')
				and a.CampaignId not in(19,20,21)
				";
			$this->callmon = $this->db->query($callmon);
			if ( $this->callmon->num_rows() > 0 ) {
				return $this->callmon;
			} else {
				return "error";
			}

		} else if ( $status == "ALL" ) {
			$callmon = "select 
				m.date_ofcallmon as Dates ,
				sum( if( a.CallReasonId = 35 , 1, 0 ) ) as TotalProductionSales ,
				sum( if( a.CallReasonQue not in(9,99) , 1, 0 ) ) as TotalProductionQa ,
				sum((
					select 
					sum(cr.duration) from cc_recording cr 
					where cr.assignment_data=a.CustomerId )) as totalDuration, 
				b.full_name as namaQa
				from t_gn_customer a
				left join tms_agent b on a.QueueId=b.UserId
				inner join score_result m on a.CustomerId=m.id_customer
				where b.profile_id=11 
				and m.date_ofcallmon between STR_TO_DATE('$startdate','%d-%m-%Y') AND STR_TO_DATE('$enddate','%d-%m-%Y')
				and a.CampaignId not in(19,20,21)
				$groupbyqa";
			$this->callmon = $this->db->query($callmon);
			if ( $this->callmon->num_rows() > 0 ) {
				return $this->callmon;
			} else {
				return "error";
			}
		}

	} 
	// end CallMonPerformance
	/**
	 * [getQaActivity description]
	 * @return [type] [description]
	 * Get All Activity By Date and By Time
	 */
	public function getQaActivity ( $startdate = '' , $enddate = '' , $status = '' , $statperform = '' , $idQa = "" ) {
		$actionactivity = "'ACTION_EVENT_LOGIN','ACTION_EVENT_LOGOUT'";
		/* Status Not Ready
		* 1. Briefing
		* 2. Pray
		* 3. Rest
		* 4. Lunch
		* 5. Outbound
		*/
			$getactivityqa = "
				select 
				a.full_name as NamaQa , 
				a.UserId ,
				if(date_format(b.ActivityDate,'%d-%m-%Y') IS NULL , 'N/A' , date_format(b.ActivityDate,'%d-%m-%Y')) as DateSet ,
				if( min(date_format(b.ActivityDate,'%H:%i:%s')) IS NULL , 'N/A' , min(date_format(b.ActivityDate,'%H:%i:%s')) ) 
				as StartTime ,
				if( max(date_format(b.ActivityDate,'%H:%i:%s')) IS NULL , 'N/A' , max(date_format(b.ActivityDate,'%H:%i:%s')) )
				as EndTime , 
				if( substr(TIMESTAMPDIFF(SECOND, min(b.ActivityDate), max(b.ActivityDate)) / 60,1,4) IS NULL , 'N/A' ,  
				substr(TIMESTAMPDIFF(SECOND, min(b.ActivityDate), max(b.ActivityDate)) / 60,1,4) ) 
				as TotalTime ,

				sum(if( c.reason=1 , (TIMESTAMPDIFF(SECOND, c.start_time,c.end_time) / 60 ) , 0 ))  as Briefing , 
				sum(if( c.reason=2 , (TIMESTAMPDIFF(SECOND, c.start_time,c.end_time) / 60 ) , 0 ))  as Pray ,
				sum(if( c.reason=3 , (TIMESTAMPDIFF(SECOND, c.start_time,c.end_time) / 60 ) , 0 ))  as Rest , 
				sum(if( c.reason=4 , (TIMESTAMPDIFF(SECOND, c.start_time,c.end_time) / 60 ) , 0 ))  as Lunch , 
				sum(if( c.reason=5 , (TIMESTAMPDIFF(SECOND, c.start_time,c.end_time) / 60 ) , 0 ))  as Outbound ,

				sum(if( c.reason=1 , (TIMESTAMPDIFF(SECOND, c.start_time,c.end_time) / 60 ) , 0 )) + 
				sum(if( c.reason=2 , (TIMESTAMPDIFF(SECOND, c.start_time,c.end_time) / 60 ) , 0 )) +
				sum(if( c.reason=3 , (TIMESTAMPDIFF(SECOND, c.start_time,c.end_time) / 60 ) , 0 )) +
				sum(if( c.reason=4 , (TIMESTAMPDIFF(SECOND, c.start_time,c.end_time) / 60 ) , 0 )) +
				sum(if( c.reason=5 , (TIMESTAMPDIFF(SECOND, c.start_time,c.end_time) / 60 ) , 0 ))
				as TotalNotReady , 
				'' as EfectiveTime
				from tms_agent a

				left join t_gn_activitylog b on a.UserId=b.ActivityUserId
					and date_format(b.ActivityDate,'%d-%m-%Y')='$startdate'
					and b.ActivityEvent in('ACTION_EVENT_LOGIN','ACTION_EVENT_LOGOUT')

				left join cc_agent_activity_log c on b.ActivityUserId=c.agent
					and date_format(c.start_time,'%d-%m-%Y')='$startdate'
					and date_format(c.end_time,'%d-%m-%Y')='$startdate'
					
				where 
				a.profile_id in(11,5) 
				and a.UserId not in(4,5,6)
				group by a.UserId , date_format(b.ActivityDate , '%d-%m-%Y');
			";
			$getactivityqa = $this->db->query($getactivityqa);
			if ( $getactivityqa == true AND $getactivityqa->num_rows() > 0 ) {
				return $getactivityqa;
			} else {
				return "error";
			}
	} 
	
	/**
	 * [getRealTime description]
	 * @return [type] [description]
	 */
	public function getRealTime ( $time = "" , $status = "" , $getdate = "" ) {
		
		if ( $getdate != "" ) {
			$getdate = $getdate;
		} else {
			$getdate = date("Y-m-d");
		}
		
		if (  is_array( $time )  ) {
			$starttime = isset( $time['starttime'] ) ? $time['starttime'] : null;
			$endtime = isset( $time['endtime'] ) ?  $time['endtime'] : null;
		}
		
		if ( $status == "ALL" ) : $groupby = "" ;
		else : $groupby = "group by a.UserId ";
		endif;
		
		if ( $status == "QA" ) {
			$getRealTime = "
				select 
				a.UserId , 
				a.full_name as NamaQa ,
				count(b.Id) as totalAssign,
				sum( if( c.CallReasonQue != 9 , 1 , 0 ) ) as TotalFollow ,
				(select sum(duration) from cc_recording where assignment_data=c.CustomerId) 
				as totalduration 
				from tms_agent a
				left join t_gn_quality_assignment b on a.UserId=b.Quality_Staff_Id
				left join t_gn_assignment d on b.Assign_Data_Id=d.AssignId
				left join t_gn_customer c on d.CustomerId=c.CustomerId
				where date_format(b.Assign_Create_Ts,'%Y-%m-%d')='$getdate'
				and a.profile_id in(11,5)
				and c.CampaignId not in(19,20,21)
				$groupby
			";
		} else {
			$getRealTime = "
				select 
				a.UserId , 
				a.full_name as NamaQa ,
				count(b.Id) as totalAssign,
				sum( if( c.CallReasonQue != 9 , 1 , 0 ) ) as TotalFollow ,
				(select sum(duration) from cc_recording where assignment_data=c.CustomerId) 
				as totalduration 
				from tms_agent a
				left join t_gn_quality_assignment b on a.UserId=b.Quality_Staff_Id
				left join t_gn_assignment d on b.Assign_Data_Id=d.AssignId
				left join t_gn_customer c on d.CustomerId=c.CustomerId
				where date_format(b.Assign_Create_Ts,'%Y-%m-%d')='$getdate'
				and date_format(b.Assign_Create_Ts,'%T') between '$starttime' and '$endtime'
				and a.profile_id in(11,5)
				and c.CampaignId not in(19,20,21)
				$groupby
			";
		}
		
		//echo $getRealTime;
		$getRealTime = $this->db->query($getRealTime);
		if ( $getRealTime == true AND $getRealTime->num_rows() > 0 ) {
			return $getRealTime;
		} else {
			return false;
		}

	}
	/**
	 * [getSummaryDailyQa description]
	 * @param  string $startdate [description]
	 * @param  string $enddate   [description]
	 * @param  string $status    [description]
	 * @return [type]            [description]
	 */
	public function getSummaryQa ( $get = "" , $dates = "" , $enddates = "" , $statusapprove = "" ,  $getsummary = "" ) {
		$dateformat = explode("-" , $dates);
		$dateformat1 = explode("-" , $enddates);
		$tahun = $dateformat[2];    $tahun1 = $dateformat1[2];
		$bulan = $dateformat[1];    $bulan1 = $dateformat1[1];
		$tanggal = $dateformat[0];  $tanggal1 = $dateformat1[0];
		
		$dates_years = $tahun."-".$bulan."-".$tanggal ." 00:00:00";
		$enddates_years = $tahun1."-".$bulan1."-".$tanggal1 ." 23:59:00";
		//echo $enddates_years . "<br>";
		//echo $dates_years . "<br>";
		
		
		if ( $getsummary == 1 ) {
			if ( $dates == $enddates ) {
				$getall 	= "date_format(c.PolicySalesDate,'%d-%m-%Y')='$dates' and d.CampaignId not in(19,20,21) and d.CallReasonId in(35,36,37)";
				$new 		= "date_format(c.PolicySalesDate,'%d-%m-%Y')='$dates' and a.CampaignId not in(19,20,21) and a.CallReasonId in(35,36,37)";
				$production = "date_format(b.PolicySalesDate,'%d-%m-%Y')='$dates' and c.CampaignId not in(19,20,21) and c.CallReasonId in(35,36,37)";
				$passqa 	= "date_format(b.PolicySalesDate,'%d-%m-%Y')='$dates' and c.CampaignId not in(19,20,21) and c.CallReasonId in(35,36,37)";
				
			} else {
				$getall 	= "c.PolicySalesDate between '$dates_years' AND '$enddates_years' and d.CampaignId not in(19,20,21) and d.CallReasonId in(35,36,37)";
				$new 		= "c.PolicySalesDate between '$dates_years' AND '$enddates_years' and a.CampaignId not in(19,20,21) and a.CallReasonId in(35,36,37)";
				$production = "b.PolicySalesDate between '$dates_years' AND '$enddates_years' and c.CampaignId not in(19,20,21) and c.CallReasonId in(35,36,37)";
				$passqa 	= "b.PolicySalesDate between '$dates_years' AND '$enddates_years' and c.CampaignId not in(19,20,21) and c.CallReasonId in(35,36,37)";
			}
			
		} else {
			$getall = "date_format(c.PolicySalesDate,'%d-%m-%Y')='$dates' and d.CampaignId not in(19,20,21) and d.CallReasonId in(35,36,37)";
			
			$new 	= "date_format(c.PolicySalesDate,'%d-%m-%Y')='$dates' and a.CampaignId not in(19,20,21) and a.CallReasonId in(35,36,37)";
			
			$production = "date_format(b.PolicySalesDate,'%d-%m-%Y')='$dates'
						and c.CampaignId not in(19,20,21) and c.CallReasonId in(35,36,37)
						group by date_format(b.PolicySalesDate , '%Y-%m-%d') ";

			$passqa = "date_format(b.PolicySalesDate,'%d-%m-%Y')='$dates'
						and c.CampaignId not in(19,20,21) and c.CallReasonId in(35,36,37)
						group by date_format(b.PolicySalesDate , '%d-%m-%Y') ";
		}

		switch ( $get ) {
			case 'production': // dapatkan semua production tm pif dan anp
				$getquery = "select 
					count(distinct c.CustomerId) as ProductionPIF , 
					count(c.CustomerId) as Divide ,
					sum( if(d.PayModeId=2 , b.PolicyPremi*12 , b.PolicyPremi ) ) as ProductionANP 
					from t_gn_policyautogen a
					inner join t_gn_policy b on a.PolicyNumber=b.PolicyNumber
					left join t_gn_customer c on a.CustomerId=c.CustomerId
					inner join t_gn_productplan d on b.ProductPlanId=d.ProductPlanId
					where $production
				";
				break;
			
			case 'passqa': // dapatkan semua aktifitas qa , dari mulai sasignment sampai dikerjakan
				$getquery = "select
					count( distinct if(c.CallReasonQue != 9 , c.CustomerId , 0) ) as PassQaPif , 
					count( if(c.CallReasonQue != 9 , c.CustomerId , 0) ) as Divide , 
					sum( if(c.CallReasonQue != 9 , if( d.PayModeId = 2 , b.PolicyPremi*12 , b.PolicyPremi) , 0) ) as PassQaANP 
					from t_gn_policyautogen a
					inner join t_gn_policy b on a.PolicyNumber=b.PolicyNumber
					left join t_gn_customer c on a.CustomerId=c.CustomerId
					left join t_gn_productplan d on b.ProductPlanId=d.ProductPlanId
					where $passqa";
				break;

			case 'getall':
				$getquery = "select 
					count(distinct a.CustomerId) as TotalPIF , 
					count(a.CustomerId) as DividePIF , 
					sum(CASE WHEN d.CallReasonQue not in(9,99) THEN if(f.PayModeId=2 , c.PolicyPremi*12 , c.PolicyPremi)  else 0 END) as TotalANP ,
					
					count(DISTINCT CASE WHEN d.CallReasonQue in(16) THEN a.CustomerId END) as TotalVerifiedReconfirm ,
					count(CASE WHEN d.CallReasonQue in(16) THEN a.CustomerId END) as DivideReconfirm ,
					sum(CASE WHEN d.CallReasonQue in(16) THEN if(f.PayModeId=2 , c.PolicyPremi*12 , c.PolicyPremi) else 0 END) as TotalANPVerifiedReconfirm ,

					count(DISTINCT CASE WHEN d.CallReasonQue in(15) THEN a.CustomerId END) as TotalVerifiedSelling ,
					count(CASE WHEN d.CallReasonQue in(15) THEN a.CustomerId END) as DivideSelling ,
					sum(CASE WHEN d.CallReasonQue in(15) THEN if(f.PayModeId=2 , c.PolicyPremi*12 , c.PolicyPremi) else 0 END) as TotalANPVerifiedSelling ,

					count(DISTINCT CASE WHEN d.CallReasonQue in(14) THEN a.CustomerId END) as TotalDeclined ,
					count(CASE WHEN d.CallReasonQue in(14) THEN a.CustomerId END) as DivideDeclined ,
					sum(CASE WHEN d.CallReasonQue in(14) THEN if(f.PayModeId=2 , c.PolicyPremi*12 , c.PolicyPremi)  else 0 END) as TotalANPDeclined 

					from t_gn_callhistory a 
					inner join t_gn_policyautogen b on a.CustomerId=b.CustomerId
					inner join t_gn_policy c on b.PolicyNumber=c.PolicyNumber
					inner join t_gn_productplan e on c.ProductPlanId=e.ProductPlanId
					inner join t_lk_paymode f on e.PayModeId=f.PayModeId
					inner join t_gn_customer d on a.CustomerId=d.CustomerId
					where $getall
					and a.ApprovalStatusId in($statusapprove)";
				break;

			case 'nettqa':
				$getquery = "";

				break;
				
			case 'new':
				$getquery = "select  
					count(a.CustomerId) as TotalNewPIF , 
					sum( if( d.PayModeId=2 , c.PolicyPremi*12 , c.PolicyPremi ) ) as TotalNewANP 
					from t_gn_customer a
					inner join t_gn_policyautogen b on a.CustomerId=b.CustomerId
					inner join t_gn_policy c on b.PolicyNumber=c.PolicyNumber
					inner join t_gn_productplan d on c.ProductPlanId=d.ProductPlanId
					where $new
					and a.CallReasonQue in(9,99);
				";

				break;

			case 'extract':
				$getquery = "";

				break;

			default : 

				break;
		}
		
		$getAllQuery = $this->db->query($getquery);
		if ( $getAllQuery == true AND $getAllQuery->num_rows() > 0 ) {
			return $getAllQuery->row();
		} else {
			return "error";
		}
	}


	public function getPassQa ( $date = "" , $get = "" , $enddate = "" , $getsummary = ""  , $iduser = "" , $reason = '' ) {
		$agent = isset($_GET["agent"]) ? $_GET["agent"] : null;
		$date = explode( "-" , $date );
		$date = $date[2]."-".$date[1]."-".$date[0];

		if ( $enddate != "" ) {
			$enddate = explode( "-" , $enddate );
			$enddate = $enddate[2]."-".$enddate[1]."-".$enddate[0];
		}

		if ( $getsummary == 1 ) {
			if ( $iduser != "" ) {
				$iduser = "and a.SellerId in($agent)";
			} else {
				$iduser = "";
			}
			$getsummary = "date(c.PolicySalesDate) between date('$date') and date('$enddate')";
		} else {
			if ( $iduser != "" ) {
				$iduser = "and a.SellerId ='$iduser'";
			} else {
				$iduser = "";
			}
			$getsummary = "date(c.PolicySalesDate)=date('$date') ";
		}

		$passqa = "select 
				count(a.CustomerId) as TotalPif , 
				sum( if(d.PayModeId=2 , c.PolicyPremi*12 , c.PolicyPremi ) ) as TotalANP ,
				d.PayModeId as PayMode
				from t_gn_customer a
				inner join t_gn_policyautogen b on a.CustomerId=b.CustomerId
				inner join t_gn_policy c on b.PolicyNumber=c.PolicyNumber
				left join t_gn_productplan d on c.ProductPlanId=d.ProductPlanId
				where a.CallReasonId in(35,36,37)
				and a.CampaignId not in (19,20,21)
				and a.CallReasonQue in($reason)
				$iduser
				and $getsummary";

		$passqa = $this->db->query($passqa);
		if ( $passqa == true and $passqa->num_rows() > 0 ) {
			$ps = $passqa->row();
			if ( $get == 'pif' ) {
				return $ps->TotalPif;
			} elseif ( $get == 'anp' ) {
				return $ps->TotalANP;
			}


		} else {
			if ( $get == 'pif' ) {
				return 'N/A';
			} elseif ( $get == 'anp' ) {
				return 'N/A';
			}
		}

	}


	public function getBySpesAgent () {
		$agent  = isset($_GET['agent']) ? $_GET['agent'] : null;
				$getquery = "select 
					a.UserId , 
					a.init_name as TMRName ,
					b.init_name as SPVname , 
					c.init_name as ATMName 
					from tms_agent a
					inner join tms_agent b on a.tl_id=b.UserId
					inner join tms_agent c on a.spv_id=c.UserId 
					where a.UserId in($agent)";
		$getallagent = $this->db->query($getquery);
		if ( $getallagent == true and $getallagent->num_rows() > 0 ) {
			return $getallagent;
		} else {
			return false;
		}
	}

	/**
	 * [getSummaryDailyQa description]
	 * @param  string $startdate [description]
	 * @param  string $enddate   [description]
	 * @param  string $status    [description]
	 * @return [type]            [description]
	 */
	public function getSummaryQaPerTmr ( $get = "" , $dates = "" , $enddates = "" , $statusapprove = "" ,  $getsummary = "" , $userid = "" ) {

		if ( $getsummary == 1 ) {
			$agent  = isset($_GET['agent']) ? $_GET['agent'] : null;

			$getall 	= "c.PolicySalesDate between STR_TO_DATE('$dates','%d-%m-%Y') AND STR_TO_DATE('$enddates','%d-%m-%Y') 
							and d.CampaignId not in(19,20,21)
							and d.SellerId in($agent)";

			$new 		= "c.PolicySalesDate between STR_TO_DATE('$dates','%d-%m-%Y') AND STR_TO_DATE('$enddates','%d-%m-%Y') 
							and a.CampaignId not in(19,20,21)
							and a.SellerId in($agent)";

			$production = "b.PolicySalesDate between STR_TO_DATE('$dates','%d-%m-%Y') AND STR_TO_DATE('$enddates','%d-%m-%Y') 
							and c.CampaignId not in(19,20,21)
							and c.SellerId in($agent)";

			$passqa 	= "b.PolicySalesDate between STR_TO_DATE('$dates','%d-%m-%Y') AND STR_TO_DATE('$enddates','%d-%m-%Y') 
							and c.CampaignId not in(19,20,21)
							and c.SellerId in($agent)";

		} else {
			if ( strlen($enddates) > 3 ) { }
			else {
				$getall = "date_format(c.PolicySalesDate,'%d-%m-%Y')='$dates'
							and d.CampaignId not in(19,20,21)
							and d.SellerId='$enddates'";
			}
	
			if ( strlen($enddates) > 3 ) { }
			else {
				$new = "date_format(c.PolicySalesDate,'%d-%m-%Y')='$dates'
						and a.SellerId='$enddates'
						and a.CampaignId not in(19,20,21)
						group by date_format(c.PolicySalesDate , '%Y-%m-%d')";
						
				$production = "date_format(b.PolicySalesDate,'%d-%m-%Y')='$dates'
						and c.SellerId='$enddates'
						and c.CampaignId not in(19,20,21)
						group by date_format(b.PolicySalesDate , '%Y-%m-%d')";

				$passqa = "date_format(b.PolicySalesDate,'%d-%m-%Y')='$dates'
						and c.SellerId='$enddates'
						and c.CampaignId not in(19,20,21)
						group by date_format(b.PolicySalesDate , '%d-%m-%Y')";
			}

		}

		

		switch ( $get ) {
			case 'production': // dapatkan semua production tm pif dan anp
				$getquery = "select 
					count(distinct c.CustomerId) as ProductionPIF , 
					sum( if(d.PayModeId=2 , b.PolicyPremi*12 , b.PolicyPremi ) ) as ProductionANP 
					from t_gn_policyautogen a
					inner join t_gn_policy b on a.PolicyNumber=b.PolicyNumber
					left join t_gn_customer c on a.CustomerId=c.CustomerId
					inner join t_gn_productplan d on b.ProductPlanId=d.ProductPlanId
					where $production
				";
				break;
			
			case 'passqa': // dapatkan semua aktifitas qa , dari mulai sasignment sampai dikerjakan
				$getquery = "select
					count( distinct if(c.CallReasonQue != 9 , c.CustomerId , 0) ) as PassQaPif , 
					sum( if(c.CallReasonQue != 9 , if( d.PayModeId = 2 , b.PolicyPremi*12 , b.PolicyPremi) , 0) ) as PassQaANP 
					from t_gn_policyautogen a
					inner join t_gn_policy b on a.PolicyNumber=b.PolicyNumber
					left join t_gn_customer c on a.CustomerId=c.CustomerId
					left join t_gn_productplan d on b.ProductPlanId=d.ProductPlanId
					where $passqa";
				break;

			case 'getall':
				$getquery = "select 
					count(distinct a.CustomerId) as TotalPIF , 
					count(a.CustomerId) as DividePIF , 
					sum(CASE WHEN d.CallReasonQue not in(9,99) THEN if(f.PayModeId=2 , c.PolicyPremi*12 , c.PolicyPremi)  else 0 END) as TotalANP ,
					
					count(DISTINCT CASE WHEN d.CallReasonQue in(16) THEN a.CustomerId END) as TotalVerifiedReconfirm ,
					count(CASE WHEN d.CallReasonQue in(16) THEN a.CustomerId END) as DivideReconfirm ,
					sum(CASE WHEN d.CallReasonQue in(16) THEN if(f.PayModeId=2 , c.PolicyPremi*12 , c.PolicyPremi) else 0 END) as TotalANPVerifiedReconfirm ,

					count(DISTINCT CASE WHEN d.CallReasonQue in(15) THEN a.CustomerId END) as TotalVerifiedSelling ,
					count(CASE WHEN d.CallReasonQue in(15) THEN a.CustomerId END) as DivideSelling ,
					sum(CASE WHEN d.CallReasonQue in(15) THEN if(f.PayModeId=2 , c.PolicyPremi*12 , c.PolicyPremi) else 0 END) as TotalANPVerifiedSelling ,

					count(DISTINCT CASE WHEN d.CallReasonQue in(14) THEN a.CustomerId END) as TotalDeclined ,
					count(CASE WHEN d.CallReasonQue in(14) THEN a.CustomerId END) as DivideDeclined ,
					sum(CASE WHEN d.CallReasonQue in(14) THEN if(f.PayModeId=2 , c.PolicyPremi*12 , c.PolicyPremi)  else 0 END) as TotalANPDeclined 

					from t_gn_callhistory a 
					inner join t_gn_policyautogen b on a.CustomerId=b.CustomerId
					inner join t_gn_policy c on b.PolicyNumber=c.PolicyNumber
					inner join t_gn_productplan e on c.ProductPlanId=e.ProductPlanId
					inner join t_lk_paymode f on e.PayModeId=f.PayModeId
					inner join t_gn_customer d on a.CustomerId=d.CustomerId
					where $getall
					and a.ApprovalStatusId=$statusapprove";
				break;

			case 'nettqa':
				$getquery = "";

				break;
			
			case 'new':
				$getquery = "select 
					count(distinct a.CustomerId) as TotalNewPIF , 
					sum( if( d.PayModeId=2 , c.PolicyPremi*12 , c.PolicyPremi ) ) as TotalNewANP 
					from t_gn_customer a
					inner join t_gn_policyautogen b on a.CustomerId=b.CustomerId
					inner join t_gn_policy c on b.PolicyNumber=c.PolicyNumber
					inner join t_gn_productplan d on c.ProductPlanId=d.ProductPlanId
					where $new
					and a.CallReasonQue in(9,99);
				";

				break;

			case 'extract':
				$getquery = "";

				break;

			default : 

				break;
		}

		$getAllQuery = $this->db->query($getquery);
		if ( $getAllQuery == true AND $getAllQuery->num_rows() > 0 ) {
			return $getAllQuery->row();
		} else {
			return "error";
		}
	}

	/**
	 * [getSummaryDate description]
	 * @param  string $startdate [description]
	 * @param  string $enddate   [description]
	 * @param  string $status    [description]
	 * @return [type]            [description]
	 */
	public function getDetailSummaryQa ( $getdate = "" , $status = "") {
		
		/** get total data 
		verified selling , 15
		verified reconfirm , 16
		suspend data edit , 11
		suspend selling , 12
		declined confirm , 14
		Suspend Data Selling Confirm , 21
		Suspend Data Selling Pending , 20
		**/
		if ( $status != "" ) {
			$sellerid = "and c.SellerId='$status' group by a.CustomerId";
		}  
		
		if ( $status == "totalall" ) {
			$sellerid = "";
		} else {
			$sellerid = " group by a.CustomerId";
		}
		
		
		$getDetailSummaryQa = "select 
		
			sum(if (c.CallReasonQue=15 , 1 , 0)) as TotVerifiedSelling ,
			sum(if (c.CallReasonQue=16 , 1 , 0)) as TotVerifiedReconfirm , 
			sum(if (c.CallReasonQue=11 , 1 , 0)) as TotSuspendDataEdit ,
			sum(if (c.CallReasonQue=12 , 1 , 0)) as TotSuspendSelling , 
			sum(if (c.CallReasonQue=14 , 1 , 0)) as TotDeclineConfirm ,
			sum(if (c.CallReasonQue=21 , 1 , 0)) as TotSuspendDataSellingConfirm ,
			sum(if (c.CallReasonQue=20 , 1 , 0)) as SuspendDataSellingPending , 
			sum(if (c.CallReasonQue=18 , 1 , 0)) as TotDeclineCancel ,
			sum(if (c.CallReasonQue=17 , 1 , 0)) as TotSuspendStill ,
			
			b.PolicySalesDate as DateSelling , 
			(select date_ofcallmon from score_result where c.CustomerId=id_customer) as DateCallMon , 
			f.id as QaStaff , 
			c.CustomerId as CustomerId , 
			c.CustomerFirstName as CustomerName , 
			j.ProductPlanName as ProductPlan , 
			sum(b.PolicyPremi) as TotalPremi , 
			group_concat(k.PremiumGroupName) as ProductDesc , 
			g.id as LeaderName , 
			h.id as AgentName , 
			i.AproveName as StatusApprove 
			from t_gn_policyautogen a
			inner join t_gn_policy b on a.PolicyNumber=b.PolicyNumber
			inner join t_gn_customer c on a.CustomerId=c.CustomerId
			left join t_lk_aprove_status i on c.CallReasonQue=i.ApproveId
			left join tms_agent f on c.QueueId=f.UserId
			left join tms_agent h on c.SellerId=h.UserId
			left join tms_agent g on h.tl_id=g.UserId
			#left join score_result e on c.CustomerId=e.id_customer
			inner join t_gn_product d on a.ProductId=d.ProductId
			inner join t_gn_productplan j on b.ProductPlanId=j.ProductPlanId
			inner join t_lk_premiumgroup k on j.PremiumGroupId=k.PremiumGroupId 
			where date_format(b.PolicySalesDate,'%d-%m-%Y')='$getdate'
			and c.CampaignId not in(19,20,21)
			and c.CallReasonId in(35,36,37)
			$sellerid
			";
		
		
		$getDetailSummaryQa = $this->db->query($getDetailSummaryQa);
		if ( $getDetailSummaryQa == true AND $getDetailSummaryQa->num_rows() > 0 ) {
			if ( $status == 'totalall' ) {
				return $getDetailSummaryQa->row();
			} else {
				return $getDetailSummaryQa->result();
			}
			
		} else {
			return false;
		}
	}


	public function getDuration ( $idCustomer = "" ) {
		$getduration = "select
			max(b.duration) as TotalDuration
			from t_gn_assignment a
			inner join cc_recording b on a.CustomerId=b.assignment_data
			where a.CustomerId='$idCustomer'	
		";
		$getDurationdb = $this->db->query($getduration);
		if ( $getDurationdb->num_rows() > 0 ) {
			$gdb = $getDurationdb->row();
			return _getDuration($gdb->TotalDuration);
		} else {
			return "error";
		}
	}

	/**
	 * @param  string
	 * @param  string
	 * @return [type]
	 */
	public function getCallMon ( $startdate = "" , $enddate = "" ) {
		if ( $startdate == $enddate ) {
			$paramdate = "date_format(a.PolicySalesDate,'%d-%m-%Y')='$startdate'";
		} else {
			$paramdate = "a.PolicySalesDate between STR_TO_DATE('$startdate','%d-%m-%Y') AND STR_TO_DATE('$enddate','%d-%m-%Y')";
		}

	 	$getCallMon = "
			select 
			b.CustomerId as IdCustomer ,
			e.full_name as NamaQa ,
			g.init_name as NamaTmr , 
			f.init_name as NamaSpv, 
			c.CustomerFirstName as NamaCustomer , 
			h.AproveName as StatusAprove ,
			i.ProductName as NamaProduct ,
			a.PolicySalesDate as DateSelling , 
			d.date_ofcallmon as DateCallMon ,
			d.question_value as QuestionValue , 
			d.comment_value as CommentValue ,
			a.PolicyPremi as TotalPremi ,
			if(c.CallReasonQue in(15,16) , 1 , '') as Verified , 
			if(c.CallReasonQue in(11) , 1 , '') as SuspendDataEdit , 
			if(c.CallReasonQue in(19) , 1 , '') as SuspendDataSelling ,
			if(c.CallReasonQue in(12) , 1 , '') as SuspendSelling ,
			l.PayerCity as Kota ,
			k.Province as Provinsi ,
			l.PayerMobilePhoneNum as AdditionalPhone
			from t_gn_policy a
			inner join t_gn_policyautogen b on a.PolicyNumber=b.PolicyNumber
			inner join t_gn_customer c on b.CustomerId=c.CustomerId
			inner join score_result d on c.CustomerId=d.id_customer
			left join tms_agent e on c.QueueId=e.UserId
			left join tms_agent g on c.SellerId=g.UserId
			left join tms_agent f on g.tl_id=f.UserId
			left join t_lk_aprove_status h on c.CallReasonQue=h.ApproveId
			left join t_gn_product i on b.ProductId=i.ProductId
			left join t_gn_assignment j on c.CustomerId=j.CustomerId
			inner join t_gn_payer l on b.CustomerId=l.CustomerId
			left join t_lk_province as k on l.ProvinceId=k.ProvinceId
			where 
			$paramdate
			and c.CallReasonQue not in(9,99)
			and c.CampaignId not in(19,20,21);
	 	";

	 	$CallmonReport = $this->db->query($getCallMon);
	 	if ( $CallmonReport == true and $CallmonReport->num_rows() > 0 ) {
	 		return $CallmonReport;
	 	} else {
	 		return "error";
	 	}
	}

	public function getAllAgent () {
		$query = "select a.UserId, a.id , a.init_name
			 from tms_agent a where a.handling_type IN( ". USER_AGENT_INBOUND .", ". USER_AGENT_OUTBOUND .")
			 order by a.id ASC ";
		$getallagent = $this->db->query($query);
		if ( $getallagent == true ) {
			return $getallagent;
		} else {
			return false;
		}
	}

	

	public function getScore ( $getScoreResult = array() , $getInterval = "" , $status = "" ) {
		/*switch ($groupscoring) {
			case '1':
				$groupscoring = "CALL COURTESY";
				break;
			
			case '2':
				$groupscoring = "CALL ACCURACY";
				break;
			
			case '3':
				$groupscoring = "TRICKY INDICATIONS";
				break;
			
			case '4':
				$groupscoring = "FRAUD INDICATIONS";
				break;
			
			case '5':
				$groupscoring = "PRESENTATION";
				break;
			
			case '6':
				$groupscoring = "UNDERWRITING PROCESS";
				break;
		}*/

		$getInterval = explode("-", $getInterval);
		$startInt = $getInterval[0];
		$endInt   = $getInterval[1];

		$startDefaultInt = 0;
		$endDefaultInt = 44;

		//print_r($getScoreResult);

		$calcScore = 0;

		if ( $status == "ALL" ) {
			for ( $x = 0 ; $x <= 43 ; $x++ ) {
				if ( $getInterval == "10-17" or $getInterval == "22-31" ) {
						$calcScore = $getScoreResult[$x]*2;
				} else {
					$calcScore += $getScoreResult[$x];
				}				
			}
		} else {
			for ( $x = $startInt ; $x <= $endInt ; $x++ ) {
				$calcScore += $getScoreResult[$x];
			}
		}

		$calcScore = $calcScore;
		return $calcScore;

	}


	function explodeConcat (  ) {

	}


}

/* End of file M_ReportQa.php */
/* Location: ./application/model/M_ReportQa.php */