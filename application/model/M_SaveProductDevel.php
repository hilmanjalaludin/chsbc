<?php
class M_SaveProductDevel extends EUI_Model
{
	function M_SaveProductDevel()
	{
		$this -> load -> model(array(
			'M_FormLayout',
			'M_SetProduct',
			'M_Generator',
			'M_Payers',
			'M_Insured',
			'M_Benefiecery'
		 ));
	}
	
	function _setNoPecah($p=null)
	{
		$_conds = array();
		
		$InsuredDOB = $this -> EUI_Tools ->_date_english($p['InsuredDOB']);
		$SellerId = $this -> EUI_Session ->_get_session('UserId');
		$ProductId = (isset($p['ProductId'])?$p['ProductId'] : null );
		$CustomerId = (isset($p['CustomerId'])?$p['CustomerId'] : null ); 
		$PremiumGroupId  = (isset($p['InsuredGroupPremi'])?$p['InsuredGroupPremi'] : null ); 
		$InsuredAge = (isset($p['InsuredAge'])?$p['InsuredAge'] : null );
		$InsuredGenderId = (isset($p['InsuredGenderId'])?$p['InsuredGenderId'] : null ); 
		$InsuredPayMode  = (isset($p['InsuredPayMode'])?$p['InsuredPayMode'] : null );
		$InsuredPlanType  = (isset($p['InsuredPlanType'])?$p['InsuredPlanType'] : null );
		$InsuredPolicyNumber = (isset($p['InsuredPolicyNumber'])?$p['InsuredPolicyNumber'] : null );
		
		if(!is_null($ProductId))
		{
			$this -> M_Generator -> _set_polis_number($ProductId,'N' );
			if( class_exists('M_Generator') )
			{
				if (!is_null($PremiumGroupId) AND !is_null($ProductId) AND !is_null($CustomerId) 
					AND !is_null($InsuredAge) AND !is_null($InsuredPayMode) AND !is_null($InsuredPlanType) )
				{
					$PolicyNumber  = $this -> M_Generator -> _get_polis_number();
					$PolicyLastId  = $this -> M_Generator -> _get_last_number();
					
					if( (int)$PremiumGroupId ==2 )
					{
						$this->_saveHolder();
					}
					
					if( ((INT)$PremiumGroupId ==3) AND (!is_null($InsuredPolicyNumber)) )
					{
					
					}
					
					if( ((INT)$PremiumGroupId ==1) AND (!is_null($InsuredPolicyNumber)) )
					{
					
					}
				}
			}
		}
		
		return $_conds;	
	}
	
	function _saveHolder()
	{
	
	}
	
	function _saveSpouse()
	{
	
	}
	
	function _saveDependent()
	{
	
	}
	
	function _getExistSales( $data =null )
	{
		$_count = 0;
		
		if( !is_null($data) )
		{
			$this -> db -> select('COUNT(a.PolicyAutoGenId) AS rows_count', FALSE);
			$this -> db -> from('t_gn_policyautogen a');
			$this -> db -> where('a.ProductId',$data['ProductId']);
			$this -> db -> where('a.CustomerId',$data['CustomerId']);
			$this -> db -> where('a.MemberGroup',$data['InsuredGroupPremi']);
			
			if( $_avail = $this -> db ->get() -> result_first_assoc() )
			{
				$_count = (INT)$_avail['rows_count'];
			}	
		}
		
		return $_count;
	}
}
?>