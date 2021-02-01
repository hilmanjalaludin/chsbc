<?php
	class M_SaveEditPolicy extends EUI_Model
	{
		function M_SaveEditPolicy()
		{
			$this -> load -> model(array(
				'M_Payers'
			 ));
		}
		
		function _UpdatePayers($param)
		{
			$conds = 0;
			
			$sql = array();
			
			$param['PayerUpdatedTs'] = date('Y-m-d H:i:s');
			
			foreach($param as $key => $value)
			{
				if($key != 'SearchAddress' && $key != 'PayerId' && $key != 'ProductId' )
				{
					if($key == 'PayerSalutationId')
					{
						$sql['SalutationId'] = $value;
					}
					else if($key == 'PayerGenderId')
					{
						$sql['GenderId'] = $value;
					}
					else if($key == 'PayerIdentificationTypeId')
					{
						$sql['IdentificationTypeId'] = $value;
					}
					else if($key == 'PayerProvinceId')
					{
						$sql['IdentificationTypeId'] = $value;
					}
					else if($key == 'PayerDOB')
					{
						$sql[$key] = date('Y-m-d', strtotime($value));
						// echo $sql[$key];
					}
					else{
						$sql[$key] = $value;
					}
				}
			}
			
			$update = $this -> db -> update('t_gn_payer',$sql,array('PayerId'=>$param['PayerId']));
			
			if( $update )
			{
				$conds = 1;
			}
			
			return $conds;
		}
		
		function _UpdateInsured($param)
		{
			$conds = array('status'=>0,'msg'=>'');
			// print_r($param);
			$param_plan = array(
				'ProductId' => $param['ProductId'],
				'PremiumGroupId' => $param['InsuredGroupPremi'],
				'ProductPlan' => $param['InsuredPlanType'],
				'GenderId' => $param['InsuredGenderId'],
				'RangeAge' => $param['InsuredAge']
			);
			
			// update policy
			$pol_id['PolicyId'] 	 = $param['PolicyId'];
			$policy['ProductPlanId'] = $this->getPlanId($param_plan);
			$policy['PolicyPremi'] 	 = $param['InsuredPremi'];
			// print_r($pol_id);
			// print_r($policy);
			if($this->db->update('t_gn_policy',$policy,$pol_id))
			{
				$ins_id['InsuredId'] = $param['InsuredId'];
				$ins['InsuredFirstName'] = $param['InsuredFirstName'];
				$ins['InsuredLastName'] = $param['InsuredLastName'];
				$ins['Place_of_Birth'] = $param['Place_of_Birth'];
				$ins['InsuredDOB'] = date('Y-m-d', strtotime($param['InsuredDOB']));
				$ins['InsuredAge'] = $param['InsuredAge'];
				$ins['Contact_Height'] = $param['Contact_Height'];
				$ins['Contact_Weight'] = $param['Contact_Weight'];
				$ins['Smoking_Status'] = $param['Smoking_Status'];
				$ins['Dec_Q02_Answer'] = $param['Dec_Q02_Answer'];
				$ins['Dec_Q01_Answer'] = $param['Dec_Q01_Answer'];
				$ins['Dec_Q03_Answer'] = $param['Dec_Q03_Answer'];
				$ins['Dec_Q02_Comments'] = $param['Dec_Q02_Comments'];
				$ins['Dec_Q01_Comments'] = $param['Dec_Q01_Comments'];
				$ins['Dec_Q03_Comments'] = $param['Dec_Q03_Comments'];
				$ins['InsuredPayMode'] = $param['InsuredPayMode'];
				$ins['PremiumGroupId'] = $param['InsuredGroupPremi'];
				$ins['SalutationId'] = $param['InsuredSalutationId'];
				$ins['GenderId'] = $param['InsuredGenderId'];
				$ins['Marital_Status'] = $param['Marital_Status'];
				
				if($this->db->update('t_gn_insured',$ins,$ins_id))
				{
					$param_benef = array(
						'BenefId_1' => $param['BenefId_1'],
						'BenefFirstName_1' => $param['BenefFirstName_1'],
						'BenefLastName_1' => $param['BenefLastName_1'],
						'BenefDOB_1' => date('Y-m-d', strtotime($param['BenefDOB_1'])),
						'BenefRelationshipTypeId_1' => $param['BenefRelationshipTypeId_1'],
						'BenefSalutationId_1' => $param['BenefSalutationId_1'],
						'BenefGenderId_1' => $param['BenefGenderId_1'],
						
						'BenefId_2' => $param['BenefId_2'],
						'BenefFirstName_2' => $param['BenefFirstName_2'],
						'BenefLastName_2' => $param['BenefLastName_2'],
						'BenefDOB_2' => date('Y-m-d', strtotime($param['BenefDOB_2'])),
						'BenefRelationshipTypeId_2' => $param['BenefRelationshipTypeId_2'],
						'BenefSalutationId_2' => $param['BenefSalutationId_2'],
						'BenefGenderId_2' => $param['BenefGenderId_2']
					);
					
					for($i=1;$i<=2;$i++)
					{
						if($param_benef['BenefId_'.$i] != ''){
							$bnf_id['BeneficiaryId'] = $param_benef['BenefId_'.$i];
							$bnf_ins['BeneficiaryFirstName'] = $param_benef['BenefFirstName_'.$i];
							$bnf_ins['BeneficiaryLastName'] = $param_benef['BenefLastName_'.$i];
							$bnf_ins['BeneficiaryDOB'] = $param_benef['BenefDOB_'.$i];
							$bnf_ins['RelationshipTypeId'] = $param_benef['BenefRelationshipTypeId_'.$i];
							$bnf_ins['SalutationId'] = $param_benef['BenefSalutationId_'.$i];
							$bnf_ins['GenderId'] = $param_benef['BenefGenderId_'.$i];
						
						
							if($this->db->update('t_gn_beneficiary',$bnf_ins,$bnf_id))
							{
								
							}
							else{
								$conds['msg'] = "Can\'t update benef ".$i." !";
							}
						}
					}
					
					$conds['status'] = 1;
				}
				else{
					$conds['msg'] = "Can\'t update insured!";
				}
			}
			else{
				$conds['msg'] = "Can\'t update policy!";
			}
			
			return $conds;
		}
		
		function getPlanId($prm)
		{
			$id = 0;
			
			if(is_array($prm))
			{
				$sql = "select a.ProductPlanId from t_gn_productplan a
						where 1=1 ";
				
				foreach($prm as $key => $value)
				{
					if($key != 'RangeAge')
					{
						$sql .= " and a.".$key." = ".$value." ";
					}
					else{
						$sql .= " and ".$value." between a.ProductPlanAgeStart and a.ProductPlanAgeEnd ";
					}
				}
				// echo $sql;
				$qry = $this->db->query($sql);
				
				foreach($qry->result_assoc() as $rows)
				{
					$id = $rows['ProductPlanId'];
				}
			}
			
			return $id;
		}
	}
?>