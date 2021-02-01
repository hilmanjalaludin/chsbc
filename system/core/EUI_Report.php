<?php
/**
 ** Model Configuration and library
 ** EUI < Enigma User interface 0.1 >
 ** Licensed under the MIT ( http://razakitechnology.com/siteraztech/product/web-application ) license.
 ** author < razaki team >
 ** Copyright © 2014-2012 razaki Labs ( http://razakitechnology.com )        
 **/

 class EUI_Report
{
  function __construct() {
	log_message('debug', "Model Class Initialized");
  }

  function __get( $key )
  {
		$EUI =& get_instance();
		return $EUI -> $key;
  }
}	
?>