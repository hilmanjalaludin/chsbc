<table border=0 align="left" cellspacing=1 cellspacing="1px">
	<tr>
		<th class="font-standars ui-corner-top ui-state-default first">&nbsp;Call Status</td>
		<th class="font-standars ui-corner-top ui-state-default first">&nbsp;Call Type</td>	
		<th class="font-standars ui-corner-top ui-state-default first">&nbsp;Summary</td>
		<th class="font-standars ui-corner-top ui-state-default first">&nbsp;Action</td>
	</tr>
<?php 
$spanData = "<img src=\"". base_url() ."library/gambar/icon/zoom.png\">";
$no= 0;
foreach( $CallResultData as $rows ) { 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>	
<tr CLASS="onselect" bgcolor="  <?php echo $color;?>">
	<td class="content-first left" WIDTH="12%"><div class="text-content left-text"><?php echo ucfirst(strtolower($rows['CallReasonDesc'])); ?></div></td>
	<td class="content-middle left" WIDTH="12%"><div class="text-content center-text"><?php echo $rows['CallType']; ?></div></td>
	<td class="content-middle center" WIDTH="12%"><div class="text-content center-text"><?php echo $rows['Jumlah']; ?></div></td>
	<td class="content-lasted center" WIDTH="12%">
			<span style="cursor:pointer;" onclick="javascript:ShowByResult('<?php echo $rows['CallReasonId'];?>');"><?php echo $spanData;?></span>
			
	</td>
</tr>	
<?php 
	$no++;
} ?>	
</table>