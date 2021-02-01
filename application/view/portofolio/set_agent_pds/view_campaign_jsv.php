<?php ?>
<script>

Ext.DOM.AssignAgentToPDSGRoup = function()
{
	// alert('asdf');
	var frm_assign_agent_pds = Ext.Serialize('frm_assign_agent_pds');
	Ext.Ajax
	({
		url 	: Ext.EventUrl(["AssignAgentPDS","Assign2Group"]).Apply(),
		method 	: 'POST',
		param 	: Ext.Join([frm_assign_agent_pds.getElement()]).object(),
		ERROR : function(e)
		{
			Ext.Util(e).proc(function(response) {
				if( response.success == 1 ) {
					Ext.Msg("Assign Agent to Group").Success(); 
					return false;
				} else {
					Ext.Msg("Assign Agent to Group").Failed();
					return false;
				}		
			});
		}
			
	}).post()
}

Ext.DOM.RollBack = function(){
	if( Ext.Msg('Are you sure ?').Confirm() ){
		Ext.ShowMenu("AssignAgentPDS/index", Ext.System.view_file_name());	
	}
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

$(document).ready( function()
{
	// var date = new Date();
  	$('#ui-widget-add-campaign').mytab().tabs();
  	$('#ui-widget-add-campaign').mytab().tabs("option", "selected", 0);
  	$('#ui-widget-add-campaign').css({'background-color':'#FFFFFF'});
  	$('#ui-widget-add-content').css({'background-color':'#FFFFFF'});
  
  	$("#ui-widget-add-campaign").mytab().close(function(){
  		Ext.DOM.RollBack();
  	});
  
   	// $("#ExpiredDate").datepicker 
   	// ({
		// showOn : 'button',  
		// buttonImage	: Ext.DOM.LIBRARY +'/gambar/calendar.gif', 
		// buttonImageOnly: true,
		// dateFormat	:'dd-mm-yy',changeMonth: true,changeYear: true, yearRange:date.getFullYear()+':3000'
	// });
	
	// $("#StartDate").datepicker ({
		// showOn : 'button',  
		// buttonImage	: Ext.DOM.LIBRARY +'/gambar/calendar.gif', 
		// buttonImageOnly: true,
		// dateFormat	:'dd-mm-yy',changeMonth: true,changeYear: true,yearRange:date.getFullYear()+':3000'
	// });

	Ext.DOM.CampaignCallPrefarances().Entry();
	
});

</script>