<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/*
 * @ def    : include insured page HTML on layout form 
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 *
 */
?>
<table class="product-box-content" align="center" width="100%" cellspacing=0 border=0>
	<tr>
		<td class="text_caption bottom required">* Application Number</td>
		<td><span id="policy_number"><?php echo form()->combo('InsuredPolicyNumber','select long'); ?> </span></td>
		<td class="text_caption bottom required">* Payment Mode</td>
		<td><span id="pay_plan"><?php echo form()->combo('InsuredPayMode','select long',$PayModeByPrd); ?></span> </td>
		<td class="text_caption bottom sunah">Premi</td>
		<td><?php echo form()->input('InsuredPremi','input_text box'); ?> <span class="wrap"> ( IDR ) </span></td>
	</tr>
	<tr>
		<td class="text_caption   required">* Group Premi</td>
		<td><span id="group_premi"><?php echo form()->combo('InsuredGroupPremi','select long',$Combo['PremiGroup']); ?> </span></td>
		<td class="text_caption   required ">* Plan Type</td>
		<td><span id="plan_type"><?php echo form()->combo('InsuredPlanType','select long',$Plan ); ?></span> </td>
	</tr>
</table>