<?php
class M_Request extends EUI_Model
{
	function M_Request()
	{
	
	}
	
	function _getIssetRequest($field)
	{
		$conds = false;
		
		foreach($_REQUEST as $key => $value)
		{
			if($key == $field)
			{
				$conds = true;
			}
		}
		
		return $conds;
	}
	
	function _getIssetSession($field)
	{
		$conds = false;
		
		foreach($_SESSION as $key => $value)
		{
			if($key == $field)
			{
				$conds = true;
			}
		}
		
		return $conds;
	}
}
?>