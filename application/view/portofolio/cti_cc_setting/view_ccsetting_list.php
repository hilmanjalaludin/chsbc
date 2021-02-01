<?php ?>

<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first center" width="5%">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_skill').setChecked();">#</a></th>	
		<th nowrap class="custom-grid th-middle">&nbsp;No</th>	
        <th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.instance_id');">&nbsp;Instance</span></th>
		 <th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.set_modul');">&nbsp;Modul</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.set_name');">&nbsp;Set Name</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.set_type');">&nbsp;Set Type</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.set_value');">&nbsp;Set Value</span></th>
		<th nowrap class="custom-grid th-lasted"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.set_comment');">&nbsp;Note</span></th>
		
	</tr>
</thead>	
<tbody>
<?php
 $no  = $num;
 foreach( $page -> result_assoc() as $rows ) { 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>	
	<tr CLASS="onselect" bgcolor="<?php echo $color;?>">
		<td class="content-first"><input type="checkbox" value="<?php echo $rows['id']; ?>" name="chk_skill" id="chk_skill"></td>
		<td class="content-middle"><?php echo $no ?></td>
		<td class="content-middle"><?php echo $rows['instance_id']; ?></td>
		<td class="content-middle"><?php echo $rows['set_modul']; ?></td>
		<td class="content-middle"><?php echo $rows['set_name']; ?></td>
		<td class="content-middle"><?php echo $rows['set_type']; ?></td>
		<td class="content-middle"><?php echo $rows['set_value']; ?></td>
		<td class="content-lasted"><?php echo $rows['set_comment']; ?></td>
	</tr>	
</tbody>
	<?php
		$no++;
		};
	?>
</table>



