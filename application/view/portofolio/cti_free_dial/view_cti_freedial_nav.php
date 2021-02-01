<script>

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
function RoleBack(){
	if( Ext.Msg('Are you sure ?').Confirm() ){
		window.clearInterval(Ext.DOM.setTimeOutId);
		Ext.BackHome();
	}
}

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 */
 
 
 function ButtonDial() 
{
	try 
	{
		if( document.ctiapplet.getAgentStatus() != AGENT_READY )
		{
			var CallerNumber = Ext.Cmp('call_to_number_id').getValue();
			
			if(  !Ext.Cmp('call_to_number_id').empty() ) 
			{
				 ExtApplet.setData ({  
					Phone : CallerNumber, 
					CustomerId  : 'free_dial'
				}).Call();
				
				console.log( ExtApplet );
			}	
		}
		else{
			Ext.Msg("Please set Not Ready Before Call !").Info();
		}	
	}
	catch(e){
		Ext.Msg(e).Error();
	}
}


// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 */
 
 
 function ButtonHangup() 
{
 try{	
  ExtApplet.setHangup();
  return false;	
 } catch( error ){
	console.log( error );
 }	 
}

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 */
 
 function SetCallNumber( opts )
{
	var text_call_number = Ext.Cmp('call_to_number_id').getElementId();
	if( opts.value!='' ){
		text_call_number.value += opts.value;
		text_call_number.focus();
	}
}	

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 */
 
function ValidCallNumber(textarea)
{
	if( (textarea.value!='#')){
		if(isNaN(textarea.value)){
			textarea.value = textarea.value.substring(0,(textarea.value.length-1));
		}
		else{
			textarea.value = textarea.value;
		}
	}	
	else{
		textarea.value = textarea.value;
	}
}
	

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 */
 
 
 function ButtonClear() 
{
	var text_call_number = Ext.Cmp('call_to_number_id').getElementId();
	if( text_call_number.value!='' )
 {
	text_call_number.value = text_call_number.value.substring(0,(text_call_number.value.length-1));
	text_call_number.focus();
 }
 
}
// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 */
 
function ClearCallNumber(e) {
	Ext.Cmp('call_to_number_id').setValue('');
	Ext.Cmp('call_to_number_id').setFocus();
}	


// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 */
 
 function PageActivityFreeLog( obj )
{
	$('#activity-free-dial-log').Spiner 
	({
		url 	: new Array('CtiFreeDial','PageFreeCallActivityHistory'),
		param 	: { },
		order   : {
			order_type : obj.type,
			order_by   : obj.orderby,
			order_page : obj.page	
		}, 
		complete : function( obj ){
			$('#activity-free-dial-log').css({"width" : "99%"});
			$('#activity-free-dial-log').css({"height" : "100%"});
			$('.ui-widget-fieldset-parental').css({
				"height": ($("#main_content").innerHeight() - 100) +"px"	
			});
		}
	});		
}

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 */
 
function SaveCallActivity()
{
	var frmFreeCallDial  = Ext.Serialize("frmFreeCallDial");
	if( !frmFreeCallDial.Complete() ){
		Ext.Msg("Form Input Not Complete!").Info();
		return false;
	}
	
	var CallSessionId = ExtApplet.getCallSessionId();
	
	Ext.Ajax
	({
		url 	: Ext.EventUrl( new Array('CtiFreeDial','SaveCallActivity')).Apply(),
		method  : 'POST',
		param   : {
			CallerNumber  : Ext.Cmp("call_to_number_id").getValue(), 
			CallerRemark  : Ext.Cmp("call_free_remark").getValue(),
			CallSessionId : CallSessionId
		},
		ERROR : function( e ){
			Ext.Util(e).proc(function( data ){
				if( data.success ){
					Ext.Msg("Save Activity Call").Success();	
					PageActivityFreeLog({ type:'', orderby:'', page : ''});
				} else {
					Ext.Msg("Save Activity Call").Failed();
				}	
			});
		}	
	}).post();
}
// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 */
 
 $(document).ready( function()
{
  $('#ui-widget-template-tabs').mytab().tabs();
  $('#ui-widget-template-tabs').mytab().tabs("option", "selected", 0);
  $('#ui-widget-template-tabs').css({'background-color':'#FFFFFF'});
  $('#ui-widget-template-content').css({'background-color':'#FFFFFF'});
  $("#ui-widget-template-tabs").mytab().close(function(){  Ext.DOM.RoleBack(); }, true);
  
 // -------------- attr CSS ---------------------------------------------------
 
  $('#legend_title').html( Ext.System.view_file_name());
  $('.border-none').css({ "border" :"0px solid #FFFFFF" });
  $('.ui-widget-fieldset-parental').css({
		"height": new Array( ($('#main_content').innerHeight() -( $('#main_content').innerHeight()/4 )), "px").join("")
	});

// ------------- look off page ---------------------------------------------------
	PageActivityFreeLog({ type:'', orderby:'', page : ''});
	
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
				<div class="ui-widget-form-cell ui-widget-content-top" id="content-dial-activity" style="width:75%;">
					<fieldset class="corner ui-widget-fieldset-parental" style="padding:8px 4px 8px 4px;margin:-12px 5px 5px -10px; border-radius:5px;">
						<?php echo form()->legend(lang("Direct Call Activity Log"),"fa-history");?>
						<div class="ui-widget-form-table-compact" id="activity-free-dial-log"></div>
					</fieldset>	
				</div>
				<div class="ui-widget-form-cell ui-widget-content-top" id="content-dial-softphone" style="width:25%;"> <?php $this->load->view("cti_free_dial/view_cti_page_dial");?></div>
			</div>
		</div>
	</div>
</div>	
	
