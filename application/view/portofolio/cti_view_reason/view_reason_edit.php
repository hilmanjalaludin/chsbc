<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Edit Reason Type </legend>	
  <form name="frmEditReasonType">
 <?php echo form() -> hidden('reasonid',null, $Reason['reasonid'])?>
	<table cellpadding="6px;">
	
	<tr>
		<td class="text_caption">* Reason Type </td>
		<td><?php echo form() -> input('reason_tipe','input_text long', $Reason['reason_tipe']);?></td>
	</tr>
	<tr>
		<td class="text_caption">* Reason Code </td>
		<td><?php echo form() -> input('reason_code','input_text long',$Reason['reason_code']);?></td>
	</tr>
	<tr>
		<td class="text_caption">* Description</td>
		<td><?php echo form() -> input('reason_desc','input_text long', $Reason['reason_desc']);?></td>
	</tr>
	
	<tr>
		<td class="text_caption">* Timeout</td>
		<td><?php echo form() -> input('reason_timeout','input_text long', $Reason['reason_timeout']);?> <span class="wrap">( "s) </span></td>
	</tr>
	
	<tr>
		<td class="text_caption">&nbsp;</td>
		<td>
			<input type="button" class="update button" onclick="Ext.DOM.Update();" value="Update">
			<input type="button" class="close button" onclick="Ext.Cmp('top-panel').setText('');" value="Close">
		</td>
	</tr>
</table>
 </form>
</fieldset>
</div>