<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_menu').setChecked();">#</a></th>		
		<th nowrap class="custom-grid th-middle" align="center">&nbsp;No.</th>
		<th nowrap class="custom-grid th-middle">&nbsp;Menu ID</th>
		<th nowrap class="custom-grid th-middle">&nbsp;Menu Name.</th>        
        <th nowrap class="custom-grid th-middle">&nbsp;Group Menu.</th>
		<th nowrap class="custom-grid th-middle">&nbsp;Controller.</th>
		<th nowrap class="custom-grid th-lasted">&nbsp;Status.</th>
	</tr>
</thead>	
<tbody>
<?php
	$no  = $num;
	foreach( $page -> result_assoc() as $rows )
	{ 
		$color= ($no%2!=0?'#FAFFF9':'#FFFFFF');
?>
	<tr class="onselect" bgcolor="<?php echo $color;?>">
		<td class="content-first"> <?php echo form()->checkbox('chk_menu',null,$rows['id']);?> </td>
		<td class="content-middle" align="center"> <?php echo $no; ?></td>
		<td class="content-middle"> <?php echo $rows['id']; ?></td>
		<td class="content-middle"> <?php echo $rows['menu']; ?></td>
		<td class="content-middle" >
			<span id="textm_<?php echo $rows['id'];?>" onclick="choiceGroup('<?php echo $rows['id']; ?>');"><?php echo ($rows['GroupName']!=''?$rows['GroupName']:'Uknown'); ?></span>
			<span id="menu_<?php echo $rows['id'];?>"></span></td>
		<td class="content-middle"><?php echo $rows['file_name']; ?></td>
		<td class="content-lasted"><?php echo $rows['status']; ?></td>
	</tr>
</tbody>
<?php
		$no++; 
   };
?>
</table>