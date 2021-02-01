<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/*
 * @ def    : include payer page HTML on layout form 
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 */
 //print_r($Payers);
 
 $Payer = new EUI_object( $Payers );
 
?>

<div class="ui-widget-form-table">
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required">* Title</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo("PayerSalutationId",'title select long text-required zx-select',Salutation(), $Payers['SalutationId']);?></div>
	</div>
	<div class="ui-widget-form-row">	
		<div class="ui-widget-form-cell text_caption required" nowrap>* First Name</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input("PayerFirstName","input_text long text-required uppercase",$Payer->get_value('PayerFirstName') );?></div>
	</div>
	
	<div class="ui-widget-form-row">	
		<div class="ui-widget-form-cell text_caption required" nowrap>Age</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input("PayerAge","input_text long ui-widget-disabled-data text-required uppercase", ( $Payer->get_value('PayerAge','intval') ? $Payer->get_value('PayerAge','intval') : $Payer->get_value('PayerDOB','_getAge')) );?> </div>
	</div>
</div>	

<div class="ui-widget-form-table">
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption ">Gender</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo("PayerGenderId",'select long zx-select',Gender(),$Payer->get_value('GenderId'));?></div>
	</div>
	<div class="ui-widget-form-row">	
		<div class="ui-widget-form-cell text_caption  required">* DOB</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"> 
			<?php echo form()->input("PayerDOB","input_text date text-required",$Payer->get_value('PayerDOB','_getDateIndonesia'));?> 
			
		</div>
	</div>
</div>	

<div class="ui-widget-form-table">	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption ">ID - Type </div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo("PayerIdentificationTypeId","select long zx-select",Identification(),$Payer->get_value('IdentificationTypeId') );?></div>
	</div>
	<div class="ui-widget-form-row">	
		<div class="ui-widget-form-cell text_caption ">* ID No</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input("PayerIdentificationNum","input_text long text-required",$Payer->get_value('PayerIdentificationNum'));?></div>
	</div>
	
</div>