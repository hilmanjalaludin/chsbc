<?php ?>

<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first" width="5%">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_lastcall').setChecked();">#</a></th>	
		<th nowrap class="custom-grid th-middle">&nbsp;No</th>	
		<th nowrap class="custom-grid th-middle">&nbsp;Start Date</th>        
        <th nowrap class="custom-grid th-middle">&nbsp;End Date </th>
		<th nowrap class="custom-grid th-middle">&nbsp;Start Time </th>
		<th nowrap class="custom-grid th-middle">&nbsp;End Time </th>
		<th nowrap class="custom-grid th-middle">&nbsp;Create Date </th>
		<th nowrap class="custom-grid th-middle">&nbsp;Create By </th>
		<th nowrap class="custom-grid th-middle">&nbsp;Status </th>
		<th nowrap class="custom-grid th-lasted">&nbsp;Reason</th>
	</tr>
</thead>	
<style>
	.hover:hover{color:blue;cursor:pointer;font-size:11px;}
</style>
<tbody>
<?php
 $no  = $num;
 foreach( $page -> result_assoc() as $rows ) { 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>	
	<tr CLASS="onselect" bgcolor="<?php echo $color;?>">
		<td nowrap class="content-first"><input type="checkbox" value="<?php echo $rows['LastCallId']; ?>" name="chk_lastcall" id="chk_lastcall"></td>
		<td nowrap class="content-middle" style="padding:3px;"><?php echo $no ?></td>
		<td nowrap class="content-middle" style="padding:3px;"><?php echo $rows['LastCallStartDate']; ?></td>
		<td nowrap class="content-middle" style="padding:3px;"><?php echo $rows['LastCallEndDate']; ?></td>
		<td nowrap class="content-middle" style="padding:3px;"><?php echo $rows['LastCallStartTime']; ?></td>
		<td nowrap class="content-middle" style="padding:3px;"><?php echo $rows['LastCallEndTime']; ?></td>
		<td nowrap class="content-middle" style="padding:3px;"><?php echo $rows['LastCallCreateDate']; ?></td>
		<td nowrap class="content-middle" style="padding:3px;"><?php echo $rows['full_name']; ?></td>
		<td nowrap  class="content-middle" style="padding:3px;"><?php echo $rows['LastCallStatus']; ?></td>
		<td class="content-lasted hover"><div style="text-align:justify;width:160px;padding:2px;"><?php echo $rows['LastCallReason'];?></div></td>
	</tr>	
</tbody>
	<?php
		$no++;
		};
	?>
</table>



