<?php
class SaveEditPolicy extends EUI_Controller
{
	function SaveEditPolicy()
	{
		parent::__construct();
		$this -> load -> model(array(
			base_class_model($this),
			'M_ProductForm',
			'M_ValidPayment'
		));
	}
	
	function UpdatePayers()
	{
		$conds = array('success'=>0);
		
		$ayam = $this->{base_class_model($this)}->_UpdatePayers($this ->URI->_get_all_request());
		
		if($ayam > 0)
		{
			$conds = array('success'=>1);
		}
		
		__(json_encode($conds));
	}
	
	function UpdateInsured()
	{
		$conds = array('success'=>0);
		
		$kambing = $this->{base_class_model($this)}->_UpdateInsured($this ->URI->_get_all_request());
		
		if($kambing['status'] > 0)
		{
			$conds = array('success'=>1);
		}
		else{
			$conds['msg'] = $kambing['msg'];
		}
		
		__(json_encode($conds));
	}
}
?>