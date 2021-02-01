<?php
    class M_QaApprovalList extends EUI_Model
    {
        private static $Instance = null;
           
        function M_QaApprovalList()
        {
            parent::__construct();
            $this->load->model(array('M_SysUser','M_SetResultQuality','M_SetCallResult','M_MaskingNumber'));
        }
       
        public static function &Instance()
        {
            if( is_null(self::$Instance) ) {
                self::$Instance = new self();
            }
            return self::$Instance;
        }
       
        /**
         * (F) _get_default description]
         * @query-mssql  [OK]
         */
        function _get_default()
        {
            $out = new EUI_Object(_get_all_request());
            $cond1 = " IF(a.CampaignId = 9, flex.vartiering < 100, (TRUE))";
            $cond2 = " IF(a.CampaignId = 5, xsel.vartiering < 100, (TRUE))";
            $cond3 = " IF(a.CampaignId = 5, xsel.vartiering < 100, (TRUE))";
     
            // mode mssql
            if( QUERY == 'mssql') {
                $cond1 = " (a.CampaignId = 9 OR flex.vartiering < 100)";
                $cond2 = " (a.CampaignId = 5 OR xsel.vartiering < 100)";
                $cond3 = " (a.CampaignId = 1012 OR flexs.vartiering < 99)";
                $cond4 = " (a.CampaignId = 1 OR a.CampaignId = 2 OR a.CampaignId = 3 OR a.CampaignId = 4 OR a.CampaignId = 16 OR a.CampaignId = 17 OR a.CampaignId = 20 OR cip.LoansVar < 100)";
            }
     
            $this->EUI_Page->_setPage(10);
            $this->EUI_Page->_setCount(true);
            $this->EUI_Page->_setSelect("count(a.CustomerId) as tot");
            $this->EUI_Page->_setFrom("t_gn_customer a");
            $this->EUI_Page->_setJoin("t_gn_assignment b ","a.CustomerId=b.CustomerId", "INNER");
            $this->EUI_Page->_setJoin("t_gn_campaign d "," a.CampaignId=d.CampaignId", "LEFT");
            $this->EUI_Page->_setJoin("t_gn_frm_flexi flex "," a.CustomerId = flex.CustomerId", "LEFT");
            $this->EUI_Page->_setJoin("t_gn_frm_flexi_single flexs "," a.CustomerId = flex.CustomerId", "LEFT");
            $this->EUI_Page->_setJoin("t_gn_frm_pil_xsel xsel "," a.CustomerId = xsel.CustomerId", "LEFT");
            $this->EUI_Page->_setJoin("t_gn_frm_cip cip "," a.CustomerId = cip.CustomerId", "LEFT");
            $this->EUI_Page->_setJoin("t_lk_aprove_status e "," a.CallReasonQue=e.ApproveId", "LEFT");
            $this->EUI_Page->_setJoin("t_lk_callreason f "," a.CallReasonId = f.CallReasonId", "LEFT",TRUE);
     
            $this->EUI_Page->_setAnd("f.CallReasonEvent", 1, TRUE);
            $this->EUI_Page->_setAnd("(e.ConfirmFlags = 1 or e.AproveFlags=0)", FALSE);
           
            $this->EUI_Page->_setAnd("{$cond1}");
            $this->EUI_Page->_setAnd("{$cond2}");
            $this->EUI_Page->_setAnd("{$cond3}");
            $this->EUI_Page->_setAnd("{$cond4}");
            $this->EUI_Page->_setAnd("a.CampaignId <> 6");
            $this->EUI_Page->_setAndCache("a.CampaignId", "src_campaign_name", true);
            $this->EUI_Page->_setAndCache("a.GenderId", "src_gender", true);
            $this->EUI_Page->_setAndCache("b.AssignSelerId", "src_user_agent", true);
            $this->EUI_Page->_setLikeCache("a.CustomerNumber", "src_customer_cif", true);
            $this->EUI_Page->_setAndCache("a.CustomerNumber", "src_customer_number", true);
            $this->EUI_Page->_setLikeCache("a.CustomerFirstName", "src_cust_name", true);
            $this->EUI_Page->_setWhereinCache("a.Recsource", "src_customer_recsource", true);
            $this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs>='". StartDate(_get_post('src_start_date')) ."'", 'src_start_date', true);
            $this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs<='". EndDate(_get_post('src_end_date')) ."'", 'src_end_date', true);
           
            #var_dump($this->EUI_Page->_getCompiler());die();
            return $this->EUI_Page;
        }
       
        /**
         * (F)_get_content
         * @query-mssql  [OK]
         */
        function _get_content()
        {
            $out = new EUI_Object(_get_all_request());
            $this->EUI_Page->_postPage(_get_post('v_page') );
            $this->EUI_Page->_setPage(10);
       
            $conds1 = " IF(a.QaProsess<>0, 'YES', 'NO') as QaProsess ";
            $conds2 = " IF(a.QaProsess<>0, (select ag.init_name from tms_agent ag where ag.UserId = a.QaProsessBy), '-') as ProsesBy ";
            $conds3 = " IF(a.CampaignId = 9, flex.vartiering < 100, (TRUE)) ";
            $conds4 = " IF(a.CampaignId = 5, xsel.vartiering < 100, (TRUE))";
     
            // mode mssql
            if( QUERY == 'mssql') {
                $conds1 = " CASE WHEN a.QaProsess<>0 THEN 'YES' ELSE 'NO' END AS QaProsess ";
                $conds2 = " CASE WHEN a.QaProsess<>0 THEN (select ag.init_name from tms_agent ag where ag.UserId = a.QaProsessBy) ELSE '-' END AS ProsesBy ";
                $conds3 = " (xsel.vartiering < 100 OR up.vartiering < 100 OR flex.vartiering < 100 OR cip.LoansVar < 100 OR flexs.vartiering < 99) ";
                //$conds4 = " (a.CampaignId = 5 OR xsel.vartiering < 100) ";
                // $conds4 = " (a.CampaignId = 1 OR a.CampaignId = 2 OR a.CampaignId = 3 OR a.CampaignId = 4 OR a.CampaignId = 16 OR a.CampaignId = 17 OR a.CampaignId = 20 OR cip.LoansVar < 100)";
            }
     
            $this->EUI_Page->_setArraySelect(array(
                "a.CustomerId as CustomerId" => array("CustomerId","CustomerId","primary"),
                "d.CampaignName as CampaignName" => array("CampaignName","Campaign Name"),
                "a.Recsource as Recsource" => array("Recsource", "Recsource"),
                "a.CustomerFirstName as CustomerName" => array("CustomerName","Customer Name"),
                // "a.CustomerCity as CustomerCity" => array("CustomerCity", "City"),
                // "a.CustomerDOB as CustomerDOB" => array("CustomerDOB", "DOB"),
                // "a.CustomerDOB as CustomerAge" => array("CustomerAge", "Age"),
                "( select gd.GenderIndo from t_lk_gender gd where gd.GenderId=a.GenderId) as Gender" => array("Gender", "Gender"),
                "( select ag.init_name from tms_agent ag where ag.UserId = b.AssignSelerId ) as UserId" => array("UserId", "Agent ID"),
                "(select ag.init_name from tms_agent ag where ag.UserId = b.AssignSpv) as Supervisor" => array("Supervisor", "Supervisor"),
                "e.AproveName as CallResult" => array("CallResult", "Approve Status"),
               
                "e.AproveName as CallResult" => array("CallResult", "Approve Status"),
               
                "{$conds1}" => array("QaProsess", "Follow Up QA"),
                "{$conds2}" => array("ProsesBy", "Follow Up By"),
               
                "a.CustomerUpdatedTs as CustomerUpdatedTs" => array("CustomerUpdatedTs", "Last Call Date")
            ));
            $this->EUI_Page->_setFrom("t_gn_customer a");
            $this->EUI_Page->_setJoin("t_gn_assignment b ","a.CustomerId=b.CustomerId", "INNER");
            $this->EUI_Page->_setJoin("t_gn_campaign d "," a.CampaignId=d.CampaignId", "LEFT");
            $this->EUI_Page->_setJoin("t_lk_aprove_status e "," a.CallReasonQue=e.ApproveId", "LEFT");
            $this->EUI_Page->_setJoin("t_gn_frm_flexi flex "," a.CustomerId = flex.CustomerId", "LEFT");
            $this->EUI_Page->_setJoin("t_gn_frm_flexi_single flexs "," a.CustomerId = flexs.CustomerId", "LEFT");
            $this->EUI_Page->_setJoin("t_gn_frm_pil_xsel xsel "," a.CustomerId = xsel.CustomerId", "LEFT");
            $this->EUI_Page->_setJoin("t_gn_frm_pil_topup up "," a.CustomerId = up.CustomerId", "LEFT");
            $this->EUI_Page->_setJoin("t_gn_frm_cip cip "," a.CustomerId = cip.CustomerId", "LEFT");
            $this->EUI_Page->_setJoin("t_lk_callreason f "," a.CallReasonId = f.CallReasonId", "LEFT", TRUE);
            $this->EUI_Page->_setAnd("f.CallReasonEvent", 1, TRUE);
            $this->EUI_Page->_setAnd("(e.ConfirmFlags = 1 or e.AproveFlags=0)", FALSE);
           
            $this->EUI_Page->_setAnd("{$conds3}");
            // $this->EUI_Page->_setAnd("{$conds4}");
            //$this->EUI_Page->_setAnd("a.CampaignId <> 6");
            $this->EUI_Page->_setAndCache("a.CampaignId", "src_campaign_name", true);
            $this->EUI_Page->_setAndCache("a.GenderId", "src_gender", true);
            $this->EUI_Page->_setAndCache("b.AssignSelerId", "src_user_agent", true);
            $this->EUI_Page->_setLikeCache("a.CustomerNumber", "src_customer_cif", true);
            $this->EUI_Page->_setAndCache("a.CustomerNumber", "src_customer_number", true);
            $this->EUI_Page->_setLikeCache("a.CustomerFirstName", "src_cust_name", true);
            $this->EUI_Page->_setWhereinCache("a.Recsource", "src_customer_recsource", true);
            $this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs>='". StartDate(_get_post('src_start_date')) ."'", 'src_start_date', true);
            $this->EUI_Page->_setAndOrCache("a.CustomerUpdatedTs<='". EndDate(_get_post('src_end_date')) ."'", 'src_end_date', true);
           
            if( _get_have_post("order_by") ){
                $this->EUI_Page->_setOrderBy(_get_post("order_by"), _get_post("type"));
            } else {
                $this->EUI_Page->_setOrderBy("a.CustomerId", "DESC");
            }
            // var_dump($this->db->last_query());
            // echo $this->EUI_Page->_getCompiler();die();
     
            // -----------then limit on here ---------------------------------
            $this->EUI_Page->_setLimit();
        }
       
        function _get_resource()
        {
            self::_get_content();
            if( $this -> EUI_Page -> _get_query()!='')
            {
                return $this -> EUI_Page -> _result();
            }
        }
       
        function _get_page_number()
        {
            if( $this -> EUI_Page -> _get_query()!='' ) {
                return $this -> EUI_Page -> _getNo();
            }  
        }
       
       
        public function _set_row_update_followup( $out  = null )
        {
            if( !$out->fetch_ready() )
            {
                return FALSE;
            }
           
            // --------- second argument -----------.
            $this->db->reset_select();
            $this->db->select("QaProsessBy", FALSE);
            $this->db->from("t_gn_customer");
            $this->db->where("CustomerId", $out->get_value('CustomerId'));
            // $this->db->where("QaProsessBy",_get_session('UserId'));
            $this->db->where("QaProsess",1);
            $rs = $this->db->get();
            if( $rs->num_rows() > 0 )
            {
                $cond = (int)$rs->result_singgle_value();  
            }    
            // var_dump($cond);
            if( $cond ) {
                if($cond==_get_session('UserId'))
                {
                    return TRUE;
                }
                else{
                    return FALSE;
                }
            }
           
            // --------- clear cache ----------------------------------------
     
            $this->db->reset_write();
            $this->db->where("CustomerId", $out->get_value('CustomerId'), false);
            $this->db->set("QaProsessTs",date('Y-m-d H:i:s'),true);
            $this->db->set("QaProsessBy",_get_session('UserId'),false);
            $this->db->set("QaProsess",1,true);
            $this->db->update("t_gn_customer");
     
     
            // --------------- ok --------------------------------
            if( $this->db->affected_rows() > 0 ){
                return TRUE;   
            }    
     
            return FALSE;
     
        }
     
    // ---------------------------------------------------------------------------------------------------------
    /*
     * @ package        set follow flag if user click detail data
     *
     */
     
        public function _unset_row_update_followup( $out  = null )
        {
            if( !$out->fetch_ready() )
            {
                return FALSE;
            }
     
            // --------- clear cache ----------------------------------------
            $this->db->reset_write();
     
            $this->db->where("CustomerId", $out->get_value('CustomerId'), false);
            $this->db->where("QaProsess",1,true);
     
            $this->db->set("QaProsessTs",null,true);
            $this->db->set("QaProsessBy",null,true);
            $this->db->set("QaProsess",0,true);
            $this->db->update("t_gn_customer");
     
            // --------------- ok --------------------------------
     
            if( $this->db->affected_rows() > 0 ){
                return TRUE;   
            }else {
                return FALSE;
            }
        }
       
        function _get_result_param($out = null)
        {
            $datas = array();
           
            $sql = "select ParamCode, ParamResult from t_gn_approval_result
                    where 1=1 and CustomerId='".$out->get_value('CustomerId')."'";
            $qry = $this->db->query($sql);
           
            if($qry->num_rows()>0)
            {
                foreach($qry->result_assoc() as $rows)
                {
                    $datas[$rows['ParamCode']] = $rows['ParamResult'];
                }
            }
           
            return $datas;
        }
       
        function _get_agent_name($cust_id)
        {
            $name = "";
           
            $sql = "select c.id from t_gn_assignment b
                    left join tms_agent c on b.AssignSelerId = c.UserId
                    where b.CustomerId = '".$cust_id."'";
            $qry = $this->db->query($sql);
           
            if($qry->num_rows()>0)
            {
                $name = $qry->result_singgle_value();
            }
           
            return $name;
        }
       
        function _set_row_save_activity_call($out = null)
        {
            if(!define('NOT_VERIFY',2)) define('NOT_VERIFY',2);
           
            if( !$out->fetch_ready() OR !_get_is_login() )   
            {
                return (bool)FALSE;
            }
             
            // ---- Call object --------------------------------------------------------------
             
            $obOut   =& get_class_instance('M_SysUser');
            $obUsr   =& Objective($obOut->_getUserDetail(_get_session('UserId')));
            $obTls   =& Objective($obOut->_getUserDetail($obUsr->get_value('tl_id')));
            $obAtm   =& Objective($obOut->_getUserDetail($obUsr->get_value('spv_id')));
             
            $obAmgr  =& Objective($obOut->_getUserDetail($obUsr->get_value('act_mgr')));
            $obMgr   =& Objective($obOut->_getUserDetail($obUsr->get_value('mgr_id')));
            $obAdmin =& Objective($obOut->_getUserDetail($obUsr->get_value('admin_id')));
           
            // var_dump($out->get_value('ApproveStatus','intval'));die();
            $this->db->reset_write();
     
            $this->db->set('CustomerId',$out->get_value('CustomerId','intval'));
            $this->db->set('CallHistoryNotes', $out->get_value('call_remarks','strtoupper'));
            $this->db->set('ApprovalStatusId', $out->get_value('ApproveStatus','intval'));
            $this->db->set('CreatedById',$obUsr->get_value('UserId','intval'));
            $this->db->set('CallReasonId',$out->get_value('CallResult','intval'));
            $this->db->set('AgentCode',$obUsr->get_value('Username',array('evalute','strtoupper')));
            $this->db->set('SPVCode',$obTls->get_value('Username',array('evalute','strtoupper')),true);
            $this->db->set('ATMCode',$obAtm->get_value('Username',array('evalute','strtoupper')),true);
            $this->db->set('AMGRCode',$obAmgr->get_value('Username',array('evalute','strtoupper')),true);
            $this->db->set('MGRCode',$obMgr->get_value('Username',array('evalute','strtoupper')),true);
            $this->db->set('ADMINCode',$obAdmin->get_value('Username',array('evalute','strtoupper')),true);
            // $this->db->set('EmailTemp', $out->get_value('CustomerEmail'));
            $this->db->set('HistoryType',QUALITY_ACTIVITY);
     
            $this->db->set('CallHistoryCallDate',date('Y-m-d H:i:s'));
            $this->db->set('CallHistoryCreatedTs',date('Y-m-d H:i:s'));
            $this->db->insert('t_gn_callhistory');
           
            // var_dump($this->db->affected_rows());die();
     
            if( $this->db->affected_rows() )
            {
                $CallHistoryId = $this->db->insert_id();
            }
           
            if($CallHistoryId)
            {
                $this->db->reset_write();
               
                $this->db->set('QueueId',$obUsr->get_value('UserId','intval'));
                $this->db->set('CallReasonQue',$out->get_value('ApproveStatus','intval'));
                $this->db->set('CustomerRejectedDate',date('Y-m-d H:i:s'));
                $this->db->where('CustomerId',$out->get_value('CustomerId'));
                $this->db->update('t_gn_customer');
               
                if( $this->db->affected_rows()>0 )
                {
                    if( $out->get_value('ApproveStatus','intval')==NOT_VERIFY )
                    {
                        $this->db->reset_write();
                        $message = "COBAIN";
                       
                        $this->db->insert('tms_agent_chat',array( // row #0
                            'from' => _get_session('Username'),
                            'to' => $this->_get_agent_name($out->get_value('CustomerId')),
                            'message' => $message,
                            'sent' => date('Y-m-d H:i:s'),
                            'recd' => 0,
                        ));
                    }
     
                    return (bool)true;
                }
            }
           
            return (bool)false;
        }
    }
?>

