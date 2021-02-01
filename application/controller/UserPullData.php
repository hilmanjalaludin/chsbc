<?php 
class UserPullData extends EUI_Controller
{
	
 var $gDistributeRata = 1;
 var $gDistributeAgent = 2;

 
//--------------------------------------------------------------------------------------
/*
 * @ aksess : public 
 */ 
 
 function __construct()
{
	parent::__construct();
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object'));
}

// --------------------------------------------------------------------------------------
/*
 * @ aksess : public 
 */ 
 
 public function index()
{ 
  $out =new EUI_Object( _get_all_request() );
  
  /*print_r( $out );
  exit;
  [pull_call_start_date] => 
  [pull_end_start_date] => 
  [pull_from_campaign_id] => 18
  [pull_call_result_id] => 
  [pull_from_user_group] => 
  [pull_form_user_list] => 
  [pull_user_total] => 5
  [pull_user_quantity] => 1
  [pull_user_type] => 1
  [pull_to_user_group] => 4
  [pull_user_mode] => 1
  [pull_user_action] => 1
  [pull_to_user_list] => 53,55
  [AssignId] => 
  */
  
  $cond = array('success' => 0)	;
  
  if( !_have_get_session('UserId') ) 
  {
	echo json_encode( $cond );
	return false;
  }
  
 //--------------- checj parameter ------------------------ 
 
 if( !$out->fetch_ready()) 
 {
	echo json_encode( $cond );
	return false;	
  }	

// --------- tes -----------
// $out->debug_label();
  $output =& get_class_instance(base_class_model($this)); 
  if( $out->get_value('pull_user_type') == 1 )
 {
	$cond = array(
		'success' => $output->_set_row_pulldata_rata( $out )
	);
  }
 
   if( $out->get_value('pull_user_type') == 2 )
  {
	$cond = array(
		'success' => $output->_set_row_pulldata_agent( $out )
	);
	
  }  
   echo json_encode( $cond );
}


// =========== END CLASS ===============================================================

}
?>