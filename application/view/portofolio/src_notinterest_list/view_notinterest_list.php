<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first">&nbsp;#</th>	
		<th nowrap class="custom-grid th-middle" align='left'>&nbsp;<b style='color:#608ba9;'>No</b></th>			
		<th nowrap class="custom-grid th-middle" align='left'>&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('a.CustomerFirstName');"><b style='color:#608ba9;'>Cust Name</b></span></th>   
		<th nowrap class="custom-grid th-middle" align='left'>&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('g.CallReasonCategoryName');"><b style='color:#608ba9;'>Call Status</b></span></th>
        <th nowrap class="custom-grid th-middle" align='left'>&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('f.CallReasonCode');"><b style='color:#608ba9;'>Last Reason Status</b></span></th>
		<th nowrap class="custom-grid th-lasted" align='left'>&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('a.CustomerUpdatedTs');"><b style='color:#608ba9;'>Last Call Date</b></span></th>
	</tr>
</thead>	
<tbody>
<?php
$no = $num;
foreach( $page -> result_assoc() as $rows )
{ 
  $color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>
	<tr class="onselect">
		<td class="content-first" width='5%'><input type="checkbox" value="<?php echo $rows['CustomerId']."_".$rows['CampaignId']."_".$rows['CallReasonId']; ?>" name="chk_cust_call" name="chk_cust_call" <?php echo ($db->getSession('handling_type')!=4?'disabled':'');?> ></td>
		<td class="content-middle" width='5%'><?php  echo $no; ?></td>
		<td class="content-middle" width='15%' nowrap style="color:green;font-weight:bold;"><?php echo $rows['CustomerFirstName']; ?></td>
		<td class="content-middle" width='15%' style="color:green;"><?php echo $rows['CallReasonCategoryName']; ?></td>
		<td class="content-middle" width='15%' style="color:green;"><?php echo $rows['CallReasonCode']; ?></td>
		<td class="content-lasted" width='15%'><?php echo $rows['CustomerUpdatedTs']; ?></td>
	</tr>	
</tbody>
<?php
 $no++;
};
?>
</table>


