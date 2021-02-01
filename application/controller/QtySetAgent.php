<?php
/*
 * @ def : Quality Set Agent 
 * ------------------------------------------
 * @ params : Unit test notes
 * @ params : 
 * @ params : 
 * ------------------------------------------
 */
 
class QtySetAgent extends EUI_Controller
{

var $limit_default_page  = 5;
/*
 * @ def : contants folder view 
 * ------------------------------------------
 *
 * @ params : Unit test notes
 * @ params : 
 */
 
private static $view_layout = null;
 
/*
 * @ def : constructor off class 
 * ------------------------------------------
 *
 * @ params : Unit test notes
 * @ params : 
 */
 
 function __construct() 
 {
	parent::__construct();
	self::$view_layout = array('qty_view_setagent');
	$this->load->model(array(base_class_model($this),'M_SysUser'));
	$this->load->helper(array('EUI_Object'));
	
 }

 
/*
 * @ def : default read of controller  
 * ------------------------------------------
 *
 * @ params : Unit test notes
 * @ params : 
 */

 public function getViewLayout() {
	return ( is_array(self::$view_layout) ? self::$view_layout[0] : null);
 }
 
 
// ----------------------------------------------------------------------------------------------------- 
/*
 * @ package 	 default read of controller  
 * @ params		 test parameter 
 */
 
 public function index()
{
	if( _have_get_session('UserId') )
 {
	$this->load->view("qty_view_setagent/view_setagent_index", array());
 }

}

// ----------------------------------------------------------------------------------------------------- 
/*
 * @ package 	 default read of controller  
 * @ params		 test parameter 
 */
 
 
 public function PageAgentState()
{
  
  $this->start_page = 0;
  $this->per_page   = $this->limit_default_page;
  $this->post_page  = (int)_get_post('page');
  
  $obj_class =& get_class_instance(base_class_model($this));
  $this->arr_result = array();
  $this->arr_content = $obj_class->_select_set_agent_page( new EUI_Object( _get_all_request() ));
  
  $total_page_record = count($this->arr_content);
  if( _get_have_post('agent_state_grid') 
	  AND _get_post('agent_state_grid') == 1 )
  {
	  $this->per_page  = $total_page_record;
  }	  
  $this->tot_result = $total_page_record;
  
  if( $this->post_page) {
	$this->start_page = (($this->post_page-1)*$this->per_page);
  } else {	
	$this->start_page = 0;
  }

 // @ pack : set result on array
  if( (is_array($this->arr_result)) 
	AND ( $this->tot_result > 0 ) )
 {
	$this->arr_result = array_slice($this->arr_content, $this->start_page, $this->per_page);
}	
 
 $this->page_counter = ( $this->per_page ?   ceil($this->tot_result/ $this->per_page) : 0);
 
 // @ pack : then set it to view 
 
 $arr_call_history = array
(
	'content_pages' => $this->arr_result,
	'total_records' 	=> $this->tot_result,
	'total_pages'   => $this->page_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page
 );
 
  $this->load->view("qty_view_setagent/view_setagent_page", $arr_call_history);	
  
 }
 
 // ----------------------------------------------------------------------------------------------------- 
/*
 * @ package 	 default read of controller  
 * @ params		 test parameter 
 */
 
 
 public function PageQualityState()
{
  $this->start_page = 0;
  $this->per_page   = $this->limit_default_page;
  $this->post_page  = (int)_get_post('page');
  
  $obj_class =& get_class_instance(base_class_model($this));
  $this->arr_result = array();
  $this->arr_content = $obj_class->_select_set_quality_page( new EUI_Object( _get_all_request() ));
  
  $total_page_record = count($this->arr_content);
  
  if( _get_have_post('open_quality_grid') 
	  AND _get_post('open_quality_grid') == 1 )
  {
	  $this->per_page  = $total_page_record;
  }	  
  
  $this->tot_result = $total_page_record;
   if( $this->post_page) {
	$this->start_page = (($this->post_page-1)*$this->per_page);
  } else {	
	$this->start_page = 0;
  }

 // @ pack : set result on array
  if( (is_array($this->arr_result)) 
	AND ( $this->tot_result > 0 ) )
 {
	$this->arr_result = array_slice($this->arr_content, $this->start_page, $this->per_page);
}	
 
 $this->page_counter =( $this->per_page ?  ceil($this->tot_result/ $this->per_page) : 0);
 
 // @ pack : then set it to view 
 
 $arr_call_history = array
(
	'content_pages' => $this->arr_result,
	'total_records' 	=> $this->tot_result,
	'total_pages'   => $this->page_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page
 );
 
  $this->load->view("qty_view_setagent/view_quality_page", $arr_call_history);		
}
 
 
 
/*
 * @ def : default read of controller  
 * ------------------------------------------
 *
 * @ params : Unit test notes
 * @ params : 
 */
  
  
public function getAgentReadyState()
{
	$UI = array ( 
		'view_page' 	=> $this ->{base_class_model($this)}->_getPageAgent(),
		'view_record' 	=> $this ->{base_class_model($this)}->_getRecordsAgent(),
		'view_agents' 	=> $this ->{base_class_model($this)}->_getAgentState(),
		'select_page'	=> $this -> URI->_get_post('page')
	);
	
	if( !is_null($UI) AND $this -> EUI_Session->_have_get_session('UserId') ) 
	{
		$this -> load-> view( self::getViewLayout()."/view_agent_layout", $UI );
	}	
}
 
/*
 * @ def : default read of controller  
 * ------------------------------------------
 *
 * @ params : Unit test notes
 * @ params : 
 */
  
  
public function AddAvailableAgent()
{
	$conds = array('success' => 0);
	
	if( $this -> URI->_get_have_post('UserId') 
		AND $this -> EUI_Session->_have_get_session('UserId') ) 
	{
		$result = $this -> {base_class_model($this)}->_setAddAvailableAgent( $this -> URI->_get_array_post('UserId')); 
		if($result)
		{
			$conds = array('success' => 1);
		}
	}
	
	echo json_encode($conds);
}

/*
 * @ def : default read of controller  
 * ------------------------------------------
 *
 * @ params : Unit test notes
 * @ params : 
 */
  
public function UpdateQualityAgent()
{
	$conds = array('success' => 0);
	
	if( $this -> URI->_get_have_post('QualityAgentId') 
		AND $this -> EUI_Session->_have_get_session('UserId') ) 
	{
		$result = $this -> {base_class_model($this)}->_setUpdateQualityAgent( 
			$this -> URI->_get_array_post('QualityAgentId'),
			$this -> URI->_get_post('QulaityStaffId')
		); 
		if($result)
		{
			$conds = array('success' => 1);
		}
	}
	
	echo json_encode($conds);
}

/*
 * @ def : default read of controller  
 * ------------------------------------------
 *
 * @ params : Unit test notes
 * @ params : 
 */
  
public function RemoveQualityAgent()
{
	$conds = array('success' => 0);
	
	if( $this -> URI->_get_have_post('QualityAgentId') 
		AND $this -> EUI_Session->_have_get_session('UserId') ) 
	{
		$result = $this -> {base_class_model($this)}->_setRemoveQualityAgent($this -> URI->_get_array_post('QualityAgentId')); 
		if($result)
		{
			$conds = array('success' => 1);
		}
	}
	
	echo json_encode($conds);
}

// -----------------------------------------------------------------------------------------
/*
 * @ pakage 		empty bukcet quality agent on selected check 
 * @ notes 			-
 * 
 */
 
 public function EmptyQualityAgent()
{
 $conds = array('success' => 0);
 
// ---------- call member ------------------------
 $objClass =& get_class_instance(base_class_model($this));
 if(_get_have_post('QualityAgentId')  AND _have_get_session('UserId') ) 
{
	$cond = $objClass->_setEmptyQualityAgent(new EUI_Object(_get_all_request() )); 
	if($cond)  {
		 $conds = array('success' => 1);
	}
 }
 
 echo json_encode($conds);
 
}

// 


}

?>