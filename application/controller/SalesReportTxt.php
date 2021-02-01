<?php

class SalesReportTxt extends EUI_Controller
{

 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function SalesReportTxt()
 {
	parent::__construct();
	$this -> load -> model('M_SalesFileRpt');
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
	// if( $this ->EUI_Session -> _have_get_session('UserId') )
	// {	
	// 	$this -> {base_class_model($this)} -> _get_list_tables();
	// 	$_EUI =array
	// 	(
	// 		'page' 	=> $this -> {base_class_model($this)} -> _get_default(),
	// 		'plist' => $this -> {base_class_model($this)} -> _get_list_tables(),
	// 		'ModeType' 	=> $this ->{base_class_model($this)}-> _getTypeUpload(),
	// 		'FileType' 	=> $this ->{base_class_model($this)}-> _getTypeFile()
	// 	);	
		
	// 	if( is_array($_EUI) ) 
	// 	{
	$this -> load -> view('sales_file/view_sales_file');
	// 	}	
	// }	
 }
 
/*
 * @ def 		: content / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function download()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['list'] = $this -> M_SalesFileRpt -> __getSalesList();    // load content data by pages 
		// echo "<pre>";
		// print_r($_EUI['list']);
		// echo "</pre>";
		// die();
		if( is_array($_EUI))
		{
			$this -> load -> view('sales_file/view_download_data_txt',$_EUI);
		}	
	}	
 }

 function debug()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['list'] = $this -> M_SalesFileRpt -> __getSalesList();    // load content data by pages 
		echo "<pre>";
		print_r($_EUI['list']);
		echo "</pre>";
		die();
		if( is_array($_EUI))
		{
			$this -> load -> view('sales_file/view_download_data_txt',$_EUI);
		}	
	}	
 }
 

}
?>
