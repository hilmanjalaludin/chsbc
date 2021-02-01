<form name="frmEditLayout">
<div style="margin:5px;">
 <fieldset class="corner">
 <legend class="icon-application"> &nbsp;&nbsp;&nbsp;Edit Layout</legend>
 <?php echo form()-> hidden('Id','input_text long',$LayoutId);?>
 
	<table border=0 cellspacing="6">
		<tr>
			<td class="text_caption">* Layout Name </td>
			<td><?php echo form()-> input('Name','input_text long',$Layout['Name']);?></td>
		</tr>
		<tr>
			<td class="text_caption">Author</td>
			<td><?php echo form()-> input('Author','input_text long',$Layout['Author']);?></td>
		</tr>
		<tr>
			<td class="text_caption">Description </td>
			<td><?php echo form()-> textarea('Description','textarea long',$Layout['Description']);?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="button" class="update button" value="Update" onclick="Ext.DOM.UpdateLayout();">
				<input type="button" class="close button" value="Close" onclick="Ext.Cmp('panel-content').setText('');">
			</td>
		</tr>
	</table>
</fieldset>
</div>	
</form>