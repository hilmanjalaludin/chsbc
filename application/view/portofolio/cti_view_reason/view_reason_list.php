<?php ?>

<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first center" width="5%">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_reason').setChecked();">#</a></th>	
		<th nowrap class="custom-grid th-middle">&nbsp;No</th>	
        <th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.reason_tipe');">&nbsp;Reason Type</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.reason_code');">&nbsp;Reason Code</span></th>   
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.reason_desc');">&nbsp;Reason Desc</span></th>   
		<th nowrap class="custom-grid th-lasted"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.reason_timeout');">&nbsp;Reason Timeout</span></th>   
		
	</tr>
</thead>	
<tbody>
<?php
 $no  = $num;
 foreach( $page -> result_assoc() as $rows ) { 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>	
	<tr CLASS="onselect" bgcolor="<?php echo $color;?>">
		<td class="content-first"><input type="checkbox" value="<?php echo $rows['reasonid']; ?>" name="chk_reason" id="chk_reason"></td>
		<td class="content-middle"><?php echo $no ?></td>
		<td class="content-middle"><?php echo $rows['reason_tipe']; ?></td>
		<td class="content-middle"><?php echo $rows['reason_code']; ?></td>
		<td class="content-middle"><?php echo $rows['reason_desc']; ?></td>
		<td class="content-lasted"><?php echo $rows['reason_timeout']; ?></td>
		
		
	</tr>	
</tbody>
	<?php
		$no++;
		};
	?>
</table>



