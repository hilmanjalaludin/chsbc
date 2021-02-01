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
  $('.select').chosen();
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
function ShowAtmByCampaign( CampaignId, type, Class ){
	if( CampaignId=='CampaignId' ){
		Ext.Cmp(CampaignId).setChecked();
	}
	
 var filterBy = Ext.Cmp('Filter').getValue();
 Ext.Ajax 
 ({
		url 	: Ext.DOM.INDEX +'/CallTrackingReport/ShowAtmByCampaign/',
		param 	:  
		{ 
			CampaignId  : CampaignId, 
			type 		: type, 
			Class 		: Class,
			filterby 	: filterBy
		}
 }).load('ui-widget-content-row2');
 $('.select').chosen();
 
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

Ext.DOM.ShowAllAtmByCampaign = function(CampaignId){
	var data = func_get_arg();
	Ext.Cmp(CampaignId).setChecked();
	new ShowAtmByCampaign( 0, 'listCombo','select superlong');
 }
 
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function ShowByAtm( CampaignId, type, Class)
{
	var filterBy = Ext.Cmp('Filter').getValue();
	Ext.Ajax ({
		url 	: Ext.DOM.INDEX +'/CallTrackingReport/ShowByAtm/',
		param 	:  
		{ 
			CampaignId  : CampaignId, 
			type 		: type, 
			Class 		: Class,
			filterby 	: filterBy
		}
	}).load('ui-widget-content-row2');
	$('.select').chosen();
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function ShowAgentByAtm( AtmId, type, Class) 
{
	var filterBy = Ext.Cmp('Filter').getValue();
	Ext.Ajax ({
		url 	: Ext.DOM.INDEX +'/CallTrackingReport/ShowAgentByAtm/',
		param 	:  
		{ 
			AtmId 		: AtmId, 
			type 		: type, 
			Class 		: Class,
			filterby 	: filterBy
		}
	}).load('ui-widget-content-row2');
	$('.select').chosen();
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

function ShowSpvByAtm( AtmId, type , Class, div, label, text ) {
	
	Ext.Cmp(label).setText(text);
	var filterBy = Ext.Cmp('Filter').getValue();
	
	Ext.Ajax ({
		url 	: Ext.DOM.INDEX +'/CallTrackingReport/ShowSpvByAtm/',
		param 	:  
		{ 
			AtmId 		: AtmId, 
			type 	 	: type , 
			Class 	 	: Class,
			filterby 	: filterBy
		}
	}).load(div);
	
	$('.select').chosen();
}
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

 function ShowAgentBySpvId ( SpvId, type , Class, div, label, text) 
{
	Ext.Cmp(label).setText(text);
	var filterBy = Ext.Cmp('Filter').getValue();
	Ext.Ajax 
	({
		url 	: Ext.DOM.INDEX +'/CallTrackingReport/ShowAgentBySpv/',
		param 	:  
		{ 
			SpvId 		: SpvId, 
			type 	 	: type , 
			Class 	 	: Class,
			filterby 	: filterBy
		}
	}).load(div);
	$('.select').chosen();
}
 
// Ext.DOM.ShowDataCampaignId
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function ShowDataCampaignId( UserId, type , Class, label ) 
{
 var filterBy = Ext.Cmp('Filter').getValue();
	Ext.Ajax({
		url 	: Ext.DOM.INDEX +'/CallTrackingReport/ShowDataCampaignId/',
		param 	:  
		{ 
			UserId 		: UserId, 
			type 	 	: type , 
			filterby 	: filterBy
		}
	}).load(Class);
	Ext.Cmp(label).setText("Campaign Name");
	
	$('.select').chosen();
}
 
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

function GroupFilterBy( Group )
{
	
	var filter = [];
		if ( Group.value=='filter_by_campaign' )
		{
			filter['filter_by_campaign'] = ["Campaign Name","showCampaign","listCombo","CampaignId","select superlong"];
			filter['filter_by_atm'] = ["ATM Name","showATM", "combo","AtmId","select superlong"];
			filter['filter_by_spv'] = ["SPV Name","showSPV", "combo","SpvId","select superlong"];
			filter['filter_by_agent'] = ["TSR Name","showAgent","listCombo","UserId","select superlong"];
	
			$('#ui-widget-label-row1').html(filter[Group.value][0]);
			$('#ui-widget-label-row2').html(filter['filter_by_atm'][0]);
			$('#ui-widget-label-row3').html(filter['filter_by_spv'][0]);
			$('#ui-widget-row4').removeClass("ui-widget-display-yes");
			$('#ui-widget-row4').addClass("ui-widget-display-none");
			$("#ui-widget-content-row1").loader ({
				url    : new Array('CallTrackingReport','GroupFilterBy'),
				method : 'POST',
				param  : {
					GroupId 	: Group.value,
					method 		: filter[Group.value][1],
					object		: filter[Group.value][2],
					properties 	: filter[Group.value][3],
					styles 		: filter[Group.value][4],	
				}
			});
			
			$('ui-widget-content-row2').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
			$('ui-widget-content-row3').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
			$('.select').chosen();
		}
		else if( Group.value=='filter_by_atm')
		{
			filter['filter_by_campaign'] = ["Campaign Name","showCampaign","listCombo","CampaignId","select superlong"];
			filter['filter_by_atm'] = ["ATM Name","showATM", "listCombo","AtmId","select superlong"];
			filter['filter_by_spv'] = ["SPV Name","showSPV", "listCombo","SpvId","select superlong"];
			filter['filter_by_agent'] = ["TSR Name","showAgent","listCombo","UserId","select superlong"];
			
			$('#ui-widget-label-row1').html(filter[Group.value][0]);
			$('#ui-widget-label-row2').html(filter['filter_by_spv'][0]);
			$('#ui-widget-label-row3').html(filter['filter_by_agent'][0]);
			$('#ui-widget-row4').removeClass("ui-widget-display-yes");
			$('#ui-widget-row4').addClass("ui-widget-display-none");
			$("#ui-widget-content-row1").loader({
				url    : new Array('CallTrackingReport','GroupFilterBy'),
				method : 'POST',
				param  : {
					GroupId 	: Group.value,
					method 		: filter[Group.value][1],
					object		: filter[Group.value][2],
					properties 	: filter[Group.value][3],
					styles 		: filter[Group.value][4],
				}
			});
			
			$('#ui-widget-content-row2').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
			$('#ui-widget-content-row3').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
			$('#ui-widget-content-row4').html("");
			$('.select').chosen();
				
		}
		else if( Group.value=='filter_by_spv')
		{
			filter['filter_by_campaign'] = ["Campaign Name","showCampaign","listCombo","CampaignId","select superlong"];
			filter['filter_by_atm'] = ["ATM Name","showATM", "combo","AtmId","select superlong"];
			filter['filter_by_spv'] = ["SPV Name","showSPV", "listCombo","SpvId","select superlong"];
			filter['filter_by_agent'] = ["TSR Name","showAgent","combo","UserId","select superlong"];
		
			$('#ui-widget-label-row1').html(filter['filter_by_atm'][0]);
			$('#ui-widget-label-row2').html(filter['filter_by_spv'][0]);
			$('#ui-widget-label-row3').html(filter['filter_by_agent'][0]);
			
			$('#ui-widget-row4').removeClass("ui-widget-display-yes");
			$('#ui-widget-row4').addClass("ui-widget-display-none");
			$("#ui-widget-content-row1").loader
			({
				url    : new Array('CallTrackingReport','GroupFilterBy'),
				method : 'POST',
				param  : {
					GroupId 	: Group.value,
					method 		: filter['filter_by_atm'][1],
					object		: filter['filter_by_atm'][2],
					properties 	: filter['filter_by_atm'][3],
					styles 		: filter['filter_by_atm'][4],
				}, complete : function(){
					$('.select').chosen(); 
					$('#ui-widget-content-row2').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
					$('#ui-widget-content-row3').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
				}
			});
			
			
			   
		}
		else if( Group.value=='filter_by_agent')
		{
			filter['filter_by_campaign'] = ["Campaign Name","showCampaign","listCombo","CampaignId","select superlong"];
			filter['filter_by_atm'] = ["ATM Name","showATM", "combo","AtmId","select superlong"];
			filter['filter_by_spv'] = ["SPV Name","showSPV", "combo","SpvId","select superlong"];
			filter['filter_by_agent'] = ["TSR Name","showAgent","combo","UserId","select superlong"];
			
			$('#ui-widget-label-row1').html(filter['filter_by_atm'][0]);
			$('#ui-widget-label-row2').html(filter['filter_by_spv'][0]);
			$('#ui-widget-label-row3').html(filter['filter_by_agent'][0]);
			$('#ui-widget-row4').removeClass("ui-widget-display-yes");
			$('#ui-widget-row4').addClass("ui-widget-display-none");
			$("#ui-widget-content-row1").loader
			({
				url    : new Array('CallTrackingReport','GroupFilterBy'),
				method : 'POST',
				param  : {
					GroupId 	: Group.value,
					method 		: filter['filter_by_atm'][1],
					object		: filter['filter_by_atm'][2],
					properties 	: filter['filter_by_atm'][3],
					styles 		: filter['filter_by_atm'][4],
					
				}, complete : function(){
					$('#ui-widget-content-row2').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
					$('#ui-widget-content-row3').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
					$('.select').chosen();
				}
			});
			
			
		}	
	else if( Group.value=='filter_by_atm_group_campaign' )
	{
		filter['filter_by_campaign'] = ["Campaign Name","showCampaign","listCombo","CampaignId","select superlong"];
		filter['filter_by_atm'] = ["ATM Name","showATM", "combo","AtmId","select superlong"];
		filter['filter_by_spv'] = ["SPV Name","showSPV", "listCombo","SpvId","select superlong"];
		filter['filter_by_agent'] = ["TSR Name","showAgent","listCombo","UserId","select superlong"];
		
		$('#ui-widget-label-row1').html(filter['filter_by_atm'][0]);
		$('#ui-widget-label-row2').html(filter['filter_by_campaign'][0]);
		$('#ui-widget-label-row3').html(filter['filter_by_spv'][0]);
		$('#ui-widget-row4').removeClass("ui-widget-display-yes");
		$('#ui-widget-row4').addClass("ui-widget-display-none");
		$("#ui-widget-content-row1").loader
		({
			url    : new Array('CallTrackingReport','GroupFilterBy'),
			method : 'POST',
			param  : {
				GroupId 	: Group.value,
				method 		: filter['filter_by_atm'][1],
				object		: filter['filter_by_atm'][2],
				properties 	: filter['filter_by_atm'][3],
				styles 		: filter['filter_by_atm'][4],
			}, complete : function(){
				$('#ui-widget-content-row2').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
				$('#ui-widget-content-row3').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
				$('.select').chosen();
			}
		});
		
	}
	else if( Group.value=='filter_by_spv_group_campaign' )
	{
		filter['filter_by_campaign'] = ["Campaign Name","showCampaign","listCombo","CampaignId","select superlong"];
		filter['filter_by_atm'] = ["ATM Name","showATM", "combo","AtmId","select superlong"];
		filter['filter_by_spv'] = ["SPV Name","showSPV", "listCombo","SpvId","select superlong"];
		filter['filter_by_agent'] = ["TSR Name","showAgent","combo","UserId","select superlong"];
		
		$('#ui-widget-label-row1').html(filter['filter_by_atm'][0]);
		$('#ui-widget-label-row2').html(filter['filter_by_spv'][0]);
		$('#ui-widget-label-row3').html(filter['filter_by_agent'][0]);
		$('#ui-widget-row4').removeClass("ui-widget-display-yes");
		$('#ui-widget-row4').addClass("ui-widget-display-none");
		$("#ui-widget-content-row1").loader
		({
			url    : new Array('CallTrackingReport','GroupFilterBy'),
			method : 'POST',
			param  : {
				GroupId 	: Group.value,
				method 		: filter['filter_by_atm'][1],
				object		: filter['filter_by_atm'][2],
				properties 	: filter['filter_by_atm'][3],
				styles 		: filter['filter_by_atm'][4],
			}, complete : function(){
				$('#ui-widget-content-row2').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
				$('#ui-widget-content-row3').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
				$('.select').chosen();
			}
		});
		
	}
	else if((Group.value== 'filter_by_agent_group_campaign'))
	{
		filter['filter_by_campaign'] = ["Campaign Name","showCampaign","listCombo","CampaignId","select superlong"];
		filter['filter_by_atm'] = ["ATM Name","showATM", "combo","AtmId","select superlong"];
		filter['filter_by_spv'] = ["SPV Name","showSPV", "listCombo","SpvId","select superlong"];
		filter['filter_by_agent'] = ["TSR Name","showAgent","combo","UserId","select superlong"];
		
		$('#ui-widget-label-row1').html(filter['filter_by_atm'][0]);
		$('#ui-widget-label-row2').html(filter['filter_by_spv'][0]);
		$('#ui-widget-label-row3').html(filter['filter_by_agent'][0]);
		$('#ui-widget-row4').removeClass("ui-widget-display-none");
		$('#ui-widget-row4').addClass("ui-widget-display-yes");
		$("#ui-widget-content-row1").loader
		({
			url    : new Array('CallTrackingReport','GroupFilterBy'),
			method : 'POST',
			param  : {
				GroupId 	: Group.value,
				method 		: filter['filter_by_atm'][1],
				object		: filter['filter_by_atm'][2],
				properties 	: filter['filter_by_atm'][3],
				styles 		: filter['filter_by_atm'][4],
			}, 
			complete : function() {
				$('#ui-widget-content-row2').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
				$('#ui-widget-content-row3').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
				$('.select').chosen();
			}
		});
	}
	else if((Group.value == 'filter_campaign_group_agent'))
	{
		
		filter['filter_by_campaign'] = ["Campaign Name","showCampaign","listCombo","CampaignId","select superlong"];
		filter['filter_by_atm'] = ["ATM Name","showATM", "combo","AtmId","select superlong"];
		filter['filter_by_spv'] = ["SPV Name","showSPV", "listCombo","SpvId","select superlong"];
		filter['filter_by_agent'] = ["TSR Name","showAgent","combo","UserId","select superlong"];
		
		
		$('#ui-widget-label-row1').html(filter['filter_by_campaign'][0]);
		$('#ui-widget-label-row2').html(filter['filter_by_atm'][0]);
		$('#ui-widget-label-row3').html(filter['filter_by_spv'][0]);
		$('#ui-widget-row4').removeClass("ui-widget-display-none");
		$('#ui-widget-row4').addClass("ui-widget-display-yes");
		$('#ui-widget-label-row4').html(filter['filter_by_agent'][0]);
		$("#ui-widget-content-row1").loader
		({
			url    : new Array('CallTrackingReport','GroupFilterBy'),
			method : 'POST',
			param  : {
				GroupId 	: Group.value,
				method 		: filter['filter_by_campaign'][1],
				object		: filter['filter_by_campaign'][2],
				properties 	: filter['filter_by_campaign'][3],
				styles 		: filter['filter_by_campaign'][4],
			}, 
			complete : function() {
				$('#ui-widget-content-row2').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
				$('#ui-widget-content-row3').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
				$('#ui-widget-content-row4').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
				$('.select').chosen();
			}
		});
	}
	else if((Group.value == 'filter_campaign_group_atm'))
	{
		
		filter['filter_by_campaign'] = ["Campaign Name","showCampaign","listCombo","CampaignId","select superlong"];
		filter['filter_by_atm'] = ["ATM Name","showATM", "combo","AtmId","select superlong"];
		filter['filter_by_spv'] = ["SPV Name","showSPV", "listCombo","SpvId","select superlong"];
		filter['filter_by_agent'] = ["TSR Name","showAgent","combo","UserId","select superlong"];
		
		
		$('#ui-widget-label-row1').html(filter['filter_by_campaign'][0]);
		$('#ui-widget-label-row2').html(filter['filter_by_atm'][0]);
		$('#ui-widget-label-row3').html(filter['filter_by_spv'][0]);
		$('#ui-widget-row4').removeClass("ui-widget-display-none");
		$('#ui-widget-row4').addClass("ui-widget-display-yes");
		$('#ui-widget-label-row4').html(filter['filter_by_agent'][0]);
		$("#ui-widget-content-row1").loader
		({
			url    : new Array('CallTrackingReport','GroupFilterBy'),
			method : 'POST',
			param  : {
				GroupId 	: Group.value,
				method 		: filter['filter_by_campaign'][1],
				object		: filter['filter_by_campaign'][2],
				properties 	: filter['filter_by_campaign'][3],
				styles 		: filter['filter_by_campaign'][4],
			}, 
			complete : function() {
				$('#ui-widget-content-row2').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
				$('#ui-widget-content-row3').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
				$('#ui-widget-content-row4').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
				$('.select').chosen();
			}
		});
	}
	
	else if((Group.value == 'filter_campaign_group_spv'))
	{
		
		filter['filter_by_campaign'] = ["Campaign Name","showCampaign","listCombo","CampaignId","select superlong"];
		filter['filter_by_atm'] = ["ATM Name","showATM", "combo","AtmId","select superlong"];
		filter['filter_by_spv'] = ["SPV Name","showSPV", "listCombo","SpvId","select superlong"];
		filter['filter_by_agent'] = ["TSR Name","showAgent","combo","UserId","select superlong"];
		
		
		$('#ui-widget-label-row1').html(filter['filter_by_campaign'][0]);
		$('#ui-widget-label-row2').html(filter['filter_by_atm'][0]);
		$('#ui-widget-label-row3').html(filter['filter_by_spv'][0]);
		$('#ui-widget-row4').removeClass("ui-widget-display-none");
		$('#ui-widget-row4').addClass("ui-widget-display-yes");
		$('#ui-widget-label-row4').html(filter['filter_by_agent'][0]);
		$("#ui-widget-content-row1").loader
		({
			url    : new Array('CallTrackingReport','GroupFilterBy'),
			method : 'POST',
			param  : {
				GroupId 	: Group.value,
				method 		: filter['filter_by_campaign'][1],
				object		: filter['filter_by_campaign'][2],
				properties 	: filter['filter_by_campaign'][3],
				styles 		: filter['filter_by_campaign'][4],
			}, 
			complete : function() {
				$('#ui-widget-content-row2').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
				$('#ui-widget-content-row3').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
				$('#ui-widget-content-row4').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
				$('.select').chosen();
			}
		});
	} 
	else if((Group.value == 'filter_campaign_group_date')) {
		filter['filter_by_campaign'] = ["Campaign Name","showCampaign","listCombo","CampaignId","select superlong"];
		filter['filter_by_atm'] = ["ATM Name","showATM", "combo","AtmId","select superlong"];
		filter['filter_by_spv'] = ["SPV Name","showSPV", "listCombo","SpvId","select superlong"];
		filter['filter_by_agent'] = ["TSR Name","showAgent","combo","UserId","select superlong"];
		
		
		$('#ui-widget-label-row1').html(filter['filter_by_campaign'][0]);
		$('#ui-widget-label-row2').html(filter['filter_by_atm'][0]);
		$('#ui-widget-label-row3').html(filter['filter_by_spv'][0]);
		$('#ui-widget-row4').removeClass("ui-widget-display-none");
		$('#ui-widget-row4').addClass("ui-widget-display-yes");
		$('#ui-widget-label-row4').html(filter['filter_by_agent'][0]);
		$("#ui-widget-content-row1").loader
		({
			url    : new Array('CallTrackingReport','GroupFilterBy'),
			method : 'POST',
			param  : {
				GroupId 	: Group.value,
				method 		: filter['filter_by_campaign'][1],
				object		: filter['filter_by_campaign'][2],
				properties 	: filter['filter_by_campaign'][3],
				styles 		: filter['filter_by_campaign'][4],
			}, 
			complete : function() {
				$('#ui-widget-content-row2').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
				$('#ui-widget-content-row3').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
				$('#ui-widget-content-row4').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
				$('.select').chosen();
			}
		});
	}
	else {
		$('#ui-widget-content-row1').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
		$('#ui-widget-content-row2').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
		$('#ui-widget-content-row3').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
		$('#ui-widget-content-row4').html("<select class='select superlong' disabled=true><option>--choose--</option></select>");
		$('.select').chosen();		
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
	Ext.Window
	({
		url 	: Ext.EventUrl(new Array('CallTrackingReport', 'ShowReport') ).Apply(), 
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
	Ext.Window
	({
		url 	: Ext.EventUrl(new Array('CallTrackingReport', 'ShowExcel') ).Apply(), 
		param 	: Ext.Join( new Array( frmReport.getElement(), param) ).object()
	}).newtab();
	
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
function CmpByGroup(Group ){
	Ext.Ajax ({
		url 	: Ext.DOM.INDEX +'/CallTrackingReport/getCampaignByGroup/',
		param 	: {
			GroupId : Group.value
		}, 
		complete : function( obj ){
			console.log( obj );
		}
	}).load('DivCmp');
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