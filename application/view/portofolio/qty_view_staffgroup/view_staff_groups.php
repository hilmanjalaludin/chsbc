<table border=0 align="left" cellspacing=1 width="60%">
	<tr height=24>
		<th class='font-standars ui-corner-top ui-state-default first center' width='5%'><a href="javascript:void(0);" onclick="Ext.Cmp('Quality_Group_Id').setChecked();">#</a></th>
		<th class='font-standars ui-corner-top ui-state-default first center' width='5%'> No. </th>
		<th class='font-standars ui-corner-top ui-state-default first left'>&nbsp;Quality Staff </th>
		<th class='font-standars ui-corner-top ui-state-default first left'>&nbsp;Quality Head </th>
		<th class='font-standars ui-corner-top ui-state-default first left'>&nbsp;Quality Skill </th>
	</tr>
	<?php 
		$no = 1;
		foreach( $view_staff_group  as $UserId => $array_group_staff ) : 
			$color= ($no%2!=0?'#FAFFF9':'#FFFFFF');
			$rows_index = join("|", array( $array_group_staff['Quality_Staff_id'], $array_group_staff['Quality_Skill_Id'])); 
	?>
		<tr height=24 class="onselect" bgcolor="<?php echo $color;?>" >
			<td class='content-first center' width='5%'><?php __(form() -> checkbox('Quality_Group_Id',null, $rows_index))?> </td>
			<td class='content-middle center' width='5%'><?php __($no); ?> </td>
			<td class='content-middle left'>&nbsp;<?php __($array_group_staff['QualityStaffUser']); ?> - <?php __($array_group_staff['QualityStaffName']); ?></td>
			<td class='content-middle left'>&nbsp;<?php __($array_group_staff['QualityHeadUser']); ?> - <?php __($array_group_staff['QualityHeadName']); ?></td>
			<td class='content-lasted left'>&nbsp;<?php __($array_group_staff['Quality_Skill_Desc']); ?></td>
		</tr>
	<?php 
		$no++;
		endforeach; ?>
</table>	


<br style="clear:both;">

