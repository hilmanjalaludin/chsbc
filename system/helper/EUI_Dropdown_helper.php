<?php 
//---------------------------------------------------------------------------------------

/* @ package 			: Dropdown Helper Attribute  
 *
 * @ Notes 				: View All Reference Data On All Modul 
 * @ param 				: uknown 
 * @ author				: uknown 
 */
 

 if( !function_exists('Dropdown') )
{
  function Dropdown() {
	$UI =& get_instance();
	$UI->load->model(array('M_Combo'));
	
	$Dropdown = null;
	 if( class_exists('M_Combo') )
	{
		$Dropdown =& get_class_instance('M_Combo','get_instance'); 
	}
	return $Dropdown;
 }	
}


//---------------------------------------------------------------------------------------

/* @ package 			: Dropdown Helper Attribute  
 *
 * @ Notes 				: View All Reference Data On All Modul 
 * @ param 				: uknown 
 * @ author				: uknown 
 */

function ObjectAssigment()
{	
	$UI =& get_instance();
	$UI->load->model(array('M_MgtAssignment'));
	$out =& get_class_instance('M_MgtAssignment');
	return $out;
}	

//---------------------------------------------------------------------------------------

/* @ package 			: Dropdown Helper Attribute  
 *
 * @ Notes 				: View All Reference Data On All Modul 
 * @ param 				: uknown 
 * @ author				: uknown 
 */

function ObjectCustomer()
{	
	$UI =& get_instance();
	$UI->load->model(array('M_SrcCustomerList'));
	$out =& get_class_instance('M_SrcCustomerList');
	return $out;
}	


//---------------------------------------------------------------------------------------

/* @ package 			: Dropdown Helper Attribute  
 *
 * @ Notes 				: View All Reference Data On All Modul 
 * @ param 				: uknown 
 * @ author				: uknown 
 */

function ObjectPayer()
{	
	$UI =& get_instance();
	$UI->load->model(array('M_Payers'));
	$out =& get_class_instance('M_Payers');
	return $out;
}	


//---------------------------------------------------------------------------------------

/* @ package 			: Dropdown Helper Attribute  
 *
 * @ Notes 				: View All Reference Data On All Modul 
 * @ param 				: uknown 
 * @ author				: uknown 
 */

function ObjectUtility()
{	
	$UI =& get_instance();
	$UI->load->model(array('M_Utility'));
	$out =& get_class_instance('M_Utility');
	return $out;
}	

//---------------------------------------------------------------------------------------

/* @ package 			: Dropdown Helper Attribute  
 *
 * @ Notes 				: View All Reference Data On All Modul 
 * @ param 				: uknown 
 * @ author				: uknown 
 */

function ObjectCampaign()
{	
	$UI =& get_instance();
	$UI->load->model(array('M_SetCampaign'));
	$out =& get_class_instance('M_SetCampaign');
	return $out;
}	



//---------------------------------------------------------------------------------------

/* @ package 			: Dropdown Helper Attribute  
 *
 * @ Notes 				: View All Reference Data On All Modul 
 * @ param 				: uknown 
 * @ author				: uknown 
 */

function ObjectQtyPoint()
{	
	$UI =& get_instance();
	$UI->load->model(array('M_QtyPoint'));
	$out =& get_class_instance('M_QtyPoint');
	return $out;
}	

//---------------------------------------------------------------------------------------

 if( !function_exists('Maried') ) {
	function Maried() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getMaried();
	}
 } 
//---------------------------------------------------------------------------------------

 if( !function_exists('MariedStatus') ) {
	function MariedStatus() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getMaried();
	}
 } 
//---------------------------------------------------------------------------------------

 if( !function_exists('Smoking') ) {
	function Smoking() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getSmoking();
	}
 } 
 //---------------------------------------------------------------------------------------

 if( !function_exists('Comunication') ) {
	function Comunication() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getComunication();
	}
 } 
 //---------------------------------------------------------------------------------------

 if( !function_exists('WorkType') ) {
	function WorkType() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getWorkType();
	}
 } 
 
//---------------------------------------------------------------------------------------
if( !function_exists('Country') ) {
	function Country() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getCountry();
	}
 }
//---------------------------------------------------------------------------------------
if( !function_exists('OutboundCategory') ) {
	function OutboundCategory() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getOutboundCategory();
	}
 }
//---------------------------------------------------------------------------------------
if( !function_exists('InboundCategory') ) {
	function InboundCategory() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getInboundCategory();
	}
 }
//---------------------------------------------------------------------------------------
if( !function_exists('Gender') ) {
	function Gender( $val = null ) {
		$Dropdown =& Dropdown();
		$arr = $Dropdown->_getGender();
		if( is_null($val) ){
			return $arr;
		}
		return $arr[$val];
	}
 } 
//---------------------------------------------------------------------------------------
if( !function_exists('CallResultInbound') ) {
	function CallResultInbound( $val = null ) {
		$Dropdown =& Dropdown();
		
		$arr = $Dropdown->_getCallResultInbound();
		if( is_null($val) ){
			return $arr;
		}
		return $arr[$val];
		
	}
 } 
 
//---------------------------------------------------------------------------------------
if( !function_exists('CallResultId') ) {
	function CallResultId( $val = null ) {
		$Dropdown =& Dropdown();
		$arr = $Dropdown->_getCallResultInbound();
		if( is_null($val) ){
			return $arr;
		}
		return $arr[$val];
		 
	}
 }  
 
//---------------------------------------------------------------------------------------
if( !function_exists('CallStatusId') ) {
	function CallStatusId( $val = null ) {
		$Dropdown =& Dropdown();
		$arr = $Dropdown->_getOutboundCategory();
		if( is_null($val) ){
			return $arr;
		}
		if( !strcmp($val, "0") ){
			return "";
		}
		return $arr[$val];
		 
	}
 } 
 
//---------------------------------------------------------------------------------------
if( !function_exists('CallResultOutbound') ) {
	function CallResultOutbound( $val = null ) {
		
		$Dropdown =& Dropdown();
		$arr = $Dropdown->_getCallResultOutbound();
		if( is_null($val) ){
			return $arr;
		}
		return $arr[$val];
		 
	}
 }  
//---------------------------------------------------------------------------------------
if( !function_exists('PaymentMode') ) {
	function PaymentMode() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getPaymentMode();
	}
 }   
//---------------------------------------------------------------------------------------
if( !function_exists('PaymentType') ) {
	function PaymentType() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getPaymentType();
	}
 }    
//---------------------------------------------------------------------------------------
if( !function_exists('CardType') ) {
	function CardType() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getCardType();
	}
 }    
//---------------------------------------------------------------------------------------
if( !function_exists('PremiGroup') ) {
	function PremiGroup() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getPremiGroup();
	}
 }    
//---------------------------------------------------------------------------------------
if( !function_exists('Bank') ) {
	function Bank() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getBank();
	}
 }    
//---------------------------------------------------------------------------------------
if( !function_exists('Province') ) {
	function Province() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getProvince();
	}
 }    
//---------------------------------------------------------------------------------------
if( !function_exists('Realtionship') ) {
	function Realtionship() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getRealtionship();
	}
 }    
//---------------------------------------------------------------------------------------
if( !function_exists('Salutation') ) {
	function Salutation() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getSalutation();
	}
 }    
//---------------------------------------------------------------------------------------
if( !function_exists('DirectionType') ) {
	function DirectionType() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getDirectionType();
	}
 }    
//---------------------------------------------------------------------------------------
if( !function_exists('User') ) {
	function User() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getUser();
	}
 }    
 
 //---------------------------------------------------------------------------------------
if( !function_exists('UserId') ) {
	function UserId() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getUser();
	}
 }
 
 //---------------------------------------------------------------------------------------
if( !function_exists('getSPV') ) {
	function getSPV() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getSPV();
	}
 }  
 
//---------------------------------------------------------------------------------------
if( !function_exists('Product') ) {
	function Product() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getProduct();
	}
 }     
//---------------------------------------------------------------------------------------
if( !function_exists('Campaign') ) {
	function Campaign() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getCampaign();
	}
 }     
 
 //---------------------------------------------------------------------------------------
if( !function_exists('CampaignId') ) {
	function CampaignId() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getCampaign();
	}
 }    
//---------------------------------------------------------------------------------------
if( !function_exists('CallResult') ) {
	function CallResult() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getCallResult();
	}
 }     
 //---------------------------------------------------------------------------------------
if( !function_exists('CallResultTransfer') ) {
	function CallResultTransfer() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getCallResultTransfer();
	}
 }     
 
 if( !function_exists ('Recsource') )
{
	 function Recsource($filter=array())
	{
		$Output =& Dropdown();
		return (array)$Output->_getRecsource($filter);
	}
}
 
 
//---------------------------------------------------------------------------------------
if( !function_exists('QualityResult') ) {
	function QualityResult() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getQualityResult();
	}
 }     
//---------------------------------------------------------------------------------------
if( !function_exists('Serialize') ) {
	function Serialize() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getSerialize();
	}
 }     
 //---------------------------------------------------------------------------------------
if( !function_exists('Identification') ) {
	function Identification() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getIdentification();
	}
 }  

   //---------------------------------------------------------------------------------------
if( !function_exists('ReasonSchedule') ) {
	function ReasonSchedule() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getReasonSchedule();
	}
 } 

 if( !function_exists('GetReasonSchedule') ) {
	function GetReasonSchedule( $ReasonId = 0 ) {
		$Dropdown =& Dropdown();
		return $Dropdown->_getReasonSchedule( $ReasonId );
	}
 } 
 
 //---------------------------------------------------------------------------------------
if( !function_exists('BillingAddress') ) {
	function BillingAddress() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getBillingAddress();
	}
 }     
 //---------------------------------------------------------------------------------------
if( !function_exists('CallDirection') ) {
	function CallDirection() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getCallDirection();
	}
 } 
 //---------------------------------------------------------------------------------------
if( !function_exists('AgentGroup') ) {
	function AgentGroup() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getAgentGroup();
	}
 }
 //---------------------------------------------------------------------------------------
if( !function_exists('AvailalblePDSGroup') ) {
	function AvailalblePDSGroup($groupId) {
		$Dropdown =& Dropdown();
		return $Dropdown->_getAvailalblePDSGroup($groupId);
	}
 }     
 //---------------------------------------------------------------------------------------
if( !function_exists('AgentId') ) {
	function AgentId( $val = null ) {
		$list = Dropdown()->_getAgentId();
		if( is_null($val) ){
			return $list;
		}
		
		if( !strcmp( $val, 0) ){
			return "";
		}
		return $list[$val];
		
	}
 }    
 //---------------------------------------------------------------------------------------
if( !function_exists('CallResultByCategory') ) {
	function CallResultByCategory( $Id ) 
	{
		$Dropdown =& Dropdown();
		return $Dropdown->_getCallResultByCategory( $Id );
	}
 }      
  
  //---------------------------------------------------------------------------------------
if( !function_exists('CustomerContactPhone') ) {
	function CustomerContactPhone( $CustomerId = 0, $flags = 0 ) 
	{
		$Dropdown =& ObjectCustomer();
		return $Dropdown->_getPhoneCustomer( $CustomerId,$flags);
	}
 }      
   
  //---------------------------------------------------------------------------------------
if( !function_exists('CustomerAdditionalPhone') ) {
	function CustomerAdditionalPhone( $CustomerId = 0 ) 
	{
		$Dropdown =& Dropdown();
		return $Dropdown->_getAdditionalPhone( $CustomerId );
	}
 }     

  //---------------------------------------------------------------------------------------
if( !function_exists('CustomerProductId') ) {
	function CustomerProductId( $CustomerId = 0 ) 
	{
		$Dropdown =& ObjectCustomer();
		return $Dropdown->_getAvailProduct( $CustomerId );
	}
 }    
 
 //---------------------------------------------------------------------------------------
if( !function_exists('PayerReady') ) {
	function PayerReady( $CustomerId = 0 ) 
	{
		$Dropdown =& ObjectPayer();
		return $Dropdown->_getPayerReady( $CustomerId );
	}
 }   
 
//---------------------------------------------------------------------------------------
if( !function_exists('PayerInformation') ) {
	function PayerInformation( $CustomerId = 0 ) 
	{
		$Dropdown =& ObjectPayer();
		return $Dropdown->_getPayersInformation( $CustomerId );
	}
 }   
 
//=======================================================================================
// EFICIENCY PROCESS LOADING . 
//=======================================================================================

//---------------------------------------------------------------------------------------
if( !function_exists('ApprovalPoint') ) {
	function ApprovalPoint( $CustomerId = 0 ) 
	{
		$Dropdown =& ObjectQtyPoint();
		return $Dropdown->_getApprovalPoint( $CustomerId );
	}
 }   
       
//---------------------------------------------------------------------------------------
if( !function_exists('QualityScoring') ) {
	function QualityScoring( $CustomerId = 0 ) 
	{
		$Dropdown =& ObjectQtyPoint();
		return $Dropdown->_getQualityScoring( $CustomerId );
	}
 }   
       
//---------------------------------------------------------------------------------------
if( !function_exists('Assesment') ) {
	function Assesment( $CustomerId = 0 ) 
	{
		$Dropdown =& ObjectQtyPoint();
		return $Dropdown->_getAssesment( $CustomerId );
	}
 }   
       
//---------------------------------------------------------------------------------------
if( !function_exists('JsonAssesment') ) {
	function JsonAssesment( $CustomerId = 0 ) 
	{
		$Dropdown =& ObjectQtyPoint();
		return $Dropdown->_jsonAssesment( $CustomerId );
	}
 }   
       
//---------------------------------------------------------------------------------------
if( !function_exists('ContentScoring') ) {
	function ContentScoring( $CustomerId = 0 ) 
	{
		$Dropdown =& ObjectQtyPoint();
		return $Dropdown->_getContentScoring( $CustomerId );
	}
 }   
       
//---------------------------------------------------------------------------------------
if( !function_exists('ComboScoring') ) {
	function ComboScoring( $CustomerId = 0 ) 
	{
		$Dropdown =& ObjectQtyPoint();
		return $Dropdown->_comboScoring( $CustomerId );
	}
 }   
 
        
//---------------------------------------------------------------------------------------
if( !function_exists('Flags') ) {
	function Flags()  {
		return array('0' => 'Not Active', '1' => 'Active');
	}
 }   
//---------------------------------------------------------------------------------------
if( !function_exists('DirectAction') ) {
	function DirectAction()  {
		return array('1' => 'Duplicate', '2' => 'Replace');
	}
 }   

//---------------------------------------------------------------------------------------
if( !function_exists('MethodeAction') ) {
	function MethodeAction()  {
		return array('1' => 'Direct', '2' => 'Manual');
	}
 }   
 
//---------------------------------------------------------------------------------------
 if( !function_exists('CampaignOrder') ) 
{
	function CampaignOrder()  {
		$ObjectUtility =& ObjectUtility();
		return $ObjectUtility->_get_campaign_code_number();
	}
 }   
 
//---------------------------------------------------------------------------------------
 if( !function_exists('CampaignAvailable') ) 
{
	function CampaignAvailable( $Out = 2 )  {
		$Output =& ObjectCampaign();
		return $Output->_getCampaignGoals( $Out );
	}
 }   
   
 //--------------------------------------------------------------------------------------- 
  if( !function_exists('ProductPlanName') )
 {
	function ProductPlanName( $ProductId  = null )  
	{
		$Output =& Dropdown();
		return $Output->_getProductPlanName( $ProductId );
	} 
 }
 
  //--------------------------------------------------------------------------------------- 
  if( !function_exists('UserPrivilege') )
 {
	function UserPrivilege()  
	{
		$Output =& Dropdown();
		return $Output->_getUserPrivilege();
	} 
 }
 
 //--------------------------------------------------------------------------------------- 
  if( !function_exists('AllUser') )
 {
	function AllUser( $val = null )  
	{
		$Output =& Dropdown();
		$list = $Output->_getAllUser();
		if( is_null($val) ){
			return $list;
		}
		
		if( !strcmp( $val, 0) ){
			return "";
		}
		return $list[$val];
		
	} 
 }
 
//--------------------------------------------------------------------------------------- 
  if( !function_exists('DitributeMode') )
 {
	function DitributeMode()  
	{
		$Output =& ObjectAssigment();
		return $Output->DistribusiMode();
	} 
 }
 
 //--------------------------------------------------------------------------------------- 
  if( !function_exists('DitributeUserLevel') )
 {
	function DitributeUserLevel()  
	{
		$Output =& ObjectAssigment();
		return $Output->getLevelUser();
	} 
 }
 
  //--------------------------------------------------------------------------------------- 
  if( !function_exists('PullDataLevelUser') )
 {
	function PullDataLevelUser()  
	{
		$Output =& ObjectAssigment();
		return $Output->getLevelUserPullData();
	} 
 }
 //--------------------------------------------------------------------------------------- 
  if( !function_exists('DistribusiType') )
 {
	function DistribusiType()  
	{
		$Output =& ObjectAssigment();
		return $Output->DistribusiType();
	} 
 }
 
 // -------------------------------------
 
 //--------------------------------------------------------------------------------------- 
  if( !function_exists('DistribusiAction') )
 {
	function DistribusiAction()  
	{
		$Output =& ObjectAssigment();
		return $Output->DistribusiAction();
	} 
 }
 
 
  // -------------------------------------
 
 //--------------------------------------------------------------------------------------- 
  if( !function_exists('UserAssignLevel') )
 {
	function UserAssignLevel( $AssignId  = 0 )  
	{
		$Output =& ObjectAssigment();
		return $Output->_select_row_assign_level( $AssignId );
	} 
 }
 
 
 //--------------------------------------------------------------------------------------- 
  if( !function_exists('LayoutThemes') )
 {
	function LayoutThemes()  
	{
		$Output =& Dropdown();
		return $Output->_getLayoutThemes();
	} 
 }
  
 //--------------------------------------------------------------------------------------- 
  if( !function_exists('QualityStaffScoreReg') )
 {
	function QualityStaffScoreReg()  
	{
		$Output =& Dropdown();
		return $Output->_getQualityScoreStaff();
	} 
 }
  
 //--------------------------------------------------------------------------------------- 
  if( !function_exists('QualityAllStaff') )
 {
	function QualityAllStaff()  
	{
		$Output =& Dropdown();
		return $Output->_getQualityAllStaff();
	} 
 }
 
  //--------------------------------------------------------------------------------------- 
  if( !function_exists('Leader') )
 {
	function Leader()  
	{
		$Output =& Dropdown();
		return $Output->_getTeamLeader();
	} 
 }
 
    //--------------------------------------------------------------------------------------- 
  if( !function_exists('ATMLeader') )
 {
	function ATMLeader()  
	{
		$Output =& Dropdown();
		return $Output->_getATMTeamLeader();
	} 
 }
 
 
 
   //--------------------------------------------------------------------------------------- 
  if( !function_exists('QualitySkill') )
 {
	function QualitySkill()  
	{
		$Output =& Dropdown();
		return $Output->_getQualitySkill();
	} 
 }
    
  
   //--------------------------------------------------------------------------------------- 
  if( !function_exists('AllUserIdByLevel') )
  {
	function AllUserIdByLevel( $level = null ) 
	{
		$Output =& Dropdown();
		return $Output->_getAllUserIdByLevel( $level );
	} 
  }
  
     //--------------------------------------------------------------------------------------- 
  if( !function_exists('ListHour') )
  {
	function ListHour() 
	{
		$Output =& Dropdown();
		return $Output->_getListHour();
	} 
  }
  
       //--------------------------------------------------------------------------------------- 
  if( !function_exists('ListMinute') )
  {
	function ListMinute() 
	{
		$Output =& Dropdown();
		return $Output->_getListMinute();
	} 
  }
  
  
      //--------------------------------------------------------------------------------------- 
  if( !function_exists('ProductGroupPremi') )
  {
	function ProductGroupPremi( $ProductId = 0  ) 
	{
		$Output =& Dropdown();
		return $Output->_getProductGroupPremi( $ProductId );
	} 
  }
  
       //--------------------------------------------------------------------------------------- 
  if( !function_exists('ProductGender') )
  {
	function ProductGender( $ProductId  = 0 ) 
	{
		$Output =& Dropdown();
		return $Output->_getProductGender( $ProductId );
	} 
  }
  
  //--------------------------------------------------------------------------------------- 
  if( !function_exists('QualityStatus') )
  {
	function QualityStatus() 
	{
		$Output =& Dropdown();
		return $Output->_getQualityStatus();
	} 
  } 
   //--------------------------------------------------------------------------------------- 
  if( !function_exists('QualityParentStatus') )
  {
	function QualityParentStatus( $Qualitystatus  = 0 ) 
	{
		$Output =& Dropdown();
		return $Output->_getQualityParentStatus( $Qualitystatus  );
	} 
  } 
  
  
  
   //--------------------------------------------------------------------------------------- 
  if( !function_exists('QualityReason') )
  {
	function QualityReason( $ParentId = 0 ) 
	{
		$Output =& Dropdown();
		return $Output->_getQualityReason( $ParentId );
	} 
  } 
  
     //--------------------------------------------------------------------------------------- 
  if( !function_exists('ProductType') )
  {
	function ProductType() 
	{
		$Output =& Dropdown();
		return $Output->_getProductType();
	} 
  } 
  
     //--------------------------------------------------------------------------------------- 
  if( !function_exists('Sponsor') )
  {
	function Sponsor() 
	{
		$Output =& Dropdown();
		return $Output->_getSponsor();
	} 
  } 
   
   
       //--------------------------------------------------------------------------------------- 
  if( !function_exists('ProductCurrency') )
  {
	function ProductCurrency() 
	{
		$Output =& Dropdown();
		return $Output->_getProductCurrency();
	} 
  } 
      //--------------------------------------------------------------------------------------- 
  if( !function_exists('CtiSkill') )
  {
	function CtiSkill() 
	{
		$Output =& Dropdown();
		return $Output->_getCtiSkill();
	} 
  } 
  
  //--------------------------------------------------------------------------------------- 
  if( !function_exists('CallDuration') )
  {
	function CallDuration( $CustomerId = 0 ) 
	{
		$Output =& Dropdown();
		return $Output->_getCallDuration( $CustomerId );
	} 
  } 
  
    //--------------------------------------------------------------------------------------- 
  if( !function_exists('CallDuration') )
  {
	function CallDuration( $CustomerId = 0 ) 
	{
		$Output =& Dropdown();
		return $Output->_getCallDuration( $CustomerId );
	} 
  } 
  
   //--------------------------------------------------------------------------------------- 
  if( !function_exists('FieldValue') )
  {
	function FieldValue() 
	{
		$Output =& Dropdown();
		return $Output->_getFieldValue();
	} 
  } 
  
     //--------------------------------------------------------------------------------------- 
  if( !function_exists('CallResultNotInterest') )
  {
	function CallResultNotInterest() 
	{
		$Output =& Dropdown();
		return $Output->_getCallResultNotInterest();
	} 
  }
  
  if( !function_exists('CallResultNotInterestPDS') )
  {
	function CallResultNotInterestPDS() 
	{
		$Output =& Dropdown();
		return $Output->_getCallResultNotInterestPDS();
	} 
  } 
  
  //--------------------------------------------------------------------------------------- 
  if( !function_exists('CallResultNotInterestThinkingBadlead') )
  {
	function CallResultNotInterestThinkingBadlead() 
	{
		$Output =& Dropdown();
		return $Output->_getCallResultNotInterestThinkingBadlead();
	} 
  } 
  
    //--------------------------------------------------------------------------------------- 
  if( !function_exists('CallResultNotInterestBadlead') )
  {
	function CallResultNotInterestBadlead() 
	{
		$Output =& Dropdown();
		return $Output->_getCallResultNotInterestBadlead();
	} 
  }
  
  //--------------------------------------------------------------------------------------- 
  if( !function_exists('CallResultAll') )
  {
	function CallResultAll()
	{
		$Output =& Dropdown();
		return $Output->_getAllCallResult();
	} 
  }
  
   //--------------------------------------------------------------------------------------- 
  if( !function_exists('CallResultThinking') )
  {
	function CallResultThinking() 
	{
		$Output =& Dropdown();
		return $Output->_getCallResultThinking();
	} 
  } 
  
  if( !function_exists('CallResultAuto') )
  {
	function CallResultAuto() 
	{
		$Output =& Dropdown();
		return $Output->_getCallResultAuto();
	} 
  } 
  
      //--------------------------------------------------------------------------------------- 
  if( !function_exists('SelectFilterBy') )
  {
	function SelectFilterBy() 
	{
		$Output =& Dropdown();
		return $Output->_getSelectFilterBy();
	} 
  } 
  
  //--------------------------------------------------------------------------------------- 
  if( !function_exists('CallResultInterest') )
  {
	function CallResultInterest() 
	{
		$Output =& Dropdown();
		return $Output->_getCallResultInterest();
	} 
  } 
  
    //--------------------------------------------------------------------------------------- 
  if( !function_exists('FilterValue') )
  {
	function FilterValue() 
	{
		$Output =& Dropdown();
		return $Output->_getFilterValue();
	} 
  } 
  
 //--------------------------------------------------------------------------------------- 
  if( !function_exists('Enum') )
  {
	function Enum()  {
		return array('0' => 'NO', '1' => 'YES');
	} 
  } 
  
 //--------------------------------------------------------------------------------------- 
  if( !function_exists('ExpiredPeriode') )
  {
	function ExpiredPeriode()  
	{
		$arr = array();
		for( $var =1;  $var <=36; $var++ )
		{
			if( strlen($var) == 1 ){ 
				$list = "0$var"; 
			} else {
				$list = "$var";
			}
			$arr[$list] = "$list Month";
		}
		return $arr;
	} 
  } 
// ----------------------- premi type ---------------------------
if(!function_exists('PremiType') )
{
 function PremiType()
 {
	$Output =& Dropdown(); 
	return $Output->_getPremiType();
 }
}	
  
 /* GET CONFIGURATION */
 if(!function_exists('_getConfigValue') )
{
 function _getConfigValue($_code=null,$_name=null)
 {
	$Output =& Dropdown(); 
	$_back = $Output->_getConfiguration($_code,$_name);
	return (!is_null($_name)?$_back[$_name]:$_back);
 }
} 
 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  

if( !function_exists('callDisagreeID') )
{
	function callDisagreeID( $val1 = 0, $val2 = 0  ) {
		$Output =& Dropdown();
		return $Output->_getDisagreeData( $val1, $val2 );
	} 
} 

 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
if( !function_exists('_getDisagree') )
{
	function _getDisagree($_cmp=null) 
	{
		$Output =& Dropdown();
		return $Output->_getDisagree($_cmp);
	} 
} 
 
if( !function_exists('_getApproveStatusQA') )
{
	function _getApproveStatusQA() 
	{
		$Output =& Dropdown();
		return $Output->_getApproveStatusQA();
	} 
} 

if( !function_exists('_getApproveStatusTMR') )
{
	function _getApproveStatusTMR() 
	{
		$Output =& Dropdown();
		return $Output->_getApproveStatusTMR();
	} 
} 

if( !function_exists('_getApprovalParam') )
{
	function _getApprovalParam($_cmp=null) 
	{
		$Output =& Dropdown();
		return $Output->_getApprovalParam($_cmp);
	} 
} 

if(!function_exists('_getRecordingByCust') ) 
{
	function _getRecordingByCust( $cust_id = 0 ) 
	{
		$_datas = array();
		$UI =& get_instance();
		
		/* $sql = "select b.* from t_gn_callhistory a
				inner join cc_recording b on a.CallSessionId = b.session_key
				where a.CustomerId = '".$cust_id."'"; */
		$sql = "select b.* from cc_recording b
				where b.assignment_data = '".$cust_id."'";
		// echo $sql;
		$qry = $UI->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			$_datas = $qry->result_assoc();
		}
		
		return $_datas;
	}
}

// --------------------------------------------------------------------
/**
 * Custom query result.
 *
 * @param class_name A string that represents the type of object you want back
 * @return array of objects
 */
	 
if( !function_exists('CallDisposition') ){
	function CallDisposition( $dispositionID = null ){
		$Output =& Dropdown();
		return $Output->_getCallDisposition( $dispositionID);
	}
}

if( !function_exists('callStatusAutoDial') )
{
	function callStatusAutoDial() 
	{
		$Output =& Dropdown();
		return $Output->_getCallStatusAutoDial();
	} 
}

//---------------------------------------------------------------------------------------
if( !function_exists('CampaignIdPds') ) {
	function CampaignIdPds() {
		$Dropdown =& Dropdown();
		return $Dropdown->_getCampaignPds();
	}
} 


 // Commit b73f81a1db5023ca9080ec9a0c3398daf3ef38f2 23 januari 2020
if( !function_exists('AccStatus') ) {
	function AccStatus( $val = null ) {
		$Dropdown =& Dropdown();
		$arr = $Dropdown->_getAccStatus();
		if( is_null($val) ){
			return $arr;
		}
		return $arr[$val];
	}
 } 
 // end Commit b73f81a1db5023ca9080ec9a0c3398daf3ef38f2 23 januari 2020


// ============== END HELPER DROPDOWN =============================================

?>