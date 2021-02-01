<?php

/*
 * E.U.I 
 *
 
 * subject	: get SetCampaign modul 
 * 			  extends under EUI_Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysuser/
 */
 
class SetCmpAssignCmp extends EUI_Controller
{
	
/*
 * EUI :: index() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
 
function __construct()
{
	parent::__construct();
	$this -> load -> model(array("M_SetCmpAssignCmp","M_Utility","M_ModOutboundGoal","M_SetProduct"));
}
	
/*
 * EUI :: index() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
 
function index()
{

 if( $this -> EUI_Session -> _have_get_session('UserId'))
 {
	$EUI['page'] = $this -> M_SetCmpAssignCmp -> _get_default();
	$this -> load -> view('set_cmpassigncmp/view_cmpassigncmp_nav', $EUI );
 }
 
}

/*
 * EUI :: Content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */

function Content()
{
 if( $this -> EUI_Session -> _have_get_session('UserId'))
 {
	$EUI['page'] = $this->{base_class_model($this)}->_get_resource_query(); // load content data by pages 
	$EUI['num']  = $this->{base_class_model($this)}->_get_page_number(); 	// load content data by pages 
	$EUI['size'] = $this->{base_class_model($this)}->_get_size_campaign();
	
	$this -> load -> view('set_cmpassigncmp/view_cmpassigncmp_list', $EUI );
 }
}

/*
 * EUI :: Content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */



/*
 * EUI :: Content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */

function Manage()
{
	if( $this -> EUI_Session -> _have_get_session('UserId')) {
		$UI = array
		(
		'PhoneNo' => $this->{base_class_model($this)}->_getIVRPhoneNo(),
		'AvailOut' => $this->{base_class_model($this)}->_getCampaignGoals(2),
		'AvailIn' => $this->{base_class_model($this)}->_getCampaignGoals(1)
		); 
		$this -> load -> view('set_cmpassigncmp/view_manage_cmpassigncmp',$UI);
	}
}



/*
 * EUI :: Content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
	
function SaveCampaign()
{
	$_success = array('success'=> 0, 'error'=> ''); 
	$_post = array();
	if( $this -> EUI_Session -> _have_get_session('UserId') ) 
	{
		$_post_data = $this -> URI -> _get_all_request();
		if( isset($_post_data['CampaignNumber']) )
		{
			if( $this -> M_SetCampaign -> _set_save_campaign()) 
			{
				$_success = array('success'=>1, 'error'=> ''); 
			}
		}
	}
	
	echo json_encode($_success);
}
	
}

?>