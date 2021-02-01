<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_ModSaveActivity extends EUI_Model{

	var $approval_quality_code = '505';
	var $arrDispositionDataID = array();

	private static $Instance = null; 

	public static function &Instance(){
		if( is_null(self::$Instance) ){
			self::$Instance = new self();
		}
		return self::$Instance;
	}

	function __construct(){
		parent::__construct();
		$this->load->model(array( 'M_SysUser','M_SetResultQuality', 'M_SetCallResult', 'M_MaskingNumber'));
		/*
			@notes :   set nilai category yang akan di counter 
				   berdasarkan callresult yang di pilih oleh user 
				   pada saat save aktivitas.
		*/
	
		$this->arrDispositionDataID	= array(2,7);
	}
	
	protected function select_concat_call_back_later( $out = null ){
		$arr_callback_hour  = array(
			$out->get_value('hour_call_later', 'trim'), 
			$out->get_value('minute_call_later', 'trim')
		);

		$arr_callback_later = array ( 
			$out->get_value('date_call_later', '_getDateEnglish'),
			join(":", $arr_callback_hour)
		);	

		if(  $arr_callback_later ){
			return (string)join(" ", $arr_callback_later);
		}  
		return null;
	}

	public function getProductSummary( $CustomerId = 0 ){
		$_productsum = array();
		
		$this ->db ->select('a.*');
		$this ->db ->from('t_lk_product_summary a');
		$this ->db ->join('t_gn_campaignproduct b','a.ProductId=b.ProductId','LEFT');
		$this ->db ->join('t_gn_customer c','c.CampaignId=b.CampaignId','LEFT');
		$this ->db ->where('c.CustomerId',$CustomerId);
		// echo $this->db->_get_var_dump();
		foreach( $this ->db-> get() -> result_assoc() as $rows ) {
			$_productsum[$rows['ProductSumId']] = $rows['Desc'];
		}
		return $_productsum;
	}
	 
	function QualityReconfirm(){
		$Confirm = null; $avail = null;
		$Confirm = $this -> M_SetResultQuality -> _getQualityConfirm();
		if(!is_null($Confirm))
		{
			$i = 0;
			foreach($Confirm as $KeyId => $rows ) 
			{
				$avail[$i] = $KeyId; 	
				$i++;
			}
		}
		
		// return 
		
		$_count = null;
		if( is_array($avail) )
		{
			$index  = count($avail)-1;
			$_count = $avail[$index];
		}
		
		return $_count;
	}

	protected function _select_row_approval_status( $out  = null, $obCrs = null, $obQty = null ){
		$arr_interest =(array)$obCrs->_getInterestSale();
		$arr_pending =(array)$obCrs->_getPendingInfo();

		// ----------- Approval ID ----------------------------------------------- 

		$arr_approvalid =$obQty->_getQualityStatusByCode( $this->approval_quality_code );
		$CallResult = $out->get_value('CallResult','trim');

		// ---------- Checking ----------------------------------------------------

		if( ($CallResult) AND @in_array($CallResult, array_keys( $arr_interest) ) ){
			if( !$arr_approvalid ){
				return 1;
			}
			if(!in_array($CallResult, array_keys($arr_pending)) ) {
				return (int)$arr_approvalid;
			}
			return 0;
		}
		return 0;
	}
	
	public function _select_call_level_status( $Status = 0 ){
		$status = 0;
		$this->db->reset_select();
		$this->db->select("a.CallReasonLevel", false); 
		$this->db->from("t_lk_callreason a ");
		$this->db->where("a.CallReasonId", $Status);	
		$rs = $this->db->get();
		if( $rs->num_rows() > 0 ) {
			$status = (int)$rs->result_singgle_value();
		}
		return (int)$status;	 
	}
	
	public function _select_call_hirarki_status( $BeforeStatus = 0, $NextStatus = 0 ){
		$before_status = $this->_select_call_level_status( $BeforeStatus );
		$next_status  = $this->_select_call_level_status( $NextStatus );

		if( in_array($before_status, array(99)) ){
			return (int)$NextStatus;
		}	 

		if( $next >= $before AND $next!=0 ) {
			return (int)$NextStatus;
		}

		return (int)$BeforeStatus;	 
	}
	
	function _getCallHistory($CustomerId=null){
	  $_conds = array();
	  
		$this -> db ->select('*');
		$this -> db ->from('t_gn_callhistory a');
		$this -> db ->join('tms_agent b','a.CreatedById=b.UserId','left');
		$this -> db ->join('t_lk_callreason c','a.CallReasonId=c.CallReasonId','left');
		$this -> db ->join('t_lk_callreasoncategory d','c.CallReasonCategoryId=d.CallReasonCategoryId','left');
		$this -> db ->join('t_lk_aprove_status e','a.ApprovalStatusId=e.ApproveId','left');
		$this -> db ->where('a.CustomerId', $CustomerId);
		$this -> db ->order_by('a.CallHistoryId', 'DESC');
		
		$i = 0;
		foreach($this -> db ->get() -> result_assoc() as $rows )
		{
			$_conds[$i] = $rows;
			$i++;
		}
		
		return $_conds;
	}

	function _select_call_before_status( $CustomerId = 0 ){
		$this->val = 0;
		$sql = sprintf("select a.CallReasonId from t_gn_customer a 
					   where a.CustomerId='%s'", $CustomerId);
		$qry = $this->db->query( $sql );

		#var_dump( $sql ); die();
		if( $qry && ( $qry->num_rows() > 0 ) ){
			$this->val = $qry->result_singgle_value();	
		}
		
		return $this->val;
	 }
	
	function _select_row_abandone_flags( $out = null ){
		 
		// jika data CustomerId ID Bernilai null maka ambil 
		$this->ret = 0;
		 
		 
		// jika data CustomerId ID Bernilai null maka ambil 
		// default HTTP Request .
		 
		 $callDispositionCustomerId = $out->field('CustomerId');
		 $sql = sprintf("select a.flag_abandon as val  from t_gn_customer a 
						 where a.CustomerId =%s", $callDispositionCustomerId);
		
		 #return ( $this->db->last_query() ); 
		 $qry = $this->db->query( $sql );
		 if( $qry && $qry->num_rows() > 0 ){
			 $this->ret = $qry->result_singgle_value();
		 }	
		 return intval($this->ret);	
	}
	
	function _getProductPreview(){
		$array  = array();
		if( $this -> URI -> _get_have_post('CustomerDOB') )
		{
			$CustomerDOB = 	$this -> URI ->_get_post('CustomerDOB');
			if(!empty($CustomerDOB)) 
			{
				$_weks = $this -> EUI_Tools->_DateDiff(date('Y-m-d', strtotime($CustomerDOB )), date('Y-m-d'));
				if( is_array($_weks) 
					AND isset($_weks['months_total'])  
					AND isset($_weks['months_total']))
				{
					$Month = (INT)$_weks['months_total'];
					$Day = (INT)$_weks['days_total'];
					
					if($_weks['months'] >= 6)
						$years = ($_weks['years']+1);
					else
						$years = $_weks['years'];
						
						
					// then process 
					
					$this -> db -> where("a.ProductPlanAgeStart>=", $years, FALSE);
					$this -> db -> where("a.ProductPlanAgeEnd<=", $years, FALSE);
				}
			}
		}
		
		// eg
		if( $this -> URI -> _get_have_post('ProductId') )
		{
			
			$ProductId = $this -> URI ->_get_post('ProductId');
			if( $ProductId ) 
			{
				$this -> db -> where("a.ProductId", $ProductId);
			}
		}
		
		// eg
		if( $this -> URI -> _get_have_post('GenderId') )
		{
			$GenderId = $this -> URI ->_get_post('GenderId');
			if( $GenderId ) 
			{
				$this -> db -> where("a.GenderId", $GenderId);
			}
		}
		
		
		if( $this -> URI->_get_have_post('ProductId') ) 
		{
			 $this -> db -> select("b.PremiumGroupName, c.Gender, d.PayMode, a.ProductPlanName, a.ProductPlanPremium"); 
			 $this -> db -> from ("t_gn_productplan a ");
			 $this -> db -> join("t_lk_premiumgroup b ","a.PremiumGroupId=b.PremiumGroupId","LEFT");
			 $this -> db -> join("t_lk_gender c ","a.GenderId=c.GenderId ","LEFT");
			 $this -> db -> join("t_lk_paymode d ","a.PayModeId=d.PayModeId","LEFT");
			 
			$num = 0;
			foreach( $this -> db -> get()->result_assoc() as $rows )
			{
				$array[$num] =  $rows;
				$num++;
			}
		}
		
		return $array;
	}
	
	protected function select_concat_call_back_2nd( $out = null ){
	   $arr_callback_hour  = array(
		 $out->get_value('hour_call_later_2nd', 'trim'), 
		 $out->get_value('minute_call_later_2nd', 'trim')
	  );	
	  
	  $arr_callback_later = array ( 
		 $out->get_value('date_call_later_2nd', '_getDateEnglish'),
		 join(":", $arr_callback_hour)
	 );	
	  
	 if(  $arr_callback_later ){
		 return (string)join(" ", $arr_callback_later);
	 }  
	 return null;
	 
	}

	function _getLowerLimit($Custno){
		$_conds = array();
		
		$sql = " SELECT a.CampaignId, b.vartiering AS xsel, c.vartiering AS flexi
				FROM t_gn_customer a
				LEFT JOIN t_gn_frm_pil_xsel b ON a.CustomerNumber = b.Custno
				LEFT JOIN t_gn_frm_flexi c ON a.CustomerNumber = c.Custno
				WHERE a.CustomerId = '".$Custno."'";
			// echo $sql; die(); 
		$qry = $this -> db -> query($sql);
		if( !$qry -> EOF() ) 
		{
			foreach( $qry -> result_assoc() as $rows )
			{
				if($rows['CampaignId']==5){
					$_conds[$rows['CampaignId']]=$rows['xsel'];
				}else if($rows['CampaignId']==9){
					$_conds[$rows['CampaignId']]=$rows['flexi'];
				}
			}
		}
		
		return $_conds;
	}

	function _getLowerLimitFlexiSingle($Custno){
		$_conds = array();
		
		$sql = " SELECT a.CampaignId, c.vartiering AS flexi
				FROM t_gn_customer a
				LEFT JOIN t_gn_frm_flexi_single c ON a.CustomerNumber = c.Custno
				WHERE a.CustomerId = '".$Custno."'";
			// echo $sql; die(); 
		$qry = $this -> db -> query($sql);
		if( !$qry -> EOF() ) 
		{
			foreach( $qry -> result_assoc() as $rows )
			{
				$_conds[$rows['CampaignId']]=$rows['flexi'];
			}
		}
		
		return $_conds;
	}
	
	//PDS
	function _updateAssignmentData($customerId){
		$AgentId = _get_session('UserId');
		$agentHrchy = $this->getAgentHrch($AgentId);
		$AssignId = $this->getAssignedID($customerId);
		$RemoteIp = _getIP();
		
		$this->db->reset_write();
		$this->db->where("CustomerId", $customerId);
		$this->db->set('AssignAdmin', $agentHrchy[$AgentId]['admin']);
		$this->db->set('AssignMgr', $agentHrchy[$AgentId]['mgrid']);
		$this->db->set('AssignSpv', $agentHrchy[$AgentId]['spvid']);
		$this->db->set('AssignSelerId', $AgentId);
		$this->db->set('AssignDate', date('Y-m-d H:i:s'));
		$this->db->set('AssignMode', 'PDS');
		$this->db->update("t_gn_assignment");
		if( $this->db->affected_rows() >0  ){
			$this->db->reset_write();
			$this->db->set("AssignId", $AssignId);
			$this->db->set("CustomerId", $customerId);
			$this->db->set("CallReasonId",0); 
			$this->db->set("AssignAdmin", $agentHrchy[$AgentId]['admin']); 
			$this->db->set("AssignAmgr", 0); 
			$this->db->set("AssignMgr", $agentHrchy[$AgentId]['mgrid']);
			$this->db->set("AssignSpv", $agentHrchy[$AgentId]['spvid']);
			$this->db->set("AssignLeader", 0);
			$this->db->set("AssignSelerId", $AgentId);
			$this->db->set("AssignBlock", 0);
			$this->db->set("AssignById", _get_session('UserId'));
			$this->db->set("AssignMode",  'PDS');
			$this->db->set("AssignLocation", $RemoteIp);
			$this->db->set("AssignDate", date('Y-m-d H:i:s'));
			$this->db->insert("t_gn_assignment_log");
			
			// $this->_deleteCustomerPds($customerId);
		}
	}
	
	function _deleteCustomerPds($CustomerId){
		$this->db->reset_write();

		$this->db->where('CustomerId', $CustomerId );
		// $this->db->where('CampaignId', $CampaignId );
		
		if($this->db->delete('t_gn_customer_pds')){
			return true;
		}
	}
	
	//end pds

	function getAssignedID($CustomerId){
		
		$sql = "SELECT a.AssignId FROM t_gn_assignment a
				WHERE a.CustomerId = $CustomerId";

		$qry = $this -> db -> query($sql);
		if( !$qry -> EOF() ){
			foreach( $qry -> result_assoc() as $rows ){
				$AssignId=$rows['AssignId'];
			}
		}
		
		return $AssignId;
	}

	function getAgentHrch($agentId){
		$_conds = array();
		
		$sql = "SELECT a.admin_id, a.mgr_id, a.spv_id FROM tms_agent a
				WHERE a.UserId = $agentId";

		$qry = $this -> db -> query($sql);
		if( !$qry -> EOF() ) 
		{
			foreach( $qry -> result_assoc() as $rows )
			{
				$_conds[$agentId]['admin']=$rows['admin_id'];
				$_conds[$agentId]['mgrid']=$rows['mgr_id'];
				$_conds[$agentId]['spvid']=$rows['spv_id'];
			}
		}
		
		return $_conds;
	}

	protected function _set_row_call_back_later( $out  = null ){
		$ApoinmentDate = & $this->select_concat_call_back_later( $out );
		if( is_null( $ApoinmentDate )){
			  //return FALSE;
			  $ApoinmentDate = date('Y-m-d').' 00:00:00';
		}

		$this->db->reset_write(); // clear cache  -----------------------------------
		$this->db->set("CustomerId", (int)$out->get_value('CustomerId','intval') );
		$this->db->set("ApoinmentDate", (string)$ApoinmentDate);
		$this->db->set("ApoinmentCreate",date('Y-m-d H:i:s'));
		$this->db->set("UserId",_get_session('UserId'));
		$this->db->set("ApoinmentFlag",0);
		$res = $this->db->insert('t_gn_appoinment');
		
		//var_dump( $this->db->last_query() ); die();
		//if( $this->db->affected_execute() )  
		if( $res )  
		{
			return TRUE;
		}
	 
		return false;
	}

	function _set_row_save_activity_call( $out = null ){
		// var_dump($out);die();
		$callDispositionActivityId = 0;

		// cek if not ready fetch object data .
		if( is_null($out) OR  !$out->fetch_ready() ){
		return false;
		}

		//  Call object 
		$obOut   = Singgleton('M_SysUser');

		// if  this set on appointmnet user 
		// if  this set on appointmnet user
		$obUsr   =Objective($obOut->_getUserDetail(_get_session('UserId')));
		$obTls   =Objective($obOut->_getUserDetail($obUsr->get_value('tl_id')));
		$obAtm   =Objective($obOut->_getUserDetail($obUsr->get_value('spv_id')));
		$obAmgr  =Objective($obOut->_getUserDetail($obUsr->get_value('act_mgr')));
		$obMgr   =Objective($obOut->_getUserDetail($obUsr->get_value('mgr_id')));
		$obAdmin =Objective($obOut->_getUserDetail($obUsr->get_value('admin_id')));


		// get CallBeforeReasonId then will the next OK 
		$CallBeforeReasonId  	= $this->_select_call_before_status( $out->get_value('CustomerId','intval') );
		$getLowerLimit  		= $this->_getLowerLimit( $out->get_value('CustomerId','intval') );
		$getLowerLimitFlexiSingle =  $this->_getLowerLimitFlexiSingle( $out->get_value('CustomerId','intval') );
		$HirakiHightReasonId 	= $this->_select_call_hirarki_status($CallBeforeReasonId, $out->get_value('CallResult','intval'));

		// then will get Up test by Uknown 
		$obCrs = Singgleton('M_SetCallResult');
		$obQty = Singgleton('M_SetResultQuality');

		// if  this set on appointmnet user 
		if( $out->find_value('date_call_later') AND $out->find_value('hour_call_later') AND $out->find_value('minute_call_later') )
		{
		// var_dump( 'wooyy' ); die();
		$this->_set_row_call_back_later( $out );
		}

		// get approval data ---------------------------------------------
		$ApprovalStatusId  = $this->_select_row_approval_status( $out, $obCrs, $obQty);

		$condition="NOW()";
		if(QUERY=='mssql'){
		$condition="CONVERT(varchar,getdate(),120)";
		}
		// reset  cache 
		$this->db->reset_write();
		$this->db->set('CallBeforeReasonId', 	$CallBeforeReasonId);
		$this->db->set("CallHirarcyHigh",		$HirakiHightReasonId); 

		$this->db->set('CustomerId',			$out->field('CustomerId'));
		$this->db->set('CallReasonCategoryId',	$out->field('CallStatus')); 
		$this->db->set('CallReasonId',			$out->field('CallResult')); 
		$this->db->set('DisagreeId',			$out->field('CallDisagree')); 
		$this->db->set('CallNumber', 			$out->field('PhoneNumber'));
		$this->db->set('CallHistoryNotes', 	$out->field('call_remarks','strtoupper'));
		$this->db->set('CallSessionId',		$out->field('CallSessionId'));

		// additional data 

		$this->db->set('CreatedById',			$obUsr->field('UserId'));
		$this->db->set('AgentCode',			$obUsr->field('Username',array('evalute','strtoupper')));
		$this->db->set('SPVCode',				$obTls->field('Username',array('evalute','strtoupper')),true);
		$this->db->set('ATMCode',				$obAtm->field('Username',array('evalute','strtoupper')),true);
		$this->db->set('AMGRCode',				$obAmgr->field('Username',array('evalute','strtoupper')),true);
		$this->db->set('MGRCode',				$obMgr->field('Username',array('evalute','strtoupper')),true);
		$this->db->set('ADMINCode',			$obAdmin->field('Username',array('evalute','strtoupper')),true);

		$this->db->set('HistoryType',			($out->field('isPDS')==true?105:CALL_ACTIVITY));
		$this->db->set('CallHistoryCallDate', $condition, false );
		$this->db->set('CallHistoryCreatedTs',$condition, false );

		// insert data ke log call history kemudian catat 
		// data IDnya

		$this->db->insert('t_gn_callhistory');
		//edit rangga visiting razaki
		#var_dump($this->db->last_query());

		if( $this->db->affected_rows() >0  ){
		$callDispositionActivityId = $this->db->insert_id();
		if($out->field('isPDS')){
		$this->_updateAssignmentData($out->field('CustomerId'));
		}
		}

		// insert data ke log call history kemudian catat 
		// data IDnya

		if( !$callDispositionActivityId ) {
		return false;	
		}


		// insert data ke log call history kemudian catat 
		// data IDnya


		$arr_interest =(array)$obCrs->_getInterestSale();
		$arr_pending =(array)$obCrs->_getPendingInfo();
		$arr_qtstatus =(array)$obQty->_getQualityBackLevel();

		// insert data ke log call history kemudian catat 
		// data IDnya

		if( $ApprovalStatusId and in_array( $out->field('CallResult'), array_keys( $arr_interest )) ) 
		{
		$this->db->reset_write();
		$this->db->where("CallHistoryId", $CallHistoryId);
		$this->db->set('ApprovalStatusId',$ApprovalStatusId);
		$this->db->update("t_gn_callhistory");
		}


		// insert data ke log call history kemudian catat 
		// data IDnya



		$QualityReconfirm = $this->QualityReconfirm();

		// insert data ke log call history kemudian catat 
		// data IDnya

		$this->db->reset_write();
		if(@in_array( $out->field('QualityStatus'), $arr_qtstatus)) {
		$this->db->set('CallReasonQue', $QualityReconfirm );
		}

		// insert data ke log call history kemudian catat 
		// data IDnya

		if( $ApprovalStatusId  
		&& in_array($out->field('CallResult'), array_keys( $arr_pending )) ) {
		$this->db->set('CallReasonQue', $ApprovalStatusId);
		}

		// insert data ke log call history kemudian catat 
		// data IDnya
		// echo "getLowerLimit";
		// var_dump($getLowerLimit);
		// echo $ApprovalStatusId;
		// die();
		// if( $ApprovalStatusId && in_array($out->get_value('CallResult','trim'), array_keys( $arr_interest )) ) {






		if($out->field('CampaignIdCip') == 1012)
		{
		if( $getLowerLimitFlexiSingle[$out->field('CampaignIdCip')]<'99' ){
		$this->db->set('CallReasonQue',99);
		} else {
		$this->db->set('CallReasonQue',$ApprovalStatusId);
		}
		}
		else 
		{
		if( $getLowerLimit[$out->field('CampaignIdCip')]!='100' ){
		$this->db->set('CallReasonQue',99);
		} else {
		$this->db->set('CallReasonQue',$ApprovalStatusId);
		}
		}

		// }


		// insert data ke log call history kemudian catat 
		// data IDnya


		if( $HirakiHightReasonId >= $CallBeforeReasonId ) {
		$this->db->set('HirarcyCallReason',	$HirakiHightReasonId); 
		$this->db->set('HirarcyAgentCode', 	$obUsr->get_value('Username',array('strtoupper')));
		$this->db->set('HirarcyTs', 		$condition, false);
		}

		// insert data ke log call history kemudian catat 
		// data IDnya

		$this->db->set('CustomerEmail', 	  $out->get_value('CustomerEmail'));
		$this->db->set('SellerId',		  $obUsr->get_value('UserId','intval'));
		$this->db->set('CustomerStatus',	  $out->get_value('CallStatus','intval'));
		$this->db->set('CallReasonId', 	  $out->get_value('CallResult','intval'));
		$this->db->set('DisagreeId',		  $out->get_value('CallDisagree','intval')); 
		$this->db->set('CustomerUpdatedTs', $condition, false);
		if($out->field('isPDS')){
		$this->db->set('Flag_Pds', 0);
		}
		$this->db->where('CustomerId',	  $out->get_value('CustomerId') );
		$this->db->update('t_gn_customer');

		// insert data ke log call history kemudian catat 
		// data IDnya

		if( @in_array($out->get_value('CallResult'), 
		array(8,14 ) ))
		{
		$this->db->where('cust_id', $out->get_value('CustomerId','intval'));
		$this->db->delete('t_gn_ver_activity');	

		$this->db->where('cust_id', $out->get_value('CustomerId','intval'));
		$this->db->delete('t_gn_ver_result');
		}


		// if OK callback to customer ID 	
		if($this->_set_row_save_customer( $out ) )  {
		return  true;
		}


		return false;
	}
 
	function _set_row_save_activity_suspend_selling( $out = null  ){
		if( !$out->fetch_ready() OR !_get_is_login() ) {
			return (bool)FALSE;
		}

		// ---- Call object --------------------------------------------------------------

		$obOut =&get_class_instance('M_SysUser');
		$obUsr =&Objective($obOut->_getUserDetail(_get_session('UserId')));
		$obTls =&Objective($obOut->_getUserDetail($obUsr->get_value('tl_id')));
		$obAtm =&Objective($obOut->_getUserDetail($obUsr->get_value('spv_id')));

		// -------------------------------------------------------------------------------

		$obCrs =&get_class_instance('M_SetCallResult');
		$obQty =&get_class_instance('M_SetResultQuality');

		// --- if  this set on appointmnet user --------------------------------------------

		if( _get_have_post('date_call_later') 
		AND _get_have_post('hour_call_later')
		AND _get_have_post('minute_call_later') )
		{
		$this->_set_row_call_back_later( $out );
		}


		// -------------------------------------------------------------------------------

		$CallBeforeReasonId =(int)$this->_select_call_before_status( $out->get_value('CustomerId','intval') );
		$HirakiHightReasonId  = $this->_select_call_hirarki_status($CallBeforeReasonId, $out->get_value('CallResult','intval'));

		// ----------------------------------------- test --------------------------------------------------------


		$QualityStatus = $obQty->_getQualityStatusByCode('504'); // reconfirm by SPV 

		// ----------- reset data  ------------------------------------- 
		$this->db->reset_write();
		$this->db->set('CallBeforeReasonId', $CallBeforeReasonId);
		$this->db->set("CallHirarcyHigh",$HirakiHightReasonId);

		// ----------- is pending before save its --------------------------------------
		if( $out->get_value('pending_policy_box', 'intval') == 1 ){
		$QualityStatus = $out->get_value('QualityStatus', 'intval');
		} 

		// ------------ next process ---------------------------------------------------
		$this->db->set('ApprovalStatusId',$QualityStatus); 
		$this->db->set('CustomerId',$out->get_value('CustomerId','intval'));
		$this->db->set('CallReasonId',$out->get_value('CallResult','intval')); 
		$this->db->set('CallNumber', $out->get_value('CallingNumber') );
		$this->db->set('CallHistoryNotes', $out->get_value('call_remarks')); 
		$this->db->set('CallSessionId',$out->get_value('CallSessionId'),FALSE);
		$this->db->set('CreatedById',$obUsr->get_value('UserId','intval'));
		$this->db->set('AgentCode',$obUsr->get_value('Username',array('evalute','strtoupper')));
		$this->db->set('SPVCode',$obTls->get_value('Username',array('evalute','strtoupper')),true);
		$this->db->set('ATMCode',$obAtm->get_value('Username',array('evalute','strtoupper')),true);
		$this->db->set('CallHistoryCallDate',date('Y-m-d H:i:s'));
		$this->db->set('CallHistoryCreatedTs',date('Y-m-d H:i:s'));
		$this->db->set('HistoryType',QUALITY_SELLING);

		$this->db->insert('t_gn_callhistory');
		if( $this->db->affected_rows() > 0 )
		{

		$this->db->set('SPV_Id',$obUsr->get_value('UserId','intval')); 
		$this->db->set('SPV_CallReasonId',$out->get_value('CallResult','intval'));
		$this->db->set('CallReasonId',$out->get_value('CallResult','intval'));
		$this->db->set('CallReasonQue', (int)$QualityStatus);
		$this->db->set('CustomerUpdatedTs', date('Y-m-d H:i:s'));
		$this->db->set('SPV_UpdateTs', date('Y-m-d H:i:s'));

		// --------- set data call hiight status --------------------------------------------------

		if( $HirakiHightReasonId >= $CallBeforeReasonId ) {
		$this->db->set('HirarcyCallReason',$HirakiHightReasonId); 
		$this->db->set('HirarcyAgentCode', $obUsr->get_value('Username',array('evalute','strtoupper')));
		$this->db->set('HirarcyTs', date('Y-m-d H:i:s'));
		}

		$this->db->where('CustomerId',$out->get_value('CustomerId'));
		$this->db->update('t_gn_customer');

		return (bool)TRUE;
		}

		return (bool)FALSE;

		}
 
	function _set_row_save_activity_suspend_still( $out = null  ){
		if( !$out->fetch_ready() OR !_get_is_login() ) {
		return (bool)FALSE;
		}

		// ---- Call object --------------------------------------------------------------

		$obOut =&get_class_instance('M_SysUser');
		$obUsr =&Objective($obOut->_getUserDetail(_get_session('UserId')));
		$obTls =&Objective($obOut->_getUserDetail($obUsr->get_value('tl_id')));
		$obAtm =&Objective($obOut->_getUserDetail($obUsr->get_value('spv_id')));

		// -------------------------------------------------------------------------------

		$obCrs =&get_class_instance('M_SetCallResult');
		$obQty =&get_class_instance('M_SetResultQuality');

		// --- if  this set on appointmnet user --------------------------------------------

		if( _get_have_post('date_call_later') 
		AND _get_have_post('hour_call_later')
		AND _get_have_post('minute_call_later') )
		{
		$this->_set_row_call_back_later( $out );
		}


		// -------------------------------------------------------------------------------

		$QualityStatus = $obQty->_getQualityStatusByCode('504'); // reconfirm by SPV 
		$CallBeforeReasonId =(int)$this->_select_call_before_status( $out->get_value('CustomerId','intval') );
		$HirakiHightReasonId  = $this->_select_call_hirarki_status($CallBeforeReasonId, $out->get_value('CallResult','intval'));

		// ----------- is pending before save its --------------------------------------
		if( $out->get_value('pending_policy_box', 'intval') == 1 ){
		$QualityStatus = $out->get_value('QualityStatus', 'intval');
		} 


		// ----------- reset data  ------------------------------------- 
		$this->db->reset_write();
		$this->db->set('CallBeforeReasonId', $CallBeforeReasonId);
		$this->db->set("CallHirarcyHigh",$HirakiHightReasonId); 
		$this->db->set('ApprovalStatusId',$QualityStatus);
		$this->db->set('CustomerId',$out->get_value('CustomerId','intval'));
		$this->db->set('CallReasonId',$out->get_value('CallResult','intval')); 
		$this->db->set('CallNumber', $out->get_value('CallingNumber') );
		$this->db->set('CallHistoryNotes', $out->get_value('call_remarks')); 
		$this->db->set('CallSessionId',$out->get_value('CallSessionId'),FALSE);

		$this->db->set('CreatedById',$obUsr->get_value('UserId','intval'));
		$this->db->set('AgentCode',$obUsr->get_value('Username',array('evalute','strtoupper')));
		$this->db->set('SPVCode',$obTls->get_value('Username',array('evalute','strtoupper')),true);
		$this->db->set('ATMCode',$obAtm->get_value('Username',array('evalute','strtoupper')),true);
		$this->db->set('CallHistoryCallDate',date('Y-m-d H:i:s'));
		$this->db->set('CallHistoryCreatedTs',date('Y-m-d H:i:s'));
		$this->db->set('HistoryType',QUALITY_DATA);

		$this->db->insert('t_gn_callhistory');
		if( $this->db->affected_rows() > 0 )
		{

		$this->db->set('CallReasonId',$out->get_value('CallResult','intval'));
		$this->db->set('CallReasonQue', (int)$QualityStatus);
		$this->db->set('CustomerUpdatedTs', date('Y-m-d H:i:s'));

		// --------- set data call hiight status --------------------------------------------------

		if( $HirakiHightReasonId >= $CallBeforeReasonId ) {
		$this->db->set('HirarcyCallReason',$HirakiHightReasonId); 
		$this->db->set('HirarcyAgentCode', $obUsr->get_value('Username',array('evalute','strtoupper')));
		$this->db->set('HirarcyTs', date('Y-m-d H:i:s'));
		}

		$this->db->where('CustomerId',$out->get_value('CustomerId','intval'));
		$this->db->update('t_gn_customer');
		return (bool)TRUE;
		}

		return (bool)FALSE;	
		}
 
	function _set_row_save_activity_suspend_data( $out = null  ){
		if( !$out->fetch_ready() OR !_get_is_login() ) {
		return (bool)FALSE;
		}

		// ---- Call object --------------------------------------------------------------

		$obOut =&get_class_instance('M_SysUser');
		$obUsr =&Objective($obOut->_getUserDetail(_get_session('UserId')));
		$obTls =&Objective($obOut->_getUserDetail($obUsr->get_value('tl_id')));
		$obAtm =&Objective($obOut->_getUserDetail($obUsr->get_value('spv_id')));

		// -------------------------------------------------------------------------------

		$obCrs =&get_class_instance('M_SetCallResult');
		$obQty =&get_class_instance('M_SetResultQuality');

		// --- if  this set on appointmnet user --------------------------------------------

		if( _get_have_post('date_call_later') 
		AND _get_have_post('hour_call_later')
		AND _get_have_post('minute_call_later') )
		{
		$this->_set_row_call_back_later( $out );
		}


		// -------------------------------------------------------------------------------

		$QualityStatus = $obQty->_getQualityStatusByCode('504'); // reconfirm by SPV 
		$CallBeforeReasonId =(int)$this->_select_call_before_status( $out->get_value('CustomerId','intval') );
		$HirakiHightReasonId  = $this->_select_call_hirarki_status($CallBeforeReasonId, $out->get_value('CallResult','intval'));

		// ----------- is pending before save its --------------------------------------
		if( $out->get_value('pending_policy_box', 'intval') == 1 ){
		$QualityStatus = $out->get_value('QualityStatus', 'intval');
		} 


		// ----------- reset data  ------------------------------------- 
		$this->db->reset_write();
		$this->db->set('CallBeforeReasonId', $CallBeforeReasonId);
		$this->db->set("CallHirarcyHigh",$HirakiHightReasonId); 
		$this->db->set('ApprovalStatusId',$QualityStatus);
		$this->db->set('CustomerId',$out->get_value('CustomerId','intval'));
		$this->db->set('CallReasonId',$out->get_value('CallResult','intval')); 
		$this->db->set('CallNumber', $out->get_value('CallingNumber') );
		$this->db->set('CallHistoryNotes', $out->get_value('call_remarks')); 
		$this->db->set('CallSessionId',$out->get_value('CallSessionId'),FALSE);

		$this->db->set('CreatedById',$obUsr->get_value('UserId','intval'));
		$this->db->set('AgentCode',$obUsr->get_value('Username',array('evalute','strtoupper')));
		$this->db->set('SPVCode',$obTls->get_value('Username',array('evalute','strtoupper')),true);
		$this->db->set('ATMCode',$obAtm->get_value('Username',array('evalute','strtoupper')),true);
		$this->db->set('CallHistoryCallDate',date('Y-m-d H:i:s'));
		$this->db->set('CallHistoryCreatedTs',date('Y-m-d H:i:s'));
		$this->db->set('HistoryType',QUALITY_DATA);

		$this->db->insert('t_gn_callhistory');
		if( $this->db->affected_rows() > 0 )
		{

		$this->db->set('CallReasonId',$out->get_value('CallResult','intval'));
		$this->db->set('CallReasonQue', (int)$QualityStatus);
		$this->db->set('CustomerUpdatedTs', date('Y-m-d H:i:s'));

		// --------- set data call hiight status --------------------------------------------------

		if( $HirakiHightReasonId >= $CallBeforeReasonId ) {
		$this->db->set('HirarcyCallReason',$HirakiHightReasonId); 
		$this->db->set('HirarcyAgentCode', $obUsr->get_value('Username',array('evalute','strtoupper')));
		$this->db->set('HirarcyTs', date('Y-m-d H:i:s'));
		}

		$this->db->where('CustomerId',$out->get_value('CustomerId','intval'));
		$this->db->update('t_gn_customer');
		return (bool)TRUE;
		}

		return (bool)FALSE;	
		}

	function  _set_row_save_followup_activity( $out = null ){
		if(!define('CANCEL_BY_REQUEST',5)) define('CANCEL_BY_REQUEST',5);
		if(!define('QA_STATUS_NEW',99)) define('QA_STATUS_NEW',99);
		if(!define('DISAGREE_STATUS',8)) define('DISAGREE_STATUS',8);


		// atemp fetch_ready then Exit 

		if( !$out->fetch_ready() OR !_get_is_login() ) {
		return false;
		}

		// before status call reason ID 

		$callDispositionID  = $out->field('CustomerId');
		$CallBeforeReasonId = $this->_select_call_before_status( $callDispositionID );

		// set default object data from process SIP OK testing 
		// buy is Default.

		$obOut 	=& Singgleton('M_SysUser');

		// define again data OK 

		$obUsr 	=& Objective($obOut->_getUserDetail(_get_session('UserId')));
		$obTls 	=& Objective($obOut->_getUserDetail($obUsr->get_value('tl_id')));
		$obAtm 	=& Objective($obOut->_getUserDetail($obUsr->get_value('spv_id')));
		$obAmgr   =& Objective($obOut->_getUserDetail($obUsr->get_value('act_mgr')));
		$obMgr    =& Objective($obOut->_getUserDetail($obUsr->get_value('mgr_id')));
		$obAdmin  =& Objective($obOut->_getUserDetail($obUsr->get_value('admin_id')));

		// set default object data from process SIP OK testing 
		// buy is Default.

		$obCrs = Singgleton('M_SetCallResult');
		$obQty = Singgleton('M_SetResultQuality');

		// --- if  this set on appointmnet user --------------------------------------------

		if( $out->find_value('date_call_later')  and $out->find_value('hour_call_later') 
		and $out->find_value('minute_call_later') ) {
		$this->_set_row_call_back_later( $out );
		}

		// $QualityStatus = $obQty->_getQualityStatusByCode('504');

		$QualityStatus = $out->field('QualityStatus');
		$disDisagreeId = $out->field('CallDisagree');

		// cek callresult ID from Here .

		$rsltDispositionID = $out->field('CallResult');
		if( $QualityStatus == CANCEL_BY_REQUEST ){
		$rsltDispositionID = DISAGREE_STATUS;
		}

		// ----------- reset data  ------------------------------------- 

		$this->db->reset_write();
		$this->db->set('CallReasonId',			$rsltDispositionID); 
		$this->db->set('DisagreeId',			$disDisagreeId); 
		$this->db->set('CallBeforeReasonId', 	$CallBeforeReasonId);
		$this->db->set('ApprovalStatusId',		$QualityStatus);

		$this->db->set('CustomerId',			$out->field('CustomerId'));
		$this->db->set('CallNumber', 			$out->field('CallingNumber') );
		$this->db->set('CallHistoryNotes', 	$out->field('call_remarks')); 
		$this->db->set('CallSessionId',		$out->field('CallSessionId'),FALSE);
		$this->db->set('CreatedById',			$obUsr->field('UserId'));
		$this->db->set('AgentCode',			$obUsr->field('Username',array('evalute','strtoupper')));
		$this->db->set('SPVCode',				$obTls->field('Username',array('evalute','strtoupper')),true);
		$this->db->set('ATMCode',				$obAtm->field('Username',array('evalute','strtoupper')),true);
		$this->db->set('AMGRCode',				$obAmgr->field('Username',array('evalute','strtoupper')),true);
		$this->db->set('MGRCode',				$obMgr->field('Username',array('evalute','strtoupper')),true);
		$this->db->set('ADMINCode',			$obAdmin->field('Username',array('evalute','strtoupper')),true);
		$this->db->set('HistoryType',			QUALITY_DATA);

		// $this->db->set('CallHistoryCallDate',	"NOW()", false);
		// $this->db->set('CallHistoryCreatedTs',	"NOW()", false);
		$this->db->set('CallHistoryCallDate',	"'".date('Y-m-d H:i:s')."'", false);
		$this->db->set('CallHistoryCreatedTs',	"'".date('Y-m-d H:i:s')."'", false);


		$this->db->insert('t_gn_callhistory');
		#var_dump( $this->db->last_query() ); die();
		if( $this->db->affected_rows() > 0 )
		{

		// push data test 
		$this->db->set('SellerId', $obUsr->field('UserId')); 
		$this->db->set('CallReasonQue', $QualityStatus);	
		$this->db->set('CallReasonId', $rsltDispositionID); 
		$this->db->set('DisagreeId', $disDisagreeId);
		$this->db->set('CustomerRejectedDate', "'".date('Y-m-d H:i:s')."'", false);
		$this->db->set('CustomerUpdatedTs', "'".date('Y-m-d H:i:s')."'", false);

		// where get ID 
		$this->db->where('CustomerId', $out->field('CustomerId'));
		if( $this->db->update('t_gn_customer') ){
		return  true;
		}

		}

		return false;

		}

	function _set_row_update_abandone( $out = null ){
		// definisikan variable disini OK Brow .
		if($out->field('FirstProductFlag')=="true"){
		$callDispositionCustomerId = $out->field('CustomerId');
		$callDispositionDataID = $out->field('CallResult'); // uncontact
		}else{
		$callDispositionCustomerId = $out->field('CustomerId_2nd');
		$callDispositionDataID = $out->field('CallResult_2nd'); // uncontact
		}

		// jika $callDispositionDataID not found.
		if( !$callDispositionDataID ){
		return false;
		}

		// jika data contact category Sama dengan Uncontact 
		// maka tambahkan ke update counter "t_gn_customer".
		// $sql = sprintf("update t_gn_customer a set a.cnt_abandon = ((a.cnt_abandon)+1) where a.CustomerId = '%s'
		// 				and a.CallReasonId = %s and a.cnt_abandon < 11 ", 
		// 				$callDispositionCustomerId,
		// 				$callDispositionDataID );

		// edit irul
		$sql = sprintf("update t_gn_customer set cnt_abandon = cnt_abandon+1 where CustomerId = '%s'
		and CallReasonId = %s and cnt_abandon < 11 ", 
		$callDispositionCustomerId,
		$callDispositionDataID );
		//tutup edit irul
		$this->db->query( $sql );
		#var_dump($this->db->last_query());
		$date_now = " NOW() ";
		if( QUERY == 'mssql') {
		$date_now = " CONVERT(VARCHAR(19), GETDATE(), 21) ";
		}
		// insert ke loger jika data memenuhi kriteria.
		$sql = sprintf("insert into t_gn_abandon_log ( CustomerId, RecsourceId, AgentId, AbandonTs)
			select  a.CustomerId as CustomerId, a.Recsource as RecsourceId, 
				a.UpdatedById as AgentId,  ".$date_now." as AbandonTs 
			from t_gn_customer a  where a.CustomerId=%s 
			and a.CallReasonId = %s and a.cnt_abandon = 11
			and a.flag_abandon =0", 
			$callDispositionCustomerId, 
			$callDispositionDataID );
			
		$this->db->query( $sql );	

		// update jika berisi lebih dari sebelas. 
		$sql = sprintf("update t_gn_customer set flag_abandon = 1,  CustomerUpdatedTs = ".$date_now." 
		where CustomerId=%s and CallReasonId=%s and cnt_abandon >10", 
		$callDispositionCustomerId,
		$callDispositionDataID );
			
		// jika ternayata terupdate sama dengan satu maka input ke table loger 
		$this->db->query($sql);

		// jika data abandone sudah lebih dari sebelas 
		// masukan ke dalam history dengan HistoryType = 2 , yang nantinya akan 
		// di exlude saat penarikan report .karna tidak termasuk kedalam atemp call .
		$this->_set_row_abandone_history( $out );

		return true;
		}

	function _set_row_abandone_history( $out  = null ){
		$this->callCountAbandoneData = 0;
		if($out->field('FirstProductFlag')=="true"){
		$this->callDispostionCustID = $out->field('CustomerId');
		}else{
		$this->callDispostionCustID = $out->field('CustomerId_2nd');
		}

		if( !$this->callDispostionCustID ){
		return false;
		}

		$sql = sprintf("select a.cnt_abandon from t_gn_customer a where a.CustomerId = '%d'", $this->callDispostionCustID);  
		$qry = $this->db->query( $sql );
		if( $qry && $qry->num_rows() > 0 ){
		$this->callCountAbandoneData = $qry->result_singgle_value(); 
		} 

		// jika total abandone lebih dari > 10 atau 11 
		if( $this->callCountAbandoneData < 11 ){
		return false;
		} 

		// jika lebih dari  11 / = 11 masukan ke History Activity . 
		// berikut.
		$sql = sprintf("select * from t_gn_callhistory a 
		where a.CustomerId='%d' 
		order by a.CallHistoryId desc limit 1 ", $this->callDispostionCustID );
		$qry = $this->db->query( $sql );

		if( $qry && $qry->num_rows() > 0 )  {

		$row = $qry->result_first_record();

		if( !$row->find_value('CustomerId') ){
		return false;
		}

		// will replace data with new data on 

		$row->add("HistoryType", CHANGE_ACTIVITY); // 2
		$row->add("CallHistoryCreatedTs", date('Y-m-d H:i:s')); 
		$row->add("CallHistoryUpdatedTs", date('Y-m-d H:i:s'));
		$row->add("CallHistoryNotes", "AUTOMATIC NOTES BY SYSTEM WITH ABANDONE DATA ");

		// then will insert data on here .

		$this->db->reset_write();
		$this->db->set("CallSessionId", 		$row->field('CallSessionId'));
		$this->db->set("CustomerId", 			$row->field('CustomerId'));
		$this->db->set("CallReasonCategoryId", 	$row->field('CallReasonCategoryId'));
		$this->db->set("CallBeforeReasonId", 	$row->field('CallBeforeReasonId'));
		$this->db->set("CallReasonId", 			$row->field('CallReasonId'));
		$this->db->set("DisagreeId", 			$row->field('DisagreeId'));
		$this->db->set("ApprovalStatusId", 		$row->field('ApprovalStatusId'));

		$this->db->set("CreatedById", 			$row->field('CreatedById'));
		$this->db->set("UpdatedById", 			$row->field('UpdatedById'));
		$this->db->set("AgentCode", 			$row->field('AgentCode'));
		$this->db->set("SPVCode", 				$row->field('SPVCode'));
		$this->db->set("ATMCode", 				$row->field('ATMCode'));
		$this->db->set("AMGRCode", 				$row->field('AMGRCode'));
		$this->db->set("MGRCode", 				$row->field('MGRCode'));
		$this->db->set("ADMINCode", 			$row->field('ADMINCode'));

		$this->db->set("CallHistoryCallDate", 	$row->field('CallHistoryCallDate'));
		$this->db->set("CallNumber", 			$row->field('CallNumber'));
		$this->db->set("CallHistoryNotes", 		$row->field('CallHistoryNotes'));
		$this->db->set("CallHistoryCreatedTs", 	$row->field('CallHistoryCreatedTs'));
		$this->db->set("CallHistoryUpdatedTs", 	$row->field('CallHistoryUpdatedTs'));
		$this->db->set("CallBeforeReasonQue", 	$row->field('CallBeforeReasonQue'));
		$this->db->set("HistoryType", 			$row->field('HistoryType'));
		$this->db->set("CallHirarcyHigh", 		$row->field('CallHirarcyHigh'));
		$this->db->set("EmailTemp", 			$row->field('EmailTemp'));

		$this->db->insert("t_gn_callhistory");
		}
		return true;

	} 
 


function _set_row_save_customer_second_product( $out = null ){
	// get category ID yang bernila uncotact dari
	$this->rslt = Singgleton('M_SetCallResult');

	if( !is_object($this->rslt) ){
		return false;
	}
	// cek jika benar maka lanjut 
	
	// jika data bernila "uncontacted/2", maka update counter . 
	$rsltDispositionDataID = $out->field('CallResult_2nd', 'intval');
	$callDispositionDataID = $this->rslt->getCategoryIDByResult( $rsltDispositionDataID );

	if( @in_array( $callDispositionDataID, $this->arrDispositionDataID)) {
		$this->_set_row_update_abandone( $out );
	}
	
	return true;
 }

protected function _set_row_call_back_later_2nd( $out  = null ){
	$ApoinmentDate = & $this->select_concat_call_back_2nd( $out );
  	if( is_null( $ApoinmentDate ))
 	{
		  //return FALSE;
		  $ApoinmentDate = date('Y-m-d').' 00:00:00';
  	}

	$this->db->reset_write(); // clear cache  -----------------------------------
	$this->db->set("CustomerId", (int)$out->get_value('CustomerId','intval') );
	$this->db->set("ApoinmentDate", (string)$ApoinmentDate);
	$this->db->set("ApoinmentCreate",date('Y-m-d H:i:s'));
	$this->db->set("UserId",_get_session('UserId'));
	$this->db->set("ApoinmentFlag",0);
	$res = $this->db->insert('t_gn_appoinment');
  	
  	// var_dump( $this->db->last_query() ); die();
	// if( $this->db->affected_execute() )  
	if( $res )  
	{
		return TRUE;
	}
 
 	return false;
}

function _set_row_save_customer( $out = null ){
 $this->rslt = Singgleton('M_SetCallResult');

 if( !is_object($this->rslt) ){
	return false;
 }
  
 // cek jika benar maka lanjut 
	
 // jika data bernila "uncontacted/2", maka update counter . 
 $rsltDispositionDataID = $out->field('CallResult', 'intval');
 $callDispositionDataID = $this->rslt->getCategoryIDByResult( $rsltDispositionDataID );
 
 if( @in_array( $callDispositionDataID, $this->arrDispositionDataID)) {
	 $this->_set_row_update_abandone( $out );
 }
  return true;
  
}

	function _set_row_save_activity_call_second_product( $out = null ){
		$callDispositionActivityId = 0;
		// cek if not ready fetch object data .
		if( is_null($out) OR  !$out->fetch_ready() ){
			return false;
		}

		//  Call object
		$obOut   = Singgleton('M_SysUser');

		// if  this set on appointmnet user
		$obUsr   =Objective($obOut->_getUserDetail(_get_session('UserId')));
		$obTls   =Objective($obOut->_getUserDetail($obUsr->get_value('tl_id')));
		$obAtm   =Objective($obOut->_getUserDetail($obUsr->get_value('spv_id')));
		$obAmgr  =Objective($obOut->_getUserDetail($obUsr->get_value('act_mgr')));
		$obMgr   =Objective($obOut->_getUserDetail($obUsr->get_value('mgr_id')));
		$obAdmin =Objective($obOut->_getUserDetail($obUsr->get_value('admin_id')));

		// get CallBeforeReasonId then will the next OK
		$CallBeforeReasonId  = $this->_select_call_before_status( $out->get_value('CustomerId_2nd','intval') );
		$HirakiHightReasonId = $this->_select_call_hirarki_status($CallBeforeReasonId, $out->get_value('CallResult_2nd','intval'));

		// then will get Up test by Uknown
		$obCrs = Singgleton('M_SetCallResult');
		$obQty = Singgleton('M_SetResultQuality');

		// if  this set on appointmnet user
		if( $out->find_value('date_call_later_2nd') AND $out->find_value('hour_call_later_2nd') AND $out->find_value('minute_call_later_2nd') ){
			$this->_set_row_call_back_later_2nd( $out );
		}

		// get approval data ---------------------------------------------
		$ApprovalStatusId  = $this->_select_row_approval_status( $out, $obCrs, $obQty);

		$condition="NOW()";
		if(QUERY=='mssql'){
			$condition="CONVERT(varchar,getdate(),120)";
		}
	
		// reset  cache 
		$this->db->reset_write();
		$this->db->set('CallBeforeReasonId', 	$CallBeforeReasonId);
		$this->db->set('CallHirarcyHigh',		$HirakiHightReasonId); 
		$this->db->set('CustomerId',			$out->field('CustomerId_2nd'));
		$this->db->set('CallReasonCategoryId',	$out->field('CallStatus_2nd')); 
		$this->db->set('CallReasonId',			$out->field('CallResult_2nd')); 
		$this->db->set('DisagreeId',			$out->field('CallDisagree_2nd')); 
		$this->db->set('CallNumber', 			$out->field('PhoneNumber_2nd'));
		$this->db->set('CallHistoryNotes',		$out->field('call_remarks_2nd','strtoupper'));
		$this->db->set('CallSessionId',			$out->field('CallSessionId_2nd'));

	// additional data 

	$this->db->set('CreatedById',			$obUsr->field('UserId'));
	$this->db->set('AgentCode',				$obUsr->field('Username',array('evalute','strtoupper')));
	$this->db->set('SPVCode',				$obTls->field('Username',array('evalute','strtoupper')),true);
	$this->db->set('ATMCode',				$obAtm->field('Username',array('evalute','strtoupper')),true);
	$this->db->set('AMGRCode',				$obAmgr->field('Username',array('evalute','strtoupper')),true);
	$this->db->set('MGRCode',				$obMgr->field('Username',array('evalute','strtoupper')),true);
	$this->db->set('ADMINCode',				$obAdmin->field('Username',array('evalute','strtoupper')),true);

	// $this->db->set('HistoryType',			CALL_ACTIVITY);
	$this->db->set('HistoryType',			($out->field('isPDS')==true?105:CALL_ACTIVITY));
	$this->db->set('CallHistoryCallDate', $condition, false );
	$this->db->set('CallHistoryCreatedTs',$condition, false );
 
	// insert data ke log call history kemudian catat data IDnya
	$this->db->insert('t_gn_callhistory');

	// edit rangga visiting razaki
	// var_dump($this->db->last_query());
	if( $this->db->affected_rows() >0  ){
		$callDispositionActivityId = $this->db->insert_id();
	}

	// insert data ke log call history kemudian catat data IDnya
	if( !$callDispositionActivityId ) {
		return false;	
	}

	// insert data ke log call history kemudian catat data IDnya

	$arr_interest =(array)$obCrs->_getInterestSale();
	$arr_pending =(array)$obCrs->_getPendingInfo();
	$arr_qtstatus =(array)$obQty->_getQualityBackLevel();

	// insert data ke log call history kemudian catat data IDnya

	if( $ApprovalStatusId and in_array( $out->field('CallResult_2nd'), array_keys( $arr_interest )) ){
		$this->db->reset_write();
		$this->db->where("CallHistoryId", $CallHistoryId);
		$this->db->set('ApprovalStatusId',$ApprovalStatusId);
		$this->db->update("t_gn_callhistory");
	}

	// insert data ke log call history kemudian catat data IDnya
	$QualityReconfirm = $this->QualityReconfirm();
	
	// insert data ke log call history kemudian catat data IDnya

	$this->db->reset_write();
	if(@in_array( $out->field('QualityStatus_2nd'), $arr_qtstatus)) {
		$this->db->set('CallReasonQue', $QualityReconfirm );
	}

	// insert data ke log call history kemudian catat data IDnya
	if( $ApprovalStatusId && in_array($out->field('CallResult_2nd'), array_keys( $arr_pending ))){
		$this->db->set('CallReasonQue', $ApprovalStatusId);
	}

	// insert data ke log call history kemudian catat data IDnya
	if( $ApprovalStatusId && in_array($out->get_value('CallResult_2nd','trim'), array_keys( $arr_interest ))){
		$this->db->set('CallReasonQue',$ApprovalStatusId);
	}

	// insert data ke log call history kemudian catat data IDnya
	if( $HirakiHightReasonId >= $CallBeforeReasonId ) {
		$this->db->set('HirarcyCallReason',	$HirakiHightReasonId); 
		$this->db->set('HirarcyAgentCode', 	$obUsr->get_value('Username',array('strtoupper')));
		$this->db->set('HirarcyTs', 		$condition, false);
	}

	// insert data ke log call history kemudian catat data IDnya
	$this->db->set('CustomerEmail', 	  $out->get_value('CustomerEmail_2nd'));
	$this->db->set('SellerId',		  $obUsr->get_value('UserId','intval'));
	$this->db->set('CustomerStatus',	  $out->get_value('CallStatus_2nd','intval'));
	$this->db->set('CallReasonId', 	  $out->get_value('CallResult_2nd','intval'));
	$this->db->set('DisagreeId',		  $out->get_value('CallDisagree_2nd','intval')); 
	$this->db->set('CustomerUpdatedTs', $condition, false);
	$this->db->where('CustomerId',	  $out->get_value('CustomerId_2nd') );
	$this->db->update('t_gn_customer');

	// update data Xcell today-1 jika incoming
	if( $out->field('CallResult_2nd') == "13" ) {
		$this->db->reset_write();
		$this->db->set('expired_date', date('Y-m-d', strtotime(date('Y-m-d'). ' - 1 days')) );
		$this->db->where('CustomerId', $out->get_value('customerIdXcell'));
		$this->db->update('t_gn_customer');
		#var_dump( $this->db->last_query() ); die();
	}
	

	// insert data ke log call history kemudian catat data IDnya
	if( @in_array($out->get_value('CallResult_2nd'), array(8,14 ) )){
		$this->db->where('cust_id', $out->get_value('CustomerId_2nd','intval'));
		$this->db->delete('t_gn_ver_activity');	

		$this->db->where('cust_id', $out->get_value('CustomerId_2nd','intval'));
		$this->db->delete('t_gn_ver_result');
	}

	// if OK callback to customer ID 	
	if($this->_set_row_save_customer_second_product( $out ) )  {
		return  true;
	}

	return false;
	// end function
	
 }









}
	// exit();die();



?>
