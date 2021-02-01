<!-- test -->
<?php  ?>
<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first center" width="5%">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_privileges').setChecked();">#</a></th>	
		<th nowrap class="custom-grid th-middle" width="5%">&nbsp;No.</th>	
		<th nowrap class="custom-grid th-middle" width="10%">&nbsp;<span class="header_order" id ="a.id" onclick="Ext.EQuery.orderBy(this.id);">Privileges ID</span></th>
		<th nowrap class="custom-grid th-middle left">&nbsp;<span class="header_order" id ="a.name" onclick="Ext.EQuery.orderBy(this.id);">Privileges Name.</span></th>  
		<th nowrap class="custom-grid th-middle left">&nbsp;<span class="header_order" id ="a.name" onclick="Ext.EQuery.orderBy(this.id);">Status.</span></th>  
		<th nowrap class="custom-grid th-middle left">&nbsp;<span class="header_order" id ="a.updated_by" onclick="Ext.EQuery.orderBy(this.id);">Create By.</span></th>        
        <th nowrap class="custom-grid th-lasted left">&nbsp;<span class="header_order" id ="a.last_update" onclick="Ext.EQuery.orderBy(this.id);">Create Date.</span></th>
	</tr>
</thead>	
<tbody>
<?php
	$no  = $num;
	foreach( $page -> result_assoc() as $rows )
	{
		$color= ($no%2!=0?'#FAFFF9':'#FFFFFF');
?>
		<tr class="onselect" bgcolor="<?php echo $color;?>">
			<td class="content-first center"> <?php echo form()->checkbox('chk_privileges',null,$rows['id']);?></td>
			<td class="content-middle center"><?php echo $no; ?></td>
			<td class="content-middle center"><?php echo $rows['id']; ?></td>
			<td class="content-middle"><?php echo $rows['name']; ?></td>
			<td class="content-middle"><?php echo ($rows['IsActive'] ? 'Active':'Not Active'); ?></td>
			<td class="content-middle"><?php echo $rows['updated_by']; ?></td>
			<td class="content-lasted"><?php echo $rows['last_update']; ?></td>
		</tr>
</tbody>
<?php
	$no++; };
?>
</table>
	
<!-- END OF FILE  -->
<!-- location : // ../application/layout/user/view_user_list.php -->