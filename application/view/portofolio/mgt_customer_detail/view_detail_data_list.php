<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first">&nbsp;#</th>	
		<th nowrap class="custom-grid th-middle">&nbsp;No</th>			
		<th nowrap class="custom-grid th-middle">&nbsp;Cust Number</th>
		<th nowrap class="custom-grid th-middle">&nbsp;Cust Name</th>        
        <th nowrap class="custom-grid th-middle">&nbsp;Home Phone</th>
		<th nowrap class="custom-grid th-middle">&nbsp;Mobile Phone</th>
		<th nowrap class="custom-grid th-middle">&nbsp;Office Phone</th>
        <th nowrap class="custom-grid th-middle">&nbsp;Last Call Status</th>
		<th nowrap class="custom-grid th-lasted">&nbsp;Last Call Date</th>
	</tr>
</thead>	
<tbody>
<?php
$no = $num;
foreach( $page -> result_assoc() as $rows )
{ 
  $color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
 ?>
	<tr class="onselect" bgcolor="<?php echo $color; ?>">
		<td class="content-first"><?php echo form() -> checkbox('chk_cust_call', null, $rows['CustomerId']); ?></td>
		<td class="content-middle"><?php echo $no; ?></td>
		<td class="content-middle"><?php echo $rows['CustomerNumber']; ?></td>
		<td class="content-middle"><?php echo $rows['CustomerFirstName']; ?></td>
		<td class="content-middle"><?php echo $this -> EUI_Tools -> _set_masking( $rows['CustomerHomePhoneNum'] ); ?></td>
		<td class="content-middle"><?php echo $this -> EUI_Tools -> _set_masking( $rows['CustomerMobilePhoneNum']); ?></td>
		<td class="content-middle"><?php echo $this -> EUI_Tools -> _set_masking( $rows['CustomerWorkPhoneNum'] ); ?></td>
		<td class="content-middle"><?php echo $rows['CallReasonCode']; ?></td>
		<td class="content-lasted"><?php echo $rows['CustomerUpdatedTs']; ?></td>
	</tr>	
</tbody>
<?php
	$no++;
};
?>
</table>


