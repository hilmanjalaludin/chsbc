<?php ?>

<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first center" width="5%">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_skill').setChecked();">#</a></th>	
		<th nowrap class="custom-grid th-middle">&nbsp;No</th>	
        <th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('b.pbx_name');">&nbsp;PBX Name</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('c.set_value');">&nbsp;PBX Address</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.ext_port');">&nbsp;Port</span></th>   
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.ext_number');">&nbsp;Ext Number</span></th>   
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.ext_desc');">&nbsp;Ext Description</span></th>  
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.ext_type');">&nbsp;Ext Type</span></th>  
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.ext_status');">&nbsp;Ext Status</span></th>  
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.tapi_id');">&nbsp;Tapi ID</span></th>  
		
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
		<td class="content-middle"><?php echo $rows['pbx_name']; ?></td>
		<td class="content-middle"><?php echo $rows['set_value']; ?></td>
		<td class="content-middle"><?php echo $rows['ext_port']; ?></td>
		<td class="content-middle"><?php echo $rows['ext_number']; ?></td>
		<td class="content-middle"><?php echo $rows['ext_desc']; ?></td>
		<td class="content-middle"><?php echo $rows['ext_type']; ?></td>
		<td class="content-middle"><?php echo $rows['ext_status']; ?></td>
		<td class="content-lasted"><?php echo $rows['tapi_id']; ?></td>
	</tr>	
</tbody>
	<?php
		$no++;
		};
	?>
</table>



