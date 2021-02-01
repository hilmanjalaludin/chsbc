<?php

// ********* M_DatabaseMonitoring

class M_DatabaseMonitoring extends EUI_Model
{

	private static $primary = 'list_tables';	
	var $start = 0;
	var $perpage = 20;	

// ***** _getSizeTables 	

function _getSizeTables()
{
	$hides = self::_getListTableHide();
	
	$results = array();
	
// get on schema 	
	$sql = "SHOW table status from ".$this->db->EUI_DB_database;
	
// get by filter 

	if( $this -> URI->_get_have_post('keyword')) 
	{
		$sql.= " WHERE Name LIKE '%{$this -> URI->_get_post('keyword')}%'";
	}
	
	$qry = $this ->db->query($sql);
	$i = 0;
	foreach( $qry->result_assoc() as $rows )
	{
		
		if(!in_array($rows['Name'], $hides) )
		{
			$results[$i]['NAME'] 			= $rows['Name'];
			$results[$i]['ENGINE']			= $rows['Engine'];
			$results[$i]['FORMAT'] 			= $rows['Row_format'];
			$results[$i]['ROWS'] 			= $rows['Rows'];
			$results[$i]['DATA_LENGTH']     = $rows['Data_length'];
			$results[$i]['MAX_DATA_LENGTH'] = $rows['Max_data_length'];
			$results[$i]['INDEX_LENGTH'] 	= $rows['Index_length'];
			$results[$i]['DATA_FREE'] 		= $rows['Data_free'];
			$results[$i]['AUTO_INCREMENT'] 	= $rows['Auto_increment'];
			$results[$i]['UPDATE_TIME'] 	= $rows['Update_time'];
			$results[$i]['COLLATION'] 		= $rows['Collation'];
			$results[$i]['SIZE_DISK'] 		= round((($rows['Data_length'] + $rows['Index_length'])/1024),2); 
			$i++;
		}
	}
	
	return $results;
}


// ********** _getResultList = null; 

function _getResultList($pages = 0 )
{
	$list_content_array = array();
	$list_array = $this -> _getSizeTables();
	
	if( $pages ) $this ->start = (($pages-1)*$this->perpage);
	else {	
		$this ->start = 1;
	}
	
	$list_content_array = array_slice($list_array, $this ->start, $this -> perpage);
	
	return $list_content_array;
}

// ************ _getNumber

function _getNumber()
{
	return $this -> start;	
}


// _addOPtions

function _addOPtions($param = null )
{
	$no = 0;
	if( !is_null($param))
	{
		foreach($param as $k => $table )
		{
			$this -> db -> set('table_name',self::$primary);
			$this -> db -> set('table_field_name', $table);
			$this -> db -> set('table_user_create', $this ->EUI_Session->_get_session('UserId') );
			$this -> db -> set('table_update_time', date('Y-m-d H:i:s'));
			if( $this -> db -> insert('t_gn_hide_tables') ){
				$no++;
			}
		}
	}
	
	return $no;	
}

// _DellOPtions

function _DellOPtions($param = null)
{
	$no = 0;
	if( !is_null($param))
	{
		foreach($param as $k => $table )
		{
			$this -> db -> where('table_name',self::$primary);
			$this -> db -> where('table_field_name', $table);
			if( $this -> db -> delete('t_gn_hide_tables') ){
				$no++;
			}
		}
	}
	
	return $no;	
}


// getOptionsList

function _getOptionsList()
{
	$conds = array();
	
	$this -> db-> select('table_field_name');
	$this -> db-> from('t_gn_hide_tables');
	$this -> db-> where('table_name',self::$primary);
	
	foreach( $this ->db ->get() ->result_assoc() as $rows )
	{
		$conds[$rows['table_field_name']] = $rows['table_field_name'];
	}
	
	return $conds;
}


// _getListTableHide
function _getListTableHide()
{
	$schema = array();
	
	$sql = " SELECT `table_field_name` FROM (`t_gn_hide_tables`) WHERE `table_name` = '".$this -> EUI_Session->_get_session('HandlingType')."' ";
	$qry = $this -> db ->query($sql);
	foreach($qry -> result_assoc() as $rows )
	{
		$schema[$rows['table_field_name']] = $rows['table_field_name'];
	}
	
	return $schema;
}





}

?>