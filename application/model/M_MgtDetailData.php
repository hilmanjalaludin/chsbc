<?php

class M_MgtDetailData Extends EUI_Model
{

 function M_MgtDetailData(){
	
 }
 
 
 function _get_default()
 {
	$this -> EUI_Page -> _setPage(10); 
	$this -> EUI_Page -> _setQuery
			( " SELECT 
			    a.CustomerId, a.CampaignId, a.CustomerNumber, a.CustomerFirstName, a.CustomerLastName, 
			    IF(a.CustomerCity IS NULL,'-',a.CustomerCity) as CustomerCity, 
			    a.CustomerUploadedTs, a.CustomerOfficeName, c.CampaignNumber 
			    FROM t_gn_customer a INNER JOIN t_gn_assignment b on a.CustomerId=b.CustomerId 
			    LEFT JOIN t_gn_campaign c on a.CampaignId=c.CampaignId"); 
// filter 
	
	$flt = '';
	if( $this -> EUI_Session ->_get_session('HandlingType')==USER_SUPERVISOR )			 
		$flt .= " AND b.AssignSpv ='".$this ->EUI_Session ->_get_session('UserId')."' ";
		
	if( $this -> EUI_Session ->_get_session('HandlingType')==USER_TELESALES)
		$flt .= " AND b.AssignSelerId = '".$this ->EUI_Session ->_get_session('UserId')."'";
	
	if( $this -> URI -> _get_have_post('keywords')) {
		$flt .=" AND ( 
			a.CampaignId LIKE '%".$this ->URI ->_get_post('keywords')."%' 
			OR a.CustomerNumber LIKE '%".$this ->URI ->_get_post('keywords')."%'
			OR a.CustomerFirstName LIKE '%".$this ->URI ->_get_post('keywords')."%'
		)  ";
	}
	
	//	$flt .= " AND a.CampaignId='".$this ->URI ->_get_post('campaign_id')."' ";
	
	// if( $this -> URI -> _get_have_post('cust_name')) 
		// $flt .= " AND a.CustomerFirstName LIKE '%".$this ->URI ->_get_post('cust_name')."%'"; 
	
	// if( $this -> URI -> _get_have_post('cust_number')) 
		// $flt .= " AND a.CustomerNumber LIKE '%".$this ->URI ->_get_post('cust_number')."%'"; 
		
	// if( $this -> URI -> _get_have_post('call_result') )
		// $flt .= " AND a.CallReasonId =".$this ->URI ->_get_post('call_result');		
		
    $this -> EUI_Page -> _setWhere( $flt );
	//echo $this -> EUI_Page -> _get_query();
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
	$this -> EUI_Page -> _postPage( $this -> URI -> _get_post('v_page') );
	$this -> EUI_Page -> _setPage(10);
	$this -> EUI_Page -> _setQuery
			("SELECT a.CustomerId, a.CampaignId,  a.CustomerNumber,  a.CustomerFirstName,  a.CustomerLastName, a.CustomerHomePhoneNum, 
				a.CustomerMobilePhoneNum, a.CustomerWorkPhoneNum, IF( d.CallReasonCode is null ,'NEW',d.CallReasonDesc) as CallReasonCode,
				IF( a.CustomerUpdatedTs is null, '-',a.CustomerUpdatedTs) as CustomerUpdatedTs, IF(a.CustomerCity is null,'-',a.CustomerCity) as CustomerCity, 
				a.CustomerUploadedTs, a.CustomerOfficeName, c.CampaignNumber 
			FROM t_gn_customer a INNER JOIN t_gn_assignment b on a.CustomerId=b.CustomerId 
			LEFT JOIN t_gn_campaign c on a.CampaignId=c.CampaignId 
			LEFT join t_lk_callreason d on a.CallReasonId =d.CallReasonId"); 
	
	$flt = '';
	if( $this -> EUI_Session ->_get_session('HandlingType')==USER_SUPERVISOR )			 
		$flt .= " AND b.AssignSpv ='".$this ->EUI_Session ->_get_session('UserId')."' ";
		
	if( $this -> EUI_Session ->_get_session('HandlingType')==USER_TELESALES)
		$flt .= " AND b.AssignSelerId = '".$this ->EUI_Session ->_get_session('UserId')."'";
	
	if( $this -> URI -> _get_have_post('keywords')) {
		$flt .=" AND ( 
			a.CampaignId LIKE '%".$this ->URI ->_get_post('keywords')."%' 
			OR a.CustomerNumber LIKE '%".$this ->URI ->_get_post('keywords')."%'
			OR a.CustomerFirstName LIKE '%".$this ->URI ->_get_post('keywords')."%'
		)  ";
	}
	
	// if( $this -> EUI_Session ->_get_session('HandlingType')==USER_SUPERVISOR )			 
		// $flt .= " AND b.AssignSpv ='".$this ->EUI_Session ->_get_session('UserId')."' ";
		
	// if( $this -> EUI_Session ->_get_session('HandlingType')==USER_TELESALES)
		// $flt .= " AND b.AssignSelerId = '".$this ->EUI_Session ->_get_session('UserId')."'";
		 	
	// if( $this -> URI -> _get_have_post('campaign_id')) 
		// $flt .= " AND a.CampaignId='".$this ->URI ->_get_post('campaign_id')."' ";
	
	// if( $this -> URI -> _get_have_post('cust_name')) 
		// $flt .= " AND a.CustomerFirstName LIKE '%".$this ->URI ->_get_post('cust_name')."%'"; 
	
	// if( $this -> URI -> _get_have_post('cust_number')) 
		// $flt .= " AND a.CustomerNumber LIKE '%".$this ->URI ->_get_post('cust_number')."%'"; 
		
	// if( $this -> URI -> _get_have_post('call_result') )
		// $flt .= " AND a.CallReasonId =".$this ->URI ->_get_post('call_result');		
		
		
	$this -> EUI_Page -> _setWhere( $flt );   
	$this -> EUI_Page->_setLimit();
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
	//echo $this -> EUI_Page -> _get_query();
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
 
// _getDetailCustomer
 
function _getDetailCustomer($CustomerId)
{
	$this ->db ->select('*');
	$this ->db ->from("t_gn_customer a");
	$this ->db ->where("a.CustomerId",$CustomerId);
	
	return $this ->db ->get()->result_first_assoc();
} 

//_getAttribute

function _getAttribute()
{
	return array(
		'hidden' => array('CustomerId'),
		'combo' => array(
			'SalutationId'=>'Salutation', 
			'GenderId'=>'Gender', 
			'ChanelId'=>'ChanelType',
			'CallReasonId'=>'CallResult',
			'CampaignId' =>'Campaign',
			'SellerId' => 'User',
			'ProvinceId' => 'Province',
			'IdentificationTypeId' =>'Identification'
		)
	);
}

// _getFields
 
function _getFields() 
 {
	$fields = array 
	(
		'CustomerId'				 =>'CustomerId',
		'CustomerNumber'			 =>'Customer Number',
		'CustomerFirstName'			 =>'Customer First Name',
		'CustomerLastName'			 =>'Customer Last Name',
		'CustomerDOB'				 =>'DOB',
		'CustomerAddressLine1'		 =>'Address Line 1',
		'CustomerAddressLine2'		 =>'Address Line 2',
		'CustomerAddressLine3'		 =>'Address Line 3',
		'CustomerAddressLine4'		 =>'Address Line 4',
		'CustomerCity'				 =>'City',
		'ProvinceId'				 =>'Province',
		'CustomerZipCode'			 =>'ZipCode',
		'CustomerHomePhoneNum'		 =>'Home Phone',
		'CustomerMobilePhoneNum'	 =>'Mobile Phone',
		'CustomerWorkPhoneNum'		 =>'Office Phone',
		'CustomerWorkFaxNum'  		 =>'Office Fax',
		'CustomerWorkExtPhoneNum'	 =>'Work Ext Phone ',
		'CustomerFaxNum'			 =>'FaxNum',
		'CustomerEmail'				 =>'Email',
		'CustomerOfficeName'		 =>'Office Name',
		'CustomerOfficeLine1'		 =>'Office Address Line1',
		'CustomerOfficeLine2'		 =>'Office Address Line2',
		'CustomerOfficeLine3'		 =>'Office Address Line3',
		'CustomerOfficeLine4'		 =>'Office Address Line4',
		'CustomerOfficeCity'		 =>'Office Address City',
		'CustomerOfficeZipCode'		 =>'Office ZipCode',
		'CampaignId'				 =>'Campaign Name',
		'SalutationId'				 =>'SalutationId',
		'GenderId'					 =>'GenderId',
		'IdentificationTypeId'		 =>'Card ID',
		'CustomerIdentificationNum'	 =>'Card ID Number',
		'ChanelId'					 =>'Chanel',
		'CallReasonId'				 =>'Last Status',
		'SellerId'					 =>'Agent',
		'CustomerUpdatedTs'			 =>'Last Updates',
		'JamTayang'					 =>'Jam Tayang di TV');
	  
	  return $fields;
 }
 
// _setUpdate

public function _setUpdate( $params = null )
{
	$_conds = false;
	if( !is_null($params) )
	{
		foreach($params as $field => $value )
		{
			if( $field =='CustomerId'){
				$this ->db->where($field, $value );
			}
			else{
				$this  -> db -> set($field, $value );
			}
		}
		
		if( $this -> db ->update('t_gn_customer') ){
			$_conds = true;
		}
	}
	
	return $_conds;
}


}

?>