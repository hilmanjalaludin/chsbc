<?php
// var_dump($param);
// exit();
		$dataSize 	 			= array();
		$jmlSize 				= array();
		$jmlVerifiedPolicySize	= array();
		$jmlReconfirmPolicySize	= array(); 
		$jmlTotInsuredSize		= array();
		$start_date  			= $param ['start_date'];
		$end_date    			= $param ['end_date'];
		$Supervior   			= "Telesales";
	
// echo "string";
// exit();	
		
		echo "<div style='color:#074e76;font-weight:bold;font-family:Arial;margin-bottom:5px;' nowrap>spv</u></div>";
		echo "<table class=\"grid\" cellpadding=\"0\" cellspacing=\"0\" width=\"90%\">	
					<tr>
					<td rowspan=2 class=\"header fisrt\">Telesales</td>
					<td rowspan=2 class=\"header middle\">Data Size</td>
					<td rowspan=2 class=\"header middle\">Data Utilize</td> ";
					foreach($this -> get_catgory_result() as $key => $rows ){
						echo "<td class=\"header middle\" colspan=\"".$this -> get_count_category($rows['CallReasonCategoryId'])."\">".$rows['CallReasonCategoryName']."</td>";
					}
			echo "	<td colspan=2 class=\"header lasted\" style=\"text-laign:center;\">Sale(TSR)</td>
					<td colspan=2 class=\"header lasted\" style=\"text-laign:center;\">Sale(QA)</td>
					<td colspan=4 class=\"header lasted\" style=\"text-laign:center;\">Call Attemp Iniated</td>
					</tr>
					<tr> ";
					foreach($this -> get_catgory_result() as $key => $rows ){
						foreach($this -> get_call_reason($rows['CallReasonCategoryId']) as $k => $row ){
							echo " <td class=\"header middle\">".$row['CallReasonDesc']."</td>";	
						}
					}
			echo "  <td class=\"header middle\">Sale</td>
					<td class=\"header middle\">Insured</td>
					<td class=\"header middle\">Verified</td>
					<td class=\"header middle\">Reconfirm</td>
					<td class=\"header middle\">Total Call</td>
					<td class=\"header middle\">Success Call</td>
					<td class=\"header middle\">Not Success Call</td>
					<td class=\"header lasted\">Talk Time</td>
					</tr>";	
			
			
					
		/* get total datasize per am **/
		
			$sql = "SELECT count(b.CampaignId) as data_size, a.AssignSelerId 
					FROM t_gn_assignment a 
					LEFT JOIN t_gn_customer b on a.CustomerId=b.CustomerId 
					LEFT JOIN t_gn_campaign c on b.CampaignId=c.CampaignId 
					WHERE a.AssignSpv = '".$Supervior->getUserId()."'
					GROUP BY a.AssignSelerId ";
			//echo $sql;		
			$qry = $this -> query($sql);
			foreach($qry -> result_assoc() as $rows )
			{
				$dataSize[$rows['AssignSelerId']]+= $rows['data_size']; 
			}		
			
		/* get data interest base on policy sales_date*/
			$sql =" SELECT f.UserId as 'UserId',concat(f.id,'-',f.full_name) as 'name',
					count(distinct(a.CustomerId)) as 'jml',
					SUM(IF(b.CallReasonQue=1,1,0)) as 'VerifiedPolicy',
					sum(if(b.CallReasonQue!=1,1,0)) as 'ReconfirmPolicy',
					count(a.PolicyAutoGenId) as 'TotInsured'
					FROM t_gn_policyautogen a
					LEFT JOIN t_gn_customer b ON a.CustomerId=b.CustomerId
					LEFT JOIN t_lk_gender c ON b.GenderId=c.GenderId
					LEFT JOIN t_gn_policy d ON a.PolicyNumber=d.PolicyNumber
					LEFT JOIN t_gn_assignment e ON b.CustomerId=e.CustomerId
					LEFT JOIN tms_agent f ON e.AssignSelerId=f.UserId
					LEFT JOIN tms_agent g ON e.AssignSpv=g.UserId
					LEFT JOIN t_lk_aprove_status h ON b.CallReasonQue=h.ApproveId
					LEFT JOIN t_gn_campaign j ON b.CampaignId=j.CampaignId
					LEFT JOIN t_lk_category k ON j.CategoryId=k.CategoryId
					WHERE b.CallReasonId IN('20','21', '22', '23', '24') AND DATE(d.PolicySalesDate)>='$start_date' AND DATE(d.PolicySalesDate)<='$end_date'
					GROUP BY f.UserId
					ORDER BY d.PolicySalesDate ASC ";
			//echo $sql;
			$qry = $this -> query($sql);
			foreach($qry -> result_assoc() as $rows )
			{
				$jmlSize[$rows['UserId']]+= $rows['jml']; 
				$jmlVerifiedPolicySize[$rows['UserId']]+= $rows['VerifiedPolicy']; 
				$jmlReconfirmPolicySize[$rows['UserId']]+= $rows['ReconfirmPolicy']; 
				$jmlTotInsuredSize[$rows['UserId']]+= $rows['TotInsured']; 
			}
			
		/** utilize data pertiap AM **/
			
			$sql = " SELECT 
						d.AssignSelerId as TelealesId,	
						COUNT(a.id) AS TotalCall, 
						COUNT(DISTINCT a.assign_data) AS UtilizeData, 
						SUM(IF(a.status IN(3004,3005),1,0)) AS CallConnected, 
						SUM(IF(a.status NOT IN(3004,3005),1,0)) AS CallNotConnected,
						SUM(IF(a.status IN(3004,3005),(UNIX_TIMESTAMP(a.end_time)-UNIX_TIMESTAMP(a.agent_time)),0)) as TalkTime
						
						FROM cc_call_session a
						INNER JOIN t_gn_customer b ON a.assign_data=b.CustomerId
						LEFT JOIN t_gn_campaign c ON b.CampaignId=c.CampaignId
						LEFT JOIN t_gn_assignment d on b.CustomerId=d.CustomerId
						WHERE date(a.start_time)>='$start_date'
						AND date(a.start_time)<='$end_date'
						AND d.AssignSpv = '".$Supervior->getUserId()."'
						GROUP BY TelealesId ";
			//echo $sql;			
			$qry = $this -> query($sql);
			foreach($qry -> result_assoc() as $rows )
			{
				$UtilizeData[$rows['TelealesId']] += $rows['UtilizeData']; 
				$CallConnected[$rows['TelealesId']] += $rows['CallConnected']; 
				$CallNotConected[$rows['TelealesId']] += $rows['CallNotConnected'];
				$TotalCall[$rows['TelealesId']] += $rows['TotalCall']; 
				$TotalTalkTime[$rows['TelealesId']]+= $rows['TalkTime'];
			}	

		/* definer total in integer  by am summary ***/
		
			$total_utilize_data = 0;
			$total_call_data = 0;
			$total_call_not_connected = 0;
			$total_call_connected = 0;
			$total_data_size = 0; 
			$total_jml_size = 0;
			$total_verified_size = 0;
			$total_reconfirm_size = 0;
			$total_insured_size = 0;
			$total_talk_time = 0;
			
			foreach( $this -> get_agent_select() as $k => $TelealesId )
			{
				$Telesales= $this -> Users -> getUsers($TelealesId);
				echo " <tr>
						<td class=\"content first\"  nowrap>{$Telesales-> getUserName()} - {$Telesales-> getFullname()}</td>
						<td class=\"content middle\" align=\"right\">".($dataSize[$TelealesId]?$dataSize[$TelealesId]:'-')."</td>
						<td class=\"content middle\" align=\"right\">".($UtilizeData[$TelealesId]?$UtilizeData[$TelealesId]:'-')."</td>";
						foreach($this -> get_catgory_result() as $key => $rows ){
							foreach($this -> get_call_reason($rows['CallReasonCategoryId']) as $k => $row ){
								$current_size_data[$rows['CallReasonCategoryId']][$row['CallReasonId']] = $this -> get_summary_size_callreason_by_TM($row['CallReasonId'], $TelealesId, $Supervior->getUserId());
								$total_size_reason[$rows['CallReasonCategoryId']][$row['CallReasonId']]+= $this -> get_summary_size_callreason_by_TM($row['CallReasonId'], $TelealesId, $Supervior->getUserId());
								echo " <td class=\"content middle\" align=\"right\">".($current_size_data[$rows['CallReasonCategoryId']][$row['CallReasonId']]?$current_size_data[$rows['CallReasonCategoryId']][$row['CallReasonId']]:'-')."</td>";	
							}
						}
							
				echo 	"<td class=\"content middle\" align=\"right\">".($jmlSize[$TelealesId]?$jmlSize[$TelealesId]:'-')."</td>
							<td class=\"content middle\" align=\"right\">".($jmlTotInsuredSize[$TelealesId]?$jmlTotInsuredSize[$TelealesId]:'-')."</td>
							<td class=\"content middle\" align=\"right\">".($jmlVerifiedPolicySize[$TelealesId]?$jmlVerifiedPolicySize[$TelealesId]:'-')."</td>
							<td class=\"content middle\" align=\"right\">".($jmlReconfirmPolicySize[$TelealesId]?$jmlReconfirmPolicySize[$TelealesId]:'-')."</td>
							<td class=\"content middle\" align=\"right\">".($TotalCall[$TelealesId]?$TotalCall[$TelealesId]:'-')."</td>
							<td class=\"content middle\" align=\"right\">".($CallConnected[$TelealesId]?$CallConnected[$TelealesId]:'-')."</td>
							<td class=\"content middle\" align=\"right\">".($CallNotConected[$TelealesId]?$CallNotConected[$TelealesId]:'-')."</td>
							<td class=\"content lasted\" align=\"right\">".($TotalTalkTime[$TelealesId]?toDuration($TotalTalkTime[$TelealesId]):'00:00:00')."</td>
						</tr> ";
						
						$total_utilize_data+= $UtilizeData[$TelealesId];
						$total_call_data+= $TotalCall[$TelealesId];
						$total_call_not_connected+= $CallNotConected[$TelealesId];
						$total_call_connected+= $CallConnected[$TelealesId];
						$total_data_size += $dataSize[$TelealesId];
						$total_jml_size += $jmlSize[$TelealesId];
						$total_verified_size += $jmlVerifiedPolicySize[$TelealesId];
						$total_reconfirm_size += $jmlReconfirmPolicySize[$TelealesId];
						$total_insured_size += $jmlTotInsuredSize[$TelealesId];
						$total_talk_time += $TotalTalkTime[$TelealesId];
			
			}	
		/** start footer table ***********************/
	
			echo " <tr>
					<td class=\"total fisrt\">Grand Total</td>
					<td class=\"total middle\" align=\"right\">{$total_data_size}</td>
					<td class=\"total middle\" align=\"right\">{$total_utilize_data}</td>";
					
					/** get summary data ***/
					foreach($this -> get_catgory_result() as $key => $rows ){
						foreach($this -> get_call_reason($rows['CallReasonCategoryId']) as $k => $row ){
							$total_rows_reason = $total_size_reason[$rows['CallReasonCategoryId']][$row['CallReasonId']];
							echo " <td class=\"total middle\" align=\"right\">&nbsp;".($total_rows_reason ?$total_rows_reason :'0')."</td>";	
						}
					}
			echo "	<td class=\"total middle\" align=\"right\">{$total_jml_size}</td>
					<td class=\"total middle\" align=\"right\">{$total_insured_size}</td>
					<td class=\"total middle\" align=\"right\">{$total_verified_size}</td>
					<td class=\"total middle\" align=\"right\">{$total_reconfirm_size}</td>
					<td class=\"total middle\" align=\"right\">{$total_call_data}</td>
					<td class=\"total middle\" align=\"right\">{$total_call_connected}</td>
					<td class=\"total middle\" align=\"right\">{$total_call_not_connected}</td>
					<td class=\"total lasted\" align=\"right\">".($total_talk_time?toDuration($total_talk_time):'00:00:00')."</td>
				  </tr> 
				  </table>";
?>