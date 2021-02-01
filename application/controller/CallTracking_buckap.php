<?php
	Class CallTracking Extends EUI_Controller
	{
		Public Function CallTracking()
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
								'report_campaign' => $this -> {base_class_model($this)} -> _get_campaign(),
								'report_recsource' => $this -> {base_class_model($this)} -> _get_recsource(),
								'report_spv' => $this -> {base_class_model($this)} -> _get_spv(),
								'report_tmr' => $this -> {base_class_model($this)} -> _get_tmr(),
								'report_mode' => $this -> {base_class_model($this)} -> _get_mode()
							);
				$this -> load -> view('call_tracking/view_call_tracking_nav',$EUI);
			}
		}
		
		Public Function LoadRecsource()
		{
			$a = $this -> {base_class_model($this)} -> _get_recsource($_REQUEST['Campaign']);
			
			if($this->URI->_get_have_post('Campaign')) {
				__(form()->listCombo('Recsource','select tolong',  $a ));
			} else {
				__(form()->combo('Recsource','select long', array(), null, null ));
			}
		}
		
		Public Function Load1()
		{
			$a = $this -> {base_class_model($this)} -> _get_spv();
			
			if($this->URI->_get_post('group_type') == 1) {
				__(form()->combo('spvId','select tolong', $a, null, array("change" => "Ext.DOM.LoadTMO(this)") ));
			} else if($this->URI->_get_post('group_type') == 2) {
				// __(form()->combo('spvId','select tolong', $a, null, array("change" => "Ext.DOM.LoadTMO(this)") ));
				__(form()->listCombo('spvId','select tolong', $a));
			} else if($this->URI->_get_post('group_type') == 3){
				// __(form()->combo('spvId','select long', array(), null, null ));
				__(form()->listCombo('spvId','select tolong', $a));
			}
		}
		
		Public Function LoadTMO()
		{
			$a = $this -> {base_class_model($this)} -> _get_tmr($_REQUEST['spvId']);
			
			if( $this -> URI -> _get_have_post('group_type') AND $this -> URI -> _get_post('group_type')!='' ) {
				if($this->URI->_get_post('group_type') == 1 ) {
					__(form()->listCombo('TmrId','select tolong', $a ));
				}
			} else {
				__(form()->combo('TmrId','select long', array() ));
			}
		}
		
		Public Function ShowReport()
		{
			if( $this->EUI_Session->_have_get_session('UserId') )
			{
				if($this->URI->_get_post('group_type') == 3){
					$LoopUser = $this->{base_class_model($this)}->_get_recsource($this->URI->_get_post('Campaign'));
				}else{
					$LoopUser = $this->{base_class_model($this)}->_getLoop();
				}
				$EUI = array (
					'LoopUser' => $LoopUser,
					'LoopDL' => $this->{base_class_model($this)}->_getDL(),
					'RowData1' => $this->{base_class_model($this)}->_getRowData1(),
					'RowData2' => $this->{base_class_model($this)}->_getRowData2(),
					'RowData3' => $this->{base_class_model($this)}->_getRowData3(),
					'RowData4' => $this->{base_class_model($this)}->_getRowData4(),
					'product' => $this->{base_class_model($this)}->_get_campaign(),
					'amount'   => $this->{base_class_model($this)}->_get_amount_percampaign(_get_post('Campaign')),
					'param' => $this->URI->_get_all_request()
				);
				
				// echo "<pre>";
				// print_r($EUI['RowData1']);
				// echo "</pre>";
				
				if($this->URI->_get_post('group_type') == 1) {
					$this->load->view("call_tracking/view_call_tracking_tmr",$EUI);
				} elseif($this->URI->_get_post('group_type') == 2) {
					$this->load->view("call_tracking/view_call_tracking_spv",$EUI);
				} elseif($this->URI->_get_post('group_type') == 3) {
					$this->load->view("call_tracking/view_call_tracking_recsource",$EUI);
				}
			}
		}
		
		Public Function ShowExcel()
		{
			if( $this->EUI_Session->_have_get_session('UserId') )
			{
				// Excel()->HTML_Excel(get_class($this).''.time());
				
				$this->load->helper('EUI_ExcelWorksheet');
				$EUI = array (
					'LoopUser' => $this->{base_class_model($this)}->_getLoop(),
					'LoopDL'   => $this->{base_class_model($this)}->_getDL(),
					'RowData1' => $this->{base_class_model($this)}->_getRowData1(),
					'RowData2' => $this->{base_class_model($this)}->_getRowData2(),
					'RowData3' => $this->{base_class_model($this)}->_getRowData3(),
					'RowData4' => $this->{base_class_model($this)}->_getRowData4(),
					'product'  => $this->{base_class_model($this)}->_get_campaign(),
					'amount'   => $this->{base_class_model($this)}->_get_amount_percampaign(_get_post('Campaign')),
					'param' => $this->URI->_get_all_request()
					// 'RowData4' => $this->{base_class_model($this)}->_getRowData4()
				);
				
				if($this->URI->_get_post('group_type') == 1) {
					$this->load->view("call_tracking/view_call_tracking_tmr_excel",$EUI);
				} elseif($this->URI->_get_post('group_type') == 2) {
					$this->load->view("call_tracking/view_call_tracking_spv_excel",$EUI);
				}
				// echo "export";
				// $this->load->view("call_tracking/view_call_tracking_tmr");
			}
		}
	}
?>