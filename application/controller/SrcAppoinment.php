<?php
class SrcAppoinment extends EUI_Controller
{


 function __construct()
{
   parent::__construct();
   $this->load->model('M_SrcAppoinment');
   $this->load->helper(array('EUI_Object'));
}


/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function index()
 {
	if( $this ->EUI_Session ->_have_get_session('UserId') )
	{
		$_EUI  = array('page' => $this ->M_SrcAppoinment ->_get_default());
		//edit rangga belom selesai
		//var_dump('eui',$_EUI);die();	
		if( is_array($_EUI))
		{
			$this -> load ->view('src_appointment_list/view_appoinment_nav',$_EUI);
		}
	}	
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
function Content()
{
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this ->M_SrcAppoinment ->_get_resource();    // load content data by pages 
		$_EUI['num']  = $this ->M_SrcAppoinment ->_get_page_number(); // load content data by pages 
		
		// sent to view data		
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('src_appointment_list/view_appoinment_list',$_EUI);
		}	
	}	
}
 
// ----------------------------------------------------------
/*
 * @ pack 			function call 
 */
 
 public function Update()
{
	$callback = array('success' => 0);
	if(_get_have_post('AppoinmentId') )
	{
		$this->db->set('ApoinmentFlag', 1);
		$this->db->where('AppoinmentId', _get_post('AppoinmentId') , FALSE);
		$this->db->where('UserId',_get_session('UserId') , FALSE);
		
		if( $this->db->update('t_gn_appoinment') )
		{
			$this->db->reset_write();
			$this->db->select("CustomerId", FALSE);
			$this->db->from("t_gn_appoinment");
			$this->db->where("AppoinmentId", _get_post('AppoinmentId'));
			
			$rs = $this->db->get();
			if( $rs->num_rows() > 0 ){
				$CustomerId = $rs->result_singgle_value();
			}
			
			$callback = array( 'success' => 1,  'CustomerId' => $CustomerId );
		}
	}
	
	echo json_encode( $callback );
}	
 
}

?>