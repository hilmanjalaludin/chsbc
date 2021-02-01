<?php
/*
 * E.U.I 
 *
 
 * subject	: M_SetBenefit modul 
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Utility/
 */
 

if(!defined('ACTION_MANUAL')) define('ACTION_MANUAL',2);
if(!defined('ACTION_DIRECT')) define('ACTION_DIRECT',1);

class M_ModFormInbound extends EUI_Model
{
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function M_ModFormInbound()
{
	$this -> load -> meta('_cc_extension_agent');
	$this -> load -> model(
		array(	
			'M_SetCallResult','M_SysUser',
			'M_SetCampaign','M_SrcCustomerList',
			'M_ModDistribusi'
		));
}
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function NotInterest()
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
 
function Sale()
{
	$_a = array(); $_b = array();
	if( class_exists('M_SetCallResult'))
	{
		$_a = $this -> M_SetCallResult -> _getInterestSale(); 
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
	$this -> EUI_Page -> _setQuery
			(
			" SELECT a.CustomerId
				FROM t_gn_customer a
				INNER JOIN t_gn_assignment b on a.CustomerId=b.CustomerId 
				LEFT JOIN t_lk_gender e ON a.GenderId=e.GenderId
				LEFT JOIN t_lk_cardtype c ON a.CardTypeId=c.CardTypeId
				LEFT JOIN t_gn_campaign d on a.CampaignId=d.CampaignId 
				LEFT JOIN t_lk_callreason f on a.CallReasonId = f.CallReasonId 
				LEFT JOIN t_lk_outbound_goals g on d.OutboundGoalsId=g.OutboundGoalsId "); 
	
	
	// filtering key of the session 
	
	$flt =  "AND b.AssignAdmin is not null 
			 AND b.AssignMgr is not null 
			 AND b.AssignSpv is not null
			 AND ( a.CallReasonId NOT IN('". implode( "','", self::NotInterest()) ."') OR a.CallReasonId is null )	
			 AND ( f.CallReasonCategoryId NOT IN('". implode( "','", self::Sale()) ."') OR f.CallReasonCategoryId is null)
			 AND b.AssignBlock=0 
			 AND d.CampaignStatusFlag=1
			 AND g.Name='inbound'";
			 
	/* @ def : get data by user login identification **/
	
	if( $this -> EUI_Session -> _get_session('HandlingType')==USER_AGENT_INBOUND ){
		$flt.= " AND b.AssignSelerId='". $this -> EUI_Session -> _get_session('UserId') . "'";
	}			 
	if( $this -> EUI_Session -> _get_session('HandlingType')==USER_AGENT_OUTBOUND ){
		$flt.= " AND b.AssignSelerId='". $this -> EUI_Session -> _get_session('UserId') . "'";
	}
	
	if( $this -> EUI_Session -> _get_session('HandlingType')==USER_SUPERVISOR ){
		$flt.= " AND b.AssignSpv='". $this -> EUI_Session -> _get_session('UserId') . "'";
	}		
				 
	if( $this -> EUI_Session -> _get_session('HandlingType')==USER_MANAGER ){
		$flt.= " AND b.AssignAdmin='". $this -> EUI_Session -> _get_session('UserId') . "'";
	}	

	if( $this -> EUI_Session -> _get_session('HandlingType')==USER_ADMIN ){
		$flt.= " AND b.AssignMgr='" . $this -> EUI_Session -> _get_session('UserId') . "'";
	}		
	
	$this -> EUI_Page -> _setWhere( $flt ); 
	if($this -> EUI_Page -> _get_query()){
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
	$this -> EUI_Page->_setQuery
			(
			" SELECT 
				a.CustomerId, a.CustomerFirstName, e.Gender, a.CustomerDOB, c.CardTypeDesc,
				d.CampaignName, a.CustomerCity, CustomerUpdatedTs,a.GenderId ,
				IF(f.CallReasonDesc is null,'New',f.CallReasonDesc) as CallResult 
				FROM t_gn_customer a
				INNER JOIN t_gn_assignment b on a.CustomerId=b.CustomerId 
				LEFT JOIN t_lk_gender e ON a.GenderId=e.GenderId
				LEFT JOIN t_lk_cardtype c ON a.CardTypeId=c.CardTypeId
				LEFT JOIN t_gn_campaign d on a.CampaignId=d.CampaignId 
				LEFT JOIN t_lk_callreason f on a.CallReasonId = f.CallReasonId
				LEFT JOIN t_lk_outbound_goals g on d.OutboundGoalsId=g.OutboundGoalsId "); 
			
	$flt =  " AND b.AssignAdmin is not null 
				 AND b.AssignMgr is not null 
				 AND b.AssignSpv is not null
				 AND ( a.CallReasonId NOT IN('". implode( "','", self::NotInterest()) ."') OR a.CallReasonId is null )	
				 AND ( f.CallReasonCategoryId NOT IN('". implode( "','", self::Sale()) ."') OR f.CallReasonCategoryId is null)
				 AND b.AssignBlock=0 
				 AND d.CampaignStatusFlag=1
				 AND g.Name='inbound'";
	
	/* @ def : get data by user login identification **/
	
	if( $this -> EUI_Session -> _get_session('HandlingType')==USER_ADMIN ){
		$flt.= " AND b.AssignMgr='" . $this -> EUI_Session -> _get_session('UserId') . "'";
	}
				 
	if( $this -> EUI_Session -> _get_session('HandlingType')==USER_MANAGER ){
		$flt.= " AND b.AssignAdmin='". $this -> EUI_Session -> _get_session('UserId') . "'";
	}	
	
	if( $this -> EUI_Session -> _get_session('HandlingType')==USER_SUPERVISOR ){
		$flt.= " AND b.AssignSpv='". $this -> EUI_Session -> _get_session('UserId') . "'";
	}		
	
	if( $this -> EUI_Session -> _get_session('HandlingType')==USER_AGENT_INBOUND ){
		$flt.= " AND b.AssignSelerId='". $this -> EUI_Session -> _get_session('UserId') . "'";
	}	
	
	if( $this -> EUI_Session -> _get_session('HandlingType')==USER_AGENT_OUTBOUND ){
		$flt.= " AND b.AssignSelerId='". $this -> EUI_Session -> _get_session('UserId') . "'";
	}
	
	
	if( $this->URI->_get_have_post('key_words') ) 
	{
		$keywords = $this -> URI -> _get_post("keywords");
		
		$flt = " AND ( a.id LIKE '%$keywords%' 
							OR a.ext_number LIKE '%$keywords%' 
							OR b.set_value LIKE '%$keywords%' 
							OR a.ext_desc LIKE '%$keywords%'  
							OR a.ext_type LIKE '%$keywords%' 
							OR a.ext_status LIKE '%$keywords%' 
							OR a.ext_location LIKE '%$keywords%' 
						   )";
	}				
			
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
 
function _getGenderId()
{
  $_conds = array();
  $sql = " SELECT a.GenderId, a.Gender FROM  t_lk_gender a";
  $qry = $this -> db -> query($sql);
  if( !$qry -> EOF() )
  {
	foreach( $qry -> result_assoc() as $rows ) 
	{
		$_conds[$rows['GenderId']] = $rows['Gender'];
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
 
function _getCardType()
{
  $_conds = array();
  $sql = " SELECT a.CardTypeId, a.CardTypeDesc FROM t_lk_cardtype  a WHERE a.CardTypeFlag=1";
  $qry = $this -> db -> query($sql);
  if( !$qry -> EOF() )
  {
	foreach( $qry -> result_assoc() as $rows ) 
	{
		$_conds[$rows['CardTypeId']] = $rows['CardTypeDesc'];
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
 
function _get_data_template()
{
	$data_template = $this -> _cc_extension_agent -> _get_meta_colums();
 	if( $data_template )
	{
		return $data_template;
	}
} 
 
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function _cti_extension_upload( $data = null )
 {
	$_totals = 0;
	$_conds = false;
	if( !is_null( $data) )
	{
		if($this -> URI -> _get_post('mode') =='truncate') //empty table if truncate mode  
			$this -> db -> truncate( $this -> _cc_extension_agent-> _get_meta_index() );
			
		// then request 
		
		foreach( $data as $rows ) 
		{
			if( $this -> db -> insert( 
				$this -> _cc_extension_agent-> _get_meta_index(),
				$rows
			)){
				$_totals+=1;
			}
		}
		
		if( $_totals > 1)
			$_conds = true;
		
	}
	
	return $_conds;	
 }


/*
 * @ def 		: __setDirectOutbound
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _setDirectOutbound( $d=array() )
 {
	$_conds = 0;
	
	if(!defined('DIRECT')) define('DIRECT',1);
	if(!defined('DUPLICATE')) define('DUPLICATE',1);
	if(!defined('REPLACE')) define('REPLACE',2);
	
	$_DataInsert = array();
	
	if( (isset($d['Campaign'])) AND (isset($d['UserData']))
		AND (isset($d['Customer'])) AND (count($d['Customer'])>0))
	{
		/* filter not include */
		
		$_array_filter = array('CustomerId','CallReasonId','CampaignId', 'SellerId');
		
		/* model settup DirectAction insert data data */
		
		if( $d['Campaign']['DirectAction']== DUPLICATE ) 
		{
			foreach( $d['Customer'] as $fieldName => $values )
			{
				if( ($values!='') AND !in_array( $fieldName, $_array_filter ) )
				{
					$_DataInsert[$fieldName] = $values;	
					$_DataInsert['CampaignId'] = $d['Campaign']['AvailCampaignId'];
				}
			}
			
			$_last_move = $this -> db -> insert("t_gn_customer",$_DataInsert);
			if( $_last_move )
			{
				$CustomerId = $this -> db -> insert_id();
				
				/* insert to assign data  */
				
				if( $this -> db->insert('t_gn_assignment',
					array
					(
						'CustomerId' 	=> $CustomerId, 
						'AssignDate' 	=> date('Y-m-d H:i:s'),
						'AssignAdmin' 	=> $d['UserData']['admin_id'],
						'AssignMode' 	=> 'DIS'
					)
				)){
					/* insert to log data  */
					
					if( $this -> db -> insert("t_gn_direct_campaign",
						array
						(
							'DirectCampaignFrom' => $d['Campaign']['CampaignId'], 
							'DirectCampaignTo' 	 => $d['Campaign']['AvailCampaignId'],  
							'CustomerIdOld' 	 => $d['Customer']['CustomerId'], 
							'SellerId' 			 => $d['UserData']['UserId'], 
							'CreateByUserId' 	 => $d['UserData']['UserId'], 
							'CallReasonId'		 => $d['Customer']['CallReasonId'], 
							'CustomerIdNew' 	 => $CustomerId, 
							'CreateDateTs' 		 => date('Y-m-d H:i:s'),
							'DirectAction' 		 => DUPLICATE,
							'DirectMethode' 	 => DIRECT
						)
					)){
						$_conds++;
					}
				}
			}
		} 
		
		// model settup DirectAction replace Udpate Campaign
		
		else if( $d['Campaign']['DirectAction']== REPLACE )
		{
			$_ml = array(); $_update = array(); $_where = array(); 
			
				$_ml['DirectCampaignFrom'] 	= $d['Campaign']['CampaignId'];
				$_ml['DirectCampaignTo']   	= $d['Campaign']['AvailCampaignId'];
				$_ml['CustomerIdOld']	 	= $d['Customer']['CustomerId']; 
				$_ml['SellerId']			= $d['UserData']['UserId'];
				$_ml['CreateByUserId'] 	 	= $d['UserData']['UserId']; 
				$_ml['CustomerIdNew'] 	 	= $d['Customer']['CustomerId'];
				$_ml['CallReasonId']		= $d['Customer']['CallReasonId'];
				$_ml['CreateDateTs']		= date('Y-m-d H:i:s');
				$_ml['DirectAction'] 		= REPLACE;
				$_ml['DirectMethode'] 	 	= DIRECT;
				
			// update customer 
			
				foreach( $d['Customer'] as $fieldName => $values )
				{
					if( ($values!='') 
						AND !in_array( $fieldName, $_array_filter ) ) 
					{
						$this->db->set($fieldName,$values,TRUE);
						$this->db->set('CallReasonId','NULL',FALSE);
						$this->db->set('SellerId','NULL',FALSE);
						$this->db->set('CampaignId',$d['Campaign']['AvailCampaignId'],true);
					}
					
					if( ($values!='') 
						AND in_array( $fieldName, $_array_filter ) ) 
					{
						$this->db->where($fieldName,$values,FALSE);
					}
				}
				
				
				$this -> db -> update('t_gn_customer'); 
				if( $this->db->affected_rows() > 0 )
				{
					// langsung insert ke t_gn_direct_campaign
					if( $this -> db ->insert('t_gn_direct_campaign', $_ml) )
					{
						$_conds++;
					}
					
					$this->db->set('AssignMgr','NULL',FALSE);
					$this->db->set('AssignSpv','NULL',FALSE);
					$this->db->set('AssignSelerId','NULL',FALSE);
					$this->db->set('AssignAdmin',$d['UserData']['admin_id'],FALSE);
					$this->db->set('AssignMode','DIS',TRUE);
					$this->db->set('AssignDate',date('Y-m-d H:i:s'),TRUE);
					$this->db->where('CustomerId',$d['Customer']['CustomerId']);
					$this->db->update('t_gn_assignment');
					
					if( $this->db->affected_rows() > 0)
					{
						$_conds++;
						if( $this -> db ->insert('t_gn_direct_campaign', $_ml) )
						{
							$_conds++;
						}
					}
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
 
 function _getDIDNumber( $DIDdirection=0 )
 {
	$_conds = array();
	
	$this -> db -> select('b.CampaignId, b.CampaignName');
	$this -> db -> from('t_gn_campaign_transaction a');
	$this -> db -> join('t_gn_campaign b', 'a.CampaignId=b.CampaignId','LEFT');
	$this -> db -> join('t_lk_campaign_did c', 'a.DIDCampaign=c.Id','INNER');
	$this -> db -> where('c.DIDDirection', $DIDdirection);
	
	if( $rows = $this -> db ->get() -> result_first_assoc() )
	{
		$_conds = array(
			'CampaignId' => $rows['CampaignId'],
			'CampaignName' => $rows['CampaignName']
		);
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
 
function _setSaveInbound( $Customer = null)
{
	$_conds = false;
	if(isset($Customer['CampaignId']) )
	{
		
		if( $this -> db ->insert("t_gn_customer",$Customer ) )
		{
			$CustomerId  = $this->db->insert_id();
			$Users = $this->M_SysUser ->_get_detail_user($Customer['SellerId']);
			
			if( is_array($Users))
			{
				$this->db->set('CustomerId',$CustomerId);
				$this->db->set('AssignAmgr',$Users['act_mgr']);
				$this->db->set('AssignMgr',$Users['mgr_id']);
				$this->db->set('AssignSpv',$Users['spv_id']);
				$this->db->set('AssignLeader',$Users['tl_id']);
				$this->db->set('AssignSelerId',$Users['UserId']);
				$this->db->set('AssignAdmin',$Users['admin_id']);
				$this->db->set('AssignMode','INC');
				$this->db->set('AssignDate',date('Y-m-d H:i:s'));
				$this->db->insert('t_gn_assignment');
				
				if( $this ->db ->affected_rows() > 0 ) 
				{
					$CampaignData = $this->M_SetCampaign->getAttribute($Customer['CampaignId']);
					$CustomerData = $this->M_SrcCustomerList->_getOriginalData($CustomerId);
					
					if(($CampaignData['DirectMethod']== ACTION_DIRECT))
					{
						$_conds = self::_setDirectOutbound(array('Campaign' => $CampaignData, 'Customer' => $CustomerData, 'UserData' => $Users) );
					}	
					
					$_conds=true;
				}
			}
		} 	
	}
	
	return $_conds;
}
 
}

?>