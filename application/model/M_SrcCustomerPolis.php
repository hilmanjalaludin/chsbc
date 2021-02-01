<?php
/*
 * E.U.I 
 *
 * ------------------------------------------------------------------
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class M_SrcCustomerPolis extends EUI_Model
{

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function M_SrcCustomerPolis()
{
		
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
	$this -> EUI_Page->_setPage(10);
	$this -> EUI_Page -> _setQuery
			(" SELECT a.CustomerId, a.CallReasonId, a.CampaignId, a.CustomerNumber, a.CustomerFirstName,  a.CustomerLastName, 
			   a.CustomerHomePhoneNum, a.CustomerMobilePhoneNum, a.CustomerWorkPhoneNum, IF( d.CallReasonCode is null ,'NEW',d.CallReasonDesc) as CallReasonCode,
			   IF( a.CustomerUpdatedTs is null, '-',DATE_FORMAT(a.CustomerUpdatedTs,'%d-%m-%Y %H:%i') ) as CustomerUpdatedTs,
			   IF(a.CustomerCity is null,'-',a.CustomerCity) as CustomerCity,  a.CustomerUploadedTs,  a.CustomerOfficeName,  c.CampaignNumber 
			   FROM t_gn_customer a INNER JOIN t_gn_assignment b on a.CustomerId=b.CustomerId 
			   LEFT JOIN t_gn_campaign c on a.CampaignId=c.CampaignId 
			   LEFT join t_lk_callreason d on a.CallReasonId =d.CallReasonId "); 
			
	$flt    = " AND b.AssignAdmin is not null 
				AND b.AssignMgr is not null 
				AND b.AssignSpv is not null 
				AND a.CallReasonId IN(16,17)";
				
			
	$this -> EUI_Page -> _setWhere( $flt ); 
	if($this -> EUI_Page -> _get_query())
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
			(" SELECT a.CustomerId, a.CallReasonId, a.CampaignId, a.CustomerNumber, a.CustomerFirstName,  a.CustomerLastName, 
			   a.CustomerHomePhoneNum, a.CustomerMobilePhoneNum, a.CustomerWorkPhoneNum, IF( d.CallReasonCode is null ,'NEW',d.CallReasonDesc) as CallReasonCode,
			   IF( a.CustomerUpdatedTs is null, '-',DATE_FORMAT(a.CustomerUpdatedTs,'%d-%m-%Y %H:%i') ) as CustomerUpdatedTs,
			   IF(a.CustomerCity is null,'-',a.CustomerCity) as CustomerCity,  a.CustomerUploadedTs,  a.CustomerOfficeName,  c.CampaignNumber 
			   FROM t_gn_customer a INNER JOIN t_gn_assignment b on a.CustomerId=b.CustomerId 
			   LEFT JOIN t_gn_campaign c on a.CampaignId=c.CampaignId 
			   LEFT join t_lk_callreason d on a.CallReasonId =d.CallReasonId "); 
			
	$flt    = " AND b.AssignAdmin is not null 
				AND b.AssignMgr is not null 
				AND b.AssignSpv is not null ";
				 
	
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')==USER_SUPERVISOR)	
		$flt.=" AND b.AssignSpv ='".$this ->EUI_Session ->_get_session('UserId')."' ";
		
	if( $this -> EUI_Session -> _have_get_session('handling_type')==USER_TELESALES)
		$flt.=" AND b.AssignSelerId = '".$this ->EUI_Session ->_get_session('UserId')."'";
				 	
	if( $this -> URI ->_get_have_post('cust_name') ) 
		$flt.=" AND a.CustomerFirstName LIKE '%".$this -> URI ->_get_post('cust_name')."%'"; 
	
	if( $this -> URI ->_get_have_post('cust_number') ) 
		$flt.=" AND a.CustomerNumber LIKE '%".$this -> URI ->_get_post('cust_number')."%'"; 
		
	if($this -> URI ->_get_have_post('campaign_id') )
		$flt.=" AND a.CampaignId =".$this -> URI ->_get_post('campaign_id');	
    	
	$flt.=" AND a.CallReasonId IN(16,17)";		
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

	
}

?>