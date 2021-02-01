<?php

//edit rangga cdd
class M_CddPilx extends EUI_Model
{
	var $_set_a = array();
	var $_set_b = array();
	var $_set_c = array();
	
	function M_CddPilx()
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
		
		if($qry->num_rows()>0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				$_temp[$rows['ver_set']][$rows['ver_status']] = $rows['ver_total'];
			}
		}
		
		return $_temp;
	}

	function _save_activity($param)
	{
		$succes="succes";
		$gagal="gagal";
		date_default_timezone_set('Asia/Jakarta');
		$param['last_updated']=date('d-m-Y H:i:s');
		$this->db->insert('t_gn_cdd',$param);
		//var_dump($this->db->last_query());die;
		if($this->db->affected_rows()>0){
			return $succes;
		}else{
			return $gagal;
		}
	}

	function get_table($campaignid) {
		// var_dump('camp',$campaignid);die();
		$sql = "SELECT * FROM t_gn_campaign_ref WHERE CampaignId='$campaignid'";
		$result = $this->db->query($sql);
		$res=$result->row();
		//var_dump('res',$res->TableDetail);die();

		return $res->TableDetail;
	}

	function _save_activity_2nd($param){
		// $succes="succes";
		// $gagal="gagal";
		// date_default_timezone_set('Asia/Jakarta');
		// $param['last_updated']=date('d-m-Y H:i:s');
		// $this->db->insert('t_gn_cdd',$param);
		// var_dump($this->db->last_query());die;
		// if($this->db->affected_rows()>0){
		// 	return $succes;
		// }else{
		// 	return $gagal;
		// }

		$succes="succes";
		$gagal="gagal";
		date_default_timezone_set('Asia/Jakarta');
		$insert['CustId'] = $param['CustId_2nd'];
		$insert['Q1'] = $param['Q1_2nd'];
		$insert['Q1ba'] = $param['Q1ba_2nd'];
		$insert['Q1bb'] = $param['Q1bb_2nd'];
		$insert['Q1bc'] = $param['Q1bc_2nd'];
		$insert['Q1bd'] = $param['Q1bd_2nd'];
		$insert['Q1be'] = $param['Q1be_2nd'];
		$insert['Q2'] = $param['Q2_2nd'];
		$insert['Q2a'] = $param['Q2a_2nd'];
		$insert['Q2b'] = $param['Q2b_2nd'];
		$insert['Q3'] = $param['Q3_2nd'];
		$insert['Q3a'] = $param['Q3a_2nd'];
		$insert['Q3b'] = $param['Q3b_2nd'];
		$insert['Q4'] = $param['Q4_2nd'];
		$insert['Q5'] = $param['Q5_2nd'];
		$insert['Q6'] = $param['Q6_2nd'];
		$insert['Q7'] = $param['Q7_2nd'];
		$insert['Q8a'] = $param['Q8a_2nd'];
		$insert['Q8b'] = $param['Q8b_2nd'];
		$insert['Q8c'] = $param['Q8c_2nd'];
		$insert['Q8d'] = $param['Q8d_2nd'];
		$insert['Q8e'] = $param['Q8e_2nd'];
		$insert['Q9'] = $param['Q9_2nd'];
		$insert['Q10'] = $param['Q10_2nd'];
		$insert['Q11'] = $param['Q11_2nd'];
		$insert['last_updated'] = date('d-m-Y H:i:s');
		$insert['UserID'] = $param['UserId_2nd'];
		$insert['Q8'] = $param['Q8_2nd'];

		$this->db->insert('t_gn_cdd',$insert);
		if($this->db->affected_rows()>0){
			return $succes;
		}else{
			return $gagal;
		}
	}

	function get_data_cust($id)
	{

		$sql="SELECT a.CustomerAddressLine1,a.CustomerAddressLine2,a.CustomerAddressLine3,a.CustomerAddressLine4,a.CustomerZipCode,a.CampaignId From t_gn_customer a WHERE a.CustomerId ='".$id."'";
		$result=$this->db->query($sql);
		return $result;
	}

	function get_data_need($id,$camp_id)
	{
		//var_dump($id,$camp_id);die();
		$table = $this->get_table($camp_id);
		//var_dump('tabel',$table);die();
		$sql="SELECT a.Need_Update_Income From $table a WHERE a.CustomerId ='".$id."'";
		$result=$this->db->query($sql);
		return $result;
		// var_dump($result->row());die();
	}
	function get_data_need_2nd($id)
	{
		$sql="SELECT a.Need_Update_Income From t_gn_attr_flexi a WHERE a.CustomerId ='".$id."'";
		$result=$this->db->query($sql);
		return $result;
	}
}
?>