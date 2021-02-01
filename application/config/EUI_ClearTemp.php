#!/usr/bin/php
<?php 
 
 define('PATH_VOICE_TEMP','/opt/enigma/webapps/aiainsurance/application/temp');
 
//extract to file type 

if( !function_exists('____')){
	function ____( $data  = null )
	{
		$rs = null;
		if( !is_null($data) )
		{
			$_ls = explode('.',$data);
			$rs = $_ls[count($_ls)-1]; 	
		}	
		
		return $rs;
	}
}	
 
// define constans to deleted files 

 $Constans = array('gsm','wav');
 
// scan data on directory 
 
 $voice_list_array = scandir(PATH_VOICE_TEMP);

	
// process to looping 
 
 if( is_array($voice_list_array) 
	and !is_null($voice_list_array) ) 
{
		foreach( $voice_list_array as $key => $file_temp )
		{	
			if(!is_dir($file_temp) )
			{
				if( in_array(____($file_temp),  $Constans ) ){
					exec("rm -f $file_temp");
				}
			}
		}
  } 

?>
