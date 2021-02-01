<?php
	__(javascript(array
	( 
		array('_file' => base_enigma().'/helper/EUI_Dialog.js', 'eui_'=>'1.0.0', 'time'=>time())
	)));
?>

<script>
	// cek if loaded documnet call($this);
	Ext.document(document).ready(function()
	{
		var _offset = 22;
		
		// get title 
		Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
		
		// date picker 
		Ext.query('.date').datepicker({
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
		
		Ext.DOM.ShowReport = function() 
		{
			// customize report 	
			var TITLE = Ext.System.view_file_name() 
						+((Ext.Cmp('FilterBy').getText()!='--choose --') ? " :: "+ Ext.Cmp('FilterBy').getText() : '')
						+((Ext.Cmp('ModeBy').getText()!='--choose --') ? " :: "+ Ext.Cmp('ModeBy').getText() : '')
			
			Ext.Window({
				url 	: Ext.DOM.INDEX +'/CmpPerformanceReport/ShowReport/',
				param 	: {
					start_date : Ext.Cmp('start_date').getValue(), 
					end_date : Ext.Cmp('end_date').getValue(),
					mode : Ext.Cmp('ModeBy').getValue(),
					filter : Ext.Cmp('FilterBy').getValue(),
					cmp : Ext.Cmp('CampaignId').getValue()
				},
					style 	: {
					width  		: (Ext.query('#panel-call-center').width()),
					height 		: (Ext.query('#panel-main-content').height() -((_offset)+40)),
					scrolling 	: 1, 
					resize 		: 1
				}	
			}).newtab();
		}
		
		Ext.DOM.ShowExcel = function()
		{
			Ext.Window
			({
				url 	: Ext.DOM.INDEX +'/CmpPerformanceReport/ShowExcel/',
				param 	: { 
					start_date : Ext.Cmp('start_date').getValue(), 
					end_date : Ext.Cmp('end_date').getValue(),
					mode : Ext.Cmp('ModeBy').getValue(),
					filter : Ext.Cmp('FilterBy').getValue(),
					cmp : Ext.Cmp('CampaignId').getValue()
				}
			}).newtab();
		}
		
		Ext.DOM.Campaign= function( Filter )
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/CmpPerformanceReport/getCampaign/',
			param 	: {
				FilterId : Filter.value
			}
		}).load('DivCmp');
		
	});
	
</script>

<fieldset class="corner">
	<legend class="icon-customers">&nbsp;&nbsp;<span id="legend_title">Raw Data Report</span></legend>
<div id="panel-main-content">
	<table border=0 width='100%'>
		<tr>
			<td width='40%' valign="top"><?php $this -> load-> view('rpt_cmp_performance/rpt_cmp_performance_filter');?></td>
		</tr>
	</table>
</div>
</fieldset>