<?php
/*
 * E.U.I 
 * -----------------------------------------------
 *
 * subject	: M_QtyApprovalInterest
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class M_QtyScoring extends EUI_Model
{
	
var $set_limit_page  = 10;	

// --------------------------------------------------------------

  private static $Instance   = null; 
  public static function &Instance()
 {
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
 }
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function M_QtyScoring()
 {
	$this -> load -> model(array(
		'M_ModOutBoundGoal', 'M_Combo','M_SrcCustomerList', 'M_SetProduct', 'M_SetResultCategory',
		'M_ModSaveActivity', 'M_Payers','M_Benefiecery','M_Insured','M_QtyPoint','M_Pbx'));
 }
 
 
 
/*
 * @ def 		: _getEventSale
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

function _getAgentReady()
{
	$AgentId = array();
	$this -> db->select("a.Agent_User_Id ");
	$this -> db->from("t_gn_quality_agent a ");
	$this -> db->where("a.Quality_Staff_Id",$this -> EUI_Session->_get_session('UserId'));
	foreach( $this -> db->get() -> result_assoc()  as $rows )
	{
		$AgentId[$rows['Agent_User_Id']] = $rows['Agent_User_Id'];
	}
	
	return $AgentId;
	
} 
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function Sale()
{
	$_a = array(); $_b = array();
	if( class_exists('M_SetCallResult'))
	{
		$_a = $this -> M_SetCallResult -> _getInterestSale(); 
		foreach( $_a as $_k => $_v )
		{
			$_b[$_k] = $_k;  
		}	
	}
	
	return $_b;
} 
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

public function _getAgentByQualityStaff()
{
	$_list_agents = false;
	
	if( $this -> EUI_Session->_have_get_session('UserId') )
	{
		$this -> db -> select("b.UserId");
		$this -> db -> from("t_gn_quality_agent a");
		$this -> db -> join("tms_agent b","a.Agent_User_Id=b.UserId","LEFT");
		$this -> db -> where("a.Quality_Staff_Id", $this -> EUI_Session->_get_session('UserId') );
		foreach( $this -> db ->get() -> result_assoc() as $rows )
		{
			$_list_agents[$rows['UserId']] = $rows['UserId'];
		}	
	}
	
	return $_list_agents;
} 
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 private function _getApprovalInterest()
 {
	$_conds = array();
	if(class_exists('M_SetCallResult'))
	{
		$i = 0;
		foreach( $this -> M_SetCallResult -> _getEventSale() as $k => $rows )
		{
			$_conds[$i] = $k;
			$i++;
		}
	}
	return $_conds;
 }
 
 /*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 private function _getQualityConfirm()
 {
	$_conds = array();
	if(class_exists('M_SetResultQuality'))
	{
		$i = 0;
		foreach( $this -> M_SetResultQuality -> _getQualityConfirm() as $k => $rows )
		{
			$_conds[$i] = $k;
			$i++;
		}
	}
	return $_conds;
 }
 
 /*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function _get_default()
{
	/* get instance class outbound **/	
	
	$CallDirection =& M_ModOutBoundGoal::get_instance();
	$this->EUI_Page->_setPage($this->set_limit_page);
	$this->EUI_Page->_setSelect("a.AssignId",FALSE);
	$this->EUI_Page->_setFrom("t_gn_assignment a ");
	$this->EUI_Page->_setJoin("t_gn_quality_agent b","a.AssignSelerId=b.Agent_User_Id", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_customer c ","a.CustomerId=c.CustomerId","LEFT");
	$this->EUI_Page->_setJoin("tms_agent d ","a.AssignSelerId=d.UserId","LEFT");
	$this->EUI_Page->_setJoin("t_lk_callreason e ","c.CallReasonId=e.CallReasonId","LEFT");
	$this->EUI_Page->_setJoin("t_gn_quality_group f ","b.Quality_Staff_Id=f.Quality_Staff_id","LEFT");
	$this->EUI_Page->_setJoin("tms_agent h ","b.Quality_Staff_Id=h.UserId","LEFT");
	$this->EUI_Page->_setJoin("t_gn_campaign i","c.CampaignId=i.CampaignId","LEFT");
	$this->EUI_Page->_setJoin("t_gn_policyautogen j","c.CustomerId=j.CustomerId","LEFT");
	$this->EUI_Page->_setJoin("t_gn_policy k ","j.PolicyNumber=k.PolicyNumber","LEFT",true);
	
	/* default for method scoring quality **/
	$this -> EUI_Page->_setAnd("i.OutboundGoalsId", $CallDirection -> _getOutboundId() );
	
	// get status in sale only 
	$this -> EUI_Page->_setWhereIn("e.CallReasonId", self::Sale());
		
	// tipe handling 
	if( $this -> EUI_Session->_get_session('HandlingType')==USER_QUALITY_HEAD 
		OR $this -> EUI_Session->_get_session('HandlingType')==USER_QUALITY_STAFF ) {
		$this -> EUI_Page->_setAnd("f.Quality_Skill_Id", QUALITY_SCORES);
	}
		
	
	/* level user quality Head **/
	if( $this -> EUI_Session->_get_session('HandlingType')== USER_QUALITY_HEAD ){
		$this -> EUI_Page->_setAnd("h.quality_id", $this -> EUI_Session->_get_session('UserId') );
	}

	/* 	level login quality staff **/
	if( $this -> EUI_Session->_get_session('HandlingType')== USER_QUALITY_STAFF ){
		$this -> EUI_Page->_setAnd("b.Quality_Staff_Id", $this -> EUI_Session->_get_session('UserId') );
	}
	
	/* filter next data if not empty filter **/
	
	$QualityId = array_keys($this->M_SetResultQuality->_getQualityResult());
	$this -> EUI_Page->_setAnd("a.AssignAdmin IS NOT NULL  AND a.AssignBlock=0 
			AND ( c.CallReasonQue IS NULL 
				  OR c.CallReasonQue IN('".IMPLODE("','",$QualityId)."')
				  OR c.CallReasonQue IN(99)
			)");
			
// ---- default set filter ----------------------------
			 
//  ----------------------------- filtring by login  ------------------------------------------
	
	if(_get_session('HandlingType')==SUPERVISOR ){			 
		$this -> EUI_Page->_setAnd("a.AssignSpv",_get_session('UserId') );
	}
	
	if(_get_session('HandlingType')==TELESALES){
		$this -> EUI_Page->_setAnd("a.AssignSelerId", _get_session('UserId') );
	}
	
// ------------------- filtring by keep session  ---------------------------------------
	
	$this->EUI_Page->_setAndCache("c.CustomerFirstName", "qty_cust_name", true);
	$this->EUI_Page->_setAndCache("c.CustomerNumber", "qty_cust_number", true);
	$this->EUI_Page->_setAndCache("c.CampaignId", "qty_campaign_id", true);
	$this->EUI_Page->_setAndCache("j.ProductId", "qty_category_id", true);
	$this->EUI_Page->_setAndOrCache("k.PolicySalesDate>='". StartDate(_get_post('qty_start_date'))."'", "qty_start_date", true);
	$this->EUI_Page->_setAndOrCache("k.PolicySalesDate<='". EndDate(_get_post('qty_end_date'))."'", "qty_end_date", true);
	$this->EUI_Page->_setAndOrCache("a.AssignSelerId", "qty_user_id", true);
	$this->EUI_Page->_setAndCache("c.CallReasonId", "qty_call_result", true);
	
// ------- set group by ------------------------------------------------------------------
	
	$this->EUI_Page->_setGroupBy('c.CustomerId');  
	if($this -> EUI_Page -> _get_query())
	{
		return $this -> EUI_Page;
	}	 
	
	
 }
 
 /*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
 public function _get_content()
 {
 
   // instance of class **/
   
	$CallDirection =& M_ModOutBoundGoal::get_instance();
	
	$this->EUI_Page->_postPage(_get_post('v_page') );
	$this->EUI_Page->_setPage($this->set_limit_page);
	$this->EUI_Page->_setArraySelect(array(
		"c.CustomerId as CustomerId" => array("CustomerId","CustomerId", "primary"),
		"i.CampaignName as CampaignName" => array("CampaignName", "Campaign Name"), 
		//"c.CustomerNumber as CustomerNumber" => array("CustomerNumber", "CIF"),
		"c.CustomerFirstName as CustomerFirstName" => array("CustomerFirstName", "Customer Name"), 
		//"c.CustomerDOB as CustomerDOB" => array("CustomerDOB","DOB"),
		"c.CustomerDOB as CustomerAge" => array("CustomerAge","Age"),
		"d.full_name as AgentId" =>  array("AgentId","Agent ID"),
		"IF( e.CallReasonDesc IS NULL, 'New', e.CallReasonDesc) as CallReasonDesc" => array("CallReasonDesc", "Call Result"),
		"(SELECT SUM(a.duration) as Duration FROM cc_recording a 
			WHERE a.assignment_data = c.CustomerId
			GROUP BY a.assignment_data ) As Duration"=> array("Duration","Duration"),
		"(SELECT pc.PolicyNumber FROM t_gn_policyautogen pc 
		INNER JOIN t_gn_policy pl on pc.PolicyNumber=pl.PolicyNumber 
		WHERE pc.CustomerId=c.CustomerId LIMIT 1) as PolicyNumber" => array("PolicyNumber","Policy Number"),
		
		"(SELECT qs.AproveName FROM t_lk_aprove_status qs 
			WHERE qs.ApproveId=c.CallReasonQue) as ApproveStatus" => array("ApproveStatus","Quality Status"),
	  
	  
		"k.PolicySalesDate as PolicySalesDate" => array("PolicySalesDate", "Sales Date")
	));
	
	$this->EUI_Page->_setFrom("t_gn_assignment a ");
	$this->EUI_Page->_setJoin("t_gn_quality_agent b","a.AssignSelerId=b.Agent_User_Id", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_customer c ","a.CustomerId=c.CustomerId","LEFT");
	$this->EUI_Page->_setJoin("tms_agent d ","a.AssignSelerId=d.UserId","LEFT");
	$this->EUI_Page->_setJoin("t_lk_callreason e ","c.CallReasonId=e.CallReasonId","LEFT");
	$this->EUI_Page->_setJoin("t_gn_quality_group f ","b.Quality_Staff_Id=f.Quality_Staff_id","LEFT");
	$this->EUI_Page->_setJoin("tms_agent h ","b.Quality_Staff_Id=h.UserId","LEFT");
	$this->EUI_Page->_setJoin("t_gn_campaign i","c.CampaignId=i.CampaignId","LEFT");
	$this->EUI_Page->_setJoin("t_gn_policyautogen j","c.CustomerId=j.CustomerId","LEFT");
	$this->EUI_Page->_setJoin("t_gn_policy k ","j.PolicyNumber=k.PolicyNumber","LEFT",true);
	
	
	/* default for method scoring quality **/
	$this -> EUI_Page->_setAnd("i.OutboundGoalsId", $CallDirection -> _getOutboundId() );
	
	// get status in sale only 
	$this -> EUI_Page->_setWhereIn("e.CallReasonId", self::Sale());
		
	// tipe handling 
	if( $this -> EUI_Session->_get_session('HandlingType')==USER_QUALITY_HEAD 
		OR $this -> EUI_Session->_get_session('HandlingType')==USER_QUALITY_STAFF ) {
		$this -> EUI_Page->_setAnd("f.Quality_Skill_Id", QUALITY_SCORES);
	}
		
	
	/* level user quality Head **/
	if( $this -> EUI_Session->_get_session('HandlingType')== USER_QUALITY_HEAD ){
		$this -> EUI_Page->_setAnd("h.quality_id", $this -> EUI_Session->_get_session('UserId') );
	}

	/* 	level login quality staff **/
	if( $this -> EUI_Session->_get_session('HandlingType')== USER_QUALITY_STAFF ){
		$this -> EUI_Page->_setAnd("b.Quality_Staff_Id", $this -> EUI_Session->_get_session('UserId') );
	}
	
	/* filter next data if not empty filter **/
	
	$QualityId = array_keys($this->M_SetResultQuality->_getQualityResult());
	
// ---- default set filter ----------------------------
	
	$this -> EUI_Page->_setAnd("a.AssignAdmin IS NOT NULL  
			AND a.AssignBlock=0 
			AND ( c.CallReasonQue IS NULL 
				  OR c.CallReasonQue IN('".IMPLODE("','",$QualityId)."')
				  OR c.CallReasonQue IN(99)
			)");
				 		
			
// ---- filtring by login 
	
	if( in_array( _get_session('HandlingType'), array(USER_SUPERVISOR))) {			 
		$this -> EUI_Page->_setAnd("a.AssignSpv",_get_session('UserId') );
	}
	
	if( in_array( _get_session('HandlingType'), array(USER_AGENT_INBOUND, USER_AGENT_OUTBOUND)))  {		
		$this -> EUI_Page->_setAnd("a.AssignSelerId", _get_session('UserId') );
	}
	
// --- filtring by keep session 
	$this->EUI_Page->_setAndCache("c.CustomerFirstName", "qty_cust_name", true);
	$this->EUI_Page->_setAndCache("c.CustomerNumber", "qty_cust_number", true);
	$this->EUI_Page->_setAndCache("c.CampaignId", "qty_campaign_id", true);
	$this->EUI_Page->_setAndCache("j.ProductId", "qty_category_id", true);
	$this->EUI_Page->_setAndOrCache("k.PolicySalesDate>='". StartDate(_get_post('qty_start_date'))."'", "qty_start_date", true);
	$this->EUI_Page->_setAndOrCache("k.PolicySalesDate<='". EndDate(_get_post('qty_end_date'))."'", "qty_end_date", true);
	$this->EUI_Page->_setAndOrCache("a.AssignSelerId", "qty_user_id", true);
	$this->EUI_Page->_setAndCache("c.CallReasonId", "qty_call_result", true);
	$this->EUI_Page->_setGroupBy('c.CustomerId');
	
// -----------if have order sorted ---------------------------------

  if( _get_have_post("order_by") ){
	$this->EUI_Page->_setOrderBy(_get_post("order_by"), _get_post("type"));
   } else {
	$this->EUI_Page->_setOrderBy("a.AssignId", "DESC");
  }	

   $this->EUI_Page ->_setLimit();
	
 }
 
 
/*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function _get_resource()
 {
	self::_get_content();
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function _get_page_number() 
 {
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getCountVoice($CustomerId=0)
 {
	$_count = 0;
	$this -> db -> select("count(a.id) as jumlah",FALSE);
	$this -> db -> from("cc_recording a");
	
	if( $rows = $this -> db -> get() -> result_first_assoc() ){
		$_count = (INT)$rows['jumlah']; 
	}
	
	return $_count;
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getPages($CustomerId=0)
 {
	$PagesList = array();
	
	$record = $this -> _getCountVoice();
	$counts = ceil($record/5);
	
	for($p = 1; $p <= (INT)$counts; $p++) {
		$PagesList[$p] = $p;
	}
	
	return $PagesList;
	
 }
 

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getLastCallHistory($CustomerId)
 {
	$_conds = array();
	
	$this -> db -> select('*');
	$this -> db -> from('t_gn_callhistory');
	$this -> db -> where('CustomerId',$CustomerId);
	
	if( $avail = $this -> db -> get()->result_first_assoc() )
	{
		$_conds = $avail;
	}
	
	return $_conds;
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
  function _getListVoice($param = array() )
 {
	$_voice = array();
	
 // $start
	$start = 0; $perpages = 5; 
	
 // total page 
	
	$record = $this -> _getCountVoice();
	$pages = ceil($record/$perpages);
	
	//  get start pages 
	
	if( isset($param['pages']) ){
		if( (INT)$param['pages'] > 0 )
			$start = ( (($param['pages'])-1) * $perpages); 
		else
			$start = 0;
	}
	
	// run data 
	
	$this -> db -> select("*");
	$this -> db -> from("cc_recording a");
	$this -> db -> limit($perpages,$start);
	
	// get query result
	
	$qry = $this->db->get();
	$num = $start+1;
	foreach($qry -> result_assoc() as $rows )
	{
		$_voice[$num] = $rows;	
		$num++;
	}	
	return $_voice;
 }
 
 
 
 /* get rows data **/
 
 function _getVoiceResult($VoiceId=0 )
 {
	$this -> db -> select("*");
	$this -> db -> from("cc_recording a");
	$this -> db -> where('id',$VoiceId);
	
	$_result =  array();
	
	if( $_conds = $this -> db->get() -> result_first_assoc() )
	{
		foreach($_conds as $fld => $values )
		{
			if( $fld=='file_voc_size' ) 
				$_result[$fld] = $this->EUI_Tools->_get_format_size($values);
				
			else if( $fld=='duration' ) 
				$_result[$fld] = $this->EUI_Tools->_set_duration($values);
				
			else if( $fld=='anumber' ) 
				$_result[$fld] = $this->EUI_Tools->_getPhoneNumber($values);	
				
			else if( $fld=='start_time' ) 
				$_result[$fld] = $this->EUI_Tools->_datetime_indonesia($values);	
				
			else 
				$_result[$fld] = $values;
		}
		
		return $_result;
	}
	else
		return null;
 }
 

 
public function _getQtyCount( $CustomerId = 0 )
{
	$count = 0;
	
	$this->db->select("COUNT(a.Id) as jumlah",FALSE);
	$this->db->from("t_gn_scoring_point a ");
	$this->db->where("a.CustomerId",$CustomerId); 
	
	if( $rows = $this->db->get()->result_first_assoc() ) 
	{
		$count = (INT)$rows['jumlah'];
	}
	
	return $count;
} 



 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
 

 public function _saveQualityValues( $param = null  )
 {
   $InsertId = 0;
   if( is_array($param) ) 
   {
		$this->db->set('CustomerId',$param['CustomerId']);
		$this->db->set('ScoringRemark',strtoupper($param['remarks']));
		$this->db->set('ScroingQualityId',$this -> EUI_Session->_get_session('UserId'));
		$this->db->set('ScoringCreateTs',date('Y-m-d H:i:s'));
		$this->db->insert('t_gn_qa_scoring');
		if( $this->db->affected_rows() > 0 )
			$InsertId = $this -> db->insert_id();
	}	
		
	return $InsertId;
 }
 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
 
 public function _setSaveScoreQuality( $param = NULL )
 {
	$_conds = 0;
	 if( !is_null($param) )
	{
		list ( $qty, $cmb, $prm ) = $param;
		
		$SubCategoryId = $qty['SubCategory'];
		
		if( $InsertId = $this->_saveQualityValues($prm)) // save to master data 
		{
			$total_score_one = 0;
			$total_score_two = 0;
			
			if(array_keys($qty['Category']) ) 
			foreach( array_keys($qty['Category']) as $Keys => $CategoryId ) 
			{
				$ScoringQuestionValue 	= NULL;  
				$ScoringQuestionId 		= NULL;
				$ScoringQuestionRemarks = NULL;
				
				$i = 0; 
				foreach( array_keys($SubCategoryId[$CategoryId]) as $KeyId => $PO ) 
				{
					$ScoringQuestionValue[$i] = $prm["CboScore_{$CategoryId}_{$PO}"];
					$ScoringQuestionId[$i] = $PO;
					$i++;
				}
				
				$ScoringTotalScore1 = $prm["TotalScore_{$CategoryId}"];
				$ScoringTotalScore2 = $prm["TotalScore2_{$CategoryId}"];
				
				if( (is_array($ScoringQuestionValue)) 
					AND (is_array($ScoringQuestionId)))
				{
					$this->db->set('ScoringId', $InsertId,false);
					$this->db->set('ScoringCategoryId',$CategoryId, false);
					$this->db->set('ScoringQuestionId', implode(",",array_values($ScoringQuestionId)));
					$this->db->set('ScoringQuestionValue',implode(",",array_values($ScoringQuestionValue)));
					$this->db->set('ScoringTotalScore1',$ScoringTotalScore1);
					$this->db->set('ScoringTotalScore2',$ScoringTotalScore2);
					$this->db->set('ScoringQuestionDates', date('Y-m-d H:i:s'));
					$this->db->insert('t_gn_scoring_point');
					if( $this->db->affected_rows() > 0 )
					{
						$total_score_one +=(INT)$ScoringTotalScore1;
						$total_score_two +=(INT)$ScoringTotalScore2;
					}	
				}
				
				$_conds++;
			}
			
			/** update summary data **/
			
			
			
			$this->db->where('Id', $InsertId);
			$this->db->set('ScoringTotal1',$total_score_one);
			$this->db->set('ScoringTotal2',$total_score_two);
			$this->db->set('ScoringFinal',$prm['FinalScore']);
			$this->db-> update('t_gn_qa_scoring');
		}
		
		// print_r($param);
		
		
	/**  save activity history by user quality **/
	
		$this -> db -> select('*');
		$this -> db -> from('t_gn_callhistory');
		$this -> db -> where('CustomerId', $prm['CustomerId']);
		$this -> db -> order_by("CallHistoryId","DESC");
		$this -> db -> limit(1);
		
		if( $rows = $this -> db -> get() -> result_first_assoc() ) 
		{
				$this -> db -> set("CallSessionId", $rows['CallSessionId']); 
				$this -> db -> set("CustomerId", $rows['CustomerId']); 
				$this -> db -> set("CallReasonId", $rows['CallReasonId']); 
				$this -> db -> set("ApprovalStatusId", 10,FALSE); // status scoring 
				$this -> db -> set("CallHistoryCallDate", $rows['CallHistoryCallDate']); 
				$this -> db -> set("CallNumber", $rows['CallNumber']); 
				$this -> db -> set("CallHistoryNotes", strtoupper($prm['remarks']));
				$this -> db -> set("CreatedById", $this -> EUI_Session->_get_session('UserId') ); 
				$this -> db -> set("UpdatedById", $this -> EUI_Session->_get_session('UserId') ); 
				$this -> db -> set("CallHistoryCreatedTs",date('Y-m-d H:i:s')); 
				$this -> db -> set("CallHistoryUpdatedTs",date('Y-m-d H:i:s'));
				$this -> db -> insert('t_gn_callhistory');
				if( $this -> db -> affected_rows() > 0 )
					$_conds++;
		 }
	}
	
	
	return $_conds;
 }
 
 
}
?>