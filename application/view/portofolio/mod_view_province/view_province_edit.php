<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Edit Province </legend>	
  <form name="frmEditProvince">
 <?php echo form() -> hidden('ProvinceId',null, $Province['ProvinceId'])?>
	<table cellpadding="6px;">
	<tr>
		<td class="text_caption">* Province Code</td>
		<td><?php echo form() -> input('ProvinceCode','input_text long',$Province['ProvinceCode']);?></td>
	</tr>
	<tr>
		<td class="text_caption">* Province Name </td>
		<td><?php echo form() -> input('Province','input_text long',$Province['Province']);?></td>
	</tr>
	
	<tr>
		<td class="text_caption">&nbsp;</td>
		<td>
			<input type="button" class="update button" onclick="Ext.DOM.Update();" value="Update">
			<input type="button" class="close button" onclick="Ext.Cmp('top-panel').setText('');" value="Close">
		</td>
	</tr>
</table>
 <form name="frmAddChanel">
</fieldset>
</div>