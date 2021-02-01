<?php
    Class ReportPDS Extends EUI_Controller
    {
        Public Function ReportPDS()
        {
            parent::__construct();  
            $this -> load -> model(array(base_class_model($this)));
        }
        
        Public Function index()
        {
            if( $this -> EUI_Session -> _have_get_session('UserId') )
            {   
                $EUI = array(
                    // 'report_type' => $this -> {base_class_model($this)} -> _get_type(),
                    'report_campaign' => $this -> {base_class_model($this)} -> _get_campaign(),
                    'report_recsource' => $this -> {base_class_model($this)} -> _get_recsource()
                    // 'report_spv' => $this -> {base_class_model($this)} -> _get_spv(),
                    // 'report_tmr' => $this -> {base_class_model($this)} -> _get_tmr(),
                    // 'report_mode' => $this -> {base_class_model($this)} -> _get_mode()
                );
                $this -> load -> view('pds_report/view_pds_report_nav',$EUI);
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
            
            if($this->URI->_get_post('group_type') == 1) {
                // __(form()->combo('spvId','select tolong', $a, null, array("change" => "Ext.DOM.LoadTMO(this)") ));
                __(form()->listCombo('spvId','select tolong', $a, null, array("change" => "Ext.DOM.LoadTMO(this)") ));
            } else if($this->URI->_get_post('group_type') == 2) {
                // __(form()->combo('spvId','select tolong', $a, null, array("change" => "Ext.DOM.LoadTMO(this)") ));
                __(form()->listCombo('spvId','select tolong', $a));
            } else if($this->URI->_get_post('group_type') == 3) {
                __(form()->combo('spvId','select tolong', $a, null, array("change" => "Ext.DOM.LoadTMO(this)") ));
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
                }else if($this->URI->_get_post('group_type') == 3 ) {
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
                // echo $this->EUI_Session->_get_session('UserId');
                $EUI = array (
                    'PDSData' => $this->{base_class_model($this)}->_getPDSData(),
                    'param' => $this->URI->_get_all_request()
                );
                
				$this->load->view("pds_report/view_pds_report_recsource",$EUI);
            }
        }
        
        Public Function ShowExcel()
        {
            if( $this->EUI_Session->_have_get_session('UserId') )
            {
                // Excel()->HTML_Excel(get_class($this).''.time());
                // print_r($LoopUser);
                $this->load->helper('EUI_ExcelWorksheet');
                $EUI = array (
                    'PDSData' => $this->{base_class_model($this)}->_getPDSData(),
                    'param' => $this->URI->_get_all_request()
                );
                
                $this->load->view("pds_report/view_pds_report_recsource_xls",$EUI);
            }
        }
    }
?>