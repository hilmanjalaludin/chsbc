<?php
class ManageDatabase extends EUI_Controller
{


 function ManageDatabase() {
	parent::__construct();
	$this -> load -> model(array(base_class_model($this),'M_SysUser'));
 }


 public function index() 
 {
	if( $this -> EUI_Session->_have_get_session('UserId') ) 
	{
	   $UI = array
	   (
			'field' 			=> $this -> {base_class_model($this)}->_getDataTables($this ->URI->_get_post('database')),
			'schema' 			=> $this -> {base_class_model($this)}->_getDetailTable($this ->URI->_get_post('database')),
			'hide'  			=> $this -> {base_class_model($this)}->_getSchemaHide($this ->URI->_get_post('database')),
			'hideprivileges' 	=> $this -> {base_class_model($this)}->_getSchemaPrivileges($this ->M_SysUser->_get_handling_type()),
			'param' 			=> $this ->URI->_get_all_request(),
			'privileges'  		=> $this ->M_SysUser->_get_handling_type()
			
		);
	   
	   $this -> load-> view('mod_manage_database/view_manage_database',$UI);
	}  
 }
 
// save fieldname 
 
 function Save()
 {
	$success = array('success' => 0, 'msg'=>' Add Hide Field');
	
	$param = $this -> URI->_get_all_request();
	if( is_array($param))
	{
		$results = $this -> {base_class_model($this)}->_setSave($param);
		if( $results )
		{
			$success = array('success' => 1, 'msg'=>' Add Hide Field');
		}
	}
	
	echo json_encode($success);
	
 }

// deleted fieldname 

 function Delete()
 {
	$success = array('success' => 0,'msg'=>' Delete Hide Field');
	
	$param = $this -> URI->_get_all_request();
	if( is_array($param))
	{
		$results = $this -> {base_class_model($this)}->_setDeleted($param);
		if( $results ) {
			$success = array('success' => 1, 'msg'=>' Delete Hide Field');
		}
	}
	
	echo json_encode($success);
	
 } 

}

?>