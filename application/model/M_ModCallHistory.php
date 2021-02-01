<?php 

// -----------------------------------------------------------

/* 
 * pack 		Class SMSInbox  
 *
 * @auth 		uknown 
 * @param		testing all 
 */
 
 
 class M_ModCallHistory extends EUI_Model
{

// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */ 

 
private static $Instance  = null;	
	
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */ 
 function __construct()
{ 
	$this->load->model(array('M_MaskingNumber'));
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

	
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
function _select_page_quality_call_history( $out  = null )
{
	/*
   $arr_call_history = array();
  
   if( !$out->fetch_ready()) 
  { 
	return (array)$arr_call_history;
  }
  
  $this->db->reset_select();
  $this->db->select('*', false);
  $this->db->from('t_gn_callhistory a');
  $this->db->join('tms_agent b','a.CreatedById=b.UserId','left');
  $this->db->join('t_lk_callreason c','a.CallReasonId=c.CallReasonId','left');
  $this->db->join('t_lk_callreasoncategory d','c.CallReasonCategoryId=d.CallReasonCategoryId','left');
  $this->db->join('t_lk_aprove_status e','a.ApprovalStatusId=e.ApproveId','left');
  $this->db->where('a.CustomerId', $out->get_value('CustomerId') );
  
 if( _get_have_post("orderby") ){
	$this->db->order_by(_get_post("orderby"), _get_post("type"));
  } else {
	$this->db->order_by("a.CallHistoryId", "DESC");
  }
  
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ){
	  $arr_call_history = (array)$rs->result_assoc();
  }
  return (array)$arr_call_history;
  */
  
   $arr_call_history = array();
  
   if( !$out->fetch_ready()) 
  { 
	return (array)$arr_call_history;
  }
  
  $this->db->reset_select();
  $this->db->select("	
		IF( a.HistoryType IN(0,3,4), (select  lsb.CallReasonCategoryName  from t_lk_callreason lsa  inner join t_lk_callreasoncategory lsb  on lsa.CallReasonCategoryId=lsb.CallReasonCategoryId where lsa.CallReasonId =a.CallReasonId ),'Other Activity') as CallReasonCategoryName,
		IF( a.HistoryType IN(0,3,4), (select cs.CallReasonDesc from t_lk_callreason cs where cs.CallReasonId = a.CallReasonId), IF( a.HistoryType=2, (select a.ConfigName from t_lk_configuration a where a.ConfigValue=a.CallReasonId and a.ConfigCode='CHANGE_STATUS'), 'QA Activity')) as CallReasonDesc,
		a.CallHistoryCreatedTs,
		b.init_name as full_name,
		a.CallNumber,
		e.AproveName,
		a.CallHistoryNotes,
		f.History_Type_Name as CallHistoryType ", 
  FALSE);
  $this->db->from('t_gn_callhistory a');
  $this->db->join('tms_agent b','a.CreatedById=b.UserId','left');
  $this->db->join('t_lk_callreason c','a.CallReasonId=c.CallReasonId','left');
  $this->db->join('t_lk_callreasoncategory d','c.CallReasonCategoryId=d.CallReasonCategoryId','left');
  $this->db->join('t_lk_aprove_status e','a.ApprovalStatusId=e.ApproveId','left');
  $this->db->join('t_lk_history_type f','a.HistoryType=f.History_Type_Code','left');
  $this->db->where('a.CustomerId', $out->get_value('CustomerId') );
  
 
 if( _get_have_post("orderby") ){
	$this->db->order_by(_get_post("orderby"), _get_post("type"));
  } else {
	$this->db->order_by("a.CallHistoryId", "DESC");
  }
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ){
	  $arr_call_history = (array)$rs->result_assoc();
  }
  return (array)$arr_call_history;
  
}
	
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
function _select_page_call_history( $out = null )
{
  $arr_call_history = array();
  
  if( !$out->fetch_ready()) 
  { 
    return (array)$arr_call_history;
  }
  
  $cond1 = "IF( a.HistoryType IN(0,2,3,4),  (select ct.CallReasonCategoryName from  t_lk_callreasoncategory ct where ct.CallReasonCategoryId = a.CallReasonCategoryId ),'Other Activity') as CallReasonCategoryName";
  $cond2 = "IF( a.HistoryType IN(0,2,3,4), (select cs.CallReasonDesc from t_lk_callreason cs where cs.CallReasonId = a.CallReasonId), IF( a.HistoryType=2, (select a.ConfigName from t_lk_configuration a where a.ConfigValue=a.CallReasonId and a.ConfigCode='CHANGE_STATUS'), 'QA Activity')) as CallReasonDesc";

  if ( QUERY == 'mssql' ) {
    $cond1 = "CASE WHEN a.HistoryType IN(0, 2, 3, 4) THEN (select ct.CallReasonCategoryName from t_lk_callreasoncategory ct where ct.CallReasonCategoryId = a.CallReasonCategoryId ) ELSE 'Other Activity' END as CallReasonCategoryName,";

    $cond2 = "CASE WHEN a.HistoryType IN(0, 3, 4) THEN (select cs.CallReasonDesc from t_lk_callreason cs where cs.CallReasonId = a.CallReasonId) WHEN a.HistoryType IN(2) THEN (select tlk.ConfigName from t_lk_configuration tlk where tlk.ConfigValue=a.CallReasonId and tlk.ConfigCode='CHANGE_STATUS') ELSE 'QA Activity' END as CallReasonCategoryName,";
  }

  $this->db->reset_select();
  $this->db->select("	
		{$cond1}
		{$cond2}
		a.CallHistoryCreatedTs,
		b.init_name,
		a.CallNumber,
		e.AproveName,
		a.CallHistoryNotes,
		f.History_Type_Name as CallHistoryType ", 
  FALSE);
  $this->db->from('t_gn_callhistory a');
  $this->db->join('tms_agent b','a.CreatedById=b.UserId','left');
  $this->db->join('t_lk_callreason c','a.CallReasonId=c.CallReasonId','left');
  $this->db->join('t_lk_callreasoncategory d','c.CallReasonCategoryId=d.CallReasonCategoryId','left');
  $this->db->join('t_lk_aprove_status e','a.ApprovalStatusId=e.ApproveId','left');
  $this->db->join('t_lk_history_type f','a.HistoryType=f.History_Type_Code','left');
  $this->db->where('a.CustomerId', $out->get_value('CustomerId') );
 
 //zay 28juli2017
  if( _get_session('HandlingType')==4) {
	  $this->db->where('a.CreatedById',_get_session('UserId'));
  }

  
 if( _get_have_post("orderby") ){
	$this->db->order_by(_get_post("orderby"), _get_post("type"));
  } else {
	$this->db->order_by("a.CallHistoryId", "DESC");
  }
 
  #echo $this->db->print_out();
 
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ){
	  $arr_call_history = (array)$rs->result_assoc();
  }
  return (array)$arr_call_history;

}



// -----------------------------------------------------------

/* 
 * Method     AddUser 
 *
 * @pack    wellcome on eui first page 
 * @param   testing all 
 */
function _select_page_quality_callmon_history( $out = null )
{
  /**
select 
a.DateCreateTs as DateCallmon ,  
a.Enter_New_Score as TotalScore , 
a.Status_Callmon as StatusCallmon  ,
b.CustomerFirstName as CustomerName , 
c.code_user as CodeUser, 
d.name as Privilege
from t_gn_score_result a
inner join t_gn_customer b on a.CustomerId=b.CustomerId
left join tms_agent c on a.CreateById=c.UserId
left join tms_agent_profile d on c.profile_id=d.id
where a.CustomerId=400;
   */
   $arr_callmon_history = array();
  
   if( !$out->fetch_ready()) 
  { 
  return (array)$arr_callmon_history;
  }
  
  $this->db->reset_select();
  $this->db->select(" 
      a.DateCreateTs as DateCallmon ,  
      a.Enter_New_Score as TotalScore , 
      a.Status_Callmon as StatusCallmon  ,
      b.CustomerFirstName as CustomerName , 
      c.code_user as CodeUser, 
      d.name as Privilege" , FALSE);
  $this->db->from('t_gn_score_result a');
  $this->db->join('t_gn_customer b','a.CustomerId=b.CustomerId','inner');
  $this->db->join('tms_agent c','a.CreateById=c.UserId','left');
  $this->db->join('tms_agent_profile d','c.profile_id=d.id','left');
  $this->db->where('a.CustomerId', $out->get_value('CustomerId') );
  
 if( _get_have_post("orderby") ){
  $this->db->order_by(_get_post("orderby"), _get_post("type"));
  } else {
  $this->db->order_by("a.DateCreateTs", "DESC");
  }
 
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ){
    $arr_callmon_history = (array)$rs->result_assoc();
  }
  return (array)$arr_callmon_history;

}

	
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
function _select_page_recording( $out = null )
{
  
  $arr_call_history = array();
   if( !$out->fetch_ready()) 
  { 
	return (array)$arr_call_history;
  }
  
  $this->db->reset_select();
  $this->db->select("
	a.id, a.anumber, a.file_voc_name, a.start_time, 
	a.duration, a.file_voc_size, 
	b.name as agent_name, a.id as PlayId ", FALSE);
	
  $this->db->from("cc_recording a");
  $this->db->join("cc_agent b ","a.agent_id=b.id","LEFT");
  $this->db->where("a.assignment_data", $out->get_value('CustomerId'));
  
 if( _get_have_post("orderby") ){
	$this->db->order_by(_get_post("orderby"), _get_post("type"));
  } else {
	$this->db->order_by("a.id", "DESC");
  }
  
  // echo $this->db->_get_var_dump();
  
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ){
	  $arr_call_history = (array)$rs->result_assoc();
  }
  return (array)$arr_call_history;
}

// -------------------------------------------------------------

/* 
 * Method 		_select_count_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 public function _select_page_address( $out = null )
{
	$arr_address = array(); // default data 
  if( !$out->fetch_ready() ){ 
	return (array)$arr_address; 
  }
   
 // ---------- kep data on parameter -----------------------
 
    $ProvinceId = (int)$out->get_value('ProvinceId');
    $Keyword = $out->get_value('keyword');
 
// ------------------ default spelect ---------------------- 
    $this->db->reset_select();
    $this->db->select(" a.ZipId, a.ZipCode, a.ZipProvinceId, b.Province,
					   a.ZipKelurahan, a.ZipKecamatan, a.ZipDT, a.ZipKotaKab", FALSE);
					   
	$this->db->from("t_lk_zip a ");
	$this->db->join("t_lk_province b "," a.ZipProvinceId = b.ProvinceId", "LEFT");
	$this->db->where("a.ZipProvinceId", $ProvinceId);
	$this->db->where("( 
			a.ZipCode REGEXP ('^$Keyword') 
			OR a.ZipKelurahan REGEXP ('^$Keyword') 
			OR a.ZipKecamatan REGEXP ('^$Keyword')
			OR a.ZipKotaKab REGEXP ('^$Keyword') )", "", FALSE);
	
	
// ----------- order by selected --------------	
  if( _get_have_post("orderby") ){
		$this->db->order_by(_get_post("orderby"), _get_post("type"));
   } else {
		$this->db->order_by('a.ZipKelurahan','ASC');
   }
   
 // ------ if have post limited ------------
  if( _get_have_post('limit') ) {
	$this->db->limit(_get_post('limit'));
  }	
  
  //$this->db->limit(10);
   
  $rs  = $this->db->get();
  if( $rs->num_rows() > 0 ) {
	$arr_address = $rs->result_assoc();
  }
  
  return (array)$arr_address;
}  
  
// =================== END CLASS ============================
}
?>