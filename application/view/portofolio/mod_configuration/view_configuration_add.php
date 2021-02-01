<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Add Configuration  </legend>
 <form name="config">
	<table cellpadding="4px;" border=0 cellspacing="3">
		<tr>
			<td class="text_caption">* Reference Code </td>
			<td colspan="1"><?php echo form()->combo('refConfigCode','select long',$space, null, array("change"=>"Ext.Cmp('ConfigCode').setValue(this.value);"));?></td>
		</tr>
		<tr>
			<td class="text_caption">* Config Code </td>
			<td colspan="1"> <?php echo form()->input('ConfigCode','input_text long');?> </td>
		</tr>
		<tr>
			<td class="text_caption">* Config Name </td>
			<td colspan="1"> <?php echo form()->input('ConfigName','input_text long');?> </td>
		</tr>
		<tr>
			<td class="text_caption">* Config Value</td>
			<td><?php echo form()->input('ConfigValue','select long');?></td>
		</tr>
		<tr>
			<td class="text_caption">* Status</td>
			<td><?php echo form()->combo('ConfigFlags','select long',array('1'=>'Active','0'=>'Not Active'));?></td>
		</tr>
		<tr>
			<td class="text_caption">&nbsp;</td>
			<td>
				<input type="button" class="save button" onclick="Ext.DOM.SaveConfig();" value="Save">
				<input type="button" class="close button" onclick="Ext.Cmp('span_top_nav').setText('');" value="Close">	</td>
			<td class="text_caption">&nbsp;</td>
			<td class="text_caption"></td>
		</tr>
	</table>
	 </form>
</fieldset>	
</div>