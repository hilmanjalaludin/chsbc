<?php 
/**
 ** Model Configuration and library
 ** EUI < Enigma User interface 0.1 >
 ** Licensed under the MIT ( http://razakitechnology.com/siteraztech/product/web-application ) license.
 ** Copyright © 2014-2012 razaki Labs ( http://razakitechnology.com )        
 **/

class Curl extends Plugin
{
	var $_ch = null;
	var $_url = null;
	var $_res = null;
	
	
function Curl()
{
	// aksesor load first **
}
	
function _Curl($collate_url)
{
	if( $collate_url !='' ) 
	{
		$this  -> _url = $collate_url;
	}
}
	
function _buffer_curl_init()
 {
		$this -> _ch = curl_init();
	}
	
function _get_init_result()
 {
	if( $this -> _res ) return $this -> _res;
	else
		return array();
	}

 function execute_curl_data()
 {
		$init_result = false;
		$this -> _buffer_curl_init();
		if( $this -> _url ){
			curl_setopt( $this -> _ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt( $this -> _ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt( $this -> _ch, CURLOPT_URL, $this -> _url);
			$init_result = curl_exec( $this -> _ch );
		}
		
		$this -> _res = $init_result;
	}
	
	public function execute_array_data()
	{
		if( $this -> _get_init_result() )
			return json_decode($this -> _get_init_result(), true);
	}
}
?>

