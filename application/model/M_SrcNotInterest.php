<?php
/*
 * E.U.I 
 *
 * ---------------------------------------------------------------------------- 
 * subject	: M_SetBenefit modul 
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Utility/
 * 
 */
 
class M_SrcNotInterest extends EUI_Model
{

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function M_SrcNotInterest() {
	$this -> load -> model('M_SetCallResult');
	//
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function NotSale()
{
	$_a = array(); $_b = array();
	if( class_exists('M_SetCallResult'))
	{
		$_a = $this -> M_SetCallResult -> _getNotInterest(); 
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
 
function _get_default()
{
	$this -> EUI_Page -> _setPage(10); 
	
	$sql = "SELECT 
			a.CustomerId, a.CustomerFirstName, e.Gender, a.CustomerDOB, c.CardTypeDesc
			FROM t_gn_customer a
			INNER JOIN t_gn_assignment b on a.CustomerId=b.CustomerId 
			LEFT JOIN t_lk_gender e ON a.GenderId=e.GenderId
			LEFT JOIN t_lk_cardtype c ON a.CardTypeId=c.CardTypeId
			LEFT JOIN t_gn_campaign d on a.CampaignId=d.CampaignId 
			LEFT JOIN t_lk_callreason f on a.CallReasonId = f.CallReasonId ";
			
	$this -> EUI_Page -> _setQuery($sql); 
	
	
	 /** set filter **/
 
	$flt = "AND b.AssignAdmin is not null 
			AND b.AssignMgr is not null 
			AND b.AssignSpv is not null
			AND a.CallReasonId IN('".IMPLODE("','",self::NotSale())."') 
			AND b.AssignBlock=0 
			and d.CampaignStatusFlag=1";
				 
/** custom filtering data **/
	
	if( $this -> EUI_Session -> _get_session('HandlingType')==USER_SUPERVISOR )			 
		$flt.=" AND b.AssignSpv ='".$this -> EUI_Session ->_get_session('UserId')."' ";
		
	if( $this -> EUI_Session -> _get_session('HandlingType')==USER_TELESALES )			 
		$flt.=" AND b.AssignSelerId = '".$this -> EUI_Session ->_get_session('UserId')."'";
	
	
	
/** filtering custname **/
				 
	if( $this -> URI->_get_have_post('cust_name_notnit')) {
		$filter.=" AND a.CustomerFirstName LIKE '%".$this -> URI->_get_post('cust_name_notnit')."%'"; 
		$db -> Session -> replace_session('cust_name_notnit',$this -> URI->_get_post('cust_name_notnit'));
	}
	else{
		if(!isset($_REQUEST['cust_name_notnit'])){
			if($this -> EUI_Session ->_have_get_session('cust_name_notnit') )
			$filter.=" AND a.CustomerFirstName LIKE '%".$this -> EUI_Session ->_get_session('cust_name_notnit')."%'"; 
		}
		elseif(isset($_REQUEST['cust_name_notnit']) && $_REQUEST['cust_name_notnit']==''){
			$this -> EUI_Session ->deleted_session('cust_name_notnit');	
		}
	}
	
/** filtering gender**/

	if( $this -> URI->_get_have_post('gender_notnit') ){
		$filter.=" AND a.GenderId = '".$this -> URI->_get_post('gender_notnit')."'"; 
		$this -> EUI_Session ->replace_session('gender_notnit',$this -> URI->_get_post('gender_notnit'));
	}
	else
	{
		if(!isset($_REQUEST['gender_notnit'])){
			if($this -> EUI_Session ->_have_get_session('gender_notnit') )
			$filter.=" AND a.GenderId = '".$this -> EUI_Session ->_get_session('gender_notnit')."'"; 
		}
		elseif(isset($_REQUEST['gender_notnit']) && $_REQUEST['gender_notnit']==''){
			$this -> EUI_Session ->deleted_session('gender_notnit');	
		}
	}
	
// /** filtering card_type **/
	
	if( $this -> URI->_get_have_post('card_type_notnit')) {
		$filter.=" AND c.CardTypeId = '".$this -> URI->_get_post('card_type_notnit')."'"; 
		$this -> EUI_Session ->replace_session('card_type_notnit',$this -> URI->_get_post('card_type_notnit'));
	}
	else
	{
		if(!isset($_REQUEST['card_type_notnit'])){
			if($this -> EUI_Session ->_have_get_session('card_type_notnit') )
			$filter.=" AND c.CardTypeId = '".$this -> EUI_Session ->_get_session('card_type_notnit')."'"; 	
		}
		elseif(isset($_REQUEST['card_type_notnit']) && $_REQUEST['card_type_notnit']==''){
			$this -> EUI_Session ->deleted_session('card_type_notnit');	
		}
	}
	
// /** filtering call_reason **/

	if( $this -> URI->_get_have_post('call_reason_notnit') ){
		$filter.=" AND a.CallReasonId ='".$this -> URI->_get_post('call_reason_notnit')."'";
		$this -> EUI_Session ->replace_session('call_reason_notnit',$this -> URI->_get_post('call_reason_notnit'));
	}
	else{
		if(!isset($_REQUEST['call_reason_notnit'])){
			if($this -> EUI_Session ->_have_get_session('call_reason_notnit') )
			$filter.=" AND a.CallReasonId ='".$this -> EUI_Session ->_get_session('call_reason_notnit')."'";
		}
		elseif(isset($_REQUEST['call_reason_notnit']) && $_REQUEST['call_reason_notnit']==''){
			$this -> EUI_Session ->deleted_session('call_reason_notnit');	
		}
	}	
/** filtering campaign_name **/

	if($this -> URI->_get_have_post('campaign_name_notnit')){
		$filter.=" AND a.CampaignId ='".$this -> URI->_get_post('campaign_name_notnit')."'";	
		$this -> EUI_Session ->replace_session('campaign_name_notnit',$this -> URI->_get_post('campaign_name_notnit'));		
	}
	else{
		if(!isset($_REQUEST['campaign_name_notnit'])){
			if($this -> EUI_Session ->_have_get_session('campaign_name_notnit') )
			$filter.=" AND a.CampaignId ='".$this -> EUI_Session ->_get_session('campaign_name_notnit')."'";	
		}
		elseif(isset($_REQUEST['campaign_name_notnit']) && $_REQUEST['campaign_name_notnit']==''){
			$this -> EUI_Session ->deleted_session('campaign_name_notnit');	
		}
	}

	
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
	$this -> EUI_Page -> _postPage( $this -> URI -> _get_post('v_page') );
	$this -> EUI_Page -> _setPage(10);
	$this -> EUI_Page -> _setQuery
		("
			SELECT a.CustomerId,  a.CallReasonId, a.CampaignId,  a.CustomerNumber, 
				a.CustomerFirstName,  a.CustomerLastName, a.CustomerHomePhoneNum, 
				a.CustomerMobilePhoneNum, a.CustomerWorkPhoneNum,
				IF( f.CallReasonCode is null ,'NEW',f.CallReasonDesc) as CallReasonCode,
				IF( a.CustomerUpdatedTs is null, '-',DATE_FORMAT(a.CustomerUpdatedTs,'%d/%m/%Y %H:%i') ) as CustomerUpdatedTs,
				IF(a.CustomerCity is null,'-',a.CustomerCity) as CustomerCity, 
				a.CustomerUploadedTs, a.CustomerOfficeName, 
				IF( g.CallReasonCategoryName is null,'NEW',g.CallReasonCategoryName) as CallReasonCategoryName, c.CampaignNumber 
			FROM t_gn_customer a 
				INNER JOIN t_gn_assignment b on a.CustomerId=b.CustomerId 
				LEFT JOIN t_gn_campaign c on a.CampaignId=c.CampaignId 
				LEFT JOIN t_lk_callreason f on a.CallReasonId = f.CallReasonId 
				LEFT JOIN t_lk_callreasoncategory g on f.CallReasonCategoryId=g.CallReasonCategoryId"); 
			
	$flt =  " AND b.AssignAdmin IS NOT NULL 
			  AND b.AssignMgr IS NOT NULL 
			  AND b.AssignSpv IS NOT NULL  
			  AND a.CallReasonId IN('".IMPLODE("','",self::NotSale())."') 
			  AND b.AssignBlock=0 
			  AND c.CampaignStatusFlag=1";
				 
	
	if( $this -> EUI_Session -> _get_session('HandlingType')==USER_SUPERVISOR )			 
		$flt.=" AND b.AssignSpv ='".$this -> EUI_Session ->_get_session('UserId')."' ";
		
	if( $this -> EUI_Session -> _get_session('HandlingType')==USER_TELESALES )			 
		$flt.=" AND b.AssignSelerId = '".$this -> EUI_Session ->_get_session('UserId')."'";
	
	if( $this -> URI->_get_have_post('cust_name_notnit') ) 
		$flt.=" AND a.CustomerFirstName LIKE '%".$this -> URI->_get_post('cust_name_notnit')."%'"; 
	
	if( $this -> URI->_get_have_post('cust_number_notnit') ) 
		$flt.=" AND a.CustomerNumber LIKE '%".$this -> URI->_get_post('cust_number_notnit')."%'"; 
		
	if( $this -> URI->_get_have_post('call_result_notnit') )
		$flt.=" AND a.CallReasonId =".$this -> URI->_get_post('call_result_notnit');	
	
	if( $this -> URI->_get_have_post('gender_notnit') )
		$flt.=" AND a.GenderId = '".$this -> URI->_get_post('gender_notnit')."'"; 
		
	if( $this -> URI->_get_have_post('card_type_notnit') )
		$flt.=" AND a.CardTypeId = '".$this -> URI->_get_post('gender_notnit')."'"; 
	
	if( $this -> URI->_get_have_post('call_reason_notnit') )
		$flt.=" AND a.CallReasonId ='".$this -> URI->_get_post('call_reason_notnit')."'";
		
	if( $this -> URI->_get_have_post('campaign_name_notnit') )
		$flt.=" AND a.CampaignId ='".$this -> URI->_get_post('campaign_name_notnit')."'";		
	
 /** create set Limit record **/	
	
	$this -> EUI_Page -> _setWhere( $flt );   
	$this -> EUI_Page -> _setOrderBy
	(
		$this -> URI -> _get_post('order_by'),
		$this -> URI -> _get_post('type')
	); 
	
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
 

}

?>