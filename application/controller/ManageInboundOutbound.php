<?php 
class ManageInboundOutbound extends EUI_Controller
{		
	
/* ManageInboundOutbound ***/
	
public function ManageInboundOutbound() 
{
	parent::__construct();
	$this -> load->model(array(base_class_model($this),'M_Combo','M_SetCampaign'));
}


 /*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function Combo()
 {
	$_serialize = array();
	$_combo = $this ->M_Combo->_getSerialize();
	foreach( $_combo as $keys => $method ) {
		if((STRTOLOWER($keys)!='serialize') AND (STRTOLOWER($keys)!='instance') 
			AND (STRTOLOWER($keys)!='nstruct') AND (STRTOLOWER($keys)!='t'))
		{
			$_serialize[$keys] = $this ->M_Combo->$method(); 	
		}
	}
	
	return $_serialize;
 }
 
/* index ***/

public function index() 
{
	$UI = $this ->{base_class_model($this)}->Pager();
	$this -> load -> view("set_campaign/view_inbound_bucket_nav.php",$UI  );
}

/* content ***/

public function content()
{
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$EUI = array();
		$EUI['combo']  = $this->Combo();
		$EUI['result'] = $this->{base_class_model($this)}->Records( $this -> URI -> _get_post('v_page') );
		$EUI['start']  = $this->{base_class_model($this)}->PageNumber();
		$EUI['page']   = $this->URI->_get_post('v_page');
		
		if( is_array($EUI) )
		{
			$this -> load -> view("set_campaign/view_inbound_bucket_list.php", $EUI);
		}	
	}	
}

/* http://localhost:8080/AIA/index.php/ManageInboundOutbound/getUserByPrivileges/?PrivilegeId=4 **/


public function getUserByPrivileges()
{
 if( $this -> URI->_get_have_post('PrivilegeId') )
 {
	$combo = $this -> M_SysUser->_getUserLevelGroup( $this -> URI->_get_post('PrivilegeId') );
	__(form()->combo('UserId', 'select', $combo));
	
 }	
}


/* http://localhost:8080/AIA/index.php/ManageInboundOutbound/SaveByChecked/ **/

public function SaveByChecked() 
{
   $_VAR_MSG = array('success' => 0);
   
	$_VAR_DATA['PARAM'] = $this -> URI->_get_all_request();
	$_VAR_DATA['ID'] = $this -> URI->_get_array_post('CustomerId');
	
	if( is_array($_VAR_DATA) )
	{
		if( $result = $this->{base_class_model($this)}->_setSaveByChecked( $_VAR_DATA ) )
		{
			$_VAR_MSG = array('success' => 1);
		}
	}

	__(json_encode($_VAR_MSG));	
}


// SaveByAmount

public function SaveByAmount()
{	
	$_VAR_MSG = array('success' => 0);
   
	$_VAR_DATA  =  $this -> URI->_get_all_request();
	if( is_array($_VAR_DATA) )
	{
		if( $result = $this->{base_class_model($this)}->_setSaveByAmount($_VAR_DATA)){
			$_VAR_MSG = array('success' => 1);
		}
	}

	__(json_encode($_VAR_MSG));	
}

	
}