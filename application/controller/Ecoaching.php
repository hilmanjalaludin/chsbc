<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for Ecoaching 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class Ecoaching extends EUI_Controller{

/*
 * load __construct
 */
 
function __construct()
{
	parent::__construct();
	$this->load->model(array('M_Ecoaching')); // load model user
	$this->load->helper(array('EUI_Object'));
}
/*
 * load first page load of the nav data 
 */
 
function index() 
{
	if( $this -> EUI_Session -> _have_get_session('UserId')) 
	{
		$page['page'] = $this -> M_Ecoaching -> get_default();
		$page['AOC'] = $this->_getAgentBySpv();
		$this -> load -> view("mod_e_coaching/view_coach_nav", $page);
	}
}


public function _getAgentBySpv () {
	$UserID = _get_session("UserId");
	$tele = array();
	if ( $UserID != "" AND !empty($UserID) ) {
		$getAgent = $this->db->query(
			"SELECT * FROM tms_agent a WHERE a.spv_id='$UserID' AND a.profile_id='4'"
		);
		// check agent
		if ( $getAgent == true AND $getAgent->num_rows() > 0 ) {
			foreach ( $getAgent->result() as $GA ) {
				$tele[$GA->UserId] = $GA->init_name;
			}
		}
	}

	return $tele;
}


/*
 * load first page load of the nav data 
 * @ content of page 
 */
 
function content()
{
	$page['page'] = $this -> M_Ecoaching -> get_resource_query(); // load content data by pages 
	$page['num']  = $this -> M_Ecoaching -> get_page_number(); 	// load content data by pages 
	if( is_array($page) && is_object($page['page']) ) 
	{
		$this -> load -> view("mod_e_coaching/view_coach_list", $page );
	}	
}

// User UserCapacity

function UserCapacity()
{
	$_result = array('success'=>0);
	
	$Configuration =& M_Configuration::get_instance();
	$Capacity = $this -> M_Ecoaching -> _getUserCapacity(1);
	$UserLimit = $Configuration -> _getUserLimit();
	
	
	 
	if( is_array($UserLimit))
	{
		$CapacityCount = (((INT)$UserLimit['USER_LIMIT'])+1);
		
		if( $this -> EUI_Session->_get_session('HandlingType')!=USER_ROOT )
		{
			if( $Capacity < $CapacityCount )
			{
				$_result = array('success'=>1);
			}
		}
		else{
			$_result = array('success'=>1);
		}	
	}
	
	echo json_encode($_result);
}


/**
 * [EditCoach description]
 */
public function EditCoachAgent () {
	$status_send = array( "success" => 0 , "message" => "" );

	$RequestData = _get_all_request();
	$RequestData = new EUI_Object($RequestData);

	$CoachingId          = $RequestData->get_value("CoachingId");     
	$DevRequired         = $RequestData->get_value("DevRequired");

	if ( _have_get_session("UserId") ) {
		// select coaching 
		$selectCoaching = $this->db->query(
			"SELECT * FROM t_gn_coaching a WHERE a.CoachingId='$CoachingId'"
		);
		if ( $selectCoaching->num_rows() > 0 ) {
			$this->db->set("DevRequired" , $DevRequired);
			$this->db->set("DevRequiredDate" , date("Y-m-d H:i:s"));
			$this->db->where("CoachingId" , $CoachingId );
			$this->db->update("t_gn_coaching");
			if ( $this->db->affected_rows() > 0 ) {
				$status_send = array( "success" => 1 , "message" => "Success Input Coaching!" );
			}
		}

	} else {
		$status_send = array( "success" => 0 , "message" => "You are not Login!" );
	}

	echo json_encode( $status_send );

	return $status_send;
}


public function EditCoachSpv () {
	$_getIdCoach = _get_all_request();
	$_getIdCoach = new EUI_Object($_getIdCoach);

	if ( $_getIdCoach != "" ) {
		$CoachingId = $_getIdCoach->get_value("CoachingId");
		$selectCoaching_s = $this->db->query(
			"SELECT * FROM t_gn_coaching a WHERE a.CoachingId='$CoachingId'"
		);
		if ( $selectCoaching_s == true AND $selectCoaching_s->num_rows() > 0 ) {
			$scs = $selectCoaching_s->row_array();
			$varData = array(
				"AOC" => $this->_getAgentBySpv() , 
				"Coach" => $scs
			);
			$this->load->view( "mod_e_coaching/view_edit_coaching_spv" , $varData );
		} 
	} else {

	}
}
	
/**
 * [DeleteCoach description]
 */
public function DeleteCoach () {
	$status_send = array( "success" => 0 );
	$RequestData = _get_all_request();
	if ( is_array($RequestData) ) {
		$RequestData = new EUI_Object($RequestData);
		$CoachingId = $RequestData->get_value("CoachingId");
		$this->db->where("CoachingId" , $CoachingId);
		$this->db->delete("t_gn_coaching");
		if ( $this->db->affected_rows() > 0 ) {
			$status_send = array( "success" => 1 );
		}
	}

	echo json_encode($status_send);
}

/**
 * [SendCoach description]
 */
public function SendCoach () {
	$status_send = array( "status" => 0 , "message" => "Failed Insert!" );
	$RequestData = _get_all_request();
	$RequestData = new EUI_Object($RequestData);

	$AgentId          = $RequestData->get_value("AgentId");     
	$Periode          = $RequestData->get_value("Periode");
	$CoachingDate     = $RequestData->get_value("CoachingDate");
	$NotePrevCoach    = $RequestData->get_value("NotePrevCoach");
	$DiscussionPoint  = $RequestData->get_value("DiscussionPoint");
	$CoachingType     = $RequestData->get_value("CoachingType");


	if ( _have_get_session("UserId") ) {
		$this->db->set("AgentId" , $AgentId);
		$this->db->set("SpvId" , _get_session("UserId") );
		$this->db->set("Periode" , $Periode );
		$this->db->set("CoachingDate" , $CoachingDate);
		$this->db->set("NotePrevCoach" , $NotePrevCoach);
		$this->db->set("DiscussionPoint" , $DiscussionPoint);
		$this->db->set("CoachingType" , $CoachingType);
		$this->db->set("DateCreated" , date('Y-m-d'));
		$this->db->insert("t_gn_coaching");
		
		if ( $this->db->affected_rows() > 0 ) {
			$status_send = array( "success" => 1 , "message" => "Success Input Coaching!" );
		}
	} else {
		$status_send = array( "success" => 0 , "message" => "You are not Login!" );
	}

	echo json_encode( $status_send );
}


/**
 * [SendCoach description]
 */
public function SendCoachEdit () {
	$status_send = array( "status" => 0 , "message" => "Failed Insert!" );
	$RequestData = _get_all_request();
	$RequestData = new EUI_Object($RequestData);

	$AgentId          = $RequestData->get_value("AgentId");     
	$Periode          = $RequestData->get_value("Periode");
	$CoachingDate     = $RequestData->get_value("CoachingDate");
	$NotePrevCoach    = $RequestData->get_value("NotePrevCoach");
	$DiscussionPoint  = $RequestData->get_value("DiscussionPoint");
	$CoachingType     = $RequestData->get_value("CoachingType");
	$CoachingId       = $RequestData->get_value("CoachingId");

	if ( _have_get_session("UserId") ) {
		$this->db->set("AgentId" , $AgentId);
		//$this->db->set("SpvId" , _get_session("UserId") );
		$this->db->set("Periode" , $Periode );
		$this->db->set("CoachingDate" , $CoachingDate);
		$this->db->set("NotePrevCoach" , $NotePrevCoach);
		$this->db->set("DiscussionPoint" , $DiscussionPoint);
		$this->db->set("CoachingType" , $CoachingType);
		$this->db->where("CoachingId" , $CoachingId);
		$this->db->update("t_gn_coaching");

		if ( $this->db->affected_rows() > 0 ) {
			$status_send = array( "success" => 1 , "message" => "Success Input Coaching!" );
		}
	} else {
		$status_send = array( "success" => 0 , "message" => "You are not Login!" );
	}

	echo json_encode( $status_send );
}




// ================================== END  CLASS ================================

}

// END OF FILE 
// location : ./application/controller/Ecoaching.php
?>