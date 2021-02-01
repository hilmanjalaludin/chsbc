<?php

/*
 * E.U.I 
 *
 
 * subject	: M_SetBenefit modul 
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Utility/
 */
 
class M_SrcAppoinment extends EUI_Model
{

var $set_limit_page = 10;
// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
 private static $Instance   = null; 
 public static function &Instance()
{
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
}

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
function __construct()
{
	$this->load->model('M_SetCallResult');
}


// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
function CallBackLater()
{
	$_conds = array(); $_a = array(); 
	if(class_exists('M_SetCallResult') )
	{
		$_data = $this -> M_SetCallResult -> _getCallback();
		foreach( $_data as $_k => $_v )
		{
			$_conds[$_k] = $_k;  
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
 * @query-mssql [OK]
 */
 
function _get_default()
{
 // --------------- get post parameter --------------------------	
 $out  = new EUI_Object( _get_all_request());
 
 // $out->debug_label();
 $conds1 = " date(now()) ";
 if( QUERY == 'mssql') {
 	$conds1 = " CONVERT(varchar, getdate(),23) ";
 }

 $arr_call_thinking = array_keys(CallResultThinking());
 
 // --------------- get post parameter --------------------------	
 $this->EUI_Page->_setPage($this->set_limit_page); 
 $this->EUI_Page->_setSelect("b.CustomerId", false);
 $this->EUI_Page->_setFrom("t_gn_customer b");
 $this->EUI_Page->_setJoin("t_gn_appoinment a ", " a.CustomerId=b.CustomerId", "INNER");

 $this->EUI_Page->_setJoin("t_gn_assignment c "," a.CustomerId=c.CustomerId","LEFT", true);
 
 // ------------ set filter ---------------------------------------------------------
 $this->EUI_Page->_setWhereIn("b.CallReasonId", $arr_call_thinking);
 
 if( in_array( _get_session('HandlingType'), array( USER_SUPERVISOR )) )
 {
	$this->EUI_Page->_setAnd("c.AssignSpv", _get_session('UserId'));
 }		
 
 if( in_array( _get_session('HandlingType'), array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)))
 {
	$this->EUI_Page->_setAnd("c.AssignSelerId", _get_session('UserId'));
 }	

// ---------- filter post -----------------
 $this->EUI_Page->_setAndCache("b.CallReasonId", "clbk_call_reason", true);
 $this->EUI_Page->_setAndCache("b.CampaignId", "clbk_campaign_name", true);
 $this->EUI_Page->_setAndCache("b.GenderId", "clbk_gender", true);
 $this->EUI_Page->_setAndCache("c.AssignSelerId", "clbk_user_agent", true);
 $this->EUI_Page->_setLikeCache("b.CustomerFirstName", "clbk_cust_name", true);
 $this->EUI_Page->_setLikeCache("b.CustomerNumber", "clbk_customer_number", true);
 // ----------- cek appointment todays -----
 
 if(!_get_have_post('clbk_start_date') AND !_have_get_session('clbk_end_date') )
 {
	$this->EUI_Page->_setAnd("a.ApoinmentDate>='". StartDate(date('Y-m-d'))."'");
	$this->EUI_Page->_setAnd("a.ApoinmentDate<='". EndDate(date('Y-m-d'))."'");
 }
 
 $this->EUI_Page->_setAndOrCache("a.ApoinmentDate>='{$out->get_value('clbk_start_date', 'StartDate')}'", 'clbk_start_date', TRUE);
 $this->EUI_Page->_setAndOrCache("a.ApoinmentDate<='{$out->get_value('clbk_end_date', 'EndDate')}'", 'clbk_end_date', TRUE);
 
 // -------- add filter -----------------
 $this->EUI_Page->_setAndOrCache($this->set_like_group("b.CustomerCity", "LIKE",$out->get_array_value('clbk_call_city')), 'clbk_call_city', true);
 $this->EUI_Page->_setLikeCache("b.{$out->get_value('src_filter_phone_by')}", 'clbk_value_phone_by', false);
 $this->EUI_Page->_setAnd("b.expired_date >= {$conds1}" , FALSE);

 $this->EUI_Page->_setGroupBy('c.CustomerId,b.CustomerId,b.CampaignId, b.CustomerFirstName, b.CustomerCity, b.GenderId, b.CallReasonId, c.AssignSelerId, c.AssignLeader');

	
 #echo $this->EUI_Page->_getCompiler();
 return $this->EUI_Page;
 
}

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 */
function set_like_group( $field="", $operator = "", $arr_val = null )
{
  $this->arr_ptr = array('LIKE' => 'LIKE','NOT_LIKE' => 'NOT LIKE');
  $this->arr_sec = array();
 if( is_array($arr_val) ) 
	 foreach($arr_val as $k => $value )
 {
	if( in_array($operator, array_keys($this->arr_ptr) )){
		$this->arr_sec[] = $field ." ". $this->arr_ptr[$operator] . " '%". mysql_real_escape_string(trim($value))."%' "; 
	}		
 }
	
 if( count($this->arr_sec) == 0  ){
	return FALSE;
 }	
	
 $this->arr_sec = " ( ". join(" OR ", $this->arr_sec) ." ) ";
 return (string)$this->arr_sec;
} 

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * @query-mssql [OK]
 */
 
function _get_content()
{
     // --------------- get post parameter --------------------------
        $out = new EUI_Object(_get_all_request());
        $arr_call_thinking = array_keys(CallResultThinking());
        // --------------- get post parameter --------------------------

        $conds1 = " date_format( a.ApoinmentDate, '%d-%m-%Y') as TryCallDate ";
        $conds2 = " date_format( a.ApoinmentDate, '%H:%i') as TryCallTime ";
        $conds3 = " IF(a.ApoinmentFlag IN(0),'Not Follow Up','Follow Up') as Status ";
        $conds4 = " (SELECT hs.CallHistoryNotes FROM t_gn_callhistory hs WHERE hs.CustomerId=b.CustomerId  AND hs.CallReasonId=b.CallReasonId ORDER BY hs.CallHistoryId DESC LIMIT 1) as Notes ";
        $conds5 = " date(now()) ";

        // mode mssql
        if (QUERY == 'mssql') {
            $conds1 = " convert(varchar, (SELECT TOP 1 apt.ApoinmentDate FROM t_gn_appoinment apt WHERE apt.CustomerId=b.CustomerId Order BY apt.AppoinmentId DESC), 105) as TryCallDate ";
            $conds2 = " convert(varchar(5), (SELECT TOP 1 apt.ApoinmentDate FROM t_gn_appoinment apt WHERE apt.CustomerId=b.CustomerId Order BY apt.AppoinmentId DESC), 8) as TryCallTime ";
            $conds3 = " CASE WHEN (SELECT TOP 1 apt.ApoinmentFlag FROM t_gn_appoinment apt WHERE apt.CustomerId=b.CustomerId Order BY apt.AppoinmentId DESC) IN(0) THEN 'Not Follow Up' ELSE 'Follow Up' END AS Status";
            $conds4 = " (SELECT TOP 1 hs.CallHistoryNotes FROM t_gn_callhistory hs WHERE hs.CustomerId=b.CustomerId  AND hs.CallReasonId=b.CallReasonId ORDER BY hs.CallHistoryId DESC ) as Notes ";
            $conds5 = " convert(varchar, getdate(), 23) ";
        }

        $this->EUI_Page->_postPage(_get_post('v_page'));
        $this->EUI_Page->_setPage($this->set_limit_page);
        $this->EUI_Page->_setArraySelect(array(
            "b.CustomerId as CustomerId" => array("CustomerId", "CustomerId"),
            "(SELECT TOP 1 apt.AppoinmentId FROM t_gn_appoinment apt WHERE apt.CustomerId=b.CustomerId Order BY apt.AppoinmentId DESC) as AppoinmentId" => array("AppoinmentId", "AppoinmentId", "primary"),
            "( SELECT cmp.CampaignDesc
			FROM t_gn_campaign cmp
			WHERE cmp.CampaignId=b.CampaignId ) as CampaignName" => array("CampaignName", "Campaign Name"),
			"b.CustomerFirstName as CustomerFirstName" => array("CustomerFirstName", "Customer Name"),
            "b.CustomerCity as CustomerCity" => array("CustomerCity", "City"),

            "( SELECT gd.Gender
			FROM t_lk_gender gd
			WHERE gd.GenderId=b.GenderId ) as Gender" => array("Gender", "Gender"),

			
		"( SELECT cs.CallReasonDesc
			FROM t_lk_callreason cs
			WHERE cs.CallReasonId=b.CallReasonId ) as CallResultId" => array("CallResultId", "Call Reason"),
            "{$conds1}" => array("TryCallDate", "Try Call Date"),
            "{$conds2}" => array("TryCallTime", "Try Call Time"),
            "(select tms.id as AgentId from tms_agent tms where tms.UserId=c.AssignSelerId) as AgentId" => array("AgentId", "Agent ID"),
            "(select tms.id as Supervisor from tms_agent tms where tms.UserId=c.AssignLeader) as Supervisor" => array("Supervisor", "Supervisor"),

            "(SELECT TOP 1 apt.ApoinmentDate FROM t_gn_appoinment apt WHERE apt.CustomerId=b.CustomerId Order BY apt.AppoinmentId DESC) as ApoinmentCreate" => array("ApoinmentCreate", "Date Created"),
            "{$conds3}" => array("Status", "Status"),
            "{$conds4}" => array("Notes", "Notes"),
        ));

        $this->EUI_Page->_setFrom("t_gn_customer b");
        $this->EUI_Page->_setJoin("t_gn_appoinment a", "a.CustomerId=b.CustomerId", "INNER");
        $this->EUI_Page->_setJoin("t_gn_assignment c", "a.CustomerId=c.CustomerId", "LEFT", true);

        // ------------ set filter ---------------------------------------------------------
        $this->EUI_Page->_setWhereIn("b.CallReasonId", $arr_call_thinking);
        if (in_array(_get_session('HandlingType'), array(USER_SUPERVISOR))) {
            $this->EUI_Page->_setAnd("c.AssignSpv", _get_session('UserId'));
        }

        if (in_array(_get_session('HandlingType'),
            array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))) {
            $this->EUI_Page->_setAnd("c.AssignSelerId", _get_session('UserId'));
        }

        // ---------- filter post -----------------
        $this->EUI_Page->_setAndCache("b.CallReasonId", "clbk_call_reason", true);
        $this->EUI_Page->_setAndCache("b.CampaignId", "clbk_campaign_name", true);
        $this->EUI_Page->_setAndCache("b.GenderId", "clbk_gender", true);
        $this->EUI_Page->_setAndCache("c.AssignSelerId", "clbk_user_agent", true);
        $this->EUI_Page->_setLikeCache("b.CustomerNumber", "clbk_customer_number", true);
        $this->EUI_Page->_setLikeCache("b.CustomerFirstName", "clbk_cust_name", true);

        // ----------- cek appointment todays -----
        if (!_get_have_post('clbk_start_date') and !_have_get_session('clbk_end_date')) {
            $this->EUI_Page->_setAnd("a.ApoinmentDate>='" . StartDate(date('Y-m-d')) . "'");
            $this->EUI_Page->_setAnd("a.ApoinmentDate<='" . EndDate(date('Y-m-d')) . "'");
        }

        $this->EUI_Page->_setAndOrCache("a.ApoinmentDate>='{$out->get_value('clbk_start_date', 'StartDate')}'", 'clbk_start_date', true);
        $this->EUI_Page->_setAndOrCache("a.ApoinmentDate<='{$out->get_value('clbk_end_date', 'EndDate')}'", 'clbk_end_date', true);
        // -------- add filter -----------------
        $this->EUI_Page->_setAndOrCache($this->set_like_group("b.CustomerCity", "LIKE", $out->get_array_value('clbk_call_city')), 'clbk_call_city', true);
        $this->EUI_Page->_setLikeCache("b.{$out->get_value('src_filter_phone_by')}", 'clbk_value_phone_by', false);
        $this->EUI_Page->_setAnd("b.expired_date >= {$conds5}", false);

        $this->EUI_Page->_setGroupBy('c.CustomerId,b.CustomerId,b.CampaignId, b.CustomerFirstName, b.CustomerCity, b.GenderId, b.CallReasonId, c.AssignSelerId, c.AssignLeader');
        // ----------- set order ------------------------------
        if (_get_have_post('order_by')) {
            $this->EUI_Page->_setOrderBy(_get_post('order_by'), _get_post('type'));
        } else {
            $this->EUI_Page->_setOrderBy("b.CustomerId", "DESC");
        }

        #echo $this->EUI_Page->_getCompiler();
        $this->EUI_Page->_setLimit();


   
}


/*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_resource()
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
 
function _get_page_number() 
 {
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
 
 
}

?>