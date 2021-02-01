<?php
require(dirname(__FILE__)."/../../system/database/MYSQLConnect.php");
require(dirname(__FILE__)."/../../system/system/System.php");
/**
 **
 **/

class Install extends mysql
{

/**
 **
 **/

var $_action;

/**
 **
 **/
 
private $_keys;

function Install()
{
  parent::__construct();
  $this -> _action = $this -> escPost('action');
  $this -> _keys = md5(1234);
  self::index();
	
}

/**
 **
 **/
 
function index()
{
	switch( $this -> _action )
	{
		case 'INSTALL' : self::_Install(); 	break;
		case 'IMPORT'  : self::_Import(); 	break;
	}
}
/**
 **
 **/
 
function _Install()
 {
	$_Conds = array("success"=>0);
	
	if( is_object($this -> _Plugin) )
	{
		$server_database 	= $this -> Encrypt -> _decrypt_base64($this -> escPost('server_database'));
		$user_database 		= $this -> Encrypt -> _decrypt_base64($this -> escPost('user_database'));
		$passwod_database 	= $this -> Encrypt -> _decrypt_base64($this -> escPost('passwod_database'));
		$name_database      = $this -> Encrypt -> _decrypt_base64($this -> escPost('name_database'));
		$user_login 		= $this -> Encrypt -> _decrypt_base64($this -> escPost('user_login'));
		$password_login 	= $this -> Encrypt -> _decrypt_base64($this -> escPost('password_login'));
		
		$this -> _Plugin -> Wlog -> _relative_write_filename( dirname(__FILE__)."/../../system/database", $this -> _keys.".ini" ); 
		
		$content =";;EUI < Enigma User interface 0.1 <php> >\n;;Thank's all contribute and support for EUI Framework V.0.1\n;;User interface for application Call Center inbound.\n";
		$content.=";;Licensed under the MIT ( http://razakitechnology.com/siteraztech/product/web-application ) license.\n";
		$content.=";;author < razaki team >\n";
		$content.=";;Copyright © 2014-2012 razaki Labs ( http://razakitechnology.com ) \n";
		$content.=";;key settup from intallation user fisrt.\n";
		$content.=";;configuration must be match on definition\n"; 
		$content.=";;on your server database\n";		
		$content.="[database]\ndB.server ={$server_database}\ndB.user ={$user_database}\ndB.password ={$passwod_database}\ndB.driver =mysql\ndB.database ={$name_database}\n";
		$content.="[instalation]\ninstall.data =".date('Y-m-d')."\ninstall.keys ={$this ->_keys}\n";
	}	
				
	$this -> _Plugin -> Wlog -> _write_content($content);
	
	if( $this -> _Core -> _eui_db_true()){
		$_Conds = array("success" => 1 );
	}
	else{
		$_Conds = array("success" => 2);
	}
	
	echo json_encode($_Conds);
 }
 
/**
 **
 **/
 
function _Import()
{
	if( $this -> _DBConnect ){
		echo json_encode(array("success"=>0));
	}
	else
		echo json_encode(array("success"=>3));
 }

}

new Install();

?>
