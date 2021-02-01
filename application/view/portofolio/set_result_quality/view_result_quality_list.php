<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first" width="5%">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_quality').setChecked();">#</a></th>	
		<th nowrap class="custom-grid th-middle" align="center"><span class="header_order">&nbsp;No</span></th>	
		<th nowrap class="custom-grid th-middle" align="left"><span class="header_order" id ="a.AproveCode" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;Result ID</span></th>        
        <th nowrap class="custom-grid th-middle" align="left"><span class="header_order" id ="a.AproveName" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;Result Name</span></th>
		<th nowrap class="custom-grid th-middle" align="left"><span class="header_order" id ="a.ApproveEskalasi" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;Back To User</span></th>
		<th nowrap class="custom-grid th-middle" align="left"><span class="header_order" id ="b.name" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;User Level</span></th>
		<th nowrap class="custom-grid th-middle" align="left"><span class="header_order" id ="a.ConfirmFlags" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;Confirm</span></th>
		<th nowrap class="custom-grid th-middle" align="left"><span class="header_order" id ="a.CancelFlags" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;Cancel</span></th>
		<th nowrap width="15%" align="center" class="custom-grid th-lasted"><span class="header_order" id ="a.AproveFlags" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;Status</span></th>
	</tr>
</thead>	
<tbody>
<?php
 $no  = $num;
 foreach( $page -> result_assoc() as $rows ) { 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>	
	<tr CLASS="onselect" bgcolor="<?php echo $color;?>">
		<td class="content-first"><input type="checkbox" value="<?php echo $rows['ApproveId']; ?>" name="chk_quality" id="chk_quality"></td>
		<td class="content-middle" align="center"><?php echo $no ?></td>
		<td class="content-middle"><?php echo $rows['AproveCode']; ?></td>
		<td class="content-middle"><?php echo $rows['AproveName']; ?></td>
		<td class="content-middle"><?php echo ($rows['ApproveEskalasi']?'Yes':'No'); ?></td>
		<td class="content-middle"><?php echo $rows['name']; ?></td>
		
		<td class="content-middle"><?php echo ($rows['ConfirmFlags']?'Yes':'No'); ?></td>
		<td class="content-middle"><?php echo ($rows['CancelFlags']?'Yes':'No'); ?></td>
		
		 <td align="center" class="content-lasted"><?php echo ($rows['AproveFlags']?'Active':'Not Active');?></td>
	</tr>	
</tbody>
<?php
	$no++;
};
?>
</table>



