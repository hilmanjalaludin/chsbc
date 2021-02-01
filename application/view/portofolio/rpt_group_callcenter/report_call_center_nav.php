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

Ext.Css('panel-main-content').style
({
	'height' : (Ext.query('#main_content').height() -(Ext.query('.extToolbars').height()+_offset)),
	'margin-top' : -5
});

// customize report 	
Ext.DOM.ShowReport = function() {
	
var TITLE = Ext.System.view_file_name() 
		    +((Ext.Cmp('Mode').getText()!='--choose --') ? " :: "+ Ext.Cmp('Mode').getText() : '')
			+((Ext.Cmp('Group').getText()!='--choose --') ? " :: "+ Ext.Cmp('Group').getText() : '')
			+((Ext.Cmp('CallDirection').getText()!='--choose --') ? " :: "+ Ext.Cmp('CallDirection').getText() : '')

  Ext.Dialog('panel-call-center', {
		ID		: 'panel-call-center1',
		type	: 'ajax/html',
		title	: TITLE,
		url 	: Ext.DOM.INDEX +'/GroupCallCenterReport/ShowReport/',
		param 	: { 
			GroupCallCenter : Ext.Cmp('Group').getValue(),  
			start_date : Ext.Cmp('start_date').getValue(), 
			end_date : Ext.Cmp('end_date').getValue(),
			mode : Ext.Cmp('Mode').getValue(),
			CallDirection : Ext.Cmp('CallDirection').getValue()
		},
		style 	: {
			width  		: (Ext.query('#panel-call-center').width()),
			height 		: (Ext.query('#panel-main-content').height() -((_offset)+40)),
			scrolling 	: 1, 
			resize 		: 1
		}	
	}).open();
 }
 
 
Ext.DOM.ShowExcel = function(){
	Ext.Window
	({
		url 	: Ext.DOM.INDEX +'/GroupCallCenterReport/ShowExcel/',
		param 	: { 
			GroupCallCenter : Ext.Cmp('Group').getValue(),  
			start_date : Ext.Cmp('start_date').getValue(), 
			end_date : Ext.Cmp('end_date').getValue(),
			mode : Ext.Cmp('Mode').getValue(),
			CallDirection : Ext.Cmp('CallDirection').getValue()
		}
	}).newtab();
}
 
 
 
// Ext.DOM.AgentGroupBy

	
});

</script>
<fieldset class="corner">
	<legend class="icon-customers">&nbsp;&nbsp;<span id="legend_title">Order Report</span></legend>
<div id="panel-main-content">
	<table border=0 width='100%'>
		<tr>
			<td width='40%' valign="top"><?php $this -> load-> view('rpt_group_callcenter/report_call_center_group');?></td>
			<td width='60%' valign="top"><?php $this -> load-> view('rpt_group_callcenter/report_call_center_content');?></td>
		</tr>
	</table>
</div>
</fieldset>
