
<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first" align="center">&nbsp;No.</th>	
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;Call Number</th>       
        <th nowrap class="custom-grid th-middle" align="left">&nbsp;Call Date </th>
		<th nowrap class="custom-grid th-lasted" align="left">&nbsp;End Call Date</th>
	</tr>
</thead>	
<tbody>
<?php
 $no  = $num;
 foreach( $page -> result_assoc() as $rows )
 { 
 $color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>
			<tr class="onselect" bgcolor="<?php echo $color;?>">
				<td class="content-first"><?php echo $no; ?></td>
				<td class="content-middle" style="color:blue;cursor:pointer;"><span onclick="javascript:getPhoneNumber();"><?php echo $rows['CallNumber'];?></span></td>
				<td class="content-middle"><?php echo $rows['CallDate']; ?></td>
				<td class="content-lasted"><?php echo $rows['CallDate']; ?></td>
			</tr>	
			
			
</tbody>
	<?php
		$no++;
		};
	?>
</table>