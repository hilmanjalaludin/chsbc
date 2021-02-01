<?php
class VerifikasiB extends EUI_Controller
{
	function VerifikasiB()
	{
		parent::__construct();
		$this->load->model(array(
			base_class_model($this)
		));
	}
	
	function index()
	{
		$this->load->form('verifikasi_b/view_form_default',array(
			'param' => $this->URI->_get_all_request(),
			'datas' => $this->{base_class_model($this)}->_get_value_verification(_get_post('CustomerId')),
			'input' => $this->{base_class_model($this)}->_get_input_verification(_get_post('CustomerId')),
			'result' => $this->{base_class_model($this)}->_get_result_verification(_get_post('CustomerId')),
			'urutan' => $this->{base_class_model($this)}->_get_res_activity(_get_post('CustomerId')),
		));
	}
	
	function save_activity()
	{
		$this->{base_class_model($this)}->_save_activity($this->URI->_get_all_request());
		echo json_encode(array('success'=>1));
	}
	
	function save_ver_phone()
	{
		$this->{base_class_model($this)}->_save_ver_phone($this->URI->_get_all_request());
		echo json_encode(array('success'=>1));
	}
	
	function save_ver_crlimit()
	{
		$this->{base_class_model($this)}->_save_ver_crlimit($this->URI->_get_all_request());
		echo json_encode(array('success'=>1));
	}
	
	function save_ver_duedate()
	{
		$this->{base_class_model($this)}->_save_ver_duedate($this->URI->_get_all_request());
		echo json_encode(array('success'=>1));
	}
}
?>