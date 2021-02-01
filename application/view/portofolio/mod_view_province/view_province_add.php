<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Add Province </legend>	
 <form name="frmAddProvince">
	<table cellpadding="6px;">
	<tr>
		<td class="text_caption">* Province Code</td>
		<td><?php echo form() -> input('ProvinceCode','input_text long');?></td>
	</tr>
	<tr>
		<td class="text_caption">* Province Name </td>
		<td><?php echo form() -> input('Province','input_text long');?></td>
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