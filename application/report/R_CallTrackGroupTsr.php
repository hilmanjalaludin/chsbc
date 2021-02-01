<?php 

/*
 * @ param : class under call tracking report 
 * @ nmae  : R_CallTrackGroupAtm 
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
 
class R_CallTrackGroupTsr extends EUI_Report 
{

 protected $CampaignId 	= null;
 protected $AgentId 	= null;
 protected $SpvId 		= null;
 protected $AtmId 		= null;
 protected $StartDate 	= null;
 protected $EndDate 	= null;
 protected $Interval 	= null;

/* @ param : aksesor **/

 public function R_CallTrackGroupTsr() 
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
	
	if( $this -> URI->_get_array_post('UserId')  
		AND !is_null($this->URI->_get_array_post('UserId')) )
	{
		$this -> AgentId = $this -> URI->_get_array_post('UserId');
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
		$_conds = array ( 
			'CALL_CONTENT' => $this -> _getSummaryReport(), 
			'CALL_VIEWER' => 'call_track_summary_by_tsr',
			'STATUS_NOT_CONNECTION'	=> $this->_getNotConnection(),
			'STATUS_INTERESTED' => $this->_getInterest(),
			'STATUS_NOT_INTERESTED' => $this->_getNotInterest(),
			'STATUS_NO_CONTACT' => $this->_getNotContact(),
			'STATUS_FOLLOW_UP' => $this->_getFollowup(),
			'STATUS_NOT_QUALIFIED' => $this->_getNotQualified(),
			'STATUS_GROUP_CONTACTED' => $this->CallGroupContacted(),
			'STATUS_GROUP_CONNECTED' => $this->CallGroupConnect()	
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
 
	$this ->db ->select("
		COUNT(a.CustomerId) as JUMLAH,  b.AssignSelerId, a.CallReasonId, 
		SUM(IF(a.CallReasonId IS NULL, 1,0)) as NewData,SUM(IF(a.CallReasonId IS NOT NULL, 1,0)) as Utilize", FALSE);
		
	$this->db->from("t_gn_customer a ");
	$this->db->join("t_gn_campaign f ","f.CampaignId=a.CampaignId","LEFT");
	$this->db->join("t_gn_assignment b","a.CustomerId=b.CustomerId","LEFT");

	if( is_array($this->AgentId)) 
	{
		$this->db->where_in("b.AssignSelerId", $this->AgentId );
		$this->db->where_in("b.AssignSpv", $this->AtmId );
		$this->db->where_in("b.AssignLeader", $this->SpvId);
	}	
	else{
		$this->db->where_in("b.AssignSpv", $this->AtmId );
		$this->db->where_in("b.AssignLeader", $this->SpvId);
	}
	
	$this->db->group_by("b.AssignSelerId");
	foreach( $this -> db -> get() -> result_assoc() as $rows )
	{
		$_conds[$rows['AssignSelerId']]['data_size']+= (INT)$rows['JUMLAH'];
		$_conds[$rows['AssignSelerId']]['data_not_utilize']+= (INT)$rows['NewData'];
	}
	
 /** ################################################################# get callreason ID size ################################################################### **/
 
	$this ->db ->select("
		COUNT(a.CustomerId) as JUMLAH,  b.AssignSelerId, a.CallReasonId, 
		SUM(IF(a.CallReasonId IS NULL, 1,0)) as NewData,SUM(IF(a.CallReasonId IS NOT NULL, 1,0)) as Utilize", FALSE);
		
	$this->db->from("t_gn_customer a ");
	$this->db->join("t_gn_campaign f ","f.CampaignId=a.CampaignId","LEFT");
	$this->db->join("t_gn_assignment b","a.CustomerId=b.CustomerId","LEFT");
	
	if( is_array($this->AgentId)) {
		$this->db->where_in("b.AssignSelerId", $this->AgentId );
		$this->db->where_in("b.AssignSpv", $this->AtmId );
		$this->db->where_in("b.AssignLeader", $this->SpvId);
	}	
	else{
		$this->db->where_in("b.AssignSpv", $this->AtmId );
		$this->db->where_in("b.AssignLeader", $this->SpvId);
	}
	
	if( !is_null($this->StartDate) 
		AND !is_null($this->EndDate) )
	{
		$this->db->where("a.CustomerUpdatedTs >='{$this->StartDate} 00:00:00' ");
		$this->db->where("a.CustomerUpdatedTs <='{$this->EndDate} 23:59:59' ");
	}
		
	$this->db->group_by("a.CallReasonId");
	$this->db->group_by("b.AssignSelerId");
	
	foreach( $this -> db -> get() -> result_assoc() as $rows )
	{
		$_conds[$rows['AssignSelerId']][$rows['CallReasonId']]+= (INT)$rows['JUMLAH'];
		$_conds[$rows['AssignSelerId']]['data_utilize']+= (INT)$rows['Utilize'];
	}
	
 /** ########################################################## get size call atempt ########################################################################## **/

	$this->db->select("count(a.CallHistoryId) as size_atempt, c.AssignSelerId",FALSE);
	$this->db->from("t_gn_callhistory a ");
	$this->db->join("t_gn_customer b "," a.CustomerId=b.CustomerId","LEFT");
	$this->db->join("t_gn_assignment c ", " b.CustomerId=c.CustomerId","LEFT");
	
	if( is_array($this->AgentId)) {
		$this->db->where_in("c.AssignSelerId", $this->AgentId );
		$this->db->where_in("c.AssignLeader", $this->SpvId);
	}	
	
	if( !is_null($this->StartDate) 
		AND !is_null($this->EndDate) )
	{
		$this->db->where("a.CallHistoryCreatedTs >='{$this->StartDate} 00:00:00' ");
		$this->db->where("a.CallHistoryCreatedTs <='{$this->EndDate} 23:59:59' ");
	}
	
	$this->db->group_by("c.AssignSelerId");
	foreach( $this -> db -> get() -> result_assoc() as $rows )
	{
		$_conds[$rows['AssignSelerId']]['size_atempt']+= (INT)$rows['size_atempt'];
	}	

/** ########################################################## get name of the TSR ######################################################################### **/
	
	$this->db->select("a.full_name as AgentName, a.UserId ", FALSE);
	$this->db->from("tms_agent  a");
	$this->db->where_in("a.handling_type",array(USER_AGENT_INBOUND, USER_AGENT_OUTBOUND));
	
	if( is_array($this->AgentId)) {
		$this->db->where_in("a.UserId", $this->AgentId );
		$this->db->where_in("a.tl_id", $this ->SpvId);
	}
	
	$this->db->order_by('a.full_name','ASC');
	foreach( $this -> db -> get() -> result_assoc() as $rows ){
		$_conds[$rows['UserId']]['AgentName'] = $rows['AgentName'];
	}	
	
/** ########################################################## hitung jumlah sales dan Premi total ############################################################## **/

   $this ->db->select("COUNT(c.PolicyId) as size_policy, 
				SUM(IF( e.PayModeCode='Q', (d.ProductPlanPremium * 4), 
				IF( e.PayModeCode='S',(d.ProductPlanPremium * 2),
				IF( e.PayModeCode='M',(d.ProductPlanPremium * 12), d.ProductPlanPremium)))) as size_premi,
				f.AssignSelerId",FALSE);
				
	$this->db->from("t_gn_policyautogen a ");
	$this->db->join("t_gn_policy c ","a.PolicyNumber = c.PolicyNumber","LEFT");
	$this->db->join("t_gn_productplan d "," c.ProductPlanId=d.ProductPlanId","LEFT");
	$this->db->join("t_lk_paymode e ", " d.PayModeId=e.PayModeId","LEFT");
	$this->db->join("t_gn_customer b "," a.CustomerId=b.CustomerId","LEFT");
	$this->db->join("t_gn_assignment f","b.CustomerId=f.CustomerId","LEFT");
	
	
	if( is_array($this->AgentId)){
		$this->db->where_in("f.AssignSelerId", $this->AgentId );
		$this->db->where_in("f.AssignLeader", $this->SpvId);
		$this->db->where_in("f.AssignSpv", $this->AtmId);
	}
	else
	{
		$this->db->where_in("f.AssignSpv", $this->AtmId );
		$this->db->where_in("f.AssignLeader", $this->SpvId);
	}
	
	if( !is_null($this->StartDate) 
		AND !is_null($this->EndDate) )
	{
		$this->db->where("c.PolicySalesDate >='{$this->StartDate} 00:00:00' ");
		$this->db->where("c.PolicySalesDate <='{$this->EndDate} 23:59:59' ");
	}
	
	$this->db->group_by("f.AssignSelerId");
	foreach( $this -> db -> get() -> result_assoc() as $rows )
	{
		if( (INT)$rows['size_premi'] !=0 )
		{
			$_conds[$rows['AssignSelerId']]['size_premi']+= $rows['size_premi'];
			$_conds[$rows['AssignSelerId']]['size_policy']+= $rows['size_policy'];
		}	
	}	
	
	return $_conds;
}
   	
}

?>