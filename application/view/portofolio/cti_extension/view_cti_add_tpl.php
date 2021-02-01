<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Add Extension </legend>
	<table cellpadding="8px;">
	<tr>
		<td class="text_caption">Extension Number</td>
		<td><?php echo form()->input('ext_number','input_text long');?></td>
	</tr>
	<tr>
		<td class="text_caption">IP PBX </td>
		<td><?php echo form()->combo('pbx','input_text long',$PBX);?></td>
	</tr>
	<tr>
		<td class="text_caption">Description </td>
		<td><?php echo form()->textarea('ext_desc','textarea long');?></td>
	</tr>
	<tr>
		<td class="text_caption"> Type</td>
		<td><?php echo form()->combo('ext_type','select long',$Type);?></td>
	</tr>
	<tr>
		<td class="text_caption">Status</td>
		<td><?php echo form()->combo('ext_status','select long',$Status);?></td>
	</tr>
	<tr>
		<td class="text_caption">Location</td>
		<td><?php echo form()->input('ext_location','select long');?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>
			<input type="button" class="save button" onclick="Ext.DOM.saveExtension();" value="Save">
			<input type="button" class="close button" onclick="Ext.Cmp('tpl_header').setText('');" value="Close">
		</td>
	</tr>	
	</table>
</fieldset>	
</div>
