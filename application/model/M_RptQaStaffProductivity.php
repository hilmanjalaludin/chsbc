<?php
class M_RptQaStaffProductivity extends EUI_Model
{
	function M_RptQaStaffProductivity()
	{
		
	}
	
	function GetDataA($param)
	{
		$datas = array();
		
		if(!is_null($param) && is_array($param) && count($param) > 0)
		{
			$sql = "select 
						d.UserId, d.id, d.full_name, 
						count(c.CustomerId) as CallDistributed,
						sum( if(c.CallReasonQue <> 9,1,0) ) as CallMonitored,
						sum( if(c.CallReasonQue <> 9,1,0) ) as SampleCheck,
						sum( if(date(a.Assign_Create_Ts) = '".date_format(date_create($param['end_date']),"Y-m-d")."',1,0) ) as TatOneDay,
						round( ( sum( if(date(a.Assign_Create_Ts) = '".date_format(date_create($param['end_date']),"Y-m-d")."',1,0) ) / count(c.CustomerId) ) * 100, 2) as TatRates
					from t_gn_quality_assignment a
					left join t_gn_assignment b on a.Assign_Data_Id = b.AssignId
					left join t_gn_customer c on b.CustomerId = c.CustomerId
					left join tms_agent d on a.Quality_Staff_Id = d.UserId
					left join t_lk_callreason e on c.CallReasonId = e.CallReasonId
					left join t_lk_callreasoncategory f on e.CallReasonCategoryId = f.CallReasonCategoryId
					where 1=1 
					and f.CallReasonInterest = 1
					and f.CallOutboundGoalsId = 2
					and a.Quality_Staff_Id in (".$param['user_a'].")
					and date(a.Assign_Create_Ts) >= '".date_format(date_create($param['start_date']),"Y-m-d")."'
					and date(a.Assign_Create_Ts) <= '".date_format(date_create($param['end_date']),"Y-m-d")."'
					group by d.UserId";
			// echo "<pre>$sql</pre>";
			$qry = $this->db->query($sql);
			
			if($qry->num_rows() > 0)
			{
				foreach($qry->result_assoc() as $rows)
				{
					$datas[$rows['UserId']] = $rows;
				}
				
			}
		}
		
		return $datas;
	}
	
	function GetDataB($param)
	{
		$datas = array();
		
		if(!is_null($param) && is_array($param) && count($param) > 0)
		{
			$sql = "SELECT
						a.ScroingQualityId,
						COUNT(DISTINCT a.CustomerId) AS CallDistribute,
						SUM(IF(b.CallReasonQue <> 9,1,0)) AS CallMonitored,
						SUM(IF(DATE(a.ScoringCreateTs) = '".date_format(date_create($param['end_date']),"Y-m-d")."',1,0)) AS TatOneDay,
						ROUND((SUM(IF(DATE(a.ScoringCreateTs) = '".date_format(date_create($param['end_date']),"Y-m-d")."',1,0)) / COUNT(a.CustomerId)) * 100, 2) AS TatRates
					FROM t_gn_qa_scoring a
						LEFT JOIN t_gn_customer b ON a.CustomerId = b.CustomerId
					WHERE 1=1
						AND a.ScroingQualityId IN (".$param['user_b'].")
						AND DATE(a.ScoringCreateTs) >= '".date_format(date_create($param['start_date']),"Y-m-d")."'
						AND DATE(a.ScoringCreateTs) <= '".date_format(date_create($param['end_date']),"Y-m-d")."'
					GROUP BY a.ScroingQualityId";
			// echo "<pre>$sql</pre>";
			$qry = $this->db->query($sql);
			
			if($qry->num_rows() > 0)
			{
				foreach($qry->result_assoc() as $rows)
				{
					$datas[$rows['ScroingQualityId']] = $rows;
				}
				
			}
		}
		
		return $datas;
	}
	
	function GetDataH($param)
	{
		$datas = array();
		
		if(!is_null($param) && is_array($param) && count($param) > 0)
		{
			$sql = "SELECT
						a.ScroingQualityId,
						COUNT(DISTINCT a.CustomerId) AS CallDistribute,
						SUM(IF(b.CallReasonQue <> 9,1,0)) AS CallMonitored,
						SUM(IF(DATE(a.ScoringCreateTs) = '".date_format(date_create($param['end_date']),"Y-m-d")."',1,0)) AS TatOneDay,
						ROUND((SUM(IF(DATE(a.ScoringCreateTs) = '".date_format(date_create($param['end_date']),"Y-m-d")."',1,0)) / COUNT(a.CustomerId)) * 100, 2) AS TatRates
					FROM t_gn_qa_scoring a
						LEFT JOIN t_gn_customer b ON a.CustomerId = b.CustomerId
					WHERE 1=1
						AND a.ScroingQualityId IN (".$param['user_b'].")
						AND DATE(a.ScoringCreateTs) >= '".date_format(date_create($param['start_date']),"Y-m-d")."'
						AND DATE(a.ScoringCreateTs) <= '".date_format(date_create($param['end_date']),"Y-m-d")."'
					GROUP BY a.ScroingQualityId";
			// echo "<pre>$sql</pre>";
			$qry = $this->db->query($sql);
			
			if($qry->num_rows() > 0)
			{
				foreach($qry->result_assoc() as $rows)
				{
					$datas[$rows['ScroingQualityId']] = $rows;
				}
				
			}
		}
		
		return $datas;
	}
}
?>