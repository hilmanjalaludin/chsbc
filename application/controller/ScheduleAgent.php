<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for Ecoaching 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class ScheduleAgent extends EUI_Controller{

/*
 * load __construct
 */
 
function __construct()
{
	parent::__construct();
	$this->load->model(array('M_ScheduleAgent')); // load model user
	$this->load->helper(array('EUI_Object','date'));
}


/**
 * [SetSchedule description]
 * Save Set Schedule 
 */
public function SetSchedule () {
	$status_send = array("success" => 0 , "message" => '');
	$_data_insert = _get_all_request();
	if ( is_array($_data_insert) ) {
		$_data_insert = new EUI_Object($_data_insert);
			$AgentId      = $_data_insert->get_value("AgentId"); 
			$Username     = $_data_insert->get_value("Username");
			$FullName     = $_data_insert->get_value("FullName");
			$DateSchedule = $_data_insert->get_value("DateSchedule"); 
			$DayName      = $_data_insert->get_value("DayName"); 
			$StartTime    = $_data_insert->get_value("StartTime");
			$EndTime      = $_data_insert->get_value("EndTime"); 
			$ReasonId     = $_data_insert->get_value("ReasonId");
		// we will set to insert t_gn_setschedule_agent
		$this->db->set("AgentId"  ,  $AgentId);
		$this->db->set("SpvId"    , _get_session("UserId") );
		$this->db->set("Username" ,  $Username);
		$this->db->set("FullName" , $FullName);
		$this->db->set("DateSchedule" , $DateSchedule);
		$this->db->set("DayName" , $DayName);
		$this->db->set("StartTime" , $StartTime);
		$this->db->set("EndTime" , $EndTime);
		$this->db->set("ReasonId" , $ReasonId);
		$this->db->set("CreateById" , _get_session("UserId") );
		$this->db->insert_on_duplicate("t_gn_setschedule_agent");

		if ( $this->db->affected_rows() > 0 ) {
			$status_send = array( "success" => 1 , "message" => "Success set Schedule!" );	
		} 
	}

	echo json_encode($status_send);
}


/*
 * load first page load of the nav data 
 */
 
function index() 
{
	if( $this -> EUI_Session -> _have_get_session('UserId')) 
	{
		$page['page'] = $this -> M_ScheduleAgent -> get_default();
		$page['AOC']  = $this->_getAgentBySpv();
		$this -> load -> view("mod_schedule_agent/view_schedule_nav", $page);
	}
	
	//echo days_name_bydate('datenow');
}

public function generateDate ( $date_gen = '' , $agentId = "" ) {
	if ( $date_gen != '' ) {
		$qt = 32;
		$date_explode = explode("-",$date_gen);
		$month_gen = $date_explode[0];
		$generate_schedule = $date_explode[1]."-".$date_explode[0]."-01";
		//$generate_schedule = "2016-09-01";
		// create a time stamp of the date
		$time = strtotime($generate_schedule);
		for($i=0; $i< $qt; $i++) {
		    // convert timestamp back to date string
		    $date_of_month = date('Y-m-d', $time);
		    $month_of_date = date('m', $time);
		    $due_dates[] = $date;
		    // move to next timestamp
		    $time = strtotime('+1 day', $time);
		    if ( $month_gen == $month_of_date ) {
		    	$selectdate_set_schedule = $this->db->query(
		    		"SELECT * FROM t_gn_setschedule_agent a WHERE a.DateSchedule='$date_of_month' and a.AgentId='$agentId'"
		    	);
		    	if ( $selectdate_set_schedule->num_rows() > 0 ) {
		    		$ssc = $selectdate_set_schedule->row();
		    		//print_r(GetReasonSchedule($ssc->ReasonId));
		    		$append_time = '
		    				<tr class="param_value_addschedule">
								<td class="text_caption">'.$ssc->DateSchedule.'</td> 
								<td class="text_caption">'.days_name_bydate($ssc->DateSchedule).'</td> 
								<td class="text_caption">'.GetReasonSchedule($ssc->ReasonId).'</td> 
								<td class="text_caption">'.setScheduleTime($ssc->StartTime , 'default').'</td> 
								<td class="text_caption">'.setScheduleTime($ssc->EndTime , 'default').'</td> 
							</tr>
						';

		    	} else {
		    		$append_time = '
		    				<tr class="param_value_addschedule">
								<td class="text_caption">'.$date_of_month.'</td> 
								<td class="text_caption">'.days_name_bydate($date_of_month).'</td> 
								<td class="text_caption"> </td> 
								<td class="text_caption">'.setScheduleTime( days_name_bydate($date_of_month) , 'start' ).'</td> 
								<td class="text_caption">'.setScheduleTime( days_name_bydate($date_of_month) , 'end' ).'</td> 
							</tr>
						';
		    	}
				echo $append_time;
		    }
		}
	} else {
		// return false;
	}
}


public function getAgent ( $UserID = "" ) {
	$return_data = array( "UserId" => 'undefined' , "full_name" => 'undefined' , "ID" => 'undefined' );
	if ( $UserID != '' ) {
		$selectAgent = $this->db->query("SELECT *FROM tms_agent a WHERE a.UserId='$UserID'");
		if ( $selectAgent == true AND $selectAgent->num_rows() > 0 ) {
			$rowAgent = $selectAgent->row();
			$return_data = array( "UserId" => $rowAgent->full_name , "full_name" => $rowAgent->full_name , "ID" => $rowAgent->id  );
		} 
	} 
	echo json_encode($return_data);
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
	$page['page'] = $this -> M_ScheduleAgent -> get_resource_query(); // load content data by pages 
	$page['num']  = $this -> M_ScheduleAgent -> get_page_number(); 	// load content data by pages 
	if( is_array($page) && is_object($page['page']) ) 
	{
		$this -> load -> view("mod_schedule_agent/view_schedule_list", $page );
	}	
}

// User UserCapacity

function UserCapacity()
{
	$_result = array('success'=>0);
	
	$Configuration =& M_Configuration::get_instance();
	$Capacity = $this -> M_ScheduleAgent -> _getUserCapacity(1);
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






// ================================== END  CLASS ================================

}

// END OF FILE 
// location : ./application/controller/SheduleAgent.php
?>