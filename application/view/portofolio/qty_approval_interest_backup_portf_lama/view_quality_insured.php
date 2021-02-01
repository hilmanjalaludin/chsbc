<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
?>

<table class="custom-grid" cellspacing="1" width='100%' align='center'>
<tr height='24px'>
	<th class='font-standars ui-corner-top ui-state-default first'>#</th>
	<th class='font-standars ui-corner-top ui-state-default middle left'>Insured Name</th>
	<th class='font-standars ui-corner-top ui-state-default middle center'>DOB</th>
	<th class='font-standars ui-corner-top ui-state-default middle center'>Age</th>
	<th class='font-standars ui-corner-top ui-state-default middle left'>Product</th>
	<th class='font-standars ui-corner-top ui-state-default middle left'>Group Premi</th>
	<th class='font-standars ui-corner-top ui-state-default middle left'>Payment Mode</th>
	<th class='font-standars ui-corner-top ui-state-default middle left'>Plan</th>
	<th class='font-standars ui-corner-top ui-state-default lasted center'>Premi</th>
</tr>	
<?php 
$no = 1; 
$total_premi = 0;
foreach( $Insured as $keys => $rows ) : 
$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
$row = new EUI_Object( $rows );
?>
<tr class='onselect' bgcolor='<?php echo $color;?>'>
	<td class="content-first center"> <?php echo form()->checkbox('InsuredId',NULL, $row->get_value('InsuredId'), array('click'=>'Ext.DOM.DetailInsuredForm(this);') );?></td>
	<td class="content-middle left">  <?php echo $row->get_value('InsuredFirstName','strtoupper');?></td>
	<td class="content-middle right"> <?php echo $row->get_value('InsuredDOB','_getDateIndonesia');?></td>
	<td class="content-middle right"> <?php echo $row->get_value('InsuredAge');?></td>
	<td class="content-middle left">  <?php echo $row->get_value('ProductName');?></td>
	<td class="content-middle left">  <?php echo $row->get_value('PremiumGroupDesc','strtoupper');?></td>
	<td class="content-middle left">  <?php echo $row->get_value('PayMode','strtoupper');?></td>
	<td class="content-middle left">  <?php echo $row->get_value('ProductPlanName','strtoupper');?></td>
	<td class="content-lasted right"> <?php echo $row->get_value('PolicyPremi','_getCurrency');?></td>
</tr>	
<?php 
	$total_premi += $row->get_value('PolicyPremi');
	$no++;
endforeach; ?>
<tr height='24px'>
	<th class='font-standars ui-corner-bottom ui-state-default first right' colspan="8">Total&nbsp;:&nbsp;</th>
	<th class='font-standars ui-corner-bottom ui-state-default lasted right'><?=_getCurrency($total_premi)?></th>
</tr>	
</table>