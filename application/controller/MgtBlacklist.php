<?php
class MgtBlacklist extends EUI_Controller
{
	function MgtBlacklist()
	{
		parent::__construct();
		$this->load->model(array(
			'M_MgtBlacklist'
		));
	}
	
	function index()
	{
		$this->load->view('mgt_blacklist_data/view_blacklist_nav',array(
			'file' => $this->M_MgtBlacklist->_get_file_name(),
			'page' => $this->M_MgtBlacklist->_get_default()
		));
	}
	
	function Content()
	{
		if(_have_get_session('UserId') )
		{
			$this->load->view("mgt_blacklist_data/view_blacklist_list", array(
				'page' => $this->M_MgtBlacklist->_get_resource(),
				'num'  => $this->M_MgtBlacklist->_get_page_number()	
			));	
		}	
	}
	
	function ManualInput()
	{
		if( $this -> EUI_Session -> _have_get_session('UserId') )
		{
			$this -> load -> view("mgt_blacklist_data/view_blacklist_input", array(
				
			));
		}
	}
	
	function ManualUpload()
	{
		if( $this -> EUI_Session -> _have_get_session('UserId') )
		{
			$this -> load -> view("mgt_blacklist_data/view_blacklist_upload", array(
				
			));
		}
	}
	
	function DeleteData()
	{
		$conds = array('success'=>0,'total'=>0);
		$ID = $this->URI->_get_array_post('ID');
		
		if(is_array($ID))
		{
			foreach($ID as $k => $v)
			{
				$this->db->delete('t_lk_blacklist',array(
					'Id' => $v
				));
				
				if($this->db->affected_rows()>0){
					$conds['total']++;
					$conds['success']=1;
				}
			}
		}
		
		echo json_encode($conds);
	}
	
	function SaveInput()
	{
		$conds = array('success'=>0);
		
		if( $this->M_MgtBlacklist->_SaveInput($this->URI->_get_all_request()) )
		{
			$conds = array('success'=>1);
		}
		
		echo json_encode($conds);
	}
	
	function StartUpload()
	{
		$this->load->upload("U_Blacklist");
		$this->load->helpers("EUI_Object");
		$U_Blacklist=& get_class_instance('U_Blacklist');
		
		foreach( $_FILES as $k => $row )
		{
			$U_Blacklist->import_row_promo_excel( new EUI_Object( $row ) );
		}
	   
	   $arr_call_back = $U_Blacklist->_select_row_xls_call_back();
	   echo json_encode( $arr_call_back );
	}
}
?>