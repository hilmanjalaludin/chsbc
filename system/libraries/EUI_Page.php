<?php

/**
 * @ package 	: EUI_Page 
 * @ subpackage : libraries 
  --------------------------------
 * @ notes 		: compile and generate on grid attribute data 
 * 				  with simple data suport order only 
 * @ params		: - 
 * ------------------------------------------------------------------------------------------
 * # change of date :  2014-11-28 @ omens // hnadle cache , and handle where in 
 *
 */
 
 
 
class EUI_Page  {
 
 var $_pages    = 0;
 var $_start    = 0;
 var $_post     = 0;
 var $_where    = array();
 var $_and 	    = array();
 var $_from     = array();
 var $_join     = array();
 var $_or_like  = array();
 var $_or 	    = array();
 var $_primary  = array();
 var $_hidden	= array();
 var $_selected  = array();
 var $_or_cache  = array();
 var $_or_having_cache = array();
 var $_arr_func  = array();
 var $_arr_union = array(); 
 
// set count untuk validation counter 
// dari setiap page agar lebih ringan 
 

 var $ar_count  = FALSE;
 var $_pager_databse = NULL;
 
 
/** set null default properies **/ 

 var $_align	= NULL;
 var $_query    = NULL;
 var $_pref     = FALSE;
 var $_conds    = NULL;
 var $_compile  = NULL;
 var $_labels   = NULL;
 var $_styles   = NULL;
 var $_ascii    = NULL;
 
// array attribute  ----------------------------------
 
 var $_arr_having = array();
 var $_arr_wrap = array();
 var $_arr_border = array();
 
 
/** css styles on grid view ***/
 
 var $_font_color  		= NULL;
 var $_background_color = NULL;
 var $_font_size 		= NULL;
 var $_font_family 		= NULL;
 var $_rows_styles 		= array();
 var $_CRLF 			= ':';
 var $_EOFL 			= ';';
	
// -----------------------------------------------------------------------------------------------------------

 private static $Instance = NULL;
 
// -----------------------------------------------------------------------------------------------------------

 public static function &Instance() {
	if(is_null(self::$Instance) ) {
		self::$Instance = new self();
	}
	
	return self::$Instance;
 }

// -----------------------------------------------------------------------------------------------------------
 
 public function __construct()
{ 
	$this->_post  = 0;
	$this->_start = 0;
	$this->_pages = 0;
	$this->_query = NULL;
	$this->_where = NULL;

	$this->_conds = "WHERE (TRUE)";
	if( QUERY == 'mssql') { $this->_conds = "WHERE 1=1";} // mode mssql
	
	$this->_pref  = FALSE;
	$this->_labels = NULL;
	$this->_arr_having = array();
	$this->_ascii = "*";
}	

// -----------------------------------------------------------------------------------------------------------

/*
 * @ pack : _setAlign
 */
 
 public function _setWrap( $field=null, $value=null )
{
	if( !is_array($field) )
	{
		$this->_arr_wrap[$field] = $value;
		return true;
	}
	
	if( is_array($field) )
	{
		foreach( $field as $k => $v )
		{
			$this->_arr_wrap[$k] = $v;
		}
	}
	
	return true;
}

// -----------------------------------------------
/*
 * @ pack : _setAlign
 */
 
  public function _getWrap()
{
	if( !is_array( $this->_arr_wrap ) 
		AND count( $this->_arr_wrap )==0 )
	{
		return (bool)false;
	}
	
	return $this->_arr_wrap;	
}

// -----------------------------------------------
/*
 * @ pack : _setAlign
 */
 
public function _setAlign( $field, $style)
{

// is not at array 

 if( !is_array($field) )
{
	$this->_align[$field] = $style;	
 }

// is an array setup  
  if( is_array($field) )
 {
	foreach( $field as $k => $v )
	{
		$this->_align[$k] = $v;
	}
 }
 
}

// -----------------------------------------------
/*
 * @ pack : set_call_function
 */

 
 public function _get_class_border()
{
	$arr_label =& $this->_getLabels();
// -----------------------------------------------------------
	$arr_label_key = array();
	
	if(is_array($arr_label) ){
			$arr_label_key = array_keys($arr_label);
	}
	
	$arr_count_key = count($arr_label);
	$arr_label_xls = $arr_label_key[$arr_count_key-1];
	
	if(is_array($arr_label)) 
		foreach( $arr_label as $key_label => $value )
	{
		if( strcmp($arr_label_xls, $key_label) ==0 )
		{
			$this->_arr_border[$key_label] = 'lasted'; 
		} else{
			$this->_arr_border[$key_label] = 'middle';
		}	
	}
	
	return $this->_arr_border;
}

// -----------------------------------------------
/*
 * @ pack : set_call_function
 */
 
 
 public function set_call_function($field, $function )
{
	if(!is_null($function) AND !empty($function)) 
	{
		$this->_arr_func[$field]= $function; 	
	}
}
// -----------------------------------------------
/*
 * @ pack : _getAlign
 */
 
 public function _getAlign()
 {
	if( count($this->_align) > 0  )
	{
		return $this->_align;
	}
	else
		return null;
 }
 
// -----------------------------------------------
/*
 * @ pack : _setPage
 */
 
public function _setPage( $_int )
{
	$this->_pages = $_int;
}
// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
 public function _setLabels($labels = NULL)
 {
	if(!is_null($labels) AND is_array($labels) ) {
		$this->_labels = $labels;
	}
 }
 

// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
 
public  function _getDatabase(){
 $CI =& get_instance();	
 
// if have multiple database connection 
// with must be definition on pager class . class overide object $CI 	

 if( !is_null( $this->_pager_databse ) ){
	return $CI->load->database( $this->_pager_databse, true );
 }
 return $CI->db;
 
}
 
// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
 public function _getLabels()
{
  if(!is_null($this->_labels)) 
 {
	$arr_label = array();
	
	if( !function_exists('lang') )
	{
	  return $this->_labels;
    }
	  
	if( is_array( $this->_labels ) ) 
	  foreach( $this->_labels as $field => $label )
	{
		$arr_label[$field] = lang($label);
	}
	
	return $arr_label;
 }
  else
	return FALSE;
}
 
// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
 public function _postPage( $_post= '' )
 {
	if($_post!='') 
		$this->_post = $_post;
	else
		$this->_post = 0;
 }
 
// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
 public function _setQuery( $sql = null )
{

 if( !is_null($sql) )
 {
	$this->_setCompiler( $sql );
 }
 
}

// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
 private function _setCompiler( $_arr_compile = null ) 
{
	if( !is_null($_arr_compile) ) {
		$this->_compile .= $_arr_compile ; 
	}	
}

// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 

protected function _string_covert_array( $string = '' )
{
	$labels = FALSE;
	if( $explode = explode(",", $string ) )
	{
		foreach( $explode as $is => $fieldname ) 
		{
			$space = explode(" ", $fieldname);
			if( count($space) > 1  )
			{
				$labels[$space[count($space)-1]] = $space[count($space)-1]; 
			}
			else
			{
				$labels[trim($fieldname)] = trim($fieldname);
			}
		}
	}

	return $labels;	
}

// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
protected function _setPrimary( $keys = null )
{
	if( !is_array($keys) ) 
	{
		$this->_primary[trim($keys)] = trim($keys);
	}
}
// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
protected function _setHidden( $keys )
{
	if( !is_array($keys) ) 
	{
		$this->_hidden[trim($keys)] = trim($keys);
	}
}
// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
public function _getHidden() 
{
	if( is_array($this->_hidden) ) {
		return $this->_hidden;
	}
	else{
		return FALSE;
	}
}

// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
public function _getPrimary() 
{
	if( is_array($this->_primary) )
	{
		return reset($this->_primary);
	}
	else{
		return FALSE;
	}
}

// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
public function _setArraySelect( $fieldname = NULL )
{
	if( !is_array($fieldname) )	
	{
		// look not "/*/" 
		
		if( $fieldname!=$this->_ascii) 
		{
			$this->_setSelect($fieldname);
			// look is string or NOT 
			
			if( $label = $this->_string_covert_array($fieldname) AND is_bool($label)==FALSE )
			{
				$this->_setLabels($label);
			}
		}
		
		// look yes "/*/"
		if( $fieldname == $this->_ascii ) {
			$this->_setSelect('*');
		}	
		
		return TRUE;	
	}	
	
	/** if is array ****/
	
	if( is_array($fieldname)) 
	{
		$labels = null;
		foreach( $fieldname as $key => $rows )
		{
			if( is_array($rows) )
			{
				 // set primary key to available 
				
				if( isset($rows[2]) AND ( strtolower($rows[2])=='primary' ) ) 
				{
					$this->_setPrimary( $rows[0] );	
				}
				
				// set hidden field 
				
				if( isset($rows[2]) AND ( strtolower($rows[2])=='hidden' ) ) 
				{
					$this->_setHidden( $rows[0] );	
				}
				
				// set label field 
				
				if( !isset( $rows[2] ) OR ( $rows[2]==FALSE ) OR ( $rows[2]=='' ) )
				{  
					$labels[trim($rows[0])] = $rows[1];
				}		
			}
			else
			{
				$labels[trim($rows)] = $rows; 	
			}
		}
		
		$this->_setLabels($labels); 
		$this->_setSelect( implode(",",array_keys($fieldname)), FALSE );
		return TRUE;
	}
}

// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
public function _setSelect($_sql=NULL, $pref = FALSE )
{
	$this->_pref = $pref; 
	if ( $pref == FALSE ) {
		$coma = "";
	} else {
		$coma = ",";
	}
	if(!is_null($_sql)) {
		$this->_setCompiler("\nSELECT $_sql $coma");	
	}
}


public function _setSelectComa($_sql=NULL, $pref = FALSE )
{
	$this->_pref = $pref; 
	if ( $pref == FALSE ) {
		$coma = "";
	} else {
		$coma = ",";
	}
	if(!is_null($_sql)) {
		$this->_setCompiler("$_sql $coma");	
	}
}

// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
 public function _setUnion( $pref = '' )
{
    $pref = strtoupper( $pref );
	$this->_setCompiler( PHP_EOL ." UNION $pref ". PHP_EOL);	
}

// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
 public function _setAndOr( $field = NULL, $values = NULL, $pref = 'LIKE' )
{
  
  $arr_like = array();
  if( is_array($field) ) foreach($field as $key => $value )
 {	
	if(in_array(reset($value), array('LIKE', 'OR', 'AND')))
	{
		$arr_value = end($value);
		if( count($arr_like) ==0 ) {
			$arr_like[] = " ${key} LIKE '%${arr_value}%'";
		}	
		else{
			$arr_like[] =" OR ${key} LIKE '%${arr_value}%'";
		}
	}
 }
 
 $arr_select = NULL;
 
 if( count($arr_like)> 0 )
 {
	$arr_select = "( ";
		foreach( $arr_like as $arr_or_like )
	{
		$arr_select .="$arr_or_like";
	}
	$arr_select.= " ) ";	
 }
 
 
 if( !is_null($arr_select)){
	
	$this->_setAnd($arr_select);
	$arr_like = array();
 }
 
 
}

// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
 
public function _setFrom( $from = NULL, $pref = FALSE )
{
	$this->_pref = $pref;
	$EUI = & get_instance();
	
	if(!is_null($from))
	{
		if( is_bool($this->_pref) AND ($this->_pref==TRUE) )
		{
			if( QUERY == 'mysql') {
				$this->_setCompiler(" FROM ( $from ) ". $this->_conds);
			}

			if( QUERY == 'mssql') {
				$this->_setCompiler(" FROM $from ". $this->_conds);
			}
		}
		else
		{
			if( QUERY == 'mysql') {
				$this->_setCompiler(" FROM ( $from ) ");
			}

			if( QUERY == 'mssql') {
				$this->_setCompiler(" FROM $from ");
			}
		}
	}
}

// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
public function _setJoin($sql = null, $on, $join = 'LEFT', $pref = FALSE )
{
	$this->_pref = $pref;
	if(!is_null($sql)) 
	{
		if( is_bool($this->_pref) AND ($this->_pref==TRUE) ) 
		{
			$this->_setCompiler(" $join JOIN  $sql ON $on ". $this->_conds);
		}	
		else
		{
			$this->_setCompiler(" $join JOIN  $sql ON $on ");
		}
	}
}

// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
public function _getNo()
{
	if( ($this->_compile!='') )
		$_page_number = (($this -> _getStart())+1);
	else
		$_page_number = 0;
	
	return $_page_number;	
}


// ---------------------------------------------------------

/*  @package		properties counter 
 * @notes 			handle count primary faster select 
 *
 */
 
function _setCount( $val = true ) {
  $this->ar_count = $val;
} 

	
// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
 
 public function _setWhere( $_where='' )
{
	$is_where = " WHERE (TRUE) ";
	if( $_where!='' )
	{
		if( QUERY == 'mysql') {
			$_where = $is_where . $_where;
			$this->_setCompiler(" $_where ");	
		}

		if( QUERY == 'mssql') {
			$_where = "WHERE " . $_where;
			$this->_setCompiler(" $_where ");
		}
	}	
}

// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
public function _setAnd( $key = NULL , $_where=FALSE, $quote = FALSE ) 
{ 

  if( !is_null($key) ) 
  {
	if( is_bool($_where) AND ($_where==FALSE) )
	{
		$this->_setCompiler(" AND  $key $_where ");
	}
	else
	{
		if( strtoupper( $_where )!='NULL'){
			if( $quote == FALSE ){
				$this->_setCompiler(" AND  $key='$_where' ");
			} 
			
			if( $quote == TRUE ){
				$this->_setCompiler(" AND  $key=$_where ");
			}
		} else {
			$this->_setCompiler(" AND $key IS NULL");
		}
	}
}
	
}

// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
public function _setLike( $key = null , $_where =FALSE ) 
{ 
  if( !is_null($key))
  {
	 if(is_bool($_where) AND ($_where==FALSE)) 
	 {
		$this->_setCompiler(" AND  $key LIKE '%$_where' ");
	 }	
	 else
	 {
		$this->_setCompiler(" AND  $key LIKE '%$_where%'");
	}
  }	
  
}

// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
public function _setWherein( $key = null , $_where= null, $cond = false  ) 
{ 
	if(!is_array($_where) ){
		$_where = array($_where);
	}	
	
	if( is_array($_where) AND !is_null($key) ) {
		if( !$cond ) {
			$this->_setCompiler( sprintf(" AND %s IN('%s') ", $key, implode("','", $_where) ));
		}
		
		if( $cond ) { 
			$this->_setCompiler( sprintf(" AND %s IN(%s) ", $key, implode(",", $_where) ));
		}
		
	}	
}
// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
public function _setWhereNotin( $key = null , $_where= null  ) 
{ 
	if(!is_array($_where) ){
		$_where = array($_where);
	}
	
	if( is_array($_where) AND !is_null($key) )  
	{	
		$this->_setCompiler(" AND $key NOT IN('" . implode("','", $_where). "') ");
	}	
}

 
// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
 public function _getStart()
{
	$_pos  = 0;
	if( !empty( $this->_post ) && ( $this->_post >0 ) ){
		$_pos  = ((( $this -> _post )-1) * ((INT)$this ->_pages));
	}
	return $_pos;		
}
 
// -----------------------------------------------
/*
 * @ pack : _setOrderBy
 */
 
 public function _setOrderBy( $_cols=NULL , $_type= NULL, $cond = TRUE )
{ 
 
  if( $_cols!=NULL )
  {
	$this->_setCompiler(" ORDER BY $_cols $_type ");
	if(!is_null($_type))
	{
		if( $cond )
		{ 
			$this->_styles[$_cols] = array (  'order' => strtolower($_type), 'style'=> $this->_get_styles() );
		}
	}
  }
  
}

// -----------------------------------------------
/*
 * @ pack : _get_order_style
 */
 public function _get_order_style()
 {
	if( is_null($this->_styles) ) 
	{
		return NULL;
	}	
		
	return $this->_styles;
	
 }
 
// ---------------------------------------------------
/*
 * @ pack : _reset object array 
 */ 
 
 public function _reset_pager( $field  = NULL )
{
  $arr_pager = array (
	'_arr_having' => array()
  );
  
 // reset all ---------------------------------
 
  foreach( $arr_pager as $key => $value )
  {
	if( in_array($field, array($key)))
	{
		$this->$field = $value;
		
	} else {
		$this->$key = $value;
	}
	
  }
  // end foreach 
  
} 
 
// -----------------------------------------------
/*
 * @ pack : _setGroupBy
 */
 public function _setGroupBy( $group_by = NULL )
{
	
 if( !is_array($group_by) AND !is_null($group_by) ){
	$group_by = array( $group_by );
 }

  if( is_array($group_by) AND count($group_by) > 0 )
 {
	$this->_setCompiler(" GROUP BY ". join(",", $group_by) ." ");
	if( count($this->_arr_having)> 0 ) 
		foreach( $this->_arr_having as $key => $field )
	{
		$this->_setCompiler($field);
	}
	
	$this->_reset_pager('_arr_having');
 }
 
 // ---------- on null indicated ---------------------------------------
 // -------- if group empty field then generate having 
 
  if( is_null($group_by) )
 {
	if( count($this->_arr_having)> 0 ) 
		foreach( $this->_arr_having as $key => $field )
	{
		$this->_setCompiler($field);
	}
	
	$this->_reset_pager('_arr_having'); 
 }	 
 
}

// having on process default

 protected function _Having( $field = null, $value = null, $type = "AND")
{
	if( !is_null( $value ) )
	{
		$this->_arr_having[] = trim($type) ." ". trim($field) . "='" . trim($value) ."'";
	} else{
		$this->_arr_having[] = trim($type) .' '. trim($field) . ' ';
	}	
}




// having on process LIKE

 protected function _HavingLike( $field = null, $value = null, $type = "AND")
{
	if( !is_null( $value ) )
	{
		$this->_arr_having[] = trim($type) ." ". trim($field) . " LIKE '%" . trim($value) ."%'";
	} else{
		$this->_arr_having[] = trim($type) .' '. trim($field) . ' ';
	}	
}

// ------------------------------------------------
// _setHaving AND 

 public function _setHaving( $_having = null, $value =null ) 
{
  if( !is_null($_having)) 
  {
	$type = ( count( $this->_arr_having ) == 0 ? 'HAVING' : 'AND');
	$this->_Having($_having, $value, $type);
  }
}

// ------------------------------------------------
// _setHavingLike 

 public function _setHavingLike( $_having = null, $value =null ) 
{
  if( !is_null($_having)) 
  {
	$type = ( count( $this->_arr_having ) == 0 ? 'HAVING' : 'AND');
	$this->_HavingLike($_having, $value, 'LIKE');
  }
}


// ------------------------------------------------
// _setLimit 


 public function _setLimit()
{
	$this -> _start = $this -> _getStart();
	if( $this -> _start > 0 )
	{
		if( QUERY == 'mysql') {
			$this->_setCompiler(" LIMIT {$this -> _start}, {$this -> _pages} ");
		}

		if( QUERY == 'mssql') {
			$this->_setCompiler(" OFFSET {$this -> _start} ROWS FETCH NEXT {$this -> _pages} ROWS ONLY ");
		}
	}	
	else
	{
		if( QUERY == 'mysql') {
			$this->_setCompiler(" LIMIT {$this -> _start}, {$this -> _pages} ");
		}

		if( QUERY == 'mssql') {
			$this->_setCompiler(" OFFSET {$this -> _start} ROWS FETCH NEXT {$this -> _pages} ROWS ONLY ");
		}
	}	
}

// ------------------------------------------------
/* 
 * @ pack : _get_total_record 
 */
 
 function _get_total_record()
 {
	 
 $this->pager  = $this->_getDatabase(); 
 $this->total = 0;
 
 
 if(  !is_null($this->_compile) 
	AND strlen($this->_compile) > 0 )  
 {
	// printf("%s", $this->_compile);
	$rs = $this->pager->query( $this->_compile );
	if( $rs && $rs->num_rows() > 0 ) {
		
	// -- add catch counting  --------------------------------
	
		if( FALSE == $this->ar_count ){
			$this->total = $rs->num_rows();	
		}  else {
			$this->total = $rs->result_singgle_value();
		}
	}
 }
 
 return (int)$this->total;
}

// ------------------------------------------------
/* 
 * @ pack : _get_total_page 
 */
 public function _get_total_page()
 {
	$_total_pages = 1;  
	$_totals_record = self::_get_total_record();
	if( $_totals_record > 0 ) 
	{
		$_total_pages = ceil( ($_totals_record)/($this -> _pages ) );
	}
	
	return $_total_pages;
 }
 

// -----------------------------------------------------------

/* 
 * Method 		index
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 
 public function _result()
{
	$_conds = FALSE;
	$_EUI =& get_instance();
	
	$_RES =$_EUI->db->query( $this->_compile );
	if( is_object($_RES) ) { 
		$_conds = $_RES;
	}	
	else {
		exit(self::Exception());
	}	
	
	return $_RES;
 }
 

// -----------------------------------------------------------

/* 
 * Method 		index
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 public function _get()
{
  
  $arr_false= FALSE;
  $arr_object = &get_instance();
  
  if( !$arr_object)
  {
	exit( $this->Exception() );
  }
  
 //------------- on result query buffer -----------------
 
  $arr_result = $arr_object->db->query($this->_compile);
  if(!is_object($arr_result))
  {
	exit( $this->Exception() );
  }
  
  return $arr_result;
  
} 
 

// ------------------------------------------------
/* 
 * @ pack : _set_style 
 */
 public function _set_style( $key =NULL, $value='' )
 {
	if(!is_null($key))  
	{
		if( !is_array( $key ) ) {
			$this->_rows_styles[$key] = $value;
		} 
		else{
			$this->_rows_styles = $key;
		}
	}
 }
 
// ------------------------------------------------
/* 
 * @ pack : _set_font_color 
 */
 
 public function _set_font_color($color= null )
 {
	if(!is_null($color))  {
		$this->_set_style('font-color',$color);
	}
 }
 
// ------------------------------------------------
/* 
 * @ pack : _set_background_color 
 */
 
 public function _set_background_color($color= null)
 {
	if( !is_null($color) )
	{
		$this->_set_style('background-color', $color);
	}
 }
// ------------------------------------------------
/* 
 * @ pack : _set_font_size 
 */
  
 public function _set_font_size( $size = null  )
 {
	if( !is_null($size) )
	{
		$this->_set_style('font-size', $size);
	}	
 }
 
// ------------------------------------------------
/* 
 * @ pack : _set_font_family 
 */
 
 public function _set_font_family($font = null )
 {
	if( !is_null($font) ) 
	{
		$this->_set_style('font-family', $font);
	}
 }
 
// ------------------------------------------------
/* 
 * @ pack : _selected_header 
 */
  
public function _selected_header( $field = null )
{
	$_bools = NULL;
	$post_styles = $this->_get_order_style();
	if( is_string($field) AND is_array($post_styles) )
	{
		if(in_array($field, array_keys($post_styles)))
		{
			$_bools = $post_styles[$field]['order'];
		}	
	}
	
	return $_bools;
}

// ------------------------------------------------
/* 
 * @ pack : _selected_columns 
 */
  
public function _selected_columns( $field = NULL )
{
	$_bools = '';
	$post_styles = $this->_get_order_style();
	if( is_string($field) AND is_array($post_styles) )
	{
		if(in_array($field, array_keys($post_styles)))
		{
			$this->_styles[$field]['style'] = $this->_get_styles();
			$_bools = $this->_get_styles();
		}	
	}
	return $_bools;
}

// ------------------------------------------------
/* 
 * @ pack : _selected_columns 
 */
  
 public function _get_styles()
 {
	$_bools = FALSE;
	
// @ pack : set default  style 	

	if( !is_array($this->_rows_styles) 
		AND  count($this->_rows_styles)==0 )
	{
		$this->_set_style("font-size", "11px");
		$this->_set_style("font-color", "#8A1B08");
		$this->_set_style("background-color", "#FFFCCC");
	}
	
// @ pack : compile attribute css 
	
	$style = 'style="';
	if(is_array($this->_rows_styles) )
	  foreach( $this->_rows_styles as $key => $value )
	{
		$style .= $key . $this->_CRLF . $value . $this->_EOFL;
	} 
	
	$style .='"';
	
	return $style;
 }
 

// ------------------------------------------------
/* 
 * @ pack : _setLikeCache 
 */
  
public function _setLikeCache($_field = NULL, $_cache = NULL,  $on = FALSE )
{
	
 $UI =& get_instance();
 
 if( !is_null($_field) AND !is_null($_cache) )
 {	
    if( $UI->URI->_get_have_post($_cache) 
		AND $UI->URI->_get_post($_cache)!='')
	{ 
		$this->_setLike($_field, $UI->URI->_get_post($_cache));
		if( ($on != FALSE ) ) 
		{
			$UI->EUI_Session->replace_session( $_cache, $UI->URI->_get_post($_cache) );
		}	
	}
	else
	{
		if( $UI->EUI_Session->_have_get_session($_cache) ) 
		{
			if( isset($_REQUEST[$_cache]) AND ( $_REQUEST[$_cache]=='' )  )
			{
				if(($on != FALSE )) 
				{
					$UI->EUI_Session->deleted_session($_cache);		
				}	
			}
			else
			{
				if(($on != FALSE )) 
				{
					$this->_setLike($_field, $UI->EUI_Session->_get_session($_cache));
				}	
			}	
		}
	}
 }
}
 


// --------------------------------------
/*
 * @ pack : having like  on cache session 
 */
 
 public function _setHavingLikeCache( $field = null, $_cache = null, $on=FALSE )
{
// type default having -----------------------------------
  $type = " HAVING ";
  if( count($this->_arr_having)> 0 ) {
	$type = " AND ";
  } 
 
 // if true session ------------------------------------- 
 $UI=& get_instance();
 if( !is_null($field) AND !is_null($_cache) ) 
{
 // cek parameter cahce ----------------------------------------------------------------- 
	 if( $UI->URI->_get_have_post($_cache) 
		AND $UI->URI->_get_post($_cache)!='' )
	 {
	 // check validation data -----------------------------------------------------------------
		$this->_HavingLike( $field, $UI->URI->_get_post($_cache), $type );
		
	 // on cache  -----------------------------------------------------------------------------	 	 
		 if( $on ) 
		 {
			$UI->EUI_Session->replace_session( $_cache, $UI->URI->_get_post($_cache) );
		 }
	 } 
	 else
	 {
		if( $UI->EUI_Session->_have_get_session($_cache) ) 
		{
			if( isset($_REQUEST[$_cache]) 
				AND ( $UI->URI->_get_post($_cache) =='' )  )
			{
				if( $on ){
					$UI->EUI_Session->deleted_session($_cache);		
				}	
			}
			else
			{
				if( $on )  
				{
					$this->_HavingLike( $field, $UI->EUI_Session->_get_session($_cache), $type); 
				}	
			}
		}
	 }
 } 
 // end of field --------------------------------------->
 
}


// --------------------------------------
/*
 * @ pack : having on cache session 
 */
 
 public function _setHavingCache( $field = null, $_cache = null, $on=FALSE )
{
// type default having -----------------------------------
  $type = " HAVING ";
  if( count($this->_arr_having)> 0 ) {
	$type = " AND ";
  } 
 
 // if true session ------------------------------------- 
 $UI=& get_instance();
 if( !is_null($field) AND !is_null($_cache) ) 
{
 // cek parameter cahce ----------------------------------------------------------------- 
	 if( $UI->URI->_get_have_post($_cache) 
		AND $UI->URI->_get_post($_cache)!='' )
	 {
	 // check validation data -----------------------------------------------------------------
		$this->_Having( $field, $UI->URI->_get_post($_cache), $type );
		
	 // on cache  -----------------------------------------------------------------------------	 	 
		 if( $on ) 
		 {
			$UI->EUI_Session->replace_session( $_cache, $UI->URI->_get_post($_cache) );
		 }
	 } 
	 else
	 {
		if( $UI->EUI_Session->_have_get_session($_cache) ) 
		{
			if( isset($_REQUEST[$_cache]) 
				AND ( $UI->URI->_get_post($_cache) =='' )  )
			{
				if( $on ){
					$UI->EUI_Session->deleted_session($_cache);		
				}	
			}
			else
			{
				if( $on )  
				{
					$this->_Having( $field, $UI->EUI_Session->_get_session($_cache), $type); 
				}	
			}
		}
	 }
 } 
 // end of field --------------------------------------->
 
}

// ------------------------------------------------
/* 
 * @ pack : _setAndCache 
 */
  
public function _setAndCache( $_field = NULL, $_cache = NULL, $on = FALSE  )
{
$UI =& get_instance();

 
 if( !is_null($_field) AND !is_null($_cache) )
 {	
	if( $UI->URI->_get_have_post($_cache) 
		AND $UI->URI->_get_post($_cache)!='')
	{ 
		/**  handle format array(); **/
		$this->_setAnd($_field, (string)$UI->URI->_get_post($_cache) );
		
		/** if on  ==true then set to session **/
		
		if(($on != FALSE )) { 
			$UI->EUI_Session->replace_session( $_cache, (string)$UI->URI->_get_post($_cache) );
		}
	}
	else
	{	
		if( $UI->EUI_Session->_have_get_session($_cache) ) 
		{
			if( isset($_REQUEST[$_cache]) AND ( $_REQUEST[$_cache]=='' )  )
			{
				if(($on != FALSE )) 
				{
					$UI->EUI_Session->deleted_session($_cache);		
				}	
			}
			else
			{
				
				if(($on != FALSE ))  {
					$this->_setAnd($_field, $UI->EUI_Session->_get_session($_cache));
				}	
			}	
		}
	}
 }
 
} 

// ------------------------------------------------
/* 
 * @ pack : _setAndOrCache 
 */
  
 public function _setAndOrCache( $_field = NULL, $_cache = NULL, $on = FALSE  )
{
	
 $UI =& get_instance();
 if( !is_null($_field) AND !is_null($_cache) )
 {	
	if( $UI->URI->_get_have_post($_cache) 
		AND $UI->URI->_get_post($_cache)!='')
	{ 
		$this->_setAnd($_field, FALSE);
		
		if(($on != FALSE ))
		{ 
			$UI->EUI_Session->replace_session( $_cache, $UI->URI->_get_post($_cache) );
			if( is_array($this->_or_cache))
			{
				$this->_or_cache[$_cache] = $_field;
			}
			
			$UI->EUI_Session->replace_session('or_cache',$this->_or_cache);
		}
	}
	else
	{
		if( $UI->EUI_Session->_have_get_session($_cache) ) 
		{
			if( isset($_REQUEST[$_cache]) AND ( $_REQUEST[$_cache]=='' )  )
			{
				if(($on != FALSE )) {
					$UI->EUI_Session->deleted_session($_cache);			
				}	
			}
			else
			{
				if(($on != FALSE )) 
				{
					
					$_or_cache = $UI->EUI_Session->_get_session('or_cache');
					
					if(is_array($_or_cache) )
					{
						if( in_array($_cache, array_keys($_or_cache) ) )
						{
							$this->_setAnd($_or_cache[$_cache], FALSE);
						}
					}
				}	
			}	
		}
	}
 }
} 


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 public function _setHavingOrCache( $field = null, $_cache = null, $on=FALSE )
{
// type default having -----------------------------------
  $type = " HAVING ";
  if( count($this->_arr_having)> 0 ) {
	$type = " AND ";
  } 
 
 // if true session ------------------------------------- 
 $UI=& get_instance();
 if( !is_null($field) AND !is_null($_cache) ) 
{
 // cek parameter cahce ----------------------------------------------------------------- 
	 if( $UI->URI->_get_have_post($_cache) 
		AND $UI->URI->_get_post($_cache)!='' )
	 {
		 
	 // check validation data -----------------------------------------------------------------
		$this->_Having( $field, NULL, $type );
		
	 // on cache  -----------------------------------------------------------------------------	 	 
		 if( $on ) 
		 {
			$UI->EUI_Session->replace_session( $_cache, $UI->URI->_get_post($_cache) ); 
			if( is_array($this->_or_having_cache)) {
				$this->_or_having_cache[$_cache] = $field;
			}
			$UI->EUI_Session->replace_session('or_having_cache',$this->_or_having_cache);
		 }
	 } 
	 else
	 {
		if( $UI->EUI_Session->_have_get_session($_cache) ) 
		{
			if( isset($_REQUEST[$_cache]) 
				AND ( $UI->URI->_get_post($_cache) =='' )  )
			{
				if( $on ){
					$UI->EUI_Session->deleted_session($_cache);		
				}	
			}
			else
			{
				if( $on != FALSE ) {
					$arr_having_cahce = $UI->EUI_Session->_get_session('or_having_cache');
					if(is_array($arr_having_cahce) 
						AND in_array($_cache, array_keys($arr_having_cahce) ) )
					{
						$this->_Having($arr_having_cahce[$_cache], null, $type);
					}
				}	
			}
		}
	 }
 } 
 // end of field --------------------------------------->
 
}

// ------------------------------------------------
/* 
 * @ pack : _setWhereinCache 
 */
  
public function _setWhereinCache( $_field = NULL, $_cache = NULL, $on = FALSE  )
{
 $UI =& get_instance();
 if( !is_null($_field) AND !is_null($_cache) )
 {	
	if( $UI->URI->_get_have_post($_cache) 
		AND $UI->URI->_get_post($_cache)!='')
	{ 
		$this->_setWherein($_field, $UI->URI->_get_array_post($_cache));
		if(($on != FALSE )) 
		{ 
			$UI->EUI_Session->replace_session( $_cache, $UI->URI->_get_post($_cache) );
		}	
	}
	else
	{
		if( $UI->EUI_Session->_have_get_session($_cache) ) 
		{
			if( isset($_REQUEST[$_cache]) AND ( $_REQUEST[$_cache]=='' )  )
			{
				if( ($on != FALSE )) 
				{ 
					$UI->EUI_Session->deleted_session($_cache);		
				}	
			}
			else
			{
				if(($on != FALSE )) 
				{
					$this->_setWherein($_field, explode(',',$UI->EUI_Session->_get_session($_cache)));
				}	
			}	
		}
	}
 }
 
}



// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : _get_content
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 * @ param .............. : controller . 
 */
 
function _select_cache_field_order( $cache = null ) {
	 
	 
 $CI=& get_instance();
 $ar_list  = array(); 
 
 
 if( is_null( $cache ) ){
	$cache = $CI->URI->segment(1);
 }
 
 $ar_field = sprintf('%s_%s', $cache,'order_by');
 $ar_type  = sprintf('%s_%s', $cache,'type');
 
 if( get_cokie_cond($ar_field) 
	 and get_cokie_cond($ar_type) )
{
	$ar_list = array(
		'order_field' => get_cokie_value( $ar_field ),
		'order_type' => get_cokie_value( $ar_type ));	
 }
 return call_user_func('Objective', $ar_list);
 
}
	
// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : _get_content
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
 
 function _setOrderCache( $out, $cond = true )
{ 
  $CI=& get_instance();

// --- default session cache ---------------------------

  $this->ar_order_page = $CI->URI->segment(1);
  $this->ar_cache_field = sprintf('%s_%s', $this->ar_order_page,'order_by');
  $this->ar_cache_type  = sprintf('%s_%s', $this->ar_order_page,'type');
  
 /// --- then indentification  ---------------------------------------------------
 
  $this->ar_order_field = null;
  $this->ar_order_type = null;
  
  if( is_object( $out ) and $out->find_value('order_by') ){
	 $this->ar_order_field = $out->get_value('order_by');  
	 if( TRUE == $cond ){
		set_cokie_replace($this->ar_cache_field, $this->ar_order_field);
	 }
  }
  
  if( is_object( $out ) and $out->find_value('type') ){
	 $this->ar_order_type = $out->get_value('type');
	 if( TRUE == $cond ){
		set_cokie_replace($this->ar_cache_type, $this->ar_order_type);
	 }
  }
  
 // ---cek of the session  -----------------------------------
 
  
  if( get_cokie_cond($this->ar_cache_field) and get_cokie_cond($this->ar_cache_type) ){
	$this->_setOrderBy(get_cokie_value($this->ar_cache_field), get_cokie_value($this->ar_cache_type), true); 	  
 } else {
	set_cokie_delete($this->ar_cache_field);
	set_cokie_delete($this->ar_cache_type);
 }
  
}
// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : _get_content
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 * @ param .............. : controller . 
 */
protected function _get_select_where_and_or()
{
   $_key = NULL;
   if( count($this->_or_like)> 0 ) 
   {
		$_key = "( ";
		$num = 0;
		foreach($this->_or_like as $fld => $value ) 
		{
			if( $num ==0 )  
				$_key .= " $fld ${value}";
			else 
				$_key .= " OR $fld $value ";	
			
			$num++;
		}
	
	$_key.= " ) ";
	
   }
   
 // cek if null string 
 
   if( !is_null($_key) ) {
	  $this->_or_like = array();
	  $this->_setAnd($_key);
   }
}
 
// -----------------------------------------
/*
 * @ pack : _getCompiler 
 */
 
 public function _getCompiler()
{
 $debugs = NULL;
 
 if( !is_null( $this->_compile))
 { 
	$arr_error = $this->_compile;
	if( preg_match("/FROM/", $arr_error) )
	{
		$arr_error = str_replace("SELECT", "SELECT<br/>", $arr_error);
		$arr_error = str_replace("FROM",   "<br/>FROM",   $arr_error);
		$arr_error = str_replace("LEFT",   "<br/>LEFT",   $arr_error);
		$arr_error = str_replace("WHERE",  "<br/>WHERE",  $arr_error);
		$arr_error = str_replace("AND",    "<br/>AND", 	  $arr_error);
		$arr_error = str_replace("ORDER",  "<br/>ORDER",  $arr_error);
		$arr_error = str_replace("HAVING",  "<br/>HAVING",$arr_error);
		$arr_error = str_replace("LIMIT",  "<br/>LIMIT",  $arr_error);
		$arr_error = str_replace("GROUP BY",  "<br/>GROUP BY",  $arr_error);
		
		$debugs = " <div class=\"ui-widget-error-sql\"> <b> ". get_class($this) ."->Compiler : </b><br>{$arr_error}</div>";
		   
		   
	}
 }
 
 return $debugs;		
 }
 
// -----------------------------------------
/*
 * @ pack : _getCompiler 
 */
 
 public function _get_query()
{
  return $this->_compile;
 
} 
 
// -----------------------------------------
/*
 * @ pack : _getCompiler 
 */
 
 private function Exception()
 {
    $arr_log =array('class' =>$this);
	$_error =&load_class('Exceptions', 'core');
	$_error->show_error_page($arr_log, 'error_dbpg');
 }
 
 
// -------------------------------------------------------------------------------
 
/*
 * Modul 		errror_pege 
 *
 * @pack 		return if dtected errror_pege 
 * @param 		not have attribute 
 */
 
 public function _error_page() 
{
	if( $this->_compile ){
		return $this->_getCompiler();
	}
}
 
 
}
?>