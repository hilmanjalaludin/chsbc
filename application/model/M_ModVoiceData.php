<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class M_ModVoiceData Extends EUI_Model
{

// ---------------------------------------------------------------------
/*
 * @ package 	: instance object 
 
 *
 */ 
 
private static $Instance = null;

// ---------------------------------------------------------------------
/*
 * @ package 	: instance object 
 
 *
 */ 

 private $constant = array();
// ---------------------------------------------------------------------
/*
 * @ package 	: instance object 
 
 *
 */ 
 
public static function &Instance()
{
  if( is_null(self::$Instance) ){
	self::$Instance = new self();
 }
  return self::$Instance;	
}
 
// ---------------------------------------------------------------------
/*
 * @ package 	: instance object 
 
 *
 */ 
  
 function __construct()
{ 
  $this->constant = (object)array(
	'start_time' => join(" ", array( date('Y-m-d'), '00:00:00')),
	'end_time' =>join(" ", array( date('Y-m-d'), '23:59:59'))
  );
}
 
/*
 * @ def 		: _get_default
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function _get_default()
{
 
 // --------------- get post parameter --------------------------	
	$out  = new EUI_Object( _get_all_request());
	
 // --------------- set query parameter --------------------------	
 
	$this->EUI_Page->_setPage(20);
	$this->EUI_Page->_setSelect("a.id as RecordId");
	$this->EUI_Page->_setFrom("cc_recording a");
	$this->EUI_Page->_setJoin("t_gn_customer b ","a.assignment_data = b.CustomerId", "LEFT");
	$this->EUI_Page->_setJoin("cc_agent c "," a.agent_id=c.id", "LEFT");
	$this->EUI_Page->_setJoin("tms_agent d "," c.userid=d.id", "LEFT", TRUE);
	
// ----------------- filtering data ----------------------------------
	
	if( in_array(_get_session('HandlingType'), 
		array(USER_SUPERVISOR)) )
	{
		$this->EUI_Page->_setAnd("d.spv_id", _get_session('UserId'));
	}
	
// ------------------ default filter data -------------------------------------------------	
	if(!_get_have_post('voice_end_date') 
	   AND !_have_get_session('voice_end_date') )
	{
		#$this->EUI_Page->_setAnd("a.start_time >=DATE_SUB('{$this->constant->end_time}', INTERVAL 1 MONTH)");	
		$this->EUI_Page->_setAnd("a.start_time >='{$this->constant->start_time}'");	
		$this->EUI_Page->_setAnd("a.start_time <='{$this->constant->end_time}'");	
	}	
	
// ----------------- filtering data ----------------------------------
	
	$this->EUI_Page->_setLikeCache("b.CustomerNumber", "cust_number", TRUE);
	$this->EUI_Page->_setLikeCache("b.CustomerFirstName", "voice_cust_name", TRUE);
	$this->EUI_Page->_setLikeCache("a.anumber", "voice_destination", TRUE);
	$this->EUI_Page->_setAndCache("d.UserId", "voice_user_id", TRUE);
	$this->EUI_Page->_setAndCache("b.CampaignId", "voice_campaign_id", TRUE);
	$this->EUI_Page->_setAndCache("b.CallReasonId", "voice_call_result", TRUE);
	
// ----------- filter date by index format --------------------------------
	
	$this->EUI_Page->_setAndOrCache("a.start_time>='{$out->get_value('voice_start_date', 'StartDate')}'", 'voice_start_date', TRUE);
	$this->EUI_Page->_setAndOrCache("a.start_time<='{$out->get_value('voice_end_date', 'EndDate')}'", 'voice_end_date', TRUE);
	$this->EUI_Page->_setAndOrCache("a.duration>='{$out->get_value('voice_start_dur', 'intval')}'", 'voice_start_dur', TRUE);
	$this->EUI_Page->_setAndOrCache("a.duration<='{$out->get_value('voice_end_dur', 'intval')}'", 'voice_end_dur', TRUE);
	#echo $this->EUI_Page->_getCompiler();
	
	return $this->EUI_Page;
	
 }
 
/*
 * @ def 		: _get_content
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function _get_content()
 {
	
// --------------- get post parameter --------------------------	
	$out  = new EUI_Object( _get_all_request());

// --------------- set query parameter --------------------------	

	$this->EUI_Page->_postPage(_get_post('v_page'));
	$this->EUI_Page->_setPage(20); 
	$this->EUI_Page->_setArraySelect(array(
		"a.id as RecordId" => array("RecordId", "RecordId","primary"),
		"(SELECT cmp.CampaignName FROM t_gn_campaign cmp WHERE cmp.CampaignId= b.CampaignId) as CampaignName" => array("CampaignName","Campaign Name"),
		"b.CustomerFirstName as CustomerFirstName" => array("CustomerFirstName","Customer Name"),
		"d.id as AgentName" => array("AgentName","Agent Id"),
		"cl.CallReasonDesc"    => array("CallReasonDesc","Call Result"),
		"a.file_voc_name as file_voc_name" => array("file_voc_name","File Name"),
		"a.file_voc_size as file_voc_size" => array("file_voc_size","File Size"),
		"a.duration as duration" => array("duration","Duration"),
		"a.start_time as start_time" => array("start_time","Call Date")
		
	));
	
	$this->EUI_Page->_setFrom("cc_recording a");
	$this->EUI_Page->_setJoin("t_gn_customer b ","a.assignment_data = b.CustomerId", "LEFT");
	$this->EUI_Page->_setJoin("cc_agent c "," a.agent_id=c.id", "LEFT");

	$this->EUI_Page->_setJoin("t_lk_callreason cl"," b.CallReasonId=cl.CallReasonId", "LEFT");

	$this->EUI_Page->_setJoin("tms_agent d "," c.userid=d.id", "LEFT", TRUE);
	
	// ------------------ default filter data -------------------------------------------------	
	$this->EUI_Page->_setLikeCache("b.CustomerNumber", "cust_number", TRUE);
	$this->EUI_Page->_setLikeCache("b.CustomerFirstName", "voice_cust_name", TRUE);
	$this->EUI_Page->_setLikeCache("a.anumber", "voice_destination", TRUE);
	
	$this->EUI_Page->_setAndCache("d.UserId", "voice_user_id", TRUE);
	$this->EUI_Page->_setAndCache("b.CampaignId", "voice_campaign_id", TRUE);
	$this->EUI_Page->_setAndCache("b.CallReasonId", "voice_call_result", TRUE);
	
	// ------------------ default filter data -------------------------------------------------
	if( in_array(_get_session('HandlingType'), 
	   array(USER_SUPERVISOR)) )
	{
		$this->EUI_Page->_setAnd("d.spv_id", _get_session('UserId'));
	}
	
	if(!_get_have_post('voice_end_date') AND !_have_get_session('voice_end_date') )
	{
		if( QUERY == 'mssql') {
			// Kurangi 1 BULAN
			$this->EUI_Page->_setAnd("a.start_time >=DATEADD(MONTH , -1 , '{$this->constant->end_time}' )");	
		} else {
			// Kurangi 1 BULAN
			$this->EUI_Page->_setAnd("a.start_time >=DATE_SUB('{$this->constant->end_time}', INTERVAL 1 MONTH)");	
		}
		$this->EUI_Page->_setAnd("a.start_time <='{$this->constant->end_time}'");	
	}	
	
 	// ----------- filter date by index format --------------------------------
	$this->EUI_Page->_setAndOrCache("a.start_time>='{$out->get_value('voice_start_date', 'StartDate')}'", 'voice_start_date', TRUE);
	$this->EUI_Page->_setAndOrCache("a.start_time<='{$out->get_value('voice_end_date', 'EndDate')}'", 'voice_end_date', TRUE);
	$this->EUI_Page->_setAndOrCache("a.duration>='{$out->get_value('voice_start_dur', 'intval')}'", 'voice_start_dur', TRUE);
	$this->EUI_Page->_setAndOrCache("a.duration<='{$out->get_value('voice_end_dur', 'intval')}'", 'voice_end_dur', TRUE);
	
  	// -------------- set order field ------------->
	if(!_get_have_post('order_by') ) {
		$this->EUI_Page->_setOrderBy('a.id', 'DESC'); 
	} else {
		$this->EUI_Page->_setOrderBy(_get_post('order_by'),_get_post('type'));
	} 
   
    #var_dump( $this->db->last_query() );die();
	#echo $this->EUI_Page->_getCompiler(); die();
	$this->EUI_Page->_setLimit();	
	return $this->EUI_Page;
	
	
}



 /* get rows data **/
 
 function _getVoiceData($VoiceId=0 )
 {
	$this -> db -> select("*");
	$this -> db -> from("cc_recording a");
	$this -> db -> where('id',$VoiceId);
	//echo $this -> db ->_get_var_dump();
	
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


/*
 *
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
 
 
}
?>