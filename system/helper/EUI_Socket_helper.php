<?php
/*
 * @ E.U.I framework v.1.0
 *
 
 * @ EUI_Socket		  : Run CTI from Command Prompt by Telnet.
 * @ author			  : razaki team deplovment 
 * @ Manager server    : < 127.0.0.1/ localhost >
 * @ Manager port	  : < 9800 >
 * @ link			  : http://www.razakitechnology.com/siteraztech/product/web-application
 */
 
class EUI_Socket 
{

/*
 ^ @ def		_get_content_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
 protected $serverHost = 'localhost';
	
/*
 ^ @ def		_get_content_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
 protected $serverPort = '9800';

/*
 ^ @ def		_get_content_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
 protected $command_string	= '';
	
/*
 ^ @ def		_get_content_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
 protected $error_string	= '';
	
/*
 ^ @ def		_get_content_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
 private $messages_replay	= '';
	
/*
 ^ @ def		_get_content_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
 private static $instance;
 
 /*
 ^ @ def		_get_content_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
 public static function & get_instance(){
	if(is_null(self::$instance) )
	{
		self::$instance = new self();
	}
	
	return self::$instance;
 }
	
/*
 ^ @ def		_get_content_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
 public function open_socket()
 {
	//echo "$this->serverHost|$this->serverPort|$err_no|$err_str";
	
	$fp = fsockopen($this->serverHost, $this->serverPort, $err_no, $err_str, 10);
	
	return $fp;
 }
	
/*
 ^ @ def		_get_content_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 public  function set_fp_server($ManagerHost='localhost',$ManagerPort = 9800 )
 {
	if( !empty($ManagerHost) ) $this -> serverHost = $ManagerHost;
	if( !empty($ManagerPort) ) $this -> serverPort = $ManagerPort;
 }	
	
/*
 ^ @ def		_get_content_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 function get_fp_response()
 {
	if( !empty($this -> messages_replay) )
	{
		return $this -> messages_replay;
	}
	else
			return NULL;
 }
 
/*
 ^ @ def		_get_content_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 function set_fp_command( $command='' )
  { 
	if( $command!='' ) 
	{
	   $this -> command_string = $command;  
	}	
  }	
	
/*
 ^ @ def		_get_content_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 function fp_get_command()
  { 
	if( !empty( $this -> command_string) )
	{
		return $this -> command_string;
	} 
	else
		return 0;
 }	
/*
 ^ @ def		_get_content_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 function send_fp_comand()
  {
	$fp = $this -> open_socket();
	if(!$fp)
	{
		$this->error_string='Server connection error';
		$this->messages_replay =0;
	}
	
	fwrite($fp, $this -> fp_get_command(), strlen( $this -> fp_get_command() ));
	if(function_exists('stream_set_timeout')){
		stream_set_timeout($fp,5);
	}
	else{
		socket_set_timeout($fp,5);
	}	
	
	$this->messages_replay ='';
	while(false!==($char = fgetc($fp))){
	/*@ call back */
		if ($char == "\n") break;
		$this->messages_replay.=$char;
	}
	
	$headers = explode(" ", $this->messages_replay);
	$size = $headers[1];
	$cnt = 0;
	$this -> messages_replay  = 0;
	$char = fgetc($fp);
		
		if( is_array($headers) )
		{
			if( $size=='OK' ) $this->messages_replay = true; 	
			else
			{
				$this->messages_replay = false;
			}
		}
	   return $this->messages_replay;
  }
  
}

// END OF FILE 
// location : /system/helper/EUI_socket_helper.php
/*
 ^ @ def		 _download_content	
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
if( !function_exists('Socket') )
{
	function Socket()
	{
		$Socket =& EUI_Socket::get_instance();
		if( $Socket ) 
		{
			return $Socket;
		}
	}
}
?>