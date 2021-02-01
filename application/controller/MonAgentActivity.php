<?php
class MonAgentActivity extends EUI_Controller 
{

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
function __construct()
{
	parent::__construct();
	$this -> load -> model(array(base_class_model($this),'M_Astlib','M_Pbx'));
	$this -> load ->helper(array('EUI_Object'));
}

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function Content()
{
	if( $this -> EUI_Session->_get_session('UserId') )
	{
		$UserActivity = array('Activity' => $this->{base_class_model($this)}->_getIndex());
		$this -> load -> view("mon_activity_agent/mon_agent_activity_list",$UserActivity);
			
	}	
}

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function Store()
{
	if( $this -> EUI_Session->_get_session('UserId') )
	{
		$UserActivity = $this->{base_class_model($this)}->_getStore();
		echo json_encode($UserActivity);
	}	
}


public function UserActivity()
{
	$Time = $this->{base_class_model($this)}->UserActivity($this ->EUI_Session->_get_session('UserId'));
	echo json_encode(array('time'=> $Time));
}
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function index()
{
	
	if( $this -> EUI_Session->_get_session('UserId') )
	{
		$this -> load -> view("mon_activity_agent/mon_agent_activity_nav",$UserActivity);
	}	
}

/*
 * @ def 		: SpyAgent / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

public function SpyAgent()
{

 $Astlib  =& M_Astlib::getInstance();

 
 // set on pbx_host 
  
 $pbx_host = $this->M_Pbx->_select_pbx_by_extension( _get_post('ToExtension') );
  
 // set attribute connection 
	
 $Astlib -> setAstlib(array(
	'ASTMAN_HOST' => $pbx_host, //$this -> M_Pbx -> _get_pbx_host(),
	'ASTMAN_PORT' => 5038, 
	'ASTMAN_USER' => 'astcon', 
	'ASTMAN_PASS' => 'astcon01')
);
  
 // set option 
 
 //$Astlib -> setSpyOptions('bqh');
  //20140906: Aria for AST-1.8
  //$Astlib -> setSpyOptions('bqE');
  //20140913: Aria for AST-1.4
  $Astlib -> setSpyOptions('bq');
	
 // run spying

	
 $Astlib -> astChanSpy(
	"SIP/".$this -> URI->_get_post('FromExtension'), 
	"SIP/".$this -> URI->_get_post('ToExtension'), "centerback", 
	"");
/* 	
 * --------------------------------------------------------
 * 20140912 : omens 
 * post 	: ToExtension = accepted ( toExtension ) 
 * penyebab spying loncat 
 *
 */
 
}



/*
 * @ def 		: SpyAgent / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

public function CoachAgent()
{

 $Astlib  =& M_Astlib::getInstance();
 
 // set on pbx_host 
  
 $pbx_host = $this->M_Pbx->_select_pbx_by_extension( _get_post('ToExtension') );
 
 // set attribute connection 
	
 $Astlib -> setAstlib(array(
	'ASTMAN_HOST' => $pbx_host, //$this -> M_Pbx -> _get_pbx_host(),
	'ASTMAN_PORT' => 5038, 
	'ASTMAN_USER' => 'astcon', 
	'ASTMAN_PASS' => 'astcon01')
);
 
 // set option 
 
 //$Astlib -> setSpyOptions('bqh');
  //20140906: Aria for AST-1.8
  //$Astlib -> setSpyOptions('bqE');
  //20140913: Aria for AST-1.4
  $Astlib -> setSpyOptions('bq');
	
 // run spying
	
 $Astlib -> astChanSpyWhisper(
	"SIP/".$this -> URI->_get_post('FromExtension'), 
	"SIP/".$this -> URI->_get_post('ToExtension'), "centerback", "");
 
}


}

?>
