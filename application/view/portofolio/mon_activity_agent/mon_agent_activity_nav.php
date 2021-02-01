<?php echo javascript(); ?>
<script type="text/javascript">
// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
Ext.DOM.RoleBack = function(){
	if( Ext.Msg('Are you sure ?').Confirm() ){
		window.clearInterval(Ext.DOM.setTimeOutId);
		Ext.BackHome();
	}
}


/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
Ext.DOM.StoreActivity = function()
{
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/MonAgentActivity/Store/',
		method  : 'POST',
		param 	: {
			time : Ext.Date().getDuration(),
			AgentActivityCode  : Ext.Cmp('AgentActivityCode').getValue()
		},
		ERROR 	: function(e){
			Ext.Util(e).proc(function(data)
			{
				for( var i in data ) {
					if( typeof(data[i].Status)=='string' ) {
						if( !Ext.Cmp(data[i].UserId+'-name').IsNull() ){
							Ext.Cmp(data[i].UserId+'-name').setAttribute('style',data[i].Styles);
						}
					}
					if( typeof(data[i].Status)=='string' ) {
						if( !Ext.Cmp(data[i].UserId+'-agentstatus').IsNull() ){
							Ext.Cmp(data[i].UserId+'-agentstatus').setText(data[i].Status);
							Ext.Cmp(data[i].UserId+'-agentstatus').setAttribute('style',data[i].Styles);
						}
					}
					if( typeof(data[i].Duration)=='string'){
						if( !Ext.Cmp(data[i].UserId+'-time').IsNull() ){
							Ext.Cmp(data[i].UserId+'-time').setText(data[i].Duration);
							Ext.Cmp(data[i].UserId+'-time').setAttribute('style',data[i].Styles);
						}
					}
					if( typeof(data[i].Extension)=='string'){
						if( !Ext.Cmp(data[i].UserId+'-ext').IsNull() ){
							Ext.Cmp(data[i].UserId+'-ext').setText(data[i].Extension);
							Ext.Cmp(data[i].UserId+'-ext').setAttribute('style',data[i].Styles);
						}
					}
					if( typeof(data[i].ExtStatus)=='string') {
						if( !Ext.Cmp(data[i].UserId+'-extstatus').IsNull() ){
							Ext.Cmp(data[i].UserId+'-extstatus').setText(data[i].ExtStatus);	
							Ext.Cmp(data[i].UserId+'-extstatus').setAttribute('style',data[i].Styles);
						}
					}
					if( typeof(data[i].Data)=='string') {
						if( !Ext.Cmp(data[i].UserId+'-data').IsNull() ){
							Ext.Cmp(data[i].UserId+'-data').setText(data[i].Data);
							Ext.Cmp(data[i].UserId+'-data').setAttribute('style',data[i].Styles);
						}
					}
					if( typeof(data[i].Action)=='string') {
						if( !Ext.Cmp(data[i].UserId+'-spy').IsNull() ){
							Ext.Cmp(data[i].UserId+'-spy').setText(data[i].Action);
							Ext.Cmp(data[i].UserId+'-spy').setAttribute('style',data[i].Styles);
						}
					}
				}	
			});
		}
	}).post();
		
	
}


/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
Ext.DOM.ActivityAgent = function(Order)
{
  window.clearInterval(Ext.DOM.setTimeOutId);
	var AgentActivityCode = Ext.Cmp('AgentActivityCode').getValue().join(",");
	
	$('#content-activity').Spiner 
	({
		url 	: new Array('MonAgentActivity','Content'),
		param 	: { 
			Order : Order,
			AgentActivityCode : AgentActivityCode
		},
		order   : {
			order_type : '',
			order_by   : '',
			order_page : ''	
		}, 
		complete : function( obj ){
			Ext.DOM.setTimeOutId = window.setInterval(function(){
				Ext.DOM.StoreActivity();
			},1000);
		}
	});		
} 

Ext.DOM.RefreshData = function() {
	Ext.DOM.ActivityAgent("DESC");
}

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
Ext.DOM.SpyAgent = function( ExtSite, ExtSrc ) 
{
 if( (ExtSite!='') && (ExtSrc!='') )
 {
	if( Ext.Msg("Do you want to listen ?").Confirm() )
	{
		Ext.Ajax ({
			url 	: Ext.DOM.INDEX +'/MonAgentActivity/SpyAgent/',
			method  : 'POST',
			param 	: {
				FromExtension  : ExtSite,
				ToExtension	 : ExtSrc
			},
			ERROR : function(e){
				Ext.Util(e).proc(function(spy){
					spy.success;
				});
			}
				
		}).post();
	}
	
  }	
  else{
		Ext.Msg("Extension not found.").Info();
	}
}

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

Ext.DOM.CoachAgent = function( ExtSite, ExtSrc ) 
{
if( (ExtSite!='') && (ExtSrc!='') )
{
	if( Ext.Msg("Do you want to listen ?").Confirm() ) 
	{
		Ext.Ajax ({
			url 	: Ext.DOM.INDEX +'/MonAgentActivity/CoachAgent/',
			method  : 'POST',
			param 	: {
				FromExtension  : ExtSite,
				ToExtension	 : ExtSrc
			},
			ERROR : function(e){
				Ext.Util(e).proc(function(spy){
					spy.success;
				});
			}
				
		}).post();
	}	
 }
else{
	Ext.Msg("Extension not found.").Info();
} 
  
}

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 $(document).ready( function()
{
  $('#ui-widget-template-tabs').mytab().tabs();
  $('#ui-widget-template-tabs').mytab().tabs("option", "selected", 0);
  $('#ui-widget-template-tabs').css({'background-color':'#FFFFFF'});
  $('#ui-widget-template-content').css({'background-color':'#FFFFFF'});
  $("#ui-widget-template-tabs").mytab().close(function(){  Ext.DOM.RoleBack(); }, true);
  Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
  Ext.DOM.RefreshData();
  
 });
 
</script> 	

<div id="ui-widget-template-tabs" class="tabs corner ">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-template-content">
			<span class="ui-icon ui-icon-person"></span><span id="legend_title"></span></a>
		</li>
	</ul>	
	
	<div id="ui-widget-template-content" style="width:98.4%;">
		<div class="ui-widget-form-table-compact" style="width:99%;">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell ui-widget-content-top" id="content-filter" style="width:99%">
					<fieldset style="margin-top:-15px;"> 
						<center> <?php 
							foreach( array(0 => "Logout", "Ready", "Not Ready", "ACW", "Busy") as $value => $label ){
								echo form()->checkbox("AgentActivityCode", null, $value, array("change" => "Ext.DOM.RefreshData(this);") ) ." $label ";
							}
						?> </center>
					</fieldset>
				</div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell ui-widget-content-top" id="content-activity" style="width:99%"></div>
			</div>
		</div>
	</div>
</div>	
	
