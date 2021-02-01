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
		<th nowrap class="custom-grid th-middle">&nbsp;Note</th>
		<th nowrap class="custom-grid th-lasted">&nbsp;Last Call Date</th>
	</tr>
</thead>	
<tbody>
	<?php
		//<?php echo getLastHistory( $rows['CustomerId'] );
// list tables &***************************
// list tables &***************************

$no = $num;
foreach( $page -> result_assoc() as $rows )
{ 
  $color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
	?>
			<tr class="onselect">
				<td class="content-first">
				<input type="checkbox" value="<?php echo $rows['CustomerId'] ?>" name="chk_cust_call" name="chk_cust_call" 
					<?php echo ($this -> have_get_session('HandlingType')!=4?'disabled':'');?> ></td>
				<td class="content-middle"><?php  echo $no; ?></td>
				<td class="content-middle"><?php echo $rows['CustomerNumber']; ?></td>
				<td class="content-middle" nowrap><?php echo $rows['CustomerFirstName']; ?></td>
				<td class="content-middle"><?php echo $rows['CustomerHomePhoneNum']; ?></td>
				<td class="content-middle"><?php echo $rows['CustomerMobilePhoneNum']; ?></td>
				<td class="content-middle"><?php echo $rows['CustomerWorkPhoneNum']; ?></td>
				<td class="content-middle"><?php echo $rows['CallReasonCode']; ?></td>
				<td class="content-middle"><div class="wraptext"></div></td>
				<td class="content-lasted"><?php echo $rows['CustomerUpdatedTs']; ?></td>
			</tr>	
</tbody>
	<?php
		$no++;
		};
	?>
</table>


