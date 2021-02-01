<script>
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
Ext.DOM.RoleBack = function() {
	if( Ext.Msg('Are you sure ?').Confirm() ){
		if( Ext.Msg('Are you sure ?').Confirm() ) {
			new Ext.BackHome();
		}
	}
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function LayoutReport() {
  $('#ui-report-tab-panel').mytab().tabs();
  $('#ui-report-tab-panel').mytab().tabs("option", "selected", 0);
  $("#ui-report-tab-panel").mytab().close(function(){ Ext.DOM.RoleBack(); }, true);
  $('.ui-widget-panel-class-tabs').css({'background-color':'#FFFFFF'});
  
  // -------- date picker  ----------------------
  $('.date').datepicker ({ 
	    showOn : 'button', buttonImage : Ext.Image("calendar.gif"),  buttonImageOnly	: true, 
		dateFormat : 'dd-mm-yy', readonly:true, changeYear:true, changeMonth:true 
  });

  
  $('#ui-widget-tabs-title').html( Ext.System.view_file_name() ); 
  
  $("#CampaignId").toogle();
  $("#ManagerId").toogle();
  $("#AtmId").toogle();
  $("#spvId").toogle();
  $("#TmrId").toogle();
  
 // $('.select').chosen();
}

 function ShowFilterReport( obj ) 
{
	if( obj.value === 'filter_campaign_group_agent' ) {
		Ext.Cmp('interval').setValue('summary');
		Ext.Cmp('interval').disabled(true);
	} 
	else if( obj.value == 'filter_campaign_group_date') {
		Ext.Cmp('interval').setValue('summary');
		Ext.Cmp('interval').disabled(true);
		
	} else {
		Ext.Cmp('interval').setValue(0);
		Ext.Cmp('interval').disabled(false);
	}	
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

function ShowReport() 
{
	var param = new Array();
		param['mode'] = "HTML";
	var frmReport = Ext.Serialize("frmReport");
	
	var cond = frmReport.Required(new Array('report_type', 'start_date', 'end_date','interval'));
	if( !cond){
		Ext.Msg("Report form not complete!").Info();	
		return false;
	}	
	
	Ext.Window
	({
		url 	: Ext.EventUrl(new Array('DataTrackingReport', 'ShowReport') ).Apply(), 
		param 	: Ext.Join( new Array( frmReport.getElement(), param) ).object()
	}).newtab();
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function ShowExcel() 
{
	var param = new Array();
		param['mode'] = "EXCEL";
	var frmReport = Ext.Serialize("frmReport");
	var cond = frmReport.Required(new Array('report_type', 'start_date', 'end_date','interval'));
	
	if( !cond){
		Ext.Msg("Report form not complete!").Info();	
		return false;
	}	
	
	Ext.Window
	({
		url 	: Ext.EventUrl(new Array('DataTrackingReport', 'ShowExcel') ).Apply(), 
		param 	: Ext.Join( new Array( frmReport.getElement(), param) ).object()
	}).newtab();
	
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function ShowAtmReportByManger( obj ) {
	var ManagerId = Ext.Cmp('ManagerId').getValue();
	$("#ui-widget-content-row2").loader ({
		url  : new Array('DataTrackingReport','ShowAtmReportByManger'),
		param : { ManagerId : ManagerId },
		complete : function( data ){
			$("#ui-widget-content-row2").attr("style", "");
			$("#AtmId").toogle();
			
			new ShowFilterReportByAtm()
			
		}
	});
	
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 function ShowFilterReportByAtm( obj )
{
	var AtmId = Ext.Cmp('AtmId').getValue();
	$("#ui-widget-content-row3").loader ({
		url  : new Array('DataTrackingReport','ShowSpvReportByAtm'),
		param : { AtmId : AtmId },
		complete : function( data ){
			$("#ui-widget-content-row3").attr("style", "");
			$("#spvId").toogle();
			new ShowAgentReportBySpv();
		}
	});
 }
 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  
 function ShowAgentReportBySpv( obj )
 {
	var SpvId = Ext.Cmp('spvId').getValue();
	$("#ui-widget-content-row4").loader ({
		url  : new Array('DataTrackingReport','ShowAgentReportBySpv'),
		param : { SpvId : SpvId },
		complete : function( data ){
			$("#ui-widget-content-row4").attr("style", "");
			$("#TmrId").toogle();
		}
	});
 }

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
$( document ).ready(function() {
	new LayoutReport();
});

</script>