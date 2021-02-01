<?php ?>

<table width="100%" class="custom-grid" cellspacing="1">
<thead>
	<tr height="24"> 
		<th nowrap class="font-standars ui-corner-top ui-state-default first center" width="5%">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_skill').setChecked();">#</a></th>	
		<th nowrap class="font-standars ui-corner-top ui-state-default middle center" >&nbsp;No</th>	
        <th nowrap class="font-standars ui-corner-top ui-state-default middle center" ><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('c.DIDName');">&nbsp;DID Name</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default middle center" ><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('c.DIDDirection');">&nbsp;DID Description</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default middle center" ><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('c.DIDNumber');">&nbsp;DID Number</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default middle center" ><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('b.CampaignName');">&nbsp;Campaign Name</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default lasted center" ><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('c.DIDFlags');">&nbsp;Status</span></th>
		
	</tr>
</thead>	
<tbody>
<?php
 $no  = $num;
 foreach( $page -> result_assoc() as $rows ) { 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>	
	<tr CLASS="onselect" bgcolor="<?php echo $color;?>">
		<td class="content-first"><input type="checkbox" value="<?php echo $rows['RecordId']; ?>" name="chk_skill" id="chk_skill"></td>
		<td class="content-middle"><?php echo $no ?></td>
		<td class="content-middle"><?php echo $rows['DIDName']; ?></td>
		<td class="content-middle"><?php echo $rows['DIDDirection']; ?></td>
		<td class="content-middle"><?php echo $rows['DIDNumber']; ?></td>
		<td class="content-middle"><?php echo $rows['CampaignName']; ?></td>
		<td class="content-lasted"><?php echo ($rows['DIDFlags']?'Active' : 'Not Active'); ?></td>
	</tr>	
</tbody>
	<?php
		$no++;
		};
	?>
</table>



