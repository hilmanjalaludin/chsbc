<form name="frmAddUser">
<div class="box-shadow" style="padding:10px;">
 <fieldset class="corner">
 <legend class="icon-application"> &nbsp;&nbsp;&nbsp;Add User</legend>
<table cellspacing="2" width="60%" Border=0 style="margin-top:-5px;">
	<tr>
		<td class="text_caption" width="3%" nowrap>* UserId </td>
		<td width="70%"> <?php echo form()-> input('textUserid', 'input_text long',NULL);?> </td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>Fullname </td>
		<td width="70%"><?php echo form()->input('textFullname','input_text long',NULL);?></td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>Agent Code </td>
		<td width="70%"><?php echo form()->input('textAgentcode','input_text long',NULL);?></td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>Previleges </td>
		<td><?php echo form()->combo('user_profile','select long', $User -> _get_handling_type(), NULL, NULL);?></td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>Team Leader</td>
		<td><?php echo form()->combo('team_leader','select long', $User -> _get_teamleader(), NULL, NULL);?></td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>User Spv</td>
		<td><?php echo form()->combo('user_spv','select long', $User -> _get_supervisor(), NULL, NULL);?></td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>User Manager</td>
		<td><?php echo form()->combo('user_mgr','select long', $User -> _get_manager(), NULL );?></td>
	</tr>
	
	<tr>
		<td class="text_caption" nowrap>User Admin</td>
		<td><?php echo form()->combo('user_admin','select long', $User -> _get_admin(), NULL );?></td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>CC Group </td>
		<td><?php echo form()->combo('cc_group','select long', $User -> _get_agent_group(), NULL );?></td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>Telphone</td>
		<td><?php echo form()->combo('user_telphone','select long', $User -> _get_telephone(), NULL);?></td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>&nbsp;</td>
		<td>
			<input type="button" class="save button" onclick="Ext.DOM.SaveUser();" value="Save">
			<input type="button" class="close button" onclick="Ext.Cmp('panel-content').setText('');" value="Close">
		</td>
	</tr>
</table>
</fieldset>
</div>
</form>

<!-- END OF FILE -->
<!-- location : ./application/view/user/view_add_user.php