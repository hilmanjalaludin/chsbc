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
foreach( $Insured as $keys => $rows ) : 
$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>
<tr class='onselect' bgcolor='<?php __($color);?>'>
	<td class="content-first center"><?php __(form()->checkbox('InsuredId',NULL, $rows['InsuredId'],array('click'=>'Ext.DOM.DetailInsuredForm(this);')));?></td>
	<td class="content-middle left"><?php __($rows['InsuredFirstName']);?></td>
	<td class="content-middle right"><?php __($rows['InsuredDOB']);?></td>
	<td class="content-middle right"><?php __($rows['InsuredAge']);?></td>
	<td class="content-middle left"><?php __($rows['ProductName']);?></td>
	<td class="content-middle left"><?php __($rows['PremiumGroupDesc']);?></td>
	<td class="content-middle left"><?php __($rows['PayMode']);?></td>
	<td class="content-middle left"><?php __($rows['ProductPlanName']);?></td>
	<td class="content-lasted right"><?php __($rows['PolicyPremi']);?></td>
</tr>	
<?php 
	$no++;
endforeach; ?>
</table>


