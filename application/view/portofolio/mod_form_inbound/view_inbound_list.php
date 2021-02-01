<?php
 ?>
<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first">&nbsp;#</th>	
		<th nowrap class="custom-grid th-middle" align='left'>&nbsp;<b style='color:#608ba9;'>No</b></th>			
		<th nowrap class="custom-grid th-middle" align='left'>&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.CampaignName');"><b style='color:#608ba9;'>Campaign Name</b></span></th>   
		<th nowrap class="custom-grid th-middle" align='left'>&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.CustomerFirstName');"><b style='color:#608ba9;'>Cust Name</b></span></th>
        <th nowrap class="custom-grid th-middle" align='left'>&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.CustomerCity');"><b style='color:#608ba9;'>Cust City</b></span></th>
		<th nowrap class="custom-grid th-middle" align='left'>&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.GenderId');"><b style='color:#608ba9;'>DOB</b></span></th>
		<th nowrap class="custom-grid th-middle" align='left'>&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.GenderId');"><b style='color:#608ba9;'>Gender</b></span></th>
		<th nowrap class="custom-grid th-middle" align='left'>&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('f.CallReasonDesc');"><b style='color:#608ba9;'>Last Call Status</b></span></th>
		<th nowrap class="custom-grid th-lasted" align='left'>&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.CustomerUpdatedTs');"><b style='color:#608ba9;'>Incoming Date</b></span></th>
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
		<td class="content-first" width='5%'> <?php echo form() -> checkbox("CustomerId", null, $rows['CustomerId'],null, null); ?>
		<td class="content-middle" width='5%'><?php  echo $no; ?></td>
		<td class="content-middle" width='10%' nowrap style="color:green;font-weight:bold;"><?php echo $rows['CampaignName']; ?></td>
		<td class="content-middle" width='15%' style="color:green;"><?php echo $rows['CustomerFirstName']; ?></td>
		<td class="content-middle" width='10%' style="color:green;"><?php echo $rows['CustomerCity']; ?></td>
		<td class="content-middle" width='10%' style="color:green;"><?php echo ($rows['CustomerDOB']?$rows['CustomerDOB']:'-'); ?></td>
		<td class="content-middle" width='8%' style="color:green;"><?php echo ($rows['Gender']?$rows['Gender']:'-'); ?></td>
		<td class="content-middle" width='15%' style="color:green;"><?php echo $rows['CallResult']; ?></td>
		<td class="content-lasted" width='15%'><?php echo $rows['CustomerUpdatedTs']; ?></td>
	</tr>	
</tbody>
<?php
	$no++;
}

?>
</table>


