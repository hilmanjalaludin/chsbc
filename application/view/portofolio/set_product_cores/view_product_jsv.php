<script>


 
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 
Ext.DOM.RoleBack = function(){
	if( Ext.Msg('Are you sure ?').Confirm() ){
		Ext.BackHome();
	}
}
 
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 
Ext.DOM.setProduct = function(opts)
{
	if( opts.value==1) 
	{
		Ext.Css('text_product_plan').style({ borderColor : 'silver'});
		Ext.Css('text_product_age').style({ borderColor : 'silver'});
		Ext.Cmp('paymode').disabled(true);
		Ext.Cmp('GroupPremi').disabled(true);
		Ext.Cmp('text_product_plan').disabled(true);
		Ext.Cmp('text_product_age').disabled(true);
		Ext.Cmp('text_product_plan').setValue('');
		Ext.Cmp('text_product_age').setValue('');
		Ext.Cmp('paymode').setUnchecked();
		Ext.Cmp('GroupPremi').setUnchecked();
	}
	else
	{
		Ext.Css('text_product_plan').style({ borderColor : 'red'});
		Ext.Css('text_product_age').style({ borderColor : 'red'});
		Ext.Cmp('paymode').disabled(false);
		Ext.Cmp('GroupPremi').disabled(false);
		Ext.Cmp('text_product_plan').disabled(false);
		Ext.Cmp('text_product_age').disabled(false);
		Ext.Cmp('paymode').setUnchecked();
		Ext.Cmp('GroupPremi').setUnchecked();
	}
}
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 
 Ext.DOM.ShowGrid = function()
{

	Ext.Ajax
	({
		url 	: Ext.EventUrl(['SetProduct','ShowGrid']).Apply(), 
		method 	: 'POST',
		param 	: {
			ProductPlan : Ext.Cmp('text_product_plan').getValue(),
			ProductAge  : Ext.Cmp('text_product_age').getValue()
		}
	}).load('html_grid_age');

	//---------------------------------------------------------
	
	Ext.Ajax
	({
		url 	: Ext.EventUrl(['SetProduct','GridContent']).Apply(),
		method 	: 'POST',
		param 	: {
			ProductPlan : Ext.Cmp('text_product_plan').getValue(),
			ProductAge  : Ext.Cmp('text_product_age').getValue(),
			PayMode		: Ext.Cmp('paymode').getValue(),
			GroupPremi  : Ext.Cmp('GroupPremi').getValue(),
			Gender		: Ext.Cmp('GenderId').getValue()
		}
	}).load('html_grid_premi');
}
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 
Ext.DOM.setInsert = function( Type, opts )
{

var 
 PayMode 	 = Ext.Cmp('paymode').getValue(),
 GroupPremi  = Ext.Cmp('GroupPremi').getValue(),
 ProductAge  = Ext.Cmp('text_product_age').getValue(),
 ProductPlan = Ext.Cmp('text_product_plan').getValue(),
 Gender 	 = Ext.Cmp('GenderId').getValue();
 
// -- step1 : start_date  	

 if( Type.toUpperCase() =='START') 
  {
	var i = 0;
	while( i < PayMode.length )
	{
/* 
 * @ params 	: GroupPremi 
 * @ params		: PayMode
 * @ params		: Age
 * @ param		: Gender	
 */ 
		if(GroupPremi.length > 0 )
		{
			var g = 0;
			while(g< GroupPremi.length)
			{
			   if( Gender.length > 0 )
			   {	
				 for( var ux in Gender )
				 {	
					var p = []; p = opts.name.split('_');
					Ext.Cmp("start_age_"+ PayMode[i] +"_"+ GroupPremi[g]+"_"+Gender[ux]+"_"+ p[p.length-1]).setValue(opts.value);
				}	
			  }
			  else {
					var p = []; p = opts.name.split('_');
					Ext.Cmp("start_age_"+ PayMode[i] +"_"+GroupPremi[g]+"_"+p[p.length-1]).setValue(opts.value);
			  }
			g++;
		  }
	  }
/* 
 * @ params 	: GroupPremi 
 * @ params		: PayMode
 * @ params		: Age
 */
		else
		{
			var p = []; p = opts.name.split('_');
			if( Gender.length > 0 ){ 
				for( var ux in Gender ) {
					Ext.Cmp("start_age_"+PayMode[i]+"_"+Gender[ux]+"_"+p[p.length-1]).setValue(opts.value);	
				}
			}
			else{
				Ext.Cmp("start_age_"+ PayMode[i] +"_"+ p[p.length-1] ).setValue(opts.value);	
			}
		}
	   i++;
	}	
  }
  
// -- step2 : end_date 
	
 if( Type.toUpperCase() =='END') 
 {
	var i = 0;
	while( i < PayMode.length )
	{
	
/* @ params 	: GroupPremi 
 * @ params		: PayMode
 * @ params		: Age
 */
		if(GroupPremi.length > 0)
		{
			var g = 0;
			while(g < GroupPremi.length)
			{
				 if( Gender.length > 0 )
				 {
					for( var ux in Gender )
					{	 
						var p = []; p = opts.name.split('_');
						Ext.Cmp("end_age_"+ PayMode[i] +"_"+ GroupPremi[g]+"_"+Gender[ux]+"_"+p[p.length-1]).setValue(opts.value);
					}	
				 }	
				 else {
					var p = []; p = opts.name.split('_');
						Ext.Cmp("end_age_"+ PayMode[i] +"_"+ GroupPremi[g]+"_"+p[p.length-1]).setValue(opts.value);
				 }
				g++;
			}
		}
/* @ params		: PayMode
 * @ params		: Age
 */
		else
		{
			var p = []; p = opts.name.split('_');
			if( Gender.length > 0 ){ 
				for( var ux in Gender ) {
					Ext.Cmp("end_age_"+PayMode[i]+"_"+Gender[ux]+"_"+p[p.length-1]).setValue(opts.value);	
				}
			}
			else{
				Ext.Cmp("end_age_"+ PayMode[i] +"_"+ p[p.length-1] ).setValue(opts.value);	
			}
		}
		i++;
	}	
 }
}
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */

Ext.DOM.HideGrid = function(){
	Ext.Cmp('html_grid_age').setText('');
	Ext.Cmp('html_grid_premi').setText('');
}

// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */

 Ext.DOM.SaveProduct = function()
{
 var ProductSetup = Ext.Serialize("options_grid"),
	 form_age_range = Ext.Serialize("form_age_range"),
	 form_grid_content = Ext.Serialize("form_grid_content");
	 
// ------------ handle form product ------------------------------------

 var param = new Array();
	 param['ProductStatus']	= Ext.Cmp('status').getValue();	
	 param['CreditShield']  = Ext.Cmp('credit_shield_name').getValue();
	 param['ProductCores']	= Ext.Cmp('select_cmp_core').getValue();
	 param['ProductPlan']	= Ext.Cmp('text_product_plan').getValue();
	 param['ProductName']  	= Ext.Cmp('text_product_name').getValue();
	 param['ProductType']	= Ext.Cmp('select_product_type').getValue();
	 param['ProductId'] 	= Ext.Cmp('text_product_id').getValue();
	 param['GroupPremi']	= Ext.Cmp('GroupPremi').getValue();
	 param['RangeAge']		= Ext.Cmp('text_product_age').getValue();
	 param['PayMode']		= Ext.Cmp('paymode').getValue();
	 param['Gender']		= Ext.Cmp('GenderId').getValue();
	 param['Beneficiary']   = Ext.Cmp('text_beneficiary').getValue();
	 param['ExpiredPeriode']= Ext.Cmp('txt_expired_periode').getValue();
	 param['Sponsor']		= Ext.Cmp('text_sponsor').getValue();
	 param['Currency']		= Ext.Cmp('text_currency').getValue();
	 param['Underwriting']	= Ext.Cmp('text_under_writing').getValue();
	 
	 
	 
	 
// --------- check validate form data  -------------	

	if( !ProductSetup.Complete() )	{
		Ext.Msg('Form Product Not Complete!').Info();
		return false;
	}
	
// --------- check validate form data  -------------	

	if( !form_age_range.Complete() )	{
		Ext.Msg('Form Age Of Band Not Complete!').Info();
		return false;
	}	
	
	if( !form_grid_content.Complete() )	{
		Ext.Msg('Form Content Not Complete!').Info();
		return false;
	}	
	
// ------------ then send to server data ----------------------------
	
	 Ext.Ajax
	({
		url		: Ext.EventUrl(['SetProduct','SaveProduct']).Apply(),
		method 	: 'POST',
		param   : Ext.Join([ param, 
					form_age_range.getElement(), 
					form_grid_content.getElement()
				]).object(),
				
		 ERROR :function(e)  {
			Ext.Util(e).proc(function( response ){
				if( response.success  == 1){
					Ext.Msg("Add Product").Success();
				} else{
					Ext.Msg("Add Product.\nPlease check your field ").Failed();
					return false;
				}	
			});
		}
	}).post();
	
} 

//----------------------------------------------------------------------------------------
/*
 * @ package 	: document ready function 
 * 
 */
 
$(document).ready( function()
{
  
  $('#ui-widget-product').mytab().tabs();
  $('#ui-widget-product').mytab().tabs("option", "selected", 0);
  $('#ui-widget-product').css({'background-color':'#FFFFFF'});
  $('#ui-widget-add-content').css({'background-color':'#FFFFFF'});
  $('#ui-widget-upload-content').css({'background-color':'#FFFFFF'});
  $("#ui-widget-product").mytab().close(function(){ Ext.DOM.RoleBack(); }, true);
  $('.select').chosen();
});

</script>