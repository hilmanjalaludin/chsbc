<?php
class M_CallAutoDial extends EUI_Model
{
	function M_CallAutoDial()
	{
		
	}
	
	function _get_combo_recsource()
	{
		$datas = array();
		
		$sql = "select FTP_Recsource from t_gn_upload_report_ftp order by FTP_UploadId desc";
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				$datas[$rows['FTP_Recsource']] = $rows['FTP_Recsource'];
			}
		}
		
		return $datas;
	}
	
	function _get_next_autodial($param)
	{
		$_datas = array('result'=>0, 'detail'=>array());
		
		$sql = "select * from t_gn_autodial a
				where a.AutoDialKey = '".$param['AutoKey']."'
				and a.AutoDialFlag=0 ";
		
		if(isset($param['CustomerId'])&&$param['CustomerId']!='')
		{
			$sql .= " AND a.CustomerId = '".$param['CustomerId']."' ";
		}
		
		$sql .=	" order by AutoDialId asc
				limit 1";
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			$row = $qry->result_first_assoc();
			
			$this->db->update('t_gn_autodial',array(
				'AutoDialFlag' => 1
			),array(
				'AutoDialId' => $row['AutoDialId']
			));
			
			if($this->db->affected_rows()>0)
			{
				$_datas['result'] = 1;
				$_datas['detail'] = $row;
			}
		}
		
		return $_datas;
	}
	
	function _set_flag_by_cust($param)
	{
		$conds = false;
		
		$this->db->update('t_gn_autodial',array(
			'AutoDialFlag' => 1
		),array(
			'CustomerId' => $param['CustomerId'],
			'AutoDialKey' => $param['AutoKey'],
		));
		
		if($this->db->affected_rows()>0)
		{
			$conds = true;
		}
		
		return $conds;
	}
	
	/* DI SKIP DLU BENTAR */
	function _get_list_customer($recsource)
	{
		$datas = array();
		
		$sql = "SELECT
					a.CustomerId
				FROM ( t_gn_customer a ) 
				INNER JOIN t_gn_assignment b ON a.CustomerId=b.CustomerId
				LEFT JOIN t_gn_campaign d ON a.CampaignId=d.CampaignId
				LEFT JOIN t_gn_ver_result g ON a.CustomerId=g.cust_id
				WHERE d.OutboundGoalsId=2
				AND b.AssignBlock=0
				AND d.CampaignStatusFlag=1
				AND (g.ver_result <> 2 or g.ver_result is null)
				#AND a.expired_date > '".date('Y-m-d')."'
				AND ( a.CallReasonId IN(1) OR a.CallReasonId IS NULL )
				AND b.AssignSelerId='"._get_session('UserId')."' 
				AND a.Recsource = '".$recsource."'";
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			// print_r($qry->result_assoc());
			foreach( $qry->result_assoc() as $rows )
			{
				$datas[] = $rows['CustomerId'];
			}
		}
		
		return $datas;
	}
	
	function _get_phone_num($cust_id)
	{
		$datas = array();
		
		$sql = "SELECT
					a.CustomerMobilePhoneNum,
					a.CustomerHomePhoneNum,
					a.CustomerWorkPhoneNum
				FROM ( t_gn_customer a ) 
				WHERE (TRUE)
				AND a.CustomerId = '".$cust_id."'";
		// echo $sql;
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			foreach( $qry->result_first_assoc() as $key => $val )
			{
				if($val!='')
				{
					$datas[$key] = array(
						'Field' => $key,
						'Value' => $val,
					);
				}
			}
		}
		
		return $datas;
	}
	/* END OF DI SKIP DLU BENTAR */
}
?>