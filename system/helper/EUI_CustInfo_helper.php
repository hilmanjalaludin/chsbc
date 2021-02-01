<?php
if(!function_exists('_getBlank') ) 
{
	function _getBlank() 
	{
		return '-';
	}
}

if(!function_exists('_getAgeByDOB') ) 
{
	function _getAgeByDOB($date = null) // for this format m/d/y only 
	{
		$dates = NULL;
		if( !is_null($date) ) {
			$dates = date('Y-m-d', strtotime($date));
		}
		
		return _getAge($dates);
	}
}

if(!function_exists('_getCompileAddress') ) 
{
	function _getCompileAddress( $cust_id = 0 ) 
	{
		$address = '';
		$UI =& get_instance();
		
		$sql = "select 
					a.CustomerAddressLine1,
					a.CustomerAddressLine2,
					a.CustomerAddressLine3,
					a.CustomerAddressLine4
				from t_gn_customer a
				where a.CustomerId = '".$cust_id."'";
		$qry = $UI->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			$_datas = $qry->result_first_assoc();
			$address = implode(' ',$_datas);
		}
		
		return $address;
	}
}

if(!function_exists('_getRecsource') ) 
{
	function _getRecsource( $cust_id = 0 ) 
	{
		$rec = '';
		$UI =& get_instance();
		
		$sql = "select a.Recsource from t_gn_customer a
				where a.CustomerId = '".$cust_id."'";
				
		$qry = $UI->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			$_datas = $qry->result_first_assoc();
			$rec = $_datas['Recsource'];
		}
		
		return $rec;
	}
}

if(!function_exists('_getURN') ) 
{
	function _getURN( $cust_id = 0 ) 
	{
		$rec = '';
		$UI =& get_instance();
		
		$sql = "select concat(a.Recsource,a.CustomerId) as URN from t_gn_customer a
				where a.CustomerId = '".$cust_id."'";
				
		$qry = $UI->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			$_datas = $qry->result_first_assoc();
			$rec = $_datas['URN'];
		}
		
		return $rec;
	}
}
//edit rangga URN
if(!function_exists('_getURNXSell') ) 
{
	function _getURNXSell( $cust_id = 0 ) 
	{
		if( in_array( _get_session('HandlingType'), array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)))
 		{
			$rec = '';
			$UI =& get_instance();
			// $cust_id=890612;
			
			$sql = "select a.ref_accno as URN from t_gn_attr_pil_xsell a where a.CustomerId ='$cust_id'";
					
			$qry = $UI->db->query($sql);
			
			if($qry->num_rows()>0)
			{
				$_datas = $qry->result_first_assoc();
				$rec = $_datas['URN'];
			}
			
			return $rec;
		}else{

			$rec = '';
			$UI =& get_instance();
			// $cust_id=890612;
			
			$sql = "select concat(a.Recsource,a.ref_accno) as URN from t_gn_attr_pil_xsell a where a.CustomerId ='$cust_id'";
					
			$qry = $UI->db->query($sql);
			
			if($qry->num_rows()>0)
			{
				$_datas = $qry->result_first_assoc();
				$rec = $_datas['URN'];
			}
			
			return $rec;
		}
	}
}

if(!function_exists('_getURNBestBill') ) 
{
	function _getURNBestBill( $cust_id = 0 ) 
	{
		if( in_array( _get_session('HandlingType'), array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)))
 		{
			$rec = '';
			$UI =& get_instance();
			// $cust_id=890612;
			
			$sql = "select a.REF_CARDNO as URN from t_gn_attr_best_bill a where a.CustomerId ='$cust_id'";
					
			$qry = $UI->db->query($sql);
			
			if($qry->num_rows()>0)
			{
				$_datas = $qry->result_first_assoc();
				$rec = $_datas['URN'];
			}
			
			return $rec;
		}else{

			$rec = '';
			$UI =& get_instance();
			// $cust_id=890612;
			
			$sql = "select concat(a.Recsource,a.REF_CARDNO) as URN from t_gn_attr_best_bill a where a.CustomerId ='$cust_id'";
					
			$qry = $UI->db->query($sql);
			
			if($qry->num_rows()>0)
			{
				$_datas = $qry->result_first_assoc();
				$rec = $_datas['URN'];
			}
			
			return $rec;
		}
	}
}

if(!function_exists('_getURNFlexi') ) 
{
	function _getURNFlexi( $cust_id = 0 ) 
	{
		if( in_array( _get_session('HandlingType'), array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)))
 		{
			$rec = '';
			$UI =& get_instance();
			// $cust_id=890612;
			
			$sql = "select a.ref_accno as URN from t_gn_attr_flexi a where a.CustomerId ='$cust_id'";
					
			$qry = $UI->db->query($sql);
			
			if($qry->num_rows()>0)
			{
				$_datas = $qry->result_first_assoc();
				$rec = $_datas['URN'];
			}
			
			return $rec;
		}else{

			$rec = '';
			$UI =& get_instance();
			// $cust_id=890612;
			
			$sql = "select concat(a.Recsource,a.ref_accno) as URN from t_gn_attr_flexi a where a.CustomerId ='$cust_id'";
					
			$qry = $UI->db->query($sql);
			
			if($qry->num_rows()>0)
			{
				$_datas = $qry->result_first_assoc();
				$rec = $_datas['URN'];
			}
			
			return $rec;
		}
	}
}

if(!function_exists('_getURNTop') ) 
{
	function _getURNTop( $cust_id = 0 ) 
	{
		if( in_array( _get_session('HandlingType'), array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)))
 		{
			$rec = '';
			$UI =& get_instance();
			// $cust_id=890612;
			
			$sql = "select a.REF_PIL as URN from t_gn_attr_pil_topup a where a.CustomerId ='$cust_id'";
					
			$qry = $UI->db->query($sql);
			
			if($qry->num_rows()>0)
			{
				$_datas = $qry->result_first_assoc();
				$rec = $_datas['URN'];
			}
			
			return $rec;
		}else{

			$rec = '';
			$UI =& get_instance();
			// $cust_id=890612;
			
			$sql = "select concat(a.Recsource,a.REF_PIL) as URN from t_gn_attr_pil_topup a where a.CustomerId ='$cust_id'";
					
			$qry = $UI->db->query($sql);
			
			if($qry->num_rows()>0)
			{
				$_datas = $qry->result_first_assoc();
				$rec = $_datas['URN'];
			}
			
			return $rec;
		}
	}
}


if(!function_exists('_getURNreg') ) 
{
	function _getURNreg( $cust_id = 0 ) 
	{
		if( in_array( _get_session('HandlingType'), array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)))
 		{
			$rec = '';
			$UI =& get_instance();
			// $cust_id=890612;
			
			$sql = "select a.refno as URN from t_gn_attr_cip_reg a where a.CustomerId ='$cust_id'";
					
			$qry = $UI->db->query($sql);
			
			if($qry->num_rows()>0)
			{
				$_datas = $qry->result_first_assoc();
				$rec = $_datas['URN'];
			}
			
			return $rec;
		}else{

			$rec = '';
			$UI =& get_instance();
			// $cust_id=890612;
			
			$sql = "select concat(a.Recsource,a.refno) as URN from t_gn_attr_cip_reg a where a.CustomerId ='$cust_id'";
					
			$qry = $UI->db->query($sql);
			
			if($qry->num_rows()>0)
			{
				$_datas = $qry->result_first_assoc();
				$rec = $_datas['URN'];
			}
			
			return $rec;
		}
	}
}

if(!function_exists('_getURNspc') ) 
{
	function _getURNspc( $cust_id = 0 ) 
	{
		if( in_array( _get_session('HandlingType'), array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)))
 		{
			$rec = '';
			$UI =& get_instance();
			// $cust_id=890612;
			
			$sql = "select a.refno as URN from t_gn_attr_cip_spc a where a.CustomerId ='$cust_id'";
					
			$qry = $UI->db->query($sql);
			
			if($qry->num_rows()>0)
			{
				$_datas = $qry->result_first_assoc();
				$rec = $_datas['URN'];
			}
			
			return $rec;
		}else{

			$rec = '';
			$UI =& get_instance();
			// $cust_id=890612;
			
			$sql = "select concat(a.Recsource,a.refno) as URN from t_gn_attr_cip_spc a where a.CustomerId ='$cust_id'";
					
			$qry = $UI->db->query($sql);
			
			if($qry->num_rows()>0)
			{
				$_datas = $qry->result_first_assoc();
				$rec = $_datas['URN'];
			}
			
			return $rec;
		}
	}
}

if(!function_exists('_getURNmlt') ) 
{
	function _getURNmlt( $cust_id = 0 ) 
	{
		if( in_array( _get_session('HandlingType'), array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)))
 		{
			$rec = '';
			$UI =& get_instance();
			// $cust_id=890612;
			
			$sql = "select a.refno as URN from t_gn_attr_cip_mlt a where a.CustomerId ='$cust_id'";
					
			$qry = $UI->db->query($sql);
			
			if($qry->num_rows()>0)
			{
				$_datas = $qry->result_first_assoc();
				$rec = $_datas['URN'];
			}
			
			return $rec;
		}else{

			$rec = '';
			$UI =& get_instance();
			// $cust_id=890612;
			
			$sql = "select concat(a.Recsource,a.refno) as URN from t_gn_attr_cip_mlt a where a.CustomerId ='$cust_id'";
					
			$qry = $UI->db->query($sql);
			
			if($qry->num_rows()>0)
			{
				$_datas = $qry->result_first_assoc();
				$rec = $_datas['URN'];
			}
			
			return $rec;
		}
	}
}

if(!function_exists('_getURNdormant') ) 
{
	function _getURNdormant( $cust_id = 0 ) 
	{
		if( in_array( _get_session('HandlingType'), array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)))
 		{
			$rec = '';
			$UI =& get_instance();
			// $cust_id=890612;
			
			$sql = "select a.refno as URN from t_gn_attr_cip_dormant a where a.CustomerId ='$cust_id'";
					
			$qry = $UI->db->query($sql);
			
			if($qry->num_rows()>0)
			{
				$_datas = $qry->result_first_assoc();
				$rec = $_datas['URN'];
			}
			
			return $rec;
		}else{

			$rec = '';
			$UI =& get_instance();
			// $cust_id=890612;
			
			$sql = "select concat(a.Recsource,a.refno) as URN from t_gn_attr_cip_dormant a where a.CustomerId ='$cust_id'";
					
			$qry = $UI->db->query($sql);
			
			if($qry->num_rows()>0)
			{
				$_datas = $qry->result_first_assoc();
				$rec = $_datas['URN'];
			}
			
			return $rec;
		}
	}
}

if(!function_exists('_getGenderInfo') ) 
{
	function _getGenderInfo( $code = 0 ) 
	{
		$rec = '';
		$UI =& get_instance();
		
		$sql = "select a.GenderIndo from t_lk_gender a
				where a.GenderCode = '".$code."'";
				
		$qry = $UI->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			$_datas = $qry->result_first_assoc();
			$rec = $_datas['GenderIndo'];
		}
		
		return $rec;
	}
}

if(!function_exists('_getProduct') ) 
{
	function _getProduct( $code = 0 ) 
	{
		$rec = '';
		$UI =& get_instance();
		
		$sql = "select b.CampaignDesc from t_gn_customer a INNER JOIN t_gn_campaign b ON a.CampaignId=b.CampaignId
				where a.CustomerId = '".$code."'";
				
		$qry = $UI->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			$_datas = $qry->result_first_assoc();
			$rec = $_datas['CampaignDesc'];
		}
		
		return $rec;
	}
}

if(!function_exists('_getMultiProduct') ) 
{
	function _getMultiProduct( $code = 0 ) 
	{
		$rec = 'Tidak';
		$UI =& get_instance();
		
		$sql = "select a.CampaignId, b.CampaignDesc from t_gn_customer a INNER JOIN t_gn_campaign b ON a.CampaignId=b.CampaignId
				where a.CustomerId = '".$code."'";
				
		$qry = $UI->db->query($sql);
		$row = $qry->result_first_assoc();

		if ($row['CampaignId'] == '5') {
			$q = $UI->db->query("SELECT a.prog_code FROM t_gn_attr_pil_xsell a WHERE a.CustomerId = '".$code."'");
			$r = $q->result_first_assoc();

			if ($r['prog_code'] == 'C01') {
				$rec = 'Ya';
			}
		} else if ($row['CampaignId'] == '9') {
			$q = $UI->db->query("SELECT a.prog_code FROM t_gn_attr_flexi a WHERE a.CustomerId = '".$code."'");
			$r = $q->result_first_assoc();

			if ($r['prog_code'] == 'C01') {
				$rec = 'Ya';
			}
		}
		
		return $rec;
	}
}
?>