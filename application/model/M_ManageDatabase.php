<?php
class M_ManageDatabase extends EUI_Model
{

 private static $schema = 't_gn_hide_tables';

 function _getDataTables($tables = null )
 {
	$sheet = array();
	if( !is_null($tables) )
	{
		$qry = $this -> db->query("DESC $tables");
		
		$num = 0;
		foreach($qry -> result_assoc() as $rows ) {
			$sheet[$num] = $rows;
			$num++;
		}
	}
	
	return $sheet;
 }

// _getSchemaHide
 
 function _getSchemaHide($tables = null )
 {
	$schema = array();
	
	$this -> db -> select("table_field_name");
	$this -> db ->from(self::$schema);
	$this -> db ->where('table_name',$tables);
	foreach( $this -> db ->get() -> result_assoc() as $rows )
	{
		$schema[$rows['table_field_name']] = $rows['table_field_name'];
	}
	
	return $schema;
 }
 
 //
 
 function _getSchemaPrivileges($privileges= array() )
 {
	$schema = array();
	
	$this -> db -> select("table_field_name,table_name");
	$this -> db ->from(self::$schema);
	$this -> db ->where_in('table_name',array_keys($privileges) );
	
	foreach( $this -> db ->get() -> result_assoc() as $rows )
	{
		$schema[$rows['table_name']][]= $rows['table_field_name'];
	}
	
	return $schema;
 }
 
 //
 
 function _getDetailTable($tables = null )
 {
	$sheet = array();
	$filter_schema = array();
	
	if( ($this -> EUI_Session->_get_session('HandlingType')!=USER_ROOT) )
	{
		$filter_schema = array('TABLE_SCHEMA');	
	}
	
	
	$sql = " SELECT * FROM information_schema.TABLES as a where  a.TABLE_SCHEMA='" . $this -> db -> EUI_DB_database . "' 
			 AND a.TABLE_NAME='$tables'";
	$qry = $this ->db->query($sql);
	foreach($qry->result_assoc() as $rows )
	{
		$sheet = $rows;	
	}
	
	/// concate data 
	
	$results = array();
	
	if(is_array($sheet) ) foreach( $sheet as $fieldname => $fieldvalue )
	{
		if( !in_array($fieldname, $filter_schema) ){
			$results[$fieldname] = $fieldvalue; 		
		}	
	}	
	
	return $results;
 }
 
 // _setSave
 
 function _setSave($param = null )
 {
	$_conds = false;
	
	if( !is_null($param) )
	{
		foreach($param as $key => $values )
		{
			$this -> db -> set($key,$values);
		}
		
		$this -> db -> set('table_user_create',$this -> EUI_Session->_get_session('UserId'));
		$this -> db -> set('table_update_time',date('Y-m-d H:i:s'));
		
		// insert 
		
		$this -> db ->insert(self::$schema);
		if( $this -> db ->affected_rows() )
			$_conds = true;
		else
		{
			foreach($param as $key => $values )
			{
				if( $key=='table_name')
					$this -> db -> where($key,$values);
				else
					$this -> db -> set($key,$values);	
			}
			
			// update 
			
			if( $this -> db ->update(self::$schema) )
			{
				$_conds = true;
			}
		}
	}
	
	return $_conds;
 }
 
 
 // _setDeleted($param);
 
 function _setDeleted($param=null)
 {
	$_conds = false;
	
	if( !is_null($param) )
	{
		foreach($param as $key => $values ) {
			$this -> db -> where($key,$values);
		}
		
		if( $this ->db ->delete(self::$schema) ){
			$_conds = true;
		}
		
	}

	return $_conds;	
 
 }
 
 
 
}

?>