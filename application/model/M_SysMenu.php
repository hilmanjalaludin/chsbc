<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysMenu  
 * 			  extends under model class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysmenu/
 */
 
class M_SysMenu extends EUI_Model
{

/*
 * @ set default query for calculation 
 * @ total record of page 
 * @ then sent to navigation view 
 */
 
 function __construct() {
	$this -> load -> Model('M_Loger');
 }
 
// @ _get_default
function _get_default()
{
	$this -> EUI_Page -> _setPage(10); 
	$this -> EUI_Page -> _setQuery( "select a.*, b.* from tms_application_menu a  left join tms_group_menu b on b.GroupId=a.group_menu" ); 
	
	$filter = '';
	
	if( $this->URI->_get_have_post('key_words') ) 
	{
		$filter = " /*AND*/ ( a.menu LIKE '%".$this -> URI -> _get_post('key_words')."%' 
						 OR a.file_name LIKE '%".$this -> URI -> _get_post('key_words')."%' 
						 OR a.el_id LIKE '%".$this -> URI -> _get_post('key_words')."%'
						 OR a.description LIKE '%".$this -> URI -> _get_post('key_words')."%'
						 OR a.flag LIKE '%".$this -> URI -> _get_post('key_words')."%'
						 OR a.updated_by LIKE '%".$this -> URI -> _get_post('key_words')."%'
						 OR a.OrderId LIKE '%".$this -> URI -> _get_post('key_words')."%' ) ";
	}				
			
	$this -> EUI_Page -> _setWhere( $filter );   
	if( $this -> EUI_Page -> _get_query() ) {
		return $this -> EUI_Page;
	}
}

/*
 * @ set default query for calculation 
 * @ total record of page 
 * @ then sent to navigation view 
 */
function _get_content()
{
	//@ create object 
 	$this -> EUI_Page->_postPage( $this -> URI -> _get_post('v_page') );
 	$this -> EUI_Page->_setPage(10);
 	$conds1 = " if(a.flag=1,'Active','Unactive') as status, ";
 	if( QUERY == 'mssql') {
 		$conds1 = " CASE WHEN a.flag=1 THEN 'Active' ELSE 'Unactive' END AS status, ";
 	}

 	$sql = " SELECT {$conds1} a.*, b.* from tms_application_menu a left join tms_group_menu b on b.GroupId=a.group_menu ";
 	$this -> EUI_Page ->_setQuery($sql);
 	#var_dump( $sql ); die();
 	
 	$filter = '';
 	if( $this -> URI -> _get_have_post('key_words') )
   	{
		$filter = " /*AND*/ ( a.menu LIKE '%".$this -> URI -> _get_post('key_words')."%' 
						 OR a.file_name LIKE '%".$this -> URI -> _get_post('key_words')."%' 
						 OR a.el_id LIKE '%".$this -> URI -> _get_post('key_words')."%'
						 OR a.description LIKE '%".$this -> URI -> _get_post('key_words')."%'
						 OR a.flag LIKE '%".$this -> URI -> _get_post('key_words')."%'
						 OR a.updated_by LIKE '%".$this -> URI -> _get_post('key_words')."%'
						 OR a.OrderId LIKE '%".$this -> URI -> _get_post('key_words')."%' ) ";
	}				
	$this -> EUI_Page->_setWhere( $filter );
	$this -> EUI_Page->_setOrderBy('a.menu','ASC');
	$this -> EUI_Page->_setLimit();
	#echo $this->EUI_Page->_getCompiler(); die();
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
 
/**
 & get menu user by handle level user 
 */
private function _get_menu( $HandleTypeId=0 )
{
	$_conds = null;
	
	if( $HandleTypeId!='' )
	{
		$this -> db -> select( 'a.menu' );
		$this -> db -> from( 'tms_agent_profile a' );
		$this -> db -> where( 'a.id',$HandleTypeId );
		
		foreach( $this -> db ->get()-> result_assoc() as $rows ){
			$datas = array( 'menu' => $rows['menu'] );
		}
	}
	
	return $d_array = explode(',',$datas['menu']);
 }
 
/*
 * get menu user by handle level user 
 */
 
 function _get_show_menu( $GroupId )
 {
	$_echo_list = array();
	$_list_menu_id = self::_get_menu($GroupId);
	
	foreach( $_list_menu_id as $k => $v ){
		$_echo_list[$v] = self::_get_menu_name($v);
	}
	
	return $_echo_list;
 }
 
/**
 @ get menu user by handle level user 
 */
  
 function _get_menu_name( $MenuId )
 {
	$sql = "SELECT menu FROM tms_application_menu WHERE id='$MenuId'";
	$qry = $this -> db -> query($sql);
	
	if( !$qry -> EOF() ) {
		return $qry -> result_singgle_value();
	}
 }
 
 /**
 @ get menu all data 
 */
  
 function _get_menu_detail( $MenuId )
 {
	$sql = " SELECT * FROM tms_application_menu a 
			 LEFT JOIN tms_group_menu b on a.group_menu=b.GroupId WHERE a.id='$MenuId' ";

	$qry = $this -> db -> query($sql);
	
	if( !$qry -> EOF() ) 
	{
		return $qry -> result_first_assoc();
	}
 }
 
 
//@ group menu  

 function _get_group_menu()
{
	$_conds = array();
	
	$sql = "select * from tms_group_menu a order by a.GroupId asc";
	$qry = $this -> db -> query($sql);
	
	foreach( $qry -> result_assoc() as $rows )
	{
		$_conds[$rows['GroupId']] = $rows['GroupName'];
	}
	
	return $_conds;
  }
  
//@ UpdateSelGroup

function _set_update_group( $MenuId, $Group )
{	
	$this -> db -> where( 'id', $MenuId);
	if ( $this -> db -> update( 'tms_application_menu',array('group_menu' => $Group))){
		
		$sql = "select a.GroupName from tms_group_menu a  where a.GroupId='$Group'";
		$qry = $this -> db -> query($sql);
		
		if( !$qry -> EOF() )
		{
			return $qry -> result_singgle_value();
		}
	}
	
	return null; 
} 
  
// @ _set_assign_menu  

function _set_assign_menu( $MenuId=0, $AssignTo=0 )
{ 
	$i = 0;
	foreach($AssignTo as $key => $_userId )
	{
		$_array = self::_get_menu($_userId);
		$_array_merge = array_merge((array)$_array, (array)$MenuId);
		
		$this -> db -> where( 'id', $_userId );
		if( $this -> db -> update('tms_agent_profile', array('menu' => implode(',',$_array_merge))) )
		{
			$this -> M_Loger -> set_activity_log("Assign Menu ::".implode(',',$_array_merge));
			$i++;
		}
	}
	
	if( $i> 0 ) 
		return true;
	else
		return false;
}

// @ remove menu 

 function _set_remove_menu()
 {
	$conds = false;
	$_s_n = $this -> URI -> _get_array_post('menuid');
	$_s_u = $this -> URI -> _get_post('user');
	
	if( ($_s_n!='') && ($_s_u!='') )
	{
		$_ls_menu = self::_get_menu($_s_u );
		
		$s_i = 0;
		foreach( $_ls_menu as $_k => $_v )
		{
			if( !in_array($_v, $_s_n) ) 
			{
				$_ls_ky[$s_i] = $_v;
				$s_i++;
			}
		}
		
		$this -> db -> where( 'id', $_s_u );
		
		if( $this -> db -> update('tms_agent_profile', array('menu' => implode(",",$_ls_ky) ) )){
			$conds = true;
			$this -> M_Loger -> set_activity_log("Remove Menu ::".$this -> URI -> _get_post('menuid'));
		}	
	}	

	return $conds;	
}

// @ _set_disable_menu

function _set_disable_menu($flags=0, $MenuId=array() )
{
	$_list_array = $MenuId;
	$tot =0;
	if(count($_list_array )>0 )
	{
		foreach( $_list_array as $k => $MenuId )
		{ 
			$this -> db -> where('id', $MenuId );
			if( $this -> db -> update('tms_application_menu',array('flag' => $flags ) ) ) {
				$tot++;
			}
		}	
	}
	if( $tot > 0 ){
		$this -> M_Loger -> set_activity_log( ($flags?'Enable':'Disable')." Menu ::".implode(',', $_list_array));
	}	
	
	return $tot; 	
 }
 
// @ _set_deleted_menu

function _set_deleted_menu( $ListMenu=array() )
{
	$tot = 0;
	if( count($ListMenu) >0 )
	{
		foreach( $ListMenu as $k => $MenuId )
		{
			$this -> db -> where('id', $MenuId );
			if( $this -> db -> delete('tms_application_menu'))
			{
				$tot++;
			}
		}
	}
	
  // @ set to log 
  
	if( $tot > 0 )
	{
		$this -> M_Loger -> set_activity_log("Deleted Menu ::".implode(',', $ListMenu) );
	}
	
	return $tot;
}
 
// _setSaveNewMenu 

function _setSaveNewMenu($data = null)
{
	$_conds =0;
	if(!is_null($data))
	{
		if( $this ->db->insert('tms_application_menu',$data)){ 
			$_conds++;
		}
	}	
	
	return $_conds;
} 


// _setUpdateMenu;

function _setUpdateMenu($post=null)
{
	$_conds = 0;
	
	if( !is_null($post) 
		AND is_array($post) )
	{
		$update = array(); $where = array();
		foreach($post as $fields=>$values)
		{
			if( $fields =='id')
				$where[$fields] = $values;
			else
				$update[$fields] = $values;
		}
		
		// updates 
		
		$this ->db -> update('tms_application_menu',$update, $where);
		if( $this ->db -> update('tms_application_menu',$update, $where)){
			
			$_conds++;
		}
	}
	
	return $_conds;
}

}

// END OF FILE 
// LOCATION : ./application/model/sysmenu.php
?>