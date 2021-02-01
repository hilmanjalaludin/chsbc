<?php 
class M_VerifikasiB extends EUI_Model
{
	var $_set_a = array();
	var $_set_b = array();
	var $_set_c = array();
	 
	function M_VerifikasiB()
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
		// var_dump($_datas);die();
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

	public function _get_checkdata($id)
	{
		# code...
		$sql="SELECT a.CustomerId,a.flag_suplement,a.count_of_supplement,a.ORI_LOAN_AMT,a.CustomerHomePhoneNum,a.SSVNO FROM t_gn_customer a
		WHERE a.CustomerId='$id'";
		$qry = $this->db->query($sql);
		$row = $qry->row();
		return $row;
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

	function _get_ver_attempt_check($id,$InputId) {
		// $sql = "SELECT count(a.var_attempt) FROM t_gn_ver_activity a WHERE a.cust_id='$id' AND ver_status=0 ORDER BY a.id DESC";
		$sql = "SELECT a.ver_attempt  FROM t_gn_ver_activity a WHERE a.cust_id='$id' AND a.ver_form='$InputId'";
		$qry = $this->db->query($sql);
		$row = $qry->result();
		return $row[0];
	}


	
	function _save_ver_activity($param, $type) {
		$rowCustomer = $this->_get_customer($param['CustomerId']);
		$rowVer = $this->_get_ver_attempt($param['CustomerId'], $param['InputId']);
		// var_dump('rowver', $rowVer);die();
		// var_dump($rowCustomer[0]->count_of_supplement);die();
		// var_dump($param);die();
		$_id = $param['InputId'];
		$_pass = 0; 
		$_sett = 'B';

		$homeNumberCut = substr($rowCustomer[0]->CustomerHomePhoneNum,3);
		$homeNumber = substr($rowCustomer[0]->CustomerHomePhoneNum,0,3);
		if ($type == 'ask_1') {
			$_value = $rowCustomer[0]->flag_suplement.'|'.$rowCustomer[0]->count_of_supplement;
			$_input = $param['additional_cc'].'|'.$param['total_additional_cc'];
		} else if ($type == 'ask_1_1') {
			$_value = $rowCustomer[0]->count_of_supplement;
			$_input = $param['total_additional_cc'];
		} else if ($type == 'ask_2') {
			$_value = $rowCustomer[0]->ORI_LOAN_AMT;
			$_input = str_replace(".","",$param['ori_loan']);
		} else if ($type == 'ask_3') {
			if ($homeNumber == '021') {
				$val = $homeNumberCut;
			} else {
				$val = $rowCustomer[0]->CustomerHomePhoneNum;
			}
			// $_value = $rowCustomer[0]->CustomerHomePhoneNum;
			$_value = $val;
			$_input = $param['phone_num'];
		} else if ($type == 'ask_4') {
			$_value = $rowCustomer[0]->SSVNO;
			$_input = $param['pay_acc'];
		} else if ($type == 'ask_5') {
			$_value = $rowCustomer[0]->cycle_due_date;
			$_input = $param['loan_pay_date'];
		} else if ($type == 'ask_6') {
			$_value = $rowCustomer[0]->Old_Instalment;
			$_input = $param['pay_value'];
		 } //else if ($type == 'ask_7') {
		// 	$_value = $rowCustomer[0]->due_date;
		// 	$_input = date('Y-m-d', strtotime($param['jatuh_tempo']));
		// }
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
			'ver_1'         => $_pass,
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
				'ver_1'         => $_pass,
				'create_date' 	=> date('Y-m-d H:i:s'),
				'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
			));
		}
		else{
			
			if ($_attempt == 2) {
				$ver = 'ver_2';
				
			} else if ($_attempt == 3) {
				$ver = 'ver_3';
				
			}
			$this->db->update('t_gn_ver_activity',array(
				'ver_value' 	=> $_value,
				'ver_input' 	=> $_input,
				'ver_attempt' 	=> $_attempt,
				'ver_status' 	=> $_pass,
				'ver_set' 		=> $_sett,
				 $ver           => $_pass,
				'create_date' 	=> date('Y-m-d H:i:s'),
				'create_by' 	=> $this->EUI_Session->_get_session('UserId'),
			),array(
				'cust_id' 		=> $param['CustomerId'],
				// 'ver_date' 		=> date('Y-m-d'),
				'ver_form' 		=> $_id,
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
		}
		
		// $this->_get_ver($param['CustomerId'], $param['InputId']);
	}

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


	public function _get_history_status($cus_id)
	{
		# code...
		$sql="SELECT * FROM t_gn_ver_activity WHERE cust_id='$cus_id' AND ver_set='B'";
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
