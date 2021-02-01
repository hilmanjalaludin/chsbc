<?php
class ProductInfoSuplement extends EUI_Controller
{
	function ProductInfoSuplement()
	{
		parent::__construct();
		$this->load->helper(array('EUI_Object'));
		$this->load->model(array(base_class_model($this)));
	}
	
	function index()
	{		
		
		$this->load->form('product_info_suplement/view_form_default',array(
			'param'		=> $this->URI->_get_all_request(),
			'result'	=> $this->{base_class_model($this)}->_get_data_form(_get_post('CustomerId')),
			'loans'		=> $this->{base_class_model($this)}->_get_data_loans(_get_post('CustomerId')),
            'frm'		=> $this->{base_class_model($this)}->_get_data_inc_frm(_get_post('CustomerId')),
            
            'IdentificationType' => $this->{base_class_model($this)}->getIdentificationType(), 
            'salutation' => $this->{base_class_model($this)}->getSalutation(),
            'gender' => $this->{base_class_model($this)}->getGender(),
            'maritalStatus' => $this->{base_class_model($this)}->getMaritalStatus(),
            'occupation' => $this->{base_class_model($this)}->getOccupation(),
            'relationship' => $this->{base_class_model($this)}->getRelationship(),
            'country' => $this->{base_class_model($this)}->getCountry(),
            'area' => $this->{base_class_model($this)}->getArea(),
            
			'suplement_product'	=> $this->{base_class_model($this)}->_get_list_suplement_product(_get_post('CustomerId'))
			// 'ver_result'=> $this->{base_class_model($this)}->_get_ver_result(_get_post('CustomerId'))
		));
	}
	
	function getJenisJasa(){
		$JenisJasa = $this->{base_class_model($this)}->_get_list_suplement_jenis_jasa(_get_post('SuplementProduct'));
		if(is_array($JenisJasa)){
			echo form()->combo("JenisJasa", "select  tolong", $JenisJasa, null, array("change"=>"Ext.DOM.getPrefix(this.value)"));
		}
	}
	
	function getSuplementPrefix(){
		$Prefix = $this->{base_class_model($this)}->_get_list_suplement_prefix(_get_post('SuplementProduct'),_get_post('SuplementJenisJasa'));
		if(is_array($Prefix)){
			echo form()->combo("Prefix", "select  tolong", $Prefix, null, array());
		}
	}
	
	function getSuplementNopelLimiter(){
		$Prefix = $this->{base_class_model($this)}->_get_suplement_nopel_validity(_get_post('SuplementProduct'),_get_post('SuplementJenisJasa'),_get_post('SuplementPrefix'));
		if(is_array($Prefix)){
			// echo form()->combo("Prefix", "select  tolong", $Prefix, null, array("change"=>"Ext.DOM.setNopelValidity(this.value)"));
			echo json_encode($Prefix);
		}
	}
	
	function getVerificationStatus(){
		$verResult = $this->{base_class_model($this)}->_get_ver_result(_get_post('CustomerId'));
		// print_r($verResult);
		echo json_encode($verResult);
	}
	
	function deleteSuplement(){
		$verResult = $this->{base_class_model($this)}->_set_deleteSuplement(_get_post('CustomerId'),_get_post('billingid'));
		// print_r($verResult);
		echo json_encode($verResult);
	}

	function editSuplement($supId) {
		//  echo json_encode(value)
		$getById = $this->{base_class_model($this)}->getSuplementById(_get_post('supId'));
		echo json_encode($getById);

	}
	
	function reloadSuplement(){
		$frm = $this->{base_class_model($this)}->_get_data_inc_frm(_get_post('CustomerId'));
		
		$arr_header = array(
			"fullname"=> lang("fullname"),
			// "gender" => lang("gender"),
			// "mobilePhoneNo" => lang("mobilePhoneNo"),
			// "CustomerId"=> "Customer Id",
			// "Custno"=> lang("Cust Number"), 
			"Action"=> lang(" Action ")
		);
		$arr_class = array(
			"fullname"=> "content-middle",
			// "gender" => "content-middle",
			// "mobilePhoneNo" => "content-middle",
			// "CustomerId"=> "content-middle",
			// "Custno"=> "content-middle",
			"Action"=> "content-lasted"
		);
		
		echo	"<table border=0 cellspacing=1 width=\"100%\">".
				"<tr height=\"30\"> ".
				"<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>". lang("label_data_no") ."</th>";
				// "<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>#</th>";
		foreach( $arr_header as $field => $value ){
				echo "<th class=\"ui-corner-top ui-state-default th-lasted {$arr_align[$field]}\" width=\"{$arr_width[$field]}\"><span class=\"header_order\" title=\"Sort By {$value}\" onclick=\"Ext.DOM.CallHistory({page:0, orderby:'{$field}', type:'{$next_order}' });\">&nbsp;{$value}</span></th>";
		}
		echo "</tr>";

		$arr_num =1; $n = 0;
		if( is_array($frm) ){
			$no = 1;
			$tenor = 0;
			$checkedtenor = NULL;
			foreach( $frm as $num => $rows ){
				$row = new EUI_Object( $rows );
				$back_color = ( $num%2!=0 ? '#FFFFFF' :'#FFFEEE');
				
				echo	"<tr bgcolor=\"{$back_color}\" style=\"color:black\" class=\"onselect\" height=\"35\">".
						"<td class=\"content-first\" nowrap>{$no}</td>";
						// "<td class=\"content-first\" nowrap>".form()->radio( "key_bill", "content-first", $num, null, array("disabled"=>"disabled"))."</td>";
				foreach( array_keys($arr_header) as $k => $fields ){
					$numbers = $row->get_value($fields,$arr_function[$fields]);
					
					if(strtolower($fields) == 'action'){
						echo  "<td align='right' id=\"".$fields."\" class=\"".$arr_class[$fields]." ui-widget-unselect-order ".$arr_align[$fields]."\" ".$arr_wrap[$fields].">
							<button type='button' value='".$num."' onclick='Ext.DOM.deleteSup(this.value)'>Delete</button><button type='button' value='".$num."' onclick='Ext.DOM.editSup(this.value)'>Edit</button></td>";
					}else{
						echo  "<td align='right' id=\"".$fields."\" class=\"".$arr_class[$fields]." ui-widget-unselect-order ".$arr_align[$fields]."\" ".$arr_wrap[$fields].">".$numbers."</td>";
					}
				}
				echo "</tr>";
				$no++;
			}
		}
		echo "</table>";
	}
	
	
	/* OLD QUARY */ 
	function getLoanPerVariable(){
		$loans = $this->{base_class_model($this)}->_get_data_loans(_get_post('CustomerId'));
		$loansvar = _get_post('loansvar');
		
		$arr_header = array(
			"Tenor"=> lang("Tenor"),
			"LoanAmount" => lang("Loan Amount"),
			"Installment" => lang("Monthly Installment"),
			"Rate"=> "Rate",
			"AdminFee"=> lang("Admin Fee"),
			"DisburseAmount"=> lang("Disburse Amount")
		);
		$arr_class = array(
			"Tenor"=> "content-middle",
			"LoanAmount" => "content-middle",
			"Installment" => "content-middle",
			"Rate"=> "content-middle",
			"AdminFee"=> "content-middle",
			"DisburseAmount"=> "content-lasted"
		);
		
		echo	"<table border=0 cellspacing=0 width=\"100%\">".
				"<tr height=\"30\"> ".
				"<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>". lang("label_data_no") ."</th>".
				"<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>#</th>";
		foreach( $arr_header as $field => $value ){
				echo "<th class=\"ui-corner-top ui-state-default th-lasted {$arr_align[$field]}\" width=\"{$arr_width[$field]}\"><span class=\"header_order\" title=\"Sort By {$value}\" onclick=\"Ext.DOM.CallHistory({page:0, orderby:'{$field}', type:'{$next_order}' });\">&nbsp;{$value}</span></th>";
		}
		echo "</tr>";

		$arr_num =1; $n = 0;
		if( is_array($loans) ){
			$no = 1;
			$tenor = 0;
			foreach( $loans as $num => $rows ){
				$row = new EUI_Object( $rows );
				$tenor = $row->get_value('Tenor',$arr_function['Tenor']);
				$back_color = ( $num%2!=0 ? '#FFFFFF' :'#FFFEEE');
				echo	"<tr bgcolor=\"{$back_color}\" class=\"onselect\" height=\"35\">".
						"<td class=\"content-first\" nowrap>{$no}</td>".
						"<td class=\"content-first\" nowrap>".form()->radio( "key_tenor", "content-first", $tenor)."</td>";
				if($loansvar!="" OR $loansvar!=NULL){
					foreach( array_keys($arr_header) as $k => $fields ){
						if(strtolower($fields) == 'tenor'){
							$long = $row->get_value($fields,$arr_function[$fields]);
						}else{
							if(strtolower($fields) == 'rate'){
								$rate = $row->get_value($fields,$arr_function[$fields]) * 100;
								$long = (number_format($rate, 2, '.',''))."%";
							}else{
								$numbers = $row->get_value($fields,$arr_function[$fields]);
								$loan = ($numbers * $loansvar)/100;
								$long = number_format($loan, 0, '.', ',');
							}
						}
						echo  "<td align='right' id=\"".$fields."_".$tenor."\" class=\"".$arr_class[$fields]." ui-widget-unselect-order ".$arr_align[$fields]."\" ".$arr_wrap[$fields].">".$long."</td>";
					}
				}else{
					foreach( array_keys($arr_header) as $k => $fields ){
						if(strtolower($fields) == 'tenor'){
							$numbers = $row->get_value($fields,$arr_function[$fields]);
						}else{
							$numbers = number_format($row->get_value($fields,$arr_function[$fields]), 0, '.', ',');
						}
						echo  "<td align='right' id=\"".$fields."_".$tenor."\" class=\"".$arr_class[$fields]." ui-widget-unselect-order ".$arr_align[$fields]."\" ".$arr_wrap[$fields].">".$numbers."</td>";
					}
				}
				echo "</tr>";
				$no++;
			}
		}
		echo "</table>";
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
	
	function savePremi(){
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
	
	function saveProductSuplement(){
      
        // $dataPost = array (
        //     'identificationType' => _get_post('identificationType'),
        //     'NoIdentificationType' => _get_post('NoIdentificationType'),
        //     'salutation' => _get_post('salutation'),
        //     'namaDepan' => _get_post('namaDepan'),
        //     'namaTengah' => _get_post('namaTengah'),
        //     'namaBelakang' => _get_post('namaBelakang'),
        //     'fullname' => _get_post('fullname'),
        //     'nameOnCard' => _get_post('nameOnCard'),
        //     'formerName' => _get_post('formerName'),
        //     'gender' => _get_post('gender'),
        //     'pob' => _get_post('pob'),
        //     'dob' => _get_post('dob'),
        //     'maritalStatus' => _get_post('maritalStatus'),
        //     'mmn' => _get_post('mmn'),
        //     'occupation' => _get_post('occupation'),
        //     'addressSuplement' => _get_post('addressSuplement'),
        //     'relationship' => _get_post('relationship'),
        //     'nationality' => _get_post('nationality'),
        //     'cob' => _get_post('cob'),
        //     'idPlaceIssued' => _get_post('idPlaceIssued'),
        //     'idDateIssued' => _get_post('idDateIssued'),
        //     'idExpiredDate' => _get_post('idExpiredDate'),
        //     'mobilePhoneNo' => _get_post('mobilePhoneNo'),
        //     'residentPhone' => _get_post('residentPhone'),
        //     'email' => _get_post('email'),
        //     'residentArea' => _get_post('residentArea'),
        //     'CustomerId' => _get_post('CustomerId'),
        //     'CUSTNO1' => _get_post('CUSTNO1'),
        //     'Accno' => _get_post('Accno'),
        //     'cardno' => _get_post('cardno'),
        // );

		
		$cond  =array('success' => 0);
		$data =new EUI_Object(_get_all_request() );
		if( !$data->fetch_ready() OR !_get_is_login() ){
			echo json_encode( $cond );
			return false;
		}
		// echo "test";
        $obClass =& get_class_instance(base_class_model($this));
		// var_dump(  $data );
		// die;
		if( $obClass->_set_row_save_suplement( $data ) ){
			echo json_encode( array('success' => 1));
			return true;
		}
		 
		 echo json_encode( $cond );
	}
	function editProductSuplement(){
		
		$cond  =array('success' => 0);
		$data =new EUI_Object(_get_all_request() );
		if( !$data->fetch_ready() OR !_get_is_login() ){
			echo json_encode( $cond );
			return false;
		}
		// echo "test";
        $obClass =& get_class_instance(base_class_model($this));
		// var_dump(  $data );
		// die;
		if( $obClass->_set_row_edit_suplement( $data ) ){
			echo json_encode( array('success' => 1));
			return true;
		}
		 
		 echo json_encode( $cond );
	}

	function validasi(){
		$cond  =array('success' => 0);
		$data =new EUI_Object(_get_all_request() );
		if( !$data->fetch_ready() OR !_get_is_login() ){
			echo json_encode( $cond );
			return false;
		}
		// echo "test";
        $obClass =& get_class_instance(base_class_model($this));
		// var_dump(  $data );
		// die;
		if( $obClass->_set_row_validasi_suplement( $data ) ){
			echo json_encode( array('success' => 1));
			return true;
		}
		 
		 echo json_encode( $cond );
	}
}
?>