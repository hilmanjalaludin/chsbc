<?php 
class Dashboard extends EUI_Controller
{


 function __construct()
{ 
	parent::__construct();
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array("EUI_Object"));
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 function index()
{ 
  $out = & get_class_instance(base_class_model($this));
   $this->load->view("mod_view_dashboard/view_dashboard_nav", array (
		"Supervisor" => $out->_select_row_supervisor_by_login()
   ));
}

 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */ 
 
 function Content()
 {
	$out = & get_class_instance(base_class_model($this));
	
	$this->load->view("mod_view_dashboard/view_dashboard_content", array(
		"header" => $out->_select_row_label_dashboard(),
		"datacontent" => $out->_select_row_content_dashboard(),
		"content" => $out->_select_row_content_dashboard(),
	)); 
	
 }
// ============== END CLASS ======================
	
}

?>