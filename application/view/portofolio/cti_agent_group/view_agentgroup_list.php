<?php ?>

<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first center" width="5%">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_reason').setChecked();">#</a></th>	
		<th nowrap class="custom-grid th-middle">&nbsp;No</th>	
        <th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.code');">&nbsp;Code</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.description');">&nbsp;Description</span></th>   
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.direction');">&nbsp;Direction</span></th>   
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.hunting_number');">&nbsp;Hunting Number</span></th>  
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.group_type');">&nbsp;Group Type</span></th>   
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.overflow_group');">&nbsp;Overflow group</span></th>   
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.autoacw');">&nbsp;Auto ACW</span></th>   
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.autoacwtime');">&nbsp;Auto ACW Time</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.autoacwreason');">&nbsp;Auto Acw reason</span></th>
		<th nowrap class="custom-grid th-lasted"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.status_active');">&nbsp;Status </span></th>
		
	</tr>
</thead>	
<tbody>
<?php
 $no  = $num;
 foreach( $page -> result_assoc() as $rows ) { 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>	
	<tr CLASS="onselect" bgcolor="<?php echo $color;?>">
		<td class="content-first"><input type="checkbox" value="<?php echo $rows['id']; ?>" name="chk_reason" id="chk_reason"></td>
		<td class="content-middle"><?php echo $no ?></td>
		<td class="content-middle"><?php echo $rows['code']; ?></td>
		<td class="content-middle"><?php echo $rows['description']; ?></td>
		<td class="content-middle"><?php echo $rows['direction']; ?></td>
		<td class="content-middle"><?php echo $rows['hunting_number']; ?></td>
		<td class="content-middle"><?php echo $rows['group_type']; ?></td>
		<td class="content-middle"><?php echo $rows['overflow_group']; ?></td>
		<td class="content-middle"><?php echo $rows['autoacw']; ?></td>
		<td class="content-middle"><?php echo $rows['autoacwtime']; ?></td>
		<td class="content-middle"><?php echo $rows['autoacwreason']; ?></td>
		<td class="content-lasted"><?php echo ($rows['status_active']?'Active':'Not Active'); ?></td>
		
		
		
	</tr>	
</tbody>
	<?php
		$no++;
		};
	?>
</table>



