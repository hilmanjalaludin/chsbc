<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModSaveActivity extends EUI_Controller
{

	function __construct(){
		parent::__construct();
		$this->load->model(array(base_class_model($this)));
		$this->load->helper('EUI_Object');
	}

	function SaveActivityConfirm(){
		$cond = array('success' => 0 );	
		$out = UR(); 
		if( !$out->fetch_ready() OR !_get_is_login() ){
			echo json_encode( $cond );
			return false;
		}

		$obClass =& get_class_instance(base_class_model($this));
		if($obClass->_set_row_save_followup_activity( $out )){
			echo json_encode( array('success' => 1));	
			return true;
		} 
		echo json_encode( $cond );
	}

	function getcddstat(){
		$data=$this->URI->_get_all_request();
		// var_dump($data['CustomerId']);die();
		$row=$this->db->get_where('t_gn_cdd',array('CustId' => $data['CustomerId'] ))->num_rows();
		#var_dump($this->db->last_query());die();
		echo json_encode(array('success' => 1, 'data' => $row));
	}

	function SaveActivity(){
		//edit rangga
		$cond = array('success' => 0, 'disabled' => 0 );	
 
		// get parameter all process to object 
		$this->out = UR(); 
		$this->std = Singgleton($this);

		//  print_r($this->out );die();
		if( !$this->out->fetch_ready() OR !_get_is_login() ){
			echo json_encode( $cond );
			return false;
		}
 
		// cek apakah da call result yang di kirim 
		if($this->out->get_value('FirstProductFlag')=="true" ){
			if( !$this->out->field('CallResult') ){
				echo json_encode( $cond );
				return false; 
			}
		}else{
			if( !$this->out->field('CallResult_2nd') ){
				echo json_encode( $cond );
				return false; 
			}
		}
 
		// echo "// jika ketika cek data bernilai true  = 1 maka tolak save Akctivitynya ";
		$callDispositionAbandone = $this->std->_select_row_abandone_flags($this->out);
		#var_dump( $this->out->get_value('FirstProductFlag') ); die(); 
		if( $callDispositionAbandone ){
			echo json_encode(array( 'success'  => 0, 'disabled' => 1 ));
			return false;
		} 

		// save data process --------------
		if($this->out->get_value('FirstProductFlag')=="true"){
			
			if( $this->std->_set_row_save_activity_call( $this->out )){
				echo json_encode(array('success' => 1, 'disabled' => 0 ));	
				return false;
			}
		}else{
			#var_dump( $this->out ); die();
			if( $this->std->_set_row_save_activity_call_second_product( $this->out )){
				echo json_encode(array('success' => 1, 'disabled' => 0 ));
				return false;
			}
		}

		//update flag_followup ke 0 after save data
		if( $this->EUI_Session->_get_session('UserId') !=FALSE ){
			$this->db->reset_write();
			$this->db->set("Flag_Followup",0);
			$this->db->where("Flag_Followup", 1);
			$this->db->where("SellerId", _get_session('UserId'));
			$this->db->where("expired_date >= curdate()");
			$this->db->update("t_gn_customer");
		}
 
		echo json_encode( $cond );
	}


	function SaveSuspendActivity(){

		$cond = array('success' => 0 );	

		// -------- called object data -----------------------------

		$out =new EUI_Object(_get_all_request() );
		if( !$out->fetch_ready() OR !_get_is_login() ){
		 echo json_encode( $cond );
		 return false;
		}

		$obClass =& get_class_instance(base_class_model($this));

		// --------- on suspend selling -----------------------------
		if(  ($out->get_value('QualityStatus') == SUSPEND_SELLING )
		AND _get_have_post('CallingNumber') )
		{
		$save =  $obClass->_set_row_save_activity_suspend_selling( $out );
		}

		// --------- on suspend selling -----------------------------
		if(  ($out->get_value('QualityStatus') == SUSPEND_STILL )
		AND _get_have_post('CallingNumber') )
		{
		$save =  $obClass->_set_row_save_activity_suspend_still( $out );
		}


		// --------- on suspend data -----------------------------
		if(  $out->get_value('QualityStatus') == SUSPEND_DATA ){
		$save = $obClass->_set_row_save_activity_suspend_data( $out );
		}

		// ----------- next data process --------------
		if( $save ) {
		 echo json_encode( array('success' => 1));	
		 return true;
		} 

		echo json_encode( $cond );
	}

	function FollowUpSaveActivity(){
		$cond = array('success' => 0);
		$out =new EUI_Object(_get_all_request() );
		if( !$out->fetch_ready() OR !_get_is_login() ) 
		{
		echo json_encode( $cond );
		return false;
		}

		$obClass =& get_class_instance(base_class_model($this));
		if( $obClass-> _set_row_save_followup_activity( $out ) ) {
		$cond = array('success' => 1);
		}

		echo json_encode( $cond );
	} 
 
 
	function SaveInfoCustomer(){
		$cond = array('success' => 0);	
		$out =new EUI_Object(_get_all_request() );

		// --------- check validate data post ----------------------------

		if( !$out->fetch_ready() OR !_get_is_login() ) {
		echo json_encode( $cond );
		return false;
		}

		$obClass =& get_class_instance(base_class_model($this));
		if( $obClass->_set_row_save_customer( $out ) )
		{
		 $cond = array('success'=>1);
		}

		echo json_encode($_cond);
	}

 function SaveQualityActivity() 
 {
	$_conds = array('success' => 0); $_post = null;	
	$_post =  $this ->URI->_get_all_request();
	if( !is_null($_post) ) 
	{
		if( $this->{base_class_model($this)}-> _setQualityActivity($_post))
		{
			$_conds = array('success' => 1);
		}
	}
	
	echo json_encode($_conds);
}

 public function CallHistory() {
	echo "Sorry, CallHistory was move to {ModCallHistory} ";
 }
 
	function PreviewProduct(){
		$CallHistory = null;
		if( $this -> URI->_get_have_post('CustomerId') ){
			$CustomerId = $this -> URI->_get_post('CustomerId');
			if( $CustomerId ){
				$CallHistory= array('data' => $this->{base_class_model($this)}->_getPreviewData($CustomerId) );
		}
		
		// $this -> load -> view("mod_contact_detail/view_preview_product_content",$CallHistory);
		}
	}

	function ProdSum(){
		$ProdSum = null;
		if( $this -> URI->_get_have_post('CustomerId') ){
			$CustomerId = $this -> URI->_get_post('CustomerId');
			if( $CustomerId ){
				$ProdSum= array('ProdSummary' => $this->{base_class_model($this)}->getProductSummary($CustomerId) );
			}
			
			$this -> load -> view("mod_contact_detail/view_prodsum_content",$ProdSum);
		}
	}
	 
	// product preview
	public function ProdPreview(){
		if(  $datas = array( "ProductSimulate" => $this ->{base_class_model($this)}->_getProductPreview()) )
		{
			$this ->load->view("mod_contact_detail/view_simulate_list",$datas);
		}
	}
 
	function LoadAddPhone(){
		echo form()->combo('AddPhoneNumber','select tolong select-chosen',CustomerAdditionalPhone(_get_post('CustomerId')), null, array("change" =>"Ext.Cmp('CallingNumber').setValue(this.value);Ext.Cmp('PhoneNumber').setValue('');"));
	}





}
?>
