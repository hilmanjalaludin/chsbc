<?php
	class ProductivityOnQaReport extends EUI_Controller
	{
	
		function ProductivityOnQaReport()
		{
			parent::__construct();
			$this -> load -> model(array(base_class_model($this),'M_ProductivityOnQaReport'));
		}
		
		function index()
		{
			$UI = array
			(
				'filter_by'		=> $this -> M_ProductivityOnQaReport -> FilterBy(),
				'mode_by'		=> $this -> M_ProductivityOnQaReport -> ModeBy()
			);
			$this -> load -> view("rpt_productivity_on_qa/rpt_productivity_on_qa_nav", $UI);
		}
		
		function ShowReport()
		{
			if($this -> URI -> _get_have_post('mode'))
			{
				$UI_Mode = STRTOLOWER($this -> URI->_get_post('mode'));
				switch($UI_Mode)
				{
					case 'summary' : $this -> Summary(); break;
				}
			}
		}
		
		function ShowExcel()
		{
			Excel() -> HTML_Excel(get_class($this).''.time());
			if($this -> URI -> _get_have_post('mode'))
			{
				$UI_Mode = STRTOLOWER($this -> URI->_get_post('mode'));
				switch($UI_Mode)
				{
					case 'summary' : $this -> Summary(); break;
				}
			}
		}
		
		public function Summary()
		{
			$UI = array
			(
				'view' 	=> $this -> {base_class_model($this)} -> _getCampaign($this -> _POST()),
				'view2' 	=> $this -> {base_class_model($this)} -> _getDataNew($this -> _POST()),
				'view3' 	=> $this -> {base_class_model($this)} -> _getDataOld($this -> _POST()),
				'view4' 	=> $this -> {base_class_model($this)} -> _getIndex($this -> _POST()),
				'view5' 	=> $this -> {base_class_model($this)} -> _getNewDatabase($this -> _POST()),
				'view6' 	=> $this -> {base_class_model($this)} -> _getOldDatabase($this -> _POST()),
				'view7' 	=> $this -> {base_class_model($this)} -> _getCoverage($this -> _POST()),
				'view8' 	=> $this -> {base_class_model($this)} -> _getRangeAge($this -> _POST()),
				'view9' 	=> $this -> {base_class_model($this)} -> _getGender($this -> _POST()),
				'view10' 	=> $this -> {base_class_model($this)} -> _getPayment($this -> _POST()),
				'view11' 	=> $this -> {base_class_model($this)} -> _getPaymode($this -> _POST()),
				'view12' 	=> $this -> {base_class_model($this)} -> _getQAMonitor($this -> _POST()),
				'view13' 	=> $this -> {base_class_model($this)} -> _getCancel($this -> _POST()),
				'param' => $this -> _POST(), 
				'Users' => $this ->_CAMPAIGN()
			);
			$this -> load -> view("rpt_cmp_performance/rpt_cmp_performance_show", $UI);
		}
		
		public function getCampaign()
		{
			if($this -> URI -> _get_have_post('FilterId'))
			{
				$_conds = $this -> M_ProductivityOnQaReport -> filter_by($this -> URI->_get_post('FilterId'));
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
				$_reqs[$v] = $this ->M_ProductivityOnQaReport->filter_by($v); 	
			}
			return $_reqs; 	
		}
		
	}
?>