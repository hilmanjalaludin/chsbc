
<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		
		<th nowrap class="custom-grid th-first">&nbsp;No</th>   
		<th nowrap class="custom-grid th-middle left">&nbsp;<span>InBound Name</span></th>
        <th nowrap class="custom-grid th-middle left">&nbsp;<span>InBound Number</span></th>
		<th nowrap class="custom-grid th-lasted">&nbsp;<span>Campaign Alias</span></th>
	</tr>
</thead>	
<tbody>
<?php
$no  = $num;
foreach( $page -> result_assoc() as $rows )
{ 
 ?>
	<tr class="onselect">
		<td class="content-first"><?php echo $no; ?></td>
		<td class="content-middle"><?php echo (isset($rows['DIDName'])?$rows['DIDName']:'-'); ?></td>
		<td class="content-middle"><?php echo (isset($rows['CampaignTelephoneNumber'])?$rows['CampaignTelephoneNumber']:'-'); ?></td>
		<td class="content-lasted"><?php echo (isset($rows['CampaignOutbondName'])?$rows['CampaignOutbondName']:'-'); ?></td>
	</tr>			
</tbody>
<?php
		$no++;
  };
?>
</table>