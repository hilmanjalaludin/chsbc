<?php
/*
 * E.U.I 
 *
 
 * subject	: M_MgtAssignment modul 
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Utility/
 */
 
class M_MgtAssignment extends EUI_Model
{

 private static $Active;
 private static $NotActive;
 private static $CampaignId;

 
// -----------------------------------------------------------------------------
/*
 *
 * @ package		function get detail content list page 
 * @ param			not assign parameter
 */
 
 private static $Instance   = null; 
 public static function &Instance()
{
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
}

// -----------------------------------------------------------------------------
/*
 *
 * @ package		function get detail content list page 
 * @ param			not assign parameter
 */
 
function __construct()
{
	self::$Active = 1;
	self::$NotActive = 0;
	$this->load->model(array('M_ModDistribusi','M_SetCallResult','M_SysUser','M_Combo'));
} 
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
 /* 
function _get_default()
{
	$this -> EUI_Page -> _setPage(10); 
	$this -> EUI_Page -> _setQuery("
		SELECT a.CampaignId, a.CampaignNumber, a.CampaignName, b.Description 
		FROM t_gn_campaign a 
		LEFT JOIN t_lk_outbound_goals b on a.OutboundGoalsId=b.OutboundGoalsId
	"); 

	
	$flt =" AND a.CampaignStatusFlag=1 ";
	
	if( $this -> URI -> _get_have_post('OutboundGoalId') ){
		$flt .= " AND a.OutboundGoalsId = '{$this->URI->_get_post('OutboundGoalId')}'"; 
	}
	
   // set where 
	
	$this -> EUI_Page -> _setWhere($flt);
	
	// set order
	if( $this -> URI -> _get_have_post('order_by') ){
		$this -> EUI_Page -> _setOrderBy($this->URI->_get_post('order_by'),$this->URI->_get_post('type'));
	}
	
	if( $this -> EUI_Page -> _get_query() ) 
	{
		return $this -> EUI_Page;
	}
}
*/

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 /*
function _get_content()
{

  $this -> EUI_Page->_postPage( $this -> URI -> _get_post('v_page') );
  $this -> EUI_Page->_setPage(10);
 
  $this -> EUI_Page-> _setQuery("
		SELECT a.CampaignId, a.CampaignNumber, a.CampaignName, b.Description 
		FROM t_gn_campaign a 
		LEFT JOIN t_lk_outbound_goals b on a.OutboundGoalsId=b.OutboundGoalsId 
	");
  
	
	// set where
	$flt =" AND a.CampaignStatusFlag=1 ";
	if( $this -> URI -> _get_have_post('OutboundGoalId') ){
		$flt .= " AND a.OutboundGoalsId = '{$this->URI->_get_post('OutboundGoalId')}'"; 
	}
	
	$this -> EUI_Page-> _setWhere($flt);
	
	// set order
	if( $this -> URI -> _get_have_post('order_by') ){
		$this -> EUI_Page -> _setOrderBy($this->URI->_get_post('order_by'),$this->URI->_get_post('type'));
	}
	
	$this -> EUI_Page->_setLimit();
}
*/

/*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 /*
function _get_resource()
 {
	self::_get_content();
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }
 */
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 /*
function _get_page_number() 
 {
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
 */
 

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 /*
function _getShowData($Data=null)
{
	$_counter = 0;	
	if( !is_null($Data) )
	{
		$sql = "select 
					COUNT(b.AssignId) as Counter 
				from t_gn_customer a
				left join t_gn_assignment b on a.CustomerId=b.CustomerId
				where 1=1
				and a.CampaignId = '".$Data['CampaignId']."'
				and a.CallReasonId not in (".implode(',',array_keys($this->M_SetCallResult->_getRealInterest())).") ";
				
		if( isset($Data['UserId']) 
			AND is_array($Data['UserId']) )
		{
			$sql .= " and b.AssignSelerId in (".implode(',',$Data['UserId']).") ";
			// $this -> db -> where_in('b.AssignSelerId',$Data['UserId']);
		}
		
		if( isset($Data['CallResultId']) 
			AND is_array($Data['CallResultId']) )
		{
			$idReason = array();
			$filter = "";
			
			foreach($Data['CallResultId'] as $reason)
			{
				if($reason == 'new'){
					$filter = " a.CallReasonId is null ";
				}
				else{
					$idReason[] = $reason;
				}
			}
			
			if(!empty($filter))
			{
				if(count($idReason)>0)
				{
					$sql .= " and (a.CallReasonId in (".implode(',',$idReason).") or ".$filter." )";
				}
				else{
					$sql .= " and ".$filter." ";
				}
			}
			else{
				$sql .= " and a.CallReasonId in (".implode(',',$idReason).")";
			}
		}
		
		$qry = $this->db->query($sql);
		if($rows = $qry->result_first_assoc()) {
			$_counter = $rows['Counter'];
		}
	}
	
	return $_counter;
}
*/

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _select_row_field_level($Level=null )
{ 
	if(!is_null($Level)) 
{
	$arr_list_user = array 
	( 
		USER_ADMIN => 'AssignAdmin', 
		USER_MANAGER => 'AssignMgr', 
		USER_ACCOUNT_MANAGER => 'AssignAmgr',
		USER_SUPERVISOR => 'AssignSpv',
		USER_AGENT_OUTBOUND => 'AssignSelerId', 
		USER_AGENT_INBOUND => 'AssignSelerId', 
		USER_LEADER => 'AssignLeader',
		USER_QUALITY => 'AssignAdmin', 
		USER_ROOT => 'AssignAdmin'
	);
		
	return (string)$arr_list_user[$Level];
 }
	
	return null;
}	
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _get_select_campaign()
 {
	$sql = " SELECT * FROM t_gn_campaign ";
	$qry = $this -> db -> query($sql);
	foreach( $qry -> result_assoc() as $rows ){
		$_conds[$rows['CampaignStatusFlag']][$rows['CampaignId']] = $rows;
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
 		
 public function getLevelUser()
{
  $_array_level = array();  
  $data = array();
  
 // ---------- define sesion -------------------
 
 if(_get_session('HandlingType')==USER_ROOT) 
	 $_array_level = array( USER_ADMIN, USER_QUALITY_STAFF,USER_QUALITY_HEAD, USER_ROOT, USER_UPLOADER);
	
 if(_get_session('HandlingType')==USER_ADMIN ) 
	$_array_level = array( USER_ADMIN, USER_QUALITY_STAFF,USER_QUALITY_HEAD, USER_ROOT, USER_UPLOADER);
		
 if(_get_session('HandlingType')==USER_ACCOUNT_MANAGER ) 
	$_array_level = array( USER_ADMIN, USER_ROOT, USER_QUALITY_STAFF,USER_QUALITY_HEAD,USER_ACCOUNT_MANAGER,USER_UPLOADER);
		
 if(_get_session('HandlingType')==USER_MANAGER ) 
	$_array_level = array( USER_ADMIN, USER_MANAGER, USER_ACCOUNT_MANAGER, USER_ROOT, USER_QUALITY_STAFF,USER_QUALITY_HEAD,USER_UPLOADER);
		
 if(_get_session('HandlingType')==USER_QUALITY_STAFF ) 
	$_array_level = array();
		
 if(_get_session('HandlingType')==USER_QUALITY_HEAD ) 
	$_array_level = array();
		
 if(_get_session('HandlingType')==USER_SUPERVISOR ) 
	$_array_level = array( USER_ADMIN, USER_MANAGER, USER_ACCOUNT_MANAGER, USER_ROOT, USER_QUALITY_STAFF,USER_QUALITY_HEAD, USER_SUPERVISOR, USER_UPLOADER);
		
 if(_get_session('HandlingType')==USER_LEADER ) 
	$_array_level = array( USER_ADMIN, USER_MANAGER, USER_ROOT, USER_ACCOUNT_MANAGER, USER_QUALITY_STAFF,USER_QUALITY_HEAD, USER_SUPERVISOR, USER_LEADER, USER_UPLOADER);	
	
	
/** run of query statments **/
	
	$this->db->reset_select();
	$this->db->select("a.id, a.name", FALSE);
	$this->db->from("tms_agent_profile a");
	$this->db->where_not_in("a.id", $_array_level);
	$this->db->where("a.IsActive", 1);
	$rs = $this->db->get();
	
	if( $rs->num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $rows )
	{		
		$data[$rows['id']] = $rows['name'];
	}

	return (array)$data;
}

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 		
 public function getLevelUserPullData()
{
  $_array_level = array();  
  $data = array();
  
 // ---------- define sesion -------------------
 
 if( strcmp( _get_session('HandlingType'), USER_ROOT) == 0 ){ 
	 $_array_level = array(USER_QUALITY_STAFF,USER_QUALITY_HEAD,USER_UPLOADER);
 }
 
 if(_get_session('HandlingType')==USER_ADMIN ) 
	$_array_level = array(USER_QUALITY_STAFF,USER_QUALITY_HEAD, USER_ROOT, USER_UPLOADER);
		
 if(_get_session('HandlingType')==USER_ACCOUNT_MANAGER ) 
	$_array_level = array( USER_ADMIN, USER_ROOT, USER_QUALITY_STAFF,USER_QUALITY_HEAD, USER_UPLOADER);
		
 if(_get_session('HandlingType')==USER_MANAGER ) 
	$_array_level = array( USER_ADMIN,USER_ACCOUNT_MANAGER, USER_ROOT, USER_QUALITY_STAFF,USER_QUALITY_HEAD,USER_UPLOADER);
		
 if(_get_session('HandlingType')==USER_QUALITY_STAFF ) 
	$_array_level = array();
		
 if(_get_session('HandlingType')==USER_QUALITY_HEAD ) 
	$_array_level = array();
		
 if(_get_session('HandlingType')==USER_SUPERVISOR ) 
	$_array_level = array( USER_ADMIN, USER_MANAGER, USER_ACCOUNT_MANAGER, USER_ROOT, USER_QUALITY_STAFF,USER_QUALITY_HEAD, USER_UPLOADER);
		
 if(_get_session('HandlingType')==USER_LEADER ) 
	$_array_level = array( USER_ADMIN, USER_MANAGER, USER_ROOT, USER_ACCOUNT_MANAGER, USER_QUALITY_STAFF,USER_QUALITY_HEAD, USER_SUPERVISOR, USER_UPLOADER);	
	
	
/** run of query statments **/
	
	$this->db->reset_select();
	$this->db->select("a.id, a.name", FALSE);
	$this->db->from("tms_agent_profile a");
	$this->db->where_not_in("a.id", $_array_level);
	$this->db->where("a.IsActive", 1);
	$rs = $this->db->get();
	
	if( $rs->num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $rows )
	{		
		$data[$rows['id']] = $rows['name'];
	}

	return (array)$data;
}
		
// ------------------------------------------------------------------------
/*
 * @ aksess : .public 
 */
 
public function DistribusiType()
{
	$datas = array(1=>'Bagi Rata',2=>'Jumlah Agent Tertentu');
	if( is_array($datas) ) {
		return $datas;
	}
}

// ------------------------------------------------------------------------
/*
 * @ aksess : .public 
 */
 
 public function DistribusiAction()
{
   $arr_action = array(1=>'Quantity',2=>'Checked');
	if( is_array($arr_action) ) 
 {
	return (array)$arr_action;
  }
}

		
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function DistribusiMode()
 {
	return array( 1 => 'Urutan',2 => 'Acak' );
 }
 
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _get_count_privileges( $CampaignId=0, $_status='')
 {
	$_totals = array();
	$conds1 = " date(now()) ";
	if( QUERY == 'mssql') {
		$conds1 = " CONVERT(varchar, getdate(),23) ";
	}
	
	$_wheres = " SELECT count(b.CustomerId) as jumlah,  a.CampaignStatusFlag as conds
				 FROM t_gn_campaign a 
				 INNER JOIN t_gn_customer b on a.CampaignId=b.CampaignId 
				 INNER JOIN t_gn_assignment  c on b.CustomerId=c.CustomerId
				 WHERE a.CampaignStatusFlag IN( '".self::$Active."','".self::$NotActive."')
				 AND b.expired_date >= {$conds1}
				 AND a.CampaignId = '$CampaignId' ";
	
	if( $this -> EUI_Session -> _get_session('HandlingType') == USER_ROOT )	
		$_wheres.= " AND c.AssignAmgr IS NULL
					 AND c.AssignMgr IS NULL
					 AND c.AssignSpv IS NULL
					 AND c.AssignSelerId IS NULL 
					 GROUP BY a.CampaignStatusFlag ";
							
	else if( $this -> EUI_Session -> _get_session('HandlingType') == USER_ADMIN )	
		$_wheres.= " AND c.AssignMgr IS NULL
					 AND c.AssignSpv IS NULL
					 AND c.AssignSelerId IS NULL 
					 GROUP BY a.CampaignStatusFlag ";
						 
	else if( $this -> EUI_Session -> _get_session('HandlingType') == USER_ACCOUNT_MANAGER )	
		$_wheres.= " AND c.AssignAmgr = '".$this -> EUI_Session -> _get_session('UserId')."'
					 AND c.AssignMgr IS NULL
					 AND c.AssignSpv IS NULL
					 AND c.AssignSelerId IS NULL";		
					 
	else if( $this -> EUI_Session -> _get_session('HandlingType') == USER_MANAGER )	
		$_wheres.= " AND c.AssignMgr = '".$this -> EUI_Session -> _get_session('UserId')."'
					 AND c.AssignSpv IS NULL
					 AND c.AssignSelerId IS NULL";
		 
	
	else if( $this -> EUI_Session -> _get_session('HandlingType') == USER_SUPERVISOR )	
		$_wheres.= " AND c.AssignMgr IS NOT NULL
					 AND c.AssignSpv = '".$this -> EUI_Session -> _get_session('UserId')."'
					 AND c.AssignSelerId IS NULL 
					 GROUP BY a.CampaignStatusFlag ";

	else if( $this -> EUI_Session -> _get_session('HandlingType') == USER_LEADER )	
		$_wheres.= " AND c.AssignMgr IS NOT NULL
					 AND c.AssignLeader = '".$this -> EUI_Session -> _get_session('UserId')."'
					 AND c.AssignSpv IS NOT NULL
					 AND c.AssignSelerId IS NULL 
					 GROUP BY a.CampaignStatusFlag ";
					 
 // start && run query 
	$qry = $this -> db ->query($_wheres);
	foreach( $qry -> result_assoc() as $rows ){
		$_totals[$rows['conds']]+= $rows['jumlah'];
	}
	
	if( $_status !='' ) 
		return (INT)$_totals[$_status];
	else
	{
		return (($_totals[self::$Active])+($_totals[self::$NotActive]));
	}
}	


// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
 protected function set_like_group( $field="", $operator = "", $arr_val = null )
{
	$this->arr_ptr = array('LIKE' => 'LIKE','NOT_LIKE' => 'NOT LIKE');
	$this->arr_sec = array();
	
	if( is_array($arr_val) ) 
		foreach($arr_val as $k => $value )
	{
		if( in_array($operator, array_keys($this->arr_ptr) )){
			$this->arr_sec[] = $field ." ". $this->arr_ptr[$operator] . " '%". trim($value)."%' "; 
		}		
	}
	
	if( count($this->arr_sec) == 0  ){
		return FALSE;
	}	
	
	$this->arr_sec = " ( ". join(" OR ", $this->arr_sec) ." ) ";
	return (string)$this->arr_sec;
} 

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
public function _select_page_distribute( $out  = null, $field = null )
{

 	// ---------- call not interest -------------------------
 	$ar_call_not_interest = array_keys(CallResultInterest());	
 	$conds1 = " (YEAR(NOW())-YEAR(b.CustomerDOB)) as CustomerAge, ";
 	$conds2 = " date(now()) ";
 	// mode mssql
 	if( QUERY == 'mssql') {
 		$conds1 = " ( YEAR(getdate()) - YEAR(b.CustomerDOB) ) as CustomerAge, ";
 		$conds2 = " CONVERT(varchar, getdate(),23)";
 	}
 
 	$arr_assign_data = array();
 	$this->db->reset_select();
 	// -------- inull then get default ----------------
 	if( is_null($field) )	
 	{
		$this->db->select("
			a.AssignId as DistAssignId, 
			c.CampaignName as CampaignName,
			b.Recsource as Recsource,
			b.CustomerNumber as CustomerNumber,
			b.CustomerFirstName as CustomerFirstName,
			b.mkt_code as CustomerMktKode,
			e.CallReasonCategoryName as CallStatus,
			b.CallReasonId as CallReasonId,
			b.CustomerDOB as CustomerDOB, 
			{$conds1}
			b.GenderId as GenderId,
			b.CustomerAddressLine1 as CustomerAddressLine1,
			b.CustomerAddressLine2 as CustomerAddressLine2,
			b.CustomerAddressLine3 as CustomerAddressLine3,
			b.CustomerAddressLine4 as CustomerAddressLine4,
			b.CustomerCity as CustomerCity,
			(SELECT count(ts.CallHistoryId) as atempt FROM t_gn_callhistory ts WHERE ts.CustomerId = a.CustomerId AND ts.HistoryType = 0 ) as Atempt, 
			b.CustomerUpdatedTs as LastCallDate,
			b.CustomerUploadedTs as CustomerUploadedTs", FALSE); 
 	} else {
		$this->db->select($field, FALSE); 
 	}
 
 	$this->db->from("t_gn_assignment a");
 	$this->db->join("t_gn_customer b "," a.CustomerId=b.CustomerId", "LEFT"); 
 	$this->db->join("t_gn_filter_product d "," b.CustomerId=d.prod_cust_id ","LEFT");
 	$this->db->join("t_gn_campaign c "," b.CampaignId=c.CampaignId ","LEFT");
 	$this->db->join("t_lk_callreasoncategory e "," b.CustomerStatus=e.CallReasonCategoryId ","LEFT");
 	$this->db->where("a.AssignBlock", 0);
 	$this->db->where("b.expired_date >= {$conds2}");
 	$this->db->where("b.campaignid != 9");
 	// $this->db->where_not_in("b.CallReasonId", $ar_call_not_interest);
 
 	// ---------------- set call result ----------------------------------
  	if( _get_have_post('dis_call_reason')){
		$this->db->where_in("b.CallReasonId", $out->get_array_value('dis_call_reason') );
  	}
  
  	// ----------- set filter by pos ------------------
  	if( _get_have_post('dis_campaign_name')) {
		$this->db->where("b.CampaignId", $out->get_value('dis_campaign_name') );
  	}

  	if( _get_have_post('dis_recsource_name')){
		// $this->db->where("b.Recsource", $out->get_value('dis_recsource_name') );
	 	$this->db->where_in("b.Recsource", $out->get_array_value('dis_recsource_name'));
  	}
  
  	if( _get_have_post('mkt_code')){
		$this->db->like("b.mkt_code", $out->get_value('mkt_code') );
  	}
  
  	if( _get_have_post('customer_name')){
		$this->db->like("b.CustomerFirstName", $out->get_value('customer_name') );
  	}

  	if( _get_have_post('dis_gender_id')){
		$this->db->where("b.GenderId", $out->get_value('dis_gender_id') );
  	}
  
  	if( _get_have_post('dis_start_upload_date') AND  _get_have_post('dis_end_upload_date'))
  	{
		$this->db->where("b.CustomerUploadedTs >='{$out->get_value('dis_start_upload_date','StartDate')}' 
		AND b.CustomerUploadedTs <='{$out->get_value('dis_end_upload_date','EndDate')}'", "", FALSE);
  	}	
  
   	// ----------------------------------------- last call date -----------------------------
  	if( _get_have_post('dis_start_last_call_date') AND  _get_have_post('dis_end_last_call_date'))
  	{
		$this->db->where("b.CustomerUpdatedTs >='{$out->get_value('dis_start_last_call_date','StartDate')}' 
		AND b.CustomerUpdatedTs <='{$out->get_value('dis_end_last_call_date','EndDate')}'", "", FALSE);
  	}	
 
 	// -------------------- filter data from user ---------------
 	if( _get_have_post('dis_field_filter1') AND _get_have_post('dis_field_value1') AND _get_have_post('dis_field_text1') )
 	{
		$this->val_str = $this->set_like_group( $out->get_value('dis_field_value1'), $out->get_value('dis_field_filter1'),$out->get_array_value('dis_field_text1') );
		if( $this->val_str ){
			$this->db->where($this->val_str, "", FALSE);
		}
 	}	
 
 	// -------------------- filter data from user ---------------
 	if( _get_have_post('dis_field_filter2') AND _get_have_post('dis_field_value2')  AND _get_have_post('dis_field_text2') )
 	{
		$this->val_str = $this->set_like_group( $out->get_value('dis_field_value2'), $out->get_value('dis_field_filter2'),$out->get_array_value('dis_field_text2') );
		if( $this->val_str ){
			$this->db->where($this->val_str, "", FALSE);
		}
 	}	
 
	// -------- set by field login ------ --------------
 	$AssignField = $this->_select_row_field_level(_get_session('HandlingType'));
  
 	// ----------- login ROOT && ADMIN ----
 	if( _have_get_session('UserId') AND _get_session('HandlingType') == USER_ROOT )
 	{
		$cfg =& Config();
		//--$this->db->where("a.$AssignField", _get_session('UserId'));
		$this->db->where("(a.AssignMgr = 0 OR a.AssignMgr IS NULL)", "", FALSE);
		$this->db->where_in("a.AssignAdmin", $cfg->push('default_admin', 0) );
 	}	 

 	// ----------- login USER_ACCOUNT_MANAGER  ----
 	// echo $AssignField;
 	if( _have_get_session('UserId') AND _get_session('HandlingType') ==USER_ADMIN )
 	{
		//--$this->db->where("a.$AssignField", _get_session('UserId'));
		$this->db->where("(a.AssignMgr = 0 OR a.AssignMgr IS NULL)", "", FALSE);
		// $this->db->where("a.AssignAmgr IS NULL", "", FALSE);
 	}	 

 	// ----------- login USER_ACCOUNT_MANAGER  ----
 
 	if( _have_get_session('UserId') AND _get_session('HandlingType') == USER_ACCOUNT_MANAGER )
 	{
		$this->db->where("a.$AssignField", _get_session('UserId'));
		$this->db->where("(a.AssignSpv = 0 OR a.AssignSpv IS NULL)", "", FALSE);
		// $this->db->where("a.AssignSpv IS NULL", "", FALSE);
 	}	

 	// ----------- login USER_MANAGER  ----
 	if( _have_get_session('UserId') AND _get_session('HandlingType') == USER_MANAGER )
 	{
		$this->db->where("a.$AssignField", _get_session('UserId'));
		$this->db->where("(a.AssignSpv = 0 OR a.AssignSpv IS NULL)", "", FALSE);
		// $this->db->where("a.AssignSpv IS NULL", "", FALSE);
 	}	

 	// ----------- login USER_SUPERVISOR  ----
 	if( _have_get_session('UserId') AND _get_session('HandlingType') ==USER_SUPERVISOR )
 	{
		$this->db->where("a.$AssignField", _get_session('UserId'));
		// $this->db->where("(a.AssignLeader = 0 OR a.AssignLeader IS NULL)", "", FALSE);
		$this->db->where("(a.AssignSelerId = 0 OR a.AssignSelerId IS NULL)", "", FALSE);
		// $this->db->where("a.AssignLeader IS NULL", "", FALSE);
 	}	 
 
 	// ----------- login USER_LEADER  ----
 	if( _have_get_session('UserId') AND _get_session('HandlingType') ==USER_LEADER )
 	{
		$this->db->where("a.$AssignField", _get_session('UserId'));
		$this->db->where("(a.AssignSelerId = 0 OR a.AssignSelerId IS NULL)", "", FALSE);
		// $this->db->where("a.AssignSelerId IS NULL", "", FALSE);
 	}

 	// --------- start on Atempt ------------------------- 
	if( _get_have_post('dis_start_atempt') ){
		#$this->db->having("Atempt>='{$out->get_value('dis_start_atempt','intval')}'", "", FALSE);
		$dis_start_atempt = (int)$out->get_value('dis_start_atempt','intval');
		$this->db->where("(SELECT count(ts.CallHistoryId) as atempt FROM t_gn_callhistory ts WHERE ts.CustomerId = a.CustomerId AND ts.HistoryType = 0 ) >=", $dis_start_atempt);
	}
 
	// --------- end on Atempt ------------------------- 
	if( _get_have_post('dis_end_atempt') ){
		#$this->db->having("Atempt<='{$out->get_value('dis_end_atempt','intval')}'", "", FALSE);
		$dis_end_atempt = (int)$out->get_value("dis_end_atempt","intval");
		$this->db->where("(SELECT count(ts.CallHistoryId) as atempt FROM t_gn_callhistory ts WHERE ts.CustomerId = a.CustomerId AND ts.HistoryType = 0 ) <= ",$dis_end_atempt);
	}
 
 	if( _get_have_post('dis_start_dob') AND _get_have_post('dis_end_dob'))
 	{
		$this->db->having("Age>='{$out->get_value('dis_start_dob','intval')}'", "", false);
		$this->db->having("Age<='{$out->get_value('dis_end_dob','intval')}'", "", false);
	}

	// ----------- set order -------------------------	
 	if( _get_have_post("orderby") ){
		$this->db->order_by($out->get_value("orderby"), $out->get_value("type") );
 	} else {
		$this->db->order_by("a.AssignId", "DESC");
 	}
 
 	// $this->db->print_out();
 	// echo $this->db->_get_var_dump();
 	$rs = $this->db->get();
 	#var_dump( $this->db->last_query() );die();
 	if( $rs->num_rows() > 0 ){
		$arr_assign_data = (array)$rs->result_assoc();
  	}
  	return (array)$arr_assign_data;
} 
 
// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
 
 public function _select_page_transfer( $out  = null, $field = null )
{
	
 $arr_assign_data = array();
 $this->db->reset_select();
 
 // -----------------------------------------------------------
 // ---------- call not interest -------------------------

  $ar_call_not_interest = array_keys(CallResultInterest());
  $objCallResult =&Singgleton('M_SetCallResult');
  
  $conds1 = " (YEAR(NOW())-year(b.CustomerDOB)) as CustomerAge, ";
  if( QUERY == 'mssql') {
  	$conds1 = " ( YEAR(getdate()) - YEAR(b.CustomerDOB) ) as CustomerAge, ";
  } 

 // -------- inull then get default ----------------
 if( is_null($field) )	
 {
	 $this->db->select("
		a.AssignId as TransAssignId, 
		c.CampaignName as CampaignName,
		b.Recsource as Recsource,
		b.CustomerNumber as CustomerNumber,
		b.CustomerFirstName as CustomerFirstName,
		b.mkt_code as CustomerMktKode,
		b.CustomerStatus as CallStatus,
		b.CallReasonId as CallReasonId,
		b.CustomerDOB as CustomerDOB, 
		{$conds1}
		b.GenderId as GenderId,
		b.CustomerAddressLine1 as CustomerAddressLine1,
		b.CustomerAddressLine2 as CustomerAddressLine2,
		b.CustomerAddressLine3 as CustomerAddressLine3,
		b.CustomerAddressLine4 as CustomerAddressLine4,
		b.CustomerCity as CustomerCity,
		a.AssignSelerId as Username,
		(select count(ts.CallHistoryId) as atempt FROM t_gn_callhistory ts WHERE ts.CustomerId = b.CustomerId AND ts.HistoryType = 0 ) as Atempt, 
		b.CustomerUpdatedTs as LastCallDate,
		b.CustomerUploadedTs as CustomerUploadedTs",  FALSE); 
  } else {
	$this->db->select($field, FALSE); 
 }
 
 $this->db->from("t_gn_assignment a");
 $this->db->join("t_gn_customer b "," a.CustomerId=b.CustomerId", "LEFT");
 $this->db->join("t_gn_filter_product d "," b.CustomerId=d.prod_cust_id ","LEFT");
 $this->db->join("t_gn_campaign c "," b.CampaignId=c.CampaignId ","LEFT");
 
 $this->db->where("b.flag_abandon", 0);
 $this->db->where("a.AssignBlock", 0);
 $this->db->where("b.Flag_Followup", 0);
 $this->db->where(sprintf("b.expired_date >='%s'", date('Y-m-d')),"", false);
 $this->db->where("b.campaignid != 9");
 
 // var_dump($ar_call_not_interest);
 if( is_array($ar_call_not_interest) && count($ar_call_not_interest)>0 )
 {
	$this->db->where_not_in("b.CallReasonId", $ar_call_not_interest);
 }
// ----------- set filter by pos ------------------

  if( _get_have_post('trans_from_campaign_id')){
	$this->db->where_in("b.CampaignId", $out->get_array_value('trans_from_campaign_id','intval') );
  }	
  
  if( _get_have_post('trans_call_result_id')){
	$this->db->where_in("b.CallReasonId", $out->get_array_value('trans_call_result_id','intval') );
  }
  
  
  //trans_call_status_id
  if( _get_have_post('trans_call_status_id')){
	$this->db->where_in("b.CustomerStatus", $out->get_array_value('trans_call_status_id','intval') );
  }
  
  if( _get_have_post('trans_call_start_date') 
	  AND _get_have_post('trans_end_start_date'))
  {
	$this->db->where("b.CustomerUpdatedTs >='{$out->get_value('trans_call_start_date','StartDate')}' 
		AND b.CustomerUpdatedTs<='{$out->get_value('trans_end_start_date','EndDate')}'", "", FALSE);
  }	

  if( _get_have_post('trans_form_user_list') ) 
 {
	$Field = $this->_select_row_field_level($out->get_value('trans_from_user_group'));  
	$this->db->where_in("a.$Field",  $out->get_array_value('trans_form_user_list', 'intval'));
  }
  
 // -------------------- filter data from user ---------------
 if( _get_have_post('trans_field_filter1') AND _get_have_post('trans_field_value1')  
	AND _get_have_post('trans_field_text1') )
 {
	$this->val_str = $this->set_like_group( 
		$out->get_value('trans_field_value1'), 
			$out->get_value('trans_field_filter1'),
				$out->get_array_value('trans_field_text1') );
	if( $this->val_str ){
		$this->db->where($this->val_str, "", FALSE);
	}
 }	
 
 
// -----------------------------------------------------------------------------------------------------
// -------- set by field login ------ --------------

 $AssignField = $this->_select_row_field_level(_get_session('HandlingType'));
 
// ----------- login ROOT && ADMIN ----
 
 if( _have_get_session('UserId') 
	AND _get_session('HandlingType') ==USER_ROOT )
 {
	$this->db->where("a.AssignMgr IS NOT NULL", "", FALSE);
 }	 
 
 // ----------- login AMGR  ----
 
  if( _have_get_session('UserId') 
	AND _get_session('HandlingType') ==USER_ADMIN )
{
	$this->db->where("a.AssignAmgr IS NOT NULL", "", FALSE);
	$this->db->where("a.AssignMgr IS NOT NULL", "", FALSE);
 }	

 // ----------- login MGR  ----
 
 if( _have_get_session('UserId') 
	AND _get_session('HandlingType') ==USER_ACCOUNT_MANAGER )
 {
	$this->db->where("a.$AssignField", _get_session('UserId'));
	$this->db->where("a.AssignMgr IS NOT NULL", "", FALSE);
	$this->db->where("a.AssignSpv IS NOT NULL", "", FALSE);
	
 }	

// ----------- login SPV  ----
 
  if( _have_get_session('UserId') 
	AND _get_session('HandlingType') ==USER_MANAGER )
  {
	 $this->db->where("a.$AssignField", _get_session('UserId'));
	 $this->db->where("a.AssignMgr IS NOT NULL", "", FALSE);
	 $this->db->where("a.AssignSpv IS NOT NULL", "", FALSE);
	 $this->db->where("a.AssignSelerId IS NOT NULL", "", FALSE);
  }	 
 
// ----------- login LEADER  ----
 
 if( _have_get_session('UserId') 
	AND _get_session('HandlingType') ==USER_SUPERVISOR )
 {
	$this->db->where("a.$AssignField", _get_session('UserId'));
	$this->db->where("a.AssignMgr IS NOT NULL", "", FALSE);
	$this->db->where("a.AssignSpv IS NOT NULL", "", FALSE);
	$this->db->where("a.AssignSelerId IS NOT NULL", "", FALSE); 
	// $this->db->where("a.AssignLeader IS NOT NULL", "", FALSE); 
 }
 
 if( _have_get_session('UserId') 
	AND _get_session('HandlingType') ==USER_LEADER )
 {
	$this->db->where("a.$AssignField", _get_session('UserId'));
	$this->db->where("a.AssignMgr IS NOT NULL", "", FALSE);
	$this->db->where("a.AssignSpv IS NOT NULL", "", FALSE);
	$this->db->where("a.AssignSelerId IS NOT NULL", "", FALSE); 
	$this->db->where("a.AssignLeader IS NOT NULL", "", FALSE); 
 }
 

 
/*// --------- start on Atempt ------------------------- 
if( _get_have_post('trans_start_call_atempt') ){
	$this->db->having("Atempt>='{$out->get_value('trans_start_call_atempt','intval')}'", "", FALSE);
}

// --------- end on Atempt ------------------------- 
if( _get_have_post('trans_end_call_atempt') ){
	$this->db->having("Atempt<='{$out->get_value('trans_end_call_atempt','intval')}'", "", FALSE);
}*/

// --------- start on Atempt ------------------------- 
if( _get_have_post('trans_start_call_atempt') ){
	$dis_start_atempt = (int)$out->get_value('trans_start_call_atempt','intval');
	$this->db->where("(SELECT count(ts.CallHistoryId) as atempt FROM t_gn_callhistory ts WHERE ts.CustomerId = a.CustomerId AND ts.HistoryType = 0 ) >=", $dis_start_atempt);
}

// --------- end on Atempt ------------------------- 
if( _get_have_post('trans_end_call_atempt') ){
	$dis_end_atempt = (int)$out->get_value("trans_end_call_atempt","intval");
	$this->db->where("(SELECT count(ts.CallHistoryId) as atempt FROM t_gn_callhistory ts WHERE ts.CustomerId = a.CustomerId AND ts.HistoryType = 0 ) <= ",$dis_end_atempt);
}

 
// ----------- set order -------------------------
	
 if( _get_have_post("orderby") ){
	$this->db->order_by($out->get_value("orderby"), $out->get_value("type") );
 } else {
	$this->db->order_by("a.AssignId", "DESC");
 }
 
 //$this->db->limit(200);
 // $this->db->print_out();
 
 
 $rs = $this->db->get();
  if( $rs->num_rows() > 0 )
 {
	$arr_assign_data = (array)$rs->result_assoc();
  }
  
  return (array)$arr_assign_data;
} 
  
 
// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
 
 public function _select_page_pulldata( $out  = null, $field = null )
{
	
 $arr_assign_data = array();
 $conds1 = " (YEAR(NOW())-year(b.CustomerDOB)) as CustomerAge, ";
 $conds2 = " date(now()) ";
 if( QUERY == 'mssql') {
 	$conds1 = " ( YEAR(getdate()) - YEAR(b.CustomerDOB) ) as CustomerAge, ";
 	$conds2 = " CONVERT(varchar, getdate(),23) ";
 }

 $this->db->reset_select();
 // ----------------- look ats ------------------------------------ 
 $ar_call_not_interest = array_keys(CallResultInterest());
 // -----------------------------------------------------------
  $objCallResult =& get_class_instance('M_SetCallResult');
  
// -------- inull then get default ----------------
if( is_null($field) )	
{
		// c.CampaignName as CampaignName,
		// b.Recsource as Recsource,
		// b.CustomerNumber as CustomerNumber,
		// b.CustomerFirstName as CustomerFirstName,
		// b.mkt_code as CustomerMktKode,
		// b.CustomerStatus as CallStatus,
		// b.CallReasonId as CallReasonId,
		// b.CustomerDOB as CustomerDOB, 
		// (YEAR(NOW())-year(b.CustomerDOB)) as CustomerAge,
		// b.GenderId as GenderId,
		// b.CustomerAddressLine1 as CustomerAddressLine1,
		// b.CustomerAddressLine2 as CustomerAddressLine2,
		// b.CustomerAddressLine3 as CustomerAddressLine3,
		// b.CustomerAddressLine4 as CustomerAddressLine4,
		// b.CustomerCity as CustomerCity,
		// a.AssignSelerId as Username,
		// (select count(ts.CallHistoryId) as atempt FROM t_gn_callhistory ts WHERE ts.CustomerId = b.CustomerId AND ts.HistoryType = 0 ) as Atempt, 
		// b.CustomerUpdatedTs as LastCallDate,
		// b.CustomerUploadedTs as CustomerUploadedTs",  FALSE); 
		
	$this->db->select("
		a.AssignId as PullAssignId, 
		c.CampaignName as CampaignName,
		b.Recsource as Recsource,
		b.CustomerNumber as CustomerNumber,
		b.CustomerFirstName as CustomerFirstName,
		b.mkt_code as CustomerMktKode,
		e.CallReasonCategoryName as CallStatus,
		b.CallReasonId as CallReasonId,
		b.CustomerDOB as CustomerDOB,
		{$conds1}
		b.GenderId as GenderId,
		b.CustomerAddressLine1 as CustomerAddressLine1,
		b.CustomerAddressLine2 as CustomerAddressLine2,
		b.CustomerAddressLine3 as CustomerAddressLine3,
		b.CustomerAddressLine4 as CustomerAddressLine4,
		b.CustomerCity as CustomerCity,
		a.AssignSelerId as Username,
		(select count(ts.CallHistoryId) as atempt FROM t_gn_callhistory ts WHERE ts.CustomerId = b.CustomerId AND ts.HistoryType = 0 ) as Atempt, 
		b.CustomerUpdatedTs as LastCallDate,
		b.CustomerUploadedTs as CustomerUploadedTs",  FALSE); 
 } else {
	$this->db->select($field, FALSE); 
 }
 
 $this->db->from("t_gn_assignment a");
 $this->db->join("t_gn_customer b "," a.CustomerId=b.CustomerId", "LEFT");
 $this->db->join("t_gn_filter_product d "," b.CustomerId=d.prod_cust_id ","LEFT");
 $this->db->join("t_gn_campaign c "," b.CampaignId=c.CampaignId ","LEFT");
 $this->db->join("t_lk_callreasoncategory e "," b.CustomerStatus=e.CallReasonCategoryId ","LEFT");
 
 $this->db->where("a.AssignBlock", 0);
 $this->db->where("b.flag_abandon", 0);
 $this->db->where("b.expired_date >= {$conds2}");
 $this->db->where("b.Flag_Followup", 0);
 $this->db->where("b.campaignid != 9");
 
  if( is_array($ar_call_not_interest) && count($ar_call_not_interest)>0 )
 {
	$this->db->where_not_in("b.CallReasonId", $ar_call_not_interest);
 }
 // $this->db->where_not_in("b.CallReasonId", $ar_call_not_interest);
 
// ----------- set filter by pos ------------------

  if( _get_have_post('pull_from_campaign_id')){
	$this->db->where_in("b.CampaignId", $out->get_array_value('pull_from_campaign_id','intval') );
  }	
  
  if( _get_have_post('pull_call_result_id')){
	$this->db->where_in("b.CallReasonId", $out->get_array_value('pull_call_result_id','intval') );
  }
  
  if( _get_have_post('pull_call_status_id')){
	$this->db->where_in("b.CustomerStatus", $out->get_array_value('pull_call_status_id','intval') );
  }
  
  
  
  if( _get_have_post('pull_recsource_name')){
	// $this->db->where("b.Recsource", $out->get_value('pull_recsource_name') );
	$this->db->where_in("b.Recsource",$out->get_array_value('pull_recsource_name'));
  }
  
  if( _get_have_post('mkt_code')){
	$this->db->like("b.mkt_code", $out->get_value('mkt_code') );
  }
  
  if( _get_have_post('customer_name')){
	$this->db->like("b.CustomerFirstName", $out->get_value('customer_name') );
  }
  
  if( _get_have_post('pull_call_start_date') 
	  AND _get_have_post('pull_end_start_date'))
  {
	$this->db->where("b.CustomerUpdatedTs >='{$out->get_value('pull_call_start_date','StartDate')}' 
		AND b.CustomerUpdatedTs<='{$out->get_value('pull_end_start_date','EndDate')}'", "", FALSE);
  }	

  if( _get_have_post('pull_form_user_list') ) 
 {
	$Field = $this->_select_row_field_level($out->get_value('pull_from_user_group'));  
	$this->db->where_in("a.$Field",  $out->get_array_value('pull_form_user_list', 'intval'));
  }
  
// -------------------- filter data from user ---------------
 if( _get_have_post('pull_field_filter1') AND _get_have_post('pull_field_value1')  
	AND _get_have_post('pull_field_text1') )
 {
	$this->val_str = $this->set_like_group( 
		$out->get_value('pull_field_value1'), 
			$out->get_value('pull_field_filter1'),
				$out->get_array_value('pull_field_text1') );
	if( $this->val_str ){
		$this->db->where($this->val_str, "", FALSE);
	}
 }	
   
  
// -----------------------------------------------------------------------------------------------------
// -------- set by field login ------ --------------

 $AssignField = $this->_select_row_field_level(_get_session('HandlingType'));
 
// ----------- login ROOT && ADMIN ----
 
 if( _have_get_session('UserId') 
	AND _get_session('HandlingType') ==USER_ROOT )
 {
	$this->db->where("a.AssignAmgr IS NOT NULL", "", FALSE);
 }	 
 
 // ----------- login AMGR  ----
 
  if( _have_get_session('UserId') 
	AND _get_session('HandlingType') ==USER_ADMIN )
{
	$this->db->where("a.AssignMgr IS NOT NULL", "", FALSE);
}	

 // ----------- login MGR  ----
 
 if( _have_get_session('UserId') 
	AND _get_session('HandlingType') ==USER_ACCOUNT_MANAGER )
 {
	$this->db->where("a.$AssignField", _get_session('UserId'));
	$this->db->where("a.AssignSpv IS NOT NULL","",false);
 }	

// ----------- login SPV  ----
 
  if( _have_get_session('UserId') 
	AND _get_session('HandlingType') ==USER_MANAGER )
  {
	 $this->db->where("a.$AssignField", _get_session('UserId'));
  }	 
 
// ----------- login LEADER  ----
 
 if( _have_get_session('UserId') 
	AND _get_session('HandlingType') ==USER_SUPERVISOR )
 {
	$this->db->where("a.$AssignField", _get_session('UserId'));
	// $this->db->where("a.AssignLeader IS NOT NULL","",false);
	$this->db->where("a.AssignSelerId IS NOT NULL","",false);
	
 }
 
 if( _have_get_session('UserId') 
	AND _get_session('HandlingType') ==USER_LEADER )
 {
	$this->db->where("a.$AssignField", _get_session('UserId'));
	$this->db->where("a.AssignSelerId IS NOT NULL","",false);
	
 }
 

// --------- start on Atempt ------------------------- 
// if( _get_have_post('pull_start_call_atempt') ){
// 	$this->db->having("Atempt>='{$out->get_value('pull_start_call_atempt','intval')}'", "", FALSE);
// }

// // --------- end on Atempt ------------------------- 

// if( _get_have_post('pull_end_call_atempt') ){
// 	$this->db->having("Atempt<='{$out->get_value('pull_end_call_atempt','intval')}'", "", FALSE);
// }

// --------- start on Atempt ------------------------- 
if( _get_have_post('pull_start_call_atempt') ){
	$dis_start_atempt = (int)$out->get_value('pull_start_call_atempt','intval');
	$this->db->where("(SELECT count(ts.CallHistoryId) as atempt FROM t_gn_callhistory ts WHERE ts.CustomerId = a.CustomerId AND ts.HistoryType = 0 ) >=", $dis_start_atempt);
}

// --------- end on Atempt ------------------------- 
if( _get_have_post('pull_end_call_atempt') ){
	$dis_end_atempt = (int)$out->get_value("pull_end_call_atempt","intval");
	$this->db->where("(SELECT count(ts.CallHistoryId) as atempt FROM t_gn_callhistory ts WHERE ts.CustomerId = a.CustomerId AND ts.HistoryType = 0 ) <= ",$dis_end_atempt);
} 

 
// ----------- set order -------------------------
	
 if( _get_have_post("orderby") ){
	$this->db->order_by($out->get_value("orderby"), $out->get_value("type") );
 } else {
	$this->db->order_by("a.AssignId", "DESC");
 }

// ------ print debug out --------- 
#$this->db->print_out();
 
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ){
	$arr_assign_data = (array)$rs->result_assoc();
  }
 

  return (array)$arr_assign_data;
} 
  
  
 
 
// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
function _select_row_assign_level( $AssignId = 0 )
{
  $arr_group =& UserPrivilege();
  $this->db->reset_select();
  $this->db->select("
	( select t1.full_name as t1 from tms_agent t1 where t1.UserId=a.AssignAdmin ) as Level1,
	( select t2.full_name as t2 from tms_agent t2 where t2.UserId=a.AssignAmgr ) as Level2,
	( select t3.full_name as t3 from tms_agent t3 where t3.UserId=a.AssignMgr ) as Level3,
	( select t4.full_name as t4 from tms_agent t4 where t4.UserId=a.AssignSpv ) as Level4,
	( select t5.full_name as t5 from tms_agent t5 where t5.UserId=a.AssignLeader ) as Level5,
	( select t6.full_name as t6 from tms_agent t6 where t6.UserId=a.AssignSelerId ) as Level6", FALSE);
	
  $this->db->from("t_gn_assignment a");
  $this->db->where("a.AssignId", $AssignId);
  
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
  {
	 $arr_rows = array();
	 $rows = $rs->result_first_assoc();	
	 if(is_array($rows))foreach( $rows as $k => $val ) 
	{
		if( !is_null($val) ) 
		{
			$arr_rows[$k] = $val;
		}
	 }	 
	 return join("<br>", $arr_rows);
  }	  
  return null;
  
}

/**** SECTION PDS *******/
/**
 * (F) _select_page_distributePDS 
 * @param  Object $out
 * @param  [type] $field
 */
public function _select_page_distributePDS( $out  = null, $field = null )
{
	#var_dump('DEBUG'); die();

 	// ---------- call not interest -------------------------
 	$ar_call_not_interest = array_keys(CallResultInterest());	
 	$conds1 = " (YEAR(NOW())-YEAR(b.CustomerDOB)) as CustomerAge, ";
 	$conds2 = " date(now()) ";
 	
 	// mode mssql
 	if( QUERY == 'mssql') {
 		$conds1 = " ( YEAR(getdate()) - YEAR(b.CustomerDOB) ) as CustomerAge, ";
 		$conds2 = " CONVERT(varchar, getdate(),23)";
 	}
 
 	$arr_assign_data = array();
 	$this->db->reset_select();
 	// -------- inull then get default ----------------
 	if( is_null($field) )	
 	{
		$this->db->select("
			a.AssignId as DistAssignId,
			c.CampaignName as CampaignName,
			b.Recsource as Recsource,
			b.CustomerNumber as CustomerNumber,
			b.CustomerFirstName as CustomerFirstName,
			b.mkt_code as CustomerMktKode,
			e.CallReasonCategoryName as CallStatus,
			b.CallReasonId as CallReasonId,
			b.CustomerDOB as CustomerDOB, 
			{$conds1}
			b.GenderId as GenderId,
			b.CustomerAddressLine1 as CustomerAddressLine1,
			b.CustomerAddressLine2 as CustomerAddressLine2,
			b.CustomerAddressLine3 as CustomerAddressLine3,
			b.CustomerAddressLine4 as CustomerAddressLine4,
			b.CustomerCity as CustomerCity,
			/*(SELECT count(ts.CallHistoryId) as atempt FROM t_gn_callhistory ts WHERE ts.CustomerId = a.CustomerId AND ts.HistoryType = 0 ) as Atempt, */
			b.CustomerUpdatedTs as LastCallDate,
			b.CustomerUploadedTs as CustomerUploadedTs, a.CustomerId,
			b.CustomerMobilePhoneNum, b.CustomerHomePhoneNum, b.CustomerWorkPhoneNum,
			b.CampaignId",
			FALSE); 
 	} else {
		$this->db->select($field, FALSE); 
 	}
 
 	$this->db->from("t_gn_assignment a");
 	$this->db->join("t_gn_customer b "," a.CustomerId=b.CustomerId", "LEFT"); 
 	$this->db->join("t_gn_filter_product d "," b.CustomerId=d.prod_cust_id ","LEFT");
 	$this->db->join("t_gn_campaign c "," b.CampaignId=c.CampaignId ","LEFT");
 	$this->db->join("t_lk_callreasoncategory e "," b.CustomerStatus=e.CallReasonCategoryId ","LEFT");
 	$this->db->where("a.AssignBlock", 0);
 	$this->db->where("b.expired_date >= {$conds2}");
 	$this->db->where("b.campaignid != 9");
 	$this->db->where("COALESCE(b.Flag_Followup,0) <> 1");
 	$this->db->where("COALESCE(b.Flag_Pds,0) <> 1");
 	$this->db->where_not_in("b.CallReasonId", array(13));
 	// $this->db->where_not_in("b.CallReasonId", $ar_call_not_interest);
 
 	// ---------------- set call result ----------------------------------
  	if( _get_have_post('dis_call_reason')){
		$this->db->where_in("b.CallReasonId", $out->get_array_value('dis_call_reason') );
  	}
  
  	// ----------- set filter by pos ------------------
  	if( _get_have_post('dis_campaign_name')) {
		$this->db->where("b.CampaignId", $out->get_value('dis_campaign_name') );
  	}

  	if( _get_have_post('dis_recsource_name')){
		// $this->db->where("b.Recsource", $out->get_value('dis_recsource_name') );
	 	$this->db->where_in("b.Recsource", $out->get_array_value('dis_recsource_name'));
  	}
  
  	if( _get_have_post('mkt_code')){
		$this->db->like("b.mkt_code", $out->get_value('mkt_code') );
  	}
  
  	if( _get_have_post('customer_name')){
		$this->db->like("b.CustomerFirstName", $out->get_value('customer_name') );
  	}

  	if( _get_have_post('dis_gender_id')){
		$this->db->where("b.GenderId", $out->get_value('dis_gender_id') );
  	}
  
  	if( _get_have_post('dis_start_upload_date') AND  _get_have_post('dis_end_upload_date'))
  	{
		$this->db->where("b.CustomerUploadedTs >='{$out->get_value('dis_start_upload_date','StartDate')}' 
		AND b.CustomerUploadedTs <='{$out->get_value('dis_end_upload_date','EndDate')}'", "", FALSE);
  	}	
  
   	// ----------------------------------------- last call date -----------------------------
  	if( _get_have_post('dis_start_last_call_date') AND  _get_have_post('dis_end_last_call_date'))
  	{
		$this->db->where("b.CustomerUpdatedTs >='{$out->get_value('dis_start_last_call_date','StartDate')}' 
		AND b.CustomerUpdatedTs <='{$out->get_value('dis_end_last_call_date','EndDate')}'", "", FALSE);
  	}	
 
 	// -------------------- filter data from user ---------------
 	if( _get_have_post('dis_field_filter1') AND _get_have_post('dis_field_value1') AND _get_have_post('dis_field_text1') )
 	{
		$this->val_str = $this->set_like_group( $out->get_value('dis_field_value1'), $out->get_value('dis_field_filter1'),$out->get_array_value('dis_field_text1') );
		if( $this->val_str ){
			$this->db->where($this->val_str, "", FALSE);
		}
 	}	
 
 	// -------------------- filter data from user ---------------
 	if( _get_have_post('dis_field_filter2') AND _get_have_post('dis_field_value2')  AND _get_have_post('dis_field_text2') )
 	{
		$this->val_str = $this->set_like_group( $out->get_value('dis_field_value2'), $out->get_value('dis_field_filter2'),$out->get_array_value('dis_field_text2') );
		if( $this->val_str ){
			$this->db->where($this->val_str, "", FALSE);
		}
 	}	
 
	// -------- set by field login ------ --------------
 	$AssignField = $this->_select_row_field_level(_get_session('HandlingType'));
  
 	// ----------- login ROOT && ADMIN ----
 	if( _have_get_session('UserId') AND _get_session('HandlingType') == USER_ROOT )
 	{
		$cfg =& Config();
		$this->db->where("(a.AssignMgr = 0 OR a.AssignMgr IS NULL)", "", FALSE);
		$this->db->where_in("a.AssignAdmin", $cfg->push('default_admin', 0) );
 	}	 

 	// ----------- login USER_ACCOUNT_MANAGER  ----
 	// echo $AssignField;
 	if( _have_get_session('UserId') AND _get_session('HandlingType') ==USER_ADMIN )
 	{
		$this->db->where("(a.AssignMgr = 0 OR a.AssignMgr IS NULL)", "", FALSE);
 	}	 

 	// ----------- login USER_ACCOUNT_MANAGER  ----
 	if( _have_get_session('UserId') AND _get_session('HandlingType') == USER_ACCOUNT_MANAGER )
 	{
		$this->db->where("a.$AssignField", _get_session('UserId'));
		$this->db->where("(a.AssignSpv = 0 OR a.AssignSpv IS NULL)", "", FALSE);
 	}	

 	// ----------- login USER_MANAGER  ----
 	if( _have_get_session('UserId') AND _get_session('HandlingType') == USER_MANAGER )
 	{
		$this->db->where("a.$AssignField", _get_session('UserId'));
		$this->db->where("(a.AssignSpv = 0 OR a.AssignSpv IS NULL)", "", FALSE);
		// $this->db->where("a.AssignSpv IS NULL", "", FALSE);
 	}	

 	// ----------- login USER_SUPERVISOR  ----
 	if( _have_get_session('UserId') AND _get_session('HandlingType') ==USER_SUPERVISOR )
 	{
		$this->db->where("a.$AssignField", _get_session('UserId'));
		// $this->db->where("(a.AssignLeader = 0 OR a.AssignLeader IS NULL)", "", FALSE);
		#$this->db->where("(a.AssignSelerId = 0 OR a.AssignSelerId IS NULL)", "", FALSE);
		// $this->db->where("a.AssignLeader IS NULL", "", FALSE);
 	}	 
 
 	// ----------- login USER_LEADER  ----
 	if( _have_get_session('UserId') AND _get_session('HandlingType') ==USER_LEADER )
 	{
		$this->db->where("a.$AssignField", _get_session('UserId'));
		#$this->db->where("(a.AssignSelerId = 0 OR a.AssignSelerId IS NULL)", "", FALSE);
 	}
 
 	if( _get_have_post('dis_start_dob') AND _get_have_post('dis_end_dob'))
 	{
		$this->db->having("Age>='{$out->get_value('dis_start_dob','intval')}'", "", false);
		$this->db->having("Age<='{$out->get_value('dis_end_dob','intval')}'", "", false);
	}	
  
	// --------- start on Atempt ------------------------- 
	if( _get_have_post('dis_start_atempt') ){
		$this->db->having("Atempt>='{$out->get_value('dis_start_atempt','intval')}'", "", FALSE);
	}
 
	// --------- end on Atempt ------------------------- 
	if( _get_have_post('dis_end_atempt') ){
		$this->db->having("Atempt<='{$out->get_value('dis_end_atempt','intval')}'", "", FALSE);
	}

	// ----------- set order -------------------------	
 	if( _get_have_post("orderby") ){
		$this->db->order_by($out->get_value("orderby"), $out->get_value("type") );
 	} else {
		$this->db->order_by("a.AssignId", "DESC");
 	}
 
 	$rs = $this->db->get();
 	#echo "<pre>"; var_dump( $this->db->last_query() ); echo "</pre>"; die();
 	if( $rs->num_rows() > 0 ){
		$arr_assign_data = (array)$rs->result_assoc();
  	}
  	return (array)$arr_assign_data;
}

public function _select_page_distributePDS_191119( $out  = null, $field = null )
{
 	// ---------- call not interest -------------------------
 	$ar_call_not_interest = array_keys(CallResultInterest());	
 	$conds1 = " (YEAR(NOW())-YEAR(b.CustomerDOB)) as CustomerAge, ";
 	$conds2 = " date(now()) ";
 	
 	// mode mssql
 	if( QUERY == 'mssql') {
 		$conds1 = " ( YEAR(getdate()) - YEAR(b.CustomerDOB) ) as CustomerAge, ";
 		$conds2 = " CONVERT(varchar, getdate(),23)";
 	}
 
 	$arr_assign_data = array();
 	$this->db->reset_select();
 	// -------- inull then get default ----------------
 	if( is_null($field) )	
 	{
		$this->db->select("
			a.AssignId as DistAssignId,
			c.CampaignName as CampaignName,
			b.Recsource as Recsource,
			b.CustomerNumber as CustomerNumber,
			b.CustomerFirstName as CustomerFirstName,
			b.mkt_code as CustomerMktKode,
			e.CallReasonCategoryName as CallStatus,
			b.CallReasonId as CallReasonId,
			b.CustomerDOB as CustomerDOB, 
			{$conds1}
			b.GenderId as GenderId,
			b.CustomerAddressLine1 as CustomerAddressLine1,
			b.CustomerAddressLine2 as CustomerAddressLine2,
			b.CustomerAddressLine3 as CustomerAddressLine3,
			b.CustomerAddressLine4 as CustomerAddressLine4,
			b.CustomerCity as CustomerCity,
			/*(SELECT count(ts.CallHistoryId) as atempt FROM t_gn_callhistory ts WHERE ts.CustomerId = a.CustomerId AND ts.HistoryType = 0 ) as Atempt, */
			b.CustomerUpdatedTs as LastCallDate,
			b.CustomerUploadedTs as CustomerUploadedTs, a.CustomerId,
			b.CustomerMobilePhoneNum, b.CustomerHomePhoneNum, b.CustomerWorkPhoneNum,
			b.CampaignId",
			FALSE); 
 	} else {
		$this->db->select($field, FALSE); 
 	}
 
 	$this->db->from("t_gn_assignment a");
 	$this->db->join("t_gn_customer b "," a.CustomerId=b.CustomerId", "LEFT"); 
 	$this->db->join("t_gn_filter_product d "," b.CustomerId=d.prod_cust_id ","LEFT");
 	$this->db->join("t_gn_campaign c "," b.CampaignId=c.CampaignId ","LEFT");
 	$this->db->join("t_lk_callreasoncategory e "," b.CustomerStatus=e.CallReasonCategoryId ","LEFT");
 	$this->db->where("a.AssignBlock", 0);
 	$this->db->where("b.expired_date >= {$conds2}");
 	$this->db->where("b.campaignid != 9");
 	$this->db->where("COALESCE(b.Flag_Followup,0) <> 1");
 	$this->db->where("COALESCE(b.Flag_Pds,0) <> 1");
 	// $this->db->where_not_in("b.CallReasonId", $ar_call_not_interest);
 
 	// ---------------- set call result ----------------------------------
  	if( _get_have_post('dis_call_reason')){
		$this->db->where_in("b.CallReasonId", $out->get_array_value('dis_call_reason') );
  	}
  
  	// ----------- set filter by pos ------------------
  	if( _get_have_post('dis_campaign_name')) {
		$this->db->where("b.CampaignId", $out->get_value('dis_campaign_name') );
  	}

  	if( _get_have_post('dis_recsource_name')){
		// $this->db->where("b.Recsource", $out->get_value('dis_recsource_name') );
	 	$this->db->where_in("b.Recsource", $out->get_array_value('dis_recsource_name'));
  	}
  
  	if( _get_have_post('mkt_code')){
		$this->db->like("b.mkt_code", $out->get_value('mkt_code') );
  	}
  
  	if( _get_have_post('customer_name')){
		$this->db->like("b.CustomerFirstName", $out->get_value('customer_name') );
  	}

  	if( _get_have_post('dis_gender_id')){
		$this->db->where("b.GenderId", $out->get_value('dis_gender_id') );
  	}
  
  	if( _get_have_post('dis_start_upload_date') AND  _get_have_post('dis_end_upload_date'))
  	{
		$this->db->where("b.CustomerUploadedTs >='{$out->get_value('dis_start_upload_date','StartDate')}' 
		AND b.CustomerUploadedTs <='{$out->get_value('dis_end_upload_date','EndDate')}'", "", FALSE);
  	}	
  
   	// ----------------------------------------- last call date -----------------------------
  	if( _get_have_post('dis_start_last_call_date') AND  _get_have_post('dis_end_last_call_date'))
  	{
		$this->db->where("b.CustomerUpdatedTs >='{$out->get_value('dis_start_last_call_date','StartDate')}' 
		AND b.CustomerUpdatedTs <='{$out->get_value('dis_end_last_call_date','EndDate')}'", "", FALSE);
  	}	
 
 	// -------------------- filter data from user ---------------
 	if( _get_have_post('dis_field_filter1') AND _get_have_post('dis_field_value1') AND _get_have_post('dis_field_text1') )
 	{
		$this->val_str = $this->set_like_group( $out->get_value('dis_field_value1'), $out->get_value('dis_field_filter1'),$out->get_array_value('dis_field_text1') );
		if( $this->val_str ){
			$this->db->where($this->val_str, "", FALSE);
		}
 	}	
 
 	// -------------------- filter data from user ---------------
 	if( _get_have_post('dis_field_filter2') AND _get_have_post('dis_field_value2')  AND _get_have_post('dis_field_text2') )
 	{
		$this->val_str = $this->set_like_group( $out->get_value('dis_field_value2'), $out->get_value('dis_field_filter2'),$out->get_array_value('dis_field_text2') );
		if( $this->val_str ){
			$this->db->where($this->val_str, "", FALSE);
		}
 	}	
 
	// -------- set by field login ------ --------------
 	$AssignField = $this->_select_row_field_level(_get_session('HandlingType'));
  
 	// ----------- login ROOT && ADMIN ----
 	if( _have_get_session('UserId') AND _get_session('HandlingType') == USER_ROOT )
 	{
		$cfg =& Config();
		$this->db->where("(a.AssignMgr = 0 OR a.AssignMgr IS NULL)", "", FALSE);
		$this->db->where_in("a.AssignAdmin", $cfg->push('default_admin', 0) );
 	}	 

 	// ----------- login USER_ACCOUNT_MANAGER  ----
 	// echo $AssignField;
 	if( _have_get_session('UserId') AND _get_session('HandlingType') ==USER_ADMIN )
 	{
		$this->db->where("(a.AssignMgr = 0 OR a.AssignMgr IS NULL)", "", FALSE);
 	}	 

 	// ----------- login USER_ACCOUNT_MANAGER  ----
 	if( _have_get_session('UserId') AND _get_session('HandlingType') == USER_ACCOUNT_MANAGER )
 	{
		$this->db->where("a.$AssignField", _get_session('UserId'));
		$this->db->where("(a.AssignSpv = 0 OR a.AssignSpv IS NULL)", "", FALSE);
 	}	

 	// ----------- login USER_MANAGER  ----
 	if( _have_get_session('UserId') AND _get_session('HandlingType') == USER_MANAGER )
 	{
		$this->db->where("a.$AssignField", _get_session('UserId'));
		$this->db->where("(a.AssignSpv = 0 OR a.AssignSpv IS NULL)", "", FALSE);
		// $this->db->where("a.AssignSpv IS NULL", "", FALSE);
 	}	

 	// ----------- login USER_SUPERVISOR  ----
 	if( _have_get_session('UserId') AND _get_session('HandlingType') ==USER_SUPERVISOR )
 	{
		$this->db->where("a.$AssignField", _get_session('UserId'));
		// $this->db->where("(a.AssignLeader = 0 OR a.AssignLeader IS NULL)", "", FALSE);
		#$this->db->where("(a.AssignSelerId = 0 OR a.AssignSelerId IS NULL)", "", FALSE);
		// $this->db->where("a.AssignLeader IS NULL", "", FALSE);
 	}	 
 
 	// ----------- login USER_LEADER  ----
 	if( _have_get_session('UserId') AND _get_session('HandlingType') ==USER_LEADER )
 	{
		$this->db->where("a.$AssignField", _get_session('UserId'));
		#$this->db->where("(a.AssignSelerId = 0 OR a.AssignSelerId IS NULL)", "", FALSE);
 	}
 
 	if( _get_have_post('dis_start_dob') AND _get_have_post('dis_end_dob'))
 	{
		$this->db->having("Age>='{$out->get_value('dis_start_dob','intval')}'", "", false);
		$this->db->having("Age<='{$out->get_value('dis_end_dob','intval')}'", "", false);
	}	
  
	// --------- start on Atempt ------------------------- 
	if( _get_have_post('dis_start_atempt') ){
		$this->db->having("Atempt>='{$out->get_value('dis_start_atempt','intval')}'", "", FALSE);
	}
 
	// --------- end on Atempt ------------------------- 
	if( _get_have_post('dis_end_atempt') ){
		$this->db->having("Atempt<='{$out->get_value('dis_end_atempt','intval')}'", "", FALSE);
	}

	// ----------- set order -------------------------	
 	if( _get_have_post("orderby") ){
		$this->db->order_by($out->get_value("orderby"), $out->get_value("type") );
 	} else {
		$this->db->order_by("a.AssignId", "DESC");
 	}
 
 	$rs = $this->db->get();
 	#echo "<pre>"; var_dump( $this->db->last_query() ); echo "</pre>"; die();
 	if( $rs->num_rows() > 0 ){
		$arr_assign_data = (array)$rs->result_assoc();
  	}
  	return (array)$arr_assign_data;
} 
/**** END SECTION PDS ******/


// ======================== END CLASS ================================================================================= 
}

?>