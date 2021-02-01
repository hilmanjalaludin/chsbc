<?php
 
// edit rangga Cdd
class CddPilx extends EUI_Controller
{
	function CddPilx()
	{
		parent::__construct();
		$this->load->model(array(
			base_class_model($this)
		));
	}
	
	function index()
	{
		
		$rec=$this->URI->_get_all_request();
		// var_dump('rec',$rec);die();
		$id=$rec['CustomerId'];
		$Cust=$this->M_CddPilx->get_data_cust($id)->row();
		$need_income_status=$this->M_CddPilx->get_data_need($id,$Cust->CampaignId)->row();
		//var_dump('cus',$need_income_status);die();
		$data['data']=$Cust;
		$data['nis']=$need_income_status;
		// var_dump($data);die();
		// var_dump($data['nis']);die();
		$this->load->form('CddPilx/view_form_default',$data);
	}
	
	function cddSecondProduct()
	{
		
		$rec=$this->URI->_get_all_request();
		// var_dump('rec',$rec);die();
		$id=$rec['CustomerId'];
		$Cust=$this->M_CddPilx->get_data_cust($id)->row();
		$need_income_status=$this->M_CddPilx->get_data_need_2nd($id)->row();
		$data['data']=$Cust;
		$data['nis']=$need_income_status;
		// var_dump($data);
		// var_dump($data['nis']);die();
		$this->load->form('CddPilx/view_form_default_second_product',$data);
    }
    
    function save_cdd()
    {
		// var_dump($this->URI->_get_all_request());

		// var_dump('dump',$this->{base_class_model($this)}->_save_activity($this->URI->_get_all_request()));die();
		$hasil=$this->{base_class_model($this)}->_save_activity($this->URI->_get_all_request());
		if($hasil=="succes"){

			echo json_encode(array('success'=>1));
		}else{
			echo json_encode(array('success'=>0));
		}
	}
	
    function save_cdd_2nd()
    {
		// var_dump($this->URI->_get_all_request());

		// var_dump('dump',$this->{base_class_model($this)}->_save_activity($this->URI->_get_all_request()));die();
		$hasil=$this->{base_class_model($this)}->_save_activity_2nd($this->URI->_get_all_request());
		if($hasil=="succes"){

			echo json_encode(array('success'=>1));
		}else{
			echo json_encode(array('success'=>0));
		}
    }
	
	
}
?>