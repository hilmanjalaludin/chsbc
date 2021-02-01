<?php ?>
<script>

// -------------------------------------------------------------------
// -------------------------------------------------------------------
Ext.DOM.SaveTarget = function()
{
	Ext.Ajax
	({
		url 	: Ext.EventUrl(["SetCampaign","SaveTarget"]).Apply(), 
		method 	: 'POST',
		param 	: Ext.Serialize('frm_campaign_target').getElement(),
		ERROR   : function(e){
			Ext.Util(e).proc(function(response) {
				if( response.success == 1 ) {
					Ext.Msg("Update Target").Success(); 
					return false;
				} else {
					Ext.Msg("Update Target").Failed();
					return false;
				}		
			});
		}
	}).post();
}	

// ----------------------------------------------------------------
Ext.DOM.getMethod = function(combo){
	if(combo.value==1) {
		Ext.Cmp('DirectAction').disabled(false);
		Ext.Cmp('AvailCampaignId').disabled(false);
	}
	else{
		Ext.Cmp('DirectAction').setValue('');
		Ext.Cmp('AvailCampaignId').setValue('');
		Ext.Cmp('DirectAction').disabled(true);
		Ext.Cmp('AvailCampaignId').disabled(true);
	}
}

// ----------------------------------------------------------------
Ext.DOM.getDirect = function( obj )
{
	if( obj.value ==1 ){
		Ext.Cmp('DirectMethod').disabled(false);
		Ext.Cmp('DirectAction').disabled(true);
		Ext.Cmp('AvailCampaignId').disabled(false);
		Ext.Cmp('DirectMethod').setValue(1);
		Ext.Cmp('DirectAction').setValue(1);
	}
	else{
		Ext.Cmp('DirectMethod').setValue('');
		Ext.Cmp('DirectAction').setValue('');
		Ext.Cmp('AvailCampaignId').setValue('');
		Ext.Cmp('DirectMethod').disabled(true);
		Ext.Cmp('DirectAction').disabled(true);
		Ext.Cmp('AvailCampaignId').disabled(true);
	}	
}


// ----------------------------------------------------------------
// product listener data  
Ext.DOM.Product = function() {
	var _Product = {
		Entry : function() {
			Ext.options ({ 
				fo : Ext.Cmp('ProductId').getElementId(),
				to : Ext.Cmp('ListProduct').getElementId() 
			}).move();
		}, Delete : function(){
			Ext.options ({
				fo : Ext.Cmp('ListProduct').getElementId(),
				to : Ext.Cmp('ProductId').getElementId() 
			}).move();
		}
	}
	
	return ( _Product ? _Product : { } );
}

Ext.DOM.PaymentChannel  = function(){
	var _PaymentChannel = {
		Entry : function(){
			Ext.options ({ 
				fo : Ext.Cmp('PaymentChannel').getElementId(),
				to : Ext.Cmp('ListPaymentChannel').getElementId() 
			}).move();
			
		}, Delete : function(){
			Ext.options ({
				fo : Ext.Cmp('ListPaymentChannel').getElementId(),
				to : Ext.Cmp('PaymentChannel').getElementId() 
			}).move();
		}
	}
	return ( _PaymentChannel ? _PaymentChannel : { } );
}

Ext.DOM.RoleBack = function(){
	if( Ext.Msg('Are you sure ?').Confirm() ){
		Ext.ShowMenu("SetCampaign/campaignPds", Ext.System.view_file_name());	
	}
}

Ext.DOM.Update = function()
{
	var frmAddCampaign = Ext.Serialize('frm_edit_campaign'),
	 conds = frmAddCampaign.Complete([
		'ProductId', 'PaymentChannel',
		'AvailCampaignId', 'DirectMethod',
		'StatusActive', 'DirectAction'
	]);
	
	// --- check completed form ----------------------------------------
	if( !conds ){ 
		Ext.Msg("Input form not complete!").Info(); 
		return false; 
	}
	
	// --- check process  form ----------------------------------------
	Ext.Ajax
	({
		url 	: Ext.EventUrl(["SetCampaign","Update"]).Apply(),
		method 	: 'POST',
		param 	: Ext.Join([ 
					frmAddCampaign.getElement() 
			]).object(),
			
		ERROR : function(e)
		{
			Ext.Util(e).proc(function(response) {
				if( response.success == 1 ) {
					Ext.Msg("Update Campaign").Success(); 
					return false;
				} else {
					Ext.Msg("Update Campaign").Failed();
					return false;
				}		
			});
		}
			
	}).post()
}

	
Ext.DOM.Submit = function()
{
	var frmAddCampaign = Ext.Serialize('frm_add_campaign_pds');
	var result= false;
	var field = ['CampaignNumber', 'CampaignName','CampaignCode', 'CampaignDesc','ListGroupCampaign','CampaignCallLimit',,'StartDate','ExpiredDate','CampaignCallFactor',
	'CampaignAbandonRate','CampaignCallWait','CampaignCallRetry','ListCampaignCallPrefarance','StatusActive'];
	var chosen;
	$.each( field, function( key, value ) {
		if( Ext.Cmp(value).getValue() == "" ) {
			$("#"+value).css('border','1px solid red');
			chosen ="#"+value+"_chosen"; 
			$(chosen).css('border','1px solid red');
			result = true;
		}
	});
	// if( result ) {
	// 	Ext.Msg("Input form not complete!").Info();
	// 	return false;
	// }

	// --- check process  form ----------------------------------------
	Ext.Ajax
	({
		url 	: Ext.EventUrl(["SetCampaign","submitPds"]).Apply(),
		method 	: 'POST',
		param 	: Ext.Join([ 
					frmAddCampaign.getElement(),
					{ListCampaignCallPrefarance:$("#ListCampaignCallPrefarance").val()}
			]).object(),
			
		ERROR : function(e)
		{
			Ext.Util(e).proc(function(response) {
				if( response.success == 1 )
				{
					Ext.Msg("Add Campaign PDS").Success();
					if( Ext.Msg('Do you want to add Again ?').Confirm() ) {
						Ext.ShowMenu(new Array('SetCampaign','addPds'), 
							Ext.System.view_file_name(), {
								time : Ext.Date().getDuration()
						});	
					}
					return false;
				} else {
					Ext.Msg("Add Campaign").Failed();
				}		
			});
		}
			
	}).post()
}

Ext.DOM.CampaignCallPrefarances  = function(){
	var _CampaignCallPrefarance = {
		Entry : function(){
			Ext.options ({ 
				fo : Ext.Cmp('CampaignCallPrefarance').getElementId(),
				to : Ext.Cmp('ListCampaignCallPrefarance').getElementId() 
			}).move();
			
		}, Delete : function(){
			Ext.options ({
				fo : Ext.Cmp('ListCampaignCallPrefarance').getElementId(),
				to : Ext.Cmp('CampaignCallPrefarance').getElementId() 
			}).move();
		}
	}
	return ( _CampaignCallPrefarance ? _CampaignCallPrefarance : { } );
}

Ext.DOM.Group  = function(){
	var _Group = {
		Entry : function(){
			Ext.options ({ 
				fo : Ext.Cmp('GroupCampaign').getElementId(),
				to : Ext.Cmp('ListGroupCampaign').getElementId() 
			}).move();
			
		}, Delete : function(){
			Ext.options ({
				fo : Ext.Cmp('ListGroupCampaign').getElementId(),
				to : Ext.Cmp('GroupCampaign').getElementId() 
			}).move();
		}
	}
	return ( _Group ? _Group : { } );
}

Ext.DOM.UpdatePds = function()
{
	var frmAddCampaign = Ext.Serialize('frm_edit_campaign_pds');
	var result = false;
	var field  = ['CampaignNumber', 'CampaignName','CampaignCode', 'CampaignDesc','ListGroupCampaign','CampaignCallLimit','CampaignCallFactor','CampaignAbandonRate','CampaignCallWait','CampaignCallRetry','ListCampaignCallPrefarance','StatusActive'];
	var chosen;
	
	$.each( field, function( key, value ) {
		if( Ext.Cmp(value).getValue() == "" ) {
			$("#"+value).css('border','1px solid red');
			chosen ="#"+value+"_chosen"; 
			$(chosen).css('border','1px solid red');
			result = true;
		}
	});
	if( result ) {
		Ext.Msg("Input form not complete!").Info();
		return false;
	}
	
	Ext.Ajax
	({
		url 	: Ext.EventUrl(["SetCampaign","UpdatePds"]).Apply(),
		method 	: 'POST',
		param 	: Ext.Join([frmAddCampaign.getElement()]).object(),
		ERROR : function(e)
		{
			Ext.Util(e).proc(function(response) {
				if( response.success == 1 ) {
					Ext.Msg("Update Campaign").Success(); 
					return false;
				} else {
					Ext.Msg("Update Campaign").Failed();
					return false;
				}		
			});
		}
			
	}).post()
}

// ----------------------------------------------------------------
// document ready   
$(document).ready( function()
{
	var date = new Date();
  	$('#ui-widget-add-campaign').mytab().tabs();
  	$('#ui-widget-add-campaign').mytab().tabs("option", "selected", 0);
  	$('#ui-widget-add-campaign').css({'background-color':'#FFFFFF'});
  	$('#ui-widget-add-content').css({'background-color':'#FFFFFF'});
  
  	$("#ui-widget-add-campaign").mytab().close(function(){
  		Ext.DOM.RoleBack();
  	});
  
   	$("#ExpiredDate").datepicker 
   	({
		showOn : 'button',  
		buttonImage	: Ext.DOM.LIBRARY +'/gambar/calendar.gif', 
		buttonImageOnly: true,
		dateFormat	:'dd-mm-yy',changeMonth: true,changeYear: true, yearRange:date.getFullYear()+':3000'
	});
	
	$("#StartDate").datepicker ({
		showOn : 'button',  
		buttonImage	: Ext.DOM.LIBRARY +'/gambar/calendar.gif', 
		buttonImageOnly: true,
		dateFormat	:'dd-mm-yy',changeMonth: true,changeYear: true,yearRange:date.getFullYear()+':3000'
	});
	
	Ext.DOM.Group().Entry();
	Ext.DOM.CampaignCallPrefarances().Entry();
	
});

</script>