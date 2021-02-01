<?php ?>
<script>
/**
 ** javscript prototype system
 ** version v.0.1
 **/ 
Ext.DOM.onload = (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 })(); 
 
$(document).ready(function()
{
	$('#ui-widget-add-campaign').mytab().tabs();
	$('#ui-widget-add-campaign').mytab().tabs("option", "selected", 0);
	$('#ui-widget-add-campaign').css({'background-color':'#FFFFFF'});
	$('#ui-widget-add-content').css({'background-color':'#FFFFFF'});
	$("#ui-widget-add-campaign").mytab().close({}, true);
	  
	Ext.Cmp("slectPhone").listener
	({
		onChange : function(e) {
			Ext.Util(e).proc( function(items)
			{
				if( items.value=='CustomerHomePhoneNum'){
					Ext.Cmp('CustomerHomePhoneNum').setValue(Ext.Cmp('PhoneNumber').getValue());
					Ext.Cmp('CustomerWorkPhoneNum').setValue('');
					Ext.Cmp('CustomerMobilePhoneNum').setValue('');
				}
				
				if( items.value=='CustomerWorkPhoneNum'){
					Ext.Cmp('CustomerWorkPhoneNum').setValue(Ext.Cmp('PhoneNumber').getValue());
					Ext.Cmp('CustomerHomePhoneNum').setValue('');
					Ext.Cmp('CustomerMobilePhoneNum').setValue('');
				}
				
				if( items.value=='CustomerMobilePhoneNum'){
					Ext.Cmp('CustomerMobilePhoneNum').setValue(Ext.Cmp('PhoneNumber').getValue());
					Ext.Cmp('CustomerHomePhoneNum').setValue('');
					Ext.Cmp('CustomerWorkPhoneNum').setValue('');
				}
			});
		}
	})
	
	Ext.ActiveMenu().NotActive();
	$('.xselect').chosen();
}); 


/**
 ** javscript prototype system
 ** version v.0.1
 **/ 
 
 
Ext.DOM.SaveData = function( CallReasonId ){
 if( !Ext.Cmp('CallSessionId').empty() && CallReasonId!='' )
 {
	var VAR_POST = [];
		VAR_POST['CallReasonId'] = CallReasonId;
		
	Ext.Ajax 
	({
		url 	: Ext.DOM.INDEX +'/ModFormInbound/SaveInbound/',
		method  : 'POST',
		param   : Ext.Join([
					  Ext.Serialize("frmCallInbound").getElement(),
					  VAR_POST
				  ]).object(),
					
		ERROR 	: function(e) {
			Ext.Util(e).proc(function( response ){
				if( response.success )  {
					Ext.Msg("Data Entry Incoming").Success();
					Ext.Serialize("frmCallInbound").Clear();
					Ext.ActiveMenu().Active();
				}
				else{
					Ext.Msg("Data Entry Incoming").Success();
				}
			});
		}
  }).post();
 }
else { Ext.Msg('No Call Session ').Info(); }
}



</script>


<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-document"></span>&nbsp;<span id="ui-widget-title"></span></a>
		</li>
	</ul>	
	<div id="ui-widget-add-content"><?php get_view(array("mod_form_inbound","view_form_userinput"));?></div>
</div>	
