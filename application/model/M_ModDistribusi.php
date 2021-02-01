<?php

//ini_set("memory_limit","1024M");
//set_time_limit(3600);


/*
 * E.U.I 
 *
 
 * subject	: get SetCampaign modul 
 * 			  extends under EUI_Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysuser/
 */
 
 
class M_ModDistribusi extends EUI_Model
{

 private static $params = null;

 private static $Instance   = null; 
 public static function &Instance()
{
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
}

/*
 * EUI :: _setDistribusi () 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
 
 function M_ModDistribusi(){
	$this->load->model(array('M_SysUser'));
 }
 
/*
 * EUI :: _setDistribusi () 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	 
  
public function _setDistribusi( $params = null, $action = null )
{
	$_conds = 0;
	if( !is_null($params)) self::$params = $params;
	if(!is_null($action) ) 
	{
		switch($action)
		{
			case 'saveByAmount' : 
				$_conds =& self::SaveByAmount();  
			break;  

			case 'saveByAmountATM' : 
				$_conds =& self::SaveByAmountATM($params['atm']);  
			break;  
			
			case 'saveByChecked' : 
				$_conds =& self::SaveByChecked(); 
			break;	

			case 'SaveByCheckedATM' : 
				$_conds =& self::SaveByCheckedATM($params['atm']); 
			break;	
			
			case 'ManualDistribusi' :
				$_conds =& self::ManualDistribusi();  
			break;
			
			case 'AutomaticDistribusi' : 
				$_conds =& self::AutomaticDistribusi();  
			break;	
		}
	}
	
	return $_conds;
}


 
/*
 * EUI :: _setReAssigment () 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	 
  
public function _setReAssigment( $params = null, $action = null )
{
	$_conds = 0;
	if( !is_null($params)) self::$params = $params;
	if(!is_null($action) ) 
	{
		switch($action)
		{
			case 'ManualReassignment' :
				$_conds =& self::ManualReassignment();  
			break;
			
			case 'AutomaticReassignment' : 
				$_conds =& self::AutomaticReassignment();  
			break;	
		}
	}
	
	return $_conds;
}

/*
 * EUI :: _get_bucket_list_sintax() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
 
private function AutomaticReassignment()
{

 $UserData = array();
 if(( count(self::$params['UserSelectId'])!=0) 
    AND (self::$params['AssignData']!='') 
	AND (self::$params['AssignData']!=0))
  {
	$QtyPerUser = (INT)(self::$params['AssignData']/count(self::$params['UserSelectId'])); 
	if( $QtyPerUser > 0 )
	{
		$start = 0;
		foreach( self::$params['UserSelectId'] as $k => $vUser )
		{
			$start_data = (($start)*($QtyPerUser));
			$limit_data = (($QtyPerUser)-1);
			$post_data = $start_data;
			$limit_assign = 0;
			
			/* @ def : set on limit data **/
			
			while(true) 
			{
				$UserData[$vUser][] = self::$params['Data'][$post_data]; 
				if(($limit_assign==$limit_data)) break;
					$post_data+=1;	
					$limit_assign+=1;
			}
			
			$start++;	
		}
	}
  }
  
  /*
   * @ def 	   : action start distribusi data 
   * -----------------------------------------------
   *
   * @ param   : then will update && save to log 
   * @ aksess  : look here 
   */
 //  print_r($UserData);

  $_success = 0;
  
  if( is_array($UserData) AND count($UserData) > 0 )
  {
	foreach($UserData as $UserId => $Datas )
	{	
		foreach($Datas as $key => $AssignId )
		{
			$UserDetail = $this -> M_SysUser -> _getUserDetail($UserId);
			if( $UserDetail )
			{
				if( self::$params['UserLevel']==USER_ACCOUNT_MANAGER ){
					$_update = array
					(
						'AssignAmgr'  => $UserDetail['act_mgr'], 
						'AssignMode' => 'MOV', 
						'AssignDate' => date('Y-m-d H:i:s')
					);
				}
				
				if( self::$params['UserLevel']==USER_MANAGER ){
					$_update = array
					(
						'AssignMgr'  => $UserDetail['mgr_id'], 
						'AssignAmgr' => $UserDetail['act_mgr'], 
						'AssignMode' => 'MOV', 
						'AssignDate' => date('Y-m-d H:i:s')
					);
				}
				
				if( self::$params['UserLevel']==USER_SUPERVISOR ){
					$_update = array
					(
						'AssignMgr' 	=> $UserDetail['mgr_id'], 
						'AssignSpv' 	=> $UserDetail['spv_id'],
						'AssignMode' 	=> 'MOV', 
						'AssignDate' 	=> date('Y-m-d H:i:s')
					);
				}
				
				if( self::$params['UserLevel']==USER_LEADER ){
					$_update = array
					(
						'AssignMgr' 	=> $UserDetail['mgr_id'], 
						'AssignSpv' 	=> $UserDetail['spv_id'],
						'AssignLeader' 	=> $UserDetail['tl_id'],
						'AssignMode' 	=> 'MOV', 
						'AssignDate' 	=> date('Y-m-d H:i:s')
					);
				}
				
				
				if( self::$params['UserLevel']==USER_AGENT_OUTBOUND ){
					$_update = array
					(
						'AssignMgr' 	=> $UserDetail['mgr_id'], 
						'AssignSpv' 	=> $UserDetail['spv_id'],
						'AssignLeader' 	=> $UserDetail['tl_id'],
						'AssignSelerId' => $UserDetail['UserId'],
						'AssignMode' 	=> 'MOV', 
						'AssignDate' 	=> date('Y-m-d H:i:s')
					);
				}
						
				if( self::$params['UserLevel']==USER_AGENT_INBOUND ){
					$_update = array
					(
						'AssignMgr' 	=> $UserDetail['mgr_id'], 
						'AssignSpv' 	=> $UserDetail['spv_id'],
						'AssignSelerId' => $UserDetail['UserId'],
						'AssignLeader' 	=> $UserDetail['tl_id'],
						'AssignMode' 	=> 'MOV', 
						'AssignDate' 	=> date('Y-m-d H:i:s')
					);
				}
			}
			
			/* @ def : update assignment data **/
			
				if( $this -> db -> update('t_gn_assignment',$_update, 
					array('AssignId' => $AssignId)
				))
				{
					if( self::_setSaveLog( 
						array('AssignId'=>$AssignId,'UserId'=> $UserDetail['UserId'])
					))
					{ 
						$_success++;
					}	
				}
		}
	}	
  }
  
  return array( 
	'SizeData'  => $_success, 
	'SizeUsers' => count(self::$params['UserSelectId'])
  );
  
}

/*
 * EUI :: _get_bucket_list_sintax() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	

private function ManualReassignment()
{
	$_success = 0;  $UserData = array();
	
	//print_r(self::$params);
	
	if( is_array( self::$params['UserSizeData']) 
		AND !is_null(self::$params['UserSizeData']))
	{
		foreach( self::$params['UserSizeData'] as $key => $rows )
		{
			$array_user_id[$key] = $rows['userid']; 
			$array_size_id[$key] = $rows['size'];	
		}
				
		/* @ def : urutkan size_data secra ASC ex: 0,1,2,3,4 */
		$array_multisort = array_multisort($array_size_id, SORT_ASC, $array_user_id, SORT_ASC, self::$params['UserSizeData']); 
		if( $array_multisort )
		{
			$QtyDataAsg = self::$params['Data'];
			$start_post= 0;
				
			foreach(self::$params['UserSizeData'] as $rows )
			{
				if( $start_post==0 )
				{
					$start =0;
					$post_size = ($rows['size']-1);
					while(true)
					{
						$UserData[$rows['userid']][] = $QtyDataAsg[$start]; 
						if( $start==$post_size ) BREAK;
							$start+=1;
					}
				}	
				else
				{
					$post_size = ($rows['size']+$start);
					$start = $start+1;
					while(true) 
					{
						$UserData[$rows['userid']][] = $QtyDataAsg[$start]; 
						if( $start==$post_size ) BREAK;
						$start+=1;
					}
				}
						
				$start_post+=1;
			}	
		/* @ def 	   : action start distribusi data 
		 * -----------------------------------------------
		 *
		 * @ param   : then will update && save to log 
		 * @ aksess  : look here 
		 */
		  
		if( is_array($UserData) AND count($UserData) > 0 )
		{
			foreach($UserData as $UserId => $Datas )
			{	
				foreach($Datas as $key => $AssignId )
				{
					$UserDetail = $this -> M_SysUser -> _getUserDetail($UserId);
					if( $UserDetail )
					{
						if( self::$params['UserLevel']==USER_ACCOUNT_MANAGER){
							$_update = array (
								'AssignMgr'  => $UserDetail['mgr_id'], 
								'AssignAmgr' => $UserDetail['act_mgr'], 
								'AssignMode' => 'MOV', 
								'AssignDate' => date('Y-m-d H:i:s')
							);
						}
						
						if( self::$params['UserLevel']==USER_MANAGER ){
							$_update = array
							(
								'AssignMgr'  => $UserDetail['mgr_id'], 
								'AssignMode' => 'MOV', 
								'AssignDate' => date('Y-m-d H:i:s')
							);
						}
						
						if( self::$params['UserLevel']==USER_ADMIN ){
							$_update = array
							(
								'AssignAdmin'  => $UserDetail['admin_id'], 
								'AssignMode' => 'MOV', 
								'AssignDate' => date('Y-m-d H:i:s')
							);
						}
						
						if( self::$params['UserLevel']==USER_SUPERVISOR ){
							$_update = array
							(
								'AssignMgr' 	=> $UserDetail['mgr_id'], 
								'AssignSpv' 	=> $UserDetail['spv_id'],
								'AssignMode' 	=> 'MOV', 
								'AssignDate' 	=> date('Y-m-d H:i:s')
							);
						}
						
						if( self::$params['UserLevel']==USER_LEADER ){
							$_update = array
							(
								'AssignMgr' 	=> $UserDetail['mgr_id'], 
								'AssignSpv' 	=> $UserDetail['spv_id'],
								'AssignLeader' 	=> $UserDetail['tl_id'],
								'AssignMode' 	=> 'MOV', 
								'AssignDate' 	=> date('Y-m-d H:i:s')
							);
						}
						
						if( self::$params['UserLevel']==USER_AGENT_OUTBOUND ){
							$_update = array
							(
								
								'AssignMgr' 	=> $UserDetail['mgr_id'], 
								'AssignSpv' 	=> $UserDetail['spv_id'],
								'AssignLeader' 	=> $UserDetail['tl_id'],
								'AssignSelerId' => $UserDetail['UserId'],
								'AssignMode' 	=> 'MOV', 
								'AssignDate' 	=> date('Y-m-d H:i:s')
							);
						}
						
						if( self::$params['UserLevel']==USER_AGENT_INBOUND ){
							$_update = array
							(
								'AssignMgr' 	=> $UserDetail['mgr_id'], 
								'AssignSpv' 	=> $UserDetail['spv_id'],
								'AssignLeader' 	=> $UserDetail['tl_id'],
								'AssignSelerId' => $UserDetail['UserId'],
								'AssignMode' 	=> 'MOV', 
								'AssignDate' 	=> date('Y-m-d H:i:s')
							);
						}
					}
					
					/* @ def : update assignment data **/
					
						if( $this -> db -> update('t_gn_assignment',$_update, 
							array('AssignId' => $AssignId)
						))
						{
							if( self::_setSaveLog( 
								array('AssignId'=>$AssignId,'UserId'=> $UserDetail['UserId'])
							))
							{ 
								$_success++;
							}	
						}
				}
			}	
		}}
	}
	
	return array( 
		'SizeData' => $_success, 
		'SizeUsers' => count(self::$params['UserSizeData']) 
	);
}


/*
 * EUI :: _get_bucket_list_sintax() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
  
  private function _get_bucket_list_sintax()
 {
		
  $arr_data = array();
	
// -------- call Object ----------------------------------------------

 $out = new EUI_Object( self::$params );
 if( !$out->fetch_ready() ){
	return FALSE;	
 }	

 $limit_source = (int)$out->get_value('AmountAssign'); 
 if( $limit_source == 0  ){
	return FALSE;
 }	 

  // ---------- next process -----------------------------
 
	$this->db->reset_select();
	$this->db->select('*');
	$this->db->from('t_gn_bucket_customers');
	
// ------- on filter File Name ------------------
	
	if( ($out->get_value('FilenameId','trim')) 
		AND ($out->get_value('FilenameId','trim')!='0') )
	{
		$this->db->where('FTP_UploadId',$out->get_value('FilenameId') );
	}
	
// ------- on filter status ------------------
	
	 if( !is_null( $out->get_value('AssignStatus') ) )
	{
		$this->db->where('AssignCampaign', $out->get_value('AssignStatus') );
	}
	
 // ------- on filter date ------------------
	
	if( $out->get_value('StartDate') 
		AND $out->get_value('EndDate') )
	{
		$this -> db -> where("CustomerUploadedTs >='{$out->get_value('StartDate', 'StartDate')}'", "", FALSE);
		$this -> db -> where("CustomerUploadedTs <='{$out->get_value('EndDate', 'EndDate')}'", "", FALSE);
	}	
	
	$this->db->limit($limit_source);
	
// --- get source data ---------------------------------------------
	
	$rs = $this->db->get();
	if( $rs->num_rows() > 0 )
		foreach( $rs->result_assoc() as $rows )
	{
		$arr_data[$rows['CustomerId']]= $rows;
	}
	
	return (array)$arr_data;
 } 
 
/*
 * EUI :: saveByAmount () 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
  
function _get_field_customers()
{ 
	$field = $this->db->list_fields('t_gn_customer');
	foreach( $field as $k => $v )
	{
		$_conds[$v] = $v;
	}
	
	return $_conds;
}		


		
/*
 * EUI :: saveByAmount () 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
 private function _select_count_data($array = null )
 {
	$_totals = 0;
	if(!is_null($array))
	{
		$this ->db ->select('CustomerId');
		$this ->db ->from('t_gn_customer');
		$this ->db ->where('CustomerNumber',$array['CustomerNumber']);
		$this ->db ->where('CampaignId',$array['CampaignId']);
		
		$i = 1;
		foreach($this ->db ->get() -> result_assoc() as $rows )
		{
			$_conds[$i] = (INT)$rows['CustomerId'];
			$i++;
		}
		
		$_totals = count($_conds);
	}
	
	return $_totals;
	
 }
  
 
/*
 * EUI :: saveByAmount () 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
 
private function _get_bucket_list_checked()
{
	$_bucket = array();
	if(!is_null(self::$params))
	{
		$this ->db ->select('*');
		$this ->db ->from('t_gn_bucket_customers');
		$this ->db ->where_in('CustomerId',self::$params['BucketId']);
		
		foreach( $this -> db -> get() -> result_assoc() as $rows)
		{
			$_bucket[$rows['CustomerId']]= $rows;
		}
	}
	
	return $_bucket;
}

/*
 * EUI :: saveByAmount () 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	

private function SaveByCheckedATM($atm='')
{
  
  $UserDetail = $this -> M_SysUser -> _getUserDetail($atm);

  $_totals = 0;	$_duplicate = 0;
  if( !is_null(self::$params) )
  {
	$_data_customer =& $this->_get_field_customers();
	$_data_bucket =& $this->_get_bucket_list_checked();
	
	if( is_array($_data_bucket) )
	{
		/* 
		* @ def 	: masp columns to data customer 
		* ------------------------------------------
		*
		* @ param  : no comment 
		* @ aksess : try again
		*/
		
		$_list_data = null; $_bucket_id = null;
		$i = 1;
		foreach( $_data_bucket as $k => $rows ) 
		{
			foreach($rows as $keys => $values ) 
			{
				if( in_array($keys,$_data_customer) 
					AND $keys!='CustomerId' )
				{
					$_list_data[$i][$keys] = $values;
				}
				$_list_data[$i]['CampaignId'] = self::$params['CampaignId']; 
				$_bucket_id[$i]['BucketId'] = $rows['CustomerId']; 
			}
			$i++;
		}
		
		 /* 
		* @ def 	: masp columns to data customer 
		* ------------------------------------------
		*
		* @ param  : no comment 
		* @ aksess : try again
		*/
		if( count($_list_data)> 0 AND !is_null($_list_data))
		{
			foreach($_list_data as $k => $_insert_data )
			{
				if( $this->_select_count_data( 
					array
					(
						'CustomerNumber' => $_insert_data['CustomerNumber'] ,
						'CampaignId' => $_insert_data['CampaignId'] 
					))!=TRUE)
				{ 
					if( $this -> db -> insert('t_gn_customer', $_insert_data) )
					{
						$insertId = $this->db->insert_id();
						if( $insertId )
						{
								$this -> db -> insert('t_gn_assignment',
								array(
									'CustomerId'=> $insertId, 
									'AssignAdmin'=> $this -> EUI_Session -> _get_session('UserId'),
									'AssignAmgr' => $UserDetail['act_mgr'], 
									'AssignMgr' 	=> $UserDetail['mgr_id'], 
									'AssignSpv' 	=> $UserDetail['spv_id'],
									'AssignMode' 	=> 'DIS', 
									'AssignDate' 	=> date('Y-m-d H:i:s')
								));

						}
						
						if( $this -> db -> update('t_gn_bucket_customers', 
							array('AssignCampaign'=>1),
							array('CustomerId' => $_bucket_id[$k]['BucketId'])
						))
						{
							$this -> db -> insert('t_gn_bucket_assigment', 
							array
							(
								'CustomerBucketId' => $_bucket_id[$k]['BucketId'],
								'CustomerCampaignId' => $_insert_data['CampaignId'],
								'CreatedDateTs' => date('Y-m-d H:i:s'),
								'CreateUserId' => $this -> EUI_Session->_get_session('UserId')
							));
							
							$_totals++;
						}
					}
				}
				else{
					$_duplicate++;
				}
			}
		}
	}
  }
    // return data in array 
  
  return array
  (
	'_success' => $_totals, 
	'_duplicate'=> $_duplicate
  );
}


// ---------------------------------------------------------------------------
/*
 * @ package : _set_row_event_upload_id row 
 */ 
 
 
 protected function _set_row_event_upload( $out = null  )
{
	
 if( !$out->fetch_ready() )	{
	return FALSE;
 }	 
 $this->db->reset_write();
 $this->db->where("CustomerNumber", $out->get_value('CustomerNumber'));
 $this->db->where("CampaignId", $out->get_value('CampaignId','intval'));
 $this->db->where("UploadId", 0, false);
 $this->db->set("UploadId", $out->get_value('UploadId','intval'));
 if( $this->db->update("t_gn_customer") ){
	 return TRUE;
 } 

 return (bool)FALSE;
 
} 

// ---------------------------------------------------------------------------
/*
 * @ package : selected row 
 */ 
 
 private function SaveByChecked()
{
  
  $_totals = 0;	$_duplicate = 0;
  if( !is_null(self::$params) )
  {
	$_data_customer =& $this->_get_field_customers();
	$_data_bucket =& $this->_get_bucket_list_checked();
	
	if( is_array($_data_bucket) )
	{
		/* 
		* @ def 	: masp columns to data customer 
		* ------------------------------------------
		*
		* @ param  : no comment 
		* @ aksess : try again
		*/
		
		$_list_data = null; $_bucket_id = null;
		$i = 1;
		foreach( $_data_bucket as $k => $rows ) 
		{
			foreach($rows as $keys => $values ) 
			{
				if( in_array($keys,$_data_customer) AND $keys!='CustomerId' ) {
					$_list_data[$i][$keys] = $values;
				}
				
			// ---------- in arraya execption --------------------------------	
				if( in_array( $keys, array('FTP_UploadId')) ) {
					$_list_data[$i]['UploadId'] = $values; 
				}	
				
				$_list_data[$i]['CampaignId'] = self::$params['CampaignId']; 
				$_bucket_id[$i]['BucketId'] = $rows['CustomerId']; 
			}
			$i++;
		}
		
		 /* 
		* @ def 	: masp columns to data customer 
		* ------------------------------------------
		*
		* @ param  : no comment 
		* @ aksess : try again
		*/
		
		if( count($_list_data)> 0 AND !is_null($_list_data))
		{
			foreach($_list_data as $k => $_insert_data )
			{
				
			// ---------- on duplikasi ---------------------------------------------
				$out = new EUI_Object($_insert_data);
				$duplicate = $this->_select_count_data(array
				( 
					'CustomerNumber' => $out->get_value('CustomerNumber'), 
					'CampaignId' => $out->get_value('CampaignId','intval') 
				));
			
			// ---------- on duplikasi ---------------------------------------------
			// if not found then set to data customer 
			
				if( $duplicate == FALSE )
				{ 
					if( $this->db->insert('t_gn_customer', $_insert_data) )
					{
						$insertId = $this->db->insert_id();
						if( $insertId )
						{
								$this -> db -> insert('t_gn_assignment',
								array(
									'CustomerId'=> $insertId, 
									'AssignAdmin'=> $this -> EUI_Session -> _get_session('UserId')
								));
						}
						
						if( $this -> db -> update('t_gn_bucket_customers', 
							array('AssignCampaign'=>1),
							array('CustomerId' => $_bucket_id[$k]['BucketId'])
						))
						{
							$this -> db -> insert('t_gn_bucket_assigment', 
							array
							(
								'CustomerBucketId' => $_bucket_id[$k]['BucketId'],
								'CustomerCampaignId' => $_insert_data['CampaignId'],
								'CreatedDateTs' => date('Y-m-d H:i:s'),
								'CreateUserId' => $this -> EUI_Session->_get_session('UserId')
							));
							
							$_totals++;
						}
					}
				}
				else{
				// --- update upload ID  ------------------------------------------------------>	
					$this->_set_row_event_upload( $out );
					$_duplicate++;
				}
			}
		}
	}
  }
  
   
  // return data in array 
  
  return array
  (
	'_success' => $_totals, 
	'_duplicate'=> $_duplicate
  );
} 

 
/*
 * EUI :: saveByAmount () 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
  
private function SaveByAmount()
{
  $_totals = 0;	$_duplicate = 0;
  
  if( !is_null(self::$params) )
  {
	$_data_customer =& $this->_get_field_customers();
	$_data_bucket =& $this->_get_bucket_list_sintax();
	
	if( is_array($_data_bucket) ){
		
	
	   /* 
		* @ def 	: masp columns to data customer 
		* ------------------------------------------
		*
		* @ param  : no comment 
		* @ aksess : try again
		*/
		
		$_list_data = null; $_bucket_id = null;
		$i = 1;
		foreach( $_data_bucket as $k => $rows ) 
		{
			foreach($rows as $keys => $values ) 
			{
				if( in_array($keys,$_data_customer) 
					AND !in_array( $keys, array('CustomerId') )) 
				{
					$_list_data[$i][$keys] = $values;
				}
				
			// --- on execption data --------------------	
				if( in_array( $keys, array('FTP_UploadId')) ) {
					$_list_data[$i]['UploadId'] = $values; 
				}	
				
				
				$_list_data[$i]['CampaignId'] = self::$params['CampaignId']; 
				$_bucket_id[$i]['BucketId'] = $rows['CustomerId']; 
			}
			$i++;
		}
		
	   /* 
		* @ def 	: masp columns to data customer 
		* ------------------------------------------
		*
		* @ param  : no comment 
		* @ aksess : try again
		*/
		if( count($_list_data)> 0 AND !is_null($_list_data))
		{
			foreach($_list_data as $k => $_insert_data )
			{
				// ---------- on duplikasi ---------------------------------------------
				
				$out = new EUI_Object($_insert_data);
				$duplicate = $this->_select_count_data(array ( 
					'CustomerNumber' => $out->get_value('CustomerNumber'), 
					'CampaignId' => $out->get_value('CampaignId','intval') 
				));
				
				if( $duplicate ==  FALSE )
				{ 
					if( $this->db->insert('t_gn_customer', $_insert_data) )
					{
						$insertId = $this->db->insert_id();
						if( $insertId )
						{
								$this -> db -> insert('t_gn_assignment',
								array(
									'CustomerId'=> $insertId, 
									'AssignAdmin'=> $this -> EUI_Session -> _get_session('UserId')
								));
						}
						
						if( $this->db->update('t_gn_bucket_customers', 
							array('AssignCampaign'=>1),
							array('CustomerId' => $_bucket_id[$k]['BucketId'])
						))
						{
							$this->db->insert('t_gn_bucket_assigment', 
							array
							(
								'CustomerBucketId' => $_bucket_id[$k]['BucketId'],
								'CustomerCampaignId' => $_insert_data['CampaignId'],
								'CreatedDateTs' => date('Y-m-d H:i:s'),
								'CreateUserId' => $this -> EUI_Session->_get_session('UserId')
							));
							
							$_totals++;
						}
					}
				}
				else{
				// -------------- update data here ---------------------	
					$this->_set_row_event_upload( $out );
					$_duplicate++;
				}
			}
		}
	}	
  }
  
  // return data in array 
  
  return array
  (
	'_success' => $_totals, 
	'_duplicate'=> $_duplicate
  );
  
}


private function SaveByAmountATM($atm='')
{
	$UserDetail = $this -> M_SysUser -> _getUserDetail($atm);

  $_totals = 0;	$_duplicate = 0;
  
  if( !is_null(self::$params) )
  {
	$_data_customer =& $this->_get_field_customers();
	$_data_bucket =& $this->_get_bucket_list_sintax();
	if( is_array($_data_bucket) )
	{
	
	   /* 
		* @ def 	: masp columns to data customer 
		* ------------------------------------------
		*
		* @ param  : no comment 
		* @ aksess : try again
		*/
		
		$_list_data = null; $_bucket_id = null;
		$i = 1;
		foreach( $_data_bucket as $k => $rows ) 
		{
			foreach($rows as $keys => $values ) 
			{
				if( in_array($keys,$_data_customer) 
					AND $keys!='CustomerId' )
				{
					$_list_data[$i][$keys] = $values;
				}
				$_list_data[$i]['CampaignId'] = self::$params['CampaignId']; 
				$_bucket_id[$i]['BucketId'] = $rows['CustomerId']; 
			}
			$i++;
		}
		
	   /* 
		* @ def 	: masp columns to data customer 
		* ------------------------------------------
		*
		* @ param  : no comment 
		* @ aksess : try again
		*/
		if( count($_list_data)> 0 AND !is_null($_list_data))
		{
			foreach($_list_data as $k => $_insert_data )
			{
				if( $this->_select_count_data( 
					array
					(
						'CustomerNumber' => $_insert_data['CustomerNumber'] ,
						'CampaignId' => $_insert_data['CampaignId'] 
					))!=TRUE)
				{ 
					if( $this -> db -> insert('t_gn_customer', $_insert_data) )
					{
						$insertId = $this->db->insert_id();
						if( $insertId )
						{
								$this -> db -> insert('t_gn_assignment',
								array(
									'CustomerId'	=> $insertId, 
									'AssignAdmin'	=> $this -> EUI_Session -> _get_session('UserId'),
									'AssignAmgr' 	=> $UserDetail['act_mgr'], 
									'AssignMgr' 	=> $UserDetail['mgr_id'], 
									'AssignSpv' 	=> $UserDetail['spv_id'],
									'AssignMode' 	=> 'DIS', 
									'AssignDate' 	=> date('Y-m-d H:i:s')
								));
						}
						
						if( $this -> db -> update('t_gn_bucket_customers', 
							array('AssignCampaign'=>1),
							array('CustomerId' => $_bucket_id[$k]['BucketId'])
						))
						{
							$this -> db -> insert('t_gn_bucket_assigment', 
							array
							(
								'CustomerBucketId' => $_bucket_id[$k]['BucketId'],
								'CustomerCampaignId' => $_insert_data['CampaignId'],
								'CreatedDateTs' => date('Y-m-d H:i:s'),
								'CreateUserId' => $this -> EUI_Session->_get_session('UserId')
							));
							
							$_totals++;
						}
					}
				}
				else{
					$_duplicate++;
				}
			}
		}
	}	
  }
  
  // return data in array 
  
  return array
  (
	'_success' => $_totals, 
	'_duplicate'=> $_duplicate
  );
  
}

/*
 * @def		 : _setDistribusi from assigment 
 *				agent look on agent assigment () 
 * -----------------------------------------
 *
 * @ def	 : function get detail content list page 
 * @ param	 : not assign parameter
 */	
  
  
function ManualDistribusi()
{
	$_success = 0;  $UserData = array();
	
	if( is_array( self::$params['UserSelect']) 
		AND !is_null(self::$params['UserSelect']))
	{
		foreach( self::$params['UserSelect'] as $key => $rows )
		{
			$array_user_id[$key] = $rows['userid']; 
			$array_size_id[$key] = $rows['size'];	
		}
				
		/* @ def : urutkan size_data secra ASC ex: 0,1,2,3,4 */
		$array_multisort = array_multisort($array_size_id, SORT_ASC, $array_user_id, SORT_ASC, self::$params['UserSelect']); 
		if( $array_multisort )
		{
			$QtyDataAsg = self::$params['Data'];
			$start_post= 0;
				
			foreach(self::$params['UserSelect'] as $rows )
			{
				if( $start_post==0 )
				{
					$start =0;
					$post_size = ($rows['size']-1);
					while(true)
					{
						$UserData[$rows['userid']][] = $QtyDataAsg[$start]; 
						if( $start==$post_size ) BREAK;
							$start+=1;
					}
				}	
				else
				{
					$post_size = ($rows['size']+$start);
					$start = $start+1;
					while(true) 
					{
						$UserData[$rows['userid']][] = $QtyDataAsg[$start]; 
						if( $start==$post_size ) BREAK;
						$start+=1;
					}
				}
						
				$start_post+=1;
			}	
		/* @ def 	   : action start distribusi data 
		 * -----------------------------------------------
		 *
		 * @ param   : then will update && save to log 
		 * @ aksess  : look here 
		 */
		  
		if( is_array($UserData) AND count($UserData) > 0 )
		{
			foreach($UserData as $UserId => $Datas )
			{	
				foreach($Datas as $key => $AssignId )
				{
					$UserDetail = $this -> M_SysUser -> _getUserDetail($UserId);
					if( $UserDetail )
					{
						if( self::$params['UserLevel']==USER_ACCOUNT_MANAGER ){
							$_update = array
							(
								'AssignAmgr'  => $UserDetail['act_mgr'], 
								'AssignMode' => 'DIS', 
								'AssignDate' => date('Y-m-d H:i:s')
							);
						}
						
						if( self::$params['UserLevel']==USER_MANAGER ){
							$_update = array
							(
								'AssignAmgr'  => $UserDetail['act_mgr'], 
								'AssignMgr'  => $UserDetail['mgr_id'], 
								'AssignMode' => 'DIS', 
								'AssignDate' => date('Y-m-d H:i:s')
							);
						}
						
						if( self::$params['UserLevel']==USER_ADMIN ){
							$_update = array
							(
								'AssignAdmin'  => $UserDetail['admin_id'], 
								'AssignMode' => 'DIS', 
								'AssignDate' => date('Y-m-d H:i:s')
							);
						}
						
						if( self::$params['UserLevel']==USER_SUPERVISOR ){
							$_update = array
							(
								'AssignAmgr'  	=> $UserDetail['act_mgr'], 
								'AssignMgr' 	=> $UserDetail['mgr_id'], 
								'AssignSpv' 	=> $UserDetail['spv_id'],
								'AssignMode' 	=> 'DIS', 
								'AssignDate' 	=> date('Y-m-d H:i:s')
							);
						}
						
						if( self::$params['UserLevel']==USER_LEADER ){
							$_update = array
							(
								'AssignAmgr' 	=> $UserDetail['act_mgr'], 
								'AssignMgr' 	=> $UserDetail['mgr_id'], 
								'AssignSpv' 	=> $UserDetail['spv_id'],
								'AssignLeader' 	=> $UserDetail['tl_id'],
								'AssignMode' 	=> 'DIS', 
								'AssignDate' 	=> date('Y-m-d H:i:s')
							);
						}
						
						if( self::$params['UserLevel']==USER_AGENT_OUTBOUND ){
							$_update = array
							(
								'AssignAmgr'  	=> $UserDetail['act_mgr'], 	
								'AssignMgr' 	=> $UserDetail['mgr_id'], 
								'AssignSpv' 	=> $UserDetail['spv_id'],
								'AssignLeader' 	=> $UserDetail['tl_id'],
								'AssignSelerId' => $UserDetail['UserId'],
								'AssignMode' 	=> 'DIS', 
								'AssignDate' 	=> date('Y-m-d H:i:s')
							);
						}
						
						if( self::$params['UserLevel']==USER_AGENT_INBOUND ){
							$_update = array
							(
								'AssignAmgr'  	=> $UserDetail['act_mgr'], 
								'AssignMgr' 	=> $UserDetail['mgr_id'], 
								'AssignSpv' 	=> $UserDetail['spv_id'],
								'AssignLeader' 	=> $UserDetail['tl_id'],
								'AssignSelerId' => $UserDetail['UserId'],
								'AssignMode' 	=> 'DIS', 
								'AssignDate' 	=> date('Y-m-d H:i:s')
							);
						}
					}
					
					/* @ def : update assignment data **/
					
						if( $this -> db -> update('t_gn_assignment',$_update, 
							array('AssignId' => $AssignId)
						))
						{
							if( self::_setSaveLog( 
								array('AssignId'=>$AssignId,'UserId'=> $UserDetail['UserId'])
							))
							{ 
								$_success++;
							}	
						}
				}
			}	
		}}
	}
	
	return array( 
		'SizeData' => $_success, 
		'SizeUsers' => count(self::$params['UserSelect']) 
	);
}


/*
 * @def		 : _setDistribusi from assigment 
 *				agent look on agent assigment () 
 * -----------------------------------------
 *
 * @ def	 : function get detail content list page 
 * @ param	 : not assign parameter
 */	
  
public function AutomaticDistribusi()
{
  
  $UserData = array();
  
  if(( count(self::$params['UserSelectId'])!=0) 
    AND (self::$params['AssignData']!='') 
	AND (self::$params['AssignData']!=0))
  {
	$QtyPerUser = (INT)(self::$params['AssignData']/count(self::$params['UserSelectId'])); 
	if( $QtyPerUser > 0 )
	{
		$start = 0;
		foreach( self::$params['UserSelectId'] as $k => $vUser )
		{
			$start_data = (($start)*($QtyPerUser));
			$limit_data = (($QtyPerUser)-1);
			$post_data = $start_data;
			$limit_assign = 0;
			
			/* @ def : set on limit data **/
			
			while(true) 
			{
				$UserData[$vUser][] = self::$params['Data'][$post_data]; 
				if(($limit_assign==$limit_data)) break;
					$post_data+=1;	
					$limit_assign+=1;
			}
			
			$start++;	
		}
	}
  }
  
  /*
   * @ def 	   : action start distribusi data 
   * -----------------------------------------------
   *
   * @ param   : then will update && save to log 
   * @ aksess  : look here 
   */
   
  $_success = 0;
  
  if( is_array($UserData) AND count($UserData) > 0 )
  {
	foreach($UserData as $UserId => $Datas )
	{	
		foreach($Datas as $key => $AssignId )
		{
			$UserDetail = $this -> M_SysUser -> _getUserDetail($UserId);
			//echo self::$params['UserLevel'];

			if( $UserDetail )
			{
				if( self::$params['UserLevel']==USER_MANAGER ){
					$_update = array
					(
						'AssignMgr'  => $UserDetail['mgr_id'], 
						'AssignAmgr'  	=> $UserDetail['act_mgr'], 
						'AssignMode' => 'DIS', 
						'AssignDate' => date('Y-m-d H:i:s')
					);
				}
				
				if( self::$params['UserLevel']==USER_SUPERVISOR ){
					$_update = array
					(
						'AssignMgr' 	=> $UserDetail['mgr_id'], 
						'AssignAmgr'  	=> $UserDetail['act_mgr'], 
						'AssignSpv' 	=> $UserDetail['spv_id'],
						'AssignMode' 	=> 'DIS', 
						'AssignDate' 	=> date('Y-m-d H:i:s')
					);
				}
				
				if( self::$params['UserLevel']==USER_LEADER ){
					$_update = array
					(
						'AssignMgr' 	=> $UserDetail['mgr_id'], 
						'AssignSpv' 	=> $UserDetail['spv_id'],
						'AssignLeader'	=> $UserDetail['tl_id'],
						'AssignAmgr'  	=> $UserDetail['act_mgr'], 
						'AssignMode' 	=> 'DIS', 
						'AssignDate' 	=> date('Y-m-d H:i:s')
					);
				}
				
				if( self::$params['UserLevel']==USER_AGENT_OUTBOUND ){
					$_update = array
					(
						'AssignMgr' 	=> $UserDetail['mgr_id'], 
						'AssignAmgr'  	=> $UserDetail['act_mgr'], 
						'AssignSpv' 	=> $UserDetail['spv_id'],
						'AssignLeader'	=> $UserDetail['tl_id'],
						'AssignSelerId' => $UserDetail['UserId'],
						'AssignMode' 	=> 'DIS', 
						'AssignDate' 	=> date('Y-m-d H:i:s')
					);
				}
						
				if( self::$params['UserLevel']==USER_AGENT_INBOUND ){
					$_update = array
					(
						'AssignMgr' 	=> $UserDetail['mgr_id'], 
						'AssignAmgr'  	=> $UserDetail['act_mgr'], 
						'AssignSpv' 	=> $UserDetail['spv_id'],
						'AssignLeader'	=> $UserDetail['tl_id'],
						'AssignSelerId' => $UserDetail['UserId'],
						'AssignMode' 	=> 'DIS', 
						'AssignDate' 	=> date('Y-m-d H:i:s')
					);
				}
			}
			
			/* @ def : update assignment data **/
				if( $this -> db -> update('t_gn_assignment',$_update, 
					array('AssignId' => $AssignId)
				))
				{
					if( self::_setSaveLog( 
						array('AssignId'=>$AssignId,'UserId'=> $UserDetail['UserId'])
					))
					{ 
						$_success++;
					}	
				}
		}
	}	
  }
  
  return array( 
	'SizeData'  => $_success, 
	'SizeUsers' => count(self::$params['UserSelectId'])
  );
  
}

/*
 * @def		 : _setDistribusi from assigment 
 *				agent look on agent assigment () 
 * -----------------------------------------
 *
 * @ def	 : function get detail content list page 
 * @ param	 : not assign parameter
 */	

function _setSaveLog($array = array() )
{
  $_conds = false;
  
  if( is_array($array) AND !is_null($array) ) 
  {
	 $_insert['LogAssignmentId'] = $array['AssignId'];
	 $_insert['LogUserId']		 = $array['UserId'];
	 $_insert['LogCreatedDate']  = date('Y-m-d H:i:s');
	 $_insert['LogAssignUserId'] = $this ->EUI_Session -> _get_session('UserId');
	 
	 if( $this -> db -> insert('t_gn_distribusi_log',$_insert) )
	 {
		$_conds = true;
	 }
  }	
  
  return $_conds;
  
}


/*
 * @def		 : _setDistribusi from assigment 
 *				agent look on agent assigment () 
 * -----------------------------------------
 *
 * @ def	 : function get detail content list page 
 * @ param	 : not assign parameter
 */	

 
  
}
?>