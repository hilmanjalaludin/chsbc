<?php
class M_VerifikasiA2 extends EUI_Model
{
	var $_set_a = array();
	var $_set_b = array();
	var $_set_c = array();
	
	function M_VerifikasiA2()
	{
		$this->_set_a = array('cust_dob');
		$this->_set_b = array('card_number','credit_limit','due_date','card_exp','phone_number');
		$this->_set_c = array('flag_supplement','bill_address');
	}
	
	function _get_value_verification($_cust_id)
	{
		$_datas = array();
		
		$sql = "SELECT 
					a.CustomerDOB,
					a.CustomerHomePhoneNum,
					a.CustomerMobilePhoneNum,
					a.CustomerWorkPhoneNum,
					a.card_no,
					a.credit_limit,
					a.due_date,
					a.card_exp,
					a.flag_suplement,
					a.billing_address,
					a.cycle_due_date,
					a.pil_acc_no,
					a.CampaignId,
					a.monthly_installment,
					fx.AddressVerif
				FROM t_gn_customer a
				left join t_gn_frm_flexi fx on a.CustomerId=fx.CustomerId
				WHERE a.CustomerId = '".$_cust_id."'";
		// echo $sql;
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			$_datas = $qry->result_first_assoc();
		}
		
		return $_datas;
	}
	
	Public Function _get_inputAddress()
		{
			return array(
							1 => 'YES',
							2 => 'NO'
						);
		}
	
	function _get_alamatVerif($_cust_id)
	{
		$_datas = array();
		
		$sql = "select concat(
			fx.CustomerAddressLine1,' ',
			fx.CustomerAddressLine2,' ',
			fx.CustomerAddressLine3,' ',
			fx.CustomerAddressLine4) as alamat
		from t_gn_attr_flexi fx where fx.CustomerId = '".$_cust_id."'";
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			$_datas = $qry->result_first_assoc();
		}
		
		return $_datas;
	}
	
	function _get_result_verification($_cust_id)
	{
		$_datas = array();
		
		/* $sql = "SELECT * FROM t_gn_ver_result a
				WHERE a.cust_id = '".$_cust_id."'
				AND a.ver_date = '".date('Y-m-d')."'"; */
		$sql = "SELECT * FROM t_gn_ver_result a
				WHERE a.cust_id = '".$_cust_id."'";
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			$_datas = $qry->result_first_assoc();
		}
		
		return $_datas;
	}
	
	function _get_input_verification($_cust_id)
	{
		$_datas = array();
		
		/* $sql = "SELECT * FROM t_gn_ver_activity a
				WHERE a.cust_id = '".$_cust_id."'
				AND a.ver_date = '".date('Y-m-d')."'"; */
			$sql = "SELECT * FROM t_gn_ver_activity a
				WHERE a.cust_id = '".$_cust_id."'";
				
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				$_datas[$rows['ver_form']] = $rows;
			}
		}
		
		return $_datas;
	}
	
	function _get_res_activity($cust_id,$ver_date)
	{
		$_temp = array();
		
		$sql = "select 
					a.ver_set,
					a.ver_status,
					count(a.id) as ver_total
				from t_gn_ver_activity a
				where 1=1
				and a.cust_id = '".$cust_id."'
				group by a.ver_set, a.ver_status";
		$qry = $this->db->query($sql);
		// var_dump($this->db->last_query());
		
		if($qry->num_rows()>0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				$_temp[$rows['ver_set']][$rows['ver_status']] = $rows['ver_total'];
			}
		}
		
		return $_temp;
	}
	
	function _set_ver_result($cust_id,$ver_date)
	{
		$_temp = $this->_get_res_activity($cust_id,$ver_date);
		$_res = 0;
				
		/* JIKA VERIFIKASI DOB GAGAL */
		if( isset($_temp['A'][2]) && $_temp['A'][2]>0 )
		{
			$_res = 2;
		}
		else{
			/* JIKA VERIFIKASI DOB BERHASIL */
			if( isset($_temp['A'][1]) && $_temp['A'][1]>0 )
			{
				/* JIKA VERIFIKASI SET B, 2 BERHASIL */
				if( isset($_temp['B'][1]) && $_temp['B'][1]>1 )
				{
					$_res = 1;
				}
				/* JIKA VERIFIKASI SET B, 1 BERHASIL && JIKA VERIFIKASI SET C, 1 BERHASIL */
				elseif( (isset($_temp['B'][1]) && $_temp['B'][1]>0) && (isset($_temp['C'][1]) && $_temp['C'][1]>0) )
				{
					$_res = 1;
				}
			}
		}
		
		if($_res>0)
		{
			$this->db->insert('t_gn_ver_result',array(
				'cust_id' 	 => $cust_id,
				// 'ver_date' 	 => $ver_date,
				'ver_result' => $_res,
				'create_by'  => $this->EUI_Session->_get_session('UserId')
			));
		}
	}
	
	function _save_activity($param)
	{
		$_id = $param['InputId'];
		$_pass = 0;
		$_sett = null;
		$_tmax = $param['c_'.$_id];
		$_cout = $param['a_'.$_id]+1;
		
		if( $param['o_'.$_id]==$param['i_'.$_id] )
		{
			$_pass = 1;
		}
		else{
			if($_cout<$_tmax)
			{
				$_pass = 0;
			}
			else{
				$_pass = 2;
			}
		}
		
		if(in_array($_id,$this->_set_a))
		{
			$_sett = 'A';
		}
		
		if(in_array($_id,$this->_set_b))
		{
			$_sett = 'B';
		}
		
		if(in_array($_id,$this->_set_c))
		{
			$_sett = 'C';
		}
		
		$this->db->insert('t_gn_ver_activity',array(
			'cust_id' 		=> $param['CustomerId'],
			// 'ver_date' 		=> date('Y-m-d'),
			'ver_form' 		=> $_id,
			'ver_value' 	=> $param['o_'.$_id],
			'ver_input' 	=> $param['i_'.$_id],
			'ver_attempt' 	=> $_cout,
			'ver_status' 	=> $_pass,
			'ver_set' 		=> $_sett,
			'create_date' 	=> date('Y-m-d H:i:s'),
			'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
		));
		
		if($this->db->affected_rows()>0)
		{
			$this->db->insert('t_gn_ver_activity_log',array(
				'cust_id' 		=> $param['CustomerId'],
				// 'ver_date' 		=> date('Y-m-d'),
				'ver_form' 		=> $_id,
				'ver_value' 	=> $param['o_'.$_id],
				'ver_input' 	=> $param['i_'.$_id],
				'ver_attempt' 	=> $_cout,
				'ver_status' 	=> $_pass,
				'ver_set' 		=> $_sett,
				'create_date' 	=> date('Y-m-d H:i:s'),
				'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
			));
		}
		else{
			$this->db->update('t_gn_ver_activity',array(
				'ver_value' 	=> $param['o_'.$_id],
				'ver_input' 	=> $param['i_'.$_id],
				'ver_attempt' 	=> $_cout,
				'ver_status' 	=> $_pass,
				'ver_set' 		=> $_sett,
				'create_date' 	=> date('Y-m-d H:i:s'),
				'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
			),array(
				'cust_id' 		=> $param['CustomerId'],
				// 'ver_date' 		=> date('Y-m-d'),
				'ver_form' 		=> $_id,
			));
			
			if($this->db->affected_rows()>0)
			{
				$this->db->insert('t_gn_ver_activity_log',array(
					'cust_id' 		=> $param['CustomerId'],
					// 'ver_date' 		=> date('Y-m-d'),
					'ver_form' 		=> $_id,
					'ver_value' 	=> $param['o_'.$_id],
					'ver_input' 	=> $param['i_'.$_id],
					'ver_attempt' 	=> $_cout,
					'ver_status' 	=> $_pass,
					'ver_set' 		=> $_sett,
					'create_date' 	=> date('Y-m-d H:i:s'),
					'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
				));
			}
		}
		
		$this->_set_ver_result($param['CustomerId'],date('Y-m-d'));
	}
	
	function _save_ver_phone($param)
	{
		$_phone = array();
		$_id   = $param['InputId'];
		$_pass = 0;
		$_sett = 'B';
		$_tmax = $param['c_'.$_id];
		$_cout = $param['a_'.$_id]+1;
		
		$_phonex = array(
			trim($param['o_'.$_id.'_1']),
			trim($param['o_'.$_id.'_2']),
			trim($param['o_'.$_id.'_3']),
		);
		
		foreach($_phonex as $key => $value)
		{
			if( strlen($value)>4 )
			{
				$_phone[$key] = $value;
			}
		}
		
		if( in_array($param['i_'.$_id],$_phone) )
		{
			$_pass = 1;
		}
		else{
			if($_cout<$_tmax)
			{
				$_pass = 0;
			}
			else{
				$_pass = 2;
			}
		}
		
		$this->db->insert('t_gn_ver_activity',array(
			'cust_id' 		=> $param['CustomerId'],
			// 'ver_date' 		=> date('Y-m-d'),
			'ver_form' 		=> $_id,
			'ver_value' 	=> implode(',',$_phone),
			'ver_input' 	=> $param['i_'.$_id],
			'ver_attempt' 	=> $_cout,
			'ver_status' 	=> $_pass,
			'ver_set' 		=> $_sett,
			'create_date' 	=> date('Y-m-d H:i:s'),
			'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
		));
		
		if($this->db->affected_rows()>0)
		{
			$this->db->insert('t_gn_ver_activity_log',array(
				'cust_id' 		=> $param['CustomerId'],
				// 'ver_date' 		=> date('Y-m-d'),
				'ver_form' 		=> $_id,
				'ver_value' 	=> implode(',',$_phone),
				'ver_input' 	=> $param['i_'.$_id],
				'ver_attempt' 	=> $_cout,
				'ver_status' 	=> $_pass,
				'ver_set' 		=> $_sett,
				'create_date' 	=> date('Y-m-d H:i:s'),
				'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
			));
		}
		else{
			$this->db->update('t_gn_ver_activity',array(
				'ver_value' 	=> implode(',',$_phone),
				'ver_input' 	=> $param['i_'.$_id],
				'ver_attempt' 	=> $_cout,
				'ver_status' 	=> $_pass,
				'ver_set' 		=> $_sett,
				'create_date' 	=> date('Y-m-d H:i:s'),
				'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
			),array(
				'cust_id' 		=> $param['CustomerId'],
				// 'ver_date' 		=> date('Y-m-d'),
				'ver_form' 		=> $_id,
			));
			
			if($this->db->affected_rows()>0)
			{
				$this->db->insert('t_gn_ver_activity_log',array(
					'cust_id' 		=> $param['CustomerId'],
					// 'ver_date' 		=> date('Y-m-d'),
					'ver_form' 		=> $_id,
					'ver_value' 	=> implode(',',$_phone),
					'ver_input' 	=> $param['i_'.$_id],
					'ver_attempt' 	=> $_cout,
					'ver_status' 	=> $_pass,
					'ver_set' 		=> $_sett,
					'create_date' 	=> date('Y-m-d H:i:s'),
					'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
				));
			}
		}
		
		$this->_set_ver_result($param['CustomerId'],date('Y-m-d'));
	}
	
	function _save_ver_crlimit($param)
	{
		$_id   = $param['InputId'];
		$_pass = 0;
		$_sett = 'B';
		$_tmax = $param['c_'.$_id];
		$_cout = $param['a_'.$_id]+1;
		
		$_credit = $param['o_'.$_id];
		$_persen = 10;
		$_amount = (is_numeric($_credit)?($_credit/100)*$_persen:0);
		$_minima = (is_numeric($_credit)?($_credit-$_amount):0);
		$_maxima = (is_numeric($_credit)?($_credit+$_amount):0);
		
		if( ($param['i_'.$_id]>=$_minima) && ($param['i_'.$_id]<=$_maxima) )
		{
			$_pass = 1;
		}
		else{
			if($_cout<$_tmax)
			{
				$_pass = 0;
			}
			else{
				$_pass = 2;
			}
		}
		
		
		$this->db->insert('t_gn_ver_activity',array(
			'cust_id' 		=> $param['CustomerId'],
			// 'ver_date' 		=> date('Y-m-d'),
			'ver_form' 		=> $_id,
			'ver_value' 	=> $_minima.' - '.$_maxima,
			'ver_input' 	=> $param['i_'.$_id],
			'ver_attempt' 	=> $_cout,
			'ver_status' 	=> $_pass,
			'ver_set' 		=> $_sett,
			'create_date' 	=> date('Y-m-d H:i:s'),
			'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
		));
		
		if($this->db->affected_rows()>0)
		{
			$this->db->insert('t_gn_ver_activity_log',array(
				'cust_id' 		=> $param['CustomerId'],
				// 'ver_date' 		=> date('Y-m-d'),
				'ver_form' 		=> $_id,
				'ver_value' 	=> $_minima.' - '.$_maxima,
				'ver_input' 	=> $param['i_'.$_id],
				'ver_attempt' 	=> $_cout,
				'ver_status' 	=> $_pass,
				'ver_set' 		=> $_sett,
				'create_date' 	=> date('Y-m-d H:i:s'),
				'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
			));
		}
		else{
			$this->db->update('t_gn_ver_activity',array(
				'ver_value' 	=> $_minima.' - '.$_maxima,
				'ver_input' 	=> $param['i_'.$_id],
				'ver_attempt' 	=> $_cout,
				'ver_status' 	=> $_pass,
				'ver_set' 		=> $_sett,
				'create_date' 	=> date('Y-m-d H:i:s'),
				'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
			),array(
				'cust_id' 		=> $param['CustomerId'],
				// 'ver_date' 		=> date('Y-m-d'),
				'ver_form' 		=> $_id,
			));
			
			if($this->db->affected_rows()>0)
			{
				$this->db->insert('t_gn_ver_activity_log',array(
					'cust_id' 		=> $param['CustomerId'],
					// 'ver_date' 		=> date('Y-m-d'),
					'ver_form' 		=> $_id,
					'ver_value' 	=> $_minima.' - '.$_maxima,
					'ver_input' 	=> $param['i_'.$_id],
					'ver_attempt' 	=> $_cout,
					'ver_status' 	=> $_pass,
					'ver_set' 		=> $_sett,
					'create_date' 	=> date('Y-m-d H:i:s'),
					'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
				));
			}
		}
		
		$this->_set_ver_result($param['CustomerId'],date('Y-m-d'));
	}
	
	function _save_ver_duedate($param)
	{
		$_id   = $param['InputId'];
		$_pass = 0;
		$_sett = 'B';
		$_tmax = $param['c_'.$_id];
		$_cout = $param['a_'.$_id]+1;
		
		$_limit = 2;
		$_dates = array(
			date('d',strtotime($param['o_'.$_id]))
		);
		
		$_besok = $param['o_'.$_id];
		$_maren = $param['o_'.$_id];
		
		for($b=0;$b<$_limit;$b++)
		{
			$_besok = _getNextDate($_besok);
			$_maren = _getPrevDate($_maren .' -1 day');
			$_dates[] = date('d',strtotime($_besok));
			$_dates[] = date('d',strtotime($_maren));
		}
		
		asort($_dates,SORT_NUMERIC);
		
		if( in_array($param['i_'.$_id],$_dates) )
		{
			$_pass = 1;
		}
		else{
			if($_cout<$_tmax)
			{
				$_pass = 0;
			}
			else{
				$_pass = 2;
			}
		}
		
		$this->db->insert('t_gn_ver_activity',array(
			'cust_id' 		=> $param['CustomerId'],
			// 'ver_date' 		=> date('Y-m-d'),
			'ver_form' 		=> $_id,
			'ver_value' 	=> implode(',',$_dates),
			'ver_input' 	=> $param['i_'.$_id],
			'ver_attempt' 	=> $_cout,
			'ver_status' 	=> $_pass,
			'ver_set' 		=> $_sett,
			'create_date' 	=> date('Y-m-d H:i:s'),
			'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
		));
		
		if($this->db->affected_rows()>0)
		{
			$this->db->insert('t_gn_ver_activity_log',array(
				'cust_id' 		=> $param['CustomerId'],
				// 'ver_date' 		=> date('Y-m-d'),
				'ver_form' 		=> $_id,
				'ver_value' 	=> implode(',',$_dates),
				'ver_input' 	=> $param['i_'.$_id],
				'ver_attempt' 	=> $_cout,
				'ver_status' 	=> $_pass,
				'ver_set' 		=> $_sett,
				'create_date' 	=> date('Y-m-d H:i:s'),
				'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
			));
		}
		else{
			$this->db->update('t_gn_ver_activity',array(
				'ver_value' 	=> implode(',',$_dates),
				'ver_input' 	=> $param['i_'.$_id],
				'ver_attempt' 	=> $_cout,
				'ver_status' 	=> $_pass,
				'ver_set' 		=> $_sett,
				'create_date' 	=> date('Y-m-d H:i:s'),
				'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
			),array(
				'cust_id' 		=> $param['CustomerId'],
				// 'ver_date' 		=> date('Y-m-d'),
				'ver_form' 		=> $_id,
			));
			
			if($this->db->affected_rows()>0)
			{
				$this->db->insert('t_gn_ver_activity_log',array(
					'cust_id' 		=> $param['CustomerId'],
					// 'ver_date' 		=> date('Y-m-d'),
					'ver_form' 		=> $_id,
					'ver_value' 	=> implode(',',$_dates),
					'ver_input' 	=> $param['i_'.$_id],
					'ver_attempt' 	=> $_cout,
					'ver_status' 	=> $_pass,
					'ver_set' 		=> $_sett,
					'create_date' 	=> date('Y-m-d H:i:s'),
					'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
				));
			}
		}
		
		$this->_set_ver_result($param['CustomerId'],date('Y-m-d'));
	}


	//tambahan irul

	function _get_customer($id) {
		$sql = "SELECT * FROM t_gn_customer a WHERE a.CustomerId='$id'";
		$row = $this->db->query($sql);

		return $row->result();
	}

	function _get_ver_attempt($id, $ver_form) {
		$sql = "SELECT TOP 1 * FROM t_gn_ver_activity a WHERE a.cust_id='$id' AND a.ver_form='$ver_form' ORDER BY a.id DESC";
		$qry = $this->db->query($sql);
		$row = $qry->result();
		// var_dump($this->db->last_query());
		$return = 1;
		if ($qry->num_rows()>0) {
			$return = $row[0]->ver_attempt+1;
		}
		return $return;
	}

	function _get_ver($id, $ver_form) {
		$sql = "SELECT TOP 1 * FROM t_gn_ver_activity a WHERE a.cust_id='$id' AND a.ver_form='$ver_form' ORDER BY a.id DESC";
		$qry = $this->db->query($sql);
		$row = $qry->result();
		return $row[0];
	}

	function _get_ver_count($id, $status = 0) {
		// $sql = "SELECT count(a.var_attempt) FROM t_gn_ver_activity a WHERE a.cust_id='$id' AND ver_status=0 ORDER BY a.id DESC";
		$sql = "SELECT count(a.id) as count FROM t_gn_ver_activity a WHERE a.cust_id='$id' AND ver_status=$status";
		$qry = $this->db->query($sql);
		$row = $qry->result();
		return $row[0];
	}

	public function _get_checkdata($id)
	{
		# code...
		$sql="SELECT a.CustomerId,a.flag_suplement,a.count_of_supplement,a.credit_limit,a.card_exp,a.CustomerHomePhoneNum,a.CustomerWorkPhoneNum FROM t_gn_customer a
		WHERE a.CustomerId='$id'";
		$qry = $this->db->query($sql);
		$row = $qry->row();
		return $row;
	}
	
	function _save_ver_activity($param, $type) {
		$rowCustomer = $this->_get_customer($param['CustomerId']);
		$rowVer = $this->_get_ver_attempt($param['CustomerId'], $param['InputId']);
		#var_dump($type);die();
		// var_dump('rowver', $rowVer);die();
		// var_dump($rowCustomer[0]->count_of_supplement);die();
		$countSups = NULL;
		if($rowCustomer[0]->count_of_supplement=="" OR $rowCustomer[0]->count_of_supplement==NULL){
			$countSups = "0";
		}else{
			$countSups = $rowCustomer[0]->count_of_supplement;
		}

		$_id = $param['InputId'];
		$_pass = 0;
		$_sett = 'A';
		if ($type == 'ask_1') {
			$_value = $rowCustomer[0]->flag_suplement.'|'.$countSups;
			$_input = $param['additional_cc_2nd'].'|'.$param['total_additional_cc_2nd'];
		} else if ($type == 'ask_1_1') {
			$_value = $rowCustomer[0]->count_of_supplement;
			$_input = $param['total_additional_cc_2nd'];
		} else if ($type == 'ask_2') {
			$_value = $rowCustomer[0]->credit_limit;
			$_devisasi=(10/100) * $_value;
			$_val_plus_10=$_value+$_devisasi;
			$_val_min_10=$_value-$_devisasi;
			$_input = str_replace(".","",$param['limit_cc_2nd']);
		} else if ($type == 'ask_3') {
			$_value = $rowCustomer[0]->card_exp;
			$_input = $param['expiry_date_2nd'];
		} else if ($type == 'ask_4') {
			// $_value = $rowCustomer[0]->CustomerHomePhoneNum == '' ? $rowCustomer[0]->CustomerWorkPhoneNum : $rowCustomer[0]->CustomerHomePhoneNum;
			// $_input = $param['no_telp_2nd'];
			// $homeNumberCut = substr($rowCustomer[0]->CustomerHomePhoneNum,3);
			// $workNumberCut = substr($rowCustomer[0]->CustomerWorkPhoneNum,3);
			// $homeNumber = substr($rowCustomer[0]->CustomerHomePhoneNum,0,3);
			// $workNumber = substr($rowCustomer[0]->CustomerWorkPhoneNum,0,3);
			// if ($homeNumber == '021' OR $workNumber == '021') {
			// 	$val = $homeNumberCut.'|'.$workNumberCut;
			// } else {
			// 	$val = $rowCustomer[0]->CustomerHomePhoneNum.'|'.$rowCustomer[0]->CustomerWorkPhoneNum;
			// }
			// $inp = $param['no_telp_2nd'];
			
			// if ($homeNumberCut == $param['no_telp_2nd']) {
			// 	$val = 'Home|'.$homeNumberCut;
			// 	$inp = 'Home|'.$param['no_telp_2nd'];
			// }

			// if ($workNumberCut == $param['no_telp_2nd']) {
			// 	$val = 'Work|'.$workNumberCut;
			// 	$inp = 'Work|'.$param['no_telp_2nd'];
			// }

			$homeNumberCut = substr($rowCustomer[0]->CustomerHomePhoneNum,3);
			$workNumberCut = substr($rowCustomer[0]->CustomerWorkPhoneNum,3);
			$homeNumber = substr($rowCustomer[0]->CustomerHomePhoneNum,0,3);
			$workNumber = substr($rowCustomer[0]->CustomerWorkPhoneNum,0,3);
			if ($homeNumber == '021' OR $workNumber == '021') {
				if ($homeNumberCut == $param['no_telp_2nd']) {
					$val = 'Home|'.$homeNumberCut;
					$inp = 'Home|'.$param['no_telp_2nd'];
				}
	
				if ($workNumberCut == $param['no_telp_2nd']) {
					$val = 'Work|'.$workNumberCut;
					$inp = 'Work|'.$param['no_telp_2nd'];
				}
				// $val = $homeNumberCut.'|'.$workNumberCut;
			} else {
				if ($rowCustomer[0]->CustomerHomePhoneNum == $param['no_telp_2nd']) {
					$val = 'Home|'.$rowCustomer[0]->CustomerHomePhoneNum;
					$inp = 'Home|'.$param['no_telp_2nd'];
				}
	
				if ($rowCustomer[0]->CustomerWorkPhoneNum == $param['no_telp_2nd']) {
					$val = 'Work|'.$rowCustomer[0]->CustomerWorkPhoneNum;
					$inp = 'Work|'.$param['no_telp_2nd'];
				}
				// $val = $rowCustomer[0]->CustomerHomePhoneNum.'|'.$rowCustomer[0]->CustomerWorkPhoneNum;
			}

			$_value = $val;
			$_input = $inp;
		} else if ($type == 'ask_5') {
			$_value = $rowCustomer[0]->count_of_primary_card;
			$_input = $param['total_jenis_cc_2nd'];
		} else if ($type == 'ask_5') {
			$_val = 0;
			$_var = 0;
			if ($rowCustomer[0]->classic_card == 1) {
				$_val = 1;
			} else if ($rowCustomer[0]->gold_card == 1) {
				$_val = 1;
			} else if ($rowCustomer[0]->cashback_card == 1) {
				$_val = 1;
			} else if ($rowCustomer[0]->platinum_card == 1) {
				$_val = 1;
			} else if ($rowCustomer[0]->signature_card == 1) {
				$_val= 1;
			} else if ($rowCustomer[0]->premier_card == 1) {
				$_val= 1;
			}

			if ($param['jenis_cc_2nd'] == 1) {
				$_var = 1;
			} else if ($param['jenis_cc_2nd'] == 2) {
				$_var = 1;
			} else if ($param['jenis_cc_2nd'] == 3) {
				$_var = 1;
			} else if ($param['jenis_cc_2nd'] == 4) {
				$_var = 1;
			} else if ($param['jenis_cc_2nd'] == 5) {
				$_var = 1;
			} else if ($param['jenis_cc_2nd'] == 6) {
				$_var = 1;
			}
			$_value = $_val;
			$_input = $_var;
		} else if ($type == 'ask_7') {
			$_value = $rowCustomer[0]->due_date;
			$_input = date('Y-m-d', strtotime($param['jatuh_tempo_2nd']));
		}
		$_attempt = $rowVer;

		

		if($type == 'ask_2'){
			if ($_input == $_value ||
				($_input <= $_val_plus_10 && $_input >= $_value) ||
				($_input >= $_val_min_10 && $_input <= $_value)) {
				$_pass = 1;
			}	
		}else{
			if ($_input == $_value) {
				$_pass = 1;
			}
		}
		
		$this->db->insert('t_gn_ver_activity',array(
			'cust_id' 		=> $param['CustomerId'],
			// 'ver_date' 		=> date('Y-m-d'),
			'ver_form' 		=> $_id,
			'ver_value' 	=> $_value,
			'ver_input' 	=> $_input,
			'ver_attempt' 	=> $_attempt,
			'ver_status' 	=> $_pass,
			'ver_set' 		=> $_sett,
			'create_date' 	=> date('Y-m-d H:i:s'),
			'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
		));
		// var_dump($this->db->last_query());die();
		
		if($this->db->affected_rows()>0)
		{
			$this->db->insert('t_gn_ver_activity_log',array(
				'cust_id' 		=> $param['CustomerId'],
				// 'ver_date' 		=> date('Y-m-d'),
				'ver_form' 		=> $_id,
				'ver_value' 	=> $_value,
				'ver_input' 	=> $_input,
				'ver_attempt' 	=> $_attempt,
				'ver_status' 	=> $_pass,
				'ver_set' 		=> $_sett,
				'create_date' 	=> date('Y-m-d H:i:s'),
				'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
			));
		}
		else{
			$this->db->update('t_gn_ver_activity',array(
				'ver_value' 	=> $_value,
				'ver_input' 	=> $_input,
				'ver_attempt' 	=> $_attempt,
				'ver_status' 	=> $_pass,
				'ver_set' 		=> $_sett,
				'create_date' 	=> date('Y-m-d H:i:s'),
				'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
			),array(
				'cust_id' 		=> $param['CustomerId'],
				// 'ver_date' 		=> date('Y-m-d'),
				'ver_form' 		=> $_id,
			));
			
			if($this->db->affected_rows()>0)
			{
				$this->db->insert('t_gn_ver_activity_log',array(
					'cust_id' 		=> $param['CustomerId'],
					// 'ver_date' 		=> date('Y-m-d'),
					'ver_form' 		=> $_id,
					'ver_value' 	=> $_value,
					'ver_input' 	=> $_input,
					'ver_attempt' 	=> $_attempt,
					'ver_status' 	=> $_pass,
					'ver_set' 		=> $_sett,
					'create_date' 	=> date('Y-m-d H:i:s'),
					'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
				));
			}
		}
		
		// $this->_get_ver($param['CustomerId'], $param['InputId']);
	}

	function _save_ask_1_2nd($param, $type) {
		$rowCustomer = $this->_get_customer($param['CustomerId']);
		$rowVer = $this->_get_ver_attempt($param['CustomerId'], $param['InputId']);
		// var_dump('rowver', $rowVer);die();
		// var_dump($rowCustomer[0]->count_of_supplement);die();

		$_id = $param['InputId'];
		$_pass = 0;
		$_sett = 'A';

		$_value = $rowCustomer[0]->flag_suplement.'|'.$rowCustomer[0]->count_of_supplement;
		$_input = $param['additional_cc_2nd'].'|'.$param['total_additional_cc_2nd'];

		$_attempt = $rowVer;

		if ($_input == $_value) {
			$_pass = 1;
		}
		
		$this->db->insert('t_gn_ver_activity',array(
			'cust_id' 		=> $param['CustomerId'],
			// 'ver_date' 		=> date('Y-m-d'),
			'ver_form' 		=> $_id,
			'ver_value' 	=> $_value,
			'ver_input' 	=> $_input,
			'ver_attempt' 	=> $_attempt,
			'ver_status' 	=> $_pass,
			'ver_set' 		=> $_sett,
			'create_date' 	=> date('Y-m-d H:i:s'),
			'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
		));
		
		if($this->db->affected_rows()>0)
		{
			$this->db->insert('t_gn_ver_activity_log',array(
				'cust_id' 		=> $param['CustomerId'],
				// 'ver_date' 		=> date('Y-m-d'),
				'ver_form' 		=> $_id,
				'ver_value' 	=> $_value,
				'ver_input' 	=> $_input,
				'ver_attempt' 	=> $_attempt,
				'ver_status' 	=> $_pass,
				'ver_set' 		=> $_sett,
				'create_date' 	=> date('Y-m-d H:i:s'),
				'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
			));
		}
		else{
			$this->db->update('t_gn_ver_activity',array(
				'ver_value' 	=> $_value,
				'ver_input' 	=> $_input,
				'ver_attempt' 	=> $_attempt,
				'ver_status' 	=> $_pass,
				'ver_set' 		=> $_sett,
				'create_date' 	=> date('Y-m-d H:i:s'),
				'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
			),array(
				'cust_id' 		=> $param['CustomerId'],
				// 'ver_date' 		=> date('Y-m-d'),
				'ver_form' 		=> $_id,
			));
			
			if($this->db->affected_rows()>0)
			{
				$this->db->insert('t_gn_ver_activity_log',array(
					'cust_id' 		=> $param['CustomerId'],
					// 'ver_date' 		=> date('Y-m-d'),
					'ver_form' 		=> $_id,
					'ver_value' 	=> $_value,
					'ver_input' 	=> $_input,
					'ver_attempt' 	=> $_attempt,
					'ver_status' 	=> $_pass,
					'ver_set' 		=> $_sett,
					'create_date' 	=> date('Y-m-d H:i:s'),
					'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
				));
			}
		}
		
		// $this->_get_ver($param['CustomerId'], $param['InputId']);
	}

	function _save_total_additional_cc($param) {

		$rowCustomer = $this->_get_customer($param['CustomerId']);
		$rowVer = $this->_get_ver_attempt($param['CustomerId'], $param['InputId']);

		$_id = $param['InputId'];
		$_pass = 0;
		$_sett = 'A';
		$_value = $rowCustomer[0]->count_of_supplement;
		$_input = $param['additional_cc_2nd'];
		$_attempt = $rowVer;

		if ($_input == $_value) {
			$_pass = 1;
		}
		
		$this->db->insert('t_gn_ver_activity',array(
			'cust_id' 		=> $param['CustomerId'],
			// 'ver_date' 		=> date('Y-m-d'),
			'ver_form' 		=> $_id,
			'ver_value' 	=> $_value,
			'ver_input' 	=> $_input,
			'ver_attempt' 	=> $_attempt,
			'ver_status' 	=> $_pass,
			'ver_set' 		=> $_sett,
			'create_date' 	=> date('Y-m-d H:i:s'),
			'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
		));
		
		if($this->db->affected_rows()>0)
		{
			$this->db->insert('t_gn_ver_activity_log',array(
				'cust_id' 		=> $param['CustomerId'],
				// 'ver_date' 		=> date('Y-m-d'),
				'ver_form' 		=> $_id,
				'ver_value' 	=> $_value,
				'ver_input' 	=> $_input,
				'ver_attempt' 	=> $_attempt,
				'ver_status' 	=> $_pass,
				'ver_set' 		=> $_sett,
				'create_date' 	=> date('Y-m-d H:i:s'),
				'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
			));
		}
		else{
			$this->db->update('t_gn_ver_activity',array(
				'ver_value' 	=> $_value,
				'ver_input' 	=> $_input,
				'ver_attempt' 	=> $_attempt,
				'ver_status' 	=> $_pass,
				'ver_set' 		=> $_sett,
				'create_date' 	=> date('Y-m-d H:i:s'),
				'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
			),array(
				'cust_id' 		=> $param['CustomerId'],
				// 'ver_date' 		=> date('Y-m-d'),
				'ver_form' 		=> $_id,
			));
			
			if($this->db->affected_rows()>0)
			{
				$this->db->insert('t_gn_ver_activity_log',array(
					'cust_id' 		=> $param['CustomerId'],
					// 'ver_date' 		=> date('Y-m-d'),
					'ver_form' 		=> $_id,
					'ver_value' 	=> $_value,
					'ver_input' 	=> $_input,
					'ver_attempt' 	=> $_attempt,
					'ver_status' 	=> $_pass,
					'ver_set' 		=> $_sett,
					'create_date' 	=> date('Y-m-d H:i:s'),
					'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
				));
			}
		}
		
		// $this->_get_ver($param['CustomerId'], $param['InputId']);
	}

	//rangga Ver A

	public function _set_result_ver($cs_id,$res)
	{
		$this->db->insert('t_gn_ver_status',array(
			'cust_id' 		=> $cs_id,
			// 'ver_date' 		=> date('Y-m-d'),
			'ver_result' 	=> $res,
			'create_date' 	=> date('Y-m-d H:i:s'),
			'create_by' 	=> $this->EUI_Session->_get_session('UserId')
		));

		// return $this->db->last_query();
	}

	public function _del_ver_activity($cs_id)
	{
		$this->db->where('cust_id',$cs_id);
		$this->db->delete('t_gn_ver_activity');

		// var_dump($this->db->last_query());
		// return $this->db->last_query();
	}

	public function _get_status_result($cs_id) {
		$status = 0;
		$sql="SELECT * FROM t_gn_ver_status WHERE cust_id='$cs_id'";
		$qry = $this->db->query($sql);
		$num=$qry->num_rows();
		$res=$qry->row();
		// $result=['num'=>$num,'query'=>$qry];
		// var_dump($result);die();

		if($num > 0 ) {
			$status = $res->ver_result;
		}else{
			$status = 0;
		}
		// $result=1;
		return $status;
	}

	public function _get_history_status($cs_id)
	{
		# code...
		$sql="SELECT * FROM t_gn_ver_activity WHERE cust_id='$cs_id' AND ver_set='A'";
		$qry = $this->db->query($sql);
		$num=$qry->num_rows();
		$res=$qry->result();
		
		if($num > 0 ) {
			$status = $res;
		}
		// $result=1;
		return $status;

		
		
	}
}
?>