<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for user modul 
 * 			  extends under model class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysuser/
 */
 
Class M_SysPrivileges extends EUI_Model {

/*
 * @ get default nav of query data 
 * @ will return to nav data 
 */
 
 function get_default() 
 {
	$this -> EUI_Page -> _setPage(20); 
	$this -> EUI_Page -> _setQuery("select a.* from tms_agent_profile a" ); 
	
	$flt = '';
	if( $this -> URI -> _get_have_post('keywords') )
	{ 
		$flt .= " AND ( a.id LIKE '%{$this->URI->_get_post('keywords')}%'  
				  OR a.name LIKE '%{$this->URI->_get_post('keywords')}%'  
				  OR a.updated_by LIKE '%{$this->URI->_get_post('keywords')}%'  
				  OR a.last_update LIKE '%{$this->URI->_get_post('keywords')}%'  
				  
				  ) ";
	}
	
	$this -> EUI_Page -> _setWhere($flt);   
	return $this -> EUI_Page;
 }
 
 
/*
 * get page content return to content list 
 * get content data 
 *
 */
 
 function get_content()
 {
	
	$this -> EUI_Page -> _postPage( $this -> URI -> _get_post('v_page') );
	$this -> EUI_Page -> _setPage(20);
	
	$this -> EUI_Page -> _setQuery("select a.* from tms_agent_profile a" );
	
	$flt = '';
	if ( $this -> URI -> _get_have_post('keywords') ) 
		$flt .= " AND ( a.id LIKE '%{$this->URI->_get_post('keywords')}%'  
				  OR a.name LIKE '%{$this->URI->_get_post('keywords')}%'  
				  OR a.updated_by LIKE '%{$this->URI->_get_post('keywords')}%'  
				  OR a.last_update LIKE '%{$this->URI->_get_post('keywords')}%'  
				  ) ";
				  

		
	$this -> EUI_Page ->  _setWhere($flt);
	if( $this -> URI -> _get_have_post('order_by')) 
		$this -> EUI_Page -> _setOrderBy( $this -> URI -> _get_post('order_by'),$this -> URI -> _get_post('type'));
	else 
		$this -> EUI_Page -> _setOrderBy('a.id');

	$this -> EUI_Page ->  _setLimit();
} 


/*
 *@ get buffering query from database
 *@ then return by object type ( resource(link) ); 
 */
 
function get_resource_query()
 {
	self::get_content();
	
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }
 
/*
 *@ get number record & start of number every page 
 *@ then result ( INT ) type 
 */
 
function get_page_number()
  {
	if( $this -> EUI_Page -> _get_query()!='' )
	{
		return $this -> EUI_Page -> _getNo();
	}	
  }
  
/* 
 * @def _setDeletePrivileges
 * -----------------------------------
 *
 * @ param 	: data array()
 * @ aksess : public 
 */ 
 
 function _getPrivilegesData( $PrivilegeId=0 ) 
 {
	$_conds = array();
	$this -> db ->reset_select();
	$this -> db ->select('*');
	$this -> db ->from('tms_agent_profile');
	$this -> db ->where('id',$PrivilegeId);
	
	if( $rows = $this -> db -> get() -> result_first_assoc() )
	{
		$_conds = $rows; 
	}
	
	return $_conds;
	
 }
/* 
 * @def _setDeletePrivileges
 * -----------------------------------
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */
 
function _setDeletePrivileges( $data = null )
{
	$_conds = 0;
	foreach( $data as $m => $PrivilegeId )
	{
		if( $this ->db->delete('tms_agent_profile',array('id' => $PrivilegeId ) )){
			$_conds++;
		}
	}
	
	return $_conds;
} 


/* 
 * @def _setSavePrivileges
 * -----------------------------------
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */
 
function _setSavePrivileges($_post=array())
{
	$_conds = 0;
	if( $this -> db -> insert('tms_agent_profile',$_post)) 
	{
		$_conds++;
	}
	return $_conds;
}

/* 
 * @def _setSavePrivileges
 * -----------------------------------
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */
function _setUpdatePrivileges($_post =array() )
{
	$_conds = 0; $update = array(); $where = array();
	foreach( $_post as $m => $k )
	{
		if( $m=='id')
			$where[$m] = $k;
		else
			$update[$m] = $k;
	}
	
	if( $this -> db -> update('tms_agent_profile', $update, $where)){
		$_conds++;
	}

	return $_conds;	
}

}
?>