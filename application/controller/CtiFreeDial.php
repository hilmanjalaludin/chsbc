<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class CtiFreeDial extends EUI_Controller
{

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function CtiFreeDial()
 {
	parent::__construct();
	$this -> load -> model('M_CtiFreeDial');
	$this -> load -> helper(array('EUI_Object'));
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
		$_EUI['page'] = $this -> M_CtiFreeDial -> _get_default();
		if( is_array($_EUI) ) 
		{
			$this -> load -> view('cti_free_dial/view_cti_freedial_nav',$_EUI);
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
		$_EUI['page'] = $this -> M_CtiFreeDial -> _get_resource();    // load content data by pages 
		$_EUI['num']  = $this -> M_CtiFreeDial -> _get_page_number(); // load content data by pages 
		
		// sent to view data 
		
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('cti_free_dial/view_cti_freedial_list',$_EUI);
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
 
 function PageFreeDial()
 {
	$this -> load -> view('cti_free_dial/view_cti_page_dial');
 }
 
 
 
 /*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  function SaveCallActivity()
 {
	$cond  = array("success" => 0 );
	if( $this->M_CtiFreeDial->_set_save_call_free_dial( new EUI_Object( _get_all_request() )))
	{
		$cond  = array("success" => 1 );
	}
	echo json_encode($cond);
	
 }
 
 

// -------------------------------------------------------------

/* 
 * Method 		_select_count_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
public function PageFreeCallActivityHistory()
{
  $this->start_page = 0;
  $this->per_page   = 10;
  $this->post_page  = (int)_get_post('page');
  
  $obj_class =& get_class_instance(base_class_model($this));
  $this->arr_result = array();
  $this->arr_content = $obj_class->_select_page_call_free_dial( new EUI_Object( _get_all_request() ));
  $this->tot_result = count($this->arr_content);
	
   if( $this->post_page) {
	$this->start_page = (($this->post_page-1)*$this->per_page);
  } else {	
	$this->start_page = 0;
  }

  // @ pack : set result on array
  if( (is_array($this->arr_result)) AND ( $this->tot_result > 0 ) )
  {
	 $this->arr_result = array_slice($this->arr_content, $this->start_page, $this->per_page);
  }	
 
  $this->page_counter = ceil($this->tot_result/ $this->per_page);
  // @ pack : then set it to view 
 
  $arr_call_history = array
 (
	'content_pages' => $this->arr_result,
	'total_records' 	=> $this->tot_result,
	'total_pages'   => $this->page_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page
 );
 
  $this->load->view("cti_free_dial/view_cti_free_call_page", $arr_call_history);	
}
 
 // ======================================== END CLASS =============================
 
}
?>