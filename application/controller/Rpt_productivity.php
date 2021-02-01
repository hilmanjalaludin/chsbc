<?php
	Class Rpt_productivity Extends EUI_Controller
	{
		Public Function Rpt_productivity()
		{
			parent::__construct();	
			$this -> load -> model(array(base_class_model($this)));
		}
		
		Public Function index()  
		{
			if( $this -> EUI_Session -> _have_get_session('UserId') )
			{	
				$EUI = array(
								'report_type' => $this -> {base_class_model($this)} -> _get_type(),
								'report_spv' => $this -> {base_class_model($this)} -> _get_spv(),
								'report_campaign' => $this -> {base_class_model($this)} -> _get_campaign(),
								'report_mode' => $this -> {base_class_model($this)} -> _get_mode()
							);
				$this -> load -> view('rpt_productivity/rpt_productivity_nav',$EUI);
			}
		}
		
		Public Function LoadRecsource()
		{
			$a = $this -> {base_class_model($this)} -> _get_recsource($_REQUEST['Campaign']);
			$a = $this -> {base_class_model($this)} -> _get_recsource(_get_post('Campaign'));
			
			if($this->URI->_get_have_post('Campaign')) {
				__(form()->listCombo('Recsource','select tolong',  $a ));
			} else {
				__(form()->combo('Recsource','select long', array(), null, null ));
			}
		}
		
		Public Function Load1()
		{
			$a = $this -> {base_class_model($this)} -> _get_spv();
			
			if($this->URI->_get_post('group_type') == 1 OR $this->URI->_get_post('group_type') == 4) {
				__(form()->listCombo('spvId','select tolong', $a, null, array("change" => "Ext.DOM.LoadTMO(this)") ));
			} else if($this->URI->_get_post('group_type') == 2 OR $this->URI->_get_post('group_type') == 3) {
				__(form()->listCombo('spvId','select tolong', $a));
			} else {
				__(form()->combo('spvId','select long', array(), null, null ));
			}
		}
		
		Public Function LoadTMO()
		{
			$a = $this -> {base_class_model($this)} -> _get_tmr($_REQUEST['spvId']);
			
			if( $this -> URI -> _get_have_post('group_type') AND $this -> URI -> _get_post('group_type')!='' ) {
				if($this->URI->_get_post('group_type') == 1 ) {
					__(form()->listCombo('TmrId','select tolong', $a ));
				}else if($this->URI->_get_post('group_type') == 4 ) {
					__(form()->listCombo('TmrId','select tolong', $a ));
				}
			} else {
				__(form()->combo('TmrId','select long', array() ));
			}
		}
		
		Public Function ShowReport()
		{
			if($this->URI->_get_post('group_type') == 1)
			{
				$EUI = array
				(
					'LoopUser' => $this->{base_class_model($this)}->_getLoop(),
					'LoopCamp' => $this->{base_class_model($this)}->_getLoopCamp(),
					'RptTmr' => $this->{base_class_model($this)}->_getRptTmr($this -> _POST()),
					'amount' => $this->{base_class_model($this)}->_get_amount_percampaign(_get_post('Campaign')),
					'param' => $this->URI->_get_all_request()
				);
				$this->load->view("rpt_productivity/rpt_productivity_tmr",$EUI);
			} else if($this->URI->_get_post('group_type') ==2)
			{
				$EUI = array
				(
					'LoopUser' => $this->{base_class_model($this)}->_getLoop(),
					'LoopCamp' => $this->{base_class_model($this)}->_getLoopCamp(),
					'RptSpv' => $this->{base_class_model($this)}->_getRptSpv($this -> _POST()),
					'amount' => $this->{base_class_model($this)}->_get_amount_percampaign(_get_post('Campaign')),
					'param' => $this->URI->_get_all_request()
				);
				$this->load->view("rpt_productivity/rpt_productivity_spv",$EUI);
			} else if($this->URI->_get_post('group_type') ==3)
			{
				$EUI = array
				(
					'LoopUser' => $this->{base_class_model($this)}->_getLoop(),
					'RowData1' => $this->{base_class_model($this)}->_getRowData1(),
					'RowData2' => $this->{base_class_model($this)}->_getRowData2(),
					'RowData3' => $this->{base_class_model($this)}->_getRowData3(),
					'RowData4' => $this->{base_class_model($this)}->_getRowData4(),					
					'param' => $this->URI->_get_all_request()
				);
				$this->load->view("rpt_productivity/rpt_productivity_recsource",$EUI);
			}
		}
		
		Public Function ShowExcel()
		{
			if( $this -> EUI_Session -> _have_get_session('UserId') )
			{
				if($this->URI->_get_post('group_type')==3 OR $this->URI->_get_post('group_type') ==4) {
					$this->load->helper('EUI_ExcelWorksheet');
					$EUI = array (
						'LoopUser' => $this->{base_class_model($this)}->_getLoop(),
						'RowData1' => $this->{base_class_model($this)}->_getRowData1(),
						'RowData2' => $this->{base_class_model($this)}->_getRowData2(),
						'RowData3' => $this->{base_class_model($this)}->_getRowData3(),
						'RowData4' => $this->{base_class_model($this)}->_getRowData4(),
						'param' => $this->URI->_get_all_request()
					);				
				} elseif($this->URI->_get_post('group_type')==1 OR ($this->URI->_get_post('group_type')==2)) {
					
					Excel() -> HTML_Excel(get_class($this).''.time());
					$EUI = array (
						'getProductivity' => $this->{base_class_model($this)}->_getProductivity(),
						'param' => $this->URI->_get_all_request()
					);
				}
				
				if($this->URI->_get_post('group_type') == 1) {
					$this->load->view("rpt_productivity/rpt_productivity_tmr_excel",$EUI);
				}else if($this->URI->_get_post('group_type') == 2) {
					$this->load->view("rpt_productivity/rpt_productivity_spv_excel",$EUI);
				}else if($this->URI->_get_post('group_type') == 3) {
					$this->load->view("rpt_productivity/rpt_productivity_recs_excel",$EUI);
				}else if($this->URI->_get_post('group_type') == 4) {
					$this->load->view("rpt_productivity/rpt_productivity_recs_tmr_excel",$EUI);
				}
			}
		}
		
	}
?>