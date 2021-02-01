<?php
class ModHandleReason extends EUI_Controller
{
	function ModHandleReason()
	{
		parent::__construct();
		$this -> load -> model
		( 
			array
			(
				base_class_model($this)
				// 'M_SrcCustomerList', 'M_SetCallResult',
				// 'M_SetProduct', 'M_SetCampaign',
				// 'M_SetResultCategory', 'M_Combo'
			)
		);
	}
	
	function getReasonActive()
	{
		$conds = $this->{base_class_model($this)}->_getReasonActive();
		
		__(json_encode($conds));
	}
}
?>