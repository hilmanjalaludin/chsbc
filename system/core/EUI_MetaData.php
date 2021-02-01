<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * E.U.I Enigma User Interface
 *
 * An open source application development framework for PHP 5.1.6 or newer
 * 
 *@lincense   http://razakitechnology.com/license
 *@ link 	   http://razakitechnology.com/eui/core 
 *@ package    Core  
 **/
 
class EUI_MetaData 
{

 protected $_meta_paths = array();
 protected $_meta_data  = array();
 protected $_meta = null;

 

private static $Instance;

private static $_meta_string = null;
 
/**
 *@ constructor class
 *@ generate meta data table 
 **/
 
public function __construct( $_meta = '' ) 
{	 
	if( count( $this -> _meta_paths) == 0 ){
		// $this -> _meta_paths = array( '_view_meta' => APPPATH .'meta/insurance', true);	
		$this -> _meta_paths = array( '_view_meta' => APPPATH .'meta/'. PRODUCT, true);	
	}
	
	$this -> _view_meta_data( $_meta );
	
}

/**
 *@ constructor class
 *@ generate meta data table 
 **/
 
public function _get_meta_index()
{
  $_conds = array();
  if( is_array($this -> _meta) ) {
	$i = 0;
	foreach( $this -> _meta as $key => $_varchar )
	{
		$_table[] = $key;
		$i++;
	}
	
	$_conds = $_table[0];
  }
  
  return $_conds;
  
}


/**
 *@ constructor class
 *@ generate meta data table 
 **/
 
 public function _get_meta_type()
 {
   $_conds = array();
   if( is_array($this -> _meta) ) 
   {
		$i = 0;
		foreach( $this -> _meta as $key => $_varchar ) 
		{
			foreach($_varchar as $_name => $v ){
				$_table[$v['_alias']] = $v['_type'];
				$i++;
			}
		}
	$_conds = $_table;
  }
  
  return $_conds;
  
}

/**
 *@ constructor class
 *@ generate meta data table 
 **/
 
 public function _get_meta_alias()
 {
   $_conds = array();
   if( is_array($this -> _meta) ) 
   {
		$i = 0;
		foreach( $this -> _meta as $key => $_varchar ) 
		{
			foreach($_varchar as $_name => $v ){
				$_table[$i] = $v['_alias'];
				$i++;
			}
		}
	$_conds = $_table;
  }
  
  return $_conds;
  
}

/**
 *@ constructor class
 *@ generate meta data table 
 **/
 
 public function _get_cols_post( $num = null ) 
 {
	$_conds = self::_get_meta_colums();
	if( !is_null($num) ) {
		$cols   = self::_get_meta_colums();
		$_conds = $cols[$num];
	}
	
	return $_conds;
 }
 
/**
 *@ constructor class
 *@ generate meta data table 
 **/
 
 public function _get_cols_select( $num = 0 ) 
 {
	$select = '';
	$cols = self::_get_meta_colums();
	
	if( $num !=0 && $num!='' ) {
		for($i=0; $i<$num; $i++) {
			$data[$i] = $cols[$i];  	
		}
	}
	else {
		foreach( $cols as $k => $value ) {
			$data[$k] =  $value;
		}
	}
	if( is_array($data) ){
		$select = implode(',',$data);	
	}
	
	return $select;
 }
/**
 *@ constructor class
 *@ generate meta data table 
 **/
 
 public function _get_meta_colums()
 {
   $_conds = array();
   if( is_array($this -> _meta) ) 
   {
		$i = 0;
		foreach( $this -> _meta as $key => $_varchar ) 
		{
			foreach($_varchar['_cols'] as $_name => $v )
			{
				$_table[$i] = $_name;
				$i++;
			}
		}
	$_conds = $_table;
  }
  
  return $_conds;
  
}

/**
 *@ constructor class
 *@ generate meta data table 
 **/
 
 public function _get_meta_position()
 {
   $_conds = array();
   if( is_array($this -> _meta) ) 
   {
	 $i = 0;
	foreach( $this -> _meta as $key => $_varchar ) {
		$_table[$i] = $_varchar;
		$i++;
	}
	
	$_conds = $_table;
  }
  
  return $_conds;
  
}

/**
 *@ constructor class
 *@ generate meta data table 
 **/
 
public function _get_meta_data()
{

  $_conds = array();
  if( is_array( $this -> _meta  ))
  {
	$_conds = $this -> _meta;
  }
  
  return $_conds;
  
}

/**
 *@ constructor class
 *@ generate meta data table 
 **/
 
function _view_meta_data( $_meta= '' )
{
	if( ($_meta !='') AND ($_meta !=FALSE) )
	{
		$_path_meta = $this -> _meta_paths['_view_meta'].'/'.$_meta.'.php';
		if( file_exists($_path_meta) )
		{
			require( $_path_meta );
			if( is_array( $_meta_data) && count($_meta_data) > 0 )
			{
				$this -> _meta = $_meta_data;
			}
		}
		else{
			show_error('Unable to locate the meta data you have specified : '.$_path_meta .' // '. __FILE__ .':'. __LINE__);
		}
	}
}

/*
 ^ @ def		meta_select
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
 function meta_select( $_cols = null )
 {
	$_columns = self::_get_meta_colums();
	if( is_array($_cols) AND !is_null($_cols) )
	{
		$_conds= null;
		foreach($_cols as $k => $v ) 
		{ 
			if( in_array($v, $_columns) )
			{
				$_conds[$v] = $v;  	
			}	
		}
		
		self::$_meta_string = "SELECT ". implode(',',$_conds) ." FROM ". self::_get_meta_index(); 	
	}
	else{
	
		self::$_meta_string = "SELECT ". self::_get_cols_select() ." FROM ". self::_get_meta_index();
	}
 }

 /*
 ^ @ def		meta_select
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
 function meta_where( $wheres = null )
 {
	self::$_meta_string .= " WHERE 1=1 ";
	if( !is_null($wheres) AND is_array($wheres) )
	{
		foreach( $wheres as $name => $where ){
			if( in_array($name, self::_get_meta_colums()))
			{ 
				self::$_meta_string .= " AND $name = '$where'";
			}
			else{
				show_error("no spesific columns  : <b>".$name . "</b> on <b>". self::_get_meta_index() ."</b>, File : ". __FILE__ .":". __LINE__);
				break;
			}
		}
	}
 }
 
/*
 ^ @ def		meta_select
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
 function meta_like( $wheres = null )
 {
	if( !is_null($wheres) AND is_array($wheres) )
	{
		foreach( $wheres as $name => $where )
		{
			self::$_meta_string.= " AND $name LIKE '%$where%'";
		}
	}
 }
 
/*
 ^ @ def		meta_select
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
 function meta_get_query()
 {
	$EUI_DB =& get_instance();
	
	$_conds = false;
	if( !is_null(self::$_meta_string) )
	{
		$_conds = $EUI_DB -> db -> query( self::$_meta_string );
	}
	
	return $_conds;	
 }
 
 
/*
 ^ @ def		meta_select
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
public static function &_get_instance()
{
	if( is_null( self::$Instance ) ) {
		self::$Instance = new self();
	}
	return self::$Instance;
}
	
}
// end off file
?>