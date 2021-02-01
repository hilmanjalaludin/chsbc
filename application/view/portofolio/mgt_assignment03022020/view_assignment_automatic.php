<table  width="99%" class="custom-grid" cellspacing="1" align='center'>
<tr height=24>
	<th class="font-standars ui-state-default ui-corner-top ui-state-focus center"><a href="javascript:void(0);"  onclick="Ext.Cmp('chk_user_id').setChecked();">#</a></th>
	<th class="font-standars ui-state-default ui-corner-top ui-state-focus">No </th>
	<th class="font-standars ui-state-default ui-corner-top ui-state-focus">User ID </th>
	<th class="font-standars ui-state-default ui-corner-top ui-state-focus">User Name </th>
	<th class="font-standars ui-state-default ui-corner-top ui-state-focus">Leader Name </th>
	<th class="font-standars ui-state-default ui-corner-top ui-state-focus">Size Data</th>
</tr>
<?php 
$no = 1;
foreach( $Manual as $k => $rows ) 
{ 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF'); 
?>
	<tr bgcolor="<?php echo $color; ?>" class="onselect">
		 <td class="content-first"><?php  echo form() -> checkbox('chk_user_id',NULL,$rows['UserId'], array("click"=>"UncheckSize(this);") ); ?></td>
		 <td class="content-middle"><?php echo ($no);?></td>
		 <td class="content-middle"><?php echo $rows['id'];?></td>
		 <td class="content-middle"><?php echo $rows['full_name'];?></td>
		 <td class="content-middle"><?php echo $rows['full_name_spv'];?></td>
		 <td class="content-middle"><?php echo $rows['size']; ?></td>
	</tr>
<?php 
$no++;
} ?>

				
				