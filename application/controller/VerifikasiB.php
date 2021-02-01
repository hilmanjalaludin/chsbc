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
		//var_dump($this->{base_class_model($this)}->_get_checkdata(_get_post('CustomerId')));die();
		// var_dump($this->{base_class_model($this)}->_get_status_result(_get_post('CustomerId')));die();
		$this->load->form('verifikasi_b/view_form_default',array(
			'param' => $this->URI->_get_all_request(),
			'datas' => $this->{base_class_model($this)}->_get_value_verification(_get_post('CustomerId')),
			'input' => $this->{base_class_model($this)}->_get_input_verification(_get_post('CustomerId')),
			'result' => $this->{base_class_model($this)}->_get_result_verification(_get_post('CustomerId')),
			'urutan' => $this->{base_class_model($this)}->_get_res_activity(_get_post('CustomerId')),
			'status' => $this->{base_class_model($this)}->_get_status_result(_get_post('CustomerId')),
			'check_data'=>$this->{base_class_model($this)}->_get_checkdata(_get_post('CustomerId'))
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

	function save_action() {
		$uri = $this->URI->_get_all_request();
		// var_dump('uri',$uri);die();
		// var_dump(date('Y-m-d', strtotime($uri['jatuh_tempo'])));die();
		$CustomerId = $uri['CustomerId'];
		$InputId = $uri['InputId'];
		$attempts = true;
		$this->{base_class_model($this)}->_save_ver_activity($this->URI->_get_all_request(), $InputId);
	
		$count = $this->{base_class_model($this)}->_get_ver_count($CustomerId);
		$counts = $this->{base_class_model($this)}->_get_ver_count($CustomerId, 1);
		$status = $this->{base_class_model($this)}->_get_ver($CustomerId, $InputId);
		// var_dump($status);die();
		$attempt = $this->{base_class_model($this)}->_get_ver_attempt_check($CustomerId,$InputId);
		$conds = true;
		$verified = false;
		//var_dump($count);

		//Edit rangga= 2
		if ($count->count >= 2 && $attempt->ver_attempt >= 3) {
			$conds = false;
			$this->{base_class_model($this)}->_set_result_ver($CustomerId,2);
			// $this->{base_class_model($this)}->_del_ver_activity($CustomerId);
			// var_dump($d);die();
		}
 
		if ($counts->count >= 3) {
			$verified = true;
			$this->{base_class_model($this)}->_set_result_ver($CustomerId,1);
		}

		if ($attempt->ver_attempt >= 3) {
			$attempts = false;
		}
		echo json_encode(array('success'=>1, 'count' => $count->count, 'status' => $status->ver_status, 'conds' => $conds, 'verified' => $verified,'attempt'=>$attempt->ver_attempt, 'att' => $attempts));
	}

	function get_history() {
		$uri = $this->URI->_get_all_request();
		$CustomerId = $uri['CustomerId'];
		$ver_status = $this->{base_class_model($this)}->_get_status_result($CustomerId);
		echo json_encode(array('row' => $this->{base_class_model($this)}->_get_history_status($CustomerId), 'ver_status' => $ver_status));
		// echo json_encode($this->{base_class_model($this)}->_get_history_status(_get_post('CustomerId')));
		// echo json_encode(['rangga','halo','tes']);
		// echo 'halo';
	}
}
?>
