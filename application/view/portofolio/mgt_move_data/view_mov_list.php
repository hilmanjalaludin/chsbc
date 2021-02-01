<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<table cellspacing=0 width='99%'>
	<tr height='24px'>
		<th class='th-first center' width='5%'>&nbsp;<b><a href="javascript:void(0);" onclick="Ext.Cmp('listID').setChecked();"> #</a></b></th>
		<th class='th-middle left'>&nbsp;<b>No.</b></th>
		<th class='th-middle left'>&nbsp;<b>Customer Name</b></th>
		<th class='th-middle left'>&nbsp;<b>Campaign Name</b></th>
		<th class='th-middle left'>&nbsp;<b>Call Result</b></th>
		<th class='th-middle left'>&nbsp;<b>Last Update</b></th>
		<th class='th-lasted left'>&nbsp;<b>Agent</b></th>
	</tr>
	
	
<?php 
$no = 0;
if( is_array( $data )) foreach($data as $num => $rows ){ 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>
	<tr bgcolor='<?php __($color);?>' class='onselect'> 
		<td class='content-first center'>&nbsp;<?php __( form()->checkbox('listID',null,$rows['AssignId']) ); ?></th>
		<td class='content-middle left'>&nbsp;<?php __($no+1); ?></th>
		<td class='content-middle left'>&nbsp;<?php __(($rows['CustomerFirstName']?$rows['CustomerFirstName']:'-')); ?></th>
		<td class='content-middle left'>&nbsp;<?php __($combo['Campaign'][$rows['CampaignId']]); ?></th>
		<td class='content-middle left'>&nbsp;<?php __(($rows['CallReasonDesc']?$rows['CallReasonDesc']:'New Data')); ?></th>
		<td class='content-middle left'>&nbsp;<?php __(($rows['CustomerUpdatedTs']?$rows['CustomerUpdatedTs']:'-')); ?></th>
		<td class='content-lasted left'>&nbsp;<?php __(($rows['full_name']?$rows['full_name']:'-')); ?></th>
	</tr>
	
<?php $no++;  }  ?>

</table>
