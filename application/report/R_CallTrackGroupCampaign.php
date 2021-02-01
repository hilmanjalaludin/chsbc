<?php 

/*
 * @ param : class under call tracking report 
 * @ nmae  : R_CallTrackGroupCampaign 
 * ----------------------------------------------------
 * @ param : - 
 * @ param : 
 */
 
define('STATUS_NOT_CONNECTION',7);
define('STATUS_INTERESTED',5);
define('STATUS_NOT_INTERESTED',4);
define('STATUS_NO_CONTACT',2);
define('STATUS_FOLLOW_UP',9);
define('STATUS_NOT_QUALIFIED',10);

/* ---------------------------------------------- */
 
class R_CallTrackGroupCampaign extends EUI_Report 
{

 protected $CampaignId 	= null;
 protected $AgentId 	= null;
 protected $SpvId 		= null;
 protected $AtmId 		= null;
 protected $StartDate 	= null;
 protected $EndDate 	= null;
 protected $Interval 	= null;

/* @ param : aksesor **/

 public function R_CallTrackGroupCampaign() 
{

/* set Interval filter  **/
	if( $this->URI->_get_post('interval') 
		AND !is_null($this->URI->_get_post('interval')) )
	{
		$this->Interval = $this->URI->_get_post('interval');
	}
	
/* set campaign ID **/
	
	if( $this->URI->_get_array_post('CampaignId') 
		AND !is_null($this->URI->_get_array_post('CampaignId')) )
	{
		$this->CampaignId = $this -> URI->_get_array_post('CampaignId');
	}
	
/* set ATM ID **/
	
	if( $this->URI->_get_array_post('AtmId') 
		AND !is_null($this->URI->_get_array_post('AtmId')) )
	{
		$this->AtmId = $this -> URI->_get_array_post('AtmId');
	}
	
/* set SPV ID **/	

	if( $this -> URI->_get_array_post('SpvId')  
		AND !is_null($this->URI->_get_array_post('SpvId')) )
	{
		$this -> SpvId = $this -> URI->_get_array_post('SpvId');
	}
	
/* set AGENT ID **/
	
	if( $this -> URI->_get_array_post('AgentId')  
		AND !is_null($this->URI->_get_array_post('AgentId')) )
	{
		$this -> AgentId = $this -> URI->_get_array_post('AgentId');
	}
	
/* set AGENT ID **/
	
	if( $this -> URI->_get_post('start_date')  
		AND !is_null($this->URI->_get_post('start_date')) )
	{
		$this->StartDate = date('Y-m-d', strtotime($this -> URI->_get_post('start_date')));
		$this->EndDate = date('Y-m-d', strtotime($this -> URI->_get_post('end_date')));
		
	}
	
}
	

/* @ param : get interval mode in / hourly/ daily/ summary   **/

public function _getResultReport() 
{
	
    $_conds = array();
	if( !empty($this -> Interval) 
		AND ($this -> Interval=='summary') )
	{
		$_conds = array 
		( 
			'call_viewer' 			 => 'view_calltrack_campaign_summary_html',
			'call_content' 			 => $this->_getSummaryReport(), 
			'status_not_connection'	 => $this->_getNotConnection(),
			'status_interested' 	 => $this->_getInterest(),
			'status_not_interested'  => $this->_getNotInterest(),
			'status_no_contact' 	 => $this->_getNotContact(),
			'status_follow_up' 		 => $this->_getFollowup(),
			'status_not_qualified'   => $this->_getNotQualified(),
			'status_group_contacted' => $this->CallGroupContacted(),
			'status_group_connected' => $this->CallGroupConnect()	
		); 	
	}
	
	return $_conds;
}

/* @ param : get interval mode in / hourly/ daily/ summary   **/

public function CallGroupContacted()
{
	$CallGroupCantacted = array();
	foreach( array( 
		array_keys($this->_getFollowup()), 
		array_keys($this->_getInterest()), 
		array_keys($this->_getNotInterest()), 
		array_keys($this->_getNotQualified())) as $key => $values )
	{
		if( is_array($values) ) foreach($values as $key => $CallReasonId )
		{
			$CallGroupCantacted[$CallReasonId] = $CallReasonId;
		}
	}
	
	// return 
	
	if( is_array($CallGroupCantacted) )
	{
		return array_keys($CallGroupCantacted);
	}
}

/* @ param : get interval mode in / hourly/ daily/ summary   **/

public function CallGroupConnect()
{
	$CallGroupConnect = array();
	foreach( array( 
		array_keys($this->_getFollowup()), 
		array_keys($this->_getInterest()), 
		array_keys($this->_getNotInterest()), 
		array_keys($this->_getNotQualified()),
		array_keys($this->_getNotContact())) as $key => $values )
	{
		if( is_array($values) ) foreach($values as $key => $CallReasonId )
		{
			$CallGroupConnect[$CallReasonId] = $CallReasonId;
		}
	}
	
	// return 
	
	if( is_array($CallGroupConnect) )
	{
		return array_keys($CallGroupConnect);
	}
}

/* @ param : get interval mode in / hourly/ daily/ summary   **/

function _getInterest()
{
	$conds = array();
	
	$this->db->select("a.CallReasonId, a.CallReasonCode ");
	$this->db->from("t_lk_callreason a");
	$this->db->where("a.CallReasonCategoryId",STATUS_INTERESTED );
	$this->db->where_not_in("a.CallReasonCode",array(804,899));
	$this->db->where("a.CallReasonStatusFlag",1);
	$this->db->order_by("a.CallReasonCode", "ASC");
	
	foreach( $this->db->get()-> result_assoc() as $rows ) {
		$conds[$rows['CallReasonId']] = $rows['CallReasonCode'];
	}
	
	return $conds;	
}

/* @ param : get interval mode in / hourly/ daily/ summary   **/

function _getNotInterest()
{
	$conds = array();
	
	$this->db->select("a.CallReasonId, a.CallReasonCode ");
	$this->db->from("t_lk_callreason a");
	$this->db->where("a.CallReasonCategoryId",STATUS_NOT_INTERESTED);
	$this->db->where("a.CallReasonStatusFlag",1);
	$this->db->order_by("a.CallReasonCode", "ASC");
	
	foreach( $this->db->get()-> result_assoc() as $rows ) 
	{
		$conds[$rows['CallReasonId']] = $rows['CallReasonCode'];
	}
	
	return $conds;	
}

/* @ param : get interval mode in / hourly/ daily/ summary   **/

function _getNotQualified()
{
	$conds = array();
	
	$this->db->select("a.CallReasonId, a.CallReasonCode ");
	$this->db->from("t_lk_callreason a");
	$this->db->where("a.CallReasonCategoryId",STATUS_NOT_QUALIFIED);
	$this->db->where("a.CallReasonStatusFlag",1);
	$this->db->order_by("a.CallReasonCode", "ASC");
	
	foreach( $this->db->get()-> result_assoc() as $rows ) {
		$conds[$rows['CallReasonId']] = $rows['CallReasonCode'];
	}
	
	return $conds;	
}

/* @ param : get interval mode in / hourly/ daily/ summary   **/

function _getFollowup()
{
	$conds = array();
	$this->db->select("a.CallReasonId, a.CallReasonCode ");
	$this->db->from("t_lk_callreason a");
	$this->db->where("a.CallReasonCategoryId", STATUS_FOLLOW_UP );
	$this->db->where("a.CallReasonStatusFlag",1);
	$this->db->order_by("a.CallReasonCode", "ASC");
	
	foreach( $this->db->get()->result_assoc() as $rows ) 
	{
		$conds[$rows['CallReasonId']] = $rows['CallReasonCode'];
	}
	
	return $conds;	
}	

/* @ param : get interval mode in / hourly/ daily/ summary   **/

function _getNotConnection()
{
	$conds = array();
	$this->db->select("a.CallReasonId, a.CallReasonCode");
	$this->db->from("t_lk_callreason a");
	$this->db->where("a.CallReasonCategoryId",STATUS_NOT_CONNECTION);
	$this->db->where("a.CallReasonStatusFlag",1);
	$this->db->order_by("a.CallReasonCode", "ASC");
	
	foreach( $this->db->get()-> result_assoc() as $rows ) 
	{
		$conds[$rows['CallReasonId']] = $rows['CallReasonCode'];
	}
	
	return $conds;
}	

/* @ param : get interval mode in / hourly/ daily/ summary   **/

function _getNotContact()
{
	$conds = array();
	$this->db->select("a.CallReasonId, a.CallReasonCode ");
	$this->db->from("t_lk_callreason a");
	$this->db->where("a.CallReasonCategoryId", STATUS_NO_CONTACT );
	$this->db->where("a.CallReasonStatusFlag",1);
	$this->db->order_by("a.CallReasonCode", "ASC");
	
	foreach( $this->db->get()-> result_assoc() as $rows ) 
	{
		$conds[$rows['CallReasonId']] = $rows['CallReasonCode'];
	}
	
	return $conds;
}
	


/* _summaryCallTrackGroupCampaign **/

public function _getSummaryReport()
{
  $_conds = array();
 
 /** ################################################################# get new data and data size ################################################################# **/
	$this->db->reset_select();
	$this->db->select("
		COUNT(a.CustomerId) as tot,  a.CampaignId, a.CallReasonId, 
		SUM(IF(a.CallReasonId IN(99), 1,0)) as tot_unutilize,
		SUM(IF(a.CallReasonId IS NOT NULL, 1,0)) as tot_utilize", FALSE);
		
	$this->db->from("t_gn_customer a ");
	$this->db->join("t_gn_campaign f ","f.CampaignId=a.CampaignId","LEFT");
	$this->db->join("t_gn_assignment b","a.CustomerId=b.CustomerId","LEFT");

	if( is_array($this->CampaignId)) {
		$this->db->where_in("f.CampaignId", $this->CampaignId );
	}	
	
	$this->db->group_by("f.CampaignId");
	$this->db->print_out();
	
	foreach( $this -> db -> get() -> result_assoc() as $rows )
	{
		$_conds[$rows['CampaignId']]['data_size']+= (int)$rows['tot'];
		$_conds[$rows['CampaignId']]['data_not_utilize']+= (int)$rows['tot_unutilize'];
	}
	
 /** ################################################################# get callreason ID size ################################################################### **/
	$this->db->reset_select();
	$this ->db ->select("
		COUNT(a.CustomerId) as JUMLAH,  a.CampaignId, a.CallReasonId, 
		SUM(IF(a.CallReasonId IS NULL, 1,0)) as NewData,SUM(IF(a.CallReasonId IS NOT NULL, 1,0)) as Utilize", FALSE);
		
	$this->db->from("t_gn_customer a ");
	$this->db->join("t_gn_campaign f ","f.CampaignId=a.CampaignId","LEFT");
	$this->db->join("t_gn_assignment b","a.CustomerId=b.CustomerId","LEFT");
	
	if( is_array($this->CampaignId)) {
		$this->db->where_in("f.CampaignId", $this->CampaignId );
	}	
	
	if( !is_null($this->StartDate) 
		AND !is_null($this->EndDate) )
	{
		$this->db->where("a.CustomerUpdatedTs >='{$this->StartDate} 00:00:00' ");
		$this->db->where("a.CustomerUpdatedTs <='{$this->EndDate} 23:59:59' ");
	}
		
	$this->db->group_by("a.CallReasonId");
	$this->db->group_by("f.CampaignId");
	
	foreach( $this -> db -> get() -> result_assoc() as $rows )
	{
		$_conds[$rows['CampaignId']][$rows['CallReasonId']]+= (INT)$rows['JUMLAH'];
		$_conds[$rows['CampaignId']]['data_utilize']+= (INT)$rows['Utilize'];
	}
	
 /** ########################################################## get size call atempt ########################################################################## **/

	$this->db->select("count(a.CallHistoryId) as size_atempt, b.CampaignId",FALSE);
	$this->db->from("t_gn_callhistory a ");
	$this->db->join("t_gn_customer b "," a.CustomerId=b.CustomerId","LEFT");
	$this->db->join("t_gn_assignment c ", " b.CustomerId=c.CustomerId","LEFT");
	
	if( is_array($this->CampaignId)) {
		$this->db->where_in("b.CampaignId", $this->CampaignId );
	}	
	
	if( !is_null($this->StartDate) 
		AND !is_null($this->EndDate) )
	{
		$this->db->where("a.CallHistoryCreatedTs >='{$this->StartDate} 00:00:00' ");
		$this->db->where("a.CallHistoryCreatedTs <='{$this->EndDate} 23:59:59' ");
	}
	
	$this->db->group_by("b.CampaignId");
	foreach( $this -> db -> get() -> result_assoc() as $rows )
	{
		$_conds[$rows['CampaignId']]['size_atempt']+= (INT)$rows['size_atempt'];
	}	

/** ########################################################## get name of the campaign ######################################################################### **/
	
	$this->db->reset_select();
	$this->db->select("a.CampaignId, a.CampaignName", FALSE);
	$this->db->from("t_gn_campaign  a");
	$this->db->where("a.OutboundGoalsId",'2');
	
	if( is_array($this->CampaignId)) {
		$this->db->where_in("a.CampaignId", $this->CampaignId );
	}
	
	foreach( $this -> db -> get() -> result_assoc() as $rows ){
		$_conds[$rows['CampaignId']]['CampaignName'] = $rows['CampaignName'];
	}	
	
/** ########################################################## hitung jumlah sales dan Premi total ############################################################## **/
   
   $this->db->reset_select();
   $this ->db->select("COUNT(c.PolicyId) AS size_policy, 
				SUM(IF( e.PayModeCode='Q', (d.ProductPlanPremium * 4), 
				IF( e.PayModeCode='S',(d.ProductPlanPremium * 2),
				IF( e.PayModeCode='M',(d.ProductPlanPremium * 12), d.ProductPlanPremium)))) as size_premi,
				b.CampaignId",FALSE);
				
	$this->db->from("t_gn_policyautogen a ");
	$this->db->join("t_gn_policy c ","a.PolicyNumber = c.PolicyNumber","LEFT");
	$this->db->join("t_gn_productplan d "," c.ProductPlanId=d.ProductPlanId","LEFT");
	$this->db->join("t_lk_paymode e ", " d.PayModeId=e.PayModeId","LEFT");
	$this->db->join("t_gn_customer b "," a.CustomerId=b.CustomerId","LEFT");
	
	if( is_array($this->CampaignId)) {
		$this->db->where_in("b.CampaignId", $this->CampaignId );
	}
	
	if( !is_null($this->StartDate) 
		AND !is_null($this->EndDate) )
	{
		$this->db->where("c.PolicySalesDate >='{$this->StartDate} 00:00:00' ");
		$this->db->where("c.PolicySalesDate <='{$this->EndDate} 23:59:59' ");
	}
	
	$this->db->group_by("b.CampaignId");
	
	foreach( $this -> db -> get() -> result_assoc() as $rows )
	{
		$_conds[$rows['CampaignId']]['size_premi'] += $rows['size_premi'];
		$_conds[$rows['CampaignId']]['size_policy']+= $rows['size_policy'];
	}	
	
	return $_conds;
}
   	
}

?>