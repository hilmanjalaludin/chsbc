<?php
	Class M_ReportPDS Extends EUI_Model
	{
		Function M_ReportPDS()
		{
			$this -> start_date = _getDateEnglish( $this -> URI->_get_post('start_date'));
			$this -> end_date 	= _getDateEnglish( $this -> URI->_get_post('end_date'));
			$this -> campaign	= _get_post('Campaign');
			$this -> TmrId		= _get_post('TmrId');
			$this -> spvId		= _get_post('spvId');
			$this -> group		= _get_post('group_type');
			// $this -> recsource	= _get_post('Recsource');
			// echo _get_post('Recsource')."<=asd";
			$this -> recsource	= explode(',',_get_post('Recsource'));
			$this -> recsource	= implode("','",$this->recsource);
			// echo $this -> recsource."<=";
		}
		
		Public Function _getPDSData()
		{
			$_data = array();
			$sqlbackup2 = "SELECT b.Recsource,c.CustomerId,COUNT(distinct a.Id) AS Total, COUNT(distinct c.CustomerPdsId) AS TotalCall, CASE WHEN (select concat( cast(CASE WHEN ba.CustomerMobilePhoneNum<>'' THEN '1,' ELSE '' END AS VARCHAR),
					cast(CASE WHEN ba.CustomerHomePhoneNum<>'' THEN '2,' ELSE '' END AS VARCHAR), cast(CASE WHEN ba.CustomerWorkPhoneNum<>'' THEN '3' ELSE '' END AS VARCHAR)) AS Prefered FROM t_gn_customer_pds ba where c.CampaignId = ba.CampaignId AND ba.CustomerId = c.CustomerId AND ba.CustomerPdsId=c.CustomerPdsId) LIKE concat('%',d.CallPreference,'%') THEN 0 ELSE 1 END AS lightening,
						CASE WHEN e.CustomerId IS NOT NULL THEN 1 ELSE 0 END AS Cancel, CASE WHEN c1.DialStatus = 0 THEN 1 ELSE 0 END AS Notyet,
						COUNT(distinct f1.CustomerId) AS Uncontacted, COUNT(distinct f2.CustomerId) AS Success, COUNT(distinct f3.CustomerId) AS Abandon
					FROM t_gn_customer_pds_asgmt_log a left JOIN t_gn_customer b ON a.CustomerId = b.CustomerId and a.AssignDate >= '$this->start_date' AND a.AssignDate <= '$this->end_date 23:00'
					left JOIN t_gn_customer_pds c ON a.AssignSession = c.AssignSession AND a.CustomerId = c.CustomerId AND a.AssignToCampaign = c.CampaignId AND c.DialStatus >= 1
					left JOIN t_gn_customer_pds c1 ON a.AssignSession = c1.AssignSession AND a.CustomerId = c1.CustomerId AND a.AssignToCampaign = c1.CampaignId AND c1.DialStatus = 0
					LEFT JOIN t_gn_campaign_pds d ON c.CampaignId = d.CampaignId
					LEFT JOIN t_gn_customer_pds_cancel e ON a.AssignSession = e.AssignSession AND a.CustomerId = e.CustomerId AND e.CampaignId = a.AssignToCampaign
					LEFT JOIN dialer_call_log f1 ON c.CustomerId = f1.CustomerId AND f1.SessionId = c.DialerSession AND f1.DialTime >= '$this->start_date' AND f1.DialTime <= '$this->end_date 23:00' AND f1.DialStatusText IN ('failed', 'uncontact', 'CONGESTION', 'NOANSWER')
					LEFT JOIN dialer_call_log f2 ON c.CustomerId = f2.CustomerId AND f2.SessionId = c.DialerSession AND f2.DialTime >= '$this->start_date' AND f2.DialTime <= '$this->end_date 23:00' AND f2.CallStatusText IN ('CONTACTED')
					LEFT JOIN dialer_call_log f3 ON c.CustomerId = f3.CustomerId AND f3.SessionId = c.DialerSession AND f3.DialTime >= '$this->start_date' AND f3.DialTime <= '$this->end_date 23:00' AND f3.CallStatusText IN ('ABANDONED')
					WHERE 1=1 ";
			
				if($this -> recsource!=""){
					$sqlbackup2.=" AND b.Recsource in ('".$this->recsource."') ";
				}
				
				$sqlbackup2 .= "GROUP BY b.Recsource,a.Id,c.CustomerPdsId,c.CampaignId,c.CustomerId,d.CallPreference,e.CustomerId,c1.DialStatus,f1.CustomerId, f2.CustomerId, f3.CustomerId";
				
			$sqlbackup = "SELECT b.Recsource, c.CustomerId, COUNT(distinct a.Id) AS TotalDataAss, COUNT(distinct a.CustomerId) AS Total, COUNT(DISTINCT c.CustomerId) AS TotalCall,
					CASE WHEN (select concat(
										cast(CASE WHEN ba.CustomerMobilePhoneNum<>'' THEN '1,' ELSE '' END AS VARCHAR),
										cast(CASE WHEN ba.CustomerHomePhoneNum<>'' THEN '2,' ELSE '' END AS VARCHAR),
										cast(CASE WHEN ba.CustomerWorkPhoneNum<>'' THEN '3' ELSE '' END AS VARCHAR)) AS Prefered
										FROM t_gn_customer_pds ba where c.CampaignId = ba.CampaignId AND ba.CustomerId = c.CustomerId AND ba.CustomerPdsId=max(c.CustomerPdsId))
										LIKE concat('%',d.CallPreference,'%') THEN 0 ELSE 1 END AS lightening,
					CASE WHEN e.CustomerId IS NOT NULL THEN 1 ELSE 0 END AS Cancel,
					CASE WHEN c.DialStatus = 0 THEN 1 ELSE 0 END AS Notyet,
					(SELECT COUNT(distinct CustomerId) FROM dialer_call_log WHERE DialTime = MAX(f.DialTime) AND CustomerId = f.CustomerId AND DialStatusText IN ('failed', 'uncontact', 'CONGESTION', 'NOANSWER')) AS Uncontacted,
					(SELECT COUNT(distinct CustomerId) FROM dialer_call_log WHERE DialTime = MAX(f.DialTime) AND CustomerId = f.CustomerId AND CallStatusText IN ('CONTACTED')) AS Success,
					(SELECT COUNT(distinct CustomerId) FROM dialer_call_log WHERE DialTime = MAX(f.DialTime) AND CustomerId = f.CustomerId AND CallStatusText IN ('ABANDONED')) AS Abandon
				FROM t_gn_customer_pds_asgmt_log a
				LEFT JOIN t_gn_customer b ON a.CustomerId = b.CustomerId
				LEFT JOIN t_gn_customer_pds c ON a.CustomerId = c.CustomerId AND c.DialStatus > 0
				LEFT JOIN t_gn_campaign_pds d ON a.AssignToCampaign = d.CampaignId
				LEFT JOIN t_gn_customer_pds_cancel e ON a.CustomerId = e.CustomerId AND a.AssignToCampaign = e.CampaignId AND c.CustomerId <> e.CustomerId
				LEFT JOIN dialer_call_log f ON a.CustomerId = f.CustomerId AND f.DialTime >= '$this->start_date' AND f.DialTime <= '$this->end_date 23:00'
				WHERE 1=1 ";
			
				if($this -> recsource!=""){
					$sqlbackup.=" AND b.Recsource in ('".$this->recsource."') ";
				}
				
				$sqlbackup .= "GROUP BY b.Recsource, c.CustomerId, c.DialStatus, c.CampaignId, d.CallPreference, e.CustomerId, f.CustomerId";
				
			$sql = "SELECT b.Recsource,c.CustomerId,COUNT(distinct a.Id) AS Total, COUNT(distinct c.CustomerPdsId) AS TotalCall,
					CASE WHEN (select concat(
										cast(CASE WHEN ba.CustomerMobilePhoneNum<>'' THEN '1,' ELSE '' END AS VARCHAR),
										cast(CASE WHEN ba.CustomerHomePhoneNum<>'' THEN '2,' ELSE '' END AS VARCHAR),
										cast(CASE WHEN ba.CustomerWorkPhoneNum<>'' THEN '3' ELSE '' END AS VARCHAR)) AS Prefered
										FROM t_gn_customer_pds ba where c.CampaignId = ba.CampaignId AND ba.CustomerId = c.CustomerId AND ba.CustomerPdsId=c.CustomerPdsId)
										LIKE concat('%',d.CallPreference,'%') THEN 0 ELSE 1 END AS lightening,
					CASE WHEN e.CustomerId IS NOT NULL THEN 1 ELSE 0 END AS Cancel,
					CASE WHEN c1.DialStatus = 0 THEN 1 ELSE 0 END AS Notyet,
					(SELECT COUNT(CustomerId) FROM dialer_call_log WHERE DialTime = MAX(f.DialTime) AND CustomerId = f.CustomerId AND DialStatusText IN ('failed', 'uncontact', 'CONGESTION', 'NOANSWER')) AS Uncontacted,
					(SELECT COUNT(distinct Id) FROM dialer_call_log WHERE DialTime = MAX(f.DialTime) AND CustomerId = f.CustomerId AND CallStatusText IN ('CONTACTED')) AS Success,
					(SELECT COUNT(distinct Id) FROM dialer_call_log WHERE DialTime = MAX(f.DialTime) AND CustomerId = f.CustomerId AND CallStatusText IN ('ABANDONED')) AS Abandon
				FROM t_gn_customer_pds_asgmt_log a
				left JOIN t_gn_customer b ON a.CustomerId = b.CustomerId
				left JOIN t_gn_customer_pds c ON a.AssignSession = c.AssignSession AND a.CustomerId = c.CustomerId AND a.AssignToCampaign = c.CampaignId AND c.DialStatus > 1
				left JOIN t_gn_customer_pds c1 ON a.AssignSession = c1.AssignSession AND a.CustomerId = c1.CustomerId AND a.AssignToCampaign = c1.CampaignId AND c1.DialStatus = 0
				LEFT JOIN t_gn_campaign_pds d ON c.CampaignId = d.CampaignId
				LEFT JOIN t_gn_customer_pds_cancel e ON a.AssignSession = e.AssignSession AND a.CustomerId = e.CustomerId AND e.CampaignId = a.AssignToCampaign
				LEFT JOIN dialer_call_log f ON c.CustomerId = f.CustomerId AND f.SessionId = c.DialerSession AND f.DialTime >= '$this->start_date' AND f.DialTime <= '$this->end_date 23:00'
				WHERE 1=1 ";
				
				if($this -> recsource!=""){
					$sql.=" AND b.Recsource in ('".$this->recsource."') ";
				}
				
				$sql .= "GROUP BY b.Recsource,a.Id,c.CustomerPdsId,c.CampaignId,c.CustomerId,d.CallPreference,e.CustomerId,c1.DialStatus,f.CustomerId, f.SessionId";
				
			// echo $sql;
			// echo $sqlbackup2;
			$qry = $this->db->query($sqlbackup2);
			foreach($qry->result_assoc() as $rows){
				$_data[$rows['Recsource']]['Recsource']		= $rows['Recsource'];
				$_data[$rows['Recsource']]['Total']			+= $rows['Total'];
				$_data[$rows['Recsource']]['TotalCall'] 	+= $rows['TotalCall'];
				$_data[$rows['Recsource']]['HasPhoneN']		+= ($rows['CustomerId']?$rows['lightening']:0);
				$_data[$rows['Recsource']]['Cancel']		+= ($rows['CustomerId']?0:$rows['Cancel']);
				$_data[$rows['Recsource']]['Uncontacted']	+= ($rows['CustomerId']?$rows['Uncontacted']:0);
				$_data[$rows['Recsource']]['Success']		+= ($rows['CustomerId']?$rows['Success']:0);
				$_data[$rows['Recsource']]['Notyet']		+= ($rows['CustomerId']?0:$rows['Notyet']);
				$_data[$rows['Recsource']]['Abandon']		+= ($rows['CustomerId']?$rows['Abandon']:0);
			}
			return $_data;
		}
		
		/* END */
		Public Function _get_type()
		{
			return array(
							1 => 'Group By TMR',
							2 => 'Group By SPV',
							3 => 'Group By Recsource',
							4 => 'Group By OnlyRecsource'
						);
		}
		
		Public Function _get_campaign()
		{
			$_data = array();
			$sql = "select a.CampaignId, a.CampaignName from t_gn_campaign a where a.CampaignStatusFlag = 1";
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows){
				$_data[$rows['CampaignId']] = $rows['CampaignName'];
			}
			return $_data;
		}
		
		Public Function _get_recsource($Campaign=0)
		{
			$_data = array();
			$sql = "select
						a.Recsource
					from t_gn_customer a
					where a.CampaignId in (".$Campaign.")
					group by a.Recsource";
					
			// $sql = "select a.FTP_Recsource as Recsource from t_gn_upload_report_ftp a
					// left join t_gn_customer b ON a.FTP_Recsource = b.Recsource
					// where b.expired_date >= Curdate() and b.CampaignId in (".$Campaign.")
					// group by a.FTP_Recsource";
					
			$qry = $this->db->query($sql);
			// echo $sql;
			foreach($qry->result_assoc() as $rows)
			{
				$_data[$rows['Recsource']] = $rows['Recsource'];
			}
			return $_data;
		}
		
		Public Function _get_spv()
		{
			$_data = array();
			$sql = "select
						a.UserId, a.full_name
					from tms_agent a
					where a.user_state = 1 and a.handling_type = 3";
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				$_data[$rows['UserId']] = $rows['full_name'];
			}
			return $_data;
		}
		
		Public Function _get_tmr($spvId)
		{
			$_data = array();
			$sql = "select
						a.UserId, a.full_name
					from tms_agent a
					where a.user_state = 1 and a.handling_type = 4
					and a.spv_id = '".$spvId."'";
			$qry = $this->db->query($sql);
			// $tmrid = explode(',',$this->TmrId);
			// echo $sql;
			foreach($qry->result_assoc() as $rows)
			{
				// if(array_search(0, $tmrid) != ""){
					// $_data[0] = '-';
				// }
				$_data[$rows['UserId']] = $rows['full_name'];
			}
			return $_data;
		}
		
		Public Function _get_mode()
		{
			return array(
							2 => 'Summary'
						);
		}
		
		Public Function _getLoop()
		{
			$_data = array();
			if($this->URI->_get_post('group_type') == 1){
					if($this->TmrId=="" OR $this->TmrId==NULL){
						$handling_type = 4;
						// $where =  " AND a.user_state = 1 and a.UserId IN (".$this->TmrId.")";
					}else{
						$handling_type = 4;
						$where =  " AND a.user_state = 1 and a.UserId IN (".$this->TmrId.")";
					}
				}else if($this->URI->_get_post('group_type') == 2){
					$handling_type = 3;
					$where =  " AND a.user_state = 1 and a.UserId IN (".$this->spvId.")";
				}else if($this->URI->_get_post('group_type') == 3){
					$handling_type = 4;
					// $where =  " and a.UserId IN (".$this->TmrId.")";
				}
			$sql = "select
						a.UserId, a.id, a.full_name
					from tms_agent a
					where a.handling_type = ".$handling_type."";
			$sql .= $where;
			$tmrid = explode(',',$this->TmrId);
			// if(array_search(0, $tmrid) !== false){
					// $_data[0]['fullname'] = '-';
					// $_data[0]['id'] = '-';
				// }
			// echo $sql;
			// print_r($tmrid);
			// echo array_search(0, $tmrid);
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				$_data[$rows['UserId']]['fullname'] = $rows['full_name'];
				$_data[$rows['UserId']]['id'] = $rows['id'];
			}
			// echo array_search(0, $tmrid);
			return $_data;
		}
		
		Public Function _getLooprecs($param=null)
		{
			if($param['Recsource']){
				$recsources = array();
				if($param!=null){
					$recs = explode(',',$param['Recsource']);
					$recsources = array();
					foreach($recs as $key=>$val){
						$recsources[$val] = $val;
					}
				}else{
					$recsources = NULL;
				}
			}else{
				$recsources = $this->_get_recsource($param['Campaign']);
			}
			return $recsources;
		}
		
		Public Function _getDL()
		{
			$_data = array();
			$sql = "select
						a.DisagreeId, a.CampaignId, a.DisagreeCode
					from t_lk_disagree a
					where a.CampaignId IN (".$this -> campaign.") order by a.DisagreeOrder asc";
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				// $_data[$rows['DisagreeCode']] = $rows['DisagreeCode'];
			}
			$i=0;
			for($i=0;$i<=19;$i++){
						$_data['DL'.$i] = 'DL'.$i;
			}
			return $_data;
		}
		
		Public Function _getRowData1()
		{
			$_data = array();
			if($this->URI->_get_post('group_type') == 2){
				$sql = "select
							b.AssignSelerId, a.Recsource, b.AssignSpv,
							count(distinct b.CustomerId) as datasize, f.CampaignName
						from t_gn_customer a
							inner join t_gn_assignment b on a.CustomerId = b.CustomerId
							inner join t_gn_campaign f ON a.CampaignId = f.CampaignId
						where  a.CampaignId in (".$this -> campaign.")";
			} elseif($this->URI->_get_post('group_type') == 4){
				$sql = "select
							b.AssignSelerId, a.Recsource, b.AssignSpv,
							count(distinct b.CustomerId) as datasize, f.CampaignName
						from t_gn_customer a
							left join t_gn_assignment b on a.CustomerId = b.CustomerId
							left join t_gn_campaign f ON a.CampaignId = f.CampaignId
						where  a.CampaignId in (".$this -> campaign.")";
			} else{
				$sql = "select
							b.AssignSelerId, a.Recsource, b.AssignSpv,
							count(distinct b.CustomerId) as datasize, f.CampaignName
						from t_gn_customer a
							inner join t_gn_assignment b on a.CustomerId = b.CustomerId
							inner join tms_agent c on b.AssignSelerId = c.UserId
							inner join tms_agent d on c.spv_id = d.UserId
							inner join t_gn_campaign f ON a.CampaignId = f.CampaignId
						where  a.CampaignId in (".$this -> campaign.")";
			}
				if($this -> recsource!=""){
					$sql.=" and a.Recsource in ('".$this->recsource."') ";
				}
				if($this->URI->_get_post('group_type') == 1){
					$sql .= " group by b.AssignSelerId, a.Recsource";
				}else if($this->URI->_get_post('group_type') == 2){
					$sql .= " group by AssignSpv, a.Recsource";
				}else if($this->URI->_get_post('group_type') == 3){
					$sql .= " group by a.Recsource, b.AssignSelerId";
				}else if($this->URI->_get_post('group_type') == 4){
					$sql .= " group by a.Recsource , a.CampaignId";
				}
			// echo $sql;
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				if($this->URI->_get_post('group_type') == 1){
					$_data[$rows['AssignSelerId']][$rows['Recsource']]['Recsource'] = $rows['Recsource'];
					$_data[$rows['AssignSelerId']][$rows['Recsource']]['datasize'] = $rows['datasize'];
					$_data[$rows['AssignSelerId']][$rows['Recsource']]['product'] = $rows['CampaignName'];
				}else if($this->URI->_get_post('group_type') == 2){
					$_data[$rows['AssignSpv']][$rows['Recsource']]['Recsource'] = $rows['Recsource'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['datasize'] = $rows['datasize'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['product'] = $rows['CampaignName'];
				}else if($this->URI->_get_post('group_type') == 3){
					$_data[$rows['Recsource']][$rows['AssignSelerId']]['SellerId'] = $rows['AssignSelerId'];
					$_data[$rows['Recsource']][$rows['AssignSelerId']]['datasize'] = $rows['datasize'];
					$_data[$rows['Recsource']][$rows['AssignSelerId']]['product'] = $rows['CampaignName'];
				}else if($this->URI->_get_post('group_type') == 4){
					$_data[$rows['Recsource']]['datasize'] = ($rows['datasize']?$rows['datasize']:0);
					$_data[$rows['Recsource']]['product'] = $rows['CampaignName'];
				}
			}
			return $_data;
		}
		
		Public Function _getRowData2()
		{
			$_data = array();
			$sql = "select
						a.CreatedById, b.Recsource, e.UserId,
						count(distinct a.CustomerId) as utilize, f.CampaignName
					from t_gn_callhistory a
						inner join t_gn_customer b on a.CustomerId = b.CustomerId
						inner join tms_agent c on a.CreatedById = c.UserId
						inner join tms_agent e on c.spv_id = e.UserId
						inner join t_lk_callreason d on a.CallReasonId = d.CallReasonId
						inner join t_gn_campaign f ON b.CampaignId = f.CampaignId
					where c.handling_type = 4 and b.CampaignId in (".$this -> campaign.")
					and date(a.CallHistoryCreatedTs) between '".$this->start_date."' and '".$this->end_date."'";
					if($this -> recsource!=""){
					$sql.=" and b.Recsource in ('".$this->recsource."') ";
				}
					if($this->URI->_get_post('group_type') == 1){
						$sql .= " group by a.CreatedById, b.Recsource";
					}else if($this->URI->_get_post('group_type') == 2){
						$sql .= " group by e.UserId, b.Recsource";
					}else if($this->URI->_get_post('group_type') == 3){
						$sql .= " group by b.Recsource, a.CreatedById";
					}else if($this->URI->_get_post('group_type') == 4){
						$sql .= " group by b.Recsource";
					}
			// echo "<pre>";
			// echo $sql;
			// echo "</pre>";
			$qry = $this->db->query($sql);
			
			foreach($qry->result_assoc() as $rows)
			{
				if($this->URI->_get_post('group_type') == 1){
					$_data[$rows['CreatedById']][$rows['Recsource']]['utilize'] = $rows['utilize'];
					// $_data[$rows['CreatedById']][$rows['Recsource']]['product'] = $rows['CampaignName'];
				}else if($this->URI->_get_post('group_type') == 2){
					$_data[$rows['UserId']][$rows['Recsource']]['utilize'] = $rows['utilize'];
					// $_data[$rows['UserId']][$rows['Recsource']]['product'] = $rows['CampaignName'];
				}else if($this->URI->_get_post('group_type') == 3){
					$_data[$rows['Recsource']][$rows['CreatedById']]['utilize'] = $rows['utilize'];
					// $_data[$rows['Recsource']][$rows['CreatedById']]['product'] = $rows['CampaignName'];
				}else if($this->URI->_get_post('group_type') == 4){
					$_data[$rows['Recsource']]['utilize'] = ($rows['utilize']?$rows['utilize']:0);
					// $_data[$rows['Recsource']]['product'] = $rows['CampaignName'];
				}
			}
			return $_data;
		}
		
		
						/*sum(if(b.DisagreeId in (69),1,0)) as DL0,
						sum(if(b.DisagreeId in (70),1,0)) as DL1,
						sum(if(b.DisagreeId in (71),1,0)) as DL2,
						sum(if(b.DisagreeId in (72),1,0)) as DL3,
						sum(if(b.DisagreeId in (73),1,0)) as DL4,
						sum(if(b.DisagreeId in (74),1,0)) as DL5,
						sum(if(b.DisagreeId in (75),1,0)) as DL6,
						sum(if(b.DisagreeId in (76),1,0)) as DL7,
						sum(if(b.DisagreeId in (77),1,0)) as DL8,
						sum(if(b.DisagreeId in (78),1,0)) as DL9,
						sum(if(b.DisagreeId in (79),1,0)) as DL10,
						sum(if(b.DisagreeId in (80),1,0)) as DL11,
						sum(if(b.DisagreeId in (81),1,0)) as DL14*/
		
		Public Function _getRowData3()
		{
			$_data = array();
			$sql = "select
						z.AssignSelerId as SellerId, b.Recsource, z.AssignSpv,
						sum(if(b.CallReasonId not in (1),1,0)) as new_util,
						sum(if(b.CallReasonId in (8,14),1,0)) as D,
						sum(if(b.CallReasonId in (10),1,0)) as ST,
						sum(if(b.CallReasonId in (11),1,0)) as CB,
						#sum(if(b.CallReasonId in (13),1,0)) as INC,
			sum(if(b.CallReasonId in (13) and (xsel.vartiering = 100 OR flexi.vartiering = 100) and b.CallReasonQue = 99 ,1,0)) as INC,
			sum(if(b.CampaignId = 7 and b.CallReasonId in (13) and b.CallReasonQue = 1,1,0)) as HOSINC,
			sum(if(b.CampaignId = 5 and xsel.vartiering < 100 and b.CallReasonId in (13) and b.CallReasonQue = 1,1,0)) as XSINC,
			sum(if(b.CampaignId = 6 and b.CallReasonId in (13) and b.CallReasonQue = 1,1,0)) as TPINC,
			sum(if(b.CampaignId = 9 and flexi.vartiering < 100 and b.CallReasonId in (13) and b.CallReasonQue = 1,1,0)) as FLINC,
						0 as INC_UNVER,
						0 as INC_NOTPASS,
						sum(if(b.CallReasonId in (9),1,0)) as B,
						sum(if(b.CallReasonId in (12),1,0)) as TBO,

						sum(if(b.CallReasonId in (6),1,0)) as NP,
						sum(if(b.CallReasonId in (5),1,0)) as BT,
						sum(if(b.CallReasonId in (2),1,0)) as NA,
						sum(if(b.CallReasonId in (3),1,0)) as MV,
						sum(if(b.CallReasonId in (7),1,0)) as WN,
						sum(if(b.CallReasonId in (4),1,0)) as ID,
						
						sum(if(b.DisagreeId in (45,69,56,102),1,0)) as DL0,
						sum(if(b.DisagreeId in (46,70,57,103),1,0)) as DL1,
						sum(if(b.DisagreeId in (47,71,58,104),1,0)) as DL2,
						sum(if(b.DisagreeId in (48,72,59,105),1,0)) as DL3,
						sum(if(b.DisagreeId in (49,73,60,106),1,0)) as DL4,
						sum(if(b.DisagreeId in (49,74,60,107),1,0)) as DL5,
						sum(if(b.DisagreeId in (50,75,61,108),1,0)) as DL6,
						sum(if(b.DisagreeId in (51,76,62,109),1,0)) as DL7,
						sum(if(b.DisagreeId in (52,77,63,110),1,0)) as DL8,
						sum(if(b.DisagreeId in (53,78,64,111),1,0)) as DL9,
						sum(if(b.DisagreeId in (54,79,65,112),1,0)) as DL10,
						sum(if(b.DisagreeId in (80,66),1,0)) as DL11,
						sum(if(b.DisagreeId in (100,67),1,0)) as DL12,
						sum(if(b.DisagreeId in (55,81,68),1,0)) as DL14

						
						from t_gn_customer b
						#t_gn_callhistory a
						left join t_gn_frm_flexi flexi on b.CustomerId = flexi.CustomerId
						left join t_gn_frm_pil_xsel xsel on b.CustomerId = xsel.CustomerId
						inner join t_gn_assignment z on b.CustomerId = z.CustomerId
						inner join tms_agent c on z.AssignSelerId = c.UserId
						inner join tms_agent e on c.spv_id = e.UserId
						#inner join t_lk_callreason d on a.CallReasonId = d.CallReasonId
					WHERE c.handling_type = 4 AND
					#IF(b.CampaignId = 6 , b.CallReasonQue = 1, (IF(b.CampaignId = 7, b.CallReasonQue = 1, b.CallReasonQue = 99))) AND
					b.CampaignId in (".$this -> campaign.") AND
					b.CustomerUpdatedTs >= '".$this->start_date." 00:00:00'
					AND b.CustomerUpdatedTs <= '".$this->end_date." 23:00:00'";
					if($this -> recsource!=""){
					$sql.=" and b.Recsource in ('".$this->recsource."') ";
				}
					if($this->URI->_get_post('group_type') == 1){
						$sql .= " GROUP BY z.AssignSelerId, b.Recsource#, b.CallReasonId";
					}else if($this->URI->_get_post('group_type') == 2){
						$sql .= " GROUP BY z.AssignSpv, b.Recsource#, b.CallReasonId";
					}else if($this->URI->_get_post('group_type') == 3){
						$sql .= " GROUP BY z.AssignSelerId, b.Recsource#, b.CallReasonId";
					}else if($this->URI->_get_post('group_type') == 4){
						$sql .= " GROUP BY b.Recsource";
					}
						
					// where c.handling_type = 4 and b.CampaignId = '".$this -> campaign."'
					// and date(a.CallHistoryCreatedTs) between '".$this->start_date."' and '".$this->end_date."'
					// group by a.CreatedById, b.Recsource, d.CallReasonId";
			$qry = $this->db->query($sql);
			// echo "<pre>".$sql."</pre>";
			// echo $this->recsource;
			foreach($qry->result_assoc() as $rows)
			{
				if($this->URI->_get_post('group_type') == 1){
					$inc = $rows['HOSINC']+$rows['XSINC']+$rows['TPINC']+$rows['FLINC']+$rows['INC'];
					$_data[$rows['SellerId']][$rows['Recsource']]['new_util'] += (INT)$rows['new_util'];
					$_data[$rows['SellerId']][$rows['Recsource']]['D'] += (INT)$rows['D'];
					$_data[$rows['SellerId']][$rows['Recsource']]['ST'] += (INT)$rows['ST'];
					$_data[$rows['SellerId']][$rows['Recsource']]['CB'] += (INT)$rows['CB'];
					$_data[$rows['SellerId']][$rows['Recsource']]['SA'] += (INT)$rows['SA'];
					$_data[$rows['SellerId']][$rows['Recsource']]['TBO'] += (INT)$rows['TBO'];
					$_data[$rows['SellerId']][$rows['Recsource']]['PU'] += (INT)$rows['PU'];
					$_data[$rows['SellerId']][$rows['Recsource']]['GPU'] += (INT)$rows['GPU'];
					$_data[$rows['SellerId']][$rows['Recsource']]['CPGP'] += (INT)$rows['CPGP'];
					$_data[$rows['SellerId']][$rows['Recsource']]['INC'] += (INT)$inc;
					$_data[$rows['SellerId']][$rows['Recsource']]['INC_UNVER'] += (INT)$rows['INC_UNVER'];
					$_data[$rows['SellerId']][$rows['Recsource']]['INC_NOTPASS'] += (INT)$rows['INC_NOTPASS'];
					$_data[$rows['SellerId']][$rows['Recsource']]['R'] += (INT)$rows['R'];
					$_data[$rows['SellerId']][$rows['Recsource']]['B'] += (INT)$rows['B'];
					$_data[$rows['SellerId']][$rows['Recsource']]['NP'] += (INT)$rows['NP'];
					$_data[$rows['SellerId']][$rows['Recsource']]['BT'] += (INT)$rows['BT'];
					$_data[$rows['SellerId']][$rows['Recsource']]['NA'] += (INT)$rows['NA'];
					$_data[$rows['SellerId']][$rows['Recsource']]['MV'] += (INT)$rows['MV'];
					$_data[$rows['SellerId']][$rows['Recsource']]['WN'] += (INT)$rows['WN'];
					$_data[$rows['SellerId']][$rows['Recsource']]['ID'] += (INT)$rows['ID'];
					$_data[$rows['SellerId']][$rows['Recsource']]['AddOn'] += (INT)$rows['AddOn'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL0'] += (INT)$rows['DL0'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL1'] += (INT)$rows['DL1'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL2'] += (INT)$rows['DL2'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL3'] += (INT)$rows['DL3'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL4'] += (INT)$rows['DL4'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL5'] += (INT)$rows['DL5'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL6'] += (INT)$rows['DL6'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL7'] += (INT)$rows['DL7'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL8'] += (INT)$rows['DL8'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL9'] += (INT)$rows['DL9'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL10'] += (INT)$rows['DL10'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL11'] += (INT)$rows['DL11'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL12'] += (INT)$rows['DL12'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL13'] += (INT)$rows['DL13'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL14'] += (INT)$rows['DL14'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL15'] += (INT)$rows['DL15'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL16'] += (INT)$rows['DL16'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL17'] += (INT)$rows['DL17'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL18'] += (INT)$rows['DL18'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL19'] += (INT)$rows['DL19'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL20'] += (INT)$rows['DL20'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL21'] += (INT)$rows['DL21'];
					$_data[$rows['SellerId']][$rows['Recsource']]['Dll'] += (INT)$rows['Dll'];
					$_data[$rows['SellerId']][$rows['Recsource']]['LoadAmount'] += (INT)$rows['LoadAmount'];
					$_data[$rows['SellerId']][$rows['Recsource']]['POD'] += (INT)$rows['POD'];
				}
				else if($this->URI->_get_post('group_type') == 2){
					$inc = $rows['HOSINC']+$rows['XSINC']+$rows['TPINC']+$rows['FLINC']+$rows['INC'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['new_util'] += (INT)$rows['new_util'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['D'] += (INT)$rows['D'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['ST'] += (INT)$rows['ST'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['CB'] += (INT)$rows['CB'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['SA'] += (INT)$rows['SA'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['TBO'] += (INT)$rows['TBO'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['PU'] += (INT)$rows['PU'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['GPU'] += (INT)$rows['GPU'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['CPGP'] += (INT)$rows['CPGP'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['INC'] += (INT)$inc;
					$_data[$rows['AssignSpv']][$rows['Recsource']]['INC_UNVER'] += (INT)$rows['INC_UNVER'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['INC_NOTPASS'] += (INT)$rows['INC_NOTPASS'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['R'] += (INT)$rows['R'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['B'] += (INT)$rows['B'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['NP'] += (INT)$rows['NP'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['BT'] += (INT)$rows['BT'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['NA'] += (INT)$rows['NA'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['MV'] += (INT)$rows['MV'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['WN'] += (INT)$rows['WN'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['ID'] += (INT)$rows['ID'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['AddOn'] += (INT)$rows['AddOn'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL0'] += (INT)$rows['DL0'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL1'] += (INT)$rows['DL1'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL2'] += (INT)$rows['DL2'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL3'] += (INT)$rows['DL3'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL4'] += (INT)$rows['DL4'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL5'] += (INT)$rows['DL5'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL6'] += (INT)$rows['DL6'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL7'] += (INT)$rows['DL7'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL8'] += (INT)$rows['DL8'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL9'] += (INT)$rows['DL9'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL10'] += (INT)$rows['DL10'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL11'] += (INT)$rows['DL11'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL12'] += (INT)$rows['DL12'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL13'] += (INT)$rows['DL13'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL14'] += (INT)$rows['DL14'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL15'] += (INT)$rows['DL15'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL16'] += (INT)$rows['DL16'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL17'] += (INT)$rows['DL17'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL18'] += (INT)$rows['DL18'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL19'] += (INT)$rows['DL19'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL20'] += (INT)$rows['DL20'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL21'] += (INT)$rows['DL21'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['Dll'] += (INT)$rows['Dll'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['LoadAmount'] += (INT)$rows['LoadAmount'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['POD'] += (INT)$rows['POD'];
				}
				else if($this->URI->_get_post('group_type') == 3){
					$inc = $rows['HOSINC']+$rows['XSINC']+$rows['TPINC']+$rows['FLINC']+$rows['INC'];
					$_data[$rows['Recsource']][$rows['SellerId']]['new_util'] += (INT)$rows['new_util'];
					$_data[$rows['Recsource']][$rows['SellerId']]['D'] += (INT)$rows['D'];
					$_data[$rows['Recsource']][$rows['SellerId']]['ST'] += (INT)$rows['ST'];
					$_data[$rows['Recsource']][$rows['SellerId']]['CB'] += (INT)$rows['CB'];
					$_data[$rows['Recsource']][$rows['SellerId']]['SA'] += (INT)$rows['SA'];
					$_data[$rows['Recsource']][$rows['SellerId']]['TBO'] += (INT)$rows['TBO'];
					$_data[$rows['Recsource']][$rows['SellerId']]['PU'] += (INT)$rows['PU'];
					$_data[$rows['Recsource']][$rows['SellerId']]['GPU'] += (INT)$rows['GPU'];
					$_data[$rows['Recsource']][$rows['SellerId']]['CPGP'] += (INT)$rows['CPGP'];
					$_data[$rows['Recsource']][$rows['SellerId']]['INC'] += (INT)$inc;
					$_data[$rows['Recsource']][$rows['SellerId']]['INC_UNVER'] += (INT)$rows['INC_UNVER'];
					$_data[$rows['Recsource']][$rows['SellerId']]['INC_NOTPASS'] += (INT)$rows['INC_NOTPASS'];
					$_data[$rows['Recsource']][$rows['SellerId']]['R'] += (INT)$rows['R'];
					$_data[$rows['Recsource']][$rows['SellerId']]['B'] += (INT)$rows['B'];
					$_data[$rows['Recsource']][$rows['SellerId']]['NP'] += (INT)$rows['NP'];
					$_data[$rows['Recsource']][$rows['SellerId']]['BT'] += (INT)$rows['BT'];
					$_data[$rows['Recsource']][$rows['SellerId']]['NA'] += (INT)$rows['NA'];
					$_data[$rows['Recsource']][$rows['SellerId']]['MV'] += (INT)$rows['MV'];
					$_data[$rows['Recsource']][$rows['SellerId']]['WN'] += (INT)$rows['WN'];
					$_data[$rows['Recsource']][$rows['SellerId']]['ID'] += (INT)$rows['ID'];
					$_data[$rows['Recsource']][$rows['SellerId']]['AddOn'] += (INT)$rows['AddOn'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL0'] += (INT)$rows['DL0'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL1'] += (INT)$rows['DL1'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL2'] += (INT)$rows['DL2'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL3'] += (INT)$rows['DL3'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL4'] += (INT)$rows['DL4'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL5'] += (INT)$rows['DL5'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL6'] += (INT)$rows['DL6'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL7'] += (INT)$rows['DL7'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL8'] += (INT)$rows['DL8'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL9'] += (INT)$rows['DL9'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL10'] += (INT)$rows['DL10'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL11'] += (INT)$rows['DL11'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL12'] += (INT)$rows['DL12'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL13'] += (INT)$rows['DL13'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL14'] += (INT)$rows['DL14'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL15'] += (INT)$rows['DL15'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL16'] += (INT)$rows['DL16'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL17'] += (INT)$rows['DL17'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL18'] += (INT)$rows['DL18'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL19'] += (INT)$rows['DL19'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL20'] += (INT)$rows['DL20'];
					$_data[$rows['Recsource']][$rows['SellerId']]['DL21'] += (INT)$rows['DL21'];
					$_data[$rows['Recsource']][$rows['SellerId']]['Dll'] += (INT)$rows['Dll'];
					$_data[$rows['Recsource']][$rows['SellerId']]['LoadAmount'] += (INT)$rows['LoadAmount'];
					$_data[$rows['Recsource']][$rows['SellerId']]['POD'] += (INT)$rows['POD'];
				}
				else if($this->URI->_get_post('group_type') == 4){
					$inc = $rows['HOSINC']+$rows['XSINC']+$rows['TPINC']+$rows['FLINC']+$rows['INC'];
					$_data[$rows['Recsource']]['new_util'] += (INT)$rows['new_util'];
					$_data[$rows['Recsource']]['D'] += (INT)$rows['D'];
					$_data[$rows['Recsource']]['ST'] += (INT)$rows['ST'];
					$_data[$rows['Recsource']]['CB'] += (INT)$rows['CB'];
					$_data[$rows['Recsource']]['SA'] += (INT)$rows['SA'];
					$_data[$rows['Recsource']]['TBO'] += (INT)$rows['TBO'];
					$_data[$rows['Recsource']]['PU'] += (INT)$rows['PU'];
					$_data[$rows['Recsource']]['GPU'] += (INT)$rows['GPU'];
					$_data[$rows['Recsource']]['CPGP'] += (INT)$rows['CPGP'];
					$_data[$rows['Recsource']]['INC'] += (INT)$inc;
					$_data[$rows['Recsource']]['INC_UNVER'] += (INT)$rows['INC_UNVER'];
					$_data[$rows['Recsource']]['INC_NOTPASS'] += (INT)$rows['INC_NOTPASS'];
					$_data[$rows['Recsource']]['R'] += (INT)$rows['R'];
					$_data[$rows['Recsource']]['B'] += (INT)$rows['B'];
					$_data[$rows['Recsource']]['NP'] += (INT)$rows['NP'];
					$_data[$rows['Recsource']]['BT'] += (INT)$rows['BT'];
					$_data[$rows['Recsource']]['NA'] += (INT)$rows['NA'];
					$_data[$rows['Recsource']]['MV'] += (INT)$rows['MV'];
					$_data[$rows['Recsource']]['WN'] += (INT)$rows['WN'];
					$_data[$rows['Recsource']]['ID'] += (INT)$rows['ID'];
					$_data[$rows['Recsource']]['AddOn'] += (INT)$rows['AddOn'];
					$_data[$rows['Recsource']]['DL0'] += (INT)$rows['DL0'];
					$_data[$rows['Recsource']]['DL1'] += (INT)$rows['DL1'];
					$_data[$rows['Recsource']]['DL2'] += (INT)$rows['DL2'];
					$_data[$rows['Recsource']]['DL3'] += (INT)$rows['DL3'];
					$_data[$rows['Recsource']]['DL4'] += (INT)$rows['DL4'];
					$_data[$rows['Recsource']]['DL5'] += (INT)$rows['DL5'];
					$_data[$rows['Recsource']]['DL6'] += (INT)$rows['DL6'];
					$_data[$rows['Recsource']]['DL7'] += (INT)$rows['DL7'];
					$_data[$rows['Recsource']]['DL8'] += (INT)$rows['DL8'];
					$_data[$rows['Recsource']]['DL9'] += (INT)$rows['DL9'];
					$_data[$rows['Recsource']]['DL10'] += (INT)$rows['DL10'];
					$_data[$rows['Recsource']]['DL11'] += (INT)$rows['DL11'];
					$_data[$rows['Recsource']]['DL12'] += (INT)$rows['DL12'];
					$_data[$rows['Recsource']]['DL13'] += (INT)$rows['DL13'];
					$_data[$rows['Recsource']]['DL14'] += (INT)$rows['DL14'];
					$_data[$rows['Recsource']]['DL15'] += (INT)$rows['DL15'];
					$_data[$rows['Recsource']]['DL16'] += (INT)$rows['DL16'];
					$_data[$rows['Recsource']]['DL17'] += (INT)$rows['DL17'];
					$_data[$rows['Recsource']]['DL18'] += (INT)$rows['DL18'];
					$_data[$rows['Recsource']]['DL19'] += (INT)$rows['DL19'];
					$_data[$rows['Recsource']]['DL20'] += (INT)$rows['DL20'];
					$_data[$rows['Recsource']]['DL21'] += (INT)$rows['DL21'];
					$_data[$rows['Recsource']]['Dll'] += (INT)$rows['Dll'];
					$_data[$rows['Recsource']]['LoadAmount'] += (INT)$rows['LoadAmount'];
					$_data[$rows['Recsource']]['POD'] += (INT)$rows['POD'];
				}
			}
			return $_data;
		}
		
		Public function _getRowData4()
		{
			$_data = array();
			
			/* $sql = "select
						a.CreatedById as SellerId, e.UserId,
						b.Recsource,
						sum(if(a.CallReasonId in (8,10,3,7,9,11,13,14),1,0)) as tot_connect,
						sum(if(a.CallReasonId in (2,4,5,6),1,0)) as tot_notconnect
					from t_gn_callhistory a
					left join t_gn_customer b on a.CustomerId = b.CustomerId
					inner join tms_agent c on a.CreatedById = c.UserId
					inner join tms_agent e on c.profile_id = e.UserId
					where a.HistoryType = 0
					and a.CallHistoryCreatedTs >= '".$this -> start_date." 00:00:00'
					and a.CallHistoryCreatedTs <= '".$this -> end_date." 23:59:59'
					and b.CampaignId = '".$this -> campaign."'"; */



			$sql = "SELECT c.UserId AS SellerId, e.UserId spvid, d.Recsource,
				COUNT(if(a.`status`=3003, a.id,null)) AS tot_connect,
				COUNT(if(a.`status` in (3004, 3005),a.id,null)) AS tot_notconnect
				from cc_call_session a
				inner join t_gn_customer d on d.CustomerId=a.assign_data
				INNER JOIN cc_agent b ON a.agent_id = b.id
				INNER JOIN tms_agent c ON c.id=b.userid
				INNER JOIN tms_agent e ON c.spv_id=e.userid
				where a.start_time > '".$this -> start_date." 00:00:00'
				AND a.start_time < '".$this -> end_date." 23:59:59'
				AND d.CampaignId in (".$this -> campaign.")";
						if($this -> recsource!=""){
					$sql.=" and d.Recsource in ('".$this->recsource."') ";
				}
						// AND d.Recsource IN (
					if($this->URI->_get_post('group_type') == 1){
						$sql .= " group by c.UserId, d.Recsource";
					}else if($this->URI->_get_post('group_type') == 2){
						$sql .= " group by spvid, d.Recsource";
					}else if($this->URI->_get_post('group_type') == 3){
						$sql .= " group by d.Recsource, c.UserId";
					}else if($this->URI->_get_post('group_type') == 4){
						$sql .= " group by d.Recsource";
					}
				// echo $sql;
			$qry = $this->db->query($sql);
			
			if($qry->num_rows()>0)
			{
				foreach($qry->result_assoc() as $rows)
				{
					if($this->URI->_get_post('group_type') == 1){
						$_data[$rows['SellerId']][$rows['Recsource']]['tot_connect'] += (INT)$rows['tot_connect'];
						$_data[$rows['SellerId']][$rows['Recsource']]['tot_notconnect'] += (INT)$rows['tot_notconnect'];
					}else if($this->URI->_get_post('group_type') == 2){
						$_data[$rows['spvid']][$rows['Recsource']]['tot_connect'] += (INT)$rows['tot_connect'];
						$_data[$rows['spvid']][$rows['Recsource']]['tot_notconnect'] += (INT)$rows['tot_notconnect'];
					}else if($this->URI->_get_post('group_type') == 3){
						$_data[$rows['Recsource']][$rows['SellerId']]['tot_connect'] += (INT)$rows['tot_connect'];
						$_data[$rows['Recsource']][$rows['SellerId']]['tot_notconnect'] += (INT)$rows['tot_notconnect'];
					}else if($this->URI->_get_post('group_type') == 4){
						$_data[$rows['Recsource']]['tot_connect'] += (INT)$rows['tot_connect'];
						$_data[$rows['Recsource']]['tot_notconnect'] += (INT)$rows['tot_notconnect'];
					}
				}
			}
			// print_r($_data);
			return $_data;
		}
		
		Public Function _get_amount_percampaign($Campaign=0){
			$_data = array();
			switch ($Campaign) {
				case 7:
					$_data = $this->_get_amount_hospin($Campaign);
					return $_data;
					break;
				default:
					$_data = $this->_get_amount_hospin($Campaign);
					return $_data;
					// echo "Invalid Campaign";
			}
		}
		
		Public Function _get_amount_hospin($Campaign = 0){
			$_data = array();
			/*$sql = "select e.create_by as SellerId, b.Recsource, e.monthly_premium, sum(e.monthly_premium) Amount, f.UserId
			from t_gn_customer b
			inner join t_gn_frm_hospin e on b.CustomerId = e.CustomerId
			inner join tms_agent c on b.SellerId = c.UserId
			inner join tms_agent f on c.spv_id = f.UserId
			inner join t_lk_callreason d on b.CallReasonId = d.CallReasonId
			where c.handling_type = 4 and 
			b.CampaignId in (".$this -> campaign.") AND
			b.CustomerUpdatedTs >= '".$this->start_date." 00:00:00' AND
			b.CustomerUpdatedTs <= '".$this->end_date." 23:00:00'
			group by b.SellerId, b.Recsource";*/
			// sum(if(b.CallReasonId in (13) and (xsel.vartiering = 100 OR flexi.vartiering = 100) and b.CallReasonQue = 99 ,1,0)) as INC,
			// sum(if(b.CampaignId = 7 and b.CallReasonId in (13) and b.CallReasonQue = 1,1,0)) as HOSINC,
			// sum(if(b.CampaignId = 5 and xsel.vartiering < 100 and b.CallReasonId in (13) and b.CallReasonQue = 1,1,0)) as XSINC,
			// sum(if(b.CampaignId = 6 and b.CallReasonId in (13) and b.CallReasonQue = 1,1,0)) as TPINC,
			// sum(if(b.CampaignId = 9 and flexi.vartiering < 100 and b.CallReasonId in (13) and b.CallReasonQue = 1,1,0)) as FLINC,
			
			$sql = "SELECT b.SellerId AS SellerId, b.Recsource,
			e.monthly_premium, SUM(e.monthly_premium) amount,
			sum(if(b.CallReasonId in (13) and xsel.vartiering = 100 and b.CallReasonQue = 99 ,xsel.loan,0)) as INC1,
			sum(if(b.CallReasonId in (13) and flex.vartiering = 100 and b.CallReasonQue = 99 ,flex.loan,0)) as INC2,
			sum(if(b.CampaignId = 7 and b.CallReasonId in (13) and b.CallReasonQue = 1,e.monthly_premium,0)) as HOSINC,
			sum(if(b.CampaignId = 5 and xsel.vartiering < 100 and b.CallReasonId in (13) and b.CallReasonQue = 1,xsel.Loan,0)) as XSINC,
			sum(if(b.CampaignId = 6 and b.CallReasonId in (13) and b.CallReasonQue = 1,topu.Loan,0)) as TPINC,
			sum(if(b.CampaignId = 9 and flex.vartiering < 100 and b.CallReasonId in (13) and b.CallReasonQue = 1,flex.Loan,0)) as FLINC,
			f.UserId
			FROM t_gn_customer b
			left JOIN t_gn_frm_hospin e ON b.CustomerId = e.CustomerId
			left JOIN t_gn_frm_flexi flex ON b.CustomerId = flex.CustomerId
			left JOIN t_gn_frm_pil_topup topu ON b.CustomerId = topu.CustomerId
			left JOIN t_gn_frm_pil_xsel xsel ON b.CustomerId = xsel.CustomerId
			INNER JOIN tms_agent c ON b.SellerId = c.UserId
			INNER JOIN tms_agent f ON c.spv_id = f.UserId
			INNER JOIN t_lk_callreason d ON b.CallReasonId = d.CallReasonId
			WHERE c.handling_type = 4 AND
			b.CampaignId IN (".$this -> campaign.") AND
			b.CustomerUpdatedTs >= '".$this->start_date." 00:00:00' AND b.CustomerUpdatedTs <= '".$this->end_date." 23:00:00'";
			
			if($this -> recsource!=""){
				$sql.=" and b.Recsource in ('".$this->recsource."') ";
			}
			
			if($this->URI->_get_post('group_type') == 2){
					$sql .=" GROUP BY f.UserId, b.Recsource";
			}else if($this->URI->_get_post('group_type') == 1){
					$sql .=" GROUP BY b.SellerId, b.Recsource";
			}else if($this->URI->_get_post('group_type') == 3){
					$sql .=" GROUP BY b.Recsource, b.SellerId";
			}else if($this->URI->_get_post('group_type') == 4){
					$sql .=" GROUP BY b.Recsource";
			}
			
			$qry = $this->db->query($sql);
			// echo $sql;
			foreach($qry->result_assoc() as $rows){
				if($this->URI->_get_post('group_type') == 3){
					$_data[$rows['Recsource']][$rows['SellerId']]['Amount'] += $rows['INC1'];
					$_data[$rows['Recsource']][$rows['SellerId']]['Amount'] += $rows['INC2'];
					$_data[$rows['Recsource']][$rows['SellerId']]['Amount'] += $rows['HOSINC'];
					$_data[$rows['Recsource']][$rows['SellerId']]['Amount'] += $rows['XSINC'];
					$_data[$rows['Recsource']][$rows['SellerId']]['Amount'] += $rows['TPINC'];
					$_data[$rows['Recsource']][$rows['SellerId']]['Amount'] += $rows['FLINC'];
				}else if($this->URI->_get_post('group_type') == 1){
					$_data[$rows['SellerId']][$rows['Recsource']]['Amount'] += $rows['INC1'];
					$_data[$rows['SellerId']][$rows['Recsource']]['Amount'] += $rows['INC2'];
					$_data[$rows['SellerId']][$rows['Recsource']]['Amount'] += $rows['HOSINC'];
					$_data[$rows['SellerId']][$rows['Recsource']]['Amount'] += $rows['XSINC'];
					$_data[$rows['SellerId']][$rows['Recsource']]['Amount'] += $rows['TPINC'];
					$_data[$rows['SellerId']][$rows['Recsource']]['Amount'] += $rows['FLINC'];
				}else if($this->URI->_get_post('group_type') == 2){
					$_data[$rows['UserId']][$rows['Recsource']]['Amount'] += $rows['INC1'];
					$_data[$rows['UserId']][$rows['Recsource']]['Amount'] += $rows['INC2'];
					$_data[$rows['UserId']][$rows['Recsource']]['Amount'] += $rows['HOSINC'];
					$_data[$rows['UserId']][$rows['Recsource']]['Amount'] += $rows['XSINC'];
					$_data[$rows['UserId']][$rows['Recsource']]['Amount'] += $rows['TPINC'];
					$_data[$rows['UserId']][$rows['Recsource']]['Amount'] += $rows['FLINC'];
				}else if($this->URI->_get_post('group_type') == 4){
					$_data[$rows['Recsource']]['Amount'] += $rows['INC1'];
					$_data[$rows['Recsource']]['Amount'] += $rows['INC2'];
					$_data[$rows['Recsource']]['Amount'] += $rows['HOSINC'];
					$_data[$rows['Recsource']]['Amount'] += $rows['XSINC'];
					$_data[$rows['Recsource']]['Amount'] += $rows['TPINC'];
					$_data[$rows['Recsource']]['Amount'] += $rows['FLINC'];
				}
			}
			// print_r($_data);
			return $_data;
		}
	
		Public Function _getRowDataNull1()
		{
			$_data = array();
			$sql = "select if(b.AssignSelerId is null,0,'-') as AssignSelerId, a.Recsource, count(distinct b.CustomerId) as datasize
					from t_gn_customer a
					inner join t_gn_assignment b on a.CustomerId = b.CustomerId
					where b.AssignSelerId is null and a.CampaignId in (".$this -> campaign.")
					group by a.Recsource;";
			
			// echo $sql;
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				if($this->URI->_get_post('group_type') == 1){
					$_data[$rows['AssignSelerId']][$rows['Recsource']]['Recsource'] = $rows['Recsource'];
					$_data[$rows['AssignSelerId']][$rows['Recsource']]['datasize'] = $rows['datasize'];
				}else if($this->URI->_get_post('group_type') == 2){
					$_data[$rows['AssignSpv']][$rows['Recsource']]['Recsource'] = $rows['Recsource'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['datasize'] = $rows['datasize'];
				}
			}
			return $_data;
		}
		
		Public Function _getRowDataNull2()
		{
			$_data = array();
			$sql2 = "select if(c.AssignSelerId is null,0,'-') as AssignSellerId, b.Recsource, count(distinct a.CustomerId) as utilize
					from t_gn_callhistory a
						inner join t_gn_customer b on a.CustomerId = b.CustomerId
						inner join t_gn_assignment c on b.CustomerId = c.CustomerId
						inner join t_lk_callreason d on a.CallReasonId = d.CallReasonId
					where c.AssignSelerId is NULL and b.CampaignId in (".$this -> campaign.")
					and date(a.CallHistoryCreatedTs) between '".$this->start_date."' and '".$this->end_date."' 
					group by b.Recsource";
			
			// echo $sql;
			$qry2 = $this->db->query($sql2);
			
			foreach($qry2->result_assoc() as $rows)
			{
				if($this->URI->_get_post('group_type') == 1){
					$_data[$rows['AssignSellerId']][$rows['Recsource']]['utilize'] = $rows['utilize'];
				}else if($this->URI->_get_post('group_type') == 2){
					$_data[$rows['AssignSellerId']][$rows['Recsource']]['utilize'] = $rows['utilize'];
				}
			}
			return $_data;
		}
		
		Public Function _getRowDataNull3()
		{
			$_data = array();		
			$sql3 = "select
						if(z.AssignSelerId is null,0,'-') as SellerId, b.Recsource, z.AssignSpv,
						sum(if(b.CallReasonId not in (1),1,0)) as new_util,
						sum(if(b.CallReasonId in (8,14),1,0)) as D,
						sum(if(b.CallReasonId in (10),1,0)) as ST,
						sum(if(b.CallReasonId in (11),1,0)) as CB,
						sum(if(b.CallReasonId in (13),1,0)) as INC,
						sum(if(b.CallReasonId in (9),1,0)) as B,

						sum(if(b.CallReasonId in (6),1,0)) as NP,
						sum(if(b.CallReasonId in (5),1,0)) as BT,
						sum(if(b.CallReasonId in (2),1,0)) as NA,
						sum(if(b.CallReasonId in (3),1,0)) as MV,
						sum(if(b.CallReasonId in (7),1,0)) as WN,
						sum(if(b.CallReasonId in (4),1,0)) as ID,

						sum(if(b.DisagreeId in (69),1,0)) as DL0,
						sum(if(b.DisagreeId in (70),1,0)) as DL1,
						sum(if(b.DisagreeId in (71),1,0)) as DL2,
						sum(if(b.DisagreeId in (72),1,0)) as DL3,
						sum(if(b.DisagreeId in (73),1,0)) as DL4,
						sum(if(b.DisagreeId in (74),1,0)) as DL5,
						sum(if(b.DisagreeId in (75),1,0)) as DL6,
						sum(if(b.DisagreeId in (76),1,0)) as DL7,
						sum(if(b.DisagreeId in (77),1,0)) as DL8,
						sum(if(b.DisagreeId in (78),1,0)) as DL9,
						sum(if(b.DisagreeId in (79),1,0)) as DL10,
						sum(if(b.DisagreeId in (80),1,0)) as DL11,
						sum(if(b.DisagreeId in (81),1,0)) as DL14
						
						from t_gn_customer b
						inner join t_gn_assignment z on b.CustomerId = z.CustomerId
					WHERE b.CampaignId in (".$this -> campaign.") AND z.AssignSelerId is null AND
					b.CustomerUpdatedTs >= '".$this->start_date." 00:00:00'
					AND b.CustomerUpdatedTs <= '".$this->end_date." 23:00:00' 
					GROUP BY b.Recsource";

			$qry3 = $this->db->query($sql3);
			// echo $sql;
			foreach($qry3->result_assoc() as $rows)
			{
				if($this->URI->_get_post('group_type') == 1){
					$_data[$rows['SellerId']][$rows['Recsource']]['new_util'] += (INT)$rows['new_util'];
					$_data[$rows['SellerId']][$rows['Recsource']]['D'] += (INT)$rows['D'];
					$_data[$rows['SellerId']][$rows['Recsource']]['ST'] += (INT)$rows['ST'];
					$_data[$rows['SellerId']][$rows['Recsource']]['CB'] += (INT)$rows['CB'];
					$_data[$rows['SellerId']][$rows['Recsource']]['SA'] += (INT)$rows['SA'];
					$_data[$rows['SellerId']][$rows['Recsource']]['PU'] += (INT)$rows['PU'];
					$_data[$rows['SellerId']][$rows['Recsource']]['GPU'] += (INT)$rows['GPU'];
					$_data[$rows['SellerId']][$rows['Recsource']]['CPGP'] += (INT)$rows['CPGP'];
					$_data[$rows['SellerId']][$rows['Recsource']]['INC'] += (INT)$rows['INC'];
					$_data[$rows['SellerId']][$rows['Recsource']]['R'] += (INT)$rows['R'];
					$_data[$rows['SellerId']][$rows['Recsource']]['B'] += (INT)$rows['B'];
					$_data[$rows['SellerId']][$rows['Recsource']]['NP'] += (INT)$rows['NP'];
					$_data[$rows['SellerId']][$rows['Recsource']]['BT'] += (INT)$rows['BT'];
					$_data[$rows['SellerId']][$rows['Recsource']]['NA'] += (INT)$rows['NA'];
					$_data[$rows['SellerId']][$rows['Recsource']]['MV'] += (INT)$rows['MV'];
					$_data[$rows['SellerId']][$rows['Recsource']]['WN'] += (INT)$rows['WN'];
					$_data[$rows['SellerId']][$rows['Recsource']]['ID'] += (INT)$rows['ID'];
					$_data[$rows['SellerId']][$rows['Recsource']]['AddOn'] += (INT)$rows['AddOn'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL0'] += (INT)$rows['DL0'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL1'] += (INT)$rows['DL1'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL2'] += (INT)$rows['DL2'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL3'] += (INT)$rows['DL3'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL4'] += (INT)$rows['DL4'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL5'] += (INT)$rows['DL5'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL6'] += (INT)$rows['DL6'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL7'] += (INT)$rows['DL7'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL8'] += (INT)$rows['DL8'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL9'] += (INT)$rows['DL9'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL10'] += (INT)$rows['DL10'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL11'] += (INT)$rows['DL11'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL12'] += (INT)$rows['DL12'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL13'] += (INT)$rows['DL13'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL14'] += (INT)$rows['DL14'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL15'] += (INT)$rows['DL15'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL16'] += (INT)$rows['DL16'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL17'] += (INT)$rows['DL17'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL18'] += (INT)$rows['DL18'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL19'] += (INT)$rows['DL19'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL20'] += (INT)$rows['DL20'];
					$_data[$rows['SellerId']][$rows['Recsource']]['DL21'] += (INT)$rows['DL21'];
					$_data[$rows['SellerId']][$rows['Recsource']]['Dll'] += (INT)$rows['Dll'];
					$_data[$rows['SellerId']][$rows['Recsource']]['LoadAmount'] += (INT)$rows['LoadAmount'];
					$_data[$rows['SellerId']][$rows['Recsource']]['POD'] += (INT)$rows['POD'];
				}else if($this->URI->_get_post('group_type') == 2){
					$_data[$rows['AssignSpv']][$rows['Recsource']]['new_util'] += (INT)$rows['new_util'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['D'] += (INT)$rows['D'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['ST'] += (INT)$rows['ST'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['CB'] += (INT)$rows['CB'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['SA'] += (INT)$rows['SA'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['PU'] += (INT)$rows['PU'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['GPU'] += (INT)$rows['GPU'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['CPGP'] += (INT)$rows['CPGP'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['INC'] += (INT)$rows['INC'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['R'] += (INT)$rows['R'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['B'] += (INT)$rows['B'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['NP'] += (INT)$rows['NP'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['BT'] += (INT)$rows['BT'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['NA'] += (INT)$rows['NA'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['MV'] += (INT)$rows['MV'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['WN'] += (INT)$rows['WN'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['ID'] += (INT)$rows['ID'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['AddOn'] += (INT)$rows['AddOn'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL0'] += (INT)$rows['DL0'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL1'] += (INT)$rows['DL1'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL2'] += (INT)$rows['DL2'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL3'] += (INT)$rows['DL3'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL4'] += (INT)$rows['DL4'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL5'] += (INT)$rows['DL5'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL6'] += (INT)$rows['DL6'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL7'] += (INT)$rows['DL7'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL8'] += (INT)$rows['DL8'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL9'] += (INT)$rows['DL9'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL10'] += (INT)$rows['DL10'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL11'] += (INT)$rows['DL11'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL12'] += (INT)$rows['DL12'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL13'] += (INT)$rows['DL13'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL14'] += (INT)$rows['DL14'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL15'] += (INT)$rows['DL15'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL16'] += (INT)$rows['DL16'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL17'] += (INT)$rows['DL17'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL18'] += (INT)$rows['DL18'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL19'] += (INT)$rows['DL19'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL20'] += (INT)$rows['DL20'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['DL21'] += (INT)$rows['DL21'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['Dll'] += (INT)$rows['Dll'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['LoadAmount'] += (INT)$rows['LoadAmount'];
					$_data[$rows['AssignSpv']][$rows['Recsource']]['POD'] += (INT)$rows['POD'];
				}
			}
			return $_data;
		}
		
		Public Function _getRowDataNull4()
		{
			$_data = array();
			$sql4 = "SELECT if(c.AssignSelerId is null, 0,'-') as SellerId, b.Recsource, SUM(IF(a.CallReasonId IN (8,10,3,7,9,11,13,14),1,0)) AS tot_connect, SUM(IF(a.CallReasonId IN (2,4,5,6),1,0)) AS tot_notconnect
					FROM t_gn_callhistory a
					LEFT JOIN t_gn_customer b ON a.CustomerId = b.CustomerId
					LEFT JOIN t_gn_assignment c ON b.CustomerId = c.CustomerId
					WHERE a.HistoryType = 0
					AND a.CallHistoryCreatedTs >= '".$this -> start_date." 00:00:00'
					AND a.CallHistoryCreatedTs <= '".$this -> end_date." 23:59:59'
					AND b.CampaignId = '".$this -> campaign."' and c.AssignSelerId is null
					GROUP BY b.Recsource";

				// echo $sql;
			$qry4 = $this->db->query($sql4);
			
			if($qry4->num_rows()>0)
			{
				foreach($qry4->result_assoc() as $rows)
				{
					if($this->URI->_get_post('group_type') == 1){
						$_data[$rows['SellerId']][$rows['Recsource']]['tot_connect'] += (INT)$rows['tot_connect'];
						$_data[$rows['SellerId']][$rows['Recsource']]['tot_notconnect'] += (INT)$rows['tot_notconnect'];
					}else if($this->URI->_get_post('group_type') == 2){
						$_data[$rows['UserId']][$rows['Recsource']]['tot_connect'] += (INT)$rows['tot_connect'];
						$_data[$rows['UserId']][$rows['Recsource']]['tot_notconnect'] += (INT)$rows['tot_notconnect'];
					}
				}
			}

			return $_data;
		}
	
	}
?>