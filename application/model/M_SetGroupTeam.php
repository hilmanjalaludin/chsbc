<?php 
class M_SetGroupTeam extends EUI_Model 
{

private static $where = null;
private $perpage = 10;


function M_SetGroupTeam(){ 
	self::$where = array('GroupId');
	
}

 
 
/* default : of the model index **/
 
public function _get_default()  
{
	$this->EUI_Page->_setPage(10); 
	$this->EUI_Page->_setQuery("
				SELECT  a.GroupId, count(c.GroupTeamId) as capacity 
				FROM t_gn_group_call a 
				LEFT JOIN t_lk_outbound_goals b on a.OutboundGoalId=b.OutboundGoalsId
				LEFT JOIN t_gn_group_team c on a.GroupId=c.GroupCallId ");
 
	if( $this->URI->_get_have_post('keywords'))
	{
		$keywords = $this -> URI -> _get_post("keywords");
		$this -> EUI_Page -> _setWhere(" AND ( a.Field_Id LIKE '%$keywords%' 
							OR a.Field_Header LIKE '%$keywords%' 
							OR a.Field_Columns LIKE '%$keywords%' 
							OR a.Field_Active LIKE '%$keywords%'  
							OR a.Field_Create_Ts LIKE '%$keywords%' 
							OR a.Field_Create_UserId LIKE '%$keywords%' 
						   )");
	}				
			
	$this->EUI_Page->_setWhere( $filter );   
	$this->EUI_Page->_setGroupBy('a.GroupId');
	
	if( $this->EUI_Page->_get_query())
	{
		return $this -> EUI_Page;
	}
}


/* default : of the model index **/

public function _get_content()
{
	$this->EUI_Page->_postPage( $this -> URI -> _get_post('v_page') );
	$this->EUI_Page->_setPage(10);
	$this->EUI_Page->_setQuery("
				SELECT  a.*, count(c.GroupTeamId) as UserCapacity , b.Name as Direction
				FROM t_gn_group_call a 
				LEFT JOIN t_lk_outbound_goals b on a.OutboundGoalId=b.OutboundGoalsId
				LEFT JOIN t_gn_group_team c on a.GroupId=c.GroupCallId
			");
	
	if( $this->URI->_get_have_post('keywords'))
	{
		$keywords = $this->URI->_get_post("keywords");
		$this->EUI_Page->_setWhere(" AND ( a.Field_Id LIKE '%$keywords%' 
							OR a.Field_Header LIKE '%$keywords%' 
							OR a.Field_Columns LIKE '%$keywords%' 
							OR a.Field_Active LIKE '%$keywords%'  
							OR a.Field_Create_Ts LIKE '%$keywords%' 
							OR a.Field_Create_UserId LIKE '%$keywords%' 
						   )");
	}	
	
	$this -> EUI_Page -> _setWhere(); 
	if($this->URI->_get_have_post('order_by')) {
		$this->EUI_Page->_setOrderBy($this->URI->_get_post('order_by'), $this->URI->_get_post('type') );
	}
	
	$this->EUI_Page->_setGroupBy('a.GroupId');
	
	$this-> EUI_Page->_setLimit();
}

/* default : of the model index **/

public function _get_resource()
 {
	self::_get_content();
	if($this->EUI_Page->_get_query()!='')
	{
		return $this->EUI_Page->_result();
	}	
 }
 
/* default : of the model index **/

public function _get_page_number() 
 {
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
 
 
/* _setSaveAddGroupTeam **/

function _setSaveAddGroupTeam( $param = null )
{
	$_conds = 0;
	if( !is_null( $param) )
	{
		foreach( $param as $fields => $values ) {
			$this->db->set($fields, $values);
		}
		
		$this ->db->set('OutboundGoalId',1);
		$this ->db->insert("t_gn_group_call");
		if( $this ->db->affected_rows() > 0 )
		{
			$_conds++;	
		}
	}

	return $_conds;	
}

/* _setSaveEditGroupTeam **/

function _setSaveEditGroupTeam( $param = null )
{
 $_conds = 0;
	if( !is_null( $param) )
	{
		foreach( $param as $fields => $values ) 
		{
			if( in_array( $fields, self::$where ) ) 
				$this ->db->where($fields,$values);
			else
				$this->db->set($fields, $values);
		}
		
		$this ->db->update("t_gn_group_call");
		if( $this ->db->affected_rows() > 0 )
		{
			$_conds++;	
		}
	}

	return $_conds;	
}


/* _getGroupCall **/

function _getGroupCall( $GroupId  = 0 )
{

 $rows_select = array();
 
	$this -> db ->select('*');
	$this -> db ->from('t_gn_group_call');
	$this -> db ->where('GroupId', $GroupId);
	if( $rows = $this -> db -> get() -> result_first_assoc() )
	{
		$rows_select = $rows;
	}
	
	return $rows_select;
}

/* _setDeleteGroupTeam **/

function _setDeleteGroupTeam( $GroupId = null )
{
	$_conds = 0;
	if( !is_null($GroupId) )
	{
		foreach($GroupId as $key => $ID )
		{ 
			$this ->db->where('GroupCallId', $ID);
			if( $this ->db ->delete('t_gn_group_team') )
			{
				$this ->db->where('GroupId', $ID);
				if( $this ->db->delete('t_gn_group_call') )
				{
					$_conds++;
				}
				
			}
			
		}
		
	}
	
	return $_conds;
	
}

/* _getUserTeam **/
function _getUserTeam($GroupId = 0 )
{

 $data = array();
 
	
	$this ->db->select('b.full_name');
	$this ->db->from('t_gn_group_team  a ');
	$this ->db->join('tms_agent b ',' a.GroupUserId=b.UserId','LEFT');
	$this ->db->where('a.GroupCallId', $GroupId);
	$this ->db->order_by('b.full_name','ASC');
	
	$i = 0;
	foreach( $this -> db -> get() -> result_assoc() as $rows )
	{
		$data[$i] = $rows;
			$i++;
	}
	
	return $data;
	 

}

/** get record Page **/

public function _getPage() 
{
 
 $pages = array();
 
 $rs = self::_getRecords();	
 $page = ceil( $rs / $this -> perpage);
 
 for( $p = 1; $p<=$page; $p++ ) 
 {
	$pages[$p] = $p;	
 }
 
 return $pages;
 
}

/** get record agent **/
public function _getRecords()
{
  $count = 0;

  $this->db->select("COUNT(a.UserId) as jumlah ", FALSE);
  $this->db->from("tms_agent a ");
  
  /* get keywords searching data **/
 
  if( $this -> URI->_get_have_post('keyword') ){
	$this ->db->like('a.full_name', $this->URI->_get_post('keyword') );
  }
	
 $this ->db ->where_not_in('a.handling_type', array(USER_ROOT,USER_QUALITY_STAFF, USER_ADMIN, USER_QUALITY_HEAD));	
  if( $rows = $this->db->get() -> result_first_assoc() ) {
	$count = (INT)$rows['jumlah'];
  }
	
  return $count;
	
}


/* get records List **/

public function _getRecordAgentList()
{

 $start = 0; $content = array();
 
 $this->db->select("a.UserId, a.full_name");
 $this->db->from("tms_agent a ");
 
 /* get keywords searching data **/
 
 if( $this -> URI->_get_have_post('keyword') ){
	$this ->db->like('a.full_name', $this->URI->_get_post('keyword') );
 }

 $this ->db ->where_not_in('a.handling_type', array(USER_ROOT,USER_QUALITY_STAFF, USER_ADMIN, USER_QUALITY_HEAD));	
 
/* limiter data list **/
 
 $this->db->order_by("a.full_name","ASC");
  
 if( $this -> URI->_get_have_post('page')) {
		if((INT)_get_post('page')> 0 )
			$start = (( ((INT)_get_post('page')) -1 ) * $this->perpage );
		else
			$start = 0;
   }	
   
   $this -> db -> limit($this -> perpage,$start); 
   $num = $start+1;
   foreach($this -> db -> get() -> result_assoc() as $agents ) {
		$content[$num] = $agents;	
		$num++;
   }
   
   return $content;
}



/** function getGroup Team */

public function _getUserGroupTeam()
{
    $content  = array();
	
	$GroupId  = $this -> URI->_get_post('GroupId');
	$this -> db ->select("*");
	$this -> db ->from("t_gn_group_team a ");
	$this -> db ->join("tms_agent b ", "a.GroupUserId=b.UserId", "LEFT");
	$this -> db ->where("GroupCallId", $GroupId);
	
	foreach( $this -> db ->get() ->result_assoc() as  $rows )
	{
		$content[$rows['GroupTeamId']] = $rows;
	}
	
	return $content;
}


/** function getGroup Team */

public function _getLabelGroupTeam()
{
    $labels  = null;
	$GroupId  = $this -> URI->_get_post('GroupId');
	$this -> db ->select("*");
	$this -> db ->from("t_gn_group_call a ");
	$this -> db ->where("a.GroupId", $GroupId);
	
	if($rows = $this -> db ->get()->result_first_assoc() )
	{
		$labels = $rows['GroupDescription'];
	}
	
	return $labels;
}

/** function getGroup Team */
public function _setAddUserUserGroup()
{
	$count = 0;
	$GroupId = $this -> URI->_get_post('GroupId');
	$UserId = $this -> URI->_get_array_post('UserId');
	
	foreach( $UserId as $key => $ID )
	{
		$this -> db -> set('GroupCallId', $GroupId);
		$this -> db -> set('GroupLeaderId',1);
		$this -> db -> set('GroupUserId',$ID); 
		$this -> db -> set('GroupCreateTs',date('Y-m-d H:i:s'));
		$this -> db -> set('GroupCreteUserId',$this->EUI_Session->_get_session('UserId')); 
		$this -> db -> set('GroupTeamFlags', 1);
		
		$this -> db -> insert("t_gn_group_team");
		if( $this -> db ->affected_rows() > 0 )
		{
			$count++;		
		}
	}
	
	return $count;
}

// _setRemoveUserUserGroup

public function _setRemoveUserUserGroup()
{
	$GroupTeamId = $this->URI->_get_array_post('GroupTeamId');
	foreach( $GroupTeamId as $key => $ID )
	{
		$this ->db->where('GroupTeamId', $ID);
		if( $this -> db -> delete("t_gn_group_team"))
		{
			$count++;		
		}
	}
	
	return $count;

}


}

?>