<?php
class M_ModHandleReason extends EUI_Model
{
	function M_ModHandleReason()
	{
	
	}
	
	function _getReasonActive()
	{
		$datas = array();
		
		$sql = "";
		$qry = $this->db->query($sql);
		
		if($qry->num_rows() > 0)
		{
		
		}
		
		return $datas;
	}
}
?>