
<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_menu').setChecked();">#</a></th>		
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="Ext.EQuery.orderBy('a.GroupId');">&nbsp;Group ID</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="Ext.EQuery.orderBy('a.GroupName');">&nbsp;Group Name.</span></th>        
        <th nowrap class="custom-grid th-middle"><span class="header_order" onclick="Ext.EQuery.orderBy('a.GroupDesc');">&nbsp;Group Desc.</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="Ext.EQuery.orderBy('a.CreateDate');">&nbsp;Create date.</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="Ext.EQuery.orderBy('a.GroupShow');">&nbsp;Create By.</span></th>
		<th nowrap class="custom-grid th-lasted"><span class="header_order" onclick="Ext.EQuery.orderBy('a.CampaignName');">&nbsp;Group status.</span></th>
	</tr>
</thead>	
<tbody>
<?php
 $no  = $num;
 foreach( $page -> result_assoc() as $rows ){ ?>
	<tr class="onselect">
		<td class="content-first"><input type="checkbox" value="<?php echo $rows['GroupId']; ?>" name="chk_menu" id="chk_menu"></td>
		<td class="content-middle"><?php echo $rows['GroupId']; ?></td>
		<td class="content-middle"><?php echo $rows['GroupName']; ?></td>
		<td class="content-middle"><?php echo $rows['GroupDesc']; ?></td>
		<td class="content-middle"><?php echo $this -> EUI_Tools ->_datetime_indonesia($rows['CreateDate']); ?></td>
		<td class="content-middle"><?php echo $rows['UserCreate']; ?></td>
		<td class="content-lasted"><?php echo $rows['status'];?></td>
	</tr>	
</tbody>
<?php $no++; }; ?>
</table>