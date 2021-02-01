<?php ?>	
<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first" >&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_cust_call').setChecked();">#</a></th>	
		<th nowrap class="custom-grid th-middle">&nbsp;No</th>			
		<th nowrap class="custom-grid th-middle" style="text-align:left;">&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('e.CampaignName');">Campaign Name</span></th>
		<th nowrap class="custom-grid th-middle" style="text-align:left;">&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('c.CustomerFirstName');">Customer Name</span></th>     
		<th nowrap class="custom-grid th-middle" style="text-align:left;">&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('h.AproveName');">Approve Status</span></th>
		<th nowrap class="custom-grid th-middle" style="text-align:left;">&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('e.full_name');">Agent Name</span></th>
		<th nowrap class="custom-grid th-middle" style="text-align:left;">&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('b.PolicySalesDate');">Sales Date</span></th>
		<th nowrap class="custom-grid th-lasted" style="text-align:left;">&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('g.PolicySalesDate');">Days</span></th>
	</tr>
</thead>	
<tbody>
<?php
$no = $num;
foreach( $page -> result_assoc() as $rows )
{ 
  $color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
  $daysize = _getDateDiff(date('Y-m-d H:i:s'),$rows['PolicySalesDate']); 
?>
<tr class="onselect" bgcolor="<?php echo $color;?>">
	<td class="content-first"><?php echo form()->checkbox('chk_cust_call',NULL, $rows['CustomerId'] ); ?></td>
	<td class="content-middle"><?php  echo $no; ?></td>
	<td class="content-middle"><div style="width:100px;"><?php  echo $rows['CampaignName']; ?></div></td>
	<td class="content-middle" nowrap><?php echo $rows['CustomerFirstName']; ?></td>
	<td class="content-middle" nowrap><span style="color:#b14a06;font-weight:bold;"><?php echo strtoupper($rows['AproveName']); ?></span></td>
	<td class="content-middle" nowrap><?php echo $rows['full_name']; ?></td>
	<td class="content-middle" nowrap><?php echo $rows['PolicySalesDate']; ?></td>
	<td class="content-lasted" style="color:red;">&plusmn;&nbsp;<?php echo $daysize['days_total'];?></td>
</tr>
</tbody>
<?php
$no++;
};
?>
</table>


