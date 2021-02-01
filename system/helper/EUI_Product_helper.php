<?php 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
 class EUI_Product 
{
 
 private static $Instance = null;

 
 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
  public static function &Instance() 
 {
	 if( is_null(self::$Instance) )
	{
		 self::$Instance = new self();
	} 
	return self::$Instance;
 }
 
 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
  public function Attr()
 {
	 
	$out =& call_object_product();
	$ProductId = call_product_id();
	return $out->_select_row_ref_product($ProductId);
 }
 
 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
  public function GroupPremi() 
 {
	$arr_object = $this->Attr();
	return (array)$arr_object->get_value('GroupPremi');
	 
  }
  
 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
  public function ProductType() 
{
	$arr_object = $this->Attr();
	return (array)$arr_object->get_value('ProductType');
  } 
  
  //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
  public function ProductName() 
{
	$arr_object = $this->Attr();
	return $arr_object->get_value('Product')->get_value('ProductName');
  } 
   
/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
  public function AgeStart() 
{
	$arr_object = $this->Attr();
	return $arr_object->get_value('Product')->get_value('start','intval');
  } 
  
/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
  public function Currency() 
{
	$arr_object = $this->Attr();
	return (string)$arr_object->get_value('Product')->get_value('ProductCurrency','strval');
  } 
    
  
 /* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
  public function AgeEnd() 
{
	$arr_object = $this->Attr();
	return $arr_object->get_value('Product')->get_value('end','intval');
  } 
   
//---------------------------------------------------------------------------------------   
 /* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
  public function Sponsor() 
{
	$arr_object = $this->Attr();
	return $arr_object->get_value('Product')->get_value('ProductSponsor');
  }   
  
//---------------------------------------------------------------------------------------  
 /* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
  public function Benfiecery() 
{
	$arr_object = $this->Attr();
	return $arr_object->get_value('Product')->get_value('ProductBeneficieryFlag');
  }  

//---------------------------------------------------------------------------------------  
 /* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
  public function Underwriting() 
{
	$arr_object = $this->Attr();
	return $arr_object->get_value('Product')->get_value('ProductUWFlag');
  }   

//---------------------------------------------------------------------------------------
/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
  public function ExpiredPeriode() 
{
	$arr_object = $this->Attr();
	return $arr_object->get_value('Product')->get_value('ProductExpirePeriode');
  }       
   //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
  public function ProductCode() 
{
	$arr_object = $this->Attr();
	return $arr_object->get_value('Product')->get_value('ProductCode');
  } 
  
   //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
  public function ProductPrefix() 
{
	$arr_object = $this->Attr();
	return $arr_object->get_value('Product')->get_value('PrefixChar');
  } 
  
  //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
  public function PayMode() 
{
	$arr_object = $this->Attr();
	return (array)$arr_object->get_value('PaymentType');
  } 
  
  
 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
  public function Gender() 
{
	$arr_object = $this->Attr();
	 return (array)$arr_object->get_value('Gender');
  } 
  
 // -------------------- end class --------------------------------------------
}

// ======================================================================================


//---------------------------------------------------------------------------------------
/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */ 

 if( !function_exists('call_object_product') )
{
	function call_object_product() 
 {
	$UI =& get_instance();
	$UI->load->model(array("M_ModViewPlan"));
	return get_class_instance('M_ModViewPlan');
 }
 
} 
 
//---------------------------------------------------------------------------------------
/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */ 
 
 if( !function_exists('call_premi_function') )
{
	function call_premi_function( $arr_data = null ) 
 {
	$objClass =& call_object_product();
	return $objClass->_select_row_product_premi( $arr_data );
 }
} 


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
 
if( !function_exists('call_open_function') )
{
	function call_open_function()
 {
	$out =& call_object_product();
	$obClass = $out->_select_row_ref_product(_get_post('ProductId'));
	 if( !is_object( $obClass ) )	
	{
		return null;
	}
	
// ----------- get all reference  ----------------------------	
	$ProductPlan = $obClass->get_value('PlanName');
	$PaymentType = $obClass->get_value('PaymentType');
	$GroupPremi = $obClass->get_value('GroupPremi');
	$ProductAge = $obClass->get_value('ProductAge');
	$Gender = $obClass->get_value('Gender');
	
	if(is_array( $PaymentType ) ) 
		foreach( $PaymentType as $PaymentId => $PaymentName )
	{
		echo "<fieldset class=\"corner\" style=\"margin:10px;\">
				<legend>{$PaymentName}</legend>";	
				
			if( is_array( $GroupPremi )) 
				foreach( $GroupPremi as $GroupPremiId => $GroupPremiName ) 
			{
				echo "<div class=\"ui-widget-form-table\" style=\"margin:10px;\">";
				echo "<fieldset class=\"corner\" style=\"margin:0px 0px 10px 0px;padding:8px;\">
						<legend>{$GroupPremiName}</legend>";
						
						if(is_array( $Gender ) )
							foreach( $Gender as $GenderId => $GenderName  ) 
						{
							$arr_form = "frm_{$PaymentId}_{$GroupPremiId}_{$GenderId}";
							echo "<form name=\"{$arr_form}\">";
							echo "<fieldset class=\"corner\" style=\"margin:10px 0px 10px 0px;padding:0px 20px 10px 2px;\">
								<legend>{$GenderName}</legend>";
								echo "<div class=\"ui-widget-form-table table-body-content\">
										<div class=\"ui-widget-form-row ui-widget-header table-row-header\"> 
											<div class=\"ui-widget-form-cell ui-corner-top table-cell-header center\" >AGE PERIODE</div>";
											
											if(is_array($ProductPlan) )
												foreach($ProductPlan as $PlanId => $PlanName ) {
												echo "<div class=\"ui-widget-form-cell ui-corner-top table-cell-header center\"> 
													$PlanName </div> ";
											}
										echo "</div>";
										
								if(is_array( $ProductAge ) ) 
									foreach( $ProductAge as $sf => $row )
								{
									$out = new EUI_Object($row);
									$cols_id = "{$PaymentId}_{$GroupPremiId}_{$GenderId}_{$out->get_value('start')}_{$out->get_value('end')}";
									echo "<div class=\"ui-widget-form-row\"> 
											<div class=\"ui-widget-form-cell table-cell-content left\">
												<input type=\"text\" id=\"start_{$cols_id}\" name=\"start_{$cols_id}\" class=\"input_text box small right dsbl\" value=\"". (int)$out->get_value('start') ."\"> &nbsp;-&nbsp;
												<input type=\"text\" id=\"end_{$cols_id}\" name=\"end_{$cols_id}\" class=\"input_text box small right dsbl\" value=\"". (int)$out->get_value('end') ."\">
											</div>";	
											
											if(is_array( $ProductPlan) )
												foreach( $ProductPlan as $PlanId => $PlanName )
											{
											// ---------------- select on data row -----------------------------------	
												$output =& call_premi_function(array (
													'ProductPlanAgeStart' => $out->get_value('start'),
													'ProductPlanAgeEnd' => $out->get_value('end'),
													'PremiumGroupId' => $GroupPremiId, 
													'ProductId' => $out->get_value('ProductId'),
													'ProductPlan' => $PlanId,
													'PayModeId' => $PaymentId,
													'GenderId'	=> $GenderId
												));
												
												$ivo_value = "row_{$output->get_value('ProductPlanId')}";
												echo "<div class=\"ui-widget-form-cell table-cell-content left\">
														<input type=\"text\" id=\"{$ivo_value}\" name=\"{$ivo_value}\" class=\"input_text box right\" value=\"{$output->get_value('ProductPlanPremium', '_getCurrency')}\">
													</div>";		
											}
									echo "</div>";		
								}
								
							  echo "</div>".
									"</fieldset>".
									"</form>".
									"<div style=\"margin-left:5px;\">".  
										form()->button("$arr_form", "button update", lang(array("Update","Premi")), array("click" => "Ext.DOM.UpdatePremi(this);"))."</div>";
						}
							
					echo "</fieldset>";
					echo "</div>";
			}	
				
		echo "</fieldset>";		
	}
 }
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  

 if( !function_exists('call_product_plan') )
{
	function call_product_plan() 
{		
	$out =& call_object_product();
	$obClass = $out->_select_row_ref_product(_get_post('ProductId'));
	return  $obClass->get_value('PlanName');	
 }
 
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  

 if( !function_exists('call_product_name') )
{
	function call_product_name() 
{		
	$out =& call_object_product();
	return (string)$out->_select_row_product_name(_get_post('ProductId'));
 }
 
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  

 if( !function_exists('call_product_id') )
{
	function call_product_id() 
{	
	$out = new EUI_Object( _get_all_request() );	
	return $out->get_value('ProductId', 'intval');
	
 }
 
 }		
 
 
 //---------------------------------------------------------------------------------------
/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */ 

 if( !function_exists('def') )
{
	function def() 
 {
	return EUI_Product::Instance();
 }
 
} 
 
?>