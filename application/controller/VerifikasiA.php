<?php
class VerifikasiA extends EUI_Controller
{
	function VerifikasiA()
	{
		parent::__construct();
		$this->load->model(array(
			base_class_model($this),
			'M_VerifikasiA2'
		));
	}
	
	function index(){
	
		$this->load->form('verifikasi_a/view_form_default',array(
			'param' => $this->URI->_get_all_request(),
			'datas' => $this->{base_class_model($this)}->_get_value_verification(_get_post('CustomerId')),
			'input' => $this->{base_class_model($this)}->_get_input_verification(_get_post('CustomerId')),
			'result' => $this->{base_class_model($this)}->_get_result_verification(_get_post('CustomerId')),
			'urutan' => $this->{base_class_model($this)}->_get_res_activity(_get_post('CustomerId')),
			'stat' => $this->{base_class_model($this)}->_get_status_result(_get_post('CustomerId')),
			'ver_history'=> $this->{base_class_model($this)}->_get_history_status(_get_post('CustomerId')),
			'check_data'=>$this->{base_class_model($this)}->_get_checkdata(_get_post('CustomerId'))
		));
		//var_dump($this->{base_class_model($this)}->_get_history_status(_get_post('CustomerId')));die();
	}

	public function jj() {
		echo json_encode($this->{base_class_model($this)}->_get_history_status(_get_post('CustomerId')));
	}
	
	function loadSecondVerification(){
	
		$this->load->form('verifikasi_a_2/view_form_default',array(
			'param' => $this->URI->_get_all_request(),
			'datas' => $this->{base_class_model($this)}->_get_value_verification(_get_post('CustomerId')),
			'input' => $this->{base_class_model($this)}->_get_input_verification(_get_post('CustomerId')),
			'result' => $this->{base_class_model($this)}->_get_result_verification(_get_post('CustomerId')),
			'urutan' => $this->{base_class_model($this)}->_get_res_activity(_get_post('CustomerId')),
			'stat' => $this->{base_class_model($this)}->_get_status_result(_get_post('CustomerId')),
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
		// var_dump(date('Y-m-d', strtotime($uri['jatuh_tempo'])));die();
		// var_dump($uri);
		$CustomerId = $uri['CustomerId'];
		$InputId = $uri['InputId'];

		$this->{base_class_model($this)}->_save_ver_activity($this->URI->_get_all_request(), $InputId);
	
		$count = $this->{base_class_model($this)}->_get_ver_count($CustomerId);
		$counts = $this->{base_class_model($this)}->_get_ver_count($CustomerId, 1);
		$status = $this->{base_class_model($this)}->_get_ver($CustomerId, $InputId);
		$conds = true;
		$verified = false;
		//var_dump($count);

		//var_dump('tes',$count,$counts,$status,$conds,$verified);die();
		if ($count->count >= 2) {
			$conds = false;
			//rangga ver A
			$this->{base_class_model($this)}->_set_result_ver($CustomerId,2);
			//$this->{base_class_model($this)}->_del_ver_activity($CustomerId);
		}

		if ($counts->count >= 3) {
			$verified = true;
			$this->{base_class_model($this)}->_set_result_ver($CustomerId,1);
		}
		echo json_encode(array('success'=>1, 'count' => $count->count, 'status' => $status->ver_status, 'conds' => $conds, 'verified' => $verified));
	}

	function get_ver() {
		$uri = $this->URI->_get_all_request();
		$count = $this->{base_class_model($this)}->_get_ver_count($uri['CustomerId']);

		echo json_encode(array('success'=>1, 'count' => $count->count));
	}

	function save_action_2nd() {
		$uri = $this->URI->_get_all_request();
		// var_dump(date('Y-m-d', strtotime($uri['jatuh_tempo'])));die();
		// var_dump($uri);
		$CustomerId = $uri['CustomerId'];
		$InputId = $uri['InputId'];

		$this->M_VerifikasiA2->_save_ver_activity($this->URI->_get_all_request(), $InputId);
	
		$count = $this->M_VerifikasiA2->_get_ver_count($CustomerId);
		$counts = $this->M_VerifikasiA2->_get_ver_count($CustomerId, 1);
		$status = $this->M_VerifikasiA2->_get_ver($CustomerId, $InputId);
		$conds = true;
		$verified = false;
		//var_dump($count);

		//var_dump('tes',$count,$counts,$status,$conds,$verified);die();
		if ($count->count >= 2) {
			$conds = false;
			//rangga ver A
			$this->M_VerifikasiA2->_set_result_ver($CustomerId,2);
			//$this->M_VerifikasiA2->_del_ver_activity($CustomerId);
		}

		if ($counts->count >= 3) {
			$verified = true;
			$this->M_VerifikasiA2->_set_result_ver($CustomerId,1);
		}
		echo json_encode(array('success'=>1, 'count' => $count->count, 'status' => $status->ver_status, 'conds' => $conds, 'verified' => $verified));
	}
	
	// function save_action_2nd() {
	// 	$uri = $this->URI->_get_all_request();
	// 	// var_dump(date('Y-m-d', strtotime($uri['jatuh_tempo'])));die();
	// 	$CustomerId = $uri['CustomerId'];
	// 	$InputId = $uri['InputId'];

	// 	$this->M_VerifikasiA2->_save_ver_activity($this->URI->_get_all_request(), $InputId);
	
	// 	$count = $this->M_VerifikasiA2->_get_ver_count($CustomerId);
	// 	$counts = $this->M_VerifikasiA2->_get_ver_count($CustomerId, 1);
	// 	$status = $this->M_VerifikasiA2->_get_ver($CustomerId, $InputId);
	// 	$conds = true;
	// 	$verified = false;
	// 	//var_dump($count);
	// 	if ($count->count >= 2) {
	// 		$conds = false;
	// 		//rangga ver A
	// 		$this->M_VerifikasiA2->_set_result_ver($CustomerId,2);
	// 		$this->M_VerifikasiA2->_del_ver_activity($CustomerId);
	// 	}

	// 	if ($counts->count >= 3) {
	// 		$verified = true;
	// 		$this->M_VerifikasiA2->_set_result_ver($CustomerId,1);
	// 	}
	// 	echo json_encode(array('success'=>1, 'count' => $count->count, 'status' => $status->ver_status, 'conds' => $conds, 'verified' => $verified));
	// }
}
?>