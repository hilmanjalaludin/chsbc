<script>
$(document).ready(function(){
	$(".disabled").each(function(){
		var ObjectId = $(this).attr('id');
		Ext.Cmp(ObjectId).disabled(true);	
	});
	
	$('.button_disabled').each(function(){
		$(this).css({"cursor":"not-allowed"});  
		$(this).css({"color":"silver"});
		$(this).attr("disabled", true);
		$(this).attr('onclick', "javascript:void(0);");
	});
	
 });
</script>
<!-- START : Div 1 -->


<form name="InsuredDetailForm">
<?php echo form()->hidden('InsuredId','input_text undisabled long', $Insured->get_value('InsuredId')); ?> 
<fieldset class="corner" style="border-radius:5px;padding:5px 5px 10px 5px;">
<?php echo form()->legend(lang('Product'), "fa-edit"); ?>
<div id="product-insured" class="ui-widget-form-table">
<table class="product-box-content" align="left" cellspacing=0 border=0>
	<tr>
		<td class="text_caption  required">* Policy Number :</td>
		<td class=''><span id="policy_number"><?php echo form()->input('InsuredPolicyNumber','input_text disabled long', $Insured->get_value('PolicyNumber')); ?> </span></td>
		<td class="text_caption  required">* Payment Mode :</td>
		<td class=''><span id="pay_plan"><?php echo form()->combo('InsuredPayMode','select xchosen disabled long',PaymentMode(),$Insured->get_value('PayModeId')); ?></span> </td>
		<td class="text_caption  sunah">Premi :</td>
		<td class=''><?php echo form()->input('InsuredPremi','input_text disabled box',$Insured->get_value('PolicyPremi') ); ?> <span class="wrap"> ( IDR ) </span></td>
	</tr>
	<tr>
		<td class="text_caption  required">* Group Premi : </td>
		<td class=''><span id="group_premi"><?php echo form()->combo('InsuredGroupPremi','select xchosen disabled long',PremiGroup(),$Insured->get_value('PremiumGroupId')); ?> </span></td>
		<td class="text_caption  required ">* Plan Type :</td>
		<td class=''><span id="plan_type"><?php echo form()->input('InsuredPlanType','input_text disabled long',$Insured->get_value('ProductPlanName')); ?></span> </td>
	</tr>
</table>
</div>
</fieldset>
<!-- STOP : Div 1 -->

<!-- START : Div 2 -->
<fieldset class="corner" style="margin-top:15px;border-radius:5px;padding:5px 5px 10px 5px;">
<?php echo form()->legend(lang('Personal Data'), "fa-edit"); ?>
<div id="personal-insured" class="ui-widget-form-table">
<table class="product-box-content" align="left" cellspacing=0 border=0 width="99%">
	<tr>
		<td class="text_caption">Title</td>
		<td class="text_caption">:</td>
		<td class=''><?php echo form()->combo('InsuredSalutationId','select xchosen disabled long',Salutation(), $Insured->get_value('SalutationId') ); ?></td>
		
		<td class="text_caption">Realtionship</td>
		<td class="text_caption">:</td>
		<td class=''><?php echo form()->combo('RelationshipTypeId','select xchosen disabled long',Realtionship(),$Insured->get_value('RelationshipTypeId') ); ?></td>
		
		<td class="text_caption">DOB</td>
		<td class="text_caption">:</td>
		<td class=''><?php echo form()->input('InsuredDOB','input_text long disabled date',$Insured->get_value('InsuredDOB','_getDateIndonesia')); ?></td>
	</tr>
	
	<tr>
		<td class="text_caption">* First Name</td>
		<td class="text_caption">:</td>
		<td class=''><?php echo form()->input('InsuredFirstName','input_text undisabled long',$Insured->get_value('InsuredFirstName'),null); ?></td>
		
		<td class="text_caption">* Gender </td>
		<td class="text_caption">:</td>
		<td class=''><?php echo form()->combo('InsuredGenderId','select xchosen disabled long',Gender(),$Insured->get_value('GenderId') ); ?></td>
		
		<td class="text_caption">Age</td>
		<td class="text_caption">:</td>
		<td class=''><?php echo form()->input('InsuredAge','input_text disabled long',$Insured->get_value('InsuredAge') ); ?></td>
	</tr>
</table>
</div>
</fieldset>

<!-- start : Underwriting save from agent Show on Here --->
<?php $this->load->view("qty_approval_interest/view_quality_underwriting");?>
<!-- stop : Underwriting save from agent Show on Here --->
</form>

<fieldset style="display:yes;border:0px solid #000;margin-top:10px;width:99%;">
	<div style="float:right;display:none;"> <?php echo form()->button('button_update',"update button {$Disabled}",'Update', array('click' =>'Ext.DOM.UpdateInsured();' ));?><div>	
</fieldset>

<!-- STOP : Div 4 -->

