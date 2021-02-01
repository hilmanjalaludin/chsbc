<?php ?>

<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first" width="5%" align="center">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_config').setChecked();">#</a></th>	
		<th nowrap class="custom-grid th-middle center">&nbsp;No</th>	
		<th nowrap class="custom-grid th-middle" align="left"><span class="header_order" id ="a.CallReasonCode" onclick="Ext.EQuery.orderBy(this.id);">Config Code </b></span></th>        
        <th nowrap class="custom-grid th-middle" align="left"><span class="header_order" id ="a.CallReasonDesc" onclick="Ext.EQuery.orderBy(this.id);">Config Name </b></span></th>
		  <th nowrap class="custom-grid th-middle" align="left"><span class="header_order" id ="a.CallReasonDesc" onclick="Ext.EQuery.orderBy(this.id);">Config Value </b></span></th>
		<th nowrap class="custom-grid th-lasted center" align="left"><span class="header_order" id ="a.CallReasonContactedFlag" onclick="Ext.EQuery.orderBy(this.id);">Status</span></th>
	</tr>
</thead>	
<tbody>
<?php
 $no  = $num;
 foreach( $page -> result_assoc() as $rows ) { 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>	
	<tr CLASS="onselect" bgcolor="<?php echo $color;?>">
		<td class="content-first"><input type="checkbox" value="<?php echo $rows['ConfigID']; ?>" name="chk_config" id="chk_config"></td>
		<td class="content-middle center"><?php echo $no ?></td>
		<td class="content-middle"><b><?php echo $rows['ConfigCode']; ?></b></td>
		<td class="content-middle"><?php echo $rows['ConfigName']; ?></td>
		<td class="content-middle"><?php echo $rows['ConfigValue']; ?></td>
		<td class="content-lasted center"><?php echo ($rows['ConfigFlags'] ? 'Actiive':'Not Active'); ?></td>
	</tr>	
</tbody>
	<?php
		$no++;
		};
	?>
</table>



