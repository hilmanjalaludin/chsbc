<?php
// --------------------------------------------------
/*
 * @ pack  : convert array to object on EUI v.1.2 
 * @ notes : testing object array 
 * @ auth  : omens 
 */
 
class EUI_Object  {

private $arr_val = "";
// -------------------------------------------
/*
 * @ pack : instance 
 */

 
var $find_vals_args = "";
// -------------------------------------------
/*
 * @ pack : instance 
 */

protected $arr_rows = array();
protected $arr_func_arg = array();


// ----------------------------------------------
/*
 * @ pack : instance 
 */
 
 private static $Instance = null;

 
// --------------------------------------------
/*
 * @ pack : instance 
 */
 
 public static function &Instance()
{
  if( is_null(self::$Instance) )
  {
	 self::$Instance = new self();
  }
  
  return self::$Instance;
  
 }

// --------------------------------------------
/*
 * @ pack : aksesor 
 */

 public function EUI_Object( $arr_object = null )
{
 
  if( !is_null($arr_object) )
  {
	 $this->Inialize( $arr_object );	
  }  
}

// --------------------------------------------
/*
 * @ pack 	: Inialize 
 * @ aksess : public method 
 */
 
 public function fetch_ready()
{
 if( is_array( $this->arr_rows ) 
	AND count( $this->arr_rows ) > 0  )
 {
	return true;
  }	
 return false;
}


// --------------------------------------------
/*
 * @ pack 	: Inialize 
 * @ aksess : public method 
 */
 
public function Inialize( $arr_object = null )
{
	$this->arr_rows =(array)$arr_object;
}

// --------------------------------------------
/*
 * @ pack : conversi field name to label of lang 
 */ 
 
function lang( $val='' ) {
	return lang( array($val));
}
	
	
// --------------------------------------------
/*
 * @ pack : _value 
 */
 
function _value( $value = null ) 
{
	
	
  $value = trim($value);
  if( is_null($value) ) {
	return NULL;
  }
 
  if( isset($this->arr_rows[$value]) AND empty($this->arr_rows[$value]) 
	  AND !$this->arr_rows[$value] == 0 ) 
 {
	return NULL;
  }
  
 if( isset($this->arr_rows[$value]) AND is_null($this->arr_rows[$value]) ) {
	return NULL;
 } 
 
 if( !isset($this->arr_rows[$value]) ) {
	return NULL;
 } 
   
   return $this->arr_rows[$value];
  
}

// --------------------------------------------
/*
 * @ pack : _event_value if have function attribute value  
 */
 
 function _event_value( $value = null, $event=null, $context = null ) 
{
  if( is_null( $context ) OR strlen($context) == 0 ){	
	$_value = $this->_value( $value );
  } else {
	$_value = $context;
  }

  if(!function_exists( $event ) )
  {
	return $_value; 
  }
  
   return call_user_func_array( $event, array($_value) );  
  
}


// --------------------------------------------
/*
 * @ pack : instance 
 * @ aksess : public method 
 
// ---------------------------------------------
  
 * @ par1 : array input 
 * @ par2 : sorter array  
 */
  
 public function get_array_order( $value = null, $asc = 'sort' ) 
{
  $arr_val = $this->get_splits_value($value);

  if( count($arr_val) ==0 ){
	return NULL;
  }	  
  
  $arr_sorter = array('asort', 'arsort', 'krsort','ksort','sort','rsort');
  if( in_array($asc, $arr_sorter )){
	if(function_exists( $asc ) ){  
		$asc($arr_val);
	}
  }	
  return (array)$arr_val;
  
}

// --------------------------------------------
/*
 * @ pack : instance 
 * @ aksess : public method 
 
// ---------------------------------------------
  
 * @ par1 : array input 
 * @ par2 : sorter array  
 */
  
 public function get_value_order( $value =''  )
{
	$arr_order = $this->get_array_order( $value );
	if( is_array($arr_order) and count($arr_order) > 0  ){
		return (string)join(",", $arr_order);
	}	
	return NULL;
 } 
// --------------------------------------------
/*
 * @ pack : instance 
 * @ aksess : public method 
 
// ---------------------------------------------
  
 * @ par1 : field value 
 * @ par2 : function  
 */
  
 public function get_splits_value( $value = null , $splite="," ) 
{
 $arr_value  = array();
  if( count($arr_value) == 0 AND  !is_null($value) )
 {
	if( $this->find_value($value) ){
		$arr_value = explode($splite,  $this->_value($value) );
	}
 }
 
 return (array)$arr_value;
	
}

// --------------------------------------------
/*
 * @ pack : instance 
 * @ aksess : public method 
 
// ---------------------------------------------
  
 * @ par1 : field value 
 * @ par2 : function  
 */
 
public function get_array_value( $value = null , $event = NULL ) 
{
 $arr_value = explode(",", $this->_value( $value )); 
 
 $arr_outer = array();
 if( is_null($event) ) 
 {
	foreach( $arr_value as $k => $val ) {
		if( strlen( trim($val) ) > 0 ){
			$arr_outer[$k] = $val;
		}
	}	
 }
 
  if( !is_null($event) ) 
 {
	foreach( $arr_value as $k => $val ) 
	{
	  if( strlen( trim($val) ) > 0 )
	  {	
		if(function_exists($event) ){
			$arr_outer[$k] = call_user_func_array($event, array($val)); 
		} else {
			$arr_outer[$k] = $val;
		}
	  }	
	}	
 }
 
 return $arr_outer;
}

 
// ---------------------------------------------
/*  
 * @ par1 : field value 
 * @ par2 : function  
 */

function callback($var = null, $val = null){
  if( !IsFunction( $val ) ){
	return $var;
  }
  return call_user_func( $val, $var);
}
  

// -- thi triger other function like 
// will trusted only not primary event 
// then will the getdata by case 
 
 
function find( $key = null ){
	if( is_null( $key ) ){
		return false;
	}
	
// will called of class with inhertance class 
// instance 

	$rs = Objective( $_REQUEST );
	$fd = @in_array( $key, $rs->fetch_label());
	if( ! $fd ){
		return false;
	}
	return true;
}

// -- thi triger other function like 
// will trusted only not primary event 
// then will the getdata by case 
 
 
function find_cookie( $key = null, $val = '' ){
	return $this->find_case( $key, $val );
}
 
// ------------------------------------------------------
// @ param 		@key, $val
// @ note		compare string on finding char 
// 				data this will not case sensitif 	
// 				just only atrubute for esey use 
  
function strcmp( $key = null, $val = '' ){
	return $this->find_case( $key, $val );
}
 
// ------------------------------------------------------
// @ param 		@key, $val
// @ note		compare string on finding char 
// 				data this will not case sensitif 	
// 				just only atrubute for esey use 
 
function find_case( $key=null, $val='' )
{
 if( TRUE == is_null($key) ) { return false; }
 
 if( FALSE == $this->find_value( $key ) ){
	return false;
 } 
 
 // -- jika data pembanding bertipe array --- 
 
 if( is_array( $val ) ){
	$key = $this->get_value($key);
	if( in_array( $key, $val) ){
		return true;
	} else {
		return false;
	}		
 }
 
 // --- singgle methode ---- 
 
  $key = $this->get_value($key);
  if( strcmp($key, $val) == 0 ) {
	 return true;	
  }
	return false;
}	
 
 
// ---------------------------------------------
/*  
 * @ par1 : field value 
 * @ par2 : function  
 */
 
 
 public function find_value() 
{
	
 $this->find_vals_args  = '';	
 $this->arr_list_args  = func_get_args();
 $this->arr_num_args   = func_num_args();
 
 if( !$this->arr_num_args ){
	return FALSE;
 }
 
 if(!is_array($this->arr_list_args) ){
	return FALSE;
 }	
 
 $this->find_vals_args = $this->get_value($this->arr_list_args[0]);
  if( !is_array($this->find_vals_args) 
	AND !is_object($this->find_vals_args)  )
 {
	$str_val = $this->find_vals_args;
	return ( strlen($str_val) > 0 ? TRUE : FALSE ); 
	 
 }
 
 return TRUE;
 
}
 
// ---------------------------------------------
/*  
 * @ par1 : field value 
 * @ par2 : function  
 */
 function push( $key=null, $val='' ) {
	$arr = $this->field($key);
	array_push($arr, $val);
	return $arr;
}

// ---------------------------------------------
/*  
 * @ par1 : field value 
 * @ par2 : function  
 */
public function add( $key=null, $val='') {
	$this->arr_rows[$key] = $val;
}

// ---------------------------------------------
/*  
 * @ par1 : field value 
 * @ par2 : function  
 */
 function field( $key=null, $val='' ) {
	return $this->get_value($key, $val);
 }

// ---------------------------------------------
/*  
 * @ par1 : field value 
 * @ par2 : function  
 */
 function fields( $key = null, $val = null ) {
	return $this->get_array_value($key, $val);
 }
 
 // on in string array method .
 
 function intvalue( $key = null, $val = null ) {
	 $arr_lst = $this->field($key, $val );
	 $arr_ret = array();
	 
	 // jika data bernilai array 
	 if( is_array($arr_lst) )
		 foreach( $arr_lst as $k => $v  ){
		 $arr_ret[$v] = $v;
	 }
	 return implode(',', $arr_ret);
 } 
 
 
// ---------------------------------------------
/*  
 * @ par1 : field value 
 * @ par2 : function  
 */
 
 public function get_value( $value = null , $event = NULL ) 
{
  if( is_null( $value ) ){
	return (array)$this->arr_rows;
  }	  
	
 if( is_object( $value ) ){
	return call_user_func($event, $this->arr_rows); 
 } 	
 
 if( is_null($event) ) {
	return $this->_value( $value );
 }

 if(!is_array($event) ){
	$event = array( $value => $event);	
 }
	
  if ( isset($arr_val) ) {
  	 $arr_val = '';
  } else {
  	 $arr_val = '';
  }

  $arr_val = $arr_val;

  // ----------------------------------------------------->>
  
  if(is_array($event))
	   foreach( $event as $n => $argc ) 
  {
	if( !$n ) {
		$arr_val= $this->_event_value($value, $argc);
	}
	 else {
		$arr_val = $this->_event_value($value, $argc,  $arr_val);
	 }
  }
  
 return  $arr_val;
}

// --------------------------------------------
/*
 * @ pack : _object 
 */
 
 protected function _object( $arr_object = null ) 
{
   return (object)$arr_object;
}


// --------------------------------------------
/*
 * @ pack : get_object 
 */ 
 
 public function fetch_rows( $n = 0 )
{
   $arr_rows = $this->get_value( $n ); // first_rows 
    if( is_array( $arr_rows ) ) 
   {
	  $this->arr_header_value = (array)$arr_rows;
   }
   
   return $this->arr_header_value;
} 



// --------------------------------------------
/*
 * @ pack : get_object 
 */ 

public function debug_label()
{
	echo "<pre>";
		print_r($this->fetch_label());
	echo "</pre>";
		
} 


 /**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
public function debug_field()
{
	printf("<pre>","\n");
	print_r($this->fetch_field());
	printf("</pre>","\n");
} 


 /**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
public function fetch_array() {
   return (array)$this->arr_rows;			
}

// --------------------------------------------
/*
 * @ pack : get_object 
 */ 
 
 public function fetch_field()
{
  $arr_field = array();	 
  $arr_rows = $this->fetch_rows();
  if( is_array( $arr_rows ))
  {
	  $arr_field  = (array)_getKey($arr_rows);
	  if(is_array($arr_field))
	   foreach($arr_field as $k => $value ) 
	 {
		$this->arr_label[$value] = $value;
	  }
  }	
  
  return $this->arr_label;
} 


// --------------------------------------------
/*
 * @ pack : get_object 
 */ 
 
 public function fetch_label( $object = false )
{
  if( $object  == false ){
	return array_keys($this->arr_rows);
  }
  
  // jika kondisi parameter adalah true maka balikan nilainya ke
  // dalam bentuk object .
  if( $object  == true )
  {
	  $ar_list = array();
	  foreach( array_keys($this->arr_rows) as $key => $val ){
		  $ar_list[$val] = $val; 
	  }
	  return Objective( $ar_list );
  }
  
  return null;
} 

// --------------------------------------------
/*
 * @ pack : get_object 
 */
 
 public function get_object() 
{
   return $this->_object( $this->arr_rows);
}

// END CLASS  
}

// new class extends EUI_Object 

final class ArrObj extends EUI_Object {
	function ArrObj( $arr = null ){
		if( is_array( $arr ) ){ 
			$this->Inialize( $arr );
		} 
		return $this;
	}
}
// --- end class ----------------------

?>