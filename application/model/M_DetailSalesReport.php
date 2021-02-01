<?php
class M_DetailSalesReport extends EUI_Model
{
	function M_DetailSalesReport()
	{
		$this -> start_date = _getDateEnglish( $this -> URI->_get_post('start_date'));
		$this -> end_date	= _getDateEnglish( $this -> URI->_get_post('end_date'));
	}
	
	function _get_product()
	{
		$datas = array();
		
		$sql = "select a.ProductId, a.ProductCode, a.ProductName from t_gn_product a
				where a.ProductStatusFlag = 1";
		$qry = $this->db->query($sql);
		
		if($qry->num_rows() > 0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				$datas[$rows['ProductId']] = $rows['ProductCode']." - ".$rows['ProductName'];
			}
		}
		
		return $datas;
	}
	
	function _loadCampaignByProduct($id)
	{
		$datas = array();
		
		$sql = "select a.CampaignId, a.CampaignNumber, a.CampaignName from t_gn_campaign a
				left join t_gn_campaignproduct b on a.CampaignId = b.CampaignId
				where b.ProductId = '".$id."'
				and a.CampaignStatusFlag = 1";
		
		$qry = $this->db->query($sql);
		
		if($qry->num_rows() > 0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				$datas[$rows['CampaignId']] = $rows['CampaignNumber']." - ".$rows['CampaignName'];
			}
		}
		
		return $datas;
	}
	
	function _Excel($_header_names = null )
	{
		if( $_header_names !=NULL )
		{
			$xlsName = $_header_names.'_'.date('Ymd').'_'.date('His').'.xls';
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			header("Cache-Control: no-store, no-cache, must-revalidate");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Cache-Control: private");
			header("Pragma: no-cache");
			header("Content-Type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=$xlsName");		
		}
	}
	
// Function Query Detail Sales (ozz)
	function _get_summary_by_html( $param = null )
	{
		$data = array ();
		$sql = "select
				b.CampaignCode AS CampaignCode,
				d.ProductCode AS ProductCode,
				e.InsuredCreatedTs AS Expected,
				f.PolicyNumber AS Application,
				e.InsuredFirstName AS InsuredName,
				g.Gender AS InsuredGender,
				e.InsuredDOB AS InsuredDOB,
				h.OccCode AS OccupationCode,
				h.OccEnglish AS InsuredOccupation,
				h.OccIndonesian AS InsuredJobDescription,
				h.OccClass AS InsuredOccupationClass,
				i.ProductPlanName AS Plans,
				j.PayMode AS PaymentMode,
				i.ProductPlanPremium AS Premium,
				k.PayerFirstName AS HolderName,
				k.PayerCity AS City,
				n.id AS TsrCode,
				n.full_name AS TsrName,
				o.id AS SpvCode,
				o.full_name AS SpvName,
				p.AproveName AS StatusAplication,
				a.CustomerUpdatedTs AS StatusDate,
				r.AproveName AS FirstMonitorStatus,
				s.full_name AS FirstMonitorBy,
				t.PaymentTypeDesc AS VccType,
				u.PremiumGroupName AS Spouse,
				q.CallHistoryUpdatedTs AS FirstMonitorDate
				from t_gn_customer a
				left join t_gn_insured e on e.CustomerId = a.CustomerId
				left join t_gn_policy f on f.PolicyId = e.PolicyId
				left join t_gn_productplan i on i.ProductPlanId = f.ProductPlanId
				left join t_gn_campaign b on b.CampaignId = a.CampaignId
				-- left join t_gn_campaignproduct c on c.CampaignId = b.CampaignId
				left join t_gn_product d on d.ProductId = i.ProductId
				left join t_lk_gender g on g.GenderId = e.GenderId
				left join t_lk_occupation_code h on h.OccId = e.Occupational_Category
				left join t_lk_paymode j on j.PayModeId = e.InsuredPayMode
				left join t_gn_payer k on k.CustomerId = a.CustomerId
				left join t_gn_assignment m on m.CustomerId=a.CustomerId
				left join tms_agent n on n.UserId=m.AssignSelerId
				left join tms_agent o on o.UserId=m.AssignLeader
				left join t_lk_aprove_status p on p.ApproveId = a.CallReasonQue
				left join t_gn_callhistory q on q.CustomerId = a.CustomerId
				left join t_lk_aprove_status r on r.ApproveId = q.ApprovalStatusId
				left join tms_agent s on s.UserId = q.CreatedById
				left join t_lk_paymenttype t on t.PaymentTypeId = k.CreditCardTypeId
				left join t_lk_premiumgroup u on u.PremiumGroupId = e.PremiumGroupId
				where e.InsuredId is not null
				and date(f.PolicySalesDate) >= '{$this ->start_date}'
				and date(f.PolicySalesDate) <= '{$this ->end_date}' ";
		$qry = $this->db->query($sql);
		$i=0;
		if(is_object($qry)) foreach ($qry -> result_assoc() as $rows)
		{
			$data[++$i] = $rows;
		}
		
		return $data;	
	}
}
?>