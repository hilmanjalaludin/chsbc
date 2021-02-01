<?php
class M_ValidPayment extends EUI_Model 
{
	function M_ValidPayment()
	{
	
	}
	
	function _CheckTypePayment($type)
	{
		$flag = array('Validation' => 0, 'Char'=>0, 'Luhn'=>0);
		
		$sql = "select 
					a.PaymentValidationFlag,
					a.PaymentDigitCheck,
					a.PaymentCheckLuhn
				from t_lk_paymenttype a 
				where a.PaymentTypeId = '".$type."'";
		$qry = $this->db->query($sql);
		
		if($qry->num_rows() > 0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				if($rows['PaymentValidationFlag'])
				{
					$flag['Validation'] = $rows['PaymentValidationFlag'];
					$flag['Char'] = $rows['PaymentDigitCheck'];
					$flag['Luhn'] = $rows['PaymentCheckLuhn'];
				}
				else{
					$flag['Validation'] = $rows['PaymentValidationFlag'];
				}
			}
		}
		
		return $flag;
	}
	
	function _getTypeValidation($type)
	{
		$datas = array();
		
		$sql = "select a.PaymentDigitCheck, a.PaymentCheckLuhn from t_lk_paymenttype a
				where a.PaymentTypeId = '".$type."'";
		
		$qry = $this->db->query($sql);
		
		if($qry->num_rows() > 0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				$datas['PaymentDigitCheck'] = $rows['PaymentDigitCheck'];
				$datas['PaymentCheckLuhn'] = $rows['PaymentCheckLuhn'];
			}
		}
		
		return $datas;
	}
	
	function StartSavePayment($param)
	{
		$conds = array('success'=>0);
		
		$this -> db -> update('t_gn_payer', array(
			'PayerCreditCardNum' => $param['PayerCreditCardNum'], 
			'PayerCreditCardExpDate' => $param['PayerCreditCardExpDate'], 
			'PayerValidation' =>  $param['PayerValidation'],
			'CreditCardTypeId' => $param['CreditCardTypeId'], 
			'PayersBankId' => $param['PayersBankId'],
			'PaymentTypeId' => $param['PaymentTypeId'],
			'PayerValidDate' => date('Y-m-d h:i:s')
		),array('CustomerId'=>$param['CustomerId']));
		
		if($this->db->affected_rows() > 0)
		{
			$conds = array('success'=>1);
		}
		
		return $conds;
	}
}
?>