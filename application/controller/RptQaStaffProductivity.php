<?php
class RptQaStaffProductivity extends EUI_Controller
{
	function RptQaStaffProductivity()
	{
		parent::__construct();
		$this -> load->model(
			array(
				base_class_model($this),
				'M_Report','M_SysUser'
			)
		);
	}
	
	function index()
	{
		$UI = array(
			'UserStaff' => $this->M_SysUser->_get_quality_staff_by_skill(),
			'UserHead' => $this->M_SysUser->_get_quality_head()
		);
		
		$this -> load->view('rpt_qa_staff_productivity/qa_productivity_nav',$UI);
	}
	
	function ShowReport()
	{
		// echo base_class_model($this);
		
		$UI = array(
			'param' => $this -> URI->_get_all_request(),
			'fungsi' => $this ->M_SysUser,
			'data_a' => $this->{base_class_model($this)}->GetDataA($this->URI->_get_all_request()),
			'data_b' => $this->{base_class_model($this)}->GetDataB($this->URI->_get_all_request()),
			'data_h' => $this->{base_class_model($this)}->GetDataH($this->URI->_get_all_request())
		);
		
		$this -> load->view('rpt_qa_staff_productivity/qa_productivity_template',$UI);
	}
	
	function ShowExcel()
	{
		Excel() -> HTML_Excel(get_class($this).''.time());
		$UI = array(
			'param' => $this -> URI->_get_all_request(),
			'fungsi' => $this ->M_SysUser,
			'data_a' => $this->{base_class_model($this)}->GetDataA($this->URI->_get_all_request()),
			'data_b' => $this->{base_class_model($this)}->GetDataB($this->URI->_get_all_request()),
			'data_h' => $this->{base_class_model($this)}->GetDataH($this->URI->_get_all_request())
		);
		
		$this -> load->view('rpt_qa_staff_productivity/qa_productivity_template',$UI);
	}
}
?>