<?php
class M_EditPolicy extends EUI_Model
{
	function M_EditPolicy()
	{
	
	}
	
	function _getDataPayers($cust_id)
	{
		$conds = array();
		
		$sql = "select * from t_gn_payer a
				where a.CustomerId = '".$cust_id."'";
		$qry = $this->db->query($sql);
		
		if($qry->num_rows() > 0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				$conds = $rows;
			}
		}
		
		return $conds;
	}
	
	function _getDataInsured($cust_id)
	{
		$conds = array();
		
		$sql = "select * from t_gn_insured a
				left join t_gn_policy b on a.PolicyId = b.PolicyId
				left join t_gn_productplan c on b.ProductPlanId = c.ProductPlanId
				where a.InsuredId = '".$cust_id."'";
		
		// echo $sql;	
		
		$qry = $this->db->query($sql);
		
		if($qry->num_rows() > 0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				$conds = $rows;
			}
		}
		
		return $conds;
	}
	
	function _getBenef($cust_id)
	{
		$datas = array();
		
		$sql = "select * from t_gn_beneficiary a where a.InsuredId = '".$cust_id."'";
		$qry = $this->db->query($sql);
		
		if($qry->num_rows() > 0)
		{
			$no = 1;
			foreach($qry->result_assoc() as $rows)
			{
				$datas[$no] = $rows;
			}
		}
		
		return $datas;
	}
}
?>