<?php
class QtyStaffGroup extends EUI_Controller 
{
var $limit_default_page	 = 5;
/*
 * @def : constructor off class 
 * ----------------------------------
 *
 * @param : Unit Test 
 * @param : Unit Test 
 */
private static $view_layout = null;
	
/*
 * @def : constructor off class 
 * ----------------------------------
 *
 * @param : Unit Test 
 * @param : Unit Test 
 */

function QtyStaffGroup() 
{
	parent::__construct();
	$this -> load ->model(array(base_class_model($this)));
	$this -> load ->helper(array('EUI_Object'));
	
	if(is_null(self::$view_layout) ) {
		self::$view_layout = "qty_view_staffgroup"; 
	}	
}

	
/*
 * @def : constructor off class 
 * ----------------------------------
 *
 * @param : Unit Test 
 * @param : Unit Test 
 */

 public function getViewLayout() {
	return self::$view_layout;
 }

/*
 * @def : index default classes 
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
		$this->load->view("{$this -> getViewLayout()}/view_staff_group_nav");
		
	}	
}


/*
 * @def : index default classes 
 * ----------------------------------
 *
 * @param : Unit Test 
 * @param : Unit Test 
 */
 
public function StaffAvailable()
{
  if( $this ->EUI_Session ->_have_get_session('UserId') 
		AND class_exists(base_class_model($this)) )
  {
	$UI = array('view_staff_available' => $this -> {base_class_model($this)} ->_getStaffAvailable()); 
	$this->load->view("{$this -> getViewLayout()}/view_staff_available",$UI);
  }
  
}

/*
 * @def : index default classes 
 * ----------------------------------
 *
 * @param : Unit Test 
 * @param : Unit Test 
 */
 
public function PageStaffGroup()
{

  $this->start_page = 0;
  $this->per_page   = $this->limit_default_page;
  $this->post_page  = (int)_get_post('page');
  
  $obj_class =& get_class_instance(base_class_model($this));
  $this->arr_result = array();
  $this->arr_content = $obj_class->_getStaffByGroup( new EUI_Object( _get_all_request() ));
  //print_r( $this->arr_content);
  
  $total_page_record = count($this->arr_content);
  
  if( _get_have_post('Filter_Hide_Id') 
	  AND _get_post('Filter_Hide_Id') == 1 )
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
	'total_records' => $this->tot_result,
	'total_pages'   => $this->page_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page
 );

  $this->load->view("qty_view_staffgroup/view_staff_groups_page", $arr_call_history);			
	
}

/*
 * @def : AddAvailableSkill
 * ----------------------------------
 *
 * @param : QualityStaffId ( array)
 * @param : -
 */
 
public function AddAvailableSkill()
{
	$_conds = array('success' => 0);
	
	if( $this ->EUI_Session ->_have_get_session('UserId') 
	AND class_exists(base_class_model($this)) 
		AND $this -> URI -> _get_have_post('QualityStaffId') )
  {
		if( $result = $this -> {base_class_model($this)} -> _setAddAvailableSkill( $this -> URI -> _get_array_post('QualityStaffId') )) 
		{
			$_conds = array('success' => 1);
		}
  }
  
  __(json_encode($_conds));
}

/*
 * @ def : AssignQualitySkill
 * ----------------------------------
 *
 * @ param : Quality_Group_Id
 * @ param : Quality_Skill_Id
 */
 public function AssignQualitySkill()
{
	$_conds = array('success' => 0);
	
	$objClass =& get_class_instance(base_class_model($this));
	$objOuts =new EUI_Object(_get_all_request() );
	
	if( !$objOuts->fetch_ready() 
		OR !_have_get_session('UserId')  )
	{
		return FALSE;
	}
	
	$cond = $objClass->_setAssignQualitySkill( $objOuts );
	if( $cond ){
		$_conds = array('success' => 1);
	}
  
  echo json_encode($_conds);
	
}

/*
 * @ def : RemoveQualitySkill
 * ----------------------------------
 *
 * @ param : Quality_Group_Id
 * @ param : -
 */

 public function RemoveQualitySkill()
{
	$_conds = array('success' => 0);
	
	$objClass =& get_class_instance(base_class_model($this));
	$objOuts =new EUI_Object(_get_all_request() );
	
	if( !$objOuts->fetch_ready() 
		OR !_have_get_session('UserId')  )
	{
		return FALSE;
	}
	
	$cond = $objClass->_setRemoveQualitySkill( $objOuts );
	if( $cond ){
		$_conds = array('success' => 1);
	}
  
  echo json_encode($_conds);
}
 

 
/*
 * @ def : ClearQualitySkill
 * ----------------------------------
 *
 * @ param : Quality_Group_Id
 * @ param : -
 */

  public function QualitySkill() 
 {
	$arr_quality_skill = array(0);
	$objClass =& get_class_instance(base_class_model($this));
	$arr_quality_skill = $objClass->_getQualitySkill();
	if( is_array($arr_quality_skill) 
		AND count($arr_quality_skill) > 0  )
	{
		echo json_encode( $arr_quality_skill );
		return FALSE;
	} else {
		echo json_encode(array(0));
	}
 }
 
 
/*
 * @ def : ClearQualitySkill
 * ----------------------------------
 *
 * @ param : Quality_Group_Id
 * @ param : -
 */

 public function ClearQualitySkill()
{
$_conds = array('success' => 0);
	
	$objClass =& get_class_instance(base_class_model($this));
	$objOuts =new EUI_Object(_get_all_request() );
	
	if( !$objOuts->fetch_ready() 
		OR !_have_get_session('UserId')  )
	{
		return FALSE;
	}
	
	$cond = $objClass->_setClearQualitySkill( $objOuts );
	if( $cond ){
		$_conds = array('success' => 1);
	}
  
  echo json_encode($_conds);
}
// ======================= END CLASS ===================================================
}

?>