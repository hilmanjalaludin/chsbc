<?php
/*
 * @def : M_MgtTransferData
 * -------------------------------
 * 
 * @param : Unit Test 
 * @param : Unit Test
 */
 
class M_MgtTransferData Extends EUI_Model
{

 function M_MgtTransferData()
 { 
	$this -> load ->model(array('M_SysUser','M_ModDistribusi','M_ModOutBoundGoal')); 
 }
 
 /*
  *
  */
  
 function _get_default()
 {
	$this -> EUI_Page -> _setPage(10); 
	$this -> EUI_Page -> _setQuery("SELECT a.FTP_UploadId FROM t_gn_upload_report_ftp a"); 	
	$this -> EUI_Page -> _setWhere('');
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
	$this -> EUI_Page -> _postPage($this -> URI -> _get_post('v_page'));
	$this -> EUI_Page -> _setPage(10);
	
	// set query 
	
	$this -> EUI_Page -> _setQuery('SELECT a.* FROM t_gn_upload_report_ftp a'); 
	$this -> EUI_Page -> _setWhere();   
	
	if( $this->URI->_get_have_post('order_by')){
		$this -> EUI_Page -> _setOrderBy($this->URI->_get_post('order_by'),$this->URI->_get_post('type'));
	}
	else{
		$this -> EUI_Page -> _setOrderBy('a.FTP_UploadId','DESC');
	}
		
	$this -> EUI_Page -> _setLimit();
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
 
 
 function _getListMoveData( $param = null )
 {
	$list = array();
	
	$CampaignOutbound = $this->M_ModOutBoundGoal->_getOutboundId();
	
	$this -> db ->select("*"); 
	$this -> db ->from("t_gn_customer a");
	$this -> db ->join("t_gn_assignment b "," a.CustomerId=b.CustomerId","LEFT");
	$this -> db ->join("tms_agent c "," b.AssignSelerId=c.UserId","LEFT");
	$this -> db ->join("t_lk_callreason d", "a.CallReasonId=d.CallReasonId","LEFT");
	
/* get level user : ADMIN */

	
	if( $this ->EUI_Session ->_get_session('HandlingType')==USER_ADMIN){
			$this -> db -> where('b.AssignAdmin', $this ->EUI_Session ->_get_session('UserId'));	
	}
	
  /* get level user : USER_ACCOUNT_MANAGER */
	
	if( $this ->EUI_Session ->_get_session('HandlingType')==USER_ACCOUNT_MANAGER){
			$this -> db -> where('b.AssignAmgr', $this ->EUI_Session ->_get_session('UserId'));	
	}
	
 /* get level user : USER_MANAGER */
 
	if( $this ->EUI_Session ->_get_session('HandlingType')==USER_MANAGER){
		$this -> db -> where('b.AssignMgr', $this ->EUI_Session ->_get_session('UserId'));	
	}
		
	
 /* get level user : USER_SUPERVISOR */
	
	if( $this ->EUI_Session ->_get_session('HandlingType')==USER_SUPERVISOR){
		$this -> db -> where('b.AssignSpv',$this ->EUI_Session ->_get_session('UserId'));	
	}
 
 /* get level user : USER_LEADER */
 
	if( $this ->EUI_Session ->_get_session('HandlingType')==USER_LEADER){
		$this -> db -> where('b.AssignLeader',$this ->EUI_Session ->_get_session('UserId'));	
	}
 
 // penambahan agar campaign inbound tidak ikut ter-retrieve
	
	$this -> db ->join("t_gn_campaign e", "a.CampaignId=e.CampaignId","LEFT");
	$this -> db ->where("e.OutboundGoalsId", $CampaignOutbound);
	
	if( !empty($param['CallReasonId']))
	{
		if( !@in_array('NULL', $param['CallReasonId']) ){
			$this -> db ->where_in('a.CallReasonId', $param['CallReasonId']);
		}
		else{
			$this -> db ->where('a.CallReasonId IS NULL', '', FALSE);
		}
	}
	
	if( empty($param['CallReasonId'])){
		$this -> db ->where('(a.CallReasonId IS NULL OR a.CallReasonId IS NOT NULL)', '', FALSE);
	}
	
	if( isset($param['CampaignId']) AND !empty($param['CampaignId']) ){
		$this -> db ->where_in('a.CampaignId', $param['CampaignId']);
	}
	
	
	if( isset($param['UserId']) AND !empty($param['UserId'])  ){
		$this -> db ->where_in('b.AssignSelerId', $param['UserId']);
	}
	
	$num = 0;
	foreach( $this ->db->get() ->result_assoc() as $rows ) {
		$list[$num] = $rows;
		$num++;
	}
	
	return $list;
	

 }
 
 
 // function get user on level 
 
 
public function _getUserLevel( $LevelId )
 {
 
 $UserList = array();
 
  if(in_array($this ->EUI_Session ->_get_session('HandlingType'), 
	array
	( 
		  USER_ROOT, USER_ADMIN, 
		  USER_MANAGER, USER_SUPERVISOR, 
		  USER_LEADER, USER_QUALITY, 
		  USER_ACCOUNT_MANAGER, USER_BACK_OFFICE, 
		  USER_QUALITY_STAFF, USER_QUALITY_HEAD
	)))
	{
		$_SESSION_USERID = $this -> EUI_Session->_get_session('UserId');
		
		$this -> db ->select('a.*');
		$this -> db ->from('tms_agent a');
		$this -> db ->join('cc_agent b ',' a.id=b.userid','INNER');
		$this -> db -> where('a.user_state', 1);
		$this -> db -> where('a.handling_type', $LevelId);
		
		// admin 
		
		if( $this ->EUI_Session ->_get_session('HandlingType')==USER_ADMIN){
			$this -> db -> where('a.admin_id', $_SESSION_USERID);	
		}
		if( $this ->EUI_Session ->_get_session('HandlingType')==USER_ACCOUNT_MANAGER){
			$this -> db -> where('a.act_mgr', $_SESSION_USERID);	
		}
		// manager 
		
		if( $this ->EUI_Session ->_get_session('HandlingType')==USER_MANAGER){
			$this -> db -> where('a.mgr_id', $_SESSION_USERID);	
		}
		// supervisor 
		
		if( $this ->EUI_Session ->_get_session('HandlingType')==USER_SUPERVISOR){
			$this -> db -> where('a.spv_id', $_SESSION_USERID);	
		}
		
		// leader 
		
		if( $this ->EUI_Session ->_get_session('HandlingType')==USER_LEADER){
			$this -> db -> where('a.tl_id', $_SESSION_USERID);	
		}
		
		$this->db->order_by("a.full_name");
		// other condistion && run on here.. :);
		
		// the run of query 
		//echo $this -> db -> _get_var_dump();
		$list = 0;
		foreach( $this -> db -> get() -> result_assoc() as $rows ){
			$UserList[$list] = $rows; $list++;	
		}	
	}
	
	return $UserList;
	
 }
 
 
 // _setSwapData($SellerId,$AssignId);
 
function _setSwapData( $SellerId=null, $AssignId=null ) 
{

// set zero success 

 $total_success = 0;
 
// calculation data && user
 
  $count_sellerid = COUNT($SellerId);
  $count_assignid = COUNT($AssignId);
  $count_page = floor(($count_assignid/$count_sellerid));
  
// define off columns data 
 
 $COLUMNS_MAPS = array( 
	USER_ADMIN => 'AssignAdmin', USER_MANAGER => 'AssignMgr', 
	USER_ACCOUNT_MANAGER => 'AssignAmgr', USER_SUPERVISOR =>'AssignSpv',  
	USER_LEADER => 'AssignLeader', USER_AGENT_INBOUND  => 'AssignSelerId',
	USER_AGENT_OUTBOUND => 'AssignSelerId' 
 );
	
// cek capability data 

if( COUNT($count_page) > 0 )  
{
	$start = 0; $list_by_user = array(); $i = 0;
	foreach( $SellerId as $k => $UserId ) 
	{
		if( $i==0 )	
			$start = ($i * $count_page);
		else
			$start = ($i * $count_page); 
	 
  // set to list data 
	 
	 $list_by_user[$UserId] = array_slice($AssignId,$start,$count_page); $i++;	
	 
	}
		
 // set to agent 	
	
	
	if( count($list_by_user) > 0 )  
	{
		$Levels = $this -> URI ->_get_post('UserLevel');
		foreach($list_by_user as $ID => $arrResult ) 
		{
			$rows = $this -> M_SysUser -> _getUserDetail($ID);
			if( is_array($rows) )
			{
				foreach( $arrResult as $k => $idxAssignId )
				{
					if(in_array( $Levels , array_keys($COLUMNS_MAPS) ) ) 
					{
						$this -> db -> set($COLUMNS_MAPS[$Levels],$rows['UserId'],FALSE);
					
					// level AGENT ------------------------------>
					
						if( ($Levels == USER_AGENT_INBOUND) 
							OR ($Levels== USER_AGENT_OUTBOUND) )
						{
							$this -> db -> set('AssignAdmin',$rows['admin_id']);
							$this -> db -> set('AssignMgr', $rows['mgr_id']);  
							$this -> db -> set('AssignAmgr', $rows['act_mgr']);  
							$this -> db -> set('AssignSpv', $rows['spv_id']); 
							$this -> db -> set('AssignLeader', $rows['tl_id']);
							$this -> db -> set('AssignDate', date('Y-m-d H:i:s') );
							$this -> db -> set('AssignMode', 'MOV');
						}	
						
					// level LEADER --------------------------------------->
					
						
						if( ($Levels == USER_LEADER) ) 
						{
							$this -> db -> set('AssignAdmin',$rows['admin_id']);
							$this -> db -> set('AssignMgr', $rows['mgr_id']);  
							$this -> db -> set('AssignSpv', $rows['spv_id']); 
							$this -> db -> set('AssignSelerId','NULL',FALSE);
							$this -> db -> set('AssignDate', date('Y-m-d H:i:s') );
							$this -> db -> set('AssignMode', 'MOV');
						}
						
					// level SUPERVISOR --------------------------------------->
						
						if( ($Levels == USER_SUPERVISOR ) ) 
						{
							$this -> db -> set('AssignAdmin',$rows['admin_id']);
							$this -> db -> set('AssignMgr', $rows['mgr_id']);  
							$this -> db -> set('AssignSelerId','NULL',FALSE);
							$this -> db -> set('AssignLeader', 'NULL',FALSE);
							$this -> db -> set('AssignDate', date('Y-m-d H:i:s') );
							$this -> db -> set('AssignMode', 'MOV');
						}
						
						
					// level MANAGAER --------------------------------------->
						if( ($Levels == USER_MANAGER )) 
						{
							$this -> db -> set('AssignAdmin',$rows['admin_id']);
							$this -> db -> set('AssignSpv', 'NULL', FALSE); 
							$this -> db -> set('AssignSelerId','NULL',FALSE);
							$this -> db -> set('AssignLeader', 'NULL',FALSE);
							$this -> db -> set('AssignDate', date('Y-m-d H:i:s') );
							$this -> db -> set('AssignMode', 'MOV');
						}
						
					// level MANAGAER --------------------------------------->
						if( ($Levels == USER_ADMIN )) {
							$this -> db -> set('AssignMgr', 'NULL',FALSE);  
							$this -> db -> set('AssignSpv', 'NULL',FALSE); 
							$this -> db -> set('AssignLeader', 'NULL',FALSE);
							$this -> db -> set('AssignDate', date('Y-m-d H:i:s') );
							$this -> db -> set('AssignMode', 'MOV');
						}
					 }
			// then update data assignment 
			
					$this -> db -> where('AssignId', $idxAssignId, FALSE);
					$this -> db -> update('t_gn_assignment');
					
					if( $this -> db -> affected_rows() ) 
					{
						if( $this -> M_ModDistribusi -> _setSaveLog(
							array(
								'AssignId' => $idxAssignId, 
								'UserId'   => $rows['UserId'] ) 
						))
						{
							$total_success+=1;
						}	
					}	
				}
			}
		}
	 }	
  }
  
  return $total_success;
  
 }
 
 // end func 
 

}

?>