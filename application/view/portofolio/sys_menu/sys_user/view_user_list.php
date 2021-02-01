<!-- test --->
<?php  ?>
<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_menu').setChecked();">#</a></th>	
		<th nowrap class="custom-grid th-middle">&nbsp;No.</th>	
		<th nowrap class="custom-grid th-middle">&nbsp;<span class="header_order" id ="a.UserId" onclick="Ext.EQuery.orderBy(this.id);">User ID</span></th>
		<th nowrap class="custom-grid th-middle">&nbsp;<span class="header_order" id ="a.full_name" onclick="Ext.EQuery.orderBy(this.id);">User Name.</span></th>      
        <th nowrap class="custom-grid th-middle">&nbsp;<span class="header_order" id ="d.name" onclick="Ext.EQuery.orderBy(this.id);">Previleges.</span></th>
		<th nowrap class="custom-grid th-middle">&nbsp;<span class="header_order" id ="a.tl_id" onclick="Ext.EQuery.orderBy(this.id);">Leader.</span></th>
		<th nowrap class="custom-grid th-middle">&nbsp;<span class="header_order" id ="a.spv_id" onclick="Ext.EQuery.orderBy(this.id);">Supervisor.</span></th>
		<th nowrap class="custom-grid th-middle">&nbsp;<span class="header_order" id ="a.mgr_id" onclick="Ext.EQuery.orderBy(this.id);">Manager.</span></th>
		<th nowrap class="custom-grid th-middle">&nbsp;<span class="header_order" id ="e.description" onclick="Ext.EQuery.orderBy(this.id);">CC Group.</span></th>
		<th nowrap class="custom-grid th-middle">&nbsp;<span class="header_order" id ="a.telphone" onclick="Ext.EQuery.orderBy(this.id);">Telephone.</span></th>
		<th nowrap class="custom-grid th-middle">&nbsp;<span class="header_order" id ="a.user_state" onclick="Ext.EQuery.orderBy(this.id);">User State.</span></th>
		<th nowrap class="custom-grid th-middle">&nbsp;<span class="header_order" id ="a.logged_state" onclick="Ext.EQuery.orderBy(this.id);">User Status.</span></th>
		<th nowrap class="custom-grid th-lasted">&nbsp;<span class="header_order" id ="a.ip_address" onclick="Ext.EQuery.orderBy(this.id);">IP Location.</span></th>
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
			<td class="content-first"> <?php echo form()->checkbox('chk_menu',null,$rows['UserId']);?></td>
			<td class="content-middle"><?php echo $no; ?></td>
			<td class="content-middle"><?php echo $rows['id']; ?></td>
			<td class="content-middle"><?php echo $rows['full_name']; ?></td>
			<td class="content-middle"><?php echo $rows['profile_id']; ?></td>
			<td class="content-middle"><?php echo $rows['Leader']; ?></td>
			<td class="content-middle"><?php echo $rows['Spv']; ?></td>
			<td class="content-middle"><?php echo $rows['Manager']; ?></td>
			<td class="content-middle"><?php echo $rows['cc_group']; ?></td>
			<td class="content-middle" align='center'><?php echo $rows['telphone']; ?></td>
			<td class="content-middle"><?php echo $rows['user_state']; ?></td>
			<td class="content-middle"><span style="font-weight:normal;color:<?php echo ($rows['isLogin']==1?'green':'red');?>;" > <?php echo $rows['logged_state']; ?></span></td>
			<td class="content-lasted" style="color:red;"><?php echo ($rows['ip_address']?$rows['ip_address']:'-'); ?></td>
		</tr>
</tbody>
<?php
	$no++; };
?>
</table>
	
<!-- END OF FILE  -->
<!-- location : // ../application/layout/user/view_user_list.php -->