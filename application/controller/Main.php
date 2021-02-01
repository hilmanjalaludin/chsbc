<?php
/*
 * EUI Controller  
 *
 
 * Section  : < Main > first load vail web home  if login true .
 * author 	: razaki team  
 * link		: http://www.razakitechnology.com/eui/controller 
 */
 
class Main extends EUI_Controller
{
 
// -------------------------------------------------------
/*
 * @ package 	: copyright
 */
public function __construct() 
{
	parent::__construct();
	$this->load->model(array("M_Menu","M_ModCtiLogin"));
	$this->load->helper('EUI_Object');
}

// -------------------------------------------------------
/*
 * @ package 	: copyright
 */
public function index()
{
  	if(_have_get_session('UserId') ) 
    {
    	$out =& get_class_instance('M_Menu'); // on static methode
	  	$cti =& get_class_instance('M_ModCtiLogin'); // on static methode 
	
		$this -> load -> layout( $this->Layout->base_layout() .'/UserMain',array( 
			'menu' => $out->_get_acess_menu(),
			'CTI'  => $cti->M_ModCtiLogin	
	 	));
    } else {
		redirect("Auth/?login=(false)");
	}
}

}

// END OF FILE
// location : ../application/controller/Main.php *
?>