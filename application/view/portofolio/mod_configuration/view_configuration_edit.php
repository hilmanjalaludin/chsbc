<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Edit Configuration  </legend>
 <form name="frmEditConfig">
 
	<?php echo form()->hidden('ConfigID',null,$rows['ConfigID']);?>
	<table cellpadding="4px;" border=0 cellspacing="3">
		<tr>
			<td class="text_caption">* Reference Code </td>
			<td colspan="1"><?php echo form()->combo('refConfigCode','select long',$space, $rows['ConfigCode'], array("change"=>"Ext.Cmp('ConfigCode').setValue(this.value);"));?></td>
		</tr>
		<tr>
			<td class="text_caption">* Config Code </td>
			<td colspan="1"> <?php echo form()->input('ConfigCode','input_text long',$rows['ConfigCode']);?> </td>
		</tr>
		<tr>
			<td class="text_caption">* Config Name </td>
			<td colspan="1"> <?php echo form()->input('ConfigName','input_text long',$rows['ConfigName']);?> </td>
		</tr>
		<tr>
			<td class="text_caption">* Config Value</td>
			<td><?php echo form()->input('ConfigValue','select long',$rows['ConfigValue']);?></td>
		</tr>
		<tr>
			<td class="text_caption">* Status</td>
			<td><?php echo form()->combo('ConfigFlags','select long',array('1'=>'Active','0'=>'Not Active'),$rows['ConfigFlags']);?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="button" class="update button" onclick="Ext.DOM.UpdateConfig();" value="Update">
				<input type="button" class="close button" onclick="Ext.Cmp('span_top_nav').setText('');" value="Close">	
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	</form>
</fieldset>	
</div>