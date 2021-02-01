<?php
/*
 * E.U.I 
 * --------------------------------------------------------------------------
 *
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/QualityAssignment/index/?
 * ----------------------------------------------------------------------------
 */
 
class QualityAssignment extends EUI_Controller
{
/*
 * @def : QualityAssignment aksesor 
 * ----------------------------------
 *
 * @param : -
 * @param : - 
 */
var $limit_default_page = 10;
private static $view_layout = null;
/*
 * @def : QualityAssignment aksesor 
 * ----------------------------------
 *
 * @param : -
 * @param : - 
 */
public function QualityAssignment()
{
	parent::__construct();
	$this->load->model(array(base_class_model($this),'M_SetCampaign'));
	$this->load->helper(array('EUI_Object'));
	
	if( is_null( $view_layout ) )
	{
		self::$view_layout = "qty_view_assignment"; 
	}
}
/*
 * @def : getViewLayout
 * ----------------------------------
 *
 * @param : Unit Test 
 * @param : Unit Test 
 */

 public function ViewLayout() 
 {
	return self::$view_layout;
 }
/*
 * @def : default page
 * ----------------------------------
 *
 * @param : Unit Test 
 * @param : Unit Test 
 */
 
public function index()
{
	if( $this ->EUI_Session ->_have_get_session('UserId') 
		AND class_exists(base_class_model($this)) )
	{
		$this->load->view("{$this ->ViewLayout()}/view_assignment_nav");
	}	
 }
 
/*
 * @def : get layput panel left content 
 * ----------------------------------
 *
 * @param : - 
 * @param : -
 */
 
public function FilterAssignment()
{
	if( $this ->EUI_Session ->_have_get_session('UserId') 
		AND class_exists(base_class_model($this)) )
	{
		$UI = array('CampaignOutbound' => $this -> M_SetCampaign -> _getCampaignGoals(2) );
		$this->load->view("{$this->ViewLayout()}/view_layout_left", $UI);
		
	}	

}

function UserShowSpvReportByName()
{
	$obClass = & get_class_instance('M_QualityAssignment');
	$comboagent = array('comboagent' => $obClass->_getQualitySpv());
	echo form()->combo('SPVId','select long xzselect',$obClass->_getQualitySpv(), null );
}

function UserShowAgentReportBySpv()
{
	$obClass = & get_class_instance('M_QualityAssignment');
	$comboagent = array('comboagent' => $obClass->_select_report_tmr_by_spv( _get_array_post('SpvId')));
	echo form()->combo('AgentId','select long xzselect', $obClass->_select_report_tmr_by_spv( _get_array_post('SpvId')), null, array('change' => 'Ext.DOM.DetailAssignment(this);'));
	// $this->load->view("{$this->ViewLayout()}/view_layout_comboagent", $comboagent);
}

/*
 * @def : get layput panel left content 
 * ----------------------------------
 *
 * @param : - 
 * @param : -
 */
 
public function ContentFilter()
{
	if( $this ->EUI_Session ->_have_get_session('UserId') 
		AND class_exists(base_class_model($this)) )
	{
		
		if ( _get_session("HandlingType") == USER_QUALITY_ADMIN ) {
			$UI = array('QualityGroup' => $this -> {base_class_model($this)} -> _getQualityHead() );
		} else {
			$UI = array('QualityGroup' => $this -> {base_class_model($this)} -> _getQualityGroup( $this -> EUI_Session -> _get_session('UserId') ) );
		}


		$this->load->view("{$this->ViewLayout()}/view_layout_right",$UI);
	}	

}

/*
 * @ def : get layput panel left content 
 * --------------------------------------
 *
 * @ param : - 
 * @ param : -
 */
 
 public function ShowDataByChecked()
{
  $this->start_page = 0;
  $this->per_page   = $this->limit_default_page;
  $this->post_page  = (int)_get_post('page');
  
  $obj_class =& get_class_instance(base_class_model($this));
  $this->arr_result = array();
  $this->arr_content = $obj_class->_getDataByChecked( new EUI_Object(_get_all_request()) );
  #var_dump($this->arr_content);die();
  $total_page_record = count($this->arr_content);
  if( _get_have_post('submit_filte_all') 
	  AND _get_post('submit_filte_all') == 1 )
  {
	  $this->per_page  = $total_page_record;
  }	  
  $this->tot_result = $total_page_record;
  
  if( $this->post_page) {
	$this->start_page = (($this->post_page-1)*$this->per_page);
  } else {	
	$this->start_page = 0;
  }

// ------------ @ pack : set result on array ----------------------
 if( (is_array($this->arr_result)) 
	AND ( $this->tot_result > 0 ) )
 {
	$this->arr_result = array_slice($this->arr_content, $this->start_page, $this->per_page);
}	
 
 $this->page_counter = ( $this->per_page ? ceil($this->tot_result/ $this->per_page) : 0);
 
 // @ pack : then set it to view 
 
 $arr_quality_assign = array
(
	'content_pages' => $this->arr_result,
	'total_records' => $this->tot_result,
	'total_pages'   => $this->page_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page
 );
 
 $this->load->view("qty_view_assignment/view_layout_bychecked", $arr_quality_assign);	
}

/*
 * @ def : get layput panel left content 
 * ---------------------------------------
 *
 * @ param : - 
 * @ param : -
 */
 
function ShowDataByAmount()
{
   if(_have_get_session('UserId')) 
   {
	  $obj_class =& get_class_instance(base_class_model($this));
	  $arr_data_row = $obj_class->_getDataByChecked( new EUI_Object(_get_all_request()) );
	  $this->load->view("qty_view_assignment/view_layout_byamount",  array(
		'view_size_data' => count($arr_data_row)
	  ));		
  }
}
 
/*
 * @ def : get layput panel left content 
 * ---------------------------------------
 *
 * @ param : - 
 * @ param : -
 */
 
 
 public function AssignByChecked()
{
    $_conds = array('success' => 0 , 'message' => '' );
	if(_have_get_session('UserId') ) 
	{
		$obClass =& get_class_instance(base_class_model($this));
		 if( $conds  = $obClass->_setAssignByChecked( new EUI_Object(_get_all_request())  ) )  
		{
			$_conds = array('success' => 1 , 'message' => $conds );
		}
	}
	
	echo json_encode($_conds);
}
 
/*
 * @ def : get layput panel left content 
 * ---------------------------------------
 *
 * @ param : - 
 * @ param : -
 */
 
 
 public function AssignByAmount()
{
	
 $response = array('success' => 0 , 'message' => '' );
	if(_have_get_session('UserId') ) 
 {
	$obClass =& get_class_instance(base_class_model($this));
	if( $conds  = $obClass->_setAssignByAmount( new EUI_Object(_get_all_request())  ) )  
	{
		$response = array('success' => 1 , 'message' => $conds );
	}
 }
	
 echo json_encode( $response );

}


// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
 
 function PageQualityUnAssignData() 
{
  $this->start_page = 0;
  $this->per_page   = 20;
  
  if( _get_have_post('qty_record_page') 
	   AND _get_post('qty_record_page') > 0 )  
  {
	 $this->per_page = (int)_get_post('qty_record_page');
  }
  
  $this->post_page  = (int)_get_post('page');
  $obj_class =& get_class_instance(base_class_model($this));
  $this->arr_result = array();
  $this->arr_content = $obj_class->_select_page_quality_unassign_data( new EUI_Object( _get_all_request() ));
  $this->tot_result = count($this->arr_content);
	
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
 
 $this->page_counter = ceil($this->tot_result/ $this->per_page);
 
 // @ pack : then set it to view 
 
 $arr_page_address = array
(
	'content_pages' => $this->arr_result,
	'total_records' => $this->tot_result,
	'total_pages'   => $this->page_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page
 );
 
 $this->load->view("qty_view_assignment/view_quality_unassign_page", $arr_page_address);
	
}

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
 
 
 function SelectAllStaff()
{
 $out = new EUI_Object( _get_all_request() );
 $sel = $out->get_array_value('select');
 
 if( $out->get_value('type') == 'dropdown' ){
	echo form()->combo("qty_form_user_list", "select tolong", QualityAllStaff(), first($sel));
 } 
 else if( $out->get_value('type') == 'listboxes'){
	echo form()->listCombo("qty_form_user_list", "select tolong", QualityAllStaff(), $sel, null, array("dwidth" => "90%"));
 } 
 else {
	echo form()->combo("qty_form_user_list", "select tolong", QualityAllStaff(), first($sel));
  }
  
}

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package view data on distribute part 	
 *  
 */
 
function SubmitUnAssignQualityData()
{
   $cond = array("success" => 0 );
   $outClass = new EUI_Object( _get_all_request() );
   $obClass =& get_class_instance(base_class_model($this));
   
   if( $obClass->_set_row_quality_unassignment_data( $outClass ) )  {
	$cond = array("success" => 1);   
	
   }
   
   echo json_encode( $cond );
}

// ======================== END CLASS ============================================


// ======================== END CLASS ============================================


}
?>