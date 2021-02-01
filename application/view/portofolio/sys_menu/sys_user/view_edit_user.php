<form name="frmEditUser">
<div class="box-shadow" style="padding:10px;">
 <fieldset class="corner">
 <legend class="icon-application"> &nbsp;&nbsp;&nbsp;Edit User</legend>
<table cellspacing="2" width="50%" border=0 style="margin-top:-5px;">
	<tr>
		<td class="text_caption"width="2%" nowrap>* UserId </td>
		<td width="70%"> 
			<?php echo form()->hidden('UserId', 'input_text long',$rows['UserId']);?> 
			<?php echo form()->input('textUserid', 'input_text long',$rows['Username'], null, array('disabled' => 1, 'style' => 'border:1px solid red;'));?> 
		</td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>Fullname </td>
		<td width="70%"><?php echo form()->input('textFullname','input_text long',$rows['full_name'],null, array('style' => 'border:1px solid red;'));?></td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>Agent Code </td>
		<td width="70%"><?php echo form()->input('textAgentcode','input_text long',$rows['init_name'],null, array('style' => 'border:1px solid red;'));?></td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>Previleges </td>
		<td><?php echo form()->combo('user_profile','select long', $User -> _get_handling_type(), $rows['handling_type'], null, array('style' => 'border:1px solid red;'));?></td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>Team Leader</td>
		<td><?php echo form()->combo('team_leader','select long', $User -> _get_teamleader(), $rows['tl_id'], NULL);?></td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>User Spv</td>
		<td><?php echo form()->combo('user_spv','select long', $User -> _get_supervisor(), $rows['spv_id'], null, array('style' => 'border:1px solid red;'));?></td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>User Manager</td>
		<td><?php echo form()->combo('user_mgr','select long', $User -> _get_manager(), $rows['mgr_id'], null, array('style' => 'border:1px solid red;'));?></td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>User Admin</td>
		<td><?php echo form()->combo('user_admin','select long', $User -> _get_admin(), $rows['admin_id'] );?></td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>CC Group </td>
		<td><?php echo form()->combo('cc_group','select long', $User -> _get_agent_group(), $rows['agent_group'], null, array('style' => 'border:1px solid red;'));?></td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>Telphone</td>
		<td><?php echo form()->combo('user_telphone','select long', $User -> _get_telephone(), $rows['telphone'],null, array('style' => 'border:1px solid red;'));?></td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>&nbsp;</td>
		<td>
			<input type="button" class="update button" onclick="Ext.DOM.UpdateUser();" value="Update">
			<input type="button" class="close button" onclick="Ext.Cmp('panel-content').setText('');" value="Close">
		</td>
	</tr>
</table>

</fieldset>
</div>
</form>

<!-- END OF FILE -->
<!-- location : ./application/view/user/view_add_user.php