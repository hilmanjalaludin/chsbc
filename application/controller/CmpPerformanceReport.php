<?php
	class CmpPerformanceReport extends EUI_Controller
	{
	
		function CmpPerformanceReport()
		{
			parent::__construct();
			$this -> load -> model(array(base_class_model($this),'M_CmpPerformanceReport'));
		}
		
		function index()
		{
			$UI = array
			(
				'filter_by'		=> $this -> M_CmpPerformanceReport -> FilterBy(),
				'mode_by'		=> $this -> M_CmpPerformanceReport -> ModeBy()
			);
			$this -> load -> view("rpt_cmp_performance/rpt_cmp_performance_nav", $UI);
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
			$UI = array
			(
				'view' 		=> $this -> {base_class_model($this)} -> _getCampaign($this -> _POST()),
				'view3' 	=> $this -> {base_class_model($this)} -> _getLeadContacted($this -> _POST()),
				'view4' 	=> $this -> {base_class_model($this)} -> _getSalesSubmit($this -> _POST()),
				'view5' 	=> $this -> {base_class_model($this)} -> _getTotalCases($this -> _POST()),
				'view6' 	=> $this -> {base_class_model($this)} -> _getUtilizedNew($this -> _POST()),
				'view7' 	=> $this -> {base_class_model($this)} -> _getUtilizedOld($this -> _POST()),
				'view8' 	=> $this -> {base_class_model($this)} -> _getUtilizedRemaining($this -> _POST()),
				'view_target' 	=> $this -> {base_class_model($this)} -> _getTarget($this -> _POST()),
				'param' 	=> $this -> _POST(), 
				'Users' 	=> $this ->_CAMPAIGN(),
			);
			$this -> load -> view("rpt_cmp_performance/rpt_cmp_performance_show", $UI);
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
				'view' 	=> $this -> {base_class_model($this)} -> _getCampaign($this -> _POST()),
				'view3' 	=> $this -> {base_class_model($this)} -> _getLeadContacted($this -> _POST()),
				'view4' 	=> $this -> {base_class_model($this)} -> _getSalesSubmit($this -> _POST()),
				'view5' 	=> $this -> {base_class_model($this)} -> _getTotalCases($this -> _POST()),
				'view6' 	=> $this -> {base_class_model($this)} -> _getUtilizedNew($this -> _POST()),
				'view7' 	=> $this -> {base_class_model($this)} -> _getUtilizedOld($this -> _POST()),
				'view8' 	=> $this -> {base_class_model($this)} -> _getUtilizedRemaining($this -> _POST()),
				'view_target' 	=> $this -> {base_class_model($this)} -> _getTarget($this -> _POST()),
				'param' => $this -> _POST(), 
				'Users' => $this ->_CAMPAIGN()
			);
			$this -> load -> view("rpt_cmp_performance/rpt_cmp_performance_download", $UI);
		}
		
		public function getCampaign()
		{
			if($this -> URI -> _get_have_post('FilterId'))
			{
				$_conds = $this -> M_CmpPerformanceReport -> filter_by($this -> URI->_get_post('FilterId'));
				if( is_array($_conds) AND count($_conds)> 0 )
				{
					__(form() -> listcombo('CampaignId','',$_conds));
				}
				else
				{
					__(form() -> combo('CampaignId','select', array()));
				}
			}
			else
			{
				__(form() -> combo('CampaignId','select', array()));
			}
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
				$_reqs[$v] = $this ->M_CmpPerformanceReport->filter_by($v); 	
			}
			return $_reqs; 	
		}
		
	}
?>