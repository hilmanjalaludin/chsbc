<?php
/*
 * E.U.I 
 *
 
 * subject	: M_SetBenefit modul 
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Utility/
 */
 
class M_SetPromiseScript extends EUI_Model
{
	
var $set_limit_page = 10;

// ----------------------------------------------------------------------
/*
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

// ----------------------------------------------------------------------
/*
 * @ package		function get detail content list page 
 * @ param			not assign parameter
 */	
 
function __construct() {
  $this->load->model(array('M_SetProduct','M_SetPrefix'));
}


// ----------------------------------------------------------------------
/*
 * @ package		function get detail content list page 
 * @ param			not assign parameter
 */	
 
function _get_default()
{
 // ------------------------------------------------------	
  
  $out  = new EUI_Object(_get_all_request());
  
 // ------------------------------------------------------

 
 $this->EUI_Page->_setPage($this->set_limit_page); 
 $this->EUI_Page->_setSelect("a.ScriptId");
 $this->EUI_Page->_setFrom("t_gn_productscript a");
 $this->EUI_Page->_setJoin("t_gn_product b", "a.ProductId=b.ProductId","LEFT", true);
 
 // --------------- set filter ----------------------
 
 $this->EUI_Page->_setAndCache("a.ProductId", "script_product_id", true);
 $this->EUI_Page->_setAndCache("a.UploadBy", "script_user_id", true);
 $this->EUI_Page->_setAndCache("a.ScriptFlagStatus", "script_status", true);
 $this->EUI_Page->_setLikeCache("b.ProductName", "script_product_name", true);
 $this->EUI_Page->_setLikeCache("a.Description", "script_product_title", true);
 $this->EUI_Page->_setLikeCache("a.ScriptFileName", "script_file_name", true);

  if( !_get_have_post('order_by')){
  	$this->EUI_Page->_setAnd("a.scriptupdatests", 1);
	$this->EUI_Page->_setOrderBy('a.ScriptId','DESC');
  } else {
	$this->EUI_Page->_setOrderBy(_get_post('order_by'), _get_post('type'));
  } 
 //echo $this->EUI_Page->_getCompiler();
 
 return $this->EUI_Page;
 
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

  $out  = new EUI_Object(_get_all_request());
  $conds1 = " IF( a.ScriptFlagStatus = 1, 'Active','Not Active') as Status ";
  if( QUERY == 'mssql') {
  	$conds1 = " CASE WHEN a.ScriptFlagStatus = 1 THEN 'Active' ELSE 'Not Active' END as Status ";
  }
  
  $this->EUI_Page->_setPage($this->set_limit_page);	
  $this->EUI_Page->_postPage(_get_post('v_page') );
  $this->EUI_Page->_setArraySelect(array(
	"a.ScriptId as ScriptId" => array("ScriptId", "ScriptId", "primary"),
	// "b.ProductCode as ProductCode" => array("ProductCode","Product Code"), 
	// "a.tncd as ProductCode" => array("ProductCode","TNC"), 
	"CASE WHEN (a.scriptupdatests = 1) THEN 'SCRIPTUPDATEDS' ELSE 'Script' END as scriptupdatests" => array("scriptupdatests","Promise Script"), 
	// "b.ProductName as ProductName" => array("ProductName", "Product Name"),
	"a.Description as Description" => array("Description", "Title"),
	"a.ScriptFileName as ScriptFileName" => array("ScriptFileName", "File Name"),
	"a.UploadDate as UploadDate" => array("UploadDate","Upload Date Time"),
	"( SELECT ts.full_name FROM tms_agent ts WHERE ts.UserId=a.UploadBy  ) as UploadBy" => array("UploadBy","Upload By"),
	"{$conds1}" => array("Status","Status")
  ));
  
   $this->EUI_Page->_setFrom("t_gn_productscript a");
   $this->EUI_Page->_setJoin("t_gn_product b", "a.ProductId=b.ProductId","LEFT", true);
  
  // --------------- set filter ----------------------
   // $this->EUI_Page->_setAndCache("a.ProductId", "script_product_id", true);
   $this->EUI_Page->_setAndCache("a.UploadBy", "script_user_id", true);
   $this->EUI_Page->_setAndCache("a.ScriptFlagStatus", "script_status", true);
   // $this->EUI_Page->_setLikeCache("b.ProductName", "script_product_name", true);
   $this->EUI_Page->_setLikeCache("a.Description", "script_product_title", true);
   $this->EUI_Page->_setLikeCache("a.ScriptFileName", "script_file_name", true);
 
  // --------------- set order  -------------------
 
  if( !_get_have_post('order_by')){
  	$this->EUI_Page->_setAnd("a.scriptupdatests", 1);
	$this->EUI_Page->_setOrderBy('a.ScriptId','DESC');
  } else {
	$this->EUI_Page->_setOrderBy(_get_post('order_by'), _get_post('type'));
  }
  
  // echo $this->EUI_Page->_getCompiler();
 // --------------- set limit  ------------------- 
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
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _setUpload( $_post= array() )
 {
 	// var_dump($_post,'upload');
 	// die();
	if( $this -> db -> insert('t_gn_productscript',
		array
		(
			'ProductId' => $_post['post_data']['ProductName'], 
			'ScriptFileName'=> $_post['post_files']['ScriptFileName']['name'], 
			'Description'=> $_post['post_data']['ScriptTitle'], 
			'ScriptFlagStatus'=> $_post['post_data']['Active'], 
			'ScriptUpload'=> $_post['post_files']['ScriptFileName']['name'],
			'UploadDate'=> $this -> EUI_Tools ->_date_time(),
			'UploadBy'=> $this -> EUI_Session ->_get_session('UserId'),
			'scriptupdatests'=>'1'
		)
	)){
	// 	var_dump('dbnya',$this->db->last_query());
	// die;
		return true;
	
	}
	else{
		return false;
	}

 }

 function _setUploadtnc( $_post= array() )
 {

 	// var_dump($_post,'tnc');
 	// die();
	if( $this -> db -> insert('t_gn_productscript',
		array
		(
			// 'ProductId' => $_post['post_data']['ProductName'], 
			'ScriptFileName'=> $_post['post_files']['ScriptFileNameTnc']['name'], 
			'Description'=> $_post['post_data']['ScriptTitle'], 
			'ScriptFlagStatus'=> $_post['post_data']['Active'], 
			'ScriptUpload'=> $_post['post_files']['ScriptFileNameTnc']['name'],
			'UploadDate'=> $this -> EUI_Tools ->_date_time(),
			'UploadBy'=> $this -> EUI_Session ->_get_session('UserId'),
			'tnc'=>'1'
		)
	)){
		return true;
	}
	else{
		return false;
	}
	
 }
 
  
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _setActive($_post = null)
 {
	$_conds = 0;
	if(!is_null($_post))
	{
		foreach($_post['ScriptId'] as $keys => $ScriptId )
		{
			if( $this -> db -> update('t_gn_productscript', 
			 array( 'ScriptFlagStatus'=>$_post['Flags']), 
			 array( 'ScriptId' => $ScriptId)))
			{
				$_conds+=1;	
			}
		}
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
 
 function _setDelete($_post = null)
 {
	$_conds = 0;
	if(!is_null($_post))
	{
		foreach($_post['ScriptId'] as $keys => $ScriptId )
		{
			if( $this -> db -> delete('t_gn_productscript',array('ScriptId'=>$ScriptId)))
			{
				$_conds+=1;	
			}
		}
	}
	
	return $_conds;
 }
 
// ------------------------------------------------------------------ 
/* 
 * @ package 	select all product under campaign selected .
 */
 
 public function _select_row_campaign_product( $ProductId  = null )
{
   $arr_campaign = array();
   if( !is_null($ProductId) 
	   OR ($ProductId ==0) 
	   OR ($ProductId==='') )
  {
	 return (array)$arr_campaign;
  }
  
 //  -------------- next proces  ------------------------------
 
  if( !is_array($ProductId) ){
	  $ProductId = array($ProductId);
  }
  
  $this->db->reset_select();
  $this->db->where_in('ProductId', $ProductId);
  $this->db->select("CampaignId", FALSE);
  $this->db->from("t_gn_campaignproduct");
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
	  foreach( $rs->result_assoc() as $rows ) 
 {
	$arr_campaign[$rows['CampaignId']] = (int)$rows['CampaignId'];
	
  }
  return (array)$arr_campaign;
  
} 
 
// ------------------------------------------------------------------ 
/* 
 * @ package 	select all product under campaign selected .
 */
 
 public function _select_row_product_campaign( $CampaignId  = null )
{
   $arr_product = array();  
  if( is_null($CampaignId)  OR ($CampaignId ==0) OR ($CampaignId == '' ) )
  {
	 return (array)$arr_product;
  }
  
 //  -------------- next proces  ------------------------------
 
  if( !is_array($CampaignId) ){
	  $CampaignId = array($CampaignId);
  }
  
  $this->db->reset_select();
  $this->db->where_in('CampaignId', $CampaignId);
  $this->db->select("ProductId", FALSE);
  $this->db->from("t_gn_campaignproduct");
 
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
	  foreach( $rs->result_assoc() as $rows ) 
 {
	$arr_product[$rows['ProductId']]	 = (int)$rows['ProductId'];
	
  }
  return (array)$arr_product;
  
} 
 
// --------------------------------------------------------------- 
/*
 * @ package 		 _get_page_number // constructor class 
 * @ return 	: void(0)
 */
 // edit hilm6an and andi  5112020
 public function _getScript( $CampaignId = null )
{
 
 $ProductId = array();
 
 // if( !is_null($CampaignId) AND (int)$CampaignId > 0 ) {
	$ProductId =& $this->_select_row_product_campaign( $CampaignId );
 // }
 // echo $CampaignId;
 // print_r($this->_select_row_product_campaign( $CampaignId ));
 
 $arr_script_agent = array();
 $this->db->reset_select();
 $this->db-> select("a.ScriptId , a.Description,
	( SELECT pr.ProductName FROM t_gn_product pr WHERE pr.ProductId=a.ProductId ) 
	As ProductName", FALSE);
		
 $this->db->from('t_gn_productscript a');
 $this->db->join('t_gn_campaign b','a.ProductId=b.CampaignId','LEFT');
 $this->db->where('a.ScriptFlagStatus', 1);
 $this->db->where('a.tnc IS NULL');
 if( in_array(_get_session('HandlingType'), array( USER_AGENT_OUTBOUND )) ) {
	$this->db->where('b.CampaignId', $CampaignId);
 } 
 
 
// -------- if have data posted -----------------------------------
 
  // if( is_array($ProductId) AND count( $ProductId ) > 0 ) { 
	// $this->db->where_in('b.CampaignId', $CampaignId);
  // }
  
// ---- debug  echo $this->db->print_out(); ------------------
  // echo $this->db->print_out();
  // die();
 $rs = $this->db->get();
 
 if($rs->num_rows() > 0 ) 
	 foreach( $rs->result_assoc() as $rows )
 {
	$arr_script_agent[$rows['ScriptId']] = $rows['Description'];
  }
  
 return (array)$arr_script_agent;
}
 
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getDataScriptView($ScriptId=0)
 {	
	$_conds = array();
	$this->db->reset_select();
	$this->db->select('TOP 1 a.*');
	$this->db->from('t_gn_productscript a');
	$this->db->where('a.scriptupdatests = 1');
	$this->db->where('a.ScriptFlagStatus = 1');
	$this->db->order_by("a.ScriptId", "DESC");
	if( $rows = $this -> db->get()-> result_first_assoc() ) {
		$_conds = $rows;
	}
	// var_dump($this->db->last_query($_conds));
	// die;
	
	return $_conds;
 }
 function _getDataScript($ScriptId=0)
 {	
	$_conds = array();
	$this->db->reset_select();
	$this->db->select('a.*');
	$this->db->from('t_gn_productscript a');
	$this->db->where('a.ScriptId',$ScriptId);
	if( $rows = $this -> db->get()-> result_first_assoc() ) {
		$_conds = $rows;
	}
	// var_dump($this->db->last_query($_conds));
	// die;
	
	return $_conds;
 }

  function _getDataScripttnc($ScriptId)
 {	
	$_conds = array();
	$this->db->reset_select();
	$this->db->select('TOP 1 a.*');
	$this->db->from('t_gn_productscript a');
	$this->db->where('a.ProductId',$ScriptId);
	$this->db->where('a.tnc','1');
	$this->db->where('a.ScriptFlagStatus','1');

	$this->db->order_by('a.UploadDate','DESC');
	if( $rows = $this -> db->get()-> result_first_assoc() ) {
		$_conds = $rows;
	}
	// var_dump($this->db->last_query());
	// die();
	
	return $_conds;
 }


  function _getDataScriptpilx($ScriptId)
 {	
	$_conds = array();
	$this->db->reset_select();
	$this->db->select('TOP 1 a.*');
	$this->db->from('t_gn_productscript a');
	$this->db->where('a.ProductId',$ScriptId);
	$this->db->where('a.tnc','1');
	$this->db->where('a.ScriptFlagStatus','1');

	$this->db->order_by('a.UploadDate','DESC');
	if( $rows = $this -> db->get()-> result_first_assoc() ) {
		$_conds = $rows;
	}
	// var_dump($this->db->last_query());
	// die();
	
	return $_conds;
 }

 function _getDataScriptFlexiSingle($ScriptId)
 {	
	$_conds = array();
	$this->db->reset_select();
	$this->db->select('TOP 1 a.*');
	$this->db->from('t_gn_productscript a');
	$this->db->where('a.ProductId',$ScriptId);
	$this->db->where('a.tnc','1');
	$this->db->where('a.ScriptFlagStatus','1');

	$this->db->order_by('a.UploadDate','DESC');
	if( $rows = $this -> db->get()-> result_first_assoc() ) {
		$_conds = $rows;
	}
	// var_dump($this->db->last_query());
	// die();
	
	return $_conds;
 }

 function _getDataScriptPiltopUp($ScriptId)
 {	
	$_conds = array();
	$this->db->reset_select();
	$this->db->select('TOP 1 a.*');
	$this->db->from('t_gn_productscript a');
	$this->db->where('a.ProductId',$ScriptId);
	$this->db->where('a.tnc','1');
	$this->db->where('a.ScriptFlagStatus','1');

	$this->db->order_by('a.UploadDate','DESC');
	if( $rows = $this -> db->get()-> result_first_assoc() ) {
		$_conds = $rows;
	}
	// var_dump($this->db->last_query());
	// die();
	
	return $_conds;
 } 

 function _getDataScriptCipReguler($ScriptId)
 {	
	$_conds = array();
	$this->db->reset_select();
	$this->db->select('TOP 1 a.*');
	$this->db->from('t_gn_productscript a');
	$this->db->where('a.ProductId',$ScriptId);
	$this->db->where('a.tnc','1');
	$this->db->where('a.ScriptFlagStatus','1');

	$this->db->order_by('a.UploadDate','DESC');
	if( $rows = $this -> db->get()-> result_first_assoc() ) {
		$_conds = $rows;
	}
	// var_dump($this->db->last_query());
	// die();
	
	return $_conds;
 }
 
 // ========================================================= END CLASS =========================================================
}

?>