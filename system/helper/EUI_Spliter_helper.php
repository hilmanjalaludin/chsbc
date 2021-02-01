<?php 
// ----------------------------------------------------
/*
 * @ package 		class iseng 
 *
 */
 
class Spliters{
	
// --------------------------------	
private $arr_spliter = array();
private $arr_maps = array();
private $arr_scallar = array();
private static $Instance = null;

// @ package 	instance 

public static function &Instance() {
 if( is_null(self::$Instance) ){
	self::$Instance = new self();
 }	
 return self::$Instance;	
}

// @ package	: inialize --------------------------------	

 public function inialize( $argc  = null, $split = ",", $arr_map = null )
{
  $this->arr_spliter = explode($split, $argc);
  $this->arr_maps = (array)$arr_map;
}

// @ package	: __construct --------------------------------	

 public function __construct( $argc  = null, $split = ",", $arr_map = null  )
{
  $this->arr_spliter = explode($split, $argc);
  $this->arr_maps = (array)$arr_map;
}

// public  get all array -------------------
 public function get_array(){
	return array_values($this->arr_spliter);
 }

// @ package	: get_value --------------------------------

  public function set_array_map( )
{
	  if( count($this->arr_maps) == count($this->arr_spliter)  ) 
	 {
		 foreach( $this->arr_spliter as $ds => $value ){
			 $this->arr_scallar[$this->arr_maps[$ds]] = $value; 
		 }
	 } 
	 else{
		 
		if( count($this->arr_maps) > 0 ) { 
			for( $i = 0; $i < count($this->arr_spliter); $i++ ){
				$this->arr_scallar[$this->arr_maps[$i]] = $this->arr_spliter[$i]; 
			}	
		} else {
			$this->arr_scallar = (array)$this->arr_spliter;
		}
	 }
 }

// @ package	: get_value --------------------------------	
  public  function get_value( $num = null, $event = null ) 
{
	if( !$this->fetch_ready() ){
		return null;	
	}	
	
	if(is_null($event) ){
		return ( isset( $this->arr_scallar[$num] ) ? $this->arr_scallar[$num] : '' );
	} else {
		
		if( function_exists($event) ){
			return call_user_func_array($event, array($this->arr_scallar[$num]));
		} else {
			return ( isset( $this->arr_scallar[$num] ) ? $this->arr_scallar[$num] : '' );
		}
	}	
	
	
 }
			
// @ package	: fetch_ready --------------------------------		
 public function fetch_ready() 
{
	$this->set_array_map();	
	if( count($this->arr_scallar) == 0 ){ return false;
	} else { 
		return true;
	}
 }
 
 
 // ================== END CLASS =================================
 
}