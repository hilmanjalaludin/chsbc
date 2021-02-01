<?php

class EUI_Helper{
	
private static $_Helper;

public $_Website;	

function __construct()
{
	self::$_Helper = null;
}


public static function & _getInstance()
{
	if(  is_null( self::$_Helper) )
	{
		self::$_Helper = new self();	
	}
	
	return self::$_Helper;	
}


public function _test_helper(){
	echo get_class($this);
}



}
?>