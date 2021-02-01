<?php

/*
 * E.U.I  1.0.0
 
 * setup & rooutes & autoladder  
 
 *@ Configuration settup application 
 *@ session prefix and other settup  
 **/
 
 
class EUI_Controller 
{
 
/**
 ** static variable 
 **/
 
private static $instance;
 
 /** 
  ** constructor harus di ikutkan di setiap membuat controller 
  ** go way for loade all
  **/
  
public function __construct()
 {
	self::$instance =& $this;
	foreach (is_loaded() as $var => $class) {
		$this->$var =& load_class($class);
	}

	$this -> load =& load_class('Loader', 'core');
	$this -> load -> set_base_classes() -> eui_autoloader();
	log_message('debug', "Controller Class Initialized");
}

/** 
 ** get_instance () leave direct object
 **/
 
public static function &get_instance()
{
	return self::$instance;
}
}

?>