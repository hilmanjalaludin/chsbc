<?php ?>
<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first " width="5%">&nbsp;#</th>	
		<th class="custom-grid th-middle" width="5%"  align="center">&nbsp;<span class="header_order" onclick="extendsJQuery.orderBy('a.BranchId');" title="Order ASC/DESC">No</span></th>	
		<th class="custom-grid th-middle" width="8%"  align="center">&nbsp;<span class="header_order" onclick="extendsJQuery.orderBy('a.BranchCode');" title="Order ASC/DESC">Branch Code</span></th>		
		<th class="custom-grid th-middle" width="12%" align="left">&nbsp;<span class="header_order" onclick="extendsJQuery.orderBy('a.BranchName');" title="Order ASC/DESC">Branch Name.</span></th>    
		<th class="custom-grid th-middle" width="15%" align="left">&nbsp;<span class="header_order" onclick="extendsJQuery.orderBy('a.BranchManager');" title="Order ASC/DESC">Branch Manager.</span></th>
		<th class="custom-grid th-middle" width="15%" align="left">&nbsp;<span class="header_order" onclick="extendsJQuery.orderBy('a.BranchContact');" title="Order ASC/DESC">Branch Contact Phone.</span></th>
		<th class="custom-grid th-middle" width="15%" align="left">&nbsp;<span class="header_order" onclick="extendsJQuery.orderBy('a.BranchName');" title="Order ASC/DESC">Branch Address.</span></th>
		<th class="custom-grid th-middle" width="15%" align="left">&nbsp;<span class="header_order" onclick="extendsJQuery.orderBy('a.BranchEmail');" title="Order ASC/DESC">Branch Mail.</span></th>
		<th class="custom-grid th-lasted" width="20%" align="left" nowrap>&nbsp;<span class="header_order" onclick="extendsJQuery.orderBy('a.BranchFlags');" title="Order ASC/DESC">Branch Status.</span></th>
		
	</tr>
</thead>	
<tbody>
<?php
$no  = $num;
 foreach( $page -> result_assoc() as $rows )
 { 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>
			<tr class="onselect" bgcolor="<?php echo $color; ?>">
				<td class="content-first" ><?php $db -> DBForm -> jpCheck('BranchId',NULL,$rows['BranchId'], NULL, NULL,0);?></td>
				<td class="content-middle" align="center"><?php echo $no; ?></td>
				<td class="content-middle" align="center"><?php echo ($rows['BranchCode']?$rows['BranchCode']:'-'); ?></td>
				<td class="content-middle" ><?php echo ($rows['BranchName']?$rows['BranchName']:'-');?></td>
				<td class="content-middle" ><?php echo ($rows['BranchManager']?$rows['BranchManager']:'-');?></td>
				<td class="content-middle" ><?php echo ($rows['BranchContact']?$rows['BranchContact']:'-');?></td>
				<td class="content-middle" ><div class="wraptext"><?php echo ($rows['BranchAddress']?$rows['BranchAddress']:'-');?></div></td>
				<td class="content-middle" ><?php echo ($rows['BranchEmail']?$rows['BranchEmail']:'-');?></td>
				<td class="content-lasted" align="justify" nowrap><?php echo ($rows['BranchFlags']?'Active':'Not Active');?></td>
			</tr>	
</tbody>
	<?php
		$no++;
		};
	?>
</table>