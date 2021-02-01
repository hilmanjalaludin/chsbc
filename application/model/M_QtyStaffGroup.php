<?php
class M_QtyStaffGroup extends EUI_Model 
{


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

 
/*
 * @ def : constructor off class 
 * ----------------------------------
 *
 * @param : Unit Test 
 * @param : Unit Test 
 */

function __construct() {
	$this -> load->model(array('M_SysUser'));
}

/*
 * @ def : constructor off class 
 * ----------------------------------
 *
 * @param : Unit Test 
 * @param : Unit Test 
 */

 public function _getUnitTest()
 {
	echo "<h1 class='font-standars ui-corner-top ui-state-default' style='height:30px;padding-top:10px;'> Hello World </h1>";
 }
 
/*
 * @ def : constructor off class 
 * ----------------------------------
 *
 * @param : Unit Test 
 * @param : Unit Test 
 */

 
public function _getStaffAvailable()
{
	$_conds = $this -> M_SysUser -> _get_quality_staff();
	if( $this -> EUI_Session->_get_session('HandlingType')==USER_QUALITY_HEAD ) {
		$_conds  = $this -> M_SysUser -> _get_quality_staff($this -> EUI_Session->_get_session('UserId')); 
	}
	
	return  $_conds;
}


/*
 * @ def : constructor off class 
 * ----------------------------------
 *
 * @param : Unit Test 
 * @param : Unit Test 
 */

public function _getStaffSkill()
{
	$skill = array();
	
	$this -> db -> select('*');
	$this -> db -> from('t_lk_quality_skill');
	foreach( $this ->db -> get() ->result_assoc() as $rows )
	{
		$skill[$rows['Quality_Skill_Id']] = $rows['Quality_Skill_Desc'];
	}
	
	return $skill;
}


/*
 * @ def : constructor off class 
 * ----------------------------------
 *
 * @param : Unit Test 
 * @param : Unit Test 
 */

function _getQualitySkill()
{
	$arr_skill = array();
	
	if( !in_array( _get_session('HandlingType'), 
		array(USER_ADMIN, USER_ROOT) ))
	{  
		$this->db->reset_select();
		$this->db->select("Quality_Skill_Id", FALSE);
		$this->db->from('t_gn_quality_group');
		$this->db->where('Quality_Staff_id',_get_session('UserId'));
		$rs = $this->db->get();
		if( $rs->num_rows() > 0) 
			foreach( $rs->result_assoc() as $rows )
		{
			$arr_skill[(int)$rows['Quality_Skill_Id']] = (int)$rows['Quality_Skill_Id'];
		}
	} 
	else{
		$arr_skill = array(
			(int)QUALITY_APPROVE => (int)QUALITY_APPROVE,
			(int)QUALITY_SCORES => (int)QUALITY_SCORES
		);
	}
	return $arr_skill;
}


/*
 * @ def : constructor off class 
 * ----------------------------------
 *
 * @param : Unit Test 
 * @param : Unit Test 
 */

public function _getStaffByGroup( $out = null )
{

 $array_quality_group = array();
 $this -> db -> reset_select();
 $this -> db -> select("
		CONCAT(a.Quality_Group_Id,'|', a.Quality_Staff_id,'|', a.Quality_Skill_Id) as QualityIndexId, 
		a.Quality_Staff_id as Quality_Staff_id,
		a.Quality_Skill_Id as Quality_Skill_Id, 	
		a.Quality_Group_Id as Quality_Group_Id,
		c.id as QualityStaffUser,  
		c.full_name as QualityStaffName,
		d.id as QualityHeadUser,
		d.full_name as QualityHeadName, 
		b.Quality_Skill_Name, 
		b.Quality_Skill_Desc", false
	);
	
 $this ->db -> from("t_gn_quality_group a");
 $this ->db -> join("t_lk_quality_skill b ","a.Quality_Skill_Id=b.Quality_Skill_Id","LEFT");
 $this ->db -> join("tms_agent c ","a.Quality_Staff_id=c.UserId","LEFT");
 $this ->db -> join("tms_agent d ", "c.quality_id=d.UserId","LEFT");
 
// root on head of the staff 
 
 if(_get_session('HandlingType')==USER_QUALITY_HEAD ){
	$this ->db -> where("c.quality_id", $this -> EUI_Session->_get_session('UserId'));
 }
 
 // root on login 
 if(_get_session('HandlingType')==USER_ROOT ){
	$this->db->where("c.user_state", 1);
 }
 
 if(_get_have_post('Filter_Quality_Id') ){
	$this->db->where("a.Quality_Staff_id", $out->get_value('Filter_Quality_Id') );
 }
 
 if(_get_have_post('Filter_Skill_Id') ){
	$this->db->where("a.Quality_Skill_Id", $out->get_value('Filter_Skill_Id') );
 }

 	
// ---------- set order by 
	
  if( _get_have_post("orderby") ){
	 $this->db->order_by( $out->get_value("orderby"), $out->get_value("type"));
  } else {
	 $this->db->order_by("c.full_name", "ASC");
  }
  
  
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ){
	$array_quality_group= (array)$rs->result_assoc();
  }
return  $array_quality_group;
  
}



/*
 * @ def : constructor off class 
 * ----------------------------------
 *
 * @param : Unit Test 
 * @param : Unit Test 
 */
 
function _setAddAvailableSkill( $QualityStaffId = null )
{
	$_conds = 0;
	if( !is_null($QualityStaffId) 
	AND is_array($QualityStaffId) )
	{
		foreach( $QualityStaffId as $i => $QualityId )
		{
			$this -> db -> set('Quality_Staff_id',$QualityId);
			$this -> db-> set('Quality_Create_Ts', DATE('Y-m-d H:i:s'));
			$this -> db -> insert('t_gn_quality_group');
			
			if( $this -> db -> affected_rows()< 0 )
			{
				$this -> db-> where('Quality_Staff_id', $QualityId);
				$this -> db-> set('Quality_Create_Ts', DATE('Y-m-d H:i:s'));
				$this -> db -> update('t_gn_quality_group');
			}
			$_conds++;	
		}	
	
	}
	
	return $_conds;
}

 

/*
 * @ def : _setAssignQualitySkill 
 * ----------------------------------
 *
 * @ param : Quality_Group_Id  ( array )
 * @ param : Quality_Skill_Id  ( integer )
 */
 
 public function _setAssignQualitySkill( $out =null )
{   
  $_conds = 0;
  if( !$out->fetch_ready() ){
	return false;
  }
  
 // print_r($out);
  
  $arr_rows_data = $out->get_array_value('QualityIndexId');
  if(is_array( $arr_rows_data ) AND count( $arr_rows_data )   ) 
	  foreach( $arr_rows_data as $k => $data ) 
  { 
	$spl =&Spliter( $data, "|", array('Quality_Group_Id','Quality_Staff_id','Quality_Skill_Id'));
	if( $spl->fetch_ready() )
	{
		// ------- insert jika belum ada  -----------
			
		$this->db->reset_write();
		$this->db->set('Quality_Staff_id', $spl->get_value('Quality_Staff_id'));
		$this->db->set('Quality_Skill_Id', $out->get_value('Quality_Skill_Id'));
		$this->db->set('Quality_Create_Ts', date('Y-m-d H:i:s'));
		if( $this->db->insert('t_gn_quality_group') ){
			$_conds++;	
		} 
		else {
		
		// ---------- duplicate -----------------------------------
			$this->db->reset_write();
			$this->db->where('Quality_Group_Id',$spl->get_value('Quality_Group_Id'));
			$this->db->where('Quality_Staff_id',$spl->get_value('Quality_Staff_id'));
			
			$this->db->set('Quality_Skill_Id',$out->get_value('Quality_Skill_Id'));
			$this->db->set('Quality_Create_Ts', date('Y-m-d H:i:s'));
			$this->db->update("t_gn_quality_group");
			$_conds++;	
		}
	}	
  }
  return (int)$_conds;
}


/*
 * @ def : _setRemoveQualitySkill 
 * ----------------------------------
 *
 * @ param : Quality_Group_Id  ( array )
 * @ param : -
 */
 
function _setRemoveQualitySkill( $out = null )
{
	$_conds = 0;
  if( !$out->fetch_ready() ){
	return false;
  }
  
 // print_r($out);
  
  $arr_rows_data = $out->get_array_value('QualityIndexId');
  if(is_array( $arr_rows_data ) AND count( $arr_rows_data )   ) 
	  foreach( $arr_rows_data as $k => $data ) 
  { 
	
	$obj_val =&Spliter( $data, "|", array('Quality_Group_Id','Quality_Staff_id','Quality_Skill_Id'));
	if( $obj_val->fetch_ready() )
	{
		$this->db->reset_write();
		$this->db->where('Quality_Group_Id',$obj_val->get_value('Quality_Group_Id'));
		$this->db->where('Quality_Staff_id',$obj_val->get_value('Quality_Staff_id'));
		$this->db->where('Quality_Skill_Id',$obj_val->get_value('Quality_Skill_Id'));
		 if( $this->db->delete('t_gn_quality_group') ) 
		{
			$_conds++;	
		} 
	}	
  }
  return (int)$_conds;
}



/*
 * @ def : _setClearQualitySkill 
 * ----------------------------------
 *
 * @ param : Quality_Group_Id  ( array )
 * @ param : -
 */
 
function _setClearQualitySkill( $out = null )
{
		$_conds = 0;
  if( !$out->fetch_ready() ){
	return false;
  }
  
 // print_r($out);
  
  $arr_rows_data = $out->get_array_value('QualityIndexId');
  if(is_array( $arr_rows_data ) AND count( $arr_rows_data )   ) 
	  foreach( $arr_rows_data as $k => $data ) 
  { 
	
	$obj_val =&Spliter( $data, "|", array('Quality_Group_Id','Quality_Staff_id','Quality_Skill_Id'));
	if( $obj_val->fetch_ready() )
	{
		$this->db->reset_write();
		$this->db->set('Quality_Skill_Id',"NULL", false);
		$this->db->where('Quality_Group_Id',$obj_val->get_value('Quality_Group_Id'));
		$this->db->where('Quality_Staff_id',$obj_val->get_value('Quality_Staff_id'));
		$this->db->where('Quality_Skill_Id',$obj_val->get_value('Quality_Skill_Id'));
		 if( $this->db->update('t_gn_quality_group') ) 
		{
			$_conds++;	
		} 
	}	
  }
  return (int)$_conds;
}

  
//  STOP : Critical

}
	
?>
