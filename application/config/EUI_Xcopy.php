<?php

ini_set("memory_limit","512M");

// set db  AIA
 
$Config['db']['aia']['host'] = '192.168.12.13';
$Config['db']['aia']['user'] = 'enigma';
$Config['db']['aia']['pwd'] = 'enigma';
$Config['db']['aia']['dbs'] = 'enigmaaiadb';

// set db  BCA 

$Config['db']['bca']['host'] = '192.168.12.15';
$Config['db']['bca']['user'] = 'enigma';
$Config['db']['bca']['pwd'] = 'enigma';
$Config['db']['bca']['dbs'] = 'enigmabcadb';


/** conect link **/

if(!function_exists('connect_aia') )
{
  function &connect_aia() {
	global $Config;
	$link_source  = mysql_connect($Config['db']['aia']['host'], $Config['db']['aia']['user'], $Config['db']['aia']['pwd']); 
	if( $link_source )
	{ 
		$database_aia = mysql_select_db($Config['db']['aia']['dbs'], $link_source);
	}	
	
	return $link_source;
  }	
}


/** conect link  **/


if(!function_exists('conect_bca') )
{
  function &conect_bca()  
{
	global $Config;
	
	$link_source  = mysql_connect($Config['db']['bca']['host'], $Config['db']['bca']['user'], $Config['db']['bca']['pwd']); 
	if( $link_source ) 
	{
		$database_aia = mysql_select_db($Config['db']['bca']['dbs'], $link_source);
	}
	
	return $link_source;
}
}


/** process insert  **/

if(!function_exists('insert_data') ) 
{
  function &insert_data( $data = null, $table = null , $connection )
 {
	$_conds = false;
	if( is_array($data) 
		AND count($data) > 0 )
	{
		$sql  = sprintf('INSERT INTO %s (%s) VALUES ("%s")', "$table", 
			implode(', ', array_map('mysql_escape_string', array_keys($data))), 
			implode('", "', array_map('mysql_escape_string',$data)));
		$qry  = mysql_query($qry, $connection);
		if( $qry )
			$_conds = true;
		
	}
	
	return $_conds;
  }
}

/** copy data call sessio from AIA to BCA  **/

if(!function_exists('copy_call_session') ) 
{ 
	function &copy_call_session()  
{
	global $argv;
	
 $connect_db_aia =& connect_aia(); 
 $connect_db_bca =& conect_bca();
	
// ambil dari call history BCA 

 if( count($argv) > 1 ) { 
	
	$CallSessionId = ( isset($argv[1]) ? $argv[1] : 0);
	
	$sql_history_bca = " SELECT * FROM t_gn_callhistory  
						 WHERE CallSessionId ='$CallSessionId' ";
						 
	$qry_history_bca = mysql_query( $sql_history_bca , $connect_db_bca );
	
	$call_session_bca = array();
	while( $rows = mysql_fetch_assoc($qry_history_bca) ) {
		$call_session_bca[$rows['CallSessionId']] = $rows;
	}

	
	// ambil data call session dari db AIA 
	
	$sql_session_db = " SELECT * FROM cc_call_session ";
	$qry_session_db= mysql_query($sql_session_db, $connect_db_aia);

	$data_session_aia = array();
	while( $rows_session_aia= mysql_fetch_assoc($qry_session_db) ) 
	{
		if( in_array($rows_session_aia['session_id'], array_keys( $call_session_bca ) ) ) {
			foreach($rows_session_aia as $fields => $values ){
				if( $fields !='id') {
					$data_session_aia[$rows_session_aia['session_id']][$fields] = $values; 
				}
			}
		}
	 }
	 
	 
	 // process copy data 
	 
	 if( is_array($data_session_aia) ) 
	 {
		if( insert_data($data_session_aia, 'cc_call_session', $connect_db_bca)  ) {
			echo "Success, CallSession Copy to BCA DB \n\r";
		}
		else{
			echo "Failed, CallSession is exist \n\r";
		}	
	 }
  }
 }
}




/** copy data call sessio from AIA to BCA  **/

if(!function_exists('copy_recording') ) 
{ 
	function &copy_recording()  
{
	global $argv;
 
 $connect_db_aia =& connect_aia(); 
 $connect_db_bca =& conect_bca();
	
// ambil dari call history BCA 

 if( count($argv) > 1 ) 
 { 
	$CallSessionId = ( isset($argv[1]) ? $argv[1] : 0 );
	
	$sql_history_bca = "SELECT * FROM t_gn_callhistory WHERE CallSessionId ='$CallSessionId' ";
	$qry_history_bca = mysql_query( $sql_history_bca , $connect_db_bca );
	
	if( $qry_history_bca )
	{
		$call_session_bca = array();
		
		while( $rows = mysql_fetch_assoc($qry_history_bca) )
		{
			$call_session_bca[$rows['CallSessionId']] = $rows;
		}

		// ambil data call session dari db AIA 
		
		$sql_cc_recording = " SELECT * FROM cc_recording ";
		$qry_cc_recording = mysql_query($sql_cc_recording, $connect_db_aia);

		$data_session_aia = array();
		while( $rows_recording_aia= mysql_fetch_assoc($qry_cc_recording) ) 
		{
			if( in_array($rows_recording_aia['session_id'], array_keys( $call_session_bca ) ) ) 
			{
				foreach($rows_recording_aia as $fields => $values )
				{
					if( $fields !='id') {
						$data_session_aia[$rows_recording_aia['session_id']][$fields] = $values; 
					}
				}
			}
		}
		
		// process copy data 
			 
			if( is_array($data_session_aia) ) 
			{
				if( insert_data($data_session_aia, 'cc_recording', $connect_db_bca)  ) {
					echo "Success, Recording Copy to BCA DB \n\r";
				}
				else{
					echo "Failed, Recording is exist Or Not Exist \n\r";
				}	
			 }
	   }	
		else
		{
			echo mysql_error()."\n\r";
		}
    }
  }
}



/// startting process 


if(count($argv) >=2 ) {
  copy_call_session();
  copy_recording();
}
else {
	echo "input with : php {$argv[0]} < callsession_id > on history \n\r";
}
?>