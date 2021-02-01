<div>
	<table cellspacing=1>
		<tr>
			<td class='text_caption bottom'> Group Name </td>
			<td class='bottom'><?php __(form()->input('GroupName', 'input_text long', null));?></td>
			<td class='bottom'><?php __(form()->button('GroupName', 'add button','Add'));?></td>
		</tr>	
		<tr>
			<td class='text_caption bottom'> Group Desc</td>
			<td class='bottom'><?php __(form()->input('GroupName', 'input_text long', null));?></td>
		</tr>	
		
		<tr>
			<td class='text_caption bottom'> Group List : </td>
			<td class='bottom'> <span id="group_list_add"> <?php __(form()->combo('GroupList', 'select long', array() ));?> </span></td>
		</tr>	
	</table>
</div>