<?php
	class RawDataReport extends EUI_Controller
	{
	
		function RawDataReport()
		{
			parent::__construct();
			$this -> load -> model(array(base_class_model($this),'M_RawDataReport'));
		}
		
		function index()
		{
			$UI = array
			(
				'filter_by'		=> $this -> M_RawDataReport -> FilterBy(),
				'mode_by'		=> $this -> M_RawDataReport -> ModeBy()
			);
			$this -> load -> view("rpt_raw_data/report_raw_data_nav", $UI);
		}
		
		function ShowReport()
		{
			if($this -> URI -> _get_have_post('mode'))
			{
				$UI_Mode = STRTOLOWER($this -> URI->_get_post('mode'));
				switch($UI_Mode)
				{
					case 'download'		: $this -> Download(); break;
					case 'redownload'	: $this -> Download1(); break;
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
					case 'download'		: $this -> Download(); break;
					case 'redownload'	: $this -> Download1(); break;
				}
			}
		}
		
		public function Download()
		{
			$UI = array
			(
				'view' 	=> $this -> {base_class_model($this)} -> _getIndex($this -> _POST()),
				'param' => $this -> URI -> _get_all_request(),
				'Users' => $this ->_CAMPAIGN()
			);
			$this -> load -> view("rpt_raw_data/report_raw_data_show", $UI);
		}
		
		public function Download1()
		{
			$UI = array
			(
				// 'result' 	=> $this -> {base_class_model($this)} -> _getIndex($this -> _POST()),
				'view' 	=> $this -> {base_class_model($this)} -> _reDownload($this -> _POST()),
				'param' => $this -> URI -> _get_all_request(),
				'Users' => $this ->_CAMPAIGN()
			);
			$this -> load -> view("rpt_raw_data/report_raw_data_show", $UI);
		}
		
		public function getCampaign()
		{
			if($this -> URI -> _get_have_post('FilterId'))
			{
				$_conds = $this -> M_RawDataReport -> filter_by($this -> URI->_get_post('FilterId'));
				if( is_array($_conds) AND count($_conds)> 0 )
				{
					__(form() -> combo('CampaignId','select',$_conds));
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
				$_reqs = $this ->M_RawDataReport->_getCampaign($v); 	
			}
			return $_reqs; 	
		}
		
	}
?>