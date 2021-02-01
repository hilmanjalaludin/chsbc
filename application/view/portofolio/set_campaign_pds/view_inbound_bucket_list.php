
<table width="100%" class="custom-grid" cellspacing="1">
<thead>
	<tr height="24"> 
		
		<th nowrap class="font-standars ui-corner-top ui-state-default first center">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('CustomerId').setChecked();">#</a></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default middle center">&nbsp;No</th>   
        <th nowrap class="font-standars ui-corner-top ui-state-default middle center">&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('a.CustomerNumber');" title="Order ASC/DESC">CIF</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default middle center">&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('a.CustomerFirstName');" title="Order ASC/DESC">Customer Name</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default middle center">&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('a.GenderId');" title="Order ASC/DESC">Gender</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default middle center">&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('a.CustomerMobilePhoneNum');" title="Order ASC/DESC">Mobile Phone</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default middle center">&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('a.CustomerHomePhoneNum');" title="Order ASC/DESC">Home Phone</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default middle center">&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('a.CustomerWorkPhoneNum');" title="Order ASC/DESC">Office Phone</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default middle center">&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('a.CallReasonId');" title="Order ASC/DESC">Call Result</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default lasted center">&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('start_time');" title="Order ASC/DESC"> Call Incoming Date </span></th>
	</tr>
</thead>	
<tbody>
<?php
$no  = $start+1;

foreach( $result as $rows )
{ 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>
			<tr class="onselect" bgcolor="<?php echo $color;?>" style="color:#234777;">
				<td class="content-first"><input type="checkbox" name="CustomerId" id="CustomerId" value="<?php echo $rows['CustomerId']; ?>"></td>
				<td class="content-middle">&nbsp;<?php echo $no; ?></td>
				<td class="content-middle">&nbsp;<?php __(($rows['CustomerNumber']?$rows['CustomerNumber']:'-')); ?></td>
				<td class="content-middle">&nbsp;<?php __(($rows['CustomerFirstName']?$rows['CustomerFirstName']:'-')); ?></td>
				<td class="content-middle"><?php __(($rows['GenderId'] ? $combo['Gender'][$rows['GenderId']]: '-')); ?></td>
				<td class="content-middle">&nbsp;<?php __(($rows['CustomerMobilePhoneNum'] ? $rows['CustomerMobilePhoneNum'] : '-')); ?></td>
				<td class="content-middle" nowrap>&nbsp;<?php __(($rows['CustomerHomePhoneNum'] ? $rows['CustomerHomePhoneNum'] : '-')); ?></td>
				<td class="content-middle" nowrap>&nbsp;<?php __(($rows['CustomerWorkPhoneNum'] ? $rows['CustomerWorkPhoneNum'] : '-'));?></td>
				<td class="content-middle" nowrap>&nbsp;<?php __(($rows['CallReasonId'] ? $combo['CallResultInbound'][$rows['CallReasonId']]: '-'));?></td>
				
				<td class="content-lasted" align="center">&nbsp;<?php echo ( $rows['start_time'] ? date('d-m-Y H:i:s', strtotime($rows['start_time'])) : '-'); ?></td>
			</tr>	
			
			
</tbody>
	<?php
		
		$no++;
		}
	?>
</table>