<?php
/*
 *
 */
class MgtDetailData Extends EUI_Controller
{

/*
 *
 */
 
public function MgtDetailData()
 {
	parent::__construct();	
	$this -> load -> model(array(base_class_model($this),'M_Combo'));
 }
 
 
 /*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getCombo()
 {
	$_serialize = array();
	$_combo = $this ->M_Combo->_getSerialize();
	foreach( $_combo as $keys => $method )
	{
		if((STRTOLOWER($keys)!='serialize') AND (STRTOLOWER($keys)!='instance') 
			AND (STRTOLOWER($keys)!='nstruct') AND (STRTOLOWER($keys)!='t'))
		{
			$_serialize[$keys] = $this ->M_Combo->$method(); 	
		}
	}
	
	return $_serialize;
 } 
 
/*
 *
 */
 
public function index()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( class_exists(base_class_model($this)) ) 
		{
			$EUI = array( 'page' => $this -> {base_class_model($this)} -> _get_default());
			
			$this -> load -> view('mgt_customer_detail/view_detail_data_nav', $EUI);
		} 
		else
		{
			echo "Class ".base_class_model($this)." does no exist ";
			exit(0);
		}
	}
 }
 

/*
 *
 */ 
 
function DetailContent()
{
	if( $this ->EUI_Session -> _have_get_session('UserId'))
	{
		$UI = array(
			'data' => $this -> {base_class_model($this)}-> _getDetailCustomer($this->URI->_get_post('CustomerId')),
			'field' => $this -> {base_class_model($this)}->_getFields(),
			'input' => $this -> {base_class_model($this)}->_getAttribute(),
			'combo' => $this ->_getCombo()
			);
		$this -> load -> view('mgt_customer_detail/view_detail_content', $UI);
	}	
} 
 
/*
 *
 */
 
public function Content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId'))
	{
		$EUI['page'] = $this ->{base_class_model($this)}-> _get_resource(); // load content data by pages 
		$EUI['num']  = $this ->{base_class_model($this)}-> _get_page_number(); 	// load content data by pages 
		
		$this -> load -> view('mgt_customer_detail/view_detail_data_list', $EUI );
	}	
 }
 
// Update
 
 public function Update()
 {
	$success = array('success'=>0);
	
	if( $this -> EUI_Session -> _have_get_session('UserId'))
	{
		$params = $this -> URI->_get_all_request();
		
		$results = $this ->{base_class_model($this)}-> _setUpdate($params);
		if( $results )
		{
			$success = array('success'=>1); 
		}
	}

	echo json_encode($success);	
	
 }
 
}

?>