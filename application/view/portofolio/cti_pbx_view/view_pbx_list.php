<?php ?>

<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first center" width="5%">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_skill').setChecked();">#</a></th>	
		<th nowrap class="custom-grid th-middle">&nbsp;No</th>	
        <th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.pbx_name');">&nbsp;PBX Name</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.pbx_desc');">&nbsp;PBX Description</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.model');">&nbsp;Model</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.link_protocol');">&nbsp;Link Protocol</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.note');">&nbsp;Note</span></th>
		<th nowrap class="custom-grid th-lasted"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.status');">&nbsp;Status</span></th>
		
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
		<td class="content-middle"><?php echo $rows['pbx_desc']; ?></td>
		<td class="content-middle"><?php echo $rows['model']; ?></td>
		<td class="content-middle"><?php echo $rows['link_protocol']; ?></td>
		<td class="content-middle"><?php echo $rows['note']; ?></td>
		<td class="content-lasted"><?php echo ($rows['status']?'Active' : 'Not Active'); ?></td>
	</tr>	
</tbody>
	<?php
		$no++;
		};
	?>
</table>



