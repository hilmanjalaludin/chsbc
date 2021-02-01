<?php
define('DUPLICATE',1);
define('REPLACE',2);

class M_ManageInboundOutbound extends EUI_Model
{


private static $keyword = null;
	
/* M_ManageInboundOutbound ***/

var $perpage = null;
var $start = null;
var $filters = null;

	
function M_ManageInboundOutbound() 
{
	
	self::$keyword  = array
	( 
		'CustomerMobilePhoneNum' 	=> 'Mobile phone', 
		'CustomerHomePhoneNum' 		=> 'Home phone', 
		'CustomerWorkPhoneNum' 		=> 'Office Phone',
		'CustomerFirstName' 		=> 'Customer Name',
		'CustomerNumber' 			=> 'CIF', 
		'GenderId' 					=> 'Gender' 
	);
	
	$this->perpage = 20;
	$this->filters = array( 'CustomerId', 'CallReasonId', 'CampaignId', 'SellerId', 'AssignAdmin');
}


public function _getCompareFields() {
	return self::$keyword;	
}


/*
 * EUI :: _get_resource_query() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
public function getDataCompare()
{

	$data = array();
	$this ->db ->select(" a.CustomerId, a.CustomerNumber, a.CustomerFirstName, a.GenderId,  a.CustomerMobilePhoneNum, a.CustomerHomePhoneNum, a.CustomerWorkPhoneNum", FALSE);
	$this->db->from("t_gn_customer a");
	foreach( $this->db->get() -> result_assoc() as $rows )
	{
		$data[$rows['CustomerId']] = $rows;
	}

	return $data;	
}


public function counter( $where = null, $CampaignId = 0, $CustomerNumber=0 )
{
	$int = 0;
	
	if( !is_null($where) )
	{
		$sql = " SELECT COUNT(CustomerId) as size FROM t_gn_customer ";
		foreach( $where as $CustomerId => $b )
		{
			$sql.= "WHERE CustomerId NOT IN('$CustomerId') 
					AND CampaignId NOT IN('$CampaignId') ";
			$si = 0;
			foreach( $b as $fieldname => $values )
			{
				$si++;
				if( $si == 1 ){
					$sql.= " AND ( $fieldname IN('" . mysql_real_escape_string($values)."') ";
				}
				else{
					$sql.= " OR $fieldname IN('" . mysql_real_escape_string($values) . "') ";
				}
				
			}
			
			$sql .= " ) ";
			
		}
		
		$qry = $this->db->query($sql);
		if( $qry )
		{
		
			if( $rows = $qry -> result_first_assoc() ){
				$int = (INT)$rows['size'];
			}
		}
		else{
			__(mysql_error());
		}	
	}	
	
	return $int;
	
	
}

/*
 * EUI :: _get_resource_query() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */

 
public function setGlobalCompare() 
{
  $Compres = array();
  $Compare = null;  
  if( $this->URI->_get_have_post('Compare') ) {
	  $Compare  = $this -> URI->_get_array_post('Compare');
  }
   
   
 /* data campaign yang akan di filter **/
 
  $this ->db ->select(" a.CustomerId, a.CampaignId, a.CustomerNumber, a.CallReasonId,
			a.CustomerFirstName, a.GenderId, a.CustomerMobilePhoneNum, a.CustomerHomePhoneNum, a.CustomerWorkPhoneNum, 
			IF( b.start_time IS NULL, c.start_time, b.start_time) as start_time", FALSE);
  $this->db->from("t_gn_customer a");
  $this->db->join("cc_call_session b ","a.CustomerNumber=b.session_id","LEFT");
  $this->db->join("ivr_voice_mail c ", "a.CustomerId = c.assignment_data","LEFT");
  $this->db->where("a.CampaignId", $this->URI->_get_post('CampaignId'));
  
  if( $this->URI->_get_have_post('CallReasonId')){
	$this->db->where('a.CallReasonId', _get_post('CallReasonId'));
  }
  
  if( $this -> URI->_get_have_post('keywords') ) 
  {
	$this -> db -> or_like('a.CustomerFirstName', $this -> URI->_get_post('keywords'));
	$this -> db -> or_like('a.CustomerMobilePhoneNum', $this -> URI->_get_post('keywords'));
  }
  
  
  
  // order by 
  
  if( $this->URI->_get_have_post('order_by')){
	$this->db->order_by(_get_post('order_by'), _get_post('type'));
  }
  
  $i = 0;
  foreach( $this->db->get() -> result_assoc() as $rows )
  {
	if(is_array($Compare) 
		AND !is_null($Compare) )
	{
		$where = null;
		foreach($Compare as $key => $field )
		{	
			if( !empty($rows[$field]) )
			{
				$where[$rows['CustomerId']][$field]= $rows[$field];
			}
		}
		
		$count =(INT)$this->counter($where, $rows['CampaignId']);
		if(($count==0)) {
			$Compres[$i] = $rows;
		}
		
		$i++;
	}
	else {
		$Compres[$i] = $rows;
		$i++;
	}	
	 
  }
  
  return $Compres;
	
}


/*
 * EUI :: _get_resource_query() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */

public function getPrivileges()
{
	$data = array();
	if( $User = $this->M_SysUser->_get_handling_type() ) 
	{
		foreach( $User as $PrivilegeId  => $PrivilegeName ) 
		{
			if( !in_array($PrivilegeId, 
				array(USER_ROOT, USER_ADMIN, USER_QUALITY_STAFF, USER_QUALITY_HEAD, USER_AGENT_INBOUND))) 
			{
				$data[$PrivilegeId] = $PrivilegeName;
			}
		}
	}
	
	return $data;
}


/*
 * EUI :: _get_resource_query() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */

public function Pager()
{	
	$data = array (
		'record'	 	=> 0, 
		'page'		 	=> 0, 
		'field' 	 	=> $this->_getCompareFields(),
		'Outbound'	 	=> $this->M_SetCampaign->_getCampaignGoals(2),
		'Privileges' 	=> $this->getPrivileges(),
		'Campaign'	 	=> $this->M_SetCampaign->getAttribute($this->URI->_get_post('CampaignId')),
		'CallReasonId' 	=> $this->M_Combo->_getCallResultInbound()
	);
	
	if( $Compress = $this->setGlobalCompare() )
	{
		$tot_records = count($Compress);
		$tot_pages = ceil($tot_records/$this -> perpage);
		$data['record'] =  $tot_records;
		$data['page']  = $tot_pages;
	}
	
	return $data;
 	
}

/*
 * EUI :: _get_resource_query() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
function Records( $pages = 0 )
{
	$list_data_records = array();
	
	$list_data_records = $this -> setGlobalCompare();
	
	if( $pages ) 
		$this ->start = (($pages-1)*$this->perpage);
	else 
	{	
		$this ->start = 1;
	}
	
	return array_slice($list_data_records, $this ->start, $this -> perpage);
}



/*
 * EUI :: _get_resource_query() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
public function PageNumber() {
	return $this -> start;	
}



/*
 * EUI :: _get_resource_query() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */

public function _getCounterPage($CustomerNumber = 0, $CampaignId = 0 )
{

 $count = 0;
 
	$this ->db ->select('COUNT(a.CustomerId) as jumlah', FALSE);
	$this ->db ->from('t_gn_customer a');
	$this ->db ->where('a.CustomerNumber', $CustomerNumber);
	$this ->db ->where('a.CampaignId', $CampaignId);
	if( $rows = $this ->db->get()->result_first_assoc() ){
		$count = (INT)$rows['jumlah'];
	}	
	
	return $count;
} 


 
/*
 * EUI :: _get_resource_query() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */

public function setUserPrivilege( $asg = null )
{
  $callback = 0;
  
  if( (!is_null($asg)) 
	AND isset($asg['CustomerId'])  ) 
  {
		if( ($this -> URI->_get_post('UserPrivileges')) 
			AND ( $this -> URI->_get_post('UserId')) )
		{
			$USER_PRIVILEGE = (INT)$this->URI->_get_post('UserPrivileges');
			$USER_ATTRIBUTE = $this->M_SysUser->_get_detail_user($this->URI->_get_post('UserId'));
			
			// USER_ROOT 
			
			if( $USER_PRIVILEGE==USER_ROOT){
				$this->db->set('AssignAdmin', $USER_ATTRIBUTE['UserId']);
			}
			
			// USER_ADMIN
			
			if( $USER_PRIVILEGE==USER_ADMIN){
				$this->db->set('AssignAdmin', $USER_ATTRIBUTE['UserId']);
			}
			
			// USER_MANAGER
			
			if( $USER_PRIVILEGE==USER_MANAGER) {
				$this->db->set('AssignAdmin',$USER_ATTRIBUTE['admin_id']);
				$this->db->set('AssignAmgr',$USER_ATTRIBUTE['act_mgr']);
			}
			
			// USER_ACCOUNT_MANAGER
			
			if( $USER_PRIVILEGE==USER_ACCOUNT_MANAGER){
				$this->db->set('AssignAdmin',$USER_ATTRIBUTE['admin_id']);
				$this->db->set('AssignAmgr',$USER_ATTRIBUTE['act_mgr']);
				$this->db->set('AssignMgr', $USER_ATTRIBUTE['mgr_id']);	
			}
			
			// USER_SUPERVISOR
			
			if( $USER_PRIVILEGE==USER_SUPERVISOR)
			{
				$this->db->set('AssignAdmin',$USER_ATTRIBUTE['admin_id']);
				$this->db->set('AssignAmgr',$USER_ATTRIBUTE['act_mgr']);
				$this->db->set('AssignMgr', $USER_ATTRIBUTE['mgr_id']);	
				$this->db->set('AssignSpv', $USER_ATTRIBUTE['spv_id']);
			}
			
			// USER_LEADER
			
			if( $USER_PRIVILEGE==USER_LEADER) 
			{
				$this->db->set('AssignAdmin',$USER_ATTRIBUTE['admin_id']);
				$this->db->set('AssignAmgr',$USER_ATTRIBUTE['act_mgr']);
				$this->db->set('AssignMgr', $USER_ATTRIBUTE['mgr_id']);	
				$this->db->set('AssignSpv', $USER_ATTRIBUTE['spv_id']);
				$this->db->set('AssignLeader',$USER_ATTRIBUTE['tl_id']);
			}
			
			// USER_AGENT_OUTBOUND
			
			if($USER_PRIVILEGE==USER_AGENT_OUTBOUND) {
				$this->db->set('AssignAdmin',$USER_ATTRIBUTE['admin_id']);
				$this->db->set('AssignAmgr',$USER_ATTRIBUTE['act_mgr']);
				$this->db->set('AssignMgr', $USER_ATTRIBUTE['mgr_id']);	
				$this->db->set('AssignSpv', $USER_ATTRIBUTE['spv_id']);
				$this->db->set('AssignLeader',$USER_ATTRIBUTE['tl_id']);
				$this->db->set('AssignSelerId',$USER_ATTRIBUTE['UserId']);
			}
			
			$this->db->set('CustomerId',$asg['CustomerId']);
			$this->db->set('AssignDate',date('Y-m-d H:i:s'));
			$this->db->set('AssignMode', 'DIS');
			$this->db->insert('t_gn_assignment');
			
			if( $this->db->affected_rows() > 0 )
			{
				 $callback++;
			}
		}
  }
  
  return  $callback;
	
} 
 
/*
 * EUI :: _get_resource_query() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 
public function _setSaveByChecked( $_VAR_POST  = null )
{
 
$_conds = 0;
 
if( !is_null($_VAR_POST) )
{
  $BUILDS = $this->M_SetCampaign->getAttribute( $_VAR_POST['PARAM']['CampaignId'] );
  if( $BUILDS['DirectAction']== DUPLICATE )
  {
	foreach( $_VAR_POST['ID'] as $UX => $CustomerId ) 
	{
		$this->db->select('a.*, b.AssignAdmin ');
		$this->db->from('t_gn_customer a');
		$this->db->join('t_gn_assignment b','a.CustomerId = b.CustomerId', 'INNER');
		$this->db->where_in('a.CustomerId', $CustomerId );
		$this->db->where('a.CampaignId', $BUILDS['CampaignId']);
		
		/* processs data **/
			
		if( $result = $this -> db->get()->result_first_assoc()  )
		{
			$ins = 0;	
			foreach( $result as $field_name => $field_value ) 
			{
				if( !in_array($field_name, $this->filters)) {
						$this ->db->set($field_name, $result[$field_name]);
						$ins++;
					}
			}
				
			/** then process to data duplicate **/
			
			 $conds = $this ->_getCounterPage( $result['CustomerNumber'], $_VAR_POST['PARAM']['OutboundCampaignId'] );
			 $cmpid = (INT)$_VAR_POST['PARAM']['OutboundCampaignId'];
			 
			 if(($ins>0) AND ($cmpid>0) AND ($conds<1) )
			 {
				$this->db->set('CampaignId',$_VAR_POST['PARAM']['OutboundCampaignId']);
				$this->db->insert('t_gn_customer');	
				
				if( $this -> db -> affected_rows() > 0 ) 
				{
					if( $InsertID = $this ->db->insert_id())
					{
							if($boolean = $this -> setUserPrivilege(array('CustomerId' => $InsertID )) ) {
								$_conds++;
							}
						}
					 }	
				 }	
			 }
		 }
	}
 }
 
 return $_conds;
 
}



// _setSaveByAmount 

public function _setSaveByAmount( $p = null ) 
{

$_conds = 0;	
$a = $this->setGlobalCompare();

if( $b = ARRAY_SLICE($a, 0, $p['AssignData']) AND is_array($b) ) 
{
  if( $bs = $this->M_SetCampaign->getAttribute($p['CampaignId']) 
	AND ($bs['DirectAction']==DUPLICATE) )
  {
	foreach($b as $d => $e) 
	{
		$this->db->select('a.*, b.AssignAdmin ');
		$this->db->from('t_gn_customer a');
		$this->db->join('t_gn_assignment b','a.CustomerId = b.CustomerId', 'INNER');
		$this->db->where_in('a.CustomerId', $e['CustomerId']);
		$this->db->where('a.CampaignId', $bs['CampaignId']);
		
		/* processs data **/
		
		if( $r = $this -> db->get()->result_first_assoc()  )
		{
			$is = 0;	
			foreach( $r as $field_name => $field_value ) 
			{
			   if( !in_array($field_name, $this->filters))
				{ 
				  $this ->db->set($field_name, $r[$field_name]);
				  $is++;
				}
			}
							
			/** then process to data duplicate **/
					
			$cn = $this ->_getCounterPage( $r['CustomerNumber'], $p['OutboundCampaignId'] );
			$cm = (int)$p['OutboundCampaignId'];
			
			if(($is>0) && ($cm>0) && ($cn<1) )
			{
				$this->db->set('CampaignId',$p['OutboundCampaignId']);
				$this->db->insert('t_gn_customer');	
				
				if( $this -> db -> affected_rows() > 0 )
				{
					if( $InsertID = $this ->db->insert_id()) 
					{
						if($bool=$this->setUserPrivilege(array('CustomerId'=>$InsertID)))
							$_conds++;			
					}
				}	
			 }
		}
	}
 }
 
}
return $_conds;	

}

}