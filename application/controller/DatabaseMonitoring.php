<?php

class DatabaseMonitoring extends EUI_Controller 
{


 function DatabaseMonitoring()
 {
	parent::__construct();
	$this -> load-> model(array(base_class_model($this)));
 }
 
 
/* index **/
 
 function index()
 {
	
	if( $this -> EUI_Session->_have_get_session('UserId') )
	{
		$UI = array
		(
			'records' => count($this ->{base_class_model($this)}-> _getSizeTables()),
			'pages' => ceil(count($this ->{base_class_model($this)}-> _getSizeTables())/20) 
		);
		
		$this -> load -> view('mon_view_database/view_database_nav',$UI);
	}
 }
 
 
 /* index **/
 
 function content()
 {
	if( $this -> EUI_Session->_have_get_session('UserId') )
	{
		$UI = array (
			'sheet_data' => $this ->{base_class_model($this)}-> _getResultList($this -> URI -> _get_post('v_page')),
			'page' => $this -> URI -> _get_post('v_page'),
			'number' => $this ->{base_class_model($this)}->_getNumber()
		);
		
		$this -> load -> view('mon_view_database/view_database_list',$UI);
	}
 }
 
 // Backup
 function Backup()
 {
	$this -> load-> dbutil();
	
	$backup =& $this -> dbutil->backup(array("format"=>"zip","filename"=> $this ->db->EUI_DB_database . ".sql"));
	$dbname = 'MYSQLBackup_'. $this ->db->EUI_DB_database . '_' . date('YmdH').'.zip';
	
	if(!defined('FILEPATH') ) { 
		define('FILEPATH',str_replace('system','application', BASEPATH)."temp/". $dbname );
	}
	
	$this-> load-> helper('file');
	write_file(FILEPATH, $backup);
	$this-> load-> helper('download');
	force_download($dbname,$backup);
	
 }
 
 
// Backup table 

function BackupTable()
{
	if( $this -> URI->_get_have_post('table'))
	{
		$table = $this -> URI->_get_post('table');
		
		$prefs = array
		(
			"tables" => $table,
			"format"=>"zip",
			"filename"=> $table.".sql"
		);
	 
		$this -> load-> dbutil();
		$backup =& $this -> dbutil->backup($prefs);
		$dbname = $table. '_' . date('YmdH').'.zip';
		
		if(!defined('FILEPATH') ) 
		{ 
			define('FILEPATH',str_replace('system','application', BASEPATH)."temp/". $dbname );
		}
		
		$this-> load-> helper('file');
		write_file(FILEPATH, $backup);
		$this-> load-> helper('download');
		force_download($dbname,$backup);
	}

	
} 


// ViewOptions

function ViewOptions()
{
	if( $this -> EUI_Session->_have_get_session('UserId') )
	{
		$UI = array('list'=>'');
		
		$this -> load -> view('mon_view_database/view_list_option',$UI);
	}
}
 
 
// AddOptionsList
function AddOptionsList()
{
	$_conds = array('success'=>0);
	
	if( $this -> EUI_Session->_have_get_session('UserId') )
	{
		$param  = $this->URI->_get_array_post('table');
		if( $this ->{base_class_model($this)}->_addOPtions($param)) 
		{
			$_conds = array('success'=>1);
		}
	}
	
	echo json_encode($_conds);
} 

// DellOptionsList

function DellOptionsList()
{
	$_conds = array('success'=>0);
	
	if( $this -> EUI_Session->_have_get_session('UserId') )
	{
		$param  = $this->URI->_get_array_post('table');
		if( $this ->{base_class_model($this)}->_DellOPtions($param)) 
		{
			$_conds = array('success'=>1);
		}
	}
	
	echo json_encode($_conds);
}

// OtionsBackup

function OtionsBackup()
{
	if( $this -> URI->_get_have_post('table') && $this -> URI->_get_have_post('name'))
	{
		$table = $this -> URI->_get_array_post('table');
		$name = $this -> URI->_get_post('name');
		
		if( $this ->{base_class_model($this)}->_DellOPtions($table)) 
		{
			$prefs = array(
				"tables" => $table,
				"format"=>"zip",
				"filename"=> $name.".sql"
			);
			
		 
			$this -> load-> dbutil();
			$backup =& $this -> dbutil->backup($prefs);
			$dbname = $name. '_' . date('YmdH').'.zip';
			
			if(!defined('FILEPATH') ) 
			{ 
				define('FILEPATH',str_replace('system','application', BASEPATH)."temp/". $dbname );
			}
			
			$this-> load-> helper('file');
			write_file(FILEPATH, $backup);
			$this-> load-> helper('download');
			force_download($dbname,$backup);
		}	
	}
}

// viewOptionsList

function viewOptionsList()
{
	__( form()->listcombo('list_tables',NULL,$this ->{base_class_model($this)}->_getOptionsList(),null,array('checked'=>true)) );
}
 
 
 // EmptyTable
function EmptyTable()
{
	$_conds = array('success' => 0);
	
	if( ($this -> EUI_Session->_have_get_session('UserId')) 
		AND ($this -> EUI_Session->_get_session('HandlingType')==USER_ROOT) )
	{
		
		$_tables =  $this -> URI-> _get_array_post('table');
		$num = 0;
		foreach( $_tables as $key => $names )
		{
			if( $this -> db -> truncate($names) ){
				$num++;
			}
			
		}	
	}
	
	
	if( $num > 0 ){
		$_conds = array('success' => 1);
	}
	
	echo json_encode($_conds);
	
 }
  
 
}

?>