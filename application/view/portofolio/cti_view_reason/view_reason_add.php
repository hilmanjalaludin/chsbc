<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Add Reason Type </legend>	
 <form name="frmAddReasonType">
	<table cellpadding="6px;">
	<tr>
		<td class="text_caption">* Reason Type </td>
		<td><?php echo form() -> input('reason_tipe','input_text long');?></td>
	</tr>
	<tr>
		<td class="text_caption">* Reason Code </td>
		<td><?php echo form() -> input('reason_code','input_text long');?></td>
	</tr>
	<tr>
		<td class="text_caption">* Description</td>
		<td><?php echo form() -> input('reason_desc','input_text long');?></td>
	</tr>
	
	<tr>
		<td class="text_caption">* Timeout</td>
		<td><?php echo form() -> input('reason_timeout','input_text long');?> <span class="wrap">( "s) </span></td>
	</tr>
	
	<tr>
		<td class="text_caption">&nbsp;</td>
		<td>
			<input type="button" class="save button" onclick="Ext.DOM.Save();" value="Save">
			<input type="button" class="close button" onclick="Ext.Cmp('top-panel').setText('');" value="Close">
		</td>
	</tr>
</table>
</form>
</fieldset>
</div>