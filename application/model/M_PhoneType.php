<?php
class M_PhoneType extends EUI_Model
{

private static $meta = null; 


// construct 

function M_PhoneType()
{
	if( is_null(self::$meta) )
	{
		self::$meta = 't_lk_phonetype'; 	
	}
}

// function get Hide

function _getHideData()
{
	$rowshide = array();
	
	$this -> db -> select('a.table_field_name');
	$this -> db -> from('t_gn_hide_tables a ');
	$this -> db -> where('a.table_name', 't_gn_bucket_customers');
	foreach( $this -> db -> get() -> result_assoc() as $rows ) 
	{
		$rowshide[$rows['table_field_name']] = $rows['table_field_name'];
	}
	
	return $rowshide;
}
	
 // get phone type list 

function _getPhoneTypeList() 
{

 $phone = array();
 
	$this -> db -> select('*');
	$this -> db -> from(self::$meta);
	$this -> db -> where('FlagStatusActive',1);
	
	foreach( $this -> db -> get() -> result_assoc() as $rows ) 
	{
		// if( !in_array($rows['PhoneField'], array_keys(self::_getHideData()) ) )
		// {
			$phone[$rows['PhoneType']] = $rows['PhoneDesc'];
		//}	
	}
	
	return $phone;
}

}

?>