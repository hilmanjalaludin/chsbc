
<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		
		<th nowrap class="custom-grid th-first center" >&nbsp;<a href="javascript:void(0);" onclick="javascript:Ext.Cmp('cmp_check_list').setChecked();">#</a> </th>	
		<th nowrap class="custom-grid th-middle" style="text-align:left;">&nbsp;No</th>  
		<th nowrap class="custom-grid th-middle" style="text-align:left;">&nbsp;<span class="header_order" id ="CampaignGroupCode" onclick="extendsJQuery.orderBy(this.id);">Campaign Core ID</span></th>        
        <th nowrap class="custom-grid th-middle" style="text-align:left;">&nbsp;<span class="header_order" id ="CampaignGroupName" onclick="extendsJQuery.orderBy(this.id);">Campaign Core Name</span></th>
		<th nowrap class="custom-grid th-lasted" style="text-align:left;">&nbsp;Status</th>
	</tr>
</thead>	
<tbody>
<?php
	$no  = $num;
	foreach( $page -> result_assoc() as $rows )
	{ 
?>
	<tr CLASS="onselect">
		<td class="content-first" width="5%"><?php echo form() -> checkbox('cmp_check_list',NULL,$rows['campaignGroupId']); ?></td>
		<td class="content-middle" width="5%"><?php echo $no ?></td>
		<td class="content-middle" width="30%"><?php echo $rows['CampaignGroupCode']; ?></td>
		<td class="content-middle" width="30%"><?php echo $rows['CampaignGroupName']; ?></td>
		<td class="content-lasted" width="30%"><?php echo $rows['campaignStatusCore'];?></td>
	</tr>	
</tbody>
<?php
	$no++;
   };
?>
</table>