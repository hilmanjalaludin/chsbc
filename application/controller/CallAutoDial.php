<?php
class CallAutoDial extends EUI_Controller
{
	function CallAutoDial()
	{
		parent::__construct();
		$this->load->model(array(
			base_class_model($this),'M_SrcCustomerList'
		));
		$this->load->helper('EUI_Object');
	}
	
	function start_autodial()
	{
		$_datas = array('success'=>0,'autokey'=>0);
		$xxx = $this ->M_SrcCustomerList ->_get_data_dial();
		
		if($xxx['total']>0)
		{
			$_datas['success'] = 1;
			$_datas['autokey'] = $xxx['key'];
		}
		
		echo json_encode($_datas);
	}
	
	
	function get_next_data()
	{
		$_datas = array('result'=>0,'detail'=>array());
		
		$zzz = $this ->{base_class_model($this)} ->_get_next_autodial(_get_all_request());
		
		if($zzz['result']>0)
		{
			$_datas['result'] = 1;
			$_datas['detail'] = $zzz['detail'];
		}
		
		echo json_encode($_datas);
	}
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 	
function start_autocall()
{
	$this->cok = CK();
  	$this->val = UR(); 
  	if( !$this->cok->find_value('UserId') ) { return FALSE; }
	if(  $this->val->field('CustomerId') )
	{
		$var = new EUI_Object( _get_all_request() );
		$out = Singgleton('M_SrcCustomerList');
		
		$verif_stat = $out->_getVerifStat($var->get_value('CustomerId'));
		$cdd_stat   = $out->_getCddStat($var->get_value('CustomerId'));

		if($second_product = $out->_getDetailSecondProduct($var->get_value('CustomerId'))){
			
			if( $arr_ouput = $out->_getDetailCustomer( $var->get_value('CustomerId') ) ){
				$oke = new EUI_Object($arr_ouput);
				$this->load->view('mod_auto_dialss/view_contact_main_detail', array(
					'Detail' 		=> new EUI_Object( $arr_ouput ),
					'Detail_attr' 	=> $out->_getDetailAttr($arr_ouput['TableDetail'], $var->get_value('CustomerId')),
					'SecondDetail' 	=> new EUI_Object( $second_product ),
					'ver_res_stat'	=>$verif_stat,
					'cdd_stat'		=>$cdd_stat,
					'phone_number'	=> $out->_getPhoneCustomer2($var->get_value('CustomerId'))

				));
			}
		}else{
			if( $arr_ouput = $out->_getDetailCustomer( $var->get_value('CustomerId') ) ){
				$oke = new EUI_Object($arr_ouput);
				$this->load->view('mod_auto_dialss/view_contact_main_detail', array(
					'Detail' 		=> new EUI_Object( $arr_ouput ),
					'Detail_attr' 	=> $out->_getDetailAttr($arr_ouput['TableDetail'], $var->get_value('CustomerId')),
					'ver_res_stat'	=>$verif_stat,
					'cdd_stat'		=>$cdd_stat,
					'phone_number'	=> $out->_getPhoneCustomer2($var->get_value('CustomerId'))

				));
			}
		}
	}
	
 

   /*MODUL AWAL AUTO DIAL*/
/*
 	$this->cok = CK();
  	$this->val = UR(); 
  	//new EUI_Object( _get_all_request() );
   
   	if( !$this->cok->find_value('UserId') ) { 
		return FALSE; 
   	}

 	if( !$this->val->find_value('CustomerId') ) {
		return false;
 	}
 
 	$this->out = Singgleton('M_SrcCustomerList');
 	$this->row = $this->out->_getDetailCustomer( $this->val->field('CustomerId') );

 	if( is_array( $this->row ) ) 
 	{
		// detail data over to object 
		$this->dtl = Objective(array());
		if( is_array($this->row ) ){
			$this->dtl =  Objective( $this->row );
	}
	$this->load->view('mod_auto_dial/view_autodial_main_detail', array( 'ArrDetail' => $this->row,
	 																	'Detail' => $this->dtl, 
	 																	'Param' => $this->val ));
 	}
*/
 	/*END MODUL AWAL AUTO DIAL*/
 
		
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */	
	function get_session_status()
	{
		$_datas = array('success'=>0);
		$_stats = array('3002','3007');
		$sql = "select `status` from cc_call_session where session_id='"._get_post('CallSession')."'";
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			$row = $qry->result_first_assoc();
			// if($row['status']=='3002'){
			if(in_array($row['status'],$_stats)){
				$_datas['success'] = 1;
			}
		}
		
		echo json_encode($_datas);
	}
	
	function set_next_customer()
	{
		$_datas = array('result'=>0);
		
		$zzz = $this ->{base_class_model($this)} ->_set_flag_by_cust(_get_all_request());
		
		if($zzz)
		{
			$_datas['result'] = 1;
		}
		
		echo json_encode($_datas);
	}
	
	function clear_session()
	{
		$this->db->delete('t_gn_autodial',array(
			'AutoDialKey' => _get_post('AutoKey')
		));
	}
}
?>