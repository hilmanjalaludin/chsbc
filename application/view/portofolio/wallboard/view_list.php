
<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		
		<th nowrap class="custom-grid th-first center" >&nbsp;<a href="javascript:void(0);" onclick="javascript:Ext.Cmp('cmp_check_list').setChecked();">#</a> </th>	
		<th nowrap class="custom-grid th-middle" style="text-align:left;">&nbsp;No</th>  
		<th nowrap class="custom-grid th-middle" style="text-align:left;">&nbsp;<span class="header_order" id ="daily_today" onclick="extendsJQuery.orderBy(this.id);">Daily Today Target</span></th>        
        <th nowrap class="custom-grid th-middle" style="text-align:left;">&nbsp;<span class="header_order" id ="mtd_h1" onclick="extendsJQuery.orderBy(this.id);">MTD H-1</span></th>
        <th nowrap class="custom-grid th-middle" style="text-align:left;">&nbsp;<span class="header_order" id ="month_target" onclick="extendsJQuery.orderBy(this.id);">Monthly Target</span></th>
		<th nowrap class="custom-grid th-lasted" style="text-align:left;">&nbsp;Product</th>
	</tr>
</thead>	
<tbody>
<?php
	$no  = $num;
	foreach( $page -> result_assoc() as $rows )
	{ 
?>
	<tr CLASS="onselect">
		<td class="content-first" width="5%"><?php echo form() -> checkbox('cmp_check_list',NULL,$rows['id']); ?></td>
		<td class="content-middle" width="5%"><?php echo $no ?></td>
		<td class="content-middle" width="30%"><?php echo $rows['daily_today']; ?></td>
		<td class="content-middle" width="30%"><?php echo $rows['mtd_h1']; ?></td>
		<td class="content-middle" width="15%"><?php echo $rows['month_target']; ?></td>
		<td class="content-lasted" width="15%"><?php echo $rows['product'];?></td>
	</tr>	
</tbody>
<?php
	$no++;
   };
?>
</table>