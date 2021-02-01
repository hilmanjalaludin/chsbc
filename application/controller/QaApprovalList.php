<?php
class QaApprovalList extends EUI_Controller
{
	function QaApprovalList()
	{
		parent::__construct();
		$this->load->model(array(
			base_class_model($this),'M_SrcCustomerList'
		));
		$this->load->helper('EUI_Object');
	}
	
	function index()
	{
		if( $this ->EUI_Session ->_have_get_session('UserId') )
		{
			$this->load ->view('qa_approval_list/view_approval_nav',array(
				'page' => $this->{base_class_model($this)}->_get_default(),
			));
		}
	}
	
	function Content()
	{
		if( $this -> EUI_Session -> _have_get_session('UserId') )
		{
			$_EUI['page'] = $this ->{base_class_model($this)}->_get_resource();    // load content data by pages 
			$_EUI['num']  = $this ->{base_class_model($this)} ->_get_page_number(); // load content data by pages 
			
			// sent to view data 
			
			if( is_array($_EUI) && is_object($_EUI['page']) )  
			{
				$this -> load -> view('qa_approval_list/view_approval_list',$_EUI);
			}
		}
	}
	
	
	public function SetFollowup()
	{
		$arr_response = array('success' => 0 );
		if( !_get_have_post('CustomerId') OR !_have_get_session('UserId') )
		{
			echo json_encode( $arr_response );
			return false;
		}
 
 // -------- set follow up ---------------------------------
		$cond = $this->{base_class_model($this)}->_set_row_update_followup(new EUI_Object( _get_all_request() ));
		if( $cond ){
			$arr_response = array('success' => 1 );	
		}	 
  
		echo json_encode( $arr_response );
	} 

// --------------------------------------------------------------------
/*
 * Aksess 			public 
 */ 
 
	public function UnsetFollowup()
	{
		$arr_response = array('success' => 0 );
		if( !_get_have_post('CustomerId') OR !_have_get_session('UserId') )
		{
			echo json_encode( $arr_response );
			return false;
		}
 
 // -------- set follow up ---------------------------------
		$cond = $this->{base_class_model($this)}->_unset_row_update_followup(new EUI_Object( _get_all_request() ));
		if( $cond ){
			$arr_response = array('success' => 1 );	
		}	 
  
		echo json_encode( $arr_response );
	} 
	
	public function ContactDetail()
	{
		if( !_have_get_session('UserId') ) { return FALSE; }
		if(  _get_have_post('CustomerId') )
		{
			$var =new EUI_Object( _get_all_request() );
			$out =& get_class_instance('M_SrcCustomerList');
			
			if( $arr_ouput = $out->_getDetailCustomer( $var->get_value('CustomerId') ) )
			{
				$this->load->view('mod_quality_detail/view_contact_main_detail', array(
					'Detail' => new EUI_Object( $arr_ouput ),
					'Result' => $this->{base_class_model($this)}->_get_result_param(new EUI_Object( _get_all_request() ))
				));
			}
		}
	}
	
	function SaveActivity()
	{
		$cond = array('success' => 0 );	
		// -------- called object data -----------------------------

		$out =new EUI_Object(_get_all_request() );
		if( !$out->fetch_ready() OR !_get_is_login() ){
			echo json_encode( $cond );
			return false;
		}

		// ----------- next data process --------------

		$obClass =& get_class_instance(base_class_model($this));
		if( $obClass->_set_row_save_activity_call( $out ) ) 
		{
			echo json_encode( array('success' => 1));
			return true;
		} 

		echo json_encode( $cond );
	}
	
	function SaveParam()
	{
		$conds = array('success'=>0);
		
		$this->db->insert('t_gn_approval_result',array(
			'CustomerId' 	=> _get_post('CustomerId'),
			'ParamCode' 	=> _get_post('ParamCodes'),
			'ParamResult' 	=> _get_post('ParamValue'),
			'ResultTs' 		=> date('Y-m-d H:i:s'),
			'ResultBy' 		=> _get_session('UserId'),
		));
		
		if( $this->db->affected_rows() < 1 ){
			$this->db->update('t_gn_approval_result',array(
				'ParamResult' 	=> _get_post('ParamValue'),
				'ResultTs' 		=> date('Y-m-d H:i:s'),
				'ResultBy' 		=> _get_session('UserId'),
			),array(
				'CustomerId' 	=> _get_post('CustomerId'),
				'ParamCode' 	=> _get_post('ParamCodes'),
			));
			
			if( $this->db->affected_rows() > 0 ){
				$conds = array('success'=>1);
			}
		}
		else{
			$conds = array('success'=>1);
		}
		
		echo json_encode($conds);
	}
}
?>