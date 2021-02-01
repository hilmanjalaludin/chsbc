<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysMenuGroup  
 * 			  extends under model class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysmenugroup/
 */
 
class M_SysMenuGroup extends EUI_Model
{
 
// @ constructor 
 function __construct()
 {
	$this -> load -> Model('M_Loger');
 }
 
// @ _get_default();

function _get_default()
{
	$this -> EUI_Page -> _setPage(10); 
	$this -> EUI_Page -> _setQuery( "SELECT* FROM tms_group_menu a"); 
	
		
	$filter = '';
	if( $this ->URI -> _get_have_post('keywords')){
		$filter = " AND ( a.GroupId LIKE '%{$this->URI->_get_post('keywords')}%' 
					 OR a.GroupName LIKE '%{$this->URI->_get_post('keywords')}%' 
					 OR a.GroupShow LIKE '%{$this->URI->_get_post('keywords')}%' 
					 OR a.GroupDesc LIKE '%{$this->URI->_get_post('keywords')}%' 
					 OR a.CreateDate LIKE '%{$this->URI->_get_post('keywords')}%' 
					 OR a.UserCreate LIKE '%{$this->URI->_get_post('keywords')}%'
					 ) ";
					
	}
	$this -> EUI_Page->_setWhere( $filter );
	if( $this -> EUI_Page -> _get_query() ) 
	{
		return $this -> EUI_Page;
	}
}

// @ _get_content

function _get_content()
{
	$this -> EUI_Page->_postPage( $this -> URI -> _get_post('v_page') );
	$this -> EUI_Page->_setPage(10);
	
	$conds1 = " IF( a.GroupShow=1,'Active','Unactive') as status,  ";
	// mode mssql
	if( QUERY == 'mssql') {
		$conds1 = " CASE WHEN a.GroupShow=1 THEN 'Active' ELSE 'Unactive' END AS status, ";
	}

	$sql = " SELECT a.GroupId, a.GroupName, {$conds1}
			 a.GroupDesc, a.CreateDate, a.UserCreate
			 FROM tms_group_menu a ";
	
	$this -> EUI_Page ->_setQuery($sql);
	
	$filter = '';
	if( $this ->URI -> _get_have_post('keywords')){
		$filter = " a.GroupId LIKE '%{$this->URI->_get_post('keywords')}%' 
					 OR a.GroupName LIKE '%{$this->URI->_get_post('keywords')}%' 
					 OR a.GroupShow LIKE '%{$this->URI->_get_post('keywords')}%' 
					 OR a.GroupDesc LIKE '%{$this->URI->_get_post('keywords')}%' 
					 OR a.CreateDate LIKE '%{$this->URI->_get_post('keywords')}%' 
					 OR a.UserCreate LIKE '%{$this->URI->_get_post('keywords')}%'
					";
					
	}
	$this -> EUI_Page->_setWhere( $filter );

	if( $this ->URI -> _get_have_post('order_by')){
		$this -> EUI_Page->_setOrderBy($this ->URI -> _get_post('order_by'),$this ->URI -> _get_post('type'));
	} else {
		$this -> EUI_Page->_setOrderBy('a.GroupId');
	}
	$this -> EUI_Page->_setLimit();

}

/*
 * @ get buffering query from database
 * @ then return by object type ( resource(link) ); 
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
 * @ get number record & start of number every page 
 * @ then result ( INT ) type 
 */
 
function _get_page_number() 
 {
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
 
/*
 * @ get menu group all
 */ 
 
 function _get_menu_group()
 {
	$_data = array();
	$this -> db -> select('a.GroupId, a.GroupName');
	$this -> db -> from('tms_group_menu a');
	
	foreach( $this -> db -> get() -> result_assoc() as $rows ) {
		$_data[$rows['GroupId']] = $rows['GroupName'];
	}
	
	return $_data;
 
 }
 
/* @ get group menu name **/ 

function _get_menu_group_name( $GroupMenuId =0 )
{
	$_name = '';
	$sql = "SELECT a.GroupName FROM tms_group_menu  a WHERE a.GroupId='$GroupMenuId'";	
	$qry = $this -> db -> query($sql);
	if( !$qry -> EOF() )
	{
		$_name = $qry -> result_singgle_value();
	}
	return $_name;
}
 
/* @ get group menu by handle **/

function _get_group_menu( $handlingTypeId=0 )
{
	$_conds = array();
	$sql = " SELECT a.menu_group FROM tms_agent_profile a  WHERE a.id= '$handlingTypeId'";
	$qry = $this -> db -> query($sql);
	
	if( !$qry -> EOF() ) {
		$_conds = explode(',',$qry -> result_singgle_value());
	}
	
	return $_conds;
} 

// @ list group menu **/

function _get_list_group_menu( $Privileges )
{
	$_list_data = array();
	$_list_group = self::_get_group_menu( $Privileges );
	foreach( $_list_group as $k => $_listId ) {
		$_list_data[$_listId] = self::_get_menu_group_name($_listId);
	}
	
	return $_list_data;
}

// _getGroupMenu

function _getGroupMenu( $GroupId=0 )
{
	$this -> db -> select('*');
	$this -> db -> from('tms_group_menu');
	$this -> db -> where('GroupId',$GroupId);
	
	if( $rows = $this ->db->get()->result_first_assoc() ){
		return $rows;
	}
	else
		return array();
}




// @ _set_remove_group_menu 

function _set_remove_group_menu( $Privileges, $GroupMenuId )
{
	$_conds = false;
	
	if((is_array($GroupMenuId)) && ( $Privileges!='' ))
	{
		$_get_group_menu = self::_get_group_menu($Privileges);
		
		$_list_menu = array();
		foreach( $_get_group_menu as $k => $MenuId )
		{
			if(!in_array($MenuId,$GroupMenuId))
			{
				$_list_menu[$MenuId] = $MenuId;
			}
		}
		
		$this -> db -> where('id',$Privileges);
		if( $this -> db -> update('tms_agent_profile', array('menu_group'=> implode(',', $_list_menu) )) )
		{
			$this -> M_Loger -> set_activity_log("Remove Group Menu ::".implode(',',$_list_menu));
			$_conds = true;
		}
	}
	
	return $_conds;
	
}

//@ _set_assign_group_menu

function _set_assign_group_menu( $Privileges, $GroupMenuId )
{
	$_conds = false;
	
	if((is_array($GroupMenuId)) && ( $Privileges!='' ))
	{
		$_array_group_menu = self::_get_group_menu($Privileges);
		$_array_merge = array_merge((array)$_array_group_menu, (array)$GroupMenuId);
		
		$this -> db -> where('id',$Privileges);
		if( $this -> db -> update('tms_agent_profile', array('menu_group'=> implode(',',$_array_merge) )) )
		{
			$this -> M_Loger -> set_activity_log("Assign Group Menu ::".implode(',',$_array_merge));
			$_conds = true;
		}
	}
	
	return $_conds;
	
}

// @ _set_save_group_menu

function _set_save_group_menu( $GroupName, $GroupDescription )
{
	$_conds = false;
	
	if( $this -> db -> insert('tms_group_menu', 
		array(
			'GroupName'  => $GroupName, 
			'GroupDesc'  => $GroupDescription, 
			'CreateDate' => $this -> EUI_Tools -> _date_time(), 
			'UserCreate' => $this -> EUI_Session -> _get_session('UserId'),
			'GroupShow'  => 1
		)))
	{
		$this -> M_Loger -> set_activity_log("Add Group Menu :: name::".$GroupName.", desc ::".$GroupDescription);
		$_conds = 1;
	}
	
	return $_conds;
	
}

//@ _set_delete_group_menu
function _set_delete_group_menu($MenuGroupId)
{
	$tot = 0;
	if( is_array($MenuGroupId))
	{
		foreach($MenuGroupId as $k => $MenuId )
		{
			$this -> db -> where('GroupId',$MenuId);
			if( $this -> db -> delete('tms_group_menu') ){
				$tot++;
			}
		}	
	}
	
	if( $tot > 0 ){
		$this -> M_Loger -> set_activity_log("Delete Group Menu :: ".implode(',', $MenuGroupId) );
	}
	
	return $tot;
}



// @ _set_active_group_menu

function _set_active_group_menu($MenuGroupId, $flags)
{
	$tot = 0;
	if( is_array($MenuGroupId))
	{
		foreach($MenuGroupId as $k => $MenuId )
		{
			$this -> db -> where('GroupId',$MenuId);
			if( $this -> db -> update('tms_group_menu', array('GroupShow'=> $flags) ))
			{
				$tot++;
			}
		}	
	}
	
	if( $tot > 0 ){
		$this -> M_Loger -> set_activity_log( ($flags?'Enable':'Disable')."Group Menu :: ".implode(',',$MenuGroupId) );
	}
	
	return $tot;

}

// _setSaveNewGroup

function _setSaveNewGroup($data = null )
{
	$_conds = 0;
	if( is_array($data))
	{
		if( $this -> db->insert('tms_group_menu',$data) ){
			$_conds++;
		}
		
	}
	
	return $_conds;
}


// _setUpdateNewGroup

function _setUpdateNewGroup($post=null)
{
	$_conds = 0;
	
	if( is_array($post))
	{
		$update = array(); $where = array();
		
		foreach($post as $fields => $values )
		{
			if( $fields =='GroupId'){
				$where[$fields] = $values;
			}
			else{
				$update[$fields] = $values;
			}
		}
		
		if( $this -> db -> update('tms_group_menu',$update,$where) )
		{
			$_conds++;
		}
	}
	
	return $_conds;
}


}
// END OF FILE
// LOCATION : ./application/model/m_sysmenugroup.php
?>