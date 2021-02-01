<?php ?>

<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first center" width="5%">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_skill').setChecked();">#</a></th>	
		<th nowrap class="custom-grid th-middle">&nbsp;No</th>	
        <th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.hunting_number');">&nbsp;Hunting Number</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.description');">&nbsp;Description</span></th>
		<th nowrap class="custom-grid th-lasted"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.agent_group');">&nbsp;Agent Group</span></th>
		
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
		<td class="content-middle"><?php echo $rows['hunting_number']; ?></td>
		<td class="content-middle"><?php echo $rows['description']; ?></td>
		<td class="content-lasted"><?php echo $rows['AgentGroupName']; ?></td>
	</tr>	
</tbody>
	<?php
		$no++;
		};
	?>
</table>



