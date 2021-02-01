<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class CtiExtension extends EUI_Controller
{


 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function CtiExtension()
 {
	parent::__construct();
	$this -> load -> model(array(base_class_model($this),'M_Pbx'));
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function index()
 {
	if( $this ->EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> {base_class_model($this)} -> _get_default();
		if( is_array($_EUI) ) 
		{
			$this -> load -> view('cti_extension/view_cti_extension_nav',$_EUI);
		}	
	}	
 }
 
/*
 * @ def 		: content / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function Content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> {base_class_model($this)} -> _get_resource();    // load content data by pages 
		$_EUI['num']  = $this -> {base_class_model($this)}-> _get_page_number(); // load content data by pages 
		
		// sent to view data 
		
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('cti_extension/view_cti_extension_list',$_EUI);
		}	
	}	
 }

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

 public function Download()
 {
	if( $this -> URI -> _get_have_post('mode'))
	{
		$mode = base64_decode( $this -> URI -> _get_post('mode') );
		
		switch( $mode )
		{
			case 'extension_tpl' : self::download_extension_tpl(); break;
			case 'extension_xls' : self::download_extension_xls(); break;
			case 'extension_cnf' : self::download_extension_cnf(); break;
		}
	}
 }
 
/*
 * @ def 		: download_extension_cnf 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function Upload()
{
	$data  = null;
	if( !copy($_FILES['fileToupload']['tmp_name'], APPPATH .'/temp/'.$_FILES['fileToupload']['name'] ) ) {
		$_conds = array("success"=>0, "error" => "Failed copy file " . $_FILES['fileToupload']['name'] );
	}
	else
	{
		ExcelImport() -> _ReadData(APPPATH .'temp/'.$_FILES['fileToupload']['name']);
		$pos = 2; $num=0;
		while( $pos <= ExcelImport() -> rowcount(0) )
		{
			$data[$num]['pbx'] 			= ExcelImport() -> val($pos,1); 
			$data[$num]['ext_number'] 	= ExcelImport() -> val($pos,2); 
			$data[$num]['ext_desc'] 	= ExcelImport() -> val($pos,3);
			$data[$num]['ext_type'] 	= ExcelImport() -> val($pos,4);
			$data[$num]['ext_status'] 	= ExcelImport() -> val($pos,5);
			$data[$num]['ext_location'] = ExcelImport() -> val($pos,6);
			$pos++; $num++;
		}
		
		if( !is_null( $data) )
		{
			if( $this -> {base_class_model($this)} -> _cti_extension_upload( $data ) ){
				$_conds = array("success"=>1, "error" => " Upload CTI Extension " );
			}
			else{
				$_conds = array("success"=>0, "error" => " Upload CTI Extension " );
			}
		}
	}
	
	echo json_encode($_conds);
}
 
/*
 * @ def 		: download_extension_cnf 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
function PageUpload()
{
	$this -> load -> view("cti_extension/view_cti_page_upload");
}
 
/*
 * @ def 		: download_extension_cnf 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 private function download_extension_cnf()
 {
	$this -> load -> view
	( 
		"cti_extension/view_cti_download_cnf", 
		 $this -> {base_class_model($this)} -> _get_data_download()
	);
 }
 
/*
 * @ def 		: download_extension_xls
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function download_extension_xls()
 {
	$this -> load -> view
	( 
		"cti_extension/view_cti_download_xls", 
		 $this -> {base_class_model($this)} -> _get_data_download()
	);
	
 }
/*
 * @ def 		: download_extension_tpl 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function download_extension_tpl()
 {
	$EUI = array( 'columns' => $this -> {base_class_model($this)} -> _get_data_template() );
	$this -> load -> view("cti_extension/view_cti_download_tpl", $EUI);
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
function _getPBX()
{
	$_conds = array();
	foreach( $this->M_Pbx->_get_pbx_setting() as $rows)
	{
		$_conds[$rows['pbx']] = $rows['value'];
	}
	
	return $_conds;
	
}

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
function _getType()
{
	$_conds = ARRAY(0,1,2,3,4);
	return $_conds;
}

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
function _getStatus()
{
	$_conds = ARRAY('0' =>'Not Active','1'=>'Active');
	return $_conds;
}
 
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 
 function AddExtensionTpl()
 {
	$UI = array( 'PBX' => $this->_getPBX(), 'Type' => $this ->_getType(),'Status'=> $this ->_getStatus() );
	$this -> load -> view("cti_extension/view_cti_add_tpl", $UI);
 }
 
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 function ViewUpdateExtension()
 {
	$UI = array
	( 
		'PBX' 	 => $this->_getPBX(), 
		'Type' 	 => $this ->_getType(),
		'Status' => $this ->_getStatus(), 
		'Data' 	 => $this ->{base_class_model($this)}->_getDataExtension($this->URI->_get_post('ExtensionId') )
	);
	$this -> load -> view("cti_extension/view_cti_edit_tpl", $UI);
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function SaveExtension()
{
	$_conds = array('success'=>0);
	
	if( $this -> {base_class_model($this)} -> _setSaveExtension( $this -> URI->_get_all_request()))
	{
		$_conds = array('success'=>1);
	}
	
	echo json_encode($_conds);
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
function Restart()
{	
	system("sudo /sbin/service centerback restart",$callback);
	if( $callback ){
		echo "Service centerback restart, Success";
	}
	else{
		echo "Service centerback restart, Failed";
	}
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function UpdateExtension()
{
	$_conds = array('success'=>0);
	if( $this -> {base_class_model($this)} -> _setUpdateExtension( $this -> URI->_get_all_request()))
	{
		$_conds = array('success'=>1);
	}
	
	echo json_encode($_conds);
}

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function DeleteExtension()
{
	$_conds = array('success'=>0);
	if( $this -> {base_class_model($this)} -> _setDeleteExtension( $this -> URI->_get_array_post('ExtensionId')))
	{
		$_conds = array('success'=>1);
	}
	
	echo json_encode($_conds);
 }

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
 function Release()
 {
	$_conds = array('success'=>0);
	$_replay = $this -> {base_class_model($this)} -> _setRelease( $this -> URI->_get_array_post('PbxId'));
	
	if( $_replay )
	{
		$_conds = array('success'=>1, 'message' => $_replay );
	}
	
	echo json_encode($_conds);
	
 }
 
// end of file  
}
?>