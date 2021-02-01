<?php

/*
 * @ package : core model upload extends Model
 */
 
 class EUI_Upload
{
  
 /*
  * @ construct 
  */
  
 public function __construct() 
  {
	log_message('debug', "Model Class Initialized");
  }

  
 /*
  * @ instance of parent class 
  */  
  
 public function __get( $key ) {
	$EUI =& get_instance();
	return $EUI -> $key;
  }
  
}

// END OF Class ------------------------------------
	
?>