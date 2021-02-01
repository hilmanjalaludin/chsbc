<?php ?>

<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first center" width="5%">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_db').setChecked();">#</a></th>	
		<th nowrap class="custom-grid th-middle">&nbsp;No</th>	
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.ChanelDescription');">&nbsp;Table Name </span></th>        
        <th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.ChanelDescription');">&nbsp;Engine</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.ChanelDescription');">&nbsp;Format</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.ChanelDescription');">&nbsp;Rows</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.ChanelDescription');">&nbsp;Data Length</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.ChanelDescription');">&nbsp;Index Length</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.ChanelDescription');">&nbsp;Data Free</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.ChanelDescription');">&nbsp;Auto Increment</span></th>
		<th nowrap class="custom-grid th-middle center"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.ChanelDescription');">&nbsp;Update Time</span></th>
		<th nowrap class="custom-grid th-middle center"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.ChanelDescription');">&nbsp;Collation</span></th>
		<th nowrap class="custom-grid th-lasted"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.ChanelDescription');">&nbsp;Size ( KB )</span></th>
	</tr>
</thead>	
<tbody>
<?php
 $no  = $number+1;
 foreach( $sheet_data as $rows ) 
 { 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
	
?>	
	<tr class="onselect" bgcolor="<?php echo $color;?>">
		<td class="content-first"><input type="checkbox" value="<?php echo $rows['NAME']; ?>" name="chk_db" id="chk_db"></td>
		<td class="content-middle center"><?php echo $no ?></td>
		<td class="content-middle">&nbsp;<?php echo $rows['NAME']; ?></td>
		<td class="content-middle left">&nbsp;<?php echo $rows['ENGINE']; ?></td>
		<td class="content-middle left">&nbsp;<?php echo $rows['FORMAT']; ?></td>
		<td class="content-middle right"><?php echo $rows['ROWS']; ?></td>
		<td class="content-middle right"><?php echo $rows['DATA_LENGTH']; ?></td>
		<td class="content-middle right"><?php echo $rows['INDEX_LENGTH']; ?></td>
		<td class="content-middle right"><?php echo $rows['DATA_FREE']; ?></td>
		<td class="content-middle right"><?php echo $rows['AUTO_INCREMENT']; ?></td>
		<td class="content-middle center"><?php echo $rows['UPDATE_TIME']; ?></td>
		<td class="content-middle center"><?php echo $rows['COLLATION']; ?></td>
		<td class="content-lasted right"><?php echo $rows['SIZE_DISK']; ?>&nbsp;</td>
	</tr>	
</tbody>
<?php
	$no++; };
?>
</table>
