<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SetUpload extends EUI_Controller
{

// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 public function __construct()
{
	parent::__construct();
	$this->load->model('M_SetUpload');
	$this->load->helper(array('EUI_Object'));
	
 }
 
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 
 public function index()
{
	if(! _have_get_session('UserId') ) {
		return false;
	}	
	
// ------------------ this page --------------------------------------------------

	$out =new EUI_Object('EUI_Object');
	$obj =& get_class_instance(base_class_model($this));
	
// ------------------ this page --------------------------------------------------
	
	$this->load->view('set_temp_upload/view_template_nav',array (
		'page' 		=> $obj->_get_default(),
		'plist' 	=> $obj->_get_list_tables(),
		'ModeType' 	=> $obj->_getTypeUpload(),
		'FileType' 	=> $obj->_getTypeFile()
	));
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
		$_EUI['num']  = $this -> {base_class_model($this)} -> _get_page_number(); // load content data by pages 
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('set_temp_upload/view_template_list',$_EUI);
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
 function setTemplate()
 {
	if( $this -> URI -> _get_have_post('tables') )
	{
		$_fields = array
		( 
			'fields' 	=> $this ->{base_class_model($this)}-> _get_field_column($this -> URI -> _get_post('tables'))
		);
		
		if( strtolower($this -> URI->_get_post('method'))=='insert' )
		{
			$this -> load -> view('set_temp_upload/view_layout_upload',$_fields);
		}
		
		if( strtolower($this -> URI->_get_post('method'))=='update' )
		{
			$this -> load -> view('set_temp_upload/view_layout_kupload',$_fields);
		}
	}
		
 }


/*
 * @ def 		: create template views 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function Create()
{

// ---------- load content model --------------------------------------
	
 if( !_have_get_session('UserId') ) {
	return false;
 }
 
// ---------- load content model --------------------------------------
 
 $obj =& get_class_instance(base_class_model($this));
 $this->load->view('set_temp_upload/view_add_template',array(
	'page' => $obj-> _get_default(),
	'plist' => $obj->_get_list_tables(),
	'ModeType' => $obj->_getTypeUpload(),
	'FileType' => $obj->_getTypeFile(),
	'LimitDays' => $obj->_LimitDays(),
	'BlackList' => $obj->_BlackList()
 ));
 
}
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function saveTemplate()
{
	$_maps_data = array(); $_conds = array('success'=> 0);	
	$objClass =& get_class_instance(base_class_model($this));
	switch( $this->URI->_get_post('mode_input') ) 
	{
		case 'insert' :
			if( class_exists(base_class_model($this)) 
				AND $objClass->_set_saveInsert( new EUI_Object( _get_all_request() ) )) {
				$_conds = array('success' => 1);
			}
		break;

		case 'update': 
			if( class_exists(base_class_model($this)) 
				AND $objClass->_set_saveUpdate( new EUI_Object( _get_all_request() ) )) {
				$_conds = array('success' => 1);
			}
		break;
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
 
 function DownloadTemplate()
 {
	if( $this -> URI -> _get_have_post('TemplateId'))
	{
		$tmp_result = $this ->{base_class_model($this)}-> _get_name_template($this -> URI -> _get_post('TemplateId'));
		
		$data = array
		(
			'template' => $this ->{base_class_model($this)}-> _get_download_template($this -> URI -> _get_post('TemplateId')),
			'filename' => $tmp_result['TemplateName'],
			'filetype' => $tmp_result['TemplateFileType'],
			'sparator' => $tmp_result['TemplateSparator'],
		);
		
		if($tmp_result['TemplateFileType']=='txt')
			$this -> load -> view('set_temp_upload/view_download_data_txt',$data);
		else{
			$this -> load -> view('set_temp_upload/view_download_data_xls',$data);
		}	
	}
	else{
		show_error("No have template ID ");
	}
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function Enable()
 {
	$_conds = array('success' => 0 ); 
	if( $this -> URI -> _get_have_post('TemplateId'))
	{
		if( $this ->{base_class_model($this)}-> _set_active_template( 1, $this -> URI -> _get_post('TemplateId') ))
		{
			$_conds = array('success' => 1);	
		} 
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
 
  
 function Disable()
 {
	$_conds = array('success' => 0 ); 
	if( $this -> URI -> _get_have_post('TemplateId'))
	{
		if( $this ->{base_class_model($this)}-> _set_active_template(0, $this -> URI -> _get_post('TemplateId') ))
		{
			$_conds = array('success' => 1);	
		} 
	}
	
	echo json_encode($_conds);
 }
 
 
 // delete template 
 function Delete()
 {
	$_conds = array('success' => 0 ); 
	
	$params = $this -> URI -> _get_array_post('TemplateId');
	
	if( count($params)> 0 )
	{
		if( $this ->{base_class_model($this)}-> _set_delete_template($params) )
		{
			$_conds = array('success' => 1);	
		} 
	}
	
	echo json_encode($_conds);
 
 }
 
 
 
  
}
?>
