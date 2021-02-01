<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class MgtAssignment extends EUI_Controller
{


/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function __construct()
 {
	parent::__construct();
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object'));
 }

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
public function index()
{
   if( !_have_get_session('UserId') ) {
	return false;
   }

   $this->load->view('mgt_assignment/view_assignment_index', array());
}
 

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
public function PageDistribute()
{
  
  $this->start_page = 0;
  $this->per_page   = 10;
  
  // ---------- customize page data ------------------------ 
  if( _get_have_post('dis_record_page') ){
	$this->per_page = _get_post('dis_record_page');
  }	 	  
  
  // ------------- then result data ---------------------------------
  $this->post_page  = (int)_get_post('page');
  $obj_class =& get_class_instance(base_class_model($this));
  $this->arr_result = array();
  $this->arr_content = $obj_class->_select_page_distribute( new EUI_Object( _get_all_request() ));
  $this->tot_result = count($this->arr_content);
	
   if( $this->post_page) {
	$this->start_page = (($this->post_page-1)*$this->per_page);
  } else {	
	$this->start_page = 0;
  }

  // @ pack : set result on array
  if( (is_array($this->arr_result)) AND ( $this->tot_result > 0 ) )
  {
	$this->arr_result = array_slice($this->arr_content, $this->start_page, $this->per_page);
  }	
 
 $this->page_counter = ceil($this->tot_result/ $this->per_page);
 
 // @ pack : then set it to view 
 $arr_page_address = array
 (
	'content_pages' => $this->arr_result,
	'total_records' => $this->tot_result,
	'total_pages'   => $this->page_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page
 );
 
 $this->load->view("mgt_assignment/view_assigment_distribute_page", $arr_page_address);
 
} 


// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute PageTransfer 	
 *  
 */
 
 public function PageTransfer()
{
  
  $this->start_page = 0;
  $this->per_page   = 20;
 // -------------- customize page ----------------------
  
 if( _get_have_post('trans_record_page') ){
	$this->per_page = _get_post('trans_record_page');
 } 
 
 // --------------- date text --------------------------------------
 
  $this->post_page  = (int)_get_post('page'); 
  $obj_class =& get_class_instance(base_class_model($this));
  $this->arr_result = array();
  $this->arr_content = $obj_class->_select_page_transfer( new EUI_Object( _get_all_request() ));
  $this->tot_result = count($this->arr_content);
	
   if( $this->post_page) {
	$this->start_page = (($this->post_page-1)*$this->per_page);
  } else {	
	$this->start_page = 0;
  }

 // @ pack : set result on array
  if( (is_array($this->arr_result)) 
	AND ( $this->tot_result > 0 ) )
 {
	$this->arr_result = array_slice($this->arr_content, $this->start_page, $this->per_page);
}	
 
 $this->page_counter = ceil($this->tot_result/ $this->per_page);
 
 // @ pack : then set it to view 
 
 $arr_page_address = array
(
	'content_pages' => $this->arr_result,
	'total_records' => $this->tot_result,
	'total_pages'   => $this->page_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page
 );
 
 $this->load->view("mgt_assignment/view_assigment_transfer_page", $arr_page_address);
 
} 




// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute PageTransfer 	
 *  
 */
 
 public function PagePullData()
{
  
  $this->start_page = 0;
  $this->per_page   = 20;
  
   // -------------- customize page ----------------------
  
 if( _get_have_post('pull_record_page') ){
	$this->per_page = _get_post('pull_record_page');
 } 
 
 // --------------- date text --------------------------------------
 
 
  $this->post_page  = (int)_get_post('page'); 
  $obj_class =& get_class_instance(base_class_model($this));
  $this->arr_result = array();
  $this->arr_content = $obj_class->_select_page_pulldata( new EUI_Object( _get_all_request() ));
  $this->tot_result = count($this->arr_content);
	
   if( $this->post_page) {
	$this->start_page = (($this->post_page-1)*$this->per_page);
  } else {	
	$this->start_page = 0;
  }

 // @ pack : set result on array
  if( (is_array($this->arr_result)) 
	AND ( $this->tot_result > 0 ) )
 {
	$this->arr_result = array_slice($this->arr_content, $this->start_page, $this->per_page);
}	
 
 $this->page_counter = ceil($this->tot_result/ $this->per_page);
 
 // @ pack : then set it to view 
 
 $arr_page_address = array
(
	'content_pages' => $this->arr_result,
	'total_records' => $this->tot_result,
	'total_pages'   => $this->page_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page
 );
 // print_r($arr_page_address);
 $this->load->view("mgt_assignment/view_assigment_pull_page", $arr_page_address);
 
} 


// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
 function _getCombo()
 {
	$_serialize = array();
	$_combo = $this ->M_Combo->_getSerialize();
	foreach( $_combo as $keys => $method )
	{
		if((strtolower($keys)!='serialize') AND (strtolower($keys)!='instance') 
			AND (strtolower($keys)!='nstruct') AND (strtolower($keys)!='t'))
		{
			$_serialize[$keys] = $this ->M_Combo->$method(); 	
		}
	}
	
	return $_serialize;
 }

	public function getRecsources()
	{
		$Arrlevel = array();
		$User =& get_class_instance('M_Combo');
		$out =new EUI_Object(_get_all_request());

		$Arrlevel =& $User->_getRecsource();
		
		$OnSelect = $out->get_array_value('select');
		if( $out->get_value('type') == 'dropdown' ) {
			echo form()->combo($out->get_value('id'),"select tolong",$Arrlevel, first($OnSelect));
		}

		if( $out->get_value('type') == 'listboxes' ){
				echo form()->listCombo($out->get_value('id'),"select tolong", $Arrlevel,$OnSelect, null, array("height" => "200px","dwidth" => "100%"));
		}
	}
 
/*
 * @ def 		: content / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function Content()
{
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI = array (
			'Model' => $this -> {base_class_model($this)} ,
			'page' => $this -> {base_class_model($this)}->_get_resource(),
			'num' => $this -> {base_class_model($this)}->_get_page_number()
		);
		
		// sent to view data 
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('mgt_assignment/view_assignment_list',$_EUI);
		}	
	}	
 }

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function getAssignContent()
 {
	
	if( $this -> URI -> _get_have_post('CampaignId') )
	{
		$this -> {base_class_model($this)} -> _set_CampaignId( $this -> URI -> _get_post('CampaignId') );
		$_EUI = array ( 
			'Model' => $this->{base_class_model($this)},
			'Combo' => $this->_getCombo(),
			'params' => $this -> URI->_get_all_request()
		);
		
		$this -> load -> view('mgt_assignment/view_assignment_content',$_EUI);
	}	
 }

/*
 * @ unit test  : cek CampaignId inbound Or OutboundGoals
 * 
 */
 
function CampaignType()
{
	$_conds = array('type' => 0 );
	if( $this -> EUI_Session-> _have_get_session('UserId') )
	{
		$_conds = array('type' => $this->{base_class_model($this)}->_getCampaignType($this -> URI->_get_post('CampaignId')));
	}
	
	__(json_encode($_conds));
}
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function getShowByLevel()
 {
	switch($this -> URI -> _get_post('DistribusiType') )
	{
		case 1 : self::_getShowManual();  break;
		case 2 : self::_getShowAutomatic();  break;
	}
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getShowManual()
 {
	if( $this -> URI -> _get_have_post('UserLevel') )
	{
		$LevelUser = $this -> URI -> _get_post('UserLevel');
		if( $LevelUser!=FALSE )
		{
			$EUI = array( 'Manual' => $this -> {base_class_model($this)} -> _get_manual_distribusi($LevelUser));
			$this -> load -> view('mgt_assignment/view_assignment_manual',$EUI);
		}	
	}	
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getShowAutomatic()
 {
	if( $this -> URI -> _get_have_post('UserLevel') )
	{
		$LevelUser = $this -> URI -> _get_post('UserLevel');
		if( $LevelUser!=FALSE )
		{
			$EUI = array( 'Manual' => $this -> {base_class_model($this)} -> _get_automatic_distribusi($LevelUser));
			$this -> load -> view('mgt_assignment/view_assignment_automatic',$EUI);
		}	
	}	
 }
 /*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
private function _getJSON( $JSON=null )
{
	if( !is_null($JSON) )
	{
		return json_decode(str_replace("\\","", $JSON ),true);
	}	
} 
	
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function AgentDistribusi()
 {
	$_conds = array('success' => 0, 'message' => '');
	
	if( $this -> URI -> _get_have_post('UserLevel') )
	{
		$data_post = array
		(
			'AssignData' 	 => $this->URI->_get_post('AssignData'),
			'CampaignId' 	 => $this->URI->_get_post('CampaignId'),
			'CampaignNumber' => $this->URI->_get_post('CampaignNumber'),
			'DistribusiMode' => $this->URI->_get_post('DistribusiMode'),
			'DistribusiType' => $this->URI->_get_post('DistribusiType'),
			'JumlahData' 	 => $this->URI->_get_post('JumlahData'),
			'UserLevel' 	 => $this->URI->_get_post('UserLevel'),
			'CustomerCity'	 => $this->URI->_get_post('CustomerCity'),
			'GenderId'		 => $this->URI->_get_post('GenderId'),
			'StartAge'		 => $this->URI->_get_post('StartAge'),
			'EndAge'		 => $this->URI->_get_post('EndAge'),
			'UserSelectId' 	 => $this->URI->_get_array_post('UserSelect'),
			'UserSelect'	 => $this->_getJSON($this->URI->_get_post('UserSelectId'))
		);
		
		$_getMsg = $this -> {base_class_model($this)} -> _setAgentDistribusi($data_post);
		if( is_array($_getMsg) 
			AND !is_null($_getMsg))
		{
			$_conds = array('success' =>1, 'message' => $_getMsg );
		}
	}
	
	__(json_encode($_conds));
 }
 

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
 
function AgentReAssignment()
{
	
	$_conds = array('success' => 0, 'message' => '');
	if( $this -> URI -> _get_have_post('UserLevel') ) 
	{
		$data_post = array
		(
			'fltCallResultId'=> $this->URI->_get_array_post('CallResultId'),
			'fltUserId'	 	 => $this->URI->_get_array_post('UserId'),
			'AssignData' 	 => $this->URI->_get_post('AssignData'),
			'CampaignId' 	 => $this->URI->_get_post('CampaignId'),
			'DistribusiMode' => $this->URI->_get_post('DistribusiMode'),
			'DistribusiType' => $this->URI->_get_post('DistribusiType'),
			'JumlahData' 	 => $this->URI->_get_post('JumlahData'),
			'UserLevel' 	 => $this->URI->_get_post('UserLevel'),
			'UserSelectId' 	 => $this->URI->_get_array_post('UserSelect'),
			'UserSizeData'	 => $this->_getJSON($this->URI->_get_post('UserSizeData'))
		);
		
		$_getMsg = $this -> {base_class_model($this)} -> _setReAssignment($data_post);
		
		if( is_array($_getMsg) 
			AND !is_null($_getMsg))
		{
			$_conds = array('success' =>1, 'message' => $_getMsg );
		}
	}
	
	__(json_encode($_conds));
} 

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
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
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getReasultAssign()
{
	$_conds = array();
	$CallResult = $this -> M_SetCallResult->_getCallReasonId(null);
	$Sale = $this -> M_SetCallResult->_getInterestSale();
	
	$_conds['new'] = 'New Data';
	foreach($CallResult as $k => $rows )
	{
		if( !in_array($k,array_keys($Sale)) ){
			$_conds[$k] = $rows['name'];
		}
	}
	
	return $_conds;
} 

  
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

function ShowData(){
	
 $_data_array = array('success' => 0, 'counter' =>0);
 
 if( $this -> URI->_get_have_post('UserId') AND	$this -> URI->_get_have_post('CampaignId') )
{
	$UI = array( 
		'UserId' => $this ->URI ->_get_array_post('UserId'),
		'CallResultId' => $this -> URI ->_get_array_post('CallResultId'),
		'CampaignId' => $this -> URI ->_get_post('CampaignId')
	);
	
	$_data_array = array('success' => 1, 
		'counter' => $_data_array = $this -> {base_class_model($this)}->_getShowData($UI) );
}

	
	__(json_encode($_data_array));
}
  
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

 function ViewAgentData()
 {
	if( $this -> URI -> _get_have_post('CampaignId') )
	{
		$this -> {base_class_model($this)} -> _set_CampaignId( $this -> URI -> _get_post('CampaignId') );
		$UI = array 
		( 
			'Model' => $this->{base_class_model($this)},
			'Users' => $this->_getAgentAssign(),
			'CallResult' => $this->_getReasultAssign()
		);
		
		$this -> load -> view('mgt_assignment/view_agent_content',$UI);
	}	
 }
 
  
 /*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
 function OutboundGoals()
 {
	__(json_encode( 
		$this -> {base_class_model($this)} -> _getOutboundGoals() 
	));
	
 } 

 //commit afac0748ce240d98baaa4e880d848b00e0da025b 23 januari 2020
 function getDisagree()
{
	 $out = $this -> URI->_get_all_request();
	 $campaign=$out["Campaign"];
		$this->db->select('DisagreeId,DisagreeCode,DisagreeDesc');
		$this->db->where('CampaignId',$campaign);
	  $qry= $this->db->get('t_lk_disagree');
	  $data=$qry->result();

	  echo json_encode($data);

}


 // ShowDataDetail
 
 function ShowDataDetail()
 {
	$UI = array( 
		'UserId' => $this ->URI ->_get_array_post('UserId'),
		'CallResultId' => $this -> URI ->_get_array_post('CallResult'),
		'CampaignId' => $this -> URI ->_get_post('CampaignId')
	);
	
	
	$_list_views = $this -> {base_class_model($this)}->_getShowDataDetail($UI);
	$_list_field = array_keys($this -> {base_class_model($this)}->_getHideTables());
	array_push($_list_field, 'CallReasonId','SellerId');
	
	$viewer  = array("views_data" =>$_list_views, "views_field" => $_list_field,'combo'=>self::_getCombo(),'User' => $this ->M_SysUser);
	$this -> load -> view("mgt_assignment/view_show_data_detail", $viewer);
		
 }
 
 
/*
 * @ def 		: content / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function getUserByLevelLogin()
{
  $_user_login = array();
  if( $this -> URI -> _get_have_post('UserLevel'))
  {
	if( $_user_login = $this -> M_SysUser->_getUserLevelGroup( $this -> URI->_get_post('UserLevel')))
	{
	  __(form()->listCombo('ListUserId',null, $_user_login, NULL, array('click' => 'Ext.DOM.AssignPageContent();'),NULL));
	}
 }
}

// --------------------------------------------
/*
 * @ akses 		public 
 */
 
  public function SelectUserByLevel() 
 {
	$Arrlevel = array(); 
	$User =& get_class_instance('M_SysUser'); 
	$out =new EUI_Object(_get_all_request() );
	
// ----------------
	
	if( _get_session('UserId') )
  {
	if( _get_have_post('dis_user_group') ) {
		$Arrlevel =& $User->_getUserLevelGroup( $out->get_value('dis_user_group'),1);  
	}
	
	$OnSelect = $out->get_array_value('select');
	if( $out->get_value('type') == 'dropdown' ) {
		echo form()->combo($out->get_value('id'),"select tolong",$Arrlevel, first($OnSelect));
	  }	

	if( $out->get_value('type') == 'listboxes' ) 
	{
		if( $out->get_value('dis_user_type') == 2 ) {
			echo form()->listInputBox($out->get_value('id'),"select tolong", $Arrlevel,$OnSelect, null, array("height" => "200px","dwidth" => "100%"));	
		}
		else{
			echo form()->listCombo($out->get_value('id'),"select tolong", $Arrlevel,$OnSelect, null, array("height" => "200px","dwidth" => "100%"));	
		}	
		
	}
	
  }
  
 }
 
// --------------------------------------------------------------------------------------------
/*
 * @ akses 		public 
 */
 
  public function SelectTrfUserByLevel() 
 {
	$Arrlevel = array(); 
	$User =& get_class_instance('M_SysUser'); 
	$out = new EUI_Object(_get_all_request() );
	
// ----------------
	
	if( _get_session('UserId') )
  {
	if( _get_have_post('trans_to_user_group') ) {
		$Arrlevel =& $User->_getUserLevelGroup( $out->get_value('trans_to_user_group'),1);  
	}
	
	$OnSelect = $out->get_array_value('select');
	if( $out->get_value('type') == 'dropdown' ) {
		echo form()->combo($out->get_value('id'),"select tolong",$Arrlevel, first($OnSelect));
	  }	

	if( $out->get_value('type') == 'listboxes' ) 
	{
		if( $out->get_value('trans_user_type') == 2 ) {
			echo form()->listInputBox($out->get_value('id'),"select tolong", $Arrlevel,$OnSelect, null, array("height" => "200px","dwidth" => "100%"));	
		}
		else{
			echo form()->listCombo($out->get_value('id'),"select tolong", $Arrlevel,$OnSelect, null, array("height" => "200px","dwidth" => "100%"));	
		}
	  }
   }
 } 
 


// --------------------------------------------------------------------------------------------
/*
 * @ akses 		public 
 */
 
 function SelectFromTrfUserByLevel()
 {
	$Arrlevel = array(); 
	$User =& get_class_instance('M_SysUser'); 
	$out =new EUI_Object(_get_all_request() );
	
// ----------------
	
	if( _get_session('UserId') )
  {
		if( _get_have_post('trans_from_user_group') ) 
		{
			$Arrlevel =$User->_getUserLevelGroup( $out->get_value('trans_from_user_group'),1);  
		}
	
		$OnSelect = $out->get_array_value('select');
		if( $out->get_value('type') == 'dropdown' ) {
			echo form()->combo($out->get_value('id'),"select tolong",$Arrlevel, first($OnSelect));
		}	
		else if( $out->get_value('type') == 'listboxes' ) 
		{
			echo form()->listCombo($out->get_value('id'),"select tolong", $Arrlevel,$OnSelect, null, array("height" => "200px","dwidth" => "100%"));	
		}
   }
   
 }
// --------------------------------------------------------------------------------------------
/*
 * @ akses 		public 
 */
 
 
function SelectPullFromUserByLevel()
{
	$Arrlevel = array(); 
	$User =& get_class_instance('M_SysUser'); 
	$out = new EUI_Object(_get_all_request() );
	
// ----------------
	
	if( _get_session('UserId') )
  {
		if( _get_have_post('pull_from_user_group') ) 
		{
			$Arrlevel = $User->_getUserLevelGroup( $out->get_value('pull_from_user_group'),1);  
		}
	
		$OnSelect = $out->get_array_value('select');
		if( $out->get_value('type') == 'dropdown' ) {
			echo form()->combo($out->get_value('id'),"select tolong",$Arrlevel, first($OnSelect));
		}	
		else if( $out->get_value('type') == 'listboxes' ) 
		{
			echo form()->listCombo($out->get_value('id'),"select tolong", $Arrlevel,$OnSelect, null, array("height" => "200px","dwidth" => "100%"));	
		}
   }
} 

// --------------------------------------------------------------------------------------------
/*
 * @ akses 		public 
 */
 
 public function SelectPullToUserByLevel()
{
	$Arrlevel = array(); 
	$User =& get_class_instance('M_SysUser'); 
	$out = new EUI_Object(_get_all_request() );
	
// ----------------
	
	if( _get_session('UserId') )
  {
		if( _get_have_post('pull_to_user_group') ) 
		{
			$Arrlevel = $User->_getUserGroupWithMe( $out->get_value('pull_to_user_group'));  
		}
	
		$OnSelect = $out->get_array_value('select');
		if( $out->get_value('type') == 'dropdown' ) {
			echo form()->combo($out->get_value('id'),"select tolong",$Arrlevel, first($OnSelect));
		}	
		else if( $out->get_value('type') == 'listboxes' ) 
		{
			if( $out->get_value('pull_user_type') == 2 ) {
				echo form()->listInputBox($out->get_value('id'),"select tolong", $Arrlevel,$OnSelect, null, array("height" => "200px","dwidth" => "100%"));	
			}
			else{
				echo form()->listCombo($out->get_value('id'),"select tolong", $Arrlevel,$OnSelect, null, array("height" => "200px","dwidth" => "100%"));	
			}	
		}
   }
   
 }

//filter recsource
public function filtered_recsource()
{
	
	if( _get_session('UserId') )
	{
		$recsource = array();
		$out = new EUI_Object(_get_all_request() );
		$campaign = null;
		
		if( _get_have_post('campaign_name') )
		{
			$campaign = $out->get_array_value('campaign_name');
		}
		
		if( _get_have_post('pull_from_campaign_id') )
		{
			$campaign = $out->get_array_value('pull_from_campaign_id');
		}
		
		if( _get_have_post('dis_campaign_name') )
		{
			$campaign = $out->get_array_value('dis_campaign_name');
		}
		
		if( $campaign ) 
		{
			$recsource = Recsource(array(
					'CampaignId'=> $campaign
				));
		}
		else
		{
			$recsource = Recsource();
		}
		
		$OnSelect = $out->get_array_value('select');
		if( $out->get_value('type') == 'dropdown' ) {
			echo form()->combo($out->get_value('id'),"select tolong",$recsource, first($OnSelect));
		}	
		else if( $out->get_value('type') == 'listboxes' ) 
		{
			echo form()->listCombo($out->get_value('id'),"select tolong", $recsource,$OnSelect, null, array("height" => "200px","dwidth" => "100%"));		
		}
	}
} 


/** SECTION PDS */
/**
 * (F) assignmentPDS [load view assigmentPDS]
 */
public function assignmentPDS()
{
   if( !_have_get_session('UserId') ) {
	return false;
   }
   $this->load->view('mgt_assignment_pds/view_assignment_index', array());
}

/**
 * (F) PageDistributePDS [page number distribute PDS]
 */
public function PageDistributePDS()
{
	$this->start_page = 0;
  	$this->per_page   = 10;
 	
 	 // ---------- customize page data ------------------------ 
  	if( _get_have_post('dis_record_page') ){
		$this->per_page = _get_post('dis_record_page');
  	}	 	  
  
  	// ------------- then result data ---------------------------------
  	$this->post_page  = (int)_get_post('page');
 	$obj_class =& get_class_instance(base_class_model($this));
  	$this->arr_result = array();
  	$this->arr_content = $obj_class->_select_page_distributePDS( new EUI_Object( _get_all_request() ));
  	$this->tot_result = count($this->arr_content);
	
   	if( $this->post_page) {
		$this->start_page = (($this->post_page-1)*$this->per_page);
  	} else {	
		$this->start_page = 0;
  	}

  	// @ pack : set result on array
  	if( (is_array($this->arr_result)) AND ( $this->tot_result > 0 ) )
  	{
		$this->arr_result = array_slice($this->arr_content, $this->start_page, $this->per_page);
  	}	
 
 	$this->page_counter = ceil($this->tot_result/ $this->per_page);
	$arr_page_address = array
	(
		'content_pages' => $this->arr_result,
		'total_records' => $this->tot_result,
		'total_pages'   => $this->page_counter,
		'select_pages'  => $this->post_page,
		'start_page' 	=> $this->start_page
	);
 	$this->load->view("mgt_assignment_pds/view_assigment_distribute_page", $arr_page_address);
} 
 
/** END SECTION PDS */
 
 // ================ END CLASS ==================================
}
?>