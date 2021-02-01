<?php
	class QAQualityAssuranceReport extends EUI_Controller
	{
		function QAQualityAssuranceReport()
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
			
			$this->load->view('rpt_QA_Quality_Assurance/rpt_QA_Quality_Assurance_nav',$UI);
		}
		
		public function GroupFilterBy()
		{
			if($this -> URI -> _get_have_post('FilterId'))
			{
				__(form()->combo('spvname','select long', $this->M_QAQualityAssuranceReport->_getAtmBaru(), null, array("change" => "Ext.DOM.ListTL(this)") ));
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
				$d  = $this->M_QAQualityAssuranceReport->_getSPVBaru($_REQUEST['FilterId']);
				__(form()->combo('tlname','select long',$d, null, array("change" => "Ext.DOM.ListTSR(this)") ));
			}
			else
			{
				__(form()->combo('tlname','select long', array(), null ));
			}
		}
		
		public function GroupFilterTSR($spv)
		{
			if($this -> URI -> _get_have_post('FilterId'))
			{
				$a = $this->M_QAQualityAssuranceReport->_getTSRBaru($_REQUEST['FilterId']);
				__(form()->listCombo('tsrname', null, $a ));
			}
			else
			{
				__(form()->combo('tsrname','select long', array(), null ));
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
			$UI = array
			(
				'view_atm' 	=> $this -> {base_class_model($this)} -> _getAtm($this -> _POST()),
				'view_spv' 	=> $this -> {base_class_model($this)} -> _getSPV($this -> _POST()),
				'view_agent' 	=> $this -> {base_class_model($this)} -> _getAgent($this -> _POST()),
				'view_monitor' 	=> $this -> {base_class_model($this)} -> _getMonitor($this -> _POST()),
				'view_score' 	=> $this -> {base_class_model($this)} -> _getScore($this -> _POST()),
				'view_question' => $this -> {base_class_model($this)} -> Question($this -> _POST()),
				'view_bandot' 	=> $this -> {base_class_model($this)} -> getSummaryApprove($this -> _POST()),
				'param' => $this -> _POST(), 
				'Users' => $this ->_CAMPAIGN()
			);
			$this -> load -> view("rpt_QA_Quality_Assurance/rpt_QA_Quality_Assurance_show", $UI);
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
				'view_monitor' 	=> $this -> {base_class_model($this)} -> _getMonitor($this -> _POST()),
				'view_score' 	=> $this -> {base_class_model($this)} -> _getScore($this -> _POST()),
				'view_question' => $this -> {base_class_model($this)} -> Question($this -> _POST()),
				'view_bandot' 	=> $this -> {base_class_model($this)} -> getSummaryApprove($this -> _POST()),
				'param' => $this -> _POST(), 
				'Users' => $this ->_CAMPAIGN()
			);
			$this -> load -> view("rpt_QA_Quality_Assurance/rpt_QA_Quality_Assurance_download", $UI);
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
				$_reqs[$v] = $this ->M_QAQualityAssuranceReport->filter_by($v); 	
			}
			return $_reqs; 	
		}
	}
?>