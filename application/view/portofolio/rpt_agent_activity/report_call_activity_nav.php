<?php 
__(javascript(array( 
	array('_file' => base_enigma().'/helper/EUI_Dialog.js', 'eui_'=>'1.0.0', 'time'=>time())
)));?>
<script>

// cek if loaded documnet call($this);

Ext.document(document).ready(function(){
var _offset = 22;

// get title 

Ext.Cmp('legend_title').setText( Ext.System.view_file_name());

// date picker 

Ext.query('.date').datepicker ({
	showOn : 'button', 
	buttonImage : Ext.DOM.LIBRARY+'/gambar/calendar.gif', 
	buttonImageOnly	: true, 
	dateFormat : 'dd-mm-yy',
	readonly:true		
});

// customize height fieldset 

Ext.Css('panel-agent-content').style
({
	'height' : (Ext.query('#main_content').height() -(Ext.query('.extToolbars').height()+_offset)),
	'margin-top' : -5
});

// customize report 	
Ext.DOM.ShowReport = function() {
	
var TITLE = Ext.System.view_file_name() 
		    +((Ext.Cmp('Mode').getText()!='--choose --') ? " :: "+ Ext.Cmp('Mode').getText() : '')
			+((Ext.Cmp('Group').getText()!='--choose --') ? " :: "+ Ext.Cmp('Group').getText() : '');

  Ext.Dialog('panel-activity-agent', {
		ID		: 'panel-activity-agent1',
		type	: 'ajax/html',
		title	: TITLE,
		url 	: Ext.DOM.INDEX +'/AgentActivityReport/ShowReport/',
		param 	: { 
			GroupCallCenter : Ext.Cmp('Group').getValue(),  
			AgentId : Ext.Cmp('AgentId').getValue(),
			start_date : Ext.Cmp('start_date').getValue(), 
			end_date : Ext.Cmp('end_date').getValue(),
			mode : Ext.Cmp('Mode').getValue(),
			CallDirection : ''
		},
		style 	: {
			width  		: (Ext.query('#panel-activity-agent').width()),
			height 		: (Ext.query('#panel-agent-content').height() -((_offset)+40)),
			scrolling 	: 1, 
			resize 		: 1
		}	
	}).open();
 }
 
 
Ext.DOM.ShowExcel = function(){
	Ext.Window
	({
		url 	: Ext.DOM.INDEX +'/AgentActivityReport/ShowExcel/',
		param 	: { 
			GroupCallCenter : Ext.Cmp('Group').getValue(),  
			AgentId : Ext.Cmp('AgentId').getValue(),
			start_date : Ext.Cmp('start_date').getValue(), 
			end_date : Ext.Cmp('end_date').getValue(),
			mode : Ext.Cmp('Mode').getValue(),
			CallDirection : Ext.Cmp('CallDirection').getValue()
		}
	}).newtab();
}
  
 
 
// Ext.DOM.AgentGroupBy

Ext.DOM.AgentByGroup= function( Group )
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/AgentActivityReport/getAgentByGroup/',
		param 	: {
			GroupId : Group.value
		}
	}).load('DivAgent');
	
});

</script>
<fieldset class="corner">
	<legend class="icon-customers">&nbsp;&nbsp;<span id="legend_title">Order Report</span></legend>
<div id="panel-agent-content">
	<table border=0 width='100%'>
		<tr>
			<td width='35%' valign="top"><?php $this -> load-> view('rpt_agent_activity/report_call_activity_group');?></td>
			<td width='65%' valign="top"><?php $this -> load-> view('rpt_agent_activity/report_call_activity_content');?></td>
		</tr>
	</table>
</div>
</fieldset>
