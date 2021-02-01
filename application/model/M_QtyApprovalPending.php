<?php
/*
 * E.U.I 
 * -----------------------------------------------
 *
 * subject	: M_QtyApprovalInterest
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class M_QtyApprovalPending Extends EUI_Model
{

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function M_QtyApprovalPending()
 {
	$this -> load -> model(array('M_SetCallResult','M_SetResultQuality'));
 }
 
 /*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 private function _getApprovalInterest()
 {
	$_conds = array();
	if(class_exists('M_SetCallResult'))
	{
		$i = 0;
		foreach( $this -> M_SetCallResult -> _getEventSale() as $k => $rows )
		{
			$_conds[$i] = $k;
			$i++;
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
 */
 
public function _get_default()
{
	$this -> EUI_Page->_setPage(10);
	$this -> EUI_Page -> _setQuery
		 (" SELECT 
				c.CustomerId, c.CampaignId, c.CustomerNumber,
				c.CustomerFirstName, e.CampaignNumber, f.AproveName,
				e.CampaignName,
				b.PolicySalesDate, h.id, h.full_name,
				IF(f.AproveName is null,'Request Confirm', f.AproveName) as  AproveName
			FROM t_gn_policyautogen a
			left join t_gn_policy b on a.PolicyNumber=b.PolicyNumber
			left join t_gn_customer c on a.CustomerId=c.CustomerId
			left join t_gn_assignment d on a.CustomerId=d.CustomerId
			left join t_gn_campaign e on c.CampaignId=e.CampaignId
			left join t_lk_aprove_status f on c.CallReasonQue=f.ApproveId
			left join tms_agent h on d.AssignSelerId=h.UserId"); 
	
 // filtering 
	$flt = " AND c.CallReasonId IN('".implode("','",self::_getApprovalInterest())."') 
			 AND d.AssignAdmin IS NOT NULL 
			 AND d.AssignMgr IS NOT NULL 
			 AND d.AssignSpv IS NOT NULL
			 AND c.CallReasonQue IN('".implode("','",$this -> M_SetResultQuality ->_getQualityBackLevel())."')
			 AND d.AssignBlock=0 ";
			 
				 
			
  // filtring by login 
	
	if( $this -> EUI_Session -> _get_session('HandlingType')==SUPERVISOR )			 
		$flt.=" AND d.AssignSpv ='".$this -> EUI_Session -> _get_session('UserId')."' ";
		
	if($this -> EUI_Session -> _get_session('HandlingType')==USER_AGENT_OUTBOUND)
		$flt.=" AND d.AssignSelerId ='".$this -> EUI_Session -> _get_session('UserId')."' ";
		
	if($this -> EUI_Session -> _get_session('HandlingType')==USER_AGENT_INBOUND)
		$flt.=" AND d.AssignSelerId ='".$this -> EUI_Session -> _get_session('UserId')."' ";	
		
 // filtering by session customize 

	if( $this -> URI->_get_have_post('cust_name') ){ 
		$$flt.=" AND c.CustomerFirstName LIKE '%".$this -> URI->_get_post('cust_name')."%'"; 
		$this -> EUI_Session ->replace_session('cust_name',$this -> URI->_get_post('cust_name'));
	}
	else{
		if(!isset($_REQUEST['cust_name'])){
			if($this -> EUI_Session ->_have_get_session('cust_name') )
			$$flt.=" AND c.CustomerFirstName LIKE '%".$this -> EUI_Session->_get_session('cust_name')."%'"; 
		}
		elseif(isset($_REQUEST['cust_name']) && $_REQUEST['cust_name']==''){
			$this -> EUI_Session ->deleted_session('cust_name');	
		}
	}
	
///	**************** ??
	if( $this -> URI->_get_have_post('cust_number') ) {
		$$flt.=" AND c.CustomerNumber LIKE '%".$this -> URI->_get_post('cust_number')."%'"; 
		$this -> EUI_Session ->replace_session('cust_number',$this -> URI->_get_post('cust_number'));
	}
	else{
		if(!isset($_REQUEST['cust_number'])){
			if($this -> EUI_Session ->_have_get_session('cust_number') )
			$$flt.=" AND c.CustomerNumber LIKE '%".$this -> EUI_Session->_get_session('cust_number')."%'"; 
		}
		elseif(isset($_REQUEST['cust_number']) && $_REQUEST['cust_number']==''){
			$this -> EUI_Session ->deleted_session('cust_number');	
		}
	}	

///	**************** ??
	
	if( $this -> URI->_get_have_post('campaign_id') ){
		$$flt.=" AND c.CampaignId =".$this -> URI->_get_post('campaign_id');	
		$this -> EUI_Session ->replace_session('campaign_id',$this -> URI->_get_post('campaign_id'));
	}
	else{
		if(!isset($_REQUEST['campaign_id'])){
			if($this -> EUI_Session ->_have_get_session('campaign_id') )
			$$flt.=" AND c.CampaignId ='".$this -> EUI_Session->_get_session('campaign_id')."'";	
		}
		elseif(isset($_REQUEST['campaign_id']) && $_REQUEST['campaign_id']==''){
			$this -> EUI_Session ->deleted_session('campaign_id');	
		}
	}
	
// src category id session 
	
	if( $this -> URI->_get_have_post('category_id') ){
		$$flt.=" AND e.CategoryId =".$this -> URI->_get_post('category_id');	
		$this -> EUI_Session ->replace_session('category_id',$this -> URI->_get_post('category_id'));
	}
	else{
		if(!isset($_REQUEST['category_id'])){
			if($this -> EUI_Session ->_have_get_session('category_id') )
			$$flt.=" AND e.CategoryId ='".$this -> EUI_Session->_get_session('category_id')."'";	
		}
		elseif(isset($_REQUEST['category_id']) && $_REQUEST['category_id']==''){
			$this -> EUI_Session ->deleted_session('category_id');	
		}
	}	
	
///	**************** ??
	
	if( $this -> URI->_get_have_post('start_date') && $this -> URI->_get_have_post('end_date') ){
		$$flt .= " AND date(b.PolicySalesDate) >= '".$this -> EUI_Tools->_date_english($_REQUEST['start_date'])."' 
					 AND date(b.PolicySalesDate) <= '".$this -> EUI_Tools->_date_english($_REQUEST['end_date'])."' "; 
		$this -> EUI_Session ->replace_session('start_date',$this -> URI->_get_post('start_date'));
		$this -> EUI_Session ->replace_session('end_date',$this -> URI->_get_post('end_date'));
		
	}
	else
	{
		if(!isset($_REQUEST['start_date']) && !isset($_REQUEST['end_date']) )
		{
			if($this -> EUI_Session ->_have_get_session('start_date') && $this -> EUI_Session ->_have_get_session('end_date') ){
				$$flt .= " AND date(b.PolicySalesDate) >= '".$this -> EUI_Tools->_date_english( $this -> EUI_Session ->_get_session('start_date'))."' 
							 AND date(b.PolicySalesDate) <= '".$this -> EUI_Tools->_date_english( $this -> EUI_Session ->_get_session('end_date'))."' "; 
			}
		}
		elseif(isset($_REQUEST['start_date']) && ($_REQUEST['start_date']=='') 
			&& (isset($_REQUEST['end_date'])) && ($_REQUEST['end_date']) )
		{
			$this -> EUI_Session ->deleted_session('start_date');	
			$this -> EUI_Session ->deleted_session('end_date');	
		}
	}
	
///	**************** ??
	
	if($this -> URI->_get_have_post('user_id')){
		$$flt.=" AND d.AssignSelerId = '".$this -> URI->_get_post('user_id')."'";
		$this -> EUI_Session ->replace_session('user_id',$this -> URI->_get_post('user_id'));
	}
	else{
		if(!isset($_REQUEST['user_id'])){
			if($this -> EUI_Session ->_have_get_session('user_id') )
			$$flt.=" AND d.AssignSelerId ='".$this -> EUI_Session->_get_session('user_id')."'";	
		}
		elseif(isset($_REQUEST['user_id']) && $_REQUEST['user_id']==''){
			$this -> EUI_Session ->deleted_session('user_id');	
		}
	}	
///	**************** ??		

    if( $this -> URI->_get_have_post('call_result'))
	{ 
		$$flt .=" AND c.CallReasonId ='".$this -> URI->_get_post('call_result')."'"; 
		$this -> EUI_Session ->replace_session('call_result',$this -> URI->_get_post('call_result'));
	}
	else{
		if(!isset($_REQUEST['call_result'])){
			if($this -> EUI_Session ->_have_get_session('call_result') )
			$$flt.=" AND c.CallReasonId ='".$this -> EUI_Session->_get_session('call_result')."'";	
		}
		elseif(isset($_REQUEST['call_result']) && $_REQUEST['call_result']==''){
			$this -> EUI_Session ->deleted_session('call_result');	
		}
	}
	
// run filter
	
	$this->EUI_Page->_setWhere( $flt ); 
	$this->EUI_Page->_setGroupBy('c.CustomerId');   
	if($this -> EUI_Page -> _get_query())
	{
		return $this -> EUI_Page;
	}	 
	
	
 }
 
 /*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
 public function _get_content()
 {
	$this -> EUI_Page->_postPage( $this -> URI -> _get_post('v_page') );
	$this -> EUI_Page->_setPage(10);
	$this -> EUI_Page->_setQuery(" 
			SELECT 
				DISTINCT(a.PolicyNumber),
				c.CustomerId, c.CampaignId, c.CustomerNumber,
				c.CustomerFirstName, e.CampaignNumber, f.AproveName,
				e.CampaignName, b.PolicySalesDate, h.id, h.full_name,
				IF(f.AproveName is null,'Request Confirm', f.AproveName) as  AproveName
				FROM t_gn_policyautogen a
				left join t_gn_policy b on a.PolicyNumber=b.PolicyNumber
				left join t_gn_customer c on a.CustomerId=c.CustomerId
				left join t_gn_assignment d on a.CustomerId=d.CustomerId
				left join t_gn_campaign e on c.CampaignId=e.CampaignId
				left join t_lk_aprove_status f on c.CallReasonQue=f.ApproveId
				left join tms_agent h on d.AssignSelerId=h.UserId"
	); 
	
	$flt = " AND c.CallReasonId IN('".implode("','",self::_getApprovalInterest())."') 
			 AND d.AssignAdmin IS NOT NULL 
			 AND d.AssignMgr IS NOT NULL 
			 AND d.AssignSpv IS NOT NULL
			 AND c.CallReasonQue IN('".implode("','",$this -> M_SetResultQuality ->_getQualityBackLevel())."')
			 AND d.AssignBlock=0 ";
				 		
			
  // filtring by login 
	
	if( $this -> EUI_Session -> _get_session('HandlingType')==SUPERVISOR )			 
		$flt.=" AND d.AssignSpv ='".$this -> EUI_Session -> _get_session('UserId')."' ";
		
	if($this -> EUI_Session -> _get_session('HandlingType')==USER_AGENT_OUTBOUND)
		$flt.=" AND d.AssignSelerId ='".$this -> EUI_Session -> _get_session('UserId')."' ";
		
	if($this -> EUI_Session -> _get_session('HandlingType')==USER_AGENT_INBOUND)
		$flt.=" AND d.AssignSelerId ='".$this -> EUI_Session -> _get_session('UserId')."' ";
		
 // filtring by keep session 
					
	if( $this -> URI->_get_have_post('cust_name') ) 
		$flt.=" AND c.CustomerFirstName LIKE '%".$this -> URI->_get_post('cust_name')."%'"; 
	
	if( $this -> URI->_get_have_post('cust_number') ) 
		$flt.=" AND c.CustomerNumber LIKE '%".$this -> URI->_get_post('cust_number')."%'"; 
		
	
	if( $this -> URI->_get_have_post('campaign_id') )
		$flt.=" AND c.CampaignId =".$this -> URI->_get_post('campaign_id');	
	
	if( $this -> URI->_get_have_post('category_id') )
		$flt.=" AND e.CategoryId =".$this -> URI->_get_post('category_id');	

	if( $this -> URI->_get_have_post('start_date') && $this ->URI ->_get_have_post('end_date') )
		$flt .= " AND date(b.PolicySalesDate)>= '".$this ->EUI_Tools ->_date_english($this ->URI ->_get_post('start_date'))."' 
					 AND date(b.PolicySalesDate)<= '".$this ->EUI_Tools ->_date_english($this ->URI ->_get_post('end_date'))."' "; 
	
	
	if($this -> URI->_get_have_post('user_id'))
		$flt.=" AND d.AssignSelerId = '".$this -> URI->_get_post('user_id')."'";
		

    if( $this -> URI->_get_have_post('call_result'))
		$flt .=" AND c.CallReasonId ='".$this -> URI->_get_post('call_result')."'"; 
		
	$this -> EUI_Page ->_setWhere( $flt );   
	$this -> EUI_Page ->_setGroupBy('c.CustomerId');   
	$this -> EUI_Page ->_setLimit();
	
 }
 
 
/*
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