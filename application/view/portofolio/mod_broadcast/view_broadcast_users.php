<?php ?>
<table width="99%" class="custom-grid" cellspacing="1">
 <tr height="24"> 
	<th nowrap class="font-standars ui-corner-top ui-state-default first"  align="center" width="10%">&nbsp;No</th>	
	<th nowrap class="font-standars ui-corner-top ui-state-default middle" align="center"  width="10%">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('Users').setChecked();">#</a></th>	
	<th nowrap class="font-standars ui-corner-top ui-state-default middle" align="left"  width="20%">&nbsp;User Name</th>
	<th nowrap class="font-standars ui-corner-top ui-state-default lasted" align="left"  width="70%">&nbsp;Full Name</th>
 </tr>
 

<?php 
 $no = 1;
 foreach( $Users as $UserKeys => $rows )
 { 	
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>
	<tr height="20" class="onselect" bgcolor="<?php echo $color;?>" /> 
		<td nowrap class="content-first"  align="center"><?php echo $no;?></td>	
		<td nowrap class="content-middle" align="center"><?php echo form() -> checkbox('Users',null,$UserKeys); ?></td>	
		<td nowrap class="content-middle" align="left"><?php echo $rows['code']; ?></td>	
		<td nowrap class="content-lasted" align="left"><?php echo $rows['name']; ?></td>
	</tr>
<?php 
 $no++;
}
?>
		
</table>