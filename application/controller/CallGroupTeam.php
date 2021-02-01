<?php
/*
 * @ def 		: handle of group team exist for inbound only 
 * @ notes		: by default Outbound Ready Call
 * -----------------------------------------------------------------
 *
 * @ params  	: customerId if tru section not / all  
 * @ return 	: array();
 */

 
class CallGroupTeam extends EUI_Controller
{

public function CallGroupTeam() {
	parent::__construct();
	$this -> load -> model(array(base_class_model($this)));
}
	

/*
 * @ def 		: default aksess of class index 
 * -----------------------------------------------------------------
 *
 * @ params  	: @UserId < INT >
 * @ params 	: -
 */
 
public function index() 
{
  $_conds = array('INBOUND' => 0 );
	if( $this->EUI_Session->_have_get_session('UserId'))
	{
		$rs = $this->{base_class_model($this)}->_getGroupTeamUserId($this->EUI_Session->_get_session('UserId'));
		if( $rs > 0)
		{
			
			$_conds = array('INBOUND' => 1);
		}
	}
	
	__(json_encode($_conds));
}


}