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
                    'LoopUser' => $this->{base_class_model($this)}->_getLoop(),
                    'LoopRecs' => $this->{base_class_model($this)}->_getLooprecs($this->URI->_get_all_request()),
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
                // echo 'ASD';
                // print_r($EUI['RowData1']);
                // print_r($this->URI->_get_all_request());
                // echo _get_post('Campaign');
                // echo "</pre>";
                
                if($this->URI->_get_post('group_type') == 1) {
                    $this->load->view("call_tracking/view_call_tracking_tmr",$EUI);
                }else if($this->URI->_get_post('group_type') == 2) {
                    $this->load->view("call_tracking/view_call_tracking_spv",$EUI);
                }else if($this->URI->_get_post('group_type') == 3) {
                    $this->load->view("call_tracking/view_call_tracking_recsource",$EUI);
                }else if($this->URI->_get_post('group_type') == 4) {
                    $this->load->view("call_tracking/view_call_tracking_recsourceall",$EUI);
                }
            }
        }
        
        Public Function ShowExcel()
        {
            if( $this->EUI_Session->_have_get_session('UserId') )
            {
                // Excel()->HTML_Excel(get_class($this).''.time());
                $LoopUser = array();
                if($this->URI->_get_post('group_type') == 4){
                    $LoopUser = NULL;
                }else{
                    $LoopUser = $this->{base_class_model($this)}->_getLoop();
                }
                // print_r($LoopUser);
                $this->load->helper('EUI_ExcelWorksheet');
                $EUI = array (
                    'LoopUser' => $LoopUser,
                    'LoopRecs' => $this->{base_class_model($this)}->_getLooprecs($this->URI->_get_all_request()),
                    'LoopDL' => $this->{base_class_model($this)}->_getDL(),
                    'RowData1' => $this->{base_class_model($this)}->_getRowData1(),
                    'RowData2' => $this->{base_class_model($this)}->_getRowData2(),
                    'RowData3' => $this->{base_class_model($this)}->_getRowData3(),
                    'RowData4' => $this->{base_class_model($this)}->_getRowData4(),
                    'product'  => $this->{base_class_model($this)}->_get_campaign(),
                    'amount'   => $this->{base_class_model($this)}->_get_amount_percampaign(_get_post('Campaign')),
                    'param' => $this->URI->_get_all_request(),
                    'RowDataNull1' => $this->{base_class_model($this)}->_getRowDataNull1(),
                    'RowDataNull2' => $this->{base_class_model($this)}->_getRowDataNull2(),
                    'RowDataNull3' => $this->{base_class_model($this)}->_getRowDataNull3(),
                    'RowDataNull4' => $this->{base_class_model($this)}->_getRowDataNull4()
                );
                
                if($this->URI->_get_post('group_type') == 1) {
                    $this->load->view("call_tracking/view_call_tracking_tmr_excel",$EUI);
                }else if($this->URI->_get_post('group_type') == 2) {
                    $this->load->view("call_tracking/view_call_tracking_spv_excel",$EUI);
                }else if($this->URI->_get_post('group_type') == 3) {
                    $this->load->view("call_tracking/view_call_tracking_recsource_excel",$EUI);
                }else if($this->URI->_get_post('group_type') == 4) {
                    $this->load->view("call_tracking/view_call_tracking_recsourceall_excel",$EUI);
                }
                
                // echo "<pre>";
                // echo 'ASD';
                // print_r($EUI['amount']);
                // print_r($this->URI->_get_all_request());
                // echo _get_post('Campaign');
                // echo "</pre>";
                // echo "<pre>";
                // $RowData1 = array_merge($EUI['RowData1'],$EUI['RowDataNull1']);
                // echo "looper";
                // print_r($LoopUser);
                // print_r($EUI);
                // echo "<pre>";
                // echo "export";
                // $this->load->view("call_tracking/view_call_tracking_tmr");
            }
        }
    }
?>