<table width="100%" class="custom-grid" cellspacing=1>
	<tr height='24'> 
		<th nowrap width="25"  class="font-standars ui-corner-top ui-state-default first">&nbsp;No.</th>
		<th nowrap width="180" class="font-standars ui-corner-top ui-state-default middle">&nbsp;Agent</th>
		<th nowrap width="30"  class="font-standars ui-corner-top ui-state-default middle">&nbsp;Ext</th>		
		<th nowrap width="100" class="font-standars ui-corner-top ui-state-default middle">&nbsp;Status</th>
		<th nowrap width="85"  class="font-standars ui-corner-top ui-state-default middle">&nbsp;Status Time</th>		
		<th nowrap width="180" class="font-standars ui-corner-top ui-state-default middle">&nbsp;Ext Status</th>
		<th nowrap width="120" class="font-standars ui-corner-top ui-state-default middle">&nbsp;Data</th>
		<th nowrap width="30"  class="font-standars ui-corner-top ui-state-default lasted">&nbsp;Spy</th>
</tr>

<?php 
foreach($Activity as $no => $rows )
{ 
	$num = ($no+1); 
	$color  = ( $num%2 == 0 ? '#FFFFFF' : 'FFFFEE' );
	
	?>
<tr class="onselect" bgcolor="<?php echo $color;?> ">
		<td nowrap class="content-first" >&nbsp;<?php echo $num; ?></td>
		<td nowrap class="content-middle">&nbsp;<span id="<?php echo $rows["UserId"]; ?>-name"><?php echo $rows["UserId"]." - ".$rows["UserName"];?></span></td>
		<td nowrap class="content-middle center">&nbsp;<span id="<?php echo $rows["UserId"]; ?>-ext"></span></td>
		<td nowrap class="content-middle center">&nbsp;<span id="<?php echo $rows["UserId"]; ?>-agentstatus"></span></td>
		<td nowrap class="content-middle center">&nbsp;<span id="<?php echo $rows["UserId"]; ?>-time"></span></td>
		<td nowrap class="content-middle center">&nbsp;<span id="<?php echo $rows["UserId"]; ?>-extstatus"></span></td>		
		<td nowrap class="content-middle center">&nbsp;<span id="<?php echo $rows["UserId"]; ?>-data"></span></td>
		<td nowrap class="content-lasted center">&nbsp;<span id="<?php echo $rows["UserId"]; ?>-spy"></span></td>
	</tr>
<?php } ?>	
