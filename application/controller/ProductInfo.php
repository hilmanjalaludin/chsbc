<?php
class ProductInfo extends EUI_Controller
{
	function ProductInfo()
	{
		parent::__construct();
		$this->load->helper(array('EUI_Object'));
		$this->load->model(array(base_class_model($this)));
	}
	
	function index()
	{
		$this->load->form('product_info/view_form_default',array(
			'param' => $this->URI->_get_all_request(),
			'result' => $this->{base_class_model($this)}->_get_data_form(_get_post('CustomerId'))
		));
	}
	
	function getPremi(){
		$premium = $this->{base_class_model($this)}->_select_personal_premi($this->URI->_get_all_request());
		echo json_encode($premium);
	}
	
	function SelectCalculateAge() 
	{
		$cond = array('Age' => 0);
		$out =new EUI_Object( _get_all_request() );
		if( !$out->fetch_ready() ){
			echo json_encode();
			return FALSE;
		}

		$Years = $this->SelectPurpouseAge( $out );
		if( !$Years ){
			// $cond = array('Age' => $Years);
			echo json_encode( $cond );
			return false;
		}else{
			// $cond = array('Age' => $Years );
			$cond = $Years;
		}

		echo json_encode($cond);	 
	}
	
	protected function SelectPurpouseAge( $out = null ){
		$years = 0;
		$arr_selector = _getDateDiff( date('Y-m-d'), $out->get_value('Date', '_getDateEnglish'));

		if( is_array( $arr_selector ) AND isset($arr_selector['months_total']) AND isset($arr_selector['months_total'])){
			// if( $out->get_value('GroupPremi') == 1 ){
				// print_r($arr_selector);
				$Month = (int)$arr_selector['months_total'];
				// echo "|".$years."|";
				$Day = (int)$arr_selector['days_total'];
				$years = $arr_selector['years'];
				if( $years == 0 ){
					if( $Month >=6 ){
						$float_value = ($Month/12);
						$years = number_format($float_value, 2);	
					}else{
						$years = 0;
					}
					
					return array(
						'Age' => $years,
						'years'  => $arr_selector['years'],
						'months' => $arr_selector['months'],
						'days' 	 => $arr_selector['days'],
					);
				}
				else{
					if( $arr_selector['months']>0 || $arr_selector['days']>0 )
					{
						$years+=1;
					}
					
					return array(
						'Age' => $years,
						'years'  => $arr_selector['years'],
						'months' => $arr_selector['months'],
						'days' 	 => $arr_selector['days'],
					);
				}

			return $years;

			// } else {
				// $Month = (int)$arr_selector['months_total'];
				// $Day = (int)$arr_selector['days_total'];
				// $years = $arr_selector['years'];
				// return (int)$years;
			// }
		}
		return $years;
	}
	
	function savePremi()
	{
		// print_r(_get_all_request());
		$cond = array('success' => 0 );

		$out =new EUI_Object(_get_all_request() );
		if( !$out->fetch_ready() OR !_get_is_login() ){
			echo json_encode( $cond );
			return false;
		}
		
		$obClass =& get_class_instance(base_class_model($this));
		if( $obClass->_set_row_save_premi( $out ) ){
			echo json_encode( array('success' => 1));
			return true;
		}
		 
		 echo json_encode( $cond );
	}
}
?>