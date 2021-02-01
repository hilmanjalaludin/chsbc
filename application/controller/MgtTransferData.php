<?php
/*
 *
 */
class MgtTransferData Extends EUI_Controller
{

/*
 *
 */
 
public function MgtTransferData()
{
	parent::__construct();	
	$this -> load -> model(array(base_class_model($this),'M_Combo','M_SysUser'));
}
 
 
/*
 *
 */
 
 function _getCombo()
 {
	$_serialize = array();
	$_combo = $this ->M_Combo->_getSerialize();
	foreach( $_combo as $keys => $method )
	{
		if((STRTOLOWER($keys)!='serialize') AND (STRTOLOWER($keys)!='instance') 
			AND (STRTOLOWER($keys)!='nstruct') AND (STRTOLOWER($keys)!='t'))
		{
			if(STRTOLOWER($keys)=='user')
			{
				$_serialize[$keys] = $this->_getAgentAssign();
			}
			else{
				$_serialize[$keys] = $this ->M_Combo->$method();
			}
		}
	}
	
	return $_serialize;
 } 
 
 function _getAgentAssign()
{
	$_conds = array();
	$Agent = $this -> M_SysUser->_get_user_by_login();
	
	$no=0;
	foreach( $Agent as $k => $rows ) 
	{
		$_conds[$k] = (++$no).' -'. $rows['full_name'];
	}
	
	return $_conds;
} 
 
private function _getPrivileges()
{
	$datas = array();
	
	$Privileges = $this -> M_SysUser->_get_handling_type();
	
	// USER_ROOT
	if( ($this -> EUI_Session -> _get_session('HandlingType')== USER_ROOT) ){
		$filter = array(USER_ROOT);
	}
	
	// USER_ADMIN
	if( ($this -> EUI_Session -> _get_session('HandlingType')== USER_ADMIN) ){
		$filter = array(USER_ROOT,USER_ADMIN, USER_QUALITY_HEAD, USER_QUALITY_STAFF);
	}
	
	// USER_ACCOUNT_MANAGER
	if( ($this -> EUI_Session -> _get_session('HandlingType')== USER_ACCOUNT_MANAGER) ){
		$filter = array(USER_ROOT,USER_ADMIN, 
			USER_ACCOUNT_MANAGER, USER_QUALITY_HEAD, 
			USER_QUALITY_STAFF
		);
	}
	
	// USER_MANAGER
	
	if( ($this -> EUI_Session -> _get_session('HandlingType')== USER_MANAGER) ){
		$filter = array(USER_ROOT,USER_ADMIN, USER_ACCOUNT_MANAGER, 
			USER_MANAGER, USER_QUALITY_HEAD, 
			USER_QUALITY_STAFF
		);
	}
	
	// USER_SUPERVISOR
	
	if( ($this -> EUI_Session -> _get_session('HandlingType')== USER_SUPERVISOR) ){
		$filter = array(
			USER_ROOT,USER_ADMIN, USER_ACCOUNT_MANAGER, 
			USER_SUPERVISOR, USER_MANAGER, 
			USER_QUALITY_HEAD, 
			USER_QUALITY_STAFF
		);
	}
	
	// USER_LEADER
	
	if( ($this -> EUI_Session -> _get_session('HandlingType')== USER_LEADER) ){
		$filter = array(
			USER_ROOT,USER_ADMIN, USER_ACCOUNT_MANAGER, 
			USER_SUPERVISOR, USER_MANAGER, 
			USER_QUALITY_HEAD, 
			USER_QUALITY_STAFF,
			USER_LEADER
		);
	}
	
	
	foreach( $Privileges as $k => $User ) {
		if(!@in_array($k,$filter) ){
			$datas[][$k]= $User;
		}
	}
	
	return $datas;
}
 
/*
 *
 */
 
public function index()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( class_exists(base_class_model($this)) ) 
		{
			$EUI = array( 
				'page' => $this -> {base_class_model($this)} -> _get_default(),
				'combo' => $this -> _getCombo(),
				'privileges' => $this ->_getPrivileges()
			);
			
			$this -> load -> view('mgt_move_data/view_mov_data_nav', $EUI);
		} 
		else
		{
			echo "Class ".base_class_model($this)." does no exist ";
			exit(0);
		}
	}
 }
 
 
 
/*
 *
 */
 
public function Content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId'))
	{
		$EUI['page'] = $this ->{base_class_model($this)}-> _get_resource(); // load content data by pages 
		$EUI['num']  = $this ->{base_class_model($this)}-> _get_page_number(); 	// load content data by pages 
		
		$this -> load -> view('mgt_move_data/view_mov_data_list', $EUI );
	}	
 }
 
// UserLevel 
 function UserLevel()
 {
	$Level = ARRAY('LEVEL' => $this -> {base_class_model($this)}->_getUserLevel($this -> URI->_get_post('LevelID')));
	$this -> load -> view('mgt_move_data/view_privileges_list', $Level);
 }
 
 
 function ListMoveData()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') ) 
	{
		$param = array( 
			'CallReasonId' => $this -> URI ->_get_array_post('CallReasonId'),
			'CampaignId' => $this -> URI ->_get_array_post('CampaignId'),
			'UserId'=> $this -> URI ->_get_array_post('FromUserId')
		);	
		
		$list = array(
			'data' => $this -> {base_class_model($this)}->_getListMoveData($param), 'combo' => $this -> _getCombo() );
		$this -> load -> view('mgt_move_data/view_mov_list', $list);
	}
 }
 
 
 // SwapData
 
 function SwapData()
 {
	$_conds = array('success' => 0);
	
	if( $this -> EUI_Session -> _have_get_session('UserId') ) 
	{
		$SellerId = $this -> URI->_get_array_post('UserId');
		$AssignId = $this -> URI->_get_array_post('AssignId');
		
		if( count($SellerId)> 0 AND count($AssignId) > 0 ) 
		{
			$result = $this -> {base_class_model($this)} ->_setSwapData($SellerId,$AssignId);
			if( $result )
			{
				$_conds = array('success' => 1,'message' => $result);
			}	
		}
	}
	
	echo json_encode($_conds);
 }
 
}

?>