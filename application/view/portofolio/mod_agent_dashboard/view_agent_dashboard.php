<?php echo javascript(); ?>
<script type="text/javascript">

/*
 * @ def : testing dashboard content danamon fuck's
 * -------------------------------------------------
 *
 * @ param  : public 
 * @ author : anynoumous  
 */
 
 
 
Ext.DOM.ShowByResult = function(callStatus )
{

	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/ModDashboard/Status/',
		method  : 'GET',
		param 	: {
			status : callStatus
		},
		ERROR : function(e){
			Ext.Util(e).proc(function(status){
				if( status.Sale) {
					Ext.System.view_name_url('Customer Closing');
					Ext.EQuery.Ajax ({
						url : Ext.DOM.INDEX+'/SrcCustomerClosing/index/',
						method : 'GET',
						param : {
							call_reason : callStatus
						}
					});
				}
				else{
					Ext.System.view_name_url('Customer Followup');
					Ext.EQuery.Ajax({
						url : Ext.DOM.INDEX+'/SrcCustomerList/index/',
						method : 'GET',
						param : {
							call_reason : callStatus
						}
					});
				}
			});	
		}
	}).post();
}	

/*
 * @ def : testing dashboard content danamon fuck's
 * -------------------------------------------------
 *
 * @ param  : public 
 * @ author : anynoumous  
 */
Ext.DOM.getByCampaign =function(CampaignId){
	Ext.Ajax
	({
		url : Ext.DOM.INDEX +'/ModDashboard/CallResultData',
		method :'GET',
		param :{
			CampaignId : CampaignId
		}	
	}).load("content-customer-result");
}

Ext.DOM.ShowAppoinment = function(date){
	Ext.System.view_name_url('Customer Appoinment');
	Ext.EQuery.Ajax
	({
		url : Ext.DOM.INDEX+'/SrcAppoinment/index/',
		method : 'GET',
		param :{
			date : date
		}
	});
}

/*
 * @ def : testing dashboard content danamon fuck's
 * -------------------------------------------------
 *
 * @ param  : public 
 * @ author : anynoumous  
 */
$(document).ready( function()
{
	
	
	// ----------------------------------------------------------------
// document ready   
  $('#ui-widget-add-campaign').mytab().tabs();
  $('#ui-widget-add-campaign').mytab().tabs("option", "selected", 0);
  $('#ui-widget-add-campaign').css({'background-color':'#FFFFFF'});
  $('#ui-widget-add-content').css({'background-color':'#FFFFFF'});
  
  $("#ui-widget-add-campaign").mytab().close({}, true);
  
  
  Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
	Ext.DOM.getByCampaign('');
 $('.xzselect').chosen();	
  
}); 
	
</script>

<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-image"></span>&nbsp;<span id="ui-widget-title"></span></a>
		</li>
	</ul>	
	
	<div id="ui-widget-add-content">
		<div class="ui-widget-form-table-compact" style="margin:8px 2px 15px 2px;width:99%;">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell ui-widget-content-top" style="width:40%"><?php get_view(array("mod_agent_dashboard", "view-customer-status"))?></div>
				<div class="ui-widget-form-cell ui-widget-content-top" style="width:60%"><?php get_view(array("mod_agent_dashboard", "right-layout-activity"))?></div>
			</div>
		</div>
	</div>
</div>

<!--
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-bar-chart"); ?>
</fieldset>->

