<?php
class DetailSalesReport extends EUI_Controller
{
	function DetailSalesReport()
	{
		parent::__construct();
		$this -> load->model(array('M_Report',base_class_model($this)));
	}
	
// Index
	public function index()
	{
		if( $this -> EUI_Session->_have_get_session('UserId')) 
		{
			$UI = array(
				'Product' => $this->{base_class_model($this)}->_get_product()
			);
			
			$this -> load->view('detail_sales_report/detail_sales_nav',$UI);	
		}
	}
	
// Show HTML
	public function showHtml()
	{
		$ozz = $this->URI->_get_post('campaignId');
		
		$UI = array
		(
			'view_data' => $this-> {base_class_model($this)} -> _get_summary_by_html($ozz),
		);
		$this -> load->view('detail_sales_report/detail_sales_html',$UI);
	}
	
// Show Excel
	// public function showExcel()
	// {
		// $this->{base_class_model($this)}->_Excel('Detail_Sales_Report');
		// $this -> load->view('detail_sales_report/detail_sales_html',array());
	// }
	
// Load Campaign By Product
	function loadCampaignByProduct()
	{
		if( $this->URI->_get_have_post('id') )
		{
			$cmp = $this->{base_class_model($this)}->_loadCampaignByProduct($this->URI->_get_post('id'));
			echo(form()->listCombo('cbo_campaign',null,$cmp,NULL,null,array()));
		}
		else{
			echo(form()->listCombo('cbo_campaign',null,array(),NULL,null,array()));
		}
	}

// Campaign
	// public function campaign()
	// {
		// $ozz = $this->URI->_get_post('campaignId');
		
		// $UI = array
		// (
			// 'view_data' => $this-> {base_class_model($this)} -> _get_summary_by_campagin($ozz),
		// );
		// $this -> load -> view ('detail_sales_report/detail_sales_html', $UI);
	// }
	
	// public function Ctr()
 // {
 	// $aa = $this->URI->_get_post('CampaignId');

	// $UI = array
	// (
		// 'view' 		=> $this -> loopInfoReasonCmp(),
		// 'Category' 	=> $this -> {base_class_model($this)} -> _getCategory(),
		// 'Reason' 	=> $this -> {base_class_model($this)} -> _getReason(),
		// 'param' 	=> $this -> _POST(), 
		// 'Users' 	=> $this ->_AGENT(),
		// 'view_data' => $this -> {base_class_model($this)} ->_getSummaryByCampaign($aa),
		// 'view_data2' => $this -> {base_class_model($this)} ->_getSummaryByCampaign2($aa),
	// );
	// echo "<pre>";
	// var_dump ($UI['view_data']);
	// echo "</pre>";
	// $this -> load -> view("rpt_call_tracking/report_call_track_ctr", $UI);
	
 // }
}
?>