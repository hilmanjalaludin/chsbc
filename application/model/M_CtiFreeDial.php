<?php
/*
 * E.U.I 
 *
 
 * subject	: M_SetBenefit modul 
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Utility/
 */
 
class M_CtiFreeDial extends EUI_Model
{
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */ 

 
private static $Instance  = null;	
	
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function __construct(){
	$this -> load -> meta('_cc_extension_agent');
}

// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 public static function &Instance()
{
	if( is_null(self::$Instance) )
 {
	self::$Instance = new self();
 }
  return  self::$Instance;
 
}

 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_default()
{
	$this -> EUI_Page -> _setPage(10); 
	
	$this -> EUI_Page -> _setQuery
			("SELECT 
			 a.*, b.ProviderName, b.ProviderCode , c.full_name 
			 FROM tms_testcall_report a 
			 LEFT JOIN tms_misdn_provider b on a.ProviderId=b.ProviderId
			 LEFT JOIN tms_agent c on a.CallByUser=c.UserId "); 
	
	
	$this -> EUI_Page -> _setWhere();   
	if( $this -> EUI_Page -> _get_query() )
	{
		return $this -> EUI_Page;
	}
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_content()
{

	$this -> EUI_Page->_postPage( $this -> URI -> _get_post('v_page') );
	$this -> EUI_Page->_setPage(10);
 
	$this -> EUI_Page -> _setQuery
			("select a.*, b.ProviderName, b.ProviderCode , c.full_name 
			 from tms_misdn_report a 
			 left join tms_misdn_provider b on a.ProviderId=b.ProviderId
			 left join tms_agent c on a.CallByUser=c.UserId"); 
	
			
	$this -> EUI_Page -> _setWhere();   
	$this -> EUI_Page -> _setOrderBy('a.CallId','DESC');
	$this -> EUI_Page -> _setLimit();
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
 
 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
function _set_save_call_free_dial( $out = null )
{
	if( !is_object($out) OR !$out->fetch_ready() ){
		return FALSE;
	}	
	
	$this->db->reset_write();
	$this->db->set("CallSessionId", $out->get_value('CallSessionId', array('strval','strtoupper')));
	$this->db->set("CallNumber", $out->get_value('CallerNumber', array('strval','strtoupper')));
	$this->db->set("CallRemarks",$out->get_value('CallerRemark', array('strval','strtoupper')));
	$this->db->set("CallByUser", _get_session('UserId'));
	$this->db->set("CallDate", date('Y-m-d H:i:s'));
	$this->db->insert("tms_misdn_report");
	 if( $this->db->affected_rows() > 0 ) {
		return true;	
	}	
	return false;
} 

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 function _select_page_call_free_dial( $out = null )
{
	
 $this->arr_result = array();
 $this->db->reset_select();
 $this->db->select("
	a.CallSessionId as CallActivitySession, 
	a.CallDate as CallActivityDate,
	a.CallNumber as CallerActivityNumber,
	a.CallRemarks as CallActivityNotes,
	( SELECT tms.id from tms_agent tms where tms.UserId=a.CallByUser) as UserId,
	( SELECT tms.full_name from tms_agent tms where tms.UserId=a.CallByUser) as Username", FALSE);
 $this->db->from("tms_misdn_report a FORCE INDEX( PRIMARY )");
 $this->db->order_by("a.CallId", "DESC");
 
 $rs  = $this->db->get();
 var_dump( $this->db->last_query() );die();
 
 if( $rs->num_rows() > 0 )
 {
 	$this->arr_result =(array)$rs->result_assoc();
 }
 return (array)$this->arr_result;
 
} 
 
 // ======================= END CLASS ======================
}

?>