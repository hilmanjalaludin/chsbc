<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/*
 * @ def    : include payer page HTML on layout form 
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 */
 
?>
<form name="frmUserPhone">
<div>
	<?php echo form()->hidden('CustomerId',null,$CustomerId ); ?>
	<table cellspacing=7px>
		<tr> 
			<td class="text_caption"> Phone Type </td>
			<td><?php echo form()->combo('ApproveItem','select long',$ApproveItem); ?></td>
		</tr>
		<tr> 
			<td class="text_caption"> New Number </td>
			<td><?php echo form()->input('ApproveNumber','input_text long'); ?></td>
		</tr>	
	</table>	
</div>
</form>