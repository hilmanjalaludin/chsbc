<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Add Privilege</legend>
 
<table cellspacing="6px;">
	<tr>
		<td class="text_caption" nowrap>PrivilegeName </td>
		<td> <?php echo form()-> input('name', 'input_text long',NULL);?> </td>
	</tr>
	
	<tr>
		<td class="text_caption" nowrap>Create By </td>
		<td> <?php echo form()-> input('updated_by', 'input_text long',$this -> EUI_Session->_get_session('Fullname'));?> </td>
	</tr>
	
	<tr>
		<td class="text_caption" nowrap>Status</td>
		<td> <?php echo form()-> combo('IsActive', 'select long',array('1'=>'Active','0'=>'Not Active'),1);?> </td>
	</tr>
	
	<tr>
		<td class="text_caption" nowrap>Create Date</td>
		<td> <?php echo form()-> input('last_update', 'input_text long',date('Y-m-d H:i:s'));?> </td>
	</tr>
	
	<tr>
		<td class="text_caption" nowrap>&nbsp;</td>
		<td>
			<input type="button" class="update button" onclick="Ext.DOM.SavePrivileges();" value="Save"></td>
	</tr>
	
	
</table>
</fieldset>
</div>
<!-- END OF FILE -->
<!-- location : ./application/view/user/view_add_user.php