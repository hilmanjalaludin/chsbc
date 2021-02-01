<?php ?>

<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_ext').setChecked();">#</a></th>	
		<th nowrap class="custom-grid th-middle">&nbsp;No.</th>	
		<th nowrap class="custom-grid th-middle center">&nbsp;<span class="header_order" id ="a.ext_number" onclick="Ext.EQuery.orderBy(this.id);">Ext. Number</span></th>
		<th nowrap class="custom-grid th-middle left">&nbsp;<span class="header_order" id ="c.full_name"  onclick="Ext.EQuery.orderBy(this.id);">User State</span></th>
		<th nowrap class="custom-grid th-middle left">&nbsp;<span class="header_order" id ="b.set_value"  onclick="Ext.EQuery.orderBy(this.id);">PBX Server</span></th>        
        <th nowrap class="custom-grid th-middle left">&nbsp;<span class="header_order" id ="a.ext_desc"   onclick="Ext.EQuery.orderBy(this.id);">Description</span> </th>
		<th nowrap class="custom-grid th-middle">&nbsp;<span class="header_order" id ="a.ext_type"   onclick="Ext.EQuery.orderBy(this.id);">Ext. Type </span></th>
		<th nowrap class="custom-grid th-middle">&nbsp;<span class="header_order" id ="a.ext_status" onclick="Ext.EQuery.orderBy(this.id);">Ext. Status</span></th>
		<th nowrap class="custom-grid th-lasted">&nbsp;<span class="header_order" id ="a.ext_location" onclick="Ext.EQuery.orderBy(this.id);">Ext. Location</span></th>
		
	</tr>
</thead>	
<tbody>
<?php

 $no  = $num;
 foreach( $page -> result_assoc() as $rows )
 { 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>	
		<tr class="onselect" bgcolor="<?php echo $color;?>">
			<td class="content-first"><input type="checkbox" value="<?php echo $rows['extId']; ?>" name="chk_ext" id="chk_ext"></td>
			<td class="content-middle"><?php echo $no; ?></td>
			<td class="content-middle center"><?php echo $rows['extNumber']; ?></td>
			<td class="content-middle left" style="color:blue;"><?php echo ($rows['full_name']?$rows['full_name']:'-'); ?></td>
			<td class="content-middle"><?php echo $rows['extPbx']; ?></td>
			<td class="content-middle"><?php echo ($rows['extDesc']?$rows['extDesc']:'-'); ?></td>
			<td class="content-middle  center"><?php echo $rows['extType']; ?></td>
			<td class="content-middle  center"><?php echo $rows['extStatus']; ?></td>
			<td class="content-lasted  center"><?php echo $rows['extLocation']; ?></td>
		</tr>		
</tbody>
<?php
	$no++;
};
?>
</table>