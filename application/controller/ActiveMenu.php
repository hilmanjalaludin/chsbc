<?php 

// ------------------------------------------------------------------------------------------------------------------------
/*
 * @ package 		Active Menu 
 *
 */
 
class ActiveMenu extends EUI_Controller
{
	
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
  public function __construct() 
{
	parent::__construct();	
	$this->load->model(array('M_ActiveMenu'));
	$this->load->helper(array('EUI_Object'));
 }
 
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */

 public  function index() { }  

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */

 public  function Toolbars()
{
 $arr_toolbars = array();
 $obj_toolbars =& get_class_instance('M_ActiveMenu');
 if( is_object($obj_toolbars) ) {
	$arr_toolbars = (array)$obj_toolbars->_select_toolbar_user();
 }
 echo json_encode($arr_toolbars);
 
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */

 public  function UserSession()
{
	$arr_cookies = array();
	$arr_sesison = $this->EUI_Session->get_real_session();
	if( is_array($arr_sesison) )
		foreach( $arr_sesison as $key => $val ) 
	{
		if( !is_null( $val ) AND !is_array( $val )) {
			$arr_cookies[base64_encode( $key )] = base64_encode( $val );	
		}	
	}
	
	echo json_encode( $arr_cookies );
}
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */

 public  function UserPrivilege()
{
  $arr_privilege = array();
  $obj_privilege =& get_class_instance('M_ActiveMenu');
  $arr_privilege = $obj_privilege->_select_user_privilege();
  
  echo json_encode( $arr_privilege );
  
  
}
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */

 public function UserConfig()
{
	echo json_encode(array(
		'NEW_STATUS' 		=> (int)NEW_STATUS,
		'QUALITY_SCORES' 	=> (int)QUALITY_SCORES,
		'QUALITY_APPROVE' 	=> (int)QUALITY_APPROVE,
		'CALL_BACK_LATER' 	=> (int)CALL_BACK_LATER,
		'USER_CHAT_TIMER' 	=> (int)USER_CHAT_TIMER,
		'SUSPEND_DATA'		=> (int)SUSPEND_DATA,
		'SUSPEND_SELLING' 	=> (int)SUSPEND_SELLING,
		'INS_CODE_DEPEND' 	=> (int)INS_CODE_DEPEND,
		'INS_CODE_SPOUSE' 	=> (int)INS_CODE_SPOUSE,
		'INS_CODE_MAIN' 	=> (int)INS_CODE_MAIN,
		'INS_CODE_RIDER' 	=> (int)INS_CODE_RIDER,
		'INS_CODE_FAMILY' 	=> (int)INS_CODE_FAMILY
	));	
}
  
 
// ============= END CLASS ==================	
}

?>