<table  width="99%" class="custom-grid" cellspacing="1" align='center'>
<tr height=24>
	<td class="font-standars ui-state-default ui-corner-top ui-state-focus center"><a href="javascript:void(0);"  onclick="Ext.Cmp('chk_user_id').setChecked();">#</a></td>
	<td class="font-standars ui-state-default ui-corner-top ui-state-focus">No </td>
	<td class="font-standars ui-state-default ui-corner-top ui-state-focus">User ID </td>
	<td class="font-standars ui-state-default ui-corner-top ui-state-focus">User Name </td>
	<td class="font-standars ui-state-default ui-corner-top ui-state-focus">Leader Name </td>
	<td class="font-standars ui-state-default ui-corner-top ui-state-focus">Size Data</td>
	<td class="font-standars ui-state-default ui-corner-top ui-state-focus">Amount </td>
</tr>
<?php 
$no = 1;
foreach( $Manual as $k => $rows ) { 
$color = ($no%2!=0?'#FFFEEE':'#FFFFFF'); 
?>
	<tr bgcolor="<?php echo $color; ?>" class="onselect">
		 <td class="content-first"><?php  echo form() -> checkbox('chk_user_id',NULL,$rows['UserId'], array("click"=>"UncheckSize(this);") ); ?></td>
		 <td class="content-middle"><?php echo ($no);?></td>
		 <td class="content-middle"><?php echo $rows['id'];?></td>
		 <td class="content-middle"><?php echo $rows['full_name'];?></td>
		 <td class="content-middle"><?php echo $rows['full_name_spv'];?></td>
		 <td class="content-middle"><?php echo $rows['size']; ?></td>
		 <td class="content-lasted" align="center"><?php echo form() -> input("amount_data_".$rows['UserId'],"input_text", null, array("keyup"=>"BalanceUserSize(this);" ), array("style" =>"width:50px;height:18px;" ) ); ?></td>
	</tr>
<?php 
$no++;
} 

?>

				
				