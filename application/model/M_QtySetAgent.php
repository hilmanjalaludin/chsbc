<?php

/*
 * @ def : default read of controller  
 * -----------------------------------------------------------------
 *
 * @ params : Unit test notes
 * @ params : 
 */
 
class M_QtySetAgent extends EUI_Model
{

 var $perpage = 10;

// -----------------------------------------------------------------
/*
 * @ package 	 default read of controller  
 * @ params		 test parameter 
 */
 
 private static $Instance   = null; 
 public static function &Instance()
{
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
 }

 
// ----------------------------------------------------------------
/*
 * @ package 	 default read of controller  
 * @ params		 test parameter 
 */
 
 function __construct(){ }
 
// ----------------------------------------------------------------
/*
 * @ package 	 default read of controller  
 * @ params		 test parameter 
 */
 
 
 function _select_set_agent_page( $out = null )
{
 
// --------- agent was assing to QA  
 $arr_agent_quality =& $this->_select_agent_row_quality();
 
// -------- then next of process 
 $arr_set_agent_page = array();
 $this->db->select("a.*, (SELECT c.full_name FROM tms_agent c WHERE c.UserId=a.tl_id) as SpvName");
 $this->db->from("tms_agent a");
 $this->db->join("tms_agent_profile b ", "a.profile_id=b.id","LEFT");
 $this->db->where_in("b.id", array(USER_AGENT_INBOUND, USER_AGENT_OUTBOUND) );
 $this->db->where("a.user_state",1);
	
// --------- not in Assign  
 if( is_array($arr_agent_quality) 
	AND count($arr_agent_quality) > 0 )
{
	$this->db->where_not_in('a.UserId',$arr_agent_quality);
 }
	
// ----------- on filter 
 if( _get_have_post('key_agent_name') ){
	$this->db->like("a.full_name", $out->get_value('key_agent_name') );
 
 }
 
// ----------- on filter 
 if( _get_have_post('key_leader_id') ){
	$this->db->like("a.tl_id", $out->get_value('key_leader_id') );
 }
	 
	

	
// ---------- set order by 
	
  if( _get_have_post("orderby") ){
	 $this->db->order_by(_get_post("orderby"), _get_post("type"));
  } else {
	 $this->db->order_by("a.full_name", "ASC");
  }
  
  //$this->db->print_out();
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ){
	$arr_set_agent_page= (array)$rs->result_assoc();
  }
  
  return (array)$arr_set_agent_page;
}


/*
 * @ def : default super class   
 * ------------------------------------------
 *
 * @ params : Unit test notes
 * @ params : 
 */	
 
 private function _select_agent_row_quality()
{
  
  $arra_assing_agent = array();
  $this->db->reset_select();
  $this->db->select("a.Agent_User_Id");
  $this->db->from("t_gn_quality_agent a");
  
  
  $rs = $this->db->get();
   if( $rs->num_rows() > 0 )
	   foreach( $rs->result_assoc() as $rows )  
  {
	$arra_assing_agent[$rows['Agent_User_Id']] = $rows['Agent_User_Id']; 
  }
  
 return (array)$arra_assing_agent;
	
}	

// -----------------------------------------------------------------------------------------
/*
 * @ pakage 		move agent to bucket quakity by user add 
 * @ notes 			please select checkbox data .
 * 
 */
 
 
 public function _select_set_quality_page( $out  = null )
{
  $arr_quality_state = array();
  $this->db->reset_select();
  $this->db->select("
		a.Id as QualityAgentId, c.full_name as SpvName, c.id as SpvId, b.id,  b.full_name as AgentName, 
		d.full_name as QualityName, d.id as QualityCode, d.UserId as QualityId", FALSE);
		
  $this->db->from("t_gn_quality_agent a");
  $this->db->join("tms_agent b", "a.Agent_User_Id=b.UserId","LEFT");
  $this->db->join("tms_agent c", "c.UserId=b.spv_id","LEFT");
  $this->db->join("tms_agent d", "d.UserId=a.Quality_Staff_Id","LEFT");
 
// --- cek data available  --------------
 
  if(_get_have_post('quality_staff_id')) {
	$this->db->where("a.Quality_Staff_Id",$out->get_value('quality_staff_id'));	
 }

 if( _get_have_post('hidden_ready') AND $out->get_value('hidden_ready')  == 1 ) {
	$this->db->where("a.Quality_Staff_Id IS NULL");
 }


 if(_get_have_post('AgentName')) {
	$this->db->like("b.full_name",$out->get_value('AgentName'));
 }

	
// ---------- set order by 
	
  if( _get_have_post("orderby") ){
	 $this->db->order_by( $out->get_value("orderby"), $out->get_value("type"));
  } else {
	 $this->db->order_by("b.full_name", "ASC");
  }
  
  # $this->db->print_out(); 
  
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ){
	$arr_quality_state= (array)$rs->result_assoc();
  }
  
  return (array)$arr_quality_state;

}

/*
 * @ def : default super class   
 * ------------------------------------------
 *
 * @ params : Unit test notes
 * @ params : 
 */	

function _setAddAvailableAgent($UserId = null )
{
	$conds = 0;
	if( !is_null($UserId))
	{
		foreach( $UserId as $key => $UsersId )
		{
			$this -> db ->reset_write();	
			$this -> db ->set('Agent_User_Id',$UsersId);
			$this -> db ->set('Create_Group_Ts',date('Y-m-d H:i:s'));
			$this -> db ->set('Create_Group_By', _get_session('UserId'));
			$this -> db ->insert('t_gn_quality_agent');
			
			if($this -> db ->affected_rows() < 1 ) 
			{
				$this -> db ->set('Create_Group_Ts',date('Y-m-d H:i:s'));
				$this -> db ->set('Create_Group_By', _get_session('UserId'));
				$this -> db ->where('Agent_User_Id',$UsersId);
				$this -> db ->update('t_gn_quality_agent');
			}
			$conds++;
		}
	}
	
	return $conds;
}

/*
 * @ def : default super class   
 * ------------------------------------------
 *
 * @ params : Unit test notes
 * @ params : 
 */	

function _setUpdateQualityAgent($QualityAgentId = null, $QualityStaffId = null )
{
	$conds = 0;
	if( !is_null($QualityAgentId) AND !is_null($QualityStaffId) )
	{
		foreach( $QualityAgentId as $key => $Id )
		{
			$this -> db -> where('Id',$Id);
			$this -> db -> set('Quality_Staff_Id',$QualityStaffId);
			$this -> db -> set('Create_Group_Ts',date('Y-m-d H:i:s'));
			$this -> db -> set('Create_Group_By', $this ->EUI_Session -> _get_session('UserId'));
			if( $this -> db -> Update('t_gn_quality_agent') ){
				$conds++;
			}	
		}
	}
	
	return $conds;
}

/*
 * @ def : default super class   
 * ------------------------------------------
 *
 * @ params : Unit test notes
 * @ params : 
 */	

function _setRemoveQualityAgent($QualityAgentId = null)
{
	$conds = 0;
	if( !is_null($QualityAgentId))
	{
		foreach( $QualityAgentId as $key => $Id )
		{
			$this -> db -> where('Id',$Id);
			$this -> db -> set('Create_Group_Ts',date('Y-m-d H:i:s'));
			$this -> db -> set('Create_Group_By', $this ->EUI_Session -> _get_session('UserId'));
			if( $this -> db -> delete('t_gn_quality_agent') ){
				$conds++;
			}	
		}
	}
	
	return $conds;
}

/*
 * @ def : default super class   
 * ------------------------------------------
 *
 * @ params : Unit test notes
 * @ params : 
 */	

 public function _select_row_quality_score_register()
{
 $Quality = array();
 $this -> db->reset_select();
 $this -> db->select("a.Quality_Staff_id");
 $this -> db->from("t_gn_quality_group a");
 $this -> db->where("a.Quality_Skill_Id",QUALITY_SCORES);
 
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 )
	foreach( $rs->result_assoc() as $rows )
{
	$Quality[$rows['Quality_Staff_id']]= $rows['Quality_Staff_id'];  
 }
	
return (array)$Quality;
	
}


/*
 * @ def : default super class   
 * ------------------------------------------
 *
 * @ params : Unit test notes
 * @ params : 
 */	

function _setEmptyQualityAgent( $out  = null )
{
 $conds = 0;
 if( !$out->fetch_ready()) {
	return FALSE;	
 }
 
 $QualityAgentId =& $out->get_array_value('QualityAgentId');
 if( is_array($QualityAgentId) 
	 AND count( $QualityAgentId ) > 0 )
	 foreach( $QualityAgentId as $key => $Id )
 {
	$this->db->reset_write();
	$this->db->where('Id',$Id);
	$this->db->set('Quality_Staff_Id','NULL',FALSE);
	if( $this->db-> update('t_gn_quality_agent') ) {
		$conds++;
	}	
 }

 return $conds;	
	
}

// ================================ END CLASS ==============================================================
}

?>