<?php
/*
 * E.U.I 
 *
 
 * subject	: get M_MgtBucket modul 
 * 			  extends under EUI_Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysuser/
 */
 

class M_MgtBucket extends EUI_Model
{
	
// -----------------------------------------------------------

/*
 * @ package  	 _get_default() 
 * -----------------------------------------------------------
 * @ notes 		constructor 
 */	
 
 private static $Instance = null;
 public static function &Instance()
{
  if( is_null(self::$Instance) ) {
	self::$Instance = new self();
  }
  
  return self::$Instance; 
}	
	
// -----------------------------------------------------------

/*
 * @ package  	 _get_default() 
 * -----------------------------------------------------------
 * @ notes 		constructor 
 */	
	
 public function  __construct()
{
  $this->load->model(array (
	 'M_ModDistribusi',
	 'M_ModViewUpload',
	 'M_SetCampaign',
	 'M_Template',
	 'M_WorkArea', 
	 'M_Upload',
	 'M_User'
   ));
}
	
// -----------------------------------------------------------

/*
 * @ package  	 _get_default() 
 * -----------------------------------------------------------
 * @ notes 		constructor 
 */	
 
 public function _get_default()
{
	$this->EUI_Page->_setPage(20); 
	$this->EUI_Page->_setSelect("a.CustomerId");
	$this->EUI_Page->_setFrom("t_gn_bucket_customers a", TRUE);
	
// --------- filter default  ----------------------------	
	$this->EUI_Page->_setAnd("a.CustomerDeleted", 0);	

// --------- filter default  ----------------------------	
	$this->EUI_Page->_setAndCache("a.AssignCampaign", "bucket_assign_status", TRUE);
	$this->EUI_Page->_setAndCache("a.FTP_UploadId", "bucket_file_id", TRUE);
	$this->EUI_Page->_setLikeCache("a.CustomerCity", "city", TRUE);
	$this->EUI_Page->_setLikeCache("a.CustomerCardType", "card_type", TRUE);
	$this->EUI_Page->_setWhereinCache("a.CustomerZipCode", "work_branch", TRUE);
	
	return $this->EUI_Page;
}

/*
 * EUI :: _get_content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 * query-mssql 	[OK]
 */		
 
public function _get_content()
{
	$this->EUI_Page->_postPage(_get_post('v_page'));
	$this->EUI_Page->_setPage(20);

	$consd1 = " YEAR(CURRENT_TIMESTAMP)-YEAR(a.CustomerDOB)-(RIGHT(CURRENT_TIMESTAMP, 5)<RIGHT(a.CustomerDOB, 5)) as Ages ";
	// mode mssql
	if( QUERY == 'mssql') {
		$consd1 = " YEAR(getdate()) - YEAR(a.CustomerDOB) as Ages ";
	}

	$this->EUI_Page->_setArraySelect(array(
		"a.CustomerId As CustomerId" => array("CustomerId","CustomerId","primary"),
		"a.Recsource as Recsource" => array("Recsource","Recsource"), 
		"( select ts.CampaignDesc 
			from t_gn_campaign ts where ts.CampaignId =a.CampaignId ) As CampaignId" => array("CampaignId", "Campaign"),
		"a.CustomerFirstName as CustomerFirstName" => array("CustomerFirstName","Customer Name"),
		
		// "a.CustomerCity as CustomerCity" => array("CustomerCity","City"), 
		"b.Gender as Gender" => array("Gender","Gender"),
		"{$consd1}" => array("Ages","Age"), 
		//"a.CustomerDOB as CustomerAge" => array("CustomerAge", "Age"),
		
		"a.CustomerDOB as CustomerDOB" => array("CustomerDOB","DOB"), 
		//"a.CustomerAddressLine1 as CustomerAddressLine1" => array("CustomerAddressLine1","Address"), 
		//"a.CustomerHomePhoneNum as CustomerHomePhoneNum" => array("CustomerHomePhoneNum","Phone 1"), 
		//"a.CustomerMobilePhoneNum as CustomerMobilePhoneNum" => array("CustomerMobilePhoneNum","Phone 2"), 
		//"a.CustomerWorkPhoneNum as CustomerWorkPhoneNum" => array("CustomerWorkPhoneNum","Phone 3"), 
		//"a.CustomerZipCode as CustomerZipCode" => array("CustomerZipCode","Zip Code"), 
		"a.CustomerUploadedTs as CustomerUploadedTs" => array("CustomerUploadedTs","Upload Date"), 
		
		/* "IF(a.AssignCampaign=1, 'YES','NO') as AssignCampaign" => array("AssignCampaign","Assign Status"),
		"(  select group_concat(b.CampaignDesc separator '<br>' ) as cmp 
			from t_gn_bucket_assigment a INNER JOIN t_gn_campaign b on a.CustomerCampaignId=b.CampaignId 
			where a.CustomerBucketId = a.CustomerId) as OnCampaignId" => array("OnCampaignId", "Campaign Name") */
			
		/* "( select tc.CallReasonDesc 
			from t_gn_customer ts inner join t_lk_callreason tc on ts.CallReasonId=tc.CallReasonId 
			where ts.CustomerNumber =a.CustomerNumber ) As CallResult" => array("CallResult", "Call Result")	*/
				
	));
	
	$this->EUI_Page->_setFrom("t_gn_bucket_customers a");
	$this->EUI_Page->_setJoin("t_lk_gender b "," a.GenderId=b.GenderId", "LEFT", true);
	
	// --------------- set data filtering -------------------------------------------
	$this->EUI_Page->_setAnd("a.CustomerDeleted", 0);	
	$this->EUI_Page->_setAndCache("a.AssignCampaign", "bucket_assign_status", TRUE);
	$this->EUI_Page->_setAndCache("a.FTP_UploadId", "bucket_file_id", TRUE);
	$this->EUI_Page->_setLikeCache("a.CustomerCity", "city", TRUE);
	$this->EUI_Page->_setLikeCache("a.CustomerCardType", "card_type", TRUE);
	$this->EUI_Page->_setWhereinCache("a.CustomerZipCode", "work_branch", TRUE);

	
	// set order 
	if( _get_have_post('order_by')){ 
		$this->EUI_Page->_setOrderBy(_get_post('order_by'),_get_post('type'));
	} else {
		$this->EUI_Page->_setOrderBy('a.CustomerId','ASC');	
	}	
	#echo $this->EUI_Page->_getCompiler();
	
	$this->EUI_Page->_setLimit();
}	

/*
 * EUI :: _get_resource_query() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
function _get_resource()
 {
	self::_get_content();
	if( $this -> EUI_Page -> _get_query()!='')
	{
		//echo $this -> EUI_Page -> _get_query();
		return $this -> EUI_Page -> _result();
	}	
 }
 
/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
function _get_page_number()
  {
	if( $this -> EUI_Page -> _get_query()!='' )
	{
		return $this -> EUI_Page -> _getNo();
	}	
  }
  
/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function _get_template($ftpid=0)
 {
	$_conds= array();
	$this -> load -> model(array('M_SetUpload'));
	if(class_exists('M_SetUpload') )
	{
		$_conds = $this -> M_SetUpload -> _get_ready_template();
	}
	
	return $_conds;
 }

public function _getUploadInvalid( $ftpid=0 )
{
 	$result = array();
	$this->db->reset_select();
	$this->db->from('t_gn_upload_invalid');
	// $this->db->where('FTP_UploadId', 10329);
	$this->db->where('FTP_UploadId', $ftpid);
	$res = $this->db->get();

	#var_dump( $this->db->last_query() );die();
	if( $res->num_rows() > 0 ) {
		$result = $res->row_array();
	}
	return $result;
}
 
}

?>