<?php
/*
 * EUI Controller  
 *
 
 * Section  : < Auth > first load vail web home  website application enjoy its.
 * author 	: razaki team  
 * link		: http://www.razakitechnology.com/eui/controller 
 */
 
class Auth extends EUI_Controller
{

//---------------------------------------------------------------------------------------
/*
 * @ package 		get all user data 
 */
 function __construct()
{
	parent::__construct();
	$this->load->helper(array('EUI_Object'));
} 
 
//---------------------------------------------------------------------------------------
/*
 * @ package 		get all user data 
 */
 
function index() 
{
	if( $this -> EUI_Session -> _get_session('UserId')) {
		redirect("Main/?login=(true)");	
	}
	else
	{
		$this -> load -> Model('M_Website');
		$form = EUI_Form::get_instance(); 
		$this -> load -> layout( $this->Layout->base_layout().'/UserLogin',$this -> M_Website -> _web_get_data());	
	}
}


// -------------- reset - login - user 
  function ResetLogin() 
 {
	$this->db->reset_write();
	$this->db->set("ip_address","NULL", false);
	$this->db->set("logged_state",'0');
	$this->db->update("tms_agent");
}

/*
 *# action login if OK  testing Only
 *# Login Method not constructor 
 */
 
function Login()
{
	$_conds = array('success' => 0);
	
	if( $this-> URI -> _get_have_post('password') OR $this-> URI -> _get_have_post('username'))
	{
		$this -> load -> model('M_User');
		$this -> load -> model('M_SetLastCall');
		$_sent_array = array
			( 
				'username'=> $this -> URI -> _get_64post('username'), 
				'password'=> $this -> URI -> _get_64post('password') 
			);
		
		if( is_object( $this -> M_User) ) 
		{
			/* 
			 * @ define : if true return array if false exit;	
			 * @ notes  :  cant be use if user identified on login other IP
			 * ---------------------------------------------------------------------------
			 */ 
			 
			$rows = $this -> M_User -> getLoginUser($_sent_array);
			$LastCall = $this -> M_SetLastCall -> _getLastCallToday();
			
			if((empty($rows['ip_address']) OR $rows['ip_address']==_getIP())) 
			{
				session_start(); // set to session 
				$this -> EUI_Session -> _set_session('UserId', $rows['UserId']);
				$this -> EUI_Session -> _set_session('Username', $rows['id']);
				$this -> EUI_Session -> _set_session('KodeUser', $rows['code_user']); 
				$this -> EUI_Session -> _set_session('Fullname', $rows['full_name']);
				$this -> EUI_Session -> _set_session('OnlineName', $rows['init_name']);
				$this -> EUI_Session -> _set_session('ProfileId', $rows['profile_id']);
				$this -> EUI_Session -> _set_session('GroupId', $rows['group_id']);
				$this -> EUI_Session -> _set_session('GroupName', $rows['GroupName']);
				$this -> EUI_Session -> _set_session('HandlingType', $rows['handling_type']);
				$this -> EUI_Session -> _set_session('AgencyId', $rows['agency_id']);
				$this -> EUI_Session -> _set_session('SupervisorId', $rows['spv_id']);
				$this -> EUI_Session -> _set_session('ManagerId',  $rows['mgr_id']);
				$this -> EUI_Session -> _set_session('Password', $rows['password']);
				$this -> EUI_Session -> _set_session('LoginIP',  $rows['ip_address']);
				$this -> EUI_Session -> _set_session('UserState', $rows['user_state']);
				$this -> EUI_Session -> _set_session('Telphone', $rows['telphone']);
				$this -> EUI_Session -> _set_session('LastUpdate',$rows['last_update']);
				$this -> EUI_Session -> _set_session('AccountManager',$rows['act_mgr']);
				$this -> EUI_Session -> _set_session('QualityHead',$rows['quality_id']);
				
				/* LAST CALL */
				$this -> EUI_Session -> _set_session('StartTime',$LastCall['StartTime']);
				$this -> EUI_Session -> _set_session('EndTime',$LastCall['EndTime']);
				
				// callback to client information 
				#var_dump( _get_session('HandlingType') ); die();
				
				if( $this -> EUI_Session -> _have_get_session('UserId') )
				{
					$this -> EUI_Session -> _set_session('LastLogin', $this->M_User->_get_last_login());
					if( $this->M_User->_set_update_activity('LOGIN', $this -> EUI_Session -> _get_session('UserId') ) ) 
					{
						if( $this->M_User->_setUpdateLastLogin(1) )
						{
							$_conds = array('success' => 1);
						}
					}
					
					$_conds = array('success' => 1);
				}
			}
			else{
				$_conds = array( 'success' =>2,  'location' => $rows['ip_address'] );
			}
		}
	}
	
	echo json_encode($_conds);
}	

/**
 ** user logout methode  if succces  logout then 
 ** redirect to index for cek session data available
 **/
 
function Logout()
{
	session_start();
	$this->load->model('M_User');
	$objClass =&get_class_instance('M_User');
	
	if(_get_session('UserId') )
	{
		$objClass->_setUpdateLastLogin(0); 
		$this->EUI_Session->_destroy_session();
	}
	
	if( $this->EUI_Session->_get_session('UserId') !=TRUE ){
		redirect("Auth/?login=(false)");	
	}
}

/* update password user if user click **/


public function UpdatePassword()
{
	$_conds = array('success'=>0);
	
	$params = $this -> URI-> _get_all_request(); 
	if( is_array($params) )
	{
		$this -> load -> model('M_User');
		if( $this -> M_User -> _setUpdatePassword($params) )
		{
			$_conds = array('success'=>1);
		}
	}
	
	echo json_encode($_conds);
}

/*
 * @ package 		auth refresh save data 
 *
 */
 
 public function Refresh()
{
	EventLoger('REF', 'Browser Refresh By User');
	//lepas flag_followup
	if( $this->EUI_Session->_get_session('UserId') !=FALSE ){
		$this->db->reset_write();
		$this->db->set("Flag_Followup",0);
		$this->db->where("Flag_Followup", 1);
		$this->db->where("SellerId", _get_session('UserId'));
		$this->db->where("expired_date >= curdate()");
		$this->db->update("t_gn_customer");
	}
}

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	relese data ngagantung di agent TMR 
 *  
 */
 
public function ResetFollowup()
{
 $this->db->reset_write(); 
 $this->db->where("Flag_Followup", 1);
 $this->db->where("CallReasonId !=", 13);
 $this->db->where("expired_date >= curdate()");
 $this->db->set("Flag_Followup",0);
 $this->db->update("t_gn_customer");
} 

/*
 * @ package 		auth refresh save data 
 *
 */
 // php -q /opt/enigma/webapps/hsbc-portof/index.php Auth ResetFollowup
 Public function GetUnsetFollowUp()
 {
	$sql = "select cs.CustomerId from t_gn_customer cs
			where cs.Flag_Followup=1
			and cs.expired_date >= curdate()
			and cs.CallReasonId != 13; ";
	
	$qry = $this->db->query($sql);
	
	$num = 0;
	if ($qry && $qry->num_rows() >0 )
		foreach( $qry->result_assoc() as $row)
		{
			$CustomerId = $row['CustomerId'];
			if ($CustomerId) {
				$sql = "update t_gn_customer cs
						set cs.Flag_Followup=0
						where cs.CustomerId = '$CustomerId'";
						
			if ( $this->db->query( $sql ) ) {
				printf("success update id : %s \n \r", $CustomerId);
				}
			}
			$num++;
		}
		
 }
 
 public function Release()
{
 $BASE_PATH_INFO = array(str_replace("system/", "", BASEPATH),  join('.', array('change'. version(),'log')));
  if( file_exists( join("", $BASE_PATH_INFO) ) )
 {
	$_lines = array( 
		'release' => 'Change And Release',
		'version' => file_get_contents(join("", $BASE_PATH_INFO))
	);
	
// ------------- show content page data --------------------------------------------
	
	$error=& load_class('Exceptions', 'core');
	$error->show_version_page($_lines, 'error_version');
 }
  return (bool)false;
}


// ======================= END CLASS ==================================

}

// END OF FILE
// location : ./application/controller/Auth.php
?>