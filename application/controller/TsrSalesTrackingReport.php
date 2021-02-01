<?php
	class TsrSalesTrackingReport extends EUI_Controller
	{
		function TsrSalesTrackingReport()
		{
			parent::__construct();
			$this->load->model(array(base_class_model($this)));
		}
		
		function index()
		{
			$UI = array
			(
					'filterby' => array('TSR'=>'Telesales Marketing'),
					'modeby' => array('Summary'=>'Summary')
			);
			
			$this->load->view('rpt_tsr_sales_tracking/rpt_tsr_track_nav',$UI);
		}
		
		public function GroupFilterBy()
		{
			if($this -> URI -> _get_have_post('FilterId'))
			{
				__(form()->combo('spvname','select long', $this->M_TsrSalesTrackingReport->_getAtmBaru(), null, array("change" => "Ext.DOM.ListTL(this)") ));
			}
			else
			{
				__(form()->combo('spvname','select long', array(), null, null ));
			}
		}
		
		public function GroupFilterTL($spv)
		{
			if($this -> URI -> _get_have_post('FilterId'))
			{
				$d  = $this->M_TsrSalesTrackingReport->_getSPVBaru($_REQUEST['FilterId']);
				__(form()->combo('tlname','select long',$d, null, array("change" => "Ext.DOM.ListCmp(this)") ));
			}
			else
			{
				__(form()->combo('tlname','select long', array(), null ));
			}
		}
		
		public function GroupFilterCmp()
		{	
			if($this -> URI -> _get_have_post('FilterId'))
			{
				__(form()->listCombo('cmpname', null, $this->M_TsrSalesTrackingReport->_getCMP() ));
			}
			else
			{
				__(form()->combo('cmpname','select long', array(), null ));
			}
		}
		
		function ShowReport()
		{
			if($this -> URI -> _get_have_post('mode'))
			{
				$UI_Mode = STRTOLOWER($this -> URI->_get_post('mode'));
				switch($UI_Mode)
				{
					case 'summary' : $this -> SummaryHTML(); break;
				}
			}
		}
		
		public function SummaryHTML()
		{
		// print_r($_REQUEST);
			$UI = array
			(
				'view_atm' 	=> $this -> {base_class_model($this)} -> _getAtm($this -> _POST()),
				'view_spv' 	=> $this -> {base_class_model($this)} -> _getSPV($this -> _POST()),
				'view_agent' 	=> $this -> {base_class_model($this)} -> _getAgent($this -> _POST()),
				'size' 	=> $this -> {base_class_model($this)} -> _Leadsize($this -> _POST()),
				'data_new' 	=> $this -> {base_class_model($this)} -> _NewUtilized($this -> _POST()),
				'data_old' 	=> $this -> {base_class_model($this)} -> _OldUtilized($this -> _POST()),
				'data_remain' 	=> $this -> {base_class_model($this)} -> _Remaining($this -> _POST()),
				'conctact' 	=> $this -> {base_class_model($this)} -> _Contact($this -> _POST()),
				'attempt' 	=> $this -> {base_class_model($this)} -> _Attempt($this -> _POST()),
				'sales' 	=> $this -> {base_class_model($this)} -> _SalesSubmit($this -> _POST()),
				'cases' 	=> $this -> {base_class_model($this)} -> _TotalCases($this -> _POST()),
				'param' => $this -> _POST(), 
				'Users' => $this ->_CAMPAIGN(),
				'Tar' => $this -> {base_class_model($this)} -> _Target(1)
			);
			$this -> load -> view("rpt_tsr_sales_tracking/rpt_tsr_sales_tracking_show", $UI);
		}
		
		function ShowExcel()
		{
			Excel() -> HTML_Excel(get_class($this).''.time());
			if($this -> URI -> _get_have_post('mode'))
			{
				$UI_Mode = STRTOLOWER($this -> URI->_get_post('mode'));
				switch($UI_Mode)
				{
					case 'summary' : $this -> SummaryExcel(); break;
				}
			}
		}
		
		public function SummaryExcel()
		{
			$UI = array
			(
				'view_atm' 	=> $this -> {base_class_model($this)} -> _getAtm($this -> _POST()),
				'view_spv' 	=> $this -> {base_class_model($this)} -> _getSPV($this -> _POST()),
				'view_agent' 	=> $this -> {base_class_model($this)} -> _getAgent($this -> _POST()),
				'size' 	=> $this -> {base_class_model($this)} -> _Leadsize($this -> _POST()),
				'data_new' 	=> $this -> {base_class_model($this)} -> _NewUtilized($this -> _POST()),
				'data_old' 	=> $this -> {base_class_model($this)} -> _OldUtilized($this -> _POST()),
				'data_remain' 	=> $this -> {base_class_model($this)} -> _Remaining($this -> _POST()),
				'conctact' 	=> $this -> {base_class_model($this)} -> _Contact($this -> _POST()),
				'attempt' 	=> $this -> {base_class_model($this)} -> _Attempt($this -> _POST()),
				'sales' 	=> $this -> {base_class_model($this)} -> _SalesSubmit($this -> _POST()),
				'cases' 	=> $this -> {base_class_model($this)} -> _TotalCases($this -> _POST()),
				'param' => $this -> _POST(), 
				'Users' => $this ->_CAMPAIGN()
			);
			$this -> load -> view("rpt_tsr_sales_tracking/rpt_tsr_sales_tracking_show", $UI);
		}
		
		public function _POST()
		{
			$_reqs = array();
			$filter = array('CampaignId');
	
			$param =  $this -> URI -> _get_all_request();
			foreach( $param as $keys => $values ) 
			{ 
				if( in_array($keys, $filter) ){
					$_reqs[$keys] = $this -> URI->_get_array_post($keys);
				}
				else{
					$_reqs[$keys] = $values;
				}
			}

			return $_reqs; 
		}
		
		public function _CAMPAIGN()
		{
			$_reqs = array(); 
			$filter = array('CampaignId');
			
			$UserCampaign = $this -> URI->_get_array_post('CampaignId');
			foreach($UserCampaign as $k => $v )
			{
				$_reqs[$v] = $this ->M_TsrSalesTrackingReport->filter_by($v); 	
			}
			return $_reqs; 	
		}
	}
?>