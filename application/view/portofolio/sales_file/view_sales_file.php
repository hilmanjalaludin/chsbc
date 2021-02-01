<?php 
__(javascript(array( 
	array('_file' => base_enigma().'/helper/EUI_Dialog.js', 'eui_'=>'1.0.0', 'time'=>time())
)));?>
<script>
Ext.DOM.ShowReport = function() {
	if( Ext.Msg("Do you want to download this?").Confirm()) {
		var WindowWin = new Ext.Window({
				url   : Ext.DOM.INDEX+'/SalesReportTxt/download/', 
				param : {
				}
			}).newtab();
		}
}

Ext.DOM.Debug = function() {
	// if( Ext.Msg("Do you want to download this?").Confirm()) {
		var WindowWin = new Ext.Window({
				url   : Ext.DOM.INDEX+'/SalesReportTxt/debug/', 
				param : {
				}
			}).newtab();
		// }
}
</script>
<fieldset class="corner">
	<legend class="icon-customers">&nbsp;&nbsp;<span id="legend_title">Sales Files</span></legend>
<div id="panel-main-content">
	<table border=0 width='100%'>
		<tr>
			<td width='40%' valign="top"><?php $this -> load-> view('sales_file/view_sales_file_nav');?></td>
		</tr>
	</table>
</div>
</fieldset>