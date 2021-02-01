<?php
	Class M_CallTracking Extends EUI_Model
	{
		Function M_CallTracking()
		{
			$this -> start_date = _getDateEnglish( $this -> URI->_get_post('start_date'));
			$this -> end_date 	= _getDateEnglish( $this -> URI->_get_post('end_date'));
			$this -> campaign	= _get_post('Campaign');
			$this -> TmrId		= _get_post('TmrId');
			$this -> spvId		= _get_post('spvId');
			$this -> group		= _get_post('group_type');
			$this -> recsource	= explode(',',_get_post('Recsource'));
			$this -> recsource	= implode("','",$this->recsource);
		
		
		}
		
		Public Function _get_type()
		{
			return array(
							1 => 'Group By TMR',
							2 => 'Group By SPV',
							3 => 'Group By Recsource'
						);
		}
		
		Public Function _get_campaign()
		{
			$_data = array();
			$sql = "select
						a.CampaignId, a.CampaignName
					from t_gn_campaign a";
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				$_data[$rows['CampaignId']] = $rows['CampaignName'];
			}
			return $_data;
		}
		
		Public Function _get_recsource($Campaign)
		{
			$_data = array();
			$sql = "select
						a.Recsource
					from t_gn_customer a
					where a.CampaignId = '".$Campaign."'
					group by a.Recsource";
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
			// echo $sql;
			foreach($qry->result_assoc() as $rows)
			{
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
					$handling_type = 4;
					$where =  " and a.UserId IN (".$this->TmrId.")";
				}else if($this->URI->_get_post('group_type') == 2){
					$handling_type = 3;
					$where =  " and a.UserId IN (".$this->spvId.")";
				}
			$sql = "select
						a.UserId, a.id, a.full_name
					from tms_agent a
					where a.user_state = 1 and a.handling_type = ".$handling_type."";
			$sql .= $where;
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				$_data[$rows['UserId']]['fullname'] = $rows['full_name'];
				$_data[$rows['UserId']]['id'] = $rows['id'];
			}
			return $_data;
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
				$_data[$rows['DisagreeCode']] = $rows['DisagreeCode'];
			}
			return $_data;
		}
		
		Public Function _getRowData1()
		{
			$_data = array();
			$sql = "select
						b.AssignSelerId, a.Recsource, b.AssignSpv,
						count(distinct b.CustomerId) as datasize
					from t_gn_customer a
						inner join t_gn_assignment b on a.CustomerId = b.CustomerId
						inner join tms_agent c on b.AssignSelerId = c.UserId
						inner join tms_agent d on c.profile_id = d.UserId
					where b.AssignSelerId is not null";
				if(isset($this -> recsource)){
					$sql.=" and a.Recsource in ('".$this->recsource."') ";
				}
				if($this->URI->_get_post('group_type') == 1){
					$sql .= " group by b.AssignSelerId, a.Recsource";
				}else if($this->URI->_get_post('group_type') == 2){
					$sql .= " group by AssignSpv, a.Recsource";
				}else if($this->URI->_get_post('group_type') == 3){
					$sql .= " group by a.Recsource";
				}
				if(in_array(_get_session("HandlingType"),array(USER_ROOT))) {
							
							echo $sql."</br>";
							
						}
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
				}else if($this->URI->_get_post('group_type') == 3){
					$_data[$rows['Recsource']][$rows['AssignSelerId']]['Agent'] = $rows['AssignSelerId'];
					$_data[$rows['Recsource']][$rows['AssignSelerId']]['datasize'] = $rows['datasize'];
				}
			}
			return $_data;
		}
		
		Public Function _getRowData2()
		{
			$_data = array();
			$sql = "select
						a.CreatedById, b.Recsource, e.UserId,
						count(distinct a.CustomerId) as utilize
					from t_gn_callhistory a
						inner join t_gn_customer b on a.CustomerId = b.CustomerId
						inner join tms_agent c on a.CreatedById = c.UserId
						inner join tms_agent e on c.profile_id = e.UserId
						inner join t_lk_callreason d on a.CallReasonId = d.CallReasonId
					where c.handling_type = 4 and b.CampaignId = '".$this -> campaign."'
					and date(a.CallHistoryCreatedTs) between '".$this->start_date."' and '".$this->end_date."'";
					if(isset($this -> recsource)){
						$sql.=" and b.Recsource in ('".$this->recsource."') ";
					}
					if($this->URI->_get_post('group_type') == 1){
						$sql .= " group by a.CreatedById, b.Recsource";
					}else if($this->URI->_get_post('group_type') == 2){
						$sql .= " group by e.UserId, b.Recsource";
					}
			// echo $sql;
			$qry = $this->db->query($sql);
			
			foreach($qry->result_assoc() as $rows)
			{
				if($this->URI->_get_post('group_type') == 1){
					$_data[$rows['CreatedById']][$rows['Recsource']]['utilize'] = $rows['utilize'];
				}else if($this->URI->_get_post('group_type') == 2){
					$_data[$rows['UserId']][$rows['Recsource']]['utilize'] = $rows['utilize'];
				}
			}
			return $_data;
		}
		
		Public Function _getRowData3()
		{
			$_data = array();
			$sql = "select
						z.AssignSelerId as SellerId, b.Recsource, z.AssignSpv,
						sum(if(b.CallReasonId not in (1),1,0)) as new_util,
						sum(if(b.CallReasonId in (8,14),1,0)) as D,
						sum(if(b.CallReasonId in (10),1,0)) as ST,
						sum(if(b.CallReasonId in (11),1,0)) as CB,
						sum(if(b.CallReasonId in (12),1,0)) as TBO,
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
						#t_gn_callhistory a
						inner join t_gn_assignment z on b.CustomerId = z.CustomerId
						inner join tms_agent c on z.AssignSelerId = c.UserId
						inner join tms_agent e on c.profile_id = e.UserId
						#inner join t_lk_callreason d on a.CallReasonId = d.CallReasonId
					WHERE c.handling_type = 4 AND
					b.CampaignId = '".$this -> campaign."' AND
					b.CustomerUpdatedTs >= '".$this->start_date." 00:00:00'
					AND b.CustomerUpdatedTs <= '".$this->end_date." 23:00:00'";
					if(isset($this -> recsource)){
						$sql.=" and b.Recsource in ('".$this->recsource."') ";
					}
					if($this->URI->_get_post('group_type') == 1){
						$sql .= " GROUP BY z.AssignSelerId, b.Recsource#, b.CallReasonId";
					}else if($this->URI->_get_post('group_type') == 2){
						$sql .= " GROUP BY z.AssignSpv, b.Recsource#, b.CallReasonId";
					}
						
					// where c.handling_type = 4 and b.CampaignId = '".$this -> campaign."'
					// and date(a.CallHistoryCreatedTs) between '".$this->start_date."' and '".$this->end_date."'
					// group by a.CreatedById, b.Recsource, d.CallReasonId";
			$qry = $this->db->query($sql);
			// echo $sql;
			// echo $this->recsource;
			foreach($qry->result_assoc() as $rows)
			{
				if($this->URI->_get_post('group_type') == 1){
					$_data[$rows['SellerId']][$rows['Recsource']]['new_util'] += (INT)$rows['new_util'];
					$_data[$rows['SellerId']][$rows['Recsource']]['D'] += (INT)$rows['D'];
					$_data[$rows['SellerId']][$rows['Recsource']]['ST'] += (INT)$rows['ST'];
					$_data[$rows['SellerId']][$rows['Recsource']]['CB'] += (INT)$rows['CB'];
					$_data[$rows['SellerId']][$rows['Recsource']]['SA'] += (INT)$rows['SA'];
					$_data[$rows['SellerId']][$rows['Recsource']]['TBO'] += (INT)$rows['TBO'];
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
		
		function _getRowData4()
		{
			$_data = array();
			
			$sql = "select
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
					and b.CampaignId = '".$this -> campaign."'";
					if(isset($this -> recsource)){
						$sql.=" and b.Recsource in ('".$this->recsource."') ";
					}
					if($this->URI->_get_post('group_type') == 1){
						$sql .= " group by a.CreatedById, b.Recsource";
					}else if($this->URI->_get_post('group_type') == 2){
						$sql .= " group by c.UserId, b.Recsource";
					}
						if(in_array(_get_session("HandlingType"),array(USER_ROOT))) {
							
							echo $sql."</br>";
							
						}
						
			$qry = $this->db->query($sql);
			
			if($qry->num_rows()>0)
			{
				foreach($qry->result_assoc() as $rows)
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
		
		Public Function _get_amount_percampaign($Campaign){
			$_data = array();
			switch ($Campaign) {
				case 7:
					$_data = $this->_get_amount_hospin($Campaign);
					return $_data;
					break;
				default:
					echo "Invalid Campaign";
			}
		}
		
		Public Function _get_amount_hospin($Campaign){
			$_data = array();
			$sql = "select e.create_by as SellerId, b.Recsource, e.monthly_premium, sum(e.monthly_premium) amount
			from t_gn_customer b
			inner join t_gn_frm_hospin e on b.CustomerId = e.CustomerId
			inner join tms_agent c on b.SellerId = c.UserId
			inner join t_lk_callreason d on b.CallReasonId = d.CallReasonId
			where c.handling_type = 4 and 
			b.CampaignId = '".$this -> campaign."' AND
			b.CustomerUpdatedTs >= '".$this->start_date." 00:00:00' AND
			b.CustomerUpdatedTs <= '".$this->end_date." 23:00:00'
			group by b.SellerId, b.Recsource";
			
			$qry = $this->db->query($sql);
			// echo $sql;
			foreach($qry->result_assoc() as $rows){
				$_data[$rows['SellerId']][$rows['Recsource']]['Amount'] += $rows['amount'];
			}
			// print_r($_data);
			return $_data;
		}
	
	
	}
?>