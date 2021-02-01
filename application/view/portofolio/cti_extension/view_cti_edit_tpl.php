<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Edit Extension </legend>
 <?php echo form()->hidden('id',null,$Data['id']);?>
	<table cellpadding="8px;">
	<tr>
		<td class="text_caption">Extension Number</td>
		<td><?php echo form()->input('ext_number','input_text long', $Data['ext_number']);?></td>
	</tr>
	<tr>
		<td class="text_caption">IP PBX </td>
		<td><?php echo form()->combo('pbx','input_text long',$PBX,$Data['pbx']);?></td>
	</tr>
	<tr>
		<td class="text_caption">Description </td>
		<td><?php echo form()->textarea('ext_desc','textarea long',$Data['ext_desc']);?></td>
	</tr>
	<tr>
		<td class="text_caption"> Type</td>
		<td><?php echo form()->combo('ext_type','select long',$Type,$Data['ext_type']);?></td>
	</tr>
	<tr>
		<td class="text_caption">Status</td>
		<td><?php echo form()->combo('ext_status','select long',$Status,$Data['ext_status']);?></td>
	</tr>
	<tr>
		<td class="text_caption">Location</td>
		<td><?php echo form()->input('ext_location','select long',$Data['ext_location']);?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>
			<input type="button" class="update button" onclick="Ext.DOM.UpdateExtension();" value="Update">
			<input type="button" class="close button" onclick="Ext.Cmp('tpl_header').setText('');" value="Close">
		</td>
	</tr>	
	</table>
</fieldset>	
</div>
