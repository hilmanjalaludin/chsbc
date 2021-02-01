<form name="frmAddLayout">
<div style="margin:5px;">
 <fieldset class="corner">
 <legend class="icon-application"> &nbsp;&nbsp;&nbsp;Add Layout</legend>
	<table border=0 cellspacing="6">
		<tr>
			<td class="text_caption">* Layout Name </td>
			<td><?php echo form()-> input('LayoutName','input_text long');?></td>
		</tr>
		<tr>
			<td class="text_caption">Author</td>
			<td><?php echo form()-> input('LayoutAuthor','input_text long');?></td>
		</tr>
		<tr>
			<td class="text_caption">Description </td>
			<td><?php echo form()-> textarea('LayoutDesc','textarea long');?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="button" class="save button" value="Save" onclick="Ext.DOM.SaveLayout();">
				<input type="button" class="close button" value="Close" onclick="Ext.Cmp('panel-content').setText('');">
			</td>
		</tr>
	</table>
</fieldset>
</div>	
</form>