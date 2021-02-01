<?php ?>

<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first center" width="5%">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_province').setChecked();">#</a></th>	
		<th nowrap class="custom-grid th-middle">&nbsp;No</th>	
        <th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.ProvinceCode');">&nbsp;Province Code</span></th>
		<th nowrap class="custom-grid th-lasted"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.Province');">&nbsp;Province</span></th>   
		
	</tr>
</thead>	
<tbody>
<?php
 $no  = $num;
 foreach( $page -> result_assoc() as $rows ) { 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>	
	<tr CLASS="onselect" bgcolor="<?php echo $color;?>">
		<td class="content-first"><input type="checkbox" value="<?php echo $rows['ProvinceId']; ?>" name="chk_province" id="chk_province"></td>
		<td class="content-middle"><?php echo $no ?></td>
		<td class="content-middle"><?php echo $rows['ProvinceCode']; ?></td>
		<td class="content-lasted"><?php echo $rows['Province']; ?></td>
		
	</tr>	
</tbody>
	<?php
		$no++;
		};
	?>
</table>



